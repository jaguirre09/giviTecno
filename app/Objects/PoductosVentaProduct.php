<?php

namespace App\Objects;

class PoductosVentaProduct
{

    /**
     * @param int|null $id
     * @param int $id_venta
     * @param int $id_producto
     * @param string $cantidad
     * @param string $precio
     * @param string $subtotal
     * @param int $numValor
     * @param string $numProduct
     */


    public function __construct(
        private ?int   $id,
        private int    $id_venta,
        private int $id_producto,
        private string $cantidad,
        private string $precio,
        private string $subtotal,
        private int $numValor,
        private string $numProduct,
    )
    {
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getIdVenta(): int
    {
        return $this->id_venta;
    }

    /**
     * @return int
     */
    public function getIdProducto(): int
    {
        return $this->id_producto;
    }

    /**
     * @return string
     */
    public function getCantidad(): string
    {
        return $this->cantidad;
    }

    /**
     * @return string
     */
    public function getPrecio(): string
    {
        return $this->precio;
    }

    /**
     * @return string
     */
    public function getSubtotal(): string
    {
        return $this->subtotal;
    }

    /**
     * @return int
     */
    public function getNumValor(): int
    {
        return $this->numValor;
    }

    /**
     * @return string
     */
    public function getNumProduct(): string
    {
        return $this->numProduct;
    }



}