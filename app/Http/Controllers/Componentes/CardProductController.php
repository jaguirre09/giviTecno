<?php


namespace App\Http\Controllers\Componentes;


use App\Http\Apis\CurlApi;
use App\Models\ProductosModel;
use Oneago\Arcturus\Core\Http\ViewResponse;


/**
 * Class CardProductController
 */
class CardProductController
{
    /**
     * @param string $view Template defined in router
     * @param array|null $customVars Vars defined in router
     * @return string|ViewResponse
     */
    public function index(string $view, ?array $customVars): string|ViewResponse
    {

        session_start();


        $cartProducts = new ProductosModel();


        if (!isset($_SESSION['card'])) {
            if (isset($_GET['cart'])) {

                $cart = $cartProducts->detalleProduct($_GET['id']);


                foreach ($cart as $product) {
                    $_SESSION['card'][] = $product;
                    echo "<script>location.href = '/Card'</script>";
                }


            }
        } else {
            if (isset($_GET['id'])) {
                $cart = $cartProducts->detalleProduct($_GET['id']);

                foreach ($cart as $products) {

                    if (isset($_SESSION['card'])){
                        $_SESSION['card'][] = $products;

                        echo "<script>location.href = '/Card'</script>";
                    }else{
                        echo "No hay productos en el carrito";

                    }


                }
            }
        }



        if (isset($_GET['delete'])) {
            unset($_SESSION['valor']);
            if (isset($_SESSION['card'])) {
                $arreglo = $_SESSION['card'];
                $count = 0;
                foreach ($arreglo as $resul) {
                    $count++;
                    if ($resul['PartNum'] != $_GET['delete']) {
                        $_SESSION['valor'][] = $resul;
                        unset($_SESSION['card']);
                        $_SESSION['card'] = $_SESSION['valor'];
                    } else {
                        if ($count == 1) {
                            unset($_SESSION['card']);
                        }
                    }
                }
            } else {
                header('Location: /Card');
            }
        }

        $twigVars = [
            "body" => "Example page for basic php Oneago project. Start creating.",
            "detalle" => $_SESSION['card'] ?? null
        ];

        if ($customVars !== null) {
            $twigVars = array_merge($customVars, $twigVars);
        }
        return template($view, $twigVars);
    }
}