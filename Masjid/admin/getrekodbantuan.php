<?php

include('../connection/connection.php');
include('../fungsi_tarikh.php');
include('../fungsi.php');
if(isset($_GET['id_bantuan']))
{
	$id_bantuan = $_GET['id_bantuan'];
	
	$sql_bantuan = "SELECT *, IF(tarikh_mohon IS NOT NULL, tarikh_mohon, tarikh_bantuan) AS tarikh_mohon FROM bantuan_zakat WHERE id_bantuan='$id_bantuan'";
	$query_bantuan = mysqli_query($bd2,$sql_bantuan);
	$data_bantuan = mysqli_fetch_array($query_bantuan);
?>
<center>
<div class="col-12">
	<?php
	if($data_bantuan['no_ic']!=NULL){
		if($data_bantuan['id_data']==NULL AND $data_bantuan['ID']==NULL){
			$kariah_masjid = $data_bantuan['kariah_masjid'];
			$sql_masjid = "SELECT * FROM sej6x_data_masjid WHERE id_masjid='$kariah_masjid'";
			$query_masjid = mysqli_query($bd2,$sql_masjid);
			$data_masjid = mysqli_fetch_array($query_masjid);
			
			$bantuan_negeri = $data_bantuan['id_negeri'];
			$sql_negeri = "SELECT * FROM negeri WHERE id_negeri='$bantuan_negeri'";
			$query_negeri = mysqli_query($bd2,$sql_negeri);
			$data_negeri = mysqli_fetch_array($query_negeri);
			
			$bantuan_daerah = $data_bantuan['id_daerah'];
			$sql_daerah = "SELECT * FROM daerah WHERE id_daerah='$bantuan_daerah'";
			$query_daerah = mysqli_query($bd2,$sql_daerah);
			$data_daerah = mysqli_fetch_array($query_daerah);
		?>
		<div class="row">
			<div class="alert alert-danger col-12" role="alert">
				<center>
					Maklumat belum bedaftar dengan MasjidPro
				</center>
			</div>
		</div>
		<div class="row">
			<div class="alert alert-info col-12" role="alert">
				<div class="row">
					<div class="col-12"><u>MAKLUMAT PEMOHON</u></div><hr>
					<div class="col-3" align="left">Kariah</div><div class="col-1" align="left">:</div><div class="col-8" align="left"><?php echo $data_masjid['nama_masjid']; ?></div>
					<div class="col-3" align="left">Nama</div><div class="col-1" align="left">:</div><div class="col-8" align="left"><?php echo $data_bantuan['nama_penuh']; ?></div>
					<div class="col-3" align="left">No Kad Pengenalan</div><div class="col-1" align="left">:</div><div class="col-8" align="left"><?php echo $data_bantuan['no_ic']; ?></div>
					<div class="col-3" align="left">No Telefon</div><div class="col-1" align="left">:</div><div class="col-8" align="left"><?php echo $data_bantuan['no_tel']; ?></div>
					<div class="col-3" align="left">Jumlah Tanggungan</div><div class="col-1" align="left">:</div><div class="col-8" align="left"><?php echo $data_bantuan['jumlah_tanggungan']; ?></div>
					<div class="col-3" align="left">Alamat</div><div class="col-1" align="left">:</div><div class="col-8" align="left"><?php echo $data_bantuan['alamat_terkini']."<br>".$data_bantuan['poskod']." ".$data_daerah['nama_daerah']."<br>".$data_negeri['name']; ?></div>
				</div>
			</div>
		</div>
		<?php
		}
		else if($data_bantuan['id_data']!=NULL OR $data_bantuan['ID']!=NULL)
		{
            if ($data_bantuan['id_data'] != NULL) {

                $id_data = $data_bantuan['id_data'];
                $sql_ic = "SELECT * FROM sej6x_data_peribadi WHERE id_data='$id_data'";
                $query_ic = mysqli_query($bd2, $sql_ic);
                $data_ic = mysqli_fetch_array($query_ic);

                $sql_anak = "SELECT * FROM sej6x_data_anakqariah WHERE id_qariah='$id_data'";
                $query_anak = mysqli_query($bd2, $sql_anak);
                //$bil_anak = mysqli_fetch_array($query_anak);
                $bil_anak = mysqli_num_rows($query_anak);

            }
            else if($data_bantuan['ID'] != NULL){

                $ID = $data_bantuan['ID'];
                $sql_ic = "SELECT a.nama_penuh, a.no_ic, a.id_masjid, a.no_tel 'no_hp', b.alamat_terkini, b.poskod, b.id_daerah, b.id_negeri FROM sej6x_data_anakqariah a, sej6x_data_peribadi b WHERE a.ID='$ID' AND a.id_qariah=b.id_data";
                $query_ic = mysqli_query($bd2,$sql_ic);
                $data_ic = mysqli_fetch_array($query_ic);
            }
			
			$kariah_masjid = $data_ic['id_masjid'];
			$sql_masjid = "SELECT * FROM sej6x_data_masjid WHERE id_masjid='$kariah_masjid'";
			$query_masjid = mysqli_query($bd2,$sql_masjid);
			$data_masjid = mysqli_fetch_array($query_masjid);
			
			$ic_negeri = $data_ic['id_negeri'];
			$sql_negeri = "SELECT * FROM negeri WHERE id_negeri='$ic_negeri'";
			$query_negeri = mysqli_query($bd2,$sql_negeri);
			$data_negeri = mysqli_fetch_array($query_negeri);
			
			$ic_daerah = $data_ic['id_daerah'];
			$sql_daerah = "SELECT * FROM daerah WHERE id_daerah='$ic_daerah'";
			$query_daerah = mysqli_query($bd2,$sql_daerah);
			$data_daerah = mysqli_fetch_array($query_daerah);
			
		?>
		<div class="row">
			<div class="alert alert-success col-12" role="alert">
				<center>
					Maklumat telah berdaftar di <?php echo ucwords(strtolower($nama_masjid)); ?>
				</center>
			</div>
		</div>
		<div class="row">
			<div class="alert alert-info col-12" role="alert">
				<div class="row">
					<div class="col-12"><u>MAKLUMAT PEMOHON</u></div><hr>
					<div class="col-3" align="left">Kariah</div><div class="col-1" align="left">:</div><div class="col-8" align="left"><?php echo $data_masjid['nama_masjid']; ?></div>
					<div class="col-3" align="left">Nama</div><div class="col-1" align="left">:</div><div class="col-8" align="left"><?php echo strtoupper($data_ic['nama_penuh']); ?></div>
					<div class="col-3" align="left">No Kad Pengenalan</div><div class="col-1" align="left">:</div><div class="col-8" align="left"><?php echo $data_ic['no_ic']; ?></div>
					<div class="col-3" align="left">No Telefon</div><div class="col-1" align="left">:</div><div class="col-8" align="left"><?php echo $data_ic['no_hp']; ?></div>
					<?php if($data_bantuan['id_data'] != NULL){ ?><div class="col-3" align="left">Jumlah Tanggungan</div><div class="col-1" align="left">:</div><div class="col-8" align="left"><?php echo $bil_anak; ?></div><?php } ?>
					<div class="col-3" align="left">Alamat</div><div class="col-1" align="left">:</div><div class="col-8" align="left"><?php echo $data_ic['alamat_terkini']."<br>".$data_ic['poskod']." ".$data_daerah['nama_daerah']."<br>".$data_negeri['name']; ?></div>
				</div>
			</div>
		</div>
		<?php
		}
	}
	else if($data_bantuan['no_passport']!=NULL){
		$bantuan_negeri = $data_bantuan['id_negeri'];
		$sql_negeri = "SELECT * FROM negeri WHERE id_negeri='$bantuan_negeri'";
		$query_negeri = mysqli_query($bd2,$sql_negeri);
		$data_negeri = mysqli_fetch_array($query_negeri);
		
		$bantuan_daerah = $data_bantuan['id_daerah'];
		$sql_daerah = "SELECT * FROM daerah WHERE id_daerah='$bantuan_daerah'";
		$query_daerah = mysqli_query($bd2,$sql_daerah);
		$data_daerah = mysqli_fetch_array($query_daerah);
		?>
		<div class="row">
			<div class="alert alert-info col-12" role="alert">
				<div class="row">
					<div class="col-12"><u>MAKLUMAT PEMOHON</u></div><hr>
					<div class="col-3" align="left">Nama</div><div class="col-1" align="left">:</div><div class="col-8" align="left"><?php echo strtoupper($data_bantuan['nama_penuh']); ?></div>
					<div class="col-3" align="left">No Passport</div><div class="col-1" align="left">:</div><div class="col-8" align="left"><?php echo $data_bantuan['no_passport']; ?></div>
					<div class="col-3" align="left">No Telefon</div><div class="col-1" align="left">:</div><div class="col-8" align="left"><?php echo $data_bantuan['no_tel']; ?></div>
					<div class="col-3" align="left">Jumlah Tanggungan</div><div class="col-1" align="left">:</div><div class="col-8" align="left"><?php echo $data_bantuan['jumlah_tanggungan']; ?></div>
					<div class="col-3" align="left">Alamat</div><div class="col-1" align="left">:</div><div class="col-8" align="left"><?php echo $data_bantuan['alamat_terkini']."<br>".$data_bantuan['poskod']." ".$data_daerah['nama_daerah']."<br>".$data_negeri['name']; ?></div>
				</div>
			</div>
		</div>
		<?php
	}
	?>
	<div class="row">
		<div class="alert alert-warning col-12" role="alert">
			<div class="row">
				<div class="col-12"><u>MAKLUMAT BANTUAN</u></div><hr>
				<div class="col-3" align="left">Status Bantuan</div><div class="col-1" align="left">:</div>
				<div class="col-8" align="left">
				<?php 
				if($data_bantuan['status_ambil']==1)
				{
					echo "<b>SUDAH DIAMBIL</b>";
				}
				else
				{
					echo "<b>BELUM DIAMBIL</b>";
				}
				?>
				</div>
				<?php 
				if($data_bantuan['status_ambil']==1)
				{
				?>
				<div class="col-3" align="left">Tarikh Ambil</div><div class="col-1" align="left">:</div><div class="col-8" align="left"><?php echo $data_bantuan['tarikh_ambil']; ?></div>
				<?php
				}
				?>
				<div class="col-3" align="left">Jenis Bantuan</div><div class="col-1" align="left">:</div><div class="col-8" align="left"><?php echo $data_bantuan['jenis_bantuan']; ?></div>
                <div class="col-3" align="left">Amaun/Item</div><div class="col-1" align="left">:</div><div class="col-8" align="left"><?php echo $data_bantuan['amaun']; ?></div>
				<div class="col-3" align="left">Tarikh Mohon</div><div class="col-1" align="left">:</div><div class="col-8" align="left"><?php echo fungsi_tarikh($data_bantuan['tarikh_mohon'],11,2); ?></div>
				<div class="col-3" align="left">Status Pekerjaan</div><div class="col-1" align="left">:</div><div class="col-8" align="left"><?php echo $data_bantuan['status_kerja']; ?></div>
				<div class="col-3" align="left">Tujuan Permohonan</div><div class="col-1" align="left">:</div><div class="col-8" align="left"><?php echo $data_bantuan['tujuan']; ?></div>
			</div>
		</div>
	</div>
	<hr>
	<?php 
	if($data_bantuan['status_ambil']!=1)
	{
	?>
	<form action="admin/add_rekodbantuan.php" method="POST" onSubmit="return confirm('Pastikan Maklumat Betul')">
	<div class="row">
		<div class="col-12">
		<div class="form-body">
			<div class="form-group row">
				<label class="control-label text-right col-md-3">Tarikh Ambil&nbsp;:</label>
				<div class="col-md-9">
					<input type="date" name="tarikh_ambil" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
				</div>
			</div>
		</div>
		</div>
		<div class="col-4 offset-4">
		<center>
			<input type="hidden" name="id_bantuan" value="<?php echo $data_bantuan['id_bantuan']; ?>">
			<button class="btn-success btn" type="submit" name="submit_bantuan">Beri Bantuan</button>
		</center>
		</div>
	</div>
	<?php
	}
	?>
</div>
</center>
<?php 
} 
?>