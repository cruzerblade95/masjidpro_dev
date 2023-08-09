
        <!-- Page Content -->
            <div class="row">
        <div class="col-lg-12">
        			<!--Wakaf-->
                     <?php if($_GET['jenis'] == "wakaf") { ?>
                    <h3 align="center" class="page-header">TERIMA PEMBAYARAN WAKAF</h3>
                    <?php } ?>
                    <!--Zakat-->
                    <?php if($_GET['jenis'] == "zakat") { ?>
                    <h3 align="center" class="page-header">TERIMA PEMBAYARAN ZAKAT</h3>
                    <?php } ?>
                    <!--Yuran Kariah-->
                    <?php if(!$_GET['jenis']) { ?>
                    <h3 align="center" class="page-header">TERIMA BAYARAN</h3>
                    <?php } ?>
                    
                </div>
                <!-- /.col-lg-12 -->
                  <?php 
                          include("connection/connection.php");
						  
						  $idd = $_GET['id_data'];
						  $sql_search="SELECT 
						  id_data,nama_penuh,no_ic FROM sej6x_data_peribadi WHERE id_data='".$idd."' "; 
	                      $result = mysql_query($sql_search) or die ("Error :".mysql_error());

						  
						  //SQL AJKMASJID
						   $sql_ajkmasjid="SELECT 
						  id_ajk,nama_penuh,no_ic,no_tel FROM sej6x_data_ajkmasjid WHERE id_masjid='$id_masjid' "; 
	                      $result1 = mysql_query($sql_ajkmasjid) or die ("Error :".mysql_error());
						  
						  $pilihan = $pilihan."<option>Sila Pilih AJK </option>";  
                          while($row1=mysql_fetch_array($result1))
						  {
							
                          $pilihanajk=$pilihanajk."<option value='$row1[id_ajk]'>$row1[nama_penuh]</option>";
                          }
						  
						  
						  ?>    
                     
                           <?php $row = mysql_fetch_assoc($result); ?>
                           
                 <div class="col-lg-12">
                  <div class="col-lg-3">
                                 
                                  </div>
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Maklumat Pembayaran 
                        </div>
                      <form method="POST" action="admin/add_yurankariah.php" name="yuran_kariah">
                          <input type="hidden" id="jenis" name="jenis" value="<?php echo($_GET['jenis']); ?>" />  
                        <div class="panel-body">
                            <div class="row">
                              <div class="col-lg-12">
                                    
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
                                        
                                        <?php if($_GET['id_data'] != NULL) { ?>
                                         <div class="form-group">
                                            <label>No.Ahli :</label>
                                            <?php echo $row['id_data'];?>
                                        </div>
                                        <?php } ?>

                                        <div class="form-group">
                                            <label>Tarikh Bayaran :</label>
                                              <input class="form-control" name="tarikh_bayaran" type="date">
                                        </div>
                                        
                        <div class="form-group">
                                            <label>Jumlah Bayaran (RM) :</label>
                                              <input class="form-control" name="jumlah">
                                       </div>
                                          
                                         <div class="form-group">
                                           <label>
                                              <div align="center">AJK Masjid Bertugas:</div>
                                           </label>
                                          <div align="center">
                                              <select class="form-control" name="id_ajk" id="id_ajk" required>
                                              <?php echo $pilihan;?> <?php echo $pilihanajk;?>
                                              </div>
                                              
                                              
                                              
                                            <input class="form-control" type="hidden" name="id_data" value="<?php echo $row['id_data'];?>">
                                             <?php if($_GET['jenis'] == "wakaf") { ?>
                                            <input class="form-control" type="hidden" name="id_jenisbayaran" value="4"><?php } ?>
                                            
                                            <?php if($_GET['jenis'] == "zakat") { ?>
                                            <input class="form-control" type="hidden" name="id_jenisbayaran" value="3"><?php } ?>
                                            
                                            <?php if(!$_GET['jenis']) { ?>
                                            <input class="form-control" type="hidden" name="id_jenisbayaran" value="1"><?php } ?>
                                            
                                             <br>
                     
                       <div align="center"><input type="submit" name="search" value="Simpan" class="btn btn-primary">
                                   
                                   </div>
                              
							                                       
                                    </form>
                                     
                             
                                <!-- /.col-lg-6 (nested) -->
                                
                                 <div class="col-lg-3">
                                 
                                  </div>
                                     
                              
                        
                            <!-- /.row (nested) -->
                       
                        <!-- /.panel-body -->
                        
                           
                    </div>
                    <!-- /.panel -->
                       
                </div>
                <!-- /.col-lg-6 -->
             