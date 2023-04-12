<?php


namespace App\Models;


use BadMethodCallException;
use Oneago\Arcturus\Core\Database\Connection;

class AdministradorModel extends Connection
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
    public function list(string $search = null): ?array
    {

        $back = [];
        $dbh = self::init();
        $query = "SELECT productos_venta.id,
                         productos_venta.cantidad, 
                         productos_venta.precio,
                         productos_venta.subtotal,
                         productos_venta.numValor,
                         productos_venta.numProduct,
                         ventas.total,
                         ventas.fecha,
                         ventas.status,
                         ventas.id_venta,
                         productos.NameProducts
                        FROM productos_venta inner join ventas on productos_venta.id_venta = ventas.id inner join productos on productos.id = productos_venta.id_producto";

        $stmt = $dbh->prepare($query);
        $i = 0;
        if ($stmt->execute()) {

            while ($r = $stmt->fetch()) {
                $back[$i] = $r; // TODO: categories Array
                $i++;
            }
            return $back;
        } else {
            return array(['1']);
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