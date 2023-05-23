<?php
if($_SERVER['REQUEST_METHOD'] != "POST") {
    if(!isset($_GET['mode'])) {
        if(isset($_GET['training'])) $ada_train = "&training=".$_GET['training'];
        header("Location: utama.php?view=admin&action=kewangan&newModul=1$ada_train&subModul=0&mode=1");
        exit;
    }
}
if($_SERVER['REQUEST_METHOD'] == "POST") {
    $id_masjid = $_SESSION['id_masjid'];
    $user_id = $_SESSION['user_id'];
    if($_GET['mode'] == 1) {
        $typeJournalEntry = 1;
        $colNumbering = "receivedNo";
    }
    if($_GET['mode'] == 2) {
        $typeJournalEntry = 2;
        $colNumbering = "payNo";
    }
    $sqlNumbering = "SELECT IFNULL(MAX($colNumbering), 0) + 1 AS numbering FROM accountsRecords WHERE typeModule = $training AND typeRecords = 1 AND id_masjid = $id_masjid";
    $sqlNumbering2 = mysqli_query($bd2, $sqlNumbering);
    $row_numbering = mysqli_fetch_assoc($sqlNumbering2);
    $autoNumbering = $row_numbering['numbering'];

    for($u = 0; $u < count($_POST['accountsCategory_id']); $u++) {
        $accountsCategory_id = e($_POST['accountsCategory_id'][$u], NULL, NULL);
        $amount = e($_POST['amount'][$u], NULL, NULL);
        $chequeNo = e($_POST['chequeNo'][$u], NULL, NULL);
        if($amount > 0 && $accountsCategory_id != NULL) {
            $q = "INSERT INTO accountsRecords ($colNumbering, id_masjid, accountsCategory_id, pairAccountsCategory_id, amount, chequeNo, vendor, particulars, updatedBy, dateRecords, typeJournalEntry, typeRecords, typeModule)
VALUES ($autoNumbering, $id_masjid, $accountsCategory_id, $pairAccountsCategory_id, '$amount', '$chequeNo', '$vendor', '$particulars', $user_id, '$dateRecords', $typeJournalEntry, 1, $training)";
        //echo($q.'<br />');
            $inputRekod = mysqli_query($bd2, $q);
            if(!$inputRekod) $berjaya = 0;
            else $berjaya = 1;
        }
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
$qBase = "SELECT id, categoryName, assetType FROM accountsCategory WHERE id_masjid = $id_masjid AND typeModule = $training AND ";
$qTunai = "$qBase assetType = 1";
$qBank = "$qBase assetType = 2";
if($_GET['mode'] == 1) $qHutang = "$qBase assetType = 6";
if($_GET['mode'] == 2) $qHutang = "$qBase assetType = 7";
$qLiabiliti = "$qBase (categoryType = 2 OR assetType = 3 OR assetType = 6)";
selValueSQL($qTunai, 'tunai');
selValueSQL($qBank, 'bank');
selValueSQL($qHutang, 'hutang');
selValueSQL($qLiabiliti, 'liabiliti');
?>