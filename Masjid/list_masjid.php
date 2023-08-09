<?php
include 'connection/connection.php';

$poskod = $_GET['poskod'];

if($poskod != NULL) {
    $q = "SELECT * FROM sej6x_data_masjid WHERE poskod = '$poskod'";
    $qq = mysqli_query($bd2, $q) or die(mysqli_error($bd2));
    $q_row = mysqli_fetch_assoc($qq);
    $q_num = mysqli_num_rows($qq);
}
?>
<!--meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.css" integrity="sha512-6g9IGCc67eh+xK03Z8ILcnKLbJnKBW+qpEdoUVD/4hBa2Ghiq5dQgeNOGWJfGoe9tdCRM4GpJMnsRXa2FDJp9Q==" crossorigin="anonymous" /-->
    <script>
        eval(document.getElementById('form_ajax').innerHTML);
        get_ajax('list_masjid&../list_masjid.php', '#isi', 'tunggu');
    </script>
    <div class="container-fluid">
<form role="form" class="form-validate form-horizontal well" id="list_masjid" name="list_masjid" action2="<?php echo($_SERVER['PHP_SELF']); ?>" method2="get" enctype="multipart/form-data">
    <div class="row form-group">
        <div class="col-12 col-md-auto form-group">
            <label>Masukkan Poskod Masjid</label>
            <input class="form-control" required type="number" id="poskod" name="poskod" value="<?php echo($poskod); ?>" max="99999" maxlength="5" minlength="5">
        </div>
        <div class="col-12 col-md-12 form-group">
            <button class="btn btn-primary" type="submit">Lihat Masjid Terdekat</button>
        </div>
    </div>
</form>
<?php if($q_num > 0) { ?>
    <div class="row form-group">
        <?php $i=1; do { ?>
            <div class="col-12 col-md-4 form-group">
                <div class="card">
                    <h5 class="card-header"><?php echo($q_row['nama_masjid']); ?></h5>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo($q_row['alamat_masjid']); ?></h5>
                        <p class="card-text"><?php echo($q_row['poskod']); ?></p>
                        <a href="../daftar_online/pendaftaran.php?id_masjid=<?php echo($q_row['id_masjid']); ?>"><button class="btn btn-primary btn-block" type="button">Daftar</button></a>
                    </div>
                </div>
            </div>
            <?php $i++; } while($q_row = mysqli_fetch_assoc($qq)); ?>
    </div>
<?php } if(($q_num == 0 || $q_num == NULL) && strpos($_SERVER['REQUEST_URI'], 'poskod') !== false) { ?>
<div class="row">
    <div class="col-12 col-md-12">
        <div class="alert alert-danger" role="alert">Tiada senarai masjid dijumpai!</div>
    </div>
</div>
<?php } ?>
</div>
    <!--script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js" integrity="sha512-WNLxfP/8cVYL9sj8Jnp6et0BkubLP31jhTG9vhL/F5uEZmg5wEzKoXp1kJslzPQWwPT1eyMiSxlKCgzHLOTOTQ==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.4.4/umd/popper.js" integrity="sha512-3npORiJBjCw8YewByo9prUHQKH+JF9EGu6rc2IQA3GdV/V5TUo1JibA3g3jAeNOdToEh2rHkhswWJcOo6ljuPQ==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.js" integrity="sha512-VtmdOFNyOniRUIHzkfL4GAe+yuAhoWzJIWYW/9elcd+7zNu12OKscWFIe9PRQ6VBy4djrwGVzK6MLD3oTpLpRQ==" crossorigin="anonymous"></script>
    <script src="vendors/datatable/datatables.js"></script-->
<?php //include("ajax_functions.php"); ?>