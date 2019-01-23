<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    onkwawenna_kentohkwa
 * @subpackage onkwawenna_kentohkwa/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    onkwawenna_kentohkwa
 * @subpackage onkwawenna_kentohkwa/admin
 * @author     Your Name <email@example.com>
 */
class onkwawenna_kentohkwa_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $onkwawenna_kentohkwa    The ID of this plugin.
	 */
	private $onkwawenna_kentohkwa;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $onkwawenna_kentohkwa       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $onkwawenna_kentohkwa, $version ) {

		$this->onkwawenna_kentohkwa = $onkwawenna_kentohkwa;
		$this->version = $version;

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
		 * defined in onkwawenna_kentohkwa_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The onkwawenna_kentohkwa_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->onkwawenna_kentohkwa, plugin_dir_url( __FILE__ ) . 'css/onkwawenna_kentohkwa-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in onkwawenna_kentohkwa_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The onkwawenna_kentohkwa_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->onkwawenna_kentohkwa, plugin_dir_url( __FILE__ ) . 'js/onkwawenna_kentohkwa-admin.js', array( 'jquery' ), $this->version, false );

	}

    public function create_unit()
    {
        register_post_type('unit',
            array(
                'labels' => array(
                    'name' => 'Units',
                    'menu_name' => 'Units',
                    'singular_name' => 'Unit',
                    'add_new' => 'Add New',
                    'add_new_item' => 'Add New Unit',
                    'edit' => 'Edit',
                    'edit_item' => 'Edit Unit',
                    'new_item' => 'New Unit',
                    'view' => 'View',
                    'view_item' => 'View Unit',
                    'search_items' => 'Search Unit',
                    'not_found' => 'No Unit found',
                    'not_found_in_trash' => 'No Unit found in Trash',
                    'parent' => 'Parent Unit',
                ),
                'public' => true,
                'show_in_rest' => true,
                'menu_position' => 15,
                'supports' => array('title', 'editor', 'custom-fields', 'thumbnail', 'excerpt'),
                'taxonomies' => array(''),
                'menu_icon' => 'dashicons-welcome-learn-more',
                'has_archive' => true,
            )
        );

				$set = get_option( 'post_type_rules_flushed_onkwawenna_kentohkwa' );
				if ( $set !== true ){
			    flush_rewrite_rules( false );
			    update_option( 'post_type_rules_flushed_onkwawenna_kentohkwa', true );
				}

				// Disable gutenberg
				function onkwawenna_kentohkwa_disable_gutenberg($is_enabled, $post_type) {
					if ($post_type === 'unit')  {
						return false;
					}
					return $is_enabled;
				}
				add_filter('use_block_editor_for_post_type', 'onkwawenna_kentohkwa_disable_gutenberg', 10, 2);
    }

    /* create backend menu */

    public function upload_units_admin_menu()
    {
        add_menu_page('Upload Units', 'Upload Units', 'manage_options', 'upload-units', function () {
            include 'upload-units.php';
        });
    }

		public function add_onkwawenna_kentohkwa_meta_box( ) {
			add_meta_box(
				'onkwawenna_kentohkwa_upload',
				'Onkwawenna Kentohkwa Media',
				'onkwawenna_kentohkwa_upload',
				'unit',
				'side',
				'low'
			);

		 	function onkwawenna_kentohkwa_upload( $post, $metabox ) {

		 			?>
						<div>
							<p>All media attached to this Unit post is listed here.</p>
							<h4>Images</h4>
							<ul style="list-style-type: disc;">
								<?php
									$imagesJPG = get_attached_media('image/png', get_the_ID());
									$imagesPNG = get_attached_media('image/jpeg', get_the_ID());
									$images = array_merge($imagesJPG, $imagesPNG);
									foreach($images as $image) {
										$filename = substr($image->guid, strrpos($image->guid, '/') + 1);
										echo '<li>' . $filename . '</li>';
									}
								?>
							</ul>
							<hr />
							<h4>Audio</h4>
							<ul style="list-style-type: disc;">
								<?php
									$audios = get_attached_media('audio/mpeg3', get_the_ID());
									foreach($audios as $audio) {
										$filename = substr($audio->guid, strrpos($audio->guid, '/') + 1);
										echo '<li>' . $filename . '</li>';
									}
								?>
							</ul>
						</div>
					<?php
		 	}
		}

}
