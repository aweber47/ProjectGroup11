<?php

/*** Author: Alex Weber and James Ritter*
 * Date: 4/8/2022*
 * File: user_index.class.php*
 *
 * Description:
 * Method was created but isn't used. In the future
 * a practical purpose would be to create an ADMIN HOST for the webpage which displays the list
 * of consumers for the owner of the business. We did not implement this future as this webpage is more
 * focused on the client or user application features.
 */
class UserIndex extends UserIndexView
{
    /*
     * the display method accepts an array of user objects and displays
     * them in a grid.
     */
    public static function displayHeader($title)
    {
        // parent::displayHeader("Search User");
    }

    public function display($users)
    {
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }
        if (isset($_SESSION['user_id'])) {
            $Adminid = $_SESSION['user_id'];
        }

        ?>
        <div id="main-header"> Known Registered Users</div>

        <div class="grid-container">
            <?php
            if ($users === 0) {
                echo "No user was found.<br><br><br><br><br>";
            } else {
                //display the users in a grid; six users per row
                foreach ($users as $i => $user) {
                    $id = $user->getId();
                    $username = $user->getUsername();
                    //$password = $user->getPassword();
                    $firstname = $user->getFirstname();
                    $lastname = $user->getLastname();
                    $email = $user->getEmail();
                    if ($i % 6 == 0) {
                        echo "<div class='row'>";
                    }
                    echo "<div class='col'><p><a href='", BASE_URL, "/user/detail/$id'><span>$username</a><br>First Name: $firstname<br>" . "<br>Last Name: $lastname<br>" . "<br> Email: $email<br>" . "</span></p></div>";
                    ?>
                    <?php
                    if ($i % 6 == 5 || $i == count($users) - 1) {
                        echo "</div>";
                    }
                }
            }
            ?>
        </div>
        <div id="button-group">
            <input class="edit-buttons" type="button" value="Back to Account" onclick='window.location.href = "<?= BASE_URL . "/user/detail/$id" ?>"'>
        </div>


        <?php
    } //end of display method

    public static function displayFooter()
    {
        parent::displayFooter();
    }
}
