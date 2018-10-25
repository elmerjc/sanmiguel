<?php

class dentalcare_services extends WP_Widget {



	public function __construct() {



		// Widget actual processes

        parent::__construct(

	 		'dentalcare_services',                                                          // Base ID

			esc_html__('Dentalcare Services','dentalcare'),                                          // Name

			array( 'description' => esc_html__( 'Eye catching posts widget', 'dentalcare' ), )  // Args

		);

	}

 	public function form( $dentalcare_instance )

	{

		$dentalcare_instance['post_order'] = '';

		/* Set up default widget settings. */

		$number = 6;

        $defaults = array(

            'title'      => '',

			'number'     => $number,

        );

        $dentalcare_instance         = wp_parse_args( (array) $dentalcare_instance, $defaults );



		$dentalcare_pages = get_pages();

		

		 if ( isset( $dentalcare_instance[ 'service_title' ] ) ) {

            $dentalcare_service_title = $dentalcare_instance[ 'service_title' ];

        } else {

            $dentalcare_service_title = '';

        }

		

		$number = intval($dentalcare_instance[ 'number' ]);

		if($number<=0){

            $number = '';

        }		

		$post_order_types = array(

            'date'          => 'Recent Services',

            'title'          => 'Sort By Title'

        );



        ?>

    	<p>

    		<label for="<?php echo esc_attr($this->get_field_id( 'service_title' )); ?>"><?php echo esc_html__('Services Title' ,'dentalcare') ?></label> 

    		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'service_title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'service_title' )); ?>" type="text" value="<?php echo esc_attr( $dentalcare_service_title ); ?>" />

		</p>

		<p>

    		<label for="<?php echo esc_attr($this->get_field_id( 'number' )); ?>"><?php echo esc_html__('How many services to show ?' ,'dentalcare') ?></label> 

    		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number' )); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" />

			

			<label for="<?php echo esc_attr($this->get_field_id( 'post_order' )); ?>"><?php echo esc_html__('Services order:', 'dentalcare') ?></label>

            <select class="widefat" name="<?php echo esc_attr($this->get_field_name( 'post_order' ));?>" id="<?php echo esc_attr($this->get_field_id( 'post_order' ));?>">

                <?php foreach ( $post_order_types as $post_order_type=>$post_order_value ) { ?>

                    <option value="<?php echo esc_attr($post_order_type); ?>" <?php echo ($post_order_type == $dentalcare_instance['post_order']) ? 'selected="selected" ' : '';?>><?php echo esc_attr($post_order_value); ?></option>

                <?php } ?>

            </select>

						

		</p>

		<p>

			<label for="<?php echo esc_attr($this->get_field_id('select_page')); ?>"><?php echo esc_html__( 'All Services:', 'dentalcare' ) ?></label>

			<select name="<?php echo esc_attr($this->get_field_name('select_page')); ?>" id="<?php echo esc_attr($this->get_field_id('select_page')); ?>" class="widefat">



			<?php

			foreach($dentalcare_pages AS $page=>$val)

			{

			?>

				<option value="<?php echo esc_attr($val->ID);?>"<?php selected( $dentalcare_instance['select_page'], $val->ID ); ?>><?php echo esc_attr($val->post_name); ?></option>

			<?php

			}

			?>	

			</select>

		</p>



		<?php 

	}

	public function update( $new_instance, $old_instance ) {

		// processes widget options to be saved

        $dentalcare_instance = array();

        $dentalcare_instance[ 'service_title' ]= strip_tags( $new_instance['service_title'] );

		$dentalcare_instance[ 'number' ]     = intval($new_instance[ 'number' ]);

		$dentalcare_instance[ 'post_order' ] = $new_instance[ 'post_order' ];

		$dentalcare_instance['select_page'] = $new_instance['select_page'];

		return $dentalcare_instance;

	}



	public function widget( $args, $dentalcare_instance )

	{

		// Outputs the content of the widget

        extract( $args );

		global $dentalcare_option;

        $title      = apply_filters( 'widget_title', $dentalcare_instance['service_title'] );

		$number     = intval($dentalcare_instance['number']);

		$post_order = $dentalcare_instance['post_order'];

		if($number<=0) $number = '';

		

		if($post_order == 'date'){

			$order = 'DESC';			

		} else if ($post_order == 'title'){

			$order = 'ASC';

		}

				

		echo $before_widget;

		$args = array(

		

            'post_type' => 'services',

            'post_status' => 'publish',

			'posts_per_page' => $number,

			'orderby' => $post_order,

			'order'   => $order		

        );

        $the_query = new WP_Query( $args );

        $count     = 0; 

	?>

	<h4 class="widget_title service_widget"><?php echo esc_attr($dentalcare_instance['service_title']);?></h4>

	<div class="tt-tab-nav-wrapper">

		<div  class="tt-nav-tab">

			<?php

				$varPageID = get_the_ID(); ?>

			<div class="tt-nav-tab-item">

					<a href="<?php echo get_permalink( $dentalcare_instance['select_page'] ); ?>"> <span> <?php echo esc_html__('Todos','dentalcare'); ?> </span> </a>

			</div>

	  <?php while ( $the_query->have_posts() ) : $the_query->the_post();

			

				if($varPageID == get_the_ID())

				$varClass = 'active';

				else

				$varClass = '';

			

			?>

				<div class="tt-nav-tab-item <?php echo esc_attr($varClass); ?>">

					<a href="<?php the_permalink(); ?>"> <span> <?php the_title(); ?> </span> </a>

				</div>

				

			<?php endwhile;?>  

			

		</div>

	</div> 	

<?php

        wp_reset_postdata();

    	echo $after_widget;

	}

}

register_widget( 'dentalcare_services' );