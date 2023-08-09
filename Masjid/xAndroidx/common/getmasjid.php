<?php
require_once('../config.php');
if($_SERVER['REQUEST_METHOD']=='GET') {
    $kodnegeri = $_GET['kodnegeri'];
    $koddaerah = $_GET['koddaerah'];
  $sql = "SELECT id_masjid,nama_masjid FROM sej6x_data_masjid where id_negeri= '$kodnegeri' and id_daerah ='$koddaerah' ORDER BY id_masjid";
  $res = mysqli_query($con,$sql);
  $result = array();
  while($row = mysqli_fetch_array($res)){
    array_push($result, array('id'=>$row[0], 'nama'=>$row[1]));
  }
  echo json_encode(array("value"=>1,"result"=>$result));	
  mysqli_close($con);
}