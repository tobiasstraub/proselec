<?php
require_once("../database/connect.inc.php");



// Suche alle abgelaufenen Projekte (timestamp) in der Datenbank

$prjsize=mysql_num_rows(mysql_query("SELECT usersize FROM project")); // dozent
$usersize=mysql_num_rows(mysql_query("SELECT * FROM assignment WHERE prjid='?'"));

if($usersize<=$prjsize) {
  // Zuweisung d&uuml;rfen rein
}
else {
  // Uswahlverfahren
  for($i; $i<=$prjsize; $i++) {
    $zz[]=mt_rand(1,$usersize);
  }
}



require_once("../database/disconnect.inc.php");
?>