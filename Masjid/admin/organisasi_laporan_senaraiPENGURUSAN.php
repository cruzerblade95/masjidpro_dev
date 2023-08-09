<?php

?>
<div class="breadcrumbs">
    <div class="col-sm-8">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Senarai Kehadiran Pengurusan Masjid</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li class="active">Senarai Kehadiran</li>
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
                    Rekod Kehadiran
                    <!-- <button onclick="//myFunction()" class="btn btn-success">Cetak</button> -->
                    <script>
                        function myFunction() {
                            window.print();
                        }
                    </script>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <?php
                        include("connection/connection.php");

                        $sql_search="SELECT c.id 'id_pengurusan', c.nama_penuh, c.no_pengenalan 'no_ic', c.no_telefon 'no_tel', c.jawatan FROM rekod_organisasi c WHERE c.kategori_jawatankuasa = 'pengurusan' AND c.id_masjid = '$id_masjid' UNION SELECT a.id_pengurusan, a.nama_penuh, a.no_ic, a.no_tel, b.jawatan FROM data_pengurusan_masjid a, jawatan_pengurusan_masjid b WHERE a.jawatan=b.id_jawatan AND a.id_masjid='$id_masjid' ORDER BY id_pengurusan ASC";

                        $result = mysqli_query($bd2,$sql_search) or die ("Error :".mysqli_error());
                        ?>
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th><div align="center">Bil</div></th>
                                <th><div align="center">Nama </div></th>
                                <th><div align="center">Jawatan</div></th>
                                <th><div align="center">Tindakan</div></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $x=1;
                            while($row = mysqli_fetch_assoc($result))
                            {
                                $id_pegawai = $row['id'];
                                ?>
                                <tr>
                                    <td><div align="center"><?php echo $x; ?></div></td>
                                    <td><?php echo $row['nama_penuh']; ?></td>
                                    <td><div align="center"><?php echo $row['jawatan']; ?></div></td>
                                    <td>
                                        <div align="center">
                                            <a href="utama.php?view=admin&action=organisasi_laporan_senaraiPENGURUSAN_individu&id_pengurusan=<?php echo $row['id_pengurusan'];?>&jawatan=<?php echo $row['jawatan'];?>&sideMenu=organisasi">
                                                <button type="button" class="form-control" title="Lihat">
                                                    <i class="fas fa-search" ></i>
                                                </button>
                                            </a>
                                            <!-- <a href="utama.php?view=admin&action=jadualterperinci&id_pegawai=<?php //echo $row['id'];?>">
												<button type="button" class="form-control" title="Jadual">
													<i class="fas fa-calendar" ></i>&nbsp;Jadual Bertugas
												</button>
											</a> -->
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
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
    </div>
</div>