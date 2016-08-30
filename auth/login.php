<?php
session_start();
require_once("../database/connect.inc.php");

// Validierung HFU Mailadresse
if(isset($_POST['mail']) && !empty($_POST['mail']) && isset($_POST['password']) && !empty($_POST['password'])) {
if(preg_match("/^[a-zA-Z-]+\.+[a-zA-Z-]+(@hs-furtwangen.de|@fh-furtwangen.de|@uhrenmuseum.de)+$/i", $_POST['mail'])) {
	$student=mysql_fetch_row(mysql_query("SELECT password FROM user WHERE email='" . $_POST['mail'] . "'"));
	if($student) {
		if($student[0]==md5("R+o7v*d==" . $_POST['password'] . "==~G3\iJMhKoY.PYD$-5M*TTLJ+")) {
			$result_active=mysql_fetch_row(mysql_query("SELECT active FROM user WHERE email='" . $_POST['mail'] . "'"));
			if($result_active[0]) {
				// Passwort korrekt	
				$_SESSION['loggedin']=1;
				$result_ids=mysql_fetch_row(mysql_query("SELECT facid,studycid,semester,userid FROM user WHERE email='" . $_POST['mail'] . "'"));
				$_SESSION['facid']=$result_ids[0];
				$_SESSION['studycid']=$result_ids[1];
				$_SESSION['semester']=$result_ids[2];
				$_SESSION['userid']=$result_ids[3];
				$_SESSION['usermail']=$_POST['mail'];
				if(!isset($_COOKIE['proselec_facid'])) {
					$result_facid=mysql_fetch_row(mysql_query("SELECT facid FROM user WHERE email='" . $_POST['mail'] . "'"));
					setcookie("proselec_facid",$_SESSION['facid'],time()+3600*24*365,"/");			  
				}
				if(!isset($_COOKIE['proselec_email'])) {
					setcookie("proselec_email",$_POST['mail'],time()+3600*24,"/");			  
				}
				header("Location: ../index.php?key=projektvergabe");
				exit();
			}
			else {
				$_SESSION['message']="ana";
				header("Location: ../index.php?key=login");
				exit();
			}
		}
		else {
			// Passwort falsch
			$_SESSION['message']="ipwd";
			header("Location: ../index.php?key=login");
			exit();
		}
	}
	else {
		$lecturer=mysql_fetch_row(mysql_query("SELECT password,lecturerid FROM lecturer WHERE email='" . $_POST['mail'] . "'"));
		if($lecturer) {
			if($lecturer[0]==md5("R+o7v*d==" . $_POST['password'] . "==~G3\iJMhKoY.PYD$-5M*TTLJ+")) {
				// Passwort korrekt	
				$_SESSION['loggedin']=1;
				$_SESSION['lecturer']=1;
				$_SESSION['lecturer_id']=$lecturer[1];
				// Vorhandene CI Cookies löschen für Dozentdesign (DEFAULT)
				if(isset($_COOKIE['proselec_facid'])) {
					setcookie("proselec_facid","",time()-3600);
				}
				if(!isset($_COOKIE['proselec_email'])) {
					setcookie("proselec_email",$_POST['mail'],time()+3600*24,"/");			  
				}
				header("Location: ../index.php?key=projektvergabe");
				exit();
			}
			else {
				// Passwort falsch
				$_SESSION['message']="ipwd";
				header("Location: ../index.php?key=login");
				exit();
			}
		}
		else {
			// Konto muss registriert werden
			$_SESSION['mail']=$_POST['mail'];
			$_SESSION['password']=md5("R+o7v*d==" . $_POST['password'] . "==~G3\iJMhKoY.PYD$-5M*TTLJ+");
			$_SESSION['regestration']=1;
			header("Location: regestration.php");
			exit();
		}
	}
}
else {
	// Ungültige HFU Mailadresse
	$_SESSION['message']="ihfum";
	header("Location: ../index.php?key=login");
	exit();
}
}
else {
	// Keine vollständigen Angaben
	$_SESSION['message']="ild";
	header("Location: ../index.php?key=login");
	exit();
}

require_once("../database/disconnect.inc.php");
?>