<?php
/*
 *  Author: Todd Motto | @toddmotto
 *  URL: html5blank.com | @html5blank
 *  Custom functions, support, custom post types and more.
 */

/*------------------------------------*\
	External Modules/Files
\*------------------------------------*/

// Load any external files you have here



/*------------------------------------*\
	Theme Support
\*------------------------------------*/

if (!isset($content_width))
{
    $content_width = 900;
}

if (function_exists('add_theme_support'))
{
    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support( 'post-thumbnails' );
    // add_image_size('new-thumbnail', 675, 400, true);


    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');

}

/*------------------------------------*\
	Functions
\*------------------------------------*/

// HTML5 Blank navigation
// function html5blank_nav()
// {
// 	wp_nav_menu(
// 	array(
// 		'theme_location'  => 'header-menu',
// 		'menu'            => '',
// 		'container'       => 'div',
// 		'container_class' => 'menu-{menu slug}-container',
// 		'container_id'    => '',
// 		'menu_class'      => 'menu',
// 		'menu_id'         => '',
// 		'echo'            => true,
// 		'fallback_cb'     => 'wp_page_menu',
// 		'before'          => '',
// 		'after'           => '',
// 		'link_before'     => '',
// 		'link_after'      => '',
// 		'items_wrap'      => '<ul>%3$s</ul>',
// 		'depth'           => 0,
// 		'walker'          => ''
// 		)
// 	);
// }

// function my_nav_wrap() {
//     // default value of 'items_wrap' is <ul id="%1$s" class="%2$s">%3$s</ul>'
//
//     // open the <ul>, set 'menu_class' and 'menu_id' values
//     $wrap  = '<ul id="%1$s" class="%2$s">';
//
//     // get nav items as configured in /wp-admin/
//     $wrap .= '%3$s';
//
//     // close the <ul>
//     $wrap .= '</ul>';
//     // return the result
//     return $wrap;
// }

// function my_header_nav_with_logo_wrap() {
//     // default value of 'items_wrap' is <ul id="%1$s" class="%2$s">%3$s</ul>'
//
//     // open the <ul>, set 'menu_class' and 'menu_id' values
//     $wrap  = '<ul id="%1$s" class="%2$s">';
//
//     // the static link w/ logo
//     $wrap .= '<li><a class="nav-logo" href="/"><svg class="icon"><use xlink:href="#gs_logo"></use></svg></a></li>';
//
//     // get nav items as configured in /wp-admin/
//     $wrap .= '%3$s';
//
//     // close the <ul>
//     $wrap .= '</ul>';
//     // return the result
//     return $wrap;
// }

// function my_footer_nav_with_logo_wrap() {
//     // default value of 'items_wrap' is <ul id="%1$s" class="%2$s">%3$s</ul>'
//
//     // open the <ul>, set 'menu_class' and 'menu_id' values
//     $wrap  = '<ul id="%1$s" class="%2$s">';
//
//     // the static link w/ logo
//     $wrap .= '<li><a href="/"><img src="' . get_template_directory_uri() . '/img/logo-inverse.svg" class="logo"></a></li>';
//
//     // get nav items as configured in /wp-admin/
//     $wrap .= '%3$s';
//
//     // close the <ul>
//     $wrap .= '</ul>';
//     // return the result
//     return $wrap;
// }

// Load HTML5 Blank scripts (header.php)
function html5blank_header_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {


        wp_register_script('modernizr', get_template_directory_uri() . '/js/lib/modernizr-2.7.1.min.js', array(), '2.7.1'); // Modernizr
        wp_enqueue_script('modernizr'); // Enqueue it!


        // wp_register_script('validationscripts', get_template_directory_uri() . '/js/lib/jquery.validate.min.js', array('jquery'), '1.15.0'); // Custom scripts
        // wp_enqueue_script('validationscripts'); // Enqueue it!


        wp_register_script('magnificscripts', get_template_directory_uri() . '/lib/magnific/jquery.magnific-popup.min.js', array('jquery'), '1.1.0'); // Custom scripts
        wp_enqueue_script('magnificscripts'); // Enqueue it!

        wp_register_script('slick', get_template_directory_uri() . '/js/lib/slick.min.js', array('jquery'), '1.1.0'); // Custom scripts
        wp_enqueue_script('slick'); // Enqueue it!

        wp_register_script('stickykit', get_template_directory_uri() . '/js/lib/jquery.sticky-kit.js', array('jquery'), '1.1.0'); // Custom scripts
        wp_enqueue_script('stickykit'); // Enqueue it!

        wp_register_script('scrollr', get_template_directory_uri() . '/js/lib/scrollr.js', array('jquery'), '1.1.0'); // Custom scripts
        wp_enqueue_script('scrollr'); // Enqueue it!




        // wp_register_script('svg4everybodyscripts', get_template_directory_uri() . '/js/lib/svg4everybody.min.js', array(), '2.0.3'); // Custom scripts
        // wp_enqueue_script('svg4everybodyscripts'); // Enqueue it!

        wp_register_script('slideoutscripts', get_template_directory_uri() . '/js/lib/slideout.min.js', array(), '0.1.12'); // Custom scripts
        wp_enqueue_script('slideoutscripts'); // Enqueue it!

        $path = get_template_directory() . '/js/scripts.js';
        $modified = filemtime( $path );
        wp_register_script('html5blankscripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), $modified); // Custom scripts

        wp_enqueue_script('html5blankscripts'); // Enqueue it!
    }
}

// Load HTML5 Blank styles
function html5blank_styles()
{
    wp_register_style('normalize', get_template_directory_uri() . '/normalize.css', array(), '1.0', 'all');
    wp_enqueue_style('normalize'); // Enqueue it!

    wp_register_style('magnific', get_template_directory_uri() . '/lib/magnific/magnific-popup.css', array(), '1.0', 'all');
    wp_enqueue_style('magnific'); // Enqueue it!

    // $path = get_template_directory() . '/fonts/fonts.css';
    // $modified = filemtime( $path );
    // wp_register_style('fonts', get_template_directory_uri() . '/fonts/fonts.css', array(), $modified, 'all');
    // wp_enqueue_style('fonts'); // Enqueue it!

    // $path = get_template_directory() . '/fonts/fontawesome.css';
    // $modified = filemtime( $path );
    // wp_register_style('fontawesome', get_template_directory_uri() . '/fonts/fontawesome.css', array(), $modified, 'all');
    // wp_enqueue_style('fontawesome'); // Enqueue it!

    //enqueues our external font awesome stylesheet

    $path = get_template_directory() . '/style.css';
    $modified = filemtime( $path );
    wp_register_style('html5blank', get_template_directory_uri() . '/style.css', array(), $modified, 'all');
    wp_enqueue_style('html5blank'); // Enqueue it!
}

function enqueue_our_required_stylesheets(){
  wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css');
}
add_action('wp_enqueue_scripts','enqueue_our_required_stylesheets');

// Register HTML5 Blank Navigation
function register_html5_menu()
{
    register_nav_menus(array( // Using array to specify more menus if needed
        'header-menu' => __('Header Menu', 'html5blank') // Main Navigation

    ));
}



// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}

// If Dynamic Sidebar Exists
if (function_exists('register_sidebar'))
{
    // Define Sidebar Widget Area 3
    // register_sidebar(array(
    //     'name' => __('Connect With Us', 'html5blank'),
    //     'description' => __('Description for this widget-area...', 'html5blank'),
    //     'id' => 'widget-area-2',
    //     'before_widget' => '<div id="%1$s" class="%2$s">',
    //     'after_widget' => '</div>',
    //     'before_title' => '<h3>',
    //     'after_title' => '</h3>'
    // ));
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
// function html5wp_pagination()
// {
//     global $wp_query;
//     $big = 999999999;
//     echo paginate_links(array(
//         'base' => str_replace($big, '%#%', get_pagenum_link($big)),
//         'format' => '?paged=%#%',
//         'current' => max(1, get_query_var('paged')),
//         'total' => $wp_query->max_num_pages
//     ));
// }

// Custom Excerpts
// function html5wp_index($length) // Create 20 Word Callback for Index page Excerpts, call using html5wp_excerpt('html5wp_index');
// {
//     return 20;
// }

// Create 40 Word Callback for Custom Post Excerpts, call using html5wp_excerpt('html5wp_custom_post');
// function html5wp_custom_post($length)
// {
//     return 40;
// }

// Create the Custom Excerpts callback
// function html5wp_excerpt($length_callback = '', $more_callback = '')
// {
//     global $post;
//     if (function_exists($length_callback)) {
//         add_filter('excerpt_length', $length_callback);
//     }
//     if (function_exists($more_callback)) {
//         add_filter('excerpt_more', $more_callback);
//     }
//     $output = get_the_excerpt();
//     $output = apply_filters('wptexturize', $output);
//     $output = apply_filters('convert_chars', $output);
//     $output = '<p>' . $output . '</p>';
//     echo $output;
// }

// Custom View Article link to Post
// function html5_blank_view_article($more)
// {
//     global $post;
//     return '... <a class="text-cta" href="' . get_permalink($post->ID) . '">' . __('More', 'html5blank') . '</a>';
// }

// Remove Admin bar
function remove_admin_bar()
{
    return false;
}

// Remove 'text/css' from our enqueued stylesheet
// function html5_style_remove($tag)
// {
//     return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
// }

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

// Custom Gravatar in Settings > Discussion
// function html5blankgravatar ($avatar_defaults)
// {
//     $myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
//     $avatar_defaults[$myavatar] = "Custom Gravatar";
//     return $avatar_defaults;
// }

// Threaded Comments
// function enable_threaded_comments()
// {
//     if (!is_admin()) {
//         if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
//             wp_enqueue_script('comment-reply');
//         }
//     }
// }



/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('init', 'html5blank_header_scripts'); // Add Custom Scripts to wp_head
// add_action('wp_print_scripts', 'html5blank_conditional_scripts'); // Add Conditional Page Scripts
// add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('wp_enqueue_scripts', 'html5blank_styles'); // Add Theme Stylesheet
add_action('init', 'register_html5_menu'); // Add HTML5 Blank Menu
// add_action('init', 'create_post_type_resources'); // Add our Resources Custom Post Type
// add_action('init', 'create_post_type_ctas'); // Add our CTAs Custom Post Type
// add_action('init', 'create_post_type_billboards'); // Add our CTAs Custom Post Type
// add_action('init', 'create_post_type_team'); // Add our CTAs Custom Post Type
// add_action('init', 'create_post_type_projects'); // Add our CTAs Custom Post Type
// add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
// add_action('init', 'html5wp_pagination'); // Add our HTML5 Pagination




// add custom styles to WYSIWYG styles dropdown
function my_theme_add_editor_styles() {
    add_editor_style( 'tinymce-style.css' );
}
add_action( 'admin_init', 'my_theme_add_editor_styles' );

// add fonts to WYSIWYG editor
function my_theme_add_editor_fonts() {
    $font_url = str_replace( ',', '%2C', '//fonts.googleapis.com/css?family=Roboto:400,700|Roboto+Condensed:300,400,500,700|Questrial:400' );
    add_editor_style( $font_url );
}
add_action( 'after_setup_theme', 'my_theme_add_editor_fonts' );


// Callback function to insert 'styleselect' into the $buttons array
function my_mce_buttons_2( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}
// Register our callback to the appropriate filter
add_filter('mce_buttons_2', 'my_mce_buttons_2');


// Callback function to filter the MCE settings
function my_mce_before_init_insert_formats( $init_array ) {
    // Define the style_formats array
    $style_formats = array(

        array(
            'title' => 'Emphasis',
            'block' => 'p',
            'classes' => 'emphasis',
            'wrapper' => false
        ),
        array(
            'title' => 'Emphasis Small',
            'block' => 'p',
            'classes' => 'emphasis-sm',
            'wrapper' => false
        ),
        array(
            'title' => 'Pull Quote Right',
            'block' => 'blockquote',
            'classes' => 'pull-quote-right',
            'wrapper' => false
        ),
        array(
            'title' => 'Pull Quote Left',
            'block' => 'blockquote',
            'classes' => 'pull-quote-left',
            'wrapper' => false
        ),
        array(
            'title' => 'Button',
            'selector' => 'a',
            'classes' => 'btn',
            'wrapper' => false
        ),
        array(
            'title' => 'Button Outline',
            'selector' => 'a',
            'classes' => 'btn btn-outlined',
            'wrapper' => false
        ),
        array(
            'title' => 'Yellow',
            'classes' => 'text-yellow',
            'inline' => 'span',
            'wrapper' => false
        ),
    );
    // Insert the array, JSON ENCODED, into 'style_formats'
    $init_array['style_formats'] = json_encode( $style_formats );

    return $init_array;

}
// Attach callback to 'tiny_mce_before_init'
add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' );






// Remove Actions
// remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
// remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
// remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
// remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
// remove_action('wp_head', 'index_rel_link'); // Index link
// remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
// remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
// remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
// remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
// remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
// remove_action('wp_head', 'rel_canonical');
// remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
// add_filter('avatar_defaults', 'html5blankgravatar'); // Custom Gravatar in Settings > Discussion
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
// add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
// add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
// add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
// add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
// add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
// add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
// add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('excerpt_more', 'html5_blank_view_article'); // Add 'View Article' button instead of [...] for Excerpts
add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
// add_filter('style_loader_tag', 'html5_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images

// Remove Filters
// remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether

// Shortcodes
// add_shortcode('html5_shortcode_demo', 'html5_shortcode_demo'); // You can place [html5_shortcode_demo] in Pages, Posts now.
// add_shortcode('html5_shortcode_demo_2', 'html5_shortcode_demo_2'); // Place [html5_shortcode_demo_2] in Pages, Posts now.

// Shortcodes above would be nested like this -
// [html5_shortcode_demo] [html5_shortcode_demo_2] Here's the page title! [/html5_shortcode_demo_2] [/html5_shortcode_demo]

/*------------------------------------*\
	Custom Post Types
\*------------------------------------*/

// Create Custom Post type called Resources
// function create_post_type_resources()
// {
//     // register_taxonomy_for_object_type('category', 'jobs'); // Register Taxonomies for Category
//     // register_taxonomy_for_object_type('post_tag', 'jobs');
//     register_post_type('gs_resources', // Register Custom Post Type
//         array(
//         'labels' => array(
//             'name' => __('Resources', 'gsresources'), // Rename these to suit
//             'singular_name' => __('Resource', 'gsresources'),
//             'add_new' => __('Add New', 'gsresources'),
//             'add_new_item' => __('Add New Resource', 'gsresources'),
//             'edit' => __('Edit', 'gsresources'),
//             'edit_item' => __('Edit Resource', 'gsresources'),
//             'new_item' => __('New Resource', 'gsresources'),
//             'view' => __('View Resources', 'gsresources'),
//             'view_item' => __('View Resource', 'gsresources'),
//             'search_items' => __('Search Resources', 'gsresources'),
//             'not_found' => __('No Resources found', 'gsresources'),
//             'not_found_in_trash' => __('No Resources found in Trash', 'gsresources')
//         ),
//         'public' => true,
//         'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
//         'has_archive' => true,
//         'menu_icon' => 'dashicons-album',
//         'supports' => array(
//             'title',
//             'editor',
//             'excerpt',
//             'thumbnail'
//         ), // Go to Dashboard Custom HTML5 Blank post for supports
//         'can_export' => true, // Allows export in Tools > Export
//         'rewrite' => array('slug' => 'resource')
//         // 'taxonomies' => array(
//         //     'post_tag',
//         //     'category'
//         // ) // Add Category and Post Tags support
//     ));
// }
//
// function create_resource_taxonomies() {
//
//     register_taxonomy(
//         'resources',
//         'gs_resources',
//         array(
//             'labels' => array(
//                 'name' => 'Resource Types',
//                 'add_new_item' => 'Add New Type',
//                 'new_item_name' => 'New Type',
//                 'search_items' => 'Search Types',
//                 'not_found' => 'No Types found'
//             ),
//             'show_ui' => true,
//             'show_tagcloud' => false,
//             'hierarchical' => true
//         )
//     );
//     register_taxonomy(
//         'resourcecategory',
//         'gs_resources',
//         array(
//             'labels' => array(
//                 'name' => 'Resource Categories',
//                 'add_new_item' => 'Add New Category',
//                 'new_item_name' => 'New Category',
//                 'search_items' => 'Search Categories',
//                 'not_found' => 'No Categories found'
//             ),
//             'show_ui' => true,
//             'show_tagcloud' => false,
//             'hierarchical' => false
//         )
//     );
// }
// add_action( 'init', 'create_resource_taxonomies', 0 );



/* Custom Excerpt */
function new_excerpt($limit) {
 $excerpt = explode(' ', get_the_excerpt(), $limit);
 if (count($excerpt)>=$limit) {
 array_pop($excerpt);
 $excerpt = implode(" ",$excerpt).'...';
 } else {
 $excerpt = implode(" ",$excerpt);
 }
 $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
 return $excerpt;
}

// function content($limit) {
//  $content = explode(' ', get_the_content(), $limit);
//  if (count($content)>=$limit) {
//  array_pop($content);
//  $content = implode(" ",$content).'...';
//  } else {
//  $content = implode(" ",$content);
//  }
//  $content = preg_replace('/[.+]/','', $content);
//  $content = apply_filters('the_content', $content);
//  $content = str_replace(']]>', ']]&gt;', $content);
//  return $content;
// }


/* Add support for SVG uploads */

add_filter('upload_mimes', 'custom_upload_mimes');

function custom_upload_mimes ( $existing_mimes=array() ) {

	// add the file extension to the array
	$existing_mimes['svg'] = 'mime/type';

  // call the modified list of extensions
	return $existing_mimes;

}

// add styles to ACF classes (makes repeater secitons more readable)
add_action('admin_head', 'my_custom_fonts');
function my_custom_fonts() {
  echo '<style>
    .acf-repeater.-row > table > tbody > tr > td, .acf-repeater.-block > table > tbody > tr > td {
    border-top-color: #dedede;
    border-top-width:4px;
    }
    .acf-flexible-content .layout {
      border-top-color: #dedede;
      border-top-width:4px;
    }

  </style>';
}

// ACF add options page
if( function_exists('acf_add_options_page') ) {

	acf_add_options_page();

}

// function custom_rewrite_resources() {
//     // make sure you're using a custom permalink (/%category%/%postname%/)
//     add_rewrite_rule('^resources/([^/]+)/([^/]+)/?', 'index.php?post_type=resources&resources=$matches[1]&resourcecategory=$matches[2]', 'top');
// }
// add_action('init', 'custom_rewrite_resources');

/*------------------------------------*\
	ShortCode Functions
\*------------------------------------*/

// Shortcode Demo with Nested Capability
// function html5_shortcode_demo($atts, $content = null)
// {
//     return '<div class="shortcode-demo">' . do_shortcode($content) . '</div>'; // do_shortcode allows for nested Shortcodes
// }
//
// // Shortcode Demo with simple <h2> tag
// function html5_shortcode_demo_2($atts, $content = null) // Demo Heading H2 shortcode, allows for nesting within above element. Fully expandable.
// {
//     return '<h2>' . $content . '</h2>';
// }

?>
