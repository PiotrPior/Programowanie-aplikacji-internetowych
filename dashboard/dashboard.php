<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style/dashboard.css">
    <title>Dashboard</title>
</head>
<body>
    <nav>
        <a href="#">Link 1</a>
        <a href="#">Link 2</a>
        <a href="#">Link 3</a>
        <a href="#">Link 4</a>
        <a href="#">Link 5</a>

    <form action="logout.php" method="post" style="display: inline; float: right;">
        <input type="submit" value="logout">
    </form>
    </nav>
    <header>
        <h1>Welcome to LOW KEY DEMO!</h1>
    </header>
</body>
</html>
<?php
if (empty($_SESSION['login'])){
    echo "Witaj! Zaloguj się.";
} else {
    echo "Witaj ".$_SESSION['login']."!";
}
?>