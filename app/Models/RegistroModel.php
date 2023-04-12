<?php


namespace App\Models;


use BadMethodCallException;
use Oneago\Arcturus\Core\Database\Connection;

class RegistroModel extends Connection
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
     * @param int|null $id
     * @return array|null
     */
    public function list(string $search = null, int $id = null): ?array
    {
        $back = [];
        $dbh = self::init();
        $query = "SELECT * FROM usuario WHERE id = $id";

        $stmt = $dbh->prepare($query);
        $i = 0;
        if ($stmt->execute()) {

            while ($r = $stmt->fetch()) {
                $back[$i] = $r; // TODO: categories Array
                $i++;
            }
            return $back;
        } else {
            return array(['error']);
        }
    }

    /**
     * @param string|null $search
     * @return array|null
     */
    public function verifyListUser(string $search = null): ?array
    {
        $back = [];
        $dbh = self::init();
        $query = "SELECT $search FROM usuario";

        $stmt = $dbh->prepare($query);
        $i = 0;
        if ($stmt->execute()) {

            while ($r = $stmt->fetch()) {
                $back[$i] = $r; // TODO: categories Array
                $i++;
            }
            return $back;
        } else {
            return array(['error']);
        }
    }

    /**
     * @param object $object
     * @return bool
     */
    public function create(object $object): bool
    {
        $dbh = self::init();
        $stmt = $dbh->prepare(
            'INSERT INTO usuario (`nombre`, `telefono`, `email`, `password`, `CodePassword`, `StateProfile`, `img_perfil`, `Account`, `Cliente`, `documents`,  `phoneDelivery`,`Direction`, `StateId`, `CountyId`, `Recoger`, `EntregaFinal`, `nivel`) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);'
        );
        if (
            !$stmt->execute([
                $object->getNombre(),
                $object->getTelefono(),
                $object->getEmail(),
                $object->getPassword(),
                $object->getCodePassword(),
                $object->getStateProfile(),
                $object->getImgPerfil(),
                $object->getAccount(),
                $object->getCliente(),
                $object->getDocuments(),
                $object->getPhoneDelivery(),
                $object->getDirection(),
                $object->getStateId(),
                $object->getCountyId(),
                $object->getRecoger(),
                $object->getEntregaFinal(),
                $object->getNivel(),

            ])
        ) {
            $this->errorDetails =
                'Has found an error -> ' . implode($dbh->errorInfo());
            return false;
        }
        $this->idCreatedVenta = $dbh->lastInsertId();
        return true;
    }

    /**
     * @param object $object
     * @return bool
     */
    public function update(object $object): bool
    {
        $stmt = self::init()->prepare("UPDATE usuario SET StateProfile = ? WHERE CodePassword = ? and id = ? ");
        if ($stmt->execute([
            $object->getStateProfile(),
            $object->getCodePassword(),
            $object->getId(),

        ])) {
            return true;
        }
        $this->errorDetails = "Has found an error -> " . implode($stmt->errorInfo());
        return false;
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