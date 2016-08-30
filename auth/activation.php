<?php
session_start();

if(isset($_GET['actm']) && isset($_GET['actr']) && !empty($_GET['actm']) && !empty($_GET['actr'])) {
	require_once("../database/connect.inc.php");
	$result=mysql_num_rows(mysql_query("SELECT * FROM user WHERE email='" . $_GET['actm'] . "' AND regid='" . $_GET['actr'] . "'"));
	// Prüfung ob E-Mail Adresse korrekte Regid zugeordnet
	if($result) {
		$active=mysql_fetch_row(mysql_query("SELECT active FROM user WHERE email='" . $_GET['actm'] . "' AND regid='" . $_GET['actr'] . "'"));
		// Prüfung ob Konto schonmal aktiviert wurde
		if(!$active[0]) {
			$_SESSION['first_login']=1;
			$_SESSION['actr']=$_GET['actr'];
			header("Location: ../index.php?key=firstlogin");
			exit();
		}
		else {
			// Konto wurde schon aktiviert
			$_SESSION['message']="aaa";
			header("Location: ../index.php?key=login");
			exit();
		}
		require_once("../database/disconnect.inc.php");
	}
	else {
		// Keine korrekte Regid
		$_SESSION['message']="ncr";
		header("Location: ../index.php?key=login");
		exit();
	}
}
?>