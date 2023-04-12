<?php


use App\Models\ProductosModel;
use Oneago\Arcturus\Core\Router\Request;
use Oneago\Arcturus\Core\Router\Router;

$app = new Router;

$app->get('/', function (Request $request, array $args) {
    return view('welcome');
});

$app->post('/marcas', function (Request $request, array $args) {

    $product = new ProductosModel();

    if (isset($_POST['marcas'])) {
        $marc = $_POST['marcas'];
        $destacado = $product->list("WHERE Marks = '$marc'");

        return array_slice($destacado, 0, 8);
    } else {
        $destacado = $product->list();
        return array_slice($destacado, 0, 8);
    }


});

$app->any('/Productos', function (Request $request, array $args) {
    return view('box', 'card');
});

$app->get('/Detalle', function (Request $request, array $args) {
    return view('detalleProduct', 'componentes');
});

$app->get('/Card', function (Request $request, array $args) {
    return view('cardProduct', 'componentes');
});

$app->any('/Checkout', function (Request $request, array $args) {
    return view('Checkaunt', 'componentes');
});



$app->any('/Transaction-status', function (Request $request, array $args) {
    return view('EstadoSales', 'componentes');
});



$app->any('/Entrar', function (Request $request, array $args) {
    return view('Entrar', 'login');
});


$app->any('/Registro', function (Request $request, array $args) {
    return view('Registro', 'login');
});

$app->any('/GenerateCode', function (Request $request, array $args) {
    return view('CodeLogin', 'login');
});


//Administrador


$app->get('/Home-admin', function (Request $request, array $args) {
    return view('home', 'administrador');
});

$app->get('/Estado-producto', function (Request $request, array $args) {
    return view('EstadoProducto', 'administrador');
});

$app->any('/Precio-producto', function (Request $request, array $args) {
    return view('PreciosProducto', 'administrador');
});


$app->any('/Google', function (Request $request, array $args) {


    $redirecUri = 'http://localhost:8080/';


    $client = new \Google_Client();

    $client->setClientId($_ENV['CLIENTID']);
    $client->setClientSecret($_ENV['CLIENTSECRET']);
    $client->setRedirectUri($redirecUri);
    $client->addScope("email");
    $client->addScope("profile");


    if (isset($_GET['code'])) {
        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
        $client->setAccessToken($token['access_token']);

        // get profile info
        $google_oauth = new Google_Service_Oauth2($client);
        $google_account_info = $google_oauth->userinfo->get();
        $email = $google_account_info->email;
        $name = $google_account_info->name;

        // now you can use this profile info to create account in your website and make user logged in.
    }

    var_dump($name ?? null);
    echo $client->createAuthUrl();
});


$app->post('/Compra', function () {
    session_start();
    $_SESSION['productos'] = $_POST['car'];
    echo 1;
});

$app->post('/Search', function () {
    session_start();
    $_SESSION['search'] = $_POST['product'];
    echo 1;
});


$app->post('/DeleteCart', function () {
    session_start();


    return "<script> alert('Listo')</script>";

});


$app->get('/Cerrar-cuenta', function (Request $request, array $args) {
    session_start();
    session_destroy();
    return view('welcome');
});


$app->get('/test/{var}/', function (Request $request, array $args) {
    return $args['var'];
});

$app->post('/some/route', function (Request $request, array $args) {

});

// API use suggestion
$app->post('/api/{r}', function (Request $request, array $args) {
    header("Content-Type: application/json");
    if (empty($args['r'])) {
        http_response_code(400);
        echo "{\"error\": \"Resource not set. api format is /api/RESOURCE\"}";
        die();
    }
    return api($args['r']);
});

$app->setCustom404Page(function (Request $request) {
    return view('Welcome');
});

$app->run();