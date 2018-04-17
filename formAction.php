<?php
// phpinfo();exit;
require_once("functions.php");
session_start();

header('Content-Type: text/html; charset=utf-8');

global $CLIENT_ID, $CLIENT_SECRET, $REDIRECT_URI;
/*
echo "<hr>CODE:".$_GET["code"];
echo "<hr>CLIENT_ID:".$CLIENT_ID;
echo "<hr>CLIENT_SECRET:".$CLIENT_SECRET;
echo "<hr>REDIRECT_URI:".$REDIRECT_URI;
*/
$client = new Google_Client();
$client->setClientId($CLIENT_ID);
$client->setClientSecret($CLIENT_SECRET);
$client->setRedirectUri($REDIRECT_URI);
$client->setScopes('email');

$authUrl = $client->createAuthUrl();
$credentials = getCredentials($_GET['code'], $authUrl);

// echo "<hr>CREDENTIALS:".$credentials;

$client->setAccessToken($credentials);
$service = new Google_Service_Drive($client);

// $idsToDelete = getFilesInFolderPreviousUpdate($service, $folderName); // Para borrar en el Drive todo lo que haya en esa carpeta de antes 

$files = $service->files->listFiles();
foreach ($files['items'] as $item) { ?>
 <a target="_blank" href="<?=$item['alternateLink'];?>"> <?=$item['title'];?> </a>
 <br>
 <?php
}

// ***************************************************
// ***************************************************
// FUNCIONES
// ***************************************************
// ***************************************************

function getAllFiles($service) {
	$files = $service->files->listFiles();
    $idsInFolder = array();
    $idFolder = null;
    

    foreach ($files['items'] as $item)  {
    	print_r($item);
    	echo "<hr>";
        array_push($idsInFolder, $item['id']);
    }

    return $idsInFolder;
}


