<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Semak OKU</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li><a href="utama.php?view=admin&action=pendaftaran">Menu Pendaftaran</a></li>
					<li><a href="utama.php?view=admin&action=senarai_oku">Senarai OKU</a></li>
					<li class="active">Semak OKU</li>
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
						$sql_search="SELECT a.id_data,a.nama_penuh,a.no_ic,a.umur,b.jenis_oku,b.keterangan,b.id_oku FROM sej6x_data_peribadi a, sej6x_data_oku b WHERE a.id_data=b.id_data AND a.id_data='$id_data'"; 
					}
					else if(isset($_GET['id']))
					{
						$ID=$_GET['id'];
						$sql_search="SELECT a.ID,a.nama_penuh,a.no_ic,a.umur,b.jenis_oku,b.keterangan,b.id_oku FROM sej6x_data_anakqariah a, sej6x_data_oku b WHERE a.ID=b.id_anak AND a.ID='$ID'"; 
					}
					$result = mysql_query($sql_search) or die ("Error :".mysql_error());
					$row = mysql_fetch_array($result);
				?>    
				<div class="card-body">
					<div class="row">  
						<div class="col-lg-12">
						<form action="admin/update_oku.php" method='post'>
							<div class="col-lg-12">
								<div class="form-group">
								   <div class="alert alert-info">
									  <div align="center">  <label>Nama Pesakit :</label> <?php echo $row['nama_penuh'];?></div>
									   <div align="center"> <label>No K/P:</label> <?php echo $row['no_ic'];?></div>
								   </div>
								</div>
							</div>
							<hr />
							<div class="col-lg-4">
								<div class="form-group">
									<label>Kategori Orang Kurang Upaya (OKU):</label>
									<select class="form-control" name="jenis_oku" id="jenis_oku">
										<option>Sila Pilih</option>
										<option value="Pendegaran" <?php if($row["jenis_oku"]=='Pendengaran') { echo "selected"; } ?>>Pendengaran </option>
										<option value="Penglihatan" <?php if($row["jenis_oku"]=='Penglihatan') { echo "selected"; } ?>>Penglihatan</option>
										<option value="Fizikal" <?php if($row["jenis_oku"]=='Fizikal') { echo "selected"; } ?>>Fizikal</option>
										<option value="Pembelajaran" <?php if($row["jenis_oku"]=='Pembelajaran') { echo "selected"; } ?>>Masalah Pembelajaran</option>
										<option value="Pertuturan" <?php if($row["jenis_oku"]=='Pertuturan') { echo "selected"; } ?>>Pertuturan</option>
										<option value="Mental" <?php if($row["jenis_oku"]=='Mental') { echo "selected"; } ?>>Mental </option>
										<option value="Pelbagai" <?php if($row["jenis_oku"]=='Pelbagai') { echo "selected"; } ?>>Pelbagai </option>
									</select>   
								</div>    
							</div>   
							<div class="col-lg-4">
								<div class="form-group">
									<label>Catatan:</label>
									<input class="form-control" name="keterangan" id="keterangan" value="<?php echo $row['keterangan'];?>" >   
								</div>    
							</div>      
							<div class="col-lg-2">
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
									<input type="hidden" name="id_masjid"  id="id_masjid" value="<?php echo $id_masjid; ?>">    
									<input type="submit"  value="Kemaskini" class="btn btn-primary"></input> 
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
 