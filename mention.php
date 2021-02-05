<?php
include_once 'db.php';

$html_content = htmlentities($content);

preg_match_all('/@(\S+)/', $content, $matches, PREG_SET_ORDER);

$usernames = array_column($matches, 1);



if (count($usernames) > 0) {

foreach($usernames as $username){



$sql="SELECT id FROM users WHERE username = '$username'";

$resulttt = mysqli_query($db,$sql);
while ($trow = mysqli_fetch_array($resulttt, MYSQLI_ASSOC)) {
$qr = $trow['id'];
$addr = " <a href=\"/account/pages/$qr\">@$username </a> ";
$pattern = "/(\s|^)@$username(\s|$)/";
$content = preg_replace($pattern,$addr,$content);



}


}

}


//echo $content;

?>
