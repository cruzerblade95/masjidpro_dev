<?php
if($tengoklah == 1) {
    $to = $row_infoKariah['emel'];
    $subject = "[MasjidPro :: E-Mel Automatik - Tidak Perlu Reply] Permintaan untuk Reset Kata Laluan";

    $id_data_reset = $row_infoKariah['id_data'];
    $code = base64_encode(bin2hex($id_data_reset.'-'.$meja.'-'.rand()));

    $message = '
<html>
<head>
<title>MasjidPro :: Permintaan untuk Reset Kata Laluan</title>
</head>
<body>
<div align="center"><img style="height: auto; max-width: 250px" src="https://masjidpro.com/reset/logo.gif"></div>
<hr />
<h3>Permintaan untuk reset kata laluan</h3>
<p>Anda telah meminta untuk reset kata laluan, sila tekan pautan (link) di bawah untuk menetapkan kata laluan yang baharu.</p>
<p>Pautan (link) di bawah hanya sah untuk tempoh 48 jam sahaja.</p>
<p>Sekiranya anda tidak membuat permintaan ini, sila abaikan e-mel ini.</p>
<p style="font-weight: bold">Ini ialah e-mel yang dijanakan automatik, tidak perlu membalas (reply) e-mel ini.</p>
<hr />
<a target="_blank" href="https://masjidpro.com/reset?code='.$code.'">https://masjidpro.com/reset?code='.$code.'</a>
<hr />
</body>
</html>
';

// Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
    $headers .= 'From: <auto-reply@masjidpro.com>' . "\r\n";

    if(mail($to, $subject, $message, $headers)) {
        $berjaya = 1;
        selValueSQL("SHOW KEYS FROM $meja WHERE Key_name = 'PRIMARY'", "keyKariah");
        $col_key = $row_keyKariah['Column_name'];
        $q_reset = "UPDATE $meja SET kod_reset = '$code', reset_tamat = DATE_ADD(NOW(), INTERVAL 2 DAY) WHERE $col_key = $id_data_reset";
        //echo($q_reset);
        cudSQL($q_reset, "resetPass");
    }
    else $berjaya = 0;
}
else header("Location: https://masjidpro.com");
?>