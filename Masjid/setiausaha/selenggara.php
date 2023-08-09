   						 <?php 
                          include("../connection/connection.php"); 
 						 
						 
						  //untuk sql negeri
						  $sql_negeri="SELECT id_negeri,name FROM negeri"; 
	                      $result1 = mysql_query($sql_negeri) or die ("Error :".mysql_error());
						    
                          $options1 = $options1."<option>Sila Pilih Negeri</option>";  
                          while($row1=mysql_fetch_array($result1))
						  {
							
                          $options=$options."<option value='$row1[id_negeri]'>$row1[name]</option>";
                          }
						
						  //untuk sql daerah
						  $sql_daerah="SELECT id_daerah,id_negeri,nama_daerah FROM daerah WHERE id_negeri='9'"; 
	                      $result2=mysql_query($sql_daerah) or die ("Error :".mysql_error());
						    
                          $options3 = $options3."<option>Sila Pilih Daerah</option>";  
                          while($row2=mysql_fetch_array($result2))
						  {
                          $options4=$options4."<option value='$row2[id_daerah]'>$row2[nama_daerah]</option>";
                          }
						 
						
						  ?>
<div class="row">
                <div class="col-lg-12">
                    <h1 align="center" class="page-header">BORANG SELENGGARA</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
                    <div class="row">
							                <div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-heading">Maklumat Selenggara</div>
                                                    <form method="POST" action="admin/add_selenggara.php" name="selenggara">
							                        <div class="panel-body">
                                                    
							                        <div class="row">
							                        <h4 align="center">MAKLUMAT PERIBADI</h4>
							                                
							                        <div class="col-lg-6">
							                                   
							                                        <div class="form-group">
							                                            <label>Nama Syarikat</label>
							                                            <input class="form-control" name="nama_syarikat" required>	            
							                                        </div>
                                                                    
                                                                    
							                                        <div class="form-group">
							                                            <label>No Pendaftaran Syarikat</label>
							                                            <input class="form-control" name="no_pendaftaran" required>	            
							                                        </div>
                                                                    
							                                        <div class="form-group">
							                                            <label>Nama Pekerja</label>
							                                            <input class="form-control"  name="nama_pekerja" required>	
							                                        </div>

							                                        <div class="form-group">
							                                            <label>No Kad Pengenalan</label>
							                                            <input class="form-control" name="no_ic" required>
							                                        </div>

											<div class="form-group">
							                <label>Umur</label>
							                <input class="form-control" name="umur" required>
							                 </div>
                                             
                                              </div>

							                                    

							                            <div class="row">
							                                <div class="col-lg-6">
							                                	    <div class="form-group">
							                                            <label>Alamat Syarikat</label>
							                                            <input class="form-control" name="alamat_syarikat" required>
							                                        </div>

							                                        <div class="form-group">
							                                           <label>Negeri</label>
                                      <select class="form-control" name="negeri" required>
                                        <?php echo $options1;?> <?php echo $options;?>
                                      </select>
							                                        </div>		

							                                        <div class="form-group">
							                                                <label>Daerah</label>
                                       <select class="form-control" name="daerah" id="daerah" required>
                                        <?php echo $options3;?><?php echo $options4;?>
                                      </select>
							                                        </div>


							                                        <div class="form-group">
							                                            <label>Poskod</label>
							                                            <input class="form-control" name="poskod" required>	                  
							                                        </div>
                                                                    
                                                                    
                                                                     <div class="form-group">
							                                            <label>No Telefon</label>
							                                            <input class="form-control" name="no_tel" required>	
							                                        </div>

							                                </div>
							                                <!-- /.col-lg-4 (nested) -->
							                            </div>

							                                 
							                            </div>
							                            <!-- /.row (nested) -->


							                        <div class="row">
							                        	<h4 align="center">JENIS SELENGGARA</h4>
							                                
							                                <div class="col-lg-6">
                                                           
							                                    
							                                        <div class="form-group">
							                                            <label>Tarikh Selenggara</label>
							                                            <input class="form-control" type="date" name="tarikh_selenggara" required>	            
							                                        </div>
                                                                    
                                                                    <div class="form-group">
							                                            <label>Masa Selenggara</label>
							                                            <input class="form-control" name="masa_selenggara" required>	            
							                                        </div>
                                                                    
                                            <div class="form-group">
                                            <label>Pilihan Selenggara</label>
                                            <select class="form-control" name="pilihan_selenggara" required>
                                             <option value="0">Sila Pilih Jenis Selenggara</option>
                                            <option value="1">Elektrik</option>
                                            <option value="2">Utiliti</option>
                                                
                                            </select>
                                        </div>

							                                     </div>
							                                <!-- /.col-lg-6 (nested) -->


                                            <div class="row"> 
							                <div class="col-lg-6">
                                        
                                            <div class="form-group">
                                            <label>Catatan</label>
                                            <textarea class="form-control" rows="3" name="catatan"></textarea>	   
							               </div>
                                        <div class="form-group">                             
                                     <button type="submit" class="btn btn-primary">Simpan</button>
									 <button type="reset" class="btn btn-primary">Padam Semula</button> 
                                        </div>                            
 								
							                                     </div>
							                                <!-- /.col-lg-6 (nested) -->
	    
							                           
                                                        </div>
                                                        </div>
                                                        
                                                        
															
                                   
 </form>
  								 <!-- /.row (nested) -->
							                        