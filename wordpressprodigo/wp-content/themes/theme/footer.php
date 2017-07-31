<?php
/**
 * The template for displaying the footer.
 *
 * @package studiopaul
 * @since studiopaul 1.0
 */
?>

<!-- FOOTER
================================================== -->
<div id="footer">
	<footer class="row">
	<p class="back-top floatright" style="display: block; ">
		<a href="#top"><span></span></a>
	</p>
	
	<?php if ( is_active_sidebar( 'footer-sidebar' ) ) : ?>
		<?php dynamic_sidebar( 'footer-sidebar' ); ?>
			<?php else : ?>
			<!-- This content shows up if there are no widgets defined in the backend. -->						
			<div class="four columns">						
				<!-- This content shows up if there are no widgets defined in the backend. -->			
				<div class="help">							
					<p>
						<?php _e("Hello, activate some Widgets!", "studiopaul"); ?>
						<?php if(current_user_can('edit_theme_options')) : ?>
						<a href="<?php echo admin_url('widgets.php')?>" class="add-widget"><?php _e("Add Widget", "studiopaul"); ?></a>
						<?php endif ?>
					</p>							
				</div>						
			</div>
	<?php endif; ?>	
	</footer>
</div>
<!-- COPYRIGHT
================================================== -->
<div class="copyright">
	<div class="row">
		<div class="six columns">
			<div class="small"> 
			<?php echo of_get_option('vazz_footer_copyright_left')  ?>
			</div>
		</div>
		<div class="six columns">
			<div class="small right"> 
			<?php echo of_get_option('vazz_footer_copyright_right')  ?>
			</div>
		</div>
	</div>
</div>

<?php wp_footer();
    echo '<script type="text/javascript">';
    echo of_get_option('vazz_stats');
    echo '</script>';
?>
</body>
</html>