<?php

/*** Author: your name*
 * Date: 4/7/2022*
 * File: user_model.class.php*
 * Description: */
class UserModel
{
    // private data
    private $db;
    private $dbConnection;
    static private $_instance = NULL;
    private $tblUsers;

    // constructor
    private function __construct()
    {
        $this->db = Database::getDatabase();
        $this->dbConnection = $this->db->getConnection();
        $this->tblUsers = $this->db->getUsersTable();
    }

    // static method to ensure there is a User instance
    public static function getUserModel()
    {
        if (self::$_instance == NULL) {
            self::$_instance = new UserModel();
        }
        return self::$_instance;
    }

    // list users
    public function list_user()
    {
        $sql = "SELECT * FROM $this->tblUsers";

        $query = $this->dbConnection->query($sql);

        // if the query failed, return false.
        if (!$query)
            //echo 'no query';
            return 'false';

        //if the query succeeded, but no user was found.
        if ($query->num_rows == 0)
            //echo 'no rows';
            return 0;

        //handle the result
        //create an array to store all users
        $users = array();

        //loop through all rows in the returned recordsets
        while ($obj = $query->fetch_object()) {
            //echo stripslashes($obj->title);
            //echo $query->num_rows;
            $user = new User (stripslashes($obj->id), stripslashes($obj->username), stripslashes($obj->password), stripslashes($obj->firstname), stripslashes($obj->lastname), stripslashes($obj->email));
            //echo $obj->id;
            //set the id for the videogame
            $user->setId($obj->id);

            //add the videogame into the array
            $users[] = $user;
        }
        return $users;
    }

    public function add_user()
    {
        //retrieve user inputs from the registration form
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
        $password = trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));
        $lastname = filter_input(INPUT_POST, "lastname", FILTER_SANITIZE_STRING);
        $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

        //hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        echo "$username, $password, $firstname, $lastname, $email";

        //INSERT query
        $sql = "INSERT INTO " . $this->db->getUsersTable() . " VALUES(NULL, '$username', '$hashed_password', '$firstname', '$lastname', '$email')";

        //execute the query and return true if successful or false if failed
        if ($this->dbConnection->query($sql) === TRUE) {
            return "Congratulations! You have added an account.";
        } else {
            return false;
        }
    }

    public function verify_user()
    {
        // retrieve the username and password
        $username = trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
        $password = trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));

        //sql statement to filter the users table data with a username
        $sql = "SELECT password FROM " . $this->db->getUsersTable() . " WHERE username='$username'";

        //execute the query
        $query = $this->dbConnection->query($sql);
        //verify password; if password is valid, set a temporary cookie
        if ($query and $query->num_rows > 0) {
            $result_row = $query->fetch_assoc();

            $hash = $result_row['password'];
            if (password_verify($password, $hash)) {
                setcookie("username", $username, time() + 60, "/");
                $sql = "SELECT id FROM " . $this->db->getUsersTable() . " WHERE username='$username'";
                $query = $this->dbConnection->query($sql);
                $result_row = $query->fetch_assoc();
                $user_id = $result_row['id'];
                //echo $user_id;
                setcookie("user_id", $user_id, time() + 60, "/");
                /* name is your cookie's name
                  value is cookie's value
                  $int is time of cookie expires */
                //setcookie("user", $username);
                return "Congratulations! You are a verified user.";
            }
        }
    }

    public function view_user($id)
    {
        //the select sql statement
        $sql = "SELECT * FROM " . $this->tblUsers . " WHERE id='$id'";
        //execute the query
        $query = $this->dbConnection->query($sql);

        if ($query && $query->num_rows > 0) {
            $obj = $query->fetch_object();

            //create an user object
            $user = new User (stripslashes($obj->id), stripslashes($obj->username), stripslashes($obj->password), stripslashes($obj->firstname), stripslashes($obj->lastname), stripslashes($obj->email));
            //set the id for the user
            $user->setId($obj->id);
            echo "worked";
            return $user;
        }
        return false;
    }

    //the update_user method updates an existing user in the database. Details of the user are posted in a form. Return true if succeed; false otherwise.
    public function update_user($id)
    {
        if (!filter_has_var(INPUT_POST, 'username') ||
            !filter_has_var(INPUT_POST, 'password') ||
            !filter_has_var(INPUT_POST, 'firstname') ||
            !filter_has_var(INPUT_POST, 'lastname') ||
            !filter_has_var(INPUT_POST, 'email')) {
            return false;
        }
        $username = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING)));
        $password = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING)));
        $firstname = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING)));
        $lastname = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING)));
        $email = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL)));

        //update query
        $sql = "UPDATE " . $this->tblUsers .
            " SET username='$username', password='$password', firstname='$firstname', "
            . "lastname='$lastname' , email='$email' WHERE id='$id'";
        //execute
        return $this->dbConnection->query($sql);
    }

    public function get_user_id()
    {

    }

    public function delete_user($id)
    {
        $sql = " DELETE FROM " . $this->tblUsers . " WHERE id='$id'";
        return $this->dbConnection->query($sql);

    }


}