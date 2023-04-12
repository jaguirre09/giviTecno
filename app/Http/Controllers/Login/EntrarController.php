<?php


namespace App\Http\Controllers\Login;


use App\Models\InversionistaModel;
use App\Models\LoginModel;
use App\Models\RegistroModel;
use Oneago\Arcturus\Core\Http\ViewResponse;


/**
 * Class EntrarController
 */
class EntrarController
{

    /**
     * @param string $view Template defined in router
     * @param array|null $customVars Vars defined in router
     * @return string|ViewResponse
     */
    public function index(string $view, ?array $customVars): string|ViewResponse
    {

        if (!isset($_SESSION)) {
            session_start();
        }


        $login = new LoginModel();

        if (isset($_POST['userName']) && isset($_POST['userPass']) && isset($_POST['submitLogin'])) {

            $email = $_POST['userName'];
            $password = $_POST['userPass'];

            $users = $login->list("", $email, password_hash($password, PASSWORD_DEFAULT));


            foreach ($users as $data) {
                $_SESSION['login'] = [
                    "name" => $data['nombre'],
                    "email" => $data['email'],
                    "img" => $data['img_perfil'],
                    "nivel" => $data['nivel'],
                    "verify" => $data['StateProfile'],
                    "ids" => $data['id']
                ];
                $confirmed = $data['StateProfile'] == 0 ? 'Se envió un correo con la clave de activación' : 'Se confirmó la activación';
            }


            if (!isset($_SESSION['login']) || empty($_SESSION['login']['email']) || empty($_SESSION['login']['nivel'])) {
                $error = "Verifique la contraseña o usuario";
            } else {
                $session = $_SESSION['login']['nivel'];

                switch ($session) {
                    case 1:
                        header('Location: /Checkout');
                        break;
                    case 2:
                        header('Location: /Login');
                        break;
                    case 3:
                        header('Location: /Login2');
                        break;
                    case 4:
                        echo "<script>alert('Tu cuenta está bloqueada'); location.href = '/destroy'</script>";
                        break;
                    default:
                        $confirmed = "No tienes permisos para el ingreso";
                        break;
                }
            }

        }


        $twigVars = [
            "estado" => $confirmed ?? null,
            "error" => $error ?? null
        ];

        if ($customVars !== null) {
            $twigVars = array_merge($customVars, $twigVars);
        }
        return template($view, $twigVars);
    }
}