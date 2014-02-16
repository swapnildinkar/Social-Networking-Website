<?
ob_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Login</title>
<link rel="stylesheet" type="text/css" href="view.css" media="all">
<script type="text/javascript" src="view.js"></script>

</head>
<body id="main_body" >
	
	<img id="top" src="top.png" alt="">
	<div id="form_container">
	
		<h1><a>Login</a></h1>
<?php
$con = mysql_connect("localhost","root","root");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
if (isset($_REQUEST['submit'])) {
$un=$_POST['un'];
$pw=md5($_POST['pw']);
$q="SELECT * FROM userdetails WHERE pass='".$pw."' AND username='".$un."'";
$db_selected = mysql_select_db('proj', $con);
if (!$db_selected) {
    die ('Can\'t use user : ' . mysql_error());
}
$idd=mysql_query($q,$con) or die ('Error: '.mysql_error ());

$check = mysql_num_rows($idd);
if($check)
{

while($row = mysql_fetch_assoc($idd))
  {
  $id=$row['id'];
  $fn=$row['fname'];
  }
setcookie("user",$id, (time()+(60*60*24*30)),"/");


 ?>
 
You have been logged in <?echo "Welcome ".$fn;?>.</h1><br/>
You are now being redirected, in case of any problems, <a href="/user.php">Click Here.</a>
<script type="text/javascript">
<!--
setTimeout("window.location = '/user.php'",1250);
//-->
</script>
<?php
}
else
{ echo "<font color='red'><center>Invalid ID or Password! Please try again.</center></font>";
?>
<form id="form_153550" class="appnitro"  method="post" action="">
					<div class="form_description">
			<h2>Login</h2>
			<p>Login to access your profile.</p>
		</div>						
			<ul >
			
					<li id="li_1" >
		<label class="description" for="element_1">Username  </label>
		<div>
			<input id="un" name="un" class="element text small" type="text" maxlength="255" value=""/> 
		</div><p class="guidelines" id="guide_1"><small>Enter the username you chose during registration.</small></p> 
		</li>		<li id="li_3" >
		<label class="description" for="element_3">Password </label>
		<div>
			<input id="pw" name="pw" class="element text small" type="password" maxlength="255" value=""/> 
		</div><p class="guidelines" id="guide_3"><small>Shshhhhh.....</small></p> 
		</li>
			
					<li class="buttons">
			    <input type="hidden" name="form_id" value="153550" />
			    
				<input id="saveForm" class="button_text" type="submit" name="submit" value="submit" />
		</li>
		Not registered? <a href="/reg.php">Click Here</a> to register.
			</ul>
		</form>	
<?php
}
}else
{
setcookie ("user", "", time() - 3600);
?> 	<form id="form_153550" class="appnitro"  method="post" action="">
					<div class="form_description">
			<h2>Login</h2>
			<p>Login to access your profile.</p>
		</div>						
			<ul >
			
					<li id="li_1" >
		<label class="description" for="element_1">Username  </label>
		<div>
			<input id="un" name="un" class="element text small" type="text" maxlength="255" value=""/> 
		</div><p class="guidelines" id="guide_1"><small>Enter the username you chose during registration.</small></p> 
		</li>		<li id="li_3" >
		<label class="description" for="element_3">Password </label>
		<div>
			<input id="pw" name="pw" class="element text small" type="password" maxlength="255" value=""/> 
		</div><p class="guidelines" id="guide_3"><small>Shshhhhh.....</small></p> 
		</li>
			
					<li class="buttons">
			    <input type="hidden" name="form_id" value="153550" />
			    
				<input id="saveForm" class="button_text" type="submit" name="submit" value="submit" />
		</li>
		Not registered? <a href="/reg.php">Click Here</a> to register.
			</ul>
		</form>	
		
		<?php
		}
		?>
	</div>
	<img id="bottom" src="bottom.png" alt="">
	</body>
</html>
<? ob_flush(); ?>