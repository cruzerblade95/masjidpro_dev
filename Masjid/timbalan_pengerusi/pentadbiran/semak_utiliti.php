  <?php 
                          include("connection/connection.php"); 
 						  
						  $idd = $_GET['id_utiliti'];
						  
						  $sql_search="SELECT id_utiliti,jenis_utiliti,tarikh_bayaran,ref_resit,harga_bayaran,catatan 
						  FROM sej6x_data_utiliti
						  WHERE id_utiliti='".$idd."' "; 
	                     $result = mysql_query($sql_search) or die ("Error :".mysql_error());
						  while($row = mysql_fetch_assoc($result)) {
								  ?>
            <div class="row">
                <div class="col-lg-12">
                    <h1 align="center" class="page-header">UTILITI</h1>
                </div>
                <!-- /.col-lg-12 -->
                
                <form method="POST" action="pentadbiran/update_utiliti.php" name="utiliti">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Maklumat Utiliti</div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    
                                        <div class="form-group">
                                            <label>Jenis Utiliti</label>
                                            <select class="form-control" name="jenis_utiliti">
                                                <option>Sila Pilih Jenis Selenggara</option>
                                                          							
							                              <option value="1"
                                                          <?php 
														  if($row["jenis_utiliti"]=='1')
														  {
															  echo "selected";
														  }
														  ?>
                                                          >Air</option>
                                                          
                                                          <option value="2"
                                                           <?php 
														  if($row["jenis_utiliti"]=='2')
														  {
															  echo "selected";
														  }
														  ?>
                                                          >Elektrik</option>
                                                          
                                                             <option value="3"
                                                           <?php 
														  if($row["jenis_utiliti"]=='3')
														  {
															  echo "selected";
														  }
														  ?>
                                                          >Internet</option>
                                                          
                                                             <option value="4"
                                                           <?php 
														  if($row["jenis_utiliti"]=='4')
														  {
															  echo "selected";
														  }
														  ?>
                                                          >Lain-Lain</option>
							                              </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Tarikh Bayaran</label>
                                            <input class="form-control" name="tarikh_bayaran" value="<?php echo $row['tarikh_bayaran'] ?>" >                
                                        </div>

                                        <div class="form-group">
                                            <label>Harga Bayaran</label>
                                            <input class="form-control" name="harga_bayaran" value="<?php echo $row['harga_bayaran'] ?>">                
                                        </div>

                                </div>


                                <!-- /.col-lg-6 (nested) -->
                                <div class="col-lg-6">
                                   
                                    
                                        <div class="form-group">
                                            <label>Ref.Resit</label>
                                            <input class="form-control" name="ref_resit" value="<?php echo $row['ref_resit'] ?>">
                                        </div>

                                        <div class="form-group">
                                            <label>Catatan</label>
                                            <input class="form-control" name="catatan" value="<?php echo $row['catatan'] ?>">
                                            
                                        </div>

                                        <input type="hidden" name="id_utiliti" value="<?php echo $row['id_utiliti']; ?>">                    
                                       <button type="submit" class="btn btn-primary">Kemaskini</button>
                                        <?php }?>  
              </form>
              
        </div>
        
                                <!-- /.col-lg-6 (nested) -->
                          



