# phpMyAdmin MySQL-Dump
# version 2.3.1
# http://www.phpmyadmin.net/ (download page)
#
# 主机: localhost
# 建立日期: Apr 23, 2003 at 12:43 AM
# 伺服机Version3.23.55
# PHP Version4.2.2
# 数据库 : `xoops2`
# --------------------------------------------------------

#
# 数据表的结构 `xoops_wmpdownloads_cat`
#

CREATE TABLE xoops_wmpdownloads_cat (
    cid    INT(5) UNSIGNED NOT NULL AUTO_INCREMENT,
    pid    INT(5) UNSIGNED NOT NULL DEFAULT '0',
    title  VARCHAR(50)     NOT NULL DEFAULT '',
    imgurl VARCHAR(150)    NOT NULL DEFAULT '',
    PRIMARY KEY (cid),
    KEY pid (pid)
)
    ENGINE = ISAM;

#
# 导出下面的数据库内容 `xoops_wmpdownloads_cat`
#

INSERT INTO xoops_wmpdownloads_cat
VALUES (1, 0, '初一', 'http://');
INSERT INTO xoops_wmpdownloads_cat
VALUES (2, 0, '初二', 'http://');
INSERT INTO xoops_wmpdownloads_cat
VALUES (3, 0, '初三', 'http://');
INSERT INTO xoops_wmpdownloads_cat
VALUES (4, 0, '高一', 'http://');
INSERT INTO xoops_wmpdownloads_cat
VALUES (5, 0, '高二', 'http://');
INSERT INTO xoops_wmpdownloads_cat
VALUES (6, 0, '高三', 'http://');
INSERT INTO xoops_wmpdownloads_cat
VALUES (7, 1, '英语', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (8, 2, '英语', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (9, 3, '英语', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (10, 4, '英语', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (11, 5, '英语', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (12, 6, '英语', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (13, 1, '语文', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (14, 2, '语文', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (15, 3, '语文', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (16, 4, '语文', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (17, 5, '语文', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (18, 6, '语文', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (19, 7, 'Unit1 Hello! What\'s your name?', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (20, 7, 'Unit2 Nice to meet you!', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (21, 7, 'Unit3 Can you spell it?', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (22, 7, 'Unit4 Numbers in English', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (23, 7, 'Unit5 What\'s this in English?', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (24, 7, 'Unit6 How old is he?', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (25, 7, 'Unit7 Is this your pencil-box?', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (26, 7, 'Unit8 Mainly revision', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (27, 7, 'Unit9 The new students', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (28, 7, 'Unit10 Where is it?', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (29, 7, 'Unit11 Come and meet the family!', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (30, 7, 'Unit12 What can you see?', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (31, 7, 'Unit13 What colour is it?', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (32, 7, 'Unit14 That\'s mine!', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (33, 7, 'Unit15 What\'s the time?', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (34, 7, 'Unit16 Mainly revision', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (35, 7, 'Unit17  Could you help me, please?', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (36, 7, 'Unit18  Put them away, please!', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (37, 7, 'Unit19  Food and drink', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (38, 7, 'Unit20  What’s your favourite sport?', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (39, 7, 'Unit21  What are you doing?', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (40, 7, 'Unit22  Do you have an eraser?', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (41, 7, 'Unit23  Mainly revision', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (42, 7, 'Unit24  Where are you from?', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (43, 7, 'Unit25  What do you like?', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (44, 7, 'Unit26  People and work', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (45, 7, 'Unit27  What time do you get up?', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (46, 7, 'Unit28  How do you come to school?', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (47, 7, 'Unit29  Shopping', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (48, 7, 'Unit30  Mainly revision', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (49, 8, 'Unit1  Welcome back!', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (50, 8, 'Unit2  How do you come to school?', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (51, 8, 'Unit3  Mid-Autumn Day', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (52, 8, 'Unit4  We\'re going to working on a farm!', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (53, 8, 'Unit5  Working hard on the farm', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (54, 8, 'Unit6  Shall we go to the park?', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (55, 8, 'Unit7  Mainly revision', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (56, 8, 'Unit8   Where do you sit?', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (57, 8, 'Unit9   Find the right place!', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (58, 8, 'Unit10  Home and work', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (59, 8, 'Unit11  Keep healthy', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (60, 8, 'Unit12  Which is your favourite?', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (61, 8, 'Unit13  Where were you born?', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (62, 8, 'Unit14  Mainly revision', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (63, 8, 'Unit15  What do people eat?', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (64, 8, 'Unit16  what a good,king girl!', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (65, 8, 'Unit17  You must be more careful!', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (66, 8, 'Unit18  Seeing the doctor', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (67, 8, 'Unit19  A visit to an island', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (68, 8, 'Unit20  Mainly revision', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (69, 8, 'Unit21  She taught herself', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (70, 8, 'Unit22  The sports meeting', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (71, 8, 'Unit23  A famous person', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (72, 8, 'Unit24  What were they doing?', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (73, 8, 'Unit25  The accident', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (74, 8, 'Unit26  Mainiy  revision', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (75, 9, 'Unit1  Teachers\'Day', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (76, 9, 'Unit2  The sports', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (77, 9, 'Unit3  A good teacher', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (78, 9, 'Unit4  What were they doing?', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (79, 9, 'Unit5  The accident', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (80, 9, 'Unit6  In the library', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (81, 9, 'Unit7  Mainly revision', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (82, 9, 'Unit8  On the farm', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (83, 9, 'Unit9  A visit to a factory', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (84, 9, 'Unit10  Mr Green\'s problem', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (85, 9, 'Unit11  A great inventor', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (86, 9, 'Unit12  Have a good time,Jim!', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (87, 9, 'Unit13  Merry Christmas!', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (88, 9, 'Unit14  Mainly revision', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (89, 9, 'Unit15  At home with the twins', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (90, 9, 'Unit16  What\'s it made of?', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (91, 9, 'Unit17  What was it used for?', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (92, 9, 'Unit18  Planting trees', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (93, 9, 'Unit19  Mainly revision', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (94, 9, 'Unit20  The world\'s population', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (95, 9, 'Unit21  Shopping', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (96, 9, 'Unit22  At the doctor\'s', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (97, 9, 'Unit23  The football match', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (98, 9, 'Unit24  Mainly revision', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (99, 10, 'Unit1 The summer holidays', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (100, 10, 'Unit3 American English', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (101, 10, 'Unit4 Travel', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (102, 10, 'Unit5 Why do you do that?', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (103, 10, 'Unit6 A new factory', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (104, 10, 'Unit7 Earthquakes', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (105, 10, 'Unit8 Mainly revision', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (106, 10, 'Unit9 Computers', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (107, 10, 'Unit10 Sports', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (108, 10, 'Unit11 Country music', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (109, 10, 'Unit12 English programmes', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (110, 10, 'Unit13 Abraham Linconln', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (111, 10, 'Unit14 Mainly revision', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (112, 10, 'Unit15 Healthy eating', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (113, 10, 'Unit16 Fire!', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (114, 10, 'Unit17 Nature', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (115, 10, 'Unit18 The necklace', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (116, 10, 'Unit19 Jobs', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (117, 10, 'Unit20 Mainly revision', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (118, 10, 'Unit21 Karl Marx', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (119, 10, 'Unit22 Britain and lreland', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (120, 10, 'Unit23 Rescuing the temple', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (121, 10, 'Unit24 The science of farming', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (122, 10, 'Unit25 At the conference', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (123, 10, 'Unit26 Mainly revision', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (124, 11, 'Unit1 Disneyland', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (125, 11, 'Unit2 No smoking,please!', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (126, 11, 'Unit3 Body language', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (127, 11, 'Unit4 Newspapers', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (128, 11, 'Unit5 Charlie Chaplin', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (129, 11, 'Unit6 Mainly revision', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (130, 11, 'Unit7 Canada', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (131, 11, 'Unit8 First aid', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (132, 11, 'Unit9 Saving the earth', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (133, 11, 'Unit10 At the shop', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (134, 11, 'Unit11 Hurricane!', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (135, 11, 'Unit12 Mainly revision', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (136, 11, 'Unit13 Albert Einstein', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (137, 11, 'Unit14 Satellites', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (138, 11, 'Unit15 A famous detective', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (139, 11, 'Unit16 The sea', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (140, 11, 'Unit17 Life in the future', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (141, 11, 'Unit18 Mainly revision', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (142, 11, 'Unit19 A freedom fighter', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (143, 11, 'Unit20 Disability', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (144, 11, 'Unit21 Music', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (145, 11, 'Unit22 A tale of two cities', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (146, 11, 'Unit23 Telephones', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (147, 11, 'Unit24 Mainly revision', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (148, 12, 'Unit1 Madame Curie', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (149, 12, 'Unit2 Captain Cook', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (150, 12, 'Unit3 Australia', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (151, 12, 'Unit4 Feed the world', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (152, 12, 'Unit5 Advertising', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (153, 12, 'Unit6 Mainly revision', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (154, 12, 'Unit7 Angkor Wat', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (155, 12, 'Unit8 A person of great determination', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (156, 12, 'Unit9 Gymnastics', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (157, 12, 'Unit10 The trick', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (158, 12, 'Unit11 The Merchant of Venice', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (159, 12, 'Unit12 Mainly revision', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (160, 12, 'Unit13 The USA', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (161, 12, 'Unit14 Roots', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (162, 12, 'Unit15 Study skills', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (163, 12, 'Unit16 Social and personal', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (164, 12, 'Unit17 My teacher', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (165, 12, 'Unit18 office equipment', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (166, 12, 'Unit19 New Zealand', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (167, 12, 'Unit20 Gandhi', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (168, 12, 'Unit21 Who gets the money?', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (169, 12, 'Unit22 Bees', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (170, 12, 'Unit23 The find of the century', '');
INSERT INTO xoops_wmpdownloads_cat
VALUES (171, 12, 'Unit24 Finding a job', '');

