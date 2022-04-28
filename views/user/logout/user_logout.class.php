<?php
/*** Author: Alex Weber and James Ritter*
 * Date: 4/8/2022*
 * File: user_logout.class.php*
 * Description: The user logout page, displays the header/footer. Displays a confirmed message for the user and destroys the session array*/

class UserLogout extends UserIndexView
{
    //put your code here
    public function display()
    {
        parent::displayHeader("Logout");

        session_destroy();

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION = array();
        setcookie(session_name(), "", time() - 3600);

        session_destroy();

        ?>
        <br><h2 style="color: goldenrod">Logged Out</h2>
        <p>
            <span style="background: linear-gradient(to right, #ef5350, #f48fb1, #7e57c2, #2196f3, #26c6da, #43a047, #eeff41, #f9a825, #ff5722)"
                  class="logout">Thank you for your visit...</span></p>
        <input class="edit-buttons" type="button" value="Homepage" onclick='window.location.href = "<?= BASE_URL ?>"'>
        <?php
        //display page footer
        parent::displayFooter();
    }
}