
    <div class="row">
                <div class="col-lg-12">
                    <h1 align="center" class="page-header">PERSATUAN</h1>
                </div>
                <!-- /.col-lg-12 -->
</div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Senarai Persatuan&nbsp;&nbsp;
                            <button class="btn btn-info" type="button" data-toggle="modal" data-target="#myModal">Tambah Persatuan </button>&nbsp;&nbsp;  <button class="btn btn-info" onclick="history.go(-1);">Kembali </button>                 </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                              <?php 
                          include("../connection/connection.php");
						  
						  $sql_search="SELECT id,nama_pengurus,no_tel,bil_anggota,nama_persatuan FROM sej6x_data_persatuan"; 
	                      $result = mysql_query($sql_search) or die ("Error :".mysql_error());
						  
						    //untuk sql negeri
						  $sql_negeri="SELECT id_negeri,name FROM negeri"; 
	                      $result1 = mysql_query($sql_negeri) or die ("Error :".mysql_error());
						    
                          $options1 = $options1."<option>Sila Pilih Negeri</option>";  
                          while($row1=mysql_fetch_array($result1))
						  {
							
                          $options=$options."<option value='$row1[id_negeri]'>$row1[name]</option>";
                          }
						  
						   //untuk sql daerah
						  $sql_daerah="SELECT id_daerah,id_negeri,nama_daerah FROM daerah WHERE id_negeri='9'"; 
	                      $result2=mysql_query($sql_daerah) or die ("Error :".mysql_error());
						    
                          $options3 = $options3."<option>Sila Pilih Daerah</option>";  
                          while($row2=mysql_fetch_array($result2))
						  {
                          $options4=$options4."<option value='$row2[id_daerah]'>$row2[nama_daerah]</option>";
                          } 
						  
						  ?>              
                              <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                  <tr>
                                    <th><div align="center">No.</div></th>
                                    <th><div align="center">Nama Persatuan</div></th>
                                    <th><div align="center">Pengurus</div></th>
                                    <th><div align="center">No Telefon Pengurus</div></th>
                                    <th><div align="center">Bilangan Anggota</div></th>
                                    <th><div align="center">Tindakan</div></th>
                                  </tr>
                                </thead>
                                <tbody>
                              <?php $x=1; ?>
                              <?php while($row = mysql_fetch_assoc($result)){ ?>
                                        <tr class="odd gradeX">
                                  
                                    <td><div align="center"><?php echo $x; ?></div></td>
                                    <td><div align="center"><?php echo $row['nama_persatuan']; ?></div></td>
                                    <td><div align="center"><?php echo $row['nama_pengurus']; ?></div></td>
                                    <td class="center"><div align="center"><?php echo $row['no_tel']; ?></div></td>
                                    <td class="center"><div align="center"><?php echo $row['bil_anggota']; ?></div></td>
                                     <td><a href="utama.php?view=admin&action=semak_persatuan&id=<?php echo $row['id'];?>">
                                       <div align="center">
                                         <button type="btn btn-info" class="btn btn-warning btn-circle" data-placement="right" title="Edit"><i class="fa fa-pencil"></i></button>
                                         
                                       </div>
                                       <form name="delete" method="POST" action="admin/del_persatuan.php">
                                         <div align="center">
                                           <input type="hidden" name="del" id="del" value="<?php echo $row['id']; ?>">
                                           <button type="submit" name="delete" id="delete" class="btn btn-danger btn-circle" data-toggle="tooltip" data-placement="right" title="Padam" onclick="return confirm('Padam rekod?')"><i class="fa fa-times"></i></button>
                                         </div>
                                       </form>
                                      </td>
                                  </tr>
                                   <?php 
										
  $x++;
   }
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
                <!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
      
 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                
  <div class="modal-dialog modal-lg">
  
  <div class="modal-content">
  
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="myModalLabel">DAFTAR PERSATUAN BARU</h4>
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
  
  <div class="row">
  
  <h4 align="center"><u>Maklumat Persatuan</u></h4>
  <div class="col-lg-6">
  
  
    <div class="form-group">
      <label>Nama Pengurus</label>
      <input class="form-control" name="nama_pengurus" id="nama_pengurus" required />
    </div>
    <div class="form-group">
      <label>No Telefon Pengurus</label>
      <input class="form-control" name="no_tel" id="no_tel" required />
    </div>
    <div class="form-group">
      <label>Bilangan Anggota</label>
      <input class="form-control" name="bil_anggota" id="bil_anggota" required />
    </div>
     <div class="form-group">
      <label>Nama Persatuan</label>
      <input class="form-control" name="nama_persatuan" id="nama_persatuan" required />
    </div>
    </div>
    
    <!-- /.col-lg-4 (nested) -->
    <div class="row">
      <div class="col-lg-6">
        <div class="form-group">
          <label>Alamat Persatuan</label>
          <input class="form-control" placeholder="Contoh: 1842-2 Kampung Selamat" name="alamat" id="alamat"/>
        </div>
     <div class="form-group">
          <label>Negeri</label>
         <select class="form-control" name="negeri" id="negeri" requiredx>
                                        <?php echo $options1;?> <?php echo $options;?>
                                      </select>
        </div>
        <div class="form-group">
          <label>Daerah</label>
           <select class="form-control" name="daerah" id="daerah" required>
                                        <?php echo $options3;?><?php echo $options4;?>
                                      </select>
        </div>
        <div class="form-group">
          <label>Poskod</label>
          <input class="form-control" id="poskod" name="poskod" />
        </div>
        
        <div class="form-group">
           <input type="hidden" name="id_masjid" id="id_masjid" value="3857" />
          <input type="button" name="insert" id="insert" value="Simpan" class="btn btn-success" />
        </div>

      </div>
      <!-- /.col-lg-4 (nested) -->

                
    </div>
    </div>
     </form>
    <!-- /.row (nested) -->
    </div>
    
    <!-- /.panel-body -->
    </div>
    
    <!-- /.panel -->
    </div>
    
    <!-- /.col-lg-12 -->
    </div>
      
    <!-- /.row -->
    </div>
    
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>

    </div>
    </div>
    
    <!-- /.modal-content -->
    </div>
    
    <!-- /.modal-dialog -->
    </div>
 

  
<script>  
$(document).ready(function(){
 
	$('#insert').on("click", function(event){
		if($('#nama_pengurus').val() == "")  
	  {  
		alert("Nama Pengurus tidak dimasukan");  
	  }  
	    if($('#no_tel').val() == "")  
	  {  
		alert("No.Telefon tidak dimasukan");  
	  }  
	    if($('#bil_anggota').val() == "")  
	  {  
		alert("Bilangan Anggota tidak dimasukan");  
	  }  
	    if($('#nama_persatuan').val() == "")  
	  {  
		alert("Nama Persatuan tidak dimasukan");  
	  }  
	    if($('#alamat').val() == "")  
	  {  
		alert("Alamat tidak dimasukan");  
	  }  
	    if($('#negeri').val() == "")  
	  {  
		alert("Negeri tidak dimasukan");  
	  }  
	    if($('#daerah').val() == "")  
	  {  
		alert("Daerah tidak dimasukan");  
	  }  
	    if($('#poskod').val() == "")  
	  {  
		alert("Poskod tidak dimasukan");  
	  }  
	   
	  else  
	  {  
		  $.ajax({  
			url:"admin/add_persatuan.php",  
			method:"POST",  
			data:$('#insert_form').serialize(),  
			beforeSend:function(){  
			 $('#insert').val("Masuk");  
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
                                
                       