<?php

include ('../connection/connection.php');
include ('../fungsi.php');

if(isset($_GET['id_wakaf']))
{
$id_wakaf = $_GET['id_wakaf'];

$sql_wakaf = "SELECT * FROM wakaf WHERE id_wakaf='$id_wakaf'";
$query_wakaf = mysqli_query($bd2,$sql_wakaf);

$data_wakaf = mysqli_fetch_array($query_wakaf);
?>
<div class="row">
    <div class="col-lg-12">
        <form method="post" id="insert_form" action="admin/edit_wakaf.php" enctype="multipart/form-data">
            <center>
                <div class="row">
                    <div class="col-lg-12">
                        <center><h4><u>Maklumat Wakaf</u></h4></center>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-3">

                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Nama Wakaf</label>
                            <input type="text" name="nama_wakaf" id="nama_wakaf" class="form-control" required value="<?php echo $data_wakaf['nama_wakaf']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea class="form-control" name="description" id="description" rows="5" required><?php echo $data_wakaf['description'] ; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Kuantiti/Unit</label>&nbsp;
                            <input class="form-control" type="number" name="quantity" id="quantity" min="1" step="1" required value="<?php echo $data_wakaf['quantity']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Harga (Per Kuantiti/Unit)</label>&nbsp;
                            <input class="form-control" type="number" name="price" id="price" min="0.01" step=".01" required value="<?php echo $data_wakaf['harga_per_quantity']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Gambar QR Kod *Format .JPG, .JPEG, .PNG Sahaja*</label>
                            <input class="form-control" type="file" name="qr" id="qr" accept=".jpg, .jpeg, .png">
                            <?
                            $qr_wakaf = $data_wakaf['gambar_qr'];

                            if($qr_wakaf!=NULL OR $qr_wakaf!=''){
                                ?>
                                <img class="img-fluid p-3" id="output2" src="<?php echo($data_wakaf['gambar_qr']); ?>">
                                <?php
                            }
                            ?>
                        </div>
                        <div class="form-group">
                            <label>Gambar Poster *Format .JPG, .JPEG, .PNG Sahaja*</label>
                            <input type="file" class="form-control" name="poster" id="poster" accept=".jpg, .jpeg, .png">
                            <?
                            $poster_wakaf = $data_wakaf['poster_wakaf'];

                            if($poster_wakaf!=NULL OR $poster_wakaf!=''){
                                ?>
                                <img class="img-fluid p-3" id="output2" src="<?php echo($data_wakaf['poster_wakaf']); ?>">
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <!-- /.row (nested) -->
                <div class="row">
                    <div class="col-lg-12">
                        <input type="hidden" name="id_masjid" value="<?php echo $id_masjid; ?>">
                        <input type="hidden" name="id_wakaf" value="<?php echo $data_wakaf['id_wakaf']; ?>">
                        <input type="submit" name="insert" id="insert" value="Kemaskini" class="btn btn-success" />
                    </div>
                </div>
                <br>
            </center>
        </form>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<?php
}
?>