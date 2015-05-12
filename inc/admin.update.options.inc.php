<?php
	/****************************************************
	*
	*	[insert new default options into options table]
	*	[delete obsolte options from options table]
	*
	*****************************************************/

	/**********************************************
		[check and add newly added default options]
	***********************************************/
	$added_options=ilw_compare_options($defaultOptions,$this->pluginOptions);

	/*get array of new default options when updating plugin*/
	$update_options=ilw_merge_options($added_options,$this->pluginOptions);


	/*distinctly set plugin version*/
	$update_options['version']=$this->pluginVersion;
	/****************************************************************************
	$update_options now holds the old options plus the added new defaults options
	*****************************************************************************/


	/**********************************************
		[now lets remove obsolete options]
	***********************************************/
	$removed_options=ilw_compare_options($this->pluginOptions,$defaultOptions);/*get obsolete options**/

	/*ini array*/
	$arr1_flat = array();
	$arr2_flat = array();
	/*flatten*/
	$arr1_flat = ilw_flatten($update_options);
	$arr2_flat = ilw_flatten($removed_options);
	/*get difference*/
	$ret = array_diff_assoc($arr1_flat, $arr2_flat);

	/**unflatten->final options**/
	$update_options = ilw_inflate($ret);

	/******************************************************************************************************
	*
	* $update_options now holds old options plus the added new defaults options minus the removed options
	*
	******************************************************************************************************/
?>