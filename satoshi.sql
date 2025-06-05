-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 03, 2025 at 02:05 PM
-- Server version: 10.6.20-MariaDB
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `satoshic_safe`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `content`, `video_url`, `created_at`) VALUES
(3, 'Decentralized Bitcoin History', 'Bitcoin, the first decentralized cryptocurrency, was introduced in 2008 by an anonymous person or group under the pseudonym Satoshi Nakamoto. It was designed as a peer-to-peer electronic cash system to eliminate the need for intermediaries like banks and governments.', 'https://youtu.be/2YiJnxNBnCQ?feature=shared', '2025-02-17 16:44:24'),
(7, 'What is Cryptocurrency? A Beginner’s Guide', 'Cryptocurrency is a digital or virtual currency that uses cryptography for security. Unlike traditional currencies issued by governments, cryptocurrencies operate on decentralized networks based on blockchain technology. Bitcoin, created by Satoshi Nakamoto in 2009, was the first cryptocurrency and remains the most well-known.\r\n\r\nCryptos are stored in digital wallets and can be used for transactions, investments, and decentralized applications (DApps). Understanding crypto involves learning about blockchain, decentralization, and smart contracts.', 'https://www.youtube.com/watch?v=SSo_EIwHSd4', '2025-03-06 00:02:08'),
(8, 'Understanding Blockchain Technology', 'Blockchain is the backbone of cryptocurrency. It is a decentralized ledger that records transactions securely and transparently. Each block in the chain contains a group of transactions, and once added, it cannot be altered.\r\n\r\nKey features of blockchain include:\r\n\r\nDecentralization – No single authority controls the network.\r\nSecurity – Transactions are encrypted and immutable.\r\nTransparency – Anyone can verify transactions.\r\nPopular blockchain platforms include Bitcoin, Ethereum, and Solana.', 'https://www.youtube.com/watch?v=93E_GzvpMA0', '2025-03-06 00:03:37'),
(9, 'Common Crypto Scams and How to Avoid Them', 'Phishing attacks.\r\nFake investment schemes.\r\nRug pulls.\r\nPonzi schemes.', 'https://www.youtube.com/watch?v=kEAH-5nus5A', '2025-03-06 00:07:50'),
(10, 'The Best Crypto Tools for Beginners', 'Portfolio Trackers: CoinMarketCap, CoinGecko.\r\nWallets: MetaMask, Trust Wallet.\r\nExchanges: Binance, Coinbase.\r\nNews: CoinTelegraph, Decrypt.', 'https://www.youtube.com/watch?v=eRiCgEuIQ7Y', '2025-03-06 00:08:14'),
(11, 'What Are Crypto Regulations?', 'US: SEC regulations.\r\nEurope: MiCA regulations.\r\nIndia: Crypto tax policies.', 'https://www.youtube.com/watch?v=UDXwfem8e3U', '2025-03-06 00:08:38'),
(12, 'How to Earn Passive Income with Crypto', 'Ways to earn:\r\n\r\nStaking\r\nYield farming\r\nLending\r\nRunning a node', 'https://www.youtube.com/watch?v=Wg-DuAPGNVc', '2025-03-06 00:09:00'),
(13, 'Introduction to Crypto Trading', 'Crypto trading involves buying and selling digital assets.\r\n\r\nTypes of Trading: Spot, Futures, Options.\r\nIndicators Used: RSI, MACD, Bollinger Bands.', 'https://www.youtube.com/watch?v=YqhS-NMdTjM', '2025-03-06 00:09:23'),
(14, 'What Are Crypto Airdrops?', 'Airdrops distribute free tokens to users for marketing and adoption.\r\n\r\nExamples: Arbitrum, Uniswap airdrops.\r\nAlways verify sources to avoid scams.', 'https://www.youtube.com/watch?v=dDgZfNWGj5s', '2025-03-06 00:09:47'),
(15, 'How to Analyze Crypto Projects Before Investing', 'Check the team & whitepaper.\r\nAnalyze tokenomics & utility.\r\nLook at community engagement.\r\nAssess partnerships & roadmap.', 'https://www.youtube.com/watch?v=bw1piBAOG9s', '2025-03-06 00:10:16'),
(16, 'The Future of Cryptocurrency', 'Crypto adoption is growing, with:\r\n\r\nInstitutional investments.\r\nGovernments exploring CBDCs.\r\nLayer-2 scaling solutions (Polygon, Arbitrum).\r\nBlockchain is shaping industries beyond finance.', 'https://www.youtube.com/watch?v=5-rCKo4CBgM', '2025-03-06 00:10:42'),
(17, ' Understanding Gas Fees in Crypto', 'Gas fees are transaction costs paid to miners/validators.\r\n\r\nEthereum: Uses ETH for gas fees (can be high during congestion).\r\nSolana & Polygon: Lower fees compared to Ethereum.\r\nGas fees fluctuate based on network demand.', 'https://www.youtube.com/watch?v=Yh8cHUB-KoU', '2025-03-06 00:11:12'),
(18, 'How to Secure Your Crypto from Hackers', 'Use hardware wallets for long-term storage.\r\nNever share your seed phrase.\r\nEnable two-factor authentication (2FA).\r\nBe cautious of phishing attacks.\r\nUse a VPN for privacy.', 'https://www.youtube.com/watch?v=BdB4m1aAvOE', '2025-03-06 00:11:32'),
(19, 'Crypto Mining vs. Staking: Which One Is Better?', 'Mining (Proof of Work): Uses computational power to validate transactions (Bitcoin).\r\nStaking (Proof of Stake): Users lock up coins to validate transactions (Ethereum 2.0, Solana).\r\nStaking is more energy-efficient, while mining requires expensive hardware.', 'https://www.youtube.com/watch?v=P7Eq03O-LwI', '2025-03-06 00:11:54'),
(20, 'What Are NFTs? Understanding Non-Fungible Tokens', 'NFTs (Non-Fungible Tokens) are digital assets stored on the blockchain that prove ownership of unique items like:\r\n\r\nDigital Art (Bored Ape Yacht Club, CryptoPunks)\r\nMusic & Videos\r\nVirtual Real Estate (Metaverse lands)', 'https://www.youtube.com/watch?v=_0hhgW4YCLs', '2025-03-06 00:12:20'),
(21, 'How Do Crypto Transactions Work?', 'When you send crypto, the transaction is broadcast to a network of nodes. Miners (Proof of Work) or validators (Proof of Stake) verify the transaction.\r\n\r\nSteps in a Transaction:\r\n\r\nYou input the recipient\'s wallet address.\r\nYou sign the transaction with your private key.\r\nThe transaction is sent to the blockchain network.\r\nMiners/validators confirm and record it.', 'https://www.youtube.com/watch?v=bBC-nXj3Ng4', '2025-03-06 00:12:47'),
(22, 'How to Use a Crypto Wallet (Hot vs. Cold Wallets)', 'Crypto wallets store your private keys and allow you to send/receive digital assets.\r\n\r\nTypes of Wallets:\r\n\r\nHot Wallets (Online): MetaMask, Trust Wallet, Phantom (easier but vulnerable to hacks).\r\nCold Wallets (Offline): Ledger, Trezor (more secure but requires hardware).', 'https://www.youtube.com/watch?v=kf28zqP_F2s', '2025-03-06 00:13:15'),
(23, 'What Are Altcoins? Understanding Ethereum, Solana, and More', 'Altcoins are any cryptocurrencies other than Bitcoin. They serve different purposes and improve on Bitcoin’s limitations.\r\n\r\nEthereum (ETH): Smart contracts and decentralized apps.\r\nSolana (SOL): Fast transactions with low fees.\r\nCardano (ADA): Energy-efficient blockchain with research-driven development.\r\nBNB (Binance Coin): Used for trading fee discounts and Binance Smart Chain projects.', 'https://www.youtube.com/watch?v=LorgQfXpuK0', '2025-03-06 00:13:39'),
(24, 'The Role of Bitcoin in the Crypto World', 'Bitcoin (BTC) is the first and most valuable cryptocurrency. It serves as digital gold, offering a decentralized alternative to traditional finance.\r\n\r\nWhy is Bitcoin important?\r\n\r\nLimited Supply – Only 21 million BTC will ever exist.\r\nDecentralized – No government or bank controls it.\r\nSecure – Uses cryptographic technology to prevent fraud.', 'https://www.youtube.com/watch?v=5JDrK7sP3gA', '2025-03-06 00:14:04'),
(25, 'What is Crypto Swapping? A Beginner’s Guide', 'Crypto swapping allows users to exchange one cryptocurrency for another instantly without using traditional trading pairs. It is commonly used in decentralized finance (DeFi) and centralized exchanges.', 'https://www.youtube.com/watch?v=Rpt7Gt6iJro', '2025-03-06 00:15:12'),
(26, 'How to Buy Cryptocurrency?', 'Buying cryptocurrency is easier than ever, thanks to various platforms offering fiat-to-crypto conversion. Here’s a step-by-step guide to help you buy your first crypto safely.', 'https://www.youtube.com/watch?v=PdduvP_KlcI', '2025-03-06 00:40:16');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `blog_id`, `username`, `comment`, `created_at`) VALUES
(5, 3, 'juned', 'bitcoin', '2025-02-17 17:34:24'),
(7, 25, 'junedshaikh', 'hey, can we use uniswap V3', '2025-03-06 00:42:19'),
(8, 25, 'junedshaikh', 'hey, can we use uniswap V3', '2025-03-06 00:43:38'),
(9, 25, 'junedshaikh', 'hey, can we use uniswap V3', '2025-03-06 00:43:50');

-- --------------------------------------------------------

--
-- Table structure for table `login_data`
--

CREATE TABLE `login_data` (
  `login_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `login_otp` int(11) NOT NULL,
  `last_activity` datetime NOT NULL,
  `login_datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `login_data`
--

INSERT INTO `login_data` (`login_id`, `user_id`, `login_otp`, `last_activity`, `login_datetime`) VALUES
(13, 28, 270201, '2018-09-24 08:05:12', '2024-09-18 08:05:12'),
(14, 28, 223932, '2018-09-24 08:18:59', '2024-09-18 08:18:59'),
(15, 28, 407877, '2024-01-25 05:16:23', '2025-01-24 17:16:23'),
(16, 28, 117631, '2024-01-25 05:26:39', '2025-01-24 17:26:39'),
(17, 28, 852547, '0000-00-00 00:00:00', '2025-01-24 17:33:52'),
(18, 28, 406944, '0000-00-00 00:00:00', '2025-01-24 17:35:20'),
(19, 28, 777777, '2025-01-24 17:41:54', '2025-01-26 08:57:55'),
(20, 28, 965769, '2001-02-25 12:41:37', '2025-02-01 07:11:37'),
(21, 28, 270116, '2001-02-25 12:42:57', '2025-02-01 07:12:57'),
(22, 34, 172455, '2025-02-04 10:16:52', '2025-02-04 04:46:52'),
(23, 34, 998042, '2025-02-04 10:17:28', '2025-02-04 04:47:28'),
(24, 34, 722493, '2025-02-04 10:23:43', '2025-02-04 04:53:43'),
(25, 34, 390241, '2004-02-25 10:28:18', '2025-02-04 04:58:18'),
(26, 34, 247710, '2004-02-25 10:30:59', '2025-02-04 05:00:59'),
(27, 35, 574813, '2004-02-25 01:37:22', '2025-02-04 08:07:22'),
(28, 36, 645786, '2008-02-25 01:49:06', '2025-02-07 20:19:06'),
(29, 36, 814619, '2008-02-25 01:51:08', '2025-02-07 20:21:08'),
(30, 37, 798651, '2015-02-25 09:45:48', '2025-02-15 16:15:48'),
(31, 37, 283664, '2015-02-25 09:49:45', '2025-02-15 16:19:45'),
(32, 38, 711302, '2016-02-25 10:41:59', '2025-02-16 17:11:59'),
(33, 34, 854836, '2023-02-25 10:22:25', '2025-02-23 16:52:25'),
(34, 34, 953987, '2006-03-25 06:21:15', '2025-03-06 00:51:15'),
(35, 34, 901311, '2006-03-25 09:28:31', '2025-03-06 03:58:31'),
(36, 34, 856278, '2006-03-25 10:25:09', '2025-03-06 04:55:09'),
(37, 39, 768017, '2009-03-25 10:58:29', '2025-03-09 17:28:29'),
(38, 39, 438796, '2009-03-25 11:01:09', '2025-03-09 17:31:09'),
(39, 34, 387491, '2009-03-25 11:03:22', '2025-03-09 17:33:22'),
(40, 43, 275618, '2028-03-25 12:46:53', '2025-03-27 19:16:53');

-- --------------------------------------------------------

--
-- Table structure for table `logs-DIGI-BTC`
--

CREATE TABLE `logs-DIGI-BTC` (
  `id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `notes` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `logs-DIGI-BTC`
--

INSERT INTO `logs-DIGI-BTC` (`id`, `address`, `ip`, `type`, `status`, `notes`, `timestamp`) VALUES
(1, 'digibolt.in@gmail.com', '202.148.60.247', 'action', 'login', 'Login Successful', '2024-09-13 14:23:23'),
(2, 'digibolt.in@gmail.com', '202.148.60.247', 'action', '200', 'Paid 2000 satoshi  Shorttime: 1726244604 sec', '2024-09-13 14:23:24'),
(3, 'digibolt.in@gmail.com', '202.148.60.247', 'action', 'login', 'Login Successful', '2024-09-13 17:03:37'),
(4, 'digibolt.in@gmail.com', '202.148.60.247', 'action', '200', 'Paid 2000 satoshi  Shorttime: 1726254218 sec', '2024-09-13 17:03:38');

-- --------------------------------------------------------

--
-- Table structure for table `logs-gr8-lite`
--

CREATE TABLE `logs-gr8-lite` (
  `id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `notes` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payouts-DIGI-BTC`
--

CREATE TABLE `payouts-DIGI-BTC` (
  `id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `reward` varchar(255) NOT NULL,
  `usd` varchar(255) NOT NULL,
  `currency` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `slid` varchar(10) DEFAULT NULL,
  `shortlink` varchar(255) DEFAULT NULL,
  `asn` varchar(255) DEFAULT NULL,
  `country` varchar(255) NOT NULL DEFAULT 'other',
  `os` varchar(255) NOT NULL DEFAULT 'other',
  `device` varchar(255) NOT NULL DEFAULT 'other',
  `browser` varchar(255) NOT NULL DEFAULT 'other',
  `user_agent` longtext DEFAULT NULL,
  `referrer` varchar(255) DEFAULT NULL,
  `json` longtext NOT NULL,
  `timestamp` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `payouts-DIGI-BTC`
--

INSERT INTO `payouts-DIGI-BTC` (`id`, `address`, `ip`, `reward`, `usd`, `currency`, `type`, `token`, `slid`, `shortlink`, `asn`, `country`, `os`, `device`, `browser`, `user_agent`, `referrer`, `json`, `timestamp`) VALUES
(1, 'digibolt.in@gmail.com', '202.148.60.247', '2000', '0.00000', 'FEY', 'claim', '', '', '', 'AS17665', 'IN', 'Android', 'mobile', 'Chrome', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Mobile Safari/537.36', 'https://satoshicat.org/DIGI/FEY/', '{\"status\":200,\"message\":\"OK\",\"rate_limit_remaining\":null,\"currency\":\"FEY\",\"balance\":\"599996970\",\"balance_bitcoin\":\"5.99996970\",\"payout_id\":5279730705,\"payout_user_hash\":\"d88e7f6862705c97b6b1d68d1e869f904f2fda0f\",\"httpcode\":200}', '2024-09-13 14:23:24'),
(2, 'digibolt.in@gmail.com', '202.148.60.247', '2000', '0.00000', 'FEY', 'claim', '', '', '', 'AS17665', 'IN', 'Android', 'mobile', 'Chrome', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Mobile Safari/537.36', 'https://satoshicat.org/DIGI/FEY/', '{\"status\":200,\"message\":\"OK\",\"rate_limit_remaining\":null,\"currency\":\"FEY\",\"balance\":\"599994970\",\"balance_bitcoin\":\"5.99994970\",\"payout_id\":5279976641,\"payout_user_hash\":\"d88e7f6862705c97b6b1d68d1e869f904f2fda0f\",\"httpcode\":200}', '2024-09-13 17:03:38');

-- --------------------------------------------------------

--
-- Table structure for table `payouts-gr8-lite`
--

CREATE TABLE `payouts-gr8-lite` (
  `id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `reward` varchar(255) NOT NULL,
  `usd` varchar(255) NOT NULL,
  `currency` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `slid` varchar(10) DEFAULT NULL,
  `shortlink` varchar(255) DEFAULT NULL,
  `asn` varchar(255) DEFAULT NULL,
  `country` varchar(255) NOT NULL DEFAULT 'other',
  `os` varchar(255) NOT NULL DEFAULT 'other',
  `device` varchar(255) NOT NULL DEFAULT 'other',
  `browser` varchar(255) NOT NULL DEFAULT 'other',
  `user_agent` longtext DEFAULT NULL,
  `referrer` varchar(255) DEFAULT NULL,
  `json` longtext NOT NULL,
  `timestamp` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `register_user`
--

CREATE TABLE `register_user` (
  `register_user_id` int(11) NOT NULL,
  `user_name` varchar(250) NOT NULL,
  `user_email` varchar(250) NOT NULL,
  `user_password` varchar(250) NOT NULL,
  `user_activation_code` varchar(250) NOT NULL,
  `user_email_status` enum('not verified','verified') NOT NULL DEFAULT 'not verified',
  `user_otp` int(6) NOT NULL,
  `user_datetime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `register_user`
--

INSERT INTO `register_user` (`register_user_id`, `user_name`, `user_email`, `user_password`, `user_activation_code`, `user_email_status`, `user_otp`, `user_datetime`) VALUES
(34, 'juned', 'juned773836@gmail.com', '$2y$10$vCM69SNWGYcvL12Z1bl1fetsr82N9hseX.7Yq/oeXBH1PsZl2Weoe', '84f3c08e0a8b2756a89d9c75644c2465', 'verified', 601697, '2025-02-04 04:46:23'),
(35, 'juned', 'junedshaikh773836@gmail.com', '$2y$10$dhf9r3aoFPXzbFV8Sq/U4.9aroyjLE70xcNgWdDxccJ4xBs3nC2nW', '13660a09f06f74fefd496ea35af6f591', 'verified', 898870, '2025-02-04 08:06:04'),
(36, 'Seera', 'masirashaikh321@gmail.com', '$2y$10$Wu1aF.Q3/.uLxwfel.hPYurj./QrFFJ05eDbyIywrK7Jajkkz2nnm', '569b8751a7fb458faccaec5f458ec68d', 'verified', 550263, '2025-02-07 20:17:54'),
(37, 'simotomana', 'fckoitzi@gmail.com', '$2y$10$SQ8VsoFrWyRU2WizxVwfHeaEJagrG16F44jCYQO3REk41E9YTliRq', 'f716bab34af4b23f4ecbaab03cc5480e', 'verified', 619970, '2025-02-15 16:14:25'),
(38, 'Abusaad', 'projuned7@gmail.com', '$2y$10$4kjBysYlV4SXjXHxp5P01uwj2CJRT8FBhFMiz3/WIwgogTX1sOo/W', 'f44bb0156e01ceae015fc1e68430e93b', 'verified', 630935, '2025-02-16 17:10:44'),
(39, 'Faiz Ansari', 'zahid.ansari98922@gmail.com', '$2y$10$yJBh.C5VTizp6.TMxNyvduL0WFiXUCaQXpREJGUXaDxj.nQoL6RXS', 'ae70efa2637f13308e4f02cc0412ed59', 'verified', 679155, '2025-03-09 17:26:57'),
(40, 'Andrewtes', 'blakeway.scherer@gmail.com', '$2y$10$iFyVUG6BTSmyY52i0nu6deYeWIftxyoA2A11jONAaXLhqIhB8Bioy', '323e5a9a567586fd90d0526166aa5673', 'not verified', 944092, '2025-03-12 03:08:57'),
(41, 'Brandonchusy', 'GJOHNSON9327@CHARTER.NET', '$2y$10$UF3BWSrXsd8X4cfQOf5DKOcKd8peg4Pv4AWyADRrm1PZPf3Uao0wm', '716b8445e82da8be473d33cbd9cf6cea', 'not verified', 911368, '2025-03-13 20:38:09'),
(42, 'StevenMussy', 'VERNAEELLIS1@YAHOO.COM', '$2y$10$BT2/jCUzqGAJc.hpyMWOyOeB35twbL2pmA/OaA6NBfu3kBrAjlWnm', 'c03acf951594e66db33b69f9f658185a', 'not verified', 445981, '2025-03-22 21:14:38'),
(43, 'admin', 'jed77876@gmail.com', '$2y$10$ksEplpox01vYdeuBQoqufe8XMSyH9PbpTvp.FgwtBLW6ciUwyrB32', 'a0952281126277393e9a503444567024', 'verified', 729359, '2025-03-27 19:15:54');

-- --------------------------------------------------------

--
-- Table structure for table `settings-DIGI-BTC`
--

CREATE TABLE `settings-DIGI-BTC` (
  `name` varchar(64) NOT NULL,
  `value` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `settings-DIGI-BTC`
--

INSERT INTO `settings-DIGI-BTC` (`name`, `value`) VALUES
('name', 'SatoshiCat EX'),
('domain', 'https://satoshicat.org/DIGI/FEY'),
('description', ''),
('microwallet', 'faucetpay'),
('api_key', '8a75e689fe483451b9b6c345e34aefc3be245140222fa3bed49cef180b257493'),
('user_token', ''),
('currency', 'FEY'),
('timer', '1'),
('referral', '100'),
('reward', '2000'),
('balance', '599994970'),
('max_claims', '100'),
('primary_captcha', 'recaptcha'),
('secondary_captcha', ''),
('solvemedia_keys', '{\"challenge_key\":\"\",\"verification_key\":\"\",\"hash_key\":\"\"}'),
('recaptcha_keys', '{\"site_key\":\"6Lc5YUIqAAAAAIG9AXtFdysvxbN5MgdksZZSv9hx\",\"secret_key\":\"6Lc5YUIqAAAAAPnr-LodFae5vx2RmSf3073jLacI\"}'),
('shortlink_timer', '1'),
('iphub_api', ''),
('proxycheck_api', ''),
('disable_balance', ''),
('disable_antibot', 'Y'),
('disable_iframes', 'Y'),
('right_ads', ''),
('bottom_ads', ''),
('paid_box', ''),
('theme', 'cyborg'),
('antibot_theme', 'dark'),
('css', ''),
('navlinks', ''),
('shortlinks', ''),
('version', '3');

-- --------------------------------------------------------

--
-- Table structure for table `settings-gr8-lite`
--

CREATE TABLE `settings-gr8-lite` (
  `name` varchar(64) NOT NULL,
  `value` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `settings-gr8-lite`
--

INSERT INTO `settings-gr8-lite` (`name`, `value`) VALUES
('name', 'GR8 Faucet Lite'),
('domain', 'https://satoshicat.org'),
('description', ''),
('microwallet', ''),
('api_key', ''),
('user_token', ''),
('currency', ''),
('timer', ''),
('referral', ''),
('reward', ''),
('balance', '0'),
('max_claims', ''),
('primary_captcha', 'solvemedia'),
('secondary_captcha', 'none'),
('solvemedia_keys', '{\"challenge_key\":\"\",\"verification_key\":\"\",\"hash_key\":\"\"}'),
('recaptcha_keys', '{\"site_key\":\"\",\"secret_key\":\"\"}'),
('shortlink_timer', '8'),
('iphub_api', ''),
('proxycheck_api', ''),
('disable_balance', ''),
('disable_antibot', ''),
('disable_iframes', ''),
('top_ads', ''),
('left_ads', ''),
('middle_ads', ''),
('right_ads', ''),
('bottom_ads', ''),
('paid_box', ''),
('theme', 'default'),
('antibot_theme', 'dark'),
('css', ''),
('navlinks', ''),
('shortlinks', ''),
('version', '3');

-- --------------------------------------------------------

--
-- Table structure for table `users-DIGI-BTC`
--

CREATE TABLE `users-DIGI-BTC` (
  `id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `ref` varchar(255) NOT NULL,
  `status` enum('active','locked','banned') NOT NULL DEFAULT 'active',
  `last_action` timestamp NULL DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `users-DIGI-BTC`
--

INSERT INTO `users-DIGI-BTC` (`id`, `address`, `ip`, `ref`, `status`, `last_action`, `notes`) VALUES
(1, 'digibolt.in@gmail.com', '202.148.60.247', '', 'active', '2024-09-13 17:03:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users-gr8-lite`
--

CREATE TABLE `users-gr8-lite` (
  `id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `ref` varchar(255) NOT NULL,
  `status` enum('active','locked','banned') NOT NULL DEFAULT 'active',
  `last_action` timestamp NULL DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blog_id` (`blog_id`);

--
-- Indexes for table `login_data`
--
ALTER TABLE `login_data`
  ADD PRIMARY KEY (`login_id`);

--
-- Indexes for table `logs-DIGI-BTC`
--
ALTER TABLE `logs-DIGI-BTC`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs-gr8-lite`
--
ALTER TABLE `logs-gr8-lite`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payouts-DIGI-BTC`
--
ALTER TABLE `payouts-DIGI-BTC`
  ADD PRIMARY KEY (`id`),
  ADD KEY `address` (`address`),
  ADD KEY `ip` (`ip`),
  ADD KEY `slid` (`slid`);

--
-- Indexes for table `payouts-gr8-lite`
--
ALTER TABLE `payouts-gr8-lite`
  ADD PRIMARY KEY (`id`),
  ADD KEY `address` (`address`),
  ADD KEY `ip` (`ip`),
  ADD KEY `slid` (`slid`);

--
-- Indexes for table `register_user`
--
ALTER TABLE `register_user`
  ADD PRIMARY KEY (`register_user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- Indexes for table `settings-DIGI-BTC`
--
ALTER TABLE `settings-DIGI-BTC`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `settings-gr8-lite`
--
ALTER TABLE `settings-gr8-lite`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `users-DIGI-BTC`
--
ALTER TABLE `users-DIGI-BTC`
  ADD PRIMARY KEY (`id`),
  ADD KEY `address` (`address`);

--
-- Indexes for table `users-gr8-lite`
--
ALTER TABLE `users-gr8-lite`
  ADD PRIMARY KEY (`id`),
  ADD KEY `address` (`address`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `login_data`
--
ALTER TABLE `login_data`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `logs-DIGI-BTC`
--
ALTER TABLE `logs-DIGI-BTC`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `logs-gr8-lite`
--
ALTER TABLE `logs-gr8-lite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payouts-DIGI-BTC`
--
ALTER TABLE `payouts-DIGI-BTC`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payouts-gr8-lite`
--
ALTER TABLE `payouts-gr8-lite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `register_user`
--
ALTER TABLE `register_user`
  MODIFY `register_user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `users-DIGI-BTC`
--
ALTER TABLE `users-DIGI-BTC`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users-gr8-lite`
--
ALTER TABLE `users-gr8-lite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
