<?php
    include '../connect.php';
    
    $select = "SELECT * FROM jenisStatistik WHERE status='enable' ORDER BY susunan ASC";
    $list_statistics = mysqli_fetch_all(mysqli_query($conn2,$select),MYSQLI_ASSOC);
    $list_name = array_column($list_statistics,'namaStatistik');
    $list_label = array_column($list_statistics,'labelStatistik');
    
    $select = "SELECT id_masjid,nama_masjid,daerah FROM sej6x_data_masjid";
    $raw_masjid = mysqli_fetch_all(mysqli_query($conn,$select),MYSQLI_ASSOC);
    
    $list_id_masjid = [];
    $list_nama_masji = [];
    foreach($raw_masjid as $list){
        $list_nama_masjid[$list['id_masjid']] = $list['nama_masjid'];
    }
        
    $option = $_POST['option'];
    $param = $_POST['param'];
    $sel = $_POST['sel'];
    
    $option_dec = json_decode($option,true);
    $param_dec = json_decode($param,true);
    
    if($sel > 0){
        $where_clause = 'WHERE ';
        for($i=1;$i<=$sel;$i++){
            $a = $list_name[$option_dec[$i-1]];
            $whr = implode("','",$param_dec[$i-1]);
            if($i > 1){
                $where_clause .= " AND ";
            }
            $where_clause .= $a." IN ('".$whr."')";
            unset($list_name[$option_dec[$i-1]]);
            unset($list_label[$option_dec[$i-1]]);
        }
        $a = $list_name[$option_dec[$sel]];
        unset($list_name[$option_dec[$sel]]);
        unset($list_label[$option_dec[$sel]]);
    }
    else{
        $a= $list_name[$option_dec[0]];
        unset($list_name[$option_dec[0]]);
        unset($list_label[$option_dec[0]]);
    }
    
    if($a == 'id_masjid'){
        $label_list_arr = $list_nama_masjid;
    }else{
        $select = "SELECT a.id_itemStatistik,itemStatistikLabel FROM itemStatistik a 
                    LEFT JOIN jenisStatistik b ON a.id_jenisStatistik = b.id_jenisStatistik
                    WHERE b.namaStatistik = '$a'";
        $label_list = mysqli_fetch_all(mysqli_query($conn2,$select),MYSQLI_ASSOC);
        // $label_list_arr = json_decode($label_list,true);
        $label_list_arr = array_column($label_list,itemStatistikLabel);
    }
    
    if($a == 'id_masjid'){
        $select1 = "SELECT DISTINCT(full_data.id_masjid),sej6x_data_masjid.daerah FROM full_data 
                    LEFT JOIN sej6x_data_masjid ON full_data.id_masjid = sej6x_data_masjid.id_masjid ".$where_clause." ORDER BY daerah ASC";
        $distinct = mysqli_fetch_all(mysqli_query($conn,$select1),MYSQLI_ASSOC);
        $n_array = array_column($distinct,'id_masjid');
        
        $select = "SELECT id_masjid,daerah FROM sej6x_data_masjid";
        $raws_masjid = mysqli_fetch_all(mysqli_query($conn,$select),MYSQLI_ASSOC);
        $all_masjid = [];
        foreach($raws_masjid as $list){
            $all_masjid[$list['id_masjid']] = $list['daerah'];
        } 
        
        
        
        $optgroup = '';
        $html_masjid = '';
        $l_array = [];
        $m_array = [];
        $e = 0;
        $f = 0;
        foreach($n_array as $key => $value){
            if (is_null($value)) {
            }
            else{
                if($label_list_arr[$value]!=''){
                    $l_array[$e] = $value;
                    $m_array[$e] = $label_list_arr[$value];
                    if($optgroup != $all_masjid[$value]){
                        if($optgroup != ''){$html_masjid .= '</optgroup>';}
                        $html_masjid .= '<optgroup label="'.$all_masjid[$value].'" class="group-'.$f.'">';
                        $optgroup = $all_masjid[$value];
                        $f++;
                    }
                    
                    $html_masjid .= '<option value="'.$value.'">'.$label_list_arr[$value].'</option>';
                    
                    $e++;
                }
            }
        }
        $html_masjid .= '</optgroup>';
            
        $e_array = [];
        $f_array = [];
        $e = 0;
        foreach($list_label as $key=>$value){
            $e_array[$e] = $key;
            $f_array[$e] = $value;
            $e++;
        }
        
    }else{
        $select = "SELECT DISTINCT(".$a.") AS data FROM full_data ".$where_clause." ORDER BY data ASC";
        $distinct = mysqli_fetch_all(mysqli_query($conn,$select),MYSQLI_ASSOC);
        $n_array = array_column($distinct,'data');
        $l_array = [];
        $m_array = [];
        $e = 0;
        foreach($n_array as $key => $value){
            if (is_null($value)) {
            }
            else{
                if($label_list_arr[$value]!=''){
                    $l_array[$e] = $value;
                    $m_array[$e] = $label_list_arr[$value];
                    $e++;
                }
            }
        }
            
        $e_array = [];
        $f_array = [];
        $e = 0;
        foreach($list_label as $key=>$value){
            $e_array[$e] = $key;
            $f_array[$e] = $value;
            $e++;
        }
    }
    

    
    echo json_encode($l_array).";".json_encode($m_array).";".json_encode($e_array).";".json_encode($f_array).";".$a.";".$select;
?>