<?php
/**
 * colaba functions and definitions
 *
 * @package colaba
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'colaba_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function colaba_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on colaba, use a find and replace
	 * to change 'colaba' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'colaba', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'colaba' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'colaba_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // colaba_setup
add_action( 'after_setup_theme', 'colaba_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function colaba_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'colaba' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<span class="widget-title">',
		'after_title'   => '</span>',
	) );
}
add_action( 'widgets_init', 'colaba_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function colaba_scripts() {
	wp_enqueue_style( 'colaba-style', get_stylesheet_uri() );

	wp_enqueue_script( 'colaba-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'colaba-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'colaba_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


//logo

function register_my_logo() {
 register_setting( 'logo_options_group', 'logo_options_group'); }
add_action( 'admin_init', 'register_my_logo' );

//create your options page for your logo options like so
function add_logo_page_to_settings() {
 add_theme_page('Theme Logo',
'Customize Logo->',
'manage_options',
'edit_logo',
'logo_edit_page'); }
add_action('admin_menu', 'add_logo_page_to_settings');



function logo_edit_page() {  ?>
 <div class="section panel">
      <h1>Custom Logo Options</h1>
      <form method="post" enctype="multipart/form-data" action="options.php">
<?php settings_fields('logo_options_group'); // this will come later
do_settings_sections('logo_options_group'); // and this too...
        ?> <p class="submit">
<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" /></p></form>
<?php  }


function add_logo_options_to_page(){
add_settings_section(
  'custom_logo',
  'Customize the site logo:',
  'custom_logo_fields',
  'logo_options_group' );
$args=array(); // pass arguments to add_settings_array to use in fields
add_settings_field( 'logo_url', "Logo Url", 'logo_upload_url' , 'logo_options_group', 'custom_logo', $args );
// here you can add more settings fields like width, height etc... just make sure that the "logo_options_group" and "custom_logo" stay..
// more info at:
//http://codex.wordpress.org/Function_Reference/add_settings_field
}
add_action('admin_init','add_logo_options_to_page');


function logo_upload_url($args){
$options=get_option('logo_options_group') ;
?><br>
<label for="upload_image">
<input id="url" type="text" size="36" value="<?php echo $options['url']; ?>" name="logo_options_group[url]" />
<input id="upload_logo_button" type="button" value="Upload Image" />
<br />Enter an URL or upload an image for the banner.
</label>
<script type="text/javascript">
jQuery(document).ready(function() {
jQuery('#upload_logo_button').click(function() {
 formfield = jQuery('#url').attr('name');
 tb_show('', 'media-upload.php?type=image&TB_iframe=true');
 return false;});
window.send_to_editor = function(html) {
 imgurl = jQuery('img',html).attr('src');
 jQuery('#url').val(imgurl);
 tb_remove(); }});
</script>
<?php
if($options['url']){
echo "<br>This is your current logo: <br><img src='". $options['url'] ."' style='padding:20px;' />";
echo "<br>To use it in a theme copy this: <blockquote>". htmlspecialchars("<?php do_shortcode('[sitelogo]'); ?>") ."</blockquote><br> To use it in a post or page copy this code:<blockquote>[sitelogo]</blockquote>";  }}

function custom_logo_fields(){
// you can add stuff here if you like...
}
function my_admin_scripts() {
wp_enqueue_script('media-upload');
wp_enqueue_script('thickbox');}
function my_admin_styles() {
wp_enqueue_style('thickbox');}
if (isset($_GET['page']) && $_GET['page'] == 'edit_logo') {
add_action('admin_print_scripts', 'my_admin_scripts');
add_action('admin_print_styles', 'my_admin_styles');
}

function get_site_logo(){
$option=get_option("logo_options_group");
if($option['url']){
echo "<img src='". $option['url'] ."' />";
} else {echo "Sorry, No logo selected";}}
add_shortcode('sitelogo', 'get_site_logo');