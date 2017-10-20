<?php
namespace App\Controllers;

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class Controller {

    private $container;

    /**
     * Controller constructor.
     * @param $container
     */
    public function __construct($container)
    {
        $this->container = $container;
    }

    public function render(Response $response, $file) {
        return $this->container->view->render($response, $file);
    }

    public function execute($query) {
        $sql = $this->container->db->prepare($query);
        $sql->execute();

        return $sql;
    }

    public function redirect(Response $response, $name) {
        return $response->redirect(302)->withHeader('Location', $this->router->pathFor($name));
    }

    public function __get($name)
    {
        // TODO: Implement __get() method.
        return $this->container->get($name);
    }

}