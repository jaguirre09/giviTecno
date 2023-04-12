<?php


namespace App\Http\Controllers\Componentes;


use App\Http\Controllers\Header\HeaderController;
use App\Models\ProductosModel;
use Oneago\Arcturus\Core\Http\ViewResponse;


/**
 * Class DetalleProductController
 */
class DetalleProductController
{
    /**
     * @param string $view Template defined in router
     * @param array|null $customVars Vars defined in router
     * @return string|ViewResponse
     */
    public function index(string $view, ?array $customVars): string|ViewResponse
    {

        session_start();

        $menu = new HeaderController();
        $category = $menu->category();
        $productDetalle = new ProductosModel();

        if (!empty($_GET['id'])) {
            $detallare = array_key_exists('detalle', $_GET) ? $productDetalle->detalleProduct($_GET['id']) : null;
            $detallar = $detallare ?? null;
        }else{
            $detallar = 1;
        }

        $twigVars = [
            "body" => "Example page for basic php Oneago project. Start creating.",
            "detalle" => $detallar,
            "category" => $category
        ];

        if ($customVars !== null) {
            $twigVars = array_merge($customVars, $twigVars);
        }
        return template($view, $twigVars);
    }
}