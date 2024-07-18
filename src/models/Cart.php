<?php

namespace Models;

use Data\Repositories\CartRepository;

class Cart {
   private $id;
   private $products = []; // to be used for ui and processing
   private $product_ids = []; // to be used only for storage in db

   public  function getId() {
      return $this->id;
   }

   public function setId($id) {
      $this->id = $id;
   }

   public function getProductQuantity($id) {
      return $this->product_ids[$id];
   }

   public function getProducts() {
      return $this->products;
   }

   public function addToCart($id, $product, $quantity) {
      array_push($product_ids, [$id => $quantity]);
      array_push($products, [$id => $product]);
      $this->saveCart();
   }

   public function removeFromCart(int $id) {
      unset($this->products[$id]);
      unset($this->product_ids[$id]);
      $this->saveCart();
   }

   public function changeQuantity(Product $product, int $quantity = 1) {
      $this->product_ids[$product->getId()] = $quantity;
      if ($this->product_ids[$product->getId()] <= 0) {
         unset($this->product_ids[$product->getId()]);
         unset($this->products[$product->getId()]);
      }
      $this->saveCart();
   }

   public function saveCart() {
      (new CartRepository())->save($this);
   }

   /**
    *  To be called on user login
    *  @param $uid user id of current user
    */
   public function retrieveCart($uid) {
      (new CartRepository())->find($uid);
   }
}
