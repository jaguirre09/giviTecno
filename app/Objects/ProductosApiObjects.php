<?php

namespace App\Objects;

use PhpParser\Node\Expr\Cast\Double;

class ProductosApiObjects
{
    /**
     * @param int|null $id
     * @param string $PartNum
     * @param string $Sku
     * @param int $IdFamilia
     * @param string $Familia
     * @param string $Categoria
     * @param string $NameProducts
     * @param string $Description
     * @param int $IdMarca
     * @param string $Marks
     * @param string $Salesminprice
     * @param string $Salesmaxprice
     * @param string $precio
     * @param string $CurrencyDef
     * @param string $Quantity
     * @param string $TributariClassification
     * @param string $Descuento
     * @param string $shipping
     * @param string $color
     * @param string $ListaProductosBodega
     * @param string $Imagenes
     * @param string $Nuevo
     * @param string $slug
     */

    public function __construct(
        private ?int   $id,
        private string $PartNum,
        private string $Sku,
        private int    $IdFamilia,
        private string $Familia,
        private string $Categoria,
        private string $NameProducts,
        private string $Description,
        private int    $IdMarca,
        private string $Marks,
        private string $Salesminprice,
        private string $Salesmaxprice,
        private string $precio,
        private string $CurrencyDef,
        private string $Quantity,
        private string $TributariClassification,
        private string $Descuento,
        private string $shipping,
        private string $color,
        private string $ListaProductosBodega,
        private string $Imagenes,
        private string $Nuevo,
        private string $slug,

    )
    {

    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getPartNum(): string
    {
        return $this->PartNum;
    }

    /**
     * @return string
     */
    public function getSku(): string
    {
        return $this->Sku;
    }

    /**
     * @return int
     */
    public function getIdFamilia(): int
    {
        return $this->IdFamilia;
    }

    /**
     * @return string
     */
    public function getFamilia(): string
    {
        return $this->Familia;
    }


    /**
     * @return string
     */
    public function getCategoria(): string
    {
        return $this->Categoria;
    }

    /**
     * @return string
     */
    public function getNameProducts(): string
    {
        return $this->NameProducts;
    }


    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->Description;
    }

    /**
     * @return int
     */
    public function getIdMarca(): int
    {
        return $this->IdMarca;
    }

    /**
     * @return string
     */
    public function getMarks(): string
    {
        return $this->Marks;
    }


    /**
     * @return string
     */
    public function getSalesminprice(): string
    {
        return $this->Salesminprice;
    }

    /**
     * @return string
     */
    public function getSalesmaxprice(): string
    {
        return $this->Salesmaxprice;
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
    public function getCurrencyDef(): string
    {
        return $this->CurrencyDef;
    }

    /**
     * @return string
     */
    public function getQuantity(): string
    {
        return $this->Quantity;
    }

    /**
     * @return string
     */
    public function getTributariClassification(): string
    {
        return $this->TributariClassification;
    }

    /**
     * @return string
     */
    public function getDescuento(): string
    {
        return $this->Descuento;
    }

    /**
     * @return string
     */
    public function getShipping(): string
    {
        return $this->shipping;
    }

    /**
     * @return string
     */
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * @return string
     */
    public function getListaProductosBodega(): string
    {
        return $this->ListaProductosBodega;
    }

    /**
     * @return string
     */
    public function getImagenes(): string
    {
        return $this->Imagenes;
    }

    /**
     * @return string
     */
    public function getNuevo(): string
    {
        return $this->Nuevo;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }


}