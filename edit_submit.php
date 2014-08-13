<?
	include("common.php");
	logincheck();
	
	$action = (isset($_GET['action']) ? $_GET['action'] : '');
	
	
	if($action == 'add'){
		$picture = '';
		if(isset($_FILES['picture']['name']) && trim($_FILES['picture']['name']) != ''){
			$uploaddir = 'picture/';
			$picture = $uploaddir . basename($_FILES['picture']['name']);
			if(!move_uploaded_file($_FILES['picture']['tmp_name'], $picture)){
				die('picture cannot be uploaded');
			}
		}
		$link = mysql_connect($dbhost, $dbuser, $dbpassword);
		mysql_select_db($dbname);
		$title = mysql_real_escape_string($_POST['title']);
		$content = mysql_real_escape_string($_POST['content']);
		$tags = mysql_real_escape_string($_POST['tags']);
		$uid = $_SESSION['uid'];
		$sql = "insert into $news_table(title, picture, content, tags, uid, post_time) values ('$title', '$picture', '$content', '$tags', '$uid', NOW())";
		echo $sql;
		$result = mysql_query($sql, $link);
		header('location: news_edit.php');
	}else if($action == 'edit'){
		$picture = '';
		if(isset($_FILES['picture']['name']) && trim($_FILES['picture']['name']) != ''){
			$uploaddir = 'picture/';
			$picture = $uploaddir . basename($_FILES['picture']['name']);
			if(!move_uploaded_file($_FILES['picture']['tmp_name'], $picture)){
				die('picture cannot be uploaded');
			}
		}
		$nid = (isset($_GET['nid']) ? $_GET['nid'] : '');
		if($nid == ''){
			header('location: news_edit.php');
		}else{
			$link = mysql_connect($dbhost, $dbuser, $dbpassword);
			mysql_select_db($dbname);
			if($picture == ''){
				$picture = $_POST['picture2'];
			}
			$title = mysql_real_escape_string($_POST['title']);
			$content = mysql_real_escape_string($_POST['content']);
			$tags = mysql_real_escape_string($_POST['tags']);
			$sql = "update $news_table set title = '$title', picture = '$picture', content = '$content', tags = '$tags'  where nid = $nid";
			$result = mysql_query($sql, $link);
			header('location: news_edit.php');
		}
	}else if($action == 'delete'){
		$nid = (isset($_GET['nid']) ? $_GET['nid'] : '');
		$rid = (isset($_GET['rid']) ? $_GET['rid'] : '');
		if($nid != '' && $rid == ''){
			$link = mysql_connect($dbhost, $dbuser, $dbpassword);
			mysql_select_db($dbname);
			$sql = "delete from $news_table where nid = $nid";
			$result = mysql_query($sql, $link);
			header('location: news_edit.php');
		}
		if($rid != ''){
			$link = mysql_connect($dbhost, $dbuser, $dbpassword);
			mysql_select_db($dbname);
			$sql = "delete from $reply_table where rid = $rid";
			$result = mysql_query($sql, $link);
			header("location: edit.php?action=edit&nid=$nid");
		}
	}else{
		header('location: news_edit.php');
	}
?>