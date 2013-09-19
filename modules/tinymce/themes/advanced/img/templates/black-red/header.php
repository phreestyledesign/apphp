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

<!-- header -->
<div id="header">
	<!-- website name  -->
	<h1><a href="<?php echo APPHP_BASE; ?>index.php"><?php echo ($objLogin->IsLoggedInAsAdmin() && Application::Get('preview') != 'yes') ? _ADMIN_PANEL : $objSiteDescription->DrawHeader('header_text'); ?></a></h1>
	<!-- website name end -->
	
	<!-- slogan -->
	<h2>
		<?php
			if($objLogin->IsLoggedInAsAdmin() && Application::Get('preview') == 'yes'){
				echo prepare_permanent_link('index.php?preview=no', _BACK_TO_ADMIN_PANEL, '', 'header');
			}else{
				echo $objSiteDescription->GetParameter('slogan_text');				
			}
		?>
	</h2>

	<!-- search -->
	<div id="search-wrapper">
	<?php			
		Search::DrawQuickSearch();
	?>
	</div>
</div>
<!-- header end -->

<!-- top menu -->
<div id="menu-box" class="clean-box">
	<div class="menu_box_wrapper">	
		<ul class="nav_top dropdown_outer">
			<?php 
				// Draw top menu
				Menu::DrawTopMenu();	
			?>		  
		</ul>	
	
		<div class="menu_box_block_wrapper <?php echo 'float_'.Application::Get('defined_right'); ?>">
			<?php if(!$objLogin->IsLoggedInAsAdmin() || Application::Get('preview') == 'yes'){ ?>
			<div class="nav_language <?php echo 'float_'.Application::Get('defined_left'); ?>">		
				<?php				
					$objLang = new Languages();				
					if($objLang->GetLanguagesCount('front-end') > 1){
						echo '<span>'._LANGUAGES.': </span>';			
						echo '<span>';
						$objLang->DrawLanguagesBar();
						echo '</span>';
					}				
				?>		
			</div>
			<?php } ?>
		
			<?php if(!$objLogin->IsLoggedInAsAdmin() || Application::Get('preview') == 'yes'){ ?>
			<div class="rss_block <?php echo 'float_'.Application::Get('defined_right'); ?>">
			<?php
                if(Modules::IsModuleInstalled('news') && ModulesSettings::Get('news', 'news_rss') == 'yes'){					
					echo '<a id="rss-icon" href="feeds/rss.xml" title="RSS Feed"><img src="'.APPHP_BASE.'templates/black-red/images/rss-icon.gif" alt="RSS Feed" border="0" /></a>&nbsp;';
				}
				echo '<a href="mailto:'.$objSettings->GetParameter('admin_email').'" title="'._CONTACT_US.'"><img src="'.APPHP_BASE.'templates/black-red/images/mail-icon.png" alt="'._EMAIL_ADDRESS.'" border="0" /></a>&nbsp;';
			?>
			</div>		
			<?php } ?>
		</div>		
	</div>	
</div>
<!-- top menu end -->

