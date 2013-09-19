<?php
/**
* @project ApPHP MicroCMS
* @copyright (c) 2009 - 2013 ApPHP
* @author ApPHP <info@apphp.com>
* @license http://www.gnu.org/licenses/
*/

// *** Make sure the file isn't accessed directly
defined('APPHP_EXEC') or die('Restricted Access');
//--------------------------------------------------------------------------
?>

<hr class="line" />	
<div id="footer">
    <div class="footer-left">
        <?php 
            // Draw footer menu
            Menu::DrawFooterMenu();	
        ?>		  
    </div>
    <div class="footer-right">
        <form name="frmLogout" id="frmLogout" action="index.php" method="post">
            <?php
                $footer_text = $objSiteDescription->DrawFooter(false);
                echo $footer_text;
            ?>
            <?php if(!empty($footer_text)) echo "&nbsp;".draw_divider(false)."&nbsp;"; ?>

            <?php if($objLogin->IsLoggedIn()){ ?>
                <?php draw_hidden_field('submit_logout', 'logout'); ?>
                <?php draw_token_field(); ?>
                <a href="javascript:appFormSubmit('frmLogout');"><?php echo _BUTTON_LOGOUT; ?></a>
            <?php
                }else{
                    echo prepare_permanent_link('index.php?admin=login', _ADMIN_LOGIN);
                }
            ?>
        </form>
    </div> 
</div>