<?php
require 'app/models/drink.php';
class DrinksController extends BaseController {
    
    public static function index() {        
        $drinks = Drink::all();
        View::make('drinks/index.html', array('drinks' => $drinks));
    }
    
    public static function show() {        
        $drinks = Drink::all();
        View::make('drinks/show.html', array('drinks' => $drinks));
    }
    
    public static function addnew() {        
        View::make('drinks/addnew.html');
    }
    
    public static function store() {
        $params = $_POST;
        $drink = new Drink(array(
            'nimi' => $params['nimi'],
            'tyyppi' => $params['tyyppi'],
            'lasi' => $params['lasi'],
            'alkoholiton' => $params['alkoholiton'],
            'kuvaus' => $params['kuvaus'],
            'tyovaiheet' => $params['tyovaiheet']
        ));
        
        $drink->save();
        Redirect::to('/drinks/' . $drink->drinkki_id, array('message' => 'Resepti lisätty tietokantaan'));
    }

}

