<?php
include("connection/connection.php");
$query_list_mesyuarat = "SELECT minit_mesyuarat.id_mesyuarat, minit_mesyuarat.tajuk 'Tajuk', minit_mesyuarat.tarikh 'Tarikh', SUM(IF(kehadiran_mesyuarat.jenis_kehadiran != 99, 1, 0)) 'Jumlah Kehadiran' FROM minit_mesyuarat, kehadiran_mesyuarat WHERE minit_mesyuarat.id_masjid = $id_masjid AND minit_mesyuarat.id_mesyuarat = kehadiran_mesyuarat.id_mesyuarat GROUP BY minit_mesyuarat.id_mesyuarat ORDER BY minit_mesyuarat.tarikh DESC, minit_mesyuarat.masa DESC";
$list_mesyuarat = mysqli_query($bd2, $query_list_mesyuarat) or die(mysqli_error($bd2));
?>
<div class="breadcrumbs">
	<div class="col-sm-4">
		<div class="page-header float-left">
			<div class="page-title">
				<h1>Laporan Minit Mesyuarat</h1>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="page-header float-right">
			<div class="page-title">
				<ol class="breadcrumb text-right">
					<li class="active">Laporan Minit Mesyuarat</li>
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
                            Maklumat Laporan
							<script>
							function myFunction() {
   						    window.print();
							}
							</script>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                            
                  
							   
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th><div align="center">No.</div></th>
                                            <th><div align="center">Tajuk Mesyuarat</div></th>
                                            <th><div align="center">Jumlah Kehadiran</div></th>
                                            <th><div align="center">Tarikh</div></th>
                                            <th><div align="center">Simpan</div></th>
                                            <th><div align="center">Tindakkan</div></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i = 1; while($row_list_mesyuarat = mysqli_fetch_assoc($list_mesyuarat)) { ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo($i); ?></td>
                                            <td><?php echo($row_list_mesyuarat['Tajuk']); ?></td>
                                            <td><div align="center"><?php echo($row_list_mesyuarat['Jumlah Kehadiran']); ?></div></td>
                                            <td><div align="center"><?php fungsi_tarikh($row_list_mesyuarat['Tarikh'], 2, 2); ?></div></td>
                                            <td><div align="center"><a href="admin/view_minit_mesyuarat.php?id_mesyuarat=<?php echo($row_list_mesyuarat['id_mesyuarat']); ?>&html=1" target="_blank">[Lihat]</a> | <a href="utama.php?view=admin&action=minitmesyuarat&id_mesyuarat=<?php echo($row_list_mesyuarat['id_mesyuarat']); ?>">[Kemaskini]</a> | <a href="admin/view_minit_mesyuarat.php?id_mesyuarat=<?php echo($row_list_mesyuarat['id_mesyuarat']); ?>" target="_blank">[PDF]</a></div></td>
                                           <td><div align="center">
                 <form name="deletenotis" method="POST" action="admin/del_notis.php">
                 <input type="hidden" name="passdel" id="passdel" value="<?php echo $row_list_mesyuarat['id_mesyuarat']; ?>">
                 <button type="submit" name="delete" id="delete" class="btn btn-danger btn-circle" data-toggle="tooltip" data-placement="right" title="Padam" onclick="return confirm('Padam Surat/Notis ?')"><i class="fa fa-times"></i>
                            					 </button></form>
                                          </div></td>
                                      </tr>
									<?php $i++; } ?>
                                  </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
              </div>
            </div>
</div>