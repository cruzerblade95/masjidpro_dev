<?php
date_default_timezone_set("Asia/Kuala_Lumpur"); // Set timezone waktu Malaysia
session_start();

// Lepas dapat token dari device, simpan dalam cookie dan session
if($_GET['token'] != NULL || $token_device != NULL) {
    if($_GET['token'] != NULL) $token_device = $_GET['token'];
    setcookie("token_device", $token_device, time() + (86400 * 365), "/");
    $_SESSION['token_device'] = $token_device;
    $_COOKIE['token_device'] = $token_device;
    if($_SESSION['token_device'] != NULL) $token_device = $_SESSION['token_device'];
    if($_COOKIE['token_device'] != NULL) $token_device = $_COOKIE['token_device'];
}

// Skip session terus ke maklumat database untuk file fungsi.php bila diakses secara direct
if(strpos($_SERVER['REQUEST_URI'], 'bantuan_app.php') !== false || strpos($_SERVER['REQUEST_URI'], 'detail_bantuan.php') !== false || strpos($_SERVER['REQUEST_URI'], 'getdaerah.php') !== false || strpos($_SERVER['REQUEST_URI'], 'fungsi.php') !== false || isset($_GET['id_masjid']) || isset($_GET['logmasuk']) || isset($_GET['dapatkanSesi']) || (isset($_POST['semak']) && $pass == 0)) goto maklumat_database;

// Tunjuk http error code pada 'Header' sekiranya gagal login atau tidak login
$error_code = array("401", "403");
if(in_array($_GET['action'], $error_code)) http_response_code($_GET['action']);

// Padam semua session dan cookie
function logKeluar() {
    global $token_device;
    foreach ($_SESSION as $exit_session => $val_exit) {
        if($exit_session != "token_device") unset($_SESSION[$exit_session]);
    }
    foreach ($_COOKIE as $exit_session2 => $val_exit2) {
        if($exit_session2 != "token_device") {
            setcookie($exit_session2, "", time() - (86400 * 500));
            setcookie($exit_session2, "", time() - (86400 * 500), '/');
        }
    }
    setcookie("undefined", "", time() - (86400 * 500));
    setcookie("undefined", "", time() - (86400 * 500), '/');

    session_unset();
    session_destroy();
    session_write_close();
    session_regenerate_id(true);
    if (isset($_SERVER['HTTP_COOKIE'])) {
        $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
        foreach($cookies as $cookie) {
            $parts = explode('=', $cookie);
            $name = trim($parts[0]);
            setcookie($name, "", time() - (86400 * 500));
            setcookie($name, "", time() - (86400 * 500), '/');
        }
    }
    setcookie("token_device", $token_device, time() + (86400 * 365), "/");
    $_SESSION['token_device'] = $token_device;
    header('Location: https://daftarsolat.masjidpro.com/?action=keluar&token='.$token_device);
}

if($_GET['action'] == "keluar") {
    logKeluar();
}

// Redirect ke halaman utama sekiranya gagal login / tidak login / sesi tamat
if($_SESSION['no_ic'] == NULL && $_COOKIE['no_ic'] == NULL && strpos($_SERVER['SCRIPT_NAME'], 'index.php') == false) {
    if($_GET['dapatkanSesi'] != NULL) $daftarSolat_sesi = $_GET['dapatkanSesi'];
    else $daftarSolat_sesi = null;
    header("Location: index.php?action=403&token=$token_device&dapatkanSesi=$daftarSolat_sesi");
}
goto semak_masa;

// Dapatkan last session aktif dalam unit saat
maklumat_database:
$semak_login = 1;

semak_masa:
$time = $_SERVER['REQUEST_TIME'];
$timeout_duration = 1 * 60 * 60 * 24 * 365;
if($semak_login == 1) goto semak_masa2;
if (isset($_SESSION['LAST_ACTIVITY']) && ($time - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
    logKeluar();
}
semak_masa2:
$_SESSION['LAST_ACTIVITY'] = $time;

$mysql_hostname_utama = "localhost";
$mysql_user_utama = "tahfizte_spmd";
$mysql_password_utama = "WebmasterMasjid2019";
$mysql_database_utama = "tahfizte_masjidpro";

// Kekalkan sesi atau cookie sekiranya masih lagi aktif
if($_SESSION['username'] == NULL && $_SESSION['no_ic'] == NULL && ($_COOKIE['username'] != NULL || $_COOKIE['no_ic'] != NULL)) {
    foreach ($_COOKIE as $copy_session => $val_copy) {
        if($copy_session != "PHPSESSID") $_SESSION[$copy_session] = $val_copy;
    }
}

if(session_status() == PHP_SESSION_ACTIVE) {
    foreach ($_SESSION as $kekal_session => $val_kekal) {
        ${$kekal_session} = $val_kekal;
    }
    foreach ($_COOKIE as $kekal_session2 => $val_kekal2) {
        setcookie($kekal_session2, $val_kekal2, time() + (86400 * 365), "/");
    }
}

//$utama_conn = mysqli_connect($mysql_hostname_utama, $mysql_user_utama, $mysql_password_utama, $mysql_database_utama) or die("Could not connect database");
//$query_db = "SELECT * FROM sej6x_data_masjid WHERE url_masjid LIKE '%$reff_url%'";
//$list_db = mysqli_query($utama_conn, $query_db) or die(mysqli_error($utama_conn));
//$row_list_db = mysqli_fetch_assoc($list_db);
//$id_masjid = $row_list_db['id_masjid'];
//$kod_masjid = $row_list_db['kod_masjid'];
//$nama_masjid = $row_list_db['nama_masjid'];
//$negeri_masjid = $row_list_db['id_negeri'];
//$daerah_masjid = $row_list_db['id_daerah'];

$utama_conn2 = mysqli_connect($mysql_hostname_utama, $mysql_user_utama, $mysql_password_utama) or die("Could not connect database utama con2");
mysqli_select_db($utama_conn2, $mysql_database_utama) or die("Could not select database");

$bd2 = mysqli_connect($mysql_hostname_utama, $mysql_user_utama, $mysql_password_utama) or die("Could not connect database bd2");
mysqli_select_db($bd2, $mysql_database_utama) or die("Could not select database");

/**
$bd = mysql_connect($mysql_hostname_utama, $mysql_user_utama, $mysql_password_utama) or die("Could not connect database bd");
mysql_select_db($mysql_database_utama, $bd) or die("Could not select database");
**/

?>