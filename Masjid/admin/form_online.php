   <div class="row">
                <div class="col-lg-12">
                    <h2 align="center" class="page-header">DAFTAR AHLI KARIAH</h2>
                </div>
                <!-- /.col-lg-12 -->
</div>
 <?php 
                          include("connection/connection.php");

						    //untuk sql negeri
						  $sql_negeri="SELECT id_negeri,name FROM negeri"; 
	                      $result1 = mysql_query($sql_negeri) or die ("Error :".mysql_error());
						    
                          $options1 = $options1."<option value='0'>Sila Pilih Negeri</option>";  
                          while($row1=mysql_fetch_array($result1))
						  {
							
                          $options=$options."<option value='$row1[id_negeri]'>$row1[name]</option>";
                          }
						
						  //untuk sql daerah
						  $sql_daerah="SELECT id_daerah,id_negeri,nama_daerah FROM daerah WHERE id_negeri='9'"; 
	                      $result2=mysql_query($sql_daerah) or die ("Error :".mysql_error());
						    
                          $options3 = $options3."<option value='0'>Sila Pilih Daerah</option>";  
                          while($row2=mysql_fetch_array($result2))
						  {
                          $options4=$options4."<option value='$row2[id_daerah]'>$row2[nama_daerah]</option>";
                          }
						 
						    //untuk sql zon kariah
						  $sql_zonkariah="SELECT id_zonqariah,nama_zon,no_huruf FROM sej6x_data_zonqariah"; 
	                      $sql_zon=mysql_query($sql_zonkariah) or die ("Error :".mysql_error());
						    
                          $options5 = $options5."<option value='0'>Sila Pilih Zon</option>";  
                          while($row2=mysql_fetch_array($sql_zon))
						  {
                          $pilihanzon=$pilihanzon."<option value='$row2[id_zonqariah]'>$row2[no_huruf]: $row2[nama_zon]</option>";
                          }
						  
						  ?>  

 
   <div class="row">
							                 <div class="col-lg-12">
							                   <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Borang Online Keahlian Kariah</div>

                        <div class="panel-body">
							     
                                       <form method="post" id="online_form" action="pendaftaran/add_online.php">
                                  

                                                       <div class="row">
							                            	
							                                
							                                <div class="col-lg-4">
                                                             
							                                        <div class="form-group">
							                                            <label>Nama Penuh</label>
							                                            <input class="form-control" name="nama_penuh" id="nama_penuh" requiredX>	            
							                                        </div>

							                                        <div class="form-group">
							                                            <label>No. K/P</label>
							                                            <input class="form-control" name="no_ic" id="no_ic" placeholder="Contoh: 880528355036" requiredX>	
							                                        </div>
                                                                    
                                                                     <div class="form-group">
							                                            <label>No Telefon</label>
							                                            <input class="form-control" name="no_hp" id="no_hp" placeholder="Contoh: 0143159891" requiredX>
							                                        </div>


							                                        <div class="form-group">
							                                            <label>Umur</label>
							                                            <input class="form-control" name="umur" id="umur" requiredX>
							                                        </div>
                                                                    
                                                                     <div class="form-group">
							                                            <label>Tarikh Lahir</label>
							                                            <input class="form-control" name="tarikh_lahir" id="tarikh_lahir" placeholder="Contoh: 1992-05-30" type="date" requiredX>	
							                                        </div>
                                                                    
                                              						 <div class="form-group">
							                 					     <label>Jantina</label>
							                   	<select class="form-control" name="jantina" id="jantina">
							                 			  <option value="0">Sila Pilih</option>							
							                              <option value="1">Lelaki</option>
                                                          <option value="2">Perempuan</option>
							                                            </select>
							                                        </div>

							                                </div>
							                                <!-- /.col-lg-4 (nested) -->



							                                <div class="col-lg-4">	

															 <div class="form-group">
							                                            <label>Bangsa</label>
							                                            <select class="form-control" name="bangsa" id="bangsa">
							                                                <option value="0">Sila Pilih</option>
							                                                <option value="1">Melayu</option>
							                                                <option value="2">Cina</option>
							                                                <option value="3">India</option>
							                                                <option value="4">Lain-lain</option>
							                                            </select>
							                                        </div>
																
                                                            <div class="form-group">
							                 				<label>Warganegara</label>
							                   				<select class="form-control" name="warganegara" id="warganegara">
							                 			  <option value="0">Sila Pilih</option>							
							                              <option value="1">Warganegara</option>
                                                          <option value="2">Bukan Warganegara</option>
							                                            </select>
							                                        </div>
                                                                    
							                                        <div class="form-group">
							                                            <label>Status Perkahwinan</label>
							                                            <select class="form-control" name="status_perkahwinan" id="status_perkahwinan" requiredX>
							                                                <option value="0">Sila Pilih</option>
							                                                <option value="1">Bujang</option>
							                                                <option value="2">Berkahwin</option>
							                                                <option value="3">Duda</option>
							                                                <option value="4">Janda</option>
							                                            </select>
							                                        </div>
                                                                    
							                                        <div class="form-group">
							                                            <label>Pekerjaan</label>
							  <input class="form-control" name="pekerjaan" id="pekerjaan">	                  
							                                        </div> 
                                                                    
                                                                     <div class="form-group">
							                                            <label>Tempoh Tinggal Di Kariah</label>
							  <input class="form-control" name="tempoh_tinggal" id="tempoh_tinggal">	                  
							                                        </div> 
							                                        
																	 <label>Zon Kariah</label>
		 <select class="form-control" name="zon_qariah" id="zon_qariah" requiredx>
                                        <?php echo $options5;?> <?php echo $pilihanzon;?>
                                      </select>
							                                       

							                                </div>
							                                <!-- /.col-lg-4 (nested) -->

							                            <div class="row">
							                                <div class="col-lg-4">
							                                	    <div class="form-group">
							                                            <label>No Rumah (Alamat Terkini)</label>
							                                            <input class="form-control" placeholder="Contoh: 1842-2 Kampung Selamat" name="alamat_terkini" id="alamat_terkini">
							                                        </div>

							                                        <div class="form-group">
                                      <label>Negeri</label>
                             <select class="form-control" name="id_negeri" id="id_negeri" requiredx>
                                        <?php echo $options1;?> <?php echo $options;?>
                                      </select>
                                    </div>		

							                                        <div class="form-group">
                                      <label>Daerah</label>
                                       <select class="form-control" name="id_daerah" id="id_daerah" required>
                                        <?php echo $options3;?><?php echo $options4;?>
                                      </select>
                                    </div>


							                                        <div class="form-group">
							          <label>Poskod</label>
							          <input class="form-control" name="poskod" id="poskod">	                  
							                                        </div>
                                      <input type="hidden" name="id_masjid" id="id_masjid" value="3857" />	
                                   <input type="submit" value="Hantar Pemohonan" class="btn btn-success" />            

							                                </div>
							                                <!-- /.col-lg-4 (nested) -->
							                            </div>

							                                 
							                            </div>
							                            <!-- /.row (nested) -->


							                           
                                               </form>
                                           </div>
	
									