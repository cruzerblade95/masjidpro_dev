<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Butiran Pegawai Masjid</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li><a href="utama.php?view=admin&action=dashboard_tetapan">Menu Organisasi</a></li>
					<li><a href="utama.php?view=admin&action=senarai_pegawai">Senarai Pegawai Masjid</a></li>
					<li class="active">Butiran Pegawai Masjid</li>
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
					Maklumat Pegawai Masjid &nbsp;&nbsp;
					<button  class="btn btn-info" onclick="history.go(-1);">Kembali </button>
				</div>
				<?php 
				
					include("connection/connection.php");
				  
					$idd = $_GET['id_datapegawai'];

                $semak_ajk = "SELECT * FROM data_pegawai_masjid WHERE id_datapegawai = $idd";
                $r_ajk = mysqli_query($bd2, $semak_ajk) or die ("Error :".mysqli_error($bd2));
                $r_result = mysqli_fetch_assoc($r_ajk);
                if($r_result['id_pegawai'] != NULL) {
                    $sql_search="SELECT a.id_data,a.nama_penuh,a.no_ic,a.no_hp,a.alamat_terkini,a.poskod,a.pekerjaan,a.jantina,a.tarikh_lahir,
						b.id_datapegawai,b.id_pegawai,b.jawatan,b.tarikh_lantikan
						FROM sej6x_data_peribadi a, data_pegawai_masjid b
						WHERE b.id_datapegawai='".$idd."' 
						AND a.id_data=b.id_pegawai";
                }
                if($r_result['id_pegawai2'] != NULL) {
                    $sql_search="SELECT CONCAT('A-', c.ID) 'id_data',c.nama_penuh,c.no_ic,c.no_tel'no_hp',a.alamat_terkini,a.poskod,c.jantina,c.tarikh_lahir,
						b.id_datapegawai,b.id_pegawai2 'id_ajk',b.jawatan,b.tarikh_lantikan
						FROM sej6x_data_peribadi a, data_pegawai_masjid b, sej6x_data_anakqariah c
						WHERE b.id_datapegawai='".$idd."' 
						AND c.ID=b.id_pegawai2 AND a.id_data=c.id_qariah";
                }
                if($r_result['id_pegawai']==NULL AND $r_result['id_pegawai2']==NULL){
                    $sql_search = "SELECT NULL 'id_data', nama_penuh, no_ic, no_tel, NULL 'alamat_terkinik', NULL 'poskod', NULL 'jantina', NULL 'tarikh_lahir',
                    id_datapegawai, NULL 'id_ajk', jawatan, tarikh_lantikan FROM data_pegawai_masjid WHERE id_datapegawai = '$idd'";
                }

					$result = mysqli_query($bd2, $sql_search) or die ("Error :".mysqli_error($bd2));
					$row=mysqli_fetch_array($result);
				?>
                <form action="admin/add_pegawai.php" method='post' enctype="multipart/form-data">
				<div class="card-body">
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>Nama: <?php echo $row['nama_penuh'];?></label>
							</div>
							<div class="form-group">
								<label>No K/P: <?php echo $row['no_ic'];?> </label>
							</div>
							<div class="form-group">
								<label>No Telefon: <?php echo $row['no_hp'];?> </label>
							</div>
							<div class="form-group">
								<label>Alamat: <?php echo $row['alamat_terkini'];?> </label>
							</div>
							<div class="form-group">
								<label>Poskod: <?php echo $row['poskod'];?> </label>
							</div>
							<div class="form-group">
								<label>Pekerjaan: <?php echo $row['pekerjaan'];?> </label>
							</div>
							<div class="form-group">
                                <label>Jantina:
                                    <?php
                                    if($row['jantina']=='1')
                                    {
                                        echo "LELAKI";
                                    }
                                    else if($row['jantina']=='2')
                                    {
                                        echo "PEREMPUAN";
                                    }
                                    ?>
                                </label>
							</div>
							<div class="form-group">
								<label>Tarikh Lahir: <?php echo $row['tarikh_lahir'];?> </label>
							 </div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
							<?php    
							
							$id_datapegawai = $_GET['id_datapegawai'];

							$q = "SELECT gambar FROM data_pegawai_masjid where id_datapegawai='$id_datapegawai'";
							$r = mysqli_query($bd2,$q);
							if($r)
							{
								$row1 = mysqli_fetch_array($r);
								$type = "Content-type: ".$row1['jenis_gambar'];
								//header($type);
								$image = $row1['gambar'];
								$jenis_gambar = $row['jenis_gambar'];
							}
							else
							{
								echo mysqli_error($bd2);
							}
							?>
                                <label>
                                    <input id="gambar" name="gambar" class="form-control" type="file" accept=".jpg,.gif,.png,.jpeg" onchange="preview_image(event, 'output1')">
                                    <?php echo '<img class="img-fluid p-3" id="output1" src="data:'.$jenis_gambar.';base64,'.$image .'" />'; ?>
                                </label>
							</div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Jawatan</label>
                                    <select class="form-control" name="jawatan" id="jawatan" required>
                                        <option value="">Sila Pilih</option>
                                        <option value="Imam" <?php if($row['jawatan'] == 'Imam') echo 'selected'; ?>>Imam </option>
                                        <!-- <option value="Imam Tambah" <?php //if($row['jawatan'] == 'Imam Tambah') echo 'selected'; ?>>Imam Tambah</option> -->
                                        <option value="Bilal" <?php if($row['jawatan'] == 'Bilal') echo 'selected'; ?>>Bilal </option>
                                        <!-- <option value="Bilal Tambah" <?php //if($row['jawatan'] == 'Bilal Tambah') echo 'selected'; ?>>Bilal Tambah </option> -->
                                        <option value="Siak" <?php if($row['jawatan'] == 'Siak') echo 'selected'; ?>>Siak </option>
                                        <!-- <option value="Siak Tambah" <?php //if($row['jawatan'] == 'Siak Tambah') echo 'selected'; ?>>Siak Tambah </option> -->
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Tarikh Lantikan</label>
                                    <input class="form-control" type="date" name="tarikh_lantikan" id="tarikh_lantikan" value="<?php echo $row['tarikh_lantikan']; ?>">
                                </div>
                            </div>
                                <div class="col-12 col-md-12">
                                    <input type="hidden" name="id_datapegawai" value="<?php echo $row['id_datapegawai']; ?>">
                                    <input type="hidden" name="id_pegawai" value="<?php echo $row['id_pegawai']; ?>">
                                    <input type="submit"  value="Kemaskini" class="btn btn-primary">
                                </div>
						</div>
					</div>
				</div>
                </form>
			</div>
		</div>
	</div>
</div>