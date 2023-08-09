
    <div class="row">
                <div class="col-lg-12">
                      <?php if($_GET['jenis'] == "wakaf")?>
                    <h1 align="center" class="page-header">BUTIRAN PEMOHONAN ZAKAT</h1>
                     
                </div>
                <!-- /.col-lg-12 -->
</div>
            <!-- /.row -->
 <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Maklumat Zakat 
                            </div>
							
                             <?php 
                          include("connection/connection.php");
						  
						  $idd = $_GET['id_data'];

						  $sql_search="SELECT 
						  id_data,nama_penuh,no_ic,umur,alamat_terkini,no_hp
						  FROM sej6x_data_peribadi WHERE id_data='".$idd."' "; 
	                      $result = mysql_query($sql_search) or die ("Error :".mysql_error());
						  ?> 

                          <div class="panel-body">
                          <div class="row"> 
                        
   <form action="pendaftaran/add_mohonzakat.php" method='post' enctype="multipart/form-data">
   <input type="hidden" id="jenis" name="jenis" value="<?php echo($_GET['jenis']); ?>" />
                               
					     <?php $row = mysql_fetch_assoc($result); ?>
                        
                    <div class="col-lg-12">
  
                            <div class="col-lg-6">
                               <div class="form-group">
                               <label>Nama :</label>
                               <?php if(!$_GET['id_data']) { ?>
                               <input class="form-control" id="nama" name="nama" value="" /><?php } ?>
                               <?php if($_GET['id_data'] != NULL) echo $row['nama_penuh']; ?>
                            </div> 
                                        
                             <div class="form-group">
                                <label>No.K/P :</label>
                                <?php if(!$_GET['id_data']) { ?>
                                <input class="form-control" id="no_kp" name="no_kp" value="" /><?php } ?>
                                <?php if($_GET['id_data'] != NULL) echo $row['no_ic']; ?>
                             </div> 
                                        
                              <?php if(!$_GET['id_data']) { ?>
                                 <div class="form-group">
                                  <label>No.H/P :</label>
                                  <input class="form-control" id="no_phone" name="no_phone" value="" />
                                  </div>
                              <?php } ?> 
                            
                              <div class="form-group" >
                                 <label>Jenis Zakat</label>
							     <select class="form-control" name="jenis_zakat" id="jenis_zakat" required>
							     <option value="0">Sila Pilih</option>
							     <option value="1">Pink - Perubatan</option>
							     <option value="2">Kuning - Permulaan IPT</option>
                                 <option value="3">Biru - Sara Hidup</option>
							     <option value="4">Hijau - Rumah(Bencana)</option>
                                 <option value="5">Oren - Sekolah</option>
                                 <option value="6">Lain-Lain</option>
								  </select>
                              </div>  
                                <div class="form-group">
                                            <label>No. Invoice</label>
                                            <input class="form-control" name="no_invoice" id="no_invoice" required>   
                                        </div> 
                             
                                </div>                     
                            
                              <div class="col-lg-6">
                              
                               <div class="form-group">
                               
                                       
                                            <label>Tarikh Mohon</label>
                                            <input class="form-control" name="tarikh_mohon" id="tarikh_mohon" type="date" required>   
                                        </div>     
                              
                                 <div class="form-group">
							                                             <label>Upload Fail</label>
                                           <input type="file" class="form-control-file" name="file" id="file" required >          
							                                        </div>     
                                   <div class="form-group">
                                   <br>
                                  
                  <input type="hidden" name="id_data" value="<?php echo $row['id_data']; ?>">
         		  <input type="hidden" name="id_masjid" value="3857">    
                  <input type="submit"  value="Hantar" class="btn btn-primary"></input> 
                                        

                                    </div>   
                                    
                                </div>      


                               
                                    
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
 