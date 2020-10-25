<?php
// $Id: viewcat.php,v 1.13 2003/03/27 12:11:05 w4z004 Exp $
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

include 'header.php';
require_once XOOPS_ROOT_PATH . '/class/xoopstree.php';
$GLOBALS['xoopsOption']['template_main'] = 'wmpdownloads_viewcat.html';
$myts = MyTextSanitizer::getInstance(); // MyTextSanitizer object
$mytree = new XoopsTree($xoopsDB->prefix('wmpdownloads_cat'), 'cid', 'pid');

$cid = (int)$_GET['cid'];
require XOOPS_ROOT_PATH . '/header.php';
require_once './include/groupaccess.php';
$query = $xoopsDB->query('SELECT groupid FROM ' . $xoopsDB->prefix('wmpdownloads_cat') . " WHERE cid='$cid'");
[$groupid] = $xoopsDB->fetchRow($query);
checkAccess($groupid, 'javascript:history.go(-1)', 2, _NOPERM);

if (isset($_GET['show']) && '' != $_GET['show']) {
    $show = (int)$_GET['show'];
} else {
    $show = $xoopsModuleConfig['perpage'];
}
$min = isset($_GET['min']) ? (int)$_GET['min'] : 0;
if (!isset($max)) {
    $max = $min + $show;
}
if (isset($_GET['orderby'])) {
    $orderby = convertorderbyin($_GET['orderby']);
} else {
    $orderby = 'title ASC';
}

$pathstring = "<a href='index.php'>" . _MD_MAIN . '</a>&nbsp;:&nbsp;';
$pathstring .= $mytree->getNicePathFromId($cid, 'title', 'viewcat.php?op=');
$xoopsTpl->assign('category_path', $pathstring);
$xoopsTpl->assign('category_id', $cid);
// get child category objects
$arr = [];
$arr = $mytree->getFirstChild($cid, 'title');
if (count($arr) > 0) {
    $scount = 1;

    foreach ($arr as $ele) {
        $sub_arr = [];

        $sub_arr = $mytree->getFirstChild($ele['cid'], 'title');

        $space = 0;

        $chcount = 0;

        $infercategories = '';

        foreach ($sub_arr as $sub_ele) {
            $chtitle = htmlspecialchars($sub_ele['title'], ENT_QUOTES | ENT_HTML5);

            if ($chcount > 5) {
                $infercategories .= '...';

                break;
            }

            if ($space > 0) {
                $infercategories .= ', ';
            }

            $infercategories .= '<a href="' . XOOPS_URL . '/modules/wmpdownloads/viewcat.php?cid=' . $sub_ele['cid'] . '">' . $chtitle . '</a>';

            $space++;

            $chcount++;
        }

        $xoopsTpl->append('subcategories', ['title' => htmlspecialchars($ele['title'], ENT_QUOTES | ENT_HTML5), 'id' => $ele['cid'], 'infercategories' => $infercategories, 'totallinks' => getTotalItems($ele['cid'], 1), 'count' => $scount]);

        $scount++;
    }
}

if (1 == $xoopsModuleConfig['useshots']) {
    $xoopsTpl->assign('shotwidth', $xoopsModuleConfig['shotwidth']);

    $xoopsTpl->assign('tablewidth', $xoopsModuleConfig['shotwidth'] + 10);

    $xoopsTpl->assign('show_screenshot', true);

    $xoopsTpl->assign('lang_noscreenshot', _MD_NOSHOTS);
}

if (!empty($xoopsUser) && $xoopsUser->isAdmin($xoopsModule->mid())) {
    $isadmin = true;
} else {
    $isadmin = false;
}
$fullcountresult = $xoopsDB->query('SELECT COUNT(*) FROM ' . $xoopsDB->prefix('wmpdownloads_downloads') . " WHERE cid=$cid AND status>0");
[$numrows] = $xoopsDB->fetchRow($fullcountresult);
$page_nav = '';
if ($numrows > 0) {
    $xoopsTpl->assign('lang_description', _MD_DESCRIPTIONC);

    $xoopsTpl->assign('lang_lastupdate', _MD_LASTUPDATEC);

    $xoopsTpl->assign('lang_hits', _MD_HITSC);

    $xoopsTpl->assign('lang_ratingc', _MD_RATINGC);

    $xoopsTpl->assign('lang_email', _MD_EMAILC);

    $xoopsTpl->assign('lang_ratethissite', _MD_RATETHISFILE);

    $xoopsTpl->assign('lang_reportbroken', _MD_REPORTBROKEN);

    $xoopsTpl->assign('lang_tellafriend', _MD_TELLAFRIEND);

    $xoopsTpl->assign('lang_modify', _MD_MODIFY);

    $xoopsTpl->assign('lang_version', _MD_VERSION);

    $xoopsTpl->assign('lang_subdate', _MD_SUBMITDATE);

    $xoopsTpl->assign('lang_dlnow', _MD_DLNOW);

    $xoopsTpl->assign('lang_category', _MD_CATEGORYC);

    $xoopsTpl->assign('lang_size', _MD_FILESIZE);

    $xoopsTpl->assign('lang_platform', _MD_SUPPORTEDPLAT);

    $xoopsTpl->assign('lang_homepage', _MD_HOMEPAGE);

    $xoopsTpl->assign('lang_comments', _COMMENTS);

    $xoopsTpl->assign('show_links', true);

    $q = 'SELECT d.lid, d.title, d.url, d.homepage, d.version, d.size, d.platform, d.logourl, d.status, d.date, d.hits, d.rating, d.votes, d.comments, t.description FROM ' . $xoopsDB->prefix('wmpdownloads_downloads') . ' d, ' . $xoopsDB->prefix('wmpdownloads_text') . ' t WHERE cid=' . $cid . ' AND d.status>0 AND d.lid=t.lid ORDER BY ' . $orderby . '';

    $result = $xoopsDB->query($q, $show, $min);

    //if 2 or more items in result, show the sort menu

    if ($numrows > 1) {
        $xoopsTpl->assign('show_nav', true);

        $orderbyTrans = convertorderbytrans($orderby);

        $xoopsTpl->assign('lang_sortby', _MD_SORTBY);

        $xoopsTpl->assign('lang_title', _MD_TITLE);

        $xoopsTpl->assign('lang_date', _MD_DATE);

        $xoopsTpl->assign('lang_rating', _MD_RATING);

        $xoopsTpl->assign('lang_popularity', _MD_POPULARITY);

        $xoopsTpl->assign('lang_cursortedby', sprintf(_MD_CURSORTBY, convertorderbytrans($orderby)));
    }

    while (list($lid, $dtitle, $url, $homepage, $version, $size, $platform, $logourl, $status, $time, $hits, $rating, $votes, $comments, $description) = $xoopsDB->fetchRow($result)) {
        $path = $mytree->getPathFromId($cid, 'title');

        $path = mb_substr($path, 1);

        $path = str_replace('/', " <img src='" . XOOPS_URL . "/modules/wmpdownloads/images/arrow.gif' board='0' alt=''> ", $path);

        $rating = number_format($rating, 2);

        $dtitle = htmlspecialchars($dtitle, ENT_QUOTES | ENT_HTML5);

        $url = htmlspecialchars($url, ENT_QUOTES | ENT_HTML5);

        $homepage = htmlspecialchars($homepage, ENT_QUOTES | ENT_HTML5);

        $version = htmlspecialchars($version, ENT_QUOTES | ENT_HTML5);

        $size = PrettySize(htmlspecialchars($size, ENT_QUOTES | ENT_HTML5));

        $platform = htmlspecialchars($platform, ENT_QUOTES | ENT_HTML5);

        $logourl = htmlspecialchars($logourl, ENT_QUOTES | ENT_HTML5);

        $datetime = formatTimestamp($time, 's');

        $description = $myts->displayTarea($description, 0); //no html

        $new = newdownloadgraphic($time, $status);

        $pop = popgraphic($hits);

        if ($isadmin) {
            $adminlink = '<a href="' . XOOPS_URL . '/modules/wmpdownloads/admin/index.php?lid=' . $lid . '&amp;fct=wmpdownloads&amp;op=modDownload"><img src="' . XOOPS_URL . '/modules/wmpdownloads/images/editicon.gif" border="0" alt="' . _MD_EDITTHISDL . '"></a>';
        } else {
            $adminlink = '';
        }

        if (1 == $votes) {
            $votestring = _MD_ONEVOTE;
        } else {
            $votestring = sprintf(_MD_NUMVOTES, $votes);
        }

        $xoopsTpl->append('file', ['id' => $lid, 'cid' => $cid, 'rating' => $rating, 'title' => $dtitle . $new . $pop, 'logourl' => $logourl, 'updated' => $datetime, 'description' => $description, 'adminlink' => $adminlink, 'hits' => $hits, 'votes' => $votestring, 'comments' => $comments, 'plataform' => $platform, 'size' => $size, 'homepage' => $homepage, 'version' => $version, 'category' => $path, 'lang_dltimes' => sprintf(_MD_DLTIMES, $hits), 'mail_subject' => rawurlencode(sprintf(_MD_INTFILEFOUND, $xoopsConfig['sitename'])), 'mail_body' => rawurlencode(sprintf(_MD_INTFILEFOUND, $xoopsConfig['sitename']) . ':  ' . XOOPS_URL . '/modules/wmpdownloads/singlefile.php?cid=' . $cid . '&amp;lid=' . $lid)]);
    }

    $orderby = convertorderbyout($orderby);

    //Calculates how many pages exist.  Which page one should be on, etc...

    $downpages = ceil($numrows / $show);

    //Page Numbering

    if (1 != $downpages && 0 != $downpages) {
        $prev = $min - $show;

        if ($prev >= 0) {
            $page_nav .= "<a href='viewcat.php?cid=$cid&amp;min=$prev&amp;orderby=$orderby&amp;show=$show'><b><u>&laquo</u></b></a>&nbsp;";
        }

        $counter = 1;

        $currentpage = ($max / $show);

        while ($counter <= $downpages) {
            $mintemp = ($show * $counter) - $show;

            if ($counter == $currentpage) {
                $page_nav .= "<b>($counter)</b>&nbsp;";
            } else {
                $page_nav .= "<a href='viewcat.php?cid=$cid&amp;min=$mintemp&amp;orderby=$orderby&amp;show=$show'>$counter</a>&nbsp;";
            }

            $counter++;
        }

        if ($numrows > $max) {
            $page_nav .= "<a href='viewcat.php?cid=$cid&amp;min=$max&amp;orderby=$orderby&amp;show=$show'>";

            $page_nav .= '<b><u>&raquo;</u></b></a>';
        }
    }
}
$xoopsTpl->assign('page_nav', $page_nav);
require XOOPS_ROOT_PATH . '/modules/wmpdownloads/footer.php';
