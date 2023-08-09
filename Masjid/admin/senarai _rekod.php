<?php

$sql_search = "SELECT id, nama_penuh, no_pengenalan, no_telefon, jawatan, tarikh_lantikan FROM rekod_organisasi WHERE id_masjid = '$id_masjid'";
$result = mysqli_query($bd2, $sql_search) or die ("Error :".mysqli_error($bd2));

?>
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Senarai Rekod Organisasi Masjid</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="utama.php?view=admin&action=dashboard_tetapan">Menu Organisasi</a></li>
                    <li class="active">Senarai Rekod Organisasi Masjid</li>
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
                    Senarai Rekod Organisasi Masjid
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="meja_akaun2" width="100%" data-order="[]" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th><div align="center">No</div></th>
                                <th><div align="center">Nama</div></th>
                                <th><div align="center">No IC</div></th>
                                <th><div align="center">No Telefon</div></th>
                                <th><div align="center">Jawatan</div></th>
                                <th><div align="center">Tarikh Lantikan</div></th>
                                <th><div align="center"></div></th>
                                <!--th><div align="center"></div></th-->
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
                                    <td><?php echo $row['nama_penuh']; ?></td>
                                    <td><div align="center"><?php echo $row['no_pengenalan']; ?></div></td>
                                    <td><div align="center"><?php echo $row['no_telefon']; ?></div></td>
                                    <td><div align="center"><?php echo $row['jawatan']; ?></div></td>
                                    <td><div align="center"><?php echo $row['tarikh_lantikan']; ?></div></td>
                                    <td><div align="center"><a href="utama.php?view=admin&action=semak_rekod_organisasi&id_rekod=<?php echo $row['id'];?>">[Semak]</a></div></td>
                                    <!--td>
                                        <div align="center">
                                            <form name="delete" method="POST" action="admin/del_senaraipegawai.php">
                                                <input type="hidden" name="del" id="del" value="<?php echo $row['id_datapegawai']; ?>">
                                                <button type="submit" name="delete" id="delete" class="btn btn-danger btn-circle" data-toggle="tooltip" data-placement="right" title="Padam" onclick="return confirm('Padam Rekod?')"><i class="fa fa-times"></i></button>
                                            </form>
                                        </div>
                                    </td-->
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
    </div>
</div>
<script>
    jQuery(document).ready(function () {
        meja_akaun('#meja_akaun2', 'Senarai AJK', [ 0, 1, 2, 3, 4, 5 ]);
    });
</script>




