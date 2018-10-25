<?php global $dentalcare_option; ?>
<?php $stickyclass = '';
if(isset($dentalcare_option['sticky_menu']) && $dentalcare_option['sticky_menu'] != 1 ) {
	$stickyclass = 'header_not_sticky';
} ?>
<header id="header" class="header-5 mobileTwo">
	<?php if( !empty( $dentalcare_option['top_bar'] )): ?>
	<div class="top_bar">
		<div class="container">		
			<div class="thm-container clearfix">	
				<div class="row">
					<div class="col-md-6 col-sm-6">
						<div class="welcome-message">
							<?php if($dentalcare_option['header_two_message'] ): ?>
								<p><?php echo esc_html( $dentalcare_option['header_two_message'] ); ?></p>
							<?php endif; ?>	
						</div>
					</div>					<?php if( !empty( $dentalcare_option['header_social'] ) && $dentalcare_option['header_social'] == '1'): ?>
						<?php if( !empty( $dentalcare_option['enable_social'] )): ?>
							<div class="col-md-6 col-sm-6">
								<div class="social_icon">
									<?php $socials = dentalcare_get_socials( 'enable_social' ); ?>
									<?php if ( $socials): ?>
									<ul class="list-padd">
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
						<?php endif; ?>					<?php endif; ?>
			</div>				
			</div>		
		</div>
	</div>
	<?php endif; ?>
	<div class="header_top">
		<div class="container">	
			<div class="thm-container clearfix">
				<div class="logo pull-left">				
					<?php	
					$logo = get_template_directory_uri() .'/assets/images/tmp/logo_default.png';
						if ( isset( $dentalcare_option['logo_header_two']['url'] )):
					?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $dentalcare_option['logo_header_two']['url'] ); ?>"  alt="<?php bloginfo( 'name' ); ?>" /></a>
					<?php elseif( $logo ) : 
					?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $logo ); ?>"  alt="<?php bloginfo( 'name' ); ?>" /></a>
					<?php else: ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
					<?php endif; ?>
				</div>
				<div class="header-right-info pull-right">
				  <ul>
					<li>
					  <div class="single-header-right-info">
						<div class="icon-box"><i class="icon icon-Pointer"></i></div>
						<div class="text-box">			
						<?php if($dentalcare_option['top_address_one'] ): ?>
							<h5><?php echo esc_html( $dentalcare_option['top_address_one'] ); ?></h5>
						<?php endif; ?>	
						<?php if($dentalcare_option['top_address_two'] ): ?>
							<p><?php echo esc_html( $dentalcare_option['top_address_two'] ); ?></p>
						<?php endif; ?>
						</div>
					  </div>
					</li>
					<li>
					  <div class="single-header-right-info">
						<div class="icon-box"><i class="icon icon-Phone2"></i></div>
						<div class="text-box">			
						<?php if($dentalcare_option['top_contact_text'] ): ?>
							<h5><?php echo esc_html( $dentalcare_option['top_contact_text'] ); ?></h5><!-- <p></p> -->
						<?php endif; ?>
							<h5>&nbsp;</h5>
						</div>
					  </div>
					</li>
					<li>
					  <div class="single-header-right-info">
						<div class="icon-box"><img src="http://centroodontologicosanmiguel.pe/wp-content/uploads/2018/02/wp_icon.png" width="25px" alt="WhatsApp" title="WhatsApp"></div><!--<i class="icon icon-Phone2"></i>-->
						<div class="text-box">			
						<?php if($dentalcare_option['top_contact_num'] ): ?>
							<h5><?php echo esc_html( $dentalcare_option['top_contact_num'] ); ?></h5>
						<?php endif; ?>
							<h5>&nbsp;</h5>
						</div>
					  </div>
					</li>
					<li>
					  <div class="single-header-right-info">
						<div class="icon-box"><i class="icon icon-Timer"></i></div>
						<div class="text-box">
						<?php if($dentalcare_option['top_open_time'] ): ?>
							<h5><?php echo esc_html( $dentalcare_option['top_open_time'] ); ?></h5>
						<?php endif; ?>
						<?php if($dentalcare_option['top_open_text'] ): ?>
							<p><?php echo esc_html( $dentalcare_option['top_open_text'] ); ?></p>
						<?php endif; ?>
						</div>
					  </div>
					</li>
				  </ul>
				</div>
		  </div>
		</div>
	</div>
	<div id = "menuid" class="main_menu menu_fixed nav-home-three <?php echo esc_attr($stickyclass); ?>">
        <div class="container">
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nav_bg">
              <div class="navi">
                <div class="nav-menu pull-left text-left">
                  <div class="nav-t-holder pull-left text-left">
                    <div class="nav-t-header">
                      <div class="welcomeindex3"> 
	                  	<ul class="list-padd hidden-desktop hidden-tablet" >
							<li><a class="c-btn" style="background-color: #6770bb;" href="http://centroodontologicosanmiguel.pe/contacto/">Contacto</a></li>
						</ul>
					</div>
                      <button><i class="fa fa-bars"></i></button>
                    </div>
                    <div class="nav-t-footer" style="display: none;">
						<?php wp_nav_menu( 						array(
									'menu_id' => 'Primary',
									'theme_location' => 'dentalcare-primary_menu',
									'container'      => false,
									'depth'          => 3,
									'link_before'    => '<span>',
									'link_after'     => '</span>',
									'menu_class'     => 'nav'
								)
								); 
						?>  
						<div class="mobile-link" style="display:none;">    
							<ul class="list-padd">
								<li>
								<?php if(isset($dentalcare_option['get-a-quote']) && $dentalcare_option['get-a-quote'] != '') { ?>
									<a href="<?php echo esc_url(get_permalink($dentalcare_option['get-a-quote']));?>">
										<?php echo get_the_title($dentalcare_option['get-a-quote']);?>
									</a>
								<?php } ?>
								</li>
							</ul>
						</div>
                    </div>
                  </div>
                </div>
				<div class="nav-search pull-right text-right"> 
					<ul class="list-padd">
						<li>
							<?php if(isset($dentalcare_option['get-a-quote']) && $dentalcare_option['get-a-quote'] != '') { ?>
								<a href="<?php echo esc_url(get_permalink($dentalcare_option['get-a-quote']));?>">
									<?php echo get_the_title($dentalcare_option['get-a-quote']);?>
								</a>
							<?php } ?>
						</li>
					</ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
</header>