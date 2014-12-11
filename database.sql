--
-- 資料庫： `openidtest`
--
CREATE DATABASE IF NOT EXISTS `openidtest` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `openidtest`;

-- --------------------------------------------------------

--
-- 資料表結構 `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `passwd` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `s_grade` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `s_class` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `s_number` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `cname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` enum('local','ntpc') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'ntpc',
  PRIMARY KEY (`id`)
) DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- 資料表的匯出資料 `users`
--

INSERT INTO `users` (`id`, `uname`, `passwd`, `s_grade`, `s_class`, `s_number`, `cname`, `role`, `type`) VALUES
(1, 'admin', '123456', '00', '00', '00', '黃小寶', '管理員', 'local');
