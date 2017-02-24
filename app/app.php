<?php
date_default_timezone_set('America/Los_Angeles');

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/Stylist.php';
require_once __DIR__ . '/../src/Client.php';

$app = new Silex\Application();

$server = 'mysql:host=localhost:8889;dbname=hair_salon';
$username = 'root';
$password = 'root';
$DB = new PDO($server, $username, $password);

use Symfony\Component\HttpFoundation\Request;
Request::enableHttpMethodParameterOverride();

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

$app->get('/stylists/{id}', function($id) use ($app) {
    $stylist = Stylist::find($id);
    $clients = $stylist->getClients();
    return $app['twig']->render('stylist.html.twig', [
        'stylist' => $stylist,
        'clients' => $clients
    ]);
});

$app->patch('/stylists/{id}', function($id) use ($app) {
    $stylist = Stylist::find($id);
    $new_name = $_POST['name'];
    $stylist->update($new_name);
    return $app->redirect("/stylists/{$id}");
});

$app->delete('/stylists/{id}', function($id) use ($app) {
    $stylist = Stylist::find($id);
    $stylist->delete();
    return $app->redirect('/stylists');
});

$app->get('/stylists/{id}/edit', function($id) use ($app) {
    $stylist = Stylist::find($id);
    return $app['twig']->render('stylist_edit.html.twig', [
        'stylist' => $stylist
    ]);
});

$app->post('/stylists/{id}/clients', function($id) use ($app) {
    $name = $_POST['name'];
    $new_client = new Client($name, $id);
    $new_client->save();
    return $app->redirect("/stylists/{$id}");
});

$app->patch('/stylists/{stylist_id}/clients/{id}', function($stylist_id, $id) use ($app) {
    $new_name = $_POST['name'];
    $client = Client::find($id);
    $client->update($new_name);
    return $app->redirect("/stylists/{$stylist_id}");
});

$app->delete('/stylists/{stylist_id}/clients/{id}', function($stylist_id, $id) use ($app) {
    $client = Client::find($id);
    $client->delete();
    return $app->redirect("/stylists/{$stylist_id}");
});

$app->get('/stylists/{stylist_id}/clients/{id}/edit', function($stylist_id, $id) use ($app) {
    $stylist = Stylist::find($stylist_id);
    $client = Client::find($id);
    return $app['twig']->render('client_edit.html.twig', [
        'client' => $client,
        'stylist' => $stylist
    ]);
});

return $app;
?>
