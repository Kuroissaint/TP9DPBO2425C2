<?php

// ==========================================================
// 1. INCLUDE SEMUA FILE YANG DIBUTUHKAN
// ==========================================================
include_once("models/DB.php");

// Includes untuk Pembalap
include_once("models/TabelPembalap.php");
include_once("views/ViewPembalap.php");
include_once("presenters/PresenterPembalap.php");

// Includes untuk Sirkuit
include_once("models/TabelSirkuit.php");
include_once("views/ViewSirkuit.php");
include_once("presenters/PresenterSirkuit.php");

// ==========================================================
// 2. CONFIG & GLOBAL VARIABLES
// ==========================================================
$dbHost = 'localhost';
$dbName = 'mvp_db';
$dbUser = 'root';
$dbPass = '';

// Tentukan kita sedang ada di modul mana (Default: pembalap)
$nav = $_GET['nav'] ?? 'pembalap';

// ==========================================================
// 3. TAMPILAN NAVIGASI UMUM (Simple Menu)
// ==========================================================
echo '
<div style="max-width:980px; margin: 20px auto; font-family: sans-serif;">
    <a href="index.php?nav=pembalap" style="margin-right: 15px; text-decoration: none; font-weight: bold; color: '.($nav == 'pembalap' ? '#2563eb' : '#666').'">🏎️ Data Pembalap</a>
    <a href="index.php?nav=sirkuit" style="text-decoration: none; font-weight: bold; color: '.($nav == 'sirkuit' ? '#2563eb' : '#666').'">🏁 Data Sirkuit</a>
    <hr style="border: 0; border-top: 1px solid #ddd; margin-top: 10px;">
</div>
';

// ==========================================================
// 4. ROUTING LOGIC
// ==========================================================

if ($nav == 'sirkuit') {
    
    // ==================== LOGIKA SIRKUIT ====================
    $tabelSirkuit = new TabelSirkuit($dbHost, $dbName, $dbUser, $dbPass);
    $viewSirkuit  = new ViewSirkuit();
    $presenter    = new PresenterSirkuit($tabelSirkuit, $viewSirkuit);

    // --- A. HANDLE POST (Tambah / Edit) ---
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
        $action = $_POST['action'];
        $id = $_POST['id'] ?? '';
        
        // Ambil data spesifik sirkuit
        $nama = $_POST['nama'] ?? '';
        $negara = $_POST['negara'] ?? '';
        $panjang_km = $_POST['panjang_km'] ?? 0;
        $jumlah_lap = $_POST['jumlah_lap'] ?? 0;

        if($action === 'add') {
            $presenter->tambahSirkuit($nama, $negara, $panjang_km, $jumlah_lap);
        } 
        else if($action === 'edit' && $id) {
            $presenter->ubahSirkuit($id, $nama, $negara, $panjang_km, $jumlah_lap);
        }
        
        // Redirect kembali ke halaman sirkuit
        header("Location: index.php?nav=sirkuit");
        exit();
    }

    // --- B. HANDLE DELETE ---
    if(isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $presenter->hapusSirkuit($id);
        header("Location: index.php?nav=sirkuit");
        exit();
    }

    // --- C. HANDLE TAMPILAN (List / Form) ---
    if(isset($_GET['screen'])){
        if($_GET['screen'] == 'add'){
            echo $presenter->tampilkanFormSirkuit();
        }
        else if($_GET['screen'] == 'edit' && isset($_GET['id'])){
            echo $presenter->tampilkanFormSirkuit($_GET['id']);
        }
    } else {
        echo $presenter->tampilkanSirkuit();
    }

} else {

    // ==================== LOGIKA PEMBALAP (DEFAULT) ====================
    $tabelPembalap = new TabelPembalap($dbHost, $dbName, $dbUser, $dbPass);
    $viewPembalap  = new ViewPembalap();
    $presenter     = new PresenterPembalap($tabelPembalap, $viewPembalap);

    // --- A. HANDLE POST (Tambah / Edit) ---
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
        $action = $_POST['action'];
        $id = $_POST['id'] ?? '';

        // Ambil data spesifik pembalap
        $nama = $_POST['nama'] ?? '';
        $tim = $_POST['tim'] ?? '';
        $negara = $_POST['negara'] ?? '';
        $poinMusim = $_POST['poinMusim'] ?? 0;
        $jumlahMenang = $_POST['jumlahMenang'] ?? 0;

        if($action === 'add') {
            $presenter->tambahPembalap($nama, $tim, $negara, $poinMusim, $jumlahMenang);
        } 
        else if($action === 'edit' && $id) {
            $presenter->ubahPembalap($id, $nama, $tim, $negara, $poinMusim, $jumlahMenang);
        }
        
        // Redirect kembali ke halaman pembalap
        header("Location: index.php?nav=pembalap");
        exit();
    }

    // --- B. HANDLE DELETE ---
    if(isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $presenter->hapusPembalap($id);
        header("Location: index.php?nav=pembalap");
        exit();
    }

    // --- C. HANDLE TAMPILAN (List / Form) ---
    if(isset($_GET['screen'])){
        if($_GET['screen'] == 'add'){
            echo $presenter->tampilkanFormPembalap();
        }
        else if($_GET['screen'] == 'edit' && isset($_GET['id'])){
            echo $presenter->tampilkanFormPembalap($_GET['id']);
        }
    } else {
        echo $presenter->tampilkanPembalap();
    }
}
?>