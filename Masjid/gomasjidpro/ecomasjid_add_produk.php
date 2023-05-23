<?php
namespace Verot\Upload;
include($_SERVER['DOCUMENT_ROOT']."/Masjid/Classes/phpUpload/class.upload.php");
// Masukkan backend PHP/Mysql di bahagian sini

if($_SERVER['REQUEST_METHOD'] == "POST" ) {
    $id_category = e($_POST['id_category'],1,NULL);
    $id_subcategory = e($_POST['id_subcategory'],1,NULL);
    $id_negeri = $_SESSION['id_negeri'];
    $id_daerah = $_SESSION['id_daerah'];
    $id_masjid = $_SESSION['id_masjid'];
    $nama_produk = e($_POST['nama_produk'],1,NULL);
    $harga = e($_POST['harga'],1,NULL);
    $description = e($_POST['description'],1,NULL);
    $address = e($_POST['address'],1,NULL);
    $kuantiti = e($_POST['kuantiti'],1,NULL);
    $image= $_FILES['image']['tmp_name'];
    $img = base64_encode(file_get_contents($image));

    // Proses upload image file jika ada input
    if(strlen($img) > 20) {
        $handle = new Upload('base64:'.$img);

        // Kalau jenis fail image, resize dahulu
        if(strpos($handle->file_src_mime, 'image') !== false) {
            $handle->image_resize = true;
            $handle->image_x = 1000;
            $handle->image_y = 1000;
            $handle->image_ratio = true;
            $handle->image_convert = 'jpg';
        }
        $data = base64_encode($handle->process());
        $dataCol = "image,";
        $data_val = "'$data',";
    }

    $sql = "INSERT INTO products_ecomasjid(id_category, id_subcategory, id_negeri, id_daerah, id_masjid, nama_produk, harga, description, address, $dataCol kuantiti) 
                    VALUES ('$id_category','$id_subcategory','$id_negeri','$id_daerah','$id_masjid','$nama_produk','$harga','$description','$address', $data_val '$kuantiti')";

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
            <h4>Tambah Produk</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:history.back()">Dashboard EcoMasjid</a></li>
                    <li class="breadcrumb-item active">Tambah Produk</li>
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
                            <h5 class="m-t-30">Kategori Produk</h5>
                            <?php
                            $sql="SELECT id_category, category FROM category_ecomasjid WHERE id_category=1";

                            /* You can add order by clause to the sql statement if the names are to be displayed in alphabetical order */

                            echo "<select id=id_category class='form-control' data-style=form-control name=id_category value=''></option>"; // list box select command

                            foreach ($bd2->query($sql) as $row){//Array or records stored in $row

                                echo "<option value=$row[id_category]>$row[category]</option>";

                                /* Option values are added by looping through the array */

                            }
                            echo "</select>";// Closing of list box
                            ?>
                        </div>
                    <div class="md-4 mb-4">
                        <h5 class="m-t-30">Sub-kategori Produk</h5>
                        <?php
                        //$id = $_GET['cat'];
                        $sql2="SELECT * FROM ecomasjid_subcategory WHERE id_category=1";

                        /* You can add order by clause to the sql statement if the names are to be displayed in alphabetical order */

                        echo "<select id=id_subcategory class=form-control data-style=form-control name=id_subcategory value=''>Pilih Subkategori Produk</option>"; // list box select command

                        foreach ($bd2->query($sql2) as $row){//Array or records stored in $row

                            echo "<option value=$row[id_subcategory]>$row[subcategory]</option>";

                            /* Option values are added by looping through the array */
                        }
                        echo "</select>";// Closing of list box
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="nama_produk">Nama Produk <span class="help"></span></label>
                        <input type="text" id="nama_produk" name="nama_produk" class="form-control" value="<?php echo($nama_produk);?>"/>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga Produk</label>
                        <div class="input-group-prepend">
                        <span class="input-group-text">RM</span><span class="input-group-text">0.00</span>
                        <input type="text" id="harga" name="harga" class="form-control" value="<?php echo ($harga); ?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Gambar</label>
                        <input id="image" name="image" type="file" class="form-control" accept=".jpg,.gif,.png,.jpeg" onchange="preview_image(event, 'output1')" />
                        <img class="img-fluid p-3" id="output1" style="max-height: 480px">
                    </div>
                    <div class="form-group">
                        <label>Kuantiti</label>
                        <input id="kuantiti" name="kuantiti" type="number" class="form-control" value="<?php echo($kuantiti);?>" />
                    </div>
                    <div class="form-group">
                        <label>Penerangan Produk</label>
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
                            <button type="button" class="btn btn-block btn-lg btn-danger" onclick="location.href='utama.php?view=admin&action=gomasjidpro&page=ecomasjid_dashboard'">BATAL</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

