<?php


namespace App\Http\Controllers;


use App\Http\Apis\CurlPedidoApi;
use App\Http\Controllers\Header;
use App\Cron\ProductosApi;
use App\Models\ProductosModel;
use App\Models\RegistroModel;
use Oneago\Arcturus\Core\Http\ViewResponse;


/**
 * Class WelcomeController is a example class, you can delete or use as a model example for your app
 */
class WelcomeController
{
    public function index(string $view, array $customVars = null): ViewResponse
    {


        $menu = new  Header\HeaderController();
        $category = $menu->category();

        $product = new ProductosModel();

        $prod = $product->list('WHERE Descuento = "GRAVADO"');

        $marcas = $product->list();

        foreach ($marcas as $row) {
            $mar[] = $row['Marks'];
        }

        if (isset($mar)) {

            $marca = array_unique($mar ?? null);
        }


        if (isset($_POST['marcas'])) {
            $marc = $_POST['marcas'];
            $destacado = $product->list("WHERE Marks = '$marc'");

            $destacar = array_slice($destacado, 0, 8);
        } else {
            $destacado = $product->list();
            $destacar = array_slice($destacado, 0, 8);
        }


        $slider = array_slice($prod, 1, 200000);


        //$apic = new productosApi();
        //$apic->index();





        $twigVars = [
            "title" => "Welcome!!",
            "category" => $category,
            "slider" => $slider ?? null,
            "marca" => $marca ?? null,
            "destacar" => $destacar,
        ];


        if ($customVars !== null) {
            $twigVars = array_merge($customVars, $twigVars);
        }
        return template($view, $twigVars);
    }


}
