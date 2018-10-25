<?php
	$atts = vc_map_get_attributes( 'dentalcare_brochure_button', $atts );
	extract( $atts );
	
	$link =  wp_get_attachment_url($btnlink); 

	if(!$link)$link = '#';
	
	$bytes = filesize(get_attached_file( $btnlink ));
		
		$s = 0;
		
		if($bytes > 0){
		$s = array('b', 'Kb', 'Mb', 'Gb');
		$e = floor(log($bytes)/log(1024));
		
		} else{
			
			$e= 1;
		}
	
	if ( $btntitle ) :?>
			<div class="row">
				<div class="col-lg-7">
					<div class="tt-brochure big grey">
						<div class="tt-brochure-icon">
							<i class="fa fa-file-pdf-o" aria-hidden="true"></i>
						</div>
						<a class="tt-brochure-title h6" href="<?php echo esc_attr($link);?>"><small><?php echo esc_attr($btntitle);?></small></a>
						<div class="tt-brochure-desc"><?php echo esc_html__( 'Document size:', 'dentalcare' );?> <?php echo  sprintf('%.2f '.$s[$e], ($bytes/pow(1024, floor($e)))); ?></div>
						<a class="tt-brochure-link" href="<?php echo esc_attr($link);?>">
							<i class="fa fa-cloud-download" aria-hidden="true"></i>
						</a>
					</div>
				</div>
            </div>

		<?php
		else:
		?>
			<div><?php echo esc_html__( 'Sorry, there is no button.', 'dentalcare' );?></div>
	<?php 
	endif;
	
	wp_reset_postdata();
?>