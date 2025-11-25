<?php
interface KontrakModelSirkuit {
    public function getAllSirkuit(): array;
    public function getSirkuitById($id): ?array;
    public function addSirkuit($nama, $negara, $panjang_km, $jumlah_lap): void;
    public function updateSirkuit($id, $nama, $negara, $panjang_km, $jumlah_lap): void;
    public function deleteSirkuit($id): void;
}
?>