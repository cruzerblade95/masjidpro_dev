<?php
$id_pengurusan = $_GET['id_pengurusan'];
$sql = "SELECT * FROM data_pengurusan_masjid WHERE id_pengurusan='$id_pengurusan'";
$sqlquery = mysqli_query($bd2,$sql);
$data = mysqli_fetch_array($sqlquery);
?>
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Butiran Pengurusan Masjid</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="../utama.php?view=admin&action=dashboard_tetapan">Menu Organisasi</a></li>
                    <li class="active">Butiran Pengurusan Masjid</li>
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
                    Maklumat Pengurusan Masjid
                </div>
                <div class="card-body">
                    <form method="POST" action="admin/edit_pengurusan.php">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Nama Penuh</label>
                                        <input class="form-control" name="nama_penuh" id="nama_penuh" value="<?php echo $data['nama_penuh']; ?>" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>No Kad Pengenalan</label>
                                        <input class="form-control" name="no_ic" id="no_ic" minlength="12" maxlength="12" value="<?php echo $data['no_ic']; ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>No Telefon</label>
                                        <input class="form-control" name="no_tel" id="no_tel" value="<?php echo $data['no_tel']; ?>" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Jawatan</label>
                                        <!-- <input class="form-control" name="jawatan" id="jawatan" value="<?php echo $data['jawatan']; ?>" required> -->
                                        <select name="jawatan" class="form-control" required>
                                            <option value="">Sila Pilih:</option>
                                            <?php
                                            $sql_jawatan = "SELECT * FROM jawatan_pengurusan_masjid WHERE id_masjid='$id_masjid'";
                                            $query_jawatan = mysqli_query($bd2,$sql_jawatan);

                                            while($data_jawatan = mysqli_fetch_array($query_jawatan)){
                                            ?>
                                            <option value="<?php echo $data_jawatan['id_jawatan']; ?>" <?php if($data_jawatan['id_jawatan']==$data['jawatan']) { ?>selected="selected"<?php } ?>?><?php echo $data_jawatan['jawatan']; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <center>
                                            <input type="hidden" name="id_pengurusan" value="<?php echo $data['id_pengurusan']; ?>">
                                            <input type="submit" name="kemaskini" value="Kemaskini" class="btn btn-primary">
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


