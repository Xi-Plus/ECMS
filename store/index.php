<html>
<?php
include_once("../func/checklogin.php");
include_once("../func/sql.php");
include_once("../func/url.php");
include_once("../func/color_money.php");
if(isset($_POST["add"])){
	if(checkpassword($_POST["password"])){
		$row=mfa(SELECT("*","record",array(array("date",$_POST["adddate"])),null));
		if($row==false){
			$previousdate=mfa(SELECT(array("MAX(`date`) as `previousdate`"),"record",array(array("date",$_POST["adddate"],"<"))));
			$previousdate=$previousdate["previousdate"];
			consolelog($previousdate);
			$row=SELECT("*","record",array(array("date",$previousdate)),null,"all");
			while($temp=mfa($row)){
				INSERT("record",array(array("number",$temp["number"]),array("balance",$temp["balance"]),array("date",$_POST["adddate"])));
			}
		}
		$list=explode("\r\n",$_POST["add"]);
		foreach($list as $add){
			$temp=explode(" ",$add);
			$row=mfa(SELECT("*","record",array(array("number",$temp[0]),array("date",$_POST["adddate"]))));
			UPDATE("record",array(array("store",$row["store"]+$temp[1]),array("balance",$row["balance"]+$temp[1])),array(array("number",$temp[0]),array("date",$_POST["adddate"])));
			consolelog( $row["balance"]);
			$row=mfa(SELECT("*","people",array(array("number",$temp[0]))));
			UPDATE("people",array(array("money",$row["money"]+$temp[1])),array(array("number",$temp[0])));
		}
	}else {
		$error="Wrong password";
	}
}
?>
<head>
<meta charset="UTF-8">
<title>store-ECMS</title>
<?php
include_once("../res/meta.php");
meta();
?>
</head>
<body topmargin="0" leftmargin="0" bottommargin="0">
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
?>
<center>
<table border="0" cellpadding="0" cellspacing="0">
<tr>
	<td class="headtd" colspan="2"></td>
</tr>
<tr>
	<td></td>
	<td width="50" rowspan="2"></td>
	<td>
		<h2>Store</h2>
	</td>
</tr>
<tr>
	<td align="right" valign="top">
		<?php
		$date=date("Y-m-d");
		if($_GET["date"]!="")$date=$_GET["date"];
		?>
		Date
		<hr>
		<form action="" method="get" id="form">
			<input name="date" type="date" value="<?php echo $date; ?>"><br>
			<input name="" type="submit" value="Search">
		</form>
		Add
		<hr>
		<form action="" method="post" id="form">
			<input name="adddate" type="hidden" value="<?php echo $date; ?>">
			List (index money)<br>
			<textarea name="add" cols="10" rows="5"></textarea><br>
			Password<br>
			<input name="password" type="password"><br>
			<?php
			$row=mfa(SELECT("*","record",array(array("date",$date)),null));
			if($row==false)echo "Creat new ";
			?>
			<input name="" type="submit" value="Submit" onClick="if(!confirm('Add into <?php echo $date; ?> ?'))return false;">
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
			$people[$temp["number"]]=$temp["name"];
		}
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
		$count=0;
		$total_store=0;
		$row=SELECT("*","record",array(array("date",$date),array("store","0","!=")),null,"all");
		while($temp=mfa($row)){
			$count++;
			$total_store+=$temp["store"];
		?>
		<tr>
			<td align="right"><?php echo $temp["number"]; ?></td>
			<td align="right"><?php echo $people[$temp["number"]]; ?></td>
			<td align="right"><?php echo $temp["store"]; ?></td>
			<td align="right"><?php echo ($temp["charge"]==0?"":$temp["charge"]) ?></td>
			<td align="right"><?php echo color_money($temp["balance"]); ?></td>
		</tr>
		<?php
			}
		?>
		<tr>
			<td align="right"><hr><?php echo $count; ?></td>
			<td align="right"><hr>total</td>
			<td align="right"><hr><?php echo $total_store; ?></td>
			<td align="right"><hr>&nbsp;</td>
			<td align="right"><hr>&nbsp;</td>
		</tr>
		</table>
	</td>
</tr>
</table>
</center>
</body>
</html>
