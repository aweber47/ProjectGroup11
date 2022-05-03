<?php
/*** Author: Alex Weber*
 * Date: 4/5/2022*
 * File: menu_search.class.php*
 * Description: handles the search view of the menu controller.*/

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

        //get categories from a session variable
        if (isset($_SESSION['categories'])) {
            $categories = $_SESSION['categories'];
        }
        //define guest account session
        if(isset($_SESSION['check'])){
            //echo $_SESSION['check'];
        }else{
            unset($_SESSION['check']);
        }

        ?>
        <div id="search-results">
            <h3>Search Results for "<?= $terms ?>"</h3>
            <span>
                <?php
                echo((!is_array($menuItems)) ? "( 0 - 0 )" : "( 1 - " . count($menuItems) . " )");
                ?>
            </span>
        </div>

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
        }
        ?>
        <?php
        //display page footer
        parent::displayFooter();
    } //end of display method
}