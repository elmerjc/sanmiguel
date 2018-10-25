<?php 
$atts = vc_map_get_attributes( 'dentalcare_services_listing', $atts );
	extract( $atts );

	$output = null;
	$output = '';
if ( $readmore_text == '' )
	{
		$readmore_text = esc_html('Read more', 'dentalcare');
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

	$count  = 0;
	$args = array(
					'post_type' => 'services',
					'post_status' => 'publish',
					'order'          => $order,
					'orderby'        => $orderby,
					'posts_per_page' => $number
				);
    $post = new WP_Query( $args );

	if ( $post->have_posts() ) :
	if($layout == 'grid'){
		$output .= '<div class="row row-3-columns row-2-columns '. esc_attr($el_class) .'">';	
		while ( $post->have_posts() ) : $post->the_post(); $count++;
			$output .= '<div class="'.esc_attr($col_class).'">
                            <div class="tt-featured">
                                <a class="tt-featured-image custom-hover" href="'.get_the_permalink().'">
									'.get_the_post_thumbnail(get_the_ID(), 'full', array('class' => 'img-responsive')).'
                                </a>
                                <div class="simple-text">
                                    <a href="'.get_the_permalink().'" class="h6 tt-featured-title">'.get_the_title().'</a>
                                    <p>'.get_the_excerpt().'</p>
                                </div>
                                <a class="c-btn" href="'.get_the_permalink().'">'.esc_attr($readmore_text).'</a>
                            </div>
                        </div>';
		endwhile;
		$output .= '</div>';
	}else{
		$output .= '<div class="owl-carousel owl-theme '. esc_attr($el_class) .'">';	
		while ( $post->have_posts() ) : $post->the_post(); $count++;
		$excerpt= get_the_excerpt();
			$output .= '<div class="item">
								<div class="tt-featured">
									<a class="tt-featured-image custom-hover " href="'.get_the_permalink().'">
										'.get_the_post_thumbnail(get_the_ID(), 'dentalcare_image_270x191_croped', array('class' => 'img-responsive')).'
									</a>
									<div class="complete_text">
										<div class="simple-text">
											<a href="'.get_the_permalink().'" class="tt-featured-title h6 scolor font-20">'.get_the_title().'</a>
											<p>'.substr(esc_attr($excerpt), 0, 75).'</p>
										</div>
										<div class="readmore">
											<a href="'.get_the_permalink().'">'.esc_attr($readmore_text).'</a>
										</div>
									</div>
								</div>
							</div>';
		endwhile;
		$output .= '</div>';	
	}
		else:
			$output .= esc_html( 'Sorry, there is no service under your selected page.', 'dentalcare' );
	endif;
	
	wp_reset_postdata();
	echo  $output;
?>
