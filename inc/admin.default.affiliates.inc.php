<?php
    /************************************************
    *
    *	[affiliate settings default values]
    *
    *
    *************************************************/

    function ilw_affiliate_options($defaults=false) {
    	global $pluginLocale;

		/**************************************************************************************
		*
		*
		*	[DEFAULT AFFILIATE VALUES]
		*
		*
		**************************************************************************************/

		$affiliateDefault['default']['inputtype']='hidden';//set to hidden/text to show/hide
		$affiliateDefault['default']['txt']='<b>'.__('I do not have any affiliate relationships and/or would like to contribute to the development of this plugin.', $pluginLocale).'</b><br/>'.__('(this will insert the developers affiliate links if available, regardless of settings above)', $pluginLocale).'';

		/***TRADEDOUBLER DEFAULT***/
		$affiliateDefault['default']['territories']['EU']['txt']=__('Tradedoubler', $pluginLocale);
		$affiliateDefault['default']['territories']['EU']['programVars'][0]['txt']=__('Program ID', $pluginLocale);
		$affiliateDefault['default']['territories']['EU']['programVars'][0]['key']='p';
		$affiliateDefault['default']['territories']['EU']['programVars'][0]['value']='23708';
		$affiliateDefault['default']['territories']['EU']['p']['required']=true;
		$affiliateDefault['default']['territories']['EU']['programVars'][1]['txt']=__('Website ID', $pluginLocale);
		$affiliateDefault['default']['territories']['EU']['programVars'][1]['key']='a';
		$affiliateDefault['default']['territories']['EU']['programVars'][1]['value']='1285982';
		$affiliateDefault['default']['territories']['EU']['a']['required']=true;
		
		/***PHG DEFAULT***/
		$affiliateDefault['default']['territories']['PHG']['txt']=__('PHG', $pluginLocale);
		$affiliateDefault['default']['territories']['PHG']['programVars'][0]['txt']=__('Affiliate ID', $pluginLocale);
		$affiliateDefault['default']['territories']['PHG']['programVars'][0]['key']='at';
		$affiliateDefault['default']['territories']['PHG']['programVars'][0]['value']='11l3Qg';
		$affiliateDefault['default']['territories']['PHG']['at']['required']=true;
		$affiliateDefault['default']['territories']['PHG']['programVars'][1]['txt']=__('Campaign Text [optional 45 characters max]', $pluginLocale);
		$affiliateDefault['default']['territories']['PHG']['programVars'][1]['key']='ct';
		$affiliateDefault['default']['territories']['PHG']['programVars'][1]['value']='ilw';
		$affiliateDefault['default']['territories']['PHG']['ct']['required']=false;		
		


		/**************************************************************************************
		*
		*
		*	[CUSTOM AFFILIATE VALUES]
		*
		*
		**************************************************************************************/
		$affiliateDefault['custom']['inputtype']='text';
		$affiliateDefault['custom']['txt']='<b>'.__('I want to use my own affiliate program links.', $pluginLocale).'</b><br/>'.__('(please enter details as required, leave blank if you have no affiliate agreement in a given territory)', $pluginLocale).'';

		/***TRADEDOUBLER CUSTOM***/
		$affiliateDefault['custom']['territories']['EU']['txt']=__('Tradedoubler', $pluginLocale);
		$affiliateDefault['custom']['territories']['EU']['programVars'][0]['txt']=__('Program ID', $pluginLocale);
		$affiliateDefault['custom']['territories']['EU']['programVars'][0]['key']='p';
		$affiliateDefault['custom']['territories']['EU']['programVars'][0]['value']='';
		$affiliateDefault['custom']['territories']['EU']['p']['required']=true;
		$affiliateDefault['custom']['territories']['EU']['programVars'][1]['txt']=__('Website ID', $pluginLocale);
		$affiliateDefault['custom']['territories']['EU']['programVars'][1]['key']='a';
		$affiliateDefault['custom']['territories']['EU']['programVars'][1]['value']='';
		$affiliateDefault['custom']['territories']['EU']['a']['required']=true;
		
		/***PHG CUSTOM***/
		$affiliateDefault['custom']['territories']['PHG']['txt']=__('PHG', $pluginLocale);
		$affiliateDefault['custom']['territories']['PHG']['programVars'][0]['txt']=__('Affiliate ID', $pluginLocale);
		$affiliateDefault['custom']['territories']['PHG']['programVars'][0]['key']='at';
		$affiliateDefault['custom']['territories']['PHG']['programVars'][0]['value']='';
		$affiliateDefault['custom']['territories']['PHG']['at']['required']=true;
		
		$affiliateDefault['custom']['territories']['PHG']['programVars'][1]['txt']=__('Campaign Text [optional 45 characters max]', $pluginLocale);
		$affiliateDefault['custom']['territories']['PHG']['programVars'][1]['key']='ct';
		$affiliateDefault['custom']['territories']['PHG']['programVars'][1]['value']='';
		$affiliateDefault['custom']['territories']['PHG']['ct']['required']=false;


		/***use itunes links***/
		$affiliateDefault['iTunes']['txt']='<b>'.__('I do not want to use any *affilate* links at all. All links go directly to the iTunes store', $pluginLocale).'</b>';
		/** dont use any links**/
		$affiliateDefault['none']['txt']='<b>'.__('I do not want to use *any* links at all. Display widget without links to iTunes', $pluginLocale).'</b>';

		if($defaults && is_array($defaults)){
			$defaultVars=array();
			foreach($defaults as $k=>$v){
				foreach($affiliateDefault[$v]['territories'] as $l=>$m){
					$defaultVars[$v][$l]=array();
					foreach($m['programVars'] as $x=>$y){
						$defaultVars[$v][$l][$y['key']]=$y['value'];
					}
				}
			}
			return $defaultVars;
		}else{
			return $affiliateDefault;
		}
    }
?>