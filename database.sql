-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 08 Paź 2017, 19:20
-- Wersja serwera: 10.1.25-MariaDB
-- Wersja PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `vmcshop`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `vmcs_logs`
--

CREATE TABLE `vmcs_logs` (
  `id` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `details` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `vmcs_news`
--

CREATE TABLE `vmcs_news` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `vmcs_pages`
--

CREATE TABLE `vmcs_pages` (
  `id` int(11) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `link` int(1) DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `active` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `vmcs_purchases`
--

CREATE TABLE `vmcs_purchases` (
  `id` int(11) NOT NULL,
  `buyer` varchar(255) NOT NULL,
  `service` int(11) NOT NULL,
  `server` int(11) NOT NULL,
  `method` varchar(255) NOT NULL,
  `info` varchar(255) DEFAULT NULL,
  `profit` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `vmcs_servers`
--

CREATE TABLE `vmcs_servers` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `query_port` int(11) NOT NULL,
  `rcon_port` int(11) NOT NULL,
  `rcon_pass` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `vmcs_services`
--

CREATE TABLE `vmcs_services` (
  `id` int(11) NOT NULL,
  `server` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `sms_channel` varchar(64) DEFAULT NULL,
  `sms_channel_id` int(11) DEFAULT NULL,
  `sms_number` int(11) DEFAULT NULL,
  `paypal_cost` int(11) DEFAULT NULL,
  `commands` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `vmcs_users`
--

CREATE TABLE `vmcs_users` (
  `id` int(11) NOT NULL,
  `name` varchar(36) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` text,
  `lastIP` varchar(36) DEFAULT NULL,
  `lastLogin` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `vmcs_users`
--

INSERT INTO `vmcs_users` (`id`, `name`, `password`, `avatar`, `lastIP`, `lastLogin`) VALUES
(1, 'Admin', '$2a$06$4PH7hx5AX23KclP.ndkzKeF7xehEVYLMeMYtoMdEX.85s5oQEZSaC', 'https://vmcshop.pro/assets/images/avatars/default-avatar.png', '127.0.0.1', '1502732862');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `vmcs_vouchers`
--

CREATE TABLE `vmcs_vouchers` (
  `id` int(11) NOT NULL,
  `service` int(11) NOT NULL,
  `code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `vmcs_logs`
--
ALTER TABLE `vmcs_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vmcs_news`
--
ALTER TABLE `vmcs_news`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `news_id_uindex` (`id`);

--
-- Indexes for table `vmcs_pages`
--
ALTER TABLE `vmcs_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vmcs_purchases`
--
ALTER TABLE `vmcs_purchases`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `purchases_id_uindex` (`id`);

--
-- Indexes for table `vmcs_servers`
--
ALTER TABLE `vmcs_servers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vmcs_services`
--
ALTER TABLE `vmcs_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vmcs_users`
--
ALTER TABLE `vmcs_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vmcs_vouchers`
--
ALTER TABLE `vmcs_vouchers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `vmcs_logs`
--
ALTER TABLE `vmcs_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `vmcs_news`
--
ALTER TABLE `vmcs_news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `vmcs_pages`
--
ALTER TABLE `vmcs_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `vmcs_purchases`
--
ALTER TABLE `vmcs_purchases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `vmcs_servers`
--
ALTER TABLE `vmcs_servers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `vmcs_services`
--
ALTER TABLE `vmcs_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `vmcs_users`
--
ALTER TABLE `vmcs_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `vmcs_vouchers`
--
ALTER TABLE `vmcs_vouchers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
