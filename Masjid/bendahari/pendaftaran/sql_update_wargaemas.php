<?php
include("../connection/connection.php");

	//if(isset($_POST['update']))
	//{
	//	echo"masuk";
		
	   $id_data=$_POST['id_data'];
	   $nama_penuh=$_POST['nama_penuh'];
	    $no_ic=$_POST['no_ic'];
		 $no_hp=$_POST['no_hp'];
		  $umur=$_POST['umur'];
		   $tarikh_lahir=$_POST['tarikh_lahir'];
		    $jantina=$_POST['jantina'];
			 $bangsa=$_POST['bangsa'];
			 
			   $warganegara=$_POST['warganegara'];
		    $status_perkahwinan=$_POST['status_perkahwinan'];
			 $pekerjaan=$_POST['pekerjaan'];
			 
	
	   	    $tempoh_tinggal=$_POST['tempoh_tinggal'];
		    $zon_qariah=$_POST['zon_qariah'];
			 $alamat_terkini=$_POST['alamat_terkini'];
	   
	   
	        $id_negeri=$_POST['id_negeri'];
		    $id_daerah=$_POST['id_daerah'];
			 $poskod=$_POST['poskod'];
			 
			  mysql_select_db($mysql_database, $bd);
       
    
     $query="UPDATE sej6x_data_peribadi set nama_penuh='$nama_penuh',no_ic='$no_ic',no_hp='$no_hp',umur='$umur',
	 tarikh_lahir='$tarikh_lahir',jantina='$jantina',bangsa='$bangsa',warganegara='$warganegara',status_perkahwinan='$status_perkahwinan',pekerjaan='$pekerjaan',tempoh_tinggal='$tempoh_tinggal',zon_qariah='$zon_qariah',alamat_terkini='$alamat_terkini',id_negeri='$id_negeri',id_daerah='$id_daerah',poskod='$poskod'
	  where id_data='$id_data' ";
    
	

$test=mysql_query($query, $bd);
	if($test)
	{
		    header("location: ../utama.php?view=senarai_wargaemas"); 
	}
	else
	{
		echo mysql_error();
	}

//}


?>