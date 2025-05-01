<?php
/**
 * Variable product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/variable.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

$attribute_keys  = array_keys( $attributes );
$variations_json = wp_json_encode( $available_variations );
$variations_attr = function_exists( 'wc_esc_json' ) ? wc_esc_json( $variations_json ) : _wp_specialchars( $variations_json, ENT_QUOTES, 'UTF-8', true );

do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form class="variations_form cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo $variations_attr; // WPCS: XSS ok. ?>">
	<?php do_action( 'woocommerce_before_variations_form' ); ?>

	<?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
		<p class="stock out-of-stock"><?php echo esc_html( apply_filters( 'woocommerce_out_of_stock_message', __( 'This product is currently out of stock and unavailable.', 'woocommerce' ) ) ); ?></p>
	<?php else : ?>
		<table class="variations flex flex-col items-start -mt-4" cellspacing="0" role="presentation">
			<tbody>
			<?php 
				// Reverse the order of the attributes before starting the loop
				$attributes = array_reverse( $attributes );

				foreach ( $attributes as $attribute_name => $options ) : 
				?>
					<tr class="flex flex-col items-start mt-[24px]">
						<th class="label">
							<label for="<?php echo esc_attr( sanitize_title( $attribute_name ) ); ?>">
								<?php echo wc_attribute_label( $attribute_name ); // WPCS: XSS ok. ?>
							</label>: 
							<span class="font-normal" id="selected-option-<?php echo sanitize_title( $attribute_name ); ?>">
								<?php 
									// Default value when no selection
									echo esc_html( isset( $_REQUEST['attribute_' . sanitize_title( $attribute_name ) ] ) ? $_REQUEST['attribute_' . sanitize_title( $attribute_name ) ] : 'Choose an option' );
								?>
							</span>
						</th>
						<td class="value">
							<?php
								// Pass the options to the button rendering function
								wc_variation_attribute_buttons(
									array(
										'options'   => $options,
										'attribute' => $attribute_name,
										'product'   => $product,
									)
								);

								/**
								 * Filters the reset variation button.
								 *
								 * @since 2.5.0
								 *
								 * @param string  $button The reset variation button HTML.
								 */
								echo end( $attribute_keys ) === $attribute_name ? wp_kses_post( apply_filters( 'woocommerce_reset_variations_link', '<a class="reset_variations" href="#" aria-label="' . esc_attr__( 'Clear options', 'woocommerce' ) . '">' . esc_html__( 'Clear', 'woocommerce' ) . '</a>' ) ) : '';
							?>
						</td>
					</tr>
				<?php endforeach; ?>

			</tbody>
		</table>
		<div class="reset_variations_alert screen-reader-text" role="alert" aria-live="polite" aria-relevant="all"></div>
		<?php do_action( 'woocommerce_after_variations_table' ); ?>

		<div class="single_variation_wrap">
			<?php
				/**
				 * Hook: woocommerce_before_single_variation.
				 */
				do_action( 'woocommerce_before_single_variation' );

				/**
				 * Hook: woocommerce_single_variation. Used to output the cart button and placeholder for variation data.
				 *
				 * @since 2.4.0
				 * @hooked woocommerce_single_variation - 10 Empty div for variation data.
				 * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
				 */
				do_action( 'woocommerce_single_variation' );

				/**
				 * Add Size Guide Button after the product description
				 */
				add_action( 'woocommerce_after_single_variation', 'add_size_guide_button', 18 );

				// Add product description after the variation details
				add_action( 'woocommerce_after_single_variation', 'add_product_description_after_variation', 20 );

				function add_product_description_after_variation() {
					global $product;
					
					// Check if we are on a variable product page
					if ( $product && $product->is_type( 'variable' ) ) {
						echo '<div class="product-description-after-variation">';
						// echo '<h3>Product Description</h3>';
						echo '<p>' . $product->get_description() . '</p>'; // Display the product description
						echo '</div>';
					}
				}


				/**
				 * Hook: woocommerce_after_single_variation.
				 */
				do_action( 'woocommerce_after_single_variation' );
			?>
		</div>
	<?php endif; ?>

	<?php do_action( 'woocommerce_after_variations_form' ); ?>
</form>

<?php
do_action( 'woocommerce_after_add_to_cart_form' );