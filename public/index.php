<?php
/**
 * Created by PhpStorm.
 * User: gerry
 * Date: 8/2/17
 * Time: 10:16 PM
 */

use App\Controllers\PageControllers;

require '../vendor/autoload.php';

$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true,
    ]
]);

require('../app/containers.php');

$app->get('/', PageControllers::class . ':home');

$app->get('/contact', PageControllers::class . ':getContact')->setName('non-contact');

$app->post('/contact', PageControllers::class . ':postContact');

$app->run();

