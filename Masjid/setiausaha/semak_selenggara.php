   						 <?php 
                          include("../connection/connection.php"); 
 						  
						    $idd = $_GET['id_selenggara'];
						   //sql view selenggara
						    $sql_search="SELECT 
		id_selenggara,nama_syarikat,no_pendaftaran,nama_pekerja,no_ic,umur,alamat_syarikat,negeri,daerah,poskod,no_tel,tarikh_selenggara,masa_selenggara,pilihan_selenggara,catatan 
						  FROM sej6x_data_selenggara
						  WHERE id_selenggara='".$idd."' "; 
	                      $result = mysql_query($sql_search) or die ("Error :".mysql_error());

						 //untuk sql negeri
						  $sql_negeri="SELECT id_negeri,name FROM negeri"; 
	                      $result1 = mysql_query($sql_negeri) or die ("Error :".mysql_error());
						
						  //untuk sql daerah
						  $sql_daerah="SELECT id_daerah,id_negeri,nama_daerah FROM daerah WHERE id_negeri='9'"; 
	                      $result2=mysql_query($sql_daerah) or die ("Error :".mysql_error());
						  
						  ?>
                           <?php while($row = mysql_fetch_assoc($result)){ ?> 
							<div class="row">
               				<div class="col-lg-12">
                  			<h1 align="center" class="page-header">SELENGGARA</h1>
              				</div>
                <!-- /.col-lg-12 -->
           					 </div>
            <!-- /.row -->
                   			 <div class="row">
							 <div class="col-lg-12">
							 <div class="panel panel-default">
							 <div class="panel-heading">Maklumat Selenggara</div>
                             <form method="POST" action="admin/update_selenggara.php" name="selenggara">
							 <div class="panel-body">               
							  <div class="row">
							  <h4 align="center">MAKLUMAT PERIBADI</h4>
							                                
							   <div class="col-lg-6">
							                                   
							   <div class="form-group">
							   <label>Nama Syarikat</label>
							   <input class="form-control" name="nama_syarikat" value="<?php echo $row['nama_syarikat'] ?>" required>	            
							   </div>
                                                                    
                                                                    
							   <div class="form-group">
							   <label>No Pendaftaran Syarikat</label>
							   <input class="form-control" name="no_pendaftaran" value=" <?php echo $row['no_pendaftaran'] ?>" required>	            
							   </div>
                                                                    
							   <div class="form-group">
							   <label>Nama Pekerja</label>
							   <input class="form-control"  name="nama_pekerja" value=" <?php echo $row['nama_pekerja'] ?>" required>	
							   </div>

							   <div class="form-group">
							   <label>No Kad Pengenalan</label>
							   <input class="form-control" name="no_ic" value=" <?php echo $row['no_ic'] ?>" required>
							   </div>

								<div class="form-group">
							    <label>Umur</label>
							    <input class="form-control" name="umur" value=" <?php echo $row['umur'] ?>" required>
							   </div>
                                             
                        </div>

							     <div class="row">
							     <div class="col-lg-6">
							     
                                 <div class="form-group">
							     <label>Alamat Syarikat</label>
							      <input class="form-control" name="alamat_syarikat" value=" <?php echo $row['alamat_syarikat'] ?>">
							      </div>

							      <div class="form-group">
							   <label>Negeri</label>
                                      <select class="form-control" name="negeri" id="negeri" requiredX>
                                      <option value="default">Sila Pilih</option>                                                         
                 <?php   while($row2=mysql_fetch_array($result1))
						  {
							$id_negeri=$row['negeri'];
                            $caption = $row2['name'];
							$id = $row2['id_negeri'];
                            $sel_select= "";
                            if ($id_negeri==$id){
                                $sel_select= "SELECTED=SELECTED"; 
                            }                                
                  ?>                                                                                              
<option value="<?php echo $id;?>"<?php echo $sel_select; ?>> <?php echo $caption ?></option>
                       <?php       } ?>                       
               </select>
							      </div>		

							      <div class="form-group">
							     <label>Daerah</label>
                                        <select class="form-control" name="daerah" id="daerah" requiredX>
                                        <option value="default">Sila Pilih</option>                                                         
                 <?php   while($row2=mysql_fetch_array($result2))
						  {
							$id_daerah=$row['daerah'];
                            $caption = $row2['nama_daerah'];
							$id = $row2['id_daerah'];
                            $sel_select= "";
                            if ($id_daerah==$id){
                                $sel_select= "SELECTED=SELECTED"; 
                            }                                
                  ?>                                                                                              
<option value="<?php echo $id;?>"<?php echo $sel_select; ?>> <?php echo $caption ?></option>
                       <?php       } ?>                       
               </select>
							      </div>

							     <div class="form-group">
							     <label>Poskod</label>
							     <input class="form-control" name="poskod" value=" <?php echo $row['poskod'] ?>">	                  
							     </div>
                                                                                              
                                 <div class="form-group">
							     <label>No Telefon</label>
							     <input class="form-control" name="no_tel" value=" <?php echo $row['no_tel'] ?>" required>	
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
							                                            <input class="form-control" name="tarikh_selenggara" value=" <?php echo $row['tarikh_selenggara'] ?>" required>	            
							                                        </div>
                                                                    
                                                                    <div class="form-group">
							                                            <label>Masa Selenggara</label>
							                                            <input class="form-control" name="masa_selenggara" value=" <?php echo $row['masa_selenggara'] ?>" required>	            
							                                        </div>
                                                                    
                                            <div class="form-group">
                                            <label>Pilihan Selenggara</label>
                                           <select class="form-control" name="pilihan_selenggara" id="pilihan_selenggara">
							                 			  <option>Sila Pilih Jenis Selenggara</option>
                                                          							
							                              <option value="1"
                                                          <?php 
														  if($row["pilihan_selenggara"]=='1')
														  {
															  echo "selected";
														  }
														  ?>
                                                          >Elektrik</option>
                                                          
                                                          <option value="2"
                                                           <?php 
														  if($row["pilihan_selenggara"]=='2')
														  {
															  echo "selected";
														  }
														  ?>
                                                          >Utiliti</option>
							                              </select>
                                        </div>

							                                     </div>
							                                <!-- /.col-lg-6 (nested) -->


                                            <div class="row"> 
							                <div class="col-lg-6">
                                        
                                            <div class="form-group">
                                            <label>Catatan</label>
                                            <input class="form-control" name="catatan" value="<?php echo $row['catatan'] ?>">
                                              
							               </div>
                                        <div class="form-group">   
                                        <br>
                                       <input type="hidden" name="id_selenggara" value="<?php echo $row['id_selenggara']; ?>">                    
                                       <button type="submit" class="btn btn-primary">Kemaskini</button>
                                       <button class="btn btn-primary" onclick="history.go(-1);">Kembali </button>
								
                                        </div>                            
                                  <?php }?>  
							                                     </div>
							                                <!-- /.col-lg-6 (nested) -->
	    
							                           
                                                        </div>
                                                        </div>
                                                        
                                                        
															
                                   
 </form>
  								 <!-- /.row (nested) -->
							                        