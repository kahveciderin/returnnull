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

/* name of the chat-db */
$chat_db = "chatty";

/* Title/name of chat */
$chat_title = "";

/* colors */
$darkyellow = "#FF9900";
$red = "#ff0000";
$white = "#FFFFFF";
$blue = "#000099";
$darkblue = "#666699";
$lightblue = "#ccccff";
$black = "#000000";
$yellow = "#FFFF00";
$green = "#009900";
$violet = "#990099";
$brown = "#996633";
$gray = "#666666";

/* Index background */
$index_bgimage = "";
$index_bgcolor = "000099";
$index_header_bgcolor = "#666699";
$index_table_bgcolor = "#ccccff";

/* Talk background */
$talk_bgimage = "";
$talk_bgcolor = "#ccccff";

/* Send Message background */
$msg_bgimage = "";
$msg_bgcolor = "#666699";

/* Users background */
$users_bgimage = "";
$users_bgcolor = "#666699";

/* Logo background */
$logo_bgimage = "";
$logo_bgcolor = "#666699";

/* logo image attributes */
$logo_url = "http://URL-TO-YOUR-LOGO";
$logo_height = "80";
$logo_width = "80";


/* host specification */
$your_host = "returnnull.xyz"; //This will be used by the logoff function to bring the user to your host site.  Do not enter "http://"
$mail_address = "you@yourhost.com"; //Administrator's email address.  This is seen by users.

/* difference, in hours, between local server time and your timezone */
$diff_timezone = "0";

/* the time (in seconds) to refresh the list of the users (in seconds) */
$refresh_users_every = "700";

/* The time (in seconds) to refresh the talk window */
$talk_refresh = "10";

/* days before a message is deleted from the database */
$msg_delete = "1"; //If set to 0, and the chat is loaded, all chat messages will be deleted.  Same if the value is empty

/* limit on number of messages to display */
$display_limit = "20";

foreach ($_REQUEST as $key=>$value) $$key = $value;
foreach ($_SERVER as $key=>$value) $$key = $value;

/* set error reporting to 0 */
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
?>
