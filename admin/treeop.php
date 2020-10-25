<html>
<style>
  BODY { font-family : Verdana,Arial; }
  TD   { font-family : Verdana,Arial; }
  A    { text-decoration : none; background-color : #EEFFEE; }
</style>
<body bgcolor=#eeffee link=#339933>
<table border=1 cellspacing=0 width=100%>
<tr><td bgcolor=#eeeeff align=center><font size=2><b>
修改与添加
</b></font></td></tr>
</table>
<?php
echo "CID号：$cid";
?>
<table width='100%' border='0' cellspacing='1' class='outer'><tr class="odd"><td><form method=post action=index.php><h4>添加子分类项目</h4>项目: <input type=text name=title size=30 maxlength=50><input type="hidden" name="cid" value=<?php echo (string)$cid; ?> >
<input type=hidden name=op value=addCat><br><br><input type=submit value=添加><br></form></td></tr></table>
<table width='100%' border='0' cellspacing='1' class='outer'><tr class="odd"><td height="420"><form method=post action=index.php>
<h4>添加软件</h4>
                <table width="80%">
                  <tr> 
                    <td align="right">下载名称: </td>
                    <td><input type=text name=title size=50 maxlength=100></td>
                  </tr>
                  <tr> 
                    <td align="right" nowrap>下载网址: </td>
                    <td><input type=text name=url size=50 maxlength=250 value="http://"></td>
                  </tr>
                  <tr> 
                    <td></td>
                    <td></td>
                  </tr>
                  <tr> 
                    <td align="right" nowrap>来源网站: </td>
                    <td> <input type=text name=homepage size=50 maxlength=100 value="http://"></td>
                  </tr>
                  <tr> 
                    <td align="right">Version</td>
                    <td> <input type=text name=version size=10 maxlength=10></td>
                  </tr>
                  <tr> 
                    <td align="right">软件大小: </td>
                    <td> <input type=text name=size size=10 maxlength=100>
                      字节</td>
                  </tr>
                  <tr> 
                    <td align="right">支持平台: </td>
                    <td> <input type=text name=platform size=45 maxlength=60></td>
                  </tr>
                  <tr> 
                    <td align="right" valign="top" nowrap>软件描述: </td>
                    <td> <textarea id='description' name='description' cols='60' rows='8'></textarea> 
                    </td>
                  </tr>
                </table>
<br><input type="hidden" name="cid" value=<?php echo (string)$cid; ?> ><input type="hidden" name="op" value="addDownload"></input><input type="submit" class="button" value="添加"></input>
</form></td></tr></table>
</body>
</html>
