
    <div class="row">
                <div class="col-lg-12">
                    <h1 align="center" class="page-header">SURAT NOTIS</h1>
                </div>
                <!-- /.col-lg-12 -->
</div>
            <!-- /.row -->
 <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Maklumat Fail</div>

                        <div class="panel-body">
                        <div class="row"> 
                  <form action="pentadbiran/add_suratnotis.php" method='post' enctype="multipart/form-data">
                           
                            <div class="col-lg-4">
                              <div class="form-group">
                                <label>Tarikh</label>
                                        <input class="form-control" name="tarikh" id="tarikh" type="date" required>
                              </div>    
                                </div>                     
                            
                              <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Nama Fail</label>
                                            <input class="form-control" placeholder="Contoh:Surat/Notis 1/10/2018" name="description" id="description" required>   
                                        </div>    
                                </div>      

 								 <div class="col-lg-4">
                                        <div class="form-group">
                                             <div class="form-group">
                                         <label>Upload Fail</label>
                                         <input type="file" class="form-control-file" name="file" id="file" />
                                        </div>    
                                </div>      


                                <div class="col-lg-2">
                                    <div class="form-group">
                                            <br>
                                            <input type="submit" name="submit" value="Upload" class="btn btn-primary"></input> 
                                        

                                    </div>
                                    
                                </div>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
 
                              
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Laporan
							<script>
							function myFunction() {
   						    window.print();
							}
							</script>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                            
                               <?php 
                               include("connection/connection.php");
							   $result= mysql_query( "SELECT id,tarikh,description,filename FROM notis
							    ORDER BY ID desc" ) or die("SELECT Error: ".mysql_error()); 
                               ?>
							   
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th><div align="center">No.</div></th>
                                            <th><div align="center">Nama Fail</div></th>
                                            <th><div align="center">Tarikh</div></th>
                                            <th><div align="center">Simpan</div></th>
                                            <th><div align="center">Padam</div></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                  <?php $x=1; ?>
                                  <?php while ($row = mysql_fetch_array($result)){ 
                                  $files_field= $row['filename'];
                                  $files_show= "Notis/files/$files_field";
                                  $descriptionvalue= $row['description'];  ?>
                                        <tr class="odd gradeX">
                                            <td><div align="center"><?php echo $x; ?></div></td>
                                            <td><?php echo $descriptionvalue; ?></td>
                                            <td><div align="center"><?php echo $row['tarikh']; ?></div></td>
                                            <td><div align="center"><?php echo "<a href='$files_show'>[Download]</a>" ?></div></td>
                                           <td><div align="center">
                 <form name="deletenotis" method="POST" action="pentadbiran/del_notis.php">
                 <input type="hidden" name="passdel" id="passdel" value="<?php echo $row['id']; ?>">
                 <button type="submit" name="delete" id="delete" class="btn btn-danger btn-circle" data-toggle="tooltip" data-placement="right" title="Padam"><i class="fa fa-times"></i>
                            					 </button></form>
                                          </div></td>
                                        
                                      </tr>
                                        <?php
										$x++;
                             } 


?>           
                                       
                                       
                                        
                                        
                                  </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                         
          
               
               
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
              </div>
                <!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->
        
        <!-- /#page-wrapper -->

 
                                         
                                
