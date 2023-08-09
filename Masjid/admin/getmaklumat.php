<?php 
require_once('../connection/connection.php');
// Connect to server and select database.

$id=intval($_GET['id']);

$sql = "SELECT * FROM approve_qariah WHERE id='$id'";
$sqlquery = mysqli_query($bd2, $sql);
$data = mysqli_fetch_array($sqlquery);

$sql2 = "SELECT * FROM approve_anak WHERE id_qariah = '$id'";
$sqlquery2 = mysqli_query($bd2, $sql2);
$data2 = mysqli_fetch_array($sqlquery2);

?>
<div class="row">
	<div class="col-lg-12">
		<center><h4><u>Maklumat Ahli Kariah</u></h4></center>
	</div>
</div>
<div class="row">
	<div class="col-lg-4">
			<div class="form-group">
				<b>Nama Penuh</b>
				<input class="form-control" name="nama_penuh" id="nama_penuh" value="<?php echo $data['nama_penuh'];?>" disabled>
			</div>
			<div class="form-group">
				<b>No. K/P</b>
				<input class="form-control" name="no_ic" id="no_ic" value="<?php echo $data['no_ic'];?>" disabled>	
			</div>
			 <div class="form-group">
				<b>No Telefon</b>
				<input class="form-control" name="no_hp" id="no_hp" value="<?php echo $data['no_tel'];?>" disabled>
			</div>
			<div class="form-group">
				<b>Umur</b>
				<input class="form-control" name="umur" id="umur" value="<?php echo $data['umur'];?>" disabled>
			</div>
			 <div class="form-group">
				<b>Tarikh Lahir</b>
				<input type="date" class="form-control" name="tarikh_lahir" id="tarikh_lahir" value="<?php echo $data['tarikh_lahir'];?>" disabled>
			</div>
			 <div class="form-group">
				<b>Jantina</b>
				<select class="form-control" name="jantina" id="jantina" disabled>
					<option value="">Sila Pilih</option>							
					<option value="1" <?php if($data['jantina']=='1') { ?>selected<?php } ?>>Lelaki</option>
					<option value="2" <?php if($data['jantina']=='2') { ?>selected<?php } ?>>Perempuan</option>
				</select>
			</div>
	</div>
	<!-- /.col-lg-4 (nested) -->

	<div class="col-lg-4">	
		<div class="form-group">
			<b>Bangsa</b>
			<select class="form-control" name="bangsa" id="bangsa" disabled>
				<option value="">Sila Pilih</option>
				<option value="1" <?php if($data['bangsa']=='1') { ?>selected<?php } ?>>Melayu</option>
				<option value="2" <?php if($data['bangsa']=='2') { ?>selected<?php } ?>>Cina</option>
				<option value="3" <?php if($data['bangsa']=='3') { ?>selected<?php } ?>>India</option>
				<option value="4" <?php if($data['bangsa']=='4') { ?>selected<?php } ?>>Lain-lain</option>
			</select>
		</div>
		
		<div class="form-group">
			<b>Warganegara</b>
			<select class="form-control" name="warganegara" id="warganegara" disabled>
				<option value="">Sila Pilih</option>							
				<option value="1" <?php if($data['warganegara']=='1') { ?>selected<?php } ?>>Warganegara</option>
				<option value="2" <?php if($data['warganegara']=='2') { ?>selected<?php } ?>>Bukan Warganegara</option>
			</select>
		</div>
			
		<div class="form-group">
			<b>Status Perkahwinan</b>
			<select class="form-control" name="status_perkahwinan" id="status_perkahwinan" disabled>
				<option value="">Sila Pilih</option>
				<option value="1" <?php if($data['status_perkahwinan']=='1') { ?>selected<?php } ?>>Bujang</option>
				<option value="2" <?php if($data['status_perkahwinan']=='2') { ?>selected<?php } ?>>Berkahwin</option>
				<option value="3" <?php if($data['status_perkahwinan']=='3') { ?>selected<?php } ?>>Duda</option>
				<option value="4" <?php if($data['status_perkahwinan']=='4') { ?>selected<?php } ?>>Janda</option>
			</select>
		</div>
			
		<div class="form-group">
			<b>Pekerjaan</b>
			<input class="form-control" name="pekerjaan" id="pekerjaan" value="<?php echo $data['pekerjaan'];?>" disabled>	                  
		</div> 
			
		<div class="form-group">
			<b>Tempoh Tinggal di Kariah</b>
			<input class="form-control" name="tempoh_tinggal" id="tempoh_tinggal" value="<?php echo $data['tempoh_tinggal'];?>" disabled>	                  
		</div> 
			
		<div class="form-group" id="zon">
			<b>Zon Kariah</b>
			<select class="form-control" name="zon_qariah" id="zon_qariah"  disabled>
				<?php 
				$id_zon=$data['zon_qariah'];
				$sql_zon="SELECT * FROM sej6x_data_zonqariah WHERE id_zonqariah='$id_zon'";
				$query_zon=mysql_query($sql_zon,$bd);
				$zon=mysql_fetch_array($query_zon);
				?> 
				<option value="<?php echo $zon['id_zonqariah'];?>" selected><?php echo $zon['no_huruf']." : ".$zon['nama_zon'];?></option>
			</select>
		</div>
	</div>
	<!-- /.col-lg-4 (nested) -->

	<div class="col-lg-4">
		<div class="form-group">
			<b>No Rumah (Alamat Terkini)</b>
			<input class="form-control" name="alamat_terkini" id="alamat_terkini" value="<?php echo $data['no_rumah'];?>" disabled>
		</div>

		<div class="form-group">
			<b>Negeri</b>
			<select class="form-control" name="id_negeri" id="id_negeri" disabled>
				<?php 
				$id_negeri=$data['negeri'];
				$sql_negeri="SELECT * FROM negeri WHERE id_negeri='$id_negeri'";
				$query_negeri=mysql_query($sql_negeri,$bd);
				$negeri=mysql_fetch_array($query_negeri);
				?> 
				<option value="<?php echo $negeri['id_negeri'];?>" selected><?php echo $negeri['name'];?></option>
			</select>
		</div>		

		<div class="form-group" id="daerah">
			<b>Daerah</b>
			<select class="form-control" name="id_daerah" id="id_daerah" disabled>
				<?php 
				$id_daerah=$data['daerah'];
				$sql_daerah="SELECT * FROM daerah WHERE id_daerah='$id_daerah'";
				$query_daerah=mysql_query($sql_daerah,$bd);
				$daerah=mysql_fetch_array($query_daerah);
				?> 
				<option value="<?php echo $daerah['id_daerah'];?>" selected><?php echo $daerah['nama_daerah'];?></option>
			</select>
		</div>

		<div class="form-group">
			<b>Poskod</b>
			<input class="form-control" name="poskod" id="poskod" value="<?php echo $data['poskod'];?>" disabled>	                  
		</div>
	</div>
	<!-- /.col-lg-4 (nested) -->
</div> 
</div>
<!-- /.row (nested) -->

<div class="row">
	<div class="col-lg-12">
		<center><h4><u>Catatan Masjid</u></h4></center>
	</div>
</div>
<div class="row">
	<div class="col-lg-4">
		<div class="form-group">
			<b>Warga Emas</b>
			<select class="form-control" name="warga_emas" id="warga_emas" disabled>
				<option value="">Sila Pilih</option>
				<option value="1" <?php if($data['warga_emas']=='1') { ?>selected<?php } ?>>Ya</option>
				<option value="2" <?php if($data['warga_emas']=='2') { ?>selected<?php } ?>>Tidak</option>
			</select>	            
		</div>
	</div>
	<!-- /.col-lg-4 (nested) -->

	<div class="col-lg-4">	
		<div class="form-group">
			<b>Wajib Solat Jumaat</b>
			<select class="form-control" name="solat_jumaat" id="solat_jumaat" disabled>
				<option value="">Sila Pilih</option>
				<option value="1" <?php if($data['solat_jumaat']=='1') { ?>selected<?php } ?>>Ya</option>
				<option value="2" <?php if($data['solat_jumaat']=='2') { ?>selected<?php } ?>>Tidak</option>
			</select>	            
		</div>
	</div>
	<!-- /.col-lg-4 (nested) -->
	
	<div class="col-lg-4">	
		<div class="form-group">
			<b>OKU</b>
			<select class="form-control" name="oku" id="oku" disabled>
				<option value="">Sila Pilih</option>
				<option value="1" <?php if($data['oku']=='1') { ?>selected<?php } ?>>Ya</option>
				<option value="2" <?php if($data['oku']=='2') { ?>selected<?php } ?>>Tidak</option>
			</select>	            
		</div>
	</div>
</div>
<hr />
<?php $i = 1; do { ?>
<div class="row">
    <div class="col-md-12 form-group"><h4>Maklumat Tanggungan <?php echo($i); ?></h4></div>
</div>
<div class="row">
    <div class="col-md-12 form-group">
        <label>Nama Tanggungan</label>
        <input value="<?php echo($data2['nama_penuh']); ?>" class="form-control" type="text" name="nama_tanggungan[]" placeholder="Nama Penuh" required disabled>
    </div>
    <div class="col-md-4">
        <label>No Kad Pengenalan</label>
        <input value="<?php echo($data2['no_ic']); ?>" class="form-control" type="text" name="ic_tanggungan[]" placeholder="Contoh: 001223011234" minlength="12" maxlength="12" disabled>
    </div>
    <div class="col-md-4">
        <label>Tarikh Lahir</label>
        <input value="<?php echo($data2['tarikh_lahir']); ?>" class="form-control" type="date" name="tarikh_lahir_tanggungan[]" disabled>
    </div>
    <div class="col-md-4">
        <label>No Telefon</label>
        <input value="<?php echo($data2['no_tel']); ?>" class="form-control" type="text" name="tel_tanggungan[]" disabled>
    </div>
    <div class="col-md-4">
        <label>Hubungan</label>
        <input value="<?php echo($data2['hubungan']); ?>" class="form-control" type="text" name="hubungan_tanggungan[]" required disabled>
    </div>
    <div class="col-md-4">
        <label>OKU</label>
        <select class="form-control" type="text" name="tanggung_oku[]" requiredX disabled>
            <option value="0">Sila Pilih</option>
            <option value="Y" <?php if($data2['status_oku']=='Y') { ?>selected<?php } ?>>Ya</option>
            <option value="N" <?php if($data2['status_oku']=='N') { ?>selected<?php } ?>>Tidak</option>
        </select>
    </div>
    <div class="col-md-4">
        <label>Status Kahwin</label>
        <select class="form-control" type="text" name="tanggung_kahwin[]" requiredX disabled>
            <option value="0">Sila Pilih</option>
            <option value="1" <?php if($data2['status_kahwin']=='1') { ?>selected<?php } ?>>Bujang</option>
            <option value="2" <?php if($data2['status_kahwin']=='2') { ?>selected<?php } ?>>Berkahwin</option>
            <option value="3" <?php if($data2['status_kahwin']=='3') { ?>selected<?php } ?>>Duda</option>
            <option value="4" <?php if($data2['status_kahwin']=='4') { ?>selected<?php } ?>>Janda</option>
            <option value="5" <?php if($data2['status_kahwin']=='5') { ?>selected<?php } ?>>Ibu Tunggal</option>
        </select>
    </div>
    <div class="col-md-4">
        <label>Sakit Kronik</label>
        <select class="form-control" type="text" name="tanggung_sakitkronik[]" requiredX disabled>
            <option value="0">Sila Pilih</option>
            <option value="Y" <?php if($data2['status_sakitkronik']=='Y') { ?>selected<?php } ?>>Ya</option>
            <option value="N" <?php if($data2['status_sakitkronik']=='N') { ?>selected<?php } ?>>Tidak</option>
        </select>
    </div>
    <div class="col-md-4">
        <label>Asnaf</label>
        <select class="form-control" type="text" name="tanggung_asnaf[]" requiredX disabled>
            <option value="0">Sila Pilih</option>
            <option value="Y" <?php if($data2['status_asnaf']=='Y') { ?>selected<?php } ?>>Ya</option>
            <option value="N" <?php if($data2['status_asnaf']=='N') { ?>selected<?php } ?>>Tidak</option>
        </select>
    </div>
</div>
<?php $i++; } while($data2 = mysqli_fetch_array($sqlquery2)); ?>
<div class="modal-footer">			  
	<button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
</div>