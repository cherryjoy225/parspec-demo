<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = new mysqli(
    getenv("DB_HOST"),
    getenv("DB_USER"),
    getenv("DB_PASS"),
    getenv("DB_NAME")
);

$message = "";

if ($_POST) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if ($row['username'] == 'admin') {
            $_SESSION['role'] = 'admin';
        } else {
            $_SESSION['role'] = 'user';
        }

        header("Location: dashboard.php");
        exit;
    } else {
        $message = "Login Failed";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Parspec Demo Lab</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; text-align: center; }
        .box { margin-top: 100px; padding: 25px; background: white; display: inline-block; border-radius: 10px; }
        input { padding: 10px; margin: 10px; width: 220px; }
        button { padding: 10px 20px; background: #007bff; color: white; border: none; }
    </style>
</head>
<body>

<div class="box">
    <h2>Parspec Demo Lab</h2>

    <form method="POST">
        <input type="text" name="username" placeholder="Username"><br>
        <input type="password" name="password" placeholder="Password"><br>
        <button type="submit">Login</button>
    </form>

    <p><?php echo $message; ?></p>

    <hr>

    <p><b>Test User:</b></p>
    <p>Username: user1</p>
    <p>Password: normal_user_123@#</p>
</div>

</body>
</html>
