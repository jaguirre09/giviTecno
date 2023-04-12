<?php

namespace App\Cron;

use App\Http\Apis\CurlApi;
use App\Models\ProductosModel;
use App\Objects\Productos;
use App\Objects\ProductosApiObjects;

class ProductosApi
{
    public function index(): array
    {
        $apiGet = new CurlApi();
        $productos = new ProductosModel();
        $response = $apiGet->index(['/api/WebApi/GetConsultarCatalogo/', 'GET']);
        $customers = json_decode($response, true);

        $existingProducts = $productos->list();
        $existingPartNums = array_column($existingProducts, 'PartNum');

        $apiProducts = array_slice($customers, 1, 200);
        $apiPartNums = array_column($apiProducts, 'PartNum');

        $partNumsToDelete = array_diff($existingPartNums, $apiPartNums);
        foreach ($existingProducts as $existingProduct) {
            if (in_array($existingProduct['PartNum'], $partNumsToDelete)) {
                $productos->delete($existingProduct['id']);
            }
        }

        foreach ($apiProducts as $apiProduct) {
            $newProduct = new Productos(
                null,
                $apiProduct['PartNum'],
                $apiProduct['Sku'],
                0,
                $apiProduct['Familia'],
                1,
                $apiProduct['Categoria'],
                $apiProduct['Name'],
                $apiProduct['Description'],
                0,
                $apiProduct['Marks'],
                $apiProduct['precio'],
                $apiProduct['Salesminprice'],
                $apiProduct['Salesmaxprice'],
                $apiProduct['precio'],
                $apiProduct['Marks'],
                $apiProduct['CurrencyDef'],
                $apiProduct['Quantity'],
                $apiProduct['TributariClassification'],
                $apiProduct['shipping'],
                $apiProduct['color'],
                '',
                $apiProduct['NombreImagen'],
                $apiProduct['Quantity'],
                $apiProduct['Quantity']
            );

            if (in_array($apiProduct['PartNum'], $existingPartNums)) {
                $productos->update(new ProductosApiObjects(
                    null,
                    $apiProduct['PartNum'],
                    $apiProduct['Sku'],
                    0,
                    $apiProduct['Familia'],
                    $apiProduct['Categoria'],
                    $apiProduct['Name'],
                    $apiProduct['Description'],
                    0,
                    $apiProduct['Marks'],
                    $apiProduct['Salesminprice'],
                    $apiProduct['Salesmaxprice'],
                    $apiProduct['precio'],
                    $apiProduct['Marks'],
                    $apiProduct['CurrencyDef'],
                    $apiProduct['Quantity'],
                    $apiProduct['TributariClassification'],
                    $apiProduct['shipping'],
                    $apiProduct['color'],
                    '',
                    $apiProduct['NombreImagen'],
                    $apiProduct['Quantity'],
                    $apiProduct['Quantity']
                ));
            } else {
                $productos->create($newProduct);
            }
        }

        return $customers;
    }
}