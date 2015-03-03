<?php
include_once("../func/url.php");
include_once("../func/checklogin.php");
include_once("../func/sql.php");
?>
<script src="../res/jquery.min.js"></script>
<script>
/*
function keyFunction(){
	if ((event.altKey) && (event.keyCode!=18)){
		switch(event.keyCode){
			case 49: location="../data";break;
			case 50: location="../search";break;
			case 51: location="../user";break;
			<?php
			if(checklogin()){
			?>
			case 52: location="../borrow";break;
			case 53: location="../return";break;
			case 54: location="../managebook";break;
			case 55: location="../manageuser";break;
			case 56: location="../log";break;
			<?php
			}
			?>
			case 48: location="../<?php echo ($login?"logout":"login");?>";break;
		}
	}
}
window.onkeydown=keyFunction;
document.onkeydown=keyFunction;
*/
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="100%" height="80" align="center" valign="middle" style="font-weight: bold;">
			<span style="font-size: 36px; color: #888;">E-</span><span style="font-size: 36px; color: #FFF;">CM</span><span style="font-size: 36px; color: #888;">S</span><br>
			<span style="color: #999">E-Class Management System</span><br>
			<span style="color: #999">電子化班級管理系統</span>
		</td>
	</tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td height="20" valign="middle" bgcolor="#444" style="color: #ccc">
			<div style="float:left;">&nbsp;&nbsp;&nbsp;&nbsp;<a href="../home" target="_parent">Home</a>&nbsp;|&nbsp;<a href="../balance" target="_parent">Balance</a>&nbsp;|&nbsp;<span style="color: #aaa">[Record]</span>&nbsp;<a href="../record" target="_parent">Day</a>&nbsp;|&nbsp;<a href="../user" target="_parent">Person</a></div><?php if(checklogin()){ ?><div style="float:left;">&nbsp;|&nbsp;<span style="color: #aaa">[Manage]</span>&nbsp;<a href="../store" target="_parent">Store</a>&nbsp;|&nbsp;<a href="../charge" target="_parent">Charge</a>&nbsp;|&nbsp;<a href="../people" target="_parent">User</a>&nbsp;|&nbsp;<a href="../log" target="_parent">Log</a>&nbsp;|&nbsp;<a href="../password" target="_parent">Password</a></div>
			<?php } ?>
		</td>
		<td height="20" valign="middle" bgcolor="#444" style="text-align: right; color: #FFF;">
			<?php 
			if(checklogin()){
			?>
				Already Login
				<a href="../logout" target="_parent">Logout</a>
			<?php
			}
			else{
			?>
				<a href="../login" target="_parent">Login as admin</a>
			<?php
			}
			?>
			&nbsp;&nbsp;
		</td>
	</tr>
</table>