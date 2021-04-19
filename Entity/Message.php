<?php

namespace App\Entity;

class Message {

    private ?int $id;
    private ?string $message;
    private ?string $username;
    private ?string $datePost;

    public function __construct(string $message = null, string $username = null, string $datePost = null) {
        $this->message = $message;
        $this->username = $username;
        $this->datePost = $datePost;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int{
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void{
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getMessage(): ?string{
        return $this->message;
    }

    /**
     * @param string|null $message
     */
    public function setMessage(?string $message): void{
        $this->message = $message;
    }

    /**
     * @return string|null
     */
    public function getUsername(): ?string{
        return $this->username;
    }

    /**
     * @param string|null $username
     */
    public function setUsername(?string $username): void{
        $this->username = $username;
    }

    /**
     * @return string|null
     */
    public function getDatePost(): ?string{
        return $this->datePost;
    }

    /**
     * @param string|null $datePost
     */
    public function setDatePost(?string $datePost): void{
        $this->datePost = $datePost;
    }

}