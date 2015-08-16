<?php

  $routes->get('/', function() {
    DrinksController::index();
  });
  
  $routes->get('/drinks', function() {
    DrinksController::index();
  });
  
  $routes->post('/drinks', function() {
    DrinksController::store();
  });
  
  $routes->get('/addnew', function() {
    DrinksController::addnew();
  });
  
  $routes->get('/show', function() {
    DrinksController::show();
  });
  
   $routes->get('/addnew', function() {
    DrinksController::addnew();
  });
  
  $routes->get('/drinks/:drinkki_id', function($drinkki_id) {
    DrinksController::show($drinkki_id);
  });
  
  $routes->get('/drinks/:drinkki_id/edit', function($drinkki_id) {
    DrinksController::edit($drinkki_id);
  });
  
  $routes->post('/drinks/:drinkki_id/edit', function($drinkki_id) {
    DrinksController::update($drinkki_id);
  });
  
  $routes->post('/drinks/:drinkki_id/destroy', function($drinkki_id) {
    DrinksController::destroy($drinkki_id);
  });
  
  $routes->get('/drinks_list', function() {
    HelloWorldController::drinks_list();
  });
  
  $routes->get('/drinks_show', function() {
    HelloWorldController::drinks_show();
  });
  
  $routes->get('/drinks_edit', function() {
    HelloWorldController::drinks_edit();
  });
  
  $routes->get('/drinks_login', function() {
    HelloWorldController::drinks_login();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
  
  $routes->get('/login', function() {
    UserController::login();
  });
  
   $routes->post('/login', function() {
    UserController::handle_login();
  });
