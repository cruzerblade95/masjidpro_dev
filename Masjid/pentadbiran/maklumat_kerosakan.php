<?php 
                include("connection/connection.php");
				
				 if(isset($_POST['search']))
	 			 { 
				 $daripada = $_POST['daripada'];				
				 $hingga = $_POST['hingga'];
				
				}
				?>
            <div class="row">
                <div class="col-lg-12">
                    <h2 align="center" class="page-header">LAPORAN KEROSAKAN<br> DARIPADA <?php echo $daripada?> HINGGA <?php echo $hingga ?></h2>
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
                            <form id="form1" name="form1" method="POST" action="<?php echo $PHP_SELF;?>">         
                            
                            <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Daripada</label>
                                            <input class="form-control" name="daripada" id="daripada" type="date" required>   
                                        </div>    
                                </div>                     
                            
                              <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Hingga</label>
                                            <input class="form-control" name="hingga" id="hingga" type="date" required>   
                                        </div>    
                                </div>      

                                <div class="col-lg-2">
                                    <div class="form-group">
                                            <br>
                                            <input type="submit" name="search" value="Carian" class="btn btn-primary"></input> 

                                    </div>
                                     <input type="hidden" name="carisearch" value="1" />
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
                        <div class="panel-heading">Laporan Kerosakan
                         <button onclick="myFunction()" class="btn btn-primary">Cetak</button>

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
						  if(isset($_POST['search']))
						  { 
						   $daripada = $_POST['daripada']; 
                           $hingga = $_POST['hingga'];
						   $statuss = $_POST['carisearch']; 
	 					  }
                           if($statuss == '1')
						  {
						  $sql_search="SELECT id_kerosakkan,jenis_kerosakan,catatan_kerosakkan,catatan_tindakkan,tarikh_kerosakkan 
						  FROM sej6x_data_kerosakkan
						  WHERE tarikh_kerosakkan BETWEEN '$daripada' AND '$hingga' ";  
	                      $result = mysql_query($sql_search) or die ("Error :".mysql_error());
						  ?> 
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th><div align="center">Bil</div></th>
                                            <th><div align="center">Jenis Kerosakan</div></th>
                                            <th><div align="center">Kerosakan</div></th>
                                            <th><div align="center">Ulasan</div></th>
                                            <th><div align="center">Tindakan</div></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     <?php $x=1; ?>
                                     <?php while($row = mysql_fetch_assoc($result)){ ?>
                                        <tr class="odd gradeX">
                                            <td><div align="center"><?php echo $x; ?></div></td>
                                            <td><div align="center"><?php echo $row['jenis_kerosakan']; ?></div></td>
                                            <td><div align="center"><?php echo $row['catatan_kerosakkan']; ?></div></td>
                                            <td class="center"><div align="center"><?php echo $row['catatan_tindakkan']; ?></div></td>
                                            <td>
                                             <div align="center"><a href="utama.php?view=semak_kerosakan&id_kerosakkan=<?php echo $row['id_kerosakkan'];?>"> <button type="button" class="btn btn-warning btn-circle" data-toggle="tooltip" data-placement="right" title="Edit"><i class="fa fa-pencil"></i></button></a>
                       
                       <div align="center"><form name="delete" method="POST" action="pentadbiran/del_kerosakkan.php">
                       <input type="hidden" name="del" id="del" value="<?php echo $row['id_kerosakkan']; ?>">
                       <button type="submit" name="delete" id="delete" class="btn btn-danger btn-circle" data-toggle="tooltip" data-placement="right" title="Padam"><i class="fa fa-times"></i></button></form></div> 
                            					</td>
                                        </tr>
                                        <?php 
										
  $x++;
   }
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
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            