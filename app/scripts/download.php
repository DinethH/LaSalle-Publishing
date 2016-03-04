<?php

session_start();

$servername = getenv('IP');

//The directory where the download files are kept - keep outside of the web document root
$strDownloadFolder = "https://lasallepub.com/images/products/";

//If you can download a file more than once
$boolAllowMultipleDownload = 0;

//connect to the DB
$resDB = mysql_connect($servername, "lasallepub", "6h4HR2TcdPFL");
mysql_select_db("lasallepub", $resDB);

//download type
$type = $_GET['type'];



if(!empty($_GET['key'])){
	//check the DB for the key
	$resCheck = mysql_query("SELECT * FROM products WHERE id = '".mysql_real_escape_string($_GET['key'])."' LIMIT 1");
	$arrCheck = mysql_fetch_assoc($resCheck);
	

	
	if($type == "ebook"){

		$strDownload = $strDownloadFolder.$arrCheck['ebook'];
		
		//get the file content
		$strFile = file_get_contents($strDownload);
		
		//set the headers to force a download
		header("Content-type: application/force-download");
		header("Content-Disposition: attachment; filename=\"".str_replace(" ", "_", $arrCheck['ebook'])."\"");
		
		//echo the file to the user
		echo $strFile;

		exit;
	
		



	} else if($type == "video"){

		$strDownload = $strDownloadFolder.$arrCheck['video'];
			
		//get the file content
		$strFile = file_get_contents($strDownload);
		
		//set the headers to force a download
		header("Content-type: application/force-download");
		header("Content-Disposition: attachment; filename=\"".str_replace(" ", "_", $arrCheck['video'])."\"");
		
		//echo the file to the user
		echo $strFile;

		exit;	    
	    
	} else if($type == "zip"){

		$strDownload = $strDownloadFolder.$arrCheck['zip'];
			
		//get the file content
		$strFile = file_get_contents($strDownload);
		
		//set the headers to force a download
		header("Content-type: application/force-download");
		header("Content-Disposition: attachment; filename=\"".str_replace(" ", "_", $arrCheck['zip'])."\"");
		
		//echo the file to the user
		echo $strFile;

		exit;
	    
	} else{
		//the download key given didnt match anything in the DB
		echo "No file was found to download.";
	}
}else{
	//No download key wa provided to this script
	echo "No download key was provided. Please return to the previous page and try again.";
}

?>