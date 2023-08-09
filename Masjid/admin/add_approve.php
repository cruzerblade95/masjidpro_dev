<?php
require_once('../connection/connection.php');
include('../fungsi.php');
// Connect to server and select database.
$id_masjid = $_SESSION['id_masjid'];
if($_POST['id_masjid'] != NULL && is_numeric($_POST['id_masjid'])) $id_masjid = $_POST['id_masjid'];
$user_id = $_SESSION['user_id'];
if($_POST['user_id'] != NULL && is_numeric($_POST['user_id'])) $user_id = $_POST['user_id'];
$id_data = $_POST['add'];
if($_POST['id_data'] != NULL && is_numeric($_POST['id_data'])) $id_data = $_POST['id_data'];

$kuiri="SELECT * FROM approve_qariah WHERE id='$id_data' AND id_masjid='$id_masjid'";
$kuirirun = mysqli_query($bd2, $kuiri);
$run = mysqli_fetch_array($kuirirun);

$jenisPengenalan = $run['jenisPengenalan'];
if($jenisPengenalan == NULL || $jenisPengenalan == '') $jenisPengenalan = "1";
$no_rujukan = e($run['no_rujukan'], 1, NULL);
$nama_penuh=e($run['nama_penuh'], 1, NULL);
$no_ic=e($run['no_ic'], NULL, NULL);
$password=e($run['password'], NULL, NULL);
$email = "NULL,";
if($run['email'] != NULL && $run['email'] != "") $email = "'".e($run['email'], NULL, NULL)."', ";
$tarikh_lahir=e($run['tarikh_lahir'], NULL, NULL);
$warganegara=e($run['warganegara'], NULL, NULL);
$bangsa=e($run['bangsa'], NULL, NULL);
$jantina=e($run['jantina'], NULL, NULL);
$status_perkahwinan=e($run['status_perkahwinan'], NULL, NULL);
$no_hp=e($run['no_tel'], 1, NULL);
$alamat_terkini=e($run['no_rumah'], 1, NULL);
$poskod=e($run['poskod'], NULL, NULL);
$id_negeri=e($run['negeri'], NULL, NULL);
$id_daerah=e($run['daerah'], NULL, NULL);
$zon_qariah=e($run['zon_qariah'], NULL, NULL);
$tempoh_tinggal=e($run['tempoh_tinggal'], 1, NULL);
$solat_jumaat=e($run['solat_jumaat'], NULL, NULL);
$warga_emas=e($run['warga_emas'], NULL, NULL);
$oku=e($run['oku'], NULL, NULL);
$jenis_oku=e($run['jenis_oku'], NULL, NULL);
$data_asnaf=e($run['data_asnaf'], NULL, NULL);
$data_ibutunggal=e($run['data_ibutunggal'], NULL, NULL);
$data_anakyatim=e($run['data_anakyatim'], NULL, NULL);
$data_sakit=e($run['data_sakit'], NULL, NULL);
$data_mualaf=e($run['data_mualaf'], NULL, NULL);
$data_khairat=e($run['data_khairat'], NULL, NULL);
$pekerjaan=e($run['pekerjaan'], NULL, NULL);
$pendapatan=e($run['pendapatan'], NULL, NULL);
$pemilikkan=e($run['pemilikkan'], NULL, NULL);
$pemilikkan2=e($run['pemilikkan2'], NULL, NULL);
$tarikh_daftar=e($run['last_added'], NULL, NULL);
$bukti_kariah=$run['bukti_kariah'];
$firebase_token_pending=$run['firebase_token'];

$sql3 = "SELECT * FROM sej6x_data_peribadi WHERE no_ic='$no_ic'";
$sqlquery3 = mysqli_query($bd2, $sql3);
$row3 = mysqli_num_rows($sqlquery3);

if($row3>0) {
    if($_POST['isApp'] == 1) {
        header("Location: ../approveRejectKariah.php?msg=1&token=".$_POST['token']);
    }
    else {
        echo "<script>
	alert('No Kad Pengenalan Sudah Berdaftar');
	window.location.href='../utama.php?view=admin&action=approve_qariah';
	</script>";
        //header("Location: ../utama.php?view=admin&action=approve_qariah");
    }
}
else
{
    $sql = "INSERT INTO sej6x_data_peribadi
(jenisPengenalan, data_mualaf, email, password, no_rujukan, id_masjid, nama_penuh, no_ic,tarikh_lahir, warganegara, bangsa, jantina,status_perkahwinan, status, tahap_pendidikan, sekolah_institusi, no_hp, no_rumah, alamat_terkini, poskod, id_daerah, id_negeri, zon_qariah, tempoh_tinggal,bil_tanggungan, data_umum,solat_jumaat,oku,jenis_oku,data_ajk,data_pegawai, data_asnaf, data_ibutunggal, data_anakyatim, data_cerai, data_kematian, data_khairat, data_nikah, data_sakit, data_oku, id_suami, id_bapa, id_ibu, pekerjaan, majikan, pendapatan, pemilikkan, pemilikkan2, bukti_kariah, last_added, added_by) 
VALUES 
('$jenisPengenalan', '$data_mualaf',$email'$password','$no_rujukan', '$id_masjid','$nama_penuh','$no_ic','$tarikh_lahir','$warganegara','$bangsa','$jantina','$status_perkahwinan','-1','-1','0','$no_hp','0','$alamat_terkini','$poskod','$id_daerah','$id_negeri','$zon_qariah','$tempoh_tinggal','-1','0','$solat_jumaat','$oku','$jenis_oku','0','0','$data_asnaf','$data_ibutunggal','$data_anakyatim','0','0','$data_khairat','0',
'$data_sakit','0','-1','-1','-1','$pekerjaan','0','$pendapatan','$pemilikkan','$pemilikkan2','$bukti_kariah','$tarikh_daftar','$user_id')";

    $check_anak = "SELECT * FROM approve_anak WHERE id_qariah = $id_data AND id_masjid = $id_masjid";
    $result2 = mysqli_query($bd2, $check_anak) or die(mysqli_error($bd2));
    $num_anak = mysqli_num_rows($result2);
    $data_anak = mysqli_fetch_array($result2);

    $sqlquery = mysqli_query($bd2, $sql) or die(mysqli_error($bd2));
    $last_id = mysqli_insert_id($bd2);
    $sql1 = "DELETE FROM approve_qariah WHERE id = $id_data AND id_masjid = $id_masjid";
    $sqlquery1 = mysqli_query($bd2, $sql1) or die(mysqli_error($bd2));

    $update_sakit = "UPDATE sej6x_data_sakit SET id_data = $last_id, id_data_approved = NULL WHERE id_data_approved = $id_data";
    mysqli_query($bd2, $update_sakit) or die(mysqli_error($bd2));

    if($num_anak > 0) {
        while($data_anak = mysqli_fetch_array($result2))
        {
            $ic_anak = $data_anak['no_ic'];
            $emel_anak = "NULL,";
            if($data_anak['email'] != NULL && $data_anak['email'] == "") $emel_anak = "'".$data_anak['email']."', ";

            $jenisPengenalanAnak = $data_anak['jenisPengenalan'];
            if($jenisPengenalanAnak == NULL || $jenisPengenalanAnak == '') $jenisPengenalanAnak = "1";

            $kuiri_anak = "SELECT * FROM sej6x_data_anakqariah WHERE no_ic='$ic_anak'";
            $kuirirun_anak = mysqli_query($bd2, $kuiri_anak);
            $bil_anak = mysqli_num_rows($kuirirun_anak);
            if($bil_anak == 0)
            {
                $sql2 = "INSERT INTO sej6x_data_anakqariah (last_added, jenisPengenalan, no_ic_ketua, email, password, status_mualaf, no_rujukan, id_qariah, id_masjid, nama_penuh, no_ic, tarikh_lahir, no_tel, bangsa, warganegara, jantina, hubungan, status_sakit, status_oku, status_kahwin, status_anakyatim) 
                    VALUES ('".e($data_anak['last_added'], NULL, NULL)."', '$jenisPengenalanAnak', '$no_ic',$emel_anak'".e($data_anak['password'], NULL, NULL)."','".e($data_anak['status_mualaf'], NULL, NULL)."', '".e($data_anak['no_rujukan'], 1, NULL)."', $last_id, ".e($data_anak['id_masjid'], NULL, NULL).", '".e($data_anak['nama_penuh'], 1, NULL)."', '".e($data_anak['no_ic'], NULL, NULL)."', '".e($data_anak['tarikh_lahir'], NULL, NULL)."', '".e($data_anak['no_tel'], NULL, NULL)."', '".e($data_anak['bangsa'], NULL, NULL)."', '".e($data_anak['warganegara'], NULL, NULL)."', '".e($data_anak['jantina'], NULL, NULL)."', '".e($data_anak['hubungan'], NULL, NULL)."', '".e($data_anak['status_sakitkronik'], NULL, NULL)."', '".e($data_anak['status_oku'], NULL, NULL)."', '".e($data_anak['status_kahwin'], NULL, NULL)."', '".e($data_anak['status_anakyatim'], NULL, NULL)."')";
                mysqli_query($bd2, $sql2) or die(mysqli_error($bd2));
                $id_data_anak = $data_anak['ID'];
                $last_id_anak = mysqli_insert_id($bd2);
                $update_sakit_anak = "UPDATE sej6x_data_sakit SET id_anak = $last_id_anak, id_anak_approved = NULL WHERE id_anak_approved = $id_data_anak";
                mysqli_query($bd2, $update_sakit_anak) or die(mysqli_error($bd2));
            }
            else{
                $del_anak = "DELETE FROM approve_anak WHERE no_ic='$ic_anak'";
                $query_delanak = mysqli_query($bd2,$del_anak);
            }
        }
        $sqldel2 = "DELETE FROM approve_anak WHERE id_qariah = $id_data";
        $result3 = mysqli_query($bd2, $sqldel2) or die(mysqli_error($bd2));
    }

    if($_POST['isApp'] == 1) {
        $q_masjid = "SELECT nama_masjid FROM sej6x_data_masjid WHERE id_masjid = $id_masjid";
        $q_masjid2 = mysqli_query($bd2, $q_masjid);
        $row_q_masjid = mysqli_fetch_assoc($q_masjid2);
        $nama_masjid = $row_q_masjid['nama_masjid'];
        include("../notif.php");
        $notification = array(
            'title' => "Pendaftaran Ahli Kariah Diterima",
            'body' => "Tahniah $nama_penuh, pendaftaran anda sebagai ahli kariah $nama_masjid telah diterima, anda boleh log masuk aplikasi MasjidPro Penang"
        );
        sendNotif($firebase_token_pending, $notification);
        header("Location: ../approveRejectKariah.php?success=1&token=".$_POST['token']);
    }

    else {
        echo "<script>
	alert('Berjaya Berdaftar');
	window.location.href='../utama.php?view=admin&action=approve_qariah';
	</script>";
    }
}
?>