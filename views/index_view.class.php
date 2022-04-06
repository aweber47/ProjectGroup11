<?php
/*
 * Author: Group 1
 * Date: 4/5/2022*
 * File: index_view.class.php*
 * Description:
*/

class IndexView{
    //This method displays the page header
    static public function displayHeader($title){
        // start a session
        if(session_status() == PHP_SESSION_NONE){
            session_start();
            echo "Session Began";
        } else{
            echo "Session Active";
        }
        
        //User login
        $_SESSION['username'] = 2;
        ?>
            <!DOCTYPE html>
            <html lang="en">
                <head>
                    <title><?php echo $title; ?></title>
                    <meta charset="utf-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <link type='text/css' rel='stylesheet' href="<?= BASE_URL ?>/style.css">
                    <script>
                        //Create the JavaScript variable for the base url
                        var base_url = "<?= BASE_URL ?>";
                    </script>
                </head>
                <body>
                    <header>
                        <h1>Lewie's Chinese Bistro</h1>
                    </header>
        <?php
    }//End of displayHeader function

    //Displays the page footer
    public static function displayFooter(){
        ?>
                    <footer>
                        <p id="copyright-complete">
                            &copy; 2008-<span id="copyright">20XX</span>. Lewie's Chinese Bistro
                        </p>
                        <script src="scripts/copyright.js"></script>
                        <script type="text/javascript" src="<?= BASE_URL ?>/js/ajax_autosuggestion.js"></script>
                    </footer>
                </body>
            </html>
        <?php
    } //end of displayFooter function
}