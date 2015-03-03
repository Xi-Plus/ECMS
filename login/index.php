<html>
<?php
include_once("../func/checklogin.php");
include_once("../func/sql.php");
include_once("../func/url.php");
include_once("../func/log.php");
$error="";
$message="";
$noshow=true;
$nosignup=true;
if(checklogin()){
	$message="You have logged in";
	$noshow=false;
	?><script>setTimeout(function(){location="../";},1000)</script><?php
}else if(checkpassword($_POST["pwd"])){
	$message="Login success";
	setcookie("ECMSadmin",md5($_POST["pwd"]),time()+86400*7,"/");
	?><script>setTimeout(function(){location="../";},1000)</script><?php
}else if(isset($_POST["pwd"])){
	$error="Wrong password";
}
?>
<head>
<meta charset="UTF-8">
<title>login-ECMS</title>
<?php
include_once("../res/meta.php");
meta();
?>
</head>
<body Marginwidth="-1" Marginheight="-1" Topmargin="0" Leftmargin="0">
<?php
	include_once("../res/header.php");
	if($error!=""){
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td align="center" valign="middle" bgcolor="#F00" class="message"><?php echo $error;?></td>
	</tr>
</table>
<?php
	}
	if($message!=""){
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td align="center" valign="middle" bgcolor="#0A0" class="message"><?php echo $message;?></td>
	</tr>
</table>
<?php
	}
	if($noshow){
?>
<center>
<form method="post">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
	<td class="headtd" colspan="2"></td>
</tr>
<tr>
	<td align="center" colspan="2"><h2>Login as admin</h2></td>
</tr>
	<td valign="top">Password:</td>
	<td valign="top"><input name="pwd" type="password"></td>
</tr>
<tr>
	<td colspan="2" align="center" valign="top"><input type="submit" value="Login"></td>
</tr>
</table>
</form>
</center>
<?php
	}
?>
</body>
</html>