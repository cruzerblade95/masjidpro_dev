<?php
require_once('../config.php');
if($_SERVER['REQUEST_METHOD']=='GET') {
  $sql = "SELECT * FROM negeri ORDER BY id_negeri";
  $res = mysqli_query($con,$sql);
  $result = array();
  while($row = mysqli_fetch_array($res)){
    array_push($result, array('id'=>$row[0], 'nama'=>$row[1]));
  }
  echo json_encode(array("value"=>1,"result"=>$result));	
  mysqli_close($con);
}