<?php
$id_masjid = $_SESSION['id_masjid'];

$sql_search="SELECT id_booking, id_user, id_masjid, id_produk, id_room, check_in, check_out, status_bayaran, status_checkout
FROM beradu_booking WHERE id_masjid='$id_masjid' ORDER BY check_in DESC";
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
                <h1>Urus Tempahan</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li class="active">Urus Tempahan</li>
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
                    Maklumat Tempahan&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="manage_booking" width="100%" style="overflow-x:auto;" data-order="[]" class="table table-bordered table-hover display nowrap margin-top-10 w-p100 table-striped">
                            <thead>
                            <tr>
                                <th width="5%"><div align="center">No</div></th>
                                <th><div align="center">ID Tempahan </div></th>
                                <th><div align="center">ID Pengguna</div></th>
                                <th><div align="center">ID Penginapan</div></th>
                                <th><div align="center">ID Bilik</div></th>
                                <th><div align="center">Tarikh Daftar Masuk</div></th>
                                <th><div align="center">Tarikh Daftar Keluar</div></th>
                                <th><div align="center">Status Bayaran</div></th>
                                <th><div align="center">Status Tempahan</div></th>
                                <th><div align="center">Lulus<br>Tempahan</div></th>
                                <th><div align="center">Batal<br>Tempahan</div></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php for($i = 0; $i < mysqli_num_rows($result); $i++){ ?>
                                <?php $x=1; ?>
                                <?php while($query_row = mysqli_fetch_assoc($result)){ ?>

                                    <td align="center"><?php echo $x; ?></td>
                                    <td align="center"><?php echo $query_row['id_booking']; ?></td>
                                    <td align="center"><?php echo $query_row['id_user']; ?></td>
                                    <td align="center"><?php echo $query_row['id_produk']; ?></td>
                                    <td align="center"><?php echo $query_row['id_room']; ?></td>
                                    <td align="center"><?php echo $query_row['check_in']; ?></td>
                                    <td align="center"><?php echo $query_row['check_out']; ?></td>
                                    <td align="center"><?php echo $query_row['status_bayaran']; ?></td>
                                    <td align="center"><?php echo $query_row['status_checkout']; ?></td>

                                    <td align="center">
                                        <a href="utama.php?view=admin&action=gomasjidpro&page=beradu_getapprovebooking&booking=<?php echo $query_row['id_booking']?>" class="btn btn-success" title="Lulus Tempahan"><i class="far fa-check-square"></i></a>
                                    </td>
                                    <td align="center">
                                        <form name="delete" method="POST" action="utama.php?view=admin&action=gomasjidpro&page=beradu_getrejectbooking&booking=<?php echo $query_row['id_booking']; ?>">
                                            <input type="hidden" name="del" id="del" value="<?php echo $query_row['id_booking']; ?>">
                                            <button type="submit" name="delete" id="delete" class="btn btn-danger" data-toggle="tooltip" data-placement="right" title="Batal Tempahan"><i class="far fa-window-close"></i></button></form>
                                            <!-- form action="admin/reject_bantuan.php" method="POST" onSubmit="return confirm('Menolak Permohonan Bantuan?')">
											<input type="hidden" name="id_bantuan" value="<?php //echo $data['id_bantuan_zakat']; ?>">
											<button type="submit" name="tolak_bantuan" class="btn btn-danger"><i class="far fa-window-close"></i></button>
										</form -->
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
        <!-- /.col-lg-12 -->
    </div>
</div>
<?php
}
?>
