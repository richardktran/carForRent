<?php

namespace Khoatran\CarForRent\Request;

use Khoatran\CarForRent\Exception\ValidationException;

class CarRequest
{
    private string $name;
    private string $description;
    private string $type;
    private ?string $image;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string|null
     */
    public function getImage(): ?string
    {
        return $this->image ?? "";
    }

    /**
     * @param string|null $image
     */
    public function setImage(?string $image): void
    {
        $this->image = $image;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @param int $price
     */
    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getBrand(): string
    {
        return $this->brand;
    }

    /**
     * @param string $brand
     */
    public function setBrand(string $brand): void
    {
        $this->brand = $brand;
    }

    /**
     * @return int
     */
    public function getProductionYear(): int
    {
        return $this->productionYear;
    }

    /**
     * @param int $productionYear
     */
    public function setProductionYear(int $productionYear): void
    {
        $this->productionYear = $productionYear;
    }

    /**
     * @return int
     */
    public function getOwnerId(): int
    {
        return $this->ownerId;
    }

    /**
     * @param int $ownerId
     */
    public function setOwnerId(int $ownerId): void
    {
        $this->ownerId = $ownerId;
    }

    private int $price;
    private string $brand;
    private int $productionYear;
    private int $ownerId;

    public function fromArray(array $requestBody): self
    {
        $this->setName($requestBody['name']);
        $this->setDescription($requestBody['description']);
        $this->setType($requestBody['type']);
        $this->setImage($requestBody['image']);
        $this->setPrice($requestBody['price']);
        $this->setBrand($requestBody['brand']);
        $this->setProductionYear($requestBody['production_year']);
        $this->setOwnerId($requestBody['owner_id']);
        return $this;
    }


    public function validate(): bool|array
    {
        $errors = [];
        if (empty($this->getName())) {
            $errors[] = 'Name is required';
        }
        if (empty($this->getDescription())) {
            $errors[] = 'Description is required';
        }
        if (empty($this->getType())) {
            $errors[] = 'Type is required';
        }
        if (empty($this->getImage())) {
            $errors[] = 'Image is required';
        }
        if (empty($this->getPrice())) {
            $errors[] = 'Price is required';
        }
        if (empty($this->getBrand())) {
            $errors[] = 'Brand is required';
        }
        if (empty($this->getProductionYear())) {
            $errors[] = 'Production year is required';
        }
        if (empty($errors)) {
            return true;
        }
        return $errors;
    }


}