<div class="row">
                <div class="col-lg-12">
                    <h1 align="center" class="page-header">DAFTAR ASNAF</h1>
                </div>
                <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Carian</div>

                        <div class="panel-body">
                        <div class="row"> 
                  <form name="asnaf" method="POST" action="<?php echo $PHP_SELF;?>">
                           
                            <div class="col-lg-4">
                              <div class="form-group">
                                <label>No.K/P</label>
                                        <input class="form-control" name="no_ic" id="no_ic"  required>
                              </div>    
                                </div>                     
                            
                              <div class="col-lg-4">
                                        <div class="form-group">
                                        <br>

                                            <input type="submit" name="search" value="Carian" class="btn btn-primary"></input>   
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
                        
                            Carian  Asnaf

                        </div>

                        <!-- /.panel-heading -->
                        <div class="panel-body">
                      
                           <div class="table-responsive">
                            <?php 
							 if(isset($_POST['search']))
	 							{ 
        
									 $no_ic = $_POST['no_ic']; 
							
                          include("connection/connection.php");
						  
						  
						  $sql_search="SELECT id_data,nama_penuh,no_ic,umur,alamat_terkini 
						   FROM sej6x_data_peribadi where no_ic LIKE '%$no_ic%' "; 
	                      $result = mysql_query($sql_search) or die ("Error :".mysql_error());
		
								}
						  ?>  
                          
                          
                               <form method="post" id="ibu_tunggal" action="pendaftaran/update_asnaf.php">               	                               
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>No IC</th>
                                         
                                            <th><div align="center">Tindakan</div></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $x=1; ?>
                                    <?php while($row = mysql_fetch_assoc($result)){ ?>
                                        <tr class="odd gradeX">
                                            <td><div align="center"><?php echo $x; ?></div></td>
                                            <td><?php echo $row['nama_penuh']; ?></td>
                                            <td><?php echo $row['no_ic']; ?></td>
                                           
                                             <td>
                                             
               <div align="center"><input type="hidden" name="id_data" value="<?php echo $row['id_data']; ?>">
	<input type="submit" name="update" id="update" value="Daftar" class="btn btn-success" />      </div>
                            					
                                            </td>
                                        </tr>
                                          <?php 
										
  $x++;
   }
  ?>
                                    </tbody>
                                   
                                </table>
                                 </form>
                            </div>
                            <!-- /.table-responsive -->
                            
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->


                                        

                         
