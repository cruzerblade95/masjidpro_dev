<?php 

include("connection/connection.php");

$sql_search="SELECT * FROM sej6x_data_bantuan WHERE id_masjid='$id_masjid' ORDER BY tarikh_mohon ASC"; 
$result = mysqli_query($bd2, $sql_search) or die ("Error :".mysqli_error($bd2));
$row=mysqli_num_rows($result);
?>
<!--script src="js/jquery-3.4.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script-->

<script>
$(document).ready(function() {
    $('#table_display').DataTable();
} );
</script>
<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Kelulusan Bantuan</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li class="active">Kelulusan Bantuan</li>
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
                            Maklumat Bantuan&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                        </div>
                        <div class="card-body">
							<div class="table-responsive">
       	                        <table id="meja_akaun" width="100%" data-order="[]" class="table table-bordered table-hover display nowrap margin-top-10 w-p100 table-striped">
									<thead>
                                        <tr>
                                            <th width="5%"><div align="center">No</div></th>
                                            <th><div align="center">Nama</div></th>
											<th><div align="center">Jenis Bantuan</div></th>
                                            <th><div align="center">Tujuan</div></th>
											<th><div align="center">Amaun(RM)</div></th>
											<th><div align="center">Status/Tarikh Tamat</div></th>
											<th><div align="center">Info Bank</div></th>
                                            <th><div align="center">Tindakan</div></th> 
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php 
									if($row==0)
									{
									?>
										<tr>
											<td colspan="8" align="center">*Tiada Rekod*</td>
										</tr>
									<?php
									}
									else if($row>0)
									{
										$x=1; 
										while($row = mysqli_fetch_assoc($result))
										{ 
									?>
                                        <tr>
                                            <td align="center"><?php echo $x; ?></td>
                                            <td align="center">
												<?php
												$id_data=$row['id_data'];
												
												$sql="SELECT * FROM sej6x_data_peribadi WHERE id_data='$id_data'";
												$sqlquery=mysqli_query($bd2, $sql);
												$data=mysqli_fetch_array($sqlquery);
												echo $data['nama_penuh'];
												?>
											</td>
                                            <td align="center"><?php echo $row['jenis_bantuan']; ?></td>
                                            <td align="center"><?php echo $row['tujuan']; ?></td>
											<td align="center"><?php echo $row['amaun']; ?></td>
											<td align="center">
											<?php 
											if($row['status_bantuan']==1)
											{
											?>
											<button type="button" class="btn btn-success" disabled>Bantuan Diluluskan</button>
											<?php
											}
											else if($row['status_bantuan']==2)
											{
											?>
											<button type="button" class="btn btn-danger" disabled>Bantuan Ditolak</button>
											<?php
											}
											else if($row['status_bantuan'] == NULL || $row['status_bantuan'] == "")
											{
											?>
											<button type="button" class="btn btn-warning" disabled>Masih Menunggu Kelulusan</button>
											<?php
											}
											?>
											</td>
											<td align="center">
												<button type="button" class="btn btn-info" title="Lihat Maklumat Bank" data-toggle="modal" data-target="#table_bank" value="<?php echo $row['id_bantuan']; ?>" onClick="showBank(this.value)"><i class="fa fa-info-circle"></i></button>
											</td>
											<td align="center">
                                                <button class="btn btn-danger" type="button" onclick="showSebab(<?php echo $row['id_bantuan']; ?>, '<?php echo($data['nama_penuh']); ?>', '<?php echo($row['status_bantuan']); ?>', '<?php echo($row['sebab_lain']); ?>', '<?php echo($row['tarikh_tamat']); ?>')">Respon</button>
											</td>
										</tr>
                                    <?php 
										$x++; 
										} 
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
                <!-- /.col-lg-12 -->
	</div>
</div>
		<div class="modal fade" id="table_bank" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="myModalLabel">MAKLUMAT BANK</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
                    <?php
					include("connection/connection.php");

					$sql_search="SELECT id_data,nama_penuh,no_ic,umur,alamat_terkini FROM sej6x_data_peribadi WHERE id_masjid='$id_masjid'"; 
					$result = mysqli_query($bd2, $sql_search) or die ("Error :".mysqli_error($bd2));
					?> 
					<div class="modal-body">
						<div class="row">
							<div class="col-lg-12">
								<center><h4><u>Maklumat Bank</u></h4></center>
							</div>
						</div>	
						<hr>
						<div id="display_bank">
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Kembali</button>
						</div>
						</div>
						<!-- /.row -->
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- modal-dialog modal-lg -->
		</div>
		<!-- modal fade -->
<script>
function showBank(str) {
	if (str == "") {
	document.getElementById("display_bank").innerHTML = "";
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
			document.getElementById("display_bank").innerHTML = this.responseText;
			}
		};
		xmlhttp.open("GET","admin/getbank.php?id_bantuan="+str,true);
		xmlhttp.send();
	}
}
</script>