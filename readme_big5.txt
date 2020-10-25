散播此軟體時請勿刪除此檔案
wenmingpig 文明豬製作 y2000@yeah.net
題王題網http://www.tiwang.com
誠正教育網http://www.edu18.com

///////////// 歡迎連絡介紹工作業務給我！
專業承接教育項目合作、教育軟體的開發、教育網站開發等業務，
業務聯繫 webmaster@edu18.com

針對xoops2.0.1 海微中文版,感謝海微！
如果有什麼問題可以給我發mail或到海微站http://www.hiweed.com上發帖


wmpdownload簡介
這個模組由文明豬在mydownload基礎上改造而成的。
模組中變動如下：

１系統增加了樹狀子類/檔案添加
這部分給分類複雜的下載系統提供了非常方便的子類與檔案添加功能，但檔案添加功能是經過簡化的，儘管可以用原先的一些功能，但在這裡你沒有得到提示！
由於修改、刪除和修改等功能用的比較少，因此這裡沒有提供！

添加的檔案有：

admin目錄中
tree.html 這是一個frame索引頁
tree.php 左側的frame,提供把數據庫download_cat中的分類進行樹狀顯示的功能，其中標題後面括弧中的數字是這個子類的cid號碼，以便和右邊frame對應，本程序本著簡化使用的原則沒有提供右側的標題。由於功能是拼湊程序，並且本人的能力實在有限，因此大家應該手工修改裡面的數據庫選項，目前本程序沒有考慮數據安全等因素，希望大家使用時注意！
treeop.php 右側的操作程序，這個程序根據左側提供的cid號碼進行子類和下載檔案的添加，這項操作必須是管理員身份進入，否則會退到登錄頁面。對於檔案添加部分功能進行了簡化。
about.html簡單的說明頁面。

變更的檔案:

admin目錄中
index.php 為了配合樹狀的頁面和使添加檔案更方便，對function addCat()和function addDownload()最後一句做了修改，最後一句的作用是操作返回，這裡改成了返回上一頁面處理，具體變更方式大家可打開檔案自己觀看，非常簡單。

為了管理員能夠從管理菜單索引到這個功能，在index.php和menu.php中添加了對應的功能。

２groupaccess功能
對於一些檔案，有時需要控制下載的人員，比如收費或管理人員等，這時候需要進行組控制。
為對分類和單個檔案進行組控制，因此採取了以下的改動：

添加的檔案
groupaccess.php 這個檔案是從wfsection中提出來的，原先使用的是1.3.x中的，並針對xoops2.0做了改動，後來發現wfsection中針對2.0版的也出來了，於是把原先改動版的捨棄，用最新的，但發現不能用原先的方式執行，又改回老版了(因為本人對php不是很熟，所以怕自己改動的有問題，還是用專業的吧！但本人不喜歡新程序的那種組選擇方式，改成原先的形式了，即由列表改成了，選擇式。)。這個檔案原先放置在根目錄下的include中，後來考慮大家使用的麻煩，還是放置在wmpdownload的include中了。

變更檔案：

添加字段：考慮添加分類(子類)及檔案時要有對組控制的選項，下載時也要對組進行控制，因此數據庫中的分類表(download_cat)及檔案表(download_download)添加了組字段(groupid )。進行組控制時會對這個字段中的數據進行讀寫判斷。
	變更地方在sql目錄中的mysql.sql檔案,在CREATE TABLE wmpdownloads_cat和CREATE TABLE wmpdownloads_downloads中都添加了  groupid  varchar(100)NOT NULL default '1 2 3', 默認的組為1、2、3即xoops系統中的遊客、註冊會員及管理員。大家可以前後參照對比。
	這樣在進行模組安裝時就會自動生成對應字段。如果你已經安裝了模組則需要卸載模組重新安裝，否非則數據庫不會被更新。你要想保留原先的數據不受影響，可用phpMyAdmin進行手動添加，這裡就不詳細描述，相信熟悉phpMyAdmin的不是一件難事。

修改檔案，增加組控制
這部分很麻煩，希望大家仔細看，否則會出錯！
admin目錄中index.php檔案
A.添加調用檔案

在這句下面
include_once(XOOPS_ROOT_PATH . "/class/module.errorhandler.php");

Add:添加
include_once("../include/groupaccess.php");

B.在「添加主分類項目」部分添加組選項function downloadsConfigMenu()

把：
echo "<h4>"._MD_ADDMAIN."</h4><br>"._MD_TITLEC."<input type=text name=title size=30 maxlength=50><br>";

改成：
echo "<h4>"._MD_ADDMAIN."</h4>";
listGroups("checkAll");
echo "<br /><br />"._MD_TITLEC."<input type=text name=title size=30 maxlength=50><br>";

你刷新一下，http://www.edu18.com/xoops2/modules/wmpdownloads/admin/index.php?op=downloadsConfigMenu是不是看到了效果！

C.在「添加子分類」部分添加組選項function downloadsConfigMenu()

(這部分，如果你沒有主類是看不到的)

把:
echo "<h4>"._MD_ADDSUB."</h4><br />"._MD_TITLEC."<input type=text name=title size=30 maxlength=50>&nbsp;"._MD_IN."&nbsp;";

改成：
echo "<h4>"._MD_ADDSUB."</h4>";
listGroups("checkAll");
echo "<br /><br />"._MD_TITLEC."<input type=text name=title size=30 maxlength=50>&nbsp;"._MD_IN."&nbsp;";

D.添加分類部分添加對數據庫操作部分

由於上面的B、C步驟改動的僅是你能看到的部分，而不能寫入數據庫，下面對數據庫操作部分進行改動
function addCat()部分，這部分是主分類和子分類的共用部分
在這行上面:
$title = $myts->makeTboxData4Save($HTTP_POST_VARS["title"]);

添加:
$groupid  = saveAccess($HTTP_POST_VARS["groupid "]);

把：
$sql = sprintf("INSERT INTO %s (cid, pid, title, imgurl) VALUES (%u, %u, '%s', '%s')", $xoopsDB->prefix("wmpdownloads_cat"), $newid, $pid, $title, $imgurl);

改成：
$sql = sprintf("INSERT INTO %s (cid, pid, groupid , title, imgurl) VALUES (%u, %u, '%s','%s', '%s')", $xoopsDB->prefix("wmpdownloads_cat"), $newid, $pid, $groupid , $title, $imgurl);

不難看出上面的改變。好了，到這裡已經能夠把我們希望的類寫在數據中了(如果你用phpMyAdmin可以看到變化)。
(剛才收音機中傳來了0點的聲音，儘管近期「非典」流行嚴重，應該注意保護身體，但還是把這些做完吧！)

E.給添加檔案部分添加組選項function downloadsConfigMenu()
把:
echo "<h4>"._MD_ADDNEWFILE."</h4><br>";
echo "<table width=\"80%\"><tr>\n";

改成:
echo "<h4>"._MD_ADDNEWFILE."</h4><br>";
listGroups("checkAll");
echo "<br /><br /><table width=\"80%\"><tr>\n";


F.添加檔案部分加入對數據庫的操作function addDownload()

在上面:
$logourl = $myts->makeTboxData4Save($HTTP_POST_VARS["logourl"]);

加入:
$groupid = saveAccess($HTTP_POST_VARS["groupid"]);

----------------------------------

把:
$sql = sprintf("INSERT INTO %s (lid, cid, title, url, homepage, version, size, platform, logourl, submitter, status, date, hits, rating, votes, comments) VALUES (%u, %u, '%s', '%s', '%s', '%s', %u, '%s', '%s', %u, %u, %u, %u, %u, %u, %u)", $xoopsDB->prefix("wmpdownloads_downloads"), $newid, $cid, $title, $url, $homepage, $version, $size, $platform, $logourl, $submitter, 1, time(), 0, 0, 0, 0);
改成：
$sql = sprintf("INSERT INTO %s (lid, cid, groupid, title, url, homepage, version, size, platform, logourl, submitter, status, date, hits, rating, votes, comments) VALUES (%u, %u, '%s', '%s', '%s', '%s', '%s', %u, '%s', '%s', %u, %u, %u, %u, %u, %u, %u)", $xoopsDB->prefix("wmpdownloads_downloads"), $newid, $cid, $groupid, $title, $url, $homepage, $version, $size, $platform, $logourl, $submitter, 1, time(), 0, 0, 0, 0);

這樣，你又可以把對檔案進行組控制的信息寫入數據庫了

G.變更分類修改部分的功能function modCat()，function modCatS()
有時我們需要對分類和下載檔案的組別權限進行變更，下面就是這部分功能的實現
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

H.變更檔案修改部分：function modDownload()和function modDownloads()

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

好了，至此管理員部分已經修改完畢，但這些僅能使系統具備了分組權限控制的條件，下面就有進行組限制了，使沒有授權的組員不能訪問對應的分類或檔案

I.控制分類查看權力
分類查看是通過檔案viewcat.php實現的，為此我們給它加上組判別，符合條件的通過，不符合的跳出
在此之後:
include XOOPS_ROOT_PATH."/header.php";

加入:
include_once("./include/groupaccess.php");
$query=$xoopsDB->query("SELECT groupid FROM ".$xoopsDB->prefix("wmpdownloads_cat")." WHERE cid='$cid'");
list($groupid) = $xoopsDB->fetchRow($query);
checkAccess($groupid, "javascript:history.go(-1)", 2, _NOPERM);

這樣查看分類時首先判斷是否符合組要求，符合就過去，不符合就返回上頁面。

J.對檔案下載權限的控制。

下載檔案是通過visit.php檔案進行的。


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

OK，大功告成！大家測試一下，看看還有什麼問題，及時和我聯繫！

