<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.9.0
 */

defined( 'ABSPATH' ) || exit;



do_action( 'woocommerce_before_cart' ); ?>

<div class="w-full main-content-width flex flex-col items-center lg:flex-row justify-center gap-8 lg:items-start sm:px-24 lg:p-0 px-4">
	<form class="woocommerce-cart-form w-full lg:w-[600px]" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
		<?php do_action( 'woocommerce_before_cart_table' ); ?>
	
		<div class="shop_table cart woocommerce-cart-form__contents bg-[#F9F7F3] border-[1px] border-neutral-200" cellspacing="0">
	
			<div class="">
				<?php do_action( 'woocommerce_before_cart_contents' ); ?>
	
				<?php
				foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
					$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
					$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
					/**
					 * Filter the product name.
					 *
					 * @since 2.1.0
					 * @param string $product_name Name of the product in the cart.
					 * @param array $cart_item The product in the cart.
					 * @param string $cart_item_key Key for the product in the cart.
					 */
					$product_name = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
	
					if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
						$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
						?>
						<div class="woocommerce-cart-form__cart-item-2 p-2 border-neutral-200 <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

							<div class="flex flex-col md:flex-row items-start">

									<?php
									$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

									if ( ! $product_permalink ) {
										echo $thumbnail; // PHPCS: XSS ok.
									} else {
										printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
									}
									?>


								<div class="flex flex-col justify-between h-[150px] md:ml-2 w-full md:w-[450px]">
									<div class="flex flex-row justify-between w-full ">
										<div class="product-name text-start text-wrap w-[80px] md:w-[150px]" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
											<?php
											if ( ! $product_permalink ) {
												echo wp_kses_post( $product_name . '&nbsp;' );
											} else {
												/**
												 * This filter is documented above.
												 *
												 * @since 2.1.0
												 */
												echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
											}
				
												do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );
					
												// Meta data.
												echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.
					
												// Backorder notification.
												if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
													echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
												}
											?>
											
										</div>

										<div class="product-subtotal ml-[100px] md:ml-4" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>">
											<?php
												echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
											?>
										</div>

									</div>

									<div class="product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
										<div class="quantity-wrapper">
											<button type="button" class="qty-btn minus">−</button>

											<?php
											if ( $_product->is_sold_individually() ) {
												$min_quantity = 1;
												$max_quantity = 1;
											} else {
												$min_quantity = 1; // Minimum quantity
												$max_quantity = $_product->get_max_purchase_quantity(); // Max quantity
											}

											echo woocommerce_quantity_input(
												array(
													'input_name'   => "cart[{$cart_item_key}][qty]",
													'input_value'  => $cart_item['quantity'],
													'max_value'    => $max_quantity,
													'min_value'    => $min_quantity,
													'step'         => 1, // Quantity change step
													'product_name' => $product_name,
												),
												$_product,
												false
											);
											?>

											<button type="button" class="qty-btn plus">+</button>
										</div>
									</div>

								</div>
							</div>

							<?php
								echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
									'woocommerce_cart_item_remove_link',
									sprintf(
										'<a href="%s" class="Remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">remove</a>',
										esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
										/* translators: %s is the product name */
										esc_attr( sprintf( __( 'Remove %s from cart', 'woocommerce' ), wp_strip_all_tags( $product_name ) ) ),
										esc_attr( $product_id ),
										esc_attr( $_product->get_sku() )
									),
									$cart_item_key
								);
							?>


<!--
						<td class="product-price" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
							<?php
								echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
							?>
						</td>
					-->
	
							
						</div>

						<div class="w-full h-[1px] bg-neutral-200"></div>
						<?php
					}
				}
				?>
	
				<?php do_action( 'woocommerce_cart_contents' ); ?>
	
				<div class="p-2 w-full flex flex-col md:flex-row gap-4 custom-cart-coupon">

	
						<?php if ( wc_coupons_enabled() ) { ?>
							<div class="coupon">
								<label for="coupon_code" class="screen-reader-text"><?php esc_html_e( 'Coupon:', 'woocommerce' ); ?></label> <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" /> <button type="submit" class="button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_html_e( 'Apply coupon', 'woocommerce' ); ?></button>
								<?php do_action( 'woocommerce_cart_coupon' ); ?>
							</div>
						<?php } ?>
	
						<button type="submit" class="button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>
	
						<?php do_action( 'woocommerce_cart_actions' ); ?>
	
						<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>

				</div>
	
				<?php do_action( 'woocommerce_after_cart_contents' ); ?>
			</div>
		</div>
	
		<?php do_action( 'woocommerce_after_cart_table' ); ?>
	</form>
	
	<?php
		if ( WC()->cart ) :
			$cart_subtotal = WC()->cart->get_cart_subtotal(); // Formatted subtotal
			$cart_total = WC()->cart->get_total(); // Formatted total
			$checkout_url = wc_get_checkout_url(); // Checkout URL
			?>
			<div class="flex flex-col w-full lg:w-[300px]">

				<div class="custom-cart-summary bg-[#F9F7F3]  border-[1px] border-neutral-200">
					<p class="cart-subtotal p-2 border-b-[1px] border-neutral-200">
						<strong>Subtotal:</strong> <?php echo $cart_subtotal; ?>
					</p>
	
					<p class="cart-total p-2">
						<strong>Total:</strong> <?php echo $cart_total; ?>
					</p>
	
				</div>

				<div class="h-8"></div>
				
				<a href="<?php echo esc_url( $checkout_url ); ?>" class=" wc-forward checkout-button-1">
					Proceed to Checkout
				</a>
			</div>

	<?php endif; ?>


</div>


<?php do_action( 'woocommerce_after_cart' ); ?>


<style>
	@media (min-width:1024px ){
		.entry-header {
			margin-left: 55px;
		}
	}

	@media (max-widthL1024px){
		.entry-header {
			margin-left: 16px;
		}
	}
	
</style>

<script>
jQuery(document).ready(function($) {
    // Event delegation for dynamic elements
    $(document).on('click', '.qty-btn', function() {
        var $button = $(this); // The button clicked (either minus or plus)
        var $input = $button.closest('.quantity-wrapper').find('input.qty'); // Find the closest input element
        var currentValue = parseInt($input.val(), 10); // Convert the value to an integer (base 10)
        var minQuantity = parseInt($input.attr('min'), 10); // Minimum allowed quantity
        var maxQuantity = parseInt($input.attr('max'), 10); // Maximum allowed quantity
        var step = parseInt($input.attr('step'), 10); // Step value (should be 1)

        // Set a fallback value for maxQuantity if it's NaN
        if (isNaN(maxQuantity)) {
            maxQuantity = Infinity; // Set it to a very large value if max is missing or invalid
        }

        // Ensure we increase or decrease by exactly 1
        if ($button.hasClass('minus')) {
            // Decrease the value but not below minQuantity
            if (currentValue > minQuantity) {
                $input.val(currentValue - 1);  // Decrease by 1
                $input.trigger('input'); // Trigger input event
            }
        } else if ($button.hasClass('plus')) {
            // Increase the value but not above maxQuantity
            if (currentValue < maxQuantity) {
                $input.val(currentValue + 1);  // Increase by 1
                $input.trigger('input'); // Trigger input event
            }
        }
    });
});
</script>