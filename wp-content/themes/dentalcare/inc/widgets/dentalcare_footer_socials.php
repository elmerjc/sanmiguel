<?php class dentalcare_footer_socials extends WP_Widget {
	public function __construct() {
		// Widget actual processes
        parent::__construct(
	 		'dentalcare_footer_socials',                                                          // Base ID
			esc_html__('Dentalcare Footer Socials','dentalcare'),                                         // Name
			array( 'description' => esc_html__( 'Footer socials', 'dentalcare' ), )  // Args
		);
	}
 	public function form( $instance )
	{
		/* Set up default widget settings. */
        $instance         = wp_parse_args( (array) $instance );
	}
	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
        $instance = array();
        $instance[ 'socials_title' ]= strip_tags( $new_instance['socials_title'] );
		return $instance;
	}

	public function widget( $args, $instance )
	{
		// Outputs the content of the widget
        extract( $args );
		global $dentalcare_option;
        $title      = apply_filters( 'widget_title', $instance['socials_title'] );

		
		echo $before_widget;
        
        $count     = 0;
	?>
	
<div class="empty-space marg-lg-b30"></div><?php if(isset($dentalcare_option['footer_social_enable']) && $dentalcare_option['footer_social_enable'] == '1'): ?>
	<?php $socials = dentalcare_get_socials( 'footer_socials' ); ?>	
		<?php if ( $socials): ?>
			<ul class="tt-socail">
				<?php foreach( $socials as $key => $val ): ?>
					<li>
						<a href="<?php echo esc_url( $val ); ?>" target="_blank" class="social-<?php echo esc_attr( $key ); ?>">
							<i class="fa fa-<?php echo esc_attr( $key ); ?>"></i>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
	<?php endif; ?>	<?php endif; ?>	
<?php
		wp_reset_postdata();
		echo $after_widget;
	}
}
register_widget( 'dentalcare_footer_socials' );