<?php
	/*********************************************************
		[localize frontend options]
	*********************************************************/
	function ilw_localize_frontend($selVal='val'){
	global $pluginLocale;
		$items['Released']=array('label'=>__('Label for iTunes Release Date (if present)', $pluginLocale),'val'=>__('iTunes Release: ', $pluginLocale));
		$items['Genre']=array('label'=>__('Label for Genre (if present)', $pluginLocale),'val'=>__('Genre: ', $pluginLocale));
		$items['UserRating']=array('label'=>__('Label for Average User Rating (if present)', $pluginLocale),'val'=>__('Average User Rating: ', $pluginLocale));
		$items['iTunes']=array('label'=>__('Linktext to iTunes (Note: if left blank, there won\'t be any link !!)', $pluginLocale),'val'=>__('iTunes', $pluginLocale));
		$items['viewTracklist']=array('label'=>__('Linktext to view Tracklist', $pluginLocale),'val'=>__('view Tracklist', $pluginLocale));
		$items['viewDescription']=array('label'=>__('Linktext to view full description (if present)', $pluginLocale),'val'=>__('full Description', $pluginLocale));
		$items['Back']=array('label'=>__('Linktext to go back when viewing details (such as tracklists)', $pluginLocale),'val'=>__('back', $pluginLocale));
		$items['Close']=array('label'=>__('Linktext to close details (such as full descriptions)', $pluginLocale),'val'=>__('[close]', $pluginLocale));
		$items['Free']=array('label'=>__('if iTunes price is free / 0.00', $pluginLocale),'val'=>__('free', $pluginLocale));

	    foreach($items as $k=>$v){
			$options[$k]=$v[$selVal];
	    }

	return $options;
	}
	/*********************************************************
		[frontend options]
	*********************************************************/
	function ilw_frontend_options($selVal='val'){
	global $pluginLocale;
		$items['showImage']=array('label'=>__('<b>main view:</b> item image', $pluginLocale),'val'=>1);
		$items['showCopyright']=array('label'=>__('<b>main view:</b> copyright info', $pluginLocale),'val'=>1);
		$items['showReleased']=array('label'=>__('<b>main view:</b> release date', $pluginLocale),'val'=>1);
		$items['showGenre']=array('label'=>__('<b>main view:</b> genre', $pluginLocale),'val'=>1);
		$items['showUserRating']=array('label'=>__('<b>main view:</b> average user rating', $pluginLocale),'val'=>1);
		$items['showDescription']=array('label'=>__('<b>main view:</b> description', $pluginLocale),'val'=>1);
		$items['showPrice']=array('label'=>__('<b>main view:</b> price', $pluginLocale),'val'=>1);

		$items['showviewTracklist']=array('label'=>__('<b>main view:</b> link to view tracklist', $pluginLocale),'val'=>1);

		$items['showTracklistImage']=array('label'=>__('<b>tracklist view:</b> item image', $pluginLocale),'val'=>1);
		$items['showTracklistCopyright']=array('label'=>__('<b>tracklist view:</b> copyright info', $pluginLocale),'val'=>1);
		$items['showTracklistReleased']=array('label'=>__('<b>tracklist view:</b> release date', $pluginLocale),'val'=>1);
		$items['showTracklistPrice']=array('label'=>__('<b>tracklist view:</b> price', $pluginLocale),'val'=>1);

	    foreach($items as $k=>$v){
			$options[$k]=$v[$selVal];
	    }

	return $options;
	}
?>