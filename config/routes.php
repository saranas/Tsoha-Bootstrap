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
    DrinksController::create();
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
  
  $routes->get('/drinks_list', function() {
    HelloWorldController::drinks_list();
  });
  
  $routes->get('/drinks_show', function() {
    HelloWorldController::drinks_show();
  });
  
  $routes->get('/drinks_edit', function() {
    HelloWorldController::drinks_edit();
  });
  
  $routes->get('/login', function() {
    HelloWorldController::login();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
