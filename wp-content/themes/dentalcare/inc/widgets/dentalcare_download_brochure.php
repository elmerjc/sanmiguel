<?php class dentalcare_download_brochure extends WP_Widget {
	public function __construct() {

		// Widget actual processes
        parent::__construct(
	 		'dentalcare_download_brochure',                                                          // Base ID
			esc_html('Dentalcare Brochure','dentalcare'),                                         // Name
			array( 'description' => esc_html( 'Download the brochure', 'dentalcare' ), )  // Args
		);
	}

 	public function form( $dentalcare_instance )
	{
		/* Set up default widget settings. */
        $defaults = array(
            'title'      => '',
			'image'       =>''
        );
        $dentalcare_instance = wp_parse_args( (array) $dentalcare_instance, $defaults );
		
		if ( isset( $dentalcare_instance[ 'inner_title' ] ) ) {
            $inner_title = $dentalcare_instance[ 'inner_title' ];
        } else {
            $inner_title = '';
        }
		if ( isset( $dentalcare_instance[ 'download_title' ] ) ) {
            $download_title = $dentalcare_instance[ 'download_title' ];
        } else {
            $download_title = '';
        }
		 if ( isset( $dentalcare_instance[ 'image' ] ) ) {
            $image = $dentalcare_instance[ 'image' ];
        } else {
            $image = '';
        }

		$pages = get_pages();	
        ?>
		<p>
    		<label for="<?php echo $this->get_field_id( 'download_title' ); ?>"><?php echo esc_html('Brochure Title' ,'dentalcare') ?></label> 
    		<input class="widefat" id="<?php echo $this->get_field_id( 'download_title' ); ?>" name="<?php echo $this->get_field_name( 'download_title' ); ?>" type="text" value="<?php echo esc_attr( $download_title ); ?>" />
		</p>
    	<p>
    		<label for="<?php echo $this->get_field_id( 'inner_title' ); ?>"><?php echo esc_html('Inner Title' ,'dentalcare') ?></label> 
    		<input class="widefat" id="<?php echo $this->get_field_id( 'inner_title' ); ?>" name="<?php echo $this->get_field_name( 'inner_title' ); ?>" type="text" value="<?php echo esc_attr( $inner_title ); ?>" />
		</p>
		<p>
    		<label for="<?php echo $this->get_field_id( 'image' ); ?>"><?php echo esc_html('Brochure File' ,'dentalcare') ?></label> 
    		<input class="widefat" id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" type="file" value="<?php echo esc_attr( $image ); ?>" />	
		</p>

		<?php 
	}
	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
        $dentalcare_instance = array();
        $dentalcare_instance[ 'inner_title' ]= $new_instance['inner_title'];
		$dentalcare_instance[ 'download_title' ]= $new_instance['download_title'];
		return $dentalcare_instance;
		
	}

	public function widget( $args, $dentalcare_instance )
	{
		// Outputs the content of the widget
        extract( $args );
		global $dentalcare_option;
        $title      = apply_filters( 'widget_title', $dentalcare_instance['inner_title'] );
		$download_title      = apply_filters( 'widget_title', $dentalcare_instance['download_title'] );
		
		echo $before_widget;
	?>
	<h4 class="tt-widget-title h5"><?php echo wp_kses_post($dentalcare_instance['download_title']);?></h4>
	<div class="tt-brochure grey">
		<div class="tt-brochure-icon">
			<i class="fa fa-file-pdf-o" aria-hidden="true"></i>
		</div>
		<a class="tt-brochure-title h6" href="#"><small><?php echo esc_attr($dentalcare_instance['inner_title']);?></small></a>
		<div class="tt-brochure-desc"><?php echo esc_html__('size: 0 kb','dentalcare'); ?></div>
		<a class="tt-brochure-link" href="#">
			<i class="fa fa-cloud-download" aria-hidden="true"></i>
		</a>
	</div> 
<?php
        wp_reset_postdata();
    	echo $after_widget;
	}
}
register_widget( 'dentalcare_download_brochure' );