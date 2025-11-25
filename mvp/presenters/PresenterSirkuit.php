<?php
include_once("KontrakPresenterSirkuit.php");
include_once("models/Sirkuit.php");

class PresenterSirkuit implements KontrakPresenterSirkuit {
    private $tabelSirkuit;
    private $viewSirkuit;
    private $listSirkuit = [];

    public function __construct($tabelSirkuit, $viewSirkuit) {
        $this->tabelSirkuit = $tabelSirkuit;
        $this->viewSirkuit = $viewSirkuit;
        $this->initList();
    }

    public function initList() {
        $data = $this->tabelSirkuit->getAllSirkuit();
        $this->listSirkuit = [];
        foreach ($data as $item) {
            $this->listSirkuit[] = new Sirkuit($item['id'], $item['nama'], $item['negara'], $item['panjang_km'], $item['jumlah_lap']);
        }
    }

    public function tampilkanSirkuit(): string {
        return $this->viewSirkuit->tampilSirkuit($this->listSirkuit);
    }

    public function tampilkanFormSirkuit($id = null): string {
        $data = $id ? $this->tabelSirkuit->getSirkuitById($id) : null;
        return $this->viewSirkuit->tampilFormSirkuit($data);
    }

    public function tambahSirkuit($nama, $negara, $panjang_km, $jumlah_lap): void {
        $this->tabelSirkuit->addSirkuit($nama, $negara, $panjang_km, $jumlah_lap);
        $this->initList();
    }

    public function ubahSirkuit($id, $nama, $negara, $panjang_km, $jumlah_lap): void {
        $this->tabelSirkuit->updateSirkuit($id, $nama, $negara, $panjang_km, $jumlah_lap);
        $this->initList();
    }

    public function hapusSirkuit($id): void {
        $this->tabelSirkuit->deleteSirkuit($id);
        $this->initList();
    }
}
?>