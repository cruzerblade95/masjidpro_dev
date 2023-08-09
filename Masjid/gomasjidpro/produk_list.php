<?php

$query = "SELECT id_produk, image, id_subcategory, nama_produk, harga FROM products_ecomasjid WHERE id_masjid=$_SESSION[id_masjid] AND id_subcategory = 1 OR id_subcategory= 2";
$result = mysqli_query($bd2, $query) or die ("Error:".mysqli_error($bd2));

?>

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4>Senarai Produk</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:history.back()">Dashboard EcoMasjid</a></li>
                <li class="breadcrumb-item"><a href="utama.php?view=admin&action=gomasjidpro&page=ecomasjid_add_produk">Tambah produk</a></li>
                <li class="breadcrumb-item active">Senarai produk</li>
            </ol>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data Export</h4>
                <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>
                <div class="table-responsive m-t-40">
                    <table class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>ID Produk</th>
                            <!--<th>Gambar</th>-->
                            <th>Nama Produk</th>
                            <th>Harga (RM)</th>
                            <th>Subkategori</th>
                            <th class="text-end text-center">Pilihan</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php for($i = 0; $i < mysqli_num_rows($result); $i++){ ?>
                                <?php while($query_row = mysqli_fetch_assoc($result)){ ?>

                        <tr>
                            <td><?php echo $query_row['id_produk']; ?></td>
                            <!--<td><div class="left"><?php echo $query_row['image']; ?></div></td>-->
                            <td><span><?php echo $query_row['nama_produk']; ?></span></td>
                            <td><span><?php echo $query_row['harga']; ?></span></td>
                            <td><span><?php echo $query_row['id_subcategory']; ?></span></td>
                            <td class="text-end">
                                <a href="utama.php?view=admin&action=gomasjidpro&page=ecomasjid_detail_produk?prod=<?php echo $query_row['id']?>" class="btn btn-outline-success waves-effect waves-light" title="Butiran Produk"> <i class="far fa-user"></i></a>
                                <a href="utama.php?view=admin&action=gomasjidpro&page=ecomasjid_edit_produk?prod=<?php echo $query_row['id']?>" class = "btn btn-outline-info waves-effect waves-light" title="Kemaskini Produk"><i class=" far fa-edit"></i></a>
                                <a href="utama.php?view=admin&action=gomasjidpro&page=ecomasjid_delete_produk?prod=<?php echo $query_row['id']?>" class="btn btn-outline-danger waves-effect waves-light" title="Padam Produk"> <i class="far fa-trash-alt"></i></a>
                            </td>
                        </tr>
                             <?php
                                }
                             ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    }
?>