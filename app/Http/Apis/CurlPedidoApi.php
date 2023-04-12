<?php /** @noinspection PhpInconsistentReturnPointsInspection */


namespace App\Http\Apis;


class CurlPedidoApi
{
    /**
     * @param array|null $customVars Custom vars from router
     * @return string return data to front app
     * @noinspection PhpInconsistentReturnPointsInspection
     */
    public function index(?array $customVars): string
    {
        $url = 'https://shopcommerce.mps.com.co:7071/api/WebApi/RealizarPedido';
        $headers = array(
            'Content-Type: application/json',
            "Authorization: Bearer " . $_ENV['TOKEN_API'],
            'Cookie: .AspNet.Cookies=-8et5K3m6AUynAVcP_p0oWJNIBSyiangXgQ6fZaZkPX-XK3nAvCLEEwFQF1Il9WGaM43aYtRmZhjm1gUp1Sz5dd-5OzGWkMKeaErd_iRu-3U1jWt-8FlVBKZ4wM5vLK2YMzZBpAwk8z7kOZdisKqkwQyU4bAVL92niHiYD4k_7oWIE7Y_yWb-GEn7CWqeyNixX5ktbQTgAjq09QIH8WFCImFt54EMl5pGBSOb8Ix9VwbaraHT-V4RII69EEifv8ITTPyhdx1wPouGizZJHsSMV5apf7H5lmm3-EuNtDwV7y_c1XLpaGkY66vg8RjFiF2fSkv6d91FRWk409monlEk0i_IMVBWAtvKqsvEmWafmacHTsT8qc6MIw0dTTz3fH4BAoBR4NOkJVFvqICLxQOvbUxxY3_-1um4WMWuMxmYg9D59Yb2aPD8JOFtBSMHPQZ-9Nf9zo_0ftQzSpU5n169mCjeEBR10lpFtKGDg5a-bM'
        );

        $data = array(
            'listaPedido' => array(
                array(
                    'AccountNum' => '79580718',
                    'NombreClienteEntrega' => "$customVars[0]",
                    'ClienteEntrega' => intval($customVars[1]),
                    'TelefonoEntrega' => "$customVars[2]",
                    'DireccionEntrega' => "$customVars[3]",
                    'StateId' => "$customVars[4]",
                    'CountyId' => "$customVars[5]",
                    'RecogerEnSitio' => 0,
                    'EntregaUsuarioFinal' => 1,
                    'dlvTerm' => '',
                    'dlvmode' => '',
                    'Observaciones' => $customVars[6],
                    'listaPedidoDetalle' => array(
                        array(
                            'PartNum' => "$customVars[7]",
                            'Producto' => "$customVars[8]",
                            'Precio' => intval($customVars[9]),
                            'Cantidad' => intval($customVars[10]),
                            'Marks' => $customVars[11],
                            'Bodega' => $customVars[12]
                        )
                    )
                )
            )
        );

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => $headers
        ));

        $response = curl_exec($curl);

        if ($response === false) {
            echo 'Error: ' . curl_error($curl);
        } else {
            $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            if ($http_code >= 200 && $http_code < 300) {
                return $response;
            } else {
                return 'Error: HTTP response code ' . $http_code;
            }
        }

        curl_close($curl);

    }
}