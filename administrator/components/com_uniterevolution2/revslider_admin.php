<?php

	class RevSliderAdmin extends UniteBaseAdminClassRev{
		
		const DEFAULT_VIEW = "sliders";
		
		const VIEW_SLIDER = "slider";
		const VIEW_SLIDER_TEMPLATE = "slider_template";
		const VIEW_SLIDERS = "sliders";
		
		const VIEW_SLIDES = "slides";
		const VIEW_SLIDE = "slide";
		
		
		/**
		 * 
		 * the constructor
		 */
		public function __construct($mainFilepath){
						
			parent::__construct($mainFilepath,$this,self::DEFAULT_VIEW);
						
			
			//print globals
			/*
			$class = new ReflectionClass('GlobalsRevSlider');
			$arr = $class->getStaticProperties();						
			dmp($arr);
			*/
			
			$this->init();
			self::onAddScripts();
			self::adminPages();
		}
		
		
		/**
		 * 
		 * init all actions
		 */
		private function init(){
			
			//$this->checkCopyCaptionsCSS();
			
			//self::setDebugMode();
			
			self::createDBTables();		//update the captions file in db, the install done via sql file.
			
			//include general settings
			self::requireSettings("general_settings");
						
			//set role
			$generalSettings = self::getSettings("general");
						
			$role = $generalSettings->getSettingValue("role",UniteBaseAdminClassRev::ROLE_ADMIN);
						
			self::setMenuRole($role);
			
			self::addMenuPage('Revolution Slider', "adminPages");
						
			$this->addSliderMetaBox('post');
			
			//add common scripts there
			//self::addAction(self::ACTION_ADMIN_INIT, "onAdminInit");
			
			//ajax response to save slider options.
			self::onAjaxAction();
		}
		
		
		/**
		 * 
		 * add wildcards metabox variables to posts
		 */
		private function addSliderMetaBox($postTypes = null){ //null = all, post = only posts
			try{
				$settings = RevOperations::getWildcardsSettings();
				
				self::addMetaBox("Revolution Slider Options",$settings,array("RevSliderAdmin","customPostFieldsOutput"),$postTypes);
			}catch(Exception $e){
				
			}
		}
		
		
		/**
		 *  custom output function
		 */
		public static function customPostFieldsOutput(UniteSettingsProductSidebarRev $output){
			
			//$settings = $output->getArrSettingNames();
			
			?>
				<ul class="revslider_settings">
				<?php
					$output->drawSettingsByNames("slide_template");
				?>
				</ul>
			<?php 
		}
		
		
		
		/**
		 * a must function. please don't remove it.
		 * process activate event - install the db (with delta).
		 */
		public static function onActivate(){
			self::createDBTables();
		}
		
		/**
		 * 
		 * create db tables 
		 */
		public static function createDBTables(){
			self::createTable(GlobalsRevSlider::TABLE_SLIDERS_NAME);
			
			/*
			self::createTable(GlobalsRevSlider::TABLE_SLIDES_NAME);
			self::createTable(GlobalsRevSlider::TABLE_SETTINGS_NAME);
			self::createTable(GlobalsRevSlider::TABLE_CSS_NAME);
			self::createTable(GlobalsRevSlider::TABLE_LAYER_ANIMS_NAME);
			*/
		}
		
		
		/**
		 * if caption file don't exists - copy it from the original file.
		 */
		public static function checkCopyCaptionsCSS(){
			if(file_exists(GlobalsRevSlider::$filepath_captions) == false)
				copy(GlobalsRevSlider::$filepath_captions_original,GlobalsRevSlider::$filepath_captions);
				
			if(!file_exists(GlobalsRevSlider::$filepath_captions) == true){
				self::setStartupError("Can't copy <b>captions-original.css </b> to <b>captions.css</b> in <b> plugins/revslider/rs-plugin/css </b> folder. Please try to copy the file by hand or turn to support.");
			}
			
		}
		
		
		/**
		 * 
		 * a must function. adds scripts on the page
		 * add all page scripts and styles here.
		 * pelase don't remove this function
		 * common scripts even if the plugin not load, use this function only if no choise.
		 */
		public static function onAddScripts(){
			self::addStyle("edit_layers","edit_layers");
			
			//add google font
			//$urlGoogleFont = "http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700";					
			//self::addStyleAbsoluteUrl($urlGoogleFont,"google-font-pt-sans-narrow");
			
			self::addScriptCommon("edit_layers","unite_layers");
			self::addScriptCommon("css_editor","unite_css_editor");
			self::addScript("rev_admin");
			
			//include themepunch plugins 
			$urlPlugins = GlobalsRevSlider::$url_item_plugin."js/jquery.themepunch.plugins.min.js";
			self::addScriptAbsoluteUrl($urlPlugins, "themepunch_plugins");
			
			//include all media upload scripts
			//self::addMediaUploadIncludes();
			
			//add rs css:
			self::addStyleAbsoluteUrl(self::$url_item_plugin."css/settings.css","rs-plugin-settings");
			self::addStyleAbsoluteUrl(GlobalsRevSlider::$urlCaptionsCSSAdmin,"rs-plugin-captions");
			self::addStyleAbsoluteUrl(self::$url_item_plugin."css/static-captions.css","rs-plugin-static captions");
		}
		
		
		/**
		 * 
		 * admin main page function.
		 */
		public static function adminPages(){
			
			parent::adminPages();
			
			//require styles by view
			switch(self::$view){
				case self::VIEW_SLIDERS:
				case self::VIEW_SLIDER:
				case self::VIEW_SLIDER_TEMPLATE:
					self::requireSettings("slider_settings");
				break;
				case self::VIEW_SLIDES:					
				break;
				case self::VIEW_SLIDE:
				break;
			}
			
			self::setMasterView("master_view");
			self::requireView(self::$view);
		}

		/**
		 * 
		 * craete tables
		 */
		public static function createTable($tableName){
			global $wpdb;
			
			$parseCssToDb = false;
						
			//check if database is empty
			$result = $wpdb->get_row("SELECT COUNT( DISTINCT id ) AS NumberOfEntrys FROM ".self::$table_prefix.GlobalsRevSlider::TABLE_CSS_NAME);
			if($result->NumberOfEntrys == 0) $parseCssToDb = true;
			
			if($parseCssToDb){
				$revOperations = new RevOperations();
				$revOperations->importCaptionsCssContentArray();
				$revOperations->moveOldCaptionsCss();
				
				$revOperations->updateDynamicCaptions(true);
			}
						
			/*
			
			//if table exists - don't create it.
			$tableRealName = self::$table_prefix.$tableName;
			if(UniteFunctionsWPRev::isDBTableExists($tableRealName))
				return(false);
				
			$charset_collate = '';
			if(method_exists($wpdb, "get_charset_collate"))
				$charset_collate = $wpdb->get_charset_collate();
			else{
				if ( ! empty($wpdb->charset) )
					$charset_collate = "DEFAULT CHARACTER SET $wpdb->charset";
				if ( ! empty($wpdb->collate) )
					$charset_collate .= " COLLATE $wpdb->collate";
			}
			
			switch($tableName){
				case GlobalsRevSlider::TABLE_SLIDERS_NAME:					
				$sql = "CREATE TABLE " .self::$table_prefix.$tableName ." (
							  id int(9) NOT NULL AUTO_INCREMENT,
							  title tinytext NOT NULL,
							  alias tinytext,
							  params text NOT NULL,
							  PRIMARY KEY (id)
							)$charset_collate;";
				break;
				case GlobalsRevSlider::TABLE_SLIDES_NAME:
					$sql = "CREATE TABLE " .self::$table_prefix.$tableName ." (
								  id int(9) NOT NULL AUTO_INCREMENT,
								  slider_id int(9) NOT NULL,
								  slide_order int not NULL,	
								  params text NOT NULL,
								  layers text NOT NULL,
								  PRIMARY KEY (id)
								)$charset_collate;";
				break;
				case GlobalsRevSlider::TABLE_SETTINGS_NAME:
					$sql = "CREATE TABLE " .self::$table_prefix.$tableName ." (
								  id int(9) NOT NULL AUTO_INCREMENT,
								  general TEXT NOT NULL,
								  params TEXT NOT NULL,
								  PRIMARY KEY (id)
								)$charset_collate;";
				break;
				case GlobalsRevSlider::TABLE_CSS_NAME:
					$sql = "CREATE TABLE " .self::$table_prefix.$tableName ." (
								  id int(9) NOT NULL AUTO_INCREMENT,
								  handle TEXT NOT NULL,
								  settings TEXT,
								  hover TEXT,
								  params TEXT NOT NULL,
								  PRIMARY KEY (id)
								)$charset_collate;";
					$parseCssToDb = true;
				break;
				case GlobalsRevSlider::TABLE_LAYER_ANIMS_NAME:
					$sql = "CREATE TABLE " .self::$table_prefix.$tableName ." (
								  id int(9) NOT NULL AUTO_INCREMENT,
								  handle TEXT NOT NULL,
								  params TEXT NOT NULL,
								  PRIMARY KEY (id)
								)$charset_collate;";
				break;
				
				default:
					UniteFunctionsRev::throwError("table: $tableName not found");
				break;
			}
			
			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql);
			*/
			
		}
		
		/**
		 * 
		 * import slideer handle (not ajax response)
		 */
		private static function importSliderHandle($viewBack = null, $updateAnim = true, $updateStatic = true){
			
			dmp(__("importing slider setings and data...",REVSLIDER_TEXTDOMAIN));
			
			$slider = new RevSlider();
			$response = $slider->importSliderFromPost($updateAnim, $updateStatic);
			$sliderID = $response["sliderID"];
			
			if(empty($viewBack)){
				$viewBack = self::getViewUrl(self::VIEW_SLIDER,"id=".$sliderID);
				if(empty($sliderID))
					$viewBack = self::getViewUrl(self::VIEW_SLIDERS);
			}
			
			//handle error
			if($response["success"] == false){
				$message = $response["error"];
				dmp("<b>Error: ".$message."</b>");
				echo UniteFunctionsRev::getHtmlLink($viewBack, __("Go Back",REVSLIDER_TEXTDOMAIN));
			}
			else{	//handle success, js redirect.
				dmp(__("Slider Import Success, redirecting...",REVSLIDER_TEXTDOMAIN));
				echo "<script>location.href='$viewBack'</script>"; 
			}
			exit();
		}
		
		
		
		/**
		 * 
		 * onAjax action handler
		 */
		public static function onAjaxAction(){
						
			$actionIndicator = self::getPostGetVar("action");
			
			if($actionIndicator != "uniterevolution_ajax_action")
				return(false);
			  
			$action = self::getPostGetVar("client_action");
			
			$data = self::getPostGetVar("data");
			$nonce = self::getPostGetVar("nonce");
			
			$slider = new RevSlider();
			$slide = new RevSlide();
			$operations = new RevOperations();
						
			try{

				//verify the nonce
				$isVerified = wp_verify_nonce($nonce, "revslider_actions");
				
				if($isVerified == false)
					UniteFunctionsRev::throwError("Wrong request");	
				
				switch($action){
					case "export_slider":
						RevOperations::validatePermission(GlobalsRevSlider::PERMISSION_SLIDER_OPERATIONS);
						
						$sliderID = self::getGetVar("sliderid");
						$dummy = self::getGetVar("dummy");
						$slider->initByID($sliderID);
						$slider->exportSlider($dummy);
					break;
					case "import_slider":
						RevOperations::validatePermission(GlobalsRevSlider::PERMISSION_SLIDER_OPERATIONS);
						
						$updateAnim = self::getPostGetVar("update_animations");
						$updateStatic = self::getPostGetVar("update_static_captions");
						self::importSliderHandle(null, $updateAnim, $updateStatic);
					break;
					case "import_slider_slidersview":
						RevOperations::validatePermission(GlobalsRevSlider::PERMISSION_SLIDER_OPERATIONS);
						
						$viewBack = self::getViewUrl(self::VIEW_SLIDERS);
						$updateAnim = self::getPostGetVar("update_animations");
						$updateStatic = self::getPostGetVar("update_static_captions");
						self::importSliderHandle($viewBack, $updateAnim, $updateStatic);
					break;
					case "create_slider":
						RevOperations::validatePermission(GlobalsRevSlider::PERMISSION_SLIDER_OPERATIONS);
						
						self::requireSettings("slider_settings");
						$settingsMain = self::getSettings("slider_main");
						$settingsParams = self::getSettings("slider_params");
						
						$data = $operations->modifyCustomSliderParams($data);
						
						$newSliderID = $slider->createSliderFromOptions($data,$settingsMain,$settingsParams);
						
						self::ajaxResponseSuccessRedirect(
						            __("The slider successfully created",REVSLIDER_TEXTDOMAIN), 
									self::getViewUrl("sliders"));
						
					break;
					case "update_slider":
						RevOperations::validatePermission(GlobalsRevSlider::PERMISSION_SLIDER_SETTINGS);
						
						self::requireSettings("slider_settings");
						$settingsMain = self::getSettings("slider_main");
						$settingsParams = self::getSettings("slider_params");
						
						$data = $operations->modifyCustomSliderParams($data);
						
						$slider->updateSliderFromOptions($data,$settingsMain,$settingsParams);
						self::ajaxResponseSuccess(__("Slider updated",REVSLIDER_TEXTDOMAIN));
					break;
					
					case "delete_slider":
						RevOperations::validatePermission(GlobalsRevSlider::PERMISSION_SLIDER_OPERATIONS);
						
						$isDeleted = $slider->deleteSliderFromData($data);
						
						if(is_array($isDeleted)){
							$isDeleted = implode(', ', $isDeleted);
							self::ajaxResponseError("Template can't be deleted, it is still being used by the following Sliders: ".$isDeleted);
						}else{
							self::ajaxResponseSuccessRedirect(
						            __("The slider deleted",REVSLIDER_TEXTDOMAIN), 
									self::getViewUrl(self::VIEW_SLIDERS));
						}
					break;
					case "duplicate_slider":
						RevOperations::validatePermission(GlobalsRevSlider::PERMISSION_SLIDER_OPERATIONS);
						
						$slider->duplicateSliderFromData($data);
						
						self::ajaxResponseSuccessRedirect(
						            __("The duplicate successfully, refreshing page...",REVSLIDER_TEXTDOMAIN), 
									self::getViewUrl(self::VIEW_SLIDERS));
					break;
					case "add_slide":
						RevOperations::validatePermission(GlobalsRevSlider::PERMISSION_SLIDE_OPERATIONS);
						
						$numSlides = $slider->createSlideFromData($data);
						$sliderID = $data["sliderid"];
						
						if($numSlides == 1){
							$responseText = __("Slide Created",REVSLIDER_TEXTDOMAIN);
						}
						else
							$responseText = $numSlides . " ".__("Slides Created",REVSLIDER_TEXTDOMAIN);
						
						$urlRedirect = self::getViewUrl(self::VIEW_SLIDES,"id=$sliderID");													
						self::ajaxResponseSuccessRedirect($responseText,$urlRedirect);
						
					break;
					case "add_slide_fromslideview":
						RevOperations::validatePermission(GlobalsRevSlider::PERMISSION_SLIDE_OPERATIONS);
						
						$slideID = $slider->createSlideFromData($data,true);
						$urlRedirect = self::getViewUrl(self::VIEW_SLIDE,"id=$slideID");
						$responseText = __("Slide Created, redirecting...",REVSLIDER_TEXTDOMAIN);																			
						self::ajaxResponseSuccessRedirect($responseText,$urlRedirect);
					break;
					case "update_slide":
						RevOperations::validatePermission(GlobalsRevSlider::PERMISSION_EDIT_SLIDE);
						
						require self::getSettingsFilePath("slide_settings");
						
						$slide->updateSlideFromData($data,$slideSettings);
						self::ajaxResponseSuccess(__("Slide updated",REVSLIDER_TEXTDOMAIN));
					break;
					case "delete_slide":
						RevOperations::validatePermission(GlobalsRevSlider::PERMISSION_SLIDE_OPERATIONS);
						
						$isPost = $slide->deleteSlideFromData($data);
						if($isPost)
							$message = __("Post Deleted Successfully",REVSLIDER_TEXTDOMAIN);
						else
							$message = __("Slide Deleted Successfully",REVSLIDER_TEXTDOMAIN);
						
						$sliderID = UniteFunctionsRev::getVal($data, "sliderID");
						self::ajaxResponseSuccessRedirect($message, self::getViewUrl(self::VIEW_SLIDES,"id=$sliderID")); 
					break;
					case "update_static_slide":
						$slide->updateStaticSlideFromData($data);
						self::ajaxResponseSuccess(__("Static Layers updated",REVSLIDER_TEXTDOMAIN));
					break;
					case "duplicate_slide":
						RevOperations::validatePermission(GlobalsRevSlider::PERMISSION_SLIDE_OPERATIONS);
						
						$sliderID = $slider->duplicateSlideFromData($data);
						self::ajaxResponseSuccessRedirect(
						            __("Slide Duplicated Successfully",REVSLIDER_TEXTDOMAIN), 
									self::getViewUrl(self::VIEW_SLIDES,"id=$sliderID"));
					break;
					case "copy_move_slide":
						RevOperations::validatePermission(GlobalsRevSlider::PERMISSION_SLIDE_OPERATIONS);
						
						$sliderID = $slider->copyMoveSlideFromData($data);
						
						self::ajaxResponseSuccessRedirect(
						            __("The operation successfully, refreshing page...",REVSLIDER_TEXTDOMAIN), 
									self::getViewUrl(self::VIEW_SLIDES,"id=$sliderID"));
					break;
					case "get_static_css":
						$contentCSS = $operations->getStaticCss();
						self::ajaxResponseData($contentCSS);
					break;
					case "get_dynamic_css":
						$contentCSS = $operations->getDynamicCss();
						self::ajaxResponseData($contentCSS);
					break;
					case "insert_captions_css":
						$arrCaptions = $operations->insertCaptionsContentData($data);
						self::ajaxResponseSuccess(__("CSS saved succesfully!",REVSLIDER_TEXTDOMAIN),array("arrCaptions"=>$arrCaptions));
					break;
					case "update_captions_css":
						$arrCaptions = $operations->updateCaptionsContentData($data);
						self::ajaxResponseSuccess(__("CSS saved succesfully!",REVSLIDER_TEXTDOMAIN),array("arrCaptions"=>$arrCaptions));
					break;
					case "delete_captions_css":
						$arrCaptions = $operations->deleteCaptionsContentData($data);
						self::ajaxResponseSuccess(__("Style deleted succesfully!",REVSLIDER_TEXTDOMAIN),array("arrCaptions"=>$arrCaptions));
					break;
					case "update_static_css":
						$staticCss = $operations->updateStaticCss($data);
						self::ajaxResponseSuccess(__("CSS saved succesfully!",REVSLIDER_TEXTDOMAIN),array("css"=>$staticCss));
					break;
					case "insert_custom_anim":
						$arrAnims = $operations->insertCustomAnim($data); //$arrCaptions = 
						self::ajaxResponseSuccess(__("Animation saved succesfully!",REVSLIDER_TEXTDOMAIN), $arrAnims); //,array("arrCaptions"=>$arrCaptions)
					break;
					case "update_custom_anim":
						$arrAnims = $operations->updateCustomAnim($data);
						self::ajaxResponseSuccess(__("Animation saved succesfully!",REVSLIDER_TEXTDOMAIN), $arrAnims); //,array("arrCaptions"=>$arrCaptions)
					break;
					case "delete_custom_anim":
						$arrAnims = $operations->deleteCustomAnim($data);
						self::ajaxResponseSuccess(__("Animation saved succesfully!",REVSLIDER_TEXTDOMAIN), $arrAnims); //,array("arrCaptions"=>$arrCaptions)
					break;
					case "update_slides_order":
						RevOperations::validatePermission(GlobalsRevSlider::PERMISSION_SLIDE_OPERATIONS);
						
						$slider->updateSlidesOrderFromData($data);
						self::ajaxResponseSuccess(__("Order updated successfully",REVSLIDER_TEXTDOMAIN));
					break;
					case "change_slide_image":
						RevOperations::validatePermission(GlobalsRevSlider::PERMISSION_SLIDE_OPERATIONS);
						
						$slide->updateSlideImageFromData($data);
						$sliderID = UniteFunctionsRev::getVal($data, "slider_id");						
						self::ajaxResponseSuccessRedirect(
						            __("Slide Changed Successfully",REVSLIDER_TEXTDOMAIN), 
									self::getViewUrl(self::VIEW_SLIDES,"id=$sliderID"));
					break;	
					case "preview_slide":
						$operations->putSlidePreviewByData($data);
					break;
					case "preview_slider":
						$sliderID = UniteFunctionsRev::getPostGetVariable("sliderid");
						$do_markup = UniteFunctionsRev::getPostGetVariable("only_markup");
						
						if($do_markup == 'true')
							$operations->previewOutputMarkup($sliderID);
						else
							$operations->previewOutput($sliderID);
					break;
					case "toggle_slide_state":
						$currentState = $slide->toggleSlideStatFromData($data);
						self::ajaxResponseData(array("state"=>$currentState));
					break;
					case "slide_lang_operation":
						$responseData = $slide->doSlideLangOperation($data);
						self::ajaxResponseData($responseData);
					break;
					case "update_plugin":
						self::updatePlugin(self::DEFAULT_VIEW);
					break;
					case "update_text":
						self::updateSettingsText();
						self::ajaxResponseSuccess(__("All files successfully updated",REVSLIDER_TEXTDOMAIN));
					break;
					case "update_general_settings":
						$operations->updateGeneralSettings($data);
						self::ajaxResponseSuccess(__("General settings updated",REVSLIDER_TEXTDOMAIN));
					break;
					case "update_posts_sortby":
						$slider->updatePostsSortbyFromData($data);
						self::ajaxResponseSuccess(__("Sortby updated",REVSLIDER_TEXTDOMAIN));
					break;
					case "replace_image_urls":
						RevOperations::validatePermission(GlobalsRevSlider::PERMISSION_SLIDER_OPERATIONS);
						
						$slider->replaceImageUrlsFromData($data);
						self::ajaxResponseSuccess(__("Image urls replaced",REVSLIDER_TEXTDOMAIN));
					break; 
					case "reset_slide_settings":
						RevOperations::validatePermission(GlobalsRevSlider::PERMISSION_SLIDE_OPERATIONS);
						
						$slider->resetSlideSettings($data);
						self::ajaxResponseSuccess(__("Settings in all Slides changed",REVSLIDER_TEXTDOMAIN));
					break; 
					
					default:
						self::ajaxResponseError("wrong ajax action: $action ");
					break;
				}
				
			}
			catch(Exception $e){
				
				$message = $e->getMessage();
				if($action == "preview_slide" || $action == "preview_slider"){
					echo $message;
					exit();
				}
					
				self::ajaxResponseError($message);
			}
			
			//it's an ajax action, so exit
			self::ajaxResponseError("No response output on <b> $action </b> action. please check with the developer.");
			exit();
		}
		
	}
	
	
?>