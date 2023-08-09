   <div class="row">
                <div class="col-lg-12">
                    <h2 align="center" class="page-header">IBU TUNGGAL</h2>
                </div>
                <!-- /.col-lg-12 -->
</div>
 <?php 
                          include("connection/connection.php");
						  
						  $idd = $_GET['id_data'];
						  
						  $sql_search="SELECT id_data,nama_penuh,no_ic,umur,alamat_terkini,tarikh_lahir,no_hp,poskod,pendapatan,pekerjaan,majikan,id_negeri,id_daerah,tahap_pendidikan,status_perkahwinan,bangsa,jantina,warganegara,tempoh_tinggal,zon_qariah
						  FROM sej6x_data_peribadi
						  WHERE id_data='".$idd."' ";
	                      $r = mysql_query("$sql_search",$bd);
		                  if($r)
						   {
						  while($row=mysql_fetch_array($r))
							{
							$id_data=$row['id_data'];
						
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
							                   <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Maklumat Ibu Tunggal</div>

                        <div class="panel-body">
							     
                                       <form method="post" id="ibu tunggal" action="pendaftaran/sql_update_ibutunggal.php">
                                  

                                                        <div class="row">
							                            
							                                
							                                <div class="col-lg-4">
                                                             
							                                        <div class="form-group">
							                                            <label>Nama Penuh</label>
							                                            <input type="text" name="nama_penuh" class="form-control" value="<?php echo $row['nama_penuh'];?>" requiredX>
							                                        </div>

							                                        <div class="form-group">
							                                            <label>No. K/P</label>
							                                            <input type="text" name="no_ic" class="form-control" value="<?php echo $row['no_ic'];?>" requiredX>
							                                        </div>
                                                                    
                                                                     <div class="form-group">
							                                            <label>No Telefon</label>
							                                             <input type="text" name="no_hp" class="form-control" value="<?php echo $row['no_hp'];?>" requiredX>
							                                        </div>


							                                        <div class="form-group">
							                                            <label>Umur</label>
							                                           <input type="text" name="umur" class="form-control" value="<?php echo $row['umur'];?>" requiredX>
							                                        </div>
                                                                    
                                                                     <div class="form-group">
							                                            <label>Tarikh Lahir</label>
							                                            <input type="date" name="tarikh_lahir" class="form-control" value="<?php echo $row['tarikh_lahir'];?>" requiredX>
							                                        </div>
                                                                    
                                              						 <div class="form-group">
							                 					     <label>Jantina</label>
							                   					<select class="form-control" name="jantina" id="jantina">
							                 			  <option>Sila Pilih</option>
                                                          							
							                              <option value="lelaki"
                                                          <?php 
														  if($row["jantina"]=='lelaki')
														  {
															  echo "selected";
														  }
														  ?>
                                                          >Lelaki</option>
                                                          
                                                          <option value="perempuan"
                                                           <?php 
														  if($row["jantina"]=='perempuan')
														  {
															  echo "selected";
														  }
														  ?>
                                                          >Perempuan</option>
							                              </select>
							                                        </div>

							                                </div>
							                                <!-- /.col-lg-4 (nested) -->



							                                <div class="col-lg-4">	

															 <div class="form-group">
							                                            <label>Bangsa</label>
							                                            <select class="form-control" name="bangsa" id="bangsa">
							                                                <option>Sila Pilih</option>
                                                                            
							                                                <option value="1"
                                                                             <?php 
														                    if($row["bangsa"]=='1')
														                    {
															 				 echo "selected";
														 					 }
														 					 ?>
                                                                            >Melayu</option>
							                                                <option value="2"
                                                                              <?php 
														                    if($row["bangsa"]=='2')
														                    {
															 				 echo "selected";
														 					 }
														 					 ?>
                                                                            >Cina</option>
							                                                <option value="3"
                                                                              <?php 
														                    if($row["bangsa"]=='3')
														                    {
															 				 echo "selected";
														 					 }
														 					 ?>
                                                                            >India</option>
							                                                <option value="4"
                                                                              <?php 
														                    if($row["bangsa"]=='4')
														                    {
															 				 echo "selected";
														 					 }
														 					 ?>
                                                                            >Lain-lain</option>
							                                            </select>
							                                        </div>
																
                                                            <div class="form-group">
							                 				<label>Warganegara</label>
							                   				<select class="form-control" name="warganegara" id="warganegara">
							                 			  <option>Sila Pilih</option>							
							                              <option value="1"
                                                            <?php 
														                    if($row["warganegara"]=='1')
														                    {
															 				 echo "selected";
														 					 }
														 					 ?>
                                                          >Warganegara</option>
                                                          <option value="2"
                                                           <?php 
														                    if($row["warganegara"]=='2')
														                    {
															 				 echo "selected";
														 					 }
														 					 ?>
                                                          >Bukan Warganegara</option>
							                                            </select>
							                                        </div>
                                                                    
							                                        <div class="form-group">
							                                            <label>Status Perkahwinan</label>
							                                            <select class="form-control" name="status_perkahwinan" id="status_perkahwinan" requiredXX>
							                                                <option value=>Sila Pilih</option>
							                                                <option value="1"
                                                                             <?php 
														                    if($row["status_perkahwinan"]=='1')
														                    {
															 				 echo "selected";
														 					 }
														 					 ?>
                                                                            
                                                                            >Bujang</option>
							                                                <option value="2"
                                                                              <?php 
														                    if($row["status_perkahwinan"]=='2')
														                    {
															 				 echo "selected";
														 					 }
														 					 ?>
                                                                            >Berkahwin</option>
							                                                <option value="3"
                                                                              <?php 
														                    if($row["status_perkahwinan"]=='3')
														                    {
															 				 echo "selected";
														 					 }
														 					 ?>
                                                                            >Duda</option>
							                                                <option value="4"
                                                                              <?php 
														                    if($row["status_perkahwinan"]=='4')
														                    {
															 				 echo "selected";
														 					 }
														 					 ?>
                                                                            >Janda</option>
							                                            </select>
							                                        </div>
                                                                    
							                                        <div class="form-group">
							                                            <label>Pekerjaan</label>
							                                            <input class="form-control" name="pekerjaan" id="pekerjaan" value="<?php echo $row['pekerjaan'];?>">	                  
							                                        </div> 
                                                                    
                                                                     <div class="form-group">
							                                            <label>Tempoh Tinggal Di Kariah</label>
							                                            <input class="form-control" name="tempoh_tinggal" id="tempoh_tinggal" value="<?php echo $row['tempoh_tinggal'];?>">	                  
							                                        </div> 
							                                        
                                                                    <div class="form-group">
																	 <label>Zon Kariah</label>
							                                          															 <label>Zon Kariah</label>
			<select class="form-control" name="zon_qariah" id="zon_qariah" requiredX>
             <option value="default">Sila Pilih</option>                                                         
                 <?php   while($row2=mysql_fetch_array($sql_zon))
						  {
							$zon_qariah=$row['zon_qariah'];
                            $caption = $row2['nama_zon'];
							$id = $row2['id_zonqariah'];
							$caption2 = $row2['no_huruf'];
                            $sel_select= "";
                            if ($zon_qariah==$id){
                                $sel_select= "SELECTED=SELECTED"; 
                            }                                
                  ?>                                                                                              
<option value="<?php echo $id;?>"<?php echo $sel_select; ?>> <?php echo $caption2 ?>:<?php echo $caption ?></option>
                       <?php       } ?>                       
               </select>
							                                       
</div>



							                                </div>
							                                <!-- /.col-lg-4 (nested) -->

							                            <div class="row">
							                                <div class="col-lg-4">
							                                	    <div class="form-group">
							                                            <label>No Rumah (Alamat Terkini)</label>
							                                           <input type="text" name="alamat_terkini" class="form-control" value="<?php echo $row['alamat_terkini'];?>" requiredX>
							                                        </div>

							                                        <div class="form-group">
                                      <label>Negeri</label>
                                     <select class="form-control" name="id_negeri" id="id_negeri" requiredX>
                                      <option value="default">Sila Pilih</option>                                                         
                 <?php   while($row2=mysql_fetch_array($result1))
						  {
							$id_negeri=$row['id_negeri'];
                            $caption = $row2['name'];
							$id = $row2['id_negeri'];
                            $sel_select= "";
                            if ($id_negeri==$id){
                                $sel_select= "SELECTED=SELECTED"; 
                            }                                
                  ?>                                                                                              
<option value="<?php echo $id;?>"<?php echo $sel_select; ?>> <?php echo $caption ?></option>
                       <?php       } ?>                       
               </select>
                                    </div>		

							                                        <div class="form-group">
                                      <label>Daerah</label>
                                       <select class="form-control" name="id_daerah" id="id_daerah" requiredX>
                                        <option value="default">Sila Pilih</option>                                                         
                 <?php   while($row2=mysql_fetch_array($result2))
						  {
							$id_daerah=$row['id_daerah'];
                            $caption = $row2['nama_daerah'];
							$id = $row2['id_daerah'];
                            $sel_select= "";
                            if ($id_daerah==$id){
                                $sel_select= "SELECTED=SELECTED"; 
                            }                                
                  ?>                                                                                              
<option value="<?php echo $id;?>"<?php echo $sel_select; ?>> <?php echo $caption ?></option>
                       <?php       } ?>                       
               </select>
                                    </div>


							                                        <div class="form-group">
							                                            <label>Poskod</label>
							                                           <input type="text" name="poskod" class="form-control" value="<?php echo $row['poskod'];?>" requiredX>
							                                        </div>

							                                </div>
                                                            
                                                          <div class="row">
							                                <div class="col-lg-4">
							                                	    <div class="form-group">
     <input type="hidden" name="id_data" value="<?php echo $row['id_data']; ?>">
	<input type="submit" name="update" id="update" value="Kemaskini" class="btn btn-success" />            
							                                        </div>  
							                                <!-- /.col-lg-4 (nested) -->
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
									