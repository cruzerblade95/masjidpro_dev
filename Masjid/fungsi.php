<?php

$user_type_bypass = array("10", "2");
function imageCreateFromAny($filepath)
{
    $type = exif_imagetype($filepath); // [] if you don't have exif you could use getImageSize()
    $allowedTypes = array(
        1,  // [] gif
        2,  // [] jpg
        3  // [] png
        //6   // [] bmp
    );
    if (!in_array($type, $allowedTypes)) {
        return false;
    }
    switch ($type) {
        case 1 :
            $im = imageCreateFromGif($filepath);
            break;
        case 2 :
            $im = imageCreateFromJpeg($filepath);
            break;
        case 3 :
            $im = imageCreateFromPng($filepath);
            break;
        //case 6 :
            //$im = imageCreateFromBmp($filepath);
            //break;
    }
    return $im;
}

function cudSQL($query, $key_name) {
    global $bd2, $bd2_dev, $pilihServer, ${'cud_'.$key_name}, ${'lastid_'.$key_name}, ${'delStatus_'.$key_name}, ${'updateStatus_'.$key_name};

    if($pilihServer == 2) $bd2 = $bd2_dev;
    ${'cud_'.$key_name} = mysqli_query($bd2, $query) or die(mysqli_error($bd2));
    if(${'cud_'.$key_name}) {
        if (strpos(substr($query, 0, 6), 'INSERT') !== false) {
            ${'lastid_' . $key_name} = mysqli_insert_id($bd2);
        }
        if (strpos(substr($query, 0, 6), 'DELETE') !== false) {
            ${'delStatus_' . $key_name} = 1;
        }
        if (strpos(substr($query, 0, 6), 'UPDATE') !== false) {
            ${'updateStatus_' . $key_name} = 1;
        }
    }
}

function cudSQL2($query, $key_name) {
    global $conn, $conn_dev, $pilihServer, ${'cud2_'.$key_name}, ${'lastid2_'.$key_name}, ${'delStatus2_'.$key_name}, ${'updateStatus2_'.$key_name};

    if($pilihServer == 2) $conn = $conn_dev;
    ${'cud2_'.$key_name} = mysqli_query($conn, $query) or die(mysqli_error($conn));
    if(strpos(substr($query,0,6), 'INSERT') !== false) {
        ${'lastid2_'.$key_name} = mysqli_insert_id($conn);
    }
    if(strpos(substr($query,0,6), 'DELETE') !== false) {
        ${'delStatus2_'.$key_name} = 1;
    }
    if(strpos(substr($query,0,6), 'UPDATE') !== false) {
        ${'updateStatus2_'.$key_name} = 1;
    }
}

function selValueSQL0($query, $key_name) {
    global $conn0, $conn0_dev, $pilihServer, ${'meja0_'.$key_name}, ${'row0_'.$key_name}, ${'fetch0_'.$key_name}, ${'num0_'.$key_name}, ${'field0_'.$key_name};

    if($pilihServer == 2) $conn0 = $conn0_dev;
    ${'fetch0_'.$key_name} = mysqli_query($conn0, $query) or die(mysqli_error($conn0));
    ${'field0_'.$key_name} = mysqli_fetch_fields(${'fetch0_'.$key_name});
    ${'num0_'.$key_name} = mysqli_num_rows(${'fetch0_'.$key_name});
    ${'row0_'.$key_name} = mysqli_fetch_assoc(${'fetch0_'.$key_name});
    ${'meja0_'.$key_name} = mysqli_fetch_field(${'fetch0_'.$key_name});
}

function selValueSQL($query, $key_name) {
    global $bd2, $bd2_dev, $pilihServer, ${'meja_'.$key_name}, ${'row_'.$key_name}, ${'fetch_'.$key_name}, ${'num_'.$key_name}, ${'field_'.$key_name};

    if($pilihServer == 2) $bd2 = $bd2_dev;
    ${'fetch_'.$key_name} = mysqli_query($bd2, $query) or die(mysqli_error($bd2));
    ${'field_'.$key_name} = mysqli_fetch_fields(${'fetch_'.$key_name});
    ${'num_'.$key_name} = mysqli_num_rows(${'fetch_'.$key_name});
    ${'row_'.$key_name} = mysqli_fetch_assoc(${'fetch_'.$key_name});
    ${'meja_'.$key_name} = mysqli_fetch_field(${'fetch_'.$key_name});
}

function selValueSQL2($query, $key_name) {
    global $conn, $conn_dev, $pilihServer, ${'meja2_'.$key_name}, ${'row2_'.$key_name}, ${'fetch2_'.$key_name}, ${'num2_'.$key_name}, ${'field2_'.$key_name};

    if($pilihServer == 2) ${'fetch2_'.$key_name} = mysqli_query($conn_dev, $query) or die(mysqli_error($conn_dev));
    else ${'fetch2_'.$key_name} = mysqli_query($conn, $query) or die(mysqli_error($conn));
    ${'field2_'.$key_name} = mysqli_fetch_fields(${'fetch2_'.$key_name});
    ${'num2_'.$key_name} = mysqli_num_rows(${'fetch2_'.$key_name});
    ${'row2_'.$key_name} = mysqli_fetch_assoc(${'fetch2_'.$key_name});
    ${'meja2_'.$key_name} = mysqli_fetch_field(${'fetch2_'.$key_name});
}

function fetchSQL($key_name) {
    global ${'row_'.$key_name}, ${'fetch_'.$key_name}, ${'num_'.$key_name}, ${'field_'.$key_name}, ${'profil_'.$key_name};
    $i = 0;
    do {
        foreach (${'field_'.$key_name} as $field) {
            $result[$i][$field->name] = ${'row_'.$key_name}[$field->name];
            //if (${'num_'.$key_name} > 1) $result[$i][$field->name] = addslashes(${'row_'.$key_name}[$field->name]);
            //else $result[$field->name] = addslashes(${'row_'.$key_name}[$field->name]);
        }
        $i++;
    } while (${'row_'.$key_name} = mysqli_fetch_assoc(${'fetch_'.$key_name}));
    return $result;
}

function selValueId($table, $col_key, $id) {
    global $bd2, ${'row_'.$table}, ${'fetch_'.$table}, ${'num_'.$table};

    if ($id != NULL) $extra = "WHERE $col_key = '$id'";
    else $extra = NULL;
    $q = "SELECT * FROM $table $extra";
    ${'fetch_'.$table} = mysqli_query($bd2, $q) or die(mysqli_error($bd2));
    ${'num_'.$table} = mysqli_num_rows(${'fetch_'.$table});
    ${'row_'.$table} = mysqli_fetch_assoc(${'fetch_'.$table});
}

function mysejahteraExtract($a) {
    if (strpos($a, '&') !== false) {
        $ap = explode("&", $a);
    }
    $result = array();
    foreach ($ap as $key => $val) {
        if($ap[$key] != NULL) $result[$key] = $val;
    }
    echo json_encode($result);
}

function e($a, $b, $c) {
    global $bd2, $bd2_dev, $pilihServer;
    if($b == 1) $a = strtoupper($a);
    //$a = addslashes($a);
    //$a = htmlspecialchars($a);
    if($pilihServer == 2) $a = mysqli_real_escape_string($bd2_dev, $a);
    else $a = mysqli_real_escape_string($bd2, $a);
    if($c == 1) $a = stripslashes($a);
    return $a;
}

// cURL function
function loadcURL($data, $url, $key_name, $content_type) {
    global ${"resultcURL_".$key_name}, ${"infocURL_".$key_name}, ${"objcURL_".$key_name};
    if($content_type == NULL) $data = json_decode($data, true);
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    if($content_type == "json") {
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type:application/json')
        );
    }

    ${"resultcURL_".$key_name} = curl_exec($curl);
    ${"infocURL_".$key_name} = curl_getinfo($curl);
    curl_close($curl);
    ${"objcURL_".$key_name} = json_decode(${"resultcURL_".$key_name}, true);
}

function pilihVal3($modalForm, $a, $b, $c, $d, $e, $f, $g, $h) {
    global $bd2;
    $qqq_info = mysqli_query($bd2, $a) or die(mysqli_error($bd2));
    $qqq_row = mysqli_fetch_assoc($qqq_info);
    if($b == 1) {
        if($c != null) $c = 'id="'.$c.'"';
        else $c = '';
        echo '<select '.$c.' name="'.$d.'" class="'.$e.'" '.$f.'>';
        echo '<option></option>';
        do {
            if($qqq_row['id'] == $g) $pilih = 'selected';
            else $pilih = '';
            echo '<option value="'.$qqq_row['id'].'" '.$pilih.'>'.$qqq_row['val'].'</option>';
        } while($qqq_row = mysqli_fetch_assoc($qqq_info));
        if($h == 2) echo '<option value="-1">LAIN-LAIN</option>';
        echo '</select>';
        if($h == 1) echo '<span class="input-group-btn"><button id="'.$modalForm.'_button" data-toggle="modal" data-target="#'.$modalForm.'" onclick2="selfUpdate(\''.$form.'\', \''.$kawasan.'\')" class="btn btn-primary btn-sm" type="button"><i class="fa fa-plus"></i></button></span>';
    }
}

function pilihanBijak($q, $mode, $input, $label, $wajib, $pilih, $lain) {
	
	$input_name = 'id="'.$input.'" name="'.$input.'"';
	if (strpos($input, '[]') !== false || strpos($input, 'dinamik') !== false) $input_name = 'name="'.$input.'"';
	
	global $bd2;
	$qq = mysqli_query($bd2, $q) or die(mysqli_error($bd2));
	$q_row = mysqli_fetch_assoc($qq);
	$q_tot = mysqli_num_rows($qq);
	
	if($mode == 'select') {
		echo '<label for="'.$input.'">'.$label.'</label>';
		echo '<select class="form-control form-group" '.$input_name.' '.$wajib.'>';
		echo '<option></option>';
		do {
			$dipilih = '';
			if($pilih == $q_row['id']) $dipilih = 'selected';
			echo '<option value="'.e($q_row['id'], NULL, NULL).'" '.$dipilih.'>'.e($q_row['val'], '', $lain).'</option>';
		} while ($q_row = mysqli_fetch_assoc($qq));
		echo '</select>';
	}
}

function numberTowords($num)
{ 
$ones = array( 
1 => "Satu", 
2 => "Dua", 
3 => "Tiga", 
4 => "Empat", 
5 => "Lima", 
6 => "Enam", 
7 => "Tujuh", 
8 => "Lapan", 
9 => "Sembilan", 
10 => "Sepuluh", 
11 => "Sebelas", 
12 => "Dua Belas", 
13 => "Tiga Belas", 
14 => "Empat Belas", 
15 => "Lima Belas", 
16 => "Enam Belas", 
17 => "Tujuh Belas", 
18 => "Lapan Belas", 
19 => "Sembilan Belas" 
); 
$tens = array( 
1 => "Sepuluh",
2 => "Dua Puluh", 
3 => "Tiga Puluh", 
4 => "Empat Puluh", 
5 => "Lima Puluh", 
6 => "Enam Puluh", 
7 => "Tujuh Puluh", 
8 => "Lapan Puluh", 
9 => "Sembilan Puluh" 
); 
$hundreds = array( 
"Ratus", 
"Ribu", 
"Juta", 
"Bilion", 
"Trilion", 
"Kuadrilion" 
); //limit t quadrillion 
$num = number_format($num,2,".",","); 
$num_arr = explode(".",$num); 
$wholenum = $num_arr[0]; 
$decnum = $num_arr[1]; 
$whole_arr = array_reverse(explode(",",$wholenum)); 
krsort($whole_arr); 
$rettxt = ""; 
foreach($whole_arr as $key => $i){ 
if($i < 20){ 
$rettxt .= $ones[$i]; 
}elseif($i < 100){ 
$rettxt .= $tens[substr($i,0,1)]; 
$rettxt .= " ".$ones[substr($i,1,1)]; 
}else{ 
$rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0]; 
$rettxt .= " ".$tens[substr($i,1,1)]; 
$rettxt .= " ".$ones[substr($i,2,1)]; 
} 
if($key > 0){ 
$rettxt .= " ".$hundreds[$key]." "; 
} 
} 
if($decnum > 0){ 
$rettxt .= " dan ";
if($decnum < 20){ 
$rettxt .= $ones[$decnum]; 
}elseif($decnum < 100){ 
$rettxt .= $tens[substr($decnum,0,1)]; 
$rettxt .= " ".$ones[substr($decnum,1,1)]; 
}
$rettxt .= " Sen";
}
return $rettxt; 
}

function showImage($data, $inputName, $idName, $idImagePreview, $required) {
    if($required == 1 || $required == 'required') $required = "required";
    if($data != NULL) $data2 = "https://masjidpro.com/Masjid/Uploads/$data";
    else $data2 = "https://masjidpro.com/Masjid/Uploads/imagesDefaultAvatar.png";
    echo '<div class="input-upload">';
    echo '<img style="max-height: 320px" class="img-fluid" id="'.$idImagePreview.'" src="'.$data2.'" />';
    echo '<input '.$required.' id="'.$idName.'" name="'.$inputName.'" class="form-control" type="file" accept=".jpg,.gif,.png,.jpeg" onchange="preview_image2(event, \''.$idImagePreview.'\')" />';
    echo '<input type="hidden" id="'.$inputName.'_current" name="'.$inputName.'_current" value="'.$data.'" /></div>';
}

function showImage2($data) {
    if($data != NULL) {
        $data = "uploads?file=$data&maxSize=250";
        echo '<img style="max-width: 100%" class="img-fluid" src="'.$data.'" />';
    }
}

function muat_naik($file_form, $path_upload, $is_image, $size_limit_byte, $overwrite, $index_file) {
    $target_dir = $path_upload;
    if($index_file == NULL) $target_file = $target_dir . basename($_FILES["$file_form"]["name"]);
    if($index_file != NULL) $target_file = $target_dir . basename($_FILES["$file_form"]["name"][$index_file]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
    if($is_image == 1) {
        if($index_file == NULL) $check = getimagesize($_FILES["$file_form"]["tmp_name"]);
        if($index_file != NULL) $check = getimagesize($_FILES["$file_form"]["tmp_name"][$index_file]);
        if($check !== false) {
            $sebab = "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            $sebab = "File is not an image.";
            $uploadOk = 0;
        }
    }

// Check if file already exists
    if ($overwrite == 0 & file_exists($target_file)) {
        $sebab =  "Sorry, file already exists.";
        $uploadOk = 0;
    }

// Check file size
    if ($size_limit_byte != 0 && $index_file == NULL && $_FILES["$file_form"]["size"] > $size_limit_byte) {
        $sebab =  "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    if ($size_limit_byte != 0 && $index_file != NULL && $_FILES["$file_form"]["size"][$index_file] > $size_limit_byte) {
        $sebab =  "Sorry, your file is too large.";
        $uploadOk = 0;
    }

// Allow certain file formats
    if($is_image == 1 && $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        $sebab =  "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0 || $imageFileType == 'php' || $imageFileType == 'php3' || $imageFileType == 'php4') {
        $sebab =  "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
    } else {
        if($index_file == NULL) {
            if (move_uploaded_file($_FILES["$file_form"]["tmp_name"], $target_file)) {
                $sebab =  "The file " . basename($_FILES["$file_form"]["name"]) . " has been uploaded.";
            } else {
                $sebab =  "Sorry, there was an error uploading your file.";
            }
        }
        if($index_file != NULL) {
            if (move_uploaded_file($_FILES["$file_form"]["tmp_name"][$index_file], $target_file)) {
                $sebab =  "The file " . basename($_FILES["$file_form"]["name"][$index_file]) . " has been uploaded.";
            } else {
                $sebab =  "Sorry, there was an error uploading your file.";
            }
        }
    }

    if($uploadOk == 1) $result = $target_file;
    if($uploadOk == 0) $result = $sebab;
    return $result;
}
?>