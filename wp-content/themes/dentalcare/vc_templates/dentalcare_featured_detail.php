<?php 
$atts = vc_map_get_attributes( 'dentalcare_featured_detail', $atts );
	extract( $atts );
	$output = '';
		 
	$main_image = wp_get_attachment_url( $main_image );
	
	$mainImage = 'style=background-image:url('. esc_attr($main_image) .');';
		 
	$responsive_image = wp_get_attachment_url( $responsive_image );
		 
	$first_sub_image = wp_get_attachment_url( $first_sub_image );
	 
	$second_sub_image = wp_get_attachment_url( $second_sub_image );
	 
	$third_sub_image = wp_get_attachment_url( $third_sub_image );
	
	$output .='<div class="features '. esc_attr($el_class).'"> 
		 <div class="tt-image-row">
            <div class="container">
                <div class="tt-image-row-bg" '.esc_attr($mainImage).'>
                    <img src="'.esc_attr($responsive_image).'" height="478" width="745" alt="">
                </div>
                <div class="empty-space marg-sm-b30"></div>
                <div class="row">
                    <div class="col-md-8 col-md-offset-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="tt-feature clearfix">
                                    <img class="tt-feature-img" src="'.esc_attr($first_sub_image).'"  alt="">
                                    <h5 class="tt-feature-link">'.esc_attr($first_heading).'</h5>
									<div class="simple-text">
                                       <p>'.esc_attr($first_sub_heading).'</p>
                                    </div>
                                </div>
                                <div class="empty-space marg-xs-b20"></div>
                            </div>
							 <div class="empty-space marg-xs-b20 marg-lg-b35"></div>
                            <div class="col-md-12">
                                <div class="tt-feature clearfix">
                                    <img class="tt-feature-img" src="'.esc_attr($second_sub_image).'"  alt="">
                                    <h5 class="tt-feature-link">'.esc_attr($second_heading).'</h5>
									<div class="simple-text">
                                       <p>'.esc_attr($second_sub_heading).'</p>
                                    </div>
                                </div>                                
                            </div>
							 <div class="empty-space marg-xs-b20 marg-lg-b35"></div>
							<div class="col-md-12">
                                <div class="tt-feature clearfix">
                                    <img class="tt-feature-img" src="'.esc_attr($third_sub_image).'"  alt="">
                                  <h5 class="tt-feature-link">'.esc_attr($third_heading).'</h5>
								  <div class="simple-text">
                                       <p>'.esc_attr($third_sub_heading).'</p>
                                    </div>
                                </div>
                                <div class="empty-space marg-xs-b20"></div>
                            </div>							
                        </div>                   
                    </div>
                </div>
            </div>
        </div>		
     </div>';
	
	echo $output;
	
?>