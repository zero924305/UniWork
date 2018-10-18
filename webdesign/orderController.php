<?php

class orderController
{

  public function __construct(Basket $basket)
  {
    $this->basket = $basket;
  }
  public function index(Request $request, Response $response, Twig $view)
  {
    $this->basket->refresh();

    return $view->render($response, 'order/index.twig');

  }
}

?>
