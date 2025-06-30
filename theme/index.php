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
$home_mobile_header = get_theme_mod('home_header_mobile_img', $default_img);

// Products hero images
$prod_image_1 = get_theme_mod('home_prod_img_1', $default_img);
$prod_image_2 = get_theme_mod('home_prod_img_2', $default_img);

?>

<section id="primary">
	<main id="main">
		<div class="flex flex-col relative">
			<!-- Mobile hero -->
			<div class="mobile-hero-wrapper">
				<video class="mobile-hero-video" autoplay muted playsinline loop preload="auto">
					<?php
					$video_url = get_theme_mod('about_video_url', 'https://cotidienlabel.com/wp-content/uploads/2025/05/mobile_720_version2_encoded.mp4');
					?>
					<source src="<?php echo esc_url($video_url); ?>" type="video/mp4">
					Your browser does not support the video tag.
				</video>
				<div class="video-text-overlay">
					<h2>COTIDIEN</h2>
				</div>
				<!-- <a href="/shop">
					<img class="w-full h-full object-cover" src="<?php echo esc_url($home_mobile_header); ?>"
							alt="Cotidien" />
				</a>
				<div class="video-text-overlay">
					<h2>– sunlit essentials –</h2>
				</div> -->
			</div>

			<!-- Desktop image hero -->
			<div class="desktop-hero-wrapper hidden md:block">
				<div class="absolute top-0 left-0 w-full h-full z-10">
					<img class="w-full h-full object-cover" src="<?php echo esc_url($bottom_header); ?>"
						alt="Cotidien" />
				</div>


				<!-- Gradient: sits above the image -->
				<!-- <div class="absolute top-0 left-0 w-full h-full bg-black/40 lg:bg-gradient-to-r lg:from-black/40 lg:via-black/10 lg:to-black/0 z-20 pointer-events-none"></div> -->

				<!-- Content: defines the natural size of the div -->
				<div class="main-content-width my-[50px] z-30 text-white max-w-[650px] relative">
					<h2 class="text-[28px] lg:text-[36px] font-cormorant"
						style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);">COTIDIEN</h2>
					<p class="text-[20px] lg:text-[20px] font-cormorant"
						style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);">(koh-tee-dee-ahn)</p>
					<br>
					<p class="text-[16px] lg:text-[16px]" style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);">"Cote"
						(꽃), the Korean word for flower, and "quotidien," the French word for everyday, reflect our
						mission: to create beautiful, elevated pieces that seamlessly fit into your wardrobe.</p>

					<div class="mt-8">
						<a href="/shop"
							class="font-cormorant bg-white text-[24px] text-black px-8 py-2 hover:brightness-75">
							View Collection I
						</a>
					</div>
				</div>
			</div>
		</div>
	<section class="landing-subimages w-full max-w-full mx-auto mt-4 px-0">
		<div class="flex gap-x-4 max-w-full">
			<a href="/product/margot-dress-ivory" class="w-1/2 relative flex items-center justify-center overflow-hidden">
			<img
				src="<?php echo esc_url($prod_image_1); ?>"
				alt="Title 1"
				class="w-full h-auto object-cover transition-transform duration-300 group-hover:scale-105"
			/>
			<h3 class="font-cormorant uppercase absolute top-[80%] text-white md:text-5xl px-3 py-1 pointer-events-none drop-shadow-lg">
				margot dress
			</h3>
			</a>

			<a href="/product/soleil-dress" class="w-1/2 relative flex items-center justify-center overflow-hidden">
			<img
				src="<?php echo esc_url($prod_image_2); ?>"
				alt="Title 2"
				class="w-full h-auto object-cover transition-transform duration-300 group-hover:scale-105"
			/>
			<h3 class="font-cormorant uppercase absolute top-[80%] text-white md:text-5xl px-3 py-1 pointer-events-none drop-shadow-lg">
				soleil dress
			</h3>
			</a>
		</div>
	</section>

	</main><!-- #main -->
</section><!-- #primary -->

<div>
	<input type="number" />
</div>

<?php
get_footer();
