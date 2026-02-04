<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$conn = new mysqli("localhost", "root", "", "pds_system");
if ($conn->connect_error) {
    die("Database error: " . $conn->connect_error);
}

// Get username and password from POST
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($username) || empty($password)) {
    echo "<script>
            alert('Please enter username and password');
            window.location.href='admin_login.html';
          </script>";
    exit;
}

// Prepare statement to prevent SQL injection
$stmt = $conn->prepare("SELECT id, password FROM admin WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    
    // Check hashed password
    if (password_verify($password, $row['password'])) {
        $_SESSION['admin'] = $row['id'];
        header("Location: admin_dashboard.html"); // Redirect to admin dashboard
        exit;
    } 
    // Optional fallback for plain-text passwords (for testing)
    elseif ($password === $row['password']) {
        $_SESSION['admin'] = $row['id'];
        header("Location: admin_dashboard.html"); // Redirect
        exit;
    } 
    else {
        echo "<script>
                alert('Invalid username or password');
                window.location.href='admin_login.html';
              </script>";
    }
} else {
    echo "<script>
            alert('Invalid username or password');
            window.location.href='admin_login.html';
          </script>";
}

$stmt->close();
$conn->close();
