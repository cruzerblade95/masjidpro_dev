
        <!-- Page Content -->
            <div class="row">
        <div class="col-lg-12">
        			<!--Wakaf-->
        			<?php if($_GET['jenis'] == "wakaf") { ?>
                    <h3 align="center" class="page-header">RESIT PEMBAYARAN WAKAF</h3><?php } ?>
                    <!--Zakat-->
                    <?php if($_GET['jenis'] == "zakat") { ?>
                    <h3 align="center" class="page-header">RESIT PEMBAYARAN ZAKAT</h3><?php } ?>
                    <!--Yuran Kariah-->
                    <?php if(!$_GET['jenis']) { ?>
                    <h3 align="center" class="page-header">RESIT PEMBAYARAN YURAN KARIAH</h3>								
					<?php } ?>
                </div>
                <!-- /.col-lg-12 -->
                  <?php 
                          include("connection/connection.php");
						  
						  $idd = $_GET['id_bayaran'];
						  //$tahun = $_GET['tarikh_belian'];
						 // $bil_tahun = $_GET['bil_tahun'];

						  if($_GET['id_data'] != 0) $sql_search="SELECT b.id_data,b.nama_penuh,b.no_ic,a.tarikh_bayaran,a.jumlah,b.no_hp,c.nama_penuh as 'Ajk',a.id_bayaran FROM sej6x_data_terimabayaran a, sej6x_data_peribadi b,sej6x_data_ajkmasjid c WHERE a.id_bayaran='".$idd."' AND a.id_data=b.id_data AND a.id_ajk=c.id_ajk";
						  
						  if($_GET['id_data'] == 0) $sql_search = "SELECT d.id_data, d.nama 'nama_penuh', d.no_kp 'no_ic', d.tarikh_bayaran, d.jumlah, d.no_phone, e.nama_penuh as 'Ajk', d.id_bayaran FROM sej6x_data_terimabayaran d, sej6x_data_ajkmasjid e WHERE e.id_ajk = d.id_ajk AND d.id_bayaran = $idd";
	                      $result = mysql_query($sql_search) or die ("Error :".mysql_error());

						  
						  ?>    
                           <?php while($row = mysql_fetch_assoc($result)){ ?> 
                           
                 <div class="col-lg-12">
                  <div class="col-lg-3">
                                 
                                  </div>
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Resit 
                        </div>
                      <form method="POST" action="pentadbiran/add_yurankariah.php" name="yuran_kariah">  
                        <div class="panel-body">
                            <div class="row">
                              <div class="col-lg-12">
                                    
                                        <div class="form-group">
                                            <label>Nama :</label>
                                            <?php echo $row['nama_penuh'];?>
                                        </div>
                                       
                                        <div class="form-group">
                                            <label>No.K/P :</label>
                                            <?php echo $row['no_ic'];?>              
                                		</div>
                                        
                                        <div class="form-group">
                                            <label>No.Ahli :</label>
                                            <?php if($row['id_data'] != 0) echo $row['id_data']; else echo("-")?>
                                        </div>

                                        <div class="form-group">
                                             <label>Tarikh Bayaran :</label>
                                             <?php echo $row['tarikh_bayaran'];?>
                                        </div>
                                        
                                        <div class="form-group">
                                              <label>Jumlah Bayaran (RM) :</label>
                                              <?php echo $row['jumlah'];?>
                                        </div>
                                          
                                         <div class="form-group">
                                           <label>AJK Masjid Bertugas:</label>
                                            <?php echo $row['Ajk'];?>
                                         </div>
                                              
                                              
                                              
                                              
                 <input class="form-control" type="hidden" name="id_data" value="<?php echo $row['id_data'];?>">                 <input class="form-control" type="hidden" name="id_jenisbayaran" value="1">
                 <input class="form-control" type="hidden" name="id_masjid" value="3857">
                 <br>
                     
                 <div align="center"> <button onclick="myFunction()"  class="btn btn-primary">Cetak</button>
							<script>
							function myFunction() {
   						    window.print();
							}
							</script> 
                      
                       </div>
                              
							                                       
                                    </form>
                                     <?php }?>    
                             
                                <!-- /.col-lg-6 (nested) -->
                                
                                 <div class="col-lg-3">
                                 
                                  </div>
                                     
                              
                        
                            <!-- /.row (nested) -->
                       
                        <!-- /.panel-body -->
                        
                           
                    </div>
                    <!-- /.panel -->
                       
                </div>
                <!-- /.col-lg-6 -->
             