<!DOCTYPE html><!--
	Copyright (c) 2014-2020, CKSource - Frederico Knabben. All rights reserved.
	This file is licensed under the terms of the MIT License (see LICENSE.md).
-->

<html lang="en" dir="ltr"></html>
<head>
	<meta charset="UTF-8">
	
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ReturnNull Home - The Best Social Media Platform</title>
  
  <link rel="stylesheet" href="/style.css"/>
  <link rel="stylesheet" href="style.css"/>
  <link rel="stylesheet" href="styles.css"/>
</head>
<body data-editor="ClassicEditor" data-collaboration="false">


	
	<?php 
	include '../login-check.php';
	include '../db.php';
	include_once '../like.php';
	$act=7; include('../topbar.php');
	 ?>
	 
	<div class="header"><h1>Create a Blog Post</h1></div>
	<main>
		<form action="uploadblog.php" method="post">
				<textarea name ="editor" id="editor"></textarea>
			<input type="submit" class="btn" value="Submit">
			
			</form>
		<br>
		</div>
	</main>
	<script src="/ckeditor/build/ckeditor.js"></script>
	<script>ClassicEditor
			.create( document.querySelector( '#editor' ), {
				
				toolbar: {
					items: [
						'heading',
						'|',
						'bold',
						'italic',
						'underline',
						'strikethrough',
						'link',
						'code',
						'codeBlock',
						'bulletedList',
						'numberedList',
						'fontColor',
						'fontBackgroundColor',
						'fontSize',
						'fontFamily',
						'highlight',
						'|',
						'subscript',
						'superscript',
						'horizontalLine',
						'|',
						'alignment',
						'indent',
						'outdent',
						'|',
						'imageUpload',
						'blockQuote',
						'insertTable',
						'mediaEmbed',
						'undo',
						'redo'
					]
				},
				language: 'en',
				image: {
					toolbar: [
						'imageTextAlternative',
						'imageStyle:full',
						'imageStyle:side'
					]
				},
				table: {
					contentToolbar: [
						'tableColumn',
						'tableRow',
						'mergeTableCells',
						'tableCellProperties',
						'tableProperties'
					]
				},
				licenseKey: '',
				
						
ckfinder: {
            // Upload the images to the server using the CKFinder QuickUpload command.
            uploadUrl: 'http://returnnull.xyz/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images&responseType=json'
        }
			} 
			
	
			)
			.then( editor => {
				window.editor = editor;
		
				
				
				
			} 
			
			)
			.catch( error => {
				console.error( 'Oops, something gone wrong!' );
				console.error( 'Please, report the following error in the https://github.com/ckeditor/ckeditor5 with the build id and the error stack trace:' );
				console.warn( 'Build id: jdomq05pfli9-h7zf43oshmz1' );
				console.error( error );
			} );
	</script>
	<?php include $_SERVER['DOCUMENT_ROOT'] . '/footer.php';?>
</body>
