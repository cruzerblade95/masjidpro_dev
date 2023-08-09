<?php
include("../connection/connection.php");
include("../fungsi.php");

// Fetch events for the current month
$currentMonth = date('Y-m');
$sql = "SELECT * FROM aktiviti WHERE DATE_FORMAT(tarikh_aktiviti, '%Y-%m') = '$currentMonth'";
$result= mysqli_query($bd2, $sql) or die(mysqli_error($bd2));
$events = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $events[] = $row;
    }
}
//$bd2->close();

// Return events as JSON
echo json_encode($events);
?>
