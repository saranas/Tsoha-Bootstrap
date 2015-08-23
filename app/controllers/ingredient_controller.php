<?php

require 'app/models/drink.php';
require 'app/models/ingredient.php';

class IngredientController extends BaseController {
    
    public static function showIngredient($aines_id) {
        $aines = Aines::find($aines_id);
        View::make('ingredients/show_ingredient.html', array('aines' => $aines));
    }
}

