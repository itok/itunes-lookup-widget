<?php

    $instance = wp_parse_args(
        (array)$instance,$this->ilw_default_instance_settings()
    );

		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$max_items = isset($instance['max_items']) ? absint($instance['max_items']) : 5;
		$show_label = $instance['show_label'] ? 'checked="checked"' : '';
		$song = $instance['song'] ? 'checked="checked"' : '';
		$omitid = isset($instance['omitid']) ? esc_attr($instance['omitid']) : '';
		$sort = explode(",",$instance['sort']);
		$lbl = explode(",",$instance['lbl']);
?>
<div id="<?php echo $this->id; ?>" class="<?php echo $this->pluginSlug; ?>">
	<div id="<?php echo $this->pluginSlug; ?>-option-<?php echo $this->number; ?>" class="<?php echo $this->pluginSlug; ?>-option">

	    <p>
	    	<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e("Widget Title", $this->pluginLocale); ?>:</label>
	    	<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
	    </p>
	    <p>
	    	<label for="<?php echo $this->get_field_id( 'artist_id' ); ?>"><?php _e("ID of Artist/Author/TV-Season etc", $this->pluginLocale); ?>: <a href="#" id="ilw-id-search-<?php echo $this->number; ?>" class="ilw-id-search"><?php _e("find ID", $this->pluginLocale); ?></a></label>
	    	<input class="widefat" id="<?php echo $this->get_field_id( 'artist_id' ); ?>" name="<?php echo $this->get_field_name( 'artist_id' ); ?>" type="text" value="<?php echo $instance['artist_id']; ?>" />
	    	<br/><small><?php _e("single ID [integer]. Use 'find ID'.", $this->pluginLocale); ?><a href="#" id="ilw-shortcode-<?php echo $this->number; ?>" class="ilw-shortcode"><?php _e("get Shortcode", $this->pluginLocale); ?></a></small>
	    </p>
	     <p>
	         <div class="widefat ilw-show-check">
	         <div><?php _e("Type (check to <span class='red'>EXCLUDE</span>)", $this->pluginLocale); ?><span class="ilw-sort"><?php _e("Sort", $this->pluginLocale); ?></span><span class="ilw-lbl"><?php _e("Label", $this->pluginLocale); ?></span></div>
	         <?php
	         	foreach(ilw_display_options($instance['exclude']) as $key => $val){
	         ?>
	              <div class="ilw-item-options">
	              	<input type="checkbox" name="<?php echo $this->get_field_name( 'exclude'); ?>[<?php echo $key; ?>]" value="<?php echo $val['id']; ?>" <?php echo $val['selected']; ?> />
	              	<input type="text" class="ilw-sort" name="<?php echo $this->get_field_name( 'sort'); ?>[<?php echo $key; ?>]" value="<?php echo $sort[$key]; ?>" />
	              	<input type="text" class="ilw-lbl" name="<?php echo $this->get_field_name( 'lbl'); ?>[<?php echo $key; ?>]" value="<?php echo esc_attr($lbl[$key]); ?>" />
	              	<?php echo $val['value']; ?>	              
	              </div>
	         <?php
	         	}
	         ?>
	        	 <div class="ilw-item-options">
					<label for="<?php echo $this->get_field_id('omitid'); ?>"><small><?php _e('Omit album/book/etc id\'s [comma separated]'); ?></small></label><br/>
					<input class="widefat" style="margin:0;" type="text" id="<?php echo $this->get_field_id('omitid'); ?>" name="<?php echo $this->get_field_name('omitid'); ?>" value="<?php echo $omitid; ?>"/>
					
	         	</div>
	         
	         	<div class="ilw-item-notes">					
					<input class="checkbox" type="checkbox" <?php echo $song; ?> id="<?php echo $this->get_field_id('song'); ?>" name="<?php echo $this->get_field_name('song'); ?>" />
					<label for="<?php echo $this->get_field_id('song'); ?>"><small><?php _e('Exclude Singles from Collections ?'); ?></small></label>
	    			<small><a href="#" class="ilw-singles-info red"><?php _e("readme", $this->pluginLocale); ?></a></small><br/>
					
					




				</div>	         
	         
	         </div>

			<label for="<?php echo $this->get_field_id('show_label'); ?>"><?php _e('Show Label above each Type'); ?></label>
	    	<input class="checkbox" type="checkbox" <?php echo $show_label; ?> id="<?php echo $this->get_field_id('show_label'); ?>" name="<?php echo $this->get_field_name('show_label'); ?>" />
	    	<br/>

	        <label for="<?php echo $this->get_field_id('sortKey'); ?>"><?php _e('Sort Lists By'); ?></label>
	        <select id="<?php echo $this->get_field_id( 'sortKey' ); ?>" class="sortKey" name="<?php echo $this->get_field_name( 'sortKey' ); ?>">
	        <?php foreach(ilw_list_type_sort_options($instance['sortKey']) as $key => $val){ ?>
	        	<option value="<?php echo $val['id']; ?>" <?php echo $val['selected']; ?>><?php echo $val['value']; ?></option>
	        <?php } ?>
	        </select>

	        <select id="<?php echo $this->get_field_id( 'sortOrder' ); ?>" class="sortOrder" name="<?php echo $this->get_field_name( 'sortOrder' ); ?>">
	        <?php foreach(ilw_list_type_sort_order($instance['sortOrder']) as $key => $val){ ?>
	        	<option value="<?php echo $val['id']; ?>" <?php echo $val['selected']; ?>><?php echo $val['value']; ?></option>
	        <?php } ?>
	        </select>

	        <br/>
	         <label for="<?php echo $this->get_field_id( 'max_items' ); ?>"><?php _e("Max items PER TYPE", $this->pluginLocale); ?>:</label>
	    	<input id="<?php echo $this->get_field_id( 'max_items' ); ?>" class="maxItems" name="<?php echo $this->get_field_name( 'max_items' ); ?>" type="text" size="3" value="<?php echo $max_items; ?>" />
	    	<small><?php _e("[0=no limit]", $this->pluginLocale); ?></small>
	    </p>

	    <p>
	    	<label for="<?php echo $this->get_field_id( 'country' ); ?>"><?php _e("iTunes Store Country", $this->pluginLocale); ?>:</label>
	    	<span id="ilw-widget-country-<?php echo $this->number; ?>">
	        <select id="<?php echo $this->get_field_id( 'country' ); ?>" class="widefat ilw-select" name="<?php echo $this->get_field_name( 'country' ); ?>">
	        <?php foreach(ilw_country_list($instance['country']) as $key => $val){ ?>
	        	<option value="<?php echo $val['iso']; ?>" <?php echo $val['selected']; ?>><?php echo $val['value']; ?></option>
	        <?php } ?>
	        </select>
	        </span>
	        <br/><small><?php _e("which store to search", $this->pluginLocale); ?></small>
	    </p>

	     <p>
	         <label for="<?php echo $this->get_field_id( 'language' ); ?>"><?php _e("Store Language", $this->pluginLocale); ?>:</label>
	         <select id="<?php echo $this->get_field_id( 'language' ); ?>" name="<?php echo $this->get_field_name( 'language' ); ?>">
	         <?php foreach(ilw_language_options($instance['language']) as $key => $val){ ?>
	              <option value="<?php echo $val['id']; ?>" <?php echo $val['selected']; ?>><?php echo $val['value']; ?></option>
	         <?php } ?>
	        </select>
	        <br/><small><?php _e("only above are available on iTunes API, sorry. You can localize the frontend in the settings page though.", $this->pluginLocale); ?></small>
	    </p>
	     <p>
	         <label for="<?php echo $this->get_field_id( 'explicit' ); ?>"><?php _e("Display Explicit Items ?", $this->pluginLocale); ?>:</label>
	         <select id="<?php echo $this->get_field_id( 'explicit' ); ?>" name="<?php echo $this->get_field_name( 'explicit' ); ?>">
	         <?php foreach(ilw_explicit_options($instance['explicit']) as $key => $val){ ?>
	              <option value="<?php echo $val['id']; ?>" <?php echo $val['selected']; ?>><?php echo $val['value']; ?></option>
	         <?php } ?>
	        </select>
	    </p>
    </div>

    <div id="<?php echo $this->pluginSlug; ?>-idsearch-<?php echo $this->number; ?>" class="<?php echo $this->pluginSlug; ?>-idsearch">
    	<p>
    	<label for="ilw-search-term-<?php echo $this->number; ?>"><?php _e("Enter Search Term to find ID", $this->pluginLocale); ?>:</label>
    	<input id="ilw-search-term-<?php echo $this->number; ?>" class="widefat ilw-search-term" name="ilw-search-term"  type="text" value="" />
		<br/>
	    <span id="ilw-search-country-<?php echo $this->number; ?>"></span>
		<br/><small><?php _e("iTunes store to search", $this->pluginLocale); ?></small>
	    <br/>
	    <input class="checkbox" type="checkbox"  id="ilw-search-artist-only-<?php echo $this->number; ?>" checked="checked"/>
	    <label for="ilw-search-artist-only-<?php echo $this->number; ?>"><?php _e("Search by artist,publisher,etc. name", $this->pluginLocale); ?></label>
	    <br/><small><?php _e("untick to also get results based on title etc", $this->pluginLocale); ?></small>		
	    </p> 	

    	<div id="ilw-search-results-<?php echo $this->number; ?>" class="ilw-search-results"></div>
    	<small id="ilw-search-info-<?php echo $this->number; ?>" class="ilw-search-info"></small>
    	<input type="button" id="ilw-do-search-<?php echo $this->number; ?>" class="ilw-do-search" value="<?php _e("search", $this->pluginLocale); ?>"/>
    	<input type="button" id="ilw-do-reset-<?php echo $this->number; ?>" class="ilw-do-reset" value="<?php _e("back", $this->pluginLocale); ?>"/>
    </div>
</div>