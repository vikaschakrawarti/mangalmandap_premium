-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2023 at 12:02 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `premium_matrimony_2`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `register_view`
-- (See below for the actual view)
--
CREATE TABLE `register_view` (
`index_id` int(10) unsigned
,`matri_id` varchar(50)
,`prefix` varchar(50)
,`email` varchar(100)
,`fb_id` varchar(10)
,`password` varchar(100)
,`cpassword` varchar(100)
,`cpass_status` varchar(50)
,`m_status` enum('Never Married','Widower','Divorced','Awaiting Divorce','Widow')
,`profileby` enum('Self','Parents','Guardian','Friends','Sibling','Relatives')
,`pre_cnt_type` enum('Mobile','Landline')
,`time_to_call` varchar(50)
,`reference` varchar(50)
,`username` varchar(50)
,`firstname` varchar(50)
,`lastname` varchar(50)
,`gender` enum('Male','Female')
,`birthdate` varchar(50)
,`birthtime` varchar(15)
,`birthplace` varchar(50)
,`tot_children` varchar(10)
,`status_children` varchar(50)
,`income` varchar(50)
,`edu_detail` varchar(20)
,`occupation` int(5)
,`emp_in` varchar(50)
,`religion` int(5) unsigned
,`caste` int(5) unsigned
,`subcaste` varchar(50)
,`gothra` varchar(50)
,`star` varchar(50)
,`moonsign` varchar(50)
,`horoscope` varchar(100)
,`manglik` varchar(50)
,`m_tongue` varchar(20)
,`will_to_mary_caste` enum('0','1')
,`height` varchar(20)
,`weight` varchar(20)
,`b_group` varchar(20)
,`complexion` varchar(100)
,`physicalStatus` varchar(100)
,`bodytype` varchar(50)
,`diet` varchar(50)
,`smoke` varchar(50)
,`drink` varchar(50)
,`dosh` varchar(50)
,`address` text
,`country_id` int(11)
,`state_id` int(11)
,`city` int(8) unsigned
,`phone` varchar(25)
,`mobile_code` varchar(10)
,`mobile` varchar(15)
,`contact_view_security` enum('1','0')
,`residence` varchar(50)
,`father_name` varchar(50)
,`mother_name` varchar(50)
,`father_living_status` varchar(50)
,`mother_living_status` varchar(50)
,`father_occupation` varchar(50)
,`mother_occupation` varchar(50)
,`profile_text` text
,`profile_text_approve` varchar(100)
,`profile_text_date` varchar(100)
,`looking_for` varchar(150)
,`family_details` text
,`family_value` varchar(50)
,`family_type` varchar(50)
,`family_status` varchar(50)
,`family_origin` varchar(50)
,`no_of_brothers` varchar(50)
,`no_of_sisters` varchar(50)
,`no_marri_brother` varchar(50)
,`no_marri_sister` varchar(50)
,`part_frm_age` int(2)
,`part_to_age` int(2)
,`part_have_child` enum('Yes','No')
,`part_income` varchar(100)
,`part_diet` varchar(100)
,`part_smoke` varchar(100)
,`part_drink` varchar(100)
,`part_physical` varchar(100)
,`part_emp_in` varchar(100)
,`part_subcaste` varchar(100)
,`part_manglik` varchar(100)
,`part_dosh` varchar(100)
,`part_rasi` varchar(100)
,`part_star` varchar(100)
,`part_occu` varchar(100)
,`part_expect` text
,`part_expect_approve` varchar(50)
,`part_expect_date` varchar(100)
,`part_height` varchar(50)
,`part_height_to` varchar(50)
,`part_complexation` text
,`part_country_living` varchar(100)
,`part_state` varchar(100)
,`part_city` varchar(100)
,`part_resi_status` varchar(50)
,`part_edu` varchar(100)
,`part_mtongue` varchar(100)
,`part_religion` varchar(100)
,`part_caste` varchar(100)
,`hobby` text
,`language_known` varchar(100)
,`hor_check` enum('UNAPPROVED','APPROVED','PENDING')
,`hor_photo` varchar(100)
,`rasi1` varchar(20)
,`rasi2` varchar(20)
,`rasi3` varchar(20)
,`rasi4` varchar(20)
,`rasi5` varchar(20)
,`rasi6` varchar(20)
,`rasi7` varchar(20)
,`rasi8` varchar(20)
,`rasi9` varchar(20)
,`rasi10` varchar(20)
,`rasi11` varchar(20)
,`rasi12` varchar(20)
,`janana1` varchar(50)
,`janana2` varchar(50)
,`janana3` varchar(50)
,`janana4` varchar(50)
,`amsam1` varchar(20)
,`amsam2` varchar(20)
,`amsam3` varchar(20)
,`amsam4` varchar(20)
,`amsam5` varchar(20)
,`amsam6` varchar(20)
,`amsam7` varchar(20)
,`amsam8` varchar(20)
,`amsam9` varchar(20)
,`amsam10` varchar(20)
,`amsam11` varchar(20)
,`amsam12` varchar(20)
,`otp` varchar(20)
,`padham` varchar(50)
,`lagnam` varchar(50)
,`photo_protect` enum('Yes','No')
,`photo_pswd` varchar(50)
,`video` text
,`video_approval` enum('UNAPPROVED','APPROVED')
,`video_url` text
,`photo_view_status` enum('1','2','0')
,`photo1` varchar(100)
,`photo1_approve` enum('UNAPPROVED','APPROVED','PENDING')
,`photo2` varchar(100)
,`photo2_approve` enum('UNAPPROVED','APPROVED','PENDING')
,`photo3` varchar(100)
,`photo3_approve` enum('UNAPPROVED','APPROVED','PENDING')
,`photo4` varchar(100)
,`photo4_approve` enum('UNAPPROVED','APPROVED','PENDING')
,`photo5` varchar(100)
,`photo5_approve` enum('UNAPPROVED','APPROVED','PENDING')
,`photo6` varchar(100)
,`photo6_approve` enum('UNAPPROVED','APPROVED','PENDING')
,`reg_date` datetime
,`ip` varchar(30)
,`agent` text
,`last_login` datetime
,`franchies_id` varchar(11)
,`franchisee_amount` varchar(100)
,`status` varchar(50)
,`fstatus` varchar(50)
,`tokan` text
,`logged_in` enum('0','1')
,`adminrole_id` int(11)
,`adminrole_view_status` enum('Yes','No')
,`profile_viewed` int(11)
,`state_name` varchar(255)
,`country_name` varchar(255)
,`religion_name` varchar(50)
,`caste_name` varchar(50)
,`city_name` varchar(255)
,`ocp_name` varchar(100)
);

-- --------------------------------------------------------

--
-- Structure for view `register_view`
--
DROP TABLE IF EXISTS `register_view`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `register_view`  AS SELECT `reg`.`index_id` AS `index_id`, `reg`.`matri_id` AS `matri_id`, `reg`.`prefix` AS `prefix`, `reg`.`email` AS `email`, `reg`.`fb_id` AS `fb_id`, `reg`.`password` AS `password`, `reg`.`cpassword` AS `cpassword`, `reg`.`cpass_status` AS `cpass_status`, `reg`.`m_status` AS `m_status`, `reg`.`profileby` AS `profileby`, `reg`.`pre_cnt_type` AS `pre_cnt_type`, `reg`.`time_to_call` AS `time_to_call`, `reg`.`reference` AS `reference`, `reg`.`username` AS `username`, `reg`.`firstname` AS `firstname`, `reg`.`lastname` AS `lastname`, `reg`.`gender` AS `gender`, `reg`.`birthdate` AS `birthdate`, `reg`.`birthtime` AS `birthtime`, `reg`.`birthplace` AS `birthplace`, `reg`.`tot_children` AS `tot_children`, `reg`.`status_children` AS `status_children`, `reg`.`income` AS `income`, `reg`.`edu_detail` AS `edu_detail`, `reg`.`occupation` AS `occupation`, `reg`.`emp_in` AS `emp_in`, `reg`.`religion` AS `religion`, `reg`.`caste` AS `caste`, `reg`.`subcaste` AS `subcaste`, `reg`.`gothra` AS `gothra`, `reg`.`star` AS `star`, `reg`.`moonsign` AS `moonsign`, `reg`.`horoscope` AS `horoscope`, `reg`.`manglik` AS `manglik`, `reg`.`m_tongue` AS `m_tongue`, `reg`.`will_to_mary_caste` AS `will_to_mary_caste`, `reg`.`height` AS `height`, `reg`.`weight` AS `weight`, `reg`.`b_group` AS `b_group`, `reg`.`complexion` AS `complexion`, `reg`.`physicalStatus` AS `physicalStatus`, `reg`.`bodytype` AS `bodytype`, `reg`.`diet` AS `diet`, `reg`.`smoke` AS `smoke`, `reg`.`drink` AS `drink`, `reg`.`dosh` AS `dosh`, `reg`.`address` AS `address`, `reg`.`country_id` AS `country_id`, `reg`.`state_id` AS `state_id`, `reg`.`city` AS `city`, `reg`.`phone` AS `phone`, `reg`.`mobile_code` AS `mobile_code`, `reg`.`mobile` AS `mobile`, `reg`.`contact_view_security` AS `contact_view_security`, `reg`.`residence` AS `residence`, `reg`.`father_name` AS `father_name`, `reg`.`mother_name` AS `mother_name`, `reg`.`father_living_status` AS `father_living_status`, `reg`.`mother_living_status` AS `mother_living_status`, `reg`.`father_occupation` AS `father_occupation`, `reg`.`mother_occupation` AS `mother_occupation`, `reg`.`profile_text` AS `profile_text`, `reg`.`profile_text_approve` AS `profile_text_approve`, `reg`.`profile_text_date` AS `profile_text_date`, `reg`.`looking_for` AS `looking_for`, `reg`.`family_details` AS `family_details`, `reg`.`family_value` AS `family_value`, `reg`.`family_type` AS `family_type`, `reg`.`family_status` AS `family_status`, `reg`.`family_origin` AS `family_origin`, `reg`.`no_of_brothers` AS `no_of_brothers`, `reg`.`no_of_sisters` AS `no_of_sisters`, `reg`.`no_marri_brother` AS `no_marri_brother`, `reg`.`no_marri_sister` AS `no_marri_sister`, `reg`.`part_frm_age` AS `part_frm_age`, `reg`.`part_to_age` AS `part_to_age`, `reg`.`part_have_child` AS `part_have_child`, `reg`.`part_income` AS `part_income`, `reg`.`part_diet` AS `part_diet`, `reg`.`part_smoke` AS `part_smoke`, `reg`.`part_drink` AS `part_drink`, `reg`.`part_physical` AS `part_physical`, `reg`.`part_emp_in` AS `part_emp_in`, `reg`.`part_subcaste` AS `part_subcaste`, `reg`.`part_manglik` AS `part_manglik`, `reg`.`part_dosh` AS `part_dosh`, `reg`.`part_rasi` AS `part_rasi`, `reg`.`part_star` AS `part_star`, `reg`.`part_occu` AS `part_occu`, `reg`.`part_expect` AS `part_expect`, `reg`.`part_expect_approve` AS `part_expect_approve`, `reg`.`part_expect_date` AS `part_expect_date`, `reg`.`part_height` AS `part_height`, `reg`.`part_height_to` AS `part_height_to`, `reg`.`part_complexation` AS `part_complexation`, `reg`.`part_country_living` AS `part_country_living`, `reg`.`part_state` AS `part_state`, `reg`.`part_city` AS `part_city`, `reg`.`part_resi_status` AS `part_resi_status`, `reg`.`part_edu` AS `part_edu`, `reg`.`part_mtongue` AS `part_mtongue`, `reg`.`part_religion` AS `part_religion`, `reg`.`part_caste` AS `part_caste`, `reg`.`hobby` AS `hobby`, `reg`.`language_known` AS `language_known`, `reg`.`hor_check` AS `hor_check`, `reg`.`hor_photo` AS `hor_photo`, `reg`.`rasi1` AS `rasi1`, `reg`.`rasi2` AS `rasi2`, `reg`.`rasi3` AS `rasi3`, `reg`.`rasi4` AS `rasi4`, `reg`.`rasi5` AS `rasi5`, `reg`.`rasi6` AS `rasi6`, `reg`.`rasi7` AS `rasi7`, `reg`.`rasi8` AS `rasi8`, `reg`.`rasi9` AS `rasi9`, `reg`.`rasi10` AS `rasi10`, `reg`.`rasi11` AS `rasi11`, `reg`.`rasi12` AS `rasi12`, `reg`.`janana1` AS `janana1`, `reg`.`janana2` AS `janana2`, `reg`.`janana3` AS `janana3`, `reg`.`janana4` AS `janana4`, `reg`.`amsam1` AS `amsam1`, `reg`.`amsam2` AS `amsam2`, `reg`.`amsam3` AS `amsam3`, `reg`.`amsam4` AS `amsam4`, `reg`.`amsam5` AS `amsam5`, `reg`.`amsam6` AS `amsam6`, `reg`.`amsam7` AS `amsam7`, `reg`.`amsam8` AS `amsam8`, `reg`.`amsam9` AS `amsam9`, `reg`.`amsam10` AS `amsam10`, `reg`.`amsam11` AS `amsam11`, `reg`.`amsam12` AS `amsam12`, `reg`.`otp` AS `otp`, `reg`.`padham` AS `padham`, `reg`.`lagnam` AS `lagnam`, `reg`.`photo_protect` AS `photo_protect`, `reg`.`photo_pswd` AS `photo_pswd`, `reg`.`video` AS `video`, `reg`.`video_approval` AS `video_approval`, `reg`.`video_url` AS `video_url`, `reg`.`photo_view_status` AS `photo_view_status`, `reg`.`photo1` AS `photo1`, `reg`.`photo1_approve` AS `photo1_approve`, `reg`.`photo2` AS `photo2`, `reg`.`photo2_approve` AS `photo2_approve`, `reg`.`photo3` AS `photo3`, `reg`.`photo3_approve` AS `photo3_approve`, `reg`.`photo4` AS `photo4`, `reg`.`photo4_approve` AS `photo4_approve`, `reg`.`photo5` AS `photo5`, `reg`.`photo5_approve` AS `photo5_approve`, `reg`.`photo6` AS `photo6`, `reg`.`photo6_approve` AS `photo6_approve`, `reg`.`reg_date` AS `reg_date`, `reg`.`ip` AS `ip`, `reg`.`agent` AS `agent`, `reg`.`last_login` AS `last_login`, `reg`.`franchies_id` AS `franchies_id`, `reg`.`franchisee_amount` AS `franchisee_amount`, `reg`.`status` AS `status`, `reg`.`fstatus` AS `fstatus`, `reg`.`tokan` AS `tokan`, `reg`.`logged_in` AS `logged_in`, `reg`.`adminrole_id` AS `adminrole_id`, `reg`.`adminrole_view_status` AS `adminrole_view_status`, `reg`.`profile_viewed` AS `profile_viewed`, `sta`.`state_name` AS `state_name`, `cnt`.`country_name` AS `country_name`, `rel`.`religion_name` AS `religion_name`, `cst`.`caste_name` AS `caste_name`, `ct`.`city_name` AS `city_name`, `ocp`.`ocp_name` AS `ocp_name` FROM ((((((`register` `reg` left join `caste` `cst` on(`cst`.`caste_id` = `reg`.`caste`)) left join `religion` `rel` on(`rel`.`religion_id` = `reg`.`religion`)) left join `state` `sta` on(`reg`.`state_id` = `sta`.`state_id`)) left join `country` `cnt` on(`reg`.`country_id` = `cnt`.`country_id`)) left join `city` `ct` on(`reg`.`city` = `ct`.`city_id`)) left join `occupation` `ocp` on(`reg`.`occupation` = `ocp`.`ocp_id`)) ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
