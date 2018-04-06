<?php
/**
 * @author Ahmad Alsodani.
 * @date 6/4/18
 * @time 8:58 AM
 * @description
 */

/**
 *
 */
function amx_display_woocommerce_is_not_active() { ?>
    <div class="error notice">
        <p><?php _e( 'WooCommerce is not Active!, WooCommerce Taxonomies Coupons Requires WooCommerce to Operate.' , 'woocommerce-taxonomies-coupons' ); ?></p>
    </div>
<?php }

/**
 *
 */
function amx_check_dependencies() {
	if ( ! class_exists( 'WooCommerce' ) ) {
		add_action( 'admin_notices' , 'amx_display_woocommerce_is_not_active' );
	} else {
		new WooCommerceTaxonomiesCoupons();
	}
}

add_action( 'plugins_loaded' , 'amx_check_dependencies' );
