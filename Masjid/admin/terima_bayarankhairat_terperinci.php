
        <!-- Page Content -->
            <div class="row">
        <div class="col-lg-12">
                    <h3 align="center" class="page-header">RESIT PEMBAYARAN YURAN KHAIRAT</h3>
                </div>
                <!-- /.col-lg-12 -->
                  <?php 
                          include("connection/connection.php");
						  
						  $idd = $_GET['id_bayaran'];
						  //$tahun = $_GET['tarikh_belian'];
						 // $bil_tahun = $_GET['bil_tahun'];

						  $sql_search="SELECT          
						  b.id_data,b.nama_penuh,b.no_ic,a.tarikh_bayaran,a.jumlah,b.no_hp,c.nama_penuh as 'Ajk',a.id_bayaran
			              FROM sej6x_data_terimabayaran a, sej6x_data_peribadi b,sej6x_data_ajkmasjid c
						  WHERE a.id_bayaran='".$idd."'
						  AND a.id_data=b.id_data 
						  AND a.id_ajk=c.id_ajk
						  AND a.id_masjid='$id_masjid'"; 
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
                      <form method="POST" action="admin/add_yurankhariat.php" name="yuran_khariat">  
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
                                            <?php echo $row['id_data'];?>
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
                                              
                                              
                                              
                                              
                                            <input class="form-control" type="hidden" name="id_data" value="<?php echo $row['id_data'];?>">                     <input class="form-control" type="hidden" name="id_jenisbayaran" value="1">
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
             