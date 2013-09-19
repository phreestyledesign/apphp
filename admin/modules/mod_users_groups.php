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
	
if($objLogin->IsLoggedInAs('owner','mainadmin') && Modules::IsModuleInstalled('users')){
	
	$action 	= MicroGrid::GetParameter('action');
	$rid    	= MicroGrid::GetParameter('rid');
	$mode   = 'view';
	$msg 	= '';
	
	$objUserGroups = new UserGroups();

	if($action=='add'){		
		$mode = 'add';
	}else if($action=='create'){
		if($objUserGroups->AddRecord()){
			$msg = draw_success_message(_ADDING_OPERATION_COMPLETED, false);
			$mode = 'view';
		}else{
			$msg = draw_important_message($objUserGroups->error, false);
			$mode = 'add';
		}
	}else if($action=='edit'){
		$mode = 'edit';
	}else if($action=='update'){
		if($objUserGroups->UpdateRecord($rid)){
			$msg = draw_success_message(_UPDATING_OPERATION_COMPLETED, false);
			$mode = 'view';
		}else{
			$msg = draw_important_message($objUserGroups->error, false);
			$mode = 'edit';
		}		
	}else if($action=='delete'){
		if($objUserGroups->DeleteRecord($rid)){
			$msg = draw_success_message(_DELETING_OPERATION_COMPLETED, false);
		}else{
			$msg = draw_important_message($objUserGroups->error, false);
		}
		$mode = 'view';
	}else if($action=='details'){		
		$mode = 'details';		
	}else if($action=='cancel_add'){		
		$mode = 'view';		
	}else if($action=='cancel_edit'){				
		$mode = 'view';
	}
	
	// Start main content
	draw_title_bar(prepare_breadcrumbs(array(_ACCOUNTS=>'',_USERS_MANAGEMENT=>'',_USER_GROUPS=>'',ucfirst($action)=>'')));

	//if($objSession->IsMessage('notice')) echo $objSession->GetMessage('notice');
	echo $msg;

	draw_content_start();	
	if($mode == 'view'){		
		$objUserGroups->DrawViewMode();	
	}else if($mode == 'add'){		
		$objUserGroups->DrawAddMode();		
	}else if($mode == 'edit'){		
		$objUserGroups->DrawEditMode($rid);		
	}else if($mode == 'details'){		
		$objUserGroups->DrawDetailsMode($rid);		
	}
	draw_content_end();

}else{
	draw_title_bar(_ADMIN);
	draw_important_message(_NOT_AUTHORIZED);
}
?>