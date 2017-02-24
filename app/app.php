<?php
date_default_timezone_set('America/Los_Angeles');

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/Stylist.php';

$app = new Silex\Application();

$server = 'mysql:host=localhost:8889;dbname=hair_salon';
$username = 'root';
$password = 'root';
$DB = new PDO($server, $username, $password);

$app->register(new Silex\Provider\TwigServiceProvider(), [
    'twig.path' => __DIR__ . '/../views/'
]);

$app->get('/', function() use ($app) {
    return $app->redirect('/stylists');
});

$app->get('/stylists', function() use ($app) {
    $stylists = Stylist::getAll();
    return $app['twig']->render('stylists.html.twig', [
        'stylists' => $stylists
    ]);
});

$app->post('/stylists', function() use ($app) {
    $name = $_POST['name'];
    $new_stylist = new Stylist($name);
    $new_stylist->save();
    return $app->redirect('/stylists');
});

return $app;
?>
