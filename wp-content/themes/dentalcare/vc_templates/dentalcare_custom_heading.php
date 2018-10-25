<?php
$atts = vc_map_get_attributes( 'dentalcare_custom_heading', $atts );	

extract( $atts );

	$heading_style_color = '';
	if ( $heading_color ) {
		$heading_style_color = ' style=color:'. esc_attr($heading_color) .'';
	}
	if ( $heading_color_two ) {
		$heading_style_color_two = ' style=color:'. esc_attr($heading_color_two).'';
	}
	$extract_class = '';
	if ( $el_class ) $extract_class = $el_class;
	$position_class = '';
	if ( $position == 'right' ) $position_class = ' text-right';
	if ( $position == 'center' ) $position_class = ' text-center';

?>
	<div class="custom-heading <?php echo esc_attr($extract_class) . esc_attr($position_class);?> no-margin" >
	<?php if ( $heading ) ?>
		<h4 class="tt-title h4 no-desc" <?php echo esc_attr($heading_style_color); ?>> 
			<?php echo wp_kses_post($heading); ?>
			<span <?php echo esc_attr($heading_style_color_two); ?>> <?php echo wp_kses_post($heading_two); ?> </span>
		</h4>
	</div>
