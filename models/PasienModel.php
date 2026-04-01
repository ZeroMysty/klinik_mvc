<?php
class PasienModel {
    private $db;
    private $encryption_key = 'key_rahasia';
    
    public function __construct($db) {
        $this->db = $db;
    }
    
    public function getAllPasien() {
        $query = "SELECT nomedrec, nama_pasien, 
                  AES_DECRYPT(email, ?) AS email_asli 
                  FROM pasien";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $this->encryption_key);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    
    public function getPasienById($nomedrec) {
        $query = "SELECT nomedrec, nama_pasien, 
                  AES_DECRYPT(email, ?) AS email_asli 
                  FROM pasien WHERE nomedrec = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $this->encryption_key, $nomedrec);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    
    public function addPasien($nomedrec, $nama_pasien, $email) {
        $encrypted_email = "AES_ENCRYPT(?, ?)";
        $query = "INSERT INTO pasien (nomedrec, nama_pasien, email) VALUES (?, ?, $encrypted_email)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sss", $nomedrec, $nama_pasien, $email, $this->encryption_key);
        return $stmt->execute();
    }
}
?>
