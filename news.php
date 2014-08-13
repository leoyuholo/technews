<?
	include("header.php");
	include("category.php");
	
	$nid = (isset($_GET['nid']) ? $_GET['nid'] : '');
	$link = mysql_connect("localhost", "root", "");
	mysql_select_db("test");
	$sql = "select * from news where nid=$nid";
	$result = mysql_query($sql, $link);
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	$content = str_replace("\n", "<br>", $line['content']);
?>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="100%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="5">
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><table width="100%" border="0" cellspacing="0" cellpadding="5">
                  <tr>
                    <td><hr /></td>
                    </tr>
                  <tr>
                    <td class="postTitle"><?=$line['title'];?></td>
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
              </tr>
              <tr>
                <td><table width="100%" border="0" cellspacing="0" cellpadding="5">
                  <tr>
                    <td><table width="100%" border="0" cellspacing="0" cellpadding="5">
                  <tr>
                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td>You may reply here<br />
                          <form method="post" action="reply_submit.php?nid=<?=$nid;?>">
                          Your Name: <input name="reply_writer_name" type="text" /></td>
                        </tr>
                        <tr>
                          <td><textarea rows="5" cols="75" name="reply_content"></textarea></td>
                        </tr>
                        <tr>
                          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="100%">&nbsp;</td>
                              <td align="right"><input name="Reply" type="submit" value="Reply"></td>
                            </tr>
                          </table></td>
                        </tr>
                        </form>
                      </table></td>
                  </tr>
                </table></td>
                  </tr>
				  <?
				  	$sql = "select * from reply where nid=$nid order by write_time desc";
					$result = mysql_query($sql, $link);
					while($line = mysql_fetch_array($result, MYSQL_ASSOC)){
					$content = str_replace("\n", "<br>", $line['content']);
				  ?>
                  <tr>
                    <td><?=$line['writer_name'];?> wrote at <?=$line['write_time'];?><p><?=$content;?></p><hr /></td>
                  </tr>
				  <?
					}
				  ?>
                </table></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
            </table></td>
<?
	include("search_box.php");
	include("footer.php");
?>