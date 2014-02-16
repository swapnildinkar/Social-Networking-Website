<?php
ob_start();
include 'formvalidator.php';
include 'fun.php';
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Edit Profile</title>
<script type="text/javascript" src="view.js"></script>
<script type="text/javascript" src="calendar.js"></script>
<link rel="stylesheet" type="text/css" href="view.css" media="all">
</head>
<body id="main_body" >
<img id="top" src="top.png" alt="">
<div id="form_container">
<h1><a>Edit Profile</a></h1>
<?php
$id=$_COOKIE['user'];
if($id==NULL){
?>
<img id="top" src="top.png" alt="">
<h1>Ooops!</h1>
<div id="form_container">
	<form>
<ul ><li>
You need to login to view this page!</h1><br/>
You are now being redirected, in case of any problems, <a href="/login.php">Click Here"</a></li></ul>
</form></div>
<script type="text/javascript">
<!--
setTimeout("window.location = '/login.php'",300);
-->
</script>
<?php
}
 define ("MAX_SIZE","100"); 
 function getExtension($str) {
         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }
 $errors=0;
 if(isset($_POST['Submit'])) 
 {
 	$image=$_FILES['image']['name'];
 	if ($image) 
 	{
 		$filename = stripslashes($_FILES['image']['name']);
 		$extension = getExtension($filename);
 		$extension = strtolower($extension);
 	if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif" )) 
 		{
 			echo '<h1>Unknown extension!</h1>';
 			$errors=1;
 		}
 		else
 		{
 		$size=filesize($_FILES['image']['tmp_name']);
if ($size > MAX_SIZE*1024)
{
	echo '<h1>You have exceeded the size limit!</h1>';
	$errors=1;
}
rename("pp/".$id.".jpg","pp/".$id.".old.jpg");
$image_name=$id.'.jpg';
$newname="pp/".$image_name;
$copied = copy($_FILES['image']['tmp_name'], $newname);
if (!$copied) 
{
	echo '<h1>Copy unsuccessfull!</h1>';
	$errors=1;
}}}}
$validator = new FormValidator();
$validator->addValidation("firstname","req","First Name ! .. you gotto have one ..");
$validator->addValidation("lastname","req","Tell us your last name please..");
$con = mysql_connect("localhost","root","root");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
$db_selected = mysql_select_db('proj', $con);
if (!$db_selected) {
    die ('Can\'t use user : ' . mysql_error());
}
if(isset($_REQUEST['Submit']) && $validator->ValidateForm())
{
$date=$_POST['element_4_1'];
$fname=$_POST['fname'];
$month=$_POST['element_4_2'];
$year=$_POST['element_4_3'];
$pass=md5($_POST['password']);
$sex=$_POST['gender'];
$tblname='"`lasagnia_user`.".$fname."statuses"';
$sql="UPDATE userdetails SET fname='".mysql_real_escape_string(stripslashes($_REQUEST['firstname']))."',lname='".mysql_real_escape_string(stripslashes($_REQUEST['lastname']))."' WHERE id=$id";
if($result = mysql_query($sql ,$con))
{
$q="SELECT * FROM userdetails WHERE email='".$email."'";
$idd=mysql_query($q,$con) or die ('Error: '.mysql_error ());
while($row = mysql_fetch_assoc($idd))
  {
  $id=$row['id'];
  }
}
?>
<h1>You have successfully edited your profile.</h1>
<br/>
You are now being redirected, in case of any problems, <a href="/user.php">Click Here"</a>
<script type="text/javascript">
<!--
setTimeout("window.location = '/user.php'",1250);
//-->
</script>
<?php
}
elseif(isset($_REQUEST['Submit']) && (!$validator->ValidateForm()))
{
echo "<B>Ooops .. We found some errors processing your form ..</B>";
    $error_hash = $validator->GetErrors();
     echo "<p><font color='red'>";
    foreach($error_hash as $inpname => $inp_err)
    {
       echo "<p>$inp_err</p>\n";
    }
   
    echo "</font>";
?>
<form id="form" class="appnitro"  method="post" enctype="multipart/form-data" >
			<div class="form_description">
			<h2><b>Edit Profile</b></h2>
		</div>						
			<ul>
			<h3><b><u>Personal Details</b></u></h3>
			<p></p>
		</li>		<li id="li_2" >
		<label class="description" for="element_2">Name </label>
		<span>
			<input id="firstname" name= "firstname" class="element text" maxlength="255" size="8" value=""/>
			<label>First</label>
		</span>
		<span>
			<input id="lastname" name= "lastname" class="element text" maxlength="255" size="14" value=""/>
			<label>Last</label>
		</span> 
		</li>	
		<h3><b><u>Profile Picture</b></u></h3>
		<li id="li_2">
			<input type="file" name="image" id="image" /> 
		</li>
			<input type="submit" name="Submit" value="Submit">	
			</ul>
		</form>	

<?php
}
else
{
?> 
			<form id="form" class="appnitro"  method="post" enctype="multipart/form-data" >
			<div class="form_description">
			<h2><b>Edit Profile</b></h2>
		</div>						
			<ul>
			<h3><b><u>Personal Details</b></u></h3>
			<p></p>
		</li>		<li id="li_2" >
		<label class="description" for="element_2">Name </label>
		<span>
			<input id="firstname" name= "firstname" class="element text" maxlength="255" size="8" value=""/>
			<label>First</label>
		</span>
		<span>
			<input id="lastname" name= "lastname" class="element text" maxlength="255" size="14" value=""/>
			<label>Last</label>
		</span> 
		</li>	
		<h3><b><u>Profile Picture</b></u></h3>
		<li id="li_2">
			<input type="file" name="image" id="image" /> 
		</li>
			<input type="submit" name="Submit" value="Submit">	
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
	