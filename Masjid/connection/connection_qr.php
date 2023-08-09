<?php
session_start();
date_default_timezone_set("Asia/Kuala_Lumpur"); // Set timezone waktu Malaysia
$time = $_SERVER['REQUEST_TIME'];
$timeout_duration = 1 * 60 * 60 * 24 * 365;
if (isset($_SESSION['LAST_ACTIVITY']) && ($time - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
    unset($_SESSION["no_ic_qr"]);
    unset($_SESSION["lokasi_qr"]);
    header("Location: login-kehadiran.php");
}
$_SESSION['LAST_ACTIVITY'] = $time;

$hostname ="localhost";

//if($_GET['userid'] != NULL || $_POST['dev'] == 1 || $dev == 1) {
//    $user = "appsmasjid_devspmd";
//    $password = "AdminDev@2021";
//}
//else {
    $user = "tahfizte_spmd";
    $password = "WebmasterMasjid2019";
//}
// Kekalkan sesi atau cookie sekiranya masih lagi aktif
if($_SESSION['no_ic_qr'] == NULL && $_COOKIE['no_ic_qr'] != NULL) {
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
    $no_ic_data = $_SESSION['no_ic_qr'];
    $lokasi = $_SESSION['lokasi_qr'];
    if (empty($_SESSION['token_qr'])) {
        $length = 32;
        $_SESSION['token_qr'] = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $length);
    }
    $token_qr = $_SESSION['token_qr'];
}

//if($_GET['apps'] == 1 || $_POST['apps'] == 1 || $_GET['userid'] != NULL || $_POST['dev'] == 1 || $dev == 1) $database = "dev_spmd";
$database = "tahfizte_masjidpro";
$conn = mysqli_connect($hostname, $user, $password, $database) or die("Gagal menghubungi pengkalan data");
$bd2 = mysqli_connect($hostname, $user, $password, $database) or die("Gagal menghubungi pengkalan data");

function ee($a, $b, $c) {
    global $conn;
    if($b == 1) $a = strtoupper($a);
    //$a = addslashes($a);
    //$a = htmlspecialchars($a);
    $a = mysqli_real_escape_string($conn, $a);
    if($c == 1) $a = stripslashes($a);
    return $a;
}

if($_GET['userid'] != NULL || $_POST['dev'] == 1) {
    //echo($database);
}

// Padam semua session dan cookie
function logKeluar() {
    foreach ($_SESSION as $exit_session => $val_exit) {
        unset($_SESSION[$exit_session]);
    }
    foreach ($_COOKIE as $exit_session2 => $val_exit2) {
        setcookie($exit_session2, "", time() - (86400 * 500));
        setcookie($exit_session2, "", time() - (86400 * 500), '/');
    }
    setcookie("undefined", "", time() - (86400 * 500));
    setcookie("undefined", "", time() - (86400 * 500), '/');

    session_unset();
    session_destroy();
    session_write_close();
    session_start();
    session_regenerate_id(true);
    if (isset($_SERVER['HTTP_COOKIE'])) {
        $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
        foreach ($cookies as $cookie) {
            $parts = explode('=', $cookie);
            $name = trim($parts[0]);
            setcookie($name, "", time() - (86400 * 500));
            setcookie($name, "", time() - (86400 * 500), '/');
        }
    }
}

function utf8ize( $mixed ) {
    if (is_array($mixed)) {
        foreach ($mixed as $key => $value) {
            $mixed[$key] = utf8ize($value);
        }
    } elseif (is_string($mixed)) {
        return mb_convert_encoding($mixed, "UTF-8", "UTF-8");
    }
    return $mixed;
}

/**
 * Get hearder Authorization
 * */
function getAuthorizationHeader() {
    $headers = null;
    if (isset($_SERVER['Authorization'])) {
        $headers = trim($_SERVER["Authorization"]);
    }
    else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
        $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
    } elseif (function_exists('apache_request_headers')) {
        $requestHeaders = apache_request_headers();
        // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
        $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
        //print_r($requestHeaders);
        if (isset($requestHeaders['Authorization'])) {
            $headers = trim($requestHeaders['Authorization']);
        }
    }
    return $headers;
}
/**
 * get access token from header
 * */
function getBearerToken() {
    $headers = getAuthorizationHeader();
    // HEADER: Get the access token from the header
    if (!empty($headers)) {
        if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
            return $matches[1];
        }
    }
    return null;
}

if($_GET['bearer'] != NULL) $BearerToken = $_GET['bearer'];
else if(getBearerToken() != NULL) $BearerToken = getBearerToken();
else logKeluar();
?>