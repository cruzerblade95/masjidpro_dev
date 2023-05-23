<?php

include('../connection/connection.php');
include('../fungsi_tarikh.php');
include('../fungsi.php');
if(isset($_GET['id_bantuan']))
{
	$id_bantuan = $_GET['id_bantuan'];
	
	$sql_bantuan = "SELECT * FROM bantuan_zakat WHERE id_bantuan='$id_bantuan'";
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
		else if($data_bantuan['id_data']!=NULL OR $data_bantuan['ID']!=NULL) {

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
                    <?php if ($data_bantuan['id_data'] != NULL) { ?><div class="col-3" align="left">Jumlah Tanggungan</div><div class="col-1" align="left">:</div><div class="col-8" align="left"><?php echo $bil_anak; ?></div><?php } ?>
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
				<div class="col-12"><u>MAKLUMAT PERMOHONAN BANTUAN</u></div><hr>
				<div class="col-3" align="left">Jenis Bantuan</div><div class="col-1" align="left">:</div><div class="col-8" align="left"><?php echo $data_bantuan['jenis_bantuan']; ?></div>
                <?php
                $jenis_bantuan = $data_bantuan['jenis_bantuan'];

                if($jenis_bantuan=="Kewangan"){
                ?>
                <div class="col-3" align="left">Amaun</div><div class="col-1" align="left">:</div><div class="col-8" align="left"><?php echo "RM ".$data_bantuan['amaun']; ?></div>
                <?php
                }
                ?>
				<div class="col-3" align="left">Tarikh Mohon</div><div class="col-1" align="left">:</div><div class="col-8" align="left"><?php echo fungsi_tarikh($data_bantuan['tarikh_mohon'],11,2); ?></div>
				<div class="col-3" align="left">Status Pekerjaan</div><div class="col-1" align="left">:</div><div class="col-8" align="left"><?php echo $data_bantuan['status_kerja']; ?></div>
				<div class="col-3" align="left">Tujuan Permohonan</div><div class="col-1" align="left">:</div><div class="col-8" align="left"><?php echo $data_bantuan['tujuan']; ?></div>
			</div>
		</div>
	</div>
	<hr>
	<u><h3>REKOD BANTUAN</h3></u>
	<hr>
	<div class="table-responsive">
		<table id="meja_akaun3" width="100%" data-order="[]" class="table table-bordered table-hover table-striped">
			<thead>
				<tr>
					<td align="center">Bil</td>
					<td align="center">Jenis Bantuan</td>
					<td align="center">Tarikh<br>Bantuan/Mohon</td>
					<td align="center">Status</td>
					<td align="center">Masjid</td>
				</tr>
			</thead>
			<tbody>
			<?php
			if($data_bantuan['no_ic']!=NULL){
				$ic = $data_bantuan['no_ic'];
				$sql_rekod = "SELECT * FROM bantuan_zakat WHERE no_ic='$ic' ORDER BY id_bantuan DESC";
			}
			else if($data_bantuan['no_passport']!=NULL){
				$passport = $data_bantuan['no_passport'];
				$sql_rekod = "SELECT * FROM bantuan_zakat WHERE no_passport='$passport' ORDER BY id_bantuan DESC";
			}
				$query_rekod = mysqli_query($bd2,$sql_rekod);
				$bil_rekod = mysqli_num_rows($query_rekod);
				
				if($bil_rekod==0){
				?>
				<tr>
					<td align="center" colspan="7">*Tiada Rekod*</td>
				</tr>
				<?php
				}
				else if($bil_rekod>0){
					$i=1;
					while($data_rekod = mysqli_fetch_array($query_rekod))
					{
				?>
				<tr>
					<td align="center"><?php echo $i; ?></td>
					<td align="center"><?php echo $data_rekod['jenis_bantuan']; ?></td>
					<td align="center">
					<?php
					if($data_rekod['status_bantuan']==1){
						echo $data_rekod['tarikh_bantuan']; 
					}
					else if($data_rekod['status_bantuan']==0 OR $data_rekod['status_bantuan']==2){
						echo $data_rekod['tarikh_mohon'];
					}
					?>
					</td>
					<td align="center">
					<?php
					if($data_rekod['status_bantuan']==1){
					?>
					<div class="alert alert-success col-12" role="alert">Bantuan Lulus:<br><?php echo $data_rekod['kaedah_bayar']; ?>-<?php echo $data_rekod['amaun_item']; ?></div>
					<?php
					}
					else if($data_rekod['status_bantuan']==0){
					?>
					<div class="alert alert-warning col-12" role="alert">Permohonan Sedang Diproses</div>
					<?php
					}
					else if($data_rekod['status']==2){
					?>
					<div class="alert alert-danger col-12" role="alert">Bantuan Ditolak:<br><?php echo $data_rekod['remark']; ?></div>
					<?php
					}
					?>
					</td>
					<td align="center">
					<?php 
					$masjid_kariah = $data_bantuan['id_masjid'];
					$sql_masjid = "SELECT * FROM sej6x_data_masjid WHERE id_masjid='$masjid_kariah'";
					$query_masjid = mysqli_query($bd2,$sql_masjid);
					$data_masjid = mysqli_fetch_array($query_masjid);
					echo $data_masjid['nama_masjid'];
					?>
					</td>
				</tr>
				<?php
					$i++;
					}
				}
			?>
			</tbody>
		</table>
	</div>
</div>
</center>
<?php 
} 
?>