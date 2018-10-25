<?php
	$atts = vc_map_get_attributes( 'dentalcare_testimonial', $atts );
	extract( $atts );
	$output = null;
			
	$output = '';
	$count  = 0;
	$args = array(
					'post_type' => 'testimonials',
					'post_status' => 'publish',
					'order'          => esc_attr($order)
				);
    $the_service = new WP_Query( $args );

	if ( $heading_color ) {
	$heading_style_color = ' style=color:'. esc_attr($heading_color) .'';
	}
	if ( $heading_color_two ) {
		$heading_style_color_two = ' style=color:'. esc_attr($heading_color_two).'';
	}
	if ( $the_service->have_posts() ) :
		$output .= '<div class="tt-block '. esc_attr($el_class) .'">
                    <h4 class="tt-title h4 text-center no-desc" '.esc_attr($heading_style_color).'>'.wp_kses_post($heading).' <span '.esc_attr($heading_style_color_two).'> '.wp_kses_post($heading_two).' </span></h4>
                    <div class="empty-space marg-lg-b40"></div>
					<div class="swiper-container" data-space-between="30" data-breakpoints="1" data-xs-slides="1" data-sm-slides="2" data-md-slides="2" data-slides-per-view="2">
                    <div class="swiper-wrapper clearfix">';
		while ( $the_service->have_posts() ) : $the_service->the_post(); $count++;
			$testiLocation = get_post_meta(get_the_ID(), '_dentalcare_testimonial_location', true);
			$member_designation = get_post_meta( get_the_ID(), '_dentalcare_member_designation', true );
			$output .= '<div class="swiper-slide">
                                <div class="tt-testimonial">
                                    <div class="tt-testimonial-info">
                                        <div class="simple-text">
                                            <p>'.get_the_excerpt().'</p>
                                        </div>
                                    </div>
                                    <div class="tt-testimonial-bottom">
                                        <div class="tt-testimonial-img custom-hover round">
											'.get_the_post_thumbnail(get_the_ID(), 'full' ,array( 'class' => 'img-responsive' )).'
                                        </div>
                                        <div class="tt-testimonial-user">
                                            <div class="tt-testimonial-name">'.get_the_title().'</div>
                                            <div class="tt-testimonial-position">'.esc_attr($testiLocation).'</div>
                                        </div>
                                    </div>
                                </div>
                            </div>';
				

		endwhile;

		$output .= '</div>
                    <div class="swiper-pagination relative-pagination">
					</div></div></div>';
		
		else:
			$output .= esc_html__( 'Sorry, there is no Testimonial under your selected page.', 'dentalcare' );
	endif;	
	
	wp_reset_postdata();
	
	echo $output;
?>