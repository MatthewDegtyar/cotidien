<?php
/**
 * The header for our theme
 *
 * This is the template that displays the `head` element and everything up
 * until the `#content` element.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Cotidien
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<script>
	document.addEventListener('DOMContentLoaded', () => {
		// Mobile Nav Elements
		const toggle = document.getElementById('menu-toggle');
		const nav = document.getElementById('mobile-nav');
		const closeBtn = document.getElementById('menu-close');

		// Cart Elements
		const cartToggle = document.getElementById('cart-toggle');
		const cartView = document.getElementById('cart-view');
		const cartClose = document.getElementById('cart-close');

		// Shared Overlay
		const overlay = document.getElementById('mobile-overlay');

		function openMenu() {
			nav.classList.remove('translate-x-full');
			nav.classList.add('translate-x-0');

			overlay.classList.remove('opacity-0', 'pointer-events-none');
			overlay.classList.add('opacity-100', 'pointer-events-auto');
		}

		function closeMenu() {
			nav.classList.add('translate-x-full');
			nav.classList.remove('translate-x-0');

			overlay.classList.add('opacity-0', 'pointer-events-none');
			overlay.classList.remove('opacity-100', 'pointer-events-auto');
		}

		function openCart() {
			cartView.classList.remove('translate-x-full');
			cartView.classList.add('translate-x-0');

			overlay.classList.remove('opacity-0', 'pointer-events-none');
			overlay.classList.add('opacity-100', 'pointer-events-auto');
		}

		function closeCart() {
			cartView.classList.add('translate-x-full');
			cartView.classList.remove('translate-x-0');

			overlay.classList.add('opacity-0', 'pointer-events-none');
			overlay.classList.remove('opacity-100', 'pointer-events-auto');
		}

		toggle.addEventListener('click', () => {
			openMenu();
			closeCart();
		});

		closeBtn.addEventListener('click', closeMenu);
		overlay.addEventListener('click', () => {
			closeMenu();
			closeCart();
		});

		cartToggle.addEventListener('click', () => {
			openCart();
			closeMenu();
		});

		cartClose.addEventListener('click', closeCart);
	});

	document.addEventListener("DOMContentLoaded", function() {
    const navLinks = document.querySelectorAll(".nav-link");
    const currentPath = window.location.pathname.replace(/\/$/, "");  // Remove trailing slash from current path

    navLinks.forEach(link => {
        let linkHref = link.getAttribute("href").replace(/\/$/, "");  // Remove trailing slash from href
        if (linkHref === currentPath || (currentPath === "/" && linkHref === "")) {
            link.classList.add("active"); // Add the active class to the current link
        }
    });
});


</script>

<header id="masthead" class="fixed top-0 left-0 right-0 z-50 bg-white">
	<div class="w-full bg-[#f9f6cd] text-black text-center py-2 text-xs sm:text-base font-medium tracking-wide">
	Memorial Day Sale — <span class="underline">25% Off Sitewide</span> — code <strong>SUMMER25</strong>
	</div>


	<div class="main-content-width h-[80px] lg:h-[120px] flex flex-row items-center">
		<div class="w-full flex flex-row justify-between items-center lg:justify-normal">


			<a href="/" class="flex items-center"><span class="text-2xl lg:text-3xl font-cormorant uppercase tracking-wide">Cotidien</span></a>
			<div class="flex-row items-center w-full justify-between hidden lg:flex">
				<nav class="lg:flex flex-row gap-[48px] ml-[48px]">
					<a href="/shop" class="nav-link">Shop</a>
					<a href="/about" class="nav-link">About</a>
					<a href="/threads" class="nav-link">Threads</a>
				</nav>

				<div class="flex lg:hidden"></div>
			</div>

			<div class="flex flex-row items-center gap-4 lg:gap-8">
			<?php if ( ! is_cart() ) : ?>
				<button id="cart-toggle" class="relative flex items-center cursor-pointer">
					<!-- Inline SVG icon -->
					<svg fill="#000000" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
						viewBox="0 0 902.86 902.86" xml:space="preserve" class="w-6 h-6">
						<g>
							<path d="M671.504,577.829l110.485-432.609H902.86v-68H729.174L703.128,179.2L0,178.697l74.753,399.129h596.751V577.829z M685.766,247.188
								l-67.077,262.64H131.199L81.928,246.756L685.766,247.188z"/>
							<path d="M578.418,825.641c59.961,0,108.743-48.783,108.743-108.744s-48.782-108.742-108.743-108.742H168.717
								c-59.961,0-108.744,48.781-108.744,108.742s48.782,108.744,108.744,108.744c59.962,0,108.743-48.783,108.743-108.744
								c0-14.4-2.821-28.152-7.927-40.742h208.069c-5.107,12.59-7.928,26.342-7.928,40.742
								C469.675,776.858,518.457,825.641,578.418,825.641z M209.46,716.897c0,22.467-18.277,40.744-40.743,40.744
								c-22.466,0-40.744-18.277-40.744-40.744c0-22.465,18.277-40.742,40.744-40.742C191.183,676.155,209.46,694.432,209.46,716.897z
								M619.162,716.897c0,22.467-18.277,40.744-40.743,40.744s-40.743-18.277-40.743-40.744c0-22.465,18.277-40.742,40.743-40.742
								S619.162,694.432,619.162,716.897z"/>
						</g>
					</svg>

					<?php if ( function_exists( 'WC' ) && WC()->cart->get_cart_contents_count() > 0 ) : ?>
						<span class="absolute -top-2 -left-2 bg-black text-white text-[10px] leading-none font-medium px-[6px] py-[2px] rounded-full">
							<?php echo WC()->cart->get_cart_contents_count(); ?>
						</span>
					<?php endif; ?>
				</button>
			<?php endif; ?>


				<button id="menu-toggle" class="lg:hidden flex items-center cursor-pointer">
					<svg class="w-6 h-6 text-black" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
						<path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M5 7h14M5 12h14M5 17h14"/>
					</svg>
				</button>

			</div>
		</div>
	</div>
</header>
<div class="pt-[112px] lg:pt-[152px]"></div>

	<?php if ( ! is_cart() && function_exists( 'WC' ) ) : ?>
	<div id="cart-view" class="cart-view">
		<div class="w-full flex flex-row justify-between items-center mb-4">
			<div></div>
			<span class="font-cormorant text-[32px]">Cart (<?php echo WC()->cart->get_cart_contents_count(); ?>)</span>
			<button id="cart-close" class="cursor-pointer">
				<svg class="w-8 h-8 text-black" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
					<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/>
				</svg>
			</button>
		</div>

		<?php if ( function_exists( 'WC' ) ) :
			$cart = WC()->cart->get_cart();
		?>
			<div class="max-h-[calc(100vh-100px)] overflow-y-scroll space-y-6">
				<?php if ( empty( $cart ) ) : ?>
					<p class="text-center text-gray-500">Your cart is currently empty.</p>
				<?php else : ?>
					<?php foreach ( $cart as $cart_item_key => $cart_item ) :
						$product = $cart_item['data'];
						if ( ! $product || ! $product->exists() ) continue;

						$product_id = $product->get_id();
						$product_name = $product->get_name();
						$product_permalink = $product->is_visible() ? $product->get_permalink( $cart_item ) : '';
						$product_thumbnail = $product->get_image( 'woocommerce_thumbnail', ['class' => 'w-24 h-24 object-cover rounded-lg'] );
						$product_price = WC()->cart->get_product_price( $product );
						$quantity = $cart_item['quantity'];
					?>
						<div class="flex items-start gap-4 pb-4">
							<div class="cart-menu-img-wrapper">
								<?php echo $product_thumbnail; ?>
							</div>
							<div class="flex flex-col justify-between w-full">
								<div class="flex justify-between items-start">
									<div class="flex flex-col h-[150px] justify-between">
										<div class="flex flex-col">
											<a href="<?php echo esc_url( $product_permalink ); ?>" class=" hover:underline">
												<?php echo esc_html( $product_name ); ?>
											</a>
											<div>
												<?php
													// Meta data.
													echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.
												?>
											</div>
										</div>
										<div class="product-quantity mt-2" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
											<div class="quantity-wrapper">
												<button type="button" class="qty-btn minus">−</button>
												<?php
												if ( $product->is_sold_individually() ) {
													$min_quantity = 1;
													$max_quantity = 1;
												} else {
													$min_quantity = 1; // Minimum quantity
													$max_quantity = $product->get_max_purchase_quantity(); // Max quantity
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
													$product,
													false
												);
												?>
												<button type="button" class="qty-btn plus">+</button>
											</div>
										</div>
									</div>
									<div class="flex flex-col">
										<div class="text-right font-medium">
											<?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $product, $cart_item['quantity'] ), $cart_item, $cart_item_key ) ?>
										</div>
										<form action="<?php echo esc_url( wc_get_cart_remove_url( $cart_item_key ) ); ?>" method="post" class="mt-4">
											<button type="submit" class="text-sm text-gray-700 hover:underline cursor-pointer">
												Remove
											</button>
										</form>
									</div>
								</div>
								
							</div>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<div class="flex justify-end mt-4">
			<button id="update-cart-button" class="bg-gray-400 py-1 px-4 text-white" disabled>
				Update Cart
			</button>
		</div>


		<?php if ( ! empty( $cart ) ) : ?>
		<div class="mt-4 w-full ">
			<div class="flex justify-between items-center text-lg font-medium mb-2 w-full">
				<span>Subtotal</span>
				<span><?php echo WC()->cart->get_cart_subtotal(); ?></span>
			</div>
			<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="w-full h-[50px] text-[18px] bg-black text-white text-center flex items-center justify-center  transition">
				Checkout
			</a>
		</div>
	<?php endif; ?>
	</div>

	<?php endif; ?>
	<nav id="mobile-nav" class="lg:hidden fixed top-0 right-0 w-full sm:w-[400px] h-full bg-white border-l-2 border-[#D9D9D9] transform translate-x-full transition-transform duration-300 ease-in-out z-50 p-6">
		<div class="w-full flex flex-row-reverse">
			<button id="menu-close" class="mb-6 self-end cursor-pointer">
				<svg class="w-8 h-8 mt-[8px] text-black" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
					<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/>
				</svg>
			</button>
		</div>
		<div class="flex flex-col gap-6 text-lg">
		<a href="/">Home</a>
			<a href="/shop">Shop</a>
			<a href="/about">About</a>
			<a href="/threads">Threads</a>
		</div>
	</nav>

	<div id="mobile-overlay" class="lg:hidden fixed inset-0 backdrop-blur-sm  bg-opacity-50 opacity-0 pointer-events-none z-40 transition-opacity duration-300"></div>
<?php if ( ! is_cart() ) : ?>



	<script>

	var wc_cart_params = {
		ajax_url: '<?php echo admin_url( 'admin-ajax.php' ); ?>'
	};
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

		jQuery(document).ready(function($) {
	let originalQuantities = {};

	// Store original quantities on load
	$('.quantity input.qty').each(function() {
		const key = $(this).attr('name');
		originalQuantities[key] = $(this).val();
	});

	// Detect if quantities have changed
	function hasChanges() {
		let changed = false;
		$('.quantity input.qty').each(function() {
			const key = $(this).attr('name');
			if ($(this).val() !== originalQuantities[key]) {
				changed = true;
				return false; // Break the loop
			}
		});
		return changed;
	}

	// Update the button state (enabled/disabled)
	function updateButtonState() {
		if (hasChanges()) {
			$('#update-cart-button')
				.prop('disabled', false)
				.removeClass('bg-gray-400 cursor-not-allowed')
				.addClass('bg-black cursor-pointer');
		} else {
			$('#update-cart-button')
				.prop('disabled', true)
				.removeClass('bg-black cursor-pointer')
				.addClass('bg-gray-400 cursor-not-allowed');
		}
	}

	// Detect quantity input changes
	$(document).on('input', '.quantity input.qty', function() {
		updateButtonState();
	});

	// Submit the updated quantities on button click
	$('#update-cart-button').on('click', function(e) {
		try {
			e.preventDefault();
	
			// Collect updated quantities and cart item keys
			let updatedData = {};

			// I do not know why but wrapping this block in try/catch allows the cart to update
			// its value via the custom buttons from the mobile cart while user is browsing an individual
			// item. Do not remove this try/catch block
			
			try {
				$('.quantity input.qty').each(function() {
					const itemKey = $(this).attr('name').match(/\[([a-f0-9]+)\]/i)[1]; // Get the cart item key
					const newQty = $(this).val(); // Get the new quantity
					updatedData[itemKey] = newQty; // Store updated quantity
				});

			} catch (e) {
				console.warn("marker 1,",e)
			}
			// AJAX request to update the cart
			$.ajax({
				type: 'POST',
				url: wc_cart_params.ajax_url, // WooCommerce AJAX URL
				data: {
					action: 'update_cart_item_quantities',
					updated_quantities: updatedData,
				},
				success: function(response) {
					if (response.success) {
						// Reload the page to reflect changes (or you could update cart dynamically)
						location.reload(); // Refresh page to show updated cart
					} else {
						alert('Failed to update the cart. Please try again.');
					}
				},
				error: function() {
					alert('There was an error while updating the cart. Please try again.');
				}
			});
		} catch (e) {
			console.warn(e)
		}
	});
});

	</script>
<?php endif; ?>


<div id="content">

