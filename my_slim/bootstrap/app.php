<?php

session_start();

require __DIR__ . '/../vendor/autoload.php';



$app = new \Slim\App([
  'settings' => [
    'displayErrorDetails' => true,
    'db' => [
      'driver' => 'mysql',
      'host' => '127.0.0.1',
      'port' => '8889',
      'database' => 'zerowasteslim',
      'username' => 'root',
      'password' => 'root',
      'charset' => 'utf8',
      'collation' => 'utf8_unicode_ci',
      'prefix' => ''
    ]
  ]

]);

 $container = $app->getContainer();
//
 $capsule = new \Illuminate\Database\Capsule\Manager;
 $capsule->addConnection($container['settings']['db']);
 //$capsule-setAsGlobal();
$capsule->bootEloquent();

$container['db'] = function($container) use ($capsule){
  return $capsule;
};

$container['auth'] = function($container) {
  return new \Application\Auth\Auth;
};
//
$container['view'] = function ($container){
  $view = new \Slim\Views\Twig(__DIR__ . '/../resources/views', [
// in Production change false to the cache directory to store the views
    'cache' => false,
  ]);

  $view->addExtension(new \Slim\Views\TwigExtension(
    $container->router,
    $container->request->getUri()
  ));

  $view->getEnvironment()->addGlobal('auth', [
    'check' => $container->auth->check(),
    'user' => $container->auth->user(),
  ]);

  return $view;
};




//Validor is not complete

// $container['validator'] = function($container){
//   return new Application\Validation\Validator;
// };

$container['HomeController'] = function($container){
  return new \Application\Controllers\HomeController($container);
};

$container['AuthController'] = function($container){
  return new \Application\Controllers\Auth\AuthController($container);
};

$container['MealsController'] = function($container){
  return new \Application\Controllers\MealsController($container);
};

$container['CartController'] = function($container){
  return new \Application\Controllers\CartController($container);
};

$container['SettingsController'] = function($container){
  return new \Application\Controllers\SettingsController($container);
};

$container['PayPalController'] = function($container){
  return new \Application\Controllers\PayPalController($container);
};

$container['csrf'] = function($container) {
  return new \Slim\Csrf\Guard;
};



// $app->add(new \App\Middleware\CsrfMiddleware($contaner));
// $app->add($contaner->csrf);

require __DIR__ . '/../app/routes.php';


 ?>
