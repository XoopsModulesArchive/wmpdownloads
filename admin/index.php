<?php
// $Id: index.php,v 1.15 2003/03/28 14:54:24 w4z004 Exp $
//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                    Copyright (c) 2000 XOOPS.org                           //
//                       <https://www.xoops.org>                             //
// ------------------------------------------------------------------------- //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  You may not change or alter any portion of this comment or credits       //
//  of supporting developers from this source code or any supporting         //
//  source code which is considered copyrighted (c) material of the          //
//  original comment or credit authors.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
//  ------------------------------------------------------------------------ //

require dirname(__DIR__, 3) . '/include/cp_header.php';
if (file_exists('../language/' . $xoopsConfig['language'] . '/main.php')) {
    include '../language/' . $xoopsConfig['language'] . '/main.php';
} else {
    include '../language/schinese/main.php';
}
include '../include/functions.php';
require_once XOOPS_ROOT_PATH . '/class/xoopstree.php';
require_once XOOPS_ROOT_PATH . '/class/xoopslists.php';
require_once XOOPS_ROOT_PATH . '/include/xoopscodes.php';
require_once XOOPS_ROOT_PATH . '/class/module.errorhandler.php';
require_once '../include/groupaccess.php'; //峈郪諷秶氝樓
$myts = MyTextSanitizer::getInstance();
$eh = new ErrorHandler();
$mytree = new XoopsTree($xoopsDB->prefix('wmpdownloads_cat'), 'cid', 'pid');

function wmpdownloads()
{
    global $xoopsDB, $xoopsModule;

    xoops_cp_header();

    echo '<h4>' . _MD_DLCONF . '</h4>';

    echo "<table width='100%' border='0' cellspacing='1' class='outer'>"
        . '<tr class="odd"><td>';

    // Temporarily 'homeless' downloads (to be revised in index.php breakup)

    $result = $xoopsDB->query('SELECT COUNT(*) FROM ' . $xoopsDB->prefix('wmpdownloads_broken') . '');

    [$totalbrokendownloads] = $xoopsDB->fetchRow($result);

    if ($totalbrokendownloads > 0) {
        $totalbrokendownloads = "<span style='color: #ff0000; font-weight: bold'>$totalbrokendownloads</span>";
    }

    $result2 = $xoopsDB->query('SELECT COUNT(*) FROM ' . $xoopsDB->prefix('wmpdownloads_mod') . '');

    [$totalmodrequests] = $xoopsDB->fetchRow($result2);

    if ($totalmodrequests > 0) {
        $totalmodrequests = "<span style='color: #ff0000; font-weight: bold'>$totalmodrequests</span>";
    }

    $result3 = $xoopsDB->query('SELECT COUNT(*) FROM ' . $xoopsDB->prefix('wmpdownloads_downloads') . ' WHERE status=0');

    [$totalnewdownloads] = $xoopsDB->fetchRow($result3);

    if ($totalnewdownloads > 0) {
        $totalnewdownloads = "<span style='color: #ff0000; font-weight: bold'>$totalnewdownloads</span>";
    }

    echo " - <a href='" . XOOPS_URL . '/modules/system/admin.php?fct=preferences&amp;op=showmod&amp;mod=' . $xoopsModule->getVar('mid') . "'>" . _MD_GENERALSET . '</a>';

    echo '<br><br>';

    echo ' - <a href=index.php?op=downloadsConfigMenu>' . _MD_ADDMODDELETE . '</a>';

    echo '<br><br>';

    /*該功能為目錄管理，為安全起見將其功能取消
    echo " - <a href=tree.html target='_blank'>"._MI_wmpdownloadS_ADMENU6."</a>";
    echo "<br><br>";
    */

    echo ' - <a href=index.php?op=listNewDownloads>' . _MD_DLSWAITING . " ($totalnewdownloads)</a>";

    echo '<br><br>';

    echo ' - <a href=index.php?op=listBrokenDownloads>' . _MD_BROKENREPORTS . " ($totalbrokendownloads)</a>";

    echo '<br><br>';

    echo ' - <a href=index.php?op=listModReq>' . _MD_MODREQUESTS . " ($totalmodrequests)</a>";

    $result = $xoopsDB->query('SELECT COUNT(*) FROM ' . $xoopsDB->prefix('wmpdownloads_downloads') . ' WHERE status>0');

    [$numrows] = $xoopsDB->fetchRow($result);

    echo '<br><br><div>';

    printf(_MD_THEREARE, $numrows);

    echo '</div>';

    echo '</td></tr></table>';

    xoops_cp_footer();
}

function listNewDownloads()
{
    global $xoopsDB, $myts, $eh, $mytree;

    // List downloads waiting for validation

    $downimg_array = XoopsLists::getImgListAsArray(XOOPS_ROOT_PATH . '/modules/wmpdownloads/images/shots/');

    $result = $xoopsDB->query('SELECT lid, cid, title, url, homepage, version, size, platform, logourl, submitter FROM ' . $xoopsDB->prefix('wmpdownloads_downloads') . ' where status=0 ORDER BY date DESC');

    $numrows = $xoopsDB->getRowsNum($result);

    xoops_cp_header();

    echo '<h4>' . _MD_DLCONF . '</h4>';

    echo "<table width='100%' border='0' cellspacing='1' class='outer'>"
           . '<tr class="odd"><td>';

    echo '<h4>' . _MD_DLSWAITING . "&nbsp;($numrows)</h4><br>";

    if ($numrows > 0) {
        while (list($lid, $cid, $title, $url, $homepage, $version, $size, $platform, $logourl, $uid) = $xoopsDB->fetchRow($result)) {
            $result2 = $xoopsDB->query('SELECT description FROM ' . $xoopsDB->prefix('wmpdownloads_text') . " WHERE lid=$lid");

            [$description] = $xoopsDB->fetchRow($result2);

            $title = htmlspecialchars($title, ENT_QUOTES | ENT_HTML5);

            $url = htmlspecialchars($url, ENT_QUOTES | ENT_HTML5);

            $homepage = htmlspecialchars($homepage, ENT_QUOTES | ENT_HTML5);

            $version = htmlspecialchars($version, ENT_QUOTES | ENT_HTML5);

            $size = htmlspecialchars($size, ENT_QUOTES | ENT_HTML5);

            $platform = htmlspecialchars($platform, ENT_QUOTES | ENT_HTML5);

            $description = htmlspecialchars($description, ENT_QUOTES | ENT_HTML5);

            $submitter = XoopsUser::getUnameFromId($uid);

            echo "<form action=\"index.php\" method=post>\n";

            echo '<table width="80%">';

            echo '<tr><td align="right" nowrap>' . _MD_SUBMITTER . "</td><td>\n";

            echo '<a href="' . XOOPS_URL . '/userinfo.php?uid=' . $uid . "\">$submitter</a>";

            echo "</td></tr>\n";

            echo '<tr><td align="right" nowrap>' . _MD_FILETITLE . '</td><td>';

            echo "<input type=\"text\" name=\"title\" size=\"50\" maxlength=\"100\" value=\"$title\">";

            echo '</td></tr><tr><td align="right" nowrap>' . _MD_DLURL . '</td><td>';

            echo "<input type=\"text\" name=\"url\" size=\"50\" maxlength=\"250\" value=\"$url\">";

            echo "&nbsp;[&nbsp;<a href=\"$url\">" . _MD_DOWNLOAD . '</a>&nbsp;]';

            echo '</td></tr>';

            echo '<tr><td align="right" nowrap>' . _MD_CATEGORYC . '</td><td>';

            $mytree->makeMySelBox('title', 'title', $cid);

            echo "</td></tr>\n";

            echo '<tr><td align="right" nowrap>' . _MD_HOMEPAGEC . "</td><td>\n";

            echo "<input type=\"text\" name=\"homepage\" size=\"50\" maxlength=\"100\" value=\"$homepage\"></td></tr>\n";

            echo '<tr><td align="right">' . _MD_VERSIONC . "</td><td>\n";

            echo "<input type=\"text\" name=\"version\" size=\"10\" maxlength=\"10\" value=\"$version\"></td></tr>\n";

            echo '<tr><td align="right">' . _MD_FILESIZEC . "</td><td>\n";

            echo "<input type=\"text\" name=\"size\" size=\"10\" maxlength=\"8\" value=\"$size\">" . _MD_BYTES . "</td></tr>\n";

            echo '<tr><td align="right">' . _MD_PLATFORMC . "</td><td>\n";

            echo "<input type=\"text\" name=\"platform\" size=\"45\" maxlength=\"50\" value=\"$platform\"></td></tr>\n";

            echo '<tr><td align="right" valign="top" nowrap>' . _MD_DESCRIPTIONC . "</td><td>\n";

            echo "<textarea name=description cols=\"60\" rows=\"5\">$description</textarea>\n";

            echo "</td></tr>\n";

            echo '<tr><td align="right" nowrap>' . _MD_SHOTIMAGE . "</td><td>\n";

            //echo "<input type=\"text\" name=\"logourl\" size=\"50\" maxlength=\"60\">\n";

            echo "<select size='1' name='logourl'>";

            echo "<option value=' '>------</option>";

            foreach ($downimg_array as $image) {
                echo "<option value='" . $image . "'>" . $image . '</option>';
            }

            echo '</select>';

            echo '</td></tr><tr><td></td><td>';

            $directory = XOOPS_URL . '/modules/wmpdownloads/images/shots/';

            printf(_MD_MUSTBEVALID, $directory);

            echo "</table>\n";

            echo '<br><input type="hidden" name="op" value="approve"></input>';

            echo "<input type=\"hidden\" name=\"lid\" value=\"$lid\"></input>";

            echo '<input type="submit" value="' . _MD_APPROVE . "\"></form>\n";

            echo myTextForm("index.php?op=delNewDownload&lid=$lid", _MD_DELETE);

            echo '<br><br>';
        }
    } else {
        echo _MD_NOSUBMITTED;
    }

    echo '</td></tr></table>';

    xoops_cp_footer();
}

function downloadsConfigMenu()
{
    global $xoopsDB, $myts, $eh, $mytree;

    // Add a New Main Category

    xoops_cp_header();

    $downimg_array = XoopsLists::getImgListAsArray(XOOPS_ROOT_PATH . '/modules/wmpdownloads/images/shots/');

    echo '<h4>' . _MD_DLCONF . '</h4>';

    echo "<table width='100%' border='0' cellspacing='1' class='outer'>"
           . '<tr class="odd"><td>';

    echo "<form method=post action=index.php>\n";

    //echo "<h4>"._MD_ADDMAIN."</h4><br>"._MD_TITLEC."<input type=text name=title size=30 maxlength=50><br>";

    echo '<h4>' . _MD_ADDMAIN . '</h4>';

    listGroups('checkAll');

    echo '<br><br>' . _MD_TITLEC . '<input type=text name=title size=30 maxlength=50><br>';

    echo _MD_IMGURL . '<br><input type="text" name="imgurl" size="100" maxlength="150" value="http://"><br><br>';

    echo "<input type=hidden name=cid value=0>\n";

    echo '<input type=hidden name=op value=addCat>';

    echo '<input type=submit value=' . _MD_ADD . '><br></form>';

    echo '</td></tr></table>';

    echo '<br>';

    // Add a New Sub-Category

    $result = $xoopsDB->query('SELECT COUNT(*) FROM ' . $xoopsDB->prefix('wmpdownloads_cat') . '');

    [$numrows] = $xoopsDB->fetchRow($result);

    if ($numrows > 0) {
        echo "<table width='100%' border='0' cellspacing='1' class='outer'>"
                   . '<tr class="odd"><td>';

        echo '<form method=post action=index.php>';

        //echo "<h4>"._MD_ADDSUB."</h4><br>"._MD_TITLEC."<input type=text name=title size=30 maxlength=50>&nbsp;"._MD_IN."&nbsp;";

        echo '<h4>' . _MD_ADDSUB . '</h4>';

        listGroups('checkAll');

        echo '<br><br>' . _MD_TITLEC . '<input type=text name=title size=30 maxlength=50>&nbsp;' . _MD_IN . '&nbsp;';

        $mytree->makeMySelBox('title', 'title');

        #               echo "<br>"._MD_IMGURL."<br><input type=\"text\" name=\"imgurl\" size=\"100\" maxlength=\"150\">\n";

        echo '<input type=hidden name=op value=addCat><br><br>';

        echo '<input type=submit value=' . _MD_ADD . '><br></form>';

        echo '</td></tr></table>';

        echo '<br>';

        // If there is a category, add a New Download

        echo "<table width='100%' border='0' cellspacing='1' class='outer'>"
                   . '<tr class="odd"><td>';

        echo "<form method=post action=index.php>\n";

        //echo "<h4>"._MD_ADDNEWFILE."</h4><br>\n";

        //echo "<table width=\"80%\"><tr>\n";

        echo '<h4>' . _MD_ADDNEWFILE . '</h4><br>';

        listGroups('checkAll');

        echo "<br><br><table width=\"80%\"><tr>\n";

        echo '<td align="right">' . _MD_FILETITLE . '</td><td>';

        echo '<input type=text name=title size=50 maxlength=100>';

        echo '</td></tr><tr><td align="right" nowrap>' . _MD_DLURL . '</td><td>';

        echo '<input type=text name=url size=50 maxlength=250 value="http://">';

        echo '</td></tr>';

        echo '<tr><td align="right" nowrap>' . _MD_CATEGORYC . '</td><td>';

        $mytree->makeMySelBox('title', 'title');

        echo "</td></tr><tr><td></td><td></td></tr>\n";

        echo '<tr><td align="right" nowrap>' . _MD_HOMEPAGEC . "</td><td>\n";

        echo "<input type=text name=homepage size=50 maxlength=100 value=\"http://\"></td></tr>\n";

        echo '<tr><td align="right">' . _MD_VERSIONC . "</td><td>\n";

        echo "<input type=text name=version size=10 maxlength=10></td></tr>\n";

        echo '<tr><td align="right">' . _MD_FILESIZEC . "</td><td>\n";

        echo '<input type=text name=size size=10 maxlength=100>' . _MD_BYTES . "</td></tr>\n";

        echo '<tr><td align="right">' . _MD_PLATFORMC . "</td><td>\n";

        echo "<input type=text name=platform size=45 maxlength=60></td></tr>\n";

        echo '<tr><td align="right" valign="top" nowrap>' . _MD_DESCRIPTIONC . "</td><td>\n";

        xoopsCodeTarea('description', 60, 8);

        xoopsSmilies('description');

        //echo "<textarea name=description cols=60 rows=5></textarea>\n";

        echo "</td></tr>\n";

        echo '<tr><td align="right"nowrap>' . _MD_SHOTIMAGE . "</td><td>\n";

        echo "<select size='1' name='logourl'>";

        echo "<option value=' '>------</option>";

        foreach ($downimg_array as $image) {
            echo "<option value='" . $image . "'>" . $image . '</option>';
        }

        echo '</select>';

        //echo "<input type=\"text\" name=\"logourl\" size=\"50\" maxlength=\"60\">";

        echo "</td></tr>\n";

        echo '<tr><td align="right"></td><td>';

        $directory = XOOPS_URL . '/modules/wmpdownloads/images/shots/';

        printf(_MD_MUSTBEVALID, $directory);

        echo "</td></tr>\n";

        echo "</table>\n<br>";

        echo '<input type="hidden" name="op" value="addDownload"></input>';

        echo '<input type="submit" class="button" value="' . _MD_ADD . "\"></input>\n";

        echo '</form>';

        echo '</td></tr></table>';

        echo '<br>';

        // Modify Category

        echo "<table width='100%' border='0' cellspacing='1' class='outer'>"
                   . '<tr class="odd"><td>';

        echo '<form method=post action=index.php><h4>' . _MD_MODCAT . '</h4><br>';

        echo _MD_CATEGORYC;

        $mytree->makeMySelBox('title', 'title');

        echo "<br><br>\n";

        echo "<input type=hidden name=op value=modCat>\n";

        echo '<input type=submit value=' . _MD_MODIFY . ">\n";

        echo '</form>';

        echo '</td></tr></table>';

        echo '<br>';
    }

    // Modify Download

    $result2 = $xoopsDB->query('SELECT COUNT(*) FROM ' . $xoopsDB->prefix('wmpdownloads_downloads') . '');

    [$numrows2] = $xoopsDB->fetchRow($result2);

    if ($numrows2 > 0) {
        echo "<table width='100%' border='0' cellspacing='1' class='outer'>"
                   . '<tr class="odd"><td>';

        echo "<form method=get action=\"index.php\">\n";

        echo '<h4>' . _MD_MODDL . "</h4><br>\n";

        echo _MD_FILEID . "<input type=text name=lid size=12 maxlength=11>\n";

        echo "<input type=hidden name=fct value=wmpdownloads>\n";

        echo "<input type=hidden name=op value=modDownload><br><br>\n";

        echo '<input type=submit value=' . _MD_MODIFY . "></form>\n";

        echo '</td></tr></table>';
    }

    xoops_cp_footer();
}

function modDownload()
{
    global $xoopsDB, $_GET, $myts, $eh, $mytree;

    $downimg_array = XoopsLists::getImgListAsArray(XOOPS_ROOT_PATH . '/modules/wmpdownloads/images/shots/');

    $lid = $_GET['lid'];

    xoops_cp_header();

    echo '<h4>' . _MD_DLCONF . '</h4>';

    echo "<table width='100%' border='0' cellspacing='1' class='outer'>"
           . '<tr class="odd"><td>';

    //$result = $xoopsDB->query("SELECT cid, title, url, homepage, version, size, platform, logourl FROM ".$xoopsDB->prefix("wmpdownloads_downloads")." WHERE lid=$lid") or $eh->show("0013");

    $result = $xoopsDB->query('SELECT cid, title, url, homepage, version, size, platform, logourl, groupid FROM ' . $xoopsDB->prefix('wmpdownloads_downloads') . " WHERE lid=$lid") or $eh::show('0013');

    echo '<h4>' . _MD_MODDL . '</h4><br>';

    //list($cid, $title, $url, $homepage, $version, $size, $platform, $logourl) = $xoopsDB->fetchRow($result);

    [$cid, $title, $url, $homepage, $version, $size, $platform, $logourl, $groupid] = $xoopsDB->fetchRow($result);

    $title = htmlspecialchars($title, ENT_QUOTES | ENT_HTML5);

    $url = htmlspecialchars($url, ENT_QUOTES | ENT_HTML5);

    $homepage = htmlspecialchars($homepage, ENT_QUOTES | ENT_HTML5);

    $version = htmlspecialchars($version, ENT_QUOTES | ENT_HTML5);

    $size = htmlspecialchars($size, ENT_QUOTES | ENT_HTML5);

    $platform = htmlspecialchars($platform, ENT_QUOTES | ENT_HTML5);

    $logourl = htmlspecialchars($logourl, ENT_QUOTES | ENT_HTML5);

    $result2 = $xoopsDB->query('SELECT description FROM ' . $xoopsDB->prefix('wmpdownloads_text') . " WHERE lid=$lid");

    [$description] = $xoopsDB->fetchRow($result2);

    $GLOBALS['description'] = htmlspecialchars($description, ENT_QUOTES | ENT_HTML5);

    echo '<table>';

    echo '<form method=post action=index.php>';

    echo '<tr><td colspan=2>' . listGroups($groupid) . '</td></tr>';

    echo '<tr><td>' . _MD_FILEID . "</td><td><b>$lid</b></td></tr>";

    echo '<tr><td>' . _MD_FILETITLE . "</td><td><input type=text name=title value=\"$title\" size=50 maxlength=100></input></td></tr>\n";

    echo '<tr><td>' . _MD_DLURL . "</td><td><input type=text name=url value=\"$url\" size=50 maxlength=250></input></td></tr>\n";

    echo '<tr><td>' . _MD_HOMEPAGEC . "</td><td><input type=text name=homepage value=\"$homepage\" size=50 maxlength=100></input></td></tr>\n";

    echo '<tr><td>' . _MD_VERSIONC . "</td><td><input type=text name=version value=\"$version\" size=10 maxlength=10></input></td></tr>\n";

    echo '<tr><td>' . _MD_FILESIZEC . "</td><td><input type=text name=size value=\"$size\" size=10 maxlength=100></input>" . _MD_BYTES . "</td></tr>\n";

    echo '<tr><td>' . _MD_PLATFORMC . "</td><td><input type=text name=platform value=\"$platform\" size=45 maxlength=60></input></td></tr>\n";

    echo '<tr><td valign="top">' . _MD_DESCRIPTIONC . '</td><td>';

    xoopsCodeTarea('description', 60, 8);

    xoopsSmilies('description');

    //echo "<textarea name=description cols=60 rows=5>$description</textarea>";

    echo '</td></tr>';

    echo '<tr><td>' . _MD_CATEGORYC . '</td><td>';

    $mytree->makeMySelBox('title', 'title', $cid);

    echo "</td></tr>\n";

    echo '<tr><td>' . _MD_SHOTIMAGE . '</td><td>';

    //echo "<input type=text name=logourl value=\"$logourl\" size=\"50\" maxlength=\"60\"></input>";

    echo "<select size='1' name='logourl'>";

    echo "<option value=' '>------</option>";

    foreach ($downimg_array as $image) {
        if ($image == $logourl) {
            $opt_selected = "selected='selected'";
        } else {
            $opt_selected = '';
        }

        echo "<option value='" . $image . "' $opt_selected>" . $image . '</option>';
    }

    echo '</select>';

    echo "</td></tr>\n";

    echo '<tr><td></td><td>';

    $directory = XOOPS_URL . '/modules/wmpdownloads/images/shots/';

    printf(_MD_MUSTBEVALID, $directory);

    echo "</td></tr>\n";

    echo '</table>';

    echo "<br><br><input type=hidden name=lid value=$lid></input>\n";

    echo '<input type=hidden name=op value=modDownloadS><input type=submit value=' . _MD_SUBMIT . '>';

    echo "</form>\n";

    echo "<table><tr><td>\n";

    echo myTextForm('index.php?op=delDownload&lid=' . $lid, _MD_DELETE);

    echo "</td><td>\n";

    echo myTextForm('index.php?op=downloadsConfigMenu', _MD_CANCEL);

    echo "</td></tr></table>\n";

    echo '<hr>';

    $result5 = $xoopsDB->query('SELECT COUNT(*) FROM ' . $xoopsDB->prefix('wmpdownloads_votedata') . '');

    [$totalvotes] = $xoopsDB->getRowsNum($result5);

    echo "<table width=100%>\n";

    echo '<tr><td colspan=7><b>';

    printf(_MD_DLRATINGS, $totalvotes);

    echo "</b><br><br></td></tr>\n";

    // Show Registered Users Votes

    $result5 = $xoopsDB->query('SELECT ratingid, ratinguser, rating, ratinghostname, ratingtimestamp FROM ' . $xoopsDB->prefix('wmpdownloads_votedata') . " WHERE lid = $lid AND ratinguser != 0 ORDER BY ratingtimestamp DESC");

    $votes = $xoopsDB->getRowsNum($result5);

    echo '<tr><td colspan=7><br><br><b>';

    printf(_MD_REGUSERVOTES, $votes);

    echo "</b><br><br></td></tr>\n";

    echo '<tr><td><b>' . _MD_USER . '  </b></td><td><b>' . _MD_IP . '  </b></td><td><b>' . _MD_RATING . '  </b></td><td><b>' . _MD_USERAVG . '  </b></td><td><b>' . _MD_TOTALRATE . '  </b></td><td><b>' . _MD_DATE . '  </b></td><td align="center"><b>' . _MD_DELETE . "</b></td></tr>\n";

    if (0 == $votes) {
        echo '<tr><td align="center" colspan="7">' . _MD_NOREGVOTES . "<br></td></tr>\n";
    }

    $x = 0;

    $colorswitch = 'dddddd';

    while (list($ratingid, $ratinguser, $rating, $ratinghostname, $ratingtimestamp) = $xoopsDB->fetchRow($result5)) {
        $formatted_date = formatTimestamp($ratingtimestamp);

        //Individual user information

        $result2 = $xoopsDB->query('SELECT rating FROM ' . $xoopsDB->prefix('wmpdownloads_votedata') . " WHERE ratinguser = $ratinguser");

        $uservotes = $xoopsDB->getRowsNum($result2);

        $useravgrating = 0;

        while (list($rating2) = $xoopsDB->fetchRow($result2)) {
            $useravgrating += $rating2;
        }

        $useravgrating /= $uservotes;

        $useravgrating = number_format($useravgrating, 1);

        $ratinguname = XoopsUser::getUnameFromId($ratinguser);

        // echo "<tr><td bgcolor=\"$colorswitch\">$ratinguname</td><td bgcolor=\"$colorswitch\">$ratinghostname</td><td bgcolor=\"$colorswitch\">$rating</td><td bgcolor=\"$colorswitch\">$useravgrating</td><td bgcolor=\"$colorswitch\">$uservotes</td><td bgcolor=\"$colorswitch\">$formatted_date</td><td bgcolor=\"$colorswitch\" align=\"center\"><b><a href=index.php?op=delVote&lid=$lid&rid=$ratingid>X</a></b></td></tr>\n";

        // echo "<tr><td bgcolor=\"$colorswitch\">$ratinguname</td><td bgcolor=\"$colorswitch\">$ratinghostname</td><td bgcolor=\"$colorswitch\">$rating</td><td bgcolor=\"$colorswitch\">$useravgrating</td><td bgcolor=\"$colorswitch\">$uservotes</td><td bgcolor=\"$colorswitch\">$formatted_date</td><td bgcolor=\"$colorswitch\" align=\"center\">";

        echo "<tr><td bgcolor=\"$colorswitch\">$ratinguname</td><td bgcolor=\"$colorswitch\">$ratinghostname</td><td bgcolor=\"$colorswitch\">$rating</td><td bgcolor=\"$colorswitch\">$useravgrating</td><td bgcolor=\"$colorswitch\">$uservotes</td><td bgcolor=\"$colorswitch\">$formatted_date</td><td bgcolor=\"$colorswitch\" align=\"center\">";

        //echo "<table><tr><td>\n";

        echo myTextForm("index.php?op=delVote&lid=$lid&rid=$ratingid", 'X');

        // echo "</td></tr></table>\n";

        echo "</td></tr>\n";

        $x++;

        if ('dddddd' == $colorswitch) {
            $colorswitch = 'ffffff';
        } else {
            $colorswitch = 'dddddd';
        }
    }

    // Show Unregistered Users Votes

    $result5 = $xoopsDB->query('SELECT ratingid, rating, ratinghostname, ratingtimestamp FROM ' . $xoopsDB->prefix('wmpdownloads_votedata') . " WHERE lid = $lid AND ratinguser = 0 ORDER BY ratingtimestamp DESC");

    $votes = $xoopsDB->getRowsNum($result5);

    echo '<tr><td colspan=7><b><br><br>';

    printf(_MD_ANONUSERVOTES, $votes);

    echo "</b><br><br></td></tr>\n";

    echo '<tr><td colspan=2><b>' . _MD_IP . '  </b></td><td colspan=3><b>' . _MD_RATING . '  </b></td><td><b>' . _MD_DATE . '  </b></b></td><td align="center"><b>' . _MD_DELETE . '</b></td><br></tr>';

    if (0 == $votes) {
        echo '<tr><td colspan="7" align="center">' . _MD_NOUNREGVOTES . '<br></td></tr>';
    }

    $x = 0;

    $colorswitch = 'dddddd';

    while (list($ratingid, $rating, $ratinghostname, $ratingtimestamp) = $xoopsDB->fetchRow($result5)) {
        $formatted_date = formatTimestamp($ratingtimestamp);

        // echo "<td colspan=\"2\" bgcolor=\"$colorswitch\">$ratinghostname</td><td colspan=\"3\" bgcolor=\"$colorswitch\">$rating</td><td bgcolor=\"$colorswitch\">$formatted_date</td><td bgcolor=\"$colorswitch\" aling=\"center\"><b><a href=index.php?op=delVote&lid=$lid&rid=$ratingid>X</a></b></td></tr>";

        echo "<td colspan=\"2\" bgcolor=\"$colorswitch\">$ratinghostname</td><td colspan=\"3\" bgcolor=\"$colorswitch\">$rating</td><td bgcolor=\"$colorswitch\">$formatted_date</td><td bgcolor=\"$colorswitch\" align=\"center\">";

        //echo "<table><tr><td>\n";

        //align=\"center\"

        echo myTextForm("index.php?op=delVote&lid=$lid&rid=$ratingid", 'X');

        //echo "</td></tr></table>\n";

        echo '</td></tr>';

        $x++;

        if ('dddddd' == $colorswitch) {
            $colorswitch = 'ffffff';
        } else {
            $colorswitch = 'dddddd';
        }
    }

    echo "<tr><td colspan=\"6\">&nbsp;<br></td></tr>\n";

    echo "</table>\n";

    echo '</td></tr></table>';

    xoops_cp_footer();
}

function delVote()
{
    global $xoopsDB, $_GET, $eh;

    $rid = $_GET['rid'];

    $lid = $_GET['lid'];

    $sql = sprintf('DELETE FROM %s WHERE ratingid = %u', $xoopsDB->prefix('wmpdownloads_votedata'), $rid);

    $xoopsDB->query($sql) or $eh::show('0013');

    updaterating($lid);

    redirect_header('index.php', 1, _MD_VOTEDELETED);
}

function listBrokenDownloads()
{
    global $xoopsDB, $eh;

    $result = $xoopsDB->query('SELECT * FROM ' . $xoopsDB->prefix('wmpdownloads_broken') . ' ORDER BY reportid');

    $totalbrokendownloads = $xoopsDB->getRowsNum($result);

    xoops_cp_header();

    echo '<h4>' . _MD_DLCONF . '</h4>';

    echo "<table width='100%' border='0' cellspacing='1' class='outer'>"
           . '<tr class="odd"><td>';

    echo '<h4>' . _MD_BROKENREPORTS . " ($totalbrokendownloads)</h4><br>";

    if (0 == $totalbrokendownloads) {
        echo _MD_NOBROKEN;
    } else {
        echo '<center>' . _MD_IGNOREDESC . '<br>' . _MD_DELETEDESC . '</center><br><br><br>';

        $colorswitch = '#dddddd';

        echo '<table align="center" width="90%">';

        echo '
                <tr>
                        <td><b>' . _MD_FILETITLE . '</b></td>
                        <td><b>' . _MD_REPORTER . '</b></td>
                        <td><b>' . _MD_FILESUBMITTER . '</b></td>
                        <td><b>' . _MD_IGNORE . '</b></td>
                        <td><b>' . _EDIT . '</b></td>
                        <td><b>' . _MD_DELETE . '</b></td>
                </tr>';

        while (list($reportid, $lid, $sender, $ip) = $xoopsDB->fetchRow($result)) {
            $result2 = $xoopsDB->query('SELECT title, url, submitter FROM ' . $xoopsDB->prefix('wmpdownloads_downloads') . " WHERE lid=$lid");

            if (0 != $sender) {
                $result3 = $xoopsDB->query('SELECT uname, email FROM ' . $xoopsDB->prefix('users') . ' WHERE uid=' . $sender . '');

                [$sendername, $email] = $xoopsDB->fetchRow($result3);
            }

            [$title, $url, $owner] = $xoopsDB->fetchRow($result2);

            $result4 = $xoopsDB->query('SELECT uname, email FROM ' . $xoopsDB->prefix('users') . ' WHERE uid=' . $owner . '');

            [$ownername, $owneremail] = $xoopsDB->fetchRow($result4);

            echo "<tr><td bgcolor=$colorswitch><a href=$url target='_blank'>$title</a></td>";

            if ('' == $email) {
                echo "<td bgcolor=$colorswitch>$sendername ($ip)";
            } else {
                echo "<td bgcolor=$colorswitch><a href=mailto:$email>$sendername</a> ($ip)";
            }

            echo '</td>';

            if ('' == $owneremail) {
                echo "<td bgcolor=$colorswitch>$ownername";
            } else {
                echo "<td bgcolor=$colorswitch><a href=mailto:$owneremail>$ownername</a>";
            }

            echo "</td><td bgcolor='$colorswitch' align='center'>\n";

            echo myTextForm("index.php?op=ignoreBrokenDownloads&lid=$lid", 'X');

            echo "</td><td bgcolor='$colorswitch' align='center'>\n";

            echo myTextForm("index.php?op=modDownload&lid=$lid", 'X');

            echo "</td><td bgcolor='$colorswitch' align='center'>\n";

            echo myTextForm("index.php?op=delBrokenDownloads&lid=$lid", 'X');

            echo "</td></tr>\n";

            if ('#dddddd' == $colorswitch) {
                $colorswitch = '#ffffff';
            } else {
                $colorswitch = '#dddddd';
            }
        }

        echo '</table>';
    }

    echo '</td></tr></table>';

    xoops_cp_footer();
}

function delBrokenDownloads()
{
    global $xoopsDB, $_GET, $eh;

    $lid = $_GET['lid'];

    $sql = sprintf('DELETE FROM %s WHERE lid = %u', $xoopsDB->prefix('wmpdownloads_broken'), $lid);

    $xoopsDB->query($sql) or $eh::show('0013');

    $sql = sprintf('DELETE FROM %s WHERE lid = %u', $xoopsDB->prefix('wmpdownloads_downloads'), $lid);

    $xoopsDB->query($sql) or $eh::show('0013');

    redirect_header('index.php', 1, _MD_FILEDELETED);
}

function ignoreBrokenDownloads()
{
    global $xoopsDB, $_GET, $eh;

    $sql = sprintf('DELETE FROM %s WHERE lid = %u', $xoopsDB->prefix('wmpdownloads_broken'), $_GET['lid']);

    $xoopsDB->query($sql) or $eh::show('0013');

    redirect_header('index.php', 1, _MD_BROKENDELETED);
}

function listModReq()
{
    global $xoopsDB, $myts, $eh, $mytree, $xoopsModuleConfig;

    $result = $xoopsDB->query('SELECT * FROM ' . $xoopsDB->prefix('wmpdownloads_mod') . ' ORDER BY requestid');

    $totalmodrequests = $xoopsDB->getRowsNum($result);

    xoops_cp_header();

    echo '<h4>' . _MD_DLCONF . '</h4>';

    echo "<table width='100%' border='0' cellspacing='1' class='outer'>"
           . '<tr class="odd"><td>';

    echo '<h4>' . _MD_USERMODREQ . " ($totalmodrequests)</h4><br>";

    if ($totalmodrequests > 0) {
        echo '<table width=95%><tr><td>';

        $lookup_lid = [];

        while (list($requestid, $lid, $cid, $title, $url, $homepage, $version, $size, $platform, $logourl, $description, $modifysubmitter) = $xoopsDB->fetchRow($result)) {
            $lookup_lid[$requestid] = $lid;

            $result2 = $xoopsDB->query('SELECT cid, title, url, homepage, version, size, platform, logourl, submitter FROM ' . $xoopsDB->prefix('wmpdownloads_downloads') . " WHERE lid=$lid");

            [$origcid, $origtitle, $origurl, $orighomepage, $origversion, $origsize, $origplatform, $origlogourl, $owner] = $xoopsDB->fetchRow($result2);

            $result2 = $xoopsDB->query('SELECT description FROM ' . $xoopsDB->prefix('wmpdownloads_text') . " WHERE lid=$lid");

            [$origdescription] = $xoopsDB->fetchRow($result2);

            $result7 = $xoopsDB->query('SELECT uname, email FROM ' . $xoopsDB->prefix('users') . " WHERE uid=$modifysubmitter");

            $result8 = $xoopsDB->query('SELECT uname, email FROM ' . $xoopsDB->prefix('users') . " WHERE uid=$owner");

            $cidtitle = $mytree->getPathFromId($cid, 'title');

            $origcidtitle = $mytree->getPathFromId($origcid, 'title');

            [$submittername, $submitteremail] = $xoopsDB->fetchRow($result7);

            [$ownername, $owneremail] = $xoopsDB->fetchRow($result8);

            $title = htmlspecialchars($title, ENT_QUOTES | ENT_HTML5);

            $url = htmlspecialchars($url, ENT_QUOTES | ENT_HTML5);

            $homepage = htmlspecialchars($homepage, ENT_QUOTES | ENT_HTML5);

            $version = htmlspecialchars($version, ENT_QUOTES | ENT_HTML5);

            $size = htmlspecialchars($size, ENT_QUOTES | ENT_HTML5);

            $platform = htmlspecialchars($platform, ENT_QUOTES | ENT_HTML5);

            // use original image file to prevent users from changing screen shots file

            $origlogourl = htmlspecialchars($origlogourl, ENT_QUOTES | ENT_HTML5);

            $logourl = $origlogourl;

            $description = $myts->displayTarea($description);

            $origurl = htmlspecialchars($origurl, ENT_QUOTES | ENT_HTML5);

            $orighomepage = htmlspecialchars($orighomepage, ENT_QUOTES | ENT_HTML5);

            $origversion = htmlspecialchars($origversion, ENT_QUOTES | ENT_HTML5);

            $origsize = htmlspecialchars($origsize, ENT_QUOTES | ENT_HTML5);

            $origplatform = htmlspecialchars($origplatform, ENT_QUOTES | ENT_HTML5);

            $origdescription = $myts->displayTarea($origdescription);

            if (empty($ownername)) {
                $ownername = 'administration';
            }

            echo '<table border=1 bordercolor=black cellpadding=5 cellspacing=0 align=center width=450><tr><td>
                                <table width=100% bgcolor=dddddd>
                                <tr>
                                <td valign=top width=45%><b>' . _MD_ORIGINAL . '</b></td>
                                <td rowspan=14 valign=top align=left><br>' . _MD_DESCRIPTIONC . "<br>$origdescription</td>
                                </tr>
                                <tr><td valign=top width=45%><small>" . _MD_FILETITLE . ' ' . $origtitle . '</small></td></tr>
                                <tr><td valign=top width=45%><small>' . _MD_DLURL . ' ' . $origurl . '</small></td></tr>
                                <tr><td valign=top width=45%><small>' . _MD_CATEGORYC . ' ' . $origcidtitle . '</small></td></tr>
                                <tr><td valign=top width=45%><small>' . _MD_HOMEPAGEC . ' ' . $orighomepage . '</small></td></tr>
                                <tr><td valign=top width=45%><small>' . _MD_VERSIONC . ' ' . $origversion . '</small></td></tr>
                                <tr><td valign=top width=45%><small>' . _MD_FILESIZEC . ' ' . $origsize . '</small></td></tr>
                                <tr><td valign=top width=45%><small>' . _MD_PLATFORMC . ' ' . $origplatform . '</small></td></tr>
                                <tr><td valign=top width=45%><small>' . _MD_SHOTIMAGE . '</small> ';

            if ($xoopsModuleConfig['useshots'] && !empty($origlogourl)) {
                echo '<img src="' . XOOPS_URL . '/modules/wmpdownloads/images/shots/' . $origlogourl . '" width="' . $xoopsModuleConfig['shotwidth'] . '">';
            } else {
                echo '&nbsp;';
            }

            echo '</td></tr>
                                </table></td></tr><tr><td>
                                <table width=100%>
                                        <tr>
                                        <td valign=top width=45%><b>' . _MD_PROPOSED . '</b></td>
                                        <td rowspan=14 valign=top align=left><br>' . _MD_DESCRIPTIONC . "<br>$description</td>
                                        </tr>
                                        <tr><td valign=top width=45%><small>" . _MD_FILETITLE . ' ' . $title . '</small></td></tr>
                                        <tr><td valign=top width=45%><small>' . _MD_DLURL . ' ' . $url . '</small></td></tr>
                                        <tr><td valign=top width=45%><small>' . _MD_CATEGORYC . ' ' . $cidtitle . '</small></td></tr>
                                        <tr><td valign=top width=45%><small>' . _MD_HOMEPAGEC . ' ' . $homepage . '</small></td></tr>
                                        <tr><td valign=top width=45%><small>' . _MD_VERSIONC . ' ' . $version . '</small></td></tr>
                                        <tr><td valign=top width=45%><small>' . _MD_FILESIZEC . ' ' . $size . '</small></td></tr>
                                        <tr><td valign=top width=45%><small>' . _MD_PLATFORMC . ' ' . $platform . '</small></td></tr>
                                        <tr><td valign=top width=45%><small>' . _MD_SHOTIMAGE . '</small> ';

            if ($xoopsModuleConfig['useshots'] && !empty($logourl)) {
                echo '<img src="' . XOOPS_URL . '/modules/wmpdownloads/images/shots/' . $logourl . '" width="' . $xoopsModuleConfig['shotwidth'] . '">';
            } else {
                echo '&nbsp;';
            }

            echo '</td></tr>
                                </table></td></tr></table>
                                <table align=center width=450>
                                <tr>';

            if ('' == $submitteremail) {
                echo '<td align=left><small>' . _MD_SUBMITTER . " $submittername</small></td>";
            } else {
                echo '<td align=left><small>' . _MD_SUBMITTER . " <a href=mailto:$submitteremail>$submittername</a></small></td>";
            }

            if ('' == $owneremail) {
                echo '<td align=center><small>' . _MD_OWNER . " $ownername</small></td>";
            } else {
                echo '<td align=center><small>' . _MD_OWNER . " <a href=mailto:$owneremail>$ownername</a></small></td>";
            }

            echo "<td align=right><small>\n";

            echo "<table><tr><td>\n";

            echo myTextForm("index.php?op=changeModReq&requestid=$requestid", _MD_APPROVE);

            echo "</td><td>\n";

            echo myTextForm("index.php?op=modDownload&lid=$lookup_lid[$requestid]", _EDIT);

            echo "</td><td>\n";

            echo myTextForm("index.php?op=ignoreModReq&requestid=$requestid", _MD_IGNORE);

            echo "</td></tr></table>\n";

            echo "</small></td></tr>\n";

            echo '</table><br><br>';
        }

        echo '</td></tr></table>';
    } else {
        echo _MD_NOMODREQ;
    }

    echo '</td></tr></table>';

    xoops_cp_footer();
}

function changeModReq()
{
    global $xoopsDB, $_GET, $eh, $myts;

    $requestid = $_GET['requestid'];

    $query = 'SELECT lid, cid, title, url, homepage, version, size, platform, logourl, description FROM ' . $xoopsDB->prefix('wmpdownloads_mod') . " WHERE requestid=$requestid";

    $result = $xoopsDB->query($query);

    while (list($lid, $cid, $title, $url, $homepage, $version, $size, $platform, $logourl, $description) = $xoopsDB->fetchRow($result)) {
        if (get_magic_quotes_runtime()) {
            $title = stripslashes($title);

            $url = stripslashes($url);

            $homepage = stripslashes($homepage);

            $logourl = stripslashes($logourl);

            $description = stripslashes($description);
        }

        $title = addslashes($title);

        $url = addslashes($url);

        $homepage = addslashes($homepage);

        $logourl = addslashes($logourl);

        $description = addslashes($description);

        $sql = sprintf("UPDATE %s SET cid = %u,title = '%s', url = '%s', homepage = '%s', version = '%s', size = %u, platform = '%s', logourl = '%s', status = %u, date = %u WHERE lid = %u", $xoopsDB->prefix('wmpdownloads_downloads'), $cid, $title, $url, $homepage, $version, $size, $platform, $logourl, 2, time(), $lid);

        $xoopsDB->query($sql) or $eh::show('0013');

        $sql = sprintf("UPDATE %s SET description = '%s' WHERE lid = %u", $xoopsDB->prefix('wmpdownloads_text'), $description, $lid);

        $xoopsDB->query($sql) or $eh::show('0013');

        $sql = sprintf('DELETE FROM %s WHERE requestid = %u', $xoopsDB->prefix('wmpdownloads_mod'), $requestid);

        $xoopsDB->query($sql) or $eh::show('0013');
    }

    redirect_header('index.php', 1, _MD_DBUPDATED);
}

function ignoreModReq()
{
    global $xoopsDB, $_GET, $eh;

    $sql = sprintf('DELETE FROM %s WHERE requestid = %u', $xoopsDB->prefix('wmpdownloads_mod'), $_GET['requestid']);

    $xoopsDB->query($sql) or $eh::show('0013');

    redirect_header('index.php', 1, _MD_MODREQDELETED);
}

function modDownloadS()
{
    global $xoopsDB, $_POST, $myts, $eh;

    $cid = $_POST['cid'];

    if (($_POST['url']) || ('' != $_POST['url'])) {
        $url = $myts->addSlashes($_POST['url']);
    }

    $logourl = $myts->addSlashes($_POST['logourl']);

    $groupid = saveAccess($_POST['groupid']);

    $title = $myts->addSlashes($_POST['title']);

    $homepage = $myts->addSlashes($_POST['homepage']);

    $version = $myts->addSlashes($_POST['version']);

    $size = $myts->addSlashes($_POST['size']);

    $platform = $myts->addSlashes($_POST['platform']);

    $description = $myts->addSlashes($_POST['description']);

    //$sql = sprintf("UPDATE %s SET cid = %u, title = '%s', url = '%s', homepage = '%s', version = '%s', size = %u, platform = '%s', logourl = '%s', status = %u, date = %u WHERE lid = %u", $xoopsDB->prefix("wmpdownloads_downloads"), $cid, $title, $url, $homepage, $version, $size, $platform, $logourl, 2, time(), $_POST['lid']);

    $sql = sprintf("UPDATE %s SET cid = %u, groupid = '%s', title = '%s', url = '%s', homepage = '%s', version = '%s', size = %u, platform = '%s', logourl = '%s', status = %u, date = %u WHERE lid = %u", $xoopsDB->prefix('wmpdownloads_downloads'), $cid, $groupid, $title, $url, $homepage, $version, $size, $platform, $logourl, 2, time(), $_POST['lid']);

    $xoopsDB->query($sql) or $eh::show('0013');

    $sql = sprintf("UPDATE %s SET description = '%s' WHERE lid = %u", $xoopsDB->prefix('wmpdownloads_text'), $description, $_POST['lid']);

    $xoopsDB->query($sql) or $eh::show('0013');

    redirect_header('index.php', 1, _MD_DBUPDATED);
}

function delDownload()
{
    global $xoopsDB, $_GET, $eh, $xoopsModule;

    $sql = sprintf('DELETE FROM %s WHERE lid = %u', $xoopsDB->prefix('wmpdownloads_downloads'), $_GET['lid']);

    $xoopsDB->query($sql) or $eh::show('0013');

    $sql = sprintf('DELETE FROM %s WHERE lid = %u', $xoopsDB->prefix('wmpdownloads_text'), $_GET['lid']);

    $xoopsDB->query($sql) or $eh::show('0013');

    $sql = sprintf('DELETE FROM %s WHERE lid = %u', $xoopsDB->prefix('wmpdownloads_votedata'), $_GET['lid']);

    $xoopsDB->query($sql) or $eh::show('0013');

    // delete comments

    xoops_comment_delete($xoopsModule->getVar('mid'), $_GET['lid']);

    redirect_header('index.php', 1, _MD_FILEDELETED);
}

function modCat()
{
    global $xoopsDB, $_POST, $myts, $eh, $mytree;

    $cid = $_POST['cid'];

    xoops_cp_header();

    echo '<h4>' . _MD_DLCONF . '</h4>';

    echo "<table width='100%' border='0' cellspacing='1' class='outer'>"
           . '<tr class="odd"><td>';

    echo '<h4>' . _MD_MODCAT . '</h4><br>';

    //$result=$xoopsDB->query("SELECT pid, title, imgurl FROM ".$xoopsDB->prefix("wmpdownloads_cat")." WHERE cid=$cid");

    //list($pid,$title,$imgurl) = $xoopsDB->fetchRow($result);

    $result = $xoopsDB->query('SELECT pid, groupid, title, imgurl FROM ' . $xoopsDB->prefix('wmpdownloads_cat') . " WHERE cid=$cid");

    [$pid, $groupid, $title, $imgurl] = $xoopsDB->fetchRow($result);

    $title = htmlspecialchars($title, ENT_QUOTES | ENT_HTML5);

    $imgurl = htmlspecialchars($imgurl, ENT_QUOTES | ENT_HTML5);

    //echo "<form action=index.php method=post>"._MD_TITLEC."<input type=text name=title value=\"$title\" size=51 maxlength=50><br><br>"._MD_IMGURLMAIN."<br><input type=text name=imgurl value=\"$imgurl\" size=100 maxlength=150><br>

    echo '<form action=index.php method=post>';

    listGroups($groupid);

    echo '<br><br>' . _MD_TITLEC . "<input type=text name=title value=\"$title\" size=51 maxlength=50><br><br>" . _MD_IMGURLMAIN . "<br><input type=text name=imgurl value=\"$imgurl\" size=100 maxlength=150><br>
        <br>" . _MD_PARENT . '&nbsp;';

    $mytree->makeMySelBox('title', 'title', $pid, 1, 'pid');

    echo "<input type='hidden' name='cid' value='$cid'>
        <input type=hidden name=op value=modCatS><br>
        <input type=submit value=\"" . _MD_SAVE . '">
        <input type=button value=' . _MD_DELETE . " onClick=\"location='index.php?pid=$pid&amp;cid=$cid&amp;op=delCat'\">";

    echo '&nbsp;<input type=button value=' . _MD_CANCEL . ' onclick="javascript:history.go(-1)">';

    echo '</form>';

    echo '</td></tr></table>';

    xoops_cp_footer();
}

function modCatS()
{
    global $xoopsDB, $_POST, $myts, $eh;

    $cid = $_POST['cid'];

    $sid = $_POST['pid'];

    $title = $myts->addSlashes($_POST['title']);

    if (empty($title)) {
        redirect_header('index.php', 2, _MD_ERRORTITLE);

        exit();
    }

    if (($_POST['imgurl']) || ('' != $_POST['imgurl'])) {
        $imgurl = $myts->addSlashes($_POST['imgurl']);
    }

    //$sql = sprintf("UPDATE %s SET title = '%s', imgurl = '%s', pid = %u WHERE cid = %u", $xoopsDB->prefix("wmpdownloads_cat"), $title, $imgurl, $sid, $cid);

    $groupid = saveAccess($_POST['groupid']);

    $sql = sprintf("UPDATE %s SET groupid='%s', title = '%s', imgurl = '%s', pid = %u WHERE cid = %u", $xoopsDB->prefix('wmpdownloads_cat'), $groupid, $title, $imgurl, $sid, $cid);

    $xoopsDB->query($sql) or $eh::show('0013');

    redirect_header('index.php', 1, _MD_DBUPDATED);
}

function delCat()
{
    global $xoopsDB, $_GET, $_POST, $eh, $mytree, $xoopsModule;

    $cid = isset($_POST['cid']) ? (int)$_POST['cid'] : (int)$_GET['cid'];

    $ok = isset($_POST['ok']) ? (int)$_POST['ok'] : 0;

    if (1 == $ok) {
        //get all subcategories under the specified category

        $arr = $mytree->getAllChildId($cid);

        $lcount = count($arr);

        for ($i = 0; $i < $lcount; $i++) {
            //get all downloads in each subcategory

            $result = $xoopsDB->query('SELECT lid FROM ' . $xoopsDB->prefix('wmpdownloads_downloads') . ' WHERE cid=' . $arr[$i] . '') or $eh::show('0013');

            //now for each download, delete the text data and vote ata associated with the download

            while (list($lid) = $xoopsDB->fetchRow($result)) {
                $sql = sprintf('DELETE FROM %s WHERE lid = %u', $xoopsDB->prefix('wmpdownloads_text'), $lid);

                $xoopsDB->query($sql) or $eh::show('0013');

                $sql = sprintf('DELETE FROM %s WHERE lid = %u', $xoopsDB->prefix('wmpdownloads_votedata'), $lid);

                $xoopsDB->query($sql) or $eh::show('0013');

                $sql = sprintf('DELETE FROM %s WHERE lid = %u', $xoopsDB->prefix('wmpdownloads_downloads'), $lid);

                $xoopsDB->query($sql) or $eh::show('0013');

                // delete comments

                xoops_comment_delete($xoopsModule->getVar('mid'), $lid);
            }

            //all downloads for each subcategory is deleted, now delete the subcategory data

            $sql = sprintf('DELETE FROM %s WHERE cid = %u', $xoopsDB->prefix('wmpdownloads_cat'), $arr[$i]);

            $xoopsDB->query($sql) or $eh::show('0013');
        }

        //all subcategory and associated data are deleted, now delete category data and its associated data

        $result = $xoopsDB->query('SELECT lid FROM ' . $xoopsDB->prefix('wmpdownloads_downloads') . ' WHERE cid=' . $cid . '') or $eh::show('0013');

        while (list($lid) = $xoopsDB->fetchRow($result)) {
            $sql = sprintf('DELETE FROM %s WHERE lid = %u', $xoopsDB->prefix('wmpdownloads_downloads'), $lid);

            $xoopsDB->query($sql) or $eh::show('0013');

            $sql = sprintf('DELETE FROM %s WHERE lid = %u', $xoopsDB->prefix('wmpdownloads_text'), $lid);

            $xoopsDB->query($sql) or $eh::show('0013');

            // delete comments

            xoops_comment_delete($xoopsModule->getVar('mid'), $lid);

            $sql = sprintf('DELETE FROM %s WHERE lid = %u', $xoopsDB->prefix('wmpdownloads_votedata'), $lid);

            $xoopsDB->query($sql) or $eh::show('0013');
        }

        $sql = sprintf('DELETE FROM %s WHERE cid = %u', $xoopsDB->prefix('wmpdownloads_cat'), $cid);

        $xoopsDB->query($sql) or $eh::show('0013');

        redirect_header('index.php', 1, _MD_CATDELETED);

        exit();
    }  

    xoops_cp_header();

    echo '<h4>' . _MD_DLCONF . '</h4>';

    xoops_confirm(['op' => 'delCat', 'cid' => $cid, 'ok' => 1], 'index.php', _MD_WARNING);

    xoops_cp_footer();
}

function delNewDownload()
{
    global $xoopsDB, $_GET, $eh, $xoopsModule;

    $sql = sprintf('DELETE FROM %s WHERE lid = %u', $xoopsDB->prefix('wmpdownloads_downloads'), $_GET['lid']);

    $xoopsDB->query($sql) or $eh::show('0013');

    $sql = sprintf('DELETE FROM %s WHERE lid = %u', $xoopsDB->prefix('wmpdownloads_text'), $_GET['lid']);

    $xoopsDB->query($sql) or $eh::show('0013');

    // delete comments

    xoops_comment_delete($xoopsModule->getVar('mid'), $_GET['lid']);

    redirect_header('index.php', 1, _MD_FILEDELETED);
}

function addCat()
{
    global $xoopsDB, $_POST, $myts, $eh;

    $pid = $_POST['cid'];

    $groupid = saveAccess($_POST['groupid']);

    $title = $myts->addSlashes($_POST['title']);

    if (empty($title)) {
        redirect_header('index.php', 2, _MD_ERRORTITLE);
    }

    if (($_POST['imgurl']) || ('' != $_POST['imgurl'])) {
        $imgurl = $myts->addSlashes($_POST['imgurl']);
    }

    $newid = $xoopsDB->genId($xoopsDB->prefix('wmpdownloads_cat') . '_cid_seq');

    //$sql = sprintf("INSERT INTO %s (cid, pid, title, imgurl) VALUES (%u, %u, '%s', '%s')", $xoopsDB->prefix("wmpdownloads_cat"), $newid, $pid, $title, $imgurl);

    $sql = sprintf("INSERT INTO %s (cid, pid, groupid, title, imgurl) VALUES (%u, %u, '%s','%s', '%s')", $xoopsDB->prefix('wmpdownloads_cat'), $newid, $pid, $groupid, $title, $imgurl);

    $xoopsDB->query($sql) or $eh::show('0013');

    if (0 == $newid) {
        $newid = $xoopsDB->getInsertId();
    }

    // Notify of new category

    global $xoopsModule;

    $tags = [];

    $tags['CATEGORY_NAME'] = $title;

    $tags['CATEGORY_URL'] = XOOPS_URL . '/modules/' . $xoopsModule->getVar('dirname') . '/viewcat.php?cid=' . $newid;

    $notificationHandler = xoops_getHandler('notification');

    $notificationHandler->triggerEvent('global', 0, 'new_category', $tags);

    //redirect_header("index.php",1,_MD_NEWCATADDED);

    redirect_header('javascript:history.go(-1)', 1, _MD_NEWDLADDED);
}

function addDownload()
{
    global $xoopsDB, $xoopsUser, $xoopsModule, $_POST, $myts, $eh;

    $url = $myts->addSlashes(formatURL($_POST['url']));

    $groupid = saveAccess($_POST['groupid']);

    $logourl = $myts->addSlashes($_POST['logourl']);

    $title = $myts->addSlashes($_POST['title']);

    $homepage = $myts->addSlashes(formatURL($_POST['homepage']));

    $version = $myts->addSlashes($_POST['version']);

    $size = $myts->addSlashes($_POST['size']);

    $platform = $myts->addSlashes($_POST['platform']);

    $description = $myts->addSlashes($_POST['description']);

    $submitter = $xoopsUser->uid();

    $result = $xoopsDB->query('SELECT COUNT(*) FROM ' . $xoopsDB->prefix('wmpdownloads_downloads') . " WHERE url='$url'");

    [$numrows] = $xoopsDB->fetchRow($result);

    $error = 0;

    $errormsg = '';

    if ($numrows > 0) {
        $errormsg .= "<h4 style='color: #ff0000'>";

        $errormsg .= _MD_ERROREXIST . '</h4><br>';

        $error = 1;
    }

    // Check if Title exist

    if ('' == $title) {
        $errormsg .= "<h4 style='color: #ff0000'>";

        $errormsg .= _MD_ERRORTITLE . '</h4><br>';

        $error = 1;
    }

    if (empty($size) || !is_numeric($size)) {
        $size = 0;
    }

    // Check if Description exist

    if ('' == $description) {
        $errormsg .= "<h4 style='color: #ff0000'>";

        $errormsg .= _MD_ERRORDESC . '</h4><br>';

        $error = 1;
    }

    if (1 == $error) {
        xoops_cp_header();

        echo $errormsg;

        xoops_cp_footer();

        exit();
    }

    if (!empty($_POST['cid'])) {
        $cid = $_POST['cid'];
    } else {
        $cid = 0;
    }

    $newid = $xoopsDB->genId($xoopsDB->prefix('wmpdownloads_downloads') . '_lid_seq');

    //$sql = sprintf("INSERT INTO %s (lid, cid, title, url, homepage, version, size, platform, logourl, submitter, status, date, hits, rating, votes, comments) VALUES (%u, %u, '%s', '%s', '%s', '%s', %u, '%s', '%s', %u, %u, %u, %u, %u, %u, %u)", $xoopsDB->prefix("wmpdownloads_downloads"), $newid, $cid, $title, $url, $homepage, $version, $size, $platform, $logourl, $submitter, 1, time(), 0, 0, 0, 0);

    $sql = sprintf("INSERT INTO %s (lid, cid, groupid, title, url, homepage, version, size, platform, logourl, submitter, status, date, hits, rating, votes, comments) VALUES (%u, %u, '%s', '%s', '%s', '%s', '%s', %u, '%s', '%s', %u, %u, %u, %u, %u, %u, %u)", $xoopsDB->prefix('wmpdownloads_downloads'), $newid, $cid, $groupid, $title, $url, $homepage, $version, $size, $platform, $logourl, $submitter, 1, time(), 0, 0, 0, 0);

    $xoopsDB->query($sql) or $eh::show('0013');

    if (0 == $newid) {
        $newid = $xoopsDB->getInsertId();
    }

    $sql = sprintf("INSERT INTO %s (lid, description) VALUES (%u, '%s')", $xoopsDB->prefix('wmpdownloads_text'), $newid, $description);

    $xoopsDB->query($sql) or $eh::show('0013');

    $tags = [];

    $tags['FILE_NAME'] = $title;

    $tags['FILE_URL'] = XOOPS_URL . '/modules/' . $xoopsModule->getVar('dirname') . '/singlefile.php?cid=' . $cid . '&amp;lid=' . $newid;

    $sql = 'SELECT title FROM ' . $xoopsDB->prefix('wmpdownloads_cat') . ' WHERE cid=' . $cid;

    $result = $xoopsDB->query($sql);

    $row = $xoopsDB->fetchArray($result);

    $tags['CATEGORY_NAME'] = $row['title'];

    $tags['CATEGORY_URL'] = XOOPS_URL . '/modules/' . $xoopsModule->getVar('dirname') . '/viewcat.php?cid=' . $cid;

    $notificationHandler = xoops_getHandler('notification');

    $notificationHandler->triggerEvent('global', 0, 'new_file', $tags);

    $notificationHandler->triggerEvent('category', $cid, 'new_file', $tags);

    //redirect_header("index.php?op=downloadsConfigMenu",1,_MD_NEWDLADDED);

    redirect_header('javascript:history.go(-1)', 1, _MD_NEWDLADDED);
}

function approve()
{
    global $xoopsConfig, $xoopsDB, $_POST, $myts, $eh;

    $lid = $_POST['lid'];

    $title = $_POST['title'];

    $cid = $_POST['cid'];

    if (empty($cid)) {
        $cid = 0;
    }

    $homepage = $_POST['homepage'];

    $version = $_POST['version'];

    $size = $_POST['size'];

    $platform = $_POST['platform'];

    $description = $_POST['description'];

    if (($_POST['url']) || ('' != $_POST['url'])) {
        $url = $myts->addSlashes($_POST['url']);
    }

    $logourl = $myts->addSlashes($_POST['logourl']);

    $title = $myts->addSlashes($title);

    $homepage = $myts->addSlashes($homepage);

    $version = $myts->addSlashes($_POST['version']);

    $size = $myts->addSlashes($_POST['size']);

    $platform = $myts->addSlashes($_POST['platform']);

    $description = $myts->addSlashes($description);

    $sql = sprintf("UPDATE %s SET cid = %u, title = '%s', url = '%s', homepage = '%s', version = '%s', size = %u, platform = '%s', logourl = '%s', status = %u, date = %u WHERE lid = %u", $xoopsDB->prefix('wmpdownloads_downloads'), $cid, $title, $url, $homepage, $version, $size, $platform, $logourl, 1, time(), $lid);

    $xoopsDB->query($sql) or $eh::show('0013');

    $sql = sprintf("UPDATE %s SET description = '%s' WHERE lid = %u", $xoopsDB->prefix('wmpdownloads_text'), $description, $lid);

    $xoopsDB->query($sql) or $eh::show('0013');

    global $xoopsModule;

    $tags = [];

    $tags['FILE_NAME'] = $title;

    $tags['FILE_URL'] = XOOPS_URL . '/modules/' . $xoopsModule->getVar('dirname') . '/singlefile.php?cid=' . $cid . '&amp;lid=' . $lid;

    $sql = 'SELECT title FROM ' . $xoopsDB->prefix('wmpdownloads_cat') . ' WHERE cid=' . $cid;

    $result = $xoopsDB->query($sql);

    $row = $xoopsDB->fetchArray($result);

    $tags['CATEGORY_NAME'] = $row['title'];

    $tags['CATEGORY_URL'] = XOOPS_URL . '/modules/' . $xoopsModule->getVar('dirname') . '/viewcat.php?cid=' . $cid;

    $notificationHandler = xoops_getHandler('notification');

    $notificationHandler->triggerEvent('global', 0, 'new_file', $tags);

    $notificationHandler->triggerEvent('category', $cid, 'new_file', $tags);

    $notificationHandler->triggerEvent('file', $lid, 'approve', $tags);

    redirect_header('index.php', 1, _MD_NEWDLADDED);
}
$op = $_POST['op'] ?? $_GET['op'] ?? 'main';
switch ($op) {
case 'delNewDownload':
    delNewDownload();
    break;
case 'approve':
        approve();
        break;
case 'addCat':
        addCat();
        break;
case 'addSubCat':
        addSubCat();
        break;
case 'addDownload':
        addDownload();
        break;
case 'listBrokenDownloads':
        listBrokenDownloads();
        break;
case 'delBrokenDownloads':
        delBrokenDownloads();
        break;
case 'ignoreBrokenDownloads':
        ignoreBrokenDownloads();
        break;
case 'listModReq':
        listModReq();
        break;
case 'changeModReq':
        changeModReq();
        break;
case 'ignoreModReq':
        ignoreModReq();
        break;
case 'delCat':
        delCat();
        break;
case 'modCat':
        modCat();
        break;
case 'modCatS':
        modCatS();
        break;
case 'modDownload':
        modDownload();
        break;
case 'modDownloadS':
        modDownloadS();
        break;
case 'delDownload':
        delDownload();
        break;
case 'delVote':
        delVote();
        break;
case 'downloadsConfigMenu':
        downloadsConfigMenu();
        break;
case 'listNewDownloads':
        listNewDownloads();
        break;
case 'main':
default:
        wmpdownloads();
        break;
}