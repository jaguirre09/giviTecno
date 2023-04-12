<?php

namespace App\Objects;

class RegistroUsers
{

    /**
     * @param int|null $id
     * @param string $nombre
     * @param string $telefono
     * @param string $email
     * @param string $password
     * @param int $CodePassword
     * @param int $StateProfile
     * @param string $img_perfil
     * @param string $Account
     * @param string $Cliente
     * @param string $documents
     * @param string $phoneDelivery
     * @param string $Direction
     * @param string $StateId
     * @param string $CountyId
     * @param int $Recoger
     * @param int $EntregaFinal
     * @param string $nivel
     */



    public function __construct(
        private ?int $id,
        private string $nombre,
        private string $telefono,
        private string $email,
        private string $password,
        private int $CodePassword,
        private int $StateProfile,
        private string $img_perfil,
        private string $Account,
        private string $Cliente,
        private string $documents,
        private string $phoneDelivery,
        private string $Direction,
        private string $StateId,
        private string $CountyId,
        private int $Recoger,
        private int $EntregaFinal,
        private string $nivel,
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
     * @return string
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }

    /**
     * @return string
     */
    public function getTelefono(): string
    {
        return $this->telefono;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return int
     */
    public function getCodePassword(): int
    {
        return $this->CodePassword;
    }

    /**
     * @return int
     */
    public function getStateProfile(): int
    {
        return $this->StateProfile;
    }

    /**
     * @return string
     */
    public function getImgPerfil(): string
    {
        return $this->img_perfil;
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
     * @return string
     */
    public function getNivel(): string
    {
        return $this->nivel;
    }






}