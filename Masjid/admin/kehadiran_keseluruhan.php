<?php

?>
<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Menu Kehadiran Pegawai Masjid</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li class="active">Menu Kehadiran</li>
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
					Rekod Kehadiran
					<!-- <button onclick="//myFunction()" class="btn btn-success">Cetak</button> -->
					<script>
					function myFunction() {
					window.print();
					}
					</script>
				</div>
				<div class="card-body">
					<div class="table-responsive">
					<?php 
						include("connection/connection.php");
				  
						$sql_search="SELECT a.id_datapegawai 'id', a.id_fingerprint 'fingerprint' ,a.jawatan 'jawatan', b.nama_penuh 'nama' FROM data_pegawai_masjid a, sej6x_data_peribadi b WHERE a.id_masjid='$id_masjid' AND a.id_pegawai=b.id_data 
									UNION SELECT c.id_datapegawai 'id', c.id_fingerprint 'fingerprint', c.jawatan 'jawatan', d.nama_penuh 'nama' FROM data_pegawai_masjid c, sej6x_data_anakqariah d WHERE c.id_masjid='$id_masjid' AND c.id_pegawai2=d.ID 
									 UNION SELECT e.id_datapegawai 'id', e.id_fingerprint 'fingerprint', e.jawatan 'jawatan', e.nama_penuh 'nama' FROM data_pegawai_masjid e WHERE e.id_masjid='$id_masjid' AND e.id_pegawai IS NULL AND e.id_pegawai2 IS NULL
									 ORDER BY fingerprint ASC";

				  
						$result = mysqli_query($bd2,$sql_search) or die ("Error :".mysqli_error());
					?>  
						 <table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr>
									<th><div align="center">Bil</div></th>
									<th><div align="center">Nama </div></th>
									<th><div align="center">ID Finger Print</div></th>
									<th><div align="center">Jawatan</div></th>
									<th><div align="center">Tindakan</div></th>
								</tr>
							</thead>
							<tbody>
							<?php 
							$x=1;
							while($row = mysqli_fetch_assoc($result))
							{
							    $id_pegawai = $row['id'];
							?>
								<tr>
									<td><div align="center"><?php echo $x; ?></div></td>
									<td><?php echo $row['nama']; ?></td>
									<td>
                                        <div align="center">
                                            <?php if($row['fingerprint']!=NULL){ ?>
                                            <button class="btn btn-outline-warning" data-toggle="modal" data-target="#modalEditFinger" onClick="editFinger(this.value)" value="<?php echo $row['id']; ?>"><i class="fas fa-fingerprint"></i>&nbsp;<?php echo $row['fingerprint']; ?></button>
                                            <?php } else if($row['fingerprint']==NULL){ ?>
                                                <button class="btn btn-outline-success" data-toggle="modal" data-target="#modalAddFinger" onClick="addFinger(this.value)" value="<?php echo $row['id']; ?>"><i class="fas fa-fingerprint"></i>&nbsp;<i class="fas fa-plus"></i></button>
                                            <?php } ?>
                                        </div>
                                    </td>
									<td><div align="center"><?php echo $row['jawatan']; ?></div></td>
									<td>
										<div align="center">
											<a href="utama.php?view=admin&action=kehadiranterperinci&id_pegawai=<?php echo $row['id'];?>">
												<button type="button" class="form-control" title="Lihat">
													<i class="fas fa-search" ></i>
												</button>
											</a>
											<!-- <a href="utama.php?view=admin&action=jadualterperinci&id_pegawai=<?php //echo $row['id'];?>">
												<button type="button" class="form-control" title="Jadual">
													<i class="fas fa-calendar" ></i>&nbsp;Jadual Bertugas
												</button>
											</a> -->
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
					<!-- /.table-responsive -->
				</div>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
    </div>
</div>
<div class="modal fade" id="modalEditFinger" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scrollmodalLabel">Kemaskini ID Fingerprint</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="div_editfingerprint">

                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalAddFinger" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scrollmodalLabel">ID Fingerprint</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="div_fingerprint">

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function addFinger(str){
        if (str == "") {
            document.getElementById("div_fingerprint").innerHTML = "";
            return;
        }
        else {
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            }
            else {
                // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("div_fingerprint").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET","admin/getfingerprint.php?id_pegawai="+str,true);
            xmlhttp.send();
        }
    }
    function editFinger(str){
        if (str == "") {
            document.getElementById("div_editfingerprint").innerHTML = "";
            return;
        }
        else {
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            }
            else {
                // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("div_editfingerprint").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET","admin/geteditfingerprint.php?id_pegawai="+str,true);
            xmlhttp.send();
        }
    }
</script>
