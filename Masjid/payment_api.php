<?php
//$toiyyib_api = '0xv0c1yb-yv9x-u8oy-ggca-de8sp0qiwnbf';
$toiyyib_api = 'lkkd8asu-ogca-gzvt-bzds-xh5vwmlc2ia8';

function buatBill($a, $b, $c, $d, $e, $f, $g, $h) {
    global $toiyyib_api;
    $billCents = $d * 100;
    $some_data = array(
        'userSecretKey'=>$toiyyib_api,
        'categoryCode'=>$a,
        'billName'=>$b,
        'billDescription'=>$c,
        'billPriceSetting'=>1,
        'billPayorInfo'=>1,
        'billAmount'=>$billCents,
        'billReturnUrl'=>'https://masjidpro.com/Masjid/SPMD/detail_bantuan.php?mode=1',
        'billCallbackUrl'=>'https://masjidpro.com/Masjid/SPMD/detail_bantuan.php?mode=2',
        'billExternalReferenceNo'=>$e,
        'billTo'=>$f,
        'billEmail'=>$g,
        'billPhone'=>$h,
        'billSplitPayment'=>0,
        'billSplitPaymentArgs'=>'',
        'billPaymentChannel'=>'0',
        'billDisplayMerchant'=>1,
        'billContentEmail'=>'Terima kasih atas sumbangan ikhlas anda!',
        'billChargeToCustomer'=>1
    );

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_URL, 'https://toyyibpay.com/index.php/api/createBill');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $some_data);

    $result = curl_exec($curl);
    $info = curl_getinfo($curl);
    curl_close($curl);
    $obj = json_decode($result, true);
    return $obj;
    //return $result;
}

function buatBill2($a, $b, $c, $d, $e, $f, $g, $h) {
    global $toiyyib_api;
    $billCents = $d * 100;
    $some_data = array(
        'userSecretKey'=>$toiyyib_api,
        'categoryCode'=>$a,
        'billName'=>$b,
        'billDescription'=>$c,
        'billPriceSetting'=>1,
        'billPayorInfo'=>1,
        'billAmount'=>$billCents,
        'billReturnUrl'=>'https://masjidpro.com/Masjid/SPMD/detail_bantuan.php?mode=1',
        'billCallbackUrl'=>'https://masjidpro.com/Masjid/SPMD/detail_bantuan.php?mode=2',
        'billExternalReferenceNo'=>$e,
        'billTo'=>$f,
        'billEmail'=>$g,
        'billPhone'=>$h,
        'billSplitPayment'=>0,
        'billSplitPaymentArgs'=>'',
        'billPaymentChannel'=>'0',
        'billDisplayMerchant'=>1,
        'billContentEmail'=>'Terima kasih atas sumbangan ikhlas anda!',
        'billChargeToCustomer'=>1
    );

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_URL, 'https://toyyibpay.com/index.php/api/createBill');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $some_data);

    $result = curl_exec($curl);
    $info = curl_getinfo($curl);
    curl_close($curl);
    $obj = json_decode($result, true);
    return $obj;
    //return $result;
}

function semakBill($a) {
    global $toiyyib_api;

    $some_data = array(
        'billCode' => $a
    );

    $curl = curl_init();

    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_URL, 'https://toyyibpay.com/index.php/api/getBillTransactions');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $some_data);

    $result = curl_exec($curl);
    $info = curl_getinfo($curl);
    curl_close($curl);

    echo $result;
}

function autoBill($a) {
    global $toiyyib_api;
//    $some_data = array(
//        'userSecretKey' => $toiyyib_api,
//        'billCode' => $a
//        //'billpaymentAmount' => '2.00',
//        //'billpaymentPayorName' => 'Sumayyah',
//        //'billpaymentPayorPhone'=>'60197789876',
//        //'billpaymentPayorEmail'=>'sumayyah@gmail.com',
//        //'billBankID' => $b
//    );

//    $url = "https://toyyibpay.com/index.php/api/runBill";
//
//    $curl = curl_init($url);
//    curl_setopt($curl, CURLOPT_URL, $url);
//    curl_setopt($curl, CURLOPT_POST, true);
//    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//
//    $headers = array(
//        "Content-Type: application/x-www-form-urlencoded",
//    );
//    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
//
//    $data = "userSecretKey=$toiyyib_api&billCode=$a";
//
//    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

//for debug only!
//    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
//    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

//    $resp = curl_exec($curl);
//    curl_close($curl);
//    var_dump($resp);

//    $curl = curl_init();
//    curl_setopt($curl, CURLOPT_POST, 1);
//    curl_setopt($curl, CURLOPT_URL, 'https://toyyibpay.com/index.php/api/runBill');
//    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//    curl_setopt($curl, CURLOPT_POSTFIELDS, $some_data);

//    $result = curl_exec($curl);
//    $info = curl_getinfo($curl);
//    curl_close($curl);
//    $obj = json_decode($result);
    $result = file_get_contents("https://toyyibpay.com/$a");
    $result = str_replace('Myrich Dynasty Networks Sdn Bhd', 'MasjidPro', $result);
    $result = str_replace('Amount', 'Amaun', $result);
    $result = str_replace('Bill Code', 'Kod Bil', $result);
    $result = str_replace('Please refer to reference no for any inquiries', 'Sila lihat nombor rujukan untuk sebarang pertanyaan', $result);
    $result = str_replace('Ref. No', 'No Rujukan', $result);
    $result = str_replace('Bill Name', 'Nama Bil', $result);
    $result = str_replace('Description', 'Butiran', $result);
    $result = str_replace('<strong>Name</strong>', '<strong>Nama</strong>', $result);
    $result = str_replace('<strong>Email</strong>', '<strong>E-Mel</strong>', $result);
    $result = str_replace('<strong>Phone</strong>', '<strong>No Tel</strong>', $result);
    $result = str_replace('By clicking on the <b>“Proceed”</b> button, you agree to', 'Dengan menekan butang <b>“Teruskan”</b>, anda telah bersetuju untuk', $result);
    $result = str_replace('FPX’s Terms & Conditions', 'Terma dan Syarat FPX', $result);
    $result = str_replace('click here', 'klik sini', $result);
    $result = str_replace('Online Banking', 'Sila pastikan maklumat dibawah adalah tepat sebelum meneruskan pembayaran', $result);
    $result = str_replace('Proceed</button>', 'Teruskan</button>', $result);
    $result = str_replace('Please disable your pop-up blocker. For more information, please', 'Sila matikan "pop-up blocker". Untuk maklumat lanjut, sila', $result);
    $result = str_replace('Please do not click on browser\'s back button, refresh or close this page.', 'Jangan klik butang "back" pada peranti anda, atau menutup halaman ini.', $result);
    $result = str_replace('Minimum Transaction is RM1 and Maximum Transaction is RM30,000.', 'Transaksi Minima ialah RM10 dan Transaksi Maksima ialah RM30,000.', $result);
    $result = str_replace('https://toyyibpay.com/asset/img/seo/tpp.png', 'https://masjidpro.com/Masjid/images/logo_mobile.gif', $result);

    echo $result;
}

function buatKategori($a, $b) {
    global $toiyyib_api;
    $some_data = array(
        'catname' => $a,
        'catdescription' => $b,
        'userSecretKey' => $toiyyib_api
    );

    $curl = curl_init();

    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_URL, 'https://toyyibpay.com/index.php/api/createCategory');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $some_data);

    $result = curl_exec($curl);

    $info = curl_getinfo($curl);
    curl_close($curl);

    $obj = json_decode($result);
    return $obj;
}

function semakKategori($a) {
    global $toiyyib_api;
    $some_data = array(
        'userSecretKey' => $toiyyib_api,
        'categoryCode' => $a
    );

  $curl = curl_init();

  curl_setopt($curl, CURLOPT_POST, 1);
  curl_setopt($curl, CURLOPT_URL, 'https://toyyibpay.com/index.php/api/getCategoryDetails');
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $some_data);

  $result = curl_exec($curl);

  $info = curl_getinfo($curl);
  curl_close($curl);

  $obj = json_decode($result);
    //foreach($obj as $key => $val) {
        //echo($key.' : '.$val .'<br>');
    //}
    return $obj;
  }

  if($_GET['bayarTerus'] == 1 && $_GET['billCode'] != NULL) autoBill($_GET['billCode']);
  else if($_GET['bayarTerus'] == 2 && $_GET['billCode'] != NULL) semakBill($_GET['billCode']);
  else if($bayarTerus == 0) echo '';
  else header("Location: https://masjidpro.com");
?>
