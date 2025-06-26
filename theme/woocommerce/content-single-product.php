<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>

	<?php
	/**
	 * Hook: woocommerce_before_single_product_summary.
	 *
	 * @hooked woocommerce_show_product_sale_flash - 10
	 * @hooked woocommerce_show_product_images - 20
	 */
	do_action( 'woocommerce_before_single_product_summary' );
	?>

	<div class="summary entry-summary">
		<?php
		/**
		 * Hook: woocommerce_single_product_summary.
		 *
		 * @hooked woocommerce_template_single_title - 5
		 * @hooked woocommerce_template_single_rating - 10
		 * @hooked woocommerce_template_single_price - 10
		 * @hooked woocommerce_template_single_excerpt - 20
		 * @hooked woocommerce_template_single_add_to_cart - 30
		 * @hooked woocommerce_template_single_meta - 40
		 * @hooked woocommerce_template_single_sharing - 50
		 * @hooked WC_Structured_Data::generate_product_data() - 60
		 */
		do_action( 'woocommerce_single_product_summary' );

		function add_size_guide_button() {
			?>
			<!-- Hidden checkbox for toggling modal visibility -->
			<input type="checkbox" id="size-guide-toggle" class="hidden">

			<!-- Button to trigger checkbox change -->
			<label for="size-guide-toggle" class="text-sm font-bold underline hover:underline cursor-pointer">
				Size guide
			</label>

			<!-- Modal Structure -->
			<div id="size-guide-modal" class="fixed inset-0 flex justify-center items-center hidden z-50">
				<div class="bg-white p-6 w-full max-w-md sm:max-w-lg md:max-w-xl lg:max-w-2xl" style="position: relative;">
					<h3 class="text-l font-bold">Size Guide</h3>
					<table class="mt-4 w-full table-fixed border-collapse">
					<thead>
						<tr>
						<th class="border-b px-4 py-2 text-center">Size</th>
						<th class="border-b px-4 py-2 text-center">XS (in)</th>
						<th class="border-b px-4 py-2 text-center">S (in)</th>
						<th class="border-b px-4 py-2 text-center">M (in)</th>
						<th class="border-b px-4 py-2 text-center">L (in)</th>
						</tr>
					</thead>
					<tbody>
						<tr>
						<th scope="row" class="border-b px-4 py-2 text-center">Bust</th>
						<td class="border-b px-4 py-2 text-center">31</td>
						<td class="border-b px-4 py-2 text-center">33</td>
						<td class="border-b px-4 py-2 text-center">35</td>
						<td class="border-b px-4 py-2 text-center">38</td>
						</tr>
						<tr>
						<th scope="row" class="border-b px-4 py-2 text-center">Waist</th>
						<td class="border-b px-4 py-2 text-center">24</td>
						<td class="border-b px-4 py-2 text-center">26</td>
						<td class="border-b px-4 py-2 text-center">28</td>
						<td class="border-b px-4 py-2 text-center">30</td>
						</tr>
						<tr>
						<th scope="row" class="border-b px-4 py-2 text-center">Hip</th>
						<td class="border-b px-4 py-2 text-center">34</td>
						<td class="border-b px-4 py-2 text-center">36</td>
						<td class="border-b px-4 py-2 text-center">38</td>
						<td class="border-b px-4 py-2 text-center">41</td>
						</tr>
					</tbody>
					</table>


					<!-- Close button inside the modal, which unchecks the checkbox -->
					<label for="size-guide-toggle" class="text-black cursor-pointer" style="position: absolute; top: 0; right: 0.5rem; padding: 0.3rem; cursor: pointer;">
						&times;
					</label>

				</div>
			</div>
			<?php
		}
		?>
	</div>

	<?php
	/**
	 * Hook: woocommerce_after_single_product_summary.
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_upsell_display - 15
	 * @hooked woocommerce_output_related_products - 20
	 */
	do_action( 'woocommerce_after_single_product_summary' );
	?>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
