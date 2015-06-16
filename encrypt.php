<?php

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$iv = "1234567890124565";
	$secureFile = $_SERVER['DOCUMENT_ROOT'].'/security-2/secure-docs/'.$_POST['name'].'.txt';

	if(file_exists($secureFile))
	{
		$secureDoc = file_get_contents($secureFile);
		$secureData = openssl_decrypt($secureDoc, "aes256", $_POST["password"], true, $iv);

		if($secureData == "")
		{
			echo "Wrong password";
		}
		else
		{
			echo $secureData;
		}
	}
	else
	{
		$fp = fopen($secureFile, "w");
		fwrite($fp, openssl_encrypt($_POST['secret-message'], "aes256", $_POST["password"], true, $iv));
		echo "Secure file created";
	}
}

?>