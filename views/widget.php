<?php
	extract( $args, EXTR_SKIP );
	$widgetOutput="";
	// Get our widget variables
	$title = apply_filters( 'widget_title', $instance['title'] );

	/*** widget before***/
	$widgetOutput.="". $before_widget ."";

	/*** widget title***/
	if( !empty( $title ) ){
		$widgetOutput.="". $before_title . $title . $after_title."";
	}
	/***render widget*****/
		/**if we dont have/want the javascript in footer, render object here***/
		if(!$this->pluginOptions['js_in_footer']){
			//**inititialize object with settings**//
			$jsVar='';
			/**if its the first widget on page, or there are not any shortcodes beforehand, initialize ilwParam**/
			if($widgetcount==0 && $this->ilw_page_has_shortcode()<=0){
				$jsVar.='var '.$this->pluginLocalizedVariables.'='.json_encode((object) array_merge($this->pluginVariables, array(''.$this->pluginInstanceName.''=>new StdClass()))).';';
			}
			/**add to object->instance query string and vars**/
			$jsVar.=''.$this->pluginLocalizedVariables.'["'.$this->pluginInstanceName.'"]["'.$widget_id.'"]="'.$this->number.'";';
			$widgetOutput.="<script type='text/javascript'>".$jsVar."</script>";
		}
	/*** widget after***/
	$widgetOutput.="". $after_widget."";

	/************************************************************************************************
		check if theme output of the widget has the widget id somewhere (typically in the before/after widget),
		otherwise add a container with the id, as we need it to generate the widget in the right place
		most themes (should)have this though
		make sure we also have the dom and libxml available for checking. if not you're on your own.
	************************************************************************************************/
		/**no point trying to parse anything if its empty**/
		if(trim($widgetOutput)!=''){
			if(in_array('libxml', get_loaded_extensions()) && in_array('dom', get_loaded_extensions()) && function_exists('simplexml_load_file') ){
				libxml_use_internal_errors(true);
				$dom_document = new DOMDocument();
				$dom_document->preserveWhiteSpace = true;
				$dom_document->strictErrorChecking = FALSE;
				$dom_document->loadHTML('<html><head><meta http-equiv="Content-Type" content="text/html; charset='.mb_detect_encoding($widgetOutput).'"/></head><body>'.$widgetOutput.'</body></html>');
				$xml = simplexml_import_dom($dom_document);
				/**queries**/
				$result = $xml->xpath('//*'); // returns the whole shebang as one array element

				$firstElementAfterBody=key($result[3]);

				$getIdElement = $xml->xpath("//*[@id='".$widget_id."']");
				$getClassElement = $xml->xpath("//*[contains(@class,'".$this->pluginSlug."')]");

				/**we have the id, but are missing the class -> add class to element with id**/
				if(count($getIdElement)>0 && count($getClassElement)<=0){
					$getIdElement[0]['class']=$getIdElement[0]['class'].' '.$this->pluginSlug.'';
				}
				/**we have the class, but are missing the id -> add id to element with class**/
				if(count($getIdElement)<=0 && count($getClassElement)>0){
					$getClassElement[0]['id']=''.$widget_id.'';
				}

				/**we have neither a class nor an id wrap the hole thing**/
				if(count($getIdElement)<=0 && count($getClassElement)<=0){
					$newWidgetOutput="<div id='".$widget_id."' class='".$this->pluginSlug."'>".$xml->body->$firstElementAfterBody->asXML()."</div>";
				}else{
					$newWidgetOutput="".$xml->body->$firstElementAfterBody->asXML();
				}

				/**however, if we have both already, just output the original string**/
				if(count($getIdElement)>0 && count($getClassElement)>0){
					$newWidgetOutput=$widgetOutput;
				}
			/***********************************************************/

			}else{
				/**we could not check, assume we dont have required element (2 is - a bit - better than none) shouldnt really ever happen though**/
				$newWidgetOutput="<div id='".$widget_id."' class='".$this->pluginSlug."'>".$widgetOutput."</div>";
			}
		}else{
			$newWidgetOutput="<div id='".$widget_id."' class='".$this->pluginSlug."'>".$widgetOutput."</div>";
		}

/***output widget***/
	/**cdata plays havok when js is NOT in footer**/
	/** if its set to be in footer, there wont be any js here anyway**/
	$newWidgetOutput = str_replace("<![CDATA[","",$newWidgetOutput);
	$newWidgetOutput = str_replace("]]>","",$newWidgetOutput);

print"".$newWidgetOutput;
?>