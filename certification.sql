-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 17 2020 г., 09:34
-- Версия сервера: 5.7.23
-- Версия PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `certification`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admission`
--

CREATE TABLE `admission` (
  `id` int(11) NOT NULL,
  `order_by` smallint(6) DEFAULT '0',
  `status` tinyint(4) DEFAULT '1',
  `phone` varchar(20) DEFAULT NULL,
  `fax` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `site` varchar(200) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `blog` varchar(200) DEFAULT NULL,
  `biography` varchar(200) DEFAULT NULL,
  `level_name` text NOT NULL,
  `name` text NOT NULL,
  `reception_days` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `attach`
--

CREATE TABLE `attach` (
  `id` int(11) NOT NULL,
  `section` int(11) NOT NULL,
  `parent` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `guid` varchar(100) NOT NULL,
  `extension` varchar(6) NOT NULL,
  `size` int(11) NOT NULL,
  `creator` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `status` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `languages`
--

CREATE TABLE `languages` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `abb` varchar(5) NOT NULL,
  `status` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `languages`
--

INSERT INTO `languages` (`id`, `name`, `abb`, `status`) VALUES
(1, 'O`zbekcha', 'uz', 1),
(2, 'English', 'en', 1),
(3, 'Русский', 'ru', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `member`
--

CREATE TABLE `member` (
  `id` int(11) NOT NULL,
  `fio` varchar(500) NOT NULL,
  `phone_number` varchar(500) DEFAULT NULL,
  `company_name` varchar(500) DEFAULT NULL,
  `worker_status` varchar(500) DEFAULT NULL,
  `email` varchar(500) NOT NULL,
  `lid_source` varchar(500) DEFAULT NULL,
  `responsible` varchar(500) NOT NULL,
  `region` varchar(500) NOT NULL,
  `crm_id` varchar(100) NOT NULL,
  `download_count` int(10) DEFAULT NULL,
  `download_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `member`
--

INSERT INTO `member` (`id`, `fio`, `phone_number`, `company_name`, `worker_status`, `email`, `lid_source`, `responsible`, `region`, `crm_id`, `download_count`, `download_date`) VALUES
(1, 'Жахангир', '8911631236', 'webforte', 'СЕО', 'xjoha@mail.ru', 'Web site', 'Ruxsora', 'Termez', '23444', 0, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL DEFAULT '0',
  `language` varchar(16) NOT NULL DEFAULT '',
  `translation` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `message`
--

INSERT INTO `message` (`id`, `language`, `translation`) VALUES
(1, 'en', 'Full Name'),
(1, 'ru', 'ФИО'),
(1, 'uz', 'FISH'),
(2, 'en', 'Send'),
(2, 'ru', 'Отправить'),
(2, 'uz', 'Yuborish'),
(3, 'en', 'Phone number'),
(3, 'ru', 'Номер телефона'),
(3, 'uz', 'Telefon raqamingiz'),
(4, 'en', 'Message'),
(4, 'ru', 'Сообщение '),
(4, 'uz', 'Xabar matni'),
(5, 'en', 'Thank you for request'),
(5, 'ru', 'Спасибо за заявку'),
(5, 'uz', 'Murojaatingiz uchun raxmat!'),
(6, 'en', 'Soon our manager will connect with you!'),
(6, 'ru', 'Скоро наш менеджер перезвонит Вам!'),
(6, 'uz', 'Tez orada menedjerimiz siz bilan bog`lanadi!'),
(7, 'en', 'District'),
(7, 'ru', 'Область'),
(7, 'uz', 'Viloyat'),
(8, 'en', 'Region/Town'),
(8, 'ru', 'Регион/город'),
(8, 'uz', 'Tuman/shahar'),
(9, 'en', 'Address'),
(9, 'ru', 'Адрес'),
(9, 'uz', 'Manzil'),
(10, 'en', 'E-mail'),
(10, 'ru', 'E-mail'),
(10, 'uz', 'E-mail'),
(11, 'en', 'Gender'),
(11, 'ru', 'Пол'),
(11, 'uz', 'Jins'),
(12, 'en', 'Message text'),
(12, 'ru', 'Текст обращение'),
(12, 'uz', 'Murojaat matni'),
(13, 'en', 'Application type'),
(13, 'ru', 'Форма обращение'),
(13, 'uz', 'Murojaat shakli'),
(14, 'en', 'Choose ...'),
(14, 'ru', 'Выберите значение'),
(14, 'uz', 'Tanlang ...'),
(15, 'en', 'Choose district first'),
(15, 'ru', 'Сначала выберите область'),
(15, 'uz', 'Avval viloyatni tanlang'),
(16, 'en', 'Select file'),
(16, 'ru', 'Выберите файл'),
(16, 'uz', 'Faylni tanlang'),
(17, 'en', 'File'),
(17, 'ru', 'Файл'),
(17, 'uz', 'Fayl'),
(18, 'en', 'Home'),
(18, 'ru', 'Главная'),
(18, 'uz', 'Asosiy'),
(19, 'en', 'Your application was registered sucessfully! For controlling answer status save unique application id and password for it.'),
(19, 'ru', 'Ваша обращение было успешно зарегистрировано! Для отслеживание ответа сохраните у себя уникальный идентификатор обращение и ключ для проверки!'),
(19, 'uz', 'Murojaatingiz muvaffaqiyatli ro\'yxatdan o\'tkazildi. Javob xolatini kuzatib turish uchun , murojaat identifikatori va tekshirish parolini saqlab qo\'ying.'),
(20, 'en', 'Birth date'),
(20, 'ru', 'Дата рождение'),
(20, 'uz', 'Tug\'ilgan sa\'na'),
(21, 'en', 'New'),
(21, 'ru', 'Новые'),
(21, 'uz', 'Yangilari'),
(22, 'en', 'On process'),
(22, 'ru', 'В стадии обработки'),
(22, 'uz', 'Jarayonda'),
(23, 'en', 'Disclaimed'),
(23, 'ru', 'Отказано'),
(23, 'uz', 'Rad etilgan'),
(24, 'en', 'Answered'),
(24, 'ru', 'Обработано'),
(24, 'uz', 'Javob yo\'llangan'),
(25, 'en', 'Applications'),
(25, 'ru', 'Обращений'),
(25, 'uz', 'Murojaatlar'),
(26, 'en', '<strong>*</strong> - must filled fields'),
(26, 'ru', '<strong>*</strong> - поля, обязательные для заполнения'),
(26, 'uz', '<strong>*</strong> - to\'ldirilishi shart bo\'lgan maydonlar'),
(27, 'en', 'Public offer'),
(27, 'ru', 'Публичная офферта'),
(27, 'uz', 'Ommaviy offerta'),
(28, 'en', 'Read public offer. '),
(28, 'ru', 'Познакомился с публичной офертой. '),
(28, 'uz', 'Ommaviy offerta bilan tanishib chiqdim. '),
(29, 'en', 'Agree with public offering, send application'),
(29, 'ru', 'Согласен с публичной офертой, отправить обращение'),
(29, 'uz', 'Ommaviy offerta bilan tanishdim , murojaatni jo\'natmoq'),
(30, 'en', 'Check your application status'),
(30, 'ru', 'Проверьте статус обращение'),
(30, 'uz', 'Murojaatingiz holatini tekshiring'),
(31, 'en', 'Enter application id and password for it'),
(31, 'ru', 'Введите идентификатор и код обращение'),
(31, 'uz', 'Murojaat identifikatori va kodini kiriting'),
(32, 'en', 'Check status'),
(32, 'ru', 'Проверить статус'),
(32, 'uz', 'Holatni tekshirish'),
(33, 'en', 'New application'),
(33, 'ru', 'Новое обращение'),
(33, 'uz', 'Murojjatnoma yuborish'),
(34, 'en', 'Application id'),
(34, 'ru', 'Идентификатор обращение'),
(34, 'uz', 'Murojaat id'),
(35, 'en', 'Password'),
(35, 'ru', 'Код'),
(35, 'uz', 'Kod'),
(36, 'en', 'Application found!'),
(36, 'ru', 'Обращение найдено!'),
(36, 'uz', 'Murojaatnoma topildi!'),
(37, 'en', 'Created date'),
(37, 'ru', 'Дата создание'),
(37, 'uz', 'Yaratilish sa\'nasi'),
(38, 'en', 'Status'),
(38, 'ru', 'Статус'),
(38, 'uz', 'Status'),
(39, 'en', 'Application answer'),
(39, 'ru', 'Ответ на обращение'),
(39, 'uz', 'Murojaatga javob'),
(40, 'en', 'Not answered'),
(40, 'ru', 'Не отвечено'),
(40, 'uz', 'Javob berilmagan'),
(41, 'en', 'Region'),
(41, 'ru', 'Область'),
(41, 'uz', 'Viloyat'),
(42, 'en', 'District/Town'),
(42, 'ru', 'Регион/город'),
(42, 'uz', 'Tuman/shahar'),
(43, 'en', 'Check status'),
(43, 'ru', 'Проверка статуса'),
(43, 'uz', 'Holatni tekshirish'),
(44, 'en', 'Send successfully'),
(44, 'ru', 'Успешно отправлено'),
(44, 'uz', 'Muvaffaqiyatli yuborildi'),
(45, 'en', 'Send successfully'),
(45, 'ru', 'Успешно отправлено'),
(45, 'uz', 'Muvaffaqiyatli yuborildi');

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `pcounter_save`
--

CREATE TABLE `pcounter_save` (
  `save_name` varchar(10) NOT NULL,
  `save_value` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `pcounter_save`
--

INSERT INTO `pcounter_save` (`save_name`, `save_value`) VALUES
('counter', 2),
('day_time', 2459201),
('max_count', 2),
('max_time', 1608109200),
('yesterday', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `pcounter_users`
--

CREATE TABLE `pcounter_users` (
  `user_ip` varchar(255) NOT NULL,
  `user_time` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `pcounter_users`
--

INSERT INTO `pcounter_users` (`user_ip`, `user_time`) VALUES
('50fe6e88831757e0b6824f74ea36fbf7', 1608171824),
('dbf91bd45f687a5202a74092457de8d6', 1608176811);

-- --------------------------------------------------------

--
-- Структура таблицы `polls`
--

CREATE TABLE `polls` (
  `id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `creator` int(11) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

CREATE TABLE `settings` (
  `id` varchar(100) NOT NULL,
  `val` varchar(1000) NOT NULL,
  `url` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`id`, `val`, `url`) VALUES
('copyright', 'Copyright 2000 - 2020 CERT Group | Обучение и сертификация по стандартам ISO | Вводя и отправляя какие-либо данные на этом сайте, вы подтверждаете согласие с условиями Пользовательского соглашения. Уникальные материалы сайта охраняются законодательством об авторских правах. Копирование материалов сайта возможно только с письменного разрешения ООО \"СЕРТ Интернешнл\". Обратитесь к нам любым удобным вам способом.', NULL),
('title', 'Система выдачи онлайн сертификатов участникам конференции «Менять мышление: МВА или стандарты ISO по системам управления» ', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `settings_lang`
--

CREATE TABLE `settings_lang` (
  `id` int(11) NOT NULL,
  `lang` int(11) NOT NULL,
  `parent` varchar(100) NOT NULL,
  `val` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `settings_lang`
--

INSERT INTO `settings_lang` (`id`, `lang`, `parent`, `val`) VALUES
(1, 2, 'title', 'TMATB director\'s virtual office'),
(2, 3, 'title', 'Виртуальная приёмная директора ТФТМА'),
(3, 2, 'copyright', ' 2019 &copy; Tashkent medical academy Termiz branch'),
(4, 3, 'copyright', ' 2019 &copy; Термезский филиал Ташкентской медицинской академии');

-- --------------------------------------------------------

--
-- Структура таблицы `source_message`
--

CREATE TABLE `source_message` (
  `id` int(11) NOT NULL,
  `category` varchar(32) DEFAULT NULL,
  `message` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `source_message`
--

INSERT INTO `source_message` (`id`, `category`, `message`) VALUES
(1, 'main', 'name'),
(2, 'main', 'send'),
(3, 'main', 'phone'),
(4, 'main', 'body'),
(5, 'main', 'thank-you'),
(6, 'main', 'success-text'),
(7, 'main', 'district'),
(8, 'main', 'region'),
(9, 'main', 'address'),
(10, 'main', 'email'),
(11, 'main', 'gender'),
(12, 'main', 'message'),
(13, 'main', 'reception_type'),
(14, 'main', 'choose'),
(15, 'main', 'choose-district-first'),
(16, 'main', 'select-file'),
(17, 'main', 'file'),
(18, 'main', 'home'),
(19, 'main', 'success-send'),
(20, 'main', 'birth_date'),
(21, 'main', 'new'),
(22, 'main', 'on-process'),
(23, 'main', 'disclaimed'),
(24, 'main', 'succeed'),
(25, 'main', 'applications'),
(26, 'main', 'must-filled'),
(27, 'main', 'offer'),
(28, 'main', 'agreement'),
(29, 'main', 'read-offer'),
(30, 'main', 'check-your-application'),
(31, 'main', 'check-steps'),
(32, 'main', 'check-status'),
(33, 'main', 'application'),
(34, 'main', 'unique_id'),
(35, 'main', 'password'),
(36, 'main', 'found'),
(37, 'main', 'created_date'),
(38, 'main', 'status'),
(39, 'main', 'reception-answer'),
(40, 'main', 'not-answered'),
(41, 'main', 'region'),
(42, 'main', 'district'),
(43, 'main', 'check'),
(44, 'main', 'success'),
(45, 'main', 'success');

-- --------------------------------------------------------

--
-- Структура таблицы `telegram_settings`
--

CREATE TABLE `telegram_settings` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `telegram_settings`
--

INSERT INTO `telegram_settings` (`id`, `value`) VALUES
('reception', '<b>Yangi murojaat</b>\r\nName: {$name}\r\nPhone: {$phone}\r\nEmail: {$email} \r\nMessage: {$message}\r\nLink: {$link}');

-- --------------------------------------------------------

--
-- Структура таблицы `telegram_user`
--

CREATE TABLE `telegram_user` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `telegram_user`
--

INSERT INTO `telegram_user` (`id`, `user_id`, `name`) VALUES
(1, 276046538, 'Jahongir');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `creator` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `creator`) VALUES
(1, 'root', 'dArVMsVrEo-9LPrwI4RtJc_I0eAnIIu9', '$2y$13$tiluCXM6rvru9PTaU.F3teSnc2vwO98EDSF8nqVmMJ7xZsY7t7Vhm', NULL, '', 10, 1481295772, 1513629941, 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admission`
--
ALTER TABLE `admission`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `attach`
--
ALTER TABLE `attach`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`,`language`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `pcounter_save`
--
ALTER TABLE `pcounter_save`
  ADD PRIMARY KEY (`save_name`);

--
-- Индексы таблицы `pcounter_users`
--
ALTER TABLE `pcounter_users`
  ADD PRIMARY KEY (`user_ip`);

--
-- Индексы таблицы `polls`
--
ALTER TABLE `polls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `creator` (`creator`);

--
-- Индексы таблицы `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `settings_lang`
--
ALTER TABLE `settings_lang`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `source_message`
--
ALTER TABLE `source_message`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `telegram_settings`
--
ALTER TABLE `telegram_settings`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `telegram_user`
--
ALTER TABLE `telegram_user`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `admission`
--
ALTER TABLE `admission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `attach`
--
ALTER TABLE `attach`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `polls`
--
ALTER TABLE `polls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `settings_lang`
--
ALTER TABLE `settings_lang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `source_message`
--
ALTER TABLE `source_message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT для таблицы `telegram_user`
--
ALTER TABLE `telegram_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `polls`
--
ALTER TABLE `polls`
  ADD CONSTRAINT `polls_ibfk_1` FOREIGN KEY (`creator`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
