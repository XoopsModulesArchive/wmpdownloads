<?php
// $Id: submit.php,v 1.11 2003/03/27 12:11:05 w4z004 Exp $
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
require_once XOOPS_ROOT_PATH . '/include/xoopscodes.php';

$myts = MyTextSanitizer::getInstance(); // MyTextSanitizer object
$eh = new ErrorHandler(); //ErrorHandler object
$mytree = new XoopsTree($xoopsDB->prefix('wmpdownloads_cat'), 'cid', 'pid');

if (empty($xoopsUser) && !$xoopsModuleConfig['anonpost']) {
    redirect_header(XOOPS_URL . '/user.php', 2, _MD_MUSTREGFIRST);

    exit();
}

if (!empty($_POST['submit'])) {
    $submitter = !empty($xoopsUser) ? $xoopsUser->getVar('uid') : 0;

    // Check if Title exist

    if ('' == $_POST['title']) {
        $eh::show('1001');
    }

    // Check if URL exist

    if (($_POST['url']) || ('' != $_POST['url'])) {
        $url = $_POST['url'];
    }

    if ('' == $url) {
        $eh::show('1016');
    }

    // Check if HomePage exist

    if ('' == $_POST['homepage']) {
        $eh::show('1001');
    }

    // Check if Description exist

    if ('' == $_POST['message']) {
        $eh::show('1008');
    }

    $notify = !empty($_POST['notify']) ? 1 : 0;

    if (!empty($_POST['cid'])) {
        $cid = (int)$_POST['cid'];
    } else {
        $cid = 0;
    }

    $url = $myts->addSlashes(formatURL($url));

    $title = $myts->addSlashes($_POST['title']);

    $homepage = $myts->addSlashes($_POST['homepage']);

    $version = $myts->addSlashes($_POST['version']);

    $size = (int)$_POST['size'];

    $platform = $myts->addSlashes($_POST['platform']);

    $description = $myts->addSlashes($_POST['message']);

    $date = time();

    $newid = $xoopsDB->genId($xoopsDB->prefix('wmpdownloads_downloads') . '_lid_seq');

    if (1 == $xoopsModuleConfig['autoapprove']) {
        $status = $xoopsModuleConfig['autoapprove'];
    } else {
        $status = 0;
    }

    $sql = sprintf("INSERT INTO %s (lid, cid, title, url, homepage, version, size, platform, logourl, submitter, status, date, hits, rating, votes, comments) VALUES (%u, %u, '%s', '%s', '%s', '%s', %u, '%s', '%s', %u, %u, %u, %u, %u, %u, %u)", $xoopsDB->prefix('wmpdownloads_downloads'), $newid, $cid, $title, $url, $homepage, $version, $size, $platform, '', $submitter, $status, $date, 0, 0, 0, 0);

    $xoopsDB->query($sql) or $eh::show('0013');

    if (0 == $newid) {
        $newid = $xoopsDB->getInsertId();
    }

    $sql = sprintf("INSERT INTO %s (lid, description) VALUES (%u, '%s')", $xoopsDB->prefix('wmpdownloads_text'), $newid, $description);

    $xoopsDB->query($sql) or $eh::show('0013');

    // Notify of new link (anywhere) and new link in category

    $notificationHandler = xoops_getHandler('notification');

    $tags = [];

    $tags['FILE_NAME'] = $title;

    $tags['FILE_URL'] = XOOPS_URL . '/modules/' . $xoopsModule->getVar('dirname') . '/singlefile.php?cid=' . $cid . '&lid=' . $newid;

    $sql = 'SELECT title FROM ' . $xoopsDB->prefix('wmpdownloads_cat') . ' WHERE cid=' . $cid;

    $result = $xoopsDB->query($sql);

    $row = $xoopsDB->fetchArray($result);

    $tags['CATEGORY_NAME'] = $row['title'];

    $tags['CATEGORY_URL'] = XOOPS_URL . '/modules/' . $xoopsModule->getVar('dirname') . '/viewcat.php?cid=' . $cid;

    if (1 == $xoopsModuleConfig['autoapprove']) {
        $notificationHandler->triggerEvent('global', 0, 'new_file', $tags);

        $notificationHandler->triggerEvent('category', $cid, 'new_file', $tags);

        redirect_header('index.php', 2, _MD_RECEIVED . '<br>' . _MD_ISAPPROVED . '');
    } else {
        $tags['WAITINGFILES_URL'] = XOOPS_URL . '/modules/' . $xoopsModule->getVar('dirname') . '/admin/index.php?op=listNewDownloads';

        $notificationHandler->triggerEvent('global', 0, 'file_submit', $tags);

        $notificationHandler->triggerEvent('category', $cid, 'file_submit', $tags);

        if ($notify) {
            require_once XOOPS_ROOT_PATH . '/include/notification_constants.php';

            $notificationHandler->subscribe('file', $newid, 'approve', XOOPS_NOTIFICATION_MODE_SENDONCETHENDELETE);
        }

        redirect_header('index.php', 2, _MD_RECEIVED);
    }

    exit();
}  
    $GLOBALS['xoopsOption']['template_main'] = 'wmpdownloads_submit.html';
    require XOOPS_ROOT_PATH . '/header.php';
    ob_start();
    xoopsCodeTarea('message', 37, 8);
    $xoopsTpl->assign('xoops_codes', ob_get_contents());
    ob_end_clean();
    ob_start();
    xoopsSmilies('message');
    $xoopsTpl->assign('xoops_smilies', ob_get_contents());
    ob_end_clean();
    $xoopsTpl->assign('notify_show', !empty($xoopsUser) && !$xoopsModuleConfig['autoapprove'] ? 1 : 0);
    $xoopsTpl->assign('lang_submitonce', _MD_SUBMITONCE);
    $xoopsTpl->assign('lang_submitcath', _MD_SUBMITCATHEAD);
    $xoopsTpl->assign('lang_allpending', _MD_ALLPENDING);
    $xoopsTpl->assign('lang_dontabuse', _MD_DONTABUSE);
    $xoopsTpl->assign('lang_wetakeshot', _MD_TAKEDAYS);
    $xoopsTpl->assign('lang_category', _MD_CATEGORYC);
    $xoopsTpl->assign('lang_sitetitle', _MD_FILETITLE);
    $xoopsTpl->assign('lang_siteurl', _MD_DLURL);
    $xoopsTpl->assign('lang_category', _MD_CATEGORYC);
    $xoopsTpl->assign('lang_homepage', _MD_HOMEPAGEC);
    $xoopsTpl->assign('lang_version', _MD_VERSIONC);
    $xoopsTpl->assign('lang_size', _MD_FILESIZEC);
    $xoopsTpl->assign('lang_bytes', _MD_BYTES);
    $xoopsTpl->assign('lang_platform', _MD_PLATFORMC);
    $xoopsTpl->assign('lang_options', _MD_OPTIONS);
    $xoopsTpl->assign('lang_notify', _MD_NOTIFYAPPROVE);
    $xoopsTpl->assign('lang_description', _MD_DESCRIPTION);
    $xoopsTpl->assign('lang_submit', _SUBMIT);
    $xoopsTpl->assign('lang_cancel', _CANCEL);
    ob_start();
    $mytree->makeMySelBox('title', 'title', 0, 1);
    $selbox = ob_get_contents();
    ob_end_clean();
    $xoopsTpl->assign('category_selbox', $selbox);
    require XOOPS_ROOT_PATH . '/footer.php';

