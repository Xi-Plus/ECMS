<?php
//include_once("sql.php");
function checkpassword($password,$cookie=false){
	$passwordmd5="a34a9753321d94b6e09af0f0bfef71e1";
	if($cookie&&md5($password."ECMS")==$passwordmd5)return true;
	else if(md5(md5($password)."ECMS")==$passwordmd5)return true;
	else return false;
}
function checklogin(){
	if(checkpassword($_COOKIE["ECMSadmin"],true)){
		return true;
	}else {
		return false;
	}
}
?>