<?php

/*** Author: your name*
 * Date: 4/5/2022*
 * File: menu_detail.class.php*
 * Description: */
class MenuDetail extends MenuIndexView
{
    public function display($menuItem, $confirm =""){
        // display page header

        // retrieve menu details
        $Item_id = $menuItem->getItem_id();
        $Product_name = $menuItem->getProduct_name();
        $Category_id = $menuItem->getCategory_id();
        $Price = $menuItem->getPrice();
        $Description = $menuItem->getDescription();
        ?>
        <!-- Display menu details-->

        <div id="main-header">Movie Details</div>
        <hr>
        <!-- display movie details in a table -->
        <table id="detail">
            <tr>
                <td style="width: 130px;">
                    <p><strong>Product:</strong></p>
                    <p><strong>Category:</strong></p>
                    <p><strong>Price:</strong></p>
                    <p><strong>Description:</strong></p>
                   <!-- <div id="button-group">
                        <input type="button" id="edit-button" value="   Edit   "
                               onclick="window.location.href = '<?/*= BASE_URL */?>/movie/edit/<?/*= $id */?>'">&nbsp;
                    </div>-->
                </td>
                <td>
                    <p><?= $Product_name ?></p>
                    <p><?= $Category_id ?></p>
                    <p><?= $Price ?></p>
                    <p class="media-description"><?= $Description ?></p>
                    <div id="confirm-message"><?= $confirm ?></div>
                </td>
            </tr>
        </table>
        <a href="<?= BASE_URL ?>/menu/index">Go to menu list</a>

        <?php
        // display page footer
    }
}

