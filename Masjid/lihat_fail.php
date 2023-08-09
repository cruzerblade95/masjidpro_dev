<?php
namespace Verot\Upload;
include($_SERVER['DOCUMENT_ROOT']."/Masjid/Classes/phpUpload/class.upload.php");
if($_GET['fileDB'] != 1) {
    if (file_exists($target_file)) ;
    if ($row_fail['jenis'] == 'pdf') $nama = 'application/';
    else $nama = 'image/';
    if ($_GET['t'] == 'v') header("Content-Type:" . $nama . $row_fail['jenis']);
    else header("Content-Type: $nama/jpg");
}

if($_GET['fileDB'] == 1) {
    if($_GET['file'] != "vaksin" && $_GET['file'] != "buktiKariah" && $_GET['file'] != "gambarProfil" && $_GET['file'] != "komuniti") {
        if ($_GET['file'] == "kematian") $q = "SELECT nama_fail 'file' FROM data_kematian WHERE id_kematian = " . $_GET['id_kematian'];
        if ($_GET['file'] == "lain") $q = "SELECT nama_fail2 'file' FROM data_kematian WHERE id_kematian = " . $_GET['id_kematian'];

        $file = mysqli_query($bd2, $q);
        $file2 = mysqli_fetch_assoc($file);
        $file3 = str_replace('data:application/pdf;base64,', '', $file2['file']);

        header('Content-Type: application/pdf');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        $decoded = base64_decode($file3);
        echo($decoded);
    }
    else {
        if($_GET['file'] == "vaksin") $q = "SELECT file_attach 'file' FROM data_vaksin WHERE no_ic = '" . $_GET['no_ic'] . "' AND id_vaksin = " . $_GET['id_vaksin'];
        if($_GET['file'] == "buktiKariah") $q = "SELECT bukti_kariah 'file' FROM sej6x_data_peribadi WHERE id_data = " . $_GET['id_data'];
        if($_GET['file'] == "gambarProfil") $q = "SELECT gambar_profil 'file' FROM sej6x_data_peribadi WHERE id_data = " . $_GET['id_data'];
        if($_GET['file'] == "komuniti") $q = "SELECT gambar 'file' FROM komuniti_list WHERE id_komunitiList = " . $_GET['id_komunitiList'];
        if($_GET['dev'] == 1) $bd2 = $bd2_dev;
        $file = mysqli_query($bd2, $q) or die(mysqli_error($bd2));
        $file2 = mysqli_fetch_assoc($file);
        $file_base64 = $file2['file'];
        $file_base64 = str_replace('data:image/jpg;base64', '', $file_base64);
        $file_base64 = str_replace('data:image/jpeg;base64', '', $file_base64);
        $file_base64 = str_replace('data:image/png;base64', '', $file_base64);
        $file_base64 = str_replace('data:image/gif;base64', '', $file_base64);
        $handle = new Upload('base64:'.$file_base64);
//        $handle->image_resize = true;
//        $handle->image_x = 1000;
//        $handle->image_y = 1000;
//        $handle->image_ratio = true;
        //header('Content-type: ' . $handle->file_src_mime);
        if($_GET['file'] == "komuniti") {
            header('Content-type: ' . $handle->file_src_mime);
            echo $handle->process();
        }
        else if($_GET['file'] != "buktiKariah" AND $_GET['file'] != "gambarProfil") {
            echo 'data:' . $handle->file_src_mime . ';base64,' . base64_encode($handle->process());
        }
        else if($_GET['file'] == "buktiKariah" OR $_GET['file'] == "gambarProfil") {

            $file_buktiKariah = 'data:'.$handle->file_src_mime.';base64,'.base64_encode($handle->process());
        ?>
            <img class="img-fluid p-3" id="output" src="<?php echo($file_buktiKariah); ?>">
        <?php
        }
        die();
    }
}
?>