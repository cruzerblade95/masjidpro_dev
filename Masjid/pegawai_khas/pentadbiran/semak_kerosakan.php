						 <?php 
                          include("connection/connection.php"); 
 						  
						  $idd = $_GET['id_kerosakkan'];
						   //sql view selenggara
						  $sql_search="SELECT 
	                      id_kerosakkan,tarikh_kerosakkan,masa_kerosakan,jenis_kerosakan,catatan_kerosakkan,catatan_tindakkan
						  FROM sej6x_data_kerosakkan
						  WHERE id_kerosakkan='".$idd."' "; 
	                      $result = mysql_query($sql_search) or die ("Error :".mysql_error());
						  while($row = mysql_fetch_assoc($result)){
						?>
      
<div class="row">
                <div class="col-lg-12">
                    <h1 align="center" class="page-header">KEROSAKAN</h1>
    </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                  <div class="panel panel-default">
                        <div class="panel-heading">
                           Maklumat Kerosakan
                        </div>
                        <!-- /.panel-heading -->
                        
                        <div class="panel-body">
                            <div class="panel-body">
                               <form method="POST" action="pentadbiran/update_kerosakkan.php" name="kerosakan">
                                                    
							   <div class="row">
							    <div class="col-lg-6">
							                                    
							     <div class="form-group">
							      <label>Tarikh Kerosakan</label>
						          <input class="form-control" name="tarikh_kerosakkan" value="<?php echo $row['tarikh_kerosakkan'] ?>" required>	            
							     </div>
                                                                   						                                             
							     <div class="form-group">
							     <label>Masa Kerosakan</label>
							     <input class="form-control" name="masa_kerosakan" value="<?php echo $row['masa_kerosakan'] ?>"required>	
							     </div>

							     <div class="form-group">
							     <label>Jenis Kerosakan</label>
							     <input class="form-control" name="jenis_kerosakan" value="<?php echo $row['jenis_kerosakan'] ?>"required>
							     </div>

							     </div>

							     <div class="row">
							     <div class="col-lg-6">
                                 
							     <div class="form-group">
                                 <label>Catatan Kerosakan</label>
                                 <input class="form-control"  name="catatan_kerosakkan" value="<?php echo $row['catatan_kerosakkan'] ?>">
							     </div>
                                                                    
							     <div class="form-group">
                                 <label>Catatan Tindakan</label>
                                 <input class="form-control"  name="catatan_tindakkan" value="<?php echo $row['catatan_tindakkan'] ?>">
								 </div>
                                 
                                   
                                 <div class="form-group">
                                 <br>
								<input type="hidden" name="id_kerosakkan" value="<?php echo $row['id_kerosakkan']; ?>">
                                <button type="submit" class="btn btn-primary">Kemaskini</button>
								   	</div>
															</div>
                                                              <?php }?> 

														 </div>
							                                <!-- /.col-lg-6 (nested) -->
							                            </div>

							                                 
							                           
                        </form>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->