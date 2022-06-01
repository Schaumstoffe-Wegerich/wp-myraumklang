<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://agilestorelocator.com
 * @since      1.0.0
 *
 * @package    AgileStoreLocator
 * @subpackage AgileStoreLocator/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    AgileStoreLocator
 * @subpackage AgileStoreLocator/admin
 * @author     AgileStoreLocator Team <support@agilelogix.com>
 */
class AgileStoreLocator_Admin {

  /**
   * The ID of this plugin.
   *
   * @since    1.0.0
   * @access   private
   * @var      string    $AgileStoreLocator    The ID of this plugin.
   */
  private $AgileStoreLocator;

  /**
   * The version of this plugin.
   *
   * @since    1.0.0
   * @access   private
   * @var      string    $version    The current version of this plugin.
   */
  private $version;


  /**
   * [$scripts_data load the scripts]
   * @var array
   */
  private $scripts_data = array();

  private $max_img_width  = 450;
  private $max_img_height = 450;


  private $max_ico_width  = 75;
  private $max_ico_height = 75;


  private $max_image_size = 5000000;
  public $sub_upload_directory;


  private $attr_tables    = ['brands', 'specials'];

  private $lang = '';
  
  /**
   * Initialize the class and set its properties.
   *
   * @since    1.0.0
   * @param      string    $AgileStoreLocator       The name of this plugin.
   * @param      string    $version    The version of this plugin.
   */
  public function __construct( $AgileStoreLocator, $version ) {

    $this->AgileStoreLocator = $AgileStoreLocator;
    $this->version = time();
    $this->version = $version;

    //  Pretty URL for the Store Locator
    add_action('init', array($this,'rewrite_slug') );

    // Whitelist the Variable 
    add_filter( 'query_vars', array($this,'rewrite_query_vars') );


    //  lang query parameter, called by ServerCall AJAX method
    $this->lang = (isset($_REQUEST['lang']) && $_REQUEST['lang'])? esc_sql(sanitize_text_field($_REQUEST['lang'])): '';

    //  must be a valid lang code
    if(strlen($this->lang) >= 13 || $this->lang == 'en_US') {
      $this->lang = '';
    }
  }

  /**
   * Register the stylesheets for the admin area.
   *
   * @since    1.0.0
   */
  public function enqueue_styles() {

    /**
     * This function is provided for demonstration purposes only.
     *
     * An instance of this class should be passed to the run() function
     * defined in AgileStoreLocator_Loader as all of the hooks are defined
     * in that particular class.
     *
     * The AgileStoreLocator_Loader will then create the relationship
     * between the defined hooks and the functions defined in this
     * class.
     */

    wp_enqueue_style( $this->AgileStoreLocator, ASL_URL_PATH . 'admin/css/bootstrap.min.css', array(), $this->version, 'all' );//$this->version
    wp_enqueue_style( 'asl_chosen_plugin', ASL_URL_PATH . 'admin/css/chosen.min.css', array(), $this->version, 'all' );
    wp_enqueue_style( 'asl_admin', ASL_URL_PATH . 'admin/css/style.css', array(), $this->version, 'all' );
        
    //wp_enqueue_style( 'asl_datatable1', 'http://a.localhost.com/gull/src/assets/styles/vendor/datatables.min.css', array(), $this->version, 'all' );
    wp_enqueue_style( 'asl_datatable1', ASL_URL_PATH . 'admin/datatable/media/css/demo_page.css', array(), $this->version, 'all' );
    wp_enqueue_style( 'asl_datatable2', ASL_URL_PATH . 'admin/datatable/media/css/jquery.dataTables.css', array(), $this->version, 'all' );
  }

  /**
   * Register the JavaScript for the admin area.
   *
   * @since    1.0.0
   */
  public function enqueue_scripts() {

  }

  /**
   * [_enqueue_scripts a private enqueue scripts]
   * @return [type] [description]
   */
  public function _enqueue_scripts() {

    /**
     * This function is provided for demonstration purposes only.
     *
     * An instance of this class should be passed to the run() function
     * defined in AgileStoreLocator_Loader as all of the hooks are defined
     * in that particular class.
     *
     * The AgileStoreLocator_Loader will then create the relationship
     * between the defined hooks and the functions defined in this
     * class.
     */
    ///wp_enqueue_script( $this->AgileStoreLocator, ASL_URL_PATH . 'public/js/jquery-1.11.3.min.js', array( 'jquery' ), $this->version, false );
    wp_enqueue_script( $this->AgileStoreLocator.'-lib', ASL_URL_PATH . 'admin/js/libs.min.js', array('jquery'), $this->version, false );
    wp_enqueue_script( $this->AgileStoreLocator.'-choosen', ASL_URL_PATH . 'admin/js/chosen.proto.min.js', array('jquery'), $this->version, false );
    wp_enqueue_script( $this->AgileStoreLocator.'-datatable', ASL_URL_PATH . 'admin/datatable/media/js/jquery.dataTables.min.js', array('jquery'), $this->version, false );
    wp_enqueue_script( 'asl-bootstrap', ASL_URL_PATH . 'admin/js/bootstrap.min.js', array('jquery'), $this->version, false );
    wp_enqueue_script( $this->AgileStoreLocator.'-upload', ASL_URL_PATH . 'admin/js/jquery.fileupload.min.js', array('jquery'), $this->version, false );
    wp_enqueue_script( $this->AgileStoreLocator.'-jscript', ASL_URL_PATH . 'admin/js/jscript.js', array('jquery'), $this->version, false );
    wp_enqueue_script( $this->AgileStoreLocator.'-draw', ASL_URL_PATH . 'admin/js/drawing.js', array('jquery'), $this->version, false );


    $langs = array(
      'select_category'   => esc_attr__('Select Some Options','asl_admin'),
      'no_category'       => esc_attr__('Select Some Options','asl_admin'),
      'geocode_fail'      => esc_attr__('Geocode was not Successful:','asl_admin'),
      'upload_fail'       => esc_attr__('Upload Failed! Please try Again.','asl_admin'),
      'delete_category'   => esc_attr__('Delete Category','asl_admin'),
      'delete_categories' => esc_attr__('Delete Categories','asl_admin'),
      'warn_question'     => esc_attr__('Are you sure you want to ','asl_admin'),
      'delete_it'     => esc_attr__('Delete it!','asl_admin'),
      'duplicate_it'  => esc_attr__('Duplicate it!','asl_admin'),
      'backup_tmpl'   => esc_attr__('Backup Template','asl_admin'),
      'backup_tmpl_msg'   => esc_attr__('Are you sure to backup Template into theme root directory?','asl_admin'),
      'backup'            => esc_attr__('Backup','asl_admin'),
      'remove_tmpl'       => esc_attr__('Remove Template','asl_admin'),
      'remove_tmpl_msg'   => esc_attr__('Are you sure to remove Template from the theme root directory?','asl_admin'),
      'remove'          => esc_attr__('Remove','asl_admin'),
      'delete_marker'   => esc_attr__('Delete Marker','asl_admin'),
      'delete_markers'  => esc_attr__('Delete Markers','asl_admin'),
      'delete_logo'     => esc_attr__('Delete Logo','asl_admin'),
      'delete_logos'    => esc_attr__('Delete Selected Logos','asl_admin'),
      'select_special'  => esc_attr__('Select Special','asl_admin'),
      'select_brand'  => esc_attr__('Select Brand','asl_admin'),
      'delete_store'  => esc_attr__('Delete Store','asl_admin'),
      'delete_stores'  => esc_attr__('Delete Stores','asl_admin'),
      'duplicate_stores'  => esc_attr__('Duplicate Selected Store','asl_admin'),
      'start_time'        => esc_attr__('Start Time','asl_admin'),
      'select_logo'       => esc_attr__('Select Logo','asl_admin'),
      'select_marker'     => esc_attr__('Select Marker','asl_admin'),
      'end_time'          => esc_attr__('End Time','asl_admin'),
      'select_country'    => esc_attr__('Select Country','asl_admin'),
      'delete_all_stores' => esc_attr__('DELETE ALL STORES','asl_admin'),
      'truncate_stores'   => esc_attr__('Truncate Stores Table','asl_admin'),
      'truncate_stores_text'  => esc_attr__('Are you sure to delete all stores of all languages?','asl_admin'),
      'invalid_file_error'    => esc_attr__('Invalid File, Accepts JPG, PNG, GIF or SVG.','asl_admin'),
      'error_try_again'       => esc_attr__('Error Occured, Please try Again.','asl_admin'),
      'delete_all'            => esc_attr__('DELETE ALL','asl_admin'),
      'pur_title'             => esc_attr__('PLEASE VALIDATE PURCHASE CODE!','asl_admin'),
      'pur_text'              => esc_attr__('Thank you for purchasing <b>Store Locator for WordPress</b> Plugin, kindly enter your purchase code to unlock the page. <a target="_blank" href="https://agilestorelocator.com/wiki/store-locator-purchase-code/">How to Get Your Purchase Code</a>.','asl_admin'),
    );

    // Plugin Validation
    $this->localize_scripts( $this->AgileStoreLocator.'-jscript', 'ASL_REMOTE',  array('Com' => get_option('asl-compatible'),  'sl_lang' => $this->lang,  'LANG' => $langs, 'URL' => admin_url( 'admin-ajax.php' )));

    
    //  Inject script with inline_script
    wp_add_inline_script( $this->AgileStoreLocator.'-jscript', $this->get_local_script_data(), 'before');
  }

  /**
   * [fixURL Add https:// to the URL]
   * @param  [type] $url    [description]
   * @param  string $scheme [description]
   * @return [type]         [description]
   */
  private function fixURL($url, $scheme = 'http://') {

    if(!$url)
      return '';

    return parse_url($url, PHP_URL_SCHEME) === null ? $scheme . $url : $url;
  }

  /**
   * [pending_store_count Count the Pending Stores]
   * @return [type] [description]
   */
  private function pending_store_count() {

    global $wpdb;

    //  Get the Count of the Pendng Stores
    $pending_stores = $wpdb->get_results("SELECT COUNT(*) AS c FROM ".ASL_PREFIX."stores WHERE pending = 1");

    if($pending_stores && isset($pending_stores[0])) {

      $pending_stores = $pending_stores[0]->c;
    }
    else
      $pending_stores = 0;

    return $pending_stores;

  }



  /**
   * [_get_custom_fields Method to Get the Custom Fields]
   * @return [type] [description]
   */
  private function _get_custom_fields() {

    global $wpdb;
    
    //  Fields
    $fields = $wpdb->get_results("SELECT content FROM ".ASL_PREFIX."settings WHERE `type` = 'fields'");
    $fields = ($fields && isset($fields[0]))? json_decode($fields[0]->content, true): [];

    if(!empty($fields)) {

      //  Filter the JSON for XSS
      $filter_fields = [];

      foreach($fields as $field_key => $field) {

        $field_key = strip_tags($field_key);

        $field['type']  = strip_tags($field['type']);
        $field['name']  = strip_tags($field['name']);
        $field['label'] = strip_tags($field['label']);

        $filter_fields[$field_key] = $field;
      }

      $fields = $filter_fields;
    }

    return $fields;
  }

  
  /**
   * [import_assets Import Assets such as Logo, Icons, Markers]
   * @return [type] [description]
   */
  public function import_assets() {

    $response = new \stdclass();
    $response->success = false;


    //  Validate Admin?
    if(!current_user_can('administrator')) {

      $response->error = esc_attr__('Please login with Administrator Account.','asl_admin');
      echo json_encode($response);die;
    }

    $target_dir  = ASL_PLUGIN_PATH."public/export/";
    $target_file = 'assets_'.uniqid().'.zip';

    
    //  Move the File to the Import Folder
    if(move_uploaded_file($_FILES["files"]["tmp_name"], $target_dir.$target_file)) {

      $response->success = true;
      
      if(AgileStoreLocator_Helper::extract_assets($target_dir.$target_file)) {

        $response->msg = esc_attr__('Assets Imported Successfully.','asl_admin');
      }
      else
        $response->msg = esc_attr__('Failed to Imported Assets.','asl_admin');  
    }
    //error
    else {

      $response->error = esc_attr__('Error, file not moved, check permission.','asl_admin');
    }

    echo json_encode($response);die;
  }

  /**
   * [add_new_store POST METHODS for Add New Store]
   */
  public function add_new_store() {

    global $wpdb;

    $response  = new \stdclass();
    $response->success = false;

    $form_data     = stripslashes_deep($_REQUEST['data']);
    

    /*Make them STR :: Attributes*/   
    if(isset($form_data['brand']) && is_array($form_data['brand'])) {
      $form_data['brand'] = implode(',', $form_data['brand']);
    }

    if(isset($form_data['special']) && is_array($form_data['special'])) {
      $form_data['special'] = implode(',', $form_data['special']);
    }

    //  Generate Slug
    $form_data['slug']    = AgileStoreLocator_Helper::slugify($form_data);


    //  lang
    $form_data['lang']    = $this->lang;


    //  Custom Field
    $custom_fields        = (isset($_REQUEST['asl-custom']) && $_REQUEST['asl-custom'])? stripslashes_deep($_REQUEST['asl-custom']): null;
    $form_data['custom']  = ($custom_fields && is_array($custom_fields) && count($custom_fields) > 0)? json_encode($custom_fields): null;
    
    
    // Insert into stores table
    if($wpdb->insert( ASL_PREFIX.'stores', $form_data)) {

      $response->success = true;

      $store_id   = $wpdb->insert_id;
      $categories = (isset($_REQUEST['category']) && $_REQUEST['category'])? ($_REQUEST['category']): null;

      // Save Categories
      if($categories)
        foreach ($categories as $category) {

        $wpdb->insert(ASL_PREFIX.'stores_categories', 
          array(
            'store_id'    => $store_id,
            'category_id' => $category
          ),
          array('%s','%s')
        );
      }

      $response->msg = esc_attr__('Store added successfully.','asl_admin');
    }
    else {

      $wpdb->show_errors = true;

      $response->error = esc_attr__('Error occurred while saving Store','asl_admin');
      $response->msg   = $wpdb->print_error();
    }
    
    echo json_encode($response);die;  
  }

  /**
   * [update_store update Store]
   * @return [type] [description]
   */
  public function update_store() {

    global $wpdb;

    $response  = new \stdclass();
    $response->success = false;

    $form_data = stripslashes_deep($_REQUEST['data']);
    $update_id = isset($_REQUEST['updateid'])? intval($_REQUEST['updateid']) : 0;


    // Make them STR :: Attributes
    if(isset($form_data['brand']) && is_array($form_data['brand'])) {
      $form_data['brand'] = implode(',', ($form_data['brand']));
    }
    if(isset($form_data['special']) && is_array($form_data['special'])) {
      $form_data['special'] = implode(',', ($form_data['special']));
    }

    //  Custom Field
    $custom_fields        = (isset($_REQUEST['asl-custom']) && $_REQUEST['asl-custom'])? stripslashes_deep($_REQUEST['asl-custom']): null;
    $form_data['custom']  = ($custom_fields && is_array($custom_fields) && count($custom_fields) > 0)? json_encode($custom_fields): null;
    
    //  Generate Slug
    $form_data['slug']  = AgileStoreLocator_Helper::slugify($form_data);

    
    //  When Update Id is there
    if($update_id && is_numeric($update_id)) {
      
      //  Update into stores table
      $wpdb->update(ASL_PREFIX."stores",
        array(
          'title'         => $form_data['title'],
          'description'   => $form_data['description'],
          'phone'         => $form_data['phone'],
          'fax'           => $form_data['fax'],
          'email'         => $form_data['email'],
          'street'        => $form_data['street'],
          'postal_code'   => $form_data['postal_code'],
          'city'          => $form_data['city'],
          'state'         => $form_data['state'],
          'lat'           => $form_data['lat'],
          'lng'           => $form_data['lng'],
          'website'       => $this->fixURL($form_data['website']),
          'country'       => $form_data['country'],
          'is_disabled'   => (isset($form_data['is_disabled']) && $form_data['is_disabled'])?'1':'0',
          'description_2' => $form_data['description_2'],
          'logo_id'     => $form_data['logo_id'],
          'marker_id'   => $form_data['marker_id'],
          'brand'       => isset($form_data['brand'])?$form_data['brand']:'',
          'special'     => isset($form_data['special'])?$form_data['special']:'',
          'slug'        => $form_data['slug'],
          'custom'      => $form_data['custom'],
          'logo_id'   => $form_data['logo_id'],
          'open_hours'  => $form_data['open_hours'],
          'ordr'      => $form_data['ordr'],
          'updated_on'  => date('Y-m-d H:i:s')
        ),
        array('id' => $update_id)
      );

      
      $sql = "DELETE FROM ".ASL_PREFIX."stores_categories WHERE store_id = ".$update_id;
      $wpdb->query($sql);

      $categories = (isset($_REQUEST['category']) && $_REQUEST['category'])? ($_REQUEST['category']): null;

      // Save Categories
      if($categories)
        foreach ($categories as $category) {

        $wpdb->insert(ASL_PREFIX.'stores_categories', 
          array(
            'store_id'    => $update_id,
            'category_id' => $category
          ),
          array('%s','%s'));  
      }
      
      
      $response->msg      = esc_attr__('Store updated successfully.','asl_admin');
      $response->success  = true;
    }
    else {

      $response->msg      = esc_attr__('Error! Update id not found.','asl_admin');
    }


    echo json_encode($response);die;
  }


  /**
   * [delete_store To delete the store/stores]
   * @return [type] [description]
   */
  public function delete_store() {

    global $wpdb;

    $response  = new \stdclass();
    $response->success = false;

    $multiple = isset($_REQUEST['multiple'])? $_REQUEST['multiple']: null;
    
    $delete_sql;

    //  For Multiple rows
    if($multiple) {

      $item_ids      = implode(",", array_map( 'intval', $_POST['item_ids'] ));
      $delete_sql    = "DELETE FROM ".ASL_PREFIX."stores WHERE id IN (".$item_ids.")";
    }
    else {

      $store_id      = intval($_REQUEST['store_id']);
      $delete_sql    = "DELETE FROM ".ASL_PREFIX."stores WHERE id = ".$store_id;
    }

    //  Delete Store?
    if($wpdb->query($delete_sql)) {

      $response->success = true;
      $response->msg = ($multiple)?__('Stores deleted successfully.','asl_admin'):esc_attr__('Store deleted successfully.','asl_admin');
    }
    else {
      $response->error = esc_attr__('Error occurred while saving record','asl_admin');//$form_data
      $response->msg   = $wpdb->show_errors();
    }
    
    echo json_encode($response);die;
  }


  /**
   * [store_status To Change the Status of Store]
   * @return [type] [description]
   */
  public function store_status() {

    global $wpdb;

    $response  = new \stdclass();
    $response->success = false;

    $status = (isset($_REQUEST['status']) && $_REQUEST['status'] == '1')?'0':'1';
    
    $status_title  = ($status == '1')? esc_attr__('Disabled','asl_admin'): esc_attr__('Enabled','asl_admin'); 
    $delete_sql;

    $item_ids      = implode(",", array_map( 'intval', $_POST['item_ids'] ));
    $update_sql    = "UPDATE ".ASL_PREFIX."stores SET is_disabled = {$status} WHERE id IN (".$item_ids.")";

    if($wpdb->query($update_sql)) {

      $response->success  = true;
      $response->msg      = esc_attr__('Selected Stores','asl_admin').' '.$status_title;
    }
    else {
      $response->error = esc_attr__('Error occurred while Changing Status','asl_admin');
      $response->msg   = $wpdb->show_errors();
    }
    
    echo json_encode($response);die;
  }

  /**
   * [approve_stores Approve Stores]
   * @return [type] [description]
   */
  public function approve_stores() {

    global $wpdb;

    $response          = new \stdclass();
    $response->success = false;

    // Get the API Key
    $sql = "SELECT `key`,`value` FROM ".ASL_PREFIX."configs WHERE `key` = 'server_key'";
    $configs_result = $wpdb->get_results($sql);
    $api_key    = $configs_result[0]->value;


    //  Get the Store
    $sql_stmt      = "SELECT * FROM ".ASL_PREFIX."stores WHERE";
    $store_id      = intval($_REQUEST['store_id']);
    $sql_stmt     .= " id = ".$store_id;

    $pending_stores  = $wpdb->get_results($sql_stmt);

    $approve_counter = 0;

    //  Validator
    $has_approved = false;

    //  Loop over the approve and fetch the coordinates
    foreach ($pending_stores as $store) {
      
      $is_valid    = AgileStoreLocator_Helper::validate_coordinate($store->lat, $store->lng);

      //  Validate the API
      if(!$is_valid && !$api_key) {
        echo json_encode(['msg' => esc_attr__('Google Server API key is missing.','asl_admin'), 'success' => false]);die;
      }

      $coordinates = ($is_valid)? ['lat' => $store->lat, 'lng' => $store->lng]: AgileStoreLocator_Helper::getCoordinates($store->street, $store->city, $store->state, $store->postal_code, $store->country, $api_key);

      if($coordinates) {

        if($wpdb->update( ASL_PREFIX.'stores', array('pending' => null, 'lat' => $coordinates['lat'], 'lng' => $coordinates['lng']), array('id'=> $store->id ))){

          $has_approved = true;
        }
      }
      //  Failed for the coordinates
      else {

        $response->error = esc_attr__('Error! Failed to validate for the coordinates by the Google API, validate the Server API key.','asl_admin');
      }
    }

    //  Serve the results
    if($has_approved) {

      $response->pending_count = $this->pending_store_count();

      $response->success = true;
      $response->msg     = esc_attr__('Success! Store is approved and registered into the listing.','asl_admin');
    }
    else if (!$response->error) {
      $response->error = esc_attr__('Error occurred while approving the records','asl_admin');//$form_data
    }
    
    echo json_encode($response);die;
  }

  /**
   * [remove_duplicates Remove all the duplicate rows]
   * @return [type] [description]
   */
  public function remove_duplicates() {

    global $wpdb;

    $response           = new \stdclass();
    $response->success  = false;

    $asl_prefix   = ASL_PREFIX; 

    $remove_query = "DELETE s1 FROM {$asl_prefix}stores s1
                    INNER JOIN {$asl_prefix}stores s2 
                    WHERE s1.id < s2.id AND s1.title = s2.title AND s1.lat = s2.lat AND s1.lng = s2.lng;";

    //  All Count
    $all_count   = $wpdb->get_results("SELECT COUNT(*) AS c FROM ".ASL_PREFIX."stores");

    //  Previous count
    $all_count   = $all_count[0];

    //  Remove the duplicates
    if($wpdb->query($remove_query)) {
      
      //  All Count
      $new_count     = $wpdb->get_results("SELECT COUNT(*) AS c FROM ".ASL_PREFIX."stores");

      //  Previous count
      $new_count     = $new_count[0];

      $removed       = $all_count->c - $new_count->c;

      $response->msg = $removed.' '.esc_attr__('Duplicate stores removed','asl_admin');

      $response->success = true;
    }
    else {
     
      $response->error = esc_attr__('No Duplicate deleted!','asl_admin');//$form_data
      $response->msg   = $wpdb->show_errors();
    }


    echo json_encode($response);die;
  }
  
  /**
   * [duplicate_store to  Duplicate the store]
   * @return [type] [description]
   */
  public function duplicate_store() {

    global $wpdb;

    $response  = new \stdclass();
    $response->success = false;

    $store_id = isset($_REQUEST['store_id'])? intval($_REQUEST['store_id']): 0;


    $result = $wpdb->get_results("SELECT * FROM ".ASL_PREFIX."stores WHERE id = ".$store_id);   

    if($result && $result[0]) {

      $result = (array)$result[0];

      unset($result['id']);
      unset($result['created_on']);
      unset($result['updated_on']);

      //insert into stores table
      if($wpdb->insert( ASL_PREFIX.'stores', $result)){
        $response->success = true;
        $new_store_id = $wpdb->insert_id;

        //get categories and copy them
        $s_categories = $wpdb->get_results("SELECT * FROM ".ASL_PREFIX."stores_categories WHERE store_id = ".$store_id);

        /*Save Categories*/
        foreach ($s_categories as $_category) { 

          $wpdb->insert(ASL_PREFIX.'stores_categories', 
            array('store_id'=>$new_store_id,'category_id'=>$_category->category_id),
            array('%s','%s'));      
        }

        
        //SEnd the response
        $response->msg = esc_attr__('Store duplicated successfully.','asl_admin');
      }
      else
      {
        $response->error = esc_attr__('Error occurred while saving Store','asl_admin');//$form_data
        $response->msg   = $wpdb->show_errors();
      } 

    }

    echo json_encode($response);die;
  }


  /**
   * [backup_template Backup the Template into theme Root Directory]
   * @return [type] [description]
   */
  public function backup_template() {

    $template  = isset($_REQUEST['template'])? sanitize_text_field($_REQUEST['template']): null;
    $response  = AgileStoreLocator_Helper::backup_template($template);

    echo json_encode($response);die;
  }


  /**
   * [remove_template Remove the template file from the Theme Directory]
   * @return [type] [description]
   */
  public function remove_template() {

    $template  = isset($_REQUEST['template'])? sanitize_text_field($_REQUEST['template']): null;
    $response  = AgileStoreLocator_Helper::remove_template($template);

    echo json_encode($response);die;
  }


  /**
   * [migrate_assets Migrate the Assets from the Older versions to the newer]
   * @return [type] [description]
   */
  public function migrate_assets() {

    $is_valid  = AgileStoreLocator_Helper::migrate_assets();


    $message   = ($is_valid)? esc_attr__('Assets moved successfully.'): esc_attr__('No assets to migrate.');

    echo json_encode(['msg' => $message, 'success' => $is_valid]);die;
  }


  /**
   * [validate_coordinates Validate that all the coordinates are Valid]
   * @return [type] [description]
   */
  public function validate_coordinates() {

    global $wpdb;

    $response  = new \stdclass();
    $response->success = false; 

    //  initial message
    $message = 'Success! All coordinates looks correct values';

    //  get the stores
    $invalid_stores = $wpdb->get_results("SELECT id FROM ".ASL_PREFIX."stores WHERE (lat = '' AND lng = '') OR (lat IS NULL AND lng IS NULL) OR !(lat BETWEEN -90.10 AND 90.10) OR !(lng BETWEEN -180.10 AND 180.10) OR !(lat REGEXP '^[+-]?[0-9]*([0-9]\\.|[0-9]|\\.[0-9])[0-9]*(e[+-]?[0-9]+)?$') OR !(lng REGEXP '^[+-]?[0-9]*([0-9]\\.|[0-9]|\\.[0-9])[0-9]*(e[+-]?[0-9]+)?$')");

    //  Validate the Count difference
    if($invalid_stores) {

      $coord_with_err = count($invalid_stores);

      //  When less than 10, show the numbers
      if($coord_with_err < 10) {

        //  get the store IDs
        $store_ids = array_map(function($value) { return $value->id;}, $invalid_stores);

        $store_ids = implode(',', $store_ids);

        $coord_with_err .= ' ('.$store_ids.')';
      }

      //  prepare the message
      if($coord_with_err)
        $message = "Error! Wrong coordinates of {$coord_with_err} stores";
    }

    // Check the Default Coordinates
    $sql = "SELECT `key`,`value` FROM ".ASL_PREFIX."configs WHERE `key` = 'default_lat' || `key` = 'default_lng'";
    $all_configs_result = $wpdb->get_results($sql);


    $all_configs = array();

    foreach($all_configs_result as $c) {
      $all_configs[$c->key] = $c->value;
    }

    $is_valid  = AgileStoreLocator_Helper::validate_coordinate($all_configs['default_lat'], $all_configs['default_lng']);

    //  Default Lat/Lng are invalid
    if(!$is_valid) {

      $message .= '<br>Default Lat & Default Lng values are invalid!';
    }

    //  All Passed
    if(!$invalid_stores && $is_valid) {

      $response->success = true;
    }


    $response->msg = $message;
    

    echo json_encode($response);die;
  }

  //////////////////
  //////ATTRIBUTE //
  //////////////////
  
  /**
   * [add_attribute description]
   */
  public function add_attribute() {

    global $wpdb;

    $response = new \stdclass();
    $response->success = false;

    $table  = isset( $_REQUEST['name'])?  sanitize_text_field($_REQUEST['name']):null;
    $title  = isset( $_REQUEST['title'])? sanitize_text_field($_REQUEST['title']):null;
    $value  = isset( $_REQUEST['value'])? sanitize_text_field($_REQUEST['value']):null;
    $ordr   = isset( $_REQUEST['ordr']) && is_numeric($_REQUEST['ordr'])? $_REQUEST['ordr']:0;

    //  Filter the Table Name
    $table = (in_array($table, $this->attr_tables))? $table: $this->attr_tables[0];
    
    $value = stripslashes($value);
    
    if($value && $wpdb->insert(ASL_PREFIX.$table, array('name' => $value, 'ordr' => $ordr, 'lang' => $this->lang))) {

      $response->msg     = $title.esc_attr__(" added successfully",'asl_admin');
      $response->success = true;
    }
    else {

      $response->msg = esc_attr__('Error occurred while saving record','asl_admin');
    }
          
    echo json_encode($response);
    die;
  }

  /**
   * [update_attribute description]
   * @return [type] [description]
   */
  public function update_attribute() {

    global $wpdb;

    $response = new \stdclass();
    $response->success = false;

    $table  = isset( $_REQUEST['name'])?sanitize_text_field($_REQUEST['name']):null;
    $title  = isset( $_REQUEST['title'])?sanitize_text_field($_REQUEST['title']):null;
    $value  = isset( $_REQUEST['value'])?sanitize_text_field($_REQUEST['value']):null;
    $at_id  = isset( $_REQUEST['id'])?sanitize_text_field($_REQUEST['id']):null;
    $ordr   = isset( $_REQUEST['ordr']) && is_numeric($_REQUEST['ordr'])?sanitize_text_field($_REQUEST['ordr']):0;
    

    //  Filter the Table Name
    $table = (in_array($table, $this->attr_tables))? $table: $this->attr_tables[0];

    $value = stripslashes($value);

    if($at_id & $value && $wpdb->update(ASL_PREFIX.$table, array('name' => $value, 'ordr' => $ordr), array('id' => $at_id)))
    {
      $response->msg     = $title." ".esc_attr__("Updated Successfully",'asl_admin');
      $response->success = true;
    }
    else {
      $response->msg = esc_attr__('Error occurred while saving record','asl_admin');
    }
          
  

    echo json_encode($response);
    die;
  }

  /**
   * [get_attributes Get the Attribute]
   * @return [type] [description]
   */
  public function get_attributes() {

    global $wpdb;
    $start    = isset( $_REQUEST['iDisplayStart'])?sanitize_text_field($_REQUEST['iDisplayStart']):0;
    $table    = isset( $_REQUEST['type'])?sanitize_text_field($_REQUEST['type']):null;
    $params   = isset($_REQUEST)?$_REQUEST:null;

    if(!$table) {
      return;
    }

    //  Filter the Table Name
    $table = (in_array($table, $this->attr_tables))? $table: $this->attr_tables[0];



    $acolumns = array(
      'id','id','name', 'ordr', 'created_on'
    );

    $columnsFull = $acolumns;

    $clause = array();

    if(isset($_REQUEST['filter'])) {

      foreach($_REQUEST['filter'] as $key => $value) {

        if($value != '') {

          $value    = sanitize_text_field($value);
          $key      = sanitize_text_field($key);

          $clause[] = "$key like '%{$value}%'";
        }
      } 
    } 
    
    //  Add the lang Filter
    $clause[] = "lang = '{$this->lang}'";

    //iDisplayStart::Limit per page
    $sLimit = "";
    if ( isset( $_REQUEST['iDisplayStart'] ) && $_REQUEST['iDisplayLength'] != '-1' )
    {
      $sLimit = "LIMIT ".intval( $_REQUEST['iDisplayStart'] ).", ".
        intval( $_REQUEST['iDisplayLength'] );
    }

    /*
     * Ordering
     */
    $sOrder = "";
    if ( isset( $_REQUEST['iSortCol_0'] ) )
    {
      $sOrder = "ORDER BY  ";

      for ( $i=0 ; $i < intval( $_REQUEST['iSortingCols'] ) ; $i++ )
      {
        if (isset($_REQUEST['iSortCol_'.$i]))
        {
          $sort_dir = (isset($_REQUEST['sSortDir_0']) && $_REQUEST['sSortDir_0'] == 'asc')? 'ASC': 'DESC';
          $sOrder .= "`".$acolumns[ intval( $_REQUEST['iSortCol_'.$i] )  ]."` ".$sort_dir;
          break;
        }
      }
      

      //$sOrder = substr_replace( $sOrder, "", -2 );
      if ( $sOrder == "ORDER BY" )
      {
        $sOrder = "";
      }
    }


    $sWhere = implode(' AND ',$clause);
    
    if($sWhere != '')$sWhere = ' WHERE '.$sWhere;
    
    $fields = implode(',', $columnsFull);
    
    ###get the fields###
    $sql =  "SELECT $fields FROM ".ASL_PREFIX.$table;

    $sqlCount = "SELECT count(*) 'count' FROM ".ASL_PREFIX.$table;

    /*
     * SQL queries
     * Get data to display
     */
    $sQuery = "{$sql} {$sWhere} {$sOrder} {$sLimit}";
    $data_output = $wpdb->get_results($sQuery);


    //  Call the activator when error is received
    if(!$data_output) {

      $err_message = isset($wpdb->last_error)? $wpdb->last_error: null;

      if($err_message) {

        //  Run the script to add missing tables
        require_once ASL_PLUGIN_PATH . 'includes/class-agile-store-locator-activator.php';
        AgileStoreLocator_Activator::activate();
      }
    }


    
    /* Data set length after filtering */
    $sQuery = "{$sqlCount} {$sWhere}";
    $r = $wpdb->get_results($sQuery);
    $iFilteredTotal = $r[0]->count;
    
    $iTotal = $iFilteredTotal;

   /*
     * Output
     */
    $sEcho = isset($_REQUEST['sEcho'])?intval($_REQUEST['sEcho']):1;
    $output = array(
      "sEcho" => intval($_REQUEST['sEcho']),
      //"test" => $test,
      "iTotalRecords" => $iTotal,
      "iTotalDisplayRecords" => $iFilteredTotal,
      "aaData" => array()
    );
    
    foreach($data_output as $aRow)
    {
      $row = $aRow;

      $row->action = '<div class="edit-options"><a data-ordr="'.$row->ordr.'"  data-value="'.$row->name.'" data-id="'.$row->id.'" title="Edit" class="edit_attr"><svg width="14" height="14"><use xlink:href="#i-edit"></use></svg></a><a title="Delete" data-id="'.$row->id.'" class="delete_attr g-trash"><svg width="14" height="14"><use xlink:href="#i-trash"></use></svg></a></div>';
      $row->check  = '<div class="custom-control custom-checkbox"><input type="checkbox" data-id="'.$row->id.'" class="custom-control-input" id="asl-chk-'.$row->id.'"><label class="custom-control-label" for="asl-chk-'.$row->id.'"></label></div>';
      $output['aaData'][] = $row;
    }

    echo json_encode($output);die;
  }

  /**
   * [admin_manage_brands Manage Attribute Page]
   * @return [type] [description]
   */
  public function admin_manage_attribute() {

    // add scripts
    $this->_enqueue_scripts();

    include ASL_PLUGIN_PATH.'admin/partials/attribute.php';
  }

  /**
   * [admin_manage_specials Manage Attribute Page]
   * @return [type] [description]
   */
  public function admin_manage_specials() {

    // add scripts
    $this->_enqueue_scripts();

    include ASL_PLUGIN_PATH.'admin/partials/attribute_special.php';
  }


  /**
   * [delete_attribute Delete Attribute]
   * @return [type] [description]
   */
  public function delete_attribute() {

    global $wpdb;

    $response  = new \stdclass();
    $response->success = false;

    $table  = isset( $_REQUEST['name'])?  sanitize_text_field($_REQUEST['name']):null;
    $title  = isset( $_REQUEST['title'])? sanitize_text_field($_REQUEST['title']):null;
    $value  = isset( $_REQUEST['value'])? sanitize_text_field($_REQUEST['value']):null;

    $multiple = isset($_REQUEST['multiple'])? $_REQUEST['multiple']: null;
    $delete_sql;
    $cResults;

    //  To filter the table name
    $table = (in_array($table, $this->attr_tables))? $table: $this->attr_tables[0];

    if($multiple) {

      //  Clean it
      $item_ids      = implode(",", array_map( 'intval', $_POST['item_ids'] ));

      $delete_sql    = "DELETE FROM ".ASL_PREFIX.$table." WHERE id IN (".$item_ids.")";
      $cResults      = $wpdb->get_results("SELECT * FROM ".ASL_PREFIX.$table." WHERE id IN (".$item_ids.")");
    }
    else {

      $category_id   = intval($_REQUEST['category_id']);

      $delete_sql    = "DELETE FROM ".ASL_PREFIX.$table." WHERE id = ".$category_id;
      $cResults      = $wpdb->get_results("SELECT * FROM ".ASL_PREFIX.$table." WHERE id = ".$category_id );
    }


    if(count($cResults) != 0) {
      
      if($wpdb->query($delete_sql))
      {
          $response->success = true;
      }
      else
      {
        $response->error = esc_attr__('Error occurred while deleting record','asl_admin');
        $response->msg   = $wpdb->show_errors();
      }
    }
    else
    {
      $response->error = esc_attr__('Error occurred while deleting record','asl_admin');
    }

    if($response->success)
      $response->msg = $title." ".esc_attr__("deleted successfully",'asl_admin');
    
    echo json_encode($response);die;
  }
  

  ////////////////////////////////
  /////////ALL Category Methods //
  ////////////////////////////////
  
  /**
   * [add_category Add Category Method]
   */
  public function add_category() {

    global $wpdb;

    $response = new \stdclass();
    $response->success = false;

    //  Forms Data
    $form_data = stripslashes_deep($_REQUEST['data']);

    //  The Order ID
    $order_id  = (isset($form_data['ordr']) && is_numeric($form_data['ordr']))? $form_data['ordr']: '0';

    //  Parameters to Save
    $data_params = array(
      'category_name' => $form_data['category_name'],
      'ordr'          => $order_id
    );

    //  lang
    $data_params['lang']    = $this->lang;


    //  Upload the Category Icon File
    $upload_result  = $this->_file_uploader($_FILES["files"], 'svg');

    //  Validate the Upload Success
    if(isset($upload_result['success']) && $upload_result['success']) {

      $file_name    = $upload_result['file_name'];

      //  Add the newly uploaded file
      $data_params['icon'] = $file_name;
    }
    else {

      $response->msg      = ($upload_result['error'])? $upload_result['error']: esc_attr__('Error! Failed to upload the image.','asl_admin');
      echo json_encode($response);die;
    }
    
    
    //  Insert the Category Record
    if($wpdb->insert(ASL_PREFIX.'categories', $data_params , array('%s','%s','%s'))) {
        
      $response->msg = esc_attr__("Category added successfully",'asl_admin');
      $response->success = true;
    }
    else {
      
      $response->msg = esc_attr__('Error occurred while saving record','asl_admin');//$form_data
    }

    echo json_encode($response);
    die;
  }

  /**
   * [delete_category delete category/categories]
   * @return [type] [description]
   */
  public function delete_category() {

    global $wpdb;

    $response  = new \stdclass();
    $response->success = false;

    $multiple = isset($_REQUEST['multiple'])? $_REQUEST['multiple']: null;
    $delete_sql;$cResults;

    if($multiple) {

      $item_ids      = implode(",", array_map( 'intval', $_POST['item_ids'] ));
      $delete_sql    = "DELETE FROM ".ASL_PREFIX."categories WHERE id IN (".$item_ids.")";
      $cResults      = $wpdb->get_results("SELECT * FROM ".ASL_PREFIX."categories WHERE id IN (".$item_ids.")");
    }
    else {

      $category_id   = intval($_REQUEST['category_id']);
      $delete_sql    = "DELETE FROM ".ASL_PREFIX."categories WHERE id = ".$category_id;
      $cResults      = $wpdb->get_results("SELECT * FROM ".ASL_PREFIX."categories WHERE id = ".$category_id );
    }


    if(count($cResults) != 0) {
      
      if($wpdb->query($delete_sql))
      {
          $response->success = true;
          foreach($cResults as $c) {

            $inputFileName = ASL_UPLOAD_DIR.'icon/'.$c->icon;
          
            if(file_exists($inputFileName) && $c->icon != 'default.png') {  
                  
              unlink($inputFileName);
            }
          }             
      }
      else
      {
        $response->error = esc_attr__('Error occurred while deleting record','asl_admin');//$form_data
        $response->msg   = $wpdb->show_errors();
      }
    }
    else
    {
      $response->error = esc_attr__('Error occurred while deleting record','asl_admin');
    }

    if($response->success)
      $response->msg = ($multiple)?__('Categories deleted successfully.','asl_admin'): esc_attr__('Category deleted successfully.','asl_admin');
    
    echo json_encode($response);die;
  }


  /**
   * [update_category update category with icon]
   * @return [type] [description]
   */
  public function update_category() {

    global $wpdb;

    $response  = new \stdclass();
    $response->success = false;

    $data        = stripslashes_deep($_REQUEST['data']);
    
    //  The Order ID
    $order_id    = (isset($data['ordr']) && is_numeric($data['ordr']))? $data['ordr']: '0';
      
    //  Parameters to Save
    $data_params = array('category_name' => $data['category_name'], 'ordr' => $order_id);



    // Have Icon to Update?
    if($data['action'] == "notsame") {

      //  Upload the Icon File
      $upload_result  = $this->_file_uploader($_FILES["files"], 'svg');

      //  Validate the Upload Success
      if(isset($upload_result['success']) && $upload_result['success']) {

        $file_name    = $upload_result['file_name'];

        //  Add the newly uploaded file
        $data_params['icon'] = $file_name;

        //  Delete the old icon if exist
        $old_icon     = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".ASL_PREFIX."categories WHERE id = %d", $data['category_id']));

        //  Delete the old file, if exist
        if (file_exists(ASL_UPLOAD_DIR.'svg/'.$old_icon[0]->icon)) { 
          unlink(ASL_UPLOAD_DIR.'svg/'.$old_icon[0]->icon);
        }
      }
      else {

        $response->msg      = ($upload_result['error'])? $upload_result['error']: esc_attr__('Error! Failed to upload the image.','asl_admin');
        echo json_encode($response);die;
      }

    }
    
      
    $wpdb->update(ASL_PREFIX."categories", $data_params, array('id' => $data['category_id']));
    $response->msg      = esc_attr__('Category updated successfully.','asl_admin');
    $response->success  = true;
        
    echo json_encode($response);die;
  }


  /**
   * [get_category_by_id get category by id]
   * @return [type] [description]
   */
  public function get_category_by_id() {

    global $wpdb;

    $response  = new \stdclass();
    $response->success = false;

    $store_id = isset($_REQUEST['category_id'])? intval($_REQUEST['category_id']) : 0;
    
    $response->list = $wpdb->get_results( "SELECT * FROM ".ASL_PREFIX."categories WHERE id = ".$store_id);

    if(count($response->list)!=0) {

      $response->success = true;

    }
    else{
      $response->error = esc_attr__('Error occurred while geting record','asl_admin');//$form_data

    }
    echo json_encode($response);die;
  }


  /**
   * [get_categories GET the Categories]
   * @return [type] [description]
   */
  public function get_categories() {

    global $wpdb;
    $start = isset( $_REQUEST['iDisplayStart'])?$_REQUEST['iDisplayStart']:0;   
    $params  = isset($_REQUEST)?$_REQUEST:null;   

    $acolumns = array(
      'id','id','category_name','ordr','icon','created_on'
    );

    $columnsFull = $acolumns;

    $clause = array();

    if(isset($_REQUEST['filter'])) {

      foreach($_REQUEST['filter'] as $key => $value) {

        if(!$key || $key  == 'undefined' || empty($key))
          continue;
        
        if(!$value || $value  == 'undefined' || empty($value))
          continue;

        if($value != '') {

          //  Clean it
          $value    = sanitize_text_field($value);
          $key      = sanitize_text_field($key);

          $clause[] = "$key like '%{$value}%'";
        }
      }
    } 
    
    //  Add the lang Filter
    $clause[] = "lang = '{$this->lang}'";
    
    //iDisplayStart::Limit per page
    $sLimit = "";
    if ( isset( $_REQUEST['iDisplayStart'] ) && $_REQUEST['iDisplayLength'] != '-1' )
    {
      $sLimit = "LIMIT ".intval( $_REQUEST['iDisplayStart'] ).", ".
        intval( $_REQUEST['iDisplayLength'] );
    }

    /*
     * Ordering
     */
    $sOrder = "";
    if ( isset( $_REQUEST['iSortCol_0'] ) )
    {
      $sOrder = "ORDER BY  ";

      for ( $i=0 ; $i < intval( $_REQUEST['iSortingCols'] ) ; $i++ )
      {
        if (isset($_REQUEST['iSortCol_'.$i]))
        {
          $sort_dir = (isset($_REQUEST['sSortDir_0']) && $_REQUEST['sSortDir_0'] == 'asc')? 'ASC': 'DESC';
          $sOrder .= "`".$acolumns[ intval( $_REQUEST['iSortCol_'.$i] )  ]."` ".$sort_dir;
          break;
        }
      }
      

      //$sOrder = substr_replace( $sOrder, "", -2 );
      if ( $sOrder == "ORDER BY" )
      {
        $sOrder = "";
      }
    }


    $sWhere = implode(' AND ', $clause);
    
    if($sWhere != '')$sWhere = ' WHERE '.$sWhere;
    
    $fields = implode(',', $columnsFull);
    
    ###get the fields###
    $sql =  "SELECT $fields FROM ".ASL_PREFIX."categories";

    $sqlCount = "SELECT count(*) 'count' FROM ".ASL_PREFIX."categories";

    /*
     * SQL queries
     * Get data to display
     */
    $sQuery = "{$sql} {$sWhere} {$sOrder} {$sLimit}";
    $data_output  = $wpdb->get_results($sQuery);
      
    $error_status = $wpdb->last_error;

    /* Data set length after filtering */
    $sQuery = "{$sqlCount} {$sWhere}";
    $r = $wpdb->get_results($sQuery);
    $iFilteredTotal = $r[0]->count;
    
    $iTotal = $iFilteredTotal;

      /*
     * Output
     */
    $sEcho = isset($_REQUEST['sEcho'])?intval($_REQUEST['sEcho']):1;
    $output = array(
      "sEcho" => intval($_REQUEST['sEcho']),
      "error" => $error_status,
      "iTotalRecords" => $iTotal,
      "iTotalDisplayRecords" => $iFilteredTotal,
      "aaData" => array()
    );
    
    foreach($data_output as $aRow){
        
      $row = $aRow;

      $row->icon = "<img  src='".ASL_UPLOAD_URL."svg/".$row->icon."' alt=''  style='width:20px'/>"; 

      $row->action = '<div class="edit-options"><a data-id="'.$row->id.'" title="Edit" class="edit_category"><svg width="14" height="14"><use xlink:href="#i-edit"></use></svg></a><a title="Delete" data-id="'.$row->id.'" class="delete_category g-trash"><svg width="14" height="14"><use xlink:href="#i-trash"></use></svg></a></div>';
      $row->check  = '<div class="custom-control custom-checkbox"><input type="checkbox" data-id="'.$row->id.'" class="custom-control-input" id="asl-chk-'.$row->id.'"><label class="custom-control-label" for="asl-chk-'.$row->id.'"></label></div>';
      $output['aaData'][] = $row;
    }

    echo json_encode($output);die;
  }



  /**
   * [uploadDirectory Set the upload directory for our plugin in uploads folder]
   * @param [type] $directory [description]
   */
  public function uploadDirectory($dir) {

    $plugin_directory = 'agile-store-locator';

    /*$dirs['subdir'] = '/'.$plugin_directory;
    $dirs['path']   = $dir['basedir'] . '/'.$plugin_directory;
    $dirs['url']    = $dir['baseurl'] . '/'.$plugin_directory;*/
   

    return array(
      'path'   => ASL_UPLOAD_DIR.$this->sub_upload_directory.'/',
      'url'    => ASL_UPLOAD_URL.$this->sub_upload_directory.'/',
      'subdir' => '/'.$plugin_directory.'/'.$this->sub_upload_directory.'/',
    ) + $dir;

    //return $dir;
  }


  /**
   * [_file_uploader description]
   * @param  [type] $source_file [description]
   * @return [type]              [description]
   */
  private function _file_uploader($source, $folder) {

    if (!function_exists('media_handle_upload')) {
      require_once(ABSPATH . 'wp-admin/includes/image.php');
      require_once(ABSPATH . 'wp-admin/includes/file.php');
      require_once(ABSPATH . 'wp-admin/includes/media.php');
    }


    //  Make sure the upload Directories does exist
    AgileStoreLocator_Helper::create_upload_dirs();

    //  File Name Generation
    $file_extension = pathinfo($source["name"], PATHINFO_EXTENSION);
    $real_file_name = substr(strtolower($source["name"]), 0, strpos(strtolower($source["name"]), '.'));
    $real_file_name = substr($real_file_name, 0, 15);
    $new_file_name  = $real_file_name.'-'.uniqid();
    
    //  Add File Extension
    $new_file_name .= '.'.$file_extension;

    
    //  When the file is an Image
    $is_image = ($folder == 'icon' || $folder == 'svg' || $folder == 'Logo')? true: false;
    
    
    //  For the images only
    if($is_image) {

      // Get the Size of the Image //
      $image_file = $source['tmp_name'];
      list($width, $height) = getimagesize($image_file);

      //  Too Big Size
      if ($source["size"] >  $this->max_image_size) {
        return array('error' => esc_attr__("Sorry, your file is too large.",'asl_admin'));
      }
      

      //  Supported Extensions
      $supported_extensions  = array('jpg','png','gif','jpeg');

      if($folder == 'svg' || $folder == 'icon')
        $supported_extensions[] = 'svg';

      // Not a Supported File Format
      if(!in_array(strtolower($file_extension), $supported_extensions)) {
        return array('error' => esc_attr__("Sorry, only JPG, JPEG, PNG & GIF files are allowed.",'asl_admin'));
      }
      
      $img_max_width  = ($folder == 'Logo')? $this->max_img_width: $this->max_ico_width;
      $img_max_height = ($folder == 'Logo')? $this->max_img_height: $this->max_ico_height;


      //  Width or Height Issue
      if($width > $img_max_width || $height > $img_max_height) {

        return array('error' => esc_attr__("Max image dimensions width and height is {$img_max_width} x {$img_max_height} px.<br> Given image size is {$width} x {$height} px for {$folder}",'asl_admin'));
      }
    }
    //  For a KML File
    else if($folder == 'kml') {

      //  Support KML MIMES
      $supported_mime = array('application/vnd.google-earth.kmz', 'application/vnd.google-earth.kml+xml');
      //  $supported_mime = array('text/plain', 'text/kml', 'text/comma-separated-values');

      //  Only CSV file is allowed
      if(strtolower($file_extension) != 'kml' || !in_array($source['type'], $supported_mime)) {
        return array('error' => esc_attr__("Sorry, only KML files are allowed to import",'asl_admin'));
      }
    }
    else {
       return array('error' => esc_attr__("Error! unkown file is uploaded.",'asl_admin'));
    }

    //  Setup the sub-directory for the upload
    $this->sub_upload_directory = $folder;

    //  Change the Sourcer File name
    $source['name']   = $new_file_name;
    
    //  Upload Param
    $upload_overrides = array('test_form' => false);

    //  Add filter to change directory
    add_filter( 'upload_dir', array( $this, 'uploadDirectory' ));
    
    //  Move the File
    $movefile = wp_handle_upload( $source, $upload_overrides );

    // Add the saved file name
    if(isset($movefile['url'])) {

      $new_file_path = $movefile['url'];
      $new_file_path = explode('/', $new_file_path);
      $new_file_name = $new_file_path[count($new_file_path) - 1];
    }

    //  Remove that Filter
    remove_filter( 'upload_dir', array( $this, 'uploadDirectory' ));

    //  Validate the Moved File
    if ( $movefile && ! isset( $movefile['error'] ) ) {
      
      return ['success' => true, 'file_name' => $new_file_name, 'data' => $movefile];
    }
    else {
       
      return array('error' => $movefile['error']);
    }
  }



  /////////////////////////////////////
  ///////////////ALL Markers Methods //
  /////////////////////////////////////
  

  /**
   * [add_marker Add Marker Method]
   */
  public function add_marker() {

    global $wpdb;

    $response = new \stdclass();
    $response->success = false;

    
    //  Upload the Icon File
    $upload_result  = $this->_file_uploader($_FILES["files"], 'icon');

    //  is upload file successful?
    if(isset($upload_result['success']) && $upload_result['success']) {

      $form_data = $_REQUEST['data'];
      $file_name = $upload_result['file_name'];

      if($wpdb->insert(ASL_PREFIX.'markers', array( 'marker_name' => $form_data['marker_name'], 'icon' => $file_name), array('%s', '%s'))) {
        
        $response->msg      = esc_attr__("Marker added successfully",'asl_admin');
        $response->success  = true;
        $response->list     = $wpdb->get_results( "SELECT * FROM ".ASL_PREFIX."markers ORDER BY id DESC");
      }
      else
        $response->msg = esc_attr__('Error occurred while saving record','asl_admin');
    }
    else
      $response->msg = ($upload_result['error'])?$upload_result['error']: esc_attr__('Error occurred while uploading image.','asl_admin');//$form_data

    echo json_encode($response);
    die;
  }

  /**
   * [delete_marker delete marker/markers]
   * @return [type] [description]
   */
  public function delete_marker() {
    
    global $wpdb;

    $response  = new \stdclass();
    $response->success = false;

    $multiple = isset($_REQUEST['multiple'])? $_REQUEST['multiple']: null;
    $delete_sql;$mResults;

    if($multiple) {

      $item_ids      = implode(",", array_map( 'intval', $_POST['item_ids'] ));
      $delete_sql    = "DELETE FROM ".ASL_PREFIX."markers WHERE id IN (".$item_ids.")";
      $mResults      = $wpdb->get_results("SELECT * FROM ".ASL_PREFIX."markers WHERE id IN (".$item_ids.")");
    }
    else {

      $item_id       = intval($_REQUEST['marker_id']);
      $delete_sql    = "DELETE FROM ".ASL_PREFIX."markers WHERE id = ".$item_id;
      $mResults      = $wpdb->get_results("SELECT * FROM ".ASL_PREFIX."markers WHERE id = ".$item_id );
    }


    if(count($mResults) != 0) {
      
      if($wpdb->query($delete_sql)) {

          $response->success = true;

          foreach($mResults as $m) {

            $inputFileName = ASL_UPLOAD_DIR.'icon/'.$m->icon;
          
            if(file_exists($inputFileName) && $m->icon != 'default.png' && $m->icon != 'active.png') {  
                  
              unlink($inputFileName);
            }
          }             
      }
      else
      {
        $response->error = esc_attr__('Error occurred while deleting record','asl_admin');
        $response->msg   = $wpdb->show_errors();
      }
    }
    else
    {
      $response->error = esc_attr__('Error occurred while deleting record','asl_admin');
    }

    if($response->success)
      $response->msg = ($multiple)?__('Markers deleted successfully.','asl_admin'):esc_attr__('Marker deleted successfully.','asl_admin');
    
    echo json_encode($response);die;
  }



  /**
   * [update_marker update marker with icon]
   * @return [type] [description]
   */
  public function update_marker() {

    global $wpdb;

    $response  = new \stdclass();
    $response->success = false;

    $data        = $_REQUEST['data'];
    

    //  Marker Update Parameter
    $data_params = array('marker_name' => trim(sanitize_text_field($data['marker_name'])));
    
    // Have Icon Updated?
    if($data['action'] == "notsame") {

      //  Upload the Icon File
      $upload_result  = $this->_file_uploader($_FILES["files"], 'icon');

      //  Validate the Upload Success
      if(isset($upload_result['success']) && $upload_result['success']) {

        $file_name    = $upload_result['file_name'];

        //  Add the newly uploaded file
        $data_params['icon'] = $file_name;

        //  Delete the old icon if exist
        $old_icon     = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".ASL_PREFIX."markers WHERE id = %d", $data['marker_id']));

        //  Delete the old file, if exist
        if (file_exists(ASL_UPLOAD_DIR.'icon/'.$old_icon[0]->icon)) { 
          unlink(ASL_UPLOAD_DIR.'icon/'.$old_icon[0]->icon);
        }
      }
      else {

        $response->msg      = ($upload_result['error'])? $upload_result['error']: esc_attr__('Error! Failed to upload the image.','asl_admin');
        echo json_encode($response);die;
      }

    }

    //  Execute the Update Query
    $wpdb->update(ASL_PREFIX."markers", $data_params, array('id' => sanitize_text_field($data['marker_id'])));

    $response->msg      = esc_attr__('Marker Updated Successfully.','asl_admin');
    $response->success  = true; 
    
    echo json_encode($response);die;
  }

  
  /**
   * [get_markers GET the Markers List]
   * @return [type] [description]
   */
  public function get_markers() {

    global $wpdb;
    $start = isset( $_REQUEST['iDisplayStart'])?$_REQUEST['iDisplayStart']:0;   
    $params  = isset($_REQUEST)?$_REQUEST:null;   

    $acolumns = array(
      'id','id','marker_name','icon'
    );

    $columnsFull = $acolumns;

    $clause = array();

    if(isset($_REQUEST['filter'])) {

      foreach($_REQUEST['filter'] as $key => $value) {

        if($value != '') {


          $value    = sanitize_text_field($value);
          $key      = sanitize_text_field($key);

          $clause[] = "$key like '%{$value}%'";
        }
      } 
    } 

    
    
    //iDisplayStart::Limit per page
    $sLimit = "";
    if ( isset( $_REQUEST['iDisplayStart'] ) && $_REQUEST['iDisplayLength'] != '-1' )
    {
      $sLimit = "LIMIT ".intval( $_REQUEST['iDisplayStart'] ).", ".
        intval( $_REQUEST['iDisplayLength'] );
    }

    /*
     * Ordering
     */
    $sOrder = "";
    if ( isset( $_REQUEST['iSortCol_0'] ) )
    {
      $sOrder = "ORDER BY  ";

      for ( $i=0 ; $i < intval( $_REQUEST['iSortingCols'] ) ; $i++ )
      {
        if (isset($_REQUEST['iSortCol_'.$i]))
        {
          $sort_dir = (isset($_REQUEST['sSortDir_0']) && $_REQUEST['sSortDir_0'] == 'asc')? 'ASC': 'DESC';
          $sOrder .= "`".$acolumns[ intval( $_REQUEST['iSortCol_'.$i] )  ]."` ".$sort_dir;
          break;
        }
      }
      

      //$sOrder = substr_replace( $sOrder, "", -2 );
      if ( $sOrder == "ORDER BY" )
      {
        $sOrder = "";
      }
    }
    

    $sWhere = implode(' AND ',$clause);
    
    if($sWhere != '')$sWhere = ' WHERE '.$sWhere;
    
    $fields = implode(',', $columnsFull);
    
    ###get the fields###
    $sql =  "SELECT $fields FROM ".ASL_PREFIX."markers";

    $sqlCount = "SELECT count(*) 'count' FROM ".ASL_PREFIX."markers";

    /*
     * SQL queries
     * Get data to display
     */
    $sQuery = "{$sql} {$sWhere} {$sOrder} {$sLimit}";
    $data_output = $wpdb->get_results($sQuery);
    
    /* Data set length after filtering */
    $sQuery = "{$sqlCount} {$sWhere}";
    $r = $wpdb->get_results($sQuery);
    $iFilteredTotal = $r[0]->count;
    
    $iTotal = $iFilteredTotal;

      /*
     * Output
     */
    $sEcho = isset($_REQUEST['sEcho'])?intval($_REQUEST['sEcho']):1;
    $output = array(
      "sEcho" => intval($_REQUEST['sEcho']),
      //"test" => $test,
      "iTotalRecords" => $iTotal,
      "iTotalDisplayRecords" => $iFilteredTotal,
      "aaData" => array()
    );
    
    foreach($data_output as $aRow)
      {
        $row = $aRow;


        $row->icon   = "<img  src='".ASL_UPLOAD_URL."icon/".$row->icon."' alt=''  style='width:20px'/>";  
        $row->check  = '<div class="custom-control custom-checkbox"><input type="checkbox" data-id="'.$row->id.'" class="custom-control-input" id="asl-chk-'.$row->id.'"><label class="custom-control-label" for="asl-chk-'.$row->id.'"></label></div>';
        $row->action = '<div class="edit-options"><a data-id="'.$row->id.'" title="Edit" class="glyphicon-edit edit_marker"><svg width="14" height="14"><use xlink:href="#i-edit"></use></svg></a><a title="Delete" data-id="'.$row->id.'" class="glyphicon-trash delete_marker"><svg width="14" height="14"><use xlink:href="#i-trash"></use></svg></a></div>';
          $output['aaData'][] = $row;
      }

    echo json_encode($output);die;
  }

  /**
   * [get_marker_by_id get marker by id]
   * @return [type] [description]
   */
  public function get_marker_by_id() {

    global $wpdb;

    $response  = new \stdclass();
    $response->success = false;

    $store_id = isset($_REQUEST['marker_id'])? intval($_REQUEST['marker_id']): 0;
    

    $response->list = $wpdb->get_results( "SELECT * FROM ".ASL_PREFIX."markers WHERE id = ".$store_id);

    if(count($response->list)!=0){

      $response->success = true;

    }
    else{
      $response->error = esc_attr__('Error occurred while geting record','asl_admin');

    }
    echo json_encode($response);die;
  }

  //////////////////////////
  ///////Methods for Logo //
  //////////////////////////
  

  /**
   * [upload_logo Upload the Logo]
   * @return [type] [description]
   */
  public function upload_logo() {

    $response = new \stdclass();
    $response->success = false;

    //  Validate if the Name isn't missing
    if(empty($_POST['data']['logo_name']) || !$_POST['data']['logo_name']) {

      $response->msg = esc_attr__("Error! logo name is required.",'asl_admin');
      echo json_encode($response);die;
    }

    //  Logo Name
    $logo_name   = isset($_POST['data']['logo_name'])? sanitize_text_field($_POST['data']['logo_name']):('Logo '.time());
    
    //   Parameters to Save
    $data_params = array('name' => $logo_name);


    //  Upload the Icon File
    $upload_result  = $this->_file_uploader($_FILES["files"], 'Logo');

    //  Validate the Upload Success
    if(isset($upload_result['success']) && $upload_result['success']) {

      $file_name    = $upload_result['file_name'];

      //  Add the newly uploaded file
      $data_params['path'] = $file_name;
    }
    else {

      $response->msg      = ($upload_result['error'])? $upload_result['error']: esc_attr__('Error! Failed to upload the image.','asl_admin');
      echo json_encode($response);die;
    }


    global $wpdb;

    //  Insert the Logo
    $wpdb->insert(ASL_PREFIX.'storelogos', $data_params);

    $response->list = $wpdb->get_results("SELECT * FROM ".ASL_PREFIX."storelogos ORDER BY id DESC");
    $response->msg  = esc_attr__("Logo is uploaded successfully.",'asl_admin');
    $response->success = true;


    echo json_encode($response);
    die;
  }


  /**
   * [delete_logo Delete a Logo]
   * @return [type] [description]
   */
  public function delete_logo() {
    
    global $wpdb;

    $response  = new \stdclass();
    $response->success = false;

    $multiple = isset($_REQUEST['multiple'])? $_REQUEST['multiple']: null;
    $delete_sql;$mResults;

    if($multiple) {

      $item_ids      = implode(",", array_map( 'intval', $_POST['item_ids'] ));
      $delete_sql    = "DELETE FROM ".ASL_PREFIX."storelogos WHERE id IN (".$item_ids.")";
      $mResults      = $wpdb->get_results("SELECT * FROM ".ASL_PREFIX."storelogos WHERE id IN (".$item_ids.")");
    }
    else {

      $item_id       = intval($_REQUEST['logo_id']);
      $delete_sql    = "DELETE FROM ".ASL_PREFIX."storelogos WHERE id = ".$item_id;
      $mResults      = $wpdb->get_results("SELECT * FROM ".ASL_PREFIX."storelogos WHERE id = ".$item_id );
    }


    if(count($mResults) != 0) {
      
      if($wpdb->query($delete_sql)) {

          $response->success = true;

          foreach($mResults as $m) {

            $inputFileName = ASL_UPLOAD_DIR.'Logo/'.$m->path;
          
            if(file_exists($inputFileName) && $m->path != 'default.png') {  
                  
              unlink($inputFileName);
            }
          }             
      }
      else
      {
        $response->error = esc_attr__('Error occurred while deleting record','asl_admin');
        $response->msg   = $wpdb->show_errors();
      }
    }
    else
    {
      $response->error = esc_attr__('Error occurred while deleting record','asl_admin');
    }

    if($response->success)
      $response->msg = ($multiple)?__('Logos deleted Successfully.','asl_admin'):esc_attr__('Logo deleted Successfully.','asl_admin');
    
    echo json_encode($response);die;
  }



  /**
   * [update_logo update logo with icon]
   * @return [type] [description]
   */
  public function update_logo() {

    global $wpdb;

    $response  = new \stdclass();
    $response->success = false;

    $data = $_REQUEST['data'];
    
    //  Logo Update Parameter
    $data_params = array('name' => trim(sanitize_text_field($data['logo_name'])));

    // with icon
    if($data['action'] == "notsame") {

      //  Upload the Icon File
      $upload_result  = $this->_file_uploader($_FILES["files"], 'Logo');

      $response->data = $upload_result;

      //  Validate the Upload Success
      if(isset($upload_result['success']) && $upload_result['success']) {

        $file_name    = $upload_result['file_name'];


        $response->file_name = $file_name;

        //  Add the newly uploaded file
        $data_params['path'] = $file_name;

        //  Delete the old icon if exist
        $old_icon     = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".ASL_PREFIX."storelogos WHERE id = %d", $data['logo_id']));

        //  Delete the old file, if exist
        if (file_exists(ASL_UPLOAD_DIR.'Logo/'.$old_icon[0]->path)) { 
          unlink(ASL_UPLOAD_DIR.'Logo/'.$old_icon[0]->path);
        }
      }
      else {

        $response->msg      = ($upload_result['error'])? $upload_result['error']: esc_attr__('Error! Failed to upload the image.','asl_admin');
        echo json_encode($response);die;
      }

    }
    
    //  Execute Update Query
    $wpdb->update(ASL_PREFIX."storelogos", $data_params, array('id' => $data['logo_id']));    
    
    $response->msg      = esc_attr__('Logo updated successfully.','asl_admin');
    $response->success  = true; 
    
    echo json_encode($response);die;
  }


  /**
   * [get_logo_by_id get logo by id]
   * @return [type] [description]
   */
  public function get_logo_by_id() {

    global $wpdb;

    $response  = new \stdclass();
    $response->success = false;

    $store_id = isset($_REQUEST['logo_id'])? intval($_REQUEST['logo_id']): 0;
    

    $response->list = $wpdb->get_results( "SELECT * FROM ".ASL_PREFIX."storelogos WHERE id = ".$store_id);

    if(count($response->list)!=0){

      $response->success = true;

    }
    else{
      $response->error = esc_attr__('Error occurred while geting record','asl_admin');

    }
    echo json_encode($response);die;
  }


  /**
   * [get_logos GET the Logos]
   * @return [type] [description]
   */
  public function get_logos() {

    global $wpdb;
    $start = isset( $_REQUEST['iDisplayStart'])?$_REQUEST['iDisplayStart']:0;   
    $params  = isset($_REQUEST)?$_REQUEST:null;   

    $acolumns = array(
      'id','id','name','path'
    );

    $columnsFull = $acolumns;

    $clause = array();

    if(isset($_REQUEST['filter'])) {

      foreach($_REQUEST['filter'] as $key => $value) {

        if($value != '') {

          $value    = sanitize_text_field($value);
          $key      = sanitize_text_field($key);

          $clause[] = "$key like '%{$value}%'";
        }
      } 
    } 

    
    
    //iDisplayStart::Limit per page
    $sLimit = "";
    if ( isset( $_REQUEST['iDisplayStart'] ) && $_REQUEST['iDisplayLength'] != '-1' )
    {
      $sLimit = "LIMIT ".intval( $_REQUEST['iDisplayStart'] ).", ".
        intval( $_REQUEST['iDisplayLength'] );
    }

    /*
     * Ordering
     */
    $sOrder = "";
    if ( isset( $_REQUEST['iSortCol_0'] ) )
    {
      $sOrder = "ORDER BY  ";

      for ( $i=0 ; $i < intval( $_REQUEST['iSortingCols'] ) ; $i++ )
      {
        if (isset($_REQUEST['iSortCol_'.$i]))
        {

          $sort_dir = (isset($_REQUEST['sSortDir_0']) && $_REQUEST['sSortDir_0'] == 'asc')? 'ASC': 'DESC';
          $sOrder .= "`".$acolumns[ intval( $_REQUEST['iSortCol_'.$i] )  ]."` ".$sort_dir;
          break;
        }
      }
      

      //$sOrder = substr_replace( $sOrder, "", -2 );
      if ( $sOrder == "ORDER BY" )
      {
        $sOrder = "";
      }
    }
    

    $sWhere = implode(' AND ',$clause);
    
    if($sWhere != '')$sWhere = ' WHERE '.$sWhere;
    
    $fields = implode(',', $columnsFull);
    
    ###get the fields###
    $sql =  "SELECT $fields FROM ".ASL_PREFIX."storelogos";

    $sqlCount = "SELECT count(*) 'count' FROM ".ASL_PREFIX."storelogos";

    /*
     * SQL queries
     * Get data to display
     */
    $sQuery = "{$sql} {$sWhere} {$sOrder} {$sLimit}";
    $data_output = $wpdb->get_results($sQuery);
    
    /* Data set length after filtering */
    $sQuery = "{$sqlCount} {$sWhere}";
    $r = $wpdb->get_results($sQuery);
    $iFilteredTotal = $r[0]->count;
    
    $iTotal = $iFilteredTotal;

      /*
     * Output
     */
    $sEcho = isset($_REQUEST['sEcho'])?intval($_REQUEST['sEcho']):1;
    $output = array(
      "sEcho" => intval($_REQUEST['sEcho']),
      //"test" => $test,
      "iTotalRecords" => $iTotal,
      "iTotalDisplayRecords" => $iFilteredTotal,
      "aaData" => array()
    );
    
    foreach($data_output as $aRow)
      {
        $row = $aRow;

        $row->path   = '<img src="'.ASL_UPLOAD_URL.'Logo/'.$row->path.'"  style="max-width:100px"/>';
        $row->check  = '<div class="custom-control custom-checkbox"><input type="checkbox" data-id="'.$row->id.'" class="custom-control-input" id="asl-chk-'.$row->id.'"><label class="custom-control-label" for="asl-chk-'.$row->id.'"></label></div>';
        $row->action = '<div class="edit-options"><a data-id="'.$row->id.'" title="Edit" class="glyphicon-edit edit_logo"><svg width="14" height="14"><use xlink:href="#i-edit"></use></svg></a><a title="Delete" data-id="'.$row->id.'" class="glyphicon-trash delete_logo"><svg width="14" height="14"><use xlink:href="#i-trash"></use></svg></a></div>';
          $output['aaData'][] = $row;
      }

    echo json_encode($output);die;
  }



  /**
   * [get_store_list GET List of Stores]
   * @return [type] [description]
   */
  public function get_store_list() {
    
    global $wpdb;
    $start = isset( $_REQUEST['iDisplayStart'])?$_REQUEST['iDisplayStart']:0;   
    $params  = isset($_REQUEST)?$_REQUEST:null;   

    $acolumns = array(
      ASL_PREFIX.'stores.id', ASL_PREFIX.'stores.id ',ASL_PREFIX.'stores.id ','title','description',
      'lat','lng','street','state','city',
      'phone','email','website','postal_code','is_disabled',
      ASL_PREFIX.'stores.id','marker_id', 'logo_id', 'pending',
      ASL_PREFIX.'stores.created_on'/*,'country_id'*/
    );

    $columnsFull = array(
      ASL_PREFIX.'stores.id as id',ASL_PREFIX.'stores.id as id',ASL_PREFIX.'stores.id as id','title','description','lat','lng','street','state','city','phone','email','website','postal_code','is_disabled',ASL_PREFIX.'stores.created_on', 'pending'
    );
    

    $clause = array();

    if(isset($_REQUEST['filter'])) {

      foreach($_REQUEST['filter'] as $key => $value) {

        if($value != '') {

          $value    = sanitize_text_field($value);
          $key      = sanitize_text_field($key);


          if($key == 'is_disabled')
          {
            $value = ($value == 'yes')?1:0;
          }
          elseif($key == 'marker_id' || $key == 'logo_id')
          {
            
            $clause[] = ASL_PREFIX."stores.{$key} = '{$value}'";
            continue;
          }

          $clause[] = ASL_PREFIX."stores.{$key} LIKE '%{$value}%'";
        }
      } 
    }
    

    //iDisplayStart::Limit per page
    $sLimit = "";
    $displayStart = isset($_REQUEST['iDisplayStart'])?intval($_REQUEST['iDisplayStart']):0;
    
    if ( isset( $_REQUEST['iDisplayStart'] ) && $_REQUEST['iDisplayLength'] != '-1' )
    {
      $sLimit = "LIMIT ".$displayStart.", ".
        intval( $_REQUEST['iDisplayLength'] );
    }
    else
      $sLimit = "LIMIT ".$displayStart.", 20 ";

    /*
     * Ordering
     */
    $sOrder = "";
    if ( isset( $_REQUEST['iSortCol_0'] ) )
    {
      $sOrder = "ORDER BY  ";

      for ( $i=0 ; $i < intval( $_REQUEST['iSortingCols'] ) ; $i++ )
      {
        if (isset($_REQUEST['iSortCol_'.$i]))
        {
          $sort_dir = (isset($_REQUEST['sSortDir_0']) && $_REQUEST['sSortDir_0'] == 'asc')? 'ASC': 'DESC';
          $sOrder .= $acolumns[ intval( $_REQUEST['iSortCol_'.$i] )  ]." ".$sort_dir;
          break;
        }
      }
      

      //$sOrder = substr_replace( $sOrder, "", -2 );
      if ( $sOrder == "ORDER BY" )
      {
        $sOrder = "";
      }
    }


    //  When Pending isn't required, filter the pending stores
    if(!(isset($_REQUEST['filter']) && isset($_REQUEST['filter']['pending']))) {

      $clause[] = '('.ASL_PREFIX."stores.pending IS NULL OR ".ASL_PREFIX."stores.pending = 0)";
    }
    
    //  Add the lang Filter
    $clause[] = ASL_PREFIX."stores.lang = '{$this->lang}'";

    $sWhere = implode(' AND ', $clause);
    
    if($sWhere != '')$sWhere = ' WHERE '.$sWhere;
    
    $fields = implode(',', $columnsFull);
    

    $fields .= ',marker_id,logo_id,group_concat(category_id) as categories,iso_code_2';

    ###get the fields###
    $sql     =   ("SELECT $fields FROM ".ASL_PREFIX."stores LEFT JOIN ".ASL_PREFIX."stores_categories ON ".ASL_PREFIX."stores.id = ".ASL_PREFIX."stores_categories.store_id  LEFT JOIN ".ASL_PREFIX."countries ON ".ASL_PREFIX."stores.country = ".ASL_PREFIX."countries.id ");


    $sqlCount = "SELECT count(*) 'count' FROM ".ASL_PREFIX."stores";
    

    /*
     * SQL queries
     * Get data to display
     */
    $dQuery = $sQuery = "{$sql} {$sWhere} GROUP BY ".ASL_PREFIX."stores.id {$sOrder} {$sLimit}";
    
    

    $data_output = $wpdb->get_results($sQuery);
    $wpdb->show_errors = false;
    $error = $wpdb->last_error;

    
      
    /* Data set length after filtering */
    $sQuery = "{$sqlCount} {$sWhere}";
    $r = $wpdb->get_results($sQuery);
    $iFilteredTotal = $r[0]->count;
    
    $iTotal = $iFilteredTotal;



      /*
     * Output
     */
    $sEcho  = isset($_REQUEST['sEcho'])?intval($_REQUEST['sEcho']):1;
    $output = array(
      "sEcho" => intval($_REQUEST['sEcho']),
      "iTotalRecords" => $iTotal,
      'orderby' => $sOrder,
      "iTotalDisplayRecords" => $iFilteredTotal,
      "aaData" => array()
    );

    if($error) {

      $output['error'] = $error;
      $output['query'] = $dQuery;
    }


    $days_in_words = array('0'=>'Sun','1'=>'Mon','2'=>'Tues','3'=>'Wed','4'=>'Thur','5'=>'Fri','6'=>'Sat');
      

    foreach($data_output as $aRow) {
        
      $row = $aRow;

      $edit_url = 'admin.php?page=edit-agile-store&store_id='.$row->id;

      $row->action = '<div class="edit-options"><a class="row-cpy" title="Duplicate" data-id="'.$row->id.'"><svg width="14" height="14"><use xlink:href="#i-clipboard"></use></svg></a><a href="'.$edit_url.'"><svg width="14" height="14"><use xlink:href="#i-edit"></use></svg></a><a title="Delete" data-id="'.$row->id.'" class="glyphicon-trash"><svg width="14" height="14"><use xlink:href="#i-trash"></use></svg></a></div>';

      //  Show a approve button
      if(isset($row->pending) && $row->pending == '1') {

        $row->action .= '<button data-id="'.$row->id.'" data-loading-text="'.esc_attr__('Approving...','asl_admin').'" class="btn btn-approve btn-success" type="button">'.esc_attr__('Approve','asl_admin').'</button>';
      }

      $row->check  = '<div class="custom-control custom-checkbox"><input type="checkbox" data-id="'.$row->id.'" class="custom-control-input" id="asl-chk-'.$row->id.'"><label class="custom-control-label" for="asl-chk-'.$row->id.'"></label></div>';

      //Show country with state
      if($row->state && isset($row->iso_code_2))
        $row->state = $row->state.', '.$row->iso_code_2;



      $output['aaData'][] = $row;

        //get the categories
      if($aRow->categories) {

        $categories_ = $wpdb->get_results("SELECT category_name FROM ".ASL_PREFIX."categories WHERE id IN ($aRow->categories)");

        $cnames = array();
        foreach($categories_ as $cat_)
          $cnames[] = $cat_->category_name;

        $aRow->categories = implode(', ', $cnames);
      }  
    }

    echo json_encode($output);
    die;
    
    /*switch (json_last_error()) {
        case JSON_ERROR_NONE:
            echo ' - No errors';
        break;
        case JSON_ERROR_DEPTH:
            echo ' - Maximum stack depth exceeded';
        break;
        case JSON_ERROR_STATE_MISMATCH:
            echo ' - Underflow or the modes mismatch';
        break;
        case JSON_ERROR_CTRL_CHAR:
            echo ' - Unexpected control character found';
        break;
        case JSON_ERROR_SYNTAX:
            echo ' - Syntax error, malformed JSON';
        break;
        case JSON_ERROR_UTF8:
            echo ' - Malformed UTF-8 characters, possibly incorrectly encoded';
        break;
        default:
            echo ' - Unknown error';
        break;
    }*/
  }

  /**
   * [change_options Save the Settings in the Settings table]
   */
  public function change_options($json_return = false) {

    global $wpdb;
    $prefix = ASL_PREFIX;

    // Data
    $content = isset($_POST['content'])? stripslashes_deep($_POST['content']): null;
    $type    = isset($_POST['stype'])? stripslashes_deep($_POST['stype']): null;

    //  Response
    $response  = new \stdclass();
    $response->success = false;

    //  When type is hidden
    if(in_array($type, ['hidden', 'cache'])) {

      $c = $wpdb->get_results("SELECT count(*) AS 'count' FROM {$prefix}settings WHERE `type` = '{$type}'");

      $data_params = array('content' => json_encode($content), 'type'=> $type);


      if($c[0]->count  >= 1) {
        $wpdb->update($prefix."settings", $data_params, array('type'=> $type));
      }
      else {
        $wpdb->insert($prefix."settings", $data_params);
      }

      $response->msg     = esc_attr__("Settings has been updated.",'asl_admin');
      $response->success = true;
    }

    //  return as JSON
    if($json_return) {
      return $response;
    }

  
    echo json_encode($response);die;    
  }



  /**
   * [save_custom_map save customize map]
   * @return [type] [description]
   */
  public function save_custom_map() {

    global $wpdb;

    $response  = new \stdclass();
    $response->success = false;


    //Check for asl-p-cont infbox html
    if(isset($_POST['data_map'])) {

      $data_map = stripslashes_deep($_POST['data_map']);

        $wpdb->update(ASL_PREFIX."settings",
        array('content' => stripslashes($data_map)),
        array('id' => 1,'type'=> 'map'));

      $response->msg     = esc_attr__("Map has been updated successfully.",'asl_admin');
      $response->success = true;
    }
    else
      $response->error   = esc_attr__("Error Occured saving Map.",'asl_admin');

        
    echo json_encode($response);die;  
  }

  /**
   * [validate_me Validate P]
   * @return [type] [description]
   */
  public function validate_me() {

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $response           = new \stdclass();
    $response->success  = false;

    //  Validate the Key
    if(isset($_REQUEST['value']) && $_REQUEST['value']) {

      $code_value  = $_REQUEST['value'];
      
      //  Found
      if(strpos($code_value, '|')) {

        $codes = explode('|', $code_value);

        if($codes[1]  == crc32($codes[0])) {

          update_option('asl-compatible', $code_value);
        }
      }
      
      $request_data = wp_remote_request('https://agilestorelocator.com/validate/index.php?v-key='.(urlencode($_REQUEST['value'])).'&v-hash='.((urlencode($_SERVER['SERVER_NAME']))));

      //  When there is an array show it
      if(is_object($request_data) && is_wp_error($request_data)) {

        $response->message  = $request_data->get_error_message();

        //update_option('asl-compatible', $_REQUEST['value']);
        echo json_encode($response); die;
      }

      if(isset($request_data['body'])) {

        $request_data   = json_decode($request_data['body'], true);

        $response->data = $request_data;

        if($request_data) {

          // Validate success
          if($request_data['success']) {
            $response->success  = true;

            update_option('asl-compatible', $code_value);
          }

          // Message
          if($request_data['message']) {

            $response->message  = $request_data['message'];
          }
        }
      }
      else {

        $response->message  = 'Failed to receive response from server';
      }
    }
    else {

      $response->data = 'Value is not valid.';  
    }

    echo json_encode($response); die;
  } 


  /**
   * [fill_missing_coords Fetch the Missing Coordinates]
   * @return [type] [description]
   */
  public function fill_missing_coords() {
  
    ini_set('memory_limit', '256M');
    ini_set('max_execution_time', 0);
    
    global $wpdb;

    $response  = new \stdclass();
    $response->success = false;
    $response->summary = array();

    //Get the API Key
    $sql = "SELECT `key`,`value` FROM ".ASL_PREFIX."configs WHERE `key` = 'server_key'";
    $configs_result = $wpdb->get_results($sql);
    $api_key    = $configs_result[0]->value;

    if($api_key) {

      //Get the Stores
      $stores = $wpdb->get_results("SELECT * FROM ".ASL_PREFIX."stores WHERE (lat = '' AND lng = '') OR (lat IS NULL AND lng IS NULL) OR !(lat BETWEEN -90.10 AND 90.10) OR !(lng BETWEEN -180.10 AND 180.10) OR !(lat REGEXP '^[+-]?[0-9]*([0-9]\\.|[0-9]|\\.[0-9])[0-9]*(e[+-]?[0-9]+)?$') OR !(lng REGEXP '^[+-]?[0-9]*([0-9]\\.|[0-9]|\\.[0-9])[0-9]*(e[+-]?[0-9]+)?$')");

      foreach($stores as $store) {

        $coordinates = AgileStoreLocator_Helper::getCoordinates($store->street, $store->city, $store->state, $store->postal_code, $store->country, $api_key);

        if($coordinates) {

          if($wpdb->update( ASL_PREFIX.'stores', array('lat' => $coordinates['lat'], 'lng' => $coordinates['lng']),array('id'=> $store->id )))
          {
            $response->summary[] = 'Store ID: '.$store->id.", LAT/LNG Fetch Success, Address: ".implode(', ', array($store->street, $store->city, $store->state, $store->postal_code));
          }
          else
            $response->summary[] = '<span class="red">Store ID: '.$store->id.", LAT/LNG Error Save, Address: ".implode(', ', array($store->street, $store->city, $store->state, $store->postal_code)).'</span>';

        }
        else
          $response->summary[] = '<span class="red">Store ID: '.$store->id.", LAT/LNG Fetch Failed, Address: ".implode(', ', array($store->street, $store->city, $store->state, $store->postal_code)).'</span>';
        
      }

      if(!$stores || count($stores) == 0) {

        $response->summary[] = esc_attr__('Missing Coordinates are not Found in Store Listing','asl_admin');
      }

      $response->msg      = esc_attr__('Missing Coordinates Request Completed','asl_admin');
      $response->success  = true;
    }
    else
      $response->msg    = esc_attr__('Google Server API Key is Missing.','asl_admin');

  
    echo json_encode($response);die;
  }

  /**
   * [import_store Import the Stores of CSV/EXCEL]
   * @return [type] [description]
   */
  public function import_store($_file_to_import = null, $cron_job = false) {

    
    ini_set('memory_limit', '256M');
    ini_set('max_execution_time', 0);
    
    error_reporting(E_ERROR | E_PARSE);
    ini_set('display_errors', 1);
    
    global $wpdb;
    
    //$_REQUEST['data_'] = 'demo-stores.csv';
    
    $response  = new \stdclass();
    $response->success = false;

    //  The file which will be imported
    $import_file   = ($_file_to_import)? $_file_to_import: sanitize_text_field($_REQUEST['data_']);

    $countries     = $wpdb->get_results("SELECT id,country FROM ".ASL_PREFIX."countries");
    $all_countries = array();

    foreach($countries as $_country) {

      $all_countries[$_country->country] = $_country->id;
    }


    if(!get_option('asl-compatible')) {

      $response->summary        = array('Please provide your purchase code to proceed through purchase dialog or contact us at support@agilelogix.com');
      $response->imported_rows  = 0;
      $response->success        = true;
    
      echo json_encode($response);die;  
    }

    $wpdb->query("SET NAMES utf8");
    

    // Get the API KEY
    $api_key = null;

    $sql     = "SELECT `key`,`value` FROM ".ASL_PREFIX."configs WHERE `key` = 'server_key'";
    $configs_result = $wpdb->get_results($sql);
    
    if($configs_result && isset($configs_result[0]))
      $api_key = $configs_result[0]->value;
    
    $response->summary = array();

    
    require_once ASL_PLUGIN_PATH.'admin/CSV/csv.php';

    //  Input File Name
    $inputFileName  = (($cron_job)? (ASL_UPLOAD_DIR.'cron/'):ASL_PLUGIN_PATH.'public/import/').$import_file;

    //  Don't let it go when fil is missing
    if(!file_exists($inputFileName)) {
      $response->error = 'Import Error! File is missing';
      echo json_encode($response);die;
    }


    $header_columns = ['title', 'description', 'street', 'city', 'state', 'postal_code', 'country', 'lat', 'lng', 'phone', 'fax', 'email', 'website', 'is_disabled', 'logo', 'categories', 'marker_id', 'description_2', 'open_hours', 'order', 'brand', 'special'];

    $rows = null;

    try {
      
      $csv = new Csv();

      $csv->getData($inputFileName);

      //  Make it associative array, and skip first row
      $csv->fillKeys($header_columns);

      //  Get the Rows
      $rows = $csv->getRows();
      //echo json_encode($rows, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);die;
    }
    catch (\Exception $e) {
      
      $response->not_working = true;
      $response->success     = false;
      $response->summary     = [$e->getMessage()];
       
      //  When not a Cronjob import request
      if($_file_to_import) {
        echo json_encode($response);die;
      }
    }

    //  Get the Custom Fields
    $fields    = $this->_get_custom_fields();

    $index     = 2;
    $imported  = 0;


    //  Default language
    //$default_language = get_locale();
    
    foreach($rows as $t) {
      
      $logoid        = '0';
      $categoryerror = '';


      //  lang field
      $lang  = (isset($t['lang']) && $t['lang'])? $t['lang']: '';

      if($lang == 'en' || $lang == 'en_US' || strlen($lang) >= 13) {
        $lang = '';
      }
      

      //  Either Zip or the postal_code
      if(isset($t['zip'])) {

        $t['postal_code'] = $t['zip'];
      }

      //  Check if the Logo Name already exist, just use it
      if(isset($t['logo_name']) && trim($t['logo_name']) != '') {

        $t['logo_name'] = trim($t['logo_name']);
        
        $logoresult = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".ASL_PREFIX."storelogos WHERE `name` = %s", $t['logo_name']));
        
        if(count($logoresult) != 0) {

          $logoid = $logoresult[0]->id;
        }
      }

      //  When Logo is missing and we have a Logo URL, Fetch it
      if($logoid == '0' && isset($t['logo_image']) && !empty(trim($t['logo_image'])) && filter_var(filter_var($t['logo_image'], FILTER_SANITIZE_URL), FILTER_VALIDATE_URL) !== false) {

        $target_dir  = ASL_UPLOAD_DIR."Logo/";

        $extension = explode('.', $t['logo_image']);
        $extension = $extension[count($extension) - 1];

        if(in_array($extension, ['jpg', 'png', 'gif', 'svg', 'jpeg'])) {

          $logo_url  = str_replace(' ', '%20', $t['logo_image']);
          $file_name = uniqid().'.'.$extension;
          $file_path = $target_dir.$file_name;
          file_put_contents($file_path, file_get_contents($logo_url));  

          $t['logo_image'] = $file_name;
        }
      }
      

      //////////////////////////////
      ///// CREATE Brand Dropdown //
      //////////////////////////////
      $brand_ids = [];

      if($t['brand'] != '') {
        
        $brands = explode("|", $t['brand']);

        foreach ($brands as $brand) {
          
          $brand          = trim($brand);
          $brand_in_db    = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".ASL_PREFIX."brands WHERE lang = '$lang' AND `name` = %s", $brand));
          
          
          //  Get the ID
          if(count($brand_in_db) > 0) {

            $brand_ids[] = $brand_in_db[0]->id;

          }
          //  Add it and Save ID
          else {

            $wpdb->insert(ASL_PREFIX.'brands', array('name' => $brand, 'lang' => $lang), array('%s', '%s'));

            $response->summary[] = 'Row: '.$index.', Brand created: '.$brand;

            $brand_ids[] = $wpdb->insert_id;
          }
        }
      }

      $brand_ids = implode(',', $brand_ids);


      //////////////////////////////
      ///// CREATE Special Dropdown //
      //////////////////////////////
      $special_ids = [];

      if($t['special'] != '') {
        
        $specials = explode("|", $t['special']);

        foreach ($specials as $special) {
          
          $special          = trim($special);
          $special_in_db    = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".ASL_PREFIX."specials WHERE lang = '$lang' AND `name` = %s", $special));
          
          
          //  Get the ID
          if(count($special_in_db) > 0) {

            $special_ids[] = $special_in_db[0]->id;

          }
          //  Add it and Save ID
          else {

            $wpdb->insert(ASL_PREFIX.'specials', array('name' => $special, 'lang' => $lang), array('%s','%s'));

            $response->summary[] = 'Row: '.$index.', Special created: '.$special;

            $special_ids[] = $wpdb->insert_id;
          }
        }
      }

      $special_ids = implode(',', $special_ids);


      ///////////////////////////////////
      /// CREATE CATEGORY IF NOT FOUND //
      ///////////////////////////////////
      $categorys = explode("|", $t['categories']);


      if($t['categories'] != '') {
        
        foreach ($categorys as $_cat) {
          
          $_cat = trim($_cat);

          if(!$_cat)
            continue;
          
          try {
              
            $category_count = $wpdb->get_results($wpdb->prepare("SELECT count(*) AS `count` FROM ".ASL_PREFIX."categories WHERE lang = '$lang' AND category_name = %s" , $_cat));            

            //IF COUNT 0 create that category
            if($category_count[0]->count == 0) {

              $wpdb->insert(ASL_PREFIX.'categories', 
              array(
                  'category_name' => $_cat,     
                  'is_active' => 1,
                  'icon'      => 'default.png',
                  'lang'      => $lang
                ),
              array('%s','%d','%s'));

              $response->summary[] = 'Row: '.$index.', Category created: '.$_cat;
            }
          }
          catch (\Exception $e) {
              
              $response->summary[] = 'Error: '.$index.', Category error: '.$_cat.', Message:'.$e->getMessage();
          }

        }
      }


      if($t['title'] != '') {

        //Check if Lat/Lng is missing and we have address
        if(!trim($t['lat']) || !trim($t['lng'])) {

          //$coordinates = ['lat' => '44.44', 'lng' => '55.55'];
          $coordinates = AgileStoreLocator_Helper::getCoordinates($t['street'],$t['city'],$t['state'],$t['postal_code'],$t['country'],$api_key);
          
          if($coordinates) {

            $t['lat'] = $coordinates['lat'];
            $t['lng'] = $coordinates['lng'];
          }
          else
            $response->summary[] = 'Row: '.$index.", LAT/LNG Fetch Failed";
          
          //sleep(0.2);
        }
        
        $is_update = false;
        $store_id  = null;

        //  Open Hours
        $hours_n_days = explode('|', $t['open_hours']);
        $days         = array('mon' => '0','tue'=> '0','wed'=> '0','thu'=> '0','fri'=> '0','sat'=> '0','sun'=> '0');

        foreach($hours_n_days as $_day) {

          $day_hours = explode('=', $_day);

          //is Valid Day
          if(isset($days[$day_hours[0]]) && isset($day_hours[1])) {

            $day_      = $day_hours[0];
            $dhours    = $day_hours[1];


            if($dhours === '1') {

              $days[$day_] = '1';
            }
            else if($dhours === '0') {

              $days[$day_] = '0';
            }
            //For Hours of every day
            else {

              $durations = explode(',', $dhours);

              if(count($durations) > 0) {

                //make it array
                $days[$day_] = array();

                foreach($durations as $hours) {

                  $timings = explode('-', $hours);

                  if(count($timings) == 2)
                    $days[$day_][] = trim($timings[0]).' - '.trim($timings[1]);
                }
              }
            } 
          }
        }

        $days = json_encode($days);

        //$wpdb->show_errors = true;


        //  Is an Update operation or Add?
        $is_update = (isset($t['update_id']) && $t['update_id'] && is_numeric($t['update_id']))? true: false;


        //  Compile the Custom Fields
        $custom_field_data = [];
        
        foreach ($fields as $field => $f_value) {
          
          if(isset($t[$field])) {

            $custom_field_data[$field] =  $t[$field];
          }
        }

        $custom_field_data = json_encode($custom_field_data);


        //  Validating the DATA
        $marker_id   = (isset($t['marker_id']) && is_numeric($t['marker_id']))? $t['marker_id']: '1';
        $is_disabled = (isset($t['is_disabled']) && $t['is_disabled'] == '1')? '1': '0';
        $order_id    = (isset($t['order']) && is_numeric($t['order']))? $t['order']: '0';

        $phone       = substr(trim($t['phone']), 0, 50);
        $fax         = substr(trim($t['fax']), 0, 50);
        $email       = substr(trim($t['email']), 0, 100);
        $postal_code = substr(trim($t['postal_code']), 0, 100);
        

        //  Generate Slug
        
        $slug  = AgileStoreLocator_Helper::slugify($t);

        //// Validate if It's Insert or Update by Columns Y//////
        if($is_update) {

          if($wpdb->update( ASL_PREFIX.'stores', array(
            'title' => ($t['title']),
            'description' => $t['description'],
            'street' => $t['street'],
            'city' => trim($t['city']),
            'state' => trim($t['state']),
            'postal_code' => $postal_code,
            'country' => (isset($all_countries[$t['country']]))?$all_countries[$t['country']]:'223', //for united states
            'lat' => $t['lat'],
            'lng' => $t['lng'],
            'phone' => $phone,
            'fax' => $fax,
            'email' => $email,
            'website' => $this->fixURL($t['website']),
            'is_disabled' => $is_disabled,
            'logo_id' => $logoid,
            'marker_id' => $marker_id,
            'open_hours' => $days,
            'description_2' => $t['description_2'],
            'ordr' => $order_id,
            'brand'   => $brand_ids,
            'special' => $special_ids,
            'slug' => $slug,
            'custom' => $custom_field_data
          ),array('id'=> $t['update_id'] )))
          {
            $imported++;
          }
        }
        ////Insertion
        else if($wpdb->insert( ASL_PREFIX.'stores', array(
          'title' => $t['title'], //mb_convert_encoding
          'description' => $t['description'],
          'street' => $t['street'],
          'city' => trim($t['city']),
          'state' => trim($t['state']),
          'postal_code' => $postal_code,
          'country' => (isset($all_countries[$t['country']]))?$all_countries[$t['country']]:'223', //for united states
          'lat' => $t['lat'],
          'lng' => $t['lng'],
          'phone' => $phone,
          'fax' => $fax,
          'email' => $email,
          'website' => $this->fixURL($t['website']),
          'is_disabled' => intval($is_disabled),
          'logo_id' => $logoid,
          'marker_id' => intval($marker_id),
          'open_hours' => $days,
          'description_2' => $t['description_2'],
          'ordr' => intval($order_id),
          'brand' => $brand_ids,
          'special' => $special_ids,
          'slug' => $slug,
          'lang' => $lang,
          'custom' => $custom_field_data
        )))
        {
          $imported++;
        }
        //Error
        else {
          $has_error = true;
          //$response->summary[] = 'Row: '.$index.', Error: '.$wpdb->show_errors();
          $wpdb->show_errors   = true;
          $response->summary[] = 'Row: '.$index.', Error: '.$wpdb->print_error();
          //$wpdb->last_error
        }

        //Get the ID
        $store_id = ($is_update && is_numeric($t['update_id']))?$t['update_id']:$wpdb->insert_id;
        
        
        /////////ADD THE CATEGORIES//////////////////
        if($store_id && $t['categories'] != '') {
          
          //  If is Update? Delete Prev Categories
          if($is_update) {
            $wpdb->query("DELETE FROM ".ASL_PREFIX."stores_categories WHERE store_id = ".$store_id);            
          }

          foreach ($categorys as $category) {
            
            $category   = trim($category);
            $categoryid = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".ASL_PREFIX."categories WHERE lang = '$lang' AND category_name = %s" , $category)  );
          
            if(count($categoryid) != 0) {

              $wpdb->insert(ASL_PREFIX.'stores_categories', 
              array('store_id' => $store_id,'category_id' =>  $categoryid[0]->id),
              array('%s','%s'));
            }
            else
              $response->summary[] = 'Row: '.$index.", Category ".$category." not  found";
          }
        }
        //else $response->summary[] = 'Row: '.$index.", Category is NULL";


        

        //If No Logo is found and have image create a new Logo
        if($logoid == '0') {

          //check if logo image is provided and that exist in folder
          if(isset($t['logo_image']) && !empty(trim($t['logo_image']))) {

            $t['logo_name']    = trim($t['logo_name']);
            $target_file = $t['logo_image'];
            $target_name = $t['logo_name'];

            $wpdb->insert(ASL_PREFIX.'storelogos', 
                  array('path'=>$target_file,'name'=>$target_name),
                  array('%s','%s'));

            $logo_id = $wpdb->insert_id;

            //update the logo id to store table
            $wpdb->update(ASL_PREFIX."stores",
              array('logo_id' => $logo_id),
              array('id' => $store_id)
            );

            $response->summary[] = 'Row: '.$index.", logo Created ".$t['logo_name'];
          }
          //else $response->summary[] = 'Row: '.$index.", logo ".$t['logo_name']." not found";
        }
      }

      $index++;
    }

    
    $response->success       = true;
    $response->imported_rows = $imported;

    //  It is done via the cronjob return the response
    if($_file_to_import) {
      return $response;
    }
    
    echo json_encode($response);die;  
  }

  /**
   * [export_store export Excel fo Stores]
   * @return [type] [description]
   */
  public function export_store() {

    ini_set('memory_limit', '256M');
    ini_set('max_execution_time', 0);
    
    global $wpdb;

    $response  = new \stdclass();
    $response->success = false;

    error_reporting(0);
    ini_set('display_errors', '0');

    //  With Store Id for Update?
    $with_update_id  = (isset($_REQUEST['with_id']) && $_REQUEST['with_id'] == '1')? true: false;
    $with_logo_image = (isset($_REQUEST['logo_image']) && $_REQUEST['logo_image'] == '1')? true: false;

    //  Stores Data
    $stores = $wpdb->get_results("SELECT `s`.`id`,  `s`.`title`,  `s`.`description`,  `s`.`street`,  `s`.`city`,  `s`.`state`,  `s`.`postal_code`,  `c`.`country`,  `s`.`lat`,  `s`.`lng`,  `s`.`phone`,  `s`.`fax`,  `s`.`email`,  `s`.`website`,  `s`.`description_2`,  `s`.`logo_id`,  `s`.`marker_id`,  `s`.`is_disabled`,   `s`.`open_hours`, `s`.`ordr`, `s`.`brand`,`s`.`special`, `s`.`custom`, `s`.`created_on`, `s`.`lang`  FROM ".ASL_PREFIX."stores s LEFT JOIN ".ASL_PREFIX."countries c ON s.country = c.id ORDER BY s.`id`");
    

    //  Add the Export Library
    include ASL_PLUGIN_PATH.'admin/CSV/csv.php';

    //  CSV Instance
    $csv = new Csv();

    //  Header titles
    $headers = ['title', 'description', 'street', 'city', 'state', 'postal_code', 'country', 'lat', 'lng', 'phone', 'fax', 'email', 'website', 'is_disabled', 'logo', 'categories', 'marker_id', 'description_2', 'open_hours', 'order', 'brand', 'special', 'lang'];
    
    //  With Update ID?
    if($with_update_id) {
      
      $headers[] = 'update_id';
    }
    
    //  Rows to be exported
    $all_rows = [];

    //  Get the Custom Field Schema
    $fields       = $this->_get_custom_fields();


    /////////////////////
    //  Get the Brands //
    /////////////////////
    $brands    = $wpdb->get_results( "SELECT id, name FROM ".ASL_PREFIX."brands");

    $brand_list = [];

    foreach ($brands as $b) {      
      $brand_list[$b->id] = $b;
    }

    //////////////////////
    // Get the Specials //
    //////////////////////
    $specials    = $wpdb->get_results( "SELECT id, name FROM ".ASL_PREFIX."specials");

    $special_list = [];

    foreach ($specials as $b) {
      $special_list[$b->id] = $b;
    }

    //  Loop over the stores data
    foreach ($stores as $value) {

      $logo_name  = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".ASL_PREFIX."storelogos WHERE id = %d", $value->logo_id) ); 

      $category   = "";
      
      //  Get the Categories of that Store
      $categories = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".ASL_PREFIX."categories RIGHT JOIN ".ASL_PREFIX."stores_categories ON  
        ".ASL_PREFIX."categories.id  = ".ASL_PREFIX."stores_categories.category_id WHERE ".ASL_PREFIX."stores_categories.store_id = %d", $value->id) );

      


      //  Conver Categoris into String with | JOIN
      $_cats = [];
      foreach($categories as $c) {

        $_cats[] = $c->category_name;
      }

      $_cats = implode('|', $_cats);

      //  Convert the brands
      if($value->brand) {

        $store_brand = explode(',', $value->brand);

        $store_brand_list = [];
        
        foreach($store_brand as $sb) {

          if(isset($brand_list[$sb])) {

            $store_brand_list[] =  $brand_list[$sb]->name;
          }
        }

        $value->brand = implode('|', $store_brand_list);
      }

      //  Convert the specials
      if($value->special) {

        $store_special = explode(',', $value->special);

        $store_special_list = [];
        
        foreach($store_special as $sb) {

          if(isset($special_list[$sb])) {

            $store_special_list[] =  $special_list[$sb]->name;
          }
        }

        $value->special = implode('|', $store_special_list);
      }


      //  Make Open Hours Importable String
      $open_hours_value = '';
      
      if($value->open_hours) {

        $open_hours = json_decode($value->open_hours);

        if(is_object($open_hours)) {

          $open_details = array();
          foreach($open_hours as $key => $_day) {


            $key_value = '';

            if($_day && is_array($_day)) {

              $key_value = implode(',', $_day);
            }
            else if($_day == '1') {

              $key_value = $_day;
            }
            else  {

              $key_value = '0';
            }

            $open_details[] = $key.'='.$key_value;
          }

          $open_hours_value = implode('|', $open_details);
        }
      }


      //  Logo
      $value->logo_name  = (isset($logo_name) && isset($logo_name[0]))?$logo_name[0]->name:'';

      //  Logo image
      if($with_logo_image)
        $value->logo_image  = ($logo_name && isset($logo_name[0]))? ASL_UPLOAD_URL.'Logo/'.$logo_name[0]->path: '';

      
      //  Categories
      $value->categories = $_cats;

      $value->order      = $value->ordr;
      unset($value->ordr);

      //  Open hours
      $value->open_hours = $open_hours_value;

      //  With Update Id?
      if($with_update_id) {
        
        $value->update_id = $value->id;
      }

      // Custom Values
      if(isset($value->custom) && $value->custom) {

        $custom_fields_data     = json_decode($value->custom, true);
        

        foreach ($fields as $field => $f_value) {
          
          $value->$field = (isset($custom_fields_data[$field]))? $custom_fields_data[$field]: '';
        }
      }

      unset($value->id);
      unset($value->created_on);
      unset($value->logo_id);
      unset($value->custom);
      
      //  Push into rows collection
      $all_rows[] = $value;
    }

      
    $csv->setRows($all_rows);
    

    $download_file = 'public/export/stores-data-export-'.time().'.csv';
    $path_to_save = ASL_PLUGIN_PATH.$download_file;

    //$csv->write(Csv::DOWNLOAD, 'stores-data-export.csv');;
    
    $csv->write(Csv::FILE, $path_to_save);
    $response->success  = true;
    $response->msg      = ASL_URL_PATH.$download_file;

    echo json_encode($response);die;
  }


  /**
   * [delete_import_file Delete the Import file]
   * @return [type] [description]
   */
  public function delete_import_file() {

    $file_name  = sanitize_text_field($_REQUEST['data_']);
    $response   = AgileStoreLocator_Helper::removeFile($file_name, ASL_PLUGIN_PATH.'public/import/');

    echo json_encode($response);die;
  }


  /**
   * [upload_store_import_file Upload Store Import File]
   * @return [type] [description]
   */
  public function upload_store_import_file() {

    $response = new stdclass();
    $response->success = false;

    $target_dir  = ASL_PLUGIN_PATH."public/import/";
    $date        = new DateTime();

    $target_name = $target_dir . strtolower($_FILES["files"]["name"]);
    $namefile    = substr(strtolower($_FILES["files"]["name"]), 0, strpos(strtolower($_FILES["files"]["name"]), '.'));
    

    $imageFileType  = pathinfo($target_name,PATHINFO_EXTENSION);
    $target_name    = $target_dir.pathinfo($_FILES['files']['name'], PATHINFO_FILENAME).uniqid().'.'.$imageFileType;


    //  If file not found
    if (file_exists($target_name)) {
        $response->msg = esc_attr__("Sorry, file already exists.",'asl_admin');
    }
    //  Not a valid format
    else if($imageFileType != 'csv') {
        $response->msg = esc_attr__("Sorry, only CSV files are allowed.",'asl_admin');
    }
    //  Upload 
    else if(move_uploaded_file($_FILES["files"]["tmp_name"], $target_name)) {

          $response->msg = esc_attr__("The file has been uploaded.",'asl_admin');
          $response->success = true;
    }
    //error
    else {

      $response->msg = esc_attr__('Some error occured','asl_admin');
    }

    echo json_encode($response);
    die;
  }


  /**
   * [upload_kml_file Upload s new KML File]
   * @return [type] [description]
   */
  public function upload_kml_file() {

    //  Only for the administrator
    if(current_user_can('administrator') ) {
      
      //  Temporarily define to pass the KML file
      if (!defined('ALLOW_UNFILTERED_UPLOADS'))
      define( 'ALLOW_UNFILTERED_UPLOADS', true );
    }
    
    //  All the KML file
    add_filter( 'upload_mimes', array($this, 'kml_file_filter') );

    //  Upload the KML File
    $kml_upload  = $this->_file_uploader($_FILES["files"], 'kml');

    //  When the file is uploaded successfully
    if(isset($kml_upload['success']) && $kml_upload['success']) {

      echo json_encode(['msg' => esc_attr__("KML File uploaded successfully.",'asl_admin'), 'success' => true]);
    }
    else
      echo json_encode(['error' => $kml_upload['error']]);
    
    die;
  }


   /**
   * [remove_kml_file Delete the KML file]
   * @return [type] [description]
   */
  public function remove_kml_file() {

    $file_name  = sanitize_text_field($_REQUEST['data_']);
    $response   = AgileStoreLocator_Helper::removeFile($file_name, ASL_UPLOAD_DIR.'kml/');

    echo json_encode($response);die;
  }
  


  /**
   * [backup_logo_icons Backup of Logos]
   * @return [type] [description]
   */
  public function backup_logo_icons() {

    global $wpdb;

    

    $zip_name = 'store-locator-logo-icons-'.time().'.zip';
    $zip_path = ASL_PLUGIN_PATH.'public/export/'.$zip_name;

    $response  = new \stdclass();
    $response->success = false;


    //  Array for all the Assets
    $all_assets = array();

    ///////////Backup Logo Folder/////////
    $logos     = $wpdb->get_results( "SELECT * FROM ".ASL_PREFIX."storelogos ORDER BY name");
    
    foreach($logos as $logo) {

      $asset_file   = ASL_UPLOAD_DIR.'Logo/'.$logo->path;
      
      //Check if File Exist

      $all_assets[] = $asset_file;
    }

    ///////////Backup Marker Folder/////////
    $markers   = $wpdb->get_results( "SELECT * FROM ".ASL_PREFIX."markers");
    
    foreach($markers as $m) {

      $asset_file   = ASL_UPLOAD_DIR.'icon/'.$m->icon;
      
      //Check if File Exist

      $all_assets[] = $asset_file;
    }

    ///////////Backup Logo Folder//////////
    $categories  = $wpdb->get_results( "SELECT * FROM ".ASL_PREFIX."categories");
    
    foreach($categories as $c) {

      $asset_file   = ASL_UPLOAD_DIR.'svg/'.$c->icon;
      
      //  Check if File Exist
      $all_assets[] = $asset_file;
    }

      //  Created successfull backup
    if(AgileStoreLocator_Helper::create_zip($all_assets, $zip_path)) {

      $response->success  = true;
      $response->msg      = esc_attr__('Assets Backup Successfully, Download the Zip File.','asl_admin');
      $response->zip      = ASL_URL_PATH.'public/export/'.$zip_name;
    }
    else
      $response->error = esc_attr__('Failed to Create the Backup','asl_admin');

    echo json_encode($response);die;
  }

  /**
   * [save_setting save ASL Setting]
   * @return [type] [description]
   */
  public function save_setting() {

    global $wpdb;

    $response  = new \stdclass();
    $response->success = false;

    $data_ = stripslashes_deep($_POST['data']);

    //  Remove Script tag will be saved in wp_options
    $remove_script_tag = $data_['remove_maps_script'];
    unset($data_['remove_maps_script']);

    $keys  =  array_keys($data_);

    foreach($keys as $key) {
      $wpdb->update(ASL_PREFIX."configs",
        array('value' => $data_[$key]),
        array('key' => $key)
      );
    }


    //  Save Custom Settings
    $custom_map_style = $_POST['map_style'];

    $wpdb->update(ASL_PREFIX."settings",
    array('content' => stripslashes($custom_map_style)),
    array('name' => 'map_style'));

    update_option('asl-remove_maps_script', $remove_script_tag);



    $response->msg     = esc_attr__("Setting has been Updated Successfully.",'asl_admin');
        $response->success = true;

    echo json_encode($response);die;
  }  

  /**
   * [load_custom_template Load ASL Custom Template]
   * @return [type] [description]
   */
  public function load_custom_template() {

    global $wpdb;

    $response          = new \stdclass();
    $response->success = false;

    $data_ = stripslashes_deep($_POST);

    //  List template doesn't have any infobox
    if($data_['template'] == 'template-list' && $data_['section'] == 'infobox') {
      
      $response->error = esc_attr__("List Template has no Map.",'asl_admin');
      echo json_encode($response);
      die;
    }

    $html  = '';
    $count = $wpdb->get_results($wpdb->prepare("SELECT COUNT('name') as 'count' FROM ".ASL_PREFIX."settings WHERE `name` = %s AND `type` = %s", $data_['template'], $data_['section']));

    if($count[0]->count  >= 1) {

      //  Template Query 
       $results = $wpdb->get_results($wpdb->prepare("SELECT `content` FROM ".ASL_PREFIX."settings WHERE `name` = %s AND `type` = %s", $data_['template'],$data_['section'])  ,ARRAY_A );

       if ($results)
        $html = $results[0]['content'];

    }
    else {

        //  open stream
        ob_start();
        // include simple products HTML
        include ASL_PLUGIN_PATH.'public/views/'.$data_['template'].'-'.$data_['section'].'.html';

        $html = ob_get_contents();
        
        //  clean it
        ob_end_clean();
        
    }

      
    if (!empty( $html)) {

      $response->html = $html;

      $response->msg     = esc_attr__("HTML added in TextEditor",'asl_admin');
      $response->success = true;
    }


    echo json_encode($response);die;
  }


  /**
   * [save_custom_template Load ASL Custom Template]
   * @return [type] [description]
   */
  public function save_custom_template() {

    global $wpdb;

    $response   = new \stdclass();
    $response->success = false;

    $data_ = stripslashes_deep($_POST);

    //  get previous quantity
    $count = $wpdb->get_results($wpdb->prepare("SELECT COUNT('name') as 'count' FROM ".ASL_PREFIX."settings WHERE `name` = %s AND `type` = %s", $data_['template'],  $data_['section']));
    
    if (!empty($data_['html'])) {

      $data_params = array('name' =>  $data_['template'] ,'type' => $data_['section'],'content' => $data_['html'] );

      if($count[0]->count  >= 1) {
        
        //  Execute the Update Query
        $wpdb->update(ASL_PREFIX."settings", $data_params, array('name'=> $data_['template'] ,'type' => $data_['section']));

      }
      else{
        //  Execute the Insert Query
        $wpdb->insert(ASL_PREFIX."settings", $data_params);
      }

      $response->msg     = esc_attr__("Template Updated",'asl_admin');
      $response->success = true;
    }
        



    echo json_encode($response);die;
  }

  /**
   * [reset_custom_template Load ASL Custom Template]
   * @return [type] [description]
   */
  public function reset_custom_template() {

    global $wpdb;

    $response  = new \stdclass();
    $response->success = false;

    $data_ = stripslashes_deep($_POST);

    //  open stream
    ob_start();

    // include simple products HTML
    include ASL_PLUGIN_PATH.'public/views/'.$data_['template'].'-'.$data_['section'].'.html';
    
    $html = ob_get_contents();
    
    //  clean it
    ob_end_clean();

    $response->html    = $html;
    $response->msg     = esc_attr__("Default template is loaded",'asl_admin');
    $response->success = true;

    echo json_encode($response);die;
  }


    /**
   * [load_ui_settings Load ASL Custom Template]
   * @return [type] [description]
   */
  public function load_ui_settings() {

    global $wpdb;

    $response          = new \stdclass();
    $response->success = false;

    $template = $_POST['template'];

    $colors   = array(
      'template-0'  => array(
        'primary'   => 'clr-primary',
        'header'    => '',
        'header-color'  => '',
        'infobox-color' => '',
        'infobox-bg'    => '',
        'infobox-a'     => 'clr-copy',
        'action-btn-color'  => '',
        'action-btn-bg'     => 'clr-copy',
        'color'   => '',
        'list-bg' => '',
        'list-title'      => '',
        'list-sub-title'  => '',
        'highlighted'     => ''
      ),
      'template-1' => array(
        'primary'   => 'clr-primary',
        'secondary' => '',
        'header'    => 'clr-copy',
        'header-color'  => '',
        'infobox-color' => '',
        'infobox-bg'    => '',
        'infobox-a'     => 'clr-copy',
        'action-btn-color'  => '',
        'action-btn-bg'     => 'clr-copy',
        'color'   => '',
        'list-bg' => '',
        'list-title'      => 'clr-copy',
        'list-sub-title'  => '',
        'highlighted'     => ''
      ),
      'template-2' => array(
        'primary'   => 'clr-primary',
        'header'    => 'clr-copy',
        'header-color'  => '',
        'infobox-color' => '',
        'infobox-bg'    => '',
        'infobox-a'     => 'clr-copy',
        'action-btn-color'  => '',
        'action-btn-bg'     => 'clr-copy',
        'color'   => '',
        'list-bg' => '',
        'list-title'      => 'clr-copy',
        'list-sub-title'  => '',
        'highlighted'     => '',
        'highlighted-list-color' => 'clr-copy'
      ),
      'template-3' => array(
        'primary'   => 'clr-primary',
        'infobox-color' => '',
        'infobox-bg'    => '',
        'infobox-a'     => 'clr-copy',
        'action-btn-color'  => '',
        'action-btn-bg'     => 'clr-copy',
        'color'   => '',
        'list-bg' => '',
        'list-title'              => '',
        'list-sub-title'          => '',
        'highlighted'             => ''
      ),
      'template-wc'  => array(
        'primary'   => 'clr-primary'
      ),
    );


    $white                  = '#FFFFFF';
    $black                  = '#000000';

    $tmpl_0_primary         = '#cb2800';
    $tmpl_0_title_color     = '#32373c';
    $tmpl_0_sub_title_color = '#6a6a6a';
    $tmpl_0_list_color      = '#555d66';
    $tmpl_0_header_bg       = '#F7F7F7';
    $tmpl_0_header_color    = '#32373c';
    $tmpl_0_highlighted     = '#F7F7F7';

    $tmpl_1_primary         = '#000000';
    $tmpl_1_secondary       = '#EF5A28';
    $tmpl_1_title_color     = '#32373c';
    $tmpl_1_sub_title_color = '#6a6a6a';
    $tmpl_1_list_color      = '#555d66';
    $tmpl_1_header_bg       = $tmpl_1_primary;
    $tmpl_1_highlighted     = '#F7F7F7';

    $tmpl_2_primary         = '#cb2800';
    $tmpl_2_secondary       = '#cb2800';
    $tmpl_2_title_color     = '#32373c';
    $tmpl_2_sub_title_color = '#6a6a6a';
    $tmpl_2_list_color      = '#555d66';
    $tmpl_2_header_bg       = '#F7F7F7';
    $tmpl_2_highlighted     = '#F7F7F7';

    $tmpl_3_primary         = '#cb2800';
    $tmpl_3_title_color     = '#32373c';
    $tmpl_3_sub_title_color = '#6a6a6a';
    $tmpl_3_list_color      = '#555d66';
    $tmpl_3_header_bg       = '#F7F7F7';
    $tmpl_3_highlighted     = '#F7F7F7';

    //  the default colors that will load with the customizer
    $default_colors = array(
      'template-0'  => array(
        'primary'   => $tmpl_0_primary,
        'header'    => $tmpl_0_header_bg,
        'header-color'  => $tmpl_0_header_color,
        'infobox-color' => $tmpl_0_list_color,
        'infobox-bg'    => $white,
        'infobox-a'     => $tmpl_0_primary,
        'action-btn-color'  => $white,
        'action-btn-bg'     => $tmpl_0_primary,
        'color'   => $tmpl_0_list_color,
        'list-bg' => $white,
        'list-title'      => $tmpl_0_title_color,
        'list-sub-title'  => $tmpl_0_sub_title_color,
        'highlighted'     => $tmpl_0_highlighted,
        'highlighted-list-color' => $tmpl_0_primary
      ),
      'template-1' => array(
        'primary'   => $tmpl_1_primary,
        'secondary' => $tmpl_1_secondary,
        'header'    => $tmpl_1_header_bg,
        'header-color'  => $tmpl_1_list_color,
        'infobox-color' => $tmpl_1_list_color,
        'infobox-bg'    => $white,
        'infobox-a'     => $tmpl_1_primary,
        'action-btn-color'  => $white,
        'action-btn-bg'     => $tmpl_1_primary,
        'color'   => $tmpl_1_list_color,
        'list-bg' => $white,
        'list-title'      => $tmpl_1_title_color,
        'list-sub-title'  => $tmpl_1_sub_title_color,
        'highlighted'     => $tmpl_1_highlighted,
        'highlighted-list-color' => $tmpl_1_primary
      ),
      'template-2' => array(
        'primary'   => $tmpl_2_primary,
        'header'    => $tmpl_2_header_bg,
        'header-color'  => $tmpl_2_list_color,
        'infobox-color' => $tmpl_2_list_color,
        'infobox-bg'    => $white,
        'infobox-a'     => $tmpl_2_primary,
        'action-btn-color'  => $white,
        'action-btn-bg'     => $tmpl_2_primary,
        'color'   => $tmpl_2_list_color,
        'list-bg' => $white,
        'list-title'      => $tmpl_2_title_color,
        'list-sub-title'  => $tmpl_2_sub_title_color,
        'highlighted'     => $tmpl_2_highlighted,
        'highlighted-list-color' => $tmpl_2_primary
      ),
      'template-3'  => array(
        'primary'   => $tmpl_3_primary,
        'header'    => $tmpl_3_header_bg,
        'header-color'  => $tmpl_3_primary,
        'infobox-color' => $tmpl_0_list_color,
        'infobox-bg'    => $white,
        'infobox-a'     => $tmpl_3_primary,
        'action-btn-color'  => $white,
        'action-btn-bg'     => $tmpl_3_primary,
        'color'   => $tmpl_3_list_color,
        'list-bg' => $white,
        'list-title'      => $tmpl_3_title_color,
        'list-sub-title'  => $tmpl_3_sub_title_color,
        'highlighted'     => $tmpl_3_highlighted,
        'highlighted-list-color' => $tmpl_3_primary
      ),
      'template-wc'  => array(
        'primary'   => $tmpl_0_primary
      )
    );


    $default_fonts  = array(
      'template-0'  => array(
        'font-size'   => 13,
        'title-size'  => 15,
        'btn-size'  => 13
      ),
      'template-1'  => array(
        'font-size'   => 13,
        'title-size'  => 18,
        'btn-size'  => 13
      ),
      'template-2'  => array(
        'font-size'   => 13,
        'title-size'  => 15,
        'btn-size'  => 13
      ),
      'template-3'  => array(
        'font-size'   => 13,
        'title-size'  => 15,
        'btn-size'  => 13
      ),
      'template-wc'  => array(
        'font-size'   => 13,
        'title-size'  => 16,
        'btn-size'  => 14
      )
    );

    
    $html     = '';
    $fields   = '';


    //  Only get the array of active default color
    $default_colors  = $default_colors[$template];
    $default_fonts   = $default_fonts[$template];

    $fields_settings = AgileStoreLocator_Helper::get_setting('ui-template', $template);

    if($fields_settings) {

      $fields = json_decode($fields_settings);
    }

    //  Start Stream
    ob_start();

    // include ui customizer fields products HTML
    include ASL_PLUGIN_PATH.'admin/partials/ui-customizer-fields.php';
  
    $html = ob_get_contents();

    //  Clean it
    ob_end_clean();

    $response->html     = $html;
    $response->msg      = esc_attr__("Template UI settings updated",'asl_admin');
    $response->success  = true;

    echo json_encode($response);die;
  }

    /**
   * [save_ui_settings Save ASL UI Settings]
   * @return [type] [description]
   */
  public function save_ui_settings() {

    global $wpdb;

    $response  = new \stdclass();
    $response->success = false;

    $data_    = stripslashes_deep($_POST['formData']);
    $template = sanitize_text_field($_POST['template']);

    $data     = json_encode($data_);
      
    AgileStoreLocator_Helper::set_setting($data, 'ui-template', $template);

    $response->msg     = esc_attr__("Template updated",'asl_admin');
    $response->success = true;

    echo json_encode($response);die;
  }

  ////////////////////////
  //////////Page Callee //
  ////////////////////////
  
  /**
   * [admin_ui_customizer ASL Settings Page]
   * @return [type] [description]
   */
  public function admin_ui_customizer() {
    
    $this->_enqueue_scripts();

    $all_configs = array();

    include ASL_PLUGIN_PATH.'admin/partials/ui-customizer.php';
  } 

  /**
   * [admin_plugin_settings Admin Plugi]
   * @return [type] [description]
   */
  public function admin_plugin_settings() {

    // add scripts
    $this->_enqueue_scripts();


    include ASL_PLUGIN_PATH.'admin/partials/add_store.php';
  }

  /**
   * [edit_store Edit a Store]
   * @return [type] [description]
   */
  public function edit_store() {

    $this->_enqueue_scripts();

    global $wpdb;
    
    $store_id = isset($_REQUEST['store_id'])? intval($_REQUEST['store_id']): 0;

    if(!$store_id) {

      die('Invalid Store Id.');
    }

    //  Store Data
    $store  = $wpdb->get_results("SELECT * FROM ".ASL_PREFIX."stores WHERE id = $store_id");    


    if(!$store || !$store[0]) {
      die('Invalid Store Id');
    }
  
    //  Take the first store    
    $store = $store[0];


    $storecategory = $wpdb->get_results("SELECT * FROM ".ASL_PREFIX."stores_categories WHERE store_id = $store_id");

    //  Current store lang
    $lang      = $store->lang;

    $countries = $wpdb->get_results("SELECT id,country FROM ".ASL_PREFIX."countries");
    $logos     = $wpdb->get_results( "SELECT `id` as `value`, `name` as `text`, `path` as `imageSrc`  FROM ".ASL_PREFIX."storelogos ORDER BY name");
    $markers   = $wpdb->get_results( "SELECT * FROM ".ASL_PREFIX."markers");
    $category  = $wpdb->get_results( "SELECT * FROM ".ASL_PREFIX."categories WHERE lang = '$lang'");
    $brands    = $wpdb->get_results( "SELECT * FROM ".ASL_PREFIX."brands WHERE lang = '$lang'");
    $specials  = $wpdb->get_results( "SELECT * FROM ".ASL_PREFIX."specials WHERE lang = '$lang'");


    //  Custom Fields
    $fields       = $this->_get_custom_fields();
    $custom_data  = (isset($store->custom) && $store->custom)? json_decode($store->custom, true): []; 



    $store_brand       = explode(',', $store->brand);
    $store_special     = explode(',', $store->special);

    //$storelogo = $wpdb->get_results("SELECT * FROM ".ASL_PREFIX."storelogos WHERE id = ".$store->logo_id);
  
    //api key
    $sql = "SELECT `key`,`value` FROM ".ASL_PREFIX."configs WHERE `key` = 'api_key' || `key` = 'time_format'";
    $all_configs_result = $wpdb->get_results($sql);


    $all_configs = array();

    foreach($all_configs_result as $c) {
      $all_configs[$c->key] = $c->value;
    }

    include ASL_PLUGIN_PATH.'admin/partials/edit_store.php';    
  }


  /**
   * [admin_add_new_store Add a New Store]
   * @return [type] [description]
   */
  public function admin_add_new_store() {
    
    global $wpdb;

    $this->_enqueue_scripts();

    //api key
    $sql = "SELECT `key`,`value` FROM ".ASL_PREFIX."configs WHERE `key` = 'api_key' || `key` = 'time_format' || `key` = 'default_lat' || `key` = 'default_lng'";
    $all_configs_result = $wpdb->get_results($sql);


    $all_configs = array();

    foreach($all_configs_result as $c) {
      $all_configs[$c->key] = $c->value;
    }

    //  Current store lang
    $lang       = $this->lang;

    $logos      = $wpdb->get_results( "SELECT `id` as `value`, `name` as `text`, `path` as `imageSrc`  FROM ".ASL_PREFIX."storelogos ORDER BY name");
    $markers    = $wpdb->get_results( "SELECT * FROM ".ASL_PREFIX."markers");

    $category   = $wpdb->get_results( "SELECT * FROM ".ASL_PREFIX."categories WHERE lang = '$lang';");
    $brands     = $wpdb->get_results( "SELECT * FROM ".ASL_PREFIX."brands WHERE lang = '$lang';");
    $specials   = $wpdb->get_results( "SELECT * FROM ".ASL_PREFIX."specials WHERE lang = '$lang';");
    $countries  = $wpdb->get_results("SELECT * FROM ".ASL_PREFIX."countries");

    $fields = $this->_get_custom_fields();
    
    include ASL_PLUGIN_PATH.'admin/partials/add_store.php';    
  }


  /**
   * [admin_dashboard Plugin Dashboard]
   * @return [type] [description]
   */
  public function admin_dashboard() {

    $this->_enqueue_scripts();
    
    global $wpdb;

    $sql = "SELECT `key`,`value` FROM ".ASL_PREFIX."configs WHERE `key` = 'api_key'";
    $all_configs_result = $wpdb->get_results($sql);

    $all_configs = array('api_key' => $all_configs_result[0]->value);
    $all_stats = array();
    
    $temp = $wpdb->get_results( "SELECT count(*) as c FROM ".ASL_PREFIX."markers");;
    $all_stats['markers']  = $temp[0]->c; 

    $temp = $wpdb->get_results( "SELECT count(*) as c FROM ".ASL_PREFIX."stores");;
    $all_stats['stores']    = $temp[0]->c;

  
    $temp = $wpdb->get_results( "SELECT count(*) as c FROM ".ASL_PREFIX."categories");;
    $all_stats['categories'] = $temp[0]->c;

    $temp = $wpdb->get_results( "SELECT count(*) as c FROM ".ASL_PREFIX."stores_view");;
    $all_stats['searches'] = $temp[0]->c;


    include ASL_PLUGIN_PATH.'admin/partials/dashboard.php';    
  }

  /**
   * [get_stat_by_month Get the Stats of the Analytics]
   * @return [type] [description]
   */
  public function get_stat_by_month() {

    global $wpdb;

    $month  = isset($_REQUEST['m'])? intval($_REQUEST['m']): date('m');
    $year   = isset($_REQUEST['y'])? intval($_REQUEST['y']): date('y');
    
    
    //  Either Chart or Top Views
    $stats_type   = sanitize_text_field($_REQUEST['stat_type']);

    $c_m  = date('m');
    $c_y  = date('y');

    
    if(!$month || is_nan($month)) {

      //Current
      $month = $c_m;
    }

    if(!$year || is_nan($year)) {

      //Current
      $year = $c_y;
    }



    $date = intval(date('d'));


    if($stats_type == 'chart') {

      //Not Current Month
      if($month != $c_m && $year != $c_y) {

        /*Month last date*/
        $a_date = "{$year}-{$month}-1";
        $date   = date("t", strtotime($a_date));
      }
      

      //WHERE YEAR(created_on) = YEAR(NOW()) AND MONTH(created_on) = MONTH(NOW())
      $results = $wpdb->get_results("SELECT DAY(created_on) AS d, COUNT(*) AS c FROM `".ASL_PREFIX."stores_view`  WHERE YEAR(created_on) = {$year} AND MONTH(created_on) = {$month} GROUP BY DAY(created_on)");

      
      
      $days_stats = array();

      for($a = 1; $a <= $date; $a++) {

        $days_stats[(string)$a] = 0; 
      }

      foreach($results as $row) {

        $days_stats[$row->d] = $row->c;
      }
    
      echo json_encode(array('data'=>$days_stats));die;
    }
    else {
    
      $limit      = (isset($_REQUEST['len']) && $_REQUEST['len'])? intval($_REQUEST['len']): null;

      //top views
      $top_stores = $wpdb->get_results("SELECT COUNT(*) AS views,".ASL_PREFIX."stores_view.`store_id`, title, city FROM `".ASL_PREFIX."stores_view` LEFT JOIN `".ASL_PREFIX."stores` ON ".ASL_PREFIX."stores_view.`store_id` = ".ASL_PREFIX."stores.`id` WHERE store_id IS NOT NULL AND YEAR(".ASL_PREFIX."stores_view.created_on) = {$year} AND MONTH(".ASL_PREFIX."stores_view.created_on) = {$month} GROUP BY store_id ORDER BY views".(($limit)?'  DESC LIMIT '.$limit: ''));
      
      //  Top Searches    
      $top_search = $wpdb->get_results("SELECT COUNT(*) AS views, search_str FROM `".ASL_PREFIX."stores_view` WHERE store_id IS NULL AND is_search = 1 AND YEAR(created_on) = {$year} AND MONTH(created_on) = {$month} GROUP BY search_str ORDER BY views".(($limit)?'  DESC LIMIT '.$limit: ''));



      echo json_encode(['stores' => $top_stores, 'searches' => $top_search]);die;
    }
  }


  /**
   * [admin_delete_all_stores Delete All Stores, Logos and Category Relations]
   * @return [type] [description]
   */
  public function admin_delete_all_stores() {
    
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

    $response = new \stdclass();
    $response->success = false;
    
    global $wpdb;
    $prefix = ASL_PREFIX;
        
        $wpdb->query("TRUNCATE TABLE `{$prefix}stores_categories`");
        $wpdb->query("TRUNCATE TABLE `{$prefix}stores`");
        //$wpdb->query("TRUNCATE TABLE `{$prefix}storelogos`");
      
      $response->success  = true;
      $response->msg      = esc_attr__('All Stores are deleted','asl_admin');

      echo json_encode($response);die;
  }

  /**
   * [validate_api_key Validateyour Google API Key]
   * @return [type] [description]
   */
  public function validate_api_key() {

    global $wpdb;

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    

    $response = new \stdclass();
    $response->success = false;

    //Get the API KEY
    $sql      = "SELECT `key`,`value` FROM ".ASL_PREFIX."configs WHERE `key` = 'server_key'";
    $configs_result = $wpdb->get_results($sql);

    if(isset($configs_result) && isset($configs_result[0])) {

      $api_key    = $configs_result[0]->value;

      if($api_key) {

        //Test Address
        $street   = '1848 Provincial Road';
        $city     = 'Winsdor';
        $state    = 'ON';
        $zip      = 'N8W 5W3';
        $country  = 'Canada';

        $_address = $street.', '.$zip.'  '.$city.' '.$state.' '.$country;

        $results = AgileStoreLocator_Helper::getLnt($_address, $api_key, true);

        $response->result = $results;

        if($results && isset($results['body'])) {

          $results  = json_decode($results['body'], true);
          
          if(isset($results['error_message'])) {

            $response->msg    = $results['error_message'];
          }
          else {

            $response->msg     = esc_attr__('Valid API Key','asl_admin'); 
            $response->success = true;  
          }
        }

        //$response->msg    = esc_attr__('API Key is Valid','asl_admin');
        
      }
      else
        $response->msg = esc_attr__('Server Google API Key is Missing','asl_admin');
    }
    else
        $response->msg = esc_attr__('Server Google API Key is not saved.','asl_admin');

    echo json_encode($response);die;
  }

  /**
   * [save_custom_fields Save Custom Fields AJAX]
   * @return [type] [description]
   */
  public function save_custom_fields() {

    global $wpdb;
    $prefix = ASL_PREFIX;

    $response  = new \stdclass();
    $response->success = false;

    $fields = isset($_POST['fields'])? ($_POST['fields']): [];

    //  Filter the JSON for XSS
    $filter_fields = [];

    foreach($fields as $field_key => $field) {

      $field_key = strip_tags($field_key);

      $field['type']  = strip_tags(sanitize_text_field($field['type']));
      $field['name']  = strip_tags(sanitize_text_field($field['name']));
      $field['label'] = strip_tags(sanitize_text_field($field['label']));

      $filter_fields[$field_key] = $field;
    }

    $c = $wpdb->get_results("SELECT count(*) AS 'count' FROM {$prefix}settings WHERE `type` = 'fields'");

    $data_params = array('content' => json_encode($filter_fields), 'type'=> 'fields');


    if($c[0]->count  >= 1) {
      $wpdb->update($prefix."settings", $data_params, array('type'=> 'fields'));
    }
    else {
      $wpdb->insert($prefix."settings", $data_params);
    }

    /*$wpdb->show_errors = true;
    $response->error = $wpdb->print_error();
    $response->error1 = $wpdb->last_error;*/

    

  $response->msg     = esc_attr__("Fields has been updated successfully.",'asl_admin');
  $response->success = true;

        
    echo json_encode($response);die;
  }


  /**
   * [admin_manage_categories Manage Categories]
   * @return [type] [description]
   */
  public function admin_manage_categories() {

    $this->_enqueue_scripts();

    include ASL_PLUGIN_PATH.'admin/partials/categories.php';
  }

  /**
   * [admin_store_markers Manage Markers]
   * @return [type] [description]
   */
  public function admin_store_markers() {
    
    $this->_enqueue_scripts();

    include ASL_PLUGIN_PATH.'admin/partials/markers.php';
  }


  /**
   * [admin_store_logos Manage Logos]
   * @return [type] [description]
   */
  public function admin_store_logos() {

    $this->_enqueue_scripts();

    include ASL_PLUGIN_PATH.'admin/partials/logos.php';
  }
  
  /**
   * [admin_manage_store Manage Stores]
   * @return [type] [description]
   */
  public function admin_manage_store() {

    global $wpdb;
    $prefix = ASL_PREFIX;

    $this->_enqueue_scripts();


    $pending_stores = $this->pending_store_count();

    // Field Columns
    $field_columns = array(
      '2' => 'ID',
      '3' => 'Title',
      '4' => 'Lat',
      '5' => 'Lng',
      '6' => 'Street',
      '7' => 'State',
      '8' => 'City',
      '9' => 'Phone',
      '10' => 'Email',
      '11' => 'URL',
      '12' => 'Zip',
      '13' => 'Disabled',
      '14' => 'Categories',
      '15' => 'Marker',
      '16' => 'Logo',
      '17' => 'Created'
    );

    $hidden_fields = $wpdb->get_results("SELECT `content` FROM {$prefix}settings WHERE `type` = 'hidden'");


    if($hidden_fields && isset($hidden_fields[0])) {

      $hidden_fields = $hidden_fields[0]->content;
    }
    else
        $hidden_fields = [];


    include ASL_PLUGIN_PATH.'admin/partials/manage_store.php';
  }

  /**
   * [admin_import_stores Admin Import Store Page]
   * @return [type] [description]
   */
  public function admin_import_stores() {

    $this->_enqueue_scripts();

    //Check if ziparhive is installed
    global $wpdb;

    //Get the API KEY
    $sql      = "SELECT `key`,`value` FROM ".ASL_PREFIX."configs WHERE `key` = 'server_key'";
    $configs_result = $wpdb->get_results($sql);

    $api_key    = '';

    if(isset($configs_result[0]) && $configs_result[0]->value) {
        $api_key = $configs_result[0]->value;
    } 
    else 
      $api_key = esc_attr__('Google API Key is Missing','asl_admin');



    include ASL_PLUGIN_PATH.'admin/partials/import_store.php';
  }


  /**
   * [admin_customize_map Customize the Map Page]
   * @return [type] [description]
   */
  public function admin_customize_map() {

    $this->_enqueue_scripts();

    global $wpdb;

    $sql = "SELECT `key`,`value` FROM ".ASL_PREFIX."configs WHERE `key` = 'api_key' OR `key` = 'default_lat' OR `key` = 'default_lng' ORDER BY id;";
    $all_configs_result = $wpdb->get_results($sql);

    
    $config_list = array();
    foreach($all_configs_result as $item) {
      $config_list[$item->key] = $item->value;
    }

    $all_configs = array('api_key' => $config_list['api_key'],'default_lat' => $config_list['default_lat'],'default_lng' => $config_list['default_lng']);
    

    $map_customize  = $wpdb->get_results("SELECT content FROM ".ASL_PREFIX."settings WHERE type = 'map' AND id = 1");
    $map_customize  = ($map_customize && $map_customize[0]->content)?$map_customize[0]->content:'[]';


    //add_action( 'init', 'my_theme_add_editor_styles' );
    include ASL_PLUGIN_PATH.'admin/partials/customize_map.php';
  }

  /**
   * [addSlugs Add Slug to existing rows]
   */
  private function addSlugs() {

    global $wpdb;

    $ASL_PREFIX = ASL_PREFIX;
    $query      = "SELECT s.`id`, `title`,  `description`, `street`,  `city`,  `state`, `postal_code`, `lat`,`lng`,`phone`,  `fax`,`email`,`website`,`logo_id`,`marker_id`,`description_2`,`open_hours`, `ordr`,`brand`, `custom`, `slug` FROM {$ASL_PREFIX}stores as s";

    $all_results = $wpdb->get_results($query);
    
    //  Generate Slug
    
    
    foreach ($all_results as $store ) {
      
      $a_store = (Array) $store;
      $slug    = AgileStoreLocator_Helper::slugify($a_store);

      //update into stores table
      $wpdb->update($ASL_PREFIX."stores", array('slug' => $slug),array('id' => $a_store['id']));
    }
    
  }


  /**
   * [execute_the_cron Execute the Cron Job]
   * @return [type] [description]
   */
  public function execute_the_cron() {

    global $wpdb;
    
    ini_set('memory_limit', '256M');
    ini_set('max_execution_time', 0);

    $type   = 'cron_timestamp';

    //  Check the cron import directory
    $dir    = ASL_UPLOAD_DIR.'cron/';
    
    //  CREATE the CRON Directory
    if(!file_exists($dir)) {
      
      mkdir( $dir, 0775, true );
      return;
    }

    $files      = scandir($dir);

    //  Get the last run timestamp of cronjob
    $cron_stamp = AgileStoreLocator_Helper::get_setting($type);

    //  When doesn't exist, give a starting value
    if(!$cron_stamp)
      $cron_stamp = '1627295426';

    //  Summaries of the processed files
    $import_file_counts = 0;
    $summaries          = [];
      
    //  Loop over the files
    foreach($files as $file) {

      //  not the directories
      if($file != '.' && $file != '..') {

        // These are the default files and should not be processed
        //if($file == 'demo-import.csv' || $file == 'import-url-demo.csv') {continue;}

        //  Verify file must be a CSV
        $file_extension  = pathinfo($dir.$file, PATHINFO_EXTENSION);
        
        // Only the CSV file
        if($file_extension != 'csv') {continue;}

        //  When this file is modified
        $file_modified_date = filectime($dir.$file);

        //dd(($file_modified_date > $cron_stamp)? 'True': 'False');
        //  When the timestamp of the file is greater, process it
        if($file_modified_date > $cron_stamp) {

          $summary = $this->import_store($file, true);

          $summary->file  = $file;

          $summaries[]    = $summary;

          $import_file_counts++;
        }
      }
    }

    //  Update the Last Run timestamp of cronjob
    if($cron_stamp && $cron_stamp > 0){
      
      AgileStoreLocator_Helper::set_setting(time(), $type);
    }

    //  Process the summaries when we have imports
    if($import_file_counts > 0) {
      $this->_cron_notification($summaries);
    }

    return;
  }


  /**
   * [_cron_notification Send the notification to the owner about the cron import]
   * @param  [type] $summaries [description]
   * @return [type]            [description]
   */
  private function _cron_notification($summaries) {

    global $wpdb;

    $configs = $wpdb->get_results("SELECT * FROM ".ASL_PREFIX."configs WHERE `key` = 'admin_notify' OR `key` = 'notify_email'");

    $all_configs = array();
    
    foreach($configs as $_config)
      $all_configs[$_config->key] = $_config->value;

    
    //   Validate the admin notification checkbox is enabled
    if(isset($all_configs['admin_notify']) && $all_configs['admin_notify'] == '1') {


      $admin_email = (isset($all_configs['notify_email']) && $all_configs['notify_email'])? $all_configs['notify_email']: null;


      //  Check if the admin email is there
      if($admin_email) {


        // Prepare the summary
        $HTML = '';
        $total_imports = count($summaries);

        foreach($summaries as $summary) {

          // Check the rows imported
          $HTML .= '<div class="summary-row"><p><b>Import File Name: '.$summary->file.'</b></p><p>Total rows imported: '.$summary->imported_rows.'</p>';

          //  When we have a summary
          if(!empty($summary->summary)) {
            $HTML .= '<p>Summary: '.implode(', ', $summary->summary).'</p>';
          }
        }

        $subject = esc_attr__("Store Locator Cron Imported Files: ", 'asl_locator').$total_imports;
        $headers = array('Content-Type: text/html; charset=UTF-8');

        wp_mail($admin_email, $subject, $HTML, $headers);
      }

    }
  }

  /**
   * [manage_cache Refresh the JSON]
   * @return [type] [description]
   */
  public function manage_cache() {

    global $wpdb;

    $response = new \stdclass();
    $response->success = false;


    $cache_status = (isset($_REQUEST['status']) && $_REQUEST['status'] == '1')?'1':'0';
    $cache_lang   = (isset($_REQUEST['lang']))? sanitize_text_field($_REQUEST['lang']): null;

    //  Todo, Make sure the folder exist?
    if(!file_exists(ASL_UPLOAD_DIR)) {
      mkdir( ASL_UPLOAD_DIR, 0775, true );
    }

    if(!$cache_lang) {
      $response->error = esc_attr__('Error! Lang is not defined.','asl_admin');;
    }

    //  en_US is default
    if($cache_lang == 'en_US')
      $cache_lang = '';


    //  JSON file
    $json_file = 'locator-data'.(($cache_lang)?'-'.$cache_lang: '').'.json';

    //  Generate the JSON file when enabled
    if($cache_status == '1') {

      //  Generate the Output
      $public_request = new AgileStoreLocator_Request();
      $output_result  = $public_request->load_stores(true, $cache_lang);

      //  Save the output
      $response->output   = file_put_contents(ASL_UPLOAD_DIR.$json_file, json_encode($output_result));

      //  When fails
      if(!$response->output) {
        $response->path   = ASL_UPLOAD_DIR.$json_file;
      }

      $response->msg      = esc_attr__('Cache JSON has been generated successfully for language '.$cache_lang,'asl_admin');

    }
    else
      $response->msg      = esc_attr__('Cache JSON is disabled for language '.$cache_lang,'asl_admin');


    //  Save the cache settings
    $this->change_options(true);

    //  Show as success
    $response->success  = true;
  
    echo json_encode($response);die;
  }

  
  /**
   * [admin_user_settings ASL Settings Page]
   * @return [type] [description]
   */
  public function admin_user_settings() {
     
    $this->_enqueue_scripts();

    // CodeMirror Enqueue
    if(function_exists('wp_enqueue_code_editor'))
      wp_enqueue_code_editor(array('type' => 'text/html'));

    global $wpdb;

    //  Get the Cache Settings
    $cache_settings = AgileStoreLocator_Helper::getSettings('cache');

    //  make it empty array when not saved
    if(!$cache_settings) {
      $cache_settings = [];
    }

    //  Langs
    $active_langs   = AgileStoreLocator_Helper::getLangControl(true);

    ///////////////////////////////////////
    //  Check the upgrade is done or not? //
    ///////////////////////////////////////
    require_once ASL_PLUGIN_PATH . 'includes/class-agile-store-locator-activator.php';
    AgileStoreLocator_Activator::validate_configs();

    
    $sql = "SELECT `key`,`value` FROM ".ASL_PREFIX."configs";
    $all_configs_result = $wpdb->get_results($sql);
    
    $all_configs = array();
    foreach($all_configs_result as $config)
    {
      $all_configs[$config->key] = $config->value;  
    }

    ///get Countries
    $countries        = $wpdb->get_results("SELECT country,iso_code_2  as code FROM ".ASL_PREFIX."countries");
    
    $custom_map_style = $wpdb->get_results("SELECT * FROM ".ASL_PREFIX."settings WHERE `name` = 'map_style'");

    //  Do we have custom map?
    if($custom_map_style && $custom_map_style[0]) {

      $custom_map_style = $custom_map_style[0]->content;
    }

    // Remove Google Script tags
    $all_configs['remove_maps_script'] = get_option('asl-remove_maps_script');


    //  Get the Custom Fields
    $fields = $this->_get_custom_fields();

    include ASL_PLUGIN_PATH.'admin/partials/user_setting.php';
  }



  /**
   * [rewrite_slug ASL Settings Page]
   * @return [type] [description]
   *
   * Pretty URL for the Store Locator
   */
  public function rewrite_slug(){

  global $wpdb;

   $config    = AgileStoreLocator_Helper::get_configs(['rewrite_slug','rewrite_id']);


   $slug      = isset($config['rewrite_slug'])? $config['rewrite_slug']: null;
   $page_id   = isset($config['rewrite_id'])? $config['rewrite_id']: null;

   // Make sure values exist
   if($slug && $page_id)
    add_rewrite_rule('^'.$slug.'/?([^/]*)/?','index.php?page_id='.$page_id.'&sl-store=$matches[1]','top');
  }


  /**
   * [rewrite_query_vars ASL Settings Page]
   * @return [type] [query_vars]
   * 
   * Whitelist the Variable 
   */
  function rewrite_query_vars($query_vars){
      
      $query_vars[] = 'sl-store';

      return $query_vars;
  }


  /**
   * [kml_file_filter Allow the KML file]
   * @param  [type] $mimes [description]
   * @return [type]        [description]
   */
  public function kml_file_filter( $mimes ) {
 
    // New allowed mime types.
    $mimes['kmz']  = 'application/vnd.google-earth.kmz';
    $mimes['kml']  = 'application/vnd.google-earth.kml+xml';
    
    return $mimes;
  }


  /**
   * [localize_scripts description]
   * @param  [type] $script_name [description]
   * @param  [type] $variable    [description]
   * @param  [type] $data        [description]
   * @return [type]              [description]
   */
  private function localize_scripts($script_name, $variable, $data) {

    $this->scripts_data[] = [$variable, $data]; 
  }


  /**
   * [get_local_script_data Render the scripts data]
   * @return [type] [description]
   */
  private function get_local_script_data($with_tags = false) {

    $scripts = '';

    foreach ($this->scripts_data as $script_data) {
        
      $scripts .= 'var '.$script_data[0].' = '.(($script_data[1] && !empty($script_data[1]))?json_encode($script_data[1]): "''").';';
    }

    //  With script tags
    if($with_tags) {

      $scripts = "<script type='text/javascript' id='agile-store-locator-script-js'>".$scripts."</script>";
    }

    //  Clear it
    $this->scripts_data = [];

    return $scripts;
  }

}

