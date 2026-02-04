<?php
header('Content-Type: application/json');

$conn = new mysqli("localhost", "root", "", "pds_system");
if ($conn->connect_error) {
    echo json_encode([]);
    exit;
}

$sql = "SELECT * FROM pds_submissions ORDER BY submission_date DESC";
$result = $conn->query($sql);

$submissions = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $submissions[] = $row;
    }
}

echo json_encode($submissions);
$conn->close();
