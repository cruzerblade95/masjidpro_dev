<?php

    include("connection/connection.php");

    $sql_masjid = "SELECT * FROM sej6x_data_masjid WHERE id_masjid='$id_masjid'";
    $query_masjid = mysqli_query($bd2,$sql_masjid);
    $data_masjid = mysqli_fetch_array($query_masjid);

    $sql_user = "SELECT a.user_name, b.user_type FROM masjid_user a, jenis_user b WHERE a.user_id='$user_id' AND a.user_type_id=b.user_type_id";
    $query_user = mysqli_query($bd2,$sql_user);
    $data_user = mysqli_fetch_array($query_user);
    $user_type = $data_user['user_type'];

    $id_surat = $_GET['id_surat'];
	if(!is_numeric($id_surat)) $id_surat = "0";
	$q1 = "SELECT * FROM surat_rasmi WHERE $id_masjid = $id_masjid AND id_surat = $id_surat";
	$m1 = mysqli_query($bd2, $q1) or die(mysqli_error($bd2));
	$r1 = mysqli_fetch_assoc($m1);

	$myJSON = json_decode($r1['isi_surat'], true);

	$num_atur = count($myJSON);
	//if($_GET['jenis_surat'] == 2 || $r1['jenis_surat'] == 2 || $_GET['jenis_surat'] == 8 || $r1['jenis_surat'] == 8) {
	    //if($num_atur == NULL) $num_atur = 5 + 1;
	    //else $num_atur = '2';
	    //echo($num_atur);

?>
    <script type="text/javascript">
        $(document).ready(function(){
            var i=<?php echo($num_atur); ?>;
            $('#add_input').click(function(){
                i++;
                <?php if($_GET['jenis_surat'] == 2 || $r1['jenis_surat'] == 2) { ?>
                $('#borang_dinamik').append('<div id="row'+i+'" class="form-group row"><div class="col-12 col-md-2"><input class="form-control" type="time" name="id_isi[]" value=""></div><div class="col-12 col-md-8"><input name="isi_surat[]" type="text" class="form-control" placeholder="" value=""></div><div class="col-12 col-md-2"><button type="button" name="remove" id="'+i+'" class="btn_remove btn-primary btn btn-info btn-block">Padam</button></div></div>');
                <?php } if($_GET['jenis_surat'] == 8 || $r1['jenis_surat'] == 8) { ?>
                $('#borang_dinamik').append('<div id="row'+i+'" class="row form-group"><div class="col-12 col-md-10"><li><input class="form-control" type="hidden" name="id_isi[]" value="'+i+'"><input name="isi_surat[]" type="text" class="form-control" placeholder="" value=""></li></div><div class="col-12 col-md-2"><button type="button" name="remove" id="'+i+'" class="btn_remove btn-primary btn btn-info btn-block">Padam</button></div></div>');
                <?php } ?>

            });
            $(document).on('click', '.btn_remove', function(){
                var button_id = $(this).attr("id");
                $('#row'+button_id+'').remove();
            });
        });
    </script>
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Surat Rasmi</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li class="active">Surat Rasmi</li>
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
                    Jenis Surat Rasmi
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <select class="form-control" name="jenis_surat" style="width:300px" onChange="document.location.href='utama.php?view=admin&action=surat_rasmi&jenis_surat='+this.options[this.selectedIndex].value">
                            <option>Jenis Surat:-</option>
                            <option value="1" <?php if(isset($_GET['jenis_surat'])) { if($_GET['jenis_surat']=="1") { echo "selected"; } } ?>>Surat Aduan</option>
                            <option value="2" <?php if(isset($_GET['jenis_surat'])) { if($_GET['jenis_surat']=="2") { echo "selected"; } } ?>>Surat Jemputan</option>
                            <option value="7" <?php if(isset($_GET['jenis_surat'])) { if($_GET['jenis_surat']=="7") { echo "selected"; } } ?>>Surat Jemputan Mesyuarat</option>
                            <option value="3" <?php if(isset($_GET['jenis_surat'])) { if($_GET['jenis_surat']=="3") { echo "selected"; } } ?>>Surat Pemberitahuan</option>
                            <option value="4" <?php if(isset($_GET['jenis_surat'])) { if($_GET['jenis_surat']=="4") { echo "selected"; } } ?>>Surat Pengesahan</option>
                            <option value="5" <?php if(isset($_GET['jenis_surat'])) { if($_GET['jenis_surat']=="5") { echo "selected"; } } ?>>Surat Permohonan</option>
                            <option value="6" <?php if(isset($_GET['jenis_surat'])) { if($_GET['jenis_surat']=="6") { echo "selected"; } } ?>>Surat Sokongan</option>
                        </select>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <?php
    if(isset($_GET['jenis_surat'])){
    ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <?php
                    if($_GET['jenis_surat']=="1"){
                        $nama_surat = "Aduan";
                        $jenis_surat = "1";
                    }
                    else if($_GET['jenis_surat']=="2"){
                        $nama_surat = "Jemputan";
                        $jenis_surat = "2";
                    }
                    else if($_GET['jenis_surat']=="3"){
                        $nama_surat = "Pemberitahuan";
                        $jenis_surat = "3";
                    }
                    else if($_GET['jenis_surat']=="4"){
                        $nama_surat = "Pengesahan";
                        $jenis_surat = "4";
                    }
                    else if($_GET['jenis_surat']=="5"){
                        $nama_surat = "Permohonan";
                        $jenis_surat = "5";
                    }
                    else if($_GET['jenis_surat']=="6"){
                        $nama_surat = "Sokongan";
                        $jenis_surat = "6";
                    }
                    ?>
                    Maklumat Surat <?php echo $nama_surat; ?>
                </div>
                <div class="card-body">
                    <form name="add_surat" id="add_surat" action="admin/add_surat_rasmi.php" method="post" class="form-validate form-horizontal well form-element2" enctype="multipart/form-data">
                        <?php if($jenis_surat != NULL) { ?>
                            <div class="row">
                                <div class="col-6 col-md-6"><h3>Surat <?php echo $nama_surat; ?></h3></div>
                                <!-- Query Kalau Ada Data -->
                                <!-- <div class="col-6 col-md-6"><button type="button" class="btn-primary btn btn-info btn-block margin-top-10">Lihat / Cetak</button></a></div> -->
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-12 col-md-12">
                                            <label>* Perkara (Tajuk):</label>
                                            <input name="jenis_surat" id="jenis_surat" type="hidden" value="<?php echo $jenis_surat; ?>" />
                                            <input id="tajuk_surat" name="tajuk_surat" required aria-required="true" placeholder="Tajuk Surat (Perkara)" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-12"><h3>Maklumat <?php if($jenis_surat == "2"){ echo 'Majlis Jemputan'; }else{ echo 'Penerima'; }?></h3></div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-12">
                                        <div class="form-group row">
                                            <div class="col-12 col-md-6">
                                                <label>* <?php if($jenis_surat == 2) echo 'Nama'; ?> Penerima:</label>
                                                <input class="form-control required" id="penerima" name="penerima" required aria-required="true">
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label>Alamat 1:</label>
                                                <input class="form-control" id="alamat_1" name="alamat_1">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12 col-md-6">
                                                <label>Alamat 2:</label>
                                                <input class="form-control" id="alamat_2" name="alamat_2">
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label>Alamat 3:</label>
                                                <input class="form-control" id="alamat_3" name="alamat_3">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12 col-md-2">
                                                <label>Poskod:</label>
                                                <input class="form-control" id="poskod" name="poskod" maxlength="5" type="number" step="1">
                                            </div>
                                            <div class="col-12 col-md-5">
                                                <label>Bandar:</label>
                                                <input class="form-control" id="bandar" name="bandar">
                                            </div>
                                            <div class="col-12 col-md-5">
                                                <label>Negeri</label>
                                                <select class="form-control" id="id_negeri" name="id_negeri">
                                                    <option value="">Pilih Negeri:-</option>
                                                    <?php
                                                    $sql_negeri="SELECT * FROM negeri";
                                                    $query_negeri=mysqli_query($bd2,$sql_negeri);
                                                    while($data_negeri=mysqli_fetch_array($query_negeri))
                                                    {
                                                    ?>
                                                    <option value="<?php echo $data_negeri['id_negeri']; ?>"><?php echo $data_negeri['name']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12 col-md-6">
                                                <label>* Tarikh : </label>
                                                <input required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" class="form-control required" id="tarikh" name="tarikh" type="date" aria-required="true" >
                                            </div>
                                        </div>
                                    <?php if($jenis_surat == 2){ ?>
                                        <div class="form-group row">
                                            <div class="col-12 col-md-6">
                                                <label>* Tarikh Majlis : </label>
                                                <input required class="form-control required" id="tarikh_majlis" name="tarikh_majlis" type="date" aria-required="true">
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label>* Masa</label>
                                                <input required class="form-control required" id="masa" name="masa" type="time" aria-required="true">
                                            </div>
                                            <div class="col-12 col-md-12">
                                                <label>* Tempat</label>
                                                <input type="hidden" value="2" name="id_isi[]">
                                                <input required class="form-control required" name="isi_surat[]" type="text" aria-required="true">
                                            </div>
                                        </div>
                                        <?php if($jenis_surat == 2) { ?>
                                            <div class="form-group row">
                                                <div class="col-12 col-md-12">
                                                    <label>Lain-lain</label>
                                                    <input type="hidden" value="3" name="id_isi[]">
                                                    <input class="form-control" name="isi_surat[]" type="text">
                                                </div>
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-12"><h3>Isi Surat</h3></div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-12 col-md-12">
                                            <?php if($jenis_surat == 1) { ?>
                                                <label>Berhubung dengan perkara di atas saya selaku <?php echo ucwords(strtolower($data_masjid['nama_masjid'])); ?> Ingin membuat aduan kepada pihak tuan bagi  menyiasat, memantau dan mengambil tidakan yang sewajarnya.</label>
                                            <?php } ?>
                                            <?php if($jenis_surat == 2) { ?>
                                                <label>Berhubung dengan perkara di atas, kami Ahli Jawatankuasa dan Ahli Kariah <?php echo ucwords(strtolower($data_masjid['nama_masjid'])); ?> dengan besar hati ingin menjemput <strong class="jemput"><?php echo($r1['penerima']); ?></strong> bagi menghadiri majlis yang bakal di adakan di masjid kami seperti berikut :</label>
                                            <?php } ?>
                                            <?php if($jenis_surat == 3) { ?>
                                                <label>Berhubung dengan perkara di atas, adalah dimaklumkan kepada seluruh Ahli Kariah <?php echo ucwords(strtolower($data_masjid['nama_masjid'])); ?> bahawa, </label>
                                            <?php } ?>
                                            <?php if($jenis_surat == 4) { ?>
                                                <label>Merujuk perkara di atas, saya yang bernama <?php echo ucwords(strtolower($data_user['user_name'])); ?>,
                                                    selaku <?php echo "Pengerusi"; //ucwords(strtolower($user_type)); ?> <?php echo ucwords(strtolower($data_masjid['nama_masjid'])); ?>
                                                    dengan ini megesahkan bahawa :</label>
                                            <?php } ?>
                                            <?php if($jenis_surat == 5) { ?>
                                                <label>Berhubung dengan perkara di atas, kami Ahli Jawatankuasa bersama Ahli Kariah <?php echo ucwords(strtolower($data_masjid['nama_masjid'])); ?> ingin membuat permohonan :</label>
                                            <?php } ?>
                                            <?php if($jenis_surat == 6) { ?>
                                                <label>Berhubung dengan perkara di atas, saya selaku <?php echo "Pengerusi"; //ucwords(strtolower($user_type)); ?> <?php echo ucwords(strtolower($data_masjid['nama_masjid'])); ?>, dengan ini suka cita memaklumkan bahawa saya menyokong cadangan / individu</label>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <?php if($jenis_surat == 1) { ?>
                                        <div class="form-group row">
                                            <div class="col-12 col-md-12">
                                                <label>2.0 Aduan ini adalah sehubungan dengan perkara seperti berikut :</label>
                                                <input type="hidden" name="id_isi[]" value="2">
                                                <textarea name="isi_surat[]" rows="5" required aria-required="true" class="form-control required" placeholder="Adukan permasaalahan dan kesan"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12 col-md-12">
                                                <label>3.0 Pihak kami telah mengambil tindakan seperti berikut sebagai pendekatan pertama  :</label>
                                                <input type="hidden" name="id_isi[]" value="3">
                                                <textarea name="isi_surat[]" rows="5" required aria-required="true" class="form-control required" placeholder="Nyatakan tindakkan yang telah diambil"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12 col-md-12">
                                                <label>4.0 Melihat kepada situasi sekarang ini pihak kami ingin mencadangkan agar, </label>
                                                <input type="hidden" name="id_isi[]" value="4">
                                                <textarea name="isi_surat[]" rows="5" required aria-required="true" class="form-control required" placeholder="Nyatakan cadangan tindakan yang diinginkan bagi menyelesaikan permasalahan"></textarea>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if($jenis_surat == 3) { ?>
                                        <div class="form-group row">
                                            <div class="col-12 col-md-12">
                                                <input type="hidden" name="id_isi[]" value="2">
                                                <textarea name="isi_surat[]" rows="5" required aria-required="true" class="form-control required" placeholder="Nyatakan perkara yang ingin diberitahu"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12 col-md-12">
                                                <input type="hidden" name="id_isi[]" value="3">
                                                <textarea name="isi_surat[]" rows="5" class="form-control" placeholder="Nyatakan perkara yang ingin diberitahu atau lain-lain makluman (tambahan)"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12 col-md-12">
                                                <label>2.0 Segala kerjasama amatlah kami hargai dan kami dahului dengan ribuan terima kasih. Sekiranya terdapat sebarang pertanyaan bolehlah menghubungi :</label>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <input type="hidden" name="id_isi[]" value="4"><input placeholder="Masukkan nama" class="form-control" type="text" name="isi_surat[]">
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <input type="hidden" name="id_isi[]" value="5"><input placeholder="Masukkan nombor telefon yang boleh dihubungi" class="form-control"  type="text" name="isi_surat[]">
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if($jenis_surat == 4) { ?>
                                        <div class="form-group row">
                                            <div class="col-12 col-md-12">
                                                <input type="hidden" name="id_isi[]" value="2">
                                                <textarea name="isi_surat[]" rows="5" required aria-required="true" class="form-control required" placeholder="Nama Ahli Kariah / No IC Ahli Kariah atau Maklumat Yang Diberikan atau Perkara yang berkaitan"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12 col-md-12">
                                                <label>2.0 Pengesahan ini di buat adalah bagi tujuan : </label>
                                                <input type="hidden" name="id_isi[]" value="3">
                                                <textarea name="isi_surat[]" rows="5" required aria-required="true" class="form-control required" placeholder="Sila masukkan maklumat berkaitan tujuan pengesahan"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12 col-md-12">
                                                <label>3.0 Dengan pengesahan ini pihak saya selaku pengerusi <?php echo ucwords(strtolower($data_masjid['nama_masjid'])); ?> beserta seluruh ahli kariah tidak menangung sebarang libiliti daripada pengesahan ini.</label>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if($jenis_surat == 5) { ?>
                                        <div class="form-group row">
                                            <div class="col-12 col-md-12">
                                                <input type="hidden" name="id_isi[]" value="2">
                                                <input class="form-control" type="text" name="isi_surat[]" placeholder="Perkara Yang Ingin di mohon">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12 col-md-12">
                                                <input type="hidden" name="id_isi[]" value="3">
                                                <textarea name="isi_surat[]" rows="5" class="form-control" placeholder="Tujuan Permohonan"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12 col-md-12">
                                                <label>2.0 Berikut adalah perincian mengenai permohonan kami :</label>
                                                <input type="hidden" name="id_isi[]" value="4">
                                                <textarea name="isi_surat[]" rows="10" class="form-control" placeholder="Masukkan perincian mengenai permohonan yang dibuat"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12 col-md-12">
                                                <label>3.0 Sebagai pengerusi, saya bagi pihak masjid ingin mengucapkan ribuan terima kasih di atas segala pertimbangan dan sebarang kerjasama yang di berikan.</label>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if($jenis_surat == 6) { ?>
                                        <div class="form-group row">
                                            <div class="col-12 col-md-12">
                                                <input type="hidden" name="id_isi[]" value="2">
                                                <input class="form-control" type="text" name="isi_surat[]" placeholder="Nyatakan cadangan / nama individu">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12 col-md-12">
                                                <input type="hidden" name="id_isi[]" value="3">
                                                <textarea name="isi_surat[]" rows="5" class="form-control" placeholder="Nyatakan Tujuan Cadangan / Tujuan hasrat Individu"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12 col-md-12">
                                                <label>2.0 Sebagai pengerusi masjid, saya berpendapat bahawa ,</label>
                                                <input type="hidden" name="id_isi[]" value="4">
                                                <textarea name="isi_surat[]" rows="5" class="form-control" placeholder="Nyatakan pendapat, mengapa menyokong"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12 col-md-12">
                                                <label>3.0 Justeru saya berharap pihak yang berkenaan dapat mempertimbangkan cadangan atau permohonan yang telah dibuat.</label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12 col-md-12">
                                                <label>4.0 Sekian untuk makluman dan terima kasih di atas segala kerjasama yang di berikan.</label>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if($jenis_surat == 2) { ?>
                                        <div class="form-group row">
                                            <div class="col-12 col-md-12">
                                                <label>2.0 Berikut adalah aturcara majlis yang bakal di adakan : </label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12 col-md-2">Masa</div>
                                            <div class="col-12 col-md-8">Perkara</div>
                                            <div class="col-12 col-md-2">&nbsp;</div>
                                        </div>
                                        <div id="borang_dinamik">
                                            <div id="row<?php echo($i); ?>" class="form-group row">
                                                <div class="col-12 col-md-2">
                                                    <input class="form-control" type="time" name="id_isi[]"">
                                                </div>
                                                <div class="col-12 col-md-8">
                                                    <input name="isi_surat[]" type="text" class="form-control" placeholder="">
                                                </div>
                                                <div class="col-12 col-md-2">
                                                    <button type="button" name="remove" id="<?php echo($i); ?>" class="btn_remove btn-primary btn btn-info btn-block margin-top-10">Padam</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12 col-md-2"><div class="form-group"><h4><div align="center">&nbsp;</div></h4></div></div>
                                            <div class="col-12 col-md-8"><div class="form-group"><h4><div align="center">&nbsp;</div></h4></div></div>
                                            <div class="col-12 col-md-2"><div class="form-group"><div align="center"><button type="button" class="btn-primary btn btn-info btn-block margin-top-10" id="add_input" name="add">Tambah</button></div></div></div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12 col-md-12">
                                                <label>3.0 Kami amat bebesar hati sekiranya pihak <strong class="jemput"><?php echo($r1['penerima']); ?></strong> dapat bersama kami dan pasti menyerikan dan menyempurnakan lagi majlis kami.</label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12 col-md-12">
                                                <label>4.0 Segala kerjasama amatlah kami hargai dan kami dahului dengan ribuan terima kasih.</label>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div class="form-group row">
                                        <div class="col-12 col-md-12">
                                            <?php if($jenis_surat == 1) { ?>
                                                <label>5.0 Pihak kami sangat berhadap agar permasaalahan ini dapat di selesaikan dengan seberapa segera.  Keperihatinan dan segala kerjasama yang di berikan amat kami hargai.</label>
                                            <?php } ?>
                                            <?php if($jenis_surat == 4) { ?>
                                                <label>4.0 Segala kerjasama amatlah kami hargai dan kami dahului dengan ribuat terima kasih.</label>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-12 col-md-12">Sekian, terima kasih</div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-12 col-md-12"><?php echo($r_info['Motto']); ?></div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-12 col-md-12">Yang benar,<br /><br /><br /><br />
                                            ..............................................................
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-12 col-md-6">
                                            <h4><b><?php
                                                    $sql_pengerusi = "SELECT * FROM data_ajkmasjid WHERE id_masjid='$id_masjid' AND jawatan='Pengerusi'";
                                                    $query_pengerusi = mysqli_query($bd2,$sql_pengerusi);
                                                    $data_pengerusi = mysqli_fetch_array($query_pengerusi);
                                                    if($data_pengerusi['id_ajk']!==""){
                                                        $id_data = $data_pengerusi['id_ajk'];
                                                        $sql = "SELECT * FROM sej6x_data_peribadi WHERE id_data='$id_data'";
                                                        $sqlquery = mysqli_query($bd2,$sql);
                                                    }
                                                    else if($data_pengerusi['id_ajk2']!==""){
                                                        $ID = $data_pengerusi['id_ajk2'];
                                                        $sql = "SELECT * FROM sej6x_data_anakqariah WHERE ID='$ID'";
                                                        $sqlquery = mysqli_query($bd2,$sql);
                                                    }
                                                    $data=mysqli_fetch_array($sqlquery);
                                                    echo strtoupper($data['nama_penuh']);
                                                    ?><br>
                                                    PENGERUSI<br>
                                                    <?php echo $nama_masjid; ?></b></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12 col-md-6 text-center">
                                    <input name="id_masjid" id="id_masjid" value="<?php echo $id_masjid; ?>" type="hidden">
                                    <button type="submit" class="btn-primary validate btn btn-info btn-block margin-top-10">Simpan</button>
                                </div>
                            </div>
                        <?php } ?>
                    </form>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <?php
    }
    ?>
</div>