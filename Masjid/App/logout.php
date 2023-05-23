<?php
session_start();
session_unset();
session_destroy();
header("Location:http://www.masjidpro.com/Masjid/login.php");

?>