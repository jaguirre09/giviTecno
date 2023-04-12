<?php


namespace App\Models;


use BadMethodCallException;
use Oneago\Arcturus\Core\Database\Connection;

class ProductosModel extends Connection
{
    public ?int $idCreatedVenta = null;


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
        $query = "SELECT * FROM productos $search";

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
     * @param int|null $id
     * @return array|null
     */
    public function listProductSales(int $id = null): ?array
    {
        $back = [];
        $dbh = self::init();
        $query = "SELECT * FROM productos INNER JOIN productos_venta on productos.id = productos_venta.id_producto WHERE productos_venta.id_venta = $id ";

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
     * @param string|null $PartNum
     * @return array|null
     */
    public function detalleProduct(string $PartNum = null): ?array
    {
        $back = [];
        $dbh = self::init();
        $query = "SELECT * FROM productos WHERE id = $PartNum";

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
        $dbh = self::init();
        $stmt = $dbh->prepare(
            'INSERT INTO productos (`PartNum`, `Sku`, `IdFamilia`, `Familia`, `IdCategoria`, `Categoria`, `NameProducts`, `Description`, `IdMarca`, `Marks`, `MarcaHomologada`, `Salesminprice`, `Salesmaxprice`, `precio`, `CurrencyDef`, `Quantity`, `TributariClassification`, `Descuento`, `shipping`, `color`, `ListaProductosBodega`, `Imagenes`, `Nuevo`, `slug`) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? ,? ,? ,? ,?);'
        );
        if (
            !$stmt->execute([
                $object->getPartNum(),
                $object->getSku(),
                $object->getIdFamilia(),
                $object->getFamilia(),
                $object->getIdCategoria(),
                $object->getCategoria(),
                $object->getNameProducts(),
                $object->getDescription(),
                $object->getIdMarca(),
                $object->getMarks(),
                $object->getMarcaHomologada(),
                $object->getSalesminprice(),
                $object->getSalesmaxprice(),
                $object->getPrecio(),
                $object->getCurrencyDef(),
                $object->getQuantity(),
                $object->getTributariClassification(),
                $object->getDescuento(),
                $object->getShipping(),
                $object->getColor(),
                $object->getListaProductosBodega(),
                $object->getImagenes(),
                $object->getNuevo(),
                $object->getSlug(),
            ])
        ) {
            $this->errorDetails =
                'Has found an error -> ' . implode($dbh->errorInfo());
            return false;
        }
        $this->idCreated = $dbh->lastInsertId();
        return true;
    }


    /**
     * @param object $object
     * @return bool
     */
    public function createVenta(object $object): bool
    {
        $dbh = self::init();
        $stmt = $dbh->prepare(
            'INSERT INTO ventas (`id_usuario`, `total`, `fecha`,`status`,`id_venta`) VALUES ( ?, ?, ?, ?, ?);'
        );
        if (
            !$stmt->execute([
                $object->getIdUsuario(),
                $object->getTota(),
                $object->getFecha(),
                $object->getStatus(),
                $object->getIdVenta(),

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
    public function updateEstado(object $object): bool
    {

        $stmt = self::init()->prepare("UPDATE ventas SET status = ?, id_venta = ? WHERE id_usuario = ? AND id= ? ");
        if ($stmt->execute([
            $object->getStatus(),
            $object->getIdVenta(),
            $object->getIdUsuario(),
            $object->getId(),
        ])) {
            return true;
        }
        $this->errorDetails = "Has found an error -> " . implode($stmt->errorInfo());
        return false;

    }

    /**
     * @param object $object
     * @return bool
     */
    public function updateNumProduct(object $object): bool
    {

        $stmt = self::init()->prepare("UPDATE productos_venta SET numValor = ?, numProduct = ? WHERE id_venta = ? AND id_producto = ? ");
        if ($stmt->execute([
            $object->getNumValor(),
            $object->getNumProduct(),
            $object->getIdVenta(),
            $object->getIdProducto(),
        ])) {
            return true;
        }
        $this->errorDetails = "Has found an error -> " . implode($stmt->errorInfo());
        return false;

    }


    /**
     * @param object $object
     * @return bool
     */
    public function createSalesProduct(object $object): bool
    {
        $dbh = self::init();
        $stmt = $dbh->prepare(
            'INSERT INTO productos_venta (`id_venta`, `id_producto`, `cantidad`, `precio`, `subtotal`, `numValor`, `numProduct`) VALUES ( ?, ?, ?, ?, ?, ?, ?);'
        );
        if (
            !$stmt->execute([
                $object->getIdVenta(),
                $object->getIdProducto(),
                $object->getCantidad(),
                $object->getPrecio(),
                $object->getSubtotal(),
                $object->getNumValor(),
                $object->getNumProduct(),

            ])
        ) {
            $this->errorDetails =
                'Has found an error -> ' . implode($dbh->errorInfo());
            return false;
        }
        $this->idCreated = $dbh->lastInsertId();
        return true;
    }

    /**
     * @param object $object
     * @return bool
     */
    public function update(object $object): bool
    {
        $stmt = self::init()->prepare("UPDATE productos SET Sku = ?, IdFamilia = ?, Familia = ?, `Categoria`= ?, `NameProducts`= ?, `Description`= ?, `IdMarca`= ?, `Marks`= ?, `Salesminprice`= ?, `Salesmaxprice`= ?, `precio`= ?, `CurrencyDef`= ?, `Quantity`= ?, `TributariClassification`= ?, `Descuento`= ?, `shipping`= ?, `color`= ?, `ListaProductosBodega`= ?, `Imagenes`= ?, `Nuevo`= ?, `slug`= ? WHERE PartNum= ? ");
        if ($stmt->execute([
            $object->getSku(),
            $object->getIdFamilia(),
            $object->getFamilia(),
            $object->getCategoria(),
            $object->getNameProducts(),
            $object->getDescription(),
            $object->getIdMarca(),
            $object->getMarks(),
            $object->getSalesminprice(),
            $object->getSalesmaxprice(),
            $object->getPrecio(),
            $object->getCurrencyDef(),
            $object->getQuantity(),
            $object->getTributariClassification(),
            $object->getDescuento(),
            $object->getShipping(),
            $object->getColor(),
            $object->getListaProductosBodega(),
            $object->getImagenes(),
            $object->getNuevo(),
            $object->getSlug(),
            $object->getPartNum(),
        ])) {
            return true;
        }
        $this->errorDetails = "Has found an error -> " . implode($stmt->errorInfo());
        return false;
    }

    /**
     * @param object $object
     * @return bool
     */
    public function updatePrice(object $object): bool
    {
        $stmt = self::init()->prepare("UPDATE productos SET  IdCategoria = ?,  IdMarca= ?, MarcaHomologada = ? WHERE id = ? ");
        if ($stmt->execute([
            $object->getIdCategoria(),
            $object->getIdMarca(),
            $object->getMarcaHomologada(),
            $object->getCategoria(),

        ])) {
            return true;
        }
        $this->errorDetails = "Has found an error -> " . implode($stmt->errorInfo());
        return false;
    }

    /**
     * @param object $object
     * @return bool
     */
    public function updateUser(object $object): bool
    {
        $stmt = self::init()->prepare("UPDATE usuario SET Account = ?, Cliente = ?, documents = ?, `phoneDelivery`= ?, `Direction`= ?, `StateId`= ?, `CountyId`= ?, `Recoger`= ?, `EntregaFinal`= ? WHERE id= ? ");
        if ($stmt->execute([
            $object->getAccount(),
            $object->getCliente(),
            $object->getDocuments(),
            $object->getPhoneDelivery(),
            $object->getDirection(),
            $object->getStateId(),
            $object->getCountyId(),
            $object->getRecoger(),
            $object->getEntregaFinal(),
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
        $dbh = self::init();
        $stmt = $dbh->prepare("DELETE FROM productos WHERE id = ?;");
        if ($stmt->execute([$id])) {
            $stmt->fetch();
            return true;
        }
        $this->errorDetails = "Has found an error -> " . implode($stmt->errorInfo());
        return false;
    }
}