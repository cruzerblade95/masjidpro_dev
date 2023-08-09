<?php
include("../connection/connection.php");

	//if(isset($_POST['update']))
	//{
	//	echo"masuk";
		
	   $id=$_POST['id'];
	   $id_qariah=$_POST['id_qariah'];
	  
	  $sql="SELECT * FROM sej6x_data_anakyatim WHERE id_anakqariah='$id'";
	  $sqlquery=mysql_query($sql,$bd);
	  $row=mysql_num_rows($sqlquery);
	  
	  if($row>0)
	  {
			echo "<script>window.alert('Maklumat Individu ini telah berdaftar Sebagai Anak Yatim');window.location.href='http://www.masjidpro.com/Masjid/utama.php?view=admin&action=senarai_anakyatim';</script>";
	  }
	  else if($row==0)
	  {	 
	   mysql_select_db($mysql_database, $bd);
       $query="INSERT INTO sej6x_data_anakyatim (id_masjid,id_qariah,id_anakqariah) VALUES ('$id_masjid','$id_qariah','$id')";
    
	

$test=mysql_query($query, $bd);
	if($test)
	{
		    header("location: ../utama.php?view=admin&action=senarai_anakyatim"); 
	}
	else
	{
		echo mysql_error();
	}
	  }
//}


?>