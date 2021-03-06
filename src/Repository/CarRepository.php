<?php

namespace Khoatran\CarForRent\Repository;

use Khoatran\CarForRent\Model\Car;
use Khoatran\CarForRent\Request\CarRequest;
use PDO;

class CarRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct();
    }

    public function findAll(int $offset, int $limit): array
    {
        $sql = "SELECT * FROM cars LIMIT :off, :lim";
        $statement = $this->getConnection()->prepare($sql);
        $statement->bindValue(':off', $offset, PDO::PARAM_INT);
        $statement->bindValue(':lim', $limit, PDO::PARAM_INT);
        $statement->execute();
        $rows = $statement->fetchAll();
        $cars = [];
        foreach ($rows as $row) {
            $car = new Car();
            $car->setId($row['id']);
            $car->setName($row['name']);
            $car->setDescription($row['description']);
            $car->setType($row['type']);
            $car->setImage($row['image']);
            $car->setPrice($row['price']);
            $car->setBrand($row['brand']);
            $car->setProductionYear($row['production_year']);
            $car->setOwnerId($row['owner']);
            $cars[] = $car;
        }
        return $cars;
    }

    public function findById($id): ?Car
    {
        $statement = $this->getConnection()->prepare("SELECT * FROM cars WHERE id = ? ");
        $statement->execute([$id]);

        try {
            $car = new Car();
            if ($row = $statement->fetch()) {
                $car->setName($row['name']);
                $car->setDescription($row['description']);
                $car->setType($row['type']);
                $car->setImage($row['image']);
                $car->setPrice($row['price']);
                $car->setBrand($row['brand']);
                $car->setProductionYear($row['production_year']);

                return $car;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function insert(CarRequest $carRequest): ?string
    {
        $query = "INSERT INTO cars(name,description,type, price,brand, production_year, owner, image) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $statement = $this->getConnection()->prepare($query);
        try {
            $statement->execute([
                $carRequest->getName(),
                $carRequest->getDescription(),
                $carRequest->getType(),
                $carRequest->getPrice(),
                $carRequest->getBrand(),
                $carRequest->getProductionYear(),
                $carRequest->getOwnerId(),
                $carRequest->getImage()
            ]);
        } catch (\PDOException $e) {
            return null;
        }

        return $this->connection->lastInsertId();
    }
}
