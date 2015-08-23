<?php

class Aines extends BaseModel {
    
    public $aines_id, $nimi, $alkpitoisuus;
    
    public function __construct($attributes = null) {
        parent::__construct($attributes);
    }
    
    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Aines');
        $query->execute();
        $rows = $query->fetchAll();

        $ingredients = array();

        foreach ($rows as $row) {
            $ingredients[] = new Aines(array(
                'aines_id' => $row['aines_id'],
                'nimi' => $row['nimi'],
                'alkpitoisuus' => $row['alkpitoisuus']
            ));
        }
        return $ingredients;
    }
    
    public static function find($aines_id) {
        $query = DB::connection()->prepare('SELECT * FROM Aines WHERE aines_id = :aines_id LIMIT 1');
        $query->execute(array('aines_id' => $aines_id));
        $row = $query->fetch();

        if ($row) {
            $ingredient = new Aines(array(
                'aines_id' => $row['aines_id'],
                'nimi' => $row['nimi'],
                'alkpitoisuus' => $row['alkpitoisuus']
            ));
        }
        return $ingredient;
    }
    
    public function update($aines_id) {

        $query = DB::connection()->prepare('UPDATE Aines SET nimi = :nimi, alkpitoisuus = :alkpitoisuus, WHERE aines_id = :aines_id RETURNING aines_id');
        
        $query->bindValue('nimi', $this->nimi);
        $query->bindValue('alkpitoisuus', $this->alkpitoisuus);
        $query->bindValue('aines_id', $aines_id);
        
        $query->execute();
        
        $row = $query->fetch();
        $this->aines_id = $row['aines_id'];

    }
    
    public function destroy($aines_id) {

        $query = DB::connection()->prepare(''
                . 'DELETE FROM Aines '
                . 'WHERE aines_id = :aines_id'
        );
        $query->execute(array('aines_id' => $aines_id));
    }
}

