<?php
include_once ("models/DB.php");
include_once ("KontrakModelSirkuit.php");

class TabelSirkuit extends DB implements KontrakModelSirkuit {

    public function __construct($host, $db_name, $username, $password) {
        parent::__construct($host, $db_name, $username, $password);
    }

    public function getAllSirkuit(): array {
        $query = "SELECT * FROM sirkuit";
        $this->executeQuery($query);
        return $this->getAllResult();
    }

    public function getSirkuitById($id): ?array {
        $this->executeQuery("SELECT * FROM sirkuit WHERE id = :id", ['id' => $id]);
        $result = $this->getAllResult();
        return $result[0] ?? null;
    }

    public function addSirkuit($nama, $negara, $panjang_km, $jumlah_lap): void {
        $query = "INSERT INTO sirkuit (nama, negara, panjang_km, jumlah_lap) 
                  VALUES (:nama, :negara, :panjang_km, :jumlah_lap)";
        $params = [
            'nama' => $nama, 'negara' => $negara,
            'panjang_km' => $panjang_km, 'jumlah_lap' => $jumlah_lap
        ];
        $this->executeQuery($query, $params);
    }
    
    public function updateSirkuit($id, $nama, $negara, $panjang_km, $jumlah_lap): void {
        $query = "UPDATE sirkuit SET nama=:nama, negara=:negara, panjang_km=:panjang_km, jumlah_lap=:jumlah_lap WHERE id=:id";
        $params = [
            'id' => $id, 'nama' => $nama, 'negara' => $negara,
            'panjang_km' => $panjang_km, 'jumlah_lap' => $jumlah_lap
        ];
        $this->executeQuery($query, $params);
    }
    
    public function deleteSirkuit($id): void {
        $query = "DELETE FROM sirkuit WHERE id = :id";
        $this->executeQuery($query, ['id' => $id]);
    }
}
?>