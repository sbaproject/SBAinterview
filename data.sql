-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 04, 2020 lúc 12:15 PM
-- Phiên bản máy phục vụ: 10.4.11-MariaDB
-- Phiên bản PHP: 7.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `sba_interview`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `t_interviewmanagement`
--

CREATE TABLE `t_interviewmanagement` (
  `in_id` int(11) NOT NULL,
  `in_cvchannel` text NOT NULL,
  `in_cvno` varchar(200) DEFAULT NULL,
  `in_firstname` varchar(200) NOT NULL,
  `in_lastname` varchar(200) NOT NULL,
  `in_dob` varchar(1024) NOT NULL,
  `in_salary` int(11) DEFAULT NULL,
  `in_mail` varchar(200) DEFAULT NULL,
  `in_education` text DEFAULT NULL,
  `in_del_flg` int(11) DEFAULT NULL,
  `in_datecreate` datetime DEFAULT NULL,
  `in_update` datetime DEFAULT NULL,
  `in_experience` text DEFAULT NULL,
  `in_language` int(5) NOT NULL,
  `in_university` varchar(200) DEFAULT NULL,
  `in_tel` varchar(14) DEFAULT NULL,
  `in_address` text DEFAULT NULL,
  `in_cvlink` text NOT NULL,
  `in_status` int(11) NOT NULL,
  `in_time` time DEFAULT NULL,
  `in_date` date DEFAULT NULL,
  `in_note` text DEFAULT NULL,
  `in_extraskill` text DEFAULT NULL,
  `in_personality` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `t_interviewmanagement`
--

INSERT INTO `t_interviewmanagement` (`in_id`, `in_cvchannel`, `in_cvno`, `in_firstname`, `in_lastname`, `in_dob`, `in_salary`, `in_mail`, `in_education`, `in_del_flg`, `in_datecreate`, `in_update`, `in_experience`, `in_language`, `in_university`, `in_tel`, `in_address`, `in_cvlink`, `in_status`, `in_time`, `in_date`, `in_note`, `in_extraskill`, `in_personality`) VALUES
(1, '', '1', '', '', '', 344324, 'dung@gmail.com', 'abc', 1, '2020-06-02 15:37:11', '2020-06-03 16:45:11', 'abc', 1, NULL, '0989977778', 'abc', '', 2, '14:00:00', '2020-06-03', NULL, NULL, NULL),
(2, '', '123', '', '', 'mng', 1000000, 'dung@gmail.com', 'fdsf', 0, '2020-06-03 16:45:50', '2020-06-03 16:51:10', 'sfdsfsd', 1, NULL, '0989977778', 'abc', '', 0, '11:58:00', '2020-06-03', NULL, NULL, NULL),
(3, '', '1235', '', '', 'abc', NULL, 'anguyen@gmail.com', NULL, 0, '2020-06-03 16:47:20', '2020-06-03 16:50:50', NULL, 1, NULL, NULL, NULL, '', 4, '11:47:00', '2020-06-03', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `t_iq_questions`
--

CREATE TABLE `t_iq_questions` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `del_flg` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_update` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `t_iq_question_options`
--

CREATE TABLE `t_iq_question_options` (
  `id` int(11) NOT NULL,
  `iq_question_id` int(11) NOT NULL,
  `option_key` int(11) NOT NULL,
  `option_value` text NOT NULL,
  `correct_flg` int(5) NOT NULL COMMENT '0:wrong, 1:correct',
  `del_flg` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_update` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `t_result`
--

CREATE TABLE `t_result` (
  `id` int(11) NOT NULL,
  `candidate_firstname` varchar(200) NOT NULL,
  `candidate_lastname` varchar(200) NOT NULL,
  `candidate_tel` varchar(14) NOT NULL,
  `candidate_address` text NOT NULL,
  `candidate_mail` varchar(200) NOT NULL,
  `candidate_language` int(5) NOT NULL,
  `candidate_dob` varchar(50) NOT NULL,
  `starttime` time NOT NULL,
  `endtime` time NOT NULL,
  `totaltime` int(11) NOT NULL,
  `iq_score` int(11) NOT NULL,
  `tech_score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `t_tech_questions`
--

CREATE TABLE `t_tech_questions` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `type` int(5) NOT NULL COMMENT 'php:1, c#,net:2',
  `del_flg` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_update` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `t_test_answer`
--

CREATE TABLE `t_test_answer` (
  `id` int(11) NOT NULL,
  `result_id` int(11) NOT NULL,
  `type` int(5) NOT NULL COMMENT 'testIQ:1, testTech:2',
  `question_id` int(11) NOT NULL,
  `question_options_id` int(11) NOT NULL,
  `tech_content_ans` text NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `t_user`
--

CREATE TABLE `t_user` (
  `u_id` int(11) NOT NULL,
  `u_user` varchar(200) DEFAULT NULL,
  `u_pw` varchar(200) DEFAULT NULL,
  `u_name` varchar(200) DEFAULT NULL,
  `u_date` datetime DEFAULT NULL,
  `u_update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `t_user`
--

INSERT INTO `t_user` (`u_id`, `u_user`, `u_pw`, `u_name`, `u_date`, `u_update`) VALUES
(1, 'admin', 'admin', 'master', '2020-03-20 10:17:23', '2020-03-20 10:17:25'),
(2, 'admin2', '1234567', 'Intercontinental支店', '2020-03-20 10:18:13', '2020-03-20 10:18:15');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `t_interviewmanagement`
--
ALTER TABLE `t_interviewmanagement`
  ADD PRIMARY KEY (`in_id`),
  ADD KEY `s_shop` (`in_salary`);

--
-- Chỉ mục cho bảng `t_iq_questions`
--
ALTER TABLE `t_iq_questions`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `t_iq_question_options`
--
ALTER TABLE `t_iq_question_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iq_question_id` (`iq_question_id`);

--
-- Chỉ mục cho bảng `t_result`
--
ALTER TABLE `t_result`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `t_tech_questions`
--
ALTER TABLE `t_tech_questions`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `t_test_answer`
--
ALTER TABLE `t_test_answer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_result` (`result_id`),
  ADD KEY `id_question_options` (`question_options_id`),
  ADD KEY `id_question` (`question_id`);

--
-- Chỉ mục cho bảng `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `t_interviewmanagement`
--
ALTER TABLE `t_interviewmanagement`
  MODIFY `in_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `t_iq_questions`
--
ALTER TABLE `t_iq_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `t_iq_question_options`
--
ALTER TABLE `t_iq_question_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `t_result`
--
ALTER TABLE `t_result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `t_tech_questions`
--
ALTER TABLE `t_tech_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `t_test_answer`
--
ALTER TABLE `t_test_answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `t_user`
--
ALTER TABLE `t_user`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `t_iq_question_options`
--
ALTER TABLE `t_iq_question_options`
  ADD CONSTRAINT `t_iq_question_options_ibfk_1` FOREIGN KEY (`iq_question_id`) REFERENCES `t_iq_questions` (`id`);

--
-- Các ràng buộc cho bảng `t_test_answer`
--
ALTER TABLE `t_test_answer`
  ADD CONSTRAINT `t_test_answer_ibfk_1` FOREIGN KEY (`result_id`) REFERENCES `t_result` (`id`),
  ADD CONSTRAINT `t_test_answer_ibfk_2` FOREIGN KEY (`question_options_id`) REFERENCES `t_iq_question_options` (`id`),
  ADD CONSTRAINT `t_test_answer_ibfk_3` FOREIGN KEY (`question_id`) REFERENCES `t_iq_questions` (`id`),
  ADD CONSTRAINT `t_test_answer_ibfk_4` FOREIGN KEY (`question_id`) REFERENCES `t_tech_questions` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
