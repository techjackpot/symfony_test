<?php

namespace App\Entity;

use App\ValueObject\Point;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LocationRepository")
 */
class Location
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(type="integer",options={"default":0})
     */
    private $employeesCount = 0;

    /**
     * @ORM\Column(type="point")
     *
     * @var Point
     */
    private $point;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getEmployeesCount(): ?int
    {
        return $this->employeesCount;
    }

    public function setEmployeesCount(int $employeesCount): self
    {
        $this->employeesCount = $employeesCount;

        return $this;
    }

    /**
     * @param Point $point
     */
    public function setPoint(Point $point)
    {
        $this->point = $point;
    }

    /**
     * @return Point
     */
    public function getPoint()
    {
        return $this->point;
    }
}
