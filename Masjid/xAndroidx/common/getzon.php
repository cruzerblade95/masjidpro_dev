<?php
require_once('../config.php');
if($_SERVER['REQUEST_METHOD']=='GET') {
    $kodmasjid = $_GET['kodmasjid'];
    $sql = "SELECT id_zonqariah,nama_zon,no_huruf FROM sej6x_data_zonqariah where id_masjid= '$kodmasjid' ORDER BY no_huruf,id_zonqariah";
    $res = mysqli_query($con,$sql);
    $result = array();
    while($row = mysqli_fetch_array($res)){
        array_push($result, array('id'=>$row[0], 'nama'=>$row[1],'huruf'=>$row[2]));
    }
    echo json_encode(array("value"=>1,"result"=>$result));
    mysqli_close($con);
}