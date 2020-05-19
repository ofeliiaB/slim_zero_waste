<?php


namespace Application\Middleware;


class GuestMiddleware extends Middleware {

  public function __invoke($request, $response, $next){

    if($this->container->auth->check()){
      return $response->withRedirect($this->container->router->pathFor('home'));
    }

  $reponse = $next($request, $reponse);
  return $response;
}

}


 ?>
