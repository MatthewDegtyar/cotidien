<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the `#content` element and all content thereafter.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Cotidien
 */

?>

	</div><!-- #content -->



</div><!-- #page -->
<div class="flex flex-col py-[52px]">
	<div class="main-content-width flex flex-row flex-wrap gap-16 justify-between ">
		<a href="/"><span class="text-[24px] font-cormorant uppercase">Cotidien</span></a>
		<div class="flex flex-row flex-wrap gap-8 sm:gap-0">
			<div class="flex flex-col gap-4 w-[150px] lg:w-[180px]">
				<span class="mb-2">Shop</span>
				<a href="/shop" class="font-light hover:underline">Shop All</a>
				<a href="/shop/?orderby=popularity" class="font-light hover:underline">Best Sellers</a>
				<a href="/shop/?orderby=date" class="font-light hover:underline">New In</a>
			</div>
			<div class="flex flex-col gap-4 w-[150px] lg:w-[180px]">
				<span class="mb-2">About</span>
				<a class="font-light hover:underline">Our Origin</a>
				<a class="font-light hover:underline">Threads</a>
				<a class="font-light hover:underline">Press</a>
			</div>
			<div class="flex flex-col gap-4 w-[150px] lg:w-[180px]">
				<span class="mb-2">Concierge</span>
				<a class="font-light hover:underline">FAQs</a>
				<a class="font-light hover:underline">Contact</a>
				<a class="font-light hover:underline">Shipping</a>
				<a class="font-light hover:underline">Returns</a>
			</div>
		</div>
	
		<div class="flex flex-col">
			<span class="font-cormorant text-[18px] mb-8">Subscribe to our Newsletter</span>

			<form action="#" method="POST" class="custom-newsletter-form">
			<input type="hidden" name="form_id" value="cotidien-form-newsletter2">
			<div class="flex flex-row w-full justify-between">
				<input type="email" name="email" class="outline-none text-[14px] w-full" placeholder="Your Email" required />
				<button type="submit" class="uppercase text-[14px] hover:underline cursor-pointer">Subscribe</button>
			</div>
			<div class="h-[1px] w-[340px] lg:w-[430px] bg-black mt-2"></div>
		</form>

		</div>
	
	</div>
	<div class="w-full flex flex-row items-center main-content-width gap-4 mt-4">
		<a href="#">
			<svg class="w-6 h-6 text-[#828282]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
				<path fill-rule="evenodd" d="M13.135 6H15V3h-1.865a4.147 4.147 0 0 0-4.142 4.142V9H7v3h2v9.938h3V12h2.021l.592-3H12V6.591A.6.6 0 0 1 12.592 6h.543Z" clip-rule="evenodd"/>
			</svg>
		</a>
		<a href="#">
			<svg class="w-6 h-6 text-[#828282]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
			<path fill-rule="evenodd" d="M12.51 8.796v1.697a3.738 3.738 0 0 1 3.288-1.684c3.455 0 4.202 2.16 4.202 4.97V19.5h-3.2v-5.072c0-1.21-.244-2.766-2.128-2.766-1.827 0-2.139 1.317-2.139 2.676V19.5h-3.19V8.796h3.168ZM7.2 6.106a1.61 1.61 0 0 1-.988 1.483 1.595 1.595 0 0 1-1.743-.348A1.607 1.607 0 0 1 5.6 4.5a1.601 1.601 0 0 1 1.6 1.606Z" clip-rule="evenodd"/>
			<path d="M7.2 8.809H4V19.5h3.2V8.809Z"/>
			</svg>
		</a>
		<a href="#">
			<svg class="w-6 h-6 text-[#828282]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
			<path fill-rule="evenodd" d="M21.7 8.037a4.26 4.26 0 0 0-.789-1.964 2.84 2.84 0 0 0-1.984-.839c-2.767-.2-6.926-.2-6.926-.2s-4.157 0-6.928.2a2.836 2.836 0 0 0-1.983.839 4.225 4.225 0 0 0-.79 1.965 30.146 30.146 0 0 0-.2 3.206v1.5a30.12 30.12 0 0 0 .2 3.206c.094.712.364 1.39.784 1.972.604.536 1.38.837 2.187.848 1.583.151 6.731.2 6.731.2s4.161 0 6.928-.2a2.844 2.844 0 0 0 1.985-.84 4.27 4.27 0 0 0 .787-1.965 30.12 30.12 0 0 0 .2-3.206v-1.516a30.672 30.672 0 0 0-.202-3.206Zm-11.692 6.554v-5.62l5.4 2.819-5.4 2.801Z" clip-rule="evenodd"/>
			</svg>
		</a>
		<a href="#">
			<svg class="w-6 h-6 text-[#828282]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
			<path fill="currentColor" fill-rule="evenodd" d="M3 8a5 5 0 0 1 5-5h8a5 5 0 0 1 5 5v8a5 5 0 0 1-5 5H8a5 5 0 0 1-5-5V8Zm5-3a3 3 0 0 0-3 3v8a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3V8a3 3 0 0 0-3-3H8Zm7.597 2.214a1 1 0 0 1 1-1h.01a1 1 0 1 1 0 2h-.01a1 1 0 0 1-1-1ZM12 9a3 3 0 1 0 0 6 3 3 0 0 0 0-6Zm-5 3a5 5 0 1 1 10 0 5 5 0 0 1-10 0Z" clip-rule="evenodd"/>
			</svg>
		</a>
	</div>
</div>

<?php wp_footer(); ?>


</body>
</html>
