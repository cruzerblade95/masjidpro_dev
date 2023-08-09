<?php 
include ('../connection/connection.php');

$ID=$_GET['ID'];

$sql="SELECT a.ID 'ID', a.nama_penuh 'nama_penuh', a.no_ic 'no_ic', a.tarikh_lahir 'tarikh_lahir', a.no_tel 'no_tel', a.hubungan 'hubungan', b.nama_penuh 'nama_kariah', b.no_ic 'ic_kariah' FROM sej6x_data_anakqariah a, sej6x_data_peribadi b WHERE a.ID='$ID' AND a.id_masjid='$id_masjid' AND a.id_qariah=b.id_data";
$sqlquery=mysql_query($sql,$bd);
$data=mysql_fetch_array($sqlquery);
?>
<div class="col-lg-12">
	<div class="row">
		<div class="col-lg-12">
			<div class="form-group">
				<div class="alert alert-info">
					<div align="center">  
						<label>Nama Kariah :</label> <?php echo $data['nama_kariah'];?>
					</div>
					<div align="center"> 
						<label>No K/P Kariah:</label> <?php echo $data['ic_kariah'];?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="form-group">
			<table class="table table-bordered" id="myTable">
				<tr>
					<th align="middle">Bil</th>
					<th>Nama Tanggungan</th>
					<th>No Kad Pengenalan</th>
					<th>Tarikh Lahir</th>
					<th>No Telefon</th>
					<th>Hubungan</th>
				</tr>
				<tr>
					<td align="middle">1</td>
					<td><input class="form-control" type="text" name="nama_tanggungan" placeholder="Nama Penuh" value="<?php echo $data['nama_penuh'];?>" required></td>
					<td><input class="form-control" type="text" name="ic_tanggungan" placeholder="Contoh: 001223011234" minlength="12" maxlength="12" value="<?php echo $data['no_ic'];?>" required></td>
					<td><input class="form-control" type="date" name="tarikh_lahir_tanggungan" value="<?php echo $data['tarikh_lahir'];?>" required></td>
					<td><input class="form-control" type="text" name="tel_tanggungan" value="<?php echo $data['no_tel'];?>" requiredX></td>
					<td><input class="form-control" type="text" name="hubungan_tanggungan" value="<?php echo $data['hubungan'];?>" required></td>
					<input type="hidden" name="id" value="<?php echo $data['ID'];?>">
				</tr>
			</table>
		</div>
	</div>
</div>