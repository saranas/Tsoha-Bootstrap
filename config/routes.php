<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });
  
  $routes->get('/drinks_list', function() {
    HelloWorldController::drinks_list();
  });
  
  $routes->get('/drink_show', function() {
    HelloWorldController::drink_show();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
