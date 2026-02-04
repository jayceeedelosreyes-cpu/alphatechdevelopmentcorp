<?php
session_start();
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['admin'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

$conn = new mysqli("localhost", "root", "", "pds_system");
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'DB error']);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);
$current = trim($data['current_password'] ?? '');
$new     = trim($data['new_password'] ?? '');

if ($current === '' || $new === '') {
    echo json_encode(['success' => false, 'message' => 'Missing fields']);
    exit;
}

$admin_id = $_SESSION['admin'];

$stmt = $conn->prepare("SELECT password FROM admin WHERE id=?");
$stmt->bind_param("i", $admin_id);
$stmt->execute();
$res = $stmt->get_result();
$row = $res->fetch_assoc();

if (!password_verify($current, $row['password'])) {
    echo json_encode(['success' => false, 'message' => 'Wrong password']);
    exit;
}

$new_hash = password_hash($new, PASSWORD_DEFAULT);

$up = $conn->prepare("UPDATE admin SET password=? WHERE id=?");
$up->bind_param("si", $new_hash, $admin_id);
$up->execute();

echo json_encode(['success' => true]);
