-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Gazda: localhost:3306
-- Timp de generare: 12 Mar 2017 la 21:39
-- Versiune server: 5.6.33
-- Versiune PHP: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Bază de date: `loghin_accountant`
--

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `acc_accounts`
--

CREATE TABLE IF NOT EXISTS `acc_accounts` (
  `account_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` char(32) NOT NULL,
  PRIMARY KEY (`account_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Salvarea datelor din tabel `acc_accounts`
--

INSERT INTO `acc_accounts` (`account_id`, `username`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `acc_articles`
--

CREATE TABLE IF NOT EXISTS `acc_articles` (
  `article_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `identifier` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `tag` varchar(255) DEFAULT NULL,
  `dateinsert` datetime NOT NULL,
  `public` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`article_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Salvarea datelor din tabel `acc_articles`
--

INSERT INTO `acc_articles` (`article_id`, `identifier`, `icon`, `tag`, `dateinsert`, `public`) VALUES
(11, 'events', NULL, NULL, '2017-02-26 13:04:38', '1'),
(18, 'news', NULL, NULL, '2017-02-26 13:32:51', '1'),
(19, 'testimonials', NULL, NULL, '2017-02-26 13:34:32', '1');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `acc_contact`
--

CREATE TABLE IF NOT EXISTS `acc_contact` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Salvarea datelor din tabel `acc_contact`
--

INSERT INTO `acc_contact` (`id`, `value`) VALUES
('email', 'contact@studiosanua.com'),
('email_cc', 'adrypunctro@yahoo.com'),
('map', '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2819.090803896111!2d7.639521015411335!3d45.043379169445195!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4788132b502a2b27%3A0xf6b361367136edc7!2sVia+Filadelfia%2C+162%2C+10137+Torino%2C+Italy!5e0!3m2!1sen!2sro!4v1487457329836" width="400" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `acc_header`
--

CREATE TABLE IF NOT EXISTS `acc_header` (
  `h_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`h_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Salvarea datelor din tabel `acc_header`
--

INSERT INTO `acc_header` (`h_key`, `value`) VALUES
('brand_img', 'http://contabilitate.loghin.com/assets/img/header/82caad9c3efcca871f38914bf2bcd2db.png'),
('logo_img', 'http://contabilitate.loghin.com/assets/img/header/13152a4f96645a9b5025da9a3540f5b3.png');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `acc_home_gallery_items`
--

CREATE TABLE IF NOT EXISTS `acc_home_gallery_items` (
  `item_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `priority` tinyint(4) NOT NULL,
  `image_src` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Salvarea datelor din tabel `acc_home_gallery_items`
--

INSERT INTO `acc_home_gallery_items` (`item_id`, `priority`, `image_src`, `link`) VALUES
(1, 1, 'http://contabilitate.loghin.com/admin/assets/img/homegallery/b784e5cd4a9b6da0094be486dc0dc319.jpg', 'http://firstlink.com'),
(2, 2, 'http://contabilitate.loghin.com/admin/assets/img/homegallery/96ff719fd2705e06efc28e8ed54e91b8.jpg', ''),
(45, 3, '', ''),
(46, 4, 'http://contabilitate.loghin.com/admin/assets/img/homegallery/88ce7451c92a97c25014244630bd38e6.JPG', ''),
(47, 5, '', '');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `acc_home_gallery_subitems`
--

CREATE TABLE IF NOT EXISTS `acc_home_gallery_subitems` (
  `subitem_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(10) unsigned NOT NULL,
  `priority` tinyint(4) NOT NULL,
  `link` varchar(1024) NOT NULL,
  PRIMARY KEY (`subitem_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Salvarea datelor din tabel `acc_home_gallery_subitems`
--

INSERT INTO `acc_home_gallery_subitems` (`subitem_id`, `item_id`, `priority`, `link`) VALUES
(11, 1, 1, ''),
(16, 46, 1, 'aaaaa'),
(17, 46, 2, 'bbbbbbb'),
(18, 46, 3, 'cccccccc'),
(19, 1, 2, ''),
(20, 1, 3, ''),
(21, 1, 4, '');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `acc_languages`
--

CREATE TABLE IF NOT EXISTS `acc_languages` (
  `lang` char(2) NOT NULL,
  `label` varchar(255) NOT NULL,
  `primary_lang` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`lang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Salvarea datelor din tabel `acc_languages`
--

INSERT INTO `acc_languages` (`lang`, `label`, `primary_lang`) VALUES
('en', 'English', '0'),
('it', 'Italian', '1'),
('ro', 'Romanian', '0');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `acc_languages_content`
--

CREATE TABLE IF NOT EXISTS `acc_languages_content` (
  `field_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lang` char(2) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`field_key`,`lang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Salvarea datelor din tabel `acc_languages_content`
--

INSERT INTO `acc_languages_content` (`field_key`, `lang`, `value`) VALUES
('article-all-item-1-content', 'en', '<p><strong>Lorem ipsum dolor sit amet</strong>, consectetur adipiscing elit. Fusce lacinia dui eget tellus porttitor egestas lacinia. Sed pharetra nibh nec tellus porttitor egestas.</p>\r\n\r\n<p>ds</p>\r\n\r\n<p>fd</p>\r\n\r\n<p>sdf</p>\r\n\r\n<p>dsf</p>\r\n\r\n<p>sd</p>\r\n\r\n<p>dsf</p>\r\n\r\n<p>dfs</p>\r\n\r\n<p>ds</p>\r\n\r\n<p>sf</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>fds</p>\r\n\r\n<p>sdf</p>\r\n\r\n<p>sd</p>\r\n\r\n<p>s</p>\r\n\r\n<p>fd</p>\r\n\r\n<p>fsd</p>\r\n'),
('article-all-item-1-description', 'en', ''),
('article-all-item-1-title', 'en', 'First article'),
('article-all-item-16-content', '10', ''),
('article-all-item-16-description', '10', ''),
('article-all-item-16-title', '10', 'ss'),
('article-all-item-19-content', 'en', '<p>rty</p>\r\n'),
('article-all-item-19-description', 'en', 'qqq'),
('article-all-item-19-title', 'en', 'qwe'),
('article-all-item-2-content', 'en', '<p><strong>Lorem ipsum dolor sit amet</strong>, consectetur adipiscing elit. Fusce lacinia dui eget tellus porttitor egestas lacinia. Sed pharetra nibh nec tellus porttitor egestas.</p>\r\n\r\n<p>sad</p>\r\n\r\n<p>asd</p>\r\n\r\n<p>asd</p>\r\n\r\n<p>sad</p>\r\n\r\n<p>sadsad</p>\r\n\r\n<p>asd</p>\r\n\r\n<p>asd</p>\r\n\r\n<p>asd</p>\r\n\r\n<p>sad</p>\r\n\r\n<p>as</p>\r\n\r\n<p>asd</p>\r\n'),
('article-all-item-2-description', 'en', ''),
('article-all-item-2-title', 'en', 'Second article'),
('article-all-item-5-content', 'en', '<p>Indian consular officials have been sent to Kansas City to meet Mr Madasani and arrange the repatriation of Mr Kuchibhotla&#39;s body.</p>\r\n\r\n<p>The Indian consul general, Anupam Ray, told the BBC: &quot;We would like to reassure the Indian community that this is being personally monitored at the highest level by Indian External Affairs Minister Sushma Swaraj from Delhi.&quot;</p>\r\n\r\n<p>The US Embassy in Delhi decried the shooting.</p>\r\n\r\n<p>&quot;The United States is a nation of immigrants and welcomes people from across the world to visit, work, study, and live,&quot; said Charge d&#39;Affaires MaryKay Carlson.</p>\r\n\r\n<p>&quot;US authorities will investigate thoroughly and prosecute the case, though we recognise that justice is small consolation to families in grief.&quot;</p>\r\n\r\n<p><img alt="Austins Bar &amp; Grill in Olathe" src="http://ichef-1.bbci.co.uk/news/624/cpsprodpb/2727/production/_94832001_1782342_917365014977825_3786573527587305659_o.jpg" /></p>\r\n\r\n<p>Image copyrightAUSTINS BAR &amp; GRILL</p>\r\n\r\n<p>Image captionAustins Bar and Grill in Olathe</p>\r\n\r\n<p>Mr Purinton, 51, was extradited to Kansas on Friday.</p>\r\n\r\n<p>A crowdfunding campaign set up by a friend to support Mr Kuchibhotla&#39;s family has already raised more than $493,000 (&pound;396,000) after donations poured in from thousands of people.</p>\r\n\r\n<p>A separate appeal to pay for Mr Grillot&#39;s medical costs has raised more than $214,000.</p>\r\n\r\n<p>A vigil held at a Baptist church close to Austins Bar and Grill brought together many people from the local Indian community for an inter-faith service.</p>\r\n\r\n<p>It ended with everyone singing Stand By Me and holding candles, our correspondent reports.</p>\r\n'),
('article-all-item-5-description', 'en', 'US authorities will investigate thoroughly and prosecute the case, though we recognise that justice is small consolation to families in grief.'),
('article-all-item-5-title', 'en', 'US authorities will investigate '),
('article-events-item-19-content', 'en', '<p>&ldquo;Proin id neque et nulla auctor elementum. In tellus quam, venenatis et ullamcorper dignissim, ultrices eu nunc. Duis vulputate porta tempus.Integer bibendum, libero nec porttitor semper, libero lectus.&rdquo;</p>\r\n\r\n<p>by&nbsp;<strong>Cristian Hocker</strong></p>\r\n'),
('article-events-item-19-description', 'en', 'Proin id neque et nulla auctor elementum. In tellus quam, venenatis et ullamcorper dignissim, ultrices eu nunc. Duis vulputate porta tempus.Integer bibendum, libero nec porttitor semper, libero lectus.'),
('article-events-item-19-title', 'en', 'Proin id neque et nulla by Cristian Hocker'),
('article-events-item-7-content', 'en', '<p>Indian consular officials have been sent to Kansas City to meet Mr Madasani and arrange the repatriation of Mr Kuchibhotla&#39;s body.</p>\r\n\r\n<p>The Indian consul general, Anupam Ray, told the BBC: &quot;We would like to reassure the Indian community that this is being personally monitored at the highest level by Indian External Affairs Minister Sushma Swaraj from Delhi.&quot;</p>\r\n\r\n<p>The US Embassy in Delhi decried the shooting.</p>\r\n\r\n<p>&quot;The United States is a nation of immigrants and welcomes people from across the world to visit, work, study, and live,&quot; said Charge d&#39;Affaires MaryKay Carlson.</p>\r\n\r\n<p>&quot;US authorities will investigate thoroughly and prosecute the case, though we recognise that justice is small consolation to families in grief.&quot;</p>\r\n\r\n<p><img alt="Austins Bar &amp; Grill in Olathe" src="http://ichef-1.bbci.co.uk/news/624/cpsprodpb/2727/production/_94832001_1782342_917365014977825_3786573527587305659_o.jpg" /></p>\r\n\r\n<p>Image copyrightAUSTINS BAR &amp; GRILL</p>\r\n\r\n<p>Image captionAustins Bar and Grill in Olathe</p>\r\n\r\n<p>Mr Purinton, 51, was extradited to Kansas on Friday.</p>\r\n\r\n<p>A crowdfunding campaign set up by a friend to support Mr Kuchibhotla&#39;s family has already raised more than $493,000 (&pound;396,000) after donations poured in from thousands of people.</p>\r\n\r\n<p>A separate appeal to pay for Mr Grillot&#39;s medical costs has raised more than $214,000.</p>\r\n\r\n<p>A vigil held at a Baptist church close to Austins Bar and Grill brought together many people from the local Indian community for an inter-faith service.</p>\r\n\r\n<p>It ended with everyone singing Stand By Me and holding candles, our correspondent reports.</p>\r\n'),
('article-events-item-7-description', 'en', 'Indian consular officials have been sent to Kansas City to meet Mr Madasani and arrange the repatriation of Mr Kuchibhotla''s body.'),
('article-home-item-3-content', 'en', '<p>India has expressed shock after the fatal shooting of an Indian national in the US, amid reports that the attack may have been racially motivated.</p>\r\n\r\n<p>Srinivas Kuchibhotla died shortly after Wednesday&#39;s attack at a bar in Olathe, Kansas. His friend Alok Madasani, also from India, and an American were hurt.</p>\r\n\r\n<p>Adam Purinton has been charged with premeditated first-degree murder.</p>\r\n\r\n<p>The killing dominated news bulletins in India and social media, where some blamed Donald Trump&#39;s presidency.</p>\r\n\r\n<p>Mr Kuchibhotla&#39;s wife, Sunayana Dumala, described her husband as a &quot;loveable soul&quot;.</p>\r\n\r\n<ul>\r\n	<li><a href="http://www.bbc.com/news/world-us-canada-39089010">Who were the victims?</a></li>\r\n</ul>\r\n\r\n<p>Speaking at a news conference, she described the US as &quot;the country that he loved so much&quot; and called the shooting a &quot;hate crime&quot;.</p>\r\n\r\n<p>White House spokesman Sean Spicer said that any loss of life was tragic but that it would be absurd to link events to Mr Trump&#39;s rhetoric.</p>\r\n\r\n<p>The FBI is now investigating possible motives for the crime at Austins Bar and Grill, with race among them. Witnesses said that just before opening fire the gunman shouted: &quot;Get out of my country.&quot;</p>\r\n\r\n<p>A barman also told local media that the attacker used racial slurs before the shooting on Wednesday night.</p>\r\n\r\n<p>Mr Kuchibhotla and Mr Madasani, both aged 32, were engineers at US technology company Garmin. The two studied initially in India and later took postgraduate degrees in the US.</p>\r\n\r\n<p>Mr Madasani has now been released from hospital.</p>\r\n\r\n<p><iframe frameborder="0" id="smphtml5iframemedia-player-1" name="smphtml5iframemedia-player-1" scrolling="no" src="http://emp.bbc.com/emp/SMPj/2.10.8/iframe.html"></iframe></p>\r\n\r\n<p>Media captionKansas widow: &#39;We thought about leaving US&#39;</p>\r\n\r\n<p>The other injured man, Ian Grillot, 24, said he was shot while intervening to try and stop the violence.</p>\r\n\r\n<p>Speaking from his hospital bed, he brushed aside suggestions that he was a hero.</p>\r\n\r\n<p>&quot;I was just doing what anyone should have done for another human being,&quot; he said.</p>\r\n\r\n<p>The suspect allegedly fled on foot and was arrested five hours later at a restaurant just over the state border, 80 miles (130km) away in Clinton, Missouri.</p>\r\n\r\n<p>He told a bartender there that he had just killed two Middle Eastern men,&nbsp;<a href="http://www.kansascity.com/news/local/crime/article134459444.html">the Kansas City Star report</a>ed without naming its sources.</p>\r\n\r\n<p>Mr Kuchibhotla was from the Indian city of Hyderabad. His parents, Madhusudhan Rao and Vardhini Rao, were too stunned by news of his death to comment, the Associated Press reported.</p>\r\n\r\n<p>Mr Madasani&#39;s father, Jaganmohan Reddy, called it a hate crime.</p>\r\n\r\n<p>After the shooting, Indian actor Siddharth tweeted to his 2.6m followers: &quot;Don&#39;t be shocked! Be angry! Trump is spreading hate. This is a hate crime! RIP #SrinivasKuchibhotla.&quot;</p>\r\n\r\n<hr />\r\n<h2>At the scene: Rajini Vaidyanathan, BBC News, Olathe, Kansas</h2>\r\n\r\n<p>For Sunayana Dumala, the grief of losing the man she loved is still raw.</p>\r\n\r\n<p>&quot;Only good things happen to good people,&quot; was a mantra her husband Srinivas Kutchibhotla used to utter.</p>\r\n\r\n<p>Since his fatal shooting on Wednesday, these words are hard for Sunayana to comprehend.</p>\r\n\r\n<p>As she addressed a news conference in Olathe, the place she&#39;s made home, she revealed her concerns about living in the United States, telling the room she had experienced racism in the past.</p>\r\n\r\n<p>She called on the US government to do more to stop hate crimes.</p>\r\n\r\n<p>It&#39;s still unclear what caused her husband&#39;s killer to pull the trigger. But this loss has left Sunayana and her friends and family questioning their place in the United States.</p>\r\n\r\n<p><a href="https://twitter.com/BBCRajiniV?lang=en-gb">Follow Rajini&#39;s updates from Kansas</a></p>\r\n\r\n<hr />\r\n<p>Indian consular officials have been sent to Kansas City to meet Mr Madasani and arrange the repatriation of Mr Kuchibhotla&#39;s body.</p>\r\n\r\n<p>The Indian consul general, Anupam Ray, told the BBC: &quot;We would like to reassure the Indian community that this is being personally monitored at the highest level by Indian External Affairs Minister Sushma Swaraj from Delhi.&quot;</p>\r\n\r\n<p>The US Embassy in Delhi decried the shooting.</p>\r\n\r\n<p>&quot;The United States is a nation of immigrants and welcomes people from across the world to visit, work, study, and live,&quot; said Charge d&#39;Affaires MaryKay Carlson.</p>\r\n\r\n<p>&quot;US authorities will investigate thoroughly and prosecute the case, though we recognise that justice is small consolation to families in grief.&quot;</p>\r\n\r\n<p><img alt="Austins Bar &amp; Grill in Olathe" src="http://ichef-1.bbci.co.uk/news/624/cpsprodpb/2727/production/_94832001_1782342_917365014977825_3786573527587305659_o.jpg" style="height:549px; width:976px" />Image copyrightAUSTINS BAR &amp; GRILL</p>\r\n\r\n<p>Image captionAustins Bar and Grill in Olathe</p>\r\n\r\n<p>Mr Purinton, 51, was extradited to Kansas on Friday.</p>\r\n\r\n<p>A crowdfunding campaign set up by a friend to support Mr Kuchibhotla&#39;s family has already raised more than $493,000 (&pound;396,000) after donations poured in from thousands of people.</p>\r\n\r\n<p>A separate appeal to pay for Mr Grillot&#39;s medical costs has raised more than $214,000.</p>\r\n\r\n<p>A vigil held at a Baptist church close to Austins Bar and Grill brought together many people from the local Indian community for an inter-faith service.</p>\r\n\r\n<p>It ended with everyone singing Stand By Me and holding candles, our correspondent reports.</p>\r\n'),
('article-home-item-3-description', 'en', 'Proin id neque et nulla auctor elementum. In tellus quam, venenatis et ullamcorper dignissim, ultrices eu nunc. Duis vulputate porta tempus.Integer bibendum, libero nec porttitor semper, libero lectus vehicula quam, a volutpat urna magna egestas magna.'),
('article-news-item-1-content', 'en', '<p><strong>Lorem ipsum dolor sit amet</strong>, consectetur adipiscing elit. Fusce lacinia dui eget tellus porttitor egestas lacinia. Sed pharetra nibh nec tellus porttitor egestas.</p>\r\n\r\n<p>ds</p>\r\n\r\n<p>fd</p>\r\n\r\n<p>sdf</p>\r\n\r\n<p>dsf</p>\r\n\r\n<p>sd</p>\r\n\r\n<p>dsf</p>\r\n\r\n<p>dfs</p>\r\n\r\n<p>ds</p>\r\n\r\n<p>sf</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>fds</p>\r\n\r\n<p>sdf</p>\r\n\r\n<p>sd</p>\r\n\r\n<p>s</p>\r\n\r\n<p>fd</p>\r\n\r\n<p>fsd</p>\r\n'),
('article-news-item-1-description', 'en', ''),
('article-news-item-11-content', 'en', ''),
('article-news-item-11-description', 'en', ''),
('article-news-item-11-title', 'en', 'ddd'),
('article-news-item-18-content', 'it', ''),
('article-news-item-18-description', 'it', ''),
('article-news-item-18-title', 'it', 'test b'),
('article-news-item-20-content', 'it', ''),
('article-news-item-20-description', 'it', ''),
('article-news-item-5-content', 'en', '<p>Indian consular officials have been sent to Kansas City to meet Mr Madasani and arrange the repatriation of Mr Kuchibhotla&#39;s body.</p>\r\n\r\n<p>The Indian consul general, Anupam Ray, told the BBC: &quot;We would like to reassure the Indian community that this is being personally monitored at the highest level by Indian External Affairs Minister Sushma Swaraj from Delhi.&quot;</p>\r\n\r\n<p>The US Embassy in Delhi decried the shooting.</p>\r\n\r\n<p>&quot;The United States is a nation of immigrants and welcomes people from across the world to visit, work, study, and live,&quot; said Charge d&#39;Affaires MaryKay Carlson.</p>\r\n\r\n<p>&quot;US authorities will investigate thoroughly and prosecute the case, though we recognise that justice is small consolation to families in grief.&quot;</p>\r\n\r\n<p><img alt="Austins Bar &amp; Grill in Olathe" src="http://ichef-1.bbci.co.uk/news/624/cpsprodpb/2727/production/_94832001_1782342_917365014977825_3786573527587305659_o.jpg" /></p>\r\n\r\n<p>Image copyrightAUSTINS BAR &amp; GRILL</p>\r\n\r\n<p>Image captionAustins Bar and Grill in Olathe</p>\r\n\r\n<p>Mr Purinton, 51, was extradited to Kansas on Friday.</p>\r\n\r\n<p>A crowdfunding campaign set up by a friend to support Mr Kuchibhotla&#39;s family has already raised more than $493,000 (&pound;396,000) after donations poured in from thousands of people.</p>\r\n\r\n<p>A separate appeal to pay for Mr Grillot&#39;s medical costs has raised more than $214,000.</p>\r\n\r\n<p>A vigil held at a Baptist church close to Austins Bar and Grill brought together many people from the local Indian community for an inter-faith service.</p>\r\n\r\n<p>It ended with everyone singing Stand By Me and holding candles, our correspondent reports.</p>\r\n'),
('article-news-item-5-description', 'en', 'US authorities will investigate thoroughly and prosecute the case, though we recognise that justice is small consolation to families in grief.'),
('article-news-item-6-content', 'en', '<p>India has expressed shock after the fatal shooting of an Indian national in the US, amid reports that the attack may have been racially motivated.</p>\r\n\r\n<p>Srinivas Kuchibhotla died shortly after Wednesday&#39;s attack at a bar in Olathe, Kansas. His friend Alok Madasani, also from India, and an American were hurt.</p>\r\n\r\n<p>Adam Purinton has been charged with premeditated first-degree murder.</p>\r\n\r\n<p>The killing dominated news bulletins in India and social media, where some blamed Donald Trump&#39;s presidency.</p>\r\n\r\n<p>Mr Kuchibhotla&#39;s wife, Sunayana Dumala, described her husband as a &quot;loveable soul&quot;.</p>\r\n\r\n<ul>\r\n	<li><a href="http://www.bbc.com/news/world-us-canada-39089010">Who were the victims?</a></li>\r\n</ul>\r\n\r\n<p>Speaking at a news conference, she described the US as &quot;the country that he loved so much&quot; and called the shooting a &quot;hate crime&quot;.</p>\r\n\r\n<p>White House spokesman Sean Spicer said that any loss of life was tragic but that it would be absurd to link events to Mr Trump&#39;s rhetoric.</p>\r\n\r\n<p>The FBI is now investigating possible motives for the crime at Austins Bar and Grill, with race among them. Witnesses said that just before opening fire the gunman shouted: &quot;Get out of my country.&quot;</p>\r\n\r\n<p>A barman also told local media that the attacker used racial slurs before the shooting on Wednesday night.</p>\r\n\r\n<p>Mr Kuchibhotla and Mr Madasani, both aged 32, were engineers at US technology company Garmin. The two studied initially in India and later took postgraduate degrees in the US.</p>\r\n\r\n<p>Mr Madasani has now been released from hospital.</p>\r\n\r\n<p><iframe frameborder="0" id="smphtml5iframemedia-player-1" name="smphtml5iframemedia-player-1" scrolling="no" src="http://emp.bbc.com/emp/SMPj/2.10.8/iframe.html"></iframe></p>\r\n\r\n<p>Media captionKansas widow: &#39;We thought about leaving US&#39;</p>\r\n\r\n<p>The other injured man, Ian Grillot, 24, said he was shot while intervening to try and stop the violence.</p>\r\n\r\n<p>Speaking from his hospital bed, he brushed aside suggestions that he was a hero.</p>\r\n\r\n<p>&quot;I was just doing what anyone should have done for another human being,&quot; he said.</p>\r\n\r\n<p>The suspect allegedly fled on foot and was arrested five hours later at a restaurant just over the state border, 80 miles (130km) away in Clinton, Missouri.</p>\r\n\r\n<p>He told a bartender there that he had just killed two Middle Eastern men,&nbsp;<a href="http://www.kansascity.com/news/local/crime/article134459444.html">the Kansas City Star report</a>ed without naming its sources.</p>\r\n\r\n<p>Mr Kuchibhotla was from the Indian city of Hyderabad. His parents, Madhusudhan Rao and Vardhini Rao, were too stunned by news of his death to comment, the Associated Press reported.</p>\r\n\r\n<p>Mr Madasani&#39;s father, Jaganmohan Reddy, called it a hate crime.</p>\r\n\r\n<p>After the shooting, Indian actor Siddharth tweeted to his 2.6m followers: &quot;Don&#39;t be shocked! Be angry! Trump is spreading hate. This is a hate crime! RIP #SrinivasKuchibhotla.&quot;</p>\r\n\r\n<hr />\r\n<h2>At the scene: Rajini Vaidyanathan, BBC News, Olathe, Kansas</h2>\r\n\r\n<p>For Sunayana Dumala, the grief of losing the man she loved is still raw.</p>\r\n\r\n<p>&quot;Only good things happen to good people,&quot; was a mantra her husband Srinivas Kutchibhotla used to utter.</p>\r\n\r\n<p>Since his fatal shooting on Wednesday, these words are hard for Sunayana to comprehend.</p>\r\n\r\n<p>As she addressed a news conference in Olathe, the place she&#39;s made home, she revealed her concerns about living in the United States, telling the room she had experienced racism in the past.</p>\r\n\r\n<p>She called on the US government to do more to stop hate crimes.</p>\r\n\r\n<p>It&#39;s still unclear what caused her husband&#39;s killer to pull the trigger. But this loss has left Sunayana and her friends and family questioning their place in the United States.</p>\r\n\r\n<p><a href="https://twitter.com/BBCRajiniV?lang=en-gb">Follow Rajini&#39;s updates from Kansas</a></p>\r\n\r\n<hr />\r\n<p>Indian consular officials have been sent to Kansas City to meet Mr Madasani and arrange the repatriation of Mr Kuchibhotla&#39;s body.</p>\r\n\r\n<p>The Indian consul general, Anupam Ray, told the BBC: &quot;We would like to reassure the Indian community that this is being personally monitored at the highest level by Indian External Affairs Minister Sushma Swaraj from Delhi.&quot;</p>\r\n\r\n<p>The US Embassy in Delhi decried the shooting.</p>\r\n\r\n<p>&quot;The United States is a nation of immigrants and welcomes people from across the world to visit, work, study, and live,&quot; said Charge d&#39;Affaires MaryKay Carlson.</p>\r\n\r\n<p>&quot;US authorities will investigate thoroughly and prosecute the case, though we recognise that justice is small consolation to families in grief.&quot;</p>\r\n\r\n<p><img alt="Austins Bar &amp; Grill in Olathe" src="http://ichef-1.bbci.co.uk/news/624/cpsprodpb/2727/production/_94832001_1782342_917365014977825_3786573527587305659_o.jpg" />Image copyrightAUSTINS BAR &amp; GRILL</p>\r\n\r\n<p>Image captionAustins Bar and Grill in Olathe</p>\r\n\r\n<p>Mr Purinton, 51, was extradited to Kansas on Friday.</p>\r\n\r\n<p>A crowdfunding campaign set up by a friend to support Mr Kuchibhotla&#39;s family has already raised more than $493,000 (&pound;396,000) after donations poured in from thousands of people.</p>\r\n\r\n<p>A separate appeal to pay for Mr Grillot&#39;s medical costs has raised more than $214,000.</p>\r\n\r\n<p>A vigil held at a Baptist church close to Austins Bar and Grill brought together many people from the local Indian community for an inter-faith service.</p>\r\n\r\n<p>It ended with everyone singing Stand By Me and holding candles, our correspondent reports.</p>\r\n'),
('article-news-item-6-description', 'en', 'India has expressed shock after the fatal shooting of an Indian national in the US, amid reports that the attack may have been racially motivated.'),
('article-news-item-6-title', 'en', 'NEW India has expressed shock'),
('article-service-item-1-content', 'en', '<p><strong>Lorem ipsum dolor sit amet</strong>, consectetur adipiscing elit. Fusce lacinia dui eget tellus porttitor egestas lacinia. Sed pharetra nibh nec tellus porttitor egestas.</p>\r\n\r\n<p>ds</p>\r\n\r\n<p>fd</p>\r\n\r\n<p>sdf</p>\r\n\r\n<p>dsf</p>\r\n\r\n<p>sd</p>\r\n\r\n<p>dsf</p>\r\n\r\n<p>dfs</p>\r\n\r\n<p>ds</p>\r\n\r\n<p>sf</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>fds</p>\r\n\r\n<p>sdf</p>\r\n\r\n<p>sd</p>\r\n\r\n<p>s</p>\r\n\r\n<p>fd</p>\r\n\r\n<p>fsd</p>\r\n'),
('article-service-item-1-desc', 'en', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce lacinia dui eget tellus porttitor egestas lacinia. Sed pharetra nibh nec tellus porttitor egestas.'),
('article-service-item-1-title', 'en', 'First article'),
('article-service-item-2-content', 'en', '<p><strong>Lorem ipsum dolor sit amet</strong>, consectetur adipiscing elit. Fusce lacinia dui eget tellus porttitor egestas lacinia. Sed pharetra nibh nec tellus porttitor egestas.</p>\r\n\r\n<p>sad</p>\r\n\r\n<p>asd</p>\r\n\r\n<p>asd</p>\r\n\r\n<p>sad</p>\r\n\r\n<p>sadsad</p>\r\n\r\n<p>asd</p>\r\n\r\n<p>asd</p>\r\n\r\n<p>asd</p>\r\n\r\n<p>sad</p>\r\n\r\n<p>as</p>\r\n\r\n<p>asd</p>\r\n'),
('article-service-item-2-desc', 'en', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce lacinia dui eget tellus porttitor egestas lacinia. Sed pharetra nibh nec tellus porttitor egestas.'),
('article-service-item-2-title', 'en', 'Second article'),
('article-testimonials-item-19-content', 'en', '<p>&ldquo;Proin id neque et nulla auctor elementum. In tellus quam, venenatis et ullamcorper dignissim, ultrices eu nunc. Duis vulputate porta tempus.Integer bibendum, libero nec porttitor semper, libero lectus.&rdquo;</p>\r\n\r\n<p>by&nbsp;<strong>Cristian Hocker</strong></p>\r\n'),
('article-testimonials-item-19-content', 'it', ''),
('article-testimonials-item-19-description', 'en', '“Proin id neque et nulla auctor elementum. In tellus quam, venenatis et ullamcorper dignissim, ultrices eu nunc. Duis vulputate porta tempus.Integer bibendum, libero nec porttitor semper, libero lectus.”\r\nby Cristian Hocker'),
('article-testimonials-item-19-description', 'it', ''),
('article-testimonials-item-19-title', 'en', 'Proin id neque et nulla by Cristian Hocker'),
('article-testimonials-item-19-title', 'it', 'test a'),
('company-domain', 'en', 'Commercialista'),
('company-domain', 'it', 'Commercialista'),
('company-domain', 'ro', 'Contabilitate'),
('company-name', 'en', 'Studio Sanua'),
('company-name', 'it', 'Studio Sanua'),
('company-name', 'ro', 'Studiul Sanua'),
('company-register', 'en', 'C.F. SNA LCU 63B 16L 219E D.M. 25/11/1999'),
('company-register', 'it', 'C.F. SNA LCU 63B 16L 219E D.M. 25/11/1999'),
('company-register', 'ro', 'C.F. SNA LCU 63B 16L 219E D.M. 25/11/1999'),
('contactinfo-button-send', 'en', 'Send'),
('contactinfo-button-send', 'it', 'Invia'),
('contactinfo-button-send', 'ro', 'Trimite'),
('contactinfo-placeholder-email', 'en', 'Email:'),
('contactinfo-placeholder-email', 'it', 'E-Mail:'),
('contactinfo-placeholder-email', 'ro', 'E-Mail:'),
('contactinfo-placeholder-fullname', 'en', 'Full name:'),
('contactinfo-placeholder-fullname', 'it', 'Nome / Cognome:'),
('contactinfo-placeholder-fullname', 'ro', 'Nume / Prenume'),
('contactinfo-placeholder-message', 'en', 'Message:'),
('contactinfo-placeholder-message', 'it', 'Messaggio:'),
('contactinfo-placeholder-message', 'ro', 'Mesaj:'),
('contactinfo-placeholder-phone', 'en', 'Phone:'),
('contactinfo-placeholder-phone', 'it', 'Telefono:'),
('contactinfo-placeholder-phone', 'ro', 'Telefon:'),
('contactinfo-section-content2', 'en', '<table>\r\n	<tbody>\r\n		<tr>\r\n			<td><strong>Luni - Vineri</strong></td>\r\n			<td><strong>9:00 - 12:30 | 15:00 - 18:00</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td><strong>Sambata:</strong></td>\r\n			<td><strong>9:00 - 12:00</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td><strong>Duminica:</strong></td>\r\n			<td><strong>Inchis</strong></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n'),
('contactinfo-section-content2', 'it', '<table style="height:115px; width:463px">\r\n	<tbody>\r\n		<tr>\r\n			<td style="text-align:right">&nbsp;Lunedi - Giovedi:</td>\r\n			<td>9:00 - 12:30 | 15:00 - 18:00</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<p style="text-align:right">&nbsp;Venerdi mattina:</p>\r\n\r\n			<p style="text-align:right">Venerdi pomeriggio:</p>\r\n			</td>\r\n			<td>\r\n			<p>9:00 - 12:30</p>\r\n\r\n			<p>chiuso per consulenze esterne</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="text-align:right">Sabato e Domenica:</td>\r\n			<td>chiuso</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n'),
('contactinfo-section-content2', 'ro', ''),
('contactinfo-section-content3', 'en', '<table border="0" style="height:58px; width:636px">\r\n	<tbody>\r\n		<tr>\r\n			<td><strong>Uffici:</strong><span style="background-color:#363636; color:#ffffff; font-family:Arial,Helvetica,sans-serif; font-size:13px">&nbsp;Via Filadelfia n. 162 10137 Torino</span></td>\r\n			<td style="text-align:justify"><strong>Tel:&nbsp;</strong><span style="background-color:#363636; color:#ffffff; font-family:Arial,Helvetica,sans-serif; font-size:13px"> 011 35 12 39</span></td>\r\n		</tr>\r\n		<tr>\r\n			<td><strong>Mail:</strong><span style="background-color:#363636; color:#ffffff; font-family:Arial,Helvetica,sans-serif; font-size:13px">&nbsp;studio.sanua@tin.it</span></td>\r\n			<td style="text-align:justify"><strong>Cell:&nbsp;</strong><span style="background-color:#363636; color:#ffffff; font-family:Arial,Helvetica,sans-serif; font-size:13px"> 335 75 69 948</span></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n'),
('contactinfo-section-content3', 'it', '<table style="height:58px; width:636px">\r\n	<tbody>\r\n		<tr>\r\n			<td><strong>Uffici:</strong><span style="background-color:#363636; color:#ffffff; font-family:Arial,Helvetica,sans-serif; font-size:13px">&nbsp;Via Filadelfia n. 162 10137 Torino</span></td>\r\n			<td><strong>Tel.</strong><span style="background-color:#363636; color:#ffffff; font-family:Arial,Helvetica,sans-serif; font-size:13px">&nbsp;011 35 12 39</span></td>\r\n		</tr>\r\n		<tr>\r\n			<td><strong>Mail:</strong><span style="background-color:#363636; color:#ffffff; font-family:Arial,Helvetica,sans-serif; font-size:13px">&nbsp;studio.sanua@tin.it</span></td>\r\n			<td><strong>Cell.</strong><span style="background-color:#363636; color:#ffffff; font-family:Arial,Helvetica,sans-serif; font-size:13px">&nbsp;335 75 69 948</span></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n'),
('contactinfo-section-content3', 'ro', '<table border="0" style="height:58px; width:636px">\r\n	<tbody>\r\n		<tr>\r\n			<td><strong>Uffici:</strong><span style="background-color:#363636; color:#ffffff; font-family:Arial,Helvetica,sans-serif; font-size:13px">&nbsp;Via Filadelfia n. 162 10137 Torino</span></td>\r\n			<td style="text-align:justify"><strong>Tel:&nbsp;</strong><span style="background-color:#363636; color:#ffffff; font-family:Arial,Helvetica,sans-serif; font-size:13px"> 011 35 12 39</span></td>\r\n		</tr>\r\n		<tr>\r\n			<td><strong>Mail:</strong><span style="background-color:#363636; color:#ffffff; font-family:Arial,Helvetica,sans-serif; font-size:13px">&nbsp;studio.sanua@tin.it</span></td>\r\n			<td style="text-align:justify"><strong>Cell:&nbsp;</strong><span style="background-color:#363636; color:#ffffff; font-family:Arial,Helvetica,sans-serif; font-size:13px"> 335 75 69 948</span></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n'),
('contactinfo-section-title1', 'en', 'Map'),
('contactinfo-section-title1', 'it', 'Map'),
('contactinfo-section-title1', 'ro', 'Harta:'),
('contactinfo-section-title2', 'en', 'Office Hours'),
('contactinfo-section-title2', 'it', 'Orari Ufficio'),
('contactinfo-section-title2', 'ro', 'Orar oficiu.'),
('contactinfo-section-title3', 'en', 'The address in Turin, in the Santa Rita area:'),
('contactinfo-section-title3', 'it', 'L''indirizzo a Torino, in zona Santa Rita:'),
('contactinfo-section-title3', 'ro', 'Adresa din Torino, zona Santa Rita:'),
('contactinfo-section-title4', 'en', 'Get in Touch'),
('contactinfo-section-title4', 'it', 'Inviate un messaggio:'),
('contactinfo-section-title4', 'ro', 'Trimiteti un mesaj:'),
('homegallery-buttons-more', 'en', 'view more'),
('homegallery-buttons-more', 'it', 'visualizzare più'),
('homegallery-buttons-more', 'ro', 'vezi mai mult'),
('homegallery-buttons-next', 'en', 'Next'),
('homegallery-buttons-next', 'it', 'Il prossimo'),
('homegallery-buttons-next', 'ro', 'Urmator'),
('homegallery-buttons-prev', 'en', 'Previous'),
('homegallery-buttons-prev', 'it', 'Precedente'),
('homegallery-buttons-prev', 'ro', 'Precedent'),
('homegallery-item-1-desc', 'en', 'This is first'),
('homegallery-item-1-desc', 'ro', 'Acesta este primul'),
('homegallery-item-1-title', 'en', 'TAX COMPLIANCE'),
('homegallery-item-1-title', 'it', 'ADEMPIMENTI TRIBUTARI'),
('homegallery-item-1-title', 'ro', 'INDEPLINIRE OBLIGATII FISCALE'),
('homegallery-item-1-title-right', 'en', 'Right first'),
('homegallery-item-1-title-right', 'ro', 'Dreapta primul'),
('homegallery-item-10-title', 'en', 'STUDIO SANUA ACTIVITY'),
('homegallery-item-10-title', 'it', 'ATTIVITA'' STUDIO SANUA'),
('homegallery-item-10-title', 'ro', 'ACTIVITATEA STUDIO-ului SANUA'),
('homegallery-item-11-title', 'en', 'PRACTICES'),
('homegallery-item-11-title', 'it', 'PRATICHE'),
('homegallery-item-11-title', 'ro', 'PRACTICI'),
('homegallery-item-12-title', 'en', 'CONTRACTS'),
('homegallery-item-12-title', 'it', 'CONTRATTI'),
('homegallery-item-12-title', 'ro', 'CONTRACTE'),
('homegallery-item-13-title', 'en', 'SPONSORSHIP AND ASSISTENCE IN TAX NATTERS'),
('homegallery-item-13-title', 'it', 'ASSISTENZA E PATROCINIO IN MATERIA TRIBUTARIA'),
('homegallery-item-13-title', 'ro', 'ASISTENTA SI PATRONAT IN MATERIE TRIBUTARA'),
('homegallery-item-14-title', 'en', 'COMPANY CONSULTING'),
('homegallery-item-14-title', 'it', 'CONSULENZE SOCIETARIE'),
('homegallery-item-14-title', 'ro', 'CONSULTANTA SOCIETATI'),
('homegallery-item-15-title', 'en', 'MEDIATION'),
('homegallery-item-15-title', 'it', 'MEDIAZIONI'),
('homegallery-item-15-title', 'ro', 'MEDIERI'),
('homegallery-item-16-title', 'en', 'LEGAL REVISION'),
('homegallery-item-16-title', 'it', 'REVISIONI LEGALI'),
('homegallery-item-16-title', 'ro', 'REVIZII LEGALE'),
('homegallery-item-17-title', 'en', 'SURVEYS AND ASSESSMENTS'),
('homegallery-item-17-title', 'it', 'PERIZIE E VALUTAZIONI'),
('homegallery-item-17-title', 'ro', 'EXPERTIZE SI EVALUARE'),
('homegallery-item-2-desc', 'en', ''),
('homegallery-item-2-title', 'en', 'ACCOUNTING & FINANCIAL STATEMENTS'),
('homegallery-item-2-title', 'it', 'CONTABILITA’ E BILANCIO'),
('homegallery-item-2-title', 'ro', 'CONTABILITATE SI BILANT'),
('homegallery-item-2-title-right', 'en', ''),
('homegallery-item-46-desc', 'en', ''),
('homegallery-item-46-title', 'en', ''),
('homegallery-item-46-title-right', 'en', ''),
('homegallery-subitem-1-desc', 'en', ''),
('homegallery-subitem-1-desc', 'it', 'no info 1.'),
('homegallery-subitem-1-desc', 'ro', ''),
('homegallery-subitem-1-title', 'en', 'Preparing annual and interim accounts and deposit requirements at C.C.I.A.A.'),
('homegallery-subitem-1-title', 'it', 'Redazione bilanci annuali e infrannuali e adempimenti di deposito presso la C.C.I.A.A.'),
('homegallery-subitem-1-title', 'ro', 'Redactare bilant anual, infra-anual si perfectari de depozit la C.C.I.A.A.'),
('homegallery-subitem-10-desc', 'en', ''),
('homegallery-subitem-11-desc', 'en', ''),
('homegallery-subitem-16-title', 'en', '1'),
('homegallery-subitem-17-title', 'en', '23'),
('homegallery-subitem-18-title', 'en', '3'),
('homegallery-subitem-2-desc', 'en', 'Big image desc ....'),
('homegallery-subitem-2-desc', 'it', 'no info 2.'),
('homegallery-subitem-2-desc', 'ro', ''),
('homegallery-subitem-2-title', 'en', 'Profesionals accounting support'),
('homegallery-subitem-2-title', 'it', 'Tenuta contabilità professionisti'),
('homegallery-subitem-2-title', 'ro', 'Tinerea contabilitati pentru profesionisti'),
('homegallery-subitem-3-desc', 'en', ''),
('homegallery-subitem-3-desc', 'it', 'no info 3.'),
('homegallery-subitem-3-desc', 'ro', ''),
('homegallery-subitem-3-title', 'en', 'Simplified accounting support'),
('homegallery-subitem-3-title', 'it', 'Tenuta contabilità semplificata'),
('homegallery-subitem-3-title', 'ro', 'Tinerea contabilitati simplificate'),
('homegallery-subitem-37-desc', 'en', 'Lo Studio Sanuo, da ormai un ventennio si ocupa della tenuta della contabilità delle azziende,'),
('homegallery-subitem-37-desc', 'it', 'Lo Studio Sanuo, da ormai un ventennio si ocupa della tenuta della contabilità delle azziende,\r\n'),
('homegallery-subitem-37-desc', 'ro', 'Lo Studio Sanuo, da ormai un ventennio si ocupa della tenuta della contabilità delle azziende,'),
('homegallery-subitem-37-title', 'en', 'Ordinary accounting support'),
('homegallery-subitem-37-title', 'it', 'Tenuta contabilità ordinaria'),
('homegallery-subitem-37-title', 'ro', 'Sustinere contabilitate ordinara'),
('homegallery-subitem-38-desc', 'en', 'Il rag.Luca Sanua, titolare dell ommonimostudio è in posesso di diploma di mediatore civile e commerciale, e per il tramite degli Organismi presso cui è iscritto può svolgere previa minima, le attività di mediatore sulle materia obligatori, cosi come disciplinate del Dlg 28 e dai successivi D.M 180 145.'),
('homegallery-subitem-38-desc', 'it', 'Il rag.Luca Sanua, titolare dell ommonimostudio è in posesso di diploma di mediatore civile e commerciale, e per il tramite degli Organismi presso cui è iscritto può svolgere previa minima, le attività di mediatore sulle materia obligatori, cosi come disciplinate del Dlg 28 e dai successivi D.M 180 145.'),
('homegallery-subitem-38-desc', 'ro', 'Il rag.Luca Sanua, titolare dell ommonimostudio è in posesso di diploma di mediatore civile e commerciale, e per il tramite degli Organismi presso cui è iscritto può svolgere previa minima, le attività di mediatore sulle materia obligatori, cosi come disciplinate del Dlg 28 e dai successivi D.M 180 145.'),
('homegallery-subitem-38-title', 'en', 'Arbitration and conciliation'),
('homegallery-subitem-38-title', 'it', 'Arbitrato e conciliazione'),
('homegallery-subitem-38-title', 'ro', 'Arbitraj si conciliere'),
('homegallery-subitem-39-desc', 'en', 'Lo Studio Sanua redige i contratti e le scritture private nei casi di compravendite da inviare al notaio per l''autenticità, elabora le opportunà contrattuali existenti dal punto di vista commerciale e formula ipotesi di convenienza economica, per ogni possibile forma negoziale'),
('homegallery-subitem-39-desc', 'it', 'Lo Studio Sanua redige i contratti e le scritture private nei casi di compravendite da inviare al notaio per l''autenticità, elabora le opportunà contrattuali existenti dal punto di vista commerciale e formula ipotesi di convenienza economica, per ogni possibile forma negoziale'),
('homegallery-subitem-39-desc', 'ro', 'Lo Studio Sanua redige i contratti e le scritture private nei casi di compravendite da inviare al notaio per l''autenticità, elabora le opportunà contrattuali existenti dal punto di vista commerciale e formula ipotesi di convenienza economica, per ogni possibile forma negoziale'),
('homegallery-subitem-39-title', 'en', 'Consultant in contractual matters'),
('homegallery-subitem-39-title', 'it', 'Consulente in materia contractuale'),
('homegallery-subitem-39-title', 'ro', 'Consultant in materie contractuala'),
('homegallery-subitem-4-desc', 'en', ''),
('homegallery-subitem-4-desc', 'it', ''),
('homegallery-subitem-40-desc', 'en', ''),
('homegallery-subitem-41-desc', 'en', ''),
('homegallery-subitem-42-desc', 'en', ''),
('homegallery-subitem-43-desc', 'en', ''),
('homegallery-subitem-48-desc', 'en', 'Lo Studio Sanua assicura il patroncinio in campo tributario, formule e ricorsi avanti le Commissione Tributarie Provinciali e Regionale ed assiste le parti nella fasi dibattimentali.'),
('homegallery-subitem-48-desc', 'it', 'Lo Studio Sanua assicura il patroncinio in campo tributario, formule e ricorsi avanti le Commissione Tributarie Provinciali e Regionale ed assiste le parti nella fasi dibattimentali.'),
('homegallery-subitem-48-desc', 'ro', 'Lo Studio Sanua assicura il patroncinio in campo tributario, formule e ricorsi avanti le Commissione Tributarie Provinciali e Regionale ed assiste le parti nella fasi dibattimentali.'),
('homegallery-subitem-48-title', 'en', 'Tax litigation'),
('homegallery-subitem-48-title', 'it', 'Contenzioso tributario'),
('homegallery-subitem-48-title', 'ro', 'Imputernicit litigii fiscale'),
('homegallery-subitem-49-desc', 'en', 'Lo studio Sanua offre i seguenti servizi:\r\n-Consulenze specifiche problematiche gestionali ai fini della contabilità aziendale.\r\n-Analisi di bilancio e dei relativo indici.\r\n-Consulenza ed assistenza in merito alla redazione di bilanci periodici infrannuali e consuntivi necessari alla verifica dei propri obbiettivi azziendali.\r\n-Consulenze collegate alle varie fasi della vita societaria con riguardo al diritto societario, commerciale e contrattuale'),
('homegallery-subitem-49-desc', 'it', 'Lo studio Sanua offre i seguenti servizi:\r\n-Consulenze specifiche problematiche gestionali ai fini della contabilità aziendale.\r\n-Analisi di bilancio e dei relativo indici.\r\n-Consulenza ed assistenza in merito alla redazione di bilanci periodici infrannuali e consuntivi necessari alla verifica dei propri obbiettivi azziendali.\r\n-Consulenze collegate alle varie fasi della vita societaria con riguardo al diritto societario, commerciale e contrattuale'),
('homegallery-subitem-49-desc', 'ro', 'Lo studio Sanua offre i seguenti servizi:\r\n-Consulenze specifiche problematiche gestionali ai fini della contabilità aziendale.\r\n-Analisi di bilancio e dei relativo indici.\r\n-Consulenza ed assistenza in merito alla redazione di bilanci periodici infrannuali e consuntivi necessari alla verifica dei propri obbiettivi azziendali.\r\n-Consulenze collegate alle varie fasi della vita societaria con riguardo al diritto societario, commerciale e contrattuale'),
('homegallery-subitem-49-title', 'en', 'Business and corporate consultant'),
('homegallery-subitem-49-title', 'it', 'Consulente aziendale e societario'),
('homegallery-subitem-49-title', 'ro', 'Consultant firma si societati'),
('homegallery-subitem-5-desc', 'en', 'asdasd'),
('homegallery-subitem-5-desc', 'it', 'no info adempimenti/conteggi.'),
('homegallery-subitem-5-desc', 'ro', ''),
('homegallery-subitem-5-title', 'en', 'ICI counts'),
('homegallery-subitem-5-title', 'it', 'Conteggi ICI'),
('homegallery-subitem-5-title', 'ro', 'Comunicare anuala IVA si prezentare telematica'),
('homegallery-subitem-50-desc', 'en', 'Il rag.Luca Sanua è sindaco di società e ha conseguito il titolo di revisore contabile, nell''anno.............. presso................................'),
('homegallery-subitem-50-desc', 'it', 'Il rag.Luca Sanua è sindaco di società e ha conseguito il titolo di revisore contabile, nell''anno.............. presso................................'),
('homegallery-subitem-50-desc', 'ro', 'Il rag.Luca Sanua è sindaco di società e ha conseguito il titolo di revisore contabile, nell''anno.............. presso................................'),
('homegallery-subitem-50-title', 'en', 'Auditor'),
('homegallery-subitem-50-title', 'it', 'Revizore contabile'),
('homegallery-subitem-50-title', 'ro', 'Revizor contabil'),
('homegallery-subitem-51-desc', 'en', 'Lo studio segue perizie e valutazionei in materia contabile, sia sotto forma di consulenza per il Tribunale, sia per conto delle parti previo specifico incarico.'),
('homegallery-subitem-51-desc', 'it', 'Lo studio segue perizie e valutazionei in materia contabile, sia sotto forma di consulenza per il Tribunale, sia per conto delle parti previo specifico incarico.'),
('homegallery-subitem-51-desc', 'ro', 'Lo studio segue perizie e valutazionei in materia contabile, sia sotto forma di consulenza per il Tribunale, sia per conto delle parti previo specifico incarico.'),
('homegallery-subitem-51-title', 'en', 'Technical adviser of the judge'),
('homegallery-subitem-51-title', 'it', 'Consulente tehnico del giudice'),
('homegallery-subitem-51-title', 'ro', 'Consultant tehnic al judecatorului'),
('homegallery-subitem-52-desc', 'en', 'Lo Studio opera da oltre venti anni e offre un''ampia gamma di servizi alla clientela, che spazia dalla consulenza al rilascio di pareri ed alla consulenza continuativa anche in loco.'),
('homegallery-subitem-52-desc', 'it', 'Lo Studio opera da oltre venti anni e offre un&#39;ampia gamma di servizi alla clientela, che spazia dalla consulenza al rilascio di pareri ed alla consulenza continuativa anche in loco.'),
('homegallery-subitem-52-desc', 'ro', 'Lo Studio opera da oltre venti anni e offre un''ampia gamma di servizi alla clientela, che spazia dalla consulenza al rilascio di pareri ed alla consulenza continuativa anche in loco.'),
('homegallery-subitem-52-title', 'en', 'Accountant'),
('homegallery-subitem-52-title', 'it', 'Commercialista'),
('homegallery-subitem-52-title', 'ro', 'Contabil'),
('homegallery-subitem-53-desc', 'en', ''),
('homegallery-subitem-53-desc', 'it', 'no info 4.'),
('homegallery-subitem-53-desc', 'ro', ''),
('homegallery-subitem-53-title', 'en', 'Ordinary accounting support'),
('homegallery-subitem-53-title', 'it', 'Tenuta contabilità ordinaria'),
('homegallery-subitem-53-title', 'ro', 'Tinerea contabilitati ordinare'),
('homegallery-subitem-54-desc', 'en', ''),
('homegallery-subitem-54-desc', 'it', 'no info adempimenti / mod 770'),
('homegallery-subitem-54-desc', 'ro', ''),
('homegallery-subitem-54-title', 'en', 'Model 770 and electronically presentations file'),
('homegallery-subitem-54-title', 'it', 'Modello 770 e presentazione telematica'),
('homegallery-subitem-54-title', 'ro', 'Modelul Unic Societate sau Persoana Fizica si prezentarea telematica'),
('homegallery-subitem-55-desc', 'en', ''),
('homegallery-subitem-55-desc', 'it', 'no info adempimenti / Mod 730'),
('homegallery-subitem-55-desc', 'ro', ''),
('homegallery-subitem-55-title', 'en', 'Model 730 and electronically presentations file'),
('homegallery-subitem-55-title', 'it', 'Modello 730 e presentazione telematica'),
('homegallery-subitem-55-title', 'ro', 'Modelul 730 si prezentarea telematica'),
('homegallery-subitem-56-desc', 'en', ''),
('homegallery-subitem-56-desc', 'it', 'no info adempimenti / Unico soc.'),
('homegallery-subitem-56-desc', 'ro', ''),
('homegallery-subitem-56-title', 'en', ''),
('homegallery-subitem-56-title', 'it', 'Modello Unico Società e persona fisica e presentazione telematica'),
('homegallery-subitem-56-title', 'ro', 'Modelul 770 si prezentarea telematica'),
('homegallery-subitem-57-desc', 'en', ''),
('homegallery-subitem-57-desc', 'it', 'no info adempimenti / dich ann.'),
('homegallery-subitem-57-desc', 'ro', ''),
('homegallery-subitem-57-title', 'en', ''),
('homegallery-subitem-57-title', 'it', 'Dichiarazione annuale IVA e presentazione telematica'),
('homegallery-subitem-57-title', 'ro', 'Modelul de plata F/24 si prezentarea telematica'),
('homegallery-subitem-58-desc', 'en', ''),
('homegallery-subitem-58-desc', 'it', 'no info adempimenti / comunic ann.'),
('homegallery-subitem-58-desc', 'ro', ''),
('homegallery-subitem-58-title', 'en', ''),
('homegallery-subitem-58-title', 'it', 'Comunicazione annuale IVA e presentazione telematica'),
('homegallery-subitem-58-title', 'ro', 'Calcule ICI'),
('homegallery-subitem-59-desc', 'en', ''),
('homegallery-subitem-59-desc', 'it', 'no info prattiche / cessazione att.'),
('homegallery-subitem-59-desc', 'ro', ''),
('homegallery-subitem-59-title', 'en', ''),
('homegallery-subitem-59-title', 'it', 'Cessazione attività e presentazione telematica'),
('homegallery-subitem-59-title', 'ro', 'Inchideri activitati si prezentare telematica'),
('homegallery-subitem-6-desc', 'en', ''),
('homegallery-subitem-6-desc', 'it', 'no info adempimenti / mod.F24'),
('homegallery-subitem-6-desc', 'ro', ''),
('homegallery-subitem-6-title', 'en', 'Payment model F / 24 and electronically presentations file'),
('homegallery-subitem-6-title', 'it', 'Modello di pagamento F/24 e presentazione telematica'),
('homegallery-subitem-6-title', 'ro', 'Declaratii anuale IVA si prezentare telematica'),
('homegallery-subitem-60-desc', 'en', ''),
('homegallery-subitem-60-desc', 'it', 'no info prattiche / variazioni att.'),
('homegallery-subitem-60-desc', 'ro', ''),
('homegallery-subitem-60-title', 'en', ''),
('homegallery-subitem-60-title', 'it', 'Variazione attività e presentazione telematica'),
('homegallery-subitem-60-title', 'ro', 'Variatii activitati si prezentarea telematica'),
('homegallery-subitem-61-desc', 'en', ''),
('homegallery-subitem-61-desc', 'it', 'no info prattiche / apertura att.'),
('homegallery-subitem-61-desc', 'ro', ''),
('homegallery-subitem-61-title', 'en', ''),
('homegallery-subitem-61-title', 'it', 'Apertura attività e presentazione telematica'),
('homegallery-subitem-61-title', 'ro', 'Initiere activitati si prezentare telematica'),
('homegallery-subitem-62-desc', 'en', ''),
('homegallery-subitem-62-desc', 'it', ''),
('homegallery-subitem-62-desc', 'ro', ''),
('homegallery-subitem-62-title', 'en', ''),
('homegallery-subitem-62-title', 'it', 'Paghe (collaborazioni con studi consulenti del lavoro)'),
('homegallery-subitem-62-title', 'ro', 'Plati (colaborari cu studii de consultanti ai munci)'),
('homegallery-subitem-63-desc', 'en', ''),
('homegallery-subitem-63-desc', 'it', ''),
('homegallery-subitem-63-desc', 'ro', ''),
('homegallery-subitem-63-title', 'en', ''),
('homegallery-subitem-63-title', 'it', 'Successioni (collaborazione con studi notarili)'),
('homegallery-subitem-63-title', 'ro', 'Succesiuni (colaborare cu studii de notariat)'),
('homegallery-subitem-64-desc', 'en', ''),
('homegallery-subitem-64-desc', 'it', ''),
('homegallery-subitem-64-desc', 'ro', ''),
('homegallery-subitem-64-title', 'en', ''),
('homegallery-subitem-64-title', 'it', 'Scritture private di cessioni aziende (bozze da inviare al Notaio)'),
('homegallery-subitem-64-title', 'ro', 'Scrieri private de cesiune societati (proiect initial de prezentat la Notar)'),
('homegallery-subitem-65-desc', 'en', ''),
('homegallery-subitem-65-desc', 'it', ''),
('homegallery-subitem-65-desc', 'ro', ''),
('homegallery-subitem-65-title', 'en', ''),
('homegallery-subitem-65-title', 'it', 'Contratti commerciali in genere'),
('homegallery-subitem-65-title', 'ro', 'Contracte comerciale in general'),
('homegallery-subitem-66-desc', 'en', ''),
('homegallery-subitem-66-desc', 'it', ''),
('homegallery-subitem-66-desc', 'ro', ''),
('homegallery-subitem-66-title', 'en', ''),
('homegallery-subitem-66-title', 'it', 'Contratti di affitto di aziende'),
('homegallery-subitem-66-title', 'ro', 'Contarcte de inchiriere de societati'),
('homegallery-subitem-67-desc', 'en', ''),
('homegallery-subitem-67-desc', 'it', ''),
('homegallery-subitem-67-desc', 'ro', ''),
('homegallery-subitem-67-title', 'en', ''),
('homegallery-subitem-67-title', 'it', 'Contratti di locazione immobili'),
('homegallery-subitem-67-title', 'ro', 'Contrcte de locatie imobiliara.'),
('homegallery-subitem-68-desc', 'en', ''),
('homegallery-subitem-68-desc', 'it', ''),
('homegallery-subitem-68-desc', 'ro', ''),
('homegallery-subitem-68-title', 'en', ''),
('homegallery-subitem-68-title', 'it', 'Discussioni in pubblica udienza avanti le Commissioni Tributarie'),
('homegallery-subitem-68-title', 'ro', 'Discutii in audienta publica in fata Comisiilor Fiscale'),
('homegallery-subitem-69-desc', 'en', ''),
('homegallery-subitem-69-desc', 'it', ''),
('homegallery-subitem-69-desc', 'ro', ''),
('homegallery-subitem-69-title', 'en', ''),
('homegallery-subitem-69-title', 'it', 'Assistenza nella fase contenziosa (ricorsi avanti le commissioni tributarie Provinciali e Regionali)'),
('homegallery-subitem-69-title', 'ro', 'Asistenta in litigii (recursuri la comisile tribuare Provincialesau Regionale)'),
('homegallery-subitem-7-desc', 'en', ''),
('homegallery-subitem-7-title', 'en', 'ccc'),
('homegallery-subitem-70-desc', 'en', ''),
('homegallery-subitem-70-desc', 'it', ''),
('homegallery-subitem-70-desc', 'ro', ''),
('homegallery-subitem-70-title', 'en', ''),
('homegallery-subitem-70-title', 'it', 'Sessioni avanti Ag. Entrate'),
('homegallery-subitem-70-title', 'ro', 'Sesiuni in fata Agentiei Fiscale'),
('homegallery-subitem-71-desc', 'en', ''),
('homegallery-subitem-71-desc', 'it', ''),
('homegallery-subitem-71-desc', 'ro', ''),
('homegallery-subitem-71-title', 'en', ''),
('homegallery-subitem-71-title', 'it', 'Scritti e memoriali difensivi'),
('homegallery-subitem-71-title', 'ro', 'Scrieri si memoriale defensive'),
('homegallery-subitem-72-desc', 'en', ''),
('homegallery-subitem-72-desc', 'it', ''),
('homegallery-subitem-72-desc', 'ro', ''),
('homegallery-subitem-72-title', 'en', '');
INSERT INTO `acc_languages_content` (`field_key`, `lang`, `value`) VALUES
('homegallery-subitem-72-title', 'it', 'Assistenza nella fase precontenziosa(contraddittorio avanti Ag. Entrate)'),
('homegallery-subitem-72-title', 'ro', 'Asistenta in faza de pre-litigii (contradictoriu in fata Agentiei Fiscale)'),
('homegallery-subitem-73-desc', 'en', ''),
('homegallery-subitem-73-desc', 'it', ''),
('homegallery-subitem-73-desc', 'ro', ''),
('homegallery-subitem-73-title', 'en', ''),
('homegallery-subitem-73-title', 'it', 'Consulenze per operazioni ordinarie e straordinarie di società di capitali'),
('homegallery-subitem-73-title', 'ro', 'Consultanta pentru operatii ordinare si extraordinare ale societatilor de capital.'),
('homegallery-subitem-74-desc', 'en', ''),
('homegallery-subitem-74-desc', 'it', ''),
('homegallery-subitem-74-desc', 'ro', ''),
('homegallery-subitem-74-title', 'en', ''),
('homegallery-subitem-74-title', 'it', 'Consulenze per operazioni ordinarie e straordinarie per società di persone'),
('homegallery-subitem-74-title', 'ro', 'Consultanta pentru operatii ordinare si extraordinare ale societatilor de persoane'),
('homegallery-subitem-75-desc', 'en', ''),
('homegallery-subitem-75-desc', 'it', ''),
('homegallery-subitem-75-desc', 'ro', ''),
('homegallery-subitem-75-title', 'en', ''),
('homegallery-subitem-75-title', 'it', 'Società di capitali (S.P.A., S.R.L.)'),
('homegallery-subitem-75-title', 'ro', 'Societati de capital (S.P.A. , S.R.L)'),
('homegallery-subitem-76-desc', 'en', ''),
('homegallery-subitem-76-desc', 'it', ''),
('homegallery-subitem-76-desc', 'ro', ''),
('homegallery-subitem-76-title', 'en', ''),
('homegallery-subitem-76-title', 'it', 'Per costituzione società'),
('homegallery-subitem-76-title', 'ro', 'Pentru constituire societati.'),
('homegallery-subitem-77-desc', 'en', ''),
('homegallery-subitem-77-desc', 'it', ''),
('homegallery-subitem-77-desc', 'ro', ''),
('homegallery-subitem-77-title', 'en', ''),
('homegallery-subitem-77-title', 'it', 'Attività di mediazione civile e commerciale'),
('homegallery-subitem-77-title', 'ro', 'Activitati de mediere civila si comerciala.'),
('homegallery-subitem-78-desc', 'en', ''),
('homegallery-subitem-78-desc', 'it', ''),
('homegallery-subitem-78-desc', 'ro', ''),
('homegallery-subitem-78-title', 'en', ''),
('homegallery-subitem-78-title', 'it', 'Revisore contabile'),
('homegallery-subitem-78-title', 'ro', 'Revizor contabil'),
('homegallery-subitem-79-desc', 'en', ''),
('homegallery-subitem-79-desc', 'it', ''),
('homegallery-subitem-79-desc', 'ro', ''),
('homegallery-subitem-79-title', 'en', ''),
('homegallery-subitem-79-title', 'it', 'Sindaco di società di capitali'),
('homegallery-subitem-79-title', 'ro', 'Auditor al societatilor de capital.'),
('homegallery-subitem-8-desc', 'en', ''),
('homegallery-subitem-8-title', 'en', 'ddd'),
('homegallery-subitem-80-desc', 'en', ''),
('homegallery-subitem-80-desc', 'it', ''),
('homegallery-subitem-80-desc', 'ro', ''),
('homegallery-subitem-80-title', 'en', 'Evaluation of social allowances'),
('homegallery-subitem-80-title', 'it', 'Valutazioni quote sociali'),
('homegallery-subitem-80-title', 'ro', 'Evaluare cote sociale'),
('homegallery-subitem-81-desc', 'en', ''),
('homegallery-subitem-81-desc', 'it', ''),
('homegallery-subitem-81-desc', 'ro', ''),
('homegallery-subitem-81-title', 'en', 'Ratings heritage society'),
('homegallery-subitem-81-title', 'it', 'Valutazioni patrimonio società'),
('homegallery-subitem-81-title', 'ro', 'Evaluare patrimoniu societate'),
('homegallery-subitem-82-desc', 'en', ''),
('homegallery-subitem-82-desc', 'it', ''),
('homegallery-subitem-82-desc', 'ro', ''),
('homegallery-subitem-82-title', 'en', ''),
('homegallery-subitem-82-title', 'it', 'Perizie in materia contabile'),
('homegallery-subitem-82-title', 'ro', 'Expertize contabile'),
('homegallery-subitem-9-desc', 'en', ''),
('homegallery-subitem-9-title', 'en', 'eee'),
('menu-home-item-15-label', 'en', 'Accounting Services'),
('menu-home-item-15-label', 'it', 'Servizi di Contabilità'),
('menu-home-item-15-label', 'ro', 'Servicii de Contabilitate'),
('menu-home-item-16-label', 'en', 'Consulting and Mediation'),
('menu-home-item-16-label', 'it', 'Consulenza e Mediazione'),
('menu-home-item-16-label', 'ro', 'Consultanta si Mediere'),
('menu-home-item-36-label', 'en', 'Consulting and Mediation'),
('menu-home-item-36-label', 'it', 'Consulenza e Mediazione'),
('menu-home-item-36-label', 'ro', 'Consultanta si Mediere'),
('menu-home-item-37-label', 'en', 'Jobs, Business & Various'),
('menu-home-item-37-label', 'it', 'Lavoro, Affari e Altro'),
('menu-home-item-37-label', 'ro', 'Joburi, Afaceri, Diverse'),
('menu-home-subitem-10-label', 'en', 'CONTRATTI'),
('menu-home-subitem-10-label', 'it', 'CONTRATTI'),
('menu-home-subitem-11-label', 'en', 'SPONSORSHIP AND ASSISTANCE IN TAX MATTERS'),
('menu-home-subitem-11-label', 'it', 'ASSISTENZA E PATROCINIO IN MATERIA TRIBUTARIA'),
('menu-home-subitem-11-label', 'ro', ''),
('menu-home-subitem-12-label', 'en', 'COMPANY CONSULTING'),
('menu-home-subitem-12-label', 'it', 'CONSULENZE SOCIETARIE'),
('menu-home-subitem-12-label', 'ro', ''),
('menu-home-subitem-13-label', 'en', 'MEDIATION'),
('menu-home-subitem-13-label', 'it', 'MEDIAZIONI'),
('menu-home-subitem-13-label', 'ro', ''),
('menu-home-subitem-14-label', 'en', 'LEGAL REVISION'),
('menu-home-subitem-14-label', 'it', 'REVISIONI LEGALI'),
('menu-home-subitem-14-label', 'ro', 'REVIZOR DE CONTURI'),
('menu-home-subitem-15-label', 'en', 'PERIZIE E VALUTAZIONI'),
('menu-home-subitem-16-label', 'en', ''),
('menu-home-subitem-17-label', 'en', 'SURVEYS AND ASSESSMENTS'),
('menu-home-subitem-17-label', 'it', 'PERIZIE E VALUTAZIONI'),
('menu-home-subitem-17-label', 'ro', 'EXPERTIZE SI EVALUARI'),
('menu-home-subitem-18-label', 'en', 'ATTIVITA STUDIO SANUA'),
('menu-home-subitem-18-label', 'it', 'ATTIVITA STUDIO SANUA'),
('menu-home-subitem-18-label', 'ro', ''),
('menu-home-subitem-19-label', 'en', 'CONTABILITA’ E BILANCIO'),
('menu-home-subitem-19-label', 'it', 'CONTABILITA’ E BILANCIO'),
('menu-home-subitem-19-label', 'ro', ''),
('menu-home-subitem-20-label', 'en', 'ADEMPIMENTI TRIBUTARI'),
('menu-home-subitem-20-label', 'it', 'ADEMPIMENTI TRIBUTARI'),
('menu-home-subitem-20-label', 'ro', ''),
('menu-home-subitem-21-label', 'en', 'PRACTICE.'),
('menu-home-subitem-21-label', 'it', 'PRATICHE'),
('menu-home-subitem-21-label', 'ro', 'PRACTICI'),
('menu-home-subitem-22-label', 'en', 'CONTRACTS.'),
('menu-home-subitem-22-label', 'it', 'CONTRATTI'),
('menu-home-subitem-22-label', 'ro', 'CONTRACTE.'),
('menu-home-subitem-23-label', 'en', 'ASSISTANCE AND PATRONAGE ON FISCAL MATTERS'),
('menu-home-subitem-23-label', 'it', 'ASSISTENZA E PATROCINIO IN MATERIA TRIBUTARIA'),
('menu-home-subitem-23-label', 'ro', 'ASISTENȚĂ ȘI PATRONAJ IN DOMENIUL FISCAL'),
('menu-home-subitem-24-label', 'en', 'COMPANY CONSULTING.'),
('menu-home-subitem-24-label', 'it', 'CONSULENZE SOCIETARIE'),
('menu-home-subitem-24-label', 'ro', 'CONSULTANTA CATRE SOCIETATI'),
('menu-home-subitem-25-label', 'en', 'MEDIATIONS.'),
('menu-home-subitem-25-label', 'it', 'MEDIAZIONI'),
('menu-home-subitem-25-label', 'ro', 'MEDIERE'),
('menu-home-subitem-26-label', 'en', 'REVISIONI LEGALI'),
('menu-home-subitem-26-label', 'it', 'REVISIONI LEGALI'),
('menu-home-subitem-26-label', 'ro', ''),
('menu-home-subitem-27-label', 'en', 'SURVEYS AND ASSESSMENTS.'),
('menu-home-subitem-27-label', 'it', 'PERIZIE E VALUTAZIONI'),
('menu-home-subitem-27-label', 'ro', 'EXPERTIZE SI EVALUARI'),
('menu-home-subitem-59-label', 'en', 'PRACTICE'),
('menu-home-subitem-59-label', 'it', 'PRATICHE'),
('menu-home-subitem-59-label', 'ro', 'PRACTICI'),
('menu-home-subitem-6-label', 'en', 'ATTIVITA STUDIO SANUA'),
('menu-home-subitem-6-label', 'it', 'ATTIVITA'' STUDIO SANUA'),
('menu-home-subitem-60-label', 'en', 'CONTRACTS'),
('menu-home-subitem-60-label', 'it', 'CONTRATTI'),
('menu-home-subitem-60-label', 'ro', 'CONTRACTE'),
('menu-home-subitem-61-label', 'en', 'PATRONAGE AND ASSISTENCE IN TAX MATTERS'),
('menu-home-subitem-61-label', 'it', 'ASSISTENZA E PATRONCINIO IN MATERIA TRIBUTARIA'),
('menu-home-subitem-61-label', 'ro', 'PATRONAT SI ASISTENTA IN MATERIE FISCALA'),
('menu-home-subitem-62-label', 'en', 'COMPANY CONSULTING'),
('menu-home-subitem-62-label', 'it', 'CONSULENZA SOCIETARIA'),
('menu-home-subitem-62-label', 'ro', 'CONSULTANTA SOCIETATI'),
('menu-home-subitem-63-label', 'en', 'MEDIATIONS'),
('menu-home-subitem-63-label', 'it', 'MEDIAZIONI'),
('menu-home-subitem-63-label', 'ro', 'MEDIERI'),
('menu-home-subitem-64-label', 'en', 'SURVEYS AND ASSESSMENTS'),
('menu-home-subitem-64-label', 'it', 'PERIZIE E VALUTAZIONI'),
('menu-home-subitem-64-label', 'ro', 'EXPERTIZE SI EVALUARI'),
('menu-home-subitem-65-label', 'en', 'JOBS'),
('menu-home-subitem-65-label', 'it', 'LAVORO'),
('menu-home-subitem-65-label', 'ro', 'JOBURI'),
('menu-home-subitem-66-label', 'en', 'BUSINESS PROPOSALS'),
('menu-home-subitem-66-label', 'it', 'PROPOSTE D''AFFARI'),
('menu-home-subitem-66-label', 'ro', 'PROPUNERI DE AFACERI'),
('menu-home-subitem-67-label', 'en', 'ASSOCIATIONS'),
('menu-home-subitem-67-label', 'it', 'ASSOCIAZIONI'),
('menu-home-subitem-67-label', 'ro', 'ASOCIATII'),
('menu-home-subitem-68-label', 'en', 'VARIOUS'),
('menu-home-subitem-68-label', 'it', 'DIVERSE'),
('menu-home-subitem-68-label', 'ro', 'DIVERSE'),
('menu-home-subitem-7-label', 'en', 'ACCOUNTING & FINANCIAL STATEMENTS'),
('menu-home-subitem-7-label', 'it', 'CONTABILITA’ E BILANCIO'),
('menu-home-subitem-7-label', 'ro', 'CONTABILITATE SI BILANT.'),
('menu-home-subitem-8-label', 'en', 'TAX COMPLIANCE'),
('menu-home-subitem-8-label', 'it', 'ADEMPIMENTI TRIBUTARI'),
('menu-home-subitem-8-label', 'ro', 'RESPECTARE OBLIGATII FISCALE'),
('menu-home-subitem-9-label', 'en', 'PRATICHE'),
('menu-home-subitem-9-label', 'it', 'PRATICHE'),
('menu-practice-item-14-label', 'en', 'Company support.'),
('menu-practice-item-14-label', 'it', 'Assistenza società.'),
('menu-practice-item-14-label', 'ro', 'Asistenta societati'),
('menu-practice-item-17-label', 'en', 'Contracts'),
('menu-practice-item-17-label', 'it', 'Contratti'),
('menu-practice-item-17-label', 'ro', 'Contracte'),
('menu-practice-item-18-label', 'en', 'Surveys and assesments'),
('menu-practice-item-18-label', 'it', 'Perizie e Valutazioni'),
('menu-practice-item-18-label', 'ro', 'Expertize si evaluari'),
('menu-practice-item-19-label', 'en', 'Lorem ipsum dolor sit amet.'),
('menu-practice-item-20-label', 'en', 'Lorem ipsum dolor sit amet.'),
('menu-practice-item-21-label', 'en', 'Lorem ipsum dolor sit amet.'),
('menu-practice-item-21-label', 'it', ''),
('menu-practice-item-56-label', 'en', 'Office Activity'),
('menu-practice-item-56-label', 'it', 'Attività Ufficio'),
('menu-practice-item-56-label', 'ro', 'Activitate Oficiu'),
('menu-practice-subitem-28-label', 'en', 'Lorem ipsum dolor sit amet.'),
('menu-practice-subitem-29-label', 'en', 'Lorem ipsum dolor sit amet.'),
('menu-practice-subitem-30-label', 'en', 'Lorem ipsum dolor sit amet.'),
('menu-practice-subitem-31-label', 'en', 'Lorem ipsum dolor sit amet.'),
('menu-practice-subitem-31-label', 'it', ''),
('menu-practice-subitem-32-label', 'en', 'Lorem ipsum dolor sit amet.'),
('menu-practice-subitem-32-label', 'it', ''),
('menu-practice-subitem-33-label', 'en', 'Lorem ipsum dolor sit amet.'),
('menu-practice-subitem-33-label', 'it', ''),
('menu-practice-subitem-4-label', 'en', ''),
('menu-practice-subitem-40-label', 'en', 'Activities openings'),
('menu-practice-subitem-40-label', 'it', 'Aperture attività'),
('menu-practice-subitem-40-label', 'ro', 'Deschidere activitate'),
('menu-practice-subitem-41-label', 'en', 'Changes in activity'),
('menu-practice-subitem-41-label', 'it', 'Variazione attività'),
('menu-practice-subitem-41-label', 'ro', 'Variatii activitate'),
('menu-practice-subitem-42-label', 'en', 'Cessation activities'),
('menu-practice-subitem-42-label', 'it', 'Cessazione attività'),
('menu-practice-subitem-42-label', 'ro', 'Inchidere activitate'),
('menu-practice-subitem-43-label', 'it', ''),
('menu-practice-subitem-44-label', 'en', 'Leasing'),
('menu-practice-subitem-44-label', 'it', 'Locazioni'),
('menu-practice-subitem-44-label', 'ro', 'Leasing'),
('menu-practice-subitem-45-label', 'it', 'Affiti'),
('menu-practice-subitem-46-label', 'en', 'Rents'),
('menu-practice-subitem-46-label', 'it', 'Affiti'),
('menu-practice-subitem-46-label', 'ro', 'Inchiriere'),
('menu-practice-subitem-47-label', 'en', 'Commercial'),
('menu-practice-subitem-47-label', 'it', 'Commerciali'),
('menu-practice-subitem-47-label', 'ro', 'Comerciale'),
('menu-practice-subitem-48-label', 'en', 'Scriptures and Departures'),
('menu-practice-subitem-48-label', 'it', 'Scritture e Cessioni'),
('menu-practice-subitem-48-label', 'ro', 'Inscrisuri si cedari'),
('menu-practice-subitem-49-label', 'en', 'Succession'),
('menu-practice-subitem-49-label', 'it', 'Successioni'),
('menu-practice-subitem-49-label', 'ro', 'Succesiuni'),
('menu-practice-subitem-5-label', 'en', ''),
('menu-practice-subitem-50-label', 'en', 'Wages and Contributions'),
('menu-practice-subitem-50-label', 'it', 'Paghe e Contributi'),
('menu-practice-subitem-50-label', 'ro', 'Plati si contributii'),
('menu-practice-subitem-51-label', 'en', 'Accounting expertise'),
('menu-practice-subitem-51-label', 'it', 'Perizie contabili'),
('menu-practice-subitem-51-label', 'ro', 'Expertiza contabila'),
('menu-practice-subitem-52-label', 'en', 'Heritage assessments'),
('menu-practice-subitem-52-label', 'it', 'Valutazioni patrimonio'),
('menu-practice-subitem-52-label', 'ro', 'Evaluari patrimoniu'),
('menu-practice-subitem-53-label', 'en', 'Shares valuation'),
('menu-practice-subitem-53-label', 'it', 'Valutazioni quote sociali'),
('menu-practice-subitem-53-label', 'ro', 'Evaluare parti sociale'),
('menu-practice-subitem-72-label', 'en', 'About us'),
('menu-practice-subitem-72-label', 'it', 'Chi siamo'),
('menu-practice-subitem-72-label', 'ro', 'Despre noi'),
('menu-practice-subitem-73-label', 'en', 'Communications'),
('menu-practice-subitem-73-label', 'it', 'Comunicazioni'),
('menu-practice-subitem-73-label', 'ro', 'Comunicari'),
('menu-practice-subitem-74-label', 'en', 'Fiscal calendar'),
('menu-practice-subitem-74-label', 'it', 'Scadenzario Fiscale'),
('menu-practice-subitem-74-label', 'ro', 'Calendar Fiscal'),
('menu-practice-subitem-75-label', 'en', 'Attestation'),
('menu-practice-subitem-75-label', 'it', 'Attestazioni'),
('menu-practice-subitem-75-label', 'ro', 'Atestate'),
('menu-practice-subitem-76-label', 'en', 'Mandates-Proxies'),
('menu-practice-subitem-76-label', 'it', 'Deleghe e Mandati'),
('menu-practice-subitem-76-label', 'ro', 'Imputerniciri si Mandate'),
('menu-practice-subitem-77-label', 'en', 'Appointments'),
('menu-practice-subitem-77-label', 'it', 'Nomine'),
('menu-practice-subitem-77-label', 'ro', 'Numiri'),
('menu-practice-subitem-78-label', 'en', 'Privacy'),
('menu-practice-subitem-78-label', 'it', 'Privacy'),
('menu-practice-subitem-78-label', 'ro', 'Privacy'),
('menu-resources-item-12-label', 'en', 'Investors'),
('menu-resources-item-12-label', 'it', 'Investitori'),
('menu-resources-item-12-label', 'ro', 'Investitori'),
('menu-resources-item-22-label', 'en', 'Business Leaders'),
('menu-resources-item-22-label', 'it', 'Imprenditori'),
('menu-resources-item-22-label', 'ro', 'Antreprenori'),
('menu-resources-item-23-label', 'en', 'Freelancers'),
('menu-resources-item-23-label', 'it', 'Profesionisti'),
('menu-resources-item-23-label', 'ro', 'Profesionisti'),
('menu-resources-item-24-label', 'en', 'Economists'),
('menu-resources-item-24-label', 'it', 'Economisti'),
('menu-resources-item-24-label', 'ro', 'Economisti'),
('menu-resources-item-25-label', 'en', 'Docents & Students'),
('menu-resources-item-25-label', 'it', 'Docenti e Studenti'),
('menu-resources-item-25-label', 'ro', 'Docenti & Studenti'),
('menu-resources-item-35-label', 'en', 'Consumers & Privates'),
('menu-resources-item-35-label', 'it', 'Consumatori e Privati'),
('menu-resources-item-35-label', 'ro', 'Consumatori & Privati'),
('menu-resources-item-5-label', 'en', 'uuu'),
('menu-resources-subitem-1-label', 'en', 'asd'),
('menu-resources-subitem-2-label', 'en', NULL),
('menu-resources-subitem-3-label', 'en', NULL),
('menu-resources-subitem-34-label', 'en', 'Resources'),
('menu-resources-subitem-34-label', 'it', 'Risorse '),
('menu-resources-subitem-34-label', 'ro', 'Resurse Umane'),
('menu-resources-subitem-35-label', 'en', 'Documentations'),
('menu-resources-subitem-35-label', 'it', 'Documentazioni'),
('menu-resources-subitem-35-label', 'ro', 'Documentatii'),
('menu-resources-subitem-36-label', 'en', 'Service'),
('menu-resources-subitem-36-label', 'it', 'Servizi'),
('menu-resources-subitem-36-label', 'ro', 'Servicii'),
('menu-resources-subitem-37-label', 'en', 'Resources'),
('menu-resources-subitem-37-label', 'it', ''),
('menu-resources-subitem-37-label', 'ro', ''),
('menu-resources-subitem-38-label', 'en', 'Documentations'),
('menu-resources-subitem-38-label', 'it', ''),
('menu-resources-subitem-38-label', 'ro', ''),
('menu-resources-subitem-39-label', 'en', 'Service'),
('menu-resources-subitem-39-label', 'it', ''),
('menu-resources-subitem-39-label', 'ro', ''),
('menu-resources-subitem-40-label', 'en', ''),
('menu-resources-subitem-54-label', 'en', 'Shop'),
('menu-resources-subitem-55-label', 'en', 'Shop'),
('menu-resources-subitem-55-label', 'it', 'Shop'),
('menu-resources-subitem-55-label', 'ro', 'Shop'),
('menu-resources-subitem-56-label', 'en', 'Newsleters'),
('menu-resources-subitem-56-label', 'it', 'Notizzie'),
('menu-resources-subitem-56-label', 'ro', 'Stiri'),
('menu-resources-subitem-57-label', 'en', 'Shop'),
('menu-resources-subitem-58-label', 'en', 'Newsleters'),
('menu-service-item-13-label', 'en', 'ACCOUNTING & FINANCIAL STATEMENTS'),
('menu-service-item-13-label', 'it', 'CONTABILITA'' E BILANCIO'),
('menu-service-item-13-label', 'ro', 'CONTABILITATE SI BILANT.'),
('menu-service-item-26-label', 'en', 'TAX COMPLIANCE'),
('menu-service-item-26-label', 'it', 'ADEMPIMENTI TRIBUTARI'),
('menu-service-item-26-label', 'ro', 'RESPECTARE OBLIGATII FISCALE'),
('menu-service-item-27-label', 'en', ''),
('menu-service-item-27-label', 'it', 'CONTRATTI'),
('menu-service-item-28-label', 'en', 'PATRONAGE AND ASSISTENCE IN TAX MATTERS'),
('menu-service-item-28-label', 'it', 'ASSISTENZA E PATRONCINIO.'),
('menu-service-item-28-label', 'ro', 'PATRONAT SI ASISTENTA IN MATERIE FISCALA'),
('menu-service-item-29-label', 'en', 'COMPANY CONSULTING'),
('menu-service-item-29-label', 'it', 'CONSULENZE'),
('menu-service-item-29-label', 'ro', 'CONSULTANTA SOCIETATI'),
('menu-service-item-30-label', 'en', 'MEDIATIONS'),
('menu-service-item-30-label', 'it', 'MEDIAZIONI'),
('menu-service-item-30-label', 'ro', 'MEDIERE'),
('menu-service-item-31-label', 'en', 'LEGAL REVISION'),
('menu-service-item-31-label', 'it', 'REVISIONI LEGALI'),
('menu-service-item-31-label', 'ro', 'REVIZOR DE CONTUR'),
('menu-service-item-32-label', 'en', ''),
('menu-service-item-33-label', 'en', ''),
('menu-service-item-34-label', 'en', ''),
('menu-service-item-34-label', 'it', 'Studii e Ricerche'),
('metainfo-contact-description', 'it', ''),
('metainfo-contact-keywords', 'it', ''),
('metainfo-contact-title', 'it', 'Contact, StudioSanua'),
('metainfo-home-description', 'en', 'descen'),
('metainfo-home-description', 'it', ''),
('metainfo-home-description', 'ro', 'descro'),
('metainfo-home-keywords', 'en', 'keyen'),
('metainfo-home-keywords', 'it', ''),
('metainfo-home-keywords', 'ro', 'keyro'),
('metainfo-home-title', 'en', 'Studio Sanua, Torino'),
('metainfo-home-title', 'it', 'Studio Sanua,Torino'),
('metainfo-home-title', 'ro', 'Studio Sanua, Torino'),
('metainfo-resources-description', 'it', ''),
('metainfo-resources-keywords', 'it', ''),
('metainfo-resources-title', 'it', 'Risorse'),
('metainfo-service-description', 'en', 'Service'),
('metainfo-service-description', 'it', 'Servizi'),
('metainfo-service-keywords', 'en', 'Service'),
('metainfo-service-keywords', 'it', 'Servizi'),
('metainfo-service-title', 'en', 'Service'),
('metainfo-service-title', 'it', 'Servizi'),
('newssection-buttons-more', 'en', 'read more'),
('newssection-buttons-more', 'it', 'di più'),
('newssection-title', 'en', 'News & Events.'),
('newssection-title', 'it', 'Notizie e Evenimenti'),
('pagecontent-copyright', 'en', '<p>All rights reserved @ 2011-2017 &nbsp; &nbsp; | &nbsp; &nbsp; Project by Loghin.com</p>\r\n'),
('pagecontent-copyright', 'it', '<table border="0" cellpadding="0" cellspacing="0" style="height:50%; width:50%">\r\n	<tbody>\r\n		<tr>\r\n			<td>Tutti diritti riservati @ 2011-2017</td>\r\n			<td>Progetto Loghin.com / Italy</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Licenza d&#39;uso non commerciale</td>\r\n			<td>Acces al sistema: Livello 1&deg;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>N&deg;: xxxx xxxx xxxx xxxx</td>\r\n			<td>Serie: MC/DCR</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>\r\n'),
('pagecontent-footer', 'en', '<div>\r\n<div>\r\n<table border="0" style="width:100%">\r\n	<tbody>\r\n		<tr>\r\n			<td style="width:25%">\r\n			<h2>Links</h2>\r\n			</td>\r\n			<td style="width:25%">\r\n			<h2>Join In</h2>\r\n			</td>\r\n			<td style="width:25%">\r\n			<h2>Support</h2>\r\n			</td>\r\n			<td style="width:25%">\r\n			<h2>Credits</h2>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="vertical-align:top">\r\n			<ul>\r\n				<li><a href="../../../contact/">Activity, Users, Groups</a></li>\r\n				<li><a href="../../../contact/">Database &amp; documentations.</a></li>\r\n				<li><a href="../../../contact/">Profiles, Showcase (Look), Social network.</a></li>\r\n				<li><a href="../../../contact/">Istitutions, Companies, Freelancers.</a></li>\r\n				<li><a href="../../../contact/">Products, Services.</a></li>\r\n			</ul>\r\n			</td>\r\n			<td style="vertical-align:top">\r\n			<ul>\r\n				<li><a href="../../../contact/">Credentials to use the system.</a></li>\r\n				<li><a href="../../../contact/">Regiser &amp; Audit from third-persons.</a></li>\r\n				<li><a href="../../../contact/">Istitutions, activities, products and services.</a></li>\r\n				<li><a href="../../../contact/">Management activities and structures.</a></li>\r\n				<li><a href="../../../contact/">Developers, Data-centers and Operators.</a></li>\r\n			</ul>\r\n			</td>\r\n			<td style="vertical-align:top">\r\n			<ul>\r\n				<li><a href="../../../contact/">Accounts &amp; profiles management.</a></li>\r\n				<li><a href="../../../contact/">Data base, documents, web.</a></li>\r\n				<li><a href="../../../contact/">People.</a></li>\r\n				<li><a href="../../../contact/">Istitutions.</a></li>\r\n				<li><a href="../../../contact/">Business.</a></li>\r\n			</ul>\r\n			</td>\r\n			<td style="vertical-align:top">\r\n			<table border="0" style="width:100%">\r\n				<tbody>\r\n					<tr>\r\n						<td style="vertical-align:top">\r\n						<ul>\r\n							<li>\r\n							<h3><a href="../../../contact/">Site manage, Webmaster &amp; Copyright.</a></h3>\r\n							</li>\r\n						</ul>\r\n\r\n						<h3><span style="font-size:12px">Tel / Fax: 011.33.17.06 </span></h3>\r\n\r\n						<h3><span style="font-size:12px">Cell: 340.9.802.802</span></h3>\r\n\r\n						<h3><span style="font-size:12px">Mail: support@loghin.com</span></h3>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n</div>\r\n'),
('pagecontent-footer', 'it', '<table border="0" style="width:100%">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<h2>Link utili</h2>\r\n			</td>\r\n			<td>\r\n			<h2>Aderire</h2>\r\n			</td>\r\n			<td>\r\n			<h2>Supporto</h2>\r\n			</td>\r\n			<td>\r\n			<h2>Crediti</h2>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="vertical-align:top">\r\n			<ul>\r\n				<li><a href="../../../contact/">Attivit&agrave;, Useri, Gruppi.</a></li>\r\n				<li><a href="../../../contact/">Base dati e documentazioni.</a></li>\r\n				<li><a href="../../../contact/">Profili, Vetrine, Social.</a></li>\r\n				<li><a href="../../../contact/">Instituzioni, </a><a href="../../../contact/">Aziende, Profesionisti</a></li>\r\n				<li><a href="../../../contact/">Prodotti e servizi</a></li>\r\n			</ul>\r\n			</td>\r\n			<td style="vertical-align:top">\r\n			<ul>\r\n				<li><a href="../../../contact/">Credenziali per utilizzo sistema.</a></li>\r\n				<li><a href="../../../contact/">Reg. e audit persone e attivit&agrave; terze.</a></li>\r\n				<li><a href="../../../contact/">Istituzioni, attivit&agrave;,&nbsp; prodotti e servizi. </a></li>\r\n				<li><a href="../../../contact/">Adesione e gestione Attivit&agrave; e Strutture.</a></li>\r\n				<li><a href="../../../contact/">Sviluppatori, </a><a href="../../../contact/">Data-center e Operatori</a></li>\r\n			</ul>\r\n			</td>\r\n			<td style="vertical-align:top">\r\n			<ul>\r\n				<li><a href="../../../contact/">Gestione accounts, profili, strutture.</a></li>\r\n				<li><a href="../../../contact/">Base dati, Documenti, Web</a></li>\r\n				<li><a href="../../../contact/">Persone.</a></li>\r\n				<li><a href="../../../contact/">Istituzioni.</a></li>\r\n				<li><a href="../../../contact/">Business.</a></li>\r\n			</ul>\r\n			</td>\r\n			<td style="vertical-align:top">\r\n			<ul>\r\n				<li>\r\n				<h3><a href="../../../contact/">Gestione sito, webmaster &amp; copyright.</a></h3>\r\n				</li>\r\n			</ul>\r\n\r\n			<h3><span style="font-size:12px">Tel / Fax: 011.33.17.06 </span></h3>\r\n\r\n			<h3><span style="font-size:12px">Cell: 340.9.802.802</span></h3>\r\n\r\n			<h3><span style="font-size:12px">Mail: support@loghin.com</span></h3>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n'),
('pagecontent-header', 'en', '<ul style="margin-left:40px">\r\n	<li>Tecnical Adviser to the Judge</li>\r\n	<li>Auditor</li>\r\n	<li>Consultant in contractual matters</li>\r\n	<li>Civil and commercial mediator</li>\r\n	<li>Advisor on corporate matters</li>\r\n</ul>\r\n'),
('pagecontent-header', 'it', '<ul style="margin-left:40px">\r\n	<li>Consulente tecnico del Giudice</li>\r\n	<li>Revisore Contabile</li>\r\n	<li>Consulente in Materia Contrattuale</li>\r\n	<li>Mediatore Civile e Commerciale</li>\r\n	<li>Consulente in Materia Societaria</li>\r\n</ul>\r\n'),
('pagecontent-header', 'ro', '<ul style="margin-left:40px">\r\n	<li>Consultant tehnic al Judecatorului</li>\r\n	<li>Revizor Contabil</li>\r\n	<li>Consultant in Materie Contractuala</li>\r\n	<li>Mediator Civil si Comercial</li>\r\n	<li>Consultant in Materie Societara</li>\r\n</ul>\r\n'),
('pagecontent-home', 'en', '<h2>STUDIO SANUA ACTIVITY</h2>\r\n\r\n<table border="0" cellpadding="10" cellspacing="1" style="height:50%; width:100%">\r\n	<tbody>\r\n		<tr>\r\n			<td><img alt="" src="http://contabilitate.loghin.com/uploads/article_image.png" /></td>\r\n			<td>\r\n			<p style="margin-left:40px">&nbsp;&nbsp; &nbsp;<span style="color:#4e5f70"><span style="font-size:16px"><span style="font-family:Lucida Sans Unicode,Lucida Grande,sans-serif"><strong>&bull; Overview of activities carried by our study.</strong></span></span></span></p>\r\n\r\n			<p style="margin-left:40px">&nbsp;</p>\r\n\r\n			<p style="margin-left:40px">&nbsp;&nbsp;&nbsp;&nbsp; The firm has been operating for over twenty years and offers a wide range of quality consultation restaurants to custom ....&nbsp; <a href="http://contabilitate.loghin.com/home">more info</a></p>\r\n\r\n			<p>&nbsp;</p>\r\n\r\n			<p style="margin-left:40px">&nbsp; &nbsp; &nbsp; It follows appraisals and valuations for accounting, both in the form of advice to the Court, both on behalf of the parties ......&nbsp; <a href="http://contabilitate.loghin.com/service">more info</a></p>\r\n\r\n			<p style="margin-left:40px">&nbsp;&nbsp;</p>\r\n\r\n			<p style="margin-left:40px">&nbsp;&nbsp;&nbsp; &nbsp; It ensures the field in tax advocacy, formulas and bring actions the Provincial Tax Commission and Regional and assists .....&nbsp; <a href="http://contabilitate.loghin.com/practice">more info</a></p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<hr />\r\n<div>\r\n<table border="0" cellpadding="1" cellspacing="1" style="height:64px; width:100%">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<h3><span style="font-size:16px"><strong><span style="color:#4e5f70"><em><span style="font-family:Times New Roman,Times,serif">DESTINATARI DELLE ATTIVITA&#39; </span></em></span></strong></span></h3>\r\n\r\n			<h3><span style="font-size:16px"><strong><span style="color:#4e5f70"><em><span style="font-family:Times New Roman,Times,serif">SVOLTE DA NOSTRO STUDIO</span></em></span></strong></span></h3>\r\n			</td>\r\n			<td>\r\n			<table align="left" border="0" cellpadding="1" cellspacing="1" style="height:100%; width:100%">\r\n				<tbody>\r\n					<tr>\r\n						<td>\r\n						<h4><span style="font-family:Times New Roman,Times,serif">&bull;&nbsp; SOCIETA&#39;</span></h4>\r\n						</td>\r\n						<td>\r\n						<h4><span style="font-family:Times New Roman,Times,serif">&bull;&nbsp; PROFESIONISTI</span></h4>\r\n						</td>\r\n						<td>\r\n						<h4><span style="font-family:Times New Roman,Times,serif">&bull;&nbsp; DITE INDIVIDUALI</span></h4>\r\n						</td>\r\n					</tr>\r\n					<tr>\r\n						<td>\r\n						<h4><span style="font-family:Times New Roman,Times,serif">&bull;&nbsp; PRIVATI</span></h4>\r\n						</td>\r\n						<td>\r\n						<h4><span style="font-family:Times New Roman,Times,serif">&bull;&nbsp; ASSOCIAZIONI</span></h4>\r\n						</td>\r\n						<td>\r\n						<h4><span style="font-family:Times New Roman,Times,serif">&bull;&nbsp; ENTI&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="http://www.loghin.com">vedi tutti</a></span></h4>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n\r\n<div><a class="button big left" href="../../../"><strong>MORE</strong></a></div>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n'),
('pagecontent-home', 'it', '<h2>ATTIVITA&#39; STUDIO SANUA</h2>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<p><img class="left" src="../../../../uploads/article_image.png" style="height:155px; width:192px" /></p>\r\n			</td>\r\n			<td style="vertical-align:top">\r\n			<p style="margin-left:40px"><span style="color:#4e5f70"><span style="font-size:16px"><span style="font-family:Lucida Sans Unicode,Lucida Grande,sans-serif"><strong>&bull; Panoramica attivit&agrave; svolte dall nostro studio</strong>.</span></span></span><span style="font-size:14px"> </span></p>\r\n\r\n			<p style="text-align:center">&nbsp;</p>\r\n\r\n			<p style="margin-left:40px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Lo Studio opera da oltre venti anni e offre un&#39;ampia gama di servizi alla clientela, che spazia dalla cons......&nbsp; <a href="http://contabilitate.loghin.com/page/practice/56/72">di pi&ugrave;</a></p>\r\n\r\n			<p>&nbsp;</p>\r\n\r\n			<p style="margin-left:40px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Segue perizie e valutazioni in materia contabile, sia sotto forma di consulenza per il Tribunale, sia per conto delle parti previo speci.....&nbsp; <a href="http://contabilitate.loghin.com/page/practice/18/51">di pi&ugrave;</a></p>\r\n\r\n			<p>&nbsp;</p>\r\n\r\n			<p style="margin-left:40px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Assiccura il patrocinio in campo tributario, formule e ricorsi avanti le Commissione Tributarie Provinciali e Regionali ed assist.......&nbsp; <a href="http://contabilitate.loghin.com/page/service/28">di pi&ugrave;</a></p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<hr />\r\n<div>\r\n<table border="0" cellpadding="1" cellspacing="1">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<h3><span style="font-size:16px"><strong><em><span style="font-family:Times New Roman,Times,serif">DESTINATARI DELLE ATTIVITA&#39; </span></em></strong></span></h3>\r\n\r\n			<h3><span style="font-size:16px"><strong><em><span style="font-family:Times New Roman,Times,serif">SVOLTE DA NOSTRO STUDIO</span></em></strong></span></h3>\r\n			</td>\r\n			<td>\r\n			<table align="left" border="0" cellpadding="1" cellspacing="1" style="height:100%; width:100%">\r\n				<tbody>\r\n					<tr>\r\n						<td>\r\n						<h4 style="margin-left:40px; text-align:justify"><a href="http://contabilitate.loghin.com/page/resources/22/37"><span style="color:#2c3e50"><span style="font-size:16px"><span style="font-family:Times New Roman,Times,serif">&rArr; AZIENDE</span></span></span></a></h4>\r\n						</td>\r\n						<td>\r\n						<h4 style="margin-left:40px"><a href="http://contabilitate.loghin.com/page/resources/23"><span style="color:#2c3e50"><span style="font-size:16px"><span style="font-family:Times New Roman,Times,serif">&rArr; PROFESIONISTI</span></span></span></a></h4>\r\n						</td>\r\n					</tr>\r\n					<tr>\r\n						<td>\r\n						<h4 style="margin-left:40px"><a href="http://contabilitate.loghin.com/page/resources/22/37"><span style="color:#2c3e50"><span style="font-size:16px"><span style="font-family:Times New Roman,Times,serif">&rArr; DITE INDIVIDUALI</span></span></span></a></h4>\r\n						</td>\r\n						<td>\r\n						<h4 style="margin-left:40px"><a href="http://contabilitate.loghin.com/page/resources/24"><span style="color:#2c3e50"><span style="font-size:16px"><span style="font-family:Times New Roman,Times,serif">&rArr; ASSOCIAZIONI</span></span></span></a></h4>\r\n						</td>\r\n					</tr>\r\n					<tr>\r\n						<td>\r\n						<h4 style="margin-left:40px"><a href="http://contabilitate.loghin.com/page/resources/35"><span style="color:#2c3e50"><span style="font-size:16px"><span style="font-family:Times New Roman,Times,serif">&rArr; PRIVATI</span></span></span></a></h4>\r\n						</td>\r\n						<td>\r\n						<h4 style="margin-left:40px"><span style="font-size:16px"><span style="font-family:Times New Roman,Times,serif"><a href="http://contabilitate.loghin.com/page/resources/25"><span style="color:#2c3e50">&rArr; ENTI</span></a></span></span><span style="color:#2c3e50"><span style="font-size:16px"><span style="font-family:Times New Roman,Times,serif">&nbsp;</span></span>&nbsp;&nbsp;&nbsp;&nbsp; </span></h4>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n\r\n<div>&nbsp;<a class="button big left" href="../../../"><strong>Vedi Tutto</strong></a></div>\r\n\r\n<div>&nbsp;</div>\r\n\r\n<div>&nbsp;</div>\r\n'),
('pagecontent-home', 'ro', '<h2>ACTIVITATEA STUDIO-ului SANUA</h2>\r\n\r\n<table border="0" cellpadding="10" cellspacing="1" style="height:50%; width:100%">\r\n	<tbody>\r\n		<tr>\r\n			<td><img alt="" src="http://contabilitate.loghin.com/uploads/article_image.png" /></td>\r\n			<td>\r\n			<p style="margin-left:40px">&nbsp;<span style="color:#4e5f70"><span style="font-size:16px"><span style="font-family:Lucida Sans Unicode,Lucida Grande,sans-serif"><strong>&bull; Panoramica activitati oficiului nostru</strong>.</span></span></span></p>\r\n\r\n			<p style="margin-left:40px">&nbsp;</p>\r\n\r\n			<p>&nbsp;&nbsp; Societatea noastra opereaza in domeniu de peste douăzeci de ani și oferă o gamă largă de servicii de calitate clienților, variind de la consult.... <a href="http://contabilitate.loghin.com/resources">mai mult</a></p>\r\n\r\n			<p>&nbsp;</p>\r\n\r\n			<p>&nbsp;&nbsp;&nbsp;&nbsp; Efectueaza expertize și evaluări pentru contabilitate, at&acirc;t sub formă de consultanță pentru Tribunal, cit si &icirc;n contul părților la solic....&nbsp; <a href="http://contabilitate.loghin.com/service">mai mult</a></p>\r\n\r\n			<p>&nbsp;</p>\r\n\r\n			<p>&nbsp;&nbsp;&nbsp;&nbsp; Asigură patronat in domeniul fiscal, formule și acțiuni de recurs in fata Comisiei Tributare Provinciale și Regionale sau asistenta client ......&nbsp; <a href="http://contabilitate.loghin.com/practice">mai mult</a></p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<hr />\r\n<div>\r\n<table border="0" cellpadding="1" cellspacing="1" style="height:64px; width:100%">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<h3><span style="font-size:16px"><strong><span style="color:#4e5f70"><em><span style="font-family:Times New Roman,Times,serif">DESTINATARI ACTIVITATILOR</span></em></span></strong></span></h3>\r\n\r\n			<h3><span style="font-size:16px"><strong><span style="color:#4e5f70"><em><span style="font-family:Times New Roman,Times,serif">PRACTICATE DE OFICIU.</span></em></span></strong></span></h3>\r\n			</td>\r\n			<td>\r\n			<table align="left" border="0" cellpadding="1" cellspacing="1" style="height:100%; width:100%">\r\n				<tbody>\r\n					<tr>\r\n						<td>\r\n						<h4><span style="font-family:Times New Roman,Times,serif">&bull;&nbsp; SOCIETATI</span></h4>\r\n						</td>\r\n						<td>\r\n						<h4><span style="font-family:Times New Roman,Times,serif">&bull;&nbsp; PROFESIONISTI</span></h4>\r\n						</td>\r\n						<td>\r\n						<h4><span style="font-family:Times New Roman,Times,serif">&bull;&nbsp; FIRME INDIVIDUALE</span></h4>\r\n						</td>\r\n					</tr>\r\n					<tr>\r\n						<td>\r\n						<h4><span style="font-family:Times New Roman,Times,serif">&bull;&nbsp; PRIVATI</span></h4>\r\n						</td>\r\n						<td>\r\n						<h4><span style="font-family:Times New Roman,Times,serif">&bull;&nbsp; ASOCIATII</span></h4>\r\n						</td>\r\n						<td>\r\n						<h4><span style="font-family:Times New Roman,Times,serif">&bull;&nbsp; ALTI &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="http://www.loghin.com">vezi tot</a></span></h4>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n\r\n<div><a class="button big left" href="../../../"><strong>Vezi totul</strong></a></div>\r\n\r\n<div>&nbsp;</div>\r\n\r\n<div>&nbsp;</div>\r\n\r\n<p>&nbsp;</p>\r\n'),
('pagecontent-practice', 'en', '<h2><span style="font-size:24px"><span style="font-family:Times New Roman,Times,serif">Practice Center</span></span></h2>\r\n\r\n<div>\r\n<p>Aenean non turpis vel ipsum porttitor dignissim. In mauris odio, cursus ut bibendum congue, ultrices sit amet odio. Pellentesque erat enim, scelerisque vel imperdiet.</p>\r\n\r\n<p>Quisque posuere dolor sed mauris imperdiet suscipit. Morbi vulputate nulla eu metus condimentum vitae ultrices metus luctus. Vestibulum tempus, risus varius pretium vulputate, odio nulla accumsan mauris, at blandit tortor nisl quis turpis. Vestibulum venenatis rutrum ante, viverra mattis purus mattis sed. Nulla fermentum tempor leo accumsan scelerisque.</p>\r\n\r\n<p><img class="left" src="http://contabilitate.loghin.com/uploads/icon_practice.png" style="float:left; height:98px; width:114px" />Aliquam erat volutpat. Nunc at justo vitae metus gravida varius quis pulvinar elit. Nunc risus arcu, luctus vel porttitor ac, ultricies ac.Pellentesque turpis mi, imperdiet sit amet consequat nec, sodales placerat est. Nullam vel arcu sed enim porta scelerisque. Donec tristique, lorem nec iaculis tristique, ipsum nibh tempus mi, in facilisis quam mauris et lacus.</p>\r\n</div>\r\n\r\n<h3>&nbsp;</h3>\r\n\r\n<h3>&nbsp;</h3>\r\n\r\n<h2>Practice Center</h2>\r\n\r\n<div>\r\n<p>Etiam posuere feugiat leo, vitae gravida erat tincidunt nec. Phasellus lobortis venenatis.</p>\r\n\r\n<p>Varius egestas. Proin a luctus turpis. Praesent ut erat ante. Maecenas aliquet tellus sed magna vulputate a faucibus tellus accumsan. Phasellus sit amet mauris a nibh rutrum dictum ac sit amet magna. Vivamus rhoncus sem eget justo pharetra dictum.</p>\r\n\r\n<table border="0" style="height:48px; width:100%">\r\n	<tbody>\r\n		<tr>\r\n			<td style="vertical-align:top">\r\n			<ul>\r\n				<li><a href="../../../practice/">Lorem ipsum dolor sit amet.</a></li>\r\n				<li>Morbi consequat dapibus.</li>\r\n				<li>Nam pulvinar mi congue.</li>\r\n				<li>Aliquam ut nulla at dolor.</li>\r\n				<li>Curabitur lacinia volutpat.</li>\r\n			</ul>\r\n			</td>\r\n			<td style="vertical-align:top">\r\n			<ul>\r\n				<li>Mauris in eros eget nunc.</li>\r\n				<li>Nam cursus odio sed turpis.</li>\r\n				<li>Maecenas rhoncus condimentum.</li>\r\n				<li>Proin volutpat elit et mi pulvinar luctus.</li>\r\n				<li>In iaculis aliquam tellus, eu vehicula diam.</li>\r\n			</ul>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n\r\n<div>&nbsp;</div>\r\n'),
('pagecontent-practice', 'it', '<h2>Practice Center</h2>\r\n\r\n<div>\r\n<p>Aenean non turpis vel ipsum porttitor dignissim. In mauris odio, cursus ut bibendum congue, ultrices sit amet odio. Pellentesque erat enim, scelerisque vel imperdiet.</p>\r\n\r\n<p>Quisque posuere dolor sed mauris imperdiet suscipit. Morbi vulputate nulla eu metus condimentum vitae ultrices metus luctus. Vestibulum tempus, risus varius pretium vulputate, odio nulla accumsan mauris, at blandit tortor nisl quis turpis. Vestibulum venenatis rutrum ante, viverra mattis purus mattis sed. Nulla fermentum tempor leo accumsan scelerisque.</p>\r\n\r\n<p><img class="left" src="http://contabilitate.loghin.com/uploads/icon_practice.png" style="float:left; height:98px; width:114px" />Aliquam erat volutpat. Nunc at justo vitae metus gravida varius quis pulvinar elit. Nunc risus arcu, luctus vel porttitor ac, ultricies ac.Pellentesque turpis mi, imperdiet sit amet consequat nec, sodales placerat est. Nullam vel arcu sed enim porta scelerisque. Donec tristique, lorem nec iaculis tristique, ipsum nibh tempus mi, in facilisis quam mauris et lacus.</p>\r\n</div>\r\n\r\n<h3>&nbsp;</h3>\r\n\r\n<h3>&nbsp;</h3>\r\n\r\n<h2>Practice Center</h2>\r\n\r\n<div>\r\n<p>Etiam posuere feugiat leo, vitae gravida erat tincidunt nec. Phasellus lobortis venenatis.</p>\r\n\r\n<p>Varius egestas. Proin a luctus turpis. Praesent ut erat ante. Maecenas aliquet tellus sed magna vulputate a faucibus tellus accumsan. Phasellus sit amet mauris a nibh rutrum dictum ac sit amet magna. Vivamus rhoncus sem eget justo pharetra dictum.</p>\r\n\r\n<table border="0">\r\n	<tbody>\r\n		<tr>\r\n			<td style="vertical-align:top">\r\n			<ul>\r\n				<li><a href="../../../practice/">Lorem ipsum dolor sit amet.</a></li>\r\n				<li>Morbi consequat dapibus.</li>\r\n				<li>Nam pulvinar mi congue.</li>\r\n				<li>Aliquam ut nulla at dolor.</li>\r\n				<li>Curabitur lacinia volutpat.</li>\r\n			</ul>\r\n			</td>\r\n			<td style="vertical-align:top">\r\n			<ul>\r\n				<li>Mauris in eros eget nunc.</li>\r\n				<li>Nam cursus odio sed turpis.</li>\r\n				<li>Maecenas rhoncus condimentum.</li>\r\n				<li>Proin volutpat elit et mi pulvinar luctus.</li>\r\n				<li>In iaculis aliquam tellus, eu vehicula diam.</li>\r\n			</ul>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n\r\n<div>&nbsp;</div>\r\n'),
('pagecontent-practice', 'ro', '<p>da</p>'),
('pagecontent-practice-14-40', 'it', '<p>assistenza societa &gt; aperture attivita</p>\r\n'),
('pagecontent-practice-14-41', 'it', '<p>assistenza societa &gt; variazione attivita</p>\r\n'),
('pagecontent-practice-56-72', 'it', '<p><strong><span style="font-size:13.5pt"><span style="color:#2c3e50">Ubicazione Studio Sanua.</span></span></strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style="font-size:12.0pt">L&#39;indirizzo a Torino, in zona Santa Rita in una zona ben servita da mezzi di trasporto e di facile arrivo per chi si sposta con mezzi a disposizione.</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style="font-size:12.0pt">L&#39;ufficio e ubicato in palazzo con portineria e per la protezione dei locali sono stati istallati moderni sistemi di protezione collegati con le forze d&#39;ordine.</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong><span style="font-size:13.5pt"><span style="color:#2c3e50">Attivit&agrave; Studio Sanua.</span></span></strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style="font-size:12.0pt">Lo studio Sanua assicura il patrocinio in campo tributario, formule e ricorsi avanti le Commissione Tributarie Provinciali e Regionali ed assiste le parti nelle fasi dibattimentali.</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style="font-size:12.0pt">Redige contratti e le scritture private e le scritture private nei casi di compravendita da inviare al notaio per l&#39;autenticit&agrave;, elabora le opportunit&agrave; contrattuali esistenti dal punto di vista commerciale e formula ipotesi di convenienza economica, per ogni possibile forma negoziale.</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style="font-size:12.0pt">Il rag. Luca Sanua, titolare dell&#39;omonimo studio &egrave; in possesso di diploma di mediatore civile e commerciale, e per il tramite dei Organismi presso cui e iscritto pu&ograve; svolgere previa minima, le attivit&agrave; di mediatore sulle materia obbligatori, cosi come disciplinante del Dlg. 28 e dai successivi D.M. 180 145.</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style="font-size:12.0pt">Lo studio Sanua, da oltre un ventennio , si occupa della tenuta della contabilit&agrave; delle aziende, in particolare, per coloro che sono collocate, per l&#39;entit&agrave; del fatturato, nel regime azionario, o per specifici, segue le aziende sia nell&#39;impostazione iniziale della contabilit&agrave; (redazione piano dei conti, opportunamente adottato alla specifica realt&agrave;), sia nella gestione ordinaria (rilevazione dei fatti e straordinari) e redazione del bilancio, in conformit&agrave; alle norme del diritto consuntivo.</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong><span style="font-size:13.5pt"><span style="color:#2c3e50">Personale dello studio.</span></span></strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style="font-size:12.0pt">Il rag. Luca Sanua e sindaco di societ&agrave; ed ha conseguito il titolo di revisore contabile, nell&#39;anno...... presso ...................................................</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style="font-family:Arial,Helvetica,sans-serif"><span style="font-size:16px">Professando da oltre venti anni, offre un ampia gamma di servizi ala clientela che spazia dalla consulenza al rilascio di pareri ed alla consulenza contributiva anche in loco.</span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style="font-family:Arial,Helvetica,sans-serif"><span style="font-size:16px">Il rag. Luca Sanua segue perizie e valutazioni in materie contabile, sia sotto forma di consulenza per il Tribunale, sia per conto delle parti previo specifico incarico.</span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style="font-family:Arial,Helvetica,sans-serif"><span style="font-size:16px">Il personale dello studio dispone di una vasta esperienza e preparazione profesionale in grado di svolgere le...................................................</span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n'),
('pagecontent-practice2', 'en', '<p>Studio Sanua operating for over twenty years and offers a wide range of customers wing services, ranging from consulting to issue advisory opinions and the contribution on the spot.</p>\r\n\r\n<p>The rag. Luca Sanua follows appraisals and valuations in accounting matters, both in the form of advice to the Court, both on behalf of the parties subject to specific assignment.</p>\r\n\r\n<p><img src="http://contabilitate.loghin.com/uploads/left_practice.png" style="height:126px; width:296px" /></p>\r\n\r\n<p>&nbsp;</p>\r\n'),
('pagecontent-practice2', 'it', '<p>Lo Studio Sanua opera da oltre venti anni e offre un&#39;ampia gamma di servizi ala clientela, che spazia dalla consulenza al rilascio di pareri ed alla consulenza contributiva anche in loco.</p>\r\n\r\n<p>Il rag. Luca Sanua segue perizie e valutazioni in materie contabile, sia sotto forma di consulenza per il Tribunale, sia per conto delle parti previo specifico incarico.</p>\r\n\r\n<p><img src="http://contabilitate.loghin.com/uploads/left_practice.png" style="height:126px; width:296px" /></p>\r\n'),
('pagecontent-practice2', 'ro', '<p>Studiul Sanua activeaza de peste douazeci de ani oferind o gama ampla de servicii catre clientela, de la consultanta de specialitate la emiterea de pareri si consultanta contributiva in sediu.</p>\r\n\r\n<p>Rag. Luca Sanua executa expertize si evaluari in domeniul contabil, atit sub forma de consultanta pentru Tribunal cit si in contul terzilor pe baza de mandat de imputernicire.</p>\r\n\r\n<p><img src="http://contabilitate.loghin.com/uploads/left_practice.png" style="height:126px; width:296px" /></p>\r\n'),
('pagecontent-resources', 'en', '<h2>Practice Center</h2>\r\n\r\n<div>\r\n<div><strong>Aenean non turpis vel ipsum porttitor dignissim. In mauris odio, cursus ut bibendum congue, ultrices sit amet odio. Pellentesque erat enim, scelerisque vel imperdiet.</strong></div>\r\n\r\n<div>&nbsp;</div>\r\n\r\n<div>Quisque posuere dolor sed mauris imperdiet suscipit. Morbi vulputate nulla eu metus condimentum vitae ultrices metus luctus. Vestibulum tempus, risus varius pretium vulputate, odio nulla accumsan mauris, at blandit tortor nisl quis turpis. Vestibulum venenatis rutrum ante, viverra mattis purus mattis sed. Nulla fermentum tempor leo accumsan scelerisque.</div>\r\n\r\n<p><img class="left" src="http://contabilitate.loghin.com/uploads/icon_practice.png" style="height:98px; width:114px" />Aliquam erat volutpat. Nunc at justo vitae metus gravida varius quis pulvinar elit. Nunc risus arcu, luctus vel porttitor ac, ultricies ac.Pellentesque turpis mi, imperdiet sit amet consequat nec, sodales placerat est. Nullam vel arcu sed enim porta scelerisque. Donec tristique, lorem nec iaculis tristique, ipsum nibh tempus mi, in facilisis quam mauris et lacus.</p>\r\n</div>\r\n\r\n<h3>Practice Center</h3>\r\n\r\n<div>\r\n<p>Etiam posuere feugiat leo, vitae gravida erat tincidunt nec. Phasellus lobortis venenatis.</p>\r\n\r\n<p>Varius egestas. Proin a luctus turpis. Praesent ut erat ante. Maecenas aliquet tellus sed magna vulputate a faucibus tellus accumsan. Phasellus sit amet mauris a nibh rutrum dictum ac sit amet magna. Vivamus rhoncus sem eget justo pharetra dictum</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Etiam posuere feugiat leo, vitae gravida erat tincidunt nec. Phasellus lobortis venenatis.</p>\r\n\r\n<p>Varius egestas. Proin a luctus turpis. Praesent ut erat ante. Maecenas aliquet tellus sed magna vulputate a faucibus tellus accumsan. Phasellus sit amet mauris a nibh rutrum dictum ac sit amet magna. Vivamus rhoncus sem eget justo pharetra dictum</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Etiam posuere feugiat leo, vitae gravida erat tincidunt nec. Phasellus lobortis venenatis.</p>\r\n\r\n<p>Varius egestas. Proin a luctus turpis. Praesent ut erat ante. Maecenas aliquet tellus sed magna vulputate a faucibus tellus accumsan. Phasellus sit amet mauris a nibh rutrum dictum ac sit amet magna. Vivamus rhoncus sem eget justo pharetra dictum</p>\r\n</div>\r\n');
INSERT INTO `acc_languages_content` (`field_key`, `lang`, `value`) VALUES
('pagecontent-resources', 'it', '<h2 class="title">Practice Center</h2>\r\n<div class="cnt">\r\n<p class="bold">Aenean non turpis vel ipsum porttitor dignissim. In mauris odio, cursus ut bibendum congue, ultrices sit amet odio. Pellentesque erat enim, scelerisque vel imperdiet.</p>\r\n<p>Quisque posuere dolor sed mauris imperdiet suscipit. Morbi vulputate nulla eu metus condimentum vitae ultrices metus luctus. Vestibulum tempus, risus varius pretium vulputate, odio nulla accumsan mauris, at blandit tortor nisl quis turpis. Vestibulum venenatis rutrum ante, viverra mattis purus mattis sed. Nulla fermentum tempor leo accumsan scelerisque.</p>\r\n<p><img class="left" src="../../../uploads/icon_practice.png" width="114" height="98" /><span class="bold">Aliquam erat volutpat. Nunc at justo vitae metus gravida varius quis pulvinar elit. Nunc risus arcu, luctus vel porttitor ac, ultricies ac.</span>Pellentesque turpis mi, imperdiet sit amet consequat nec, sodales placerat est. Nullam vel arcu sed enim porta scelerisque. Donec tristique, lorem nec iaculis tristique, ipsum nibh tempus mi, in facilisis quam mauris et lacus.</p>\r\n</div>\r\n<h3 class="title">Practice Center</h3>\r\n<div class="cnt">\r\n<p class="bold">Etiam posuere feugiat leo, vitae gravida erat tincidunt nec. Phasellus lobortis venenatis.</p>\r\n<p>Varius egestas. Proin a luctus turpis. Praesent ut erat ante. Maecenas aliquet tellus sed magna vulputate a faucibus tellus accumsan. Phasellus sit amet mauris a nibh rutrum dictum ac sit amet magna. Vivamus rhoncus sem eget justo pharetra dictum</p>\r\n<p class="empty">&nbsp;</p>\r\n<p class="bold">Etiam posuere feugiat leo, vitae gravida erat tincidunt nec. Phasellus lobortis venenatis.</p>\r\n<p>Varius egestas. Proin a luctus turpis. Praesent ut erat ante. Maecenas aliquet tellus sed magna vulputate a faucibus tellus accumsan. Phasellus sit amet mauris a nibh rutrum dictum ac sit amet magna. Vivamus rhoncus sem eget justo pharetra dictum</p>\r\n<p class="empty">&nbsp;</p>\r\n<p class="bold">Etiam posuere feugiat leo, vitae gravida erat tincidunt nec. Phasellus lobortis venenatis.</p>\r\n<p>Varius egestas. Proin a luctus turpis. Praesent ut erat ante. Maecenas aliquet tellus sed magna vulputate a faucibus tellus accumsan. Phasellus sit amet mauris a nibh rutrum dictum ac sit amet magna. Vivamus rhoncus sem eget justo pharetra dictum</p>\r\n</div>'),
('pagecontent-resources-12-34', 'it', '<p>Investitori &gt; Risorse</p>\r\n'),
('pagecontent-resources-12-35', 'it', '<p>Investitori &gt; Doc</p>\r\n'),
('pagecontent-resources-25-0', 'it', '<p>Docenti e</p>\r\n'),
('pagecontent-service', 'en', '<h3>&nbsp;</h3>\r\n\r\n<h3>Lo Studio Sanua offre i seguenti Servizi:</h3>\r\n\r\n<div>\r\n<ul>\r\n	<li>Consulenze specifiche problematiche gestionali ai fini della contabilit&agrave; aziendale.</li>\r\n	<li>Analisi di bilancio e dei relativi indici.</li>\r\n	<li>Consulenza ed assistenza in merito alla redazione di bilanci periodici infraanuali e consuntivi necessari alla verifica dei propri obbiettivi aziendali.</li>\r\n	<li>Consulenze collegate alle varie fasi della vita societaria con riguardo al dititto societario, commerciale e contrattuale.</li>\r\n</ul>\r\n</div>\r\n\r\n<h3>&nbsp;Adempimenti tributari:</h3>\r\n\r\n<p>Predisposizione ed invio telematico delle seguente dichiarazioni e la loro presentazione telematica:</p>\r\n\r\n<ul>\r\n	<li>Comunicazione annuale IVA.</li>\r\n	<li>Dichiarazione annuale IVA.</li>\r\n	<li>Modello Unico Societ&agrave; e persone fisiche.</li>\r\n	<li>Modello 730.</li>\r\n	<li>Modello 770.</li>\r\n	<li>Modello di pagamento F/24.</li>\r\n	<li>Conteggi ICI.</li>\r\n</ul>\r\n\r\n<h3>Assistenza e patroncinio in materia tributaria:</h3>\r\n\r\n<ul>\r\n	<li>Assistenza nella fase precontenziosa (contradictorio avanti Ag. Entrate)</li>\r\n	<li>scritti e memoriali difensivi.</li>\r\n	<li>Sessioni avanti Ag. Entrate.</li>\r\n	<li>Assistenza nella fase contenziosa (ricorsi avanti le commissioni tributarie Provinciali e regionali)</li>\r\n	<li>Discussioni in pubblica udienza avanti Commissioni Tributarie.</li>\r\n</ul>\r\n\r\n<h3>Consulenze societarie:</h3>\r\n\r\n<p>Consulenze per costituzione societ&agrave;:</p>\r\n\r\n<ul>\r\n	<li>Societ&agrave; di persone (S.N.C., S.A.S., e SOC. SEMPLICI)</li>\r\n	<li>Societ&agrave; di capitali (S.P.A., S.R.L.)</li>\r\n</ul>\r\n\r\n<p>Consulenze per operazioni ordinarie e straordinarie di societ&agrave;.</p>\r\n\r\n<ul>\r\n	<li>Societ&agrave; di persone (cessioni di quote, ingresso di soci, aumento di capitale, liquidazioni, predisposizione di piani di risanamento aziendale).</li>\r\n	<li>Societ&agrave; di capitali (Aumento di capitale, bozza di statuto, fusioni, trasformazioni, liquidazioni, predisposizione di piani di risanamento aziendale)</li>\r\n</ul>\r\n\r\n<h3>Mediazione:</h3>\r\n\r\n<ul>\r\n	<li>Attivit&agrave; di mediazione civile e commerciale, svolta attraverso gli Organismi di mediazione (diploma esequito in ossequio al DLGS 28, ed in attuazione dei D.M. 180, e 145)</li>\r\n</ul>\r\n\r\n<h3>Revisioni Legali:</h3>\r\n\r\n<ul>\r\n	<li>Sindaco di societ&agrave; di capitali.</li>\r\n	<li>Revisore contabile.</li>\r\n</ul>\r\n'),
('pagecontent-service', 'it', '<h3>Lo Studio Sanua offre i seguenti Servizi:</h3>\r\n\r\n<div>\r\n<ul>\r\n	<li>Consulenze specifiche problematiche gestionali ai fini della contabilit&agrave; aziendale.</li>\r\n	<li>Analisi di bilancio e dei relativi indici.</li>\r\n	<li>Consulenza ed assistenza in merito alla redazione di bilanci periodici infraanuali e consuntivi necessari alla verifica dei propri obbiettivi aziendali.</li>\r\n	<li>Consulenze collegate alle varie fasi della vita societaria con riguardo al dititto societario, commerciale e contrattuale.</li>\r\n</ul>\r\n</div>\r\n\r\n<h3>&nbsp;Adempimenti tributari:</h3>\r\n\r\n<p>Predisposizione ed invio telematico delle seguente dichiarazioni e la loro presentazione telematica:</p>\r\n\r\n<ul>\r\n	<li>Comunicazione annuale IVA.</li>\r\n	<li>Dichiarazione annuale IVA.</li>\r\n	<li>Modello Unico Societ&agrave; e persone fisiche.</li>\r\n	<li>Modello 730.</li>\r\n	<li>Modello 770.</li>\r\n	<li>Modello di pagamento F/24.</li>\r\n	<li>Conteggi ICI.</li>\r\n</ul>\r\n\r\n<h3>Assistenza e patroncinio in materia tributaria:</h3>\r\n\r\n<ul>\r\n	<li>Assistenza nella fase precontenziosa (contradictorio avanti Ag. Entrate)</li>\r\n	<li>scritti e memoriali difensivi.</li>\r\n	<li>Sessioni avanti Ag. Entrate.</li>\r\n	<li>Assistenza nella fase contenziosa (ricorsi avanti le commissioni tributarie Provinciali e regionali)</li>\r\n	<li>Discussioni in pubblica udienza avanti Commissioni Tributarie.</li>\r\n</ul>\r\n\r\n<h3>Consulenze societarie:</h3>\r\n\r\n<p>Consulenze per costituzione societ&agrave;:</p>\r\n\r\n<ul>\r\n	<li>Societ&agrave; di persone (S.N.C., S.A.S., e SOC. SEMPLICI)</li>\r\n	<li>Societ&agrave; di capitali (S.P.A., S.R.L.)</li>\r\n</ul>\r\n\r\n<p>Consulenze per operazioni ordinarie e straordinarie di societ&agrave;.</p>\r\n\r\n<ul>\r\n	<li>Societ&agrave; di persone (cessioni di quote, ingresso di soci, aumento di capitale, liquidazioni, predisposizione di piani di risanamento aziendale).</li>\r\n	<li>Societ&agrave; di capitali (Aumento di capitale, bozza di statuto, fusioni, trasformazioni, liquidazioni, predisposizione di piani di risanamento aziendale)</li>\r\n</ul>\r\n\r\n<h3>Mediazione:</h3>\r\n\r\n<ul>\r\n	<li>Attivit&agrave; di mediazione civile e commerciale, svolta attraverso gli Organismi di mediazione (diploma esequito in ossequio al DLGS 28, ed in attuazione dei D.M. 180, e 145)</li>\r\n</ul>\r\n\r\n<h3>Revisioni Legali:</h3>\r\n\r\n<ul>\r\n	<li>Sindaco di societ&agrave; di capitali.</li>\r\n	<li>Revisore contabile.</li>\r\n</ul>\r\n'),
('pagecontent-service-13-0', 'it', '<h2>Contabilit&agrave; e bilancio.</h2>\r\n\r\n<p><span style="font-size:16px"><span style="font-family:Times New Roman,Times,serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Lo Studio Sanua, da ormai un ventenio , si ocupa della tenuta della contabilit&agrave; delle aziende, in particolare, per coloro che sono colocate, per efetto dell&#39;entit&agrave; del fatturato, nel regime azionario, o per specifici, segue le azziende sia nell&#39;impostazione iniziale della contabilit&agrave; (redazione piano dei conti, opportunamente adottato alla spscifica realt&agrave;), sia nella gestione ordinaria (rilevazione dei fatti e straordinati) e redazione del bilancio, in conformit&agrave; alle norme del diritto consuntivo.</span></span></p>\r\n\r\n<p><span style="color:#444444"><strong><span style="font-size:18px"><span style="font-family:Times New Roman,Times,serif">In materia segue i clienti nella:</span></span></strong></span></p>\r\n\r\n<h2><span style="font-family:Tahoma,Geneva,sans-serif"><span style="color:#4e5f70"><span style="font-size:18px">&rarr;&nbsp; Tenuta contabilit&agrave; ordinaria.</span></span></span></h2>\r\n\r\n<p><span style="font-size:16px"><span style="font-family:Times New Roman,Times,serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Lo Studio Sanua,</span></span></p>\r\n\r\n<h2><span style="font-family:Tahoma,Geneva,sans-serif"><span style="color:#4e5f70"><span style="font-size:18px">&rarr; Tenuta contabilit&agrave; semplificata.</span></span></span></h2>\r\n\r\n<p><span style="font-size:16px"><span style="font-family:Times New Roman,Times,serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Lo Studio Sanua, </span></span></p>\r\n\r\n<h2><span style="font-family:Tahoma,Geneva,sans-serif"><span style="color:#4e5f70"><span style="font-size:18px">&rarr; Tenuta contabilit&agrave; professionisti.</span></span></span></h2>\r\n\r\n<p><span style="font-size:16px"><span style="font-family:Times New Roman,Times,serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Lo Studio Sanua,</span></span></p>\r\n\r\n<h2><span style="font-family:Tahoma,Geneva,sans-serif"><span style="color:#4e5f70"><span style="font-size:18px">&rarr; Redazione bilanci.</span></span></span></h2>\r\n\r\n<p><span style="font-size:16px"><span style="font-family:Times New Roman,Times,serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - con servizi annuali e infraanuali e adempimenti di deposito presso la C.C.I.A.A.</span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n'),
('pagecontent-service-26-0', 'it', '<h2>Adempimenti Tributari:</h2>\r\n\r\n<h2><span style="font-size:18px"><span style="font-family:Times New Roman,Times,serif">Predisposizione ed invio telematico delle seguenti dichiarazioni:</span></span></h2>\r\n\r\n<h2><span style="font-size:18px"><span style="font-family:Tahoma,Geneva,sans-serif"><span style="color:#4e5f70">&rarr;&nbsp; Comunicazione annuale IVA e presentazione telematica.</span></span></span></h2>\r\n\r\n<p><span style="font-size:16px"><span style="font-family:Times New Roman,Times,serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - Lo Studio Sanua, </span></span></p>\r\n\r\n<h2><span style="font-family:Tahoma,Geneva,sans-serif"><span style="color:#4e5f70"><span style="font-size:18px">&rarr;&nbsp; Dichiarazione annuale IVA e presentazione telematica.</span></span></span></h2>\r\n\r\n<p><span style="font-size:16px"><span style="font-family:Times New Roman,Times,serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - Lo Studio Sanua, </span></span></p>\r\n\r\n<h2><span style="font-family:Tahoma,Geneva,sans-serif"><span style="color:#4e5f70"><span style="font-size:18px">&rarr;&nbsp; Modello Unico Societ&agrave; e persona fisica e presentazione telematica.</span></span></span></h2>\r\n\r\n<p><span style="font-size:16px"><span style="font-family:Times New Roman,Times,serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - Lo Studio Sanua, </span></span></p>\r\n\r\n<h2><span style="font-family:Tahoma,Geneva,sans-serif"><span style="color:#4e5f70"><span style="font-size:18px">&rarr;&nbsp; Modello 770 e presentazione telematica.</span></span></span></h2>\r\n\r\n<p><span style="font-size:16px"><span style="font-family:Times New Roman,Times,serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - dei sostituti d&#39;imposta e dei condomini con relativa trasmissione telematica.</span></span></p>\r\n\r\n<h2><span style="font-family:Tahoma,Geneva,sans-serif"><span style="color:#4e5f70"><span style="font-size:18px">&rarr;&nbsp; Modello 730 e presentazione telematica.</span></span></span></h2>\r\n\r\n<p><span style="font-size:16px"><span style="font-family:Times New Roman,Times,serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - per dipendenti e pensionati, raccolta documentazione anche in loco e con relativa trasmissione telematica al sostituto d&#39;imposta.</span></span></p>\r\n\r\n<h2><span style="font-family:Tahoma,Geneva,sans-serif"><span style="color:#4e5f70"><span style="font-size:18px">&rarr;&nbsp; Modello di pagamento F / 24 e presentazione telematica.</span></span></span></h2>\r\n\r\n<p><span style="font-size:16px"><span style="font-family:Times New Roman,Times,serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -&nbsp; Lo Studio Sanua, </span></span></p>\r\n\r\n<h2><span style="font-family:Tahoma,Geneva,sans-serif"><span style="color:#4e5f70"><span style="font-size:18px">&rarr;&nbsp; Conteggi ICI.</span></span></span></h2>\r\n\r\n<p><span style="font-size:16px"><span style="font-family:Times New Roman,Times,serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - Lo Studio Sanua, </span></span></p>\r\n'),
('pagecontent-service-28-0', 'it', '<h2>Assistenza e patroncinio.</h2>\r\n\r\n<p><span style="color:#444444"><strong><span style="font-size:18px"><span style="font-family:Times New Roman,Times,serif">In materia tributaria segue i clienti nel&#39;:</span></span></strong></span></p>\r\n\r\n<h2><span style="font-size:18px"><span style="font-family:Tahoma,Geneva,sans-serif"><span style="color:#4e5f70">&rarr;&nbsp; Assistenza nella fase precontenziosa.</span></span></span></h2>\r\n\r\n<p><span style="font-size:16px"><span style="font-family:Times New Roman,Times,serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - per azzioni in contradittorio avanti Ag. Entrate.</span></span></p>\r\n\r\n<h2><span style="font-family:Tahoma,Geneva,sans-serif"><span style="color:#4e5f70"><span style="font-size:18px">&rarr;&nbsp; Scritti e memoriali difensivi.</span></span></span></h2>\r\n\r\n<p><span style="font-size:16px"><span style="font-family:Times New Roman,Times,serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - con servizi di analisi situazioni e redattazione documenti.</span></span></p>\r\n\r\n<h2><span style="font-family:Tahoma,Geneva,sans-serif"><span style="color:#4e5f70"><span style="font-size:18px">&rarr;&nbsp; Sessioni avanti Ag. Entrate.</span></span></span></h2>\r\n\r\n<p><span style="font-size:16px"><span style="font-family:Times New Roman,Times,serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - in qualle segue e accompagna il cliente nelle varie prattiche.</span></span></p>\r\n\r\n<h2><span style="font-family:Tahoma,Geneva,sans-serif"><span style="color:#4e5f70"><span style="font-size:18px">&rarr;&nbsp; Assistenza nella fase contenziosa.</span></span></span></h2>\r\n\r\n<p><span style="font-size:16px"><span style="font-family:Times New Roman,Times,serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - con servizi per ricorsi avanti le commissioni tributarie Provinciali e Regionali </span></span></p>\r\n\r\n<h2><span style="font-family:Tahoma,Geneva,sans-serif"><span style="color:#4e5f70"><span style="font-size:18px">&rarr;&nbsp; Discussioni in publica udienza.</span></span></span></h2>\r\n\r\n<p><span style="font-size:16px"><span style="font-family:Times New Roman,Times,serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - in quale segue e accompagna il cliente nelle varie udienze avanti le Commissioni Tributarie </span></span></p>\r\n'),
('pagecontent-service-29-0', 'it', '<h2>Consulenze societarie.</h2>\r\n\r\n<ul style="margin-left:40px">\r\n	<li><strong><span style="font-size:18px"><span style="font-family:Times New Roman,Times,serif">Consulenze per costituzione societ&agrave;:</span></span></strong></li>\r\n</ul>\r\n\r\n<h2><span style="font-size:18px"><span style="font-family:Tahoma,Geneva,sans-serif"><span style="color:#4e5f70">&rarr;&nbsp; Societ&agrave; di persone.</span></span></span></h2>\r\n\r\n<p><span style="font-size:16px"><span style="font-family:Times New Roman,Times,serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - servizi per costituzione si societ&agrave; di tipo S.N.C., S.A.S., e Soc. Semplici.</span></span></p>\r\n\r\n<h2><span style="font-family:Tahoma,Geneva,sans-serif"><span style="color:#4e5f70"><span style="font-size:18px">&rarr;&nbsp; Societ&agrave; di capitali.</span></span></span></h2>\r\n\r\n<p><span style="font-size:16px"><span style="font-family:Times New Roman,Times,serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - servizi per costituzione si societ&agrave; di tipo S.P.A., e S.R.L.</span></span></p>\r\n\r\n<ul style="margin-left:40px">\r\n	<li>\r\n	<h2><strong><span style="font-size:18px"><span style="font-family:Times New Roman,Times,serif">Consulenze per operazioni ordinarie e straordinarie di societ&agrave;:</span></span></strong></h2>\r\n	</li>\r\n</ul>\r\n\r\n<h2><span style="font-family:Tahoma,Geneva,sans-serif"><span style="color:#4e5f70"><span style="font-size:18px">&rarr;&nbsp; Societ&agrave; di persone.</span></span></span></h2>\r\n\r\n<p><span style="font-size:16px"><span style="font-family:Times New Roman,Times,serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - servizi per operazioni di cessioni di quote, ingresso soci, aumento di capitale,liquidazioni, predisposizione di piani di risanamento aziendale.</span></span></p>\r\n\r\n<h2><span style="font-family:Tahoma,Geneva,sans-serif"><span style="color:#4e5f70"><span style="font-size:18px">&rarr;&nbsp; Societ&agrave; di capitali.</span></span></span></h2>\r\n\r\n<p><span style="font-size:16px"><span style="font-family:Times New Roman,Times,serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - servizi per operazioni di aumento del capitale, bozza di statuto, fusioni, trasformazioni, liquidazioni, predisposizioni di piani di risanamento aziendale. </span></span></p>\r\n\r\n<h2>Consulente tecnico del Giudice.</h2>\r\n\r\n<h2><span style="font-size:18px"><span style="font-family:Tahoma,Geneva,sans-serif"><span style="color:#4e5f70">&rarr;&nbsp; Perizie e Valutazioni.</span></span></span></h2>\r\n\r\n<p><span style="font-size:16px"><span style="font-family:Times New Roman,Times,serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - segue operazioni in materia contabile, sia sotto forma di consulenza per il Tribunale, sia per conto delle parti previo specifico incarico.</span></span></p>\r\n'),
('practice-leftmenu-title', 'en', 'Activity & Practice'),
('practice-leftmenu-title', 'it', 'Attività e Pratiche'),
('practice-leftmenu-title', 'ro', 'Activitatile noastre'),
('resources-leftmenu-title', 'en', 'Resources from:'),
('resources-leftmenu-title', 'it', 'Risorse per:'),
('testimonialssection-buttons-viewall', 'en', 'VIEW ALL'),
('testimonialssection-buttons-viewall', 'it', 'vedi tutte'),
('testimonialssection-buttons-viewall', 'ro', 'vezi toate'),
('testimonialssection-title', 'en', 'Testimonials'),
('testimonialssection-title', 'it', 'Testimonianze'),
('testimonialssection-title', 'ro', 'Sustineri'),
('topmenu-item-1', 'en', 'Home'),
('topmenu-item-1', 'it', 'Home'),
('topmenu-item-1', 'ro', 'Acasa'),
('topmenu-item-2', 'en', 'Activity'),
('topmenu-item-2', 'it', 'Pratiche'),
('topmenu-item-2', 'ro', 'Practici'),
('topmenu-item-3', 'en', 'Service'),
('topmenu-item-3', 'it', 'Servizi'),
('topmenu-item-3', 'ro', 'Servicii'),
('topmenu-item-4', 'en', 'Resources'),
('topmenu-item-4', 'it', 'Risorse'),
('topmenu-item-4', 'ro', 'Resurse'),
('topmenu-item-5', 'en', 'Contact'),
('topmenu-item-5', 'it', 'Contatti'),
('topmenu-item-5', 'ro', 'Contact');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `acc_layout_visibility`
--

CREATE TABLE IF NOT EXISTS `acc_layout_visibility` (
  `page_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `item_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `visible` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`page_name`,`item_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Salvarea datelor din tabel `acc_layout_visibility`
--

INSERT INTO `acc_layout_visibility` (`page_name`, `item_key`, `visible`) VALUES
('home', 'content', '1'),
('home', 'gallery', '1'),
('home', 'news', '1'),
('home', 'pagelists', '1'),
('home', 'testimonials', '1'),
('practice', 'content', '1'),
('practice', 'leftmenu', '1'),
('resources', 'content', '1'),
('resources', 'leftmenu', '1');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `acc_menu`
--

CREATE TABLE IF NOT EXISTS `acc_menu` (
  `identifier` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`identifier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Salvarea datelor din tabel `acc_menu`
--

INSERT INTO `acc_menu` (`identifier`) VALUES
('home'),
('practice'),
('resources'),
('service');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `acc_menu_items`
--

CREATE TABLE IF NOT EXISTS `acc_menu_items` (
  `item_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `identifier` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `priority` tinyint(4) NOT NULL,
  `link` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`item_id`),
  KEY `identifier` (`identifier`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=57 ;

--
-- Salvarea datelor din tabel `acc_menu_items`
--

INSERT INTO `acc_menu_items` (`item_id`, `identifier`, `priority`, `link`, `icon`) VALUES
(12, 'resources', 3, '', NULL),
(13, 'service', 1, '', 'home'),
(14, 'practice', 1, '', NULL),
(15, 'home', 1, 'http://contabilitate.loghin.com/service', NULL),
(17, 'practice', 2, 'http://contabilitate.loghin.com/page/practice/17/44', NULL),
(18, 'practice', 3, '#', NULL),
(22, 'resources', 4, '#', NULL),
(23, 'resources', 5, '#', NULL),
(24, 'resources', 6, '#', NULL),
(25, 'resources', 7, '#', NULL),
(26, 'service', 2, '', 'graph'),
(28, 'service', 4, '', 'tag'),
(29, 'service', 5, '', 'user'),
(30, 'service', 6, '', 'stats'),
(31, 'service', 7, '', 'print'),
(35, 'resources', 8, '', NULL),
(36, 'home', 2, 'http://contabilitate.loghin.com/page/service/29', NULL),
(37, 'home', 3, '', NULL),
(56, 'practice', 4, '', NULL);

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `acc_menu_subitems`
--

CREATE TABLE IF NOT EXISTS `acc_menu_subitems` (
  `subitem_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(10) unsigned NOT NULL,
  `priority` int(11) NOT NULL,
  `link` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`subitem_id`),
  KEY `item_id` (`item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=79 ;

--
-- Salvarea datelor din tabel `acc_menu_subitems`
--

INSERT INTO `acc_menu_subitems` (`subitem_id`, `item_id`, `priority`, `link`, `icon`) VALUES
(7, 15, 2, 'http://contabilitate.loghin.com/page/service/13', NULL),
(8, 15, 3, 'http://contabilitate.loghin.com/page/service/26', NULL),
(14, 15, 9, 'http://contabilitate.loghin.com/page/service/31', NULL),
(17, 15, 10, 'http://contabilitate.loghin.com/page/practice/18/51', NULL),
(34, 12, 1, '#', 'user'),
(35, 12, 2, '#', 'print'),
(36, 12, 3, '#', 'tag'),
(37, 22, 1, '#', 'user'),
(38, 22, 2, '#', 'print'),
(39, 22, 3, '#', 'tag'),
(40, 14, 1, '', NULL),
(41, 14, 2, '', NULL),
(42, 14, 3, '', NULL),
(44, 17, 1, '', NULL),
(46, 17, 2, '', NULL),
(47, 17, 3, '', NULL),
(48, 17, 4, '', NULL),
(49, 17, 5, '', NULL),
(50, 17, 6, '', NULL),
(51, 18, 1, '', NULL),
(52, 18, 2, '', NULL),
(53, 18, 3, '', NULL),
(55, 12, 4, '#', 'gift'),
(56, 12, 5, '#', 'graph'),
(57, 22, 4, '#', 'gift'),
(58, 22, 5, '#', 'stats'),
(59, 36, 1, 'http://contabilitate.loghin.com/page/practice/14/40', NULL),
(60, 36, 2, 'http://contabilitate.loghin.com/page/practice/17/44', NULL),
(61, 36, 3, 'http://contabilitate.loghin.com/page/service/28', NULL),
(62, 36, 4, 'http://contabilitate.loghin.com/page/service/29', NULL),
(63, 36, 5, 'http://contabilitate.loghin.com/page/service/30', NULL),
(64, 36, 6, 'http://contabilitate.loghin.com/page/practice/18/51', NULL),
(65, 37, 1, '', NULL),
(66, 37, 2, '', NULL),
(67, 37, 3, '', NULL),
(68, 37, 4, '', NULL),
(72, 56, 1, 'http://contabilitate.loghin.com/page/practice/56/72', NULL),
(73, 56, 2, '', NULL),
(74, 56, 3, '', NULL),
(75, 56, 4, '', NULL),
(76, 56, 5, '', NULL),
(77, 56, 6, '', NULL),
(78, 56, 7, '', NULL);

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `acc_siteinfo`
--

CREATE TABLE IF NOT EXISTS `acc_siteinfo` (
  `id` varchar(32) NOT NULL,
  `value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Salvarea datelor din tabel `acc_siteinfo`
--

INSERT INTO `acc_siteinfo` (`id`, `value`) VALUES
('email_contact', 'ioanchs@yahoo.com');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `acc_slideshow`
--

CREATE TABLE IF NOT EXISTS `acc_slideshow` (
  `slideshow_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` smallint(4) unsigned NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `url` varchar(255) NOT NULL,
  `new_tab` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `postdate` int(11) unsigned NOT NULL,
  `orderid` smallint(5) unsigned NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`slideshow_id`),
  KEY `category_id` (`category_id`),
  KEY `orderid` (`orderid`),
  KEY `status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=85 ;

--
-- Salvarea datelor din tabel `acc_slideshow`
--

INSERT INTO `acc_slideshow` (`slideshow_id`, `category_id`, `image`, `url`, `new_tab`, `postdate`, `orderid`, `status`) VALUES
(1, 2, 'http://[::1]/loghin.com/web/accountant/assets/img/homegallery/2927339eeb455dab190e8c55cb70750d.jpg', 'http://studiosanua.com/temp_page/', 0, 1319543130, 1, 1),
(2, 2, 'http://[::1]/loghin.com/web/accountant/assets/img/homegallery/27013bee813265f814707b238c6a5ebd.jpg', 'http://studiosanua.com/temp_page/', 0, 1319543151, 2, 1),
(3, 2, NULL, 'http://studiosanua.com/temp_page/', 0, 1319543180, 3, 1),
(5, 1, 'http://contabilitate.loghin.com/assets/img/homegallery/94c2c70995c363ab1be29d189ed50570.jpg', 'http://studiosanua.com/temp_page/', 0, 1319543224, 1, 1),
(6, 1, 'http://contabilitate.loghin.com/assets/img/homegallery/5f6e3d980e9648981413dbf54d533c2f.jpg', 'http://studiosanua.com/temp_page/', 0, 1319543236, 2, 1),
(37, 10, 'http://contabilitate.loghin.com/assets/img/homegallery/c7ae7f38466fb013defd3661e43a25f4.jpg', 'http://studiosanua.com/', 0, 1319626675, 1, 1),
(38, 10, 'http://contabilitate.loghin.com/assets/img/homegallery/12e409682b8222fb083afce7c1db596a.jpg', 'http://studiosanua.com/', 0, 1319745075, 2, 1),
(39, 10, 'http://contabilitate.loghin.com/assets/img/homegallery/a433de387415c8e9401677454cfb9ca8.JPG', 'http://studiosanua.com/', 0, 1319745153, 3, 1),
(48, 10, 'http://contabilitate.loghin.com/assets/img/homegallery/d11c7f98652cf385dc46519fa2d9f840.jpg', '', 0, 0, 4, 1),
(49, 10, NULL, '', 0, 0, 5, 1),
(50, 10, NULL, '', 0, 0, 6, 1),
(51, 10, NULL, '', 0, 0, 7, 1),
(52, 10, NULL, '', 0, 0, 8, 1),
(53, 2, NULL, '', 0, 0, 4, 1),
(54, 1, NULL, '', 0, 0, 3, 1),
(55, 1, NULL, '', 0, 0, 4, 1),
(56, 1, NULL, '', 0, 0, 5, 1),
(57, 1, NULL, '', 0, 0, 6, 1),
(58, 1, NULL, '', 0, 0, 7, 1),
(59, 11, NULL, '', 0, 0, 1, 1),
(60, 11, NULL, '', 0, 0, 2, 1),
(61, 11, NULL, '', 0, 0, 3, 1),
(62, 12, NULL, '', 0, 0, 1, 1),
(63, 12, NULL, '', 0, 0, 2, 1),
(64, 12, NULL, '', 0, 0, 3, 1),
(65, 12, NULL, '', 0, 0, 4, 1),
(66, 12, NULL, '', 0, 0, 5, 1),
(67, 12, NULL, '', 0, 0, 6, 1),
(68, 13, NULL, '', 0, 0, 1, 1),
(69, 13, NULL, '', 0, 0, 2, 1),
(70, 13, NULL, '', 0, 0, 3, 1),
(71, 13, NULL, '', 0, 0, 4, 1),
(72, 13, NULL, '', 0, 0, 5, 1),
(73, 14, NULL, '', 0, 0, 1, 1),
(74, 14, NULL, '', 0, 0, 2, 1),
(75, 14, NULL, '', 0, 0, 3, 1),
(76, 14, NULL, '', 0, 0, 4, 1),
(77, 15, NULL, '', 0, 0, 1, 1),
(78, 16, NULL, '', 0, 0, 1, 1),
(79, 16, NULL, '', 0, 0, 2, 1),
(80, 17, NULL, '', 0, 0, 1, 1),
(81, 17, NULL, '', 0, 0, 2, 1),
(82, 17, NULL, '', 0, 0, 3, 1);

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `acc_slideshow_categories`
--

CREATE TABLE IF NOT EXISTS `acc_slideshow_categories` (
  `category_id` smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(255) DEFAULT NULL,
  `orderid` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`category_id`),
  KEY `orderid` (`orderid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Salvarea datelor din tabel `acc_slideshow_categories`
--

INSERT INTO `acc_slideshow_categories` (`category_id`, `url`, `orderid`) VALUES
(1, '#', 6),
(2, '', 4),
(10, '', 2),
(11, '', 7),
(12, '', 8),
(13, '', 9),
(14, '', 10),
(15, '', 11),
(16, '', 12),
(17, '', 13);

--
-- Restrictii pentru tabele sterse
--

--
-- Restrictii pentru tabele `acc_menu_items`
--
ALTER TABLE `acc_menu_items`
  ADD CONSTRAINT `acc_menu_items_ibfk_1` FOREIGN KEY (`identifier`) REFERENCES `acc_menu` (`identifier`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrictii pentru tabele `acc_menu_subitems`
--
ALTER TABLE `acc_menu_subitems`
  ADD CONSTRAINT `acc_menu_subitems_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `acc_menu_items` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrictii pentru tabele `acc_slideshow`
--
ALTER TABLE `acc_slideshow`
  ADD CONSTRAINT `acc_slideshow_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `acc_slideshow_categories` (`category_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
