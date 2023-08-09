<?php

    include('../connection/connection.php');

    $status_success = array();
    $f              = 1;
    $id_masjid = $_POST['id_masjid'];
    $id_surat = $_POST['id_surat'];
    $jenis_surat = $_POST['jenis_surat'];
    $tajuk_surat = strtoupper($_POST['tajuk_surat']);
    $no_rujukan = $_POST['no_rujukan'];
    $tarikh = $_POST['tarikh'];
    $tarikh_majlis = $_POST['tarikh_majlis'];
    $masa = $_POST['masa'];
    $masa_tamat = $_POST['masa_tamat'];
    $penerima = $_POST['penerima'];
    $alamat_1 = $_POST['alamat_1'];
    $alamat_2 = $_POST['alamat_2'];
    $alamat_3 = $_POST['alamat_3'];
    $poskod = $_POST['poskod'];
    $bandar = $_POST['bandar'];
    $id_negeri = $_POST['id_negeri'];
    $date_now = date("Y-m-d h:i:s");


    //$qr = "SELECT IF(MAX(no_rujukan) IS NOT NULL, MAX(no_rujukan) + 1, 1) 'No Rujukan'FROM surat_rasmi";
    //$list_qr = mysqli_query($koneksi, $qr) or die(mysqli_error($koneksi));
    //$row_qr = mysqli_fetch_assoc($list_qr);
    //$no_rujukan = $row_qr['No Rujukan'];

    $myObj = array();
    if(count($_POST['id_isi']) > 0) {
    for ($i = 0; $i < count($_POST['id_isi']); $i++) {
    $myObj[$i]->id_isi    = $_POST['id_isi'][$i];
    $myObj[$i]->isi_surat = preg_replace('/\s/', ' ', $_POST['isi_surat'][$i]);
    }
    }

    //Simpan isi surat (1 ke atas) dalam Format JSON
    $isi_surat = json_encode($myObj);

    if($id_surat == NULL) $q_surat = "INSERT INTO surat_rasmi (id_masjid, jenis_surat, no_rujukan, tajuk_surat, tarikh, tarikh_majlis, masa, masa_tamat, penerima, alamat_1, alamat_2, alamat_3, poskod, bandar, id_negeri, last_added) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    //if($id_surat != NULL) $q_surat = "UPDATE surat_rasmi SET id_kampung = ?, jenis_surat = ?, no_rujukan = ?, tajuk_surat = ?, tarikh = ?, tarikh_majlis = ?, masa = ?, masa_tamat = ?, penerima = ?, alamat_1 = ?, alamat_2 = ?, alamat_3 = ?, poskod = ?, bandar = ?, id_negeri = ?, nama = ?, no_kp = ?, jawatan = ?, last_added = ? WHERE id_surat = ?";
    $stmt = $bd2->prepare($q_surat);
    if($id_surat == NULL) $stmt->bind_param("iiisssssssssssis", $id_masjid, $jenis_surat, $no_rujukan, $tajuk_surat, $tarikh, $tarikh_majlis, $masa, $masa_tamat, $penerima, $alamat_1, $alamat_2, $alamat_3, $poskod, $bandar, $id_negeri,$date_now);
    //if($id_surat != NULL) $stmt->bind_param("iiisssssssssssissssi", $id_kampung, $jenis_surat, $no_rujukan, $tajuk_surat, $tarikh, $tarikh_majlis, $masa, $masa_tamat, $penerima, $alamat_1, $alamat_2, $alamat_3, $poskod, $bandar, $id_negeri, $nama, $no_kp, $jawatan, $date_now, $id_surat);
    if($stmt->execute()) {
    if($id_surat == NULL) $id_surat = $stmt->insert_id;
    $status_success[$f] = 1;
    $f++;
    $k = "UPDATE surat_rasmi SET isi_surat = '$isi_surat' WHERE id_surat = $id_surat";
    if(mysqli_query($bd2, $k)) $status_success[$f] = 1 or die(mysqli_error($koneksi));
    }
    else {
    $status_success[$f] = 0;
    echo '<br />ERROR: '.$stmt->errno.' '.$stmt->error;
    }

    $pass = 1;
    for($s = 1; $s <= count($status_success); $s++) {
    if($status_success[$s] == 0) $pass = 0;
    if($pass == 1 && $s == count($status_success)) { header("Location:../utama.php?view=admin&action=rekod_surat_rasmi"); }
    //if($pass == 1 && $s == count($status_success)) echo '<button class="tst3 btn btn-success btn-block btn-rounded mb-15">Surat Rasmi BERJAYA disimpan</button>';
    //if($pass == 0 && $s == count($status_success)) echo '<button class="tst4 btn btn-danger btn-block btn-rounded mb-15">Surat Rasmi GAGAL disimpan</button>';
    }

?>