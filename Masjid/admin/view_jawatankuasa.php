<?php

$id_organisasi = $_GET['id_organisasi'];
$nokuasa = $_GET['nokuasa'];

$sql = "SELECT id, id_rekod, id_masjid, nama_penuh, jenisPengenalan, no_pengenalan, no_telefon, emel, id_jawatankuasa, kategori_jawatankuasa, jawatan, ajk_biro, tarikh_lantikan, tarikh_perletakan, sebab_perletakan, filename, gambar, jenis_gambar FROM rekod_organisasi  
        WHERE id = '$id_organisasi'";
$result = mysqli_query($bd2, $sql) or die ("Error :".mysqli_error($bd2));
$row = mysqli_fetch_assoc($result);
?>
<div class="breadcrumbs">
    <div class="col-sm-8">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Maklumat Ahli Jawatankuasa</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li class="active">Maklumat Ahli Jawatankuasa</li>
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
                    <div class="row">
                        <div class="col-lg-10">
                            Maklumat Ahli Jawatankuasa
                        </div>
                        <div class="col-lg-2" align="end">
                            <?php if($nokuasa == '1'){?>
                                <a href="utama.php?view=admin&action=senaraiJawatankuasa_AJK&sideMenu=organisasi"><button class="btn btn-primary">Kembali</button></a>
                            <?php } else if($nokuasa == '2') { ?>
                                <a href="utama.php?view=admin&action=senaraiJawatankuasa_PEGAWAI&sideMenu=organisasi"><button class="btn btn-primary">Kembali</button></a>
                            <?php } else {?>
                                <a href="utama.php?view=admin&action=senaraiJawatankuasa_PENGURUSAN&sideMenu=organisasi"><button class="btn btn-primary">Kembali</button></a>
                            <?php }?>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Nama Penuh :</label><br>
                                <label><?php echo $row['nama_penuh']; ?></label>
                            </div>
                            <div class="form-group">
                                <label>No. Telefon :</label><br>
                                <label><?php echo $row['no_telefon']; ?></label>
                            </div>
                            <div class="form-group">
                                <label>Kategori Jawatankuasa :</label><br>
                                <label><?php echo strtoupper($row['kategori_jawatankuasa']); ?></label>
                            </div>
                            <div class="form-group">
                                <label>Tarikh Lantikan :</label><br>
                                <label><?php echo $row['tarikh_lantikan']; ?></label>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>No Pengenalan :</label><br>
                                <label><?php echo $row['no_pengenalan']; ?></label>
                            </div>
                            <div class="form-group">
                                <label>Alamat E-mel :</label><br>
                                <label><?php echo $row['emel']; ?></label>
                            </div>
                            <div class="form-group">
                                <label>Jawatan :</label><br>
                                <label><?php if ($row['ajk_biro'] != NULL) { echo strtoupper($row['jawatan']) . ' ' . strtoupper($row['ajk_biro']);} else {echo strtoupper($row['jawatan']);} ?></label>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <?php

                                        $id = $row['id'];

                                        $s = "SELECT gambar, jenis_gambar FROM rekod_organisasi WHERE id = '$id'";
                                        $res = mysqli_query($bd2,$s);
                                        if($res)
                                        {
                                            $row1 = mysqli_fetch_array($res);
                                            $type = "Content-type: ".$row1['jenis_gambar'];
                                            //header($type);
                                            $image = $row1['gambar'];
                                            $jenis_gambar = $row1['jenis_gambar'];
                                        }
                                        else
                                        {
                                            echo mysqli_error($bd2);
                                        }
                                        ?>
                                        <label>Dokumen :</label>
                                        <label>
<!--                                            <input id="gambar" name="gambar" class="form-control" type="file" accept=".jpg,.gif,.png,.jpeg" onchange="preview_image(event, 'output1')">-->
                                            <?php echo '<img class="img-fluid p-3" id="output1" src="data:'.$jenis_gambar.';base64,'.$image .'" />'; ?>
                                        </label>
                                    </div>
                                </div>
<!--                                <div class="row">-->
<!--                                    --><?php
//                                    $files_field= $row['filename'];
//                                    $files_show= "../Uploads/files/$files_field";
//                                    ?>
<!--                                    <div class="col-lg-6">-->
<!--                                        <label>Lihat Dokumen</label></br>-->
<!--                                        --><?php //if(strpos($files_show, '.pdf') === false) echo "<a target='_blank' href='https://view.officeapps.live.com/op/embed.aspx?src=https://masjidpro.com/Masjid/$files_show' class='btn btn-warning'><i class='fa fa-file'></i></a>"?>
<!--                                    </div>-->
<!--                                    <div class="col-lg-6">-->
<!--                                        <label>Muat Turun Dokumen</label></br>-->
<!--                                        --><?php //echo "<a href='$files_show' class='btn btn-info'><i class='fa fa-upload'></i></a>"?>
<!--                                    </div>-->
<!--                                </div>-->
                            </div>
                        </div>
                        <div class="col-lg-12" align="center">
                            <a href="utama.php?view=admin&action=edit_jawatankuasa&id_organisasi=<?php echo $row['id']; ?>&nokuasa=<?php echo $nokuasa;?>&sideMenu=organisasi"><button class="btn btn-warning">Kemaskini</button></a>
                            <button onclick="myFunction()" class="btn btn-info">Cetak</button>
                            <script>
                                function myFunction() {
                                    window.print();
                                }
                            </script>
                        </div>
                    </div>
                    <!-- /.row (nested) -->
                </div>
            </div>
        </div>
    </div>
</div>

