   <div class="row">
                <div class="col-lg-12">
                    <h2 align="center" class="page-header">KEMASKINI SURAU</h2>
                </div>
                <!-- /.col-lg-12 -->
</div>
 <?php 
                          include("connection/connection.php");
						  
						  $idd = $_GET['id'];
						  
						  $sql_search="SELECT id,id_masjid, nama_pengurus, 
						  no_tel,bil_anggota,nama_surau,alamat,negeri,daerah,poskod
						  FROM sej6x_data_surau
						  WHERE id='".$idd."' ";
	                      $r = mysql_query("$sql_search",$bd);
		                  if($r)
						   {
						  while($row=mysql_fetch_array($r))
							{
							$id_data=$row['id_data'];
						
						//untuk sql negeri
						  $sql_negeri="SELECT id_negeri,name FROM negeri"; 
	                      $result1 = mysql_query($sql_negeri) or die ("Error :".mysql_error());
						    
                          $options1 = $options1."<option>Sila Pilih Negeri</option>";  
                          while($row1=mysql_fetch_array($result1))
						  {
							
                          $options=$options."<option value='$row1[id_negeri]'
						  >$row1[name]</option>";
                          }	
						
						
						  //untuk sql daerah
						  $sql_daerah="SELECT id_daerah,id_negeri,nama_daerah FROM daerah WHERE id_negeri='9'"; 
	                      $result2=mysql_query($sql_daerah) or die ("Error :".mysql_error());
						    
                          $options3 = $options3."<option>Sila Pilih Daerah</option>";  
                          while($row2=mysql_fetch_array($result2))
						  {
                          $options4=$options4."<option value='$row2[id_daerah]'

						  if('$row2[id_daerah]'=='$row2[id_daerah]')
						  {
						   echo 'selected';
				          }

						  >$row2[nama_daerah]</option>";
						  
                          }
						  
						 
						    //untuk sql zon kariah 
						  $sql_zonkariah="SELECT id_zonqariah,id_masjid,nama_zon,no_huruf FROM sej6x_data_zonqariah"; 
	                      $sql_zon=mysql_query($sql_zonkariah) or die ("Error :".mysql_error());
						    
                          $options5 = $options5."<option>Sila Pilih Zon</option>";  
                          while($row2=mysql_fetch_array($sql_zon))
						  {
                          $pilihanzon=$pilihanzon."<option value='$row2[id_zonqariah]'>$row2[no_huruf]: $row2[nama_zon]</option>";
                          }	
						  ?>  

 
   <div class="row">
							                <div class="col-lg-12">
							                    <div class="panel panel-info">
							                       <!--  <div class="panel-heading">
							                            MAKLUMAT PERIBADI
							                        </div> -->
							                        <div class="panel-body">
							     
    <form method="post" id="update_surau" action="info/update_surau.php">
  
  <div class="row">
  
  <h4 align="center"><u>Maklumat Surau</u></h4>
  <div class="col-lg-6">
  
  
    <div class="form-group">
      <label>Nama Pengurus</label>
      <input class="form-control" name="nama_pengurus" id="nama_pengurus" value="<?php echo $row['nama_pengurus'];?>"requiredx />
    </div>
    <div class="form-group">
      <label>No Telefon Pengurus</label>
      <input class="form-control" name="no_tel" id="no_tel" value="<?php echo $row['no_tel'];?>" requiredx />
    </div>
    <div class="form-group">
      <label>Bilangan Ahli Khariah</label>
      <input class="form-control" name="bil_anggota" id="bil_anggota" value="<?php echo $row['bil_anggota'];?>" requiredx />
    </div>
     <div class="form-group">
      <label>Nama Surau</label>
      <input class="form-control" name="nama_surau" id="nama_surau" value="<?php echo $row['nama_surau'];?>"requiredx />
    </div>
    </div>
    
    <!-- /.col-lg-4 (nested) -->
    <div class="row">
      <div class="col-lg-6">
        <div class="form-group">
          <label>Alamat Surau</label>
          <input class="form-control" name="alamat" id="alamat" value="<?php echo $row['alamat'];?>"/>
        </div>
        <div class="form-group">
          <label>Negeri</label>

	 <select class="form-control" name="negeri" id="negeri" requiredX>
                                        <?php echo $options1;?> <?php echo $options;?>
                                      </select>
        </div>
        <div class="form-group">
          <label>Daerah</label>
          <select name="select" class="form-control" nama="daerah" id="daerah" requiredX>
                                        <?php echo $options3;?> <?php echo $options4;?>
                                      </select>
        </div>
        <div class="form-group">
          <label>Poskod</label>
          <input class="form-control" id="poskod" name="poskod" value="<?php echo $row['poskod'];?>"/>
        </div>
        
        <div class="form-group">
           <input type="hidden" name="id_masjid" id="id_masjid" value="3857" />
      <input type="submit" name="update" id="update" value="Kemaskini" class="btn btn-success" />    
        </div>

      </div>
      <!-- /.col-lg-4 (nested) -->

                
    </div>
    </div>
     </form>     
							                            </div>
							                            <!-- /.row (nested) -->
 <?php  }
        		                   }
				                  	else
						             {
						            echo mysql_error();
							          }
									?>
									