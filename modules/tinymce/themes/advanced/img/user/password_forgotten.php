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

// check if user is logged in
if(!$objLogin->IsLoggedIn() && (ModulesSettings::Get('users', 'allow_reset_passwords') == 'yes')){	

	$act 		    = isset($_POST['act']) ? prepare_input($_POST['act']) : '';
	$email 			= isset($_POST['email']) ? prepare_input($_POST['email']) : '';
	$msg 			= '';
	
	if($act == 'send'){
		if(!check_email_address($email)){
			$msg = draw_important_message(_EMAIL_IS_WRONG, false);					
		}else{
			if(!(bool)Session::Get('password_sent')){
				if(Users::SendPassword($email)){
					$msg = draw_success_message(_PASSWORD_SUCCESSFULLY_SENT, false);
					Session::Set('password_sent', true);
				}else{
					$msg = draw_important_message(Users::GetStaticError(), false);					
				}
			}else{
				$msg = draw_message(_PASSWORD_ALREADY_SENT, false);
			}
		}
	}	
	
	// draw title bar
	draw_title_bar(prepare_breadcrumbs(array(_USER=>'',_PASSWORD_FORGOTTEN=>'')));

	echo $msg;
?>
    <div class='pages_contents'>
	<form action="index.php?user=password_forgotten" method="post">
		<?php draw_hidden_field('act', 'send'); ?>
		<?php draw_hidden_field('type', 'user'); ?>
		<?php draw_token_field(); ?>
		
		<table class="loginForm" width="99%" border="0">
		<tr>
			<td colspan='2'>
				<?php echo '<p>'._PASSWORD_RECOVERY_MSG.'</p>'; ?>
			</td>
		</tr>
		<tr>
			<td width="15%" nowrap='nowrap'><?php echo _EMAIL_ADDRESS;?>:</td>
			<td width="85%"><input class="form_text" type="text" name="email" id="forgotten_email" size="25" maxlength="70" autocomplete="off" /></td>
		</tr>
		<tr><td colspan='2'>&nbsp;</td></tr>			
		<tr>
			<td colspan='2'>
				<input class="form_button" type="submit" name="btnSend" value="<?php echo _SEND;?>">
			</td>
		</tr>
		<tr><td colspan='2' nowrap height='5px'></td></tr>		
		<tr>
			<td colspan='2'>				
				<?php
					if(ModulesSettings::Get('users', 'allow_login') == 'yes'){
						echo prepare_permanent_link('index.php?user=login', _USER_LOGIN).'<br>';						
					}
					if(ModulesSettings::Get('users', 'allow_registration') == 'yes'){
						echo prepare_permanent_link('index.php?user=create_account', _CREATE_ACCOUNT);
					}
				?>
			</td>
		</tr>
		<tr><td colspan='2' nowrap height='5px'></td></tr>		
		</table>
	</form>
    </div>
	<script type="text/javascript">
		appSetFocus('forgotten_email');
	</script>	
<?php
}else{
	draw_title_bar(prepare_breadcrumbs(array(_USER=>'',_PASSWORD_FORGOTTEN=>'')));
    draw_important_message(_NOT_AUTHORIZED);
}
?>