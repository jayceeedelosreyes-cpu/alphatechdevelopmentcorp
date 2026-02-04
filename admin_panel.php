<?php
session_start();

$admin_user = "admin";
$admin_pass = "1234";

if($_SERVER['REQUEST_METHOD']=="POST"){
    if($_POST['username']==$admin_user && $_POST['password']==$admin_pass){
        $_SESSION['admin'] = true;
    } else {
        die("Invalid credentials");
    }
}

if(!isset($_SESSION['admin'])){
    header("Location: admin_login.html");
    exit;
}


$applicants = [
    ["id"=>1,"name"=>"Juan Dela Cruz","date"=>"2026-01-29"],
    ["id"=>2,"name"=>"Maria Santos","date"=>"2026-01-28"]
];

$selected = $_GET['applicant_id'] ?? null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Panel</title>
<style>
body{font-family:Arial;padding:20px}
select{padding:6px;margin-bottom:20px}
table{border-collapse:collapse;width:100%}
td,th{border:1px solid #000;padding:6px}
</style>
</head>
<body>

<h2>Admin Panel</h2>
<form method="GET">
<select name="applicant_id" onchange="this.form.submit()">
<option value="">-- Select Applicant --</option>
<?php foreach($applicants as $a): ?>
  <option value="<?= $a['id'] ?>" <?= ($selected==$a['id'])?'selected':'' ?>>
      <?= $a['name'] ?> (<?= $a['date'] ?>)
  </option>
<?php endforeach; ?>
</select>
</form>

<?php if($selected): ?>
<h3>Applicant Details</h3>
<table>
<tr><td>First Name</td><td>Juan</td></tr>
<tr><td>Last Name</td><td>Dela Cruz</td></tr>
<tr><td>Email</td><td>juan@example.com</td></tr>

</table>
<?php endif; ?>

</body>
</html>
