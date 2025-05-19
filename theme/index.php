<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no `home.php` file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Cotidien
 */

get_header();
?>

<?php

// Default image URL
$default_img = 'https://plus.unsplash.com/premium_photo-1721268770804-f9db0ce102f8?q=80&w=3870&auto=format&fit=crop';

// Fetch the custom header image (falls back to $default_img if not set)
$bottom_header = get_theme_mod('home_header_img', $default_img);

?>

	<section id="primary">
		<main id="main">
		<div class="flex flex-col relative">
				<!-- Image: absolutely positioned, but matches height/width of content -->
				<div class="absolute top-0 left-0 w-full h-full z-10">
					<img 
					class="w-full h-full object-cover" 
					src="<?php echo esc_url($bottom_header); ?>"
					alt="Cotidien"
					/>
				</div>

				<!-- Gradient: sits above the image -->
				<!-- <div class="absolute top-0 left-0 w-full h-full bg-black/40 lg:bg-gradient-to-r lg:from-black/40 lg:via-black/10 lg:to-black/0 z-20 pointer-events-none"></div> -->

				<!-- Content: defines the natural size of the div -->
				<div class="main-content-width my-[50px] z-30 text-white max-w-[650px] relative">
					<h2 class="text-[28px] lg:text-[36px] font-cormorant" style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);">COTIDIEN</h2>
					<p class="text-[20px] lg:text-[20px] font-cormorant" style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);">(koh-tee-dee-ahn)</p>
					<br>
					<p class="text-[16px] lg:text-[16px]" style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);">"Cote" (꽃), the Korean word for flower, and "quotidien," the French word for everyday, reflect our mission: to create beautiful, elevated pieces that seamlessly fit into your wardrobe.</p>
				
					<!-- <h3 class="text-[24px] font-cormorant mt-8">Our Story</h3>
					<p>Body text for whatever you’d like to say. Add main takeaway points, quotes, anecdotes.</p>

					<h3 class="text-[24px] font-cormorant mt-8">Our Concept</h3>
					<p>Body text for whatever you’d like to add more to the main point. It provides details, explanations, and context.</p> -->

					<div class="mt-8">
					<a href="/shop" class="font-cormorant bg-white text-[24px] text-black px-8 py-2 hover:brightness-75">
						View Collection I
					</a>
					</div>
				</div>
			</div>

			<div class="flex flex-col main-content-width mb-4 lg:mb-[50px]">
				<h2 class="cus-page-title my-5">New In</h2>
				<?php echo do_shortcode('[products limit="4" orderby="date" order="DESC" visibility="visible" stock_status="instock"]'); ?>
			</div>

		</main><!-- #main -->
	</section><!-- #primary -->

	<div>
		<input type="number"/>
	</div>

<?php
get_footer();
