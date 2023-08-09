<?php
	include("../connection/connection.php");
	//require_once('../connection/connection.php'); 
	if (isset($_POST['delete']) && isset($_POST['del']))
	//echo 'del';
	{
	$id_kerosakan=$_POST['del'];

	// Delete data in mysql from row that has this id
	$sqldel="DELETE FROM sej6x_data_kerosakkan WHERE id_kerosakan='$id_kerosakan' ";
	$result=mysqli_query($bd2,$sqldel);

	if($result){
	header('Location: ../utama.php?view=admin&action=maklumatkerosakan&sideMenu=masjid');
	 }
	echo "error"; 
	}
?>


