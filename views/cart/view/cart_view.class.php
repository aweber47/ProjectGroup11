<?php

/*** Author: Alex Weber and James Ritter*
 * Date: 5/2/2022*
 * File: cart_view.class.php*
 * Description: Displays the cart */
class CartView extends CartIndexView
{

    public function display()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        // need a php session that would hold the cart data
        if (isset($_SESSION['login_status'])) {
            $login_status = $_SESSION['login_status'];
        }

        parent::displayHeader("Your Shopping Cart");
        ?>
        <br><br><br><br>
        <head style="background-color: black">
            <meta charset="UTF-8">
            <meta name="author" content="Sahil Kumar & Aex Weber">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <title style="background-color: black">Cart</title>
            <link style="background-color: black" rel='stylesheet'
                  href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css'/>
            <link style="background-color: black" rel='stylesheet'
                  href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css'/>
        </head>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div style="display:<?php if (isset($_SESSION['showAlert'])) {
                        echo $_SESSION['showAlert'];
                    } else {
                        echo 'none';
                    }
                    unset($_SESSION['showAlert']); ?>" class="alert alert-success alert-dismissible mt-3">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong><?php if (isset($_SESSION['message'])) {
                                echo $_SESSION['message'];
                            }
                            unset($_SESSION['showAlert']); ?></strong>
                    </div>
                    <div class="table-responsive mt-2">
                        <table class="table table-bordered table-striped text-center">
                            <thead>
                            <tr>
                                <td colspan="7"
                                    style="background-color: rgba(255, 215, 0, 0.75); margin: auto; border: 2px solid black;">
                                    <h4 class="text-center text-info m-0"><span
                                                style="color: black; font-weight: bold; ">Products in your cart!</span>
                                    </h4>
                                </td>
                            </tr>
                            <tr style="background-color: rgba(255,215,0,0.75); margin: auto; border: 2px solid black;">
                                <th style="background-color: rgba(255, 215, 0, 0.75);">ID</th>
                                <th style="background-color: rgba(255, 215, 0, 0.75);">Image</th>
                                <th style="background-color: rgba(255, 215, 0, 0.75);">Product</th>
                                <th style="background-color: rgba(255, 215, 0, 0.75);">Price</th>
                                <th style="background-color: rgba(255, 215, 0, 0.75);">Quantity</th>
                                <th style="background-color: rgba(255, 215, 0, 0.75);">Total Price</th>
                                <th style="background-color: rgba(255, 215, 0, 0.75);">
                                    <form action="" class="form-submit">
                                        <button class="emptyCart" style="background-color: #7e57c2;"
                                                onclick="return confirm('Are you sure want to clear your cart?');"><i
                                                    class="fas fa-trash" style='color: whitesmoke'></i>&nbsp;&nbsp;<span
                                                    style="color: white; background-color: #7e57c2">Clear Cart</span>
                                        </button>
                                    </form>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $host = "localhost";
                            $login = "root";
                            $password = "";
                            $database = "lewiesdb";

                            $conn = @ new mysqli($host, $login, $password, $database);

                            if ($conn->connect_errno) {
                                $error = $conn->connect_error;
                                exit();
                            }

                            $stmt = $conn->prepare('SELECT * FROM cart');
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $grand_total = 0;
                            while ($row = $result->fetch_assoc()):
                                ?>
                                <tr style="background-color: rgba(255,215,0,0.90); margin: auto; border: 2px solid black;">
                                    <td style="background-color: rgba(255, 215, 0, 0.75);"><?= $row['id'] ?></td>
                                    <input type="hidden" class="pid" value="<?= $row['id'] ?>">

                                    <td style="background-color: rgba(255, 215, 0, 0.75);"><img
                                                src="<?= $row['product_image'] ?>" width="50"></td>

                                    <td style="background-color: rgba(255, 215, 0, 0.75);"><?= $row['product_name'] ?></td>

                                    <td style="background-color: rgba(255, 215, 0, 0.75);">
                                        $<?= number_format($row['product_price'], 2); ?></td>
                                    <input type="hidden" class="pprice" value="<?= $row['product_price'] ?>">
                                    <td style="background-color: rgba(255, 215, 0, 0.75);">
                                        <input type="number" class="form-control itemQty" value="<?= $row['qty'] ?>"
                                               style="width:75px;">
                                    </td>


                                    <td style="background-color: rgba(255, 215, 0, 0.75);">
                                        $<?= number_format($row['total_price'], 2); ?></td>


                                    <td style="background-color: rgba(255, 215, 0, 0.75);">
                                        <form action="" class="form-submit">
                                            <button class="removeId" value="<?= $row['id'] ?>"
                                                    style="background-color: #7e57c2"
                                                    onclick="return confirm('Are you sure want to remove this item?');">
                                                <i class="fas fa-trash-alt" style="color: whitesmoke"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                <?php $grand_total += $row['total_price']; ?>
                            <?php endwhile; ?>
                            <tr style="background-color: rgba(255,215,0,0.90); margin: auto; border: 2px solid black;">
                                <td colspan="3">
                                    <a href="<?= BASE_URL ?>/menu/index/" style="background-color: #7e57c2"
                                       class="btn btn-success"><i
                                                class="fas fa-cart-plus"></i>&nbsp;&nbsp;Continue
                                        Shopping</a>
                                </td>
                                <td colspan="2"><b>Grand Total</b></td>
                                <td style="background-color: rgba(255, 215, 0, 0.75);">
                                    <b>$<?= number_format($grand_total, 2); ?>
                                    </b></td>
                                <td>
                                    <a href="<?= BASE_URL ?>/cart/CartCheckout/"
                                       style="background-color: #7e57c2"
                                       class="btn btn-info <?= ($grand_total > 1) ? '' : 'disabled'; ?>"><i
                                                class="far fa-credit-card"></i>&nbsp;&nbsp;Checkout</a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <br>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

        <script type="text/javascript">
            $(document).ready(function () {

                // Change the item quantity
                $(".itemQty").on('change', function () {
                    var $el = $(this).closest('tr');

                    var pid = $el.find(".pid").val();
                    var pprice = $el.find(".pprice").val();
                    var qty = $el.find(".itemQty").val();
                    location.reload(true);
                    $.ajax({
                        url: '<?= BASE_URL ?>/cart/add/',
                        method: 'post',
                        cache: true,
                        data: {
                            qty: qty,
                            pid: pid,
                            pprice: pprice
                        },
                        success: function (response) {
                            console.log(response);
                        }
                    });
                });
                $(".removeId").click(function (e) {
                    var confirmationUser;
                    var result = confirm("Are you sure?");
                    if (result == true) {
                        confirmationUser = true;
                    } else {
                        confirmationUser = false;
                    }

                    if (confirmationUser == true) {
                        e.preventDefault();
                        var $form = $(this).closest(".form-submit");
                        var removeId = $form.find(".removeId").val();

                        $.ajax({
                            url: '<?= BASE_URL?>/cart/remove/',
                            method: 'get',
                            data: {
                                remove: removeId
                            },
                            success: function (response) {
                                $("#message").html(response);
                                window.scrollTo(0, 0);
                                window.location.reload();
                            }
                        });
                    }
                });

                $(".emptyCart").click(function (e) {
                    var confirmationUser;
                    var result = confirm("Are you sure?");
                    if (result == true) {
                        confirmationUser = true;
                    } else {
                        confirmationUser = false;
                    }

                    if (confirmationUser == true) {
                        e.preventDefault();
                        var $form = $(this).closest(".form-submit");
                        var emptyCart = $form.find(".emptyCart").val();

                        $.ajax({
                            url: '<?= BASE_URL ?>/cart/emptyCart/',
                            method: 'get',
                            data: {
                                clear: emptyCart
                            },
                            success: function (response) {
                                $("#message").html(response);
                                window.scrollTo(0, 0);
                                window.location.reload();
                            }

                        });
                    }
                });
            });
            // Load total no.of items added in the cart and display in the navbar

        </script>
        <?php
        parent::displayFooter();
    }
}