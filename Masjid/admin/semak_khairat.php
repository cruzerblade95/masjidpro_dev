
    <div class="row">
                <div class="col-lg-12">
                    <h1 align="center" class="page-header">BUTIRAN KHAIRAT</h1>
                </div>
                <!-- /.col-lg-12 -->
</div>
            <!-- /.row -->
 <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Maklumat Khairat</div>
							
                             <?php 
                          include("connection/connection.php");
						  
						  $idd = $_GET['id_data'];

						  $sql_search="SELECT 
						  id_data,nama_penuh,no_ic,umur,alamat_terkini,no_hp
						  FROM sej6x_data_peribadi WHERE id_data='".$idd."' "; 
	                      $result = mysql_query($sql_search) or die ("Error :".mysql_error());
						  ?>    
                        <div class="panel-body">
                        <div class="row"> 
                        
                  <form action="admin/add_khairat.php" method='post'>
                               
					    <?php while($row = mysql_fetch_assoc($result)){ ?> 
                        
                    <div class="col-lg-12">
                              <div class="form-group">
                                            <label>Nama Ahli Khairat:</label> <?php echo $row['nama_penuh'];?>
                                          </div>
                                        </div>
                                       
                                        
                    <div class="col-lg-12">
                              <div class="form-group">
                                            <label>No K/P:</label> <?php echo $row['no_ic'];?>
                      </div>
                              </div>
                                <?php }?> 
                          <?php 
                          include("connection/connection.php");
						  
						  $idd = $_GET['id_data'];

						  $sql_search="SELECT 
						  a.id_data,a.nama_penuh,a.no_ic,b.pakej,b.nama,b.hubungan,b.tarikh_lahir,b.no_kp
						  FROM sej6x_data_peribadi a, sej6x_data_khairat b  
						  WHERE a.id_data='".$idd."' 
						  AND a.id_data=b.id_data "; 
	                      $result = mysql_query($sql_search) or die ("Error :".mysql_error());
						  while($row = mysql_fetch_assoc($result)){ ?>
						            
                      <div class="col-lg-12">      
   					 <div class="alert alert-info">
                      <label>NOTA:</label>
                      <label>Maklumat ahli keluarga yang akan dilindungi!</label>      
                      <label>Isteri/Suami dan anak-anak yang belum berkahwin sahaja(Asas), Ibu/Bapa(Premium), Ibu/Bapa mertua(Premium)</label>
                            </div>
                             </div>	   
                           
                         <div class="col-lg-12">
                        <div class="form-group">
                                            <label>Pakej</label>
                                            
                                            <select class="form-control" name="pakej" id="pakej">
                                                          							
							                              <option value="1"
                                                          <?php 
														  if($row["pakej"]=='1')
														  {
															  echo "selected";
														  }
														  ?>
                                                          >Biasa(Asas)- RM90</option>
                                                          
                                                          <option value="2"
                                                           <?php 
														  if($row["pakej"]=='2')
														  {
															  echo "selected";
														  }
														  ?>
                                                          >Biasa(Premium)- RM150</option>
							                              
                                                          
                                                           <option value="3"
                                                           <?php 
														  if($row["pakej"]=='3')
														  {
															  echo "selected";
														  }
														  ?>
                                                          >Biasa(Premium Plus)- RM190</option>
							                              
                                                          
                                                           <option value="4"
                                                           <?php 
														  if($row["pakej"]=='4')
														  {
															  echo "selected";
														  }
														  ?>
                                                          >W.Emas/Ibu Tunggal/OKU(Asas)- RM60</option>
							                              
                                                          
                                                           <option value="5"
                                                           <?php 
														  if($row["pakej"]=='5')
														  {
															  echo "selected";
														  }
														  ?>
                                                          >W.Emas/Ibu Tunggal/OKU(Premium)- RM120</option>
							                              
                                                          
                                                           <option value="6"
                                                           <?php 
														  if($row["pakej"]=='6')
														  {
															  echo "selected";
														  }
														  ?>
                                                          >W.Emas/Ibu Tunggal/OKU(Premium Plus)- RM160</option>
							                              </select>
                                        </div> 
                                        </div>     
                           
                         <hr />
                           <div class="row">
						   <br>
                           <br>
						     <div align="center"><label>Maklumat Keluarga Dilindungi: </label></div>
                               <br>
						   </div>
                            <div class="col-lg-3">
                              <div class="form-group">
                            
                                <label>Nama</label>
                                <input class="form-control" name="nama" id="nama"  value="<?php echo $row['nama'];?>" requiredx>
                              </div>    
                                </div>                     
                            
                              <div class="col-lg-3">
                              <div class="form-group">
                              <label>Hubungan</label>
                              <input class="form-control" name="hubungan" id="hubungan"  value="<?php echo $row['hubungan'];?>"requiredX>   
                                        </div>    
                                </div>      

							   
                                 <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Tarikh Lahir</label>
                                            <input class="form-control" name="tarikh_lahir" id="tarikh_lahir"  value="<?php echo $row['tarikh_lahir'];?>" requiredX>   
                                        </div>    
                                </div>   
                               

                                <div class="col-lg-3">
                                
                                 <div class="form-group">
                                            <label>No.K/P@S.Lahir</label>
                                            <input class="form-control" name="no_kp" id="no_kp"  value="<?php echo $row['no_kp'];?>"requiredX>   
                                        </div>    

                                  <div class="form-group">
                                            <br>
               
                  <input type="hidden" name="id_data" value="<?php echo $row['id_data']; ?>">
         		  <input type="hidden" name="id_masjid" value="3857">    
                  <input type="submit"  value="Kemaskini" class="btn btn-primary"></input> 
                                        

                                    </div>
                                     <?php }?>  
                    </div>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
 