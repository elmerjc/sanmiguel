<?php
class dentalcare_opening_hours extends WP_Widget {

	public function __construct() {

		// Widget actual processes
        parent::__construct(
	 		'dentalcare_opening_hours',                                                          // Base ID
			esc_html__('Dentalcare Opening Time','dentalcare'),                                          // Name
			array( 'description' => esc_html__( 'Eye catching posts widget', 'dentalcare' ), )  // Args
		);
	}
 	public function form( $dentalcare_instance )
	{

        $defaults = array(
            'title'      => '',
        );
        $dentalcare_instance         = wp_parse_args( (array) $dentalcare_instance, $defaults );


		if ( isset( $dentalcare_instance[ 'opening_hour_title' ] ) ) {
            $dentalcare_opening_hour_title = $dentalcare_instance[ 'opening_hour_title' ];
        } else {
            $dentalcare_opening_hour_title = '';
        }
		
		if ( isset( $dentalcare_instance[ 'opening_hour_day' ] ) ) {
            $dentalcare_opening_hour_day = $dentalcare_instance[ 'opening_hour_day' ];
        } else {
            $dentalcare_opening_hour_day = '';
        }
		if ( isset( $dentalcare_instance[ 'opening_hour_time' ] ) ) {
            $dentalcare_opening_hour_time = $dentalcare_instance[ 'opening_hour_time' ];
        } else {
            $dentalcare_opening_hour_time = '';
        }
		
		if ( isset( $dentalcare_instance[ 'opening_single_day' ] ) ) {
            $dentalcare_opening_single_day = $dentalcare_instance[ 'opening_single_day' ];
        } else {
            $dentalcare_opening_single_day = '';
        }
		if ( isset( $dentalcare_instance[ 'opening_single_time' ] ) ) {
            $dentalcare_opening_single_time = $dentalcare_instance[ 'opening_single_time' ];
        } else {
            $dentalcare_opening_single_time = '';
        }
		
		if ( isset( $dentalcare_instance[ 'opening_another_day' ] ) ) {
            $dentalcare_opening_another_day = $dentalcare_instance[ 'opening_another_day' ];
        } else {
            $dentalcare_opening_another_day = '';
        }
		if ( isset( $dentalcare_instance[ 'opening_another_time' ] ) ) {
            $dentalcare_opening_another_time = $dentalcare_instance[ 'opening_another_time' ];
        } else {
            $dentalcare_opening_another_time = '';
        }
				
        ?>
    	<p>
    		<label for="<?php echo esc_attr($this->get_field_id( 'opening_hour_title' )); ?>"><?php echo esc_html__('Services Title' ,'dentalcare') ?></label> 
    		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'opening_hour_title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'opening_hour_title' )); ?>" type="text" value="<?php echo esc_attr( $dentalcare_opening_hour_title ); ?>" />
		</p>
		<p>
    		<label for="<?php echo esc_attr($this->get_field_id( 'opening_hour_day' )); ?>"><?php echo esc_html__('Opening Day' ,'dentalcare') ?></label> 
    		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'opening_hour_day' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'opening_hour_day' )); ?>" type="text" value="<?php echo esc_attr( $dentalcare_opening_hour_day ); ?>" />
		</p>
		<p>
    		<label for="<?php echo esc_attr($this->get_field_id( 'opening_hour_time' )); ?>"><?php echo esc_html__('Opening Time' ,'dentalcare') ?></label> 
    		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'opening_hour_time' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'opening_hour_time' )); ?>" type="text" value="<?php echo esc_attr( $dentalcare_opening_hour_time ); ?>" />
		</p>
		<p>
    		<label for="<?php echo esc_attr($this->get_field_id( 'opening_single_day' )); ?>"><?php echo esc_html__('Single Opening Day' ,'dentalcare') ?></label> 
    		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'opening_single_day' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'opening_single_day' )); ?>" type="text" value="<?php echo esc_attr( $dentalcare_opening_single_day ); ?>" />
		</p>
		<p>
    		<label for="<?php echo esc_attr($this->get_field_id( 'opening_single_time' )); ?>"><?php echo esc_html__('Single Opening Time' ,'dentalcare') ?></label> 
    		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'opening_single_time' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'opening_single_time' )); ?>" type="text" value="<?php echo esc_attr( $dentalcare_opening_single_time ); ?>" />
		</p>
		<p>
    		<label for="<?php echo esc_attr($this->get_field_id( 'opening_another_day' )); ?>"><?php echo esc_html__('Another Opening Day' ,'dentalcare') ?></label> 
    		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'opening_another_day' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'opening_another_day' )); ?>" type="text" value="<?php echo esc_attr( $dentalcare_opening_another_day ); ?>" />
		</p>
		<p>
    		<label for="<?php echo esc_attr($this->get_field_id( 'opening_another_time' )); ?>"><?php echo esc_html__('Another Opening Time' ,'dentalcare') ?></label> 
    		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'opening_another_time' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'opening_another_time' )); ?>" type="text" value="<?php echo esc_attr( $dentalcare_opening_another_time ); ?>" />
		</p>

		<?php 
	}
	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
        $dentalcare_instance = array();
        $dentalcare_instance[ 'opening_hour_title' ] = $new_instance['opening_hour_title'];
		$dentalcare_instance[ 'opening_hour_day' ]   = $new_instance['opening_hour_day'] ;
		$dentalcare_instance[ 'opening_hour_time' ]  = $new_instance['opening_hour_time'] ;
		$dentalcare_instance[ 'opening_single_day' ]   = $new_instance['opening_single_day'] ;
		$dentalcare_instance[ 'opening_single_time' ]  = $new_instance['opening_single_time'] ;
		$dentalcare_instance[ 'opening_another_day' ]   = $new_instance['opening_another_day'] ;
		$dentalcare_instance[ 'opening_another_time' ]  = $new_instance['opening_another_time'] ;
		return $dentalcare_instance;
	}

	public function widget( $args, $dentalcare_instance )
	{
		// Outputs the content of the widget
        extract( $args );
		global $dentalcare_option;
        $title      = apply_filters( 'widget_title', $dentalcare_instance['opening_hour_title'] );
		$opening_day = $dentalcare_instance['opening_hour_day'];
		$opening_time = $dentalcare_instance['opening_hour_time'];
		$single_day = $dentalcare_instance['opening_single_day'];
		$single_time = $dentalcare_instance['opening_single_time'];
		$another_day = $dentalcare_instance['opening_another_day'];
		$another_time = $dentalcare_instance['opening_another_time'];
		echo $before_widget;
	?>
	
	<h4 class="tt-widget-title h5"><?php echo wp_kses_post($dentalcare_instance['opening_hour_title']);?></h4>
	<div class="tt-working">
		<div class="tt-working-row">
			<div class="tt-working-cell"><?php echo esc_attr($dentalcare_instance['opening_hour_day']);?></div>
			<div class="tt-working-cell"><?php echo esc_attr($dentalcare_instance['opening_hour_time']);?></div>
		</div>
		<div class="tt-working-row">
			<div class="tt-working-cell"><?php echo esc_attr($dentalcare_instance['opening_single_day']);?></div>
			<div class="tt-working-cell"><?php echo esc_attr($dentalcare_instance['opening_single_time']);?></div>
		</div>
		<div class="tt-working-row">
			<div class="tt-working-cell"><?php echo esc_attr($dentalcare_instance['opening_another_day']);?></div>
			<div class="tt-working-cell"><?php echo esc_attr($dentalcare_instance['opening_another_time']);?></div>
		</div>                                                                        
	</div>	
<?php
        wp_reset_postdata();
    	echo $after_widget;
	}
}
register_widget( 'dentalcare_opening_hours' );