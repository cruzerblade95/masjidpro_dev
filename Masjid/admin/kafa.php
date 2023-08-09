<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Kafa</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li><a href="utama.php?view=admin&action=komuniti">Menu Komuniti</a></li>
					<li class="active">Kafa</li>
				</ol>
			</div>
		</div>
	</div>
</div>
<div class="content mt-3">
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					Senarai KAFA &nbsp;&nbsp;&nbsp;&nbsp;
					<button class="btn btn-info" type="button" data-toggle="modal" data-target="#myModal">Tambah KAFA </button> &nbsp;&nbsp;
					<button  class="btn btn-info" onclick="history.go(-1);">Kembali </button>                  
				</div>
				<div class="card-body">
					<div class="table-responsive">
					  <?php 
					  include("connection/connection.php");
					  
					  $sql_search="SELECT id,nama_pengurus,no_tel,bil_pelajar,nama_kafa 
					  FROM sej6x_data_kafa WHERE id_masjid='$id_masjid'"; 
					  $result = mysql_query($sql_search) or die ("Error :".mysql_error());
					  
					  //untuk sql negeri
					  $sql_negeri="SELECT id_negeri,name FROM negeri"; 
					  $result1 = mysql_query($sql_negeri) or die ("Error :".mysql_error());
						
					  $options1 = $options1."<option>Sila Pilih Negeri</option>";  
					  while($row1=mysql_fetch_array($result1))
					  {
					  $options=$options."<option value='$row1[id_negeri]'>$row1[name]</option>";
					  }
					  ?>              
					  <table id="meja_akaun2" width="100%" data-order="[]" class="table table-bordered table-hover display nowrap margin-top-10 w-p100 table-striped">
						<thead>
						  <tr>
							<th><div align="center">No.</div></th>
							<th><div align="center">Nama Kafa</div></th>
							<th><div align="center">Pengurus</div></th>
							<th><div align="center">No Telefon Pengurus</div></th>
							<th><div align="center">Bilangan Pelajar</div></th>
							<th><div align="center">Tindakan</div></th>
						  </tr>
						</thead>
						<tbody>
						<?php 
						$x=1; 
						while($row = mysql_fetch_assoc($result)){ 
						?>
							<tr>
								<td><div align="center"><?php echo $x; ?></div></td>
								<td><?php echo $row['nama_kafa']; ?></td>
								<td><div align="center"><?php echo $row['nama_pengurus']; ?></div></td>
								<td class="center"><div align="center"><?php echo $row['no_tel']; ?></div></td>
								<td class="center"><div align="center"><?php echo $row['bil_pelajar']; ?></div></td>
								<td><div align="center">
										<a href="utama.php?view=admin&action=semak_kafa&id=<?php echo $row['id'];?>">
											<button type="btn btn-info" class="btn btn-warning btn-circle" data-placement="right" title="Edit"><i class="fa fa-pencil"></i></button>
										</a>
										<form name="delete" method="POST" action="admin/del_kafa.php">
											<input type="hidden" name="del" id="del" value="<?php echo $row['id']; ?>">
											<button type="submit" name="delete" id="delete" class="btn btn-danger btn-circle" data-toggle="tooltip" data-placement="right" title="Padam" onclick="return confirm('Padam rekod?')"><i class="fa fa-times"></i></button>
										</form>
									</div>
							  </td>
						  </tr>
						<?php 
						$x++;
						}
						?>
						</tbody>
					  </table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
      
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">DAFTAR KAFA BARU</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-info">
							<div class="panel-body">
								<form method="post" id="insert_form" action="admin/add_kafa.php">
								<div class="row">
									<div class="col-lg-12">
										<h4 align="center"><u>Maklumat Kafa</u></h4>
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
										  <label>Nama KAFA</label>
										  <input class="form-control" name="nama_kafa" id="nama_kafa" required />
										</div>
										<div class="form-group">
										  <label>Nama Pengurus</label>
										  <input class="form-control" name="nama_pengurus" id="nama_pengurus" required />
										</div>
										<div class="form-group">
										  <label>No Telefon Pengurus</label>
										  <input class="form-control" name="no_tel" id="no_tel" placeholder="Contoh: 0122345678" required />
										</div>
										<div class="form-group">
										  <label>Bilangan Pelajar</label>
										  <input class="form-control" name="bil_pelajar" id="bil_pelajar" required />
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
										  <label>Alamat KAFA</label>
										  <input class="form-control" placeholder="Contoh: 1842-2 Kampung Selamat" name="alamat" id="alamat" required />
										</div>
										<div class="form-group">
											<label>Negeri</label>
											<select class="form-control" name="negeri" id="negeri" onChange="showDaerah(this.value)" required>
												<?php echo $options1;?> <?php echo $options;?>
											</select>
										</div>
										<div class="form-group" id="daerah">
                                        </div>
										<div class="form-group">
										  <label>Poskod</label>
										  <input class="form-control" id="poskod" name="poskod" required />
										</div>
									</div>
									<div class="col-lg-12">
										<center>
											<div class="form-group">
											   <input type="hidden" name="id_masjid" id="id_masjid" value="<?php echo $id_masjid;?>" />
											  <input type="submit" name="insert" id="insert" value="Simpan" class="btn btn-success" />
											</div>
										</center>
									</div>
								</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
			</div>
		</div>
    </div>
</div>
  
<script>  
function showDaerah(str) {
    if (str == "") {
        document.getElementById("daerah").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("daerah").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","admin/getdaerah.php?negeri="+str,true);
        xmlhttp.send();
    }
}

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
	    if($('#bil_pelajar').val() == "")  
	  {  
		alert("Bilangan Pelajar tidak dimasukan");  
	  }   
	    if($('#nama_kafa').val() == "")  
	  {  
		alert("Nama Kafa tidak dimasukan");  
	  }  
	    if($('#alamat').val() == "")  
	  {  
		alert("Alamat tidak dimasukan");  
	  }  
	    if($('#negeri').val() == "")  
	  {  
		alert("Negeri tidak dimasukan");  
	  }  
	    if($('#id_daerah').val() == "")  
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
      url:"admin/add_kafa.php",  
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
<script>
    jQuery(document).ready(function () {
        meja_akaun('#meja_akaun2', 'Senarai KAFA', [ 0, 1, 2, 3, 4 ]);
    });
</script>
                                
                       