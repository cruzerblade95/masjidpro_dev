<?php
$timeout_duration_sesi = 1 * 60 * 60 * 24 * 365;
if(session_status() !== PHP_SESSION_ACTIVE) {
    // server should keep session data for AT LEAST 1 hour
    ini_set('session.gc_maxlifetime', $timeout_duration_sesi);

// each client should remember their session id for EXACTLY 1 hour
    session_set_cookie_params($timeout_duration_sesi);
    session_start();
}
date_default_timezone_set("Asia/Kuala_Lumpur"); // Set timezone waktu Malaysia
if($_SERVER['SERVER_NAME'] == "api.masjidpro.com") goto skip_session;
$time = $_SERVER['REQUEST_TIME'];

/**
 * for a 30 minute timeout, specified in seconds
 */
$timeout_duration = $timeout_duration_sesi;
/**
 * Here we look for the user's LAST_ACTIVITY timestamp. If
 * it's set and indicates our $timeout_duration has passed,
 * blow away any previous $_SESSION data and start a new one.
 */
if (isset($_SESSION['LAST_ACTIVITY']) && ($time - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {

    $kod_masjid = $_SESSION['kod_masjid'];
    session_unset();
    session_destroy();
    session_start();
    $_SESSION['kod_masjid'] = $kod_masjid;
    header("Location: https://masjidpro.com/Masjid/login.php");
}

/**
 * Finally, update LAST_ACTIVITY so that our timeout
 * is based on it and not the user's login time.
 */
$_SESSION['LAST_ACTIVITY'] = $time;

skip_session:

if($_GET['devMode'] == 1) $devMode = $_GET['devMode'];

$mysql_hostname_utama2 = "localhost";
$mysql_user_utama2 = "appsmasjid_devspmd";
$mysql_password_utama2 = "AdminDev@2021";
$mysql_database_utama2 = "dev_spmd";

$dftrSolat_user2 = "appsmasjid_devspmd";
$dftrSolat_pass2 = "AdminDev@2021";
$dftrSolat_db2 = "dev_daftarsolat";


if($devMode == 1) {
    $mysql_hostname_utama = $mysql_hostname_utama2;
    $mysql_user_utama = $mysql_user_utama2;
    $mysql_password_utama = $mysql_password_utama2;
    $mysql_database_utama = $mysql_database_utama2;

    $dftrSolat_user = $dftrSolat_user2;
    $dftrSolat_pass = $dftrSolat_pass2;
    $dftrSolat_db = $dftrSolat_db2;
}
else {
    $user_array = array("tahfizte_spmd", "tahfizte_spmdbekap", "tahfizte_spmdbekap2", "tahfizte_spmdbekap3");
    $mysql_hostname_utama = "localhost";
    $mysql_user_utama = $user_array[rand(0, 3)];
    $mysql_password_utama = "WebmasterMasjid2019";
    $mysql_database_utama = "tahfizte_masjidpro";

    $dftrSolat_user = $user_array[rand(0, 3)];
    $dftrSolat_pass = "WebmasterMasjid2019";
    $dftrSolat_db = "tahfizte_msjdprosolat";
}
if($_SERVER['SERVER_NAME'] == "api.masjidpro.com") goto skip_session2;

if(session_status() == PHP_SESSION_ACTIVE)
{
    $id_masjid = $_SESSION['id_masjid'];
    $kod_masjid = $_SESSION['kod_masjid'];
    $nama_masjid = $_SESSION['nama_masjid'];
    $perlu_zon = $_SESSION['perlu_zon'];
    $id_negeri = $_SESSION['id_negeri'];
    $id_daerah = $_SESSION['id_daerah'];
    $negeri_masjid = $_SESSION['negeri_masjid'];
    $daerah_masjid = $_SESSION['daerah_masjid'];
    $user_id = $_SESSION['user_id'];
    $user_type_id = $_SESSION['user_type_id'];
    if (empty($_SESSION['token'])) {
        $length = 32;
        $_SESSION['token'] = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $length);
    }
    $token_id = $_SESSION['token'];
}
//else{

//header("Location: http://www.masjidpro.com/Masjid/login.php");
//}
//$utama_conn = mysqli_connect($mysql_hostname_utama, $mysql_user_utama, $mysql_password_utama, $mysql_database_utama) or die("Could not connect database");
//$query_db = "SELECT * FROM sej6x_data_masjid WHERE url_masjid LIKE '%$reff_url%'";
//$list_db = mysqli_query($utama_conn, $query_db) or die(mysqli_error($utama_conn));
//$row_list_db = mysqli_fetch_assoc($list_db);
//$id_masjid = $row_list_db['id_masjid'];
//$kod_masjid = $row_list_db['kod_masjid'];
//$nama_masjid = $row_list_db['nama_masjid'];
//$negeri_masjid = $row_list_db['id_negeri'];
//$daerah_masjid = $row_list_db['id_daerah'];


skip_session2:
$utama_conn2 = mysqli_connect($mysql_hostname_utama, $mysql_user_utama, $mysql_password_utama) or die("Could not connect database utama con2");
mysqli_select_db($utama_conn2, $mysql_database_utama) or die("Could not select database");

if($_SERVER['SERVER_NAME'] != "api.masjidpro.com") {
    $bd = mysqli_connect($mysql_hostname_utama, $mysql_user_utama, $mysql_password_utama) or die("Could not connect database bd");
    mysqli_select_db($bd, $mysql_database_utama) or die("Could not select database");
}

$bd2 = mysqli_connect($mysql_hostname_utama, $mysql_user_utama, $mysql_password_utama) or die("Could not connect database bd2");
mysqli_select_db($bd2, $mysql_database_utama) or die("Could not select database");

$conn0 = mysqli_connect($mysql_hostname_utama, $dftrSolat_user, $dftrSolat_pass) or die("Could not connect database");
$conn = mysqli_connect($mysql_hostname_utama, $dftrSolat_user, $dftrSolat_pass, $dftrSolat_db) or die("Could not connect database conn");


$set_session = "SET SESSION sql_mode=''";
mysqli_query($bd2, $set_session);
mysqli_query($conn0, $set_session);
mysqli_query($conn, $set_session);

if($_GET['testDebug'] == 1) {
    $set_profilsql = "SET profiling = 1";
    mysqli_query($bd2, $set_profilsql) or die(mysqli_error($bd2));
}
// Server Dev
//$bd2_dev = mysqli_connect($mysql_hostname_utama2, $mysql_user_utama2, $mysql_password_utama2) or die("Could not connect database bd2_dev");
//mysqli_select_db($bd2_dev, $mysql_database_utama2) or die("Could not select database");

//$conn0_dev = mysqli_connect($mysql_hostname_utama2, $dftrSolat_user2, $dftrSolat_pass2) or die("Could not connect database");
//$conn_dev = mysqli_connect($mysql_hostname_utama2, $dftrSolat_user2, $dftrSolat_pass2, $dftrSolat_db2) or die("Could not connect database conn_dev");
?>