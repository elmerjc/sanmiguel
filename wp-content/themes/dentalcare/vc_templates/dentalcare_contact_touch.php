<?php 
$atts = vc_map_get_attributes( 'dentalcare_contact_touch', $atts );

	extract( $atts );

	$output .= '<div class="contact '. esc_attr($el_class) .'">
				<h4 class="tt-title h4 no-desc"> '.wp_kses_post($heading_one).'  <span> '.wp_kses_post($heading_two).' </span></h4>
				<div class="empty-space marg-lg-b30"></div>
				<div class="tt-location clearfix">
					<div class="tt-location-icon">
						<i class="fa fa-map-marker" aria-hidden="true"></i>
					</div>
					<div class="tt-location-info">
						<div class="simple-text">
							'.wp_kses_post($get_address).'
						</div>
					</div>
				</div>
				<div class="empty-space marg-xs-b25 marg-lg-b35"></div>
				<div class="tt-location clearfix">
					<div class="tt-location-icon">
						<i class="fa fa-envelope-o" aria-hidden="true"></i>
					</div>
					<div class="tt-location-info">
						<div class="simple-text">
							<p><a href="mailto:'.esc_attr($email_address_one).'"> '.wp_kses_post($email_address_one).' </a></p>
							<p><a href="mailto:'.esc_attr($email_address_two).'">'.wp_kses_post($email_address_two).'</a></p>
						</div>
					</div>
				</div>
				<div class="empty-space marg-xs-b25 marg-lg-b35"></div>
				<div class="tt-location clearfix">
					<div class="tt-location-icon">
						<i class="fa fa-phone" aria-hidden="true"></i>
					</div>
					<div class="tt-location-info">
						<a class="tt-location-tel" href="tel:'.esc_attr($contact_number_one).'">'.wp_kses_post($contact_number_one).'</a>
						<a class="tt-location-tel" href="tel:'.esc_attr($contact_number_two).'">'.wp_kses_post($contact_number_two).'</a>
					</div>
				</div>
				</div>';
	
	echo $output;
	
?>