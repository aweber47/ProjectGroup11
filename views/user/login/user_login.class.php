<?php
/*** Author: Alex Weber *
 * Date: 4/11/2022*
 * File: user_login.class.php*
 * Description: This is the login screen for the user. Holds a login status variable (session) that determines what to display for the user.  */

class UserLogin extends UserIndexView{
    public function display(){
        //display page header
        parent::displayHeader("Login");

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        // set the login status (default is to show the login form)
        $login_status = 2;

        //login - status session var
        if (isset($_SESSION['login_status'])) {
            $login_status = $_SESSION['login_status'];
        }
        //obtain user id session variable
        if (isset($_SESSION['user_id'])) {
            $id = $_SESSION['user_id'];
        }
        
        /*************************************************************************************
         *                       settings for login_status                        *
         ************************************************************************************/
        // if login status is set display the user to log out.
        if ($login_status == 1) {
            // session['name'] is the username of the account that is logged in.
            echo "<p><strong>You are logged in as  " . $_SESSION['name'] . "</strong></p>";
            ?>
            <input type="hidden" name="id" value="<?= $id ?>">
            <!-- allow the user to view their details and edit/delete account -->
            <input class="edit-buttons" type="button" value="View Account"
                   onclick="window.location.href = '<?= BASE_URL ?>/user/detail/<?= $id ?>'"> |
            <input class="edit-buttons" type='button' value='Logout' onclick='window.location.href = "<?= BASE_URL . "/user/logout/" ?>"'>
        <?php } ?>

        <?php
        // only display form if login_status is not set
        if ($login_status == 2) {
            ?>
            <!-- display user details in a form -->
            <form class="login-form" action='<?= BASE_URL . "/user/verify/" ?>' method="post">
                <input type="hidden" name="id" value="<?= $id ?>">

                <label for="username">Username</label>
                    <input id="username" name="username" type="text" size="40" placeholder="username" onfocus="this.placeholder = ' '" required>

                <br>
                
                <label for="password">Password</label>
                    <input id="password" name="password" type="password" size="100" placeholder="password" onfocus="this.placeholder = ' '" required>
                
                <input class="edit-buttons" type="submit" name="action" value="Login">
                
                <input class="edit-buttons" type="button" value="Cancel" onclick='window.location.href = "<?= BASE_URL . "/welcome/index/" ?>"'>
                
                <input class="edit-buttons" type="button" value="Signup" onclick='window.location.href = "<?= BASE_URL . "/user/register/" ?>"'>
            </form>
        <?php } ?>
        <?php
        //display page footer
        parent::displayFooter();
    }
}