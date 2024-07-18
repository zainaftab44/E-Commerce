<?php

namespace Models;

class Image {
    private $id;
    private $name;
    private $dir;
    private $prod_id;

    public function __construct($id,$prod_id,$name,$dir) {
        $this->id = $id;
        $this->prod_id = $prod_id;
        $this->name = $name;
        $this->dir = $dir;
    }
    
    function getImage() {
        return BASE_IMG_DIR . DIRECTORY_SEPARATOR .  $this->dir . DIRECTORY_SEPARATOR .  $this->name;
    }
}
