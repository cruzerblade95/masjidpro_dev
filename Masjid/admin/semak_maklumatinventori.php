<?php

$itemValue = $_GET['itemValue'];
getItemDetails($itemValue);
function getItemDetails($itemValue) {

    // Prepare and execute a query to retrieve item details
    $q = "SELECT a.nama_peralatan, b.jenis_inventori as jenis_peralatan FROM sej6x_data_inventori a LEFT JOIN sej6x_data_jenisinventori b ON a.jenis_peralatan = b.id_jenisinventori WHERE a.id_inventori = '$itemValue'";
    $stmt = mysqli_prepare($bd2, $q);
//    mysqli_stmt_bind_param($stmt,"i", $itemValue);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $nama_peralatan, $jenis_peralatan);

    // Create a new XML document
    $xml = new DOMDocument('1.0', 'UTF-8');

    // Create the root element
    $itemDetails = $xml->createElement('itemDetails');
    $xml->appendChild($itemDetails);


    /// Fetch the result
    if (mysqli_stmt_fetch($stmt)) {
        // Create XML elements for the item details
        $nameElement = $xml->createElement('name', $nama_peralatan);
        $typeElement = $xml->createElement('type', $jenis_peralatan);

        // Append the elements to the root element
        $itemDetails->appendChild($nameElement);
        $itemDetails->appendChild($typeElement);

    }

    // Set the response header to indicate XML content
    header('Content-Type: application/xml');

    // Output the XML
    echo $xml->saveXML();
    // Close the database connection
    mysqli_stmt_close($stmt);
    mysqli_close($bd2);

}
?>