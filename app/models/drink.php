<?php

class Drink extends BaseModel {

    public $drinkki_id, $nimi, $tyyppi, $alkoholiton, $lasi, $kuvaus, $tyovaiheet;

    public function __construct($attributes = null) {
        parent::__construct($attributes);
        //$this->validators = array()
    }

    public static function all() {
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
                'kuvaus' => $row['kuvaus'],
                'tyovaiheet' => $row['tyovaiheet']
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
                'kuvaus' => $row['kuvaus'],
                'tyovaiheet' => $row['tyovaiheet']
            ));

            return $drink;
        }

        return null;
    }

    public function update() {

        $query = DB::connection()->prepare(''
                . 'UPDATE Drinkki'
                . 'SET NIMI = :nimi, TYYPPI = :tyyppi, ALKOHOLITON = :alkoholiton,'
                . 'LASI = :lasi, KUVAUS = :kuvaus, TYOVAIHEET = :tyovaiheet'
                . 'RETURNING drinkki_id');

        $query->execute(array(
            'nimi' => $this->nimi,
            'tyyppi' => $this->tyyppi,
            'alkoholiton' => $this->alkoholiton,
            'lasi' => $this->lasi,
            'kuvaus' => $this->kuvaus,
            'tyovaiheet' => $this->tyovaiheet
        ));

        $row = $query->fetch();
        $this->drinkki_id = $row['drinkki_id'];
    }
    
    public function destroy($drinkki_id) {

        $query = DB::connection()->prepare(''
                . 'DELETE FROM Drinkki '
                . 'WHERE drinkki_id = :drinkki_id'
                );
        $query->execute(array('drinkki_id' => $drinkki_id));

    }
    
    public function save() {

        $query = DB::connection()->prepare(''
                . 'INSERT INTO Drinkki (nimi, tyyppi, alkoholiton, lasi, kuvaus, tyovaiheet) '
                . 'VALUES (:nimi, :tyyppi, :alkoholiton, :lasi, :kuvaus, :tyovaiheet) '
                . 'RETURNING drinkki_id');

        $query->execute(array(
            'nimi' => $this->nimi,
            'tyyppi' => $this->tyyppi,
            'alkoholiton' => $this->alkoholiton,
            'lasi' => $this->lasi,
            'kuvaus' => $this->kuvaus,
            'tyovaiheet' => $this->tyovaiheet
        ));

        $row = $query->fetch();
        $this->drinkki_id = $row['drinkki_id'];
    }

//    public function validateDrink() {
//        $v = new Valitron\Validator($attributes);
//        $v->rule('required', 'nimi');
//        $v->rule('lengthBetween', 'nimi', array(1, 50));
//        $v->rule('lengthBetween', 'tyyppi', array(1, 30));
//        $v->rule('lengthBetween', 'lasi', array(1, 30));
//
//        if ($v->validate()) {
//            return TRUE;
//        } else {
//            // Errors
//            return $v->errors();
//        }
//    }
}
