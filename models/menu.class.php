<?php

/*** Author: your name*
 * Date: 4/5/2022*
 * File: menu.class.php*
 * Description: */
class Menu
{
    // private data members
    private $id, $product,$image, $category, $price, $description;

    //constructor
    public function __construct($product,$image, $category, $price, $description){
        $this->product = $product;
        $this->image = $image;
        $this->category = $category;
        $this->price = $price;
        $this->description = $description;
    }

    // getters
    public function getId(){
        return $this->id;
    }
    public function getProduct(){
        return $this->product;
    }
    public function getImage(){
        return $this->image;
    }
    public function getCategory(){
        return $this->category;
    }
    public function getPrice(){
        return $this->price;
    }
    public function getDescription(){
        return $this->description;
    }
    // set menu item id
    public function setId($id){
        $this->id = $id;
    }
}