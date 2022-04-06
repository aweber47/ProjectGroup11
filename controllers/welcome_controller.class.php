<?php

/*** Author: your name*
 * Date: 4/5/2022*
 * File: welcome_controller.class.php*
 * Description: */
class WelcomeController
{
    public function index(){
        $view = new Index();
        $view->display();
    }
}