<?php

use Models\Cart;

$cart = function (Cart $cart) { ?>
    <div class="products">
        <? foreach ($cart->getProducts() as $id => $product) {
            $quantity = $cart->getProductQuantity($id);
        ?>
            <div class="product">
                <svg fill="none" viewBox="0 0 60 60" height="60" width="60" xmlns="http://www.w3.org/2000/svg">
                    <rect fill="#FFF6EE" rx="8.25" height="60" width="60"></rect>
                </svg>
                <div>
                    <span><? echo $product->getName(); ?></span>
                </div>
                <div class="quantity">
                    <button>
                        <svg fill="none" viewBox="0 0 24 24" height="14" width="14" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" stroke="#47484b" d="M20 12L4 12"></path>
                        </svg>
                    </button>
                    <label><? echo $quantity; ?></label>
                    <button>
                        <svg fill="none" viewBox="0 0 24 24" height="14" width="14" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" stroke="#47484b" d="M12 4V20M20 12H4"></path>
                        </svg>
                    </button>
                </div>
                <label class="price small">$<? echo $quantity * $product->getPrice(); ?></label>
            </div>
        <? } ?>
    </div>
<? } ?>