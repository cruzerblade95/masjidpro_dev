<?php 

    include("connection/connection.php");
						  
						  $idd = $_GET['id'];
						  $sql_search="SELECT 
						  id,id_masjid, nama_pengurus, no_tel,nama_kemas,bil_pelajar, alamat, negeri, 
	                      daerah,poskod
						  FROM sej6x_data_kemas
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
							
?>
						   
						   
   <div class="row">
                <div class="col-lg-12">
                    <h2 align="center" class="page-header">KEMAS</h2>
                </div>
                <!-- /.col-lg-12 -->
</div>
 <div class="row">
  
  <div class="col-lg-12">
  
   <div class="panel panel-default">
   <div class="panel-heading">
   Maklumat KEMAS </div> 
  <div class="panel-body">
   <form method="post" action="info/update_kemas.php" name="kemas">
  
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
      <label>Bilangan Pelajar</label>
      <input class="form-control" name="bil_pelajar" id="bil_pelajar" value="<?php echo $row['bil_pelajar'];?>" required />
    </div>
     <div class="form-group">
      <label>Nama KEMAS</label>
      <input class="form-control" name="nama_kafa" id="nama_kafa" value="<?php echo $row['nama_kemas'];?>" required />
    </div>
    </div>
    
    <!-- /.col-lg-4 (nested) -->
    <div class="row">
      <div class="col-lg-6">
        <div class="form-group">
          <label>Alamat KEMAS</label>
          <input class="form-control" name="alamat" id="alamat" value="<?php echo $row['alamat'];?>"/>
        </div>
        <div class="form-group">
          <label>Negeri</label>
       
							                                             <label>Negeri</label>
                                      <select class="form-control" name="id_negeri" id="id_negeri" requiredX>
                                        <?php echo $options1;?> <?php echo $options;?>
                                      </select>
        </div>
       
        <div class="form-group">
           <label>Daerah</label>
                                      <select name="select" class="form-control" nama="id_daerah" id="id_daerah" requiredX>
                                        <?php echo $options3;?> <?php echo $options4;?>
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