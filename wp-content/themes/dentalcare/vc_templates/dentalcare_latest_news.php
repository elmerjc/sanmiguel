<?php
	$atts = vc_map_get_attributes( 'dentalcare_latest_news', $atts );
	extract( $atts );
	if ( $readmore_text == '' ) {
		$readmore_text = esc_html('Read More', 'dentalcare');
	}		if ( $readallnews_text == '' ) {		$readallnews_text = esc_html('Read All News', 'dentalcare');	}	
	$count  = 0;
	$args = array(
		'posts_per_page' => 5,
		'post_type'      => 'post',
		'post_status'    => 'publish'
	);
	$recent_posts = new WP_Query( $args );
	$output = null;
			if ( $recent_posts->have_posts() ) :
				$output .= '<div class="tt-block '. esc_attr($el_class) .' ">
							<h4 class="tt-title h4 no-desc"> '.wp_kses_post($heading).' <span> '.wp_kses_post($heading_two).' </span></h4>
							<div class="empty-space marg-lg-b40"></div><div class="row">';			$postTime = human_time_diff( get_the_time('U'), current_time('timestamp') );
			while ( $recent_posts->have_posts() ) : $recent_posts->the_post(); $count++;
			if($count <= 2){
				$output .= '<div class="col-sm-6 col-md-4">
                        <div class="tt-news">
                            <a class="tt-news-img custom-hover" href="'.get_the_permalink().'">
								'.get_the_post_thumbnail(get_the_ID(), 'dentalcare_image_370x215_croped', array('class' => 'img-responsive')).'
                            </a>
                            <a class="tt-news-title" href="'.get_the_permalink().'">'.get_the_title().'</a>
                            <div class="simple-text">
                                <p>'.get_the_excerpt().'</p>
                            </div>
                            <a class="tt-news-link" href="'.get_the_permalink().'">'.esc_attr($readmore_text).'</a>
                        </div>
                        <div class="empty-space marg-xs-b30"></div>
                    </div>';
			}else {
					if($count == 3){
						$output .= '<div class="col-sm-12 col-md-4"><div class="empty-space marg-sm-b30"></div><ul class="tt-archive">'; 
					}
					if($count <= 4){
						$output .= '<li>
										<a class="tt-archive-title" href="'.get_the_permalink().'">'.get_the_title().'</a>
										<div class="tt-archive-bottom">
											<span>'.esc_attr($postTime).' '.esc_html__('ago','dentalcare').'</span>
											<span>'.implode( ' , ', wp_get_post_categories( get_the_ID(), array( 'fields' => 'names' ) ) ).'</span>
										</div>
									</li>';
					}else{
						$output .= '<li>
										<a class="tt-archive-title" href="'.get_the_permalink().'">'.get_the_title().'</a>
										<div class="tt-archive-bottom">
											<span>'.esc_attr($postTime).' '.esc_html__('ago','dentalcare').'</span>
											<span>'.implode( ' , ', wp_get_post_categories( get_the_ID(), array( 'fields' => 'names' ) ) ).'</span>
										</div>
									</li><li>
									<a class="tt-archive-all" href="'.get_permalink( get_page_by_title( $pages )).'">'.esc_attr($readallnews_text).'</a>
								</li></ul></div>';
					}
				}	
		endwhile;	
				$output .= '</div></div>';
				else:
					$output .= esc_html( 'News listing is not available under the selected page.', 'dentalcare' );
		endif;
	wp_reset_postdata();
	echo $output;
?>