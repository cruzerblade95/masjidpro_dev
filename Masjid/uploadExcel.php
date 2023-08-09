<?php

	include('connection/connection.php');

	$jenis_excel = $_POST['pilihExcel'];
	$uploadfile=$_FILES['uploadfile']['tmp_name'];

	require 'PHPExcel/Classes/PHPExcel.php';
	require_once 'PHPExcel/Classes/PHPExcel/IOFactory.php';

	$objExcel=PHPExcel_IOFactory::load($uploadfile);
	foreach($objExcel->getWorksheetIterator() as $worksheet)
	{
		$highestrow=$worksheet->getHighestRow();

		for($row=2;$row<=$highestrow;$row++) {
            if ($jenis_excel == 1) {
                $no_rujukan = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                $nama_penuh = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                $no_ic = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                $no_hp = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                $warganegara = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                $bangsa = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                $jantina = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                $status_perkahwinan = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                $pekerjaan = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                $alamat_terkini = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                $negeri = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                $daerah = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                $poskod = $worksheet->getCellByColumnAndRow(12, $row)->getValue();

                $no_ic = str_replace("-", "", $no_ic);
                $str_ic = strlen($no_ic);

                if ($str_ic == 12) {

                    $warganegara = ucwords($warganegara);
                    if ($warganegara == "Warganegara") {
                        $warganegara = 1;
                    }
                    if ($warganegara == "Bukan Warganegara") {
                        $warganegara = 2;
                    }

                    $year = substr($no_ic, 0, 2);
                    $month = substr($no_ic, 2, 2);
                    $day = substr($no_ic, 4, 2);
                    if ($year >= (date('y') + 1)) {
                        $year = "19" . $year;
                    } else if ($year <= date('y')) {
                        $year = "20" . $year;
                    }
                    $tarikh_lahir = $year . "-" . $month . "-" . $day;

                    $bangsa = str_replace('-',' ',$bangsa);
                    $bangsa = ucwords($bangsa);
                    $bangsa = str_replace(' ','-',$bangsa);
                    if ($bangsa == "Melayu") {
                        $bangsa = 1;
                    } else if ($bangsa == "Cina") {
                        $bangsa = 2;
                    } else if ($bangsa == "India") {
                        $bangsa = 3;
                    } else if ($bangsa == "Lain-Lain") {
                        $bangsa = 4;
                    }

                    $jantina = ucwords($jantina);
                    if ($jantina == "Lelaki") {
                        $jantina = 1;
                    } else if ($jantina == "Perempuan") {
                        $jantina = 2;
                    }

                    $status_perkahwinan = ucwords($status_perkahwinan);
                    if ($status_perkahwinan == "Bujang") {
                        $status_perkahwinan = 1;
                    } else if ($status_perkahwinan == "Berkahwin") {
                        $status_perkahwinan = 2;
                    } else if ($status_perkahwinan == "Duda") {
                        $status_perkahwinan = 3;
                    } else if ($status_perkahwinan == "Janda") {
                        $status_perkahwinan = 4;
                    }

                    $pekerjaan = ucwords($pekerjaan);
                    if ($pekerjaan == "Kerajaan") {
                        $pekerjaan = 1;
                    } else if ($pekerjaan == "Swasta") {
                        $pekerjaan = 2;
                    } else if ($pekerjaan == "Sendiri") {
                        $pekerjaan = 3;
                    } else if ($pekerjaan == "Pencen") {
                        $pekerjaan = 4;
                    } else if ($pekerjaan == "Tidak Bekerja") {
                        $pekerjaan = 5;
                    }

                    $negeri = strtoupper($negeri);
                    $sql_negeri = "SELECT * FROM negeri WHERE name = '$negeri'";
                    $query_negeri = mysqli_query($bd2, $sql_negeri);
                    $data_negeri = mysqli_fetch_array($query_negeri);
                    $bil_negeri = mysqli_num_rows($query_negeri);

                    if ($bil_negeri>0) {
                        $negeri = $data_negeri['id_negeri'];
                    } else {
                        $negeri;
                    }

                    $daerah = strtoupper($daerah);
                    $sql_daerah = "SELECT * FROM daerah WHERE nama_daerah = '$daerah'";
                    $query_daerah = mysqli_query($bd2, $sql_daerah);
                    $data_daerah = mysqli_fetch_array($query_daerah);
                    $bil_daerah = mysqli_num_rows($query_daerah);

                    if ($bil_daerah>0){
                        $daerah = $data_daerah['id_daerah'];
                    } else {
                        $daerah;
                    }

                    $nama_penuh = strtoupper($nama_penuh);
                    $alamat_terkini = strtoupper($alamat_terkini);


                    $sql = "SELECT * FROM sej6x_data_peribadi WHERE no_ic='$no_ic'";
                    $sqlquery = mysqli_query($bd2, $sql);
                    $bil = mysqli_num_rows($sqlquery);

                    if ($bil == 0) {
                        $insertqry = "INSERT INTO sej6x_data_peribadi (no_rujukan,id_masjid,nama_penuh,no_ic,no_hp,tarikh_lahir,warganegara,bangsa,jantina,status_perkahwinan,pekerjaan,alamat_terkini,id_negeri,id_daerah,poskod,added_by) VALUES ('$no_rujukan','$id_masjid','$nama_penuh','$no_ic','$no_hp','$tarikh_lahir','$warganegara','$bangsa','$jantina','$status_perkahwinan','$pekerjaan','$alamat_terkini','$negeri','$daerah','$poskod','$user_id')";
                        $insertres = mysqli_query($bd2, $insertqry);
                    }
                }

            }
            else if($jenis_excel == 2) {
                $ic_qariah = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                $nama_penuh = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                $no_ic = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                $no_tel = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                $hubungan = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                $warganegara = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                $bangsa = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                $jantina = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                $status_perkahwinan = $worksheet->getCellByColumnAndRow(8, $row)->getValue();

                $no_ic = str_replace("-", "", $no_ic);
                $str_ic = strlen($no_ic);

                if ($str_ic == 12) {

                    $sql_ic = "SELECT * FROM sej6x_data_peribadi WHERE no_ic='$ic_qariah'";
                    $query_ic = mysqli_query($bd2,$sql_ic);
                    $data_ic = mysqli_fetch_array($query_ic);
                    $bil_ic = mysqli_num_rows($query_ic);

                    if($bil_ic>0) {
                        $id_qariah = $data_ic['id_data'];

                        $warganegara = ucwords($warganegara);
                        if ($warganegara == "Warganegara") {
                            $warganegara = 1;
                        } else if ($warganegara == "Bukan Warganegara") {
                            $warganegara = 2;
                        }

                        $year = substr($no_ic, 0, 2);
                        $month = substr($no_ic, 2, 2);
                        $day = substr($no_ic, 4, 2);
                        if ($year >= (date('y') + 1)) {
                            $year = "19" . $year;
                        } else if ($year <= date('y')) {
                            $year = "20" . $year;
                        }
                        $tarikh_lahir = $year . "-" . $month . "-" . $day;

                        $bangsa = str_replace('-',' ',$bangsa);
                        $bangsa = ucwords($bangsa);
                        $bangsa = str_replace(' ','-',$bangsa);
                        if ($bangsa == "Melayu") {
                            $bangsa = 1;
                        } else if ($bangsa == "Cina") {
                            $bangsa = 2;
                        } else if ($bangsa == "India") {
                            $bangsa = 3;
                        } else if ($bangsa == "Lain-Lain") {
                            $bangsa = 4;
                        }

                        $jantina = ucwords($jantina);
                        if ($jantina == "Lelaki") {
                            $jantina = 1;
                        } else if ($jantina == "Perempuan") {
                            $jantina = 2;
                        }

                        $status_perkahwinan = ucwords($status_perkahwinan);
                        if ($status_perkahwinan == "Bujang") {
                            $status_perkahwinan = 1;
                        } else if ($status_perkahwinan == "Berkahwin") {
                            $status_perkahwinan = 2;
                        } else if ($status_perkahwinan == "Duda") {
                            $status_perkahwinan = 3;
                        } else if ($status_perkahwinan == "Janda") {
                            $status_perkahwinan = 4;
                        }

                        $hubungan = strtoupper($hubungan);
                        $sql_hubungan = "SELECT * FROM jenis_hubungan WHERE hubungan = '$hubungan'";
                        $query_hubungan = mysqli_query($bd2, $sql_hubungan);
                        $data_hubungan = mysqli_fetch_array($query_hubungan);
                        $bil_hubungan = mysqli_num_rows($query_hubungan);

                        if ($bil_hubungan>0) {
                            $hubungan = $data_hubungan['id_hubungan'];
                        } else {
                            $hubungan;
                        }

                        $nama_penuh = strtoupper($nama_penuh);

                        $sql = "SELECT * FROM sej6x_data_anakqariah WHERE no_ic='$no_ic'";
                        $sqlquery = mysqli_query($bd2, $sql);
                        $bil = mysqli_num_rows($sqlquery);

                        if ($bil == 0) {
                            $insertqry = "INSERT INTO sej6x_data_anakqariah (id_qariah,no_rujukan,id_masjid,nama_penuh,no_ic,no_tel,tarikh_lahir,warganegara,bangsa,jantina,status_kahwin,hubungan) VALUES ('$id_qariah','$no_rujukan','$id_masjid','$nama_penuh','$no_ic','$no_tel','$tarikh_lahir','$warganegara','$bangsa','$jantina','$status_perkahwinan','$hubungan')";
                            $insertres = mysqli_query($bd2, $insertqry);
                        }
                    }
                }
            }
        }
	}
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Maklumat Telah Dimasukkan');
    window.location.href='utama.php?view=admin&action=uploadDaftar';
    </script>");
?>