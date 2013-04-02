-- phpMyAdmin SQL Dump
-- version 3.5.5
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 02-Abr-2013 às 18:45
-- Versão do servidor: 5.1.68-cll
-- versão do PHP: 5.3.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: `hybridpt_se`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
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
  PRIMARY KEY (`id_admins`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Extraindo dados da tabela `admins`
--

INSERT INTO `admins` (`id_admins`, `fk_admins_types`, `username_admins`, `password_admins`, `name_admins`, `email_admins`, `image_admins`, `last_login_admins`, `last_ip_admins`, `tour_admins`, `delete_admins`) VALUES
(1, 1, 'webmaster', 'iamgod', 'Luís Antunes', 'antmedia@gmx.com', 'documents/avatar/la.jpg', NULL, '', 0, 0),
(2, 2, 'demo', 'demo', 'Demo', 'info@hybrid.pt', 'documents/avatar/demo.png', NULL, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `admins_changes`
--

CREATE TABLE IF NOT EXISTS `admins_changes` (
  `id_admins_changes` int(10) NOT NULL AUTO_INCREMENT,
  `fk_admins` int(10) NOT NULL,
  `fk_modules` int(10) NOT NULL,
  `code_admins_changes` int(10) DEFAULT NULL,
  `action_admins_changes` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `now_admins_changes` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_admins_changes`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `clients_coupons`
--

CREATE TABLE IF NOT EXISTS `clients_coupons` (
  `id_clients_coupons` int(11) NOT NULL AUTO_INCREMENT,
  `fk_clients` int(11) DEFAULT NULL,
  `fk_shop_products` int(11) DEFAULT NULL,
  `print_code_clients_coupons` bigint(13) DEFAULT NULL,
  `status_clients_coupons` smallint(1) DEFAULT '0',
  PRIMARY KEY (`id_clients_coupons`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `clients_coupons`
--

INSERT INTO `clients_coupons` (`id_clients_coupons`, `fk_clients`, `fk_shop_products`, `print_code_clients_coupons`, `status_clients_coupons`) VALUES
(1, 1, 4, 123639, 1),
(2, 1, 2, 330870, 1),
(3, 1, 1, 430701, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `term` varchar(255) DEFAULT NULL,
  `value` text,
  `info` varchar(255) DEFAULT NULL,
  `blocked` smallint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=134 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `contacts`
--

INSERT INTO `contacts` (`id_contacts`, `name_contacts`, `email_contacts`, `phone_contacts`, `subject_contacts`, `message_contacts`, `seen_contacts`, `replied_contacts`, `now_contacts`, `delete_contacts`) VALUES
(1, 'Luís Antunes', 'antmedia@gmx.com', '123456789', 'Apenas um teste', 'Apenas uma mensagem de teste', 0, 0, '2012-12-27 11:52:59', 0),
(2, 'Luís Antunes', 'antmedia@gmx.com', '123456789', 'Apenas um teste', 'Apenas uma mensagem de teste', 0, 0, '2012-12-27 11:53:28', 0),
(3, 'Luís Antunes', 'antmedia@gmx.com', '123456789', 'Apenas um teste', 'Apenas uma mensagem de teste', 0, 0, '2012-12-27 11:53:30', 0),
(4, 'Zé Ninguém', 'antmedia@gmx.com', '123456789', 'Apenas um teste', 'Apenas uma mensagem de teste', 0, 0, '2012-12-27 13:45:45', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `fields`
--

CREATE TABLE IF NOT EXISTS `fields` (
  `id_fields` int(11) NOT NULL AUTO_INCREMENT,
  `name_fields` varchar(255) DEFAULT NULL,
  `type_fields` varchar(255) DEFAULT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Extraindo dados da tabela `fields`
--

INSERT INTO `fields` (`id_fields`, `name_fields`, `type_fields`, `help_fields`, `predefined_fields`, `placeholder_fields`, `values_fields`, `required_fields`, `mask_fields`, `size_fields`, `minlength_fields`, `maxlength_fields`, `module_fields`, `now_fields`, `status_fields`) VALUES
(1, 'name_client', 'text', 'Apenas um teste', 'TESTE', 'Nome de cliente', NULL, 1, NULL, NULL, NULL, NULL, 'test', '2013-03-19 11:53:25', 1),
(2, 'client_password', 'password', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 'test', '2013-03-19 12:09:45', 1),
(3, 'client_password2', 'password_meter', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 'test', '2013-03-19 12:35:50', 1),
(4, 'test_nogrow', 'textarea_nogrow', NULL, NULL, 'wewe', NULL, 1, NULL, NULL, NULL, NULL, 'test', '2013-03-19 12:47:11', 1),
(5, 'test_grow', 'textarea_autogrow', NULL, NULL, 'wewewe', NULL, 1, NULL, NULL, NULL, NULL, 'test', '2013-03-19 12:52:15', 1),
(6, 'wysiwyg', 'wysiwyg', NULL, NULL, 'wewe', NULL, 1, NULL, NULL, NULL, NULL, 'test', '2013-03-19 12:53:40', 1),
(7, 'select_search', 'select_search', NULL, NULL, 'Escolha um valor', 'languages', 1, NULL, NULL, NULL, NULL, 'test', '2013-03-19 12:57:49', 1),
(8, 'select_search2', 'select_search', NULL, NULL, 'Escolha um valor', '1,2,3;Sim,Não,Talvez', 1, NULL, NULL, NULL, NULL, 'test', '2013-03-19 13:11:33', 1),
(9, 'select_nosearch', 'select_nosearch', NULL, NULL, 'Escolha um valor', 'languages', 1, NULL, NULL, NULL, NULL, 'test', '2013-03-20 11:37:41', 1),
(10, 'select_nosearch2', 'select_nosearch', NULL, NULL, 'Escolha um valor', '1,2,3;Sim,Não,Talvez', 1, NULL, NULL, NULL, NULL, 'test', '2013-03-20 11:37:44', 1),
(11, 'select_tags', 'select_tags', NULL, NULL, 'Escolha um valor', 'languages', 1, NULL, NULL, NULL, NULL, 'test', '2013-03-20 11:43:59', 1),
(12, 'select_tags2', 'select_tags', NULL, NULL, 'Escolha um valor', '1,2,3;Sim,Não,Talvez', 1, NULL, NULL, NULL, NULL, 'test', '2013-03-20 11:44:01', 1),
(13, 'select_dual', 'select_dual', NULL, NULL, 'Escolha um valor', 'languages', 1, NULL, NULL, NULL, NULL, 'test', '2013-03-20 12:08:40', 1),
(14, 'select_dual2', 'select_dual', NULL, NULL, 'Escolha um valor', '1,2,3;Sim,Não,Talvez', 1, NULL, NULL, NULL, NULL, 'test', '2013-03-20 12:08:42', 1),
(15, 'picker_date', 'picker_date', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 'test', '2013-03-20 12:12:14', 1),
(16, 'picker_time', 'picker_time', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 'test', '2013-03-20 12:15:29', 1),
(17, 'picker_date_time', 'picker_date_time', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 'test', '2013-03-20 12:15:34', 1),
(18, 'picker_color', 'picker_color', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 'test', '2013-03-20 12:17:09', 1),
(19, 'checkbox', 'checkbox', NULL, NULL, NULL, 'languages', 1, NULL, NULL, NULL, NULL, 'test', '2013-03-20 12:20:20', 1),
(20, 'radio', 'radio', NULL, NULL, NULL, 'languages', 1, NULL, NULL, NULL, NULL, 'test', '2013-03-20 12:20:21', 1),
(21, 'checkbox2', 'checkbox', NULL, NULL, NULL, '1,2,3;Sim,Não,Talvez', 1, NULL, NULL, NULL, NULL, 'test', '2013-03-20 12:20:41', 1),
(22, 'radio2', 'radio', NULL, NULL, NULL, '1,2,3;Sim,Não,Talvez', 1, NULL, NULL, NULL, NULL, 'test', '2013-03-20 12:20:43', 1),
(23, 'checkbox3', 'checkbox', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 'test', '2013-03-20 12:43:49', 1),
(24, 'slider', 'slider', NULL, NULL, NULL, '10', 1, NULL, NULL, NULL, NULL, 'test', '2013-03-20 12:50:19', 1),
(25, 'slider_range', 'slider_range', NULL, NULL, NULL, '20,30', 1, NULL, NULL, NULL, NULL, 'test', '2013-03-20 12:50:19', 1),
(26, 'autocomplete', 'autocomplete', NULL, NULL, NULL, 'languages', 1, NULL, NULL, NULL, NULL, 'test', '2013-03-20 12:57:24', 1),
(27, 'spinner', 'spinner', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 'test', '2013-03-20 13:17:44', 1),
(28, 'file', 'file', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 'test', '2013-03-20 15:59:27', 1),
(29, 'image', 'image', NULL, NULL, NULL, 'avatar', 1, NULL, NULL, NULL, NULL, 'test', '2013-03-20 16:00:51', 1),
(30, 'document', 'document', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 'test', '2013-03-20 16:00:53', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `languages`
--

CREATE TABLE IF NOT EXISTS `languages` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(10) DEFAULT NULL,
  `local` varchar(50) DEFAULT NULL,
  `status` smallint(1) DEFAULT NULL COMMENT '1',
  `highlight` smallint(1) DEFAULT '0',
  `delete` smallint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Extraindo dados da tabela `languages`
--

INSERT INTO `languages` (`id`, `name`, `code`, `local`, `status`, `highlight`, `delete`) VALUES
(2, 'albanian', 'sq', 'albanian', 0, 0, 0),
(3, 'arabic', 'ar', 'arabic', 0, 0, 0),
(4, 'bulgarian', 'bg', 'bulgarian', 0, 0, 0),
(5, 'catalan', 'ca', 'catalan', 0, 0, 0),
(6, 'chinese', 'zh-CN', 'chinese', 0, 0, 0),
(7, 'croatian', 'hr', 'croatian', 0, 0, 0),
(8, 'czech', 'cs', 'czech', 0, 0, 0),
(9, 'danish', 'da', 'danish', 0, 0, 0),
(10, 'dutch', 'nl', 'dutch', 0, 0, 0),
(11, 'english', 'en', 'english', 1, 0, 0),
(12, 'estonian', 'et', 'estonian', 0, 0, 0),
(13, 'filipino', 'tl', 'filipino', 0, 0, 0),
(14, 'finnish', 'fi', 'finnish', 0, 0, 0),
(15, 'french', 'fr', 'french', 0, 0, 0),
(16, 'galician', 'gl', 'galician', 0, 0, 0),
(17, 'german', 'de', 'german', 0, 0, 0),
(18, 'greek', 'el', 'greek', 0, 0, 0),
(19, 'hebrew', 'iw', 'hebrew', 0, 0, 0),
(20, 'hindi', 'hi', 'hindi', 0, 0, 0),
(21, 'hungarian', 'hu', 'hungarian', 0, 0, 0),
(22, 'indonesian', 'id', 'indonesian', 0, 0, 0),
(23, 'italian', 'it', 'italian', 0, 0, 0),
(24, 'japanese', 'ja', 'japanese', 0, 0, 0),
(25, 'korean', 'ko', 'korean', 0, 0, 0),
(26, 'latvian', 'lv', 'latvian', 0, 0, 0),
(27, 'lithuanian', 'lt', 'lithuanian', 0, 0, 0),
(28, 'maltese', 'mt', 'maltese', 0, 0, 0),
(29, 'norwegian', 'no', 'norwegian', 0, 0, 0),
(30, 'persian alpha', 'fa', 'persian alpha', 0, 0, 0),
(31, 'polish', 'pl', 'polish', 0, 0, 0),
(32, 'portuguese', 'pt', 'portuguese', 1, 1, 0),
(33, 'romanian', 'ro', 'romanian', 0, 0, 0),
(34, 'russian', 'ru', 'russian', 0, 0, 0),
(35, 'serbian', 'sr', 'serbian', 0, 0, 0),
(36, 'slovak', 'sk', 'slovak', 0, 0, 0),
(37, 'slovenian', 'sl', 'slovenian', 0, 0, 0),
(38, 'spanish', 'es', 'spanish', 0, 0, 0),
(39, 'swedish', 'sv', 'swedish', 0, 0, 0),
(40, 'thai', 'th', 'thai', 0, 0, 0),
(41, 'turkish', 'tr', 'turkish', 0, 0, 0),
(42, 'ukrainian', 'uk', 'ukrainian', 0, 0, 0),
(43, 'vietnamese', 'vi', 'vietnamese', 0, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `list`
--

CREATE TABLE IF NOT EXISTS `list` (
  `id_list` int(11) NOT NULL AUTO_INCREMENT,
  `name_list` varchar(255) DEFAULT NULL,
  `type_list` varchar(50) DEFAULT NULL,
  `values_list` varchar(255) DEFAULT NULL,
  `module_list` varchar(50) DEFAULT NULL,
  `status_list` smallint(1) DEFAULT '1',
  `created_list` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_list`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `list`
--

INSERT INTO `list` (`id_list`, `name_list`, `type_list`, `values_list`, `module_list`, `status_list`, `created_list`) VALUES
(1, 'fk_pages', 'text', 'languages', 'pages', 1, '2013-03-22 10:30:41'),
(2, 'checkbox', 'checkbox', NULL, 'pages', 1, '2013-03-22 10:30:47'),
(3, 'image', 'image', NULL, 'pages', 1, '2013-03-22 10:30:49');

-- --------------------------------------------------------

--
-- Estrutura da tabela `modules`
--

CREATE TABLE IF NOT EXISTS `modules` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=91 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id_pages` int(11) NOT NULL AUTO_INCREMENT,
  `title_pages` varchar(255) DEFAULT NULL,
  `fk_pages` int(11) DEFAULT NULL,
  `intro_pages` varchar(255) DEFAULT NULL,
  `full_text_pages` text,
  `status_pages` smallint(1) DEFAULT '1',
  `delete_pages` smallint(1) DEFAULT '0',
  `created_pages` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_pages`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `pages`
--

INSERT INTO `pages` (`id_pages`, `title_pages`, `fk_pages`, `intro_pages`, `full_text_pages`, `status_pages`, `delete_pages`, `created_pages`) VALUES
(1, 'Teste', 1, 'Apenas uma intro de teste', 'Apenas uma full text', 1, 0, '2013-03-22 18:25:09');

-- --------------------------------------------------------

--
-- Estrutura da tabela `shop_products`
--

CREATE TABLE IF NOT EXISTS `shop_products` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `shop_products`
--

INSERT INTO `shop_products` (`id_shop_products`, `name_shop_products`, `title_shop_products`, `image_shop_products`, `intro_text_shop_products`, `full_text_shop_products`, `code_min_shop_products`, `code_max_shop_products`, `now_shop_products`, `validity_shop_products`, `status_shop_products`, `delete_shop_products`) VALUES
(1, 'Actimel', 'Actimel', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis adipiscing vestibulum libero commodo hendrerit. Donec non quam erat. Proin ullamcorper urna vitae purus scelerisque bibendum.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis adipiscing vestibulum libero commodo hendrerit. Donec non quam erat. Proin ullamcorper urna vitae purus scelerisque bibendum. Vestibulum vehicula, tellus ut tincidunt elementum, ligula dolor interdum nisl, in placerat urna erat mattis augue. Sed pharetra, nisi non auctor ornare, diam turpis elementum metus, sed mattis elit enim nec risus. Donec venenatis lacinia risus. Praesent a nisl nibh, dapibus consectetur ante. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec ut lorem sit amet odio porta porta id sed nisl. Ut imperdiet fermentum neque tincidunt blandit. Nullam quam ipsum, mattis ac accumsan a, blandit eu orci. Nullam vestibulum aliquet nulla, nec tristique arcu interdum quis. Praesent sem turpis, porta et sodales non, ullamcorper nec est. Etiam id leo nulla.', 1111111111110, 1111111111119, '2013-03-12 16:53:55', '2013-03-31', 1, 0),
(2, 'Activia', 'Activia', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis adipiscing vestibulum libero commodo hendrerit. Donec non quam erat. Proin ullamcorper urna vitae purus scelerisque bibendum.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis adipiscing vestibulum libero commodo hendrerit. Donec non quam erat. Proin ullamcorper urna vitae purus scelerisque bibendum. Vestibulum vehicula, tellus ut tincidunt elementum, ligula dolor interdum nisl, in placerat urna erat mattis augue. Sed pharetra, nisi non auctor ornare, diam turpis elementum metus, sed mattis elit enim nec risus. Donec venenatis lacinia risus. Praesent a nisl nibh, dapibus consectetur ante. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec ut lorem sit amet odio porta porta id sed nisl. Ut imperdiet fermentum neque tincidunt blandit. Nullam quam ipsum, mattis ac accumsan a, blandit eu orci. Nullam vestibulum aliquet nulla, nec tristique arcu interdum quis. Praesent sem turpis, porta et sodales non, ullamcorper nec est. Etiam id leo nulla.', 2222222222220, 2222222222229, '2013-03-12 16:53:55', '2013-03-31', 1, 0),
(3, 'Corpos Danone', 'Corpos Danone', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis adipiscing vestibulum libero commodo hendrerit. Donec non quam erat. Proin ullamcorper urna vitae purus scelerisque bibendum.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis adipiscing vestibulum libero commodo hendrerit. Donec non quam erat. Proin ullamcorper urna vitae purus scelerisque bibendum. Vestibulum vehicula, tellus ut tincidunt elementum, ligula dolor interdum nisl, in placerat urna erat mattis augue. Sed pharetra, nisi non auctor ornare, diam turpis elementum metus, sed mattis elit enim nec risus. Donec venenatis lacinia risus. Praesent a nisl nibh, dapibus consectetur ante. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec ut lorem sit amet odio porta porta id sed nisl. Ut imperdiet fermentum neque tincidunt blandit. Nullam quam ipsum, mattis ac accumsan a, blandit eu orci. Nullam vestibulum aliquet nulla, nec tristique arcu interdum quis. Praesent sem turpis, porta et sodales non, ullamcorper nec est. Etiam id leo nulla.', 3333333333330, 3333333333339, '2013-03-12 16:55:23', '2013-03-31', 1, 0),
(4, 'Danacol', 'Danacol', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis adipiscing vestibulum libero commodo hendrerit. Donec non quam erat. Proin ullamcorper urna vitae purus scelerisque bibendum.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis adipiscing vestibulum libero commodo hendrerit. Donec non quam erat. Proin ullamcorper urna vitae purus scelerisque bibendum. Vestibulum vehicula, tellus ut tincidunt elementum, ligula dolor interdum nisl, in placerat urna erat mattis augue. Sed pharetra, nisi non auctor ornare, diam turpis elementum metus, sed mattis elit enim nec risus. Donec venenatis lacinia risus. Praesent a nisl nibh, dapibus consectetur ante. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec ut lorem sit amet odio porta porta id sed nisl. Ut imperdiet fermentum neque tincidunt blandit. Nullam quam ipsum, mattis ac accumsan a, blandit eu orci. Nullam vestibulum aliquet nulla, nec tristique arcu interdum quis. Praesent sem turpis, porta et sodales non, ullamcorper nec est. Etiam id leo nulla.', 4444444444440, 4444444444449, '2013-03-12 16:55:23', '2013-03-31', 1, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
