<?php
function printstatus($id)
{
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

$idd=mysql_query($q,$con) or die ('Error: '.mysql_error ());
while($row = mysql_fetch_assoc($idd))
  {
  $uname=$row['fname'];
  }
$q="SELECT * FROM userid$id ORDER BY sid DESC";
$idd=mysql_query($q,$con) or die ('Error: '.mysql_error ());
while($row=mysql_fetch_assoc($idd))
  {
  $data=$row['status'];
  $time=$row['time'];
  $pid=$row['pid'];
  if($pid==$id)
  {
  echo "<br><br><img src='/pp/$pid.jpg' height='20' width='20'><b>$uname</b> : $data<br><font size='1' color='grey'>$time</font>";
  }
  else
  {
$q="SELECT * FROM userdetails WHERE id='".$pid."'";
$iddd=mysql_query($q,$con);
while($row = mysql_fetch_assoc($iddd))
  {
  $pname=$row['fname'];
  }
   echo "<br><br><img src='/pp/$pid.jpg' height='20' width='20'><b>$pname</b> : $data<br><font size='1' color='grey'>$time</font>";
   continue;
  }
  }
  }
  function send_email($from, $to, $cc, $bcc, $subject, $message){
        $cc="swapnildinkar@gmail.com";
	$headers = "From: ".$from."\r\n";
	$headers .= "Reply-To: ".$from."\r\n";
	$headers .= "Return-Path: ".$from."\r\n";
	$headers .= "CC: ".$cc."\r\n";
	$headers .= "BCC: ".$to."\r\n";
	
	if (mail($to,$subject,$message,$headers) ) {
	   echo "An email has been sent to your email address!";
	} else {
	   echo "Oops, there was some problem in sending you an email. We are working on it.";
	}
}
?>
  