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
	
    //////// Section for About Page Images /////////
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

    //////// Section for Home Page Images /////////
    $wp_customize->add_section('home_section', array(
        'title' => __('Home Page Images'),
        'priority' => 30,
    ));

    // Header Image
    $wp_customize->add_setting('home_header_img', array(
        'default' => 'https://plus.unsplash.com/premium_photo-1721268770804-f9db0ce102f8?q=80&w=3870&auto=format&fit=crop',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'home_header_img', array(
        'label' => __('Home Header Image'),
        'section' => 'home_section',
        'settings' => 'home_header_img',
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





// Hook to capture all form submissions
function track_form_submission() {
    if ( isset( $_POST ) && !empty( $_POST ) ) {
        // Check if the form id matches our pattern 'cotidien-form-'
        if ( isset( $_POST['form_id'] ) && strpos( $_POST['form_id'], 'cotidien-form-' ) === 0 ) {
            // Get the form identifier
            $form_id = sanitize_text_field( $_POST['form_id'] );

            // Capture all POST data from the form
            $form_data = array();
            foreach ( $_POST as $key => $value ) {
                if ( $key !== 'form_id' ) { // We don't need to store the form_id itself
                    $form_data[$key] = sanitize_text_field( $value );
                }
            }

            // Save the submission in the database
            global $wpdb;
            $table_name = $wpdb->prefix . 'form_submissions';

            // Insert the submission data
            $wpdb->insert( 
                $table_name,
                array(
                    'form_id'   => $form_id,
                    'form_data' => json_encode( $form_data ),  // Save the form data as JSON (key-value pairs)
                    'submitted_at' => current_time( 'mysql' )
                )
            );
        }
    }
}
add_action( 'init', 'track_form_submission' );


 // Hook into 'wp' instead of 'init' for form data to be captured correctly.

// Display the success message globally at the top of the page
function display_form_submission_message() {
    if (get_transient('form_submission_success')) {
        echo '<div class="form-success-message font-jakarta" style="background-color: #fff; color: black; padding: 10px; text-align: center;">' . esc_html(get_transient('form_submission_success')) . '</div>';
        delete_transient('form_submission_success'); // Clear the success message after displaying
    }
}
add_action('wp_head', 'display_form_submission_message'); // This will make sure the message appears at the top

// Add admin menu page to view form submissions
function add_form_submission_menu() {
    add_menu_page(
        'Form Submissions', // Page title
        'Form Submissions', // Menu title
        'manage_options',   // Capability
        'form_submissions', // Menu slug
        'render_form_submission_page', // Callback function to render the page
        'dashicons-forms',  // Icon
        20 // Position
    );
}
add_action( 'admin_menu', 'add_form_submission_menu' );


// Render the form submissions page in the admin panel
function render_form_submission_page() {
    global $wpdb;

    // Default sorting by submitted_at in descending order (most recent first)
    $order_by = isset($_GET['orderby']) ? sanitize_text_field($_GET['orderby']) : 'submitted_at';
    $order = isset($_GET['order']) && $_GET['order'] == 'asc' ? 'ASC' : 'DESC';

    // Handle Pagination
    $per_page = 20; // Limit to 1 submission per page
    $paged = isset($_GET['paged']) ? intval($_GET['paged']) : 1; // Get current page number
    $offset = ( $paged - 1 ) * $per_page; // Calculate the offset

    // Query for the form submissions with pagination
    $table_name = $wpdb->prefix . 'form_submissions';
    $submissions = $wpdb->get_results( "SELECT * FROM $table_name ORDER BY $order_by $order LIMIT $per_page OFFSET $offset" );

    // Query to get the total number of submissions for pagination
    $total_submissions = $wpdb->get_var( "SELECT COUNT(*) FROM $table_name" );
    $total_pages = ceil( $total_submissions / $per_page ); // Calculate the total pages

    echo '<div class="wrap">';
    echo '<h1>Form Submissions</h1>';

    // Export button
    echo '<form method="post" action="' . esc_url( admin_url('admin-ajax.php') ) . '">';
    echo '<input type="hidden" name="action" value="export_submissions_to_zip">';
    echo '<button type="submit" class="button">Export CSV</button>';
    echo '</form>';

    // Delete Submission functionality
    if ( isset( $_GET['delete_submission'] ) && isset( $_GET['submission_id'] ) ) {
        $submission_id = intval( $_GET['submission_id'] );
        // Perform deletion from the database
        $wpdb->delete( $table_name, [ 'id' => $submission_id ] );
        echo '<div class="updated"><p>Submission deleted successfully.</p></div>';
    }

    // Display the submissions in a table
    if ($submissions) {
        echo '<table class="wp-list-table widefat fixed striped" style="margin-top:5px;">';
        echo '<thead><tr><th>ID</th><th>Form ID</th><th>Submitted Data</th><th>Submission Time</th><th>Action</th></tr></thead>';
        echo '<tbody>';

        foreach ($submissions as $submission) {
            // Decode the form data (no serialization, just JSON)
            $form_data = json_decode( $submission->form_data, true );

            $form_data_display = '';
            if (is_array($form_data)) {
                // Format form data as key-value pairs
                foreach ($form_data as $key => $value) {
                    $form_data_display .= "<strong>" . esc_html($key) . ":</strong> " . esc_html($value) . "<br>";
                }
            }

            echo '<tr>';
            echo '<td>' . esc_html( $submission->id ) . '</td>';
            echo '<td>' . esc_html( $submission->form_id ) . '</td>';
            echo '<td>' . $form_data_display . '</td>';
            echo '<td>' . esc_html( $submission->submitted_at ) . '</td>';
            echo '<td><a href="' . esc_url( add_query_arg(['delete_submission' => 1, 'submission_id' => $submission->id], admin_url('admin.php?page=form_submissions')) ) . '" class="button button-danger">Delete</a></td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
    } else {
        echo '<p>No submissions found.</p>';
    }

    // Pagination controls
    if ($total_pages > 1) {
        echo '<div class="tablenav"><div class="tablenav-pages">';

        // Previous page link
        if ($paged > 1) {
            echo '<a class="prev-page" href="' . esc_url( add_query_arg( 'paged', $paged - 1, admin_url('admin.php?page=form_submissions') ) ) . '">&laquo; Previous</a>';
        }

        // Next page link
        if ($paged < $total_pages) {
            echo '<a class="next-page" href="' . esc_url( add_query_arg( 'paged', $paged + 1, admin_url('admin.php?page=form_submissions') ) ) . '">Next &raquo;</a>';
        }

        echo '</div></div>';
    }

    echo '</div>';
}


// Handle the export to CSV functionality
function export_submissions_to_zip() {
    global $wpdb;

    // Check if the action is the right one for exporting
    if ( isset( $_POST['action'] ) && $_POST['action'] === 'export_submissions_to_zip' ) {
        
        // Debugging log
        error_log("Starting export process.");

        // Get form submissions from the database
        $table_name = $wpdb->prefix . 'form_submissions';
        $submissions = $wpdb->get_results( "SELECT * FROM $table_name ORDER BY submitted_at DESC" );

        // Debugging log if no submissions found
        if ( !$submissions ) {
            error_log("No submissions found.");
            die("No submissions found.");
        }

        // Create a temporary folder to store CSV files
        $temp_dir = wp_upload_dir()['basedir'] . '/form_exports/';
        if ( !file_exists( $temp_dir ) ) {
            mkdir( $temp_dir, 0755, true ); // Create the directory if it doesn't exist
        }

        // Group submissions by form_id
        $forms_data = [];
        foreach ( $submissions as $submission ) {
            $form_data = json_decode( $submission->form_data, true );
            $form_id = $submission->form_id;

            if ( !isset( $forms_data[$form_id] ) ) {
                $forms_data[$form_id] = [];
            }

            $forms_data[$form_id][] = [
                'id' => $submission->id,
                'form_id' => $submission->form_id,
                'submitted_at' => $submission->submitted_at,
                'form_data' => $form_data,
            ];
        }

        // Prepare CSV files for each form_id
        $csv_files = [];
        foreach ( $forms_data as $form_id => $form_submissions ) {

            // Create CSV header dynamically
            $csv_header = "ID,Form ID,Submission Time";
            $fields = [];

            // Get unique fields from the form data
            foreach ( $form_submissions as $submission ) {
                foreach ( $submission['form_data'] as $key => $value ) {
                    if ( !in_array( $key, $fields ) ) {
                        $fields[] = $key;
                    }
                }
            }

            // Add fields to the CSV header
            foreach ( $fields as $field ) {
                $csv_header .= ",$field";
            }
            $csv_header .= "\n";

            // Build the CSV content
            $csv_content = $csv_header;
            foreach ( $form_submissions as $submission ) {
                $row_data = [
                    esc_html( $submission['id'] ),
                    esc_html( $submission['form_id'] ),
                    esc_html( $submission['submitted_at'] ),
                ];

                // Add form data to the row
                foreach ( $fields as $field ) {
                    $row_data[] = isset( $submission['form_data'][$field] ) ? esc_html( $submission['form_data'][$field] ) : '';
                }

                $csv_content .= '"' . implode( '","', $row_data ) . "\"\n";
            }

            // Save the CSV content to a file in the temporary directory
            $csv_file_path = $temp_dir . "$form_id.csv";
            file_put_contents( $csv_file_path, $csv_content );
            $csv_files[] = $csv_file_path;
        }

        // Debugging log if CSV files are created
        error_log("CSV files created.");

        // Create a ZIP archive of all CSV files
        $zip_file = wp_upload_dir()['basedir'] . '/form_exports.zip';
        $zip = new ZipArchive();

        // Check if the ZIP file is created successfully
        if ( $zip->open( $zip_file, ZipArchive::CREATE ) !== true ) {
            error_log("Unable to create ZIP file.");
            die("Unable to create ZIP file.");
        }

        // Add each CSV file to the ZIP archive
        foreach ( $csv_files as $csv_file ) {
            $zip->addFile( $csv_file, basename( $csv_file ) );
        }

        $zip->close();

        // Debugging log if ZIP file is created
        error_log("ZIP file created.");

        // Offer the ZIP file for download
        header('Content-Type: application/zip');
        header('Content-Disposition: attachment; filename="form_submissions.zip"');
        header('Content-Length: ' . filesize( $zip_file ));
        readfile( $zip_file );

        // Clean up temporary files
        foreach ( $csv_files as $csv_file ) {
            unlink( $csv_file ); // Delete the CSV file after adding it to the ZIP
        }
        unlink( $zip_file ); // Delete the ZIP file after download

        exit;
    }
}

add_action( 'wp_ajax_export_submissions_to_zip', 'export_submissions_to_zip' );
add_action( 'wp_ajax_nopriv_export_submissions_to_zip', 'export_submissions_to_zip' );

// Create custom table to store form submissions on theme/plugin activation
// Check if the table exists and create it if necessary
function create_form_submission_table() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'form_submissions';

    // Check if the table already exists
    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {

        // Table doesn't exist, create it
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $table_name (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            form_id varchar(255) NOT NULL,
            form_data longtext NOT NULL,
            submitted_at datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
            PRIMARY KEY  (id)
        ) $charset_collate;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
    }
}
add_action( 'init', 'create_form_submission_table' );



add_action( 'wp_head', 'custom_checkout_inline_style' );
function custom_checkout_inline_style() {
	if ( is_checkout() ) {
		?>
		<style>
			@media (min-width: 1024px) {
				.entry-header {
					margin-left: 55px;
				}
			}

			@media (max-width: 1024px) {
				.entry-header {
					margin-left: 0px;
				}
			}
		</style>
		<?php
	}
}


add_action('wp_enqueue_scripts', 'custom_variation_buttons_script');


add_action('after_setup_theme', 'custom_woocommerce_image_sizes');
function custom_woocommerce_image_sizes() {
    add_image_size('custom-size-420x670', 420*1.5, 670*1.5, true); // 420x670px with cropping enabled
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
