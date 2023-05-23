<?php
if($_SERVER['REQUEST_METHOD'] == "POST") {
    $id_masjid = $_SESSION['id_masjid'];
    $user_id = $_SESSION['user_id'];
    $accountsCategory_id = explode("|", $accountsCategory_id)[0];

    if($jenisTransaksi == 1) $typeRecords = 3;
    else $typeRecords = 1;
    $sqlNumbering = "SELECT IFNULL(MAX(groupTransactionID), 0) + 1 AS numbering FROM accountsRecords WHERE typeModule = $training AND typeRecords = $typeRecords AND id_masjid = $id_masjid";
    $sqlNumbering2 = mysqli_query($bd2, $sqlNumbering);
    $row_numbering = mysqli_fetch_assoc($sqlNumbering2);
    $autoNumbering = $row_numbering['numbering'];

    if($amount > 0 && $accountsCategory_id != NULL && $pairAccountsCategory_id != NULL) {
        $typeJournalEntry = "SELECT IF(categoryType IN (1, 4), 2, IF(categoryType IN (2, 3), 1, 0)) AS typeJournal FROM accountsCategory WHERE id = $accountsCategory_id";
        $q = "INSERT INTO accountsRecords (groupTransactionID, id_masjid, accountsCategory_id, pairAccountsCategory_id, amount, particulars, updatedBy, dateRecords, typeJournalEntry, typeRecords, typeModule)
VALUES ('$autoNumbering', $id_masjid, $accountsCategory_id, $pairAccountsCategory_id, '$amount', '$particulars', $user_id, '$dateRecords', ($typeJournalEntry), 3, $training)";
        //echo($q.'<br />');
        $inputRekod = mysqli_query($bd2, $q);
        if(!$inputRekod) $berjaya = 0;
        else $berjaya = 1;
    }
    if($berjaya == 1) {
        $_SESSION['msgType'] = "success";
        $_SESSION['msgResult'] = "Rekod berjaya dimasukkan";
    }
    else {
        $_SESSION['msgType'] = "danger";
        $_SESSION['msgResult'] = "Rekod gagal dimasukkan, sila cuba sekali lagi";
    }
    header("Location: $curURL");
    exit;
}
$qBase = "SELECT * FROM accountsCategory WHERE id_masjid = $id_masjid AND categoryType IN (1, 2) AND typeModule = $training";
selValueSQL($qBase, 'listAkaun');
selValueSQL($qBase, 'listAkaun2');
?>