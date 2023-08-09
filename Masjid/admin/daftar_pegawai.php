<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Daftar Pegawai Masjid</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li><a href="utama.php?view=admin&action=dashboard_tetapan">Menu Organisasi</a></li>
					<li class="active">Daftar Pegawai Masjid</li>
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
					Carian
				</div>
				<div class="card-body">
					<form name="ibu_tunggal" method="POST" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']) ;?>">
					<div class="row"> 
						<div class="col-lg-12">
							<div class="col-lg-4">
								<div class="form-group">
									<label>No K/P</label>
									<input class="form-control" name="no_ic" id="no_ic" minlength="12" maxlength="12" required>
								</div>    
							</div>                     
							<div class="col-lg-4">
								<div class="form-group">
									<br>
									<input type="submit" name="search" value="Carian" class="btn btn-primary">
								</div>    
							</div>      
						</div>
					</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<?php

	if(isset($_POST['search']))
	{

		$no_ic = $_POST['no_ic'];

		include("connection/connection.php");

        $sql_search = "SELECT id_data, nama_penuh, no_ic, umur, alamat_terkini FROM sej6x_data_peribadi WHERE no_ic LIKE '%$no_ic%' AND id_masjid = $id_masjid
		UNION
		SELECT CONCAT('A-', ID) 'id_data', nama_penuh, no_ic, umur, NULL 'alamat_terkini' FROM sej6x_data_anakqariah WHERE no_ic LIKE '%$no_ic%' AND id_masjid = $id_masjid";
        $result = mysqli_query($bd2, $sql_search) or die ("Error :".mysqli_error($bd2));
        $bil = mysqli_num_rows($result);
	?>
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					Maklumat Pegawai Masjid
				</div>
				<div class="card-body">
                    <?php if($bil>0){ ?>
					<div class="table-responsive">
						<form method="post" id="ajkmasjid" action="" enctype="multipart/form-data">
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th><div align="center">No</div></th>
									<th><div align="center">Nama</div></th>
									<th><div align="center">No K/P</div></th>
									<th><div align="center">Butiran Jawatan</div></th>
									
								</tr>
							</thead>
							<tbody>
							<?php 
							$x=1; 
							while($row = mysqli_fetch_assoc($result))
							{
							?>
								<tr>
									<td><div align="center"><?php echo $x; ?></div></td>
									<td><?php echo $row['nama_penuh']; ?></td>
									<td><div align="center"><?php echo $row['no_ic']; ?></div></td>
									<td>
										<div align="center">
											<a href="utama.php?view=admin&action=butiran_jawatanpegawai&id_data=<?php echo $row['id_data'];?>&sideMenu=organisasi">
												<input type="button" value="Daftar" class="btn btn-success" />
											</a>
										</div>  
									</td>
								</tr>
							<?php 
							$x++;
							}
							?>
							</tbody>
						</table>
						</form>
					</div>
					<!-- /.table-responsive -->
				    <?php
                    }
                    else if($bil==0) { ?>

                        <script type="text/javascript">
                            window.location.href='utama.php?view=admin&action=butiran_jawatanpegawai&no_ic=<?php echo $no_ic; ?>';
                        </script>

                    <?php
                    }
                    ?>
                    <!-- <form action="admin/butiran_jawatanpegawai.php" method="POST">
                    <div class="row">
                        <div class="col-lg-12">
                            <b><u>Sila Isi Maklumat Pegawai Masjid:</u></b>
                        </div>
                        <div class="row">
                            <br>
                        <br>
                        </div>
                        <div class="col-lg-4">
                            <label>Nama Penuh</label>
                            <input type="text" name="nama_penuh" required class="form-control">
                        </div>
                        <div class="col-lg-4">
                            <label>No Kad Pengenalan</label>
                            <input type="text" name="no_ic" minlength="12" maxlength="12" required class="form-control">
                        </div>
                        <div class="col-lg-4">
                            <label>No Telefon</label>
                            <input type="text" name="no_tel" required class="form-control">
                        </div>
                        <div class="col-lg-12">
                            <center>
                                <br>
                                <button type="submit" name="daftar" class="btn btn-success">Daftar</button>
                            </center>
                        </div>
                    </div>
                    </form> -->
                    <?php
                    //}
                    ?>
                </div>
			</div>
		</div>
	<!-- /.col-lg-12 -->
	</div>
	<?php
	}
	?>
</div>

                         
