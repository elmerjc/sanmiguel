<?php
/*
Plugin Name: TMC Post Type
Plugin URI:
Description: TMC Post Type
Author:
Author URI:
Text Domain: dentalcare_post_type
Version: 2.0
*/

define( 'TMC_POST_TYPE', 'tmc_post_type' );
function custom_post_type_init() {

	
$options_meta = get_option('tmc_post_types_options');

$tmcPostTypesOptions = array(

	'gallery' => array(
		'title' => __( 'Gallery', TMC_POST_TYPE ),
		'rewrite' => 'gallery'
	),
	
	'services' => array(
		'title' => __( 'Services', TMC_POST_TYPE ),
		'rewrite' => 'services'
	),
		
	'team' => array(
		'title' => __( 'Team', TMC_POST_TYPE ),
		'rewrite' => 'team'
	),
		
	'testimonials' => array(
		'title' => __( 'Testimonials', TMC_POST_TYPE ),
		'rewrite' => 'testimonials'
	),
	
	'clients' => array(
		'title' => __( 'Clients', TMC_POST_TYPE ),
		'rewrite' => 'clients'
	),
		
);

$tmc_post_types_options = wp_parse_args( $options_meta, $tmcPostTypesOptions );

  register_post_type(
    'sidebar', array(
      'labels' => array('name' => __( 'Sidebar' ),
	  'singular_name' => __( 'sidebar' ) ),
      'public' => true,
	  'menu_icon' => 'dashicons-schedule',
      'supports' => array( 'title', 'editor' ), 
	  'exclude_from_search' => true, 
	  'publicly_queryable' => false 
    )
  );
 
  register_post_type(
    'gallery', array(
      'labels' => array('name' => $tmc_post_types_options['gallery']['title'],
	  'singular_name' => __( 'gallery' ) ),
      'public' => true,
	  'menu_icon' => 'dashicons-portfolio',
      'has_archive' => true,
      'supports' => array('title', 'editor', 'thumbnail', 'comments', 'excerpt'),
	  'rewrite' => array( 'slug' => $tmc_post_types_options['gallery']['rewrite'] ),
    )
  );
  
  register_post_type(
    'services', array(
      'labels' => array('name' => $tmc_post_types_options['services']['title'],
	  'singular_name' => __( 'services' ) ),
      'public' => true,
	  'menu_icon' => 'dashicons-portfolio',
      'has_archive' => true,
      'supports' => array('title', 'editor', 'thumbnail', 'comments', 'excerpt'),
	  'rewrite' => array( 'slug' => $tmc_post_types_options['services']['rewrite'] ),
    )
  );
  
   register_post_type(
    'team', array(
      'labels' => array('name' => $tmc_post_types_options['team']['title'],
	  'singular_name' => __( 'team' ) ),
      'public' => true,
	  'menu_icon' => 'dashicons-groups',
      'has_archive' => true,
      'supports' => array('title', 'editor', 'thumbnail', 'comments', 'excerpt'),
	  'rewrite' => array( 'slug' => $tmc_post_types_options['team']['rewrite'] ),
    )
  );
   

   register_post_type(
    'testimonials', array(
      'labels' => array('name' => $tmc_post_types_options['testimonials']['title'],
	  'singular_name' => __( 'testimonials' ) ),
      'public' => true,
	  'menu_icon' => 'dashicons-testimonial',
      'has_archive' => true,
      'supports' => array( 'title', 'editor', 'thumbnail', 'comments', 'excerpt' ),
	  'rewrite' => array( 'slug' => $tmc_post_types_options['testimonials']['rewrite'] ),
    )
  );
  
  register_post_type(
    'clients', array(
      'labels' => array('name' => $tmc_post_types_options['clients']['title'],
	  'singular_name' => __( 'clients' ) ),
      'public' => true,
	  'menu_icon' => 'dashicons-groups',
      'has_archive' => true,
      'supports' => array( 'title', 'editor', 'thumbnail', 'comments', 'excerpt' ),
	  'rewrite' => array( 'slug' => $tmc_post_types_options['clients']['rewrite'] ),
    )
  );
  
}
add_action( 'init', 'custom_post_type_init' );


function custom_post_type_tax_init() {
	
	register_taxonomy(
		'gallery-category',
		'gallery',
		array(
			'label' => __( 'Categories' ),
			'rewrite' => array( 'slug' => 'gallery' ),
			'hierarchical' => true,
		)
	);
	
	register_taxonomy(
		'services-category',
		'services',
		array(
			'label' => __( 'Categories' ),
			'rewrite' => array( 'slug' => 'services' ),
			'hierarchical' => true,
		)
	);
	
	register_taxonomy(
		'clients-category',
		'clients',
		array(
			'label' => __( 'Categories' ),
			'rewrite' => array( 'slug' => 'clients' ),
			'hierarchical' => true,
		)
	);
	
	
}
add_action( 'init', 'custom_post_type_tax_init' );

// TO add Meta boxes Units
function wdm_add_meta_box_unit() {

	add_meta_box('wdm_section_designation', 'Designation', 'wdm_meta_box_team_designation', 'team');
	add_meta_box('wdm_section_social', 'Socials', 'wdm_meta_box_social', 'team');
	add_meta_box('wdm_section_contact', 'Contact Number', 'wdm_meta_box_contact', 'team');
	add_meta_box('wdm_section_email', 'Email Address', 'wdm_meta_box_email', 'team');
	add_meta_box('wdm_section_testimonial', 'Location', 'wdm_meta_box_testimonials', 'testimonials');
	add_meta_box('wdm_section_icon', 'Services Icon', 'wdm_meta_box_services', 'services');
	add_meta_box('wdm_section_page', 'Page', 'wdm_meta_box_page', 'page');
	add_meta_box('wdm_section_post', 'Post', 'wdm_meta_box_post', 'post');
	add_meta_box('wdm_section_service', 'Services', 'wdm_meta_box_service', 'services');
	add_meta_box('wdm_section_team', 'Team', 'wdm_meta_box_team', 'team');
	
}
add_action( 'add_meta_boxes', 'wdm_add_meta_box_unit' );


function wdm_meta_box_page( $post ) {
	
        $value = get_post_meta( $post->ID, 'header-image', true );
		$value3 = get_post_meta( $post->ID, 'hide-page-title', true );
		$value5 = get_post_meta( $post->ID, 'page-header-title', true );
		$value6 = get_post_meta( $post->ID, 'title-alignment', true );
		$value7 = get_post_meta( $post->ID, 'title-padding-top', true );
		$value8 = get_post_meta( $post->ID, 'title-padding-bottom', true );
        ?>
		<div class="row mainBody">
			<div class="meta-lable metaPageLable">
				<label class="meta-section-title">Hide page title?</label>
			</div>
			<div class="meta-value metaPageValue">
				<input type="checkbox" name="hide-page-title" value="yes" <?php if($value3 == 'yes') echo 'checked'; else echo '';?> >
				<span class="meta-description">Check this box to hide page title.</span>
			</div>
		</div>
		<div class="row mainBody">
			<div class="meta-lable metaPageLable">
				<label class="meta-section-title">Page Header Title</label>
			</div>
			<div class="meta-value metaPageValue metaInput">
				<input type="text" name="page-header-title" value="<?php if($value5) echo esc_attr($value5); else echo '';  ?>">
				<p class="meta-description title">Enter in the page header title here.</p>
			</div>
		</div>
		<div class="row mainBody">
			<div class="meta-lable metaPageLable">
				<label class="meta-section-title">Title Alignment</label>
			</div>
			<div class="meta-value metaPageValue">
				<input type="radio" name="title-alignment" value="left" <?php if($value6 == 'left') echo 'checked'; else echo '';?>><span class="alignmentTitle">Left</span> 
				<input type="radio" name="title-alignment" value="center" <?php if($value6 == 'center') echo 'checked'; else echo '';?>><span class="alignmentTitle">Center</span> 
				<input type="radio" name="title-alignment" value="right" <?php if($value6 == 'right') echo 'checked'; else echo '';?>><span class="alignmentTitle">Right</span>
				<p class="meta-description align">Choose how you would like your header text to be aligned</p>
			</div>
		</div>
		<div class="row mainBody">
			<div class="meta-lable metaPageLable">
				<label class="meta-section-title">Page Header Padding Top</label>
			</div>
			<div class="meta-value metaPageValue metaTextarea">
				<input type="text" name="title-padding-top" value="<?php if($value7) echo esc_attr($value7); else echo '';  ?>">
				<span class="meta-description">Your header padding Top. e.g. 200px, default is 0</span>
			</div>
		</div>
		<div class="row mainBody">
			<div class="meta-lable metaPageLable">
				<label class="meta-section-title">Page Header Padding Bottom</label>
			</div>
			<div class="meta-value metaPageValue metaTextarea">
				<input type="text" name="title-padding-bottom" value="<?php if($value8) echo esc_attr($value8); else echo '';  ?>">
				<span class="meta-description">Your header padding bottom. e.g. 200px, default is 0</span>
			</div>
		</div>
		<div class="row mainBody borderBottomNone">
			<div class="meta-lable metaPageLable">
				<label class="meta-section-title">Page Header Image</label>
			</div>
			<div class="meta-value metaPageValue"> 
			<?php 
					  
					$image = '';
					if ($value) {
						$image = wp_get_attachment_image_src($value, 'medium');
						$image = $image[0];
					}
					
					
					?>
						<div class="tmc_metabox_image_page">
							<input name="header-image" type="hidden" class="custom_upload_image" value="<?php echo $value ; ?>" />
							<img src="<?php echo $image; ?>" class="custom_preview_image metaPageImage" alt="" />
							<input class="ind_upload_image upload_button_page button-primary" type="button" value="<?php echo  __( 'Choose Image' ) ; ?>" />
							<a href="#" class="tmc_remove_image button"><?php echo __( 'Remove Image' ); ?></a>
						</div>
						<p class="meta-description title">The image should be between 1500px - 2000px wide and have a minimum height of 328px for best results.</p>		
			</div>
		</div>
		
		<script type="text/javascript">
			jQuery(function($) {
				$(".upload_button_page").click(function(){
					var btnClicked = $(this);
					var custom_uploader = wp.media({
						title   : "<?php echo __( 'Select image'); ?>",
						button  : {
							text: "<?php echo __( 'Attach' ) ; ?>"
						},
						multiple: true
					}).on("select", function () {
						var attachment = custom_uploader.state().get("selection").first().toJSON();
						btnClicked.closest(".tmc_metabox_image_page").find(".custom_upload_image").val(attachment.id);
						btnClicked.closest(".tmc_metabox_image_page").find(".custom_preview_image").attr("src", attachment.url);

					}).open();
				});
				$(".tmc_remove_image").click(function(){
					$(this).closest(".tmc_metabox_image_page").find(".custom_upload_image").val("");
					$(this).closest(".tmc_metabox_image_page").find(".custom_preview_image").attr("src", "");
					return false;
				});
			});
		</script>
	<?php 	
}

function wdm_meta_box_service( $post ) {
	
        $value = get_post_meta( $post->ID, 'service-header-image', true );
        $value3 = get_post_meta( $post->ID, 'service-hide-page-title', true );
		$value5 = get_post_meta( $post->ID, 'service-header-title', true );
		$value6 = get_post_meta( $post->ID, 'service-title-alignment', true );
		$value7 = get_post_meta( $post->ID, 'service-title-padding-top', true );
		$value8 = get_post_meta( $post->ID, 'service-title-padding-bottom', true );
        ?>
		<div class="row mainBody">
			<div class="meta-lable metaPageLable">
				<label class="meta-section-title">Hide page title?</label>
			</div>
			<div class="meta-value metaPageValue">
				<input type="checkbox" name="service-hide-page-title" value="yes" <?php if($value3 == 'yes') echo 'checked'; else echo '';?> >
				<span class="meta-description">Check this box to hide page title.</span>
			</div>
		</div>
		<div class="row mainBody">
			<div class="meta-lable metaPageLable">
				<label class="meta-section-title">Page Header Title</label>
			</div>
			<div class="meta-value metaPageValue metaInput">
				<input type="text" name="service-header-title" value="<?php if($value5) echo esc_attr($value5); else echo '';  ?>">
				<p class="meta-description title">Enter in the page header title here.</p>
			</div>
		</div>
		<div class="row mainBody">
			<div class="meta-lable metaPageLable">
				<label class="meta-section-title">Title Alignment</label>
			</div>
			<div class="meta-value metaPageValue">
				<input type="radio" name="service-title-alignment" value="left" <?php if($value6 == 'left') echo 'checked'; else echo '';?>><span class="alignmentTitle">Left</span> 
				<input type="radio" name="service-title-alignment" value="center" <?php if($value6 == 'center') echo 'checked'; else echo '';?>><span class="alignmentTitle">Center</span> 
				<input type="radio" name="service-title-alignment" value="right" <?php if($value6 == 'right') echo 'checked'; else echo '';?>><span class="alignmentTitle">Right</span>
				<p class="meta-description align">Choose how you would like your header text to be aligned</p>
			</div>
		</div>
		<div class="row mainBody">
			<div class="meta-lable metaPageLable">
				<label class="meta-section-title">Page Header Padding Top</label>
			</div>
			<div class="meta-value metaPageValue metaTextarea">
				<input type="text" name="service-title-padding-top" value="<?php if($value7) echo esc_attr($value7); else echo '';  ?>">
				<span class="meta-description">Your header padding Top. e.g. 200px, default is 0</span>
			</div>
		</div>
		<div class="row mainBody">
			<div class="meta-lable metaPageLable">
				<label class="meta-section-title">Page Header Padding Bottom</label>
			</div>
			<div class="meta-value metaPageValue metaTextarea">
				<input type="text" name="service-title-padding-bottom" value="<?php if($value8) echo esc_attr($value8); else echo '';  ?>">
				<span class="meta-description">Your header padding bottom. e.g. 200px, default is 0</span>
			</div>
		</div>
		<div class="row mainBody borderBottomNone">
			<div class="meta-lable metaPageLable">
				<label>Inner Header Image</label>
			</div>
			<div class="meta-value metaPageValue"> 
			<?php 
					  
					$image = '';
					if ($value) {
						$image = wp_get_attachment_image_src($value, 'medium');
						$image = $image[0];
					}
					
					
					?>
						<div class="tmc_metabox_image_page">
							<input name="service-header-image" type="hidden" class="custom_upload_image" value="<?php echo $value ; ?>" />
							<img src="<?php echo $image; ?>" class="custom_preview_image metaPageImage" alt="" />
							<input class="ind_upload_image upload_button_page button-primary" type="button" value="<?php echo  __( 'Choose Image' ) ; ?>" />
							<a href="#" class="tmc_remove_image button"><?php echo __( 'Remove Image' ); ?></a>
						</div>
						<p class="meta-description title">The image should be between 1500px - 2000px wide and have a minimum height of 328px for best results.</p>						
			</div>
		</div>
		<script type="text/javascript">
			jQuery(function($) {
				$(".upload_button_page").click(function(){
					var btnClicked = $(this);
					var custom_uploader = wp.media({
						title   : "<?php echo __( 'Select image'); ?>",
						button  : {
							text: "<?php echo __( 'Attach' ) ; ?>"
						},
						multiple: true
					}).on("select", function () {
						var attachment = custom_uploader.state().get("selection").first().toJSON();
						btnClicked.closest(".tmc_metabox_image_page").find(".custom_upload_image").val(attachment.id);
						btnClicked.closest(".tmc_metabox_image_page").find(".custom_preview_image").attr("src", attachment.url);

					}).open();
				});
				$(".tmc_remove_image").click(function(){
					$(this).closest(".tmc_metabox_image_page").find(".custom_upload_image").val("");
					$(this).closest(".tmc_metabox_image_page").find(".custom_preview_image").attr("src", "");
					return false;
				});
			});
		</script>
	<?php 	
}

function wdm_meta_box_team( $post ) {
	
        $value = get_post_meta( $post->ID, 'team-header-image', true );
        $value3 = get_post_meta( $post->ID, 'team-hide-page-title', true );
		$value5 = get_post_meta( $post->ID, 'team-header-title', true );
		$value6 = get_post_meta( $post->ID, 'team-title-alignment', true );
		$value7 = get_post_meta( $post->ID, 'team-title-padding-top', true );
		$value8 = get_post_meta( $post->ID, 'team-title-padding-bottom', true );
        ?>
		<div class="row mainBody">
			<div class="meta-lable metaPageLable">
				<label class="meta-section-title">Hide page title?</label>
			</div>
			<div class="meta-value metaPageValue">
				<input type="checkbox" name="team-hide-page-title" value="yes" <?php if($value3 == 'yes') echo 'checked'; else echo '';?> >
				<span class="meta-description">Check this box to hide page title.</span>
			</div>
		</div>
		<div class="row mainBody">
			<div class="meta-lable metaPageLable">
				<label class="meta-section-title">Page Header Title</label>
			</div>
			<div class="meta-value metaPageValue metaInput">
				<input type="text" name="team-header-title" value="<?php if($value5) echo esc_attr($value5); else echo '';  ?>">
				<p class="meta-description title">Enter in the page header title here.</p>
			</div>
		</div>
		<div class="row mainBody">
			<div class="meta-lable metaPageLable">
				<label class="meta-section-title">Title Alignment</label>
			</div>
			<div class="meta-value metaPageValue">
				<input type="radio" name="team-title-alignment" value="left" <?php if($value6 == 'left') echo 'checked'; else echo '';?>><span class="alignmentTitle">Left</span> 
				<input type="radio" name="team-title-alignment" value="center" <?php if($value6 == 'center') echo 'checked'; else echo '';?>><span class="alignmentTitle">Center</span> 
				<input type="radio" name="team-title-alignment" value="right" <?php if($value6 == 'right') echo 'checked'; else echo '';?>><span class="alignmentTitle">Right</span>
				<p class="meta-description align">Choose how you would like your header text to be aligned</p>
			</div>
		</div>
		<div class="row mainBody">
			<div class="meta-lable metaPageLable">
				<label class="meta-section-title">Page Header Padding Top</label>
			</div>
			<div class="meta-value metaPageValue metaTextarea">
				<input type="text" name="team-title-padding-top" value="<?php if($value7) echo esc_attr($value7); else echo '';  ?>">
				<span class="meta-description">Your header padding Top. e.g. 200px, default is 0</span>
			</div>
		</div>
		<div class="row mainBody">
			<div class="meta-lable metaPageLable">
				<label class="meta-section-title">Page Header Padding Bottom</label>
			</div>
			<div class="meta-value metaPageValue metaTextarea">
				<input type="text" name="team-title-padding-bottom" value="<?php if($value8) echo esc_attr($value8); else echo '';  ?>">
				<span class="meta-description">Your header padding bottom. e.g. 200px, default is 0</span>
			</div>
		</div>
		<div class="row mainBody borderBottomNone">
			<div class="meta-lable metaPageLable">
				<label> Inner Header Image</label>
			</div>
			<div class="meta-value metaPageValue"> 
			<?php 
					  
					$image = '';
					if ($value) {
						$image = wp_get_attachment_image_src($value, 'medium');
						$image = $image[0];
					}
					
					
					?>
						<div class="tmc_metabox_image_page">
							<input name="team-header-image" type="hidden" class="custom_upload_image" value="<?php echo $value ; ?>" />
							<img src="<?php echo $image; ?>" class="custom_preview_image metaPageImage" alt="" />
							<input class="ind_upload_image upload_button_page button-primary" type="button" value="<?php echo  __( 'Choose Image' ) ; ?>" />
							<a href="#" class="tmc_remove_image button"><?php echo __( 'Remove Image' ); ?></a>
						</div>	
						<p class="meta-description title">The image should be between 1500px - 2000px wide and have a minimum height of 328px for best results.</p>
			</div>
		</div>
		<script type="text/javascript">
			jQuery(function($) {
				$(".upload_button_page").click(function(){
					var btnClicked = $(this);
					var custom_uploader = wp.media({
						title   : "<?php echo __( 'Select image'); ?>",
						button  : {
							text: "<?php echo __( 'Attach' ) ; ?>"
						},
						multiple: true
					}).on("select", function () {
						var attachment = custom_uploader.state().get("selection").first().toJSON();
						btnClicked.closest(".tmc_metabox_image_page").find(".custom_upload_image").val(attachment.id);
						btnClicked.closest(".tmc_metabox_image_page").find(".custom_preview_image").attr("src", attachment.url);

					}).open();
				});
				$(".tmc_remove_image").click(function(){
					$(this).closest(".tmc_metabox_image_page").find(".custom_upload_image").val("");
					$(this).closest(".tmc_metabox_image_page").find(".custom_preview_image").attr("src", "");
					return false;
				});
			});
		</script>
	<?php 	
}

function wdm_meta_box_post( $post ) {
	
        $value = get_post_meta( $post->ID, 'post-header-image', true );
		$value3 = get_post_meta( $post->ID, 'post-hide-page-title', true );
		$value5 = get_post_meta( $post->ID, 'post-header-title', true );
		$value6 = get_post_meta( $post->ID, 'post-title-alignment', true );
		$value7 = get_post_meta( $post->ID, 'post-title-padding-top', true );
		$value8 = get_post_meta( $post->ID, 'post-title-padding-bottom', true );
        ?>
		<div class="row mainBody">
			<div class="meta-lable metaPageLable">
				<label class="meta-section-title">Hide page title?</label>
			</div>
			<div class="meta-value metaPageValue">
				<input type="checkbox" name="post-hide-page-title" value="yes" <?php if($value3 == 'yes') echo 'checked'; else echo '';?> >
				<span class="meta-description">Check this box to hide page title.</span>
			</div>
		</div>
		<div class="row mainBody">
			<div class="meta-lable metaPageLable">
				<label class="meta-section-title">Page Header Title</label>
			</div>
			<div class="meta-value metaPageValue metaInput">
				<input type="text" name="post-header-title" value="<?php if($value5) echo esc_attr($value5); else echo '';  ?>">
				<p class="meta-description title">Enter in the page header title here.</p>
			</div>
		</div>
		<div class="row mainBody">
			<div class="meta-lable metaPageLable">
				<label class="meta-section-title">Title Alignment</label>
			</div>
			<div class="meta-value metaPageValue">
				<input type="radio" name="post-title-alignment" value="left" <?php if($value6 == 'left') echo 'checked'; else echo '';?>>
				<span class="alignmentTitle">Left</span> 
				<input type="radio" name="post-title-alignment" value="center" <?php if($value6 == 'center') echo 'checked'; else echo '';?>>
				<span class="alignmentTitle">Center</span> 
				<input type="radio" name="post-title-alignment" value="right" <?php if($value6 == 'right') echo 'checked'; else echo '';?>>
				<span class="alignmentTitle">Right</span>
				<p class="meta-description align">Choose how you would like your header text to be aligned</p>
			</div>
		</div>
		<div class="row mainBody">
			<div class="meta-lable metaPageLable">
				<label class="meta-section-title">Page Header Padding Top</label>
			</div>
			<div class="meta-value metaPageValue metaTextarea">
				<input type="text" name="post-title-padding-top" value="<?php if($value7) echo esc_attr($value7); else echo '';  ?>">
				<span class="meta-description">Your header padding Top. e.g. 200px, default is 0</span>
			</div>
		</div>
		<div class="row mainBody">
			<div class="meta-lable metaPageLable">
				<label class="meta-section-title">Page Header Padding Bottom</label>
			</div>
			<div class="meta-value metaPageValue metaTextarea">
				<input type="text" name="post-title-padding-bottom" value="<?php if($value8) echo esc_attr($value8); else echo '';  ?>">
				<span class="meta-description">Your header padding bottom. e.g. 200px, default is 0</span>
			</div>
		</div>
		<div class="row mainBody borderBottomNone">
			<div class="meta-lable metaPageLable">
				<label>Inner Header Image</label>
			</div>
			<div class="meta-value metaPageValue"> 
			<?php 
					  
					$image = '';
					if ($value) {
						$image = wp_get_attachment_image_src($value, 'medium');
						$image = $image[0];
					}
					
					
					?>
						<div class="tmc_metabox_image_page">
							<input name="post-header-image" type="hidden" class="custom_upload_image" value="<?php echo $value ; ?>" />
							<img src="<?php echo $image; ?>" class="custom_preview_image metaPageImage" alt="" />
							<input class="ind_upload_image upload_button_page button-primary" type="button" value="<?php echo  __( 'Choose Image' ) ; ?>" />
							<a href="#" class="tmc_remove_image button"><?php echo __( 'Remove Image' ); ?></a>
						</div>	
						<p class="meta-description title">The image should be between 1500px - 2000px wide and have a minimum height of 328px for best results.</p>		
			</div>
		</div>
		<script type="text/javascript">
			jQuery(function($) {
				$(".upload_button_page").click(function(){
					var btnClicked = $(this);
					var custom_uploader = wp.media({
						title   : "<?php echo __( 'Select image'); ?>",
						button  : {
							text: "<?php echo __( 'Attach' ) ; ?>"
						},
						multiple: true
					}).on("select", function () {
						var attachment = custom_uploader.state().get("selection").first().toJSON();
						btnClicked.closest(".tmc_metabox_image_page").find(".custom_upload_image").val(attachment.id);
						btnClicked.closest(".tmc_metabox_image_page").find(".custom_preview_image").attr("src", attachment.url);

					}).open();
				});
				$(".tmc_remove_image").click(function(){
					$(this).closest(".tmc_metabox_image_page").find(".custom_upload_image").val("");
					$(this).closest(".tmc_metabox_image_page").find(".custom_preview_image").attr("src", "");
					return false;
				});
			});
		</script>
	<?php 	
}


function wdm_meta_box_services( $post ) {
	
        $icon = get_post_meta( $post->ID, '_dentalcare_services_icon', true );
        ?>
		
		<div class="row">
			<div class="meta-lable">
				<label>Service Icon</label>
			</div>
			<div class="meta-value"> 
			<?php 
					  $default_image = plugin_dir_url( __FILE__ ) . 'images/service_1.png';
					$image = '';
					if ($icon) {
						$image = wp_get_attachment_image_src($icon, 'medium');
						$image = $image[0];
					}
					if( empty($image) ){
						$image = $default_image;
					}
					
					?>
						<div class="dentalcare_metabox_image">
							<input name="_dentalcare_services_icon" type="hidden" class="custom_upload_image" value="<?php echo $icon; ?>" />
							<img src="<?php echo $image; ?>" class="custom_preview_image" alt="" />
							<input class="ind_upload_image upload_button_dentalcare_services_icon button-primary" type="button" value="<?php echo  __( 'Choose Image' ) ; ?>" />
							<a href="#" class="dentalcare_remove_image button"><?php echo __( 'Remove Image' ); ?></a>
						</div>			
			</div>
		</div>
		
		<script type="text/javascript">
			jQuery(function($) {
				$(".upload_button_dentalcare_services_icon").click(function(){
					var btnClicked = $(this);
					var custom_uploader = wp.media({
						title   : "<?php echo __( 'Select image'); ?>",
						button  : {
							text: "<?php echo __( 'Attach' ) ; ?>"
						},
						multiple: true
					}).on("select", function () {
						var attachment = custom_uploader.state().get("selection").first().toJSON();
						btnClicked.closest(".dentalcare_metabox_image").find(".custom_upload_image").val(attachment.id);
						btnClicked.closest(".dentalcare_metabox_image").find(".custom_preview_image").attr("src", attachment.url);

					}).open();
				});
				$(".dentalcare_remove_image").click(function(){
					$(this).closest(".dentalcare_metabox_image").find(".custom_upload_image").val("");
					$(this).closest(".dentalcare_metabox_image").find(".custom_preview_image").attr("src", "<?php echo $default_image; ?>");
					return false;
				});
			});
		</script>
	<?php 	
}


function wdm_meta_box_contact( $post ) {
	
        $contact_number = get_post_meta( $post->ID, '_dentalcare_contact_number', true );
        ?>
        <div class="row">
			<div class="meta-value">
				<input type="text" name="_dentalcare_contact_number" value="<?php if($contact_number) echo esc_attr($contact_number); else echo ' 1800 (123) 4567';  ?>">
			</div>
		</div>		
        <?php
}
function wdm_meta_box_email( $post ) {
	
        $email_address = get_post_meta( $post->ID, '_dentalcare_email_address', true );
        ?>
        <div class="row">
			<div class="meta-value">
				<input type="text" name="_dentalcare_email_address" value="<?php if($email_address) echo esc_attr($email_address); else echo 'michalejohn@dentalcare.com';  ?>">
			</div>
		</div>		
        <?php
}

function wdm_meta_box_team_designation( $post ) {
	
       $teamdesignation = get_post_meta( $post->ID, '_dentalcare_member_designation', true );
        ?>
        <div class="row">
			<div class="meta-value">
				<input type="text" name="_dentalcare_member_designation" value="<?php if($teamdesignation) echo esc_attr($teamdesignation); else echo 'Designation';  ?>">
			</div>
		</div>		
        <?php
}

function wdm_meta_box_social( $post ) {
	
        $facebook = get_post_meta( $post->ID, '_dentalcare_social_facebook', true ); 
		$twitter = get_post_meta( $post->ID, '_dentalcare_social_twitter', true ); 
		$google_plus = get_post_meta( $post->ID, '_dentalcare_social_google_plus', true ); 
		$linkedin = get_post_meta( $post->ID, '_dentalcare_social_linkedin', true ); 

        ?>
        <div class="row">
			<div class="meta-lable">
				<label><?php echo esc_html__('Facebook', 'dentalCare'); ?></label>
			</div>
			<div class="meta-value">
				<input type="text" name="_dentalcare_social_facebook" value="<?php if($facebook) echo esc_attr($facebook); else echo '#';  ?>">
			</div>
		</div>
		
		<div class="row">
			<div class="meta-lable">
				<label><?php echo esc_html__('Twitter', 'dentalCare'); ?></label>
			</div>
			<div class="meta-value">
				<input type="text" name="_dentalcare_social_twitter" value="<?php if($twitter) echo esc_attr($twitter); else echo '#';  ?>">
			</div>
		</div>

		<div class="row">
			<div class="meta-lable">
				<label><?php echo esc_html__('Google-Plus', 'dentalCare'); ?></label>
			</div>
			<div class="meta-value">
				<input type="text" name="_dentalcare_social_google_plus" value="<?php if($google_plus) echo esc_attr($google_plus); else echo '#';  ?>">
			</div>
		</div>

		<div class="row">
			<div class="meta-lable">
				<label><?php echo esc_html__('Linkedin', 'dentalCare'); ?></label>
			</div>
			<div class="meta-value">
				<input type="text" name="_dentalcare_social_linkedin" value="<?php if($linkedin) echo esc_attr($linkedin); else echo '#';  ?>">
			</div>
		</div>
        <?php
}

function wdm_meta_box_testimonials( $post ) {
	
		$location = get_post_meta( $post->ID, '_dentalcare_testimonial_location', true );
        ?>
		
		<div class="row">

			<div class="meta-value">
				<input type="text" name="_dentalcare_testimonial_location" value="<?php if($location) echo esc_attr($location); else echo 'Location';  ?>">
			</div>
		</div>
	<?php 	
}

function wdm_save_meta_box_data_unit( $post_id ) {
				
	// TMC Member Designation
	$teamdesignation = ( isset( $_POST['_dentalcare_member_designation'] ) ?  $_POST['_dentalcare_member_designation'] : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, '_dentalcare_member_designation', $teamdesignation );
	
	// Testimonial Location
	$location = ( isset( $_POST['_dentalcare_testimonial_location'] ) ? $_POST['_dentalcare_testimonial_location'] : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, '_dentalcare_testimonial_location', $location );
	
	// Social Facebook
	$facebook = ( isset( $_POST['_dentalcare_social_facebook'] ) ?  $_POST['_dentalcare_social_facebook'] : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, '_dentalcare_social_facebook', $facebook );
	
	// Social Twitter
	$twitter = ( isset( $_POST['_dentalcare_social_twitter'] ) ? $_POST['_dentalcare_social_twitter'] : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, '_dentalcare_social_twitter', $twitter );
	
	// Social Skype
	$google_plus = ( isset( $_POST['_dentalcare_social_google_plus'] ) ?  $_POST['_dentalcare_social_google_plus'] : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, '_dentalcare_social_google_plus', $google_plus );
	
	// Social Linkedin
	$linkedin = ( isset( $_POST['_dentalcare_social_linkedin'] ) ? $_POST['_dentalcare_social_linkedin'] : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, '_dentalcare_social_linkedin', $linkedin );
	
	// TMC Contact Number
	$contact_number = ( isset( $_POST['_dentalcare_contact_number'] ) ?  $_POST['_dentalcare_contact_number']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, '_dentalcare_contact_number', $contact_number );

	// TMC Email Address
	$email_address = ( isset( $_POST['_dentalcare_email_address'] ) ?  $_POST['_dentalcare_email_address']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, '_dentalcare_email_address', $email_address );
	
	// Services Icon
	$icon = ( isset( $_POST['_dentalcare_services_icon'] ) ?  $_POST['_dentalcare_services_icon'] : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, '_dentalcare_services_icon', $icon );

	
// Dentalcare Meta Page Module

	// Dentalcare Page Image
    $pageInnerMain = ( isset( $_POST['header-image'] ) ?  $_POST['header-image']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'header-image', $pageInnerMain );
	
	// Dentalcare Hide Page title
	$hidePageTitle = ( isset( $_POST['hide-page-title'] ) ?  $_POST['hide-page-title']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'hide-page-title', $hidePageTitle );
		
	// Dentalcare Page Header Title
    $pageHeaderTitle = ( isset( $_POST['page-header-title'] ) ?  $_POST['page-header-title']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'page-header-title', $pageHeaderTitle );

	// Dentalcare Title Alignment
       $titleAligment = ( isset( $_POST['title-alignment'] ) ?  $_POST['title-alignment']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'title-alignment', $titleAligment );
	
	// Dentalcare Title Padding Top
       $titlePaddingTop = ( isset( $_POST['title-padding-top'] ) ?  $_POST['title-padding-top']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'title-padding-top', $titlePaddingTop );
	
	// Dentalcare Title Padding Bottom
       $titlePaddingBottom = ( isset( $_POST['title-padding-bottom'] ) ?  $_POST['title-padding-bottom']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'title-padding-bottom', $titlePaddingBottom );

// Dentalcare Meta Service Module
	
	// Dentalcare Service Image
	$serviceInnerMain = ( isset( $_POST['service-header-image'] ) ?  $_POST['service-header-image']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'service-header-image', $serviceInnerMain );
	
	// Dentalcare Hide Page title
	$serviceHidePageTitle = ( isset( $_POST['service-hide-page-title'] ) ?  $_POST['service-hide-page-title']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'service-hide-page-title', $serviceHidePageTitle );
		
	// Dentalcare Page Header Title
    $servicePageHeaderTitle = ( isset( $_POST['service-header-title'] ) ?  $_POST['service-header-title']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'service-header-title', $servicePageHeaderTitle );

	// Dentalcare Title Alignment
    $serviceTitleAligment = ( isset( $_POST['service-title-alignment'] ) ?  $_POST['service-title-alignment']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'service-title-alignment', $serviceTitleAligment );
	
	// Dentalcare Title Padding Top
    $serviceTitlePaddingTop = ( isset( $_POST['service-title-padding-top'] ) ?  $_POST['service-title-padding-top']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'service-title-padding-top', $serviceTitlePaddingTop );
	
	// Dentalcare Title Padding Bottom
    $serviceTitlePaddingBottom = ( isset( $_POST['service-title-padding-bottom'] ) ?  $_POST['service-title-padding-bottom']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'service-title-padding-bottom', $serviceTitlePaddingBottom );
	
// Dentalcare Meta Team Module
	
	// Dentalcare Team Image
	$teamInnerMain = ( isset( $_POST['team-header-image'] ) ?  $_POST['team-header-image']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'team-header-image', $teamInnerMain );
	
	// Dentalcare Hide Page title
	$teamHidePageTitle = ( isset( $_POST['team-hide-page-title'] ) ?  $_POST['team-hide-page-title']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'team-hide-page-title', $teamHidePageTitle );
		
	// Dentalcare Page Header Title
    $teamPageHeaderTitle = ( isset( $_POST['team-header-title'] ) ?  $_POST['team-header-title']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'team-header-title', $teamPageHeaderTitle );

	// Dentalcare Title Alignment
    $teamTitleAligment = ( isset( $_POST['team-title-alignment'] ) ?  $_POST['team-title-alignment']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'team-title-alignment', $teamTitleAligment );
	
	// Dentalcare Title Padding Top
    $teamTitlePaddingTop = ( isset( $_POST['team-title-padding-top'] ) ?  $_POST['team-title-padding-top']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'team-title-padding-top', $teamTitlePaddingTop );
	
	// Dentalcare Title Padding Bottom
    $teamTitlePaddingBottom = ( isset( $_POST['team-title-padding-bottom'] ) ?  $_POST['team-title-padding-bottom']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'team-title-padding-bottom', $teamTitlePaddingBottom );

// Dentalcare Meta Post Module
	
	// Dentalcare Post Image
	$postInnerMain = ( isset( $_POST['post-header-image'] ) ?  $_POST['post-header-image']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'post-header-image', $postInnerMain );
	
	// Dentalcare Hide Page title
	$postHidePageTitle = ( isset( $_POST['post-hide-page-title'] ) ?  $_POST['post-hide-page-title']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'post-hide-page-title', $postHidePageTitle );
		
	// Dentalcare Page Header Title
    $postHeaderTitle = ( isset( $_POST['post-header-title'] ) ?  $_POST['post-header-title']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'post-header-title', $postHeaderTitle );

	// Dentalcare Title Alignment
    $postTitleAligment = ( isset( $_POST['post-title-alignment'] ) ?  $_POST['post-title-alignment']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'post-title-alignment', $postTitleAligment );
	
	// Dentalcare Title Padding Top
    $postTitlePaddingTop = ( isset( $_POST['post-title-padding-top'] ) ?  $_POST['post-title-padding-top']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'post-title-padding-top', $postTitlePaddingTop );
	
	// Dentalcare Title Padding Bottom
    $postTitlePaddingBottom = ( isset( $_POST['post-title-padding-bottom'] ) ?  $_POST['post-title-padding-bottom']  : '' );
	// Update the meta field in the database.
	update_post_meta( $post_id, 'post-title-padding-bottom', $postTitlePaddingBottom );
		
}
add_action( 'save_post', 'wdm_save_meta_box_data_unit' );



// Tmc Post Type Rewrite subplugin
add_action( 'admin_menu', 'tmc_post_types_options_menu' );

if( ! function_exists( 'tmc_post_types_options_menu' ) ){
	function tmc_post_types_options_menu(){
		add_options_page( __('TMC Post Types', TMC_POST_TYPE), __('TMC Post Types', TMC_POST_TYPE), 'manage_options', 'tmc_post_types', 'tmc_post_types_options' );
	}
}

if( ! function_exists( 'tmc_post_types_options' ) ){
	function tmc_post_types_options(){

		if ( ! empty( $_POST['tmc_post_types_options'] ) ) {
			update_option( 'tmc_post_types_options', $_POST['tmc_post_types_options'] );
		}

		$options_meta = get_option('tmc_post_types_options');

		$tmcPostTypesOptions = array(

			'gallery' => array(
				'title' => __( 'Gallery', TMC_POST_TYPE ),
				'rewrite' => 'gallery'
			),
			
			'services' => array(
				'title' => __( 'Services', TMC_POST_TYPE ),
				'rewrite' => 'services'
			),
				
			'team' => array(
				'title' => __( 'Team', TMC_POST_TYPE ),
				'rewrite' => 'team'
			),
				
			'testimonials' => array(
				'title' => __( 'Testimonials', TMC_POST_TYPE ),
				'rewrite' => 'testimonials'
			),
			
			'clients' => array(
				'title' => __( 'Clients', TMC_POST_TYPE ),
				'rewrite' => 'clients'
			),
					
		);

		$options_meta = wp_parse_args( $options_meta, $tmcPostTypesOptions );
		
		$content = '';

		$content .= '
			<div class="tmcposttype">
		        <h2>' . __( 'TMC Post Type Settings', TMC_POST_TYPE ) . '</h2>

		        <form method="POST" action="">
		            <table class="form-table">';
						foreach ($tmcPostTypesOptions as $key => $value){
							$content .= '
								<tr valign="top">
									<th scope="row">
										<label for="'.$key.'_title">' . __( 'Module Name:', TMC_POST_TYPE ) . '</label>
									</th>
									<td>
				                        <input type="text" id="'.$key.'_title" name="tmc_post_types_options['.$key.'][title]" value="' . $options_meta[$key]['title'] . '"  size="25" />
				                    </td>
								</tr>
								
				                <tr valign="top">
				                    <th scope="row">
				                        <label for="'.$key.'_rewrite">' . __( 'Slug:', TMC_POST_TYPE ) . '</label>
				                    </th>
				                    <td>
				                        <input type="text" id="'.$key.'_rewrite" name="tmc_post_types_options['.$key.'][rewrite]" value="' . $options_meta[$key]['rewrite'] . '"  size="25" />
				                    </td>
				                </tr>
				                <tr valign="top"><th scope="row"></th></tr>
			                ';
						}
		 $content .='</table>
		            <p>' . __( "NOTE: After you change the rewrite field values, you'll need to refresh permalinks under Settings -> Permalinks", TMC_POST_TYPE ) . '</p>
		            <br/>
		            <p>
						<input type="submit" value="' . __( 'Save settings', TMC_POST_TYPE ) . '" class="button-primary"/>
					</p>
		        </form>
		    </div>
		';
		
		echo $content;
	}
}



function dentalcare_plugin_styles() {
    $plugin_url =  plugins_url('', __FILE__);
    wp_enqueue_style( 'main', $plugin_url . '/css/style.css', null, null, 'all' );
}

add_action( 'admin_enqueue_scripts', 'dentalcare_plugin_styles' );
?>