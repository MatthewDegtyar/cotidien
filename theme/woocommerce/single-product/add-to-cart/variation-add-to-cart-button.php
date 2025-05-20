<?php
/**
 * Single variation cart button
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined( 'ABSPATH' ) || exit;

global $product;
?>
<div class="woocommerce-variation-add-to-cart variations_button">
	<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

	<?php
	do_action( 'woocommerce_before_add_to_cart_quantity' );

	woocommerce_quantity_input(
		array(
			'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
			'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
			'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
		)
	);

	do_action( 'woocommerce_after_add_to_cart_quantity' );
	?>

	<button type="submit" id="add-to-cart-button"
		class="single_add_to_cart_button button alt<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>">
		<?php echo esc_html( $product->single_add_to_cart_text() ); ?>
	</button>

	<!-- Replacement Button for Unavailable Variation -->
	<button type="button" id="debug-button"
		class=" button alt"
		style="display:none; background: #000;">
		Join Waitlist
	</button>

	<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

	<input type="hidden" name="add-to-cart" value="<?php echo absint( $product->get_id() ); ?>" />
	<input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>" />
	<input type="hidden" name="variation_id" class="variation_id" value="0" />
</div>

<script>
	document.addEventListener('DOMContentLoaded', function () {
    const waitlistOverlay = document.getElementById('waitlist-overlay');

    const variationForm = document.querySelector('form.variations_form');
    const container = document.querySelector('.variations_button');
    const realButton = document.getElementById('add-to-cart-button');
    const waitlistButton = document.getElementById('debug-button');
    const closeOverlayBtn = document.getElementById('close-waitlist-overlay');
	const waitlistOverlayBG = document.getElementById('waitlist-overlay');

    if (!variationForm || !container || !realButton || !waitlistButton) return;

    // Modal logic
    waitlistButton.addEventListener('click', function () {
        waitlistOverlay.style.display = 'flex';
    });

    closeOverlayBtn.addEventListener('click', function () {
        waitlistOverlay.style.display = 'none';
    });
    

    if (waitlistOverlay) {
        document.body.insertBefore(waitlistOverlay, document.body.firstChild);
    }

	// EDITS: 1. Moved contact form outside of product add to cart form

    // Handle variation state
    const updateButtons = () => {
        if (container.classList.contains('woocommerce-variation-add-to-cart-disabled')) {
            realButton.style.display = 'none';
            waitlistButton.style.display = 'inline-block';
        } else {
            realButton.style.display = 'inline-block';
            waitlistButton.style.display = 'none';
        }
    };

    new MutationObserver(updateButtons).observe(container, {
        attributes: true,
        attributeFilter: ['class']
    });

    updateButtons();
});

</script>


<?php 
function show_waitlist_overlay_form() {
	?>
	<div id="waitlist-overlay" style="
		position: fixed;
		inset: 0;
		background: rgba(0, 0, 0, 0.5);
		backdrop-filter: blur(5px);
		display: none;
		align-items: center;
		justify-content: center;
		z-index: 9999;
	">
		<div style="
			position: relative;
			background: white;
			padding: 2rem;
			border-radius: 8px;
			box-shadow: 0 10px 25px rgba(0,0,0,0.2);
			max-width: 90%;
			width: 400px;
		">
			<button id="close-waitlist-overlay" style="
				position: absolute;
				top: 0.5rem;
				right: 0.75rem;
				background: none;
				border: none;
				font-size: 1.5rem;
				cursor: pointer;
				line-height: 1;
			">×</button>

			<form action="#" method="POST" class="custom-newsletter-form">
				<input type="hidden" name="form_id" value="cotidien-form-waitlist">
				<div class="flex flex-row w-full justify-between">
					<input type="email" name="email" class="outline-none text-[14px] w-full" placeholder="Your Email" required />
					<button type="submit" class="uppercase text-[14px] hover:underline cursor-pointer">Subscribe</button>
				</div>
				<div class="h-[1px] w-[340px] lg:w-[430px] bg-black mt-2"></div>
			</form>
		</div>
	</div>
	<?php
}

?>