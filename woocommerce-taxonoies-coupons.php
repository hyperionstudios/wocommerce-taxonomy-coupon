<?php
/**
 * @link              https://hyperionstudios.com.au/woocommerce-taxonoies-coupons
 * @since             1.0.0
 * @package           woocommerce-taxonoies-coupons
 *
 * @wordpress-plugin
 * Plugin Name:       WooCommerce Custom Taxonomies Coupons
 * Plugin URI:        https://hyperionstudios.com.au/woocommerce-taxonoies-coupons
 * Description:       Issue Coupons for your selected taxonomies including tags,categories and all of your custom taxonomies
 * Version:           1.0.0
 * Author:            Hyperion Studios Digital Solutions
 * Author URI:        https://hyperionstudios.com.au
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       woocommerce-taxonomies-coupons
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

require plugin_dir_path( __FILE__ ) . 'amx-loader.php';