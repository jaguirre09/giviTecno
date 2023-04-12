<?php


namespace App\Http\Controllers\Card;


use App\Http\Apis\CurlApi;

use App\Http\Controllers\Header\HeaderController;
use App\Models\ProductosModel;
use App\Objects\Productos;
use Oneago\Arcturus\Core\Http\ViewResponse;


/**
 * Class BoxController
 */
class BoxController
{

    private function paginate($total, $perPage = 50 ?? null): array
    {
        $page = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;

        if ($page <= 0){
            $page = 1;
        }
        $start = ($page - 1) * $perPage;
        $pages = ceil($total / $perPage);

        return [
            'page' => $page,
            'start' => $start,
            'perPage' => $perPage,
            'pages' => $pages,
        ];
    }


    /**
     * @param string $view Template defined in router
     * @param array|null $customVars Vars defined in router
     * @return string|ViewResponse
     */
    public function index(string $view, ?array $customVars): string|ViewResponse
    {
        session_start();


        $product = new ProductosModel();

        $total = count($product->list());

        $pagination = $this->paginate($total);


        if (isset($_POST['searchAvance'])){
            $info = $product->list();
        }else{
            $info = $product->list("LIMIT {$pagination['start']},{$pagination['perPage']}");
        }


        $mar = array_column($info, 'Marks');
        $cat = array_column($info, 'Categoria');

        $category = array_unique($cat);
        $marca = array_unique($mar);

        $twigVars = [
            'title' => 'Welcome!!',
            'Productos' => $info,
            'category' => $category,
            'detalle' => $filtrado ?? null,
            'marcas' => $marca,
            'paginas' => $total,
            'pagination' => $pagination['pages'],
            'maxmin' => $pagination['page'],
        ];


        if ($customVars !== null) {
            $twigVars = array_merge($customVars, $twigVars);
        }

        return template($view, $twigVars);
    }
}