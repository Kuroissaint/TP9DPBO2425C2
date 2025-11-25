<?php
class Sirkuit {
    private $id;
    private $nama;
    private $negara;
    private $panjang_km;
    private $jumlah_lap;

    public function __construct($id, $nama, $negara, $panjang_km, $jumlah_lap){
        $this->id = $id;
        $this->nama = $nama;
        $this->negara = $negara;
        $this->panjang_km = $panjang_km;
        $this->jumlah_lap = $jumlah_lap;
    }

    public function getId() { return $this->id; }
    public function getNama() { return $this->nama; }
    public function getNegara() { return $this->negara; }
    public function getPanjangKm() { return $this->panjang_km; }
    public function getJumlahLap() { return $this->jumlah_lap; }
}
?>