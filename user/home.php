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

if($objLogin->IsLoggedInAsUser()){
	
	draw_title_bar(prepare_breadcrumbs(array(_GENERAL=>'',_DASHBOARD=>'')));
    
?>
	<div style="padding:5px 0;">
	<?php
	
		$msg = '<div style="padding:9px;min-height:250px">';
		$welcome_text = str_replace(
			array('_FIRST_NAME_', '_LAST_NAME_', '_TODAY_', '_LAST_LOGIN_'),
			array($objLogin->GetLoggedFirstName(), $objLogin->GetLoggedLastName(), format_datetime(@date('Y-m-d H:i:s'), '', '', true), format_datetime($objLogin->GetLastLoginTime(), '', _NEVER, true)),
			_WELCOME_USER_TEXT);
        $msg .= $welcome_text;
		$msg .= '<p><br /></p>';
        $msg .= '</div>';	
	
		draw_message($msg);		
	?>
    </div>
<?php
}else if($objLogin->IsLoggedIn()){
    draw_title_bar(prepare_breadcrumbs(array(_GENERAL=>'')));
    draw_important_message(_NOT_AUTHORIZED);
}else{
    draw_title_bar(prepare_breadcrumbs(array(_USER=>'')));
    draw_important_message(_MUST_BE_LOGGED);
}
?>