<?php 
$atts = vc_map_get_attributes( 'dentalcare_team_listing', $atts );
	extract( $atts );
	$output = '';

	$output = null;
if ( $readmore_text == '' )
	{
		$readmore_text = esc_html('more info', 'dentalcare');
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
					'post_type' => 'team',
					'post_status' => 'publish',
					'order'          => $order,
					'orderby'        => $orderby,
					'posts_per_page' => $number
				);
    $post = new WP_Query( $args );

	if ( $post->have_posts() ) :
		$output .= '
		<div class="row '. esc_attr($el_class) .'">';
		if($layout == 'grid'){
		while ( $post->have_posts() ) : $post->the_post(); $count++;
			$member_designation = get_post_meta( get_the_ID(), '_dentalcare_member_designation', true );
			$output .= '<div class="'.esc_attr($col_class).'">
							<div class="tt-doctor">
								<div class="tt-doctor-img custom-hover type-2">
									'.get_the_post_thumbnail(get_the_ID(), 'full', array('class' => 'img-responsive')).'
									<div class="custom-hover-bottom">
										<a class="c-btn" href="'.get_the_permalink().'">'.esc_attr($readmore_text).'</a>
									</div>
								</div>
								<a class="tt-doctor-title" href="'.get_the_permalink().'">'.get_the_title().'</a>
								<div class="tt-doctor-desc">'.esc_attr($member_designation).'</div>
								<div class="simple-text">
									<p>'.get_the_excerpt().'</p>
								</div>
							</div>
							<div class="empty-space marg-lg-b40"></div>
						</div>';
		endwhile;
		} else {
				$output .= '<div class="swiper-container" data-space-between="30" data-breakpoints="1" data-xs-slides="1" data-sm-slides="3" data-md-slides="4" data-slides-per-view="4">
                    <div class="swiper-wrapper clearfix" style="transform: translate3d(-600px, 0px, 0px); transition-duration: 500ms;">';
						while ( $post->have_posts() ) : $post->the_post(); $count++;
						$member_designation = get_post_meta( get_the_ID(), '_dentalcare_member_designation', true );
							$output .= '<div class="swiper-slide" style="width: 270px; margin-right: 30px;">
											<div class="tt-team index2imgborder">
												<a class="tt-team-img  index2img custom-hover " href="'.get_the_permalink().'">
													'.get_the_post_thumbnail(get_the_ID(), 'full').'
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
					</div>';
			}			
			if ( $count % $column == 0 ){ 
			$output .= '<div class="clear"></div>';
			}

		$output .= '</div>';
		else:
			$output .= esc_html( 'Sorry, there is no teams under your selected page.', 'dentalcare' );
	endif;
	
	wp_reset_postdata();
	echo  $output;
?>
