<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Notifikasi</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li class="active">Notifikasi</li>
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
                    Rekod Notifikasi&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                    <button class="btn btn-success" type="button" data-toggle="modal" data-target="#myModal">Hantar Notifikasi</button>
                </div>
                <div class="card-body">
                    <table id="meja_akaun2" class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Tajuk</th>
                            <th></th>
                            <th>Fail</th>
                            <th>Tarikh </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i=1;

                        $sql_noti = "SELECT * FROM notifikasiDihantar WHERE id_masjid='$id_masjid'";
                        $query_noti = mysqli_query($bd2,$sql_noti);

                        while($data_noti=mysqli_fetch_array($query_noti)){
                            ?>
                            <tr>
                                <td align="center"><?php echo $i; ?></td>
                                <td><?php echo $data_noti['title']; ?></td>
                                <td align="center">RM <?php echo $data_noti['body']; ?></td>
                                <td align="center"><button class="btn btn-info"><i class="fas fa-file" title="Lihat Fail"></i>Fail</button></td>
                                <td align="center"><?php echo $data_noti['last_added']; ?></td>
                            </tr>
                            <?php
                            $i++;
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">HANTAR NOTIFIKASI</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form method="post" id="insert_form" action="admin/add_notifikasi.php" enctype="multipart/form-data">
                            <center>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <center><h4><u>Maklumat Notifikasi</u></h4></center>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-lg-3">

                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Tajuk Notifikasi</label>
                                            <input type="text" name="title" id="title" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Keterangan Notifikasi</label>
                                            <textarea class="form-control" name="body" id="body" rows="5" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Fail Notifikasi</label>
                                            <input class="form-control" type="file" name="fail" id="fail">
                                        </div>
                                    </div>
                                </div>
                                <!-- /.row (nested) -->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <input type="hidden" name="id_masjid" value="<?php echo $id_masjid; ?>">
                                        <input type="submit" name="insert" id="insert" value="Hantar" class="btn btn-success" />
                                    </div>
                                </div>
                                <br>
                            </center>
                        </form>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Kembali</button>
                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.modal-body -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- modal-dialog modal-lg -->
</div>
<!-- modal fade -->
<script>
    jQuery(document).ready(function () {
        meja_akaun('#meja_akaun2', 'Rekod Notifikasi', [ 0, 1, 2, 3 ]);
    });
</script>