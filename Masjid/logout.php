<?php
$timeout_duration_sesi = 1 * 60 * 60 * 24 * 365;
// server should keep session data for AT LEAST 1 hour
ini_set('session.gc_maxlifetime', $timeout_duration_sesi);

// each client should remember their session id for EXACTLY 1 hour
session_set_cookie_params($timeout_duration_sesi);
session_start();
$kod_masjid = $_SESSION['kod_masjid'];
session_unset();
session_destroy();
session_start();
$_SESSION['kod_masjid'] = $kod_masjid;
setcookie('kod_masjid', $_SESSION['kod_masjid'], time() + (86400 * 365), "/");
$_COOKIE['kod_masjid'] = $_SESSION['kod_masjid'];
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

// Kekalkan sesi atau cookie sekiranya masih lagi aktif
if ($_SESSION['kod_masjid'] == NULL && $_COOKIE['kod_masjid'] != NULL) {
    foreach ($_COOKIE as $copy_session => $val_copy) {
        if ($copy_session != "PHPSESSID") $_SESSION[$copy_session] = $val_copy;
    }
}

if (session_status() == PHP_SESSION_ACTIVE) {
    foreach ($_SESSION as $kekal_session => $val_kekal) {
        ${$kekal_session} = $val_kekal;
    }
    foreach ($_COOKIE as $kekal_session2 => $val_kekal2) {
        setcookie($kekal_session2, $val_kekal2, time() + (86400 * 365), "/");
    }
}

if($_SERVER['SERVER_NAME'] == "sistem.gomasjid.my") header('Location: https://sistem.gomasjid.my/login.php');
else header('Location: https://masjidpro.com/Masjid/login.php');

?>