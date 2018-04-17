<?php
require_once("functions.php");
session_start();

header('Content-Type: text/html; charset=utf-8');

$authUrl = getAuthorizationUrl("971xxxx23092-00upsrb040uu80jo4oa7sul79n4lpik0.apps.googleusercontent.com", "5j_hTryhxlA5w11Zxmm93Z_T");
header("Location:".$authUrl);
?>