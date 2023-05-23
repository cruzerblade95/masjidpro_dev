<?php

// Masukkan backend PHP/Mysql di bahagian sini

if($_SERVER['REQUEST_METHOD'] == "POST" ) {
    $id_category = e($_POST['id_category'],1,NULL);
    $id_subcategory = e($_POST['id_subcategory'],1,NULL);
    $id_negeri = e($_POST['id_negeri'],1,NULL);
    $id_daerah = e($_POST['id_daerah'],1,NULL);
    $id_masjid = e($_POST['id_masjid'],1,NULL);
    $nama_produk = e($_POST['nama_produk'],1,NULL);
    $harga = e($_POST['harga'],1,NULL);
    $description = e($_POST['description'],1,NULL);
    $address = e($_POST['address'],1,NULL);
    $kuantiti = e($_POST['kuantiti'],1,NULL);
    $name= $_FILES['image']['name'];
    $img = file_get_contents($name);

    // Encode the image string data into base64
    $data = base64_encode($img);

    // Display the output
    echo $data;

    $sql = "INSERT INTO products_ecomasjid(id_category, id_subcategory, id_negeri, id_daerah, id_masjid, nama_produk, harga, description, address,image, kuantiti) 
                    VALUES ('$id_category','$id_subcategory','$id_negeri','$id_daerah','$id_masjid','$nama_produk','$harga','$description','$address','$data','$kuantiti')";

    $sql1 = mysqli_query($bd2,$sql) or die("sql error".$sql . mysqli_error($bd2));

    $test=$sql1;
    if($test)
    {
        echo "<script>document.location.href='utama.php?view=admin&action=gomasjidpro&page=ecomasjid_list_produk'</script>";
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
        <h4>Tambah Bilik</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:history.back()">Dashboard Beradu</a></li>
                <li class="breadcrumb-item active">Tambah Bilik</li>
            </ol>
        </div>
    </div>
</div>
<div class="row">
    <div class="content-header">
    </div>
    <div class="col-sm-12">
        <div class="card card-body">
            <form id="add_produk" name="add_produk" method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">
                <div class="md-4">
                    <h5 class="m-t-30">Nama Penginapan</h5>
                    <?php
                    $sql="SELECT id_produk, nama_produk FROM products_ecomasjid WHERE id_category=2 AND id_masjid = 3876";

                    /* You can add order by clause to the sql statement if the names are to be displayed in alphabetical order */

                    echo "<select id=id_produk class='form-control' data-style=form-control name=produk value=''></option>"; // list box select command

                    foreach ($bd2->query($sql) as $row){//Array or records stored in $row

                        echo "<option value=$row[id_produk]>$row[nama_produk]</option>";

                        /* Option values are added by looping through the array */

                    }
                    echo "</select>";// Closing of list box
                    ?>
                </div>
                <div class="md-4 mb-4 ">
                    <div class="form-group">
                        <label for="id_negeri">ID Negeri</label>
                        <input type="text" id="id_negeri" name="id_negeri" class="form-control" value="<?php echo $_SESSION['id_negeri'];?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="id_daerah">ID Daerah <span class="help"></span></label>
                    <input type="text" id="id_daerah" name="id_daerah" class="form-control" value="<?php echo $_SESSION['id_daerah'];?>" />
                </div>
                <div class="form-group">
                    <label for="id_masjid">ID Masjid <span class="help"></span></label>
                    <input type="text" id="id_masjid" name="id_masjid" class="form-control" value="<?php echo $_SESSION['id_masjid'];?>" />
                </div>
                <div class="form-group">
                    <label for="nama_produk">Nama Penginapan <span class="help"></span></label>
                    <input type="text" id="nama_produk" name="nama_produk" class="form-control" value="<?php echo($nama_produk);?>"/>
                </div>
                <!-- <div class="form-group">
                    <label for="harga">Harga Produk</label>
                    <div class="input-group-prepend">
                        <span class="input-group-text">RM</span><span class="input-group-text">0.00</span>
                        <input type="text" id="harga" name="harga" class="form-control" value="<?php echo ($harga); ?>"/>
                    </div>
                </div> -->
                <div class="form-group">
                    <label>Gambar</label>
                    <input id="image" name="image" type="file" class="form-control" value="<?php echo($data);?>" />
                </div>
                <!-- <div class="form-group">
                    <label>Kuantiti</label>
                    <input id="kuantiti" name="kuantiti" type="number" class="form-control" value="<?php echo($kuantiti);?>" />
                </div> -->
                <div class="form-group">
                    <label>Penerangan Penginapan</label>
                    <textarea id="description" name="description" class="form-control" rows="5" value="<?php echo($description);?>"></textarea>
                </div>
                <div class="form-group">
                    <label for="address">Alamat <span class="help"></span></label>
                    <input type="text" id="address" name="address" class="form-control" value="<?php echo($address);?>"/>
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

