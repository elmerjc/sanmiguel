<div class="tt-search">
<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="text" value="<?php if (is_search()) { echo get_search_query(); } ?>" name="s" placeholder="<?php echo esc_html__( 'Enter Search Keywords', 'dentalcare'); ?>" required />
	<div class="tt-search-submit">
		<i class="fa fa-search" aria-hidden="true"></i>
		<input type="submit" value="">
	</div>
</form>
</div>