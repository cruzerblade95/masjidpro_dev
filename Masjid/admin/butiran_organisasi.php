<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Daftar Organisasi</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="utama.php?view=admin&action=semakorganisasi&sideMenu=organisasi">Semak Organisasi</a></li>
                    <li class="active">Daftar Organisasi</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="content mt-3">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Daftar Maklumat
                </div>
                <?php

                include("connection/connection.php");

                if(isset($_GET['idrekod'])){
                    $id_rekod = $_GET['idrekod'];

                    $sql_search = "SELECT data_ajkmasjid.id_dataajk 'idrekod', sej6x_data_peribadi.nama_penuh, sej6x_data_peribadi.jenisPengenalan, sej6x_data_peribadi.no_ic, sej6x_data_peribadi.no_hp 'no_tel', data_ajkmasjid.jawatan 
                       FROM data_ajkmasjid LEFT JOIN sej6x_data_peribadi ON data_ajkmasjid.id_ajk = sej6x_data_peribadi.id_data WHERE data_ajkmasjid.id_dataajk = '$id_rekod' AND sej6x_data_peribadi.id_masjid = $id_masjid
                       UNION
                       SELECT data_pegawai_masjid.id_datapegawai 'idrekod', sej6x_data_peribadi.nama_penuh, sej6x_data_peribadi.jenisPengenalan, sej6x_data_peribadi.no_ic, sej6x_data_peribadi.no_hp 'no_tel', data_pegawai_masjid.jawatan 
                       FROM data_pegawai_masjid LEFT JOIN sej6x_data_peribadi ON data_pegawai_masjid.id_pegawai = sej6x_data_peribadi.id_data WHERE data_pegawai_masjid.id_datapegawai = '$id_rekod' AND sej6x_data_peribadi.id_masjid = $id_masjid
                       UNION
                       SELECT data_pengurusan_masjid.id_pengurusan 'idrekod', data_pengurusan_masjid.nama_penuh, data_pengurusan_masjid.jenisPengenalan, data_pengurusan_masjid.no_ic, data_pengurusan_masjid.no_tel, jawatan_pengurusan_masjid.jawatan 
                       FROM data_pengurusan_masjid LEFT JOIN jawatan_pengurusan_masjid ON data_pengurusan_masjid.jawatan = jawatan_pengurusan_masjid.id_jawatan WHERE data_pengurusan_masjid.id_pengurusan = '$id_rekod' AND data_pengurusan_masjid.id_masjid = $id_masjid
                       UNION
                       SELECT data_ajkmasjid.id_dataajk 'idrekod', sej6x_data_anakqariah.nama_penuh, sej6x_data_anakqariah.jenisPengenalan, sej6x_data_anakqariah.no_ic, sej6x_data_anakqariah.no_tel, data_ajkmasjid.jawatan 
                       FROM data_ajkmasjid LEFT JOIN sej6x_data_anakqariah ON data_ajkmasjid.id_ajk2 = sej6x_data_anakqariah.ID WHERE data_ajkmasjid.id_dataajk = '$id_rekod' AND sej6x_data_anakqariah.id_masjid = $id_masjid
                       UNION
                       SELECT data_pegawai_masjid.id_datapegawai 'idrekod', sej6x_data_anakqariah.nama_penuh, sej6x_data_anakqariah.jenisPengenalan, sej6x_data_anakqariah.no_ic, sej6x_data_anakqariah.no_tel, data_pegawai_masjid.jawatan 
                       FROM data_pegawai_masjid LEFT JOIN sej6x_data_anakqariah ON data_pegawai_masjid.id_pegawai2 = sej6x_data_anakqariah.ID WHERE data_pegawai_masjid.id_datapegawai = '$id_rekod' AND sej6x_data_anakqariah.id_masjid = $id_masjid
                       UNION
                       SELECT data_pengurusan_masjid.id_pengurusan 'idrekod', data_pengurusan_masjid.nama_penuh, data_pengurusan_masjid.jenisPengenalan, data_pengurusan_masjid.no_ic, data_pengurusan_masjid.no_tel, jawatan_pengurusan_masjid.jawatan 
                       FROM data_pengurusan_masjid LEFT JOIN jawatan_pengurusan_masjid ON data_pengurusan_masjid.jawatan = jawatan_pengurusan_masjid.id_jawatan WHERE data_pengurusan_masjid.id_pengurusan = '$id_rekod' AND data_pengurusan_masjid.id_masjid = $id_masjid";

                    $result = mysqli_query($bd2, $sql_search) or die ("Error :".mysqli_error($bd2));

                    ?>
                    <div class="card-body">
                        <form action="admin/add_organisasi.php" method='post' enctype="multipart/form-data">
                            <?php while($row = mysqli_fetch_assoc($result)) {?>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Nama Penuh</label>
                                            <input type="text" name="nama_penuh" id="nama_penuh" value="<?php echo $row['nama_penuh']; ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>No Pengenalan</label>
                                            <input type="text" name="no_pengenalan" id="no_pengenalan" minlength="12" maxlength="12" value="<?php echo $row['no_ic']; ?>" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>No. Telefon</label>
                                            <input class="form-control" type="text" name="no_telefon" id="no_telefon" value="<?php echo $row['no_tel']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Alamat e-mel</label>
                                            <input class="form-control" type="email" name="emel" id="emel" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Kategori Jawatankuasa</label>
                                            <select class="form-control" name="kat_jawatan" id="kat_jawatan" required>
                                                <option value =""></option>
                                                <option value ="ajk">Ahli Jawatankuasa Masjid</option>
                                                <option value ="pegawai">Pegawai Masjid</option>
                                                <option value ="pengurusan">Pengurusan Masjid</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <!--select-->
                                        <div class="form-group" id="id_jawatankuasaDiv">
                                            <label>Jawatan</label>
                                            <select class="form-control" name="id_jawatankuasa" id="id_jawatankuasa" disabled required>
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Tarikh Lantikan</label>
                                            <input class="form-control" type="date" name="tarikh_lantikan" id="tarikh_lantikan" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Muat Naik Fail</label>
                                            <input type="file" class="form-control-file" name="gambar" id="gambar" accept=".jpg,.gif,.png,.jpeg"/>
                                        </div>
<!--                                        <div class="form-group">-->
<!--                                            <label>Upload Fail</label>-->
<!--                                            <input type="file" class="form-control" name="file" id="file" />-->
<!--                                        </div>-->
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <center>
                                            <div class="form-group">
                                                <input type="hidden" name="jenisPengenalan" value="<?php echo $row['jenisPengenalan']; ?>">
                                                <input type="hidden" name="id_rekod" value="<?php echo $row['idrekod']; ?>">
                                                <input type="submit"  value="Daftar" class="btn btn-primary">
                                            </div>
                                        </center>
                                    </div>
                                </div>
                            <?php }?>
                        </form>
                    </div>
                    <?php
                }
                else if(!isset($_GET['idrekod'])){
                    ?>
                    <?php

                        $no_ic = $_GET['no_ic'];
                        $sqr = "SELECT nama_penuh, no_ic, no_hp AS no_tel, email FROM sej6x_data_peribadi 
                                WHERE no_ic LIKE '%$no_ic%' AND id_masjid = '$id_masjid'
                                
                                UNION

                                SELECT nama_penuh, no_ic, no_tel, email FROM sej6x_data_anakqariah 
                                WHERE no_ic LIKE '%$no_ic%' AND id_masjid = '$id_masjid'";
                        $relult = mysqli_query($bd2, $sqr) or die ("Error :".mysqli_error($bd2));
                    ?>
                    <div class="card-body">
                        <form action="admin/add_organisasi.php" method='post' enctype="multipart/form-data">
                        <?php if (mysqli_num_rows($relult) > 0) { ?>
                            <?php while($row = mysqli_fetch_assoc($relult)) {?>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Nama Penuh</label>
                                            <input type="text" name="nama_penuh" id="nama_penuh" class="form-control" value="<?php echo $row['nama_penuh']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>No Pengenalan</label>
                                            <input type="text" name="no_pengenalan" id="no_pengenalan" minlength="12" maxlength="12" value="<?php echo $row['no_ic']; ?>" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>No. Telefon</label>
                                            <input class="form-control" type="text" name="no_telefon" id="no_telefon" value="<?php echo $row['no_tel']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Alamat e-mel</label>
                                            <input class="form-control" type="email" name="emel" id="emel" value="<?php echo $row['email']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Kategori Jawatankuasa</label>
                                            <select class="form-control" name="kat_jawatan" id="kat_jawatan" required>
                                                <option value =""></option>
                                                <option value ="ajk">Ahli Jawatankuasa Masjid</option>
                                                <option value ="pegawai">Pegawai Masjid</option>
                                                <option value ="pengurusan">Pengurusan Masjid</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <!--select-->
                                        <div class="form-group" id="id_jawatankuasaDiv">
                                            <label>Jawatan</label>
                                            <select class="form-control" name="id_jawatankuasa" id="id_jawatankuasa" disabled required>
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Tarikh Lantikan</label>
                                            <input class="form-control" type="date" name="tarikh_lantikan" id="tarikh_lantikan" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Muat Naik Fail</label>
                                            <input type="file" class="form-control-file" name="gambar" id="gambar" />
                                        </div>
                                        <!--                                    <div class="form-group">-->
                                        <!--                                        <label>Upload Fail</label>-->
                                        <!--                                        <input type="file" class="form-control" name="file" id="file" />-->
                                        <!--                                    </div>-->
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <center>
                                            <div class="form-group">
                                                <input type="hidden" name="jenisPengenalan" value="<?php echo $_GET['jenisPengenalan']; ?>">
                                                <input type="hidden" name="id_rekod" value="0">
                                                <input type="submit"  value="Daftar" class="btn btn-primary">
                                            </div>
                                        </center>
                                    </div>
                                </div>
                            <?php }?>
                        <?php } else { ?>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Nama Penuh</label>
                                            <input type="text" name="nama_penuh" id="nama_penuh" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>No Pengenalan</label>
                                            <input type="text" name="no_pengenalan" id="no_pengenalan" minlength="12" maxlength="12" value="<?php echo $_GET['no_ic']; ?>" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>No. Telefon</label>
                                            <input class="form-control" type="text" name="no_telefon" id="no_telefon" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Alamat e-mel</label>
                                            <input class="form-control" type="email" name="emel" id="emel" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Kategori Jawatankuasa</label>
                                            <select class="form-control" name="kat_jawatan" id="kat_jawatan" required>
                                                <option value =""></option>
                                                <option value ="ajk">Ahli Jawatankuasa Masjid</option>
                                                <option value ="pegawai">Pegawai Masjid</option>
                                                <option value ="pengurusan">Pengurusan Masjid</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <!--select-->
                                        <div class="form-group" id="id_jawatankuasaDiv">
                                            <label>Jawatan</label>
                                            <select class="form-control" name="id_jawatankuasa" id="id_jawatankuasa" disabled required>
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Tarikh Lantikan</label>
                                            <input class="form-control" type="date" name="tarikh_lantikan" id="tarikh_lantikan" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Muat Naik Fail</label>
                                            <input type="file" class="form-control-file" name="gambar" id="gambar" />
                                        </div>
                                        <!--                                    <div class="form-group">-->
                                        <!--                                        <label>Upload Fail</label>-->
                                        <!--                                        <input type="file" class="form-control" name="file" id="file" />-->
                                        <!--                                    </div>-->
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <center>
                                            <div class="form-group">
                                                <input type="hidden" name="jenisPengenalan" value="<?php echo $_GET['jenisPengenalan']; ?>">
                                                <input type="hidden" name="id_rekod" value="0">
                                                <input type="submit"  value="Daftar" class="btn btn-primary">
                                            </div>
                                        </center>
                                    </div>
                                </div>
                        <?php }?>
                        </form>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<script>

    $(document).ready(function() {
        $('#kat_jawatan').change(function() {
            var selectedOption = $(this).val();
            if (selectedOption !== '') {
                // Make an AJAX request to retrieve the options for the dynamic select box
                $.ajax({
                    url: './admin/ajax_daftarorganisasi.php',
                    type: 'POST',
                    data: { "option": selectedOption },
                    // contentType: "application/json;charset=utf-8",
                    // dataType: "json",
                    success: function(response) {
                        // Assuming the response is an array of options
                        console.log(response);
                        var options = JSON.parse(response);

                        // Clear the dynamic select box
                        $('#id_jawatankuasa').empty();

                        // Add the new options
                        $('#id_jawatankuasa').append('<option value=""></option>'); // Empty option

                        for (var i = 0; i < options.length; i++) {
                            var optionValue = options[i].value;
                            var optionLabel = options[i].label;
                            var optionLabel2 = options[i].label2;

                            var displayLabel = '';

                            if (optionLabel2 && optionLabel2 !== 'null') {
                                displayLabel = optionLabel.toUpperCase() + ' - ' + optionLabel2.toUpperCase();
                            } else {
                                displayLabel = optionLabel.toUpperCase();
                            }

                            $('#id_jawatankuasa').append('<option value="' + optionValue + '">' + displayLabel + '</option>');
                        }

                        $('#id_jawatankuasa').prop('disabled', false);
                        // Show the dynamic select box
                        $('#id_jawatankuasaDiv').show();
                    },
                    error: function(xhr, status, error) {
                        console.log(error); // Handle the error appropriately
                    }
                });
            } else {
                // Hide the dynamic select box if no option is selected
                $('#id_jawatankuasaDiv').hide();
            }
        });
    });
</script>
