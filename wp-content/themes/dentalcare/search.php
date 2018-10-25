<?php
/**
 * The template for displaying search results pages.
 *
 * @package industrial
 */
global $post;
dentalcare_get_header();
if($post){
		$dentalcare_result = $post->ID;
	}

 ?>
 	<div class="row_inner_wrapper clearfix">
	<div id="content-wrap" class="container">
		<div id="primary" class="col-md-8 col-lg-9 my-float-condition">
			<main id="main" class="site-main">
				<?php $dentalcare_args = array('post_type' =>  'any', 's' => $s, 'paged' => $paged); query_posts($dentalcare_args);
				if ( have_posts() ) : ?>
					<div class="blog-posts">
						<?php
						if( have_posts()):
							while ( have_posts() ) : the_post(); 
								if ( get_post_format( $post->ID )):
									get_template_part( 'content', get_post_format() );
								else:
									get_template_part('search', 'format');
								endif;	
							endwhile;
						endif;
						?>
					</div>
					
				<?php else : ?>
					<p>
						<?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'dentalcare' ); ?>
					</p>
				<?php endif; ?>
			</main><!-- #main -->
			
			<div class="empty-space marg-lg-b30 marg-xs-b50"></div>
				<div class="pagination_padd">
					<?php 
						echo paginate_links( array(
							'type'      => 'list',
							'prev_text' => '<i class="fa fa-angle-left"></i>',
							'next_text' => '<i class="fa fa-angle-right"></i>',
						) );
					?>
				</div>
			
			
		</div><!-- #primary -->
		<div class="col-md-4 col-lg-3 sidebar-area">
			<?php if( is_active_sidebar( 'dentalcare-right-sidebar' ) ){ ?>
				<?php dynamic_sidebar( 'dentalcare-right-sidebar' ); ?>
			<?php } ?>	
		</div>
	</div> <!-- /#content-wrap -->
	</div>
<?php get_footer(); ?>