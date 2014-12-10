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
  PRIMARY KEY (`id`)
) DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

