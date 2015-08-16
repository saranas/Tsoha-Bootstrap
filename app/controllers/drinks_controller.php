<?php

require 'app/models/drink.php';

class DrinksController extends BaseController {

    public static function index() {
        $drinks = Drink::all();
        View::make('drinks/index.html', array('drinks' => $drinks));
    }

    public static function show($drinkki_id) {
        $drink = Drink::find($drinkki_id);
        View::make('drinks/show.html', array('drink' => $drink));
    }

    public static function addnew() {
        View::make('drinks/addnew.html');
    }

    public static function edit($drinkki_id) {
        $drink = Drink::find($drinkki_id);
        View::make('drinks/edit.html', array('attributes' => $drink));
    }

    public static function update($drinkki_id) {
        $params = $_POST;

        $v = new Valitron\Validator($_POST);
        $v->rule('required', 'nimi');
        $v->rule('lengthMin', 'nimi', 1);
        $v->rule('lengthMax', 'nimi', 50);
        $v->rule('lengthMin', 'tyyppi', 1);
        $v->rule('lengthMax', 'tyyppi', 30);
        $v->rule('lengthMin', 'lasi', 1);
        $v->rule('lengthMax', 'lasi', 30);

        $drink = new Drink(array(
            'nimi' => $params['nimi'],
            'tyyppi' => $params['tyyppi'],
            'lasi' => $params['lasi'],
            'alkoholiton' => $params['alkoholiton'],
            'kuvaus' => $params['kuvaus'],
            'tyovaiheet' => $params['tyovaiheet']
        ));

        if ($v->validate()) {
            $drink->update();
            Redirect::to('/drinks/' . $drink->drinkki_id, array('message' => 'Reseptiä muokattu onnistuneesti'));
        } else {
            View::make('drinks/edit.html', array('attributes' => $drink));
        }
    }

    public static function destroy($drinkki_id) {
        $drink = Drink::find($drinkki_id);
        $drink[0]->destroy($drinkki_id);
        Redirect::to('/drinks', array('message' => 'Juoma poistettu onnistuneesti'));
    }

    public static function store() {
        $params = $_POST;
        $v = new Valitron\Validator($_POST);
        $v->rule('required', 'nimi');
        $v->rule('lengthMin', 'nimi', 1);
        $v->rule('lengthMax', 'nimi', 50);
        $v->rule('lengthMin', 'tyyppi', 1);
        $v->rule('lengthMax', 'tyyppi', 30);
        $v->rule('lengthMin', 'lasi', 1);
        $v->rule('lengthMax', 'lasi', 30);

        if ($v->validate()) {
            $drink = new Drink(array(
                'nimi' => $params['nimi'],
                'tyyppi' => $params['tyyppi'],
                'alkoholiton' => $params['alkoholiton'],
                'lasi' => $params['lasi'],
                'kuvaus' => $params['kuvaus'],
                'tyovaiheet' => $params['tyovaiheet']
            ));

            $drink->save();
            Redirect::to('/drinks/' . $drink->drinkki_id, array('message' => 'Resepti lisätty tietokantaan'));
        } else {
            View::make('drinks/addnew.html', array('errors' => $v->errors()));
        }
    }

}
