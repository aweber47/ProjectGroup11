<?php
/*** Author: Alex Weber*
 * Date: 4/5/2022 - 4/28/2022*
 * File: menu_model.class.php*
 * Description: holds all the functions for the menu controllor. Also holds the functions for the cart_model*/

class MenuModel
{
    // private data members
    private $session;
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

        // error handler that passing to the ViewingErrorexception if the 'get_categories' public function fails.
        try {
            if (!$query) {
                throw new ViewingErrorException("Unable to retrieve the get_categories Function");
            }
        } catch (ViewingErrorException $e) {
            $view = new MenuController();
            $view->error($e->getMessage());
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

        // it will always state that cat_id is not defined.
        error_reporting(0);
        $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
        $_SESSION['page'] = $page;
        /*************************************************************************************
         *         Paginator Honor Feature    and search by category feature                    *
         ************************************************************************************/
        // session
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // defining number per page
        if (!isset($_SESSION['$records_per_page'])) {
            $_SESSION['$records_per_page'] = 3;
        } else {
            if (isset($_POST['items'])) {
                $_SESSION['$records_per_page'] = $_POST['items'];
            }
        }
        // determine the category filter
        if (isset($_POST['cat'])) {
            $cat_id = $_POST['cat'];
        }

        // all menu items
        if ($cat_id == 0) {

            $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
            $_SESSION['page'] = $page;

            // keeping track of the number of products the user wants
            $no_of_records_per_page = $_SESSION['$records_per_page'];
            // pagination formula starts here:
            $offset = ($page - 1) * $no_of_records_per_page;
            // Getting total number of pages
            $total_pages_sql = "SELECT COUNT(*) FROM " . $this->tblMenu;
            $result = mysqli_query($this->dbConnection, $total_pages_sql);
            $total_rows = mysqli_fetch_array($result)[0];
            $total_pages = ceil($total_rows / $no_of_records_per_page);

            $_SESSION['total_page'] = $total_pages;


            $sql = "SELECT * FROM " . $this->tblMenu . "," . $this->tblCategory . " WHERE " . $this->tblMenu . ".category=" . $this->tblCategory . ".category_id" . " LIMIT " . " $offset, $no_of_records_per_page";
            $res_data = mysqli_query($this->dbConnection, $sql);
            // execute the thing above
            $query = $this->dbConnection->query($sql);

            try {
                // if the statement above this comment fails run this
                if (!$query) {
                    throw new ViewingErrorException("Query was unable to execute for 'list_menu' please check the database connection and XAMPP connection.");
                }
            } catch (ViewingErrorException $e) {
                $view = new MenuController();
                $view->error($e->getMessage());
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
            while ($obj = mysqli_fetch_object($res_data)) {
                $menuItem = new Menu(stripslashes($obj->product), stripcslashes($obj->image), stripcslashes($obj->category), stripslashes($obj->price), stripcslashes($obj->description), stripcslashes($obj->qty));
                // set the id for the menu item
                $menuItem->setId($obj->id);

                // add the menu item into the array
                $menuItems[] = $menuItem;

                // count
                $cnt++;
            }
            return $menuItems;
        }


        // appetizers
        if ($cat_id == 1) {
            $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
            $_SESSION['page'] = $page;


            // keeping track of the number of products the user wants
            $no_of_records_per_page2 = 25;

            // pagination formula starts here:
            $offset2 = ($page - 1) * $no_of_records_per_page2;
            // Getting total number of pages
            $total_pages_sql2 = "SELECT COUNT(*) FROM " . $this->tblMenu . " WHERE category=1";
            $result2 = mysqli_query($this->dbConnection, $total_pages_sql2);
            $total_rows2 = mysqli_fetch_array($result2)[0];
            $total_pages2 = ceil($total_rows2 / $no_of_records_per_page2);
            // store as a session var
            $_SESSION['total_page'] = $total_pages2;

            $cnt = 1;
            $_SESSION['count'] = $cnt;


            $sql2 = "SELECT * FROM " . $this->tblMenu . " WHERE category=1" . " LIMIT " . " $offset2, $no_of_records_per_page2";;
            $res_data2 = mysqli_query($this->dbConnection, $sql2);
            // execute the thing above
            $query2 = $this->dbConnection->query($sql2);

            try {
                // if the statement above this comment fails run this
                if (!$query2) {
                    throw new ViewingErrorException("Query was unable to execute for 'list_menu' please check the database connection and XAMPP connection.");
                }
            } catch (ViewingErrorException $e) {
                $view = new MenuController();
                $view->error($e->getMessage());
            }
            if ($query2->num_rows == 0) {
                return 0;
            }
            $appItems = array();

            while ($obj = mysqli_fetch_object($res_data2)) {
                $appItem = new Menu(stripslashes($obj->product), stripcslashes($obj->image), stripcslashes($obj->category), stripslashes($obj->price), stripcslashes($obj->description), stripcslashes($obj->qty));
                // set the id for the menu item
                $appItem->setId($obj->id);

                // add the menu item into the array
                $appItems[] = $appItem;
            }
            return $appItems;
        }

        // entrees
        if ($cat_id == 2) {
            $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
            $_SESSION['page'] = $page;

            // keeping track of the number of products the user wants
            $no_of_records_per_page3 = 25;

            // pagination formula starts here:
            $offset3 = ($page - 1) * $no_of_records_per_page3;
            // Getting total number of pages
            $total_pages_sql3 = "SELECT COUNT(*) FROM " . $this->tblMenu . " WHERE category=2";
            $result3 = mysqli_query($this->dbConnection, $total_pages_sql3);
            $total_rows3 = mysqli_fetch_array($result3)[0];
            $total_pages3 = ceil($total_rows3 / $no_of_records_per_page3);
            // store as a session var
            $_SESSION['total_page'] = $total_pages3;

            $cnt = 1;
            $_SESSION['count'] = $cnt;


            $sql3 = "SELECT * FROM " . $this->tblMenu . " WHERE category=2" . " LIMIT " . " $offset3, $no_of_records_per_page3";
            $res_data3 = mysqli_query($this->dbConnection, $sql3);
            // execute the thing above
            $query3 = $this->dbConnection->query($sql3);
            try {
                // if the statement above this comment fails run this
                if (!$query3) {
                    throw new ViewingErrorException("Query was unable to execute for 'list_menu' please check the database connection and XAMPP connection.");
                }
            } catch (ViewingErrorException $e) {
                $view = new MenuController();
                $view->error($e->getMessage());
            }
            if ($query3->num_rows == 0) {
                return 0;
            }
            $entItems = array();

            while ($obj = mysqli_fetch_object($res_data3)) {
                $entItem = new Menu(stripslashes($obj->product), stripcslashes($obj->image), stripcslashes($obj->category), stripslashes($obj->price), stripcslashes($obj->description), stripcslashes($obj->qty));
                // set the id for the menu item
                $entItem->setId($obj->id);

                // add the menu item into the array
                $entItems[] = $entItem;
            }
            return $entItems;
        }

        // only display soups
        if ($cat_id == 3) {
            $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
            $_SESSION['page'] = $page;

            // keeping track of the number of products the user wants
            $no_of_records_per_page4 = 25;

            // pagination formula starts here:
            $offset4 = ($page - 1) * $no_of_records_per_page4;
            // Getting total number of pages
            $total_pages_sql4 = "SELECT COUNT(*) FROM " . $this->tblMenu . " WHERE category=3";
            $result4 = mysqli_query($this->dbConnection, $total_pages_sql4);
            $total_rows4 = mysqli_fetch_array($result4)[0];
            $total_pages4 = ceil($total_rows4 / $no_of_records_per_page4);
            // store as a session var
            $_SESSION['total_page'] = $total_pages4;

            $cnt = 1;
            $_SESSION['count'] = $cnt;


            $sql4 = "SELECT * FROM " . $this->tblMenu . " WHERE category=3" . " LIMIT " . " $offset4, $no_of_records_per_page4";;
            $res_data4 = mysqli_query($this->dbConnection, $sql4);
            // execute the thing above
            $query4 = $this->dbConnection->query($sql4);
            try {
                // if the statement above this comment fails run this
                if (!$query4) {
                    throw new ViewingErrorException("Query was unable to execute for 'list_menu' please check the database connection and XAMPP connection.");
                }
            } catch (ViewingErrorException $e) {
                $view = new MenuController();
                $view->error($e->getMessage());
            }
            if ($query4->num_rows == 0) {
                return 0;
            }
            $soupItems = array();

            while ($obj = mysqli_fetch_object($res_data4)) {
                $soupItem = new Menu(stripslashes($obj->product), stripcslashes($obj->image), stripcslashes($obj->category), stripslashes($obj->price), stripcslashes($obj->description), stripcslashes($obj->qty));
                // set the id for the menu item
                $soupItem->setId($obj->id);

                // add the menu item into the array
                $soupItems[] = $soupItem;
            }
            return $soupItems;
        }
        return false;
    }

    public function view_menu($id)
    {
        try {
            // select sql
            $sql = "SELECT * FROM " . $this->tblMenu . "," . $this->tblCategory . " WHERE " . $this->tblMenu . ".category=" . $this->tblCategory . ".category_id" . " AND " . $this->tblMenu . ".id='$id'";

            // execute the thing above
            $query = $this->dbConnection->query($sql);

            if (!$query) {
                throw new ViewingErrorException("Problem viewing the menu detail. Please check settings.");
            }
        } catch (ViewingErrorException $e) {
            $view = new MenuController();
            $view->error($e->getMessage());
            return false;
        }
        try {
            if ($query && $query->num_rows > 0) {
                $obj = $query->fetch_object();

                // create the menu object
                $menuItem = new Menu(stripslashes($obj->product), stripcslashes($obj->image), stripcslashes($obj->category), stripslashes($obj->price), stripcslashes($obj->description), stripcslashes($obj->qty));
                // set the id for the menu object
                $menuItem->setId($obj->id);

                return $menuItem;
            } else {
                throw new ViewingErrorException("Unable to retrieve the menu id. Please make sure the id isn't zero.");
            }
        } catch (ViewingErrorException $e) {
            $view = new MenuController();
            $view->error($e->getMessage());
            return false;
        }
    }

    public function update_menuItem($id)
    {
        try {
            if (!filter_has_var(INPUT_POST, 'product') ||
                !filter_has_var(INPUT_POST, 'image') ||
                !filter_has_var(INPUT_POST, 'category') ||
                !filter_has_var(INPUT_POST, 'price') ||
                !filter_has_var(INPUT_POST, 'description')) {
                throw new DataMissingException("Failed obtaining post values");
            }
        } catch (DataMissingException $e) {
            $view = new MenuController();
            $view->error($e->getMessage());
            return false;
        }


        $product = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'product', FILTER_SANITIZE_STRING)));
        $image = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'image', FILTER_SANITIZE_STRING)));
        $category = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'category', FILTER_SANITIZE_NUMBER_INT)));
        $price = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'price', FILTER_SANITIZE_STRING)));
        $description = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING)));

        // if there is missing data don't run
        try {
            if ($product == "" || $image == "" || $category == "" || $price == "" || $description == "") {
                throw new DataMissingException("You must fill out all fields of data or not leave any NULL to process the change.");
            }
        } catch (DataMissingException $e) {
            $view = new MenuController();
            $view->error($e->getMessage());
            return false;
        }

        //UPDATE QUERY
        $sql = "UPDATE " . $this->tblMenu .
            " SET product='$product', image='$image', category='$category', "
            . "price='$price' , description='$description' WHERE id='$id'";

        try {
            $query = $this->dbConnection->query($sql);

            if (!$query) {
                throw new DatabaseException("SQL or Query failed. Please check the Menu_Model Class lines 395-410 to fix the code, or check your XAMPP connection");
            }
        } catch (DatabaseException $e) {
            $view = new MenuController();
            $view->error($e->getMessage());
            return false;
        }
        // return query if successful
        return $query;
    }

    // autosuggestion
    public function menu_search($terms)
    {
        $sql = "SELECT * FROM " . $this->tblMenu . " WHERE (";

        $parts = array();

        foreach ($terms as $term) {
            $parts[] = 'product LIKE "%' . $term . '%"';
        }
        $sql .= implode(' OR ', $parts) . ")";

        //execute the query
        $query = $this->dbConnection->query($sql);

        // the search failed, return false.
        if (!$query)
            return false;

        //search succeeded, but no menu item found.
        if ($query->num_rows == 0)
            return 0;

        // create an array to store all returned items
        $results = array();

        // loopy through the stuff
        while ($obj = $query->fetch_object()) {
            $searchItem = new Menu(stripslashes($obj->product), stripcslashes($obj->image), stripcslashes($obj->category), stripslashes($obj->price), stripcslashes($obj->description), stripcslashes($obj->qty));
            $searchItem->setId($obj->id);
            // add the menu item into the array
            $results[] = $searchItem;
        }
        return $results;
    }

    public function search_menu($terms)
    {

        // uwu the session back to life
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        //$booly = $_SESSION['boolValue'];
        $booly = 'false';
        if ($booly == 'true') {
            $terms = explode(" ", $terms); //explode multiple terms into an array
            //select statement for AND search
            $sql = "SELECT * FROM " . $this->tblMenu . "," . $this->tblCategory .
                " WHERE " . $this->tblMenu . ".category=" . $this->tblCategory . ".category_id AND (";

            $parts = array();

            foreach ($terms as $term) {
                // prevent random array key errors for unset session vars
                error_reporting(0);
                // this is meant so a user can search a key word for the product name and description (for allegries and such)
                if (isset($_GET['bool1']) && ($_GET['bool3']) == 'true') {
                    $parts[] = 'product && description LIKE "%' . $term . '%"';
                }
                // individually classify the variables
                if (isset($_GET["bool1"])) {
                    $parts[] = 'product LIKE "%' . $term . '%"';
                }
                if (isset($_GET["bool2"])) {
                    $parts[] = 'price LIKE "%' . $term . '%"';
                }
                if (isset($_GET["bool3"])) {
                    $parts[] = 'description LIKE "%' . $term . '%"';
                }
            }
            $sql .= implode(' AND ', $parts) . ")";

            //execute the query
            $query = $this->dbConnection->query($sql);

            // the search failed, return false.
            if (!$query)
                return false;

            //search succeeded, but no menu item found.
            if ($query->num_rows == 0)
                return 0;

            // create an array to store all returned items
            $searchItems = array();

            // loopy through the stuff
            while ($obj = $query->fetch_object()) {
                $searchItem = new Menu(stripslashes($obj->product), stripcslashes($obj->image), stripcslashes($obj->category), stripslashes($obj->price), stripcslashes($obj->description), stripcslashes($obj->qty));
                // set the id for the menu item
                $searchItem->setId($obj->id);

                // add the menu item into the array
                $searchItems[] = $searchItem;
            }
            return $searchItems;
        } else {
            $terms = explode(" ", $terms); //explode multiple terms into an array
            //select statement for OR Search
            $sql = "SELECT * FROM " . $this->tblMenu . "," . $this->tblCategory . " WHERE " . $this->tblMenu . ".category=" . $this->tblCategory . ".category_id AND (";

            $parts = array();

            foreach ($terms as $term) {
                // individually classify the variables
                if (isset($_GET["bool1"])) {
                    $parts[] = 'product LIKE "%' . $term . '%"';
                }
                if (isset($_GET["bool2"])) {
                    $parts[] = 'price LIKE "%' . $term . '%"';
                }
                if (isset($_GET["bool3"])) {
                    $parts[] = 'description LIKE "%' . $term . '%"';
                }
            }
            // implodes the sql statement
            $sql .= implode(' OR ', $parts) . ")";

            //execute the query
            $query = $this->dbConnection->query($sql);

            // the search failed, return false.
            if (!$query)
                return false;

            //search succeeded, but no menu item found.
            if ($query->num_rows == 0)
                return 0;

            // create an array to store all returned items
            $searchItems = array();

            // loopy through the stuff
            while ($obj = $query->fetch_object()) {
                $searchItem = new Menu(stripslashes($obj->product), stripcslashes($obj->image), stripcslashes($obj->category), stripslashes($obj->price), stripcslashes($obj->description), stripcslashes($obj->qty));

                // set the id for the menu item
                $searchItem->setId($obj->id);

                // add the menu item into the array
                $searchItems[] = $searchItem;
            }
            return $searchItems;
        }
    }

    public function add_menuItem()
    {
        $product = filter_input(INPUT_POST, "product", FILTER_SANITIZE_STRING);
        $image = filter_input(INPUT_POST, 'image', FILTER_SANITIZE_STRING);
        $category = filter_input(INPUT_POST, "category", FILTER_SANITIZE_NUMBER_INT);
        $price = filter_input(INPUT_POST, "price", FILTER_SANITIZE_STRING);
        $description = filter_input(INPUT_POST, "description", FILTER_SANITIZE_STRING);

        // first see if there are any missing values
        try {
            if ($product == "" || $image == "" || $category == "" || $price == "" || $description == "") {
                throw new DataMissingException("Please fill out all field when entering a new menu item");
            }
        } catch (DataMissingException $e) {
            $view = new MenuController();
            $view->error($e->getMessage());
            return false;
        }

        // second is testing the sql
        try {
            // insert query
            $sql = "INSERT INTO " . $this->db->getMenuTable() . " VALUES(NULL,'" . $product . "','" . $image . "','" . $category . "','" . $price . "','" . $description . "')";
            $query = $this->dbConnection->query($sql);

            if (!$query || !$sql) {
                throw new DatabaseException("Unable to execute query.");
            }
        } catch (DatabaseException $e) {
            $view = new MenuController();
            $view->error($e->getMessage());
            return false;
        }
        return "Congratulations! You have added a(n) new menu Item!";
    }

    public function delete_menuItem()
    {
        $deleteProduct = filter_input(INPUT_POST, 'conDel');
        try {
            if ($deleteProduct == 'YES') {
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                if (isset($_SESSION['sad_item'])) {
                    $id = $_SESSION['sad_item'];

                    // start the delete process
                    $sql = "DELETE FROM " . $this->tblMenu . " WHERE id='$id'";
                    $query = $this->dbConnection->query($sql);

                    // test query
                    try {
                        if (!$query) {
                            throw new DatabaseException("Failed to execute the SQL");
                        } else {
                            return $query;
                        }
                    } catch (DatabaseException $e) {
                        $view = new MenuController();
                        $view->error($e->getMessage());
                        return false;
                    }
                }
            } else {
                throw new ViewingErrorException("Typo in the word: YES");
            }
        } catch (ViewingErrorException $e) {
            $view = new MenuController();
            $view->error($e->getMessage());
            return false;
        }
    }
}