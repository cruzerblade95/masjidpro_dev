<div class="row">
                <div class="col-lg-12">
                    <h1 align="center" class="page-header">KEHADIRAN PEGAWAI MASJID</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
 
  <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Rekod Kehadiran
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
						  
			 $sql_search="SELECT a.id_ajk,a.nama_penuh,a.id_fingerprint,a.jawatan_lantikan,b.Clock 
						  FROM sej6x_data_ajkmasjid a, sej6x_data_kehadiran b 
						  WHERE a.id_fingerprint= b.DIN"; 
						  
	                      $result = mysql_query($sql_search) or die ("Error :".mysql_error());
						  ?>  
                                 <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th><div align="center">Bil</div></th>
                                            <th><div align="center">Nama </div></th>
                                            <th><div align="center">ID Finger Print</div></th>
                                            <th><div align="center">Jawatan</div></th>
                                            <th><div align="center">Masa Kehadiran</div></th>
                                            <th><div align="center">Tindakan</div></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php $x=1; ?>
                              <?php while($row = mysql_fetch_assoc($result)){ ?>
                                        <tr>
                                            <td><div align="center"><?php echo $x; ?></div></td>
                                            <td><?php echo $row['nama_penuh']; ?></td>
                                            <td><div align="center"><?php echo $row['id_fingerprint']; ?></div></td>
                                             <td><div align="center"><?php echo $row['jawatan_lantikan']; ?></div></td>
                                            <td><div align="center"><?php echo $row['Clock']; ?></div></td>
                                            <td>
                            					 <div align="center">
                            					   <a href="utama.php?view=kehadiranterperinci&id_ajk=<?php echo $row['id_ajk'];?>"><button type="button" class="btn btn-info btn-circle" data-toggle="tooltip" data-placement="right" title="Lihat">
                            					     <i class="fa fa-search"></i>
                           					       </button></a>
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
              