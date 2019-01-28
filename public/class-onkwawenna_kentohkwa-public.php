<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    onkwawenna_kentohkwa
 * @subpackage onkwawenna_kentohkwa/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    onkwawenna_kentohkwa
 * @subpackage onkwawenna_kentohkwa/public
 * @author     Your Name <email@example.com>
 */
class onkwawenna_kentohkwa_Public {

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
	 * @param      string    $onkwawenna_kentohkwa       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $onkwawenna_kentohkwa, $version ) {

		$this->onkwawenna_kentohkwa = $onkwawenna_kentohkwa;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->onkwawenna_kentohkwa, plugin_dir_url( __FILE__ ) . 'css/onkwawenna_kentohkwa-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->onkwawenna_kentohkwa, plugin_dir_url( __FILE__ ) . 'js/onkwawenna_kentohkwa-public.js', array( 'jquery' ), mt_rand(10,1000), false );

	}

    public function onkwawenna_kentohkwa_replace_images($content) {
       $imagesJPG = get_attached_media('image/png', get_the_ID());
       $imagesPNG = get_attached_media('image/jpeg', get_the_ID());
       $images = array_merge($imagesJPG, $imagesPNG);

       $new_content = $content;

       foreach($images as $image) {
        $filename = substr($image->guid, strrpos($image->guid, '/') + 1);
        $new_content = str_replace('images/'.$filename, $image->guid, $new_content);
       }
       return $new_content;
    }

}
