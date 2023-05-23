<?php
    
    include "connect.php";
    
    $select3 = "SELECT row_number() over(order by daerah) as bil,sej6x_data_masjid.daerah,sej6x_data_masjid.nama_masjid,COUNT(*) as count FROM full_data LEFT JOIN sej6x_data_masjid ON full_data.id_masjid = sej6x_data_masjid.id_masjid ".$where_clause." GROUP BY nama_masjid ORDER BY daerah ASC";
    $data_by_masjid = mysqli_fetch_all(mysqli_query($conn,$select3),MYSQLI_ASSOC);
    print_r(json_encode($data_by_masjid));        
?>