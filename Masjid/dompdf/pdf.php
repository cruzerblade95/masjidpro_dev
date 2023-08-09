<?php

use Dompdf\Dompdf;
require 'vendor/autoload.php';

$html = 'TESTING';

$codeHTML = utf8_encode($html);
$dompdf = new Dompdf();
$dompdf->loadHtml($codeHTML);
$dompdf->setPaper('A4','landscape');
$dompdf->set_option('defaultFont','Courier');

ini_set('memory_limit','128M');
$dompdf->render();
$dompdf->stream('Minit.pdf');
?>