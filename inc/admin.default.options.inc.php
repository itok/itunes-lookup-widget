<?php
/***********************************************************************************************************************************************************************
*
*	[end of affiliate settings default values]
*
***********************************************************************************************************************************************************************/
	/********************************************************************
		[for backwards compatibility we check and use old 
		shortcodes and frontend options, if its an update
	********************************************************************/
	/*shortcodes*/
	if(isset($this->pluginOptions['used_shortcodes'])){
		$shortcodes=$this->pluginOptions['used_shortcodes'];
	}else{
		$shortcodes=array();
	}
	/*frontend options*/
	if(isset($this->pluginOptions['frontend_options'])){
		$frontendOptions=$this->pluginOptions['frontend_options'];
	}else{
		$frontendOptions=ilw_frontend_options();
	}
	/**************end old values**************************************************************************/
$defaultOptions = array(
	'version' => $this->pluginVersion,
	'cache_expiry' => (86400*7),
	'cache_cleanup' => (86400*7),
	'js_in_footer' => true,
	'js_priority' => 10,
	'include_css' => true,
	'link_target' => false,
	'affiliate_type' => 'default',
	'affiliate_values' => ilw_affiliate_options(array('default','custom')),
	'affiliate_developer_donation_percentage' => 0,
	'localized_frontend' =>	ilw_localize_frontend(),	
	'frontend_options' => $frontendOptions,
	'used_shortcodes' => $shortcodes,
	'ilw_page_impressions' => 0,
	'ilw_nag_notice' => 0
);
?>