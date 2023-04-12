<?php


namespace App\Http\Controllers\Componentes;


use App\Http\Apis\CurlPedidoApi;
use App\Models\ProductosModel;
use App\Models\RegistroModel;
use App\Objects\AprovacionVenta;
use App\Objects\numCompra;
use App\Objects\PoductosVentaProduct;
use App\Objects\ProductosVenta;
use App\Objects\RegistroUsers;
use App\Objects\UpdateUser;
use Exception;
use Oneago\Arcturus\Core\Http\ViewResponse;


/**
 * Class CheckauntController
 */



class CheckauntController
{
    /**
     * @param string $view Template defined in router
     * @param array|null $customVars Vars defined in router
     * @return string|ViewResponse
     */
    public function index(string $view, ?array $customVars): string|ViewResponse
    {


        session_start();

        if (empty($_SESSION['login'])) {
            header('Location: /Entrar');
            exit();
        }
        if (empty($_SESSION['productos'])) {
            header('Location: /Card');
        }


        $usuario = $_SESSION['login'];


        $product = new ProductosModel();
        $user = new RegistroModel();


        if (isset($_SESSION['productos'])) {


            $suma = array_column($_SESSION['productos'], 'precioTotal');
            $fecha = date('Y,m,d h:m:s');
            $total = array_sum($suma);
            if ($total && $fecha) {
                $product->createVenta(new ProductosVenta(null, $_SESSION['login']['ids'], $total, $fecha, 'Por Aprobar', 'Denegado'));
                $_SESSION['idVenta'] = $ids = $product->idCreatedVenta;
                foreach ($_SESSION['productos'] as $row) {
                    $product->createSalesProduct(new PoductosVentaProduct(null, $ids, $row['id'], $row['cantidades'], $row['precio'], $row['precioTotal'],0 ,'Sin definir'));
                }
                //unset($_SESSION['productos']);
                $alert = "La compra se ha realizado correctamente.";
            } else {
                $alert = "Falta información para realizar la compra.";
            }

        } else {
            $alert = "No hay productos en el carrito.";
        }


        if (isset($_POST['sendContact'])) {
            $NombreClient = $_POST['NombreClient'] ?? '';
            $Identification = $_POST['Identification'] ?? '';
            $Phone = $_POST['Phone'] ?? '';
            $Direction = $_POST['Direction'] ?? '';
            $Departments = $_POST['Departments'] ?? '';
            $Cities = $_POST['Cities'] ?? '';
            if ($NombreClient && $Identification && $Phone && $Direction && $Departments && $Cities) {
                try {
                    $product->updateUser(new UpdateUser('900414786', $NombreClient, $Identification, $Phone, $Direction, $Departments, $Cities, 1, 1, $_SESSION['login']['ids']));
                    $alert = "Información del usuario se ha actualizado correctamente.";
                } catch (Exception $e) {
                    $alert = "Se ha producido un error al actualizar la información del usuario: " . $e->getMessage();
                }
            } else {
                $alert = "Falta información para actualizar el usuario.";
            }
        }


        $users = $user->list('', $_SESSION['login']['ids']);

        if (isset($_GET['editar'])) {
            $alerta = $_GET['editar'] ?? 0;
        }



        $twigVars = [
            "body" => "Example page for basic php Oneago project. Start creating.",
            'detalle' => $_SESSION['productos'] ?? null,
            'usuario' => $usuario,
            'alerta' => $alert ?? '',
            'user' => $users,
            'da' => $alerta ?? 0
        ];

        if ($customVars !== null) {
            $twigVars = array_merge($customVars, $twigVars);
        }
        return template($view, $twigVars);
    }
}