<?php
/**
 * @author Ahmad Alsodani.
 * @date 6/4/18
 * @time 8:56 AM
 * @description
 */

if ( ! defined( AMX_WOOCOMMERCE_TAX_COUPONS ) ) {
	define( 'AMX_WOOCOMMERCE_TAX_COUPONS' , __FILE__ );
}

if ( ! defined( AMX_WOOCOMMERCE_TAX_COUPONS_VERSION ) ) {
	define( 'AMX_WOOCOMMERCE_TAX_COUPONS_VERSION' , '1.0.0' );
}

if ( ! defined( AMX_WOOCOMMERCE_TAX_COUPONS_ABS ) ) {
	define( 'AMX_WOOCOMMERCE_TAX_COUPONS_ABS' , dirname( AMX_WOOCOMMERCE_TAX_COUPONS ) );
}

if ( ! defined( AMX_DATE_FORMAT ) ) {
	define( 'AMX_DATE_FORMAT' , 'd/m/Y' );
}

if( ! defined( AMX_WOOCOMMERCE_TAX_COUPONS_TEXT_DOMAIN ) ){
	define( 'AMX_WOOCOMMERCE_TAX_COUPONS_TEXT_DOMAIN' , 'woocommerce-taxonomies-coupons' );
}

/**
 * @param $directory
 */
function amx_load_files_from_directory( $directory ) {
	if ( ! file_exists( AMX_WOOCOMMERCE_TAX_COUPONS_ABS . '/' . $directory ) ) {
		return;
	}
	$path  = AMX_WOOCOMMERCE_TAX_COUPONS_ABS . '/' . $directory . '/*.php';
	$files = glob( $path );
	if ( ! is_null( $files ) AND is_array( $files ) AND count( $files ) > 0 ) {
		foreach ( $files as $file ) {
			/** @noinspection PhpIncludeInspection */
			require_once $file;
		}
	}
}

function amx_load_files() {
	amx_load_files_from_directory( 'includes' );
}

amx_load_files();