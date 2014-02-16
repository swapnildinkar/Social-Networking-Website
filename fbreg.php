<?php
ob_start();
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
<?php
define('FACEBOOK_APP_ID', '134148819999828'); 
define('FACEBOOK_SECRET', '008a2dd816577020fde079e173c36c31'); 
function parse_signed_request($signed_request, $secret) 
{
list($encoded_sig, $payload) = explode('.', $signed_request, 2);
$sig = base64_url_decode($encoded_sig);
$data = json_decode(base64_url_decode($payload), true);
if (strtoupper($data['algorithm']) !== 'HMAC-SHA256')
{
error_log('Unknown algorithm. Expected HMAC-SHA256');
return null;
}

$expected_sig = hash_hmac('sha256', $payload, $secret, $raw = true);
if ($sig !== $expected_sig) 
{
error_log('Bad Signed JSON signature!');
return null;
}
return $data;
}
function base64_url_decode($input) 
{
return base64_decode(strtr($input, '-_', '+/'));
}
if ($_REQUEST) 
{
$response = parse_signed_request($_REQUEST['signed_request'],FACEBOOK_SECRET);
$name = $response["registration"]["name"];

$fname = $response["registration"]["first_name"];
$lname = $response["registration"]["last_name"];
$email = $response["registration"]["email"];
$password = $response["registration"]["password"];
$gender = $response["registration"]["gender"];
$dob = $response["registration"]["birthday"];
$username = $response["registration"]["username"];
$password=md5($password);
$date_year=substr($dob,6,4);
$date_day=substr($dob,3,2);
$date_month=substr($dob,0,2);
$dob=date("Y-m-d", mktime(0,0,0,$date_month,$date_day,$date_year));
mysql_connect("localhost","root","root");
mysql_select_db('proj');
$check = mysql_num_rows(mysql_query("SELECT * FROM userdetails WHERE username = '$username'")); 
if($check == 1){
echo "<p>Please choose a different username.We already have a friend by that name ..</p>";
echo "You will now be redirected back, in case of any problems, <a href='/fbconnect.php'>Click Here";
?>
<script type="text/javascript">
<!--
setTimeout("window.location = '/fbconnect.php'",2250);
//-->
</script>
<?php
}
$result = mysql_query("INSERT INTO userdetails (fname, lname, email, pass, sex, dob, username) VALUES ('$fname', '$lname', '$email', '$password', '$gender', '$dob', '$username')");
if($result){
$q="SELECT * FROM userdetails WHERE email='".$email."'";
$idd=mysql_query($q) or die ('Error: '.mysql_error ());
while($row = mysql_fetch_assoc($idd))
  {
  $id=$row['id'];
  }
  copy('pp.jpg',"pp/$id.jpg") or die("Something wrong with giving you a profile picture!");
setcookie("user",$id, (time()+(60*60*24*30)),"/");
$q="CREATE TABLE userid$id(status varchar(60000),time TIMESTAMP( 12 ) NOT NULL DEFAULT CURRENT_TIMESTAMP,sid INT( 12 ) NOT NULL AUTO_INCREMENT PRIMARY KEY,pid INT(20))";
$idd=mysql_query($q) or die ('Error: '.mysql_error ());
$message="Hello ".$fname."! Thank you for registering on Fritter! ";
send_email("Swapper Support",$email," "," ","Welcome to Fritter!",$message);
?>
<h1>Thank you</h1>
Your have been registered and an email has been sent to you.</h1><br/>
You are now being redirected, in case of any problems, <a href="/user.php">Click Here"</a>
<script type="text/javascript">
<!--
setTimeout("window.location = '/user.php'",1250);
//-->
</script>
<?php
}
else 
{
echo 'Something went wrong! We are working on it.';
}
}
else 
{
echo '$_REQUEST is empty';
}
?>
</div>
	<img id="bottom" src="bottom.png" alt="">
</body>
</html>	
<? ob_flush(); ?>