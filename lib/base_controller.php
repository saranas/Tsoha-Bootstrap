<?php
require 'app/models/user.php';
class BaseController {

    public static function get_user_logged_in() {
        
        if (isset($_SESSION['user'])) {
            $kayttaja_id = $_SESSION['user'];
            
            $user = User::find($kayttaja_id);

            return $user;
        }
        return null;
    }

    public static function check_logged_in() {
        // Toteuta kirjautumisen tarkistus tähän.
        // Jos käyttäjä ei ole kirjautunut sisään, ohjaa hänet toiselle sivulle (esim. kirjautumissivulle).
        
    }

}
