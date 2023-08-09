<?php
                include("connection/connection.php");

				 if(isset($_POST['search']))
	 			 {
				 $daripada = $_POST['daripada'];
				 $hingga = $_POST['hingga'];

				}
				?>
<?php
if($_GET['action']=="maklumatinventori")
{
?>
<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Laporan Inventori</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
                    <li><a href="utama.php?view=admin&action=dashboard_selenggara">Menu Selenggara</a></li>
					<li class="active">Laporan Inventori</li>
				</ol>
			</div>
		</div>
	</div>
</div>
<?php
}
?>
<!-- div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Carian &nbsp;&nbsp;
                            <button  class="btn btn-info" onclick="history.go(-1);">Kembali </button></div>

                        <div class="panel-body">
                        <div class="row">
                            <form id="form1" name="form1" method="POST" action="<?php //echo $PHP_SELF;?>">

                            <div class="col-lg-3">
                              <div class="form-group">
                                <label>Daripada</label>
                                        <input class="form-control" name="daripada" id="daripada" type="date" required>
                              </div>
                                </div>

                              <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Hingga</label>
                                            <input class="form-control" name="hingga" id="hingga" type="date" required>
                                        </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="form-group">
                                            <br>
                                            <input type="submit" name="search" value="Carian" class="btn btn-primary"></input>

                                    </div>
                                     <input type="hidden" name="carisearch" value="1" />
                                </div>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
            </div -->
<div class="content mt-3">
    <div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					Maklumat Inventori
                    <?php
                    if($_GET['action']=="maklumatinventori")
                    {
                    ?>
					&nbsp;&nbsp;<a href="utama.php?view=admin&action=inventori" class="btn btn-primary">Tambah Inventori</a>
                    <?php
                    }
                    ?>
					<!-- <button onclick="myFunction()" class="btn btn-primary">Cetak</button>
					<script>
					function myFunction() {
					window.print();
					}
					</script> -->
				</div>
				<div class="card-body">
                    <?php

                    include("connection/connection.php");

                    $sql_search="SELECT a.id_inventori, a.nama_peralatan, a.tarikh_belian, c.nama_penuh as nama_pegawai, a.kuantiti_belian, a.kuantiti_unit, a.lokasi, e.status_kerosakan as status 
                                 FROM sej6x_data_inventori a 
                                 LEFT JOIN data_ajkmasjid b ON a.id_pegawai = b.id_dataajk 
                                 LEFT JOIN sej6x_data_peribadi c ON b.id_ajk = c.id_data 
                                 LEFT JOIN sej6x_data_kerosakkan d ON a.id_inventori = d.id_peralatan 
                                 LEFT JOIN sej6x_data_statuskerosakan e ON d.id_statuskerosakan = e.id_status 
                                 WHERE a.id_masjid = $id_masjid";
                    $result = mysqli_query($bd2,$sql_search) or die ("Error :".mysqli_error($bd2));

                    ?>
                    <div class="table-responsive">
                        <table id="meja_akaun3" width="100%" data-order="[]" class="table table-bordered table-hover display nowrap margin-top-10 w-p100 table-striped">
							<thead>
								<tr>
									<th><div align="center">Bil</div></th>
									<th><div align="center">Nama Peralatan</div></th>
									<th><div align="center">Tarikh Belian</div></th>
                                    <th><div align="center">Nama Pegawai</div></th>
									<th><div align="center">Kuantiti Semasa & Unit</div></th>
									<th><div align="center">Tempat / Lokasi (Simpan)</div></th>
									<th><div align="center">Status Peralatan</div></th>
                                    <th><div align="center"></div></th>
								</tr>
							</thead>
                            <tbody>
							<?php
							$x=1;
							while($row = mysqli_fetch_assoc($result))
							{
							?>
                                <tr>
									<td><div align="center"><?php echo $x; ?></div></td>
									<td><div align="center"><?php echo $row['nama_peralatan']; ?></div></td>
                                    <td><div align="center"><?php echo $row['tarikh_belian']; ?></div></td>
									<td><div align="center"><?php echo $row['nama_pegawai']; ?></div></td>
									<td><div align="center"><?php echo $row['kuantiti_belian']; ?>&nbsp;<?php echo $row['kuantiti_unit']; ?></div></td>
									<td><div align="center"><?php echo $row['lokasi']; ?></div></td>
									<td><div align="center"><?php echo $row['status'] ?></div></td>
									<td>
										<div align="center">
											<form action="admin/del_inventori.php" method="POST">
											<a href="utama.php?view=admin&action=view_inventori&id_inventori=<?php echo $row['id_inventori'];?>&sideMenu=masjid">
												<button type="button" class="btn btn-info btn-circle" data-toggle="tooltip" data-placement="right" title="Lihat">
													<i class="fa fa-search"></i>
												</button>
											</a>
											<a href="utama.php?view=admin&action=edit_inventori&id_inventori=<?php echo $row['id_inventori'];?>&sideMenu=masjid">
												<button type="button" class="btn btn-warning btn-circle" data-toggle="tooltip" data-placement="right" title="Kemaskini">
													<i class="fas fa-edit"></i>
												</button>
											</a>
											<!-- <form name="delete" method="POST" action="admin/del_inventori.php"> -->
												<input type="hidden" name="id_inventori" value="<?php echo $row['id_inventori']; ?>">
												<input type="hidden" name="no_rujukan" value="<?php echo $row['kod_peralatan']; ?>">
												<input type="hidden" name="id_masjid" value="<?php echo $id_masjid; ?>">
												<button type="submit" name="delete" id="delete" class="btn btn-danger" title="Padam"><i class="far fa-trash-alt" onclick="return confirm('Padam Rekod?');"></i></button>
											<!-- </form> -->
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
                    <!-- /.table-responsive -->
                </div>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>
<script>
    jQuery(document).ready(function () {
        meja_akaun('#meja_akaun3', 'Senarai Inventori', [ 0, 1, 2, 3, 4, 5, 6 ]);
    });
</script>