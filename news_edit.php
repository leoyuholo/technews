<?
	include("header.php");
	include("news_edit_bar.php");
	include("common.php");
	logincheck();
?>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="100%" class="editTextStyle1">Access right: <?=$_SESSION['access_rights'];?><br />User name: <?=$_SESSION['username'];?>
				</td>
                <td><table width="200" border="0" cellspacing="0" cellpadding="5">
                  <tr>
                    <td width="200" bgcolor="#CCCCCC"><table width="200" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="200" align="center" bgcolor="#FFFFFF"><a href="edit.php?action=add" class="editTextStyle1">Add News</a></td>
                      </tr>
                    </table></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
			<?
				$link = mysql_connect($dbhost, $dbuser, $dbpassword);
				mysql_select_db($dbname);
				$uid = $_SESSION['uid'];
				$sql = "select * from $news_table where uid = $uid order by post_time desc";
				$result = mysql_query($sql, $link);
				while($line = mysql_fetch_array($result, MYSQL_ASSOC)){
				$content = str_replace("\n", "<br>", $line['content']);
			?>
              <tr>
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="100%"><table width="100%" border="0" cellspacing="0" cellpadding="5">
                      <tr>
                        <td><hr /></td>
                      </tr>
                      <tr>
                        <td><a href="news.php?nid=<?=$line['nid'];?>" class="postTitle"><?=$line['title'];?></a></td>
                      </tr>
                      <tr>
                        <td><?=$line['post_time'];?></td>
                      </tr>
                      <tr>
                        <td align="center"><img src="<?=$line['picture'];?>"></td>
                      </tr>
                      <tr>
                        <td><?=$content;?></td>
                      </tr>
                      <tr>
                        <td><hr size="5" noshade="noshade" /></td>
                      </tr>
                    </table></td>
                    <td valign="top"><table width="200" border="0" cellspacing="0" cellpadding="5">
                      <tr>
                        <td width="200" bgcolor="#CCCCCC"><table width="200" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="200" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr align="center">
                                <td><a href="edit.php?action=edit&nid=<?=$line['nid'];?>" class="editTextStyle1">Edit</span></a></td>
                                <td><a href="edit_submit.php?action=delete&nid=<?=$line['nid'];?>" class="editTextStyle1">Delete</span></a></td>
                              </tr>
                            </table></td>
                          </tr>
                        </table></td>
                      </tr>
                    </table></td>
                  </tr>
                </table></td>
              </tr>
			  <?
				}
			  ?>
            </table></td>
          </tr>
        </table></td>
      </tr>
<?
	include("footer.php");
?>