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
		Join the waitlist
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

    // Add CSS for out-of-stock styling
    const style = document.createElement('style');
    style.textContent = `
        .variation-option[data-available="false"] {
            opacity: 0.3;
            cursor: pointer !important;
        }
        .variation-option[data-available="false"]:hover {
            opacity: 0.4;
        }
        .variation-option[data-available="false"].selected {
            opacity: 0.5;
        }
    `;
    document.head.appendChild(style);

    // Modal logic
    waitlistButton.addEventListener('click', function () {
        waitlistOverlay.style.display = 'flex';
    });

    closeOverlayBtn.addEventListener('click', function () {
        waitlistOverlay.style.display = 'none';
    });
    
    // Close modal when clicking outside
    waitlistOverlayBG.addEventListener('click', function(e) {
        if (e.target === waitlistOverlayBG) {
            waitlistOverlay.style.display = 'none';
        }
    });

    if (waitlistOverlay) {
        document.body.insertBefore(waitlistOverlay, document.body.firstChild);
    }

    // Function to update button availability
    function updateButtonAvailability(variations) {
        const buttons = document.querySelectorAll('.variation-option');
        const currentSelections = {};
        
        // Get current selections
        variationForm.querySelectorAll('select').forEach(select => {
            currentSelections[select.name] = select.value;
        });

        // Enable all buttons first
        buttons.forEach(button => {
            button.removeAttribute('disabled');
            const wrapper = button.closest('.variation-buttons');
            if (wrapper) {
                const attributeName = 'attribute_' + wrapper.dataset.attributeName;
                const optionValue = button.dataset.option;
                
                // Check if this option is available in any variation
                let isAvailable = false;
                for (let variation of variations) {
                    if (variation.attributes[attributeName] === optionValue || variation.attributes[attributeName] === "") {
                        let matchesOtherAttributes = true;
                        // Check if other selected attributes match this variation
                        for (let attr in currentSelections) {
                            if (attr !== attributeName && 
                                currentSelections[attr] && 
                                variation.attributes[attr] !== "" && 
                                variation.attributes[attr] !== currentSelections[attr]) {
                                matchesOtherAttributes = false;
                                break;
                            }
                        }
                        if (matchesOtherAttributes && variation.is_in_stock && variation.max_qty > 0) {
                            isAvailable = true;
                            break;
                        }
                    }
                }
                
                button.setAttribute('data-available', isAvailable.toString());
            }
        });
    }

    // Handle variation availability
    if (variationForm) {
        // Get variations data
        const variationsData = JSON.parse(variationForm.dataset.product_variations || '[]');
        
        // Initial update
        updateButtonAvailability(variationsData);

        // Update on selection change
        jQuery(variationForm).on('woocommerce_variation_select_change', function() {
            updateButtonAvailability(variationsData);
        });

        jQuery(variationForm).on('found_variation', function(event, variation) {
            if (!variation.is_in_stock || variation.max_qty === 0) {
                realButton.style.display = 'none';
                waitlistButton.style.display = 'inline-block';
            } else {
                realButton.style.display = 'inline-block';
                waitlistButton.style.display = 'none';
            }
        });

        // Handle when no variation is found or reset
        jQuery(variationForm).on('reset_data', function() {
            realButton.style.display = 'inline-block';
            waitlistButton.style.display = 'none';
            updateButtonAvailability(variationsData);
        });
    }

    // Initial state
    if (container.classList.contains('woocommerce-variation-add-to-cart-disabled')) {
        realButton.style.display = 'none';
        waitlistButton.style.display = 'inline-block';
    }
});
</script>

<?php ?>