<?php 
include('connection/connection.php');
?>
<script src="js/jquery-3.4.1.js"></script>
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
							<a class="nav-link" href="#maklumat" data-toggle="tab">Maklumat Kematian</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#perbelanjaan" data-toggle="tab">Penyata Perbelanjaan Kematian</a>
						</li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane fade" id="maklumat">
							<?php 
							include("connection/connection.php");
							  
							$idd = $_GET['id_data'];

							$sql_search="SELECT 
							a.id_data,a.nama_penuh,a.no_ic,a.umur,a.alamat_terkini,a.no_hp,b.id_data,date_format(b.tarikh_kematian,'%d-%c-%Y') tarikh_kematian,
							b.waktu_kematian,b.sebab_kematian,date_format(b.tarikh_dikebumikan,'%d-%c-%Y') tarikh_dikebumikan,b.waktu_dikebumikan,b.lokasi,b.no_kubur 
							FROM sej6x_data_peribadi a, data_kematian b
							WHERE a.id_data=b.id_data 
							AND a.id_data='".$idd."' "; 
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
											<input class="form-control" name="tarikh_kematian" value="<?php echo $row['tarikh_kematian'];?>" requiredX>   
										</div>  
										<div class="form-group">
											<label>Waktu Kematian:</label>
											<input class="form-control" name="waktu_kematian" value="<?php echo $row['waktu_kematian'];?>" requiredX>   
										</div>  
										<div class="form-group">
											<label>Sebab Kematian:</label>
											<input class="form-control" name="sebab_kematian" value="<?php echo $row['sebab_kematian'];?>" requiredX>   
										</div>
									</div>                     
									<div class="col-lg-4">
										<div class="form-group">
											<label>Tarikh dikebumikan:</label>
											<input class="form-control" name="tarikh_dikebumikan" value="<?php echo $row['tarikh_dikebumikan'];?>" requiredX>   
										</div>   
										<div class="form-group">
											<label>Waktu dikebumikan:</label>
											<input class="form-control" name="waktu_dikebumikan" value="<?php echo $row['waktu_dikebumikan'];?>"requiredX>   
										</div> 
										<div class="form-group">
											<label>Lokasi Tanah Perkuburan:</label>
											<input class="form-control" name="lokasi" value="<?php echo $row['lokasi'];?>" requiredX>   
										</div>        
									</div>      
									<div class="col-lg-4">
										<div class="form-group">
											<label>No. Kubur:</label>
											<input class="form-control" name="no_kubur" value="<?php echo $row['no_kubur'];?>" requiredX>   
										</div>           
										<div class="form-group">
											<input type="hidden" name="id_data" value="<?php echo $row['id_data']; ?>">
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
								$idd = $_GET['id_data'];

								$sql_search="SELECT 
								a.id_data,a.nama_penuh,a.no_ic,IFNULL(b.mandi,0) mandi,IFNULL(b.kain_kapan,0) kain_kapan,IFNULL(b.keranda,0) keranda,
						  IFNULL(b.liang,0) liang,IFNULL(b.imam,0) imam,IFNULL(b.caj_unit,0) caj_unit,IFNULL(b.caj_hospital,0) caj_hospital,
                          IFNULL(b.jumlah_asas,0) jumlah_asas,IFNULL(b.jemputan_solat,0) jemputan_solat,
                          IFNULL(b.solat_hadiah,0) solat_hadiah,IFNULL(b.lain_perbelanjaan,0) lain_perbelanjaan,IFNULL(b.caj_bukan_pakatan,0) caj_bukan_pakatan,IFNULL(b.sewa_van,0) sewa_van,
						  IFNULL(b.jum_belanja_pilihan,0) jum_belanja_pilihan,IFNULL(b.jum_belanja_seluruh,0) jum_belanja_seluruh,IFNULL(b.jum_sumbangan_pakatan,0) jum_sumbangan_pakatan,
                          IFNULL(b.tolak_keseluruhan,0) tolak_keseluruhan,IFNULL(b.baki,0) baki
						  FROM sej6x_data_peribadi a left join sej6x_data_penyata_perbelanjaan b
                          on a.id_data=b.id_data
						  WHERE a.id_data='".$idd."'";
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
									<div class="col-lg-4 border">
										<div class="form-group">
											<div align="center">
												<label>(PERBELANJAAN ASAS)</label>
											</div>
										</div>		   
										<div class="form-group">
											<div align="center">
												<label>Mandi</label>:
											</div>
											<input class="form-control" name="mandi" id="mandi" value="<?php echo $row['mandi'];?>" onChange="addBelanjaAsasi()" type="number">               
										</div>
										<div class="form-group">
											<div align="center">
												<label>Kain Kapan dan Kelengkapan</label>:
											</div>
											<input class="form-control" name="kain_kapan" id="kain_kapan" value="<?php echo $row['kain_kapan'];?>" requiredx type="number" onChange="addBelanjaAsasi()">                  
										</div>
										<div class="form-group">
											<div align="center">
												<label>Keranda</label>:
											</div>
											<input class="form-control" name="keranda" id="keranda" value="<?php echo $row['keranda'];?>" requiredx type="number" onChange="addBelanjaAsasi()">
										</div>
										<div class="form-group">
											<div align="center">
												<label>Liang</label>:
											</div>
											<input class="form-control" name="liang" id="liang" value="<?php echo $row['liang'];?>" requiredx type="number" onChange="addBelanjaAsasi()">
										</div>
										<div class="form-group">
											<div align="center">
												<label>Imam / Talkin</label>:
											</div>
											<input class="form-control" name="imam" id="imam" value="<?php echo $row['imam'];?>"requiredx type="number" onChange="addBelanjaAsasi()">
										</div>
										<div class="form-group">
											<div align="center">
												<label>Caj Pengurusan Unit</label>:
											</div>
											<input class="form-control" name="caj_unit" id="caj_unit" value="<?php echo $row['caj_unit'];?>" requiredx type="number" onChange="addBelanjaAsasi()">
										</div>			
										<div class="form-group">
											<div align="center">
											   <label>Caj Pengurusan Hospital (jika ada)</label>:
											</div>
											<input class="form-control" name="caj_hospital" id="caj_hospital" value="<?php echo $row['caj_hospital'];?>"requiredx type="number" onChange="addBelanjaAsasi()">
										</div>				
										<div class="form-group">
											<div align="center">
												<label>[JUMLAH PERBELANJAAN ASAS]</label>
											</div>
											<input class="form-control" name="jumlah_asas" id="jumlah_asas" value="<?php echo $row['jumlah_asas'];?>" type="number" readonly>
										</div>	
									</div>                     
									<div class="col-lg-4 border">
										<div class="form-group">
											<div align="center">
												<label>(PERBELANJAAN PILIHAN)</label>
											</div>
										</div>
										<div class="form-group">
											<div align="center"> 
												<label>Jemputan Solat (bil.buah masjid)</label>
											</div>
											<input class="form-control" name="jemputan_solat" id="jemputan_solat" value="<?php echo $row['jemputan_solat'];?>" type="number" onChange="addBelanjaPilihan()">
										</div>
										<div class="form-group">
											<div align="center">
												<label>Solat Hadiah</label>:
											</div>
											<input class="form-control" name="solat_hadiah" id="solat_hadiah" value="<?php echo $row['solat_hadiah'];?>" type="number" onChange="addBelanjaPilihan()">	                  
										</div> 
										<div class="form-group">
											<div align="center">
												<label>Sewa Van Jenazah</label>:
											</div>
											<input class="form-control" name="sewa_van" id="sewa_van" value="<?php echo $row['sewa_van'];?>"requiredx type="number" onChange="addBelanjaPilihan()">	                  
										</div>
										<div class="form-group">
											<div align="center"> 
												<label>Caj Selenggara Bukan Ahli Pakatan Khairat:</label>
											</div>
											<input class="form-control" name="caj_bukan_pakatan" id="caj_bukan_pakatan" value="<?php echo $row['caj_bukan_pakatan'];?>"requiredx type="number" onChange="addBelanjaPilihan()">                  
										</div> 		
										<div class="form-group">
											<div align="center">
											   <label>Lain-Lain Perbelanjaan (nyatakan)</label>:
											</div>
											<input class="form-control" name="lain_perbelanjaan" id="lain_perbelanjaan" value="<?php echo $row['lain_perbelanjaan'];?>" requiredx type="number" onChange="addBelanjaPilihan()">                  	                  
										</div> 
										<div class="form-group">
											<div align="center"> 
												<label>[JUMLAH PERBELANJAAN PILIHAN]</label>
											</div>
											<input class="form-control" name="jum_belanja_pilihan" id="jum_belanja_pilihan" value="<?php echo $row['jum_belanja_pilihan'];?>" type="number" readonly />
										</div>	
										<div class="form-group">
											<div align="center"> 
												<label>[JUMLAH PERBELANJAAN KESELURUHAN]</label>
											</div>
											<input class="form-control" name="jum_belanja_seluruh" id="jum_belanja_seluruh" value="<?php echo $row['jum_belanja_seluruh'];?>"requiredx type="number" readonly>
										</div>	   
									</div>      
									<div class="col-lg-4 border">
										<div class="form-group">
											<div align="center">
												<label>(PENGIRAAN)</label>
											</div>
										</div>
										<div class="form-group">
											<div align="center">
												<label>[JUMLAH SUMBANGAN PAKATAN]</label>
											</div>
											<input class="form-control" name="jum_sumbangan_pakatan" id="jum_sumbangan_pakatan" value="<?php echo $row['jum_sumbangan_pakatan'];?>" type="number" onChange="addBaki()">
										</div>
										<div class="form-group">
											<div align="center">
												<label>[TOLAK JUMLAH PERBELANJAAN KESELURUHAN]</label>
											</div>
											<input class="form-control" name="tolak_keseluruhan" id="tolak_keseluruhan" value="<?php echo $row['tolak_keseluruhan'];?>" type="number" readonly>
										</div>		
										<div class="form-group">
											<div align="center">
												<label>[BAKI]</label>
											</div>
											<input class="form-control" name="baki" id="baki" value="<?php echo $row['baki'];?>" type="number" readonly>
										</div>	
										<div class="form-group">
											<input type="hidden" name="id_data" value="<?php echo $row['id_data']; ?>">
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
function addBelanjaAsasi(){
	var mandi = $("#mandi").val();
	var kainkapan = $("#kain_kapan").val();
	var keranda = $("#keranda").val();
	var liang = $("#liang").val();
	var imam = $("#imam").val();
	var cajunit= $("#caj_unit").val();
	var cajhospital = $("#caj_hospital").val();
	var jumlahpilihan = $("#jum_belanja_pilihan").val();

	 var jumlahasas = parseFloat(mandi) + parseFloat(kainkapan) + parseFloat(keranda) + parseFloat(liang) + parseFloat(imam) + parseFloat(cajunit) + parseFloat(cajhospital);

	$("#jumlah_asas").val(jumlahasas);

	$("#jum_belanja_seluruh").val(parseFloat(jumlahasas) + parseFloat(jumlahpilihan));

	$("#tolak_keseluruhan").val($("#jum_belanja_seluruh").val());
	
}

function addBelanjaPilihan(){
	var jemputansolat = $("#jemputan_solat").val();
	var solathadiah = $("#solat_hadiah").val();
	var sewavan = $("#sewa_van").val();
	var cajbukanpakatan = $("#caj_bukan_pakatan").val();
	var lainlain =$("#lain_perbelanjaan").val();
	var jumlahasas = $("#jumlah_asas").val();

	var jumlahlainlain = parseFloat(jemputansolat) + parseFloat(solathadiah) + parseFloat(sewavan) + parseFloat(cajbukanpakatan) + parseFloat(lainlain);

	$("#jum_belanja_pilihan").val(jumlahlainlain);

	$("#jum_belanja_seluruh").val(parseFloat(jumlahasas) + parseFloat(jumlahlainlain));

	$("#tolak_keseluruhan").val($("#jum_belanja_seluruh").val());
	
}

function addBaki(){
	var jumlahsumbangan = $("#jum_sumbangan_pakatan").val();
	var tolakbelanja = $("#tolak_keseluruhan").val();

	var baki = parseFloat(jumlahsumbangan) - parseFloat(tolakbelanja);
	
	$("#baki").val(baki);
}
</script>