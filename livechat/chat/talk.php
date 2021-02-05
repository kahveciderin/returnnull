<?PHP /* $Id$ */
# This file is part of Chatty :)
# Copyright (C) 2003, 2004, 2005 Marco Olivo
#
# Chatty :) is free software; you can redistribute it and/or
# modify it under the terms of the GNU General Public License
# as published by the Free Software Foundation; either version 2
# of the License, or (at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with this program; if not, write to the Free Software
# Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.

include("connect.inc.php");
include("config.inc.php");
include("utils.inc.php");
include("lang.inc.php");

if (!isset($username))
	$username = "";
if (!isset($password))
	$password = "";

/* security checks */
$username = stripslashes(urldecode($username));

header("Expires: Sun, 28 Dec 1997 09:32:45 GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Refresh: $talk_refresh");	/* update this page every talk_refresh seconds */

/* delete old messages from our db */
$sent_on = date("YmdHis", time() - 60 * 60 * 24 * $msg_delete);	
$query = "DELETE FROM msg WHERE sent_on < '$sent_on'";
do_the_query($chat_db, $query);

echo "<HTML>";
echo "<HEAD>";
echo "<LINK REL=\"stylesheet\" HREF=\"style.css.php\" TYPE=\"text/css\">\r\n";
echo "</HEAD>";
echo "<BODY CLASS=\"talk\">\r\n";

echo "<FONT FACE=\"verdana, arial, helvetica, sans-serif\">\r\n";

$query = "SELECT username, color, msg, HOUR(sent_on) AS hour, MINUTE(sent_on) AS minutes, SECOND(sent_on) AS seconds FROM msg ORDER BY sent_on desc LIMIT $display_limit";
$result = do_the_query($chat_db, $query);

while ($row = mysql_fetch_array($result)) {
	switch ($row["color"]) {
		case "1":
			$colore = $white;	/* white */
			break;
		case "2":
			$colore = $yellow;	/* yellow */
			break;
		case "3":
			$colore = $red;	/* red */
			break;
		case "4":
			$colore = $green;/* green */
			break;
		case "5":
			$colore = $blue;	/* blue */
			break;
		case "6":
			$colore = $brown;/* brown */
			break;
		case "7":
			$colore = $violet;/* violet */
			break;
		case "8":
			$colore = $darkyellow;	/* light red */
			break;
		case "9":
			$colore = $black;/* black */
			break;
		default:
			$colore = $white;	/* white (by default) */
			break;
	}
	$hour = ($row["hour"] < 10 ? "0" . $row["hour"] : $row["hour"]);
	$minutes = ($row["minutes"] < 10 ? "0" . $row["minutes"] : $row["minutes"]);
	$seconds = ($row["seconds"] < 10 ? "0" . $row["seconds"] : $row["seconds"]);

	/* which kind of message is this? */
	if ($row["username"] == "") {
		echo "<FONT COLOR=$gray SIZE=1>[" . strip_tags(stripslashes($row["msg"])) . " $lang[chat_enter] - $hour:$minutes:$seconds]</FONT><BR>\r\n";
	}
	else {
		$row["msg"] = strip_tags($row["msg"]);
		$row["msg"] = str_replace("=(","<img src=\"images/sad.gif\" alt=\"=(\"/>", $row["msg"]);
		$row["msg"] = str_replace(":(","<img src=\"images/sad.gif\" alt=\":(\"/>", $row["msg"]);
		$row["msg"] = str_replace(";(","<img src=\"images/cry.gif\" alt=\";(\"/>", $row["msg"]);
		$row["msg"] = str_replace(":@","<img src=\"images/mad.gif\" alt=\":@\"/>", $row["msg"]);
		$row["msg"] = ereg_replace(":)","<img src=\"images/smile.gif\" alt=\":)\"/>", $row["msg"]);
		$row["msg"] = ereg_replace("=)","<img src=\"images/smile.gif\" alt=\"=)\"/>", $row["msg"]);
		$row["msg"] = ereg_replace(":D","<img src=\"images/laugh.gif\" alt=\":D\"/>", $row["msg"]);
		$row["msg"] = ereg_replace(":d","<img src=\"images/laugh.gif\" alt=\":d\"/>", $row["msg"]);
		$row["msg"] = ereg_replace(":p","<img src=\"images/tongue.gif\" alt=\":p\"/>", $row["msg"]);
		$row["msg"] = ereg_replace(":P","<img src=\"images/tongue.gif\" alt=\":P\"/>", $row["msg"]);
		$row["msg"] = ereg_replace(":O","<img src=\"images/shocked.gif\" alt=\":O\"/>", $row["msg"]);
		$row["msg"] = ereg_replace(":o","<img src=\"images/shocked.gif\" alt=\":o\"/>", $row["msg"]);
		$row["msg"] = ereg_replace(";)","<img src=\"images/wink.gif\" alt=\";)\"/>", $row["msg"]);
		$row["msg"] = ereg_replace(":S","<img src=\"images/sick.gif\" alt=\":S\"/>", $row["msg"]);
		$row["msg"] = ereg_replace(":s","<img src=\"images/sick.gif\" alt=\":s\"/>", $row["msg"]);
		$row["msg"] = ereg_replace("8)","<img src=\"images/love.gif\" alt=\":s\"/>", $row["msg"]);
		$row["msg"] = ereg_replace(":/","<img src=\"images/half-frown.gif\" alt=\":s\"/>", $row["msg"]);
		$row["msg"] = ereg_replace(":roll:","<img src=\"images/roll.gif\" alt=\":roll:\"/>", $row["msg"]);
		echo "<FONT COLOR=$gray SIZE=1>($hour:$minutes:$seconds)</FONT>\r\n";
		echo "<FONT COLOR=$colore SIZE=4><B>[" . strip_tags(stripslashes($row["username"])) . "] :</B> " . $row["msg"] . "</FONT><BR>\r\n";
	}
}

mysql_free_result($result);

/* this user is active: save it! */
$query = "UPDATE users SET active = 'y', sent_on = DATE_ADD(NOW(), INTERVAL $diff_timezone HOUR) WHERE username = '$username'";
do_the_query($chat_db, $query);

echo "</FONT>";
echo "</BODY>";
echo "</HTML>\r\n";
?>
