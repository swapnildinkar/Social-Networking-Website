<?php
ob_start();
include 'formvalidator.php';
include 'fun.php';
?> 


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Register</title>
<script type="text/javascript" src="view.js"></script>
<script type="text/javascript" src="calendar.js"></script>
<link rel="stylesheet" type="text/css" href="view.css" media="all">
</head>
<body id="main_body" >
<img id="top" src="top.png" alt="">
<div id="form_container">
<h1><a>New User Registration</a></h1>
<?php
$validator = new FormValidator();
$validator->addValidation("firstname","req","First Name ! .. you gotto have one ..");
$validator->addValidation("lastname","req","Tell us your last name please..");
$validator->addValidation("email","email","Email isnt valid! .. cant help it ..");
$validator->addValidation("password","req","Please enter a password .. and dont tell it even to your dog!");
$validator->addValidation("password","minlen=6","Minimum length of your password should be 6");
$validator->addValidation("gender","selone","You need to select a gender .. ! :o");
$validator->addValidation("password","maxlen=16","Maximum length of your password should be 16, any longer and we will forget .. :(");
$validator->addValidation("email","req","Please enter a password .. and dont tell it even to your dog!");
$validator->addValidation("username","req","Please enter a password .. and dont tell it even to your dog!");
$validator->addValidation("date","req","Please enter a date.");
$validator->addValidation("month","req","Please enter a month.");
$validator->addValidation("year","req","Please enter a year.");



$con = mysql_connect("localhost","root","root");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
$db_selected = mysql_select_db('proj', $con);
if (!$db_selected) {
    die ('Can\'t use user : ' . mysql_error());
}

$input_value=$_POST['username'];



$check = mysql_num_rows(mysql_query("SELECT * FROM userdetails WHERE username = '$input_value'")); 
if($check == 1){
$uvalid=false;
}
else{
$uvalid=true;
}


$input_values=$_POST['email'];

$checks = mysql_num_rows(mysql_query("SELECT * FROM userdetails WHERE email = '$input_values'")); 
if($checks == 1){
$evalid=false;
}
else{
$evalid=true;
}

if(isset($_REQUEST['Submit']) && $validator->ValidateForm() &&  $uvalid==true && $evalid==true)
{
$date=$_POST['element_4_1'];
$email=$_POST['email'];
$fname=$_POST['fname'];
$month=$_POST['element_4_2'];
$year=$_POST['element_4_3'];
$pass=md5($_POST['password']);
$sex=$_POST['gender'];
$sql="INSERT INTO userdetails(username,fname,lname,email,dob,pass,sex) VALUES ('".mysql_real_escape_string(stripslashes($_REQUEST['username']))."','".mysql_real_escape_string(stripslashes($_REQUEST['firstname']))."','".mysql_real_escape_string(stripslashes($_REQUEST['lastname']))."','".mysql_real_escape_string(stripslashes($_REQUEST['email']))."','".mysql_real_escape_string($year.'-'.$month.'-'.$date)."','".mysql_real_escape_string($pass)."','".mysql_real_escape_string($sex)."')";
if($result = mysql_query($sql ,$con))
{
$q="SELECT * FROM userdetails WHERE email='".$email."'";
$idd=mysql_query($q,$con) or die ('Error: '.mysql_error ());
while($row = mysql_fetch_assoc($idd))
  {
  $id=$row['id'];
  }
  copy('pp.jpg',"pp/$id.jpg") or die("Unable to copy $old to $new.");
setcookie("user",$id, (time()+(60*60*24*30)),"/");
}
$q="CREATE TABLE userid$id(status varchar(60000),time TIMESTAMP( 12 ) NOT NULL DEFAULT CURRENT_TIMESTAMP,sid INT( 12 ) NOT NULL AUTO_INCREMENT PRIMARY KEY,pid INT(20))";
$idd=mysql_query($q,$con) or die ('Error: '.mysql_error ());
$message="Hello ".$fname."! You are now all set to have fun!";
send_email("Swapper Support",$email," "," ","Welcome to Swapper!",$message);
?>

<h1>Thank you</h1>
Your have been registered and an email has been sent to you.</h1><br/>
You are now being redirected, in case of any problems, <a href="/user.php">Click Here</a>
<script type="text/javascript">
<!--
setTimeout("window.location = '/user.php'",1250);
//-->
</script>


<?php
}
elseif(isset($_REQUEST['Submit']) && (!$validator->ValidateForm() || $uvalid==false || $evalid==false))
{
echo "<B>Ooops .. We found some errors processing your form ..</B>";
    $error_hash = $validator->GetErrors();
     echo "<p><font color='red'>";
    foreach($error_hash as $inpname => $inp_err)
    {
       echo "<p>$inp_err</p>\n";
    }
    if($uvalid==false)
    {
    	echo "<p>Please choose a different username.We already have a friend by that name ..</p>";
    }
    if($evalid==false)
    {
    	echo "<p>Please choose a different Email.</p>";
    }
    echo "</font>";
?>
<form id="form" class="appnitro"  method="post" >
					<div class="form_description">
			<h2><b>User Registration Form</b></h2>
			
		</div>						
			<ul >
			
					
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
		</li>		<li id="li_4" >
		<label class="description" for="element_4">Date of Birth </label>
		<span>
			<input id="element_4_1" name="element_4_1" class="element text" size="2" maxlength="2" value="" type="text"> /
			<label for="element_4_1">DD</label>
		</span>
		<span>
			<input id="element_4_2" name="element_4_2" class="element text" size="2" maxlength="2" value="" type="text"> /
			<label for="element_4_2">MM</label>
		</span>
		<span>
	 		<input id="element_4_3" name="element_4_3" class="element text" size="4" maxlength="4" value="" type="text">
			<label for="element_4_3">YYYY</label>
		</span>
	
		<span id="calendar_4">
		
			<!--<img id="cal_img_1" class="datepicker" src="images/calendar.gif" alt="Pick a date.">	-->
			<img id="cal_img_4" class="datepicker" src="calendar.gif" alt="Pick a date.">	
		</span>
		<script type="text/javascript">
			Calendar.setup({
			inputField: "element_4_3",
			baseField:"element_4",
			displayArea:"calendar_4",
			button: "cal_img_4",
			ifFormat: "%B %e, %Y",
			onSelect:selectDate
			});
		</script>
		 
		</li>		<li id="li_1" >
		<label class="description" for="element_1">Username </label>
		<div>
			<input id="username" name="username" class="element text medium" type="text" maxlength="255" value=""/> 
		</div> <p class="guidelines" id="guide_1"><small>What should we call you?</small></p>
		</li>		<li id="li_3" >
		<label class="description" for="element_3">Email </label>
		<div>
			<input id="email" name="email" class="element text medium" type="text" maxlength="255" value=""/> 
		</div> 
		</li>		
<li id="li_9" >
		<label class="description" >Password </label>
		<div>
			<input id="password" name="password" class="element text medium" type="password" maxlength="255" value=""/> 
		</div> 
		</li>		

<li id="li_7" >
		<label class="description" >Sex :</label>
		<span>
			<input id="gender" name="gender" class="element radio" type="radio" value="0" />
<label class="choice" for="gender">Male</label>
<input id="element_7_2" name="gender" class="element radio" type="radio" value="1" />
<label class="choice" for="element_7_2">Female</label>

		</span> 
		</li>
			<input type="submit" name="Submit" value="Submit">	
			<br>Already registered? <a href="/login.php">Login Here</a>.
			</ul>
		</form>	
<?php
}
else
{

?> 
	
		<form id="form" class="appnitro"  method="post" >
					<div class="form_description">
			<h2><b>User Registration Form</b></h2>
			
		</div>						
			<ul >
			
					
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
		</li>		<li id="li_4" >
		<label class="description" for="element_4">Date of Birth </label>
		<span>
			<input id="element_4_1" name="element_4_1" class="element text" size="2" maxlength="2" value="" type="text"> /
			<label for="element_4_1">DD</label>
		</span>
		<span>
			<input id="element_4_2" name="element_4_2" class="element text" size="2" maxlength="2" value="" type="text"> /
			<label for="element_4_2">MM</label>
		</span>
		<span>
	 		<input id="element_4_3" name="element_4_3" class="element text" size="4" maxlength="4" value="" type="text">
			<label for="element_4_3">YYYY</label>
		</span>
	
		<span id="calendar_4">
			<img id="cal_img_4" class="datepicker" src="calendar.gif" alt="Pick a date.">	
		</span>
		<script type="text/javascript">
			Calendar.setup({
			inputField	 : "element_4_3",
			baseField    : "element_4",
			displayArea  : "calendar_4",
			button		 : "cal_img_4",
			ifFormat	 : "%B %e, %Y",
			onSelect	 : selectDate
			});
		</script>
		 
		</li>		<li id="li_1" >
		<label class="description" for="element_1">Username </label>
		<div>
			<input id="username" name="username" class="element text medium" type="text" maxlength="255" value=""/> 
		</div> <p class="guidelines" id="guide_1"><small>What should we call you?</small></p>
		</li>		<li id="li_3" >
		<label class="description" for="element_3">Email </label>
		<div>
			<input id="email" name="email" class="element text medium" type="text" maxlength="255" value=""/> 
		</div> 
		</li>		
<li id="li_9" >
		<label class="description" >Password </label>
		<div>
			<input id="password" name="password" class="element text medium" type="password" maxlength="255" value=""/> 
		</div> 
		</li>		

<li id="li_7" >
		<label class="description" >Sex :</label>
		<span>
			<input id="gender" name="gender" class="element radio" type="radio" value="0" />
<label class="choice" for="gender">Male</label>
<input id="element_7_2" name="gender" class="element radio" type="radio" value="1" />
<label class="choice" for="element_7_2">Female</label>

		</span> 
		</li>
			<input type="submit" name="Submit" value="Submit">	
			<br>Already registered? <a href="/login.php">Login Here</a>.
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
	