<?php
/**
 * @author Ahmad Alsodani.
 * @date 6/4/18
 * @time 9:18 AM
 * @description
 */

final class WooCommerceTaxonomiesCoupons {

	/**
	 * WooCommerceTaxonomiesCoupons constructor.
	 */
	public function __construct() {

		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	/**
	 *
	 */
	public function define_admin_hooks() {
		add_action( 'add_meta_boxes' , [ $this , 'create_meta_box' ] );
		add_action( 'save_post_shop_coupon' , [ $this , 'save_coupon' ] );
	}

	/**
	 * @param $coupon_id
	 */
	public function save_coupon( $coupon_id ) {
		$this->save_coupon_meta( $coupon_id , $_POST );
	}

	/**
	 * @param $coupon_id
	 * @param $data
	 */
	public function save_coupon_meta( $coupon_id , $data ) {
		if ( ! isset( $data[ 'woo_coupon' ] ) || ! wp_verify_nonce( $data[ 'woo_coupon' ] , 'woo_coupon' ) ) {
			return;
		}
		if ( ! is_null( $data[ 'enable-woo-tax-coupon' ] ) && $data[ 'enable-woo-tax-coupon' ] === 'on' ) {
			update_post_meta( $coupon_id , 'amx_tax_enabled' , 'yes' );
			update_post_meta( $coupon_id , 'amx_products_taxonomies' , $data[ 'selected_taxonomies' ] );
		} else {
			update_post_meta( $coupon_id , 'amx_tax_enabled' , 'no' );
		}
	}

	/**
	 *
	 */
	public function create_meta_box() {
		global $post;
		add_meta_box(
			'woo-tax-coupon' ,
			'Coupon' ,
			[ $this , 'create_meta_box_html' ] ,
			'shop_coupon'
		);
	}

	/**
	 * @param $coupon WP_Post
	 */
	public function create_meta_box_html( $coupon ) {
		$options = get_post_meta( $coupon->ID , 'amx_tax_enabled' , true );
		echo ( new Amx_View_Maker() )->create_meta_box_html( $coupon , $options );
	}

	/**
	 *
	 */
	public function define_public_hooks() {

	}

}


