<?php

/**
 * Plugin Name:       Social Share & Like
 * Plugin URI:        wprashed.com/plugin
 * Description:       This plugin will help you to tweet your products on twitter and share products on facebook
 * Version:           1.0.0
 * Author:            Md Rashed Hossain
 * Author URI:        wprashed.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       tfsfl
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version..
 */
define( 'TFSFL_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-tfsfl-activator.php
 */
function activate_tfsfl() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-tfsfl-activator.php';
	Tfsfl_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-tfsfl-deactivator.php
 */
function deactivate_tfsfl() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-tfsfl-deactivator.php';
	Tfsfl_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_tfsfl' );
register_deactivation_hook( __FILE__, 'deactivate_tfsfl' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-tfsfl.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_tfsfl() {

	$plugin = new Tfsfl();
	$plugin->run();

}

add_action( 'woocommerce_single_product_summary', 'tfsfl_fb_twitter_single_product', 6 );
 
function tfsfl_fb_twitter_single_product() {
 
   echo '<div>';
 
   echo '<a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-hashtags="apieceofsicily" data-related="apieceofsicily" data-show-count="false">Tweet</a>'; // GET THIS HTML FROM TWITTER DOCS LINK ABOVE
 
   echo '<div class="fb-like" data-href="' . get_permalink() . '" data-width="" data-layout="button_count" data-action="like" data-size="small" data-share="true"></div>'; // GET THIS HTML FROM FACEBOOK DOCS LINK ABOVE BUT KEEP THE get_permalink() PART
 
   echo '</div>';
}
 
add_action( 'wp_footer', 'tfsfl_twitter_facebook_js', 9999 );
 
function tfsfl_twitter_facebook_js() {
 
   if ( is_product() ) {
 
      echo '<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>'; // GET THIS HTML FROM TWITTER DOCS LINK ABOVE
 
      echo '<div id="fb-root"></div><script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v6.0"></script>'; // GET THIS HTML FROM FACEBOOK DOCS LINK ABOVE
 
   }
}

run_tfsfl();
