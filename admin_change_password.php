<?php
session_start();
header('Content-Type: application/json');

// Check if admin is logged in
if(!isset($_SESSION['admin'])){
    echo json_encode(['success'=>false, 'message'=>'Not authorized']);
    exit;
}

// Get JSON input
$data = json_decode(file_get_contents('php://input'), true);
$current = trim($data['current_password'] ?? '');
$new = trim($data['new_password'] ?? '');

if(empty($current) || empty($new)){
    echo json_encode(['success'=>false, 'message'=>'All fields are required']);
    exit;
}

$conn = new mysqli("localhost", "root", "", "pds_system");
if($conn->connect_error){
    echo json_encode(['success'=>false, 'message'=>'Database connection error']);
    exit;
}

// Get current password from DB
$stmt = $conn->prepare("SELECT password FROM admin WHERE id=?");
$stmt->bind_param("i", $_SESSION['admin']);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows !== 1){
    echo json_encode(['success'=>false, 'message'=>'Admin not found']);
    exit;
}

$row = $result->fetch_assoc();

// Check current password
if(!password_verify($current, $row['password'])){
    echo json_encode(['success'=>false, 'message'=>'Current password is incorrect']);
    exit;
}

// Hash new password
$hashed = password_hash($new, PASSWORD_DEFAULT);

// Update password in DB
$update = $conn->prepare("UPDATE admin SET password=? WHERE id=?");
$update->bind_param("si", $hashed, $_SESSION['admin']);

if($update->execute()){
    echo json_encode(['success'=>true, 'message'=>'Password changed successfully']);
}else{
    echo json_encode(['success'=>false, 'message'=>'Failed to update password']);
}

$stmt->close();
$update->close();
$conn->close();
?>
