<html>
<style>
<!-- 表格样式 --> 
TD { 
FONT-FAMILY: "Verdana", "宋体"; FONT-SIZE: 12px; LINE-HEIGHT: 130%; letter-spacing:1px 
} 

<!-- 超级连接样式 --> 
A:link { 
COLOR: #990000; FONT-FAMILY: "Verdana", "宋体"; FONT-SIZE: 12px; TEXT-DECORATION: none; letter-spacing:1px 
} 
A:visited { 
COLOR: #990000; FONT-FAMILY: "Verdana", "宋体"; FONT-SIZE: 12px; TEXT-DECORATION: none; letter-spacing:1px 
} 
A:active { 
COLOR: #990000; FONT-FAMILY: "Verdana", "宋体"; FONT-SIZE: 12px; TEXT-DECORATION: none; letter-spacing:1px 
} 
A:hover { 
COLOR: #ff0000; FONT-FAMILY: "Verdana", "宋体"; FONT-SIZE: 12px; TEXT-DECORATION: underline; letter-spacing:1px 
} 
<!-- 其他样式 --> 
.Menu { 
COLOR:#000000; FONT-FAMILY: "Verdana", "宋体"; FONT-SIZE: 12px; CURSOR: hand 
} 
</style>
<head> 
</head> 
 <script type="text/javascript">
<!--

function ShowMenu(MenuID) 
{ 
if(MenuID.style.display=="none") 
{ 
MenuID.style.display=""; 
} 
else 
{ 
MenuID.style.display="none"; 
} 
}
//-->
</script>

<body bgcolor=#eeffee link=#339933> 
<?php
//基本变量设置
$GLOBALS['ID'] = 1; //用来跟踪下拉菜单的ID号
$layer = 1; //用来跟踪当前菜单的级数
//连接数据库
$Con = mysql_connect('localhost', 'root', 'yes');
mysqli_select_db($GLOBALS['xoopsDB']->conn, 'xoops2');

//提取一级菜单
$sql = 'select * from xoops_wmpdownloads_cat where pid=0';
$result = $GLOBALS['xoopsDB']->queryF($sql, $Con);
echo '<table border=1 cellspacing=0 width=100%><tr><td bgcolor=#eeeeff align=center><font size=2><b>目录列表</b></font></td></tr></table>';
//echo "<table width='100%' border='1'><tr><td width='50%'>";//外表格

//如果一级菜单存在则开始菜单的显示
if ($GLOBALS['xoopsDB']->getRowsNum($result) > 0) {
    ShowTreeMenu($Con, $result, $layer, $cid);
}
//include "tree.php";
//echo "</td><td width='50%'>";//外表格第一列结束开始第二列
//echo "</td></tr></table>";//外表格第二列结束表格结束

//=============================================
//显示树型菜单函数 ShowTreeMenu($con,$result,$layer)
//$con：数据库连接
//$result：需要显示的菜单记录集
//layer：需要显示的菜单的级数
//=============================================
function ShowTreeMenu($Con, $result, $layer)
{
    //取得需要显示的菜单的项目数

    $numrows = $GLOBALS['xoopsDB']->getRowsNum($result);

    //开始显示菜单，每个子菜单都用一个表格来表示

    echo "<table cellpadding='0' cellspacing='0' border='0'>";

    for ($rows = 0; $rows < $numrows; $rows++) {
        //将当前菜单项目的内容导入数组

        $menu = $GLOBALS['xoopsDB']->fetchBoth($result);

        //提取菜单项目的子菜单记录集

        $sql = "select * from xoops_wmpdownloads_cat where pid=$menu[cid]";

        $result_sub = $GLOBALS['xoopsDB']->queryF($sql, $Con);

        echo '<tr>';

        //如果该菜单项目有子菜单，则添加JavaScript onClick语句

        if ($GLOBALS['xoopsDB']->getRowsNum($result_sub) > 0) {
            echo "<td><img src='../images/tree_expand.gif' border='0' width='15'></td>";

            echo "<td class='Menu' onClick='javascript:ShowMenu(Menu" . $GLOBALS['cid'] . ");'>";
        } else {
            echo "<td><img src='../images/tree_leaf.gif' border='0' width='15'></td>";

            echo "<td class='Menu'>";
        }

        //如果该菜单项目没有子菜单，并指定了超级连接地址，则指定为超级连接，

        //否则只显示菜单名称 /modules/mydownloads/viewcat.php?cid=$menu[cid]

        //if($menu[url]!="")

        //echo "<a href='$menu[url]'>$menu[title]$menu[cid]</a>";

        //else

        //echo $menu[title];

        echo "<a href='treeop.php?cid=$menu[cid]' target='main'>$menu[title]($menu[cid])</a>";

        echo ' </td> </tr>';

        //如果该菜单项目有子菜单，则显示子菜单

        if ($GLOBALS['xoopsDB']->getRowsNum($result_sub) > 0) {
            //指定该子菜单的ID和style，以便和onClick语句相对应

            echo '<tr id=Menu' . $GLOBALS['cid']++ . " style='display:none'>";

            echo "<td width='20'>&nbsp;</td>";

            echo '<td>';

            //将级数加1

            $layer++;

            //递归调用ShowTreeMenu()函数，生成子菜单

            ShowTreeMenu($Con, $result_sub, $layer);

            //子菜单处理完成，返回到递归的上一层，将级数减1

            $layer--;

            echo '</td></tr>';
        }

        //继续显示下一个菜单项目
    }

    echo '</table>';
}

?> 
</body> 
</html> 