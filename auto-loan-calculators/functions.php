<?php
/**
 * Auto Loan Calculators functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Auto_Loan_Calculators
 */

if ( ! function_exists( 'auto_loan_calculators_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function auto_loan_calculators_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Auto Loan Calculators, use a find and replace
		 * to change 'auto-loan-calculators' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'auto-loan-calculators', get_template_directory() . '/languages' );

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

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary Navigation', 'auto-loan-calculators' ),
		) );
		register_nav_menus( array(
			'top' => esc_html__( 'Top Navigation', 'auto-loan-calculators' ),
		) );

		/* Setup 'Parnters' custom post type */
		add_action( 'init', 'partners_init' );
		function partners_init() {
			$labels = array(
				'name'               => _x( 'Partners', 'post type general name', 'your-plugin-textdomain' ),
				'singular_name'      => _x( 'Partner', 'post type singular name', 'your-plugin-textdomain' ),
				'menu_name'          => _x( 'Partners', 'admin menu', 'your-plugin-textdomain' ),
				'name_admin_bar'     => _x( 'Partner', 'add new on admin bar', 'your-plugin-textdomain' ),
				'add_new'            => _x( 'Add New', 'partner', 'your-plugin-textdomain' ),
				'add_new_item'       => __( 'Add New Partner', 'your-plugin-textdomain' ),
				'new_item'           => __( 'New Partner', 'your-plugin-textdomain' ),
				'edit_item'          => __( 'Edit Partner', 'your-plugin-textdomain' ),
				'view_item'          => __( 'View Partner', 'your-plugin-textdomain' ),
				'all_items'          => __( 'All Partners', 'your-plugin-textdomain' ),
				'search_items'       => __( 'Search Partners', 'your-plugin-textdomain' ),
				'parent_item_colon'  => __( 'Parent Partners:', 'your-plugin-textdomain' ),
				'not_found'          => __( 'No partners found.', 'your-plugin-textdomain' ),
				'not_found_in_trash' => __( 'No partners found in Trash.', 'your-plugin-textdomain' )
			);

			$args = array(
				'labels'             => $labels,
				'description'        => __( 'Description.', 'your-plugin-textdomain' ),
				'public'             => true,
				'publicly_queryable' => true,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'query_var'          => true,
				'rewrite'            => array( 'slug' => 'partner' ),
				'capability_type'    => 'post',
				'has_archive'        => true,
				'hierarchical'       => false,
				'menu_position'      => null,
				'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
			);

			register_post_type( 'partner', $args );
		}

		add_action('admin_init', 'admin_init');
		function admin_init() {
			add_meta_box("account_name", "Account Name", "account_name", "partner", "side", "low");
			add_meta_box("account_number", "Account Number", "account_number", "partner", "side", "low");
			add_meta_box("sidebar_linkout_clicks", "Sidebar Linkout Clicks", "sidebar_linkout_clicks", "partner", "side", "low");
			add_meta_box("button_linkout_clicks", "Button Linkout Clicks", "button_linkout_clicks", "partner", "side", "low");
		}

		function account_name() {
			global $post;
			$custom = get_post_custom($post->ID);
			$account_name = $custom['account_name'][0]; ?>
			<input name="account_name" value="<?php echo $account_name; ?>"/>
		<?php }

		function account_number() {
			global $post;
			$custom = get_post_custom($post->ID);
			$account_number = $custom['account_number'][0]; ?>
			<input name="account_number" value="<?php echo $account_number; ?>"/>
		<?php }

		function sidebar_linkout_clicks() {
			global $post;
			$custom = get_post_custom($post->ID);
			$sidebar_linkout_clicks = $custom['sidebar_linkout_clicks'][0]; ?>
			<input name="sidebar_linkout_clicks" value="<?php echo $sidebar_linkout_clicks; ?>"/>
		<?php }

		function button_linkout_clicks() {
			global $post;
			$custom = get_post_custom($post->ID);
			$button_linkout_clicks = $custom['button_linkout_clicks'][0]; ?>
			<input name="button_linkout_clicks" value="<?php echo $button_linkout_clicks; ?>"/>
		<?php }

		add_action('save_post', 'save_partner_info');
		function save_partner_info() {
			global $post;

			update_post_meta($post->ID, 'account_name', $_POST['account_name']);
			update_post_meta($post->ID, 'account_number', $_POST['account_number']);
			update_post_meta($post->ID, 'sidebar_linkout_clicks', $_POST['sidebar_linkout_clicks']);
			update_post_meta($post->ID, 'button_linkout_clicks', $_POST['button_linkout_clicks']);
		}

		add_filter('manage_partner_posts_columns', 'partner_posts_columns');
		function partner_posts_columns($columns) {
			$columns = array(
				'cb' 						=> $columns['cb'],
				'title'						=> __( 'Title' ),
				'account_name' 				=> __( 'Account Name' ),
				'account_number'			=> __( 'Account Number' ),
				'sidebar_linkout_clicks'	=> __( 'Sidebar Linkout Clicks' ),
				'button_linkout_clicks'		=> __( 'Button Linkout Clicks' ),
				'author'					=> __( 'Author' ),
				'comments'					=> $columns['comments'],
				'date'						=> __( 'Date' ),
			); 
			return $columns;
		}

		add_action('manage_partner_posts_custom_column', 'partner_posts_custom_column');
		function partner_posts_custom_column($column) {
			global $post;

			if ('account_name' === $column) {
				$custom = get_post_custom();
				echo $custom['account_name'][0];
			}

			if ('account_number' === $column) {
				$custom = get_post_custom();
				echo $custom['account_number'][0];
			}

			if ('sidebar_linkout_clicks' === $column) {
				$custom = get_post_custom();
				echo $custom['sidebar_linkout_clicks'][0];
			}

			if ('button_linkout_clicks' === $column) {
				$custom = get_post_custom();
				echo $custom['button_linkout_clicks'][0];
			}
		}

		add_filter('manage_edit-partner_sortable_columns', 'partner_sortable_columns');
		function partner_sortable_columns($columns) {
			$columns['account_name'] = 'account_name';
			$columns['account_number'] = 'account_number';
			$columns['sidebar_linkout_clicks'] = 'sidebar_linkout_clicks';
			$columns['button_linkout_clicks'] = 'button_linkout_clicks';
			return $columns;
		}

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'auto_loan_calculators_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'auto_loan_calculators_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function auto_loan_calculators_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'auto_loan_calculators_content_width', 640 );
}
add_action( 'after_setup_theme', 'auto_loan_calculators_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function auto_loan_calculators_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'auto-loan-calculators' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'auto-loan-calculators' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'auto_loan_calculators_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function auto_loan_calculators_scripts() {
	wp_enqueue_style( 'auto-loan-calculators-style', get_template_directory_uri() . '/css/dist/styles.min.css' );

	wp_enqueue_script( 'auto-loan-calculators-jqueryui', '//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js', array('jquery'), '20151215', true );
	wp_register_script( 'auto-loan-calculators-scripts', get_template_directory_uri() . '/js/dist/scripts.min.js', array('jquery'), '1.0.0', true );
	wp_localize_script( 'auto-loan-calculators-scripts', 'ajax', array( 'url' => admin_url('admin-ajax.php')) );
	wp_enqueue_script( 'auto-loan-calculators-scripts' );

	// wp_enqueue_script( 'auto-loan-calculators-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
	// wp_enqueue_script( 'auto-loan-calculators-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
	// wp_enqueue_script( 'auto-loan-calculators', get_template_directory_uri() . '/js/calculators.js', array('jquery'), '20151215', true );
	// wp_enqueue_script( 'auto-loan-calculators-iris', get_template_directory_uri() . '/js/libs/iris.min.js', array('jquery'), '20151215', true );
	// wp_enqueue_script( 'auto-loan-calculators-widget-ui', get_template_directory_uri() . '/js/widget-ui.js', array('jquery'), '20151216', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'auto_loan_calculators_scripts' );

/**
 * Include form processors for the site.
 */
require get_template_directory() . '/inc/form-processor.php';

/**
 * Include script for the 'Email Me' button.
 */
require get_template_directory() . '/inc/email-button.php';

/**
 * Include script that updates the linkout data for the featured partner posts.
 */
require get_template_directory() . '/inc/update-linkout.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Include 'Theme Settings' options page in the back-end of WordPress
 */
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));	
}

/*
* Creating a custom post type to register form leads
*/
function form_leads_cpt() {
// Set UI labels for Custom Post Type
	$labels = array(
		'name'                => _x( 'Leads', 'Post Type General Name', 'twentytwenty' ),
		'singular_name'       => _x( 'Lead', 'Post Type Singular Name', 'twentytwenty' ),
		'menu_name'           => __( 'Leads', 'twentytwenty' ),
		'parent_item_colon'   => __( 'Parent Lead', 'twentytwenty' ),
		'all_items'           => __( 'All Leads', 'twentytwenty' ),
		'view_item'           => __( 'View Lead', 'twentytwenty' ),
		'add_new_item'        => __( 'Add New Lead', 'twentytwenty' ),
		'add_new'             => __( 'Add New', 'twentytwenty' ),
		'edit_item'           => __( 'Edit Lead', 'twentytwenty' ),
		'update_item'         => __( 'Update Lead', 'twentytwenty' ),
		'search_items'        => __( 'Search Lead', 'twentytwenty' ),
		'not_found'           => __( 'Not Found', 'twentytwenty' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'twentytwenty' ),
	);
		
// Set other options for Custom Post Type
		
	$args = array(
		'label'               => __( 'leads', 'twentytwenty' ),
		'description'         => __( 'Form Leads', 'twentytwenty' ),
		'labels'              => $labels,
		// Features this CPT supports in Post Editor
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
		// You can associate this CPT with a taxonomy or custom taxonomy. 
		'taxonomies'          => array( 'category' ),
		/* A hierarchical CPT is like Pages and can have
		* Parent and child items. A non-hierarchical CPT
		* is like Posts.
		*/ 
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
		'show_in_rest' => true,
	
	);
		
	// Registering your Custom Post Type
	register_post_type( 'leads', $args );
}
add_action( 'init', 'form_leads_cpt', 0 );

// Disable use XML-RPC
remove_action ('wp_head', 'rsd_link');

// Remove Gutenburg Block Library CSS
add_action( 'wp_enqueue_scripts', 'webapptiv_remove_block_library_css' );
function webapptiv_remove_block_library_css() {
	wp_dequeue_style( 'wp-block-library' ); 
}