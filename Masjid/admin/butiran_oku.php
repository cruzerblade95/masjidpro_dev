
 <div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Butiran OKU</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li><a href="utama.php?view=admin&action=pendaftaran">Menu Pendaftaran</a></li>
					<li><a href="utama.php?view=admin&action=pendaftaran_oku">Daftar OKU</a></li>
					<li class="active">Butiran OKU</li>
				</ol>
			</div>
		</div>
	</div>
</div> 

<div class="content mt-3">
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">Maklumat OKU</div>
				<?php 
				include("connection/connection.php");
			  
				if(isset($_GET['id_data']))
				{
					$id_data=$_GET['id_data'];
					$sql_search="SELECT * FROM sej6x_data_peribadi WHERE id_data='$id_data'";
				}
				else if(isset($_GET['id']))
				{
					$ID=$_GET['id'];
					$sql_search="SELECT * FROM sej6x_data_anakqariah WHERE ID='$ID'";
				}
			  
				$result = mysql_query($sql_search) or die ("Error :".mysql_error());
				$row = mysql_fetch_array($result);
				?>    
				<div class="card-body">
					<div class="row"> 
						<div class="col-lg-12">
							<form action="admin/add_oku.php" method='post'>
								<div class="col-lg-12">
									<div class="form-group">
										<div class="alert alert-info">
											<div align="center"><label>Nama Kelainan Upaya (OKU):</label> <?php echo $row['nama_penuh'];?></div>
											<div align="center"><label>No K/P:</label> <?php echo $row['no_ic'];?></div>                      	
										</div>
									 </div>
								</div>
								<hr />
								<div class="col-lg-4">
									<div class="form-group">
										<label>Kategori Orang Kurang Upaya (OKU):</label>
										<select class="form-control" name="jenis_oku" id="jenis_oku">
											<option value="0">Sila Pilih</option>
											<option value="Pendengaran">Pendengaran </option>
											<option value="Penglihatan">Penglihatan</option>
											<option value="Fizikal">Fizikal</option>
											<option value="Pembelajaran">Masalah Pembelajaran </option>
											<option value="Pertuturan">Pertuturan</option>
											<option value="Mental">Mental </option>
											<option value="Pelbagai">Pelbagai </option>
										</select>   
									</div>    
								</div>                     
								<div class="col-lg-4">
									<div class="form-group">
										<label>Catatan:</label>
										<input class="form-control" name="keterangan" id="keterangan">   
									</div>    
								</div>      
								<div class="col-lg-4">
									<div class="form-group">
										<br>
										<?php
										if(isset($_GET['id_data']))
										{
										?>
										<input type="hidden" name="id_data" id="id_data" value="<?php echo $row['id_data']; ?>">
										<?php
										}
										else if(isset($_GET['id']))
										{
										?>
										<input type="hidden" name="id" id="id" value="<?php echo $row['ID']; ?>">
										<?php
										}
										?>
										<input type="hidden" name="id_masjid" id="id_masjid" value="<?php echo $id_masjid; ?>">    
										<input type="submit"  value="Hantar" class="btn btn-primary"></input> 
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
 