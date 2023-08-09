<?php

// Masukkan backend PHP/Mysql di bahagian sini

if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['nama_form'] == "add_produk") {
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
        header("location: ../utama.php?view=admin&action=gomasjidpro&page=ecomasjid_dashboard");
    }
    else
    {
        echo mysql_error();
    }

}

// Tak perlu redirection sebab proses di page yang sama untuk method POST melainkan nk redirect ke page yang lain.

?>

<section xmlns="http://www.w3.org/1999/html">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Tambah Produk</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:history.back()">Dashboard EcoMasjid</a></li>
                    <li class="breadcrumb-item active">Tambah produk</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="content-header">
            <div class="card"> </div>
        </div>
        <div class="col-sm-12">
            <div class="card card-body">
                <form id="add_produk" name="add_produk" method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">
                    <fieldset disabled>
                    <div class="md-4">
                        <h5 class="m-t-30">Kategori Produk</h5>
                        <?php
                        $sql="SELECT id_category, category FROM category_ecomasjid WHERE id_category=1";

                        /* You can add order by clause to the sql statement if the names are to be displayed in alphabetical order */

                        echo "<select id=category class='form-control' data-style=form-control name=category value=''>Pilih Kategori Produk</option>"; // list box select command

                        foreach ($bd2->query($sql) as $row){//Array or records stored in $row

                            echo "<option value=$row[id_category]>$row[category]</option>";

                            /* Option values are added by looping through the array */

                        }
                        echo "</select>";// Closing of list box
                        ?>
                    </div>
                    </fieldset>
                    <div class="md-4 mb-4">
                        <h5 class="m-t-30">Subkategori Produk</h5>
                        <?php
                        //$id = $_GET['cat'];
                        $sql3="SELECT * FROM ecomasjid_subcategory WHERE id_category=1";

                        /* You can add order by clause to the sql statement if the names are to be displayed in alphabetical order */

                        echo "<select id=subcategory class=form-control data-style=form-control name=subcategory>Pilih Subkategori Produk</option>"; // list box select command

                        foreach ($bd2->query($sql3) as $row){//Array or records stored in $row

                            echo "<option value=$row[id_subcategory]>$row[subcategory]</option>";

                            /* Option values are added by looping through the array */
                        }
                        echo "</select>";// Closing of list box
                        ?>
                    </div>
                    <fieldset disabled>
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
                    </fieldset>
                    <div class="form-group">
                        <label for="nama_produk">Nama Produk <span class="help"></span></label>
                        <input id="nama_produk" name="nama_produk" type="text" class="form-control" value="<?php echo $nama_produk ?>" />
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga RM </label>
                        <input id="harga" name="harga" type="text" class="form-control" value="<?php echo $harga ?>" />
                    </div>
                    <div class="form-group">
                        <label>Gambar</label>
                        <input id="image" name="image" type="file" class="form-control" value="<?php echo $img?>" >
                    </div>
                    <div class="form-group">
                        <label>Kuantiti</label>
                        <input id="kuantiti" name="kuantiti" type="number" class="form-control" value="<?php echo $kuantiti ?>" />
                    </div>
                    <div class="form-group">
                        <label>Penerangan Produk</label>
                        <textarea id="description" name="description" class="form-control" rows="5" value="<?php echo $description ?>" ></textarea>
                    </div>
                    <div class="form-group">
                        <label for="address">Alamat <span class="help"></span></label>
                        <input id="address" name="address" type="text" class="form-control" value="<?php echo $address?>"/>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-success mr-2">Hantar</button>
                        <button type="button" class="btn btn-dark" onclick="location.href='utama.php?view=admin&action=gomasjidpro&page=ecomasjid_dashboard'">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

