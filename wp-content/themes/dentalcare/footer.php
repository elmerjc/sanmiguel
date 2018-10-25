	</div>
	</div>	
	</div> <!--.content_wrapper-->
<?php
	global $dentalcare_option; 
?>
<footer class="tt-footer">
<?php if( isset($dentalcare_option['footer_widget']) && $dentalcare_option['footer_widget'] == '1' ) { ?> 
	<?php if(!is_page('coming-soon')){ ?>
	<?php if( isset($dentalcare_option['footer_sidebar_count'] )): ?>
		<div class="tt-footer-inner">
			<div class="container">
				<div class="row">
					<?php
					$footer_logo = get_template_directory_uri() . '/assets/images/tmp/default_dark.png';
					$footer_sidebar_count = intval( $dentalcare_option['footer_sidebar_count'] );
					$col = 12 / $footer_sidebar_count;
					for ( $count = 1; $count <= $footer_sidebar_count; $count ++ ): ?>
						<div class="col-lg-<?php echo esc_attr( $col ); ?> col-md-<?php echo esc_attr( $col ); ?>  col-sm-6 col-xs-12 footer-<?php echo esc_attr($count); ?>">
							<?php if( $count == 1 ): ?>
								<?php if ( isset( $dentalcare_option['footer_logo']['url'] ) ): ?>
									<div class="footer_logo">
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $dentalcare_option['footer_logo']['url'] ); ?>"  alt="<?php bloginfo( 'name' ); ?>" /></a>
									</div>
									<?php elseif( $footer_logo ) : ?>
									<div class="footer_logo">
										<a href="<?php echo esc_url( home_url( '/' ) ) ?>">
											<img src="<?php echo esc_url( $footer_logo ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" />
										</a>
									</div>
								<?php endif; ?>
								<div class="empty-space marg-lg-b30"></div>
								<?php if( $footer_text = $dentalcare_option['footer_text'] ): ?>
									<div class="simple-text dark padding-sm">
										<p><?php echo esc_html( $footer_text ); ?></p>
										<?php if(isset($dentalcare_option['get-a-page']) && $dentalcare_option['get-a-page'] != '') { ?>
										<p><a href="<?php echo esc_url(get_permalink($dentalcare_option['get-a-page']));?>"><?php echo esc_attr( $dentalcare_option['read_more_title'] ); ?></a></p>
										<?php } ?>
									</div>
								<?php endif; ?>	
							<?php endif; ?>
							<?php dynamic_sidebar( 'dentalcare-footer-' . $count ); ?>
						</div>
					<?php endfor; ?>
				</div>			
			</div>
		</div>
		<?php endif; ?>
	<?php } ?>
	<?php } ?>
	<?php if( isset($dentalcare_option['copyright_switch']) && $dentalcare_option['copyright_switch'] == 1 ) { ?>
			<div class="tt-copy">
				<div class="container">
					<div class="row">
								<?php if( !empty( $dentalcare_option['footer_copyright'] ) ) { ?>
									<div class="col-sm-6">
										 <div class="tt-copy-left"><?php echo wp_kses_post( $dentalcare_option['footer_copyright'] ); ?></div>
									</div>
									<?php if( !empty( $dentalcare_option['copyright_right_switch'] ) ) { ?>
									<div class="col-sm-6">
										<?php if( isset($dentalcare_option['copy_right'] ) ): ?>
										<div class="tt-copy-right">
										<p>
											<?php echo wp_kses_post( $dentalcare_option['copy_right_first'] ); ?>
											<a href="<?php echo esc_url( $dentalcare_option['copy_right_link'] ); ?>"> <?php echo esc_attr( $dentalcare_option['copy_right'] ); ?>
											</a>
										</p>
										</div>
										<?php endif; ?>
									</div>
									<?php } ?>
								<?php } else { ?>
										<p class="copycenter"><?php echo esc_html__('Copyright &copy; 2017 dentalcare All rights reserved','dentalcare'); ?></p>
								<?php } ?>			 
					</div>
				</div>
			</div>
	<?php } ?>
	</footer>
</div>
<?php 
	$bttField = '';
		if(isset($dentalcare_option['top_back_button_one']))
	{
		$bttField =  $dentalcare_option['top_back_button_one'];
	}
?>
<?php 
	if( $bttField == 4){ ?>
		
	<?php } else if($bttField == 3){ ?>

			<div id="btt" class="mobileBtt"><i class="fa fa-angle-double-up"></i></div>
		
	<?php } else if($bttField == 2){ ?>

			<div id="btt" class="desktopBtt"><i class="fa fa-angle-double-up"></i></div>
				
	<?php } else { ?>

			<div id="btt"><i class="fa fa-angle-double-up"></i></div>
	
<?php } ?>	
<?php wp_footer(); ?>

</body>
</html>