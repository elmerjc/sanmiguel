<?php 
$atts = vc_map_get_attributes( 'dentalcare_member_info', $atts );
	extract( $atts );
	$contact_number = get_post_meta( get_the_ID(), '_dentalcare_contact_number', true );
	$email_address = get_post_meta( get_the_ID(), '_dentalcare_email_address', true );
	$social_facebook = get_post_meta(get_the_ID(), '_dentalcare_social_facebook', true );
	$social_twitter = get_post_meta(get_the_ID(), '_dentalcare_social_twitter', true );
	$social_google_plus = get_post_meta(get_the_ID(), '_dentalcare_social_google_plus', true );
	$social_linkedin = get_post_meta(get_the_ID(), '_dentalcare_social_linkedin', true );
	$output .= '<div class="tt-profile-info">
                    <div class="tt-profile-phone">
                        <i class="fa fa-phone" aria-hidden="true"></i>
                        <a href="tel:'.esc_attr($contact_number).'">'.esc_attr($contact_number).'</a>
                    </div>
                    <div class="tt-profile-email">
                        <a href="mailto:'.esc_attr($email_address).'">'. esc_attr($emial_text).'</a>
                    </div>
                    <div class="tt-profile-social">
                        <ul>';
							if(!empty($social_facebook)):
								$output .= '<li><a href="'.esc_url($social_facebook).'"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>';
							endif;
                            if(!empty($social_twitter)):
								$output .= '<li><a href="'.esc_url($social_twitter).'"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>';
							endif;
                            if(!empty($social_google_plus)):
								$output .= '<li><a href="'.esc_url($social_google_plus).'"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>';
							endif;
                            if(!empty($social_linkedin)):
								$output .= '<li><a href="'.esc_url($social_linkedin).'"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>';
							endif;
            $output .= '</ul>
                    </div>
                </div>';
	echo $output;
?>