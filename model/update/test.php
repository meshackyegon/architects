<?php
use Dompdf\Dompdf;
use Dompdf\Options;
require_once '../all_vendors/autoload.php';
$options = new Options();
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);
$file = file_get_contents("template.html");
$dompdf->loadHtml($file);
// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');
// Render the HTML as PDF
$dompdf->render();
$dompdf->stream();
?>