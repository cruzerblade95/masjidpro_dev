
    <div class="row">
                <div class="col-lg-12">
                    <h1 align="center" class="page-header">BUTIRAN JAWATAN</h1>
                </div>
                <!-- /.col-lg-12 -->
    </div>
            <!-- /.row -->
    <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Maklumat Jawatan</div>
              <?php 
              include("../connection/connection.php");
              
              $idd = $_GET['id_data'];

              $sql_search="SELECT 
              id_data,nama_penuh,no_ic,umur,alamat_terkini,no_hp
              FROM sej6x_data_peribadi WHERE id_data='".$idd."' ";  
                        $result = mysql_query($sql_search) or die ("Error :".mysql_error());
              ?>    
                        <div class="panel-body">
                        <div class="row"> 
                        
                  <form action="admin/add_ajk.php" method='post' enctype="multipart/form-data">
                               
                  <?php while($row = mysql_fetch_assoc($result)){ ?> 
                        
                  <div class="col-lg-12">
                              <div class="form-group">
                                            <label>Nama Ahli Jawatankuasa (AJK):</label> <?php echo $row['nama_penuh'];?>
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
                                <label>Jawatan</label>
                                <select class="form-control" name="jawatan" id="jawatan">
                                        <option>Sila Pilih</option>
                                        <option value="Pengerusi">Pengerusi</option>
                                        <option value="Timbalan Pengerusi">Timbalan Pengerusi</option>
                                        <option value="Setiausaha">Setiausaha</option>
                                        <option value="Bendahari">Bendahari</option>
                                        <option value="AJK">AJK </option>
                                      </select>
                              </div>    
                                </div>                     
                            
                              <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Tarikh Lantikan</label>
                                            <input class="form-control" type="date" name="tarikh_lantikan" id="tarikh_lantikan" requiredX>   
                                        </div>    
                                </div>      
                 <div class="col-lg-4">
                                        <div class="form-group">
                                             <div class="form-group">
                                         <label>Upload Gambar</label>
                                         <input type="file" class="form-control-file" name="gambar" id="gambar" />
                                        </div>    
                                </div>      

                                <div class="col-lg-2">
                                    <div class="form-group">
                                            <br>
               
                  <input type="hidden" name="id_data" value="<?php echo $row['id_data']; ?>">
                  <input type="hidden" name="id_ajk" value="<?php echo $row['id_data']; ?>">
              <input type="hidden" name="id_masjid" value="3857">    
                  <input type="submit"  value="Upload" class="btn btn-primary"></input> 
                                        

                                    </div>
                                     <?php }?>  
                    </div>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
 