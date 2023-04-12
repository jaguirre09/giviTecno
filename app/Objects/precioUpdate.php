<?php

namespace App\Objects;

class precioUpdate
{


    public function __construct(
        private ?int   $IdCategoria,
        private int    $IdMarca,
        private float  $MarcaHomologada,
        private string $Categoria,
    )
    {
    }

    /**
     * @return int|null
     */
    public function getIdCategoria(): ?int
    {
        return $this->IdCategoria;
    }

    /**
     * @return int
     */
    public function getIdMarca(): int
    {
        return $this->IdMarca;
    }

    /**
     * @return float
     */
    public function getMarcaHomologada(): float
    {
        return $this->MarcaHomologada;
    }

    /**
     * @return string
     */
    public function getCategoria(): string
    {
        return $this->Categoria;
    }

}