<?php
/*** Author: your name*
 * Date: 4/8/2022*
 * File: user_register.class.php*
 * Description: */

class UserRegister extends UserIndexView{

    //put your code here
    public function display(){
        //display page header
        parent::displayHeader("Signup");
        ?>

        <!--        <div id="main-header">Signup</div>-->

        <!-- display the user information register in a form -->
        <br><br><br><br>
        <form action='<?= BASE_URL . "/user/add/" ?>' method="post">
            <input type="hidden" name="id" value="<?= $id ?>">
            <br><br>
            <div id="menu-detail">
                <table style="margin: auto">
                    <tr class="detail-labels">
                        <th>Username</th>
                        <th>Password</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                    </tr>
                    <tr class="detail-info">
                        <td><input name="username" type="text" size="50" placeholder="username" onfocus="this.placeholder = ' '" required></td>
                        <td><input name="password" type="text" size="50" placeholder="password" onfocus="this.placeholder = ' '" required></td>
                        <td><input name="firstname" type="text" size="50" placeholder="first name" onfocus="this.placeholder = ' '" required></td>
                        <td><input name="lastname" type="text" size="50" placeholder="last name" onfocus="this.placeholder = ' '" required></td>
                        <td><input name="email" type="email" size="50" placeholder="exampleaddress@iu.edu" onfocus="this.placeholder = ' '" required></td>
                    </tr>
                </table>
            </div>
            <!--<p><strong>Username</strong><br>
                <input name="username" type="text" size="40" placeholder="username" onfocus="this.placeholder = ' '" required></p>
            <p><strong>Password</strong><br>
                <input name="password" type="text" size="100" placeholder="password" onfocus="this.placeholder = ' '" required></p>
            <p><strong>First name</strong><br>
                <input name="firstname" type="text" size="40" placeholder="first name" onfocus="this.placeholder = ' '" required></p>
            <p><strong>Last name</strong><br>
                <input name="lastname" type="text" size="40" placeholder="last name" onfocus="this.placeholder = ' '" required></p>
            <p><strong>Email</strong><br>
                <input name="email" type="email" size="100" placeholder="exampleaddress@iu.edu" onfocus="this.placeholder = ' '" required></p>-->

            <div id="button-group">
                <input class="edit-buttons" type="submit" name="action" value="Signup">
                <input class="edit-buttons" type="button" value="Cancel"
                       onclick='window.location.href = "<?= BASE_URL . "/user/login/" ?>"'>
            </div>
        </form>
        <?php
        //display page footer
        parent::displayFooter();
    }
}
