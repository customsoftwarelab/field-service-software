<?php
session_start();
include('../inc/config.php');
/*
Uploadify
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php> 
*/

// Define a destination
$targetFolder = '../uploads'; // Relative to the root

$verifyToken = md5('unique_hash' . $_POST['timestamp']);

if (!empty($_FILES)) {
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath = $targetFolder;
	$targetFile = rtrim($targetPath,'/') . '/' . $_FILES['Filedata']['name'];
	$attaid = $_REQUEST['attaid'];
	$attachmod = $_REQUEST['attachmod'];
	
	// Validate the file type
	$fileTypes = array('jpg','jpeg','gif','png','pdf','csv','xls','docx','doc','txt','zip'); // File extensions
	$fileParts = pathinfo($_FILES['Filedata']['name']);
	
	if (in_array($fileParts['extension'],$fileTypes)) {
		move_uploaded_file($tempFile,$targetFile);
		echo '1';
		
		mysql_query("INSERT INTO uploads SET mod_section = '$attachmod', cli_id = '$attaid', filename = '".$_FILES['Filedata']['name']."', active = 'true', saasid = '".$_SESSION['saasid']."', dateups = '".date('m/d/Y')."'");
		
	} else {
		echo 'Invalid file type.';
	}
}
?>