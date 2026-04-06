<?php
session_start();

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: page1.php");
    exit;
}

if (!isset($_SESSION['role'])) {
    header("Location: page1.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Parspec Demo Lab</title>
    <style>
        body { font-family: Arial; text-align: center; margin-top: 100px; }
        button { padding: 10px 20px; background: #dc3545; color: white; border: none; }
    </style>
</head>
<body>

<h2>Parspec Demo Lab</h2>

<?php
if ($_SESSION['role'] == 'admin') {
    echo "<h3>Logged in as ADMIN</h3>";
} else {
    echo "<h3>Logged in as NORMAL USER</h3>";
}
?>

<br><br>

<a href="dashboard.php?logout=true">
    <button>Logout</button>
</a>

</body>
</html>
