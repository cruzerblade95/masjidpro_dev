
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
                        
                  <form name="add" id="add" action="setiausaha/add_khairat.php" method='post'>
                               
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
                                                <option value="0">Sila Pilih Pakej</option>
                                                <option value="1">Biasa(Asas)- RM90</option>
                                                <option value="2">Biasa(Premium)- RM150</option>
                                                <option value="3">Biasa(Premium Plus)- RM190</option>
                                                <option value="4">W.Emas/Ibu Tunggal/OKU(Asas)- RM60</option>
                                                <option value="5">W.Emas/Ibu Tunggal/OKU(Premium)- RM120</option>
                                                <option value="6">W.Emas/Ibu Tunggal/OKU(Premium Plus)- RM160</option>
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
                            
                                <label>
                                  <div align="center">Nama</div>
                                </label>
                                <input class="form-control" name="nama" id="nama" requiredx>
                              </div>    
                                </div>                     
                            
                              <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>
                                              <div align="center">Hubungan</div>
                                            </label>
                                            <input class="form-control" name="hubungan" id="hubungan" requiredX>   
                                        </div>    
                                </div>      

							   
                                 <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>
                                              <div align="center">Tarikh Lahir</div>
                                            </label>
                                            <input class="form-control" name="tarikh_lahir" id="tarikh_lahir" type="date" requiredX>   
                                        </div>    
                                </div>   
                               

                                <div class="col-lg-3">
                                
                                 <div class="form-group">
                                            <label>
                                              <div align="center">No.K/P@S.Lahir</div>
                                            </label>
                                            <input class="form-control" name="no_kp" id="no_kp" requiredX>   
                                  </div>    

                                  <div class="form-group">
                                            <br>
               
                  <input type="hidden" name="id_data" value="<?php echo $row['id_data']; ?>">
         		  <input type="hidden" name="id_masjid" value="3857">    
                  <input type="submit"  value="Hantar" class="btn btn-primary"></input> 
                                        

                                    </div>
                                     <?php }?>  
                    </div>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
 