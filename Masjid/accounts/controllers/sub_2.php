<?php
    function console_log($output, $with_script_tags = true) {
        $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
    ');';
        if ($with_script_tags) {
            $js_code = '<script>' . $js_code . '</script>';
        }
        echo $js_code;
    }
    
    // echo var_dump($_POST);
    // exit;
    
    
if($_SERVER['REQUEST_METHOD'] == "POST") {
    

    $id_masjid = $_SESSION['id_masjid'];
    $user_id = $_SESSION['user_id'];
    $susut_nilai = NULL;
    $pelarasan = NULL;
    $accountsCategory_id = explode("|", $accountsCategory_id)[0];

    // if($jenisTransaksi == 1) $typeRecords = 3;
    // else $typeRecords = 1;
    $sqlNumbering = "SELECT IFNULL(MAX(groupTransactionID), 0) + 1 AS numbering FROM accountsRecords WHERE typeModule = $training AND typeRecords = 3 AND id_masjid = $id_masjid";
    $sqlNumbering2 = mysqli_query($bd2, $sqlNumbering);
    // echo $sqlNumbering;
    // exit;
    $row_numbering = mysqli_fetch_assoc($sqlNumbering2);
    $autoNumbering = $row_numbering['numbering'];
    $dateRecordss = strtotime($_POST['dateRecords']);
    $dateRecordss = date('Y-m-d', $dateRecordss);
    
    $pairAccountsCategory_id = $_POST['pairAccountsCategory_id'];
    
    if($amount > 0 && $accountsCategory_id != NULL && $pairAccountsCategory_id != NULL) {

        $amount_pair = $_POST['amount_pair'];

    $i = 0;
    $it = 0;
    foreach($_POST['amount_pair'] as $kira2){
        if($kira2 > 0){
            $it++;
        }
    }

    if($it > 1){
        $jenis_transaksi = 1;
        $inBatch = 1;
    }else{
        $jenis_transaksi = NULL;
    }

    $jt = $_POST['jenisTransaksi'];
    $hasSiBerhutang = 0;

    foreach($pairAccountsCategory_id as $pairAccountsCatId){
        if($jt == "1" || $jt == "2" || $jt == "3" || $jt == "9" || $jt == "5" || $jt == "10" || $jt == "6"){
            // Pindahan antara sub akaun
            // Simpan tunai di bank
            // Keluar tunai dari bank
            // Beli saham
            // Penjualan saham
            // Beli / Tambah Simpanan Tetap
            // Pengeluaran simpanan tetap
            $typeJournalEntry = 2;

        }else if($jt == "8"){
            // Beli Harta
            $typeJournalEntry = 1;
            

            if($_POST['assetType'] == "2"){
                $hasSiBerhutang = 2;
            }
            
        }else if($jt == "4"){
            // Susut nilai / Perlupusan harta
            $susut_nilai = 1;
            $typeJournalEntry = 1;
        }
        else{

            // Pelarasan account
            if($_POST['debitKreditDropdown1'] != NULL && $_POST['debitKreditDropdown2'] != NULL){

                if($_POST['debitKreditDropdown1'] == 1 && $_POST['debitKreditDropdown2'] == 1){
                    // Debit => Debit
                    $pelarasan = 1;
                    $typeJournalEntry = 1;
                }else if($_POST['debitKreditDropdown1'] == 2 && $_POST['debitKreditDropdown2'] == 2){
                    // Kredit => Kredit
                    $pelarasan = 1;
                    $typeJournalEntry = 2;
                }else if($_POST['debitKreditDropdown1'] == 1 && $_POST['debitKreditDropdown2'] == 2){
                    // Debit => Kredit
                    $typeJournalEntry = 2;
                }else if($_POST['debitKreditDropdown1'] == 2 && $_POST['debitKreditDropdown2'] == 1){
                    // Kredit => Debit
                    $typeJournalEntry = 1;
                }

            // Pelarasan account end
            }else{
                $typeJournalEntry = "SELECT IF(categoryType IN (1, 4), 2, IF(categoryType IN (2, 3), 1, 0)) AS typeJournal FROM accountsCategory WHERE id = $accountsCategory_id";
            }
        }

        // echo $pelarasan;
        // exit;
        // console_log($pairAccountsCatId);
        $q = "INSERT INTO accountsRecords (groupTransactionID, id_masjid, hasSiBerhutang, accountsCategory_id, pairAccountsCategory_id, inBatch, amount, susut_nilai, pelarasan, jenis_transaksi, particulars, updatedBy, dateRecords, typeJournalEntry, typeRecords, typeModule)
        VALUES ('$autoNumbering', $id_masjid, $hasSiBerhutang, $pairAccountsCatId, $accountsCategory_id, '$inBatch', '$amount_pair[$i]', '$susut_nilai', '$pelarasan', '$jenis_transaksi', '$particulars', $user_id, '$dateRecordss', ($typeJournalEntry), 3, $training)";

        if($susut_nilai == NULL && $pelarasan == NULL){
            if($typeJournalEntry == 1){
                $typeJournalEntry = 2;
            }else{
                $typeJournalEntry = 1;
            }
        }

        $q2 = "INSERT INTO accountsRecords (groupTransactionID, id_masjid, hasSiBerhutang, kiraan, accountsCategory_id, pairAccountsCategory_id, inBatch, amount, susut_nilai, pelarasan, jenis_transaksi, particulars, updatedBy, dateRecords, typeJournalEntry, typeRecords, typeModule)
        VALUES ('$autoNumbering', $id_masjid, $hasSiBerhutang, 1, $accountsCategory_id, $pairAccountsCatId, '$inBatch', '$amount_pair[$i]', '$susut_nilai', '$pelarasan', '$jenis_transaksi', '$particulars', $user_id, '$dateRecordss', ($typeJournalEntry), 3, $training)";
        //echo($q.'<br />');
        $inputRekod = mysqli_query($bd2, $q);
        $inputRekod2 = mysqli_query($bd2, $q2);
         // echo mysqli_error($bd2);
        // exit;
        $i++;
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
    
    // echo $hasSiBerhutang."<br/>";
    // echo $q2."<br/>";
    // echo mysqli_error($bd2);
    // exit;
}
$qBase = "SELECT * FROM accountsCategory WHERE id_masjid = $id_masjid AND categoryType IN (1, 2) AND typeModule = $training";
selValueSQL($qBase, 'listAkaun');
selValueSQL($qBase, 'listAkaun2');
?>