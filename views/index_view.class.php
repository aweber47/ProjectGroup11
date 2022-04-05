<?php

/*** Author: your name*
 * Date: 4/5/2022*
 * File: index_view.class.php*
 * Description: */

class IndexView{
    //this method displays the page header
    static public function displayHeader($title){
        ?>
            <!DOCTYPE html>
            <html lang="en">
                <head>
                    <title><?php echo $title; ?></title>
                    <meta charset="utf-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <link rel="stylesheet" href="../style.css">
                    <script>
                        //create the JavaScript variable for the base url
                        var base_url = "<?= BASE_URL ?>";
                    </script>
                </head>
                <body>
                    <div id='wrapper'>
                        <header>
                            <h1 style='color: #000; font-weight: bold; text-align: center'>
                                Lewie's Chinese Bistro
                            </h1>
                            <h3 style='color: #000; font-weight: bold; text-align: center'>
                                Please eat our food!
                            </h3>
                        </header>
        <?php
    }//end of displayHeader function

    //this method displays the page footer
    public static function displayFooter(){
        ?>
                    </div>
                    <footer>
                        <p style="text-align: center">&copy; 2008-<span id="copyright">20XX</span>. Lewie's Chinese Bistro</p>
                        <script src="scripts/copyright.js"></script>
                    </footer>
                </body>
            </html>
        <?php
    } //end of displayFooter function
}