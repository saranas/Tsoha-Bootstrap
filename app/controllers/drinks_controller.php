<?php

require 'app/models/drink.php';
require 'app/models/ingredient.php';

class DrinksController extends BaseController {

    public static function index() {
        $drinks = Drink::all();
        View::make('drinks/index.html', array('drinks' => $drinks));
    }

    public static function show($drinkki_id) {
        $drink = Drink::find($drinkki_id);
        $ainekset = Drink::getIngredients($drinkki_id);
        View::make('drinks/show.html', array('drink' => $drink, 'ainekset' => $ainekset));
    }

    public static function addnew() {
        $aineslista = Aines::all();
        $drink = new Drink(array('nimi' => '', 'tyyppi' => '', 'lasi' => '', 'alkoholiton' => FALSE, 'kuvaus' => '', 'tyovaiheet' => ''));
        View::make('drinks/addnew.html', array('aineslista' => $aineslista, 'ainekset' => array(), 'attributes' => $drink));
    }

    public static function edit($drinkki_id) {
        $drink = Drink::find($drinkki_id);
        $ainekset = $drink->getIngredients($drinkki_id);
        $ainesidt = array();
        foreach ($ainekset as $aines) {
            $ainesidt[] = $aines->aines_id;
        }
        $aineslista = Aines::all();
        View::make('drinks/edit.html', array('attributes' => $drink, 'ainekset' => $ainesidt, 'aineslista' => $aineslista));
    }

    public static function update($drinkki_id) {
        $params = $_POST;

        $v = new Valitron\Validator($_POST);
        $v->rule('required', 'nimi')->message('{field} pitää antaa')->label('Nimi');
        $v->rule('required', 'ainekset')->message('Valitse vähintään yksi {field}')->label('Aines');
        $v->rule('lengthMin', 'nimi', 1)->message('{field} pitää olla 1-50 merkkiä pitkä')->label('Nimen');
        $v->rule('lengthMax', 'nimi', 50)->message('{field} pitää olla 1-50 merkkiä pitkä')->label('Nimen');
        $v->rule('lengthMax', 'tyyppi', 30)->message('{field} saa olla korkeintaan 30 merkkiä pitkä')->label('Tyyppi');
        $v->rule('lengthMax', 'lasi', 30)->message('{field} nimi saa olla korkeintaan 30 merkkiä pitkä')->label('Lasin');

        if (!isset($params['alkoholiton'])) {
            $params['alkoholiton'] = 0;
        }
        $params['tyovaiheet'] = " ";

        $drink = new Drink(array(
            'nimi' => $params['nimi'],
            'tyyppi' => $params['tyyppi'],
            'lasi' => $params['lasi'],
            'alkoholiton' => $params['alkoholiton'],
            'kuvaus' => $params['kuvaus'],
            'tyovaiheet' => $params['tyovaiheet']
        ));

        if ($v->validate()) {
            $ainekset = $params['ainekset'];
            $drink->update($drinkki_id, $ainekset);
            Redirect::to('/drinks/' . $drink->drinkki_id, array('message' => 'Reseptiä muokattu onnistuneesti'));
        } else {
            if (!isset($params['ainekset'])) {
                $ainekset = array();
            } else {
                $ainekset = $params['ainekset'];
            }
            $aineslista = Aines::all();
            $drink->drinkki_id = $drinkki_id;
            View::make('drinks/edit.html', array('errors' => $v->errors(), 'attributes' => $drink, 'ainekset' => $ainekset, 'aineslista' => $aineslista));
        }
    }

    public static function destroy($drinkki_id) {
        $drink = Drink::find($drinkki_id);
        $drink->destroy($drinkki_id);
        Redirect::to('/drinks', array('message' => 'Juoma poistettu onnistuneesti'));
    }

    public static function store() {
        $params = $_POST;

        $v = new Valitron\Validator($_POST);
        $v->rule('required', 'nimi')->message('{field} pitää antaa')->label('Nimi');
        $v->rule('required', 'ainekset')->message('Valitse vähintään yksi {field}')->label('Aines');
        $v->rule('lengthMin', 'nimi', 1)->message('{field} pitää olla 1-50 merkkiä pitkä')->label('Nimi');
        $v->rule('lengthMax', 'nimi', 50)->message('{field} pitää olla 1-50 merkkiä pitkä')->label('Nimi');
        $v->rule('lengthMax', 'tyyppi', 30)->message('{field} saa olla korkeintaan 30 merkkiä pitkä')->label('Tyyppi');
        $v->rule('lengthMax', 'lasi', 30)->message('{field} nimi saa olla korkeintaan 30 merkkiä pitkä')->label('Lasin');

        if (!isset($params['alkoholiton'])) {
            $params['alkoholiton'] = 0;
        }
        $params['tyovaiheet'] = " ";

        $drink = new Drink(array(
            'nimi' => $params['nimi'],
            'tyyppi' => $params['tyyppi'],
            'alkoholiton' => $params['alkoholiton'],
            'lasi' => $params['lasi'],
            'kuvaus' => $params['kuvaus'],
            'tyovaiheet' => $params['tyovaiheet']
        ));

        if ($v->validate()) {
            $ainekset = $params['ainekset'];
            $drink->save($ainekset);
            Redirect::to('/drinks/' . $drink->drinkki_id, array('message' => 'Resepti lisätty tietokantaan'));
        } else {
            if (!isset($params['ainekset'])) {
                $ainekset = array();
            } else {
                $ainekset = $params['ainekset'];
            }
            $aineslista = Aines::all();
            View::make('drinks/addnew.html', array('errors' => $v->errors(), 'ainekset' => $ainekset, 'aineslista' => $aineslista, 'attributes' => $drink));
        }
    }

}
