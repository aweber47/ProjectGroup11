<?php

/*** Author: Alex Weber*
 * Date: 4/11/2022*
 * File: user_controller.class.php*
 * Description: User Controller holds all actions invoked by the models */
class UserController
{
    private $user_model;

    //default constructor
    public function __construct()
    {
        //create an instance of the UserModel class
        $this->user_model = UserModel::getUserModel();
    }

    //index action that displays all users
    public function index()
    {
        // retrieve all users and store them in an array
        $users = $this->user_model->list_user();

        if (!$users) {
            //error
            $message = "There was a problem with displaying the users";
            $this->error($message);
            return;
        }
        // display all users
        $view = new UserIndex();
        $view->display($users);
    }

    public function addDisplay()
    {
        // create an object
        $error = new UserRegister();
        $error->display();
    }

    public function add()
    {
        //retrieve all users and store them in an array
        $users = $this->user_model->add_user();
        if (!$users) {
            //display an error
            $message = "There was a problem displaying users.";
            $this->error($message);
            return;
        }
        $detail = new UserVerify();
        $detail->display("Login Successful");
    }

    //show details of a user
    public function detail($id)
    {
        //retrieve the specific user
        $user = $this->user_model->view_user($id);
        //  $reviews = $this->review_model->list_review($id);

        if (!$user) {
            //display an error
            $message = "There was a problem displaying the user id='" . $id . "'.";
            $this->error($message);
            return;
        }

        //display user details
        $view = new UserDetail();
        $view->display($id, $user);
    }

    // edit a users information
    public function edit($id)
    {
        // retrieve user info
        $user = $this->user_model->view_user($id);

        // error handle
        if (!$user) {
            // display
            $message = "There was a problem displaying the users information id='" . $id . "'.";
            $this->error($message);
            return;
        }

        $view = new UserEdit();
        $view->display($user);
    }

    //update a user in the database
    public function update($id)
    {
        //update the user
        $update = $this->user_model->update_user($id);

        if (!$update) {
            //handle errors
            echo $update;
            $message = "There was a problem updating the user id='" . $id . "'.";
            $this->error($message);
            return;
        }

        //display the updated user details
        $confirm = "The user was successfully updated.";
        $view = new UserUpdate();
        $view->display($confirm, $id);
    }

    //register
    public function register()
    {
        $register = new UserRegister();
        $register->display();
    }

    //login
    public function login()
    {
        $login = new UserLogin();
        $login->display();
    }

    // logout
    public function logout(){
        $logout = new UserLogout();
        $logout->display();
    }

    //verify
    public function verify()
    {
        //echo "called";
        $verify = $this->user_model->verify_user();

        if(!$verify){
            $verificationPage = new UserNonVerify();
            $verificationPage->display($verify);
        }else{
            $verificationPage = new UserVerify();
            $verificationPage->display($verify);
        }
    }

    //handle an error
    public function error($message)
    {
        //create an object of the Error class
        $error = new UserError();

        //display the error page
        $error->display($message);
    }

    // delete display
    public function deleteDisplay($id)
    {
        $user = $this->user_model->view_user($id);

        // error handle
        if (!$user) {
            $message = "There was an issue trying to obtain user id='" . $id . "'.";
            $this->error($message);
            return;
        }
        $error = new UserDelete();
        $error->display($user);

    }

    //deletes the user
    public function delete($id)
    {
        $user = $this->user_model->delete_user($id);

        // error handle
        if (!$user) {
            $message = "There was an issue trying to delete user id='" . $id . "'.";
            $this->error($message);
            return;
        }
        $detail = new UserVerify();
        $detail->display("The User has been removed from the database");
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