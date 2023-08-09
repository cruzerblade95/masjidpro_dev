<?php
namespace Verot\Upload;
include($_SERVER['DOCUMENT_ROOT']."/Masjid/Classes/phpUpload/class.upload.php");
if($admin_view == NULL) $admin_view = $_POST['admin_view'];
if($admin_view == NULL) {
    $sekerip = "../";
    include('connection.php');
    include('../fungsi.php');
    $daftar_online = 1;
    $id_masjid = $_GET['id_masjid'];
    $id_masjid_dua = e($_GET['id_masjid'], NULL, NULL);

    if (isset($_GET['id_masjid']) && $_GET['id_masjid'] != NULL && $_SERVER["REQUEST_METHOD"] != "POST") {
        $check_masjid = "SELECT * FROM sej6x_data_masjid WHERE id_masjid = $id_masjid";
        $result_masjid = mysqli_query($bd2, $check_masjid) or die(mysqli_error($bd2));
        $num_masjid = mysqli_num_rows($result_masjid);
        if ($num_masjid < 1) header('Location: ../SPMD');
    }

    if (!isset($_GET['id_masjid']) && $_SERVER["REQUEST_METHOD"] != "POST") header('Location: ../SPMD');
    $post_url = htmlspecialchars($_SERVER['PHP_SELF'].'?');
}
if($admin_view != NULL || $_POST['preview'] != NULL) {
    $sekerip = "";
    $post_url = htmlspecialchars($_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'].'&');
}

$sql4 = "SELECT * FROM sej6x_data_masjid WHERE id_masjid = $id_masjid";
$sqlquery4 = mysqli_query($bd2, $sql4) or die(mysqli_error($bd2));
$data4 = mysqli_fetch_array($sqlquery4);
$nama_masjid = $data4['nama_masjid'];
if($_GET['redirect'] == 1) {
    $semak = 1;
    $no_ic = e($_GET['no_ic'], NULL, NULL);
    $jenis_pengenalan = $_GET['jenis_pengenalan'];
}
else {
    $semak = $_POST['semak'];
    $no_ic = e($_POST['no_ic'], NULL, NULL);
    $jenis_pengenalan = $_POST['jenis_pengenalan'];
}
if($_GET['no_ic'] != NULL) {
    $semak = 1;
    $no_ic = e($_GET['no_ic'], NULL, NULL);
    $jenis_pengenalan = $_GET['jenis_pengenalan'];
}

$sql_pengenalan = "SELECT * FROM jenis_pengenalan WHERE id_pengenalan='$jenis_pengenalan'";
$query_pengenalan = mysqli_query($bd2,$sql_pengenalan);
$data_pengenalan = mysqli_fetch_array($query_pengenalan);
$nama_pengenalan = $data_pengenalan['jenis'];


function kemaskini_sakit($a, $b, $c, $d, $e, $f, $g, $h) {
    global $bd2, $id_masjid;
    //echo('<div style="display: none">'.$a.' - '.$b.' - '.$c.' - '.$d.' - '.$e.' - '.$f.' - '.$g.' - '.$h.' - '.count($_POST[$a]).'</div>');
    //if(count((is_countable($_POST[$a])?$_POST[$a]:[])) > 0) {
    if(count($_POST[$a]) > 0) {
        for($i = 0; $i < count($_POST[$a]); $i++) {
            $id_sakit = $_POST[$b][$i];
            $id_penyakit = $_POST[$a][$i];
            $rawatan_terkini = e($_POST[$c][$i], NULL, NULL);

            if($d == 1) $extra_sakit = "(id_data = $e OR id_anak = $e)";
            if($d == 2) $extra_sakit = "(id_data_approved = $e OR id_anak_approved = $e)";
            $q_semak_sakit = "SELECT * FROM sej6x_data_sakit WHERE id_penyakit = $id_penyakit AND rawatan_terkini = '$rawatan_terkini' AND $extra_sakit";
            $q_semak_sakit2 = mysqli_query($bd2, $q_semak_sakit) or die(mysqli_error($bd2));
            $num_sama = mysqli_num_rows($q_semak_sakit2);
            //echo('<div style="display: none">'. $q_semak_sakit . '</div>');

            if($num_sama == 0) {
                if ($id_sakit != NULL) {
                    if ($d == 1) $extra = ", $g = $e, $h = NULL";
                    if ($d == 2) $extra = ", $g = NULL, $h = $e";
                    $kemaskini_sakit = "UPDATE sej6x_data_sakit SET masa = NOW(), id_masjid = $id_masjid, id_penyakit = $id_penyakit, rawatan_terkini = '$rawatan_terkini' $extra WHERE id_sakit = $id_sakit";
                }
                if ($id_sakit == NULL) {
                    if ($d == 1) $extra = $g;
                    if ($d == 2) $extra = $h;
                    $kemaskini_sakit = "INSERT INTO sej6x_data_sakit (masa, id_masjid, id_penyakit, rawatan_terkini, $extra) VALUES (NOW(), $id_masjid, $id_penyakit, '$rawatan_terkini', $e)";
                }
                mysqli_query($bd2, $kemaskini_sakit) or die(mysqli_error($bd2));
            }
        }
    }

    //if(count((is_countable($_POST[$f])?$_POST[$f]:[])) > 0) {
    if(count($_POST[$f]) > 0) {
        for($j = 0; $j < count($_POST[$f]); $j++) {
            $id_sakit_padam = $_POST[$f][$j];
            if($id_sakit_padam != NULL) {
                $padam_sakit = "DELETE FROM sej6x_data_sakit WHERE id_sakit = $id_sakit_padam";
                mysqli_query($bd2, $padam_sakit) or die(mysqli_error($bd2));
            }
        }
    }
}
if($_SERVER["REQUEST_METHOD"] == "POST") $id_masjid = $_POST['id_masjid'];
else if($_GET['redirect'] == 1) $id_masjid = $_SESSION['id_masjid'];
//echo($semak.'<br />'.$no_ic);
if (isset($_POST['simpan']) && $semak == 2) {
    $id_data = e($_POST['id_data'], '', '');
    $no_rujukan = e($_POST['no_rujukan'], 1, '');
    $nama_penuh = e($_POST['nama_penuh'], 1, '');
    $no_hp = e($_POST['no_hp'], NULL, NULL);
    //$umur = $_POST['umur'];
    $jenis_pengenalan = $_POST['jenis_pengenalan'];
    $tarikh_lahir = $_POST['tarikh_lahir'];
    $jantina = e($_POST['jantina'], NULL, NULL);
    $bangsa = $_POST['bangsa'];
    $warganegara = $_POST['warganegara'];
    if($warganegara==2){
        $id_negara = $_POST['id_negara'];
    }
    $status_perkahwinan = $_POST['status_perkahwinan'];
    $oku = $_POST['oku'];
    if($_POST['jenis_oku'] != NULL) {
        $array_oku = $_POST['jenis_oku'];
        $jenis_oku = implode(',', $array_oku);
    }
    $pekerjaan = e($_POST['pekerjaan'], NULL, NULL);
	$pendapatan = $_POST['pendapatan'];
	$pemilikan = $_POST['pemilikan'];
	$pemilikan2 = $_POST['pemilikan2'];
	if($pemilikan2 == NULL) $pemilikan2="";
    $tempoh_tinggal = e($_POST['tempoh_tinggal'], NULL, NULL);
    $zon_qariah = $_POST['zon_qariah'];
    $alamat_terkini = e($_POST['alamat_terkini'], 1, NULL);

    if(file_exists($_FILES['image_field']['tmp_name']) || is_uploaded_file($_FILES['image_field']['tmp_name'])) {
        $handle = new Upload($_FILES['image_field']);
        $bukti_kariah = 'data:' . $handle->file_src_mime . ';base64,' . base64_encode($handle->process());
    }
    if(file_exists($_FILES['image_profil']['tmp_name']) || is_uploaded_file($_FILES['image_profil']['tmp_name'])) {
        $handle = new Upload($_FILES['image_profil']);
        $gambar_profil = 'data:' . $handle->file_src_mime . ';base64,' . base64_encode($handle->process());
    }


    $id_negeri = $_POST['id_negeri'];

    $id_daerah = $_POST['id_daerah'];

    $poskod = e($_POST['poskod'], NULL, NULL);
    $solat_jumaat = $_POST['solat_jumaat'];
    $warga_emas = $_POST['warga_emas'];
    $data_asnaf = $_POST['data_asnaf'];
    $data_ibutunggal = $_POST['data_ibutunggal'];
    $data_anakyatim = $_POST['data_anakyatim'];
    $data_sakit = $_POST['data_sakit'];
    $data_mualaf = $_POST['data_mualaf'];
    $tarikh_mualaf = $_POST['tarikh_mualaf'];
    $tempat_mualaf = e($_POST['tempat_mualaf'], NULL, NULL);
    $dihadapan_mualaf = e($_POST['dihadapan_mualaf'], NULL, NULL);
    $data_khairat = $_POST['data_khairat'];
    $added_by = $_SESSION['user_id'];
    if($solat_jumaat == NULL) $solat_jumaat = 0;
    if($data_ibutunggal == NULL) $data_ibutunggal = 2;
    if($data_anakyatim == NULL) $data_anakyatim = 2;
    if($data_mualaf == NULL) $data_mualaf = 2;

    mysqli_select_db($bd2, $mysql_database);

    $kuiri = "SELECT * FROM sej6x_data_peribadi WHERE no_ic='$no_ic'";
    $kuirirun = mysqli_query($bd2, $kuiri) or die(mysqli_error($bd2));
    $run = mysqli_num_rows($kuirirun);
    if ($run > 0) {
        $kemaskini = "UPDATE sej6x_data_peribadi SET id_negara='$id_negara', tarikh_mualaf = '$tarikh_mualaf', tempat_mualaf = '$tempat_mualaf', dihadapan_mualaf = '$dihadapan_mualaf', data_khairat = '$data_khairat', data_mualaf = '$data_mualaf', no_rujukan = '$no_rujukan', data_sakit = '$data_sakit', data_asnaf = '$data_asnaf', data_ibutunggal = '$data_ibutunggal', data_anakyatim = '$data_anakyatim', nama_penuh = '$nama_penuh', no_ic = '$no_ic', tarikh_lahir = '$tarikh_lahir', no_hp = '$no_hp', jantina = '$jantina', bangsa = $bangsa, warganegara = $warganegara, status_perkahwinan = $status_perkahwinan, pekerjaan = '$pekerjaan', pendapatan = '$pendapatan', tempoh_tinggal = '$tempoh_tinggal', zon_qariah = '$zon_qariah', alamat_terkini = '$alamat_terkini', id_negeri = $id_negeri, id_daerah = $id_daerah, poskod = '$poskod', pemilikkan='$pemilikan', pemilikkan2='$pemilikan2', solat_jumaat = $solat_jumaat, oku = $oku ,jenis_oku = '$jenis_oku' WHERE id_data = $id_data";
        mysqli_query($bd2, $kemaskini) or die(mysqli_error($bd2));
        kemaskini_sakit('id_penyakit', 'id_sakit', 'rawatan_terkini', 1, $id_data, 'id_sakit_padam', 'id_data', 'id_data_approved');
        //echo "<script>alert('Maklumat tuan/puan telah dikemaskini.');</script>";
		if($bukti_kariah!=NULL){
			$kemaskini2 = "UPDATE sej6x_data_peribadi SET bukti_kariah='$bukti_kariah' WHERE no_ic='$no_ic'";
			mysqli_query($bd2, $kemaskini2) or die(mysqli_error($bd2));
		}
        if($gambar_profil!=NULL){
            $kemaskini2 = "UPDATE sej6x_data_peribadi SET gambar_profil='$gambar_profil' WHERE no_ic='$no_ic'";
            mysqli_query($bd2, $kemaskini2) or die(mysqli_error($bd2));
        }
    } else if ($run == 0) {
        $sql = "SELECT * FROM approve_qariah WHERE no_ic='$no_ic' AND id_masjid='$id_masjid'";
        $sqlquery = mysqli_query($bd2, $sql) or die(mysqli_error($bd2));
        $row = mysqli_num_rows($sqlquery);
        if ($row > 0) {
            $kemaskini = "UPDATE approve_qariah SET tarikh_mualaf = '$tarikh_mualaf', tempat_mualaf = '$tempat_mualaf', dihadapan_mualaf = '$dihadapan_mualaf', data_khairat = '$data_khairat', data_mualaf = '$data_mualaf', no_rujukan = '$no_rujukan', data_sakit = '$data_sakit', data_asnaf = '$data_asnaf', data_ibutunggal = '$data_ibutunggal', data_anakyatim = '$data_anakyatim', nama_penuh = '$nama_penuh', no_ic = '$no_ic', tarikh_lahir = '$tarikh_lahir', no_tel = '$no_hp', jantina = $jantina, bangsa = $bangsa, warganegara = $warganegara, status_perkahwinan = $status_perkahwinan, pekerjaan = '$pekerjaan', pendapatan = '$pendapatan', tempoh_tinggal = '$tempoh_tinggal', zon_qariah = '$zon_qariah', no_rumah = '$alamat_terkini', negeri = $id_negeri, daerah = $id_daerah, poskod = '$poskod', pemilikkan='$pemilikan', pemilikkan2='$pemilikan2', solat_jumaat = $solat_jumaat, oku = '$oku' , jenis_oku = '$jenis_oku' WHERE id = $id_data";
            mysqli_query($bd2, $kemaskini) or die(mysqli_error($bd2));
            kemaskini_sakit('id_penyakit', 'id_sakit', 'rawatan_terkini', 2, $id_data, 'id_sakit_padam', 'id_data', 'id_data_approved');
            //echo "<script>alert('Maklumat tuan/puan telah dikemaskini dan dalam proses pengesahan oleh pihak masjid.');</script>";
			if($bukti_kariah!=NULL){
			$kemaskini2 = "UPDATE approve_qariah SET bukti_kariah='$bukti_kariah' WHERE no_ic='$no_ic'";
			mysqli_query($bd2, $kemaskini2) or die(mysqli_error($bd2));
			}
            if($gambar_profil!=NULL){
                $kemaskini2 = "UPDATE approve_qariah SET gambar_profil='$gambar_profil' WHERE no_ic='$no_ic'";
                mysqli_query($bd2, $kemaskini2) or die(mysqli_error($bd2));
            }
        } else if ($row == 0) {
            if(in_array($_SESSION['user_type_id'], $user_type_bypass)) {
                $sql1 = "INSERT IGNORE INTO sej6x_data_peribadi
				(jenisPengenalan,id_negara,tarikh_mualaf, tempat_mualaf, dihadapan_mualaf, data_khairat, data_mualaf, no_rujukan, data_sakit, data_anakyatim, data_ibutunggal, data_asnaf, id_masjid,nama_penuh,no_ic,tarikh_lahir,no_hp,umur,jantina,bangsa,warganegara,status_perkahwinan,pekerjaan,tempoh_tinggal,zon_qariah,alamat_terkini,id_negeri,id_daerah,poskod,solat_jumaat,oku,jenis_oku,pendapatan,pemilikkan,pemilikkan2,bukti_kariah,gambar_profil,last_added,added_by)
				VALUES
				('$jenis_pengenalan','$id_negara','$tarikh_mualaf', '$tempat_mualaf', '$dihadapan_mualaf', '$data_khairat', '$data_mualaf', '$no_rujukan', '$data_sakit', '$data_anakyatim', '$data_ibutunggal', '$data_asnaf', '$id_masjid','$nama_penuh','$no_ic','$tarikh_lahir','$no_hp','$umur','$jantina','$bangsa','$warganegara','$status_perkahwinan','$pekerjaan','$tempoh_tinggal','$zon_qariah','$alamat_terkini','$id_negeri','$id_daerah','$poskod', '$solat_jumaat', '$oku','$jenis_oku','$pendapatan','$pemilikan','$pemilikan2','$bukti_kariah','$gambar_profil',NOW(),'$added_by')
				";
            }
            else if(!in_array($_SESSION['user_type_id'], $user_type_bypass)) {
                $sql1 = "INSERT IGNORE INTO approve_qariah
				(tarikh_mualaf, tempat_mualaf, dihadapan_mualaf, data_khairat, data_mualaf, no_rujukan, data_sakit, data_anakyatim, data_ibutunggal, data_asnaf, id_masjid,nama_penuh,no_ic,tarikh_lahir,no_tel,umur,jantina,bangsa,warganegara,status_perkahwinan,pekerjaan,tempoh_tinggal,zon_qariah,no_rumah,negeri,daerah,poskod,solat_jumaat,oku,jenis_oku,pendapatan,pemilikkan,pemilikkan2,gambar_profil,bukti_kariah)
				VALUES
				('$tarikh_mualaf', '$tempat_mualaf', '$dihadapan_mualaf', '$data_khairat', '$data_mualaf', '$no_rujukan', '$data_sakit', '$data_anakyatim', '$data_ibutunggal', '$data_asnaf', '$id_masjid','$nama_penuh','$no_ic','$tarikh_lahir','$no_hp','$umur','$jantina','$bangsa','$warganegara','$status_perkahwinan','$pekerjaan','$tempoh_tinggal','$zon_qariah','$alamat_terkini','$id_negeri','$id_daerah','$poskod', '$solat_jumaat', '$oku','$jenis_oku','$pendapatan','$pemilikan','$pemilikan2','$gambar_profil','$bukti_kariah')
				";
            }

            mysqli_query($bd2, $sql1) or die(mysqli_error($bd2));
            $id_data = mysqli_insert_id($bd2);
            kemaskini_sakit('id_penyakit', 'id_sakit', 'rawatan_terkini', 2, $id_data, 'id_sakit_padam', 'id_data', 'id_data_approved');
        }
    }

    if($run == 0 && !in_array($_SESSION['user_type_id'], $user_type_bypass)) $sql3 = "SELECT * FROM approve_qariah WHERE no_ic = '$no_ic'";
    if($run > 0 || in_array($_SESSION['user_type_id'], $user_type_bypass)) $sql3 = "SELECT * FROM sej6x_data_peribadi WHERE no_ic = '$no_ic'";
    $sqlquery3 = mysqli_query($bd2, $sql3) or die(mysqli_error($bd2));
    $data3 = mysqli_fetch_array($sqlquery3);
    if($run == 0 && !in_array($_SESSION['user_type_id'], $user_type_bypass)) $ID = $data3['id'];
    if($run > 0 || in_array($_SESSION['user_type_id'], $user_type_bypass)) $ID = $data3['id_data'];

    //$number_padam = count((is_countable($_POST['id_padam'])?$_POST['id_padam']:[]));
    $number_padam = count($_POST['id_padam']);
    if($number_padam > 0) {
        for($k = 0; $k < $number_padam; $k++) {
            $id_padam = $_POST['id_padam'][$k];
            if ($id_padam != NULL && is_numeric($id_padam)) {
                if ($run == 0 && !in_array($_SESSION['user_type_id'], $user_type_bypass)) {
                    $sql_del = "DELETE FROM approve_anak WHERE ID = $id_padam";
                    $sql_del_sakit = "DELETE FROM sej6x_data_sakit WHERE id_anak_approved = $id_padam";
                    $sql_check_anak = "SELECT * FROM approve_anak WHERE ID = $id_padam";
                    $sql_check_sakit = "SELECT * FROM sej6x_data_sakit WHERE id_anak_approved = $id_padam";
                }
                if ($run > 0 || in_array($_SESSION['user_type_id'], $user_type_bypass)) {
                    $sql_del = "DELETE FROM sej6x_data_anakqariah WHERE ID = $id_padam";
                    $sql_del_sakit = "DELETE FROM sej6x_data_sakit WHERE id_anak = $id_padam";
                    $sql_check_anak = "SELECT * FROM sej6x_data_anakqariah WHERE ID = $id_padam";
                    $sql_check_sakit = "SELECT * FROM sej6x_data_sakit WHERE id_anak = $id_padam";
                }
                mysqli_query($bd2, $sql_del) or die(mysqli_error($bd2));
                mysqli_query($bd2, $sql_del_sakit) or die(mysqli_error($bd2));
            }
        }
    }

    $number = count($_POST["nama_tanggungan"]);
    $i_form = 1;
    if ($number > 0) {

        for ($i = 0; $i < $number; $i++) {
            $id_anak = $_POST['id_anak'][$i];

            if($_POST["nama_tanggungan"][$i] != NULL) {
                $pengenalan_tanggungan = $_POST["pengenalan_tanggungan"][$i];
                if($pengenalan_tanggungan == 1){
                    $no_ic_tanggungan = $_POST['ic_tanggungan'][$i];
                }
                else if($pengenalan_tanggungan == 2){
                    $no_ic_tanggungan = $_POST['no_polisTentera_tanggungan'][$i];
                }
                else if($pengenalan_tanggungan == 3){
                    $no_ic_tanggungan = $_POST['mypr_tanggungan'][$i];
                }
                else if($pengenalan_tanggungan == 4){
                    $no_ic_tanggungan =  $_POST['no_passport_tanggungan'][$i];
                }
                $semakAsnafPost = $_POST["tanggung_asnaf"][$i];
                if($data_asnaf == 1) $dataAsnafCopy = "Y";
                if($data_asnaf == 2) $dataAsnafCopy = "N";
                if($semakAsnafPost == "SAMA") $semakAsnafPost = $dataAsnafCopy;
                if ($run == 0 && !in_array($_SESSION['user_type_id'], $user_type_bypass)) {
                    if ($id_anak == NULL) {
                        if($_POST["tanggung_tarikh_mualaf"][$i]=='' AND $_POST["tanggung_tempat_mualaf"][$i]=='' AND $_POST["tanggung_dihadapan_mualaf"][$i]=='') {
                            $sql2 = "INSERT INTO approve_anak(status_mualaf, id_qariah, id_masjid, nama_penuh, no_ic, tarikh_lahir, no_tel, bangsa, warganegara, jantina, hubungan, status_oku, status_kahwin, status_sakitkronik, status_asnaf, status_anakyatim) VALUES ('" . $_POST["tanggung_mualaf"][$i] . "', $ID, $id_masjid,'" . e($_POST["nama_tanggungan"][$i], 1, NULL) . "','" . $_POST["ic_tanggungan"][$i] . "', '" . $_POST["tarikh_lahir_tanggungan"][$i] . "','" . $_POST["tel_tanggungan"][$i] . "','" . $_POST["bangsa_tanggungan"][$i] . "','" . $_POST["warganegara_tanggungan"][$i] . "','" . $_POST["jantina_tanggungan"][$i] . "','" . strtoupper($_POST["hubungan_tanggungan"][$i]) . "','" . $_POST["tanggung_oku"][$i] . "','" . $_POST["tanggung_kahwin"][$i] . "','" . $_POST["tanggung_sakitkronik"][$i] . "','" . $semakAsnafPost . "','" . $_POST["tanggung_anakyatim"][$i] . "')";
                        }
                        else{
                            $sql2 = "INSERT INTO approve_anak(tarikh_mualaf, tempat_mualaf, dihadapan_mualaf, status_mualaf, id_qariah, id_masjid, nama_penuh, no_ic, tarikh_lahir, no_tel, bangsa, warganegara, jantina, hubungan, status_oku, status_kahwin, status_sakitkronik, status_asnaf, status_anakyatim) VALUES ('" . $_POST["tanggung_tarikh_mualaf"][$i] . "', '" . $_POST["tanggung_tempat_mualaf"][$i] . "', '" . $_POST["tanggung_dihadapan_mualaf"][$i] . "', '" . $_POST["tanggung_mualaf"][$i] . "', $ID, $id_masjid,'" . e($_POST["nama_tanggungan"][$i], 1, NULL) . "','" . $_POST["ic_tanggungan"][$i] . "', '" . $_POST["tarikh_lahir_tanggungan"][$i] . "','" . $_POST["tel_tanggungan"][$i] . "','" . $_POST["bangsa_tanggungan"][$i] . "','" . $_POST["warganegara_tanggungan"][$i] . "','" . $_POST["jantina_tanggungan"][$i] . "','" . strtoupper($_POST["hubungan_tanggungan"][$i]) . "','" . $_POST["tanggung_oku"][$i] . "','" . $_POST["tanggung_kahwin"][$i] . "','" . $_POST["tanggung_sakitkronik"][$i] . "','" . $semakAsnafPost . "','" . $_POST["tanggung_anakyatim"][$i] . "')";
                        }
                    }
                    if ($id_anak != NULL) {
                        if($_POST["tanggung_tarikh_mualaf"][$i]=='' AND $_POST["tanggung_tempat_mualaf"][$i]=='' AND $_POST["tanggung_dihadapan_mualaf"][$i]==''){
                            $sql2 = "UPDATE approve_anak SET tarikh_mualaf = NULL, tempat_mualaf = NULL, dihadapan_mualaf = NULL, status_mualaf = '" . $_POST["tanggung_mualaf"][$i] . "', nama_penuh = '" . e($_POST["nama_tanggungan"][$i], 1, NULL) . "', no_ic = '" . $_POST["ic_tanggungan"][$i] . "', tarikh_lahir = '" . $_POST["tarikh_lahir_tanggungan"][$i] . "', no_tel = '" . $_POST["tel_tanggungan"][$i] . "', bangsa = '" . $_POST["bangsa_tanggungan"][$i] . "', warganegara = '" . $_POST["warganegara_tanggungan"][$i] . "', jantina = '" . $_POST["jantina_tanggungan"][$i] . "', hubungan = '" . e($_POST["hubungan_tanggungan"][$i], 1) . "', status_oku = '" . $_POST["tanggung_oku"][$i] . "', status_kahwin = '" . $_POST["tanggung_kahwin"][$i] . "', status_sakitkronik = '" . $_POST["tanggung_sakitkronik"][$i] . "', status_asnaf = '" . $semakAsnafPost . "', status_anakyatim = '" . $_POST["tanggung_anakyatim"][$i] . "' WHERE ID = $id_anak";

                        }
                        else {
                            $sql2 = "UPDATE approve_anak SET tarikh_mualaf = '" . $_POST["tanggung_tarikh_mualaf"][$i] . "', tempat_mualaf = '" . $_POST["tanggung_tempat_mualaf"][$i] . "', dihadapan_mualaf = '" . $_POST["tanggung_dihadapan_mualaf"][$i] . "', status_mualaf = '" . $_POST["tanggung_mualaf"][$i] . "', nama_penuh = '" . e($_POST["nama_tanggungan"][$i], 1, NULL) . "', no_ic = '" . $_POST["ic_tanggungan"][$i] . "', tarikh_lahir = '" . $_POST["tarikh_lahir_tanggungan"][$i] . "', no_tel = '" . $_POST["tel_tanggungan"][$i] . "', bangsa = '" . $_POST["bangsa_tanggungan"][$i] . "', warganegara = '" . $_POST["warganegara_tanggungan"][$i] . "', jantina = '" . $_POST["jantina_tanggungan"][$i] . "', hubungan = '" . e($_POST["hubungan_tanggungan"][$i], 1) . "', status_oku = '" . $_POST["tanggung_oku"][$i] . "', status_kahwin = '" . $_POST["tanggung_kahwin"][$i] . "', status_sakitkronik = '" . $_POST["tanggung_sakitkronik"][$i] . "', status_asnaf = '" . $semakAsnafPost . "', status_anakyatim = '" . $_POST["tanggung_anakyatim"][$i] . "' WHERE ID = $id_anak";
                        }
                    }
                }

                if ($run > 0 || in_array($_SESSION['user_type_id'], $user_type_bypass)) {
                    if ($id_anak == NULL)
                    {
                        if($_POST["tanggung_tarikh_mualaf"][$i]=='' AND $_POST["tanggung_tempat_mualaf"][$i]=='' AND $_POST["tanggung_dihadapan_mualaf"][$i]==''){
                            $sql2 = "INSERT INTO sej6x_data_anakqariah(jenisPengenalan,status_mualaf, id_qariah, id_masjid, nama_penuh, no_ic, tarikh_lahir, no_tel, bangsa, warganegara, jantina, hubungan, status_oku, status_kahwin, status_sakit, status_asnaf, status_anakyatim) VALUES ('$pengenalan_tanggungan','" . $_POST["tanggung_mualaf"][$i] . "', $ID, $id_masjid,'" . e($_POST["nama_tanggungan"][$i], 1, NULL) . "','$no_ic_tanggungan', '" . $_POST["tarikh_lahir_tanggungan"][$i] . "','" . $_POST["tel_tanggungan"][$i] . "','" . $_POST["bangsa_tanggungan"][$i] . "','" . $_POST["warganegara_tanggungan"][$i] . "','" . $_POST["jantina_tanggungan"][$i] . "','" . strtoupper($_POST["hubungan_tanggungan"][$i]) . "','" . $_POST["tanggung_oku"][$i] . "','" . $_POST["tanggung_kahwin"][$i] . "','" . $_POST["tanggung_sakitkronik"][$i] . "','" . $semakAsnafPost . "','" . $_POST["tanggung_anakyatim"][$i] . "')";

                        }
                        else {
                            $sql2 = "INSERT INTO sej6x_data_anakqariah(jenisPengenalan,tarikh_mualaf, tempat_mualaf, dihadapan_mualaf, status_mualaf, id_qariah, id_masjid, nama_penuh, no_ic, tarikh_lahir, no_tel, bangsa, warganegara, jantina, hubungan, status_oku, status_kahwin, status_sakit, status_asnaf, status_anakyatim) VALUES ('$pengenalan_tanggungan','" . $_POST["tanggung_tarikh_mualaf"][$i] . "', '" . $_POST["tanggung_tempat_mualaf"][$i] . "', '" . $_POST["tanggung_dihadapan_mualaf"][$i] . "', '" . $_POST["tanggung_mualaf"][$i] . "', $ID, $id_masjid,'" . e($_POST["nama_tanggungan"][$i], 1) . "','$no_ic_tanggungan', '" . $_POST["tarikh_lahir_tanggungan"][$i] . "','" . $_POST["tel_tanggungan"][$i] . "','" . $_POST["bangsa_tanggungan"][$i] . "','" . $_POST["warganegara_tanggungan"][$i] . "','" . $_POST["jantina_tanggungan"][$i] . "','" . strtoupper($_POST["hubungan_tanggungan"][$i]) . "','" . $_POST["tanggung_oku"][$i] . "','" . $_POST["tanggung_kahwin"][$i] . "','" . $_POST["tanggung_sakitkronik"][$i] . "','" . $semakAsnafPost . "','" . $_POST["tanggung_anakyatim"][$i] . "')";
                        }
                    }
                    if ($id_anak != NULL)
                    {
                        if($_POST["tanggung_tarikh_mualaf"][$i]=='' AND $_POST["tanggung_tempat_mualaf"][$i]=='' AND $_POST["tanggung_dihadapan_mualaf"][$i]==''){
                            $sql2 = "UPDATE sej6x_data_anakqariah SET jenisPengenalan='$pengenalan_tanggungan', tarikh_mualaf = NULL, tempat_mualaf = NULL, dihadapan_mualaf = NULL, status_mualaf = '" . $_POST["tanggung_mualaf"][$i] . "', nama_penuh = '" . e($_POST["nama_tanggungan"][$i], 1, NULL) . "', no_ic = '$no_ic_tanggungan', tarikh_lahir = '" . $_POST["tarikh_lahir_tanggungan"][$i] . "', no_tel = '" . $_POST["tel_tanggungan"][$i] . "', bangsa = '" . $_POST["bangsa_tanggungan"][$i] . "', warganegara = '" . $_POST["warganegara_tanggungan"][$i] . "', jantina = '" . $_POST["jantina_tanggungan"][$i] . "', hubungan = '" . e($_POST["hubungan_tanggungan"][$i], 1, NULL) . "', status_oku = '" . $_POST["tanggung_oku"][$i] . "', status_kahwin = '" . $_POST["tanggung_kahwin"][$i] . "', status_sakit = '" . $_POST["tanggung_sakitkronik"][$i] . "', status_asnaf = '" . $semakAsnafPost . "', status_anakyatim = '" . $_POST["tanggung_anakyatim"][$i] . "' WHERE ID = $id_anak";

                        }
                        else {
                            $sql2 = "UPDATE sej6x_data_anakqariah SET jenisPengenalan='$pengenalan_tanggungan', tarikh_mualaf = '" . $_POST["tanggung_tarikh_mualaf"][$i] . "', tempat_mualaf = '" . $_POST["tanggung_tempat_mualaf"][$i] . "', dihadapan_mualaf = '" . $_POST["tanggung_dihadapan_mualaf"][$i] . "', status_mualaf = '" . $_POST["tanggung_mualaf"][$i] . "', nama_penuh = '" . e($_POST["nama_tanggungan"][$i], 1, NULL) . "', no_ic = '$no_ic_tanggungan', tarikh_lahir = '" . $_POST["tarikh_lahir_tanggungan"][$i] . "', no_tel = '" . $_POST["tel_tanggungan"][$i] . "', bangsa = '" . $_POST["bangsa_tanggungan"][$i] . "', warganegara = '" . $_POST["warganegara_tanggungan"][$i] . "', jantina = '" . $_POST["jantina_tanggungan"][$i] . "', hubungan = '" . e($_POST["hubungan_tanggungan"][$i], 1, NULL) . "', status_oku = '" . $_POST["tanggung_oku"][$i] . "', status_kahwin = '" . $_POST["tanggung_kahwin"][$i] . "', status_sakit = '" . $_POST["tanggung_sakitkronik"][$i] . "', status_asnaf = '" . $semakAsnafPost . "', status_anakyatim = '" . $_POST["tanggung_anakyatim"][$i] . "' WHERE ID = $id_anak";
                        }
                    }
                }

                //mysqli_query($bd2, $sql2) or die('Error: '.$sql2.' - '.mysqli_error($bd2));
                mysqli_query($bd2, $sql2) or die(mysqli_error($bd2));
                if ($id_anak == NULL) $id_anak = mysqli_insert_id($bd2);

                if ($run == 0 && !in_array($_SESSION['user_type_id'], $user_type_bypass)) $kemas_sakit = 2;
                if ($run > 0 || in_array($_SESSION['user_type_id'], $user_type_bypass)) $kemas_sakit = 1;
                kemaskini_sakit('id_penyakit_tanggung_' . $i_form, 'id_sakit_tanggung_' . $i_form, 'rawatan_terkini_tanggung_' . $i_form, $kemas_sakit, $id_anak, 'id_sakit_padam_tanggung_' . $i_form, 'id_anak', 'id_anak_approved');
                $i_form++;
            }
        }
    }

    if($no_ic != NULL && ($run == 0 && $row == 0)) $notis = 1;
    if($no_ic != NULL && ($run > 0 || $row > 0)) $notis = 2;

    if($notis == 1 || ($_GET['status_daftar'] == 1 && $admin_view == 1)) $notis = 'Pendaftaran Berjaya';
    if($notis == 2 || ($_GET['status_daftar'] == 1 && $admin_view == 1)) $notis = 'Kemaskini Berjaya';

    if($admin_view == 1 && $notis != NULL && $_SERVER['REQUEST_METHOD'] == "POST") {
        //header("Location: utama.php?view=admin&action=pendaftaran&status_daftar=$notis");
        //echo '<script>alert("'.$notis.'");document.location.href="utama.php?view=admin&action=pendaftaran&module=add_ahli&redirect=1&no_ic='.$no_ic.'"</script>';
        echo '<script>alert("'.$notis.'");document.location.href="utama.php?view=admin&action=pendaftaran&sideMenu=kariah&module=list_ahli"</script>';
    }
}
if($notis == 1 || ($_GET['status_daftar'] == 1 && $admin_view == 1)) $notis = 'Pendaftaran Berjaya';
if($notis == 2 || ($_GET['status_daftar'] == 1 && $admin_view == 1)) $notis = 'Kemaskini Berjaya';

if($notis != NULL && $_SERVER['REQUEST_METHOD'] == "POST" && ($_GET['redirect'] == "bantuan" || $_POST['redirect'] == "bantuan")) {
    echo "<script>";
    echo 'alert("'.$notis.', Anda boleh memohon bantuan di masjid-masjid dibawah Sistem Masjid Pro");';
    echo 'document.location.href="../SPMD/Bantuan/bantuan_app.php?no_ic='.$_POST['no_ic'].'";';
    echo "</script>";
}

if($notis != NULL && $_SERVER['REQUEST_METHOD'] == "POST" && $_GET['redirect'] == NULL) echo "<script>alert('".$notis."');</script>";
?>
<?php if($admin_view == NULL && $_POST['preview'] == NULL) { ?>
    <!DOCTYPE html>

    <head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-0RCF4Z4X27"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-0RCF4Z4X27');
    </script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Masjid Pro - Pendaftaran Ahli Kariah <?php echo($nama_masjid); ?></title>
    <meta name="description" content="Masjid Pro - Pendaftaran Ahli Kariah <?php echo($nama_masjid); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="../vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="../vendors/jqvmap/dist/jqvmap.min.css">
    <link rel="stylesheet" href="../vendors/chosen/chosen.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800" rel='stylesheet' type='text/css'>

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/b5589dbb40.js" crossorigin="anonymous"></script>
    <script id="pilih_jquery" src="../js/jquery.js"></script>
    <script id="pilih_ui" src="../js/jquery-ui.js?ver=2"></script>
    <link rel="stylesheet" href="../js/jquery-ui.css?ver=2">
<?php } ?>
<?php if($admin_view != NULL || $_POST['preview'] != NULL) { ?>
    <script id="pilih_jquery" src="js/jquery.js"></script>
    <script id="pilih_ui" src="js/jquery-ui.js?ver=2"></script>
    <link rel="stylesheet" href="js/jquery-ui.css?ver=2">
<?php } ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment-with-locales.js" integrity="sha256-dgFbqbQVzjkZPQxWd8PBtzGiRBhChc4I2wO/q/s+Xeo=" crossorigin="anonymous"></script>
    <script id="load_tarikh">
        function convertTarikh(a, b) {
            $(document).ready(function () {
                var date_string = moment(a, "YYYY-MM-DD").format("DD/MM/YYYY");
                $(b).val(date_string);
            });
        }

        function tarikhSediaAda(a, b) {
            $(document).ready(function () {
                $( "[id='"+a+"']" ).datepicker({
                    dateFormat: "dd/mm/yy",
                    yearRange: "1900:<?php echo date('Y'); ?>",
                    maxDate: "0",
                    altField: "[id='"+b+"']",
                    altFormat: "yy-mm-dd",
                    changeMonth: true,
                    changeYear: true
                });
            });
        }
    </script>
    <script>
        $(document).ready(function () {
            <?php if($no_ic != NULL && $semak != NULL) {
            $sql_search = "SELECT *, a.id_negara, a.id_daerah, a.id_negeri, a.poskod, a.no_hp FROM sej6x_data_peribadi a, sej6x_data_masjid b WHERE a.id_masjid = b.id_masjid AND a.no_ic = '$no_ic'";
            $sql_search2 = "SELECT *, a.negeri, a.daerah, a.poskod, a.no_tel FROM approve_qariah a, sej6x_data_masjid b WHERE a.id_masjid = b.id_masjid AND a.no_ic = '$no_ic'";
            $sql_search3 = "SELECT c.no_ic 'no_kp' FROM sej6x_data_anakqariah a, sej6x_data_masjid b, sej6x_data_peribadi c WHERE a.id_masjid = b.id_masjid AND a.id_qariah = c.id_data AND a.no_ic = '$no_ic'";
            $sql_search4 = "SELECT c.no_ic 'no_kp' FROM approve_anak a, sej6x_data_masjid b, approve_qariah c WHERE a.id_masjid = b.id_masjid AND a.no_ic = '$no_ic' AND ((a.id_qariah = c.ID AND a.id_qariah != 0) OR a.no_ic_ketua = c.no_ic)";
            $result = mysqli_query($bd2, $sql_search) or die("Error :" . mysqli_error($bd2));
            $result2 = mysqli_query($bd2, $sql_search2) or die("Error :" . mysqli_error($bd2));
            $result_anak = mysqli_query($bd2, $sql_search3) or die("Error :" . mysqli_error($bd2));
            $result_anak2 = mysqli_query($bd2, $sql_search4) or die("Error :" . mysqli_error($bd2));
            $jumpa = mysqli_num_rows($result);
            $jumpa2 = mysqli_num_rows($result2);
            $jumpa3 = mysqli_num_rows($result_anak);
            $jumpa4 = mysqli_num_rows($result_anak2);
            $info_ketua = mysqli_fetch_assoc($result_anak);
            $info_ketua2 = mysqli_fetch_assoc($result_anak2);
            $ic_ketua = $info_ketua['no_kp'];
            $ic_ketua2 = $info_ketua2['no_kp'];
            if($jumpa > 0 || $jumpa2 > 0 || $jumpa3 > 0 || $jumpa4 > 0) {
                $tajuk = '(Kemaskini)';
                if($_POST['preview'] == 1) $tajuk = "";
                if($jumpa > 0 || $jumpa3 > 0) {
                    if($jumpa3 > 0) $sql_search = "SELECT *, a.id_negara, a.id_daerah, a.id_negeri, a.poskod, a.no_hp, IF(a.tarikh_lahir != '0000-00-00' AND a.tarikh_lahir IS NOT NULL, (YEAR(NOW()) - YEAR(a.tarikh_lahir)), NULL) 'umur' FROM sej6x_data_peribadi a, sej6x_data_masjid b WHERE a.id_masjid = b.id_masjid AND a.no_ic = '$ic_ketua'";
                    $result3 = mysqli_query($bd2, $sql_search) or die("Error :" . mysqli_error($bd2));
                    $kemas = mysqli_fetch_assoc($result3);
                    $no_hp = $kemas['no_hp'];
                    $id_qariah = $kemas['id_data'];
                    $negeri2 = $kemas['id_negeri'];
                    $daerah2 = $kemas['id_daerah'];
                    $id_masjid2 = $kemas['id_masjid'];
                    $nama_masjid2 = $kemas['nama_masjid'];
                    $alamat_terkini = $kemas['alamat_terkini'];
                    $jenis_oku = explode(',',$kemas['jenis_oku']);
                    $data_mualaf_isi =  $kemas['data_mualaf'];
                    $no_ic = $kemas['no_ic'];
                    $q_sakit_p = "SELECT * FROM sej6x_data_sakit WHERE id_data = $id_qariah";
                    $r_sakit_p = mysqli_query($bd2, $q_sakit_p);
                    $jum_sakit_p = mysqli_num_rows($r_sakit_p);
                    $sakit_p = mysqli_fetch_assoc($r_sakit_p);
                    $q_anak = "SELECT *, IF(tarikh_lahir != '0000-00-00' AND tarikh_lahir IS NOT NULL, (YEAR(NOW()) - YEAR(tarikh_lahir)), NULL) 'umur' FROM sej6x_data_anakqariah WHERE id_qariah = $id_qariah";
                    $result4 = mysqli_query($bd2, $q_anak) or die("Error :" . mysqli_error($bd2));
                    $jum_anak = mysqli_num_rows($result4);
                    $kemas2 = mysqli_fetch_assoc($result4);
                }
                if($jumpa2 > 0 || $jumpa4 > 0) {
                    if($jumpa4 > 0) $sql_search2 = "SELECT *, a.negeri, a.daerah, a.poskod, a.no_tel, IF(a.tarikh_lahir != '0000-00-00' AND a.tarikh_lahir IS NOT NULL, (YEAR(NOW()) - YEAR(a.tarikh_lahir)), NULL) 'umur' FROM approve_qariah a, sej6x_data_masjid b WHERE a.id_masjid = b.id_masjid AND a.no_ic = '$ic_ketua2'";
                    $result3 = mysqli_query($bd2, $sql_search2) or die("Error :" . mysqli_error($bd2));
                    $kemas = mysqli_fetch_assoc($result3);
                    $id_qariah = $kemas['id'];
                    $no_ic_ketua = $kemas['no_ic'];
                    $no_hp = $kemas['no_tel'];
                    $negeri2 = $kemas['negeri'];
                    $daerah2 = $kemas['daerah'];
                    $id_masjid2 = $kemas['id_masjid'];
                    $nama_masjid2 = $kemas['nama_masjid'];
                    $alamat_terkini =  $kemas['no_rumah'];
                    $jenis_oku = explode(',',$kemas['jenis_oku']);
                    $data_mualaf_isi =  $kemas['data_mualaf'];
                    $no_ic = $kemas['no_ic'];
                    $q_sakit_p = "SELECT * FROM sej6x_data_sakit WHERE id_data_approved = $id_qariah";
                    $r_sakit_p = mysqli_query($bd2, $q_sakit_p);
                    $jum_sakit_p = mysqli_num_rows($r_sakit_p);
                    $sakit_p = mysqli_fetch_assoc($r_sakit_p);
                    $q_anak = "SELECT *, IF(tarikh_lahir != '0000-00-00' AND tarikh_lahir IS NOT NULL, (YEAR(NOW()) - YEAR(tarikh_lahir)), NULL) 'umur' FROM approve_anak WHERE (id_qariah = $id_qariah AND id_qariah != 0) OR no_ic_ketua = '$no_ic_ketua'";
                    $result4 = mysqli_query($bd2, $q_anak) or die("Error :" . mysqli_error($bd2));
                    $jum_anak = mysqli_num_rows($result4);
                    $kemas2 = mysqli_fetch_assoc($result4);
                    $papar_query = $q_anak;
                }

            }
            if($jumpa == 0 && $jumpa2 == 0 && $jumpa3 == 0 && $jumpa4 == 0) $tajuk = '(Pendaftaran Baharu)';
            ?>
            convertTarikh('<?php echo($kemas['tarikh_lahir']); ?>', '#tarikh_lahir_type');
            <?php } ?>
            $( "#tarikh_lahir_type" ).datepicker({
                dateFormat: "dd/mm/yy",
                yearRange: "1900:<?php echo(date('Y')); ?>",
                maxDate: "0",
                altField: "#tarikh_lahir",
                altFormat: "yy-mm-dd",
                changeMonth: true,
                changeYear: true
            });
        });
        function tukar_mualaf(a, b) {
            if(a == 1) jQuery(b).show();
            if(a != 1) {
                jQuery(b).hide();
                jQuery(b+' input').val(null);
                jQuery(b+' textarea').val(null);
            }
        }
        $(document).ready(function () {
            tukar_mualaf(<?php if($kemas['data_mualaf'] != NULL) echo($kemas['data_mualaf']); else echo '0' ?>, '#extra_mualaf');
        });
    </script>
<?php
if($admin_view == NULL && $_POST['preview'] == NULL) {
    include("../adjust1.php");
    include("../adjust2.php");
}
if($admin_view != NULL || $_POST['preview'] != NULL) {
    include("adjust1.php");
    include("adjust2.php");
}
?>
<?php if($admin_view == NULL) { ?>
    </head>

    <body style="background-color: #4e4e52">
    <?php if($jumpa > 0 || $jumpa3 > 0 || $jumpa2 > 0 || $jumpa4 > 0) { ?>
        <!-- <nav class="navbar fixed-top navbar-dark bg-primary">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Kemaskini
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="kemaskini.php">E-Mel & Kata Laluan</a>
                            <a style="display: none" class="dropdown-item" href="pendaftaran.php?id_masjid=<?php echo($_GET['id_masjid']); ?>">Maklumat Kariah</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=keluar">Log Keluar</a>
                    </li>
                </ul>
            </div>
        </nav> -->
    <?php } ?>
    <br>
    <div class="col-lg-2"></div>
<?php } ?>
<?php if($admin_view == NULL && $_POST['preview'] == NULL) { ?><div class="col-lg-8"><?php } ?>
<?php if($admin_view != NULL || $_POST['preview'] != NULL) { ?><div class="col-12 col-md-12"><?php } ?>
    <div class="card">
        <div class="card-header" <?php if($_POST['preview'] == 1) echo 'style="display: none"'; ?>>
            <br>
            <center>
                <h2>
                    <?php if($no_ic == NULL) { $tajuk_button = 'Semak'; ?><b>Semakan Ahli Kariah</b><?php } ?>
                    <?php if($no_ic != NULL && ($jumpa > 0 || $jumpa2 > 0 || $jumpa3 > 0 || $jumpa4 > 0)) { $tajuk_button = 'Kemaskini'; ?>
                        <?php if(($jumpa > 0 || $jumpa3 > 0) && $id_masjid == $id_masjid2) { ?>
                            <div style="font-size: medium" class="alert alert-success" role="alert">
                                Maklumat telah didaftarkan, anda boleh mengemaskini maklumat dibawah sekiranya perlu.
                            </div>
                        <?php } ?>
                        <?php if(($jumpa2 > 0 || $jumpa4 > 0) && $id_masjid == $id_masjid2) { ?>
                            <div style="font-size: medium" class="alert alert-warning" role="alert">
                                Maklumat sedang diproses oleh pihak Masjid, anda boleh mengemaskini maklumat dibawah sekiranya perlu.
                            </div>
                        <?php } ?>
                        <?php if(($jumpa > 0 || $jumpa2 > 0 || $jumpa3 > 0 || $jumpa4 > 0) && ($id_masjid != $id_masjid2)) { $tajuk_button = 'Semak Semula'; ?>
                            <div style="font-size: medium" class="alert alert-danger" role="alert">
                                Maklumat telah didaftarkan di Masjid (kariah) yang lain (<?php echo($nama_masjid2); ?>). Hanya 1 (satu) Masjid sahaja dibenarkan untuk mendaftar keahlian kariah.
                            </div>
                        <?php } ?>
                        <b>Kemaskini Ahli Kariah</b>
                    <?php } ?>
                    <?php if($no_ic != NULL && $jumpa == 0 && $jumpa3 == 0 && $jumpa2 == 0 && $jumpa4 == 0) { $tajuk_button = 'Daftar'; ?>
                        <div style="font-size: medium" class="alert alert-danger" role="alert">
                            Maklumat tiada / belum didaftarkan, anda boleh mendaftar dengan mengisi maklumat yang diperlukan dibawah
                        </div>
                        <b>Pendaftaran Ahli Kariah</b>
                    <?php } ?>
                    <br>
                    <?php echo($nama_masjid); ?>
                </h2>
            </center>
        </div>
        <div class="card-body">
            <?php if($admin_view == NULL) { ?>
            <form method="post" name="insert_form" id="insert_form" action="<?php echo($post_url); ?>redirect=<?php echo($_GET['redirect']); ?>&id_masjid=<?php echo($id_masjid); ?>" enctype="multipart/form-data">
                <?php if($_GET['redirect'] != NULL) { ?><input type="hidden" name="redirect" id="redirect" value="<?php echo($_GET['redirect']); ?>"><?php } ?>
                <?php } ?>
                <?php if($admin_view != NULL) { ?><form method="post" name="insert_form" id="insert_form" action="<?php echo($post_url); ?>" enctype="multipart/form-data"><?php } ?>
                    <?php if($no_ic == NULL) {
                        if($_GET['no_ic'] != NULL) $no_ic_auto = $_GET['no_ic'];
                        else $no_ic_auto = $no_ic;
                        ?>
                        <div class="row form-group">
                            <div class="col-12 col-md-12 form-group" align="left">
                                <div class="alert alert-danger" role="alert">
                                    * Hanya Ketua Keluarga sahaja dibenarkan untuk mengisi
                                </div>
                                <div id="div_jenis">
                                    <label>Pilih Jenis Pengenalan</label>
                                    <select class="form-control" name="jenis_pengenalan" id="jenis_pengenalan" onChange="checkPengenalan(this.value)" required>
                                        <option value="">Sila Pilih:-</option>
                                        <option value="1">MyKad</option>
                                        <option value="2">No Polis/Tentera</option>
                                        <option value="3">MyPR</option>
                                        <option value="4">No Passport</option>
                                    </select>
                                </div>
                                <br>
                                <div id="div_pengenalan" style="display:none">
                                <label id="label_pengenalan"></label>
                                <input class="form-control" name="no_ic" id="no_ic" maxlength="12" required value="<?php echo($no_ic_auto); ?>">
                                </div>
                                <input type="hidden" id="semak" name="semak" value="1">
                            </div>
                        </div>
                    <?php } ?>
                    <?php if($no_ic != NULL && $tajuk_button != 'Semak Semula') { ?>
                    <script type="text/javascript">
                        jQuery(document).ready(function() {
                            tarikhSediaAda('tarikh_lahir_type', 'tarikh_lahir');
                            convertTarikh('<?php echo($kemas['tarikh_lahir']); ?>', '#tarikh_lahir_type');
                            <?php if($jenis_pengenalan==3 OR $jenis_pengenalan==4 OR $kemas['jenisPengenalan']==3 OR $kemas['jenisPengenalan']==4){ ?>myFunction(null,'umur','tarikh_lahir','tarikh_lahir_type');<?php } ?>
                            <?php if($jenis_pengenalan==1 OR $jenis_pengenalan==2 OR $kemas['jenisPengenalan']==1 OR $kemas['jenisPengenalan']==2){ ?>myFunction('no_ic', 'umur', 'tarikh_lahir', 'tarikh_lahir_type');<?php } ?>
                        });
                    </script>
                    <div class="row">
                        <div id="test"></div>
                        <input type="hidden" id="semak" name="semak" value="2">
                        <input type="hidden" id="id_data" name="id_data" value="<?php echo($id_qariah); ?>">
                        <div class="col-lg-12">
                            <h4 align="center">
                                <u>Maklumat Ahli <?php echo($tajuk); ?></u>
                            </h4>
                            <hr>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Jenis Pengenalan</label>
                                        <select class="form-control" name="jenis_pengenalan" id="jenis_pengenalan" onChange="checkPengenalan(this.value)" readonly>
                                            <option value="">Sila Pilih:-</option>
                                            <?php if($jenis_pengenalan==1 OR $kemas['jenisPengenalan']==1) { ?>
                                            <option value="1" selected>MyKad</option>
                                            <?php } else if($jenis_pengenalan==2 OR $kemas['jenisPengenalan']==2) { ?>
                                            <option value="2" selected>No Polis/Tentera</option>
                                            <?php } else if($jenis_pengenalan==3 OR $kemas['jenisPengenalan']==3) { ?>
                                            <option value="3" selected>MyPR</option>
                                            <?php } else if($jenis_pengenalan==4 OR $kemas['jenisPengenalan']==4) { ?>
                                            <option value="4" selected>No Passport</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label style="color: red">*</label><b>Nama Penuh (Mengikut <?php echo $nama_pengenalan; ?>)</b> <input
                                                class="form-control" name="nama_penuh" id="nama_penuh" oninput="this.value = this.value.toUpperCase()"
                                                required value="<?php echo($kemas['nama_penuh']); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label style="color: red">*</label><b>
                                            <?php
                                            if($kemas['jenisPengenalan']!=NULL) {
                                                if($kemas['jenisPengenalan']==1){
                                                    echo "No MyKad";
                                                }
                                                else if($kemas['jenisPengenalan']==2){
                                                    echo "No Polis/Tentera";
                                                }
                                                else if($kemas['jenisPengenalan']==3){
                                                    echo "No MyPR";
                                                }
                                                else if($kemas['jenisPengenalan']==4){
                                                    echo "No Passport";
                                                }
                                            }
                                            else {
                                                echo $nama_pengenalan;
                                            }
                                            ?></b>
                                            <input
                                                class="form-control" name="no_ic" id="no_ic"
                                                placeholder="Contoh: 880528355036"
                                                maxlength="12" required onChange="myFunction('no_ic', 'umur', 'tarikh_lahir', 'tarikh_lahir_type')" value="<?php echo($no_ic); ?>" readonly>
                                        <!-- <input type="hidden" name="jenis_pengenalan" value="<?php //if($kemas['jenisPengenalan']!=NULL) { echo $kemas['jenisPengenalan']; }else echo $jenis_pengenalan; ?>"> -->
                                    </div>
                                    <div class="form-group">
                                        <label style="color: red">*</label><b>No Telefon</b> <input
                                                class="form-control" name="no_hp" id="no_hp"
                                                placeholder="Contoh: 0143159891" required value="<?php echo($no_hp); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label style="color: red">*</label><b>Tarikh Lahir</b>
                                        <input style="display: none" class="form-control" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" name="tarikh_lahir" id="tarikh_lahir" type="date" value="<?php echo($kemas['tarikh_lahir']); ?>">
                                        <input class="form-control" pattern2="[0-9]{4}-[0-9]{2}-[0-9]{2}" name="tarikh_lahir_type" id="tarikh_lahir_type" onChange="myFunction(null, 'umur', 'tarikh_lahir', 'tarikh_lahir_type')" <?php if($jenis_pengenalan==1){ ?>value="<?php echo($no_ic); ?>"<?php } ?>>
                                     </div>
                                    <div class="form-group">
                                        <label style="color: red">*</label><b>Umur</b>
                                        <?php if($_POST['preview'] == 1) { ?><?php echo($kemas['umur']); ?> Tahun<?php } else { ?>
                                            <input class="form-control" name="umur" id="umur" readonly value="<?php echo($kemas['umur']); ?>">
                                        <?php } ?>
                                    </div>
                                    <div class="form-group">
                                        <label style="color: red">*</label><b>Jantina</b> <select
                                                class="form-control" name="jantina" id="jantina" required>
                                            <option value="">Sila Pilih</option>
                                            <option value="1" <?php if($kemas['jantina'] == 1) echo('selected'); ?>>Lelaki</option>
                                            <option value="2" <?php if($kemas['jantina'] == 2) echo('selected'); ?>>Perempuan</option>
                                        </select>
                                    </div>
									<div class="form-group">
                                        <label style="color: red">*</label><b>Bangsa</b> <select
                                                class="form-control" name="bangsa" id="bangsa" required>
                                            <option value="">Sila Pilih</option>
                                            <option value="1" <?php if($kemas['bangsa'] == 1) echo('selected'); ?>>Melayu</option>
                                            <option value="2" <?php if($kemas['bangsa'] == 2) echo('selected'); ?>>Cina</option>
                                            <option value="3" <?php if($kemas['bangsa'] == 3) echo('selected'); ?>>India</option>
                                            <option value="4" <?php if($kemas['bangsa'] == 4) echo('selected'); ?>>Lain-lain</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- /.col-lg-4 (nested) -->
                                <div class="col-lg-4">
                                    
                                    <div class="form-group">
                                        <label style="color: red">*</label><b>Warganegara</b> <select
                                                class="form-control" name="warganegara" id="warganegara"
                                                required onChange="displayNegara(this.value)" readonly>
                                            <?php
                                            if($kemas['jenisPengenalan']!=NULL) $jenis_pengenalan = $kemas['jenisPengenalan'];
                                            ?>
                                            <?php if($jenis_pengenalan==1 OR $jenis_pengenalan==2){ ?>
                                                <option value="1" <?php if($kemas['warganegara'] == 1) echo('selected'); else if($jenis_pengenalan==1 OR $jenis_pengenalan==2) echo('selected'); else if($kemas['warganegara'] == NULL) echo 'selected'; ?>>Warganegara</option>
                                            <?php } else if($jenis_pengenalan==3 OR $jenis_pengenalan==4){ ?>
                                                <option value="2" <?php if($kemas['warganegara'] == 2) echo('selected'); else if($jenis_pengenalan==3 OR $jenis_pengenalan==4) echo('selected');?>>Bukan Warganegara</option>
                                            <?php } else { ?>
                                            <option value="">Sila Pilih</option>
                                            <option value="1" <?php if($kemas['warganegara'] == 1) echo('selected'); else if($jenis_pengenalan==1 OR $jenis_pengenalan==2) echo('selected'); else if($kemas['warganegara'] == NULL) echo 'selected'; ?>>Warganegara</option>
                                            <option value="2" <?php if($kemas['warganegara'] == 2) echo('selected'); else if($jenis_pengenalan==3 OR $jenis_pengenalan==4) echo('selected');?>>Bukan Warganegara</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div id="div_negara" <?php if(($jenis_pengenalan==1 OR $jenis_pengenalan==2) OR ($kemas['jenisPengenalan']==1 OR $kemas['jenisPengenalan']==2)){ ?>style="display:none"<?php } ?>>
                                        <?php
                                        if(($jenis_pengenalan!=1 && $jenis_pengenalan!=2) OR ($kemas['jenisPengenalan']!=1 && $kemas['jenisPengenalan']!=2)){ ?>
                                        <div class="form-group">
                                            <label style="color:red">*</label><b>Negara</b>
                                            <select class="form-control" name="id_negara" id="id_negara">
                                                <option value="">Sila Pilih</option>
                                                <?php
                                                $sql_negara = "SELECT * FROM negara WHERE negara!='Malaysia'";
                                                $query_negara = mysqli_query($bd2,$sql_negara);

                                                while($data_negara = mysqli_fetch_array($query_negara)){

                                                ?>
                                                <option value="<?php echo $data_negara['id_negara']; ?>" <?php if($kemas['id_negara'] == $data_negara['id_negara']) echo('selected'); ?>><?php echo $data_negara['negara']; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group">
                                        <label style="color: red">*</label><b>Status Perkahwinan</b> <select
                                                class="form-control" name="status_perkahwinan"
                                                id="status_perkahwinan" required>
                                            <option value="">Sila Pilih</option>
                                            <option value="1" <?php if($kemas['status_perkahwinan'] == 1) echo('selected'); ?>>Bujang</option>
                                            <option value="2" <?php if($kemas['status_perkahwinan'] == 2) echo('selected'); ?>>Berkahwin</option>
                                            <option value="3" <?php if($kemas['status_perkahwinan'] == 3) echo('selected'); ?>>Duda</option>
                                            <option value="4" <?php if($kemas['status_perkahwinan'] == 4) echo('selected'); ?>>Janda</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label style="color: red">*</label><b>Pekerjaan</b> 
										<select class="form-control" name="pekerjaan" id="pekerjaan" required>
                                            <option value="">Sila Pilih</option>
                                            <option value="1" <?php if($kemas['pekerjaan'] == 1) echo('selected'); ?>>Kerajaan</option>
                                            <option value="2" <?php if($kemas['pekerjaan'] == 2) echo('selected'); ?>>Swasta</option>
                                            <option value="3" <?php if($kemas['pekerjaan'] == 3) echo('selected'); ?>>Sendiri</option>
                                            <option value="4" <?php if($kemas['pekerjaan'] == 4) echo('selected'); ?>>Pencen</option>
                                            <option value="6" <?php if($kemas['pekerjaan'] == 6) echo('selected'); ?>>Suri Rumah</option>
                                            <option value="7" <?php if($kemas['pekerjaan'] == 7) echo('selected'); ?>>Pelajar</option>
											<option value="5" <?php if($kemas['pekerjaan'] == 5) echo('selected'); ?>>Tidak Bekerja</option>
                                        </select>
										<!-- <input class="form-control" name="pekerjaan" id="pekerjaan" required value="<?php //echo($kemas['pekerjaan']); ?>"> -->
												
                                    </div>
									<div class="form-group">
                                        <label style="color: red">*</label><b>Pendapatan Isi Rumah</b> 
										<select class="form-control" name="pendapatan" id="pendapatan" required>
                                            <option value="">Sila Pilih</option>
                                            <option value="1" <?php if($kemas['pendapatan'] == 1) echo('selected'); ?>>0 - 1000</option>
                                            <option value="2" <?php if($kemas['pendapatan'] == 2) echo('selected'); ?>>1001 - 2000</option>
                                            <option value="3" <?php if($kemas['pendapatan'] == 3) echo('selected'); ?>>2001 - 3000</option>
                                            <option value="4" <?php if($kemas['pendapatan'] == 4) echo('selected'); ?>>3001 - 4000</option>
											<option value="5" <?php if($kemas['pendapatan'] == 5) echo('selected'); ?>>Lebih dari 4000</option>
                                        </select>
										<small>* Jumlah pendapatan anda serta tanggungan yang bekerja</small>
                                    </div>
                                    <div class="form-group">
                                        <label style="color: red">*</label><b>Tempoh Tinggal di Kariah Ini</b><br/>
                                        <select id="tinggal_mastautin" name="tinggal_mastautin" class="form-control" required onchange="updateMastautin(this.value)">
                                            <option value="">Sila Pilih</option>
                                            <option value="2" <?php if(str_replace(' ', '', explode(",", $kemas['tempoh_tinggal'])[2]) == 3 && str_replace(' ', '', explode(",", $kemas['tempoh_tinggal'])[0]) == 0) echo 'selected'; ?>>BERMASTAUTIN KURANG DARI 3 BULAN</option>
                                            <option value="3" <?php if(str_replace(' ', '', explode(",", $kemas['tempoh_tinggal'])[2]) > 3 || str_replace(' ', '', explode(",", $kemas['tempoh_tinggal'])[0]) > 0) echo 'selected'; ?>>BERMASTAUTIN LEBIH DARI 3 BULAN</option>
                                        </select>
                                        <div id="form_tempoh" style="display: none">
                                            <br />
                                            <input required class2="form-control" id="tinggal_tahun" name="tinggal_tahun" type="number" step="1" min="0" max="150" maxlength="3" value="<?php echo str_replace(' ', '', explode(",", $kemas['tempoh_tinggal'])[0]); ?>">TAHUN
                                            <input required class2="form-control" id="tinggal_bulan" name="tinggal_bulan" type="number" step="1" min="0" max="12" maxlength="2" value="<?php echo str_replace(' ', '', explode(",", $kemas['tempoh_tinggal'])[2]); ?>">BULAN
                                        </div>
                                        <input class="form-control" name="tempoh_tinggal" id="tempoh_tinggal" value="<?php echo($kemas['tempoh_tinggal']); ?>" readonly style="display: none">
                                        <small>* Sehingga pada tarikh anda mengisi pendaftaran ini</small>
                                    </div>
                                    <?php if($data4['perlu_zon'] != 2) { ?>
                                        <div class="form-group" id="zon">
                                            <label>Zon Kariah</label>
                                            <select class="form-control" name="zon_qariah" id="zon_qariah" <?php if($data4['wajib_pilih_zon'] == 1) echo "required"; ?>>
                                                <option value="">Pilih Zon Kariah</option>
                                                <?php
                                                $sql_zon = "SELECT * FROM sej6x_data_zonqariah WHERE id_masjid='$id_masjid'";
                                                $query_zon = mysqli_query($bd2, $sql_zon);

                                                while ($zon = mysqli_fetch_array($query_zon)) { ?>
                                                    <option value="<?php echo $zon['id_zonqariah']; ?>" <?php if($kemas['zon_qariah'] == $zon['id_zonqariah']) echo('selected'); ?>><?php echo $zon['no_huruf']." : ".$zon['nama_zon']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    <?php } ?>
                                </div>
                                <!-- /.col-lg-4 (nested) -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label style="color: red">*</label><b>Alamat
                                            Terkini</b> <textarea class="form-control" oninput="this.value = this.value.toUpperCase()"
                                                                  placeholder="Contoh: 1842-2 Kampung Selamat"
                                                                  name="alamat_terkini" id="alamat_terkini" required value="" rows="5"><?php echo($alamat_terkini); ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label style="color: red">*</label><b>Negeri</b> <select
                                                class="form-control" name="id_negeri" id="id_negeri"
                                                onChange="showDaerah(this.value, 0)" required>
                                            <option value="">Pilih Negeri</option>
                                            <?php
                                            $sql_negeri = "SELECT * FROM negeri";
                                            $query_negeri = mysqli_query($bd2, $sql_negeri);

                                            while ($negeri = mysqli_fetch_array($query_negeri)) {
                                                ?>
                                                <option value="<?php echo $negeri['id_negeri']; ?>" <?php if($negeri['id_negeri'] == $negeri2) echo('selected'); ?>><?php echo $negeri['name']; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group" id="daerah"></div>
                                    <div class="form-group">
                                        <label style="color: red">*</label><b>Poskod</b> <input
                                                class="form-control" name="poskod" id="poskod" minlength="5"
                                                maxlength="5" required value="<?php echo $kemas['poskod']; ?>">
                                    </div>
									<div class="form-group">
                                        <label style="color: red">*</label><b>Pemilikan Rumah</b> 
										<select class="form-control" name="pemilikan" id="pemilikan" required onChange="checkMilik(this.value)">
                                            <option value="">Sila Pilih</option>
                                            <option value="1" <?php if($kemas['pemilikkan'] == 1) echo('selected'); ?>>Beli / Sendiri</option>
                                            <option value="2" <?php if($kemas['pemilikkan'] == 2) echo('selected'); ?>>Sewa</option>
                                            <option value="3" <?php if($kemas['pemilikkan'] == 3) echo('selected'); ?>>Pusaka</option>
                                            <option value="4" <?php if($kemas['pemilikkan'] == 4) echo('selected'); ?>>Menumpang</option>
											<option value="5" <?php if($kemas['pemilikkan'] == 5) echo('selected'); ?>>Lain-Lain</option>
                                        </select>
                                    </div>
									<div id="div_pemilikan2" class="form-group">
                                        <?php
                                        if($kemas['pemilikkan2']!=NULL)
                                        {
                                        ?>
                                        <label style='color: red'>*</label><b>Lain-Lain Pemilikan</b>
                                        <input type='text' class='form-control' name='pemilikan2' id='pemilikan2' value="<?php echo $kemas['pemilikkan2']; ?>" required>
                                        <?php
                                        }
                                        ?>
									</div>
                                    <!-- <br> <br> Sila isi semua maklumat yang bertanda<label
                                            style="color: red">*</label> -->
                                </div>
                                <!-- /.col-lg-4 (nested) -->
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <b>Muat Naik Gambar Profil</b>
                                        <input class="form-control" type="file" size=32 name="image_profil" id="image_profil" accept=".jpg,.gif,.png,.jpeg,.pdf" onchange="preview_image(event, 'output_profil')">
                                        <?php if(strpos($kemas['gambar_profil'], 'data') !== false) { ?>
                                        <img class="img-fluid p-3" id="output_profil" src="<?php echo($kemas['gambar_profil']); ?>">
                                        <?php
                                        }
                                        else if($kemas['gambar_profil'] != NULL AND $kemas['gambar_profil'] != " "){
                                            $q = "SELECT gambar_profil 'file' FROM sej6x_data_peribadi WHERE id_data = " . $kemas['id_data'];
                                            $file = mysqli_query($bd2, $q) or die(mysqli_error($bd2));
                                            $file2 = mysqli_fetch_assoc($file);
                                            $file_base64 = $file2['file'];
                                            $file_base64 = str_replace('data:image/jpg;base64', '', $file_base64);
                                            $file_base64 = str_replace('data:image/jpeg;base64', '', $file_base64);
                                            $file_base64 = str_replace('data:image/png;base64', '', $file_base64);
                                            $file_base64 = str_replace('data:image/gif;base64', '', $file_base64);
                                            $handle = new Upload('base64:'.$file_base64);
                                            $file_gambar = 'data:'.$handle->file_src_mime.';base64,'.base64_encode($handle->process());
                                        ?>
                                            <img class="img-fluid p-3" id="output_profil" src="<?php echo $file_gambar; ?>">
                                        <!-- <a target="_blank" href="../Masjid/utama.php?data=raw&action=lihat_fail&fileDB=1&file=gambarProfil&id_data=<?php //echo $kemas['id_data']; ?>"><img style="max-width: 128px" class="img-fluid" src="images/pdf_icon.png"></a> -->
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <b>Muat Naik Bil Utiliti</b>
                                        <input class="form-control" type="file" size=32 name="image_field" id="image_field" accept=".jpg,.gif,.png,.jpeg,.pdf" onchange="preview_image(event, 'output')">
                                        <?php if(strpos($kemas['bukti_kariah'], 'data') !== false) { ?>
                                        <img class="img-fluid p-3" id="output" src="<?php echo($kemas['bukti_kariah']); ?>">
                                        <?php
                                        }
                                        else if($kemas['bukti_kariah'] != NULL AND $kemas['bukti_kariah'] != " " ){
                                        ?>
                                        <a target="_blank" href="../Masjid/utama.php?data=raw&action=lihat_fail&fileDB=1&file=buktiKariah&id_data=<?php echo $kemas['id_data']; ?>"><img style="max-width: 128px" class="img-fluid" src="images/pdf_icon.png"></a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <!-- /.row (nested) -->
                            <hr>
                            <div class="row">
                                <div class="col-lg-12">
                                    <h4 align="center">
                                        <u>Catatan Masjid</u>
                                    </h4>
                                </div>
                            </div>
                            <hr>
                            <div class="row" id="no_rujukan_form">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label>No Rujukan Fail (Jika Ada)</label>
                                        <input class="form-control form-group" name="no_rujukan" id="no_rujukan" value="<?php echo($kemas['no_rujukan']); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4" id="asnaf_form">
                                    <div class="form-group">
                                        <label style="color: red">*</label><b>Asnaf</b> <select
                                                class="form-control form-group" name="data_asnaf" id="data_asnaf"
                                                required>
                                            <option value="">Sila Pilih</option>
                                            <option value="1" <?php if($kemas['data_asnaf'] == 1) echo('selected'); ?>>Ya</option>
                                            <option value="2" <?php if($kemas['data_asnaf'] == 2) echo('selected'); ?>>Tidak</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- /.col-lg-4 (nested) -->
                                <div class="col-lg-4" id="solat_jumaat_form">
                                    <div class="form-group">
                                        <label style="color: red">*</label><b>Wajib Solat Jumaat</b>
                                        <select class="form-control form-group" name="solat_jumaat" id="solat_jumaat" required oninvalid2="this.setCustomValidity('Sekiranya anda kerap menunaikan solat jumaat di Masjid ini, sila pilih Ya')">
                                            <option value="">Sila Pilih</option>
                                            <option value="1" <?php if($kemas['solat_jumaat'] == 1) echo('selected'); ?>>Ya</option>
                                            <option value="2" <?php if($kemas['solat_jumaat'] == 2) echo('selected'); ?>>Tidak</option>
                                        </select>
                                        <small>Sekiranya anda kerap menunaikan solat jumaat di Masjid ini, sila pilih "Ya"</small>
                                    </div>
                                </div>
                                <!-- /.col-lg-4 (nested) -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label style="color: red">*</label><b>OKU</b> <select
                                                class="form-control form-group" name="oku" id="oku" required>
                                            <option value="">Sila Pilih</option>
                                            <option value="1" <?php if($kemas['oku'] == '1') echo('selected'); ?>>Ya</option>
                                            <option value="2" <?php if($kemas['oku'] == '2') echo('selected'); ?>>Tidak</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- /.col-lg-4 (nested) -->
                                <div class="col-lg-4" id="ibu_tunggal_form">
                                    <div class="form-group">
                                        <label style="color: red">*</label><b>Ibu Tunggal</b> <select
                                                class="form-control form-group" name="data_ibutunggal" id="data_ibutunggal" required>
                                            <option value="">Sila Pilih</option>
                                            <option value="1" <?php if($kemas['data_ibutunggal'] == '1') echo('selected'); ?>>Ya</option>
                                            <option value="2" <?php if($kemas['data_ibutunggal'] == '2') echo('selected'); ?>>Tidak</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- /.col-lg-4 (nested) -->
                                <div class="col-lg-4" id="anak_yatim_form">
                                    <div class="form-group">
                                        <label style="color: red">*</label><b>Anak Yatim</b> <select
                                                class="form-control form-group" name="data_anakyatim" id="data_anakyatim" required>
                                            <option value="">Sila Pilih</option>
                                            <option value="1" <?php if($kemas['data_anakyatim'] == '1') echo('selected'); ?>>Ya</option>
                                            <option value="2" <?php if($kemas['data_anakyatim'] == '2') echo('selected'); ?>>Tidak</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label style="color: red">*</label><b>Khairat Kematian</b> <select
                                                class="form-control form-group" name="data_khairat" id="data_khairat" required>
                                            <option value="">Sila Pilih</option>
                                            <option value="1" <?php if($kemas['data_khairat'] == '1' || $data4['auto_khairat'] == 1) echo('selected'); ?>>Ya</option>
                                            <option value="2" <?php if($kemas['data_khairat'] == '2') echo('selected'); ?>>Tidak</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- /.col-lg-4 (nested) -->
                                <div class="col-lg-4" id="data_mualaf_form">
                                    <div class="form-group">
                                        <label style="color: red">*</label><b>Mualaf</b> <select
                                                class="form-control form-group" name="data_mualaf" id="data_mualaf" required onchange="tukar_mualaf(this.value, '#extra_mualaf')">
                                            <option value="">Sila Pilih</option>
                                            <option value="1" <?php if($kemas['data_mualaf'] == '1') echo('selected'); ?>>Ya</option>
                                            <option value="2" <?php if($kemas['data_mualaf'] == '2') echo('selected'); ?>>Tidak</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12" id="extra_mualaf" style="display: none">
                                    <div class="form-group row">
                                        <div class="col-lg-4">
                                            <label style="color: red">*</label><b>Tarikh Memeluk Islam</b>
                                            <input id="tarikh_mualaf" name="tarikh_mualaf" class="form-control" type="date" value="<?php echo($kemas['tarikh_mualaf']); ?>" placeholder="Tarikh Rasmi Memeluk Islam">
                                        </div>
                                        <div class="col-lg-4">
                                            <label style="color: red">*</label><b>Tempat</b>
                                            <textarea id="tempat_mualaf" name="tempat_mualaf" class="form-control" rows="3" placeholder="Tempat Memeluk Islam"><?php echo($kemas['tempat_mualaf']); ?></textarea>
                                        </div>
                                        <div class="col-lg-4">
                                            <label style="color: red">*</label><b>Dihadapan</b>
                                            <textarea id="dihadapan_mualaf" name="dihadapan_mualaf" class="form-control" rows="3" placeholder="Qadhi / Pegawai Agama Daerah / Mufti / Dan Lain-lain"><?php echo($kemas['dihadapan_mualaf']); ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12" id="extra_oku" <?php if($kemas['oku'] == '1') { ?>style="display:block"<?php }else if($kemas['oku'] == '2') { ?>style="display: none"<?php }else{ ?>style="display:none"<?php } ?>>
                                    <div class="form-group row">
                                        <div class="col-lg-12">
                                            <b>Jenis OKU:-</b>
                                        </div>
                                        <div class="col-lg-4">
                                            <input type="checkbox" name="jenis_oku[]" <?php if($jenis_oku != NULL) echo (in_array("1", $jenis_oku)?'checked':''); ?> value="1">&nbsp;Kurang Upaya Pendengaran
                                        </div>
                                        <div class="col-lg-4">
                                            <input type="checkbox" name="jenis_oku[]" <?php if($jenis_oku != NULL) echo (in_array("2", $jenis_oku)?'checked':''); ?> value="2">&nbsp;Kurang Upaya Penglihatan
                                        </div>
                                        <div class="col-lg-4">
                                            <input type="checkbox" name="jenis_oku[]" <?php if($jenis_oku != NULL) echo (in_array("3", $jenis_oku)?'checked':''); ?> value="3">&nbsp;Kurang Upaya Pertuturan
                                        </div>
                                        <div class="col-lg-4">
                                            <input type="checkbox" name="jenis_oku[]" <?php if($jenis_oku != NULL) echo (in_array("4", $jenis_oku)?'checked':''); ?> value="4">&nbsp;Kurang Upaya Fizikal
                                        </div>
                                        <div class="col-lg-4">
                                            <input type="checkbox" name="jenis_oku[]" <?php if($jenis_oku != NULL) echo (in_array("5", $jenis_oku)?'checked':''); ?> value="5">&nbsp;Kurang Upaya Pembelajaran
                                        </div>
                                        <div class="col-lg-4">
                                            <input type="checkbox" name="jenis_oku[]" <?php if($jenis_oku != NULL) echo (in_array("6", $jenis_oku)?'checked':''); ?> value="6">&nbsp;Kurang Upaya Mental
                                        </div>
                                        <div class="col-lg-4">
                                            <input type="checkbox" name="jenis_oku[]" <?php if($jenis_oku != NULL) echo (in_array("7", $jenis_oku)?'checked':''); ?> value="7">&nbsp;Kurang Upaya Pelbagai
                                        </div>
                                        <div class="col-lg-4">
                                            <input type="checkbox" name="jenis_oku[]" <?php if($jenis_oku != NULL) echo (in_array("8", $jenis_oku)?'checked':''); ?> value="8">&nbsp;Lain-Lain Kurang Upaya
                                        </div>
                                    </div>
                                </div>
                                <!-- /.col-lg-4 (nested) -->
                                <script id="data_sakit_sekerip">
                                    function data_sakit(a, b, dinamik, d, e, f, g, h, i, j, k, l, m) {
                                        jQuery(document).ready(function(){
                                            var data_sakit_i = a;
                                            var data_sakit = '<?php pilihanBijak('SELECT id_penyakit \'id\', penyakit \'val\' FROM list_penyakit', 'select', '\'+dinamik+\'', 'Jenis Penyakit', 'required', NULL, NULL); ?>';
                                            data_sakit += '<label>Rawatan Terkini</label><input class="form-control form-group" name="'+d+'" maxlength="500">';
                                            dinamik_tambah(data_sakit_i, e, f, data_sakit, g, h, i, j, k, m);
                                            if(b == "1" || b == "Y") pilih_dinamik(b, e, l, g, j);
                                        });
                                    }

                                    function data_sakit_ada(a, b, c, d, e, f, g, h) {
                                        jQuery(document).ready(function(){
                                            jQuery(a).click();
                                            setSelectedIndex(document.getElementsByName(b)[f], c);
                                            document.getElementsByName(d)[f].value = e;
                                            document.getElementsByName(g)[f].value = h;
                                        });
                                    }
                                </script>
                                <div class="col-12 col-md-12">
                                    <script>
                                        jQuery(document).ready(function(){
                                            data_sakit(0, '<?php echo($kemas['data_sakit']); ?>', 'id_penyakit[]', 'rawatan_terkini[]', 'add_sakit', 'borang_sakit', 'padam_sakit', 'baris_sakit', 'id_sakit_', 'id_sakit[]', 'id_sakit_padam[]', '', 'Padam Penyakit');
                                        });
                                    </script>
                                    <label style="color: red">*</label><b>Sakit Kronik</b> <select
                                            class="form-control form-group" name="data_sakit" id="data_sakit" required onchange="pilih_dinamik(this.value, 'add_sakit', 'id_sakit[]', 'padam_sakit', 'id_sakit_padam[]')">
                                        <option value="">Sila Pilih</option>
                                        <option value="1" <?php if($kemas['data_sakit'] == '1') echo('selected'); ?>>Ya</option>
                                        <option value="2" <?php if($kemas['data_sakit'] == '2') echo('selected'); ?>>Tidak</option>
                                    </select>
                                    <div id="borang_sakit" class="col-12 col-md-12 form-group">
                                        <?php if($jum_sakit_p > 0) { $i = 1; do { ?>
                                            <script>
                                                jQuery(document).ready(function(){
                                                    data_sakit_ada('#add_sakit', 'id_penyakit[]', '<?php echo($sakit_p['id_penyakit']); ?>', 'rawatan_terkini[]', '<?php echo($sakit_p['rawatan_terkini']); ?>', <?php echo(round($i - 1)); ?>, 'id_sakit[]', '<?php echo($sakit_p['id_sakit']); ?>');
                                                });
                                            </script>
                                            <?php $i++; } while($sakit_p = mysqli_fetch_assoc($r_sakit_p)); } ?>
                                    </div>
                                    <div id="padam_sakit"></div>
                                    <button style="display: none" id="add_sakit" type="button" class="btn btn-success">Tambah Penyakit</button>
                                </div>
                                <!-- /.col-lg-4 (nested) -->
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-lg-12">
                                    <h4 align="center">
                                        <u>Tanggungan Anak Kariah</u>
                                    </h4>
                                </div>
                            </div>
                            <hr>
                            <script id="isi_dinamik">

                                //mula_index = 0;
                                id_butang_add = 'add_rekod_item';
                                id_borang_dinamik = 'borang_rekod';
                                id_baris = 'baris';
                                class_remove_btn = 'btn_remove';
                                nama_padam = 'Padam Tanggungan';
                                tarikhSediaAda('tarikh_lahir_tanggungan_type_'+mula_index, 'tarikh_lahir_tanggungan_'+mula_index);
                                //data_dinamik = '<div class="col-md-12 form-group"><h4>Maklumat Tanggungan/Jagaan '+mula_index+'</h4></div><div class="col-md-12 form-group"><label>Nama Tanggungan</label><input oninput="this.value = this.value.toUpperCase()" class="form-control" type="text" name="nama_tanggungan[]" placeholder="Nama Penuh" required></div><div class="col-md-4"><label>No Kad Pengenalan</label><input maxlength="12" onchange="myFunction(\'ic_tanggungan_'+mula_index+'\', \'umur_'+mula_index+'\', \'tarikh_lahir_tanggungan_'+mula_index+'\', \'tarikh_lahir_tanggungan_type_'+mula_index+'\')" id="ic_tanggungan_'+mula_index+'" class="form-control" type="text" name="ic_tanggungan[]" maxlength2="12"></div><div class="col-md-4"><label>Tarikh Lahir</label><input style="display: none" class="form-control" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" id="tarikh_lahir_tanggungan_'+mula_index+'" name="tarikh_lahir_tanggungan[]" type="date"><input pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" class="form-control" type2="date" id="tarikh_lahir_tanggungan_type_'+mula_index+'" name="tarikh_lahir_tanggungan_type[]" readonly required></div><div class="col-md-4"><label style="color: red">*</label><b>Umur</b><input class="form-control" name="umur_tanggungan[]" id="umur_'+mula_index+'" readonly value=""></div><div class="col-md-4"><label>No Telefon</label><input class="form-control" type="text" name="tel_tanggungan[]"></div><div class="col-md-4"><label>Jantina</label><select class="form-control" type="text" name="jantina_tanggungan[]" required><option value="">Sila Pilih</option><option value="1">Lelaki</option><option value="2">Perempuan</option></select></div><div class="col-md-4"><label>Hubungan</label><input oninput="this.value = this.value.toUpperCase()" class="form-control" type="text" name="hubungan_tanggungan[]" required></div><div class="col-md-4"><label>Bangsa</label><select class="form-control form-group" type="text" name="bangsa_tanggungan[]" required><option value="">Sila Pilih</option><option value="1">Melayu</option><option value="2">Cina</option><option value="3">India</option><option value="4">Lain-Lain</option></select></div><div class="col-md-4"><label>Warganegara</label><select class="form-control form-group" type="text" name="warganegara_tanggungan[]" required><option value="">Sila Pilih</option><option value="1">Warganegara</option><option value="2">Bukan Warganegara</option></select></div><div class="col-md-4"><label>Status Kahwin</label><select class="form-control form-group" type="text" name="tanggung_kahwin[]" requiredX><option value="">Sila Pilih</option><option value="1">Bujang</option><option value="2">Berkahwin</option><option value="3">Duda</option><option value="4">Janda</option><option value="5">Ibu Tunggal</option></select></div><div class="col-md-4"><label>Anak Yatim</label><select class="form-control form-group" type="text" name="tanggung_anakyatim[]" requiredX><option value="">Sila Pilih</option><option value="Y">Ya</option><option value="N">Tidak</option></select></div><div class="col-md-4"><label>OKU</label><select class="form-control form-group" type="text" name="tanggung_oku[]" requiredX><option value="">Sila Pilih</option><option value="Y">Ya</option><option value="N">Tidak</option></select></div><div class="col-md-4 asnaf_form_anak"><label>Asnaf</label><select class="form-control form-group" type="text" name="tanggung_asnaf[]" requiredX><option value="">Sila Pilih</option><option value="Y">Ya</option><option value="N">Tidak</option></select></div><div class="col-md-4"><label>Mualaf</label><select class="form-control form-group" type="text" name="tanggung_mualaf[]" requiredX onchange="tukar_mualaf(this.value, \'#extra_mualaf_'+mula_index+'\')"><option value="">Sila Pilih</option><option value="1">Ya</option><option value="2">Tidak</option></select></div><div class="col-lg-12" id="extra_mualaf_'+mula_index+'" style="display: none"><div class="form-group row"><div class="col-lg-4"><label style="color: red">*</label><b>Tarikh Memeluk Islam</b><input name="tanggung_tarikh_mualaf[]" class="form-control" type="date" value="" placeholder="Tarikh Rasmi Memeluk Islam"></div><div class="col-lg-4"><label style="color: red">*</label><b>Tempat</b><textarea name="tanggung_tempat_mualaf[]" class="form-control" rows="3" placeholder="Tempat Memeluk Islam"></textarea></div><div class="col-lg-4"><label style="color: red">*</label><b>Dihadapan</b><textarea name="tanggung_dihadapan_mualaf[]" class="form-control" rows="3" placeholder="Qadhi / Pegawai Agama Daerah / Mufti / Dan Lain-lain"></textarea></div></div></div><div class="col-12 col-md-12"><scr'+'ipt>data_sakit(0, "", "id_penyakit_tanggung_'+mula_index+'[]", "rawatan_terkini_tanggung_'+mula_index+'[]", "add_sakit_tanggung_'+mula_index+'", "borang_sakit_tanggung_'+mula_index+'", "padam_sakit_tanggung_'+mula_index+'", "baris_sakit_tanggung_'+mula_index+'", "id_sakit_tanggung_'+mula_index+'", "id_sakit_tanggung_'+mula_index+'[]", "id_sakit_padam_tanggung_'+mula_index+'[]", "", "Padam Penyakit")</scr'+'ipt><label>Sakit Kronik</label><select class="form-control form-group" type="text" name="tanggung_sakitkronik[]" requiredX onchange="pilih_dinamik(this.value, \'add_sakit_tanggung_'+mula_index+'\', \'id_sakit_tanggung_'+mula_index+'[]\', \'padam_sakit_tanggung_'+mula_index+'\', \'id_sakit_padam_tanggung_'+mula_index+'[]\')"><option value="">Sila Pilih</option><option value="Y">Ya</option><option value="N">Tidak</option></select><div id="borang_sakit_tanggung_'+mula_index+'" class="col-12 col-md-12 form-group"></div><div id="padam_sakit_tanggung_'+mula_index+'"></div><button style="display: none" id="add_sakit_tanggung_'+mula_index+'" type="button" class="btn btn-success">Tambah Penyakit</button></div>';
                                data_dinamik = '<div class="col-md-12 form-group"><h4>Maklumat Tanggungan/Jagaan '+mula_index+'</h4></div><div class="col-md-12 form-group"><label>Nama Tanggungan</label><input oninput="this.value = this.value.toUpperCase()" class="form-control" type="text" name="nama_tanggungan[]" placeholder="Nama Penuh" required></div><div class="col-md-4"><label>Jenis Pengenalan</label><select class="form-control" name="pengenalan_tanggungan[]" id="pengenalan_tanggungan'+mula_index+'" onChange="pilih_pengenalan(this.value, '+mula_index+')"><option value="">Sila Pilih</option><option value="1">MyKad</option><option value="2">No Polis/Tentera</option><option value="3">MyPR</option><option value="4">No Passport</option></select></div><div class="col-md-4" id="div_ic'+mula_index+'" style="display:none"><label>No Kad Pengenalan</label><input maxlength="12" onchange="myFunction(\'ic_tanggungan_'+mula_index+'\', \'umur_'+mula_index+'\', \'tarikh_lahir_tanggungan_'+mula_index+'\', \'tarikh_lahir_tanggungan_type_'+mula_index+'\')" id="ic_tanggungan_'+mula_index+'" class="form-control" type="text" name="ic_tanggungan[]" maxlength2="12"></div><div class="col-md-4" id="div_polisTentera'+mula_index+'" style="display:none"><label>No Polis/Tentera</label><input class="form-control" type="text" name="no_polisTentera_tanggungan[]"></div><div class="col-md-4" id="div_mypr'+mula_index+'" style="display:none"><label>No MyPR</label><input class="form-control" type="text" name="mypr_tanggungan[]"></div><div class="col-md-4" id="div_passport'+mula_index+'" style="display:none"><label>No Passport</label><input class="form-control" type="text" name="no_passport_tanggungan[]"></div><div class="col-md-4"><label>Tarikh Lahir</label><input style="display: none" class="form-control" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" id="tarikh_lahir_tanggungan_'+mula_index+'" name="tarikh_lahir_tanggungan[]" type="date"><input pattern2="[0-9]{4}-[0-9]{2}-[0-9]{2}" class="form-control" type2="date" id="tarikh_lahir_tanggungan_type_'+mula_index+'" name="tarikh_lahir_tanggungan_type[]" onChange="myFunction(null, \'umur_'+mula_index+'\', \'tarikh_lahir_tanggungan_'+mula_index+'\', \'tarikh_lahir_tanggungan_type_'+mula_index+'\')"></div><div class="col-md-4"><label>Umur</label><input class="form-control" name="umur_tanggungan[]" id="umur_'+mula_index+'" readonly value=""></div><div class="col-md-4"><label>No Telefon</label><input class="form-control" type="text" name="tel_tanggungan[]"></div><div class="col-md-4"><label>Jantina</label><select class="form-control" type="text" name="jantina_tanggungan[]" required><option value="">Sila Pilih</option><option value="1">Lelaki</option><option value="2">Perempuan</option></select></div><div class="col-md-4"><label>Hubungan</label><select class="form-control" name="hubungan_tanggungan[]" required><option value="">Sila Pilih</option><?php $sql_hubungan = "SELECT * FROM jenis_hubungan"; $query_hubungan=mysqli_query($bd2,$sql_hubungan); while($data_hubungan=mysqli_fetch_array($query_hubungan)) { ?><option value="<?php echo $data_hubungan['hubungan']; ?>"><?php echo $data_hubungan['hubungan']; ?></option><?php }?></select></div><div class="col-md-4"><label>Bangsa</label><select class="form-control form-group" type="text" name="bangsa_tanggungan[]" required><option value="">Sila Pilih</option><option value="1">Melayu</option><option value="2">Cina</option><option value="3">India</option><option value="4">Lain-Lain</option></select></div><div class="col-md-4" style="display:none"><label>Warganegara</label><select class="form-control form-group" type="text" name="warganegara_tanggungan[]" id="warganegara_tanggungan_'+mula_index+'" required><option value="">Sila Pilih</option><option value="1">Warganegara</option><option value="2">Bukan Warganegara</option></select></div><div class="col-md-4"><label>Status Kahwin</label><select class="form-control form-group" type="text" name="tanggung_kahwin[]" requiredX><option value="">Sila Pilih</option><option value="1">Bujang</option><option value="2">Berkahwin</option><option value="3">Duda</option><option value="4">Janda</option><option value="5">Ibu Tunggal</option></select></div><div class="col-md-4"><label>Anak Yatim</label><select class="form-control form-group" type="text" name="tanggung_anakyatim[]" requiredX><option value="">Sila Pilih</option><option value="1">Ya</option><option value="2">Tidak</option></select></div><div class="col-md-4"><label>OKU</label><select class="form-control form-group" type="text" name="tanggung_oku[]" requiredX><option value="">Sila Pilih</option><option value="1">Ya</option><option value="2">Tidak</option></select></div><div class="col-md-4 asnaf_form_anak"><label>Asnaf</label><select class="form-control form-group" type="text" name="tanggung_asnaf[]" requiredX><option value="">Sila Pilih</option><option value="SAMA" selected>Sama seperti ketua keluarga</option><option value="1">Ya</option><option value="2">Tidak</option></select></div><div class="col-md-4"><label>Mualaf</label><select class="form-control form-group" type="text" name="tanggung_mualaf[]" requiredX onchange="tukar_mualaf(this.value, \'#extra_mualaf_'+mula_index+'\')"><option value="">Sila Pilih</option><option value="1">Ya</option><option value="2">Tidak</option></select></div><div class="col-lg-12" id="extra_mualaf_'+mula_index+'" style="display: none"><div class="form-group row"><div class="col-lg-4"><label style="color: red">*</label><b>Tarikh Memeluk Islam</b><input name="tanggung_tarikh_mualaf[]" class="form-control" type="date" value="" placeholder="Tarikh Rasmi Memeluk Islam"></div><div class="col-lg-4"><label style="color: red">*</label><b>Tempat</b><textarea name="tanggung_tempat_mualaf[]" class="form-control" rows="3" placeholder="Tempat Memeluk Islam"></textarea></div><div class="col-lg-4"><label style="color: red">*</label><b>Dihadapan</b><textarea name="tanggung_dihadapan_mualaf[]" class="form-control" rows="3" placeholder="Qadhi / Pegawai Agama Daerah / Mufti / Dan Lain-lain"></textarea></div></div></div><div class="col-12 col-md-12"><scr'+'ipt>data_sakit(0, "", "id_penyakit_tanggung_'+mula_index+'[]", "rawatan_terkini_tanggung_'+mula_index+'[]", "add_sakit_tanggung_'+mula_index+'", "borang_sakit_tanggung_'+mula_index+'", "padam_sakit_tanggung_'+mula_index+'", "baris_sakit_tanggung_'+mula_index+'", "id_sakit_tanggung_'+mula_index+'", "id_sakit_tanggung_'+mula_index+'[]", "id_sakit_padam_tanggung_'+mula_index+'[]", "", "Padam Penyakit")</scr'+'ipt><label>Sakit Kronik</label><select class="form-control form-group" type="text" name="tanggung_sakitkronik[]" requiredX onchange="pilih_dinamik(this.value, \'add_sakit_tanggung_'+mula_index+'\', \'id_sakit_tanggung_'+mula_index+'[]\', \'padam_sakit_tanggung_'+mula_index+'\', \'id_sakit_padam_tanggung_'+mula_index+'[]\')"><option value="">Sila Pilih</option><option value="1">Ya</option><option value="2">Tidak</option></select><div id="borang_sakit_tanggung_'+mula_index+'" class="col-12 col-md-12 form-group"></div><div id="padam_sakit_tanggung_'+mula_index+'"></div><button style="display: none" id="add_sakit_tanggung_'+mula_index+'" type="button" class="btn btn-success">Tambah Penyakit</button></div>';

                            </script>
                            <div id="borang_rekod">
                                <?php if($jum_anak > 0) { $i = 1; do {
                                    if($jumpa > 0 || $jumpa3 > 0) {
                                        $sakit_kronik = $kemas2['status_sakit'];
                                        $q_sakit2 = "SELECT * FROM sej6x_data_sakit WHERE id_anak = ".$kemas2['ID'];
                                    }
                                    if($jumpa2 > 0 || $jumpa4 > 0) {
                                        $sakit_kronik = $kemas2['status_sakitkronik'];
                                        $q_sakit2 = "SELECT * FROM sej6x_data_sakit WHERE id_anak_approved = ".$kemas2['ID'];
                                    }
                                    $r_sakit2 = mysqli_query($bd2, $q_sakit2) or die(mysqli_error($bd2));
                                    $jum_sakit2 = mysqli_num_rows($r_sakit2);
                                    $sakit2 = mysqli_fetch_assoc($r_sakit2);
                                    ?>
                                    <div class="row form-group" id="baris<?php echo($i); ?>">
                                        <script type="text/javascript">
                                            jQuery(document).ready(function() {
                                                tarikhSediaAda('tarikh_lahir_tanggungan_type_<?php echo($i); ?>', 'tarikh_lahir_tanggungan_<?php echo($i); ?>');
                                                convertTarikh('<?php echo($kemas2['tarikh_lahir']); ?>', '#tarikh_lahir_tanggungan_type_<?php echo($i); ?>');
//                                                <?php //if(is_numeric($kemas2['no_ic'])) { ?>//myFunction('ic_tanggungan_<?php //echo($i); ?>//', 'umur_<?php //echo($i); ?>//', 'tarikh_lahir_tanggungan_<?php //echo($i); ?>//', 'tarikh_lahir_tanggungan_type_<?php //echo($i); ?>//');<?php //} ?>
//
                                                <?php if($kemas2['jenisPengenalan']==1 OR $kemas2['jenisPengenalan']==2) { ?>myFunction('ic_tanggungan_<?php echo($i); ?>', 'umur_<?php echo($i); ?>', 'tarikh_lahir_tanggungan_<?php echo($i); ?>', 'tarikh_lahir_tanggungan_type_<?php echo($i); ?>');<?php } ?>
                                                <?php if($kemas2['jenisPengenalan']==3 OR $kemas2['jenisPengenalan']==4) { ?>myFunction(null, 'umur_<?php echo($i); ?>', 'tarikh_lahir_tanggungan_<?php echo($i); ?>', 'tarikh_lahir_tanggungan_type_<?php echo($i); ?>');<?php } ?>
                                            });
                                        </script>
                                        <div class="col-md-12 form-group"><h4>Maklumat Tanggungan/Jagaan <?php echo($i); ?></h4></div>
                                        <div class="col-md-12 form-group"><label>Nama Tanggungan</label><input oninput="this.value = this.value.toUpperCase()" class="form-control" type="text" name="nama_tanggungan[]" placeholder="Nama Penuh" required value="<?php echo($kemas2['nama_penuh']); ?>"></div>
                                        <div class="col-md-4">
                                            <label>Jenis Pengenalan</label>
                                            <select class="form-control" name="pengenalan_tanggungan[]" id="pengenalan_tanggungan_<?php echo $i; ?>" onchange="pilih_pengenalan(this.value, <?php echo $i; ?>)">
                                                <option value="">Sila Pilih</option>
                                                <option value="1" <?php if($kemas2['jenisPengenalan']==1) { echo "selected"; }?>>MyKad</option>
                                                <option value="2" <?php if($kemas2['jenisPengenalan']==2) { echo "selected"; }?>>No Polis/Tentera</option>
                                                <option value="3" <?php if($kemas2['jenisPengenalan']==3) { echo "selected"; }?>>MyPR</option>
                                                <option value="4" <?php if($kemas2['jenisPengenalan']==4) { echo "selected"; }?>>No Passport</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4" id="div_ic<?php echo $i; ?>" <?php if($kemas2['jenisPengenalan']!=1){ ?>style="display:none"<?php } ?>>
                                            <label>No Kad Pengenalan</label>
                                            <input id="ic_tanggungan_<?php echo($i); ?>" onchange="myFunction('ic_tanggungan_<?php echo($i); ?>', 'umur_<?php echo($i); ?>', 'tarikh_lahir_tanggungan_<?php echo($i); ?>', 'tarikh_lahir_tanggungan_type_<?php echo($i); ?>')" class="form-control" type="text" name="ic_tanggungan[]" maxlength="12" value="<?php echo($kemas2['no_ic']); ?>">
                                        </div>
                                        <div class="col-md-4" id="div_polisTentera<?php echo $i; ?>" <?php if($kemas2['jenisPengenalan']!=2){ ?>style="display:none"<?php }?>>
                                            <label>No Polis/Tentera</label>
                                            <input class="form-control" type="text" name="no_polisTentera_tanggungan[]" value="<?php echo($kemas2['no_ic']); ?>">
                                        </div>
                                        <div class="col-md-4" id="div_mypr<?php echo $i; ?>" <?php if($kemas2['jenisPengenalan']!=3){ ?>style="display:none"<?php }?>>
                                            <label>No MyPR</label>
                                            <input class="form-control" type="text" name="mypr_tanggungan[]" value="<?php echo($kemas2['no_ic']); ?>">
                                        </div>
                                        <div class="col-md-4" id="div_passport<?php echo $i; ?>" <?php if($kemas2['jenisPengenalan']!=4){ ?>style="display:none"<?php }?>>
                                            <label>No Passport</label>
                                            <input class="form-control" type="text" name="no_passport_tanggungan[]" value="<?php echo($kemas2['no_ic']); ?>">
                                        </div>
                                        <div class="col-md-4">
                                            <label>Tarikh Lahir</label>
                                            <input style="display: none" class="form-control" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" id="tarikh_lahir_tanggungan_<?php echo($i); ?>" name="tarikh_lahir_tanggungan[]" type="date" value="<?php echo($kemas2['tarikh_lahir']); ?>">
                                            <input pattern2="[0-9]{4}-[0-9]{2}-[0-9]{2}" class="form-control" type2="date" id="tarikh_lahir_tanggungan_type_<?php echo($i); ?>" name="tarikh_lahir_tanggungan_type[]" onchange="myFunction(null, 'umur_<?php echo($i); ?>', 'tarikh_lahir_tanggungan_<?php echo($i); ?>', 'tarikh_lahir_tanggungan_type_<?php echo($i); ?>')">
                                        </div>
                                        <div class="col-md-4">
                                            <label>Umur</label>
                                            <?php if($_POST['preview'] == 1) { ?><?php echo($kemas2['umur']); ?> Tahun<?php } else { ?>
                                                <input class="form-control" name="umur_tanggungan[]" id="umur_<?php echo($i); ?>" readonly value="<?php echo($kemas2['umur']); ?>">
                                            <?php } ?>
                                        </div>
                                        <div class="col-md-4"><label>No Telefon</label><input class="form-control" type="text" name="tel_tanggungan[]" value="<?php echo($kemas2['no_tel']); ?>"></div>
                                        <div class="col-md-4"><label>Jantina</label>
                                            <select class="form-control" type="text" name="jantina_tanggungan[]" required>
                                                <option value="">Sila Pilih</option>
                                                <option value="1" <?php if($kemas2['jantina'] == 1) { ?> selected <?php } ?>>Lelaki</option>
                                                <option value="2" <?php if($kemas2['jantina'] == 2) { ?> selected <?php } ?>>Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4"><label>Hubungan</label>
                                            <select class="form-control" type="text" name="hubungan_tanggungan[]" required>
                                                <option value="">Sila Pilih</option>
                                                <?php
                                                $sql_hubungan = "SELECT * FROM jenis_hubungan";
                                                $query_hubungan = mysqli_query($bd2,$sql_hubungan);
                                                while($data_hubungan=mysqli_fetch_array($query_hubungan))
                                                {
                                                ?>
                                                <option <?php if($kemas2['hubungan']==$data_hubungan['hubungan']) { ?>selected='selected'<?php } ?> value="<?php echo $data_hubungan['hubungan']; ?>"><?php echo $data_hubungan['hubungan']; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Bangsa</label>
                                            <select class="form-control form-group" name="bangsa_tanggungan[]" required>
                                                <option value="">Sila Pilih</option>
                                                <option value="1" <?php if($kemas2['bangsa'] == '1') echo('selected'); ?>>Melayu</option>
                                                <option value="2" <?php if($kemas2['bangsa'] == '2') echo('selected'); ?>>Cina</option>
                                                <option value="3" <?php if($kemas2['bangsa'] == '3') echo('selected'); ?>>India</option>
                                                <option value="4" <?php if($kemas2['bangsa'] == '4') echo('selected'); ?>>Lain-Lain</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4" style="display:none">
                                            <label>Warganegara</label>
                                            <select class="form-control form-group" type="text" name="warganegara_tanggungan[]" required id="warganegara_tanggungan_<?php echo $i; ?>">
                                                <option value="">Sila Pilih</option>
                                                <option value="1" <?php if($kemas2['warganegara'] == '1' OR $kemas2['jenisPengenalan']==1 OR $kemas2['jenisPengenalan']==2) echo('selected'); ?>>Warganegara</option>
                                                <option value="2" <?php if($kemas2['warganegara'] == '2' OR $kemas2['jenisPengenalan']==3 OR $kemas2['jenisPengenalan']==4) echo('selected'); ?>>Bukan Warganegara</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Status Kahwin</label>
                                            <select class="form-control form-group" type="text" name="tanggung_kahwin[]" requiredX>
                                                <option value="">Sila Pilih</option>
                                                <option value="1" <?php if($kemas2['status_kahwin'] == 1) echo('selected'); ?>>Bujang</option>
                                                <option value="2" <?php if($kemas2['status_kahwin'] == 2) echo('selected'); ?>>Berkahwin</option>
                                                <option value="3" <?php if($kemas2['status_kahwin'] == 3) echo('selected'); ?>>Duda</option>
                                                <option value="4" <?php if($kemas2['status_kahwin'] == 4) echo('selected'); ?>>Janda</option>
                                                <option value="5" <?php if($kemas2['status_kahwin'] == 5) echo('selected'); ?>>Ibu Tunggal</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Anak Yatim</label> <select
                                                    class="form-control form-group" name="tanggung_anakyatim[]" requiredX>
                                                <option value="">Sila Pilih</option>
                                                <option value="1" <?php if($kemas2['status_anakyatim'] == '1') echo('selected'); ?>>Ya</option>
                                                <option value="2" <?php if($kemas2['status_anakyatim'] == '2') echo('selected'); ?>>Tidak</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label>OKU</label>
                                            <select class="form-control form-group" type="text" name="tanggung_oku[]" requiredX>
                                                <option value="">Sila Pilih</option>
                                                <option value="1" <?php if($kemas2['status_oku'] == '1') echo('selected'); ?>>Ya</option>
                                                <option value="2" <?php if($kemas2['status_oku'] == '2') echo('selected'); ?>>Tidak</option>
                                            </select>
                                        </div>
                                        <?php
                                        $semakAsnaf = $kemas2['status_asnaf'];
                                        if($semakAsnaf == "Y") $semakAsnaf = 1;
                                        if($semakAsnaf == "N") $semakAsnaf = 2;
                                        ?>
                                        <div class="col-md-4 asnaf_form_anak">
                                            <label>Asnaf</label>
                                            <select class="form-control form-group" type="text" name="tanggung_asnaf[]" requiredX>
                                                <option value="">Sila Pilih</option>
                                                <option value="SAMA" <?php if($semakAsnaf == $kemas['data_asnaf']) echo('selected'); ?>>Sama seperti ketua keluarga</option>
                                                <option value="1" <?php if($kemas2['status_asnaf'] == 'Y' || $kemas['data_asnaf'] == 1) echo('selected'); ?>>Ya</option>
                                                <option value="2" <?php if($kemas2['status_asnaf'] == 'N' || $kemas['data_asnaf'] == 2) echo('selected'); ?>>Tidak</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Mualaf</label>
                                            <select class="form-control form-group" type="text" name="tanggung_mualaf[]" requiredX onchange="tukar_mualaf(this.value, '#extra_mualaf_<?php echo($i); ?>')">
                                                <option value="">Sila Pilih</option>
                                                <option value="1" <?php if($kemas2['status_mualaf'] == '1') echo('selected'); ?>>Ya</option>
                                                <option value="2" <?php if($kemas2['status_mualaf'] == '2') echo('selected'); ?>>Tidak</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-12" id="extra_mualaf_<?php echo($i); ?>" style="display: none">
                                            <div class="form-group row">
                                                <div class="col-lg-4">
                                                    <label style="color: red">*</label><b>Tarikh Memeluk Islam</b>
                                                    <input name="tanggung_tarikh_mualaf[]" class="form-control" type="date" value="<?php echo($kemas2['tarikh_mualaf']); ?>" placeholder="Tarikh Rasmi Memeluk Islam">
                                                </div>
                                                <div class="col-lg-4">
                                                    <label style="color: red">*</label><b>Tempat</b>
                                                    <textarea name="tanggung_tempat_mualaf[]" class="form-control" rows="3" placeholder="Tempat Memeluk Islam"><?php echo($kemas2['tempat_mualaf']); ?></textarea>
                                                </div>
                                                <div class="col-lg-4">
                                                    <label style="color: red">*</label><b>Dihadapan</b>
                                                    <textarea name="tanggung_dihadapan_mualaf[]" class="form-control" rows="3" placeholder="Qadhi / Pegawai Agama Daerah / Mufti / Dan Lain-lain"><?php echo($kemas2['dihadapan_mualaf']); ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <script type="text/javascript">tukar_mualaf(<?php if($kemas2['status_mualaf'] != NULL) echo($kemas2['status_mualaf']); else echo '0'; ?>, '#extra_mualaf_<?php echo($i); ?>')</script>
                                        <div class="col-12 col-md-12">
                                            <script>
                                                jQuery(document).ready(function(){
                                                    data_sakit(0, '<?php echo($sakit_kronik); ?>', 'id_penyakit_tanggung_<?php echo($i); ?>[]', 'rawatan_terkini_tanggung_<?php echo($i); ?>[]', 'add_sakit_tanggung_<?php echo($i); ?>', 'borang_sakit_tanggung_<?php echo($i); ?>', 'padam_sakit_tanggung_<?php echo($i); ?>', 'baris_sakit_tanggung_<?php echo($i); ?>', 'id_sakit_tanggung_<?php echo($i); ?>_', 'id_sakit_tanggung_<?php echo($i); ?>[]', 'id_sakit_padam_tanggung_<?php echo($i); ?>[]', '', 'Padam Penyakit');
                                                });
                                            </script>
                                            <label>Sakit Kronik</label>
                                            <select class="form-control form-group" type="text" name="tanggung_sakitkronik[]" requiredX onchange="pilih_dinamik(this.value, 'add_sakit_tanggung_<?php echo($i); ?>', 'id_sakit_tanggung_<?php echo($i); ?>[]', 'padam_sakit_tanggung_<?php echo($i); ?>', 'id_sakit_padam_tanggung_<?php echo($i); ?>[]')">
                                                <option value="">Sila Pilih</option>
                                                <option value="1" <?php if($sakit_kronik == '1') echo('selected'); ?>>Ya</option>
                                                <option value="2" <?php if($sakit_kronik == '2') echo('selected'); ?>>Tidak</option>
                                            </select>
                                            <div id="borang_sakit_tanggung_<?php echo($i); ?>" class="col-12 col-md-12 form-group">
                                                <?php if($jum_sakit2 > 0) { $u = 1; do { ?>
                                                    <script>
                                                        jQuery(document).ready(function(){
                                                            data_sakit_ada('#add_sakit_tanggung_<?php echo($i); ?>', 'id_penyakit_tanggung_<?php echo($i); ?>[]', '<?php echo($sakit2['id_penyakit']); ?>', 'rawatan_terkini_tanggung_<?php echo($i); ?>[]', '<?php echo($sakit2['rawatan_terkini']); ?>', <?php echo(round($u - 1)); ?>, 'id_sakit_tanggung_<?php echo($i); ?>[]', '<?php echo($sakit2['id_sakit']); ?>');
                                                        });
                                                    </script>
                                                    <?php $u++; } while($sakit2 = mysqli_fetch_assoc($r_sakit2)); } ?>
                                            </div>
                                            <div id="padam_sakit_tanggung_<?php echo($i); ?>"></div>
                                            <button style="display: none" id="add_sakit_tanggung_<?php echo($i); ?>" type="button" class="btn btn-success">Tambah Penyakit</button>
                                        </div>
                                        <input type="hidden" id="id_padam_<?php echo($i); ?>" name="id_anak[]" value="<?php echo($kemas2['ID']); ?>">
                                        <div class="col form-group" align="right"><button name="remove" id="<?php echo($i); ?>" type="button" class="btn_remove btn btn-warning form-group">Padam Tanggungan</button></div>
                                    </div>
                                    <?php $i++; } while($kemas2 = mysqli_fetch_assoc($result4)); } ?>
                            </div>
                            <div id="padam_anak"></div>
                            <div class="row form-group"><div class="col" align="right"><button id="add_rekod_item" type="button" class="btn btn-success">Tambah Tanggungan</button></div></div>
                            <?php }  ?>
                            <div class="row form-group" align="left">
                                <div class="col-md-12 col-12 form-group">
                                    <?php if($admin_view != NULL) { ?><input type="hidden" name="admin_view" id="admin_view" value="1"><?php } ?>
                                    <input type="hidden" name="selection" value="<?php echo $url_masjid; ?>"> <input type="hidden" name="id_masjid" value="<?php echo $id_masjid; ?>">
                                    <?php if($tajuk_button != 'Semak Semula') { ?><input type="submit" name="simpan" id="simpan" value="<?php echo($tajuk_button); ?>" class="btn btn-success" /><?php } ?>
                                    <?php if($tajuk_button == 'Semak Semula' && $admin_view == NULL) { ?><a href="../SPMD/login.php"><input type="button" name="simpan" id="simpan" value="<?php echo($tajuk_button); ?>" class="btn btn-success" /></a><?php } ?>
                                    <?php if($tajuk_button == 'Semak Semula' && $admin_view != NULL) { ?><a href="utama.php?view=admin&action=pendaftaran&module=add_ahli&"><input type="button" name="simpan" id="simpan" value="<?php echo($tajuk_button); ?>" class="btn btn-success" /></a><?php } ?>
                                </div>
                                <div style="display: none" class="col-md-4 col-12 form-group"><a href="pendaftaran.php?id_masjid=<?php echo($id_masjid); ?>"><input
                                                type="button" name="isi_semula" id="isi_semula" value="Isi Semula"
                                                class="btn btn-warning" /></a>
                                </div>
                                <div style="display: none" class="col-md-4 col-12 form-group"><a href="../login.php">
                                        <input type="button" name="isi_semula2" id="isi_semula2" value="Halaman Utama"
                                               class="btn btn-danger" /></a>
                                </div>
                            </div>

                </form>
        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.panel pnael-info -->
    </div>
    <!-- /.col-lg-12 -->
<?php if($admin_view == NULL) { ?>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Notis</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">X</span>
                    </button>
                </div>
                <div id="badan" class="modal-body">Maklumat anda dilindungi oleh Akta 709(Akta Perlindungan Data Peribadi 2010). Pihak <strong><?php echo($nama_masjid); ?></strong> bertanggungjawab & memberi jaminan atas setiap data maklumat yang anda berikan adalah selamat</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?php if($admin_view == NULL) { ?>
    <script src="<?php echo($sekerip); ?>vendors/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo($sekerip); ?>vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?php echo($sekerip); ?>vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo($sekerip); ?>assets/js/main.js"></script>
    <script src="<?php echo($sekerip); ?>vendors/chosen/chosen.jquery.min.js"></script>
    <!--script src="../vendors/chart.js/dist/Chart.bundle.min.js"></script>
    <script src="../assets/js/dashboard.js"></script>
    <script src="../assets/js/widgets.js"></script-->
<?php } ?>
<?php if($_POST['preview'] == NULL) { ?>
    <script src="<?php echo($sekerip); ?>vendors/jqvmap/dist/jquery.vmap.min.js"></script>
    <script src="<?php echo($sekerip); ?>vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <script src="<?php echo($sekerip); ?>vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="<?php echo($sekerip); ?>vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo($sekerip); ?>vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo($sekerip); ?>vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo($sekerip); ?>vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="<?php echo($sekerip); ?>vendors/jszip/dist/jszip.min.js"></script>
    <script src="<?php echo($sekerip); ?>vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="<?php echo($sekerip); ?>vendors/pdfmake/build/vfs_fonts.js"></script>
<?php } ?>
<?php if($_POST['preview'] == NULL) { ?>
    <script src="<?php echo($sekerip); ?>vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="<?php echo($sekerip); ?>vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="<?php echo($sekerip); ?>vendors/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <script src="<?php echo($sekerip); ?>assets/js/init-scripts/data-table/datatables-init.js"></script>
<?php } ?>
    <script type="text/javascript">
        <?php if($admin_view == NULL && $_POST['preview'] == NULL) { ?>jQuery('#exampleModal').modal('show');<?php } ?>

        function checkPengenalan(str){

            var jenis_pengenalan = str;
            var label_pengenalan = document.getElementById('label_pengenalan');

            if(jenis_pengenalan!="") {

                document.getElementById('div_pengenalan').style.display = 'block';

                if (jenis_pengenalan == 1) {
                    label_pengenalan.innerHTML = "No MyKad";
                } else if (jenis_pengenalan == 2) {
                    label_pengenalan.innerHTML = "No Polis/Tentera";
                } else if (jenis_pengenalan == 3) {
                    label_pengenalan.innerHTML = "No MyPR";
                } else if (jenis_pengenalan == 4) {
                    label_pengenalan.innerHTML = "No Passport";
                }
            }
            else{
                document.getElementById('div_pengenalan').style.display = 'none';
            }
        }

		function checkMilik(str){
			if (str == "") {
                document.getElementById("div_pemilikan2").innerHTML = "";
                return;
            }
            else {
                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                }
                else {
                    // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("div_pemilikan2").innerHTML = this.responseText;
                    }
                };
				xmlhttp.open("GET","getMilik.php?id_milik="+str,true);
                xmlhttp.send();
            }
		}
        function showDaerah(str, str2) {
            if (str == "" && str2 == "") {
                document.getElementById("daerah").innerHTML = "";
                return;
            }
            else {
                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                }
                else {
                    // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("daerah").innerHTML = this.responseText;
                        <?php if($_POST['preview'] == 1) { ?>disableSemua();<?php } ?>
                    }
                };
                <?php if($admin_view == NULL && $_POST['preview'] == NULL) { ?>xmlhttp.open("GET","getdaerah.php?negeri="+str+"&daerah="+str2,true);<?php } ?>
                <?php if($admin_view != NULL || $_POST['preview'] != NULL) { ?>xmlhttp.open("GET","daftar_online/getdaerah.php?negeri="+str+"&daerah="+str2,true);<?php } ?>
                xmlhttp.send();
            }
        }

        function pilih_pengenalan(a,b) {
            if(a == 1) {
                jQuery('#div_ic'+b).show();
                jQuery('#div_polisTentera'+b).hide();
                jQuery('#div_mypr'+b).hide();
                jQuery('#div_passport'+b).hide();
                document.getElementById('warganegara_tanggungan_'+b).options.selectedIndex = 1;

            }
            else if(a == 2) {
                jQuery('#div_polisTentera'+b).show();
                jQuery('#div_ic'+b).hide();
                jQuery('#div_mypr'+b).hide();
                jQuery('#div_passport'+b).hide();
                document.getElementById('warganegara_tanggungan_'+b).options.selectedIndex = 1;
            }
            else if(a == 3) {
                jQuery('#div_mypr'+b).show();
                jQuery('#div_ic'+b).hide();
                jQuery('#div_polisTentera'+b).hide();
                jQuery('#div_passport'+b).hide();
                document.getElementById('warganegara_tanggungan_'+b).options.selectedIndex = 2;

            }
            else if(a == 4) {
                jQuery('#div_passport'+b).show();
                jQuery('#div_ic'+b).hide();
                jQuery('#div_polisTentera'+b).hide();
                jQuery('#div_mypr'+b).hide();
                document.getElementById('warganegara_tanggungan_'+b).options.selectedIndex = 2;
            }

        }

        function myFunction(a, b, c, d){
            jQuery(document).ready(function () {
                if(a != null && document.getElementById(a).value.length == 12) {
                    var tl = document.getElementById(a).value;
                    var date = tl.substr(0, 6);
                    var year = tl.substr(0, 2);
                    var month = tl.substr(2, 2);
                    var day = tl.substr(4, 2);

                    if(year > (<?php echo(date('y')); ?>))
                    {
                        year = 19+year;
                    }
                    else if(year <= <?php echo(date('y')); ?>)
                    {
                        year = 20+year;
                    }
                }
                //else if (d!=null){
                //    var tl2 = document.getElementById(d).value;
                //    var day = tl2.substr(8,2);
                //    var month = tl2.substr(5,2);
                //    var year = tl2.substr(0,4);
                //}
                else {
                    var tl = document.getElementById(d).value;
                    var date = tl;
                    var year = tl.substr(6, 4);
                    var month = tl.substr(3, 2);
                    var day = tl.substr(0, 2);
                }

                var today = new Date();
                var dd = String(today.getDate()).padStart(2,'0');
                var mm = String(today.getMonth()+1).padStart(2,'0');
                var yyyy = today.getFullYear();

                today = yyyy+'-'+mm+'-'+dd;

                var umur = parseInt(yyyy) - parseInt(year);
                var umur_bulan = parseInt(mm) - parseInt(month);
                if(umur_bulan < 0 )
                {
                    umur = parseInt(umur);
                }
                else if(umur_bulan == 0 )
                {
                    var umur_hari = parseInt(dd) - parseInt(day);

                    if(umur_hari < 0 )
                    {
                        umur = parseInt(umur);
                    }
                }

                document.getElementById(b).value = umur;

                //var tarikh = day+'-'+month+'-'+year;
                var tarikh = year+'-'+month+'-'+day;
                var tarikh2 = tarikh;
                if(a != null) convertTarikh(tarikh2, '#'+d);
                jQuery('#'+c).val(tarikh);
                //document.getElementById(c).value = tarikh;

                if(umur > 59)
                {
                    //document.getElementById('warga_emas').selectedIndex = "1";
                    //document.getElementById('warga_emas').value = "Ya";
                }
                else if(umur < 60)
                {
                    //document.getElementById('warga_emas').selectedIndex = "2";
                    //document.getElementById('warga_emas').value = "Tidak";
                }
                ubah_yatim(umur, '#anak_yatim_form', '#data_anakyatim');
            });
        }
        <?php if($negeri2 != NULL && $daerah2 != NULL) { ?>
        showDaerah(<?php echo($negeri2); ?>, <?php echo($daerah2); ?>);
        <?php } ?>
        <?php if($_POST['preview'] == 1) { ?>
        function disableSemua() {
            jQuery(document).ready(function () {
                jQuery("#insert_form input").prop("disabled", true);
                jQuery("#insert_form select").prop("disabled", true);
                jQuery("#insert_form button").prop("disabled", true);
            });
        }
        disableSemua();
        <?php } ?>

        // var inputEl = document.getElementById('no_ic');
        // var goodKey = '0123456789';
        //
        // var checkInputIC = function(e) {
        //     var key = (typeof e.which == "number") ? e.which : e.keyCode;
        //     var start = this.selectionStart,
        //         end = this.selectionEnd;
        //
        //     var filtered = this.value.split('').filter(filterInput);
        //     this.value = filtered.join("");
        //
        //     var move = (filterInput(String.fromCharCode(key)) || (key == 0 || key == 8)) ? 0 : 1;
        //     this.setSelectionRange(start - move, end - move);
        // }
        //
        // var filterInput = function(val) {
        //     return (goodKey.indexOf(val) > -1);
        // }
        //
        // inputEl.addEventListener('input', checkInputIC);


        /* var ic_tanggungan = document.getElementsByName('ic_tanggungan[]');
        var ic_array = ic_tanggungan.length;

        var i;
        for(i=1;i<=ic_array;i++)
        {
            var inputTanggungan = document.getElementById('ic_tanggungan_'+i);
            var goodTanggungan = '0123456789';

            var checkInputTanggungan = function(e) {
                var keyTanggungan = (typeof e.which == "number") ? e.which : e.keyCode;
                var startTanggungan = this.selectionStart,
                    endTanggungan = this.selectionEnd;

                var filteredTanggungan = this.value.split('').filter(filterInputTanggungan);
                this.value = filteredTanggungan.join("");

                var moveTanggungan = (filterInputTanggungan(String.fromCharCode(keyTanggungan)) || (keyTanggungan == 0 || keyTanggungan == 8)) ? 0 : 1;
                this.setSelectionRange(startTanggungan - moveTanggungan, endTanggungan - moveTanggungan);
            }

            var filterInputTanggungan = function(val) {
                return (goodTanggungan.indexOf(val) > -1);
            }

            inputTanggungan.addEventListener('input', checkInputTanggungan);
        } */

    </script>
<?php if($_SERVER["REQUEST_METHOD"] == "POST") { ?>
    <script>

        var inputHP = document.getElementById('no_hp');
        var goodHP = '0123456789+-';

        var checkInputHP = function(e) {
            var keyHP = (typeof e.which == "number") ? e.which : e.keyCode;
            var startHP = this.selectionStart,
                endHP = this.selectionEnd;

            var filteredHP = this.value.split('').filter(filterInputHP);
            this.value = filteredHP.join("");

            /* Prevents moving the pointer for a bad character */
            var moveHP = (filterInputHP(String.fromCharCode(keyHP)) || (keyHP == 0 || keyHP == 8)) ? 0 : 1;
            this.setSelectionRange(startHP - moveHP, endHP - moveHP);
        }

        var filterInputHP = function(val) {
            return (goodHP.indexOf(val) > -1);
        }

        inputHP.addEventListener('input', checkInputHP);

    </script>
<?php } ?>
<?php if($admin_view == NULL && $_POST['preview'] == NULL) { include("../ajax_functions.php"); ?>
    </body>
    </html>
<?php } ?>