<?php
	$currentOptions = $this->pluginOptions;
	
		$options['version'] = $this->pluginVersion;
		$options['ilw_nag_notice'] = $this->pluginNagNotice;

		if(isset($input['cache_expiry'])){
			$options['cache_expiry'] = trim(preg_replace("/[^0-9]/","", $input['cache_expiry']));
		}
		if(isset($input['cache_cleanup'])){
			$options['cache_cleanup'] = trim(preg_replace("/[^0-9]/","", $input['cache_cleanup']));
		}
		/**as unchecked checkboxes do not get submitted, we will check if the hidden field exists*/
		if(isset($input['checkbox']['js_in_footer']) || isset($input['js_in_footer'])){
			$options['js_in_footer'] = !empty($input['js_in_footer']) ? true : false;
		}

		if(isset($input['js_priority'])){
			$options['js_priority'] = (preg_replace("/[^0-9]/","", $input['js_priority']));
		}

		/**as unchecked checkboxes do not get submitted, we will check if the hidden field exists*/
		if(isset($input['checkbox']['include_css']) || isset($input['include_css'])){
			$options['include_css'] = !empty($input['include_css']) ? true : false;
		}
		/**as unchecked checkboxes do not get submitted, we will check if the hidden field exists*/
		if(isset($input['checkbox']['link_target'])){
			$options['link_target'] = !empty($input['link_target']) ? true : false;
		}		
		
		if(isset($input['affiliate_type'])){
			$options['affiliate_type'] = (preg_replace("/[^a-zA-Z_]/","", $input['affiliate_type']));
		}		
		/*yeah i know , this could be a bit more concise...one day*/
		if(isset($input['affiliate_values'])){	
		
			/**get default affiliate values to check which vars are required**/
			$affiliateValues=ilw_affiliate_options();
			$thisOption=array();
				foreach($input['affiliate_values'] as $a=>$b){
					foreach($b as $c=>$d){
						$countOption=array();
						foreach($d as $e=>$f){
							$countOption[$e]=1;
								/**Tradedoubler is using integers, PHG (and others) might have all sorts of characters (and i have no idea which ones, hence just a  strip tags)**/
								if($c=='EU'){
									$thisOption[$a][$c][$e]=preg_replace("/[^0-9]/","", $f);
								}else{
									$thisOption[$a][$c][$e]=strip_tags($f);
								}			
						}								
						/**do not save selected/used values when one or more variables/fields are empty of any given territory**/
						/**if any of them is empty, empty all values**/
						foreach($countOption as $e=>$val){
							if($thisOption[$a][$c][$e]=='' && $affiliateValues[$a]['territories'][$c][$e]['required']){
								$requiredIsEmpty[$a][$c]=1;
								break;	
							}
						}
						if(isset($requiredIsEmpty[$a][$c])){
							foreach($countOption as $e=>$val){
								$thisOption[$a][$c][$e]='';
							}
						}
						/****end checking values****************************/
					}
				}
			$options['affiliate_values'] = $thisOption;
		}
		if(isset($input['localized_frontend'])){
			$options['localized_frontend'] = ilw_option_array($input['localized_frontend']);
		}
		/**as unchecked checkboxes do not get submitted, we will check if the hidden field exists*/
		if(isset($input['checkbox']['frontend_options'])){
			foreach($input['checkbox']['frontend_options'] as $k=>$v){
				if(isset($input['frontend_options'][$k])){
					$options['frontend_options'][$k]=1;
				}else{
					unset($currentOptions['frontend_options'][$k]);	
				}
			}
		}

		if(isset($input['used_shortcodes'])){
			$options['used_shortcodes'] = $input['used_shortcodes'];
		}else{
			/**add current shortcodes as these are not in the option settings page**/
			$options['used_shortcodes'] = ($currentOptions['used_shortcodes']);
		}

		/**reset page impressions if donation percentage changes otherwise just keep as is**/
		if(isset($input['affiliate_developer_donation_percentage']) && $input['affiliate_developer_donation_percentage']!=$currentOptions['affiliate_developer_donation_percentage']){
			$options['ilw_page_impressions'] = 0;
		}else{
			$options['ilw_page_impressions'] = ($currentOptions['ilw_page_impressions']);
		}
		/*if we are updating the count from ajax call, override previous**/
		if(isset($input['ilw_page_impressions'])){
			$options['ilw_page_impressions'] = $input['ilw_page_impressions'];
		}

		if(isset($input['affiliate_developer_donation_percentage'])){
			$p=abs((float)trim(preg_replace("/[^0-9\.]/","", $input['affiliate_developer_donation_percentage'])));
			if($p>100){$p=100;}
			$options['affiliate_developer_donation_percentage'] = $p;
		}
	/**merge old and new and retun combined***/
	$options=ilw_array_merge_recursive_distinct($currentOptions,$options);	
?>