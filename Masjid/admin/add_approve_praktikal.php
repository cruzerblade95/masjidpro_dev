<?php

include('../connection/connection.php');

$id_praktikal=$_POST['id_praktikal'];

$sql="UPDATE sej6x_data_praktikal SET status=1 WHERE ID='$id_praktikal'";
$sqlquery=mysql_query($sql,$bd);

///$sql="SELECT * FROM sej6x_data_bantuan WHERE id_bantuan='$id_bantuan'";
//$sqlquery=mysql_query($sql,$bd);
//$data=mysql_fetch_array($sqlquery);

//$id_masjid=$data['id_masjid'];
//$nama=$data['nama'];
//$no_ic=$data['no_ic'];
//$tujuan=$data['tujuan'];
//$jumlah=$data['jumlah'];

//$sql1="INSERT INTO sej6x_data_bantuan (id_masjid,nama,no_ic,tujuan,jumlah) VALUES ('$id_masjid','$nama','$no_ic','$tujuan','$jumlah')";
//$sqlquery1=mysql_query($sql1,$bd);

if($sqlquery)
{
    //$sql2="DELETE FROM approve_bantuan WHERE id_bantuan='$id_bantuan'";
    //$sqlquery2=mysql_query($sql2,$bd);

    //if($sqlquery2)
    //{
    header("Location: ../utama.php?view=admin&action=approve_praktikal");
    //}
}
?>
