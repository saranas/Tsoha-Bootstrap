<?php

  $routes->get('/', function() {
    HelloWorldController::index();
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
