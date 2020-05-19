<?php


namespace Application\Middleware;


class AuthMiddleware extends Middleware {

  public function __invoke($request, $response, $next){

    if(!$this->container->auth->check()){
      // the user is not signed
      return $response->withRedirect($this->container->router->pathFor('auth.signin'));
    }

  $reponse = $next($request, $reponse);
  return $response;
}

}


 ?>
