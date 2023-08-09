<?php

$id_booking = $_GET['booking'];
$id_masjid = $_SESSION['id_masjid'];

$sql = "SELECT id_booking, id_user, id_masjid, id_produk, id_room, check_in, check_out FROM beradu_booking WHERE id_booking='$id_booking' AND id_masjid = '$id_masjid'";
$result = mysqli_query($bd2, $sql);
$row = mysqli_fetch_assoc($result);

if(!$result){
    echo "Can't retrieve data " . mysqli_error($bd2);
    exit;
}

?>
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4>Butiran Tempahan</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:history.back()">Dashboard Beradu</a></li>
                <li class="breadcrumb-item"><a href="utama.php?view=admin&action=gomasjidpro&page=beradu_urus_tempahan">Urus Tempahan</a></li>
                <li class="breadcrumb-item active">Butiran Tempahan</li>
            </ol>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="card card-body">
            <form id="detail_tempahan" name="detail_tempahan" method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">
                <div class="md-4">
                    <div class="form-group">
                        <label for="id_booking">ID Tempahan</label>
                        <input type="number" id="id_booking" name="id_booking" class="form-control" value="<?php echo $row['id_booking'];?>" readonly/>
                    </div>
                    <div class="md-4 mb-4">
                        <label for="id_user">ID Pengguna</label>
                        <input type="number" id="id_user" name="id_user" class="form-control" value="<?php echo $row['id_user'];?>" readonly/>
                    </div>
                    <div class="md-4 mb-4 ">
                        <div class="form-group">
                            <label for="id_produk">ID Penginapan</label>
                            <input type="number" id="id_produk" name="id_produk" class="form-control" value="<?php echo $row['id_produk'];?>" readonly/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="id_bilik">ID Bilik <span class="help"></span></label>
                        <input type="number" id="id_bilik" name="id_bilik" class="form-control" value="<?php echo $row['id_room'];?>" readonly/>
                    </div>
                    <div class="form-group">
                        <label for="check_in">Tarikh Daftar Masuk <span class="help"></span></label>
                        <input type="text" id="check_in" name="check_in" class="form-control" value="<?php echo $row['check_in'];?>" readonly/>
                    </div>
                    <div class="form-group">
                        <label for="check_out">Tarikh Daftar Keluar<span class="help"></span></label>
                        <input type="text" id="check_out" name="check_out" class="form-control" value="<?php echo $row['check_out'] ;?>" readonly/>
                    </div>
            </form>
        </div>
    </div>
</div>