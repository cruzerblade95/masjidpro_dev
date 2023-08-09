<?php
$id_produk = mysqli_real_escape_string($bd2,$_POST['id_produk']);
$id_category =mysqli_real_escape_string($bd2,$_POST['id_category']);
$id_subcategory = mysqli_real_escape_string($bd2,$_POST['id_subcategory']);
$id_negeri = mysqli_real_escape_string($bd2,$_POST['id_negeri']);
$id_daerah = mysqli_real_escape_string($bd2,$_POST['id_daerah']);
$id_masjid = mysqli_real_escape_string($bd2,$_POST['id_masjid']);
$nama_produk = mysqli_real_escape_string($bd2,$_POST['nama_produk']);
$harga = mysqli_real_escape_string($bd2,$_POST['harga']);
$description = mysqli_real_escape_string($bd2,$_POST['description']);
$address = mysqli_real_escape_string($bd2,$_POST['address']);
$rating = mysqli_real_escape_string($bd2,$_POST['rating']);
$favorited = mysqli_real_escape_string($bd2,$_POST['favorited']);
$name= $_FILES['image']['name'];
$temp_name  = $_FILES['image']['tmp_name'];

if($_FILES["file"]["error"] > 0){
    echo "Return Code :".$_FILES["file"]["error"]."<br/>";
}

else
{
    if(file_exists("image/".$name) )
    {
        echo $name."already exists.<br/>";
    }

    else
    {
        move_uploaded_file($_FILES["image"]["tmp_name"],"image/".$name);
        echo "Stored in : "."image/".$name."<br/>";
    }
}

$sql = "INSERT INTO products_ecomasjid(id_category, id_subcategory, id_negeri, id_daerah, id_masjid, nama_produk, harga, description, address, rating, favorited, image) 
VALUES ('$id_category','$id_subcategory','$id_negeri','$id_daerah','$id_masjid','$nama_produk','$harga','$description','$rating','$favorited','$name')";
$sql1 = mysqli_query($bd2,$sql) or die("sql error".$sql . mysqli_error($bd2));
if($sql1){
    echo "<script type='text/javascript'>";
    echo "alert('1 Record Successfully Added!')";
    echo "</script>";
    echo"<meta http-equiv='refresh' content='0; url=#'>";
}
else{
    echo "<script type='text/javascript'>";
    echo "alert('NOTHING ADDED!')";
    echo "</script>";
    echo"<meta http-equiv='refresh' content='0; url=#'>";
}
?>


<section>
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-body">
                <h4 class="card-title">Produk EcoMasjid</h4>
                <h5 class="card-subtitle"> Tambah Produk EcoMasjid Baru </h5>
                <form class="form-horizontal mt-4">
                    <div class="col-md-4">
                        <h5 class="m-t-30">Kategori Produk</h5>
                        <?php
                        $sql="SELECT id_category, category FROM category_ecomasjid order by category";

                        /* You can add order by clause to the sql statement if the names are to be displayed in alphabetical order */

                        echo "<select id=category class=selectpicker data-style=form-control btn-secondary name=category value=''>Pilih Kategori Produk</option>"; // list box select command

                        foreach ($bd2->query($sql) as $row){//Array or records stored in $row

                            echo "<option value=$row[id_category]>$row[category]</option>";

                            /* Option values are added by looping through the array */

                        }
                        echo "</select>";// Closing of list box
                        ?>
                    </div>
                    <div class="col-md-4">
                        <h5 class="m-t-30">Subkategori Produk</h5>
                        <?php
                        $id = $_GET('cat');
                        $sql2="SELECT * FROM ecomasjid_subcategory order by subcategory";

                        /* You can add order by clause to the sql statement if the names are to be displayed in alphabetical order */

                        echo "<select id=subcategory class=selectpicker multiple data-style=form-control btn-secondary name=subcategory value=''>Pilih Subkategori Produk</option>"; // list box select command

                        foreach ($bd2->query($sql2) as $row){//Array or records stored in $row

                            echo "<option value=$row[id_subcategory]>$row[subcategory]</option>";

                            /* Option values are added by looping through the array */
                        }
                        echo "</select>";// Closing of list box
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="id_negeri">ID Negeri <span class="help"></span></label>
                        <input type="text" id="id_negeri" name="id_negeri" class="form-control" value="<?php echo $_SESSION['id_negeri'];?>" />
                    </div>
                    <div class="form-group">
                        <label for="id_daerah">ID Masjid <span class="help"></span></label>
                        <input type="text" id="id_daerah" name="id_daerah" class="form-control" value="<?php echo $_SESSION['id_daerah'];?>" />
                    </div>
                    <div class="form-group">
                        <label for="id_masjid">ID Masjid <span class="help"></span></label>
                        <input type="text" id="id_masjid" name="id_masjid" class="form-control" value="<?php echo $_SESSION['id_masjid'];?>" />
                    </div>
                    <div class="form-group">
                        <label for="nama_produk">Nama Produk <span class="help"></span></label>
                        <input type="text" id="nama_produk" name="nama_produk" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga RM <span class="help"></span></label>
                        <input type="text" id="harga" name="harga" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Gambar</label>
                        <input type="text" class="form-control" name="image" id="image">
                    </div>
                    <div class="form-group">
                        <label>Rating</label>
                        <input type="text" class="form-control" name="rating" id="rating">
                    </div>
                    <div class="form-group">
                        <label>Favorited</label>
                        <input type="text" class="form-control" name="favorited" id="favorited">
                    </div>
                    <div class="form-group">
                        <label>Kuantiti</label>
                        <input type="int" class="form-control" name="kuantiti" id="kuantiti">
                    </div>
                    <div class="form-group">
                        <label>Penerangan Produk</label>
                        <textarea id="description" name="description" class="form-control" rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="address">Alamat <span class="help"></span></label>
                        <input type="text" id="address" name="address" class="form-control"/>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-success mr-2">Submit</button>
                        <button type="submit" class="btn btn-dark">Cancel</button>
                    </div>
            </div>
        </div>
    </div>
</section>
