<?php

include("connection/connection.php");

$sql_search="SELECT * FROM sej6x_data_temujanji WHERE id_masjid='$id_masjid' ORDER BY tarikh DESC";
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
                <h1>Kelulusan Temujanji</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li class="active">Kelulusan Temujanji</li>
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
                    Maklumat Permohonan Temujanji&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="meja_akaun" width="100%" data-order="[]" class="table table-bordered table-hover table-striped">
                            <thead>
                            <tr>
                                <th width="5%"><div align="center">No</div></th>
                                <th><div align="center">Nama</div></th>
                                <th><div align="center">No Telefon</div></th>
                                <th><div align="center">Tarikh</div></th>
                                <th><div align="center">Temujanji Bersama</div></th>
                                <th><div align="center">Tujuan</div></th>
                                <th><div align="center">Status Permohonan</div></th>
                                <th><div align="center">Tindakan</div></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if($row==0)
                            {
                                ?>
                                <tr>
                                    <td colspan="9" align="center">*Tiada Rekod*</td>
                                </tr>
                                <?php
                            }
                            else if($row>0)
                            {
                                $x=1;
                                while($row = mysqli_fetch_assoc($result))
                                {
                                    $id_data = $row['id_data'];
                                    $id_anak = $row['id_anak'];

                                    if($id_data!=NULL) {
                                        $sql1 = "SELECT * FROM sej6x_data_peribadi WHERE id_data='$id_data'";
                                    }
                                    else if($id_anak!=NULL){
                                        $sql1 = "SELECT nama_penuh, no_tel 'no_hp' FROM sej6x_data_anakqariah WHERE ID='$id_anak'";
                                    }
                                    $sqlquery1 = mysqli_query($bd2, $sql1);
                                    $data1 = mysqli_fetch_array($sqlquery1);

                                    ?>
                                    <tr>
                                        <td align="center"><?php echo $x; ?></td>
                                        <td align="center"><?php echo $data1['nama_penuh']; ?></td>
                                        <td align="center"><?php echo $data1['no_hp']; ?></td>
                                        <td align="center"><?php echo $row['tarikh']." ".$row['masa']; ?></td>
                                        <td align="center"><?php echo $row['ajk_pegawai']; ?></td>
                                        <td align="center"><?php echo $row['tujuan']; ?></td>
                                        <td align="center">
                                            <?php
                                            if($row['status']==1)
                                            {
                                                ?>
                                                <button type="button" class="btn btn-success" disabled>Permohonan Diluluskan</button>
                                                <?php
                                            }
                                            else if($row['status']==2)
                                            {
                                                ?>
                                                <button type="button" class="btn btn-danger" disabled>Permohonan Ditolak</button>
                                                <?php
                                            }
                                            else if($row['status']=="0")
                                            {
                                                ?>
                                                <button type="button" class="btn btn-warning" disabled>Permohonan Menunggu Kelulusan</button>
                                                <?php
                                            }
                                            ?>
                                        </td>
                                        <td align="center">
                                            <button class="btn btn-danger" type="button" onclick="showSebab(<?php echo $row['ID']; ?>, '<?php echo($data1['nama_penuh']); ?>', '<?php echo($row['status']); ?>', '<?php echo($row['nota']); ?>')">Respon</button>
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
