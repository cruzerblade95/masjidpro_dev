<?php
$id_masjid = $_SESSION['id_masjid'];

$query = "SELECT id_produk, image, id_subcategory, nama_produk, harga FROM products_ecomasjid WHERE id_masjid= '$id_masjid' AND id_subcategory = 3 OR id_subcategory= 4";
$result = mysqli_query($bd2, $query) or die ("Error:".mysqli_error($bd2));

?>

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4>Senarai Penginapan</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:history.back()">Dashboard Penginapan</a></li>
                <li class="breadcrumb-item"><a href="utama.php?view=admin&action=gomasjidpro&page=beradu_add_penginapan">Tambah Penginapan</a></li>
                <li class="breadcrumb-item active">Senarai Penginapan</li>
            </ol>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive m-t-40">
                    <table id="list_produk" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>ID Penginapan</th>
                            <!--<th>Gambar</th>-->
                            <th class="text-center">Nama Penginapan</th>
                            <!--<th class="text-center">Harga (RM)</th> -->
                            <th class="text-center">Sub-kategori</th>
                            <th class="text-end text-center">Pilihan</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php for($i = 0; $i < mysqli_num_rows($result); $i++){ ?>
                        <?php while($query_row = mysqli_fetch_assoc($result)){ ?>

                            <tr>
                                <td><?php echo $query_row['id_produk']; ?></td>
                                <!--<td><div class="left"><?php echo $query_row['image']; ?></div></td>-->
                                <td><span><?php echo $query_row['nama_produk']; ?></span></td>
                                <!-- <td><span><?php echo $query_row['harga']; ?></span></td> -->
                                <td><span><?php echo $query_row['id_subcategory']; ?></span></td>
                                <td>
                                    <div class="row">
                                        <div>
                                            <a href="utama.php?view=admin&action=gomasjidpro&page=beradu_detail_penginapan&beradu=<?php echo $query_row['id_produk']?>" class="btn btn-outline-success waves-effect waves-light" title="Butiran Penginapan"> <i class="far fa-building"></i></a>
                                        </div>
                                        <div>
                                            <a href="utama.php?view=admin&action=gomasjidpro&page=beradu_edit_penginapan&beradu=<?php echo $query_row['id_produk']?>" class = "btn btn-outline-info waves-effect waves-light" title="Kemaskini Penginapan"><i class=" far fa-edit"></i></a>
                                        </div>
                                        <div><form name="delete" method="POST" action="utama.php?view=admin&action=gomasjidpro&page=beradu_delete_penginapan&beradu=<?php echo $query_row['id_produk']; ?>">
                                                <input type="hidden" name="del" id="del" value="<?php echo $query_row['id_produk']; ?>">
                                                <button type="submit" name="delete" id="delete" class="btn btn-outline-danger waves-effect waves-light" data-toggle="tooltip" data-placement="right" title="Padam Penginapan"><i class="far fa-trash-alt"></i></button></form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php
                                } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
}
?>

<script type="text/javascript">
    $(function () {
        $('#myTable').DataTable();
        var table = $('#example').DataTable({
            "columnDefs": [{
                "visible": false,
                "targets": 2
            }],
            "order": [
                [2, 'asc']
            ],
            "displayLength": 25,
            "drawCallback": function (settings) {
                var api = this.api();
                var rows = api.rows({
                    page: 'current'
                }).nodes();
                var last = null;
                api.column(2, {
                    page: 'current'
                }).data().each(function (group, i) {
                    if (last !== group) {
                        $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                        last = group;
                    }
                });
            }
        });
        // Order by the grouping
        $('#example tbody').on('click', 'tr.group', function () {
            var currentOrder = table.order()[0];
            if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                table.order([2, 'desc']).draw();
            } else {
                table.order([2, 'asc']).draw();
            }
        });
        // responsive table
        $('#config-table').DataTable({
            responsive: true
        });
        $('#list_produk').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
        $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-dark waves-effect waves-light');
    });

</script>

