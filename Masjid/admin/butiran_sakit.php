<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Butiran Pesakit</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li><a href="utama.php?view=admin&action=pendaftaran">Menu Pendaftaran</a></li>
					<li><a href="utama.php?view=admin&action=pendaftaran_sakit_kronik">Daftar Sakit Kronik</a></li>
					<li class="active">Butiran Pesakit</li>
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
					Maklumat Penyakit
				</div>
				<?php 
                include("connection/connection.php");
			  
				if(isset($_GET['id_data']))
				{
					$id_data = $_GET['id_data'];

					$sql_search="SELECT * FROM sej6x_data_peribadi WHERE id_data='".$id_data."' "; 
					$result = mysql_query($sql_search) or die ("Error :".mysql_error());
				}
				else if(isset($_GET['id']))
				{
					$ID = $_GET['id'];
					
					$sql_search="SELECT * FROM sej6x_data_anakqariah WHERE ID='$ID'";
					$result=mysql_query($sql_search,$bd);
				}
				?>    
                <div class="card-body">
                    <form action="admin/add_sakit.php" method='post'>
                    <?php while($row = mysql_fetch_assoc($result)){ ?> 
						<div class="col-lg-12">
                            <div class="form-group">
								<div class="alert alert-info">
                                    <div align="center">  
										<label>Nama Pesakit :</label> <?php echo $row['nama_penuh'];?>
									</div>
                                    <div align="center"> 
										<label>No K/P:</label> <?php echo $row['no_ic'];?>
									</div>
								</div>
							</div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Jenis Penyakit</label>
								<input class="form-control" name="jenis_penyakit" id="jenis_penyakit" requiredX>   
                            </div>    
                        </div>                     
                        <div class="col-lg-4">
                            <div class="form-group">
								<label>Rawatan Terkini</label>
								<input class="form-control" name="rawatan_terkini" id="rawatan_terkini" requiredX>   
							</div>    
						</div>      
						<div class="col-lg-2" align="center">
							<div class="form-group">
								<br>
								<?php
								if(isset($_GET['id_data']))
								{
								?>
								<input type="hidden" name="id_data" value="<?php echo $row['id_data']; ?>">
								<?php
								}
								else if(isset($_GET['id']))
								{
								?>
								<input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
								<?php
								}
								?>
								<input type="hidden" name="id_masjid" value="<?php echo $id_masjid; ?>">    
								<input type="submit"  value="Hantar" class="btn btn-primary"></input> 
                            </div>
                        </div>
					<?php }?> 
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
 