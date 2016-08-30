<?php
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
?>
<div id="content">
<div id="content_inner">
<script type="text/javascript" src="biblio/jquery.js"></script>
<script type="text/javascript" src="biblio/project_slider.js"></script>


<div id="slideshow">
<div id="slidesContainer">
<?php
require_once("database/connect.inc.php");

$timestamp=time(); // Timestamp generieren um abgelaufene Enschreibungen nicht anzuzeigen

if(!$_SESSION['lecturer']) {
	$project_rights_result=mysql_query("SELECT prjid FROM project_rights WHERE facid=" . $_SESSION['facid'] . " AND studycid=" . $_SESSION['studycid'] . " AND semester=" . $_SESSION['semester'] . "");
	while($project_rights=mysql_fetch_row($project_rights_result)) {
		$project_result=mysql_query("SELECT title,text FROM project WHERE prjid=" . $project_rights[0] . " AND timestamp>=" . $timestamp . "");
		while($project=mysql_fetch_row($project_result)) {
			echo '<div class="slide">';
			echo '<div class="slide_text">';
			echo '<h2>' . $project[0] . '</h2><br />';
			echo $project[1];
			$in=mysql_num_rows(mysql_query("SELECT * FROM assignment WHERE prjid=" . $project_rights[0] . " AND userid=" . $_SESSION['userid'] . ""));
			if(!$in) {
				echo '<form action="content/projektvergabe_entry.php" method="post">';
				echo '<input type="radio" name="priority" value="0" /> Als Primärprojekt wählen';
				echo '<input type="radio" name="priority" value="1" /> Als Sekundärprojekt wählen';
				echo '<input type="hidden" name="prjid" value="' . $project_rights[0] . '" />';
				echo '<input type="submit" name="submit" value="Wählen" />';
				echo '</form>';
				echo '</div>';
				echo '</div>';
			}
			else {
				$prio=mysql_fetch_row(mysql_query("SELECT priority FROM assignment WHERE prjid=" . $project_rights[0] . " AND userid=" . $_SESSION['userid'] . ""));
				if(!$prio[0]) {
					$prio_text="primär";
				}
				else {
					$prio_text="sekundär";	
				}
				echo "<br /><br /><br /><br /><b>Sie haben diese Projekt als " . $prio_text . " Projekt gewählt.</b>";
			}
		}
	}
}
else {
	$project_result=mysql_query("SELECT title,text FROM project WHERE timestamp>=" . $timestamp . "");
	while($project=mysql_fetch_row($project_result)) {
		echo '<div class="slide">';
		echo '<div class="slide_text">';
		echo '<h2>' . $project[0] . '</h2><br />';
		echo $project[1];
		echo '</div>';
		echo '</div>';
	}
}

require_once("database/disconnect.inc.php");
?>
</div>
</div>
</div>

</div>
</div>
<?php
}
else {
	$_SESSION['message']="pwda";
	echo "<meta http-equiv=\"refresh\" content=\"0; URL=?key=login\">";
}
?>