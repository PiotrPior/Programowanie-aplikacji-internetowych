<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_demo";
$isCorrect = true;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'] ?? "";
    $pass = $_POST['pass'] ?? "";
    $_SESSION['login'] = $login;
    $_SESSION['pass'] = $pass;

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT login, passwd FROM logins";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            if ($login === $row['login'] && $pass === $row['passwd']) {
                $isCorrect = true;
                header("Location: dashboard.php");
                exit;
            }
        }
        if(!$isCorrect) {
            echo "Błędny login lub hasło";
        }
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/styl1.css">
    <title>Document</title>
</head>
<body>
    <h1>LOGIN</h1>
    <form action="login.php" method="post">
        Login: <input type="text" name="login" id="login">
        <br><br>
        Password: <input type="password" name="pass" id="pass">
        <input type="submit" value="submit">
    </form>
    <a href="register.php">Register</a>
</body>
</html>