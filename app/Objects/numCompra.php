<?php

namespace App\Objects;

class numCompra
{

    /**
     * @param string $numValor
     * @param string $numProduct
     * @param int $id_venta
     * @param int $id_producto
     */


    public function __construct(

        private string $numValor,
        private string $numProduct,
        private int $id_venta,
         private int $id_producto
    )
    {
    }

    /**
     * @return string
     */
    public function getNumValor(): string
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





}