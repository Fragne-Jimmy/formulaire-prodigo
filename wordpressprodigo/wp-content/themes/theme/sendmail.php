<?php require_once( '../../../wp-load.php' );

$sitename = get_bloginfo('name');
$siteurl =  get_home_url();

$to = isset($_POST['to_email'])?trim($_POST['to_email']):'';
$name = isset($_POST['name'])?trim($_POST['name']):'';
$email = isset($_POST['email'])?trim($_POST['email']):'';
$message = isset($_POST['message'])?trim($_POST['message']):'';

$error = false;
if($to === '' || $email === '' || $message === '' || $name === ''){
    $error = true;
}
if(!preg_match('/^[^@]+@[a-zA-Z0-9._-]+\.[a-zA-Z]+$/', $email)){
    $error = true;
}
if(!preg_match('/^[^@]+@[a-zA-Z0-9._-]+\.[a-zA-Z]+$/', $to)){
    $error = true;
}

if($error == true){
	echo '<div class="alert-box red">All fields are required<a href="" class="close">x</a></div>';
}

if($error == false){
    $subject = "$sitename's message from $name";
    $body = "Site: $sitename ($siteurl) \n\nName: $name \n\nEmail: $email \n\nMessages: $message";
    $headers = "From: $sitename <$to?>\r\nReply-To: $email";

    wp_mail($to, $subject, $body, $headers);
	
	echo '<div class="alert-box green">Your message has been sent!<a href="" class="close">x</a></div>';
}