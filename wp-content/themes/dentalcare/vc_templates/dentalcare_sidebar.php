<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class    = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );
$post_sidebar = get_post( $sidebar );
if ( empty( $post_sidebar ) || $sidebar == '0' ) {
	return;
}
?>

<div class="dentalcare_sidebar<?php echo esc_attr( $css_class ); ?>">
	<?php echo apply_filters( 'the_content', $post_sidebar->post_content ); ?>
</div>