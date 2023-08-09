<?php
include("../connection/connection.php");
include("../fungsi.php");
// Get the selected option from the AJAX request
$id_peralatan = $_POST['option'];


$stmt = "SELECT b.id_penyelenggara, b.nama_penyelenggara FROM sej6x_data_inventori a LEFT JOIN penyelenggara b ON a.id_penyelenggara = b.id_penyelenggara WHERE id_inventori = '$id_peralatan'";
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
