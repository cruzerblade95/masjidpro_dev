           <div class="row">
                <div class="col-lg-12">
                    <h2 align="center" class="page-header">MAKLUMAT SEWA</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
           
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Maklumat Sewa
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
						  
						  $sql_search="SELECT *
						  FROM maklumat_sewaan
						  WHERE 
						  id_masjid='$id_masjid'"; 
	                      $result = mysql_query($sql_search) or die ("Error :".mysql_error());
						  ?> 
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th><div align="center">Bil</div></th>
											<th><div align="center">Nama Penyewa</div></th>
											<th><div align="center">No Telefon Penyewa</div></th>
                                            <th><div align="center">Tarikh Mula Sewa</div></th>
                                            <th><div align="center">Tarikh Tamat Sewa</div></th>
                                            <th><div align="center">Ref.No</div></th>
											<!-- <th><div align="center">Tindakan</div></th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                   <?php $x=1; ?>
                                   <?php while($row = mysql_fetch_assoc($result)){ ?>
                                        <tr class="odd gradeX">
                                            <td><div align="center"><?php echo $x; ?></div></td>
                                            <td><div align="center"><?php echo $row['sewa_nama'];?></div></td>
                                            <td><div align="center"><?php echo $row['sewa_telefon']; ?></div></td>
											<td><div align="center"><?php echo $row['sewa_tarikh_mula']; ?></div></td>
											 <td><div align="center"><?php echo $row['sewa_tarikh_akhir']; ?></div></td>
                                            <td class="center"><div align="center"><?php echo $row['sewa_rujukan']; ?></div></td>
                                            <!-- <td>
                                            <div align="center"><a href="utama.php?view=admin&action=semak_sewa&id_sewa=<?php echo $row['no_sewa'];?>"> <button type="button" class="btn btn-warning btn-circle" data-toggle="tooltip" data-placement="right" title="Edit"><i class="fa fa-pencil"></i></button></a>
                       
                       <div align="center"><form name="delete" method="POST" action="admin/del_sewa.php">
                       <input type="hidden" name="del" id="del" value="<?php echo $row['no_sewa']; ?>">
                       <button type="submit" name="delete" id="delete" class="btn btn-danger btn-circle" data-toggle="tooltip" data-placement="right" title="Padam" onclick="return confirm('Padam rekod?')"><i class="fa fa-times"></i></button></form></div>  
                            				</td> -->
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
            