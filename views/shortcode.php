<?php
	$thisPageId=get_the_ID();
 	/**ilw options**/
	//$options = get_option($this->pluginOptionsName);
	$options = $this->pluginOptions;
	/**all current shortcodes used in all posts***/
	$allCurrentShortcodes=maybe_unserialize($options['used_shortcodes']);
	/**get all shortcodes used in this page****/
	$thisPageShortcodes=$allCurrentShortcodes[$thisPageId];
	/**create unique id from pageid and key from hash of shortcode attributes so we can distinguish them from widgets**/
	$hash=$this->ilw_shortcode_attr_hash($atts);//hassh attributes to make unique key
	$scKey=$thisPageId.'-'.$hash;
	$scId="".$this->id_base."-".$scKey."";//this key is referenced in get-json	to get settings stored in option table

	$shortcodeMarkup='';
	$shortcodeMarkup.="<div id='".$scId."' class='".$this->pluginSlug."'></div>";

	$jsVar='';
	/**if we do not output js in footer add initialize jsObject here***/
	if(!$this->pluginOptions['js_in_footer']){
		if($scCount<=0 && $this->pluginWidgetsActiveOnPage<=0){
			$jsVar.='var '.$this->pluginLocalizedVariables.'='.json_encode((object) array_merge($this->pluginVariables, array(''.$this->pluginInstanceName.''=>new StdClass()))).';';
		}
		$jsVar.=''.$this->pluginLocalizedVariables.'["'.$this->pluginInstanceName.'"]["'.$scId.'"]="'.$scKey.'";';
		$shortcodeMarkup.="<script type='text/javascript'>".$jsVar."</script>";
	}else{
		$this->pluginVariables[''.$this->pluginInstanceName.''][$scId]=$scKey;
	}
?>