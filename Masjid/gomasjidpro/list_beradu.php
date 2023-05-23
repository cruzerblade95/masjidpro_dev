<?php
$query = "SELECT * FROM beradu_room WHERE id_room=$_SESSION[id_masjid]";
$result = mysqli_query($bd2, $query);

if(!$result){
    echo "Can't retrieve data " . mysqli_error($bd2);
    exit;
}
?>

<section class="content-main">
    <div class="content-header">
        <div class="row">
            <div class="content-header">
                <a href="javascript:history.back()"><i class="material-icons md-arrow_back"></i> Kembali </a>
            </div>
            <h2 class="content-title">Senarai Beradu</h2>
            <div class="col-lg-9">
                <a href="utama.php?view=admin&action=gomasjidpro&page=ecomasjid_add_beradu" class="btn btn-primary"><i class="material-icons md-plus"></i>Tambah Produk</a>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>ID Produk</th>
                <th>Gambar Produk</th>
                <th>Nama Produk</th>
                <th>Alamat</th>
                <th>Rating</th>
                <th class="text-end">Pilihan</th>
            </tr>
            </thead>
            <tbody>
            <?php for($i = 0; $i < mysqli_num_rows($result); $i++){ ?>
            <?php while($query_row = mysqli_fetch_assoc($result)){ ?>
            <tr>
                <td><?php echo $query_row['id_produk']; ?></td>
                <td width="10%">
                    <div class="left">
                        <?php

                        // Define the Base64 value you need to save as an image
                        $b64 = $query_row['image'];

                        // Obtain the original content (usually binary data)
                        $bin = base64_decode($b64);

                        // Load GD resource from binary data
                        $im = imageCreateFromString($bin);

                        // Make sure that the GD library was able to load the image
                        // This is important, because you should not miss corrupted or unsupported images
                        if (!$im) {
                            die('Base64 value is not a valid image');
                        }

                        // Specify the location where you want to save the image
                        //$img_file = '/files/images/filename.png';

                        // Save the GD resource as PNG in the best possible quality (no compression)
                        // This will strip any metadata or invalid contents (including, the PHP backdoor)
                        // To block any possible exploits, consider increasing the compression level
                        //imagepng($im, $img_file, 0);
                        ?>


                        <img src="assets/imgs/people/<?php echo $im;?>" class="img-sm img-avatar" alt="Userpic" />
                    </div>
                </td>
                <td><?php echo $query_row['nama_produk']; ?></td>
                <td><?php echo $query_row['address']; ?></td>
                <td><?php echo $query_row['rating']; ?></td>
                <td class="text-end">
                    <a href="utama.php?view=admin&action=gomasjidpro&page=butiran_room&prod=<?php echo $query_row['id_produk']?>" class="btn btn-sm font-sm btn-outline-success rounded text-hover-grey-5" title="Butiran Beradu"> <i class="material-icons md-read_more"></i></a>
                    <a href="utama.php?view=admin&action=gomasjidpro&page=update_beradu&prod=<?php echo $query_row['id_produk']?>" class = "btn btn-sm font-sm btn-outline-info rounded text-hover-grey-5" title="Kemaskini Maklumat Beradu"><i class="material-icons md-edit"></i></a>
                    <a href="utama.php?view=admin&action=gomasjidpro&page=delete_beradu&prod=<?php echo $query_row['id_produk']?>" class="btn btn-sm font-sm btn-outline-danger rounded text-hover-grey-5" title="Padam Beradu"> <i class="material-icons md-delete_forever"></i></a>
                </td>
            </tr>
    </div>
    <?php
    }
    ?>
    </tbody>
    </table>
    <!-- table-responsive.// -->
    </div>
    </div>
    <?php
    }
    ?>
</section>