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
        <h1 class="text-4xl lg:text-[64px] font-semibold text-white font-cormorant absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 sm:text-nowrap text-center z-10">
            Timeless Styles & Vintage Silhouettes
        </h1>

        <!-- Header Image -->
        <img class="w-full max-h-[743px] object-cover" src="<?php echo esc_url($header_img); ?>" />
    </div>

    <div class="main-content-width flex flex-col">
        <div class="flex flex-col md:flex-row relative mt-[55px]">
            <div class="md:w-[50%]">
                <h2 class="text-[24px]">February 2025</h2>
                <p class="mt-[40px] text-[#828282]">"Cote" (꽃), meaning flower in Korean, and "quotidien," meaning everyday in French, together symbolize our brand's mission: to create beautiful, elevated pieces that seamlessly fit into your everyday wardrobe.</p>
            </div>
            <div class="md:w-[50%] mt-8 md:mt-0">
                <!-- Image 1 (Using Custom or Default Image) -->
                <img class="w-full max-h-[743px] object-cover" src="<?php echo esc_url($img1); ?>" />
            </div>
        </div>

        <div class="flex flex-col md:flex-row gap-6 relative mt-[55px]">
            <!-- Image 1 -->
            <a href="#">
                <img class="aspect-square object-cover" src="<?php echo esc_url($img1); ?>" />
                <h2 class="text-[24px] font-cormorant mt-8">Our Designs</h2>
                <p class="text-[12px] mt-6">From coffee shop idea to reality</p>
            </a>
            <!-- Image 2 -->
            <a href="#">
                <img class="aspect-square object-cover" src="<?php echo esc_url($img2); ?>" />
                <h2 class="text-[24px] font-cormorant mt-8">Our Designs</h2>
                <p class="text-[12px] mt-6">From coffee shop idea to reality</p>
            </a>
            <!-- Image 3 -->
            <a href="#">
                <img class="aspect-square object-cover" src="<?php echo esc_url($img3); ?>" />
                <h2 class="text-[24px] font-cormorant mt-8">Our Designs</h2>
                <p class="text-[12px] mt-6">From coffee shop idea to reality</p>
            </a>
        </div>
    </div>
</main>

<?php get_footer(); ?>
