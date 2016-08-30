<?php
session_start();
if(isset($_POST['submit'])) {
	require_once("../database/connect.inc.php");
	mysql_query("UPDATE user SET active=1, facid=" . $_POST['faculty'] . ", studycid=" . $_POST['studycourse'] . ", semester=" . $_POST['semester'] . " WHERE regid='" . $_SESSION['actr'] . "'");
	$_SESSION['first_login']=0;
	setcookie("proselec_facid",$_POST['faculty'],time()+3600*24*365,"/");
	session_unset();
	$_SESSION['message']="sreg";
	require_once("../database/disconnect.inc.php");
	header("Location: ../index.php?key=login");
	exit();
}
?>