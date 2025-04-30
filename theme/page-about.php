<?php
/*
Template Name: About
*/
get_header();
?>

<?php

// Default image URL
$default_img = 'https://plus.unsplash.com/premium_photo-1721268770804-f9db0ce102f8?q=80&w=3870&auto=format&fit=crop';

// Fetch the custom header image (falls back to $default_img if not set)
$header_img = get_theme_mod('about_header_img', $default_img);

// Fetch images 1, 2, and 3 (also falls back to $default_img if not set)
$img1 = get_theme_mod('about_img_1', $default_img);
$img2 = get_theme_mod('about_img_2', $default_img);
$img3 = get_theme_mod('about_img_3', $default_img);
?>

<main class="threads-page">
    <div class="relative">
        <h1 class="text-3xl lg:text-[64px] text-white font-cormorant absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 sm:text-nowrap text-center z-10">
        New here? We’re happy you found us.    
        </h1>

        <!-- Header Image -->
        <img class="w-full max-h-[743px] object-cover" src="<?php echo esc_url($header_img); ?>" />
    </div>

    <div class="main-content-width flex flex-col">
        <div class="flex flex-col md:flex-row relative mt-[55px]">
            <div class="md:w-[50%]">
                <h2 class="text-[24px]">February 2025</h2>
                <p class="mt-[40px] text-[#828282]" style="margin-right: 20px;">Cotidien started from that restless need to create, an energy that couldn't wait for permission. It began with flowers, then fabric, chasing that same feeling: freedom, clarity, and the kind of joy that shows up when you're fully in it. That creative pulse is what runs through every piece.</p>
                <br>
                <p class="mt-[40px] text-[#828282]" style="margin-right: 20px;">
                In February 2025, it all came together. Cotidien became real — a space to build a wardrobe that felt elevated but easy, thoughtful but never fussy. Made for the everyday and memorable moments in between. </p>
            </div>
            <div class="md:w-[50%] mt-8 md:mt-0">
                <!-- Image 1 (Using Custom or Default Image) -->
                <img class="w-full max-h-[743px] object-cover" src="<?php echo esc_url($img1); ?>" />
            </div>
        </div>

    </div>
</main>

<?php get_footer(); ?>
