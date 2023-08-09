<?php

$id = $_GET['beradu_room'];
$query = "SELECT *
FROM products_ecomasjid 
WHERE id_produk = '".$id."'";


$cat = "SELECT a.id_category, b.id_category, b.category
                            FROM products_ecomasjid a, category_ecomasjid b
                            WHERE a.id_category = b.id_category";

$rcat = mysqli_query($bd2, $cat);
$r2 = mysqli_fetch_assoc($rcat);


$result = mysqli_query($bd2, $query);
$row = mysqli_fetch_assoc($result);


if(!$result){
    echo "Can't retrieve data " . mysqli_error($bd2);
    exit;
}
?>


<section>
    <div class="row">
        <div class="content-header">
            <a href="javascript:history.back()"><i class="material-icons md-arrow_back"></i> Kembali </a>
        </div>
        <div class="col-sm-12">
            <div class="card card-body">
                <h4 class="card-title">Beradu</h4>
                <h5 class="card-subtitle"> Butiran Beradu </h5>
                <form name="add_produk" class="form-horizontal mt-4">
                    <div class="md-4">
                        <div class="form-group">

                            <label for="id_room">Id Room</label>
                            <input type="text" id="id_room" name="id_room" class="form-control" value="<?php print ($r2['id_room']) ?>" readonly />
                        </div>
                        <div class="form-group">
                            <label for="id_produk">Id Produk</label>
                            <input type="text" id="id_produk" name="id_produk" class="form-control" value="<?php print ($row['id_produk']) ?>" readonly />
                        </div>
                        <div class="md-4 mb-4 ">
                            <div class="form-group">
                                <label for="room_type">Jenis Bilik</label>
                                <input type="text" id="room_type" name="room_type" class="form-control" value="<?php print ($row['room_type']) ?>" readonly />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="price">harga<span class="help"></span></label>
                            <input type="text" id="price" name="price" class="form-control" value="<?php print ($row['price']) ?>" readonly />
                        </div>
                        <div class="form-group">
                            <label for="room_image">Gambar Beradu<span class="help"></span></label>
                            <input type="text" id="room_image" name="room_image" class="form-control" value="<?php echo($row['room_image']) ?>" readonly />
                        </div>
                        <div class="form-group">
                            <label for="jumlah_bilik">Jumlah Bilik<span class="help"></span></label>
                            <input type="text" id="jumlah_bilik" name="jumlah_bilik" class="form-control" value="<?php print ($row['jumlah_bilik']) ?>" readonly/>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-success mr-2">Submit</button>
                            <button type="submit" class="btn btn-dark">Cancel</button>
                        </div>
                    </div>
            </div>
        </div>
</section>
