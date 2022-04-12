<?php

/*** Author: your name*
 * Date: 4/5/2022*
 * File: menu_search.class.php*
 * Description: */
class MenuSearch extends MenuIndexView
{
    public function display($terms, $menuItems)
    {
        //display page header
        parent::displayHeader("Search Results");
        // attempt to implement paginator
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        // retrieve session vars related to paginator
        $page = $_SESSION['page'];
        $total_pages = $_SESSION['total_page'];
        ?>
        <div id="main-header"> Search Results for <i><?= $terms ?></i></div>
        <span class="rcd-numbers">
            <?php
            echo((!is_array($menuItems)) ? "( 0 - 0 )" : "( 1 - " . count($menuItems) . " )");
            ?>
        </span>
        <hr>
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

                echo "<div class='menu-detail'>
                            <p class='box-style-menu' ><a href='", BASE_URL, "/menu/detail/$id'><img class='menu-pic' alt='Food Item' src='" . $image . "'></a><p class='product'>$product</p><br><p class='category'>Category: $category</p><br> Price: $price<br> Description: $description . " . "</p>
                        </div>"; ?>

                <?php
                if ($i % 6 == 5 || $i == count($menuItems) - 1) {
                    echo "</div>";
                }
            }
        }
        ?>
        <div align="center">
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