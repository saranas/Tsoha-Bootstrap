<?php

require 'app/models/drink.php';
require 'app/models/ingredient.php';

class IngredientController extends BaseController {

    public static function listIngredients() {
        $ainekset = Aines::all();
        View::make('ingredients/list_ingredients.html', array('ainekset' => $ainekset));
    }

    public static function showIngredient($aines_id) {
        $aines = Aines::find($aines_id);
        View::make('ingredients/show_ingredient.html', array('aines' => $aines));
    }

    public static function newIngredient() {
        View::make('ingredients/new_ingredient.html');
    }

    public static function editIngredient($aines_id) {
        $aines = Aines::find($aines_id);
        View::make('ingredients/edit_ingredient.html', array('attributes' => $aines));
    }

    public static function store() {
        $params = $_POST;

        $v = new Valitron\Validator($_POST);
        $v->rule('required', 'nimi')->message('{field} pitää antaa')->label('Nimi');
        $v->rule('required', 'alkpitoisuus')->message('{field} pitää antaa')->label('Alkoholipitoisuus');
        $v->rule('lengthMax', 'nimi', 50)->message('{field} ei saa olla yli 50 merkkiä pitkä')->label('Nimi');
        $v->rule('numeric', 'alkpitoisuus')->message('{field} pitää olla numeerinen kokonaisluku tai desimaaliluku erotettuna pisteellä');
        $v->rule('min', 'alkpitoisuus', 0)->message('{field} pitää olla 0-100')->label('Alkoholipitoisuus');
        $v->rule('max', 'alkpitoisuus', 100)->message('{field} pitää olla 0-100')->label('Alkoholipitoisuus');

        $aines = new Aines(array(
            'nimi' => $params['nimi'],
            'alkpitoisuus' => $params['alkpitoisuus']
        ));

        if ($v->validate()) {
            $aines->save();
            Redirect::to('/ingredients/' . $aines->aines_id, array('message' => 'Aines lisätty tietokantaan'));
        } else {
            View::make('ingredients/new_ingredient.html', array('errors' => $v->errors(), 'attributes' => $aines));
        }
    }

    public static function update($aines_id) {
        $params = $_POST;

        $v = new Valitron\Validator($_POST);
        $v->rule('required', 'nimi')->message('{field} pitää antaa')->label('Nimi');
        $v->rule('required', 'alkpitoisuus')->message('{field} pitää antaa')->label('Alkoholipitoisuus');
        $v->rule('lengthMax', 'nimi', 50)->message('{field} ei saa olla yli 50 merkkiä pitkä')->label('Nimi');
        $v->rule('numeric', 'alkpitoisuus')->message('{field} pitää olla numeerinen kokonaisluku tai desimaaliluku erotettuna pisteellä');
        $v->rule('min', 'alkpitoisuus', 0)->message('{field} pitää olla 0-100')->label('Alkoholipitoisuus');
        $v->rule('max', 'alkpitoisuus', 100)->message('{field} pitää olla 0-100')->label('Alkoholipitoisuus');

        $aines = new Aines(array(
            'nimi' => $params['nimi'],
            'alkpitoisuus' => $params['alkpitoisuus']
        ));

        if ($v->validate()) {
            $aines->update($aines_id);
            Redirect::to('/ingredients/' . $aines->aines_id, array('message' => 'Ainesta muokattu onnistuneesti'));
        } else {
            $aines->aines_id = $aines_id;
            View::make('ingredients/edit_ingredient.html', array('errors' => $v->errors(), 'attributes' => $aines));
        }
    }

    public static function destroy($aines_id) {
        $aines = Aines::find($aines_id);
        $aines->destroy($aines_id);
        Redirect::to('/ingredients', array('message' => 'Aines poistettu onnistuneesti'));
    }

}
