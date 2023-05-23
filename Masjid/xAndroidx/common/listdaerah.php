<?php
require_once('../config.php');
if($_SERVER['REQUEST_METHOD']=='GET') {
    $kodnegeri = $_GET['kodnegeri'];
    $sql = "SELECT id_daerah,nama_daerah FROM daerah where id_negeri= '$kodnegeri' ORDER BY id_daerah";
    $res = mysqli_query($con,$sql);
    $result = array();
    while($row = mysqli_fetch_array($res)){
        array_push($result, array('id'=>$row[0], 'nama'=>$row[1]));
    }
    echo json_encode(array($result));
    mysqli_close($con);
}