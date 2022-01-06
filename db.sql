/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 10.2.31-MariaDB : Database - ticketr
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`ticketr` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `ticketr`;

/*Table structure for table `tickerr_bug_departments` */

DROP TABLE IF EXISTS `tickerr_bug_departments`;

CREATE TABLE `tickerr_bug_departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `agents` int(11) NOT NULL,
  `reports` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `default` int(1) NOT NULL DEFAULT 2,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tickerr_bug_departments` */

insert  into `tickerr_bug_departments`(`id`,`name`,`agents`,`reports`,`date`,`default`) values (1,'General',1,0,'2020-07-01 08:30:40',1);

/*Table structure for table `tickerr_bugs` */

DROP TABLE IF EXISTS `tickerr_bugs`;

CREATE TABLE `tickerr_bugs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `guest_name` varchar(150) NOT NULL,
  `guest_email` varchar(40) NOT NULL,
  `agentid` int(11) NOT NULL,
  `access` varchar(10) NOT NULL,
  `status` int(1) NOT NULL,
  `priority` int(1) NOT NULL,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_update` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `subject` text NOT NULL,
  `content` text NOT NULL,
  `files` text NOT NULL,
  `transferred_from` int(11) NOT NULL,
  `agent_msg` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tickerr_bugs` */

/*Table structure for table `tickerr_settings` */

DROP TABLE IF EXISTS `tickerr_settings`;

CREATE TABLE `tickerr_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(300) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=latin1;

/*Data for the table `tickerr_settings` */

insert  into `tickerr_settings`(`id`,`name`,`value`) values (1,'site_title','VZDyno - Support System'),(2,'confirm_purchase_codes','0'),(3,'confirm_purchase_codes_username',''),(4,'confirm_purchase_codes_api',''),(5,'allow_guest_bug_reports','1'),(6,'allow_guest_tickets','1'),(7,'allow_account_creations','1'),(8,'allow_guest_file_uploads','1'),(9,'allow_file_uploads','1'),(10,'file_uploads_max_size','2'),(11,'file_uploads_extensions','jpg|jpeg|png|gif|zip|pdf'),(12,'mailing','0'),(13,'mailer_method','1'),(14,'smtp_host',''),(15,'smtp_port',''),(16,'smtp_user',''),(17,'smtp_pass',''),(18,'smtp_timeout','5'),(19,'mailpath','/usr/bin/sendmail'),(20,'email_confirmation','0'),(21,'email_from_address',''),(22,'email_from_name',''),(23,'email_cc',''),(24,'send_email_ticket_guest_submitted','1'),(25,'email_ticket_guest_submitted_type','html'),(26,'email_ticket_guest_submitted_title','Ticket Submitted'),(27,'email_ticket_guest_submitted_content','Hi, <strong>%user_name%</strong>.<br /><br />We are just letting you know that your ticket titled \"%ticket_subject%\" has been successfully created.<br />To take a look at it, click <a href=\"%ticket_url%\">here</a>'),(28,'send_email_bug_guest_submitted','1'),(29,'email_bug_guest_submitted_type','html'),(30,'email_bug_guest_submitted_title','Bug Report Submitted'),(31,'email_bug_guest_submitted_content','Hi, <strong>%user_name%</strong>.<br /><br />We are just letting you know that your bug report titled \"%report_subject%\" has been successfully created.<br />To take a look at it, click <a href=\"%report_url%\">here</a>'),(32,'send_email_new_account','0'),(33,'email_new_account_type','html'),(34,'email_new_account_title','New account has been created!'),(35,'email_new_account_content','Hi, <strong>%user_name%</strong>.<br /><br />We are just letting you know that your new account has been created! To login, click <a href=\"%site_url%\">here</a>'),(36,'email_new_account_confirmation_type','html'),(37,'email_new_account_confirmation_title','Please confirm your new account'),(38,'email_new_account_confirmation_content','Hi, <strong>%user_name%</strong>.<br /><br />Your new account has been created! However, we need you to confirm this email address. To do so, click the following link: <a href=\"%confirmation_url%\">%confirmation_url%</a>'),(39,'send_email_confirmed_account','1'),(40,'email_confirmed_account_type','html'),(41,'email_confirmed_account_title','Your account has been confirmed'),(42,'email_confirmed_account_content','Hi, <strong>%user_name%</strong>.<br /><br />Your email address has been confirmed! Now you can use your account. To login, click <a href=\"%site_url%\">here</a>'),(43,'allow_account_recovery','1'),(44,'email_recover_type','html'),(45,'email_recover_title','Account recovery'),(46,'email_recover_content','Hi, <strong>%user_name%</strong>.<br /><br />Apparently you cannot remember your password, and you requested to change it. To do so, please click the following link to continue with the process:<br /><a href=\"%recovery_url%\">%recovery_url%</a>.<br /><br />If you didn\'t request this password change, just ignore this email.'),(47,'send_email_recovery_done','1'),(48,'email_recovery_done_type','html'),(49,'email_recovery_done_title','Your account has been recovered'),(50,'email_recovery_done_content','Hi, <strong>%user_name%</strong>.<br /><br />We are just letting you know that the password of your account has been successfully changed.'),(51,'send_email_new_reply','1'),(52,'email_new_reply_type','html'),(53,'email_new_reply_title','Your ticket has a new reply!'),(54,'email_new_reply_content','Hi, <strong>%user_name%</strong>.<br /><br />It seems that your Ticket titled \"%ticket_subject%\" has a new reply!. You can take a look at it by clicking <a href=\"%ticket_url%\">here</a>'),(55,'send_email_bug_new_status','1'),(56,'email_bug_new_status_type','html'),(57,'email_bug_new_status_title','Bug report updates!'),(58,'email_bug_new_status_content','Hi, <strong>%user_name%</strong>.<br /><br />It seems that your bug report titled \"%report_subject%\" has a new status!. You can take a look at it by clicking <a href=\"%report_url%\">here</a>'),(59,'send_agents_email_ticket_guest_submitted','1'),(60,'agents_email_ticket_guest_submitted_type','html'),(61,'agents_email_ticket_guest_submitted_title','Guest has submitted a new ticket'),(62,'agents_email_ticket_guest_submitted_content','Hi, <strong>%agent_user_name%</strong>.<br /><br />A guest has submitted a new ticket titled \"%ticket_subject%\" in the \"%ticket_department_name%\" department.<br />You can reply to it by clicking <a href=\"%ticket_url%\">here</a>'),(63,'send_agents_email_ticket_client_submitted','1'),(64,'agents_email_ticket_client_submitted_type','html'),(65,'agents_email_ticket_client_submitted_title','Client has submitted a new ticket'),(66,'agents_email_ticket_client_submitted_content','Hi, <strong>%agent_user_name%</strong>.<br /><br />%user_name% (%user_username%) has submitted a new ticket titled \"%ticket_subject%\" in the \"%ticket_department_name%\" department.<br />You can reply to it by clicking <a href=\"%ticket_url%\">here</a>'),(67,'send_agents_email_bug_guest_submitted','1'),(68,'agents_email_bug_guest_submitted_type','html'),(69,'agents_email_bug_guest_submitted_title','Guest has submitted a new bug report'),(70,'agents_email_bug_guest_submitted_content','Hi, <strong>%agent_user_name%</strong>.<br /><br />A guest has submitted a new bug report titled \"%report_subject%\" in the \"%report_department_name%\" department.<br />You can review it by clicking <a href=\"%ticket_url%\">here</a>'),(71,'send_agents_email_bug_client_submitted','1'),(72,'agents_email_bug_client_submitted_type','html'),(73,'agents_email_bug_client_submitted_title','Client has submitted a new bug report'),(74,'agents_email_bug_client_submitted_content','Hi, <strong>%agent_user_name%</strong>.<br /><br />%user_name% (%user_username%) has submitted a new bug report titled \"%report_subject%\" in the \"%report_department_name%\" department.<br />You can review it by clicking <a href=\"%ticket_url%\">here</a>'),(75,'send_agent_email_new_reply','1'),(76,'agent_email_new_reply_type','html'),(77,'agent_email_new_reply_title','Ticket has a new reply!'),(78,'agent_email_new_reply_content','Hi, <strong>%agent_user_name%</strong>.<br /><br />A ticket titled \"%ticket_subject%\" has a new reply. You can reply back by clicking <a href=\"%ticket_url%\">here</a>'),(79,'send_agents_email_ticket_guest_submitted','1'),(80,'agents_email_ticket_guest_submitted_type','html'),(81,'agents_email_ticket_guest_submitted_title','Guest has submitted a new ticket'),(82,'agents_email_ticket_guest_submitted_content','Hi, <strong>%agent_user_name%</strong>.<br /><br />A guest has submitted a new ticket titled \"%ticket_subject%\" in the \"%ticket_department_name%\" department.<br />You can reply to it by clicking <a href=\"%ticket_url%\">here</a>'),(83,'send_agents_email_ticket_client_submitted','1'),(84,'agents_email_ticket_client_submitted_type','html'),(85,'agents_email_ticket_client_submitted_title','Client has submitted a new ticket'),(86,'agents_email_ticket_client_submitted_content','Hi, <strong>%agent_user_name%</strong>.<br /><br />%user_name% (%user_username%) has submitted a new ticket titled \"%ticket_subject%\" in the \"%ticket_department_name%\" department.<br />You can reply to it by clicking <a href=\"%ticket_url%\">here</a>'),(87,'send_agents_email_bug_guest_submitted','1'),(88,'agents_email_bug_guest_submitted_type','html'),(89,'agents_email_bug_guest_submitted_title','Guest has submitted a new bug report'),(90,'agents_email_bug_guest_submitted_content','Hi, <strong>%agent_user_name%</strong>.<br /><br />A guest has submitted a new bug report titled \"%report_subject%\" in the \"%report_department_name%\" department.<br />You can review it by clicking <a href=\"%ticket_url%\">here</a>'),(91,'send_agents_email_bug_client_submitted','1'),(92,'agents_email_bug_client_submitted_type','html'),(93,'agents_email_bug_client_submitted_title','Client has submitted a new bug report'),(94,'agents_email_bug_client_submitted_content','Hi, <strong>%agent_user_name%</strong>.<br /><br />%user_name% (%user_username%) has submitted a new bug report titled \"%report_subject%\" in the \"%report_department_name%\" department.<br />You can review it by clicking <a href=\"%ticket_url%\">here</a>'),(95,'send_agent_email_new_reply','1'),(96,'agent_email_new_reply_type','html'),(97,'agent_email_new_reply_title','Ticket has a new reply!'),(98,'agent_email_new_reply_content','Hi, <strong>%agent_user_name%</strong>.<br /><br />A ticket titled \"%ticket_subject%\" has a new reply. You can reply back by clicking <a href=\"%ticket_url%\">here</a>');

/*Table structure for table `tickerr_ticket_departments` */

DROP TABLE IF EXISTS `tickerr_ticket_departments`;

CREATE TABLE `tickerr_ticket_departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `agents` int(11) NOT NULL,
  `tickets` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `default` int(1) NOT NULL DEFAULT 2,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tickerr_ticket_departments` */

insert  into `tickerr_ticket_departments`(`id`,`name`,`agents`,`tickets`,`date`,`default`) values (1,'General',1,1,'2020-07-01 08:30:40',1);

/*Table structure for table `tickerr_ticket_replies` */

DROP TABLE IF EXISTS `tickerr_ticket_replies`;

CREATE TABLE `tickerr_ticket_replies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ticketid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `agentid` int(11) NOT NULL,
  `content` text NOT NULL,
  `date` datetime NOT NULL,
  `files` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tickerr_ticket_replies` */

/*Table structure for table `tickerr_tickets` */

DROP TABLE IF EXISTS `tickerr_tickets`;

CREATE TABLE `tickerr_tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `guest_name` varchar(150) NOT NULL,
  `guest_email` varchar(40) NOT NULL,
  `agentid` int(11) NOT NULL,
  `access` varchar(10) NOT NULL,
  `status` int(1) NOT NULL,
  `priority` int(1) NOT NULL,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_update` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `subject` text NOT NULL,
  `content` text NOT NULL,
  `files` text NOT NULL,
  `transferred_from` int(11) NOT NULL,
  `rating` decimal(2,1) NOT NULL,
  `rating_msg` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tickerr_tickets` */

insert  into `tickerr_tickets`(`id`,`department`,`userid`,`guest_name`,`guest_email`,`agentid`,`access`,`status`,`priority`,`date`,`last_update`,`subject`,`content`,`files`,`transferred_from`,`rating`,`rating_msg`) values (1,1,3,'','',0,'PgkBSBfBQG',1,3,'2020-07-01 16:27:52','2020-07-01 16:27:52','test test test','testetest adasdasd asd as asdasd','mrGJLwhZT70IcTNKmdY0.png*image_2020_06_25T14_25_19_633Z.png',0,'0.0','');

/*Table structure for table `tickerr_users` */

DROP TABLE IF EXISTS `tickerr_users`;

CREATE TABLE `tickerr_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(40) NOT NULL,
  `profile_img1x` varchar(400) NOT NULL,
  `profile_img2x` varchar(400) NOT NULL,
  `profile_img3x` varchar(400) NOT NULL,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `password` char(32) NOT NULL,
  `role` int(1) NOT NULL,
  `ticket_departments` varchar(300) NOT NULL,
  `bug_departments` varchar(300) NOT NULL,
  `email_on_tactivity` int(1) NOT NULL DEFAULT 1,
  `email_on_bactivity` int(1) NOT NULL DEFAULT 1,
  `email_confirmation` int(1) NOT NULL DEFAULT 2,
  `confirmation_str` varchar(25) NOT NULL,
  `recover_password_str` varchar(35) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tickerr_users` */

insert  into `tickerr_users`(`id`,`username`,`name`,`email`,`profile_img1x`,`profile_img2x`,`profile_img3x`,`date`,`password`,`role`,`ticket_departments`,`bug_departments`,`email_on_tactivity`,`email_on_bactivity`,`email_confirmation`,`confirmation_str`,`recover_password_str`) values (1,'admin','Mahmdul Hasan','admin@admin.com','admin/logo1@1x.png','admin/logo1@2x.png','admin/logo1@3x.png','2020-07-01 08:30:40','21232f297a57a5a743894a0e4a801fc3',3,'1','1',1,1,2,'',''),(2,'albert','Albert wo','albert@admin.com','fa-user@1x.png','fa-user@2x.png','fa-user@3x.png','2020-07-01 15:29:23','8e5ebb97d6e141d10a1ab6e8dd83a29c',3,'','',1,1,2,'tmYWlbYKApmnKHCUzKGUKoxO',''),(3,'test1','test user','test1@admin.com','fa-user@1x.png','fa-user@2x.png','fa-user@3x.png','2020-07-01 16:26:14','e10adc3949ba59abbe56e057f20f883e',1,'','',1,1,2,'74kIWvzpHkx3dMpXG9fQQuRG',''),(4,'test2','test user2','test2@admin.com','fa-user@1x.png','fa-user@2x.png','fa-user@3x.png','2020-07-01 16:31:49','e10adc3949ba59abbe56e057f20f883e',1,'','',1,1,2,'XrFV4ZQ1U8uLWuAdOjBTnxPv','');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
