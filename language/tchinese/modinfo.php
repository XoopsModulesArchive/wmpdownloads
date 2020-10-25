<?php
// $Id: modinfo.php,v 1.13 2003/03/27 12:11:05 w4z004 Exp $
// Module Info

// The name of this module
define('_MI_wmpdownloadS_NAME', '檔案下載');

// A brief description of this module
define('_MI_wmpdownloadS_DESC', '建立下載區讓使用者下載/提供/評分檔案.');

// Names of blocks for this module (Not all module has blocks)
define('_MI_wmpdownloadS_BNAME1', '新進檔案');
define('_MI_wmpdownloadS_BNAME2', '熱門檔案');

// Sub menu titles
define('_MI_wmpdownloadS_SMNAME1', '提供檔案');
define('_MI_wmpdownloadS_SMNAME2', '熱門下載');
define('_MI_wmpdownloadS_SMNAME3', '推薦下載');

// Names of admin menu items
define('_MI_wmpdownloadS_ADMENU2', '添加/修改/刪除檔案');
define('_MI_wmpdownloadS_ADMENU3', '提供檔案下載');
define('_MI_wmpdownloadS_ADMENU4', '回報失聯檔案');
define('_MI_wmpdownloadS_ADMENU5', '更新提報檔案');
define('_MI_wmpdownloadS_ADMENU6', '樹狀分類/增加檔案');
// Title of config items
define('_MI_wmpdownloadS_POPULAR', '設定要多少點擊數才可使檔案成為熱門檔案');
define('_MI_wmpdownloadS_NEWDLS', '設定下載區顯示最大檔案數');
define('_MI_wmpdownloadS_PERPAGE', '設定下載各分類區顯示最大檔案數');
define('_MI_wmpdownloadS_USESHOTS', '是否顯示縮圖');
define('_MI_wmpdownloadS_SHOTWIDTH', '縮圖最大寬度');
define('_MI_wmpdownloadS_CHECKHOST', '防止盜鏈?');
define('_MI_wmpdownloadS_REFERERS', '這可以直接連結到您的檔案<br>使用 | 分開');
define('_MI_wmpdownloadS_ANONPOST', '允許訪客發佈檔案?');
define('_MI_wmpdownloadS_AUTOAPPROVE', '自動發佈網友提供的檔案?');

// Description of each config items
define('_MI_wmpdownloadS_POPULARDSC', '');
define('_MI_wmpdownloadS_NEWDLSDSC', '');
define('_MI_wmpdownloadS_PERPAGEDSC', '');
define('_MI_wmpdownloadS_USESHOTSDSC', '');
define('_MI_wmpdownloadS_SHOTWIDTHDSC', '');
define('_MI_wmpdownloadS_REFERERSDSC', '');
define('_MI_wmpdownloadS_AUTOAPPROVEDSC', '');

// Text for notifications

define('_MI_wmpdownloadS_GLOBAL_NOTIFY', '全域通知');
define('_MI_wmpdownloadS_GLOBAL_NOTIFYDSC', '檔案下載區自動提醒通知項目.');

define('_MI_wmpdownloadS_CATEGORY_NOTIFY', '分類通知');
define('_MI_wmpdownloadS_CATEGORY_NOTIFYDSC', '分類自動提醒項目.');

define('_MI_wmpdownloadS_FILE_NOTIFY', '檔案通知');
define('_MI_wmpdownloadS_FILE_NOTIFYDSC', '檔案時自動提醒項目.');

define('_MI_wmpdownloadS_GLOBAL_NEWCATEGORY_NOTIFY', '新分類通知');
define('_MI_wmpdownloadS_GLOBAL_NEWCATEGORY_NOTIFYCAP', '新分類建立時通知我.');
define('_MI_wmpdownloadS_GLOBAL_NEWCATEGORY_NOTIFYDSC', '接受新分類建立通知.');
define('_MI_wmpdownloadS_GLOBAL_NEWCATEGORY_NOTIFYSBJ', '[{X_SITENAME}] 「{X_MODULE}」自動提醒通知 : 新分類建立');

define('_MI_wmpdownloadS_GLOBAL_FILEMODIFY_NOTIFY', '檔案修改通知');
define('_MI_wmpdownloadS_GLOBAL_FILEMODIFY_NOTIFYCAP', '檔案修改時通知我.');
define('_MI_wmpdownloadS_GLOBAL_FILEMODIFY_NOTIFYDSC', '接受檔案修改通知.');
define('_MI_wmpdownloadS_GLOBAL_FILEMODIFY_NOTIFYSBJ', '[{X_SITENAME}] 「{X_MODULE}」自動提醒通知 : 檔案修改待審');

define('_MI_wmpdownloadS_GLOBAL_FILEBROKEN_NOTIFY', '檔案失聯通知');
define('_MI_wmpdownloadS_GLOBAL_FILEBROKEN_NOTIFYCAP', '有檔案失聯報告時通知我.');
define('_MI_wmpdownloadS_GLOBAL_FILEBROKEN_NOTIFYDSC', '接受檔案失聯報告通知.');
define('_MI_wmpdownloadS_GLOBAL_FILEBROKEN_NOTIFYSBJ', '[{X_SITENAME}] 「{X_MODULE}」自動提醒通知 : 檔案失聯待審');

define('_MI_wmpdownloadS_GLOBAL_FILESUBMIT_NOTIFY', '檔案提供通知');
define('_MI_wmpdownloadS_GLOBAL_FILESUBMIT_NOTIFYCAP', '有新提供待審的檔案時通知我.');
define('_MI_wmpdownloadS_GLOBAL_FILESUBMIT_NOTIFYDSC', '接受檔案提供待審通知.');
define('_MI_wmpdownloadS_GLOBAL_FILESUBMIT_NOTIFYSBJ', '[{X_SITENAME}] 「{X_MODULE}」自動提醒通知 : 新檔案待審');

define('_MI_wmpdownloadS_GLOBAL_NEWFILE_NOTIFY', '新檔案發布通知');
define('_MI_wmpdownloadS_GLOBAL_NEWFILE_NOTIFYCAP', '有新檔案發布時通知我.');
define('_MI_wmpdownloadS_GLOBAL_NEWFILE_NOTIFYDSC', '接受新檔案發布通知.');
define('_MI_wmpdownloadS_GLOBAL_NEWFILE_NOTIFYSBJ', '[{X_SITENAME}] 「{X_MODULE}」自動提醒通知 : 有新檔案發布');

define('_MI_wmpdownloadS_CATEGORY_FILESUBMIT_NOTIFY', '檔案提供通知');
define('_MI_wmpdownloadS_CATEGORY_FILESUBMIT_NOTIFYCAP', '本分類有新提供待審檔案時通知我.');
define('_MI_wmpdownloadS_CATEGORY_FILESUBMIT_NOTIFYDSC', '接受本分類的新檔案待審通知.');
define('_MI_wmpdownloadS_CATEGORY_FILESUBMIT_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} 自動提醒通知 : 本分類有新檔案待審');

define('_MI_wmpdownloadS_CATEGORY_NEWFILE_NOTIFY', '新檔案發布通知');
define('_MI_wmpdownloadS_CATEGORY_NEWFILE_NOTIFYCAP', '本分類有新檔案發布時通知我.');
define('_MI_wmpdownloadS_CATEGORY_NEWFILE_NOTIFYDSC', '接受本分類新檔案發布通知.');
define('_MI_wmpdownloadS_CATEGORY_NEWFILE_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} 自動提醒通知 : 本分類有新檔案發布');

define('_MI_wmpdownloadS_FILE_APPROVE_NOTIFY', '檔案核准通知');
define('_MI_wmpdownloadS_FILE_APPROVE_NOTIFYCAP', '提供的檔案被核准時通知我.');
define('_MI_wmpdownloadS_FILE_APPROVE_NOTIFYDSC', '接受檔案提供核准通知.');
define('_MI_wmpdownloadS_FILE_APPROVE_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} 自動提醒通知 : 檔案已被核准');
