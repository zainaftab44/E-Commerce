<?php

namespace Models;

use Data\Repositories\CartRepository;

class Cart {
   private $id;
   private $products = [];

   function getId() {
      return $this->id;
   }
   
   function setId($id) {
      $this->id = $id;
   }

   function getProducts() {
      return $this->products;
   }
   
   function addToCart($id, $quantity) {
      array_push([$id=>$quantity]);
      $this->saveCart();
   }

   function removeFromCart(int $id) {
      unset($this->products[$id]);
      $this->saveCart();
   }

   function changeQuantity(Product $product, int $quantity = 1) {
      $this->products[$product->getId()] = $quantity;
      $this->saveCart();
   }

   function saveCart(){
      (new CartRepository())->save($this);
   }
   
   /**
    *  To be called on user login
    *  @param $uid user id of current user
    */
   function retrieveCart($uid){
      (new CartRepository())->find($uid);
   }
}
