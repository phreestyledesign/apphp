<?php defined("APPHP_EXEC") or die("Restricted Access"); ?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo Application::Get("tag_title"); ?></title>
	<meta name="keywords" content="<?php echo Application::Get("tag_keywords"); ?>" />
	<meta name="description" content="<?php echo Application::Get("tag_description"); ?>" />
	
    <base href="<?php echo APPHP_BASE; ?>"> 
	<link rel="SHORTCUT ICON" href="<?php echo APPHP_BASE; ?>images/icons/favicon.ico" />
	
	<link href="<?php echo APPHP_BASE; ?>templates/<?php echo Application::Get("template");?>/css/style.css" type="text/css" rel="stylesheet" />
	<link href="<?php echo APPHP_BASE; ?>templates/<?php echo Application::Get("template");?>/css/menu.css" type="text/css" rel="stylesheet" />
	<?php if(Application::Get("lang_dir") == "rtl"){ ?>
		<link href="<?php echo APPHP_BASE; ?>templates/<?php echo Application::Get("template");?>/css/style-rtl.css" type="text/css" rel="stylesheet" />
	<?php } ?>
	<!--[if IE]>
	<link href="<?php echo APPHP_BASE; ?>templates/<?php echo Application::Get("template");?>/css/style-ie.css" type="text/css" rel="stylesheet" />
	<![endif]-->

	<script type="text/javascript" src="<?php echo APPHP_BASE; ?>js/jquery-1.4.2.min.js"></script>
	<script type="text/javascript" src="<?php echo APPHP_BASE; ?>js/main.js"></script>
	
    <?php echo Application::SetLibraries(); ?>    	
    <?php
	    $banner_image = "";
		Banners::DrawBannersTop($banner_image, false);
    ?>
</head>
<body id="<?php echo Application::Get("lang_dir");?>">

<div id="wrapper">
	<header>
		<!-- HEADER -->
		<?php include_once "templates/".Application::Get("template")."/header.php"; ?>
	</header><!-- end header -->
	
	<div id="navcontainer">
		<ul id='navlist'>
		<?php 
			#// Draw top menu
			Menu::DrawTopMenu();	
		?>		  
		</ul>
	<div class="header_search <?php echo "float_".Application::Get("defined_right"); ?>">		
		<?php			
			Search::DrawQuickSearch();
		?>	
	</div><!-- end search -->			
	</div><!-- end navcontainer -->
	
	<div class="clear"></div>
	
	<main>
		
		<div id="sidebar"><?php Menu::DrawMenu("right"); ?>							
		</div><!-- END OF sidebar -->	
		
		<article>
				
			<?php		
				if((Application::Get("page") != "") && file_exists("page/".Application::Get("page").".php")){
					include_once("page/".Application::Get("page").".php");
				}else if((Application::Get("user") != "") && file_exists("user/".Application::Get("user").".php")){
					if(Modules::IsModuleInstalled("users")){	
						include_once("user/".Application::Get("user").".php");
					}else{
						include_once("user/404.php");
					}
				}else if((Application::Get("admin") != "") && file_exists("admin/".Application::Get("admin").".php")){
					include_once("admin/".Application::Get("admin").".php");
				}else{
					if(Application::Get("template") == "admin"){
						include_once("admin/home.php");
					}else{										
						include_once("page/pages.php");										
					}
				}
			?>
			
			</article><!-- end central column -->
			
			
		

	</main><!-- END OF MAIN CONTENT -->
	<div class="clear push"></div>
	</div><!-- END OF wrapper -->
	
	<!-- FOOTER -->
	<footer>
	<?php include_once "templates/".Application::Get("template")."/footer.php"; ?>
	</footer><!-- end footer -->
	

</body>
</html>