<?php
/*
 * Marta Andjic 2020/0343
 * 
 * LajkModel - model za dohvatanje podataka o lajkovanim slikama iz baze
 * 
 * @version 1.0
 */

namespace App\Models;

use CodeIgniter\Model;

class LajkModel extends Model
{
    protected $table      = 'lajkovi';
    protected $primaryKey = 'id_lajk';
    protected $returnType     = 'object';
    
    protected $useAutoIncrement = true;
    protected $allowedFields = ['id_user', 'id_slika'];
    
    public function pritisnuto($idusr, $idslika) {
        
    $db = db_connect();
    $sql = 'SELECT id_lajk, flag FROM lajkovi WHERE id_user = ? AND id_slika = ?';
    $result = $db->query($sql, [$idusr, $idslika])->getResultArray();
    
    if(count($result) == 1){
        $flag = ($result[0]['flag'] == 1? 0 : 1);
        $inc = ($result[0]['flag'] == 1? -1 : 1);
        
        $sql = 'UPDATE lajkovi SET flag = ? WHERE id_user = ? AND id_slika = ?';
        $db->query($sql, [$flag, $idusr, $idslika]);
        $sql = 'UPDATE slika SET broj_lajkova = broj_lajkova + ? WHERE id_slika = ?';
        $db->query($sql, [$inc, $idslika]); 
    }
    else {
        $sql = 'INSERT INTO lajkovi(id_user, id_slika, flag) VALUES (?,?, 1)';
        $db->query($sql, [$idusr, $idslika]);
        $sql = 'UPDATE slika SET broj_lajkova = broj_lajkova + 1 WHERE id_slika = ?';
        $db->query($sql, [$idslika]);
    }
    
    $sql = 'SELECT broj_lajkova FROM slika WHERE id_slika = ?';
    $result = $db->query($sql, [$idslika])->getRowArray();

    return $result['broj_lajkova'];
    }
}