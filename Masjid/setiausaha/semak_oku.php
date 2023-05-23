
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
						  a.id_data,a.nama_penuh,a.no_ic,b.id_data,b.jenis_oku,b.keterangan
						  FROM sej6x_data_peribadi a, sej6x_data_oku b
						  WHERE a.id_data='".$idd."' 
						  AND a.id_data=b.id_data"; 
	                      $result = mysql_query($sql_search) or die ("Error :".mysql_error());
						  ?>    
                        <div class="panel-body">
                        <div class="row"> 
                        
                  <form action="admin/sql_update_oku.php" method='post'>
                               
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
                                <label>Kategori Orang Kurang Upaya (OKU):</label>
                                <select class="form-control" name="jenis_oku" id="jenis_oku">
                                        <option>Sila Pilih</option>
                                        <option value="Pendengaran"
                                          <?php 
														  if($row["jenis_oku"]=='Pendegaran')
														  {
															  echo "selected";
														  }
														  ?>
                                        >Pendengaran </option>
                                        <option value="Pendegaran"
                                         <?php 
														  if($row["jenis_oku"]=='Penglihatan')
														  {
															  echo "selected";
														  }
														  ?>     
                                        >Penglihatan</option>
                                        <option value="Fizikal"
                                        <?php 
														  if($row["jenis_oku"]=='Fizikal')
														  {
															  echo "selected";
														  }
														  ?>
                                        >Fizikal</option>
                                        <option value="Pembelajaran"
                                        <?php 
														  if($row["jenis_oku"]=='Pembelajaran')
														  {
															  echo "selected";
														  }
														  ?>     
                                        >Masalah Pembelajaran</option>
                                        <option value="Pertuturan"
                                       <?php 
														  if($row["jenis_oku"]=='Pertuturan')
														  {
															  echo "selected";
														  }
														  ?>      
                                        >Pertuturan</option>
                                        <option value="Mental"
                                        <?php 
														  if($row["jenis_oku"]=='Mental')
														  {
															  echo "selected";
														  }
														  ?>     
                                        >Mental </option>
                                        <option value="Pelbagai"
                                        <?php 
														  if($row["jenis_oku"]=='Pelbagai')
														  {
															  echo "selected";
														  }
														  ?>     
                                        >Pelbagai </option>
                                      </select>   
                              </div>    
                                </div>   
               
                              <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Catatan:</label>
                                            <input class="form-control" name="keterangan" id="keterangan" value="<?php echo $row['keterangan'];?>" requiredX>   
                                        </div>    
                                </div>      


                                <div class="col-lg-2">
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
 