<?php
	/*********************************************************
		[country list to determine which store to search]
	*********************************************************/
	function ilw_country_list($selected=''){
	    $items = array(
			array('iso'=>'GB','name'=>'United Kingdom'),
			array('iso'=>'US','name'=>'United States'),
			array('iso'=>'AF','name'=>'Afghanistan'),
			array('iso'=>'AL','name'=>'Albania'),
			array('iso'=>'DZ','name'=>'Algeria'),
			array('iso'=>'AS','name'=>'American Samoa'),
			array('iso'=>'AD','name'=>'Andorra'),
			array('iso'=>'AO','name'=>'Angola'),
			array('iso'=>'AI','name'=>'Anguilla'),
			array('iso'=>'AQ','name'=>'Antarctica'),
			array('iso'=>'AG','name'=>'Antigua And Barbuda'),
			array('iso'=>'AR','name'=>'Argentina'),
			array('iso'=>'AM','name'=>'Armenia'),
			array('iso'=>'AW','name'=>'Aruba'),
			array('iso'=>'AU','name'=>'Australia'),
			array('iso'=>'AT','name'=>'Austria'),
			array('iso'=>'AZ','name'=>'Azerbaijan'),
			array('iso'=>'BS','name'=>'Bahamas'),
			array('iso'=>'BH','name'=>'Bahrain'),
			array('iso'=>'BD','name'=>'Bangladesh'),
			array('iso'=>'BB','name'=>'Barbados'),
			array('iso'=>'BY','name'=>'Belarus'),
			array('iso'=>'BE','name'=>'Belgium'),
			array('iso'=>'BZ','name'=>'Belize'),
			array('iso'=>'BJ','name'=>'Benin'),
			array('iso'=>'BM','name'=>'Bermuda'),
			array('iso'=>'BT','name'=>'Bhutan'),
			array('iso'=>'BO','name'=>'Bolivia'),
			array('iso'=>'BA','name'=>'Bosnia And Herzegowina'),
			array('iso'=>'BW','name'=>'Botswana'),
			array('iso'=>'BV','name'=>'Bouvet Island'),
			array('iso'=>'BR','name'=>'Brazil'),
			array('iso'=>'IO','name'=>'British Indian Ocean Territory'),
			array('iso'=>'BN','name'=>'Brunei Darussalam'),
			array('iso'=>'BG','name'=>'Bulgaria'),
			array('iso'=>'BF','name'=>'Burkina Faso'),
			array('iso'=>'BI','name'=>'Burundi'),
			array('iso'=>'KH','name'=>'Cambodia'),
			array('iso'=>'CM','name'=>'Cameroon'),
			array('iso'=>'CA','name'=>'Canada'),
			array('iso'=>'CV','name'=>'Cape Verde'),
			array('iso'=>'KY','name'=>'Cayman Islands'),
			array('iso'=>'CF','name'=>'Central African Republic'),
			array('iso'=>'TD','name'=>'Chad'),
			array('iso'=>'CL','name'=>'Chile'),
			array('iso'=>'CN','name'=>'China'),
			array('iso'=>'CX','name'=>'Christmas Island'),
			array('iso'=>'CC','name'=>'Cocos (Keeling) Islands'),
			array('iso'=>'CO','name'=>'Colombia'),
			array('iso'=>'KM','name'=>'Comoros'),
			array('iso'=>'CG','name'=>'Congo'),
			array('iso'=>'CD','name'=>'Congo, The Democratic Republic Of The'),
			array('iso'=>'CK','name'=>'Cook Islands'),
			array('iso'=>'CR','name'=>'Costa Rica'),
			array('iso'=>'CI','name'=>'Cote D\'Ivoire'),
			array('iso'=>'HR','name'=>'Croatia (Local Name: Hrvatska)'),
			array('iso'=>'CU','name'=>'Cuba'),
			array('iso'=>'CY','name'=>'Cyprus'),
			array('iso'=>'CZ','name'=>'Czech Republic'),
			array('iso'=>'DK','name'=>'Denmark'),
			array('iso'=>'DJ','name'=>'Djibouti'),
			array('iso'=>'DM','name'=>'Dominica'),
			array('iso'=>'DO','name'=>'Dominican Republic'),
			array('iso'=>'TP','name'=>'East Timor'),
			array('iso'=>'EC','name'=>'Ecuador'),
			array('iso'=>'EG','name'=>'Egypt'),
			array('iso'=>'SV','name'=>'El Salvador'),
			array('iso'=>'GQ','name'=>'Equatorial Guinea'),
			array('iso'=>'ER','name'=>'Eritrea'),
			array('iso'=>'EE','name'=>'Estonia'),
			array('iso'=>'ET','name'=>'Ethiopia'),
			array('iso'=>'FK','name'=>'Falkland Islands (Malvinas)'),
			array('iso'=>'FO','name'=>'Faroe Islands'),
			array('iso'=>'FJ','name'=>'Fiji'),
			array('iso'=>'FI','name'=>'Finland'),
			array('iso'=>'FR','name'=>'France'),
			array('iso'=>'FX','name'=>'France, Metropolitan'),
			array('iso'=>'GF','name'=>'French Guiana'),
			array('iso'=>'PF','name'=>'French Polynesia'),
			array('iso'=>'TF','name'=>'French Southern Territories'),
			array('iso'=>'GA','name'=>'Gabon'),
			array('iso'=>'GM','name'=>'Gambia'),
			array('iso'=>'GE','name'=>'Georgia'),
			array('iso'=>'DE','name'=>'Germany'),
			array('iso'=>'GH','name'=>'Ghana'),
			array('iso'=>'GI','name'=>'Gibraltar'),
			array('iso'=>'GR','name'=>'Greece'),
			array('iso'=>'GL','name'=>'Greenland'),
			array('iso'=>'GD','name'=>'Grenada'),
			array('iso'=>'GP','name'=>'Guadeloupe'),
			array('iso'=>'GU','name'=>'Guam'),
			array('iso'=>'GT','name'=>'Guatemala'),
			array('iso'=>'GN','name'=>'Guinea'),
			array('iso'=>'GW','name'=>'Guinea-Bissau'),
			array('iso'=>'GY','name'=>'Guyana'),
			array('iso'=>'HT','name'=>'Haiti'),
			array('iso'=>'HM','name'=>'Heard And Mc Donald Islands'),
			array('iso'=>'VA','name'=>'Holy See (Vatican City State)'),
			array('iso'=>'HN','name'=>'Honduras'),
			array('iso'=>'HK','name'=>'Hong Kong'),
			array('iso'=>'HU','name'=>'Hungary'),
			array('iso'=>'IS','name'=>'Iceland'),
			array('iso'=>'IN','name'=>'India'),
			array('iso'=>'ID','name'=>'Indonesia'),
			array('iso'=>'IR','name'=>'Iran (Islamic Republic Of)'),
			array('iso'=>'IQ','name'=>'Iraq'),
			array('iso'=>'IE','name'=>'Ireland'),
			array('iso'=>'IL','name'=>'Israel'),
			array('iso'=>'IT','name'=>'Italy'),
			array('iso'=>'JM','name'=>'Jamaica'),
			array('iso'=>'JP','name'=>'Japan'),
			array('iso'=>'JO','name'=>'Jordan'),
			array('iso'=>'KZ','name'=>'Kazakhstan'),
			array('iso'=>'KE','name'=>'Kenya'),
			array('iso'=>'KI','name'=>'Kiribati'),
			array('iso'=>'KP','name'=>'Korea, Democratic People\'s Republic Of'),
			array('iso'=>'KR','name'=>'Korea, Republic Of'),
			array('iso'=>'KW','name'=>'Kuwait'),
			array('iso'=>'KG','name'=>'Kyrgyzstan'),
			array('iso'=>'LA','name'=>'Lao People\'s Democratic Republic'),
			array('iso'=>'LV','name'=>'Latvia'),
			array('iso'=>'LB','name'=>'Lebanon'),
			array('iso'=>'LS','name'=>'Lesotho'),
			array('iso'=>'LR','name'=>'Liberia'),
			array('iso'=>'LY','name'=>'Libyan Arab Jamahiriya'),
			array('iso'=>'LI','name'=>'Liechtenstein'),
			array('iso'=>'LT','name'=>'Lithuania'),
			array('iso'=>'LU','name'=>'Luxembourg'),
			array('iso'=>'MO','name'=>'Macau'),
			array('iso'=>'MK','name'=>'Macedonia, Former Yugoslav Republic Of'),
			array('iso'=>'MG','name'=>'Madagascar'),
			array('iso'=>'MW','name'=>'Malawi'),
			array('iso'=>'MY','name'=>'Malaysia'),
			array('iso'=>'MV','name'=>'Maldives'),
			array('iso'=>'ML','name'=>'Mali'),
			array('iso'=>'MT','name'=>'Malta'),
			array('iso'=>'MH','name'=>'Marshall Islands'),
			array('iso'=>'MQ','name'=>'Martinique'),
			array('iso'=>'MR','name'=>'Mauritania'),
			array('iso'=>'MU','name'=>'Mauritius'),
			array('iso'=>'YT','name'=>'Mayotte'),
			array('iso'=>'MX','name'=>'Mexico'),
			array('iso'=>'FM','name'=>'Micronesia, Federated States Of'),
			array('iso'=>'MD','name'=>'Moldova, Republic Of'),
			array('iso'=>'MC','name'=>'Monaco'),
			array('iso'=>'MN','name'=>'Mongolia'),
			array('iso'=>'MS','name'=>'Montserrat'),
			array('iso'=>'MA','name'=>'Morocco'),
			array('iso'=>'MZ','name'=>'Mozambique'),
			array('iso'=>'MM','name'=>'Myanmar'),
			array('iso'=>'NA','name'=>'Namibia'),
			array('iso'=>'NR','name'=>'Nauru'),
			array('iso'=>'NP','name'=>'Nepal'),
			array('iso'=>'NL','name'=>'Netherlands'),
			array('iso'=>'AN','name'=>'Netherlands Antilles'),
			array('iso'=>'NC','name'=>'New Caledonia'),
			array('iso'=>'NZ','name'=>'New Zealand'),
			array('iso'=>'NI','name'=>'Nicaragua'),
			array('iso'=>'NE','name'=>'Niger'),
			array('iso'=>'NG','name'=>'Nigeria'),
			array('iso'=>'NU','name'=>'Niue'),
			array('iso'=>'NF','name'=>'Norfolk Island'),
			array('iso'=>'MP','name'=>'Northern Mariana Islands'),
			array('iso'=>'NO','name'=>'Norway'),
			array('iso'=>'OM','name'=>'Oman'),
			array('iso'=>'PK','name'=>'Pakistan'),
			array('iso'=>'PW','name'=>'Palau'),
			array('iso'=>'PA','name'=>'Panama'),
			array('iso'=>'PG','name'=>'Papua New Guinea'),
			array('iso'=>'PY','name'=>'Paraguay'),
			array('iso'=>'PE','name'=>'Peru'),
			array('iso'=>'PH','name'=>'Philippines'),
			array('iso'=>'PN','name'=>'Pitcairn'),
			array('iso'=>'PL','name'=>'Poland'),
			array('iso'=>'PT','name'=>'Portugal'),
			array('iso'=>'PR','name'=>'Puerto Rico'),
			array('iso'=>'QA','name'=>'Qatar'),
			array('iso'=>'RE','name'=>'Reunion'),
			array('iso'=>'RO','name'=>'Romania'),
			array('iso'=>'RU','name'=>'Russian Federation'),
			array('iso'=>'RW','name'=>'Rwanda'),
			array('iso'=>'KN','name'=>'Saint Kitts And Nevis'),
			array('iso'=>'LC','name'=>'Saint Lucia'),
			array('iso'=>'VC','name'=>'Saint Vincent And The Grenadines'),
			array('iso'=>'WS','name'=>'Samoa'),
			array('iso'=>'SM','name'=>'San Marino'),
			array('iso'=>'ST','name'=>'Sao Tome And Principe'),
			array('iso'=>'SA','name'=>'Saudi Arabia'),
			array('iso'=>'SN','name'=>'Senegal'),
			array('iso'=>'SC','name'=>'Seychelles'),
			array('iso'=>'SL','name'=>'Sierra Leone'),
			array('iso'=>'SG','name'=>'Singapore'),
			array('iso'=>'SK','name'=>'Slovakia (Slovak Republic)'),
			array('iso'=>'SI','name'=>'Slovenia'),
			array('iso'=>'SB','name'=>'Solomon Islands'),
			array('iso'=>'SO','name'=>'Somalia'),
			array('iso'=>'ZA','name'=>'South Africa'),
			array('iso'=>'GS','name'=>'South Georgia, South Sandwich Islands'),
			array('iso'=>'ES','name'=>'Spain'),
			array('iso'=>'LK','name'=>'Sri Lanka'),
			array('iso'=>'SH','name'=>'St. Helena'),
			array('iso'=>'PM','name'=>'St. Pierre And Miquelon'),
			array('iso'=>'SD','name'=>'Sudan'),
			array('iso'=>'SR','name'=>'Suriname'),
			array('iso'=>'SJ','name'=>'Svalbard And Jan Mayen Islands'),
			array('iso'=>'SZ','name'=>'Swaziland'),
			array('iso'=>'SE','name'=>'Sweden'),
			array('iso'=>'CH','name'=>'Switzerland'),
			array('iso'=>'SY','name'=>'Syrian Arab Republic'),
			array('iso'=>'TW','name'=>'Taiwan'),
			array('iso'=>'TJ','name'=>'Tajikistan'),
			array('iso'=>'TZ','name'=>'Tanzania, United Republic Of'),
			array('iso'=>'TH','name'=>'Thailand'),
			array('iso'=>'TG','name'=>'Togo'),
			array('iso'=>'TK','name'=>'Tokelau'),
			array('iso'=>'TO','name'=>'Tonga'),
			array('iso'=>'TT','name'=>'Trinidad And Tobago'),
			array('iso'=>'TN','name'=>'Tunisia'),
			array('iso'=>'TR','name'=>'Turkey'),
			array('iso'=>'TM','name'=>'Turkmenistan'),
			array('iso'=>'TC','name'=>'Turks And Caicos Islands'),
			array('iso'=>'TV','name'=>'Tuvalu'),
			array('iso'=>'UG','name'=>'Uganda'),
			array('iso'=>'UA','name'=>'Ukraine'),
			array('iso'=>'AE','name'=>'United Arab Emirates'),
			array('iso'=>'UM','name'=>'United States Minor Outlying Islands'),
			array('iso'=>'UY','name'=>'Uruguay'),
			array('iso'=>'UZ','name'=>'Uzbekistan'),
			array('iso'=>'VU','name'=>'Vanuatu'),
			array('iso'=>'VE','name'=>'Venezuela'),
			array('iso'=>'VN','name'=>'Viet Nam'),
			array('iso'=>'VG','name'=>'Virgin Islands (British)'),
			array('iso'=>'VI','name'=>'Virgin Islands (U.S.)'),
			array('iso'=>'WF','name'=>'Wallis And Futuna Islands'),
			array('iso'=>'EH','name'=>'Western Sahara'),
			array('iso'=>'YE','name'=>'Yemen'),
			array('iso'=>'YU','name'=>'Yugoslavia'),
			array('iso'=>'ZM','name'=>'Zambia'),
			array('iso'=>'ZW','name'=>'Zimbabwe')
	    );

	    foreach($items as $key=>$val){
	    	if($val['iso']==$selected){$d=' selected="selected"';}else{$d='';}
			$options[]=array('selected'=>''.$d.'','value'=>''.$val['name'].'','iso'=>''.$val['iso'].'');
	    }

	    return $options;
	}

	/*********************************************************
		[which way to sort type and associated labels]
	*********************************************************/
	function ilw_val_sort($sort,$exclude,$values=false){

		$allTypes=ilw_display_options();
		$excluded=explode(",",$exclude);
		$sortOrder=explode(",",$sort);
		if($values){
			$values=explode(",",$values);
		}

		$order=array();
		foreach($allTypes as $k=>$val){
			if(!in_array($val['id'],$excluded)){
				/**if we want to return values with the sortorder**/
				if($values){
					$order[$values[$k]]=''.$sortOrder[$k].'';
				}else{
					$order[$val['id']]=''.$sortOrder[$k].'';
				}

			}
		}
		asort($order);
		return implode(",",array_keys($order));
	}
	/*********************************************************
		[language options]
	*********************************************************/
	function ilw_language_options($selected=''){
		global $pluginLocale;
		$items['en_us']=__('English', $pluginLocale);
		$items['ja_jp']=__('Japanese', $pluginLocale);

	    foreach($items as $key=>$val){
	    	if($key==$selected){$d=' selected="selected"';}else{$d='';}
			$options[]=array('selected'=>''.$d.'','value'=>''.$val.'','id'=>''.$key.'');
	    }
	    return $options;
	}
	/*********************************************************
		[list type sort options]
	*********************************************************/
	function ilw_list_type_sort_options($selected=''){
		global $pluginLocale;
		$items['default']=__('Default', $pluginLocale);
		$items['itemId']=__('ID', $pluginLocale);
		$items['itemName']=__('Name', $pluginLocale);
		$items['releaseDate']=__('Release Date', $pluginLocale);

	    foreach($items as $key=>$val){
	    	if($key==$selected){$d=' selected="selected"';}else{$d='';}
			$options[]=array('selected'=>''.$d.'','value'=>''.$val.'','id'=>''.$key.'');
	    }

	    return $options;
	}
	/*********************************************************
		[list type sort order]
	*********************************************************/
	function ilw_list_type_sort_order($selected=''){
		$items['asc']='&uArr;';
		$items['desc']='&dArr;';

	    foreach($items as $key=>$val){
	    	if($key==$selected){$d=' selected="selected"';}else{$d='';}
			$options[]=array('selected'=>''.$d.'','value'=>''.$val.'','id'=>''.$key.'');
	    }

	    return $options;
	}
	/*********************************************************
		[which items to display options]
	*********************************************************/
	function ilw_display_options($selected='',$singleDimension=false){
		global $pluginLocale;
		
		$items['collection']=__('Collections/Albums', $pluginLocale);
		$items['featureMovie']=__('Feature Movies', $pluginLocale);
		$items['podcast']=__('Podcasts', $pluginLocale);
		$items['audiobook']=__('Audiobooks', $pluginLocale);
		$items['ebook']=__('eBooks', $pluginLocale);
		$items['software']=__('Software', $pluginLocale);
		$items['tvseason']=__('tvSeason', $pluginLocale);/*new in v 0.4*/

		$s=explode(',',$selected);
	    foreach($items as $key=>$val){
	    	if(in_array($key,$s)){$d=' checked="checked"';}else{$d='';}
			$options[]=array('selected'=>''.$d.'','value'=>''.$val.'','id'=>''.$key.'');
	    }
	    if($singleDimension){
	    	$options=$items;
	    }

	    return $options;
	}	
	/************************************************************
		[exclude items from iTunes query if - well - excluded
		(as it only returns 200 max, let's try to catch as many as we
		sensibly can of the ones that ARE selected)]
	************************************************************/
	function ilw_exclude_from_query_entities($excluded,$excludeSong=false){
		$exclArray=explode(",",$excluded);
			$iTunesQueryEntity=array();
			if(!in_array('collection',$exclArray)){		$iTunesQueryEntity[]='album';}
			if(!in_array('featureMovie',$exclArray)){	$iTunesQueryEntity[]='movie';}
			if(!in_array('podcast',$exclArray)){		$iTunesQueryEntity[]='podcast';}
			if(!in_array('audiobook',$exclArray)){		$iTunesQueryEntity[]='audiobook';}
			if(!in_array('ebook',$exclArray)){			$iTunesQueryEntity[]='ebook';}
			if(!in_array('software',$exclArray)){		$iTunesQueryEntity[]='software';}
			if(!in_array('tvseason',$exclArray)){		$iTunesQueryEntity[]='tvSeason';}/*new in v 0.4*/
				//not implemented on frontend yet itunes returns: "wrapperType":"track", "kind":"music-video" => $iTunesEntity['musicVideo']='musicVideo';
				//not implemented on frontend yet $iTunesEntity['shortFilm']='shortFilm';

			if(!$excludeSong){
				$iTunesQueryEntity[]='song';
			}

		return implode(",",$iTunesQueryEntity);

	}
	/*********************************************************
		[explicit options]
	*********************************************************/
	function ilw_explicit_options($selected=''){
		global $pluginLocale;
		
		$items['Yes']=__('Yes', $pluginLocale);
		$items['No']=__('No', $pluginLocale);

	    foreach($items as $key=>$val){
	    	if($key==$selected){$d=' selected="selected"';}else{$d='';}
			$options[]=array('selected'=>''.$d.'','value'=>''.$val.'','id'=>''.$key.'');
	    }

	    return $options;
	}
?>