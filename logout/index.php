<html>
<?php
include_once("../func/checklogin.php");
include_once("../func/sql.php");
include_once("../func/url.php");
include_once("../func/log.php");
	setcookie("ECMSadmin","",time(),"/");
?>
<script>setTimeout(function(){location="../";},1000)</script>
<head>
<meta charset="UTF-8">
<title>logout-ECMS</title>
<?php
include_once("../res/meta.php");
meta();
?>
</head>
<body Marginwidth="-1" Marginheight="-1" Topmargin="0" Leftmargin="0">
<?php
	include_once("../res/header.php");
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td align="center" valign="middle" bgcolor="#0A0" class="message">Logout success</td>
	</tr>
</table>
</body>
</html>