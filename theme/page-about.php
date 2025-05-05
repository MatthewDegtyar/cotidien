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
        <h1 class="text-3xl lg:text-[58px] text-white font-cormorant absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 sm:text-nowrap text-center z-10"
        style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">
        New here? We’re happy you found us.    
        </h1>

        <!-- Header Image -->
        <img class="w-full max-h-[743px] object-cover" src="<?php echo esc_url($header_img); ?>" />
    </div>

    <div class="main-content-width flex flex-col">
        <div class="flex flex-col md:flex-row relative mt-[55px]">
            <div class="md:w-[50%]">
                <h2 class="text-[24px]">February 2025</h2>
                <p class="mt-[40px] text-[#828282]" style="margin-right: 20px;">Hi, I'm Sophia, the girl behind Cotidien. Cotidien first came into consciousness via my old sewing machine during 2020 as a way to pass time between online classes. I fell in love with flipping, crafting, and creating pieces that felt true to my style and vision, where I could really sink into the details of each piece and add easter eggs that only I would know to find. At the time, I couldn’t find clothes I loved on mainstream sources, so I made them myself.</p>
                <!-- <br> -->
                <p class="mt-[40px] text-[#828282]" style="margin-right: 20px;">
                In 2024, I started posting the process on Instagram. Over time, a little community formed of individuals who bought into the journey of creating something from the ground up.</p>
                <!-- <br> -->
                <p class="mt-[40px] text-[#828282]" style="margin-right: 20px;">
                In 2025, the sewing journey crystalized into something more tangible through Cotidien. "Cote" (꽃), meaning flower in Korean, and "quotidien," meaning everyday in French, together symbolize our brand's mission: to create beautiful, elevated pieces that seamlessly fit into your everyday wardrobe.
                </p>
            </div>
            <div class="md:w-[50%] mt-8 md:mt-0">
                <!-- Image 1 (Using Custom or Default Image) -->
                <img class="w-full max-h-[743px] object-cover" src="<?php echo esc_url($img1); ?>" />
            </div>
        </div>

    </div>
</main>

<?php get_footer(); ?>
