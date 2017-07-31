<?php
/**
 * The template for displaying search forms in studiopaul
 *
 * @package studiopaul
 * @since studiopaul 1.0
 */
?>

<form method="get" id="searchform" style="margin:0px" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
	<div class="row collapse">
		<div class="ten mobile-three columns">
			<input type="text" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" id="s" class="nomargin" placeholder="Search...">
		</div>
		<div class="two mobile-one columns">
			 <input type="submit" id="searchsubmit" class="postfix button expand" value="Go" />
		</div>
	</div>
</form>