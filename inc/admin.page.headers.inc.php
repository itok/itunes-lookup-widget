<?php
	if($var['callback'][1]=='main_section_text'){
		echo '<h4>'.__('Set Options as required', $this->pluginLocale).'</h4>';
	}
	if($var['callback'][1]=='localize_section_text'){
		echo '<h4>'.__('Use the fields below to localize the frontend labels. Leave empty if you do not want to display any particular label', $this->pluginLocale).'</h4>';
	}
	if($var['callback'][1]=='display_options_text'){
		echo '<h4>'.__('uncheck the fields you do NOT want to display in the frontend widget', $this->pluginLocale).'</h4>';
	}
	if($var['callback'][1]=='affiliate_section_text'){
		echo '<h4>'.__('set your affiliate options below', $this->pluginLocale).'</h4>';
	}
?>