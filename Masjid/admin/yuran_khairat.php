
    <div class="row">
                <div class="col-lg-12">
                    <h1 align="center" class="page-header">YURAN KHAIRAT</h1>
                </div>
                <!-- /.col-lg-12 -->
</div>
            <!-- /.row -->
 <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Senarai Ahli Kariah</div>

                        <div class="panel-body">


                           <div class="table-responsive">
                            <?php 
                          include("connection/connection.php");
						  
						  $sql_search="SELECT id_data,nama_penuh,no_ic,umur,alamat_terkini FROM sej6x_data_peribadi WHERE id_masjid='$id_masjid' ORDER BY nama_penuh ASC"; 
	                      $result = mysql_query($sql_search) or die ("Error :".mysql_error());
						 
						  //untuk sql negeri
						  $sql_negeri="SELECT id_negeri,name FROM negeri"; 
	                      $result1 = mysql_query($sql_negeri) or die ("Error :".mysql_error());
						    
                          $options1 = $options1."<option>Sila Pilih Negeri</option>";  
                          while($row1=mysql_fetch_array($result1))
						  {
							
                          $options=$options."<option value='$row1[id_negeri]'>$row1[name]</option>";
                          }
						
						  //untuk sql daerah
						  $sql_daerah="SELECT id_daerah,id_negeri,nama_daerah FROM daerah WHERE id_negeri='$id_negeri'"; 
	                      $result2=mysql_query($sql_daerah) or die ("Error :".mysql_error());
						    
                          $options3 = $options3."<option>Sila Pilih Daerah</option>";  
                          while($row2=mysql_fetch_array($result2))
						  {
                          $options4=$options4."<option value='$row2[id_daerah]'>$row2[nama_daerah]</option>";
                          }
						 
						    //untuk sql zon kariah
						  $sql_zonkariah="SELECT id_zonqariah,nama_zon,no_huruf FROM sej6x_data_zonqariah WHERE id_masjid='$id_masjid'"; 
	                      $sql_zon=mysql_query($sql_zonkariah) or die ("Error :".mysql_error());
						    
                          $options5 = $options5."<option>Sila Pilih Zon</option>";  
                          while($row2=mysql_fetch_array($sql_zon))
						  {
                          $pilihanzon=$pilihanzon."<option value='$row2[id_zonqariah]'>$row2[no_huruf]: $row2[nama_zon]</option>";
                          }
						 
						  ?>  
                          
                          
                                               	                               
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th><div align="center">No</div></th>
                                            <th><div align="center">Nama</div></th>
                                            <th><div align="center">No IC</div></th>
                                            <th><div align="center">Alamat</div></th>
                                            <th><div align="center">Terima Bayaran</div></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $x=1; ?>
                              <?php while($row = mysql_fetch_assoc($result)){ ?>
                                        <tr class="odd gradeX">
                                            <td><div align="center"><?php echo $x; ?></div></td>
                                            <td><?php echo $row['nama_penuh']; ?></td>
                                            <td><?php echo $row['no_ic']; ?></td>
                                            <td><?php echo $row['alamat_terkini']; ?></td>
                                             <td>
                                             <div align="center"><a href="utama.php?view=admin&action=butirbayaran_khariat&id_data=<?php echo $row['id_data'];?>"><img src="picture/money.png" width="40" height="40"></a>
                           					   </div>
                            				 
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

                                                </div>
                                               </form>
                                           </div>
           
                        </div>
                    </div>
                </div>
            </div>
 
                              
            
            <!-- /.row -->
        
        <!-- /#page-wrapper -->

 
                                         
                                
