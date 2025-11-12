<?php
session_start();

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "login_demo";

$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'] ?? "";
    $pass = $_POST['pass'] ?? "";
    $pass2 = $_POST['pass2'] ?? "";

    if (!empty($login) && !empty($pass) && !empty($pass2)) {
        if ($pass !== $pass2) {
            $message = "Hasła się nie zgadzają!";
        } else {
            $stmt = $conn->prepare("SELECT login FROM logins WHERE login = ?");
            $stmt->bind_param("s", $login);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                $message = "Użytkownik już istnieje!";
            } else {
                $stmt->close();
                $stmt = $conn->prepare("INSERT INTO logins (login, passwd) VALUES (?, ?)");
                $stmt->bind_param("ss", $login, $pass);
                if ($stmt->execute()) {
                    $message = "Rejestracja udana! Możesz się zalogować.";
                } else {
                    $message = "Błąd podczas rejestracji.";
                }
            }
            $stmt->close();
        }
    } else {
        $message = "Wypełnij wszystkie pola!";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Rejestracja</title>
    <link rel="stylesheet" href="./style/styl1.css">
</head>
<body>
    <h1>Rejestracja</h1>
    <form action="register.php" method="post">
    Login: <input type="text" name="login" required><br><br>
    Hasło: <input type="password" name="pass" required><br><br>
    Powtórz hasło: <input type="password" name="pass2" required><br><br>
    <input type="submit" value="Zarejestruj">
</form>
    <p><?php echo $message; ?></p>
    <a href="login.php">Masz już konto? Zaloguj się!</a>
</body>
</html>