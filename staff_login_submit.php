<?
	include("common.php");
	$username = $_POST['username'];
	$password = $_POST['password'];
	if($username == '' && $password == ''){
		setcookie('loginerr', 'User name cannot be empty<br />Password cannot be empty', time() + 60);
		header('location: staff_login.php');
	}else if($username == ''){
		setcookie('loginerr', 'User name cannot be empty', time() + 60);
		header('location: staff_login.php');
	}else if($password == ''){
		setcookie('loginerr', 'Password cannot be empty', time() + 60);
		header('location: staff_login.php');
	}else{
		$link = mysql_connect($dbhost, $dbuser, $dbpassword);
		mysql_select_db($dbname, $link);
		
		$sql = "select * from staff_access where username = '$username' and password = '$password'";
		$result = mysql_query($sql, $link);
		if(mysql_num_rows($result) > 0){
			setcookie('loginerr', '', time() - 60);
			
			$record = mysql_fetch_array($result);
			$_SESSION['username'] = $record['username'];
			$_SESSION['uid'] = $record['uid'];
			switch($record['access_rights']){
				case 0:
					$_SESSION['access_rights'] = 'Administrator';
					break;
				case 1:
					$_SESSION['access_rights'] = 'Senior Editor';
					break;
				case 2:
					$_SESSION['access_rights'] = 'Junior Editor';
					break;
			}
			header('location: news_edit.php');
		}else{
			setcookie('loginerr', 'Invalid Login', time() + 60);
			header('location: staff_login.php');
		}
		mysql_close($link);
	}
?>