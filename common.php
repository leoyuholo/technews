<?php
session_start();

$dbhost = "localhost";
$dbuser = "root";
$dbpassword = "";
$dbname = "test";
$news_table = 'news';
$reply_table = 'reply';
$staff_table = 'staff_access';

function logincheck()
{
	$username = (isset($_SESSION['username']) ? $_SESSION['username'] : '');
	$access_rights = (isset($_SESSION['access_rights']) ? $_SESSION['access_rights'] : '');
	if($username == '' || $access_rights == ''){
		Header("Location: staff_login.php");
	}
}
?>