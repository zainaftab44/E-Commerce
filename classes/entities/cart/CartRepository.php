<?php


class CartRepository implements Repository {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }
    // will be mainly used when a buyer log in
    public function find($id) {
        $data = $this->db->fetch("Select id, products from carts where uid = :id",['id'=>$id]);
        return json_decode($data['products']);
    }
    public function findAll() {
    }
    public function save(Cart $cart) {
        if ($cart->getId()) {
            // Update existing cart
            $this->db->execute('UPDATE carts SET id = :id, products = :products WHERE id = :id', [
                'id' => $cart->getId(),
                'products' => json_encode($cart->getProducts())
            ]);
        } else {
            // Create new cart
            $data = $this->db->execute('INSERT INTO products (name, description, images, price, discount) VALUES (:name, :description, :images, :price, :discount)', [
                'id' => $cart->getId(),
                'products' => json_encode($cart->getProducts())
            ]);
            $cart->setId($data->lastInsertId());
        }
    }
    public function delete($id) {
        Database::getInstance()->execute('delete from cart where id = :id', ['id'=>$id]);
    }
}
