<?php
require_once 'config/Database.php';
require_once 'models/UserModel.php';
require_once 'controllers/AuthController.php';

// Get the action from the query string
$action = $_GET['action'] ?? '';

// Initialize database connection
$database = new Database();
$db = $database->getConnection();

// Initialize models
$userModel = new UserModel($db);

// Initialize controllers
$authController = new AuthController();

// Route the request
switch ($action) {
    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            $authController->login($username, $password, $userModel);
        }
        break;
    
    case 'logout':
        $authController->logout();
        break;
    
    default:
        // Default action - redirect to login
        header('Location: views/login.php');
        break;
}
?>
