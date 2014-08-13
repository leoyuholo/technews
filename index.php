<?
	include("header.php");
	include("category.php");
	
	$num_record_per_page = 10;
	$page = (isset($_GET['page']) ? $_GET['page'] : '');
	$search = (isset($_GET['search']) ? $_GET['search'] : '');
	$cat = (isset($_GET['cat']) ? $_GET['cat'] : '');
?>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="100%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="5">
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
              	<td><img src="images/latest.jpg" width="117" height="29" /></td>
              </tr>
			  <?
				$link = mysql_connect("localhost", "root", "");
				mysql_select_db("test");
				if($page == ''){
					$page = 0;
				}
				$start_record = $page * $num_record_per_page;
				if($search != ''){
					$sql = "select * from news where title like '%$search%' or content like '%$search%' or tags like '%$search%' order by post_time desc limit $start_record, $num_record_per_page";
				}else if($cat != ''){
					$sql = "select * from news where title like '[$cat]%' order by post_time desc limit $start_record, $num_record_per_page";
				}else{
					$sql = "select * from news order by post_time desc limit $start_record, $num_record_per_page";
				}
				$result = mysql_query($sql, $link);
				while($line = mysql_fetch_array($result, MYSQL_ASSOC)){
				$content = str_replace("\n", "<br>", $line['content']);
			  ?>
              <tr>
                <td><table width="100%" border="0" cellspacing="0" cellpadding="5">
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
                    <td class="postContent"><?=$content;?></td>
                  </tr>
                  <tr>
                    <td><hr size="5" noshade="noshade" /></td>
                  </tr>
                </table></td>
              </tr>
			  <?}
				if($search != ''){
					$sql = "select count(*) cnt from news where title like '%$search%' or content like '%$search%' or tags like '%search%'";
				}else if($cat != ''){
					$sql = "select count(*) cnt from news where title like '[$cat]%'";
				}else{
					$sql = "select count(*) cnt from news";
				}
				$result = mysql_query($sql, $link);
				$line = mysql_fetch_array($result);
				if($line['cnt'] == 0){
					echo 'No result';
				}
			  ?>
              <tr>
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
				  <?
				  if($page != 0){
				  ?>
                    <td align="left"><a href="index.php?page=<?=$page - 1;?>"><img src="images/newer.jpg" width="115" height="29" id="Image6" onmouseover="MM_swapImage('Image6','','images/newer_2.jpg',1)" onmouseout="MM_swapImgRestore()" /></a></td>
				  <?
				  }
					if($line['cnt'] > ($start_record + $num_record_per_page)){
				  ?>
                    <td align="right"><a href="index.php?page=<?=$page + 1;?>"><img src="images/older.jpg" width="109" height="29" id="Image7" onmouseover="MM_swapImage('Image7','','images/older_2.jpg',1)" onmouseout="MM_swapImgRestore()" /></a></td>
				  <?
				  }
				  ?>
                  </tr>
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