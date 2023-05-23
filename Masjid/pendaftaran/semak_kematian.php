
    <?php $idd = $_GET['id_data'];?>
    
    <div class="row">
                <div class="col-lg-12">
                    <h1 align="center" class="page-header">BUTIRAN KEMATIAN KARIAH</h1>
                </div>
                <!-- /.col-lg-12 -->
</div>
            <!-- /.row -->
  <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Maklumat 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#maklumat" data-toggle="tab">Maklumat Kematian</a>
                                </li>
                                <li><a href="#perbelanjaan" data-toggle="tab">1Penyata Perbelanjaan Kematian</a>
                                </li>
                               
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="maklumat">
                                    <h4 align="center">Maklumat Kematian</h4>
                                    
                                     <?php 
                          include("connection/connection.php");
						  
						 
						  $sql_search="SELECT 
						  a.id_data,a.nama_penuh,a.no_ic,a.umur,a.alamat_terkini,a.no_hp,b.id_data,b.tarikh_kematian,
						  b.waktu_kematian,b.sebab_kematian,b.tarikh_dikebumikan,b.waktu_dikebumikan,b.lokasi,b.no_kubur 
						  FROM sej6x_data_peribadi a, data_kematian b
						  WHERE a.id_data=b.id_data 
						  AND a.id_data='".$idd."' "; 
	                      $result = mysql_query($sql_search) or die ("Error :".mysql_error());
						  ?>    
                        <div class="panel-body">
                        <div class="row"> 
                        
                       
                  <form action="pendaftaran/add_kematian.php" method='post'>
                               
					    <?php while($row = mysql_fetch_assoc($result)){ ?> 
                        
                    <div class="col-lg-12">
                              <div class="form-group">
                               <div class="alert alert-info">
                                           <div align="center">  <label>Nama Kematian Kariah :</label> <?php echo $row['nama_penuh'];?></div>
                                     
                                            <div align="center"> <label>No K/P:</label> <?php echo $row['no_ic'];?></div></div>

                      </div>
                              </div>
   						   
                         <hr />
                           
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
         		                       <input type="hidden" name="id_masjid" value="3857">  
           <div align="center"><br><br><input type="submit"  value="Kemaskini" class="btn btn-primary"></input></div>
                                    </div>
                                        

                    </div>
                                     <?php }?>  
                   
                            </form>
                        </div>
                        </div>
                              </div>
                                
                                
                                <div class="tab-pane fade" id="perbelanjaan">
                                    <h4 align="center">Penyata Perbelanjaan Kematian</h4>
                                    <?php 
                        
						  

						  $sql_search1="SELECT 
						  a.id_data,a.nama_penuh,a.no_ic,IFNULL(b.mandi,0) mandi,IFNULL(b.kain_kapan,) kain_kapan,IFNULL(b.keranda,0) keranda,
						  IFNULL(b.liang,0) liang,IFNULL(b.imam,0) imam,IFNULL(b.caj_unit,0) caj_unit,IFNULL(b.caj_hospital,0) caj_hospital,
                          IFNULL(b.jumlah_asas,0) jumlah_asas,IFNULL(b.jemputan_solat,0) jemputan_solat,
                          IFNULL(b.solat_hadiah,0) solat_hadiah,IFNULL(b.lain_perbelanjaan,0) lain_perbelanjaan,IFNULL(b.caj_bukan_pakatan,0) caj_bukan_pakatan,IFNULL(b.sewa_van,0) sewa_van,
						  IFNULL(b.jum_belanja_pilihan,0) jum_belanja_pilihan,IFNULL(b.jum_belanja_seluruh,0) jum_belanja_seluruh,IFNULL(b.jum_sumbangan_pakatan,0) jum_sumbangan_pakatan,
                          IFNULL(b.tolak_keseluruhan,0) tolak_keseluruhan,IFNULL(b.baki,0) baki
						  FROM sej6x_data_peribadi a left join sej6x_data_penyata_perbelanjaan b
                          on a.id_data=b.id_data
						  WHERE a.id_data='".$idd."'"; 
	                      $result = mysql_query($sql_search1) or die ("Error :".mysql_error());
						  ?>    
                        <div class="panel-body">
                        <div class="row"> 
                        
                  <form action="pendaftaran/add_penyata_perbelanjaan.php" method='post'>
                               
					    <?php while($row = mysql_fetch_assoc($result)){ ?> 
                        <script>alert('<?php echo $row['nama_penuh'];?>')</script>
                    <div class="col-lg-12">
                              <div class="form-group">
                               <div class="alert alert-info">
                                           <div align="center">  <label>Nama Kematian Kariah :</label> <?php echo $row['nama_penuh'];?></div>
                                     
                                            <div align="center"> <label>No K/P:</label> <?php echo $row['no_ic'];?></div></div>

                      </div>
                              </div>
   						   
                         <hr />
                          
                       
							                                
                    <div class="col-lg-4">
                                                            <div class="form-group">
							           <div align="center"><label>(PERBELANJAAN ASAS)</label></div>
							                                            
   
                      </div>
                                                               
							                                        <div class="form-group">
							                                            <div align="center"><label>Mandi</label>
							                                            :</div>
                                                                      <input class="form-control" name="mandi" id="mandi" value="<?php echo $row['mandi'];?>" requiredx>               
							                                           
							                                        </div>

                                                                    <div class="form-group">
                                                                        <div align="center"><label>Kain Kapan dan Kelengkapan</label>
                                                                        :</div>
                                                                      <input class="form-control" name="kain_kapan" id="kain_kapan" value="<?php echo $row['kain_kapan'];?>" requiredx>                  
                                                                    </div>

							                                        <div class="form-group">
							                                             <div align="center"><label>Keranda</label>
							                                             :</div>
						                                              <input class="form-control" name="keranda" id="keranda" value="<?php echo $row['keranda'];?>" requiredx>
							                                        </div>

							                                        <div class="form-group">
							                                            <div align="center"><label>Liang</label>
							                                            :</div>
							                                            <input class="form-control" name="liang" id="liang" value="<?php echo $row['liang'];?>" requiredx>
							                                        </div>

							                                        <div class="form-group">
							                                             <div align="center"><label>Imam / Talkin</label>
							                                             :
							                                             </div>
							                                            <input class="form-control" name="imam" id="imam" value="<?php echo $row['imam'];?>"requiredx>
							                                        </div>

							                                        <div class="form-group">
							                                             <div align="center"><label>Caj Pengurusan Unit</label>
							                                             :</div>
						                                              <input class="form-control" name="caj_unit" id="caj_unit" value="<?php echo $row['caj_unit'];?>" requiredx>
							                                        </div>
                                                                    
                                                                     <div class="form-group">
							                                             <div align="center">
							                                               <label>Caj Pengurusan Hospital (jika ada)</label>
							                                               :</div>
							                                            <input class="form-control" name="caj_hospital" id="caj_hospital" value="<?php echo $row['caj_hospital'];?>"requiredx>
							                                        </div>	
                                                                    
                                                                     <div class="form-group">
							                                             <div align="center"><label>[JUMLAH PERBELANJAAN ASAS]</label></div>
							                                            <input class="form-control" name="jumlah_asas" id="jumlah_asas" value="<?php echo $row['jumlah_asas'];?>"requiredx>
							                                        </div>	
                    </div>                     
                            
                              <div class="col-lg-4">
   
                                 <div class="form-group">
							     <div align="center"><label>(PERBELANJAAN PILIHAN)</label></div>
							                                           
   
                                </div>

							                                        <div class="form-group">
							                                            <div align="center"> <label>Jemputan Solat (bil.buah masjid)</label></div>
							                                           <input class="form-control"  name="jemputan_solat" id="jemputan_solat" value="<?php echo $row['jemputan_solat'];?>" requiredx>
							                                        </div>

							                                        <div class="form-group">
							                                            <div align="center">
							                                              <label>Solat Hadiah:</label></div>
						                                              <input class="form-control" name="solat_hadiah" id="solat_hadiah" value="<?php echo $row['solat_hadiah'];?>" requiredx>	                  
							                                        </div> 
							                                        <div class="form-group">
							                                             <div align="center"><label>Sewa Van Jenazah</label>
							                                             :</div>
						                                              <input class="form-control" name="sewa_van" id="sewa_van" value="<?php echo $row['sewa_van'];?>"requiredx>	                  
							                                        </div>

							                                        <div class="form-group">
							                                            <div align="center"> <label>Caj Selenggara Bukan Ahli Pakatan Khairat:</label></div>
							                                            <input class="form-control" name="caj_bukan_pakatan" id="caj_bukan_pakatan" value="<?php echo $row['caj_bukan_pakatan'];?>"requiredx>                  
							                                        </div> 
                                                                    
							                                        <div class="form-group">
							                                             <div align="center">
							                                               <label>Lain-Lain Perbelanjaan (nyatakan)</label>
							                                               :</div>
							                                          <input class="form-control" name="lain_perbelanjaan" id="lain_perbelanjaan" value="<?php echo $row['lain_perbelanjaan'];?>" requiredx>                  	                  
							                                        </div> 
                                                                    
                                                                    
                                <div class="form-group">
                                  <div align="center"> <label>[JUMLAH PERBELANJAAN PILIHAN]</label></div>
                                                                    <input class="form-control" name="jum_belanja_pilihan" id="jum_belanja_pilihan" value="<?php echo $row['jum_belanja_pilihan'];?>" requiredx />
                                </div>	
                                                                    
                                                                    
                                                                     <div class="form-group">
							                                            <div align="center"> <label>[JUMLAH PERBELANJAAN KESELURUHAN]</label></div>
							                                            <input class="form-control" name="jum_belanja_seluruh" id="jum_belanja_seluruh" value="<?php echo $row['jum_belanja_seluruh'];?>"requiredx>
							                                        </div>	   
                                         
                    </div>      


                                <div class="col-lg-4">
                                    
                                     <div class="form-group">
							            <div align="center"><label>(PENGIRAAN)</label></div>
   
                    </div>
							                                	    <div class="form-group">
							                                            <div align="center"><label>[JUMLAH SUMBANGAN PAKATAN]</label></div>
						                                              <input class="form-control" name="jum_sumbangan_pakatan" id="jum_sumbangan_pakatan" value="<?php echo $row['jum_sumbangan_pakatan'];?>">
							                                        </div>

							                                         <div class="form-group">
							                 <div align="center"><label>[TOLAK JUMLAH PERBELANJAAN KESELURUHAN]</label></div>
							                   <input class="form-control" name="tolak_keseluruhan" id="tolak_keseluruhan" value="<?php echo $row['tolak_keseluruhan'];?>">
							                                       
							                                        </div>		
  <div class="form-group">
							                                            <div align="center"><label>[BAKI]</label></div>
							         <input class="form-control" name="baki" id="baki" value="<?php echo $row['baki'];?>">
							                                       
                    </div>	
                                                                    
                                      <div class="form-group">
                                      
                       <input type="hidden" name="id_data" value="<?php echo $row['id_data']; ?>">
         		                       <input type="hidden" name="id_masjid" value="3857">  
           <div align="center"><br><br><input type="submit"  value="Kemaskini" class="btn btn-primary"></input></div>
                                    </div>
                    <?php }?>  
                   
                            </form>
                        </div>
                        </div>
                              </div>
                               
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>