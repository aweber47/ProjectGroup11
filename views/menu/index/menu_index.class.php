<?php

/*** Author: your name*
 * Date: 4/5/2022*
 * File: menu_index.class.php*
 * Description: */
class MenuIndex extends MenuIndexView
{

    public function display($menuItems)
    {
        //display page header
        parent::displayHeader("List all Menu Items");

        ?>
        <div id="main-header"> Items within the Menu</div>
        <div class="grid-container">
            <?php
            if ($menuItems === 0) {
                echo "No menu items were found.<br><br><br><br><br>";
            } else {
                // display the menu items; 6 menu per row
                foreach ($menuItems as $i => $menuItem) {
                    $Item_id = $menuItem->getItem_id();
                    $Product_name = $menuItem->getProduct_name();
                    $Category_id = $menuItem->getCategory_id();
                    $Price = $menuItem->getPrice();
                    $Description = $menuItem->getDescription();

                    if ($i % 6 == 0) {
                        echo "<div class='row'>";
                    }
                    echo "<div class='col'><p><a href='", BASE_URL, "/menu/detail/$Item_id'></a><span>$Product_name<br>Category $Category_id<br> Price $Price<br> Description $Description<br>" . "</span></p></div>";
                    ?>
                    <?php
                    if ($i % 6 == 5 || $i == count($menuItems) - 1) {
                        echo "</div>";
                    }
                }
            }
            ?>
        </div>

        <?php
        //display page footer
        parent::displayFooter();

    } //end of display method
}