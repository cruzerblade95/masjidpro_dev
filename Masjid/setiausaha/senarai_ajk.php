<?php
include("connection/connection.php");
?>

    <div class="row">
                <div class="col-lg-12">
                    <h1 align="center" class="page-header">SENARAI AHLI JAWATANKUASA (AJK) MASJID</h1>
                </div>
                <!-- /.col-lg-12 -->
</div>
            <!-- /.row -->
            <?php
              $sql_search="SELECT a.id_data,a.nama_penuh,a.no_ic,a.no_hp,b.jawatan
						   FROM sej6x_data_peribadi a, data_ajkmasjid b
						   where a.data_ajk=1
						   AND a.id_data=b.id_ajk"; 
	                     $result = mysql_query($sql_search) or die ("Error :".mysql_error());
				?>		  
            
 <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Senarai AJK Masjid | <button class="btn btn-success" type="button" onclick="history.go(-1)">Kembali</button></div>

                        <div class="panel-body">
                           <div class="table-responsive">              	                               
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th><div align="center">No</div></th>
                                            <th><div align="center">Nama</div></th>
                                            <th><div align="center">No IC</div></th>
                                            <th><div align="center">No Telefon</div></th>
                                            <th><div align="center">Jawatan</div></th>
                                           
                                            <th><div align="center"></div></th>
                                           
                                           
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php $x=1; ?>
                                        <?php while($row = mysql_fetch_assoc($result)){ ?> 
                                      <tr class="odd gradeX">
                                            <td><div align="center"><?php echo $x; ?></div></td>
                                            <td><?php echo $row['nama_penuh']; ?></td>
                                            <td><div align="center"><?php echo $row['no_ic']; ?></div></td>
                                            <td><div align="center"><?php echo $row['no_hp']; ?></div></td>
                                            <td><div align="center"><?php echo $row['jawatan']; ?></div></td>
                                            <td><div align="center"><a href="utama.php?view=setiausaha&action=semak_ajk&id_data=<?php echo $row['id_data'];?>">[Semak]</a></div></td>
                                          
                                            
                                        </tr>
                                         <?php  $x++; }?>  
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
                                        
                                           </div>
           
                        </div>
                    </div>
                </div>
            </div>
 
                              
            
            <!-- /.row -->
        
        <!-- /#page-wrapper -->

 
                                         
                                
