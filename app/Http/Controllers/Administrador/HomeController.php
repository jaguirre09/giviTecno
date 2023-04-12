<?php


namespace App\Http\Controllers\Administrador;


use Oneago\Arcturus\Core\Http\ViewResponse;


/**
 * Class HomeController
 */
class HomeController
{
    /**
     * @param string $view Template defined in router
     * @param array|null $customVars Vars defined in router
     * @return string|ViewResponse
     */
    public function index(string $view, ?array $customVars): string|ViewResponse
    {
        $twigVars = [
            "body" => "Example page for basic php Oneago project. Start creating."
        ];

        if ($customVars !== null) {
            $twigVars = array_merge($customVars, $twigVars);
        }
        return template($view, $twigVars);
    }
}