<?php 

    include("../connection/connection.php");
						  
						  $idd = $_GET['id'];
						  $sql_search="SELECT 
						  id,id_masjid, nama_pengurus, no_tel,nama_rukuntetangga,bil_anggota, alamat, negeri, 
	                      daerah,poskod
						  FROM sej6x_data_rukuntetangga
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
						
						  //untuk sql daerah
						  $sql_daerah="SELECT id_daerah,id_negeri,nama_daerah FROM daerah WHERE id_negeri='9'"; 
	                      $result2=mysql_query($sql_daerah) or die ("Error :".mysql_error());
						  
						  //untuk sql zon kariah 
						  $sql_zonkariah="SELECT id_zonqariah,id_masjid,nama_zon,no_huruf FROM sej6x_data_zonqariah"; 	                      $sql_zon=mysql_query($sql_zonkariah) or die ("Error :".mysql_error());
							
?>
						   
						   
   <div class="row">
                <div class="col-lg-12">
                    <h2 align="center" class="page-header">RUKUN TETANGGA</h2>
                </div>
                <!-- /.col-lg-12 -->
</div>
 <div class="row">
  
  <div class="col-lg-12">
  
   <div class="panel panel-default">
   <div class="panel-heading">
   Maklumat Rukun Tetangga</div> 
  <div class="panel-body">
   <form method="post" action="admin/update_rukuntetangga.php" name="rukuntetangga">
  
  <div class="row">
  
 
  <div class="col-lg-6">
  
    <div class="form-group">
      <label>Nama Pengurus</label>
      <input class="form-control" name="nama_pengurus" id="nama_pengurus" value="<?php echo $row['nama_pengurus'];?>" required />
    </div>
    <div class="form-group">
      <label>No Telefon Pengurus</label>
      <input class="form-control" name="no_tel" id="no_tel" value="<?php echo $row['no_tel'];?>" required />
    </div>
    <div class="form-group">
      <label>Bilangan Anggota</label>
      <input class="form-control" name="bil_anggota" id="bil_anggota" value="<?php echo $row['bil_anggota'];?>" required />
    </div>
     <div class="form-group">
      <label>Nama Rukun Tetangga</label>
      <input class="form-control" name="nama_rukuntetangga" id="nama_rukuntetangga" value="<?php echo $row['nama_rukuntetangga'];?>" required />
    </div>
    </div>
    
    <!-- /.col-lg-4 (nested) -->
    <div class="row">
      <div class="col-lg-6">
        <div class="form-group">
          <label>Alamat Pasti</label>
          <input class="form-control" name="alamat" id="alamat" value="<?php echo $row['alamat'];?>"/>
        </div>
        <div class="form-group">
          <label>Negeri</label>
       
							                                           
                                        <select class="form-control" name="negeri" id="negeri" requiredX>
                                      <option value="default">Sila Pilih</option>                                                         
                 <?php   while($row2=mysql_fetch_array($result1))
						  {
							$negeri=$row['negeri'];
                            $caption = $row2['name'];
							$id = $row2['id_negeri'];
                            $sel_select= "";
                            if ($negeri==$id){
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
							$daerah=$row['daerah'];
                            $caption = $row2['nama_daerah'];
							$id = $row2['id_daerah'];
                            $sel_select= "";
                            if ($daerah==$id){
                                $sel_select= "SELECTED=SELECTED"; 
                            }                                
                  ?>                                                                                              
<option value="<?php echo $id;?>"<?php echo $sel_select; ?>> <?php echo $caption ?></option>
                       <?php       } ?>                       
               </select>
                                    </div>
      
        
        <div class="form-group">
          <label>Poskod</label>
          <input class="form-control" id="poskod" name="poskod" value="<?php echo $row['poskod'];?>" required/>
        </div>
        
        <div class="form-group">
           <input type="hidden" name="id" id="id"  value="<?php echo $row['id'];?>"  />
           <input type="hidden" name="id_masjid" id="id_masjid" value="3857" />
     <input type="submit" name="update" id="update" value="Kemaskini" class="btn btn-success" /> 
        </div>

      </div>
      <!-- /.col-lg-4 (nested) -->

       <?php  }
        		                   }
				                  	else
						             {
						            echo mysql_error();
							          }
									?>         
    </div>
    </div>
     </form>