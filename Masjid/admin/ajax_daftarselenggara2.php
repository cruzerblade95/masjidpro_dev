<?php
include("../connection/connection.php");
include("../fungsi.php");
// Get the selected option from the AJAX request
$nama_penuh = $_POST['option'];


$sql_search1 = "SELECT no_hp FROM sej6x_data_peribadi WHERE nama_penuh LIKE '%$nama_penuh%' AND id_masjid= $id_masjid";
$result = mysqli_query($bd2, $sql_search1) or die ("Error :" . mysqli_error($bd2));

// Store the options in an array
$options = array();

// Iterate through the results and add options to the array
while ($row = mysqli_fetch_assoc($result)) {
    $options[] = array(
        'value' => $row['no_hp']
    );
}

// Close the statement
//mysqli_stmt_close($stmt);

// Close the database connection
//mysqli_close($bd2);

// Return the options as a JSON-encoded response
echo json_encode($options);

?>
