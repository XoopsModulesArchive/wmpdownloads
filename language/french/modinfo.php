<?php
// $Id: modinfo.php,v 1.13 2003/03/27 12:11:05 w4z004 Exp $
// Support Francophone de Xoops (www.frxoops.org)
// Module Info

// The name of this module
define('_MI_wmpdownloadS_NAME', 'T&eacute;l&eacute;chargements');

// A brief description of this module
define('_MI_wmpdownloadS_DESC', 'Cr&eacute;e une section T&eacute;l&eacute;chargemetns o&ugrave; les utilisateurs peuvent t&eacute;l&eacute;charger/proposer/noter divers fichiers.');

// Names of blocks for this module (Not all module has blocks)
define('_MI_wmpdownloadS_BNAME1', 'T&eacute;l&eacute;chargements R&eacute;cents');
define('_MI_wmpdownloadS_BNAME2', 'Top T&eacute;l&eacute;chargements');

// Sub menu titles
define('_MI_wmpdownloadS_SMNAME1', 'Proposer');
define('_MI_wmpdownloadS_SMNAME2', 'Populaire');
define('_MI_wmpdownloadS_SMNAME3', 'Mieux Not&eacute;s');

// Names of admin menu items
define('_MI_wmpdownloadS_ADMENU2', 'Ajouter/Editer des T&eacute;l&eacute;chargements');
define('_MI_wmpdownloadS_ADMENU3', 'Proposer des T&eacute;l&eacute;chargements');
define('_MI_wmpdownloadS_ADMENU4', 'T&eacute;l&eacute;chargements Bris&eacute;s');
define('_MI_wmpdownloadS_ADMENU5', 'T&eacute;l&eacute;chargements Modifi&eacute;s');

// Title of config items
define('_MI_wmpdownloadS_POPULAR', 'Hits pour &ecirc;tre Populaire');
define('_MI_wmpdownloadS_NEWDLS', "Nombre de nouveaux t&eacute;l&eacute;chargements sur la page d'accueil");
define('_MI_wmpdownloadS_PERPAGE', 'T&eacute;l&eacute;chargements affich&eacute;s par page');
define('_MI_wmpdownloadS_USESHOTS', "Utiliser les Copies d'Ecrans ?");
define('_MI_wmpdownloadS_SHOTWIDTH', "Largeur des Copies d'Ecrans");
define('_MI_wmpdownloadS_CHECKHOST', 'Limiter les aspirateurs de fichiers ?');
define('_MI_wmpdownloadS_REFERERS', 'Sites avec acc&eacute;s pour lier les t&eacute;l&eacute;chargements');
define('_MI_wmpdownloadS_ANONPOST', 'Autoriser les utilisateurs anonymes &agrave; proposer des t&eacute;l&eacute;chargements ?');
define('_MI_wmpdownloadS_AUTOAPPROVE', "Approuver automatiquement les nouveaux t&eacute;l&eacute;chargements sans l'intervention d'un administrateur ?");

// Description of each config items
define('_MI_wmpdownloadS_POPULARDSC', '');
define('_MI_wmpdownloadS_NEWDLSDSC', '');
define('_MI_wmpdownloadS_PERPAGEDSC', '');
define('_MI_wmpdownloadS_USESHOTSDSC', '');
define('_MI_wmpdownloadS_SHOTWIDTHDSC', '');
define('_MI_wmpdownloadS_REFERERSDSC', '');
define('_MI_wmpdownloadS_AUTOAPPROVEDSC', '');

// Text for notifications

define('_MI_wmpdownloadS_GLOBAL_NOTIFY', 'Globale');
define('_MI_wmpdownloadS_GLOBAL_NOTIFYDSC', 'Options de notifications Globales des t&eacute;l&eacute;chargements.');

define('_MI_wmpdownloadS_CATEGORY_NOTIFY', 'Cat&eacute;gorie');
define('_MI_wmpdownloadS_CATEGORY_NOTIFYDSC', "Options de notification s'appliquant &agrave; la cat&eacute;gorie de fichier actuelle.");

define('_MI_wmpdownloadS_FILE_NOTIFY', 'Fichier');
define('_MI_wmpdownloadS_FILE_NOTIFYDSC', "Options de notification s'appliquant au fichier actuel.");

define('_MI_wmpdownloadS_GLOBAL_NEWCATEGORY_NOTIFY', 'Nouvelle Cat&eacute;gorie');
define('_MI_wmpdownloadS_GLOBAL_NEWCATEGORY_NOTIFYCAP', 'Notifiez-moi quand une nouvelle cat&eacute;gorie de fichier est cr&eacute;&eacute;e.');
define('_MI_wmpdownloadS_GLOBAL_NEWCATEGORY_NOTIFYDSC', "Recevoir une notification lorsqu'une nouvelle cat&eacute;gorie de fichier est cr&eacute;&eacute;e.");
define('_MI_wmpdownloadS_GLOBAL_NEWCATEGORY_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} notification automatique : Nouvelle cat&eacute;gorie de fichier');

define('_MI_wmpdownloadS_GLOBAL_FILEMODIFY_NOTIFY', 'Modification de Fichier Demand&eacute;e');
define('_MI_wmpdownloadS_GLOBAL_FILEMODIFY_NOTIFYCAP', 'Notifiez-moi pour chaque demande de modification de fichier.');
define('_MI_wmpdownloadS_GLOBAL_FILEMODIFY_NOTIFYDSC', 'Recevoir une notification quand une demande de modification de fichier est propos&eacute;e.');
define('_MI_wmpdownloadS_GLOBAL_FILEMODIFY_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} notification automatique : Modification de fichier demand&eacute;e');

define('_MI_wmpdownloadS_GLOBAL_FILEBROKEN_NOTIFY', 'Fichier Bris&eacute; Propos&eacute;');
define('_MI_wmpdownloadS_GLOBAL_FILEBROKEN_NOTIFYCAP', 'Notifiez-moi pour chaque rapport de fichier bris&eacute;.');
define('_MI_wmpdownloadS_GLOBAL_FILEBROKEN_NOTIFYDSC', 'Recevoir une notification quand un rapport de fichier bris&eacute; est propos&eacute;e.');
define('_MI_wmpdownloadS_GLOBAL_FILEBROKEN_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} notification automatique : Fichier bris&eacute; rapport&eacute;');

define('_MI_wmpdownloadS_GLOBAL_FILESUBMIT_NOTIFY', 'Nouveau Fichier Propos&eacute;');
define('_MI_wmpdownloadS_GLOBAL_FILESUBMIT_NOTIFYCAP', "Notifiez-moi lorsqu'un nouveau fichier est propos&eacute; (attente d'&ecirc;tre approuv&eacute;).");
define('_MI_wmpdownloadS_GLOBAL_FILESUBMIT_NOTIFYDSC', "Recevoir une notification quand un nouveau fichier est propos&eacute; (attente d'&ecirc;tre approuv&eacute;).");
define('_MI_wmpdownloadS_GLOBAL_FILESUBMIT_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} notification automatique : Nouveau fichier propos&eacute;');

define('_MI_wmpdownloadS_GLOBAL_NEWFILE_NOTIFY', 'Nouveau Fichier');
define('_MI_wmpdownloadS_GLOBAL_NEWFILE_NOTIFYCAP', "Notifiez-moi lorsqu'un nouveau fichier est post&eacute;.");
define('_MI_wmpdownloadS_GLOBAL_NEWFILE_NOTIFYDSC', 'Recevoir une notification quand un nouveau fichier est post&eacute;.');
define('_MI_wmpdownloadS_GLOBAL_NEWFILE_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} notification automatique : Nouveau fichier');

define('_MI_wmpdownloadS_CATEGORY_FILESUBMIT_NOTIFY', 'Nouveau Fichier Propos&eacute;');
define('_MI_wmpdownloadS_CATEGORY_FILESUBMIT_NOTIFYCAP', "Notifiez-moi lorsqu'un nouveau fichier est propos&eacute; (attente d'&ecirc;tre approuv&eacute;) dans la cat&eacute;gorie actuelle.");
define('_MI_wmpdownloadS_CATEGORY_FILESUBMIT_NOTIFYDSC', "Recevoir une notification quand un nouveau fichier est propos&eacute; (attente d'&ecirc;tre approuv&eacute;) dans la cat&eacute;gorie actuelle.");
define('_MI_wmpdownloadS_CATEGORY_FILESUBMIT_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} notification automatique : Nouveau fichier propos&eacute; dans la cat&eacute;gorie');

define('_MI_wmpdownloadS_CATEGORY_NEWFILE_NOTIFY', 'Nouveau Fichier');
define('_MI_wmpdownloadS_CATEGORY_NEWFILE_NOTIFYCAP', "Notifiez-moi lorsqu'un nouveau fichier est post&eacute; dans la cat&eacute;gorie actuelle.");
define('_MI_wmpdownloadS_CATEGORY_NEWFILE_NOTIFYDSC', 'Recevoir une notification quand un nouveau fichier est post&eacute; dans la cat&eacute;gorie actuelle.');
define('_MI_wmpdownloadS_CATEGORY_NEWFILE_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} notification automatique : Nouveau fichier dans la cat&eacute;gorie');

define('_MI_wmpdownloadS_FILE_APPROVE_NOTIFY', 'Fichier Approuv&eacute;');
define('_MI_wmpdownloadS_FILE_APPROVE_NOTIFYCAP', 'Notifiez-moi lorsque ce fichier est approuv&eacute;.');
define('_MI_wmpdownloadS_FILE_APPROVE_NOTIFYDSC', 'Recevoir une notification quand ce fichier est approuv&eacute;.');
define('_MI_wmpdownloadS_FILE_APPROVE_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} notification automatique : Fichier approuv&eacute;');
