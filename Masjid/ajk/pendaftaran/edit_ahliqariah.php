
    <div class="row">
                <div class="col-lg-12">
                    <h2 align="center" class="page-header">KEMASKINI MAKLUMAT AHLI QARIAH</h2>
                </div>
                <!-- /.col-lg-12 -->
</div>
  <?php 
                          include("connection/connection.php");
						  
						  $idd = $_GET['id_data'];
						  
						  $sql_search="SELECT id_data,nama_penuh,no_ic,umur,alamat_terkini,no_hp,poskod,pendapatan,pekerjaan,majikan,id_negeri,id_daerah,tahap_pendidikan,status_perkahwinan,bangsa
						  FROM sej6x_data_peribadi
						  WHERE id_data='".$idd."' ";
	                      $r = mysql_query("$sql_search",$bd);
		                  if($r)
						   {
						  while($row=mysql_fetch_array($r))
							{
							$id_data=$row['id_data'];
						  ?>  

          <div class="row">
							                <div class="col-lg-12">
							                    <div class="panel panel-info">
							                       <!--  <div class="panel-heading">
							                            MAKLUMAT PERIBADI
							                        </div> -->
							                        <div class="panel-body">
							                           
                                                        <div class="row">
							                            	<h4 align="center"><u>Maklumat Ahli</u></h4>
							                                
							                                <div class="col-lg-4">
							                                 
							                                        <div class="form-group">
							                                            <label>Nama Penuh</label>
							                                            <input type="text" name="nama_penuh" class="form-control" value="<?php echo $row['nama_penuh'];?>" required>
							                                        </div>

							                                        <div class="form-group">
							                                            <label>No IC</label>
							                                             <input type="text" name="no_ic" class="form-control" value="<?php echo $row['no_ic'];?>" required>
							                                        </div>

							                                        <div class="form-group">
							                                            <label>Umur</label>
							                                             <input type="text" name="umur" class="form-control" value="<?php echo $row['umur'];?>" required>
							                                        </div>

							                                        <div class="form-group">
							                                            <label>Bangsa</label>
							                                            <select class="form-control" name="bangsa" value="<?php echo $row['bangsa'];?>" >
							                                                <option>Sila Pilih</option>
							                                                <option value="Melayu">Melayu</option>
							                                                <option value="Cina">Cina</option>
							                                                <option value="India">India</option>
							                                                <option value="Lain-lain">Lain-lain</option>
							                                            </select>
							                                        </div>

							                                        <div class="form-group">
							                                            <label>Status Perkahwinan</label>
							                                            <select class="form-control" name="status_perkahwinan" required>
							                                                <option value=>Sila Pilih</option>
							                                                <option value="Bujang">Bujang</option>
							                                                <option value="Berkahwin">Berkahwin</option>
							                                                <option value="Duda">Duda</option>
							                                                <option value="Janda">Janda</option>
							                                            </select>
							                                        </div>

							                                        <div class="form-group">
							                                            <label>No Telefon</label>
							                                             <input type="text" name="no_hp" class="form-control" value="<?php echo $row['no_hp'];?>" required>
							                                        </div>	

							                                </div>
							                                <!-- /.col-lg-4 (nested) -->



							                                <div class="col-lg-4">	

							                                        <div class="form-group">
							                                            <label>Tahap Pendidikan</label>
							                                            <select class="form-control" name="tahap_pendidikan" value="<?php echo $row['tahap_pendidikan'];?>" required>
							                                                <option>Sila Pilih</option>
							                                                <option value="UPSR">UPSR / PMR</option>
							                                                <option value="SPM">SPM</option>
							                                                <option value="STPM">STPM / Diploma</option>
							                                                <option value="Ijazah">Ijazah Sarjana Muda</option>
							                                                <option value="Master">Ijazah Sarjana</option>
							                                                <option value="PHD">Ijazah Kedoktoran</option>
							                                            </select>
							                                        </div>

							                                        <div class="form-group">
							                                            <label>Pekerjaan</label>
							                                            <input class="form-control" name="pekerjaan" value="<?php echo $row['pekerjaan'];?>" >	                  
							                                        </div> 
							                                        <div class="form-group">
							                                            <label>Majikan / Syarikat</label>
							                                            <input class="form-control" name="majikan" value="<?php echo $row['majikan'];?>" >	                  
							                                        </div>

							                                        <div class="form-group">
							                                            <label>Status Pekerjaan</label>
							                                            <select class="form-control" name="status_pekerjaan" value="<?php echo $row['status'];?>" required>
							                                            <option>Sila Pilih</option>
							                                                <option value="Tetap">Tetap</option>
							                                                <option value="Kontrak">Kontrak</option>
							                                            </select>                  
							                                        </div> 
							                                        <div class="form-group">
							                                            <label>Pendapatan Bulanan</label>
							                                            <input class="form-control" name="pendapatan" value="<?php echo $row['pendapatan'];?>" >	                  
							                                        </div> 

							                                </div>
							                                <!-- /.col-lg-4 (nested) -->




							                            <div class="row">
							                                <div class="col-lg-4">
							                                	    <div class="form-group">
							                                            <label>No Rumah (Alamat Terkini)</label>
							                                           <input type="text" name="alamat_terkini" class="form-control" value="<?php echo $row['alamat_terkini'];?>" required>
							                                        </div>

							                                        <div class="form-group">
							                                            <label>Negeri</label>
							                                            <select class="form-control" name="negeri" value="<?php echo $row['id_negeri'];?>" required>
							                                            <option>Sila Pilih</option>
							                                                <option value="Pulau Pinang">Pulau Pinang</option>
							                                                <option value="Perlis">Perlis</option>
							                                                <option value="Kedah">Kedah</option>
							                                                <option value="Peark">Perak</option>
							                                                <option value="Selangor">Selangor</option>	
							                                                <option value="Negeri Sembilan">Negeri Sembilan</option>	
							                                                <option value="Melaka">Melaka</option>	
							                                                <option value="Johor">Johor</option>	
							                                                <option value="Kelantan">Kelantan</option>	
							                                                <option value="Pahang">Pahang</option>	
							                                                <option>Terengganu</option>
							                                                <option value="Sabah">Sabah</option>	
							                                                <option value="Sarawak">Sarawak</option>
							                                                <option value="Wilayah Persekutuan">Wilayah Persekutuan</option>				
							                                                <option value="Wilayah Labuan">Wilayah Labuan</option>
							                                            </select>
							                                        </div>		

							                                        <div class="form-group">
							                                            <label>Daerah</label>
							                                            <select class="form-control" name="daerah" value="<?php echo $row['id_daerah'];?>" required>
							                                            <option>Sila Pilih</option>
							                                                <option value="Tasek Gelugor">Tasek Gelugor</option>
							                                                <option value="Kepala Batas">Kepala Batas</option>
							                                                <option value="Bukit Mertajam">Bukit Mertajam</option>
							                                                <option value="Sungai Dua">Sungai Dua</option>	
							                                            </select>
							                                        </div>


							                                        <div class="form-group">
							                                            <label>Poskod</label>
							                                             <input type="text" name="poskod" class="form-control" value="<?php echo $row['poskod'];?>" required>
							                                        </div>

							                                </div>
							                                <!-- /.col-lg-4 (nested) -->
							                            </div>

							                                 
							                            </div>
							                            <!-- /.row (nested) -->


							                        <div class="row" id="myForm">
							                        	<h4 align="center"><u>Maklumat Pasangan</u></h4>
							                                
							                                <div class="col-lg-4">
							                                    
							                                        <div class="form-group">
							                                            <label>Nama Penuh</label>
							                                            <input class="form-control" name="nama_isteri" required>	            
							                                        </div>

							                                        <div class="form-group">
							                                            <label>No IC</label>
							                                            <input class="form-control" name="no_ic_I"  placeholder="Contoh: 880528-35-5036" required>	
							                                        </div>

							                                        <div class="form-group">
							                                            <label>Umur</label>
							                                            <input class="form-control" name="umurI" required>
							                                        </div>

							                                        <div class="form-group">
							                                            <label>Bangsa</label>
							                                            <select class="form-control" name="bangsaI" >
							                                                <option>Sila Pilih</option>
							                                                <option value="melayu">Melayu</option>
							                                                <option value="cina">Cina</option>
							                                                <option value="india">India</option>
							                                                <option value="lain-lain">Lain-lain</option>
							                                            </select>
							                                        </div>

							                                        <div class="form-group">
							                                            <label>Status Perkahwinan</label>
							                                            <select class="form-control" name="status_kawinI">
							                                                <option>Sila Pilih</option>
							                                                <option value="bujang" >Bujang</option>
							                                                <option value="berkahwin">Berkahwin</option>
							                                                <option value="duda">Duda</option>
							                                                <option value="janda">Janda</option>
							                                            </select>
							                                        </div>

							                                        <div class="form-group">
							                                            <label>No Telefon</label>
							                                            <input class="form-control" placeholder="Contoh: 014-3159891" name="no_telI" required>
							                                        </div>	

							                                </div>
							                                <!-- /.col-lg-4 (nested) -->



							                                <div class="col-lg-4">	

							                                        <div class="form-group">
							                                            <label>Tahap Pendidikan</label>
							                                            <select class="form-control" name="tahap_pendidikanI" required>
							                                                <option>Sila Pilih</option>
							                                                <option value="UPSR">UPSR / PMR</option>
							                                                <option value="SPM">SPM</option>
							                                                <option value="STPM">STPM / Diploma</option>
							                                                <option value="Ijazah">Ijazah Sarjana Muda</option>
							                                                <option value="Master">Ijazah Sarjana</option>
							                                                <option value="PHD">Ijazah Kedoktoran</option>
							                                            </select>
							                                        </div>

							                                        <div class="form-group">
							                                            <label>Pekerjaan</label>
							                                            <input class="form-control" name="pekerjaanI" >	                  
							                                        </div> 
							                                        <div class="form-group">
							                                            <label>Majikan / Syarikat</label>
							                                            <input class="form-control" name="majikanI" >	                  
							                                        </div>

							                                        <div class="form-group">
							                                            <label>Status Pekerjaan</label>
							                                            <select class="form-control" name="status_pekerjaanI"  required>
							                                            <option>Sila Pilih</option>
							                                                <option value="tetap">Tetap</option>
							                                                <option value="kontrak">Kontrak</option>
							                                            </select>                  
							                                        </div> 
							                                        <div class="form-group">
							                                            <label>Pendapatan Bulanan</label>
							                                            <input class="form-control" name="pendapatanI" >	                  
							                                        </div> 

							                                </div>
							                                <!-- /.col-lg-4 (nested) -->




							                            <div class="row">
							                                <div class="col-lg-4">
							                                	    <div class="form-group">
							                                            <label>No Rumah (Alamat Terkini)</label>
							                                            <input class="form-control" placeholder="Contoh: 1842-2 Kampung Selamat" name="alamat_penuhI">
							                                        </div>

							                                        <div class="form-group">
							                                            <label>Negeri</label>
							                                            <select class="form-control" name="negeriI" required>
							                                            <option>Sila Pilih</option>
							                                                <option value="Pulau Pinang">Pulau Pinang</option>
							                                                <option value="Perlis">Perlis</option>
							                                                <option value="Kedah">Kedah</option>
							                                                <option value="Peark">Perak</option>
							                                                <option value="Selangor">Selangor</option>	
							                                                <option value="Negeri Sembilan">Negeri Sembilan</option>	
							                                                <option value="Melaka">Melaka</option>	
							                                                <option value="Johor">Johor</option>	
							                                                <option value="Kelantan">Kelantan</option>	
							                                                <option value="Pahang">Pahang</option>	
							                                                <option>Terengganu</option>
							                                                <option value="Sabah">Sabah</option>	
							                                                <option value="Sarawak">Sarawak</option>
							                                                <option value="Wilayah Persekutuan">Wilayah Persekutuan</option>				
							                                                <option value="Wilayah Labuan">Wilayah Labuan</option>
							                                            </select>
							                                        </div>		

							                                        <div class="form-group">
							                                            <label>Daerah</label>
							                                            <select class="form-control" value="daerahI" required>
							                                            <option>Sila Pilih</option>
							                                                <option value="Tasek Gelugor">Tasek Gelugor</option>
							                                                <option value="Kepala Batas">Kepala Batas</option>
							                                                <option value="Bukit Mertajam">Bukit Mertajam</option>
							                                                <option value="Sungai Dua">Sungai Dua</option>	
							                                            </select>
							                                        </div>


							                                        <div class="form-group">
							                                            <label>Poskod</label>
							                                            <input class="form-control" name="poskodI" >	                  
							                                        </div>

							                                        <div class="form-group">
							                                        <button class="btn btn-info" type="button" data-toggle="modal" data-target="#myModal">Tambah Pasangan </button>
							                                    	</div>

							                                </div>
							                                <!-- /.col-lg-4 (nested) -->
							                            </div>

							                            </div>
							                            <!-- /.row (nested) -->


  													  <div class="row">
							                        	<h4 align="center"><u>Maklumat Anak</u></h4>
							                                
							                                <div class="col-lg-4">
							                                    
							                                        <div class="form-group">
							                                            <label>Nama Penuh</label>
							                                            <input class="form-control" name="nama_penuh_anak" required>	            
							                                        </div>

							                                        <div class="form-group">
							                                            <label>No IC</label>
							                                            <input class="form-control" placeholder="Contoh: 880528-35-5036" name="no_ic_anak" required>	
							                                        </div>

							                                        <div class="form-group">
							                                            <label>Umur</label>
							                                            <input class="form-control" name="umur_anak" required>
							                                        </div>

							                                        <div class="form-group">
							                                            <label>Bangsa</label>
							                                            <select class="form-control" name="bangsa_anak">
							                                                <option>Sila Pilih</option>
							                                                <option value="melayu">Melayu</option>
							                                                <option value="cina">Cina</option>
							                                                <option value="india">India</option>
							                                                <option value="lain-lain">Lain-lain</option>
							                                            </select>
							                                        </div>

							                                        <div class="form-group">
							                                             <label>Status Perkahwinan</label>
							                                            <select class="form-control" name="status_kawin_isteri">
							                                                <option>Sila Pilih</option>
							                                                <option value="bujang" >Bujang</option>
							                                                <option value="berkahwin">Berkahwin</option>
							                                                <option value="duda">Duda</option>
							                                                <option value="janda">Janda</option>
							                                            </select>
							                                        </div>

							                                        <div class="form-group">
							                                            <label>No Telefon</label>
							                                            <input class="form-control" placeholder="Contoh: 014-3159891" name="no_tel_anak" required>
							                                        </div>	

							                                </div>
							                                <!-- /.col-lg-4 (nested) -->

							                                <div class="col-lg-4">	

					                                          <div class="form-group">
					                                            <label>Tahap Pendidikan</label>
                                                                
                                                                <select class="form-control" name="tahap_pendidikan_anak"
required>
							                                              <option>Sila Pilih</option>
							                                              <option value="UPSR">UPSR / PMR</option>
							                                              <option value="SPM">SPM</option>
							                                              <option value="STPM">STPM / Diploma</option>
							                                              <option value="Ijazah">Ijazah Sarjana Muda</option>
							                                              <option value="Master">Ijazah Sarjana</option>
							                                              <option value="PHD">Ijazah Kedoktoran</option>
				                                                </select>	                  
							                                        </div>

					                                          <div class="form-group">
							                                            <label>Pekerjaan</label>
							                                            <input class="form-control" name="pekerjaan_anak" >
						                                        </div> 
							                                        <div class="form-group">
							                                            <label>Majikan / Syarikat</label>
							                                            <input class="form-control" name="majikan_anak" >	                  
							                                        </div>

							                                        <div class="form-group">
							                                             <label>Status Pekerjaan</label>
							                                            <select class="form-control" name="status_anak"  required>
							                                            <option>Sila Pilih</option>
							                                                <option value="tetap">Tetap</option>
							                                                <option value="kontrak">Kontrak</option>
							                                            </select>                  
							                                        </div> 
							                                        <div class="form-group">
							                                            <label>Pendapatan Bulanan</label>
							                                            <input class="form-control" name="pendapatan_anak">	                  
							                                        </div> 

							                                </div>
							                                <!-- /.col-lg-4 (nested) -->

							                            <div class="row">
							                                <div class="col-lg-4">
							                                	    <div class="form-group">
							                                            <label>No Rumah (Alamat Terkini)</label>
							                                            <input class="form-control" placeholder="Contoh: 1842-2 Kampung Selamat"  name="alamat_penuh_anak">
							                                        </div>

							                                        <div class="form-group">
							                                            <label>Negeri</label>
							                                            <select class="form-control" name="negeri_anak" required>
							                                            <option>Sila Pilih</option>
							                                                <option value="Pulau Pinang">Pulau Pinang</option>
							                                                <option value="Perlis">Perlis</option>
							                                                <option value="Kedah">Kedah</option>
							                                                <option value="Peark">Perak</option>
							                                                <option value="Selangor">Selangor</option>	
							                                                <option value="Negeri Sembilan">Negeri Sembilan</option>	
							                                                <option value="Melaka">Melaka</option>	
							                                                <option value="Johor">Johor</option>	
							                                                <option value="Kelantan">Kelantan</option>	
							                                                <option value="Pahang">Pahang</option>	
							                                                <option>Terengganu</option>
							                                                <option value="Sabah">Sabah</option>	
							                                                <option value="Sarawak">Sarawak</option>
							                                                <option value="Wilayah Persekutuan">Wilayah Persekutuan</option>				
							                                                <option value="Wilayah Labuan">Wilayah Labuan</option>
							                                            </select>
							                                        </div>		

							                                        <div class="form-group" >
							                                             <label>Daerah</label>
							                                            <select class="form-control" name="daerah_anak" required>
							                                            <option>Sila Pilih</option>
							                                                <option value="Tasek Gelugor">Tasek Gelugor</option>
							                                                <option value="Kepala Batas">Kepala Batas</option>
							                                                <option value="Bukit Mertajam">Bukit Mertajam</option>
							                                                <option value="Sungai Dua">Sungai Dua</option>	
							                                            </select>
							                                        </div>


							                                        <div class="form-group">
							                                            <label>Poskod</label>
							                                            <input class="form-control" name="poskod_anak">	                  
							                                        </div>

							                                        <div class="form-group">
							                                        <button class="btn btn-info" type="button" data-toggle="modal" data-target="#myModalAnak">Tambah Anak </button>
							                                        

							                                    	</div>
                                                                    

							                                </div>
							                                <!-- /.col-lg-4 (nested) -->
							                            </div>

							                          </div>
							                            <!-- /.row (nested) -->




							                            <div class="row">
							                        	<h4 align="center"><u>Catatan Masjid</u></h4>
							                                
							                                <div class="col-lg-4">
							                                    <div class="form-group">
							                                            <label>Warga Emas</label>
							                                            <select class="form-control" nama="warga_emas" required>
							                                                <option>Sila Pilih</option>
							                                                <option value="Ya">Ya</option>
							                                                <option value="Tidak">Tidak</option>
							                                            </select>	            
							                                        </div>
							                                </div>
							                                <!-- /.col-lg-4 (nested) -->

							                                <div class="col-lg-4">	

							                                        <div class="form-group">
							                                            <label>Wajib Solat Jumaat</label>
							                                            <select class="form-control" required>
							                                                <option>Sila Pilih</option>
							                                                <option value="Ya">Ya</option>
							                                                <option value="Tidak">Tidak</option>
							                                            </select>	            
							                                        </div>
							                                </div>
							                                <!-- /.col-lg-4 (nested) -->

                                                </div>  
                                                 </div>
                                    <!-- /.modal-content -->
                                   </div>
                                <!-- /.modal-dialog -->
 
                                        <div class="modal-footer">
                                           <input type="hidden" name="id_masjid" value="3857" />	            
                                            <a href="utama.php?view=pendaftaran_ahli_qariah"><button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button></a>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                  
								   <?php  }
        		                   }
				                  	else
						             {
						            echo mysql_error();
							          }
									?>