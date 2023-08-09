<?php
include("../connection/connection.php");
include("../fungsi.php");
//require_once('../connection/connection.php'); 
if ($_SERVER['REQUEST_METHOD'] == 'POST' || $_GET['isApp'] == 1) {
    $id = e($_POST['del'], NULL, NULL);
    $ketua = e($_POST['ketua'], NULL, NULL);
    $del_mode = e($_POST['del_mode'], NULL, NULL);
    $sebab_padam = e($_POST['sebab_padam'], NULL, NULL);
    $sebab_lain = e($_POST['sebab_lain'], NULL, NULL);
    $tarikh_pindah = e($_POST['tarikh_pindah'], NULL, NULL);

    $sql_id = "SELECT * FROM approve_qariah WHERE id='$id'";
    $query_id = mysqli_query($bd2,$sql_id);
    $data_id = mysqli_fetch_array($query_id);

    $no_ic2 = $data_id['no_ic'];
    $nama_penuh2 = $data_id['nama_penuh'];
    $email2 = $data_id['email'];
    $no_tel2 = $data_id['no_tel'];
    $firebase_token2 = $data_id['firebase_token'];

    if (($sebab_padam == 4 && $ketua == 1) || $sebab_padam == 99) {
        $q_ic = "SELECT no_ic FROM approve_qariah WHERE id = $id";
        if ($del_mode == 1) $q_ic = "SELECT no_ic FROM sej6x_data_peribadi WHERE id_data = $id";
        $q_ic2 = mysqli_query($bd2, $q_ic);
        $row_ic = mysqli_fetch_assoc($q_ic2);
        $no_ic_check = $row_ic['no_ic'];

        $sqldel = "DELETE FROM approve_qariah WHERE id = $id";
        if ($del_mode == 1) $sqldel = "DELETE FROM sej6x_data_peribadi WHERE id_data = $id";
        $result = mysqli_query($bd2, $sqldel);
        $del_sakit = "DELETE FROM sej6x_data_sakit WHERE id_data_approved = $id";
        if ($del_mode == 1) $del_sakit = "DELETE FROM sej6x_data_sakit WHERE id_data = $id";
        mysqli_query($bd2, $del_sakit);
        $check_anak = "SELECT * FROM approve_anak WHERE id_qariah = $id OR (no_ic_ketua IS NOT NULL AND no_ic_ketua != '' AND no_ic_ketua = '$no_ic_check')";
        if ($del_mode == 1) $check_anak = "SELECT * FROM sej6x_data_anakqariah WHERE id_qariah = $id OR (no_ic_ketua IS NOT NULL AND no_ic_ketua != '' AND no_ic_ketua = '$no_ic_check')";
        $result2 = mysqli_query($bd2, $check_anak);
        $list_anak = mysqli_fetch_assoc($result2);
        $num_anak = mysqli_num_rows($result2);

        if ($result) {
            if ($num_anak > 0) {
                do {
                    $id_anak = $list_anak['ID'];
                    $del_sakit2 = "DELETE FROM sej6x_data_sakit WHERE id_anak_approved = $id_anak";
                    if ($del_mode == 1) $del_sakit2 = "DELETE FROM sej6x_data_sakit WHERE id_anak = $id_anak";
                    mysqli_query($bd2, $del_sakit2);
                } while ($list_anak = mysqli_fetch_assoc($result2));
                $sqldel2 = "DELETE FROM approve_anak WHERE id_qariah = $id";
                if ($del_mode == 1) $sqldel2 = "DELETE FROM sej6x_data_anakqariah WHERE id_qariah = $id";
                $result3 = mysqli_query($bd2, $sqldel2);
            }
        }
        $berjayaPadam = 1;
        echo "error";
    }

    if($sebab_padam == 4 && $ketua == 2) {
        $del_sakit2 = "DELETE FROM sej6x_data_sakit WHERE id_anak = $id";
        mysqli_query($bd2, $sqldel);
        $sqldel = "DELETE FROM sej6x_data_anakqariah WHERE ID = $id";
        mysqli_query($bd2, $sqldel);
    }

    if($sebab_padam != 4 && $sebab_padam != 99 && $sebab_padam != 100) {
        if($ketua == 1) $col_padam = 'id_data';
        if($ketua == 1)
        {
            $sql_qariah = "SELECT * FROM sej6x_data_peribadi WHERE id_data='$id'";
            $query_qariah = mysqli_query($bd2, $sql_qariah);
            $data_qariah = mysqli_fetch_array($query_qariah);
            $no_ic = $data_qariah['no_ic'];
        }
        if($ketua == 2) $col_padam = 'id_anak';
        if($ketua == 2)
        {
            $sql_anak = "SELECT * FROM sej6x_data_anakqariah WHERE ID='$id'";
            $query_anak = mysqli_query($bd2, $sql_anak);
            $data_anak = mysqli_fetch_array($query_anak);
            $no_ic = $data_anak['no_ic'];
        }
        $q = "INSERT INTO data_pindah ($col_padam, no_ic, id_masjid, sebab, sebab_lain, tarikh_pindah, tarikh) VALUES ($id,'$no_ic',$id_masjid, $sebab_padam, '$sebab_lain', '$tarikh_pindah', NOW())";
        mysqli_query($bd2, $q) or die(mysqli_error($bd2));
        if($ketua == 1)
        {
            $sql_query = "SELECT * FROM sej6x_data_anakqariah WHERE id_qariah = '$id'";
            $sqlquery = mysqli_query($bd2,$sql_query);
            while($data_anak = mysqli_fetch_array($sqlquery))
            {
                $id_anak = $data_anak['ID'];
                $ic_anak = $data_anak['no_ic'];
                $k = "INSERT INTO data_pindah (id_anak, no_ic, id_masjid, sebab, sebab_lain, tarikh_pindah, tarikh) VALUES ('$id_anak','$ic_anak',$id_masjid,'$sebab_padam','$sebab_lain','$tarikh_pindah', NOW())";
                mysqli_query($bd2, $k) or die(mysqli_error($bd2));
            }
        }
    }

    if($sebab_padam == 100){
        $berjayaPadam = 2;
    }

    if($_POST['isApp'] == 1 && $berjayaPadam == 1) {
        include ("../notif.php");
        foreach ($_POST as $key => $val) ${$key} = mysqli_real_escape_string($bd2, $val);
        $q = "INSERT INTO pendaftaran_ditolak (id_masjid, no_ic, nama_penuh, no_tel, email, sebabDitolak, firebase_token, admin_id)
VALUES ('$id_masjid', '$no_ic', '$nama_penuh', '$no_tel', '$email', '$sebabDitolak', '$firebase_token', '$user_id')";

        mysqli_query($bd2, $q);

        $q_masjid = "SELECT nama_masjid FROM sej6x_data_masjid WHERE id_masjid = $id_masjid";
        $q_masjid2 = mysqli_query($bd2, $q_masjid);
        $row_q_masjid = mysqli_fetch_assoc($q_masjid2);
        $nama_masjid = $row_q_masjid['nama_masjid'];

        $notification = array(
            'title' => "Pendaftaran Ahli Kariah Ditolak",
            'body' => "Maaf $nama_penuh, pendaftaran ahli kariah di $nama_masjid telah ditolak. - $sebabDitolak"
        );
        sendNotif($firebase_token, $notification);
        header("Location: ../approveRejectKariah.php?success=2&token=".$_POST['token']);
    }
    else if($berjayaPadam == 1 || $berjayaPadam == 2){
        include ("../notif.php");
        foreach ($_POST as $key => $val) ${$key} = mysqli_real_escape_string($bd2, $val);
//        $q = "INSERT INTO pendaftaran_ditolak (id_masjid, no_ic, nama_penuh, no_tel, email, sebabDitolak, firebase_token, admin_id)
//VALUES ('$id_masjid', '$no_ic2', '$nama_penuh2', '$no_tel2', '$email2', '$sebabDitolak', '$firebase_token', '$user_id')";

        $q = "UPDATE approve_qariah SET id_masjid = $pilih_masjid WHERE id = $del;";
        $q .= "UPDATE approve_anak SET id_masjid = $pilih_masjid WHERE id_qariah = $del OR (no_ic_ketua = '$no_ic' AND no_ic_ketua != '' AND no_ic_ketua IS NOT NULL);";
        $qAnak = "SELECT ID FROM approve_anak WHERE id_qariah = $del OR (no_ic_ketua = '$no_ic' AND no_ic_ketua != '' AND no_ic_ketua IS NOT NULL)";
        selValueSQL($qAnak, 'loopAnak');
        if($num_loopAnak > 0) {
            do {
                $id_anak = $row_loopAnak['ID'];
                $q .= "UPDATE sej6x_data_sakit SET id_masjid = $pilih_masjid WHERE id_anak_approved = $id_anak;";
            } while ($row_loopAnak = mysqli_fetch_assoc($fetch_loopAnak));
        }
        $q .= "UPDATE sej6x_data_sakit SET id_masjid = $pilih_masjid WHERE id_data_approved = $del";
        //echo($q);
        mysqli_multi_query($bd2, $q);

        $q_masjid = "SELECT nama_masjid FROM sej6x_data_masjid WHERE id_masjid = $pilih_masjid";
        $q_masjid2 = mysqli_query($bd2, $q_masjid);
        $row_q_masjid = mysqli_fetch_assoc($q_masjid2);
        $nama_masjid = $row_q_masjid['nama_masjid'];

        $notification = array(
            'title' => "Pendaftaran Ahli Kariah Dipindahkan",
            'body' => "Pendaftaran ahli kariah $nama_penuh telah dipindahkan ke $nama_masjid."
        );
        //echo json_encode($notification);
        sendNotif($firebase_token, $notification);
        header('Location: ../utama.php?view=admin&action=approve_qariah');
    }
    else {
        if ($del_mode == 1) header('Location: ../utama.php?view=admin&action=pendaftaran&module=list_ahli');
        else if ($del_mode == 2) header('Location: ../utama.php?view=admin&action=pendaftaran&module=list_ahli');
        else header('Location: ../utama.php?view=admin&action=approve_qariah');

    }
}
?>