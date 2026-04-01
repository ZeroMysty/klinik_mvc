<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

require_once '../config/Database.php';
require_once '../models/PasienModel.php';
require_once '../controllers/PasienController.php';

$database = new Database();
$db = $database->getConnection();
$pasienModel = new PasienModel($db);
$pasienController = new PasienController($pasienModel);
$pasienList = $pasienController->index();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Klinik MVC</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header h1 {
            font-size: 24px;
        }
        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .btn-logout {
            padding: 8px 15px;
            background: white;
            color: #667eea;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        .container {
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }
        .card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .card h2 {
            margin-bottom: 20px;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background: #667eea;
            color: white;
        }
        tr:hover {
            background: #f5f5f5;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Dashboard Klinik MVC</h1>
        <div class="user-info">
            <span>Welcome, <?php echo $_SESSION['user']; ?>!</span>
            <a href="../index.php?action=logout" class="btn-logout">Logout</a>
        </div>
    </div>
    
    <div class="container">
        <div class="card">
            <h2>Data Pasien</h2>
            <table>
                <thead>
                    <tr>
                        <th>No. Rekam Medis</th>
                        <th>Nama Pasien</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($pasienList)): ?>
                        <?php foreach ($pasienList as $pasien): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($pasien['nomedrec']); ?></td>
                                <td><?php echo htmlspecialchars($pasien['nama_pasien']); ?></td>
                                <td><?php echo htmlspecialchars($pasien['email_asli'] ?? 'N/A'); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" style="text-align: center;">Tidak ada data pasien</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
