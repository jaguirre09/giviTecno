<?php


namespace App\Http\Controllers\Administrador;


use App\Models\AdministradorModel;
use Oneago\Arcturus\Core\Http\ViewResponse;


/**
 * Class EstadoProductoController
 */
class EstadoProductoController
{
    /**
     * @param string $view Template defined in router
     * @param array|null $customVars Vars defined in router
     * @return string|ViewResponse
     */
    public function index(string $view, ?array $customVars): string|ViewResponse
    {


        $admin = new AdministradorModel();

        $product = $admin->list();

        $twigVars = [
            "product" => $product
        ];

        if ($customVars !== null) {
            $twigVars = array_merge($customVars, $twigVars);
        }
        return template($view, $twigVars);
    }
}