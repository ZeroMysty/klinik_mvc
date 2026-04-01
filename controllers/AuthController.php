<?php
class AuthController {
    public function login($username, $password, $userModel) {
        $user = $userModel->getUserByUsername($username);
        
        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user'] = $user['username'];
            $_SESSION['level'] = $user['level'];
            header("Location: views/dashboard.php");
            exit();
        } else {
            header("Location: views/login.php?error=1");
            exit();
        }
    }
    
    public function logout() {
        session_start();
        session_destroy();
        header("Location: views/login.php");
        exit();
    }
    
    public function isLoggedIn() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        return isset($_SESSION['user']);
    }
}
?>
