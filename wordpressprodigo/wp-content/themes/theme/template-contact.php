<?php
/*
Template Name: Contact Form
*/
?>

<?php
$nameError = '';
$emailError = '';
$commentError = '';

//If the form is submitted
if(isset($_POST['submitted'])) {

	//Check to see if captcha field was filled in
	if(trim($_POST['checking']) !== '') {
		$captchaError = true;
	} else {

		//Check that the name field is not empty
		if(trim($_POST['contactName']) === '') {
			$nameError =  __( 'You forgot to enter your name.', 'studiopaul' );
			$hasError = true;
		} else {
			$name = trim($_POST['contactName']);
		}

		//Check that a valid email address is submitted
		if(trim($_POST['email']) === '')  {
			$emailError = __( 'You forgot to enter your email address.', 'studiopaul' );
			$hasError = true;
		} else if (!eregi( "^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
			$emailError = __( 'You entered an invalid email address.', 'studiopaul' );
			$hasError = true;
		} else {
			$email = trim($_POST['email']);
		}

		//Check to make sure the message were entered
		if(trim($_POST['comments']) === '') {
			$commentError = __( 'You forgot to enter your message', 'studiopaul' );
			$hasError = true;
		} else {
			if(function_exists( 'stripslashes')) {
				$comments = stripslashes(trim($_POST['comments']));
			} else {
				$comments = trim($_POST['comments']);
			}
		}

		//If there is no error, send the email
		if(!isset($hasError)) {

			$emailTo = of_get_option( 'vazz_contactform_email' );
			$subject = __( 'Contact Form Submission from ', 'studiopaul' ).$name;
			$sendCopy = trim($_POST['sendCopy']);
			$body = __( "Name: $name \n\nEmail: $email \n\nComments: $comments", 'studiopaul' );
			$headers = __( 'From: ', 'studiopaul') . "$name <$email>" . "\r\n" . __( 'Reply-To: ', 'studiopaul' ) . $email;

			wp_mail($emailTo, $subject, $body, $headers);

			$emailSent = true;

		}
	}
}
 ?>
<?php get_header(); ?>
<!-- SUBHEADER
================================================== -->
<div id="subheader" class="inshadow page">
	<div class="row">
		<div class="twelve columns">
			<p class="left">
				 <?php the_title(); ?>
			</p>
			<p class="right">
				 <?php echo get_post_meta($post->ID, 'sp_pagedesc', true); ?>
			</p>
		</div>
	</div>
</div>
<div class="minipause"></div>

<!-- CONTACT
================================================== -->
<div class="row">
<div class="twelve columns">
<script type="text/javascript">
<!--//--><![CDATA[//><!--
jQuery(document).ready(function() {
	jQuery( 'form#contactForm').submit(function() {
		jQuery( 'form#contactForm .error').remove();
		var hasError = false;
		jQuery( '.requiredField').each(function() {
			if(jQuery.trim(jQuery(this).val()) == '') {
				var labelText = jQuery(this).prev( 'label').text();
				jQuery(this).parent().append( '<span class="error"><?php _e( 'You forgot to enter your', 'studiopaul' ); ?> '+labelText+'.</span>' );
				jQuery(this).addClass( 'inputError' );
				hasError = true;
			} else if(jQuery(this).hasClass( 'email')) {
				var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
				if(!emailReg.test(jQuery.trim(jQuery(this).val()))) {
					var labelText = jQuery(this).prev( 'label').text();
					jQuery(this).parent().append( '<span class="error"><?php _e( 'You entered an invalid', 'studiopaul' ); ?> '+labelText+'.</span>' );
					jQuery(this).addClass( 'inputError' );
					hasError = true;
				}
			}
		});
		if(!hasError) {
			var formInput = jQuery(this).serialize();
			jQuery.post(jQuery(this).attr( 'action'),formInput, function(data){
				jQuery( 'form#contactForm').slideUp( "fast", function() {
					jQuery(this).before( '<div class="alert-box green"><?php _e( '<strong>Merci !</strong> Nous vous répondrons dans les plus brefs délais.', 'studiopaul' ); ?></div>' );
				});
			});
		}

		return false;

	});
});
//-->!]]>
</script>
	<?php if(isset($emailSent) && $emailSent == true) { ?>
		<p class="info"><?php _e( 'Your email was successfully sent.', 'studiopaul' ); ?></p>
	<?php } else { ?>
		<?php if (have_posts()) : ?>				
		<?php while (have_posts()) : the_post(); ?>				
					<?php the_content(); ?>
			<?php if(isset($hasError) || isset($captchaError) ) { ?>
				<p class="alert"><?php _e( 'There was an error submitting the form.', 'studiopaul' ); ?></p>
			<?php } ?>
			<?php if ( of_get_option( 'vazz_contactform_email') == '' ) { ?>
				<div class="seven columns noleftmargin alert-box default">
					Reminder: Go to your theme options and set your e-mail address. <a href="" class="close">x</a>
				</div><div class="clear"></div>
			<?php } ?>
			
			<form action="<?php the_permalink(); ?>" id="contactForm" method="post" class="twelve columns noleftmargin">
			<h5><?php _e( 'Envoyez-nous un mail', 'studiopaul' ); ?></h5>
				<ul class="forms">
				
					<li class="six columns noleftmargin"><label for="contactName"><?php _e( 'Nom (Société)', 'studiopaul' ); ?></label>
						<input type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo esc_attr( $_POST['contactName'] );?>" class="txt requiredField smoothborder"/>
						<?php if($nameError != '') { ?>
							<span class="error"><?php echo $nameError;?></span>
						<?php } ?>
					</li>
										
				
					<li class="six columns"><label for="email"><?php _e( 'Email', 'studiopaul' ); ?></label>
						<input type="text" name="email" id="email" value="<?php if(isset($_POST['email']))  echo esc_attr( $_POST['email'] );?>" class="txt requiredField email smoothborder"/>
						<?php if($emailError != '') { ?>
							<span class="error"><?php echo $emailError;?></span>
						<?php } ?>
					</li>
				
				
					<br/><br/><li class="clear textarea" style="margin-top:25px;"><label for="commentsText"><?php _e( 'Message', 'studiopaul' ); ?></label>
						<textarea name="comments" id="commentsText" rows="13" class="requiredField ctextarea smoothborder"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo esc_textarea( stripslashes($_POST['comments']) ); } else { echo esc_textarea( $_POST['comments'] ); } } ?></textarea>
						<?php if($commentError != '') { ?>
							<span class="error"><?php echo $commentError;?></span>
						<?php } ?>
					</li>					
					<li class="caspache"><label for="checking" class="caspache"><?php _e('Do not enter anything in this field', 'studiopaul') ?></label><input type="text" name="checking" id="checking" class="caspache" value="<?php if(isset($_POST['checking']))  echo esc_attr( $_POST['checking'] );?>" /></li>
					
					<li class="buttons" style="margin-top:15px;"><input type="hidden" name="submitted" id="submitted" value="true" /><input class="readmore" type="submit" value="<?php esc_attr_e( 'Submit', 'studiopaul' ); ?>" /></li>
				</ul>
			</form>			
			<?php endwhile; ?>
		<?php endif; ?>
	<?php } ?>
	</div>
</div><!-- /.row -->
<?php get_footer(); ?>