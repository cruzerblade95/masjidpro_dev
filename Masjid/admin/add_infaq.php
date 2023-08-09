<?php

include ('../connection/connection.php');
include ("../fungsi.php");

if(isset($_POST['add_infaq'])){

    $id_masjid = $_POST['id_masjid'];

    $kategori = e($_POST['kategori'], NULL, NULL);
    $jenis_tabung = e($_POST['jenis_tabung'], NULL, NULL);
    $keterangan = e($_POST['keterangan'], NULL, NULL);

    $sql_infaq = "INSERT INTO category_infaq (category,jenis_tabung,id_masjid,description,date_added,added_by) VALUES ('$kategori','$jenis_tabung','$id_masjid','$keterangan',NOW(),'$user_id')";
    $query_infaq = mysqli_query($bd2,$sql_infaq);

    if($query_infaq){
        header("Location: ../utama.php?view=admin&action=infaq");
    }
}
else if(isset($_POST['add_harga'])){

    $id_tabung = $_POST['id_tabung'];

    $harga = e($_POST['harga'], NULL, NULL);
    $keterangan = e($_POST['keterangan'], NULL, NULL);
    
    $sql_infaq = "SELECT * FROM category_infaq WHERE id_tabung='$id_tabung'";
    $query_infaq = mysqli_query($bd2,$sql_infaq);
    $data_infaq = mysqli_fetch_array($query_infaq);
    
    $category = e($data_infaq['category'], NULL, NULL);
    $sub_category = e($data_infaq['jenis_tabung'], NULL, NULL);

    $sql_harga = "INSERT INTO list_harga_infaq (id_tabung,category,subcategory,harga,description,date_added,added_by) VALUES ('$id_tabung','$category','$sub_category','$harga','$keterangan',NOW(),'$user_id')";
    $query_harga = mysqli_query($bd2,$sql_harga);

    if($query_harga){
        header("Location: ../utama.php?view=admin&action=list_infaq&id_tabung=$id_tabung");
    }
}




?>