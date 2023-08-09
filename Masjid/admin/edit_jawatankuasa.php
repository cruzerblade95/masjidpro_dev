<?php
    include("connection/connection.php");

    $id_organisasi = $_GET['id_organisasi'];
    $nokuasa=$_GET['nokuasa'];
?>
<div class="breadcrumbs">
    <div class="col-sm-8">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Kemaskini Organisasi</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li class="active">Kemaskini Organisasi</li>
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
                            Kemaskini Maklumat Ahli
                        </div>
                        <div class="col-lg-2" align="end">
                            <?php if($nokuasa == '1'){?>
                                <a href="utama.php?view=admin&action=senaraiJawatankuasa_AJK&sideMenu=organisasi"><button class="btn btn-danger">Batal</button></a>
                            <?php } else if($nokuasa == '2') { ?>
                                <a href="utama.php?view=admin&action=senaraiJawatankuasa_PEGAWAI&sideMenu=organisasi"><button class="btn btn-danger">Batal</button></a>
                            <?php } else {?>
                                <a href="utama.php?view=admin&action=senaraiJawatankuasa_PENGURUSAN&sideMenu=organisasi"><button class="btn btn-danger">Batal</button></a>
                            <?php }?>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <?php
                    $sql_search = "SELECT id, id_rekod, id_masjid, nama_penuh, jenisPengenalan, no_pengenalan, no_telefon, emel, id_jawatankuasa, kategori_jawatankuasa, jawatan, ajk_biro, tarikh_lantikan, tarikh_perletakan, sebab_perletakan, gambar, jenis_gambar FROM rekod_organisasi WHERE id_masjid = '$id_masjid' AND id = '$id_organisasi'";

                    $result = mysqli_query($bd2, $sql_search) or die ("Error :".mysqli_error($bd2));
                    ?>
                    <form action="admin/update_jawatankuasa.php" method='post' enctype="multipart/form-data">
                        <?php while($row = mysqli_fetch_assoc($result)) {?>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Nama Penuh</label>
                                        <input type="text" name="nama_penuh" id="nama_penuh" value="<?php echo $row['nama_penuh']; ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>No Pengenalan</label>
                                        <input type="text" name="no_pengenalan" id="no_pengenalan" minlength="12" maxlength="12" value="<?php echo $row['no_pengenalan']; ?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>No. Telefon</label>
                                        <input class="form-control" type="text" name="no_telefon" id="no_telefon" value="<?php echo $row['no_telefon']; ?>" >
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Alamat e-mel</label>
                                        <input class="form-control" type="email" name="emel" id="emel" value="<?php echo $row['emel']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Kategori Jawatankuasa</label>
                                        <select class="form-control" name="kategori_jawatankuasa" id="kategori_jawatankuasa" required>
                                            <option value =""></option>
                                            <option value ="ajk" <?php if($row['kategori_jawatankuasa']=='ajk') { echo "selected"; } ?>>Ahli Jawatankuasa Masjid</option>
                                            <option value ="pegawai" <?php if($row['kategori_jawatankuasa']=='pegawai') { echo "selected"; } ?>>Pegawai Masjid</option>
                                            <option value ="pengurusan" <?php if($row['kategori_jawatankuasa']=='pengurusan') { echo "selected"; } ?>>Pengurusan Masjid</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <!--select-->
                                    <div class="form-group" id="id_jawatankuasaDiv">
                                        <label>Jawatan</label>
                                        <select class="form-control" name="id_jawatankuasa" id="id_jawatankuasa" >
                                            <option value=""></option>
                                            <?php
                                            $kat_jawatankuasa =$row['kategori_jawatankuasa'];
                                            $sql = "SELECT id_jawatankuasa, id_masjid, kat_jawatankuasa, jawatan, ajk_biro FROM jawatankuasa_organisasi WHERE kat_jawatankuasa = '$kat_jawatankuasa' AND id_masjid = '$id_masjid'";
                                            $list_jawatan = mysqli_query($bd2, $sql) or die(mysqli_error($bd2));
                                            ?>
                                            <?php
                                            $id_jawatankuasa =$row['id_jawatankuasa'];
                                            while($row_list_jawatan = mysqli_fetch_assoc($list_jawatan))
                                            {
                                                ?>
                                                <option value="<?php echo($row_list_jawatan['id_jawatankuasa']); ?>" <?php if($id_jawatankuasa==$row_list_jawatan['id_jawatankuasa']) { echo "selected"; } ?>><?php if($row_list_jawatan['ajk_biro'] != NULL) { echo(strtoupper($row_list_jawatan['jawatan'])). ' ' .strtoupper($row_list_jawatan['ajk_biro']);} else { echo strtoupper($row_list_jawatan['jawatan']);} ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Tarikh Lantikan</label>
                                        <input class="form-control" type="date" name="tarikh_lantikan" id="tarikh_lantikan" value="<?php echo $row['tarikh_lantikan']; ?>">
                                    </div>
                                </div>
                                <div class="col-lg-6">
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
                                                <label>Muat Naik Dokumen</label>
                                                <label>
                                                    <input id="gambar" name="gambar" class="form-control" type="file" accept=".jpg,.gif,.png,.jpeg" onchange="preview_image(event, 'output1')">
                                                    <?php echo '<img class="img-fluid p-3" id="output1" src="data:'.$jenis_gambar.';base64,'.$image .'" />'; ?>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <center>
                                        <div class="form-group">
                                            <input type="hidden" name="id_organisasi" value="<?php echo $row['id']; ?>">
                                            <input type="hidden" name="nokuasa" value="<?php echo $nokuasa; ?>">
                                            <input type="submit"  value="Kemaskini" class="btn btn-success">
                                        </div>
                                    </center>
                                </div>
                            </div>
                        <?php }?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>