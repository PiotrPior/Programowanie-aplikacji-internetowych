<?php
session_start();

// Sprawdzamy czy użytkownik jest zalogowany
$logged_in = isset($_SESSION['user_id']) || isset($_SESSION['username']);

// Zwracamy JSON z informacją o statusie logowania
header('Content-Type: application/json');
echo json_encode(['logged_in' => $logged_in]);
?>
