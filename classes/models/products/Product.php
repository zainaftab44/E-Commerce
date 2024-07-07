<?php

class Product {

    private $id;
    private $name;
    private $description;
    private $images = [];
    private $price;
    private $discount;

    public function __construct(int|null $id, string $name, string $description, string $images, $price, int $discount) {
        $this->name = $name;
        $this->description = $description;
        $this->images = $images;
        $this->price = $price;
        $this->discount = $discount;
        $this->id = empty($id)?((new ProductRepository())->save($this)):$id;
    }

    public function getId() {
        return $this->id;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getName() {
        return $this->name;
    }

    public function getImages() {
        $this->images;
    }

    public function getPrice() {
        $this->price;
    }

    public function getDiscount() {
        $this->discount;
    }

    public function setId(int $id) {
        return $this->id = $id;
    }
}
