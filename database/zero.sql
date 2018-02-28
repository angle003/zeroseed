-- MySQL dump 10.13  Distrib 5.5.59, for linux-glibc2.12 (x86_64)
--
-- Host: localhost    Database: zeroseed
-- ------------------------------------------------------
-- Server version	5.5.59

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `blog`
--

DROP TABLE IF EXISTS `blog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog` (
  `blog_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '博客id',
  `blog_user_id` int(11) NOT NULL COMMENT '发表博客人id',
  `blog_cretime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '发表博客时间',
  `blog_content` text COMMENT '博客内容',
  `blog_title` varchar(40) NOT NULL COMMENT '博客标题',
  `blog_likes` int(11) DEFAULT '0' COMMENT '点赞数',
  PRIMARY KEY (`blog_id`),
  KEY `bloguser` (`blog_user_id`),
  CONSTRAINT `user_own` FOREIGN KEY (`blog_user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='博客表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog`
--

LOCK TABLES `blog` WRITE;
/*!40000 ALTER TABLE `blog` DISABLE KEYS */;
INSERT INTO `blog` VALUES (1,8,'2018-02-06 06:40:26','ä»Šå¤©æ˜¯ä¸ªå¥½æ—¥å­!','good days',666),(2,9,'2018-02-06 06:45:53','I  love live!','love!',141),(3,8,'2018-02-06 06:47:07','I which you  have a good days!I which you  have a good days!\r\nI which you  have a good days!\r\nI which you  have a good days!I which you  have a good days!I which you  have a good days!I which you  have a good days!','sweet which',138);
/*!40000 ALTER TABLE `blog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_comment`
--

DROP TABLE IF EXISTS `blog_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog_comment` (
  `blog_comment_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '博客评论id',
  `blog_id` int(11) DEFAULT '0' COMMENT '评论的博客id',
  `bolg_comment_uid` int(11) NOT NULL COMMENT '评论人',
  `blog_comment_cretime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '评论时间',
  `blog_comment_content` text NOT NULL COMMENT '评论内容',
  `blog_comment_likes` int(11) DEFAULT '0' COMMENT '评论点赞数',
  `blog_comment_reply` int(11) DEFAULT '0' COMMENT '回复id',
  `blog_comment_reUid` int(11) NOT NULL DEFAULT '0' COMMENT '回复人id',
  PRIMARY KEY (`blog_comment_id`),
  KEY `commenter` (`bolg_comment_uid`),
  KEY `blog_id` (`blog_id`),
  CONSTRAINT `commenter` FOREIGN KEY (`bolg_comment_uid`) REFERENCES `user` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='博客评论表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_comment`
--

LOCK TABLES `blog_comment` WRITE;
/*!40000 ALTER TABLE `blog_comment` DISABLE KEYS */;
INSERT INTO `blog_comment` VALUES (1,1,8,'2018-02-06 06:40:52','good!',88,0,0),(2,1,8,'2018-02-09 01:13:34','哈哈，挺好',56,0,0),(4,0,9,'2018-02-09 01:17:49','啦啦啦',67,2,8),(5,1,9,'2018-02-26 07:44:11','good!good!good!good!good!vgood!good!good!good!good!good!good!good!',30,0,0);
/*!40000 ALTER TABLE `blog_comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(32) NOT NULL,
  `user_password` varchar(64) NOT NULL,
  `user_cretime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `user_friends_id` int(11) DEFAULT NULL COMMENT '用户朋友表id',
  `user_level` int(11) DEFAULT '1' COMMENT '用户等级',
  PRIMARY KEY (`user_id`),
  KEY `user_friends_id` (`user_friends_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='用户表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (8,'1307122104','123456','2018-02-02 07:19:50',NULL,1),(9,'111','123','2018-02-06 06:41:30',NULL,1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_friends`
--

DROP TABLE IF EXISTS `user_friends`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_friends` (
  `user_friends_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户朋友表id',
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `user_friends_uid` int(11) NOT NULL COMMENT '朋友id',
  PRIMARY KEY (`user_friends_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `uid` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户朋友表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_friends`
--

LOCK TABLES `user_friends` WRITE;
/*!40000 ALTER TABLE `user_friends` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_friends` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_info`
--

DROP TABLE IF EXISTS `user_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_info` (
  `user_info_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户信息id',
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `user_info_nickname` varchar(30) DEFAULT 'zero',
  `user_sex` varchar(8) DEFAULT '男' COMMENT '用户性别',
  `user_age` varchar(8) DEFAULT '18' COMMENT '用户年龄',
  `user_mail` varchar(40) NOT NULL COMMENT '用户邮箱',
  `user_image_url` varchar(50) DEFAULT NULL COMMENT '用户头像',
  `user_introduce` text COMMENT '用户自我介绍',
  PRIMARY KEY (`user_info_id`),
  UNIQUE KEY `user_id` (`user_id`),
  CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='用户信息表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_info`
--

LOCK TABLES `user_info` WRITE;
/*!40000 ALTER TABLE `user_info` DISABLE KEYS */;
INSERT INTO `user_info` VALUES (1,8,'zero','男','18','1974728494@qq.com','images/img2.jpg',NULL),(2,9,'zero01','男','18','1974728494@qq.com','images/img1.jpg',NULL);
/*!40000 ALTER TABLE `user_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_message`
--

DROP TABLE IF EXISTS `user_message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_message` (
  `user_message_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户消息id',
  `user_message_uid` int(11) NOT NULL COMMENT '消息所属者id',
  `user_message_state` tinyint(1) NOT NULL DEFAULT '0' COMMENT '消息状态',
  `user_message_cretime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '消息时间',
  `user_message_content` varchar(30) NOT NULL COMMENT '消息内容',
  PRIMARY KEY (`user_message_id`),
  KEY `user_message_uid` (`user_message_uid`),
  CONSTRAINT `消息所有者` FOREIGN KEY (`user_message_uid`) REFERENCES `user` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户消息表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_message`
--

LOCK TABLES `user_message` WRITE;
/*!40000 ALTER TABLE `user_message` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_message` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-02-28 16:11:45
