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

header('content-type: text/html; charset=utf-8');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="<?php echo Application::Get('tag_keywords'); ?>" />
	<meta name="description" content="<?php echo Application::Get('tag_description'); ?>" />
	
    <title><?php echo Application::Get('tag_title'); ?></title>

    <base href="<?php echo APPHP_BASE; ?>" /> 
	<link rel="SHORTCUT ICON" href="<?php echo APPHP_BASE; ?>images/icons/apphp.ico" />
	
	<link href="<?php echo APPHP_BASE; ?>templates/<?php echo Application::Get('template');?>/css/style.css" type="text/css" rel="stylesheet" />
	<?php if(Application::Get('lang_dir') == 'rtl'){ ?>
		<link href="<?php echo APPHP_BASE; ?>templates/<?php echo Application::Get('template');?>/css/style-rtl.css" type="text/css" rel="stylesheet" />
	<?php } ?>
	<!--[if IE]>
	<link href="<?php echo APPHP_BASE; ?>templates/<?php echo Application::Get('template');?>/css/style-ie.css" type="text/css" rel="stylesheet" />
	<![endif]-->

	<!-- Opacity Module -->
	<link href="<?php echo APPHP_BASE; ?>modules/opacity/opacity.css" type="text/css" rel="stylesheet" />
	<script type="text/javascript" src="<?php echo APPHP_BASE; ?>modules/opacity/opacity.js"></script>

	<script type="text/javascript" src="<?php echo APPHP_BASE; ?>js/main.js"></script>

    <?php echo Application::SetLibraries(); ?>    	
    <?php
	    $banner_image = '';
		Banners::DrawBannersTop($banner_image, false);
    ?>
</head>
<body id="indexHomeBody" dir="<?php echo Application::Get('lang_dir');?>">
<div id="mainWrapper">
<div id="headerWrapper">

	<!-- HEADER -->
	<?php include_once 'templates/'.Application::Get('template').'/header.php'; ?>

	<table id="contentMainWrapper" cellspacing="0" cellpadding="0" width="100%" border="0">
	<tbody>
	<tr>
		<td id="navColumnLeft">
			<!-- LEFT COLUMN -->
			<?php
				// Draw menu tree
				Menu::DrawMenu('left'); 
			?>
			<!-- END OF LEFT COLUMN -->			
	    </td>
		<td id="navColumnMain">		
			<div id="indexDefault" class="center_column">				
				<div id="indexDefaultMainContent">					
					<!-- BANNERS -->
					<?php echo $banner_image;?>

					<!-- featured -->
					<?php echo FeaturedContent::DrawHomeBlock(false); ?>
					
					<div class="center_box_wrapper <?php echo Application::Get('defined_alignment');?>">
					<!-- MAIN CONTENT -->
					<?php
						if((Application::Get('page') != '') && file_exists('page/'.Application::Get('page').'.php')){
							include_once('page/'.Application::Get('page').'.php');
						}else if((Application::Get('user') != '') && file_exists('user/'.Application::Get('user').'.php')){
							if(Modules::IsModuleInstalled('users')){	
								include_once('user/'.Application::Get('user').'.php');
							}else{
								include_once('user/404.php');
							}
						}else if((Application::Get('admin') != '') && file_exists('admin/'.Application::Get('admin').'.php')){
							include_once('admin/'.Application::Get('admin').'.php');
						}else{
							if(Application::Get('template') == 'admin'){
								include_once('admin/home.php');
							}else{										
								include_once('page/pages.php');										
							}
						}
					?>
					<!-- END OF MAIN CONTENT -->
					</div>
				</div>				
			</div>			
		</td>
		<td id="navColumnRight">
			<!-- RIGHT COLUMN -->			
			<?php
				// Draw menu tree
				Menu::DrawMenu('right'); 
			?>
			<!-- END OF RIGHT COLUMN -->					
		</td>		
	</tr>
	</tbody>
	</table>

	<!-- FOOTER -->
	<?php include_once 'templates/'.Application::Get('template').'/footer.php'; ?>

</div>
</div>
</body>
</html>