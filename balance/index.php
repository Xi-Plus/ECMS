<html>
<?php
include_once("../func/checklogin.php");
include_once("../func/sql.php");
include_once("../func/url.php");
include_once("../func/color_money.php");
?>
<head>
<meta charset="UTF-8">
<title>balance-ECMS</title>
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
		<h2>Balance</h2>
	</td>
</tr>
<tr>
	<td align="right" valign="top">
		Sort By<br>
		<hr>
		<form action="" method="get" id="form"><input name="sort" type="hidden" id="sort" value=""></form>
			<a onclick="sort.value='index';form.submit();">index</a><br>
			<a onclick="sort.value='money';form.submit();">money</a><br>
			<a onclick="sort.value='rmoney';form.submit();">Anti-money</a>
	</td>
	<td width="600" valign="top">
		Last updated:
		<?php
		$temp=mfa(SELECT(array("MAX(`date`) as `previousdate`"),"record"));
		echo $temp["previousdate"];
		/*$temp=mfa(SELECT("*","setting",array(array("name","update"))));
		echo $temp["value"];*/
		?>
		&nbsp;&nbsp;&nbsp;&nbsp;Actual balance:
		<?php
		$row=SELECT("*","people",null,array(array("number")),"all");
		$total=0;
		while($temp=mfa($row)){
			$money[]=$temp;
			$total+=$temp["money"];
		}
		$temp=mfa(SELECT("*","setting",array(array("name","difference"))));
		echo $total+$temp["value"];
		?>
		&nbsp;&nbsp;&nbsp;&nbsp;Can be ordered:
		<?php
		echo floor(($total+$temp["value"])/60);
		?>
		<hr>
		<table width="0" border="0" cellspacing="0" cellpadding="3">
		<tr>
			<td>index</td>
			<td>name</td>
			<td>money</td>
		</tr>
		<?php
		function cmp($a,$b){
			if($_GET["sort"]=="money")return ($a["money"]<$b["money"])?-1:1;
			else if($_GET["sort"]=="rmoney")return ($a["money"]<$b["money"])?1:-1;
			else return ($a["number"]<$b["number"])?-1:1;
		}
		usort($money,"cmp");
		foreach($money as $temp){
		?>
		<tr>
			<td align="right"><?php echo $temp["number"]; ?></td>
			<td align="right"><?php echo $temp["name"]; ?></td>
			<td align="right"><?php echo color_money($temp["money"]); ?></td>
		</tr>
		<?php
			}
		?>
		<tr>
			<td>&nbsp;</td>
			<td align="right">Total</td>
			<td align="right"><?php echo $total; ?></td>
		</tr>
		</table>
	</td>
</tr>
</table>
</center>
</body>
</html>
