<?php


namespace App\Http\Apis;


use App\Models\ProductosModel;
use App\Objects\Productos;

class CurlApi
{
    /**
     * @param array|null $customVars Custom vars from router
     * @return bool|string return data to front app
     */
    public function index(?array $customVars = null): bool|string
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://shopcommerce.mps.com.co:7071' . $customVars[0],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $customVars[1],
            CURLOPT_POSTFIELDS => 'username=pruebas%40g2mcol.co&password=Visualklm21&grant_type=password',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $_ENV['TOKEN_API'],
                'Content-Type: application/x-www-form-urlencoded',
                'Cookie: .AspNet.Cookies=vMqzhZ_Q-sGMA7_D5FEEHR7HMbl2plv5DbGO2xxae_Rt3aafX_Cq1bCwVl6osGl0GPtyJFp9o82DDSXy5L6pW2vsBVN32QGajkPo8dJx_rMFE5ZofUEaKdyWSMXMBeEnmt4KFTp5QpHSDVNGOaD3x-gQO0CLE5PMqcrZsl6aOBsJxl_aEiTmQc-KMvGFrVRuKHKlyKedDqkkojSm9UE3PWjm0jPSTM7dUZFUdktoI_XCbViktD-RuV12ZAcLmNN13912cPossi3xbFEbhHYwOtGxXODNIm8-skeLnJVsjhxJ6QtljpQ2gYnmGoJMTTgKwQS9q6Jhb9hYaLpVZWNyR1qOQtRU637puE4fixqL52WG-e6-YKpnteQbFwRt3bkzWtoplCqPlM2HdBn9U9dG3tFcCCqUGgMuwyqw9Mr27-BON3Lug7iAfZFtqymP8dvTjqesW3T1WboVmqz-Rq1UJK1ku7tAoWDb0TGflWkcCAc'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);


        //var_dump($response);
        return $response;


    }


}