<?php
// $Id: modinfo.php,v 1.13 2003/03/27 12:11:05 w4z004 Exp $
// Module Info

// The name of this module
define('_MI_wmpdownloadS_NAME', '下载中心');

// A brief description of this module
define('_MI_wmpdownloadS_DESC', '创建下载区让用户下载/发布/评分软件。');

// Names of blocks for this module (Not all module has blocks)
define('_MI_wmpdownloadS_BNAME1', '新进下载');
define('_MI_wmpdownloadS_BNAME2', '热门下载');

// Sub menu titles
define('_MI_wmpdownloadS_SMNAME1', '软件发布');
define('_MI_wmpdownloadS_SMNAME2', '热门下载');
define('_MI_wmpdownloadS_SMNAME3', '推荐下载');

// Names of admin menu items
define('_MI_wmpdownloadS_ADMENU2', '添加/修改/删除软件');
define('_MI_wmpdownloadS_ADMENU3', '提供软件下载');
define('_MI_wmpdownloadS_ADMENU4', '提报失链软件');
define('_MI_wmpdownloadS_ADMENU5', '更新提报软件');
define('_MI_wmpdownloadS_ADMENU6', '树状分类/文件添加');
// Title of config items
define('_MI_wmpdownloadS_POPULAR', '要多少点击数才可使软件成为热门下载');
define('_MI_wmpdownloadS_NEWDLS', '下载区显示最大下载条目数');
define('_MI_wmpdownloadS_PERPAGE', '下载各分类区显示最大下载条目数');
define('_MI_wmpdownloadS_USESHOTS', '是否显示缩图');
define('_MI_wmpdownloadS_SHOTWIDTH', '缩图最大宽度');
define('_MI_wmpdownloadS_CHECKHOST', '防止盗链?');
define('_MI_wmpdownloadS_REFERERS', '这可以直接链接到您的软件<br>使用 | 分开');
define('_MI_wmpdownloadS_ANONPOST', '允许游客发布软件?');
define('_MI_wmpdownloadS_AUTOAPPROVE', '自动发布网友提供的软件?');

// Description of each config items
define('_MI_wmpdownloadS_POPULARDSC', '');
define('_MI_wmpdownloadS_NEWDLSDSC', '');
define('_MI_wmpdownloadS_PERPAGEDSC', '');
define('_MI_wmpdownloadS_USESHOTSDSC', '');
define('_MI_wmpdownloadS_SHOTWIDTHDSC', '');
define('_MI_wmpdownloadS_REFERERSDSC', '');
define('_MI_wmpdownloadS_AUTOAPPROVEDSC', '');

// Text for notifications

define('_MI_wmpdownloadS_GLOBAL_NOTIFY', '全局通知');
define('_MI_wmpdownloadS_GLOBAL_NOTIFYDSC', '下载中心全局通知选项.');

define('_MI_wmpdownloadS_CATEGORY_NOTIFY', '当前分类');
define('_MI_wmpdownloadS_CATEGORY_NOTIFYDSC', '应用到当前下载分类的通知选项');

define('_MI_wmpdownloadS_FILE_NOTIFY', '当前软件');
define('_MI_wmpdownloadS_FILE_NOTIFYDSC', '应用到当前软件的通知选项.');

define('_MI_wmpdownloadS_GLOBAL_NEWCATEGORY_NOTIFY', '新下载分类');
define('_MI_wmpdownloadS_GLOBAL_NEWCATEGORY_NOTIFYCAP', '当有新的下载分类创建时，请通知我');
define('_MI_wmpdownloadS_GLOBAL_NEWCATEGORY_NOTIFYDSC', '当有新的下载分类创建时，接收通知.');
define('_MI_wmpdownloadS_GLOBAL_NEWCATEGORY_NOTIFYSBJ', '[{X_SITENAME}] “{X_MODULE}”自动通知 : 新的下载分类创建了');

define('_MI_wmpdownloadS_GLOBAL_FILEMODIFY_NOTIFY', '修正请求');
define('_MI_wmpdownloadS_GLOBAL_FILEMODIFY_NOTIFYCAP', '有任何修正请求，通知我.');
define('_MI_wmpdownloadS_GLOBAL_FILEMODIFY_NOTIFYDSC', '当有修正请求提交，接收通知.');
define('_MI_wmpdownloadS_GLOBAL_FILEMODIFY_NOTIFYSBJ', '[{X_SITENAME}] “{X_MODULE}”自动通知: 下载修正请求');

define('_MI_wmpdownloadS_GLOBAL_FILEBROKEN_NOTIFY', '失链报告');
define('_MI_wmpdownloadS_GLOBAL_FILEBROKEN_NOTIFYCAP', '若有失链报告，通知我.');
define('_MI_wmpdownloadS_GLOBAL_FILEBROKEN_NOTIFYDSC', '当有人提交失链报告时，接收通知.');
define('_MI_wmpdownloadS_GLOBAL_FILEBROKEN_NOTIFYSBJ', '[{X_SITENAME}] “{X_MODULE}”自动通知: 失链报告');

define('_MI_wmpdownloadS_GLOBAL_FILESUBMIT_NOTIFY', '软件提交');
define('_MI_wmpdownloadS_GLOBAL_FILESUBMIT_NOTIFYCAP', '有软件提交(等待审核)时通知我.');
define('_MI_wmpdownloadS_GLOBAL_FILESUBMIT_NOTIFYDSC', '当有人要提交软件(等待审核)时，接收通知.');
define('_MI_wmpdownloadS_GLOBAL_FILESUBMIT_NOTIFYSBJ', '[{X_SITENAME}] “{X_MODULE}”自动通知: 新软件提交');

define('_MI_wmpdownloadS_GLOBAL_NEWFILE_NOTIFY', '新软件');
define('_MI_wmpdownloadS_GLOBAL_NEWFILE_NOTIFYCAP', '有新软件发布时通知我.');
define('_MI_wmpdownloadS_GLOBAL_NEWFILE_NOTIFYDSC', '当有新软件发布时，接收通知.');
define('_MI_wmpdownloadS_GLOBAL_NEWFILE_NOTIFYSBJ', '[{X_SITENAME}] “{X_MODULE}”自动通知: 新软件已发布');

define('_MI_wmpdownloadS_CATEGORY_FILESUBMIT_NOTIFY', '软件提交');
define('_MI_wmpdownloadS_CATEGORY_FILESUBMIT_NOTIFYCAP', '当该分类有新软件提交(待审)时通知我.');
define('_MI_wmpdownloadS_CATEGORY_FILESUBMIT_NOTIFYDSC', '如果当前分类有新软件提交(待审)，接收通知.');
define('_MI_wmpdownloadS_CATEGORY_FILESUBMIT_NOTIFYSBJ', '[{X_SITENAME}] “{X_MODULE}”自动通知: 新软件提交到您跟踪的分类');

define('_MI_wmpdownloadS_CATEGORY_NEWFILE_NOTIFY', '新软件');
define('_MI_wmpdownloadS_CATEGORY_NEWFILE_NOTIFYCAP', '当前分类有新软件发布时通知我.');
define('_MI_wmpdownloadS_CATEGORY_NEWFILE_NOTIFYDSC', '如果当前分类有新软件发布，接收通知.');
define('_MI_wmpdownloadS_CATEGORY_NEWFILE_NOTIFYSBJ', '[{X_SITENAME}] “{X_MODULE}”自动通知: 新软件发布在您跟踪的分类');

define('_MI_wmpdownloadS_FILE_APPROVE_NOTIFY', '审核通过');
define('_MI_wmpdownloadS_FILE_APPROVE_NOTIFYCAP', '审核通过时通知我.');
define('_MI_wmpdownloadS_FILE_APPROVE_NOTIFYDSC', '当该软件通过审批时，接收通知.');
define('_MI_wmpdownloadS_FILE_APPROVE_NOTIFYSBJ', '[{X_SITENAME}] “{X_MODULE}”自动通知: 软件已通过审核');
