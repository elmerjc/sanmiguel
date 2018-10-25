<?php
// Comment Section
function dentalcare_wp_move_comment_field_to_bottom( $fields )
{
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;
	return $fields;
}
add_filter( 'comment_form_fields', 'dentalcare_wp_move_comment_field_to_bottom' );

// To Add Place holders
add_filter( 'comment_form_default_fields', 'dentalcare_wp_comment_placeholders' );
function dentalcare_wp_comment_placeholders( $fields )
{
    $fields['author'] = str_replace('<input','<input placeholder="'.esc_attr('Enter your name','dentalcare'). '"', $fields['author'] );	
	$fields['email'] = str_replace('<input','<input placeholder="'. esc_attr('Enter your email','dentalcare'). '"',$fields['email']);	
    return $fields;
}
add_filter( 'comment_form_defaults', 'dentalcare_wp_textarea_insert' );

function dentalcare_wp_textarea_insert( $fields )
{
	$fields['comment_field'] = str_replace('<textarea','<textarea placeholder="'.esc_attr('Write Comment','dentalcare'). '"',$fields['comment_field']);	
    return $fields;
}
// To remove Website field
function dentalcare_alter_comment_form_fields($fields){
    $fields['url'] = '';  //removes website field
    return $fields;
}
add_filter('comment_form_default_fields','dentalcare_alter_comment_form_fields');


if ( ! function_exists( 'dentalcare_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own dentalcare_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @return void
 */
function dentalcare_comment( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    switch ( $comment->comment_type ) :
        case 'pingback' :
        case 'trackback' :
        // Display trackbacks differently than normal comments.
    ?>
    <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
        <p><?php esc_html__( 'Pingback:', 'dentalcare' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( esc_html__( '(Edit)', 'dentalcare' ), '<span class="edit-link">', '</span>' ); ?></p>
    <?php
            break;
        default :
        // Proceed with normal comments.
        global $post;
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
        <article id="comment-<?php comment_ID(); ?>" class="comment clearfix">
            <?php echo get_avatar( $comment, 60 ); ?>
            <div class="comment-wrapper">
                <header class="comment-meta comment-author vcard">
                    <?php
                        printf( '<cite><b class="fn">%1$s</b> %2$s</cite>',
                            get_comment_author_link(),
                            // If current post author is also comment author, make it known visually.
                            ( $comment->user_id === $post->post_author ) ? '<span>' . esc_html__( 'Post author', 'dentalcare' ) . '</span>' : ''
                        );
                        printf( '<a class="comment-time" href="%1$s"><time datetime="%2$s">%3$s</time></a>',
                            esc_url( get_comment_link( $comment->comment_ID ) ),
                            get_comment_time( 'c' ),
                            /* translators: 1: date, 2: time */
                            sprintf( esc_html__( '%1$s', 'dentalcare' ), get_comment_date() )
                        );
                        comment_reply_link( array_merge( $args, array( 'reply_text' => esc_html__( 'Reply', 'dentalcare' ), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) );
                        edit_comment_link( esc_html__( 'Edit', 'dentalcare' ), '<span class="edit-link">', '</span>' );
                    ?>
                </header><!-- .comment-meta -->
                <?php if ( '0' == $comment->comment_approved ) : ?>
                    <p class="comment-awaiting-moderation"><?php esc_html__( 'Your comment is awaiting moderation.', 'dentalcare' ); ?></p>
                <?php endif; ?>
                <div class="comment-content entry-content">
                    <?php comment_text(); ?>
                    <?php  ?>
                </div><!-- .comment-content -->
            </div><!--/comment-wrapper-->
        </article><!-- #comment-## -->
    <?php
        break;
    endswitch; // end comment_type check
}
endif;
if ( ! function_exists( 'dentalcare_get_header' ) ) {
	function dentalcare_get_header() {
		$header = '';
		return get_header( $header );
	}
}
if ( ! function_exists( 'dentalcare_get_body_class' ) ) {
	function dentalcare_get_body_class() {
		global $dentalcare_option;
		if ( isset( $dentalcare_option['header_style'] )) {
			$header_style = $dentalcare_option['header_style'];
		} else {
			$header_style = 'dentalcare_header_1';
		}
		return $header_style;
	}
}

function dentalcare_header_layout($header_style)
{	

	switch($header_style) {	
		case 'dentalcare_header_2':
			get_template_part( 'inc/headers/header_style_2' );
			break;
		case 'dentalcare_header_3':
			get_template_part( 'inc/headers/header_style_3' );
			break;					 
		case 'dentalcare_header_4':			 
			get_template_part( 'inc/headers/header_style_4' );
			break;	
		case 'dentalcare_header_5':
			get_template_part( 'inc/headers/header_style_5' );
			break;	
		default:
			// header style 1
			get_template_part( 'inc/headers/header_style_1' );
			break; 
		} 	
}

if ( ! function_exists( 'dentalcare_get_socials' ) ) {
	function dentalcare_get_socials( $type = 'header_socials' ) {
		global $dentalcare_option;
		$socials_array  = array();
		$socials_enable = $dentalcare_option['enable_social'];
		
		if($socials_enable)
		{
			
			if(isset($dentalcare_option['twitter-value']) && $dentalcare_option['twitter-value'] != '')
			{
				$socials_array['twitter'] = $dentalcare_option['twitter-value'];				
			}
			
			if(isset($dentalcare_option['facebook-value']) && $dentalcare_option['facebook-value'] != '')
			{
				$socials_array['facebook'] = $dentalcare_option['facebook-value'];
			}
												
			if(isset($dentalcare_option['linkedin-value']) && $dentalcare_option['linkedin-value'] != '')
			{
				$socials_array['linkedin'] = $dentalcare_option['linkedin-value'];
			}
								
			if(isset($dentalcare_option['pinterest-value']) && $dentalcare_option['pinterest-value'] != '')
			{
				$socials_array['pinterest'] = $dentalcare_option['pinterest-value'];
			}
								
			if(isset($dentalcare_option['google-value']) && $dentalcare_option['google-value'] != '')
			{
				$socials_array['google-plus'] = $dentalcare_option['google-value'];
			}
			
			if(isset($dentalcare_option['instagram-value']) && $dentalcare_option['instagram-value'] != '')
			{
				$socials_array['instagram'] = $dentalcare_option['instagram-value'];
			}
												
			if(isset($dentalcare_option['yelp-value']) && $dentalcare_option['yelp-value'] != '')
			{
				$socials_array['yelp'] = $dentalcare_option['yelp-value'];
			}
								
			if(isset($dentalcare_option['foursquare-value']) && $dentalcare_option['foursquare-value'] != '')
			{
				$socials_array['foursquare'] = $dentalcare_option['foursquare-value'];
			}
												
			if(isset($dentalcare_option['flickr-value']) && $dentalcare_option['flickr-value'] != '')
			{
				$socials_array['flickr'] = $dentalcare_option['flickr-value'];
			}	
	
			if(isset($dentalcare_option['youtube-value']) && $dentalcare_option['youtube-value'] != '')
			{
				$socials_array['youtube'] = $dentalcare_option['youtube-value'];
			}
								
			if(isset($dentalcare_option['email-value']) && $dentalcare_option['email-value'] != '')
			{
				$socials_array['email'] = $dentalcare_option['email-value'];
			}
								
			if(isset($dentalcare_option['rss-value']) && $dentalcare_option['rss-value'] != '')
			{
				$socials_array['rss'] = $dentalcare_option['rss-value'];
			}	
					
				return $socials_array;
		}
	}
}

function dentalcare_get_page_title(){	
	$post_id        = get_the_ID();
	$is_shop        = false;
	$is_product     = false;
	global $dentalcare_option;
	global $post;
	$dentalcare_post_type = get_post_type($post);
	$page_for_posts = get_option( 'page_for_posts' );
	if ( is_home() || is_category() || is_search() || is_tag() || is_tax() ) {
		$post_id = $page_for_posts;
	}
?>
	<?php
		if(get_post_type() == 'page'){			
			$attachment = get_post_meta(get_the_ID(), 'header-image', true );
			$HidePageTitle = get_post_meta(get_the_ID(), 'hide-page-title', true );
			$PageHeaderTitle = get_post_meta(get_the_ID(), 'page-header-title', true );
			$titleAlignment = get_post_meta(get_the_ID(), 'title-alignment', true );
			$titlePaddingTop = get_post_meta(get_the_ID(), 'title-padding-top', true );
			$titlePaddingBottom = get_post_meta(get_the_ID(), 'title-padding-bottom', true );			
		}elseif( get_post_type() == 'services'){			
			$attachment = get_post_meta(get_the_ID(), 'service-header-image', true );
			$HidePageTitle = get_post_meta(get_the_ID(), 'service-hide-page-title', true );
			$PageHeaderTitle = get_post_meta(get_the_ID(), 'service-header-title', true );
			$titleAlignment = get_post_meta(get_the_ID(), 'service-title-alignment', true );
			$titlePaddingTop = get_post_meta(get_the_ID(), 'service-title-padding-top', true );
			$titlePaddingBottom = get_post_meta(get_the_ID(), 'service-title-padding-bottom', true );			
		}elseif(get_post_type() == 'team'){			
			$attachment = get_post_meta(get_the_ID(), 'team-header-image', true );
			$HidePageTitle = get_post_meta(get_the_ID(), 'team-hide-page-title', true );
			$PageHeaderTitle = get_post_meta(get_the_ID(), 'team-header-title', true );
			$titleAlignment = get_post_meta(get_the_ID(), 'team-title-alignment', true );
			$titlePaddingTop = get_post_meta(get_the_ID(), 'team-title-padding-top', true );
			$titlePaddingBottom = get_post_meta(get_the_ID(), 'team-title-padding-bottom', true );			
		}elseif(get_post_type() == 'post'){
			if(is_single()){				
				$attachment = get_post_meta(get_the_ID(), 'post-header-image', true );
				$HidePageTitle = get_post_meta(get_the_ID(), 'post-hide-page-title', true );
				$PageHeaderTitle = get_post_meta(get_the_ID(), 'post-header-title', true );
				$titleAlignment = get_post_meta(get_the_ID(), 'post-title-alignment', true );
				$titlePaddingTop = get_post_meta(get_the_ID(), 'post-title-padding-top', true );
				$titlePaddingBottom = get_post_meta(get_the_ID(), 'post-title-padding-bottom', true );				
			}else{				
				$attachment = '';
				$HidePageTitle = '';
				$PageHeaderTitle = '';
				$titleAlignment = '';
				$titlePaddingTop = '';				$titlePaddingBottom = '';				
			}
		}else{			
				$attachment = '';
				$HidePageTitle = '';				$PageHeaderTitle = '';
				$titleAlignment = '';
				$titlePaddingTop = '';				$titlePaddingBottom = '';				
		}		
		$image = wp_get_attachment_image_src( $attachment, 'full' );
		if($titlePaddingTop){
			$titlePaddingTop = 'padding-top:'. $titlePaddingTop .';';
		}
		if($titlePaddingBottom){
			$titlePaddingBottom = 'padding-bottom:'. $titlePaddingBottom .';';
		}
		if($titleAlignment == 'left'){
			$titleAlignment = 'text-align:'. $titleAlignment .';';
		}
		if($titleAlignment == 'center'){
			$titleAlignment = 'text-align:'. $titleAlignment .';';
		}
		if($titleAlignment == 'right'){
			$titleAlignment = 'text-align:'. $titleAlignment .';';
		}
		if(!empty($image[0])){
			$innerheader = $image[0];
		}elseif(isset($dentalcare_option['title_background']) )
		{
		   $innerheader = $dentalcare_option['title_background']['background-image'];
		} else{
		   $innerheader = get_template_directory_uri() . '/assets/images/tmp/inner_header.jpg';
		}
?>
	<?php 		if(isset($dentalcare_option['tilebar_layout']) && $dentalcare_option['tilebar_layout'] == '1'){
			$innerheader = '';
		} 	?>
	<?php
		if($dentalcare_option['tilebar_tag']) {
			$title_tag = $dentalcare_option['tilebar_tag'];
		}else {
			$title_tag = 'h1';
		}
	?>
	<?php   if (  class_exists( 'Redux' ) ) {   ?>
		<?php if(isset($dentalcare_option['tilebar_layout']) && $dentalcare_option['tilebar_layout'] != '3'){ ?>
	   <div class="tt-heading">
            <div class="tt-heading-cell" style="background-image:url(<?php echo esc_url($innerheader); ?> ); <?php echo esc_attr($titlePaddingTop); ?> <?php echo esc_attr($titlePaddingBottom); ?>">
                <div class="container">
					<?php if($HidePageTitle != 'yes') { ?>
							<?php if( dentalcare_page_title( false) ): ?>
							<?php if($PageHeaderTitle != '') { ?>
								<<?php echo esc_attr($title_tag); ?> style="<?php echo esc_attr($titleAlignment); ?>" class="tt-heading-title h1"><?php echo esc_attr($PageHeaderTitle); ?></<?php echo esc_attr($title_tag); ?>>
							<?php }elseif($dentalcare_post_type == 'post') { ?>
							<?php if(!empty($dentalcare_option['blog_title'])){ ?>
							<<?php echo esc_attr($title_tag); ?> style="<?php echo esc_attr($titleAlignment); ?>" class="tt-heading-title h1"><?php echo wp_kses_post($dentalcare_option['blog_title']); ?></<?php echo esc_attr($title_tag); ?>>
							<?php } else { ?>
								<<?php echo esc_attr($title_tag); ?> style="<?php echo esc_attr($titleAlignment); ?>" class="tt-heading-title h1"><?php echo dentalcare_page_title( false ); ?></<?php echo esc_attr($title_tag); ?>>
							<?php } ?>
							<?php } else { ?>
								<<?php echo esc_attr($title_tag); ?> style="<?php echo esc_attr($titleAlignment); ?>" class="tt-heading-title h1"><?php echo dentalcare_page_title( false ); ?></<?php echo esc_attr($title_tag); ?>>
							<?php } ?>
							<?php endif; ?>
					<?php } ?>
                </div>
                <div class="tt-mslide-border"></div>                
            </div>
        </div>
	<?php } ?>
	<?php } else { ?>
		<div class="tt-heading">
            <div class="tt-heading-cell" style="background-image:url(<?php echo esc_url($innerheader); ?> );">
                <div class="container">
					<?php if( dentalcare_page_title( false) ): ?>
						<h1 class="tt-heading-title h1"><?php echo dentalcare_page_title( false ); ?></h1>
					<?php endif; ?>
                </div>
                <div class="tt-mslide-border"></div>                
            </div>
        </div>
    <?php } ?>
	<?php
}
if ( ! function_exists( 'dentalcare_page_title' ) ) {
	function dentalcare_page_title( $display = true ) {
		global $wp_locale;
		$title    = '';		
		// If there is a post
		if ( is_single() || ( is_home() && ! is_front_page() ) || ( is_page() && ! is_front_page() ) || is_front_page() ) {
			$title = single_post_title( '', false );
		}
		if ( is_home() ) {
			if ( ! get_option( 'page_for_posts' ) ) {
				$title = $single_posts;
			}
		}		
		// If there's a post type archive
		if ( is_post_type_archive() ) {
			$post_type = get_query_var( 'post_type' );
			if ( is_array( $post_type ) ) {
				$post_type = reset( $post_type );
			}
			$post_type_object = get_post_type_object( $post_type );
			if ( ! $post_type_object->has_archive ) {
				$title = post_type_archive_title( '', false );
			}
		}
		// If there's a category or tag
		if ( is_category() || is_tag() ) {
			$title = single_term_title( '', false );
		}
		// If there's a taxonomy
		if ( is_tax() ) {
			$term = get_queried_object();
			if ( $term ) {
				$tax   = get_taxonomy( $term->taxonomy );
				$title = single_term_title( '', false );
			}
		}
		// If there's an author
		if ( is_author() && ! is_post_type_archive() ) {
			$author = get_queried_object();
			if ( $author ) {
				$title = $author->display_name;
			}
		}
		// Post type archives with has_archive should override terms.
		if ( is_post_type_archive() && $post_type_object->has_archive ) {
			if ( function_exists( 'is_shop' ) && is_shop() ) {
				$title = get_the_title( get_option( 'woocommerce_shop_page_id' ) );
			} else {
				$title = post_type_archive_title( '', false );
			}
		}
		// If it's a search
		if ( is_search() ) {
			$title = esc_html__( 'Search Results', 'dentalcare' );
		}
		// If it's a 404 page
		if ( is_404() ) {
			$title = esc_html__( 'Page not found', 'dentalcare' );
		}
		if ( $display ) {
			echo esc_html( $title );
		} else {
			return esc_html( $title );
		}
	}
}
if ( ! function_exists( 'dentalcare_breadcrumbs' ) ) {
	function dentalcare_breadcrumbs() {
		if ( function_exists( 'bcn_display' ) && ! get_post_meta( get_the_ID(), 'disable_breadcrumbs', true ) ) { ?>
			<div class="row breadcrumb-row">
				<div class="container">
				<ol class="breadcrumb">
					<li><?php bcn_display(); ?></li>
				</ol>
				</div>
			</div>
		<?php }
	}
}
if ( ! function_exists( 'dentalcare_get_structure' ) ) {
	function dentalcare_get_structure( $sidebar_id, $sidebar_type, $sidebar_position, $layout = false ) {
		$output                   = array();
		$output['content_before'] = $output['content_after'] = $output['sidebar_before'] = $output['sidebar_after'] = '';

		if ( $sidebar_type == 'vc' ) {
			if ( $sidebar_id ) {
				$sidebar = get_post( $sidebar_id );
			}
		} else {
			if ( $sidebar_id ) {
				$sidebar = true;
			}
		}
		if ( $sidebar_position == 'right' && isset( $sidebar ) ) {
			$output['content_before'] .= '<div class="row"><div class="col-md-8 col-lg-9 my-float-condition"><div class="right-sidebar pright30">';
			$output['content_after'] .= '</div></div>';
			$output['sidebar_before'] .= '<div class="col-md-4 col-lg-3">';
			$output['sidebar_after'] .= '</div></div>';
		}
		if ( $sidebar_position == 'left' && isset( $sidebar ) ) {
			$output['content_before'] .= '<div class="row"><div class="col-lg-8 col-lg-push-4 col-md-8 col-md-push-4 col-sm-12 col-xs-12"><div class="left-sidebar">';
			$output['content_after'] .= '</div></div>';
			$output['sidebar_before'] .= '<div class="col-lg-4 col-lg-pull-8 col-md-4 col-md-pull-8">';
			// .sidebar-area
			$output['sidebar_after'] .= '</div></div>';
		}
		return $output;
	}
}