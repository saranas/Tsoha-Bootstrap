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
        $ainekset = Aines::all();
        View::make('drinks/addnew.html', array('ainekset' => $ainekset));
    }

    public static function edit($drinkki_id) {
        $drink = Drink::find($drinkki_id);
        $tyypit = $drink[0]->TYYPIT;
        $lasit = $drink[0]->LASIT;
        View::make('drinks/edit.html', array('attributes' => $drink, 'tyypit' => $tyypit, 'lasit' => $lasit));
    }

    public static function update($drinkki_id) {
        $params = $_POST;

        $v = new Valitron\Validator($_POST);
        $v->rule('required', 'nimi');
        $v->rule('lengthMin', 'nimi', 1);
        $v->rule('lengthMax', 'nimi', 50);
        $v->rule('lengthMax', 'tyyppi', 30);
        $v->rule('lengthMax', 'lasi', 30);
        
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
            $drink->update($drinkki_id);
            Redirect::to('/drinks/' . $drink->drinkki_id, array('message' => 'Reseptiä muokattu onnistuneesti'));
        } else {
            View::make('drinks/edit.html', array('errors' => $v->errors(), 'attributes' => array($drink)));
        }
    }

    public static function destroy($drinkki_id) {
        $drink = Drink::find($drinkki_id);
        $drink[0]->destroy($drinkki_id);
        Redirect::to('/drinks', array('message' => 'Juoma poistettu onnistuneesti'));
    }

    public static function store() {
        $params = $_POST;
        
        $ainekset = $params['ainekset'];
        
        $v = new Valitron\Validator($_POST);
        $v->rule('required', 'nimi');
        $v->rule('lengthMin', 'nimi', 1);
        $v->rule('lengthMax', 'nimi', 50);
        $v->rule('lengthMax', 'tyyppi', 30);
        $v->rule('lengthMax', 'lasi', 30);
        
        if (!isset($params['alkoholiton'])) {
            $params['alkoholiton'] = 0;
        }
        $params['tyovaiheet'] = " ";

        if ($v->validate()) {
            $drink = new Drink(array(
                'nimi' => $params['nimi'],
                'tyyppi' => $params['tyyppi'],
                'alkoholiton' => $params['alkoholiton'],
                'lasi' => $params['lasi'],
                'kuvaus' => $params['kuvaus'],
                'tyovaiheet' => $params['tyovaiheet']
            ));

            $drink->save($ainekset);
            Redirect::to('/drinks/' . $drink->drinkki_id, array('message' => 'Resepti lisätty tietokantaan'));
        } else {
            View::make('drinks/addnew.html', array('errors' => $v->errors()));
        }
    }

}
