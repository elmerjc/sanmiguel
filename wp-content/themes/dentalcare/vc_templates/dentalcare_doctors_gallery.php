<?php 
global $dentalcare_option;
$atts = vc_map_get_attributes( 'dentalcare_doctors_gallery', $atts );
	extract( $atts );
	$output = '';
	if ( $appointment_text == '' ) {
		$appointment_text = esc_html__('Appointment', 'dentalcare');
	}
	$lightBoxclass = '';
	$lightboxtitle = '';
	$output = null;	
if ( $readmore_text == '' ){
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
			'post_type' => 'gallery',
			'post_status' => 'publish',
			'order'          => $order,
			'orderby'        => $orderby,
			'posts_per_page' => $number
		);
    $post = new WP_Query( $args );
	if ( $post->have_posts() ) :
		$output .= '<div class="row row4 '. esc_attr($el_class) .'">';
		while ( $post->have_posts() ) : $post->the_post(); $count++;
		if(isset($dentalcare_option['lightbox_mobile']) && $dentalcare_option['lightbox_mobile'] != '1'){
				$lightBoxclass = 'mobile-off';
			}
		if(isset($dentalcare_option['light_title']) && $dentalcare_option['light_title'] == '1'){
			$lightboxtitle = get_the_title();
		}
			$output .= '<div class="'.esc_attr($col_class).'">
							<a class="lightbox custom-hover type-3" href="'.get_the_post_thumbnail_url( get_the_ID(), 'full').'">
								'.get_the_post_thumbnail(get_the_ID(), 'full', array('alt' => ''.esc_attr($lightboxtitle).'', 'class' => 'img-responsive')).'
								<i class="fa fa-search '. esc_attr($lightBoxclass) .'" aria-hidden="true"></i>
							</a>
							<div class="empty-space marg-lg-b4"></div>
						</div>';
		endwhile;
		$output .= '</div>';
		$output .= '<div class="empty-space marg-lg-b80 marg-md-b40"></div>
                <div class="text-center">
                    <a class="c-btn " href="'.get_permalink( get_page_by_title( $pages )).'">'.esc_attr($appointment_text).'</a>
                </div>'; 
		else:
			$output .= esc_html( 'Sorry, there is no Gallery under your selected page.', 'dentalcare' );
	endif;
	wp_reset_postdata();
	echo  $output;
?>
