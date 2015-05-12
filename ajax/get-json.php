<?php
if(!defined('DOING_AJAX') || !DOING_AJAX){
	header('HTTP/1.0 400 Bad Request', true, 400);
	print"you cannot call this script directly";
  exit; //just for good measure
}
/**********set header********************/
header('Content-type: application/json');

/**get default vars when getting shortcode from widget in admin**/
if(isset($_POST['shortcodeDefaults'])){
	print"".json_encode($this->ilw_default_instance_settings(true));//return keys lowercase
	exit();	
}

/****update page impression counter with first ajax call ****/
if(isset($_POST['doCounter'])){
	$this->ilw_advance_page_impression_counter();
	exit();	
}
/**********get options for settings and instance**********/
$settingsOptions=$this->pluginOptions;
$widgetOptions=get_option('widget_'.$this->pluginSlugWp.'');
/**add any used shortcode of pages to widgetOptions array to get values with $_POST['wKey']**/
$widgetOptionsShortcode=($settingsOptions['used_shortcodes']);
if(is_array($widgetOptionsShortcode)){
foreach($widgetOptionsShortcode as $k=>$v){
	foreach($v as $l=>$m){
		$widgetOptions[$k.'-'.$l]=$m;
	}
}}
/***********get the settings of this particular widget/shortcode instance******************/
$thisInstance=$widgetOptions[$_POST['wKey']];

/**set affiliate type to "default" if a percentage/count of page impressions should generate developers affiliate links**/
if($settingsOptions['affiliate_developer_donation_percentage']>0){
	if($settingsOptions['ilw_page_impressions'] % $settingsOptions['affiliate_developer_donation_percentage']==0){
		$settingsOptions['affiliate_type']='default';
	}
}



/**how often do we clean up the cache (this is different to cache expiry as it will only delete cached iTunes request that are not in use anymore**/
if(isset($settingsOptions['cache_cleanup']) && abs((int)$settingsOptions['cache_cleanup'])>0){
	$cleanUp=abs((int)$settingsOptions['cache_cleanup']);
}else{
	$cleanUp=(7*86400);//*one week, default fi not
}

/*************define some variables****************/
define('ILW_CACHE_DIRECTORY',''.dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'cache');/*cache path*/
define('ILW_CACHE_DIRECTORY_INFO_FILE','cache-info.txt');/*filename to hold cache info*/
define('ILW_CACHE_DIRECTORY_INFO_ABS',''.ILW_CACHE_DIRECTORY.DIRECTORY_SEPARATOR.ILW_CACHE_DIRECTORY_INFO_FILE);/*absolute path to that holds cache info*/
define('ILW_CACHE_DIRECTORY_CLEAN_INTERVAL',"".$cleanUp."");/*how often to read cache directory (in days 7*86400= once a week) and clean old files that have expired or are no longer in use**/
define('ILW_CACHE_DIRECTORY_FILES_KEEP',serialize(array(ILW_CACHE_DIRECTORY_INFO_FILE,'.htaccess','index.html')));/*array of files we want to keep in cache directory on weekly (or whatever ,set above) cleanout. we probably want to keep index, htaccess info file*/
define('ILW_SSL_CERTIFICATE',''.dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'cert/cacert.pem');/*ssl certificate*/



//just get the file and do not remove linebreaks
function ilw_curlGET($url, $referrer='', $cookie_file='', $proxy='', $timeout=10, $header=0, $ext=true) {
		    $ch = curl_init($url);
		    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0)");
		    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		    curl_setopt($ch, CURLOPT_FILETIME, 1);

		    //itunes lookup uses https**/
		    if(defined('ILW_SSL_CERTIFICATE') && is_file(ILW_SSL_CERTIFICATE)){
		    	curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, TRUE);
				curl_setopt ($ch, CURLOPT_CAINFO, ILW_SSL_CERTIFICATE);
		    }

		    if($timeout) curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
		    if($referrer) curl_setopt($ch, CURLOPT_REFERER, $referrer);
		    if($header) curl_setopt($ch, CURLOPT_HEADER, 1);
		    if($proxy) curl_setopt($ch, CURLOPT_PROXY, $proxy);
		    if($cookie_file) {
		        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);
		        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);
		    }
		    $content=curl_exec($ch);
		    if($ext) {
		        $content = array(
		        'errno'=>curl_errno($ch),
		        'error'=>curl_error($ch),
		        'info'=>curl_getinfo($ch),
		        'content'=>$content );
		    }
		    curl_close($ch);

	return $content;
}

/*********************************************************************
	[keeps track of cache and cleans out the files that have expired
	once a week if chache is enabled
	- there's possibly a better way to do this though]
********************************************************************/
function ilw_cacheinfo($expiry){
	$filesremoved=array();/*in case we want to return the list of files deleted, not stricly necessary*/
	/**create empty the file if not exist**/
	if(!is_file(ILW_CACHE_DIRECTORY_INFO_ABS)){
		file_put_contents(ILW_CACHE_DIRECTORY_INFO_ABS,time());
	}else{
		$lastclean=file_get_contents(ILW_CACHE_DIRECTORY_INFO_ABS);
		/**clean once a week (or to whatever its set)**/
		if($lastclean<(time()-ILW_CACHE_DIRECTORY_CLEAN_INTERVAL)){
			$filesremoved=ilw_cleancache($expiry);
			/**store last cleantime in file**/
			file_put_contents(ILW_CACHE_DIRECTORY_INFO_ABS,time());
		}
	}
	return $filesremoved;/*in case we want to return the list of files deleted somewhere, not stricly necessary*/
}
/**deletes expired cache files in cache directory**/
function ilw_cleancache($expiry){
	$filename=array();/*in case we want to return the list of files deleted, not stricly necessary*/
	if ($handle = opendir(ILW_CACHE_DIRECTORY)) {
	    while (false !== ($entry = readdir($handle))) {
	        if ($entry != "." && $entry != ".." && !in_array($entry,unserialize(ILW_CACHE_DIRECTORY_FILES_KEEP))) {
	            if(filemtime(ILW_CACHE_DIRECTORY.DIRECTORY_SEPARATOR.$entry)<(time()-$expiry)){
	            	@unlink(ILW_CACHE_DIRECTORY.DIRECTORY_SEPARATOR.$entry);
	            	$filename[]=$entry;/*in case we want to return the list of files deleted, not stricly necessary*/
	            }
	        }
	    }
	    closedir($handle);
	}
	return $filename;/*in case we want to return the list of files deleted, not stricly necessary*/
}
/*********************************************************************
	[checks against cache. if file exists and is younger
	than cache expiry, use it otherwise make another curl request
	and store this new copy instead]
**********************************************************************/
function ilw_get_results($requesturl,$expiry){
	/*create a hash**/
	$hash='{'.hash("sha256","".$requesturl."").'}';
	/*absolute path to chache file**/
	$cachefile=''.ILW_CACHE_DIRECTORY.DIRECTORY_SEPARATOR.$hash.'';

	if(isset($expiry) && is_file($cachefile) && filemtime($cachefile)>=time()-$expiry){
		$content['errno']=0;
		$content['error']='';
		$content['info']='from cache '.$hash.'';//in case we want to return the info for debugging purposes
		$content['content']=file_get_contents($cachefile);
	}else{
		$curlresults=ilw_curlGET($requesturl);
		/**only cache files that have no errors thrown provided we enabled cache**/
		if(isset($expiry) && $curlresults['errno']==0){
			file_put_contents($cachefile,trim($curlresults['content']));
		}
		$content=$curlresults;
	}

	return $content;
}

/******************************************************************************************************************
*
*	[create iTunes request url variables]
*
*******************************************************************************************************************/
	/**which url are we searching? 'lookup' or 'search' (if searching for artist id in admin)**/
	if(isset($_POST['vars']['type']) && $_POST['vars']['type']!=''){
		$baseUrl='https://itunes.apple.com/'.$_POST['vars']['type'].'?';
	}

	$cUrlGetVars=array();
	/************************************************************
		[lookup]
		[we are looking up an artists/authors album,podcast,audiobook,whatever OR an album's tracklist]
	************************************************************/
	if(isset($_POST['vars']['type']) && $_POST['vars']['type']=='lookup'){
		/**tracklist id's are requested/set via requestid in js when entity is set to song**/
		/** else we get all items of this artist/author here***/
		if(!isset($_POST['vars']['view']) || $_POST['vars']['view']!='tracklist'){
			$cUrlGetVars[]="id=".urlencode(trim($thisInstance['artist_id']))."";
		}

		$cUrlGetVars[]="country=".urlencode(trim($thisInstance['country']))."";
		$cUrlGetVars[]="lang=".urlencode(trim($thisInstance['language']))."";
		$cUrlGetVars[]="explicit=".urlencode(trim($thisInstance['explicit']))."";
	
	
		/**add song to entity request if included in widget settings and we are doing a lookup search otherwise omit song**/
		if(isset($_POST['vars']['view']) && $_POST['vars']['view']=='ini'){
			$urlEntity="".ilw_exclude_from_query_entities($thisInstance['exclude'],$thisInstance['song']);
		}
		/**getting  tracklist**/
		if(isset($_POST['vars']['view']) && $_POST['vars']['view']=='tracklist'){
			$urlEntity="song";
		}
		$cUrlGetVars[]="entity=".$urlEntity."";
	}
	
	/***********************************************************
		[lookup and search]
		[add the request var set to url such as term etc]
	************************************************************/
	if(isset($_POST['vars']['request']) && is_array($_POST['vars']['request'])){
	foreach($_POST['vars']['request'] as $k=>$v){
		$cUrlGetVars[]="".$k."=".urlencode(trim($v))."";
	}}
	
	/***********************************************************
		[add some other general variables]
	************************************************************/
	/**if request limit is not set , use maximum otherwise it will already be in the foreach loop above**/
	if(!isset($_POST['vars']['request']['limit']) || $_POST['vars']['request']['limit']<=0){
		$cUrlGetVars[]="limit=".urlencode(trim($this->pluginItunesLimit))."";
	}
	$cUrlGetVars[]="version=".urlencode(trim($this->pluginItunesVersion))."";//itunes api version

	/***********************************************************
		[create the curl url ]
	**********************************************************/
	$requesturl=''.$baseUrl.''.implode("&",$cUrlGetVars).'';


/**get cache expiry time default->cache disabled***/
$expiry=false;
if(isset($settingsOptions['cache_expiry']) && abs((int)$settingsOptions['cache_expiry'])>0){
	$expiry=abs((int)$settingsOptions['cache_expiry']);
}


/**********************************************************
	[now make the curl call or get the results from cache]
**********************************************************/
$results=ilw_get_results($requesturl,$expiry);


/*******************************************
	[return itunes results (no error/error)]
*******************************************/
if($results['errno']==0){
	$iTunesResponse=$results['content'];
	//	$iTunesResponse=json_encode($results);//if we want to check complete output
}else{
	$iTunesResponse=json_encode($results['error']);

}

/**********************************************************************************
	[return jsonencoded object that holds the iTunes results(to display)
	and any variables we need to localize js frontend, create affiliate id's etc)
	
	! maybe_unserialize used for backwards compatibility !

**********************************************************************************/
/*test vars***/
//	$jsVars['_POST']=$_POST;	
//	$jsVars['_affiliate_type']=$settingsOptions['affiliate_type'];	
//	$jsVars['_widgetOptions']=$widgetOptions;
//	$jsVars['_thisInstance']=$thisInstance;
/*************/


	/**api returns to display in console when no results returned ***/
	$jsVars['_iTunesApiRequest']=$requesturl;
	/**what are we displaying? ini, tracklist, something else(in the future) ?**/
	$jsVars['view'] = isset($_POST['vars']['view']) ? $_POST['vars']['view'] : 'ini';
	/**add settings**/
	$jsVars['localized_frontend']=maybe_unserialize($settingsOptions['localized_frontend']);
	$jsVars['frontend_options']=maybe_unserialize($settingsOptions['frontend_options']);
	$jsVars['affiliate_type']=maybe_unserialize($settingsOptions['affiliate_type']);
	$jsVars['affiliate_values']=maybe_unserialize($settingsOptions['affiliate_values']);
	$jsVars['link_target']=maybe_unserialize($settingsOptions['link_target']);/*set link target if set**/
	
	
	//$jsVars['affiliate_selected']=maybe_unserialize(json_decode($settingsOptions['affiliate_selected']));
	/**add instance vars**/
	$jsVars['country']=$thisInstance['country'];
	$jsVars['exclude']=$thisInstance['exclude'];
	$jsVars['sort']=ilw_val_sort($thisInstance['sort'],$thisInstance['exclude']);
	$jsVars['sortListKey']=$thisInstance['sortKey'];
	$jsVars['sortListOrder']=$thisInstance['sortOrder'];
	$jsVars['show_label']=$thisInstance['show_label'];
	$jsVars['label']=ilw_val_sort($thisInstance['sort'],$thisInstance['exclude'],$thisInstance['lbl']);
	$jsVars['limit']=$thisInstance['max_items'];
	//if(isset($thisInstance['omitid'])){
	$jsVars['omitid']=explode(",",$thisInstance['omitid']);
	//}else{
	//	$jsVars['omitid']=array();
	//}


	
	/*****return js respones, split into itunes variables and jsVars**********/
	$jsonResult = (object) array(
		'iTunes' => (object)json_decode($iTunesResponse),
		'jsVars'=>$jsVars
	);


print"".json_encode($jsonResult);

/*flush output before cleaning cache**/
flush();

/**clear cache if necessary and caching is enabled**/
if(isset($expiry)){
	ilw_cacheinfo($expiry);
}
exit();
?>