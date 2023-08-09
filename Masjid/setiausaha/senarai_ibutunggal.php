
    <div class="row">
                <div class="col-lg-12">
                    <h1 align="center" class="page-header">SENARAI IBU TUNGGAL</h1>
                </div>
                <!-- /.col-lg-12 -->
</div>
            <!-- /.row -->
            <?Php
              $sql_search="SELECT id_data,nama_penuh,no_ic,umur,alamat_terkini,no_hp 
						   FROM sej6x_data_peribadi where data_ibutunggal=1"; 
	                     $result = mysql_query($sql_search) or die ("Error :".mysql_error());
				?>		  
            
 <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Senarai Ibu Tunggal</div>

                        <div class="panel-body">
                           <div class="table-responsive">              	                               
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th><div align="center">No</div></th>
                                            <th><div align="center">Nama</div></th>
                                            <th><div align="center">No IC</div></th>
                                            <th><div align="center">No Telefon</div></th>
                                           
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
                                           
                                            <td><div align="center"><a href="utama.php?view=setiausaha&action=semak_ibutunggal&id_data=<?php echo $row['id_data'];?>">[Semak]</a></div></td>
                                          
                                            
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

 
                                         
                                
