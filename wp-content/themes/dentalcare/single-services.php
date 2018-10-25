<?php dentalcare_get_header(); ?>
<div class="content-area">
	<?php
	while ( have_posts() ) {
		the_post();
	?>
		<div class="tt-block">
			<div class="tt-tab-wrapper">
				<div class="row">
				
					<div class="col-md-9 col-md-push-3">
						<?php the_content(); ?>
					</div>
					
					<div class="col-md-3 col-md-pull-9">
						<?php if( is_active_sidebar( 'dentalcare-services-sidebar' ) ){ ?>
							<?php dynamic_sidebar('dentalcare-services-sidebar'); ?>
						<?php } ?>	
					</div>
					
				</div>
			</div>	
		</div>	
		
	<?php } ?>
	
</div>
<?php get_footer(); ?>