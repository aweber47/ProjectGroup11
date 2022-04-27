<?php

/*** Author: your name*
 * Date: 4/5/2022*
 * File: menu_controller.class.php*
 * Description: */
class MenuController
{
    private $menu_model;
    private $cart_model;

    private $cart;

    //construct
    public function __construct()
    {
        // create an instance of the MenuModel class
        $this->menu_model = MenuModel::getMenuModel();
        $this->cart_model = CartModel::getCartModel();

        // verify that a session has been started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        // verify if the user logging in is an admin user
        if (!isset($_SESSION['user'])) {
            $_SESSION['user'] = false;
        }
        if (!isset($_SESSION['admin'])) {
            $_SESSION['admin'] = false;
        }
        if (!isset($_SESSION['categories'])) {
            $categories = $this->menu_model->get_categories();
            $_SESSION['categories'] = $categories;
        }
        if (!isset($_SESSION['cart'])) {

            //session_destroy();
            $_SESSION['cart'] = array();
        }
    }

    // index action to display all menu items
    public function index()
    {
        // retrieve all menu items and store them
        $menuItems = $this->menu_model->list_menu();

        //echo "Is this running?";
        if (!$menuItems) {
            // display error
            $message = "There was a problem displaying the menu items";
            $this->error($message);
            return;
        }
        // display the menu items
        $view = new MenuIndex();
        $view->display($menuItems);
    }

    // displays the detail of a menu item
    public function detail($id)
    {
        // retrieve the menu item

        $menuItem = $this->menu_model->view_menu($id);

        // if menuItem is null don't try to retrieve the ID and follow through with the request.
        // This prevents a php fatal error search, attempting to run through the detail page.
        if ($menuItem == NULL) {
            return false;
        }
        //Display menu details
        $view = new MenuDetail();
        $view->display($menuItem);
        return true;
    }

    //handle an error
    public function error($message)
    {
        //create an object
        $error = new MenuError();

        // display the error
        $error->display($message);

    }

    //search menu item
    public function search()
    {

        // create a php session
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
            echo "Session started";
        }

        if (!filter_has_var(INPUT_GET, 'w')) {
            echo "Not reading the radio buttons correctly";
        }

        // determine the search feature control
        if (!isset($_SESSION['boolValue'])) {
            $_SESSION['boolValue'] = 'false';
        } else {
            if (isset($_GET['w'])) {
                $_SESSION['boolValue'] = $_GET['w'];
            }
        }
        echo $_SESSION['boolValue'];

        //retrieve query terms from search form
        $query_terms = trim($_GET['query-terms']);

        // if search term is empty, list menu items
        //search the database for matching menu products
        $menuItems = $this->menu_model->search_menu($query_terms);
        if ($menuItems === false) {
            //handle error
            $message = "An error has occurred.";
            $this->error($message);
            return;
        }
        //display matched menu items
        $search = new MenuSearch();
        $search->display($query_terms, $menuItems);
    }

    //display a menu Item in a form for editing
    public function edit($id)
    {
        //retrieve the specific menu item
        $menuItem = $this->menu_model->view_menu($id);

        if (!$menuItem) {
            //display an error
            $message = "There was a problem displaying the menu id='" . $id . "'.";
            $this->error($message);
            return;
        }

        $view = new MenuEdit();
        $view->display($menuItem);
    }

    //update a(n) menu item in the database
    public function update($id)
    {
        //update the menu item
        $update = $this->menu_model->update_menuItem($id);

        // prevents php from displaying two errors that are unnecessary
        if (!$update) {
            return false;
        }

        //display the updated menu item's details
        $confirm = "The menu item  was successfully updated.";
        $view = new MenuUpdate();
        $view->display($confirm, $id);
        return true;
    }

    //autosuggestion
    public function suggest($terms)
    {
        //retrieve query terms
        // decode the url query terms
        $query_terms = urldecode(trim($terms));

        // use the search menu feature to search menu
        $menuItems = $this->menu_model->menu_search(explode(' ', $query_terms));

        //retrieve all menu products (items) and store them in an array
        $titles = array();
        if ($menuItems) {
            foreach ($menuItems as $menuItem) {
                $titles[] = $menuItem->getProduct();
                var_dump($titles);
            }
        }
        // returns the shit into an array again
        return json_encode($titles, JSON_FORCE_OBJECT);
    }

    public function addDisplay()
    {
        //create an object of the Error class
        $error = new MenuAdd();

        //display the error page
        $error->display();
    }

    public function add()
    {
        $menuItem = $this->menu_model->add_menuItem();
        if (!$menuItem) {
            return false;
        }
        $detail = new MenuVerify();
        $detail->display("Menu Item has been added");
        return true;
    }

    public function deleteDisplay($id)
    {
        //create an object of the Error class
        $menuItem = $this->menu_model->view_menu($id);
        if (!$menuItem) {
            //handle errors
            //echo $update;
            $message = "There was a problem getting the menu item id='" . $id . "'.";
            $this->error($message);
            return;
        }
        $error = new MenuDelete();

        //display the error page
        $error->display($menuItem);
    }

    public function delete($id)
    {
        $menuItem = $this->menu_model->delete_menuItem($id);
        if (!$menuItem) {
            return false;
        }
        $detail = new MenuVerify();
        $detail->display("Menu Item has been deleted");
        return true;
    }

    // methods for the cart view
    /*************************************************************************************
     *         Cart Features below                        *
     ************************************************************************************/
    //following is for the cart
    public function addToCart($id)
    {
        $menuItem = $this->menu_model->view_menu($id);

        array_push($_SESSION["cart"], $menuItem);


        $menuItems = $this->menu_model->list_menu();

        $view = new MenuIndex();

        $view->display($menuItems);
    }

    public function deleteFromCart()
    {

        // removes the last element from the array.
        array_pop($_SESSION['cart']);

        // removes item from the array
        $cart = $_SESSION['cart'];
        //show the view
        $view = new CartIndex();
        $view->display($cart);

    }

    public function clearCart()
    {
        $_SESSION['cart'] = array();
        $cart = $_SESSION['cart'];

        $view = new CartCheckout();
        $view->display($cart);
    }

    public function showCart()
    {
        $cart = $_SESSION["cart"];

        $view = new CartIndex();
        $view->display($cart);
    }


    //handle calling inaccessible methods
    public function __call($name, $arguments)
    {
        //$message = "Route does not exist.";
        // Note: value of $name is case sensitive.
        $message = "Calling method '$name' caused errors. Route does not exist.";

        $this->error($message);
        return;
    }
}