<?php

namespace App\Model;

use DateTime;
use Symfony\Component\Validator\Constraints as Assert;

class Booking
{

    /**
    * @Assert\Length(
     *      min = 2,
     *      max = 50,
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
     *      minMessage = "votre Nome doit avoir plus de 2 caractères")
     * @Assert\Type("string")
     * @Assert\NotBlank
     */
    private $lastname;


    /**
     * @Assert\Length(
     *      min = 2,
     *      minMessage = "votre adresse doit avoir plus de 2 caractères")
     * @Assert\Type("string")
     * @Assert\NotBlank
     */
    private $address;


    /**
     * @Assert\Type("string")
     * @Assert\NotBlank
     * @Assert\Email(
     *     message = "Vote email n'est pas valide."
     * )
     */
    private $email;


    /**
     *@Assert\NotBlank
     *@Assert\Type("integer")
     *@Assert\Choice({0, 1, 2, 3, 4, 5, 6})
     */
    private $adults;

    /**
     * @Assert\Type("integer")
     * @Assert\NotBlank
     *@Assert\Choice({0, 1, 2, 3, 4})
     */
    private $kids;

    /**
     * @Assert\NotBlank
     * @Assert\Type("\DateTime")
     */
    private $arrive;

    /**
     * @Assert\NotBlank
     * @Assert\Type("\DateTime")
     */
    private $departure;

    public function __construct()
    {
        $this->arrive= new DateTime();
        $this->departure= new DateTime();
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     * @return Booking
     */
    public function setFirstname(string $firstname): Booking
    {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     * @return Booking
     */
    public function setLastname(string $lastname): Booking
    {
        $this->lastname = $lastname;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return Booking
     */
    public function setAddress(string $address): Booking
    {
        $this->address = $address;
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
     * @return Booking
     */
    public function setEmail(string $email): Booking
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return int
     */
    public function getAdults(): ?int
    {
        return $this->adults;
    }

    /**
     * @param int $adults
     * @return Booking
     */
    public function setAdults(int $adults): Booking
    {
        $this->adults = $adults;
        return $this;
    }

    /**
     * @return int
     */
    public function getKids(): ?int
    {
        return $this->kids;
    }

    /**
     * @param int $kids
     * @return Booking
     */
    public function setKids(int $kids): Booking
    {
        $this->kids = $kids;
        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getArrive(): ?DateTime
    {
        return $this->arrive;
    }

    /**
     * @return Booking
     */
    public function setArrive(DateTime $arrive): Booking
    {
        $this->arrive = $arrive;
        return $this;
    }

    public function getDeparture():?DateTime
    {
        return $this->departure;
    }

    /**
     * @return Booking
     */
    public function setDeparture(DateTime $departure): Booking
    {
        $this->departure = $departure;
        return $this;
    }
}
