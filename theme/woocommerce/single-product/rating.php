<?php
/**
 * Single Product Rating
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/rating.php.
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

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $product;

if ( ! wc_review_ratings_enabled() ) {
	return;
}

$rating_count = $product->get_rating_count();
$review_count = $product->get_review_count();
$average      = $product->get_average_rating();

if ( $rating_count > 0 && comments_open() ) : ?>
    <div class="woocommerce-product-rating" style="line-height: 1;">
        <a href="#product-reviews" class="woocommerce-review-link review-scroll-link" rel="nofollow" style="display: inline-block; vertical-align: baseline; font-size: 0.85rem; text-decoration: none;">
            <span style="display: inline-block; vertical-align: baseline; margin-bottom: -2px;">
                <?php echo wc_get_rating_html( $average, $rating_count ); ?>
            </span>
            <span style="display: inline-block; vertical-align: baseline; text-decoration: underline;">
                <?php printf( _n( '%s review', '%s reviews', $review_count, 'woocommerce' ), '<span class="count">' . esc_html( $review_count ) . '</span>' ); ?>
            </span>
        </a>
    </div>
<?php elseif ( $rating_count > 0 ) : ?>
    <div class="woocommerce-product-rating">
        <?php echo wc_get_rating_html( $average, $rating_count ); ?>
    </div>
<?php endif; ?>