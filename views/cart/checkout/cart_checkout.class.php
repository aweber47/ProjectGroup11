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

        // display header and title
        parent::displayHeader("Checkout Page");
        ?>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 px-4 pb-4" id="order">
                    <h4 class="text-center text-info p-2">Complete your order!</h4>
                    <div class="jumbotron p-3 mb-2 text-center">
                        <h6 class="lead"><b>Product(s) : </b><?= $allItems; ?></h6>
                        <h6 class="lead"><b>Delivery Charge : </b>Free</h6>
                        <h5><b>Total Amount Payable : </b><?= number_format($grand_total, 2) ?>/-</h5>
                    </div>
                    <form action="" method="post" id="placeOrder">
                        <input type="hidden" name="products" value="<?= $allItems; ?>">
                        <input type="hidden" name="grand_total" value="<?= $grand_total; ?>">
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Enter Name" required>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="Enter E-Mail" required>
                        </div>
                        <div class="form-group">
                            <input type="tel" name="phone" class="form-control" placeholder="Enter Phone" required>
                        </div>
                        <div class="form-group">
                            <textarea name="address" class="form-control" rows="3" cols="10"
                                      placeholder="Enter Delivery Address Here..."></textarea>
                        </div>
                        <h6 class="text-center lead">Select Payment Mode</h6>
                        <div class="form-group">
                            <select name="pmode" class="form-control">
                                <option value="" selected disabled>-Select Payment Mode-</option>
                                <option value="cod">Cash On Delivery</option>
                                <option value="netbanking">Net Banking</option>
                                <option value="cards">Debit/Credit Card</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" value="Place Order" class="btn btn-danger btn-block">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

        <script type="text/javascript">
            $(document).ready(function () {

                // Sending Form data to the server
                $("#placeOrder").submit(function (e) {
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