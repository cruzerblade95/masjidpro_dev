<?php
	include("connection/connection.php");
	   
	if(isset($_GET['id_data']))
	{
		$id_data=$_GET['id_data'];
		$sql4="SELECT * FROM data_kematian WHERE id_data='$id_data' AND id_masjid='$id_masjid'";
		$sqlquery4=mysql_query($sql4,$bd);
		$row4=mysql_num_rows($sqlquery4);
		$data4=mysql_fetch_array($sqlquery4);
	}
	else if(isset($_GET['id']))
	{
		$ID=$_GET['id'];
		$sql4="SELECT * FROM data_kematian WHERE id_anak='$ID' AND id_masjid='$id_masjid'";
		$sqlquery4=mysql_query($sql4,$bd);
		$row4=mysql_num_rows($sqlquery4);
		$data4=mysql_fetch_array($sqlquery4);
	}
	   
	if(isset($_POST['id_data'])) 
	{		
		$id_masjid=$_POST['id_masjid'];
		$id_data=$_POST['id_data'];

		$sql3="SELECT * FROM data_kematian WHERE id_data='$id_data' AND id_masjid='$id_masjid'";
		$sqlquery3=mysql_query($sql3,$bd);
		$row3=mysql_num_rows($sqlquery3);
		
		if($row3==0)
		{
		$tarikh_kematian=mysql_real_escape_string($_POST['tarikh_kematian']);
		$waktu_kematian=mysql_real_escape_string($_POST['waktu_kematian']);
		$sebab_kematian=mysql_real_escape_string($_POST['sebab_kematian']);
		$lokasi=mysql_real_escape_string($_POST['lokasi']);
		$tarikh_dikebumikan=mysql_real_escape_string($_POST['tarikh_dikebumikan']);
		$waktu_dikebumikan=mysql_real_escape_string($_POST['waktu_dikebumikan']);
		$no_kubur=mysql_real_escape_string($_POST['no_kubur']);
	   
		
		mysql_select_db($mysql_database, $bd);
		
		$sql1 ="INSERT INTO   	
				data_kematian(id_masjid,id_data,tarikh_kematian,waktu_kematian,sebab_kematian,lokasi,
				tarikh_dikebumikan,waktu_dikebumikan,no_kubur,time)
		
			  VALUES($id_masjid,$id_data,'$tarikh_kematian','$waktu_kematian','$sebab_kematian','$lokasi',
				'$tarikh_dikebumikan','$waktu_dikebumikan','$no_kubur',NOW())";
				
		//UPDATE
				
		$id_data=$_POST['id_data'];
				
		$sql2 ="UPDATE sej6x_data_peribadi set data_kematian=1 where id_data='$id_data'";		

		//mysql_query($sql1,$bd);
		//mysql_query($sql2,$bd);
		
		$sql4="SELECT * FROM data_kematian WHERE id_data='$id_data' AND id_masjid='$id_masjid'";
		$sqlquery4=mysql_query($sql4,$bd);
		$row4=mysql_num_rows($sqlquery4);
		$data4=mysql_fetch_array($sqlquery4);
		
		}
	}
	else if(isset($_POST['id']))
	{
		$id_masjid=$_POST['id_masjid'];
		$ID=$_POST['id'];
		
		$sql3="SELECT * FROM data_kematian WHERE id_anak='$ID' AND id_masjid='$id_masjid'";
		$sqlquery3=mysql_query($sql3,$bd);
		$row3=mysql_num_rows($sqlquery3);
		
		if($row3==0)
		{
		$tarikh_kematian=mysql_real_escape_string($_POST['tarikh_kematian']);
		$waktu_kematian=mysql_real_escape_string($_POST['waktu_kematian']);
		$sebab_kematian=mysql_real_escape_string($_POST['sebab_kematian']);
		$lokasi=mysql_real_escape_string($_POST['lokasi']);
		$tarikh_dikebumikan=mysql_real_escape_string($_POST['tarikh_dikebumikan']);
		$waktu_dikebumikan=mysql_real_escape_string($_POST['waktu_dikebumikan']);
		$no_kubur=mysql_real_escape_string($_POST['no_kubur']);
		
		$sql1 ="INSERT INTO   	
				data_kematian(id_masjid,id_anak,tarikh_kematian,waktu_kematian,sebab_kematian,lokasi,
				tarikh_dikebumikan,waktu_dikebumikan,no_kubur,time)
				VALUES($id_masjid,$ID,'$tarikh_kematian','$waktu_kematian','$sebab_kematian','$lokasi',
				'$tarikh_dikebumikan','$waktu_dikebumikan','$no_kubur',NOW())";
		
		//UPDATE
				
		$ID=$_POST['id'];
				
		$sql2 ="UPDATE sej6x_data_peribadi set data_kematian=1 where id_anak='$ID'";		

		mysql_query($sql1,$bd);
		mysql_query($sql2,$bd);
		
		$sql4="SELECT * FROM data_kematian WHERE id_anak='$ID' AND id_masjid='$id_masjid'";
		$sqlquery4=mysql_query($sql4,$bd);
		$row4=mysql_num_rows($sqlquery4);
		$data4=mysql_fetch_array($sqlquery4);
		
		}
	}
	
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
					<li><a href="utama.php?view=admin&action=daftar_kematian">Daftar Kematian Kariah</a></li>
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
					<?php 
					include("connection/connection.php");

					if(isset($_GET['id_data']))
					{
						$idd = $_GET['id_data'];

						$sql_search="SELECT 
						id_data,nama_penuh,no_ic,umur,alamat_terkini,no_hp
						FROM sej6x_data_peribadi WHERE id_data='".$idd."' "; 
						$result = mysql_query($sql_search) or die ("Error :".mysql_error());
					}
					if(isset($_GET['id']))
					{
						$id = $_GET['id'];

						$sql_search = "SELECT * FROM sej6x_data_anakqariah WHERE ID='$id'";
						$result = mysql_query($sql_search) or die ("Error :".mysql_error());
					}
					?>    
					<!-- Tab panes -->
					<div class="tab-content">
                        <div class="tab-pane fade show active" id="maklumat" role="tabpanel" aria-labelledby="tab-maklumat">
							<div class="card-body">
								<div class="row"> 
									<div class="col-lg-12">
									<form method="POST" action="<?php echo $PHP_SELF;?>" name="kematian">
									<?php 
									while($row = mysql_fetch_assoc($result))
									{ 
									?> 
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
									<hr>
								</div>
								<div class="row">
									<div class="col-lg-4">
										<div class="form-group">
											<label>Tarikh Kematian:</label>
											<input class="form-control" name="tarikh_kematian" id="tarikh_kematian" type="date" <?php if($row4>0) { if(($data4['tarikh_kematian']!=NULL) OR ($data4['tarikh_kematian']!='')) { ?> disabled value='<?php echo $data4['tarikh_kematian']; ?>' <?php } } ?> required>   
										</div>   
										<div class="form-group">
											<label>Waktu Kematian:</label>
									<input class="form-control" name="waktu_kematian" id="waktu_kematian" type="time" <?php if($row4>0) { if(($data4['waktu_kematian']!=NULL) OR ($data4['waktu_kematian']!='')) { ?> disabled value='<?php echo $data4['waktu_kematian']; ?>' <?php } } ?> required>   
										</div> 
										<div class="form-group">
											<label>Sebab Kematian:</label>
											<input class="form-control" name="sebab_kematian" id="sebab_kematian" <?php if($row4>0) { if(($data4['sebab_kematian']!=NULL) OR ($data4['sebab_kematian']!='')) { ?> disabled value='<?php echo $data4['sebab_kematian']; ?>' <?php } } ?> required>   
										</div>
									</div>                     
									<div class="col-lg-4">
										<div class="form-group">
											<label>Tarikh dikebumikan:</label>
											<input class="form-control" name="tarikh_dikebumikan" id="tarikh_dikebumikan" type="date" <?php if($row4>0) { if(($data4['tarikh_dikebumikan']!=NULL) OR ($data4['tarikh_dikebumikan']!='')) { ?> disabled value='<?php echo $data4['tarikh_dikebumikan']; ?>' <?php } } ?> requiredX>   
										</div> 
										<div class="form-group">
											<label>Waktu dikebumikan:</label>
											<input class="form-control" name="waktu_dikebumikan" id="waktu_dikebumikan" type="time" <?php if($row4>0) { if(($data4['waktu_dikebumikan']!=NULL) OR ($data4['waktu_dikebumikan']!='')) { ?> disabled value='<?php echo $data4['waktu_dikebumikan']; ?>' <?php } } ?> requiredX>   
										</div>  
										<div class="form-group">
											<label>Lokasi Tanah Perkuburan:</label>
											<input class="form-control" name="lokasi" id="lokasi" <?php if($row4>0) { if(($data4['lokasi']!=NULL) OR ($data4['lokasi']!='')) { ?> disabled value='<?php echo $data4['lokasi']; ?>' <?php } } ?> requiredX>   
										</div>  
									</div>      
									<div class="col-lg-4">
										<div class="form-group">
											<label>No. Kubur:</label>
											<input class="form-control" name="no_kubur" id="no_kubur" <?php if($row4>0) { if(($data4['no_kubur']!=NULL) OR ($data4['no_kubur']!='')) { ?> disabled value='<?php echo $data4['no_kubur']; ?>' <?php } } ?> >   
										</div> 
										<?php
										if(isset($_GET['id_data']))
										{		
										?>
											<input type="hidden" name="id_data" value="<?php echo $row['id_data']; ?>">
										<?php
										}
										?>
										<?php
										if(isset($_GET['id']))
										{		
										?>
											<input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
										<?php
										}
										?>
										<input type="hidden" name="id_masjid" value="<?php echo $id_masjid; ?>">    
										<input type="submit"  value="Simpan" class="btn btn-primary" <?php if($row4>0) { ?>style="display:none"<?php } ?>></input> 
									</div>
									<?php 
									} 
									?> 
									</form>
								</div>
							</div>
						</div>
                        <div class="tab-pane fade" id="perbelanjaan">
                            <?php 
							include("connection/connection.php");
						  
							if(isset($_GET['id_data']))
							{
								$idd = $_GET['id_data'];

								$sql_search="SELECT 
								id_data,nama_penuh,no_ic,umur,alamat_terkini,no_hp
								FROM sej6x_data_peribadi WHERE id_data='".$idd."' "; 
								$result = mysql_query($sql_search) or die ("Error :".mysql_error());
							}
							if(isset($_GET['id']))
							{
								$id = $_GET['id'];
								  
								$sql_search = "SELECT * FROM sej6x_data_anakqariah WHERE ID='$id'";
								$result = mysql_query($sql_search) or die ("Error :".mysql_error());
							}
							?>    
							<div class="card-body">
								<form action="admin/add_penyata_perbelanjaan.php" method='post'>
								<div class="row"> 
								<?php while($row = mysql_fetch_assoc($result)){ ?> 
									<div class="col-lg-12">
										<div class="form-group">
											<div class="alert alert-info">
												<div align="center"> 
													<label>Nama Kematian Kariah :</label><?php echo $row['nama_penuh'];?>
												</div>
												<div align="center"> 
													<label>No K/P:</label> <?php echo $row['no_ic'];?>
												</div>
											</div>
										</div>
									</div>
									<hr />
									<div class="col-lg-4">
                                        <div class="form-group">
											<div align="center">
												<label>(PERBELANJAAN ASAS)</label>
											</div>
							            </div>
                                        <div class="form-group">
							                <div align="center">
												<label>Mandi</label> :
											</div>
                                            <input type="number" class="form-control" placeholder="Contoh: 100.00" name="mandi" id="mandi" onInput="calcTotal()" required>               
							            </div>
										<div class="form-group">
											<div align="center"><label>Kain Kapan dan Kelengkapan</label>
											:</div>
										  <input type="number" class="form-control" placeholder="Contoh: 100.00" name="kain_kapan" id="kain_kapan" onInput="calcTotal()" required>                  
										</div>
										<div class="form-group">
											 <div align="center"><label>Keranda</label>
											 :</div>
										  <input type="number" class="form-control" placeholder="Contoh: 100.00" name="keranda" id="keranda" onInput="calcTotal()" required>
										</div>
										<div class="form-group">
											<div align="center"><label>Liang</label>
											:</div>
											<input type="number" class="form-control" placeholder="Contoh: 100.00" name="liang" id="liang" onInput="calcTotal()" required>
										</div>
										<div class="form-group">
											 <div align="center"><label>Imam / Talkin</label>
											 :
											 </div>
											<input type="number" class="form-control"placeholder="Contoh: 100.00" name="imam" id="imam" onInput="calcTotal()" required>
										</div>
										<div class="form-group">
											 <div align="center"><label>Caj Pengurusan Unit</label>
											 :</div>
											<input type="number" class="form-control" placeholder="Contoh: 100.00" name="caj_unit" id="caj_unit" onInput="calcTotal()" required>
										</div>
										<div class="form-group">
											 <div align="center">
											   <label>Caj Pengurusan Hospital (jika ada)</label>
											   :</div>
											<input type="number" class="form-control" placeholder="Contoh: 100.00" name="caj_hospital" id="caj_hospital" onInput="calcTotal()" required>
										</div>	
										<div class="form-group">
											 <div align="center"><label>[JUMLAH PERBELANJAAN ASAS]</label></div>
											<input type="number" class="form-control" placeholder="Contoh: 100.00" name="jumlah_asas" id="jumlah_asas" readonly>
										</div>	
									</div>   
									<div class="col-lg-4">
										<div class="form-group">
											<div align="center">
												<label>(PERBELANJAAN PILIHAN)</label>
											</div>
										</div>

							                                        <div class="form-group">
							                                            <div align="center"> <label>Jemputan Solat (bil.buah masjid)</label></div>
							                                           <input class="form-control"  name="jemputan_solat" id="jemputan_solat" onInput="calcTotal()" required>
							                                        </div>

							                                        <div class="form-group">
							                                            <div align="center">
							                                              <label>Solat Hadiah:</label></div>
						                                              <input class="form-control" name="solat_hadiah" id="solat_hadiah" placeholder="Contoh: 100.00" onInput="calcTotal()" required>	                  
							                                        </div> 
							                                        <div class="form-group">
							                                             <div align="center"><label>Sewa Van Jenazah</label>
							                                             :</div>
						                                              <input class="form-control" name="sewa_van" id="sewa_van" placeholder="Contoh: 100.00" onInput="calcTotal()" required>	                  
							                                        </div>

							                                        <div class="form-group">
							                                            <div align="center"> <label>Caj Selenggara Bukan Ahli Pakatan Khairat:</label></div>
							                                            <input class="form-control" placeholder="Contoh: 100.00" name="caj_bukan_pakatan" id="caj_bukan_pakatan" onInput="calcTotal()" required>                  
							                                        </div> 
                                                                    
							                                        <div class="form-group">
							                                             <div align="center">
							                                               <label>Lain-Lain Perbelanjaan (nyatakan)</label>
							                                               :</div>
							                                          <input class="form-control" placeholder="Contoh: 100.00" name="lain_perbelanjaan" id="lain_perbelanjaan" onInput="calcTotal()" required>                  	                  
							                                        </div> 
                                                                    
                                                                    
                                                                     <div class="form-group">
							                                            <div align="center"> <label>[JUMLAH PERBELANJAAN PILIHAN]</label></div>
							                                            <input class="form-control" placeholder="Contoh: 100.00" name="jum_belanja_pilihan" id="jum_belanja_pilihan" readonly>
							                                        </div>	   
                                         
                    </div>      
									<div class="col-lg-4">
										<div class="form-group">
											<div align="center">
												<label>(PENGIRAAN)</label>
											</div>
										</div>
							                                	    <div class="form-group">
							                                            <div align="center"><label>[JUMLAH SUMBANGAN PAKATAN]</label></div>
						                                              <input class="form-control" placeholder="Contoh: 100.00" name="jum_sumbangan_pakatan" id="jum_sumbangan_pakatan" onInput="calcTotal()" required>
							                                        </div>

							                                         <div class="form-group">
							                 <div align="center"><label>[JUMLAH PERBELANJAAN KESELURUHAN]</label></div>
							                   <input class="form-control" placeholder="Contoh: 100.00" name="jum_belanja_seluruh" id="jum_belanja_seluruh" readonly>
							                                       
							                                        </div>		
  <div class="form-group">
							                                            <div align="center"><label>[BAKI]</label></div>
							         <input class="form-control" placeholder="Contoh: 100.00" name="baki" id="baki" readonly>
							                                       
                    </div>	
                                                                    
                                      <div class="form-group">
                                      <?php
										if(isset($_GET['id_data']))
										{		
										?>
											<input type="hidden" name="id_data" value="<?php echo $row['id_data']; ?>">
										<?php
										}
										?>
										<?php
										if(isset($_GET['id']))
										{		
										?>
											<input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
										<?php
										}
										?>
										<input type="hidden" name="id_masjid" value="<?php echo $id_masjid; ?>">  
									<div align="center">
									<br>
									<br>
										<input type="submit"  value="Simpan" class="btn btn-primary"></input>
									</div>
                                    </div>
								</div>
								<?php } ?>
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