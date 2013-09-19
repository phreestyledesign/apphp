<?php 
/**
* @project ApPHP MicroCMS
* @copyright (c) 2009 - 2013 ApPHP
* @author ApPHP <info@apphp.com>
* @license http://www.gnu.org/licenses/
*/

require_once('include/base.inc.php');
require_once('include/connection.php');

if(!$objLogin->IsLoggedIn()){

    ////////////////////////////////////////////////////////////////////////////
    // 1. Cron - check if there is some work for cron
    ////////////////////////////////////////////////////////////////////////////
    Cron::Run();
    
}    
    
?>