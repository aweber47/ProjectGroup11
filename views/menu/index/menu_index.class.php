<?php
/*** Author: Alex Weber and James Ritter*
 * Date: 4/5/2022*
 * File: menu_index.class.php*
 * Description: Displays the whole menu */

class MenuIndex extends MenuIndexView
{
    public static function displayHeader($title)
    {

    }

    public function display($menuItems)
    {

        // attempt to implement paginator
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        // retrieve session vars related to paginator
        $page = $_SESSION['page'];
        $total_pages = $_SESSION['total_page'];

        //get categories from a session variable
        if (isset($_SESSION['categories'])) {
            $categories = $_SESSION['categories'];
        }

        // obtain the user role
        if (isset($_SESSION['role'])) {
            $role = $_SESSION['role'];
        }
        if (isset($_SESSION['login_status'])) {
            $login_status = $_SESSION['login_status'];
        }

        //display page header
        parent::displayHeader("Our Menu");


        if ($login_status == 0) { ?>
            <div id="advanced-features">
                <h4><span style="color: red"><strong>ALERT: <br> You must be logged in or signed in as a guest account; <br>In order to send items to the cart!</strong></span>
                </h4>
            </div>
        <?php } ?>
        <?php
        //If user is an admin allow the 'add menu item' button show on the list menu page
        if ($role == 1) { ?>
            <!---QUICK WAY TO ADD A MENU ITEM-->
            <div id="button-group">
                <input class="detail-buttons" type="button" id="edit-button"
                       value="Hello Admin User, Need to Quickly Add a Menu Item?   CLICK ME!!!"
                       onclick="window.location.href = '<?= BASE_URL ?>/menu/addDisplay/'">
            </div>
        <?php } ?>
        <!--<div id="main-header"> Items within the Menu</div>-->
        <div class="grid-container">
            <?php
            if ($menuItems === 0) {
                echo "No menu items were found.<br><br><br><br><br>";
            } else {
                // display the menu items; 6 menu per row
                foreach ($menuItems as $i => $menuItem) {
                    $id = $menuItem->getId();
                    $product = $menuItem->getProduct();
                    $image = $menuItem->getImage();
                    if (strpos($image, "http://") === false and strpos($image, "https://") === false) {
                        $image = BASE_URL . $image;
                    }
                    $category = $menuItem->getCategory();

                    // shift attribute from category number to category name
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
                    if ($i % 6 == 0) {
                        echo "<div class='row'>";
                    }

                    echo "


                        <div id='menu-index'>
                            <br>
                            <table id='menu-detail-all'>
                                <tr class='detail-image-all'>
                                    <td>
                                        <a href='", BASE_URL, "/menu/detail/$id'><img class='menu-pic' alt='Food Item' src='" . $image . "'></a>
                                    </td>
                                </tr>
                                <tr class='detail-labels-all'>
                                    <th>$product</th>
                                    <th>Category:</th>
                                    <th>Price:</th>
                                    <th>Description:</th>
                                </tr>
                                <tr class='detail-info-all'>
                                    <td><!--EMPTY--><br></td>
                                    <td>$category</td>
                                    <td>$$price</td>
                                    <td>$description</td>
                                </tr>
                            </table>
                            </div>
                      ";
                    ?>

                    <?php
                    if ($i % 6 == 5 || $i == count($menuItems) - 1) {
                        echo "</div>";
                    }
                }
                $_SESSION['count']++;
            }
            ?>
        </div>

        <!---Determine the hidden paginator -->
        <!-- Pagination controls at bottom of menu page -->
        <div id="pagination-control" align="center">
            <ul class="pagination">
                <li><a href="?page=1">First</a></li>
                <li class="<?php if ($page <= 1) {
                    echo 'disabled';
                } ?>">
                    <a href="<?php if ($page <= 1) {
                        echo '#';
                    } else {
                        echo "?page=" . ($page - 1);
                    } ?>">Prev</a>
                </li>
                <li class="<?php if ($page >= $total_pages) {
                    echo 'disabled';
                } ?>">
                    <a href="<?php if ($page >= $total_pages) {
                        echo '#';
                    } else {
                        echo "?page=" . ($page + 1);
                    } ?>">Next</a>
                </li>
                <li><a href="?page=<?php echo $total_pages; ?>">Last</a></li>
            </ul>
        </div>
        <?php
        //display page footer
        parent::displayFooter();

    } //end of display method
}
