<?php
session_start();
require_once("../database/connect.inc.php");

if(isset($_POST['submit'])) {
	$date = $_POST['datum']; 
	$day = substr($date, 0, 2);
	$month   = substr($date, 3,2);
	$year  = substr($date, -4);
  
	$zeit = $_POST['time'];
	$hour = substr($zeit, 0, 2);
	$minute  = substr($zeit, 3,2);
	$timestamp = mktime($hour,$minute,"0",$month,$day,$year);
	
	mysql_query("INSERT INTO project VALUES('','" . $_POST['prjtitle'] . "','" . $_POST['content'] . "','" . $timestamp . "','" . $_POST['prjusersize'] . "','" . $_SESSION['lecturer_id'] . "')");
	$studycourse=$_POST['studycourse'];
	$prjid=mysql_fetch_row(mysql_query("SELECT prjid FROM project ORDER BY prjid DESC LIMIT 1"));
	$semester="1";
	for($i=0; $i<=count($_POST['studycourse'])-1; $i++) {
		$ids=explode(".",$studycourse[$i]);
		mysql_query("INSERT INTO project_rights VALUES(''," . $prjid[0] . "," . $ids[0] . "," . $ids[1] . "," . $semester . ")");
	}
	$_SESSION['lecturer_message']="addprojectok";
	header("Location: ../index.php?key=lecturer_backend");
	exit();
}

require_once("../database/disconnect.inc.php");
?>