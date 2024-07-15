<?php


interface Repository{
    public function find($id);
    public function findAll();
    public function save(object $obj);
    public function delete($id);

}