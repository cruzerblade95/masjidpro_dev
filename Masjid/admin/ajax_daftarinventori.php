<?php
include("../connection/connection.php");
include("../fungsi.php");
// Get the selected option from the AJAX request
$id_peralatan = $_POST['option'];


$stmt = "SELECT id_penyelenggara, nama_penyelenggara FROM penyelenggara WHERE kat_peralatan = '$id_peralatan' AND id_masjid = $id_masjid";
$result= mysqli_query($bd2, $stmt) or die(mysqli_error($bd2));

// Store the options in an array
$options = array();

// Iterate through the results and add options to the array
while ($row = mysqli_fetch_assoc($result)) {
    $options[] = array(
        'value' => $row['id_penyelenggara'],
        'label' => $row['nama_penyelenggara']

    );
}

// Close the statement
//mysqli_stmt_close($stmt);

// Close the database connection
//mysqli_close($bd2);

// Return the options as a JSON-encoded response
echo json_encode($options);

?>
