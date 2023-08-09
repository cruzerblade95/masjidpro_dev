<?php

	include('../connection/connection.php');
	
	$id_bantuan = $_GET['id_bantuan'];

	$sql_bantuan = "SELECT * FROM bantuan_zakat WHERE id_bantuan='$id_bantuan'";
	$query_bantuan = mysqli_query($bd2,$sql_bantuan);
	$data_bantuan = mysqli_fetch_array($query_bantuan);
	
	//if(($data_bantuan['id_data']!=NULL) OR ($data_bantuan['ID']!=NULL))
	if($data_bantuan['id_data']!=NULL)
	{
		$id_data = $data_bantuan['id_data'];
		$sql_ic = "SELECT * FROM sej6x_data_peribadi WHERE id_data='$id_data'";
		$query_ic = mysqli_query($bd2,$sql_ic);
		$data_ic = mysqli_fetch_array($query_ic);
	?>
	<form action="" id="form_ic" name="form_ic" class="form-horizontal form-bordered" method="POST">
		<div class="form-body">
			<div class="form-group row">
				<label class="control-label text-right col-md-3">Nama Penuh</label>
				<div class="col-md-9">
					<input type="text" name="nama_penuh" class="form-control" value="<?php echo $data_ic['nama_penuh']; ?>" readonly>
				</div>
			</div>
			<div class="form-group row">
				<label class="control-label text-right col-md-3">No Kad Pengenalan</label>
				<div class="col-md-9">
					<input type="text" name="no_ic" class="form-control" value="<?php echo $data_ic['no_ic']; ?>" readonly>
				</div>
			</div>
			<div class="form-group row">
				<label class="control-label text-right col-md-3">No Telefon</label>
				<div class="col-md-9">
					<input type="text" name="no_hp" class="form-control" value="<?php echo $data_ic['no_hp']; ?>" readonly>
				</div>
			</div>
			<div class="form-group row">
				<label class="control-label text-right col-md-3">Status Perkahwinan</label>
				<div class="col-md-9">
					<select name="status_perkahwinan" class="form-control" readonly>
						<?php if($data_ic['status_perkahwinan'] == 1) { ?><option value="1">Bujang</option><? } ?>
						<?php if($data_ic['status_perkahwinan'] == 2) { ?><option value="2">Berkahwin</option><? } ?>
						<?php if($data_ic['status_perkahwinan'] == 3) { ?><option value="3">Duda</option><? } ?>
						<?php if($data_ic['status_perkahwinan'] == 4) { ?><option value="4">Janda</option><? } ?>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label class="control-label text-right col-md-3">Alamat</label>
				<div class="col-md-9">
					<textarea name="alamat_terkini" class="form-control" readonly><?php echo $data_ic['alamat_terkini']; ?></textarea>
				</div>
			</div>
			<div class="form-group row">
				<label class="control-label text-right col-md-3">Negeri</label>
				<div class="col-md-9">
					<select name="id_negeri" class="form-control" readonly>
						<?php 
						$negeri = $data_ic['id_negeri'];
						$sql_negeri = "SELECT * FROM negeri";
						$query_negeri = mysqli_query($bd2,$sql_negeri);
						
						while($data_negeri = mysqli_fetch_array($query_negeri))
						{
						?>
						<?php if($data_ic['id_negeri']==$data_negeri['id_negeri']) { ?><option value="<?php echo $data_negeri['id_negeri']; ?>"><?php echo $data_negeri['name']; ?></option><?php } ?>
						<? 
						} 
						?>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label class="control-label text-right col-md-3">Daerah</label>
				<div class="col-md-9">
					<select name="id_daerah" class="form-control" readonly>
						<?php 
						$negeri = $data_ic['id_negeri'];
						$sql_daerah = "SELECT * FROM daerah WHERE id_negeri='$negeri'";
						$query_daerah = mysqli_query($bd2,$sql_daerah);
						echo mysqli_num_rows($query_daerah);
						
						while($data_daerah = mysqli_fetch_array($query_daerah))
						{
						?>
						<?php if($data_ic['id_daerah']==$data_daerah['id_daerah']) { ?><option value="<?php echo $data_daerah['id_daerah']; ?>"><?php echo $data_daerah['nama_daerah']; ?></option><?php } ?>
						<? 
						} 
						?>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label class="control-label text-right col-md-3">Poskod</label>
				<div class="col-md-9">
					<input type="text" name="poskod" class="form-control" readonly value="<?php echo $data_ic['poskod']; ?>">
				</div>
			</div>
			<div class="form-group row">
				<label class="control-label text-right col-md-3">Jumlah Tanggungan</label>
				<div class="col-md-9">
					<?php
					$id_qariah = $data_bantuan['id_data'];
					$sql_tanggung = "SELECT * FROM sej6x_data_anakqariah WHERE id_qariah='$id_qariah'";
					$query_tanggung = mysqli_query($bd2,$sql_tanggung);
					$bil_tanggung = mysqli_num_rows($query_tanggung);
					?>
					<input type="number" step="1" name="jumlah_tanggungan" class="form-control" readonly value="<?php echo $bil_tanggung; ?>">
				</div>
			</div>
			<div class="form-group row">
				<label class="control-label text-right col-md-3">Jenis Bantuan</label>
				<div class="col-md-9">
					<input type="text" name="jenis_bantuan" class="form-control" required oninput="this.value = this.value.toUpperCase()" value="<?php echo $data_bantuan['jenis_bantuan']; ?>">
				</div>
			</div>
			<div class="form-group row">
				<label class="control-label text-right col-md-3">Tarikh Bantuan</label>
				<div class="col-md-9">
					<input type="date" name="tarikh_bantuan" class="form-control" required oninput="this.value = this.value.toUpperCase()" value="<?php echo $data_bantuan['tarikh_bantuan']; ?>">
				</div>
			</div>
			<div class="form-group row">
				<label class="control-label text-right col-md-3">Kaedah Bayaran</label>
				<div class="col-md-9">
					<input type="text" name="kaedah_bayar" class="form-control" required oninput="this.value = this.value.toUpperCase()" value="<?php echo $data_bantuan['kaedah_bayar']; ?>">
				</div>
			</div>
			<div class="form-group row">
				<label class="control-label text-right col-md-3">Amaun/Item</label>
				<div class="col-md-9">
					<input type="text" name="amaun_bantuan" class="form-control" required oninput="this.value = this.value.toUpperCase()" value="<?php echo $data_bantuan['amaun']; ?>">
				</div>
			</div>
			<input type="hidden" name="id_bantuan" value="<?php echo $data_bantuan['id_bantuan']; ?>">
			<input type="hidden" name="id_masjid" value="<?php echo $id_masjid; ?>">
			<div class="form-group row">
				<div class="col-md-4 offset-4">
					<center>
					<button type="submit" name="edit_ic" class="btn btn-success">Kemaskini Maklumat</button>
					</center>
				</div>
			</div>
		</div>
	</form>
	<?php
	}
	else if($data_bantuan['id_data']==NULL)
	{
		if($data_bantuan['no_ic']!=NULL)
		{
	?>
<form action="" id="form_passport" name="form_passport" class="form-horizontal form-bordered" method="POST">
		<div class="form-body">
			<div class="form-group row">
				<label class="control-label text-right col-md-3">Nama Penuh</label>
				<div class="col-md-9">
					<input type="text" name="nama_penuh" class="form-control" oninput="this.value = this.value.toUpperCase()" value="<?php echo $data_bantuan['nama_penuh']; ?>" readonly>
				</div>
			</div>
			<div class="form-group row">
				<label class="control-label text-right col-md-3">No Kad Pengenalan</label>
				<div class="col-md-9">
					<input type="text" name="no_ic" class="form-control" oninput="this.value = this.value.toUpperCase()" value="<?php echo $data_bantuan['no_ic']; ?>" readonly>
				</div>
			</div>
			<div class="form-group row">
				<label class="control-label text-right col-md-3">No Telefon</label>
				<div class="col-md-9">
					<input type="text" name="no_tel" class="form-control" value="<?php echo $data_bantuan['no_tel']; ?>" readonly>
				</div>
			</div>
			<div class="form-group row">
				<label class="control-label text-right col-md-3">Status Perkahwinan</label>
				<div class="col-md-9">
					<select name="status_perkahwinan" class="form-control" readonly>
						<?php if($data_bantuan['status_perkahwinan'] == 1) { ?><option value="1" selected="selected">BUJANG</option><? } ?>
						<?php if($data_bantuan['status_perkahwinan'] == 2) { ?><option value="2" selected="selected">BERKAHWIN</option><? } ?>
						<?php if($data_bantuan['status_perkahwinan'] == 3) { ?><option value="3" selected="selected">DUDA</option><? } ?>
						<?php if($data_bantuan['status_perkahwinan'] == 4) { ?><option value="4" selected="selected">JANDA</option><? } ?>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label class="control-label text-right col-md-3">Alamat</label>
				<div class="col-md-9">
					<textarea name="alamat_terkini" class="form-control" oninput="this.value = this.value.toUpperCase()" readonly><?php echo $data_bantuan['alamat_terkini']; ?></textarea>
				</div>
			</div>
			<div class="form-group row">
				<label class="control-label text-right col-md-3">Negeri</label>
				<div class="col-md-9">
					<select name="id_negeri" class="form-control" readonly>
						<?php 
						$negeri = $data_bantuan['id_negeri'];
						$sql_negeri = "SELECT * FROM negeri";
						$query_negeri = mysqli_query($bd2,$sql_negeri);
						
						while($data_negeri = mysqli_fetch_array($query_negeri))
						{
						?>
						<?php if($data_bantuan['id_negeri']==$data_negeri['id_negeri']) { ?><option value="<?php echo $data_negeri['id_negeri']; ?>" selected="selected"><?php echo $data_negeri['name']; ?></option><?php } ?>
						<? 
						} 
						?>
					</select>
				</div>
			</div>
			<div class="form-group row" id="edit_daerah">
				<label class="control-label text-right col-md-3">Daerah</label>
				<div class="col-md-9">
					<select name="id_daerah" class="form-control" readonly>
						<?php 
						$negeri = $data_bantuan['id_negeri'];
						$sql_daerah = "SELECT * FROM daerah WHERE id_negeri='$negeri'";
						$query_daerah = mysqli_query($bd2,$sql_daerah);
						echo mysqli_num_rows($query_daerah);
						
						while($data_daerah = mysqli_fetch_array($query_daerah))
						{
						?>
						<?php if($data_bantuan['id_daerah']==$data_daerah['id_daerah']) { ?><option value="<?php echo $data_daerah['id_daerah']; ?>" selected="selected"><?php echo $data_daerah['nama_daerah']; ?></option><?php } ?>
						<? 
						} 
						?>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label class="control-label text-right col-md-3">Poskod</label>
				<div class="col-md-9">
					<input type="text" name="poskod" class="form-control" minlength="5" maxlength="5" readonly value="<?php echo $data_bantuan['poskod']; ?>">
				</div>
			</div>
			<div class="form-group row">
				<label class="control-label text-right col-md-3">Jumlah Tanggungan</label>
				<div class="col-md-9">
					<input type="number" step="1" name="jumlah_tanggungan" class="form-control" readonly value="<?php echo $data_bantuan['jumlah_tanggungan']; ?>">
				</div>
			</div>
			<div class="form-group row">
				<label class="control-label text-right col-md-3">Jenis Bantuan</label>
				<div class="col-md-9">
					<input type="text" name="jenis_bantuan" oninput="this.value = this.value.toUpperCase()" class="form-control" required value="<?php echo $data_bantuan['jenis_bantuan']; ?>">
				</div>
			</div>
			<div class="form-group row">
				<label class="control-label text-right col-md-3">Tarikh Bantuan</label>
				<div class="col-md-9">
					<input type="date" name="tarikh_bantuan" class="form-control" required value="<?php echo $data_bantuan['tarikh_bantuan']; ?>">
				</div>
			</div>
			<div class="form-group row">
				<label class="control-label text-right col-md-3">Kaedah Bayaran</label>
				<div class="col-md-9">
					<input type="text" name="kaedah_bayar" oninput="this.value = this.value.toUpperCase()" class="form-control" required value="<?php echo $data_bantuan['kaedah_bayar']; ?>">
				</div>
			</div>
			<div class="form-group row">
				<label class="control-label text-right col-md-3">Amaun/Item</label>
				<div class="col-md-9">
					<input type="text" name="amaun_bantuan" oninput="this.value = this.value.toUpperCase()" class="form-control" required value="<?php echo $data_bantuan['amaun_item']; ?>">
				</div>
			</div>
			<input type="hidden" name="id_bantuan" value="<?php echo $data_bantuan['id_bantuan']; ?>">
			<input type="hidden" name="id_masjid" value="<?php echo $id_masjid; ?>">
			<div class="form-group row">
				<div class="col-md-4 offset-4">
					<center>
					<button type="submit" name="edit_bukan" class="btn btn-success">Kemaskini Maklumat</button>
					</center>
				</div>
			</div>
		</div>
	</form>
	<?php	
		}
		else if($data_bantuan['no_passport']!=NULL)
		{
	?>
	<form action="" id="form_passport" name="form_passport" class="form-horizontal form-bordered" method="POST">
		<div class="form-body">
			<div class="form-group row">
				<label class="control-label text-right col-md-3">Nama Penuh</label>
				<div class="col-md-9">
					<input type="text" name="nama_penuh" class="form-control" oninput="this.value = this.value.toUpperCase()" value="<?php echo $data_bantuan['nama_penuh']; ?>" readonly>
				</div>
			</div>
			<div class="form-group row">
				<label class="control-label text-right col-md-3">No Passport</label>
				<div class="col-md-9">
					<input type="text" name="no_passport" class="form-control" oninput="this.value = this.value.toUpperCase()" value="<?php echo $data_bantuan['no_passport']; ?>" readonly>
				</div>
			</div>
			<div class="form-group row">
				<label class="control-label text-right col-md-3">No Telefon</label>
				<div class="col-md-9">
					<input type="text" name="no_tel" class="form-control" value="<?php echo $data_bantuan['no_tel']; ?>" readonly>
				</div>
			</div>
			<div class="form-group row">
				<label class="control-label text-right col-md-3">Status Perkahwinan</label>
				<div class="col-md-9">
					<select name="status_perkahwinan" class="form-control" readonly>
						<?php if($data_bantuan['status_perkahwinan'] == 1) { ?><option value="1" selected="selected">BUJANG</option><? } ?>
						<?php if($data_bantuan['status_perkahwinan'] == 2) { ?><option value="2" selected="selected">BERKAHWIN</option><? } ?>
						<?php if($data_bantuan['status_perkahwinan'] == 3) { ?><option value="3" selected="selected">DUDA</option><? } ?>
						<?php if($data_bantuan['status_perkahwinan'] == 4) { ?><option value="4" selected="selected">JANDA</option><? } ?>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label class="control-label text-right col-md-3">Alamat</label>
				<div class="col-md-9">
					<textarea name="alamat_terkini" class="form-control" oninput="this.value = this.value.toUpperCase()" readonly><?php echo $data_bantuan['alamat_terkini']; ?></textarea>
				</div>
			</div>
			<div class="form-group row">
				<label class="control-label text-right col-md-3">Negeri</label>
				<div class="col-md-9">
					<select name="id_negeri" class="form-control" readonly>
						<?php 
						$negeri = $data_bantuan['id_negeri'];
						$sql_negeri = "SELECT * FROM negeri";
						$query_negeri = mysqli_query($bd2,$sql_negeri);
						
						while($data_negeri = mysqli_fetch_array($query_negeri))
						{
						?>
						<?php if($data_bantuan['id_negeri']==$data_negeri['id_negeri']) { ?><option value="<?php echo $data_negeri['id_negeri']; ?>" selected="selected"><?php echo $data_negeri['name']; ?></option><?php } ?>
						<? 
						} 
						?>
					</select>
				</div>
			</div>
			<div class="form-group row" id="edit_daerah">
				<label class="control-label text-right col-md-3">Daerah</label>
				<div class="col-md-9">
					<select name="id_daerah" class="form-control" readonly>
						<?php 
						$negeri = $data_bantuan['id_negeri'];
						$sql_daerah = "SELECT * FROM daerah WHERE id_negeri='$negeri'";
						$query_daerah = mysqli_query($bd2,$sql_daerah);
						echo mysqli_num_rows($query_daerah);
						
						while($data_daerah = mysqli_fetch_array($query_daerah))
						{
						?>
						<?php if($data_bantuan['id_daerah']==$data_daerah['id_daerah']) { ?><option value="<?php echo $data_daerah['id_daerah']; ?>" selected="selected"><?php echo $data_daerah['nama_daerah']; ?></option><?php } ?>
						<? 
						} 
						?>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label class="control-label text-right col-md-3">Poskod</label>
				<div class="col-md-9">
					<input type="text" name="poskod" class="form-control" minlength="5" maxlength="5" readonly value="<?php echo $data_bantuan['poskod']; ?>">
				</div>
			</div>
			<div class="form-group row">
				<label class="control-label text-right col-md-3">Jumlah Tanggungan</label>
				<div class="col-md-9">
					<input type="number" step="1" name="jumlah_tanggungan" class="form-control" readonly value="<?php echo $data_bantuan['jumlah_tanggungan']; ?>">
				</div>
			</div>
			<div class="form-group row">
				<label class="control-label text-right col-md-3">Jenis Bantuan</label>
				<div class="col-md-9">
					<input type="text" name="jenis_bantuan" oninput="this.value = this.value.toUpperCase()" class="form-control" required value="<?php echo $data_bantuan['jenis_bantuan']; ?>">
				</div>
			</div>
			<div class="form-group row">
				<label class="control-label text-right col-md-3">Tarikh Bantuan</label>
				<div class="col-md-9">
					<input type="date" name="tarikh_bantuan" class="form-control" required value="<?php echo $data_bantuan['tarikh_bantuan']; ?>">
				</div>
			</div>
			<div class="form-group row">
				<label class="control-label text-right col-md-3">Kaedah Bayaran</label>
				<div class="col-md-9">
					<input type="text" name="kaedah_bayar" oninput="this.value = this.value.toUpperCase()" class="form-control" required value="<?php echo $data_bantuan['kaedah_bayar']; ?>">
				</div>
			</div>
			<div class="form-group row">
				<label class="control-label text-right col-md-3">Amaun/Item</label>
				<div class="col-md-9">
					<input type="text" name="amaun_bantuan" oninput="this.value = this.value.toUpperCase()" class="form-control" required value="<?php echo $data_bantuan['amaun_item']; ?>">
				</div>
			</div>
			<input type="hidden" name="id_bantuan" value="<?php echo $data_bantuan['id_bantuan']; ?>">
			<input type="hidden" name="id_masjid" value="<?php echo $id_masjid; ?>">
			<div class="form-group row">
				<div class="col-md-4 offset-4">
					<center>
					<button type="submit" name="edit_passport" class="btn btn-success">Kemaskini Maklumat</button>
					</center>
				</div>
			</div>
		</div>
	</form>
<?php
		}
	}
?>