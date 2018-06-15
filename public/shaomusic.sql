/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : shaomusic

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2018-06-15 16:55:22
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `s_admin`
-- ----------------------------
DROP TABLE IF EXISTS `s_admin`;
CREATE TABLE `s_admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '系统用户id',
  `admin_name` varchar(255) DEFAULT NULL COMMENT '系统用户名',
  `admin_pwd` varchar(255) DEFAULT NULL COMMENT '系统用户密码',
  `admin_loginip` varchar(255) DEFAULT NULL COMMENT '系统用户登录ip',
  `admin_loginnum` int(11) DEFAULT '0' COMMENT '登录次数',
  `admin_logintime` datetime DEFAULT NULL COMMENT '登录时间',
  `admin_islock` int(11) DEFAULT '0' COMMENT '是否锁定(0 否 1 是)',
  `admin_catetime` datetime DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of s_admin
-- ----------------------------
INSERT INTO `s_admin` VALUES ('1', 'admin', '123', null, '23', '2018-06-15 16:40:28', '0', null);
INSERT INTO `s_admin` VALUES ('2', 'root', 'root', null, '3', '2018-04-08 14:23:34', '1', null);

-- ----------------------------
-- Table structure for `s_admin_role`
-- ----------------------------
DROP TABLE IF EXISTS `s_admin_role`;
CREATE TABLE `s_admin_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) DEFAULT NULL COMMENT '系统用户id',
  `role_id` int(11) DEFAULT NULL COMMENT '角色id',
  `is_default` int(11) DEFAULT '0' COMMENT '是否是默认的角色 ( 0 否 ， 1是)',
  PRIMARY KEY (`id`),
  KEY `s_admin_role_ibfk_1` (`admin_id`),
  KEY `s_admin_role_ibfk_2` (`role_id`),
  CONSTRAINT `s_admin_role_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `s_admin` (`admin_id`) ON DELETE CASCADE,
  CONSTRAINT `s_admin_role_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `s_role` (`role_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of s_admin_role
-- ----------------------------
INSERT INTO `s_admin_role` VALUES ('1', '1', '1', '0');
INSERT INTO `s_admin_role` VALUES ('2', '1', '3', '1');
INSERT INTO `s_admin_role` VALUES ('5', '2', '4', '0');

-- ----------------------------
-- Table structure for `s_class`
-- ----------------------------
DROP TABLE IF EXISTS `s_class`;
CREATE TABLE `s_class` (
  `class_id` int(11) NOT NULL AUTO_INCREMENT,
  `class_name` varchar(255) DEFAULT NULL COMMENT '名称',
  `class_hide` int(11) DEFAULT '0' COMMENT '是否隐藏（0 否 1 隐藏）',
  `class_order` int(11) DEFAULT '0' COMMENT '排序',
  `class_type` int(11) DEFAULT NULL COMMENT '栏目类型（1 音乐栏目 2 歌手栏目 3专辑栏目）',
  PRIMARY KEY (`class_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of s_class
-- ----------------------------
INSERT INTO `s_class` VALUES ('5', '华语歌手', '0', '0', '2');
INSERT INTO `s_class` VALUES ('6', '欧美歌手', '0', '0', '2');
INSERT INTO `s_class` VALUES ('7', '日本歌手', '0', '0', '2');
INSERT INTO `s_class` VALUES ('8', '华语专辑', '0', '0', '3');
INSERT INTO `s_class` VALUES ('9', '欧美专辑', '0', '0', '3');
INSERT INTO `s_class` VALUES ('10', '日韩专辑', '0', '0', '3');
INSERT INTO `s_class` VALUES ('11', '网络流行', '0', '0', '1');
INSERT INTO `s_class` VALUES ('12', 'abc歌手', '0', '0', '2');
INSERT INTO `s_class` VALUES ('13', '经典怀旧', '0', '0', '1');
INSERT INTO `s_class` VALUES ('14', '电子摇滚', '0', '0', '1');
INSERT INTO `s_class` VALUES ('15', '原唱翻唱', '0', '0', '1');

-- ----------------------------
-- Table structure for `s_collect_music`
-- ----------------------------
DROP TABLE IF EXISTS `s_collect_music`;
CREATE TABLE `s_collect_music` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL COMMENT '用户id',
  `music_id` int(11) DEFAULT NULL COMMENT ' 歌曲id',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `music_id` (`music_id`),
  CONSTRAINT `s_collect_music_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `s_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `s_collect_music_ibfk_2` FOREIGN KEY (`music_id`) REFERENCES `s_music` (`music_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of s_collect_music
-- ----------------------------

-- ----------------------------
-- Table structure for `s_collect_songlist`
-- ----------------------------
DROP TABLE IF EXISTS `s_collect_songlist`;
CREATE TABLE `s_collect_songlist` (
  `id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) DEFAULT NULL COMMENT '用户id',
  `list_id` int(11) DEFAULT NULL COMMENT '歌单id',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `list_id` (`list_id`),
  CONSTRAINT `s_collect_songlist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `s_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `s_collect_songlist_ibfk_2` FOREIGN KEY (`list_id`) REFERENCES `s_songlist` (`list_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of s_collect_songlist
-- ----------------------------

-- ----------------------------
-- Table structure for `s_menu`
-- ----------------------------
DROP TABLE IF EXISTS `s_menu`;
CREATE TABLE `s_menu` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '菜单id',
  `menu_name` varchar(255) NOT NULL COMMENT '菜单名称',
  `menu_url` varchar(255) DEFAULT NULL COMMENT '菜单链接',
  `menu_pid` int(11) NOT NULL DEFAULT '0' COMMENT '上级菜单',
  `menu_icon` varchar(255) DEFAULT NULL COMMENT '菜单图标',
  `menu_rank` int(11) DEFAULT NULL COMMENT '层级',
  `menu_order` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of s_menu
-- ----------------------------
INSERT INTO `s_menu` VALUES ('1', '系统管理', '', '0', '<i class=\"fa fa-desktop\"></i>', null, '0');
INSERT INTO `s_menu` VALUES ('2', '系统用户', 'admin/SysControl', '1', '', null, '0');
INSERT INTO `s_menu` VALUES ('5', '用户角色', 'admin/SysControl/sys_role', '1', '', null, '0');
INSERT INTO `s_menu` VALUES ('8', '用户管理', '', '0', '<i class=\"fa fa-user\" aria-hidden=\"true\"></i>', null, '0');
INSERT INTO `s_menu` VALUES ('11', '系统菜单', 'admin/SysControl/sys_menu', '1', '', null, '0');
INSERT INTO `s_menu` VALUES ('12', '用户', 'admin/User/index', '8', '', null, '0');
INSERT INTO `s_menu` VALUES ('13', '评论', '', '8', '', null, '0');
INSERT INTO `s_menu` VALUES ('14', '说说', '', '8', '', null, '0');
INSERT INTO `s_menu` VALUES ('15', '留言', '', '8', '', null, '0');
INSERT INTO `s_menu` VALUES ('16', '日志', '', '8', '', null, '0');
INSERT INTO `s_menu` VALUES ('17', '照片', '', '8', '', null, '0');
INSERT INTO `s_menu` VALUES ('18', '内容管理', '', '0', '<i class=\"fa fa-book\"></i>', null, '0');
INSERT INTO `s_menu` VALUES ('19', '栏目', 'admin/Content/classed', '18', '', null, '0');
INSERT INTO `s_menu` VALUES ('20', '音乐', 'admin/Content/music', '18', '', null, '0');
INSERT INTO `s_menu` VALUES ('21', '专辑', 'admin/Content/special', '18', '', null, '0');
INSERT INTO `s_menu` VALUES ('22', '歌手', 'admin/Content/singer', '18', '', null, '0');
INSERT INTO `s_menu` VALUES ('23', '标签', 'admin/Content/tag', '18', '', null, '0');
INSERT INTO `s_menu` VALUES ('24', '网页管理', '', '0', '<i class=\"fa fa-html5\" aria-hidden=\"true\"></i>', null, '0');
INSERT INTO `s_menu` VALUES ('25', '歌单', '', '24', '', null, '0');

-- ----------------------------
-- Table structure for `s_music`
-- ----------------------------
DROP TABLE IF EXISTS `s_music`;
CREATE TABLE `s_music` (
  `music_id` int(11) NOT NULL AUTO_INCREMENT,
  `music_name` varchar(255) DEFAULT NULL COMMENT '名称',
  `music_classid` int(11) DEFAULT '0' COMMENT '所属栏目id',
  `music_specialid` int(11) DEFAULT '0' COMMENT '所属专辑id',
  `music_singerid` int(11) DEFAULT '0' COMMENT '所属歌手id',
  `music_audio` varchar(255) DEFAULT NULL COMMENT '音频文件',
  `music_lyric` varchar(255) DEFAULT NULL COMMENT '歌词文件',
  `music_text` text COMMENT '文本歌词',
  `music_cover` varchar(255) DEFAULT NULL COMMENT '封面',
  `music_hits` int(11) DEFAULT '0' COMMENT '点击量(人气量)',
  `music_downhits` int(11) DEFAULT '0' COMMENT '下载量',
  `music_favhits` int(11) DEFAULT '0' COMMENT '收藏量',
  `music_goodhits` int(11) DEFAULT '0' COMMENT '好评量',
  `music_badhits` int(11) DEFAULT '0' COMMENT '差评量',
  `music_points` int(11) DEFAULT '0' COMMENT '下载扣点',
  `music_best` int(11) DEFAULT '0' COMMENT '推荐等级（0 到 5 级）',
  `music_tags` varchar(255) DEFAULT NULL COMMENT '标签(多个标签之间逗号隔开)',
  `music_addtime` datetime DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`music_id`),
  KEY `fk_s_music_s_singer_1` (`music_singerid`),
  KEY `fk_s_music_s_special_1` (`music_specialid`),
  KEY `fk_s_music_s_class_1` (`music_classid`),
  CONSTRAINT `fk_s_music_s_class_1` FOREIGN KEY (`music_classid`) REFERENCES `s_class` (`class_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of s_music
-- ----------------------------
INSERT INTO `s_music` VALUES ('1', '慢慢习惯', '11', '1', '1', './uploads/music/audio/8c7cd9c08f5999e2d3ffe9b0b7e6d0b8.mp3', './uploads/music/lyric/97e1fdf1a83e7221e05cf259b2ed955f.lrc', null, './uploads/music/cover/424473238575f2fd514198d624023602.jpg', '0', '0', '0', '0', '0', '0', '3', ' 爱尔兰（美）, 爱尔兰（德）,', '2018-04-03 23:44:52');
INSERT INTO `s_music` VALUES ('2', '华语群星-北京东路的日子', '11', '0', '0', './uploads/music/audio/16e6717a2ca1876f2169270857f0ba52.mp3', '', null, '', '0', '0', '0', '0', '0', '0', '2', '', '2018-04-04 00:28:18');
INSERT INTO `s_music` VALUES ('3', '怎么了', '11', '6', '2', './uploads/music/audio/dae9c32d2379c858b8755a62d611b39a.mp3', '', null, './uploads/music/cover/eaeb9aa6983623109f0d5d63da66c696.png', '0', '0', '0', '0', '0', '0', '5', ' 流行, 周杰伦,', '2018-04-08 17:28:22');
INSERT INTO `s_music` VALUES ('4', '算什么男人', '11', '6', '2', './uploads/music/audio/60a46fda6ee2aabd4bb08d0305db6882.mp3', '', null, './uploads/music/cover/a8ae5a5a7b306333fde6d7c0b4f819c1.png', '0', '0', '0', '0', '0', '0', '5', ' 周杰伦, 流行,', '2018-04-08 17:38:22');

-- ----------------------------
-- Table structure for `s_music_tag`
-- ----------------------------
DROP TABLE IF EXISTS `s_music_tag`;
CREATE TABLE `s_music_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `music_id` int(11) DEFAULT NULL COMMENT '音乐id',
  `tag_id` int(11) DEFAULT NULL COMMENT '标签id',
  PRIMARY KEY (`id`),
  KEY `fk_s_music_tag_s_music_1` (`music_id`),
  KEY `fk_s_music_tag_s_tag_1` (`tag_id`),
  CONSTRAINT `fk_s_music_tag_s_music_1` FOREIGN KEY (`music_id`) REFERENCES `s_music` (`music_id`) ON DELETE CASCADE,
  CONSTRAINT `fk_s_music_tag_s_tag_1` FOREIGN KEY (`tag_id`) REFERENCES `s_tag` (`tag_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of s_music_tag
-- ----------------------------

-- ----------------------------
-- Table structure for `s_role`
-- ----------------------------
DROP TABLE IF EXISTS `s_role`;
CREATE TABLE `s_role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '角色id',
  `role_name` varchar(255) DEFAULT NULL COMMENT '角色名称',
  `role_islock` int(11) DEFAULT '0' COMMENT '角色是否锁定(0 否 1 是)',
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of s_role
-- ----------------------------
INSERT INTO `s_role` VALUES ('1', '超级管理员', '0');
INSERT INTO `s_role` VALUES ('3', '超级管理员2', '0');
INSERT INTO `s_role` VALUES ('4', '用户管理员', '0');

-- ----------------------------
-- Table structure for `s_role_menu`
-- ----------------------------
DROP TABLE IF EXISTS `s_role_menu`;
CREATE TABLE `s_role_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL COMMENT '角色id',
  `menu_id` int(11) DEFAULT NULL COMMENT '菜单id',
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`),
  KEY `menu_id` (`menu_id`),
  CONSTRAINT `s_role_menu_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `s_role` (`role_id`) ON DELETE CASCADE,
  CONSTRAINT `s_role_menu_ibfk_2` FOREIGN KEY (`menu_id`) REFERENCES `s_menu` (`menu_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of s_role_menu
-- ----------------------------
INSERT INTO `s_role_menu` VALUES ('11', '3', '1');
INSERT INTO `s_role_menu` VALUES ('12', '3', '2');
INSERT INTO `s_role_menu` VALUES ('13', '3', '5');
INSERT INTO `s_role_menu` VALUES ('15', '3', '8');
INSERT INTO `s_role_menu` VALUES ('17', '4', '8');
INSERT INTO `s_role_menu` VALUES ('18', '3', '11');
INSERT INTO `s_role_menu` VALUES ('19', '3', '12');
INSERT INTO `s_role_menu` VALUES ('20', '4', '12');
INSERT INTO `s_role_menu` VALUES ('21', '4', '13');
INSERT INTO `s_role_menu` VALUES ('22', '4', '14');
INSERT INTO `s_role_menu` VALUES ('23', '4', '15');
INSERT INTO `s_role_menu` VALUES ('24', '4', '16');
INSERT INTO `s_role_menu` VALUES ('25', '4', '17');
INSERT INTO `s_role_menu` VALUES ('26', '3', '18');
INSERT INTO `s_role_menu` VALUES ('27', '3', '19');
INSERT INTO `s_role_menu` VALUES ('28', '3', '20');
INSERT INTO `s_role_menu` VALUES ('29', '3', '21');
INSERT INTO `s_role_menu` VALUES ('30', '3', '22');
INSERT INTO `s_role_menu` VALUES ('31', '3', '23');
INSERT INTO `s_role_menu` VALUES ('32', '3', '24');
INSERT INTO `s_role_menu` VALUES ('33', '3', '25');

-- ----------------------------
-- Table structure for `s_singer`
-- ----------------------------
DROP TABLE IF EXISTS `s_singer`;
CREATE TABLE `s_singer` (
  `singer_id` int(11) NOT NULL AUTO_INCREMENT,
  `singer_classid` int(11) DEFAULT '0' COMMENT '所属栏目id',
  `singer_name` varchar(255) DEFAULT NULL COMMENT '歌手名字',
  `singer_nick` varchar(255) DEFAULT NULL COMMENT '歌手艺名，昵称',
  `singer_nation` varchar(255) DEFAULT NULL COMMENT '国籍',
  `singer_occup` varchar(255) DEFAULT NULL COMMENT '职业',
  `singer_cover` varchar(255) DEFAULT NULL COMMENT '封面',
  `singer_intro` text COMMENT '介绍',
  `singer_hits` int(11) DEFAULT '0' COMMENT '点击量',
  `singer_addtime` datetime DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`singer_id`),
  KEY `fk_s_singer_s_class_1` (`singer_classid`),
  CONSTRAINT `fk_s_singer_s_class_1` FOREIGN KEY (`singer_classid`) REFERENCES `s_class` (`class_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of s_singer
-- ----------------------------
INSERT INTO `s_singer` VALUES ('1', '5', '刘德华', '华仔、Andy Lau', '中国', '演员、歌手、电影人', './uploads/singer/cover/5bb6002efc6970a63f53be30289cca56.png', '刘德华出生于香港新界，在家中排行老四，幼时随家人搬到了九龙钻石山的木屋区居住，并和姐弟一起帮助家里打理卖稀饭的生意 。1973年，刘德华随家人搬入香港蓝田邨第15座14楼  。刘德华从黄大仙天主教小学毕业后升读可立中学 。在可立中学读书期间，刘德华积极参加校内学校剧社的表演，在老师杜国威的指导下学习戏剧方面的知识。此外，他还参与包括编剧在内的幕后制作。刘德华在中五会考获得1B3D2E（中文读本A）的成绩。中六上学期后，他到香港电视广播有限公司的艺员训练班受训，从而开始了演艺之路 。', '0', '2018-03-31 21:17:38');
INSERT INTO `s_singer` VALUES ('2', '5', '周杰伦', 'Jay Chou', '中国', '音乐人、制作人、企业家', './uploads/singer/cover/58f176bbf40bb866152af22b10e3dff4.png', '周杰伦（Jay Chou），1979年1月18日出生于台湾省新北市，华语流行男歌手、演员、词曲创作人、MV及电影导演、编剧及制作人。2000年被吴宗宪发掘，发行首张个人专辑《Jay》。2001年发行专辑《范特西》。2002年在中国、新加坡、马来西亚、美国等地举办首场个人世界巡回演唱会。 2003年登上美国《时代周刊》亚洲版封面人物。 周杰伦的音乐融合中西方元素，风格多变，四次获得世界音乐大奖最畅销亚洲艺人。凭借专辑《Jay》、《范特西》、《叶惠美》及《跨时代》四次获得金曲奖\"最佳国语专辑\"奖，并凭借《魔杰座》、《跨时代》获得第20届和第22届金曲奖“最佳国语男歌手”奖；2014年获QQ音乐年度盛典“港台最受欢迎男歌手”及压轴大奖“最佳全能艺人”。 2005年开始涉足影视，以电影《头文字D》获第42届台湾电影金马奖及第25届香港电影金像奖“最佳新人”奖。 2006年起连续三年获得世界音乐大奖中国区最畅销艺人奖。 2007年自立门户，成立JVR（杰威尔）有限公司，自编自导自演的电影《不能说的秘密》获得第44届台湾电影金马奖“年度台湾杰出电影”奖。 2008年凭借歌曲《青花瓷》获得第19届金曲奖最佳作曲人奖。 2009年入选美国CNN亚洲极具影响力人物；同年凭借专辑《魔杰座》获得第20届金曲奖最佳国语男歌手奖。 2010年入选美国《Fast Company》评出的“全球百大创意人物”。 2011年凭借专辑《跨时代》再度获得金曲奖最佳国语男歌手奖，并且第4次获得金曲奖最佳国语专辑奖；同年主演好莱坞电影《青蜂侠》。 2012年登福布斯中国名人榜榜首。 2013年自编自导自演第二部电影《天台爱情》取得了不俗的票房与口碑。 2014年加盟好莱坞电影《惊天魔盗团2》；同年发行华语乐坛首张数字音乐专辑《哎呦，不错哦》。 娱乐圈外，周杰伦在2011年跨界担任华硕（ASUS）笔电外观设计师并入股香港文化传信集团。2012在中国内地开设真爱范特西连锁KTV。 除了力拼自己的事业，周杰伦还热心公益慈善活动，多次向内地灾区捐款并与众多艺人募款新建希望小学。 2015年担任《中国好声音 第四季》导师。 2016年发行演唱会专辑《周杰伦魔天伦世界巡回演唱会》；同年推出专辑《周杰伦的床边故事》。 2017年，确认加盟原创专业音乐节目《中国新歌声第二季》。', '0', '2018-03-31 22:41:49');

-- ----------------------------
-- Table structure for `s_songlist`
-- ----------------------------
DROP TABLE IF EXISTS `s_songlist`;
CREATE TABLE `s_songlist` (
  `list_id` int(11) NOT NULL AUTO_INCREMENT,
  `list_title` varchar(255) DEFAULT NULL COMMENT '标题',
  `list_intro` text COMMENT '介绍（详情）',
  `list_cover` varchar(255) DEFAULT NULL COMMENT '封面',
  `list_userid` int(11) DEFAULT NULL COMMENT '用户id',
  `list_hits` int(11) DEFAULT '0' COMMENT '点击量',
  `list_ispublic` int(11) DEFAULT '0' COMMENT '是否公开（0 否 ， 1 是）',
  `list_catetime` datetime DEFAULT NULL COMMENT '创建时间',
  `list_uptime` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`list_id`),
  KEY `list_userid` (`list_userid`),
  CONSTRAINT `s_songlist_ibfk_1` FOREIGN KEY (`list_userid`) REFERENCES `s_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of s_songlist
-- ----------------------------
INSERT INTO `s_songlist` VALUES ('1', '新建歌单', null, null, '1', '0', '0', '2018-05-31 19:36:56', null);

-- ----------------------------
-- Table structure for `s_songlist_music`
-- ----------------------------
DROP TABLE IF EXISTS `s_songlist_music`;
CREATE TABLE `s_songlist_music` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `list_id` int(11) DEFAULT NULL COMMENT '歌单id',
  `music_id` int(11) DEFAULT NULL COMMENT '歌曲id',
  PRIMARY KEY (`id`),
  KEY `music_id` (`music_id`),
  KEY `list_id` (`list_id`),
  CONSTRAINT `s_songlist_music_ibfk_2` FOREIGN KEY (`music_id`) REFERENCES `s_music` (`music_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `s_songlist_music_ibfk_3` FOREIGN KEY (`list_id`) REFERENCES `s_songlist` (`list_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of s_songlist_music
-- ----------------------------

-- ----------------------------
-- Table structure for `s_special`
-- ----------------------------
DROP TABLE IF EXISTS `s_special`;
CREATE TABLE `s_special` (
  `special_id` int(11) NOT NULL AUTO_INCREMENT,
  `special_classid` int(11) DEFAULT '0' COMMENT '所属栏目id',
  `special_singerid` int(11) DEFAULT '0' COMMENT '所属歌手id',
  `special_name` varchar(255) DEFAULT NULL COMMENT '名称',
  `special_cover` varchar(255) DEFAULT NULL COMMENT '封面',
  `special_intro` text COMMENT '介绍',
  `special_firm` varchar(255) DEFAULT NULL COMMENT '公司',
  `special_lang` varchar(255) DEFAULT NULL COMMENT '语言',
  `special_hits` int(11) DEFAULT '0' COMMENT '点击量',
  `special_addtime` datetime DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`special_id`),
  KEY `fk_s_special_s_singer_1` (`special_singerid`),
  KEY `fk_s_special_s_class_1` (`special_classid`),
  CONSTRAINT `fk_s_special_s_class_1` FOREIGN KEY (`special_classid`) REFERENCES `s_class` (`class_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of s_special
-- ----------------------------
INSERT INTO `s_special` VALUES ('1', '8', '1', '慢慢习惯', './uploads/special/cover/6b82393c5133ec3ec0f9d80fe38701e0.jpg', '《拆弹专家》4/28重磅献映 倾力打造最强城市反恐警匪大片 天王刘德华深情献唱主题曲《慢慢习惯》 因伤未录粤语“欠大家一首歌” 由博纳影业集团有限公司、寰宇娱乐有限公司、梦造者娱乐有限公司出品，邱礼涛导演执导，刘德华监制并主演的警匪动作巨制《拆弹专家》将于4月28日领衔五一档火爆上映！主题曲《慢慢习惯》今日正式发布，整首歌曲曲调舒缓平滑，在刘德华的深情吟唱下，将一个孤胆英雄的责任和孤独以内心独白的方式娓娓道来，感人至深，与之前影片露出的激烈宏大的动作场面形成鲜明对比，动静结合大片气质陡然而生。 《慢慢习惯》由刘德华亲自填词献唱，以一位孤单英雄的内心独白为视角，讲述了孤独的拆弹专家需要为了大义而不得不让自己时刻保持孤身一人，有爱不能爱，有情不能讲的侠骨柔肠。其中多次反复出现“慢慢习惯一人睡”“慢慢习惯一个人”仿佛让人们看到了一头英勇守护家园的雄狮在深夜慢慢舔舐自己的伤口，陪伴他的只有月光和孤独的凉风，但他依旧不能退却，依旧需要做那个最危险的英雄。不少歌迷都为华仔的低声吟唱而泪目，更加理解了身为一个拆弹专家的深刻意义。 此外，前奏的引爆器倒数更增加了戏剧般的想象力，不但叙述主角因为工作上的危险，不愿让爱人受到牵连而不得不割舍爱情，更深切表达了分享、守护、理解、奉献、互相承担等人间大爱的极致爱意，引人深思、发人深省。 据悉，因为受伤缘故，虽然刘德华已写好粤语歌词，但未能来得及再录一首粤语的版本给广大听众。因此这首《慢慢习惯》全球此次仅发行这单一版本，十分珍贵。不少资深歌迷表示“理解华仔，虽然今年演唱会没有了，但能听到这首新歌还是很满足”，而刘德华则表示非常遗憾“欠了大家一首歌”。 《拆弹专家》由博纳影业集团有限公司、寰宇娱乐有限公司、梦造者娱乐有限公司出品，小米影业、上海腾讯企鹅影视文化传播有限公司、广东昇格传媒有限公司、广州市英明文化传播有限公司、上海淘票票影视文化有限公司联合出品，制作费超过1.8亿港币。监制/主演刘德华的公司“梦造者”全程制作，电影《拆弹专家》作为2017最强城市反恐警匪大片，将于4月28日全国火爆上映。', '香港映艺2', '国语', '0', '2018-04-03 11:03:15');
INSERT INTO `s_special` VALUES ('2', '8', '1', '练习', './uploads/special/cover/483b1e9733c51787a2326a053c17bc46.png', '', 'EMI百代唱片', '粤语', '0', '2018-04-03 12:55:56');
INSERT INTO `s_special` VALUES ('3', '8', '2', '等你下课', './uploads/special/cover/b687fabcb162d758981e8686f9cd338d.png', '文青疗愈系暗恋情歌「等你下课」\r\n努力考上跟你喜欢的人一样的学校\r\n顺理成章「等你下课」！', '杰威尔音乐有限公司', '国语', '0', '2018-04-03 12:57:57');
INSERT INTO `s_special` VALUES ('6', '8', '2', '哎呦，不错哦', './uploads/special/cover/56e08da69fa35222f1fe64abe11d548a.png', '年度特大号期待！\r\n很Jay的一张专辑\r\n周杰伦 Jay Chou 哎呦，不错哦\r\nJAY语录里最被流传模仿的一句 最周杰伦的一张创作', '杰威尔音乐有限公司', '国语', '0', '2018-04-08 17:17:43');

-- ----------------------------
-- Table structure for `s_tag`
-- ----------------------------
DROP TABLE IF EXISTS `s_tag`;
CREATE TABLE `s_tag` (
  `tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(255) DEFAULT NULL COMMENT '标签名',
  `tag_type` int(11) DEFAULT NULL COMMENT '标签类型（1地域 2曲风 3心情 4歌手 5语言）',
  PRIMARY KEY (`tag_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of s_tag
-- ----------------------------
INSERT INTO `s_tag` VALUES ('1', '香港', '1');
INSERT INTO `s_tag` VALUES ('2', '内地', '1');
INSERT INTO `s_tag` VALUES ('3', '周杰伦', '4');
INSERT INTO `s_tag` VALUES ('4', '刘德华', '4');
INSERT INTO `s_tag` VALUES ('5', '日本', '1');
INSERT INTO `s_tag` VALUES ('6', '韩国', '1');
INSERT INTO `s_tag` VALUES ('7', '美国', '1');
INSERT INTO `s_tag` VALUES ('8', '英国', '1');
INSERT INTO `s_tag` VALUES ('9', '法国', '1');
INSERT INTO `s_tag` VALUES ('10', '印度', '1');
INSERT INTO `s_tag` VALUES ('11', '巴西', '1');
INSERT INTO `s_tag` VALUES ('12', '民谣', '2');
INSERT INTO `s_tag` VALUES ('13', '流行', '2');
INSERT INTO `s_tag` VALUES ('14', '摇滚', '2');
INSERT INTO `s_tag` VALUES ('15', '电影原生', '2');
INSERT INTO `s_tag` VALUES ('16', 'R&B', '2');
INSERT INTO `s_tag` VALUES ('17', '乡村', '2');
INSERT INTO `s_tag` VALUES ('18', '爱情', '3');
INSERT INTO `s_tag` VALUES ('19', '寂寞', '3');
INSERT INTO `s_tag` VALUES ('20', '想哭', '3');
INSERT INTO `s_tag` VALUES ('21', '怀念', '3');
INSERT INTO `s_tag` VALUES ('22', '忧伤', '3');
INSERT INTO `s_tag` VALUES ('23', '欢乐', '3');
INSERT INTO `s_tag` VALUES ('24', '唯美', '3');
INSERT INTO `s_tag` VALUES ('25', '温暖', '3');
INSERT INTO `s_tag` VALUES ('26', '燃', '3');
INSERT INTO `s_tag` VALUES ('27', '陈奕迅', '4');
INSERT INTO `s_tag` VALUES ('28', '李宇春', '4');
INSERT INTO `s_tag` VALUES ('29', '林俊杰', '4');
INSERT INTO `s_tag` VALUES ('30', '张学友', '4');
INSERT INTO `s_tag` VALUES ('31', '华语', '5');
INSERT INTO `s_tag` VALUES ('32', '粤语', '5');
INSERT INTO `s_tag` VALUES ('33', '闽南语', '5');

-- ----------------------------
-- Table structure for `s_user`
-- ----------------------------
DROP TABLE IF EXISTS `s_user`;
CREATE TABLE `s_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `user_name` varchar(255) DEFAULT NULL COMMENT '用户名',
  `user_nick` varchar(255) DEFAULT NULL COMMENT '用户昵称',
  `user_pwd` varchar(255) DEFAULT NULL COMMENT ' 密码',
  `user_cover` varchar(255) DEFAULT NULL COMMENT '封面，头像',
  `user_mail` varchar(255) DEFAULT NULL COMMENT '邮箱',
  `user_sex` int(11) DEFAULT '0' COMMENT '性别( 0 未知 1 男 2 女)',
  `user_birthday` varchar(255) DEFAULT NULL COMMENT '生日',
  `user_address` varchar(255) DEFAULT NULL COMMENT '地址',
  `user_introduce` varchar(255) DEFAULT NULL COMMENT '个人介绍',
  `user_regdate` datetime DEFAULT NULL COMMENT '注册日期',
  `user_loginip` varchar(255) DEFAULT NULL COMMENT '登录ip',
  `user_logintime` datetime DEFAULT NULL COMMENT '登录时间',
  `user_islock` int(11) DEFAULT '0' COMMENT '是否锁定（0 否 1是）',
  `user_isstar` int(11) DEFAULT '0' COMMENT '明星认证（0 无 1 是 2 待审）',
  `user_hits` int(11) DEFAULT '0' COMMENT '点击量',
  `user_gold` int(11) DEFAULT '0' COMMENT '金币',
  `user_rank` int(11) DEFAULT '0' COMMENT '经验',
  `user_grade` int(11) DEFAULT '0' COMMENT '等级 （0 普通用户 ）',
  `user_vipgrade` int(11) DEFAULT '0',
  `user_vipindate` datetime DEFAULT NULL,
  `user_vipenddate` datetime DEFAULT NULL,
  `user_ucid` int(11) DEFAULT '0',
  `user_qqopen` varchar(255) DEFAULT NULL,
  `user_qqimg` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of s_user
-- ----------------------------
INSERT INTO `s_user` VALUES ('1', '2010', '程序员', '123456', null, null, '0', null, null, null, null, null, null, '0', '0', '0', '0', '0', '0', '0', null, null, '0', null, null);

-- ----------------------------
-- Function structure for `GET_FIRST_PY`
-- ----------------------------
DROP FUNCTION IF EXISTS `GET_FIRST_PY`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `GET_FIRST_PY`(PARAM VARCHAR(255)) RETURNS varchar(2) CHARSET utf8
BEGIN  
    DECLARE V_RETURN VARCHAR(255);  
    DECLARE V_FIRST_CHAR VARCHAR(2);  
    SET V_FIRST_CHAR = UPPER(LEFT(PARAM,1));  
    SET V_RETURN = V_FIRST_CHAR;  
    IF LENGTH( V_FIRST_CHAR) <> CHARACTER_LENGTH( V_FIRST_CHAR ) THEN  
    SET V_RETURN = ELT(INTERVAL(CONV(HEX(LEFT(CONVERT(PARAM USING gbk),1)),16,10),  
        0xB0A1,0xB0C5,0xB2C1,0xB4EE,0xB6EA,0xB7A2,0xB8C1,0xB9FE,0xBBF7,  
        0xBFA6,0xC0AC,0xC2E8,0xC4C3,0xC5B6,0xC5BE,0xC6DA,0xC8BB,  
        0xC8F6,0xCBFA,0xCDDA,0xCEF4,0xD1B9,0xD4D1),  
    'A','B','C','D','E','F','G','H','J','K','L','M','N','O','P','Q','R','S','T','W','X','Y','Z');  
    END IF;  
    RETURN V_RETURN;  
END
;;
DELIMITER ;

-- ----------------------------
-- Function structure for `hello_world`
-- ----------------------------
DROP FUNCTION IF EXISTS `hello_world`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `hello_world`() RETURNS text CHARSET utf8
BEGIN
  RETURN 'Hello World';
END
;;
DELIMITER ;
