<?php

namespace App\Objects;

class AprovacionVenta
{

    public function __construct(
        private string $status,
        private string $id_venta,
        private int $id_usuario,
        private ?int $id,


    )
    {
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

    /**
     * @return int
     */
    public function getIdUsuario(): int
    {
        return $this->id_usuario;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }






}