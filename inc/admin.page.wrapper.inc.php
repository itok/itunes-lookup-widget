<div class="ilw-settings">
	<h2>iTunes Lookup Widget Options</h2>

	<h3 class="nav-tab-wrapper">
	    <a href="#" class="nav-tab main_settings"><?php _e('Main Settings', $this->pluginLocale) ?></a>
	    <a href="#" class="nav-tab localize_settings"><?php _e('Localization', $this->pluginLocale)?></a>
	    <a href="#" class="nav-tab display_settings"><?php _e('Display', $this->pluginLocale)?></a>
	    <a href="#" class="nav-tab affiliate_settings"><?php _e('Affiliate Settings', $this->pluginLocale)?></a>
	</h3>

	<form action="options.php" method="post">
	<?php settings_fields($this->pluginOptionsName); ?>

	<div id="main_settings" class="ilw-settings-tab"><?php do_settings_sections('settings_options'); ?></div>
	<div id="localize_settings" class="ilw-settings-tab"><?php do_settings_sections('localize_options'); ?></div>
	<div id="display_settings" class="ilw-settings-tab"><?php do_settings_sections('frontend_display_options'); ?></div>
	<div id="affiliate_settings" class="ilw-settings-tab"><?php do_settings_sections('affiliate_options'); ?></div>
	<?php submit_button( __('Save Changes', $this->pluginLocale) );  ?>

	</form>
</div>