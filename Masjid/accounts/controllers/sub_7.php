<?php
if($_GET['reset'] == 1) {
    $q = "DELETE FROM accountsCategory WHERE id_masjid = ".$_SESSION['id_masjid']." AND typeModule = 2";
    //echo($q); exit;
    $padamCategory = mysqli_query($bd2, $q);
    if(!$padamCategory) {
        $_SESSION['msgType'] = "danger";
        $_SESSION['msgResult'] = "Semua Rekod gagal dipadam";
    }
    else {
        $_SESSION['msgType'] = "success";
        $_SESSION['msgResult'] = "Semua Rekod telah berjaya dipadam (reset)";
    }
    header("Location: utama.php?view=admin&action=kewangan&sideMenu=&newModul=1&training=1&subModul=7");
    exit;
}
else if($_GET['id'] != NULL && is_numeric($_GET['id'])) {
    $curURL = $_SERVER['REQUEST_URI'];
    $curURL = str_replace("&id=".$_GET['id'], "", $curURL);
    $accountsCategory_id = $_GET['id'];
    $checkAccountRecords = "SELECT SUM(1) AS bilRekod FROM accountsRecords c WHERE (c.accountsCategory_id = $accountsCategory_id OR c.pairAccountsCategory_id = $accountsCategory_id) AND c.typeRecords = 1 GROUP BY c.accountsCategory_id";
    selValueSQL($checkAccountRecords, 'checkAccountRecords');
    if($row_checkAccountRecords['bilRekod'] == 0) {
        $q = "DELETE FROM accountsCategory WHERE id = $accountsCategory_id AND id_masjid = ".$_SESSION['id_masjid'];
        $padamCategory = mysqli_query($bd2, $q);
        if(!$padamCategory) {
            $_SESSION['msgType'] = "danger";
            $_SESSION['msgResult'] = "Rekod gagal dipadam";
        }
        else {
            $_SESSION['msgType'] = "success";
            $_SESSION['msgResult'] = "Rekod telah berjaya dipadam";
        }
    }
    header("Location: $curURL");
    exit;
}
else if($_SERVER['REQUEST_METHOD'] == "POST") {
    $count = count($_POST['categoryName']);
    $table1 = array("id", "categoryCode", "categoryName", "categoryType", "assetType");
    $table2 = array("id_accountsRecords", "accountsCategory_id", "particulars", "particularsType_id", "typeJournalEntry", "amount", "typeRecords", "dateRecords");
    if($count > 0) {
        for($i = 0; $i < $count; $i++) {
            foreach ($_POST as $key => $val) {
                if($_POST[$key][$i] != NULL && $key != "id" && $key != "id_accountsRecords") {
                    if(in_array($key, $table1)) {
                        $cols[$i][] = $key;
                        $vals[$i][] = "'".e($_POST[$key][$i], NULL, NULL)."'";
                        $valsUpdate[$i][] = "$key = '".e($_POST[$key][$i], NULL, NULL)."'";
                    }
                    if(in_array($key, $table2)) {
                        $cols2[$i][] = $key;
                        $vals2[$i][] = "'".e($_POST[$key][$i], NULL, NULL)."'";
                        $valsUpdate2[$i][] = "$key = '".e($_POST[$key][$i], NULL, NULL)."'";
                    }
                }
            }
            array_push($cols[$i],"id_masjid", "updatedBy", "typeModule");
            array_push($vals[$i], $_SESSION['id_masjid'], $_SESSION['user_id'], $training);
            array_push($cols2[$i],"id_masjid", "updatedBy", "typeModule", "baki_permulaan");
            array_push($vals2[$i], $_SESSION['id_masjid'], $_SESSION['user_id'], $training, 1);
            $colsSQL = implode(", ", $cols[$i]);
            $valsSQL = implode(", ", $vals[$i]);
            $colsSQL2 = implode(", ", $cols2[$i]);
            $valsSQL2 = implode(", ", $vals2[$i]);
            $valsUpdateSQL = implode(", ", $valsUpdate[$i]);
            $valsUpdateSQL2 = implode(", ", $valsUpdate2[$i]);
            if($_POST['id'][$i] != NULL && $_POST['id_accountsRecords'][$i] != NULL) {
                $q = "UPDATE accountsCategory SET $valsUpdateSQL WHERE id = ".$_POST['id'][$i];
                $q2 = "UPDATE accountsRecords SET $valsUpdateSQL2 WHERE id = ".$_POST['id_accountsRecords'][$i];
                $updateTable1[$i] = mysqli_query($bd2, $q);
                if(!$updateTable1[$i]) $tidakBerjaya = 1;
                else {
                    $updateTable2[$i] = mysqli_query($bd2, $q2);
                    if(!$updateTable2[$i]) $tidakBerjaya = 1;
                    else {
                        $tidakBerjaya = 0;
                        $kemaskini = 1;
                    }
                }
            }
            else {
                $q = "INSERT INTO accountsCategory ($colsSQL) VALUES ($valsSQL)";
                // echo $q;
                // exit;
                $updateTable1[$i] = mysqli_query($bd2, $q);
                //echo($q.'<br />'."\r\n".$q2."\r\n");
                if(!$updateTable1[$i]) $tidakBerjaya = 1;
                else {
                    $lastID[$i] = mysqli_insert_id($bd2);
                    $cols2[$i][] = "accountsCategory_id";
                    $vals2[$i][] = $lastID[$i];
                    $colsSQL2 = implode(", ", $cols2[$i]);
                    $valsSQL2 = implode(", ", $vals2[$i]);
                    $q2 = "INSERT INTO accountsRecords ($colsSQL2) VALUES ($valsSQL2)";
                    $updateTable2[$i] = mysqli_query($bd2, $q2);
                    if(!$updateTable2[$i]) $tidakBerjaya = 1;
                    else {
                        $tidakBerjaya = 0;
                        $kemaskini = 0;
                    }
                }
            }
            // echo($q.'<br />'."\r\n".$q2."\r\n");
            // echo mysqli_error($bd2);
            // exit;
        }
        if($tidakBerjaya == 0) $_SESSION['msgType'] = "success";
        if($tidakBerjaya == 1) $_SESSION['msgType'] = "danger";
        if($kemaskini == 1 && $tidakBerjaya == 0) $_SESSION['msgResult'] = "Rekod telah berjaya dikemaskini";
        if($kemaskini == 0 && $tidakBerjaya == 0) $_SESSION['msgResult'] = "Rekod telah berjaya dimasukkan";
        if($kemaskini == 1 && $tidakBerjaya == 1) $_SESSION['msgResult'] = "Rekod telah gagal dikemaskini";
        if($kemaskini == 0 && $tidakBerjaya == 1) $_SESSION['msgResult'] = "Rekod telah gagal dimasukkan";
    }
    header("Location: ".$_SERVER['REQUEST_URI']);
    exit;
}
$subSelect = "SELECT SUM(1) AS bilRekod FROM accountsRecords c WHERE (c.accountsCategory_id = b.accountsCategory_id OR c.pairAccountsCategory_id = b.accountsCategory_id) AND c.typeRecords = 1 GROUP BY c.accountsCategory_id LIMIT 1";
$q_base = "SELECT ($subSelect) AS bilRekod, '1' AS kategori, a.id, a.categoryCode, a.categoryName, a.categoryType, b.dateRecords, a.remarks,
       b.amount, b.particulars, b.particularsType_id, b.accountsCategory_id, b.remarks 'remarks2',
       b.id 'id_accountsRecords', b.typeJournalEntry, a.assetType
FROM accountsCategory a LEFT JOIN accountsRecords b ON a.id = b.accountsCategory_id
WHERE b.typeRecords = 2 AND a.id_masjid = ".$_SESSION['id_masjid']." AND a.typeModule = $training AND a.categoryType = ";
$getOpeningDate = "SELECT dateRecords FROM accountsRecords WHERE typeModule = $training AND typeRecords = 2 AND id_masjid = ".$_SESSION['id_masjid']." LIMIT 1";
$q = "($q_base 1) UNION (".str_replace("'1'", "'2'", $q_base)." 1 LIMIT 1)";
$q2 = "($q_base 2) UNION (".str_replace("'1'", "'2'", $q_base)." 2 LIMIT 1)";
selValueSQL($q, 'aset');
selValueSQL($q2, 'ekuiti');
selValueSQL($getOpeningDate, 'openingDate');
$openingDate = $row_openingDate['dateRecords'];
//echo($q.'<br />'.$q2);
?>