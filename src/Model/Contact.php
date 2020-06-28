<?php

namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;

class Contact
{
    /**
    * @Assert\Length(
     *      min = 2,
     *      minMessage = "votre prénom doit avoir plus de 2 caractères",
     * )
     * @Assert\Type("string")
     * @Assert\NotBlank
     *
     */
    private $firstname;

    /**
     * @Assert\Length(
     *      min = 2,
     *      minMessage = "votre nom doit avoir plus de 2 caractères")
     * @Assert\Type("string")
     * @Assert\NotBlank
     */
    private $lastname;

     /**
     * @Assert\Type("string")
     * @Assert\NotBlank
     * @Assert\Email(
     *     message = "Votre email n'est pas valide."
     * )
     */
    private $email;

    /**
     *@Assert\NotBlank
     *@Assert\Type("string")
     */
    private $message;

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     * @return Contact
     */
    public function setFirstname(string $firstname): Contact
    {
        $this->firstname = $firstname;
        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     * @return Contact
     */
    public function setLastname(string $lastname): Contact
    {
        $this->lastname = $lastname;
        return $this;
    }
    /**
     * @return string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Contact
     */
    public function setEmail(string $email): Contact
    {
        $this->email = $email;
        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @return Contact
     */
    public function setMessage(string $message): Contact
    {
        $this->message = $message;
        return $this;
    }
}
