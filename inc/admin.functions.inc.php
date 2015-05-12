<?php
	/****************************************************
	*	[distincly merge multidimensional array, new keys overwrite old keys
	****************************************************/
function ilw_array_merge_recursive_distinct ( array &$array1, array &$array2 ){
  $merged = $array1;
  foreach ( $array2 as $key => &$value ){
    if ( is_array ( $value ) && isset ( $merged [$key] ) && is_array ( $merged [$key] ) ){
      $merged [$key] = ilw_array_merge_recursive_distinct ( $merged [$key], $value );
    }else{
      $merged [$key] = $value;
    }
  }
  return $merged;
}
   /****************************************************
   	[sanitize some input]
   ****************************************************/
	function sanitize_selection($str,$type='str',$multiple=true) {
		$val=array();
		if(is_array($str)){
		foreach($str as $value){
			if($type=='int'){
				$item=(int)trim(preg_replace("/[^0-9]/","", $value));
			}
			if($type=='str'){
				/**replace komma with entity so we can safely implode below**/
				$item=str_replace(",","&#44;",$value);
				$item=''.ilw_convert_characters($item).'';
			}

				$val[]=$item;
		}
		}
		/**if we want to enable more than one as comma seperated array**/
		if($multiple){
			return implode(",",$val);
		}else{
			return $val[0];
		}
	}
	/*******************************************************************************
		[serialize an array of multiple fields into one option value keeping keys]
	*******************************************************************************/
	function ilw_option_array($array) {
		$val=array();
		if(is_array($array)){
		foreach($array as $key=>$value){
			$val[$key]=ilw_convert_characters($value);
		}}
		///return serialize($val);
		return ($val);
	}

	function ilw_convert_characters($content,$htmlAllowed=false) {
		/**use internal wordpress functions to deal with funny characters**/
		$content=convert_chars($content);
		if(!$htmlAllowed){
		$content=esc_html($content);
		}
		return $content;
	}
/*****************************************************
* return new default options when updating plugin
* compares options in option table with default and returns array
* of options that are not yet in option table or are not used anymore
* used on plugin update
* @a1=>comparison array 1 , @a2=>comparison array 2
******************************************************/
function ilw_compare_options ($a1, $a2) {
    $r = array();
    if(is_array(($a1))){
        foreach($a1 as $k => $v){
            if(isset($a2[$k])){
                $diff = ilw_compare_options($a1[$k], $a2[$k]);
                if (!empty($diff)){
                    $r[$k] = $diff;
                }
            }else{
                $r[$k] = $v;
            }
        }
    }
    return $r;
}

/*****************************************************
*
* merge current with new options
*
******************************************************/
function ilw_merge_options ($added_options,$existing_options) {
  	$merged_array = array();
  	/**add new vars to existing vars**/
	$merged_array=array_merge_recursive($existing_options,$added_options);

  return $merged_array;
}
/**************************************************************
*
* [flatten and inflate multidimensional array to compare]
*
**************************************************************/
function ilw_flatten($arr, $base = "", $divider_char = "/") {
    $ret = array();
    if(is_array($arr)) {
        foreach($arr as $k => $v) {
            if(is_array($v) && count($v)>0) {
                $tmp_array = ilw_flatten($v, $base.$k.$divider_char, $divider_char);
                $ret = array_merge($ret, $tmp_array);
            } else {
                $ret[$base.$k] = $v;
            }
        }
    }
    return $ret;
}

function ilw_inflate($arr, $divider_char = "/") {
    if(!is_array($arr)) {
        return false;
    }

    $split = '/' . preg_quote($divider_char, '/') . '/';

    $ret = array();
    foreach ($arr as $key => $val) {
        $parts = preg_split($split, $key, -1, PREG_SPLIT_NO_EMPTY);
        $leafpart = array_pop($parts);
        $parent = &$ret;
        foreach ($parts as $part) {
            if (!isset($parent[$part])) {
                $parent[$part] = array();
            } elseif (!is_array($parent[$part])) {
                $parent[$part] = array();
            }
            $parent = &$parent[$part];
        }

        if (empty($parent[$leafpart])) {
            $parent[$leafpart] = $val;
        }
    }
    return $ret;
}
?>