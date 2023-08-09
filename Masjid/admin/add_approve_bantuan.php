<?php

include('../connection/connection.php');
include('../fungsi.php');
if(isset($_POST['submit_approve']))
{
    $id_approve = $_POST['id_bantuan'];
    $kaedah_bayar = $_POST['kaedah_bayar'];
    $amaun_item = $_POST['amaun_bantuan']; 
    $remark = $_POST['remark'];
    $tarikh_approve = date('Y-m-d');
    $tarikh_bantuan = $_POST['tarikh_bantuan'];


    $sql_approve = "UPDATE bantuan_zakat SET kaedah_bayar='$kaedah_bayar', tarikh_bantuan='$tarikh_bantuan', amaun='$amaun_item', tarikh_proses='$tarikh_approve', sebab_lain='$remark', status_bantuan='1' WHERE id_bantuan='$id_approve'";
    $query_approve = mysqli_query($bd2,$sql_approve);

    if($query_approve){

    $id_approve = $_POST['id_bantuan'];

    $sql_user = "SELECT sej6x_data_peribadi.firebase_token, sej6x_data_peribadi.nama_penuh FROM sej6x_data_peribadi LEFT JOIN bantuan_zakat ON bantuan_zakat.id_data = sej6x_data_peribadi.id_data
                    WHERE sej6x_data_peribadi.id_masjid = $id_masjid AND bantuan_zakat.id_bantuan = $id_approve";
    $query_user = mysqli_query($bd2,$sql_user);

    $bil =mysqli_num_rows($query_user);
    if ($bil > 0) {

        $data_user = mysqli_fetch_assoc($query_user);
        $jenisUser = 1;
    }
    else {

        $sql_user1 = "SELECT sej6x_data_anakqariah.firebase_token, sej6x_data_anakqariah.nama_penuh FROM sej6x_data_anakqariah LEFT JOIN bantuan_zakat ON bantuan_zakat.id_data = sej6x_data_anakqariah.ID
                    WHERE sej6x_data_anakqariah.id_masjid = $id_masjid AND bantuan_zakat.id_bantuan = $id_approve";
        $query_user1 = mysqli_query($bd2,$sql_user1);
        $data_user = mysqli_fetch_assoc($query_user1);
        $jenisUser = 3;

    }

    $url = "https://api.masjidpro.com/hantarNoti?token=$data_user[firebase_token]&jenisUser=2&userid=$data_user[username]&kematian=1";

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $headers = array(
        "Content-Type: application/json",
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

    //$data = <<<DATA
    //{
    //"title": "Makluman kematian baharu",
    //"body": "Assalamualaikum, untuk makluman ahli kariah, solat jenazah $infoMati akan diadakan pada $tarikh_dikebumikan jam $waktu_solatJenazah dan akan dikebumikan jam $waktu_dikebumikan.",
    //"jenis": ["Kariah"]
    //}
    //DATA;
    $data = <<<DATA
    {
    "title": "Makluman kematian baharu",
    "body": "Assalamualaikum, untuk makluman ahli kariah, solat jenazah  akan diadakan pada  jam  dan akan dikebumikan jam .",
    "id_bantuan" : "$id_approve"
    }
    DATA;


    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

    $resp = curl_exec($curl);
    curl_close($curl);

    header("Location: ../utama.php?view=admin&action=approve_bantuan");
    }
}


?>
