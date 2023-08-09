<?php
// Assuming you have already established a database connection using mysqli

if (isset($_POST['id_inventori'])) {
    $code = $_POST['id_inventori'];

    // Fetch the appliance details from the database table based on the code
    $query = "SELECT nama_peralatan, jenis_peralatan FROM sej6x_data_inventori WHERE id_inventori = ?";
    $statement = mysqli_prepare($bd2, $query);
    mysqli_stmt_bind_param($statement, "s", $code);
    mysqli_stmt_execute($statement);
    mysqli_stmt_bind_result($statement, $nama_peralatan, $jenis_peralatan);
    mysqli_stmt_fetch($statement);
    mysqli_stmt_close($statement);

    // Create an associative array with the fetched details
    $details = array(
        'name' => $nama_peralatan,
        'type' => $jenis_peralatan
    );

    // Return the JSON-encoded appliance details
    echo json_encode($details);
}
?>
?>