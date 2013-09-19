/**
 *   set focus on selected form element
 */

function appSetFocus(el_id){
    if(document.getElementById(el_id)){
        document.getElementById(el_id).focus();
    }    
}

/**
 *   Change location (go to another page)
 */
function appGoTo(page, params){
	var params_ = (params != null) ? params : '';
    document.location.href = 'index.php?'+page + params_;
}

/**
 *   Change location (go to another page)
 */
function appGoToPage(page, params, method){
	var params_ = (params != null) ? params : '';
	var method_ = (method != null) ? method : '';
	
	if(method_ == 'post'){		
		var m_form = document.createElement('form');
			m_form.setAttribute('id', 'frmTemp');
			m_form.setAttribute('action', page);
			m_form.setAttribute('method', 'post');
		document.body.appendChild(m_form);
		
		params_ = params_.replace('?', '');
		var vars = params_.split('&');
		var pair = '';
		for(var i=0;i<vars.length;i++) { 
			pair = vars[i].split('='); 
			var input = document.createElement('input');
				input.setAttribute('type', 'hidden');
				input.setAttribute('name', pair[0]);
				input.setAttribute('id', pair[0]);
				input.setAttribute('value', unescape(pair[1]));
			document.getElementById('frmTemp').appendChild(input);
		}
		document.getElementById('frmTemp').submit();
	}else{
		document.location.href = page + params_;		
	}
}

/**
 *   set cookie
 */
function appSetCookie(name,value,days) {
    if (days){
        var date = new Date();
        date.setTime(date.getTime()+(days*24*60*60*1000));
        var expires = '; expires='+date.toGMTString();
    }
    else var expires = '';
    document.cookie = name+'='+value+expires+'; path=/';
}

/**
 *   get menu status
 */
function appGetMenuStatus(ind){
	var status = document.getElementById('side_box_content_'+ind).style.display;
	if(status == 'none'){			
		return 'none';
	}else{
		return '';
	}
}

/**
 *   toggle readonly state of element
 */
function appToggleElementReadonly(current_val, target_val, el, target_status, default_status, is_readonly){
	var target_status = (target_status != null) ? target_status : false;
	var default_status = (default_status != null) ? default_status : false;
	var is_readonly = (is_readonly != null) ? is_readonly : true;
    if(!document.getElementById(el)){
		return false;
	}else{
		//alert(current_val +'=='+ target_val+target_status);
		
		//alert(document.getElementById(el).readOnly);
		if(is_readonly){
			if(current_val == target_val) document.getElementById(el).readOnly = target_status;
			else document.getElementById(el).readOnly = default_status;
		}else{
			if(current_val == target_val) document.getElementById(el).disabled = target_status;
			else document.getElementById(el).disabled = default_status;
		}
    }  
}

/**
 *   toggle viewing of element
 */
function appToggleElementView(current_val, target_val, el, status1, status2){
	var status1 = (status1 != null) ? status1 : 'none';
	var status2 = (status2 != null) ? status2 : '';
    if(!document.getElementById(el)){
		return false;
	}else{	
        if(current_val == target_val) document.getElementById(el).style.display = status1;
		else document.getElementById(el).style.display = status2;
    }  
}

/**
 *   toggle rss
 */
function appToggleRss(val){
	if(val == 1){
		if(document.getElementById('rss_feed_type')){
			document.getElementById('rss_feed_type').disabled = false;
		}
	}else{
		if(document.getElementById('rss_feed_type')){
			document.getElementById('rss_feed_type').disabled = true;
		}
	}
}

/**
 *   email validation
 */
function appIsEmail(str){
	var at='@';
	var dot='.';
	var lat=str.indexOf(at);
	var lstr=str.length;
	var ldot=str.indexOf(dot);
	if (str.indexOf(at)==-1) return false; 

	if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr) return false;
	if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr) return false;
	if (str.indexOf(at,(lat+1))!=-1) return false;
	if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot) return false;
	if (str.indexOf(dot,(lat+2))==-1) return false;
	if (str.indexOf(' ')!=-1) return false;

 	return true;
}

/**
 *  submit site search
 */
function appPerformSearch(page, kwd){
	if(kwd != null) document.forms['frmQuickSearch'].keyword.value = kwd;
	document.forms['frmQuickSearch'].p.value = page;
	document.forms['frmQuickSearch'].submit();
}

/**
 *  submit site quick search
 */
function appQuickSearch(){
	var keyword = document.frmQuickSearch.keyword.value;
	if(keyword == '' || keyword.indexOf('...') != -1){
		return false;
	}else{
		document.frmQuickSearch.submit();
		return true;
	}
}

/**
 *   toggle element
 */
function appToggleElement(key){
	jQuery('#'+key).toggle('fast');
}

/**
 *   hide element
 */
function appHideElement(key){	
	if(key.indexOf('#') !=-1 || key.indexOf('.') !=-1){
		jQuery(key).hide('fast');
	}else{
		jQuery('#'+key).hide('fast');
	}		
}

/**
 *   show element
 */
function appShowElement(key){	
	if(key.indexOf('#') !=-1 || key.indexOf('.') !=-1){
		jQuery(key).show('fast');	
	}else{
		jQuery('#'+key).show('fast');	
	}		
}

/**
 *  toggle by jQuery
 */
function appToggleJQuery(el){
	jQuery('.'+el).toggle('fast');
}

/**
 *  toggle by class
 */
function appToggleByClass(el){
	jQuery('.'+el).toggle('fast');
}

/**
 *  submit form 
 */
function appFormSubmit(frm_name_id, vars){
	if(document.getElementById(frm_name_id)){
		if(vars != null){
			var vars_pairs = vars.split('&');
			var pair = '';
			for(var i=0; i<vars_pairs.length; i++){ 
				pair = vars_pairs[i].split('=');
				for(var j=0; j<pair.length; j+=2) {
					if(document.getElementById(pair[j])) document.getElementById(pair[j]).value = pair[j+1];
				}				
			}
		}	
		document.getElementById(frm_name_id).submit();					
	}									
}

/**
 *  Show Popup window
 */
function appPopupWindow(template_file, element_id){
	var element_id = (element_id != null) ? element_id : false;
	var new_window = window.open('html/'+template_file,'PopupWindow','height=500,width=600,toolbar=0,location=0,menubar=0,scrollbars=yes,screenX=100,screenY=100');
	if(window.focus) new_window.focus();
	if(element_id){
		var el = document.getElementById(element_id);		
		if(el.type == undefined){
			var message = el.innerHTML;	
		}else{
			var message = el.value;	
		}		
		var reg_x = /\n/gi;
		var replace_string = '<br> \n';
		message = message.replace(reg_x, replace_string);		
		new_window.document.open();
		new_window.document.write(message);
		new_window.document.close();
	}
}
