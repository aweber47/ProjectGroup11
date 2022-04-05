<?php

/*** Author: your name*
 * Date: 4/5/2022*
 * File: menu.class.php*
 * Description: */
class Menu
{
    // private data members
    private $Item_id, $Product_name, $Category_id, $Price, $Description;

    //constructor
    public function __construct($Product_name, $Category_id, $Price, $Description)
    {
        $this->Product_name = $Product_name;
        $this->Category_id = $Category_id;
        $this->Price = $Price;
        $this->Description = $Description;
    }
    // getters
    public function getItem_id()
    {
        return $this->Item_id;
    }

    public function getProduct_name()
    {
        return $this->Product_name;
    }

    public function getCategory_id()
    {
        return $this->Category_id;
    }

    public function getPrice()
    {
        return $this->Price;
    }

    public function getDescription()
    {
        return $this->Description;
    }

    // set menu item id
    public function setItem_id($Item_id)
    {
        $this->Item_id = $Item_id;
    }
}