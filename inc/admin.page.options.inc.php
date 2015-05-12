<?php
		register_setting($this->pluginOptionsName,$this->pluginOptionsName, array( $this, 'ilw_options_validate') );

		/**main settings**/
		add_settings_section('plugin_main', __('Main Settings', $this->pluginLocale),  array( $this, 'ilw_section_headers'), 'settings_options');

		add_settings_field('version', '<b>'.__('Plugin Version:', $this->pluginLocale).'</b>', array( $this, 'ilw_settings_input'), 'settings_options', 'plugin_main', 'version' );
		add_settings_field('cache_expiry', '<b>'.__('Cache Expiry Time:', $this->pluginLocale).'</b> '.__('[in Seconds] (0 to disable). I.e when do we re-fetch results from iTunes.<br/>Default 1 week.', $this->pluginLocale).'', array( $this, 'ilw_settings_input'), 'settings_options', 'plugin_main', 'cache_expiry' );
		add_settings_field('cache_cleanup', '<b>'.__('Cache Cleanup:', $this->pluginLocale).'</b> '.__('[in Seconds] If you change widget settings often (and have cache enabled) the cache will fill with all these requests. Set the time here how often you want to run the cleanup. It will only delete files that are older than cache settings above of course.<br/>Default 1 week', $this->pluginLocale).'', array( $this, 'ilw_settings_input'), 'settings_options', 'plugin_main', 'cache_cleanup' );
		add_settings_field('js_in_footer', '<b>'.__('Javascript in Footer:', $this->pluginLocale).'</b> '.__('[combines all jsVars in one tidy place, but requires wp_footer in theme]', $this->pluginLocale).'', array( $this, 'ilw_settings_input'), 'settings_options', 'plugin_main', 'js_in_footer' );
		add_settings_field('js_priority', '<b>'.__('Javascript Priority:', $this->pluginLocale).'</b> '.__('Some plugins change priority / loadorder to other than the default of 10. If you have problems try decreasing this number. For example , "javascript to footer" uses 5 in which case, use 4 here.  [only used when javascript in footer is enabled]', $this->pluginLocale).'', array( $this, 'ilw_settings_input'), 'settings_options', 'plugin_main', 'js_priority' );
		add_settings_field('include_css', '<b>'.__('Include CSS:', $this->pluginLocale).'</b> '.__('include frontend css that came with this plugin (untick if you want to provide your own styles somewhere else)', $this->pluginLocale).'', array( $this, 'ilw_settings_input'), 'settings_options', 'plugin_main', 'include_css' );

		/**localize frontend**/
		add_settings_section('plugin_localize', __('Localize Frontend', $this->pluginLocale),  array( $this, 'ilw_section_headers'), 'localize_options');
		//foreach($this->ilw_localize_frontend('label') as $k=>$v)
		foreach(ilw_localize_frontend('label') as $k=>$v){
			add_settings_field($k, ''.$v.'', array( $this, 'ilw_settings_input'), 'localize_options', 'plugin_localize', $k);
		}

		/**frontend display options**/
		add_settings_section('plugin_display', __('Frontend Display Options', $this->pluginLocale),  array( $this, 'ilw_section_headers'), 'frontend_display_options');
		foreach(ilw_frontend_options('label') as $k=>$v){
			add_settings_field($k, ''.$v.'', array( $this, 'ilw_settings_input'), 'frontend_display_options', 'plugin_display', $k);
		}

		/**affiliate settings**/
		add_settings_section('plugin_affiliates', __('Affiliate Settings', $this->pluginLocale),  array( $this, 'ilw_section_headers'), 'affiliate_options');
		add_settings_field('affiliate_developer_donation_percentage', __('<b>Contribute: [0 to disable]</b><br/>If you feel generous, you can contribute to the development of this plugin, by inserting the developers affiliate links on every n-th page.<br/>Example: if you set the value here to 10, every 10th page impression that has the widget/shortcode on it will insert the developers affiliate links instead of linking according to the settings below.<br/>If set to 13, every 13th page will have these links and so on.<br/>(this will of course only apply if you are actually displaying links to iTunes in some shape or form).',$this->pluginLocale).'', array( $this, 'ilw_settings_input'), 'affiliate_options', 'plugin_affiliates', 'affiliate_developer_donation_percentage' );
		add_settings_field('affiliates', __('<b>Settings [select one]:</b><br/>please note: (as I understand it) affiliate links will only generate revenues in certain territories/countries. If you have a tradedoubler account for - let\'s say - Italy[IT], you will have a program Id of 24373 . However, this ID is also valid to generate commission in and for the following countries and program id\'s<br/><b>[AR=>218899],[AT=>24380],[BE=>24379],[CL=>218901],[CH=>24372],[CO=>218903],[CR=>218904],[DE=>23761],[DK=>24375],[ES=>24364],[FI=>24366],[FR=>23753],[GB=>23708],[HN=>218906],[IE=>24367],[IT=>24373],[NL=>24371],[NO=>24369],[SE=>23762],[SV=>218905],[PA=>218907],[PE=>218909],[PY=>218908]</b><br/>(i.e. when you set your widget to search the stores in these countries)<br/><br/>PHG links will apply when your widget searches <b>[AU,CA,HK,JP,MX,NZ,RU,SG,TR,TW,US,ZA]</b> (provided the affiliate id\'s are set of course).<br><br/><b>If you set your widget to search any other store than the ones mentioned above, the affiliate link will be ignored and a direct iTunes link will be used.</b> (this is also the case, if you have not set the relevant affiliate variables)<br/><br/>If you have any questions, or think I have gotten somthing wrong here, please let me know.<br/><br/><b>(please see the <a href="http://www.apple.com/itunes/affiliates/resources/documentation/linking-to-the-itunes-music-store.html#AddingAffiliateTracking">iTunes documentation</a> for details regarding affiliate links)</b>',$this->pluginLocale).'', array( $this, 'ilw_settings_input'), 'affiliate_options', 'plugin_affiliates', 'affiliates' );
		add_settings_field('link_target', __('<b>Open Links In New Window:</b>',$this->pluginLocale).'', array( $this, 'ilw_settings_input'), 'affiliate_options', 'plugin_affiliates', 'link_target' );
?>