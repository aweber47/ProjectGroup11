<?php
/*** Author: Group 1
 * Date: 4/5/2022*
 * File: index_view.class.php*
 * Description: */

class IndexView{
    //this method displays the page header
    static public function displayHeader($title){
        // start a session
        if(session_status() == PHP_SESSION_NONE){
            session_start();
            echo "_";
        }else{
            echo "_";
        }
        // user login
        $_SESSION['username'] = 2;
        ?>
            <!DOCTYPE html>
            <html lang="en">
                <head>
                    <title><?php echo $title; ?></title>
                    <meta charset="utf-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <link rel="stylesheet" href="/ProjectGroup11/www/style.css">
                    <script>
                        //create the JavaScript variable for the base url
                        var base_url = "<?= BASE_URL ?>";
                    </script>
                </head>
                <body>
                    <div id='wrapper'>
                        <header>
                            <h1>
                                Lewie's Chinese Bistro
                            </h1>
                        </header>
                        <nav>
                            <a class="nav-left" href="<?= BASE_URL ?>">
                                <img src="/ProjectGroup11/www/images/home.png" alt="Home Page" style="width: 50px">
                            </a>
                            <a class="nav-left" href="<?= BASE_URL ?>/menu/index">
                                <img src="/ProjectGroup11/www/images/menu.png" alt="Menu Page" style="width: 50px">
                            </a>
                            <a class="nav-right" href="<?= BASE_URL ?>/user/login">
                                <img src="/ProjectGroup11/www/images/login.png" alt="Login" style="width: 50px">
                            </a>
                            <a class="nav-right" href="<?= BASE_URL ?>/menu/showCart">
                                <img src="/ProjectGroup11/www/images/cart.png" alt="Shopping Cart" style="width: 50px">
                            </a>
                        </nav>
        <?php
    }//end of displayHeader function

    //this method displays the page footer
    public static function displayFooter(){
        ?>
                    </div>
                    <footer>
                        <p style="text-align: center">&copy; 2008-<span id="copyright">20XX</span>. Lewie's Chinese Bistro</p>
                        <script src="/ProjectGroup11/www/js/copyright.js"></script>
                        <script type="text/javascript" src="<?= BASE_URL ?>ProjectGroup11/www/js/ajax_autosuggestion.js"></script>
                    </footer>
                </body>
            </html>
        <?php
    } //end of displayFooter function
}