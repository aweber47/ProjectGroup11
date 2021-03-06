<?php

/*** Author: Alex Weber*
 * Date: 4/11/2022*
 * File: menu_detail.class.php*
 * Description: The menu detail page displays the buttons and menu detail of an item. The buttons are controlled by a session variable 'role' defined in the user controller.*/
class MenuDetail extends MenuIndexView
{
    public function display($menuItem, $confirm = "")
    {
        // display page header
        parent::displayHeader("Product Details");
        //session
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['role'])) {
            $role = $_SESSION['role'];
        }

        //get categories from a session variable
        if (isset($_SESSION['categories'])) {
            $categories = $_SESSION['categories'];
        }
        if (isset($_SESSION['login_status'])) {
            $login_status = $_SESSION['login_status'];
        }


        // echo is here (and commented out to fool the variable).
        //echo $role;

        // retrieve menu details
        $id = $menuItem->getId();
        $product = $menuItem->getProduct();
        $image = $menuItem->getImage();
        $category = $menuItem->getCategory();
        $qty = $menuItem->getQty();
        if ($category == 1) {
            $category = $categories[1];
        }
        if ($category == 2) {
            $category = $categories[2];
        }
        if ($category == 3) {
            $category = $categories[3];
        }
        $price = $menuItem->getPrice();
        $description = $menuItem->getDescription();
        if (strpos($image, "http://") === false and strpos($image, "https://") === false) {
            $image = BASE_URL . $image;
        }

        ?>

        <!-- Display menu details-->
        <!--<div id="main-header">Menu Details</div>-->

        <br>
        <?php
        error_reporting(0);
        if ($login_status == 0) { ?>
            <div id="advanced-features">
                <h4><span style="color: red"><strong>ALERT: <br> You must be logged in or signed in as a guest account. In order to send items to the cart!</strong></span>
                </h4>
                <h5 style="font-style: italic"> The reason we prevent you (as the user) from viewing the details is
                    because we don't want <br>
                    you to add an item to an unsaved cart. This prevents you from being to checkout later down the road.
                    Thank you for your understanding!</h5>
            </div>
            <div id="button-group">
                <input type="button" value=" Back to Homepage " class="edit-buttons"
                       onclick='window.location.href="<?= BASE_URL . "/menu/index/" ?>"'>
                <input type="button" value=" Login / Sign into a Guest Account " class="edit-buttons"
                       onclick='window.location.href="<?= BASE_URL . "/user/login/" ?>"'>
            </div>
            <br>
        <?php } else { ?>
            <br>
            <!-- Display message if item is added to cart-->
            <div id="button-group">
                <div id="message"
                     style="background-color: rgba(255, 215, 0, 0.90); margin: auto; border: 2px solid black; width: 80%"></div>
            </div>

            <br>
            <!-- Display menu details in a table -->
            <table id="menu-detail">
                <tr class="detail-image">
                    <td><img src="<?= $image ?>" alt="<?= $product ?>" style="width: 250px; height: 250px"></td>
                </tr>
                <tr class="detail-labels">
                    <th><?= $product ?></th>
                    <th>Category:</th>
                    <th>Price:</th>
                    <th>Description:</th>
                </tr>
                <tr class="detail-info">
                    <td><br></td>
                    <td><?= $category ?></td>
                    <td>$<?= $price ?></td>
                    <td><?= $description ?></td>
                </tr>
            </table>

            <?php
            error_reporting(0);
            // display edit and delete buttons if user role is 1
            ?>
            <div id="button-group">
                <form action="" class="form-submit">
                    <!-- Hidden input vars to store product info-->
                    <input type="hidden" class="pid" value="<?= $id ?>">
                    <input type="hidden" class="pname" value="<?= $product ?>">
                    <input type="hidden" class="pprice" value="<?= $price ?>">
                    <input type="hidden" class="pimage" value="<?= $image ?>">
                    <input type="hidden" class="pcode" value="<?= $id ?>">
                    <!-- Submit button -->
                    <input type="number" class="pqty" value="<?= $qty ?>">
                    <button class="detail-buttons" id="addItemBtn" value=" Add to Cart ">Add to Cart</button>

                    <input class="detail-buttons" type="button" id="return-button" value="Return to Menu"
                           onclick="window.location.href='<?= BASE_URL ?>/menu/index/<?= $id ?>'">

                    <!---display edit, delete and add buttons if user role is 1 -->
                    <?php
                    if (session_status() == PHP_SESSION_NONE) {
                        session_start();
                    }

                    if (isset($_SESSION['role'])) {
                        $role = $_SESSION['role'];

                        // put it into a copycat
                        $userrole = $role;
                    }
                    if ($userrole == 1) { ?>

                        <input class="detail-buttons" type="button" id="edit-button" value="Edit Item"
                               onclick="window.location.href = '<?= BASE_URL ?>/menu/edit/<?= $id ?>'">

                        <input class="detail-buttons" type="button" id="delete-button" value="Delete Item"
                               onclick="window.location.href = '<?= BASE_URL ?>/menu/deleteDisplay/<?= $id ?>'">

                        <input class="detail-buttons" type="button" id="edit-button" value="Add Menu Item"
                               onclick="window.location.href = '<?= BASE_URL ?>/menu/addDisplay/'">

                    <?php } ?>

                </form>
            </div>

            <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
            <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

            <script type="text/javascript">
                $(document).ready(function () {

                    // Send product details in the server
                    $("#addItemBtn").click(function (e) {
                        e.preventDefault();
                        var $form = $(this).closest(".form-submit");
                        var pid = $form.find(".pid").val();
                        var pname = $form.find(".pname").val();
                        var pprice = $form.find(".pprice").val();
                        var pimage = $form.find(".pimage").val();
                        var pcode = $form.find(".pcode").val();

                        var pqty = $form.find(".pqty").val();

                        $.ajax({
                            url: '<?= BASE_URL ?>/cart/add/',
                            method: 'post',
                            data: {
                                pid: pid,
                                pname: pname,
                                pprice: pprice,
                                pqty: pqty,
                                pimage: pimage,
                                pcode: pcode
                            },
                            success: function (response) {
                                $("#message").html(response);
                                window.scrollTo(0, 0);
                                load_cart_item_number();
                            }
                        });
                    });

                    // Load total no.of items added in the cart and display in the navbar
                    load_cart_item_number();
                });
            </script>

            <div id="confirm-message"><?= $confirm ?></div>

            <!--<div id="button-group">-->

        <?php } ?>
        <?php
        // display page footer
        parent::displayFooter();
    }
}

