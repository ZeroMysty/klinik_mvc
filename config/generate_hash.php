<?php
$password = 'admin123';
$hash = password_hash($password, PASSWORD_DEFAULT);

echo "Password: " . $password . "\n";
echo "Hash: " . $hash . "\n";
echo "\nUse this hash in your SQL INSERT statement:\n";
echo "INSERT INTO user_sistem (username, password, level) VALUES ('admin_klinik', '" . $hash . "', 'admin');\n";
?>
