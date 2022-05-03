<?php
/*** Author: James Ritter and Alex Weber*
 * Date: 4/11/2022*
 * File: cart_checkout.class.php*
 * Description: cart checkout view displayed when user checkouts. Destory session*/

class CartCheckout extends CartIndexView
{
    public function display()
    {
        $host = "localhost";
        $login = "root";
        $password = "";
        $database = "lewiesdb";

        $conn = @ new mysqli($host, $login, $password, $database);

        if ($conn->connect_errno) {
            $error = $conn->connect_error;
            exit();
        }
        $grand_total = 0;
        $allItems = '';
        $items = [];

        $sql = "SELECT CONCAT(product_name, '(',qty,')') AS ItemQty, total_price FROM cart";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $grand_total += $row['total_price'];
            $items[] = $row['ItemQty'];
        }
        $allItems = implode(', ', $items);

        // MVC code...
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // obtain login status
        if (!isset($_SESSION['login_status'])) {
            $login_status = FALSE;
        } else {
            $login_status = $_SESSION['login_status'];
        }
        if ($login_status === 4) {
            $guestAccount = TRUE;
        }

        if (isset($_SESSION['name']) and isset($_SESSION['user_email'])) {
            $username = $_SESSION['name'];
            $user_email = $_SESSION['user_email'];
        }

        // display header and title
        parent::displayHeader("Checkout Page");
        ?>
        <!-- id='order' is important do not remove. This id calls the ajax.-->
        <div class="detail-info" id="order">
        <div id="menu-detail">
            <div id="button-group">
                <h2>Complete your order!</h2>
                <hr>
                <h4><b>Products: </b><?= $allItems ?></h4>
                <h4>Delivery Charge : Free</h4>
                <hr>
                <h4>Total Price : <?= number_format($grand_total, 2) ?></h4>

            </div>
        </div>
        <br>

        <?php if ($login_status === 4) { ?>
        <div class="detail-info-all">
            <form action="" method="post" id="edit-form" class="placeOrder">
                <!--Hidden values but get placed into the database-->
                <input class="edit-right" type="hidden" name="products" value="<?= $allItems; ?>">
                <input class="edit-right" type="hidden" name="grand_total" value="<?= $grand_total; ?>">

                <!--User displayed form-->
                <fieldset id="edit-fieldset">
                    <legend>Checkout Form</legend>


                    <label for="name" class="edit-left">Name: </label>
                    <input id="name" class="edit-right" type="text" name="name" placeholder="Enter Name" required>

                    <br>

                    <label for="email" class="edit-left">Email: </label>
                    <input id="email" class="edit-right" type="email" name="email" placeholder="Enter E-Mail"
                           required>

                    <br>

                    <label for="phone" class="edit-left">Phone: </label>
                    <input id="phone" class="edit-right" type="tel" name="phone" placeholder="Enter Phone" required>

                    <br>

                    <label for="address" class="edit-left">Address: </label>
                    <textarea id="address" class="edit-right" name="address"
                              placeholder="Enter Delivery Address Here..."></textarea>


                    <label for="pmode" class="edit-left">Payment: </label>
                    <select id="pmode" class="edit-right" name="pmode">
                        <option value="" selected disabled>-Method of Payment-</option>
                        <option value="Cash on Delivery">Cash On Delivery</option>
                        <option value="Network Banking">Net Banking</option>
                        <option value="Credit/Debit Card">Debit/Credit Card</option>
                    </select>

                    <div id="button-group">
                        <input type="submit" name="submit" value="Place Order" class="edit-buttons">
                        <input type="button" value=" Back to Cart " class="edit-buttons"
                               onclick="window.location.href='<?= BASE_URL ?>/cart/cart/'">
                    </div>
                </fieldset>
            </form>
        </div>
        <br>
    <?php } else { ?>
        <?php if ($login_status === FALSE) { ?>
            <div class="detail-info-all">
                <form action="" method="post" id="edit-form" class="placeOrder">
                    <!--Hidden values but get placed into the database-->
                    <input class="edit-right" type="hidden" name="products" value="<?= $allItems; ?>">
                    <input class="edit-right" type="hidden" name="grand_total" value="<?= $grand_total; ?>">

                    <!--User displayed form-->
                    <fieldset id="edit-fieldset">
                        <legend>Checkout Form</legend>


                        <label for="name" class="edit-left">Name: </label>
                        <input id="name" class="edit-right" type="text" name="name" placeholder="Enter Name" required>

                        <br>

                        <label for="email" class="edit-left">Email: </label>
                        <input id="email" class="edit-right" type="email" name="email" placeholder="Enter E-Mail"
                               required>

                        <br>

                        <label for="phone" class="edit-left">Phone: </label>
                        <input id="phone" class="edit-right" type="tel" name="phone" placeholder="Enter Phone" required>

                        <br>

                        <label for="address" class="edit-left">Address: </label>
                        <textarea id="address" class="edit-right" name="address"
                                  placeholder="Enter Delivery Address Here..."></textarea>


                        <label for="pmode" class="edit-left">Payment: </label>
                        <select id="pmode" class="edit-right" name="pmode">
                            <option value="" selected disabled>-Method of Payment-</option>
                            <option value="Cash on Delivery">Cash On Delivery</option>
                            <option value="Network Banking">Net Banking</option>
                            <option value="Credit/Debit Card">Debit/Credit Card</option>
                        </select>

                        <div id="button-group">
                            <input type="submit" name="submit" value="Place Order" class="edit-buttons">
                            <input type="button" value=" Back to Cart " class="edit-buttons"
                                   onclick="window.location.href='<?= BASE_URL ?>/cart/cart/'">
                        </div>
                    </fieldset>
                </form>
            </div>
            <br>
        <?php } else { ?>
            <div class="detail-info-all">
            <form action="" method="post" id="edit-form" class="placeOrder">
                <!--Hidden values but get placed into the database-->
                <input class="edit-right" type="hidden" name="products" value="<?= $allItems; ?>">
                <input class="edit-right" type="hidden" name="grand_total" value="<?= $grand_total; ?>">

                <!--User displayed form-->
                <fieldset id="edit-fieldset">
                    <legend>Checkout Form</legend>

                    <!-- Message that displays the current logged in user -->
                    <label for="message" style="font-style: italic" class="edit-left">Hello: </label>
                    <h3 id="message" style="font-style: italic" class="edit-right"><b
                                style="color: #7e57c2"><?php echo $username; ?></b>, please fill out the rest of the
                        checkout form to ensure order confirmation! </h3>

                    <br>

                    <label for="name" class="edit-left">Name: </label>
                    <input id="name" class="edit-right" type="text" name="name" value="<?= $username ?>">

                    <br>

                    <label for="email" class="edit-left">Email: </label>
                    <input id="email" class="edit-right" type="email" name="email" value="<?= $user_email ?>">

                    <br>

                    <label for="phone" class="edit-left">Phone: </label>
                    <input id="phone" class="edit-right" type="tel" name="phone" placeholder="Enter Phone" required>

                    <br>

                    <label for="address" class="edit-left">Address: </label>
                    <textarea id="address" class="edit-right" name="address"
                              placeholder="Enter Delivery Address Here..."></textarea>


                    <label for="pmode" class="edit-left">Payment: </label>
                    <select id="pmode" class="edit-right" name="pmode">
                        <option value="" selected disabled>-Method of Payment-</option>
                        <option value="Cash on Delivery">Cash On Delivery</option>
                        <option value="Network Banking">Net Banking</option>
                        <option value="Credit/Debit Card">Debit/Credit Card</option>
                    </select>

                    <br>

                    <div id="button-group">
                        <input type="submit" name="submit" value="Place Order" class="edit-buttons">
                        <input type="button" value=" Back to Cart " class="edit-buttons"
                               onclick="window.location.href='<?= BASE_URL ?>/cart/cart/'">
                    </div>
                </fieldset>
            </form>
            <br>
        <?php } ?>
        </div>
    <?php } ?>

        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

        <script type="text/javascript">
            $(document).ready(function () {

                // Sending Form data to the server
                $(".placeOrder").submit(function (e) {
                    e.preventDefault();
                    $.ajax({
                        url: '<?= BASE_URL ?>/cart/order/',
                        method: 'post',
                        data: $('form').serialize() + "&cart=order",
                        success: function (response) {
                            $("#order").html(response);
                        }
                    });
                });

                // Load total no.of items added in the cart and display in the navbar
                load_cart_item_number();

            });
        </script>
        <?php
        // potental code back here
        ?>
        <?php
        parent::displayFooter();
    }
}