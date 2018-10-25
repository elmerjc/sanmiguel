<?php dentalcare_get_header(); ?>
	<div class="content-area">		
		<?php
			while ( have_posts() ) {
				the_post();
				?>
					<div class="entry-content">
						<div class="text_block wpb_text_column clearfix">
							<?php the_content(); ?>
						</div>
						<?php
						wp_link_pages( array(
							'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'dentalcare' ) . '</span>',
							'after'       => '</div>',
							'link_before' => '<span>',
							'link_after'  => '</span>',
							'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'dentalcare' ) . ' </span>%',
							'separator'   => '<span class="screen-reader-text">, </span>',
						) );
						?>
					</div>
					<?php   if (  class_exists( 'Redux' ) ) {   ?>
					<?php if(isset($dentalcare_option['switch_comments']) && $dentalcare_option['switch_comments'] == 1 ) { ?>
					<?php
					if ( comments_open() || get_comments_number() ) { ?>
						<div class="dentalcare_post_comments">
							<?php comments_template(); ?>
						</div>
					<?php 
						}
					}
					} else {
					if ( comments_open() || get_comments_number() ) { ?>
						<div class="dentalcare_post_comments">
							<?php comments_template(); ?>
						</div> 
					<?php	}
					}
				}
		?>
	</div>
<?php get_footer(); ?>