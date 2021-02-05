<?php
$ulpath = $_SERVER['DOCUMENT_ROOT'];
include $ulpath.'/db.php';
include_once $ulpath.'/like.php';

switch(rand(0,1)){
	case 0:
		//like
		$result = mysqli_query($db, "select postid from posts where deleted=0 order by rand() limit 1");
		$postid = mysqli_fetch_array($result)[0];
		toggleLike($postid, rand(67,72), $db);
		echo "liked";
	break;
	case 1:
		//post
		$result = mysqli_query($db, "select postid from posts where deleted=0 order by rand() limit 1");
		$postid = mysqli_fetch_array($result)[0];
		$desc = file_get_contents('http://metaphorpsum.com/sentences/1');
		
		
		
		$posttype = rand(1,2);
		
		
		$reply = rand(0,1);
		if($reply == 0){
			$reply = $postid;
		}else{
			$reply = -1;
		}
		
		if($posttype == 1){
			$query = "INSERT INTO posts (imagename, description, userid, posttype, reply) VALUES ('', '$desc',  '".rand(67,72)."', '1', '".$postid."')";	 
			mysqli_query($db, $query);
			echo "commented $postid";
		}else{
					$url = "https://picsum.photos/".rand(700,640).'/'.rand(700,640);
		$img = 'cache/image.jpg';



		$url_to_image = $url;
		$my_save_dir = 'cache/';
		$filename = uniqid("post_".date("Y-m-d-H-m-s")."_"). ".jpg";
		$complete_save_loc = $my_save_dir . $filename;
		file_put_contents($complete_save_loc, file_get_contents($url_to_image));


		$file=$complete_save_loc;
		$image=  imagecreatefromjpeg($file);
		ob_start();
		imagejpeg($image,NULL,100);
		$cont=  ob_get_contents();
		ob_end_clean();
		imagedestroy($image);
		$content =  imagecreatefromstring($cont);
		imagewebp($content,'cache/'.$filename.'.webp');
		imagedestroy($content);
		unlink($complete_save_loc);

		rename($complete_save_loc.'.webp', '../../uploads/uploads/'.$filename.'.webp');
		$desc = file_get_contents('http://metaphorpsum.com/sentences/1');
		$query = "INSERT INTO posts (imagename, description, userid) VALUES ('$filename".".webp"."', '$desc',  '".rand(67,72)."')";	 
		mysqli_query($db, $query);

		echo "posted";
			
		}
		
		
		
		
	break;

	
	
}






?>
