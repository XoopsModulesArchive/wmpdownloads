<?php
// $Id: main.php,v 1.8 2003/03/27 12:11:05 w4z004 Exp $
//%%%%%%		Module Name 'wmpdownloads'		%%%%%

define('_MD_THANKSFORINFO', '感谢您发布软件，我们会尽快处理。');
define('_MD_THANKSFORHELP', '感谢您提报失链报告');
define('_MD_FORSECURITY', '为了维护本站安全，您的大名(代号)及IP将会被系统记录下来。');
define('_MD_NOPERMISETOLINK', '该软件链接并不属于此站<br><br>请给提供此链接的管理员发邮件。<br><b>请勿盗链!!</b> <br><br><b>请遵照网路礼仪:</b> 勿盗链、提供链接是自己网站或自己提供下载的软件。谢谢。<br><br>您的IP将被<b>记录下来</b>。');
define('_MD_ALL', '全部');
define('_MD_DESCRIPTION', '描述');
define('_MD_SEARCH', '搜索');
define('_MD_SUBMITCATHEAD', '软件发布');

define('_MD_MAIN', '下载中心');
define('_MD_POPULAR', '热门下载');
define('_MD_NEWTHISWEEK', '本周最新');
define('_MD_UPTHISWEEK', '本周更新');

define('_MD_POPULARITYLTOM', '下载排行榜 (由低到高)');
define('_MD_POPULARITYMTOL', '下载排行榜 (由高到低)');
define('_MD_TITLEATOZ', '名称 (A 到 Z)');
define('_MD_TITLEZTOA', '名称 (Z 到 A)');
define('_MD_DATEOLD', '日期 (旧软件在前)');
define('_MD_DATENEW', '日期 (新软件在前)');
define('_MD_RATINGLTOH', '评分 (由低到高)');
define('_MD_RATINGHTOL', '评分 (由高到低)');

define('_MD_NOSHOTS', '暂无抓图');
define('_MD_EDITTHISDL', '修改链接');

define('_MD_DESCRIPTIONC', '软件描述: ');
define('_MD_EMAILC', 'Email: ');
define('_MD_CATEGORYC', '分类: ');
define('_MD_LASTUPDATEC', '最后更新: ');
define('_MD_DLNOW', '立即下载!');
define('_MD_VERSION', '版本');
define('_MD_SUBMITDATE', '发布时间');
define('_MD_DLTIMES', '已下载%s次');
define('_MD_FILESIZE', '软件大小');
define('_MD_SUPPORTEDPLAT', '支持平台');
define('_MD_HOMEPAGE', '作者网站');
define('_MD_HITSC', '下载数: ');
define('_MD_RATINGC', '评分: ');
define('_MD_ONEVOTE', '1 票');
define('_MD_NUMVOTES', '%s 票');
define('_MD_RATETHISFILE', '给予评分');
define('_MD_MODIFY', '修改');
define('_MD_REPORTBROKEN', '提报失效链接');
define('_MD_TELLAFRIEND', '告诉朋友');
define('_MD_EDIT', '编辑');

define('_MD_THEREARE', '共有%s个软件在本站数据库');
define('_MD_LATESTLIST', '最新列表');

define('_MD_REQUESTMOD', '修改下载软件');
define('_MD_FILEID', '软件编号: ');
define('_MD_FILETITLE', '下载名称: ');
define('_MD_DLURL', '下载网址: ');
define('_MD_HOMEPAGEC', '来源网站: ');
define('_MD_VERSIONC', '版本: ');
define('_MD_FILESIZEC', '软件大小: ');
define('_MD_NUMBYTES', '%s 字节');
define('_MD_PLATFORMC', '支持平台: ');
define('_MD_SHOTIMAGE', '截图位置: ');
define('_MD_SENDREQUEST', '确定');
define('_MD_OPTIONS', '选项: ');
define('_MD_NOTIFYAPPROVE', '该软件通过审查时，请给我发通知');

define('_MD_VOTEAPPRE', '谢谢您的投票。');
define('_MD_THANKYOU', '谢谢您参与在[%s]的投票'); // %s is your site name
define('_MD_VOTEONCE', '请不要重复投票给同一项目。');
define('_MD_RATINGSCALE', '评分方式将由 1 - 10 做为评分标准,1为最差、5为普通，10为最好。');
define('_MD_BEOBJECTIVE', '请客观的给予评论,不要给予太多极端分数如1或10。让分数正态分布。');
define('_MD_DONOTVOTE', '请不要投票给自己所提供的项目。');
define('_MD_RATEIT', '投票!');

define('_MD_INTFILEFOUND', '我在[%s]下载了一个不错的软件喔'); // %s is your site name

define('_MD_RECEIVED', '我们已收到您提供的软件信息。谢谢！');
define('_MD_WHENAPPROVED', '当核准时您将会收到确认信。');
define('_MD_SUBMITONCE', '一次只接受一个软件。');
define('_MD_ALLPENDING', '所有软件信息请详加确认及提供详细信息。');
define('_MD_DONTABUSE', '为了安全起见，您的大名(代号)及IP将会被记录下来。请勿提供错误信息');
define('_MD_TAKEDAYS', '站长将详加考虑是否接受您的软件。也许会花几天时间，请耐心等候。');

define('_MD_RANK', '排名');
define('_MD_CATEGORY', '分类项目');
define('_MD_HITS', '下载数');
define('_MD_RATING', '平均分数');
define('_MD_VOTE', '投票');

define('_MD_SORTBY', '排列方式:');
define('_MD_TITLE', '名称');
define('_MD_DATE', '日期');
define('_MD_POPULARITY', '热门度');
define('_MD_CURSORTBY', '排序关键字: %s');
define('_MD_PREVIOUS', '上一页');
define('_MD_NEXT', '下一页');
define('_MD_NOMATCH', '没有搜索到您要的信息');

define('_MD_TOP10', '%s排行榜'); // %s is a downloads category name

define('_MD_SUBMIT', '确认');
define('_MD_CANCEL', '取消');

define('_MD_BYTES', '字节');
define('_MD_ALREADYREPORTED', '您已经完成软件失链提报。');
define('_MD_MUSTREGFIRST', '抱歉，您无权进行此操作。<br>请先登录或注册!');
define('_MD_NORATING', '没有评分。');
define('_MD_CANTVOTEOWN', '您不能对此软件投票。<br>所有投票已经暂停。');

//%%%%%%	Module Name 'wmpdownloads' (Admin)	  %%%%%
define('_MI_wmpdownloadS_ADMENU6', '树状分类/文件添加');
define('_MD_DLCONF', 'Downloads设置');
define('_MD_GENERALSET', '一般设置');
define('_MD_ADDMODDELETE', '添加、修改及删除分类/软件');
define('_MD_DLSWAITING', '等待核准');
define('_MD_BROKENREPORTS', '失链报告');
define('_MD_MODREQUESTS', '修改软件信息');
define('_MD_SUBMITTER', '提交者: ');
define('_MD_DOWNLOAD', '下载');
define('_MD_APPROVE', '核准');
define('_MD_DELETE', '删除');
define('_MD_NOSUBMITTED', '没有要求核准的新软件。');
define('_MD_ADDMAIN', '添加主分类项目');
define('_MD_TITLEC', '项目: ');
define('_MD_IMGURL', '图片网址 (图片高度限制为50 Pix): ');
define('_MD_ADD', '添加');
define('_MD_ADDSUB', '添加子分类项目');
define('_MD_IN', '在');
define('_MD_ADDNEWFILE', '添加软件');
define('_MD_MODCAT', '修改分类名称');
define('_MD_MODDL', '修改软件信息');
define('_MD_USER', '用户');
define('_MD_IP', 'IP地址');
define('_MD_USERAVG', '平均分数');
define('_MD_TOTALRATE', '总分');
define('_MD_NOREGVOTES', '无会员投票');
define('_MD_NOUNREGVOTES', '无未注册者投票');
define('_MD_VOTEDELETED', '删除投票日期。');
define('_MD_NOBROKEN', '没有人提报软件失链信息');
define('_MD_IGNOREDESC', '忽略 (忽略提报并只删除<b>失链报告</b>)。');
define('_MD_DELETEDESC', '删除 (删除<b>失链软件</b>及<b>失链报告</b>。)');
define('_MD_REPORTER', '提报者');
define('_MD_FILESUBMITTER', '软件提供者');
define('_MD_IGNORE', '忽略');
define('_MD_FILEDELETED', '软件删除完毕');
define('_MD_BROKENDELETED', '失链报告删除完毕');
define('_MD_USERMODREQ', '软件信息要求修改');
define('_MD_ORIGINAL', '原本');
define('_MD_PROPOSED', '推荐');
define('_MD_OWNER', '拥有者: ');
define('_MD_NOMODREQ', '无软件信息要求修改。');
define('_MD_DBUPDATED', '信息更新完成!');
define('_MD_MODREQDELETED', '修改请求已删除');
define('_MD_IMGURLMAIN', '图片网址 (只能在主分类中显示，图片高度限制为50 Pix): ');
define('_MD_PARENT', '相关分类:');
define('_MD_SAVE', '保存修改');
define('_MD_CATDELETED', '分类删除完毕');
define('_MD_WARNING', '注意！您确定要删除这个分类吗？该分类下的任何子分类及信息将会一并删除。');
define('_MD_YES', '是');
define('_MD_NO', '否');
define('_MD_NEWCATADDED', '分类添加成功!');
define('_MD_ERROREXIST', '错误:这个项目已经存在于数据库中！');
define('_MD_ERRORTITLE', '错误:您必须输入名称！');
define('_MD_ERRORDESC', '错误:您必须输入描述！');
define('_MD_NEWDLADDED', '软件添加成功');
define('_MD_HELLO', '您好%s');
define('_MD_WEAPPROVED', '我们已把您推荐的软件放置于本站中。');
define('_MD_THANKSSUBMIT', '谢谢您的参与！');

define('_MD_MUSTBEVALID', '抓图的图片都必须放在 %s 目录下，所以目录不须列出 (例如 shot.gif). 如果没有抓图请留空白。');

define('_MD_REGUSERVOTES', '会员票数 (总票数:%s)');
define('_MD_ANONUSERVOTES', '非会员票数 (总票数:%s)');

define('_MD_YOURFILEAT', '您在%s发布的软件已经被认可 ');

define('_MD_VISITAT', '访问%s下载区');

define('_MD_DLRATINGS', '软件评分 (总计票数%s)');
define('_MD_ISAPPROVED', '我们已经审核通过您所发布的软件');
