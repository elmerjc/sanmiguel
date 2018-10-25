<?php global $dentalcare_option; ?>
<?php $stickyclass = '';
			if(isset($dentalcare_option['sticky_menu']) && $dentalcare_option['sticky_menu'] != 1 ) {
				$stickyclass = 'header_not_sticky';
			} ?>
			<header class="tt-header positionRelative <?php echo esc_attr($stickyclass); ?>">
				<?php if( !empty( $dentalcare_option['top_bar'] )): ?>
					<div class="top-line">
						<div class="container">
							<div class="top-line-inner clearfix">
								<div class="top-line-left">
									<?php if($dentalcare_option['topbar_address'] ): ?>
										<div class="top-info"><?php echo esc_html($dentalcare_option['topbar_address']); ?></div>
									<?php endif; ?>	
									<?php if($dentalcare_option['topbar_phone'] ): ?>
										<?php if(isset($dentalcare_option['topbar_phoneText'])): ?>
											<div class="top-info"><?php echo esc_html( $dentalcare_option['topbar_phoneText'] ); ?> <a href="<?php echo esc_html__('tel:','dentalcare'); echo esc_url($dentalcare_option['topbar_phone']);?>"><?php echo esc_attr( $dentalcare_option['topbar_phone'] ); ?></a></div>
										<?php endif; ?>	
									<?php endif; ?>	
								</div>							<?php if( !empty( $dentalcare_option['header_social'] ) && $dentalcare_option['header_social'] == '1'): ?>
								<?php if( !empty( $dentalcare_option['enable_social'] )): ?>
								<div class="top-line-right">
									<div class="top-info">
									<?php $socials = dentalcare_get_socials( 'enable_social' ); ?>	
										<?php if ( $socials): ?>
										<ul class="top-social">
										<?php foreach( $socials as $key => $val ): ?>
												<li>
													<a href="<?php echo esc_url( $val ); ?>" target="_blank" class="social-<?php echo esc_attr( $key ); ?>">
														<i class="fa fa-<?php echo esc_attr( $key ); ?>"></i>
													</a>
												</li>
											<?php endforeach; ?>
										</ul>
										<?php endif; ?>
									</div>
								</div> 
								<?php endif; ?>							<?php endif; ?>
							</div>
						</div>
					</div>
					<?php endif; ?>
				<div class="container">
					<div class="top-inner clearfix">
						<?php		
							$logo = get_template_directory_uri() .'/assets/images/tmp/logo_default.png';
							if ( isset( $dentalcare_option['logo_header_four']['url'] )):
							?>
							<a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $dentalcare_option['logo_header_four']['url'] ); ?>"  alt="<?php bloginfo( 'name' ); ?>" /></a>
							
							<?php elseif( $logo ) : 
							?>
								<a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $logo ); ?>"  alt="<?php bloginfo( 'name' ); ?>" /></a>
							
							<?php else: ?>
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
						<?php endif; ?>
						<div class="cmn-toggle-switch"><span></span></div>
					</div>
					<div class="toggle-block">
						<div class="toggle-block-container">
							<nav class="main-nav clearfix">
							
								<?php wp_nav_menu( array(
												'menu_id' => 'Primary',
												'theme_location' => 'dentalcare-primary_menu',
												'container'      => false,
												'depth'          => 3,
												'link_before'    => '<span>',
												'link_after'     => '<i class="menu-toggle fa fa-angle-down"></i></span>',
												'menu_class'     => 'dentalcare-menu'
											)
											); 
								?>						
							</nav>

							<div class="nav-more">
								<?php if(isset($dentalcare_option['get-a-quote']) && $dentalcare_option['get-a-quote'] != '') { ?>
								<a class="c-btn" href="<?php echo esc_url(get_permalink($dentalcare_option['get-a-quote']));?>"><?php echo get_the_title($dentalcare_option['get-a-quote']);?></a>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</header>