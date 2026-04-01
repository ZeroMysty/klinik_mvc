<?php
class PasienController {
    private $pasienModel;
    
    public function __construct($pasienModel) {
        $this->pasienModel = $pasienModel;
    }
    
    public function index() {
        $pasien = $this->pasienModel->getAllPasien();
        return $pasien;
    }
    
    public function show($nomedrec) {
        return $this->pasienModel->getPasienById($nomedrec);
    }
    
    public function store($nomedrec, $nama_pasien, $email) {
        return $this->pasienModel->addPasien($nomedrec, $nama_pasien, $email);
    }
}
?>
