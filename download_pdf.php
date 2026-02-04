<?php
require 'vendor/autoload.php';
include 'db.php';

use Dompdf\Dompdf;

$id = $_GET['id'];
$data = $conn->query("SELECT * FROM pds_submissions WHERE id=$id")->fetch_assoc();

$html = '
<style>
@page { margin: 20px; }
.no-print { display: none; }
</style>

<h1 style="text-align:center;">ALPHATECH DEVELOPMENT CORPORATION</h1>
<h3 style="text-align:center;">PERSONAL DATA SHEET</h3>

<p><b>Name:</b> '.$data['first_name'].' '.$data['last_name'].'</p>
<p><b>SSS:</b> '.$data['sss_no'].'</p>
';

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper("A4", "portrait");
$dompdf->render();
$dompdf->stream("PDS_".$data['last_name'].".pdf", ["Attachment" => true]);
