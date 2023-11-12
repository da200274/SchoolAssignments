<?php

namespace App\Models;

use CodeIgniter\Model;

class ZahtevModel extends Model
{
    protected $table      = 'zahtev';
    protected $primaryKey = 'id';
    protected $returnType = 'object';

    protected $allowedFields = ['status', 'komentar','naziv_predela', 'opis_predela','naziv_zivotinje','lat_naziv_zivotinje','opis_zivotinje','slika_predela','slika_zivotinje','id_user','tip_zahteva','id_zahtev'];
    // Dates
    
    public function dohvZahtev($q) {

    $db = db_connect();
    $sql = 'SELECT * FROM zahtev WHERE id_zahtev = ?';
    $result = $db->query($sql, [$q])->getRowArray();

    return $result;
    }

}
