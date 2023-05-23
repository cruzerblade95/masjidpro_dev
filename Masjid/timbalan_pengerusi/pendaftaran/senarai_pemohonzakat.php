
    <div class="row">
                <div class="col-lg-12">
                    <h1 align="center" class="page-header">SENARAI PEMOHON ZAKAT</h1>
                </div>
                <!-- /.col-lg-12 -->
</div>
            <!-- /.row -->
 <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                        Senarai Pemohon Zakat</div>
                        
                         <?php
			//if($_GET['jenis'] == "bukan_kariah");

            $sql_search="SELECT a.id_zakat,b.nama_penuh,b.no_ic,b.no_hp,a.no_invoice,a.tarikh_mohon,a.file 
					     FROM sej6x_data_zakat a, sej6x_data_peribadi b
						 WHERE a.id_data=b.id_data
                   
            UNION SELECT id_data, CONCAT('BK - ', nama) 'nama', no_kp,no_phone,no_invoice,tarikh_mohon,file
			FROM sej6x_data_zakat 
			WHERE id_data =0"; 
	        $result = mysql_query($sql_search) or die ("Error :".mysql_error());
			?>
                        
                
            
                        

                         <div class="panel-body">
                           <div class="table-responsive">
                            
                             
							   
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th><div align="center">No.</div></th>
                                            <th><div align="center">Nama</div></th>
                                            <th><div align="center">No.K/P</div></th>
                                            <th><div align="center">No.H/P</div></th>
                                            <th><div align="center">No.Invoice</div></th>
                                            <th><div align="center">Tarikh Mohon</div></th>
                                            <th><div align="center">Fail</div></th>
                                            <th><div align="center">Padam</div></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                  <?php $x=1; ?>
                                  <?php while($row = mysql_fetch_array($result)){ 
                                  $files_field= $row['file'];
                                  $files_show= "zakat/files/$files_field";
                                  $no_invoicevalue= $row['no_invoice'];  ?>
                                        <tr class="odd gradeX">
                                        <td><div align="center"><?php echo $x; ?></div></td>
                                        <td><?php echo $row['nama_penuh']; ?></td>
                                        <td><div align="center"><?php echo $row['no_ic']; ?></div></td>
                                        <td><div align="center"><?php echo $row['no_hp']; ?></div></td>
                                        <td><div align="center"><?php echo $no_invoicevalue; ?></div></td>
                                        <td><div align="center"><?php echo $row['tarikh_mohon']; ?></div></td>
                                        <td><div align="center"><?php echo "<a href='$files_show'>[Download]</a>" ?></div>
                                            </td>
                                             <td><div align="center">
                                           <form name="delete" method="POST" action="pendaftaran/del_senaraizakat.php">
                                           <input type="hidden" name="del" id="del" value="<?php echo $row['id_zakat']; ?>">
                                           <button type="submit" name="delete" id="delete" class="btn btn-danger btn-circle" data-toggle="tooltip" data-placement="right" title="Padam"><i class="fa fa-times"></i>
                            					 </button> </form>
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

 
                                         
                                
