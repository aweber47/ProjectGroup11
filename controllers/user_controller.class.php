<?php

/*** Author: your name*
 * Date: 4/7/2022*
 * File: user_controller.class.php*
 * Description: */
class UserController
{
    private $user_model;
   // private $review_model;

    //default constructor
    public function __construct()
    {
        //create an instance of the VideogameModel class
        $this->user_model = UserModel::getUserModel();
      //  $this->review_model = ReviewModel::getReviewModel();
    }

    //index action that displays all users
    public function index(){
        // retrieve all users and store them in an array
        $users = $this->user_model->list_user();

        if(!$users){
            //error
            $message = "There was a problem with displaying the users";
            $this->error($message);
            return;
        }
        // display all users
        $view = new UserIndex();
        $view->display($users);
    }
    public function addDisplay(){
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
        $detail->display("The user has been added");
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
        //$reviewList = new UserReviewIndex();
        //$view->display($user, $reviewlist);
        //$reviewlist->display($id, $reviews);
        $view->display($id, $user);
    }
    //update a user in the database
    public function update($id) {
        //update the user
        $update = $this->user_model->update_user($id);
        if (!$update) {
            //handle errors
            $message = "There was a problem updating the user id='" . $id . "'.";
            $this->error($message);
            return;
        }

        //display the updateed user details
        $confirm = "The user was successfully updated.";
        $user = $this->user_model->view_user($id);

        $view = new UserDetail();
        $view->display($user, $confirm);
    }
    //register
    public function register(){
        $register = new UserRegister();
        $register->display();
    }

    //login
    public function login(){
        $login = new UserLogin();
        $login->display();
    }
    //verify
    public function verify(){
        //echo "called";
        $verify = $this->user_model->verify_user();

        $verificationPage = new UserVerify();
        $verificationPage->display($verify);
    }
    //handle an error
    public function error($message) {
        //create an object of the Error class
        $error = new UserError();

        //display the error page
        $error->display($message);
    }

    //handle calling inaccessible methods
    public function __call($name, $arguments) {
        //$message = "Route does not exist.";
        // Note: value of $name is case sensitive.
        $message = "Calling method '$name' caused errors. Route does not exist.";

        $this->error($message);
        return;
    }


}