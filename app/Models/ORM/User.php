<?php


namespace App\Models\ORM;


class User
{
    private int $id;
    private string $user;
    private string $email;

    /**
     * @param int $id
     * @param string $user
     * @param string $email
     */
    public function __construct(int $id, string $user, string $email)
    {
        $this->id = $id;
        $this->user = $user;
        $this->email = $email;
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
    public function getUser(): string
    {
        return $this->user;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }
}