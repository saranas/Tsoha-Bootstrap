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

}

