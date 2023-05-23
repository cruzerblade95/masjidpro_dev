<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Rumah Ibadat</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li><a href="utama.php?view=admin&action=komuniti">Menu Komuniti</a></li>
					<li class="active">Rumah Ibadat</li>
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
					Senarai Rumah Ibadat &nbsp;&nbsp;
					<button class="btn btn-info" type="button" data-toggle="modal" data-target="#myModal">Tambah Rumah Ibadat </button>&nbsp;&nbsp;<button class="btn btn-info" onclick="history.go(-1);">Kembali </button>                   
				</div>
				<div class="card-body">
					<div class="table-responsive">
					<?php 
				  
					include("connection/connection.php");
				  
					$sql_search="SELECT id,nama_pengurus,no_tel,bil_anggota,nama_rumahibadat FROM sej6x_data_rumahibadat WHERE id_masjid='$id_masjid'"; 
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
									<th><div align="center">Nama Rumah Ibadat</div></th>
									<th><div align="center">Pengurus</div></th>
									<th><div align="center">No Telefon Pengurus</div></th>
									<th><div align="center">Bilangan Anggota Rumah Ibadat</div></th>
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
									<td><div align="center"><?php echo $row['nama_rumahibadat']; ?></div></td>
									<td><div align="center"><?php echo $row['nama_pengurus']; ?></div></td>
									<td class="center"><div align="center"><?php echo $row['no_tel']; ?></div></td>
									<td class="center"><div align="center"><?php echo $row['bil_anggota']; ?></div></td>
									<td>
										<div align="center">
											<a href="utama.php?view=admin&action=semak_rumahibadat&id=<?php echo $row['id'];?>">
												<button type="btn btn-info" class="btn btn-warning btn-circle" data-placement="right" title="Edit"><i class="fa fa-pencil"></i></button>
											</a>
											<form name="delete" method="POST" action="admin/del_rumahibadat.php">
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
<!-- /#page-wrapper -->
      
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">DAFTAR RUMAH IBADAT BARU</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-info">
							<div class="panel-body">
								<form method="post" id="insert_form" action="admin/add_rumahibadat.php">
									<div class="row">
										<div class="col-lg-12">
											<h4 align="center"><u>Maklumat Rumah Ibadat</u></h4>
										</div>
									</div>
									<hr>
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label>Nama Rumah Ibadat</label>
												<input class="form-control" name="nama_rumahibadat" id="nama_rumahibadat" required />
											</div>
											<div class="form-group">
												<label>Nama Pengurus</label>
												<input class="form-control" name="nama_pengurus" id="nama_pengurus" required />
											</div>
											<div class="form-group">
												<label>No Telefon Pengurus</label>
												<input class="form-control" name="no_tel" id="no_tel" required />
											</div>
											<div class="form-group">
												<label>Bilangan Ahli</label>
												<input class="form-control" name="bil_anggota" id="bil_anggota" required />
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label>Alamat Rumah Ibadat</label>
												<input class="form-control" placeholder="Contoh: 1842-2 Kampung Selamat" name="alamat" id="alamat"/>
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
												<input class="form-control" id="poskod" name="poskod" />
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12">
											<center>
												<div class="form-group">
													<input type="hidden" name="id_masjid" id="id_masjid" value="<?php echo $id_masjid; ?>" />
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
</script>
<script>
    jQuery(document).ready(function () {
        meja_akaun('#meja_akaun2', 'Senarai Rumah Ibadat', [ 0, 1, 2, 3, 4 ]);
    });
</script>
                       