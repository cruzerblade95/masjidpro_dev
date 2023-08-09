<div class="row">
                <div class="col-lg-12">
                    <h1 align="center" class="page-header">Laporan Susut Nilai</h1>
                </div>
                <!-- /.col-lg-12 -->
</div>
<!-- /.row -->



      <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Maklumat Inventori
                        </div>
                         <?php 
                          include("connection/connection.php");
						  
						  $idd = $_GET['id_inventori'];
						  $tahun = $_GET['tarikh_belian'];
						  $bil_tahun = $_GET['bil_tahun'];
						  
						  $sql_search="SELECT 
						  id_inventori,jenis_inventori,nama_inventori,kuantiti,harga_belian, 			
						  peratus,tarikh_belian,bil_tahun,(kuantiti*harga_belian) as 
						  'amaun' FROM sej6x_data_inventori WHERE id_inventori='".$idd."' "; 
	                      $result = mysql_query($sql_search) or die ("Error :".mysql_error());
						  ?>    

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                       <?php while($row = mysql_fetch_assoc($result)){ ?> 
                                        <div class="form-group">
                                            <label>Jenis Aset:
                                             <?php 
											 if($row["jenis_inventori"]=='1')
											 {
											  echo "Peralatan"; }
						
											  else if($row["jenis_inventori"]=='2') 
											 {
						 					  echo "Elektrik"; } 
											  else if($row["jenis_inventori"]=='3') 
											 {
						 					  echo "Perabot"; }  
											   else if($row["jenis_inventori"]=='4') 
											 {
						 					  echo "Kenderaan"; } 
											   else if($row["jenis_inventori"]=='5') 
											 {
						 					  echo "Lain-Lain"; } 
											  ?>
                                              
                                          
                                        </div>
                                        
                                         <div class="form-group">
                                            <label>Nama Aset: <?php echo $row['nama_inventori'];?> </label>
                                                        
                                        </div>
                                        <div class="form-group">
                                            <label>Tarikh Belian: <?php echo $row['tarikh_belian'];?> </label>
                                                        
                                        </div>

                                        <div class="form-group">
                                            <label>Kuantiti: <?php echo $row['kuantiti'];?></label>
                                         
                                        </div>

                                      
 
                                </div>


                                <!-- /.col-lg-6 (nested) -->
                                <div class="col-lg-6">
                                   
                                     <div class="form-group">
                                            <label>Harga Belian Seunit (RM): <?php echo $row['harga_belian'];?></label>
                                                         
                                        </div>
                                    
                                        <div class="form-group">
                                       
                                               <label>Amaun (RM): <?php echo $row['amaun'];?></label>
                                           
                                        </div>
                                        
                                     

                                        <div class="form-group">
                                            <label>Jumlah Tahun Susut: 10 Tahun</label> 
                                          
                                            
                                        </div>
                                         <?php }?>

        </div>
                                <!-- /.col-lg-6 (nested) -->
                            
   
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th><div align="center">Tahun</div></th>
                                            <th><div align="center">Nilai Aset Semasa
                                            </div></th>
                                            <th><div align="center">Susut Nilai Semasa</div></th>
                                            <th><div align="center">Nilai Aset Bersih
                                           </div></th>
                                        </tr>
                                    </thead>
                               
                                    <tbody>
                                    
                                    <?php 
								    $idd = $_GET['id_inventori'];
						 		    $tahun = $_GET['tarikh_belian'];
						            $bil_tahun = $_GET['bil_tahun'];
						  
						            $sql_search="SELECT 
						            id_inventori,jenis_inventori,nama_inventori,kuantiti,harga_belian, 			
						            peratus,tarikh_belian,bil_tahun,(kuantiti*harga_belian) as 
						            'amaun' FROM sej6x_data_inventori WHERE id_inventori='".$idd."' "; 
	                                $result = mysql_query($sql_search) or die ("Error :".mysql_error());
						           ?>    

                                    
                                    <?php
									//Formule: Kos aset berkurang 
									//Kos aset bersih tahun semasa-( kos asset/(jangka hayat+1))
									//(Kos bersih -(amaun/(10+1))
									  $tahun = $_GET['tarikh_belian'];
									  $bil_tahun = 10;
									  $total= $tahun + $bil_tahun;
									  
									  //$a=$tahun;
									while($row = mysql_fetch_assoc($result)){
										
									$amaun=$row['amaun'];
									$amaun2=$row['amaun'];
									}
									$bil_tahun2 = $bil_tahun +1;
									$susut_nilai_tahunan=round($amaun/$bil_tahun2, 2);
									
                                     for ($a=$tahun; $a<=$total; $a++) {
										 if($a == $tahun) $amaun = round($amaun2, 2);
										 //if($a != $tahun) $amaun[$a] = $aset_bersih_semasa[$a];
						            ?>  
                                    
                                     
                                 <tr>
                                   			 
                                            <td><div align="center"><?php echo $a;?></div></td> 
                                            <td><div align="center"><?php echo $amaun; ?></div></td>
                                            <td><div align="center"><?php echo($susut_nilai_tahunan); ?></div></td>
                                            <td><div align="center">
                                              <?php
											
                                            $amaun = round($amaun - $susut_nilai_tahunan, 2);
											echo($amaun);
											?>
                                            </div></td>
                                        </tr>
                                        
                                        
                                        <?php  } ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->