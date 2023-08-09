 <?php
      include("../connection/connection.php");
        //require_once('../connection/connection.php'); 
        if (isset($_POST['delete']) && isset($_POST['del']))
        //echo 'del';
        {
        $id_aduan=$_POST['del'];

        // Delete data in mysql from row that has this id
        $sqldel="DELETE FROM data_aduan WHERE id_aduan='$id_aduan' ";
        $result=mysql_query($sqldel);

        if($result){
        header('Location: ../utama.php?view=admin&action=aduan');  
         }
    	echo "error"; 
        }
      ?>

