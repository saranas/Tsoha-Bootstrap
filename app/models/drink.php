<?php

class Drink extends BaseModel {
    
    public $drinkki_id, $nimi, $tyyppi, $alkoholiton, $lasi;
    
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
                'lasi' => $row['lasi']
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
                'lasi' => $row['lasi']
            ));
            
            return $drink;
        }
        
        return null;
    }
}

