<?php 
include ('../connection/connection.php');

$id_bantuan=$_GET['id_bantuan'];

$sql="SELECT a.id_data, a.bank, a.nama_akaun, a.akaun_bank, b.nama_penuh, b.no_ic, b.no_hp FROM sej6x_data_bantuan a, sej6x_data_peribadi b WHERE a.id_bantuan='$id_bantuan' AND a.id_data=b.id_data";
$sqlquery=mysql_query($sql,$bd);
$data=mysql_fetch_array($sqlquery);
?>
<div class="col-lg-12">
	<div class="row">
		<div class="col-lg-12">
			<div class="form-group">
				<div class="alert alert-info">
					<div align="center">  
						<label>Nama Kariah :</label> <?php echo $data['nama_penuh'];?>
					</div>
					<div align="center"> 
						<label>No K/P Kariah:</label> <?php echo $data['no_ic'];?>
					</div>
					<div align="center"> 
						<label>No Telefon Kariah:</label> <?php echo $data['no_hp'];?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-lg-12">
			<div class="form-group">
				<div class="alert alert-warning">
					<div align="center">  
						<label>Maklumat Bank :</label> <?php echo $data['bank'];?>
					</div>
					<div align="center"> 
						<label>Nama Pemilik Akaun:</label> <?php echo $data['nama_akaun'];?>
					</div>
					<div align="center"> 
						<label>No Akaun Bank:</label> <?php echo $data['akaun_bank'];?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>