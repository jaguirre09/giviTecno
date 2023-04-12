<?php


namespace App\Http\Controllers\Login;


use App\Http\Apis\EmailSendApi;
use App\Models\LoginModel;
use App\Models\RegistroModel;
use App\Objects\CodeUser;
use App\Objects\RegistroUsers;
use Oneago\Arcturus\Core\Http\ViewResponse;


/**
 * Class CodeLoginController
 */
class CodeLoginController
{
    /**
     * @param string $view Template defined in router
     * @param array|null $customVars Vars defined in router
     * @return string|ViewResponse
     */
    public function index(string $view, ?array $customVars): string|ViewResponse
    {

        session_start();


        $login = new LoginModel();
        $registro = new RegistroModel();
        $mail = new EmailSendApi();




        if (isset($_POST['registroUser'])) {
            $name = $_POST['nombreUser'];
            $phone = $_POST['phoneUser'];
            $email = $_POST['emailUser'];
            $pass = $_POST['passUser'];
            $passConfig = $_POST['configUser'];
            $passAleatory = rand(1000, 9999);

            if ($pass == $passConfig) {

                $registro->create(new RegistroUsers(null, $name, $phone, $email, password_hash($pass, PASSWORD_DEFAULT), $passAleatory, 0, 0, 0, 0,0,0, 0, 0, 0, 0, 0, 1));
                $mail->index([$passAleatory, $email]);

                $users = $login->list("", $email, password_hash($pass, PASSWORD_DEFAULT));

                foreach ($users as $data) {
                    $_SESSION['login'] = array(
                        "name" => $data['nombre'],
                        "email" => $data['email'],
                        "img" => $data['img_perfil'],
                        "nivel" => $data['nivel'],
                        "verify" => $data['StateProfile'],
                        "ids" => $data['id']
                    );

                    if ($data['StateProfile'] == 0) {
                        $confirmed = 'Se envio un correo con la clave de activacion';
                    } else {
                        $confirmed = 'Se confirmo la activación';
                    }
                }
            }else{
                echo "<script>location.href = '/Registro?alert=alert-user-incorrect'</script>";
            }
        }

        $valido = 0;
        $estado = "Ingrese el código";
        if (!empty($_POST['validar'])) {

            $validador = $_POST['validar'];
            $registro->update(new CodeUser("1", $validador, $_SESSION['login']['ids']));
            $valido = $registro->list('', $_SESSION['login']['ids']);

            if (isset($_POST['verify'])) {
                foreach ($valido as $datas) {
                    if ($datas['StateProfile'] == 0) {
                        $estado = "Incorrecto";
                    } else {
                        $estado = "Continuar";
                    }
                }
            }
        }










        $twigVars = [
            "body" => "Example page for basic php Oneago project. Start creating.",
            "session" => $_SESSION['login'] ?? null,
            "validar" => $valido,
            "estados" => $estado,
        ];

        if ($customVars !== null) {
            $twigVars = array_merge($customVars, $twigVars);
        }
        return template($view, $twigVars);
    }
}