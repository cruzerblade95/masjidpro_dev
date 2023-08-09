<?php
$id_masjid = $_SESSION['id_masjid'];

$query = "SELECT id_booking, id_user, id_masjid, id_produk, id_room, check_in, check_out, status_checkout,
            status_bayaran, bill_code, quantity FROM beradu_booking WHERE id_masjid= '$id_masjid'";

$result = mysqli_query($bd2, $query) or die ("Error:".mysqli_error($bd2));
?>

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4>Rekod Tempahan</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:history.back()">Dashboard Beradu</a></li>
                <li class="breadcrumb-item active">Rekod Tempahan</li>
            </ol>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive m-t-40">
                    <table id="list_tempahan" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th class="text-center">ID Pengguna</th>
                            <th class="text-center">Nama Penginapan</th>
                            <th class="text-center">Nama Bilik</th>
                            <th class="text-center">Daftar Masuk</th>
                            <th class="text-center">Daftar Keluar</th>
                            <th class="text-center">Status Tempahan</th>
                            <th class="text-center">Status Bayaran</th>
                            <th class="text-center text-end">Kod Bil</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php for($i = 0; $i < mysqli_num_rows($result); $i++){ ?>
                        <?php while($query_row = mysqli_fetch_assoc($result)){ ?>

                            <tr>
                                <td><?php echo $query_row['id_booking']; ?></td>
                                <td><?php echo $query_row['id_user']; ?></td>
                                <td><?php echo $query_row['id_produk']; ?></td>
                                <td><?php echo $query_row['id_room']; ?></td>
                                <td><?php echo $query_row['check_in']; ?></td>
                                <td><?php echo $query_row['check_out']; ?></td>
                                <td><?php echo $query_row['status_checkout']; ?></td>
                                <td><?php echo $query_row['status_bayaran']; ?></td>
                                <td><?php echo $query_row['bill_code']; ?></td>
                            </tr>
                            <?php
                        }
                        ?>
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
        $('#list_tempahan').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
        $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-dark waves-effect waves-light');
    });

</script>

