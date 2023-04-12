<?php

namespace App\Objects;

class UpdateUser
{


    /**
     * @param string $Account
     * @param string $Cliente
     * @param string $documents
     * @param string $phoneDelivery
     * @param string $Direction
     * @param string $StateId
     * @param string $CountyId
     * @param int $Recoger
     * @param int $EntregaFinal
     * @param int $id
     */

    public function __construct(
        private string $Account,
        private string $Cliente,
        private string $documents,
        private string $phoneDelivery,
        private string $Direction,
        private string $StateId,
        private string $CountyId,
        private int    $Recoger,
        private int    $EntregaFinal,
        private int    $id,
    )
    {
    }

    /**
     * @return string
     */
    public function getAccount(): string
    {
        return $this->Account;
    }

    /**
     * @return string
     */
    public function getCliente(): string
    {
        return $this->Cliente;
    }

    /**
     * @return string
     */
    public function getDocuments(): string
    {
        return $this->documents;
    }

    /**
     * @return string
     */
    public function getPhoneDelivery(): string
    {
        return $this->phoneDelivery;
    }

    /**
     * @return string
     */
    public function getDirection(): string
    {
        return $this->Direction;
    }

    /**
     * @return string
     */
    public function getStateId(): string
    {
        return $this->StateId;
    }

    /**
     * @return string
     */
    public function getCountyId(): string
    {
        return $this->CountyId;
    }

    /**
     * @return int
     */
    public function getRecoger(): int
    {
        return $this->Recoger;
    }

    /**
     * @return int
     */
    public function getEntregaFinal(): int
    {
        return $this->EntregaFinal;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }



}