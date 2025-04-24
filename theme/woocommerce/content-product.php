<?php
defined( 'ABSPATH' ) || exit;

global $product;

if ( ! is_a( $product, WC_Product::class ) || ! $product->is_visible() ) {
	return;
}

$product_id = $product->get_id();
$product_link = get_permalink( $product_id );
$product_title = get_the_title( $product_id );
$product_thumbnail = $product->get_image('custom-size-420x670');
$product_price = $product->get_price_html();
$product_rating = wc_get_rating_html( $product->get_average_rating() );
?>

<li class="custom-woo-product-display">
    <a href="<?php echo esc_url( $product_link ); ?>" class="block group woo-single-product">
        <div class="relative overflow-hidden">
            <!-- Adjust the image size while keeping your current layout intact -->
            <div class="product-thumbnail-wrapper w-full h-full"> <!-- Adjust the height here -->
			<img src="<?php echo wp_get_attachment_image_url( $product->get_image_id(), 'custom-size-420x670' ); ?>" alt="<?php echo esc_attr( $product_title ); ?>" class="custom-product-image">
            </div>
        </div>

        <div class="p-4 absolute top-0 text-white bg-gradient-to-b from-black/40 via-black/0 to-black/0 w-full h-full">
            <h2 class="text-lg">
                <?php echo esc_html( $product_title ); ?>
            </h2>

            <div class="">
                <?php echo $product_price; ?>
            </div>
        </div>
    </a>
</li>