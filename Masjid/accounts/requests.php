<?php
if($_GET['data'] == "raw") {
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
}
$curURL = $_SERVER['REQUEST_URI'];
$curURL = str_replace('&subModul='.$_GET['subModul'], '', $curURL);
$curURL2 = str_replace('&training=1', '', $curURL);
$curURL2 = str_replace('&training=', '', $curURL2);
if($_GET['subModul'] != NULL) $curURL2 = "$curURL2&subModul=".$_GET['subModul'];
$listModul = array("Baucar Penerimaan", "Baucar Pembayaran", "Lain-lain Transaksi", "Rekod Transaksi Kewangan",
    "Kedudukan Kewangan", "Kedudukan Setiap Tabungan", "Laporan Kewangan",
    "Tetapan Jenis Tabung");
$tajukSubModul = $listModul[$_GET['subModul2']] != NULL ? $listModul[$_GET['subModul2']] : $listModul[$_GET['subModul']];
if($_GET['subModul'] == 0 && $_GET['mode'] == 2) $tajukSubModul = $listModul[1];

// Sekat segala akses modul akaun sekiranya baki permulaan tidak balance
$training = $_GET['training'] == 1 ? 2 : 1;
$q = "SELECT SUM(IF(a.typeJournalEntry = 1, a.amount, 0)) AS jumlahDebit, SUM(IF(a.typeJournalEntry = 2, a.amount, 0)) AS jumlahKredit
FROM accountsRecords a WHERE a.typeModule = $training AND a.typeRecords = 2 AND a.id_masjid = " . $_SESSION['id_masjid'];
//echo($q);
selValueSQL($q, "checkBalance");
//echo($row_checkBalance['jumlahDebit']. ' : '.$row_checkBalance['jumlahKredit']);
if (($row_checkBalance['jumlahDebit'] != $row_checkBalance['jumlahKredit'] || $row_checkBalance['jumlahDebit'] == NULL || $row_checkBalance['jumlahKredit'] == NULL) && $_GET['subModul'] != 7 && $_GET['subModul'] != NULL) {
    $_SESSION['msgType'] = "danger";
    $_SESSION['msgResult'] = "Baki permulaan tidak seimbang atau belum menetapkan baki permulaan, sila semak semula sebelum memasukkan rekod kewangan";
    header("Location: utama.php?view=admin&action=kewangan&newModul=1&training=".$_GET['training']."&subModul=7");
    exit;
}
if($_GET['subModul'] != 7 && $_SERVER['REQUEST_METHOD'] == "POST") {
    if ($_GET['json'] == 1) $request_body = json_decode(file_get_contents('php://input'), true);
    else $request_body = $_POST;

    foreach ($request_body as $key => $val) {
        if (!is_array($val) && $key != NULL) {
            ${$key} = e($val, NULL, NULL);
            //echo($key.' : '.${$key}.'<br />');
        }
    }
}
// Kategori akaun dalam bentuk array
$arrayAkaun = array("", "TUNAI", "BANK", "HARTA", "PELABURAN", "SIMPANAN TETAP", "SI BERHUTANG", "SI-PUITANG");
?>