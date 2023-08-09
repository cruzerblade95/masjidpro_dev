<?php 
include('connection/connection.php');
?>
<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Butiran Kematian Kariah</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li><a href="utama.php?view=admin&action=pendaftaran">Menu Pendaftaran</a></li>
					<li><a href="utama.php?view=admin&action=pendaftaran_kematian">Senarai Kematian Kariah</a></li>
					<li class="active">Butiran Kematian Kariah</li>
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
					Maklumat Kematian
				</div>
				<div class="card-body">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs nav-justified">
						<li class="nav-item">
							<a class="nav-link active" href="#maklumat" data-toggle="tab" id="tab-maklumat" role="tab" aria-controls="maklumat" aria-selected="true">Maklumat Kematian</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#perbelanjaan" data-toggle="tab">Penyata Perbelanjaan Kematian</a>
						</li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane fade show active" id="maklumat" role="tabpanel" aria-labelledby="tab-maklumat">
							<?php 
							include("connection/connection.php");
							  
							if(isset($_GET['id_data']))
							{
								$id_data=$_GET['id_data'];
								
								$sql_search="SELECT 
								a.id_data,a.nama_penuh,a.no_ic,a.umur,a.alamat_terkini,a.no_hp,b.id_data,b.tarikh_kematian,
								b.waktu_kematian,b.sebab_kematian,b.tarikh_dikebumikan,b.waktu_dikebumikan,b.lokasi,b.no_kubur 
								FROM sej6x_data_peribadi a, data_kematian b
								WHERE a.id_data=b.id_data 
								AND a.id_data='".$id_data."' "; 
							}
							else if(isset($_GET['id']))
							{
								$ID=$_GET['id'];
								
								$sql_search="SELECT 
								a.ID,a.nama_penuh,a.no_ic,a.no_tel,b.id_anak,b.tarikh_kematian,
								b.waktu_kematian,b.sebab_kematian,b.tarikh_dikebumikan,b.waktu_dikebumikan,b.lokasi,b.no_kubur 
								FROM sej6x_data_anakqariah a, data_kematian b
								WHERE a.ID=b.id_anak 
								AND a.ID='".$ID."' "; 
							}
							$result = mysql_query($sql_search) or die ("Error :".mysql_error());
							?>   
							<div class="card-body">
								<form action="admin/add_kematian.php" method="POST">
								<?php 
								while($row = mysql_fetch_assoc($result))
								{ 
								?> 
								<div class="row"> 
									<div class="col-lg-12">
										<div class="form-group">
											<div class="alert alert-info">
												<div align="center">  
													<label>Nama Kematian Kariah :</label> <?php echo $row['nama_penuh'];?>
												</div>
												<div align="center"> 
													<label>No K/P:</label> <?php echo $row['no_ic'];?>
												</div>
											</div>
										</div>
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col-lg-4">
										<div class="form-group">
											<label>Tarikh Kematian:</label>
											<input type="date" class="form-control" name="tarikh_kematian" value="<?php echo $row['tarikh_kematian'];?>" requiredx>   
										</div>  
										<div class="form-group">
											<label>Waktu Kematian:</label>
											<input type="time" class="form-control" name="waktu_kematian" value="<?php echo $row['waktu_kematian'];?>" requiredx>   
										</div>  
										<div class="form-group">
											<label>Sebab Kematian:</label>
											<input type="text" class="form-control" name="sebab_kematian" value="<?php echo $row['sebab_kematian'];?>" requiredx>   
										</div>
									</div>                     
									<div class="col-lg-4">
										<div class="form-group">
											<label>Tarikh dikebumikan:</label>
											<input type="date" class="form-control" name="tarikh_dikebumikan" value="<?php echo $row['tarikh_dikebumikan'];?>" requiredx>   
										</div>   
										<div class="form-group">
											<label>Waktu dikebumikan:</label>
											<input type="time" class="form-control" name="waktu_dikebumikan" value="<?php echo $row['waktu_dikebumikan'];?>"requiredx>   
										</div> 
										<div class="form-group">
											<label>Lokasi Tanah Perkuburan:</label>
											<input type="text" class="form-control" name="lokasi" value="<?php echo $row['lokasi'];?>" requiredx>   
										</div>        
									</div>      
									<div class="col-lg-4">
										<div class="form-group">
											<label>No. Kubur:</label>
											<input type="text" class="form-control" name="no_kubur" value="<?php echo $row['no_kubur'];?>" requiredx>   
										</div>           
										<div class="form-group">
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
											<div align="center">
												<br><br>
												<input type="submit"  value="Kemaskini" class="btn btn-primary"></input>
											</div>
										</div>
									</div>
								</div>
								<?php 
								}
								?> 
								</form>
							</div>
						</div>
						<div class="tab-pane fade" id="perbelanjaan">
							<?php 
								if(isset($_GET['id_data']))
								{
									$id_data = $_GET['id_data'];

									$sql_search="SELECT 
									a.id_data,a.nama_penuh,a.no_ic,b.id_data,b.mandi,b.kain_kapan,b.keranda,
									b.liang,b.imam,b.caj_unit,b.caj_hospital,b.jumlah_asas,b.jemputan_solat,b.solat_hadiah,b.lain_perbelanjaan,b.caj_bukan_pakatan,b.sewa_van,
									b.jum_belanja_pilihan,b.jum_belanja_seluruh,b.jum_sumbangan_pakatan,b.baki
									FROM sej6x_data_peribadi a, sej6x_data_penyata_perbelanjaan b
									WHERE a.id_data='".$id_data."' 
									AND a.id_data=b.id_data "; 
								}
								else if(isset($_GET['id']))
								{
									$ID = $_GET['id'];
									
									$sql_search="SELECT 
									a.ID,a.nama_penuh,a.no_ic,b.id_anak,b.mandi,b.kain_kapan,b.keranda,
									b.liang,b.imam,b.caj_unit,b.caj_hospital,b.jumlah_asas,b.jemputan_solat,b.solat_hadiah,b.lain_perbelanjaan,b.caj_bukan_pakatan,b.sewa_van,
									b.jum_belanja_pilihan,b.jum_belanja_seluruh,b.jum_sumbangan_pakatan,b.baki
									FROM sej6x_data_anakqariah a, sej6x_data_penyata_perbelanjaan b
									WHERE a.ID='".$ID."' 
									AND a.ID=b.id_anak ";
								}
								
								$result = mysql_query($sql_search) or die ("Error :".mysql_error());
								$row = mysql_fetch_assoc($result);
							?>    
							<div class="card-body">
								<form action="pendaftaran/add_penyata_perbelanjaan.php" method="POST">
								
								<div class="row"> 
									<div class="col-lg-12">
										<div class="form-group">
											<div class="alert alert-info">
												<div align="center">  
													<label>Nama Kematian Kariah :</label> <?php echo $row['nama_penuh'];?>
												</div>
												<div align="center"> 
													<label>No K/P:</label> <?php echo $row['no_ic'];?>
												</div>
											</div>
										</div>
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col-lg-4">
										<div class="form-group">
											<div align="center">
												<label>(PERBELANJAAN ASAS)</label>
											</div>
										</div>		   
										<div class="form-group">
											<div align="center">
												<label>Mandi</label>:
											</div>
											<input type="number" class="form-control" name="mandi" id="mandi" value="<?php echo $row['mandi'];?>" onInput="calcTotal()" required>               
										</div>
										<div class="form-group">
											<div align="center">
												<label>Kain Kapan dan Kelengkapan</label>:
											</div>
											<input type="number" class="form-control" name="kain_kapan" id="kain_kapan" value="<?php echo $row['kain_kapan'];?>" onInput="calcTotal()" required>                  
										</div>
										<div class="form-group">
											<div align="center">
												<label>Keranda</label>:
											</div>
											<input type="number" class="form-control" name="keranda" id="keranda" value="<?php echo $row['keranda'];?>" onInput="calcTotal()" required>
										</div>
										<div class="form-group">
											<div align="center">
												<label>Liang</label>:
											</div>
											<input type="number" class="form-control" name="liang" id="liang" value="<?php echo $row['liang'];?>" onInput="calcTotal()" required>
										</div>
										<div class="form-group">
											<div align="center">
												<label>Imam / Talkin</label>:
											</div>
											<input type="number" class="form-control" name="imam" id="imam" value="<?php echo $row['imam'];?>" onInput="calcTotal()" required>
										</div>
										<div class="form-group">
											<div align="center">
												<label>Caj Pengurusan Unit</label>:
											</div>
											<input type="number" class="form-control" name="caj_unit" id="caj_unit" value="<?php echo $row['caj_unit'];?>" onInput="calcTotal()" required>
										</div>			
										<div class="form-group">
											<div align="center">
											   <label>Caj Pengurusan Hospital (jika ada)</label>:
											</div>
											<input type="number" class="form-control" name="caj_hospital" id="caj_hospital" value="<?php echo $row['caj_hospital'];?>" onInput="calcTotal()" required>
										</div>				
										<div class="form-group">
											<div align="center">
												<label>[JUMLAH PERBELANJAAN ASAS]</label>
											</div>
											<input type="number" class="form-control" name="jumlah_asas" id="jumlah_asas" value="<?php echo $row['jumlah_asas'];?>" readonly required>
										</div>	
									</div>                     
									<div class="col-lg-4">
										<div class="form-group">
											<div align="center">
												<label>(PERBELANJAAN PILIHAN)</label>
											</div>
										</div>
										<div class="form-group">
											<div align="center"> 
												<label>Jemputan Solat (bil.buah masjid)</label>
											</div>
											<input type="number" class="form-control" name="jemputan_solat" id="jemputan_solat" value="<?php echo $row['jemputan_solat'];?>" onInput="calcTotal()" required>
										</div>
										<div class="form-group">
											<div align="center">
												<label>Solat Hadiah</label>:
											</div>
											<input type="number" class="form-control" name="solat_hadiah" id="solat_hadiah" value="<?php echo $row['solat_hadiah'];?>" onInput="calcTotal()" required>	                  
										</div> 
										<div class="form-group">
											<div align="center">
												<label>Sewa Van Jenazah</label>:
											</div>
											<input type="number" class="form-control" name="sewa_van" id="sewa_van" value="<?php echo $row['sewa_van'];?>" onInput="calcTotal()" required>	                  
										</div>
										<div class="form-group">
											<div align="center"> 
												<label>Caj Selenggara Bukan Ahli Pakatan Khairat:</label>
											</div>
											<input type="number" class="form-control" name="caj_bukan_pakatan" id="caj_bukan_pakatan" value="<?php echo $row['caj_bukan_pakatan'];?>" onInput="calcTotal()" required>                  
										</div> 		
										<div class="form-group">
											<div align="center">
											   <label>Lain-Lain Perbelanjaan (nyatakan)</label>:
											</div>
											<input type="number" class="form-control" name="lain_perbelanjaan" id="lain_perbelanjaan" value="<?php echo $row['lain_perbelanjaan'];?>" onInput="calcTotal()" required>                  	                  
										</div> 
										<div class="form-group">
											<div align="center"> 
												<label>[JUMLAH PERBELANJAAN PILIHAN]</label>
											</div>
											<input type="number" class="form-control" name="jum_belanja_pilihan" id="jum_belanja_pilihan" value="<?php echo $row['jum_belanja_pilihan'];?>" readonly required />
										</div>	   
									</div>      
									<div class="col-lg-4">
										<div class="form-group">
											<div align="center">
												<label>(PENGIRAAN)</label>
											</div>
										</div>
										<div class="form-group">
											<div align="center">
												<label>[JUMLAH SUMBANGAN PAKATAN]</label>
											</div>
											<input type="number" class="form-control" name="jum_sumbangan_pakatan" id="jum_sumbangan_pakatan" value="<?php echo $row['jum_sumbangan_pakatan'];?>" onInput="calcTotal()" required>
										</div>
										<div class="form-group">
											<div align="center"> 
												<label>[JUMLAH PERBELANJAAN KESELURUHAN]</label>
											</div>
											<input type="number" class="form-control" name="jum_belanja_seluruh" id="jum_belanja_seluruh" value="<?php echo $row['jum_belanja_seluruh'];?>" readonly required>
										</div>	
										<div class="form-group">
											<div align="center">
												<label>[BAKI]</label>
											</div>
											<input type="number" class="form-control" name="baki" id="baki" value="<?php echo $row['baki'];?>" readonly>
										</div>	
										<div class="form-group">
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
											<div align="center">
												<br><br>
												<input type="submit" value="Kemaskini" class="btn btn-primary"></input>
											</div>
										</div>
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
</div>
<script>
function total_asas() {
	var total_asas = 0;
	var mandi = parseFloat(document.getElementById('mandi').value);
	var kain_kapan = parseFloat(document.getElementById('kain_kapan').value);
	var keranda = parseFloat(document.getElementById('keranda').value);
	var liang = parseFloat(document.getElementById('liang').value);
	var imam = parseFloat(document.getElementById('imam').value);
	var caj_unit = parseFloat(document.getElementById('caj_unit').value);
	var caj_hospital = parseFloat(document.getElementById('caj_hospital').value);
	
	total_asas = mandi+kain_kapan+keranda+liang+imam+caj_unit+caj_hospital;
	
	document.getElementById('jumlah_asas').value = total_asas.toFixed(2);
	
	return total_asas;
}
function total_pilihan() {
	var total_pilihan = 0;
	var jemputan_solat = parseFloat(document.getElementById('jemputan_solat').value);
	var solat_hadiah = parseFloat(document.getElementById('solat_hadiah').value);
	var sewa_van = parseFloat(document.getElementById('sewa_van').value);
	var caj_bukan_pakatan = parseFloat(document.getElementById('caj_bukan_pakatan').value);
	var lain_perbelanjaan = parseFloat(document.getElementById('lain_perbelanjaan').value);
	
	total_pilihan = jemputan_solat+solat_hadiah+sewa_van+caj_bukan_pakatan+lain_perbelanjaan;
	
	document.getElementById('jum_belanja_pilihan').value = total_pilihan.toFixed(2);
	
	return total_pilihan;
}
function calcTotal() {
	var total_belanja = parseFloat(total_asas()) + parseFloat(total_pilihan());
	
	document.getElementById('jum_belanja_seluruh').value = total_belanja.toFixed(2);
	
	var sumbangan_pakatan = parseFloat(document.getElementById('jum_sumbangan_pakatan').value);
	
	var baki = total_belanja-sumbangan_pakatan;
	baki = baki.toFixed(2);
	
	document.getElementById('baki').value = baki;
	
}
</script>