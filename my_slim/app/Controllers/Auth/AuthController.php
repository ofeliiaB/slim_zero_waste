<?php


namespace Application\Controllers\Auth;
use Application\Models\User;
use Application\Controllers\Controller;
use Respect\Validation\Validator as v;

class AuthController extends Controller
{

  public function getSignOut($request, $response){

    $this->auth->logout();

    return $response->withRedirect($this->router->pathFor('home'));

  }


  public function getSignIn($request, $response){

    return $this->container->view->render($response, 'auth/signin.twig');
  }
  public function postSignIn($request, $response){

    $auth = $this->auth->attempt(

      $request->getParam('email'),
      $request->getParam('password')
    );

    if(!$auth){
      // tell that auth failed
      return $response->withRedirect($this->router->pathFor('auth.signin'));
    }

    return $response->withRedirect($this->router->pathFor('home'));
    //var_dump($auth);
  }

public function getSignUp($request, $response){

//  return "Hello";
//var_dump($this->csrf->getTokenValueKey());
//var_dump($request->getAttribute('crsf_value'));

  return $this->container->view->render($response, 'auth/signup.twig');
}

public function postSignUp($request, $response){

  //
  // $validation = $this->container->validator->validate($request, [
  //   'email' => v::noWhiteSpace()->notEmpty(),
  //   'name' => v::noWhiteSpace()->notEmpty(),
  //   'password' => v::noWhiteSpace()->notEmpty(),
  // ]);

  $user = User::create([
    'email' => $request->getParam('email'),
    'name' => $request->getParam('name'),
    'password' => password_hash($request->getParam('password'), PASSWORD_DEFAULT),

  ]);

  $this->auth->attempt($user->email, $request->getParam('password'));

  return $response->withRedirect($this->container->router->pathFor('home'));

}



}

  ?>
