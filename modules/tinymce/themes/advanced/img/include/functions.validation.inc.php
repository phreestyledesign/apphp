<?php
/**
* @project ApPHP MicroCMS
* @copyright (c) 2009 - 2013 ApPHP
* @author ApPHP <info@apphp.com>
* @license http://www.gnu.org/licenses/
*/

// VALIDATION FUNCTIONS
// Updated: 23.02.2011

/**
 *  Check email address
 *  	@param $email
 **/
function check_email_address($email)
{
	$strict = false;
	$regex = $strict ? '/^([.0-9a-z_-]+)@(([0-9a-z-]+\.)+[0-9a-z]{2,4})$/i' :  '/^([*+!.&#$¦\'\\%\/0-9a-z^_`{}=?~:-]+)@(([0-9a-z-]+\.)+[0-9a-z]{2,4})$/i';
	if(preg_match($regex, trim($email))){
	   return true;
	}else{
	   return false;
	}    
}

/**
 *  Check date address
 *  	@param $date
 **/
function check_date($date, $allow_empty_value = true)
{
	if($allow_empty_value && $date == '0000-00-00') return true;
	$year  = (int)substr($date, 0, 4);
	$month = (int)substr($date, 5, 2);
	$day   = (int)substr($date, 8, 2);	
	if(checkdate($month, $day, $year)){		
	   return true;
	}else{
	   return false;
	}    
}

/***
 * Integer Validation
 **/
function check_integer($field = '')
{
	if(is_numeric($field) === true){
		if((int)$field == $field){
			return true;
		}else{
			return false;
		}
	}else{
		return false;
	}
}

?>