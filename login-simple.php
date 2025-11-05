<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $remember = isset($_POST['remember']);
    
    // Prosta autentykacja dla testów
    $validUsers = [
        'admin' => 'admin123',
        'user' => 'user123',
        'test' => 'test123'
    ];
    
    if (isset($validUsers[$username]) && $validUsers[$username] === $password) {
        $_SESSION['user'] = $username;
        $_SESSION['login_time'] = time();
        
        if ($remember) {
            setcookie('remember_user', $username, time() + (30 * 24 * 60 * 60), '/');
        }
        
        // Bezpośrednie przekierowanie
        header('Location: dashboard.php');
        exit;
    } else {
        // Przekierowanie z powrotem z błędem
        header('Location: index.html?error=invalid_credentials');
        exit;
    }
} else {
    // Jeśli ktoś próbuje wejść bezpośrednio
    header('Location: index.html');
    exit;
}
?>