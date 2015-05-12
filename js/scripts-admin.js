jQuery(document).ready(function($){

/***********************************************
	[jquery functions]
***********************************************/
		/****do  getid search  ***/
		ilwIdSearch = function(vars,wKey){

			/**hide results div**/
			$('#ilw-search-results-'+wKey+'').fadeIn().html('<h3>searching...</h3>');
			/**empty info div**/
			$('#ilw-search-info-'+wKey+'').html('');

			jQuery.post(vars.url, {action :'ilw_itunes_json',vars:vars,wKey:wKey}, function(response) {
				data=response.iTunes;
				noofresults=response.iTunes.resultCount;

				/**make all returned artists etc into an object**/
				var artistObj={};
				for(i in data.results){
					var artist = data.results[i];
					if(artist.artistId != undefined && artist.artistId != null){
						/**make it unique as we really do not need the same artisid more than once**/
						artistObj[''+artist.artistId+''] = {'artistName':''+artist.artistName+''};
					}
				}

				if(jQuery.isEmptyObject(artistObj)){
					/**if no artists found , show info**/
					$('#ilw-search-results-'+wKey+'').html('<h3>Nothing Found !</h3>').fadeIn();
				}else{
					/**if artists found , show list upto maximum selected **/
					var res='<h3>Your Search Results!</h3><span><small>check an option below and click "use selected"</small></span><div id="ilw-search-check-'+wKey+'" class="ilw-search-check">';
					for(i in artistObj){
						res+='<label><input type="radio" name="ilw-search-artist-id" value="'+i+'">'+artistObj[i]['artistName']+'</label>';
					}
					res+='</div>';
					res+='<span>';
						res+='<input type="button" id="ilw-use-selected-'+wKey+'" class="ilw-use-selected button-primary" value="use selected">';
					res+='</span>';

					$('#ilw-search-results-'+wKey+'').html(res);
					if(noofresults>=200){
						$('#ilw-search-info-'+wKey+'').html('Max. iTunes results returned [only unique results displayed].<br/>If the search did not return the result you were looking for, try to be more/less specific.');
					}

				}
			},'json')
			.error(function(jqXHR, textStatus, errorThrown) {
				alert("error : " + textStatus);
			});
		}

/***********************************************
	[jquery events]
***********************************************/
		/**** show getid search  ***/
        $(document).on('click', '.ilw-id-search', function(e){
            e.preventDefault();
            var widgetid=((e.target.id).split("-")).pop(-1);
            $('#itunes-lookup-widget-option-'+widgetid+'').slideUp();
       		/**move country selector into id search element**/
            $('#widget-itunes_lookup_widget-'+widgetid+'-country').appendTo('#ilw-search-country-'+widgetid+'');

            $('#itunes-lookup-widget-idsearch-'+widgetid+'').slideDown();
            /**hide save/delete close**/
            $(this).closest('form').find('.widget-control-actions').hide();
        })
		/**** hide getid search  ***/
        $(document).on('click', '.ilw-do-reset', function(e){
            e.preventDefault();
            var widgetid=((e.target.id).split("-")).pop(-1);
            $('#itunes-lookup-widget-idsearch-'+widgetid+'').slideUp();
       		/**move country selector back into into main widget area element**/
			$('#widget-itunes_lookup_widget-'+widgetid+'-country').appendTo('#ilw-widget-country-'+widgetid+'');
			/**empty searchid info div**/
			$('#ilw-search-info-'+widgetid+'').html();

            $('#itunes-lookup-widget-option-'+widgetid+'').slideDown();

            /**show save/delete close**/
            $(this).closest('form').find('.widget-control-actions').show();
        })

        /**** pass parameters to getid search and do the ajax search***/
         $(document).on('click', '.ilw-do-search', function(e){
            e.preventDefault();

            /**get widget id**/
            var self=jQuery(this);
            var instanceId=self.closest('.itunes-lookup-widget').attr('id');

			/**get widget key if in localized parameters**/
			if(typeof ilwParam['instances']!=='undefined' && typeof ilwParam['instances'][''+instanceId+'']!=='undefined'){
			var instanceKey=ilwParam['instances'][''+instanceId+''];
			}

			/*if we have just added a new widget that has not been saved yet, we need to get this key as it will not yet be in the localized ilwparameters*/
			if(typeof instanceKey=='undefined'){
				var instanceKey=(instanceId.split("-")).pop(-1);
			}

			/**select this widget key and add to localized parameters**/
			wKey=instanceKey;

			/**add itunes search request type to localized parameters**/
			ilwParam.type='search';

            /**add itunes request get variables to localized parameters**/
            ilwParam.request={};
			/**if only searching for artists/author etc->default**/
			if ($('#ilw-search-artist-only-'+instanceKey+'').is(':checked')) {
				ilwParam.request.attribute='allArtistTerm';
			}else{
				ilwParam.request.media='all';
			}

			/**add country to request vars**/
			ilwParam.request.country=$('#widget-itunes_lookup_widget-'+instanceKey+'-country').val();

			/**convert search to lowercase first as itunes finds more results that way**/
			var sTerm=$('#ilw-search-term-'+instanceKey+'').val();
			ilwParam.request.term=sTerm.toLowerCase();

            /**now search for artis id's via ajax**/
            if(ilwParam.request.term!=''){
            	ilwIdSearch(ilwParam,wKey);
            }
        })

        /**** get selected artist ids of search , replacing or adding to old ones ->add currently not in use***/
         $(document).on('click', '.ilw-use-selected, .ilw-add-selected', function(e){
       	 	e.preventDefault();
       	 	var widgetid=((e.target.id).split("-")).pop(-1);

			var sel = new Array();
			/*add to previous values not implemented yet*/
			if($(this).attr('class')=='ilw-add-selected'){
				sel=$('#widget-itunes_lookup_widget-'+widgetid+'-artist_id').val().split(",");
			}

			$('#ilw-search-check-'+widgetid+' input:checked').each(function() {
			    sel.push($(this).val());
			});

			/*insert values*/
			$('#widget-itunes_lookup_widget-'+widgetid+'-artist_id').val(sel);
			/**hide search div / go back**/
			$('#itunes-lookup-widget-idsearch-'+widgetid+' .ilw-do-reset').trigger('click');
       	 })
		/*** toggle admin options settings screen divs ***/
		$(document).on('click', '.ilw-settings>.nav-tab-wrapper>a', function(e){
			var tabId=(this.className).split(" ").pop(-1);
			/**hide all  other tabs**/
			$('.ilw-settings .ilw-settings-tab').hide();
			/**show selected tab**/
			$('#'+tabId+'').show();
		})
		/*** get shortcode***********************/
		$(document).on('click', '.ilw-shortcode', function(e){
			e.preventDefault();
			var widgetid=((e.target.id).split("-")).pop(-1);
			var classId=$(e.target).closest('.itunes-lookup-widget').attr('id');

			if($('#widget-'+classId+'-artist_id').val()==''){
				alert('please enter an artist id first');
			}else{
				var ilwPopupShortcode =ilwPopupWindow('','ilwInfo','450','250');
				$(ilwPopupShortcode.document.body).html('one moment');

				jQuery.post(ilwParam.url, {action :'ilw_itunes_json',shortcodeDefaults:1}, function(defaults) {
					/**create the shortcode**/
					var sCode='[itunes-lookup-widget';
					/*artist id*/
					sCode+=' artist_id="'+$('#widget-'+classId+'-artist_id').val()+'"';
					/*now ad value pairs if not defaults*/
						if($('#widget-'+classId+'-country').val()!=defaults.country){
							sCode+=' country="'+$('#widget-'+classId+'-country').val()+'"';
						}
						if($('#widget-'+classId+'-max_items').val()!=defaults.max_items){
							sCode+=' max_items="'+$('#widget-'+classId+'-max_items').val()+'"';
						}
						if($('#widget-'+classId+'-language').val()!=defaults.language){
							sCode+=' language="'+$('#widget-'+classId+'-language').val()+'"';
						}
						if($('#widget-'+classId+'-explicit').val()!=defaults.explicit){
							sCode+=' explicit="'+$('#widget-'+classId+'-explicit').val()+'"';
						}
						if(Boolean($('#widget-'+classId+'-show_label').attr('checked'))!=defaults.show_label){
							sCode+=' show_label="false"';
						}
						if(Boolean($('#widget-'+classId+'-song').attr('checked'))!=defaults.song){
							sCode+=' song="false"';
						}
						if($('#widget-'+classId+'-sortKey').val()!=defaults.sortkey){
							sCode+=' sortkey="'+$('#widget-'+classId+'-sortKey').val()+'"';
						}
						if($('#widget-'+classId+'-sortOrder').val()!=defaults.sortorder){
							sCode+=' sortorder="'+$('#widget-'+classId+'-sortOrder').val()+'"';
						}

						if($('#widget-'+classId+'-omitid').val()!=''){
							sCode+=' omitid="'+$('#widget-'+classId+'-omitid').val()+'"';
						}

						/*********exclude, sort and label**********************************/
						var selectedItems=$('#'+classId+' .ilw-item-options input[type="checkbox"]');
						var sortInp=$('#'+classId+' .ilw-item-options .ilw-sort');
						var lblInp=$('#'+classId+' .ilw-item-options .ilw-lbl');
						var lblDefaults=defaults.lbl.split(",");
						

						var exclArray=[];
						var sortObject={};
						var defaultSort={};
						var lblObject={};
						var defaultLbl={};
						for(i=0;i<selectedItems.length;i++){
							if(selectedItems[i].checked){
								exclArray.push(selectedItems[i].value);
							}else{
								var mkInteger=ilwMakeInteger(''+sortInp[i].value+'');
								defaultSort[''+i+'']=selectedItems[i].value;
								sortObject[''+mkInteger+'']=selectedItems[i].value;
								defaultLbl[''+i+'']=lblDefaults[i];
								lblObject[''+i+'']=lblInp[i].value;
							}
						}
						if(exclArray.length>0){
							sCode+=' exclude="'+exclArray.join(',')+'"';
						}

						/*check if new sortorder is different from default sort**/
						var newSort=ilwSortObjectByKey(sortObject,true).join(',');
						var chkSort=ilwSortObjectByKey(defaultSort,true).join(',');
						if(newSort!=chkSort){
							sCode+=' sort="'+newSort+'"';
						}

						/***********check the labels are different***/
						var newLbl=ilwSortObjectByKey(lblObject,true).join(',');
						var chkLbl=ilwSortObjectByKey(defaultLbl,true).join(',');
						if(newLbl!=chkLbl){
							sCode+=' lbl="'+newLbl+'"';
						}
					sCode+=']';

					/**put shortcode into popup**/
					var ilwPopUpHtml='<div style="font-family:Tahoma, Verdana, Arial, sans-serif;font-size:90%;padding:10px">';
					ilwPopUpHtml+='copy and paste the code below in one line into any post or page<br/><p>(please note: shortcodes do not work - yet - when added into textwidgets):</p><br/><br/>';
					ilwPopUpHtml+='<textarea style="width:99%;margin:0 auto;height:175px">'+sCode+'</textarea>';
					ilwPopUpHtml+='</div>';
					/*write shortcode to popup*/
					$(ilwPopupShortcode.document.body).html(ilwPopUpHtml);

				},'json')
				.error(function(jqXHR, textStatus, errorThrown) {
						alert("sorry, there was an error : " + textStatus +",please tray again");
				});
			}
		})

		/*** single info***********************/
		$(document).on('click', '.ilw-singles-info', function(e){
			var html='<div style="font-family:Tahoma, Verdana, Arial, sans-serif;font-size:90%;padding:10px">';
				html+='The iTunes API treats singles like any other track on an album instead of a collection/album with a trackcount of 1. So if we need to find the singles as well as albums/collections we will have to search for all songs/tracks too<br />';
				html+='As the maximum results that iTunes returns is 200, it may not return all items. <br />';
				html+='For example, if there are - let\'s say - 20 Albums with 10 tracks each plus a few singles for this artist, the API will not return all albums and singles as we will have a result count of over 200.<br />';
				html+='However, if there\'s only one album with a few songs on it (or even none), singles should also be returned<br/><br />';
				html+='<b>In short, if you know there are NO singles (or individual songs on a compilation album for example) associated with this artist (or of course just don\'t want to display them), check this box otherwise leave it unchecked (but not all results may be returned).</b><br />HTH';
				html+='</div>';
				var ilwSingleInfo =ilwPopupWindow('','ilwInfo','450','450');
				$(ilwSingleInfo.document.body).html(html);
		})

})

/***********************************************
	[general functions]
***********************************************/
function ilwPopupWindow(url, title, w, h) {
  var left = (screen.width/2)-(w/2);
  var top = (screen.height/2)-(h/2);
  return window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
}

function ilwMakeInteger(str)
{
	var str = new String(str);
    var mkInteger = str.replace(/[^0-9]/g, '');
    if(mkInteger==''){
    	mkInteger=0;
    }
    return mkInteger;
}

function ilwSortObjectByKey(arrSort,reindex){
    // Setup Arrays
    var sortedKeys = new Array();
    var sortedObj = [];
    // Separate keys and sort them
    for (var i in arrSort){
        sortedKeys.push(i);
    }
	/*sort numerically ascending**/
    sortedKeys.sort(function(a,b){return a-b});
    // Reconstruct sorted obj based on keys
    var c=0;
    for (var i in sortedKeys){
       if(typeof reindex!=='undefined'){key=c;}else{key=sortedKeys[i];}
        sortedObj[key] = arrSort[sortedKeys[i]];
       c++;
    }
    return sortedObj;
}