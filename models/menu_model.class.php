<?php

/*** Author: your name*
 * Date: 4/5/2022*
 * File: menu_model.class.php*
 * Description: */
class MenuModel
{
    // private data members
    private $db;
    private $dbConnection;
    static private $_instance = NULL;
    private $tblMenu;

    private function __construct()
    {
        $this->db = Database::getDatabase();
        $this->dbConnection = $this->db->getConnection();
        $this->tblMenu = $this->db->getMenuTable();

        //Escapes special characters in a string for use in an SQL statement. This stops SQL inject in POST vars.
        foreach ($_POST as $key => $value) {
            $_POST[$key] = $this->dbConnection->real_escape_string($value);
        }

        //Escapes special characters in a string for use in an SQL statement. This stops SQL Injection in GET vars
        foreach ($_GET as $key => $value) {
            $_GET[$key] = $this->dbConnection->real_escape_string($value);
        }

    }
    public static function getMenuModel(){
        if(self::$_instance == NULL){
            self::$_instance = new MenuModel();
        }
        return self::$_instance;
    }

    // list the menu items
    public function list_menu(){
        $sql = "SELECT * FROM $this->tblMenu";

        // execute the thing above
        $query = $this->dbConnection->query($sql);

        // if the statement above this comment fails run this
        if(!$query){
            return false;
        }
        // if the statements between 45-48 don't execute run this
        if($query->num_rows == 0){
            return 0;
        }

        //handle the result
        // create an array to store all returned menu items
        $menuItems = array();

        // loopy through the stuff
        while($obj = $query->fetch_object()){
            $menuItems = new Menu(stripslashes($obj->Product_name), stripcslashes($obj->Category_id), stripslashes($obj->Price), stripcslashes($obj->Description));

            // set the id for the menu item
            $menuItems->setItem_id($obj->Item_id);

            // add the menu item into the array
            $menuItemsFull[] = $menuItems;

        }
        return $menuItemsFull;
    }
    public function view_menu($Item_id){
        // select sql
        $sql = "SELECT * FROM $this->tblMenu";

        // execute the thing above
        $query = $this->dbConnection->query($sql);

        if($query && $query->num_rows > 0){
            $obj = $query->fetch_object();

            // create the menu object
            $menuItems = new Menu(stripslashes($obj->Product_name), stripcslashes($obj->Category_id), stripslashes($obj->Price), stripcslashes($obj->Description));

            // set the id for the menu object
            $menuItems->setItem_id($obj->Item_id);

            return $menuItems;
        }
        return false;
    }

}