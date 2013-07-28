<?php

function Uploadfile($filename){
	// set up basic connection 
	echo ("Attempting to connect through FTP...\n"); 
	$conn_id = ftp_connect('login.yahoo.com');

	 // check connection
	if(!$conn_id){
		echo "Connection Failed \n";
		exit ; 
	}
	else
		echo "Connection Established \n";
	
	// login with username and password
	echo ("Logging in...\n");
	$login_result = ftp_login ($conn_id, 'yqa_jaya_arflow26', 'abcd1234abcd');

	// check result
	if(!$login_result){
		echo "Login Failed \n";
		exit;
	}
	else
		echo "Login Successful \n";

	// upload the file
	echo ("Uploading '$filename' ... \n");
	$destination= '/public_html/uploads/' . $filename;
	$source =dirname(__FILE__). '/'.$filename;
	$upload =ftp_put($conn_id,$destination,$source, FTP_BINARY);
	
	//Check result
	if($upload)
		echo "Uploaded successfully";
	else{
		echo "Upload failed" ;
		exit;
	}
	
	// close our connection
	echo "Closing FTP connection \n";
	ftp_close($conn_id);	
	echo "Connection Closed \n";
}

UploadFile('abcd.txt');
UploadFile('efgh.txt');
?>
