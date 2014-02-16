<?
ob_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Register</title>
<link rel="stylesheet" type="text/css" href="view.css" media="all">
<script type="text/javascript" src="view.js"></script>

</head>
<body id="main_body" >
	
	<img id="top" src="top.png" alt="">
	<center>
	<div id="form_container">
	
		<h1><a>Login</a></h1>
		
		<iframe allowtransparency='true' frameborder='no' height='600' scrolling='auto' src="http://www.facebook.com/plugins/registration.php?
client_id=134148819999828&
redirect_uri=http://lasagnia.x10.mx/fbreg.php?&
fields=
[
 {'name':'name'},
 {'name':'first_name'},
 {'name':'last_name'},
 {'name':'email'},
 {'name':'gender'},
 {'name':'birthday'},
 {'name':'username',      'description':'UserName',              'type':'text'},
 {'name':'password'},
 {'name':'captcha'}
 ]"
scrolling='auto'
frameborder='no' 
style='border: none;' 
width='500'
height='600'>
</iframe>
	</div>
	</center>
	<img id="bottom" src="bottom.png" alt="">
	</body>
</html>
<? ob_flush(); ?>