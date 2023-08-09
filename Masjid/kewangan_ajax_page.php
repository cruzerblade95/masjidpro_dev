<!-- Page Add Jenis Vendor -->
<?php if($_GET['data'] == 'raw' && $_GET['module'] == 'add_jenis_vendor') {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_kategori_akaun = $_POST['id_kategori_akaun'];
        $jenis_akaun = $_POST['jenis_akaun'];
        $kategori_akaun = e($_POST['kategori_akaun'], 1, NULL);
        $id_masjid_akaun = $_POST['id_masjid_akaun'];

        if($id_kategori_akaun != NULL) $q_post = "UPDATE kew_kategori_akaun SET cat_vendor = 1, jenis_akaun = $jenis_akaun, kategori_akaun = '$kategori_akaun', id_masjid_akaun = $id_masjid WHERE id_kategori_akaun = $id_kategori_akaun";
        if($id_kategori_akaun == NULL) $q_post = "INSERT INTO kew_kategori_akaun (cat_vendor, jenis_akaun, kategori_akaun, id_masjid_akaun) VALUES (1, $jenis_akaun, '$kategori_akaun', $id_masjid)";
        mysqli_query($bd2, $q_post) or die(mysqli_error($bd2));
        echo "<script>
	jQuery('#exampleModal').modal('show');
	jQuery('#exampleModalLabel').html('Tambah Jenis Pendapatan / Perbelanjaan');
	jQuery('#badan').html('Jenis Pendapatan / Perbelanjaan <strong>".$kategori_akaun."</strong> Berjaya Ditambah / Dikemaskini');
	</script>";
    }

    if ($_SERVER["REQUEST_METHOD"] != "POST") $id_kategori_akaun = $_GET['id_kategori_akaun'];
    if ($id_kategori_akaun != NULL)	{
        $q = "SELECT * FROM kew_kategori_akaun WHERE id_kategori_akaun = $id_kategori_akaun";
        $qq = mysqli_query($bd2, $q) or die(mysqli_error($bd2));
        $q_row = mysqli_fetch_assoc($qq);
        $q_tot = mysqli_num_rows($qq);

        $id_kategori_akaun = $q_row['id_kategori_akaun'];
        $jenis_akaun = $q_row['jenis_akaun'];
        $kategori_akaun = $q_row['kategori_akaun'];
        $id_masjid_akaun = $q_row['id_masjid_akaun'];
    }

    $id_masjid = $_SESSION['id_masjid'];
    $reff = $_SESSION['username'];
    ?>
    <form role="form" class="form-validate form-horizontal well" name="<?php echo($_GET['module']); ?>" id="<?php echo($_GET['module']); ?>" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6 col-12 form-group">
                <?php
                $q = "SELECT id_kew_akaun 'id', kew_akaun 'val' FROM kew_akaun WHERE id_kew_akaun IN (1, 2)";
                pilihanBijak($q, 'select', 'jenis_akaun', 'Jenis Akaun', 'required', $jenis_akaun, NULL);
                ?>
            </div>
            <div class="col-md-6 col-12 form-group">
                <label for="nama_vendor">Jenis Pendapatan / Perbelanjaan</label>
                <input type="text" id="kategori_akaun" name="kategori_akaun" class="form-control" value="<?php echo($kategori_akaun); ?>" required>
            </div>
            <div class="col-md-6 col-12 form-group"><button type="submit" class="btn btn-primary">Simpan</button></div>
        </div>
        <input type="hidden" id="id_kategori_akaun" name="id_kategori_akaun" value="<?php echo($id_kategori_akaun); ?>">
        <input type="hidden" id="id_masjid_akaun" name="id_masjid" value="<?php echo($id_masjid_akaun); ?>">
    </form>
<?php } ?>

<!-- Page List Jenis Vendor -->
<?php if($_GET['data'] == 'raw' && $_GET['module'] == 'list_jenis_vendor') {
    $id_masjid = $_SESSION['id_masjid'];

    if($_GET['mode'] == 'padam' && $_GET['id_kategori_akaun'] != NULL) {
        $id_kategori_akaun = $_GET['id_kategori_akaun'];
        $q_del = "DELETE FROM kew_kategori_akaun WHERE id_kategori_akaun = $id_kategori_akaun AND id_masjid_akaun = $id_masjid";
        mysqli_query($bd2, $q_del) or die(mysqli_error($bd2));
        echo "<script>
	jQuery('#exampleModal').modal('show');
	jQuery('#exampleModalLabel').html('Padam Jenis Vendor');
	jQuery('#badan').html('Jenis Vendor Berjaya Dipadam');
	</script>";
    }

    $q = "SELECT a.id_kategori_akaun 'id_kategori_akaun', a.kategori_akaun 'kategori_akaun', b.kew_akaun 'kategori' FROM kew_kategori_akaun a, kew_akaun b WHERE a.jenis_akaun = b.id_kew_akaun AND a.id_masjid_akaun = $id_masjid ORDER BY b.kew_akaun ASC, a.kategori_akaun ASC";
    $qq = mysqli_query($bd2, $q) or die(mysqli_error($bd2));
    $q_row = mysqli_fetch_assoc($qq);
    $q_tot = mysqli_num_rows($qq);
    ?>
    <script>
        eval(document.getElementById("pdf_var").innerHTML);
        nama_masjid = '<?php echo($_SESSION['nama_masjid']); ?>'
        tajuk_dokumen = 'Senarai Jenis Vendor';
        eval(document.getElementById("pdf_sekerip").innerHTML);
    </script>
    <div class="row">
        <div class="col-12 col-md-12" align="center">
            <h4><?php echo($_SESSION['nama_masjid']); ?></h4>
            <h4>Senarai Jenis Pendapatan / Perbelanjaan</h4>
        </div>
    </div>
    <div class="row table-responsive">
        <table id="meja_akaun" width="100%" data-order="[]" class="table table-bordered table-hover display nowrap margin-top-10 w-p100 table-striped">
            <thead><tr>
                <th scope="col"><div align="center">Bil</div></th>
                <th><div align="center">Jenis Pendapatan / Perbelanjaan</div></th>
                <th><div align="center">Kategori</div></th>
                <th><div align="center">Tindakkan</div></th>
            </tr></thead>
            <tbody>
            <?php $i=1; do { ?>
                <tr>
                    <td><div align="center"><?php echo($i); ?></div></td>
                    <td><?php echo($q_row['kategori_akaun']); ?></td>
                    <td><?php echo($q_row['kategori']); ?></td>
                    <td align="center">
                        <button type="button" class="btn btn-primary" onclick="page_ajax('add_jenis_vendor&id_kategori_akaun=<?php echo($q_row['id_kategori_akaun']); ?>', '#module_jenis_vendor', 'tunggu_vendor')">Lihat</button>
                        <button type="button" class="btn btn-danger" onclick="if(confirm('Padam Rekod <?php echo addslashes($q_row['kategori_akaun']); ?>?')) page_ajax('list_jenis_vendor&id_kategori_akaun=<?php echo($q_row['id_kategori_akaun']); ?>&mode=padam', '#module_jenis_vendor', 'tunggu_vendor')">Padam</button>
                    </td>
                </tr>
                <?php $i++; } while($q_row = mysqli_fetch_assoc($qq)); ?>
            </tbody>
        </table>
    </div>
<?php } ?>

<!-- Page Add Vendor -->
<?php if($_GET['data'] == 'raw' && $_GET['module'] == 'add_vendor') {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_vendor = $_POST['id_vendor'];
        $jenis_vendor = $_POST['jenis_vendor'];
        $nama_vendor = strtoupper(mysqli_real_escape_string($bd2, $_POST['nama_vendor']));
        $ic_id = strtoupper(mysqli_real_escape_string($bd2, $_POST['ic_id']));
        $alamat = strtoupper(mysqli_real_escape_string($bd2, $_POST['alamat']));
        $no_phone = strtoupper(mysqli_real_escape_string($bd2, $_POST['no_phone']));
        $id_masjid = $_POST['id_masjid'];
        $reff = mysqli_real_escape_string($bd2, $_POST['reff']);

        if($id_vendor != NULL) $q_post = "UPDATE kew_vendor SET jenis_vendor = $jenis_vendor, nama_vendor = '$nama_vendor', ic_id = '$ic_id', alamat = '$alamat', no_phone = '$no_phone', id_masjid = $id_masjid, reff = '$reff' WHERE id_vendor = $id_vendor";
        if($id_vendor == NULL) $q_post = "INSERT INTO kew_vendor (jenis_vendor, nama_vendor, ic_id, alamat, no_phone, id_masjid, reff) VALUES ($jenis_vendor, '$nama_vendor', '$ic_id', '$alamat', '$no_phone', $id_masjid, '$reff')";
        mysqli_query($bd2, $q_post) or die(mysqli_error($bd2));
        echo "<script>
	jQuery('#exampleModal').modal('show');
	jQuery('#exampleModalLabel').html('Tambah Vendor');
	jQuery('#badan').html('Maklumat Vendor / Organisasi / Individu <strong>".$nama_vendor."</strong> Berjaya Ditambah / Dikemaskini');
	</script>";
    }

    if ($_SERVER["REQUEST_METHOD"] != "POST") $id_vendor = $_GET['id_vendor'];
    if ($id_vendor != NULL)	{
        $q = "SELECT * FROM kew_vendor WHERE id_vendor = $id_vendor";
        $qq = mysqli_query($bd2, $q) or die(mysqli_error($bd2));
        $q_row = mysqli_fetch_assoc($qq);
        $q_tot = mysqli_num_rows($qq);

        $jenis_vendor = $q_row['jenis_vendor'];
        $nama_vendor = $q_row['nama_vendor'];
        $ic_id = $q_row['ic_id'];
        $alamat = $q_row['alamat'];
        $no_phone = $q_row['no_phone'];
    }

    $id_masjid = $_SESSION['id_masjid'];
    $reff = $_SESSION['username'];
    ?>
    <form role="form" class="form-validate form-horizontal well" name="<?php echo($_GET['module']); ?>" id="<?php echo($_GET['module']); ?>" enctype="multipart/form-data"><div class="row">
            <div class="col-md-6 col-12 form-group">
                <?php
                $q = "SELECT id_kategori_akaun 'id', kategori_akaun 'val' FROM kew_kategori_akaun WHERE (cat_vendor = 1 AND id_masjid_akaun IS NULL) OR id_masjid_akaun = $id_masjid ORDER BY kategori_akaun ASC";
                pilihanBijak($q, 'select', 'jenis_vendor', 'Jenis Vendor', 'required', $jenis_vendor, NULL);
                ?>
            </div>
            <div class="col-md-6 col-12 form-group"><label for="nama_vendor">Nama Vendor / Organisasi / Individu</label><input type="text" id="nama_vendor" name="nama_vendor" class="form-control" value="<?php echo($nama_vendor); ?>" required></div>
            <div class="col-md-6 col-12 form-group"><label for="ic_id">No. Sykt / No K/P</label><input type="text" id="ic_id" name="ic_id" class="form-control" value="<?php echo($ic_id); ?>"></div>
            <div class="col-md-6 col-12 form-group"><label for="alamat">Alamat</label><textarea id="alamat" name="alamat" class="form-control" rows="3"><?php echo($alamat); ?></textarea></div>
            <div class="col-md-6 col-12 form-group"><label for="no_phone">No Telefon</label><input type="text" id="no_phone" name="no_phone" class="form-control" value="<?php echo($no_phone); ?>"></div>
            <div class="col-md-6 col-12 form-group"><button type="submit" class="btn btn-primary">Simpan</button></div>
        </div>
        <input type="hidden" id="id_vendor" name="id_vendor" value="<?php echo($id_vendor); ?>">
        <input type="hidden" id="id_masjid" name="id_masjid" value="<?php echo($id_masjid); ?>">
        <input type="hidden" id="reff" name="reff" value="<?php echo($_SESSION['username']); ?>">
    </form>
<?php } ?>

<!-- Page List Vendor -->
<?php if($_GET['data'] == 'raw' && $_GET['module'] == 'list_vendor') {
    $id_masjid = $_SESSION['id_masjid'];

    if($_GET['mode'] == 'padam' && $_GET['id_vendor'] != NULL) {
        $id_vendor = $_GET['id_vendor'];
        $q_del = "DELETE FROM kew_vendor WHERE id_vendor = $id_vendor AND id_masjid = $id_masjid";
        mysqli_query($bd2, $q_del) or die(mysqli_error($bd2));
        echo "<script>
	jQuery('#exampleModal').modal('show');
	jQuery('#exampleModalLabel').html('Padam Vendor');
	jQuery('#badan').html('Vendor Berjaya Dipadam');
	</script>";
    }

    $q = "SELECT * FROM kew_vendor, kew_kategori_akaun WHERE kew_vendor.jenis_vendor = kew_kategori_akaun.id_kategori_akaun AND kew_vendor.id_masjid = $id_masjid ORDER BY kew_kategori_akaun.kategori_akaun ASC, kew_vendor.nama_vendor ASC";
    $qq = mysqli_query($bd2, $q) or die(mysqli_error($bd2));
    $q_row = mysqli_fetch_assoc($qq);
    $q_tot = mysqli_num_rows($qq);
    ?>
    <script>
        eval(document.getElementById("pdf_var").innerHTML);
        nama_masjid = '<?php echo($_SESSION['nama_masjid']); ?>'
        tajuk_dokumen = 'Senarai Vendor / Organisasi / Individu';
        eval(document.getElementById("pdf_sekerip").innerHTML);
    </script>
    <div class="row">
        <div class="col-12 col-md-12" align="center">
            <h4><?php echo($_SESSION['nama_masjid']); ?></h4>
            <h4>Senarai Vendor / Organisasi / Individu</h4>
        </div>
    </div>
    <div class="row table-responsive">
        <table id="meja_akaun" width="100%" data-order="[]" class="table table-bordered table-hover display nowrap margin-top-10 w-p100 table-striped">
            <thead><tr>
                <th scope="col"><div align="center">Bil</div></th>
                <th><div align="center">Nama</div></th>
                <th><div align="center">Kategori</div></th>
                <th><div align="center">IC / ID</div></th>
                <th><div align="center">Alamat</div></th>
                <th><div align="center">No Phone</div></th>
                <th><div align="center">Tindakkan</div></th>
            </tr></thead>
            <tbody>
            <?php $i=1; do { ?>
                <tr>
                    <td><div align="center"><?php echo($i); ?></div></td>
                    <td><?php echo($q_row['nama_vendor']); ?></td>
                    <td><?php echo($q_row['kategori_akaun']); ?></td>
                    <td><?php echo($q_row['ic_id']); ?></td>
                    <td><?php echo($q_row['alamat']); ?></td>
                    <td><?php echo($q_row['no_phone']); ?></td>
                    <td align="center">
                        <button type="button" class="btn btn-primary" onclick="page_ajax('add_vendor&id_vendor=<?php echo($q_row['id_vendor']); ?>', '#module_vendor', 'tunggu')">Lihat</button>
                        <button type="button" class="btn btn-danger" onclick="if(confirm('Padam Rekod <?php echo addslashes($q_row['nama_vendor']); ?>?')) page_ajax('list_vendor&id_vendor=<?php echo($q_row['id_vendor']); ?>&mode=padam', '#module_vendor', 'tunggu')">Padam</button>
                    </td>
                </tr>
                <?php $i++; } while($q_row = mysqli_fetch_assoc($qq)); ?>
            </tbody>
        </table>
    </div>
<?php } ?>

<!-- Page Add Akaun -->
<?php if($_GET['data'] == 'raw' && $_GET['module'] == 'add_akaun') {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_akaun = $_POST['id_akaun'];
        $kod_akaun = strtoupper($_POST['kod_akaun']);
        $nama_akaun = strtoupper($_POST['nama_akaun']);
        $baki_awal = $_POST['baki_awal'];
        $tarikhBaki = $_POST['tarikhBaki'];
        $kadar_harga = $_POST['kadar_harga'];
        $bayaran_berkala = $_POST['bayaran_berkala'];
        $nota = $_POST['nota'];
        $id_kategori_akaun = $_POST['id_kategori_akaun'];
        $id_masjid = $_POST['id_masjid'];
        $reff = $_POST['reff'];

        if($id_kategori_akaun != 19) {
            $kadar_harga = 0;
            $bayaran_berkala = 0;
        }

        if($baki_awal == NULL) $baki_awal = 0;

        if($id_akaun != NULL) $q_post = "UPDATE kew_jenis_akaun SET tarikhBaki = '$tarikhBaki', kod_akaun = '$kod_akaun', baki_awal = '$baki_awal', nama_akaun = '$nama_akaun', nota = '$nota', id_kategori_akaun = $id_kategori_akaun, id_masjid = $id_masjid, reff = '$reff', kadar_harga = $kadar_harga, bayaran_berkala = $bayaran_berkala WHERE id_akaun = $id_akaun";
        if($id_akaun == NULL) $q_post = "INSERT INTO kew_jenis_akaun (tarikhBaki, kod_akaun, baki_awal, nama_akaun, nota, id_kategori_akaun, id_masjid, reff, kadar_harga, bayaran_berkala) VALUES ('$tarikhBaki', '$kod_akaun', '$baki_awal', '$nama_akaun', '$nota', $id_kategori_akaun, $id_masjid, '$reff', $kadar_harga, $bayaran_berkala)";
        mysqli_query($bd2, $q_post) or die(mysqli_error($bd2));
        echo "<script>
	jQuery('#exampleModal').modal('show');
	jQuery('#exampleModalLabel').html('Tambah Jenis Akaun');
	jQuery('#badan').html('Maklumat Jenis Akaun <strong>".$nama_akaun."</strong> Berjaya Ditambah / Dikemaskini');
	</script>";
    }

    if ($_SERVER["REQUEST_METHOD"] != "POST") $id_akaun = $_GET['id_akaun'];
    if ($id_akaun != NULL)	{
        $q = "SELECT * FROM kew_jenis_akaun WHERE id_akaun = $id_akaun";
        $qq = mysqli_query($bd2, $q) or die(mysqli_error($bd2));
        $q_row = mysqli_fetch_assoc($qq);
        $q_tot = mysqli_num_rows($qq);

        $kod_akaun = $q_row['kod_akaun'];
        $nama_akaun = $q_row['nama_akaun'];
        $baki_awal = $q_row['baki_awal'];
        $tarikhBaki = $q_row['tarikhBaki'];
        $nota = $q_row['nota'];
        $id_kategori_akaun = $q_row['id_kategori_akaun'];
    }

    $id_masjid = $_SESSION['id_masjid'];
    $reff = $_SESSION['username'];
    ?>
    <form role="form" class="form-validate form-horizontal well" name="<?php echo($_GET['module']); ?>" id="<?php echo($_GET['module']); ?>" enctype="multipart/form-data"><div class="row">
            <div class="col-md-6 col-12 form-group">
                <label for="kod_akaun">Kod Akaun (Jika Ada)</label>
                <input type="text" id="kod_akaun" name="kod_akaun" class="form-control" value="<?php echo($kod_akaun); ?>">
            </div>
            <div class="col-md-6 col-12 form-group">
                <?php
                $q = "SELECT b.id_kategori_akaun 'id', CONCAT(a.kew_akaun, ' - ', b.kategori_akaun) 'val' FROM kew_akaun a, kew_kategori_akaun b WHERE a.id_kew_akaun = b.jenis_akaun AND (b.id_masjid_akaun = $id_masjid OR b.id_masjid_akaun IS NULL) ORDER BY b.jenis_akaun ASC, b.id_kategori_akaun ASC";
                pilihanBijak($q, 'select', 'id_kategori_akaun', 'Kategori Akaun', 'required', $id_kategori_akaun, NULL);
                ?>
            </div>
            <div class="col-md-6 col-12 form-group"><label for="nama_akaun">Nama Akaun / Tabung / Bank / Jenis Khairat</label><input type="text" id="nama_akaun" name="nama_akaun" class="form-control" value="<?php echo($nama_akaun); ?>" required></div>
            <div class="col-md-3 col-12 form-group">
                <label for="baki_awal">Baki Awal (Jika Ada)</label>
                <input type="number" step="any" id="baki_awal" name="baki_awal" class="form-control" value="<?php echo($baki_awal); ?>">
            </div>
            <div class="col-md-3 col-12 form-group">
                <label for="tarikh_baki_awal">Tarikh Baki Awal (Sekiranya Ada Baki Awal)</label>
                <input type="date" id="tarikh_baki_awal" name="tarikhBaki" class="form-control" value="<?php echo($tarikhBaki); ?>">
            </div>
            <div style="display: none" class="khairat_pakej col-md-6 col-12 form-group"><label for="kadar_harga">Harga Pakej Khairat (RM)</label><input type="number" id="kadar_harga" name="kadar_harga" class="form-control" value="<?php echo($kadar_harga); ?>"></div>
            <div style="display: none" class="khairat_pakej col-md-6 col-12 form-group"><label for="bayaran_berkala">Jenis Bayaran Khairat</label><select id="bayaran_berkala" name="bayaran_berkala" class="form-control"><option></option><option value="1">Bulanan</option><option value="2">Tahunan</option></select></div>
            <div class="col-md-6 col-12 form-group"><label for="nota">Nota</label><textarea id="nota" name="nota" class="form-control" rows="3"><?php echo($nota); ?></textarea></div>
            <div class="col-md-6 col-12 form-group"><button type="submit" class="btn btn-primary">Simpan</button></div>
        </div>
        <input type="hidden" id="id_akaun" name="id_akaun" value="<?php echo($id_akaun); ?>">
        <input type="hidden" id="id_masjid" name="id_masjid" value="<?php echo($id_masjid); ?>">
        <input type="hidden" id="reff" name="reff" value="<?php echo($_SESSION['username']); ?>">
    </form>
    <script>
        var pilih_akaun;

        jQuery("#id_kategori_akaun").change(function(){
            pilih_akaun = jQuery("#id_kategori_akaun").val();;
            if(pilih_akaun == 19) {
                jQuery(".khairat_pakej").fadeIn('slow');
                jQuery("#kadar_harga").attr("required","required");
                jQuery("#bayaran_berkala").attr("required","required");
            }
            if(pilih_akaun != 19) {
                jQuery(".khairat_pakej").fadeOut('slow');
                jQuery("#kadar_harga").removeAttr("required");
                jQuery("#bayaran_berkala").removeAttr("required");
            }
        });
    </script>
<?php } ?>

<!-- Page List Akaun -->
<?php if($_GET['data'] == 'raw' && $_GET['module'] == 'list_akaun') {
    $id_masjid = $_SESSION['id_masjid'];

    if($_GET['mode'] == 'padam' && $_GET['id_akaun'] != NULL) {
        $id_akaun = $_GET['id_akaun'];
        $q_del = "DELETE FROM kew_jenis_akaun WHERE id_akaun = $id_akaun AND id_masjid = $id_masjid";
        mysqli_query($bd2, $q_del) or die(mysqli_error($bd2));
        echo "<script>
	jQuery('#exampleModal').modal('show');
	jQuery('#exampleModalLabel').html('Padam Akaun');
	jQuery('#badan').html('Akaun Berjaya Dipadam');
	</script>";
    }

    $q = "SELECT a.kod_akaun, a.id_akaun, a.nama_akaun, a.nota, CONCAT(b.kew_akaun, ' - ', c.kategori_akaun) 'kategori_akaun' FROM kew_jenis_akaun a, kew_akaun b, kew_kategori_akaun c WHERE a.id_kategori_akaun = c.id_kategori_akaun AND c.jenis_akaun = b.id_kew_akaun AND id_masjid = $id_masjid ORDER BY b.id_kew_akaun ASC, a.nama_akaun ASC";
    $qq = mysqli_query($bd2, $q) or die(mysqli_error($bd2));
    $q_row = mysqli_fetch_assoc($qq);
    $q_tot = mysqli_num_rows($qq);
    ?>
    <script>
        eval(document.getElementById("pdf_var").innerHTML);
        nama_masjid = '<?php echo($_SESSION['nama_masjid']); ?>'
        tajuk_dokumen = 'Senarai Akaun';
        eval(document.getElementById("pdf_sekerip").innerHTML);
    </script>
    <div class="row">
        <div class="col-12 col-md-12" align="center">
            <h4><?php echo($_SESSION['nama_masjid']); ?></h4>
            <h4>Senarai Akaun</h4>
        </div>
    </div>
    <div class="row table-responsive">
        <table id="meja_akaun" width="100%" data-order="[]" class="table table-bordered table-hover display nowrap margin-top-10 w-p100 table-striped">
            <thead><tr>
                <th scope="col"><div align="center">Bil</div></th>
                <th><div align="center">Kod</div></th>
                <th><div align="center">Nama Akaun / Tabung / Bank</div></th>
                <th><div align="center">Kategori Akaun</div></th>
                <th><div align="center">Nota</div></th>
                <th><div align="center">Tindakkan</div></th>
            </tr></thead>
            <tbody>
            <?php $i=1; do { ?>
                <tr>
                    <td><div align="center"><?php echo($i); ?></div></td>
                    <td><?php echo($q_row['kod_akaun']); ?></td>
                    <td><?php echo($q_row['nama_akaun']); ?></td>
                    <td><?php echo($q_row['kategori_akaun']); ?></td>
                    <td><?php echo($q_row['nota']); ?></td>
                    <td align="center">
                        <button type="button" class="btn btn-primary" onclick="page_ajax('add_akaun&id_akaun=<?php echo($q_row['id_akaun']); ?>', '#module_akaun', 'tunggu2')">Lihat</button>
                        <button type="button" class="btn btn-danger" onclick="if(confirm('Padam Rekod <?php echo addslashes($q_row['nama_akaun']); ?>?')) page_ajax('list_akaun&id_akaun=<?php echo($q_row['id_akaun']); ?>&mode=padam', '#module_akaun', 'tunggu2')">Padam</button>
                    </td>
                </tr>
                <?php $i++; } while($q_row = mysqli_fetch_assoc($qq)); ?>
            </tbody>
        </table>
    </div>
<?php } ?>

<!-- Page Add Rekod Perbelanjaan dan Pendapatan -->
<?php if($_GET['data'] == 'raw' && ($_GET['module'] == 'pendapatan' || $_GET['module'] == 'perbelanjaan' || $_GET['module'] == 'pindahan')) {
    if($_GET['module'] == 'pendapatan') {
        $tajuk = 'Rekod Pendapatan';
        $dari_ke = 'Diterima daripada';
        $jenis_akaun = 'Jenis Pendapatan';
        $masuk_keluar = 'Masuk Ke Akaun';
        $q = "SELECT a.id_akaun 'id', a.nama_akaun 'val' FROM kew_jenis_akaun a, kew_akaun b, kew_kategori_akaun c WHERE a.id_kategori_akaun = c.id_kategori_akaun AND c.jenis_akaun = b.id_kew_akaun AND b.id_kew_akaun = 1 AND id_masjid = $id_masjid ORDER BY b.id_kew_akaun ASC, a.nama_akaun ASC";
        $wajib = "required";
    }
    if($_GET['module'] == 'perbelanjaan') {
        $tajuk = 'Rekod Perbelanjaan';
        $dari_ke = 'Bayar kepada';
        $jenis_akaun = 'Jenis Perbelanjaan';
        $masuk_keluar = 'Keluar Daripada Akaun';
        $q = "SELECT a.id_akaun 'id', a.nama_akaun 'val' FROM kew_jenis_akaun a, kew_akaun b, kew_kategori_akaun c WHERE a.id_kategori_akaun = c.id_kategori_akaun AND c.jenis_akaun = b.id_kew_akaun AND b.id_kew_akaun = 2 AND id_masjid = $id_masjid ORDER BY b.id_kew_akaun ASC, a.nama_akaun ASC";
        $wajib = "required";
    }
    if($_GET['module'] == 'pindahan') {
        $sub_query = "SELECT SUM(a.baki_awal) - SUM(IF(g.jenis_akaun = 1 OR h.pindah != a.id_akaun, h.amaun_regu, 0)) - SUM(IF(h.id_akaun_regu = a.id_akaun AND g.jenis_akaun = 2 OR h.pindah = a.id_akaun, h.amaun_regu, 0)) FROM kew_rekod_akaun e, kew_jenis_akaun f, kew_kategori_akaun g, kew_rekod_akaun_item h WHERE e.id_akaun = f.id_akaun AND f.id_kategori_akaun = g.id_kategori_akaun AND e.id_rekod = h.id_rekod AND f.id_masjid = $id_masjid AND h.id_akaun_regu = a.id_akaun";

        $tajuk = 'Pindahan';
        $dari_ke = 'Dari';
        $jenis_akaun = 'Dari Tabung / Akaun Bank / Tunai';
        $masuk_keluar = 'Masuk Ke Tabung / Akaun Bank / Tunai';
        $extra_num = " AND IF(($sub_query) IS NOT NULL, ($sub_query), 0) > 0";
        //$basic_num = "SELECT a.id_akaun 'id', CONCAT(a.nama_akaun, ' - Baki (RM): ', IF(($sub_query) IS NOT NULL, ($sub_query), 0)) 'val' FROM kew_jenis_akaun a, kew_kategori_akaun b WHERE a.id_kategori_akaun = b.id_kategori_akaun AND b.jenis_akaun = 3 AND a.id_masjid = $id_masjid";
        $basic_num = "SELECT a.id_akaun 'id', a.nama_akaun 'val' FROM kew_jenis_akaun a, kew_kategori_akaun b WHERE a.id_kategori_akaun = b.id_kategori_akaun AND b.jenis_akaun = 3 AND a.id_masjid = $id_masjid";
        $susun = " ORDER BY a.nama_akaun ASC";
        $q = "$basic_num $extra_num $susun";

        if($_GET['dev'] == 9999) echo($q);
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_rekod = $_POST['id_rekod'];
        $id_masjid = $_POST['id_masjid'];
        $id_akaun = $_POST['id_akaun'];
        $id_vendor = $_POST['id_vendor'];
        $butiran = $_POST['butiran'];
        $amaun = $_POST['amaun'];
        $reff = $_POST['reff'];
        $jenis_rekod = $_POST['jenis_rekod'];
        if($jenis_rekod != 2) $tarikh = $_POST['tarikh'];

        if($_GET['module'] == 'pindahan') {
            $id_akaun = $_POST['id_akaun_lock'];
            $id_vendor = 0;
        }

        //Simpan akaun biasa
        if($jenis_rekod != 2) {
            if ($id_rekod != NULL) $q_post = "UPDATE kew_rekod_akaun SET id_masjid = $id_masjid, id_akaun = $id_akaun, id_vendor = $id_vendor, tarikh = '$tarikh', butiran = '$butiran', amaun = $amaun, reff = '$reff' WHERE id_rekod = $id_rekod";
            if ($id_rekod == NULL) $q_post = "INSERT INTO kew_rekod_akaun (id_masjid, id_akaun, id_vendor, tarikh, butiran, amaun, reff) VALUES ($id_masjid, $id_akaun, $id_vendor, '$tarikh', '$butiran', $amaun, '$reff')";
            mysqli_query($bd2, $q_post) or die(mysqli_error($bd2));
            $last_id = mysqli_insert_id($bd2);
        }

        //Simpan akaun multi
        if($jenis_rekod == 2) {
            for ($x = 0; $x < count($_POST['id_akaun_regu']); $x++) {
                $id_akaun_regu = $_POST['id_akaun_regu'][$x];
                $tarikh = $_POST['tarikh'][$x];
                $amaun_regu = $_POST['amaun_regu'][$x];
                $no_cek = $_POST['no_cek'][$x];

                if($id_akaun_regu != NULL) {
                    $q_post = "INSERT INTO kew_rekod_akaun (id_masjid, id_akaun, id_vendor, tarikh, butiran, amaun, reff) VALUES ($id_masjid, $id_akaun, $id_vendor, '$tarikh', '$butiran', $amaun_regu, '$reff')";
                    mysqli_query($bd2, $q_post) or die(mysqli_error($bd2));
                    $last_id = mysqli_insert_id($bd2);

                    $qq_post = "INSERT INTO kew_rekod_akaun_item (id_rekod, id_masjid, id_akaun_regu, amaun_regu, no_cek) VALUES ($last_id, $id_masjid, $id_akaun_regu, $amaun_regu, '$no_cek')";
                    mysqli_query($bd2, $qq_post) or die(mysqli_error($bd2));
                }
            }
        }

        //Delete item sahaja
        if($jenis_rekod != 2) {
            for ($d = 0; $d < count($_POST['padamdata']); $d++) {
                $id_padam = $_POST['padamdata'][$d];
                if ($_POST['padamdata'][$d] != NULL) {
                    $q_del = "DELETE FROM kew_rekod_akaun_item WHERE id_masjid = $id_masjid AND id_akaun_item = $id_padam";
                    mysqli_query($bd2, $q_del) or die(mysqli_error($bd2));
                }
            }
        }

        //Loop Simpan akaun regu
        if($jenis_rekod != 2) {
            if($id_rekod == NULL) $last_id_rekod = $last_id;
            if($id_rekod != NULL) $last_id_rekod = $id_rekod;

            for ($x = 0; $x < count($_POST['id_akaun_regu']); $x++) {
                $id_akaun_item = $_POST['id_akaun_item'][$x];
                $id_akaun_regu = $_POST['id_akaun_regu'][$x];
                $amaun_regu = $_POST['amaun_regu'][$x];
                $no_cek = $_POST['no_cek'][$x];
                if ($_GET['module'] == 'pindahan') {
                    $extra_1 = ", pindah = $id_akaun";
                    $extra_2 = ", pindah";
                    $extra_3 = ", $id_akaun";
                }

                if ($id_akaun_item != NULL) $qq_post = "UPDATE kew_rekod_akaun_item SET id_rekod = $last_id_rekod, id_masjid = $id_masjid, id_akaun_regu = $id_akaun_regu, amaun_regu = $amaun_regu, no_cek = '$no_cek' " . $extra_1 . " WHERE id_akaun_item = $id_akaun_item";
                if ($id_akaun_item == NULL) $qq_post = "INSERT INTO kew_rekod_akaun_item (id_rekod, id_masjid, id_akaun_regu, amaun_regu, no_cek " . $extra_2 . ") VALUES ($last_id_rekod, $id_masjid, $id_akaun_regu, $amaun_regu, '$no_cek' " . $extra_3 . ")";

                mysqli_query($bd2, $qq_post) or die(mysqli_error($bd2));
            }
        }

        echo "<script>
	jQuery('#exampleModal').modal('show');
	jQuery('#exampleModalLabel').html('Tambah <strong>".$tajuk."</strong>');
	jQuery('#badan').html('<strong>".$tajuk."</strong> Berjaya Ditambah / Dikemaskini');
	</script>";
    }

    if ($_SERVER["REQUEST_METHOD"] != "POST") $id_rekod = $_GET['id_rekod'];
    if ($id_rekod != NULL)	{
        $q_list = "SELECT a.*, COUNT(b.id_akaun_item) 'Akaun Item', ROUND(a.amaun, 2) 'amaun' FROM kew_rekod_akaun a, kew_rekod_akaun_item b WHERE a.id_rekod = b.id_rekod AND a.id_masjid = $id_masjid AND a.id_rekod = $id_rekod";
        $qq = mysqli_query($bd2, $q_list) or die(mysqli_error($bd2));
        $q_row = mysqli_fetch_assoc($qq);
        $q_tot = mysqli_num_rows($qq);

        $id_rekod = $q_row['id_rekod'];
        $id_masjid = $q_row['id_masjid'];
        $id_akaun = $q_row['id_akaun'];
        $id_vendor = $q_row['id_vendor'];
        $tarikh = $q_row['tarikh'];
        $butiran = $q_row['butiran'];
        $amaun = $q_row['amaun'];
        $reff = $q_row['reff'];
        $bil_item = $q_row['Akaun Item'];
    }

    $id_masjid = $_SESSION['id_masjid'];
    $reff = $_SESSION['username'];
    if($bil_item == 0 || $bil_item == NULL) $bil_item = 0;
    function data_dinamik($a, $b, $c, $d) {
        global $id_masjid, $basic_num, $susun;
        if($_GET['module'] == 'pindahan') {
            $q_dinamik = "$basic_num $susun";
            //$q_dinamik = "SELECT a.id_akaun 'id', a.nama_akaun 'val' FROM kew_jenis_akaun a, kew_kategori_akaun b WHERE a.id_kategori_akaun = b.id_kategori_akaun AND b.jenis_akaun = 3 AND a.id_masjid = $id_masjid";

        }
        if($_GET['module'] != 'pindahan') {
            $q_dinamik = "SELECT a.id_akaun 'id', a.nama_akaun 'val' FROM kew_jenis_akaun a, kew_kategori_akaun b WHERE a.id_kategori_akaun = b.id_kategori_akaun AND b.jenis_akaun = 3 AND a.id_masjid = $id_masjid";
        }
        echo '<div class="col-md-4 col-12 form-group">';
        //echo($q_dinamik.'::');
        pilihanBijak($q_dinamik, 'select', 'id_akaun_regu[]', 'Bank / Tabung / Tunai', 'required', $a, NULL);
        echo '</div><div class="col-md-3 col-12 form-group"><label for="no_cek[]">No. Cek / Akaun</label><input name="no_cek[]" class="form-control" value="'.$d.'"></div><div class="col-md-3 col-12 form-group"><label for="amaun_regu[]">Amaun (RM)</label><input type="number" step="any" name="amaun_regu[]" class="kira form-control" value="'.$b.'" required><input type="hidden" name="id_akaun_item[]" value="'.$c.'"></div>';
    }

    function data_dinamik2($a, $b, $c, $d, $e) {
        global $id_masjid, $basic_num, $susun;
        if($_GET['module'] == 'pindahan') {
            $q_dinamik = "$basic_num $susun";
            //$q_dinamik = "SELECT a.id_akaun 'id', a.nama_akaun 'val' FROM kew_jenis_akaun a, kew_kategori_akaun b WHERE a.id_kategori_akaun = b.id_kategori_akaun AND b.jenis_akaun = 3 AND a.id_masjid = $id_masjid";

        }
        if($_GET['module'] != 'pindahan') {
            $q_dinamik = "SELECT a.id_akaun 'id', a.nama_akaun 'val' FROM kew_jenis_akaun a, kew_kategori_akaun b WHERE a.id_kategori_akaun = b.id_kategori_akaun AND b.jenis_akaun = 3 AND a.id_masjid = $id_masjid";
        }
        echo '<div class="col-md-3 col-12 form-group">';
        //echo($q_dinamik.'::');
        pilihanBijak($q_dinamik, 'select', 'id_akaun_regu[]', 'Bank / Tabung / Tunai', 'required', $a, NULL);
        echo '</div><div class="col-md-auto col-12 form-group"><label for="tarikh[]">Tarikh</label><input type="date" name="tarikh[]" class="form-control" value="'.$e.'"></div><div class="col-md-auto col-12 form-group"><label for="no_cek[]">No. Cek / Akaun</label><input name="no_cek[]" class="form-control" value="'.$d.'"></div><div class="col-md-auto col-12 form-group"><label for="amaun_regu[]">Amaun (RM)</label><input type="number" step="any" name="amaun_regu[]" class="kira form-control" value="'.$b.'" required><input type="hidden" name="id_akaun_item[]" value="'.$c.'"></div>';
    }
    ?>
    <?php if($_GET['module'] == 'pindahan') { ?>
        <script>
            jQuery('#add_rekod_item').prop('disabled', true);
            eval(document.getElementById("hide_select").innerHTML);
            laman = 'pindahan';

            jQuery("#id_akaun").change(function(){
                pilih_akaun2 = jQuery("#id_akaun").val();
                jQuery("#id_akaun_lock").val(pilih_akaun2);
                if(pilih_akaun2 > 0) jQuery('#add_rekod_item').prop('disabled', false);
                if(pilih_akaun2 < 1) jQuery('#add_rekod_item').prop('disabled', true);
            });


        </script>
    <?php } ?>
    <script>
        eval(document.getElementById("dinamik_add_var").innerHTML);
        mula_index = <?php echo($bil_item); ?>;
        id_butang_add = 'add_rekod_item';
        id_borang_dinamik = 'borang_rekod';
        id_baris = 'baris';
        class_remove_btn = 'btn_remove';
        data_dinamik = '<?php if($_GET['jenis_rekod'] == 1 || $_GET['jenis_rekod'] == NULL) data_dinamik(NULL, NULL, NULL, NULL); if($_GET['jenis_rekod'] == 2) data_dinamik2(NULL, NULL, NULL, NULL, NULL); ?>';
        eval(document.getElementById('kiralah_var').innerHTML);
        kelas_kira = 'kira';
        jumlah_kira = 'amaun';
        eval(document.getElementById("dinamik_add").innerHTML);
    </script>
    <form role="form" class="form-validate form-horizontal well" name="<?php echo($_GET['module']); ?>" id="<?php echo($_GET['module']); ?>" enctype="multipart/form-data"><div class="row">
            <div class="col-md-12 col-12 form-group"><h4><?php echo($tajuk); ?></h4></div>
            <?php if($_GET['module'] != 'pindahan' && $_GET['id_rekod'] == NULL) { ?>
                <div class="col-md-12 col-12 form-group">
                    <label>Jenis Rekod:</label>
                    <select id="jenis_rekod" name="jenis_rekod" class="form-control" onchange="page_ajax('<?php echo($_GET['module']); ?>&jenis_rekod='+jQuery('#jenis_rekod').val(), '#module_rekod', 'tunggu3')" required>
                        <option></option>
                        <option value="1" <?php if($_GET['jenis_rekod'] == 1 || $_GET['jenis_rekod'] == NULL) echo('selected'); ?>>Biasa</option>
                        <option value="2" <?php if($_GET['jenis_rekod'] == 2) echo('selected'); ?>>Multi</option>
                    </select>
                </div>
            <?php } ?>
            <div class="col-md-6 col-12 form-group">
                <?php
                pilihanBijak($q, 'select', 'id_akaun', $jenis_akaun, 'required', $id_akaun, NULL);
                ?>
                <input type="hidden" id="id_akaun_lock" name="id_akaun_lock" value="<?php echo($id_akaun); ?>">
            </div>
            <?php if($_GET['module'] != 'pindahan') { ?>
                <div class="col-md-6 col-12 form-group">
                    <?php
                    $q = "SELECT id_vendor 'id', nama_vendor 'val' FROM kew_vendor WHERE id_masjid = $id_masjid ORDER BY jenis_vendor ASC, nama_vendor ASC";
                    pilihanBijak($q, 'select', 'id_vendor', 'Nama Vendor / Organisasi / Individu', $wajib, $id_vendor, NULL);
                    ?>
                </div>
            <?php } ?>
            <?php if($_GET['jenis_rekod'] == 1 || $_GET['jenis_rekod'] == NULL) { ?><div class="col-md-6 col-12 form-group"><label for="tarikh">Tarikh</label><input type="date" id="tarikh" name="tarikh" class="form-control" value="<?php echo($tarikh); ?>" required></div><?php } ?>
            <div class="col-md-6 col-12 form-group"><label for="nota">Butiran</label><textarea id="butiran" name="butiran" class="form-control" rows="3"><?php echo($butiran); ?></textarea></div>
        </div>
        <div class="row">
            <div class="col-md-12 col-12 form-group"><h4><?php echo($masuk_keluar); ?></h4></div>
        </div>
        <div id="borang_rekod">
            <?php if($id_rekod != NULL) {
                $q_list = "SELECT *, ROUND(amaun_regu, 2) 'amaun_regu' FROM kew_rekod_akaun_item WHERE id_rekod = $id_rekod";
                $qq = mysqli_query($bd2, $q_list) or die(mysqli_error($bd2));
                $q_row = mysqli_fetch_assoc($qq);
                $i = 1;
                do { ?>
                    <div class="row" id="baris<?php echo($i); ?>">
                        <?php
                        if($_GET['jenis_rekod'] == 1 || $_GET['jenis_rekod'] == NULL) data_dinamik($q_row['id_akaun_regu'], $q_row['amaun_regu'], $q_row['id_akaun_item'], $q_row['no_cek']);
                        if($_GET['jenis_rekod'] == 2) data_dinamik2($q_row['id_akaun_regu'], $q_row['amaun_regu'], $q_row['id_akaun_item'], $q_row['no_cek'], '');
                        ?>
                        <div class="col-md-auto col-12 form-group"><button name="remove" id="<?php echo($i); ?>" type="button" class="btn_remove btn btn-warning" onclick="document.getElementById('padamdata_<?php echo($i-1); ?>').value='<?php echo($q_row['id_akaun_item']); ?>'">Padam</button></div></div><input name="padamdata[]" type="hidden" id="padamdata_<?php echo($i-1); ?>">
                    <?php $i++; } while($q_row = mysqli_fetch_assoc($qq)); } ?>
        </div>
        <div class="row">
            <div class="col-md-6 col-12 form-group"><button id="add_rekod_item" type="button" class="btn btn-success">Tambah</button></div>
        </div>
        <div class="row">
            <div class="col-md-6 col-12 form-group"></div>
            <div class="col-md-3 col-6 form-group" align="right"><h4>Jumlah (RM)</h4></div>
            <div class="col-md-3 col-6 form-group"><input style="font-weight: bold" readonly type="number" id="amaun" name="amaun" class="form-control form-group" value="<?php echo($amaun); ?>" required></div>
        </div>
        <div class="row">
            <div class="col-md-6 col-12 form-group"><button id="simpan_save" type="submit" class="btn btn-primary" <?php if($id_rekod == NULL) echo 'disabled'; if($id_rekod != NULL) echo ''; ?>>Simpan</button></div>
        </div>
        <input type="hidden" id="id_rekod" name="id_rekod" value="<?php echo($id_rekod); ?>">
        <input type="hidden" id="id_masjid" name="id_masjid" value="<?php echo($id_masjid); ?>">
        <input type="hidden" id="reff" name="reff" value="<?php echo($_SESSION['username']); ?>">
    </form>
<?php } ?>

<!-- Page List Pendapatan dan Perbelanjaan -->
<?php if($_GET['data'] == 'raw' && $_GET['module'] == 'lihat_rekod_kewangan') {
    $id_masjid = $_SESSION['id_masjid'];
    if($_GET['pilih'] == 2) $pindah_saja = "AND c.nama_vendor IS NULL";
//$q = "SELECT b.id_rekod 'Hide 1', d.jenis_akaun 'Hide 2', b.tarikh 'Tarikh', a.nama_akaun 'Akaun', c.nama_vendor 'Nama', b.butiran 'Butiran', IF(d.jenis_akaun = 1, b.amaun, '') 'Pendapatan (RM)', IF(d.jenis_akaun = 2, b.amaun, '') 'Perbelanjaan (RM)' FROM kew_jenis_akaun a, kew_rekod_akaun b, kew_vendor c, kew_kategori_akaun d WHERE a.id_akaun = b.id_akaun AND b.id_vendor = c.id_vendor AND a.id_kategori_akaun = d.id_kategori_akaun AND b.id_masjid = $id_masjid ORDER BY b.tarikh ASC";
    $q = "SELECT b.id_rekod 'Hide 1', d.jenis_akaun 'Hide 2', b.tarikh 'Tarikh', a.kod_akaun 'Kod', a.nama_akaun 'Akaun', c.nama_vendor 'Nama', b.butiran 'Butiran', IF(d.jenis_akaun = 1 OR c.nama_vendor IS NULL, ROUND(b.amaun, 2), '') 'Pendapatan (RM)', IF(d.jenis_akaun = 2, ROUND(b.amaun, 2), '') 'Perbelanjaan (RM)'
FROM kew_jenis_akaun a
LEFT JOIN kew_rekod_akaun b ON a.id_akaun = b.id_akaun
LEFT JOIN kew_vendor c ON b.id_vendor = c.id_vendor
LEFT JOIN kew_kategori_akaun d ON a.id_kategori_akaun = d.id_kategori_akaun
WHERE b.id_masjid = $id_masjid $pindah_saja ORDER BY b.tarikh ASC";
    $qq = mysqli_query($bd2, $q) or die(mysqli_error($bd2));
    $q_row = mysqli_fetch_assoc($qq);
    $q_tot = mysqli_num_rows($qq);
    $q_cols = mysqli_fetch_fields($qq);
    $q_cols2 = mysqli_fetch_fields($qq);
//echo($q);
    ?>
    <script>
        eval(document.getElementById("pdf_var").innerHTML);
        nama_masjid = '<?php echo($_SESSION['nama_masjid']); ?>'
        tajuk_dokumen = 'Rekod Pendapatan dan Perbelanjaan';
        eval(document.getElementById("pdf_sekerip").innerHTML);
    </script>
    <div class="row">
        <div class="col-12 col-md-12" align="center">
            <h4><?php echo($_SESSION['nama_masjid']); ?></h4>
            <h4>Rekod Pendapatan dan Perbelanjaan</h4>
        </div>
        <div class="col-md-auto col-12 form-group">
            <label for="pilih">Pilih Rekod:-</label>
            <select id="pilih" name="pilih" class="form-control" onchange="page_ajax('lihat_rekod_kewangan&pilih='+jQuery('#pilih').val(), '#module_rekod', 'tunggu3')">
                <option></option>
                <option value="1" <?php if($_GET['pilih'] != 2) echo 'selected'; ?>>Semua Rekod Kewangan</option>
                <option value="2" <?php if($_GET['pilih'] == 2) echo 'selected'; ?>>Rekod Pindahan Sahaja</option>
            </select>
        </div>
    </div>
    <div class="row table-responsive">
        <table id="meja_akaun" width="100%" data-order="[]" class="table table-bordered table-hover display nowrap margin-top-10 w-p100 table-striped">
            <thead><tr>
                <th scope="col" valign="middle"><div align="center">Bil</div></th>
                <?php foreach ($q_cols2 as $val) { if($val->name != 'Hide 1' && $val->name != 'Hide 2') { ?>
                    <th valign="middle"><div align="center"><?php echo($val->name); ?></div></th>
                <?php } } ?>
                <th valign="middle"><div align="center">Tindakan</div></th>
            </tr></thead>
            <tbody>
            <?php $i=1; do { ?>
                <tr>
                    <td><div align="center"><?php echo($i); ?></div></td>
                    <?php foreach ($q_cols as $val) { if($val->name != 'Hide 1' && $val->name != 'Hide 2') {
                        if($q_row['Hide 2'] == 1) $module = 'pendapatan&id_rekod='.$q_row['Hide 1'];
                        if($q_row['Hide 2'] == 2) $module = 'perbelanjaan&id_rekod='.$q_row['Hide 1'];
                        $nama_vendor2 = $q_row['Nama'];
                        if($nama_vendor2 == NULL) {
                            $module = 'pindahan&id_rekod='.$q_row['Hide 1'];
                            $nama_vendor2 = "PINDAHAN ANTARA TABUNG / AKAUN BANK / TUNAI";
                        }
                        ?>
                        <td>
                            <?php
                            if($val->type == 10) {
                                echo '<div align="left">';
                                fungsi_tarikh($q_row[$val->name], 2, 1);
                                echo '</div>';
                            }
                            if($val->type != 10) {
                                if($val->decimals > 0) echo '<div align="right">'.number_format($q_row[$val->name], 2).'</div>';
                                if($val->decimals == 0) {
                                    //echo '<div align="left">'.$q_row[$val->name].'</div>';
                                    if($val->name != "Nama") echo '<div align="left">'.$q_row[$val->name].'</div>';
                                    if($val->name == "Nama") echo '<div align="left">'.$nama_vendor2.'</div>';
                                }
                            }
                            ?>
                        </td>
                    <?php } }
                    $info_delete = 'Akaun: '.$q_row['Akaun'].'<br />';
                    $info_delete .=	'Nama: '.$q_row['Nama'].'<br />';
                    $info_delete .=	'Butiran: '.$q_row['Butiran'].'<br />';
                    if($q_row['Hide 2'] == 1) $info_delete .=	'Pendapatan (RM): '.number_format($q_row['Pendapatan (RM)'], 2);
                    if($q_row['Hide 2'] == 2) $info_delete .=	'Perbelanjaan (RM): '.number_format($q_row['Perbelanjaan (RM)'], 2);
                    ?>
                    <td style="width: 180px"><?php if($q_row['Nama'] != NULL) { ?><div align="center"><a target="_blank" href="<?php echo($_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'].'&data=raw&module=view_kewangan&sub=baucar&id_rekod='.$q_row['Hide 1']); ?>"><button type="button" class="btn btn-success fas fa-receipt"></button></a>&nbsp;&nbsp;&nbsp;<?php } ?><button type="button" class="btn btn-primary fas fa-edit" onClick="page_ajax('<?php echo($module); ?>', '#module_rekod', 'tunggu3')"></button>&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-warning fas fa-trash-alt" onClick="modal_delete('Padam Rekod Pendapatan / Perbelanjaan', '<?php echo($info_delete); ?>', 'padam&view_del=padam_rekod&id_padam=<?php echo($q_row['Hide 1']); ?>', '#module_penyata', 'tunggu4')"></button></div></td>
                </tr>
                <?php $i++; } while($q_row = mysqli_fetch_assoc($qq)); ?>
            </tbody>
        </table>
    </div>
<?php } ?>

<!-- Padam rekod -->
<?php if($_GET['data'] == 'raw' && $_GET['module'] == 'padam') {
    $id_masjid = $_SESSION['id_masjid'];
    $id_padam = $_GET['id_padam'];
    if($_GET['view_del'] == 'padam_rekod') {
        $module_title = 'Pendapatan / Perbelanjaan';
        $a = 'lihat_rekod_kewangan';
        $b = '#module_penyata';
        $c = 'tunggu4';
        $q = "DELETE FROM kew_rekod_akaun WHERE id_masjid = $id_masjid AND id_rekod = $id_padam";
        //$q2 = "DELETE FROM kew_rekod_akaun_item WHERE id_masjid = $id_masjid AND id_rekod = $id_padam";
    }
    mysqli_query($bd2, $q) or die(mysqli_error($bd2));
    //mysqli_query($bd2, $q2) or die(mysqli_error($bd2));

    ?>
    <script>
        eval(document.getElementById('exampleModal').innerHTML);
        eval(document.getElementById('form_ajax').innerHTML);
        jQuery('#exampleModal').modal('show');
        jQuery('#exampleModalLabel').html('Padam Rekod <strong><?php echo($module_title); ?></strong>');
        jQuery('#badan').html('<strong><?php echo($module_title); ?></strong> Berjaya Dipadamkan');
        page_ajax('<?php echo($a); ?>', '<?php echo($b); ?>', '<?php echo($c); ?>');
    </script>
<?php } ?>

<!-- Page List Tabung Sahaja -->
<?php if($_GET['data'] == 'raw' && $_GET['module'] == 'penyata_tunai') {
    $id_masjid = $_SESSION['id_masjid'];
    $q = "SELECT a.id_akaun, a.kod_akaun, a.nama_akaun, a.nota, CONCAT(b.kew_akaun, ' - ', c.kategori_akaun) 'kategori_akaun' FROM kew_jenis_akaun a, kew_akaun b, kew_kategori_akaun c WHERE a.id_kategori_akaun = c.id_kategori_akaun AND c.jenis_akaun = b.id_kew_akaun AND id_masjid = $id_masjid AND c.jenis_akaun = 3 ORDER BY b.id_kew_akaun ASC, a.nama_akaun ASC";
    $qq = mysqli_query($bd2, $q) or die(mysqli_error($bd2));
    $q_row = mysqli_fetch_assoc($qq);
    $q_tot = mysqli_num_rows($qq);
    ?>
    <script>
        eval(document.getElementById("pdf_var").innerHTML);
        nama_masjid = '<?php echo($_SESSION['nama_masjid']); ?>'
        tajuk_dokumen = 'Senarai Tabung / Bank / Tunai';
        eval(document.getElementById("pdf_sekerip").innerHTML);
    </script>
    <div class="row">
        <div class="col-12 col-md-12" align="center">
            <h4><?php echo($_SESSION['nama_masjid']); ?></h4>
            <h4>Senarai Tabung / Bank / Tunai</h4>
        </div>
    </div>
    <div class="row table-responsive">
        <table id="meja_akaun" width="100%" data-order="[]" class="table table-bordered table-hover display nowrap margin-top-10 w-p100 table-striped">
            <thead><tr>
                <th scope="col"><div align="center">Bil</div></th>
                <th><div align="center">Kod</div></th>
                <th><div align="center">Nama Akaun / Tabung / Bank</div></th>
                <th><div align="center">Nota</div></th>
                <th><div align="center">Tindakkan</div></th>
            </tr></thead>
            <tbody>
            <?php $i=1; do { ?>
                <tr>
                    <td><div align="center"><?php echo($i); ?></div></td>
                    <td><?php echo($q_row['kod_akaun']); ?></td>
                    <td><?php echo($q_row['nama_akaun']); ?></td>
                    <td><?php echo($q_row['nota']); ?></td>
                    <td><a target="_blank" href="utama.php?view=admin&action=kewangan&data=raw&module=view_kewangan&sub=penyata_tunai&id_akaun=<?php echo($q_row['id_akaun']); ?>"><button class="btn btn-success">Lihat Penyata</button></a></td>
                </tr>
                <?php $i++; } while($q_row = mysqli_fetch_assoc($qq)); ?>
            </tbody>
        </table>
    </div>
<?php } ?>