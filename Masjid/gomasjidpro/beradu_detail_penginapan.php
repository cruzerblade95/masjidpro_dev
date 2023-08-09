<?php

$id = $_GET['beradu'];
$query = "SELECT a.id_produk, a.id_category, a.id_subcategory, a.id_negeri, a.id_daerah, a.id_masjid, a.nama_produk, a.harga, a.description,
a.address, a.image, a.kuantiti, b.id_category,b.category,c.id_subcategory, c.subcategory
FROM products_ecomasjid a, category_ecomasjid b,ecomasjid_subcategory c
WHERE a.id_produk = '".$id."'
AND a.id_category = b.id_category
AND a.id_subcategory = c.id_subcategory";

$result = mysqli_query($bd2, $query);
$row = mysqli_fetch_assoc($result);

if(!$result){
    echo "Can't retrieve data " . mysqli_error($bd2);
    exit;
}
?>

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4>Butiran Penginapan</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:history.back()">Dashboard Beradu</a></li>
                <li class="breadcrumb-item"><a href="utama.php?view=admin&action=gomasjidpro&page=beradu_list_penginapan">Senarai Penginapan</a></li>
                <li class="breadcrumb-item active">Butiran Penginapan</li>
            </ol>
        </div>
    </div>
</div>
<div class="row">
    <div class="content-header">
    </div>
    <div class="col-sm-12">
        <div class="card card-body">
            <form id="detail_beradu" name="detail_beradu" method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">
                <div class="md-4">
                    <div class="form-group">
                        <label for="id_category">Kategori Penginapan</label>
                        <input type="text" id="id_category" name="id_category" class="form-control" value="<?php echo $row['id_category'];?>" readonly/>
                    </div>
                    <div class="md-4 mb-4">
                        <label for="id_subcategory">Sub-kategori Penginapan</label>
                        <input type="text" id="id_subcategory" name="id_subcategory" class="form-control" value="<?php echo $row['id_subcategory'];?>" readonly/>
                    </div>
                    <div class="form-group">
                        <label for="nama_produk">Nama Penginapan <span class="help"></span></label>
                        <input type="text" id="nama_produk" name="nama_produk" class="form-control" value="<?php echo $row['nama_produk'] ;?>" readonly/>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga Penginapan</label>
                        <div class="input-group-prepend">
                            <span class="input-group-text">RM</span><span class="input-group-text">0.00</span>
                            <input type="text" id="harga" name="harga" class="form-control" value="<?php echo $row['harga'] ;?>" readonly/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Penerangan Penginapan</label>
                        <textarea id="description" name="description" class="form-control" rows="5" readonly><?php echo $row['description'];?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="address">Alamat <span class="help"></span></label>
                        <input type="text" id="address" name="address" class="form-control" value="<?php echo $row['address'];?>" readonly/>
                    </div>
                    <div class="form-group">
                        <label>Gambar</label>
                        <input id="image" name="image" type="file" class="form-control" accept=".jpg,.gif,.png,.jpeg" onchange="preview_image(event, 'output1')" readonly/>
                        <img class="img-fluid p-3" id="output1" style="max-height: 480px" src="data:image/jpeg;base64,<?php echo $row['image'];?>">
                    </div>
            </form>
        </div>
    </div>
</div>


