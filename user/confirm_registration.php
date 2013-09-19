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

if(!$objLogin->IsLoggedIn() && (ModulesSettings::Get('users', 'allow_registration') == 'yes')){
	
	draw_title_bar(prepare_breadcrumbs(array(_USER=>'',_REGISTRATION_CONFIRMATION=>'')));
	
	echo $msg;
	
	echo '<div class="pages_contents">';
	if(!$confirmed){
		echo '<br />
		<form action="index.php?user=confirm_registration" method="post" name="frmConfirmCode" id="frmConfirmCode">
			'.draw_hidden_field('task', 'post_submission', false).'
			'.draw_token_field(false).'

			'._ENTER_CONFIRMATION_CODE.':
			<input type="text" name="c" id="c" value="" size="27" maxlength="25" /><br /><br />
			<input class="form_button" type="submit" name="btnSubmit" id="btnSubmit" value="Submit">
		</form>
		<script type="text/javascript">appSetFocus(\'c\')</script>';
	}
	echo '</div>';

}else{
	draw_title_bar(prepare_breadcrumbs(array(_USER=>'', _REGISTRATION_CONFIRMATION=>'')));
    draw_important_message(_NOT_AUTHORIZED);
}
?>