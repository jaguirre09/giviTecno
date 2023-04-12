<?php


namespace App\Http\Controllers\Administrador;


use App\Models\ProductosModel;
use App\Objects\precioUpdate;
use App\Objects\Productos;
use Oneago\Arcturus\Core\Http\ViewResponse;
use PHPUnit\Util\Exception;


/**
 * Class PreciosProductoController
 */
class PreciosProductoController
{
    /**
     * @param string $view Template defined in router
     * @param array|null $customVars Vars defined in router
     * @return string|ViewResponse
     */
    public function index(string $view, ?array $customVars): string|ViewResponse
    {


        $categoryProducts = new ProductosModel();
        $category = $categoryProducts->list();

        foreach ($category as $row) {
            $categoryFil[] = $row['Categoria'] . ',' . $row['IdCategoria'];
        }


        $productos = new ProductosModel();
        $productos->list();


        if (isset($_POST['updatePrice'])) {
            $nombreCategoria = $_POST['updatePrice'];
            $porcentaje_a_subir = intval($_POST['nuevoValor']);


            $categoria = $categoryProducts->list("WHERE Categoria like '%$nombreCategoria%'");


            foreach ($categoria as $fila) {
                $valor_original = intval($fila['precio']);
                $nuevoPrecio = $valor_original * (1 + ($porcentaje_a_subir / 100));
                try {
                    $productos->updatePrice(new precioUpdate($porcentaje_a_subir, 0, $nuevoPrecio, $fila['id']));
                } catch (Exception) {
                    echo 'error';
                }
            }
            header('Location: /Precio-producto');
        }


        $twigVars = [
            "category" => array_unique($categoryFil ?? array()),
        ];

        if ($customVars !== null) {
            $twigVars = array_merge($customVars, $twigVars);
        }
        return template($view, $twigVars);
    }
}