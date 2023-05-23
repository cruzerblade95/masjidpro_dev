
    <div class="row">
                <div class="col-lg-12">
                    <h1 align="center" class="page-header">BUTIRAN KEMATIAN KARIAH</h1>
                </div>
                <!-- /.col-lg-12 -->
</div>
            <!-- /.row -->
  <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Maklumat Kematian
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#maklumat" data-toggle="tab">Maklumat Kematian</a>
                                </li>
                                <li><a href="#perbelanjaan" data-toggle="tab">Penyata Perbelanjaan Kematian</a>
                                </li>
                               
                            </ul>
                                     <?php 
                          include("connection/connection.php");
						  
						  $idd = $_GET['id_data'];

						  $sql_search="SELECT 
						  id_data,nama_penuh,no_ic,umur,alamat_terkini,no_hp
						  FROM sej6x_data_peribadi WHERE id_data='".$idd."' "; 
	                      $result = mysql_query($sql_search) or die ("Error :".mysql_error());
						  ?>    

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="maklumat">
                                    <h4 align="center">Maklumat Kematian</h4>
                        <div class="panel-body">
                        <div class="row"> 
                        
                  <form method="POST" action="<?php echo $PHP_SELF;?>" name="kematian">
                               
					    <?php while($row = mysql_fetch_assoc($result)){ ?> 
                        
                    <div class="col-lg-12">
                              <div class="form-group">
                               <div class="alert alert-info">
                                           <div align="center">  <label>Nama Kematian Kariah :</label> <?php echo $row['nama_penuh'];?></div>
                                     
                                            <div align="center"> <label>No K/P:</label> <?php echo $row['no_ic'];?></div></div>

                      </div>
                              </div>
   						   
                         <hr />
                           
                            <div class="col-lg-4">
                              <div class="form-group">
                                <label>Tarikh Kematian:</label>
                                <input class="form-control" name="tarikh_kematian" id="tarikh_kematian" type="date" requiredX>   
                              </div>    
                              
                                <div class="form-group">
                                <label>Waktu Kematian:</label>
                                <input class="form-control" name="waktu_kematian" id="waktu_kematian" requiredX>   
                              </div>  
                              
                                 <div class="form-group">
                                <label>Sebab Kematian:</label>
                                <input class="form-control" name="sebab_kematian" id="sebab_kematian" requiredX>   
                              </div>
                                </div>                     
                            
                              <div class="col-lg-4">
   
                                <div class="form-group">
                                <label>Tarikh dikebumikan:</label>
                                <input class="form-control" name="tarikh_dikebumikan" id="tarikh_dikebumikan" type="date" requiredX>   
                              </div>    
                                    
                                    <div class="form-group">
                                            <label>Waktu dikebumikan:</label>
                                            <input class="form-control" name="waktu_dikebumikan" id="waktu_dikebumikan" requiredX>   
                                        </div>  
                                        
                                         <div class="form-group">
                                            <label>Lokasi Tanah Perkuburan:</label>
                                            <input class="form-control" name="lokasi" id="lokasi" requiredX>   
                                        </div>        
                                         
                                </div>      


                                <div class="col-lg-4">
                                    
                                     <div class="form-group">
                                            <label>No. Kubur:</label>
                                            <input class="form-control" name="no_kubur" id="no_kubur" requiredX>   
                                        </div>           
                  <input type="hidden" name="id_data" value="<?php echo $row['id_data']; ?>">
         		  <input type="hidden" name="id_masjid" value="3857">    
                  <input type="submit"  value="Simpan" class="btn btn-primary"></input> 
                                        

                                    </div>
                                     <?php }?>  
                                     
                                     <?php
include("../connection/connection.php");
// INSERT
   
 if (isset($_POST['id_data'])) 
    {
			
	$id_masjid=$_POST['id_masjid'];
	$id_data=$_POST['id_data'];
	
    $tarikh_kematian=mysql_real_escape_string($_POST['tarikh_kematian']);
	$waktu_kematian=mysql_real_escape_string($_POST['waktu_kematian']);
	$sebab_kematian=mysql_real_escape_string($_POST['sebab_kematian']);
	$lokasi=mysql_real_escape_string($_POST['lokasi']);
	$tarikh_dikebumikan=mysql_real_escape_string($_POST['tarikh_dikebumikan']);
	$waktu_dikebumikan=mysql_real_escape_string($_POST['waktu_dikebumikan']);
	$no_kubur=mysql_real_escape_string($_POST['no_kubur']);
   
	
	mysql_select_db($mysql_database, $bd);
	
	$sql1 ="INSERT INTO   	
	        data_kematian(id_masjid,id_data,tarikh_kematian,waktu_kematian,sebab_kematian,lokasi,
	        tarikh_dikebumikan,waktu_dikebumikan,no_kubur,time)
	
            VALUES($id_masjid,$id_data,'$tarikh_kematian','$waktu_kematian','$sebab_kematian','$lokasi',
			'$tarikh_dikebumikan','$waktu_dikebumikan','$no_kubur',NOW())";
			
	//UPDATE
			
	$id_data=$_POST['id_data'];
			
	$sql2 ="UPDATE sej6x_data_peribadi set data_kematian=1 where id_data='$id_data'";		

	mysql_query($sql1,$bd);
	mysql_query($sql2,$bd);
	
    echo "Data Disimpan"; 
			}
			?> 

                   
                            </form>
                        </div>
                        </div>
                    </div>
                                
                                
                                <div class="tab-pane fade" id="perbelanjaan">
                                    <h4 align="center">Penyata Perbelanjaan Kematian</h4>
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
                        
                  <form action="pendaftaran/add_penyata_perbelanjaan.php" method='post'>
                               
					    <?php while($row = mysql_fetch_assoc($result)){ ?> 
                        
                    <div class="col-lg-12">
                              <div class="form-group">
                               <div class="alert alert-info">
                                           <div align="center">  <label>Nama Kematian Kariah :</label> <?php echo $row['nama_penuh'];?></div>
                                     
                                            <div align="center"> <label>No K/P:</label> <?php echo $row['no_ic'];?></div></div>

                      </div>
                              </div>
   						   
                         <hr />
                          
                       
							                                
                    <div class="col-lg-4">
                                                            <div class="form-group">
							           <div align="center"><label>(PERBELANJAAN ASAS)</label></div>
							                                            
   
                      </div>
                                                               
							                                        <div class="form-group">
							                                            <div align="center"><label>Mandi</label>
							                                            :</div>
                                                                      <input class="form-control" placeholder="Contoh: 100.00" name="mandi" id="mandi" requiredx>               
							                                           
							                                        </div>

                                                                    <div class="form-group">
                                                                        <div align="center"><label>Kain Kapan dan Kelengkapan</label>
                                                                        :</div>
                                                                      <input class="form-control" placeholder="Contoh: 100.00" name="kain_kapan" id="kain_kapan" requiredx>                  
                                                                    </div>

							                                        <div class="form-group">
							                                             <div align="center"><label>Keranda</label>
							                                             :</div>
						                                              <input class="form-control" placeholder="Contoh: 100.00" name="keranda" id="keranda" requiredx>
							                                        </div>

							                                        <div class="form-group">
							                                            <div align="center"><label>Liang</label>
							                                            :</div>
							                                            <input class="form-control" placeholder="Contoh: 100.00" name="liang" id="liang" requiredx>
							                                        </div>

							                                        <div class="form-group">
							                                             <div align="center"><label>Imam / Talkin</label>
							                                             :
							                                             </div>
							                                            <input class="form-control"placeholder="Contoh: 100.00" name="imam" id="imam" requiredx>
							                                        </div>

							                                        <div class="form-group">
							                                             <div align="center"><label>Caj Pengurusan Unit</label>
							                                             :</div>
						                                              <input class="form-control" placeholder="Contoh: 100.00" name="caj_unit" id="caj_unit" requiredx>
							                                        </div>
                                                                    
                                                                     <div class="form-group">
							                                             <div align="center">
							                                               <label>Caj Pengurusan Hospital (jika ada)</label>
							                                               :</div>
							                                            <input class="form-control" placeholder="Contoh: 100.00" name="caj_hospital" id="caj_hospital" requiredx>
							                                        </div>	
                                                                    
                                                                     <div class="form-group">
							                                             <div align="center"><label>[JUMLAH PERBELANJAAN ASAS]</label></div>
							                                            <input class="form-control" placeholder="Contoh: 100.00" name="jumlah_asas" id="jumlah_asas" requiredx>
							                                        </div>	
                    </div>                     
                            
                              <div class="col-lg-4">
   
                                 <div class="form-group">
							     <div align="center"><label>(PERBELANJAAN PILIHAN)</label></div>
							                                           
   
                                </div>

							                                        <div class="form-group">
							                                            <div align="center"> <label>Jemputan Solat (bil.buah masjid)</label></div>
							                                           <input class="form-control"  name="jemputan_solat" id="jemputan_solat" requiredx>
							                                        </div>

							                                        <div class="form-group">
							                                            <div align="center">
							                                              <label>Solat Hadiah:</label></div>
						                                              <input class="form-control" name="solat_hadiah" id="solat_hadiah" placeholder="Contoh: 100.00" requiredx>	                  
							                                        </div> 
							                                        <div class="form-group">
							                                             <div align="center"><label>Sewa Van Jenazah</label>
							                                             :</div>
						                                              <input class="form-control" name="sewa_van" id="sewa_van" placeholder="Contoh: 100.00" requiredx>	                  
							                                        </div>

							                                        <div class="form-group">
							                                            <div align="center"> <label>Caj Selenggara Bukan Ahli Pakatan Khairat:</label></div>
							                                            <input class="form-control" placeholder="Contoh: 100.00" name="caj_bukan_pakatan" id="caj_bukan_pakatan" requiredx>                  
							                                        </div> 
                                                                    
							                                        <div class="form-group">
							                                             <div align="center">
							                                               <label>Lain-Lain Perbelanjaan (nyatakan)</label>
							                                               :</div>
							                                          <input class="form-control" placeholder="Contoh: 100.00" name="lain_perbelanjaan" id="lain_perbelanjaan" requiredx>                  	                  
							                                        </div> 
                                                                    
                                                                    
                                                                     <div class="form-group">
							                                            <div align="center"> <label>[JUMLAH PERBELANJAAN PILIHAN]</label></div>
							                                            <input class="form-control" placeholder="Contoh: 100.00" name="jum_belanja_pilihan" id="jum_belanja_pilihan" requiredx>
							                                        </div>	
                                                                    
                                                                    
                                                                     <div class="form-group">
							                                            <div align="center"> <label>[JUMLAH PERBELANJAAN KESELURUHAN]</label></div>
							                                            <input class="form-control" placeholder="Contoh: 100.00" name="jum_belanja_seluruh" id="jum_belanja_seluruh" requiredx>
							                                        </div>	   
                                         
                    </div>      


                                <div class="col-lg-4">
                                    
                                     <div class="form-group">
							            <div align="center"><label>(PENGIRAAN)</label></div>
   
                    </div>
							                                	    <div class="form-group">
							                                            <div align="center"><label>[JUMLAH SUMBANGAN PAKATAN]</label></div>
						                                              <input class="form-control" placeholder="Contoh: 100.00" name="jum_sumbangan_pakatan" id="jum_sumbangan_pakatan">
							                                        </div>

							                                         <div class="form-group">
							                 <div align="center"><label>[TOLAK JUMLAH PERBELANJAAN KESELURUHAN]</label></div>
							                   <input class="form-control" placeholder="Contoh: 100.00" name="tolak_keseluruhan" id="tolak_keseluruhan">
							                                       
							                                        </div>		
  <div class="form-group">
							                                            <div align="center"><label>[BAKI]</label></div>
							         <input class="form-control" placeholder="Contoh: 100.00" name="baki" id="baki" >
							                                       
                    </div>	
                                                                    
                                      <div class="form-group">
                                      
                       <input type="hidden" name="id_data" value="<?php echo $row['id_data']; ?>">
         		                       <input type="hidden" name="id_masjid" value="3857">  
           <div align="center"><br><br><input type="submit"  value="Simpan" class="btn btn-primary"></input></div>
                                    </div>
                    <?php }?>  
                   
                            </form>
                        </div>
                        </div>
                    </div>
                               
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>