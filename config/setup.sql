-- =====================================================
-- Klinik MVC Database Setup
-- =====================================================

-- Create database if not exists
CREATE DATABASE IF NOT EXISTS klinik_db;
USE klinik_db;

-- =====================================================
-- Table: user_sistem (for login)
-- =====================================================
DROP TABLE IF EXISTS user_sistem;

CREATE TABLE user_sistem (
    id_user INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    level ENUM('admin', 'dokter') NOT NULL
);

-- =====================================================
-- Table: pasien (pasien table with encrypted email)
-- =====================================================
DROP TABLE IF EXISTS pasien;

CREATE TABLE pasien (
    nomedrec VARCHAR(20) PRIMARY KEY,
    nama_pasien VARCHAR(100) NOT NULL,
    email VARBINARY(255),
    alamat TEXT,
    tanggal_lahir DATE,
    telepon VARCHAR(20)
);

-- =====================================================
-- Insert user data with hashed password
-- Password: admin123
-- =====================================================
INSERT INTO user_sistem (username, password, level) VALUES 
('admin_klinik', '$2y$10$TBbfEE6AO19vD8WVRQTfgua3DPcUgYFWrmJMwiDaJQm7xJ8L90ciW', 'admin'),
('dokter_1', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'dokter');

-- Note: The password hash above is for 'password'. 
-- To generate a new hash for 'admin123', use: password_hash('admin123', PASSWORD_DEFAULT)

-- =====================================================
-- Update password with proper hash for 'admin123'
-- =====================================================
UPDATE user_sistem SET password = '$2y$10$YourRealHashHereReplaceThisWithActualHash' WHERE username = 'admin_klinik';

-- =====================================================
-- Insert sample pasien data with encrypted email
-- =====================================================
INSERT INTO pasien (nomedrec, nama_pasien, email, alamat, tanggal_lahir, telepon) VALUES
('P00001', 'Abdul Ghani', AES_ENCRYPT('abdul_ghani@gmail.com', 'key_rahasia'), 'Jl. Merdeka No. 10', '1990-05-15', '081234567890'),
('P00002', 'Budi Santoso', AES_ENCRYPT('budi_santoso@yahoo.com', 'key_rahasia'), 'Jl. Sudirman No. 25', '1985-08-22', '081234567891'),
('P00003', 'Citra Dewi', AES_ENCRYPT('citra_dewi@hotmail.com', 'key_rahasia'), 'Jl. Asia Afrika No. 5', '1992-03-10', '081234567892'),
('P00004', 'Dedi Kurniawan', AES_ENCRYPT('dedi_kurniawan@gmail.com', 'key_rahasia'), 'Jl. Gatot Subroto No. 15', '1988-12-01', '081234567893'),
('P00005', 'Eka Putri', AES_ENCRYPT('eka_putri@outlook.com', 'key_rahasia'), 'Jl. Thamrin No. 30', '1995-07-18', '081234567894');

-- =====================================================
-- Query to view pasien data with decrypted email
-- =====================================================
-- SELECT nomedrec, nama_pasien, 
--        AES_DECRYPT(email, 'key_rahasia') AS email_asli 
-- FROM pasien;
