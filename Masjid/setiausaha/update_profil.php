<?php
        include("../connection/connection.php");

        if(isset( $_POST['kemaskini']))
        {

        $username=mysql_real_escape_string($_POST['username']);
        $password=mysql_real_escape_string($_POST['password']);

        mysql_select_db($mysql_database, $bd);   

        $query="UPDATE masjid_user 
                SET username='$username', password='$password'
                WHERE user_id='$_SESSION[user_id]'";
        
        $conn=mysql_query($query, $bd);

        if ($conn)
         {

       header("location: ../utama.php?view=admin&action=profil");
     // header("Refresh:0;");      

            echo "<h5><b>Maklumat telah dikemaskini.</b></h5>"."</br>";
            //header("location: utama.php?view=admin&action=profil_saved");
        } 
        else {
            echo mysql_error();
            
}
}
        
?>