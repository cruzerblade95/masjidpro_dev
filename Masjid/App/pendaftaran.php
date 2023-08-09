<?php
	include('connection/connection_app.php');
	
	
	if(isset($_POST['simpan']))
	{
		$id_masjid=$_POST['id_masjid'];
		
		$nama_penuh=trim(($_POST['nama_penuh'])," ");
		$no_ic=mysql_real_escape_string($_POST['no_ic']);
		$no_hp=mysql_real_escape_string($_POST['no_hp']);
		$umur=$_POST['umur'];
		
		$tarikh_lahir=mysql_real_escape_string($_POST['tarikh_lahir']);
		$jantina=mysql_real_escape_string($_POST['jantina']);
		$bangsa=$_POST['bangsa'];
		$warganegara=$_POST['warganegara'];
		$status_perkahwinan=$_POST['status_perkahwinan'];
		
		$pekerjaan=mysql_real_escape_string($_POST['pekerjaan']);
		$tempoh_tinggal=mysql_real_escape_string($_POST['tempoh_tinggal']);
		$zon_qariah=$_POST['zon_qariah'];
		$alamat_terkini=mysql_real_escape_string($_POST['alamat_terkini']);
		$id_negeri=$_POST['id_negeri'];
		
		$id_daerah=$_POST['id_daerah'];
		$poskod=mysql_real_escape_string($_POST['poskod']);
		$solat_jumaat=$_POST['solat_jumaat'];
		$warga_emas=$_POST['warga_emas'];
		
		mysql_select_db($mysql_database, $bd);
  
		$kuiri="SELECT * FROM sej6x_data_peribadi WHERE no_ic='$no_ic' AND id_masjid='$id_masjid'";
		$kuirirun=mysql_query($kuiri,$bd);
		$run=mysql_num_rows($kuirirun);
		if($run>0)
		{
			echo 
			"<script>
			alert('Maklumat tuan/puan telah berdaftar di dalam Sistem MasjidPro.');
			</script>";
		}
		else if($run==0)
		{
			$sql="SELECT * FROM approve_qariah WHERE no_ic='$no_ic' AND id_masjid='$id_masjid'";
			$sqlquery=mysql_query($sql,$bd);
			$row=mysql_num_rows($sqlquery);
			if($row>0)
			{
				echo
				"<script>
				alert('Maklumat tuan/puan sedang diproses untuk pengesahan oleh pihak masjid.');
				</script>";
			}
			else if($row==0)
			{
				$sql1 ="INSERT INTO approve_qariah
				(id_masjid,nama_penuh,no_ic,tarikh_lahir,no_tel,umur,jantina,bangsa,warganegara,status_perkahwinan,pekerjaan,tempoh_tinggal,zon_qariah,no_rumah,negeri,daerah,poskod,warga_emas,solat_jumaat,oku)
				VALUES
				('$id_masjid','$nama_penuh','$no_ic','$tarikh_lahir','$no_hp','$umur','$jantina','$bangsa','$warganegara','$status_perkahwinan','$pekerjaan','$tempoh_tinggal','$zon_qariah','$alamat_terkini','$id_negeri','$id_daerah','$poskod','$warga_emas','$solat_jumaat','$oku')
				";
				
				mysql_query($sql1,$bd);
				{
					$sql3 = "SELECT * FROM approve_qariah WHERE no_ic='$no_ic'";
					$sqlquery3 = mysql_query($sql3,$bd);
					$data3=mysql_fetch_array($sqlquery3);
					
					$ID=$data3['id'];
					
					$number=count($_POST["nama_tanggungan"]);
					if($number>0)
					{
						for($i=0;$i<$number;$i++)
						{
							$sql2 = "INSERT INTO approve_anak(id_qariah,id_masjid,nama_penuh,no_ic,tarikh_lahir,no_tel,hubungan,status_oku,status_kahwin,status_sakitkronik,status_asnaf) VALUES ('$ID','$id_masjid','" . trim($_POST["nama_tanggungan"][$i], " ") . "','" . $_POST["ic_tanggungan"][$i] . "','" . $_POST["tarikh_lahir_tanggungan"][$i] . "','" . $_POST["tel_tanggungan"][$i] . "','" . $_POST["hubungan_tanggungan"][$i] . "','" . $_POST["tanggung_oku"][$i] . "','" . $_POST["tanggung_kahwin"][$i] . "','" . $_POST["tanggung_sakitkronik"][$i] . "','" . $_POST["tanggung_asnaf"][$i] . "')";
							$sqlquery2=mysql_query($sql2,$bd);
							
							if($sqlquery2)
							{
								echo "<script>alert('Maklumat Berjaya Dihantar');</script>";
							}
						}
					}
					else
					{
						echo "<script>alert('Maklumat Berjaya Dihantar');</script>";
					}
				}
			}
		}
		
		
	}
?>
<script>
alert('Maklumat anda dilindungi oleh Akta 709(Akta Perlindungan Data Peribadi 2010). Pihak Masjid bertanggungjawab & memberi jaminan atas setiap data maklumat yang anda berikan adalah selamat');
</script>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Masjid Pro</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="../vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="../vendors/jqvmap/dist/jqvmap.min.css">

	<link rel="stylesheet" href="../vendors/chosen/chosen.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800" rel='stylesheet' type='text/css'>

	<!-- Font Awesome -->
	<script src="https://kit.fontawesome.com/b5589dbb40.js" crossorigin="anonymous"></script>
	<script src="../js/jquery-3.4.1.js"></script>
</head>

<body style="background-color:#4e4e52">
<br>
<div class="col-lg-2">
</div>
<div class="col-lg-8">
	<div class="card">
		<div class="card-header">
		<br>
			<center>
				<h2><b>Pendaftaran Ahli Kariah</b></h2>
				<h4><strong><?php echo $nama_masjid; ?></strong></h4>
			</center>
		</div>
		<div class="card-body">
			<form method="post" id="insert_form" action="pendaftaran.php">
			<?php 
			include("connection.php");

			$sql_search="SELECT id_data,nama_penuh,no_ic,umur,alamat_terkini FROM sej6x_data_peribadi WHERE id_masjid='$id_masjid'"; 
			$result = mysql_query($sql_search) or die ("Error :".mysql_error());  
			?>          
			<div class="row">
				<div class="col-lg-12">
					<h4 align="center"><u>Maklumat Ahli</u></h4>
				<div>
			</div>
			<hr>
			<div class="row">
				<div class="col-lg-4">
					<div class="form-group">
						<label style="color: red">*</label><b>Nama Penuh</b>
						<input class="form-control" name="nama_penuh" id="nama_penuh" required>
					</div>
					<div class="form-group">
						<label style="color: red">*</label><b>No. K/P</b>
						<input class="form-control" name="no_ic" id="no_ic" placeholder="Contoh: 880528355036" minlength="12" maxlength="12" required onChange="myFunction()">	
					</div>
					<div class="form-group">
						<label style="color: red">*</label><b>No Telefon</b>
						<input class="form-control" name="no_hp" id="no_hp" placeholder="Contoh: 0143159891" required>
					</div>
					<div class="form-group">
						<label style="color: red">*</label><b>Umur</b>
						<input class="form-control" name="umur" id="umur" readonly required>
					</div>
					<div class="form-group">
						<label style="color: red">*</label><b>Tarikh Lahir</b>
						<input class="form-control" name="tarikh_lahir" id="tarikh_lahir" placeholder="Contoh: 1992-05-30" type="date" readonly required>	
					</div>
					<div class="form-group">
					<label style="color: red">*</label><b>Jantina</b>
						<select class="form-control" name="jantina" id="jantina" required>
							<option value="0">Sila Pilih</option>							
							<option value="1">Lelaki</option>
							<option value="2">Perempuan</option>
						</select>
					</div>
				</div>
				<!-- /.col-lg-4 (nested) -->
				<div class="col-lg-4">	
					<div class="form-group">
						<label style="color: red">*</label><b>Bangsa</b>
						<select class="form-control" name="bangsa" id="bangsa" required>
							<option value="0">Sila Pilih</option>
							<option value="1">Melayu</option>
							<option value="2">Cina</option>
							<option value="3">India</option>
							<option value="4">Lain-lain</option>
						</select>
					</div>
					<div class="form-group">
						<label style="color: red">*</label><b>Warganegara</b>
						<select class="form-control" name="warganegara" id="warganegara" required>
							<option value="0">Sila Pilih</option>							
							<option value="1">Warganegara</option>
							<option value="2">Bukan Warganegara</option>
						</select>
					</div>
					<div class="form-group">
						<label style="color: red">*</label><b>Status Perkahwinan</b>
						<select class="form-control" name="status_perkahwinan" id="status_perkahwinan" required>
							<option value="0">Sila Pilih</option>
							<option value="1">Bujang</option>
							<option value="2">Berkahwin</option>
							<option value="3">Duda</option>
							<option value="4">Janda</option>
						</select>
					</div>
					<div class="form-group">
						<label style="color: red">*</label><b>Pekerjaan</b>
						<input class="form-control" name="pekerjaan" id="pekerjaan" required>	                  
					</div> 
					<div class="form-group">
						<label style="color: red">*</label><b>Tempoh Tinggal di Kariah</b>
						<input class="form-control" name="tempoh_tinggal" id="tempoh_tinggal" required>	                  
					</div> 
					
				</div>
				<!-- /.col-lg-4 (nested) -->
				<div class="col-lg-4">
					<div class="form-group">
						<label style="color: red">*</label><b>No Rumah (Alamat Terkini)</b>
						<input class="form-control" placeholder="Contoh: 1842-2 Kampung Selamat" name="alamat_terkini" id="alamat_terkini" required>
					</div>
					<div class="form-group">
								<label style="color: red">*</label><b>Poskod</b> <input
									class="form-control" name="poskod" id="poskod" minlength="5"
									maxlength="5" required>
							</div>
					<div class="form-group">
						<label style="color: red">*</label><b>Negeri</b>
						<select class="form-control" name="id_negeri" id="id_negeri" onChange="showDaerah(this.value)" required>
							<?php
							$sql_negeri = "SELECT * FROM negeri";
							$query_negeri = mysql_query($sql_negeri,$bd);
							
							while($negeri = mysql_fetch_array($query_negeri))
							{
							?>
							<option value="<?php echo $negeri['id_negeri']; ?>"><?php echo $negeri['name']; ?></option>
							<?php
							}
							?>
						</select>
					</div>		
					<div class="form-group" id="daerah">
								<label style="color: red">*</label><b>Daerah</b> <select
									class="form-control" name="id_daerah" id="id_daerah"
									onChange="showMasjid(this.value)" required>
									<option value="0">Pilih Daerah</option>
								</select>
							</div>
							<div class="form-group" id="masjid">
								<label style="color: red">*</label><b>Masjid Kariah</b> <select
									class="form-control" name="id_masjid" id="id_masjid"
									onChange="showZon(this.value)" required>
									<option value="0">Pilih Masjid</option>
								</select>
							</div>
							<div class="form-group" id="zon">
								<label style="color: red">*</label><b>Zon Kariah</b> <select
									class="form-control" name="zon_qariah" id="zon_qariah" required>
									<option value="0">Pilih Zon</option>
								</select>
							</div>
					<br>
					<br>
						Sila isi semua maklumat yang bertanda<label style="color: red">*</label>
				</div>
				<!-- /.col-lg-4 (nested) -->
			</div>
			<!-- /.row (nested) -->
			<hr>
			<div class="row">
				<div class="col-lg-12">
					<h4 align="center"><u>Catatan Masjid</u></h4>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-lg-4">
					<div class="form-group">
						<label style="color: red">*</label><b>Warga Emas</b>
						<select class="form-control" name="warga_emas" id="warga_emas" readonly required>
							<option value="0">Sila Pilih</option>
							<option value="1">Ya</option>
							<option value="2">Tidak</option>
						</select>	            
					</div>
				</div>
				<!-- /.col-lg-4 (nested) -->
				<div class="col-lg-4">	
					<div class="form-group">
						<label style="color: red">*</label><b>Wajib Solat Jumaat</b>
						<select class="form-control" name="solat_jumaat" id="solat_jumaat" required>
							<option value="0">Sila Pilih</option>
							<option value="1">Ya</option>
							<option value="2">Tidak</option>
						</select>	            
					</div>
				</div>
				<!-- /.col-lg-4 (nested) -->
				<div class="col-lg-4">	
					<div class="form-group">
						<label style="color: red">*</label><b>OKU</b>
						<select class="form-control" name="oku" id="oku" required>
							<option value="0">Sila Pilih</option>
							<option value="1">Ya</option>
							<option value="2">Tidak</option>
						</select>	            
					</div>
				</div>
				<!-- /.col-lg-4 (nested) -->
			</div>
			<hr>
			<div class="row">
				<div class="col-lg-12">
					<h4 align="center"><u>Tanggungan Anak Kariah</u></h4>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-lg-12" style="overflow-x:auto;">
					<div class="form-group">
						<table class="table table-bordered" id="myTable">
							<tr>
								<th align="middle">Bil</th>
								<th>Nama Tanggungan</th>
								<th>No Kad Pengenalan</th>
								<th>Tarikh Lahir</th>
								<th>No Telefon</th>
								<th>Hubungan</th>
								<th>Oku</th>
								<th>Status Kahwin</th>
								<th>Sakit Kronik</th>
								<th>Asnaf</th>
								<th></th>
							</tr><!-- <tr style="display:none">
								<td align="middle">1</td>
								<td><input class="form-control" type="text" name="nama_tanggungan[]" placeholder="Nama Penuh" requiredX></td>
								<td><input class="form-control" type="text" name="ic_tanggungan[]" placeholder="Contoh: 001223011234" minlength="12" maxlength="12" requiredX></td>
								<td><input class="form-control" type="date" name="tarikh_lahir_tanggungan[]" requiredX></td>
								<td><input class="form-control" type="text" name="tel_tanggungan[]" requiredX></td>
								<td><input class="form-control" type="text" name="hubungan_tanggungan[]" requiredX></td>
								<td><button type="button" name="add" id="add" onClick="insertRow()" class="btn btn-success">+</button></td>
							</tr> -->
						</table>
						<center>
							<button type="button" name="add" id="add" onClick="insertRow()" class="btn btn-success">+</button>
						</center>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<center>
						<input type="hidden" name="selection" value="<?php echo $url_masjid; ?>">
						<input type="hidden" name="id_masjid" value="<?php echo $id_masjid; ?>">
						<input type="submit" name="simpan" id="simpan" value="Simpan" class="btn btn-success" />  	
					</center>
				</div>
			</div>
			</form>
		</div>
		<!-- /.panel-body -->
	</div>
	<!-- /.panel pnael-info -->
</div>
<!-- /.col-lg-12 -->
</body>
</html>
<script>
function insertRow(){
	var table=document.getElementById("myTable");
	var row=table.insertRow(table.rows.length);
	var bil=(table.rows.length)-1;
	var cell1=row.insertCell(0);
	cell1.style.textAlign="center";
	cell1.innerHTML = bil;

	cell1=row.insertCell(1);
	cell1.innerHTML = "<input class='form-control' type='text' name='nama_tanggungan[]' placeholder='Nama Penuh' requiredX>";

	cell1=row.insertCell(2);
	cell1.innerHTML = "<input class='form-control' type='text' name='ic_tanggungan[]' placeholder='Contoh: 001223011234' minlength='12' maxlength='12' requiredX>";

	cell1=row.insertCell(3);
	cell1.innerHTML = "<input class='form-control' type='date' name='tarikh_lahir_tanggungan[]' requiredX>";

	cell1=row.insertCell(4);
	cell1.innerHTML = "<input class='form-control' type='text' name='tel_tanggungan[]' requiredX>";
	
	cell1=row.insertCell(5);
	cell1.innerHTML = "<input class='form-control' type='text' name='hubungan_tanggungan[]' requiredX>";

	cell1=row.insertCell(6);
	cell1.innerHTML = "<select class='form-control' type='text' name='tanggung_oku[]' requiredX>" +
					  "<option value='0'>Sila Pilih</option>" +
					  "<option value='Y'>Ya</option>" +
					  "<option value='N'>Tidak</option>" +
					  "</select>";

	cell1=row.insertCell(7);
	cell1.innerHTML = "<select class='form-control' type='text' name='tanggung_kahwin[]' requiredX>" +
					  "<option value='0'>Sila Pilih</option>" +
					  "<option value='1'>Bujang</option>" +
					  "<option value='2'>Berkahwin</option>" +
					  "<option value='3'>Duda</option>" +
					  "<option value='4'>Janda</option>" +
					  "<option value='5'>Ibu Tunggal</option>" +
					  "</select>";

  	cell1=row.insertCell(8);
	cell1.innerHTML = "<select class='form-control' type='text' name='tanggung_sakitkronik[]' requiredX>" +
					  "<option value='0'>Sila Pilih</option>" +
					  "<option value='Y'>Ya</option>" +
					  "<option value='N'>Tidak</option>" +
					  "</select>";

  	cell1=row.insertCell(9);
	cell1.innerHTML = "<select class='form-control' type='text' name='tanggung_asnaf[]' requiredX>" +
					  "<option value='0'>Sila Pilih</option>" +
					  "<option value='Y'>Ya</option>" +
					  "<option value='N'>Tidak</option>" +
					  "</select>";

	cell1=row.insertCell(10);
	cell1.innerHTML = "<button class='btn btn-danger btn_remove'onclick='removeRow(this);'>x</button>"; 
}
function removeRow(src){
	var oRow = src.parentElement.parentElement;  
	document.all("myTable").deleteRow(oRow.rowIndex);
} 
function showDaerah(str) {
	//alert("The URL of this page is: " + window.location.href);
	$("#id_daerah").empty();
	$("#id_daerah").append('<option value="0">Pilih Daerah</option>');
	$.getJSON("../xAndroidx/common/getdaerah.php?kodnegeri="+str, function (data) {
		$.each(data.result, function (indexs, values) {
            $("#id_daerah").append('<option value="' + values.id + '">' + values.nama + '</option>');
         });
     });
}

function showMasjid(str) {
	
	$("#id_masjid").empty();
	$("#id_masjid").append('<option value="0">Pilih Masjid</option>');
	$.getJSON("../xAndroidx/common/getmasjid.php?kodnegeri="+$('#id_negeri option:selected').val()+"&koddaerah="+str, function (data) {
		$.each(data.result, function (indexs, values) {
            $("#id_masjid").append('<option value="' + values.id + '">' + values.nama + '</option>');
         });

     });
}

function showZon(str) {
	//alert("The URL of this page is: " + window.location.href);
	$("#zon_qariah").empty();
	$("#zon_qariah").append('<option value="0">Pilih Zon</option>');
	$.getJSON("../xAndroidx/common/getzon.php?kodmasjid="+<?php $id_masjid?>, function (data) {
		$.each(data.result, function (indexs, values) {
            $("#zon_qariah").append('<option value="' + values.id + '">' + values.huruf + " : " + values.nama + '</option>');
         });

     });
}

function myFunction(){
	var tl = document.getElementById('no_ic').value;
	var date = tl.substr(0,6);
	var year = tl.substr(0,2);
	var month = tl.substr(2,2);
	var day = tl.substr(4,2);
	
	if(year > 30)
	{
		year = 19+year;
	}
	else if(year < 31)
	{
		year = 20+year;
	}
	
	var tarikh = year+'-'+month+'-'+day;
	document.getElementById('tarikh_lahir').value = tarikh;
	
	var today = new Date();
	var dd = String(today.getDate()).padStart(2,'0');
	var mm = String(today.getMonth()+1).padStart(2,'0');
	var yyyy = today.getFullYear();
	
	today = yyyy+'-'+mm+'-'+dd;
	
	var umur = parseInt(yyyy) - parseInt(year);
	var umur_bulan = parseInt(mm) - parseInt(month);
	if(umur_bulan < 0 )
	{
		umur = parseInt(umur) - 1;
	}
	else if(umur_bulan == 0 )
	{
		var umur_hari = parseInt(dd) - parseInt(day);
		
		if(umur_hari < 0 ) 
		{
			umur = parseInt(umur) - 1;
		}
	}
	
	document.getElementById('umur').value = umur;
	
	if(umur > 59)
	{
		document.getElementById('warga_emas').selectedIndex = "1";
		//document.getElementById('warga_emas').value = "Ya";
	}
	else if(umur < 60)
	{
		document.getElementById('warga_emas').selectedIndex = "2";
		//document.getElementById('warga_emas').value = "Tidak";
	}
	
}
</script>
<script src="../vendors/jquery/dist/jquery.min.js"></script>
    <script src="../vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../assets/js/main.js"></script>
	<script src="../vendors/chosen/chosen.jquery.min.js"></script>

    <script src="../vendors/chart.js/dist/Chart.bundle.min.js"></script>
    <script src="../assets/js/dashboard.js"></script>
    <script src="../assets/js/widgets.js"></script>
    <script src="../vendors/jqvmap/dist/jquery.vmap.min.js"></script>
    <script src="../vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <script src="../vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>

    <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="../vendors/jszip/dist/jszip.min.js"></script>
    <script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="../vendors/pdfmake/build/vfs_fonts.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <script src="../assets/js/init-scripts/data-table/datatables-init.js"></script>