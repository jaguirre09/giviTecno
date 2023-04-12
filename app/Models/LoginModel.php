<?php


namespace App\Models;


use BadMethodCallException;
use Oneago\Arcturus\Core\Database\Connection;

class LoginModel extends Connection
{
    /**
     * @param int $id
     * @return object|null
     */
    public function get(int $id): ?object
    {
        // TODO: Implement get() method.
        throw new BadMethodCallException("Get not enable");
    }

    /**
     * @param string|null $search
     * @return array|null
     */
    public function list(string $search = null, string $emailUser = null, string $passUser = null): ?array
    {
        $back = [];
        $dbh = self::init();
        $pass = $passUser;
        $query = "SELECT * FROM usuario WHERE email = '$emailUser' AND password = '$pass'";

        $stmt = $dbh->prepare($query);
        $i = 0;
        if ($stmt->execute()) {

            while ($r = $stmt->fetch()) {
                $back[$i] = $r; // TODO: categories Array
                $i++;
            }
            return $back;
        }
    }

    /**
     * @param object $object
     * @return bool
     */
    public function create(object $object): bool
    {
        // TODO: Implement create() method.
        throw new BadMethodCallException("Create not enable");
    }

    /**
     * @param object $object
     * @return bool
     */
    public function update(object $object): bool
    {
        // TODO: Implement update() method.
        throw new BadMethodCallException("Update not enable");
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        // TODO: Implement delete() method.
        throw new BadMethodCallException("Delete not enable");
    }
}