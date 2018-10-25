<?php dentalcare_get_header(); ?>
<?php global $dentalcare_option; ?>
<?php
if ( ! empty($dentalcare_option['blog_sidebar_type'])) {
	$sidebar_type = $dentalcare_option['blog_sidebar_type'];	
} else {
	$sidebar_type = 'wp';
}
if ( $sidebar_type == 'wp' && isset($dentalcare_option['blog_wp_sidebar'])  ) {	
	$sidebar_id = $dentalcare_option['blog_wp_sidebar'];	
} else {
		if(isset($dentalcare_option['blog_vc_sidebar'])){
			$sidebar_id = $dentalcare_option['blog_vc_sidebar'];
		}
}
if ( ! empty( $sidebar_id) ) {
	 $sidebar_id =  $sidebar_id;	 
} else {
	$sidebar_id = 'dentalcare-right-sidebar';
}

	if ( ! empty($dentalcare_option['blog_sidebar_position'])) {
		$sidebar_position = $dentalcare_option['blog_sidebar_position'];
	} else {
		$sidebar_position = 'right';
	} 	
	
$dentalcare_layout = dentalcare_get_structure( $sidebar_id, $sidebar_type, $sidebar_position); ?>

<?php echo wp_kses_post($dentalcare_layout['content_before']); ?>
<?php
$posts_class = '';
$paginate_links_data = paginate_links( array('type' => 'array') );

if( empty( $paginate_links_data ) ) {
	$posts_class .= ' no-paginate';
}
?>
<div id="post-<?php the_ID(); ?>" <?php post_class();?>>
<?php
if ( have_posts() ) :
	while ( have_posts() ) : the_post();	
	?>
		<div class="tt-blog">
				<?php
				if( has_post_thumbnail( ) ) { ?>
					<a class="tt-blog-img custom-hover" href="<?php echo get_the_permalink(); ?>">
						<?php the_post_thumbnail( 'blog-large' ); ?>
						<?php if(isset($dentalcare_option['blog_metadata']) && $dentalcare_option['blog_metadata'] == '1'){ ?>
							<?php if(isset($dentalcare_option['blog_multi_checkbox']) && $dentalcare_option['blog_multi_checkbox'][1] == '1'){ ?>
								<span class="tt-blog-date"> <?php echo get_the_date("d"); ?> <?php echo get_the_date("M"); ?> <?php echo get_the_date("Y"); ?> </span>
							<?php } ?>
						<?php } ?>
					</a>
					
				<?php }
				?>

			<?php if ( 'post' == get_post_type() ) : ?>
			<?php if(isset($dentalcare_option['blog_metadata']) && $dentalcare_option['blog_metadata'] == '1'){ ?>
				<div class="tt-blog-info">
				<?php if(isset($dentalcare_option['blog_multi_checkbox']) && $dentalcare_option['blog_multi_checkbox'][2] == '1'){ ?>
					<span class="tt-blog-label"><i class="fa fa-user"></i> <?php echo esc_html__('By:', 'dentalcare'); ?> <a href="<?php echo get_the_permalink(); ?>"> <?php the_author(); ?></a></span>
					<?php } ?>
					<?php if(isset($dentalcare_option['blog_multi_checkbox']) && $dentalcare_option['blog_multi_checkbox'][4] == '1'){ ?>
					<span class="tt-blog-label tags"><i class="fa fa-tag"></i><a href="<?php echo get_the_permalink(); ?>">
					<?php echo implode( ' / ', wp_get_post_tags( get_the_ID(), array( 'fields' => 'names' ) ) ) ?></a></span>
					<?php } ?>
					<?php if(isset($dentalcare_option['blog_multi_checkbox']) && $dentalcare_option['blog_multi_checkbox'][3] == '1'){ ?>
					<span class="tt-blog-label"><i class="fa fa-comments-o"></i><a href="<?php comments_link(); ?>"><?php comments_number(); ?></a></span>
					<?php } ?>
				</div><!-- .entry-meta -->
			<?php	} ?>
			<?php endif; ?>
			
			<?php if ( 'post' == get_post_type() ) : ?>
			   <?php if ( is_sticky( ) ) {
				echo '<span class="genericon genericon-pinned"></span> ';
			   }  endif; ?>
			
			
				<?php if( ( get_the_title()) ){  ?>						<?php the_title( sprintf( '<h2 class="tt-blog-title h5 a-color"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>					<?php } else{ 						echo '<a href="'.get_permalink().'"><b>' .get_the_date(). '</b></a> <br /><br />'; ?>					<?php } ?>
			
			<div class="simple-text marg-p-bott">
			<?php
				/* translators: %s: Name of current post */
				the_content(sprintf(
					wp_kses_post( 'Read More %s <span class="meta-nav"></span>', 'dentalcare' ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				));
			?>
			</div>
			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html( 'Pages:', 'dentalcare' ),
					'after'  => '</div>',
				) );
			?>						
		</div><!-- .entry-content -->
		<div class="empty-space marg-lg-b80 marg-xs-b50"></div>
		<?php
	endwhile;
 elseif ( is_search() ) : ?>
<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'dentalcare' ); ?></p>
<?php else : ?>

<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'dentalcare' ); ?></p> 
<?php	endif;
?>
</div>
<?php
	if (class_exists( 'Redux' )) {
		if(isset($dentalcare_option['blog_pagination']) && $dentalcare_option['blog_pagination'] == '1'){
			echo paginate_links( array(
				'type'      => 'list',
				'prev_text' => '<i class="fa fa-angle-left"></i>',
				'next_text' => '<i class="fa fa-angle-right"></i>',
			) );
		}
	} else {
		echo paginate_links( array(
			'type'      => 'list',
			'prev_text' => '<i class="fa fa-angle-left"></i>',
			'next_text' => '<i class="fa fa-angle-right"></i>',
		) );
	}
?>
<div class="empty-space marg-sm-b50"></div>
<?php echo wp_kses_post($dentalcare_layout['content_after']); ?>
<?php echo wp_kses_post($dentalcare_layout['sidebar_before']); ?>
<?php
if ( $sidebar_id ) {
	if ( $sidebar_type == 'wp' ) {
		$sidebar = true;
	} else {
		$sidebar = get_post( $sidebar_id );
	}
}
if ( isset( $sidebar ) ) {
	if ( $sidebar_type == 'vc' ) { ?>
		<div class="sidebar-area">
			<?php echo apply_filters( 'the_content', $sidebar->post_content ); ?>
		</div>
	<?php } else { ?>
		<?php if( is_active_sidebar( $sidebar_id ) ){ ?>
			<div class="sidebar-area default_widgets">
				<?php dynamic_sidebar( $sidebar_id ); ?>
			</div>
		<?php } ?>	
	<?php }
}
?>
<?php echo wp_kses_post($dentalcare_layout['sidebar_after']); ?>
<?php get_footer(); ?>