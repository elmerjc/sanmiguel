<?php dentalcare_get_header(); ?>
<div class="content-area">
	<?php
	while ( have_posts() ) {
		the_post(); ?>
				<div class="entry-content">
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

							if ( ! empty($dentalcare_option['detail_sidebar_position'])) {
								$sidebar_position = $dentalcare_option['detail_sidebar_position'];
							} else {
								$sidebar_position = 'right';
							} 	
							?>
						<?php 
						$dentalcare_layout = dentalcare_get_structure( $sidebar_id, $sidebar_type, $sidebar_position);
						echo wp_kses_post($dentalcare_layout['content_before']); ?>
						<div class="without_vc">
							<div class="tt-blog">
                                <div class="tt-blog-img custom-hover">
                                    <?php the_post_thumbnail( 'blog-large' ); ?>									<?php if(isset($dentalcare_option['blogdetail_metadata']) && $dentalcare_option['blogdetail_metadata'] == '1'){ ?>
										<?php if(isset($dentalcare_option['blogdetail_multi_checkbox']) && $dentalcare_option['blogdetail_multi_checkbox']['date'] == '1'){ ?>
											<span class="tt-blog-date"> <?php echo get_the_date("d"); ?> <?php echo get_the_date("M"); ?> <?php echo get_the_date("Y"); ?> </span>
										<?php } ?>									<?php } ?>
                                </div>
								<?php if(isset($dentalcare_option['blogdetail_metadata']) && $dentalcare_option['blogdetail_metadata'] == '1'){ ?>
                                <div class="tt-blog-info">
									<?php if(isset($dentalcare_option['blogdetail_multi_checkbox']) && $dentalcare_option['blogdetail_multi_checkbox']['author'] == '1'){ ?>
                                    <div class="tt-blog-label"><i class="fa fa-user" aria-hidden="true"></i><?php echo esc_html__('By:', 'dentalcare'); ?> <a href="<?php echo get_the_permalink(); ?>"> <?php the_author(); ?> </a></div>
									<?php } ?>
									<?php if(isset($dentalcare_option['blogdetail_multi_checkbox']) && $dentalcare_option['blogdetail_multi_checkbox']['tag'] == '1'){ ?>
                                    <div class="tt-blog-label tags"><i class="fa fa-tag" aria-hidden="true"></i><a href="<?php echo get_the_permalink(); ?>"> <?php echo implode( ', ', wp_get_post_tags( get_the_ID(), array( 'fields' => 'names' ) ) ) ?></a></div>
									<?php } ?>
									<?php if(isset($dentalcare_option['blogdetail_multi_checkbox']) && $dentalcare_option['blogdetail_multi_checkbox']['comment'] == '1'){ ?>
                                    <div class="tt-blog-label"><i class="fa fa-comments-o" aria-hidden="true"></i><?php echo esc_html__('Comments:', 'dentalcare'); ?> <a href="<?php comments_link(); ?>"><?php comments_number(); ?></a></div>
									<?php } ?>
                                </div>
								<?php } ?>
                                <div class="simple-text margin-blog">
                                    <?php the_content(); ?>
                                </div>
                            </div>
							<div class="empty-space marg-lg-b30 marg-xs-b50"></div>
							<?php
							wp_link_pages( array(
								'before'      => '<div class="page-links"><label>' . esc_html__( 'Pages:', 'dentalcare' ) . '</label>',
								'after'       => '</div>',
								'link_before' => '<span>',
								'link_after'  => '</span>',
								'pagelink'    => '%',
								'separator'   => '',
							) );
							?>
							<?php if ( comments_open() || get_comments_number() ) : ?>
								<div class="dentalcare_post_comments">
									<?php comments_template(); ?>
								</div>
							<?php endif; ?>
						</div>
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
				</div> <!-- #post-## -->		
	<?php } ?>
</div>
<?php get_footer(); ?>