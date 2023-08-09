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
						  
						
								$idd = $_GET['id'];

								$sql_search="SELECT 
								id_data,nama_penuh,no_ic
								FROM sej6x_data_peribadi WHERE id_data='$idd' 
                                 union all 
                                 select id as id_data,nama_penuh,no_ic 
                                 from sej6x_data_anakqariah where id='$idd'"; 
								$result = mysql_query($sql_search) or die ("Error :".mysql_error());
							
							?>  
					<!-- Tab panes -->
					<div class="tab-content">
                        <div class="tab-pane fade show active" id="maklumat" role="tabpanel" aria-labelledby="tab-maklumat">
							<div class="card-body">
								<div class="row"> 
									<div class="col-lg-12">
									<form method="POST" action="admin/add_kematian.php" name="kematian">
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
											<input class="form-control" name="tarikh_kematian" id="tarikh_kematian" type="date" required>   
										</div>   
										<div class="form-group">
											<label>Waktu Kematian:</label>
											<input class="form-control" name="waktu_kematian" id="waktu_kematian" type="time" required>   
										</div> 
										<div class="form-group">
											<label>Sebab Kematian:</label>
											<input class="form-control" name="sebab_kematian" id="sebab_kematian" required>   
										</div>
									</div>                     
									<div class="col-lg-4">
										<div class="form-group">
											<label>Tarikh dikebumikan:</label>
											<input class="form-control" name="tarikh_dikebumikan" id="tarikh_dikebumikan" type="date" requiredX>   
										</div> 
										<div class="form-group">
											<label>Waktu dikebumikan:</label>
											<input class="form-control" name="waktu_dikebumikan" id="waktu_dikebumikan" type="time" requiredX>   
										</div>  
										<div class="form-group">
											<label>Lokasi Tanah Perkuburan:</label>
											<input class="form-control" name="lokasi" id="lokasi" requiredX>   
										</div>  
									</div>      
									<div class="col-lg-4">
										<div class="form-group">
											<label>No. Kubur:</label>
											<input class="form-control" name="no_kubur" id="no_kubur">   
										</div> 
										
											<input type="hidden" name="id_data" value="<?php echo $row['id_data']; ?>">
										
										<input type="hidden" name="id_masjid" value="<?php echo $id_masjid; ?>">    
										<input type="submit"  value="Simpan" class="btn btn-primary"></input> 
									</div>
									<?php }?>
									</form>
								</div>
							</div>
						</div>
                        <div class="tab-pane fade" id="perbelanjaan">
                            <?php 
							include("connection/connection.php");
						  
						
								$idd = $_GET['id'];

								$sql_search="SELECT 
								id_data,nama_penuh,no_ic
								FROM sej6x_data_peribadi WHERE id_data='$idd' 
                                 union all 
                                 select id as id_data,nama_penuh,no_ic 
                                 from sej6x_data_anakqariah where id='$idd'"; 
								$result = mysql_query($sql_search) or die ("Error :".mysql_error());
							
							?>    
							<div class="card-body">
								<div class="row"> 
								<form action="admin/add_penyata_perbelanjaan.php" method='post'>
                               
					    <?php while($row = mysql_fetch_assoc($result)){ ?> 
                        
                    <div class="col-lg-12">
                              <div class="form-group">
                               <div class="alert alert-info">
                                           <div align="center">  <label>Nama Kematian Kariah :</label> <?php echo $row['nama_penuh'];?></div>
                                     
                                            <div align="center"> <label>No K/P:</label> <?php echo $row['no_ic'];?></div></div>

                      </div>
                              </div>
   						   
                         <hr />
                          
                       
							                                
                    <div class="col-lg-4 border">
                                                            <div class="form-group">
							           <div align="center"><label>(PERBELANJAAN ASAS)</label></div>
							                                            
   
                      </div>
                                                               
							                                        <div class="form-group">
							                                            <div align="center"><label>Mandi</label>
							                                            :</div>
                                                                      <input class="form-control" placeholder="Contoh: 100.00" name="mandi" id="mandi" onChange="addBelanjaAsasi()" onBlur="addBelanjaAsasi()" type="number">               
							                                           
							                                        </div>

                                                                    <div class="form-group">
                                                                        <div align="center"><label>Kain Kapan dan Kelengkapan</label>
                                                                        :</div>
                                                                      <input class="form-control" placeholder="Contoh: 100.00" name="kain_kapan" id="kain_kapan" onChange="addBelanjaAsasi()" onBlur="addBelanjaAsasi()" type="number">                  
                                                                    </div>

							                                        <div class="form-group">
							                                             <div align="center"><label>Keranda</label>
							                                             :</div>
						                                              <input class="form-control" placeholder="Contoh: 100.00" name="keranda" id="keranda" onChange="addBelanjaAsasi()" onBlur="addBelanjaAsasi()" type="number">
							                                        </div>

							                                        <div class="form-group">
							                                            <div align="center"><label>Liang</label>
							                                            :</div>
							                                            <input class="form-control" placeholder="Contoh: 100.00" name="liang" id="liang" onChange="addBelanjaAsasi()" onBlur="addBelanjaAsasi()" type="number">
							                                        </div>

							                                        <div class="form-group">
							                                             <div align="center"><label>Imam / Talkin</label>
							                                             :
							                                             </div>
							                                            <input class="form-control"placeholder="Contoh: 100.00" name="imam" id="imam" onChange="addBelanjaAsasi()" onBlur="addBelanjaAsasi()" type="number">
							                                        </div>

							                                        <div class="form-group">
							                                             <div align="center"><label>Caj Pengurusan Unit</label>
							                                             :</div>
						                                              <input class="form-control" placeholder="Contoh: 100.00" name="caj_unit" id="caj_unit" onChange="addBelanjaAsasi()" onBlur="addBelanjaAsasi()" type="number">
							                                        </div>
                                                                    
                                                                     <div class="form-group">
							                                             <div align="center">
							                                               <label>Caj Pengurusan Hospital (jika ada)</label>
							                                               :</div>
							                                            <input class="form-control" placeholder="Contoh: 100.00" name="caj_hospital" id="caj_hospital" onChange="addBelanjaAsasi()" onBlur="addBelanjaAsasi()" type="number">
							                                        </div>	
                                                                    
                                                                     <div class="form-group">
							                                             <div align="center"><label>[JUMLAH PERBELANJAAN ASAS]</label></div>
							                                            <input class="form-control" placeholder="Contoh: 100.00" name="jumlah_asas" id="jumlah_asas" type="number" readonly>
							                                        </div>	
                    </div>                     
                            
                              <div class="col-lg-4 border">
   
                                 <div class="form-group">
							     <div align="center"><label>(PERBELANJAAN PILIHAN)</label></div>
							                                           
   
                                </div>

							                                        <div class="form-group">
							                                            <div align="center"> <label>Jemputan Solat (bil.buah masjid)</label></div>
							                                           <input class="form-control"  name="jemputan_solat" id="jemputan_solat" type="number" onChange="addBelanjaPilihan()" onBlur="addBelanjaPilihan()">
							                                        </div>

							                                        <div class="form-group">
							                                            <div align="center">
							                                              <label>Solat Hadiah:</label></div>
						                                              <input class="form-control" name="solat_hadiah" id="solat_hadiah" placeholder="Contoh: 100.00" type="number" onChange="addBelanjaPilihan()" onBlur="addBelanjaPilihan()">	                  
							                                        </div> 
							                                        <div class="form-group">
							                                             <div align="center"><label>Sewa Van Jenazah</label>
							                                             :</div>
						                                              <input class="form-control" name="sewa_van" id="sewa_van" placeholder="Contoh: 100.00" type="number" onChange="addBelanjaPilihan()" onBlur="addBelanjaPilihan()">	                  
							                                        </div>

							                                        <div class="form-group">
							                                            <div align="center"> <label>Caj Selenggara Bukan Ahli Pakatan Khairat:</label></div>
							                                            <input class="form-control" placeholder="Contoh: 100.00" name="caj_bukan_pakatan" id="caj_bukan_pakatan" type="number" onChange="addBelanjaPilihan()" onBlur="addBelanjaPilihan()">                  
							                                        </div> 
                                                                    
							                                        <div class="form-group">
							                                             <div align="center">
							                                               <label>Lain-Lain Perbelanjaan (nyatakan)</label>
							                                               :</div>
							                                          <input class="form-control" placeholder="Contoh: 100.00" name="lain_perbelanjaan" id="lain_perbelanjaan" type="number" onChange="addBelanjaPilihan()" onBlur="addBelanjaPilihan()">                  	                  
							                                        </div> 
                                                                    
                                                                    
                                                                     <div class="form-group">
							                                            <div align="center"> <label>[JUMLAH PERBELANJAAN PILIHAN]</label></div>
							                                            <input class="form-control" placeholder="Contoh: 100.00" name="jum_belanja_pilihan" id="jum_belanja_pilihan" type="number" readonly>
							                                        </div>	
                                                                    
                                                                    
                                                                     <div class="form-group">
							                                            <div align="center"> <label>[JUMLAH PERBELANJAAN KESELURUHAN]</label></div>
							                                            <input class="form-control" placeholder="Contoh: 100.00" name="jum_belanja_seluruh" id="jum_belanja_seluruh" type="number" readonly>
							                                        </div>	   
                                         
                    </div>      


                                <div class="col-lg-4 border">
                                    
                                     <div class="form-group">
							            <div align="center"><label>(PENGIRAAN)</label></div>
   
                    </div>
							                                	    <div class="form-group">
							                                            <div align="center"><label>[JUMLAH SUMBANGAN PAKATAN]</label></div>
						                                              <input class="form-control" placeholder="Contoh: 100.00" name="jum_sumbangan_pakatan" id="jum_sumbangan_pakatan" type="number" onChange="addBaki()" onBlur="addBaki()">
							                                        </div>

							                                         <div class="form-group">
							                 <div align="center"><label>[TOLAK JUMLAH PERBELANJAAN KESELURUHAN]</label></div>
							                   <input class="form-control" placeholder="Contoh: 100.00" name="tolak_keseluruhan" id="tolak_keseluruhan" type="number" readonly>
							                                       
							                                        </div>		
  <div class="form-group">
							                                            <div align="center"><label>[BAKI]</label></div>
							         <input class="form-control" placeholder="Contoh: 100.00" name="baki" id="baki" type="number" readonly>
							                                       
                    </div>	
                                                                    
                                      <div class="form-group">
									
											<input type="hidden" name="id_data" value="<?php echo $row['id_data']; ?>">
										<input type="hidden" name="id_masjid" value="<?php echo $id_masjid; ?>">  
									<div align="center">
									<br>
									<br>
										<input type="submit"  value="Simpan" class="btn btn-primary"></input>
									</div>
                                    </div>
                    <?php }?>  
                   
                            </form>
                        </div>
                        </div>
                    </div>
                               
                            </div>
                    </div>
                    </div>
                    <!-- /.panel -->
        </div>
	</div>
</div>
<script>
function addBelanjaAsasi(){
	var mandi = $("#mandi").val() || 0;
	var kainkapan = $("#kain_kapan").val() || 0;
	var keranda = $("#keranda").val() || 0;
	var liang = $("#liang").val() || 0;
	var imam = $("#imam").val() || 0;
	var cajunit= $("#caj_unit").val() || 0;
	var cajhospital = $("#caj_hospital").val() || 0;
	var jumlahpilihan = $("#jum_belanja_pilihan").val() || 0;


	 var jumlahasas = parseFloat(mandi) + parseFloat(kainkapan) + parseFloat(keranda) + parseFloat(liang) + parseFloat(imam) + parseFloat(cajunit) + parseFloat(cajhospital);

	 
	$("#jumlah_asas").val(jumlahasas);

	$("#jum_belanja_seluruh").val(parseFloat(jumlahasas) + parseFloat(jumlahpilihan));

	$("#tolak_keseluruhan").val($("#jum_belanja_seluruh").val());
	
}

function addBelanjaPilihan(){
	var jemputansolat = $("#jemputan_solat").val() || 0;
	var solathadiah = $("#solat_hadiah").val() || 0;
	var sewavan = $("#sewa_van").val() || 0;
	var cajbukanpakatan = $("#caj_bukan_pakatan").val() || 0;
	var lainlain =$("#lain_perbelanjaan").val() || 0;
	var jumlahasas = $("#jumlah_asas").val() || 0;

	var jumlahlainlain = parseFloat(jemputansolat) + parseFloat(solathadiah) + parseFloat(sewavan) + parseFloat(cajbukanpakatan) + parseFloat(lainlain);

	$("#jum_belanja_pilihan").val(jumlahlainlain);

	$("#jum_belanja_seluruh").val(parseFloat(jumlahasas) + parseFloat(jumlahlainlain));

	$("#tolak_keseluruhan").val($("#jum_belanja_seluruh").val());
	
}

function addBaki(){
	var jumlahsumbangan = $("#jum_sumbangan_pakatan").val() || 0;
	var tolakbelanja = $("#tolak_keseluruhan").val() || 0;

	var baki = parseFloat(jumlahsumbangan) - parseFloat(tolakbelanja);
	
	$("#baki").val(baki);
}
</script>