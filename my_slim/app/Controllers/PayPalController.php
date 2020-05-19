<?php


namespace Application\Controllers;
use Application\Models\User;
use Slim\Views\Twig as View;

class PayPalController extends Controller
{


  public function index($request, $response){

   //
   // $user = User::find(2);
   // var_dump($user);
    return $this->container->view->render($response, 'paypal.twig');
  }
}

  ?>
