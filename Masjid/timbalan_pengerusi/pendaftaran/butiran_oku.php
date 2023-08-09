
    <div class="row">
                <div class="col-lg-12">
                    <h1 align="center" class="page-header">BUTIRAN KELAINAN UPAYA</h1>
                </div>
                <!-- /.col-lg-12 -->
</div>
            <!-- /.row -->
 <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Maklumat OKU</div>
							
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
                        
                  <form action="pendaftaran/add_oku.php" method='post'>
                               
					    <?php while($row = mysql_fetch_assoc($result)){ ?> 
                        
                    <div class="col-lg-12">
                              <div class="form-group">
                                            <label>Nama Kelainan Upaya (OKU):</label> <?php echo $row['nama_penuh'];?>
                                          </div>
                                        </div>
                                       
                                        
                    <div class="col-lg-12">
                              <div class="form-group">
                                            <label>No K/P:</label> <?php echo $row['no_ic'];?>
                      </div>
                              </div>
   						   
                         <hr />
                           
                            <div class="col-lg-4">
                              <div class="form-group">
                                <label>Kategori Orang Kurang Upaya (OKU):</label>
                                <select class="form-control" name="jenis_oku" id="jenis_oku">
                                        <option value="0">Sila Pilih</option>
                                        <option value="Pendengaran">Pendengaran </option>
                                        <option value="Penglihatan">Penglihatan</option>
                                        <option value="Fizikal">Fizikal</option>
                                        <option value="Pembelajaran">Masalah Pembelajaran </option>
                                        <option value="Pertuturan">Pertuturan</option>
                                        <option value="Mental">Mental </option>
                                        <option value="Pelbagai">Pelbagai </option>
                                      </select>   
                              </div>    
                                </div>                     
                            
                              <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Catatan:</label>
                                            <input class="form-control" name="keterangan" id="keterangan" requiredX>   
                                        </div>    
                                </div>      


                                <div class="col-lg-2">
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
 