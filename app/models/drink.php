<?php

class Drink extends BaseModel {

    public $drinkki_id, $nimi, $tyyppi, $alkoholiton, $lasi, $kuvaus, $tyovaiheet;
    public $TYYPIT = array('Shotti', 'Cocktail', 'Aperitiivi');
    public $LASIT = array('Cocktail-lasi', 'Grogilasi', 'Hurrikaanilasi');

    public function __construct($attributes = null) {
        parent::__construct($attributes);
    }
    
    public function getTyypit() {
        return $this->tyypit;
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

    public function update($drinkki_id) {

        $query = DB::connection()->prepare('UPDATE Drinkki SET nimi = :nimi, tyyppi = :tyyppi, alkoholiton = :alkoholiton, lasi = :lasi, kuvaus = :kuvaus, tyovaiheet = :tyovaiheet WHERE drinkki_id = :drinkki_id RETURNING drinkki_id');

        $query->bindValue('nimi', $this->nimi);
        $query->bindValue('tyyppi', $this->tyyppi);
        $query->bindValue('tyovaiheet', $this->tyovaiheet);
        $query->bindValue('alkoholiton', $this->alkoholiton);
        $query->bindValue('lasi', $this->lasi);
        $query->bindValue('kuvaus', $this->kuvaus);

        $query->bindValue('drinkki_id', $drinkki_id);

        $query->execute();

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
    
    public function getIngredients($drinkki_id) {
        $query = DB::connection()->prepare('SELECT * FROM Drinkkiainekset WHERE drinkki_id = :drinkki_id');
        $query->execute(array(
            'drinkki_id' => $drinkki_id
        ));
        
        $rows = $query->fetchAll();
        $ainekset = array();
        
        foreach ($rows as $row) {
            $aines = Aines::find($row['aines_id']);
            array_push($ainekset, $aines);
        }
        
        return $ainekset;
    }

    public function save($ainekset) {

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

        //Yhteystauluun lisääminen:
        foreach ($ainekset as $aines) {
            $query = DB::connection()->prepare('INSERT INTO Drinkkiainekset (drinkki_id, aines_id) VALUES (:drinkki_id, :aines_id)');
            $query->execute(array(
                'drinkki_id' => $this->drinkki_id,
                'aines_id' => $aines
            ));
        }
    }

}
