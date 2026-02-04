<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Submission Successful</title>
<style>
body {
    font-family: Arial;
    background: #f4f4f4;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.container {
    background: #fff;
    padding: 40px;
    border-radius: 8px;
    text-align: center;
    box-shadow: 0 0 10px rgba(0,0,0,0.3);
}

h2 { color: green; }

button {
    padding: 10px 20px;
    background: #333;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin-top: 20px;
}

button:hover { background: #555; }
</style>
</head>
<body>

<div class="container">
    <h2>✅ Successfully Saved!</h2>
    <p>Your Personal Data Sheet has been submitted.</p>
    <button onclick="window.location.href='user_pds.html'">Fill Another Form</button>
</div>

</body>
</html>
