<div id="content">
<div id="content_inner">
<div id="ues">ERROR</div>
<?php
switch($_SESSION['message']) {
	case 'aaa':
		// Account already activated
		echo "Das Konto wurde bereits aktiviert. Sie k�nnen sich mit Ihrem Benutzernamen und Passwort anmelden.";
		break;
	case 'ihfum':
		// Illegal HFU mail
		echo "Bitte geben Sie eine g�ltige E-Mail-Adresse der Hochschule Furtwangen University ein.";
		break;
	case 'ild':
		// Incomplete logindata
		echo "Bitte geben Sie Ihre E-Mail-Adresse der Hochschule Furtwangen University und Ihr Passwort ein.";
		break;
	case 'ipwd':
		// Incorrect password
		echo "Ihr eingegebenes Passwort ist nicht korrekt. Bitte geben Sie es nochmal ein.";
		break;
	case 'ncr':
		// No correct Regid
		echo "Die Registrierungsid ist nicht vorhanden. Bitte regestrieren Sie sich erneut.";
		break;
	case 'sreg':
		// Success Regestration
		echo "Sie wurden erfolgreich registriert. Sie k�nnen sich nun einloggen.";
		break;
	case 'ana':
		// Account not active
		echo "Ihr Account ist noch nicht Freigeschaltet. Sie m�ssen Ihren Account noch best�tigen.";
		break;
	case 'cmm':
		// Confirmation Mail
		echo "Wir haben Ihnen eine Best�tigungsmail zugesandt. Bitte �berpr�fen Sie Ihr E-mail Postfach und best�tigen Sie die Registrierung.";
		break;
	case 'pwda':
		// Password Area
		echo "Bitte loggen Sie sich ein, um diesen Bereich zu sehen.";
		break;
}
unset($_SESSION['message']); // Messagebeh�lter leeren
?>
</div>
</div>