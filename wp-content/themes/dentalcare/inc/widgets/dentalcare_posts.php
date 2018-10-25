<?php 
class dentalcare_Posts extends WP_Widget {
	public function __construct() {
		// Widget actual processes
        parent::__construct(
	 		'dentalcare_posts',                                                                // Base ID
			esc_html__('Dentalcare Posts','dentalcare'),                                               // Name
			array( 'description' => esc_html__( 'Eye catching posts widget', 'dentalcare' ), )  // Args
		);
	}
 	public function form( $dentalcare_instance ) {
		/* Set up default widget settings. */
        $defaults = array(
            'title'      => '',
            'number'     => 4,
            'post_order' => 'date'
        );
        $dentalcare_instance         = wp_parse_args( (array) $dentalcare_instance, $defaults );

        if ( isset( $dentalcare_instance[ 'title' ] ) ) {
            $title = $dentalcare_instance[ 'title' ];
        } else {
            $title = '';
        }
        $number = intval($dentalcare_instance[ 'number' ]);
        if($number<=0){
            $number = 4;
        }

        $post_order_types = array(
            'comment_count' => 'Popular Posts',
            'date'          => 'Recent Posts',
            'rand'          => 'Random Posts'
        );
        ?>
		<p>
    		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php echo esc_html( 'Title:','dentalcare'); ?></label> 
    		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>     
    	<p>
    		<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php echo esc_html('How many posts to show ?' ,'dentalcare') ?></label> 
    		<input class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" />
		</p>
        <p>
            <label for="<?php echo $this->get_field_id( 'post_order' ); ?>"><?php echo esc_html('Posts order:', 'dentalcare') ?></label>
            <select class="widefat" name="<?php echo $this->get_field_name( 'post_order' );?>" id="<?php echo $this->get_field_id( 'post_order' );?>">
                <?php foreach ( $post_order_types as $post_order_type=>$post_order_value ) { ?>
                    <option value="<?php echo esc_attr($post_order_type); ?>" <?php echo ($post_order_type == $dentalcare_instance['post_order']) ? 'selected="selected" ' : '';?>><?php echo esc_attr($post_order_value); ?></option>
                <?php } ?>
            </select>
        </p>
        
		<?php 
	}
	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
        $dentalcare_instance = array();
        $dentalcare_instance[ 'title' ]      = $new_instance['title'];
        $dentalcare_instance[ 'number' ]     = intval($new_instance[ 'number' ]);
        $dentalcare_instance[ 'post_order' ] = $new_instance[ 'post_order' ];
		return $dentalcare_instance;
	}

	public function widget( $args, $dentalcare_instance )
	{
		// Outputs the content of the widget
        extract( $args );
        $title      = apply_filters( 'widget_title', $dentalcare_instance['title'] );
        $post_order = $dentalcare_instance['post_order'];
        $number     = intval($dentalcare_instance['number']);
        if($number<=0) $number = 4;
        
		echo $before_widget;

        $args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => $number,
            'orderby' => $post_order
        );
        $the_query = new WP_Query( $args );
        $count     = 0;

        if ( $the_query->have_posts() ) : ?>
		<h4 class="tt-widget-title h5"><?php echo wp_kses_post($dentalcare_instance['title']);?></h4>
		    <?php while ( $the_query->have_posts() ) : $the_query->the_post();
                $count ++;
			?>
				<div class="tt-post clearfix">
				<a class="tt-post-img custom-hover round" href="<?php the_permalink(); ?>">
					<?php
						if( has_post_thumbnail() ) { 
						the_post_thumbnail( array(70,70) );
						}
					?>
				</a>
				<div class="tt-post-info">
					<a class="tt-post-title" href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a>
					<div class="tt-post-date"><?php echo get_the_date("d"); ?> <?php echo get_the_date("M"); ?> <?php echo get_the_date("Y"); ?></div>
				</div>
			</div>
                <?php
            endwhile;
        endif;
        wp_reset_postdata();
        
    	echo $after_widget;
	}
}
register_widget( 'dentalcare_Posts' );