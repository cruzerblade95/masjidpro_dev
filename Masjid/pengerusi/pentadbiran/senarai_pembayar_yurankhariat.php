
    <div class="row">
                <div class="col-lg-12">
                    <h1 align="center" class="page-header">SENARAI PEMBAYAR YURAN KHAIRAT</h1>
                </div>
                <!-- /.col-lg-12 -->
</div>
            <!-- /.row -->
            <?Php
              $sql_search="SELECT b.id_data,b.nama_penuh,b.no_ic,a.tarikh_bayaran,a.jumlah,b.no_hp,a.id_bayaran
			             FROM sej6x_data_terimabayaran a, sej6x_data_peribadi b,sej6x_data_ajkmasjid c
						 WHERE a.id_data=b.id_data 
						 AND a.id_ajk=c.id_ajk 
						 AND a.id_jenisbayaran=2
						"; 
	                     $result = mysql_query($sql_search) or die ("Error :".mysql_error());
				?>		  
            
 <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Senarai Pembayar Yuran Khairat</div>

                        <div class="panel-body">
                           <div class="table-responsive">              	                               
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th><div align="center">No</div></th>
                                            <th><div align="center">Nama</div></th>
                                            <th><div align="center">No IC</div></th>
                                            <th><div align="center">No Telefon</div></th>
                                            <th><div align="center">Tarikh Bayar</div></th>
                                            <th><div align="center">Jumlah (RM)</div></th>
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
                                            <td><div align="center"><?php echo $row['tarikh_bayaran']; ?></div></td>
                                            <td><div align="center"><?php echo $row['jumlah']; ?></div></td>
                                            <td><div align="center"><a href="utama.php?view=terima_bayarankhairat_terperinci&id_bayaran=<?php echo $row['id_bayaran'];?>">[Cetak Resit]</a></div></td>
                                          
                                            
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

 
                                         
                                
