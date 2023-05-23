<?php

    include('../connection/connection.php');

    if($_GET['id_pic']==1)
    {
    ?>
    <div class="row">
        <div class="col-lg-12">
            <center><h4>MAKLUMAT SELENGGARA</h4></center>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label>Nama Vendor</label>
                <select class="form-control" name="vendor_selenggara" required>
                    <option value>Sila Pilih:-</option>
                    <?php
                    $sql1="SELECT * FROM kew_vendor WHERE id_masjid='$id_masjid' AND jenis_vendor='5'";
                    $sqlquery1=mysqli_query($bd2,$sql1);

                    while($data1=mysqli_fetch_array($sqlquery1))
                    {
                        ?>
                        <option value="<?php echo $data1['id_vendor']; ?>"><?php echo $data1['nama_vendor']; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label>Tarikh Selenggara</label>
                <input class="form-control" type="date" name="tarikh_selenggara" required>
            </div>
            <div class="form-group">
                <label>Masa Selenggara</label>
                <input type="time" class="form-control" name="masa_selenggara" required>
            </div>
            <!-- <div class="form-group">
                <label>Alamat</label>
                <textarea class="form-control" name="alamat_vendor"></textarea>
            </div> -->

        </div>
        <!-- /.col-lg-6 (nested) -->
        <div class="col-lg-6">
            <div class="form-group">
                <label>Pilihan Selenggara</label>
                <select class="form-control" name="pilihan_selenggara" required>
                    <option>Sila Pilih:-</option>
                    <option value="1">Fasiliti</option>
                    <option value="2">Elektrik</option>
                    <option value="3">Air</option>
                    <option value="4">Komunikasi</option>
                    <option value="5">Perkakasan</option>
                </select>
            </div>
            <div class="form-group">
                <label>Catatan</label>
                <textarea class="form-control" rows="3" name="catatan"></textarea>
            </div>
        </div>
        <!-- /.col-lg-6 (nested) -->
        <div class="col-lg-12" align="center">
            <div class="form-group">
                <input type="hidden" name="id_masjid" value="<?php echo $id_masjid; ?>">
                <input type="hidden" name="id_pic" value="<?php echo $_GET['id_pic']; ?>">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="reset" class="btn btn-primary">Padam Semula</button>
            </div>
        </div>
    </div>
    <?php
    }
    else if($_GET['id_pic']==2)
    {
    ?>
    <div class="row">
        <div class="col-lg-12">
            <center><h4>MAKLUMAT SELENGGARA</h4></center>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label>Nama AJK</label>
                <select class="form-control" name="ajk_selenggara" required>
                    <option value>Sila Pilih:-</option>
                    <?php
                    $sql1="SELECT * FROM data_ajkmasjid WHERE id_masjid='$id_masjid'";
                    $sqlquery1=mysqli_query($bd2,$sql1);

                    while($data1=mysqli_fetch_array($sqlquery1))
                    {
                        ?>
                        <option value="<?php echo $data1['id_dataajk']; ?>">
                            <?php
                            $id_ajk = $data1['id_ajk'];

                            $sql2 = "SELECT * FROM sej6x_data_peribadi WHERE id_data='$id_ajk'";
                            $sqlquery2 = mysqli_query($bd2,$sql2);
                            $data2 = mysqli_fetch_array($sqlquery2);

                            echo $data2['nama_penuh'];
                            ?>
                        </option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label>Tarikh Selenggara</label>
                <input class="form-control" type="date" name="tarikh_selenggara" required>
            </div>
            <div class="form-group">
                <label>Masa Selenggara</label>
                <input type="time" class="form-control" name="masa_selenggara" required>
            </div>
            <!-- <div class="form-group">
                <label>Alamat</label>
                <textarea class="form-control" name="alamat_vendor"></textarea>
            </div> -->

        </div>
        <!-- /.col-lg-6 (nested) -->
        <div class="col-lg-6">
            <div class="form-group">
                <label>Pilihan Selenggara</label>
                <select class="form-control" name="pilihan_selenggara" required>
                    <option>Sila Pilih:-</option>
                    <option value="1">Fasiliti</option>
                    <option value="2">Elektrik</option>
                    <option value="3">Air</option>
                    <option value="4">Komunikasi</option>
                    <option value="5">Perkakasan</option>
                </select>
            </div>
            <div class="form-group">
                <label>Catatan</label>
                <textarea class="form-control" rows="3" name="catatan"></textarea>
            </div>
        </div>
        <!-- /.col-lg-6 (nested) -->
        <div class="col-lg-12" align="center">
            <div class="form-group">
                <input type="hidden" name="id_masjid" value="<?php echo $id_masjid; ?>">
                <input type="hidden" name="id_pic" value="<?php echo $_GET['id_pic']; ?>">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="reset" class="btn btn-primary">Padam Semula</button>
            </div>
        </div>
    </div>
    <?php
    }
?>