

<div class="row">
                <div class="col-lg-12">
                    <h1 align="center" class="page-header">AHLI KARIAH</h1>
                </div>
                <!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                        
                            Maklumat Ahli Kariah&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                           
                            <button class="btn btn-success" type="button" data-toggle="modal" data-target="#myModal">Tambah Ahli </button>
                         
                        </div>

                        <!-- /.panel-heading -->
                        <div class="panel-body">

                           <div class="table-responsive">
                            <?php 
							
                           include("connection/connection.php");
						   //include("excel/ahli_kariah.php");

						  $sql_search="SELECT id_data,nama_penuh,no_ic,umur,alamat_terkini FROM 
						  sej6x_data_peribadi ORDER BY nama_penuh ASC"; 
	                      $result = mysql_query($sql_search) or die ("Error :".mysql_error());
						
						  //untuk sql negeri
						  $sql_negeri="SELECT id_negeri,name FROM negeri"; 
	                      $result1 = mysql_query($sql_negeri) or die ("Error :".mysql_error());
						    
                          $options1 = $options1."<option value='0'>Sila Pilih Negeri</option>";  
                          while($row1=mysql_fetch_array($result1))
						  {
							
                          $options=$options."<option value='$row1[id_negeri]'>$row1[name]</option>";
                          }
						
						  //untuk sql daerah
						  $sql_daerah="SELECT id_daerah,id_negeri,nama_daerah FROM daerah WHERE id_negeri='9'"; 
	                      $result2=mysql_query($sql_daerah) or die ("Error :".mysql_error());
						    
                          $options3 = $options3."<option value='0'>Sila Pilih Daerah</option>";  
                          while($row2=mysql_fetch_array($result2))
						  {
                          $options4=$options4."<option value='$row2[id_daerah]'>$row2[nama_daerah]</option>";
                          }
						 
						    //untuk sql zon kariah
						  $sql_zonkariah="SELECT id_zonqariah,nama_zon,no_huruf FROM sej6x_data_zonqariah"; 
	                      $sql_zon=mysql_query($sql_zonkariah) or die ("Error :".mysql_error());
						    
                          $options5 = $options5."<option value='0'>Sila Pilih Zon</option>";  
                          while($row2=mysql_fetch_array($sql_zon))
						  {
                          $pilihanzon=$pilihanzon."<option value='$row2[id_zonqariah]'>$row2[no_huruf]: $row2[nama_zon]</option>";
                          }
						 
						  ?>  
       	                               
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                         
                
                                    <thead>
                                        <tr>
                                            <th><div align="center">No</div></th>
                                            <th><div align="center">Nama</div></th>
                                            <th><div align="center">No K/P</div></th>
                                            <th><div align="left">Alamat</div></th>
                                            <th><div align="center">Tindakan</div></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $x=1; ?>
                              <?php while($row = mysql_fetch_assoc($result)){ ?>
                                        <tr class="odd gradeX">
                                            <td ><div align="center"><?php echo $x; ?></div></td>
                                            <td><?php echo $row['nama_penuh']; ?></td>
                                            <td><div align="center"><?php echo $row['no_ic']; ?></div></td>
                                            <td ><?php echo $row['alamat_terkini']; ?></td>
                                            <td>
                                            
                    <a href="utama.php?view=view_ahliqariah&id_data=<?php echo $row['id_data'];?>"><button type="button" class="form-control" title="Kemaskini"><i class="glyphicon glyphicon-edit"></i></button></a><br>
                            				 
                       <form name="delete" method="POST" action="pendaftaran/del_ahlikariah.php">
                       <input type="hidden" name="del" id="del" value="<?php echo $row['id_data']; ?>">

                       <button type="submit" name="delete" id="delete" class="form-control"  title="Padam"><i class="glyphicon glyphicon-remove" onclick="return confirm('Padam Rekod?');"></i></button></form>                   	
                                    </td>
                                    </tr>
                                        <?php 
											$x++; } 
										?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            
 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            
                                            <h4 class="modal-title" id="myModalLabel">BORANG KEAHLIAN KARIAH</h4>
                                        </div>
                                        <div class="modal-body">
                                            
                                            <div class="row">
							                <div class="col-lg-12">
							                    <div class="panel panel-info">
							                       <!--  <div class="panel-heading">
							                            MAKLUMAT PERIBADI
							                        </div> -->
							                        <div class="panel-body">
                                                    
							     <form method="post" id="insert_form">
                                   <?php 
                          include("connection/connection.php");
						  
						  $sql_search="SELECT id_data,nama_penuh,no_ic,umur,alamat_terkini FROM sej6x_data_peribadi"; 
	                      $result = mysql_query($sql_search) or die ("Error :".mysql_error());  ?>          

                                                        <div class="row">
							                            	<h4 align="center"><u>Maklumat Ahli</u></h4>
							                                <div class="col-lg-4">
							                                        <div class="form-group">
							                                            <label style="color: red">*</label><b>Nama Penuh</b>
							                                            <input class="form-control" name="nama_penuh" id="nama_penuh" requiredX>
							                                        </div>
							                                        <div class="form-group">
							                                            <label style="color: red">*</label><b>No. K/P</b>
							                                            <input class="form-control" name="no_ic" id="no_ic" placeholder="Contoh: 880528355036" requiredX>	
							                                        </div>
                                                                     <div class="form-group">
                                                                     	<label style="color: red">*</label><b>No Telefon</b>
							                                            <input class="form-control" name="no_hp" id="no_hp" placeholder="Contoh: 0143159891" requiredX>
							                                        </div>
							                                        <div class="form-group">
							                                            <label style="color: red">*</label><b>Umur</b>
							                                            <input class="form-control" name="umur" id="umur" requiredX>
							                                        </div>
                                                                     <div class="form-group">
                                                                     	<label style="color: red">*</label><b>Tarikh Lahir</b>
							                                            <input class="form-control" name="tarikh_lahir" id="tarikh_lahir" placeholder="Contoh: 1992-05-30" type="date" requiredX>	
							                                        </div>
                                              						 <div class="form-group">
							                 					     <label style="color: red">*</label><b>Jantina</b>
							                   	<select class="form-control" name="jantina" id="jantina">
							                 			  <option value="0">Sila Pilih</option>							
							                              <option value="1">Lelaki</option>
                                                          <option value="2">Perempuan</option>
							                                            </select>
							                                        </div>
							                                </div>
							                                <!-- /.col-lg-4 (nested) -->



							                                <div class="col-lg-4">	

															 <div class="form-group">
							                                            <label style="color: red">*</label><b>Bangsa</b>
							                                            <select class="form-control" name="bangsa" id="bangsa">
							                                                <option value="0">Sila Pilih</option>
							                                                <option value="1">Melayu</option>
							                                                <option value="2">Cina</option>
							                                                <option value="3">India</option>
							                                                <option value="4">Lain-lain</option>
							                                            </select>
							                                        </div>
																
                                                            <div class="form-group">
							                 				<label style="color: red">*</label><b>Warganegara</b>
							                   				<select class="form-control" name="warganegara" id="warganegara">
							                 			  <option value="0">Sila Pilih</option>							
							                              <option value="1">Warganegara</option>
                                                          <option value="2">Bukan Warganegara</option>
							                                            </select>
							                                        </div>
                                                                    
							                                        <div class="form-group">
							                                            <label style="color: red">*</label><b>Status Perkahwinan</b>
							                                            <select class="form-control" name="status_perkahwinan" id="status_perkahwinan" requiredX>
							                                                <option value="0">Sila Pilih</option>
							                                                <option value="1">Bujang</option>
							                                                <option value="2">Berkahwin</option>
							                                                <option value="3">Duda</option>
							                                                <option value="4">Janda</option>
							                                            </select>
							                                        </div>
                                                                    
							                                        <div class="form-group">
							                                            <label style="color: red">*</label><b>Pekerjaan</b>
							  <input class="form-control" name="pekerjaan" id="pekerjaan">	                  
							                                        </div> 
                                                                    
                                                                     <div class="form-group">
							                                            <label style="color: red">*</label><b>Tempoh Tinggal di Kariah</b>
							  <input class="form-control" name="tempoh_tinggal" id="tempoh_tinggal">	                  
							                                        </div> 
							                                        
																	<label style="color: red">*</label><b>Zon Kariah</b>
		 <select class="form-control" name="zon_qariah" id="zon_qariah" requiredx>
                                        <?php echo $options5;?> <?php echo $pilihanzon;?>
                                      </select>
							                                       

							                                </div>
							                                <!-- /.col-lg-4 (nested) -->

							                            <div class="row">
							                                <div class="col-lg-4">
							                                	    <div class="form-group">
							                                	    	<label style="color: red">*</label><b>No Rumah (Alamat Terkini)</b>
							                                            
							                                            <input class="form-control" placeholder="Contoh: 1842-2 Kampung Selamat" name="alamat_terkini" id="alamat_terkini">
							                                        </div>

							                                        <div class="form-group">
                                      <label style="color: red">*</label><b>Negeri</b>
                             <select class="form-control" name="id_negeri" id="id_negeri" requiredx>
                                        <?php echo $options1;?> <?php echo $options;?>
                                      </select>
                                    </div>		

							                                        <div class="form-group">
                                      <label style="color: red">*</label><b>Daerah</b>
                                       <select class="form-control" name="id_daerah" id="id_daerah" required>
                                        <?php echo $options3;?><?php echo $options4;?>
                                      </select>
                                    </div>


							                                        <div class="form-group">
							          <label style="color: red">*</label><b>Poskod</b>
							          <input class="form-control" name="poskod" id="poskod">	                  
							                                        </div>
							                                        <br><br>
							                                 Sila isi semua maklumat yang bertanda <label style="color: red">*</label>
							                                </div>
							                                <!-- /.col-lg-4 (nested) -->
							                            </div>

							                                 
							                            </div>
							                            <!-- /.row (nested) -->


							                            <div class="row">
							                        	<h4 align="center"><u>Catatan Masjid</u></h4>
							                                
							                                <div class="col-lg-4">
							                                    <div class="form-group">
							                                            <label style="color: red">*</label><b>Warga Emas</b>
							              <select class="form-control" name="warga_emas" id="warga_emas" requiredx>

							                                                <option value="0">Sila Pilih</option>
							                                                <option value="1">Ya</option>
							                                                <option value="2">Tidak</option>
							                                            </select>	            
							                                        </div>
							                                </div>
							                                <!-- /.col-lg-4 (nested) -->

							                                <div class="col-lg-4">	

							                                        <div class="form-group">
							                                           <label style="color: red">*</label><b>Wajib Solat Jumaat</b>
							                                            <select class="form-control" name="solat_jumaat" id="solat_jumaat" requiredX>
							                                                <option value="0">Sila Pilih</option>
							                                                <option value="1">Ya</option>
							                                                <option value="2">Tidak</option>
							                                            </select>	            
							                                        </div>
							                                </div>
							                                <!-- /.col-lg-4 (nested) -->
                                                             <div class="row">
                                                              <div class="col-lg-4">	

							       <input type="hidden" name="id_masjid" id="id_masjid" value="3857" />	
                                   <input type="button" name="insert" id="insert" value="Simpan" class="btn btn-success" />            
							                                        </div>
							                                </div>
							                                <!-- /.col-lg-4 (nested) -->

                                                </div>
                                               </form>

                                                <div class="modal-footer">
                                          
                         <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
                                            
                                        </div>


                                           </div>
                                           
                                    <!-- /.modal-content -->
                                   </div>
                                <!-- /.modal-dialog -->
 
                                       
                                        

                         

                         
<script>  
$(document).ready(function(){
	$('#insert').on("click", function(event){
		if($('#nama_penuh').val() == "")  
	  {  
		alert("Nama tidak dimasukkan!");  
	  }  
	   if($('#no_ic').val() == "")  
	  {  
		alert("No.IC tidak dimasukkan!");  
	  }  
	   if($('#no_hp').val() == "")  
	  {  
		alert("No.Telefon tidak dimasukkan!");  
	  }  
	     if($('#umur').val() == "")  
	  {  
		alert("Umur tidak dimasukkan!");  
	  }
	   if($('#tarikh_lahir').val() == "")  
	  {  
		alert("Tarikh Lahir tidak dimasukkan!");  
	  } 
	   if($('#umur').val() == "")  
	  {  
		alert("Umur tidak dimasukkan!");  
	  } 
	     if($('#jantina').val() == "")  
	  {  
		alert("Jantina tidak dimasukkan!");  
	  }
	   if($('#bangasa').val() == "")  
	  {  
		alert("Bangsa tidak dimasukkan!");  
	  }  
	    if($('#warganegara').val() == "")  
	  {  
		alert("Warganegara tidak dimasukkan!");  
	  } 
	   if($('#status_perkahwinan').val() == "")  
	  {  
		alert("Status perkahwinan tidak dimasukkan!");  
	  } 
	   if($('#pekerjaan').val() == "")  
	  {  
		alert("Pekerjaan tidak dimasukkan!");  
	  }  
	   if($('#tempoh_tinggal').val() == "")  
	  {  
		alert("Tempoh Tinggal tidak dimasukkan!");  
	  }
	   if($('#zon_qariah').val() == "")  
	  {  
		alert("Zon kariah tidak dimasukkan!");  
	  }  
	   if($('#alamat_penuh').val() == "")  
	  {  
		alert("Alamat tidak dimasukkan!");  
	  }
	   if($('#id_negeri').val() == "")  
	  {  
		alert("Negeri tidak dimasukkan!");  
	  } 
	   if($('#id_daerah').val() == "")  
	  {  
		alert("Daerah tidak dimasukkan!");  
	  } 
	   if($('#Poskod').val() == "")  
	  {  
		alert("Poskod tidak dimasukkan!");  
	  }
	   if($('#warga_emas').val() == "")  
	  {  
		alert("Status Warga Emas tidak dimasukkan!");  
	  } 
	   if($('#solat_jumaat').val() == "")  
	  {  
		alert("Status solat Jumaat tidak dimasukkan!");  
	  }    
	  else  
	  {  
		  $.ajax({  
			url:"pendaftaran/add_daftarqariah.php",  
			method:"POST",  
			data:$('#insert_form').serialize(),  
			beforeSend:function(){  
			 $('#insert').val("Simpan");  
			},  
			success:function(data){  
			 $('#insert_form')[0].reset();  
			 $('#myModal').modal('hide');  
			}  
		   }); 
	  }  
	});
 

});  
 </script>                                                               
                                
</div>
            <!-- /.row -->                       