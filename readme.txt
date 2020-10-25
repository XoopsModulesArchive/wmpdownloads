传播此包时请勿删除此文件
wenmingpig 文明猪制作 y2000@yeah.net
题王题网http://www.tiwang.com
诚正教育网http://www.edu18.com

/////////////可怜可怜我吧，给点活干，债务压的喘不过气来！
专业承接教育项目合作、教育软件的开发、教育网站开发等业务，业务联系webmaster@edu18.com

针对xoops2.0.1 海微中文版,感谢海微！
如果有什么问题可以给我发mail或到海微站http://www.hiweed.com上发帖


wmpdownload简介
这个模块由文明猪在mydownload基础上改造而成的。
模块中变动如下：

①系统增加了树状子类/文件添加
这部分给分类复杂的下载系统提供了非常方便的子类与文件添加功能，但文件添加功能是经过简化的，尽管可以用原先的一些功能，但在这里你没有得到提示！
由于修改、删除和修改等功能用的比较少，因此这里没有提供！

添加的文件有：

admin目录中
tree.html 这是一个frame索引页
tree.php 左侧的frame,提供把数据库download_cat中的分类进行树状显示的功能，其中标题后面括弧中的数字是这个子类的cid号码，以便和右边frame对应，本程序本着简化使用的原则没有提供右侧的标题。由于功能是拼凑程序，并且本人的能力实在有限，因此大家应该手工修改里面的数据库选项，目前本程序没有考虑数据安全等因素，希望大家使用时注意！
treeop.php 右侧的操作程序，这个程序根据左侧提供的cid号码进行子类和下载文件的添加，这项操作必须是管理员身份进入，否则会退到登录页面。对于文件添加部分功能进行了简化。
about.html简单的说明页面。

变更的文件:

admin目录中
index.php 为了配合树状的页面和使添加文件更方便，对function addCat()和function addDownload()最后一句做了修改，最后一句的作用是操作返回，这里改成了返回上一页面处理，具体变更方式大家可打开文件自己观看，非常简单。

为了管理员能够从管理菜单索引到这个功能，在index.php和menu.php中添加了对应的功能。

②groupaccess功能
对于一些文件，有时需要控制下载的人员，比如收费或管理人员等，这时候需要进行组控制。
为对分类和单个文件进行组控制，因此采取了以下的改动：

添加的文件
groupaccess.php 这个文件是从wfsection中提出来的，原先使用的是1.3.x中的，并针对xoops2.0做了改动，后来发现wfsection中针对2.0版的也出来了，于是把原先改动版的舍弃，用最新的，但发现不能用原先的方式执行，又改回老版了(因为本人对php不是很熟，所以怕自己改动的有问题，还是用专业的吧！但本人不喜欢新程序的那种组选择方式，改成原先的形式了，即由列表改成了，选择式。)。这个文件原先放置在根目录下的include中，后来考虑大家使用的麻烦，还是放置在wmpdownload的include中了。

变更文件：

添加字段：考虑添加分类(子类)及文件时要有对组控制的选项，下载时也要对组进行控制，因此数据库中的分类表(download_cat)及文件表(download_download)添加了组字段(groupid )。进行组控制时会对这个字段中的数据进行读写判断。
	变更地方在sql目录中的mysql.sql文件,在CREATE TABLE wmpdownloads_cat和CREATE TABLE wmpdownloads_downloads中都添加了  groupid  varchar(100)NOT NULL default '1 2 3', 默认的组为1、2、3即xoops系统中的游客、注册会员及管理员。大家可以前后参照对比。
	这样在进行模组安装时就会自动生成对应字段。如果你已经安装了模块则需要卸载模块重新安装，否非则数据库不会被更新。你要想保留原先的数据不受影响，可用phpMyAdmin进行手动添加，这里就不详细描述，相信熟悉phpMyAdmin的不是一件难事。

修改文件，增加组控制
这部分很麻烦，希望大家仔细看，否则会出错！
admin目录中index.php文件
A.添加调用文件

在这句下面
include_once(XOOPS_ROOT_PATH . "/class/module.errorhandler.php");

Add:添加
include_once("../include/groupaccess.php");

B.在“添加主分类项目”部分添加组选项function downloadsConfigMenu()

把：
echo "<h4>"._MD_ADDMAIN."</h4><br>"._MD_TITLEC."<input type=text name=title size=30 maxlength=50><br>";

改成：
echo "<h4>"._MD_ADDMAIN."</h4>";
listGroups("checkAll");
echo "<br /><br />"._MD_TITLEC."<input type=text name=title size=30 maxlength=50><br>";

你刷新一下，http://www.edu18.com/xoops2/modules/wmpdownloads/admin/index.php?op=downloadsConfigMenu是不是看到了效果！

C.在“添加子分类”部分添加组选项function downloadsConfigMenu()

(这部分，如果你没有主类是看不到的)

把:
echo "<h4>"._MD_ADDSUB."</h4><br />"._MD_TITLEC."<input type=text name=title size=30 maxlength=50>&nbsp;"._MD_IN."&nbsp;";

改成：
echo "<h4>"._MD_ADDSUB."</h4>";
listGroups("checkAll");
echo "<br /><br />"._MD_TITLEC."<input type=text name=title size=30 maxlength=50>&nbsp;"._MD_IN."&nbsp;";

D.添加分类部分添加对数据库操作部分

由于上面的B、C步骤改动的仅是你能看到的部分，而不能写入数据库，下面对数据库操作部分进行改动
function addCat()部分，这部分是主分类和子分类的共用部分
在这行上面:
$title = $myts->makeTboxData4Save($HTTP_POST_VARS["title"]);

添加:
$groupid  = saveAccess($HTTP_POST_VARS["groupid "]);

把：
$sql = sprintf("INSERT INTO %s (cid, pid, title, imgurl) VALUES (%u, %u, '%s', '%s')", $xoopsDB->prefix("wmpdownloads_cat"), $newid, $pid, $title, $imgurl);

改成：
$sql = sprintf("INSERT INTO %s (cid, pid, groupid , title, imgurl) VALUES (%u, %u, '%s','%s', '%s')", $xoopsDB->prefix("wmpdownloads_cat"), $newid, $pid, $groupid , $title, $imgurl);

不难看出上面的改变。好了，到这里已经能够把我们希望的类写在数据中了(如果你用phpMyAdmin可以看到变化)。
(刚才收音机中传来了0点的声音，尽管近期“非典”流行严重，应该注意保护身体，但还是把这些做完吧！)

E.给添加文件部分添加组选项function downloadsConfigMenu()
把:
echo "<h4>"._MD_ADDNEWFILE."</h4><br>";
echo "<table width=\"80%\"><tr>\n";

改成:
echo "<h4>"._MD_ADDNEWFILE."</h4><br>";
listGroups("checkAll");
echo "<br /><br /><table width=\"80%\"><tr>\n";


F.添加文件部分加入对数据库的操作function addDownload()

在上面:
$logourl = $myts->makeTboxData4Save($HTTP_POST_VARS["logourl"]);

加入:
$groupid = saveAccess($HTTP_POST_VARS["groupid"]);

----------------------------------

把:
$sql = sprintf("INSERT INTO %s (lid, cid, title, url, homepage, version, size, platform, logourl, submitter, status, date, hits, rating, votes, comments) VALUES (%u, %u, '%s', '%s', '%s', '%s', %u, '%s', '%s', %u, %u, %u, %u, %u, %u, %u)", $xoopsDB->prefix("wmpdownloads_downloads"), $newid, $cid, $title, $url, $homepage, $version, $size, $platform, $logourl, $submitter, 1, time(), 0, 0, 0, 0);
改成：
$sql = sprintf("INSERT INTO %s (lid, cid, groupid, title, url, homepage, version, size, platform, logourl, submitter, status, date, hits, rating, votes, comments) VALUES (%u, %u, '%s', '%s', '%s', '%s', '%s', %u, '%s', '%s', %u, %u, %u, %u, %u, %u, %u)", $xoopsDB->prefix("wmpdownloads_downloads"), $newid, $cid, $groupid, $title, $url, $homepage, $version, $size, $platform, $logourl, $submitter, 1, time(), 0, 0, 0, 0);

这样，你又可以把对文件进行组控制的信息写入数据库了

G.变更分类修改部分的功能function modCat()，function modCatS()
有时我们需要对分类和下载文件的组别权限进行变更，下面就是这部分功能的实现
function modCat()中
把：
$result=$xoopsDB->query("SELECT pid, title, imgurl FROM ".$xoopsDB->prefix("wmpdownloads_cat")." WHERE cid=$cid");
list($pid,$title,$imgurl) = $xoopsDB->fetchRow($result);

改成：
$result=$xoopsDB->query("SELECT pid, groupid, title, imgurl FROM ".$xoopsDB->prefix("wmpdownloads_cat")." WHERE cid=$cid");
list($pid,$groupid,$title,$imgurl) = $xoopsDB->fetchRow($result);

把：
echo "<form action=index.php method=post>"._MD_TITLEC."<input type=text name=title value=\"$title\" size=51 maxlength=50><br /><br />"._MD_IMGURLMAIN."<br /><input type=text name=imgurl value=\"$imgurl\" size=100 maxlength=150><br />

改成：
echo "<form action=index.php method=post>";
listGroups($groupid);
echo "<br /><br />"._MD_TITLEC."<input type=text name=title value=\"$title\" size=51 maxlength=50><br><br>"._MD_IMGURLMAIN."<br><input type=text name=imgurl value=\"$imgurl\" size=100 maxlength=150><br>

function modCatS()中：

把：
$sql = sprintf("UPDATE %s SET title = '%s', imgurl = '%s', pid = %u WHERE cid = %u", $xoopsDB->prefix("wmpdownloads_cat"), $title, $imgurl, $sid, $cid);

改成：
$groupid = saveAccess($HTTP_POST_VARS["groupid"]);
$sql = sprintf("UPDATE %s SET groupid='%s', title = '%s', imgurl = '%s', pid = %u WHERE cid = %u", $xoopsDB->prefix("wmpdownloads_cat"), $groupid, $title, $imgurl, $sid, $cid);

H.变更文件修改部分：function modDownload()和function modDownloads()

function modDownload()部分
把:
$result = $xoopsDB->query("SELECT cid, title, url, homepage, version, size, platform, logourl FROM ".$xoopsDB->prefix("wmpdownloads_downloads")." WHERE lid=$lid") or $eh->show("0013");
和:
list($cid, $title, $url, $homepage, $version, $size, $platform, $logourl) = $xoopsDB->fetchRow($result);

改成:
$result = $xoopsDB->query("SELECT cid, title, url, homepage, version, size, platform, logourl, groupid FROM ".$xoopsDB->prefix("wmpdownloads_downloads")." WHERE lid=$lid") or $eh->show("0013");
和:
list($cid, $title, $url, $homepage, $version, $size, $platform, $logourl, $groupid) = $xoopsDB->fetchRow($result);


在此下面：
echo "<form method=post action=index.php>";

加入:
echo "<tr><td colspan=2>".listGroups($groupid)."</td></tr>";

function modDownloadS()部分

在此上面:
$logourl = $myts->makeTboxData4Save($HTTP_POST_VARS["logourl"]);

加入:
$groupid = saveAccess($HTTP_POST_VARS["groupid"]);

----------------------------------

把:
$sql = sprintf("UPDATE %s SET cid = %u, title = '%s', url = '%s', homepage = '%s', version = '%s', size = %u, platform = '%s', logourl = '%s', status = %u, date = %u WHERE lid = %u", $xoopsDB->prefix("wmpdownloads_downloads"), $cid, $title, $url, $homepage, $version, $size, $platform, $logourl, 2, time(), $HTTP_POST_VARS['lid']);

改成:
$sql = sprintf("UPDATE %s SET cid = %u, groupid = '%s', title = '%s', url = '%s', homepage = '%s', version = '%s', size = %u, platform = '%s', logourl = '%s', status = %u, date = %u WHERE lid = %u", $xoopsDB->prefix("wmpdownloads_downloads"), $cid, $groupid, $title, $url, $homepage, $version, $size, $platform, $logourl, 2, time(), $HTTP_POST_VARS['lid']);

好了，至此管理员部分已经修改完毕，但这些仅能使系统具备了分组权限控制的条件，下面就有进行组限制了，使没有授权的组员不能访问对应的分类或文件

I.控制分类查看权力
分类查看是通过文件viewcat.php实现的，为此我们给它加上组判别，符合条件的通过，不符合的跳出
在此之后:
include XOOPS_ROOT_PATH."/header.php";

加入:
include_once("./include/groupaccess.php");
$query=$xoopsDB->query("SELECT groupid FROM ".$xoopsDB->prefix("wmpdownloads_cat")." WHERE cid='$cid'");
list($groupid) = $xoopsDB->fetchRow($query);
checkAccess($groupid, "javascript:history.go(-1)", 2, _NOPERM);

这样查看分类时首先判断是否符合组要求，符合就过去，不符合就返回上页面。

J.对文件下载权限的控制。

下载文件是通过visit.php文件进行的。


在此下面：
include_once(XOOPS_ROOT_PATH . "/class/module.textsanitizer.php");

添加:
include_once("./include/groupaccess.php");

----------------------------------

把:
$result = $xoopsDB->query("SELECT url FROM ".$xoopsDB->prefix("wmpdownloads_downloads")." WHERE lid=$lid AND status>0");
list($url) = $xoopsDB->fetchRow($result);

改成:
$result = $xoopsDB->query("SELECT url, groupid FROM ".$xoopsDB->prefix("wmpdownloads_downloads")." WHERE lid=$lid AND status>0");
list($url, $groupid) = $xoopsDB->fetchRow($result);
checkAccess($groupid, XOOPS_URL, 2, _NOPERM);

OK，大功告成！大家测试一下，看看还有什么问题，及时和我联系！









