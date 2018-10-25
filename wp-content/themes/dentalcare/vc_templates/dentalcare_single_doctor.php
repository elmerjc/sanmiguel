<?php 
$atts = vc_map_get_attributes( 'dentalcare_single_doctor', $atts );

	extract( $atts );
	$output = '';
	
	if($doctor_image == ''){
		$doctor_image = get_template_directory_uri() . '/assets/images/bg/bg_1.jpg';
	}else{
		$doctor_image = wp_get_attachment_url( $doctor_image );
	}
	
	if($doctor_signature_image == ''){
		$doctor_signature_image = get_template_directory_uri() . '/assets/images/feature/feature_4.png';
	}else{
		$doctor_signature_image = wp_get_attachment_url( $doctor_signature_image );
	}
	
	$output .= '<div class="meet_section '. esc_attr($el_class).'">
					<div class="container">
						<div class="tt-block meet">
						   <div class="col-md-4">
							   <div class="meet_dr">
								  <img src="'.esc_url($doctor_image).'" alt="" class="img-responsive">
							   </div>
						   </div>
						   <div class="col-md-8">
							 <div class="about_dr">
						   <h4 class="tt-title h4 no-desc scolor">'.wp_kses_post($doctor_heading).' <span> '.wp_kses_post($doctor_heading_two).'</span></h4>
						   <h5>'.wp_kses_post($doctor_sub_heading).'</h5>
						   <div class="simple-text">
							   <p>'.esc_attr($doctor_description).'</p>
							</div>
							 <div class="dr_sign">
							 <img src="'.esc_url($doctor_signature_image).'" alt="">
							  </div>
						   </div>
					  </div>
				 
					  </div>
					</div>
				</div>';	
	echo $output;
	
?>