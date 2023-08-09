<?php
require_once('../connection/connection.php');
// Connect to server and select database.

    //masuk table sej6x_data_inventori
    $nama_peralatan = $_POST['nama_peralatan'];
    $kod_peralatan_manual = $_POST['kod_peralatan_manual'];
    $kod_peralatan_auto = $_POST['kod_peralatan_auto'];
//    $jenis_peralatan = $_POST['jenis_peralatan'];
    $nama_pegawai = $_POST['nama_pegawai'];
    $nama_penyelenggara = $_POST['nama_penyelenggara'];
    $kuantiti_belian = $_POST['kuantiti_belian'];
    $kuantiti_unit = $_POST['kuantiti_unit'];
    $tarikh_belian = $_POST['tarikh_belian'];
    $harga_belian = $_POST['harga_belian'];
    $lokasi = $_POST['lokasi'];
    $catatan = $_POST['catatan'];
    $kat_peralatan = $_POST['kat_peralatan'];

    //masuk table sej6x_data_pembekal
    $jenis_pembekal = $_POST['jenis_pembekal'];
    $jenis_sewaan = $_POST['jenis_sewaan'];
    $kat_wakaf = $_POST['kat_wakaf'];
    $nama_sewa = $_POST['nama_sewa'];
    $no_sewa = $_POST['no_sewa'];
    $nama_beli = $_POST['nama_beli'];
    $no_beli = $_POST['no_beli'];
    $nama_sumbang = $_POST['nama_sumbang'];


    $sql1 = "INSERT INTO sej6x_data_pembekal (id_masjid, jenis_pembekal, nama_sewa, no_sewa, jenis_sewaan, nama_beli, no_beli, nama_sumbang, kat_wakaf) 
            VALUES ('$id_masjid', '$jenis_pembekal', '$nama_sewa', '$no_sewa', '$jenis_sewaan', '$nama_beli', '$no_beli', '$nama_sumbang', '$kat_wakaf')";
    $r1 = mysqli_query($bd2, $sql1);
    $id_pembekal = mysqli_insert_id($bd2);


//    if($jenis_peralatan == 'other') {
//
//        $otherInput = ucwords($_POST['otherInput']);
//        $jenis_peralatan = $otherInput;
//
//        $sql_catTool = "INSERT INTO sej6x_data_jenisinventori (jenis_inventori, id_masjid) VALUE ('$jenis_peralatan', '$id_masjid')";
//        $r_catTool = mysqli_query($bd2, $sql_catTool);
//    }

    //generate kod peralatan
    if($kod_peralatan_auto === '' && $kod_peralatan_manual ==='') {

        if($kat_peralatan==1)
        {
            $f=substr('DAPUR', 0, 2); // pre defined function of php
        }
        else if($kat_peralatan==2)
        {
            $f=substr('ELEKTRIK', 0, 2); // pre defined function of php
        }
        else if($kat_peralatan==3)
        {
            $f=substr('PERABOT', 0, 2); // pre defined function of php
        }
        else if($kat_peralatan==4)
        {
            $f=substr('KENDERAAN', 0, 2); // pre defined function of php
        }
        else
        {
            $f=substr($kat_peralatan, 0, 2); // pre defined function of php
        }
        echo '<br>';
        echo $m=date('m'); // Get the month
        echo '<br>';
        echo $y=date('y'); // Get the dat
        echo '<br>';
        echo $d=date('d'); // Get the Year
        echo '<br>';
        echo '<br>';

        // Get the rows count
        $GetSidNo=mysqli_query($bd2, "SELECT * FROM sej6x_data_inventori WHERE id_masjid='$id_masjid'");
        $GetSidNo1=mysqli_num_rows($GetSidNo);
        $invID = str_pad($GetSidNo1, 4, '0', STR_PAD_LEFT);

        $no_rujukan= $f.$y.$m.$d.$invID;

        $t=time();

        $kod_peralatan = $no_rujukan;

        //date($variable, 'd-m-Y H:i:s');
    }
    else {
        $kod_peralatan = $kod_peralatan_manual;
    }

    $sql2 = "INSERT INTO sej6x_data_inventori ( id_masjid, nama_peralatan, kod_peralatan, jenis_peralatan, tarikh_belian, id_pegawai, id_penyelenggara, kuantiti_belian, kuantiti_unit, harga_belian, lokasi, id_pembekal, catatan) VALUES ( '$id_masjid', '$nama_peralatan', '$kod_peralatan', '$kat_peralatan', '$tarikh_belian', '$nama_pegawai', '$nama_penyelenggara', '$kuantiti_belian', '$kuantiti_unit', '$harga_belian', '$lokasi', '$id_pembekal', '$catatan')";
    $r2 = mysqli_query($bd2, $sql2);

    if($r2)
    {
        header("Location: ../utama.php?view=admin&action=maklumatinventori&sideMenu=masjid");
    }
    else
    {
        echo mysqli_error($bd2);
    }
?>