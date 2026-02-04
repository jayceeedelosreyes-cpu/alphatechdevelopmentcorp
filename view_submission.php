<?php
session_start();
if(!isset($_SESSION['admin_id'])){
    exit("Unauthorized");
}

if(!isset($_GET['id'])) exit("Invalid ID");

$id = (int)$_GET['id'];
$conn = new mysqli("localhost", "root", "", "pds_system");
if ($conn->connect_error) die("DB Connection failed");

$stmt = $conn->prepare("SELECT * FROM pds_submissions WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if(!$row) exit("Submission not found");

echo "<h2>Submission ID: {$row['id']}</h2>";
echo "<p><strong>Name:</strong> ".htmlspecialchars($row['last_name'].', '.$row['first_name'].' '.$row['middle_name'])."</p>";
echo "<p><strong>Email:</strong> ".htmlspecialchars($row['email'])."</p>";
echo "<p><strong>Age:</strong> {$row['age']}</p>";
echo "<p><strong>Sex:</strong> {$row['sex']}</p>";
echo "<p><strong>Address:</strong> ".htmlspecialchars($row['present_address'])."</p>";
echo "<p><strong>Permanent Address:</strong> ".htmlspecialchars($row['permanent_address'])."</p>";
echo "<p><strong>Telephone:</strong> {$row['telephone']}</p>";
echo "<p><strong>Cellphone:</strong> {$row['cellphone']}</p>";
echo "<p><strong>Submission Date:</strong> {$row['submission_date']}</p>";
// Add all other fields as needed
echo "<p><strong>Special Conditions:</strong> {$row['special_condition']} - {$row['special_condition_details']}</p>";
echo "<p><strong>Past Illness:</strong> {$row['past_illness']} - {$row['past_illness_details']}</p>";
echo "<p><strong>Medical Conditions:</strong> Allergic: {$row['allergic']}, Cardio: {$row['cardio']}, Pulmonary: {$row['pulmonary']}, Gastro: {$row['gastro']}, Musculo: {$row['musculo']}, Vision: {$row['vision']}, None: {$row['none_condition']}</p>";
echo "<p><strong>Employment History:</strong> Employer1: {$row['employer1']} - Position: {$row['position1']} - Dates: {$row['dates1']}</p>";
echo "<p><strong>Employer2:</strong> {$row['employer2']} - Position: {$row['position2']} - Dates: {$row['dates2']}</p>";
echo "<p><strong>Signature:</strong> {$row['signature']}</p>";

$stmt->close();
$conn->close();
?>
