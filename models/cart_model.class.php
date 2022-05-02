<?php

class CartModel
{
    // private data members
    // private $session;
    private $db;
    private $dbConnection;
    static private $_instance = NULL;

    public function __construct()
    {
        $this->db = Database::getDatabase();
        $this->dbConnection = $this->db->getConnection();
        $this->tblCart = $this->db->getCartTable();

        //Escapes special characters in a string for use in an SQL statement. This stops SQL inject in POST vars.
        foreach ($_POST as $key => $value) {
            $_POST[$key] = $this->dbConnection->real_escape_string($value);
        }

        //Escapes special characters in a string for use in an SQL statement. This stops SQL Injection in GET vars
        foreach ($_GET as $key => $value) {
            $_GET[$key] = $this->dbConnection->real_escape_string($value);
        }
    }

    public static function getCartModel()
    {
        if (self::$_instance == NULL) {
            self::$_instance = new CartModel();
        }
        return self::$_instance;
    }
    // methods go here

    // view cart
    public function view_cart()
    {
        // redirects user to the cart page
        header("Location: ../views/cart/index.php");
    }

    public function cart_details()
    {
        //redirects users to their shopping cart
        header("Location: ../views/cart/cart.php");
    }

    // add products into cart

    public function add_cart()
    {
        // define local host methods/info procedural approach
        $host = "localhost";
        $login = "root";
        $password = "";
        $database = "lewiesdb";


        $conn = @ new mysqli($host, $login, $password, $database);

        if ($conn->connect_errno) {
            $error = $conn->connect_error;
            exit();
        }
        // Add products into the cart table
        if (isset($_POST['pid'])) {
            $pid = $_POST['pid'];
            $pname = $_POST['pname'];
            $pprice = $_POST['pprice'];
            $pimage = $_POST['pimage'];
            $pcode = $_POST['pcode'];
            $pqty = $_POST['pqty'];
            $total_price = $pprice * $pqty;

            $stmt = $conn->prepare('SELECT product_code FROM cart WHERE product_code=?');
            $stmt->bind_param('s', $pcode);
            $stmt->execute();
            $res = $stmt->get_result();
            $r = $res->fetch_assoc();
            $code = $r['product_code'] ?? '';

            if (!$code) {
                $query = $conn->prepare('INSERT INTO cart (product_name,product_price,product_image,qty,total_price,product_code) VALUES (?,?,?,?,?,?)');
                $query->bind_param('ssssss', $pname, $pprice, $pimage, $pqty, $total_price, $pcode);
                $query->execute();

                echo '<div class="alert alert-success alert-dismissible mt-2">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Item added to your cart!</strong>
						</div>';
            } else {
                echo '<div class="alert alert-danger alert-dismissible mt-2">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Item already added to your cart!</strong>
						</div>';
            }
            // Set total price of the product in the cart table
            if (isset($_POST['qty'])) {
                $qty = $_POST['qty'];
                $pid = $_POST['pid'];
                $pprice = $_POST['pprice'];

                $tprice = $qty * $pprice;

                $stmt = $conn->prepare('UPDATE cart SET qty=?, total_price=? WHERE id=?');
                $stmt->bind_param('isi', $qty, $tprice, $pid);
                $stmt->execute();
            }
        }
    }

    public function remove()
    {
        // define local host methods/info procedural approach
        $host = "localhost";
        $login = "root";
        $password = "";
        $database = "lewiesdb";


        $conn = @ new mysqli($host, $login, $password, $database);

        if ($conn->connect_errno) {
            $error = $conn->connect_error;
            exit();
        }

        if (isset($_GET['remove'])) {
            $id = $_GET['remove'];

            $stmt = $conn->prepare('DELETE FROM cart WHERE id=?');
            $stmt->bind_param('i', $id);
            $stmt->execute();

            $_SESSION['showAlert'] = 'block';
            $_SESSION['message'] = 'Item removed from the cart!';
            header('location:cart.php');
        }
    }

    public function empty_cart()
    {
        // define local host methods/info procedural approach
        $host = "localhost";
        $login = "root";
        $password = "";
        $database = "lewiesdb";


        $conn = @ new mysqli($host, $login, $password, $database);

        if ($conn->connect_errno) {
            $error = $conn->connect_error;
            exit();
        }

        if (isset($_GET['clear'])) {
            $stmt = $conn->prepare('DELETE FROM cart');
            $stmt->execute();
            $_SESSION['showAlert'] = 'block';
            $_SESSION['message'] = 'All Items have been removed from the cart!';
            header('location:cart.php');
        }

    }

    public function order()
    {
        // define local host methods/info procedural approach
        $host = "localhost";
        $login = "root";
        $password = "";
        $database = "lewiesdb";


        $conn = @ new mysqli($host, $login, $password, $database);

        if ($conn->connect_errno) {
            $error = $conn->connect_error;
            exit();
        }


        // Checkout and save customer info in the orders table
        if (isset($_POST['cart']) && isset($_POST['cart']) == 'order') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $products = $_POST['products'];
            $grand_total = $_POST['grand_total'];
            $address = $_POST['address'];
            $pmode = $_POST['pmode'];

            $data = '';

            $stmt = $conn->prepare('INSERT INTO orders (name,email,phone,address,pmode,products,amount_paid)VALUES(?,?,?,?,?,?,?)');
            $stmt->bind_param('sssssss', $name, $email, $phone, $address, $pmode, $products, $grand_total);
            $stmt->execute();
            $stmt2 = $conn->prepare('DELETE FROM cart');
            $stmt2->execute();
            $data .= '<div class="text-center">
								<h1 class="display-4 mt-2 text-danger">Thank You!</h1>
								<h2 class="text-success">Your Order Placed Successfully!</h2>
								<h4 class="bg-danger text-light rounded p-2">Items Purchased : ' . $products . '</h4>
								<h4>Your Name : ' . $name . '</h4>
								<h4>Your E-mail : ' . $email . '</h4>
								<h4>Your Phone : ' . $phone . '</h4>
								<h4>Total Amount Paid : ' . number_format($grand_total, 2) . '</h4>
								<h4>Payment Mode : ' . $pmode . '</h4>
						  </div>';
            echo $data;
        }

    }

    // stores number of items in cart
    public function numberCart()
    {
        // define local host methods/info procedural approach
        $host = "localhost";
        $login = "root";
        $password = "";
        $database = "lewiesdb";


        $conn = @ new mysqli($host, $login, $password, $database);

        if ($conn->connect_errno) {
            $error = $conn->connect_error;
            exit();
        }

        if (isset($_GET['cartItem']) && isset($_GET['cartItem']) == 'cart_item') {
            $stmt = $conn->prepare('SELECT * FROM cart');
            $stmt->execute();
            $stmt->store_result();
            $rows = $stmt->num_rows;

            echo $rows;
        }

    }

}