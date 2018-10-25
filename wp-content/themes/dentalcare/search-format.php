<?php /* ************* POST FORMAT IMAGE ************** */
$thumbsize = 'dentalcare-blog-large';
?>
<div <?php post_class("tt-search-size")?> id="post-<?php the_ID(); ?>">
	<div class="tt-blog-img custom-hover">
		<?php if ( has_post_thumbnail()): 	?>
		
		<a href="<?php the_permalink()  ?>">
			<?php  
			
				echo get_the_post_thumbnail($post->ID, $thumbsize, array('class'=>'img-responsive'));
			
			 ?>
		</a>
		<?php endif;?>
	
	</div>
	<h3 class="tt-title h5"><a href="<?php echo the_permalink(); ?>"><?php  echo the_title(); ?></a></h3>
	<div class="simple-text-search"><p><?php echo get_the_excerpt(); ?></p></div>
		<a href="<?php echo the_permalink(); ?>" class="more-link"><?php echo  esc_html_e('Read More', 'dentalcare'); ?></a>
</div>