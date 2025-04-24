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

	<section id="primary">
		<main id="main">
			<div class="flex flex-col main-content-width mb-4 lg:mb-[50px]">
				<h2 class="cus-page-title">New In</h2>
				<?php echo do_shortcode('[products limit="4" orderby="date" order="DESC" visibility="visible" stock_status="instock"]'); ?>
			</div>

			<div class="flex flex-col relative">
				<!-- Image: absolutely positioned, but matches height/width of content -->
				<div class="absolute top-0 left-0 w-full h-full z-10">
					<img 
					class="w-full h-full object-cover" 
					src="https://plus.unsplash.com/premium_photo-1690541772579-a0a68ea59b1e?q=80&w=3864&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
					alt="Cotidien"
					/>
				</div>

				<!-- Gradient: sits above the image -->
				<div class="absolute top-0 left-0 w-full h-full bg-black/40 lg:bg-gradient-to-r lg:from-black/40 lg:via-black/10 lg:to-black/0 z-20 pointer-events-none"></div>

				<!-- Content: defines the natural size of the div -->
				<div class="main-content-width my-[50px] z-30 text-white max-w-[650px] relative">
					<h2 class="text-[28px] lg:text-[36px] font-cormorant">COTIDIEN (koh-tee-dee-ahn)</h2>
					<p>"Cote" (꽃), meaning flower in Korean, and "quotidien," meaning everyday in French, together symbolize our brand's mission: to create beautiful, elevated pieces that seamlessly fit into your everyday wardrobe.</p>

					<h3 class="text-[24px] font-cormorant mt-8">Our Story</h3>
					<p>Body text for whatever you’d like to say. Add main takeaway points, quotes, anecdotes.</p>

					<h3 class="text-[24px] font-cormorant mt-8">Our Concept</h3>
					<p>Body text for whatever you’d like to add more to the main point. It provides details, explanations, and context.</p>

					<div class="mt-8">
					<a href="/shop" class="bg-white rounded-md text-[24px] text-black px-8 py-2 font-light hover:brightness-75">
						Discover Cotidien
					</a>
					</div>
				</div>
			</div>

		</main><!-- #main -->
	</section><!-- #primary -->

	<div>
		<input type="number"/>
	</div>

<?php
get_footer();
