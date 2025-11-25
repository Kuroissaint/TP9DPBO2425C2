<?php
include_once ("KontrakViewSirkuit.php");
include_once ("models/Sirkuit.php");

class ViewSirkuit implements KontrakViewSirkuit {
    
    public function tampilSirkuit($listSirkuit): string {
        $tbody = '';
        $no = 1;
        // 1. Loop data sirkuit untuk menyusun baris tabel (TR)
        foreach($listSirkuit as $sirkuit){
            $tbody .= '<tr>';
            $tbody .= '<td class="col-id">'. $no .'</td>';
            $tbody .= '<td>'. htmlspecialchars($sirkuit->getNama()) .'</td>';
            $tbody .= '<td>'. htmlspecialchars($sirkuit->getNegara()) .'</td>';
            $tbody .= '<td>'. htmlspecialchars($sirkuit->getPanjangKm()) .' km</td>';
            $tbody .= '<td>'. htmlspecialchars($sirkuit->getJumlahLap()) .'</td>';
            $tbody .= '<td class="col-actions">
                    <a href="index.php?nav=sirkuit&screen=edit&id='. $sirkuit->getId() .'" class="btn btn-edit">Edit</a>
                    <a href="index.php?nav=sirkuit&delete='. $sirkuit->getId() .'" class="btn btn-delete" onclick="return confirm(\'Yakin hapus data ini?\')">Hapus</a>
                  </td>';
            $tbody .= '</tr>';
            $no++;
        }
        
        // 2. Load template HTML
        $templatePath = __DIR__ . '/../template/skin_sirkuit.html';
        
        if (file_exists($templatePath)) {
            $template = file_get_contents($templatePath);
            // Pastikan string di dalam kurung ini SAMA PERSIS dengan yang ada di file HTML
            $template = str_replace('{{DATA_TABEL_SIRKUIT}}', $tbody, $template);
            
            // Update total data
            $template = str_replace('{{TOTAL_SIRKUIT}}', count($listSirkuit), $template);
            return $template;
        } else {
            return "Error: Template skin_sirkuit.html tidak ditemukan.";
        }
    }

    public function tampilFormSirkuit($data = null): string {
        $templatePath = __DIR__ . '/../template/form_sirkuit.html';
        
        if (file_exists($templatePath)) {
            $template = file_get_contents($templatePath);
            
            // Logic replace value form untuk mode Edit
            if ($data) {
                $template = str_replace('value="add"', 'value="edit"', $template);
                $template = str_replace('name="id" value=""', 'name="id" value="'.htmlspecialchars($data['id']).'"', $template);
                $template = str_replace('id="nama" name="nama" type="text" placeholder="Contoh: Mandalika International Circuit" required value=""', 'id="nama" name="nama" type="text" placeholder="Contoh: Mandalika International Circuit" required value="'.htmlspecialchars($data['nama']).'"', $template);
                $template = str_replace('id="negara" name="negara" type="text" placeholder="Contoh: Indonesia" required value=""', 'id="negara" name="negara" type="text" placeholder="Contoh: Indonesia" required value="'.htmlspecialchars($data['negara']).'"', $template);
                $template = str_replace('id="panjang_km" name="panjang_km" type="number" step="0.001" placeholder="0.000" required value=""', 'id="panjang_km" name="panjang_km" type="number" step="0.001" placeholder="0.000" required value="'.htmlspecialchars($data['panjang_km']).'"', $template);
                $template = str_replace('id="jumlah_lap" name="jumlah_lap" type="number" placeholder="0" required value=""', 'id="jumlah_lap" name="jumlah_lap" type="number" placeholder="0" required value="'.htmlspecialchars($data['jumlah_lap']).'"', $template);
            }
            return $template;
        }
        return "Error: Template form_sirkuit.html tidak ditemukan.";
    }
}
?>