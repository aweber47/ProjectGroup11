<?php

/*** Author: Alex Weber*
 * Date: 5/2/2022*
 * File: past_trans.class.php*
 * Description: Shows a users past trans data*/
class PastTransactions extends CartIndexView
{
    public function display()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['user_id'])) {
            $id = $_SESSION['user_id'];
        }
        if (isset($_SESSION['name'])) {
            $name = $_SESSION['name'];
        }

        parent::displayHeader("Past Transactions");

        // using procedural programming and a mix of ajax to run all cart features!!!!
        $host = "localhost";
        $login = "root";
        $password = "";
        $database = "lewiesdb";


        $conn = @ new mysqli($host, $login, $password, $database);

        if ($conn->connect_errno) {
            $error = $conn->connect_error;
            exit();
        }


        $stmt = $conn->prepare("SELECT * FROM orders WHERE name='$name'");
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            $noname = FALSE;
        } else {
            $noname = TRUE;
        }

        if ($noname === TRUE) {
            ?>
            <br><br><br><br>
            <?php
            while ($row = $result->fetch_assoc()): ?>
                <table id="menu-detail">
                    <tr class="detail-labels">
                        <th>Order Id:</th>
                        <th>Phone:</th>
                        <th>Address:</th>
                        <th>Payment Method:</th>
                        <th>Products:</th>
                        <th>Total:</th>
                    </tr>
                    <tr class="detail-info">
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['phone'] ?></td>
                        <td><?= $row['address'] ?></td>
                        <td><?= $row['pmode'] ?></td>
                        <td><?= $row['products'] ?></td>
                        <td><?= $row['amount_paid'] ?></td>
                    </tr>
                </table>
                <br>
            <?php
            endwhile;
            ?>
            <div id="button-group">
                <input class="edit-buttons" type="button" name="account" value=" Back to Account "
                       onclick="window.location.href='<?= BASE_URL ?>/user/detail/<?= $id ?>'">
            </div>

            <?php
        } else {
            ?>
            <br><br><br><br>
            <div id="menu-detail">
                <fieldset id="edit-fieldset">
                    <legend>Sorry</legend>
                    <h3>You don't have any past transactions!</h3>

                    <br>

                    <div id="button-group">
                        <input class="edit-buttons" type="button" name="account" value=" Back to Account "
                               onclick="window.location.href='<?= BASE_URL ?>/user/detail/<?= $id ?>'">

                        <input class="edit-buttons" type="button" value=" Start Shopping "
                               onclick="window.location.href='<?= BASE_URL ?>/menu/index/'">
                    </div>

                </fieldset>
            </div>
            <br>


            <?php
        }
        ?>
        <?php
        parent::displayFooter();
    }
}