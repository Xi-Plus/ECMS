<html>
<?php
include_once("../func/checklogin.php");
include_once("../func/sql.php");
include_once("../func/url.php");
include_once("../func/color_money.php");
?>
<head>
<meta charset="UTF-8">
<title>user-ECMS</title>
<?php
include_once("../res/meta.php");
meta();
?>
</head>
<body topmargin="0" leftmargin="0" bottommargin="0">
<?php
include_once("../res/header.php");
?>
<center>
<div style="display:none">
</div>
<table border="0" cellpadding="0" cellspacing="0">
<tr>
	<td class="headtd" colspan="2"></td>
</tr>
<tr>
	<td></td>
	<td width="50" rowspan="2"></td>
	<td>
		<h2>Record</h2>
	</td>
</tr>
<tr>
	<td align="right" valign="top">
		Index
		<hr>
		<form action="" method="get" id="form">
		<input name="index" type="number" value="<?php echo $_GET["index"]; ?>"><br>
		<input name="" type="submit" value="Search">
		</form>
	</td>
	<td width="300" valign="top">
		Index:
		<?php
		$people=mfa(SELECT("*","people",array(array("number",$_GET["index"]))));
		echo $_GET["index"];
		?>
		&nbsp;&nbsp;&nbsp;&nbsp;Name:
		<?php
		echo $people["name"];
		?>
		<hr>
		<table width="0" border="0" cellspacing="0" cellpadding="3">
		<tr>
			<td>date</td>
			<td>store</td>
			<td>charge</td>
			<td>balance</td>
		</tr>
		<?php
		$total_store=0;
		$total_charge=0;
		$total_balance=0;
		$row=SELECT("*","record",array(array("number",$_GET["index"])),array(array("date","DESC")),"all");
		while($temp=mfa($row)){
		?>
		<tr>
			<td align="right"><?php echo $temp["date"]; ?></td>
			<td align="right"><?php echo ($temp["store"]==0?"":$temp["store"]); ?></td>
			<td align="right"><?php echo ($temp["charge"]==0?"":$temp["charge"]) ?></td>
			<td align="right"><?php echo color_money($temp["balance"]); ?></td>
		</tr>
		<?php
			}
		?>
		</table>
	</td>
</tr>
</table>
</center>
</body>
</html>
