<?php
include("../connection/connection.php");
include("../fungsi.php");
// Get the selected option from the AJAX request
$id_jawatan = $_POST['option'];


$sql_search1 = "SELECT id_jenisinventori, jenis_inventori FROM sej6x_data_jenisinventori WHERE id_masjid = '$id_masjid'";
$result1 = mysqli_query($bd2, $sql_search1) or die ("Error :" . mysqli_error($bd2));

if (mysqli_num_rows($result1) > 0) {

    $sql_search2 = "SELECT id_jenisinventori, jenis_inventori FROM sej6x_data_jenisinventori WHERE id_masjid = '$id_masjid'";
    $result2 = mysqli_query($bd2, $sql_search2) or die ("Error :" . mysqli_error($bd2));

} else {

    $new_id_masjid = $id_masjid;
    $sql_insert = "INSERT INTO sej6x_data_jenisinventori (id_masjid, jenis_inventori)SELECT '$new_id_masjid', jenis_inventori FROM sej6x_data_jenisinventori WHERE id_masjid = '0'";
    $resultInsert = mysqli_query($bd2, $sql_insert) or die ("Error :" . mysqli_error($bd2));
    if($resultInsert){

        $sql_search3 = "SELECT id_jenisinventori, jenis_inventori FROM sej6x_data_jenisinventori WHERE id_masjid = '$id_masjid'";
        $result2 = mysqli_query($bd2, $sql_search3) or die ("Error :" . mysqli_error($bd2));
    }
}


// Store the options in an array
$options = array();

// Iterate through the results and add options to the array
while ($row = mysqli_fetch_assoc($result2)) {
    $options[] = array(
        'value' => $row['id_jenisinventori'],
        'value2' => $row['jenis_inventori']
    );
}

// Close the statement
//mysqli_stmt_close($stmt);

// Close the database connection
//mysqli_close($bd2);

// Return the options as a JSON-encoded response
echo json_encode($options);

?>
