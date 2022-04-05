<?php

/*** Author: your name*
 * Date: 4/5/2022*
 * File: menu_controller.class.php*
 * Description: */
class MenuController
{
    private $menu_model;

    //construct
    public function __construct()
    {
        // create an instance of the MenuModel class
        $this->menu_model = MenuModel::getMenuModel();
    }

    // index action to display all menu items
    public function index(){
        // retrieve all menu items and store them
        $menuItems = $this->menu_model->list_menu();
        if(!$menuItems){
            // display error
            $message = "There was a problem displaying the menu items";
            $this->error($message);
            return;
        }
        // display the menu items
        $view = new MenuIndex();
        $view = display($menuItems);
    }

    // displays the detail of a menu item
    public function detail($Item_id){
        // retrieve the menu item
        $menuItem = $this->menu_model->view_menu($Item_id);
        if (!$menuItem) {
            //display an error
            $message = "There was a problem displaying the menu Item id='" . $Item_id . "'.";
            $this->error($message);
            return;
        }
        // display movie details
        $view = new MenuDetail();
        $view->display($menuItem);

    }
    //handle an error
    public function error($message)
    {
        //create an object
        $error = new MenuError();

        // display the error
        $error->display($message);

    }
}