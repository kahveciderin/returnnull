<?php
include '../login-check.php';
	include '../db.php';
	
	include_once '../like.php';
	//$act=100; include('../topbar.php');
	
	$oname = getNameOfUser(getData("ownerid","classes","classid",$_POST['c'],$db),$db);
	
	
	
	if($oname != $_SESSION['username']){
		
		//header("Location: /school");
	}else{
if(isset($_POST['editor'])){
	
	if(isset($_SESSION['username'])){
		$body = $_POST['editor'];
		if(isset($_FILES['image'])){
		$name = $_FILES["image"]['name'];
		
		$expl = explode(".", $name);
		$ext = end($expl);
		$filename = uniqid("post_".date("Y-m-d-H-m-s")."_"). ".$ext";


		$uploadfile = "uploads/";
		if (rename($_FILES['image']['tmp_name'], $_SERVER['DOCUMENT_ROOT']."/school/uploads/".$filename))
 {
	 
	 
	 mysqli_query($db,"INSERT INTO assignments (description,class,file) VALUES ('$body','{$_POST['c']}', '$filename')");
	 
	 
	  }else{
		  mysqli_query($db,"INSERT INTO assignments (description,class) VALUES ('$body','{$_POST['c']}')");
		  
		  
	  }
			
			
			}else{
				mysqli_query($db,"INSERT INTO assignments (description,class) VALUES ('$body','{$_POST['c']}')");
				
				}
		
		
		
		}
	}
}
header('Location: /school');
?>
