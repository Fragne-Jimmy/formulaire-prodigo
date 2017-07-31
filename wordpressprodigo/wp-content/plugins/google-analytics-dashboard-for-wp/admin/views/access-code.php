<?php
/**
 * Author: Alin Marcu
 * Copyright 2017 Alin Marcu
 * Author URI: https://deconf.com
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */
?>
<form name="input" action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>" method="post">
	<table class="gadwp-settings-options">
		<tr>
			<td colspan="2" class="gadwp-settings-info">
						<?php echo __( "Use this link to get your access code:", 'google-analytics-dashboard-for-wp' ) . ' <a href="' . $data['authUrl'] . '" id="gapi-access-code" target="_blank">' . __ ( "Get Access Code", 'google-analytics-dashboard-for-wp' ) . '</a>.'; ?>
			</td>
		</tr>
		<tr>
			<td class="gadwp-settings-title">
				<label for="ga_dash_code" title="<?php _e("Use the red link to get your access code!",'google-analytics-dashboard-for-wp')?>"><?php echo _e( "Access Code:", 'google-analytics-dashboard-for-wp' ); ?></label>
			</td>
			<td>
				<input type="text" id="ga_dash_code" name="ga_dash_code" value="" size="61" required="required" title="<?php _e("Use the red link to get your access code!",'google-analytics-dashboard-for-wp')?>">
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<hr>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<input type="submit" class="button button-secondary" name="ga_dash_authorize" value="<?php _e( "Save Access Code", 'google-analytics-dashboard-for-wp' ); ?>" />
			</td>
		</tr>
	</table>
</form>
