<?php
session_start();
require_once("../database/connect.inc.php");

if(isset($_POST['submit'])) {
	mysql_query("INSERT INTO assignment VALUES('', '" . $_SESSION['userid'] . "', '" . $_POST['prjid'] . "', '" . $_POST['priority'] . "')");
	header("Location: ../index.php?key=projektvergabe");
	exit();
}

require_once("../database/disconnect.inc.php");
?>