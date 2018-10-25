<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till 
 *
 * @package tmchampion
 */
global $dentalcare_option;
?>
<!DOCTYPE html>
<?php
	if(isset($dentalcare_option['rtl_switch']) && $dentalcare_option['rtl_switch']=='1')
	{
		$rtl = 'rtl';			
	}
	else
	{
		$rtl = '';
	}			
?>
<html <?php language_attributes(); ?> class="no-js" dir="<?php echo esc_attr($rtl); ?>">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ): ?>
	<link rel="icon" type="image/png" href="<?php echo esc_url($dentalcare_option['favicon_icon']['url']); ?>"/>
	<?php endif; ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php 
	if(isset($dentalcare_option['layout_style']) && $dentalcare_option['layout_style'] == '2') { 
			$class_name = 'boxed-container';
	} else { 
			$class_name = 'boxed-full';
	 } ?>
<div id="wrapper" class="<?php echo esc_attr($class_name); ?>">
	<div class="content_wrapper">
			<?php  			
				if(!empty($dentalcare_option['header_style']))
				{	
					$header = $dentalcare_option['header_style'];			
				}
				else 
				{
					$header ='dentalcare_header_1';
				}
				// Passing header value in header_layout function &call
				dentalcare_header_layout($header);
			?>	
		<div id="content-wrapper">		
			<?php 
			if ( ! is_front_page() && !is_page('home-two') && !is_page('home-three') && !is_page('home-four') && !is_page('home-five') && ! is_404() && !is_page('coming-soon') ) 
			{
				dentalcare_get_page_title();
			}
			$class = '';
			if (! is_404() ) 
			{
				$class = 'container main-wrapper';
			}
			 ?>	
		<div class="doctors <?php echo esc_attr($class); ?>">