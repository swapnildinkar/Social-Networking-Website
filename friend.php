<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Friends!</title>
<link rel="stylesheet" type="text/css" href="view.css" media="all">
</head>
<body id="main_body" >
<form method="get" action="/friend.php"><a href="/user.php">Profile</a><input type="text" width="10" name="fr" id="fr">
<input id="saveForm" class="button_text" type="submit" name="submit" value="Search" /><a href="/login.php">Logout</a></form>
<img id="top" src="top.png" alt="">
<?php
include 'fun.php';
$uid=$_COOKIE['user'];
if($uid==NULL){
?>
<h1>Ooops!</h1>
<div id="form_container">
<form>
<ul ><li>
You need to login to view this page!</h1><br/>
You are now being redirected, in case of any problems, <a href="/login.php">Click Here"</a></li></ul>
</form></div>
<script type="text/javascript">
<!--
setTimeout("window.location = '/login.php'",500);
-->
</script>
<?php
}
else{
$frusername=$_GET["fr"];
$con = mysql_connect("localhost","root","root");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
$q="SELECT * FROM userdetails WHERE username='".$frusername."'";
$db_selected = mysql_select_db('proj', $con);
if (!$db_selected) {
    die ('Can\'t use user : ' . mysql_error());
}
$idd=mysql_query($q,$con) or die ('Error: '.mysql_error ());
while($row = mysql_fetch_assoc($idd))
  {
  $id=$row['id'];
  }
  if($id==NULL){
?>
<h1>Ooops!</h1>
<div id="form_container">
	<form>
<ul ><li>
Sorry! Seems like we are not able to find this person.<br><br><a href="/user.php">Click Here</a> to go back.</h1><br/>
You will be redirected to your profile soon.</li></ul>
</form></div>
<script type="text/javascript">
<!--
setTimeout("window.location = '/user.php'",10000);
//-->
</script>
<?php
}
else{
$status=$_POST['status'];
if (isset($_REQUEST['submit']) && $status<>NULL)
{
$q="INSERT INTO userid$id(status,pid) VALUES ('$status','$uid')";
$ins=mysql_query($q,$con) or die ('Error: '.mysql_error ());
?>
<div id="form_container">
		<h1><a><?php echo $frusername; ?>'s Wall!</a></h1>
		<form id="form_152982" class="appnitro"  method="post" action="">
		<div class="form_description">
		<h2>Welcome!</h2>
		<p></p>
		</div>						
		<ul >
		<li id="li_1" >
		<label class="description" for="element_1"> </label>
		<div>
		<textarea id="status" name="status" class="element textarea small"></textarea> 
		</div><p class="guidelines" id="guide_1"><small>Say Hello!</small></p> 
		</li>
		<li class="buttons">
	    <input type="hidden" name="form_id" value="152982" />
		<input id="saveForm" class="button_text" type="submit" name="submit" value="Submit" />
		</form>	
<hr>
<li>
<?php
printstatus($id);
$tpcount=1;
}
else{
?>
	<div id="form_container">
		<h1><a><?php echo $frusername ?>'s Wall!</a></h1>
		<form id="form_152982" class="appnitro"  method="post" action="">
					<div class="form_description">
			<h2>Welcome!</h2>
			<p></p>
		</div>						
			<ul >
		<li id="li_1" >
		<label class="description" for="element_1"> </label>
		<div>
			<textarea id="status" name="status" class="element textarea small"></textarea> 
		</div><p class="guidelines" id="guide_1"><small>Update your status.</small></p> 
		</li>
				<li class="buttons">
			    <input type="hidden" name="form_id" value="152982" />
				<input id="saveForm" class="button_text" type="submit" name="submit" value="Submit" />
		</form>	
		<hr>
<li>	
<?php
printstatus($id);
}
}
}
?>
</li>
</ul>
</body>
</html>