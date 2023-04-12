<?php


namespace App\Http\Controllers\Componentes;


use App\Http\Apis\CurlPedidoApi;
use App\Models\EstadoVentaModel;
use App\Models\ProductosModel;
use App\Models\RegistroModel;
use App\Objects\AprovacionVenta;
use App\Objects\numCompra;
use App\Objects\RegistroUsers;
use mysql_xdevapi\Exception;
use Oneago\Arcturus\Core\Http\ViewResponse;
use function PHPUnit\Framework\never;


/**
 * Class EstadoSalesController
 */
class EstadoSalesController
{
    /**
     * @param string $view Template defined in router
     * @param array|null $customVars Vars defined in router
     * @return string|ViewResponse
     */
    public function index(string $view, ?array $customVars): string|ViewResponse
    {

        session_start();

        $productosModel = new ProductosModel();
        $curlPedidoApi = new CurlPedidoApi();
        $registroModel = new RegistroModel();

        if (empty($_POST['status'])) {
            header('Location: /Checkout?error=missing_status');
            exit;
        }


        $dataUser = $registroModel->list('', $_SESSION['login']['ids']);

        if (!$dataUser) {
            throw new Exception("No se encontró el usuario");
        }

        $aprovacionVenta = new AprovacionVenta(
            $_POST['status'],
            $_POST['id'],
            $_SESSION['login']['ids'],
            $_SESSION['idVenta']
        );
        $productosModel->updateEstado($aprovacionVenta);

        $productos = $productosModel->listProductSales($_SESSION['idVenta']);

        foreach ($productos as $producto) {
            $estado = $curlPedidoApi->index(
                [$dataUser[0]['Cliente'],
                    $dataUser[0]['documents'],
                    $dataUser[0]['phoneDelivery'],
                    $dataUser[0]['Direction'],
                    $dataUser[0]['StateId'],
                    $dataUser[0]['CountyId'],
                    'Pedido Prueba',
                    $producto['PartNum'],
                    $producto['NameProducts'],
                    $producto['precio'],
                    $producto['cantidad'],
                    $producto['Marks'],
                    'BCOTA'
                ]
            );
            $response_obj = json_decode($estado);
            if (!empty($response_obj)) {
                var_dump($response_obj);
                $numPedido = $response_obj[0]->pedido;
                $numValor = $response_obj[0]->valor;
                $productosModel->updateNumProduct(new numCompra($numValor, $numPedido, $_SESSION['idVenta'], $producto['id_producto']));
            }
        }

        unset($_SESSION['productos']);
        unset($_SESSION['idVenta']);


        $twigVars = [
            "body" => "Example page for basic php Oneago project. Start creating.",
            "alert" => $alert ?? null
        ];

        if ($customVars !== null) {
            $twigVars = array_merge($customVars, $twigVars);
        }
        return template($view, $twigVars);
    }
}