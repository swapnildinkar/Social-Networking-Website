<?php
$con = mysql_connect("localhost","lasagnia_admin","wegonna");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
$db_selected = mysql_select_db('lasagnia_user', $con);
if (!$db_selected) {
    die ('Can\'t use user : ' . mysql_error());
}
?>
<?php
session_start();
if (isset($_REQUEST['Button'])) 
{
$sqlquery = "SELECT email FROM userdetails WHERE email='".$_REQUEST['email']."'";
$result = mysql_query($sqlquery,$con) or die(“Query died: email”);
$num = mysql_num_rows($result); 
if($num > 0) 
{
$sql = “SELECT email FROM userdetails WHERE email=’$_POST[email]’ AND pass=md5(‘$_POST[pass]’)”;
$result2 = mysql_query($sql,$con) or die(“Query died: pass”);
$num2 = mysql_num_rows($result2); 
if($num2 > 0) //password matches 
{
$_SESSION[‘auth’]=”yes”; 
$_SESSION[‘logname’] = $_POST[‘email’]; 
//header(“Location: SecretPage.php”); 
}
else // password does not match 
{
$message_1=”The Login Name, ‘$_POST[email]’
exists, but you have not entered the
correct password! Please try again.”;
$email = strip_tags(trim($_POST[email]));
//include(“form_login_reg.inc”);
} 
} // end if $num > 0
elseif($num == 0) // login name not found 
{
$message_1 = “The User Name you entered does not
exist! Please try again.”;
//include(“form_login_reg.inc”);
}



}
else
{?>





<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head><title>Customer Login Page</title></head>
<div id='wrapper'> 
<div id='login'>
<form method="post" >
<fieldset style=’border: 2px solid #000000’>
<legend><b>Login Form</b></legend>
<div id=’field1’>
<label ><b>Email:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
<input id=’email’ name=’email’ type=’text’
value=’ ’ size=’20’ maxlength=’255’ />
</div><br>
<div id=’field2’>
<label ><b>Password:</label>
<input id=’pass’ name=’pass’ type="password"
 size=’20’ maxlength=’255’ />
</div><br>
<input type='submit' name='Button' 
style=’margin-left: 45%; margin-bottom: .5em’
value='Login' />
</fieldset>
</form>
<p style=’text-align: center; margin: 1em’>
If you already have an account, log in.</p>
<p style=’text-align: center; margin: 1em’>
If you do not have an account, <a href="/regform/index.php">Register now.</a></p>
</html>
<?php }?>