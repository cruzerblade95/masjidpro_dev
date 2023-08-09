<?php
include("../connection/connection.php");
//require_once('../connection/connection.php'); 
if (isset($_POST['delete']) && isset($_POST['passdel']))
{
	$id=$_POST['passdel'];
	
	// Delete data in mysql from row that has this id
	$sql="DELETE FROM minit_mesyuarat WHERE id_mesyuarat='$id'";
	$result=mysqli_query($bd2,$sql);
	
	$sql1="SELECT * FROM kehadiran_mesyuarat WHERE id_mesyuarat='$id'";
	$sqlquery1=mysqli_query($bd2,$sql1);
	while($data1=mysqli_fetch_array($sqlquery1))
	{
		$id_kehadiran=$data1['id_kehadiran'];
		$del_sql="DELETE FROM kehadiran_mesyuarat WHERE id_kehadiran='$id_kehadiran'";
		$del_query=mysqli_query($bd2,$del_sql);
	}
	
	echo $sql2="SELECT * FROM perkara_mesyuarat WHERE id_mesyuarat='$id'";
	$sqlquery2=mysqli_query($bd2,$sql2);
	while($data2=mysqli_fetch_array($sqlquery2))
	{
		$id_perkara=$data2['id_perkara'];
		$del_sql2="DELETE FROM perkara_mesyuarat WHERE id_perkara='$id_perkara'";
		$del_query2=mysqli_query($bd2,$del_sql2);
	}
	

	if($result)
	{
		header('Location: ../utama.php?view=admin&action=suratnotis');  
	} 
}
?>


