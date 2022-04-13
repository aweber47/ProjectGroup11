<?php

/*** Author: your name*
 * Date: 4/5/2022*
 * File: menu_index.class.php*
 * Description: */
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

        var_dump($categories);


        //display page header
        parent::displayHeader("Our Menu");

        ?>
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
                    $price = $menuItem->getPrice();
                    $description = $menuItem->getDescription();
                    if ($i % 6 == 0) {
                        echo "<div class='row'>";
                    }
    
                    echo "<div id='menu-index'>
<br>
                              <table id='menu-detail-all'>
                                  <tr class='detail-image-all'>
                                      <td><a href='", BASE_URL, "/menu/detail/$id'><img class='menu-pic' alt='Food Item' src='" . $image . "'></a></td>
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
                          </div>";
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