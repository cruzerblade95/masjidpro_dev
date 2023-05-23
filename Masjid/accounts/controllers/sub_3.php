<?php
if($_GET['markVoid'] == 1 && $_GET['id'] != NULL) {
    $id_masjid = $_SESSION['id_masjid'];
    $user_id = $_SESSION['user_id'];
    $idBill = explode("-", $_GET['id']);
    $typeJournalEntry = $idBill[0];
    $bilNo = $idBill[1];
    if($typeJournalEntry == 1) $extraBill = "receivedNo = $bilNo";
    else if($typeJournalEntry == 2) $extraBill = "payNo = $bilNo";
    else if($typeJournalEntry == 3) $extraBill = "id = $bilNo AND typeRecords = 3";
    if($training != 2) $q = "UPDATE accountsRecords SET voidStatus = 1, updatedBy = $user_id WHERE typeRecords IN (1, 3) AND id_masjid = $id_masjid AND typeModule = $training AND $extraBill";
    else $q = "DELETE FROM accountsRecords WHERE id_masjid = $id_masjid AND typeModule = $training AND $extraBill";
    //$q = "UPDATE accountsRecords SET voidStatus = 1, updatedBy = $user_id WHERE typeRecords IN (1, 3) AND id_masjid = $id_masjid AND typeModule = $training AND $extraBill";
    //echo($q); exit;
    $inputRekod = mysqli_query($bd2, $q);
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
    header("Location: utama.php?view=admin&action=kewangan&newModul=1&subModul=3&training=".$_GET['training']);
    exit;
}
foreach ($_GET as $key => $val) {
    if($val != NULL && $key != "training") ${$key} = $val;
}
$susun = "ORDER BY a.dateRecords ASC, a.id ASC";
if($pilihRekod != NULL && strpos($pilihRekod, 'A') !== false) {
    $pilihRekod = str_replace("A", "", $pilihRekod);
    $extra = "AND (a.accountsCategory_id = $pilihRekod OR a.pairAccountsCategory_id = $pilihRekod)";
}
else if($pilihRekod != NULL && $pilihRekod != 1) $extra = "AND a.typeRecords = $pilihRekod";
else $pilihRekod = 'SEMUA';
if($pilihSusun == 1) $susun = "ORDER BY a.dateRecords DESC, a.id ASC";
if($pilihSusun == 2) $susun = "ORDER BY a.dateRecords ASC, a.id ASC";
if($pilihSusun == 3) $extra2 = "AND a.typeRecords = 1 AND a.typeJournalEntry IN (1, 2)";
if($pilihSusun == 4) $extra2 = "AND a.typeRecords = 1 AND a.typeJournalEntry = 1";
if($pilihSusun == 5) $extra2 = "AND a.typeRecords = 1 AND a.typeJournalEntry = 2";
if($pilihSusun == 6) $extra2 = "AND a.voidStatus = 1";
$qBase = "SELECT IF(a.payNo IS NULL AND a.receivedNo IS NULL, CONCAT(a.typeRecords, '-', a.id, '-', FLOOR(RAND() * (99999-10000) + 10000)), CONCAT(a.typeJournalEntry, '-', IF(a.payNo IS NOT NULL, a.payNo, a.receivedNo))) 'Bil',
       a.dateRecords 'Tarikh', b.categoryName 'Akaun', a.vendor 'Nama', a.particulars 'Butiran',
       IF(((a.typeJournalEntry = 1 AND a.typeRecords = 1 AND b.categoryType = 1) OR (a.typeJournalEntry = 1 AND a.typeRecords = 1 AND b.categoryType = 2)) OR ((a.typeJournalEntry = 2 AND a.typeRecords = 2 AND b.categoryType = 2) OR (a.typeJournalEntry = 1 AND a.typeRecords = 2 AND b.categoryType = 1)) OR (a.typeRecords = 3 AND ((a.pairAccountsCategory_id = '$pilihRekod' AND '$pilihRekod' != 'SEMUA') OR (a.pairAccountsCategory_id = b.id AND '$pilihRekod' = 'SEMUA'))), SUM(a.amount), '') 'Pendapatan<br />(RM)',
       IF(((a.typeJournalEntry = 2 AND a.typeRecords = 1 AND b.categoryType = 1) OR (a.typeJournalEntry = 2 AND a.typeRecords = 1 AND b.categoryType = 2)) OR ((a.typeJournalEntry = 1 AND a.typeRecords = 2 AND b.categoryType = 2) OR (a.typeJournalEntry = 2 AND a.typeRecords = 2 AND b.categoryType = 1)) OR (a.typeRecords = 3 AND ((a.accountsCategory_id = '$pilihRekod' AND '$pilihRekod' != 'SEMUA') OR (a.accountsCategory_id = b.id AND '$pilihRekod' = 'SEMUA'))), SUM(a.amount), '') 'Perbelanjaan<br />(RM)',
       a.voidStatus, a.typeRecords, a.typeJournalEntry, b.categoryType
FROM accountsRecords a LEFT JOIN accountsCategory b ON (a.pairAccountsCategory_id = b.id OR (a.accountsCategory_id = b.id AND a.pairAccountsCategory_id IS NULL))
WHERE a.id_masjid = $id_masjid AND a.typeModule = $training $extra $extra2
GROUP BY IF(a.payNo IS NULL AND a.receivedNo IS NULL, CONCAT(a.id, '-', FLOOR(RAND() * (99999-10000) + 10000)), CONCAT(a.typeJournalEntry, '-', IF(a.payNo IS NOT NULL, a.payNo, a.receivedNo)))
$susun";
//echo($qBase);
selValueSQL($qBase, 'listRekod');
$namaTabung = "SELECT IF(assetType IN (4) AND categoryName != 'PELABURAN', CONCAT('PELABURAN - ', categoryName), categoryName) 'categoryName', id FROM accountsCategory WHERE id_masjid = $id_masjid AND typeModule = $training";
selValueSQL($namaTabung, 'listAkaunTabung');
?>