<?php
$sql = "SELECT a.id_dataajk 'id_dataajk', a.jawatan 'jawatan', b.nama_penuh 'nama_penuh' FROM data_ajkmasjid a, sej6x_data_peribadi b WHERE a.id_ajk=b.id_data AND a.id_masjid='$id_masjid' ORDER BY (CASE a.jawatan WHEN 'Pengerusi' THEN 1 WHEN 'Timbalan Pengerusi' THEN 2 WHEN 'Setiausaha' THEN 3 WHEN 'Bendahari' THEN 4 WHEN 'AJK' THEN 5 ELSE 'Pemeriksa Kira-Kira' END), b.nama_penuh ASC";
$list_ajk = mysqli_query($bd2, $sql) or die(mysqli_error($bd2));
?>
<?php
if($_GET['action']=="inventori")
{
?>
<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Daftar Inventori</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li><a href="utama.php?view=admin&action=dashboard_selenggara">Menu Selenggara</a></li>
					<li class="active">Daftar Inventori</li>
				</ol>
			</div>
		</div>
	</div>
</div>
<?php
}
?>
<div class="content mt-3">
	<div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
					Maklumat Inventori
				</div>
				<div class="card-body">
					<form method="POST" action="admin/add_inventori.php" name="inventori">
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>Jenis Peralatan</label>
								<select class="form-control" name="jenis_inventori" required>
									<option value="">Sila Pilih Peralatan</option>
									<option value="1">Perkakas Dapur</option>
									<option value="2">Peralatan</option>
									<option value="3">Elektrik</option>
									<option value="4">Perabot</option>
									<option value="5">Kenderaan</option>
									<option value="6">Lain-Lain</option>
								</select>
							</div>
							<div class="form-group">
								<label>Nama AJK Yang Bertanggunjawab</label>
								<select class="form-control" name="id_ajk" required>
									<option value="">Sila Pilih AJK</option>
									<?php 
									while($row_list_ajk = mysqli_fetch_assoc($list_ajk)) 
									{ 
									?>
									<option value="<?php echo($row_list_ajk['id_dataajk']); ?>"><?php echo($row_list_ajk['nama_penuh']); ?> - <?php echo $row_list_ajk['jawatan']; ?></option>
									<?php 
									} 
									?>
								</select>
                            </div>
							<div class="form-group">
								<label>Nama Peralatan</label>
								<input class="form-control" name="nama_inventori" required>                
							</div>
							<div class="form-group">
								<label>Tarikh Belian/Terima</label>
								<input class="form-control" name="tarikh_belian" type="date">                
							</div>
							<div class="form-group">
								<label>Kuantiti/Luas</label>
							   <input type="text" class="form-control" name="kuantiti" required>                
							</div>
                        </div>
						<!-- /.col-lg-6 (nested) -->
                        <div class="col-lg-6">
							<div class="form-group">
								<label>Tempat/Lokasi(Simpan)</label>
							   <input class="form-control" name="lokasi">                
							</div>
                            <div class="form-group">
								<label>Harga Belian/Anggaran(RM)</label>
								<input class="form-control" placeholder="Contoh: 150.00" name="harga_belian">
							</div>
							<div class="form-group">
								<label>Bayaran Sewaan Sehari (RM)</label>
							   <input class="form-control" name="harga_sewa">                
							</div>
                            <div class="form-group">
								<label>Status Peralatan</label>
								<br>
								<label class="radio-inline">
									<input type="radio" name="status_belian" id="optionsRadiosInline1" value="Beli">Beli
								</label>
								<label class="radio-inline">
									<input type="radio" name="status_belian" id="optionsRadiosInline2" value="Sumbangan">Sumbangan
								</label>
							</div>
							<div class="form-group">
								<label>Catatan</label>
								<textarea class="form-control" rows="2" name="catatan"></textarea>
							</div>
						</div>
						<div class="col-lg-12" align="center">
							<button type="submit" class="btn btn-primary">Simpan</button>
 							<button type="reset" class="btn btn-primary">Padam</button>
						</div>
                        <!-- /.col-lg-6 (nested) -->
                    </div>
                    <!-- /.row (nested) -->
					</form>
                </div>
            </div>
		</div>
	</div>
</div>


