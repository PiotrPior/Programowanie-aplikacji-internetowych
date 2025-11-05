<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $remember = isset($_POST['remember']);
    
    // Prosta autentykacja - UPROSZCZONE
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
        
        // Sprawdź czy to żądanie AJAX
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            header('Content-Type: application/json');
            echo json_encode([
                'success' => true, 
                'message' => 'Login successful', 
                'redirect' => 'dashboard.php'
            ]);
        } else {
            header('Location: dashboard.php');
        }
        exit;
    } else {
        // Sprawdź czy to żądanie AJAX
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            header('Content-Type: application/json');
            http_response_code(401);
            echo json_encode([
                'success' => false, 
                'message' => 'Invalid username or password'
            ]);
        } else {
            header('Location: index.html?error=invalid_credentials');
        }
        exit;
    }
}

// Jeśli ktoś próbuje wejść bezpośrednio
header('Location: index.html');
exit;
?>