<?php
if(!isset($pidd)){
	$pidd=0;}
include_once 'db.php';
include_once 'like.php';
$html_content = htmlentities($content);

preg_match_all('/@(\S+)/', $content, $matches, PREG_SET_ORDER);

$usernames = array_column($matches, 1);



if (count($usernames) > 0) {

foreach($usernames as $username){

$uidof = getIdOfUser($username,$db);
addNotifToUser($uidof,'A user mentioned you.',$pidd,$db);


}


}


//echo $content;

?>
