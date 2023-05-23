<?php

// Masukkan backend PHP/Mysql di bahagian sini

if($_SERVER['REQUEST_METHOD'] == "POST" ) {
    $nama_produk = e($_POST['nama_produk'],1,NULL);
    $room_code = e($_POST['room_code'],1,NULL);
    $room_no = e($_POST['room_no'],1,NULL);

    $sql = "INSERT INTO beradu_room_no (nama_produk, room_code, room_no) VALUES ('$nama_produk','$room_code','$room_no')";

    $sql1 = mysqli_query($bd2,$sql) or die("sql error".$sql . mysqli_error($bd2));

    $test=$sql1;
    if($test)
    {
        echo "<script>document.location.href='utama.php?view=admin&action=gomasjidpro&page=beradu_list_bilik'</script>";
    }
    else
    {
        echo mysqli_error();
    }
}

// Tak perlu redirection sebab proses di page yang sama untuk method POST melainkan nk redirect ke page yang lain.

?>

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4>Tambah Nombor Bilik</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:history.back()">Dashboard Beradu</a></li>
                <li class="breadcrumb-item"><a href="utama.php?view=admin&action=gomasjidpro&page=beradu_add_penginapan">Daftar Penginapan</a></li>
                <li class="breadcrumb-item"><a href="utama.php?view=admin&action=gomasjidpro&page=beradu_add_maklumat_penginapan">Urus Penginapan</a></li>
                <li class="breadcrumb-item active">Tambah Nombor Bilik</li>
            </ol>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="card card-body">
            <form id="add_noBilik" name="add_noBilik" method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">
                <div class="md-4">
                    <h5 class="m-t-30">Nama Penginapan</h5>
                    <?php
                    $id_masjid = $_SESSION['id_masjid'];
                    $sql="SELECT id_produk, nama_produk FROM products_ecomasjid WHERE id_category=2 AND id_masjid = '$id_masjid'";

                    /* You can add order by clause to the sql statement if the names are to be displayed in alphabetical order */

                    echo "<select id=nama_produk class='form-control' data-style=form-control name=nama_produk value=''></option>"; // list box select command

                    foreach ($bd2->query($sql) as $row){//Array or records stored in $row

                        echo "<option value=$row[id_produk]>$row[nama_produk]</option>";

                        /* Option values are added by looping through the array */

                    }
                    echo "</select>";// Closing of list box
                    ?>
                </div>
                <div class="md-4">
                    <h5 class="m-t-30">Kod Bilik</h5>
                    <?php
                    $id_masjid = $_SESSION['id_masjid'];
                    $sql1="SELECT a.id_produk, a.id_masjid, b.id_produk, b.room_code, b.id_room, b.room_type FROM products_ecomasjid a, beradu_room b WHERE a.id_masjid = '$id_masjid' AND a.id_category=2 AND a.id_produk = b.id_produk;";

                    /* You can add order by clause to the sql statement if the names are to be displayed in alphabetical order */

                    echo "<select id=room_code class='form-control' data-style=form-control name=room_code value=''></option>"; // list box select command

                    foreach ($bd2->query($sql1) as $row){//Array or records stored in $row

                        echo "<option value=$row[room_code]>$row[room_type]</option>";

                        /* Option values are added by looping through the array */

                    }
                    echo "</select>";// Closing of list box
                    ?>
                </div>
                <!--<div id="room_no"></div>-->
                <div class="row">
                    <div class="col-sm-3 nopadding">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="number" class="form-control" id="room_no" name="room_no" value="" placeholder="Nombor Bilik">
                                <div class="input-group-append">
                                    <button class="btn btn-success" type="button" onclick="room_no();"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row button-group">
                    <div class="col-lg-6 col-md-6">
                        <button type="submit" class="btn btn-block btn-lg btn-success">HANTAR</button>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <button type="button" class="btn btn-block btn-lg btn-danger" onclick="location.href='utama.php?view=admin&action=gomasjidpro&page=beradu_dashboard'">BATAL</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

