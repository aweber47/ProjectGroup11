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
    private $tblCategory;
    private $tblUsers;

    public function __construct()
    {
        $this->db = Database::getDatabase();
        $this->dbConnection = $this->db->getConnection();
        $this->tblMenu = $this->db->getMenuTable();
        $this->tblCategory = $this->db->getCategoryTable();
        $this->tblUsers = $this->db->getUsersTable();

        //Escapes special characters in a string for use in an SQL statement. This stops SQL inject in POST vars.
        foreach ($_POST as $key => $value) {
            $_POST[$key] = $this->dbConnection->real_escape_string($value);
        }

        //Escapes special characters in a string for use in an SQL statement. This stops SQL Injection in GET vars
        foreach ($_GET as $key => $value) {
            $_GET[$key] = $this->dbConnection->real_escape_string($value);
        }
        // initialize categories
        if (!isset($_SESSION['categories'])) {
            $categories = $this->get_categories();
            $_SESSION['categories'] = $categories;

        }
    }

    // get categories
    public function get_categories()
    {
        $sql = "SELECT * FROM " . $this->tblCategory;
        $query = $this->dbConnection->query($sql);

        if (!$query) {
            return false;
        }
        // loop through all rows
        $categories = array();
        while ($obj = $query->fetch_object()) {
            $categories[$obj->category_id] = $obj->food_type;
        }
        return $categories;
    }

    public static function getMenuModel()
    {
        if (self::$_instance == NULL) {
            self::$_instance = new MenuModel();
        }
        return self::$_instance;
    }

    // list the menu items
    public function list_menu()
    {
        $sql = "SELECT * FROM " . $this->tblMenu . "," . $this->tblCategory . " WHERE " . $this->tblMenu . ".category=" . $this->tblCategory . ".category_id";

        // execute the thing above
        $query = $this->dbConnection->query($sql);

        // if the statement above this comment fails run this
        if (!$query) {
            return false;
        }
        // if the statements between 45-48 don't execute run this
        if ($query->num_rows == 0) {
            return 0;
        }

        //handle the result
        // create an array to store all returned menu items
        $menuItems = array();

        // loopy through the stuff
        while ($obj = $query->fetch_object()) {
            $menuItem = new Menu(stripslashes($obj->product), stripcslashes($obj->image), stripcslashes($obj->category), stripslashes($obj->price), stripcslashes($obj->description));

            // set the id for the menu item
            $menuItem->setId($obj->id);

            // add the menu item into the array
            $menuItems[] = $menuItem;

        }
        return $menuItems;
        echo $_SESSION['role'];
    }

    public function view_menu($id)
    {
        // select sql
        $sql = "SELECT * FROM " . $this->tblMenu . "," . $this->tblCategory . " WHERE " . $this->tblMenu . ".category=" . $this->tblCategory . ".category_id" . " AND " . $this->tblMenu . ".id='$id'";

        // execute the thing above
        $query = $this->dbConnection->query($sql);

        if ($query && $query->num_rows > 0) {
            $obj = $query->fetch_object();

            // create the menu object
            $menuItem = new Menu(stripslashes($obj->product), stripcslashes($obj->image), stripcslashes($obj->category), stripslashes($obj->price), stripcslashes($obj->description));

            // set the id for the menu object
            $menuItem->setId($obj->id);

            return $menuItem;
        }
        return false;
    }

    public function search_menu($terms)
    {
        $terms = explode(" ", $terms); //explode multiple terms into an array
        //select statement for AND serach
        $sql = "SELECT * FROM " . $this->tblMenu . "," . $this->tblCategory .
            " WHERE " . $this->tblMenu . ".category=" . $this->tblCategory . ".category_id AND (1";

        foreach ($terms as $term) {
            $sql .= " AND product LIKE '%" . $term . "%'";
        }

        $sql .= ")";

        //execute the query
        $query = $this->dbConnection->query($sql);

        // the search failed, return false.
        if (!$query)
            return false;

        //search succeeded, but no videogame was found.
        if ($query->num_rows == 0)
            return 0;

        // create an array to store all returned items
        $menuItems = array();

        // loopy through the stuff
        while ($obj = $query->fetch_object()) {
            $menuItem = new Menu(stripslashes($obj->product), stripcslashes($obj->image), stripcslashes($obj->category), stripslashes($obj->price), stripcslashes($obj->description));

            // set the id for the menu item
            $menuItem->setId($obj->id);

            // add the menu item into the array
            $menuItems[] = $menuItem;

        }
        return $menuItems;
    }

    public function update_menu($id)
    {
        if (!filter_has_var(INPUT_POST, 'product') ||
            !filter_has_var(INPUT_POST, 'image') ||
            !filter_has_var(INPUT_POST, 'category') ||
            !filter_has_var(INPUT_POST, 'price') ||
            !filter_has_var(INPUT_POST, 'description')) {
            return false;
        }
        $product = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'product', FILTER_SANITIZE_STRING)));
        $image = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'image', FILTER_SANITIZE_STRING)));
        $category = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'category', FILTER_SANITIZE_STRING)));
        $price = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'price', FILTER_SANITIZE_STRING)));
        $description = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING)));

        //update query
        $sql = "UPDATE " . $this->tblMenu .
            " SET product='$product', image='$image', category='$category', "
            . "price='$price' , description='$description' WHERE id='$id'";
        //execute
        return $this->dbConnection->query($sql);
    }

    public function add_menuItem()
    {

        $product = filter_input(INPUT_POST, "product", FILTER_SANITIZE_STRING);
        $image = filter_input(INPUT_POST, 'image', FILTER_SANITIZE_STRING);
        $category = filter_input(INPUT_POST, "category", FILTER_SANITIZE_NUMBER_INT);
        $price = filter_input(INPUT_POST, "price", FILTER_SANITIZE_STRING);
        $description = filter_input(INPUT_POST, "description", FILTER_SANITIZE_STRING);


        // insert query
        $sql = "INSERT INTO " . $this->db->getMenuTable() . " VALUES(NULL,'" . $product . "','" . $image . "','" . $category . "','" . $price . "','" . $description . "')";

        //execute the query and return true if successful or false if failed
        if ($this->dbConnection->query($sql) === TRUE) {
            return "Congratulations! You have added a(n) new menu item!";
        } else {
            return false;
        }
        return false;
    }

    public function delete_menuItem($id)
    {
        $sql = "DELETE FROM " . $this->tblMenu . " WHERE id='$id'";
        return $this->dbConnection->query($sql);
    }
}