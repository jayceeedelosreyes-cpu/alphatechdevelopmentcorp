<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 1️⃣ Connect to database
$conn = new mysqli("localhost", "root", "", "pds_system");
if ($conn->connect_error) {
    die("DB Connection failed: " . $conn->connect_error);
}

// 2️⃣ Checkbox handling
$allergic       = isset($_POST['allergic']) ? 1 : 0;
$cardio         = isset($_POST['cardio']) ? 1 : 0;
$pulmonary      = isset($_POST['pulmonary']) ? 1 : 0;
$gastro         = isset($_POST['gastro']) ? 1 : 0;
$musculo        = isset($_POST['musculo']) ? 1 : 0;
$vision         = isset($_POST['vision']) ? 1 : 0;
$none_condition = isset($_POST['none']) ? 1 : 0;

// 3️⃣ Assign POST values to variables with fallback for submission_date
$last_name  = $_POST['last_name'] ?? '';
$first_name = $_POST['first_name'] ?? '';
$middle_name = $_POST['middle_name'] ?? '';
$maiden_name = $_POST['maiden_name'] ?? '';
$present_address = $_POST['present_address'] ?? '';
$permanent_address = $_POST['permanent_address'] ?? '';
$telephone = $_POST['telephone'] ?? '';
$cellphone = $_POST['cellphone'] ?? '';
$age = isset($_POST['age']) ? (int)$_POST['age'] : 0;
$height = $_POST['height'] ?? '';
$weight = $_POST['weight'] ?? '';
$birthdate = $_POST['birthdate'] ?? null;
$birthplace = $_POST['birthplace'] ?? '';
$sex = $_POST['sex'] ?? '';
$civil_status = $_POST['civil_status'] ?? '';
$citizenship = $_POST['citizenship'] ?? '';
$religion = $_POST['religion'] ?? '';
$email = $_POST['email'] ?? '';
$sss_no = $_POST['sss_no'] ?? '';
$tin = $_POST['tin'] ?? '';
$philhealth = $_POST['philhealth'] ?? '';
$pagibig = $_POST['pagibig'] ?? '';
$father_name = $_POST['father_name'] ?? '';
$father_occupation = $_POST['father_occupation'] ?? '';
$mother_name = $_POST['mother_name'] ?? '';
$mother_occupation = $_POST['mother_occupation'] ?? '';
$spouse_name = $_POST['spouse_name'] ?? '';
$spouse_occupation = $_POST['spouse_occupation'] ?? '';
$elementary_school = $_POST['elementary_school'] ?? '';
$elementary_dates = $_POST['elementary_dates'] ?? '';
$elementary_honors = $_POST['elementary_honors'] ?? '';
$secondary_school = $_POST['secondary_school'] ?? '';
$secondary_dates = $_POST['secondary_dates'] ?? '';
$secondary_honors = $_POST['secondary_honors'] ?? '';
$tertiary_school = $_POST['tertiary_school'] ?? '';
$tertiary_dates = $_POST['tertiary_dates'] ?? '';
$tertiary_honors = $_POST['tertiary_honors'] ?? '';
$employer1 = $_POST['employer1'] ?? '';
$position1 = $_POST['position1'] ?? '';
$dates1 = $_POST['dates1'] ?? '';
$salary1 = $_POST['salary1'] ?? '';
$reason1 = $_POST['reason1'] ?? '';
$employer2 = $_POST['employer2'] ?? '';
$position2 = $_POST['position2'] ?? '';
$dates2 = $_POST['dates2'] ?? '';
$salary2 = $_POST['salary2'] ?? '';
$reason2 = $_POST['reason2'] ?? '';
$special_condition = $_POST['special_condition'] ?? '';
$special_condition_details = $_POST['special_condition_details'] ?? '';
$past_illness = $_POST['past_illness'] ?? '';
$past_illness_details = $_POST['past_illness_details'] ?? '';
$medical_details = $_POST['medical_details'] ?? '';
$submission_date = $_POST['submission_date'] ?? date('Y-m-d'); // fallback to today
$signature = $_POST['signature'] ?? '';

// 4️⃣ Prepare SQL
$sql = $conn->prepare("
INSERT INTO pds_submissions (
    last_name, first_name, middle_name, maiden_name,
    present_address, permanent_address, telephone, cellphone,
    age, height, weight, birthdate, birthplace, sex, civil_status,
    citizenship, religion, email,
    sss_no, tin, philhealth, pagibig,
    father_name, father_occupation,
    mother_name, mother_occupation,
    spouse_name, spouse_occupation,
    elementary_school, elementary_dates, elementary_honors,
    secondary_school, secondary_dates, secondary_honors,
    tertiary_school, tertiary_dates, tertiary_honors,
    employer1, position1, dates1, salary1, reason1,
    employer2, position2, dates2, salary2, reason2,
    special_condition, special_condition_details,
    past_illness, past_illness_details,
    allergic, cardio, pulmonary, gastro, musculo, vision, none_condition,
    medical_details, submission_date, signature
) VALUES (
    ?,?,?,?,?,?,?,?,
    ?,?,?,?,?,
    ?,?,?,?,?,?,
    ?,?,?,?,?,
    ?,?,
    ?,?,
    ?,?,
    ?,?,?,
    ?,?,?,
    ?,?,?,?,?,
    ?,?,?,?,?,
    ?,?,
    ?,?,
    ?,?,?,?,?,?,?,?,
    ?,?,?
)
");

// 5️⃣ Check prepare
if (!$sql) {
    die("PREPARE ERROR: " . $conn->error);
}

// 6️⃣ Bind parameters
$sql->bind_param(
    "ssssssssissssssssssssssssssssssssssssssssssssssssssiiiiiiisss",
    $last_name,
    $first_name,
    $middle_name,
    $maiden_name,
    $present_address,
    $permanent_address,
    $telephone,
    $cellphone,
    $age,
    $height,
    $weight,
    $birthdate,
    $birthplace,
    $sex,
    $civil_status,
    $citizenship,
    $religion,
    $email,
    $sss_no,
    $tin,
    $philhealth,
    $pagibig,
    $father_name,
    $father_occupation,
    $mother_name,
    $mother_occupation,
    $spouse_name,
    $spouse_occupation,
    $elementary_school,
    $elementary_dates,
    $elementary_honors,
    $secondary_school,
    $secondary_dates,
    $secondary_honors,
    $tertiary_school,
    $tertiary_dates,
    $tertiary_honors,
    $employer1,
    $position1,
    $dates1,
    $salary1,
    $reason1,
    $employer2,
    $position2,
    $dates2,
    $salary2,
    $reason2,
    $special_condition,
    $special_condition_details,
    $past_illness,
    $past_illness_details,
    $allergic,
    $cardio,
    $pulmonary,
    $gastro,
    $musculo,
    $vision,
    $none_condition,
    $medical_details,
    $submission_date,
    $signature
);

// 7️⃣ Execute
if ($sql->execute()) {
    // Redirect to success page
    header("Location: pds_success.php");
    exit;
} else {
    echo "<h3 style='color:red'>❌ EXECUTE ERROR:</h3> " . $sql->error;
}


// 8️⃣ Close connections
$sql->close();
$conn->close();
?>
