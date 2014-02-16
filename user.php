<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Your Profile</title>
<link rel="stylesheet" type="text/css" href="view.css" media="all">

</head>
<body >
<div id="nav">
<a href="/user.php">Home</a> | <a href="/edit.php">Edit Profile</a> | <a href="/login.php">logout</a>
</div>

 <form method="get" action="/friend.php"><input type="text" width="10" name="fr" id="fr"><input id="saveForm" class="button_text" type="submit" name="submit" value="Search" /></form>
<?php
include 'fun.php';
      
$id=$_COOKIE['user'];
if($id==NULL){
?>

<img id="top" src="top.png" alt="">
<h1>Ooops!</h1>
<div id="form_container">
	<form>
<ul ><li>
You need to login to view this page!</h1><br/>
You are now being redirected, in case of any problems, <a href="/login.php">Click Here</a></li></ul>
</form></div>
<script type="text/javascript">
<!--
setTimeout("window.location = '/login.php'",800);
-->
</script>

<?php
}
else{
$con = mysql_connect("localhost","root","root");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
$db_selected = mysql_select_db('proj', $con);
if (!$db_selected) {
    die ('Can\'t use user : ' . mysql_error());
}

$q="SELECT * FROM userdetails WHERE id='".$id."'";

$idd=mysql_query($q) or die ('Error: '.mysql_error ());
while($row = mysql_fetch_assoc($idd))
  {
  $uname=$row['fname'];
  }
if (isset($_REQUEST['submit'])) { 
$status=$_POST['status'];

$q="INSERT INTO userid$id(status,pid) VALUES ('$status','$id')";
$ins=mysql_query($q,$con) or die ('Error: '.mysql_error ());
?>

<img id="top" src="top.png" alt="">
<div id="form_container">
	
		<h1><a>Welcome!</a></h1>
		<form id="form_152982" class="appnitro"  method="post" action="">
					<div class="form_description">
			<h2>Welcome <?php
				echo $uname;
  			?>!</h2>
		</div>						
		<ul>
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
else{
?>
	
<img id="top" src="top.png" alt="">
	<div id="form_container">
	
		<h1><a>Welcome!</a></h1>
		<form id="form_152982" class="appnitro"  method="post" action="">
					<div class="form_description">
			<h2>Welcome <?php
		
  echo $uname;
  
  
?>!</h2>
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
?>
</li>
</ul>
</body>
</html>