<?php
	$atts = vc_map_get_attributes( 'dentalcare_clients', $atts );
	extract( $atts );
	$output = null;
			
	$output = '';
	$count  = 0;
	
	$args = array(
					'post_type' => 'clients',
					'post_status' => 'publish',
					'order'          => esc_attr($order),
					'posts_per_page' => $number
				);
    $the_service = new WP_Query( $args );

	
	if ( $the_service->have_posts() ) :
	
		$output .= '<div class="swiper-container" data-breakpoints="1" data-xs-slides="1" data-sm-slides="3" data-md-slides="4" data-slides-per-view="6">
            <div class="swiper-wrapper clearfix '. esc_attr($el_class) .'">';
		while ( $the_service->have_posts() ) : $the_service->the_post(); $count++;
			$output .= '<div class="swiper-slide">
				  '.get_the_post_thumbnail( get_the_ID(), 'full' , array('class' => 'img-responsive')).'
				</div>';
		endwhile;

		$output .= '</div></div>';
		else:
			$output .= esc_html__( 'Sorry, there is no Client under your selected page.', 'dentalcare' );
	endif;	
	wp_reset_postdata();
	
	echo $output;
?>