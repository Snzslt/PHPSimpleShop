<?php
#Revision-History            DATE         COMMENTS
#Zahra Soltani(1910291)     2020-02-21     link to phpfunctionand use footer
#Zahra Soltani(1910291)     2020-02-25     AddHeader

#Declare constants
define("FOLDER_PHP_FUNCTIONS","PHPFunction/");
define("FILE_PHP_FUNCTIONS", FOLDER_PHP_FUNCTIONS."phpfunction.php");

#import the PHP commin function file
require_once(FILE_PHP_FUNCTIONS);

$title = "Orders Page";
createPageHeader($title);
createTableOrders();
downloadCheatSheet();
createPageFooter();


class Orders {
    //put your code here
}
?>
