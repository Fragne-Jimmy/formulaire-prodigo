<?php
/**
 * The Sidebar for pages.
 *
 * @package studiopaul
 * @since studiopaul 1.0
 */
?>
<div class="four columns">
<aside>				
	<?php if ( is_active_sidebar( 'Page' ) ) : ?>
		<?php dynamic_sidebar( 'Page' ); ?>
	<?php else : ?>
		<!-- This content shows up if there are no widgets defined in the backend. -->
		<?php if(current_user_can('edit_theme_options')) : ?>
		<div class="help">			
			<p>
				<?php _e("Please add some widgets in Page area or edit this page and choose a full width template.", "studiopaul"); ?>					
				<a href="<?php echo admin_url('widgets.php')?>" class="add-widget"><?php _e("Add Widget", "studiopaul"); ?></a>					
			</p>			
		</div>
		<?php endif ?>
	<?php endif; ?>
</aside>
</div><!-- .four columns -->