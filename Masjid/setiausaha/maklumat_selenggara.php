<?php 
                include("../connection/connection.php");
				
				 if(isset($_POST['search']))
	 			 { 
				 $daripada = $_POST['daripada'];				
				 $hingga = $_POST['hingga'];
				
				}
				?>
            <div class="row">
                <div class="col-lg-12">
                    <h2 align="center" class="page-header">LAPORAN SELENGGARA <br> DARIPADA <?php echo $daripada?> HINGGA <?php echo $hingga ?></h2>
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
                        <div class="panel-heading">Maklumat Selenggara
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
                          include("../connection/connection.php");
						  if(isset($_POST['search']))
						  { 
						   $daripada = $_POST['daripada']; 
                           $hingga = $_POST['hingga'];
						   $statuss = $_POST['carisearch']; 
	 					  }
                           if($statuss == '1')
						  {
						  $sql_search="SELECT id_selenggara,pilihan_selenggara,nama_syarikat,tarikh_selenggara
						  FROM sej6x_data_selenggara
						  WHERE tarikh_selenggara BETWEEN '$daripada' AND '$hingga' "; 
	                      $result = mysql_query($sql_search) or die ("Error :".mysql_error());
						  
						  ?> 

                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th><div align="center">Bil</div></th>
                                            <th><div align="center">Jenis Selenggara</div></th>
                                            <th><div align="center">Nama Syarikat</div></th>
                                            <th><div align="center"></div></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $x=1; ?>
                                    <?php while($row = mysql_fetch_assoc($result)){ ?>
                                    <tr class="odd gradeX">
                         <td><div align="center"><?php echo $x; ?></div></td>
                         <td><div align="center">
						  <?php 
						 if($row["pilihan_selenggara"]=='1')
						 {
						  echo "Elektrik"; }
						
						else if($row["pilihan_selenggara"]=='2') 
						 {
						  echo "Utiliti"; } ?>
                         </div></td>  
                         <td><div align="center"><?php echo $row['nama_syarikat']; ?></div></td>
                         <td>
                         <div align="center"><a href="utama.php?view=admin&action=semak_selenggara&id_selenggara=<?php echo $row['id_selenggara'];?>"> <button type="button" class="btn btn-warning btn-circle" data-toggle="tooltip" data-placement="right" title="Edit"><i class="fa fa-pencil"></i></button></a>
                       
                       <div align="center"><form name="delete" method="POST" action="admin/del_selenggara.php">
                       <input type="hidden" name="del" id="del" value="<?php echo $row['id_selenggara']; ?>">
                       <button type="submit" name="delete" id="delete" class="btn btn-danger btn-circle" data-toggle="tooltip" data-placement="right" title="Padam" onclick="return confirm('Padam rekod?')"><i class="fa fa-times"></i></button></form></div>  </td>                   
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
            
            <!-- /.row -->
            