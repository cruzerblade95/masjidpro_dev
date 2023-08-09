<?php
$id_masjid = $_SESSION['id_masjid'];
$user_id = $_SESSION['user_id'];
$pilihRekod = $_GET['pilihRekod'];
$selectRekod = $_GET['pilihRekod'];
if($pilihRekod != NULL && strpos($pilihRekod, 'A') !== false) {
    $pilihRekod = str_replace("A", "", $pilihRekod);
}
// echo $pilihRekod;
// exit;

// echo var_dump($_GET);
// exit;

// Delete Record
if($_GET['markVoid'] == 1 && $_GET['deleteId'] != NULL) {
    $deleteId = $_GET['deleteId'];
    // $idBill = explode("-", $_GET['id']);
    // $typeJournalEntry = $idBill[0];
    // $bilNo = $idBill[1];
    // if($typeJournalEntry == 1) $extraBill = "receivedNo = $bilNo";
    // else if($typeJournalEntry == 2) $extraBill = "payNo = $bilNo";
    // else if($typeJournalEntry == 3) $extraBill = "id = $bilNo AND typeRecords = 3";
    
    if($training != 2) $q = "UPDATE accountsRecords SET voidStatus = 1, updatedBy = $user_id WHERE typeRecords IN (1, 3) AND id_masjid = $id_masjid AND typeModule = $training AND $extraBill";
    else $q = "DELETE FROM accountsRecords WHERE id_masjid = $id_masjid AND typeModule = $training AND id = $deleteId";
    //$q = "UPDATE accountsRecords SET voidStatus = 1, updatedBy = $user_id WHERE typeRecords IN (1, 3) AND id_masjid = $id_masjid AND typeModule = $training AND $extraBill";
    // echo($q); exit;
    $inputRekod = mysqli_query($bd2, $q);
    // echo $inputRekod;
    // exit;
    if(!$inputRekod) $berjaya = 0;
    else $berjaya = 1;

    if($berjaya == 1) {
        $_SESSION['msgType'] = "success";
        if($_GET['training'] != 1) $_SESSION['msgResult'] = "Rekod kewangan berjaya dibatalkan";
        else $_SESSION['msgResult'] = "Rekod kewangan berjaya dipadamkan";
    }
    else {
        $_SESSION['msgType'] = "danger";
        if($_GET['training'] != 1) $_SESSION['msgResult'] = "Rekod kewangan tidak berjaya dibatalkan";
        else $_SESSION['msgResult'] = "Rekod kewangan tidak berjaya dipadamkan";
    }
    header("Location: utama.php?view=admin&action=kewangan&newModul=1&subModul=9&training=".$_GET['training']."&pilihRekod=1&pilihSusun=");
    exit;
}

if($pilihRekod == 1){
    
    $qBase = querySemua($id_masjid, $training);
    
}else if($pilihRekod == 2){
    
    $qBase = "SELECT a.dateRecords 'Tarikh', b.categoryName 'Akaun', a.particulars 'Butiran', a.vendor 'Nama', 
    IF (a.pairAccountsCategory_id IS NULL, a.amount, '') 'Pendapatan<br />(RM)',
    IF (a.accountsCategory_id IS NULL, a.amount, '') 'Perbelanjaan<br />(RM)'
    FROM accountsRecords a 
    LEFT JOIN accountsCategory b ON (a.accountsCategory_id = b.id) OR (a.pairAccountsCategory_id = b.id)
    WHERE a.id_masjid = $id_masjid AND a.typeModule = $training AND a.pairAccountsCategory_id IS NULL";

}else if(strpos($selectRekod, 'A') !== false){
    $qBase = queryPilihan($id_masjid, $training, $pilihRekod);
}else{
    $qBase = querySemua($id_masjid, $training);
}

selValueSQL($qBase, 'listRekod');
$namaTabung = "SELECT IF(assetType IN (4) AND categoryName != 'PELABURAN', CONCAT('PELABURAN - ', categoryName), categoryName) 'categoryName', id FROM accountsCategory WHERE id_masjid = $id_masjid AND typeModule = $training";
selValueSQL($namaTabung, 'listAkaunTabung');

function querySemua($id_masjid, $training){
    $qBase = 
    "SELECT IF(a.inBatch = 0, a.id, CONCAT(IF(a.receivedNo > 0, CONCAT(a.receivedNo, '-1'), ''), IF(a.payNo > 0, CONCAT(a.payNo, '-2'), ''), IF(a.groupTransactionID > 0, CONCAT(a.groupTransactionID, '-3'),''))) 'pairId',
    IF(a.payNo IS NULL AND a.receivedNo IS NULL, CONCAT(a.typeRecords, '-', a.id, '-', FLOOR(RAND() * (99999-10000) + 10000)), CONCAT(a.typeJournalEntry, '-', IF(a.payNo IS NOT NULL, a.payNo, a.receivedNo))) 'Bil',
    a.id, a.typeJournalEntry, b.assetType, a.susut_nilai, a.accountsCategory_id, a.typeRecords, a.dateRecords 'Tarikh', b.categoryName 'Akaun', a.particulars 'Butiran', a.vendor 'Nama', a.pairAccountsCategory_id,
    IF(
        (a.typeRecords = 1 AND a.typeJournalEntry = 2) OR 
        (a.typeRecords = 3 AND a.typeJournalEntry = 2 AND a.hasSiBerhutang = 0) OR
        (a.typeRecords = 3 AND a.typeJournalEntry = 2 AND a.hasSiBerhutang = 1 AND b.assetType != 7) OR
        (a.typeRecords = 3 AND a.typeJournalEntry = 1 AND a.hasSiBerhutang = 1 AND b.assetType = 7) OR
        (a.typeRecords = 3 AND a.typeJournalEntry = 2 AND a.hasSiBerhutang = 2 AND b.assetType != 7) OR
        (a.typeRecords = 3 AND a.typeJournalEntry = 1 AND a.hasSiBerhutang = 2 AND b.assetType = 7) OR 
        (
            (a.baki_permulaan IS NOT NULL AND a.typeJournalEntry = 1) OR
            (a.baki_permulaan IS NOT NULL AND a.typeJournalEntry = 2)
        ), SUM(a.amount), '') 'Pendapatan<br />(RM)',
    IF(
        (a.typeRecords = 1 AND a.typeJournalEntry = 1) OR 
        (a.typeRecords = 3 AND a.typeJournalEntry = 1 AND a.hasSiBerhutang = 0) OR
        (a.typeRecords = 3 AND a.typeJournalEntry = 1 AND a.hasSiBerhutang = 1 AND b.assetType != 7) OR
        (a.typeRecords = 3 AND a.typeJournalEntry = 2 AND a.hasSiBerhutang = 1 AND b.assetType = 7) OR
        (a.typeRecords = 3 AND a.typeJournalEntry = 1 AND a.hasSiBerhutang = 2 AND b.assetType != 7)
        , SUM(a.amount), '') 'Perbelanjaan<br />(RM)',
    SUM(a.amount) 'Sum Batch Amount',
    b.categoryName 'Account Category Name',
    (SELECT aa.categoryName FROM accountsCategory aa WHERE a.pairAccountsCategory_id = aa.id) 'Pair Account Category Name'
    FROM `accountsRecords` a
    LEFT JOIN accountsCategory b ON a.accountsCategory_id = b.id
    WHERE a.id_masjid = $id_masjid AND a.typeModule = $training
    GROUP BY IF(a.kiraan > 0, (pairId), a.id)";

    // echo $qBase;
    // exit;
    return $qBase;
}

function queryPilihan($id_masjid, $training, $pilihRekod)
{
    $qBase = 
    "SELECT IF(a.inBatch = 0, a.id, CONCAT(IF(a.receivedNo > 0, CONCAT(a.receivedNo, '-1'), ''), IF(a.payNo > 0, CONCAT(a.payNo, '-2'), ''), IF(a.groupTransactionID > 0, CONCAT(a.groupTransactionID, '-3'),''))) 'pairId',
    IF(a.payNo IS NULL AND a.receivedNo IS NULL, CONCAT(a.typeRecords, '-', a.id, '-', FLOOR(RAND() * (99999-10000) + 10000)), CONCAT(a.typeJournalEntry, '-', IF(a.payNo IS NOT NULL, a.payNo, a.receivedNo))) 'Bil',
    a.id, a.typeJournalEntry, b.assetType, a.susut_nilai, a.accountsCategory_id, a.typeRecords, a.dateRecords 'Tarikh', b.categoryName 'Akaun', a.particulars 'Butiran', a.vendor 'Nama', a.pairAccountsCategory_id,
    IF(
        (a.typeRecords = 1 AND a.typeJournalEntry = 2) OR 
        (a.typeRecords = 3 AND a.typeJournalEntry = 2 AND a.hasSiBerhutang = 0) OR
        (a.typeRecords = 3 AND a.typeJournalEntry = 2 AND a.hasSiBerhutang = 1 AND b.assetType != 7) OR
        (a.typeRecords = 3 AND a.typeJournalEntry = 1 AND a.hasSiBerhutang = 1 AND b.assetType = 7) OR
        (a.typeRecords = 3 AND a.typeJournalEntry = 2 AND a.hasSiBerhutang = 2 AND b.assetType != 7) OR
        (a.typeRecords = 3 AND a.typeJournalEntry = 1 AND a.hasSiBerhutang = 2 AND b.assetType = 7) OR 
        (
            (a.baki_permulaan IS NOT NULL AND a.typeJournalEntry = 1) OR 
            (a.baki_permulaan IS NOT NULL AND a.typeJournalEntry = 2)
        ), SUM(a.amount), '') 'Pendapatan<br />(RM)',
    IF(
        (a.typeRecords = 1 AND a.typeJournalEntry = 1) OR 
        (a.typeRecords = 3 AND a.typeJournalEntry = 1 AND a.hasSiBerhutang = 0) OR
        (a.typeRecords = 3 AND a.typeJournalEntry = 1 AND a.hasSiBerhutang = 1 AND b.assetType != 7) OR
        (a.typeRecords = 3 AND a.typeJournalEntry = 2 AND a.hasSiBerhutang = 1 AND b.assetType = 7) OR
        (a.typeRecords = 3 AND a.typeJournalEntry = 1 AND a.hasSiBerhutang = 2 AND b.assetType != 7)  
        , SUM(a.amount), '') 'Perbelanjaan<br />(RM)',
    SUM(a.amount) 'Sum Batch Amount',
    b.categoryName 'Account Category Name',
    (SELECT aa.categoryName FROM accountsCategory aa WHERE a.pairAccountsCategory_id = aa.id) 'Pair Account Category Name'
    FROM `accountsRecords` a
    LEFT JOIN accountsCategory b ON a.accountsCategory_id = b.id
    WHERE a.id_masjid = $id_masjid AND a.typeModule = $training AND a.accountsCategory_id = $pilihRekod
    GROUP BY IF(a.kiraan > 0, (pairId), a.id)";

    return $qBase;

}
?>