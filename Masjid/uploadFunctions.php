<?php
namespace Verot\Upload;
include($_SERVER['DOCUMENT_ROOT']."/Masjid/Classes/phpUpload/class.upload.php");
//include("Classes/phpUpload/class.upload.php");

function uploadFile($inputData, $type, $uploadLocation) {
    global ${$inputData.'_current'};
    if($type == "base64") $handle = new Upload('base64:'.$_FILES[$inputData]);
    else $handle = new Upload($_FILES[$inputData]);

    if ($_FILES[$inputData] != NULL) {
        // Kalau jenis fail image, resize dahulu
        if (strpos($handle->file_src_mime, 'image') !== false) {
            $handle->image_resize = true;
            $handle->image_x = 1000;
            $handle->image_y = 1000;
            $handle->image_ratio = true;
            $handle->image_convert = 'jpg';
        }
        if ($type == "base64") $data = base64_encode($handle->process());
        else {
            $curDate = date('Ymdhis');
            $rawak = rand();
            $namaFile = "file_" . $curDate . "_$rawak";
            $handle->file_new_name_body = $namaFile;
            $handle->process("Uploads/$uploadLocation/");
            $data = "$uploadLocation/$namaFile.jpg";
        }
        if($handle->processed) {
            if ($type == "file" && ${$inputData.'_current'} != NULL) unlink("Uploads/".${$inputData.'_current'}); // Padam fail sebelum ini.
            return $data;
        }
        else return "0";
    }
    else return "0";
}

?>