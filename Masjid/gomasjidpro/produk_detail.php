<?php

$id = $_GET['prod'];
$query = "SELECT a.id_category, a.id_subcategory, a.id_negeri, a.id_daerah, a.id_masjid, a.nama_produk, a.harga, a.description,
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
        <h4>Senarai Produk</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:history.back()">Dashboard EcoMasjid</a></li>
                <li class="breadcrumb-item"><a href="utama.php?view=admin&action=gomasjidpro&page=ecomasjid_list_produk">Senarai Produk</a></li>
                <li class="breadcrumb-item active">Butiran Produk</li>
            </ol>
        </div>
    </div>
</div>
<div class="row">
    <div class="content-header">
    </div>
    <div class="col-sm-12">
        <div class="card card-body">
            <form id="detail_produk" name="detail_produk" method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">
                <div class="md-4">
                <div class="form-group">
                    <label for="id_category">Kategori Produk</label>
                    <input type="text" id="id_category" name="id_category" class="form-control" value="<?php echo $row['id_category'];?>" />
                </div>
                <div class="md-4 mb-4">
                    <label for="id_subcategory">Subkategori Produk</label>
                    <input type="text" id="id_subcategory" name="id_subcategory" class="form-control" value="<?php echo $row['id_subcategory'];?>" />
                </div>
                <div class="md-4 mb-4 ">
                    <div class="form-group">
                        <label for="id_negeri">ID Negeri</label>
                        <input type="text" id="id_negeri" name="id_negeri" class="form-control" value="<?php echo $row['id_negeri'];?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="id_daerah">ID Daerah <span class="help"></span></label>
                    <input type="text" id="id_daerah" name="id_daerah" class="form-control" value="<?php echo $row['id_daerah'];?>" />
                </div>
                <div class="form-group">
                    <label for="id_masjid">ID Masjid <span class="help"></span></label>
                    <input type="text" id="id_masjid" name="id_masjid" class="form-control" value="<?php echo $row['id_masjid'];?>" />
                </div>
                <div class="form-group">
                    <label for="nama_produk">Nama Produk <span class="help"></span></label>
                    <input type="text" id="nama_produk" name="nama_produk" class="form-control" value="<?php echo $row['nama_produk'] ;?>"/>
                </div>
                <div class="form-group">
                    <label for="harga">Harga RM </label>
                    <input type="text" id="harga" name="harga" class="form-control" value="<?php echo $row['harga'] ;?>"/>
                </div>
                <div class="form-group">
                    <label>Gambar</label>
                    <input id="image" name="image" type="file" class="form-control" value="<?php echo $row['data'];?>" />
                </div>
                <div class="form-group">
                    <label>Kuantiti</label>
                    <input id="kuantiti" name="kuantiti" type="number" class="form-control" value="<?php echo $row['kuantiti'];?>" />
                </div>
                <div class="form-group">
                    <label>Penerangan Produk</label>
                    <textarea id="description" name="description" class="form-control" rows="5"><?php echo $row['description'];?></textarea>
                </div>
                <div class="form-group">
                    <label for="address">Alamat <span class="help"></span></label>
                    <input type="text" id="address" name="address" class="form-control" value="<?php echo $row['address'];?>"/>
                </div>
                <div>
                    <button type="submit" class="btn btn-success mr-2">Hantar</button>
                    <button type="button" class="btn btn-dark" onclick="location.href='utama.php?view=admin&action=gomasjidpro&page=ecomasjid_dashboard'">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
