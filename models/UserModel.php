<?php
class UserModel {
    private $db;
    
    public function __construct($db) {
        $this->db = $db;
    }
    
    public function getUserByUsername($username) {
        $query = "SELECT * FROM user_sistem WHERE username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    
    public function getAllUsers() {
        $query = "SELECT id_user, username, level FROM user_sistem";
        $result = $this->db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>
