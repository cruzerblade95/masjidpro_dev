<?php

if ($_GET['beradu'] != NULL && is_numeric($_GET['beradu']))

{
    $id_prod=$_GET['beradu'];

    // Delete data in mysql from row that has this id
    $sqldel="DELETE FROM products_ecomasjid WHERE id_produk ='$id_prod' ";
    $query_del = mysqli_query($bd2, $sqldel) or die ("sql error".$sqldel.mysqli_error($bd2));

    echo "<script>document.location.href='utama.php?view=admin&action=gomasjidpro&page=beradu_list_penginapan'</script>";

}
?>