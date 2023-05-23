<?php
include("../connection/connection.php");

// Connect to server and select database.
   if(!empty($_POST))
    {	
	$view=$_POST['view'];
	$user_id=$_POST['user_id'];
	
	$nama_penuh=trim(strtoupper($_POST['nama_penuh'])," ");
	$no_ic=mysql_real_escape_string($_POST['no_ic']);
	$no_hp=mysql_real_escape_string($_POST['no_hp']);
	$umur=$_POST['umur'];
	
	$tarikh_lahir=mysql_real_escape_string($_POST['tarikh_lahir']);
	$jantina=mysql_real_escape_string($_POST['jantina']);
	$bangsa=$_POST['bangsa'];
	$warganegara=$_POST['warganegara'];
	$status_perkahwinan=$_POST['status_perkahwinan'];
	
	$pekerjaan=mysql_real_escape_string(strtoupper($_POST['pekerjaan']));
	$tempoh_tinggal=mysql_real_escape_string(strtoupper($_POST['tempoh_tinggal']));
	$zon_qariah=$_POST['zon_qariah'];
	$alamat_terkini=mysql_real_escape_string(strtoupper($_POST['alamat_terkini']));
	$id_negeri=$_POST['id_negeri'];
	
	$id_daerah=$_POST['id_daerah'];
	$poskod=mysql_real_escape_string($_POST['poskod']);
	$solat_jumaat=$_POST['solat_jumaat'];
	$warga_emas=$_POST['warga_emas'];
	 
	$kuiri = "SELECT * FROM sej6x_data_peribadi WHERE no_ic='$no_ic'";
	$kuirirun = mysql_query($kuiri,$bd);
	$row=mysql_num_rows($kuirirun);
	
	if($row>0)
	{
		?>
		<script>
			alert('No Kad Pengenalan Sudah Digunakan');
			window.location.href='../utama.php?view=<?php echo $view;?>&action=pendaftaran_ahli_qariah';
		</script>
		<?php
	}
	else if($row==0)
	{
		$sql = "INSERT INTO sej6x_data_peribadi(id_masjid, nama_penuh, no_ic,tarikh_lahir, warganegara, umur, bangsa, jantina,status_perkahwinan, status, tahap_pendidikan, sekolah_institusi, no_hp, no_rumah, alamat_terkini, poskod, id_daerah, id_negeri, zon_qariah, tempoh_tinggal,bil_tanggungan, data_umum,solat_jumaat,warga_emas,data_ajk,data_pegawai,data_undi, data_asnaf, data_ibutunggal, data_anakyatim, data_cerai, data_kematian, data_khairat, data_nikah, data_sakit, data_oku, id_suami, id_bapa, id_ibu, pekerjaan, majikan, pendapatan, last_added,added_by)
		
	VALUES($id_masjid,'$nama_penuh','$no_ic','$tarikh_lahir','$warganegara','$umur','$bangsa','$jantina','$status_perkahwinan','-1','-1','0','$no_hp','0','$alamat_terkini','$poskod','$id_daerah','$id_negeri','$zon_qariah','$tempoh_tinggal','-1','0','$solat_jumaat','$warga_emas','0','0','0','0','0','0','0','0','0','0','0','0','-1','-1','-1','$pekerjaan','0','0',NOW(),'0')";

		$sqlquery=mysql_query($sql,$bd);
		
		$kuiri = "SELECT * FROM sej6x_data_peribadi WHERE no_ic=$no_ic";
		$kuirirun = mysql_query($kuiri,$bd);
		$run = mysql_fetch_array($kuirirun);
		
		$ID = $run['id_data'];
		
		$number=count($_POST["nama_tanggungan"]);
		if($number>0)
		{
			for($i=0;$i<$number;$i++)
			{
				echo $sql1 = "INSERT INTO sej6x_data_anakqariah (id_qariah,id_masjid,nama_penuh,no_ic,tarikh_lahir,no_tel,hubungan,status_oku,status_kahwin,status_sakit,status_asnaf) VALUES ('$ID','$id_masjid','".strtoupper($_POST["nama_tanggungan"][$i])."','".$_POST["ic_tanggungan"][$i]."','".$_POST["tarikh_lahir_tanggungan"][$i]."','".$_POST["tel_tanggungan"][$i]."','".strtoupper($_POST["hubungan_tanggungan"][$i])."','" . $_POST["tanggung_oku"][$i] . "','" . $_POST["tanggung_kahwin"][$i] . "','" . $_POST["tanggung_sakitkronik"][$i] . "','" . $_POST["tanggung_asnaf"][$i] . "')";
				$sqlquery1=mysql_query($sql1,$bd);
				
				if($sqlquery1)
				{
					echo "MASUK";
				//	header("location: ../utama.php?view=".$view."&action=pendaftaran_ahli_qariah"); 
				}
				else{ echo "ERROR"; }
			}
		}
		
		$target_dir = "fail_kariah/".$_POST['kod_masjid_form'].'/';
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$jenis_fail = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		$target_file = $target_dir . $no_ic . '.' . $jenis_fail;
		
		// Check file size
		//if ($_FILES["fileToUpload"]["size"] > 1500000) {
    	//echo "Maaf, saiz fail terlalu besar, sila kecilkan.";
    	//$uploadOk = 0;
		//}
		// Allow certain file formats
		if($jenis_fail != "jpg" && $jenis_fail != "png" && $jenis_fail != "jpeg"
		   && $jenis_fail != "gif" && $jenis_fail != "pdf") {
    	$msg_upload = "Maaf, hanya jenis fail PDF, JPG, JPEG, PNG & GIF dibenarkan.";
    	$uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
    	$msg_upload = "Maaf, fail anda tidak dapat dimuat-naik.";
			// if everything is ok, try to upload file
		} else {
    	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $msg_upload = "Fail ". basename( $_FILES["fileToUpload"]["name"]). " berjaya dimuat-naik.";
    	} else {
        $msg_upload = "Maaf, terdapat ralat pada proses muat-naik fail, sila cuba lagi.";
    	}
}
		if($sqlquery)
		{
			header("location: ../utama.php?view=".$view."&action=pendaftaran_ahli_qariah&msg_upload=".$msg_upload); 
		}
	}	


}
?> 
