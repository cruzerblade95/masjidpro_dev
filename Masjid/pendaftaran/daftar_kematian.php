<div class="row">
                <div class="col-lg-12">
                    <h1 align="center" class="page-header">SENARAI KEMATIAN KARIAH</h1>
                </div>
                <!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Senarai Kematian Kariah
                          
                              <button onclick="myFunction()" class="btn btn-info">Cetak</button>
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
						  
						  $sql_search="SELECT b.nama_penuh,a.tarikh_kematian,a.id_data,b.id_data,b.data_kematian
						  FROM data_kematian a,sej6x_data_peribadi b
						  WHERE a.id_data=b.id_data 
						  AND b.data_kematian='1'"; 
	                      $result = mysql_query($sql_search) or die ("Error :".mysql_error());
						  
						  ?>                                        
                                
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th><div align="center">No</div></th>
                                            <th><div align="center">Nama</div></th>
                                            <th><div align="center">Tarikh Kematian</div></th>
                                            <th><div align="center">Tindakan</div></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     <?php $x=1; ?>
                                     <?php while($row = mysql_fetch_assoc($result)){ ?>
                                        <tr class="odd gradeX">
                                            <td><div align="center"><?php echo $x; ?></div></td>
                                            <td><?php echo $row['nama_penuh']; ?></td>
                                            <td><div align="center"><?php echo $row['tarikh_kematian']; ?></div></td>
   <td><div align="center"><a href="utama.php?view=semak_kematian&id_data=<?php echo $row['id_data'];?>">[Semak]</a></div></td>
                            					 
                                            </td>
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
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

