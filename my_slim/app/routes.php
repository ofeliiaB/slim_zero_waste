<?php

use Application\Middleware\AuthMiddleware;
use Application\Middleware\GuestMiddleware;

$app->get('/', 'HomeController:index')->setName('home');


// $app->group('', function(){
  $app->get('/auth/signout', 'AuthController:getSignOut')->setName('auth.signout');

  $app->get('/meals', 'MealsController:index')->setName('meals');
  $app->get('/cart', 'CartController:index')->setName('cart');
  $app->get('/settings', 'SettingsController:index')->setName('settings');
  $app->get('/paypal', 'PayPalController:index')->setName('paypal');

  $app->get('/meals/{id}', 'MealsController:show');
  $app->post('/meals', 'MealsController:store');
  $app->delete('/meals{id}', 'MealsController:destroy');
  $app->put('/meals{id}', 'MealsController:update');
  $app->get('add-to-cart/{id}', 'MealsController:addToCart')->setName('add-to-cart');

  $app->delete('remove-from-cart', 'MealsController:remove');

//
// })->add(new AuthMiddleware($container));

// $app->group('', function(){
  $app->get('/auth/signup', 'AuthController:getSignUp')->setName('auth.signup');

  $app->post('/auth/signup', 'AuthController:postSignUp');

  $app->get('/auth/signin', 'AuthController:getSignIn')->setName('auth.signin');

  $app->post('/auth/signin', 'AuthController:postSignIn');
// })->add(new GuestMiddleware($container));




 ?>
