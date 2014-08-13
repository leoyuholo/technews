<?
	include("common.php");
	
	$nid = (isset($_GET['nid']) ? $_GET['nid'] : '');
	
	$link = mysql_connect($dbhost, $dbuser, $dbpassword);
	mysql_select_db($dbname);
	$writer = $_POST['reply_writer_name'];
	$content = mysql_real_escape_string($_POST['reply_content']);
	$sql = "insert into $reply_table(nid, writer_name, content, write_time) values ('$nid', '$writer', '$content', NOW())";
	mysql_query($sql, $link);
	header("location: news.php?nid=$nid");
?>