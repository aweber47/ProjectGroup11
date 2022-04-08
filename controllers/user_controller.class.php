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
    public function add()
    {
        //retrieve all users and store them in an array
        $users = $this->user_model->add_user();
        echo "Called";
        /*if (!$users) {
            //display an error
            $message = "There was a problem displaying users.";
            $this->error($message);
            return;
        }

        // display all users
        $view = new VideogameIndex();
        $view->display($users);
         *
         */
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

}