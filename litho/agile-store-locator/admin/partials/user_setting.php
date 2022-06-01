<?php


$mail_configs = AgileStoreLocator_Helper::get_configs(['admin_notify', 'notify_email']);


$faq_basic = array(
	array(
		'q' 	=> 'How to add the store locator on the page?',
		'ans' => 'To add the store locator on the page write down the shortcode of the plugin <b>[ASL_STORELOCATOR]</b>, after that click publish to save the page.'
	),
	array(
		'q' 	=> 'How to include the Search Widget that redirect to the Store Locator page?',
		'ans' => 'To add the separate <b>Search Widget</b> over any page, please add the [ASL_SEARCH redirect="https://your-site.com/store-locator"] shortcode, please check the <a target="_blank" href="https://agilestorelocator.com/wiki/address-search-widget/">documentation</a> to see more options.'
	),
	array(
		'q' 	=> 'How to change the default map location?',
		'ans' => 'To change the location of the Google Map, add the <b>Default Coordinates</b> value of your desired location in the ASL Settings, you can get your values by right-click over Google Maps.'
	),
	array(
		'q' 	=> 'Why the newly added stores are not appearing?',
		'ans' => 'Make sure to refresh the Fast Cache if it is enabled in the ASL Settings, and click over Validate Coordinates on the Manage Stores page to see all stores have valid coordinates.'
	),
	array(
		'q' 	=> 'Why I am not getting auto-updates?',
		'ans' => 'Premium version is hosting on Envato market, so follow this <a target="_blank" href="https://agilestorelocator.com/wiki/automatic-updates/">article guide</a> to recieve updates.'
	),
	array(
		'q' 	=> 'Why th Google Map is showing "development" watermark?',
		'ans' => 'The "Development" watermark appears over the Google Maps when the Google API isn\'t configured properly or the required libraries are not enabled, please follow this <a target="_blank" href="https://agilestorelocator.com/blog/enable-google-maps-api-agile-store-locator-plugin/">guide article</a>.'
	)
);

$faq_links = array(
	array(
		'title' => 'How to translate the static content of the plugin?',
		'link'  => 'https://agilestorelocator.com/wiki/language-translation-store-locator/'
	),
	array(
		'title' => 'How can we avoid the template to be overwrite by updates?',
		'link'  => 'https://agilestorelocator.com/wiki/customize-template-without-modifying-core-plugin/'
	),
	array(
		'title' => 'How can we pre-load filter values by the URL?',
		'link'  => 'https://agilestorelocator.com/wiki/load-parameter-with-query-string/'
	),
	array(
		'title' => 'How to create multiple Store Locator on different pages?',
		'link'  => 'https://agilestorelocator.com/wiki/create-multiple-store-locator-different-wordpress-pages/'
	),
	array(
		'title' => 'How can we sort by the categories?',
		'link'  => 'https://agilestorelocator.com/wiki/sort-store-attribute/'
	),
	array(
		'title' => 'How can we change the address format?',
		'link'  => 'https://agilestorelocator.com/wiki/change-address-format/'
	),
	array(
		'title' => 'How to change the user location marker?',
		'link'  => 'https://agilestorelocator.com/wiki/change-user-location-marker-image/'
	),
	array(
		'title' => 'How to add custom tag in the template?',
		'link'  => 'https://agilestorelocator.com/wiki/custom-script-method-store-locator/'
	),
	array(
		'title' => 'Why Store Locator doesn’t appear at all?',
		'link'  => 'https://agilestorelocator.com/wiki/store-locator-doesnot-appear/'
	),
	array(
		'title' => 'How to change the cluster color or size?',
		'link'  => 'https://agilestorelocator.com/wiki/store-locator-clusters/'
	),
	array(
		'title' => 'How to change the font sizing?',
		'link'  => 'https://agilestorelocator.com/wiki/how-to-adjust-the-font-size/'
	),
	array(
		'title' => 'How to change the "Website" text?',
		'link'  => 'https://agilestorelocator.com/wiki/language-translation-store-locator/'
	)
);

?>

<div class="asl-p-cont asl-new-bg">
	<div class="hide">
		<svg xmlns="http://www.w3.org/2000/svg">
		  <symbol id="i-trash" viewBox="0 0 32 32" width="13" height="13" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
		  		<title><?php echo esc_attr__('Trash','asl_admin') ?></title>
			    <path d="M28 6 L6 6 8 30 24 30 26 6 4 6 M16 12 L16 24 M21 12 L20 24 M11 12 L12 24 M12 6 L13 2 19 2 20 6" />
			</symbol>
			<symbol id="i-clock" viewBox="0 0 32 32" width="13" height="13" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
		    <circle cx="16" cy="16" r="14" />
		    <path d="M16 8 L16 16 20 20" />
			</symbol>
			<symbol id="i-plus" viewBox="0 0 32 32" width="13" height="13" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
		  	<title><?php echo esc_attr__('Add','asl_admin') ?></title>
		    <path d="M16 2 L16 30 M2 16 L30 16" />
			</symbol>
      <symbol id="i-chevron-top" viewBox="0 0 32 32" width="13" height="13" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
          <path d="M30 20 L16 8 2 20" />
      </symbol>
      <symbol id="i-chevron-bottom" viewBox="0 0 32 32" width="13" height="13" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
          <path d="M30 12 L16 24 2 12" />
      </symbol>
		</svg>
	</div>
	<div class="container">
		<div class="row asl-setting-cont">
			<div class="col-md-12">
			  <div class="asl-user-setting p-0 mb-4 mt-4">
			     <h3 class="asl-user-setting-title"><?php echo esc_attr__('ASL Settings (Full Version - ','asl_admin').ASL_CVERSION ?>)</h3>
			     <div class="asl-user-setting-body">
			        <ul class="nav nav-pills justify-content-center">
			           <li class="active rounded"><a data-toggle="pill" href="#sl-gen-tab"><?php echo esc_attr__('General','asl_admin') ?></a></li>
			           <li class="rounded"><a data-toggle="pill" href="#maps-tab"><?php echo esc_attr__('Maps','asl_admin') ?></a></li>
			           <li class="rounded"><a data-toggle="pill" href="#sl-ui-tab"><?php echo esc_attr__('UI Settings','asl_admin') ?></a></li>
			           <li class="rounded"><a data-toggle="pill" href="#sl-detail"><?php echo esc_attr__('Detail Page','asl_admin') ?></a></li>
			           <li class="rounded"><a data-toggle="pill" href="#sl-register"><?php echo esc_attr__('Register & Leads','asl_admin') ?></a></li>
			           <li class="rounded"><a  data-toggle="pill" href="#sl-customizer"><?php echo esc_attr__('Customizer','asl_admin') ?></a></li>
			        </ul>
			        <form id="frm-usersetting">
			        	<div class="tab-content">
		              <div id="sl-gen-tab" class="tab-pane in active">
		              	<div class="row mt-2">
			                <div class="col-md-6 col-sm-6 col-12 mb-5">
				                <div class="form-group d-lg-flex d-md-block">
				                  <label class="custom-control-label" for="asl-api_key"><?php echo esc_attr__('Google API KEY','asl_admin') ?></label>
				                  <div class="form-group-inner">
				                  <input  type="text" class="form-control" name="data[api_key]" id="asl-api_key" placeholder="<?php echo esc_attr__('API KEY','asl_admin') ?>">
				                  <p class="help-p"><a target="_blank" class="text-muted" href="https://agilestorelocator.com/blog/enable-google-maps-api-agile-store-locator-plugin/"><?php echo esc_attr__('How to generate Google API?','asl_admin') ?></a></p>
				                  </div>
				                </div>
			                </div>
			                <div class="col-md-6 col-sm-6 col-12 mb-5">
			                  <div class="form-group d-lg-flex d-md-block">
			                    <label class="custom-control-label" for="asl-server_key"><?php echo esc_attr__('Google Server API Key','asl_admin') ?></label>
			                    <div class="form-group-inner">
			                    <input  type="text" class="form-control" name="data[server_key]" id="asl-server_key" placeholder="<?php echo esc_attr__('Google API KEY (Geocoding)','asl_admin') ?>">
			                    <p class="help-p"><a target="_blank" class="text-muted" href="https://agilestorelocator.com/wiki/what-is-google-server-key/"><?php echo esc_attr__('What is Google Server Key?','asl_admin') ?></a> | <a target="_blank" class="text-muted" href="https://agilestorelocator.com/wiki/google-server-api-key-troubleshooting/"><?php echo esc_attr__('Troubleshoot','asl_admin') ?></a></p>
			                    </div>
			                  </div>
			                </div>
			                <div class="col-md-6 col-sm-6 col-12 mb-5">
			                  <div class="form-group d-lg-flex d-md-block">
			                    <label class="custom-control-label" for="asl-default_lat"><?php echo esc_attr__('Default Coordinates','asl_admin') ?></label>
			                    <div class="form-group-inner">
			                      <div class="input-group">
			                      	<input  type="number" class="form-control validate[required]" name="data[default_lat]" id="asl-default_lat" placeholder="<?php echo esc_attr__('Latitude','asl_admin') ?>">
			                      	<input  type="number" class="form-control validate[required]" name="data[default_lng]"  id="asl-default_lng" placeholder="<?php echo esc_attr__('Longitude','asl_admin') ?>">
			                      </div>
			                      <p class="help-p"><a target="_blank" class="text-muted" href="https://www.google.com/maps"><?php echo esc_attr__('Get your coordinates by right click on the map','asl_admin') ?></a></p>
			                    </div>
			                  </div>
			                </div>
			                <div class="col-md-6 col-sm-6 col-12 mb-5">
			                  <div class="form-group d-lg-flex d-md-block">
			                    <label class="custom-control-label" for="asl-distance_control"><?php echo esc_attr__('Distance Control','asl_admin') ?></label>
			                    <div>
                             	<div class="asl-wc-radio">
                                <label for="asl-distance_control-0"><input type="radio" name="data[distance_control]" value="0"  id="asl-distance_control-0"><?php echo esc_attr__('Slider','asl_admin') ?></label>
                             	</div>
                             	<div class="asl-wc-radio">
                                <label for="asl-distance_control-1"><input type="radio" name="data[distance_control]" value="1" id="asl-distance_control-1"><?php echo esc_attr__('Dropdown','asl_admin') ?></label>
                             	</div>
                             	<div class="asl-wc-radio">
                                <label for="asl-distance_control-2"><input type="radio" name="data[distance_control]" value="2" id="asl-distance_control-2"><?php echo esc_attr__('Boundary Box','asl_admin') ?></label>
                             	</div>
                             	<p class="help-p"><a class="text-muted" target="_blank" href="https://agilestorelocator.com/wiki/set-radius-value-distance-range-slider/"><?php echo esc_attr__('Select the distance filter control','asl_admin') ?></a></p>
                          </div>
			                  </div>
			                </div>
			                <div class="col-md-6 col-sm-6 col-12 mb-5">
			                  <div class="form-group d-lg-flex d-md-block">
			                    <label class="custom-control-label" for="asl-direction_redirect"><?php echo esc_attr__('Store Direction','asl_admin') ?></label>
			                    <div class="form-group-inner">
		                        <select  name="data[direction_redirect]" id="asl-direction_redirect" class="custom-select">
		                          <option value="0"><?php echo esc_attr__('Show Direction in the Panel via Google Direction API','asl_admin') ?></option>
		                          <option value="1"><?php echo esc_attr__('Open in Google Maps (Mobile)','asl_admin') ?></option>
		                          <option value="2"><?php echo esc_attr__('Open in Google Maps (All Devices)','asl_admin') ?></option>
		                        </select>
			                      <p class="help-p"><?php echo esc_attr__('Select how you want the direction to work.','asl_admin') ?></p>
			                    </div>
			                  </div>
			                </div>
			                <div class="col-md-6 col-sm-6 col-12 mb-5">
			                  <div class="form-group d-lg-flex d-md-block">
			                    <label class="custom-control-label" for="asl-dropdown_range"><?php echo esc_attr__('Distance Options','asl_admin') ?></label>
			                    <div class="form-group-inner">
			                    <input type="text" class="form-control" name="data[dropdown_range]" id="asl-dropdown_range" placeholder="Example: 10,20,30">
			                    <p class="help-p"><?php echo esc_attr__('Enter the search dropdown options values, comma separated. Add default value with * symbol.','asl_admin') ?></p>
			                    </div>
			                  </div>
			                </div>
			                <div class="col-md-6 col-sm-6 col-12 mb-5">
			                  <div class="form-group d-lg-flex d-md-block">
			                    <label class="custom-control-label" for="search_type"><?php echo esc_attr__('Search Type','asl_admin') ?></label>
			                    <div class="form-group-inner">
			                      <select  name="data[search_type]" id="asl-search_type" class="custom-select">
			                        <option value="0"><?php echo esc_attr__('Search By Address (Google)','asl_admin') ?></option>
			                        <option value="1"><?php echo esc_attr__('Search By Store Name (Database)','asl_admin') ?></option>
			                        <option value="2"><?php echo esc_attr__('Search By Stores Cities, States (Database)','asl_admin') ?></option>
			                        <option value="3"><?php echo esc_attr__('Geocoding on Enter key (Google Geocoding API)','asl_admin') ?></option>
			                      </select>
			                      <p class="help-p"><?php echo esc_attr__('Select the Address search type, it can be database search or Google Place API/Geocoding.','asl_admin') ?></p>
			                    </div>
			                  </div>
			                </div>
			                <div class="col-md-6 col-sm-6 col-12 mb-5">
			                  <div class="form-group d-lg-flex d-md-block">
			                    <label class="custom-control-label" for="prompt_location"><?php echo esc_attr__('Geolocation','asl_admin') ?></label>
			                    <div class="form-group-inner">
			                      <select  id="asl-prompt_location" name="data[prompt_location]" class="custom-select">
			                        <option value="0"><?php echo esc_attr__('Disable','asl_admin') ?></option>
			                        <option value="1"><?php echo esc_attr__('Geo-location Modal','asl_admin') ?></option>
			                        <option value="2"><?php echo esc_attr__('Type your Location Modal','asl_admin') ?></option>
			                        <option value="3"><?php echo esc_attr__('Geolocation On Load','asl_admin') ?></option>
			                      </select>
			                      <p class="help-p"><a target="_blank" class="text-muted" href="https://agilestorelocator.com/wiki/prompt-geo-location-dialog/"><?php echo esc_attr__('How Geolocation works?','asl_admin') ?></a></p>
			                    </div>
			                  </div>
			                </div>
			                <div class="col-md-6 col-sm-6 col-12 mb-5">
			                  <div class="form-group d-lg-flex d-md-block">
			                    <label class="custom-control-label" for="search_destin"><?php echo esc_attr__('Search Result','asl_admin') ?></label>
			                    <div class="form-group-inner">
			                      <select  id="asl-search_destin" name="data[search_destin]" class="custom-select">
			                        <option value="0"><?php echo esc_attr__('Default','asl_admin') ?></option>
			                        <option value="1"><?php echo esc_attr__('Show My Nearest Location From Search','asl_admin') ?></option>
			                      </select>
			                      <p class="help-p"><?php echo esc_attr__('Search will pinpoint the nearest available store instead of actual location','asl_admin') ?></p>
			                    </div>
			                  </div>
			                </div>
			                <div class="col-md-6 col-sm-6 col-12 mb-5">
			                  <div class="form-group d-lg-flex d-md-block">
			                    <label class="custom-control-label" for="sort_by"><?php echo esc_attr__('Sort List','asl_admin') ?></label>
			                    <div class="form-group-inner">
			                      <select  id="asl-sort_by" name="data[sort_by]" class="custom-select">
			                        <option value=""><?php echo esc_attr__('Default (Distance)','asl_admin') ?></option>
			                        <option value="id"><?php echo esc_attr__('Store ID','asl_admin') ?></option>
			                        <option value="title"><?php echo esc_attr__('Title','asl_admin') ?></option>
			                        <option value="city"><?php echo esc_attr__('City','asl_admin') ?></option>
			                        <option value="state"><?php echo esc_attr__('State','asl_admin') ?></option>
			                        <option value="logo_id"><?php echo esc_attr__('Logo ID','asl_admin') ?></option>
			                        <option value="cat"><?php echo esc_attr__('Categories','asl_admin') ?></option>
			                      </select>
			                      <p class="help-p"><a target="_blank" class="text-muted" href="https://agilestorelocator.com/wiki/sort-store-attribute/"><?php echo esc_attr__('Sort your listing based on fields, default is Distance','asl_admin') ?></a></p>
			                    </div>
			                  </div>
			                </div>
			                <div class="col-md-6 col-sm-6 col-12 mb-5">
			                  <div class="form-group d-lg-flex d-md-block">
			                    <label class="custom-control-label" for="stores_limit"><?php echo esc_attr__('Stores Limit','asl_admin') ?></label>
			                    <div class="form-group-inner">
			                      <input  type="number" class="form-control validate[integer]" name="data[stores_limit]" id="asl-stores_limit">
			                      <p class="help-p"><a target="_blank" class="text-muted" href="https://agilestorelocator.com/wiki/show-limited-stores-sort-by-distance/"><?php echo esc_attr__('To show a limited number of stores.','asl_admin') ?></a></p>
			                    </div>
			                  </div>
			                </div>
			                <div class="col-md-6 col-sm-6 col-12 mb-5">
			                  <div class="form-group d-lg-flex d-md-block">
			                    <label class="custom-control-label" for="asl-distance_unit"><?php echo esc_attr__('Distance Unit','asl_admin') ?></label>
			                    <div>
                             <div class="asl-wc-radio">
                                <label for="asl-distance_unit-KM"><input type="radio" name="data[distance_unit]" value="KM"  id="asl-distance_unit-KM"><?php echo esc_attr__('KM','asl_admin') ?></label>
                             </div>
                             <div class="asl-wc-radio">
                                <label for="asl-distance_unit-Miles"><input type="radio" name="data[distance_unit]" value="Miles" id="asl-distance_unit-Miles"><?php echo esc_attr__('Miles','asl_admin') ?></label>
                             </div>
                             <p class="help-p"><?php echo esc_attr__('Select the distance unit to use on Store Locator','asl_admin') ?></p>
                          </div>
			                  </div>
			                </div>
			                <div class="col-md-6 col-sm-6 col-12 mb-5">
			                  <div class="form-group d-lg-flex d-md-block">
			                    <label class="custom-control-label" for="geo_button"><?php echo esc_attr__('Search Button Type','asl_admin') ?></label>
			                    <div>
                             	<div class="asl-wc-radio">
                                <label for="asl-geo_button-0"><input type="radio" name="data[geo_button]" value="0"  id="asl-geo_button-0"><?php echo esc_attr__('Search Location','asl_admin') ?></label>
                             	</div>
                             	<div class="asl-wc-radio">
                                <label for="asl-geo_button-1"><input type="radio" name="data[geo_button]" value="1" id="asl-geo_button-1"><?php echo esc_attr__('Geo-Location','asl_admin') ?></label>
                             	</div>
                             	<p class="help-p"><?php echo esc_attr__('Select either to display the geolocation button or the search button next to address search','asl_admin') ?></p>
                          </div>
			                  </div>
			                </div>
			                <div class="col-md-6 col-sm-6 col-12 mb-5">
			                  <div class="form-group d-lg-flex d-md-block">
			                    <label class="custom-control-label" for="load_all"><?php echo esc_attr__('Marker Load','asl_admin') ?></label>
			                    <div class="form-group-inner">
			                      <select  name="data[load_all]" id="asl-load_all" class="custom-select">
			                        <option value="1"><?php echo esc_attr__('Load All','asl_admin') ?></option>
			                        <option value="0"><?php echo esc_attr__('Load on Bound','asl_admin') ?></option>
			                        <option value="2"><?php echo esc_attr__('Load via Button','asl_admin') ?></option>
			                      </select>
			                      <p class="help-p"><?php echo esc_attr__('Use Load on Bound in case of 1K+ markers','asl_admin') ?></p>
			                    </div>
			                  </div>
			                </div>
			                <div class="col-md-6 col-sm-6 col-12 mb-5">
			                  <div class="form-group d-lg-flex d-md-block">
			                    <label class="custom-control-label" for="single_cat_select"><?php echo esc_attr__('Category Select','asl_admin') ?></label>
			                    <div>
                             <div class="asl-wc-radio">
                                <label for="asl-single_cat_select-0"><input type="radio" name="data[single_cat_select]" value="0"  id="asl-single_cat_select-0"><?php echo esc_attr__('Multiple Category Selection','asl_admin') ?></label>
                             </div>
                             <div class="asl-wc-radio">
                                <label for="asl-single_cat_select-1"><input type="radio" name="data[single_cat_select]" value="1" id="asl-single_cat_select-1"><?php echo esc_attr__('Single Category Selection','asl_admin') ?></label>
                             </div>
                             <p class="help-p"><?php echo esc_attr__('To make the category selection mode','asl_admin') ?></p>
                          </div>
			                  </div>
			                </div>
			                <div class="col-md-6 col-sm-6 col-12 mb-5">
			                  <div class="form-group d-lg-flex d-md-block">
			                    <label class="custom-control-label" class="custom-control-label" for="asl-google_search_type"><?php echo esc_attr__('Search Field','asl_admin') ?></label>
			                    <div class="form-group-inner">
			                      <select  name="data[google_search_type]" id="asl-google_search_type" class="custom-select">
			                        <option value=""><?php echo esc_attr__('All','asl_admin') ?></option>
			                        <option value="cities"><?php echo esc_attr__('Cities (Cities)','asl_admin') ?></option>
			                        <option value="regions"><?php echo esc_attr__('Regions (Locality, City, State)','asl_admin') ?></option>
			                        <option value="geocode"><?php echo esc_attr__('Geocode','asl_admin') ?></option>
			                        <option value="address"><?php echo esc_attr__('Address','asl_admin') ?></option>
			                      </select>
			                      <p class="help-p"><?php echo esc_attr__('To restrict the Google Place API search scope','asl_admin') ?></p>
			                    </div>
			                  </div>
			                </div>
			                
			                <div class="col-md-6 col-sm-6 col-12 mb-5">
			                  <div class="form-group d-lg-flex d-md-block">
			                    <label class="custom-control-label" for="asl-country_restrict"><?php echo esc_attr__('Restrict Search','asl_admin') ?></label>
			                    <div class="form-group-inner">
			                      <input  type="text" class="form-control validate[minSize[2]]" name="data[country_restrict]" id="asl-country_restrict" placeholder="Example: US">
			                      <p class="help-p"><?php echo esc_attr__('Enter 2 alphabet country, for multiple countries comma separated','asl_admin') ?> <a href="https://en.wikipedia.org/wiki/ISO_3166-1_alpha-2" target="_blank" rel="nofollow">Code</a></p>
			                    </div>
			                  </div>
			                </div>

			                <div class="col-md-6 col-sm-6 col-12 mb-5">
			                  <div class="form-group d-lg-flex d-md-block">
			                    <label class="custom-control-label" for="asl-first_load"><?php echo esc_attr__('List Load','asl_admin') ?></label>
			                    <div class="form-group-inner">
			                    <select  name="data[first_load]" id="asl-first_load" class="custom-select">
			                      <option value="1"><?php echo esc_attr__('Default','asl_admin') ?></option>
			                      <option value="2"><?php echo esc_attr__('No List and Markers at Load','asl_admin') ?></option>
			                      <option value="3"><?php echo esc_attr__('No List with Full Map at Load','asl_admin') ?></option>
			                      <option value="4"><?php echo esc_attr__('No List at Load','asl_admin') ?></option>
			                      <option value="5"><?php echo esc_attr__('No List & Map at Load','asl_admin') ?></option>
			                      <option value="6"><?php echo esc_attr__('Only Show Stores on Category Selection','asl_admin') ?></option>
			                      <option value="7"><?php echo esc_attr__('Only Show Selected Store on List','asl_admin') ?></option>
			                    </select>
			                    <p class="help-p"><?php echo esc_attr__('Show no stores on the page load','asl_admin') ?></p>
			                    </div>
			                  </div>
			                </div>
			                <div class="col-md-6 col-sm-6 col-12 mb-5">
	                      <div class="form-group d-lg-flex d-md-block">
	                          <label class="custom-control-label" for="asl-advance_filter"><?php echo esc_attr__('Advance Filter','asl_admin') ?></label>
	                        	<div class="form-group-inner">
	                          	<label class="switch" for="asl-advance_filter"><input type="checkbox" value="1" class="custom-control-input" name="data[advance_filter]" id="asl-advance_filter"><span class="slider round"></span></label>
	                          	<p class="help-p"><a href="https://agilestorelocator.com/wiki/enable-disable-advance-features/" target="_blank"><?php echo esc_attr__('Disabling it will remove all the filters','asl_admin') ?></a></p>
	                        	</div>
	                      </div>
                      </div>
                      <div class="col-md-6 col-sm-6 col-12 mb-5">
	                      <div class="form-group d-lg-flex d-md-block">
	                          <label class="custom-control-label" for="asl-address_ddl"><?php echo esc_attr__('Address Dropdowns','asl_admin') ?></label>
	                        	<div class="form-group-inner">
	                          	<label class="switch" for="asl-address_ddl"><input type="checkbox" value="1" class="custom-control-input" name="data[address_ddl]" id="asl-address_ddl"><span class="slider round"></span></label>
	                          	<p class="help-p"><?php echo esc_attr__('It will display the Dropdown controls for Country, State and City.','asl_admin') ?></p>
	                        	</div>
	                      </div>
                      </div>
                      <div class="col-md-6 col-sm-6 col-12 mb-5">
	                      <div class="form-group d-lg-flex d-md-block">
	                          <label class="custom-control-label" for="asl-time_switch"><?php echo esc_attr__('Time Switch','asl_admin') ?></label>
	                        	<div class="form-group-inner">
	                          	<label class="switch" for="asl-time_switch"><input type="checkbox" value="1" class="custom-control-input" name="data[time_switch]" id="asl-time_switch"><span class="slider round"></span></label>
	                          	<p class="help-p"><?php echo esc_attr__('Control will show a switch to see opened stores at the current time','asl_admin') ?></p>
	                        	</div>
	                      </div>
                      </div>
                      <div class="col-md-6 col-sm-6 col-12 mb-5">
	                      <div class="form-group d-lg-flex d-md-block">
	                          <label class="custom-control-label" for="asl-distance_slider"><?php echo esc_attr__('Distance Control','asl_admin') ?></label>
		                        <div class="form-group-inner">
		                          <label class="switch" for="asl-distance_slider"><input type="checkbox" value="1" class="custom-control-input" name="data[distance_slider]" id="asl-distance_slider"><span class="slider round"></span></label>
		                        </div>
	                      </div>
                      </div>
                      <div class="col-md-6 col-sm-6 col-12 mb-5">
	                      <div class="form-group d-lg-flex d-md-block">
	                          <label class="custom-control-label" for="asl-analytics"><?php echo esc_attr__('Analytics','asl_admin') ?></label>
		                        <div class="form-group-inner">
		                          <label class="switch" for="asl-analytics"><input type="checkbox" value="1" class="custom-control-input" name="data[analytics]" id="asl-analytics"><span class="slider round"></span></label>
		                        </div>
	                      </div>
                      </div>
                      <div class="col-md-6 col-sm-6 col-12 mb-5">
	                      <div class="form-group d-lg-flex d-md-block">
	                          <label class="custom-control-label" for="asl-sort_by_bound"><?php echo esc_attr__('Sort By Bound','asl_admin') ?></label>
	                        	<div class="form-group-inner">
	                          	<label class="switch" for="asl-sort_by_bound"><input type="checkbox" value="1" class="custom-control-input" name="data[sort_by_bound]" id="asl-sort_by_bound"><span class="slider round"></span></label>
	                          	<p class="help-p"><?php echo esc_attr__('Refresh list to show nearest stores in the view.','asl_admin') ?></p>
	                        	</div>
	                      </div>
                      </div>
                      <div class="col-md-6 col-sm-6 col-12 mb-5">
	                      <div class="form-group d-lg-flex d-md-block">
	                          <label class="custom-control-label" for="asl-target_blank"><?php echo esc_attr__('Open Link New Tab','asl_admin') ?></label>
	                        	<div class="form-group-inner">
	                          	<label class="switch" for="asl-target_blank"><input type="checkbox" value="1" class="custom-control-input" name="data[target_blank]" id="asl-target_blank"><span class="slider round"></span></label>
	                        	</div>
	                      </div>
                      </div>
                      <div class="col-md-6 col-sm-6 col-12 mb-5">
	                      <div class="form-group d-lg-flex d-md-block">
	                        <label class="custom-control-label" for="asl-user_center"><?php echo esc_attr__('Default Location Center','asl_admin') ?></label>
	                        <div class="form-group-inner">
	                          <label class="switch" for="asl-user_center"><input type="checkbox" value="1" class="custom-control-input" name="data[user_center]" id="asl-user_center"><span class="slider round"></span></label>
	                        	<p class="help-p"><?php echo esc_attr__('Store Locator will consider Default coordinates as the center point','asl_admin') ?></p>
	                        </div>
	                      </div>
                      </div>
                      <div class="col-md-6 col-sm-6 col-12 mb-5">
	                      <div class="form-group d-lg-flex d-md-block">
	                          <label class="custom-control-label" for="asl-geo_marker"><?php echo esc_attr__('Geo-Location Marker','asl_admin') ?></label>
	                        	<div class="form-group-inner">
	                          	<label class="switch" for="asl-geo_marker"><input type="checkbox" value="1" class="custom-control-input" name="data[geo_marker]" id="asl-geo_marker"><span class="slider round"></span></label>
	                        		<p class="help-p"><?php echo esc_attr__('To remove the user own location marker','asl_admin') ?></p>
	                        	</div>
	                      </div>
                      </div>
                      <div class="col-md-6 col-sm-6 col-12 mb-5">
	                      <div class="form-group d-lg-flex d-md-block">
	                          <label class="custom-control-label" for="asl-remove_maps_script"><?php echo esc_attr__('Remove Other Maps Scripts','asl_admin') ?></label>
		                        <div class="form-group-inner">
		                          <label class="switch" for="asl-remove_maps_script"><input type="checkbox" value="1" class="custom-control-input" name="data[remove_maps_script]" id="asl-remove_maps_script"><span class="slider round"></span></label>
		                          <p class="help-p"><?php echo esc_attr__('Remove other Google Maps scripts in case of malfunctioning','asl_admin') ?></p>
		                        </div>
	                      </div>
                      </div>
                      <div class="col-md-6 col-sm-6 col-12 mb-5">
	                      <div class="form-group d-lg-flex d-md-block">
	                          <label class="custom-control-label" for="asl-and_filter"><?php echo esc_attr__('AND Filter','asl_admin') ?></label>
		                        <div class="form-group-inner">
		                          <label class="switch" for="asl-and_filter"><input type="checkbox" value="1" class="custom-control-input" name="data[and_filter]" id="asl-and_filter"><span class="slider round"></span></label>
	                        		<p class="help-p"><?php echo esc_attr__('To change the category filter logic from OR to AND','asl_admin') ?></p>
		                        </div>
	                      </div>
                      </div>
                      <div class="col-md-6 col-sm-6 col-12 mb-5">
	                      <div class="form-group d-lg-flex d-md-block">
	                          <label class="custom-control-label" for="asl-category_marker"><?php echo esc_attr__('Category Marker','asl_admin') ?></label>
		                        <div class="form-group-inner">
		                          <label class="switch" for="asl-category_marker"><input type="checkbox" value="1" class="custom-control-input" name="data[category_marker]" id="asl-category_marker"><span class="slider round"></span></label>
	                        		<p class="help-p"><?php echo esc_attr__('Manage Markers will be replaced by the Category Icons','asl_admin') ?></p>
		                        </div>
	                      </div>
                      </div>
                      <div class="col-md-6 col-sm-6 col-12 mb-5">
	                      <div class="form-group d-lg-flex d-md-block">
	                          <label class="custom-control-label" for="asl-category_bound"><?php echo esc_attr__('Category Bound','asl_admin') ?></label>
		                        <div class="form-group-inner">
		                          <label class="switch" for="asl-category_bound"><input type="checkbox" value="1" class="custom-control-input" name="data[category_bound]" id="asl-category_bound"><span class="slider round"></span></label>
	                        		<p class="help-p"><?php echo esc_attr__('Fit bound to markers when a category is selected','asl_admin') ?></p>
		                        </div>
	                      </div>
                      </div>
                      <div class="col-md-6 col-sm-6 col-12 mb-5">
	                      <div class="form-group d-lg-flex d-md-block">
	                          <label class="custom-control-label" for="asl-sort_random"><?php echo esc_attr__('Sort Random','asl_admin') ?></label>
		                        <div class="form-group-inner">
		                          <label class="switch" for="asl-sort_random"><input type="checkbox" value="1" class="custom-control-input" name="data[sort_random]" id="asl-sort_random"><span class="slider round"></span></label>
	                        		<p class="help-p"><?php echo esc_attr__('Sort stores list randomly on the load of the Store Locator (Enabling it will disable Default Location Marker)','asl_admin') ?></p>
		                        </div>
	                      </div>
                      </div>
                      <div class="col-md-6 col-sm-6 col-12 mb-5">
	                      <div class="form-group d-lg-flex d-md-block">
	                          <label class="custom-control-label" for="asl-locale"><?php echo esc_attr__('Data WPML','asl_admin') ?></label>
		                        <div class="form-group-inner">
		                          <label class="switch" for="asl-locale"><input type="checkbox" value="1" class="custom-control-input" name="data[locale]" id="asl-locale"><span class="slider round"></span></label>
	                        		<p class="help-p text-danger">(<?php echo esc_attr__('Enabling it will hide all your stores data if data is not assigned for the correct language','asl_admin') ?>) | <a href="https://agilestorelocator.com/wiki/language-translation-store-locator/" target="_blank" rel="nofollow"><?php echo esc_attr__('Documentation','asl_admin') ?></a></p>
		                        </div>
	                      </div>
                      </div>
                      <div class="col-md-6 col-sm-6 col-12 mb-5">
											  <div class="form-group d-lg-flex d-md-block">
											    <label class="custom-control-label" for="asl-gdpr"><?php echo esc_attr__('GDPR','asl_admin') ?></label>
											    <div>
											        <div class="asl-wc-radio">
											          <label for="asl-gdpr-0"><input type="radio" name="data[gdpr]" value="0"  id="asl-gdpr-0"><?php echo esc_attr__('Disable','asl_admin') ?></label>
											        </div>
											        <div class="asl-wc-radio">
											          <label for="asl-gdpr-1"><input type="radio" name="data[gdpr]" value="1" id="asl-gdpr-1"><?php echo esc_attr__('Plugin GDPR','asl_admin') ?></label>
											        </div>
											        <div class="asl-wc-radio">
											          <label for="asl-gdpr-2"><input type="radio" name="data[gdpr]" value="2" id="asl-gdpr-2"><?php echo esc_attr__('Borlab Cookies','asl_admin') ?></label>
											        </div>
											        <p class="help-p"><a class="text-muted" target="_blank" href="https://agilestorelocator.com/wiki/gdpr-consent-for-google-maps-library/"><?php echo esc_attr__('GDPR Consent for the Google Maps Library','asl_admin') ?></a></p>
											    </div>
											  </div>
											</div>
			              </div>
		              </div>
		              <div id="maps-tab" class="tab-pane">
		              	<div class="row">
		              		<div class="col-md-6 col-sm-6 col-12 mb-5">
			                  <div class="form-group d-lg-flex d-md-block">
			                    <label class="custom-control-label" for="asl-map_type"><?php echo esc_attr__('Default Map','asl_admin') ?></label>
			                    <div class="form-group-inner">
			                      <select  id="asl-map_type" name="data[map_type]" class="custom-select">
			                        <option value="hybrid"><?php echo esc_attr__('Hybrid','asl_admin') ?></option>
			                        <option value="roadmap"><?php echo esc_attr__('Road Map','asl_admin') ?></option>
			                        <option value="satellite"><?php echo esc_attr__('Satellite','asl_admin') ?></option>
			                        <option value="terrain"><?php echo esc_attr__('Terrain','asl_admin') ?></option>
			                      </select>
			                    </div>
			                  </div>
			                </div>
			                <div class="col-md-6 col-sm-6 col-12 mb-5">
			                  <div class="form-group d-lg-flex d-md-block">
			                    <label class="custom-control-label" for="asl-zoom"><?php echo esc_attr__('Default Zoom','asl_admin') ?></label>
			                    <div class="form-group-inner">
			                      <select  id="asl-zoom" name="data[zoom]" class="custom-select">
			                        <?php for($index = 2;$index <= 20;$index++):?>
			                        <option value="<?php echo $index ?>"><?php echo $index ?></option>
			                        <?php endfor; ?>
			                      </select>
			                      <p class="help-p"><?php echo esc_attr__('Default zoom will not work when Default Location Center is enabled','asl_admin') ?></p>
			                    </div>
			                  </div>
			                </div>
			                <div class="col-md-6 col-sm-6 col-12 mb-5">
			                  <div class="form-group d-lg-flex d-md-block">
			                    <label class="custom-control-label" for="asl-zoom_li"><?php echo esc_attr__('Clicked Zoom','asl_admin') ?></label>
			                    <div class="form-group-inner">
			                      <select  id="asl-zoom_li" name="data[zoom_li]" class="custom-select">
			                        <?php for($index = 2;$index <= 20;$index++):?>
			                        <option value="<?php echo $index ?>"><?php echo $index ?></option>
			                        <?php endfor; ?>
			                      </select>
			                      <p class="help-p"><?php echo esc_attr__('Zoom value when store list item is clicked','asl_admin') ?></p>
			                    </div>
			                  </div>
			                </div>
			                <div class="col-md-6 col-sm-6 col-12 mb-5">
			                  <div class="form-group d-lg-flex d-md-block">
			                    <label class="custom-control-label" for="asl-search_zoom"><?php echo esc_attr__('Search Zoom','asl_admin') ?></label>
			                    <div class="form-group-inner">
			                      <select  id="asl-search_zoom" name="data[search_zoom]" class="custom-select">
			                        <?php for($index = 2;$index <= 20;$index++):?>
			                        <option value="<?php echo $index ?>"><?php echo $index ?></option>
			                        <?php endfor; ?>
			                      </select>
			                      <p class="help-p"><?php echo esc_attr__('Zoom value when a search is performed','asl_admin') ?></p>
			                    </div>
			                  </div>
			                </div>
		              		<div class="col-md-6 col-sm-6 col-12 mb-5">
			                  <div class="form-group d-lg-flex d-md-block">
			                    <label class="custom-control-label"  for="asl-map_region"><?php echo esc_attr__('Map Region','asl_admin') ?></label>
			                    <div class="form-group-inner">
			                      <select  id="asl-map_region" name="data[map_region]" class="custom-select">
			                        <option value=""><?php echo esc_attr__('None','asl_admin') ?></option>
			                        <?php foreach($countries as $country): ?>
			                        <option value="<?php echo esc_attr($country->code) ?>"><?php echo esc_attr($country->country) ?></option>
			                        <?php endforeach ?>
			                      </select>
			                    </div>
			                  </div>
			                </div>
			                <div class="col-md-6 col-sm-6 col-12 mb-5">
			                  <div class="form-group d-lg-flex d-md-block">
			                    <label class="custom-control-label" for="asl-map_language"><?php echo esc_attr__('Map Language','asl_admin') ?></label>
			                    <div class="form-group-inner">
			                      <input type="text" class="form-control validate[minSize[2]]" maxlength="2" name="data[map_language]" id="asl-map_language" placeholder="Example: US">
			                      <p class="help-p"><?php echo esc_attr__('Enter the language code.','asl_admin') ?> <a href="https://agilestorelocator.com/wiki/display-maps-different-language/" target="_blank" rel="nofollow">Get Code</a></p>
			                    </div>
			                  </div>
			                </div>
		              		<div class="col-md-6 col-sm-6 col-12 mb-5">
			                  <div class="form-group d-lg-flex d-md-block">
			                    <label class="custom-control-label" for="asl-cluster"><?php echo esc_attr__('Cluster','asl_admin') ?></label>
			                    <div class="form-group-inner">
	                          <label class="switch" for="asl-cluster"><input type="checkbox" value="1" class="custom-control-input" name="data[cluster]" id="asl-cluster"><span class="slider round"></span></label>
	                          <p class="help-p"><?php echo esc_attr__('Count of markers will appear as clusters','asl_admin') ?> | <a href="https://agilestorelocator.com/wiki/store-locator-clusters/" target="_blank" rel="nofollow"><?php echo esc_attr__('Change Colors','asl_admin') ?></a></p>
	                        </div>
			                  </div>
			                </div>
			                <div class="col-md-6 col-sm-6 col-12 mb-5">
	                      <div class="form-group d-lg-flex d-md-block">
	                          <label class="custom-control-label" for="asl-scroll_wheel"><?php echo esc_attr__('Mouse Scroll','asl_admin') ?></label>
	                        	<div class="form-group-inner">
	                          	<label class="switch" for="asl-scroll_wheel"><input type="checkbox" value="1" class="custom-control-input" name="data[scroll_wheel]" id="asl-scroll_wheel"><span class="slider round"></span></label>
	                        	</div>
	                      </div>
                      </div>
                      <div class="col-md-6 col-sm-6 col-12 mb-5">
	                      <div class="form-group d-lg-flex d-md-block">
	                          <label class="custom-control-label" for="asl-radius_circle"><?php echo esc_attr__('Radius Circle','asl_admin') ?></label>
		                        <div class="form-group-inner">
		                          <label class="switch" for="asl-radius_circle"><input type="checkbox" value="1" class="custom-control-input" name="data[radius_circle]" id="asl-radius_circle"><span class="slider round"></span></label>
                              <p class="help-p"><?php echo esc_attr__('It only appear with dropdown control and overrides the search zoom value to fitbound','asl_admin') ?> | <a href="https://agilestorelocator.com/wiki/change-the-radius-color/" target="_blank" rel="nofollow"><?php echo esc_attr__('Radius Colors','asl_admin') ?></a></p>
		                        </div>
	                      </div>
                      </div>
                    </div>
                    <div class="row">
			          			<div class="col-md-12 form-group mb-3 map_layout">
										    <label class="custom-control-label" for="asl-map_layout"><?php echo esc_attr__('Map Layouts','asl_admin') ?></label>
										    <div class="row">
										    	<div class="col-md-6 a-radio-select">
											      <input type="radio" id="asl-map_layout-0" value="0" name="data[map_layout]"><label for="asl-map_layout-0"><span class="actv"></span><img src="<?php echo ASL_URL_PATH ?>admin/images/map/25-blue-water/25-blue-water.png" /></label>
											      <input type="radio" id="asl-map_layout-1" value="1" name="data[map_layout]"><label for="asl-map_layout-1"><span class="actv"></span><img src="<?php echo ASL_URL_PATH ?>admin/images/map/Flat Map/53-flat-map.png" /></label>
											      <input type="radio" id="asl-map_layout-2" value="2" name="data[map_layout]"><label for="asl-map_layout-2"><span class="actv"></span><img src="<?php echo ASL_URL_PATH ?>admin/images/map/Icy Blue/7-icy-blue.png" /></label>
											      <input type="radio" id="asl-map_layout-3" value="3" name="data[map_layout]"><label for="asl-map_layout-3"><span class="actv"></span><img src="<?php echo ASL_URL_PATH ?>admin/images/map/Pale Dawn/1-pale-dawn.png" /></label>
											      <input type="radio" id="asl-map_layout-4" value="4" name="data[map_layout]"><label for="asl-map_layout-4"><span class="actv"></span><img src="<?php echo ASL_URL_PATH ?>admin/images/map/cladme/6618-cladme.png" /></label>
											      <input type="radio" id="asl-map_layout-5" value="5" name="data[map_layout]"><label for="asl-map_layout-5"><span class="actv"></span><img src="<?php echo ASL_URL_PATH ?>admin/images/map/light monochrome/29-light-monochrome.png" /></label>
											      <input type="radio" id="asl-map_layout-6" value="6" name="data[map_layout]"><label for="asl-map_layout-6"><span class="actv"></span><img src="<?php echo ASL_URL_PATH ?>admin/images/map/mostly grayscale/4183-mostly-grayscale.png" /></label>
											      <input type="radio" id="asl-map_layout-7" value="7" name="data[map_layout]"><label for="asl-map_layout-7"><span class="actv"></span><img src="<?php echo ASL_URL_PATH ?>admin/images/map/turquoise water/8-turquoise-water.png" /></label>
											      <input type="radio" id="asl-map_layout-8" value="8" name="data[map_layout]"><label for="asl-map_layout-8"><span class="actv"></span><img src="<?php echo ASL_URL_PATH ?>admin/images/map/unsaturated browns/70-unsaturated-browns.png" /></label>
											      <input type="radio" id="asl-map_layout-9" value="9" name="data[map_layout]"><label for="asl-map_layout-9"><span class="actv"></span><span class="ml-custom"><b><?php echo esc_attr__('Custom','asl_admin') ?></b></span></label>
											    </div>
											    <div class="col-md-6 col-sm-6 col-12 mb-5">
					                  <div class="form-group d-lg-flex d-md-block">
					                    <label class="custom-control-label" for="asl-map_layout_custom"><?php echo esc_attr__('Map Custom','asl_admin') ?></label>
					                    <div class="form-group-inner">
					                      <textarea id="asl-map_layout_custom"  rows="6"  placeholder="<?php echo esc_attr__('Google Style','asl_admin') ?>"  class="input-medium form-control"><?php echo $custom_map_style ?></textarea>
                                <p class="help-p"><a target="_blank" href="https://agilestorelocator.com/wiki/disable-default-google-maps-locations/"><?php echo esc_attr__('How to create custom maps?','asl_admin') ?></a></p>
					                    </div>
					                  </div>
					                </div>
										    </div>
										  </div>
			          		</div>
		              </div>
		              <div id="sl-ui-tab" class="tab-pane">
		              	<div class="row mt-2">
		              		<div class="col-md-6 col-sm-6 col-12 mb-5">
			                  <div class="form-group d-lg-flex d-md-block">
			                    <label class="custom-control-label" for="asl-head_title"><?php echo esc_attr__('Header Title','asl_admin') ?></label>
			                    <div class="form-group-inner">
			                      <input  type="text" class="form-control validate[required]" name="data[head_title]" id="asl-head_title" placeholder="<?php echo esc_attr__('Head title','asl_admin') ?>">
			                    </div>
			                  </div>
			                </div>
			                <div class="col-md-6 col-sm-6 col-12 mb-5">
			                  <div class="form-group d-lg-flex d-md-block">
			                    <label class="custom-control-label" for="asl-category_title"><?php echo esc_attr__('Category Title','asl_admin') ?></label>
			                    <div class="form-group-inner">
			                      <input  type="text" class="form-control validate[required]" name="data[category_title]" id="asl-category_title" placeholder="<?php echo esc_attr__('Category title','asl_admin') ?>">
			                    </div>
			                  </div>
			                </div>
			                <div class="col-md-6 col-sm-6 col-12 mb-5">
			                  <div class="form-group d-lg-flex d-md-block">
			                    <label class="custom-control-label" for="asl-no_item_text"><?php echo esc_attr__('No Item Text','asl_admin') ?></label>
			                    <div class="form-group-inner">
			                      <input  type="text" class="form-control validate[required]" name="data[no_item_text]" id="asl-no_item_text" placeholder="<?php echo esc_attr__('No Item Text','asl_admin') ?>">
			                    </div>
			                  </div>
			                </div>
			                <div class="col-md-6 col-sm-6 col-12 mb-5">
			                  <div class="form-group d-lg-flex d-md-block">
			                    <label class="custom-control-label" for="asl-map_top"><?php echo esc_attr__('Map & List Order','asl_admin') ?></label>
			                    <div class="form-group-inner">
			                    <select  name="data[map_top]" id="asl-map_top" class="custom-select">
			                      <option value="0"><?php echo esc_attr__('List Top, Map Bottom','asl_admin') ?></option>
			                      <option value="2"><?php echo esc_attr__('Map Top, List Bottom','asl_admin') ?></option>
			                    </select>
			                    </div>
			                  </div>
			                </div>
			                <div class="col-md-6 col-sm-6 col-12 mb-5">
			                  <div class="form-group d-lg-flex d-md-block">
			                    <label class="custom-control-label" for="asl-full_height"><?php echo esc_attr__('Full Height','asl_admin') ?></label>
			                    <div class="form-group-inner">
			                      <select  name="data[full_height]" id="asl-full_height" class="custom-select">
			                        <option value=""><?php echo esc_attr__('None','asl_admin') ?></option>
			                        <option value="full-height"><?php echo esc_attr__('Full Height (Not Fixed)','asl_admin') ?></option>
			                        <option value="full-height asl-fixed"><?php echo esc_attr__('Full Height (Fixed)','asl_admin') ?></option>
			                      </select>
			                    </div>
			                  </div>
			                </div>
			                <div class="col-md-6 col-sm-6 col-12 mb-5">
	                      <div class="form-group d-lg-flex d-md-block">
	                          <label class="custom-control-label" for="asl-full_width"><?php echo esc_attr__('Full Width','asl_admin') ?></label>
		                        <div class="form-group-inner">
		                          <label class="switch" for="asl-full_width"><input type="checkbox" value="1" class="custom-control-input" name="data[full_width]" id="asl-full_width"><span class="slider round"></span></label>
	                        		<p class="help-p"><?php echo esc_attr__('Make the store locator full width 100% with respect to the parent container','asl_admin') ?></p>
		                        </div>
	                      </div>
                      </div>
                      <div class="col-md-6 col-sm-6 col-12 mb-5">
											  <div class="form-group d-lg-flex d-md-block">
											    <label class="custom-control-label" for="asl-tabs_layout"><?php echo esc_attr__('Tabs Layout','asl_admin') ?></label>
											    <div>
											      <div class="asl-wc-radio">
											        <label for="asl-tabs_layout-0"><input type="radio" name="data[tabs_layout]" value="0"  id="asl-tabs_layout-0"><?php echo esc_attr__('Dropdowns','asl_admin') ?></label>
											      </div>
											      <div class="asl-wc-radio">
											        <label for="asl-tabs_layout-1"><input type="radio" name="data[tabs_layout]" value="1"  id="asl-tabs_layout-1"><?php echo esc_attr__('Clickable Tabs','asl_admin') ?></label>
											      </div>
											      <p class="help-p"><?php echo esc_attr__('To show categories dropdown in tab options.','asl_admin') ?><span class="red">(Supported in Template 0 & 1)</span></p>
											    </div>
											  </div>
											</div>
                      <div class="col-md-6 col-sm-6 col-12 mb-5">
			                  <div class="form-group d-lg-flex d-md-block">
			                    <label class="custom-control-label" for="asl-additional_info"><?php echo esc_attr__('Description','asl_admin') ?></label>
			                    <div>
			                    	<div class="asl-wc-radio">
															<label for="asl-additional_info-0"><input type="radio" name="data[additional_info]" value="0"  id="asl-additional_info-0"><?php echo esc_attr__('Hide','asl_admin') ?></label>
														</div>
														<div class="asl-wc-radio">
															<label for="asl-additional_info-1"><input type="radio" name="data[additional_info]" value="1"  id="asl-additional_info-1"><?php echo esc_attr__('In Store List','asl_admin') ?></label>
														</div>
														<div class="asl-wc-radio">
															<label for="asl-additional_info-2"><input type="radio" name="data[additional_info]" value="2" id="asl-additional_info-2"><?php echo esc_attr__('In Modal via Link','asl_admin') ?></label>
														</div>
														<p class="help-p"><?php echo esc_attr__('To show the description text either in listing or modal.','asl_admin') ?></p>
                          </div>
			                  </div>
			                </div>
                      <div class="col-md-6 col-sm-6 col-12 mb-5">
			                  <div class="form-group d-lg-flex d-md-block">
			                    <label class="custom-control-label" for="week_hours"><?php echo esc_attr__('Hours Format','asl_admin') ?></label>
			                    <div>
														<div class="asl-wc-radio">
															<label for="asl-week_hours-0"><input type="radio" name="data[week_hours]" value="0"  id="asl-week_hours-0"><?php echo esc_attr__('Today','asl_admin') ?></label>
														</div>
														<div class="asl-wc-radio">
															<label for="asl-week_hours-1"><input type="radio" name="data[week_hours]" value="1" id="asl-week_hours-1"><?php echo esc_attr__('7 Days','asl_admin') ?></label>
														</div>
														<p class="help-p"><?php echo esc_attr__('To show only the current day hours or full week','asl_admin') ?></p>
                          </div>
			                  </div>
			                </div>
			                <div class="col-md-6 col-sm-6 col-12 mb-5">
			                  <div class="form-group d-lg-flex d-md-block">
			                    <label class="custom-control-label" for="asl-time_format"><?php echo esc_attr__('Time Format','asl_admin') ?></label>
			                    <div>
                             <div class="asl-wc-radio">
                                <label for="asl-time_format-0"><input type="radio" name="data[time_format]" value="0"  id="asl-time_format-0"><?php echo esc_attr__('12 Hours','asl_admin') ?></label>
                             </div>
                             <div class="asl-wc-radio">
                                <label for="asl-time_format-1"><input type="radio" name="data[time_format]" value="1" id="asl-time_format-1"><?php echo esc_attr__('24 Hours','asl_admin') ?></label>
                             </div>
                             <p class="help-p"><?php echo esc_attr__('Select either 12 or 24 hours time format','asl_admin') ?></p>
                          </div>
			                  </div>
			                </div>
			                 <div class="col-md-6 col-sm-6 col-12 mb-5">
			                  <div class="form-group d-lg-flex d-md-block">
			                    <label class="custom-control-label" for="asl-direction_btn"><?php echo esc_attr__('Direction Button','asl_admin') ?></label>
			                    <div class="form-group-inner">
	                            <label class="switch" for="asl-direction_btn"><input type="checkbox" value="1" class="custom-control-input" name="data[direction_btn]" id="asl-direction_btn"><span class="slider round"></span></label>
	                            <p class="help-p"><?php echo esc_attr__('Show/Hide direction button in the listing and infobox.','asl_admin') ?></p>
	                          </div>
			                  </div>
			                </div>
                      <div class="col-md-6 col-sm-6 col-12 mb-5">
	                      <div class="form-group d-lg-flex d-md-block">
	                          <label class="custom-control-label" for="asl-show_categories"><?php echo esc_attr__('Show Categories','asl_admin') ?></label>
	                          <div class="form-group-inner">
	                            <label class="switch" for="asl-show_categories"><input type="checkbox" value="1" class="custom-control-input" name="data[show_categories]" id="asl-show_categories"><span class="slider round"></span></label>
	                          </div>
	                      </div>
                      </div>
                      <div class="col-md-6 col-sm-6 col-12 mb-5">
	                      <div class="form-group d-lg-flex d-md-block">
	                          <label class="custom-control-label" for="asl-hide_hours"><?php echo esc_attr__('Hide Hours','asl_admin') ?></label>
	                          <div class="form-group-inner">
	                            <label class="switch" for="asl-hide_hours"><input type="checkbox" value="1" class="custom-control-input" name="data[hide_hours]" id="asl-hide_hours"><span class="slider round"></span></label>
	                          </div>
	                      </div>
                      </div>
                      <div class="col-md-6 col-sm-6 col-12 mb-5">
	                      <div class="form-group d-lg-flex d-md-block">
	                          <label class="custom-control-label" for="asl-slug_link"><?php echo esc_attr__('Website Link','asl_admin') ?></label>
	                          <div class="form-group-inner">
	                            <label class="switch" for="asl-slug_link"><input type="checkbox" value="1" class="custom-control-input" name="data[slug_link]" id="asl-slug_link"><span class="slider round"></span></label>
	                          </div>
	                      </div>
                      </div>
                      <div class="col-md-6 col-sm-6 col-12 mb-5">
	                      <div class="form-group d-lg-flex d-md-block">
	                          <label class="custom-control-label" for="asl-hide_logo"><?php echo esc_attr__('Hide Logo','asl_admin') ?></label>
	                          <div class="form-group-inner">
	                            <label class="switch" for="asl-hide_logo"><input type="checkbox" value="1" class="custom-control-input" name="data[hide_logo]" id="asl-hide_logo"><span class="slider round"></span></label>
	                          </div>
	                      </div>
                      </div>
                      <div class="col-md-6 col-sm-6 col-12 mb-5">
	                      <div class="form-group d-lg-flex d-md-block">
	                          <label class="custom-control-label" for="asl-print_btn"><?php echo esc_attr__('Print Button','asl_admin') ?></label>
		                        <div class="form-group-inner">
		                          <label class="switch" for="asl-print_btn"><input type="checkbox" value="1" class="custom-control-input" name="data[print_btn]" id="asl-print_btn"><span class="slider round"></span></label>
	                        		<p class="help-p"><a target="_blank" href="https://agilestorelocator.com/wiki/custom-print-header-for-store-list/"><?php echo esc_attr__('Add Print Header or remove it','asl_admin') ?></a></p>
		                        </div>
	                      </div>
                      </div>
		              		<div class="col-md-6 col-sm-6 col-12 mb-5">
			                  <div class="form-group d-lg-flex d-md-block">
			                    <label class="custom-control-label" for="asl-display_list"><?php echo esc_attr__('Display List','asl_admin') ?></label>
			                    <div class="form-group-inner">
	                          <label class="switch" for="asl-display_list"><input type="checkbox" value="1" class="custom-control-input" name="data[display_list]" id="asl-display_list"><span class="slider round"></span></label>
	                        </div>
			                  </div>
			                </div>
		              	</div>
		              	<div class="row mb-4">
			          			<div class="col-md-4">
			          					<div class="form-group">
			          							<label class="custom-control-label" for="asl-template"><?php echo esc_attr__('UI Templates','asl_admin') ?></label>
			                        <div class="input-group mb-3">
			                            <div class="input-group-prepend">
			                                <label class="input-group-text" for="asl-template"><?php echo esc_attr__('Template','asl_admin') ?></label>
			                            </div>
			                            <select id="asl-template" class="custom-select col-md-12" name="data[template]">
			                                <option value="0"><?php echo esc_attr__('Template','asl_admin') ?> 0</option>
			                                <option value="1"><?php echo esc_attr__('Template','asl_admin') ?> 1</option>
			                                <option value="2"><?php echo esc_attr__('Template','asl_admin') ?> 2</option>
			                                <option value="3"><?php echo esc_attr__('Template','asl_admin') ?> 3</option>
			                                <option value="list"><?php echo esc_attr__('Template','asl_admin') ?> List (BETA version)</option>
			                            </select>
			                        </div>
			                    </div>
			                    <div class="form-group layout-section">
			                      <div class="input-group mb-3">
			                          <div class="input-group-prepend">
			                            <label for="asl-layout" class="input-group-text"><?php echo esc_attr__('Layout','asl_admin') ?></label>
			                          </div>
			                          <select id="asl-layout" class="custom-select" name="data[layout]">
			                              <option value="0"><?php echo esc_attr__('List Format','asl_admin') ?></option>
			                              <option value="1"><?php echo esc_attr__('Accordion (States, Cities, Countries)','asl_admin') ?></option>
			                              <option value="2"><?php echo esc_attr__('Accordion (Categories)','asl_admin') ?></option>
			                          </select>
			                      </div>
			                    </div>
			                    <div class="form-group">
			                    	<div class="template-box box_layout_list box_layout_3 box_layout_0 hide">
													    <div class="form-group mb-3 color_scheme">
													      <label class="custom-control-label" for="asl-color_scheme"><?php echo esc_attr__('Color Schema','asl_admin') ?></label>
													      <div class="a-radio-select">
													        <?php for($_ind = 0; $_ind <= 9; $_ind++): ?>
													        <span>
													          <input type="radio" id="asl-color_scheme-<?php echo $_ind ?>" value="<?php echo $_ind ?>" name="data[color_scheme]">
													          <label class="color-box color-<?php echo $_ind ?>" for="asl-color_scheme-<?php echo $_ind ?>"></label>
													        </span>
													        <?php endfor; ?>
													      </div>
													    </div>
													  </div>
													  <div class="template-box box_layout_1 hide">
													    <div class="form-group mb-3 color_scheme layout_2">
													      <label class="custom-control-label" for="asl-color_scheme_1"><?php echo esc_attr__('Color Scheme','asl_admin') ?></label>
													      <div class="a-radio-select">
													        <?php for($_ind = 0; $_ind <= 9; $_ind++): ?>
													        <span>
													          <input type="radio" id="asl-color_scheme_1-<?php echo $_ind ?>" value="<?php echo $_ind ?>" name="data[color_scheme_1]">
													          <label class="color-box color-<?php echo $_ind ?>" for="asl-color_scheme_1-<?php echo $_ind ?>">
													          	<i class="actv"></i>
													            <span class="co_1"></span>
													            <span class="co_2"></span>
													          </label>
													        </span>
													        <?php endfor; ?>
													      </div>
													    </div>
													  </div>
													  <div class="template-box box_layout_2 hide">
													    <div class="form-group map_layout mb-3 color_scheme layout_2">
													      <label class="custom-control-label" for="asl-color_scheme"><?php echo esc_attr__('Color Scheme','asl_admin') ?></label>
													      <div class="a-radio-select">
													        <?php 
													        $tmpl_2_colors = array(
													          '0' => array('#CC3333', '#542733'),
													          '1' => array('#008FED', '#2580C3'),
													          '2' => array('#93628F', '#4A2849'),
													          '3' => array('#FF9800', '#FFC107'),
													          '4' => array('#01524B', '#75C9D3'),
													          '5' => array('#ED468B', '#FDCC29'),
													          '6' => array('#D55121', '#FB9C6C'),
													          '7' => array('#D13D94', '#AD0066'),
													          '8' => array('#99BE3B', '#01735A'),
													          '9' => array('#3D5B99', '#EFF1F6')
													        );
													        foreach($tmpl_2_colors as $_ct => $ctv):
													        ?>
													        <span>
													          <input type="radio" id="asl-color_scheme_2-<?php echo $_ct ?>" value="<?php echo $_ct ?>" name="data[color_scheme_2]">
													          <label class="color-box color-<?php echo $_ct ?>" for="asl-color_scheme_2-<?php echo $_ct ?>" style="background-color:<?php echo $ctv[0] ?>">
													          	<i class="actv"></i>
													            <span class="co_1"></span>
													          </label>
													        </span>
													      <?php endforeach; ?>
													      </div>
													    </div>
													  </div>
													  <div class="box_layout_0 box_layout_3 box_layout_list hide">
													  	<div class="form-group mb-3 Font_color">
														    <label class="custom-control-label" for="asl-font_color_scheme"><?php echo esc_attr__('Font Colors','asl_admin') ?></label>
														    <div class="a-radio-select">
														      <?php for($_ind = 0; $_ind <= 4; $_ind++): ?>
														      <span>
														        <input type="radio" id="asl-font_color_scheme-<?php echo $_ind ?>" value="<?php echo $_ind ?>" name="data[font_color_scheme]">
														        <label class="font-color-box color-<?php echo $_ind ?>" for="asl-font_color_scheme-<?php echo $_ind ?>"></label>
														      </span>
														      <?php endfor; ?>
														    </div>
														  </div>
													  </div>
			                    </div>
			                </div>
			                <div class="col-md-8 justify-content-md-center text-center">
			                  <div class="row">
			                  	<div class="col-12">
			                  		<figure class="figure">
			                    		<img  id="asl-tmpl-img" src="<?php echo ASL_URL_PATH ?>admin/images/asl-tmpl-0-0.png" alt="Thumbnail" class="figure-img img-fluid rounded">
			                    		<figcaption class="figure-caption text-center"><?php echo esc_attr__('Selected Store Locator','asl_admin') ?></figcaption>
			                  		</figure>
			                  	</div>
			                  	<div class="col-12">
			                  		<a href="<?php echo admin_url().'admin.php?page=sl-ui-customizer' ?>" class="btn btn-primary"><?php echo esc_attr__('UI Customizer','asl_admin') ?></a>
			                  	</div>
			                  </div>	
			                </div>
			          		</div>
			          		<div class="row">
			          			<div class="col-md-12 form-group mb-3 infobox_layout">
			          				<label class="custom-control-label" for="asl-infobox_layout"><?php echo esc_attr__('Infobox Layout','asl_admin') ?></label>
										    <div class="a-radio-select">
										      <input type="radio" id="asl-infobox_layout-0" value="0" name="data[infobox_layout]"><label for="asl-infobox_layout-0"><img src="<?php echo ASL_URL_PATH ?>/admin/images/infobox_1.png" /></label>
										      <input type="radio" id="asl-infobox_layout-2" value="2" name="data[infobox_layout]"><label for="asl-infobox_layout-2"><img src="<?php echo ASL_URL_PATH ?>/admin/images/infobox_2.png" /></label>
										      <input type="radio" id="asl-infobox_layout-1" value="1" name="data[infobox_layout]"><label for="asl-infobox_layout-1"><img src="<?php echo ASL_URL_PATH ?>/admin/images/infobox_3.png" /></label>
										    </div>
										  </div>
			          		</div>
		              </div>
		              <div id="sl-detail" class="tab-pane">
		              	<div class="row mt-2">
		              		<div class="col-md-6 col-sm-6 col-12 mb-5">
			                  <div class="form-group d-lg-flex d-md-block">
			                    <label class="custom-control-label" for="asl-link_type"><?php echo esc_attr__('Website Link Type','asl_admin') ?></label>
			                    <div>
                             	<div class="asl-wc-radio">
                                <label for="asl-link_type-0"><input type="radio" name="data[link_type]" value="0" id="asl-link_type-0"><?php echo esc_attr__('Website Field','asl_admin') ?></label>
                             	</div>
                             	<div class="asl-wc-radio">
                                <label for="asl-link_type-1"><input type="radio" name="data[link_type]" value="1" id="asl-link_type-1"><?php echo esc_attr__('Page Slug','asl_admin') ?></label>
                             	</div>
                             	<p class="help-p"><?php echo esc_attr__('Select the URL type of website link, page slug will only work when page slug is provided','asl_admin') ?></p>
                          </div>
			                  </div>
			                </div>
			                <div class="col-md-6 col-sm-6 col-12 mb-5">
			                  <div class="form-group d-lg-flex d-md-block">
			                    <label class="custom-control-label" for="asl-store_schema"><?php echo esc_attr__('Store JSON-LD','asl_admin') ?></label>
			                    <div class="form-group-inner">
	                          <label class="switch" for="asl-store_schema"><input type="checkbox" value="1" class="custom-control-input" name="data[store_schema]" id="asl-store_schema"><span class="slider round"></span></label>
	                          <p class="help-p"><?php echo esc_attr__('JSON schema data for Google SEO','asl_admin') ?></p>
	                        </div>
			                  </div>
			                </div>
		              		<div class="col-md-6 col-sm-6 col-12 mb-5">
			                  <div class="form-group d-lg-flex d-md-block">
			                    <label class="custom-control-label" for="asl-rewrite_slug"><?php echo esc_attr__('Store Page Slug','asl_admin') ?></label>
			                    <div class="form-group-inner">
			                      <div class="input-group">
			                      	<input  type="text" class="form-control" name="data[rewrite_slug]" id="asl-rewrite_slug" placeholder="<?php echo esc_attr__('stores','asl_admin') ?>">
			                      	<input  type="number" class="form-control" name="data[rewrite_id]"  id="asl-rewrite_id" placeholder="<?php echo esc_attr__('156','asl_admin') ?>">
			                      </div>
			                      <p class="help-p">
			                      	<?php echo esc_attr__('1- Provide the page relative URL and the WordPress Page id','asl_admin') ?><br>
															<?php echo esc_attr__('2- Add [ASL_STORE] on the same page','asl_admin') ?><br>
															3- <a href="/wp-admin/options-permalink.php"><?php echo esc_attr__('"Save Changes" Permalink','asl_admin') ?></a>
			                      </p>
			                    </div>
			                  </div>
			                </div>
		              	</div>
		              </div>
		              <div id="sl-register" class="tab-pane">
		              	<div class="row mt-2">
		              		<div class="col-md-6 col-sm-6 col-12 mb-5">
			                  <div class="form-group d-lg-flex d-md-block">
			                    <label class="custom-control-label" for="asl-notify_email"><?php echo esc_attr__('Notification Email','asl_admin') ?></label>
			                    <div class="form-group-inner">
			                      <input  type="text" class="form-control" name="data[notify_email]" id="asl-notify_email" placeholder="<?php echo esc_attr__('Email address','asl_admin') ?>">
			                      <p class="help-p"><?php echo esc_attr__('Email address to recieve the email notification for stores registered through frontend form.','asl_admin') ?> | <a target="_blank" class="text-muted" href="https://agilestorelocator.com/wiki/how-to-add-a-lead-form/"><?php echo esc_attr__('How to add lead form?','asl_admin') ?></a></p>
			                    </div>
			                  </div>
			                </div>
		              		<div class="col-md-6 col-sm-6 col-12 mb-5">
	                      <div class="form-group d-lg-flex d-md-block">
	                          <label class="custom-control-label" for="asl-admin_notify"><?php echo esc_attr__('Notification Status','asl_admin') ?></label>
		                        <div class="form-group-inner">
		                          <label class="switch" for="asl-admin_notify"><input type="checkbox" value="1" class="custom-control-input" name="data[admin_notify]" id="asl-admin_notify"><span class="slider round"></span></label>
	                        		<p class="help-p"><?php echo esc_attr__('Enable all kind of email alerts & notifications.','asl_admin') ?></p>
		                        </div>
	                      </div>
                      </div>
		              	</div>
		              </div>
  		            
  		            <div id="sl-customizer" class="tab-pane">
		              	<div class="row mt-2">
		              		<div class="col-12">
		              			<p class="alert alert-info" role="alert"><?php echo esc_attr__('Using this template customizer, the store list or the marker infobox content can be managed, select the right template and section to modify.','asl_admin') ?></p>
		              		</div>
		              		<div class="col-md-5">
		              			<div class="form-group">
		              				<div class="input-group mb-3">
		              					<div class="input-group-prepend">
		              						<label class="input-group-text" for="asl-customize-template"><?php echo esc_attr__('Template','asl_admin') ?></label>
		              					</div>
		              					<select id="asl-customize-template" class="custom-select col-md-12">
		              						<option value="template-0"><?php echo esc_attr__('Template','asl_admin') ?> 0</option>
		              						<option value="template-1"><?php echo esc_attr__('Template','asl_admin') ?> 1</option>
		              						<option value="template-2"><?php echo esc_attr__('Template','asl_admin') ?> 2</option>
		              						<option value="template-3"><?php echo esc_attr__('Template','asl_admin') ?> 3</option>
		              						<option value="template-list"><?php echo esc_attr__('Template list','asl_admin') ?></option>
		              					</select>
		              				</div>
		              			</div>
		              		</div>
		              		<div class="col-md-5">
		              			<div class="input-group mb-3">
	              					<div class="input-group-prepend">
	              						<label for="asl-customize-section" class="input-group-text"><?php echo esc_attr__('Section','asl_admin') ?></label>
	              					</div>
	              					<select id="asl-customize-section" class="custom-select">
	              						<option value="list"><?php echo esc_attr__('list','asl_admin') ?></option>
	              						<option value="infobox"><?php echo esc_attr__('infobox','asl_admin') ?></option>
	              					</select>
	              				</div>
		              		</div>
		              		<div class="col-md-12 mb-4">
		              			<div class="form-group">
		              				<button type="button" class="btn btn-primary mb-2 mr-3" data-loading-text="<?php echo esc_attr__('Loading...','asl_admin') ?>" data-completed-text="Loaded" id="btn-asl-load_ctemp"><?php echo esc_attr__('Load Template','asl_admin') ?></button>
		              				<button type="button" class="btn btn-success mb-2" data-loading-text="<?php echo esc_attr__('Saving...','asl_admin') ?>" data-completed-text="Template Updated" id="btn-asl-save_ctemp"><?php echo esc_attr__('Save Template','asl_admin') ?></button>
		              				<button type="button" class="btn btn-danger float-right" data-loading-text="<?php echo esc_attr__('Reseting...','asl_admin') ?>" data-completed-text="Reset Done" id="btn-asl-reset_ctemp"><?php echo esc_attr__('Reset Template','asl_admin') ?></button>
		              				<a href="<?php echo admin_url().'admin.php?page=sl-ui-customizer' ?>" class="btn btn-info float-right mr-3"><?php echo esc_attr__('Color & Fonts','asl_admin') ?></a>
		              				
		              			</div>
                      </div>
                      <div class="col-md-12 col-sm-12 col-12 mb-0">
		              			<div class="form-group layout-section">
		              				<label class="custom-control-label" for="sl-custom-template-textarea"><?php echo esc_attr__('Template Editor','asl_admin') ?></label>
		              				<div class="input-group-richtex sl-custom-tpl-text-section">
		              					<textarea id="sl-custom-template-textarea"></textarea>
		              				</div>
		              			</div>
                    	</div>
		              	</div>
		              </div>
			        </div>
	          		<div class="row">
	          			<div class="col-md-12">
	          				<button type="button" class="btn btn-success float-right" data-loading-text="<?php echo esc_attr__('Saving...','asl_admin') ?>" data-completed-text="Settings Updated" id="btn-asl-user_setting"><?php echo esc_attr__('Save Settings','asl_admin') ?></button>
	          			</div>
	          		</div>
          	</form>
			     </div>
			  </div>
			</div>
    </div>
    <div class="row">
    	<div class="col-md-12">
      	<div class="card p-0 mb-4">
					<h3 class="card-title"><?php echo esc_attr__('Manage JSON Cache','asl_admin') ?></h3>
	          <div class="card-body">
	          		<h3 class="alert alert-warning" style="width:100%;font-size: 14px"><span style="margin-right: 10px"><?php echo esc_attr__('Warning! JSON cache loading preloads all the data to serve it with great speed, but everytime you make any changes you have to hit the "Refresh Cache" button, if your JSON file is cached by browser or CDN such as cloudflare change the Query Parameter value.','asl_admin') ?> </span></h3>
	            	<div class="row">
	            		<div class="col-12">
	            			<form id="frm-asl-cache">
		            			<table class="table table-striped">
											  <thead class="thead-primary">
											    <tr>
											      <th scope="col">Lang</th>
											      <th scope="col">Cache</th>
											      <th scope="col">Version</th>
											    </tr>
											  </thead>
											  <tbody>
											  	<?php
											  	foreach ($active_langs as $lang): ?>
											    <tr>
											      <td><?php echo $lang ?></td>
											      <td>
											      	<div class="a-swith">
						                    <input value="1" <?php if(isset($cache_settings[$lang]) && $cache_settings[$lang] == '1') echo 'checked' ?> name="<?php echo esc_attr($lang) ?>" id="asl-fast-cache-<?php echo esc_attr($lang) ?>" data-lang="<?php echo esc_attr($lang) ?>" class="cmn-toggle cmn-toggle-round" type="checkbox">
						                    <label for="asl-fast-cache-<?php echo esc_attr($lang) ?>"></label>
							              	</div>
											      </td>
											      <td>
											      	<div class="form-group mb-0">
			            					  	<div class="input-group">
															    <input name="<?php echo esc_attr($lang) ?>-ver" value="<?php if(isset($cache_settings[$lang.'-ver'])) echo esc_attr($cache_settings[$lang.'-ver']); else echo '1'; ?>" id="asl-cache-ver-<?php echo esc_attr($lang) ?>" type="number" style="max-width: 200px;min-height: 34px;height: 34px;" class="form-control" placeholder="<?php echo esc_attr__('Query Parameter','asl_admin') ?>" aria-label="<?php echo esc_attr__('Query Parameter','asl_admin') ?>">
															    <div class="input-group-append">
															      <button  data-lang="<?php echo esc_attr($lang) ?>" type="button" data-loading-text="<?php echo esc_attr__('Refreshing...','asl_admin') ?>" class="btn btn-primary sl-refresh-cache"><?php echo esc_attr__('Refresh Cache','asl_admin') ?></button>
															    </div>
														  	</div>
			            					  </div>
											      </td>
											    </tr>
											  <?php endforeach; ?>
											  </tbody>
											</table>
										</form>
	            		</div>
	            	</div>
	        </div>
	      </div>
    	</div>
    </div>
		<div class="row asl-inner-cont">
      <div class="col-md-12">
      	<div class="card p-0 mb-4">
					<h3 class="card-title"><?php echo esc_attr__('Manage Additional Fields','asl_admin') ?></h3>
	          <div class="card-body">
	            	<div class="row">
	            		<div class="col-md-12">
	            			<p><?php echo esc_attr__('Additional fields for the store can be created through this section, new fields will appear in the store form and via CSV import.','asl_admin') ?> <?php echo esc_attr__('To show the additional fields on the template, please add the fields in the template as in this <a target="_blank" href="https://www.youtube.com/watch?v=WpPUMxlNX4M">Video Guide</a>.','asl_admin') ?></p>
										<p class="alert alert-info" role="alert"><?php echo esc_attr__(' <b>Control Name</b> must be small-case and without spacing, please use underscore sign (_) as the space separator, example: <b>facebook_url</b></p>','asl_admin') ?> </p>
	            			<form id="frm-asl-custom-fields">
											<div class="table-responsive">
					            	<table class="table table-bordered table-stripped asl-attr-manage">
					            		<thead>
					            			<tr>
					            				<th><?php echo esc_attr__('Label','asl_admin') ?></th>
					            				<th><?php echo esc_attr__('Control Name','asl_admin') ?></th>
					            				<th><?php echo esc_attr__('Action','asl_admin') ?></th>
					            			</tr>
					            		</thead>
												  <tbody>
												  	<?php 
												  	foreach($fields as $field): 

												  		$field_name  = strip_tags($field['name']);
                      				$field_label = strip_tags($field['label']);
												  		?>
															<tr>
		                            <td colspan="1"><div class="form-group"><input value="<?php echo esc_attr($field_label); ?>" type="text" class="asl-attr-label form-control validate[required,funcCall[ASLValidateLabel]]"></div></td>
		                            <td colspan="1"><div class="form-group"><input value="<?php echo esc_attr($field_name); ?>" type="text" class="asl-attr-name form-control validate[required,funcCall[ASLValidateName]]"></div></td>
		                            <td colspan="1">
		                              <span class="add-k-delete glyp-trash">
		                                <svg width="16" height="16"><use xlink:href="#i-trash"></use></svg>
		                              </span>
		                            </td>
		                          </tr>
												  	<?php endforeach; ?>
												  </tbody>
												</table>
											</div>
									</form>
									</div>
	            	</div>
								
								<div class="row">
	          			<div class="col-md-12">
	          				<button type="button" class="btn btn-dark mrg-r-10 mt-3 float-left" id="btn-asl-add-field"><i><svg width="13" height="13"><use xlink:href="#i-plus"></use></svg></i><?php echo esc_attr__('New Field','asl_admin') ?></button>
	          				<button type="button" class="btn btn-success mt-3 float-right" data-loading-text="<?php echo esc_attr__('Saving...','asl_admin') ?>" data-completed-text="Fields Updated" id="btn-asl-save-schema"><?php echo esc_attr__('Save Fields','asl_admin') ?></button>
	          			</div>
          			</div>
          		
	        </div>
	      </div>
    	</div>


      
      <div class="row asl-setting-cont">
	      <div class="col-md-12">
	        <div class="asl-seting-faq p-0 mb-4 mt-0">
	           <h3 class="card-title"><?php echo esc_attr__('FAQ & Help','asl_wc') ?></h3>
	           <div class="asl-seting-body">
	              <div class="alert border-0 alert-primary d-flex py-3 mb-4" role="alert">
	                 <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
	                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
	                 </svg>
	                 <p class="m-0"><?php echo esc_attr__('Create a support ticket by emailing us at ','asl_wc') ?> <a target="_blank" href="mailto:support@agilelogix.com" class="text-decoration-underline">support@agilelogix.com</a>, <?php echo esc_attr__('we will get back to you as soon as possible, please include ("Store Locator" in the Subject) to avoid the spam list.','asl_wc') ?></p>
	              </div>
	              <!-- Accordian -->
	              <div class="faqs-accordion" id="accordionfaqs">
	              	<?php foreach ($faq_basic as $key => $faq): ?>
	                 <div class="cards p-0">
	                    <div class="card-header py-3 px-2">
	                       <h2 class="mb-0 d-flex align-items-center">
	                          <span>0<?php echo $key + 1?></span>
	                          <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse-<?php echo $key ?>" aria-expanded="true" aria-controls="collapseOne">
	                          <?php echo $faq['q'] ?>
	                          </button>
	                       </h2>
	                    </div>
	                    <div id="collapse-<?php echo $key ?>" class="collapse" aria-labelledby="store-locator" data-parent="#accordionExample">
	                       <div class="card-body">
	                          <p><?php echo $faq['ans'] ?></p>
	                       </div>
	                    </div>
	                 </div>
	                <?php endforeach; ?>
	              </div>
	              <!-- Accordian -->
	              <!-- Videos Slider -->
	              <div class="asl-video-sec">
	                 <div class="top-title mt-5 mb-3 d-flex align-items-center justify-content-between">
	                    <b>FAQ Videos</b>
	                    <a target="_blank" href="https://www.youtube.com/channel/UCtr44_UG4DoxcEAhzWepYJw/videos" class="d-flex align-items-center">See All <span class="dashicons dashicons-arrow-right-alt"></span></a>
	                 </div>
	                 <div class="row">
	                    <div class="col-md-6">
	                       <a target="_blank" href="https://www.youtube.com/watch?v=CC0WMJcGpFM&amp;feature=emb_title" class="placeholder video">
	                      	<h4>How to add Google Maps API Keys into Store Locator WordPress Plugin</h4>
	                      </a>
	                    </div>
	                    <div class="col-md-6">
	                       <a target="_blank" href="https://www.youtube.com/watch?v=WpPUMxlNX4M&amp;feature=emb_title" class="placeholder video">
	                      	<h4>How to Customize the Store Locator WordPress Plugin</h4>
	                      </a>
	                    </div>
	                 </div>
	              </div>
	              <!-- Videos Slider -->
	              <!-- FAQ'S Links -->
	              <div class="asl-faq-link mt-5">
	                 <div class="top-title text-center">
	                    <b>FAQ Links</b>
	                 </div>
	                 <div class="row faq-slider">
	                 		<?php foreach ($faq_links as $key => $faq): ?>
	                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
	                       <a target="_blank" class="asl-faq-inner-box card" href="<?php echo $faq['link'] ?>">
	                          <div class="row align-items-center">
	                             <div class="col-9">
	                                <span class="link-title"><?php echo $faq['title'] ?></span>
	                             </div>
	                             <div class="col-3">
	                                <span class="dashicons dashicons-admin-links"></span>
	                             </div>
	                          </div>
	                       </a>
	                    </div>
	                    <?php endforeach; ?>
	                 </div>
	              </div>
	              <!-- FAQ'S Links -->
	              <div class="row">
	                 <div class="col-md-12">
	                    <div class="alert alert-light" role="alert">
	                       <p class="text-muted">If you have any problem with the plugin or suggestion, please email us at <a  href="mailto:support@agilelogix.com">support@agilelogix.com</a> We will respond as soon as possible to resolve your problem, please include ("Store Locator" in the Subject) to avoid the spam list.</p>
	                       <div class="d-flex align-items-center">
	                          <a target="_blank" href="https://codecanyon.net/item/agile-store-locator-google-maps-for-wordpress/reviews/16973546">If you like our Plugin, please rate us 5 stars.</a>
	                          <ul class="reviews-stars d-flex p-0 ml-2 mb-0">
	                             <li class="mb-0"><span class="dashicons dashicons-star-filled"></span></li>
	                             <li class="mb-0"><span class="dashicons dashicons-star-filled"></span></li>
	                             <li class="mb-0"><span class="dashicons dashicons-star-filled"></span></li>
	                             <li class="mb-0"><span class="dashicons dashicons-star-filled"></span></li>
	                             <li class="mb-0"><span class="dashicons dashicons-star-filled"></span></li>
	                          </ul>
	                       </div>
	                    </div>
	                 </div>
	              </div>
	              <div class="row">
	              	<div class="col-md-12 justify-content-md-center text-center">
	                  <a href="https://agilestorelocator.com/multi-stores-inventory-for-woocommerce/" target="_blank" class="figure">
	                    <img src="<?php echo ASL_URL_PATH ?>admin/images/asl-wc-addon.png" alt="Agile Stores Addons for WooCommerce" class="figure-img img-fluid rounded">
	                    <figcaption class="figure-caption text-center"><?php echo esc_attr__('Extension for WooCommerce','asl_admin') ?></figcaption>
	                  </a>
	                </div>
	              </div>
	           </div>
	        </div>
	     	</div>
     	</div>
    </div>
	</div>
</div>

<!-- SCRIPTS -->
<script type="text/javascript">
	var ASL_Instance = {
		url: '<?php echo ASL_UPLOAD_URL ?>',
		plugin_url: '<?php echo ASL_URL_PATH ?>'
	},
	asl_configs =  <?php echo json_encode($all_configs); ?>;
	window.addEventListener("load", function() {
	asl_engine.pages.user_setting(asl_configs);
	});
</script>