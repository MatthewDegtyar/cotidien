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

<li class="custom-woo-product-display w-full max-w-[420px] mx-auto px-4">
  <a href="<?php echo esc_url( $product_link ); ?>" class="block group woo-single-product">
    <div class="product-thumbnail-wrapper">
      <img 
        src="<?php echo wp_get_attachment_image_url( $product->get_image_id(), 'custom-size-420x670' ); ?>" 
        alt="<?php echo esc_attr( $product_title ); ?>" 
        class="w-full h-auto object-cover"
      >

      <div class="flex justify-between items-center mt-3 mb-4 px-1">
        <h2>
          <?php echo esc_html( $product_title ); ?>
        </h2>
        <div>
          <?php echo $product_price; ?>
        </div>
      </div>
    </div>
  </a>
</li>