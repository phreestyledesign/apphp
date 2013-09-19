<?php defined("APPHP_EXEC") or die("Restricted Access"); ?>
<h1>
	<a href="<?php echo APPHP_BASE; ?>index.php">
		<?php echo ($objLogin->IsLoggedInAsAdmin() && $preview != "yes") ? _ADMIN_PANEL : $objSiteDescription->DrawHeader("header_text"); ?>
	</a>
</h1>

<?php
	if($objLogin->IsLoggedInAsAdmin() && $preview == "yes"){
		echo prepare_permanent_link('index.php?preview=no', _BACK_TO_ADMIN_PANEL, "", "header");
	}else{
		//echo $objSiteDescription->GetParameter("slogan_text");				
	}
?>

