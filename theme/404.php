<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Cotidien
 */

get_header();
?>

	<section id="primary ">
		<main id="main ">

			<div>
				<header class="page-header main-content-width">
					<h1 class="page-title"><?php esc_html_e( 'Page Not Found', 'cotidien' ); ?></h1>
				</header><!-- .page-header -->
				<div class="w-full flex flex-col items-center justify-center">
				<p><?php esc_html_e( 'This page could not be found. It might have been removed or renamed, or it may never have existed.', 'cotidien' ); ?></p>
				<a class="h-[40px] w-[150px] text-white bg-black flex items-center mt-8 text-center justify-center" href="/">Back To Home</a>
				</div>
<!--
				<div <?php cotidien_content_class( 'page-content' ); ?>>
					<p><?php esc_html_e( 'This page could not be found. It might have been removed or renamed, or it may never have existed.', 'cotidien' ); ?></p>
					<?php get_search_form(); ?>
				</div> 
-->
				<!-- .page-content -->
			</div>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();
