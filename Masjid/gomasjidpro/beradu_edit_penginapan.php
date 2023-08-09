<?php
namespace Verot\Upload;
include($_SERVER['DOCUMENT_ROOT']."/Masjid/Classes/phpUpload/class.upload.php");

// Masukkan backend PHP/Mysql di bahagian sini

if($_SERVER['REQUEST_METHOD'] == "POST" ) {
    $id_produk = $_POST['id_produk'];
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
        $data_val = "image = '$data',";
    }

    $sql = "UPDATE products_ecomasjid 
SET id_category = '$id_category', 
    id_subcategory = '$id_subcategory', 
    id_negeri = '$id_negeri',
    id_daerah = '$id_daerah', 
    id_masjid = '$id_masjid',
    nama_produk = '$nama_produk',
    harga = '$harga',
    description = '$description',
    address = '$address', 
    $data_val
    kuantiti = '$kuantiti' 
WHERE id_produk = '$id_produk' ";

    $sql1 = mysqli_query($bd2,$sql) or die("sql error".$sql . mysqli_error($bd2));

    $test=$sql1;
    if($test)
    {
        echo "<script>document.location.href='utama.php?view=admin&action=gomasjidpro&page=beradu_list_penginapan'</script>";
    }
    else
    {
        echo mysqli_error();
    }
}

// Tak perlu redirection sebab proses di page yang sama untuk method POST melainkan nk redirect ke page yang lain.

$id_produk = $_GET['beradu'];
$query = "SELECT id_category, id_subcategory, id_negeri, id_daerah, id_masjid, nama_produk, harga, description,
address, image, kuantiti FROM products_ecomasjid WHERE id_produk = '".$id_produk."'";

$result = mysqli_query($bd2, $query);
$row = mysqli_fetch_assoc($result);

if(!$result){
    echo "Can't retrieve data " . mysqli_error($bd2);
    exit;
}
?>
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4>Kemaskini Penginapan</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:history.back()">Dashboard Beradu</a></li>
                <li class="breadcrumb-item"><a href="utama.php?view=admin&action=gomasjidpro&page=beradu_list_penginapan">Senarai Penginapan</a></li>
                <li class="breadcrumb-item active">Kemaskini Penginapan</li>
            </ol>
        </div>
    </div>
</div>
<div class="row">
    <div class="content-header">
    </div>
    <div class="col-sm-12">
        <div class="card card-body">
            <form id="edit_produk" name="edit_produk" method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">
                <div class="form-group">
                    <label for="id_category">Kategori Penginapan</label>
                    <input type="text" id="id_category" name="id_category" class="form-control" value="<?php echo $row['id_category'];?>" readonly/>
                </div>
                <div class="form-group">
                    <label for="id_subcategory">Sub-kategori Penginapan</label>
                    <input type="text" id="id_subcategory" name="id_subcategory" class="form-control" value="<?php echo $row['id_subcategory'];?>" readonly/>
                </div>
                <div class="form-group">
                    <label for="nama_produk">Nama Penginapan <span class="help"></span></label>
                    <input type="text" id="nama_produk" name="nama_produk" class="form-control" value="<?php echo $row['nama_produk'] ;?>" />
                </div>
                <div class="form-group">
                    <label for="harga">Harga Penginapan</label>
                    <div class="input-group-prepend">
                        <span class="input-group-text">RM</span><span class="input-group-text">0.00</span>
                        <input type="text" id="harga" name="harga" class="form-control" value="<?php echo $row['harga'] ;?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label>Penerangan Penginapan</label>
                    <textarea id="description" name="description" class="form-control" rows="5"><?php echo $row['description'];?></textarea>
                </div>
                <div class="form-group">
                    <label for="address">Alamat <span class="help"></span></label>
                    <input type="text" id="address" name="address" class="form-control" value="<?php echo $row['address'];?>"/>
                </div>
                <div class="form-group">
                    <label>Gambar</label>
                    <input id="image" name="image" type="file" class="form-control" accept=".jpg,.gif,.png,.jpeg" onchange="preview_image(event, 'output1')" />
                    <img class="img-fluid p-3" id="output1" style="max-height: 480px" src="data:image/jpeg;base64,<?php echo $row['image'];?>">
                </div>
                <div class="form-group">
                    <input type="hidden" name="id_produk" value="<?php echo($id_produk); ?>">
                    <button type="submit" class="btn btn-success mr-2">Hantar</button>
                    <button type="button" class="btn btn-dark" onclick="location.href='utama.php?view=admin&action=gomasjidpro&page=beradu_list_penginapan'">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
