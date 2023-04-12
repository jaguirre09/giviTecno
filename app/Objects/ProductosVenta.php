<?php

namespace App\Objects;

class ProductosVenta
{

    /**
     * @param int|null $id
     * @param int $idUsuario
     * @param string $tota
     * @param string $fecha
     * @param string $status
     * @param string $id_venta
     */


    public function __construct(
        private ?int   $id,
        private int    $idUsuario,
        private string $tota,
        private string $fecha,
        private string $status,
        private string $id_venta,
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
    public function getIdUsuario(): int
    {
        return $this->idUsuario;
    }

    /**
     * @return string
     */
    public function getTota(): string
    {
        return $this->tota;
    }

    /**
     * @return string
     */
    public function getFecha(): string
    {
        return $this->fecha;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getIdVenta(): string
    {
        return $this->id_venta;
    }



}