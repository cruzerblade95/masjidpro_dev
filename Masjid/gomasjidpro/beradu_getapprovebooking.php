<?php

if ($_GET['booking'] != NULL && is_numeric($_GET['booking']))

{
    $id_booking=$_GET['booking'];

    // Set status_tempah=2 in mysql from row that has this id
    $sqlreject="UPDATE beradu_booking SET status_checkout ='1' WHERE id_booking ='$id_booking' ";
    $query_reject = mysqli_query($bd2, $sqlreject) or die ("sql error".$sqlreject.mysqli_error($bd2));

    echo "<script type='text/javascript'>";
    echo "alert('PERMOHONAN TEMPAHAN DILULUSKAN')";
    echo "</script>";
    echo "<script>document.location.href='utama.php?view=admin&action=gomasjidpro&page=beradu_urus_tempahan'</script>";

}
?>
