<?php
include "db.php";
$id = $_GET['id'];
$data = $conn->query("SELECT * FROM pds_submissions WHERE id=$id")->fetch_assoc();
?>

<h1>ALPHATECH DEVELOPMENT CORPORATION</h1>
<h3>PERSONAL DATA SHEET</h3>

<p><b>Name:</b> <?= $data['first_name']." ".$data['last_name']; ?></p>
<p><b>SSS:</b> <?= $data['sss_no']; ?></p>
<p><b>TIN:</b> <?= $data['tin']; ?></p>
<p><b>PhilHealth:</b> <?= $data['philhealth']; ?></p>
<p><b>Pag-IBIG:</b> <?= $data['pagibig']; ?></p>


