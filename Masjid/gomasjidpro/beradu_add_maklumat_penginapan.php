<?php

// Masukkan backend PHP/Mysql di bahagian sini

if($_SERVER['REQUEST_METHOD'] == "POST" ) {
    $id_produk = e($_POST['id_produk'],1,NULL);
    $room_type = e($_POST['room_type'],1,NULL);
    $id_negeri = e($_POST['id_negeri'],1,NULL);
    $id_daerah = e($_POST['id_daerah'],1,NULL);
    $id_masjid = e($_POST['id_masjid'],1,NULL);
    $price = e($_POST['price'],NULL,NULL);
    $room_image = e($_POST['room_image'],1,NULL);
    $description = e($_POST['description'],1,NULL);
    $total_room = e($_POST['total_room'],1,NULL);
    $room_code = e($_POST['room_code'],1,NULL);
    $amenities = e($_POST['amenities'],1,NULL);


    $sql = "INSERT INTO beradu_room(id_produk, room_type, price, room_image, total_room, room_code, amenities, description) 
                    VALUES ('$id_produk','$room_type','$price','$room_image','$total_room','$room_code','$amenities','$description')";

    $sql1 = mysqli_query($bd2,$sql) or die("sql error".$sql . mysqli_error($bd2));

    $test=$sql1;
    if($test)
    {
        echo "<script>document.location.href='utama.php?view=admin&action=gomasjidpro&page=beradu_list_penginapan'</script>";
    }
    else
    {
        echo mysqli_error();
    }
}

// Tak perlu redirection sebab proses di page yang sama untuk method POST melainkan nk redirect ke page yang lain.

?>


<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4>Urus Penginapan</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:history.back()">Dashboard Beradu</a></li>
                <li class="breadcrumb-item"><a href="utama.php?view=admin&action=gomasjidpro&page=beradu_add_penginapan">Daftar Penginapan</a></li>
                <li class="breadcrumb-item active">Urus Penginapan</li>
            </ol>
        </div>
    </div>
</div>
<div class="row">
    <div class="content-header">
    </div>
    <div class="col-sm-12">
        <div class="card card-body">
            <form id="add_maklumatBeradu" name="add_maklumatBeradu" method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">
                <div class="md-4">
                    <h5 class="m-t-30">Nama Penginapan</h5>
                    <?php
                    $id_masjid = $_SESSION['id_masjid'];
                    $sql="SELECT id_produk, nama_produk FROM products_ecomasjid WHERE id_category=2 AND id_masjid = '$id_masjid'";

                    /* You can add order by clause to the sql statement if the names are to be displayed in alphabetical order */

                    echo "<select id=id_produk class='form-control' data-style=form-control name=id_produk value=''></option>"; // list box select command

                    foreach ($bd2->query($sql) as $row){//Array or records stored in $row

                        echo "<option value=$row[id_produk]>$row[nama_produk]</option>";

                        /* Option values are added by looping through the array */

                    }
                    echo "</select>";// Closing of list box
                    ?>
                </div>
                <div class="md-4 mb-4 ">
                    <div class="form-group">
                        <label for="id_negeri">ID Negeri</label>
                        <input type="text" id="id_negeri" name="id_negeri" class="form-control" value="<?php echo $_SESSION['id_negeri'];?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="id_daerah">ID Daerah <span class="help"></span></label>
                    <input type="text" id="id_daerah" name="id_daerah" class="form-control" value="<?php echo $_SESSION['id_daerah'];?>" />
                </div>
                <div class="form-group">
                    <label for="id_masjid">ID Masjid <span class="help"></span></label>
                    <input type="text" id="id_masjid" name="id_masjid" class="form-control" value="<?php echo $_SESSION['id_masjid'];?>" />
                </div>
                <div class="form-group">
                    <label for="room_type">Jenis Bilik <span class="help"></span></label>
                    <input type="text" id="room_type" name="room_type" class="form-control" value="<?php echo($room_type);?>" placeholder="Jenis bilik"/>
                </div>
                <div class="form-group">
                    <label for="room_code">Kod Bilik <span class="help"></span></label>
                    <input type="text" id="room_code" name="room_code" class="form-control" value="<?php echo($room_type);?>" placeholder="Sila masukkan kod bilik bagi jenis bilik"/>
                </div>
                <div class="form-group">
                    <label for="harga">Harga Bilik</label>
                    <div class="input-group-prepend">
                        <span class="input-group-text">RM</span><span class="input-group-text">00.00</span>
                        <input type="number" id="price" name="price" class="form-control" value="<?php echo ($price); ?>" placeholder="Harga bilik"/>
                    </div>
                </div>
                <div class="form-group">
                    <label>Gambar Bilik</label>
                    <input id="image" name="image" type="file" class="form-control" value="<?php echo($room_image);?>" />
                </div>
                <div class="form-group">
                    <label>Jumlah Bilik Disediakan</label>
                    <input id="total_room" name="total_room" type="number" class="form-control" value="<?php echo($total_room);?>" placeholder="Jumlah bilik yang disediakan"/>
                </div>
                <div class="form-group">
                    <label for="amenities">Kemudahan<span class="help"></span></label>
                    <select id="amenities" name="amenities" class="select2 m-b-10 select2-multiple" style="width: 100%" multiple="multiple"><?php echo($amenities);?>
                        <optgroup label="Tempat Meletak Kenderaan">
                            <option value="Tempat Meletak Kenderaan (Berbayar)">Tempat Meletak Kenderaan (Berbayar)</option>
                            <option value="Tempat Meletak Kenderaan (Percuma)">Tempat Meletak Kenderaan (Percuma)</option>
                        </optgroup>
                        <optgroup label="Kemudahan Internet dan Ruang Kerja">
                            <option value="Kemudahan Internet Percuma">Kemudahan Internet Percuma</option>
                            <option value="Ruang Kerja">Ruang Kerja</option>
                        </optgroup>
                        <optgroup label="Bilik Mandi">
                            <option value="Air Panas">Air Panas</option>
                            <option value="Sabun Mandian">Sabun Mandian</option>
                            <option value="Syampu">Syampu</option>
                            <option value="Tab Mandi">Tab Mandi</option>
                            <option value="Pengering Rambut">Pengering Rambut</option>
                        </optgroup>
                        <optgroup label="Bilik Tidur">
                            <option value="Kelengkapan Asas (Tuala, Cadar, Tisu)">Kelengkapan Asas (Tuala, Cadar, Tisu)</option>
                            <option value="Penyangkut">Penyangkut</option>
                            <option value="Linen Katil">Linen Katil</option>
                            <option value="Bantal Dan Selimut Tambahan">Bantal Dan Selimut Tambahan</option>
                            <option value="Seterika">Seterika</option>
                            <option value="Rak Pengering Pakaian">Rak Pengering Pakaian</option>
                            <option value="Almari Pakaian">Almari Pakaian</option>
                        </optgroup>
                        <optgroup label="Hiburan">
                            <option value="Televisyen">Televisyen</option>
                            <option value="Sesuai Untuk Majlis">Sesuai Untuk Majlis</option>
                        </optgroup>
                        <optgroup label="Dapur Dan Tempat Makan">
                            <option value="Dapur">Dapur</option>
                            <option value="Peti Sejuk">Peti Sejuk</option>
                            <option value="Ketuhar Gelombang Mikro">Ketuhar Gelombang Mikro</option>
                            <option value="Cerek Elektrik">Cerek Elektrik</option>
                            <option value="Pembakar Roti">Pembakar Roti</option>
                            <option value="Periuk Nasi">Periuk Nasi</option>
                            <option value="Pinggan Dan Cawan">Pinggan Dan Cawan</option>
                            <option value="Alatan Memasak">Alatan Memasak</option>
                            <option value="Alatan Barbeku">Alatan Barbeku</option>
                            <option value="Meja Makan">Meja Makan</option>
                        </optgroup>
                        <optgroup label="Lain-Lain kemudahan">
                            <option value="Penyaman Udara">Penyaman Udara</option>
                            <option value="Kipas Siling">Kipas Siling</option>
                            <option value="Kolam">Kolam</option>
                            <option value="Gim">Gim</option>
                            <option value="Servis Dobi">Servis Dobi</option>
                        </optgroup>
                    </select>
                </div>
                <div class="form-group">
                    <label>Penerangan Bilik</label>
                    <textarea id="description" name="description" class="form-control" rows="5" value="<?php echo($description);?>" placeholder="Penerangan mengenai bilik"></textarea>
                </div>
                <div class="row button-group">
                    <div class="col-lg-6 col-md-6">
                        <button type="submit" class="btn btn-block btn-lg btn-success">HANTAR</button>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <button type="button" class="btn btn-block btn-lg btn-danger" onclick="location.href='utama.php?view=admin&action=gomasjidpro&page=beradu_dashboard'">BATAL</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(function () {

        // For select 2
        $(".select2").select2({
            placeholder: 'Sila pilih kemudahan yang disediakan'
        });

        // For multiselect
        $('#pre-selected-options').multiSelect();
        $('#optgroup').multiSelect({
            selectableOptgroup: true
        });
        $('#public-methods').multiSelect();
        $('#select-all').click(function () {
            $('#public-methods').multiSelect('select_all');
            return false;
        });
        $('#deselect-all').click(function () {
            $('#public-methods').multiSelect('deselect_all');
            return false;
        });
        $('#refresh').on('click', function () {
            $('#public-methods').multiSelect('refresh');
            return false;
        });
        $('#add-option').on('click', function () {
            $('#public-methods').multiSelect('addOption', {
                value: 42,
                text: 'test 42',
                index: 0
            });
            return false;
        });
        $(".ajax").select2({
            ajax: {
                url: "https://api.github.com/search/repositories",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function (data, params) {
                    // parse the results into the format expected by Select2
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data, except to indicate that infinite
                    // scrolling can be used
                    params.page = params.page || 1;
                    return {
                        results: data.items,
                        pagination: {
                            more: (params.page * 30) < data.total_count
                        }
                    };
                },
                cache: true
            },
            escapeMarkup: function (markup) {
                return markup;
            }, // let our custom formatter work
            minimumInputLength: 1,
            //templateResult: formatRepo, // omitted for brevity, see the source of this page
            //templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
        });
    });
</script>
