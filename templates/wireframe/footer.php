<?php defined("APPHP_EXEC") or die("Restricted Access");?>

    <?php 
        // Draw footer menu
        Menu::DrawFooterMenu();	
    ?>		  

    <form name="frmLogout" id="frmLogout" action="index.php" method="post">
        <?php echo $objSiteDescription->DrawFooter(); ?>
        <?php echo "&nbsp;".draw_divider(false)."&nbsp;"; ?>
        <?php if($objLogin->IsLoggedIn()){ ?>
            <?php draw_hidden_field("submit_logout", "logout"); ?>
            <a class="main_link" href="javascript:frmLogout_Submit();"><?php echo _BUTTON_LOGOUT; ?></a>
        <?php
            }else{
                echo prepare_permanent_link('index.php?admin=login', _ADMIN_LOGIN, '', 'main_link');
            }
        ?>
    </form>

