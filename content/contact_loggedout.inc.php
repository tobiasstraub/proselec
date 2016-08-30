<form action="<?php print $_SERVER['PHP_SELF']; ?>" method="POST">
<table style="width:200px; height:100 background-color:#ccc; color:#123456;">
	

<tr><td>E-Mail</td><td><input type="text" name="Email"></td></tr>
<tr><td>Betreff</td><td><input type="text" name="Betreff"></td></tr>
<tr><td>Nachricht</td><td><textarea name="Eintrag" cols="40" rows="8"></textarea></td></tr>
<tr><td><input type="submit" value="senden" name="senden"></td><td><input type="reset" value="zur&uuml;cksetzen" name="reset"></td></tr>
</table>
</form></p>
<?php
// wenn jmd eingeloggt, email kurz anzeigen, dann statische email, also nicht veränderbar 
// damit einer der en acc hat und jmd ohne acc uns kontaktieren kann



  if(isset($_POST['senden'])) { 
    if(empty($_POST['Betreff']) OR empty($_POST['Eintrag'])){ 
		print "Alle Felder bitte ausfuellen.";
    }
    else{ 
		$mail_codierung="From: Regestrierung | Proselec <reg@proselec.de> \n";
		$mail_codierung.="Content-Type: text/html \n";
		$mail_codierung.="Content-Transfer-Encoding: 8bit\n";
		$Abs_Mail=$_POST['Email'];
		$Abs_Betreff = $_POST['Betreff'];
		$Abs_Nachricht = $_POST['Eintrag'];
		$Nachricht = "Betreff: $Abs_Betreff und 
		folgender Nachricht:\n\n$Abs_Nachricht";
		$senden = mail("info@proselec.de", $Nachricht, "From: $Abs_Mail", $mail_codierung);
		if($senden){
			print "Erfolgreich versendet.";
		}
		else { 
			print "Fehler bei Senden.";
		}
	}
  }
?>
