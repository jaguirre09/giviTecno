<?php

namespace App\Objects;

class CodeUser
{


    /**
     * @param int $StateProfile
     * @param int $CodePassword
     * @param int|null $id
     */

    public function __construct(
        private int  $StateProfile,
        private int  $CodePassword,
        private ?int $id,


    )
    {
    }

    /**
     * @return int
     */
    public function getStateProfile(): int
    {
        return $this->StateProfile;
    }

    /**
     * @return int
     */
    public function getCodePassword(): int
    {
        return $this->CodePassword;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }



}