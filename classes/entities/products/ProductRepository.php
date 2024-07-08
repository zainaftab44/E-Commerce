<?php

class ProductRepository implements Repository {

    private Database $db;
    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function find($id) {
        $data = $this->db->fetch('SELECT * FROM products WHERE id = :id AND disabled = 0', ['id' => $id]);
        if ($data) {
            return  new Product(
                $data['id'],
                $data['description'],
                $data['name'],
                $data['images'],
                $data['price'],
                $data['discount'],
                $data['sku'],
            );
        }

        return null;
    }

    public function findAll() {
        $products = [];
        while ($data = $this->db->fetch('SELECT * FROM products')) {
            $products[] =  new Product(
                $data['id'],
                $data['description'],
                $data['name'],
                $data['images'],
                $data['price'],
                $data['discount'],
                $data['sku']
            );
        }

        return $products;
    }

    public function save(Product $product) {
        if ($product->getId()) {
            // Update existing product
            $this->db->execute('UPDATE products SET name = :name, description = :description, images = :images, price = :price, discount = :discount WHERE id = :id', [
                'id' => $product->getId(),
                'name' => $product->getName(),
                'description' => $product->getDescription(),
                'images' => $product->getImages(),
                'price' => $product->getPrice(),
                'discount' => $product->getDiscount(),
                'sku' => $product -> getSku()
            ]);
        } else {
            // Create new product
            $data = $this->db->execute('INSERT INTO products (name, description, images, price, discount,sku) VALUES (:name, :description, :images, :price, :discount,:sku)', [
                'name' => $product->getName(),
                'description' => $product->getDescription(),
                'images' => $product->getImages(),
                'price' => $product->getPrice(),
                'discount' => $product->getDiscount(),
                'sku' => $product -> getSku()
            ]);
            $product->setId($data->lastInsertId());
            return $data->lastInsertId();
        }
    }

    /**
     * products would be moved to disabled so that the analytics related to them
     * won't be lost due to cascade deletion based on foreign/primary key relation 
     */
    public function delete($id) {
        $this->db->execute('UPDATE products SET disabled = "1" WHERE id = :id', ['id' => $id]);
    }
}
