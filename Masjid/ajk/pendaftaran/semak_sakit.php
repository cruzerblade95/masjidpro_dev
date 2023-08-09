
    <div class="row">
                <div class="col-lg-12">
                    <h1 align="center" class="page-header">BUTIRAN PENYAKIT</h1>
                </div>
                <!-- /.col-lg-12 -->
</div>
            <!-- /.row -->
 <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Maklumat Penyakit</div>
							
                             <?php 
                          include("connection/connection.php");
						  
						  $idd = $_GET['id_data'];

						  $sql_search="SELECT 
						  a.id_data,a.nama_penuh,a.no_ic,b.id_data,b.jenis_penyakit,b.rawatan_terkini
						  FROM sej6x_data_peribadi a,sej6x_data_sakit b 
						  WHERE a.id_data='".$idd."'
						  AND  a.id_data=b.id_data
						  "; 
	                      $result = mysql_query($sql_search) or die ("Error :".mysql_error());
						  ?>    
                        <div class="panel-body">
                        <div class="row"> 
                        
                  <form action="pendaftaran/sql_update_sakit.php" method='post'>
                               
					    <?php while($row = mysql_fetch_assoc($result)){ ?> 
                        
                    <div class="col-lg-12">
                              <div class="form-group">
                               <div class="alert alert-info">
                                           <div align="center">  <label>Nama Pesakit :</label> <?php echo $row['nama_penuh'];?></div>
                                     
                                            <div align="center"> <label>No K/P:</label> <?php echo $row['no_ic'];?></div></div>

                      </div>
                              </div>
   						   
                         <hr />
                           
                            <div class="col-lg-4">
                              <div class="form-group">
                                <label>Jenis Penyakit</label>
                                <input class="form-control" name="jenis_penyakit" id="jenis_penyakit" value="<?php echo $row['jenis_penyakit'];?>" requiredX>   
                              </div>    
                                </div>                     
                            
                              <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Rawatan Terkini</label>
                                            <input class="form-control" name="rawatan_terkini" id="rawatan_terkini" value="<?php echo $row['rawatan_terkini'];?>" requiredX>   
                                        </div>    
                                </div>      


                                <div class="col-lg-2">
                                    <div class="form-group">
                                            <br>
               
                  <input type="hidden" name="id_data" value="<?php echo $row['id_data']; ?>">
                  <input type="hidden" name="id_pegawai" value="<?php echo $row['id_data']; ?>">
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
 