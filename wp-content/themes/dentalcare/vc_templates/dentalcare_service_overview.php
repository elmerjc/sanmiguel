<?php
	$atts = vc_map_get_attributes( 'dentalcare_service_overview', $atts );
	extract ($atts);	
	$output = null;
	if ( $readmore_text == '' ) {
		$readmore_text = esc_html__('Read more', 'dentalcare');
	}
	$count  = 0;
	$output = '';
	$args = array(
				'post_type' => 'services',
				'post_status' => 'publish',
				'posts_per_page' => 1
			);
						
    $the_service = new WP_Query( $args );
	
	if ( $the_service->have_posts() ) :
	if ( $background_color ) {
		$background = ' style=background:'. esc_attr($background_color) .'';
	}else{
		$background = 'style=background-image:url('. wp_get_attachment_url($background_image) .');';
	}
	

	$output .= '';
		while ( $the_service->have_posts() ) : $the_service->the_post(); $count++;		$pageLink = get_page_by_title($service_name, OBJECT, 'services');
			$arrTitle = explode( " ", $service_name );
			
			$boldWord = $arrTitle[0];
			
			$otherWord = '';
			for($i=1; $i<count($arrTitle); $i++){
				$otherWord .= $arrTitle[$i].' ';
			}
			$output .= '<div class="dental_impact" '.esc_attr($background).'>
							<h4>'.esc_attr($boldWord).' <span>'.esc_attr($otherWord).'</span></h4>
							<div class="simple-text">
								<p>'.get_the_excerpt($pageLink->ID).'</p>
							</div>
							<div class="empty-space marg-lg-b30"></div>
							<a class="c-btn" href="'.get_the_permalink($pageLink->ID).'">'.esc_attr($readmore_text).'</a>
						</div>';

		endwhile;

		$output .= '';

		else:
			$output .= esc_html( 'Sorry, there is no services under your selected page.', 'dentalcare' );
	endif;
	
	wp_reset_postdata();
	echo $output;
?>