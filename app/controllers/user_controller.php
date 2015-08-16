<?php

require 'app/models/drink.php';

class UserController extends BaseController {

    public static function login() {
        View::make('user/login.html');
    }

    public static function handle_login() {
        $params = $_POST;

        $user = User::authenticate($params['kayttajanimi'], $params['salasana']);

        if (!$user) {
            View::make('user/login.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'kayttajanimi' => $params['kayttajanimi']));
        } else {
            $_SESSION['user'] = $user->kayttaja_id;

            Redirect::to('/', array('message' => 'Tervetuloa takaisin ' . $user->kayttajanimi . '!'));
        }
    }
}
