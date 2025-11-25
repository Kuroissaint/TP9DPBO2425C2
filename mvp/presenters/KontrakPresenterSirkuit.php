<?php
interface KontrakPresenterSirkuit {
    public function tampilkanSirkuit(): string;
    public function tampilkanFormSirkuit($id = null): string;
    public function tambahSirkuit($nama, $negara, $panjang_km, $jumlah_lap): void;
    public function ubahSirkuit($id, $nama, $negara, $panjang_km, $jumlah_lap): void;
    public function hapusSirkuit($id): void;
}
?>