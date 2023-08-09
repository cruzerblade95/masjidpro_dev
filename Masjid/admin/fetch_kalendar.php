<?php
include('../connection/connection.php');

// Fetch events for the current month
$currentMonth = date('Y-m');
$sql = "SELECT * FROM aktiviti WHERE id_masjid = '$id_masjid' AND (DATE_FORMAT(tarikh_aktiviti, '%Y-%m') = '$currentMonth')";
$result = $conn->query($sql);
$events = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $events[] = $row;
    }
}
$conn->close();

// Return events as JSON
echo json_encode($events);
?>