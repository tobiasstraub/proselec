<?php
session_start();

if(isset($_SESSION['regestration']) && $_SESSION['regestration'] == 1) {
	require_once("../database/connect.inc.php");

	$mail = $_SESSION['mail'];
	$password = $_SESSION['password'];
	$regid_generated=0; // Laufvariable zur Generierung von Regid

	// Validierung und Filterung von Schadcode
	$name=explode(".",strtolower($mail)); // Vor- und Nachname filtern und in Kleinbuchstaben umwandeln
	$firstname=ucfirst($name[0]); // Ersterbuchstabe von Vorname => Großbuchstabe
	$name_2=explode("@",strtolower($name[1])); // Überreste der E-Mailadresse von Nachname trennen
	$lastname=ucfirst($name_2[0]);  // Ersterbuchstabe von Nachname => Großbuchstabe
	
	while(!$regid_generated) {
		$regid=mt_rand(1000000,2000000); // Registrierungid generieren (1000000 Möglichkeiten)
		// Prüfen ob Regid schon vergeben
		if(!mysql_num_rows(mysql_query("SELECT * FROM user WHERE regid=" . $regid . ""))) {
			$regid_generated=1;
		}
	}
	
	mysql_query("INSERT INTO user VALUES('', '" . $firstname . "', '" . $lastname . "', 0, '" . $regid . "', '" . $mail . "', '" . $password . "', 0, 0, 0)"); // id, firstname, lastname, active, regid, email, password

	// Versendung Registrierungbestätigung
	$mail_codierung="From: Regestrierung | Proselec <reg@proselec.de> \n";
	$mail_codierung.="Content-Type: text/html \n";
	$mail_codierung.="Content-Transfer-Encoding: 8bit\n";
	mail($mail, "Aktivierungscode | ProSelec", "Hallo " . $firstname . " " . $lastname . ",<br />Vielen Dank für die Registrierung auf ProSelec.com. Dein Benutzerkonto wurde erfolgreich authentifiziert. Dein Benutzerkonto muss nun über folgenden Aktivierungslink bestätigt werden: <a href='http://www.proselec.de/auth/activation.php?actm=" . $mail . "&actr=" . $regid . "'>www.proselec.de/auth/activation.php?actm=" . $mail . "&actr=" . $regid . "</a>.<br /><br />Nachdem du dein Benutzerkonto über den oben gegebenen Link aktiviert hast, kannst du dich mit deinen angegebenen Benutzerdaten einloggen.<br /><br />Das ProSelec Team", $mail_codierung);
	
	session_unset(); // + Doppelregestrierung durch Direktaufruf der Seite mit aktueller Session verhindern
	$_SESSION['message']="cmm";
	header("Location: ../index.php?key=login");
	exit();
}
else {
	header("Location: ../index.php");	
	exit();
}

require_once("../database/disconnect.inc.php");
?>