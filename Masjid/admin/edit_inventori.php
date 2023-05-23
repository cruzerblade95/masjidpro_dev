<?php 

	//include("connection/connection.php");

	$idd = $_GET['id_inventori'];
	$tahun = $_GET['tarikh_belian'];
	$bil_tahun = $_GET['bil_tahun'];

	$sql_search="SELECT 
	id_inventori,jenis_inventori,nama_inventori,kuantiti,harga_belian, 			
	peratus,tarikh_belian,id_ajk,bil_tahun,kuantiti,harga_belian,status_belian,lokasi,harga_sewa,catatan,no_rujukan,(kuantiti*harga_belian) as 
	'amaun' FROM sej6x_data_inventori WHERE id_masjid = $id_masjid AND id_inventori='".$idd."'";
	$result = mysqli_query($bd2, $sql_search) or die ("Error :".mysqli_error($bd2));
	$row = mysqli_fetch_assoc($result);
	
	$sql1 = "SELECT a.id_dataajk 'id_dataajk', a.jawatan 'jawatan', b.nama_penuh 'nama_penuh' FROM data_ajkmasjid a, sej6x_data_peribadi b WHERE a.id_ajk=b.id_data AND a.id_masjid='$id_masjid' ORDER BY (CASE a.jawatan WHEN 'Pengerusi' THEN 1 WHEN 'Timbalan Pengerusi' THEN 2 WHEN 'Setiausaha' THEN 3 WHEN 'Bendahari' THEN 4 WHEN 'AJK' THEN 5 ELSE 'Pemeriksa Kira-Kira' END), b.nama_penuh ASC";
	$sqlquery1 = mysqli_query($bd2, $sql1) or die ("Error :".mysqli_error($bd2));;
?> 
<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Kemaskini Inventori</h1>
				<!-- <h1>Laporan Susut Nilai</h1> -->
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li><a href="utama.php?view=admin&action=maklumatinventori">Laporan Inventori</a></li>
					<li class="active">Kemaskini Inventori</li>
					<!-- <li class="active">Laporan Susut Nilai</li> -->
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
					Maklumat Inventori
				</div>
                <div class="card-body">
					<form method="POST" action="admin/update_inventori.php">
                    <div class="row">
						<div class="col-lg-6">
                            <div class="form-group">
								<label>Jenis Peralatan</label>
								<select class="form-control" name="jenis_inventori">
									<option>Sila Pilih Peralatan</option>
									<option value="1" <?php if($row['jenis_inventori']==1) { echo "selected"; } ?>>Perkakas Dapur</option>
									<option value="2" <?php if($row['jenis_inventori']==2) { echo "selected"; } ?>>Peralatan</option>
									<option value="3" <?php if($row['jenis_inventori']==3) { echo "selected"; } ?>>Elektrik</option>
									<option value="4" <?php if($row['jenis_inventori']==4) { echo "selected"; } ?>>Perabot</option>
									<option value="5" <?php if($row['jenis_inventori']==5) { echo "selected"; } ?>>Kenderaan</option>
									<option value="6" <?php if($row['jenis_inventori']==6) { echo "selected"; } ?>>Lain-Lain</option>
								</select>
							</div>
							<div class="form-group">
								<label>Nama AJK Yang Bertanggunjawab</label>
								<select class="form-control" name="id_ajk">
									<option>Sila Pilih AJK</option>
									<?php 
									$id_ajk=$row['id_ajk'];
									while($row_list_ajk = mysqli_fetch_array($sqlquery1))
									{ 
									?>
									<option value="<?php echo($row_list_ajk['id_dataajk']); ?>" <?php if($id_ajk==$row_list_ajk['id_dataajk']) { echo "selected"; } ?>><?php echo($row_list_ajk['nama_penuh']); ?> - <?php echo $row_list_ajk['jawatan']; ?></option>
									<?php 
									} 
									?>
								</select>
                            </div>
							<div class="form-group">
								<label>Nama Peralatan</label>
								<input class="form-control" name="nama_inventori" value="<?php echo $row['nama_inventori']; ?>" required>                
							</div>
							<div class="form-group">
								<label>Tarikh Belian/Terima</label>
								<input class="form-control" name="tarikh_belian" value="<?php echo $row['tarikh_belian']; ?>" type="date">                
							</div>
							<div class="form-group">
								<label>Kuantiti/Luas</label>
							   <input type="text" class="form-control" name="kuantiti" value="<?php echo $row['kuantiti']; ?>" required>                
							</div>
                        </div>
						<!-- /.col-lg-6 (nested) -->
                        <div class="col-lg-6">
							<div class="form-group">
								<label>Tempat/Lokasi(Simpan)</label>
							   <input class="form-control" name="lokasi" value="<?php echo $row['lokasi']; ?>">                
							</div>
                            <div class="form-group">
								<label>Harga Belian/Anggaran(RM)</label>
								<input class="form-control" placeholder="Contoh: 150.00" name="harga_belian" value="<?php echo $row['harga_belian']; ?>">
							</div>
							<div class="form-group">
								<label>Bayaran Sewaan Sehari (RM)</label>
							   <input class="form-control" name="harga_sewa" required value="<?php echo $row['harga_sewa']; ?>">                
							</div>
                            <div class="form-group">
								<label>Status Peralatan</label>
								<br>
								<label class="radio-inline">
									<input type="radio" name="status_belian" id="optionsRadiosInline1" value="Beli" <?php if($row['status_belian']=="Beli") { echo "checked"; } ?>>Beli
								</label>
								<label class="radio-inline">
									<input type="radio" name="status_belian" id="optionsRadiosInline2" value="Sumbangan" <?php if($row['status_belian']=="Sumbangan") { echo "checked"; } ?>>Sumbangan
								</label>
							</div>
							<div class="form-group">
								<label>Catatan</label>
								<textarea class="form-control" rows="2" name="catatan"><?php echo $row['catatan']; ?></textarea>
							</div>
						</div>
						<div class="col-lg-12" align="center">
							<div class="form-group">
								<input type="hidden" value="<?php echo $row['no_rujukan']; ?>" name="no_rujukan">
								<input type="hidden" value="<?php echo $id_masjid; ?>" name="id_masjid">
								<input type="hidden" value="<?php echo $row['id_inventori']; ?>" name="id_inventori">
								<input type="submit" value="Kemaskini" class="btn btn-success">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>