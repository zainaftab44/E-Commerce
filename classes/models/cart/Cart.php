<?php


class Cart{
    private $products=[];

    function addToCart(int $id,int $quantity=1) {
       array_push($this->products,[$id=>$quantity]); 
    }

    function removeFromCart(int $id) {
       unset($this->products[$id]);
    }

    function changeQuantity(int $id, int $quantity=1){
       $this->products[$id]=$quantity;
    }
}