<?php
namespace Models;

use Data\Repositories\ProductRepository;

class Product {

    private $id;
    private $name;
    private $description;
    private $images = [];
    private $price;
    private $discount;
    private $sku;

    public function __construct(int|null $id, string $name, string $description, string $images, $price, int $discount, string $sku='') {
        $this->name = $name;
        $this->description = $description;
        $this->images = $images;
        $this->price = $price;
        $this->discount = $discount;
        $this->sku = $sku;
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

    public function getSku() {
        $this->sku;
    }

    public function setId(int $id) {
        return $this->id = $id;
    }
}
