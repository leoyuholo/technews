<?
	include("header.php");
	include("news_edit_bar.php");
	include("common.php");
	logincheck();
	
	$action = (isset($_GET["action"]) ? $_GET["action"] : '');
	$link = mysql_connect($dbhost, $dbuser, $dbpassword);
	mysql_select_db($dbname);
	if($action == 'add'){
		$title = '';
		$picture = '';
		$content = '';
		$tags = '';
	}else if($action == 'edit'){
		$nid = (isset($_GET['nid']) ? $_GET['nid'] : '');
		$uid = $_SESSION['uid'];
		if($nid == ''){
			header('location: news_edit.php');
		}else{
			$sql = "select * from $news_table where nid = $nid and uid = $uid";
			$result = mysql_query($sql, $link);
			$line = mysql_fetch_array($result, MYSQL_ASSOC);
			$title = $line['title'];
			$picture = $line['picture'];
			$content = $line['content'];
			$tags = $line['tags'];
			$post_time = $line['post_time'];
			$uid = $line['uid'];
			$sql = "select username from staff_access where uid = $uid";
			$result = mysql_query($sql, $link);
			$line = mysql_fetch_array($result, MYSQL_ASSOC);
			$post_username = $line['username'];
		}
	}else{
		header('location: news_edit.php');
	}
?>
      <tr>
	  <?
		if(isset($_GET['nid'])){
	  ?>
		  <form method="post" enctype="multipart/form-data" action="edit_submit.php?action=<?=$action?>&nid=<?=$nid;?>">
	  <?
		}else{
	  ?>
		  <form method="post" enctype="multipart/form-data" action="edit_submit.php?action=<?=$action?>">
	  <?
		}
	  ?>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="5">
          <tr>
            <td width="100%" class="editTextStyle1">Access right: <?=$_SESSION['access_rights'];?><br />User name: <?=$_SESSION['username'];?>
			<?
				if($action != 'add'){
			?>
				<br />Post Time: <?=$post_time;?><br />Post User: <?=$post_username;?>
			<?
				}
			?>
			</td>
          </tr>
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="5">
              <tr>
                <td><hr /></td>
              </tr>
              <tr>
                <td>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="100" valign="top" class="postTitle">Title</td>
                      <td><textarea rows="5" cols="75" name="title"><?=$title;?></textarea></td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="100" valign="top">Picture</td>
                      <td><input type="file" name="picture"><br /><img src="<?=$picture;?>" width="150" height="150"></img></td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="100" valign="top">Content</td>
                      <td><textarea rows="20" cols="75" name="content"><?=$content;?></textarea></td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="100" valign="top">tags</td>
                      <td><textarea rows="3" cols="75" name="tags"><?=$tags;?></textarea></td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td><hr size="5" noshade="noshade" /></td>
              </tr>
            </table></td>
          </tr>
		  <?
				if($action != 'add'){
				  	$sql = "select * from reply where nid=$nid order by write_time desc";
					$result = mysql_query($sql, $link);
					if(@mysql_num_rows($result) > 0){
		  ?>
          <tr>
            <td>					
				<table width="100%" border="0" cellspacing="0" cellpadding="5">
				  <?
					while($line = mysql_fetch_array($result, MYSQL_ASSOC)){
				  ?>
				  <tr>
					<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
						  <td><?=$line['writer_name']?> wrote at <?=$line['write_time']?><p>&nbsp;&nbsp;<?=$line['content']?></td>
						  <td width="100"><a href="edit_submit.php?action=delete&nid=<?=$nid;?>&rid=<?=$line['rid']?>" class="editTextStyle1">Delete</a></td>
						</tr>
					  </table></td>
				  </tr>
				  <?
					}
				  ?>
				</table>
				<hr />
			</td>
          </tr>
		  <?
				}
			}
		  ?>
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="100%">&nbsp;</td>
                <td><table width="100" border="0" cellspacing="0" cellpadding="0">
                  <tr>
					<td><input type="hidden" name="picture2" value="<?=$picture;?>"></td>
                    <td><input type="Submit" value="Done" class="editTextStyle2"></td>
                  </tr>
				  </form>
                </table></td>
                <td><table width="100" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><a href="news_edit.php" class="editTextStyle1">Cancel</a></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
<?
	include("footer.php");
?>