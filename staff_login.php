<?
	include("header.php");
	include("staff_login_bar.php");
?>
      <tr>
        <td height="400" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="50">&nbsp;</td>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>
                <form name="form1" method="post" action="staff_login_submit.php">
                <table width="100%" border="0" cellspacing="3" cellpadding="3">
                  <tr>
                    <td width="100" class="staffLoginTextStyle1">User Name</td>
                    <td><input name="username" type="text" /></td>
                  </tr>
                  <tr>
                    <td width="100" class="staffLoginTextStyle1">Password</td>
                    <td><input name="password" type="password" /></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
					<td align="right"><input name="Submit" type="submit" class="loginBtn" value="Login"></td>
                  </tr>
                </table>
                </form>
                </td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
            </table></td>
            <td width="650">&nbsp;</td>
          </tr>
        </table>
          <p class="staffLoginTextStyle1">
		   <?
			$errmsg = (isset($_COOKIE['loginerr']))? $_COOKIE['loginerr']: "";
			if($errmsg != ''){
				@setcookie('loginerr', '', time() - 60);
				echo "<br /><br />$errmsg";
			}
		   ?>
		  </p></td>
      </tr>
<?
	include("footer.php");
?>