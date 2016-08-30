<?php
session_start();

if(isset($_POST['senden'])) {
	if(empty($_POST['Betreff'])||empty($_POST['Eintrag'])){
		print "Alle Felder bitte ausfuellen.";
    }
    else{
		$mail_codierung="From: ProSelec Mailserver <" . $_SESSION['usermail'] . "> \n";
		$mail_codierung.="Content-Type: text/html \n";
		$mail_codierung.="Content-Transfer-Encoding: 8bit\n";
		$senden = mail("out_for_security", $_POST['Betreff'], $_POST['Eintrag'], $mail_codierung);
		if($senden){
			header("Location: ../index.php?key=contact");
			exit();
		}
		else {
			print "Fehler bei Senden.";
		}
	}
  }
?>
