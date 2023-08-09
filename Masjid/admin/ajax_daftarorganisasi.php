<?php
include("../connection/connection.php");
include("../fungsi.php");
// Get the selected option from the AJAX request
$id_jawatan = $_POST['option'];


$stmt = "SELECT id_jawatankuasa, jawatan, ajk_biro FROM jawatankuasa_organisasi WHERE kat_jawatankuasa = '$id_jawatan' AND id_masjid = '$id_masjid'";
$result= mysqli_query($bd2, $stmt) or die(mysqli_error($bd2));

// Store the options in an array
$options = array();

// Iterate through the results and add options to the array
while ($row = mysqli_fetch_assoc($result)) {
    $options[] = array(
        'value' => $row['id_jawatankuasa'],
        'label' => $row['jawatan'],
        'label2' => $row['ajk_biro']
    );
}

// Close the statement
//mysqli_stmt_close($stmt);

// Close the database connection
//mysqli_close($bd2);

// Return the options as a JSON-encoded response
echo json_encode($options);

?>
