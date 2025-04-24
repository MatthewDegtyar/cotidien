<?php
/**
 * Cotidien functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Cotidien
 */

if ( ! defined( 'COTIDIEN_VERSION' ) ) {
	/*
	 * Set the theme’s version number.
	 *
	 * This is used primarily for cache busting. If you use `npm run bundle`
	 * to create your production build, the value below will be replaced in the
	 * generated zip file with a timestamp, converted to base 36.
	 */
	define( 'COTIDIEN_VERSION', '0.1.0' );
}

if ( ! defined( 'COTIDIEN_TYPOGRAPHY_CLASSES' ) ) {
	/*
	 * Set Tailwind Typography classes for the front end, block editor and
	 * classic editor using the constant below.
	 *
	 * For the front end, these classes are added by the `cotidien_content_class`
	 * function. You will see that function used everywhere an `entry-content`
	 * or `page-content` class has been added to a wrapper element.
	 *
	 * For the block editor, these classes are converted to a JavaScript array
	 * and then used by the `./javascript/block-editor.js` file, which adds
	 * them to the appropriate elements in the block editor (and adds them
	 * again when they’re removed.)
	 *
	 * For the classic editor (and anything using TinyMCE, like Advanced Custom
	 * Fields), these classes are added to TinyMCE’s body class when it
	 * initializes.
	 */
	define(
		'COTIDIEN_TYPOGRAPHY_CLASSES',
		'prose prose-neutral max-w-none prose-a:text-primary'
	);
}

if ( ! function_exists( 'cotidien_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function cotidien_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Cotidien, use a find and replace
		 * to change 'cotidien' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'cotidien', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'menu-1' => __( 'Primary', 'cotidien' ),
				'menu-2' => __( 'Footer Menu', 'cotidien' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style-editor.css' );
		add_editor_style( 'style-editor-extra.css' );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Remove support for block templates.
		remove_theme_support( 'block-templates' );
	}
endif;
add_action( 'after_setup_theme', 'cotidien_setup' );


function custom_wc_ajax_variation_threshold( $qty, $product ) {return 100;}   
    add_filter( 'woocommerce_ajax_variation_threshold', 'custom_wc_ajax_variation_threshold', 100, 2 );

function mytheme_add_woocommerce_support() {
	add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );

add_action( 'woocommerce_single_product_summary', 'custom_title_price_wrapper', 5 );
function custom_title_price_wrapper() {
    global $product;
    ?>
    <div class="flex items-center gap-4">
        <h1 class="product_title"><?php the_title(); ?></h1>
        <span class="text-[20px] text-black ml-[128px] font-jakarta"><?php echo $product->get_price_html(); ?></span>
    </div>
    <?php
}

add_action('woocommerce_before_quantity_input_field', 'add_custom_quantity_label', 10, 0);
function theme_customize_register($wp_customize) {
    // Section for About Page Images
    $wp_customize->add_section('about_section', array(
        'title' => __('About Page Images'),
        'priority' => 30,
    ));

    // Header Image
    $wp_customize->add_setting('about_header_img', array(
        'default' => 'https://plus.unsplash.com/premium_photo-1721268770804-f9db0ce102f8?q=80&w=3870&auto=format&fit=crop',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'about_header_img', array(
        'label' => __('Header Image'),
        'section' => 'about_section',
        'settings' => 'about_header_img',
    )));

    // Image 1
    $wp_customize->add_setting('about_img_1', array(
        'default' => 'https://plus.unsplash.com/premium_photo-1721268770804-f9db0ce102f8?q=80&w=3870&auto=format&fit=crop',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'about_img_1', array(
        'label' => __('Image 1 (Our Designs)'),
        'section' => 'about_section',
        'settings' => 'about_img_1',
    )));

    // Image 2
    $wp_customize->add_setting('about_img_2', array(
        'default' => 'https://plus.unsplash.com/premium_photo-1721268770804-f9db0ce102f8?q=80&w=3870&auto=format&fit=crop',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'about_img_2', array(
        'label' => __('Image 2 (Our Designs)'),
        'section' => 'about_section',
        'settings' => 'about_img_2',
    )));

    // Image 3
    $wp_customize->add_setting('about_img_3', array(
        'default' => 'https://plus.unsplash.com/premium_photo-1721268770804-f9db0ce102f8?q=80&w=3870&auto=format&fit=crop',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'about_img_3', array(
        'label' => __('Image 3 (Our Designs)'),
        'section' => 'about_section',
        'settings' => 'about_img_3',
    )));
}
add_action('customize_register', 'theme_customize_register');

function add_custom_quantity_label() {
    if (is_cart()) {
        return; // Don't add the label on the cart page
    }

    // Custom label text
    echo '<label class="custom-quantity-label" for="quantity_' . uniqid() . '">Quantity</label>';
}

if ( ! function_exists( 'wc_variation_attribute_buttons' ) ) {
    function wc_variation_attribute_buttons( $args = array() ) {
        $args = wp_parse_args(
            apply_filters( 'woocommerce_variation_attribute_buttons_args', $args ),
            array(
                'options'          => false,
                'attribute'        => false,
                'product'          => false,
                'selected'         => false,
                'required'         => false,
                'name'             => '',
                'id'               => '',
                'class'            => '',
                'show_option_none' => __( 'Choose an option', 'woocommerce' ),
            )
        );

        $options               = $args['options'];
        $product               = $args['product'];
        $attribute             = $args['attribute'];
        $name                  = $args['name'] ? $args['name'] : 'attribute_' . sanitize_title( $attribute );
        $id                    = $args['id'] ? $args['id'] : sanitize_title( $attribute );
        $class                 = $args['class'];
        $required              = (bool) $args['required'];
        $show_option_none      = (bool) $args['show_option_none'];
        $show_option_none_text = $args['show_option_none'] ? $args['show_option_none'] : __( 'Choose an option', 'woocommerce' );

        // If options are empty, use product attributes
        if ( empty( $options ) && ! empty( $product ) && ! empty( $attribute ) ) {
            $attributes = $product->get_variation_attributes();
            $options    = $attributes[ $attribute ];
        }
		
        // Start the button container
        $html  = '<div class="variation-buttons" data-attribute-name="' . esc_attr( sanitize_title( $attribute ) ) . '">';

        if ( ! empty( $options ) ) {
			// Check if the attribute is a color option
			$is_color_attribute = is_color_option( $attribute ); 

			// Loop through the sorted options and render them
			foreach ( $options as $option ) {
				
				$button_class = $is_color_attribute ? 'color-option' : 'size-option';
		
				if ( $is_color_attribute ) {
					$html .= '<button type="button" class="variation-option ' . $button_class . '" data-option="' . esc_attr( $option ) . '" style="background-color: ' . esc_attr( $option ) . '">';
					$html .= '</button>';
				} else {
					$html .= '<button type="button" class="variation-option ' . $button_class . '" data-option="' . esc_attr( $option ) . '">' . esc_html( $option ) . '</button>';
				}
			}
		}

        $html .= '</div>';

        // Output the hidden select field for WooCommerce compatibility
        $html .= '<select name="' . esc_attr( $name ) . '" style="display: none;" data-attribute_name="attribute_' . esc_attr( sanitize_title( $attribute ) ) . '">';
        $html .= '<option value="">' . esc_html( $show_option_none_text ) . '</option>';
        foreach ( $options as $option ) {
            $html .= '<option value="' . esc_attr( $option ) . '" ' . selected( $args['selected'], $option, false ) . '>' . esc_html( $option ) . '</option>';
        }
		
        $html .= '</select>';

        echo apply_filters( 'woocommerce_variation_attribute_buttons_html', $html, $args );
    }
}

// Helper function to check if it's a color option
function is_color_option($attribute) {

    return strpos( $attribute, 'color' ) !== false || $attribute === 'Color'; // Adjust this as per your color attribute
}

function custom_variation_buttons_script() {
    wp_enqueue_script('jquery');
    
    wp_add_inline_script('jquery', "
        jQuery(document).ready(function($) {
            // When a variation option button is clicked
            $('.variation-option').on('click', function() {
                var button = $(this);
                var attribute_name = button.closest('.variation-buttons').data('attribute-name');
                var selected_value = button.data('option');

                // Update the selected variation text
                $('#selected-option-' + attribute_name).text(selected_value);

                // Mark the clicked button as selected and update the hidden select field value
                button.siblings().removeClass('selected');
                button.addClass('selected');
                
                // Update the corresponding hidden select field value
                var selectField = $('select[name=\"attribute_' + attribute_name + '\"]');
                selectField.val(selected_value).trigger('change');
                
                // Trigger WooCommerce variation updates
                $(document.body).trigger('wc_variation_form');
            });
        });
    ");
}

add_action('wp_enqueue_scripts', 'custom_variation_buttons_script');


add_action('after_setup_theme', 'custom_woocommerce_image_sizes');
function custom_woocommerce_image_sizes() {
    add_image_size('custom-size-420x670', 420, 670, true); // 420x670px with cropping enabled
}

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function cotidien_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Footer', 'cotidien' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your footer.', 'cotidien' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'cotidien_widgets_init' );

/**
 * Enqueue scripts and styles.
 */

function cotidien_scripts() {
	wp_enqueue_style( 'cotidien-style', get_stylesheet_uri(), array(), COTIDIEN_VERSION );
	wp_enqueue_script( 'cotidien-script', get_template_directory_uri() . '/js/script.min.js', array(), COTIDIEN_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'cotidien_scripts' );

// Hook into AJAX to update cart item quantities
add_action( 'wp_ajax_update_cart_item_quantities', 'update_cart_item_quantities' );
add_action( 'wp_ajax_nopriv_update_cart_item_quantities', 'update_cart_item_quantities' );

function update_cart_item_quantities() {
	// Check if the updated quantities are present in the request
	if ( isset( $_POST['updated_quantities'] ) && is_array( $_POST['updated_quantities'] ) ) {
		foreach ( $_POST['updated_quantities'] as $cart_item_key => $quantity ) {
			// Sanitize input
			$quantity = intval( $quantity );

			// Ensure the quantity is greater than or equal to 1
			if ( $quantity >= 1 ) {
				// Update the cart item quantity
				WC()->cart->set_quantity( $cart_item_key, $quantity );
			}
		}

		// Recalculate the cart totals
		WC()->cart->calculate_totals();

		// Send a success response
		wp_send_json_success();
	} else {
		// If there's no data or the data is invalid, send an error response
		wp_send_json_error();
	}
}

add_filter('woocommerce_default_address_fields', 'custom_default_address_fields');

function custom_default_address_fields($fields) {
    foreach ($fields as $key => &$field) {
        $field['default'] = '';
    }
    return $fields;
}

add_filter('woocommerce_checkout_get_value', 'custom_checkout_value_clear', 10, 2);
function custom_checkout_value_clear($value, $input) {
    // List of fields to make null
    $fields_to_clear = [
        'billing_address_1',
        'billing_address_2',
        'billing_city',
        'billing_postcode',
        'billing_country',
        'billing_state',
        'billing_phone',
        'billing_email'
        // Add shipping fields as needed
    ];

    if (in_array($input, $fields_to_clear)) {
        return '';
    }

    return $value;
}


/**
 * Enqueue the block editor script.
 */
function cotidien_enqueue_block_editor_script() {
	if ( is_admin() ) {
		wp_enqueue_script(
			'cotidien-editor',
			get_template_directory_uri() . '/js/block-editor.min.js',
			array(
				'wp-blocks',
				'wp-edit-post',
			),
			COTIDIEN_VERSION,
			true
		);
		wp_add_inline_script( 'cotidien-editor', "tailwindTypographyClasses = '" . esc_attr( COTIDIEN_TYPOGRAPHY_CLASSES ) . "'.split(' ');", 'before' );
	}
}
add_action( 'enqueue_block_assets', 'cotidien_enqueue_block_editor_script' );

/**
 * Add the Tailwind Typography classes to TinyMCE.
 *
 * @param array $settings TinyMCE settings.
 * @return array
 */
function cotidien_tinymce_add_class( $settings ) {
	$settings['body_class'] = COTIDIEN_TYPOGRAPHY_CLASSES;
	return $settings;
}
add_filter( 'tiny_mce_before_init', 'cotidien_tinymce_add_class' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';
