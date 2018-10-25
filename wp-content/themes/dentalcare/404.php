<?php dentalcare_get_header(); ?>
	<?php
	
		$backImage =  get_template_directory_uri().'/assets/images/not_found/banner-404.jpg';
		$mainImage = 'style=background-image:url('. esc_url($backImage) .');';
		
	?>
	<div class="tt-not-found">
		<div class="tt-not-found-entry" <?php echo esc_attr($mainImage); ?> >
		<div class="opacity"></div>
			<div class="container">
				<div class="row">
					<div class="col-md-9">
						<span class="tt-not-found-title"><?php echo esc_html__('404','dentalcare'); ?></span>
						<h1 class="tt-not-found-subtitle h2"><?php echo esc_html__('Oops! That page cannot be found','dentalcare'); ?></h1>
						<div class="simple-text large light white raleway ">
							<p><?php echo esc_html__('Sorry, but the page you are looking for does not existing','dentalcare'); ?></p>
						</div>
						<a class="c-btn" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html__('go to home page','dentalcare'); ?></a>
					</div>
				</div>                            
			</div>
			<div class="tt-mslide-border type-2"></div>
		</div>
	</div>
	
<?php get_footer(); ?>