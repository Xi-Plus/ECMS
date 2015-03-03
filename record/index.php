<html>
<?php
include_once("../func/checklogin.php");
include_once("../func/sql.php");
include_once("../func/url.php");
include_once("../func/color_money.php");
?>
<head>
<meta charset="UTF-8">
<title>record-ECMS</title>
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
		Sort By<br>
		<hr>
		<form action="" method="get" id="form">
		<input name="sort" type="hidden" id="sort" value="<?php echo $_GET["sort"]; ?>">
			<a onClick="sort.value='index';form.submit();">index</a><br>
			<a onClick="sort.value='money';form.submit();">money</a><br>
			<a onClick="sort.value='rmoney';form.submit();">Anti-money</a><br>
		<br>
		Date
		<hr>
		<?php
		$date=date("Y-m-d");
		if($_GET["date"]!="")$date=$_GET["date"];
		$previousdate=mfa(SELECT(array("MAX(`date`) AS `temp`"),"record",array(array("date",$date,"<"))));
		$nextdate=mfa(SELECT(array("MIN(`date`) AS `temp`"),"record",array(array("date",$date,">"))));
		?>
		<input name="date" type="date" id="date" value="<?php echo $date; ?>"><br>
		<input type="button" value="Previous" onClick="date.value='<?php echo $previousdate["temp"];?>;form.submit();'"<?php echo ($previousdate["temp"]==NULL?" disabled":""); ?>>
		<input type="button" value="Next" onClick="date.value='<?php echo $nextdate["temp"];?>;form.submit();'"<?php echo ($nextdate["temp"]==NULL?" disabled":""); ?>>
		<input name="" type="submit" value="Search">
		</form>
	</td>
	<td width="300" valign="top">
		Date:
		<?php
		echo $date;
		?>
		<hr>
		<?php
		$row=SELECT("*","people",null,array(array("number")),"all");
		while($temp=mfa($row)){
			$people[$temp["number"]]["number"]=$temp["number"];
			$people[$temp["number"]]["name"]=$temp["name"];
		}
		$row=mfa(SELECT("*","record",array(array("date",$date))));
		if($row!=false){
		?>
		<table width="0" border="0" cellspacing="0" cellpadding="3">
		<tr>
			<td>index</td>
			<td>name</td>
			<td>store</td>
			<td>charge</td>
			<td>balance</td>
		</tr>
		<?php
		$total_store=0;
		$total_charge=0;
		$total_balance=0;
		$row=SELECT("*","record",array(array("date",$date)),null,"all");
		while($temp=mfa($row)){
			$people[$temp["number"]]["store"]=$temp["store"];
			$people[$temp["number"]]["charge"]=$temp["charge"];
			$people[$temp["number"]]["balance"]=$temp["balance"];
			$total_store+=$temp["store"];
			$total_charge+=$temp["charge"];
			$total_balance+=$temp["balance"];
		}
		function cmp($a,$b){
			if($_GET["sort"]=="money")return ($a["balance"]<$b["balance"])?-1:1;
			else if($_GET["sort"]=="rmoney")return ($a["balance"]<$b["balance"])?1:-1;
			else return ($a["number"]<$b["number"])?-1:1;
		}
		usort($people,"cmp");
		foreach($people as $temp){
		?>
		<tr>
			<td align="right"><?php echo $temp["number"]; ?></td>
			<td align="right"><?php echo $temp["name"]; ?></td>
			<td align="right"><?php echo ($temp["store"]==0?"":$temp["store"]); ?></td>
			<td align="right"><?php echo ($temp["charge"]==0?"":$temp["charge"]) ?></td>
			<td align="right"><?php echo color_money($temp["balance"]); ?></td>
		</tr>
		<?php
			}
		?>
		<tr>
			<td>&nbsp;</td>
			<td align="right">Total</td>
			<td align="right"><?php echo $total_store; ?></td>
			<td align="right"><?php echo $total_charge; ?></td>
			<td align="right"><?php echo $total_balance; ?></td>
		</tr>
		</table>
		<?php
		}else{
			?>No record<?php
		}
		?>
	</td>
</tr>
</table>
</center>
</body>
</html>
