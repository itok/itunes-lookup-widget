<?php
		$options = $this->pluginOptions;
		$localizeValues=$options['localized_frontend'];
		$frontendOptions=$options['frontend_options'];

		if($field=='version'){
			echo "{$options[$field]}";
		}
		if($field=='cache_expiry' || $field=='cache_cleanup' || $field=='js_priority' || $field=='affiliate_developer_donation_percentage'){
			echo "<input id='".$field."' name='".$this->pluginOptionsName."[".$field."]' size='20' type='text' value='{$options[$field]}' />";
		}
		if($field=='js_in_footer' || $field=='include_css' ){
			/**add hidden field to checkboxes so their value gets compared when unchecked (and therefore not submitted themselves**/
			echo "<input name='".$this->pluginOptionsName."[checkbox][".$field."]' type='hidden' value='1' />";
			echo "<input id='".$field."' name='".$this->pluginOptionsName."[".$field."]' type='checkbox'  ". checked($options[$field],true,false)." value='1' />";
		}

		if(in_array($field,array_keys($localizeValues))){
			echo "<input id='".$field."' name='".$this->pluginOptionsName."[localized_frontend][".$field."]' size='20' type='text' value='".($localizeValues[$field])."' />";
		}

		if(in_array($field,array_keys(ilw_frontend_options()))){
			/**add hidden field to checkboxes so their value gets compared when unchecked (and therefore not submitted themselves**/
			echo "<input name='".$this->pluginOptionsName."[checkbox][frontend_options][".$field."]' type='hidden' value='1' />";
			if(isset($frontendOptions[$field]) && $frontendOptions[$field]!=''){$checked=' checked="checked" ';}else{$checked='';}
			echo "<input id='".$field."' name='".$this->pluginOptionsName."[frontend_options][".$field."]' type='checkbox' ".$checked." value='1' />";
		} 

		if($field=='affiliates'){
			$values=$this->pluginOptions['affiliate_values'];
			$items=ilw_affiliate_options();
			/***create output***/
			$affiliateOptions='';
			$affiliateOptions.='<div class="ilw-aff-optn">';
			foreach($items as $k=>$v){
				if($options['affiliate_type']==''.$k.''){
					$docheck = 'checked="checked"';
				}else{$docheck = '';}
				$affiliateOptions.='<input type="radio" name="'.$this->pluginOptionsName.'[affiliate_type]" value="'.$k.'" '.$docheck.'>';
				$affiliateOptions.=' '.$v['txt'].'<br/>';
				if(isset($v['territories'])){
					if($v['inputtype']!='hidden'){
						$affiliateOptions.='<br/><b>Affilliate Settings:</b><br/>';
					}
					foreach($v['territories'] as $tk=>$tv){
						if($v['inputtype']!='hidden'){
							$affiliateOptions.='<div class="ilw-aff-optn-inp" ><span>'.$v['territories'][$tk]['txt'].':</span>';
						}
						if(isset($v['territories'][$tk]['programVars'])){
						foreach($v['territories'][$tk]['programVars'] as $pk=>$pv){
							if($v['inputtype']!='hidden'){
								$affiliateOptions.='<label>';
								$affiliateOptions.=''.$pv['txt'].': ';
							}
							$affiliateOptions.='<input type="'.$v['inputtype'].'" name="'.$this->pluginOptionsName.'[affiliate_values]['.$k.']['.$tk.']['.$pv['key'].']" value="'.htmlspecialchars($values[$k][$tk][$pv['key']]).'"/>';
						
							if($v['inputtype']!='hidden'){
								$affiliateOptions.='</label>';
							}
						}}
						if($v['inputtype']!='hidden'){
						$affiliateOptions.='</div>';
						}
					}
				}
				$affiliateOptions.='<br/>';
			}
			$affiliateOptions.='</div>';
			/**print above**/
			print"".$affiliateOptions."";
		}
		if($field=='link_target'){
			/**add hidden field to checkboxes so their value gets compared when unchecked (and therefore not submitted themselves**/
			echo "<input name='".$this->pluginOptionsName."[checkbox][".$field."]' type='hidden' value='1' />";
			echo "<input id='".$field."' name='".$this->pluginOptionsName."[".$field."]' type='checkbox'  ". checked($options[$field],true,false)." value='1' />";
		}	
		/**add donate button after last field in affiliate box**/
		if($field=='link_target'){
			$donateButton='<br/><br/><br/>'.__('If you would like to contribute directly to the development of this plugin, feel free to do so via paypal below.', $this->pluginLocale).'<br/>'.__('Thank you, much appreciated.', $this->pluginLocale).'<br/>';
			$donateButton.='<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
			<input type="hidden" name="cmd" value="_s-xclick">
			<input type="hidden" name="hosted_button_id" value="BEUAXQHT7FQ3Y">
			<input type="image" src="https://www.paypalobjects.com/en_US/GB/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal — The safer, easier way to pay online.">
			<img alt="" border="0" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" width="1" height="1">
			</form>';
			$donateButton.='</div>';
			print"".$donateButton."";
		}
		
?>