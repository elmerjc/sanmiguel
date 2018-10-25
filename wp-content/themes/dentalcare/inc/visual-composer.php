<?php
if ( function_exists( 'vc_set_default_editor_post_types' ) ) {
	vc_set_default_editor_post_types( array(
		'page','post','sidebar','team','services','gallery','testimonials'
	) );
}

add_action( 'vc_before_init', 'dentalcare_vc_set_as_theme' );

if( ! function_exists( 'dentalcare_vc_set_as_theme' ) ) {
	function dentalcare_vc_set_as_theme() {
		vc_set_as_theme( true );
	}
}

if( ! function_exists( 'dentalcare_animator_param' ) ){
	function dentalcare_animator_param( $settings, $value ) {
		global $wp_filesystem;

		if ( empty( $wp_filesystem ) ) {
			require_once ABSPATH . '/wp-admin/includes/file.php';
			WP_Filesystem();
		}
		$param_name = isset( $settings['param_name'] ) ? $settings['param_name'] : '';
		$type       = isset( $settings['type'] ) ? $settings['type'] : '';
		$class      = isset( $settings['class'] ) ? $settings['class'] : '';
		$animations = json_decode( $wp_filesystem->get_contents( get_template_directory() . '/assets/js/animate-config.json' ), true );
		if ( $animations ) {
			$output = '<select name="' . esc_attr( $param_name ) . '" class="wpb_vc_param_value ' . esc_attr( $param_name . ' ' . $type . ' ' . $class ) . '">';
			foreach ( $animations as $key => $val ) {
				if ( is_array( $val ) ) {
					$labels = str_replace( '_', ' ', $key );
					$output .= '<optgroup label="' . ucwords( esc_attr( $labels ) ) . '">';
					foreach ( $val as $label => $style ) {
						$label = str_replace( '_', ' ', $label );
						if ( $label == $value ) {
							$output .= '<option selected value="' . esc_attr( $label ) . '">' . esc_html( $label ) . '</option>';
						} else {
							$output .= '<option value="' . esc_attr( $label ) . '">' . esc_html( $label ) . '</option>';
						}
					}
				} else {
					if ( $key == $value ) {
						$output .= "<option selected value=" . esc_attr( $key ) . ">" . esc_html( $key ) . "</option>";
					} else {
						$output .= "<option value=" . esc_attr( $key ) . ">" . esc_html( $key ) . "</option>";
					}
				}
			}

			$output .= '</select>';
		}

		return $output;
	}
}

add_filter( 'vc_google_fonts_get_fonts_filter', 'dentalcare_vc_google_fonts', 10, 1 );

add_action( 'admin_init', 'dentalcare_update_existing_shortcodes' );

if ( ! function_exists( 'dentalcare_update_existing_shortcodes' ) ) {
	function dentalcare_update_existing_shortcodes() {

		if ( function_exists( 'vc_add_params' ) ) {

			vc_add_params( 'vc_gallery', array(
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Gallery type', 'dentalcare' ),
					'param_name' => 'type',
					'value'      => array(
						esc_html__( 'Image grid', 'dentalcare' )     => 'image_grid',
						esc_html__( 'Slick slider', 'dentalcare' )   => 'slick_slider',
						esc_html__( 'Slick slider 2', 'dentalcare' ) => 'slick_slider_2'
					)
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Thumbnail size', 'dentalcare' ),
					'param_name' => 'thumbnail_size',
					'dependency' => array(
						'element' => 'type',
						'value'   => array( 'slick_slider_2' )
					),
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'dentalcare' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'dentalcare' )
				)
			) );

			vc_add_params( 'vc_column_inner', array(
				array(
					'type'        => 'column_offset',
					'heading'     => esc_html__( 'Responsiveness', 'dentalcare' ),
					'param_name'  => 'offset',
					'group'       => esc_html__( 'Width & Responsiveness', 'dentalcare' ),
					'description' => esc_html__( 'Adjust column for different screen sizes. Control width, offset and visibility settings.', 'dentalcare' )
				)
			) );

			vc_add_params( 'vc_separator', array(
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Type', 'dentalcare' ),
					'param_name' => 'type',
					'value'      => array(
						esc_html__( 'Type 1', 'dentalcare' ) => 'type_1',
						esc_html__( 'Type 2', 'dentalcare' ) => 'type_2'
					)
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'dentalcare' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'dentalcare' )
				),
			) );

			vc_add_params( 'vc_video', array(
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Video Width', 'dentalcare' ),
					'param_name' => 'size'
				),
				array(
					'type'       => 'attach_image',
					'heading'    => esc_html__( 'Preview Image', 'dentalcare' ),
					'param_name' => 'image'
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Image Size', 'dentalcare' ),
					'param_name'  => 'img_size',
					'description' => esc_html__( 'Enter image size. Example: "thumbnail", "medium", "large", "full" or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "projects_gallery" size.', 'dentalcare' )
				),
			) );

			vc_add_params( 'vc_wp_pages', array(
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'dentalcare' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'dentalcare' )
				)
			) );

			vc_add_params( 'vc_custom_heading', array(
				array(
					'type'       => 'iconpicker',
					'heading'    => esc_html__( 'Icon', 'dentalcare' ),
					'param_name' => 'icon',
					'value'      => '',
					'weight'     => 1
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Icon Size (px)', 'dentalcare' ),
					'param_name' => 'icon_size',
					'value'      => '',
					'weight'     => 1
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Icon - Position', 'dentalcare' ),
					'param_name' => 'icon_pos',
					'value'      => array(
						esc_html__( 'Left', 'dentalcare' ) => '',
						esc_html__( 'Right', 'dentalcare' ) => 'right',
						esc_html__( 'Top', 'dentalcare' ) => 'top',
						esc_html__( 'Bottom', 'dentalcare' ) => 'bottom'
					),
					'weight'     => 1
				),
				array(
					'type'       => 'textarea',
					'heading'    => esc_html__( 'Subtitle', 'dentalcare' ),
					'param_name' => 'subtitle',
					'weight'     => 1
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Subtitle - Color', 'dentalcare' ),
					'param_name' => 'subtitle_color',
					'weight'     => 1
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Stripe - Position', 'dentalcare' ),
					'param_name' => 'stripe_pos',
					'value'      => array(
						esc_html__( 'Bottom', 'dentalcare' ) => 'bottom',
						esc_html__( 'Between Title and Subtitle', 'dentalcare' ) => 'between',
						esc_html__( 'Hide', 'dentalcare' ) => 'hide'
					),
					'weight'     => 1
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Font weight', 'dentalcare' ),
					'param_name' => 'dentalcare_title_font_weight',
					'value'      => array(
						esc_html__( 'Select', 'dentalcare' )    => '',
						esc_html__( 'Thin', 'dentalcare' )      => 100,
						esc_html__( 'Light', 'dentalcare' )     => 300,
						esc_html__( 'Regular', 'dentalcare' )   => 400,
						esc_html__( 'Medium', 'dentalcare' )    => 500,
						esc_html__( 'Semi-bold', 'dentalcare' ) => 600,
						esc_html__( 'Bold', 'dentalcare' )      => 700,
						esc_html__( 'Black', 'dentalcare' )     => 900
					),
					'weight'     => 1
				)
			) );

			vc_add_params( 'vc_basic_grid', array(
				array(
					'type'             => 'dropdown',
					'heading'          => esc_html__( 'Gap', 'dentalcare' ),
					'param_name'       => 'gap',
					'value'            => array(
						esc_html__( '0px', 'dentalcare' )  => '0',
						esc_html__( '1px', 'dentalcare' )  => '1',
						esc_html__( '2px', 'dentalcare' )  => '2',
						esc_html__( '3px', 'dentalcare' )  => '3',
						esc_html__( '4px', 'dentalcare' )  => '4',
						esc_html__( '5px', 'dentalcare' )  => '5',
						esc_html__( '10px', 'dentalcare' ) => '10',
						esc_html__( '15px', 'dentalcare' ) => '15',
						esc_html__( '20px', 'dentalcare' ) => '20',
						esc_html__( '25px', 'dentalcare' ) => '25',
						esc_html__( '30px', 'dentalcare' ) => '30',
						esc_html__( '35px', 'dentalcare' ) => '35',
						esc_html__( '40px', 'dentalcare' ) => '40',
						esc_html__( '45px', 'dentalcare' ) => '45',
						esc_html__( '50px', 'dentalcare' ) => '50',
						esc_html__( '55px', 'dentalcare' ) => '55',
						esc_html__( '60px', 'dentalcare' ) => '60',
					),
					'std'              => '30',
					'description'      => esc_html__( 'Select gap between grid elements.', 'dentalcare' ),
					'edit_field_class' => 'vc_col-sm-6 vc_column',
				)
			) );

			vc_add_params( 'vc_btn', array(
				array(
					'type'               => 'dropdown',
					'heading'            => esc_html__( 'Color', 'dentalcare' ),
					'param_name'         => 'color',
					'description'        => esc_html__( 'Select button color.', 'dentalcare' ),
					'param_holder_class' => 'vc_colored-dropdown vc_btn3-colored-dropdown',
					'value'              => array(
						                        esc_html__( 'Theme Style 1', 'dentalcare' )     => 'theme_style_1',
						                        esc_html__( 'Theme Style 2', 'dentalcare' )     => 'theme_style_2',
						                        esc_html__( 'Theme Style 3', 'dentalcare' )     => 'theme_style_3',
						                        esc_html__( 'Theme Style 4', 'dentalcare' )     => 'theme_style_4',
						                        esc_html__( 'Classic Grey', 'dentalcare' )      => 'default',
						                        esc_html__( 'Classic Blue', 'dentalcare' )      => 'primary',
						                        esc_html__( 'Classic Turquoise', 'dentalcare' ) => 'info',
						                        esc_html__( 'Classic Green', 'dentalcare' )     => 'success',
						                        esc_html__( 'Classic Orange', 'dentalcare' )    => 'warning',
						                        esc_html__( 'Classic Red', 'dentalcare' )       => 'danger',
						                        esc_html__( 'Classic Black', 'dentalcare' )     => 'inverse',
					                        ) + getVcShared( 'colors-dashed' ),
					'std'                => 'grey',
					'dependency'         => array(
						'element'            => 'style',
						'value_not_equal_to' => array( 'custom', 'outline-custom' ),
					),
				)
			) );

		}

	}
}

if ( function_exists( 'vc_map' ) ) {
	add_action( 'init', 'dentalcare_vc_elements' );
}

if ( ! function_exists( 'dentalcare_vc_elements' ) ) {
	function dentalcare_vc_elements() {

		$project_categories_array = get_terms( 'project_category' );
		$project_categories       = array(
			esc_html__( 'All', 'dentalcare' ) => 'all'
		);
		if ( $project_categories_array && ! is_wp_error( $project_categories_array ) ) {
			foreach ( $project_categories_array as $cat ) {
				$project_categories[ $cat->name ] = $cat->slug;
			}
		}

		vc_map( array(
			'name'     => esc_html__( 'Contacts', 'dentalcare' ),
			'base'     => 'dentalcare_contacts_widget',
			'category' => esc_html__( 'TMC', 'dentalcare' ),
			'params'   => array(
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Style', 'dentalcare' ),
					'param_name' => 'style',
					'value'      => array(
						esc_html__( 'Style 1', 'dentalcare' ) => 'style_1',
						esc_html__( 'Style 2', 'dentalcare' ) => 'style_2',
						esc_html__( 'Style 3', 'dentalcare' ) => 'style_3'
					),
				),
				array(
					'type'       => 'textfield',
					'holder'     => 'div',
					'heading'    => esc_html__( 'Title', 'dentalcare' ),
					'param_name' => 'title',
					'dependency' => array('element' => 'style', 'value' => array('style_1'))
				),
				array(
					'type'       => 'textarea',
					'heading'    => esc_html__( 'Address', 'dentalcare' ),
					'param_name' => 'address',
					'dependency' => array('element' => 'style', 'value' => array('style_1', 'style_3'))
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Phone', 'dentalcare' ),
					'param_name' => 'phone',
					'dependency' => array('element' => 'style', 'value' => array('style_1', 'style_2'))
				),
				array(
					'type'       => 'textarea',
					'heading'    => esc_html__( 'Phone', 'dentalcare' ),
					'param_name' => 'phones',
					'dependency' => array('element' => 'style', 'value' => array('style_3'))
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Email', 'dentalcare' ),
					'param_name' => 'email'
				),
				array(
					'type'       => 'textarea',
					'heading'    => esc_html__( 'Schedule', 'dentalcare' ),
					'param_name' => 'schedule',
					'dependency' => array('element' => 'style', 'value' => array('style_3'))
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Facebook', 'dentalcare' ),
					'param_name' => 'facebook',
					'dependency' => array('element' => 'style', 'value' => array('style_1'))
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Twitter', 'dentalcare' ),
					'param_name' => 'twitter',
					'dependency' => array('element' => 'style', 'value' => array('style_1'))
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Linkedin', 'dentalcare' ),
					'param_name' => 'linkedin',
					'dependency' => array('element' => 'style', 'value' => array('style_1'))
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Google+', 'dentalcare' ),
					'param_name' => 'google_plus',
					'dependency' => array('element' => 'style', 'value' => array('style_1'))
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Skype', 'dentalcare' ),
					'param_name' => 'skype',
					'dependency' => array('element' => 'style', 'value' => array('style_1'))
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Extra class name', 'dentalcare' ),
					'param_name'  => 'class',
					'value'       => '',
					'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'dentalcare' )
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'dentalcare' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'dentalcare' )
				)
			)
		) );

		vc_map( array(
			'name'     => esc_html__( 'Info Box', 'dentalcare' ),
			'base'     => 'dentalcare_info_box',
			'category' => esc_html__( 'TMC', 'dentalcare' ),
			'params'   => array(
				array(
					'type'       => 'textfield',
					'holder'     => 'div',
					'heading'    => esc_html__( 'Title', 'dentalcare' ),
					'param_name' => 'title'
				),
				array(
					'type'       => 'attach_image',
					'heading'    => esc_html__( 'Image', 'dentalcare' ),
					'param_name' => 'image',
					'dependency'  => array(
						'element' => 'style',
						'value'   => array( 'style_1', 'style_2', 'style_3', 'style_4' )
					)
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Image Size', 'dentalcare' ),
					'param_name' => 'vc_image_size',
					'dependency'  => array(
						'element' => 'style',
						'value'   => array( 'style_1', 'style_2', 'style_3', 'style_4' )
					),
					'description' => esc_html__( 'Example: Text - full, large, medium, Number - 340x200', 'dentalcare' ),
				),
				array(
					'type'       => 'checkbox',
					'heading'    => esc_html__( 'Align Center', 'dentalcare' ),
					'param_name' => 'align_center',
					'value'      => array(
						esc_html__( 'Yes', 'dentalcare' ) => 'yes'
					),
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Style', 'dentalcare' ),
					'param_name' => 'style',
					'value'      => array(
						esc_html__( 'Style 1', 'dentalcare' ) => 'style_1',
						esc_html__( 'Style 2', 'dentalcare' ) => 'style_2',
						esc_html__( 'Style 3', 'dentalcare' ) => 'style_3',
						esc_html__( 'Style 4', 'dentalcare' ) => 'style_4',
						esc_html__( 'Style 5', 'dentalcare' ) => 'style_5',
						esc_html__( 'Style 6', 'dentalcare' ) => 'style_6'
					),
				),
				array(
					'type'       => 'iconpicker',
					'heading'    => esc_html__( 'Title Icon', 'dentalcare' ),
					'param_name' => 'title_icon',
					'value'      => '',
					'dependency'  => array(
						'element' => 'style',
						'value'   => array( 'style_3', 'style_6' )
					)
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Icon - Size', 'dentalcare' ),
					'param_name' => 'title_icon_size',
					'description' => esc_html__( 'Enter icon size in "px"', 'dentalcare'),
					'dependency'  => array(
						'element' => 'style',
						'value'   => array( 'style_6' )
					)
				),
				array(
					'type'       => 'textarea_html',
					'heading'    => esc_html__( 'Text', 'dentalcare' ),
					'param_name' => 'content'
				),
				array(
					'type'       => 'vc_link',
					'heading'    => esc_html__( 'Link', 'dentalcare' ),
					'param_name' => 'link'
				),
				array(
					'type'       => 'iconpicker',
					'heading'    => esc_html__( 'Link Icon', 'dentalcare' ),
					'param_name' => 'icon',
					'value'      => '',
					'dependency'  => array(
						'element' => 'style',
						'value'   => array( 'style_1', 'style_2', 'style_3', 'style_5', 'style_6' )
					)
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'dentalcare' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'dentalcare' )
				)
			)
		) );

		vc_map( array(
			'name'     => esc_html__( 'Icon Box', 'dentalcare' ),
			'base'     => 'dentalcare_icon_box',
			'category' => esc_html__( 'TMC', 'dentalcare' ),
			'params'   => array(
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Style', 'dentalcare' ),
					'param_name' => 'box_style',
					'value'      => array(
						esc_html__( 'Style 1', 'dentalcare' ) => 'style_1',
						esc_html__( 'Style 2', 'dentalcare' ) => 'style_2'
					)
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Alignment', 'dentalcare' ),
					'param_name' => 'alignment',
					'value'      => array(
						esc_html__( 'Left', 'dentalcare' )   => 'left',
						esc_html__( 'Right', 'dentalcare' )  => 'right',
						esc_html__( 'Center', 'dentalcare' ) => 'center'
					),
					'dependency' => array('element' => 'box_style', 'value' => 'style_2')
				),
				array(
					'type'       => 'textarea',
					'holder'     => 'div',
					'heading'    => esc_html__( 'Title', 'dentalcare' ),
					'param_name' => 'title'
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Title - Font size', 'dentalcare' ),
					'param_name'  => 'title_font_size',
					'description' => esc_html__( 'Enter font size in px', 'dentalcare' )
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Title - Line Height', 'dentalcare' ),
					'param_name'  => 'title_line_height',
					'description' => esc_html__( 'Enter line-height in px', 'dentalcare' )
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Title - Color', 'dentalcare' ),
					'param_name' => 'title_color',
					'value'      => array(
						esc_html__( 'Base', 'dentalcare' ) => 'base',
						esc_html__( 'Secondary', 'dentalcare' ) => 'secondary',
						esc_html__( 'Third', 'dentalcare' ) => 'third',
						esc_html__( 'Custom', 'dentalcare' ) => 'custom'
					)
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Title - Color Custom', 'dentalcare' ),
					'param_name' => 'title_color_custom',
					'dependency' => array('element' => 'title_color', 'value' => 'custom')
				),
				array(
					'type'       => 'checkbox',
					'heading'    => '',
					'param_name' => 'hide_title_line',
					'value'      => array(
						esc_html__( 'Hide Title Line', 'dentalcare' ) => 'hide_title_line'
					),
					'dependency' => array('element' => 'box_style', 'value' => 'style_1')
				),
				array(
					'type'       => 'checkbox',
					'heading'    => '',
					'param_name' => 'enable_hexagon',
					'value'      => array(
						esc_html__( 'Enable Hexagon', 'dentalcare' ) => 'enable'
					),
					'dependency' => array('element' => 'box_style', 'value' => 'style_1')
				),
				array(
					'type'       => 'checkbox',
					'heading'    => '',
					'param_name' => 'enable_hexagon_animation',
					'value'      => array(
						esc_html__( 'Enable Hexagon Hover Animation', 'dentalcare' ) => 'enable'
					),
					'dependency' => array('element' => 'box_style', 'value' => 'style_1')
				),
				array(
					'type'       => 'checkbox',
					'heading'    => '',
					'param_name' => 'v_align_middle',
					'value'      => array(
						esc_html__( 'Enable Middle Align', 'dentalcare' ) => 'enable'
					),
					'dependency' => array('element' => 'box_style', 'value' => 'style_1')
				),
				array(
					'type'       => 'iconpicker',
					'heading'    => esc_html__( 'Icon', 'dentalcare' ),
					'param_name' => 'icon',
					'value'      => ''
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Icon - Position', 'dentalcare' ),
					'param_name' => 'style',
					'value'      => array(
						esc_html__( 'Icon Top', 'dentalcare' )              => 'icon_top',
						esc_html__( 'Icon Top Transparent', 'dentalcare' ) => 'icon_top_transparent',
						esc_html__( 'Icon Left', 'dentalcare' )             => 'icon_left',
						esc_html__( 'Icon Left Transparent', 'dentalcare' ) => 'icon_left_transparent'
					),
					'dependency' => array('element' => 'box_style', 'value' => 'style_1')
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Icon Size', 'dentalcare' ),
					'param_name'  => 'icon_size',
					'value'       => '65',
					'description' => esc_html__( 'Enter icon size in px', 'dentalcare' )
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Icon - Color', 'dentalcare' ),
					'param_name' => 'icon_color',
					'value'      => array(
						esc_html__( 'Base', 'dentalcare' ) => 'base',
						esc_html__( 'Secondary', 'dentalcare' ) => 'secondary',
						esc_html__( 'Third', 'dentalcare' ) => 'third',
						esc_html__( 'Custom', 'dentalcare' ) => 'custom'
					)
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Icon - Color Custom', 'dentalcare' ),
					'param_name' => 'icon_color_custom',
					'dependency' => array('element' => 'icon_color', 'value' => 'custom')
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Icon Height', 'dentalcare' ),
					'param_name'  => 'icon_height',
					'value'       => '65',
					'description' => esc_html__( 'Enter icon height in px', 'dentalcare' ),
					'dependency'  => array(
						'element' => 'style',
						'value'   => array( 'icon_top', 'icon_top_transparent' )
					)
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Icon Width', 'dentalcare' ),
					'param_name'  => 'icon_width',
					'value'       => '50',
					'description' => esc_html__( 'Enter icon width in px', 'dentalcare' ),
					'dependency'  => array(
						'element' => 'style',
						'value'   => array( 'icon_left', 'icon_left_transparent' )
					)
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Icon Wrapper Width', 'dentalcare' ),
					'param_name'  => 'icon_width_wr',
					'value'       => '',
					'description' => esc_html__( 'Enter icon wrapper width in px', 'dentalcare' ),
					'dependency'  => array(
						'element' => 'box_style',
						'value'   => array( 'style_2' )
					)
				),
				array(
					'type'       => 'textarea_html',
					'heading'    => esc_html__( 'Text', 'dentalcare' ),
					'param_name' => 'content',
					'dependency' => array('element' => 'box_style', 'value' => 'style_1')
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'dentalcare' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'dentalcare' )
				)
			)
		) );

		
		vc_map( array(
			'name'        => esc_html__( 'Spacing', 'dentalcare' ),
			'base'        => 'dentalcare_spacing',
			'category' => esc_html__( 'TMC', 'dentalcare' ),
			'params'      => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Large Screen', 'dentalcare' ),
					'param_name' => 'lg_spacing'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Medium Screen', 'dentalcare' ),
					'param_name' => 'md_spacing'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Small Screen', 'dentalcare' ),
					'param_name' => 'sm_spacing'
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra Small Screen', 'dentalcare' ),
					'param_name' => 'xs_spacing'
				)
			)
		) );

		vc_map( array(
			'name'     => esc_html__( 'Contact', 'dentalcare' ),
			'base'     => 'dentalcare_contact',
			'category' => esc_html__( 'TMC', 'dentalcare' ),
			'params'   => array(
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Name', 'dentalcare' ),
					'param_name' => 'name'
				),
				array(
					'type'       => 'attach_image',
					'heading'    => esc_html__( 'Image', 'dentalcare' ),
					'param_name' => 'image'
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Image Size', 'dentalcare' ),
					'param_name'  => 'image_size',
					'description' => esc_html__( 'Enter image size. Example: "thumbnail", "medium", "large", "full" or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "default" size.', 'dentalcare' )
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Job', 'dentalcare' ),
					'param_name' => 'job'
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Email', 'dentalcare' ),
					'param_name' => 'email'
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Skype', 'dentalcare' ),
					'param_name' => 'skype'
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'dentalcare' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'dentalcare' )
				)
			)
		) );

		$dentalcare_sidebars_array = get_posts( array( 'post_type' => 'dentalcare_vc_sidebar', 'posts_per_page' => - 1 ) );
		$dentalcare_sidebars       = array( esc_html__( 'Select', 'dentalcare' ) => 0 );
		if ( $dentalcare_sidebars_array && ! is_wp_error( $dentalcare_sidebars_array ) ) {
			foreach ( $dentalcare_sidebars_array as $val ) {
				$dentalcare_sidebars[ get_the_title( $val ) ] = $val->ID;
			}
		}

		vc_map( array(
			'name'     => esc_html__( 'TMC Sidebar', 'dentalcare' ),
			'base'     => 'dentalcare_sidebar',
			'category' => esc_html__( 'TMC', 'dentalcare' ),
			'params'   => array(
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Code', 'dentalcare' ),
					'param_name' => 'sidebar',
					'value'      => $dentalcare_sidebars
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'dentalcare' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'dentalcare' )
				)
			)
		) );


		vc_map( array(
			'name'                    => esc_html__( 'Google Map', 'dentalcare' ),
			'base'                    => 'dentalcare_gmap',
			'icon'                    => 'dentalcare_gmap',
			'as_parent'               => array( 'only' => 'dentalcare_gmap_address' ),
			'show_settings_on_create' => true,
			'js_view'                 => 'VcColumnView',
			'category'                => esc_html__( 'TMC', 'dentalcare' ),
			'params'                  => array(
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Map Height', 'dentalcare' ),
					'param_name'  => 'map_height',
					'value'       => '733px',
					'description' => esc_html__( 'Enter map height in px', 'dentalcare' )
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Map Zoom', 'dentalcare' ),
					'param_name' => 'map_zoom',
					'value'      => 18
				),
				array(
					'type'       => 'attach_image',
					'heading'    => esc_html__( 'Marker Image', 'dentalcare' ),
					'param_name' => 'marker'
				),
				array(
					'type'       => 'checkbox',
					'param_name' => 'disable_mouse_whell',
					'value'      => array(
						esc_html__( 'Disable map zoom on mouse wheel scroll', 'dentalcare' ) => 'disable'
					)
				),
				array(
					'type'       => 'textarea_raw_html',
					'heading'    => esc_html__( 'Style Code', 'dentalcare' ),
					'param_name' => 'gmap_style',
					'group'      => esc_html__('Map Style', 'dentalcare')
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Extra class name', 'dentalcare' ),
					'param_name'  => 'el_class',
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'dentalcare' )
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'dentalcare' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'dentalcare' )
				)
			)
		) );

		vc_map( array(
			'name'     => esc_html__( 'Bottom Info', 'dentalcare' ),
			'base'     => 'dentalcare_post_bottom',
			'category' => esc_html__( 'TMC Post Partials', 'dentalcare' ),
			'params'   => array(
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'dentalcare' ),
					'param_name' => 'css'
				)
			)
		) );

		vc_map( array(
			'name'     => esc_html__( 'Comments', 'dentalcare' ),
			'base'     => 'dentalcare_post_comments',
			'category' => esc_html__( 'TMC Post Partials', 'dentalcare' ),
			'params'   => array(
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'dentalcare' ),
					'param_name' => 'css',
				)
			)
		) );
		
		vc_map( array(
			'name'     => esc_html__( 'Charts', 'dentalcare' ),
			'base'     => 'dentalcare_charts',
			'icon'     => 'dentalcare_charts',
			'category' => esc_html__( 'TMC', 'dentalcare' ),
			'params'   => array(
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Design', 'dentalcare' ),
					'param_name' => 'design',
					'value'      => array(
						esc_html__( 'Line', 'dentalcare' )   => 'line',
						esc_html__( 'Bar', 'dentalcare' )    => 'bar',
						esc_html__( 'Circle', 'dentalcare' ) => 'circle',
						esc_html__( 'Pie', 'dentalcare' )    => 'pie',
					),
				),
				array(
					'type'        => 'checkbox',
					'heading'     => esc_html__( 'Show legend?', 'dentalcare' ),
					'param_name'  => 'legend',
					'description' => esc_html__( 'If checked, chart will have legend.', 'dentalcare' ),
					'value'       => array( esc_html__( 'Yes', 'dentalcare' ) => 'yes' ),
					'std'         => 'yes',
				),
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Legend Position', 'dentalcare' ),
					'param_name' => 'legend_position',
					'value'      => array(
						esc_html__( 'Bottom', 'dentalcare' ) => 'bottom',
						esc_html__( 'Right', 'dentalcare' )  => 'right',
					),
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Width (px)', 'dentalcare' ),
					'param_name' => 'width',
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Height (px)', 'dentalcare' ),
					'param_name' => 'height',
				),
				array(
					'type'       => 'textarea',
					'heading'    => esc_html__( 'X-axis values', 'dentalcare' ),
					'param_name' => 'x_values',
					'value'      => 'JAN; FEB; MAR; APR; MAY; JUN; JUL; AUG',
					'dependency' => array(
						'element' => 'design',
						'value'   => array( 'line', 'bar' )
					),
				),
				array(
					'type'       => 'param_group',
					'heading'    => esc_html__( 'Values', 'dentalcare' ),
					'param_name' => 'values',
					'dependency' => array(
						'element' => 'design',
						'value'   => array( 'line', 'bar' )
					),
					'value'      => urlencode( json_encode( array(
						array(
							'title' => esc_html__( 'One', 'dentalcare' ),
							'y_values' => '10; 15; 20; 25; 27; 25; 23; 25',
							'color' => '#fe6c61',
						),
						array(
							'title' => esc_html__( 'Two', 'dentalcare' ),
							'y_values' => '25; 18; 16; 17; 20; 25; 30; 35',
							'color' => '#5472d2'
						)
					) ) ),
					'params'     => array(
						array(
							'type'        => 'textfield',
							'heading'     => esc_html__( 'Title', 'dentalcare' ),
							'param_name'  => 'title',
							'description' => esc_html__( 'Enter title for chart dataset.', 'dentalcare' ),
							'admin_label' => true,
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__( 'Y-axis values', 'dentalcare' ),
							'param_name' => 'y_values'
						),
						array(
							'type'       => 'colorpicker',
							'heading'    => esc_html__( 'Color', 'dentalcare' ),
							'param_name' => 'color'
						)
					),
					'callbacks'  => array(
						'after_add' => 'vcChartParamAfterAddCallback',
					),
				),
				array(
					'type'       => 'param_group',
					'heading'    => esc_html__( 'Values', 'dentalcare' ),
					'param_name' => 'values_circle',
					'dependency' => array(
						'element' => 'design',
						'value'   => array( 'circle', 'pie' )
					),
					'value'      => urlencode( json_encode( array(
						array(
							'title' => esc_html__( 'One', 'dentalcare' ),
							'value' => '40',
							'color' => '#fe6c61',
						),
						array(
							'title' => esc_html__( 'Two', 'dentalcare' ),
							'value' => '30',
							'color' => '#5472d2'
						),
						array(
							'title' => esc_html__( 'Three', 'dentalcare' ),
							'value' => '40',
							'color' => '#8d6dc4'
						)
					) ) ),
					'params'     => array(
						array(
							'type'        => 'textfield',
							'heading'     => esc_html__( 'Title', 'dentalcare' ),
							'param_name'  => 'title',
							'description' => esc_html__( 'Enter title for chart dataset.', 'dentalcare' ),
							'admin_label' => true,
						),
						array(
							'type'       => 'textfield',
							'heading'    => esc_html__( 'Value', 'dentalcare' ),
							'param_name' => 'value'
						),
						array(
							'type'       => 'colorpicker',
							'heading'    => esc_html__( 'Color', 'dentalcare' ),
							'param_name' => 'color'
						)
					),
					'callbacks'  => array(
						'after_add' => 'vcChartParamAfterAddCallback',
					),
				),
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'dentalcare' ),
					'param_name' => 'css',
					'group'      => esc_html__( 'Design options', 'dentalcare' )
				)
			)
		) );

		vc_map( array(
			'name'     => esc_html__( 'About Vacancy', 'dentalcare' ),
			'base'     => 'dentalcare_about_vacancy',
			'category' => esc_html__( 'TMC Vacancy Partials', 'dentalcare' ),
			'params'   => array(
				array(
					'type'       => 'css_editor',
					'heading'    => esc_html__( 'Css', 'dentalcare' ),
					'param_name' => 'css',
				)
			)
		) );
		
/*------------------------------------------------------*/
/* CUSTOM HEADING
/*------------------------------------------------------*/
vc_map( array(
	'name'                      => esc_html__('Custom Heading', 'dentalcare'),
	'base'                      => 'dentalcare_custom_heading',
	'icon'                      => '',
	'show_settings_on_create'   => true,
	'category'                  => esc_html__('TMC Elements', 'dentalcare'),
	'save_always' 				=> true,
	'params'                    => array(
		array(
			'type'        => 'textarea',
			'heading'     => esc_html__( 'Heading', 'dentalcare' ),
			'param_name'  => 'heading',
			'admin_label' => true,
			'value'       => '',
			'description' => esc_html__('Custom heading, allow simple HTML code.', 'dentalcare')
		),
		array(
			'type'       => 'colorpicker',
			'heading'    => esc_html__('Heading Color','dentalcare'),
			'param_name' => 'heading_color',
			'value'      => '#13304f',
		
		),

		array(
			'type'        => 'textarea',
			'heading'     => esc_html__( 'Heading', 'dentalcare' ),
			'param_name'  => 'heading_two',
			'admin_label' => true,
			'value'       => '',
			'description' => esc_html__('Custom heading, allow simple HTML code.', 'dentalcare')
		),

		array(
			'type'       => 'colorpicker',
			'class'      => '',
			'heading'    => esc_html__('Heading Color','dentalcare'),
			'param_name' => 'heading_color_two',
			'value'      => '#1f6bbe',
			

		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Heading Position', 'dentalcare' ),
			'param_name'  => 'position',
			'value'       => array(
				esc_html__('Left', 'dentalcare')   => 'left',
				esc_html__('Center', 'dentalcare') => 'center',
				esc_html__('Right', 'dentalcare')  => 'right'
			)
		),

		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Extra class name', 'dentalcare' ),
			'param_name'  => 'el_class',
			'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'dentalcare' )
		)
	),
) );
		
/*------------------------------------------------------*/
/* Home Services
/*------------------------------------------------------*/
$args = array(
	 'sort_order' => 'asc',
	 'sort_column' => 'post_title',
	 'hierarchical' => 1,
	 'exclude' => '',
	 'meta_key' => '',
	 'meta_value' => '',
	 'authors' => '',
	 'child_of' => 0,
	 'parent' => -1,
	 'exclude_tree' => '',
	 'number' => '',
	 'offset' => 0,
	 'post_type' => 'page',
	 'post_status' => 'publish'
	); 
	$pages = get_pages($args); 



	$cat = array();
	 foreach ($pages as $category) {
	  $cat[] = $category->post_title;
	 }
vc_map( array(
	'name'                      => esc_html__('Services', 'dentalcare'),
	'base'                      => 'dentalcare_services',
	'category'                  => esc_html__('TMC Elements', 'dentalcare'),
	'description'               => esc_html__('Display services Grid', 'dentalcare'),
	'save_always' 				=> true,
	'params'                    => array(
	
		array(
			'type'        => 'textarea',
			'heading'     => esc_html__( 'Heading', 'dentalcare' ),
			'param_name'  => 'first_service_heading',
			'admin_label' => true,
			'value'       => 'Our Clinical',
			'description' => esc_html__('First Service Heading', 'dentalcare')
		),
		array(
			'type'       => 'colorpicker',
			'heading'    => esc_html__('First Heading Color','dentalcare'),
			'param_name' => 'first_heading_color',
			'value'      => '#13304f',
		
		),

		array(
			'type'        => 'textarea',
			'heading'     => esc_html__( 'Heading', 'dentalcare' ),
			'param_name'  => 'second_service_heading',
			'admin_label' => true,
			'value'       => 'Services',
			'description' => esc_html__('Second Service heading', 'dentalcare')
		),

		array(
			'type'       => 'colorpicker',
			'heading'    => esc_html__('Heading Color','dentalcare'),
			'param_name' => 'second_heading_color',
			'value'      => '#1f6bbe',
			

		),
		
		array(
			'type'        => 'textarea',
			'heading'     => esc_html__( 'Description', 'dentalcare' ),
			'param_name'  => 'service_description',
			'admin_label' => true,
			'value'       => 'Totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi',
			'description' => esc_html__('Service Description', 'dentalcare')
		),
		array(
		   'type'        => 'dropdown',
		   'heading'     => esc_html__( 'Display Mode', 'dentalcare' ),
		   'param_name'  => 'layout',
		   'description' => esc_html__( 'The layout your page children being display', 'dentalcare' ),
		   'value'       => array(
			esc_html__('Style One', 'dentalcare')     => 'style_one',
			esc_html__('Style Two', 'dentalcare') => 'style_two'
		   )
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Order', 'dentalcare' ),
			'param_name'  => 'order',
			'description' => esc_html__( 'Ascending or descending order', 'dentalcare' ),
			'default'	  => 'DESC',
			'value'       => array(
				esc_html__('DESC', 'dentalcare') => 'DESC',
				esc_html__('ASC', 'dentalcare') => 'ASC'
			)
		),

		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Orderby', 'dentalcare' ),
			'param_name'  => 'orderby',
			'description' => esc_html__( 'Sort retrieved posts/pages by parameter', 'dentalcare' ),
			'default'	  => 'none',
			'value'       => array(
				esc_html__('None', 'dentalcare')       => 'none',
				esc_html__('ID', 'dentalcare')         => 'ID',
				esc_html__('Title', 'dentalcare')      => 'title',
				esc_html__('Name', 'dentalcare')       => 'name',
				esc_html__('Random', 'dentalcare')     => 'rand',
				esc_html__('Date', 'dentalcare')       => 'date',
				esc_html__('Page Order', 'dentalcare') => 'menu_order'
			)
		),
		
		array(
			'type'			=> 'textfield',
			'class'			=> '',
			'heading'		=> esc_html__('Number of posts','dentalcare'),
			'param_name'	=> 'number',
			'value'			=> '9',
			'description' 	=> 'How many post to show?',
		),
		array(
			'type'			=> 'textfield',
			'class'			=> '',
			'heading'		=> esc_html__('VIEW ALL SERVICES','dentalcare'),
			'param_name'	=> 'all_service_text',
			'value'			=> 'VIEW ALL SERVICES',
			'description' 	=> 'Custom your view all service text, e.g. View All Services, View Profile ..',
		),
		array(
		   'type'        => 'dropdown',
		   'heading'     => esc_html__( 'View All Services Link', 'dentalcare' ),
		   'param_name'  => 'pages',
		   'description' => esc_html__( 'Pages List', 'dentalcare' ),
		   'default'   => '',
		   'value'       => $cat
		),
		array(
			'type'			=> 'textfield',
			'class'			=> '',
			'heading'		=> esc_html__('Read more','dentalcare'),
			'param_name'	=> 'readmore_text',
			'value'			=> 'Read more...',
			'description' 	=> 'Custom your view all service text, e.g. Read more, View Profile ..',
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Extra class name', 'dentalcare' ),
			'param_name'  => 'el_class',
			'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'dentalcare' )
		)
	),
) );

/*------------------------------------------------------*/
/* Home About Us
/*------------------------------------------------------*/
$page_ids = get_all_page_ids();
$pages = array();
for ( $i = 0; $i < count($page_ids); $i++ )
{
	$pages[get_the_title($page_ids[$i])] = $page_ids[$i];
}

vc_map( array(
	'name'                      => esc_html__('About Us', 'dentalcare'),
	'base'                      => 'dentalcare_about_us',
	'category'                  => esc_html__('TMC Elements', 'dentalcare'),
	'description'               => esc_html__('Display About Us', 'dentalcare'),
	'save_always' 				=> true,
	'params'                    => array(
		
		array(
			'type'     => 'attach_image',
			'param_name' => 'main_image',
			'heading'     => esc_html__( 'Main Image', 'dentalcare' ),		
		),
		array(
			'type'     => 'attach_image',
			'param_name' => 'responsive_image',
			'heading'     => esc_html__( 'Responsive Image', 'dentalcare' ),		
		),
		array(
			'type'        => 'textarea',
			'heading'     => esc_html__( 'Heading', 'dentalcare' ),
			'param_name'  => 'about_heading',
			'admin_label' => true,
			'value'       => 'Why Choose',
			'description' => esc_html__('Heading', 'dentalcare')
		),
		array(
			'type'        => 'textarea',
			'heading'     => esc_html__( 'Heading Two', 'dentalcare' ),
			'param_name'  => 'about_heading_two',
			'admin_label' => true,
			'value'       => 'Us',
			'description' => esc_html__('Custom heading, allow simple HTML code.', 'dentalcare')
		),
		array(
			'type'        => 'textarea',
			'heading'     => esc_html__( 'Description', 'dentalcare' ),
			'param_name'  => 'about_description',
			'admin_label' => true,
			'value'       => 'Totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi uia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi',
			'description' => esc_html__('Description', 'dentalcare')
		),
		array(
			'type'     => 'attach_image',
			'param_name' => 'first_sub_image',
			'heading'     => esc_html__( 'First Sub Image', 'dentalcare' ),	
		),
		array(
			'type'        => 'vc_link',
			'heading'     => esc_html__( 'Heading Text & Link', 'dentalcare' ),
			'param_name'  => 'first_sub_heading',
			'description' => esc_html__('First Sub heading', 'dentalcare')
		),
		array(
			'type'     => 'attach_image',
			'param_name' => 'second_sub_image',
			'heading'     => esc_html__( 'Second Sub Image', 'dentalcare' ),
			'default'  => array( 'url' => get_template_directory_uri() . '/assets/images/feature/feature_2.png' ),		
		),
		array(
			'type'        => 'vc_link',
			'heading'     => esc_html__( 'Second Sub Heading Text & Link', 'dentalcare' ),
			'param_name'  => 'second_sub_heading',
			'description' => esc_html__('Second Sub heading', 'dentalcare')
		),
		array(
			'type'     => 'attach_image',
			'param_name' => 'third_sub_image',
			'heading'     => esc_html__( 'Third Sub Image', 'dentalcare' ),
			'default'  => array( 'url' => get_template_directory_uri() . '/assets/images/feature/feature_3.png' ),		
		),
		array(
			'type'        => 'vc_link',
			'heading'     => esc_html__( 'Third Sub Heading Text & Link', 'dentalcare' ),
			'param_name'  => 'third_sub_heading',
			'description' => esc_html__('Thrid Sub heading', 'dentalcare')
		),
		array(
			'type'     => 'attach_image',
			'param_name' => 'fourth_sub_image',
			'heading'     => esc_html__( 'Fourth Sub Image', 'dentalcare' ),
			'default'  => array( 'url' => get_template_directory_uri() . '/assets/images/feature/feature_4.png' ),		
		),
		array(
			'type'        => 'vc_link',
			'heading'     => esc_html__( 'Fourth Sub Heading Text & Link', 'dentalcare' ),
			'param_name'  => 'fourth_sub_heading',
			'description' => esc_html__('Fourth Sub heading', 'dentalcare')
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Extra class name', 'dentalcare' ),
			'param_name'  => 'el_class',
			'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'dentalcare' )
		)
	),
) );

/* Home Our Team.. */

vc_map( array(
	'name'                      => esc_html__('Home Our Team', 'dentalcare'),
	'base'                      => 'dentalcare_home_our_team',
	'category'                  => esc_html__('TMC Elements', 'dentalcare'),
	'description'               => esc_html__('Display Team', 'dentalcare'),
	'save_always' 				=> true,
	'params'                    => array(

		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Order', 'dentalcare' ),
			'param_name'  => 'order',
			'description' => esc_html__( 'Ascending or descending order', 'dentalcare' ),
			'default'	  => 'DESC',
			'value'       => array(
				esc_html__('DESC', 'dentalcare') => 'DESC',
				esc_html__('ASC', 'dentalcare') => 'ASC'
			)
		),
		array(
			'type'			=> 'textfield',
			'class'			=> '',
			'heading'		=> esc_html__('Number of posts','dentalcare'),
			'param_name'	=> 'number',
			'value'			=> '6',
			'description' 	=> 'How many post to show?',
		),
		array(
			'type'        => 'textarea',
			'heading'     => esc_html__( 'Heading One', 'dentalcare' ),
			'param_name'  => 'heading',
			'admin_label' => true,
			'value'       => 'Our Doctor',
			'description' => esc_html__('Custom heading, allow simple HTML code.', 'dentalcare')
		),
		array(
			'type'        => 'textarea',
			'heading'     => esc_html__( 'Heading Two', 'dentalcare' ),
			'param_name'  => 'heading_two',
			'admin_label' => true,
			'value'       => 'Team',
			'description' => esc_html__('Custom heading, allow simple HTML code.', 'dentalcare')
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Extra class name', 'dentalcare' ),
			'param_name'  => 'el_class',
			'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'dentalcare' )
		)
	),
) );

/* Home Gallery.. */

vc_map( array(
	'name'                      => esc_html__('Home Gallery', 'dentalcare'),
	'base'                      => 'dentalcare_home_our_gallery',
	'category'                  => esc_html__('TMC Elements', 'dentalcare'),
	'description'               => esc_html__('Display Home Gallery', 'dentalcare'),
	'save_always' 				=> true,
	'params'                    => array(

		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Order', 'dentalcare' ),
			'param_name'  => 'order',
			'description' => esc_html__( 'Ascending or descending order', 'dentalcare' ),
			'default'	  => 'DESC',
			'value'       => array(
				esc_html__('DESC', 'dentalcare') => 'DESC',
				esc_html__('ASC', 'dentalcare') => 'ASC'
			)
		),
		array(
			'type'			=> 'textfield',
			'class'			=> '',
			'heading'		=> esc_html__('Number of posts','dentalcare'),
			'param_name'	=> 'number',
			'value'			=> '9',
			'description' 	=> 'How many post to show?',
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Extra class name', 'dentalcare' ),
			'param_name'  => 'el_class',
			'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'dentalcare' )
		)
	),
) );

/* Testimonials.. */

vc_map( array(
	'name'                      => esc_html__('Testimonials', 'dentalcare'),
	'base'                      => 'dentalcare_testimonial',
	'category'                  => esc_html__('TMC Elements', 'dentalcare'),
	'description'               => esc_html__('Display Testimonials', 'dentalcare'),
	'save_always' 				=> true,
	'params'                    => array(

		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Order', 'dentalcare' ),
			'param_name'  => 'order',
			'description' => esc_html__( 'Ascending or descending order', 'dentalcare' ),
			'default'	  => 'DESC',
			'value'       => array(
				esc_html__('DESC', 'dentalcare') => 'DESC',
				esc_html__('ASC', 'dentalcare') => 'ASC'
			)
		),
		array(
			'type'        => 'textarea',
			'heading'     => esc_html__( 'Heading One', 'dentalcare' ),
			'param_name'  => 'heading',
			'admin_label' => true,
			'value'       => 'What Our',
			'description' => esc_html__('Heading', 'dentalcare')
		),
		array(
			'type'       => 'colorpicker',
			'heading'    => esc_html__('Heading Color','dentalcare'),
			'param_name' => 'heading_color',
			'value'      => '#13304f',
		
		),
		array(
			'type'        => 'textarea',
			'heading'     => esc_html__( 'Heading Two', 'dentalcare' ),
			'param_name'  => 'heading_two',
			'admin_label' => true,
			'value'       => 'Patient Say',
			'description' => esc_html__('Heading', 'dentalcare')
		),
		array(
			'type'       => 'colorpicker',
			'heading'    => esc_html__('Heading Color','dentalcare'),
			'param_name' => 'heading_color_two',
			'value'      => '#1f6bbe',
		
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Extra class name', 'dentalcare' ),
			'param_name'  => 'el_class',
			'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'dentalcare' )
		)
	),
) );

/* Latest News.. */

	$args = array(
	 'sort_order' => 'asc',
	 'sort_column' => 'post_title',
	 'hierarchical' => 1,
	 'exclude' => '',
	 'meta_key' => '',
	 'meta_value' => '',
	 'authors' => '',
	 'child_of' => 0,
	 'parent' => -1,
	 'exclude_tree' => '',
	 'number' => '',
	 'offset' => 0,
	 'post_type' => 'page',
	 'post_status' => 'publish'
	); 
	$pages = get_pages($args); 



	$cat = array();
	 foreach ($pages as $category) {
	  $cat[] = $category->post_title;
	 }

vc_map( array(
	'name'                      => esc_html__('Latest News', 'dentalcare'),
	'base'                      => 'dentalcare_latest_news',
	'category'                  => esc_html__('TMC Elements', 'dentalcare'),
	'description'               => esc_html__('Display Latest News', 'dentalcare'),
	'save_always' 				=> true,
	'params'                    => array(

		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Order', 'dentalcare' ),
			'param_name'  => 'order',
			'description' => esc_html__( 'Ascending or descending order', 'dentalcare' ),
			'default'	  => 'DESC',
			'value'       => array(
				esc_html__('DESC', 'dentalcare') => 'DESC',
				esc_html__('ASC', 'dentalcare') => 'ASC'
			)
		),
		array(
			'type'        => 'textarea',
			'heading'     => esc_html__( 'Heading One', 'dentalcare' ),
			'param_name'  => 'heading',
			'admin_label' => true,
			'value'       => 'Latest ',
			'description' => esc_html__('Heading One', 'dentalcare')
		),
		array(
			'type'        => 'textarea',
			'heading'     => esc_html__( 'Heading Two', 'dentalcare' ),
			'param_name'  => 'heading_two',
			'admin_label' => true,
			'value'       => 'News',
			'description' => esc_html__('Heading Two', 'dentalcare')
		),
		array(
			'type'			=> 'textfield',
			'class'			=> '',
			'heading'		=> esc_html__('Read More text','dentalcare'),
			'param_name'	=> 'readmore_text',
			'value'			=> 'Read More',
			'description' 	=> 'Custom your read more text, e.g. Read More, View Profile ...',
		),
		array(
			'type'			=> 'textfield',
			'class'			=> '',
			'heading'		=> esc_html__('Read All News text','dentalcare'),
			'param_name'	=> 'readallnews_text',
			'value'			=> 'Read All News',
			'description' 	=> 'Custom your read all news text, e.g. Read All News, View Profile ...',
		),
		array(
		   'type'        => 'dropdown',
		   'heading'     => esc_html__( 'Pages', 'dentalcare' ),
		   'param_name'  => 'pages',
		   'description' => esc_html__( 'Read All News link', 'dentalcare' ),
		   'default'   => 382,
		   'value'       => $cat
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Extra class name', 'dentalcare' ),
			'param_name'  => 'el_class',
			'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'dentalcare' )
		)
	),
) );

/* Home Get In Touch.. */

vc_map( array(
	'name'                      => esc_html__('Get In Touch', 'dentalcare'),
	'base'                      => 'dentalcare_get_in_touch',
	'category'                  => esc_html__('TMC Elements', 'dentalcare'),
	'description'               => esc_html__('Display Get In Touch', 'dentalcare'),
	'save_always' 				=> true,
	'params'                    => array(

		array(
			'type'     => 'attach_image',
			'param_name' => 'main_image',
			'heading'     => esc_html__( 'Main Image', 'dentalcare' ),		
		),
		array(
			'type'        => 'textarea',
			'heading'     => esc_html__( 'Heading One', 'dentalcare' ),
			'param_name'  => 'heading_one',
			'admin_label' => true,
			'value'       => 'Get In',
			'description' => esc_html__('Heading One', 'dentalcare')
		),
		array(
			'type'        => 'textarea',
			'heading'     => esc_html__( 'Heading Two', 'dentalcare' ),
			'param_name'  => 'heading_two',
			'admin_label' => true,
			'value'       => 'Touch',
			'description' => esc_html__('Heading Two', 'dentalcare')
		),
		array(
			'type'        => 'textarea',
			'heading'     => esc_html__( 'address', 'dentalcare' ),
			'param_name'  => 'get_address',
			'admin_label' => true,
			'value'       => 'Wood Workshop, 562, Mallin Street New Youk, NY 100 254',
			'description' => esc_html__('Address', 'dentalcare')
		),
		array(
			'type'        => 'textarea',
			'heading'     => esc_html__( 'Email Address', 'dentalcare' ),
			'param_name'  => 'email_address_one',
			'admin_label' => true,
			'value'       => 'info@dentalcare.com',
			'description' => esc_html__('Email Address', 'dentalcare')
		),
		array(
			'type'        => 'textarea',
			'heading'     => esc_html__( 'Email Address', 'dentalcare' ),
			'param_name'  => 'email_address_two',
			'admin_label' => true,
			'value'       => 'support@dentalcare.com',
			'description' => esc_html__('Email Address', 'dentalcare')
		),
		array(
			'type'        => 'textarea',
			'heading'     => esc_html__( 'Contact Number', 'dentalcare' ),
			'param_name'  => 'contact_number_one',
			'admin_label' => true,
			'value'       => '+ 1800 562 2487',
			'description' => esc_html__('Contact Number', 'dentalcare')
		),
		array(
			'type'        => 'textarea',
			'heading'     => esc_html__( 'Contact Number', 'dentalcare' ),
			'param_name'  => 'contact_number_two',
			'admin_label' => true,
			'value'       => '+ 3215 546 8975',
			'description' => esc_html__('Contact Number', 'dentalcare')
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Extra class name', 'dentalcare' ),
			'param_name'  => 'el_class',
			'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'dentalcare' )
		)
	),
) );

/*------------------------------------------------------*/
/* Team Listing
/*------------------------------------------------------*/

vc_map( array(
	'name'                      => esc_html__('Team Listing', 'dentalcare'),
	'base'                      => 'dentalcare_team_listing',
	'category'                  => esc_html__('TMC Team Listing', 'dentalcare'),
	'description'               => esc_html__('Display Team listing', 'dentalcare'),
	'save_always' 				=> true,
	'params'                    => array(

		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Order', 'dentalcare' ),
			'param_name'  => 'order',
			'description' => esc_html__( 'Ascending or descending order', 'dentalcare' ),
			'default'	  => 'DESC',
			'value'       => array(
				esc_html__('DESC', 'dentalcare') => 'DESC',
				esc_html__('ASC', 'dentalcare') => 'ASC'
			)
		),

		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Orderby', 'dentalcare' ),
			'param_name'  => 'orderby',
			'description' => esc_html__( 'Sort retrieved posts/pages by parameter', 'dentalcare' ),
			'default'	  => 'none',
			'value'       => array(
				esc_html__('None', 'dentalcare')       => 'none',
				esc_html__('ID', 'dentalcare')         => 'ID',
				esc_html__('Title', 'dentalcare')      => 'title',
				esc_html__('Name', 'dentalcare')       => 'name',
				esc_html__('Random', 'dentalcare')     => 'rand',
				esc_html__('Date', 'dentalcare')       => 'date',
				esc_html__('Page Order', 'dentalcare') => 'menu_order'
			)
		),
		array(
			'type'			=> 'textfield',
			'class'			=> '',
			'heading'		=> esc_html__('Number of posts','dentalcare'),
			'param_name'	=> 'number',
			'value'			=> '9',
			'description' 	=> 'How many post to show?',
		),
		array(
		   'type'        => 'dropdown',
		   'heading'     => esc_html__( 'Display Mode', 'dentalcare' ),
		   'param_name'  => 'layout',
		   'description' => esc_html__( 'The layout your page children being display', 'dentalcare' ),
		   'value'       => array(
			esc_html__('Grid', 'dentalcare')     => 'grid',
			esc_html__('Carousel', 'dentalcare') => 'carousel'
		   )
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Column', 'dentalcare' ),
			'param_name'  => 'column',
			'description' => esc_html__( 'How many column will be display on a row?', 'dentalcare' ),
			'default'	  => '3',
			'value'       => array(
				esc_html__('2 Columns', 'dentalcare') => '2',
				esc_html__('3 Columns', 'dentalcare') => '3',
				esc_html__('4 Columns', 'dentalcare') => '4'
			)
		),

		array(
			'type'			=> 'textfield',
			'class'			=> '',
			'heading'		=> esc_html__('more info text','dentalcare'),
			'param_name'	=> 'readmore_text',
			'value'			=> 'more info',
			'description' 	=> 'Custom your more info text, e.g. more info, View Profile ...',
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Extra class name', 'dentalcare' ),
			'param_name'  => 'el_class',
			'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'dentalcare' )
		)
	),
) );

/*------------------------------------------------------*/
/* BROCHURE DOWNLOAD BUTTON
/*------------------------------------------------------*/

vc_map( array(

	'name'                      => esc_html__('Brocher Download Button', 'dentalcare'),
	'base'                      => 'dentalcare_brochure_button',
	'category'                  => esc_html__('TMC Elements', 'dentalcare'),
	'description'               => esc_html__('Display Download Button', 'dentalcare'),
	'save_always'     => true,
	'params'                    => array(
		
		array(
		   'type'        => 'textfield',
		   'heading'     => esc_html__( 'Text on the button', 'dentalcare' ),
		   'holder'      => 'button',
		   'class'       => 'wpb_button',
		   'param_name'  => 'btntitle',
		   'value'       => esc_html__( 'Text on the button', 'dentalcare' ),
		   'description' => esc_html__( 'Text on the button.', 'dentalcare' )
		  ),
	    array(
		   'type'        => 'attach_image',
		   'heading'     => esc_html__( 'File URL (Link)', 'dentalcare' ),
		   'param_name'  => 'btnlink',
		   'description' => esc_html__( 'Select the file to be downloaded.', 'dentalcare' )
		  )
	    
	 ),
) );

/*------------------------------------------------------*/
/* Team Member Info
/*------------------------------------------------------*/

vc_map( array(

	'name'                      => esc_html__('Team Member Info', 'dentalcare'),
	'base'                      => 'dentalcare_member_info',
	'category'                  => esc_html__('TMC Elements', 'dentalcare'),
	'description'               => esc_html__('Display Download Button', 'dentalcare'),
	'save_always'     => true,
	'params'                    => array(
		
		array(
			'type'			=> 'textfield',
			'class'			=> '',
			'heading'		=> esc_html__('Email Title Text','dentalcare'),
			'param_name'	=> 'emial_text',
			'value'			=> 'or send an email',
	    ),
	    array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Extra class name', 'dentalcare' ),
			'param_name'  => 'el_class',
			'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'dentalcare' )
		)
	 ),
) );

/*------------------------------------------------------*/
/* Services Listing
/*------------------------------------------------------*/

vc_map( array(
	'name'                      => esc_html__('Services Listing', 'dentalcare'),
	'base'                      => 'dentalcare_services_listing',
	'category'                  => esc_html__('TMC Services Listing', 'dentalcare'),
	'description'               => esc_html__('Display Services Listing', 'dentalcare'),
	'save_always' 				=> true,
	'params'                    => array(

		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Order', 'dentalcare' ),
			'param_name'  => 'order',
			'description' => esc_html__( 'Ascending or descending order', 'dentalcare' ),
			'default'	  => 'DESC',
			'value'       => array(
				esc_html__('DESC', 'dentalcare') => 'DESC',
				esc_html__('ASC', 'dentalcare') => 'ASC'
			)
		),

		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Orderby', 'dentalcare' ),
			'param_name'  => 'orderby',
			'description' => esc_html__( 'Sort retrieved posts/pages by parameter', 'dentalcare' ),
			'default'	  => 'none',
			'value'       => array(
				esc_html__('None', 'dentalcare')       => 'none',
				esc_html__('ID', 'dentalcare')         => 'ID',
				esc_html__('Title', 'dentalcare')      => 'title',
				esc_html__('Name', 'dentalcare')       => 'name',
				esc_html__('Random', 'dentalcare')     => 'rand',
				esc_html__('Date', 'dentalcare')       => 'date',
				esc_html__('Page Order', 'dentalcare') => 'menu_order'
			)
		),
		array(
		   'type'        => 'dropdown',
		   'heading'     => esc_html__( 'Display Mode', 'dentalcare' ),
		   'param_name'  => 'layout',
		   'description' => esc_html__( 'The layout your page children being display', 'dentalcare' ),
		   'value'       => array(
			esc_html__('Grid', 'dentalcare')     => 'grid',
			esc_html__('Carousel', 'dentalcare') => 'carousel'
		   )
		),
		array(
			'type'			=> 'textfield',
			'class'			=> '',
			'heading'		=> esc_html__('Number of posts','dentalcare'),
			'param_name'	=> 'number',
			'value'			=> '9',
			'description' 	=> 'How many post to show?',
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Column', 'dentalcare' ),
			'param_name'  => 'column',
			'description' => esc_html__( 'How many column will be display on a row?', 'dentalcare' ),
			'default'	  => '3',
			'value'       => array(
				esc_html__('2 Columns', 'dentalcare') => '2',
				esc_html__('3 Columns', 'dentalcare') => '3',
				esc_html__('4 Columns', 'dentalcare') => '4'
			)
		),

		array(
			'type'			=> 'textfield',
			'class'			=> '',
			'heading'		=> esc_html__('Read more text','dentalcare'),
			'param_name'	=> 'readmore_text',
			'value'			=> 'Read more',
			'description' 	=> 'Custom your Read more text, e.g. Read more, View Profile ...',
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Extra class name', 'dentalcare' ),
			'param_name'  => 'el_class',
			'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'dentalcare' )
		)
	),
) );

/*------------------------------------------------------*/
/* Doctors Gallery
/*------------------------------------------------------*/

	$args = array(
		 'sort_order' => 'asc',
		 'sort_column' => 'post_title',
		 'hierarchical' => 1,
		 'exclude' => '',
		 'meta_key' => '',
		 'meta_value' => '',
		 'authors' => '',
		 'child_of' => 0,
		 'parent' => -1,
		 'exclude_tree' => '',
		 'number' => '',
		 'offset' => 0,
		 'post_type' => 'page',
		 'post_status' => 'publish'
		); 
		$pages = get_pages($args); 

		$cat = array();
		foreach ($pages as $category) {
		  $cat[] = $category->post_title;
		}

vc_map( array(
	'name'                      => esc_html__('Doctors Gallery', 'dentalcare'),
	'base'                      => 'dentalcare_doctors_gallery',
	'category'                  => esc_html__('TMC Doctors Gallery', 'dentalcare'),
	'description'               => esc_html__('Display Doctors Gallery', 'dentalcare'),
	'save_always' 				=> true,
	'params'                    => array(

		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Order', 'dentalcare' ),
			'param_name'  => 'order',
			'description' => esc_html__( 'Ascending or descending order', 'dentalcare' ),
			'default'	  => 'DESC',
			'value'       => array(
				esc_html__('DESC', 'dentalcare') => 'DESC',
				esc_html__('ASC', 'dentalcare') => 'ASC'
			)
		),

		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Orderby', 'dentalcare' ),
			'param_name'  => 'orderby',
			'description' => esc_html__( 'Sort retrieved posts/pages by parameter', 'dentalcare' ),
			'default'	  => 'none',
			'value'       => array(
				esc_html__('None', 'dentalcare')       => 'none',
				esc_html__('ID', 'dentalcare')         => 'ID',
				esc_html__('Title', 'dentalcare')      => 'title',
				esc_html__('Name', 'dentalcare')       => 'name',
				esc_html__('Random', 'dentalcare')     => 'rand',
				esc_html__('Date', 'dentalcare')       => 'date',
				esc_html__('Page Order', 'dentalcare') => 'menu_order'
			)
		),
		array(
			'type'			=> 'textfield',
			'class'			=> '',
			'heading'		=> esc_html__('Number of posts','dentalcare'),
			'param_name'	=> 'number',
			'value'			=> '9',
			'description' 	=> 'How many post to show?',
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Column', 'dentalcare' ),
			'param_name'  => 'column',
			'description' => esc_html__( 'How many column will be display on a row?', 'dentalcare' ),
			'default'	  => '3',
			'value'       => array(
				esc_html__('2 Columns', 'dentalcare') => '2',
				esc_html__('3 Columns', 'dentalcare') => '3',
				esc_html__('4 Columns', 'dentalcare') => '4'
			)
		),
		array(
			'type'			=> 'textfield',
			'class'			=> '',
			'heading'		=> esc_html__('Appointment','dentalcare'),
			'param_name'	=> 'appointment_text',
			'value'			=> 'Appointment',
			'description' 	=> 'Custom your Appointment text, e.g. Appointment, View Profile ..',
		),
		array(
		   'type'        => 'dropdown',
		   'heading'     => esc_html__( 'Appointment Link', 'dentalcare' ),
		   'param_name'  => 'pages',
		   'description' => esc_html__( 'Pages List', 'dentalcare' ),
		   'default'   => '',
		   'value'       => $cat
		),
		array(
			'type'			=> 'textfield',
			'class'			=> '',
			'heading'		=> esc_html__('more info text','dentalcare'),
			'param_name'	=> 'readmore_text',
			'value'			=> 'more info',
			'description' 	=> 'Custom your more info text, e.g. more info, View Profile ...',
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Extra class name', 'dentalcare' ),
			'param_name'  => 'el_class',
			'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'dentalcare' )
		)
	),
) );

/* Contact Get In Touch.. */

vc_map( array(
	'name'                      => esc_html__('Get In Touch', 'dentalcare'),
	'base'                      => 'dentalcare_contact_touch',
	'category'                  => esc_html__('TMC Elements', 'dentalcare'),
	'description'               => esc_html__('Display Contact Get In Touch', 'dentalcare'),
	'save_always' 				=> true,
	'params'                    => array(

		array(
			'type'        => 'textarea',
			'heading'     => esc_html__( 'Heading One', 'dentalcare' ),
			'param_name'  => 'heading_one',
			'admin_label' => true,
			'value'       => 'Get In',
			'description' => esc_html__('Heading One', 'dentalcare')
		),
		array(
			'type'        => 'textarea',
			'heading'     => esc_html__( 'Heading Two', 'dentalcare' ),
			'param_name'  => 'heading_two',
			'admin_label' => true,
			'value'       => 'Touch',
			'description' => esc_html__('Heading Two', 'dentalcare')
		),
		array(
			'type'        => 'textarea',
			'heading'     => esc_html__( 'address', 'dentalcare' ),
			'param_name'  => 'get_address',
			'admin_label' => true,
			'value'       => 'Wood Workshop, 562, Mallin Street New Youk, NY 100 254',
			'description' => esc_html__('Address', 'dentalcare')
		),
		array(
			'type'        => 'textarea',
			'heading'     => esc_html__( 'Email Address', 'dentalcare' ),
			'param_name'  => 'email_address_one',
			'admin_label' => true,
			'value'       => 'info@dentalcare.com',
			'description' => esc_html__('Email Address', 'dentalcare')
		),
		array(
			'type'        => 'textarea',
			'heading'     => esc_html__( 'Email Address', 'dentalcare' ),
			'param_name'  => 'email_address_two',
			'admin_label' => true,
			'value'       => 'support@dentalcare.com',
			'description' => esc_html__('Email Address', 'dentalcare')
		),
		array(
			'type'        => 'textarea',
			'heading'     => esc_html__( 'Contact Number', 'dentalcare' ),
			'param_name'  => 'contact_number_one',
			'admin_label' => true,
			'value'       => '+ 1800 562 2487',
			'description' => esc_html__('Contact Number', 'dentalcare')
		),
		array(
			'type'        => 'textarea',
			'heading'     => esc_html__( 'Contact Number', 'dentalcare' ),
			'param_name'  => 'contact_number_two',
			'admin_label' => true,
			'value'       => '+ 3215 546 8975',
			'description' => esc_html__('Contact Number', 'dentalcare')
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Extra class name', 'dentalcare' ),
			'param_name'  => 'el_class',
			'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'dentalcare' )
		)
	),
) );

/*------------------------------------------------------*/
/* Home Two Single Doctor
/*------------------------------------------------------*/

vc_map( array(
	'name'                      => esc_html__('Single Doctor', 'dentalcare'),
	'base'                      => 'dentalcare_single_doctor',
	'category'                  => esc_html__('TMC Elements', 'dentalcare'),
	'description'               => esc_html__('Display Single Doctor', 'dentalcare'),
	'save_always' 				=> true,
	'params'                    => array(
		
		array(
			'type'     => 'attach_image',
			'param_name' => 'doctor_image',
			'heading'     => esc_html__( 'Doctor Image', 'dentalcare' ),		
		),
		array(
			'type'        => 'textarea',
			'heading'     => esc_html__( 'Heading', 'dentalcare' ),
			'param_name'  => 'doctor_heading',
			'admin_label' => true,
			'value'       => 'Meet',
			'description' => esc_html__('Heading', 'dentalcare')
		),
		array(
			'type'        => 'textarea',
			'heading'     => esc_html__( 'Heading Two', 'dentalcare' ),
			'param_name'  => 'doctor_heading_two',
			'admin_label' => true,
			'value'       => 'Dr. Robert',
			'description' => esc_html__('Heading.', 'dentalcare')
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Sub Heading', 'dentalcare' ),
			'param_name'  => 'doctor_sub_heading',
			'value'       => 'Totam rem aperiam, eaque ipsa quae ab illo invent ore veritatis'
		),
		array(
			'type'        => 'textarea',
			'heading'     => esc_html__( 'Description', 'dentalcare' ),
			'param_name'  => 'doctor_description',
			'admin_label' => true,
			'value'       => 'et quasi architecto beatae vitae dict eaque ipsa quae ab.Teritatis et quasi architecto. Sed ut perspi ciatis unde omnis iste natus error sit volu ptatem accusantium dolore mque. Totam rem aperiam, eaque ipsa quae ab illo invent ore veritatis et quasi architecto beatae vitae dict eaque ipsa quae ab.Teritatis et quasi architecto. Sed ut perspi ciatis unde omnis iste natus error sit volu ptatem accusantium dolore mque iste natus error sit volu ptatem accusantium dolore mque. Totam rem aperiam, eaque ipsa quae ab illo invent ore veritatis.',
			'description' => esc_html__('Description', 'dentalcare')
		),
		array(
			'type'     => 'attach_image',
			'param_name' => 'doctor_signature_image',
			'heading'     => esc_html__( 'Doctor Signature', 'dentalcare' ),	
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Extra class name', 'dentalcare' ),
			'param_name'  => 'el_class',
			'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'dentalcare' )
		)
	),
) );

/*------------------------------------------------------*/
/* Single Service Overview
/*------------------------------------------------------*/
$args = array(	 'sort_order' => 'asc',	 'sort_column' => 'post_title',	 'hierarchical' => 1,	 'exclude' => '',	 'meta_key' => '',	 'meta_value' => '',	 'authors' => '',	 'child_of' => 0,	 'parent' => -1,	 'exclude_tree' => '',	 'number' => '',	 'offset' => 0,	 'post_type' => 'services',	 'posts_per_page' => 100,	 'post_status' => 'publish'	); 	$servicePost = get_posts($args); 	$service = array();	 foreach ($servicePost as $category) {	  $service[] = $category->post_title;	 }


vc_map( array(

	'name'                      => esc_html__('Single Service Overview', 'dentalcare'),
	'base'                      => 'dentalcare_service_overview',
	'category'                  => esc_html__('TMC Elements', 'dentalcare'),
	'description'               => esc_html__('Display single service overview', 'dentalcare'),
	'save_always'     => true,
	'params'                    => array(

	   
		array(
		   'type'        => 'dropdown',
		   'heading'     => esc_html__( 'Servce Name', 'dentalcare' ),
		   'param_name'  => 'service_name',
		   'description' => esc_html__( 'Services name List', 'dentalcare' ),
		   'default'   => '',
		   'value'       => $service
		),
		array(
			'type'       => 'colorpicker',
			'heading'    => esc_html__('Background color','dentalcare'),
			'param_name' => 'background_color',
		
		),
		array(
			'type'     => 'attach_image',
			'param_name' => 'background_image',
			'heading'     => esc_html__( 'Background Image', 'dentalcare' ),	
		),
		array(
			'type'			=> 'textfield',
			'class'			=> '',
			'heading'		=> esc_html__('Read more text','dentalcare'),
			'param_name'	=> 'readmore_text',
			'value'			=> 'Read more',
			'description' 	=> 'Custom your Read more info text, e.g. Read more info, Read more ...',
		),
	   array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Extra class name', 'dentalcare' ),
			'param_name'  => 'el_class',
			'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'dentalcare' )
		)
	 ),
) );


/*------------------------------------------------------*/
/* Services Grid
/*------------------------------------------------------*/
$args = array(
	'sort_order' => 'asc',
	'sort_column' => 'post_title',
	'hierarchical' => 1,
	'exclude' => '',
	'meta_key' => '',
	'meta_value' => '',
	'authors' => '',
	'child_of' => 0,
	'parent' => -1,
	'exclude_tree' => '',
	'number' => '',
	'offset' => 0,
	'post_type' => 'page',
	'post_status' => 'publish'
	); 
	$pages = get_pages($args); 

	$servicelink = array();
	foreach ($pages as $category) {
	  $servicelink[] = $category->post_title;
	}
vc_map( array(

	'name'                      => esc_html__('Service Grid', 'dentalcare'),
	'base'                      => 'dentalcare_service_grid',
	'category'                  => esc_html__('TMC Elements', 'dentalcare'),
	'description'               => esc_html__('Display Service Grid', 'dentalcare'),
	'save_always'    			=> true,
	'params'                    => array(

		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Order', 'dentalcare' ),
			'param_name'  => 'order',
			'description' => esc_html__( 'Ascending or descending order', 'dentalcare' ),
			'default'	  => 'DESC',
			'value'       => array(
				esc_html__('DESC', 'dentalcare') => 'DESC',
				esc_html__('ASC', 'dentalcare') => 'ASC'
			)
		),
		array(
			'type'			=> 'textfield',
			'class'			=> '',
			'heading'		=> esc_html__('Number of posts','dentalcare'),
			'param_name'	=> 'number',
			'value'			=> '9',
			'description' 	=> 'How many post to show?',
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Column', 'dentalcare' ),
			'param_name'  => 'column',
			'description' => esc_html__( 'How many column will be display on a row?', 'dentalcare' ),
			'default'	  => '3',
			'value'       => array(
				esc_html__('2 Columns', 'dentalcare') => '2',
				esc_html__('3 Columns', 'dentalcare') => '3',
				esc_html__('4 Columns', 'dentalcare') => '4'
			)
		),
		array(
			'type'        => 'textarea',
			'heading'     => esc_html__( 'Heading', 'dentalcare' ),
			'param_name'  => 'heading',
			'admin_label' => true,
			'value'       => '',
			'description' => esc_html__('Custom heading, allow simple text.', 'dentalcare')
		),
		array(
			'type'       => 'colorpicker',
			'heading'    => esc_html__('Heading Color','dentalcare'),
			'param_name' => 'heading_color',
			'value'      => '#13304f',
		
		),

		array(
			'type'        => 'textarea',
			'heading'     => esc_html__( 'Heading', 'dentalcare' ),
			'param_name'  => 'heading_two',
			'admin_label' => true,
			'value'       => '',
			'description' => esc_html__('Custom heading, allow simple text.', 'dentalcare')
		),

		array(
			'type'       => 'colorpicker',
			'class'      => '',
			'heading'    => esc_html__('Heading Color','dentalcare'),
			'param_name' => 'heading_color_two',
			'value'      => '#2468b4',
			

		),
		array(
			'type'			=> 'textfield',
			'class'			=> '',
			'heading'		=> esc_html__('SERVICES Text','dentalcare'),
			'param_name'	=> 'services_content',
			'value'			=> 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, unde omnis iste natus error sit voluptatem accusantium.',
		),
		array(
			'type'			=> 'textfield',
			'class'			=> '',
			'heading'		=> esc_html__('ALL SERVICES','dentalcare'),
			'param_name'	=> 'allservices_text',
			'value'			=> 'ALL SERVICES',
			'description' 	=> 'Custom your ALL SERVICES text, e.g. ALL SERVICES, View Profile ..',
		),
		array(
		   'type'        => 'dropdown',
		   'heading'     => esc_html__( 'ALL SERVICES Link', 'dentalcare' ),
		   'param_name'  => 'pages',
		   'description' => esc_html__( 'Pages List', 'dentalcare' ),
		   'default'   => '',
		   'value'       => $servicelink
		),
		array(
			'type'			=> 'textfield',
			'class'			=> '',
			'heading'		=> esc_html__('READ MORE text','dentalcare'),
			'param_name'	=> 'readmore_text',
			'value'			=> 'READ MORE',
			'description' 	=> 'Custom your READ MORE  text, e.g. READ MORE, View Profile ...',
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Extra class name', 'dentalcare' ),
			'param_name'  => 'el_class',
			'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'dentalcare' )
		)
	 ),
) );





/*------------------------------------------------------*/
/* Featured details in Home three
/*------------------------------------------------------*/

vc_map( array(
	'name'                      => esc_html__('Featured Details', 'dentalcare'),
	'base'                      => 'dentalcare_featured_detail',
	'category'                  => esc_html__('TMC Elements', 'dentalcare'),
	'description'               => esc_html__('Display Featured Details', 'dentalcare'),
	'save_always' 				=> true,
	'params'                    => array(
		
		array(
			'type'     => 'attach_image',
			'param_name' => 'main_image',
			'heading'     => esc_html__( 'Main Image', 'dentalcare' ),		
		),
		array(
			'type'     => 'attach_image',
			'param_name' => 'responsive_image',
			'heading'     => esc_html__( 'Responsive Image', 'dentalcare' ),		
		),
		array(
			'type'     => 'attach_image',
			'param_name' => 'first_sub_image',
			'heading'     => esc_html__( 'First Sub Image', 'dentalcare' ),	
		),
		array(
			'type'        => 'textarea',
			'heading'     => esc_html__( 'Heading', 'dentalcare' ),
			'param_name'  => 'first_heading',
			'admin_label' => true,
			'value'       => 'Visit dental clinic once in one year'
		),
		array(
			'type'        => 'textarea',
			'heading'     => esc_html__( 'Sub Heading', 'dentalcare' ),
			'param_name'  => 'first_sub_heading',
			'admin_label' => true,
			'value'       => 'doloremque laudantium, unde omnis iste natus error sit atem accusantium Sed ut perspiciatis unde.'
		),
		array(
			'type'     => 'attach_image',
			'param_name' => 'second_sub_image',
			'heading'     => esc_html__( 'Second Sub Image', 'dentalcare' ),
			'default'  => array( 'url' => get_template_directory_uri() . '/assets/images/feature/feature_2.png' ),		
		),
		array(
			'type'        => 'textarea',
			'heading'     => esc_html__( 'Heading', 'dentalcare' ),
			'param_name'  => 'second_heading',
			'admin_label' => true,
			'value'       => 'Visit dental clinic once in one year'
		),
		array(
			'type'        => 'textarea',
			'heading'     => esc_html__( 'Sub Heading', 'dentalcare' ),
			'param_name'  => 'second_sub_heading',
			'admin_label' => true,
			'value'       => 'doloremque laudantium, unde omnis iste natus error sit atem accusantium Sed ut perspiciatis unde.'
		),
		array(
			'type'     => 'attach_image',
			'param_name' => 'third_sub_image',
			'heading'     => esc_html__( 'Third Sub Image', 'dentalcare' ),
			'default'  => array( 'url' => get_template_directory_uri() . '/assets/images/feature/feature_3.png' ),		
		),
		array(
			'type'        => 'textarea',
			'heading'     => esc_html__( 'Heading', 'dentalcare' ),
			'param_name'  => 'third_heading',
			'admin_label' => true,
			'value'       => 'Visit dental clinic once in one year'
		),
		array(
			'type'        => 'textarea',
			'heading'     => esc_html__( 'Sub Heading', 'dentalcare' ),
			'param_name'  => 'third_sub_heading',
			'admin_label' => true,
			'value'       => 'doloremque laudantium, unde omnis iste natus error sit atem accusantium Sed ut perspiciatis unde.'
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Extra class name', 'dentalcare' ),
			'param_name'  => 'el_class',
			'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'dentalcare' )
		)
	),
) );

/* Clients.. */

vc_map( array(
	'name'                      => esc_html__('Dentalcare Clients', 'dentalcare'),
	'base'                      => 'dentalcare_clients',
	'category'                  => esc_html__('Dentalcare Elements', 'dentalcare'),
	'description'               => esc_html__('Display Clients', 'dentalcare'),
	'save_always' 				=> true,
	'params'                    => array(

		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Order', 'dentalcare' ),
			'param_name'  => 'order',
			'description' => esc_html__( 'Ascending or descending order', 'dentalcare' ),
			'default'	  => 'DESC',
			'value'       => array(
				esc_html__('DESC', 'dentalcare') => 'DESC',
				esc_html__('ASC', 'dentalcare') => 'ASC'
			)
		),
		array(
			'type'			=> 'textfield',
			'class'			=> '',
			'heading'		=> esc_html__('Number of posts','dentalcare'),
			'param_name'	=> 'number',
			'value'			=> '9',
			'description' 	=> 'How many post to show?',
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Extra class name', 'dentalcare' ),
			'param_name'  => 'el_class',
			'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'dentalcare' )
		)
	),
) );
		
}	
}

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {


	class WPBakeryShortCode_DENTALCARE_Animation_Block extends WPBakeryShortCodesContainer {
	}

	class WPBakeryShortCode_DENTALCARE_Gmap extends WPBakeryShortCodesContainer {
	}
}

if ( class_exists( 'WPBakeryShortCode' ) ) {

	class WPBakeryShortCode_DENTALCARE_Contacts_Widget extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_DENTALCARE_Info_Box extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_DENTALCARE_Icon_Box extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_DENTALCARE_Posts extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_DENTALCARE_Contact extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_DENTALCARE_Sidebar extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_DENTALCARE_Gmap_Address extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_DENTALCARE_Post_Bottom extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_DENTALCARE_Post_About_Author extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_DENTALCARE_Post_Comments extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_DENTALCARE_Charts extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_DENTALCARE_Spacing extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_DENTALCARE_Custom_Heading extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_DENTALCARE_Services extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_DENTALCARE_About_Us extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_DENTALCARE_Home_Our_Team extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_DENTALCARE_Home_Our_Gallery extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_DENTALCARE_Testimonial extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_DENTALCARE_Latest_News extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_DENTALCARE_Get_In_Touch extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_DENTALCARE_Team_Listing extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_DENTALCARE_Brochure_Button extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_DENTALCARE_Member_Info extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_DENTALCARE_Services_Listing extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_DENTALCARE_Doctors_Gallery extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_DENTALCARE_Contact_Touch extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_DENTALCARE_Single_Doctor extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_DENTALCARE_Service_Overview extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_DENTALCARE_Featured_Detail extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_DENTALCARE_Clients extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_DENTALCARE_Service_Grid extends WPBakeryShortCode {
	}
	
}
