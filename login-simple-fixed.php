<?php
session_start();

// PROSTA WERSJA BEZ AJAX
if ($_POST['username'] === 'admin' && $_POST['password'] === 'admin123') {
    $_SESSION['user'] = $_POST['username'];
    header('Location: dashboard.php');
    exit;
} else {
    header('Location: index.html?error=invalid_credentials');
    exit;
}
?>