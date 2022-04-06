<?php
/*** Author: your name*
 * Date: 4/5/2022*
 * File: error.php*
 * Description: */
$page_title = "Error";
//display header
IndexView::displayHeader($page_title);
$message = "Error";

?>
    <div id="main-header">Error</div>
    <hr>
    <table style="width: 100%; border: none">
        <tr>
            <td style="text-align: left; vertical-align: top;">
                <h3> Sorry, but an error has occurred.</h3>
                <div style="color: red">
                    <?= urldecode($message)
                    ?>
                </div>
                <br>
            </td>
        </tr>
    </table>
    <br><br><br><br>
    <hr>
    <a href="<?= BASE_URL ?>/menu/index">Back to movie list</a>

<?php
//display footer
IndexView::displayFooter();

