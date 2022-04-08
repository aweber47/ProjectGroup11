<?php

/*** Author: your name*
 * Date: 3/31/2022*
 * File: database.class.php*
 * Description: */
class Database
{
    // private parameters
    private $param = array(
        'host' => 'localhost',
        'login' => 'root',
        'password' => '',
        'database' => 'lewiesdb',
        'tblMenu' => 'menu_items',
        'tblCategory' => 'categories',
        'tblUsers' => 'users'
    );

    // define the database connection object
    private $objDBConnection = NULL;
    static private $_instance = NULL;

    // constructor
    public function __construct()
    {
        $this->objDBConnection = @new mysqli(
            $this->param['host'],
            $this->param['login'],
            $this->param['password'],
            $this->param['database']
        );
        if (mysqli_connect_errno() != 0) {
            $message = "Connecting database failed: " . mysqli_connect_error() . ".";
            include 'error.php';
            exit();
        }
    }

    //static method to ensure there is just one Database instance
    static public function getDatabase()
    {
        if (self::$_instance == NULL) {
            self::$_instance = new Database();
        }
        return self::$_instance;
    }

    //this function returns the database connection object
    public function getConnection()
    {
        return $this->objDBConnection;
    }

    //returns the name of the table menu item books
    public function getMenuTable()
    {
        return $this->param['tblMenu'];
    }

    public function getCategoryTable()
    {
        return $this->param['tblCategory'];
    }

    public function getUsersTable()
    {
        return $this->param['tblUsers'];
    }
}