<?php

class User extends BaseModel {
    
    public $kayttajanimi, $kayttaja_id;
    
    public function authenticate($kayttajanimi, $salasana) {
        $query = DB::connection()->prepare(''
                . 'SELECT * FROM Kayttaja '
                . 'WHERE kayttajanimi = :kayttajanimi'
                . 'AND salasana = :salasana'
                . 'LIMIT 1', 
                array('kayttajanimi' => $kayttajanimi, 'salasana' => $salasana)
                );
        
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
