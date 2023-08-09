<?php
// Assuming you have established a database connection already

if (isset($_GET['id_peralatan'])) {
    $selectedIdPeralatan = $_GET['id_peralatan'];

    // Perform a query to fetch additional data based on the selected "id_peralatan"
    $sql = "SELECT kuantiti_unit, id_penyelenggara FROM sej6x_data_inventori WHERE id_inventori = $selectedIdPeralatan";
    $result = mysqli_query($bd2, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);

        // Prepare the response data as an associative array
        $responseData = array(
            'kuantiti_unit' => $row['kuantiti_unit'],
            'id_penyelenggara' => $row['id_penyelenggara']
        );
        
        // Send the response back to the client as JSON
        header('Content-Type: application/json');
        echo json_encode($responseData);
    } else {
        // Handle the case when the query fails
        echo json_encode(array('error' => 'Unable to fetch data'));
    }
} else {
    // Handle the case when the "id_peralatan" parameter is not set
    echo json_encode(array('error' => 'Invalid request'));
}
?>