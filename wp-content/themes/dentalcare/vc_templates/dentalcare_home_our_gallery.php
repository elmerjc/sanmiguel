<?php
	$atts = vc_map_get_attributes( 'dentalcare_home_our_gallery', $atts );
	extract( $atts );
	$output = null;
			
	$output = '';
	$count  = 0;
	$args = array(
					'post_type' => 'gallery',
					'post_status' => 'publish',
					'order'          => esc_attr($order),
					'posts_per_page' => $number
				);
    $the_gallery = new WP_Query( $args );

	
	if ( $the_gallery->have_posts() ) :
	
		$output .= '<div class="swiper-container '. esc_attr($el_class) .'" data-breakpoints="1" data-xs-slides="1" data-sm-slides="3" data-md-slides="4" data-slides-per-view="4">
					<div class="swiper-wrapper clearfix">';
		while ( $the_gallery->have_posts() ) : $the_gallery->the_post(); $count++;
		
			$output .= '<div class="swiper-slide">
							<a class="tt-gallery lightbox custom-hover" href="'.get_the_post_thumbnail_url( get_the_ID(), 'medium-thumb').'">
								'.get_the_post_thumbnail(get_the_ID(), 'dentalcare-image-480x285-croped', array('class' => 'img-responsive')).'
								<span class="tt-gallery-overlay"></span>
							</a>
						</div>';
				

		endwhile;

		$output .= '</div>
					<div class="swiper-pagination fixed pos-2 swiper-pagination-white active-color"></div>
					</div>';
		
		else:
			$output .= esc_html__( 'Sorry, there is no Gallery under your selected page.', 'dentalcare' );
	endif;	
	
	wp_reset_postdata();
	
	echo $output;
?>