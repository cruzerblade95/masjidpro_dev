<?php
include("../connection/connection.php");

$id_selenggara=$_POST['id_selenggara'];
$tarikh_selenggara=$_POST['tarikh_selenggara'];
$masa_selenggara=$_POST['masa_selenggara'];
$pilihan_selenggara=$_POST['pilihan_selenggara'];
$catatan=$_POST['catatan'];

if($_POST['id_pic']==1) {
    $id_vendor = $_POST['vendor_selenggara'];
    $query="UPDATE sej6x_data_selenggara SET id_vendor='$id_vendor',tarikh_selenggara='$tarikh_selenggara',masa_selenggara='$masa_selenggara',pilihan_selenggara='$pilihan_selenggara',catatan='$catatan' WHERE id_selenggara='$id_selenggara' ";
}
else if($_POST['id_pic']==2)
{
    echo $id_dataajk = $_POST['ajk_selenggara'];
    $query="UPDATE sej6x_data_selenggara SET id_dataajk='$id_dataajk',tarikh_selenggara='$tarikh_selenggara',masa_selenggara='$masa_selenggara',pilihan_selenggara='$pilihan_selenggara',catatan='$catatan' WHERE id_selenggara='$id_selenggara' ";

}
//$id_lantikan=$_POST['id_lantikan'];

	$test=mysqli_query($bd2,$query);
	if($test)
	{
		    header("location: ../utama.php?view=admin&action=maklumatselenggara"); 
	}
	else
	{
		echo mysql_error();
	}

//}


?>