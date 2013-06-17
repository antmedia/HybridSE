/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50527
Source Host           : localhost:3306
Source Database       : hybrid_se

Target Server Type    : MYSQL
Target Server Version : 50527
File Encoding         : 65001

Date: 2013-06-17 17:46:49
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admins
-- ----------------------------
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id_admins` int(10) NOT NULL AUTO_INCREMENT,
  `fk_admins_types` int(10) NOT NULL,
  `username_admins` varchar(50) DEFAULT NULL,
  `password_admins` varchar(50) DEFAULT NULL,
  `name_admins` varchar(255) DEFAULT NULL,
  `email_admins` varchar(255) NOT NULL,
  `image_admins` varchar(255) DEFAULT NULL,
  `last_login_admins` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `last_ip_admins` varchar(50) DEFAULT NULL,
  `tour_admins` smallint(1) DEFAULT '1',
  `delete_admins` smallint(1) DEFAULT '0',
  `status_admins` smallint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_admins`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of admins
-- ----------------------------
INSERT INTO `admins` VALUES ('1', '1', 'webmaster', 'iamgod', 'Luís Antunes', 'antmedia@gmx.com', 'documents/avatar/la.jpg', '2013-04-17 18:46:16', '', '0', '0', '1');
INSERT INTO `admins` VALUES ('2', '2', 'demo', 'demo', 'Demo', 'info@hybrid.pt', 'documents/avatar/demo.png', '2013-04-16 11:49:40', null, '0', '0', '1');
INSERT INTO `admins` VALUES ('23', '3', 'palmeida', 'pawhale2013!#', 'Paulo Almeida', 'paulo.almeida@whalelabs.com', null, '2013-04-16 11:49:40', null, '0', '0', '1');
INSERT INTO `admins` VALUES ('22', '3', 'jgomes', 'jgwhale13', 'João Gomes', 'joao.gomes@whalelabs.com', null, '2013-04-16 11:49:40', null, '0', '0', '1');
INSERT INTO `admins` VALUES ('24', '3', 'spina', 'spwhale2013!#', 'Sandra Pina', 'sandra.pina@whalelabs.com', null, '2013-04-16 11:49:40', null, '0', '0', '1');
INSERT INTO `admins` VALUES ('25', '3', 'fresende', 'frwhale2013!#', 'Filipe Resende', 'filipe.resende@whalelabs.com', null, '2013-04-16 11:49:40', null, '0', '0', '1');
INSERT INTO `admins` VALUES ('27', '3', null, null, 'Moderador 1', '', null, '2013-04-16 11:49:41', null, '0', '0', '1');
INSERT INTO `admins` VALUES ('28', '3', null, null, 'Moderador 2', '', null, '2013-04-16 11:49:41', null, '0', '0', '1');
INSERT INTO `admins` VALUES ('29', '3', null, null, 'Moderador 3', '', null, '2013-04-16 11:49:41', null, '0', '0', '1');
INSERT INTO `admins` VALUES ('30', '3', null, null, 'Moderador 4', '', null, '2013-04-16 11:49:42', null, '0', '0', '1');

-- ----------------------------
-- Table structure for admins_changes
-- ----------------------------
DROP TABLE IF EXISTS `admins_changes`;
CREATE TABLE `admins_changes` (
  `id_admins_changes` int(10) NOT NULL AUTO_INCREMENT,
  `fk_admins` int(10) NOT NULL,
  `fk_modules` int(10) NOT NULL,
  `code_admins_changes` int(10) DEFAULT NULL,
  `action_admins_changes` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `now_admins_changes` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_admins_changes`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of admins_changes
-- ----------------------------

-- ----------------------------
-- Table structure for clients_coupons
-- ----------------------------
DROP TABLE IF EXISTS `clients_coupons`;
CREATE TABLE `clients_coupons` (
  `id_clients_coupons` int(11) NOT NULL AUTO_INCREMENT,
  `fk_clients` int(11) DEFAULT NULL,
  `fk_shop_products` int(11) DEFAULT NULL,
  `print_code_clients_coupons` bigint(13) DEFAULT NULL,
  `status_clients_coupons` smallint(1) DEFAULT '0',
  PRIMARY KEY (`id_clients_coupons`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of clients_coupons
-- ----------------------------
INSERT INTO `clients_coupons` VALUES ('1', '1', '4', '123639', '1');
INSERT INTO `clients_coupons` VALUES ('2', '1', '2', '330870', '1');
INSERT INTO `clients_coupons` VALUES ('3', '1', '1', '430701', '1');

-- ----------------------------
-- Table structure for config
-- ----------------------------
DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `term` varchar(255) DEFAULT NULL,
  `value` text,
  `info` varchar(255) DEFAULT NULL,
  `blocked` smallint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=134 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of config
-- ----------------------------

-- ----------------------------
-- Table structure for contacts
-- ----------------------------
DROP TABLE IF EXISTS `contacts`;
CREATE TABLE `contacts` (
  `id_contacts` int(10) NOT NULL AUTO_INCREMENT,
  `name_contacts` varchar(255) DEFAULT NULL,
  `email_contacts` varchar(255) DEFAULT NULL,
  `phone_contacts` varchar(50) DEFAULT NULL,
  `subject_contacts` varchar(255) DEFAULT NULL,
  `message_contacts` text,
  `seen_contacts` smallint(1) DEFAULT '0',
  `replied_contacts` smallint(1) DEFAULT '0',
  `now_contacts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `delete_contacts` smallint(1) DEFAULT '0',
  PRIMARY KEY (`id_contacts`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of contacts
-- ----------------------------
INSERT INTO `contacts` VALUES ('1', 'Luís Antunes', 'antmedia@gmx.com', '123456789', 'Apenas um teste', 'Apenas uma mensagem de teste', '0', '0', '2012-12-27 11:52:59', '0');
INSERT INTO `contacts` VALUES ('2', 'Luís Antunes', 'antmedia@gmx.com', '123456789', 'Apenas um teste', 'Apenas uma mensagem de teste', '0', '0', '2012-12-27 11:53:28', '0');
INSERT INTO `contacts` VALUES ('3', 'Luís Antunes', 'antmedia@gmx.com', '123456789', 'Apenas um teste', 'Apenas uma mensagem de teste', '0', '0', '2012-12-27 11:53:30', '0');
INSERT INTO `contacts` VALUES ('4', 'Zé Ninguém', 'antmedia@gmx.com', '123456789', 'Apenas um teste', 'Apenas uma mensagem de teste', '0', '0', '2012-12-27 13:45:45', '0');

-- ----------------------------
-- Table structure for fields
-- ----------------------------
DROP TABLE IF EXISTS `fields`;
CREATE TABLE `fields` (
  `id_fields` int(11) NOT NULL AUTO_INCREMENT,
  `name_fields` varchar(255) DEFAULT NULL,
  `type_fields` varchar(255) DEFAULT NULL,
  `validation_fields` varchar(255) DEFAULT NULL,
  `help_fields` varchar(255) DEFAULT NULL,
  `predefined_fields` varchar(255) DEFAULT NULL,
  `placeholder_fields` varchar(255) DEFAULT NULL,
  `values_fields` varchar(255) DEFAULT NULL,
  `required_fields` smallint(1) DEFAULT NULL,
  `mask_fields` varchar(20) DEFAULT NULL,
  `size_fields` smallint(3) DEFAULT NULL,
  `minlength_fields` smallint(3) DEFAULT NULL,
  `maxlength_fields` smallint(3) DEFAULT NULL,
  `module_fields` varchar(50) DEFAULT NULL,
  `now_fields` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status_fields` smallint(1) DEFAULT '1',
  PRIMARY KEY (`id_fields`)
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of fields
-- ----------------------------
INSERT INTO `fields` VALUES ('1', 'name_client', 'text', null, 'Apenas um teste', 'TESTE', 'Nome de cliente', null, '1', null, null, null, null, 'test', '2013-03-19 11:53:25', '1');
INSERT INTO `fields` VALUES ('2', 'client_password', 'password', null, null, null, null, null, '1', null, null, null, null, 'test', '2013-03-19 12:09:45', '1');
INSERT INTO `fields` VALUES ('3', 'client_password2', 'password_meter', null, null, null, null, null, '1', null, null, null, null, 'test', '2013-03-19 12:35:50', '1');
INSERT INTO `fields` VALUES ('4', 'test_nogrow', 'textarea_nogrow', null, null, null, 'wewe', null, '1', null, null, null, null, 'test', '2013-03-19 12:47:11', '1');
INSERT INTO `fields` VALUES ('5', 'test_grow', 'textarea_autogrow', null, null, null, 'wewewe', null, '1', null, null, null, null, 'test', '2013-03-19 12:52:15', '1');
INSERT INTO `fields` VALUES ('6', 'wysiwyg', 'wysiwyg', null, null, null, 'wewe', null, '1', null, null, null, null, 'test', '2013-03-19 12:53:40', '1');
INSERT INTO `fields` VALUES ('7', 'select_search', 'select_search', null, null, null, 'Escolha um valor', 'languages', '1', null, null, null, null, 'test', '2013-03-19 12:57:49', '1');
INSERT INTO `fields` VALUES ('8', 'select_search2', 'select_search', null, null, null, 'Escolha um valor', '1,2,3;Sim,Não,Talvez', '1', null, null, null, null, 'test', '2013-03-19 13:11:33', '1');
INSERT INTO `fields` VALUES ('9', 'select_nosearch', 'select_nosearch', null, null, null, 'Escolha um valor', 'languages', '1', null, null, null, null, 'test', '2013-03-20 11:37:41', '1');
INSERT INTO `fields` VALUES ('10', 'select_nosearch2', 'select_nosearch', null, null, null, 'Escolha um valor', '1,2,3;Sim,Não,Talvez', '1', null, null, null, null, 'test', '2013-03-20 11:37:44', '1');
INSERT INTO `fields` VALUES ('11', 'select_tags', 'select_tags', null, null, null, 'Escolha um valor', 'languages', '1', null, null, null, null, 'test', '2013-03-20 11:43:59', '1');
INSERT INTO `fields` VALUES ('12', 'select_tags2', 'select_tags', null, null, null, 'Escolha um valor', '1,2,3;Sim,Não,Talvez', '1', null, null, null, null, 'test', '2013-03-20 11:44:01', '1');
INSERT INTO `fields` VALUES ('13', 'select_dual', 'select_dual', null, null, null, 'Escolha um valor', 'languages', '1', null, null, null, null, 'test', '2013-03-20 12:08:40', '1');
INSERT INTO `fields` VALUES ('14', 'select_dual2', 'select_dual', null, null, null, 'Escolha um valor', '1,2,3;Sim,Não,Talvez', '1', null, null, null, null, 'test', '2013-03-20 12:08:42', '1');
INSERT INTO `fields` VALUES ('15', 'picker_date', 'picker_date', null, null, null, null, null, '1', null, null, null, null, 'test', '2013-03-20 12:12:14', '1');
INSERT INTO `fields` VALUES ('16', 'picker_time', 'picker_time', null, null, null, null, null, '1', null, null, null, null, 'test', '2013-03-20 12:15:29', '1');
INSERT INTO `fields` VALUES ('17', 'picker_date_time', 'picker_date_time', null, null, null, null, null, '1', null, null, null, null, 'test', '2013-03-20 12:15:34', '1');
INSERT INTO `fields` VALUES ('18', 'picker_color', 'picker_color', null, null, null, null, null, '1', null, null, null, null, 'test', '2013-03-20 12:17:09', '1');
INSERT INTO `fields` VALUES ('19', 'checkbox', 'checkbox', null, null, null, null, 'languages', '1', null, null, null, null, 'test', '2013-03-20 12:20:20', '1');
INSERT INTO `fields` VALUES ('20', 'radio', 'radio', null, null, null, null, 'languages', '1', null, null, null, null, 'test', '2013-03-20 12:20:21', '1');
INSERT INTO `fields` VALUES ('21', 'checkbox2', 'checkbox', null, null, null, null, '1,2,3;Sim,Não,Talvez', '1', null, null, null, null, 'test', '2013-03-20 12:20:41', '1');
INSERT INTO `fields` VALUES ('22', 'radio2', 'radio', null, null, null, null, '1,2,3;Sim,Não,Talvez', '1', null, null, null, null, 'test', '2013-03-20 12:20:43', '1');
INSERT INTO `fields` VALUES ('23', 'checkbox3', 'checkbox', null, null, null, null, null, '1', null, null, null, null, 'test', '2013-03-20 12:43:49', '1');
INSERT INTO `fields` VALUES ('24', 'slider', 'slider', null, null, null, null, '10', '1', null, null, null, null, 'test', '2013-03-20 12:50:19', '1');
INSERT INTO `fields` VALUES ('25', 'slider_range', 'slider_range', null, null, null, null, '20,30', '1', null, null, null, null, 'test', '2013-03-20 12:50:19', '1');
INSERT INTO `fields` VALUES ('26', 'autocomplete', 'autocomplete', null, null, null, null, 'languages', '1', null, null, null, null, 'test', '2013-03-20 12:57:24', '1');
INSERT INTO `fields` VALUES ('27', 'spinner', 'spinner', null, null, null, null, null, '1', null, null, null, null, 'test', '2013-03-20 13:17:44', '1');
INSERT INTO `fields` VALUES ('28', 'file', 'file', null, null, null, null, null, '1', null, null, null, null, 'test', '2013-03-20 15:59:27', '1');
INSERT INTO `fields` VALUES ('29', 'image', 'image', null, null, null, null, 'avatar', '1', null, null, null, null, 'test', '2013-03-20 16:00:51', '1');
INSERT INTO `fields` VALUES ('30', 'document', 'document', null, null, null, null, null, '1', null, null, null, null, 'test', '2013-03-20 16:00:53', '1');
INSERT INTO `fields` VALUES ('31', 'fk_admins', 'select_search', null, 'Moderador', null, 'Escolha um valor', 'admins', '1', null, null, null, null, 'rules', '2013-04-16 12:34:23', '1');
INSERT INTO `fields` VALUES ('32', 'steps_forms', 'spinner', null, null, '1', null, null, '1', null, null, null, null, 'forms', '2013-05-31 13:17:51', '1');
INSERT INTO `fields` VALUES ('33', 'title_forms', 'text', null, null, null, null, null, '1', null, null, null, null, 'forms', '2013-05-31 13:21:51', '1');
INSERT INTO `fields` VALUES ('34', 'intro_text_forms', 'textarea_nogrow', null, null, null, null, null, '0', null, null, null, null, 'forms', '2013-05-31 13:22:48', '1');
INSERT INTO `fields` VALUES ('35', 'full_text_forms', 'textarea_autogrow', null, null, null, null, null, '0', null, null, null, null, 'forms', '2013-05-31 13:23:02', '1');
INSERT INTO `fields` VALUES ('36', 'email_sender_forms', 'email', null, null, null, null, null, '0', null, null, null, null, 'forms', '2013-05-31 13:25:20', '1');
INSERT INTO `fields` VALUES ('37', 'email_recipient_forms', 'email', null, null, null, null, null, '0', null, null, null, null, 'forms', '2013-05-31 13:25:25', '1');
INSERT INTO `fields` VALUES ('39', 'type_form_fields', 'select_nosearch', null, null, null, null, 'text,textarea,select,radio,checkbox,datepicker,submit,reset,button,secCode;Text,Textarea,Select,Radio,Checkbox,Date Picker,Submit,Reset,Button,Captcha', '1', null, null, null, null, 'forms', '2013-05-31 16:33:12', '1');
INSERT INTO `fields` VALUES ('40', 'required_form_fields', 'checkbox', null, null, null, null, null, '0', null, null, null, null, 'forms', '2013-05-31 16:36:08', '1');
INSERT INTO `fields` VALUES ('41', 'name_form_fields', 'text', null, null, null, null, null, '1', null, null, null, null, null, '2013-05-31 17:03:15', '1');
INSERT INTO `fields` VALUES ('42', 'inside_border_color', 'picker_color', null, null, null, null, null, null, null, null, null, null, null, '2013-05-31 17:13:07', '1');
INSERT INTO `fields` VALUES ('43', 'inside_background_color', 'picker_color', null, null, '#ffffff', null, null, null, null, null, null, null, null, '2013-05-31 17:13:21', '1');
INSERT INTO `fields` VALUES ('44', 'inside_padding', 'spinner', null, null, null, null, null, null, null, null, null, null, null, '2013-05-31 17:13:37', '1');
INSERT INTO `fields` VALUES ('45', 'inside_margin', 'spinner', null, null, null, null, null, null, null, null, null, null, null, '2013-05-31 17:13:43', '1');
INSERT INTO `fields` VALUES ('46', 'inside_width', 'spinner', null, null, null, null, null, null, null, null, null, null, null, '2013-05-31 17:13:50', '1');
INSERT INTO `fields` VALUES ('47', 'inside_height', 'spinner', null, null, null, null, null, null, null, null, null, null, null, '2013-05-31 17:13:56', '1');
INSERT INTO `fields` VALUES ('48', 'inside_font_family', 'select_nosearch', null, null, 'Times New Roman', null, 'Georgia,Times New Roman,Arial,Helvetica,Arial Black,Impact,Lucida Sans Unicode,Tahoma,Verdana,Courier New;Georgia,Times New Roman,Arial,Helvetica,Arial Black,Impact,Lucida Sans Unicode,Tahoma,Verdana,Courier New', null, null, null, null, null, null, '2013-05-31 17:14:06', '1');
INSERT INTO `fields` VALUES ('49', 'inside_font_size', 'spinner', null, null, null, null, null, null, null, null, null, null, null, '2013-05-31 17:14:13', '1');
INSERT INTO `fields` VALUES ('50', 'inside_font_color', 'picker_color', null, null, null, null, null, null, null, null, null, null, null, '2013-05-31 17:14:18', '1');
INSERT INTO `fields` VALUES ('51', 'style_image_button', 'image', null, null, null, null, null, null, null, null, null, null, null, '2013-05-31 18:09:55', '1');
INSERT INTO `fields` VALUES ('52', 'action_submit_button', 'edit_area', null, null, null, null, null, null, null, null, null, null, null, '2013-05-31 18:10:15', '1');
INSERT INTO `fields` VALUES ('53', 'mysql_host_forms', 'text', null, null, 'localhost', null, null, null, null, null, null, null, null, '2013-06-03 12:57:26', '1');
INSERT INTO `fields` VALUES ('54', 'mysql_user_forms', 'text', null, null, 'root', null, null, null, null, null, null, null, null, '2013-06-03 12:57:34', '1');
INSERT INTO `fields` VALUES ('55', 'mysql_database_forms', 'text', null, null, 'formbuilder', null, null, null, null, null, null, null, null, '2013-06-03 12:57:40', '1');
INSERT INTO `fields` VALUES ('56', 'mysql_table_forms', 'text', null, null, 'form', null, null, null, null, null, null, null, null, '2013-06-03 12:57:48', '1');
INSERT INTO `fields` VALUES ('60', 'fk_forms', 'hidden', null, null, null, null, null, null, null, null, null, null, null, '2013-06-04 13:11:10', '1');
INSERT INTO `fields` VALUES ('61', 'step_form_fields', 'hidden', null, null, null, null, null, null, null, null, null, null, null, '2013-06-04 13:11:15', '1');
INSERT INTO `fields` VALUES ('62', 'fk_form_fields', 'hidden', null, null, null, null, null, null, null, null, null, null, null, '2013-06-04 15:18:47', '1');
INSERT INTO `fields` VALUES ('63', 'inside_border_radius', 'spinner', null, null, null, null, null, null, null, null, null, null, null, '2013-06-04 18:41:47', '1');
INSERT INTO `fields` VALUES ('64', 'outside_border_color', 'picker_color', null, null, null, null, null, null, null, null, null, null, null, '2013-06-05 15:18:12', '1');
INSERT INTO `fields` VALUES ('65', 'outside_background_color', 'picker_color', null, null, '#ffffff', null, null, null, null, null, null, null, null, '2013-06-05 15:18:16', '1');
INSERT INTO `fields` VALUES ('66', 'outside_border_radius', 'spinner', null, null, null, null, null, null, null, null, null, null, null, '2013-06-05 15:18:19', '1');
INSERT INTO `fields` VALUES ('67', 'outside_padding', 'spinner', null, null, null, null, null, null, null, null, null, null, null, '2013-06-05 15:18:23', '1');
INSERT INTO `fields` VALUES ('68', 'outside_margin', 'spinner', null, null, null, null, null, null, null, null, null, null, null, '2013-06-05 15:18:26', '1');
INSERT INTO `fields` VALUES ('69', 'outside_width', 'spinner', null, null, null, null, null, null, null, null, null, null, null, '2013-06-05 15:18:29', '1');
INSERT INTO `fields` VALUES ('70', 'outside_height', 'spinner', null, null, null, null, null, null, null, null, null, null, null, '2013-06-05 15:18:32', '1');
INSERT INTO `fields` VALUES ('71', 'label_padding', 'spinner', null, null, null, null, null, null, null, null, null, null, null, '2013-06-05 15:18:35', '1');
INSERT INTO `fields` VALUES ('72', 'label_margin', 'spinner', null, null, null, null, null, null, null, null, null, null, null, '2013-06-05 15:18:40', '1');
INSERT INTO `fields` VALUES ('73', 'label_font_family', 'select_nosearch', null, null, 'Times New Roman', null, 'Georgia,Times New Roman,Arial,Helvetica,Arial Black,Impact,Lucida Sans Unicode,Tahoma,Verdana,Courier New;Georgia,Times New Roman,Arial,Helvetica,Arial Black,Impact,Lucida Sans Unicode,Tahoma,Verdana,Courier New', null, null, null, null, null, null, '2013-06-05 15:18:43', '1');
INSERT INTO `fields` VALUES ('74', 'label_font_size', 'spinner', null, null, null, null, null, null, null, null, null, null, null, '2013-06-05 15:18:45', '1');
INSERT INTO `fields` VALUES ('75', 'label_font_color', 'picker_color', null, null, '#000000', null, null, null, null, null, null, null, null, '2013-06-05 15:18:50', '1');
INSERT INTO `fields` VALUES ('76', 'button_border_color', 'picker_color', null, null, null, null, null, null, null, null, null, null, null, '2013-06-05 15:18:56', '1');
INSERT INTO `fields` VALUES ('77', 'button_background_color', 'picker_color', null, null, '#ffffff', null, null, null, null, null, null, null, null, '2013-06-05 15:19:00', '1');
INSERT INTO `fields` VALUES ('78', 'button_border_radius', 'spinner', null, null, null, null, null, null, null, null, null, null, null, '2013-06-05 15:19:04', '1');
INSERT INTO `fields` VALUES ('79', 'button_padding', 'spinner', null, null, null, null, null, null, null, null, null, null, null, '2013-06-05 15:19:07', '1');
INSERT INTO `fields` VALUES ('80', 'button_margin', 'spinner', null, null, null, null, null, null, null, null, null, null, null, '2013-06-05 15:19:09', '1');
INSERT INTO `fields` VALUES ('81', 'button_width', 'spinner', null, null, null, null, null, null, null, null, null, null, null, '2013-06-05 15:19:12', '1');
INSERT INTO `fields` VALUES ('82', 'button_font_family', 'select_nosearch', null, null, 'Times New Roman', null, 'Georgia,Times New Roman,Arial,Helvetica,Arial Black,Impact,Lucida Sans Unicode,Tahoma,Verdana,Courier New;Georgia,Times New Roman,Arial,Helvetica,Arial Black,Impact,Lucida Sans Unicode,Tahoma,Verdana,Courier New', null, null, null, null, null, null, '2013-06-05 15:19:15', '1');
INSERT INTO `fields` VALUES ('83', 'button_font_size', 'spinner', null, null, null, null, null, null, null, null, null, null, null, '2013-06-05 15:19:19', '1');
INSERT INTO `fields` VALUES ('84', 'button_font_color', 'picker_color', null, null, '#ffffff', null, null, null, null, null, null, null, null, '2013-06-05 15:19:21', '1');
INSERT INTO `fields` VALUES ('85', 'button_image_button', 'image', null, null, null, null, null, null, null, null, null, null, null, '2013-06-05 15:19:24', '1');
INSERT INTO `fields` VALUES ('86', 'button_action_button', 'edit_area', null, null, null, null, null, null, null, null, null, null, null, '2013-06-05 15:19:26', '1');
INSERT INTO `fields` VALUES ('87', 'button_height', 'spinner', null, null, null, null, null, null, null, null, null, null, null, '2013-06-05 15:22:28', '1');
INSERT INTO `fields` VALUES ('88', 'validation_form_fields', 'select_nosearch', null, null, null, null, 'email,domain,phone,zip,nif,captcha,number,image,ewvt,media,document,pdf,letters;E-mail,Domain,Phone,Zip,NIF,Captcha,Number,Image extensions,Web extensions,Media extensions,Documents extensions,Pdf extension,Letters', null, null, null, null, null, null, '2013-06-06 15:01:48', '1');
INSERT INTO `fields` VALUES ('89', 'global_border_color', 'picker_color', null, null, null, null, null, null, null, null, null, null, null, '2013-06-06 16:02:44', '1');
INSERT INTO `fields` VALUES ('90', 'global_background_color', 'picker_color', null, null, null, null, null, null, null, null, null, null, null, '2013-06-06 16:02:50', '1');
INSERT INTO `fields` VALUES ('91', 'global_float', 'select_nosearch', null, null, null, null, 'left,right,none,inherit;Left,Right,None,Inherit', null, null, null, null, null, null, '2013-06-06 16:02:53', '1');
INSERT INTO `fields` VALUES ('92', 'global_padding', 'spinner', null, null, null, null, null, null, null, null, null, null, null, '2013-06-06 16:02:57', '1');
INSERT INTO `fields` VALUES ('93', 'global_margin', 'spinner', null, null, null, null, null, null, null, null, null, null, null, '2013-06-06 16:02:59', '1');
INSERT INTO `fields` VALUES ('94', 'global_width', 'spinner', null, null, null, null, null, null, null, null, null, null, null, '2013-06-06 16:03:02', '1');
INSERT INTO `fields` VALUES ('95', 'global_height', 'spinner', null, null, null, null, null, null, null, null, null, null, null, '2013-06-06 16:03:05', '1');

-- ----------------------------
-- Table structure for forms
-- ----------------------------
DROP TABLE IF EXISTS `forms`;
CREATE TABLE `forms` (
  `id_forms` int(11) NOT NULL AUTO_INCREMENT,
  `title_forms` varchar(225) DEFAULT NULL,
  `steps_forms` smallint(6) DEFAULT '1',
  `intro_text_forms` varchar(225) DEFAULT NULL,
  `full_text_forms` text,
  `name_sender_forms` varchar(225) DEFAULT NULL,
  `email_sender_forms` varchar(225) DEFAULT NULL,
  `name_recipient_forms` varchar(225) DEFAULT NULL,
  `email_recipient_forms` varchar(225) DEFAULT NULL,
  `subject_forms` varchar(225) DEFAULT NULL,
  `smtp_host_forms` varchar(225) DEFAULT NULL,
  `smtp_user_forms` varchar(225) DEFAULT NULL,
  `smtp_pass_forms` varchar(225) DEFAULT NULL,
  `ftp_host_forms` varchar(225) DEFAULT NULL,
  `ftp_user_forms` varchar(225) DEFAULT NULL,
  `ftp_pass_forms` varchar(225) DEFAULT NULL,
  `mysql_host_forms` varchar(255) DEFAULT NULL,
  `mysql_user_forms` varchar(225) DEFAULT NULL,
  `mysql_pass_forms` varchar(255) DEFAULT NULL,
  `mysql_database_forms` varchar(225) DEFAULT NULL,
  `mysql_table_forms` varchar(225) DEFAULT NULL,
  `success_message_forms` varchar(255) DEFAULT NULL,
  `success_link_forms` varchar(255) DEFAULT NULL,
  `error_message_forms` varchar(255) DEFAULT NULL,
  `style_forms` text,
  `status_forms` smallint(1) DEFAULT '1',
  `created_forms` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `delete_forms` smallint(1) DEFAULT '0',
  PRIMARY KEY (`id_forms`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of forms
-- ----------------------------
INSERT INTO `forms` VALUES ('1', 'Contactos', '3', '1', '2', '3', '123@teste.pt', '4', '', '5', 'localhost', 'webmaster', 'lalalal', 'localhost', 'webmaster', 'lalalal', 'localhost', 'root', 'lalalal', 'formbuilder', 'form', 'A sua mensagem foi enviada correctamente.', '?status=yes', 'Existiu um erro ao enviar a sua mensagem. Por favor tente mais tarde.', null, '1', '2013-05-30 13:26:08', '0');

-- ----------------------------
-- Table structure for form_fields
-- ----------------------------
DROP TABLE IF EXISTS `form_fields`;
CREATE TABLE `form_fields` (
  `id_form_fields` int(11) NOT NULL AUTO_INCREMENT,
  `sort_form_fields` int(11) DEFAULT NULL,
  `fk_forms` int(11) DEFAULT NULL,
  `step_form_fields` smallint(6) DEFAULT NULL,
  `name_form_fields` varchar(255) DEFAULT NULL,
  `title_form_fields` varchar(255) DEFAULT NULL,
  `placeholder_form_fields` varchar(255) DEFAULT NULL,
  `type_form_fields` varchar(255) DEFAULT NULL,
  `style_form_fields` text,
  `required_form_fields` smallint(1) DEFAULT NULL,
  `validation_form_fields` varchar(255) DEFAULT NULL,
  `status_form_fields` smallint(6) DEFAULT '1',
  `created_form_fields` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `delete_form_fields` smallint(6) DEFAULT '0',
  PRIMARY KEY (`id_form_fields`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of form_fields
-- ----------------------------
INSERT INTO `form_fields` VALUES ('1', '1', '1', '1', 'name', 'Nome', 'Nome', 'text', null, null, null, '1', '2013-05-31 11:44:28', '0');
INSERT INTO `form_fields` VALUES ('2', '2', '1', '1', 'email', 'E-mail', '', 'text', null, '1', 'email', '1', '2013-05-31 11:44:52', '0');
INSERT INTO `form_fields` VALUES ('3', '3', '1', '1', 'phone', 'Telefone', 'Telefone', 'text', null, null, null, '1', '2013-05-31 11:44:54', '0');
INSERT INTO `form_fields` VALUES ('4', '4', '1', '2', 'address', 'Endereço', '', 'textarea', null, '0', null, '1', '2013-05-31 11:44:58', '0');
INSERT INTO `form_fields` VALUES ('5', '5', '1', '1', 'pay_type', 'Tipo pagamento', '', 'select', null, '1', null, '1', '2013-06-04 15:11:26', '0');
INSERT INTO `form_fields` VALUES ('6', '6', '1', '2', 'data_nas', 'Data de nascimento', '', 'datepicker', null, '1', null, '1', '2013-06-04 18:23:48', '0');
INSERT INTO `form_fields` VALUES ('7', '9', '1', '3', 'send', 'Enviar', '', 'submit', null, '0', null, '1', '2013-06-05 10:40:41', '0');
INSERT INTO `form_fields` VALUES ('8', '8', '1', '3', 'delete', 'Apagar', '', 'reset', null, '0', null, '1', '2013-06-05 10:41:12', '0');
INSERT INTO `form_fields` VALUES ('9', '7', '1', '2', 'secCode', 'Código', '', 'secCode', null, '0', null, '1', '2013-06-05 11:35:07', '0');
INSERT INTO `form_fields` VALUES ('10', null, '1', '2', 'age', 'Idade', '', 'text', null, '0', null, '1', '2013-06-05 18:33:34', '0');

-- ----------------------------
-- Table structure for form_fields_styles
-- ----------------------------
DROP TABLE IF EXISTS `form_fields_styles`;
CREATE TABLE `form_fields_styles` (
  `if_form_fields_styles` int(11) NOT NULL AUTO_INCREMENT,
  `form_fields_styles` varchar(255) DEFAULT NULL,
  `type_form_fields_styles` varchar(255) DEFAULT NULL,
  `title_form_fields_styles` varchar(255) DEFAULT NULL,
  `status_form_fields_styles` smallint(1) DEFAULT '1',
  `delete_form_fields_styles` smallint(1) DEFAULT '0',
  `created_form_fields_styles` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`if_form_fields_styles`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of form_fields_styles
-- ----------------------------
INSERT INTO `form_fields_styles` VALUES ('1', 'global_border_color', 'global', 'Border color', '1', '0', '2013-06-06 14:38:20');
INSERT INTO `form_fields_styles` VALUES ('2', 'global_background_color', 'global', 'Background color', '1', '0', '2013-06-06 14:38:26');
INSERT INTO `form_fields_styles` VALUES ('3', 'global_float', 'global', 'Float', '1', '0', '2013-06-06 14:39:47');
INSERT INTO `form_fields_styles` VALUES ('4', 'global_padding', 'global', 'Padding', '1', '0', '2013-06-06 14:39:54');
INSERT INTO `form_fields_styles` VALUES ('5', 'global_margin', 'global', 'Margin', '1', '0', '2013-06-06 14:40:02');
INSERT INTO `form_fields_styles` VALUES ('6', 'global_width', 'global', 'Width', '1', '0', '2013-06-06 14:40:32');
INSERT INTO `form_fields_styles` VALUES ('7', 'global_height', 'global', 'Height', '1', '0', '2013-06-06 14:40:35');
INSERT INTO `form_fields_styles` VALUES ('8', 'inside_border_color', 'inside', 'Border color', '1', '0', '2013-06-06 14:41:15');
INSERT INTO `form_fields_styles` VALUES ('9', 'inside_background_color', 'inside', 'Background color', '1', '0', '2013-06-06 14:41:19');
INSERT INTO `form_fields_styles` VALUES ('10', 'inside_border_radius', 'inside', 'Border Radius', '1', '0', '2013-06-06 14:41:22');
INSERT INTO `form_fields_styles` VALUES ('11', 'inside_padding', 'inside', 'Padding', '1', '0', '2013-06-06 14:41:24');
INSERT INTO `form_fields_styles` VALUES ('12', 'inside_margin', 'inside', 'Margin', '1', '0', '2013-06-06 14:41:27');
INSERT INTO `form_fields_styles` VALUES ('13', 'inside_width', 'inside', 'Width', '1', '0', '2013-06-06 14:41:29');
INSERT INTO `form_fields_styles` VALUES ('14', 'inside_height', 'inside', 'Height', '1', '0', '2013-06-06 14:41:31');
INSERT INTO `form_fields_styles` VALUES ('15', 'inside_font_family', 'inside', 'Font family', '1', '0', '2013-06-06 14:41:35');
INSERT INTO `form_fields_styles` VALUES ('16', 'inside_font_size', 'inside', 'Font size', '1', '0', '2013-06-06 14:41:40');
INSERT INTO `form_fields_styles` VALUES ('17', 'inside_font_color', 'inside', 'Font color', '1', '0', '2013-06-06 14:41:43');
INSERT INTO `form_fields_styles` VALUES ('18', 'outside_border_color', 'outside', 'Border color', '1', '0', '2013-06-06 14:42:48');
INSERT INTO `form_fields_styles` VALUES ('19', 'outside_background_color', 'outside', 'Background color', '1', '0', '2013-06-06 14:42:55');
INSERT INTO `form_fields_styles` VALUES ('20', 'outside_border_radius', 'outside', 'Border Radius', '1', '0', '2013-06-06 14:42:58');
INSERT INTO `form_fields_styles` VALUES ('21', 'outside_padding', 'outside', 'Padding', '1', '0', '2013-06-06 14:43:01');
INSERT INTO `form_fields_styles` VALUES ('22', 'outside_margin', 'outside', 'Margin', '1', '0', '2013-06-06 14:43:03');
INSERT INTO `form_fields_styles` VALUES ('23', 'outside_width', 'outside', 'Width', '1', '0', '2013-06-06 14:43:06');
INSERT INTO `form_fields_styles` VALUES ('24', 'outside_height', 'outside', 'Height', '1', '0', '2013-06-06 14:43:08');
INSERT INTO `form_fields_styles` VALUES ('25', 'label_padding', 'label', 'Padding', '1', '0', '2013-06-06 14:43:12');
INSERT INTO `form_fields_styles` VALUES ('26', 'label_margin', 'label', 'Margin', '1', '0', '2013-06-06 14:43:14');
INSERT INTO `form_fields_styles` VALUES ('27', 'label_font_family', 'label', 'Font family', '1', '0', '2013-06-06 14:43:16');
INSERT INTO `form_fields_styles` VALUES ('28', 'label_font_size', 'label', 'Font size', '1', '0', '2013-06-06 14:43:18');
INSERT INTO `form_fields_styles` VALUES ('29', 'label_font_color', 'label', 'Font color', '1', '0', '2013-06-06 14:43:20');
INSERT INTO `form_fields_styles` VALUES ('30', 'button_border_color', 'button', 'Border color', '1', '0', '2013-06-06 14:43:49');
INSERT INTO `form_fields_styles` VALUES ('31', 'button_background_color', 'button', 'Background color', '1', '0', '2013-06-06 14:43:55');
INSERT INTO `form_fields_styles` VALUES ('32', 'button_border_radius', 'button', 'Border Radius', '1', '0', '2013-06-06 14:43:57');
INSERT INTO `form_fields_styles` VALUES ('33', 'button_padding', 'button', 'Padding', '1', '0', '2013-06-06 14:43:59');
INSERT INTO `form_fields_styles` VALUES ('34', 'button_margin', 'button', 'Margin', '1', '0', '2013-06-06 14:44:02');
INSERT INTO `form_fields_styles` VALUES ('35', 'button_width', 'button', 'Width', '1', '0', '2013-06-06 14:44:04');
INSERT INTO `form_fields_styles` VALUES ('36', 'button_height', 'button', 'Height', '1', '0', '2013-06-06 14:44:06');
INSERT INTO `form_fields_styles` VALUES ('37', 'button_font_family', 'button', 'Font family', '1', '0', '2013-06-06 14:44:09');
INSERT INTO `form_fields_styles` VALUES ('38', 'button_font_size', 'button', 'Font size', '1', '0', '2013-06-06 14:44:11');
INSERT INTO `form_fields_styles` VALUES ('39', 'button_font_color', 'button', 'Font color', '1', '0', '2013-06-06 14:44:13');
INSERT INTO `form_fields_styles` VALUES ('40', 'button_image_button', 'button', 'Image button', '1', '0', '2013-06-06 14:44:16');

-- ----------------------------
-- Table structure for form_options
-- ----------------------------
DROP TABLE IF EXISTS `form_options`;
CREATE TABLE `form_options` (
  `id_form_options` int(11) NOT NULL AUTO_INCREMENT,
  `sort_form_options` int(11) DEFAULT NULL,
  `fk_forms` int(11) DEFAULT NULL,
  `fk_form_fields` int(11) DEFAULT NULL,
  `name_form_options` varchar(255) DEFAULT NULL,
  `value_form_options` varchar(255) DEFAULT NULL,
  `status_form_options` smallint(1) DEFAULT '1',
  `delete_form_options` smallint(1) DEFAULT '0',
  `created_form_options` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_form_options`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of form_options
-- ----------------------------
INSERT INTO `form_options` VALUES ('1', null, '1', '5', 'PayPal', 'PayPal', '1', '0', '2013-06-04 15:20:30');
INSERT INTO `form_options` VALUES ('2', null, '1', '5', 'Transferência Bancária', 'tb', '1', '0', '2013-06-04 15:21:39');

-- ----------------------------
-- Table structure for languages
-- ----------------------------
DROP TABLE IF EXISTS `languages`;
CREATE TABLE `languages` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(10) DEFAULT NULL,
  `local` varchar(50) DEFAULT NULL,
  `status` smallint(1) DEFAULT NULL COMMENT '1',
  `highlight` smallint(1) DEFAULT '0',
  `delete` smallint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of languages
-- ----------------------------
INSERT INTO `languages` VALUES ('2', 'albanian', 'sq', 'albanian', '0', '0', '0');
INSERT INTO `languages` VALUES ('3', 'arabic', 'ar', 'arabic', '0', '0', '0');
INSERT INTO `languages` VALUES ('4', 'bulgarian', 'bg', 'bulgarian', '0', '0', '0');
INSERT INTO `languages` VALUES ('5', 'catalan', 'ca', 'catalan', '0', '0', '0');
INSERT INTO `languages` VALUES ('6', 'chinese', 'zh-CN', 'chinese', '0', '0', '0');
INSERT INTO `languages` VALUES ('7', 'croatian', 'hr', 'croatian', '0', '0', '0');
INSERT INTO `languages` VALUES ('8', 'czech', 'cs', 'czech', '0', '0', '0');
INSERT INTO `languages` VALUES ('9', 'danish', 'da', 'danish', '0', '0', '0');
INSERT INTO `languages` VALUES ('10', 'dutch', 'nl', 'dutch', '0', '0', '0');
INSERT INTO `languages` VALUES ('11', 'english', 'en', 'english', '1', '0', '0');
INSERT INTO `languages` VALUES ('12', 'estonian', 'et', 'estonian', '0', '0', '0');
INSERT INTO `languages` VALUES ('13', 'filipino', 'tl', 'filipino', '0', '0', '0');
INSERT INTO `languages` VALUES ('14', 'finnish', 'fi', 'finnish', '0', '0', '0');
INSERT INTO `languages` VALUES ('15', 'french', 'fr', 'french', '0', '0', '0');
INSERT INTO `languages` VALUES ('16', 'galician', 'gl', 'galician', '0', '0', '0');
INSERT INTO `languages` VALUES ('17', 'german', 'de', 'german', '0', '0', '0');
INSERT INTO `languages` VALUES ('18', 'greek', 'el', 'greek', '0', '0', '0');
INSERT INTO `languages` VALUES ('19', 'hebrew', 'iw', 'hebrew', '0', '0', '0');
INSERT INTO `languages` VALUES ('20', 'hindi', 'hi', 'hindi', '0', '0', '0');
INSERT INTO `languages` VALUES ('21', 'hungarian', 'hu', 'hungarian', '0', '0', '0');
INSERT INTO `languages` VALUES ('22', 'indonesian', 'id', 'indonesian', '0', '0', '0');
INSERT INTO `languages` VALUES ('23', 'italian', 'it', 'italian', '0', '0', '0');
INSERT INTO `languages` VALUES ('24', 'japanese', 'ja', 'japanese', '0', '0', '0');
INSERT INTO `languages` VALUES ('25', 'korean', 'ko', 'korean', '0', '0', '0');
INSERT INTO `languages` VALUES ('26', 'latvian', 'lv', 'latvian', '0', '0', '0');
INSERT INTO `languages` VALUES ('27', 'lithuanian', 'lt', 'lithuanian', '0', '0', '0');
INSERT INTO `languages` VALUES ('28', 'maltese', 'mt', 'maltese', '0', '0', '0');
INSERT INTO `languages` VALUES ('29', 'norwegian', 'no', 'norwegian', '0', '0', '0');
INSERT INTO `languages` VALUES ('30', 'persian alpha', 'fa', 'persian alpha', '0', '0', '0');
INSERT INTO `languages` VALUES ('31', 'polish', 'pl', 'polish', '0', '0', '0');
INSERT INTO `languages` VALUES ('32', 'portuguese', 'pt', 'portuguese', '1', '1', '0');
INSERT INTO `languages` VALUES ('33', 'romanian', 'ro', 'romanian', '0', '0', '0');
INSERT INTO `languages` VALUES ('34', 'russian', 'ru', 'russian', '0', '0', '0');
INSERT INTO `languages` VALUES ('35', 'serbian', 'sr', 'serbian', '0', '0', '0');
INSERT INTO `languages` VALUES ('36', 'slovak', 'sk', 'slovak', '0', '0', '0');
INSERT INTO `languages` VALUES ('37', 'slovenian', 'sl', 'slovenian', '0', '0', '0');
INSERT INTO `languages` VALUES ('38', 'spanish', 'es', 'spanish', '0', '0', '0');
INSERT INTO `languages` VALUES ('39', 'swedish', 'sv', 'swedish', '0', '0', '0');
INSERT INTO `languages` VALUES ('40', 'thai', 'th', 'thai', '0', '0', '0');
INSERT INTO `languages` VALUES ('41', 'turkish', 'tr', 'turkish', '0', '0', '0');
INSERT INTO `languages` VALUES ('42', 'ukrainian', 'uk', 'ukrainian', '0', '0', '0');
INSERT INTO `languages` VALUES ('43', 'vietnamese', 'vi', 'vietnamese', '0', '0', '0');

-- ----------------------------
-- Table structure for list
-- ----------------------------
DROP TABLE IF EXISTS `list`;
CREATE TABLE `list` (
  `id_list` int(11) NOT NULL AUTO_INCREMENT,
  `name_list` varchar(255) DEFAULT NULL,
  `type_list` varchar(50) DEFAULT NULL,
  `values_list` varchar(255) DEFAULT NULL,
  `module_list` varchar(50) DEFAULT NULL,
  `status_list` smallint(1) DEFAULT '1',
  `created_list` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_list`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of list
-- ----------------------------
INSERT INTO `list` VALUES ('1', 'fk_pages', 'text', 'languages', 'pages', '1', '2013-03-22 10:30:41');
INSERT INTO `list` VALUES ('2', 'checkbox', 'checkbox', null, 'pages', '1', '2013-03-22 10:30:47');
INSERT INTO `list` VALUES ('3', 'image', 'image', null, 'pages', '1', '2013-03-22 10:30:49');

-- ----------------------------
-- Table structure for modules
-- ----------------------------
DROP TABLE IF EXISTS `modules`;
CREATE TABLE `modules` (
  `id_modules` int(10) NOT NULL AUTO_INCREMENT,
  `sort_modules` int(10) DEFAULT NULL,
  `fk_modules` int(10) DEFAULT NULL,
  `alias_modules` varchar(255) DEFAULT NULL,
  `name_modules` varchar(255) DEFAULT NULL,
  `action_modules` varchar(100) DEFAULT NULL,
  `description_modules` varchar(255) DEFAULT NULL,
  `folder_modules` varchar(255) DEFAULT NULL,
  `file_modules` varchar(255) DEFAULT NULL,
  `icon_modules` varchar(255) DEFAULT NULL,
  `status_modules` smallint(1) DEFAULT NULL,
  `now_modules` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_modules`)
) ENGINE=MyISAM AUTO_INCREMENT=91 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of modules
-- ----------------------------

-- ----------------------------
-- Table structure for pages
-- ----------------------------
DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
  `id_pages` int(11) NOT NULL AUTO_INCREMENT,
  `title_pages` varchar(255) DEFAULT NULL,
  `fk_pages` int(11) DEFAULT NULL,
  `intro_pages` varchar(255) DEFAULT NULL,
  `full_text_pages` text,
  `status_pages` smallint(1) DEFAULT '1',
  `delete_pages` smallint(1) DEFAULT '0',
  `created_pages` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_pages`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of pages
-- ----------------------------
INSERT INTO `pages` VALUES ('1', 'Teste', '1', 'Apenas uma intro de teste', 'Apenas uma full text', '1', '0', '2013-03-22 18:25:09');
INSERT INTO `pages` VALUES ('2', 'teste', null, null, null, '1', '0', '2013-05-31 11:48:00');

-- ----------------------------
-- Table structure for pipeline
-- ----------------------------
DROP TABLE IF EXISTS `pipeline`;
CREATE TABLE `pipeline` (
  `id_pipeline` int(11) NOT NULL AUTO_INCREMENT,
  `post_pipeline` text,
  `fk_pipeline` int(11) DEFAULT '0',
  `fk_user` bigint(20) DEFAULT NULL,
  `age_user` smallint(2) DEFAULT NULL,
  `local_user` varchar(50) DEFAULT NULL,
  `sex_user` smallint(1) DEFAULT NULL,
  `now_pipeline` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status_pipeline` smallint(1) DEFAULT '0',
  PRIMARY KEY (`id_pipeline`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of pipeline
-- ----------------------------
INSERT INTO `pipeline` VALUES ('6', 'Mais um post de teste. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque nec nunc nec augue porta auctor. Ut in posuere nulla. Aliquam elementum, sem sit amet gravida condimentum, massa risus iaculis neque, nec dapibus neque dui et turpis. Donec quis urna in enim posuere faucibus. Morbi vulputate hendrerit luctus. Suspendisse facilisis nulla vel augue scelerisque et venenatis nibh scelerisque. Donec interdum pharetra libero eget dignissim. Sed nec ligula massa. Nullam et eleifend nibh. Maecenas vitae euismod nulla. Ut tincidunt, lorem non vestibulum hendrerit, sem orci molestie tortor, eu vestibulum sem dui ac lacus. Suspendisse commodo condimentum magna, vitae ultrices quam pellentesque sed. Sed ante odio, vulputate nec tempus quis, lacinia ac ligula.', '0', '1275890894', '25', 'Lisboa', '1', '2013-04-08 11:54:00', '0');
INSERT INTO `pipeline` VALUES ('8', 'Apenas uma resposta', '6', '100000592295769', '25', 'Porto', '0', '2013-04-08 11:54:50', '0');
INSERT INTO `pipeline` VALUES ('9', 'Mais uma resposta', '6', '1275890894', '14', 'SÃ£o Jorge da Murunhanha', '1', '2013-04-08 11:55:20', '0');
INSERT INTO `pipeline` VALUES ('10', ' ipsum dolor sit amet, consectetur adipiscing elit. Quisque nec nunc nec augue porta auctor. Ut in posuere nulla. Aliquam elementum, sem sit amet gravida condimentum, massa risus iaculis neque, nec dapibus neque dui et turpis. Donec quis urna in enim posuere faucibus. Morbi vulputate', '0', '100000592295769', '54', 'Porto', '0', '2013-04-08 11:55:52', '0');
INSERT INTO `pipeline` VALUES ('11', 'Fusce imperdiet dui et lectus cursus ut pellentesque metus lacinia. Praesent viverra sapien ac mauris scelerisque sit amet faucibus lacus scelerisque. Curabitur libero nisi, scelerisque sit amet fringilla non, iaculis egestas metus. Morbi condimentum metus eu leo sollicitudin imperdiet. Quisque sed velit id velit sagittis dapibus. Quisque placerat pharetra purus dignissim interdum. Curabitur enim tortor, condimentum tempor rutrum sit amet, elementum varius urna. Aliquam erat volutpat. Maecenas quis mi felis.', '0', '100002367698170', '32', 'Lisboa', '1', '2013-04-08 16:11:12', '0');
INSERT INTO `pipeline` VALUES ('12', 'Apenas para ver como ficaria a resposta', '11', '100002767480822', '35', 'Lisboa', '0', '2013-04-08 16:12:35', '0');
INSERT INTO `pipeline` VALUES ('13', 'TambÃ©m respondia. LÃ¡ lÃ¡ lÃ¡', '6', '1693583439', '28', 'Amadora', '1', '2013-04-08 16:19:56', '0');
INSERT INTO `pipeline` VALUES ('14', 'TambÃ©m respondi pah!', '10', '100000757141098', '42', 'Porto', '1', '2013-04-08 16:31:06', '0');
INSERT INTO `pipeline` VALUES ('15', 'Apenas um teste de post NOVO!', '0', '1275890894', '27', 'Porto', '1', '2013-04-17 12:13:59', '0');
INSERT INTO `pipeline` VALUES ('16', 'Resposta ao meu prÃ³prio POST', '15', '1275890894', '27', 'Porto', '1', '2013-04-17 12:41:59', '0');

-- ----------------------------
-- Table structure for pipeline_x_admins
-- ----------------------------
DROP TABLE IF EXISTS `pipeline_x_admins`;
CREATE TABLE `pipeline_x_admins` (
  `id_pipeline_x_admins` int(11) NOT NULL AUTO_INCREMENT,
  `fk_pipeline` int(11) DEFAULT NULL,
  `fk_admins` int(11) DEFAULT NULL,
  `now_pipeline_x_admins` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status_pipeline_x_admins` smallint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_pipeline_x_admins`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of pipeline_x_admins
-- ----------------------------
INSERT INTO `pipeline_x_admins` VALUES ('1', '6', '25', '2013-04-17 18:50:02', '0');
INSERT INTO `pipeline_x_admins` VALUES ('2', '8', '25', '2013-04-17 18:50:02', '0');
INSERT INTO `pipeline_x_admins` VALUES ('3', '9', '25', '2013-04-17 18:50:02', '0');
INSERT INTO `pipeline_x_admins` VALUES ('4', '10', '24', '2013-04-17 18:50:02', '0');
INSERT INTO `pipeline_x_admins` VALUES ('5', '11', '1', '2013-04-17 18:50:02', '0');
INSERT INTO `pipeline_x_admins` VALUES ('6', '12', '1', '2013-04-17 18:50:02', '0');
INSERT INTO `pipeline_x_admins` VALUES ('7', '13', '25', '2013-04-17 18:50:02', '0');
INSERT INTO `pipeline_x_admins` VALUES ('8', '14', '24', '2013-04-17 18:50:02', '0');

-- ----------------------------
-- Table structure for priority
-- ----------------------------
DROP TABLE IF EXISTS `priority`;
CREATE TABLE `priority` (
  `id_priority` int(11) NOT NULL AUTO_INCREMENT,
  `fk_pipeline` int(11) DEFAULT NULL,
  `fk_admins` int(11) DEFAULT NULL,
  `busy_priority` smallint(1) DEFAULT '0',
  `points_priority` smallint(5) DEFAULT '0',
  `now_priority` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_priority`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of priority
-- ----------------------------
INSERT INTO `priority` VALUES ('1', '6', '1', '0', '1', '2013-04-17 18:50:02');
INSERT INTO `priority` VALUES ('2', '6', '25', '1', '2', '2013-04-17 18:50:02');
INSERT INTO `priority` VALUES ('3', '10', '24', '1', '1', '2013-04-17 18:50:02');
INSERT INTO `priority` VALUES ('4', '11', '1', '1', '1', '2013-04-17 18:50:02');

-- ----------------------------
-- Table structure for rules
-- ----------------------------
DROP TABLE IF EXISTS `rules`;
CREATE TABLE `rules` (
  `id_rules` int(11) NOT NULL AUTO_INCREMENT,
  `fk_admins` int(11) DEFAULT NULL,
  `type_rules` varchar(50) DEFAULT NULL,
  `term_rules` varchar(255) DEFAULT NULL,
  `points_priority_rules` smallint(1) DEFAULT NULL,
  `now_rules` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status_rules` smallint(1) DEFAULT '1',
  `delete_rules` smallint(1) DEFAULT '0',
  PRIMARY KEY (`id_rules`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of rules
-- ----------------------------
INSERT INTO `rules` VALUES ('2', '1', 'local', 'Lisboa', '1', '2013-04-16 17:17:10', '1', '0');
INSERT INTO `rules` VALUES ('3', '1', 'age', '13:19', '1', '2013-04-16 17:17:54', '1', '0');
INSERT INTO `rules` VALUES ('4', '1', 'age', '30:40', '2', '2013-04-16 17:18:43', '1', '0');
INSERT INTO `rules` VALUES ('5', '25', 'local', 'Lisboa', '2', '2013-04-16 18:43:33', '1', '0');
INSERT INTO `rules` VALUES ('6', '23', 'sex', '1', '2', '2013-04-16 18:45:08', '1', '0');
INSERT INTO `rules` VALUES ('7', '24', 'local', 'Porto', '1', '2013-04-17 11:26:40', '1', '0');
INSERT INTO `rules` VALUES ('8', '1', 'sex', '1', '2', '2013-04-17 12:15:07', '1', '0');

-- ----------------------------
-- Table structure for shop_products
-- ----------------------------
DROP TABLE IF EXISTS `shop_products`;
CREATE TABLE `shop_products` (
  `id_shop_products` int(11) NOT NULL AUTO_INCREMENT,
  `name_shop_products` varchar(255) NOT NULL,
  `title_shop_products` varchar(255) NOT NULL,
  `image_shop_products` varchar(255) NOT NULL,
  `intro_text_shop_products` text NOT NULL,
  `full_text_shop_products` text NOT NULL,
  `code_min_shop_products` bigint(13) NOT NULL,
  `code_max_shop_products` bigint(13) NOT NULL,
  `now_shop_products` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `validity_shop_products` date NOT NULL,
  `status_shop_products` smallint(1) NOT NULL DEFAULT '1',
  `delete_shop_products` smallint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_shop_products`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of shop_products
-- ----------------------------
INSERT INTO `shop_products` VALUES ('1', 'Actimel', 'Actimel', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis adipiscing vestibulum libero commodo hendrerit. Donec non quam erat. Proin ullamcorper urna vitae purus scelerisque bibendum.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis adipiscing vestibulum libero commodo hendrerit. Donec non quam erat. Proin ullamcorper urna vitae purus scelerisque bibendum. Vestibulum vehicula, tellus ut tincidunt elementum, ligula dolor interdum nisl, in placerat urna erat mattis augue. Sed pharetra, nisi non auctor ornare, diam turpis elementum metus, sed mattis elit enim nec risus. Donec venenatis lacinia risus. Praesent a nisl nibh, dapibus consectetur ante. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec ut lorem sit amet odio porta porta id sed nisl. Ut imperdiet fermentum neque tincidunt blandit. Nullam quam ipsum, mattis ac accumsan a, blandit eu orci. Nullam vestibulum aliquet nulla, nec tristique arcu interdum quis. Praesent sem turpis, porta et sodales non, ullamcorper nec est. Etiam id leo nulla.', '1111111111110', '1111111111119', '2013-03-12 16:53:55', '2013-03-31', '1', '0');
INSERT INTO `shop_products` VALUES ('2', 'Activia', 'Activia', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis adipiscing vestibulum libero commodo hendrerit. Donec non quam erat. Proin ullamcorper urna vitae purus scelerisque bibendum.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis adipiscing vestibulum libero commodo hendrerit. Donec non quam erat. Proin ullamcorper urna vitae purus scelerisque bibendum. Vestibulum vehicula, tellus ut tincidunt elementum, ligula dolor interdum nisl, in placerat urna erat mattis augue. Sed pharetra, nisi non auctor ornare, diam turpis elementum metus, sed mattis elit enim nec risus. Donec venenatis lacinia risus. Praesent a nisl nibh, dapibus consectetur ante. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec ut lorem sit amet odio porta porta id sed nisl. Ut imperdiet fermentum neque tincidunt blandit. Nullam quam ipsum, mattis ac accumsan a, blandit eu orci. Nullam vestibulum aliquet nulla, nec tristique arcu interdum quis. Praesent sem turpis, porta et sodales non, ullamcorper nec est. Etiam id leo nulla.', '2222222222220', '2222222222229', '2013-03-12 16:53:55', '2013-03-31', '1', '0');
INSERT INTO `shop_products` VALUES ('3', 'Corpos Danone', 'Corpos Danone', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis adipiscing vestibulum libero commodo hendrerit. Donec non quam erat. Proin ullamcorper urna vitae purus scelerisque bibendum.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis adipiscing vestibulum libero commodo hendrerit. Donec non quam erat. Proin ullamcorper urna vitae purus scelerisque bibendum. Vestibulum vehicula, tellus ut tincidunt elementum, ligula dolor interdum nisl, in placerat urna erat mattis augue. Sed pharetra, nisi non auctor ornare, diam turpis elementum metus, sed mattis elit enim nec risus. Donec venenatis lacinia risus. Praesent a nisl nibh, dapibus consectetur ante. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec ut lorem sit amet odio porta porta id sed nisl. Ut imperdiet fermentum neque tincidunt blandit. Nullam quam ipsum, mattis ac accumsan a, blandit eu orci. Nullam vestibulum aliquet nulla, nec tristique arcu interdum quis. Praesent sem turpis, porta et sodales non, ullamcorper nec est. Etiam id leo nulla.', '3333333333330', '3333333333339', '2013-03-12 16:55:23', '2013-03-31', '1', '0');
INSERT INTO `shop_products` VALUES ('4', 'Danacol', 'Danacol', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis adipiscing vestibulum libero commodo hendrerit. Donec non quam erat. Proin ullamcorper urna vitae purus scelerisque bibendum.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis adipiscing vestibulum libero commodo hendrerit. Donec non quam erat. Proin ullamcorper urna vitae purus scelerisque bibendum. Vestibulum vehicula, tellus ut tincidunt elementum, ligula dolor interdum nisl, in placerat urna erat mattis augue. Sed pharetra, nisi non auctor ornare, diam turpis elementum metus, sed mattis elit enim nec risus. Donec venenatis lacinia risus. Praesent a nisl nibh, dapibus consectetur ante. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec ut lorem sit amet odio porta porta id sed nisl. Ut imperdiet fermentum neque tincidunt blandit. Nullam quam ipsum, mattis ac accumsan a, blandit eu orci. Nullam vestibulum aliquet nulla, nec tristique arcu interdum quis. Praesent sem turpis, porta et sodales non, ullamcorper nec est. Etiam id leo nulla.', '4444444444440', '4444444444449', '2013-03-12 16:55:23', '2013-03-31', '1', '0');
