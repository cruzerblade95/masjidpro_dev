<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Butiran Jawatan</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li><a href="utama.php?view=admin&action=dashboard_tetapan">Menu Organisasi</a></li>
					<li><a href="utama.php?view=admin&action=daftar_ajk">Daftar AJK Masjid</a></li>
					<li class="active">Butiran Jawatan</li>
				</ol>
			</div>
		</div>
	</div>
</div>
<div class="content mt-3">
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					Maklumat Jawatan
				</div>
				<?php 
					  
					include("connection/connection.php");
				  
					$idd = $_GET['id_data'];
					if(strpos($idd, 'A-') !== true) $sql_search="SELECT id_data,nama_penuh,no_ic,umur,alamat_terkini,no_hp FROM sej6x_data_peribadi WHERE id_data='".$idd."' ";
					if(strpos($idd, 'A-') !== false) {

					    $idd = str_replace('A-', '', $idd);
					    $sql_search="SELECT CONCAT('A-', ID) 'id_data', nama_penuh, no_ic, umur, NULL 'alamat_terkini', NULL 'no_hp' FROM sej6x_data_anakqariah WHERE ID='".$idd."' ";
                    }
					$result = mysqli_query($bd2, $sql_search) or die ("Error :".mysqli_error($bd2));
				  
				 ?>    
				<div class="card-body">
					<div class="row"> 
						<form action="admin/add_ajk.php" method='post' enctype="multipart/form-data">
							<?php 
							while($row = mysqli_fetch_assoc($result))
							{ 
							?> 
							<div class="col-lg-12">
								<div class="form-group">
									<label>Nama Ahli Jawatankuasa (AJK):</label> <?php echo $row['nama_penuh'];?>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group">
									<label>No K/P:</label> <?php echo $row['no_ic'];?>
								</div>
							</div>
							<hr>
							<div class="col-lg-12">
								<div class="form-group">
									<label>Jawatan</label>
									<select class="form-control" name="jawatan" id="jawatan">
										<option>Sila Pilih</option>
										<option value="Pengerusi">Pengerusi</option>
										<option value="Timbalan Pengerusi">Timbalan Pengerusi</option>
										<option value="Setiausaha">Setiausaha</option>
										<option value="Bendahari">Bendahari</option>
										<option value="AJK">AJK </option>
										<option value="Pemeriksa Kira-Kira">Pemeriksa Kira-Kira</option>
									</select>
									<input type="hidden" id="index_ajk" name="index_ajk" value="">
								</div>    
							</div>                     
							<div class="col-lg-12">
								<div class="form-group">
									<label>Tarikh Lantikan</label>
									<input class="form-control" type="date" name="tarikh_lantikan" id="tarikh_lantikan" requiredX>   
								</div>    
							</div>      
							<div class="col-lg-12">
								<div class="form-group">
									 <label>Upload Gambar</label>
									 <input type="file" class="form-control-file" name="gambar" id="gambar" />
								</div>    
							</div>      
							<div class="col-lg-12">
								<div class="form-group">
									<br>
									<input type="hidden" name="id_data" value="<?php echo $row['id_data']; ?>">
									<input type="hidden" name="id_ajk" value="<?php echo $row['id_data']; ?>">
									<input type="submit"  value="Upload" class="btn btn-primary"></input> 
								</div>
							</div>
							<?php 
							}
							?>  
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
