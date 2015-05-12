<?php
	function ilw_update_plugin($version,$option){

		/**added tv season in v 0.4**/
		/**add new options to each widget when updating plugin (depending on version)**/
		if(version_compare($version, '0.4' , '<' )){
			$widgetInstances=get_option($option);
			if(is_array($widgetInstances)){
			foreach($widgetInstances as $k=>$old_instance){
				/*set new instance==old instance**/
				$new_instance[$k]=$old_instance;

				if(is_int($k)){/**exclude _multiwidget key**/
					/**add tvSeason value and sort to lbl key and sort key respectively in instance array**/
					$addNewLbl = array ('tvSeason');

					/**add lbl*/
					$new_instance[$k]['lbl']=$old_instance['lbl'].','.implode(",",$addNewLbl).'';

					/**add order to sort key in instance array adding +$i to previous highest value**/
					$sortVals=explode(",",$old_instance['sort']);
					rsort($sortVals);/*sort in reverse to get highest value*/
					$i=0;
					foreach($addNewLbl as $l=>$v){
						$i++;
						$addSort[$k][]=($sortVals[0]+$i);/*add $i to previous highest value**/
					}
					$new_instance[$k]['sort']=$old_instance['sort'].','.implode(",",$addSort[$k]).'';
				}
			}}
			/**now update widget options***/
			update_option($option,$new_instance);
		}

		/****************future version updates here***********************************/



	}
?>