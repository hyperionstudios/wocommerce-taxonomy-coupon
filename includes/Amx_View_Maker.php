<?php
/**
 * @author Ahmad Alsodani.
 * @date 6/4/18
 * @time 9:30 AM
 * @description
 */


class Amx_View_Maker {

	/**
	 * @param $coupon WP_Post
	 *
	 * @param bool $options
	 *
	 * @return string
	 */
	public function create_meta_box_html( $coupon , $options ) {
		$taxonomy_objects = get_object_taxonomies( 'product' , 'objects' );
		$metaData         = get_post_meta( $coupon->ID , 'amx_products_taxonomies' , true );
		$all_terms        = [];
		foreach ( $taxonomy_objects as $taxonomy_object ) {
			$tax       = $taxonomy_object->name;
			$terms     = get_terms( array(
				'taxonomy'   => $tax ,
				'hide_empty' => false ,
			) );
			$all_terms = array_merge( $all_terms , $terms );
		}

		ob_start(); ?>
        <div class="options_group">
			<?php wp_nonce_field( 'woo_coupon' , 'woo_coupon' ); ?>
            <table class="wp-list-table widefat fixed striped pages">
                <tr>
                    <td><label for="free_shipping">Enable WooCommerce Taxonomies Coupon For This Coupon? </label></td>
                    <td><input type="checkbox" class="checkbox" name="enable-woo-tax-coupon" id="enable-woo-tax-coupon"
                               data-checked="<?php echo $options; ?>" <?php if ( $options === 'yes' ) {
							echo 'checked';
						} ?> /></td>
                </tr>
            </table>
            <br>
            <table class="wp-list-table widefat fixed striped pages" id="if_product_tax_enabled">

                <tr>
                    <td><label for="woo-tax-cop-select">Select Taxonomies</label></td>
                    <td>
                        <select multiple="multiple" class="coupon-taxonomy" id="selected-taxonomies"
                                style="width: 100%;" name="selected_taxonomies[]">
                            <option></option>
							<?php if ( is_array( $metaData ) ): ?>
								<?php foreach ( $all_terms as $term ) : ?>
									<?php if ( in_array( $term->term_id , $metaData ) ): ?>
                                        <option selected
                                                value="<?php echo $term->term_id ?>"><?php echo $term->name ?></option>
									<?php else: ?>
                                        <option value="<?php echo $term->term_id ?>"><?php echo $term->name ?></option>
									<?php endif; ?>
								<?php endforeach; ?>
							<?php else: ?>
								<?php foreach ( $all_terms as $term ) : ?>
                                    <option value="<?php echo $term->term_id ?>"><?php echo $term->name ?></option>
								<?php endforeach; ?>
							<?php endif; ?>
                        </select>
                    </td>
                </tr>

            </table>

        </div>


        <script>
            jQuery(document).ready(function ($) {
                $('.coupon-taxonomy').select2({
                    placeholder: 'Select ...',
                    multiple: true,
                    dropdownAutoWidth: true,
                    allowClear: true
                });

                $("#enable-woo-tax-coupon").change(function () {
                    if (this.checked) {
                        $('#if_product_tax_enabled').slideDown();
                    } else {
                        // TODO : Clear the Input and hide
                        $('#if_product_tax_enabled').slideUp();
                    }
                });

				<?php if ( $options === 'yes' ) : ?>
                $('#if_product_tax_enabled').slideDown();
				<?php else : ?>
                $('#if_product_tax_enabled').slideUp();
				<?php endif; ?>
            });
        </script>

		<?php $html = ob_get_contents();
		ob_clean();

		return $html;
	}

}