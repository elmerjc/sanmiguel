<?php

	$atts = vc_map_get_attributes( 'dentalcare_services', $atts );

	extract ($atts);	

	$output = null;

	if ( $all_service_text == '' ) {

		$all_service_text = esc_html('VIEW ALL SERVICES', 'dentalcare');

	}

	if ( $readmore_text == '' ) {

		$readmore_text = esc_html('Read more...', 'dentalcare');

	}

	$count  = 0;

	$output = '';

	$args = array(

					'post_type' => 'services',

					'post_status' => 'publish',

					'order'          => $order,

					'orderby'        => $orderby,

					'posts_per_page' => $number

				);

						

    $the_service = new WP_Query( $args );

	

	if ( $the_service->have_posts() ) :

				

			$output .= '<div class="tt-block '. esc_attr($el_class).'">';

			$first_heading_color = ' style=color:'. esc_attr($first_heading_color) .'';

			$second_heading_color = ' style=color:'. esc_attr($second_heading_color) .'';

			$output .= '<div class="row vertical-middle">

			<div class="col-sm-8">

				<h4 class="tt-title h4 no-desc" '.esc_attr($first_heading_color).'> '.wp_kses_post($first_service_heading).' <span '.esc_attr($second_heading_color).'> '. wp_kses_post($second_service_heading).' </span> </h4>

			</div>

			<div class="col-sm-4">

				<a class="tt-title-btn c-btn-2" href="'.get_permalink( get_page_by_title( $pages )).'">'.esc_attr($all_service_text).'</a>

			</div>

			</div>

			<div class="empty-space marg-lg-b25"></div>

				<div class="simple-text">

					<p>'.esc_attr($service_description).'</p>

				</div>

			<div class="empty-space marg-lg-b40"></div>';

			if($layout == 'style_one'){

			$output .= '<div class="row">';

			while ( $the_service->have_posts() ) : $the_service->the_post(); $count++;

			$service_icon =  get_post_meta(get_the_ID(), '_dentalcare_services_icon', true );

			$excerpt= get_the_excerpt();

					$output .= '<div class="col-md-4 col-sm-6">

                            <div class="tt-service clearfix">

								<img class="tt-service-img" src="'.wp_get_attachment_url($service_icon).'" height="44" width="40" alt="">

                                <div class="tt-service-info">

                                    <a class="tt-service-link h6" href="'.get_the_permalink().'">'.get_the_title().'</a>

                                    <div class="simple-text">

                                        <p>'.substr(esc_attr($excerpt), 0, 99).'</p>

                                    </div>

                                </div>

                            </div>

                            <div class="empty-space marg-lg-b30"></div>

                        </div>';



			endwhile;

			$output .= '</div>';

			}else{

				$output .= '<div class="row  row-2-columns">';

				while ( $the_service->have_posts() ) : $the_service->the_post(); $count++;

				$excerpt= get_the_excerpt();

				$output .= '

					<div class="col-md-3 col-sm-6">

						<div class="tt-featured">

							<a class="tt-featured-image custom-hover tt-margin" href="'.get_the_permalink().'">

								'.get_the_post_thumbnail(get_the_ID(), 'dentalcare_image_270x191_croped', array('class' => 'img-responsive')).'

							</a>

							<div class="simple-text">

								<a href="'.get_the_permalink().'" class="h6 tt-featured-title  white font-20">'.get_the_title().'</a>

								<p>'.substr(esc_attr($excerpt), 0, 68).'</p>

							</div>

							<div class="readmore">

								<a href="'.get_the_permalink().'">'.esc_attr($readmore_text).'</a>

							</div>

						</div>

					</div>';

				endwhile;

				$output .= '</div>';

			}

		$output .= '</div>';



		else:

			$output .= esc_html( 'Sorry, there is no services under your selected page.', 'dentalcare' );

	endif;

	

	wp_reset_postdata();

	echo $output;

?>