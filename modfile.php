<?php
// $Id: modfile.php,v 1.7 2003/03/27 12:11:05 w4z004 Exp $
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
require_once XOOPS_ROOT_PATH . '/class/module.errorhandler.php';
$myts = MyTextSanitizer::getInstance(); // MyTextSanitizer object
$mytree = new XoopsTree($xoopsDB->prefix('wmpdownloads_cat'), 'cid', 'pid');

if ($_POST['submit']) {
    $eh = new ErrorHandler(); //ErrorHandler object

    if (empty($xoopsUser)) {
        redirect_header(XOOPS_URL . '/user.php', 2, _MD_MUSTREGFIRST);

        exit();
    }  

    $ratinguser = $xoopsUser->getVar('uid');

    $lid = (int)$_POST['lid'];

    // Check if Title exist

    if ('' == $_POST['title']) {
        $eh::show('1001');
    }

    // Check if URL exist

    if ('' == $_POST['url']) {
        $eh::show('1016');
    }

    // Check if HOMEPAGE exist

    if ('' == $_POST['homepage']) {
        $eh::show('1016');
    }

    // Check if Description exist

    if ('' == $_POST['description']) {
        $eh::show('1008');
    }

    $url = $myts->addSlashes($url);

    $logourl = $myts->addSlashes($_POST['logourl']);

    $cid = (int)$_POST['cid'];

    $title = $myts->addSlashes($_POST['title']);

    $homepage = $myts->addSlashes($_POST['homepage']);

    $version = $myts->addSlashes($version);

    $size = $myts->addSlashes($size);

    $platform = $myts->addSlashes($platform);

    $description = $myts->addSlashes($_POST['description']);

    $newid = $xoopsDB->genId($xoopsDB->prefix('wmpdownloads_mod') . '_requestid_seq');

    $sql = sprintf("INSERT INTO %s (requestid, lid, cid, title, url, homepage, version, size, platform, logourl, description, modifysubmitter) VALUES (%u, %u, %u, '%s', '%s', '%s', '%s', %u, '%s', '%s', '%s', %u)", $xoopsDB->prefix('wmpdownloads_mod'), $newid, $lid, $cid, $title, $url, $homepage, $version, $size, $platform, $logourl, $description, $ratinguser);

    $xoopsDB->query($sql) or $eh::show('0013');

    $tags = [];

    $tags['MODIFYREPORTS_URL'] = XOOPS_URL . '/modules/' . $xoopsModule->getVar('dirname') . '/admin/index.php?op=listModReq';

    $notificationHandler = xoops_getHandler('notification');

    $notificationHandler->triggerEvent('global', 0, 'file_modify', $tags);

    redirect_header('index.php', 2, _MD_THANKSFORINFO);

    exit();
}  
    $lid = (int)$_GET['lid'];
    if (empty($xoopsUser)) {
        redirect_header(XOOPS_URL . '/user.php', 2, _MD_MUSTREGFIRST);

        exit();
    }
    $GLOBALS['xoopsOption']['template_main'] = 'wmpdownloads_modfile.html';
    require XOOPS_ROOT_PATH . '/header.php';
    $result = $xoopsDB->query('SELECT cid, title, url, homepage, version, size, platform, logourl FROM ' . $xoopsDB->prefix('wmpdownloads_downloads') . ' WHERE lid=' . $lid . ' AND status>0');
    $xoopsTpl->assign('lang_requestmod', _MD_REQUESTMOD);
    [$cid, $title, $url, $homepage, $version, $size, $platform, $logourl] = $xoopsDB->fetchRow($result);
    $title = htmlspecialchars($title, ENT_QUOTES | ENT_HTML5);
    $url = htmlspecialchars($url, ENT_QUOTES | ENT_HTML5);
    $homepage = htmlspecialchars($homepage, ENT_QUOTES | ENT_HTML5);
    $version = htmlspecialchars($version, ENT_QUOTES | ENT_HTML5);
    $size = htmlspecialchars($size, ENT_QUOTES | ENT_HTML5);
    $platform = htmlspecialchars($platform, ENT_QUOTES | ENT_HTML5);
    $logourl = htmlspecialchars($logourl, ENT_QUOTES | ENT_HTML5);
    $result2 = $xoopsDB->query('SELECT description FROM ' . $xoopsDB->prefix('wmpdownloads_text') . " WHERE lid=$lid");
    [$description] = $xoopsDB->fetchRow($result2);
    $description = htmlspecialchars($description, ENT_QUOTES | ENT_HTML5);
    $xoopsTpl->assign('file', ['id' => $lid, 'rating' => number_format($rating, 2), 'title' => $title, 'url' => $url, 'logourl' => $logourl, 'updated' => formatTimestamp($time, 'm'), 'description' => $description, 'hits' => $hits, 'votes' => $votestring, 'plataform' => $platform, 'size' => $size, 'homepage' => $homepage, 'version' => $version]);
    $xoopsTpl->assign('lang_fileid', _MD_FILEID);
    $xoopsTpl->assign('lang_sitetitle', _MD_FILETITLE);
    $xoopsTpl->assign('lang_siteurl', _MD_DLURL);
    $xoopsTpl->assign('lang_category', _MD_CATEGORYC);
    $xoopsTpl->assign('lang_homepage', _MD_HOMEPAGEC);
    $xoopsTpl->assign('lang_version', _MD_VERSIONC);
    $xoopsTpl->assign('lang_size', _MD_FILESIZEC);
    $xoopsTpl->assign('lang_bytes', _MD_BYTES);
    $xoopsTpl->assign('lang_platform', _MD_PLATFORMC);
    ob_start();
    $mytree->makeMySelBox('title', 'title', $cid);
    $selbox = ob_get_contents();
    ob_end_clean();
    $xoopsTpl->assign('category_selbox', $selbox);
    $xoopsTpl->assign('lang_description', _MD_DESCRIPTIONC);
    $xoopsTpl->assign('modifysubmitter', $xoopsUser->getVar('uid'));
    $xoopsTpl->assign('lang_sendrequest', _MD_SENDREQUEST);
    $xoopsTpl->assign('lang_cancel', _CANCEL);
    require XOOPS_ROOT_PATH . '/footer.php';

