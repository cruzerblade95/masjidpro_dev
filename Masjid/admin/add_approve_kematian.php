<?php

include('../connection/connection.php');
include('../fungsi.php');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $status = $_POST['status'];

    $sql_user = "SELECT * FROM masjid_user WHERE user_id='$_SESSION[user_id]'";
    $query_user = mysqli_query($bd2,$sql_user);
    $data_user = mysqli_fetch_array($query_user);

    if($status==1){
        $tarikh_dikebumikan = $_POST['tarikh_dikebumikan'];
        $waktu_dikebumikan = $_POST['waktu_dikebumikan'];
        $waktu_solatJenazah = $_POST['waktu_solatJenazah'];
        $send_noti = $_POST['send_noti'];
        $id_kematian = $_POST['id_kematian'];
        $remark = $_POST['remark'];

        $sql = "UPDATE data_kematian SET approved='1', tarikh_dikebumikan='$tarikh_dikebumikan', waktu_dikebumikan='$waktu_dikebumikan', waktu_solatJenazah='$waktu_solatJenazah', remark='$remark' WHERE id_kematian='$id_kematian'";
        $sqlquery = mysqli_query($bd2,$sql);

if($send_noti==1) {

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
"id_kematian" : "$id_kematian"
}
DATA;

    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

    $resp = curl_exec($curl);
    curl_close($curl);

}
    }
    else if($status==2){
        $id_kematian = $_POST['id_kematian'];
        $remark = $_POST['remark'];
        $sql = "UPDATE data_kematian SET approved='2', remark='$remark' WHERE id_kematian='$id_kematian'";
        $sqlquery = mysqli_query($bd2,$sql);
    }

    if($sqlquery){
        header("Location: ../utama.php?view=admin&action=approve_kematian");
    }

}

?>
