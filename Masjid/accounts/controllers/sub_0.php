<?php

if($_SERVER['REQUEST_METHOD'] != "POST") {
    if(!isset($_GET['mode'])) {
        if(isset($_GET['training'])) $ada_train = "&training=".$_GET['training'];
        header("Location: utama.php?view=admin&action=kewangan&newModul=1$ada_train&subModul=0&mode=1");
        exit;
    }
}
if($_SERVER['REQUEST_METHOD'] == "POST") {

    $it = 0;
    foreach($_POST['amount'] as $kira2){
        if($kira2 > 0){
            $it++;
        }
    }

    
    // exit;

    $id_masjid = $_SESSION['id_masjid'];
    $user_id = $_SESSION['user_id'];
    if($_GET['mode'] == 1) {
        
        $typeJournalEntry = 2;
        $colNumbering = "receivedNo";
    }
    if($_GET['mode'] == 2) {
        $typeJournalEntry = 1;
        $colNumbering = "payNo";
    }
    $sqlNumbering = "SELECT IFNULL(MAX($colNumbering), 0) + 1 AS numbering FROM accountsRecords WHERE typeModule = $training AND typeRecords = 1 AND id_masjid = $id_masjid";
    $sqlNumbering2 = mysqli_query($bd2, $sqlNumbering);
    $row_numbering = mysqli_fetch_assoc($sqlNumbering2);
    $autoNumbering = $row_numbering['numbering'];

    if($it > 1){
        $jenis_transaksi = 1;
        $inBatch = 1;
    }else{
        $jenis_transaksi = NULL;
    }

    if($_POST['assetType'] == "6"){
        $hasSiBerhutang = 1;
        if($typeJournalEntry == 1){
            $typeJournalEntrys = 2;
        }else{
            $typeJournalEntrys = 1;
        }
    }else{
        $typeJournalEntrys = $typeJournalEntry;
        $hasSiBerhutang = 0;
    }


    // echo var_dump($_POST);
    // exit;

        if($_POST['accountsCategory_id_tunai']){

            $accountsCategory_id = e($_POST['accountsCategory_id_tunai'], NULL, NULL);
            $amount = $_POST['amount'][0];
            $chequeNo = $_POST['chequeNo'][0];
            if($amount > 0 && $accountsCategory_id != NULL) {
                $q = "INSERT INTO accountsRecords ($colNumbering, id_masjid, hasSiBerhutang, accountsCategory_id, pairAccountsCategory_id, inBatch, amount, jenis_transaksi, chequeNo, vendor, particulars, updatedBy, dateRecords, typeJournalEntry, typeRecords, typeModule)
        VALUES ('$autoNumbering', $id_masjid, '$hasSiBerhutang', $accountsCategory_id, $pairAccountsCategory_id, '$inBatch', '$amount', '$jenis_transaksi', '$chequeNo', '$vendor', '$particulars', $user_id, '$dateRecords', $typeJournalEntry, 1, $training)";
                $q2 = "INSERT INTO accountsRecords ($colNumbering, id_masjid, kiraan, accountsCategory_id, pairAccountsCategory_id, inBatch, amount, jenis_transaksi, chequeNo, vendor, particulars, updatedBy, dateRecords, typeJournalEntry, typeRecords, typeModule)
        VALUES ('$autoNumbering', $id_masjid, 1, $pairAccountsCategory_id, $accountsCategory_id, '$inBatch', '$amount', '$jenis_transaksi', '$chequeNo', '$vendor', '$particulars', $user_id, '$dateRecords', $typeJournalEntrys, 1, $training)";
            // echo($q.'<br />');
                $inputRekod = mysqli_query($bd2, $q);
                $inputRekod2 = mysqli_query($bd2, $q2);
                // echo $q;
                // echo mysqli_error($bd2);
                // exit;
                if(!$inputRekod) $berjaya = 0;
                else $berjaya = 1;
            }

        }
        if($_POST['accountsCategory_id_bank']){

            $accountsCategory_id = e($_POST['accountsCategory_id_bank'], NULL, NULL);
            $amount1 = $_POST['amount'][1];
            $chequeNo1 = $_POST['chequeNo'][1];
            if($amount1 > 0 && $accountsCategory_id != NULL) {
                $q = "INSERT INTO accountsRecords ($colNumbering, id_masjid, hasSiBerhutang, accountsCategory_id, pairAccountsCategory_id, inBatch, amount, jenis_transaksi, chequeNo, vendor, particulars, updatedBy, dateRecords, typeJournalEntry, typeRecords, typeModule)
        VALUES ('$autoNumbering', $id_masjid, '$hasSiBerhutang', $accountsCategory_id, $pairAccountsCategory_id, '$inBatch', '$amount1', '$jenis_transaksi', '$chequeNo1', '$vendor', '$particulars', $user_id, '$dateRecords', $typeJournalEntry, 1, $training)";
                $q2 = "INSERT INTO accountsRecords ($colNumbering, id_masjid, kiraan, accountsCategory_id, pairAccountsCategory_id, inBatch, amount, jenis_transaksi, chequeNo, vendor, particulars, updatedBy, dateRecords, typeJournalEntry, typeRecords, typeModule)
        VALUES ('$autoNumbering', $id_masjid, 1, $pairAccountsCategory_id, $accountsCategory_id, '$inBatch', '$amount1', '$jenis_transaksi', '$chequeNo1', '$vendor', '$particulars', $user_id, '$dateRecords', $typeJournalEntrys, 1, $training)";
            //echo($q.'<br />');
                $inputRekod = mysqli_query($bd2, $q);
                $inputRekod2 = mysqli_query($bd2, $q2);
                // echo $q;
                // echo mysqli_error($bd2);
                // exit;
                if(!$inputRekod) $berjaya = 0;
                else $berjaya = 1;
            }

        }
        if($_POST['accountsCategory_id_hutang']){

            $accountsCategory_id = e($_POST['accountsCategory_id_hutang'], NULL, NULL);
            // $typeJournalEntry = 1;
            $amount2 = $_POST['amount'][2];
            $chequeNo2 = $_POST['chequeNo'][2];
            
            if($amount2 > 0 && $accountsCategory_id != NULL) {
                $q = "INSERT INTO accountsRecords ($colNumbering, id_masjid, hasSiBerhutang, accountsCategory_id, pairAccountsCategory_id, inBatch, amount, jenis_transaksi, chequeNo, vendor, particulars, updatedBy, dateRecords, typeJournalEntry, typeRecords, typeModule)
        VALUES ('$autoNumbering', $id_masjid, '$hasSiBerhutang', $accountsCategory_id, $pairAccountsCategory_id, '$inBatch', '$amount2', '$jenis_transaksi', '$chequeNo2', '$vendor', '$particulars', $user_id, '$dateRecords', $typeJournalEntry, 1, $training)";
                $q2 = "INSERT INTO accountsRecords ($colNumbering, id_masjid, kiraan, accountsCategory_id, pairAccountsCategory_id, inBatch, amount, jenis_transaksi, chequeNo, vendor, particulars, updatedBy, dateRecords, typeJournalEntry, typeRecords, typeModule)
        VALUES ('$autoNumbering', $id_masjid, 1, $pairAccountsCategory_id, $accountsCategory_id, '$inBatch', '$amount2', '$jenis_transaksi', '$chequeNo2', '$vendor', '$particulars', $user_id, '$dateRecords', $typeJournalEntrys, 1, $training)";
            //echo($q.'<br />');
                $inputRekod = mysqli_query($bd2, $q);
                $inputRekod2 = mysqli_query($bd2, $q2);
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
    // header("Location: $curURL");
    // exit;
}

$qBase = "SELECT id, categoryName, assetType FROM accountsCategory WHERE id_masjid = $id_masjid AND typeModule = $training AND ";
$qTunai = "$qBase assetType = 1";
$qBank = "$qBase assetType = 2";
if($_GET['mode'] == 1) $qHutang = "$qBase assetType = 6";
if($_GET['mode'] == 2) $qHutang = "$qBase assetType = 7";
$qLiabiliti = "$qBase (categoryType = 2 OR assetType = 6)";
selValueSQL($qTunai, 'tunai');
selValueSQL($qBank, 'bank');
selValueSQL($qHutang, 'hutang');
selValueSQL($qLiabiliti, 'liabiliti');
?>