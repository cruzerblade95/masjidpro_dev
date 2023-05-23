<?php

include("connection/connection.php");

//include("fungsi_tarikh.php");
?>
<script src="js/jquery-3.4.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready(function() {
        $('#table_display').DataTable();
    } );
</script>
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Rekod Surat Rasmi</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li class="active">Rekod Surat Rasmi</li>
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
                    Senarai Rekod Surat Rasmi
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table_display" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th width="5%"><div align="center">#</div></th>
                                <th width="35%"><div align="center">Tajuk</div></th>
                                <th width="20%"><div align="center">Tarikh</div></th>
                                <th width="15%"><div align="center">Jenis Surat</div></th>
                                <th width="25%"><div align="center">Tindakan</div></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1;
                            $sql = "SELECT * FROM surat_rasmi WHERE id_masjid='$id_masjid'";
                            $sqlquery = mysqli_query($bd2,$sql);
                            $row = mysqli_num_rows($sqlquery);
                            while($data=mysqli_fetch_array($sqlquery))
                            {
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td align="left"><?php echo $data['tajuk_surat']; ?></td>
                                    <td align="center"><?php echo(fungsi_tarikh($data["tarikh"], 2, 1)); ?></td>
                                    <td align="center">
                                        <?php
                                        $jenis_surat = $data["jenis_surat"];
                                        if($jenis_surat=="1"){
                                            echo "Surat Aduan";
                                        }
                                        else if($jenis_surat=="2"){
                                            echo "Surat Jemputan";
                                        }
                                        else if($jenis_surat=="3"){
                                            echo "Surat Pemberitahuan";
                                        }
                                        else if($jenis_surat=="4"){
                                            echo "Surat Pengesahan";
                                        }
                                        else if($jenis_surat=="5"){
                                            echo "Surat Permohonan";
                                        }
                                        else if($jenis_surat=="6"){
                                            echo "Surat Sokongan";
                                        }
                                        ?>
                                    </td>
                                    <td align="center">
                                        <a class="btn btn-secondary" href="admin/pdf_surat.php?id_surat=<?php echo $data["id_surat"]; ?>" target="_blank"><i class="fas fa-file-pdf"></i></a>
                                        <a class="btn btn-info" href="admin/view_surat.php?id_surat=<?php echo $data["id_surat"]; ?>" target="_blank"><i class="fa fa-search"></i></a>&nbsp;
                                        <a class="btn btn-warning" href="utama.php?view=admin&action=edit_surat_rasmi&id_surat=<?php echo $data["id_surat"]; ?>"><i class="fa fa-edit"></i></a>&nbsp;
                                        <a href="admin/del_surat.php?id_surat=<?php echo $data['id_surat']; ?>" class="btn btn-danger" onClick="return confirm('Anda Pasti Untuk Padam?');"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
</div>
