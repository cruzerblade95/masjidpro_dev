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
                    <h2 align="center" class="page-header">LAPORAN INVENTORI <br> DARIPADA <?php echo $daripada?> HINGGA <?php echo $hingga ?> </h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Carian </div>

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
                        <div class="panel-heading">Maklumat Inventori <button onclick="myFunction()" class="btn btn-primary">Cetak</button>
							<script>
						    function myFunction() {
   						    window.print();
							}
							</script> </div>
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
						  $sql_search="SELECT id_inventori, nama_inventori,kuantiti,harga_belian,peratus,bil_tahun,tarikh_belian,(kuantiti*harga_belian) as 'amaun',((kuantiti*harga_belian)*ROUND(peratus/100,2)) as 'susut', YEAR(tarikh_belian) as 'tahun', (kuantiti*harga_belian)-((kuantiti*harga_belian)*ROUND(peratus/100,2)) as 'aset_bersih' 
						  FROM sej6x_data_inventori
						  WHERE tarikh_belian BETWEEN '$daripada' AND '$hingga' "; 
	                      $result = mysql_query($sql_search) or die ("Error :".mysql_error());
						  ?>    
                              <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                  <thead>
                                      <tr>
                                        <th colspan="6"><div align="center">Harga Sebelum Susust Nilai</div></th>
                                       
                                        <th rowspan="2"><div align="center">Semak</div></th>
                                      </tr>
                                      <tr>
                                          <th><div align="center">Bil</div></th>
                                          <th><div align="center">Nama Aset</div></th>
                                          <th><div align="center">Tarikh Belian</div></th>
                                            <th><div align="center">Kuantiti</div></th>
                                            <th><div align="center">Harga Belian Seunit (RM)</div></th>
                                            <th><div align="center">Amaun (RM)</div></th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                   <?php $x=1; ?>
                                   <?php while($row = mysql_fetch_assoc($result)){ ?>
                                      <tr class="odd gradeX">
                                          <td><div align="center"><?php echo $x; ?></div></td>
                                          <td><div align="center"><?php echo $row['nama_inventori']; ?></div></td>
                                          <td><div align="center"><?php echo $row['tarikh_belian']; ?></div></td>
                                          <td><div align="center"><?php echo $row['kuantiti']; ?></div></td>
                                          <td><div align="center"><?php echo $row['harga_belian']; ?></div></td>
                                  
                                          <td><div align="center"><?php echo $row['amaun'] ?></div></td>
                    
                                          <td><div align="center">
                           					    <a href="utama.php?view=susut_nilai&id_inventori=<?php echo $row['id_inventori'];?>&tarikh_belian=<?php echo $row['tahun'];?>"><button type="button" class="btn btn-info btn-circle" data-toggle="tooltip" data-placement="right" title="Lihat">
                           					 	  <div align="center"><i class="fa fa-search"></i>
                   					 	       </div>
                           					   </button></a></div></td>
                                      </tr>
                                        <?php 
										
  $x++;
   }
						  }
  ?>
                                     
                                     
                                     
                                      <!--Jumlah akhir -->



                                       
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
            