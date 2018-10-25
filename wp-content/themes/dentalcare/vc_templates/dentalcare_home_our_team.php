<?php
	$atts = vc_map_get_attributes( 'dentalcare_home_our_team', $atts );
	extract( $atts );
	$output = null;
	$output = '';
	$count  = 0;
	$args = array(
					'post_type' => 'team',
					'post_status' => 'publish',
					'order'          => esc_attr($order),					'posts_per_page' => $number
				);
    $the_service = new WP_Query( $args );
	if ( $the_service->have_posts() ) :
		$output .= '<div class="tt-block '. esc_attr($el_class) .'">
					<h4 class="tt-title h4 no-desc">'.wp_kses_post($heading).' <span>'.wp_kses_post($heading_two).'</span></h4>
					<div class="empty-space marg-lg-b30"></div>
					<div class="swiper-container" data-space-between="30" data-breakpoints="1" data-xs-slides="1" data-sm-slides="3" data-md-slides="4" data-slides-per-view="4">
                    <div class="swiper-wrapper clearfix">';
		while ( $the_service->have_posts() ) : $the_service->the_post(); $count++;
			$member_designation = get_post_meta( get_the_ID(), '_dentalcare_member_designation', true );
			$output .= '<div class="swiper-slide"> 
                            <div class="tt-team">
                                <a class="tt-team-img custom-hover round" href="'.get_the_permalink().'">
                                    '.get_the_post_thumbnail(get_the_ID(), 'thumbnail').'
                                </a>
                                <a class="tt-team-name h6" href="'.get_the_permalink().'">'.get_the_title().'</a>
                                <div class="tt-team-position">'.esc_attr($member_designation).'</div>
                                <div class="simple-text">
                                    <p>'.get_the_excerpt().'</p>
                                </div>
                            </div>
                        </div>';
		endwhile;
		$output .= '</div>
                    <div class="swiper-pagination relative-pagination">
					</div></div></div>';
		else:
			$output .= esc_html__( 'Sorry, there is no team under your selected page.', 'dentalcare' );
	endif;	
	wp_reset_postdata();
	echo $output;
?>