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

if(Modules::IsModuleInstalled('gallery')){
	$objGalleryAlbum = new GalleryAlbums();
	$objGalleryAlbum->DrawAlbum(Application::Get('album_code'));	
}else{		
	draw_important_message(_PAGE_UNKNOWN);		
}
	
?>	
	