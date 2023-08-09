<?php
include("../connection/connection.php");

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
	  
	  $sql="SELECT * FROM sej6x_data_anakqariah WHERE id_qariah='$id_data'";
	  $sqlquery=mysql_query($sql,$bd);
	  $row=mysql_num_rows($sqlquery);
	  
	  $number=count($_POST["nama_tanggungan"]);
		
		if($row>=$number)
		{
			for($i=0;$i<$number;$i++)
			{
				$sql1="UPDATE sej6x_data_anakqariah set nama_penuh='".trim($_POST["nama_tanggungan"][$i]," ")."', no_ic='".$_POST["ic_tanggungan"][$i]."', tarikh_lahir='".$_POST["tarikh_lahir_tanggungan"][$i]."', no_tel='".$_POST["tel_tanggungan"][$i]."', hubungan='".$_POST["hubungan_tanggungan"][$i]."' WHERE ID='".$_POST["id_tanggungan"][$i]."'";
				$sqlquery1=mysql_query($sql1,$bd);
			}
		}
		else if($number>$row)
		{
			for($i=0;$i<$row;$i++)
			{
				$sql1="UPDATE sej6x_data_anakqariah set nama_penuh='".trim($_POST["nama_tanggungan"][$i]," ")."', no_ic='".$_POST["ic_tanggungan"][$i]."', tarikh_lahir='".$_POST["tarikh_lahir_tanggungan"][$i]."', no_tel='".$_POST["tel_tanggungan"][$i]."', hubungan='".$_POST["hubungan_tanggungan"][$i]."' WHERE ID='".$_POST["id_tanggungan"][$i]."'";
				$sqlquery1=mysql_query($sql1,$bd);
			}
			for($i=$row;$i<$number;$i++)
			{
				echo $sql2="INSERT INTO sej6x_data_anakqariah(id_qariah,id_masjid,nama_penuh,no_ic,tarikh_lahir,no_tel,hubungan) VALUES ('$id_data','$id_masjid','".trim($_POST["nama_tanggungan"][$i]," ")."','".$_POST["ic_tanggungan"][$i]."','".$_POST["tarikh_lahir_tanggungan"][$i]."','".$_POST["tel_tanggungan"][$i]."','".$_POST["hubungan_tanggungan"][$i]."')";
				$sqlquery2=mysql_query($sql2,$bd);
			}
		}
	

	$test=mysql_query($query, $bd);
	if($test)
	{
		   header("location: ../utama.php?view=admin&action=pendaftaran_ahli_qariah"); 
	}
	else
	{
		echo mysql_error();
	}



?>