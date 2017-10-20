<?php
namespace App\Controllers;

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

/**
 * Class PageControllers
 * @package App\Controllers
 */
class PageControllers extends Controller {

    public function home(Request $request, Response $response) {
        $data['name'] = "Gerry";

        $data['table'] = $this->execute('SELECT * FROM book WHERE id=1');
        $data['table']->fetchAll();

        return $this->render($response, 'page/home.twig', $data);
    }

    /**
     * @param Request $request
     * @param Response $response
     */
    public function getContact(Request $request, Response $response) {
        $this->render($response, 'page/contact.twig');
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return mixed
     */
    public function postContact(Request $request, Response $response) {

        $message = \Swift_Message::newInstance("Website Message")
            ->addFrom([$request->getParams('email') => $request->getParams('name')])
            ->setTo('permana.gerry@gmail.com')
            ->setBody("Komplain Custemer : 
                {$request->getParams('message')}"
            );

        $this->mailer->send($message);

        return $this->redirect($response, 'non-contact');
    }

}