<?php 
global $dentalcare_option;
$atts = vc_map_get_attributes( 'dentalcare_service_grid', $atts );
	extract( $atts );
	$output = '';
	if ( $allservices_text == '' ) {
		$allservices_text = esc_html__('ALL SERVICES', 'dentalcare');
	}
	$output = null;	
if ( $readmore_text == '' ){
		$readmore_text = esc_html('Read More', 'dentalcare');
	}
	$col_class = $thumbnail = '';
	if ( $column == 2 ) {
		$col_class = "grid-sm-6";
	} elseif ( $column == 3 ){
		$col_class = "grid-sm-6 grid-md-4";
	} elseif ( $column == 4 ) {
		$col_class = "grid-sm-6 grid-md-3";
	} else {
		$col_class = "grid-sm-6 grid-md-4";
	}
	$heading_style_color = '';
	if ( $heading_color ) {
		$heading_style_color = ' style=color:'. esc_attr($heading_color) .'';
	}
	
	$heading_style_color_two = '';
	if ( $heading_color_two ) {
		$heading_style_color_two = ' style=color:'. esc_attr($heading_color_two).'';
	}	
	
	$count  = 0;
	$args = array(
			'post_type' => 'services',
			'post_status' => 'publish',
			'order'          => $order,
			'posts_per_page' => $number
		);
    $post = new WP_Query( $args );
	if ( $post->have_posts() ) :
		$output .= '<div class="row  row-2-columns '. esc_attr($el_class) .'">';
		$output .= '<div class="col-md-3 col-sm-6">
						<div class="our_serviceindex2">
                            <h4 class="tt-title h4 no-desc scolor" '.esc_attr($heading_style_color).'>'.esc_attr($heading).'<span '.esc_attr($heading_style_color_two).'>'.esc_attr($heading_two).'</span></h4>
							<div class="text-decor"></div>
                            <div class="empty-space marg-lg-b25"></div>
                            <div class="simple-text">
                                <p>'.esc_attr($services_content).'</p>
                            </div>
							<div class="readmore">
							<h5><a href="'.get_permalink( get_page_by_title( $pages )).'">'.esc_attr($allservices_text).'</a><h5>
							</div>
                        </div>
					</div>';
		while ( $post->have_posts() ) : $post->the_post(); $count++;
			$excerpt= get_the_excerpt();
			$output .= '<div class="'.esc_attr($col_class).'">
                            <div class="tt-featured">
                                <a class="tt-featured-image custom-hover tt-margin" href="'.get_the_permalink().'">
									'.get_the_post_thumbnail(get_the_ID(), 'dentalcare_image_270x191_croped', array('class' => 'img-responsive')).'
                                </a>
                                <div class="simple-text">
                                    <a href="'.get_the_permalink().'" class="tt-featured-title h6 scolor font-20">'.get_the_title().'</a>
                                    <p>'.substr(esc_attr($excerpt), 0, 100).'</p>
                                </div>
                              <div class="readmore">
							<a href="'.get_the_permalink().'">'.esc_attr($readmore_text).'</a>
							</div>
                            </div>
                        </div>';
		endwhile;
		$output .= '</div>'; 	
		else:
			$output .= esc_html( 'Sorry, there is no services under your selected page.', 'dentalcare' );
	endif;
	wp_reset_postdata();
	echo  $output;
?>
