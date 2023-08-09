<?php

$id_masjid = $_SESSION['id_masjid'];

if($id_masjid!=6279){
    echo '<script>alert("GoMasjid Pro dalam proses pembangunan");window.location.href="utama.php?view=admin&action=utama";</script>';
}

$sql = "SELECT nama_produk, description, kuantiti, harga FROM products_ecomasjid
        WHERE id_masjid = '$id_masjid' ORDER BY id_category = 1";
$result = mysqli_query($bd2, $sql) or die ("Error:".mysqli_error($bd2));

$sql_count = "SELECT COUNT(*) AS jumlah FROM products_ecomasjid WHERE id_masjid = '$id_masjid' AND id_category=1";
$resultc= mysqli_query($bd2, $sql_count) or die ("Error:".mysqli_error($bd2));
$result_count = mysqli_fetch_assoc($resultc);

$sql_counta = "SELECT COUNT(*) AS jumlaha FROM products_ecomasjid WHERE id_masjid = '$id_masjid' AND id_category=2";
$resulta= mysqli_query($bd2, $sql_counta) or die ("Error:".mysqli_error($bd2));
$result_counta = mysqli_fetch_assoc($resulta);
?>
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h3>Dashboard GoMasjidPro</h3>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li class="active">Dashboard Gomasjidpro</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content mt-3">
    <div class="col-md-12">
        <div class="row">
            <!-- Column -->
            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <h3><?php echo $result_count['jumlah'] ?></h3>
                                <h6 class="card-subtitle">Jumlah Produk Ecomasjid Coop</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <h3><?php echo $result_counta['jumlaha'] ?></h3>
                                <h6 class="card-subtitle">Jumlah Produk Ecomasjid Beradu</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Senarai Produk Ecomasjid</h4>
                        <div class="table-responsive">
                            <table class="table stylish-table">
                                <thead>
                                <tr>
                                    <th>Penerangan</th>
                                    <th>Kuantiti</th>
                                    <th>Harga (RM)</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php for($i = 0; $i < mysqli_num_rows($result); $i++){ ?>
                                <?php while($query_row = mysqli_fetch_assoc($result)){ ?>
                                <tr>
                                    <td>
                                        <h6><?php echo $query_row['nama_produk']; ?></h6><small class="text-muted"><?php echo $query_row['description']; ?></small></td>
                                    <td>
                                        <h5><?php echo $query_row['kuantiti']; ?></h5></td>
                                    <td>
                                        <h5><?php echo $query_row['harga']; ?></h5></td>
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
    </div>
</div>