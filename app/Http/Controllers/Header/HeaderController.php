<?php


namespace App\Http\Controllers\Header;


use App\Http\Apis\CurlApi;
use App\Models\ProductosModel;
use Oneago\Arcturus\Core\Http\ViewResponse;


/**
 * Class HeaderController
 */
class HeaderController
{
    /**
     * @param string $view Template defined in router
     * @param array|null $customVars Vars defined in router
     * @return string|ViewResponse
     */
    public function index(string $view, ?array $customVars): string|ViewResponse
    {



        if (isset($_SESSION['login'])) {
            $usuario = $_SESSION['login'];
        }
        $twigVars = [
            "body" => "Example page for basic php Oneago project. Start creating.",
            'usuario' => $usuario ?? null
        ];

        if ($customVars !== null) {
            $twigVars = array_merge($customVars, $twigVars);
        }
        return template($view, $twigVars);
    }


    public function category(): array
    {
        $categoryProducts = new ProductosModel();
        $category = $categoryProducts->list();

        foreach ($category as $row){
            $categoryFil[] = $row['Categoria'];
        }

        return array_unique($categoryFil ?? array());
    }


}