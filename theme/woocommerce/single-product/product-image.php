<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.7.0
 */

use Automattic\WooCommerce\Enums\ProductType;

defined( 'ABSPATH' ) || exit;

global $product;

$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$post_thumbnail_id = $product->get_image_id();
$wrapper_classes   = apply_filters(
	'woocommerce_single_product_image_gallery_classes',
	array(
		'woocommerce-product-gallery',
		'woocommerce-product-gallery--' . ( $post_thumbnail_id ? 'with-images' : 'without-images' ),
		'woocommerce-product-gallery--columns-' . absint( $columns ),
		'images',
	)
);
?>

<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
	<div class="woocommerce-product-gallery__wrapper">
		<div class="product-slider-wrapper">
			<div class="product-slider">
				<?php
				// Get the main product image
				if ($post_thumbnail_id) {
					$main_image_url = wp_get_attachment_image_url($post_thumbnail_id, 'extralarge');
					echo '<div class="slide"><img src="' . esc_url($main_image_url) . '" alt="' . esc_attr(get_post_meta($post_thumbnail_id, '_wp_attachment_image_alt', true)) . '"></div>';
				}

				// Get gallery images
				$gallery_image_ids = $product->get_gallery_image_ids();
				if ($gallery_image_ids && count($gallery_image_ids) > 0) {
					foreach ($gallery_image_ids as $image_id) {
						$image_url = wp_get_attachment_image_url($image_id, 'extralarge');
						echo '<div class="slide"><img src="' . esc_url($image_url) . '" alt="' . esc_attr(get_post_meta($image_id, '_wp_attachment_image_alt', true)) . '"></div>';
					}
				}
				?>

				<!-- Slider Controls -->
				<div class="slider-controls">
					<button id="prev-slide" class="slider-button"><svg class="-rotate-90 scale-200" data-name="1-Arrow Up" xmlns="http://www.w3.org/2000/svg" fill="#fff" viewBox="0 0 32 32"><path d="m26.71 10.29-10-10a1 1 0 0 0-1.41 0l-10 10 1.41 1.41L15 3.41V32h2V3.41l8.29 8.29z"/></svg></button>
					<button id="next-slide" class="slider-button"><svg class="rotate-90 scale-200" data-name="1-Arrow Up" xmlns="http://www.w3.org/2000/svg" fill="#fff" viewBox="0 0 32 32"><path d="m26.71 10.29-10-10a1 1 0 0 0-1.41 0l-10 10 1.41 1.41L15 3.41V32h2V3.41l8.29 8.29z"/></svg></button>
				</div>
			</div>

		</div>
	</div>
</div>

<script>
	document.addEventListener('DOMContentLoaded', function () {
		const slides = document.querySelectorAll('.product-slider .slide');
		const thumbnails = document.querySelectorAll('.slider-thumbnails .thumbnail');
		const prevButton = document.getElementById('prev-slide');
		const nextButton = document.getElementById('next-slide');

		let currentSlide = 0;

		function updateSlider() {
			slides.forEach((slide, index) => {
				slide.style.display = index === currentSlide ? 'block' : 'none';
			});
			thumbnails.forEach((thumbnail, index) => {
				thumbnail.classList.toggle('active', index === currentSlide);
			});
		}

		function goToSlide(index) {
			currentSlide = (index + slides.length) % slides.length; // Handle wrapping
			updateSlider();
		}

		// Event listeners for buttons
		prevButton.addEventListener('click', () => goToSlide(currentSlide - 1));
		nextButton.addEventListener('click', () => goToSlide(currentSlide + 1));

		// Event listeners for thumbnails
		thumbnails.forEach((thumbnail, index) => {
			thumbnail.addEventListener('click', () => goToSlide(index));
		});

		// Initialize the slider
		updateSlider();
	});
</script>
