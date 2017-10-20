<?php
/**
 * Created by PhpStorm.
 * User: gerry
 * Date: 8/3/17
 * Time: 12:10 PM
 */

$container = $app->getContainer();

$container['debug'] = function () {
    return true;
};

/**
 * @param $container
 * @return \Slim\Views\Twig
 */
$container['view'] = function ($container) {

    $dir = dirname(__DIR__);
    $view = new \Slim\Views\Twig($dir . '/app/views', [
        'cache' => false // $dir . '/tmp/cache',
    ]);

    // Instantiate and add Slim Specifig extansion
    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new \Slim\Views\TwigExtension($container['router'], $basePath));

    return $view;

};

/**
 * @param $container
 * @return PDO
 */
$container['db'] = function ($container) {
    $pdo = new PDO("mysql:dbname=myslim;host:localhost", "root", 'mysql');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    return $pdo;
};

/**
 * @param $container
 * @return Swift_Mailer
 */
$container['mailer'] = function ($container) {

    if ($container->debug) {
        $transport = Swift_SmtpTransport::newInstance('locahost', 1025);
    } else {
        $transport = Swift_MailTransport::newInstance();
    }

    $mailer = Swift_Mailer::newInstance($transport);

    return $mailer;
};
