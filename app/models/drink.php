<?php

class Drink extends BaseModel {
    
    public $drinkki_id, $nimi, $tyyppi, $alkoholiton, $lasi, $kuvaus;
    
    public function __construct($attributes = null) {
        parent::__construct($attributes);
    }
    
    public static function all(){
        $query = DB::connection()->prepare('SELECT * FROM Drinkki');
        $query->execute();
        $rows = $query->fetchAll();
        
        $drinks = array();
        
        foreach ($rows as $row) {
            $drinks[] = new Drink(array(
                'drinkki_id' => $row['drinkki_id'],
                'nimi' => $row['nimi'],
                'tyyppi' => $row['tyyppi'],
                'alkoholiton' => $row['alkoholiton'],
                'lasi' => $row['lasi'],
                'kuvaus' => $row['kuvaus']
            ));
        }
        
        return $drinks;
    }
    
    public static function find($drinkki_id) {
       $query = DB::connection()->prepare('SELECT * FROM Drinkki WHERE drinkki_id = :drinkki_id LIMIT 1');
        $query->execute(array('drinkki_id' => $drinkki_id));
        $row = $query->fetch();
        
        if ($row) {
            $drink[] = new Drink(array(
                'drinkki_id' => $row['drinkki_id'],
                'nimi' => $row['nimi'],
                'tyyppi' => $row['tyyppi'],
                'alkoholiton' => $row['alkoholiton'],
                'lasi' => $row['lasi'],
                'kuvaus' => $row['kuvaus']
            ));
            
            return $drink;
        }
        
        return null;
    }
    
    public function save() {
        
        $query = DB::connection()->prepare('INSERT INTO Drinkki ('
                . 'nimi, tyyppi, alkoholiton, lasi, kuvaus) VALUES '
                . ':nimi, :tyyppi, :alkoholiton, :lasi, :kuvaus) RETURNING drinkki_id');
        
        $query->execute(array('nimi' => $this->nimi, 'tyyppi' => $this->tyyppi,
            'alkoholiton' => $this->alkoholiton, 'lasi' => $this->lasi, 'kuvaus' => $this->kuvaus));
        
        $row = $query->fetch();
        $this->drinkki_id = $row['drinkki_id'];
    }
}

