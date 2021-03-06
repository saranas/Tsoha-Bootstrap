<?php

class User extends BaseModel {
    
    public $kayttajanimi, $kayttaja_id;
    
    public function find($kayttaja_id) {
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE kayttaja_id = :kayttaja_id LIMIT 1');
        
        $query->bindValue('kayttaja_id', $kayttaja_id);
        $query->execute();
        $row = $query->fetch();
        
        if($row) {
            $user = new User(array(
                'kayttaja_id' => $row['kayttaja_id'],
                'kayttajanimi' => $row['kayttajanimi']
            ));
            return $user;
        } else {
            return null;
        }
    }
    
    public function authenticate($kayttajanimi, $salasana) {
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE kayttajanimi = :kayttajanimi AND salasana = :salasana LIMIT 1' 
               );
        $query->bindValue('kayttajanimi', $kayttajanimi);
        $query->bindValue('salasana', $salasana);
        $query->execute();
        $row = $query->fetch();
        
        if($row) {
            $user = new User(array(
                'kayttaja_id' => $row['kayttaja_id'],
                'kayttajanimi' => $row['kayttajanimi']
            ));
            return $user;
        } else {
            return null;
        }
    }
}
