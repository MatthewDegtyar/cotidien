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
<div class="flex flex-col">
	<div class="bg-[#f7f5f1]">
		<div class="main-content-width flex flex-row flex-wrap gap-16 justify-between py-[36px]">
			<a href="/" class="footer-logo"><span class="text-[24px] font-cormorant uppercase">Cotidien</span></a>
			<div class="flex flex-row flex-wrap gap-8 sm:gap-0">
				<div class="flex flex-col gap-4 w-[150px] lg:w-[180px]">
					<span class="font-semibold mb-2">Shop</span>
					<a href="/shop" class="text-sm font-light hover:underline">Shop All</a>
					<a href="/shop/?orderby=popularity" class="text-sm font-light hover:underline">Best Sellers</a>
					<a href="/shop/?orderby=date" class="text-sm font-light hover:underline">New In</a>
				</div>
				<div class="flex flex-col gap-4 w-[150px] lg:w-[180px]">
					<span class="font-semibold mb-2">About</span>
					<a href="/about" class="text-sm font-light hover:underline">Our Origin</a>
					<a href="/threads" class="text-sm font-light hover:underline">Threads</a>
					<!-- <a class="text-sm font-light hover:underline">Press</a> -->
				</div>
				<div class="flex flex-col gap-4 w-[150px] lg:w-[180px]">
					<span class="font-semibold mb-2">Concierge</span>
					<!-- <a class="font-light hover:underline">FAQs</a> -->
					<!-- <a class="font-light hover:underline">Contact</a>
					<a class="font-light hover:underline">Shipping</a> -->
					<a href="/return-policy" class="text-sm font-light hover:underline">Returns</a>
					<a href="/privacy-policy" class ="text-sm font-light hover:underline">Privacy Policy</a>
					<a href="/terms-and-conditions" class="text-sm font-light hover:underline">Terms and Conditions</a>
				</div>
			</div>
			<div id="newsletter" class="flex flex-col w-full lg:w-[430px]">
				<span class="font-semibold mb-6">Subscribe to our Newsletter</span>
				<form action="#" method="POST" class="custom-newsletter-form w-full">
					<input type="hidden" name="form_id" value="cotidien-form-newsletter2">
					<div class="flex flex-row w-full">
						<input type="email" name="email" class="outline-none text-[14px] w-full" placeholder="Your Email" required />
						<button type="submit" class="bg-black text-white px-8 py-2 text-[14px] font-light border border-black hover:bg-white hover:text-black transition-colors ml-4">Subscribe</button>
					</div>
					<div class="h-[1px] w-full bg-black mt-2"></div>
				</form>
			</div>	
		</div>
	</div>
	<div class="w-full flex flex-row items-center main-content-width gap-4 mt-8 mb-8">
		<!-- facebook -->
		<a href="https://www.facebook.com/cotidien">
			<svg class="w-6 h-6 text-[#828282]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
				<path fill-rule="evenodd" d="M13.135 6H15V3h-1.865a4.147 4.147 0 0 0-4.142 4.142V9H7v3h2v9.938h3V12h2.021l.592-3H12V6.591A.6.6 0 0 1 12.592 6h.543Z" clip-rule="evenodd"/>
			</svg>
		</a>
		<!-- instagram -->
		<a href="https://www.instagram.com/cotidienlabel/">
			<svg class="w-6 h-6 text-[#828282]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
			<path fill="currentColor" fill-rule="evenodd" d="M3 8a5 5 0 0 1 5-5h8a5 5 0 0 1 5 5v8a5 5 0 0 1-5 5H8a5 5 0 0 1-5-5V8Zm5-3a3 3 0 0 0-3 3v8a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3V8a3 3 0 0 0-3-3H8Zm7.597 2.214a1 1 0 0 1 1-1h.01a1 1 0 1 1 0 2h-.01a1 1 0 0 1-1-1ZM12 9a3 3 0 1 0 0 6 3 3 0 0 0 0-6Zm-5 3a5 5 0 1 1 10 0 5 5 0 0 1-10 0Z" clip-rule="evenodd"/>
			</svg>
		</a>
	</div>
</div>

<?php wp_footer(); ?>


</body>
</html>
