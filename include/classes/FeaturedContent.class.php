<?php

/**
 *	FeaturedContent Class
 *  --------------
 *	Description : encapsulates methods and properties
 *	Written by  : ApPHP
 *  Updated	    : 09.07.2013
 *  Usage       : Core Class (ALL)
 *
 *	PUBLIC:				  	STATIC:				 	PRIVATE:
 * 	------------------	  	---------------     	---------------
 *	__construct             DrawHomeBlock           GetRecordsCount
 *	__destruct
 *  
 *	
 *	
 *  1.0.0
 *	
 **/


class FeaturedContent extends MicroGrid {
	
	protected $debug = false;
	
	// #001 private $arrTranslations = '';		
	
	//==========================================================================
    // Class Constructor
	//==========================================================================
	function __construct()
	{		
		parent::__construct();
		
		$this->params = array();
		
		## for standard fields
		if(isset($_POST['content_header'])) $this->params['content_header'] = prepare_input($_POST['content_header']);
		if(isset($_POST['content_text']))   $this->params['content_text'] = prepare_input($_POST['content_text']);
		if(isset($_POST['content_link']))   $this->params['content_link'] = prepare_input($_POST['content_link'], false, 'middle');
		
		## for checkboxes 
		//$this->params['field4'] = isset($_POST['field4']) ? prepare_input($_POST['field4']) : '0';

		## for images (not necessary)
		//if(isset($_POST['icon'])){
		//	$this->params['icon'] = prepare_input($_POST['icon']);
		//}else if(isset($_FILES['icon']['name']) && $_FILES['icon']['name'] != ''){
		//	// nothing 			
		//}else if (self::GetParameter('action') == 'create'){
		//	$this->params['icon'] = '';
		//}

		## for files:
		// define nothing
		
		
		$this->params['language_id'] = MicroGrid::GetParameter('language_id');
	
		//$this->uPrefix 		= 'prefix_';
		$add_mode = ($this->GetRecordsCount() < 3) ? true : false;
		
		$this->primaryKey 	= 'id';
		$this->tableName 	= TABLE_FEATURED_CONTENT; 
		$this->dataSet 		= array();
		$this->error 		= '';
		$this->formActionURL = 'index.php?admin=mod_featured_content_management';
		$this->actions      = array('add'=>$add_mode, 'edit'=>true, 'details'=>true, 'delete'=>true);
		$this->actionIcons  = true;
		$this->allowRefresh = true;
		$this->allowTopButtons = false;
		$this->alertOnDelete = ''; // leave empty to use default alerts

		$this->allowLanguages = false;
		$this->languageId  	= ''; //($this->params['language_id'] != '') ? $this->params['language_id'] : Languages::GetDefaultLang();
		$this->WHERE_CLAUSE = ''; // WHERE .... / 'WHERE language_id = \''.$this->languageId.'\'';
		$this->GROUP_BY_CLAUSE = ''; // GROUP BY '.$this->tableName.'.order_number
		$this->ORDER_CLAUSE = ''; // ORDER BY '.$this->tableName.'.date_created DESC
		
		$this->isAlterColorsAllowed = true;

		$this->isPagingAllowed = true;
		$this->pageSize = 20;

		$this->isSortingAllowed = true;

		// exporting settings
		$this->isExportingAllowed = false;
		$this->arrExportingTypes = array('csv'=>false);

		// define filtering fields		
		$this->isFilteringAllowed = false;
		$this->arrFilteringFields = array(
			// 'Caption_1'  => array('table'=>'', 'field'=>'', 'type'=>'text', 'sign'=>'=|>=|<=|like%|%like|%like%', 'width'=>'80px', 'visible'=>true),
			// 'Caption_2'  => array('table'=>'', 'field'=>'', 'type'=>'dropdownlist', 'source'=>array(), 'sign'=>'=|>=|<=|like%|%like|%like%', 'width'=>'130px', 'visible'=>true),
			// 'Caption_3'  => array('table'=>'', 'field'=>'', 'type'=>'calendar', 'date_format'=>'dd/mm/yyyy|mm/dd/yyyy|yyyy/mm/dd', 'sign'=>'=|>=|<=|like%|%like|%like%', 'width'=>'80px', 'visible'=>true),
		);

		///$this->isAggregateAllowed = false;
		///// define aggregate fields for View Mode
		///$this->arrAggregateFields = array(
		///	'field1' => array('function'=>'SUM', 'align'=>'center', 'aggregate_by'=>'', 'decimal_place'=>2),
		///	'field2' => array('function'=>'AVG', 'align'=>'center', 'aggregate_by'=>'', 'decimal_place'=>2),
		///);

		///$date_format = get_date_format('view');
		///$date_format_settings = get_date_format('view', true); /* to get pure settings format */
		///$date_format_edit = get_date_format('edit');
		///$datetime_format = get_datetime_format();
		///$time_format = get_time_format(); /* by default 1st param - shows seconds */
		///$currency_format = get_currency_format();

		// prepare languages array		
		/// $total_languages = Languages::GetAllActive();
		/// $arr_languages      = array();
		/// foreach($total_languages[0] as $key => $val){
		/// 	$arr_languages[$val['abbreviation']] = $val['lang_name'];
		/// }

		///////////////////////////////////////////////////////////////////////////////
		// #002. prepare translation fields array
		/// $this->arrTranslations = $this->PrepareTranslateFields(
		///	array('field1', 'field2')
		/// );
		///////////////////////////////////////////////////////////////////////////////			

		///////////////////////////////////////////////////////////////////////////////			
		// #003. prepare translations array for add/edit/detail modes
		/// REMEMBER! to add '.$sql_translation_description.' in EDIT_MODE_SQL
		/// $sql_translation_description = $this->PrepareTranslateSql(
		///	TABLE_XXX_DESCRIPTION,
		///	'gallery_album_id',
		///	array('field1', 'field2')
		/// );
		///////////////////////////////////////////////////////////////////////////////			

		//---------------------------------------------------------------------- 
		// VIEW MODE
		// format: strip_tags, nl2br, readonly_text
		// format: 'format'=>'date', 'format_parameter'=>'M d, Y, g:i A'
		// format: 'format'=>'currency', 'format_parameter'=>'european|2' or 'format_parameter'=>'american|4'
		//---------------------------------------------------------------------- 
		$this->VIEW_MODE_SQL = 'SELECT '.$this->primaryKey.',
									content_header,
									content_text,
									content_link,
									content_icon
								FROM '.$this->tableName;		
		// define view mode fields
		$this->arrViewModeFields = array(
			'content_icon'   => array('title'=>_ICON_IMAGE, 'type'=>'image', 'align'=>'left', 'width'=>'90px', 'sortable'=>true, 'nowrap'=>'', 'visible'=>true, 'image_width'=>'40px', 'image_height'=>'30px', 'target'=>'images/featured_content/', 'no_image'=>'no_image.png'),
			'content_link'   => array('title'=>_LINK, 'type'=>'label', 'align'=>'left', 'width'=>'250px', 'sortable'=>true, 'nowrap'=>'', 'visible'=>true, 'tooltip'=>'', 'maxlength'=>'35', 'format'=>'', 'format_parameter'=>''),
			'content_header' => array('title'=>_HEADER, 'type'=>'label', 'align'=>'left', 'width'=>'', 'sortable'=>true, 'nowrap'=>'', 'visible'=>true, 'tooltip'=>'', 'maxlength'=>'50', 'format'=>'', 'format_parameter'=>''),
		);
		
		//---------------------------------------------------------------------- 
		// ADD MODE
		// - Validation Type: alpha|numeric|float|alpha_numeric|text|email|ip_address|password|date
		// 	 Validation Sub-Type: positive (for numeric and float)
		//   Ex.: 'validation_type'=>'numeric', 'validation_type'=>'numeric|positive'
		// - Validation Max Length: 12, 255... Ex.: 'validation_maxlength'=>'255'
		// - Validation Min Length: 4, 6... Ex.: 'validation_minlength'=>'4'
		// - Validation Max Value: 12, 255... Ex.: 'validation_maximum'=>'99.99'
		//---------------------------------------------------------------------- 
		// define add mode fields
		$this->arrAddModeFields = array(		    
			'content_header' => array('title'=>_HEADER, 'type'=>'textbox',  'width'=>'310px', 'required'=>true, 'readonly'=>false, 'maxlength'=>'32', 'default'=>'', 'validation_type'=>'', 'unique'=>false, 'visible'=>true, 'username_generator'=>false),
			'content_link'   => array('title'=>_LINK, 'type'=>'textbox',  'width'=>'310px', 'required'=>true, 'readonly'=>false, 'maxlength'=>'255', 'default'=>'', 'validation_type'=>'', 'unique'=>false, 'visible'=>true, 'username_generator'=>false),
			'content_text'   => array('title'=>_TEXT, 'type'=>'textarea', 'width'=>'370px', 'required'=>false, 'readonly'=>false, 'maxlength'=>'150', 'default'=>'', 'height'=>'110px', 'editor_type'=>'simple|wysiwyg', 'validation_type'=>'', 'unique'=>false),
			'content_icon'   => array('title'=>_ICON_IMAGE, 'type'=>'image',    'width'=>'210px', 'required'=>false, 'readonly'=>false, 'target'=>'images/featured_content/', 'no_image'=>'', 'random_name'=>true, 'image_name_pefix'=>'', 'overwrite_image'=>false, 'unique'=>false, 'thumbnail_create'=>false, 'thumbnail_field'=>'', 'thumbnail_width'=>'', 'thumbnail_height'=>'', 'file_maxsize'=>'300k', 'watermark'=>false, 'watermark_text'=>''),
		);

		//---------------------------------------------------------------------- 
		// EDIT MODE
		// - Validation Type: alpha|numeric|float|alpha_numeric|text|email|ip_address|password|date
		//   Validation Sub-Type: positive (for numeric and float)
		//   Ex.: 'validation_type'=>'numeric', 'validation_type'=>'numeric|positive'
		// - Validation Max Length: 12, 255... Ex.: 'validation_maxlength'=>'255'
		// - Validation Min Length: 4, 6... Ex.: 'validation_minlength'=>'4'
		// - Validation Max Value: 12, 255... Ex.: 'validation_maximum'=>'99.99'
		// - for editable passwords they must be defined directly in SQL : '.$this->tableName.'.user_password,
		//---------------------------------------------------------------------- 
		$this->EDIT_MODE_SQL = 'SELECT
								'.$this->tableName.'.'.$this->primaryKey.',
								'.$this->tableName.'.content_header,
								'.$this->tableName.'.content_link,
								'.$this->tableName.'.content_text,
								'.$this->tableName.'.content_icon
							FROM '.$this->tableName.'
							WHERE '.$this->tableName.'.'.$this->primaryKey.' = _RID_';		
		// define edit mode fields
		$this->arrEditModeFields = array(
			'content_header' => array('title'=>_HEADER, 'type'=>'textbox',  'width'=>'310px', 'required'=>true, 'readonly'=>false, 'maxlength'=>'32', 'default'=>'', 'validation_type'=>'', 'unique'=>false, 'visible'=>true, 'username_generator'=>false),
			'content_link'   => array('title'=>_LINK, 'type'=>'textbox',  'width'=>'310px', 'required'=>true, 'readonly'=>false, 'maxlength'=>'255', 'default'=>'', 'validation_type'=>'', 'unique'=>false, 'visible'=>true, 'username_generator'=>false),
			'content_text'   => array('title'=>_TEXT, 'type'=>'textarea', 'width'=>'370px', 'required'=>false, 'readonly'=>false, 'maxlength'=>'150', 'default'=>'', 'height'=>'110px', 'editor_type'=>'simple|wysiwyg', 'validation_type'=>'', 'unique'=>false),
			'content_icon'   => array('title'=>_ICON_IMAGE, 'type'=>'image',    'width'=>'210px', 'required'=>false, 'readonly'=>false, 'target'=>'images/featured_content/', 'no_image'=>'', 'random_name'=>true, 'image_name_pefix'=>'', 'overwrite_image'=>false, 'unique'=>false, 'thumbnail_create'=>false, 'thumbnail_field'=>'', 'thumbnail_width'=>'', 'thumbnail_height'=>'', 'file_maxsize'=>'300k', 'watermark'=>false, 'watermark_text'=>''),
		);

		//---------------------------------------------------------------------- 
		// DETAILS MODE
		// format: strip_tags, nl2br, readonly_text
		//----------------------------------------------------------------------
		$this->DETAILS_MODE_SQL = $this->EDIT_MODE_SQL;
		$this->arrDetailsModeFields = array(
			'content_header' => array('title'=>_HEADER, 'type'=>'label', 'format'=>'', 'format_parameter'=>'', 'visible'=>true),
			'content_link'   => array('title'=>_LINK, 'type'=>'label', 'format'=>'', 'format_parameter'=>'', 'visible'=>true),
			'content_text'   => array('title'=>_TEXT, 'type'=>'html', 'visible'=>true),
			'content_icon'   => array('title'=>_ICON_IMAGE, 'type'=>'image', 'target'=>'images/featured_content/', 'no_image'=>'no_image.png', 'image_width'=>'120px', 'image_height'=>'90px', 'visible'=>true),
		);

		///////////////////////////////////////////////////////////////////////////////
		// #004. add translation fields to all modes
		/// $this->AddTranslateToModes(
		/// $this->arrTranslations,
		/// array('name'        => array('title'=>_NAME, 'type'=>'textbox', 'width'=>'410px', 'required'=>true, 'maxlength'=>'', 'readonly'=>false),
		/// 	  'description' => array('title'=>_DESCRIPTION, 'type'=>'textarea', 'width'=>'410px', 'height'=>'90px', 'required'=>false, 'maxlength'=>'', 'maxlength'=>'512', 'validation_maxlength'=>'512', 'readonly'=>false)
		/// )
		/// );
		///////////////////////////////////////////////////////////////////////////////			

	}
	
	//==========================================================================
    // Class Destructor
	//==========================================================================
    function __destruct()
	{
		// echo 'this object has been destroyed';
    }

	/**
	 * Draws  homepage block
	 * 	@param $draw
	 */
	public static function DrawHomeBlock($draw = true)
	{
		$output = '';
		if(Application::Get('page') != 'home') return $output;		
		if(!Modules::IsModuleInstalled('featured_content')) return $output;
		
		$sql = 'SELECT id,
					content_header,
					content_text,
					content_link,
					content_icon
				FROM '.TABLE_FEATURED_CONTENT;
		$result = database_query($sql, DATA_AND_ROWS, ALL_ROWS);
		if($result[1] > 0){
			$output .= '<div id="featured_content">';
			for($i=0; $i<$result[1]; $i++){
				$output .= '<div id="featured_'.($i+1).'">';
				if($result[0][$i]['content_link'] != '') $output .= '<a href="'.$result[0][$i]['content_link'].'">';
				$output .= '<img src="images/featured_content/'.$result[0][$i]['content_icon'].'" alt="">';
				$output .= '<h2>'.$result[0][$i]['content_header'].'</h2>';
				$output .= '<p>'.$result[0][$i]['content_text'].'.</p>';
				if($result[0][$i]['content_link'] != '') $output .= '</a>';
				$output .= '</div>';	
			}
			$output .= '</div>';	
		}		
		
		if($draw) echo $output;
		else return  $output;
	}
	
	/**
	 * Returns count of current records
	 */
	private function GetRecordsCount()
	{
		$sql = 'SELECT * FROM '.TABLE_FEATURED_CONTENT;
		return database_query($sql, ROWS_ONLY);
	}
	
}
?>