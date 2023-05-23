<?php
if($tengoklah == 1) {
    $qPay = "SELECT id_payment, billcode FROM sej6x_bayar_online WHERE (billcode != '' OR billcode != NULL) AND status_bayaran = ''";
    selValueSQL($qPay, "semakPay");

    if($num_semakPay > 0) {
        $i = 1;
        do {
            $billcode = $row_semakPay['billcode'];
            $some_data = array(
                "billCode" => "$billcode"
            );

            $curl = curl_init();

            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_URL, 'https://toyyibpay.com/index.php/api/getBillTransactions');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $some_data);

            $result2 = curl_exec($curl);
            $info = curl_getinfo($curl);
            curl_close($curl);

            $result = json_decode($result2, true);
            $s = $result[0]["billpaymentStatus"];
            //$status_bayaran = $result[0]["billpaymentStatus"];
            if($s == "1" || $s == "2" || $s == "3" || $s == "4") $status_bayaran = $s;
            else $status_bayaran = 3;
            $qUpdate = "UPDATE sej6x_bayar_online SET status_bayaran = $status_bayaran WHERE id_payment = ".$row_semakPay['id_payment'];
            //echo $result[0]["billpaymentStatus"];
            //$row_semakPay['id_payment'];
            echo($qUpdate.';<br />');
            $i++;
        } while($row_semakPay = mysqli_fetch_assoc($fetch_semakPay));
    }
}
?>