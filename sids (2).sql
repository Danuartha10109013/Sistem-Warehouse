-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 01, 2025 at 03:06 PM
-- Server version: 5.7.39
-- PHP Version: 8.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sids`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coil`
--

CREATE TABLE `coil` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `berat_produk` int(11) NOT NULL,
  `diameter_produk` int(11) DEFAULT NULL,
  `lebar_produk` int(11) DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `no_gs` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `coil`
--

INSERT INTO `coil` (`id`, `kode_produk`, `nama_produk`, `berat_produk`, `diameter_produk`, `lebar_produk`, `keterangan`, `status`, `no_gs`, `created_at`, `updated_at`) VALUES
(463, 'SL24-111030(1) A', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 3395, NULL, NULL, NULL, 0, 'GSX24-100838', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(464, 'SL24-111030(2) B', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 3395, NULL, NULL, NULL, 0, 'GSX24-100838', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(465, 'SL24-111031(1) A', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 3495, NULL, NULL, NULL, 0, 'GSX24-100838', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(466, 'SL24-111031(2) B', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 3495, NULL, NULL, NULL, 0, 'GSX24-100838', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(467, 'SL24-111032(1) A', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 3056, NULL, NULL, NULL, 0, 'GSX24-100838', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(468, 'SL24-111032(2) B', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 3056, NULL, NULL, NULL, 0, 'GSX24-100838', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(469, 'SL24-111033(1) A', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 4632, NULL, NULL, NULL, 0, 'GSX24-100838', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(470, 'SL24-111033(2) B', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 4632, NULL, NULL, NULL, 0, 'GSX24-100839', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(471, 'SL24-111034(1) A', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 4563, NULL, NULL, NULL, 0, 'GSX24-100839', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(472, 'SL24-111034(2) B', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 4563, NULL, NULL, NULL, 0, 'GSX24-100839', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(473, 'SL24-111035(1) A', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 4591, NULL, NULL, NULL, 0, 'GSX24-100839', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(474, 'SL24-111035(2) B', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 4591, NULL, NULL, NULL, 0, 'GSX24-100839', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(475, 'SL24-111036(1) A', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 4560, NULL, NULL, NULL, 0, 'GSX24-100840', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(476, 'SL24-111036(2) B', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 4560, NULL, NULL, NULL, 0, 'GSX24-100840', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(477, 'SL24-111037(1) A', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 4829, NULL, NULL, NULL, 0, 'GSX24-100840', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(478, 'SL24-111037(2) B', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 4829, NULL, NULL, NULL, 0, 'GSX24-100840', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(479, 'SL24-111038(1) A', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 4772, NULL, NULL, NULL, 0, 'GSX24-100840', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(480, 'SL24-111038(2) B', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 4772, NULL, NULL, NULL, 0, 'GSX24-100841', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(481, 'SL24-111039(1) A', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 4860, NULL, NULL, NULL, 0, 'GSX24-100841', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(482, 'SL24-111039(2) B', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 4860, NULL, NULL, NULL, 0, 'GSX24-100841', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(483, 'SL24-111040(1) A', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 4751, NULL, NULL, NULL, 0, 'GSX24-100841', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(484, 'SL24-111040(2) B', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 4751, NULL, NULL, NULL, 0, 'GSX24-100841', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(485, 'SL24-111041(1) A', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 4543, NULL, NULL, NULL, 0, 'GSX24-100842', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(486, 'SL24-111041(2) B', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 4543, NULL, NULL, NULL, 0, 'GSX24-100842', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(487, 'SL24-111042(1) A', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 4557, NULL, NULL, NULL, 0, 'GSX24-100842', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(488, 'SL24-111042(2) B', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 4557, NULL, NULL, NULL, 0, 'GSX24-100842', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(489, 'SL24-111045(1) A', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 4500, NULL, NULL, NULL, 0, 'GSX24-100842', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(490, 'SL24-111043(1) A', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 4039, NULL, NULL, NULL, 0, 'GSX24-100843', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(491, 'SL24-111043(2) B', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 4039, NULL, NULL, NULL, 0, 'GSX24-100843', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(492, 'SL24-111044(1) A', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 4008, NULL, NULL, NULL, 0, 'GSX24-100843', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(493, 'SL24-111044(2) B', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 4008, NULL, NULL, NULL, 0, 'GSX24-100843', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(494, 'SL24-111045(2) B', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 4500, NULL, NULL, NULL, 0, 'GSX24-100843', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(495, 'SL24-111047(1) A', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 3965, NULL, NULL, NULL, 0, 'GSX24-100843', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(496, 'SL24-111046(1) A', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 4404, NULL, NULL, NULL, 0, 'GSX24-100844', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(497, 'SL24-111046(2) B', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 4404, NULL, NULL, NULL, 0, 'GSX24-100844', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(498, 'SL24-111047(2) B', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 3965, NULL, NULL, NULL, 0, 'GSX24-100844', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(499, 'SL24-111076(1) A-B', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 5632, NULL, NULL, NULL, 0, 'GSX24-100844', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(500, 'SL24-111076(2) C', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 2816, NULL, NULL, NULL, 0, 'GSX24-100844', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(501, 'SL24-111077(2) C', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 2809, NULL, NULL, NULL, 0, 'GSX24-100844', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(502, 'SL24-111077(1) A-B', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 5618, NULL, NULL, NULL, 0, 'GSX24-100845', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(503, 'SL24-111078(2) C', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 2849, NULL, NULL, NULL, 0, 'GSX24-100845', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(504, 'SL24-111079(2) C', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 2829, NULL, NULL, NULL, 0, 'GSX24-100845', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(505, 'SL24-111079(1) A-B', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 5658, NULL, NULL, NULL, 0, 'GSX24-100845', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(506, 'SL24-111083(1) A-B', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 5062, NULL, NULL, NULL, 0, 'GSX24-100845', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(507, 'SL24-111078(1) A-B', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 5698, NULL, NULL, NULL, 0, 'GSX24-100846', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(508, 'SL24-111080(1) A-B', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 5130, NULL, NULL, NULL, 0, 'GSX24-100846', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(509, 'SL24-111080(2) C', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 2565, NULL, NULL, NULL, 0, 'GSX24-100846', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(510, 'SL24-111083(2) C', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 2531, NULL, NULL, NULL, 0, 'GSX24-100846', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(511, 'SL24-111084(1) A-B', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 5312, NULL, NULL, NULL, 0, 'GSX24-100846', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(512, 'SL24-111084(2) C', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 2656, NULL, NULL, NULL, 0, 'GSX24-100847', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(513, 'SL24-111085(2) C', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 2648, NULL, NULL, NULL, 0, 'GSX24-100847', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(514, 'SL24-111085(1) A-B', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 5296, NULL, NULL, NULL, 0, 'GSX24-100847', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(515, 'SL24-111091(2) C', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 2453, NULL, NULL, NULL, 0, 'GSX24-100847', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(516, 'SL24-111086(2) C', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 2696, NULL, NULL, NULL, 0, 'GSX24-100847', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(517, 'SL24-111091(1) A-B', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 4906, NULL, NULL, NULL, 0, 'GSX24-100847', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(518, 'SL24-111191(2) B', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 3262, NULL, NULL, NULL, 0, 'GSX24-100847', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(519, 'SL24-111086(1) A-B', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 5392, NULL, NULL, NULL, 0, 'GSX24-100848', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(520, 'SL24-111087(1) A-B', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 5326, NULL, NULL, NULL, 0, 'GSX24-100848', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(521, 'SL24-111087(2) C', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 2663, NULL, NULL, NULL, 0, 'GSX24-100848', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(522, 'SL24-111088(2) C', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 2674, NULL, NULL, NULL, 0, 'GSX24-100848', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(523, 'SL24-111088(1) A-B', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 5348, NULL, NULL, NULL, 0, 'GSX24-100848', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(524, 'SL24-111089(1) A-B', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 5320, NULL, NULL, NULL, 0, 'GSX24-100849', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(525, 'SL24-111089(2) C', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 2660, NULL, NULL, NULL, 0, 'GSX24-100849', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(526, 'SL24-111090(2) C', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 2768, NULL, NULL, NULL, 0, 'GSX24-100849', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(527, 'SL24-111090(1) A-B', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 5536, NULL, NULL, NULL, 0, 'GSX24-100849', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(528, 'SL24-111095(1) A-B', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 5724, NULL, NULL, NULL, 0, 'GSX24-100849', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(529, 'SL24-111114(1) A-B', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 4750, NULL, NULL, NULL, 0, 'GSX24-100850', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(530, 'SL24-111092(2) C', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 2724, NULL, NULL, NULL, 0, 'GSX24-100850', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(531, 'SL24-111108(2) C', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 2587, NULL, NULL, NULL, 0, 'GSX24-100850', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(532, 'SL24-111108(1) A-B', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 5174, NULL, NULL, NULL, 0, 'GSX24-100850', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(533, 'SL24-111111(1) A-B', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 5188, NULL, NULL, NULL, 0, 'GSX24-100850', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(534, 'SL24-111193(2) B', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 4100, NULL, NULL, NULL, 0, 'GSX24-100850', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(535, 'SL24-111109(1) A-B', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 4764, NULL, NULL, NULL, 0, 'GSX24-100851', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(536, 'SL24-111109(2) C', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 2382, NULL, NULL, NULL, 0, 'GSX24-100851', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(537, 'SL24-111110(2) C', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 2551, NULL, NULL, NULL, 0, 'GSX24-100851', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(538, 'SL24-111110(1) A-B', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 5102, NULL, NULL, NULL, 0, 'GSX24-100851', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(539, 'SL24-111111(2) C', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 2594, NULL, NULL, NULL, 0, 'GSX24-100851', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(540, 'SL24-111112(2) C', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 2450, NULL, NULL, NULL, 0, 'GSX24-100851', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(541, 'SL24-111112(1) A-B', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 4900, NULL, NULL, NULL, 0, 'GSX24-100851', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(542, 'SL24-111095(2) C', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 2862, NULL, NULL, NULL, 0, 'GSX24-100852', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(543, 'SL24-111114(2) C', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 2375, NULL, NULL, NULL, 0, 'GSX24-100852', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(544, 'SL24-111092(1) A-B', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 5448, NULL, NULL, NULL, 0, 'GSX24-100852', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(545, 'SL24-111097(1) A-B', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 5568, NULL, NULL, NULL, 0, 'GSX24-100852', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(546, 'SL24-111097(2) C', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 2784, NULL, NULL, NULL, 0, 'GSX24-100852', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(547, 'SL24-111098(2) C', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 2984, NULL, NULL, NULL, 0, 'GSX24-100852', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(548, 'SL24-111098(1) A-B', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 5968, NULL, NULL, NULL, 1, 'GSX24-100853', '2024-12-15 19:04:53', '2024-12-24 04:33:02'),
(549, 'SL24-111099(1) A-B', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 5968, NULL, NULL, NULL, 1, 'GSX24-100853', '2024-12-15 19:04:53', '2024-12-24 04:33:02'),
(550, 'SL24-111099(2) C', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 2984, NULL, NULL, NULL, 1, 'GSX24-100853', '2024-12-15 19:04:53', '2024-12-24 04:33:02'),
(551, 'SL24-111100(2) C', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 2953, NULL, NULL, NULL, 0, 'GSX24-100853', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(552, 'SL24-111100(1) A-B', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 5906, NULL, NULL, NULL, 1, 'GSX24-100853', '2024-12-15 19:04:53', '2024-12-24 04:33:01'),
(553, 'SL24-111102(1) A-B', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 5978, NULL, NULL, NULL, 1, 'GSX24-100854', '2024-12-15 19:04:53', '2024-12-24 08:54:49'),
(554, 'SL24-111102(2) C', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 2989, NULL, NULL, NULL, 1, 'GSX24-100854', '2024-12-15 19:04:53', '2024-12-24 08:54:49'),
(555, 'SL24-111103(2) C', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 2981, NULL, NULL, NULL, 0, 'GSX24-100854', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(556, 'SL24-111103(1) A-B', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 5962, NULL, NULL, NULL, 1, 'GSX24-100854', '2024-12-15 19:04:53', '2024-12-24 08:54:49'),
(557, 'SL24-111104(1) A-B', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 5752, NULL, NULL, NULL, 1, 'GSX24-100854', '2024-12-15 19:04:53', '2024-12-24 08:54:49'),
(558, 'SL24-111104(2) C', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 2876, NULL, NULL, NULL, 1, 'GSX24-100855', '2024-12-15 19:04:53', '2024-12-24 08:50:08'),
(559, 'SL24-111105(2) C', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 2852, NULL, NULL, NULL, 0, 'GSX24-100855', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(560, 'SL24-111105(1) A-B', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 5704, NULL, NULL, NULL, 1, 'GSX24-100855', '2024-12-15 19:04:53', '2024-12-24 08:50:08'),
(561, 'SL24-111106(1) A-B', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 5778, NULL, NULL, NULL, 1, 'GSX24-100855', '2024-12-15 19:04:53', '2024-12-24 08:50:08'),
(562, 'SL24-111106(2) C', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 2889, NULL, NULL, NULL, 1, 'GSX24-100855', '2024-12-15 19:04:53', '2024-12-24 08:50:08'),
(563, 'SL24-111107(2) C', '2.40 x 525mm Z35 D490 NEXIUM® PASSIVATION MgZn', 2953, NULL, NULL, NULL, 0, 'GSX24-100855', '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(564, 'a123', '1.45 x 1035mm Z45 D570 NEXIUM® PASSIVATION MgZn', 4587, NULL, NULL, NULL, 0, 'gsbaruu', '2025-05-28 19:50:12', '2025-05-28 19:50:12'),
(565, 'a124', '1.45 x 1035mm Z45 D570 NEXIUM® PASSIVATION MgZn', 4534, NULL, NULL, NULL, 0, 'gsbaruu', '2025-05-28 19:50:12', '2025-05-28 19:50:12'),
(566, 'a125', '1.45 x 1035mm Z45 D570 NEXIUM® PASSIVATION MgZn', 4565, NULL, NULL, NULL, 0, 'gsbaruu', '2025-05-28 19:50:12', '2025-05-28 19:50:12'),
(567, 'a126', '1.45 x 1035mm Z45 D570 NEXIUM® PASSIVATION MgZn', 4587, NULL, NULL, NULL, 0, 'gsbaruu', '2025-05-28 19:50:12', '2025-05-28 19:50:12'),
(568, 'a127', '1.45 x 1035mm Z45 D570 NEXIUM® PASSIVATION MgZn', 4534, NULL, NULL, NULL, 0, 'gsbaruu', '2025-05-28 19:50:12', '2025-05-28 19:50:12'),
(569, 'a128', '1.45 x 1035mm Z45 D570 NEXIUM® PASSIVATION MgZn', 4565, NULL, NULL, NULL, 0, 'gsbaruu', '2025-05-28 19:50:12', '2025-05-28 19:50:12');

-- --------------------------------------------------------

--
-- Table structure for table `coil_damage`
--

CREATE TABLE `coil_damage` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `attribute` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `berat_coil` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_handling` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` json NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coil_damage`
--

INSERT INTO `coil_damage` (`id`, `attribute`, `user_id`, `berat_coil`, `jenis_handling`, `foto`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'CI22-1100565', '14', '20000', 'Crane', '[\"1747323719_halutama.png\", \"1747323720_loginpage.png\"]', NULL, '2025-05-15 15:42:00', '2025-05-15 15:42:00');

-- --------------------------------------------------------

--
-- Table structure for table `crane`
--

CREATE TABLE `crane` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `shift_leader` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shift` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_crane` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `start` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ket_start` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `switch` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ket_switch` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `up` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ket_up` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `down` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ket_down` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ctravel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ket_ctravel` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ltravel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ket_ltravel` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emergency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ket_emergency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `speed1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ket_speed1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `speed2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ket_speed2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `block` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ket_block` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lockert` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ket_lockert` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wire` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ket_wire` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sltravel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ket_sltravel` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sirinelt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ket_sirinelt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brakeno` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ket_brakeno` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brakeya` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ket_brakeya` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bcno` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ket_bcno` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bcya` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ket_bcya` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updno` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ket_updno` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updya` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ket_updya` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `crcros` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ket_crcros` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `mtc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `crane`
--

INSERT INTO `crane` (`id`, `user_id`, `shift_leader`, `shift`, `jenis_crane`, `date`, `start`, `ket_start`, `switch`, `ket_switch`, `up`, `ket_up`, `down`, `ket_down`, `ctravel`, `ket_ctravel`, `ltravel`, `ket_ltravel`, `emergency`, `ket_emergency`, `speed1`, `ket_speed1`, `speed2`, `ket_speed2`, `block`, `ket_block`, `lockert`, `ket_lockert`, `wire`, `ket_wire`, `sltravel`, `ket_sltravel`, `sirinelt`, `ket_sirinelt`, `brakeno`, `ket_brakeno`, `brakeya`, `ket_brakeya`, `bcno`, `ket_bcno`, `bcya`, `ket_bcya`, `updno`, `ket_updno`, `updya`, `ket_updya`, `crcros`, `ket_crcros`, `catatan`, `mtc`, `created_at`, `updated_at`) VALUES
(7, 74, 'panggah', '1', '5 Ton L8 (No. 1)', '2024-12-18', 'v', NULL, 'o', 'switch rusak', 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, NULL, 'mulyadi', '2024-12-18 07:16:52', '2024-12-18 07:16:52'),
(8, 65, 'Riyan H', '1', '5 Ton L8 (No. 2)', '2024-12-18', 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, NULL, 'Mulyadi', '2024-12-18 08:13:00', '2024-12-18 08:13:00'),
(9, 65, 'Riyan H', '3', '30 Ton', '2024-12-18', 'o', NULL, 'o', NULL, 'o', NULL, 'o', NULL, 'o', NULL, 'o', NULL, 'o', NULL, 'o', NULL, 'o', NULL, 'o', NULL, 'o', NULL, 'o', NULL, 'o', NULL, 'o', NULL, 'o', NULL, 'o', NULL, 'o', NULL, 'o', NULL, 'o', NULL, 'o', NULL, 'o', NULL, NULL, 'Mulyadi', '2024-12-18 08:14:23', '2024-12-18 08:14:23'),
(10, 19, 'Riyan H', '1', '5 Ton L8 (No. 2)', '2024-12-18', 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, NULL, 'Mulyadi', '2024-12-18 08:14:24', '2024-12-18 08:14:24'),
(11, 65, 'Freddy', '3', '30 Ton', '2024-12-18', 'o', NULL, 'o', NULL, 'o', NULL, 'o', NULL, 'o', NULL, 'o', NULL, 'o', NULL, 'o', NULL, 'o', NULL, 'o', NULL, 'o', NULL, 'o', NULL, 'o', NULL, 'o', NULL, 'o', NULL, 'o', NULL, 'o', NULL, 'o', NULL, 'o', NULL, 'o', NULL, 'o', 'Sedang  baik baik aja', 'Ok', 'Yadi', '2024-12-18 08:15:58', '2024-12-18 08:15:58'),
(12, 65, 'Danu', '1', '5 Ton L8 (No. 1)', '2024-12-18', 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, NULL, 'Edi', '2024-12-18 08:16:23', '2024-12-18 08:16:23'),
(13, 96, 'Freddy', '1', '5 Ton L8 (No. 1)', '2024-12-18', 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, NULL, 'mulyadi', '2024-12-18 08:17:24', '2024-12-18 08:17:24'),
(16, 86, 'Riyan H', '1', '10 Ton', '2024-12-20', 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, NULL, 'Mulyadi', '2024-12-19 22:43:44', '2024-12-19 22:43:44'),
(19, 86, 'Riyan H', '1', '10 Ton', '2024-12-21', 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, NULL, 'Mulyadi', '2024-12-20 23:11:26', '2024-12-20 23:11:26'),
(20, 25, 'Freddy', '2', '10 Ton', '2024-12-21', 'v', 'kondisi  baik', 'v', 'kondisi baik', 'v', 'kondisi baik', 'v', 'kondisi baik', 'v', 'kondisi baik', 'v', 'kondisi baik', 'v', 'kondisi baik', 'v', 'kondisi baik', 'v', 'kondisi baik', 'v', 'kondisi baik', 'v', 'kondisi baik', 'v', 'kondisi baik', 'v', 'kondisi baik', 'v', 'kondisi baik', 'v', 'kondisi baik', 'v', 'kondisi baik', 'v', 'kondisi baik', 'v', 'kondisi baik', 'v', 'kondisi baik', 'v', 'kondisi baik', 'v', 'kondisi baik', NULL, 'mulyadi', '2024-12-21 07:51:44', '2024-12-21 07:51:44'),
(21, 60, 'Freddy', '3', '10 Ton', '2024-12-21', 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'o', 'Rantas 1 helai', 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, NULL, 'Mulyadi', '2024-12-21 15:59:32', '2024-12-21 15:59:32'),
(22, 73, 'Freddy', '2', '30 Ton', '2024-12-22', 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'o', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'rel selatan dan cross bunyi kasar', 'Mulyadi', '2024-12-22 07:03:35', '2024-12-22 07:03:35'),
(23, 67, 'Riyan H', '2', '30 Ton', '2024-12-23', 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'o', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, NULL, 'Mulyadi', '2024-12-23 02:01:58', '2024-12-23 02:01:58'),
(24, 28, 'Freddy', '1', '10 Ton', '2024-12-24', 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'o', 'Rantas 1 helai', 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, NULL, 'Mulyadi', '2024-12-24 17:31:19', '2024-12-24 17:31:19'),
(25, 60, 'Freddy', '3', '10 Ton', '2025-01-20', 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'o', 'Rantas 4 helai', 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'o', 'Bunyi keras saat jeda 3-4 detik dan lampu indikator menyala', 'o', 'Bunyi keras saat jeda 3-4 detik dan lampu indikator menyala', 'v', NULL, NULL, 'Mulyadi', '2025-01-20 09:43:27', '2025-01-20 09:43:27'),
(26, 72, 'Panggah S', '1', '5 Ton L8 (No. 2)', '2025-01-22', 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, NULL, 'Mulyadi', '2025-01-22 08:24:18', '2025-01-22 08:24:18'),
(27, 67, 'Danu', '3', '30 Ton', '2025-01-22', 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'o', NULL, 'v', NULL, 'v', 'OK(BELUM ADA YANG BERSERABUT)', 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'LONG TREVEL SAAT BAWA BEBAN BUNYI KASAR', 'mulyadi', '2025-01-22 15:50:53', '2025-01-22 15:50:53'),
(28, 74, 'Panggah S', '3', '5 Ton L8 (No. 1)', '2025-01-22', 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, NULL, 'mulyadi', '2025-01-22 17:37:39', '2025-01-22 17:37:39'),
(29, 24, 'Freddy', '1', '30 Ton', '2025-01-22', 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'o', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, NULL, 'mulyadi', '2025-01-22 18:02:41', '2025-01-22 18:02:41'),
(30, 78, 'Freddy', '1', '30 Ton', '2025-01-23', 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'o', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, NULL, 'mulyadi', '2025-01-22 23:37:14', '2025-01-22 23:37:14'),
(31, 76, 'Dika', '2', '30 Ton', '2025-01-23', 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'o', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, NULL, 'mulyadi', '2025-01-23 00:25:45', '2025-01-23 00:25:45'),
(32, 72, 'Panggah S', '1', '5 Ton L8 (No. 2)', '2025-01-23', 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'o', 'Saat membawa beban crane tidak mau jalan nyangkut di sambungan rell', 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, NULL, 'Mulyadi', '2025-01-23 06:21:27', '2025-01-23 06:21:27'),
(33, 32, 'Dika', '2', '10 Ton', '2025-01-24', 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, NULL, 'Mulyadi', '2025-01-24 07:56:02', '2025-01-24 07:56:02'),
(34, 72, 'Panggah S', '1', '5 Ton L8 (No. 2)', '2025-01-25', 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'o', 'Pas sambungan rell saat membawa beban crane berhenti sebelah', 'o', NULL, 'o', NULL, 'o', NULL, 'o', NULL, 'o', NULL, NULL, 'Mulyadi', '2025-01-25 03:20:24', '2025-01-25 03:20:24'),
(35, 43, 'Freddy', '2', '30 Ton', '2025-01-25', 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'o', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, NULL, 'mulyadi', '2025-01-25 06:58:24', '2025-01-25 06:58:24'),
(36, 24, 'Freddy', '2', '30 Ton', '2025-01-26', 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'o', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, NULL, 'mulyadi', '2025-01-26 00:06:33', '2025-01-26 00:06:33'),
(37, 28, 'Freddy', '2', '10 Ton', '2025-01-26', 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'o', 'Rantas +/- 4 helai', 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, NULL, 'Mulyadi', '2025-01-26 06:00:36', '2025-01-26 06:00:36'),
(38, 64, 'Dika', '3', '30 Ton', '2025-01-27', 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'o', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, NULL, 'mulyadi', '2025-01-27 08:29:22', '2025-01-27 08:29:22'),
(39, 72, 'Panggah S', '1', '5 Ton L8 (No. 2)', '2025-01-28', 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, NULL, 'Mulyadi', '2025-01-28 04:01:52', '2025-01-28 04:01:52'),
(40, 67, 'Danu', '2', '30 Ton', '2025-01-28', 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'o', NULL, 'v', NULL, 'v', 'OK(BELUM ADA YANG BERSERABUT)', 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'LONG TREVEL SAAT BAWA BEBAN BUNYI KASAR', 'mulyadi', '2025-01-28 07:01:09', '2025-01-28 07:01:09'),
(41, 32, 'Dika', '1', '10 Ton', '2025-01-29', 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, NULL, 'Mulyadi', '2025-01-28 23:54:32', '2025-01-28 23:54:32'),
(42, 67, 'Danu', '2', '30 Ton', '2025-01-29', 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'o', NULL, 'v', NULL, 'v', 'OK(BELUM ADA YANG BERSERABUT)', 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'LONG TREVEL SAAT BAWA BEBAN BUNYI KASAR', 'mulyadi', '2025-01-29 00:50:41', '2025-01-29 00:50:41'),
(43, 78, 'Freddy', '3', '30 Ton', '2025-01-28', 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'o', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, NULL, 'mulyadi', '2025-01-29 08:48:30', '2025-01-29 08:48:30'),
(44, 76, 'Dika', '1', '30 Ton', '2025-01-29', 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'o', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, NULL, 'Mulyadi', '2025-01-29 23:33:53', '2025-01-29 23:33:53'),
(45, 73, 'Danu', '3', '30 Ton', '2025-01-30', 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'o', NULL, 'v', NULL, 'v', NULL, 'long kadang tidak langsung berhenti', 'mulyadi', '2025-01-30 08:50:43', '2025-01-30 08:50:43'),
(46, 24, 'Freddy', '1', '30 Ton', '2025-01-29', 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'o', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, NULL, 'mulyadi', '2025-01-30 16:42:43', '2025-01-30 16:42:43'),
(47, 78, 'Freddy', '1', '30 Ton', '2025-01-30', 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'o', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, NULL, 'mulyadi', '2025-01-30 16:44:10', '2025-01-30 16:44:10'),
(48, 78, 'Freddy', '1', '30 Ton', '2025-01-30', 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'o', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, NULL, 'mulyadi', '2025-01-30 23:03:58', '2025-01-30 23:03:58'),
(49, 67, 'Danu', '3', '30 Ton', '2025-01-31', 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'o', NULL, 'v', NULL, 'v', 'OK(BELUM ADA YANG BERSERABUT)', 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'long kadang tidak langsung berhenti', 'mulyadi', '2025-01-31 13:20:47', '2025-01-31 13:20:47'),
(50, 40, 'Dika', '2', '30 Ton', '2025-02-01', 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'o', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'long kadang tidak langsung berhenti', 'mulyadi', '2025-02-01 03:06:17', '2025-02-01 03:06:17'),
(51, 32, 'Riyan H', '2', '10 Ton', '2025-02-01', 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, NULL, 'Mulyadi', '2025-02-01 11:51:44', '2025-02-01 11:51:44'),
(52, 73, 'Danu', '1', '30 Ton', '2025-02-02', 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'o', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'long kadang tidak langsung berhenti, sering ngetrip saat bawa beban diantara column E2-E3', 'mulyadi', '2025-02-01 23:52:18', '2025-02-01 23:52:18'),
(53, 64, 'Dika', '2', '30 Ton', '2025-02-02', 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'o', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, NULL, 'mulyadi', '2025-02-02 00:23:51', '2025-02-02 00:23:51'),
(54, 76, 'Dika', '2', '30 Ton', '2025-02-03', 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'o', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'long kadang tidak langsung berhenti', 'mulyadi', '2025-02-03 06:23:21', '2025-02-03 06:23:21'),
(55, 78, 'Freddy', '2', '30 Ton', '2025-02-05', 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'o', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'long kadang tidak langsung berhenti', 'mulyadi', '2025-02-05 04:14:53', '2025-02-05 04:14:53'),
(56, 76, 'Dika', '3', '30 Ton', '2025-02-05', 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'o', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'long kadang tidak langsung berhenti', 'mulyadi', '2025-02-05 09:04:01', '2025-02-05 09:04:01'),
(57, 64, 'Riyan H', '1', '30 Ton', '2025-02-05', 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'o', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, NULL, 'mulyadi', '2025-02-05 16:45:57', '2025-02-05 16:45:57'),
(58, 14, 'Alex (PRD)', '1', '30 Ton', '2025-05-08', 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, NULL, 'MTCan', '2025-05-08 05:38:12', '2025-05-08 05:38:12'),
(59, 14, 'Danuartha', '2', 'Other', '2025-05-14', 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, NULL, 'Manitence', '2025-05-14 08:59:42', '2025-05-14 08:59:42'),
(60, 14, 'Danuartha', '3', 'Crane baru 123', '2025-05-14', 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, NULL, 'Manitence', '2025-05-14 09:13:42', '2025-05-14 09:13:42'),
(61, 101, 'Panggah', '2', '30 Ton', '2025-05-28', 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, '-', 'mtc', '2025-05-28 13:25:19', '2025-05-28 13:25:19');

-- --------------------------------------------------------

--
-- Table structure for table `crc`
--

CREATE TABLE `crc` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `shift_leader` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `supplier` json DEFAULT NULL,
  `other_supplier` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_awal` text COLLATE utf8mb4_unicode_ci,
  `cuaca` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` json DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `sesuai` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto1` json DEFAULT NULL,
  `keterangan1` text COLLATE utf8mb4_unicode_ci,
  `baik` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto2` json DEFAULT NULL,
  `keterangan2` text COLLATE utf8mb4_unicode_ci,
  `kering` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto3` json DEFAULT NULL,
  `keterangan3` text COLLATE utf8mb4_unicode_ci,
  `kencang` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto4` json DEFAULT NULL,
  `keterangan4` text COLLATE utf8mb4_unicode_ci,
  `jumlahin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto5` json DEFAULT NULL,
  `keterangan5` text COLLATE utf8mb4_unicode_ci,
  `alas` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto6` json DEFAULT NULL,
  `keterangan6` text COLLATE utf8mb4_unicode_ci,
  `wall` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto7` json DEFAULT NULL,
  `keterangan7` text COLLATE utf8mb4_unicode_ci,
  `perganjalan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `crc`
--

INSERT INTO `crc` (`id`, `user_id`, `shift_leader`, `date`, `supplier`, `other_supplier`, `ket_awal`, `cuaca`, `foto`, `keterangan`, `sesuai`, `foto1`, `keterangan1`, `baik`, `foto2`, `keterangan2`, `kering`, `foto3`, `keterangan3`, `kencang`, `foto4`, `keterangan4`, `jumlahin`, `foto5`, `keterangan5`, `alas`, `foto6`, `keterangan6`, `wall`, `foto7`, `keterangan7`, `perganjalan`, `created_at`, `updated_at`) VALUES
(4, 31, '129466', '2024-12-13', '[\"Stinko / Posco Vietnam\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Menggunakan side wall', NULL, NULL, 'Ya', '2024-12-13 09:58:45', '2024-12-13 09:58:45'),
(5, 31, '129468', '2024-12-13', '[\"Posco Korea / Posco\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Menggunakan side wall', NULL, NULL, 'Ya', '2024-12-13 09:59:36', '2024-12-13 09:59:36'),
(6, 31, '129473', '2024-12-13', '[\"Posco Korea / Posco\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Menggunakan side wall', NULL, NULL, 'Ya', '2024-12-13 10:00:13', '2024-12-13 10:00:13'),
(7, 31, '129472', '2024-12-13', '[\"Posco Korea / Posco\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Menggunakan side wall', NULL, NULL, 'Ya', '2024-12-13 10:00:54', '2024-12-13 10:00:54'),
(8, 31, '129492', '2024-12-13', '[\"Posco Korea / Posco\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Menggunakan side wall', NULL, NULL, 'Ya', '2024-12-13 10:02:00', '2024-12-13 10:02:00'),
(9, 31, '129495', '2024-12-13', '[\"Posco Korea / Posco\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Menggunakan side wall', NULL, NULL, 'Ya', '2024-12-13 10:02:46', '2024-12-13 10:02:46'),
(10, 31, '129494', '2024-12-13', '[\"Posco Korea / Posco\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Menggunakan side wall', NULL, NULL, 'Ya', '2024-12-13 10:03:24', '2024-12-13 10:03:24'),
(11, 31, '129475', '2024-12-14', '[\"Posco Korea / Posco\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Menggunakan side wall', NULL, NULL, 'Ya', '2024-12-13 10:33:52', '2024-12-13 10:33:52'),
(12, 31, '129476', '2024-12-14', '[\"Posco Korea / Posco\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Menggunakan side wall', NULL, NULL, 'Ya', '2024-12-13 10:34:46', '2024-12-13 10:34:46'),
(13, 31, '129497', '2024-12-13', '[\"Posco Korea / Posco\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, '1 crc packingan sobek', 'Kering/Tidak kena air', NULL, '1 crc cbl 0207 packingan sobek saat masih di atas trailer', 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Menggunakan side wall', NULL, NULL, 'Ya', '2024-12-13 10:48:40', '2024-12-13 10:48:40'),
(14, 31, '7400010776', '2024-12-14', '[\"Krakatau Baja Industri\"]', NULL, '3', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Menggunakan side wall', NULL, NULL, 'Ya', '2024-12-13 15:24:02', '2024-12-13 15:24:02'),
(15, 31, '129478', '2024-12-14', '[\"Posco Korea / Posco\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Menggunakan side wall', NULL, NULL, 'Ya', '2024-12-13 15:31:05', '2024-12-13 15:31:05'),
(16, 31, '129477', '2024-12-14', '[\"Posco Korea / Posco\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Menggunakan side wall', NULL, NULL, 'Ya', '2024-12-13 15:31:47', '2024-12-13 15:31:47'),
(17, 31, '129479', '2024-12-14', '[\"Posco Korea / Posco\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Menggunakan side wall', NULL, NULL, 'Ya', '2024-12-13 15:32:30', '2024-12-13 15:32:30'),
(18, 31, '129462', '2024-12-14', '[\"Posco Korea / Posco\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Menggunakan side wall', NULL, NULL, 'Ya', '2024-12-13 15:33:10', '2024-12-13 15:33:10'),
(19, 31, '129474', '2024-12-14', '[\"Posco Korea / Posco\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Menggunakan side wall', NULL, NULL, 'Ya', '2024-12-13 15:33:48', '2024-12-13 15:33:48'),
(20, 31, '129480', '2024-12-14', '[\"Posco Korea / Posco\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Menggunakan side wall', NULL, NULL, 'Ya', '2024-12-13 15:34:25', '2024-12-13 15:34:25'),
(21, 31, '129530', '2024-12-14', '[\"Posco Korea / Posco\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Menggunakan side wall', NULL, NULL, 'Ya', '2024-12-13 16:19:34', '2024-12-13 16:19:34'),
(22, 31, '129532', '2024-12-14', '[\"Posco Korea / Posco\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Menggunakan side wall', NULL, NULL, 'Ya', '2024-12-13 16:20:15', '2024-12-13 16:20:15'),
(23, 31, '129463', '2024-12-14', '[\"Posco Korea / Posco\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Menggunakan side wall', NULL, NULL, 'Ya', '2024-12-13 16:20:56', '2024-12-13 16:20:56'),
(24, 31, '1292531', '2024-12-14', '[\"Posco Korea / Posco\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Menggunakan side wall', NULL, NULL, 'Ya', '2024-12-13 16:21:45', '2024-12-13 16:21:45'),
(25, 31, '129487', '2024-12-14', '[\"Posco Korea / Posco\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Menggunakan side wall', NULL, NULL, 'Ya', '2024-12-13 16:23:22', '2024-12-13 16:23:22'),
(26, 43, '7400011886', '2025-01-21', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-21 16:17:10', '2025-01-21 16:17:10'),
(27, 43, '7400011832', '2025-01-21', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-21 16:38:01', '2025-01-21 16:38:01'),
(28, 43, '7400012514', '2025-01-21', '[\"Krakatau Baja Industri\"]', NULL, '3', 'Hujan', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-21 17:03:50', '2025-01-21 17:03:50'),
(29, 43, '7400012512', '2025-01-21', '[\"Krakatau Baja Industri\"]', NULL, '3', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-21 17:20:43', '2025-01-21 17:20:43'),
(30, 43, '7400012446', '2025-01-21', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-21 18:01:57', '2025-01-21 18:01:57'),
(31, 43, '740011674', '2025-01-21', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-21 18:14:52', '2025-01-21 18:14:52'),
(32, 43, '7400011729', '2025-01-21', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-21 18:34:09', '2025-01-21 18:34:09'),
(33, 43, '7400011675', '2025-01-21', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-21 18:55:15', '2025-01-21 18:55:15'),
(34, 43, '7400012513', '2025-01-21', '[\"Krakatau Baja Industri\"]', NULL, '3', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-21 21:41:51', '2025-01-21 21:41:51'),
(35, 43, '7400012447', '2025-01-21', '[\"Krakatau Baja Industri\"]', NULL, '3', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-21 22:30:42', '2025-01-21 22:30:42'),
(36, 43, '7400012529', '2025-01-21', '[\"Krakatau Baja Industri\"]', NULL, '3', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-21 22:53:57', '2025-01-21 22:53:57'),
(37, 90, '7400012559', '2025-01-21', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-22 02:07:23', '2025-01-22 02:07:23'),
(38, 24, '7400012581', '2025-01-22', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-22 18:00:00', '2025-01-22 18:00:00'),
(39, 24, '300029731', '2025-01-22', '[\"Essar\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-22 18:17:38', '2025-01-22 18:17:38'),
(40, 24, '7400012591', '2025-01-22', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-22 18:48:24', '2025-01-22 18:48:24'),
(41, 24, '7400012482', '2025-01-22', '[\"Krakatau Baja Industri\"]', NULL, '1', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, NULL, '2025-01-22 18:54:04', '2025-01-22 18:54:04'),
(42, 24, '7400012592', '2025-01-22', '[\"Krakatau Baja Industri\"]', NULL, '3', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-22 19:47:05', '2025-01-22 19:47:05'),
(43, 24, '7400012595', '2025-01-22', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-22 20:08:01', '2025-01-22 20:08:01'),
(44, 24, '7400012597', '2025-01-22', '[\"Krakatau Baja Industri\"]', NULL, '3', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-22 20:09:54', '2025-01-22 20:09:54'),
(45, 24, '740012597', '2025-01-22', '[\"Krakatau Baja Industri\"]', NULL, '3', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-22 20:10:57', '2025-01-22 20:10:57'),
(46, 24, '74000012588', '2025-01-22', '[\"Krakatau Baja Industri\"]', NULL, '3', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-22 20:44:54', '2025-01-22 20:44:54'),
(47, 43, '7400012594', '2025-01-22', '[\"Krakatau Baja Industri\"]', NULL, '3', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-22 22:32:25', '2025-01-22 22:32:25'),
(48, 43, '7400012593', '2025-01-22', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-22 23:15:04', '2025-01-22 23:15:04'),
(49, 76, '7400012622', '2025-01-23', '[\"Krakatau Baja Industri\"]', NULL, '3', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-23 00:23:10', '2025-01-23 00:23:10'),
(50, 76, '7400012599', '2025-01-23', '[\"Krakatau Baja Industri\"]', NULL, '3', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-23 00:56:19', '2025-01-23 00:56:19'),
(51, 76, '7400012632', '2025-01-23', '[\"Krakatau Baja Industri\"]', NULL, '3', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-23 01:22:08', '2025-01-23 01:22:08'),
(52, 76, '7400012635', '2025-01-23', '[\"Krakatau Baja Industri\"]', NULL, '3', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-23 02:01:11', '2025-01-23 02:01:11'),
(53, 64, '7400012639/7400012640', '2025-01-23', '[\"Krakatau Baja Industri\"]', NULL, '3', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-23 02:16:57', '2025-01-23 02:16:57'),
(54, 64, '300029772', '2025-01-23', '[\"Essar\"]', NULL, '1', 'Hujan', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-23 06:15:35', '2025-01-23 06:15:35'),
(55, 54, '7400011830-7400011826', '2025-01-23', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-23 17:05:08', '2025-01-23 17:05:08'),
(56, 54, '7400012681-7400012682', '2025-01-23', '[\"Krakatau Baja Industri\"]', NULL, '3', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-23 17:27:02', '2025-01-23 17:27:02'),
(57, 54, '7400011863-7400011829', '2025-01-23', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-23 17:55:05', '2025-01-23 17:55:05'),
(58, 54, '7400012580', '2025-01-22', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-23 19:18:14', '2025-01-23 19:18:14'),
(59, 54, '7400011963-7400011954', '2025-01-23', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-23 20:33:39', '2025-01-23 20:33:39'),
(60, 54, '7400012686', '2025-01-23', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-23 21:05:26', '2025-01-23 21:05:26'),
(61, 54, '7400011624', '2025-01-23', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-23 21:39:02', '2025-01-23 21:39:02'),
(62, 54, '300029771', '2025-01-24', '[\"Essar\"]', NULL, '1', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-23 22:06:51', '2025-01-23 22:06:51'),
(63, 54, '7400011828-7400011846', '2025-01-23', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-23 22:33:36', '2025-01-23 22:33:36'),
(64, 64, '7400011873', '2025-01-24', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, NULL, NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-24 00:45:16', '2025-01-24 00:45:16'),
(65, 64, '7400012708', '2025-01-24', '[\"Krakatau Baja Industri\"]', NULL, '3', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, NULL, NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-24 01:08:04', '2025-01-24 01:08:04'),
(66, 64, '7400011837/7400011868', '2025-01-24', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-24 02:23:53', '2025-01-24 02:23:53'),
(67, 64, '7400011871/7400011840', '2025-01-24', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-24 02:45:15', '2025-01-24 02:45:15'),
(68, 76, '7400011867', '2025-01-25', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-25 12:10:03', '2025-01-25 12:10:03'),
(69, 90, '7400011622-7400011964', '2025-01-25', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-25 17:48:07', '2025-01-25 17:48:07'),
(70, 90, '7400011693/740012774', '2025-01-26', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-25 18:59:31', '2025-01-25 18:59:31'),
(71, 90, '7400012772', '0025-12-25', '[\"Krakatau Baja Industri\"]', NULL, NULL, 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-25 21:15:28', '2025-01-25 21:15:28'),
(72, 90, '7400011843-7400011874', '2025-01-25', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-25 21:59:42', '2025-01-25 21:59:42'),
(73, 43, '7400011869', '2025-01-25', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-26 06:30:38', '2025-01-26 06:30:38'),
(74, 43, '7400012783', '2025-01-25', '[\"Krakatau Baja Industri\"]', NULL, '5', NULL, NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-26 06:53:46', '2025-01-26 06:53:46'),
(75, 43, '7400011865', '2025-01-25', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-26 07:20:30', '2025-01-26 07:20:30'),
(76, 78, '7400011696/838', '2025-01-28', '[\"Krakatau Baja Industri\"]', NULL, '2', NULL, NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-28 13:10:08', '2025-01-28 13:10:08'),
(77, 64, '7400011839/7400011866', '2025-01-29', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Hujan', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-28 17:08:21', '2025-01-28 17:08:21'),
(78, 64, '7400011875', '2025-01-29', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Hujan', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-28 17:45:23', '2025-01-28 17:45:23'),
(79, 64, '7400011695', '2025-01-29', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Hujan', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-28 18:02:34', '2025-01-28 18:02:34'),
(80, 64, '7400011657', '2025-01-29', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Hujan', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-28 18:41:22', '2025-01-28 18:41:22'),
(81, 64, '7400012481', '2025-01-29', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Hujan', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, NULL, NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-28 19:18:49', '2025-01-28 19:18:49'),
(82, 64, '7400012840', '2025-01-29', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Menggunakan side wall', NULL, NULL, NULL, '2025-01-28 19:34:07', '2025-01-28 19:34:07'),
(83, 64, '7400012840', '2025-01-29', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Menggunakan side wall', NULL, NULL, NULL, '2025-01-28 19:34:08', '2025-01-28 19:34:08'),
(84, 64, '7400012840', '2025-01-29', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Menggunakan side wall', NULL, NULL, NULL, '2025-01-28 19:34:08', '2025-01-28 19:34:08'),
(85, 64, '7400011903/7400011904', '2025-01-29', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Berawan', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-28 19:52:59', '2025-01-28 19:52:59'),
(86, 64, '7400012852/7400012853/7400012851', '2025-01-29', '[\"Krakatau Baja Industri\"]', NULL, '3', 'Hujan', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-28 20:20:18', '2025-01-28 20:20:18'),
(87, 64, '7400011831', '2025-01-29', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-28 21:21:58', '2025-01-28 21:21:58'),
(88, 64, '7400012839', '2025-01-29', '[\"Krakatau Baja Industri\"]', NULL, '3', 'Hujan', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, NULL, NULL, NULL, 'Tidak Sesuai', NULL, NULL, NULL, NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, NULL, '2025-01-28 21:59:23', '2025-01-28 21:59:23'),
(89, 73, '7400011834/7400011870', '2025-01-28', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Berawan', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-29 02:53:08', '2025-01-29 02:53:08'),
(91, 73, '7400012838/7400012837', '2025-01-28', '[\"Krakatau Baja Industri\"]', NULL, '3', 'Berawan', NULL, 'Habis Hujan', 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Basah/Terdapat bercak bekas terkena air', NULL, 'PAP 374 VBB (terdapat bercak air, lantai trailer basah)', 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-29 03:46:24', '2025-01-29 03:46:24'),
(92, 76, '7400012884/7400012883', '2025-01-30', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Hujan', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-29 20:13:51', '2025-01-29 20:13:51'),
(93, 76, '7400012912', '2025-01-30', '[\"Krakatau Baja Industri\"]', NULL, NULL, 'Hujan', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-29 23:00:20', '2025-01-29 23:00:20'),
(94, 43, '7400012952', '2025-01-30', '[\"Krakatau Baja Industri\"]', NULL, '1', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-30 20:00:13', '2025-01-30 20:00:13'),
(95, 24, '7400013147/7400013149/7400013148', '2025-01-31', '[\"Krakatau Baja Industri\"]', NULL, '3', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-31 17:42:35', '2025-01-31 17:42:35'),
(96, 24, '7400012988', '2025-01-31', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-31 19:52:00', '2025-01-31 19:52:00'),
(97, 24, '7400012986', '2025-01-31', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-31 21:29:24', '2025-01-31 21:29:24'),
(98, 24, '7400012990', '2025-01-31', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-31 21:40:21', '2025-01-31 21:40:21'),
(99, 24, '7400012991', '2025-01-31', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-31 21:53:11', '2025-01-31 21:53:11'),
(100, 24, '7400012985', '2025-01-31', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-31 22:19:46', '2025-01-31 22:19:46'),
(101, 24, '7400012994', '2025-01-31', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-31 22:36:25', '2025-01-31 22:36:25'),
(102, 24, '7400013131', '2025-01-31', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-31 22:57:03', '2025-01-31 22:57:03'),
(103, 24, '7400012987', '2025-01-31', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-31 23:09:30', '2025-01-31 23:09:30'),
(104, 24, '7400012995', '2025-01-31', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-01-31 23:20:57', '2025-01-31 23:20:57'),
(105, 40, '7400012992', '2025-02-01', '[\"Krakatau Baja Industri\"]', NULL, NULL, 'Berawan', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, NULL, NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-01 00:08:31', '2025-02-01 00:08:31'),
(106, 40, '7400012993', '2025-02-01', '[\"Krakatau Baja Industri\"]', NULL, NULL, 'Berawan', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-01 00:29:59', '2025-02-01 00:29:59'),
(107, 40, '7400012996', '2025-02-01', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Hujan', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-01 01:47:55', '2025-02-01 01:47:55'),
(108, 40, '7400012989', '2025-02-01', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Hujan', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-01 02:12:47', '2025-02-01 02:12:47'),
(109, 40, '7400012998', '2025-02-01', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Berawan', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-01 02:46:31', '2025-02-01 02:46:31'),
(110, 40, '7400012983', '2025-02-01', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, NULL, NULL, NULL, 'Ya', '2025-02-01 03:03:27', '2025-02-01 03:03:27'),
(111, 40, '7400013129', '2025-02-01', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, NULL, NULL, NULL, 'Ya', '2025-02-01 03:30:17', '2025-02-01 03:30:17'),
(112, 40, '740001284', '2025-02-01', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-01 03:45:53', '2025-02-01 03:45:53'),
(113, 90, '7400012997', '2025-02-01', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-01 09:44:43', '2025-02-01 09:44:43'),
(114, 73, '7400013247/7400013265', '2025-02-01', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Hujan', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-01 17:12:34', '2025-02-01 17:12:34'),
(115, 73, '7400013130', '2025-02-01', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Hujan', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-01 17:29:18', '2025-02-01 17:29:18'),
(116, 73, '740013140', '2025-02-01', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Hujan', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-01 17:49:57', '2025-02-01 17:49:57'),
(117, 73, '7400013137', '2025-02-01', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Hujan', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-01 18:13:05', '2025-02-01 18:13:05'),
(118, 73, '7400013258/7400013259', '2025-02-01', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Hujan', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-01 19:28:42', '2025-02-01 19:28:42'),
(119, 73, '7400013248/7400013266', '2025-02-01', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Hujan', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-01 20:29:48', '2025-02-01 20:29:48'),
(120, 73, '7400013262/7400013304/7400013311', '2025-02-01', '[\"Krakatau Baja Industri\"]', NULL, '3', 'Hujan', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-01 20:41:45', '2025-02-01 20:41:45'),
(121, 73, '7400013138/7400013139', '2025-02-01', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Hujan', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-01 20:57:00', '2025-02-01 20:57:00'),
(122, 73, '7400013257/7400013256', '2025-02-01', '[\"Krakatau Baja Industri\"]', NULL, NULL, 'Hujan', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-01 21:13:42', '2025-02-01 21:13:42'),
(123, 73, '7400013150', '2025-02-01', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Hujan', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-01 21:43:23', '2025-02-01 21:43:23'),
(124, 73, '7400013146/7400013292/7400013297', '2025-02-01', '[\"Krakatau Baja Industri\"]', NULL, '3', 'Hujan', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-01 22:11:42', '2025-02-01 22:11:42'),
(125, 64, '7400013151/7400013154', '2025-02-02', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Hujan', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-02 00:25:57', '2025-02-02 00:25:57'),
(126, 64, '7400013141', '2025-02-02', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Berawan', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-02 01:00:31', '2025-02-02 01:00:31'),
(127, 64, '7400013128', '2025-02-02', '[\"Krakatau Baja Industri\"]', NULL, '3', 'Berawan', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-02 01:29:17', '2025-02-02 01:29:17'),
(128, 64, '7400013128', '2025-02-02', '[\"Krakatau Baja Industri\"]', NULL, '3', 'Berawan', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-02 01:29:18', '2025-02-02 01:29:18'),
(129, 64, '7400013127', '2025-02-02', '[\"Krakatau Baja Industri\"]', NULL, '3', 'Berawan', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-02 01:56:14', '2025-02-02 01:56:14'),
(130, 64, '7400012970', '2025-02-02', '[\"Krakatau Baja Industri\"]', NULL, '3', 'Berawan', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-02 02:14:58', '2025-02-02 02:14:58'),
(131, 64, '7400013133', '2025-02-02', '[\"Krakatau Baja Industri\"]', NULL, '3', 'Berawan', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-02 02:50:31', '2025-02-02 02:50:31'),
(132, 64, '740001357', '2025-02-02', '[\"Krakatau Baja Industri\"]', NULL, '3', 'Berawan', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-02 02:54:29', '2025-02-02 02:54:29'),
(133, 64, '7400013357', '2025-02-02', '[\"Krakatau Baja Industri\"]', NULL, '3', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-02 02:58:42', '2025-02-02 02:58:42'),
(134, 64, '7400012999', '2025-02-02', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-02 03:41:49', '2025-02-02 03:41:49'),
(135, 20, '7400013303 - 7400013293', '2025-02-01', '[\"Krakatau Baja Industri\"]', NULL, NULL, 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, NULL, '2025-02-02 12:17:30', '2025-02-02 12:17:30'),
(136, 73, '7400013310/7400013143', '2025-02-02', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Hujan', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-02 16:40:24', '2025-02-02 16:40:24'),
(137, 73, '7400013268/7400013253', '2025-02-02', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Berawan', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-02 17:40:02', '2025-02-02 17:40:02'),
(138, 73, '7400013302/7400013306', '2025-02-02', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Berawan', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-02 17:40:52', '2025-02-02 17:40:52'),
(139, 73, '7400013246/7400013270', '2025-02-02', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Berawan', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-02 18:12:21', '2025-02-02 18:12:21'),
(140, 73, '7400013503/7400013277', '2025-02-02', '[\"Krakatau Baja Industri\"]', NULL, '3', 'Berawan', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-02 18:40:12', '2025-02-02 18:40:12'),
(141, 54, '7400013251-7400013272', '2025-02-02', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-02 20:53:49', '2025-02-02 20:53:49'),
(142, 54, '7400013276-7400013307', '2025-02-02', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-02 21:14:05', '2025-02-02 21:14:05');
INSERT INTO `crc` (`id`, `user_id`, `shift_leader`, `date`, `supplier`, `other_supplier`, `ket_awal`, `cuaca`, `foto`, `keterangan`, `sesuai`, `foto1`, `keterangan1`, `baik`, `foto2`, `keterangan2`, `kering`, `foto3`, `keterangan3`, `kencang`, `foto4`, `keterangan4`, `jumlahin`, `foto5`, `keterangan5`, `alas`, `foto6`, `keterangan6`, `wall`, `foto7`, `keterangan7`, `perganjalan`, `created_at`, `updated_at`) VALUES
(143, 54, '7400013264-7400013249', '2025-02-02', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-02 21:30:22', '2025-02-02 21:30:22'),
(144, 54, '7400013508-7400013506-7400013507', '2025-02-02', '[\"Krakatau Baja Industri\"]', NULL, '3', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-02 22:29:50', '2025-02-02 22:29:50'),
(145, 54, '7400013267-7400013504', '2025-02-02', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-02 22:56:27', '2025-02-02 22:56:27'),
(146, 76, '7400013516', '2025-02-03', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Berawan', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-03 00:11:06', '2025-02-03 00:11:06'),
(147, 76, '7400012976', '2025-02-03', '[\"Krakatau Baja Industri\"]', NULL, '3', 'Berawan', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-03 00:46:38', '2025-02-03 00:46:38'),
(148, 76, '7400012975', '2025-02-03', '[\"Krakatau Baja Industri\"]', NULL, '3', NULL, NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-03 01:30:29', '2025-02-03 01:30:29'),
(149, 76, '7400013260/7400013274', '2025-02-03', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-03 01:52:32', '2025-02-03 01:52:32'),
(150, 76, '7400013123', '2025-02-03', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Berawan', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-03 06:21:56', '2025-02-03 06:21:56'),
(151, 20, '7400013356 - 7400013197 - 7400013199', '2025-01-31', '[\"Krakatau Baja Industri\"]', NULL, NULL, 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-03 09:05:13', '2025-02-03 09:05:13'),
(152, 73, '7400013001', '2025-02-03', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-03 17:03:18', '2025-02-03 17:03:18'),
(153, 73, '7400013001', '2025-02-03', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-03 17:03:37', '2025-02-03 17:03:37'),
(154, 73, '7400013261/7400013250', '2025-02-03', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-03 17:11:43', '2025-02-03 17:11:43'),
(155, 73, '7400013252/7400013254/7400013152', '2025-02-03', '[\"Krakatau Baja Industri\"]', NULL, '3', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-03 17:33:00', '2025-02-03 17:33:00'),
(156, 73, '7400012785', '2025-02-03', '[\"Krakatau Baja Industri\"]', NULL, '3', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-03 18:11:48', '2025-02-03 18:11:48'),
(157, 73, '7400012982/7400013517/740007400013518', '2025-02-03', '[\"Krakatau Baja Industri\"]', NULL, '3', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-03 18:57:59', '2025-02-03 18:57:59'),
(158, 73, '7400013000', '2025-02-03', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-03 19:28:50', '2025-02-03 19:28:50'),
(159, 54, '7400013526-7400013527', '2025-02-03', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-03 20:40:51', '2025-02-03 20:40:51'),
(160, 54, '7400013269-7400013273', '2025-02-03', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-03 20:57:11', '2025-02-03 20:57:11'),
(161, 54, '7400013269-7400013273', '2025-02-03', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-03 20:57:12', '2025-02-03 20:57:12'),
(162, 54, '7400013535-7400013536', '2025-02-03', '[\"Krakatau Baja Industri\"]', NULL, '3', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-03 21:40:00', '2025-02-03 21:40:00'),
(163, 78, '7400013532/533', '2025-02-03', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-04 00:50:20', '2025-02-04 00:50:20'),
(164, 90, '7400012574', '2025-02-04', '[\"Krakatau Baja Industri\"]', NULL, '3', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-04 18:15:19', '2025-02-04 18:15:19'),
(165, 90, '7400012789', '2025-02-04', '[\"Krakatau Baja Industri\"]', NULL, '3', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-04 19:11:04', '2025-02-04 19:11:04'),
(166, 38, '7400012575-7400012773', '2025-02-04', '[\"Krakatau Baja Industri\"]', NULL, '3', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-04 21:59:54', '2025-02-04 21:59:54'),
(167, 38, '7400012980', '2025-02-04', '[\"Krakatau Baja Industri\"]', NULL, '3', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-04 22:26:33', '2025-02-04 22:26:33'),
(168, 38, '7400013565', '2025-02-04', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-04 22:51:41', '2025-02-04 22:51:41'),
(169, 38, '7400013539', '2025-02-04', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-04 22:56:48', '2025-02-04 22:56:48'),
(170, 38, '7400012784-7400013196', '2025-02-04', '[\"Krakatau Baja Industri\"]', NULL, '3', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-04 23:21:48', '2025-02-04 23:21:48'),
(171, 43, '7400012979', '2025-02-04', '[\"Krakatau Baja Industri\"]', NULL, '3', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-05 00:17:51', '2025-02-05 00:17:51'),
(172, 20, '7400013615 - 7400013617', '2025-02-05', '[\"Krakatau Baja Industri\"]', NULL, NULL, 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Tidak', '2025-02-05 10:56:52', '2025-02-05 10:56:52'),
(173, 64, '7400013002/7400012981', '2025-02-05', '[\"Krakatau Baja Industri\"]', NULL, '3', 'Berawan', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-05 16:44:37', '2025-02-05 16:44:37'),
(174, 64, '7400013003/7400013195', '2025-02-06', '[\"Krakatau Baja Industri\"]', NULL, '3', 'Berawan', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-05 17:09:25', '2025-02-05 17:09:25'),
(175, 64, '7400012974/7400013631', '2025-02-06', '[\"Krakatau Baja Industri\"]', NULL, '3', 'Berawan', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-05 17:45:34', '2025-02-05 17:45:34'),
(176, 64, '7400013605', '2025-02-04', '[\"Krakatau Baja Industri\"]', NULL, '3', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-05 18:21:52', '2025-02-05 18:21:52'),
(177, 64, '7400013557-7400013558', '2025-02-04', '[\"Krakatau Baja Industri\"]', NULL, '2', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-05 19:02:21', '2025-02-05 19:02:21'),
(178, 73, '7400013643', '2025-02-06', '[\"Krakatau Baja Industri\"]', NULL, '1', 'Cerah', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Tidak menggunakan side wall', NULL, NULL, 'Ya', '2025-02-06 03:55:22', '2025-02-06 03:55:22'),
(179, 101, 'dsdasd', '2025-05-28', '[\"Krakatau Steel\", \"Lianxin\"]', NULL, '2', 'Berawan', NULL, NULL, 'sesuai', NULL, NULL, 'baik', NULL, NULL, 'Kering/Tidak kena air', NULL, NULL, 'Kencang', NULL, NULL, 'Sesuai', NULL, NULL, 'Di atas alas karet ban', NULL, NULL, 'Menggunakan side wall', NULL, NULL, 'Ya', '2025-05-28 13:32:01', '2025-05-28 13:32:01');

-- --------------------------------------------------------

--
-- Table structure for table `crc_image`
--

CREATE TABLE `crc_image` (
  `id` int(11) NOT NULL,
  `crc_id` int(11) NOT NULL,
  `foto` json DEFAULT NULL,
  `foto1` json DEFAULT NULL,
  `foto2` json DEFAULT NULL,
  `foto3` json DEFAULT NULL,
  `foto4` json DEFAULT NULL,
  `foto5` json DEFAULT NULL,
  `foto6` json DEFAULT NULL,
  `foto7` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `crc_image`
--

INSERT INTO `crc_image` (`id`, `crc_id`, `foto`, `foto1`, `foto2`, `foto3`, `foto4`, `foto5`, `foto6`, `foto7`, `created_at`, `updated_at`) VALUES
(1, 2, '[\"04-11-2024/672879b12fe22.png\"]', '[\"04-11-2024/672879b132d3c.png\"]', '[\"04-11-2024/672879b133516.png\"]', '[\"04-11-2024/672879b133f89.png\"]', '[\"04-11-2024/672879b134835.png\"]', '[\"04-11-2024/672879b13511a.jpg\"]', '[\"04-11-2024/672879b136193.jpg\"]', '[\"04-11-2024/672879b136f7c.png\"]', '2024-11-04 07:37:21', '2024-11-04 07:37:21'),
(2, 3, '[\"05-11-2024/6729a04d947fa.png\"]', '[\"05-11-2024/6729a04d9818b.png\"]', '[\"05-11-2024/6729a04d98a3d.png\"]', '[\"05-11-2024/6729a04d99345.png\"]', '[\"05-11-2024/6729a04d99c1c.png\"]', '[\"05-11-2024/6729a04d9a248.png\"]', '[\"05-11-2024/6729a04d9ac78.png\"]', '[\"05-11-2024/6729a04d9b620.png\"]', '2024-11-05 04:34:21', '2024-11-05 04:34:21'),
(3, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-13 09:58:45', '2024-12-13 09:58:45'),
(4, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-13 09:59:36', '2024-12-13 09:59:36'),
(5, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-13 10:00:13', '2024-12-13 10:00:13'),
(6, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-13 10:00:54', '2024-12-13 10:00:54'),
(7, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-13 10:02:00', '2024-12-13 10:02:00'),
(8, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-13 10:02:46', '2024-12-13 10:02:46'),
(9, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-13 10:03:24', '2024-12-13 10:03:24'),
(10, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-13 10:33:52', '2024-12-13 10:33:52'),
(11, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-13 10:34:46', '2024-12-13 10:34:46'),
(12, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-13 10:48:40', '2024-12-13 10:48:40'),
(13, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-13 15:24:02', '2024-12-13 15:24:02'),
(14, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-13 15:31:05', '2024-12-13 15:31:05'),
(15, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-13 15:31:47', '2024-12-13 15:31:47'),
(16, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-13 15:32:30', '2024-12-13 15:32:30'),
(17, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-13 15:33:10', '2024-12-13 15:33:10'),
(18, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-13 15:33:48', '2024-12-13 15:33:48'),
(19, 20, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-13 15:34:25', '2024-12-13 15:34:25'),
(20, 21, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-13 16:19:34', '2024-12-13 16:19:34'),
(21, 22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-13 16:20:15', '2024-12-13 16:20:15'),
(22, 23, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-13 16:20:56', '2024-12-13 16:20:56'),
(23, 24, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-13 16:21:45', '2024-12-13 16:21:45'),
(24, 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-13 16:23:22', '2024-12-13 16:23:22'),
(25, 26, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-21 16:17:10', '2025-01-21 16:17:10'),
(26, 27, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-21 16:38:01', '2025-01-21 16:38:01'),
(27, 28, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-21 17:03:50', '2025-01-21 17:03:50'),
(28, 29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-21 17:20:43', '2025-01-21 17:20:43'),
(29, 30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-21 18:01:57', '2025-01-21 18:01:57'),
(30, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-21 18:14:52', '2025-01-21 18:14:52'),
(31, 32, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-21 18:34:09', '2025-01-21 18:34:09'),
(32, 33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-21 18:55:15', '2025-01-21 18:55:15'),
(33, 34, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-21 21:41:51', '2025-01-21 21:41:51'),
(34, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-21 22:30:42', '2025-01-21 22:30:42'),
(35, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-21 22:53:57', '2025-01-21 22:53:57'),
(36, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-22 02:07:23', '2025-01-22 02:07:23'),
(37, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-22 18:00:00', '2025-01-22 18:00:00'),
(38, 39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-22 18:17:38', '2025-01-22 18:17:38'),
(39, 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-22 18:48:24', '2025-01-22 18:48:24'),
(40, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-22 18:54:05', '2025-01-22 18:54:05'),
(41, 42, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-22 19:47:06', '2025-01-22 19:47:06'),
(42, 43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-22 20:08:02', '2025-01-22 20:08:02'),
(43, 44, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-22 20:09:54', '2025-01-22 20:09:54'),
(44, 45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-22 20:10:57', '2025-01-22 20:10:57'),
(45, 46, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-22 20:44:54', '2025-01-22 20:44:54'),
(46, 47, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-22 22:32:25', '2025-01-22 22:32:25'),
(47, 48, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-22 23:15:05', '2025-01-22 23:15:05'),
(48, 49, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-23 00:23:10', '2025-01-23 00:23:10'),
(49, 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-23 00:56:19', '2025-01-23 00:56:19'),
(50, 51, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-23 01:22:08', '2025-01-23 01:22:08'),
(51, 52, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-23 02:01:11', '2025-01-23 02:01:11'),
(52, 53, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-23 02:16:57', '2025-01-23 02:16:57'),
(53, 54, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-23 06:15:36', '2025-01-23 06:15:36'),
(54, 55, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-23 17:05:08', '2025-01-23 17:05:08'),
(55, 56, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-23 17:27:02', '2025-01-23 17:27:02'),
(56, 57, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-23 17:55:05', '2025-01-23 17:55:05'),
(57, 58, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-23 19:18:15', '2025-01-23 19:18:15'),
(58, 59, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-23 20:33:39', '2025-01-23 20:33:39'),
(59, 60, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-23 21:05:26', '2025-01-23 21:05:26'),
(60, 61, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-23 21:39:02', '2025-01-23 21:39:02'),
(61, 62, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-23 22:06:51', '2025-01-23 22:06:51'),
(62, 63, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-23 22:33:36', '2025-01-23 22:33:36'),
(63, 64, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-24 00:45:16', '2025-01-24 00:45:16'),
(64, 65, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-24 01:08:04', '2025-01-24 01:08:04'),
(65, 66, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-24 02:23:53', '2025-01-24 02:23:53'),
(66, 67, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-24 02:45:15', '2025-01-24 02:45:15'),
(67, 68, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-25 12:10:03', '2025-01-25 12:10:03'),
(68, 69, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-25 17:48:08', '2025-01-25 17:48:08'),
(69, 70, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-25 18:59:31', '2025-01-25 18:59:31'),
(70, 71, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-25 21:15:28', '2025-01-25 21:15:28'),
(71, 72, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-25 21:59:42', '2025-01-25 21:59:42'),
(72, 73, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-26 06:30:38', '2025-01-26 06:30:38'),
(73, 74, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-26 06:53:46', '2025-01-26 06:53:46'),
(74, 75, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-26 07:20:30', '2025-01-26 07:20:30'),
(75, 76, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-28 13:10:08', '2025-01-28 13:10:08'),
(76, 77, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-28 17:08:21', '2025-01-28 17:08:21'),
(77, 78, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-28 17:45:24', '2025-01-28 17:45:24'),
(78, 79, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-28 18:02:34', '2025-01-28 18:02:34'),
(79, 80, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-28 18:41:22', '2025-01-28 18:41:22'),
(80, 81, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-28 19:18:50', '2025-01-28 19:18:50'),
(81, 82, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-28 19:34:07', '2025-01-28 19:34:07'),
(82, 83, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-28 19:34:08', '2025-01-28 19:34:08'),
(83, 84, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-28 19:34:08', '2025-01-28 19:34:08'),
(84, 85, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-28 19:52:59', '2025-01-28 19:52:59'),
(85, 86, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-28 20:20:18', '2025-01-28 20:20:18'),
(86, 87, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-28 21:21:58', '2025-01-28 21:21:58'),
(87, 88, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-28 21:59:23', '2025-01-28 21:59:23'),
(88, 89, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-29 02:53:09', '2025-01-29 02:53:09'),
(89, 90, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-29 03:44:51', '2025-01-29 03:44:51'),
(90, 91, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-29 03:46:24', '2025-01-29 03:46:24'),
(91, 92, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-29 20:13:52', '2025-01-29 20:13:52'),
(92, 93, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-29 23:00:20', '2025-01-29 23:00:20'),
(93, 94, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-30 20:00:13', '2025-01-30 20:00:13'),
(94, 95, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-31 17:42:36', '2025-01-31 17:42:36'),
(95, 96, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-31 19:52:01', '2025-01-31 19:52:01'),
(96, 97, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-31 21:29:24', '2025-01-31 21:29:24'),
(97, 98, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-31 21:40:21', '2025-01-31 21:40:21'),
(98, 99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-31 21:53:11', '2025-01-31 21:53:11'),
(99, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-31 22:19:46', '2025-01-31 22:19:46'),
(100, 101, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-31 22:36:25', '2025-01-31 22:36:25'),
(101, 102, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-31 22:57:03', '2025-01-31 22:57:03'),
(102, 103, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-31 23:09:30', '2025-01-31 23:09:30'),
(103, 104, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-31 23:20:57', '2025-01-31 23:20:57'),
(104, 105, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-01 00:08:31', '2025-02-01 00:08:31'),
(105, 106, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-01 00:29:59', '2025-02-01 00:29:59'),
(106, 107, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-01 01:47:55', '2025-02-01 01:47:55'),
(107, 108, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-01 02:12:48', '2025-02-01 02:12:48'),
(108, 109, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-01 02:46:31', '2025-02-01 02:46:31'),
(109, 110, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-01 03:03:27', '2025-02-01 03:03:27'),
(110, 111, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-01 03:30:17', '2025-02-01 03:30:17'),
(111, 112, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-01 03:45:53', '2025-02-01 03:45:53'),
(112, 113, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-01 09:44:43', '2025-02-01 09:44:43'),
(113, 114, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-01 17:12:34', '2025-02-01 17:12:34'),
(114, 115, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-01 17:29:18', '2025-02-01 17:29:18'),
(115, 116, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-01 17:49:57', '2025-02-01 17:49:57'),
(116, 117, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-01 18:13:05', '2025-02-01 18:13:05'),
(117, 118, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-01 19:28:42', '2025-02-01 19:28:42'),
(118, 119, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-01 20:29:48', '2025-02-01 20:29:48'),
(119, 120, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-01 20:41:45', '2025-02-01 20:41:45'),
(120, 121, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-01 20:57:00', '2025-02-01 20:57:00'),
(121, 122, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-01 21:13:42', '2025-02-01 21:13:42'),
(122, 123, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-01 21:43:23', '2025-02-01 21:43:23'),
(123, 124, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-01 22:11:43', '2025-02-01 22:11:43'),
(124, 125, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-02 00:25:57', '2025-02-02 00:25:57'),
(125, 126, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-02 01:00:31', '2025-02-02 01:00:31'),
(126, 127, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-02 01:29:17', '2025-02-02 01:29:17'),
(127, 128, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-02 01:29:18', '2025-02-02 01:29:18'),
(128, 129, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-02 01:56:14', '2025-02-02 01:56:14'),
(129, 130, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-02 02:14:58', '2025-02-02 02:14:58'),
(130, 131, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-02 02:50:31', '2025-02-02 02:50:31'),
(131, 132, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-02 02:54:29', '2025-02-02 02:54:29'),
(132, 133, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-02 02:58:42', '2025-02-02 02:58:42'),
(133, 134, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-02 03:41:49', '2025-02-02 03:41:49'),
(134, 135, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-02 12:17:30', '2025-02-02 12:17:30'),
(135, 136, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-02 16:40:24', '2025-02-02 16:40:24'),
(136, 137, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-02 17:40:02', '2025-02-02 17:40:02'),
(137, 138, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-02 17:40:52', '2025-02-02 17:40:52'),
(138, 139, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-02 18:12:21', '2025-02-02 18:12:21'),
(139, 140, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-02 18:40:12', '2025-02-02 18:40:12'),
(140, 141, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-02 20:53:50', '2025-02-02 20:53:50'),
(141, 142, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-02 21:14:05', '2025-02-02 21:14:05'),
(142, 143, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-02 21:30:22', '2025-02-02 21:30:22'),
(143, 144, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-02 22:29:50', '2025-02-02 22:29:50'),
(144, 145, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-02 22:56:27', '2025-02-02 22:56:27'),
(145, 146, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-03 00:11:06', '2025-02-03 00:11:06'),
(146, 147, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-03 00:46:38', '2025-02-03 00:46:38'),
(147, 148, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-03 01:30:29', '2025-02-03 01:30:29'),
(148, 149, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-03 01:52:32', '2025-02-03 01:52:32'),
(149, 150, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-03 06:21:56', '2025-02-03 06:21:56'),
(150, 151, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-03 09:05:13', '2025-02-03 09:05:13'),
(151, 152, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-03 17:03:18', '2025-02-03 17:03:18'),
(152, 153, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-03 17:03:38', '2025-02-03 17:03:38'),
(153, 154, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-03 17:11:43', '2025-02-03 17:11:43'),
(154, 155, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-03 17:33:00', '2025-02-03 17:33:00'),
(155, 156, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-03 18:11:48', '2025-02-03 18:11:48'),
(156, 157, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-03 18:57:59', '2025-02-03 18:57:59'),
(157, 158, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-03 19:28:50', '2025-02-03 19:28:50'),
(158, 159, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-03 20:40:51', '2025-02-03 20:40:51'),
(159, 160, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-03 20:57:11', '2025-02-03 20:57:11'),
(160, 161, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-03 20:57:12', '2025-02-03 20:57:12'),
(161, 162, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-03 21:40:00', '2025-02-03 21:40:00'),
(162, 163, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-04 00:50:20', '2025-02-04 00:50:20'),
(163, 164, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-04 18:15:19', '2025-02-04 18:15:19'),
(164, 165, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-04 19:11:04', '2025-02-04 19:11:04'),
(165, 166, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-04 21:59:54', '2025-02-04 21:59:54'),
(166, 167, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-04 22:26:33', '2025-02-04 22:26:33'),
(167, 168, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-04 22:51:41', '2025-02-04 22:51:41'),
(168, 169, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-04 22:56:48', '2025-02-04 22:56:48'),
(169, 170, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-04 23:21:48', '2025-02-04 23:21:48'),
(170, 171, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-05 00:17:51', '2025-02-05 00:17:51'),
(171, 172, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-05 10:56:52', '2025-02-05 10:56:52'),
(172, 173, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-05 16:44:37', '2025-02-05 16:44:37'),
(173, 174, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-05 17:09:25', '2025-02-05 17:09:25'),
(174, 175, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-05 17:45:34', '2025-02-05 17:45:34'),
(175, 176, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-05 18:21:52', '2025-02-05 18:21:52'),
(176, 177, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-05 19:02:21', '2025-02-05 19:02:21'),
(177, 178, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-06 03:55:22', '2025-02-06 03:55:22'),
(178, 179, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-05-28 13:32:01', '2025-05-28 13:32:01');

-- --------------------------------------------------------

--
-- Table structure for table `datab`
--

CREATE TABLE `datab` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` int(11) NOT NULL,
  `uom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attribute` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `storage_bin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `panjang` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `datab`
--

INSERT INTO `datab` (`id`, `user_id`, `kode`, `nama_produk`, `qty`, `uom`, `attribute`, `storage_bin`, `date`, `panjang`, `created_at`, `updated_at`) VALUES
(1, 14, '11', '11', 11, '11', '11', '11', '2024-12-25', '11', '2025-05-28 14:12:46', '2025-05-28 14:12:46'),
(2, 14, '22', '22', 22, '22', '22', '22', '2024-12-25', '22', '2025-05-28 14:12:46', '2025-05-28 14:12:46'),
(3, 14, '33', '33', 33, '33', '33', '33', '2024-12-25', '33', '2025-05-28 14:12:46', '2025-05-28 14:12:46'),
(4, 14, '44', '44', 44, '44', '44', '44', '2024-12-25', '44', '2025-05-28 14:12:46', '2025-05-28 14:12:46'),
(5, 14, '55', '55', 55, '55', '55', '55', '2024-12-25', '55', '2025-05-28 14:12:46', '2025-05-28 14:12:46'),
(6, 14, 'CPXC02501219070G55', '0.25 x 1219mm AZ70 G550 NEXALUME® Clear Resin', 4639, 'Kilogram', 'CL24-100759', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-07-01', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(7, 14, 'CPXC02501219070G55', '0.25 x 1219mm AZ70 G550 NEXALUME® Clear Resin', 4640, 'Kilogram', 'CL24-100758', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-07-01', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(8, 14, 'CPXC02501219070G55', '0.25 x 1219mm AZ70 G550 NEXALUME® Clear Resin', 4666, 'Kilogram', 'CL24-100762', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-07-01', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(9, 14, 'CPXC0250914070G30', '0.25 x 914mm AZ70 G300 NEXALUME® Clear Resin', 4053, 'Kilogram', 'CL23-188744', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2023-12-06', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(10, 14, 'CPXC0300914100G55', '0.30 x 914mm AZ100 G550 NEXALUME® Clear Resin', 3031, 'Kilogram', 'CL24-108824', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-14', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(11, 14, 'CPXC0300914100G55', '0.30 x 914mm AZ100 G550 NEXALUME® Clear Resin', 3066, 'Kilogram', 'CL24-108620', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-11', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(12, 14, 'CPXC0300914100G55', '0.30 x 914mm AZ100 G550 NEXALUME® Clear Resin', 3068, 'Kilogram', 'CL24-107465', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-09-28', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(13, 14, 'CPXC0300914100G55', '0.30 x 914mm AZ100 G550 NEXALUME® Clear Resin', 3117, 'Kilogram', 'CL24-107144', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-09-24', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(14, 14, 'CPXC0300914100G55', '0.30 x 914mm AZ100 G550 NEXALUME® Clear Resin', 3160, 'Kilogram', 'CL24-107193', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-09-25', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(15, 14, 'CPXC0300914100G55', '0.30 x 914mm AZ100 G550 NEXALUME® Clear Resin', 3258, 'Kilogram', 'CL24-108484', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-08', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(16, 14, 'CPXC0300914100G55', '0.30 x 914mm AZ100 G550 NEXALUME® Clear Resin', 3264, 'Kilogram', 'CL24-108573', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-10', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(17, 14, 'CPXC0300914100G55', '0.30 x 914mm AZ100 G550 NEXALUME® Clear Resin', 4034, 'Kilogram', 'CL24-109518', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(18, 14, 'CPXC0300914100G55', '0.30 x 914mm AZ100 G550 NEXALUME® Clear Resin', 4100, 'Kilogram', 'CL24-109473', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-19', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(19, 14, 'CPXC0300914100G55', '0.30 x 914mm AZ100 G550 NEXALUME® Clear Resin', 4234, 'Kilogram', 'CL24-109293', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-18', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(20, 14, 'CPXC0300914100G55', '0.30 x 914mm AZ100 G550 NEXALUME® Clear Resin', 4267, 'Kilogram', 'CI24-109237', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-17', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(21, 14, 'CPXC0300914100G55', '0.30 x 914mm AZ100 G550 NEXALUME® Clear Resin', 4319, 'Kilogram', 'CI24-109236', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-17', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(22, 14, 'CPXC0341038150G55', '0.34 x 1038mm AZ150 G550 NEXALUME® Clear Resin', 4499, 'Kilogram', 'CL24-104848', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-08-21', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(23, 14, 'CPXC0351100100G55', '0.35 x 1100mm AZ100 G550 NEXALUME® Clear Resin', 4057, 'Kilogram', 'CL23-177726', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2023-07-24', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(24, 14, 'CPXC0351100100G55', '0.35 x 1100mm AZ100 G550 NEXALUME® Clear Resin', 4251, 'Kilogram', 'CL24-199763', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-06-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(25, 14, 'CPXC0351100100G55', '0.35 x 1100mm AZ100 G550 NEXALUME® Clear Resin', 4523, 'Kilogram', 'CL23-177727', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2023-07-24', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(26, 14, 'CPXC0351219100G55', '0.35 x 1219mm AZ100 G550 NEXALUME® Clear Resin', 2663, 'Kilogram', 'CR_AG_24-30756', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-11', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(27, 14, 'CPXC0351219100G55', '0.35 x 1219mm AZ100 G550 NEXALUME® Clear Resin', 2725, 'Kilogram', 'CL24-108624', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-11', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(28, 14, 'CPXC0351219100G55', '0.35 x 1219mm AZ100 G550 NEXALUME® Clear Resin', 4179, 'Kilogram', 'CL24-108576', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-10', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(29, 14, 'CPXC0351219100G55', '0.35 x 1219mm AZ100 G550 NEXALUME® Clear Resin', 4289, 'Kilogram', 'CL24-108575', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-10', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(30, 14, 'CPXC0351219100G55', '0.35 x 1219mm AZ100 G550 NEXALUME® Clear Resin', 4987, 'Kilogram', 'CL24-108827', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-14', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(31, 14, 'CPXC0351219100G55', '0.35 x 1219mm AZ100 G550 NEXALUME® Clear Resin', 5124, 'Kilogram', 'CL24-108826', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-14', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(32, 14, 'CPXC0351219100G55', '0.35 x 1219mm AZ100 G550 NEXALUME® Clear Resin', 5350, 'Kilogram', 'CL24-108059', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-03', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(33, 14, 'CPXC0401219100G55', '0.40 x 1219mm AZ100 G550 NEXALUME® Clear Resin', 5903, 'Kilogram', 'CL24-109068', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-16', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(34, 14, 'CPXC0401219100G55', '0.40 x 1219mm AZ100 G550 NEXALUME® Clear Resin', 5987, 'Kilogram', 'CL24-109061', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-15', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(35, 14, 'CPXC0401219100G55', '0.40 x 1219mm AZ100 G550 NEXALUME® Clear Resin', 5996, 'Kilogram', 'CL24-109062', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-15', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(36, 14, 'CPXC0401219100G55', '0.40 x 1219mm AZ100 G550 NEXALUME® Clear Resin', 6094, 'Kilogram', 'CL24-109307', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-18', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(37, 14, 'CPXC0401219100G55', '0.40 x 1219mm AZ100 G550 NEXALUME® Clear Resin', 6117, 'Kilogram', 'CL24-109324', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-18', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(38, 14, 'CPXC0401219100G55', '0.40 x 1219mm AZ100 G550 NEXALUME® Clear Resin', 6140, 'Kilogram', 'CL24-109323', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-18', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(39, 14, 'CPXC0401219100G55', '0.40 x 1219mm AZ100 G550 NEXALUME® Clear Resin', 6229, 'Kilogram', 'CL24-109230', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-17', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(40, 14, 'CPXC0401219100G55', '0.40 x 1219mm AZ100 G550 NEXALUME® Clear Resin', 6284, 'Kilogram', 'CL24-109065', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-15', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(41, 14, 'CPXC0400914100G55', '0.40 x 914mm AZ100 G550 NEXALUME® Clear Resin', 4038, 'Kilogram', 'CL24-109520', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(42, 14, 'CPXC0400914100G55', '0.40 x 914mm AZ100 G550 NEXALUME® Clear Resin', 4217, 'Kilogram', 'CL24-109471', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-19', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(43, 14, 'CPXC0400914100G55', '0.40 x 914mm AZ100 G550 NEXALUME® Clear Resin', 4841, 'Kilogram', 'CL24-109234', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-17', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(44, 14, 'CPXC0701219100G50', '0.70 x 1219mm AZ100 G500 NEXALUME® Clear Resin', 7685, 'Kilogram', 'CL24-1211015', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-14', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(45, 14, 'CPXC0701219100G55', '0.70 x 1219mm AZ100 G550 NEXALUME® Clear Resin', 5893, 'Kilogram', 'CL24-109134', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-16', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(46, 14, 'CPXC0701219100G55', '0.70 x 1219mm AZ100 G550 NEXALUME® Clear Resin', 6509, 'Kilogram', 'CL24-109107', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-16', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(47, 14, 'CPXC0701219100G55', '0.70 x 1219mm AZ100 G550 NEXALUME® Clear Resin', 6690, 'Kilogram', 'CL24-109077', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-16', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(48, 14, 'CPXC0701219100G55', '0.70 x 1219mm AZ100 G550 NEXALUME® Clear Resin', 6702, 'Kilogram', 'CL24-109127', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-16', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(49, 14, 'CPXC0701219100G55', '0.70 x 1219mm AZ100 G550 NEXALUME® Clear Resin', 7267, 'Kilogram', 'CL24-109598', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-21', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(50, 14, 'CPXC0701219100G55', '0.70 x 1219mm AZ100 G550 NEXALUME® Clear Resin', 7599, 'Kilogram', 'CL24-109599', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-21', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(51, 14, 'CPXC0701219100G55', '0.70 x 1219mm AZ100 G550 NEXALUME® Clear Resin', 8033, 'Kilogram', 'CL24-109600', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-21', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(53, 14, 'CPXC2000955150G45', '2.00 x 955mm AZ150 G450 NEXALUME® Clear Resin', 7302, 'Kilogram', 'CL22-161871', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2022-10-31', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(54, 14, 'CPXC03501219ECOG55-LT', '0.35 x 1219mm G550 NEXALUME ECO', 4620, 'Kilogram', 'CL24-109349', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-18', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(55, 14, 'CPXC03501219ECOG55-LT', '0.35 x 1219mm G550 NEXALUME ECO', 4622, 'Kilogram', 'CL24-109348', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-18', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(56, 14, 'CPXC03501219ECOG55-LT', '0.35 x 1219mm G550 NEXALUME ECO', 4727, 'Kilogram', 'CL24-109352', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-18', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(57, 14, 'CPXC03501219ECOG55-LT', '0.35 x 1219mm G550 NEXALUME ECO', 4733, 'Kilogram', 'CL24-109353', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-18', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(58, 14, 'CPXC03501219ECOG55-LT', '0.35 x 1219mm G550 NEXALUME ECO', 4760, 'Kilogram', 'CL24-109334', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-18', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(59, 14, 'CPXC03501219ECOG55-LT', '0.35 x 1219mm G550 NEXALUME ECO', 4837, 'Kilogram', 'CL24-109365', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-18', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(60, 14, 'CPXC03501219ECOG55-LT', '0.35 x 1219mm G550 NEXALUME ECO', 4847, 'Kilogram', 'CL24-109354', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-18', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(61, 14, 'CPXC03501219ECOG55-LT', '0.35 x 1219mm G550 NEXALUME ECO', 4850, 'Kilogram', 'CL24-109357', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-18', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(62, 14, 'CPXC03501219ECOG55-LT', '0.35 x 1219mm G550 NEXALUME ECO', 4854, 'Kilogram', 'CL24-109355', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-18', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(63, 14, 'CPXC03501219ECOG55-LT', '0.35 x 1219mm G550 NEXALUME ECO', 4903, 'Kilogram', 'CL24-109333', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-18', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(64, 14, 'CPXC03501219ECOG55-LT', '0.35 x 1219mm G550 NEXALUME ECO', 5024, 'Kilogram', 'CL24-109343', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-18', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(65, 14, 'CPXC03501219ECOG55-LT', '0.35 x 1219mm G550 NEXALUME ECO', 5195, 'Kilogram', 'CL24-109338', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-18', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(66, 14, 'CPXC03501219ECOG55-LT', '0.35 x 1219mm G550 NEXALUME ECO', 5552, 'Kilogram', 'CL24-109335', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-18', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(67, 14, 'CPXC03501219ECOG55-LT', '0.35 x 1219mm G550 NEXALUME ECO', 5656, 'Kilogram', 'CL24-109359', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-18', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(68, 14, 'CPXC03500914ECOG55', '0.35 x 914mm G550 NEXALUME ECO', 3341, 'Kilogram', 'CL24-108594', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-10', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(69, 14, 'CPXC03500914ECOG55', '0.35 x 914mm G550 NEXALUME ECO', 3426, 'Kilogram', 'CL24-108742', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-12', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(70, 14, 'CPXC03500914ECOG55', '0.35 x 914mm G550 NEXALUME ECO', 4220, 'Kilogram', 'CL24-109294', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-18', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(71, 14, 'CPXC03500914ECOG55', '0.35 x 914mm G550 NEXALUME ECO', 4410, 'Kilogram', 'CL24-109519', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(72, 14, 'CPXC03500914ECOG55', '0.35 x 914mm G550 NEXALUME ECO', 4554, 'Kilogram', 'CL24-109235', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-17', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(73, 14, 'CPXC03500914ECOG55', '0.35 x 914mm G550 NEXALUME ECO', 4577, 'Kilogram', 'CL24-109472', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-19', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(74, 14, 'CPXC04001219ECOG55-LT', '0.40 x 1219mm G550 NEXALUME ECO', 4051, 'Kilogram', 'CL24-109374', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-18', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(75, 14, 'CPXC04001219ECOG55-LT', '0.40 x 1219mm G550 NEXALUME ECO', 5654, 'Kilogram', 'CL24-107753', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-01', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(76, 14, 'CPXC04001219ECOG55-LT', '0.40 x 1219mm G550 NEXALUME ECO', 5849, 'Kilogram', 'CL24-109329', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-18', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(77, 14, 'CPXC04001219ECOG55-LT', '0.40 x 1219mm G550 NEXALUME ECO', 5856, 'Kilogram', 'CL24-109331', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-18', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(78, 14, 'CPXC04001219ECOG55-LT', '0.40 x 1219mm G550 NEXALUME ECO', 5889, 'Kilogram', 'CL24-109326', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-18', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(79, 14, 'CPXC04001219ECOG55-LT', '0.40 x 1219mm G550 NEXALUME ECO', 5890, 'Kilogram', 'CL24-109325', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-18', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(80, 14, 'CPXC04001219ECOG55-LT', '0.40 x 1219mm G550 NEXALUME ECO', 5967, 'Kilogram', 'CL24-109376', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-18', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(81, 14, 'CPXC04001219ECOG55-LT', '0.40 x 1219mm G550 NEXALUME ECO', 5970, 'Kilogram', 'CL24-109377', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-18', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(82, 14, 'CPXC04001219ECOG55-LT', '0.40 x 1219mm G550 NEXALUME ECO', 6093, 'Kilogram', 'CL24-109378', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-18', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(83, 14, 'CPXC05001219ECOG55-LT', '0.50 x 1219mm G550 NEXALUME ECO', 5252, 'Kilogram', 'CL24-109382', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-19', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(84, 14, 'CPXC05001219ECOG55-LT', '0.50 x 1219mm G550 NEXALUME ECO', 5764, 'Kilogram', 'CL24-109381', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-19', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(85, 14, 'CPXC05001219ECOG55-LT', '0.50 x 1219mm G550 NEXALUME ECO', 5767, 'Kilogram', 'CL24-109380', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-18', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(86, 14, 'CPXC05001219ECOG55-LT', '0.50 x 1219mm G550 NEXALUME ECO', 5771, 'Kilogram', 'CL24-109379', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-18', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(87, 14, 'CPXC05501219ECOG55-LT', '0.55 x 1219mm G550 NEXALUME ECO', 5503, 'Kilogram', 'CL24-109524', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(88, 14, 'CPXC05501219ECOG55-LT', '0.55 x 1219mm G550 NEXALUME ECO', 5596, 'Kilogram', 'CL24-109522', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(89, 14, 'CPXC05501219ECOG55-LT', '0.55 x 1219mm G550 NEXALUME ECO', 5598, 'Kilogram', 'CL24-109523', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(90, 14, 'CPXC05501219ECOG55-LT', '0.55 x 1219mm G550 NEXALUME ECO', 5617, 'Kilogram', 'CL24-109521', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(91, 14, 'CPXC06001219ECOG55-LT', '0.60 x 1219mm G550 NEXALUME ECO', 6019, 'Kilogram', 'CL24-109405', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-19', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(92, 14, 'CPXC06001219ECOG55-LT', '0.60 x 1219mm G550 NEXALUME ECO', 6155, 'Kilogram', 'CL24-109536', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(93, 14, 'CPXC06001219ECOG55-LT', '0.60 x 1219mm G550 NEXALUME ECO', 6261, 'Kilogram', 'CL24-109535', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(94, 14, 'CPXC06001219ECOG55-LT', '0.60 x 1219mm G550 NEXALUME ECO', 6263, 'Kilogram', 'CL24-109534', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(95, 14, 'CPXC06001219ECOG55-LT', '0.60 x 1219mm G550 NEXALUME ECO', 6347, 'Kilogram', 'CL24-109470', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-19', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(96, 14, 'CPXC06001219ECOG55-LT', '0.60 x 1219mm G550 NEXALUME ECO', 6616, 'Kilogram', 'CL24-109469', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-19', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(97, 14, 'CPXC06001219ECOG55-LT', '0.60 x 1219mm G550 NEXALUME ECO', 6618, 'Kilogram', 'CL24-109468', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-19', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(98, 14, 'CPXC06001219ECOG55-LT', '0.60 x 1219mm G550 NEXALUME ECO', 6654, 'Kilogram', 'CL24-109533', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(99, 14, 'CPXC06001219ECOG55-LT', '0.60 x 1219mm G550 NEXALUME ECO', 6766, 'Kilogram', 'CL24-109537', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(100, 14, 'CPXC06001219ECOG55-LT', '0.60 x 1219mm G550 NEXALUME ECO', 6768, 'Kilogram', 'CL24-109538', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(101, 14, 'CPXC06001219ECOG55-LT', '0.60 x 1219mm G550 NEXALUME ECO', 6944, 'Kilogram', 'CL24-109542', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(102, 14, 'CPXC06001219ECOG55-LT', '0.60 x 1219mm G550 NEXALUME ECO', 6947, 'Kilogram', 'CL24-109531', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(103, 14, 'CPXC06001219ECOG55-LT', '0.60 x 1219mm G550 NEXALUME ECO', 6948, 'Kilogram', 'CL24-109532', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(104, 14, 'CPXC06001219ECOG55-LT', '0.60 x 1219mm G550 NEXALUME ECO', 6953, 'Kilogram', 'CL24-109407', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-19', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(105, 14, 'CPXC06001219ECOG55-LT', '0.60 x 1219mm G550 NEXALUME ECO', 7245, 'Kilogram', 'CL24-109383', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-19', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(106, 14, 'CPXC06001219ECOG55-LT', '0.60 x 1219mm G550 NEXALUME ECO', 7307, 'Kilogram', 'CL24-109541', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(107, 14, 'CPXC06001219ECOG55-LT', '0.60 x 1219mm G550 NEXALUME ECO', 7310, 'Kilogram', 'CL24-109540', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(108, 14, 'CPXC07001219ECOG55-LT', '0.70 x 1219mm G550 NEXALUME ECO', 4936, 'Kilogram', 'CL24-109552', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(109, 14, 'CPXC07001219ECOG55-LT', '0.70 x 1219mm G550 NEXALUME ECO', 5473, 'Kilogram', 'CL24-109553', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(110, 14, 'CPXC07001219ECOG55-LT', '0.70 x 1219mm G550 NEXALUME ECO', 5597, 'Kilogram', 'CL24-109587', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(111, 14, 'CPXC07001219ECOG55-LT', '0.70 x 1219mm G550 NEXALUME ECO', 5633, 'Kilogram', 'CL24-109551', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(112, 14, 'CPXC07001219ECOG55-LT', '0.70 x 1219mm G550 NEXALUME ECO', 5852, 'Kilogram', 'CL24-109550', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(113, 14, 'CPXC07001219ECOG55-LT', '0.70 x 1219mm G550 NEXALUME ECO', 5926, 'Kilogram', 'CL24-109549', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(114, 14, 'CPXC07001219ECOG55-LT', '0.70 x 1219mm G550 NEXALUME ECO', 6140, 'Kilogram', 'CL24-109588', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-21', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(115, 14, 'CPXC07001219ECOG55-LT', '0.70 x 1219mm G550 NEXALUME ECO', 7695, 'Kilogram', 'CL24-109590', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-21', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(116, 14, 'CPXC07001219ECOG55-LT', '0.70 x 1219mm G550 NEXALUME ECO', 7696, 'Kilogram', 'CL24-109589', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-21', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(117, 14, 'CPXC07001219ECOG55-LT', '0.70 x 1219mm G550 NEXALUME ECO', 7742, 'Kilogram', 'CL24-109584', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(118, 14, 'CPXC07001219ECOG55-LT', '0.70 x 1219mm G550 NEXALUME ECO', 7768, 'Kilogram', 'CL24-109583', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(119, 14, 'CPXC07001219ECOG55-LT', '0.70 x 1219mm G550 NEXALUME ECO', 7805, 'Kilogram', 'CL24-109572', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(120, 14, 'CPXC07001219ECOG55-LT', '0.70 x 1219mm G550 NEXALUME ECO', 7808, 'Kilogram', 'CL24-109573', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(121, 14, 'CPXC07001219ECOG55-LT', '0.70 x 1219mm G550 NEXALUME ECO', 7814, 'Kilogram', 'CL24-109577', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(122, 14, 'CPXC07001219ECOG55-LT', '0.70 x 1219mm G550 NEXALUME ECO', 7814, 'Kilogram', 'CL24-109582', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(123, 14, 'CPXC07001219ECOG55-LT', '0.70 x 1219mm G550 NEXALUME ECO', 7816, 'Kilogram', 'CL24-109581', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(124, 14, 'CPXC07001219ECOG55-LT', '0.70 x 1219mm G550 NEXALUME ECO', 7817, 'Kilogram', 'CL24-109555', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(125, 14, 'CPXC07001219ECOG55-LT', '0.70 x 1219mm G550 NEXALUME ECO', 7822, 'Kilogram', 'CL24-109554', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(126, 14, 'CPXC07001219ECOG55-LT', '0.70 x 1219mm G550 NEXALUME ECO', 7859, 'Kilogram', 'CL24-109562', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(127, 14, 'CPXC07001219ECOG55-LT', '0.70 x 1219mm G550 NEXALUME ECO', 7873, 'Kilogram', 'CL24-109564', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(128, 14, 'CPXC07001219ECOG55-LT', '0.70 x 1219mm G550 NEXALUME ECO', 7875, 'Kilogram', 'CL24-109563', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(129, 14, 'CPXC07001219ECOG55-LT', '0.70 x 1219mm G550 NEXALUME ECO', 7880, 'Kilogram', 'CL24-109575', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(130, 14, 'CPXC07001219ECOG55-LT', '0.70 x 1219mm G550 NEXALUME ECO', 7894, 'Kilogram', 'CL24-109567', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(131, 14, 'CPXC07001219ECOG55-LT', '0.70 x 1219mm G550 NEXALUME ECO', 7896, 'Kilogram', 'CL24-109566', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(132, 14, 'CPXC07001219ECOG55-LT', '0.70 x 1219mm G550 NEXALUME ECO', 7899, 'Kilogram', 'CL24-109574', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(133, 14, 'CPXC07001219ECOG55-LT', '0.70 x 1219mm G550 NEXALUME ECO', 7900, 'Kilogram', 'CL24-109560', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(134, 14, 'CPXC07001219ECOG55-LT', '0.70 x 1219mm G550 NEXALUME ECO', 7924, 'Kilogram', 'CL24-109591', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-21', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(135, 14, 'CPXC07001219ECOG55-LT', '0.70 x 1219mm G550 NEXALUME ECO', 7927, 'Kilogram', 'CL24-109559', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(136, 14, 'CPXC07001219ECOG55-LT', '0.70 x 1219mm G550 NEXALUME ECO', 7929, 'Kilogram', 'CL24-109565', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(137, 14, 'CPXC09501219ECOG55-LT', '0.95 x 1219mm G550 NEXALUME ECO', 7253, 'Kilogram', 'CL24-109593', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-21', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(138, 14, 'CPXC09501219ECOG55-LT', '0.95 x 1219mm G550 NEXALUME ECO', 7258, 'Kilogram', 'CL24-109592', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-21', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(139, 14, 'CPXC09501219ECOG55-LT', '0.95 x 1219mm G550 NEXALUME ECO', 7601, 'Kilogram', 'CL24-109594', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-21', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(140, 14, 'CPXC0250914070G55-EXP', '0.25 x 914mm AZ70 G550 NEXALUME® Clear Resin', 3836, 'Kilogram', 'CL24-109497', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(141, 14, 'CPXC0250914070G55-EXP', '0.25 x 914mm AZ70 G550 NEXALUME® Clear Resin', 3904, 'Kilogram', 'CL24-109493', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(142, 14, 'CPXC0250914070G55-EXP', '0.25 x 914mm AZ70 G550 NEXALUME® Clear Resin', 3924, 'Kilogram', 'CL24-109496', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(143, 14, 'CPXC0250914070G55-EXP', '0.25 x 914mm AZ70 G550 NEXALUME® Clear Resin', 4000, 'Kilogram', 'CL24-109505', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(144, 14, 'CPXC0250914070G55-EXP', '0.25 x 914mm AZ70 G550 NEXALUME® Clear Resin', 4246, 'Kilogram', 'CL24-109513', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(145, 14, 'CPXC0250914070G55-EXP', '0.25 x 914mm AZ70 G550 NEXALUME® Clear Resin', 4303, 'Kilogram', 'CL24-109510', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(146, 14, 'CPXC0250914070G55-EXP', '0.25 x 914mm AZ70 G550 NEXALUME® Clear Resin', 4303, 'Kilogram', 'CL24-109512', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(147, 14, 'CPXC0250914070G55-EXP', '0.25 x 914mm AZ70 G550 NEXALUME® Clear Resin', 4303, 'Kilogram', 'CL24-109515', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(148, 14, 'CPXC0250914070G55-EXP', '0.25 x 914mm AZ70 G550 NEXALUME® Clear Resin', 4304, 'Kilogram', 'CL24-109511', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(149, 14, 'CPXC0250914070G55-EXP', '0.25 x 914mm AZ70 G550 NEXALUME® Clear Resin', 4304, 'Kilogram', 'CL24-109516', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(150, 14, 'CPXC0250914070G55-EXP', '0.25 x 914mm AZ70 G550 NEXALUME® Clear Resin', 4305, 'Kilogram', 'CL24-109517', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(151, 14, 'CPXC0250914070G55-EXP', '0.25 x 914mm AZ70 G550 NEXALUME® Clear Resin', 4306, 'Kilogram', 'CL24-109514', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(152, 14, 'CPXC0250914070G55-EXP', '0.25 x 914mm AZ70 G550 NEXALUME® Clear Resin', 4355, 'Kilogram', 'CL24-109509', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(153, 14, 'CPXC0250914070G55-EXP', '0.25 x 914mm AZ70 G550 NEXALUME® Clear Resin', 4377, 'Kilogram', 'CL24-109506', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(154, 14, 'CPXC0250914070G55-EXP', '0.25 x 914mm AZ70 G550 NEXALUME® Clear Resin', 4378, 'Kilogram', 'CL24-109507', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(155, 14, 'CPXC0250914070G55-EXP', '0.25 x 914mm AZ70 G550 NEXALUME® Clear Resin', 4380, 'Kilogram', 'CL24-109508', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(156, 14, 'CPXC0250914070G55-EXP', '0.25 x 914mm AZ70 G550 NEXALUME® Clear Resin', 4444, 'Kilogram', 'CL24-109502', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(157, 14, 'CPXC0250914070G55-EXP', '0.25 x 914mm AZ70 G550 NEXALUME® Clear Resin', 4446, 'Kilogram', 'CL24-109503', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(158, 14, 'CPXC0250914070G55-EXP', '0.25 x 914mm AZ70 G550 NEXALUME® Clear Resin', 4448, 'Kilogram', 'CL24-109504', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(159, 14, 'CPXC0250914070G55-EXP', '0.25 x 914mm AZ70 G550 NEXALUME® Clear Resin', 4610, 'Kilogram', 'CL24-109498', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(160, 14, 'CPXC0250914070G55-EXP', '0.25 x 914mm AZ70 G550 NEXALUME® Clear Resin', 4611, 'Kilogram', 'CL24-109499', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(161, 14, 'CPXC0250914070G55-EXP', '0.25 x 914mm AZ70 G550 NEXALUME® Clear Resin', 4614, 'Kilogram', 'CL24-109500', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(162, 14, 'CPXC0250914070G55-EXP', '0.25 x 914mm AZ70 G550 NEXALUME® Clear Resin', 4745, 'Kilogram', 'CL24-109494', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(163, 14, 'CPXC0250914070G55-EXP', '0.25 x 914mm AZ70 G550 NEXALUME® Clear Resin', 4747, 'Kilogram', 'CL24-109495', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(164, 14, 'CPXC0250914070G55-EXP', '0.25 x 914mm AZ70 G550 NEXALUME® Clear Resin', 4892, 'Kilogram', 'CL24-109501', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(165, 14, 'CPXC04501100165G35-EXP', '0.45 x 1100mm AZ165 G350 NEXALUME® Clear Resin', 4168, 'Kilogram', 'CL24-199941', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-06-23', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(166, 14, 'CPXC0751219100G55 EXP', '0.75 x 1219mm AZ100 G550 NEXALUME® Clear Resin', 7677, 'Kilogram', 'CL24-109596', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-21', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(167, 14, 'CPXC0751219100G55 EXP', '0.75 x 1219mm AZ100 G550 NEXALUME® Clear Resin', 7682, 'Kilogram', 'CL24-109595', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-21', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(168, 14, 'CPXC0751219100G55 EXP', '0.75 x 1219mm AZ100 G550 NEXALUME® Clear Resin', 7765, 'Kilogram', 'CL24-109597', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-21', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(169, 14, 'CPC0250914100G550PULE02', '0.25 x 914mm AZ100 G550 NEXCOLOR® NOVA Putih Lembang', 1494, 'Kilogram', 'CC24-10003091', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-01-22', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(170, 14, 'CPC0250914100G550PULE02', '0.25 x 914mm AZ100 G550 NEXCOLOR® NOVA Putih Lembang', 1901, 'Kilogram', 'CC24-10003092', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-01-22', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(171, 14, 'CPIC0600914080G55 AFP', '0.60 x 914mm Z08 D570 NEXIUM® Clear Resin', 3363, 'Kilogram', 'CI24-106546', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-09-15', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(172, 14, 'CPIC0600914080G570', '0.60 x 914mm Z08 D570 NEXIUM® PASSIVATION', 3236, 'Kilogram', 'CI24-192034', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-02-29', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(173, 14, 'CPIC0600914250G55-Mg', '0.60 x 914mm Z25 D570 NEXIUM® PASSIVATION MgZn', 2608, 'Kilogram', 'CI24-1190999', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-08-13', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(174, 14, 'CPIC0701219100G55 AFP', '0.70 x 1219mm Z10 D570 NEXIUM® Clear Resin', 3696, 'Kilogram', 'CI24-106541', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-09-15', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(175, 14, 'CPIC0701219100G55 AFP', '0.70 x 1219mm Z10 D570 NEXIUM® Clear Resin', 5097, 'Kilogram', 'CI24-106543', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-09-15', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(176, 14, 'CPIC0701219100G55 AFP', '0.70 x 1219mm Z10 D570 NEXIUM® Clear Resin', 5097, 'Kilogram', 'CI24-106544', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-09-15', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(177, 14, 'CPIC0701219100G55 AFP', '0.70 x 1219mm Z10 D570 NEXIUM® Clear Resin', 5098, 'Kilogram', 'CI24-106542', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-09-15', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(178, 14, 'CPIC0701219100G55 AFP', '0.70 x 1219mm Z10 D570 NEXIUM® Clear Resin', 5305, 'Kilogram', 'CI24-106545', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-09-15', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(179, 14, 'CPIC0701219250G55HTB Mg', '0.70 x 1219mm Z25 D570 NEXIUM® Hitam Banyuasin DS MgZn', 5130, 'Kilogram', 'CI24-1191040', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-08-13', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(180, 14, 'CPIC0701219275G55-AFP', '0.70 x 1219mm Z27 D570 NEXIUM® Clear Resin', 4196, 'Kilogram', 'CI24-106353', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-09-13', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(181, 14, 'CPIC0701219275G55-AFP', '0.70 x 1219mm Z27 D570 NEXIUM® Clear Resin', 4201, 'Kilogram', 'CI24-106354', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-09-13', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(182, 14, 'CPIC0701219275G55-AFP', '0.70 x 1219mm Z27 D570 NEXIUM® Clear Resin', 4318, 'Kilogram', 'CI24-106355', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-09-13', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(183, 14, 'CPIC0701219275G55-AFP', '0.70 x 1219mm Z27 D570 NEXIUM® Clear Resin', 4649, 'Kilogram', 'CI24-106365', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-09-13', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(184, 14, 'CPIC0701219275G55-AFP', '0.70 x 1219mm Z27 D570 NEXIUM® Clear Resin', 4666, 'Kilogram', 'CI24-106357', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-09-13', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(185, 14, 'CPIC0701219275G55-AFP', '0.70 x 1219mm Z27 D570 NEXIUM® Clear Resin', 4800, 'Kilogram', 'CI24-106359', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-09-13', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(186, 14, 'CPIC0701219275G55-AFP', '0.70 x 1219mm Z27 D570 NEXIUM® Clear Resin', 4801, 'Kilogram', 'CI24-106358', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-09-13', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(187, 14, 'CPIC0701219275G55-AFP', '0.70 x 1219mm Z27 D570 NEXIUM® Clear Resin', 4818, 'Kilogram', 'CI24-106356', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-09-13', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(188, 14, 'CPIC0701219275G55-AFP', '0.70 x 1219mm Z27 D570 NEXIUM® Clear Resin', 4863, 'Kilogram', 'CI24-106366', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-09-13', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(189, 14, 'CPIC0701219275G55-AFP', '0.70 x 1219mm Z27 D570 NEXIUM® Clear Resin', 4869, 'Kilogram', 'CI24-106362', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-09-13', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(190, 14, 'CPIC0701219275G55-AFP', '0.70 x 1219mm Z27 D570 NEXIUM® Clear Resin', 4872, 'Kilogram', 'CI24-106361', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-09-13', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(191, 14, 'CPIC0701219275G55-AFP', '0.70 x 1219mm Z27 D570 NEXIUM® Clear Resin', 4875, 'Kilogram', 'CI24-106364', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-09-13', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(192, 14, 'CPIC0701219275G55-AFP', '0.70 x 1219mm Z27 D570 NEXIUM® Clear Resin', 4879, 'Kilogram', 'CI24-106363', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-09-13', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(193, 14, 'CPIC0701219275G55-AFP', '0.70 x 1219mm Z27 D570 NEXIUM® Clear Resin', 4916, 'Kilogram', 'CI24-106360', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-09-13', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(194, 14, 'CPIC0701219275G55-Mg', '0.70 x 1219mm Z27 D570 NEXIUM® PASSIVATION MgZn', 4085, 'Kilogram', 'CI24-1191403', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-09-20', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(195, 14, 'CPIC1500900275G45HTB', '1.50 x 900mm Z27 D490 NEXIUM® Hitam Banyuasin DS', 5940, 'Kilogram', 'CI24-101854', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-07-15', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(196, 14, 'CPIC2401219275G30', '2.40 x 1219mm Z27 D400 NEXIUM® PASSIVATION', 4279, 'Kilogram', 'CI24-1190024', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-06-18', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(197, 14, 'CPIC2401219275G30', '2.40 x 1219mm Z27 D400 NEXIUM® PASSIVATION', 4279, 'Kilogram', 'CI24-1190025', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-06-18', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(198, 14, 'CPIC2400860350G300', '2.40 x 860mm Z35 D400 NEXIUM® PASSIVATION', 7869, 'Kilogram', 'CI23-1112093', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2023-10-24', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(199, 14, 'CPIC2400860350G300', '2.40 x 860mm Z35 D400 NEXIUM® PASSIVATION', 7999, 'Kilogram', 'CI23-1112092', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2023-10-24', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(200, 14, 'CPIC0601219100G570', '0.60 x 1219mm Z10 D570 NEXIUM® PASSIVATION', 7909, 'Kilogram', 'CI23-1110825', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2023-05-27', NULL, '2025-05-28 14:29:28', '2025-05-28 14:29:28'),
(203, 14, 'CPIC2401190350G450', '2.40 x 1190mm Z35 D490 NEXIUM® PASSIVATION', 6513, 'Kilogram', 'CI24-196730', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-05-08', NULL, '2025-05-28 14:29:29', '2025-05-28 14:29:29'),
(204, 14, 'CPIC2501219275G35', '2.50 x 1219mm Z27 D440 NEXIUM® PASSIVATION', 7004, 'Kilogram', 'CI24-101919', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-07-15', NULL, '2025-05-28 14:29:29', '2025-05-28 14:29:29'),
(205, 14, 'CPIC2501219275G35', '2.50 x 1219mm Z27 D440 NEXIUM® PASSIVATION', 8084, 'Kilogram', 'CI24-101923', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-07-15', NULL, '2025-05-28 14:29:29', '2025-05-28 14:29:29'),
(206, 14, 'CPIC2501219275G55', '2.50 x 1219mm Z27 D570 NEXIUM® PASSIVATION', 7727, 'Kilogram', 'CI24-1190856', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-08-07', NULL, '2025-05-28 14:29:29', '2025-05-28 14:29:29'),
(207, 14, 'CPIC2501219275G55', '2.50 x 1219mm Z27 D570 NEXIUM® PASSIVATION', 8001, 'Kilogram', 'CI24-1190857', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-08-07', NULL, '2025-05-28 14:29:29', '2025-05-28 14:29:29'),
(208, 14, 'CPIC0600914060G550', '0.60 x 914mm D570 NEXIUM NEO PASSIVATION', 3011, 'Kilogram', 'CI23-178570', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2023-08-02', NULL, '2025-05-28 14:29:29', '2025-05-28 14:29:29'),
(209, 14, 'CP0000000000119MG', '0.25 x 1219mm AZ70 G550 NEXALUME® Clear Resin Medium Grade', 362, 'Kilogram', 'CL24-1206926', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-08-27', NULL, '2025-05-28 14:29:29', '2025-05-28 14:29:29'),
(210, 14, 'CP0000000000621SG-ABS BR', '0.25 x 914mm AZ100 G300 NEXALUME® SS/Abu Setu Second Grade', 1080, 'Kilogram', 'CL24-105937', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-09-02', NULL, '2025-05-28 14:29:29', '2025-05-28 14:29:29'),
(211, 14, 'CP0000000000107MG', '0.25 x 914mm AZ70 G300 NEXALUME® Clear Resin Medium Grade', 314, 'Kilogram', 'CL23-1147576', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2023-10-14', NULL, '2025-05-28 14:29:29', '2025-05-28 14:29:29'),
(212, 14, 'CP0000000000067MG', '0.25 x 914mm AZ70 G550 NEXALUME Clear Resin Medium Grade', 272, 'Kilogram', 'CL24-1210727', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-11', NULL, '2025-05-28 14:29:29', '2025-05-28 14:29:29'),
(213, 14, 'CP0000000000067MG', '0.25 x 914mm AZ70 G550 NEXALUME Clear Resin Medium Grade', 283, 'Kilogram', 'CL24-1203974', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-07-25', NULL, '2025-05-28 14:29:29', '2025-05-28 14:29:29'),
(214, 14, 'CP0000000000088SG', '0.30 x 914mm AZ100 G550 NEXALUME® Clear Resin Second Grade', 165, 'Kilogram', 'CL24-1209566', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-09-30', NULL, '2025-05-28 14:29:29', '2025-05-28 14:29:29'),
(215, 14, 'CP0000000000012SG', '0.35 x 1219mm  AZ100 G550 NEXALUME® Clear Resin Second Grade', 220, 'Kilogram', 'CL24-1210730', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-11', NULL, '2025-05-28 14:29:29', '2025-05-28 14:29:29'),
(216, 14, 'CP0000000000253MG', '0.35 x 914mm G550 NEXALUME ECO Medium Grade', 254, 'Kilogram', 'CL24-1211182', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-15', NULL, '2025-05-28 14:29:29', '2025-05-28 14:29:29'),
(217, 14, 'CP0000000000546MG-LT', '0.35 x 914mm G550 NEXALUME ECO Medium Grade', 319, 'Kilogram', 'CL24-1209988', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-03', NULL, '2025-05-28 14:29:29', '2025-05-28 14:29:29'),
(218, 14, 'CP0000000000238MG', '0.40 x 914mm AZ100 G550 NEXALUME® Clear Resin Medium Grade', 803, 'Kilogram', 'CL24-1209987', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-03', NULL, '2025-05-28 14:29:29', '2025-05-28 14:29:29'),
(219, 14, 'CP0000000000002MG', '0.60 x 1219mm AZ100 G550 NEXALUME® Clear Resin Medium Grade', 863, 'Kilogram', 'CL24-107833', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-01', NULL, '2025-05-28 14:29:29', '2025-05-28 14:29:29'),
(220, 14, 'CP0000000000002MG', '0.60 x 1219mm AZ100 G550 NEXALUME® Clear Resin Medium Grade', 886, 'Kilogram', 'CL24-1210377', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-07', NULL, '2025-05-28 14:29:29', '2025-05-28 14:29:29'),
(221, 14, 'CP0000000000002MG', '0.60 x 1219mm AZ100 G550 NEXALUME® Clear Resin Medium Grade', 1059, 'Kilogram', 'CL24-1211160', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-15', NULL, '2025-05-28 14:29:29', '2025-05-28 14:29:29'),
(222, 14, 'CP0000000000462SG', '0.60 x 607mm AZ100 G550 NEXALUME® Clear Resin Second Grade', 1159, 'Kilogram', 'CL24-108178', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-04', NULL, '2025-05-28 14:29:29', '2025-05-28 14:29:29'),
(223, 14, 'CP0000000000004MG', '0.95 x 1219mm AZ100 G550 NEXALUME® Clear Resin Medium Grade', 2170, 'Kilogram', 'CL24-1210279', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-10-06', NULL, '2025-05-28 14:29:29', '2025-05-28 14:29:29'),
(224, 14, 'CPTC0250914100G55', '0.25 x 914mm AZ100 G550 TATALUME Clear Resin', 4231, 'Kilogram', 'CL23-186982', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2023-11-11', NULL, '2025-05-28 14:29:29', '2025-05-28 14:29:29'),
(225, 14, 'CPTC0250914070G30', '0.25 x 914mm AZ70 G300 TATALUME Clear Resin', 1006, 'Kilogram', 'CL24-191667', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-02-23', NULL, '2025-05-28 14:29:29', '2025-05-28 14:29:29'),
(226, 14, 'CPTC0351219150G55', '0.35 x 1219mm AZ150 G550 TATALUME Clear Resin', 3768, 'Kilogram', 'CL24-106603', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-09-17', NULL, '2025-05-28 14:29:29', '2025-05-28 14:29:29'),
(227, 14, 'CPTC0351219150G55', '0.35 x 1219mm AZ150 G550 TATALUME Clear Resin', 3778, 'Kilogram', 'CL24-106602', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-09-17', NULL, '2025-05-28 14:29:29', '2025-05-28 14:29:29'),
(228, 14, 'CPTC0351219150G55', '0.35 x 1219mm AZ150 G550 TATALUME Clear Resin', 4020, 'Kilogram', 'CL24-106604', 'WH-L03-BJ L1-L10-CBT (3-3-3)', '2024-09-17', NULL, '2025-05-28 14:29:29', '2025-05-28 14:29:29');

-- --------------------------------------------------------

--
-- Table structure for table `division`
--

CREATE TABLE `division` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `division` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` json DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `division`
--

INSERT INTO `division` (`id`, `division`, `keterangan`, `status`, `created_at`, `updated_at`, `type`) VALUES
(2, 'Warehouse', 'Divisi Warehouses', NULL, '2025-05-26 15:00:07', '2025-05-26 15:42:57', '[\"MP\", \"FC\"]'),
(5, 'Produksi', 'Divisi Produksis', NULL, '2025-05-26 15:01:23', '2025-05-26 15:47:36', '[\"FC\"]'),
(7, 'HR', 'Divisi HR', NULL, '2025-06-01 18:29:15', '2025-06-01 18:29:30', '[]'),
(8, 'Baru', NULL, NULL, '2025-06-04 06:56:49', '2025-06-04 06:56:49', '[]');

-- --------------------------------------------------------

--
-- Table structure for table `eup`
--

CREATE TABLE `eup` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `jenis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kaki_pallet` text COLLATE utf8mb4_unicode_ci,
  `permukaan_pallet` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ketebalan_pallet` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paku_pallet` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keluar_pallet` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kaba_simetris` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kaba_asimetris` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `papan_patah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `papan_pecah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sesuai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto7` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `eup`
--

INSERT INTO `eup` (`id`, `user_id`, `date`, `jenis`, `kaki_pallet`, `permukaan_pallet`, `ketebalan_pallet`, `paku_pallet`, `keluar_pallet`, `kaba_simetris`, `kaba_asimetris`, `papan_patah`, `papan_pecah`, `sesuai`, `action`, `foto7`, `created_at`, `updated_at`) VALUES
(4, 14, '2024-11-22', 'Pengecekan Pergantian Shift (Layout Penyimpanan Pallet dan EUP)', '\"Bentuk kaki simetris (Balok)|Bentuk kaki bagian bawah rata namun bagian atas sedikit tidak rata\"', 'Permukaan Papan Rata (Tidak Pecah, Tidak Patah dan Tidak Basah)', 'Ketebalan Papan (Tidak Pecah, Tidak Patah dan Tidak Basah)', 'Paku tidak Keluar', 'Paku Keluar', 'Bentuk kaki bagian bawah tidak simetris (Tidak Balok)', 'Bentuk kaki bagian atas tidak simetris (Tidak Balok)', 'Papan Permukaan Pallet Patah', 'Papan Permukaan Pallet Pecah', 'Ya', 'Pallet diterima', '\"22-11-2024\\/673fdc6369f29.jpg\"', '2024-11-22 01:20:36', '2024-11-22 01:20:36'),
(5, 22, '2024-12-20', 'Pengecekan Pergantian Shift (Layout Penyimpanan Pallet dan EUP)', '\"Bentuk kaki simetris (Balok)|Bentuk kaki bagian bawah rata namun bagian atas sedikit tidak rata\"', 'Permukaan Papan Rata (Tidak Pecah, Tidak Patah dan Tidak Basah)', 'Ketebalan Papan (Tidak Pecah, Tidak Patah dan Tidak Basah)', 'Paku tidak Keluar', NULL, NULL, NULL, NULL, NULL, 'Ya', 'Pallet dilayout OK', '\"20-12-2024\\/6764d0b72e302.jpeg\"', '2024-12-20 02:04:40', '2024-12-20 02:04:40'),
(6, 63, '2024-12-20', 'Penerimaan Pallet', '\"Bentuk kaki simetris (Balok)|Bentuk kaki bagian bawah rata namun bagian atas sedikit tidak rata\"', 'Permukaan Papan Rata (Tidak Pecah, Tidak Patah dan Tidak Basah)', 'Ketebalan Papan (Tidak Pecah, Tidak Patah dan Tidak Basah)', 'Paku tidak Keluar', NULL, NULL, NULL, NULL, NULL, 'Ya', 'Pallet diterima', '\"20-12-2024\\/6764d0df59340.jpg\"', '2024-12-20 02:05:19', '2024-12-20 02:05:19'),
(7, 22, '2024-12-20', 'Pengecekan Pergantian Shift (Layout Penyimpanan Pallet dan EUP)', '\"Bentuk kaki simetris (Balok)|Bentuk kaki bagian bawah rata namun bagian atas sedikit tidak rata\"', 'Permukaan Papan Rata (Tidak Pecah, Tidak Patah dan Tidak Basah)', 'Ketebalan Papan (Tidak Pecah, Tidak Patah dan Tidak Basah)', 'Paku tidak Keluar', NULL, NULL, NULL, NULL, NULL, 'Ya', 'Pallet dilayout OK', '\"\"', '2024-12-20 02:53:50', '2024-12-20 02:53:50'),
(8, 101, '2025-05-28', 'Penerimaan Pallet', '\"Bentuk kaki simetris (Balok)|Bentuk kaki bagian bawah rata namun bagian atas sedikit tidak rata\"', 'Permukaan Papan Rata (Tidak Pecah, Tidak Patah dan Tidak Basah)', 'Ketebalan Papan (Tidak Pecah, Tidak Patah dan Tidak Basah)', 'Paku tidak Keluar', 'Paku Keluar', 'Bentuk kaki bagian bawah tidak simetris (Tidak Balok)', 'Bentuk kaki bagian atas tidak simetris (Tidak Balok)', 'Papan Permukaan Pallet Patah', 'Papan Permukaan Pallet Pecah', 'Ya', 'Pallet diterima', '\"28-05-2025\\/6837102632aeb.jpg\"', '2025-05-28 13:31:19', '2025-05-28 13:31:19');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `forklift`
--

CREATE TABLE `forklift` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `shift_leader` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_forklift` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shift` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `awal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `horn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mundur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sein` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rotating` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stop` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `utama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connector` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `accu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parking` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brake` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `akhir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `oil` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `raulic` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `chain` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `allhose` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `steering` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `belts` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cooland` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transmisi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ban` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fork` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teba` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `mtc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_awal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_akhir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_horn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_mundur` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_sein` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_rotating` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_stop` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_utama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_connector` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_accu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_parking` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_brake` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_oil` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_raulic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_chain` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_allhose` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_steering` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_belts` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_cooland` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_transmisi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_ban` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_fork` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_teba` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `forklift`
--

INSERT INTO `forklift` (`id`, `user_id`, `shift_leader`, `jenis_forklift`, `shift`, `date`, `awal`, `horn`, `mundur`, `sein`, `rotating`, `stop`, `utama`, `connector`, `accu`, `parking`, `brake`, `akhir`, `oil`, `raulic`, `chain`, `allhose`, `steering`, `belts`, `cooland`, `transmisi`, `ban`, `fork`, `teba`, `catatan`, `mtc`, `ket_awal`, `ket_akhir`, `ket_horn`, `ket_mundur`, `ket_sein`, `ket_rotating`, `ket_stop`, `ket_utama`, `ket_connector`, `ket_accu`, `ket_parking`, `ket_brake`, `ket_oil`, `ket_raulic`, `ket_chain`, `ket_allhose`, `ket_steering`, `ket_belts`, `ket_cooland`, `ket_transmisi`, `ket_ban`, `ket_fork`, `ket_teba`, `created_at`, `updated_at`) VALUES
(3, 49, 'Dika', '5 Ton No.6 (PACKING EXPORT)', '1', '2024-12-18', '6440.8', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'h', 'v', 'v', '6445.7', 'h', 'h', 'v', 'v', 'v', 'v', 'h', 'h', 'v', 'v', 'v', 'Aman', 'Mulyadi', '-', '-', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-18 07:29:03', '2024-12-18 07:29:03'),
(4, 39, 'Panggah', '5 Ton No.4 (STUFING EXPORT)', '1', '2024-12-18', '8914,9', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'h', 'v', 'v', '8915,9', 'h', 'h', 'v', 'o', 'v', 'v', 'h', 'h', 'o', 'v', 'v', 'Ban depan botak', 'Mulyadi', '8914,9', '8914,9', 'Ok', 'Ok', 'Ok', 'Ok', 'Ok', 'Ok', 'Ok', 'H', 'Ok', 'Ok', 'H', 'H', 'Ok', 'Ada rembesan', 'Ok', 'Ok', 'H', 'H', 'Ban depan botak', 'Ok', NULL, '2024-12-18 07:35:51', '2024-12-18 07:35:51'),
(5, 36, 'Riyan H', '5 Ton No.6 (PACKING EXPORT)', '2', '2024-12-18', '1000', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'h', 'v', 'v', '1020', 'h', 'h', 'v', 'v', 'v', 'v', 'h', 'h', 'v', 'v', 'v', NULL, 'Mulyadi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-18 08:16:05', '2024-12-18 08:16:05'),
(6, 84, 'Dika', '5 Ton No.6 (PACKING EXPORT)', '2', '2024-12-18', '1000', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'h', 'v', 'v', '1008', 'h', 'h', 'v', 'v', 'v', 'v', 'h', 'h', 'v', 'v', 'v', NULL, 'Mulyadi', '1008', '1008', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-18 08:19:08', '2024-12-18 08:19:08'),
(7, 55, 'Dika', '5 Ton No.5 (DELIVERY L3)', '2', '2024-12-19', '292841', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'h', 'v', 'v', '292879', 'h', 'h', 'v', 'o', 'v', 'v', 'l', 'h', 'v', 'v', 'x', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-19 08:43:47', '2024-12-19 08:43:47'),
(8, 23, 'Riyan H', '10 Ton', '1', '2024-12-20', '2013.6', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'h', 'v', 'v', '2014.6', 'h', 'h', 'v', 'v', 'v', 'v', 'h', 'h', 'v', 'v', 'v', 'Forklif 10 ton Sadang', 'Mulyadi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-19 22:48:13', '2024-12-19 22:48:13'),
(9, 69, 'Freddy', '5 Ton No.3 (EUP)', '1', '2024-12-20', '18580.4', 'x', 'v', 'v', 'v', 'v', 'v', 'v', 'h', 'v', 'v', '18584.9', 'h', 'h', 'v', 'v', 'v', 'v', 'h', 'h', 'v', 'v', 'v', NULL, NULL, NULL, NULL, 'Klakson tidak nyala', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-20 07:20:33', '2024-12-20 07:20:33'),
(10, 55, 'Freddy', '5 Ton No.5 (DELIVERY L3)', '2', '2024-12-20', '292880', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'h', 'v', 'v', '292892', 'h', 'h', 'v', 'o', 'v', 'v', 'h', 'h', 'v', 'v', 'x', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-20 08:36:56', '2024-12-20 08:36:56'),
(11, 55, 'Freddy', '5 Ton No.5 (DELIVERY L3)', '2', '2024-12-21', '292892', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'h', 'v', 'v', '292930', 'h', 'h', 'v', 'o', 'v', 'v', 'h', 'h', 'v', 'v', 'x', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-21 05:33:48', '2024-12-21 05:33:48'),
(12, 69, 'Freddy', '5 Ton No.3 (EUP)', '1', '2024-12-21', '18587.9', 'x', 'v', 'v', 'v', 'v', 'v', 'v', 'h', 'v', 'v', '18589.4', 'h', 'h', 'v', 'v', 'v', 'v', 'h', 'h', 'v', 'v', 'v', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-21 13:59:54', '2024-12-21 13:59:54'),
(13, 69, 'Freddy', '5 Ton No.3 (EUP)', '2', '2024-12-23', '18599.5', 'x', 'v', 'v', 'v', 'v', 'v', 'v', 'h', 'v', 'x', '18602.4', 'h', 'h', 'v', 'x', 'v', 'v', 'h', 'h', 'v', 'v', 'v', 'Tambahan jok forklift sobek.busa juga sudah keras.', 'Mulyadi & Angga', NULL, NULL, 'Mati', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Kurang pakem', NULL, NULL, NULL, 'Bocor/netes oli hudrolic', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-23 15:48:13', '2024-12-23 15:48:13'),
(14, 55, 'Riyan H', '5 Ton No.5 (DELIVERY L3)', '2', '2024-12-23', '292933', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'h', 'v', 'v', '292967', 'h', 'h', 'v', 'o', 'v', 'v', 'h', 'h', 'v', 'v', 'x', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-24 03:34:21', '2024-12-24 03:34:21'),
(15, 55, 'Riyan H', '5 Ton No.5 (DELIVERY L3)', '2', '2024-12-24', '292967', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'h', 'v', 'v', '292992', 'h', 'h', 'v', 'o', 'v', 'v', 'h', 'h', 'v', 'v', 'x', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-24 08:51:12', '2024-12-24 08:51:12'),
(16, 69, 'Riyan H', '5 Ton No.3 (EUP)', '1', '2024-12-24', '18602.7', 'x', 'v', 'v', 'v', 'v', 'v', 'v', 'h', 'v', 'x', '18607.5', 'h', 'h', 'v', 'x', 'v', 'v', 'h', 'h', 'v', 'v', 'v', NULL, NULL, NULL, NULL, 'Mati', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Kurang pakem', NULL, NULL, NULL, 'Oli hudrolic rembes', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-24 11:37:30', '2024-12-24 11:37:30'),
(17, 55, 'Danu', '5 Ton No.5 (DELIVERY L3)', '2', '2025-01-20', '293959', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'h', 'v', 'v', '293980', 'h', 'h', 'v', 'o', 'v', 'v', 'h', 'h', 'v', 'v', 'x', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-20 08:13:57', '2025-01-20 08:13:57'),
(18, 23, 'Riyan H', '10 Ton', '2', '2025-01-21', '15.333,9', 'v', 'v', 'v', 'v', 'o', 'v', 'v', 'h', 'v', 'v', '15.336,7', 'h', 'h', 'v', 'o', 'v', 'v', 'h', 'h', 'v', 'v', 'v', NULL, 'Mulyadi', NULL, NULL, NULL, NULL, NULL, NULL, 'Kiri mati', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Ada bocor', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-21 07:30:39', '2025-01-21 07:30:39'),
(19, 41, 'Riyan H', '5 Ton No.3 (EUP)', '1', '2025-01-21', '18751.1', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'h', 'v', 'v', '18752.9', 'h', 'h', 'v', 'v', 'v', 'v', 'h', 'h', 'v', 'v', 'v', NULL, NULL, NULL, NULL, 'Kadang bunyi kadang tidak bunyi', 'Kadang bunyi kadang tidak bunyi', NULL, NULL, NULL, NULL, NULL, NULL, 'Kurang pakem', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Ban belakang sudah halus', NULL, NULL, '2025-01-21 07:52:12', '2025-01-21 07:52:12'),
(20, 69, 'Danu', '5 Ton No.3 (EUP)', '2', '2025-01-21', '18753.1', 'x', 'x', 'v', 'v', 'v', 'v', 'v', 'h', 'v', 'v', '18755.4', 'h', 'h', 'v', 'v', 'v', 'v', 'h', 'h', 'x', 'v', 'v', NULL, NULL, NULL, NULL, 'Mati', 'Kadang bunyi kadang gak', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Ban belakang halus', NULL, NULL, '2025-01-21 15:56:20', '2025-01-21 15:56:20'),
(21, 39, 'Panggah S', '5 Ton No.4 (STUFING EXPORT)', '1', '2025-01-21', '8997,9', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'h', 'v', 'v', '9002,6', 'h', 'h', 'v', 'o', 'v', 'v', 'h', 'h', 'v', 'v', NULL, 'Ada rembesan bawah mesin', 'Mulyadi', '8997,9', '8997,9', 'Ok', 'Ok', 'Ok', 'Ok', 'Ok', 'Ok', 'Ok', 'H', 'Ok', 'Ok', 'H', 'H', 'Ok', 'Ada rembesan di mesin', 'Ok', 'Ok', 'H', 'H', 'Ok', 'Ok', NULL, '2025-01-22 01:08:59', '2025-01-22 01:08:59'),
(22, 55, 'Riyan H', '5 Ton No.5 (DELIVERY L3)', '2', '2025-01-21', '293988', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'h', 'v', 'v', '294021', 'h', 'h', 'v', 'o', 'v', 'v', 'h', 'h', 'v', 'v', 'x', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-22 06:55:46', '2025-01-22 06:55:46'),
(23, 23, 'Riyan H', '10 Ton', '2', '2025-01-22', '15.342.4', 'v', 'v', 'v', 'v', 'o', 'v', 'v', 'h', 'v', 'v', '15.343,5', 'h', 'h', 'v', 'o', 'v', 'v', 'h', 'h', 'v', 'v', NULL, NULL, 'Mulyadi', NULL, NULL, NULL, NULL, NULL, NULL, 'Kiri mati', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Ada bocor', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-22 07:46:23', '2025-01-22 07:46:23'),
(24, 23, 'Riyan H', '10 Ton', '2', '2025-01-22', '15.342.4', 'v', 'v', 'v', 'v', 'o', 'v', 'v', 'h', 'v', 'v', '15.343,5', 'h', 'h', 'v', 'o', 'v', 'v', 'h', 'h', 'v', 'v', NULL, NULL, 'Mulyadi', NULL, NULL, NULL, NULL, NULL, NULL, 'Kiri mati', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Ada bocor', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-22 07:46:31', '2025-01-22 07:46:31'),
(25, 23, 'Riyan H', '10 Ton', '2', '2025-01-22', '15.342.4', 'v', 'v', 'v', 'v', 'o', 'v', 'v', 'h', 'v', 'v', '15.343,5', 'h', 'h', 'v', 'o', 'v', 'v', 'h', 'h', 'v', 'v', NULL, NULL, 'Mulyadi', NULL, NULL, NULL, NULL, NULL, NULL, 'Kiri mati', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Ada bocor', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-22 07:48:25', '2025-01-22 07:48:25'),
(26, 41, 'Riyan H', '5 Ton No.3 (EUP)', '1', '2025-01-22', '18755.4', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'h', 'v', 'v', '18760.0', 'h', 'h', 'v', 'v', 'v', 'v', 'h', 'h', 'v', 'v', 'v', NULL, NULL, NULL, NULL, 'Kadang bunyi kadang tidak', 'Kadang bunyi kadang tidak', NULL, NULL, NULL, NULL, NULL, NULL, 'Kurang pakem', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-22 07:58:30', '2025-01-22 07:58:30'),
(27, 55, 'Riyan H', '5 Ton No.5 (DELIVERY L3)', '2', '2025-01-22', '294021', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'h', 'v', 'v', '294055', 'h', 'h', 'v', 'o', 'v', 'v', 'h', 'h', 'v', 'v', 'x', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-22 07:59:53', '2025-01-22 07:59:53'),
(28, 69, 'Danu', '5 Ton No.3 (EUP)', '2', '2025-01-22', '18760.5', 'x', 'x', 'v', 'v', 'v', 'v', 'v', 'h', 'v', 'v', '18764.5', 'h', 'h', 'v', 'v', 'v', 'v', 'h', 'h', 'x', 'v', 'v', 'Jok forklift sudah rusak pak', NULL, NULL, NULL, 'Mati', 'Kadang bunyi kadang gak', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Ban belakang halus', NULL, NULL, '2025-01-22 15:53:23', '2025-01-22 15:53:23'),
(29, 39, 'Panggah S', '5 Ton No.4 (STUFING EXPORT)', '1', '2025-01-23', '9006,8', 'o', 'v', 'v', 'v', 'v', 'v', 'v', 'h', 'v', 'v', '9010,4', 'h', 'h', 'v', 'o', 'v', 'v', 'h', 'h', 'v', 'v', NULL, 'Ada rembesan bawah mesin', 'Mulyadi', '9006,8', '9006,8', 'Ok', 'Ok', 'Ok', 'Ok', 'Ok', 'Ok', 'Ok', 'H', 'Ok', 'Ok', 'H', 'H', 'Ok', 'Ada rembesan di mesin', 'Ok', 'Ok', 'H', 'H', 'Ok', 'Ok', NULL, '2025-01-23 12:05:41', '2025-01-23 12:05:41'),
(30, 69, 'Riyan H', '5 Ton No.3 (EUP)', '2', '2025-01-24', '18766.8', 'x', 'v', 'v', 'v', 'v', 'v', 'v', 'h', 'v', 'v', '18768.8', 'h', 'h', 'v', 'v', 'v', 'v', 'h', 'h', 'x', 'v', 'v', 'Tambahan jok forklift sobek.busa juga sudah keras.', NULL, NULL, NULL, 'Mati', 'Bunyi alarm terlalu kencang.jarak alarm ke telinga tidak ada 50 cm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Ban belakang halus', NULL, NULL, '2025-01-23 17:00:17', '2025-01-23 17:00:17'),
(31, 70, 'Dika', '10 Ton', '2', '2025-01-24', '15354', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'h', 'v', 'v', '15356', 'h', 'h', 'v', 'v', 'v', 'v', 'h', 'h', 'v', 'v', 'v', 'Ok', 'Mulyadi', 'Ok', 'Ok', 'Ok', 'Ok', 'Ok', 'Ok', 'Ok', 'Ok', 'Ok', 'H', 'Ok', 'Ok', 'Ok', 'H', 'Ok', 'Ok', 'Ok', 'Ok', 'H', 'H', 'Ok', 'Ok', 'Ok', '2025-01-24 07:44:02', '2025-01-24 07:44:02'),
(32, 41, 'Dika', '5 Ton No.3 (EUP)', '1', '2025-01-25', '8774.8', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'h', 'v', 'v', '8777.1', 'h', 'h', 'v', 'v', 'v', 'v', 'h', 'h', 'o', 'v', 'v', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Ban belakang sudah halus', NULL, NULL, '2025-01-25 04:32:36', '2025-01-25 04:32:36'),
(33, 70, 'Dika', '10 Ton', '1', '2025-01-29', '15385', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'h', 'v', 'v', '15385', 'h', 'h', 'v', 'v', 'v', 'v', 'h', 'h', 'v', 'v', 'v', 'Ok', 'Dedi', 'Ok', 'Ok', 'Ok', 'Ok', 'Ok', 'Ok', 'Ok', 'Ok', 'Ok', 'H', 'Ok', 'Ok', 'H', 'H', 'Ok', 'Ok', 'Ok', 'Ok', 'H', 'H', 'Ok', 'Ok', 'Ok', '2025-01-28 23:45:42', '2025-01-28 23:45:42'),
(34, 70, 'Dika', '10 Ton', '1', '2025-01-30', '15391', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'h', 'v', 'v', '15392', 'h', 'h', 'v', 'v', 'v', 'v', 'h', 'h', 'v', 'v', 'v', 'Ok', 'Dedi', 'Ok', 'Ok', 'Ok', 'Ok', 'Ok', 'Ok', 'Ok', 'Ok', 'Ok', 'H', 'Ok', 'Ok', 'H', 'H', 'Ok', 'Ok', 'Ok', 'Ok', 'H', 'H', 'Ok', 'Ok', 'Ok', '2025-01-29 23:50:13', '2025-01-29 23:50:13'),
(35, 41, 'Danu', '5 Ton No.3 (EUP)', '2', '2025-01-30', '8798.2', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'h', 'v', 'v', '8802.7', 'h', 'h', 'v', 'v', 'v', 'v', 'h', 'h', 'v', 'v', 'v', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-30 15:37:39', '2025-01-30 15:37:39'),
(36, 39, 'Panggah S', '5 Ton No.4 (STUFING EXPORT)', '1', '2025-01-31', '9041,1', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'h', 'v', 'v', '9044,3', 'h', 'h', 'v', 'o', 'v', 'v', 'h', 'h', 'v', 'v', NULL, 'Ada rembesan bawah mesin', 'Mulyadi', '9041,1', '9041,1', 'Ok', 'Ok', 'Ok', 'Ok', 'Ok', 'Ok', 'Ok', 'H', 'Ok', 'Ok', 'H', 'H', 'Ok', 'Ada rembesan di mesin', 'Ok', 'Ok', 'H', 'H', 'Ok', 'Ok', NULL, '2025-01-31 12:10:25', '2025-01-31 12:10:25'),
(37, 70, 'Dika', '10 Ton', '2', '2025-02-01', '14411', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'h', 'v', 'v', '14413', 'h', 'h', 'v', 'v', 'v', 'v', 'h', 'h', 'v', 'v', 'v', 'Ok', 'Dedi', 'Ok', 'Ok', 'Ok', 'Ok', 'Ok', 'Ok', 'Ok', 'Ok', 'Ok', 'H', 'Ok', 'Ok', 'H', 'H', 'Ok', 'Ok', 'Ok', 'Ok', 'H', 'H', 'Ok', 'Ok', 'Ok', '2025-02-01 07:28:41', '2025-02-01 07:28:41'),
(38, 39, 'Panggah S', '5 Ton No.4 (STUFING EXPORT)', '1', '2025-02-03', '9054,2', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'h', 'v', 'v', '9057,8', 'h', 'h', 'v', 'o', 'v', 'v', 'h', 'h', 'v', 'v', NULL, 'Ada rembesan bawah mesin', 'Mulyadi', '9054,2', '9054,2', 'Ok', 'Ok', 'Ok', 'Ok', 'Ok', 'Ok', 'Ok', 'H', 'Ok', 'Ok', 'H', 'H', 'Ok', 'Ada rembesan di mesin', 'Ok', 'Ok', 'H', 'H', 'Ok', 'Ok', NULL, '2025-02-03 11:46:05', '2025-02-03 11:46:05'),
(39, 55, 'Dika', '5 Ton No.5 (DELIVERY L3)', '2', '2025-02-03', '7.0', 'x', 'v', 'v', 'v', 'v', 'v', 'v', 'h', 'v', 'v', '13.7', 'h', 'h', 'v', 'o', 'v', 'v', 'h', 'h', 'v', 'v', 'x', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-04 03:45:15', '2025-02-04 03:45:15'),
(40, 55, 'Dika', '5 Ton No.5 (DELIVERY L3)', '2', '2025-02-04', '13.7', 'x', 'v', 'v', 'v', 'v', 'v', 'v', 'h', 'v', 'v', '18.7', 'h', 'h', 'v', 'o', 'v', 'v', 'h', 'h', 'v', 'v', 'o', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-04 08:02:54', '2025-02-04 08:02:54'),
(41, 70, 'Dika', '10 Ton', '2', '2025-02-04', '15437', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'h', 'v', 'v', '15438', 'h', 'h', 'v', 'v', 'v', 'v', 'h', 'h', 'v', 'v', 'v', 'Ok', 'Dedi', 'Ok', 'Ok', 'Ok', 'Ok', 'Ok', 'Ok', 'Ok', 'Ok', 'Ok', 'H', 'Ok', 'Ok', 'H', 'H', 'Ok', 'Ok', 'Ok', 'Ok', 'H', 'H', 'Ok', 'Ok', 'Ok', '2025-02-04 15:14:20', '2025-02-04 15:14:20'),
(42, 39, 'Panggah S', '5 Ton No.4 (STUFING EXPORT)', '1', '2025-02-05', '9064,9', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'h', 'v', 'v', '9070,2', 'h', 'h', 'v', 'o', 'v', 'v', 'h', 'h', 'v', 'v', NULL, 'Ada rembesan bawah mesin', 'Mulyadi', '9064,9', '9064,9', 'Ok', 'Ok', 'Ok', 'Ok', 'Ok', 'Ok', 'Ok', 'H', 'Ok', 'Ok', 'H', 'H', 'Ok', 'Ada rembesan bawah mesin', 'Ok', 'Ok', 'H', 'H', 'Ok', 'Ok', NULL, '2025-02-05 13:34:53', '2025-02-05 13:34:53'),
(43, 84, 'Panggah S', '5 Ton No.6 (PACKING EXPORT)', '1', '2025-02-06', '6632.0', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'h', 'v', 'v', '6636.8', 'h', 'h', 'v', 'v', 'v', 'v', 'h', 'h', 'v', 'v', 'v', 'Kondisi baik .cumah mudah anas', 'Pak mulyadi', 'K baik', 'K baik', 'K baik', 'K baik', 'K baik', 'K baik', 'K baik', 'K baik', 'K baik', 'K baik', 'K baik', 'K baik', 'K baik', 'K baik', 'K baik', 'K baik', 'K baik', 'K baik', 'K baik', 'K baik', 'K baik', 'K baik', 'K baik', '2025-02-06 09:03:33', '2025-02-06 09:03:33'),
(44, 101, 'Panggah', '5 Ton No. 3 (EUP)', '1', '2025-05-28', '1080', 'x', 'x', 'x', 'x', 'x', 'x', 'x', 'l', 'x', 'x', '1080', 'l', 'l', 'x', 'x', 'x', 'x', 'l', 'l', 'x', 'x', NULL, NULL, 'vedrsfd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-05-28 13:28:45', '2025-05-28 13:28:45');

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE `group` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hasil_list`
--

CREATE TABLE `hasil_list` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attribute` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` int(11) NOT NULL,
  `uom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `storage_bin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `panjang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kondisi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tujuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ingot`
--

CREATE TABLE `ingot` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `shift_leader` varchar(255) NOT NULL,
  `jalan` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `supplier` json NOT NULL,
  `jenis` varchar(255) DEFAULT NULL,
  `cuaca` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `sesuai` varchar(255) DEFAULT NULL,
  `keterangan1` varchar(255) DEFAULT NULL,
  `kering` varchar(255) DEFAULT NULL,
  `keterangan3` varchar(255) DEFAULT NULL,
  `jumlahin` varchar(255) DEFAULT NULL,
  `keterangan5` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ingot`
--

INSERT INTO `ingot` (`id`, `user_id`, `shift_leader`, `jalan`, `date`, `time`, `supplier`, `jenis`, `cuaca`, `keterangan`, `sesuai`, `keterangan1`, `kering`, `keterangan3`, `jumlahin`, `keterangan5`, `created_at`, `updated_at`) VALUES
(3, 31, 'CSLU2257705', 'Sesuai', '2025-02-02', '22:12:00', '[\"Rio Tinto\"]', 'Alumunium Ingot', 'Cerah', NULL, 'sesuai', NULL, 'Kering/Tidak kena air', NULL, 'Sesuai', NULL, '2025-02-02 16:13:23', '2025-02-02 16:13:23'),
(4, 31, 'TEMU1945054', 'Sesuai', '2025-02-02', '21:13:00', '[\"Rio Tinto\"]', 'Alumunium Ingot', 'Cerah', NULL, 'sesuai', NULL, 'Kering/Tidak kena air', NULL, 'Sesuai', NULL, '2025-02-02 16:14:22', '2025-02-02 16:14:22'),
(5, 31, 'TLLU2634485', 'Sesuai', '2025-02-02', '20:14:00', '[\"Rio Tinto\"]', 'Alumunium Ingot', 'Cerah', NULL, 'sesuai', NULL, 'Kering/Tidak kena air', NULL, 'Sesuai', NULL, '2025-02-02 16:15:05', '2025-02-02 16:15:05'),
(6, 31, 'CSNU1687967', 'Sesuai', '2025-02-02', '22:15:00', '[\"Rio Tinto\"]', 'Alumunium Ingot', 'Cerah', NULL, 'sesuai', NULL, 'Kering/Tidak kena air', NULL, 'Sesuai', NULL, '2025-02-02 16:15:44', '2025-02-02 16:15:44'),
(7, 31, 'TRHU2610927', 'Sesuai', '2025-02-02', '19:16:00', '[\"Rio Tinto\"]', 'Alumunium Ingot', 'Cerah', NULL, 'sesuai', NULL, 'Kering/Tidak kena air', NULL, 'Sesuai', NULL, '2025-02-02 16:16:17', '2025-02-02 16:16:17'),
(8, 31, 'OOLU1770560', 'Sesuai', '2025-02-02', '23:00:00', '[\"Rio Tinto\"]', 'Alumunium Ingot', 'Hujan', NULL, 'sesuai', NULL, 'Kering/Tidak kena air', NULL, 'Sesuai', NULL, '2025-02-02 17:00:41', '2025-02-02 17:00:41'),
(9, 29, 'UETU-229/534', 'Sesuai', '2025-02-02', '11:25:00', '[\"Rio Tinto\"]', 'Alumunium Ingot', 'Cerah', NULL, 'sesuai', NULL, 'Kering/Tidak kena air', NULL, 'Sesuai', NULL, '2025-02-03 04:26:13', '2025-02-03 04:26:13'),
(10, 29, 'TGHU-1845843', 'Sesuai', '2025-02-02', '11:26:00', '[\"Rio Tinto\"]', 'Alumunium Ingot', 'Cerah', NULL, 'sesuai', NULL, 'Kering/Tidak kena air', NULL, 'Sesuai', NULL, '2025-02-03 04:26:50', '2025-02-03 04:26:50'),
(11, 29, 'TCKU - 1006175', 'Sesuai', '2025-02-02', '11:27:00', '[\"Rio Tinto\"]', 'Alumunium Ingot', 'Cerah', NULL, 'sesuai', NULL, 'Kering/Tidak kena air', NULL, 'Sesuai', NULL, '2025-02-03 04:27:41', '2025-02-03 04:27:41');

-- --------------------------------------------------------

--
-- Table structure for table `ingot_image`
--

CREATE TABLE `ingot_image` (
  `id` int(11) NOT NULL,
  `ingot_id` int(11) NOT NULL,
  `foto` json DEFAULT NULL,
  `foto1` json DEFAULT NULL,
  `foto3` json DEFAULT NULL,
  `foto5` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ingot_image`
--

INSERT INTO `ingot_image` (`id`, `ingot_id`, `foto`, `foto1`, `foto3`, `foto5`, `created_at`, `updated_at`) VALUES
(1, 2, '[\"04-11-2024/67287ae826094.png\"]', '[\"04-11-2024/67287ae82916f.png\"]', '[\"04-11-2024/67287ae829eb2.png\"]', NULL, '2024-11-04 07:42:32', '2024-11-04 07:42:32'),
(2, 1, '[\"05-11-2024/6729a0dd1a50f.png\"]', '[\"05-11-2024/6729a0dd21240.png\", \"05-11-2024/6729a0dd2219b.png\"]', '[\"05-11-2024/6729a0dd22a39.png\"]', '[\"05-11-2024/6729a0dd23833.png\"]', '2024-11-05 04:36:45', '2024-11-18 03:50:23'),
(3, 4, NULL, NULL, NULL, NULL, '2024-11-06 04:23:27', '2024-11-06 04:23:27'),
(4, 3, NULL, NULL, NULL, NULL, '2025-02-02 16:13:23', '2025-02-02 16:13:23'),
(5, 4, NULL, NULL, NULL, NULL, '2025-02-02 16:14:22', '2025-02-02 16:14:22'),
(6, 5, NULL, NULL, NULL, NULL, '2025-02-02 16:15:05', '2025-02-02 16:15:05'),
(7, 6, NULL, NULL, NULL, NULL, '2025-02-02 16:15:44', '2025-02-02 16:15:44'),
(8, 7, NULL, NULL, NULL, NULL, '2025-02-02 16:16:18', '2025-02-02 16:16:18'),
(9, 8, NULL, NULL, NULL, NULL, '2025-02-02 17:00:41', '2025-02-02 17:00:41'),
(10, 9, NULL, NULL, NULL, NULL, '2025-02-03 04:26:13', '2025-02-03 04:26:13'),
(11, 10, NULL, NULL, NULL, NULL, '2025-02-03 04:26:50', '2025-02-03 04:26:50'),
(12, 11, NULL, NULL, NULL, NULL, '2025-02-03 04:27:42', '2025-02-03 04:27:42');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kapasitas`
--

CREATE TABLE `kapasitas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `division` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kapasitas`
--

INSERT INTO `kapasitas` (`id`, `name`, `jenis`, `created_at`, `updated_at`, `division`) VALUES
(1, '30 Ton', 'Crane', '2025-05-22 18:45:13', '2025-05-23 09:33:23', 'Warehouse'),
(4, '10 Ton', 'Crane', '2025-05-22 20:27:33', '2025-05-22 20:27:33', 'Warehouse'),
(5, '5 Ton L8 (No. 1)', 'Crane', '2025-05-22 20:28:04', '2025-05-22 20:34:48', 'Warehouse'),
(6, '5 Ton L8 (No.2)', 'Crane', '2025-05-22 20:28:36', '2025-05-22 20:28:36', 'Warehouse'),
(7, '30 Ton Entry (PRD)', 'Crane', '2025-05-22 20:29:23', '2025-05-23 09:29:17', 'Produksi'),
(8, '7,5 Ton Center (PRD)', 'Crane', '2025-05-22 20:29:47', '2025-05-23 09:29:11', 'Produksi'),
(9, '10 Ton POT (PRD)', 'Crane', '2025-05-22 20:30:16', '2025-05-23 09:29:20', 'Produksi'),
(10, '15 Ton APC (PRD)', 'Crane', '2025-05-22 20:30:38', '2025-05-23 09:29:25', 'Produksi'),
(11, '15 Ton Exit (PRD)', 'Crane', '2025-05-22 20:31:00', '2025-05-23 09:29:28', 'Produksi'),
(12, '5 Ton No. 3 (EUP)', 'Forklift', '2025-05-22 20:36:27', '2025-05-23 09:36:17', 'Warehouse'),
(13, '5 Ton No. 3 (EUP)', 'Forklift', '2025-05-22 20:36:28', '2025-05-23 09:36:23', 'Warehouse'),
(14, '5 Ton No. 4 (STUFING EXPORT)', 'Forklift', '2025-05-22 20:36:58', '2025-05-23 09:36:30', 'Warehouse'),
(15, '5 Ton No. 4 (STUFING EXPORT)', 'Forklift', '2025-05-22 20:36:59', '2025-05-23 09:36:36', 'Warehouse'),
(16, '5 Ton No. 5 (DELIVERY L3)', 'Forklift', '2025-05-22 20:37:33', '2025-05-23 09:36:43', 'Warehouse'),
(17, '5 Ton No. 5 (DELIVERY L3)', 'Forklift', '2025-05-22 20:37:33', '2025-05-23 09:36:49', 'Warehouse'),
(18, '5 Ton No. 6 (PACKING EXPORT)', 'Forklift', '2025-05-22 20:38:05', '2025-05-22 20:38:05', 'Warehouse'),
(19, '5 Ton No. 6 (PACKING EXPORT)', 'Forklift', '2025-05-22 20:38:06', '2025-05-22 20:38:06', 'Warehouse'),
(20, '10 Ton', 'Forklift', '2025-05-22 20:38:31', '2025-05-23 09:36:55', 'Warehouse'),
(21, '23 Ton', 'Forklift', '2025-05-22 20:38:32', '2025-05-23 09:37:02', 'Warehouse');

-- --------------------------------------------------------

--
-- Table structure for table `kendaraan`
--

CREATE TABLE `kendaraan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_urut` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date DEFAULT NULL,
  `jam` time DEFAULT NULL,
  `nama_ekspedisi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_mobil` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_kontainer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_mobil_foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_kontainer_foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tujuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_sopir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `helm` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `celana_panjang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `baju_lengan_panjang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sepatu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `masa_berlaku_sim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stnk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `masa_berlaku_stnk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `masa_berlaku_kir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surat_pengantar_ekspedisi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `segel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ket_nama_ekspedisi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_no_mobil` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_no_kontainer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_tujuan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_nama_sopir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_helm` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_celana_panjang` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_baju_lengan_panjang` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_sepatu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_sim` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_masa_berlaku_sim` date DEFAULT NULL,
  `ket_stnk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_masa_berlaku_stnk` date DEFAULT NULL,
  `ket_kir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_masa_berlaku_kir` date DEFAULT NULL,
  `ket_surat_pengantar_ekspedisi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_segel` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kendaraan`
--

INSERT INTO `kendaraan` (`id`, `no_urut`, `tanggal`, `jam`, `nama_ekspedisi`, `no_mobil`, `no_kontainer`, `no_mobil_foto`, `no_kontainer_foto`, `tujuan`, `nama_sopir`, `helm`, `celana_panjang`, `baju_lengan_panjang`, `sepatu`, `sim`, `masa_berlaku_sim`, `stnk`, `masa_berlaku_stnk`, `kir`, `masa_berlaku_kir`, `surat_pengantar_ekspedisi`, `segel`, `ket_nama_ekspedisi`, `ket_no_mobil`, `ket_no_kontainer`, `ket_tujuan`, `ket_nama_sopir`, `ket_helm`, `ket_celana_panjang`, `ket_baju_lengan_panjang`, `ket_sepatu`, `ket_sim`, `ket_masa_berlaku_sim`, `ket_stnk`, `ket_masa_berlaku_stnk`, `ket_kir`, `ket_masa_berlaku_kir`, `ket_surat_pengantar_ekspedisi`, `ket_segel`, `user_id`, `created_at`, `updated_at`) VALUES
(6, '5', '2024-11-22', '08:32:28', 'A', 'B', 'C', 'uploads/zWfHVlZiQWbtzEOmPtA5tLgiDaPDtwc1exlogJeM.jpg', 'uploads/v1gLhntP3l4dTeNDQcZxlnxJTN24L5dBOGMQlfdp.png', 'D', 'E', 'ADA', 'ADA', 'ADA', 'ADA', 'F', 'YA', 'G', 'YA', 'H', 'YA', '1', 'J', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-11-22', NULL, '2024-11-22', NULL, '2024-11-22', NULL, NULL, '94', '2024-11-22 01:33:08', '2024-11-22 01:33:08'),
(7, '1', '2024-12-24', '10:13:18', 'EUROSPEED', 'B9089JK', 'TLLU3287170', NULL, NULL, 'SYDNEY', 'SOHIPIN', 'ADA', 'ADA', 'ADA', 'ADA', '13470011000391', 'YA', '10862543', 'YA', 'JKT405088', 'YA', '6402749790', 'JKTB102796', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2028-12-27', NULL, '2025-08-25', NULL, '2024-12-22', NULL, NULL, '65', '2024-12-24 03:22:44', '2024-12-24 03:22:44'),
(8, '2', '2024-12-24', '10:23:13', 'EUROSPEED', 'B 9824 uem', 'Cslu 1918210', 'uploads/obkfw5DpE2lHw3whuRWa3uuEWWQvxAMCCYtxfpHl.jpg', NULL, 'Sydney', 'Subandi', 'ADA', 'ADA', 'ADA', 'ADA', '25269806000450', 'YA', '11943421', 'YA', 'Jkt 1036526', 'YA', '6402749790 B', 'Jktb102818', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-03-12', NULL, '2025-05-02', 'KiR DALAM PERPANJANG', '2025-01-27', NULL, NULL, '65', '2024-12-24 03:28:55', '2024-12-24 03:28:55'),
(9, '3', '2024-12-24', '10:31:22', 'Eurospped', 'B 9025 JG', 'CSNU1687268', 'uploads/DHYl5zctOuxa5SPIAq93auHsLRFKxxbQKzVxksa8.jpg', NULL, 'Sydney', 'Sulhi', 'ADA', 'ADA', 'ADA', 'ADA', '13470003000440', 'YA', '08005702', 'YA', 'Jkt3993247', 'YA', '6402749790', 'JKTB102796', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2028-07-20', NULL, '2025-03-11', NULL, '2024-12-22', NULL, NULL, '65', '2024-12-24 03:37:52', '2024-12-24 03:37:52'),
(10, '1', '2025-05-15', '20:16:20', 'cina', 'T12345tt', 'CT', 'uploads/rn48kNuhzqhI8KFf7KQmRqEfcVZN31y4W164kVrx.jpg', 'uploads/vFXDtogdSTJsfJ95GVgc7tymNL6mgApxvf0vttWN.jpg', 'cina', 'cina ready to go', 'ADA', 'ADA', 'ADA', 'ADA', '321', 'YA', '321', 'YA', '321', 'YA', 'DOO', 'SEG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-05-15', NULL, '2025-05-15', NULL, '2025-05-22', NULL, NULL, '94', '2025-05-15 13:17:42', '2025-05-15 13:17:42');

-- --------------------------------------------------------

--
-- Table structure for table `kondisi`
--

CREATE TABLE `kondisi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kondisi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kondisi`
--

INSERT INTO `kondisi` (`id`, `kondisi`, `type`, `created_at`, `updated_at`) VALUES
(1, 'BAIK', '[\"PL\", \"SL\", \"L8\"]', '2025-05-22 19:31:09', '2025-05-22 21:13:39'),
(2, 'DAMAGE REALESE QA', '[\"PL\", \"L8\"]', '2025-05-22 19:45:03', '2025-05-22 21:14:22'),
(3, 'TIDAK', '[\"SL\"]', '2025-05-22 20:17:36', '2025-05-22 21:14:16');

-- --------------------------------------------------------

--
-- Table structure for table `mapcoil`
--

CREATE TABLE `mapcoil` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_gs` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `a1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `a2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `a3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `a4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `a5` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `b1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `b2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `b3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `b4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `b5` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `c1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `c2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `c3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `c4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `c5` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `a1_eye` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `a2_eye` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `a3_eye` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `a4_eye` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `a5_eye` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `b1_eye` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `b2_eye` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `b3_eye` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `b4_eye` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `b5_eye` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `c1_eye` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `c2_eye` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `c3_eye` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `c4_eye` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `c5_eye` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `mapcoil`
--

INSERT INTO `mapcoil` (`id`, `no_gs`, `a1`, `a2`, `a3`, `a4`, `a5`, `b1`, `b2`, `b3`, `b4`, `b5`, `c1`, `c2`, `c3`, `c4`, `c5`, `a1_eye`, `a2_eye`, `a3_eye`, `a4_eye`, `a5_eye`, `b1_eye`, `b2_eye`, `b3_eye`, `b4_eye`, `b5_eye`, `c1_eye`, `c2_eye`, `c3_eye`, `c4_eye`, `c5_eye`, `updated_at`, `created_at`) VALUES
(104, 'GSX24-100838', NULL, 'SL24-111033(1) A', 'SL24-111032(2) B', NULL, 'SL24-111030(1) A', NULL, NULL, NULL, NULL, NULL, 'SL24-111030(2) B', 'SL24-111031(2) B', NULL, 'SL24-111031(1) A', 'SL24-111032(1) A', 'null', 'eye_to_sky', 'eye_to_sky', 'null', 'eye_to_sky', 'null', 'null', 'null', 'null', 'null', 'eye_to_sky', 'eye_to_sky', 'null', 'eye_to_sky', 'eye_to_sky', '2024-12-15 22:37:54', '2024-12-15 19:04:53'),
(105, 'GSX24-100839', NULL, 'SL24-111034(2) B', NULL, 'SL24-111033(2) B', NULL, NULL, NULL, NULL, NULL, NULL, 'SL24-111034(1) A', NULL, 'SL24-111035(2) B', NULL, 'SL24-111035(1) A', 'null', 'eye_to_sky', 'null', 'eye_to_sky', 'null', 'null', 'null', 'null', 'null', 'null', 'eye_to_sky', 'null', 'eye_to_sky', 'null', 'eye_to_sky', '2024-12-16 03:42:46', '2024-12-15 19:04:53'),
(106, 'GSX24-100840', NULL, 'SL24-111037(1) A', NULL, 'SL24-111036(1) A', NULL, NULL, NULL, NULL, NULL, NULL, 'SL24-111036(2) B', NULL, 'SL24-111037(2) B', NULL, 'SL24-111038(1) A', 'null', 'eye_to_sky', 'null', 'eye_to_sky', 'null', 'null', 'null', 'null', 'null', 'null', 'eye_to_sky', 'null', 'eye_to_sky', 'null', 'eye_to_sky', '2024-12-15 22:42:37', '2024-12-15 19:04:53'),
(107, 'GSX24-100841', NULL, 'SL24-111039(2) B', NULL, 'SL24-111038(2) B', NULL, NULL, NULL, NULL, NULL, NULL, 'SL24-111039(1) A', NULL, 'SL24-111040(2) B', NULL, 'SL24-111040(1) A', 'null', 'eye_to_sky', 'null', 'eye_to_sky', 'null', 'null', 'null', 'null', 'null', 'null', 'eye_to_sky', 'null', 'eye_to_sky', 'null', 'eye_to_sky', '2024-12-15 22:47:02', '2024-12-15 19:04:53'),
(108, 'GSX24-100842', NULL, 'SL24-111045(1) A', NULL, 'SL24-111042(2) B', NULL, NULL, NULL, NULL, NULL, NULL, 'SL24-111041(1) A', NULL, 'SL24-111041(2) B', NULL, 'SL24-111042(1) A', 'null', 'eye_to_sky', 'null', 'eye_to_sky', 'null', 'null', 'null', 'null', 'null', 'null', 'eye_to_sky', 'null', 'eye_to_sky', 'null', 'eye_to_sky', '2024-12-15 22:50:47', '2024-12-15 19:04:53'),
(109, 'GSX24-100843', NULL, 'SL24-111043(1) A', NULL, 'SL24-111043(2) B', 'SL24-111045(2) B', NULL, NULL, NULL, NULL, NULL, 'SL24-111047(1) A', NULL, 'SL24-111044(2) B', 'SL24-111044(1) A', NULL, 'null', 'eye_to_sky', 'null', 'eye_to_sky', 'eye_to_sky', 'null', 'null', 'null', 'null', 'null', 'eye_to_sky', 'null', 'eye_to_sky', 'eye_to_sky', 'null', '2024-12-15 22:56:56', '2024-12-15 19:04:53'),
(110, 'GSX24-100844', NULL, 'SL24-111076(1) A-B', NULL, 'SL24-111076(2) C', NULL, NULL, NULL, NULL, NULL, NULL, 'SL24-111046(1) A', NULL, 'SL24-111047(2) B', NULL, 'SL24-111046(2) B', 'null', 'eye_to_sky', 'null', 'eye_to_sky', 'null', 'null', 'null', 'null', 'null', 'null', 'eye_to_sky', 'null', 'eye_to_sky', 'null', 'eye_to_sky', '2024-12-16 03:37:16', '2024-12-15 19:04:53'),
(111, 'GSX24-100845', NULL, NULL, NULL, NULL, NULL, 'SL24-111078(2) C', 'SL24-111077(1) A-B', 'SL24-111079(1) A-B', 'SL24-111083(1) A-B', NULL, NULL, NULL, NULL, NULL, NULL, 'null', 'null', 'null', 'null', 'null', 'eye_to_sky', 'eye_to_sky', 'eye_to_sky', 'eye_to_sky', 'null', 'null', 'null', 'null', 'null', 'null', '2024-12-16 03:47:46', '2024-12-15 19:04:53'),
(112, 'GSX24-100846', NULL, NULL, NULL, NULL, NULL, 'SL24-111084(1) A-B', 'SL24-111080(1) A-B', 'SL24-111080(2) C', 'SL24-111078(1) A-B', NULL, NULL, NULL, NULL, NULL, NULL, 'null', 'null', 'null', 'null', 'null', 'eye_to_sky', 'eye_to_sky', 'eye_to_sky', 'eye_to_sky', 'null', 'null', 'null', 'null', 'null', 'null', '2024-12-16 03:54:53', '2024-12-15 19:04:53'),
(113, 'GSX24-100847', NULL, 'SL24-111084(2) C', NULL, 'SL24-111085(1) A-B', NULL, 'SL24-111086(2) C', NULL, NULL, NULL, NULL, NULL, NULL, 'SL24-111091(2) C', NULL, 'SL24-111191(2) B', 'null', 'eye_to_sky', 'null', 'eye_to_sky', 'null', 'eye_to_sky', 'null', 'null', 'null', 'null', 'null', 'null', 'eye_to_sky', 'null', 'eye_to_sky', '2024-12-16 04:16:54', '2024-12-15 19:04:53'),
(114, 'GSX24-100848', NULL, NULL, NULL, NULL, NULL, 'SL24-111088(1) A-B', 'SL24-111087(1) A-B', 'SL24-111087(2) C', 'SL24-111086(1) A-B', NULL, NULL, NULL, NULL, NULL, NULL, 'null', 'null', 'null', 'null', 'null', 'eye_to_sky', 'eye_to_sky', 'eye_to_sky', 'eye_to_sky', 'null', 'null', 'null', 'null', 'null', 'null', '2024-12-16 04:23:58', '2024-12-15 19:04:53'),
(115, 'GSX24-100849', NULL, NULL, NULL, NULL, NULL, 'SL24-111089(2) C', 'SL24-111090(1) A-B', 'SL24-111089(1) A-B', 'SL24-111095(1) A-B', NULL, NULL, NULL, NULL, NULL, NULL, 'null', 'null', 'null', 'null', 'null', 'eye_to_sky', 'eye_to_sky', 'eye_to_sky', 'eye_to_sky', 'null', 'null', 'null', 'null', 'null', 'null', '2024-12-16 04:28:16', '2024-12-15 19:04:53'),
(116, 'GSX24-100850', NULL, 'SL24-111111(1) A-B', NULL, 'SL24-111108(1) A-B', NULL, NULL, NULL, NULL, NULL, NULL, 'SL24-111114(1) A-B', NULL, 'SL24-111193(2) B', NULL, 'SL24-111092(2) C', 'null', 'eye_to_sky', 'null', 'eye_to_sky', 'null', 'null', 'null', 'null', 'null', 'null', 'eye_to_sky', 'null', 'eye_to_sky', 'null', 'eye_to_sky', '2024-12-16 04:35:00', '2024-12-15 19:04:53'),
(117, 'GSX24-100851', NULL, 'SL24-111112(1) A-B', NULL, 'SL24-111109(2) C', NULL, NULL, NULL, NULL, NULL, NULL, 'SL24-111109(1) A-B', NULL, 'SL24-111111(2) C', NULL, 'SL24-111110(1) A-B', 'null', 'eye_to_sky', 'null', 'eye_to_sky', 'null', 'null', 'null', 'null', 'null', 'null', 'eye_to_sky', 'null', 'eye_to_sky', 'null', 'eye_to_sky', '2024-12-16 04:39:56', '2024-12-15 19:04:53'),
(118, 'GSX24-100852', NULL, NULL, NULL, NULL, NULL, 'SL24-111095(2) C', 'SL24-111092(1) A-B', 'SL24-111097(2) C', 'SL24-111097(1) A-B', NULL, NULL, NULL, NULL, NULL, NULL, 'null', 'null', 'null', 'null', 'null', 'eye_to_sky', 'eye_to_sky', 'eye_to_sky', 'eye_to_sky', 'null', 'null', 'null', 'null', 'null', 'null', '2024-12-16 04:44:32', '2024-12-15 19:04:53'),
(119, 'GSX24-100853', NULL, NULL, NULL, NULL, NULL, 'SL24-111100(1) A-B', 'SL24-111099(1) A-B', 'SL24-111098(1) A-B', 'SL24-111099(2) C', NULL, NULL, NULL, NULL, NULL, NULL, 'null', 'null', 'null', 'null', 'null', 'eye_to_sky', 'eye_to_sky', 'eye_to_sky', 'eye_to_sky', 'null', 'null', 'null', 'null', 'null', 'null', '2024-12-24 04:34:26', '2024-12-15 19:04:53'),
(120, 'GSX24-100854', NULL, NULL, NULL, NULL, NULL, 'SL24-111102(1) A-B', 'SL24-111104(1) A-B', 'SL24-111103(1) A-B', 'SL24-111102(2) C', NULL, NULL, NULL, NULL, NULL, NULL, 'null', 'null', 'null', 'null', 'null', 'eye_to_sky', 'eye_to_sky', 'eye_to_sky', 'eye_to_sky', 'null', 'null', 'null', 'null', 'null', 'null', '2024-12-24 08:54:50', '2024-12-15 19:04:53'),
(121, 'GSX24-100855', NULL, NULL, NULL, NULL, NULL, 'SL24-111106(2) C', 'SL24-111105(1) A-B', 'SL24-111104(2) C', 'SL24-111106(1) A-B', NULL, NULL, NULL, NULL, NULL, NULL, 'null', 'null', 'null', 'null', 'null', 'eye_to_sky', 'eye_to_sky', 'eye_to_sky', 'eye_to_sky', 'null', 'null', 'null', 'null', 'null', 'null', '2024-12-24 08:50:08', '2024-12-15 19:04:53'),
(122, 'gsbaruu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-05-28 19:50:12', '2025-05-28 19:50:12');

-- --------------------------------------------------------

--
-- Table structure for table `mapcoiltruck`
--

CREATE TABLE `mapcoiltruck` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_gs` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `a1` text COLLATE utf8mb4_unicode_ci,
  `a2` text COLLATE utf8mb4_unicode_ci,
  `a3` text COLLATE utf8mb4_unicode_ci,
  `a4` text COLLATE utf8mb4_unicode_ci,
  `a5` text COLLATE utf8mb4_unicode_ci,
  `a6` text COLLATE utf8mb4_unicode_ci,
  `a7` text COLLATE utf8mb4_unicode_ci,
  `a8` text COLLATE utf8mb4_unicode_ci,
  `a9` text COLLATE utf8mb4_unicode_ci,
  `a10` text COLLATE utf8mb4_unicode_ci,
  `a11` text COLLATE utf8mb4_unicode_ci,
  `a12` text COLLATE utf8mb4_unicode_ci,
  `b1` text COLLATE utf8mb4_unicode_ci,
  `b2` text COLLATE utf8mb4_unicode_ci,
  `b3` text COLLATE utf8mb4_unicode_ci,
  `b4` text COLLATE utf8mb4_unicode_ci,
  `b5` text COLLATE utf8mb4_unicode_ci,
  `b6` text COLLATE utf8mb4_unicode_ci,
  `b7` text COLLATE utf8mb4_unicode_ci,
  `b8` text COLLATE utf8mb4_unicode_ci,
  `b9` text COLLATE utf8mb4_unicode_ci,
  `b10` text COLLATE utf8mb4_unicode_ci,
  `b11` text COLLATE utf8mb4_unicode_ci,
  `b12` text COLLATE utf8mb4_unicode_ci,
  `c1` text COLLATE utf8mb4_unicode_ci,
  `c2` text COLLATE utf8mb4_unicode_ci,
  `c3` text COLLATE utf8mb4_unicode_ci,
  `c4` text COLLATE utf8mb4_unicode_ci,
  `c5` text COLLATE utf8mb4_unicode_ci,
  `c6` text COLLATE utf8mb4_unicode_ci,
  `c7` text COLLATE utf8mb4_unicode_ci,
  `c8` text COLLATE utf8mb4_unicode_ci,
  `c9` text COLLATE utf8mb4_unicode_ci,
  `c10` text COLLATE utf8mb4_unicode_ci,
  `c11` text COLLATE utf8mb4_unicode_ci,
  `c12` text COLLATE utf8mb4_unicode_ci,
  `a1_eye` text COLLATE utf8mb4_unicode_ci,
  `a2_eye` text COLLATE utf8mb4_unicode_ci,
  `a3_eye` text COLLATE utf8mb4_unicode_ci,
  `a4_eye` text COLLATE utf8mb4_unicode_ci,
  `a5_eye` text COLLATE utf8mb4_unicode_ci,
  `a6_eye` text COLLATE utf8mb4_unicode_ci,
  `a7_eye` text COLLATE utf8mb4_unicode_ci,
  `a8_eye` text COLLATE utf8mb4_unicode_ci,
  `a9_eye` text COLLATE utf8mb4_unicode_ci,
  `a10_eye` text COLLATE utf8mb4_unicode_ci,
  `a11_eye` text COLLATE utf8mb4_unicode_ci,
  `a12_eye` text COLLATE utf8mb4_unicode_ci,
  `b1_eye` text COLLATE utf8mb4_unicode_ci,
  `b2_eye` text COLLATE utf8mb4_unicode_ci,
  `b3_eye` text COLLATE utf8mb4_unicode_ci,
  `b4_eye` text COLLATE utf8mb4_unicode_ci,
  `b5_eye` text COLLATE utf8mb4_unicode_ci,
  `b6_eye` text COLLATE utf8mb4_unicode_ci,
  `b7_eye` text COLLATE utf8mb4_unicode_ci,
  `b8_eye` text COLLATE utf8mb4_unicode_ci,
  `b9_eye` text COLLATE utf8mb4_unicode_ci,
  `b10_eye` text COLLATE utf8mb4_unicode_ci,
  `b11_eye` text COLLATE utf8mb4_unicode_ci,
  `b12_eye` text COLLATE utf8mb4_unicode_ci,
  `c1_eye` text COLLATE utf8mb4_unicode_ci,
  `c2_eye` text COLLATE utf8mb4_unicode_ci,
  `c3_eye` text COLLATE utf8mb4_unicode_ci,
  `c4_eye` text COLLATE utf8mb4_unicode_ci,
  `c5_eye` text COLLATE utf8mb4_unicode_ci,
  `c6_eye` text COLLATE utf8mb4_unicode_ci,
  `c7_eye` text COLLATE utf8mb4_unicode_ci,
  `c8_eye` text COLLATE utf8mb4_unicode_ci,
  `c9_eye` text COLLATE utf8mb4_unicode_ci,
  `c10_eye` text COLLATE utf8mb4_unicode_ci,
  `c11_eye` text COLLATE utf8mb4_unicode_ci,
  `c12_eye` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `mapcoiltruck`
--

INSERT INTO `mapcoiltruck` (`id`, `no_gs`, `a1`, `a2`, `a3`, `a4`, `a5`, `a6`, `a7`, `a8`, `a9`, `a10`, `a11`, `a12`, `b1`, `b2`, `b3`, `b4`, `b5`, `b6`, `b7`, `b8`, `b9`, `b10`, `b11`, `b12`, `c1`, `c2`, `c3`, `c4`, `c5`, `c6`, `c7`, `c8`, `c9`, `c10`, `c11`, `c12`, `a1_eye`, `a2_eye`, `a3_eye`, `a4_eye`, `a5_eye`, `a6_eye`, `a7_eye`, `a8_eye`, `a9_eye`, `a10_eye`, `a11_eye`, `a12_eye`, `b1_eye`, `b2_eye`, `b3_eye`, `b4_eye`, `b5_eye`, `b6_eye`, `b7_eye`, `b8_eye`, `b9_eye`, `b10_eye`, `b11_eye`, `b12_eye`, `c1_eye`, `c2_eye`, `c3_eye`, `c4_eye`, `c5_eye`, `c6_eye`, `c7_eye`, `c8_eye`, `c9_eye`, `c10_eye`, `c11_eye`, `c12_eye`, `created_at`, `updated_at`) VALUES
(104, 'GSX24-100838', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(105, 'GSX24-100839', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(106, 'GSX24-100840', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(107, 'GSX24-100841', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(108, 'GSX24-100842', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(109, 'GSX24-100843', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(110, 'GSX24-100844', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(111, 'GSX24-100845', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(112, 'GSX24-100846', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(113, 'GSX24-100847', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(114, 'GSX24-100848', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(115, 'GSX24-100849', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(116, 'GSX24-100850', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(117, 'GSX24-100851', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(118, 'GSX24-100852', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(119, 'GSX24-100853', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(120, 'GSX24-100854', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(121, 'GSX24-100855', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-15 19:04:53', '2024-12-15 19:04:53'),
(122, 'gsbaruu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-05-28 19:50:12', '2025-05-28 19:50:12');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000001_create_cache_table', 1),
(2, '0001_01_01_000002_create_jobs_table', 1),
(3, '2024_09_09_042125_create_shippmentb_table', 1),
(4, '2024_09_09_044224_create_shippmenta_table', 1),
(5, '2024_09_13_061448_create_shippmentc_table', 1),
(6, '2024_09_13_061455_create_shippmentd_table', 1),
(7, '2024_09_20_013231_create_users_table', 1),
(8, '2024_09_20_075321_create_crane_table', 1),
(9, '2024_09_23_031123_create_forklift_table', 1),
(10, '2024_09_24_021949_create_trailler_table', 1),
(11, '2024_09_24_065656_create_crc_table', 1),
(12, '2024_09_28_040502_create_eup_table', 1),
(13, '2024_10_11_075703_create_packing_table', 1),
(14, '2024_10_17_034527_create_supply_table', 1),
(15, '2024_10_17_080830_create_scan_table', 1),
(19, '2024_10_18_041626_create_datab_table', 2),
(20, '2024_10_23_090552_create_packing_detail_table', 2),
(21, '2024_10_24_082332_create_hasil_list', 2),
(22, '2024_10_30_104612_create_kendaraan_table', 3),
(23, '2024_10_30_105713_create_kendaraan_table', 4),
(24, '2024_11_07_101656_create_scan_layout_m_s_table', 5),
(25, '2024_11_11_135700_create_surat_m_s_table', 6),
(26, '2024_11_15_082557_create_coil_damage_m_s_table', 7),
(27, '2024_11_20_084349_create_packing_l08_m_s_table', 8),
(28, '2024_11_22_154118_create_rekap_m_s_table', 9),
(29, '2025_05_22_210012_create_shift_table', 10),
(30, '2025_05_22_211153_create_team_leader_table', 11),
(31, '2025_05_23_013445_create_kapasitas_table', 12),
(32, '2025_05_23_015418_create_trailler_name_table', 13),
(33, '2025_05_23_021445_create_kondisi_table', 14),
(34, '2025_05_23_160757_add_colmun_divison_to_users_table', 15),
(35, '2025_05_23_162359_add_colmun_divison_to_kapasitas_table', 16),
(36, '2025_05_26_210821_create_division_table', 17),
(37, '2025_05_26_221632_add_type_to_division_table', 18),
(38, '2025_06_02_014435_add_column_division_to_surat_table', 19),
(40, '2025_06_03_190244_create_scheduled_tasks_table', 20);

-- --------------------------------------------------------

--
-- Table structure for table `packing`
--

CREATE TABLE `packing` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gm` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shift_leader` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `operator` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'CRC',
  `shift` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packing`
--

INSERT INTO `packing` (`id`, `gm`, `shift_leader`, `operator`, `jenis`, `shift`, `created_at`, `updated_at`) VALUES
(2, '123', 'Danu', 'ALL', 'ALKALI', '2', '2024-10-30 04:34:36', '2024-10-30 04:34:36'),
(3, '112', 'Riyan H', 'ALL', 'ALKALI', '2', '2024-11-15 08:19:05', '2024-11-15 08:19:05'),
(4, '10040071', 'Riyan H', 'ALL', 'CRC', '1', '2024-11-16 03:53:19', '2024-11-16 03:53:19'),
(5, 'gm123467', 'Freddy', 'ALL', 'CRC', '2', '2024-12-02 04:22:38', '2024-12-02 04:22:38'),
(6, 'Gm12353wt', 'Riyan H', 'ALL', 'CRC', '2', '2024-12-02 04:25:23', '2024-12-02 04:25:23');

-- --------------------------------------------------------

--
-- Table structure for table `packingl08`
--

CREATE TABLE `packingl08` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `attribute` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kondisi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `layout_kontainer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_sales` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packingl08`
--

INSERT INTO `packingl08` (`id`, `attribute`, `kondisi`, `group`, `layout_kontainer`, `no_sales`, `user_id`, `created_at`, `updated_at`) VALUES
(10, 'SL24-111492vdsvd', 'DAMAGE REALESE QA', 'A', 'K11', 'grg4r3', '14', '2021-11-19 19:38:15', '2024-11-19 19:38:15'),
(12, 'SL24-111492132', 'DAMAGE REALESE QA', 'C', 'K11', 'grg4r3', '14', '2023-06-19 19:38:15', '2024-11-19 19:38:15'),
(21, 'CI24-111241', 'BAIK', 'B', 'K1', 'SOX24-24084', '14', '2024-12-19 04:34:21', '2024-12-19 04:34:21'),
(22, 'CI24-111242', 'BAIK', 'LOKAL', 'K1', 'SOX24-24084', '14', '2024-12-19 04:34:57', '2024-12-19 04:34:57'),
(23, 'CI24-111240', 'BAIK', 'A', 'K1', 'SOX24-24084', '14', '2024-12-19 04:35:57', '2024-12-19 04:35:57'),
(24, 'CL24-112722', 'BAIK', 'A', 'K1', 'SOX24-24112', '65', '2024-12-24 04:01:19', '2024-12-24 04:01:19'),
(25, 'CL24-112720', 'BAIK', 'A', 'K1', 'SOX24-24112', '14', '2024-12-24 04:11:33', '2024-12-24 04:11:33'),
(26, 'CL24-112719', 'BAIK', 'A', 'K1', 'SOX24-24112', '65', '2024-12-24 04:35:14', '2024-12-24 04:35:14'),
(27, 'CI24-111233', 'BAIK', 'A', 'K2', 'SOX24-24084', '65', '2024-12-24 04:42:41', '2024-12-24 04:42:41'),
(28, 'CI24-111238', 'BAIK', 'A', 'k1', 'SOX24-24084', '65', '2024-12-24 04:50:11', '2024-12-24 04:50:11'),
(29, 'CI24-111236', 'BAIK', 'LOKAL', 'K2', 'SOX24-24084', '14', '2025-05-28 13:02:56', '2025-05-28 13:02:56');

-- --------------------------------------------------------

--
-- Table structure for table `packing_detail`
--

CREATE TABLE `packing_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gm` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attribute` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `b_label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `b_aktual` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `selisih` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `persentase` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stiker` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `operator` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scanner` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shift` int(11) DEFAULT NULL,
  `shift_leader` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `checks` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packing_detail`
--

INSERT INTO `packing_detail` (`id`, `gm`, `attribute`, `b_label`, `b_aktual`, `selisih`, `persentase`, `stiker`, `keterangan`, `operator`, `scanner`, `shift`, `shift_leader`, `checks`, `created_at`, `updated_at`) VALUES
(51, '12311', 'CR_3B_21-15267', '21805', '21810', '5', '0.02', NULL, NULL, '14', '31', 2, 'Freddy', 1, '2024-12-03 08:32:14', '2024-12-16 01:41:01'),
(52, '12311', 'CR_3B_21-15268', '21925', '22000', '75', '0.34', NULL, NULL, '14', '31', 2, 'Freddy', 1, '2024-12-03 08:32:14', '2024-12-16 01:41:01'),
(53, '12311', 'CR_3B_21-15269', '18780', '18850', '70', '0.37', NULL, NULL, '14', '14', 2, 'Freddy', 1, '2024-12-03 08:32:14', '2024-12-16 01:41:01'),
(54, '12311', 'CR_3B_21-15270', '21915', '20000', '-1915', '-8.74', NULL, NULL, '14', '14', 2, 'Freddy', 1, '2024-12-03 08:32:14', '2024-12-16 01:41:01'),
(55, '12311', 'CR_3B_21-15271', '18920', '20000', '1080', '5.71', NULL, NULL, '14', '14', 2, 'Freddy', 1, '2024-12-03 08:32:14', '2024-12-16 01:41:01'),
(56, '12311', 'CR_3B_21-15272', '21620', '20000', '-1620', '-7.49', NULL, NULL, '14', '14', 2, 'Freddy', 1, '2024-12-03 08:32:14', '2024-12-16 01:41:01'),
(57, '12311', 'CR_3B_21-15273', '18740', '20000', '1260', '6.72', NULL, NULL, '14', '14', 2, 'Freddy', 1, '2024-12-03 08:32:14', '2024-12-16 01:41:01'),
(58, '12311', 'CR_3B_21-15274', '20705', '20000', '-705', '-3.40', NULL, NULL, '14', '14', 2, 'Freddy', 1, '2024-12-03 08:32:14', '2024-12-16 01:41:01'),
(59, '10045406', 'CR_AG_24-30718', '16900', '16915', '15', '0.09', NULL, NULL, '14', '77', 1, 'Riyan H', 1, '2024-12-05 19:44:08', '2024-12-16 01:41:02'),
(60, '10045406', 'CR_AG_24-30728', '22220', '22345', '125', '0.56', NULL, NULL, '14', '77', 1, 'Riyan H', 1, '2024-12-05 19:44:08', '2024-12-16 01:41:02'),
(61, '10045406', 'CR_AG_24-30734', '22350', '22365', '15', '0.07', NULL, NULL, '14', '77', 1, 'Riyan H', 1, '2024-12-05 19:44:08', '2024-12-16 01:41:02'),
(62, '10045406', 'CR_AG_24-30735', '22050', '22095', '45', '0.20', NULL, NULL, '14', '77', 1, 'Riyan H', 1, '2024-12-05 19:44:08', '2024-12-16 01:41:02'),
(63, '10045406', 'CR_AG_24-30654', '20650', '20710', '60', '0.29', NULL, NULL, '14', '77', 1, 'Riyan H', 1, '2024-12-05 19:44:08', '2024-12-16 01:41:02'),
(64, '10045406', 'CR_AG_24-30709', '19650', '19695', '45', '0.23', NULL, NULL, '14', '77', 1, 'Riyan H', 1, '2024-12-05 19:44:08', '2024-12-16 01:41:02'),
(65, '10045406', 'CR_AG_24-30738', '20790', '20835', '45', '0.22', NULL, NULL, '14', '77', 1, 'Riyan H', 1, '2024-12-05 19:44:08', '2024-12-16 01:41:02'),
(66, '10045406', 'CR_AG_24-30758', '19530', '19615', '85', '0.44', NULL, NULL, '14', '77', 1, 'Riyan H', 1, '2024-12-05 19:44:08', '2024-12-16 01:41:02'),
(67, '10045461', 'CR_AG_24-30711', '19760', '19850', '90', '0.46', NULL, NULL, '77', '77', 2, 'Riyan H', 1, '2024-12-05 20:03:47', '2024-12-16 01:41:11'),
(68, '10045461', 'CR_AG_24-30712', '19820', '19855', '35', '0.18', NULL, NULL, '77', '77', 2, 'Riyan H', 1, '2024-12-05 20:03:47', '2024-12-16 01:41:11'),
(69, '10045461', 'CR_AG_24-30714', '21690', '21745', '55', '0.25', NULL, NULL, '77', '67', 2, 'Riyan H', 1, '2024-12-05 20:03:47', '2024-12-16 01:41:11'),
(70, '10045461', 'CR_AG_24-30715', '22300', '22335', '35', '0.16', NULL, NULL, '77', '67', 2, 'Riyan H', 1, '2024-12-05 20:03:47', '2024-12-16 01:41:12'),
(71, '10045461', 'CR_AG_24-30716', '21890', '21940', '50', '0.23', NULL, NULL, '77', '67', 2, 'Riyan H', 1, '2024-12-05 20:03:47', '2024-12-16 01:41:12'),
(72, '10045461', 'CR_AG_24-30717', '21540', '21580', '40', '0.19', NULL, NULL, '77', '67', 2, 'Riyan H', 1, '2024-12-05 20:03:47', '2024-12-16 01:41:12'),
(73, '10045461', 'CR_AG_24-30721', '20600', '20635', '35', '0.17', NULL, NULL, '77', '67', 2, 'Riyan H', 1, '2024-12-05 20:03:47', '2024-12-16 01:41:12'),
(74, '10045461', 'CR_AG_24-30722', '17570', '17585', '15', '0.09', NULL, NULL, '77', '67', 2, 'Riyan H', 1, '2024-12-05 20:03:47', '2024-12-16 01:41:12'),
(75, '10045461', 'CR_AG_24-30723', '22750', '22760', '10', '0.04', NULL, NULL, '77', '67', 2, 'Riyan H', 1, '2024-12-05 20:03:47', '2024-12-16 01:41:12'),
(76, '10045461', 'CR_AG_24-30726', '21860', '21900', '40', '0.18', NULL, NULL, '77', '67', 2, 'Riyan H', 1, '2024-12-05 20:03:47', '2024-12-16 01:41:12'),
(77, '10045461', 'CR_AG_24-30727', '21670', '21695', '25', '0.12', NULL, NULL, '77', '67', 2, 'Riyan H', 1, '2024-12-05 20:03:47', '2024-12-16 01:41:12'),
(78, '10045461', 'CR_AG_24-30730', '21160', '21210', '50', '0.24', NULL, NULL, '77', '67', 2, 'Riyan H', 1, '2024-12-05 20:03:47', '2024-12-16 01:41:12'),
(79, '10045485', 'CR_AG_24-30772', '18510', '18565', '55', '0.30', NULL, NULL, '77', '77', 2, 'Riyan H', 1, '2024-12-05 20:35:15', '2024-12-16 01:41:09'),
(80, '10045485', 'CR_AG_24-30773', '22630', '22685', '55', '0.24', NULL, NULL, '77', '77', 2, 'Riyan H', 1, '2024-12-05 20:35:15', '2024-12-16 01:41:09'),
(81, '10044990', 'CR_AG_24-30725', '22350', '22730', '380', '1.70', NULL, NULL, '77', '77', 2, 'Riyan H', 1, '2024-12-05 20:51:39', '2024-12-16 01:41:15'),
(85, '10045514', 'CR_AG_24-30731', '21040', '21070', '30', '0.14', NULL, NULL, '77', '67', 3, 'Danu', 1, '2024-12-06 01:10:23', '2024-12-16 01:41:17'),
(86, '10045514', 'CR_AG_24-30732', '21210', '21415', '205', '0.97', NULL, 'tonase Lebih 205 kg', '77', '67', 3, 'Danu', 1, '2024-12-06 01:10:23', '2024-12-16 01:41:17'),
(87, '10045514', 'CR_AG_24-30733', '21360', '21390', '30', '0.14', NULL, NULL, '77', '67', 3, 'Danu', 1, '2024-12-06 01:10:23', '2024-12-16 01:41:17'),
(88, '10045514', 'CR_AG_24-30736', '21450', '21470', '20', '0.09', NULL, NULL, '77', '67', 3, 'Danu', 1, '2024-12-06 01:10:23', '2024-12-16 01:41:17'),
(89, '10045514', 'CR_AG_24-30744', '21030', '21065', '35', '0.17', NULL, NULL, '77', '67', 3, 'Danu', 1, '2024-12-06 01:10:23', '2024-12-16 01:41:17'),
(90, '10045514', 'CR_AG_24-30745', '21220', '21220', '0', '0.00', NULL, NULL, '77', '67', 3, 'Danu', 1, '2024-12-06 01:10:23', '2024-12-16 01:41:17'),
(91, '10045514', 'CR_AG_24-30747', '22640', '22685', '45', '0.20', NULL, NULL, '77', '67', 3, 'Danu', 1, '2024-12-06 01:10:23', '2024-12-16 01:41:17'),
(92, '10045514', 'CR_AG_24-30748', '19890', '19905', '15', '0.08', NULL, NULL, '77', '67', 3, 'Danu', 1, '2024-12-06 01:10:23', '2024-12-16 01:41:18'),
(95, '10045517', 'CR_B_24-30739', '20980', '20995', '15', '0.07', NULL, NULL, '67', '67', 3, 'Danu', 1, '2024-12-06 02:04:51', '2024-12-16 01:41:21'),
(96, '10045517', 'CR_B_24-30740', '21910', '21980', '70', '0.32', NULL, NULL, '67', '67', 3, 'Danu', 1, '2024-12-06 02:04:51', '2024-12-16 01:41:21'),
(97, '10045517', 'CR_B_24-30741', '21945', '21990', '45', '0.21', NULL, NULL, '67', '67', 3, 'Danu', 1, '2024-12-06 02:04:51', '2024-12-16 01:41:21'),
(98, '10045517', 'CR_B_24-30742', '23570', '23640', '70', '0.30', NULL, NULL, '67', '67', 3, 'Danu', 1, '2024-12-06 02:04:51', '2024-12-16 01:41:21'),
(99, '10045517', 'CR_B_24-30743', '22135', '22170', '35', '0.16', NULL, NULL, '67', '67', 3, 'Danu', 1, '2024-12-06 02:04:51', '2024-12-16 01:41:21'),
(100, '10045517', 'CR_AG_24-30759', '20230', '20290', '60', '0.30', NULL, NULL, '67', '67', 3, 'Danu', 1, '2024-12-06 02:04:51', '2024-12-16 01:41:21'),
(101, '10045517', 'CR_AG_24-30761', '18670', '18720', '50', '0.27', NULL, NULL, '67', '67', 3, 'Danu', 1, '2024-12-06 02:04:51', '2024-12-16 01:41:21'),
(102, '10045517', 'CR_AG_24-30762', '21450', '21515', '65', '0.30', NULL, NULL, '67', '67', 3, 'Danu', 1, '2024-12-06 02:04:51', '2024-12-16 01:41:21'),
(104, '10045548', 'CR_AG_24-30223', '20570', '20630', '60', '0.29', NULL, NULL, '67', '64', 1, 'Freddy', 1, '2024-12-06 09:27:37', '2024-12-16 01:41:24'),
(105, '10045548', 'CR_AG_24-30680', '21850', '21885', '35', '0.16', NULL, NULL, '67', '64', 1, 'Freddy', 1, '2024-12-06 09:27:37', '2024-12-16 01:41:24'),
(106, '10045548', 'CR_AG_24-30681', '21720', '21785', '65', '0.30', NULL, NULL, '67', '64', 1, 'Freddy', 1, '2024-12-06 09:27:37', '2024-12-16 01:41:24'),
(107, '10045548', 'CR_AG_24-30770', '21800', '21870', '70', '0.32', NULL, NULL, '67', '64', 1, 'Freddy', 1, '2024-12-06 09:27:37', '2024-12-16 01:41:24'),
(108, '10045548', 'CR_AG_24-30765', '21620', '21665', '45', '0.21', NULL, NULL, '67', '67', 1, 'Freddy', 1, '2024-12-06 09:27:37', '2024-12-16 01:41:24'),
(109, '10045548', 'CR_AG_24-30766', '20770', '20825', '55', '0.26', NULL, NULL, '67', '67', 1, 'Freddy', 1, '2024-12-06 09:27:37', '2024-12-16 01:41:24'),
(110, '10045548', 'CR_AG_24-30764', '19580', '19570', '-10', '-0.05', NULL, NULL, '67', '67', 1, 'Freddy', 1, '2024-12-06 09:27:37', '2024-12-16 01:41:25'),
(111, '10045548', 'CR_AG_24-30771', '20690', '20710', '20', '0.10', NULL, NULL, '67', '64', 1, 'Freddy', 1, '2024-12-06 09:27:37', '2024-12-16 01:41:25'),
(112, '10045548', 'CR_AG_24-30763', '21970', '22005', '35', '0.16', NULL, NULL, '67', '67', 1, 'Freddy', 1, '2024-12-06 09:27:37', '2024-12-16 01:41:25'),
(113, '10045576', 'CR_AG_24-30775', '22440', '22520', '80', '0.36', NULL, NULL, '64', '64', 2, 'Dika', 1, '2024-12-06 19:51:29', '2024-12-16 01:41:28'),
(114, '10045576', 'CR_AG_24-30778', '22570', '22645', '75', '0.33', NULL, NULL, '64', '20', 2, 'Dika', 1, '2024-12-06 19:51:29', '2024-12-16 01:41:28'),
(115, '10045576', 'CR_AG_24-30781', '22350', '22430', '80', '0.36', NULL, NULL, '64', '38', 2, 'Dika', 1, '2024-12-06 19:51:29', '2024-12-16 01:41:28'),
(116, '10045577', 'CR_AG_24-30776', '20570', '20590', '20', '0.10', NULL, NULL, '64', '64', 2, 'Dika', 1, '2024-12-06 20:23:36', '2024-12-16 01:41:31'),
(117, '10045577', 'CR_AG_24-30780', '22350', '22400', '50', '0.22', NULL, NULL, '64', '64', 2, 'Dika', 1, '2024-12-06 20:23:36', '2024-12-16 01:41:31'),
(118, '10045577', 'CR_AG_24-30782', '22320', '22380', '60', '0.27', NULL, NULL, '64', '64', 2, 'Dika', 1, '2024-12-06 20:23:36', '2024-12-16 01:41:31'),
(119, '10045577', 'CR_AG_24-30783', '22890', '22925', '35', '0.15', NULL, NULL, '64', '64', 2, 'Dika', 1, '2024-12-06 20:23:36', '2024-12-16 01:41:31'),
(120, '10045582', 'CR_AG_24-30706', '22300', '22355', '55', '0.25', NULL, NULL, '64', '64', 2, 'Dika', NULL, '2024-12-06 21:14:27', '2024-12-06 21:20:41'),
(121, '10045668', 'CR_AG_24-26580', '17920', '17955', '35', '0.20', NULL, NULL, '64', '64', 2, 'Dika', NULL, '2024-12-06 22:58:01', '2024-12-06 23:43:13'),
(122, '10045668', 'CR_AG_24-30098', '19105', '19105', '0', '0.00', NULL, NULL, '64', '64', 2, 'Dika', NULL, '2024-12-06 22:58:01', '2024-12-06 23:51:36'),
(123, '10045668', 'CR_AG_24-30099', '12640', '12640', '0', '0.00', NULL, NULL, '64', '64', 2, 'Dika', NULL, '2024-12-06 22:58:01', '2024-12-06 23:51:24'),
(124, '10045668', 'CR_AG_24-30749', '17610', '17660', '50', '0.28', NULL, NULL, '64', '64', 2, 'Dika', NULL, '2024-12-06 22:58:01', '2024-12-07 01:39:25'),
(125, '10045668', 'CR_AG_24-30750', '16740', '16750', '10', '0.06', NULL, NULL, '64', '20', 2, 'Dika', NULL, '2024-12-06 22:58:01', '2024-12-07 07:15:03'),
(126, '10045668', 'CR_AG_24-30751', '16680', '16715', '35', '0.21', NULL, NULL, '64', '67', 2, 'Dika', NULL, '2024-12-06 22:58:01', '2024-12-07 11:12:01'),
(127, '10045668', 'CR_AG_24-30753', '16510', '16535', '25', '0.15', NULL, NULL, '64', '67', 2, 'Dika', NULL, '2024-12-06 22:58:01', '2024-12-07 11:24:57'),
(128, '10045668', 'CR_AG_24-30756', '17680', '17740', '60', '0.34', NULL, NULL, '64', '20', 2, 'Dika', NULL, '2024-12-06 22:58:01', '2024-12-07 05:10:22'),
(129, '10045668', 'CR_AG_24-30757', '18020', '18080', '60', '0.33', NULL, NULL, '64', '20', 2, 'Dika', NULL, '2024-12-06 22:58:01', '2024-12-07 05:10:10'),
(130, '10045668', 'CR_AG_24-30767', '16930', '16965', '35', '0.21', NULL, NULL, '64', '20', 2, 'Dika', NULL, '2024-12-06 22:58:01', '2024-12-07 07:09:24'),
(131, '10045668', 'CR_AG_24-30768', '16270', '16275', '5', '0.03', NULL, NULL, '64', '67', 2, 'Dika', NULL, '2024-12-06 22:58:01', '2024-12-07 15:25:00'),
(132, '10045668', 'CR_AS_24-30270', '21128', '21240', '112', '0.53', NULL, NULL, '64', '64', 2, 'Dika', NULL, '2024-12-06 22:58:01', '2024-12-06 23:29:25'),
(210, '10045691', 'CR_AG_24-26577', '8085', '8085', '0', '0.00', NULL, NULL, '77', '67', 3, 'Riyan H', NULL, '2024-12-07 05:00:52', '2024-12-07 15:27:07'),
(211, '10045691', 'CR_AS_24-30255', '7025', '7025', '0', '0.00', NULL, NULL, '77', '67', 3, 'Riyan H', NULL, '2024-12-07 05:00:52', '2024-12-07 15:26:44'),
(212, '10045691', 'CR_AS_24-30259', '4390', '4390', '0', '0.00', NULL, NULL, '77', '67', 3, 'Riyan H', NULL, '2024-12-07 05:00:52', '2024-12-07 15:28:30'),
(213, '10045691', 'CR_AG_24-30720', '16420', '16480', '60', '0.37', NULL, NULL, '77', '76', 3, 'Riyan H', NULL, '2024-12-07 05:00:52', '2024-12-07 20:54:05'),
(214, '10045691', 'CR_AG_24-30755', '16570', '16605', '35', '0.21', NULL, NULL, '77', '76', 3, 'Riyan H', NULL, '2024-12-07 05:00:52', '2024-12-07 20:59:00'),
(215, '10045691', 'CR_AG_24-30769', '16890', '16915', '25', '0.15', NULL, NULL, '77', '76', 3, 'Riyan H', NULL, '2024-12-07 05:00:52', '2024-12-07 23:25:33'),
(216, '10045691', 'CR_AG_24-30719', '16420', '16430', '10', '0.06', NULL, NULL, '77', '54', 3, 'Riyan H', NULL, '2024-12-07 05:00:52', '2024-12-08 11:09:18'),
(217, '10045691', 'CR_1AG_23-17414', '13980', '13980', '0', '0.00', NULL, NULL, '77', '54', 3, 'Riyan H', NULL, '2024-12-07 05:00:52', '2024-12-08 09:10:58'),
(218, '10045691', 'CR_AG_24-28508', '5870', '5870', '0', '0.00', NULL, NULL, '77', '54', 3, 'Riyan H', NULL, '2024-12-07 05:00:52', '2024-12-08 09:09:57'),
(219, '10045691', 'CR_AG_23-20047', '17100', '17100', '0', '0.00', NULL, NULL, '77', '38', 3, 'Riyan H', NULL, '2024-12-07 05:00:52', '2024-12-08 05:32:55'),
(220, '10045711', 'CR_AG_24-30786', '19170', '19220', '50', '0.26', NULL, NULL, '76', '38', 2, 'Dika', NULL, '2024-12-07 23:31:03', '2024-12-08 04:58:28'),
(221, '10045711', 'CR_G_24-30787', '17620', '17665', '45', '0.26', NULL, NULL, '76', '54', 2, 'Dika', NULL, '2024-12-07 23:31:03', '2024-12-08 11:24:11'),
(222, '10045711', 'CR_G_24-30788', '17805', '17860', '55', '0.31', NULL, NULL, '76', '54', 2, 'Dika', NULL, '2024-12-07 23:31:03', '2024-12-08 11:45:53'),
(223, '10045711', 'CR_AG_24-30784', '16890', '16950', '60', '0.36', NULL, NULL, '76', '76', 2, 'Dika', NULL, '2024-12-07 23:31:03', '2024-12-08 01:01:07'),
(224, '10045711', 'CR_AG_24-30729', '22630', '22715', '85', '0.38', NULL, NULL, '76', '76', 2, 'Dika', NULL, '2024-12-07 23:31:03', '2024-12-08 01:06:28'),
(225, '10045711', 'CR_AG_24-30760', '22310', '22385', '75', '0.34', NULL, NULL, '76', '76', 2, 'Dika', NULL, '2024-12-07 23:31:03', '2024-12-08 01:44:15'),
(226, '10045711', 'CR_AG_24-30785', '21210', '21295', '85', '0.40', NULL, NULL, '76', '38', 2, 'Dika', NULL, '2024-12-07 23:31:03', '2024-12-08 04:58:47'),
(227, '10045722', 'CR_AG_24-30799', '22070', '22105', '35', '0.16', NULL, NULL, '54', '54', 1, 'Danu', NULL, '2024-12-08 10:42:36', '2024-12-08 10:43:25'),
(228, '10045722', 'CR_AG_24-30800', '20080', '20115', '35', '0.17', NULL, NULL, '54', '31', 1, 'Danu', NULL, '2024-12-08 10:42:36', '2024-12-08 15:21:53'),
(229, '10045725', 'CR_AG_24-30793', '21420', '21465', '45', '0.21', NULL, NULL, '67', '67', 1, 'Danu', NULL, '2024-12-08 15:52:35', '2024-12-08 16:42:06'),
(230, '10045725', 'CR_AG_24-30794', '22550', '22590', '40', '0.18', NULL, NULL, '67', '67', 1, 'Danu', NULL, '2024-12-08 15:52:35', '2024-12-08 16:36:02'),
(231, '10045725', 'CR_AG_24-30806', '22240', '22305', '65', '0.29', NULL, NULL, '67', '76', 1, 'Danu', NULL, '2024-12-08 15:52:35', '2024-12-08 18:41:22'),
(232, '10045726', 'CR_AG_24-30801', '22100', '22180', '80', '0.36', NULL, NULL, '67', '76', 1, 'Danu', NULL, '2024-12-08 16:15:12', '2024-12-08 18:33:55'),
(233, '10045726', 'CR_AG_24-30802', '22420', '22450', '30', '0.13', NULL, NULL, '67', '76', 1, 'Danu', NULL, '2024-12-08 16:15:12', '2024-12-08 18:28:16'),
(234, '10045733', 'CR_AG_24-30803', '21680', '21725', '45', '0.21', NULL, NULL, '76', '76', 2, 'Dika', NULL, '2024-12-08 20:45:42', '2024-12-08 23:18:15'),
(235, '10045733', 'CR_AG_24-30804', '21890', '21965', '75', '0.34', NULL, NULL, '76', '76', 2, 'Dika', NULL, '2024-12-08 20:45:42', '2024-12-08 23:24:32'),
(236, '10045733', 'CR_AG_24-30809', '22020', '22085', '65', '0.30', NULL, NULL, '76', '76', 2, 'Dika', NULL, '2024-12-08 20:45:42', '2024-12-08 20:52:46'),
(237, '10045733', 'CR_AG_24-30808', '22380', '22425', '45', '0.20', NULL, NULL, '76', '76', 2, 'Dika', NULL, '2024-12-08 20:45:42', '2024-12-08 20:58:58'),
(238, '10045741', 'CR_AG_24-30805', '18260', '18315', '55', '0.30', NULL, NULL, '76', '76', 2, 'Dika', NULL, '2024-12-09 00:39:39', '2024-12-09 01:14:04'),
(239, '10045741', 'CR_AG_24-30798', '21280', '21335', '55', '0.26', NULL, NULL, '76', '76', 2, 'Dika', NULL, '2024-12-09 00:39:39', '2024-12-09 01:27:59'),
(240, '10045741', 'CR_AG_24-30774', '16880', '16900', '20', '0.12', NULL, NULL, '76', '20', 2, 'Dika', NULL, '2024-12-09 00:39:39', '2024-12-09 03:59:48'),
(241, '10045741', 'CR_AG_24-30797', '21300', '21325', '25', '0.12', NULL, NULL, '76', '76', 2, 'Dika', NULL, '2024-12-09 00:39:39', '2024-12-09 01:21:36'),
(242, '10045741', 'CR_AG_24-30746', '18310', '18365', '55', '0.30', NULL, NULL, '76', '76', 2, 'Dika', NULL, '2024-12-09 00:39:39', '2024-12-09 01:34:33'),
(243, '10045741', 'CR_AG_24-30807', '22380', '22425', '45', '0.20', NULL, NULL, '76', '20', 2, 'Dika', NULL, '2024-12-09 00:39:39', '2024-12-09 04:00:09'),
(244, '10045744', 'CR_AG_24-30811', '22490', '22570', '80', '0.36', NULL, NULL, '20', '20', 3, 'Riyan H', NULL, '2024-12-09 05:43:36', '2024-12-09 06:17:09'),
(245, '10045744', 'CR_AG_24-30810', '20640', '20700', '60', '0.29', NULL, NULL, '20', '20', 3, 'Riyan H', NULL, '2024-12-09 05:43:36', '2024-12-09 06:12:56'),
(246, '10045745', 'CR_G_24-30813', '21635', '21750', '115', '0.53', NULL, NULL, '38', '38', 3, 'Riyan H', NULL, '2024-12-09 07:22:03', '2024-12-09 07:34:15'),
(247, '10045745', 'CR_G_24-30814', '22165', '22220', '55', '0.25', NULL, NULL, '38', '38', 3, 'Riyan H', NULL, '2024-12-09 07:22:03', '2024-12-09 07:34:47'),
(248, '10045816', 'CR_AG_24-30829', '21060', '21085', '25', '0.12', NULL, NULL, '38', '38', 1, 'Danu', NULL, '2024-12-09 10:08:53', '2024-12-09 10:21:30'),
(249, '10045816', 'CR_AG_24-30828', '22610', '22700', '90', '0.40', NULL, NULL, '38', '38', 1, 'Danu', NULL, '2024-12-09 10:08:53', '2024-12-09 10:17:42'),
(250, '10045816', 'CR_AG_24-30816', '22370', '22450', '80', '0.36', NULL, NULL, '38', '38', 1, 'Danu', NULL, '2024-12-09 10:08:53', '2024-12-09 10:09:35'),
(251, '10045816', 'CR_AG_24-30817', '21420', '21460', '40', '0.19', NULL, NULL, '38', '38', 1, 'Danu', NULL, '2024-12-09 10:08:53', '2024-12-09 10:12:20'),
(261, '10045820', 'CR_AG_24-30830', '21340', '21410', '70', '0.33', NULL, NULL, '38', '67', 1, 'Danu', 1, '2024-12-09 13:12:54', '2024-12-16 01:41:38'),
(262, '10045820', 'CR_AG_24-30831', '21310', '21400', '90', '0.42', NULL, NULL, '38', '38', 1, 'Danu', 1, '2024-12-09 13:12:54', '2024-12-16 01:41:38'),
(263, '10045820', 'CR_AG_24-30821', '21130', '21230', '100', '0.47', NULL, NULL, '38', '38', 1, 'Danu', 1, '2024-12-09 13:12:54', '2024-12-16 01:41:38'),
(264, '10045820', 'CR_AG_24-30822', '21520', '21590', '70', '0.33', NULL, NULL, '38', '67', 1, 'Danu', 1, '2024-12-09 13:12:54', '2024-12-16 01:41:38'),
(265, '10045820', 'CR_AG_24-30823', '22310', '22380', '70', '0.31', NULL, NULL, '38', '38', 1, 'Danu', 1, '2024-12-09 13:12:54', '2024-12-16 01:41:38'),
(266, '10045820', 'CR_AG_24-30815', '22310', '22405', '95', '0.43', NULL, NULL, '38', '38', 1, 'Danu', 1, '2024-12-09 13:12:54', '2024-12-16 01:41:38'),
(267, '10045820', 'CR_AG_24-30818', '21250', '21330', '80', '0.38', NULL, NULL, '38', '38', 1, 'Danu', 1, '2024-12-09 13:12:54', '2024-12-16 01:41:38'),
(271, '10045826', 'CR_AG_24-30834', '19280', '19315', '35', '0.18', NULL, NULL, '67', '78', 3, 'Freddy', 1, '2024-12-09 18:03:37', '2024-12-16 01:41:45'),
(272, '10045826', 'CR_AG_24-30824', '22500', '22520', '20', '0.09', NULL, NULL, '67', '40', 3, 'Freddy', 1, '2024-12-09 18:03:37', '2024-12-16 01:41:45'),
(273, '10045826', 'CR_AG_24-30833', '19760', '19810', '50', '0.25', NULL, NULL, '67', '78', 3, 'Freddy', 1, '2024-12-09 18:03:37', '2024-12-16 01:41:45'),
(274, '10045826', 'CR_AG_24-30826', '20670', '20760', '90', '0.44', NULL, NULL, '67', '78', 3, 'Freddy', 1, '2024-12-09 18:03:37', '2024-12-16 01:41:45'),
(275, '10045826', 'CR_AG_24-30835', '22470', '22525', '55', '0.24', NULL, NULL, '67', '78', 3, 'Freddy', 1, '2024-12-09 18:03:37', '2024-12-16 01:41:45'),
(276, '10045826', 'CR_AG_24-30827', '21730', '21820', '90', '0.41', NULL, NULL, '67', '78', 3, 'Freddy', 1, '2024-12-09 18:03:37', '2024-12-16 01:41:45'),
(277, '10045826', 'CR_AG_24-30832', '22540', '22635', '95', '0.42', NULL, NULL, '67', '78', 3, 'Freddy', 1, '2024-12-09 18:03:37', '2024-12-16 01:41:45'),
(278, '10045826', 'CR_AG_24-30825', '22500', '22535', '35', '0.16', NULL, NULL, '67', '40', 3, 'Freddy', 1, '2024-12-09 18:03:37', '2024-12-16 01:41:45'),
(279, '10045862', 'CR_AG_24-30838', '16850', '16875', '25', '0.15', NULL, NULL, '78', '40', 3, 'Dika', 1, '2024-12-10 01:08:25', '2024-12-16 01:41:41'),
(280, '10045862', 'CR_AG_24-30839', '15600', '15610', '10', '0.06', NULL, NULL, '78', '40', 3, 'Dika', 1, '2024-12-10 01:08:25', '2024-12-16 01:41:41'),
(281, '10045862', 'CR_AG_24-30840', '17700', '17725', '25', '0.14', NULL, NULL, '78', '64', 3, 'Dika', 1, '2024-12-10 01:08:25', '2024-12-16 01:41:41'),
(282, '10045862', 'CR_AG_24-30842', '21690', '21750', '60', '0.28', NULL, NULL, '78', '64', 3, 'Dika', 1, '2024-12-10 01:08:25', '2024-12-16 01:41:41'),
(283, '10045877', 'CR_AG_24-30841', '20260', '20280', '20', '0.10', NULL, NULL, '40', '64', 3, 'Dika', 1, '2024-12-10 02:45:21', '2024-12-16 01:41:48'),
(284, '10045953', 'CR_AG_24-30417', '21680', '21745', '65', '0.30', NULL, NULL, '64', '90', 3, 'Dika', 1, '2024-12-10 07:05:15', '2024-12-16 01:41:52'),
(285, '10045953', 'CR_AG_24-30391', '21700', '21770', '70', '0.32', NULL, NULL, '64', '64', 3, 'Dika', 1, '2024-12-10 07:05:15', '2024-12-16 01:41:52'),
(286, '10045953', 'CR_AG_24-30393', '21700', '21730', '30', '0.14', NULL, NULL, '64', '90', 3, 'Dika', 1, '2024-12-10 07:05:15', '2024-12-16 01:41:53'),
(287, '10045953', 'CR_AG_24-30392', '21700', '21715', '15', '0.07', NULL, NULL, '64', '64', 3, 'Dika', 1, '2024-12-10 07:05:15', '2024-12-16 01:41:53'),
(288, '10045953', 'CR_AG_24-30752', '20990', '21070', '80', '0.38', NULL, NULL, '64', '90', 3, 'Dika', 1, '2024-12-10 07:05:15', '2024-12-16 01:41:53'),
(290, '10045961', 'CR_AG_24-30846', '18170', '18195', '25', '0.14', NULL, NULL, '64', '64', 1, 'Riyan H', 1, '2024-12-10 12:18:05', '2024-12-16 01:41:56'),
(291, '10045984', 'CR_AG_24-30848', '21440', '21505', '65', '0.30', NULL, NULL, '90', '90', 1, 'Riyan H', 1, '2024-12-10 15:56:49', '2024-12-16 01:42:01'),
(293, '10045987', 'CR_AG_24-30854', '20430', '20480', '50', '0.24', NULL, NULL, '78', '78', 2, 'Freddy', 1, '2024-12-10 19:01:57', '2024-12-16 01:42:05'),
(294, '10045997', 'CR_AG_24-30855', '19360', '19380', '20', '0.10', NULL, NULL, '78', '67', 2, 'Freddy', 1, '2024-12-10 19:51:15', '2024-12-16 01:42:09'),
(295, '10045997', 'CR_AG_24-30847', '22450', '22480', '30', '0.13', NULL, NULL, '78', '67', 2, 'Freddy', 1, '2024-12-10 19:51:15', '2024-12-16 01:42:09'),
(296, '10045997', 'CR_AG_24-30849', '19930', '19940', '10', '0.05', NULL, NULL, '78', '78', 2, 'Freddy', 1, '2024-12-10 19:51:15', '2024-12-16 01:42:09'),
(297, '10045997', 'CR_AG_24-30844', '22510', '22575', '65', '0.29', NULL, NULL, '78', '78', 2, 'Freddy', 1, '2024-12-10 19:51:15', '2024-12-16 01:42:09'),
(298, '10045997', 'CR_AG_24-30853', '19890', '19920', '30', '0.15', NULL, NULL, '78', '67', 2, 'Freddy', 1, '2024-12-10 19:51:15', '2024-12-16 01:42:09'),
(299, '10045997', 'CR_AG_24-30852', '20250', '20290', '40', '0.20', NULL, NULL, '78', '78', 2, 'Freddy', 1, '2024-12-10 19:51:15', '2024-12-16 01:42:09'),
(300, '10045997', 'CR_AG_24-30845', '22530', '22545', '15', '0.07', NULL, NULL, '78', '78', 2, 'Freddy', 1, '2024-12-10 19:51:15', '2024-12-16 01:42:09'),
(301, '10046043', 'CR_AG_24-30856', '20710', '20725', '15', '0.07', NULL, NULL, '76', '76', 3, 'Freddy', 1, '2024-12-11 03:00:37', '2024-12-16 01:42:13'),
(302, '10046043', 'CR_AS_24-30271', '21408', '21475', '67', '0.31', NULL, NULL, '76', '76', 3, 'Freddy', 1, '2024-12-11 03:00:37', '2024-12-16 01:42:13'),
(303, '10046045', 'CR_AG_24-30859', '20390', '20400', '10', '0.05', NULL, NULL, '64', '64', 3, 'Riyan H', 1, '2024-12-11 06:50:05', '2024-12-16 01:40:32'),
(304, '10046045', 'CR_AG_24-30860', '20890', '20905', '15', '0.07', NULL, NULL, '64', '64', 3, 'Riyan H', 1, '2024-12-11 06:50:06', '2024-12-16 01:40:32'),
(305, '10046045', 'CR_AG_24-30861', '19920', '19925', '5', '0.03', NULL, NULL, '64', '64', 3, 'Riyan H', 1, '2024-12-11 06:50:06', '2024-12-16 01:40:32'),
(306, '10046075', 'CR_AG_24-30862', '21210', '21235', '25', '0.12', NULL, NULL, '64', '64', 3, 'Riyan H', 1, '2024-12-11 08:05:12', '2024-12-16 01:40:35'),
(307, '10046075', 'CR_AG_24-30863', '22110', '22145', '35', '0.16', NULL, NULL, '64', '64', 3, 'Riyan H', 1, '2024-12-11 08:05:12', '2024-12-16 01:40:35'),
(308, '10046092', 'CR_AG_24-30866', '21950', '21955', '5', '0.02', NULL, NULL, '90', '90', 1, 'Riyan H', 1, '2024-12-11 11:05:03', '2024-12-16 01:40:37'),
(309, '10046093', 'CR_AG_24-30864', '22420', '22485', '65', '0.29', NULL, NULL, '90', '90', 1, 'Riyan H', 1, '2024-12-11 11:44:09', '2024-12-16 01:40:39'),
(310, '10046098', 'CR_AG_24-30869', '20930', '20915', '-15', '-0.07', NULL, NULL, '90', '90', 1, 'Riyan H', 1, '2024-12-11 13:24:57', '2024-12-16 01:40:42'),
(311, '10046098', 'CR_AG_24-30868', '18340', '18350', '10', '0.05', NULL, NULL, '90', '90', 1, 'Riyan H', 1, '2024-12-11 13:24:57', '2024-12-16 01:40:42'),
(312, '10046098', 'CR_AG_24-30867', '21000', '21040', '40', '0.19', NULL, NULL, '90', '90', 1, 'Riyan H', 1, '2024-12-11 13:24:57', '2024-12-16 01:40:42'),
(313, '10046096', 'CR_AG_24-30875', '21510', '21520', '10', '0.05', NULL, NULL, '90', '90', 1, 'Riyan H', 1, '2024-12-11 13:29:05', '2024-12-16 01:40:44'),
(314, '10046096', 'CR_AG_24-30874', '20440', '20460', '20', '0.10', NULL, NULL, '90', '90', 1, 'Riyan H', 1, '2024-12-11 13:29:05', '2024-12-16 01:40:44'),
(315, '10046100', 'CR_AG_24-30879', '17930', '17960', '30', '0.17', NULL, NULL, '90', '90', 1, 'Riyan H', 1, '2024-12-11 15:10:38', '2024-12-16 01:40:46'),
(316, '10046100', 'CR_AG_24-30878', '15440', '15420', '-20', '-0.13', NULL, NULL, '90', '90', 1, 'Riyan H', 1, '2024-12-11 15:10:38', '2024-12-16 01:40:47'),
(317, '10046100', 'CR_AG_24-30880', '20940', '20940', '0', '0.00', NULL, NULL, '90', '90', 1, 'Riyan H', 1, '2024-12-11 15:10:38', '2024-12-16 01:40:47'),
(318, '10046128', 'CR_AG_24-30870', '21590', '21620', '30', '0.14', NULL, NULL, '90', '67', 2, 'Freddy', 1, '2024-12-11 18:01:15', '2024-12-16 01:42:37'),
(319, '10046128', 'CR_AG_24-30873', '20200', '20210', '10', '0.05', NULL, NULL, '90', '90', 2, 'Freddy', 1, '2024-12-11 18:01:15', '2024-12-16 01:42:37'),
(320, '10046128', 'CR_AG_24-30872', '21560', '21565', '5', '0.02', NULL, NULL, '90', '90', 2, 'Freddy', 1, '2024-12-11 18:01:15', '2024-12-16 01:42:37'),
(322, '10046151', 'CR_AG_24-30865', '22800', '22865', '65', '0.29', NULL, NULL, '67', '67', 2, 'Freddy', 1, '2024-12-11 23:46:14', '2024-12-16 01:42:40'),
(323, '10046151', 'CR_AG_24-30871', '20010', '20030', '20', '0.10', NULL, NULL, '67', '67', 2, 'Freddy', 1, '2024-12-11 23:46:14', '2024-12-16 01:42:40'),
(324, '10046183', 'CR_AG_24-30790', '16940', '16950', '10', '0.06', NULL, NULL, '67', '67', 3, 'Freddy', 1, '2024-12-12 04:41:49', '2024-12-16 01:42:55'),
(325, '10046183', 'CR_AG_24-30858', '16860', '16845', '-15', '-0.09', NULL, NULL, '67', '67', 3, 'Freddy', 1, '2024-12-12 04:41:49', '2024-12-16 01:42:55'),
(326, '10046183', 'CR_AG_24-30791', '16260', '16225', '-35', '-0.22', NULL, NULL, '67', '67', 3, 'Freddy', 1, '2024-12-12 04:41:49', '2024-12-16 01:42:55'),
(327, '10046331', 'CR_AG_24-30876', '21000', '21060', '60', '0.29', NULL, NULL, '31', '76', 1, 'Danu', 1, '2024-12-13 08:32:26', '2024-12-16 01:43:18'),
(328, '10046331', 'CR_AG_24-30877', '20940', '20940', '0', '0.00', NULL, NULL, '31', '38', 1, 'Danu', 1, '2024-12-13 08:32:26', '2024-12-16 01:43:18'),
(329, '10046331', 'CR_AG_24-30997', '21210', '21230', '20', '0.09', NULL, NULL, '31', '38', 1, 'Danu', 1, '2024-12-13 08:32:26', '2024-12-16 01:43:18'),
(330, '10046331', 'CR_AG_24-30991', '21260', '21300', '40', '0.19', NULL, NULL, '31', '38', 1, 'Danu', 1, '2024-12-13 08:32:26', '2024-12-16 01:43:18'),
(331, '10046331', 'CR_AG_24-30993', '20430', '20470', '40', '0.20', NULL, NULL, '31', '38', 1, 'Danu', 1, '2024-12-13 08:32:26', '2024-12-16 01:43:18'),
(332, '10046331', 'CR_AG_24-30995', '21450', '21460', '10', '0.05', NULL, NULL, '31', '38', 1, 'Danu', 1, '2024-12-13 08:32:26', '2024-12-16 01:43:18'),
(333, '10046331', 'CR_AG_24-30996', '22240', '22280', '40', '0.18', NULL, NULL, '31', '38', 1, 'Danu', 1, '2024-12-13 08:32:26', '2024-12-16 01:43:18'),
(334, '10046342', 'CR_AG_24-30990', '19190', '19205', '15', '0.08', NULL, NULL, '38', '90', 2, 'Freddy', 1, '2024-12-13 17:46:11', '2024-12-16 01:49:00'),
(335, '10046342', 'CR_AG_24-30998', '21380', '21420', '40', '0.19', NULL, NULL, '38', '90', 2, 'Freddy', 1, '2024-12-13 17:46:11', '2024-12-16 01:49:00'),
(336, '10046342', 'CR_AG_24-30999', '22370', '22405', '35', '0.16', NULL, NULL, '38', '54', 2, 'Freddy', 1, '2024-12-13 17:46:11', '2024-12-16 01:49:01'),
(337, '10046342', 'CR_AG_24-31001', '13000', '13010', '10', '0.08', NULL, NULL, '38', '54', 2, 'Freddy', 1, '2024-12-13 17:46:11', '2024-12-16 01:49:01'),
(338, '10046342', 'CR_AG_24-30992', '19490', '19490', '0', '0.00', NULL, NULL, '38', '54', 2, 'Freddy', 1, '2024-12-13 17:46:11', '2024-12-16 01:49:01'),
(339, '10046342', 'CR_AH_24-30892', '19700', '19710', '10', '0.05', NULL, NULL, '38', '54', 2, 'Freddy', 1, '2024-12-13 17:46:11', '2024-12-16 01:49:01'),
(340, '10046342', 'CR_AH_24-30894', '19480', '19470', '-10', '-0.05', NULL, NULL, '38', '67', 2, 'Freddy', 1, '2024-12-13 17:46:11', '2024-12-16 01:49:01'),
(341, '10046342', 'CR_AH_24-30895', '19440', '19485', '45', '0.23', NULL, NULL, '38', '67', 2, 'Freddy', 1, '2024-12-13 17:46:11', '2024-12-16 01:49:01'),
(342, '10046342', 'CR_AH_24-30910', '19210', '19240', '30', '0.16', NULL, NULL, '38', '67', 2, 'Freddy', 1, '2024-12-13 17:46:11', '2024-12-16 01:49:01'),
(343, '10046353', 'CR_AH_24-30882', '19570', '19580', '10', '0.05', NULL, NULL, '90', '67', 3, 'Freddy', 1, '2024-12-14 01:10:37', '2024-12-16 01:49:48'),
(344, '10046353', 'CR_AH_24-30884', '19650', '19640', '-10', '-0.05', NULL, NULL, '90', '67', 3, 'Freddy', 1, '2024-12-14 01:10:37', '2024-12-16 01:49:48'),
(345, '10046353', 'CR_AH_24-30887', '19630', '19680', '50', '0.25', NULL, NULL, '90', '67', 3, 'Freddy', 1, '2024-12-14 01:10:37', '2024-12-16 01:49:48'),
(346, '10046353', 'CR_AH_24-30888', '19640', '18630', '-1010', '-5.14', NULL, NULL, '90', '67', 3, 'Freddy', 1, '2024-12-14 01:10:37', '2024-12-16 01:49:48'),
(347, '10046353', 'CR_AH_24-30889', '19530', '19525', '-5', '-0.03', NULL, NULL, '90', '67', 3, 'Freddy', 1, '2024-12-14 01:10:37', '2024-12-16 01:49:48'),
(348, '10046353', 'CR_AH_24-30890', '19640', '19710', '70', '0.36', NULL, NULL, '90', '67', 3, 'Freddy', 1, '2024-12-14 01:10:37', '2024-12-16 01:49:48'),
(349, '10046353', 'CR_AH_24-30893', '19740', '19790', '50', '0.25', NULL, NULL, '90', '67', 3, 'Freddy', 1, '2024-12-14 01:10:37', '2024-12-16 01:49:48'),
(350, '10046353', 'CR_AH_24-30896', '19670', '19655', '-15', '-0.08', NULL, NULL, '90', '67', 3, 'Freddy', 1, '2024-12-14 01:10:37', '2024-12-16 01:49:48'),
(351, '10046353', 'CR_AH_24-30897', '19620', '19615', '-5', '-0.03', NULL, NULL, '90', '67', 3, 'Freddy', 1, '2024-12-14 01:10:37', '2024-12-16 01:49:48'),
(352, '10046353', 'CR_AH_24-30898', '19550', '19545', '-5', '-0.03', NULL, NULL, '90', '67', 3, 'Freddy', 1, '2024-12-14 01:10:37', '2024-12-16 01:49:49'),
(353, '10046353', 'CR_AH_24-30899', '19670', '19690', '20', '0.10', NULL, NULL, '90', '67', 3, 'Freddy', 1, '2024-12-14 01:10:37', '2024-12-16 01:49:49'),
(354, '10046353', 'CR_AH_24-30900', '19660', '19680', '20', '0.10', NULL, NULL, '90', '67', 3, 'Freddy', 1, '2024-12-14 01:10:37', '2024-12-16 01:49:49'),
(375, '10046427', 'CR_AH_24-30928', '19610', '19670', '60', '0.31', NULL, NULL, '67', '67', 1, 'Danu', 1, '2024-12-14 10:21:36', '2024-12-16 01:50:33'),
(376, '10046427', 'CR_AH_24-30926', '19570', '19620', '50', '0.26', NULL, NULL, '67', '67', 1, 'Danu', 1, '2024-12-14 10:21:36', '2024-12-16 01:50:33'),
(377, '10046427', 'CR_AH_24-30925', '19460', '19525', '65', '0.33', NULL, NULL, '67', '67', 1, 'Danu', 1, '2024-12-14 10:21:36', '2024-12-16 01:50:33'),
(378, '10046427', 'CR_AH_24-30909', '19590', '19640', '50', '0.26', NULL, NULL, '67', '67', 1, 'Danu', 1, '2024-12-14 10:21:36', '2024-12-16 01:50:33'),
(379, '10046427', 'CR_AH_24-30901', '19630', '19680', '50', '0.25', NULL, NULL, '67', '67', 1, 'Danu', 1, '2024-12-14 10:21:36', '2024-12-16 01:50:33'),
(380, '10046427', 'CR_AH_24-30906', '19650', '19660', '10', '0.05', NULL, NULL, '67', '67', 1, 'Danu', 1, '2024-12-14 10:21:36', '2024-12-16 01:50:33'),
(381, '10046427', 'CR_AH_24-30907', '19540', '19550', '10', '0.05', NULL, NULL, '67', '67', 1, 'Danu', 1, '2024-12-14 10:21:36', '2024-12-16 01:50:33'),
(382, '10046427', 'CR_AH_24-30908', '19650', '19685', '35', '0.18', NULL, NULL, '67', '67', 1, 'Danu', 1, '2024-12-14 10:21:36', '2024-12-16 01:50:33'),
(383, '10046427', 'CR_AH_24-30904', '19580', '19580', '0', '0.00', NULL, NULL, '67', '67', 1, 'Danu', 1, '2024-12-14 10:21:36', '2024-12-16 01:50:33'),
(384, '10046427', 'CR_AH_24-30911', '19590', '19660', '70', '0.36', NULL, NULL, '67', '67', 1, 'Danu', 1, '2024-12-14 10:21:36', '2024-12-16 01:50:33'),
(385, '10046427', 'CR_AH_24-30903', '19670', '19710', '40', '0.20', NULL, NULL, '67', '67', 1, 'Danu', 1, '2024-12-14 10:21:36', '2024-12-16 01:50:33'),
(386, '10046430', 'CR_AH_24-30929', '19620', '19630', '10', '0.05', NULL, NULL, '67', '67', 2, 'Riyan H', 1, '2024-12-14 17:11:44', '2024-12-16 01:54:20'),
(387, '10046430', 'CR_AH_24-30931', '19620', '19635', '15', '0.08', NULL, NULL, '67', '67', 2, 'Riyan H', 1, '2024-12-14 17:11:44', '2024-12-16 01:54:20'),
(388, '10046430', 'CR_AH_24-30932', '19550', '19560', '10', '0.05', NULL, NULL, '67', '67', 2, 'Riyan H', 1, '2024-12-14 17:11:44', '2024-12-16 01:54:21'),
(389, '10046430', 'CR_AH_24-30933', '19590', '19590', '0', '0.00', NULL, NULL, '67', '67', 2, 'Riyan H', 1, '2024-12-14 17:11:44', '2024-12-16 01:54:21'),
(390, '10046430', 'CR_AH_24-30934', '19570', '19545', '-25', '-0.13', NULL, NULL, '67', '67', 2, 'Riyan H', 1, '2024-12-14 17:11:44', '2024-12-16 01:54:21'),
(391, '10046430', 'CR_AH_24-30936', '19560', '19545', '-15', '-0.08', NULL, NULL, '67', '67', 2, 'Riyan H', 1, '2024-12-14 17:11:44', '2024-12-16 01:54:21'),
(392, '10046430', 'CR_AH_24-30937', '19470', '19495', '25', '0.13', NULL, NULL, '67', '67', 2, 'Riyan H', 1, '2024-12-14 17:11:44', '2024-12-16 01:54:21'),
(393, '10046430', 'CR_AH_24-30938', '19430', '19460', '30', '0.15', NULL, NULL, '67', '67', 2, 'Riyan H', 1, '2024-12-14 17:11:44', '2024-12-16 01:54:21'),
(394, '10046430', 'CR_AH_24-30939', '19510', '19520', '10', '0.05', NULL, NULL, '67', '67', 2, 'Riyan H', 1, '2024-12-14 17:11:44', '2024-12-16 01:54:21'),
(395, '10046430', 'CR_AH_24-30941', '19640', '19665', '25', '0.13', NULL, NULL, '67', '67', 2, 'Riyan H', 1, '2024-12-14 17:11:44', '2024-12-16 01:54:21'),
(396, '10046430', 'CR_AH_24-30942', '19560', '19560', '0', '0.00', NULL, NULL, '67', '67', 2, 'Riyan H', 1, '2024-12-14 17:11:44', '2024-12-16 01:54:21'),
(397, '10046430', 'CR_AH_24-30943', '19540', '19545', '5', '0.03', NULL, NULL, '67', '67', 2, 'Riyan H', 1, '2024-12-14 17:11:44', '2024-12-16 01:54:21'),
(403, '10046440', 'CR_AH_24-30945', '19640', '19665', '25', '0.13', NULL, NULL, '67', '67', 3, 'Danu', 1, '2024-12-15 01:28:19', '2024-12-16 01:55:08'),
(404, '10046440', 'CR_AH_24-30946', '19570', '19545', '-25', '-0.13', NULL, NULL, '67', '67', 3, 'Danu', 1, '2024-12-15 01:28:19', '2024-12-16 01:55:08'),
(405, '10046440', 'CR_AH_24-30947', '19580', '19545', '-35', '-0.18', NULL, NULL, '67', '67', 3, 'Danu', 1, '2024-12-15 01:28:19', '2024-12-16 01:55:08'),
(406, '10046440', 'CR_AH_24-30948', '19620', '19605', '-15', '-0.08', NULL, NULL, '67', '67', 3, 'Danu', 1, '2024-12-15 01:28:19', '2024-12-16 01:55:08'),
(407, '10046440', 'CR_AH_24-30949', '19570', '19555', '-15', '-0.08', NULL, NULL, '67', '67', 3, 'Danu', 1, '2024-12-15 01:28:19', '2024-12-16 01:55:08'),
(408, '10046440', 'CR_AH_24-30951', '19580', '19560', '-20', '-0.10', NULL, NULL, '67', '78', 3, 'Danu', 1, '2024-12-15 01:28:19', '2024-12-16 01:55:08'),
(409, '10046440', 'CR_AH_24-30953', '19430', '19410', '-20', '-0.10', NULL, NULL, '67', '78', 3, 'Danu', 1, '2024-12-15 01:28:19', '2024-12-16 01:55:08'),
(410, '10046440', 'CR_AH_24-30955', '19560', '19595', '35', '0.18', NULL, NULL, '67', '78', 3, 'Danu', 1, '2024-12-15 01:28:19', '2024-12-16 01:55:08'),
(411, '10046440', 'CR_AH_24-30957', '19620', '19660', '40', '0.20', NULL, NULL, '67', '78', 3, 'Danu', 1, '2024-12-15 01:28:19', '2024-12-16 01:55:08'),
(412, '10046440', 'CR_AH_24-30960', '19500', '19500', '0', '0.00', NULL, NULL, '67', '78', 3, 'Danu', 1, '2024-12-15 01:28:19', '2024-12-16 01:55:08'),
(413, '10046440', 'CR_AH_24-30962', '19620', '19635', '15', '0.08', NULL, NULL, '67', '78', 3, 'Danu', 1, '2024-12-15 01:28:19', '2024-12-16 01:55:08'),
(414, '10046440', 'CR_AH_24-30954', '19380', '19415', '35', '0.18', NULL, NULL, '67', '78', 3, 'Danu', 1, '2024-12-15 01:28:19', '2024-12-16 01:55:08'),
(415, '10046444', 'CR_AH_24-30973', '19610', '19615', '5', '0.03', NULL, NULL, '78', '78', 1, 'Freddy', 1, '2024-12-15 09:07:21', '2024-12-16 01:56:12'),
(416, '10046444', 'CR_AH_24-30977', '19540', '19615', '75', '0.38', NULL, NULL, '78', '78', 1, 'Freddy', 1, '2024-12-15 09:07:21', '2024-12-16 01:56:12'),
(417, '10046444', 'CR_AH_24-30969', '19650', '19625', '-25', '-0.13', NULL, NULL, '78', '78', 1, 'Freddy', 1, '2024-12-15 09:07:21', '2024-12-16 01:56:12'),
(418, '10046444', 'CR_AH_24-30976', '19570', '19630', '60', '0.31', NULL, NULL, '78', '78', 1, 'Freddy', 1, '2024-12-15 09:07:21', '2024-12-16 01:56:12'),
(419, '10046444', 'CR_AH_24-30972', '19490', '19500', '10', '0.05', NULL, NULL, '78', '78', 1, 'Freddy', 1, '2024-12-15 09:07:21', '2024-12-16 01:56:12'),
(420, '10046444', 'CR_AH_24-30968', '18820', '18850', '30', '0.16', NULL, NULL, '78', '78', 1, 'Freddy', 1, '2024-12-15 09:07:21', '2024-12-16 01:56:12'),
(421, '10046444', 'CR_AH_24-30974', '19490', '19540', '50', '0.26', NULL, NULL, '78', '78', 1, 'Freddy', 1, '2024-12-15 09:07:21', '2024-12-16 01:56:12'),
(422, '10046444', 'CR_AH_24-30966', '19520', '19515', '-5', '-0.03', NULL, NULL, '78', '78', 1, 'Freddy', 1, '2024-12-15 09:07:21', '2024-12-16 01:56:12'),
(423, '10046444', 'CR_AH_24-30975', '19620', '19655', '35', '0.18', NULL, NULL, '78', '78', 1, 'Freddy', 1, '2024-12-15 09:07:21', '2024-12-16 01:56:12'),
(424, '10046444', 'CR_AH_24-30967', '19450', '19485', '35', '0.18', NULL, NULL, '78', '78', 1, 'Freddy', 1, '2024-12-15 09:07:21', '2024-12-16 01:56:12'),
(425, '10046444', 'CR_AH_24-30965', '19620', '19605', '-15', '-0.08', NULL, NULL, '78', '78', 1, 'Freddy', 1, '2024-12-15 09:07:21', '2024-12-16 01:56:12'),
(426, '10046444', 'CR_AH_24-30963', '19530', '19510', '-20', '-0.10', NULL, NULL, '78', '78', 1, 'Freddy', 1, '2024-12-15 09:07:21', '2024-12-16 01:56:12'),
(427, '10046448', 'CR_AH_24-30978', '19480', '19520', '40', '0.21', NULL, NULL, '90', '90', 2, 'Riyan H', 1, '2024-12-15 18:29:47', '2024-12-17 03:29:01'),
(428, '10046448', 'CR_AH_24-30980', '19660', '19665', '5', '0.03', NULL, NULL, '90', '90', 2, 'Riyan H', 1, '2024-12-15 18:29:47', '2024-12-17 03:29:01'),
(430, '10046448', 'CR_AH_24-30922', '19540', '19590', '50', '0.26', NULL, NULL, '90', '90', 2, 'Riyan H', 1, '2024-12-15 18:29:47', '2024-12-17 03:29:01'),
(431, '10046448', 'CR_AH_24-30940', '19640', '19655', '15', '0.08', NULL, NULL, '90', '90', 2, 'Riyan H', 1, '2024-12-15 18:29:47', '2024-12-17 03:29:01'),
(432, '10046448', 'CR_AH_24-30944', '19560', '19620', '60', '0.31', NULL, NULL, '90', '90', 2, 'Riyan H', 1, '2024-12-15 18:29:47', '2024-12-17 03:29:01'),
(433, '10046448', 'CR_AH_24-30950', '19580', '19595', '15', '0.08', NULL, NULL, '90', '90', 2, 'Riyan H', 1, '2024-12-15 18:29:47', '2024-12-17 03:29:01'),
(434, '10046448', 'CR_AH_24-30959', '19070', '19095', '25', '0.13', NULL, NULL, '90', '67', 2, 'Riyan H', 1, '2024-12-15 18:29:47', '2024-12-17 03:29:01'),
(435, '10046448', 'CR_AH_24-30961', '19480', '19490', '10', '0.05', NULL, NULL, '90', '67', 2, 'Riyan H', 1, '2024-12-15 18:29:47', '2024-12-17 03:29:01'),
(436, '10046448', 'CR_AH_24-30964', '19570', '19555', '-15', '-0.08', NULL, NULL, '90', '67', 2, 'Riyan H', 1, '2024-12-15 18:29:47', '2024-12-17 03:29:01'),
(437, '10046448', 'CR_AH_24-30970', '19550', '19565', '15', '0.08', NULL, NULL, '90', '67', 2, 'Riyan H', 1, '2024-12-15 18:29:47', '2024-12-17 03:29:01'),
(438, '10046448', 'CR_AH_24-30971', '19560', '19550', '-10', '-0.05', NULL, NULL, '90', '67', 2, 'Riyan H', 1, '2024-12-15 18:29:47', '2024-12-17 03:29:01'),
(439, '10046459', 'CR_AH_24-30979', '19510', '19515', '5', '0.03', NULL, NULL, '90', '67', 2, 'Riyan H', 1, '2024-12-15 18:42:38', '2024-12-17 03:36:17'),
(440, '10046459', 'CR_AH_24-30912', '19520', '19525', '5', '0.03', NULL, NULL, '90', '90', 2, 'Riyan H', 1, '2024-12-15 18:42:38', '2024-12-17 03:36:17'),
(441, '10046459', 'CR_AH_24-30913', '19600', '19660', '60', '0.31', NULL, NULL, '90', '90', 2, 'Riyan H', 1, '2024-12-15 18:42:38', '2024-12-17 03:36:17'),
(442, '10046459', 'CR_AH_24-30915', '19490', '19535', '45', '0.23', NULL, NULL, '90', '67', 2, 'Riyan H', 1, '2024-12-15 18:42:38', '2024-12-17 03:36:17'),
(443, '10046459', 'CR_AH_24-30917', '19550', '19570', '20', '0.10', NULL, NULL, '90', '67', 2, 'Riyan H', 1, '2024-12-15 18:42:38', '2024-12-17 03:36:17'),
(444, '10046459', 'CR_AH_24-30919', '19580', '19590', '10', '0.05', NULL, NULL, '90', '67', 2, 'Riyan H', 1, '2024-12-15 18:42:38', '2024-12-17 03:36:17'),
(445, '10046459', 'CR_AH_24-30885', '19730', '19740', '10', '0.05', NULL, NULL, '90', '67', 2, 'Riyan H', 1, '2024-12-15 18:42:38', '2024-12-17 03:36:17'),
(446, '10046459', 'CR_AH_24-30886', '19580', '19600', '20', '0.10', NULL, NULL, '90', '67', 2, 'Riyan H', 1, '2024-12-15 18:42:38', '2024-12-17 03:36:18'),
(447, '10046459', 'CR_AG_24-31003', '17590', '17610', '20', '0.11', NULL, NULL, '90', '90', 2, 'Riyan H', 1, '2024-12-15 18:42:38', '2024-12-17 03:36:18'),
(453, '10046548', 'CR_AH_24-30891', '19550', '19545', '-5', '-0.03', NULL, NULL, '67', '67', 3, 'Danu', 1, '2024-12-16 01:29:36', '2024-12-17 03:36:30'),
(454, '10046548', 'CR_AH_24-30905', '19620', '19630', '10', '0.05', NULL, NULL, '67', '67', 3, 'Danu', 1, '2024-12-16 01:29:36', '2024-12-17 03:36:31'),
(455, '10046548', 'CR_AH_24-30916', '19460', '19460', '0', '0.00', NULL, NULL, '67', '67', 3, 'Danu', 1, '2024-12-16 01:29:36', '2024-12-17 03:36:31'),
(456, '10046548', 'CR_AG_24-31000', '19580', '19580', '0', '0.00', NULL, NULL, '67', '24', 3, 'Danu', 1, '2024-12-16 01:29:36', '2024-12-17 03:36:31'),
(457, '10046571', 'CR_AH_24-30881', '19550', '19550', '0', '0.00', NULL, NULL, '67', '67', 3, 'Danu', 1, '2024-12-16 05:52:06', '2024-12-17 03:36:48'),
(458, '10046571', 'CR_AH_24-30883', '19490', '19530', '40', '0.21', NULL, NULL, '67', '24', 3, 'Danu', 1, '2024-12-16 05:52:06', '2024-12-17 03:36:48'),
(459, '10046571', 'CR_AG_24-31019', '20530', '20570', '40', '0.19', NULL, NULL, '67', '24', 3, 'Danu', 1, '2024-12-16 05:52:06', '2024-12-17 03:36:48'),
(460, '10046571', 'CR_AG_24-31020', '14160', '14170', '10', '0.07', NULL, NULL, '67', '24', 3, 'Danu', 1, '2024-12-16 05:52:06', '2024-12-17 03:36:48'),
(461, '10046571', 'CR_AH_24-30902', '19370', '19425', '55', '0.28', NULL, NULL, '67', '24', 3, 'Danu', 1, '2024-12-16 05:52:06', '2024-12-17 03:36:48'),
(462, '10046571', 'CR_AH_24-30927', '19410', '19420', '10', '0.05', NULL, NULL, '67', '24', 3, 'Danu', 1, '2024-12-16 05:52:06', '2024-12-17 03:36:49'),
(463, '10046571', 'CR_AH_24-30952', '19580', '19605', '25', '0.13', NULL, NULL, '67', '24', 3, 'Danu', 1, '2024-12-16 05:52:06', '2024-12-17 03:36:49'),
(464, '10046571', 'CR_AH_24-30956', '19450', '19495', '45', '0.23', NULL, NULL, '67', '24', 3, 'Danu', 1, '2024-12-16 05:52:06', '2024-12-17 03:36:49'),
(477, '10046602', 'CR_AG_24-31029', '21060', '21095', '35', '0.17', NULL, NULL, '76', '76', 2, 'Danu', 1, '2024-12-16 18:00:04', '2024-12-17 03:37:11'),
(478, '10046602', 'CR_AG_24-31030', '22580', '22600', '20', '0.09', NULL, NULL, '76', '76', 2, 'Danu', 1, '2024-12-16 18:00:04', '2024-12-17 03:37:11'),
(479, '10046602', 'CR_AG_24-31031', '19690', '19740', '50', '0.25', NULL, NULL, '76', '76', 2, 'Danu', 1, '2024-12-16 18:00:04', '2024-12-17 03:37:12'),
(480, '10046602', 'CR_AG_24-31032', '18470', '18500', '30', '0.16', NULL, NULL, '76', '76', 2, 'Danu', 1, '2024-12-16 18:00:04', '2024-12-17 03:37:12'),
(481, '10046577', 'CR_AG_24-31021', '20660', '20650', '-10', '-0.05', NULL, NULL, '76', '76', 2, 'Danu', 1, '2024-12-16 19:38:00', '2024-12-17 03:42:34'),
(482, '10046577', 'CR_AG_24-31022', '22490', '22500', '10', '0.04', NULL, NULL, '76', '76', 2, 'Danu', 1, '2024-12-16 19:38:00', '2024-12-17 03:42:34'),
(483, '10046577', 'CR_AG_24-31023', '20590', '20620', '30', '0.15', NULL, NULL, '76', '76', 2, 'Danu', 1, '2024-12-16 19:38:00', '2024-12-17 03:42:34'),
(484, '10046577', 'CR_AG_24-31024', '20880', '20920', '40', '0.19', NULL, NULL, '76', '76', 2, 'Danu', 1, '2024-12-16 19:38:00', '2024-12-17 03:42:34'),
(485, '10046577', 'CR_AG_24-31025', '20690', '20715', '25', '0.12', NULL, NULL, '76', '76', 2, 'Danu', 1, '2024-12-16 19:38:00', '2024-12-17 03:42:34'),
(486, '10046577', 'CR_AG_24-31026', '19100', '19100', '0', '0.00', NULL, NULL, '76', '76', 2, 'Danu', 1, '2024-12-16 19:38:00', '2024-12-17 03:42:34'),
(487, '10046577', 'CR_AG_24-31027', '21930', '21970', '40', '0.18', NULL, NULL, '76', '76', 2, 'Danu', 1, '2024-12-16 19:38:00', '2024-12-17 03:42:34'),
(488, '10046577', 'CR_AG_24-31028', '21270', '21285', '15', '0.07', NULL, NULL, '76', '76', 2, 'Danu', 1, '2024-12-16 19:38:00', '2024-12-17 03:42:34'),
(489, '10046577', 'CR_AH_24-30958', '19540', '19550', '10', '0.05', NULL, NULL, '76', '76', 2, 'Danu', 1, '2024-12-16 19:38:00', '2024-12-17 03:42:34'),
(490, '10046577', 'CR_AH_24-30981', '19420', '19410', '-10', '-0.05', NULL, NULL, '76', '76', 2, 'Danu', 1, '2024-12-16 19:38:00', '2024-12-17 03:42:34'),
(491, '10046577', 'CR_AH_24-31007', '19570', '19595', '25', '0.13', NULL, NULL, '76', '76', 2, 'Danu', 1, '2024-12-16 19:38:00', '2024-12-17 03:42:35'),
(492, '10046577', 'CR_AH_24-31008', '19560', '19610', '50', '0.26', NULL, NULL, '76', '76', 2, 'Danu', 1, '2024-12-16 19:38:00', '2024-12-17 03:42:35'),
(493, '10046694', 'CR_AG_24-31038', '21630', '21690', '60', '0.28', NULL, NULL, '76', '76', 2, 'Danu', 1, '2024-12-16 21:59:07', '2024-12-18 08:23:42'),
(494, '10046694', 'CR_AG_24-31039', '21810', '21875', '65', '0.30', NULL, NULL, '76', '76', 2, 'Danu', 1, '2024-12-16 21:59:07', '2024-12-18 08:23:42'),
(495, '10046694', 'CR_AG_24-31042', '21180', '21185', '5', '0.02', NULL, NULL, '76', '76', 2, 'Danu', 1, '2024-12-16 21:59:07', '2024-12-18 08:23:42'),
(496, '10046694', 'CR_AG_24-31043', '22700', '22730', '30', '0.13', NULL, NULL, '76', '76', 2, 'Danu', 1, '2024-12-16 21:59:07', '2024-12-18 08:23:42'),
(497, '10046694', 'CR_AG_24-31046', '21920', '21955', '35', '0.16', NULL, NULL, '76', '76', 2, 'Danu', 1, '2024-12-16 21:59:07', '2024-12-18 08:23:42'),
(498, '10046694', 'CR_AG_24-31047', '21270', '21305', '35', '0.16', NULL, NULL, '76', '76', 2, 'Danu', 1, '2024-12-16 21:59:07', '2024-12-18 08:23:42'),
(499, '10046694', 'CR_AG_24-31048', '21160', '21185', '25', '0.12', NULL, NULL, '76', '76', 2, 'Danu', 1, '2024-12-16 21:59:07', '2024-12-18 08:23:42'),
(500, '10046694', 'CR_AG_24-31049', '22780', '22790', '10', '0.04', NULL, NULL, '76', '76', 2, 'Danu', 1, '2024-12-16 21:59:07', '2024-12-18 08:23:42'),
(501, '10046694', 'CR_AG_24-31053', '20910', '20950', '40', '0.19', NULL, NULL, '76', '76', 2, 'Danu', 1, '2024-12-16 21:59:07', '2024-12-18 08:23:42'),
(502, '10046694', 'CR_AG_24-31054', '22960', '23005', '45', '0.20', NULL, NULL, '76', '76', 2, 'Danu', 1, '2024-12-16 21:59:07', '2024-12-18 08:23:42'),
(503, '10046694', 'CR_AG_24-31055', '20890', '20960', '70', '0.34', NULL, NULL, '76', '76', 2, 'Danu', 1, '2024-12-16 21:59:07', '2024-12-18 08:23:42'),
(504, '10046694', 'CR_AG_24-31056', '21180', '21215', '35', '0.17', NULL, NULL, '76', '76', 2, 'Danu', 1, '2024-12-16 21:59:07', '2024-12-18 08:23:42'),
(505, '10046712', 'CR_AG_24-31057', '16330', '16355', '25', '0.15', NULL, NULL, '76', '76', 3, 'Dika', 1, '2024-12-17 00:38:18', '2024-12-18 08:29:43'),
(506, '10046712', 'CR_AG_24-31058', '22270', '22335', '65', '0.29', NULL, NULL, '76', '76', 3, 'Dika', 1, '2024-12-17 00:38:18', '2024-12-18 08:29:43'),
(507, '10046712', 'CR_AG_24-31059', '22440', '22450', '10', '0.04', NULL, NULL, '76', '76', 3, 'Dika', 1, '2024-12-17 00:38:18', '2024-12-18 08:29:43'),
(508, '10046712', 'CR_AG_24-31060', '22320', '22355', '35', '0.16', NULL, NULL, '76', '76', 3, 'Dika', 1, '2024-12-17 00:38:18', '2024-12-18 08:29:43'),
(509, '10046712', 'CR_AG_24-31061', '20880', '20905', '25', '0.12', NULL, NULL, '76', '76', 3, 'Dika', 1, '2024-12-17 00:38:18', '2024-12-18 08:29:43'),
(510, '10046712', 'CR_AG_24-31062', '21250', '21260', '10', '0.05', NULL, NULL, '76', '76', 3, 'Dika', 1, '2024-12-17 00:38:18', '2024-12-18 08:29:43'),
(511, '10046712', 'CR_AG_24-31063', '22130', '22135', '5', '0.02', NULL, NULL, '76', '76', 3, 'Dika', 1, '2024-12-17 00:38:18', '2024-12-18 08:29:43'),
(512, '10046712', 'CR_AG_24-31064', '21770', '21815', '45', '0.21', NULL, NULL, '76', '20', 3, 'Dika', 1, '2024-12-17 00:38:18', '2024-12-18 08:29:43'),
(513, '10046712', 'CR_AG_24-31065', '21410', '21480', '70', '0.33', NULL, NULL, '76', '20', 3, 'Dika', 1, '2024-12-17 00:38:18', '2024-12-18 08:29:43'),
(514, '10046712', 'CR_AG_24-31066', '20720', '20780', '60', '0.29', NULL, NULL, '76', '20', 3, 'Dika', 1, '2024-12-17 00:38:18', '2024-12-18 08:29:43'),
(515, '10046712', 'CR_G_24-31010', '22175', '22230', '55', '0.25', NULL, NULL, '76', '20', 3, 'Dika', 1, '2024-12-17 00:38:18', '2024-12-18 08:29:43'),
(516, '10046712', 'CR_G_24-31035', '22760', '22795', '35', '0.15', NULL, NULL, '76', '20', 3, 'Dika', 1, '2024-12-17 00:38:18', '2024-12-18 08:29:43'),
(517, '10046774', 'CR_G_24-31036', '15350', '15350', '0', '0.00', NULL, NULL, '76', '20', 3, 'Dika', 1, '2024-12-17 05:57:08', '2024-12-18 08:29:57');
INSERT INTO `packing_detail` (`id`, `gm`, `attribute`, `b_label`, `b_aktual`, `selisih`, `persentase`, `stiker`, `keterangan`, `operator`, `scanner`, `shift`, `shift_leader`, `checks`, `created_at`, `updated_at`) VALUES
(518, '10046774', 'CR_G_24-31037', '21410', '21450', '40', '0.19', NULL, NULL, '76', '20', 3, 'Dika', 1, '2024-12-17 05:57:08', '2024-12-18 08:29:57'),
(519, '10046804', 'CR_AG_24-31067', '21090', '21085', '-5', '-0.02', NULL, NULL, '76', '20', 1, 'Riyan H', 1, '2024-12-17 10:03:50', '2024-12-18 08:30:19'),
(520, '10046804', 'CR_AG_24-31068', '22820', '22825', '5', '0.02', NULL, NULL, '76', '20', 1, 'Riyan H', 1, '2024-12-17 10:03:50', '2024-12-18 08:30:19'),
(521, '10046804', 'CR_AG_24-31069', '22980', '22955', '-25', '-0.11', NULL, NULL, '76', '64', 1, 'Riyan H', 1, '2024-12-17 10:03:50', '2024-12-18 08:30:19'),
(522, '10046804', 'CR_AG_24-31070', '21310', '21350', '40', '0.19', NULL, NULL, '76', '76', 1, 'Riyan H', 1, '2024-12-17 10:03:50', '2024-12-18 08:30:19'),
(523, '10046804', 'CR_G_24-31071', '21830', '21920', '90', '0.41', NULL, NULL, '76', '64', 1, 'Riyan H', 1, '2024-12-17 10:03:50', '2024-12-18 08:30:19'),
(524, '10046804', 'CR_G_24-31072', '21050', '21080', '30', '0.14', NULL, NULL, '76', '64', 1, 'Riyan H', 1, '2024-12-17 10:03:50', '2024-12-18 08:30:19'),
(525, '10046868', 'CR_AG_24-30837', '21590', '21620', '30', '0.14', NULL, NULL, '20', '64', 2, 'Danu', NULL, '2024-12-17 17:43:03', '2024-12-17 17:54:53'),
(526, '10046868', 'CR_AG_24-31082', '22570', NULL, NULL, NULL, NULL, NULL, '20', NULL, 2, 'Danu', NULL, '2024-12-17 17:43:03', '2024-12-17 17:43:03'),
(527, '10046868', 'CR_AG_24-31040', '21530', '21585', '55', '0.26', NULL, NULL, '20', '76', 2, 'Danu', NULL, '2024-12-17 17:43:03', '2024-12-18 04:12:05'),
(528, '10046868', 'CR_AG_24-31041', '21520', '21515', '-5', '-0.02', NULL, NULL, '20', '76', 2, 'Danu', NULL, '2024-12-17 17:43:03', '2024-12-18 04:17:31'),
(529, '10046868', 'CR_AG_24-31075', '20980', '21045', '65', '0.31', NULL, NULL, '20', '76', 2, 'Danu', NULL, '2024-12-17 17:43:03', '2024-12-18 04:26:00'),
(530, '10046868', 'CR_AG_24-31076', '20350', '20350', '0', '0.00', NULL, NULL, '20', '76', 2, 'Danu', NULL, '2024-12-17 17:43:03', '2024-12-18 04:32:48'),
(531, '10046868', 'CR_AG_24-31077', '21600', '21680', '80', '0.37', NULL, NULL, '20', '76', 2, 'Danu', NULL, '2024-12-17 17:43:03', '2024-12-18 05:29:38'),
(532, '10046868', 'CR_AG_24-31078', '22080', '22100', '20', '0.09', NULL, NULL, '20', '76', 2, 'Danu', NULL, '2024-12-17 17:43:03', '2024-12-18 05:23:02'),
(533, '10046868', 'CR_AG_24-31079', '20360', NULL, NULL, NULL, NULL, NULL, '20', NULL, 2, 'Danu', NULL, '2024-12-17 17:43:03', '2024-12-17 17:43:03'),
(534, '10046950', 'CR_AG_24-31080', '19990', NULL, NULL, NULL, NULL, NULL, '76', NULL, 2, 'Danu', NULL, '2024-12-18 04:17:58', '2024-12-18 04:17:58'),
(535, '10046950', 'CR_AG_24-31081', '22600', NULL, NULL, NULL, NULL, NULL, '76', NULL, 2, 'Danu', NULL, '2024-12-18 04:17:58', '2024-12-18 04:17:58'),
(536, '10046950', 'CR_AG_24-31084', '22200', NULL, NULL, NULL, NULL, NULL, '76', NULL, 2, 'Danu', NULL, '2024-12-18 04:17:58', '2024-12-18 04:17:58'),
(537, '10046950', 'CR_AG_24-31088', '21100', NULL, NULL, NULL, NULL, NULL, '76', NULL, 2, 'Danu', NULL, '2024-12-18 04:17:58', '2024-12-18 04:17:58'),
(538, '10046950', 'CR_AG_24-31089', '21510', NULL, NULL, NULL, NULL, NULL, '76', NULL, 2, 'Danu', NULL, '2024-12-18 04:17:58', '2024-12-18 04:17:58'),
(539, '10046950', 'CR_AG_24-31090', '22390', NULL, NULL, NULL, NULL, NULL, '76', NULL, 2, 'Danu', NULL, '2024-12-18 04:17:58', '2024-12-18 04:17:58'),
(540, '10046950', 'CR_AG_24-31092', '22240', NULL, NULL, NULL, NULL, NULL, '76', NULL, 2, 'Danu', NULL, '2024-12-18 04:17:58', '2024-12-18 04:17:58'),
(541, '10046950', 'CR_AG_24-31093', '22500', NULL, NULL, NULL, NULL, NULL, '76', NULL, 2, 'Danu', NULL, '2024-12-18 04:17:58', '2024-12-18 04:17:58'),
(542, '10046950', 'CR_G_24-31034', '21760', '21840', '80', '0.37', NULL, NULL, '76', '76', 2, 'Danu', NULL, '2024-12-18 04:17:58', '2024-12-18 06:45:18'),
(543, '10046950', 'CR_AG_24-31016', '21170', NULL, NULL, NULL, NULL, NULL, '76', NULL, 2, 'Danu', NULL, '2024-12-18 04:17:58', '2024-12-18 04:17:58'),
(544, '10046950', 'CR_AG_24-31085', '19830', '19805', '-25', '-0.13', NULL, NULL, '76', '76', 2, 'Danu', NULL, '2024-12-18 04:17:58', '2024-12-18 06:44:46'),
(545, '10046950', 'CR_AG_24-27748', '11510', '11535', '25', '0.22', NULL, NULL, '76', '76', 2, 'Danu', NULL, '2024-12-18 04:17:58', '2024-12-18 08:20:54'),
(549, '10047318', 'CR_AG_24-27708', '10415', '10415', '0', '0.00', NULL, NULL, '90', '90', 1, 'Riyan H', NULL, '2024-12-20 17:00:58', '2024-12-20 19:13:09'),
(550, '10047318', 'CR_AG_24-31220', '19810', '19825', '15', '0.08', NULL, NULL, '90', '90', 1, 'Riyan H', NULL, '2024-12-20 17:00:58', '2024-12-20 17:17:45'),
(551, '10047318', 'CR_3A_22-14142', '20460', '20460', '0', '0.00', NULL, NULL, '90', '90', 1, 'Riyan H', NULL, '2024-12-20 17:00:58', '2024-12-20 19:20:42'),
(552, '10047318', 'CR_AG_24-26923', '1190', NULL, NULL, NULL, NULL, NULL, '90', NULL, 1, 'Riyan H', NULL, '2024-12-20 17:00:58', '2024-12-20 17:00:58'),
(553, '10047318', 'CR_AG_24-31050', '22660', '22700', '40', '0.18', NULL, NULL, '90', '90', 1, 'Riyan H', NULL, '2024-12-20 17:00:58', '2024-12-20 17:35:35'),
(554, '10047656', 'CR_G_24-30789', '17905', '17970', '65', '0.36', NULL, NULL, '38', '38', 2, 'Riyan H', 1, '2024-12-24 04:08:47', '2024-12-26 02:39:20'),
(555, '10047656', 'CR_AG_24-30737', '20330', '20335', '5', '0.02', NULL, NULL, '38', '38', 2, 'Riyan H', 1, '2024-12-24 04:08:47', '2024-12-26 02:39:20'),
(556, '10047656', 'CR_B_24-30387', '10200', '10200', '0', '0.00', NULL, NULL, '38', '38', 2, 'Riyan H', 1, '2024-12-24 04:08:47', '2024-12-26 02:39:20'),
(557, '10047656', 'CR_AH_24-30982', '19540', '19540', '0', '0.00', NULL, NULL, '38', '67', 2, 'Riyan H', 1, '2024-12-24 04:08:47', '2024-12-26 02:39:20'),
(558, '10047656', 'CR_AH_24-30983', '19520', '19525', '5', '0.03', NULL, NULL, '38', '67', 2, 'Riyan H', 1, '2024-12-24 04:08:47', '2024-12-26 02:39:20'),
(559, '10047656', 'CR_AH_24-30984', '19530', '19530', '0', '0.00', NULL, NULL, '38', '67', 2, 'Riyan H', 1, '2024-12-24 04:08:47', '2024-12-26 02:39:20'),
(560, '10047656', 'CR_AG_24-31107', '17370', '17395', '25', '0.14', NULL, NULL, '38', '90', 2, 'Riyan H', 1, '2024-12-24 04:08:47', '2024-12-26 02:39:20'),
(561, '10047656', 'CR_AG_24-31108', '17440', '17455', '15', '0.09', NULL, NULL, '38', '90', 2, 'Riyan H', 1, '2024-12-24 04:08:47', '2024-12-26 02:39:21'),
(562, '10047656', 'CR_AG_24-31109', '17490', '17455', '-35', '-0.20', NULL, NULL, '38', '67', 2, 'Riyan H', 1, '2024-12-24 04:08:47', '2024-12-26 02:39:21'),
(563, '10047656', 'CR_AG_24-31150', '17170', '17155', '-15', '-0.09', NULL, NULL, '38', '67', 2, 'Riyan H', 1, '2024-12-24 04:08:47', '2024-12-26 02:39:21'),
(564, '10047656', 'CR_AG_24-31151', '17260', '17225', '-35', '-0.20', NULL, NULL, '38', '67', 2, 'Riyan H', 1, '2024-12-24 04:08:48', '2024-12-26 02:39:21'),
(565, '10047656', 'CR_AG_24-31152', '17270', '17280', '10', '0.06', NULL, NULL, '38', '67', 2, 'Riyan H', 1, '2024-12-24 04:08:48', '2024-12-26 02:39:21'),
(566, '10047789', 'CR_AH_24-30985', '19480', '19470', '-10', '-0.05', NULL, NULL, '90', '67', 2, 'Riyan H', 1, '2024-12-25 01:42:59', '2024-12-26 02:39:38'),
(567, '10047789', 'CR_AH_24-30986', '19530', '19520', '-10', '-0.05', NULL, NULL, '90', '67', 2, 'Riyan H', 1, '2024-12-25 01:43:00', '2024-12-26 02:39:38'),
(568, '10047789', 'CR_AG_24-29824', '8770', '8770', '0', '0.00', NULL, NULL, '90', '67', 2, 'Riyan H', 1, '2024-12-25 01:43:00', '2024-12-26 02:39:38'),
(569, '10047789', 'CR_AG_24-30648', '22550', '22585', '35', '0.16', NULL, NULL, '90', '67', 2, 'Riyan H', 1, '2024-12-25 01:43:00', '2024-12-26 02:39:38'),
(570, '10047789', 'CR_AG_24-30649', '22530', '22560', '30', '0.13', NULL, NULL, '90', '67', 2, 'Riyan H', 1, '2024-12-25 01:43:00', '2024-12-26 02:39:38'),
(571, '10047789', 'CR_AG_24-30625', '21820', '21845', '25', '0.11', NULL, NULL, '90', '67', 2, 'Riyan H', 1, '2024-12-25 01:43:00', '2024-12-26 02:39:38'),
(572, '10047789', 'CR_AG_24-31002', '19510', '19525', '15', '0.08', NULL, NULL, '90', '67', 2, 'Riyan H', 1, '2024-12-25 01:43:00', '2024-12-26 02:39:38'),
(573, '10047789', 'CR_AG_24-31013', '19570', '19535', '-35', '-0.18', NULL, NULL, '90', '67', 2, 'Riyan H', 1, '2024-12-25 01:43:00', '2024-12-26 02:39:38'),
(574, '10047789', 'CR_AG_24-31014', '20470', '20470', '0', '0.00', NULL, NULL, '90', '67', 2, 'Riyan H', 1, '2024-12-25 01:43:00', '2024-12-26 02:39:38'),
(575, '10047789', 'CR_AG_24-30467', '21070', '21135', '65', '0.31', NULL, NULL, '90', '67', 2, 'Riyan H', 1, '2024-12-25 01:43:00', '2024-12-26 02:39:38'),
(578, '10047849', 'CR_AG_24-30468', '21010', '21040', '30', '0.14', NULL, NULL, '67', '67', 3, 'Freddy', 1, '2024-12-25 13:16:17', '2024-12-26 02:34:14'),
(579, '10047849', 'CR_AG_24-31017', '20100', '20070', '-30', '-0.15', NULL, NULL, '67', '67', 3, 'Freddy', 1, '2024-12-25 13:16:18', '2024-12-26 02:34:14'),
(580, '10047849', 'CR_AG_24-31018', '20980', '20950', '-30', '-0.14', NULL, NULL, '67', '67', 3, 'Freddy', 1, '2024-12-25 13:16:18', '2024-12-26 02:34:14'),
(581, '10047849', 'CR_AG_24-31190', '21560', '21590', '30', '0.14', NULL, NULL, '67', '67', 3, 'Freddy', 1, '2024-12-25 13:16:18', '2024-12-26 02:34:14'),
(582, '10047849', 'CR_AG_24-31191', '22110', '22090', '-20', '-0.09', NULL, NULL, '67', '67', 3, 'Freddy', 1, '2024-12-25 13:16:18', '2024-12-26 02:34:14'),
(583, '10047849', 'CR_AG_24-30626', '21990', '22075', '85', '0.39', NULL, NULL, '67', '67', 3, 'Freddy', 1, '2024-12-25 13:16:18', '2024-12-26 02:34:14'),
(584, '10047849', 'CR_AG_24-25657', '18640', '18600', '-40', '-0.21', NULL, NULL, '67', '67', 3, 'Freddy', 1, '2024-12-25 13:16:18', '2024-12-26 02:34:14'),
(585, '10047849', 'CR_AG_24-31219', '21010', '21040', '30', '0.14', NULL, NULL, '67', '67', 3, 'Freddy', 1, '2024-12-25 13:16:18', '2024-12-26 02:34:14'),
(586, '10000790', 'CR_AG_24-31458', '17290', '17330', '40', '0.23', NULL, NULL, '78', '78', 3, 'Freddy', NULL, '2025-01-20 12:59:14', '2025-01-20 13:05:24'),
(587, '10000790', 'CR_AG_25-100317', '17670', NULL, NULL, NULL, NULL, NULL, '78', NULL, 3, 'Freddy', NULL, '2025-01-20 12:59:14', '2025-01-20 12:59:14'),
(588, '10000790', 'CR_AG_25-100364', '16640', NULL, NULL, NULL, NULL, NULL, '78', NULL, 3, 'Freddy', NULL, '2025-01-20 12:59:14', '2025-01-20 12:59:14'),
(589, '10000790', 'CR_AG_25-100365', '22020', NULL, NULL, NULL, NULL, NULL, '78', NULL, 3, 'Freddy', NULL, '2025-01-20 12:59:14', '2025-01-20 12:59:14'),
(590, '10000790', 'CR_AG_25-100366', '22680', NULL, NULL, NULL, NULL, NULL, '78', NULL, 3, 'Freddy', NULL, '2025-01-20 12:59:14', '2025-01-20 12:59:14'),
(591, '10000790', 'CR_AG_25-100367', '21740', NULL, NULL, NULL, NULL, NULL, '78', NULL, 3, 'Freddy', NULL, '2025-01-20 12:59:14', '2025-01-20 12:59:14'),
(592, '10000790', 'CR_AG_25-100368', '22640', NULL, NULL, NULL, NULL, NULL, '78', NULL, 3, 'Freddy', NULL, '2025-01-20 12:59:14', '2025-01-20 12:59:14'),
(593, '10000790', 'CR_AG_25-100369', '21770', NULL, NULL, NULL, NULL, NULL, '78', NULL, 3, 'Freddy', NULL, '2025-01-20 12:59:14', '2025-01-20 12:59:14'),
(594, '10000836', 'CR_AG_25-100100', '17510', '17580', '70', '0.40', NULL, NULL, '90', '43', 2, 'Riyan H', 1, '2025-01-22 00:11:05', '2025-02-04 01:53:01'),
(595, '10000836', 'CR_AG_25-100066', '17490', '17515', '25', '0.14', NULL, NULL, '90', '20', 2, 'Riyan H', 1, '2025-01-22 00:11:05', '2025-02-04 01:53:01'),
(596, '10000836', 'CR_AG_25-100065', '17690', '17710', '20', '0.11', NULL, NULL, '90', '90', 2, 'Riyan H', 1, '2025-01-22 00:11:05', '2025-02-04 01:53:01'),
(597, '10000836', 'CR_AG_25-100074', '17660', '17695', '35', '0.20', NULL, NULL, '90', '43', 2, 'Riyan H', 1, '2025-01-22 00:11:05', '2025-02-04 01:53:01'),
(598, '10000836', 'CR_AG_25-100099', '17610', '17600', '-10', '-0.06', NULL, NULL, '90', '43', 2, 'Riyan H', 1, '2025-01-22 00:11:05', '2025-02-04 01:53:01'),
(599, '10000853', 'CR_AG_25-100050', '17900', '17890', '-10', '-0.06', NULL, NULL, '73', '73', 3, 'Danu', 1, '2025-01-22 08:45:32', '2025-01-25 04:16:01'),
(600, '10000853', 'CR_AG_25-100110', '17490', '17480', '-10', '-0.06', NULL, NULL, '73', '73', 3, 'Danu', 1, '2025-01-22 08:45:32', '2025-01-25 04:16:01'),
(601, '10000853', 'CR_AG_24-31460', '13740', '13740', '0', '0.00', NULL, 'CRC SISA', '73', '73', 3, 'Danu', 1, '2025-01-22 08:45:32', '2025-01-25 04:16:01'),
(602, '10000853', 'CR_AG_25-100164', '4415', '4415', '0', '0.00', NULL, 'CRC SISA', '73', '73', 3, 'Danu', 1, '2025-01-22 08:45:32', '2025-01-25 04:16:01'),
(603, '10000853', 'CR_AG_24-31052', '22560', '22565', '5', '0.02', NULL, NULL, '73', '54', 3, 'Danu', 1, '2025-01-22 08:45:32', '2025-01-25 04:16:01'),
(604, '10000853', 'CR_AG_24-30597', '21900', '21900', '0', '0.00', NULL, NULL, '73', '54', 3, 'Danu', 1, '2025-01-22 08:45:32', '2025-01-25 04:16:01'),
(605, '10000853', 'CR_AG_25-100407', '22570', '22585', '15', '0.07', NULL, NULL, '73', '43', 3, 'Danu', 1, '2025-01-22 08:45:32', '2025-01-25 04:16:01'),
(606, '10000853', 'CR_AG_25-100294', '20870', '20915', '45', '0.22', NULL, NULL, '73', '43', 3, 'Danu', 1, '2025-01-22 08:45:32', '2025-01-25 04:16:01'),
(607, '10000853', 'CR_AG_25-100295', '21040', '21055', '15', '0.07', NULL, NULL, '73', '24', 3, 'Danu', 1, '2025-01-22 08:45:32', '2025-01-25 04:16:01'),
(608, '10000853', 'CR_AG_25-100296', '20830', '20865', '35', '0.17', NULL, NULL, '73', '24', 3, 'Danu', 1, '2025-01-22 08:45:32', '2025-01-25 04:16:01'),
(609, '10000864', 'CR_AG_25-100297', '20820', '20830', '10', '0.05', NULL, NULL, '43', '43', 1, 'Freddy', 1, '2025-01-22 16:16:41', '2025-01-25 04:17:29'),
(610, '10000864', 'CR_AG_25-100298', '20510', '20570', '60', '0.29', NULL, NULL, '43', '43', 1, 'Freddy', 1, '2025-01-22 16:16:41', '2025-01-25 04:17:29'),
(611, '10000864', 'CR_AG_25-100299', '20730', '20730', '0', '0.00', NULL, NULL, '43', '43', 1, 'Freddy', 1, '2025-01-22 16:16:41', '2025-01-25 04:17:29'),
(612, '10000864', 'CR_AG_25-100302', '21160', '21160', '0', '0.00', NULL, NULL, '43', '43', 1, 'Freddy', 1, '2025-01-22 16:16:41', '2025-01-25 04:17:29'),
(613, '10000864', 'CR_AG_25-100303', '20800', '20780', '-20', '-0.10', NULL, NULL, '43', '76', 1, 'Freddy', 1, '2025-01-22 16:16:41', '2025-01-25 04:17:29'),
(614, '10000864', 'CR_AG_25-100304', '20800', '20775', '-25', '-0.12', NULL, NULL, '43', '64', 1, 'Freddy', 1, '2025-01-22 16:16:41', '2025-01-25 04:17:29'),
(615, '10000864', 'CR_AG_25-100305', '21030', '21000', '-30', '-0.14', NULL, NULL, '43', '64', 1, 'Freddy', 1, '2025-01-22 16:16:41', '2025-01-25 04:17:29'),
(616, '10000864', 'CR_AG_25-100307', '20600', '20580', '-20', '-0.10', NULL, NULL, '43', '64', 1, 'Freddy', 1, '2025-01-22 16:16:41', '2025-01-25 04:17:29'),
(617, '10000864', 'CR_AG_25-100308', '20360', '20385', '25', '0.12', NULL, NULL, '43', '64', 1, 'Freddy', 1, '2025-01-22 16:16:41', '2025-01-25 04:17:29'),
(618, '10000864', 'CR_AG_25-100132', '20570', '20585', '15', '0.07', NULL, NULL, '43', '64', 1, 'Freddy', 1, '2025-01-22 16:16:41', '2025-01-25 04:17:29'),
(619, '10000864', 'CR_AG_25-100133', '20350', '20390', '40', '0.20', NULL, NULL, '43', '64', 1, 'Freddy', 1, '2025-01-22 16:16:41', '2025-01-25 04:17:30'),
(620, '10000864', 'CR_AG_25-100331', '18490', '18500', '10', '0.05', NULL, NULL, '43', '64', 1, 'Freddy', 1, '2025-01-22 16:16:41', '2025-01-25 04:17:30'),
(621, '10000872', 'CR_AG_25-100332', '18760', '18780', '20', '0.11', NULL, NULL, '64', '20', 2, 'Dika', 1, '2025-01-23 00:12:11', '2025-02-04 01:54:16'),
(622, '10000872', 'CR_AG_25-100338', '20680', '20695', '15', '0.07', NULL, NULL, '64', '20', 2, 'Dika', 1, '2025-01-23 00:12:11', '2025-02-04 01:54:16'),
(623, '10000872', 'CR_AG_25-100217', '20670', '20685', '15', '0.07', NULL, NULL, '64', '20', 2, 'Dika', 1, '2025-01-23 00:12:11', '2025-02-04 01:54:16'),
(624, '10000872', 'CR_AG_25-100483', '22750', '22745', '-5', '-0.02', NULL, NULL, '64', '20', 2, 'Dika', 1, '2025-01-23 00:12:11', '2025-02-04 01:54:16'),
(625, '10000872', 'CR_AG_25-100347', '20340', '20345', '5', '0.02', NULL, NULL, '64', '20', 2, 'Dika', 1, '2025-01-23 00:12:11', '2025-02-04 01:54:16'),
(626, '10000872', 'CR_AG_25-100150', '19550', '19595', '45', '0.23', NULL, NULL, '64', '90', 2, 'Dika', 1, '2025-01-23 00:12:11', '2025-02-04 01:54:16'),
(627, '10000872', 'CR_AG_25-100334', '18090', '18090', '0', '0.00', NULL, NULL, '64', '90', 2, 'Dika', 1, '2025-01-23 00:12:11', '2025-02-04 01:54:16'),
(628, '10000872', 'CR_AG_25-100336', '19170', '19185', '15', '0.08', NULL, NULL, '64', '40', 2, 'Dika', 1, '2025-01-23 00:12:11', '2025-02-04 01:54:17'),
(629, '10000872', 'CR_AG_25-100337', '19470', '19470', '0', '0.00', NULL, NULL, '64', '40', 2, 'Dika', 1, '2025-01-23 00:12:11', '2025-02-04 01:54:17'),
(630, '10000872', 'CR_AG_25-100343', '19310', '19355', '45', '0.23', NULL, NULL, '64', '40', 2, 'Dika', 1, '2025-01-23 00:12:11', '2025-02-04 01:54:17'),
(631, '10000887', 'CR_AG_25-100316', '20510', '20252', '-258', '-1.26', NULL, NULL, '64', '20', 2, 'Dika', 1, '2025-01-23 04:41:34', '2025-01-25 04:19:07'),
(632, '10000904', 'CR_AG_25-100354', '19610', '19605', '-5', '-0.03', NULL, NULL, '20', '90', 3, 'Riyan H', 1, '2025-01-23 08:50:26', '2025-01-30 06:41:13'),
(633, '10000904', 'CR_AG_25-100360', '15470', '15480', '10', '0.06', NULL, NULL, '20', '90', 3, 'Riyan H', 1, '2025-01-23 08:50:26', '2025-01-30 06:41:13'),
(634, '10000904', 'CR_AG_25-100349', '19570', '19540', '-30', '-0.15', NULL, NULL, '20', '54', 3, 'Riyan H', 1, '2025-01-23 08:50:26', '2025-01-30 06:41:13'),
(635, '10000904', 'CR_AG_25-100484', '21080', '21065', '-15', '-0.07', NULL, NULL, '20', '54', 3, 'Riyan H', 1, '2025-01-23 08:50:26', '2025-01-30 06:41:13'),
(636, '10000904', 'CR_AG_25-100196', '19850', '19885', '35', '0.18', NULL, NULL, '20', '78', 3, 'Riyan H', 1, '2025-01-23 08:50:26', '2025-01-30 06:41:13'),
(637, '10000904', 'CR_AG_25-100312', '18550', '18545', '-5', '-0.03', NULL, NULL, '20', '54', 3, 'Riyan H', 1, '2025-01-23 08:50:26', '2025-01-30 06:41:13'),
(638, '10000904', 'CR_AG_25-100373', '18850', '18865', '15', '0.08', NULL, NULL, '20', '64', 3, 'Riyan H', 1, '2025-01-23 08:50:26', '2025-01-30 06:41:13'),
(639, '10000904', 'CR_AG_25-100309', '19580', '19590', '10', '0.05', NULL, NULL, '20', '64', 3, 'Riyan H', 1, '2025-01-23 08:50:26', '2025-01-30 06:41:13'),
(640, '10000904', 'CR_AG_25-100313', '19570', '19595', '25', '0.13', NULL, NULL, '20', '64', 3, 'Riyan H', 1, '2025-01-23 08:50:26', '2025-01-30 06:41:13'),
(641, '10000904', 'CR_AG_25-100374', '19780', '19815', '35', '0.18', NULL, NULL, '20', '64', 3, 'Riyan H', 1, '2025-01-23 08:50:26', '2025-01-30 06:41:13'),
(642, '10000904', 'CR_AG_25-100148', '19200', '19205', '5', '0.03', NULL, NULL, '20', '64', 3, 'Riyan H', 1, '2025-01-23 08:50:26', '2025-01-30 06:41:13'),
(643, '10000904', 'CR_AG_25-100149', '19540', '19520', '-20', '-0.10', NULL, NULL, '20', '64', 3, 'Riyan H', 1, '2025-01-23 08:50:26', '2025-01-30 06:41:13'),
(644, '10000916', 'CR_AG_25-100414', '22840', '22810', '-30', '-0.13', NULL, NULL, '54', '54', 1, 'Danu', 1, '2025-01-23 16:41:06', '2025-01-30 06:41:49'),
(645, '10000916', 'CR_AG_25-100415', '22640', '22645', '5', '0.02', NULL, NULL, '54', '54', 1, 'Danu', 1, '2025-01-23 16:41:06', '2025-01-30 06:41:49'),
(646, '10000916', 'CR_AG_25-100422', '21130', '21115', '-15', '-0.07', NULL, NULL, '54', '54', 1, 'Danu', 1, '2025-01-23 16:41:06', '2025-01-30 06:41:49'),
(647, '10000916', 'CR_AG_24-31168', '21000', '20995', '-5', '-0.02', NULL, NULL, '54', '54', 1, 'Danu', 1, '2025-01-23 16:41:06', '2025-01-30 06:41:49'),
(648, '10000916', 'CR_G_24-31443', '20455', '20485', '30', '0.15', NULL, NULL, '54', '54', 1, 'Danu', 1, '2025-01-23 16:41:06', '2025-01-30 06:41:49'),
(649, '10000922', 'CR_AG_25-100186', '19470', '19510', '40', '0.21', NULL, NULL, '64', '64', 2, 'Dika', 1, '2025-01-24 00:24:07', '2025-01-25 04:22:49'),
(650, '10000922', 'CR_AG_25-100187', '19580', '19670', '90', '0.46', NULL, NULL, '64', '64', 2, 'Dika', 1, '2025-01-24 00:24:07', '2025-01-25 04:22:49'),
(651, '10000922', 'CR_AG_25-100188', '19430', '19445', '15', '0.08', NULL, NULL, '64', '64', 2, 'Dika', 1, '2025-01-24 00:24:07', '2025-01-25 04:22:49'),
(652, '10000922', 'CR_AG_25-100293', '19630', '19645', '15', '0.08', NULL, NULL, '64', '64', 2, 'Dika', 1, '2025-01-24 00:24:07', '2025-01-25 04:22:49'),
(653, '10000922', 'CR_AG_25-100198', '19400', '19400', '0', '0.00', NULL, NULL, '64', '20', 2, 'Dika', 1, '2025-01-24 00:24:07', '2025-01-25 04:22:49'),
(654, '10000922', 'CR_AG_25-100199', '19390', '19400', '10', '0.05', NULL, NULL, '64', '54', 2, 'Dika', 1, '2025-01-24 00:24:07', '2025-01-25 04:22:49'),
(655, '10000922', 'CR_AG_25-100200', '19150', '19155', '5', '0.03', NULL, NULL, '64', '54', 2, 'Dika', 1, '2025-01-24 00:24:07', '2025-01-25 04:22:49'),
(656, '10000922', 'CR_AG_25-100201', '19200', '19210', '10', '0.05', NULL, NULL, '64', '20', 2, 'Dika', 1, '2025-01-24 00:24:07', '2025-01-25 04:22:49'),
(665, '10000928', 'CR_AG_25-100310', '19400', '19435', '35', '0.18', NULL, 'TAMBAHAN', '64', '64', 2, 'Dika', 1, '2025-01-24 06:48:29', '2025-01-25 04:23:34'),
(669, '10000933', 'CR_AG_25-100202', '19300', '19345', '45', '0.23', NULL, NULL, '20', '20', 3, 'Riyan H', 1, '2025-01-24 08:30:33', '2025-01-30 06:43:44'),
(670, '10000933', 'CR_AG_25-100079', '19440', '19410', '-30', '-0.15', NULL, NULL, '20', '20', 3, 'Riyan H', 1, '2025-01-24 08:30:33', '2025-01-30 06:43:44'),
(671, '10000933', 'CR_AG_25-100094', '19440', '19470', '30', '0.15', NULL, NULL, '20', '54', 3, 'Riyan H', 1, '2025-01-24 08:30:33', '2025-01-30 06:43:44'),
(672, '10000933', 'CR_AG_25-100101', '19530', '19495', '-35', '-0.18', NULL, NULL, '20', '73', 3, 'Riyan H', 1, '2025-01-24 08:30:33', '2025-01-30 06:43:44'),
(673, '10000933', 'CR_AG_25-100102', '19600', '19595', '-5', '-0.03', NULL, NULL, '20', '73', 3, 'Riyan H', 1, '2025-01-24 08:30:33', '2025-01-30 06:43:44'),
(674, '10000933', 'CR_AG_25-100103', '19500', '19550', '50', '0.26', NULL, NULL, '20', '24', 3, 'Riyan H', 1, '2025-01-24 08:30:33', '2025-01-30 06:43:44'),
(675, '10000933', 'CR_AG_25-100107', '19670', '19700', '30', '0.15', NULL, NULL, '20', '24', 3, 'Riyan H', 1, '2025-01-24 08:30:33', '2025-01-30 06:43:44'),
(676, '10000933', 'CR_AG_25-100121', '19220', '19245', '25', '0.13', NULL, NULL, '20', '24', 3, 'Riyan H', 1, '2025-01-24 08:30:33', '2025-01-30 06:43:44'),
(677, '10000933', 'CR_AG_25-100122', '19620', '19665', '45', '0.23', NULL, NULL, '20', '24', 3, 'Riyan H', 1, '2025-01-24 08:30:33', '2025-01-30 06:43:44'),
(678, '10000933', 'CR_AG_25-100124', '19730', '19740', '10', '0.05', NULL, NULL, '20', '24', 3, 'Riyan H', 1, '2025-01-24 08:30:33', '2025-01-30 06:43:44'),
(679, '10000933', 'CR_AG_25-100129', '19630', '19655', '25', '0.13', NULL, NULL, '20', '24', 3, 'Riyan H', 1, '2025-01-24 08:30:33', '2025-01-30 06:43:44'),
(680, '10000933', 'CR_AG_25-100130', '18340', '18340', '0', '0.00', NULL, NULL, '20', '24', 3, 'Riyan H', 1, '2025-01-24 08:30:33', '2025-01-30 06:43:44'),
(681, '10000942', 'CR_AG_25-100205', '19370', '19375', '5', '0.03', NULL, NULL, '20', '20', 3, 'Riyan H', 1, '2025-01-24 12:30:26', '2025-01-25 04:24:16'),
(682, '10000964', 'CR_AG_25-100197', '19630', '19635', '5', '0.03', NULL, NULL, '24', '76', 2, 'Dika', 1, '2025-01-25 02:45:41', '2025-01-30 06:46:46'),
(683, '10000964', 'CR_AG_25-100497', '19650', '19660', '10', '0.05', NULL, NULL, '24', '43', 2, 'Dika', 1, '2025-01-25 02:45:41', '2025-01-30 06:46:46'),
(684, '10000964', 'CR_AG_25-100355', '19880', '19915', '35', '0.18', NULL, NULL, '24', '76', 2, 'Dika', 1, '2025-01-25 02:45:41', '2025-01-30 06:46:46'),
(685, '10000964', 'CR_AG_25-100461', '17180', '17210', '30', '0.17', NULL, NULL, '24', '90', 2, 'Dika', 1, '2025-01-25 02:45:41', '2025-01-30 06:46:46'),
(686, '10000964', 'CR_AG_25-100463', '17790', '17795', '5', '0.03', NULL, NULL, '24', '43', 2, 'Dika', 1, '2025-01-25 02:45:41', '2025-01-30 06:46:46'),
(687, '10000964', 'CR_AG_25-100357', '18860', '18905', '45', '0.24', NULL, NULL, '24', '76', 2, 'Dika', 1, '2025-01-25 02:45:41', '2025-01-30 06:46:46'),
(688, '10000964', 'CR_AG_25-100388', '19610', '19655', '45', '0.23', NULL, NULL, '24', '76', 2, 'Dika', 1, '2025-01-25 02:45:41', '2025-01-30 06:46:46'),
(689, '10000964', 'CR_AG_25-100375', '17590', '17625', '35', '0.20', NULL, NULL, '24', '76', 2, 'Dika', 1, '2025-01-25 02:45:41', '2025-01-30 06:46:46'),
(690, '10000964', 'CR_AG_25-100389', '19100', '19115', '15', '0.08', NULL, NULL, '24', '90', 2, 'Dika', 1, '2025-01-25 02:45:41', '2025-01-30 06:46:46'),
(691, '10000964', 'CR_AG_25-100172', '18100', '18100', '0', '0.00', NULL, NULL, '24', '24', 2, 'Dika', 1, '2025-01-25 02:45:41', '2025-01-30 06:46:46'),
(692, '10000964', 'CR_AG_25-100221', '19690', '19675', '-15', '-0.08', NULL, NULL, '24', '76', 2, 'Dika', 1, '2025-01-25 02:45:41', '2025-01-30 06:46:46'),
(695, '10000982', 'CR_AG_25-100462', '18370', '18365', '-5', '-0.03', NULL, NULL, '76', '90', 3, 'Freddy', 1, '2025-01-25 08:52:53', '2025-01-30 06:49:06'),
(696, '10000982', 'CR_AG_25-100488', '21800', '21810', '10', '0.05', NULL, NULL, '76', '43', 3, 'Freddy', 1, '2025-01-25 08:52:53', '2025-01-30 06:49:06'),
(697, '10000982', 'CR_AG_25-100405', '22580', '22630', '50', '0.22', NULL, NULL, '76', '43', 3, 'Freddy', 1, '2025-01-25 08:52:53', '2025-01-30 06:49:06'),
(698, '10000982', 'CR_AG_25-100423', '22050', '22050', '0', '0.00', NULL, NULL, '76', '43', 3, 'Freddy', 1, '2025-01-25 08:52:53', '2025-01-30 06:49:07'),
(699, '10000982', 'CR_AG_25-100424', '22760', '22755', '-5', '-0.02', NULL, NULL, '76', '43', 3, 'Freddy', 1, '2025-01-25 08:52:53', '2025-01-30 06:49:07'),
(700, '10000982', 'CR_AG_25-100425', '22450', '22470', '20', '0.09', NULL, NULL, '76', '43', 3, 'Freddy', 1, '2025-01-25 08:52:53', '2025-01-30 06:49:07'),
(701, '10000982', 'CR_AG_25-100429', '22340', '22365', '25', '0.11', NULL, NULL, '76', '43', 3, 'Freddy', 1, '2025-01-25 08:52:53', '2025-01-30 06:49:07'),
(702, '10000982', 'CR_AG_25-100430', '20540', '20580', '40', '0.19', NULL, NULL, '76', '43', 3, 'Freddy', 1, '2025-01-25 08:52:53', '2025-01-30 06:49:07'),
(703, '10000988', 'CR_AG_25-100498', '19700', '19695', '-5', '-0.03', NULL, NULL, '20', '20', 1, 'Riyan H', 1, '2025-01-25 16:09:09', '2025-01-30 06:49:20'),
(704, '10000988', 'CR_AG_25-100499', '19680', '19675', '-5', '-0.03', NULL, NULL, '20', '20', 1, 'Riyan H', 1, '2025-01-25 16:09:09', '2025-01-30 06:49:20'),
(705, '10000995', 'CR_AG_25-100434', '22590', '22585', '-5', '-0.02', NULL, NULL, '43', '43', 2, 'Freddy', 1, '2025-01-26 00:24:08', '2025-01-30 06:53:22'),
(706, '10000995', 'CR_AG_25-100435', '22710', '22720', '10', '0.04', NULL, NULL, '43', '43', 2, 'Freddy', 1, '2025-01-26 00:24:09', '2025-01-30 06:53:22'),
(707, '10000995', 'CR_AG_25-100436', '22520', '22515', '-5', '-0.02', NULL, NULL, '43', '43', 2, 'Freddy', 1, '2025-01-26 00:24:09', '2025-01-30 06:53:22'),
(708, '10000995', 'CR_AG_25-100437', '22500', '22530', '30', '0.13', NULL, NULL, '43', '43', 2, 'Freddy', 1, '2025-01-26 00:24:09', '2025-01-30 06:53:22'),
(709, '10000995', 'CR_AG_25-100438', '22010', '22030', '20', '0.09', NULL, NULL, '43', '43', 2, 'Freddy', 1, '2025-01-26 00:24:09', '2025-01-30 06:53:22'),
(710, '10000995', 'CR_AG_25-100439', '22730', '22755', '25', '0.11', NULL, NULL, '43', '43', 2, 'Freddy', 1, '2025-01-26 00:24:09', '2025-01-30 06:53:22'),
(711, '10000995', 'CR_AG_25-100440', '21450', '21445', '-5', '-0.02', NULL, NULL, '43', '43', 2, 'Freddy', 1, '2025-01-26 00:24:09', '2025-01-30 06:53:22'),
(712, '10000995', 'CR_AG_25-100441', '21870', '21900', '30', '0.14', NULL, NULL, '43', '43', 2, 'Freddy', 1, '2025-01-26 00:24:09', '2025-01-30 06:53:22'),
(713, '10001006', 'CR_AG_25-100442', '22480', '22490', '10', '0.04', NULL, NULL, '43', '43', 3, 'Dika', 1, '2025-01-26 08:25:01', '2025-01-30 06:54:39'),
(714, '10001006', 'CR_AG_25-100175', '22240', '22240', '0', '0.00', NULL, NULL, '43', '43', 3, 'Dika', 1, '2025-01-26 08:25:01', '2025-01-30 06:54:39'),
(715, '10001006', 'CR_AG_25-100218', '22210', '22185', '-25', '-0.11', NULL, NULL, '43', '20', 3, 'Dika', 1, '2025-01-26 08:25:01', '2025-01-30 06:54:39'),
(716, '10001006', 'CR_AG_24-31437', '22590', '22565', '-25', '-0.11', NULL, NULL, '43', '20', 3, 'Dika', 1, '2025-01-26 08:25:01', '2025-01-30 06:54:39'),
(717, '10001006', 'CR_AG_25-100300', '22500', '22505', '5', '0.02', NULL, NULL, '43', '20', 3, 'Dika', 1, '2025-01-26 08:25:01', '2025-01-30 06:54:39'),
(718, '10001006', 'CR_AG_25-100301', '22510', '22530', '20', '0.09', NULL, NULL, '43', '20', 3, 'Dika', 1, '2025-01-26 08:25:01', '2025-01-30 06:54:39'),
(719, '10001006', 'CR_AG_25-100324', '22520', '22570', '50', '0.22', NULL, NULL, '43', '20', 3, 'Dika', 1, '2025-01-26 08:25:01', '2025-01-30 06:54:39'),
(720, '10001006', 'CR_AG_25-100325', '22450', '22455', '5', '0.02', NULL, NULL, '43', '20', 3, 'Dika', 1, '2025-01-26 08:25:01', '2025-01-30 06:54:39'),
(721, '10001006', 'CR_AG_25-100387', '22190', '22235', '45', '0.20', NULL, NULL, '43', '20', 3, 'Dika', 1, '2025-01-26 08:25:01', '2025-01-30 06:54:39'),
(722, '10001007', 'CR_AG_25-100450', '14340', '14350', '10', '0.07', NULL, NULL, '43', '20', 3, 'Dika', 1, '2025-01-26 08:35:14', '2025-01-30 06:56:09'),
(723, '10001007', 'CR_AG_25-100485', '18960', '18975', '15', '0.08', NULL, NULL, '43', '38', 3, 'Dika', 1, '2025-01-26 08:35:14', '2025-01-30 06:56:09'),
(724, '10001007', 'CR_AG_25-100467', '22170', '22215', '45', '0.20', NULL, NULL, '43', '38', 3, 'Dika', 1, '2025-01-26 08:35:14', '2025-01-30 06:56:09'),
(725, '10001007', 'CR_AG_25-100468', '21980', '21965', '-15', '-0.07', NULL, NULL, '43', '38', 3, 'Dika', 1, '2025-01-26 08:35:14', '2025-01-30 06:56:09'),
(726, '10001007', 'CR_AG_25-100480', '21580', '21665', '85', '0.39', NULL, NULL, '43', '38', 3, 'Dika', 1, '2025-01-26 08:35:14', '2025-01-30 06:56:09'),
(727, '10001007', 'CR_AG_25-100489', '21260', '21320', '60', '0.28', NULL, NULL, '43', '38', 3, 'Dika', 1, '2025-01-26 08:35:14', '2025-01-30 06:56:09'),
(728, '10001007', 'CR_AG_25-100561', '20920', '20990', '70', '0.33', NULL, NULL, '43', '38', 3, 'Dika', 1, '2025-01-26 08:35:14', '2025-01-30 06:56:09'),
(729, '10001007', 'CR_AG_25-100466', '15510', '15520', '10', '0.06', NULL, NULL, '43', '38', 3, 'Dika', 1, '2025-01-26 08:35:14', '2025-01-30 06:56:09'),
(730, '10001012', 'CR_AG_25-100206', '18250', '18270', '20', '0.11', NULL, NULL, '20', '38', 1, 'Riyan H', NULL, '2025-01-26 16:14:13', '2025-01-27 01:21:43'),
(731, '10001012', 'CR_AG_25-100207', '17750', NULL, NULL, NULL, NULL, NULL, '20', NULL, 1, 'Riyan H', NULL, '2025-01-26 16:14:13', '2025-01-26 16:14:13'),
(732, '10001012', 'CR_AG_25-100248', '19120', NULL, NULL, NULL, NULL, NULL, '20', NULL, 1, 'Riyan H', NULL, '2025-01-26 16:14:13', '2025-01-26 16:14:13'),
(733, '10001012', 'CR_AG_25-100475', '19640', '19660', '20', '0.10', NULL, NULL, '20', '24', 1, 'Riyan H', NULL, '2025-01-26 16:14:13', '2025-01-27 07:29:22'),
(734, '10001012', 'CR_AG_25-100476', '19750', '19750', '0', '0.00', NULL, NULL, '20', '64', 1, 'Riyan H', NULL, '2025-01-26 16:14:13', '2025-01-27 08:39:08'),
(735, '10001012', 'CR_AG_25-100477', '19560', '19545', '-15', '-0.08', NULL, NULL, '20', '64', 1, 'Riyan H', NULL, '2025-01-26 16:14:13', '2025-01-27 08:49:20'),
(736, '10001012', 'CR_AG_25-100358', '19740', '19735', '-5', '-0.03', NULL, NULL, '20', '64', 1, 'Riyan H', NULL, '2025-01-26 16:14:13', '2025-01-27 08:56:30'),
(737, '10001012', 'CR_AG_25-100408', '20060', '20050', '-10', '-0.05', NULL, NULL, '20', '64', 1, 'Riyan H', NULL, '2025-01-26 16:14:13', '2025-01-27 09:05:01'),
(738, '10001012', 'CR_AG_25-100420', '19560', '19540', '-20', '-0.10', NULL, NULL, '20', '64', 1, 'Riyan H', NULL, '2025-01-26 16:14:13', '2025-01-27 10:26:56'),
(739, '10001012', 'CR_AG_25-100421', '19930', '19905', '-25', '-0.13', NULL, NULL, '20', '64', 1, 'Riyan H', NULL, '2025-01-26 16:14:13', '2025-01-27 10:40:24'),
(740, '100001023', 'CR_AG_25-100552', '17050', '17050', '0', '0.00', NULL, NULL, '24', '24', 2, 'Freddy', 1, '2025-01-27 02:45:30', '2025-01-30 06:56:50'),
(741, '100001028', 'CR_AG_25-100512', '17060', '17060', '0', '0.00', NULL, NULL, '24', '24', 2, 'Freddy', 1, '2025-01-27 04:23:32', '2025-01-30 06:57:11'),
(742, '100001028', 'CR_AG_25-100511', '16660', '16680', '20', '0.12', NULL, NULL, '24', '24', 2, 'Freddy', 1, '2025-01-27 04:23:32', '2025-01-30 06:57:11'),
(743, '100001028', 'CR_AG_25-100510', '16760', '16725', '-35', '-0.21', NULL, NULL, '24', '24', 2, 'Freddy', 1, '2025-01-27 04:23:32', '2025-01-30 06:57:11'),
(744, '100001034', 'CR_AG_25-100563', '19390', '19390', '0', '0.00', NULL, NULL, '24', '24', 2, 'Freddy', 1, '2025-01-27 07:20:34', '2025-01-30 06:59:23'),
(745, '10001042', 'CR_AG_25-100502', '19490', '19510', '20', '0.10', NULL, NULL, '64', '64', 3, 'Dika', 1, '2025-01-27 08:48:58', '2025-02-04 01:55:23'),
(746, '10001042', 'CR_AG_25-100503', '19240', '19280', '40', '0.21', NULL, NULL, '64', '64', 3, 'Dika', 1, '2025-01-27 08:48:58', '2025-02-04 01:55:23'),
(747, '10001042', 'CR_AG_25-100504', '19500', '19500', '0', '0.00', NULL, NULL, '64', '76', 3, 'Dika', 1, '2025-01-27 08:48:58', '2025-02-04 01:55:23'),
(748, '10001042', 'CR_AG_25-100505', '18900', '18895', '-5', '-0.03', NULL, NULL, '64', '76', 3, 'Dika', 1, '2025-01-27 08:48:58', '2025-02-04 01:55:23'),
(749, '10001042', 'CR_AG_25-100445', '22160', '22150', '-10', '-0.05', NULL, NULL, '64', '20', 3, 'Dika', 1, '2025-01-27 08:48:58', '2025-02-04 01:55:23'),
(750, '10001042', 'CR_AG_25-100448', '21960', '21975', '15', '0.07', NULL, NULL, '64', '90', 3, 'Dika', 1, '2025-01-27 08:48:58', '2025-02-04 01:55:23'),
(751, '10001042', 'CR_AG_25-100449', '22350', '22345', '-5', '-0.02', NULL, NULL, '64', '38', 3, 'Dika', 1, '2025-01-27 08:48:58', '2025-02-04 01:55:24'),
(752, '10001042', 'CR_AG_25-100451', '22270', '22250', '-20', '-0.09', NULL, NULL, '64', '38', 3, 'Dika', 1, '2025-01-27 08:48:58', '2025-02-04 01:55:24'),
(753, '10001042', 'CR_AG_25-100452', '21370', '21395', '25', '0.12', NULL, NULL, '64', '67', 3, 'Dika', 1, '2025-01-27 08:48:58', '2025-02-04 01:55:24'),
(754, '10001042', 'CR_AG_25-100455', '22090', '22125', '35', '0.16', NULL, NULL, '64', '67', 3, 'Dika', 1, '2025-01-27 08:48:58', '2025-02-04 01:55:24'),
(755, '10001042', 'CR_AG_25-100456', '21880', '21880', '0', '0.00', NULL, NULL, '64', '67', 3, 'Dika', 1, '2025-01-27 08:48:58', '2025-02-04 01:55:24'),
(756, '10001042', 'CR_AG_25-100569', '22420', '22415', '-5', '-0.02', NULL, NULL, '64', '73', 3, 'Dika', 1, '2025-01-27 08:48:58', '2025-02-04 01:55:24'),
(763, '10001048', 'CR_G_25-100492', '21800', '21860', '60', '0.28', NULL, NULL, '76', '78', 1, 'Riyan H', 1, '2025-01-27 16:21:23', '2025-01-30 07:07:05'),
(764, '10001048', 'CR_G_25-100493', '19500', '19535', '35', '0.18', NULL, NULL, '76', '78', 1, 'Riyan H', 1, '2025-01-27 16:21:23', '2025-01-30 07:07:05'),
(765, '10001048', 'CR_G_25-100528', '17775', '17805', '30', '0.17', NULL, NULL, '76', '78', 1, 'Riyan H', 1, '2025-01-27 16:21:23', '2025-01-30 07:07:05'),
(766, '10001056', 'CR_AG_25-100490', '22400', '22390', '-10', '-0.04', NULL, NULL, '38', '38', 2, 'Danu', 1, '2025-01-28 00:40:24', '2025-01-30 07:50:52'),
(767, '10001056', 'CR_AG_25-100491', '22230', '22240', '10', '0.04', NULL, NULL, '38', '38', 2, 'Danu', 1, '2025-01-28 00:40:24', '2025-01-30 07:50:53'),
(768, '10001056', 'CR_AG_25-100536', '19980', '19960', '-20', '-0.10', NULL, NULL, '38', '38', 2, 'Danu', 1, '2025-01-28 00:40:24', '2025-01-30 07:50:53'),
(769, '10001056', 'CR_AG_25-100537', '22810', '22820', '10', '0.04', NULL, NULL, '38', '38', 2, 'Danu', 1, '2025-01-28 00:40:25', '2025-01-30 07:50:53'),
(770, '10001056', 'CR_AG_25-100550', '21880', '21895', '15', '0.07', NULL, NULL, '38', '38', 2, 'Danu', 1, '2025-01-28 00:40:25', '2025-01-30 07:50:53'),
(771, '1001005', 'CR_AG_25-100457', '22430', '22445', '15', '0.07', NULL, NULL, '78', '78', 3, 'Freddy', 1, '2025-01-28 09:04:29', '2025-01-30 07:51:31'),
(772, '1001005', 'CR_AG_25-100458', '22800', '22830', '30', '0.13', NULL, NULL, '78', '78', 3, 'Freddy', 1, '2025-01-28 09:04:29', '2025-01-30 07:51:31'),
(773, '1001005', 'CR_AG_25-100459', '21690', '21740', '50', '0.23', NULL, NULL, '78', '64', 3, 'Freddy', 1, '2025-01-28 09:04:29', '2025-01-30 07:51:31'),
(774, '1001005', 'CR_AG_25-100460', '22090', '22105', '15', '0.07', NULL, NULL, '78', '64', 3, 'Freddy', 1, '2025-01-28 09:04:29', '2025-01-30 07:51:31'),
(775, '1001005', 'CR_AG_25-100464', '20470', '20515', '45', '0.22', NULL, NULL, '78', '64', 3, 'Freddy', 1, '2025-01-28 09:04:29', '2025-01-30 07:51:31'),
(776, '1001005', 'CR_AG_25-100465', '20950', '20940', '-10', '-0.05', NULL, NULL, '78', '64', 3, 'Freddy', 1, '2025-01-28 09:04:29', '2025-01-30 07:51:31'),
(777, '1001005', 'CR_AG_25-100469', '22670', '22705', '35', '0.15', NULL, NULL, '78', '64', 3, 'Freddy', 1, '2025-01-28 09:04:29', '2025-01-30 07:51:31'),
(778, '1001005', 'CR_AG_25-100470', '22790', '22785', '-5', '-0.02', NULL, NULL, '78', '64', 3, 'Freddy', 1, '2025-01-28 09:04:29', '2025-01-30 07:51:31'),
(779, '1001005', 'CR_AG_25-100471', '22530', '22605', '75', '0.33', NULL, NULL, '78', '64', 3, 'Freddy', 1, '2025-01-28 09:04:29', '2025-01-30 07:51:32'),
(780, '1001005', 'CR_AG_25-100472', '19670', '19675', '5', '0.03', NULL, NULL, '78', '64', 3, 'Freddy', 1, '2025-01-28 09:04:29', '2025-01-30 07:51:32'),
(781, '1001005', 'CR_AG_25-100473', '22940', '22950', '10', '0.04', NULL, NULL, '78', '64', 3, 'Freddy', 1, '2025-01-28 09:04:29', '2025-01-30 07:51:32'),
(782, '1001005', 'CR_AG_25-100474', '19730', '19750', '20', '0.10', NULL, NULL, '78', '64', 3, 'Freddy', 1, '2025-01-28 09:04:29', '2025-01-30 07:51:32'),
(783, '10001099', 'CR_AG_25-100481', '21310', '21355', '45', '0.21', NULL, NULL, '64', '64', 1, 'Dika', 1, '2025-01-28 16:08:21', '2025-01-30 07:52:10'),
(784, '10001099', 'CR_AG_25-100486', '21680', '21670', '-10', '-0.05', NULL, NULL, '64', '64', 1, 'Dika', 1, '2025-01-28 16:08:21', '2025-01-30 07:52:10'),
(785, '10001099', 'CR_AG_25-100529', '22630', '22655', '25', '0.11', NULL, NULL, '64', '64', 1, 'Dika', 1, '2025-01-28 16:08:21', '2025-01-30 07:52:10'),
(786, '10001099', 'CR_AG_25-100530', '22890', '22930', '40', '0.17', NULL, NULL, '64', '64', 1, 'Dika', 1, '2025-01-28 16:08:21', '2025-01-30 07:52:10'),
(787, '10001099', 'CR_AG_25-100534', '23070', '23110', '40', '0.17', NULL, NULL, '64', '64', 1, 'Dika', 1, '2025-01-28 16:08:21', '2025-01-30 07:52:10'),
(788, '10001099', 'CR_AG_25-100535', '23120', '23140', '20', '0.09', NULL, NULL, '64', '64', 1, 'Dika', 1, '2025-01-28 16:08:21', '2025-01-30 07:52:10'),
(789, '10001099', 'CR_AG_25-100538', '22970', '22990', '20', '0.09', NULL, NULL, '64', '64', 1, 'Dika', 1, '2025-01-28 16:08:21', '2025-01-30 07:52:10'),
(790, '10001099', 'CR_AG_25-100539', '22220', '22245', '25', '0.11', NULL, NULL, '64', '64', 1, 'Dika', 1, '2025-01-28 16:08:21', '2025-01-30 07:52:10'),
(791, '10001099', 'CR_AG_25-100543', '22920', '22925', '5', '0.02', NULL, NULL, '64', '67', 1, 'Dika', 1, '2025-01-28 16:08:21', '2025-01-30 07:52:10'),
(792, '10001099', 'CR_AG_25-100544', '22660', '22670', '10', '0.04', NULL, NULL, '64', '73', 1, 'Dika', 1, '2025-01-28 16:08:21', '2025-01-30 07:52:10'),
(793, '10001099', 'CR_AG_25-100546', '22910', '22900', '-10', '-0.04', NULL, NULL, '64', '73', 1, 'Dika', 1, '2025-01-28 16:08:21', '2025-01-30 07:52:10'),
(794, '10001099', 'CR_AG_25-100547', '21600', '21560', '-40', '-0.19', NULL, NULL, '64', '73', 1, 'Dika', 1, '2025-01-28 16:08:21', '2025-01-30 07:52:10'),
(795, '10001103', 'CR_AG_25-100548', '22490', '22510', '20', '0.09', NULL, NULL, '64', '73', 2, 'Danu', 1, '2025-01-29 00:44:50', '2025-01-30 07:54:42'),
(796, '10001103', 'CR_AG_25-100549', '22770', '22775', '5', '0.02', NULL, NULL, '64', '73', 2, 'Danu', 1, '2025-01-29 00:44:51', '2025-01-30 07:54:42'),
(797, '10001103', 'CR_AG_25-100553', '22850', '22815', '-35', '-0.15', NULL, NULL, '64', '73', 2, 'Danu', 1, '2025-01-29 00:44:51', '2025-01-30 07:54:42'),
(798, '10001103', 'CR_AG_25-100554', '23080', '23065', '-15', '-0.06', NULL, NULL, '64', '73', 2, 'Danu', 1, '2025-01-29 00:44:51', '2025-01-30 07:54:42'),
(799, '10001103', 'CR_AG_25-100555', '22660', '22680', '20', '0.09', NULL, NULL, '64', '73', 2, 'Danu', 1, '2025-01-29 00:44:51', '2025-01-30 07:54:42'),
(800, '10001103', 'CR_AG_25-100556', '22100', '22085', '-15', '-0.07', NULL, NULL, '64', '73', 2, 'Danu', 1, '2025-01-29 00:44:51', '2025-01-30 07:54:42'),
(801, '10001103', 'CR_AG_25-100557', '23040', '23050', '10', '0.04', NULL, NULL, '64', '73', 2, 'Danu', 1, '2025-01-29 00:44:51', '2025-01-30 07:54:42'),
(802, '10001103', 'CR_AG_25-100558', '22750', '22775', '25', '0.11', NULL, NULL, '64', '78', 2, 'Danu', 1, '2025-01-29 00:44:51', '2025-01-30 07:54:42'),
(803, '10001103', 'CR_AG_25-100559', '19590', '19590', '0', '0.00', NULL, NULL, '64', '73', 2, 'Danu', 1, '2025-01-29 00:44:51', '2025-01-30 07:54:42'),
(804, '10001103', 'CR_AG_25-100560', '22400', '22475', '75', '0.33', NULL, NULL, '64', '78', 2, 'Danu', 1, '2025-01-29 00:44:51', '2025-01-30 07:54:42'),
(805, '10001103', 'CR_AG_25-100562', '22140', '22155', '15', '0.07', NULL, NULL, '64', '78', 2, 'Danu', 1, '2025-01-29 00:44:51', '2025-01-30 07:54:42'),
(806, '10001103', 'CR_AG_25-100566', '22220', '22290', '70', '0.32', NULL, NULL, '64', '78', 2, 'Danu', 1, '2025-01-29 00:44:51', '2025-01-30 07:54:42'),
(807, '10001104', 'CR_AG_25-100567', '22490', '22540', '50', '0.22', NULL, NULL, '67', '78', 2, 'Danu', 1, '2025-01-29 01:08:25', '2025-01-30 07:55:03'),
(808, '10001104', 'CR_AG_25-100568', '22880', '22910', '30', '0.13', NULL, NULL, '67', '78', 2, 'Danu', 1, '2025-01-29 01:08:25', '2025-01-30 07:55:03'),
(809, '10001104', 'CR_AG_25-100574', '23220', '23265', '45', '0.19', NULL, NULL, '67', '78', 2, 'Danu', 1, '2025-01-29 01:08:25', '2025-01-30 07:55:03'),
(810, '10001104', 'CR_AG_25-100575', '22690', '22725', '35', '0.15', NULL, NULL, '67', '78', 2, 'Danu', 1, '2025-01-29 01:08:25', '2025-01-30 07:55:03'),
(811, '10001104', 'CR_AG_25-100576', '22820', '22875', '55', '0.24', NULL, NULL, '67', '78', 2, 'Danu', 1, '2025-01-29 01:08:25', '2025-01-30 07:55:03'),
(812, '10001127', 'CR_AG_25-100577', '22010', '22065', '55', '0.25', NULL, NULL, '78', '78', 3, 'Freddy', 1, '2025-01-29 09:40:02', '2025-01-30 07:55:53'),
(813, '10001127', 'CR_AG_25-100579', '21730', '21770', '40', '0.18', NULL, NULL, '78', '78', 3, 'Freddy', 1, '2025-01-29 09:40:02', '2025-01-30 07:55:53'),
(814, '10001127', 'CR_AG_25-100580', '23000', '23070', '70', '0.30', NULL, NULL, '78', '78', 3, 'Freddy', 1, '2025-01-29 09:40:02', '2025-01-30 07:55:53'),
(815, '10001127', 'CR_AG_25-100581', '22650', '22690', '40', '0.18', NULL, NULL, '78', '78', 3, 'Freddy', 1, '2025-01-29 09:40:02', '2025-01-30 07:55:53'),
(816, '10001127', 'CR_AG_25-100219', '22870', '22875', '5', '0.02', NULL, NULL, '78', '78', 3, 'Freddy', 1, '2025-01-29 09:40:02', '2025-01-30 07:55:53'),
(817, '10001127', 'CR_AG_25-100225', '22550', '22570', '20', '0.09', NULL, NULL, '78', '76', 3, 'Freddy', 1, '2025-01-29 09:40:02', '2025-01-30 07:55:53'),
(818, '10001127', 'CR_AG_25-100226', '22520', '22565', '45', '0.20', NULL, NULL, '78', '76', 3, 'Freddy', 1, '2025-01-29 09:40:02', '2025-01-30 07:55:53'),
(819, '10001127', 'CR_AG_25-100582', '22490', '22500', '10', '0.04', NULL, NULL, '78', '76', 3, 'Freddy', 1, '2025-01-29 09:40:02', '2025-01-30 07:55:53'),
(820, '10001127', 'CR_AG_25-100583', '22860', '22895', '35', '0.15', NULL, NULL, '78', '76', 3, 'Freddy', 1, '2025-01-29 09:40:02', '2025-01-30 07:55:53'),
(821, '10001127', 'CR_AG_25-100584', '23010', '23000', '-10', '-0.04', NULL, NULL, '78', '76', 3, 'Freddy', 1, '2025-01-29 09:40:02', '2025-01-30 07:55:53'),
(822, '10001127', 'CR_AG_25-100585', '21410', '21385', '-25', '-0.12', NULL, NULL, '78', '76', 3, 'Freddy', 1, '2025-01-29 09:40:02', '2025-01-30 07:55:53'),
(823, '10001127', 'CR_AG_25-100586', '21840', '21815', '-25', '-0.11', NULL, NULL, '78', '76', 3, 'Freddy', 1, '2025-01-29 09:40:02', '2025-01-30 07:55:54'),
(824, '10001133', 'CR_AG_25-100587', '22380', '22395', '15', '0.07', NULL, NULL, '76', '76', 1, 'Dika', 1, '2025-01-29 16:06:40', '2025-01-30 07:56:30'),
(825, '10001133', 'CR_AG_25-100589', '22780', '22775', '-5', '-0.02', NULL, NULL, '76', '76', 1, 'Dika', 1, '2025-01-29 16:06:41', '2025-01-30 07:56:30'),
(826, '10001133', 'CR_AG_25-100595', '22760', '22785', '25', '0.11', NULL, NULL, '76', '76', 1, 'Dika', 1, '2025-01-29 16:06:41', '2025-01-30 07:56:30'),
(827, '10001133', 'CR_AG_25-100524', '17130', '17140', '10', '0.06', NULL, NULL, '76', '76', 1, 'Dika', 1, '2025-01-29 16:06:41', '2025-01-30 07:56:30'),
(828, '10001133', 'CR_AG_25-100506', '19030', '19055', '25', '0.13', NULL, NULL, '76', '90', 1, 'Dika', 1, '2025-01-29 16:06:41', '2025-01-30 07:56:30'),
(829, '10001133', 'CR_AG_25-100507', '19830', '19850', '20', '0.10', NULL, NULL, '76', '90', 1, 'Dika', 1, '2025-01-29 16:06:41', '2025-01-30 07:56:30'),
(830, '10001133', 'CR_AG_25-100508', '20010', '20030', '20', '0.10', NULL, NULL, '76', '90', 1, 'Dika', 1, '2025-01-29 16:06:41', '2025-01-30 07:56:30'),
(831, '10001133', 'CR_AG_25-100509', '20070', '20095', '25', '0.12', NULL, NULL, '76', '90', 1, 'Dika', 1, '2025-01-29 16:06:41', '2025-01-30 07:56:30'),
(834, '10001135', 'CR_AG_25-100596', '22930', '22915', '-15', '-0.07', NULL, NULL, '76', '76', 1, 'Dika', 1, '2025-01-29 22:48:28', '2025-01-31 12:01:23'),
(835, '10001139', 'CR_AG_25-100515', '19520', '19500', '-20', '-0.10', NULL, NULL, '90', '90', 2, 'Riyan H', 1, '2025-01-30 00:12:45', '2025-01-31 12:01:55'),
(836, '10001139', 'CR_AG_25-100517', '19770', '19750', '-20', '-0.10', NULL, NULL, '90', '38', 2, 'Riyan H', 1, '2025-01-30 00:12:45', '2025-01-31 12:01:55'),
(837, '10001139', 'CR_AG_25-100516', '19730', '19720', '-10', '-0.05', NULL, NULL, '90', '38', 2, 'Riyan H', 1, '2025-01-30 00:12:46', '2025-01-31 12:01:55'),
(838, '10001139', 'CR_AG_25-100514', '19500', '19510', '10', '0.05', NULL, NULL, '90', '38', 2, 'Riyan H', 1, '2025-01-30 00:12:46', '2025-01-31 12:01:55'),
(839, '10001139', 'CR_AG_25-100532', '19850', '19855', '5', '0.03', NULL, NULL, '90', '38', 2, 'Riyan H', 1, '2025-01-30 00:12:46', '2025-01-31 12:01:56'),
(840, '10001139', 'CR_AG_25-100513', '19640', '19635', '-5', '-0.03', NULL, NULL, '90', '90', 2, 'Riyan H', 1, '2025-01-30 00:12:46', '2025-01-31 12:01:56'),
(841, '10001139', 'CR_AG_25-100518', '19810', '19805', '-5', '-0.03', NULL, NULL, '90', '38', 2, 'Riyan H', 1, '2025-01-30 00:12:46', '2025-01-31 12:01:56'),
(842, '10001158', 'CR_G_24-31231', '8910', '8910', '0', '0.00', NULL, NULL, '54', '54', 3, 'Danu', NULL, '2025-01-30 12:14:36', '2025-01-30 12:14:55'),
(843, '10001158', 'CR_G_25-100545', '17795', '17815', '20', '0.11', NULL, NULL, '54', '54', 3, 'Danu', NULL, '2025-01-30 12:14:37', '2025-01-30 12:41:04'),
(844, '10001158', 'CR_AG_24-31446', '16240', '16255', '15', '0.09', NULL, NULL, '54', '54', 3, 'Danu', NULL, '2025-01-30 12:14:37', '2025-01-30 12:36:05'),
(845, '10001158', 'CR_AG_25-100005', '17690', '17700', '10', '0.06', NULL, NULL, '54', '24', 3, 'Danu', NULL, '2025-01-30 12:14:37', '2025-01-30 16:58:16'),
(846, '10001158', 'CR_AG_25-100006', '15710', '15715', '5', '0.03', NULL, NULL, '54', '40', 3, 'Danu', NULL, '2025-01-30 12:14:37', '2025-02-01 08:11:04'),
(847, '10001158', 'CR_AG_25-100597', '22650', '22635', '-15', '-0.07', NULL, NULL, '54', '90', 3, 'Danu', NULL, '2025-01-30 12:14:37', '2025-02-01 14:50:31'),
(848, '10001158', 'CR_AG_25-100598', '22610', '22635', '25', '0.11', NULL, NULL, '54', '90', 3, 'Danu', NULL, '2025-01-30 12:14:37', '2025-02-01 16:38:08'),
(849, '10001158', 'CR_AG_25-100602', '22760', NULL, NULL, NULL, NULL, NULL, '54', NULL, 3, 'Danu', NULL, '2025-01-30 12:14:37', '2025-01-30 12:14:37'),
(850, '10001158', 'CR_AG_25-100603', '22570', NULL, NULL, NULL, NULL, NULL, '54', NULL, 3, 'Danu', NULL, '2025-01-30 12:14:37', '2025-01-30 12:14:37'),
(851, '10001160', 'CR_AG_25-100533', '15790', '15790', '0', '0.00', NULL, NULL, '67', '67', 3, 'Danu', 1, '2025-01-30 14:12:35', '2025-01-31 12:02:03'),
(863, '10001185', 'CR_AG_25-100142', '18050', '18050', '0', '0.00', NULL, NULL, '24', '43', 1, 'Freddy', 1, '2025-01-30 18:13:36', '2025-01-31 12:03:29'),
(867, '10001167', 'CR_AG_25-100112', '17820', '17805', '-15', '-0.08', NULL, NULL, '43', '43', 1, 'Freddy', 1, '2025-01-30 22:22:19', '2025-01-31 12:03:31'),
(868, '10001167', 'CR_AG_25-100116', '15870', '15910', '40', '0.25', NULL, NULL, '43', '43', 1, 'Freddy', 1, '2025-01-30 22:22:19', '2025-01-31 12:03:31'),
(869, '10001167', 'CR_AG_25-100115', '15300', '15360', '60', '0.39', NULL, NULL, '43', '43', 1, 'Freddy', 1, '2025-01-30 22:22:20', '2025-01-31 12:03:31'),
(870, '10001178', 'CR_AG_25-100494', '22200', '22185', '-15', '-0.07', NULL, NULL, '73', '73', 3, 'Danu', 1, '2025-01-31 13:44:50', '2025-02-04 01:56:54'),
(871, '10001181', 'CR_AG_25-100614', '22470', '22540', '70', '0.31', NULL, NULL, '24', '24', 1, 'Freddy', 1, '2025-01-31 21:45:23', '2025-02-04 01:57:20'),
(872, '10001181', 'CR_AG_25-100615', '22210', '22225', '15', '0.07', NULL, NULL, '24', '24', 1, 'Freddy', 1, '2025-01-31 21:45:23', '2025-02-04 01:57:20'),
(873, '10001182', 'CR_AG_25-100618', '22370', '22445', '75', '0.34', NULL, NULL, '24', '24', 1, 'Freddy', 1, '2025-01-31 22:33:07', '2025-02-04 01:57:31'),
(874, '10001182', 'CR_AG_25-100619', '22570', '22600', '30', '0.13', NULL, NULL, '24', '24', 1, 'Freddy', 1, '2025-01-31 22:33:07', '2025-02-04 01:57:31'),
(875, '10001184', 'CR_AG_25-100621', '20570', '20565', '-5', '-0.02', NULL, NULL, '40', '40', 2, 'Dika', NULL, '2025-02-01 01:04:04', '2025-02-01 01:04:38'),
(876, '10001184', 'CR_AG_25-100620', '21350', '21380', '30', '0.14', NULL, NULL, '40', '40', 2, 'Dika', NULL, '2025-02-01 01:04:04', '2025-02-01 01:04:54'),
(877, '10001184', 'CR_AG_25-100616', '22100', '22090', '-10', '-0.05', NULL, NULL, '40', '40', 2, 'Dika', NULL, '2025-02-01 01:04:04', '2025-02-01 02:14:05'),
(878, '10001184', 'CR_AG_25-100617', '20240', '20220', '-20', '-0.10', NULL, NULL, '40', '40', 2, 'Dika', NULL, '2025-02-01 01:04:04', '2025-02-01 02:35:37'),
(879, '10001184', 'CR_AG_25-100623', '22230', '22240', '10', '0.04', NULL, NULL, '40', '40', 2, 'Dika', NULL, '2025-02-01 01:04:04', '2025-02-01 01:21:48'),
(880, '10001184', 'CR_AG_25-100622', '21210', '21210', '0', '0.00', NULL, NULL, '40', '40', 2, 'Dika', NULL, '2025-02-01 01:04:04', '2025-02-01 01:29:04'),
(881, '10001184', 'CR_AG_25-100628', '22060', '22075', '15', '0.07', NULL, NULL, '40', '40', 2, 'Dika', NULL, '2025-02-01 01:04:04', '2025-02-01 04:16:50');
INSERT INTO `packing_detail` (`id`, `gm`, `attribute`, `b_label`, `b_aktual`, `selisih`, `persentase`, `stiker`, `keterangan`, `operator`, `scanner`, `shift`, `shift_leader`, `checks`, `created_at`, `updated_at`) VALUES
(882, '10001184', 'CR_AG_25-100629', '22330', NULL, NULL, NULL, NULL, NULL, '40', NULL, 2, 'Dika', NULL, '2025-02-01 01:04:04', '2025-02-01 01:04:04'),
(883, '10001184', 'CR_AG_25-100626', '22450', '22460', '10', '0.04', NULL, NULL, '40', '40', 2, 'Dika', NULL, '2025-02-01 01:04:04', '2025-02-01 02:41:33'),
(884, '10001184', 'CR_AG_25-100627', '22680', '22710', '30', '0.13', NULL, NULL, '40', '40', 2, 'Dika', NULL, '2025-02-01 01:04:04', '2025-02-01 04:22:51'),
(885, '10001189', 'CR_AG_25-100344', '19060', '19060', '0', '0.00', NULL, NULL, '40', '90', 2, 'Dika', 1, '2025-02-01 06:12:45', '2025-02-04 01:59:19'),
(886, '10001189', 'CR_AG_25-100348', '19060', '19050', '-10', '-0.05', NULL, NULL, '40', '90', 2, 'Dika', 1, '2025-02-01 06:12:46', '2025-02-04 01:59:19'),
(887, '10001189', 'CR_AG_25-100639', '22310', '22300', '-10', '-0.04', NULL, NULL, '40', '90', 2, 'Dika', 1, '2025-02-01 06:12:46', '2025-02-04 01:59:19'),
(888, '10001189', 'CR_AG_25-100258', '21610', '21600', '-10', '-0.05', NULL, NULL, '40', '90', 2, 'Dika', 1, '2025-02-01 06:12:46', '2025-02-04 01:59:19'),
(889, '10001189', 'CR_AG_25-100495', '21850', '21840', '-10', '-0.05', NULL, NULL, '40', '90', 2, 'Dika', 1, '2025-02-01 06:12:46', '2025-02-04 01:59:19'),
(890, '10001189', 'CR_AG_25-100500', '22470', '22465', '-5', '-0.02', NULL, NULL, '40', '73', 2, 'Dika', 1, '2025-02-01 06:12:46', '2025-02-04 01:59:19'),
(891, '10001189', 'CR_AG_25-100501', '18810', '18805', '-5', '-0.03', NULL, NULL, '40', '73', 2, 'Dika', 1, '2025-02-01 06:12:46', '2025-02-04 01:59:19'),
(892, '10001194', 'CR_AG_25-100609', '14850', '14840', '-10', '-0.07', NULL, NULL, '90', '64', 3, 'Riyan H', 1, '2025-02-01 12:20:52', '2025-02-04 02:00:09'),
(893, '10001194', 'CR_AG_25-100600', '17590', '17590', '0', '0.00', NULL, NULL, '90', '73', 3, 'Riyan H', 1, '2025-02-01 12:20:52', '2025-02-04 02:00:09'),
(894, '10001194', 'CR_AG_25-100570', '4420', '4410', '-10', '-0.23', NULL, NULL, '90', '64', 3, 'Riyan H', 1, '2025-02-01 12:20:52', '2025-02-04 02:00:09'),
(895, '10001194', 'CR_AG_25-100520', '20040', '20045', '5', '0.02', NULL, NULL, '90', '73', 3, 'Riyan H', 1, '2025-02-01 12:20:52', '2025-02-04 02:00:09'),
(896, '10001194', 'CR_AG_25-100519', '19950', '19945', '-5', '-0.03', NULL, NULL, '90', '73', 3, 'Riyan H', 1, '2025-02-01 12:20:52', '2025-02-04 02:00:09'),
(897, '10001194', 'CR_AG_24-30989', '22120', '22115', '-5', '-0.02', NULL, NULL, '90', '73', 3, 'Riyan H', 1, '2025-02-01 12:20:52', '2025-02-04 02:00:09'),
(946, '10001208', 'CR_AG_25-100613', '19320', '19360', '40', '0.21', NULL, NULL, '29', '64', 2, 'Dika', NULL, '2025-02-02 05:08:47', '2025-02-02 06:22:12'),
(947, '10001208', 'CR_AG_25-100640', '22500', '22525', '25', '0.11', NULL, NULL, '29', '64', 2, 'Dika', NULL, '2025-02-02 05:08:47', '2025-02-02 06:56:26'),
(948, '10001208', 'CR_AG_25-100641', '22980', '23035', '55', '0.24', NULL, NULL, '29', '64', 2, 'Dika', NULL, '2025-02-02 05:08:47', '2025-02-02 06:22:48'),
(949, '10001208', 'CR_AG_25-100642', '22650', '22680', '30', '0.13', NULL, NULL, '29', '64', 2, 'Dika', NULL, '2025-02-02 05:08:47', '2025-02-02 07:07:28'),
(950, '10001208', 'CR_AG_25-100606', '14060', '14065', '5', '0.04', NULL, NULL, '29', '20', 2, 'Dika', NULL, '2025-02-02 05:08:47', '2025-02-02 08:31:54'),
(951, '10001208', 'CR_AG_25-100610', '19080', '19090', '10', '0.05', NULL, NULL, '29', '20', 2, 'Dika', NULL, '2025-02-02 05:08:47', '2025-02-02 08:37:06'),
(952, '10001208', 'CR_AG_25-100611', '19000', '18955', '-45', '-0.24', NULL, NULL, '29', '20', 2, 'Dika', NULL, '2025-02-02 05:08:47', '2025-02-02 12:18:13'),
(953, '10001208', 'CR_AG_25-100540', '19840', NULL, NULL, NULL, NULL, NULL, '29', NULL, 2, 'Dika', NULL, '2025-02-02 05:08:47', '2025-02-02 05:08:47'),
(954, '10001208', 'CR_AG_25-100612', '20020', NULL, NULL, NULL, NULL, NULL, '29', NULL, 2, 'Dika', NULL, '2025-02-02 05:08:47', '2025-02-02 05:08:47'),
(955, '10001215', 'CR_AG_25-100674', '19830', NULL, NULL, NULL, NULL, NULL, '64', NULL, 3, 'Riyan H', NULL, '2025-02-02 08:21:07', '2025-02-02 08:21:07'),
(956, '10001215', 'CR_AG_25-100154', '18090', '18090', '0', '0.00', NULL, NULL, '64', '73', 3, 'Riyan H', NULL, '2025-02-02 08:21:07', '2025-02-02 19:55:24'),
(957, '10001215', 'CR_AG_25-100153', '17700', '17725', '25', '0.14', NULL, NULL, '64', '73', 3, 'Riyan H', NULL, '2025-02-02 08:21:07', '2025-02-02 19:48:45'),
(958, '10001215', 'CR_AG_25-100144', '17910', '17920', '10', '0.06', NULL, NULL, '64', '73', 3, 'Riyan H', NULL, '2025-02-02 08:21:07', '2025-02-02 17:54:27'),
(959, '10001215', 'CR_AG_25-100134', '17310', '17310', '0', '0.00', NULL, NULL, '64', '73', 3, 'Riyan H', NULL, '2025-02-02 08:21:07', '2025-02-02 17:48:58'),
(960, '10001215', 'CR_AG_25-100117', '17430', '17425', '-5', '-0.03', NULL, NULL, '64', '73', 3, 'Riyan H', NULL, '2025-02-02 08:21:07', '2025-02-02 17:06:40'),
(961, '10001215', 'CR_AG_25-100114', '17240', '17240', '0', '0.00', NULL, NULL, '64', '73', 3, 'Riyan H', NULL, '2025-02-02 08:21:07', '2025-02-02 17:00:06'),
(962, '10001215', 'CR_AG_25-100113', '17570', '17580', '10', '0.06', NULL, NULL, '64', '20', 3, 'Riyan H', NULL, '2025-02-02 08:21:07', '2025-02-02 16:30:05'),
(963, '10001215', 'CR_AG_25-100106', '17670', '17660', '-10', '-0.06', NULL, NULL, '64', '20', 3, 'Riyan H', NULL, '2025-02-02 08:21:07', '2025-02-02 15:08:01'),
(964, '10001221', 'CR_AG_25-100161', '18080', '18070', '-10', '-0.06', NULL, NULL, '73', '73', 1, 'Danu', 1, '2025-02-02 17:26:28', '2025-02-05 03:18:49'),
(965, '10001221', 'CR_AG_25-100162', '17880', '17885', '5', '0.03', NULL, NULL, '73', '73', 1, 'Danu', 1, '2025-02-02 17:26:28', '2025-02-05 03:18:49'),
(966, '10001221', 'CR_AG_25-100166', '17470', '17535', '65', '0.37', NULL, NULL, '73', '54', 1, 'Danu', 1, '2025-02-02 17:26:28', '2025-02-05 03:18:49'),
(967, '10001221', 'CR_AG_25-100173', '17610', '17660', '50', '0.28', NULL, NULL, '73', '20', 1, 'Danu', 1, '2025-02-02 17:26:28', '2025-02-05 03:18:49'),
(968, '10001221', 'CR_AG_25-100179', '11090', '11100', '10', '0.09', NULL, NULL, '73', '20', 1, 'Danu', 1, '2025-02-02 17:26:28', '2025-02-05 03:18:49'),
(969, '10001221', 'CR_AG_25-100180', '14600', '14620', '20', '0.14', NULL, NULL, '73', '54', 1, 'Danu', 1, '2025-02-02 17:26:28', '2025-02-05 03:18:49'),
(975, '10001229', 'CR_AG_25-100723', '19720', '19745', '25', '0.13', NULL, NULL, '76', '76', 2, 'Dika', NULL, '2025-02-03 02:37:42', '2025-02-03 03:14:54'),
(976, '10001229', 'CR_AG_25-100724', '19530', '19545', '15', '0.08', NULL, NULL, '76', '76', 2, 'Dika', NULL, '2025-02-03 02:37:42', '2025-02-03 03:25:13'),
(977, '10001229', 'CR_AG_25-100725', '19250', '19255', '5', '0.03', NULL, NULL, '76', '76', 2, 'Dika', NULL, '2025-02-03 02:37:42', '2025-02-03 04:35:12'),
(978, '10001229', 'CR_AG_25-100726', '19680', '19725', '45', '0.23', NULL, NULL, '76', '76', 2, 'Dika', NULL, '2025-02-03 02:37:42', '2025-02-03 04:42:00'),
(979, '10001229', 'CR_AG_25-100727', '19750', '19790', '40', '0.20', NULL, NULL, '76', '76', 2, 'Dika', NULL, '2025-02-03 02:37:42', '2025-02-03 04:53:22'),
(980, '10001229', 'CR_AG_24-30994', '21570', NULL, NULL, NULL, NULL, NULL, '76', NULL, 2, 'Dika', NULL, '2025-02-03 02:37:42', '2025-02-03 02:37:42'),
(981, '10001229', 'CR_AG_25-100645', '22460', '22505', '45', '0.20', NULL, NULL, '76', '20', 2, 'Dika', NULL, '2025-02-03 02:37:42', '2025-02-03 08:54:03'),
(982, '10001229', 'CR_AG_25-100646', '22190', '22245', '55', '0.25', NULL, NULL, '76', '20', 2, 'Dika', NULL, '2025-02-03 02:37:42', '2025-02-03 08:54:39'),
(983, '10001229', 'CR_AG_25-100647', '21700', '21730', '30', '0.14', NULL, NULL, '76', '20', 2, 'Dika', NULL, '2025-02-03 02:37:42', '2025-02-03 09:59:15'),
(984, '1001253', 'CR_AG_25-100676', '17650', '17645', '-5', '-0.03', NULL, NULL, '76', '76', 2, 'Dika', 1, '2025-02-03 06:20:50', '2025-02-04 03:05:49'),
(985, '1001253', 'CR_AG_25-100648', '22460', '22505', '45', '0.20', NULL, NULL, '76', '20', 2, 'Dika', 1, '2025-02-03 06:20:50', '2025-02-04 03:05:49'),
(986, '1001253', 'CR_AG_25-100650', '22770', '22775', '5', '0.02', NULL, NULL, '76', '20', 2, 'Dika', 1, '2025-02-03 06:20:50', '2025-02-04 03:05:49'),
(987, '1001253', 'CR_AG_25-100669', '22500', '22580', '80', '0.36', NULL, NULL, '76', '20', 2, 'Dika', 1, '2025-02-03 06:20:50', '2025-02-04 03:05:49'),
(988, '1001253', 'CR_AG_25-100670', '22650', '22640', '-10', '-0.04', NULL, NULL, '76', '20', 2, 'Dika', 1, '2025-02-03 06:20:50', '2025-02-04 03:05:49'),
(989, '1001253', 'CR_AG_25-100706', '23120', '23095', '-25', '-0.11', NULL, NULL, '76', '90', 2, 'Dika', 1, '2025-02-03 06:20:50', '2025-02-04 03:05:49'),
(990, '1001253', 'CR_AG_25-100707', '22970', '22995', '25', '0.11', NULL, NULL, '76', '90', 2, 'Dika', 1, '2025-02-03 06:20:50', '2025-02-04 03:05:49'),
(991, '1001253', 'CR_AG_25-100709', '23000', '23010', '10', '0.04', NULL, NULL, '76', '90', 2, 'Dika', 1, '2025-02-03 06:20:50', '2025-02-04 03:05:49'),
(992, '10001268', 'CR_AG_25-100732', '22670', '22680', '10', '0.04', NULL, NULL, '20', '90', 3, 'Riyan H', 1, '2025-02-03 08:19:50', '2025-02-04 03:06:44'),
(993, '10001268', 'CR_AG_25-100729', '23000', '22970', '-30', '-0.13', NULL, NULL, '20', '90', 3, 'Riyan H', 1, '2025-02-03 08:19:50', '2025-02-04 03:06:44'),
(994, '10001268', 'CR_AG_25-100721', '22910', '22915', '5', '0.02', NULL, NULL, '20', '90', 3, 'Riyan H', 1, '2025-02-03 08:19:50', '2025-02-04 03:06:44'),
(995, '10001268', 'CR_AG_25-100720', '22640', '22650', '10', '0.04', NULL, NULL, '20', '90', 3, 'Riyan H', 1, '2025-02-03 08:19:50', '2025-02-04 03:06:44'),
(996, '10001268', 'CR_AG_25-100719', '23060', '23070', '10', '0.04', NULL, NULL, '20', '90', 3, 'Riyan H', 1, '2025-02-03 08:19:50', '2025-02-04 03:06:45'),
(997, '10001268', 'CR_AG_25-100028', '21360', '21360', '0', '0.00', NULL, NULL, '20', '54', 3, 'Riyan H', 1, '2025-02-03 08:19:50', '2025-02-04 03:06:45'),
(998, '10001268', 'CR_AG_25-100027', '21870', '21935', '65', '0.30', NULL, NULL, '20', '78', 3, 'Riyan H', 1, '2025-02-03 08:19:50', '2025-02-04 03:06:45'),
(999, '10001268', 'CR_AG_25-100020', '19460', '19470', '10', '0.05', NULL, NULL, '20', '54', 3, 'Riyan H', 1, '2025-02-03 08:19:50', '2025-02-04 03:06:45'),
(1000, '10001268', 'CR_AG_25-100019', '22170', '22145', '-25', '-0.11', NULL, NULL, '20', '54', 3, 'Riyan H', 1, '2025-02-03 08:19:50', '2025-02-04 03:06:45'),
(1001, '10001268', 'CR_AG_24-31507', '19330', '19375', '45', '0.23', NULL, NULL, '20', '54', 3, 'Riyan H', 1, '2025-02-03 08:19:50', '2025-02-04 03:06:45'),
(1002, '10001268', 'CR_AG_24-31506', '21890', '21885', '-5', '-0.02', NULL, NULL, '20', '54', 3, 'Riyan H', 1, '2025-02-03 08:19:50', '2025-02-04 03:06:45'),
(1008, '10001280', 'CR_AG_24-31288', '21960', '22010', '50', '0.23', NULL, NULL, '90', '43', 1, 'Danu', 1, '2025-02-03 18:01:14', '2025-02-05 03:20:15'),
(1009, '10001280', 'CR_AG_25-100692', '17610', '17625', '15', '0.09', NULL, NULL, '90', '43', 1, 'Danu', 1, '2025-02-03 18:01:14', '2025-02-05 03:20:15'),
(1010, '10001280', 'CR_AG_25-100693', '16920', '19965', '3045', '18.00', NULL, NULL, '90', '20', 1, 'Danu', 1, '2025-02-03 18:01:14', '2025-02-05 03:20:15'),
(1011, '10001280', 'CR_AG_25-100694', '15300', '15320', '20', '0.13', NULL, NULL, '90', '20', 1, 'Danu', 1, '2025-02-03 18:01:14', '2025-02-05 03:20:15'),
(1012, '10001280', 'CR_AG_25-100015', '20530', '20505', '-25', '-0.12', NULL, NULL, '90', '54', 1, 'Danu', 1, '2025-02-03 18:01:14', '2025-02-05 03:20:15'),
(1025, '10001311', 'CR_AG_25-100181', '11570', '11575', '5', '0.04', NULL, NULL, '78', '40', 2, 'Dika', 1, '2025-02-04 07:12:25', '2025-02-06 01:33:16'),
(1026, '10001311', 'CR_AG_25-100182', '15800', '15805', '5', '0.03', NULL, NULL, '78', '90', 2, 'Dika', 1, '2025-02-04 07:12:25', '2025-02-06 01:33:16'),
(1027, '10001311', 'CR_AG_25-100190', '11180', '11180', '0', '0.00', NULL, NULL, '78', '90', 2, 'Dika', 1, '2025-02-04 07:12:25', '2025-02-06 01:33:16'),
(1028, '10001311', 'CR_AG_25-100290', '17170', '17200', '30', '0.17', NULL, NULL, '78', '90', 2, 'Dika', 1, '2025-02-04 07:12:25', '2025-02-06 01:33:16'),
(1029, '10001311', 'CR_AG_25-100191', '11480', '11455', '-25', '-0.22', NULL, NULL, '78', '38', 2, 'Dika', 1, '2025-02-04 07:12:25', '2025-02-06 01:33:16'),
(1030, '10001311', 'CR_AG_25-100409', '17170', '17150', '-20', '-0.12', NULL, NULL, '78', '78', 2, 'Dika', 1, '2025-02-04 07:12:25', '2025-02-06 01:33:16'),
(1031, '1001324', 'CR_AG_25-100416', '17340', '17355', '15', '0.09', NULL, NULL, '20', '76', 3, 'Dika', 1, '2025-02-04 08:35:30', '2025-02-06 01:33:36'),
(1032, '1001324', 'CR_AG_25-100413', '17920', '17965', '45', '0.25', NULL, NULL, '20', '76', 3, 'Dika', 1, '2025-02-04 08:35:30', '2025-02-06 01:33:36'),
(1033, '1001324', 'CR_AG_25-100412', '17830', '17865', '35', '0.20', NULL, NULL, '20', '76', 3, 'Dika', 1, '2025-02-04 08:35:30', '2025-02-06 01:33:36'),
(1034, '1001324', 'CR_AG_25-100411', '17390', '17360', '-30', '-0.17', NULL, NULL, '20', '78', 3, 'Dika', 1, '2025-02-04 08:35:30', '2025-02-06 01:33:36'),
(1035, '1001324', 'CR_AG_25-100410', '17120', '17110', '-10', '-0.06', NULL, NULL, '20', '78', 3, 'Dika', 1, '2025-02-04 08:35:30', '2025-02-06 01:33:36'),
(1036, '10001353', 'CR_AG_25-100767', '17800', '17870', '70', '0.39', NULL, NULL, '43', '43', 2, 'Freddy', 1, '2025-02-05 01:14:04', '2025-02-05 03:23:08'),
(1037, '10001353', 'CR_AG_25-100768', '17740', '17780', '40', '0.23', NULL, NULL, '43', '43', 2, 'Freddy', 1, '2025-02-05 01:14:05', '2025-02-05 03:23:08'),
(1068, '1001370', 'CR_AG_25-100417', '17630', '17680', '50', '0.28', NULL, NULL, '76', '64', 3, 'Dika', 1, '2025-02-05 09:56:05', '2025-05-29 08:34:02'),
(1069, '1001370', 'CR_AG_25-100419', '17290', '17355', '65', '0.38', NULL, NULL, '76', '64', 3, 'Dika', 1, '2025-02-05 09:56:05', '2025-05-29 08:34:02'),
(1070, '1001370', 'CR_AG_25-100426', '17540', '17535', '-5', '-0.03', NULL, NULL, '76', '64', 3, 'Dika', 1, '2025-02-05 09:56:05', '2025-05-29 08:34:02'),
(1071, '1001370', 'CR_AG_25-100427', '17980', '17990', '10', '0.06', NULL, NULL, '76', '64', 3, 'Dika', 1, '2025-02-05 09:56:05', '2025-05-29 08:34:02'),
(1072, '1001370', 'CR_AG_25-100428', '17780', '17780', '0', '0.00', NULL, NULL, '76', '67', 3, 'Dika', 1, '2025-02-05 09:56:05', '2025-05-29 08:34:02'),
(1073, '1001370', 'CR_AG_25-100431', '17430', '17440', '10', '0.06', NULL, NULL, '76', '67', 3, 'Dika', 1, '2025-02-05 09:56:05', '2025-05-29 08:34:02'),
(1074, '1001370', 'CR_AG_25-100432', '17600', '17610', '10', '0.06', NULL, NULL, '76', '43', 3, 'Dika', 1, '2025-02-05 09:56:05', '2025-05-29 08:34:02'),
(1075, '1001370', 'CR_AG_25-100433', '17930', '17980', '50', '0.28', NULL, NULL, '76', '43', 3, 'Dika', 1, '2025-02-05 09:56:05', '2025-05-29 08:34:02'),
(1076, '1001370', 'CR_AG_25-100478', '17940', NULL, NULL, NULL, NULL, NULL, '76', NULL, 3, 'Dika', 1, '2025-02-05 09:56:05', '2025-05-29 08:34:02'),
(1077, '1001370', 'CR_AG_25-100681', '16910', '16890', '-20', '-0.12', NULL, NULL, '76', '64', 3, 'Dika', 1, '2025-02-05 09:56:05', '2025-05-29 08:34:02'),
(1078, '1001370', 'CR_AG_25-100687', '17680', NULL, NULL, NULL, NULL, NULL, '76', NULL, 3, 'Dika', 1, '2025-02-05 09:56:05', '2025-05-29 08:34:02'),
(1079, '1003174', 'CR_AG_25-100769', '17600', '17635', '35', '0.20', NULL, NULL, '20', '20', 3, 'Dika', 1, '2025-02-05 11:44:36', '2025-02-06 06:13:51'),
(1080, '1003174', 'CR_AG_25-100770', '17560', '17560', '0', '0.00', NULL, NULL, '20', '20', 3, 'Dika', 1, '2025-02-05 11:44:36', '2025-02-06 06:13:51'),
(1081, '10001380', 'CR_AG_25-100772', '17170', '17205', '35', '0.20', NULL, NULL, '20', '64', 3, 'Dika', NULL, '2025-02-05 13:31:34', '2025-02-05 18:56:22'),
(1082, '10001380', 'CR_AG_25-100771', '17200', '17225', '25', '0.15', NULL, NULL, '20', '20', 3, 'Dika', NULL, '2025-02-05 13:31:34', '2025-02-05 13:40:36'),
(1083, '10001380', 'CR_AG_25-100746', '22790', NULL, NULL, NULL, NULL, NULL, '20', NULL, 3, 'Dika', NULL, '2025-02-05 13:31:34', '2025-02-05 13:31:34'),
(1084, '10001380', 'CR_AG_25-100741', '18580', NULL, NULL, NULL, NULL, NULL, '20', NULL, 3, 'Dika', NULL, '2025-02-05 13:31:34', '2025-02-05 13:31:34'),
(1085, '10001380', 'CR_AG_25-100739', '22730', NULL, NULL, NULL, NULL, NULL, '20', NULL, 3, 'Dika', NULL, '2025-02-05 13:31:34', '2025-02-05 13:31:34'),
(1086, '10001380', 'CR_AG_25-100738', '22590', NULL, NULL, NULL, NULL, NULL, '20', NULL, 3, 'Dika', NULL, '2025-02-05 13:31:34', '2025-02-05 13:31:34'),
(1087, '10001380', 'CR_AG_25-100737', '22160', NULL, NULL, NULL, NULL, NULL, '20', NULL, 3, 'Dika', NULL, '2025-02-05 13:31:34', '2025-02-05 13:31:34'),
(1088, '10001380', 'CR_AG_25-100736', '22320', NULL, NULL, NULL, NULL, NULL, '20', NULL, 3, 'Dika', NULL, '2025-02-05 13:31:34', '2025-02-05 13:31:34'),
(1089, '10001380', 'CR_AG_25-100734', '22040', NULL, NULL, NULL, NULL, NULL, '20', NULL, 3, 'Dika', NULL, '2025-02-05 13:31:34', '2025-02-05 13:31:34'),
(1090, '10001380', 'CR_AG_25-100688', '16710', NULL, NULL, NULL, NULL, NULL, '20', NULL, 3, 'Dika', NULL, '2025-02-05 13:31:34', '2025-02-05 13:31:34'),
(1091, '10001384', 'CR_AG_25-100773', '17980', '17990', '10', '0.06', NULL, NULL, '38', '38', 1, 'Riyan H', 1, '2025-02-05 21:16:15', '2025-02-06 06:14:21'),
(1092, '10001384', 'CR_AG_25-100777', '17320', '17280', '-40', '-0.23', NULL, NULL, '38', '38', 1, 'Riyan H', 1, '2025-02-05 21:16:15', '2025-02-06 06:14:21'),
(1093, '10001389', 'CR_AG_25-100798', '17720', '17695', '-25', '-0.14', NULL, NULL, '38', '38', 2, 'Danu', 1, '2025-02-06 00:47:04', '2025-02-06 06:16:24'),
(1096, '10001416', 'CR_AG_25-100761', '16270', '20000', '3730', '22.93', NULL, NULL, '78', '14', 3, 'Freddy', 1, '2025-02-06 08:24:13', '2025-05-29 08:32:42');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengecekan`
--

CREATE TABLE `pengecekan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `awal_muat` time DEFAULT NULL,
  `awal_muat1` time DEFAULT NULL,
  `tgl_gs` date DEFAULT NULL,
  `customer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kota_negara` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lantai` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dinding` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pengunci_kontainer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sapu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vacum` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disemprot` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `choke` int(11) DEFAULT NULL,
  `stopper` int(11) DEFAULT NULL,
  `silica_gel` int(11) DEFAULT NULL,
  `fumigasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `selesai_muat` time DEFAULT NULL,
  `no_mobil` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_container` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tonase_tare` decimal(8,2) DEFAULT NULL,
  `cuaca` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kondisi_ban` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kondisi_lantai` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rantai_webbing` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tonase` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `terpal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sling` int(11) DEFAULT NULL,
  `tare` int(11) DEFAULT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `signature` text COLLATE utf8mb4_unicode_ci,
  `signature1` text COLLATE utf8mb4_unicode_ci,
  `checker` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `no_gs` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pegawai` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pembeda` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ekspedisi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `pengecekan`
--

INSERT INTO `pengecekan` (`id`, `awal_muat`, `awal_muat1`, `tgl_gs`, `customer`, `kota_negara`, `lantai`, `dinding`, `pengunci_kontainer`, `sapu`, `vacum`, `disemprot`, `choke`, `stopper`, `silica_gel`, `fumigasi`, `selesai_muat`, `no_mobil`, `no_container`, `tonase_tare`, `cuaca`, `kondisi_ban`, `kondisi_lantai`, `rantai_webbing`, `tonase`, `terpal`, `sling`, `tare`, `catatan`, `signature`, `signature1`, `checker`, `created_at`, `updated_at`, `no_gs`, `pegawai`, `pembeda`, `ekspedisi`) VALUES
(104, '08:47:00', '09:05:00', '2024-12-16', 'BEST SHEDS PTY LTD', 'AUS', 'kurang_bagus', 'kurang_bagus', '<4_pengunci', 'sudah', 'sudah', 'sudah', 14, 12, 10, 'sudah', '09:34:00', 'B9001WEH', 'CSNU1553931', '24524.00', 'hujan', 'kurang bagus', '-', '-', '-', '-', 14, 2185, '-', 'storage/signatures/signature_1734327472.png', 'storage/signatures/1/signature1_1734327474.png', 'An Didi', '2024-12-15 19:04:53', '2024-12-15 22:39:09', 'GSX24-100838', 'Panggah S', 'container', 'EUROSPEED'),
(105, '13:31:00', '13:30:00', '2024-12-16', 'BEST SHEDS', 'AUS', 'bagus', 'bagus', '<4_pengunci', 'sudah', 'sudah', 'sudah', 10, 6, 10, 'sudah', '13:43:00', 'B9023TEJ', 'OOLU0552326', '22940.00', 'berawan', 'bagus', '-', '-', '-', '-', 14, 2190, '-', 'storage/signatures/signature_1734345766.png', 'storage/signatures/1/signature1_1734345766.png', 'An Didi', '2024-12-15 19:04:53', '2024-12-16 03:43:20', 'GSX24-100839', 'Panggah S', 'container', 'EUROSPEED'),
(106, '09:27:00', '21:40:00', '2024-12-16', 'BEST SHEDS', 'AUS', 'bagus', 'kurang_bagus', '4_pengunci', 'sudah', 'sudah', 'sudah', 12, 8, 10, 'sudah', '09:58:00', 'B9788UEM', 'CSNU1582966', '23550.00', 'hujan', 'bagus', '-', '-', '-', '-', 14, 2185, '-', 'storage/signatures/signature_1734327757.png', 'storage/signatures/1/signature1_1734327757.png', 'An Didi', '2024-12-15 19:04:53', '2024-12-15 22:42:37', 'GSX24-100840', 'Panggah S', 'container', 'EUROSPEED'),
(107, '09:55:00', '10:05:00', '2024-12-16', 'BEST SHEDS', 'AUS', 'kurang_bagus', 'bagus', '<4_pengunci', 'sudah', 'sudah', 'sudah', 12, 8, 10, 'sudah', '10:26:00', 'BE8351BY', 'OOLU1807930', '23994.00', 'berawan', 'bagus', '-', '-', '-', '-', 14, 2310, '-', 'storage/signatures/signature_1734328022.png', 'storage/signatures/1/signature1_1734328022.png', 'An Didi', '2024-12-15 19:04:53', '2024-12-15 22:47:02', 'GSX24-100841', 'Panggah S', 'container', 'EUROSPEED'),
(108, '10:09:00', '10:24:00', '2024-12-16', 'BEST SHEDS', 'AUS', 'kurang_bagus', 'kurang_bagus', '4_pengunci', 'sudah', 'sudah', 'sudah', 14, 8, 10, 'sudah', '10:52:00', 'B9221BEI', 'CSNU1166043', '22700.00', 'hujan', 'kurang bagus', '-', '-', '-', '-', 14, 2160, '-', 'storage/signatures/signature_1734328301.png', 'storage/signatures/1/signature1_1734328301.png', 'An Didi', '2024-12-15 19:04:53', '2024-12-15 22:52:11', 'GSX24-100842', 'Panggah S', 'container', 'EUROSPEED'),
(109, '10:50:00', '11:00:00', '2024-12-16', 'BEST SHEDS', 'AUS', 'bagus', 'bagus', '4_pengunci', 'sudah', 'sudah', 'sudah', 14, 8, 10, 'sudah', '11:25:00', 'BE8545AMC', 'TLLU3346647', '24559.00', 'hujan', 'bagus', '-', '-', '-', '-', 16, 2100, '-', 'storage/signatures/signature_1734328616.png', 'storage/signatures/1/signature1_1734328616.png', 'An Didi', '2024-12-15 19:04:53', '2024-12-15 22:56:56', 'GSX24-100843', 'Panggah S', 'container', 'EUROSPEED'),
(110, '11:21:00', '11:30:00', '2024-12-16', 'BEST SHEDS', 'AUS', 'bagus', 'kurang_bagus', '4_pengunci', 'sudah', 'sudah', 'sudah', 12, 6, 10, 'sudah', '13:30:00', 'B9398XQ', 'CSNU1413837', '24030.00', 'berawan', 'bagus', '-', '-', '-', '-', 12, 2185, '1076-2 dan 1077-2 Satu Packaging', 'storage/signatures/signature_1734345435.png', 'storage/signatures/1/signature1_1734345436.png', 'An Didi', '2024-12-15 19:04:53', '2024-12-16 03:37:16', 'GSX24-100844', 'Panggah S', 'container', 'EUROSPEED'),
(111, '13:38:00', '13:43:00', '2024-12-16', 'BEST SHEDS', 'AUS', 'bagus', 'kurang_bagus', '4_pengunci', 'sudah', 'sudah', 'sudah', 12, 2, 10, 'sudah', '14:14:00', 'B9137UIV', 'BMOU1593052', '22016.00', 'berawan', 'bagus', '-', '-', '-', '-', 10, 2100, '1078-2 &1079-2 Satu Packaging di Line 2', 'storage/signatures/signature_1734346066.png', 'storage/signatures/1/signature1_1734346066.png', 'An Didi', '2024-12-15 19:04:53', '2024-12-16 03:47:46', 'GSX24-100845', 'Panggah S', 'container', 'EUROSPEED'),
(112, '14:00:00', '14:05:00', '2024-12-16', 'BEST SHEDS', 'AUS', 'bagus', 'kurang_bagus', '<4_pengunci', 'sudah', 'sudah', 'sudah', 10, 0, 10, 'sudah', '14:40:00', 'B9423UIV', 'TLLU2999858', '21236.00', 'hujan', 'bagus', '-', '-', '-', '-', 10, 2100, '1080-2 & 1083-2 Satu Packaging', 'storage/signatures/signature_1734346493.png', 'storage/signatures/1/signature1_1734346493.png', 'An Didi', '2024-12-15 19:04:53', '2024-12-16 03:54:53', 'GSX24-100846', 'Panggah S', 'container', 'EUROSPEED'),
(113, '14:23:00', '14:36:00', '2024-12-16', 'BEST SHEDS', 'AUS', 'bagus', 'bagus', '4_pengunci', 'sudah', 'sudah', 'sudah', 11, 3, 10, 'sudah', '15:25:00', 'B9322UIW', 'CSNU1597729', '23917.00', 'berawan', 'kurang bagus', '-', '-', '-', '-', 14, 2185, '1086-2 &1091-2 Satu Packaging Line 1, 1084-2 & 1085-2 Satu Packaging Line 2', 'storage/signatures/signature_1734347814.png', 'storage/signatures/1/signature1_1734347814.png', 'An Didi', '2024-12-15 19:04:53', '2024-12-16 04:16:54', 'GSX24-100847', 'Panggah S', 'container', 'EUROSPEED'),
(114, '15:13:00', '15:18:00', '2024-12-16', 'BEST SHEDS', 'AUS', 'bagus', 'bagus', '4_pengunci', 'sudah', 'sudah', 'sudah', 10, 2, 10, 'sudah', '14:38:00', 'B9136UIV', 'DFSU1627386', '21403.00', 'berawan', 'bagus', '-', '-', '-', '-', 12, 2160, '1087-2 & 1088-2 Satu Packaging di Line 3', 'storage/signatures/signature_1734348238.png', 'storage/signatures/1/signature1_1734348238.png', 'An Didi', '2024-12-15 19:04:53', '2024-12-16 04:23:58', 'GSX24-100848', 'Panggah S', 'container', 'EUROSPEED'),
(115, '15:40:00', '15:45:00', '2024-12-16', 'BEST SHEDS', 'AUS', 'kurang_bagus', 'kurang_bagus', '4_pengunci', 'sudah', 'sudah', 'sudah', 10, 2, 10, 'sudah', '16:16:00', 'B9141UIV', 'OOLU0318468', '22008.00', 'berawan', 'bagus', '-', '-', '-', '-', 12, 2170, '1089-2 & 1090-2 Satu Packaging di Line 1', 'storage/signatures/signature_1734348496.png', 'storage/signatures/1/signature1_1734348496.png', 'An Didi', '2024-12-15 19:04:53', '2024-12-16 04:28:16', 'GSX24-100849', 'Panggah S', 'container', 'EUROSPEED'),
(116, '15:58:00', '16:08:00', '2024-12-16', 'BEST SHEDS', 'AUS', 'bagus', 'kurang_bagus', '<4_pengunci', 'sudah', 'sudah', 'sudah', 12, 8, 10, 'sudah', '15:29:00', 'B9787PEH', 'CSNU2032970', '24523.00', 'berawan', 'bagus', '-', '-', '-', '-', 14, 2185, '1092-2 & 1108-2 Satu Packaging di Line 5', 'storage/signatures/signature_1734348900.png', 'storage/signatures/1/signature1_1734348900.png', 'An Didi', '2024-12-15 19:04:53', '2024-12-16 04:35:00', 'GSX24-100850', 'Panggah S', 'container', 'EUROSPEED'),
(117, '16:25:00', '16:33:00', '2024-12-16', 'BEST SHEDS', 'AUS', 'bagus', 'kurang_bagus', '4_pengunci', 'sudah', 'sudah', 'sudah', 12, 8, 10, 'sudah', '17:05:00', 'BE8020AMB', 'CSNU1947576', '24743.00', 'berawan', 'bagus', '-', '-', '-', '-', 14, 2185, '1111-2 & 1112-2 Satu Packaging di Line 3, 1109-2 & 1110-2 Satu Packaging di Line 4', 'storage/signatures/signature_1734349196.png', 'storage/signatures/1/signature1_1734349196.png', 'An Didi', '2024-12-15 19:04:53', '2024-12-16 04:39:56', 'GSX24-100851', 'Panggah S', 'container', 'EUROSPEED'),
(118, '16:41:00', '17:01:00', '2024-12-16', 'BEST SHEDS', 'AUS', 'kurang_bagus', 'kurang_bagus', '4_pengunci', 'sudah', 'sudah', 'sudah', 10, 4, 10, 'sudah', '17:25:00', 'B9878UWY', 'OOLU0711109', '22021.00', 'berawan', 'kurang bagus', '-', '-', '-', '-', 12, 2160, '1095-2 & 1114-2 Satu Packaging di Line 1, 1097-2 & 1098-2 Satu Packaging di Line 3', 'storage/signatures/signature_1734349472.png', 'storage/signatures/1/signature1_1734349472.png', 'An Didi', '2024-12-15 19:04:53', '2024-12-16 04:44:32', 'GSX24-100852', 'Panggah S', 'container', 'EUROSPEED'),
(119, '17:10:00', '17:26:00', '2024-12-16', 'Best Sheds', 'Aus', 'kurang_bagus', 'kurang_bagus', '<4_pengunci', 'sudah', 'sudah', 'sudah', 10, 4, 10, 'sudah', '19:39:00', 'B9025JG', 'CSNU1687268', '23779.00', 'berawan', 'kurang bagus', '-', '-', '-', '-', 12, 2185, '1099-2 dan 1100 -2 Satu Packaging di line 4', 'storage/signatures/signature_1735014781.png', 'storage/signatures/1/signature1_1735014781.png', 'An Didi', '2024-12-15 19:04:53', '2024-12-24 04:34:25', 'GSX24-100853', 'Panggah S', 'container', 'EUROSPEED'),
(120, '19:10:00', '19:20:00', '2024-12-16', 'BEST SHEDS', 'AUS', 'kurang_bagus', 'kurang_bagus', '<4_pengunci', 'sudah', 'sudah', 'sudah', 10, 2, 10, 'sudah', '19:40:00', 'B9824UEM', 'CSLU1918210', '23662.00', 'berawan', 'kurang bagus', '-', '-', '-', '-', 12, 2185, '1102-2&1103-2 Satu Packaging di Line 4', 'storage/signatures/signature_1735030489.png', 'storage/signatures/1/signature1_1735030489.png', 'An Didi', '2024-12-15 19:04:53', '2024-12-24 08:54:49', 'GSX24-100854', 'Michael', 'container', 'EUROSPEED'),
(121, '19:30:00', '19:37:00', '2024-12-16', 'BEST SHEDS', 'AUS', 'kurang_bagus', 'kurang_bagus', '4_pengunci', 'sudah', 'sudah', 'sudah', 10, 2, 10, 'sudah', '19:56:00', 'B9089JK', 'TLLU3287170', '23052.00', 'berawan', 'kurang bagus', '-', '-', '-', '-', 12, 2100, '1006-2 & 1107-2 Satu Packaging di Line 1, 1104-2 &1105-2 Satu Packaging di Line 3', 'storage/signatures/signature_1735030206.png', 'storage/signatures/1/signature1_1735030208.png', 'An Didi', '2024-12-15 19:04:53', '2024-12-24 08:50:08', 'GSX24-100855', 'Michael', 'container', 'EUROSPEED'),
(122, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-05-28 19:50:12', '2025-05-28 19:50:12', 'gsbaruu', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rekap`
--

CREATE TABLE `rekap` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `packing` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attribute` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_so` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `layout` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `net` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gross` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `length` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `checks` int(11) DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rekap`
--

INSERT INTO `rekap` (`id`, `packing`, `attribute`, `no_so`, `layout`, `desc`, `net`, `gross`, `length`, `type`, `checks`, `keterangan`, `created_at`, `updated_at`) VALUES
(11, 'YES', 'CI24-111242', 'SOX24-24084', 'K1', '1.45mm x 1035mm Z450 G500 NEXIUM® PASSIVATION', '4565', '4655', '381', 'Eye To Side', 1, NULL, '2024-11-28 01:26:59', '2024-12-19 04:29:31'),
(12, 'YES', 'CI24-111241', 'SOX24-24084', 'K1', '1.45mm x 1035mm Z450 G500 NEXIUM® PASSIVATION', '4534', '4624', '378', 'Eye To Side', 1, NULL, '2024-11-28 01:26:59', '2024-12-19 04:31:11'),
(13, 'YES', 'CI24-111240', 'SOX24-24084', 'K1', '1.45mm x 1035mm Z450 G500 NEXIUM® PASSIVATION', '4587', '4677', '382', 'Eye To Side', 1, NULL, '2024-11-28 01:26:59', '2024-12-19 04:35:57'),
(14, NULL, 'CI24-111239', 'SOX24-24084', 'K1', '1.45mm x 1035mm Z450 G500 NEXIUM® PASSIVATION', '4587', '4677', '382', 'Eye To Side', 1, NULL, '2024-11-28 01:26:59', '2024-12-19 04:35:14'),
(15, 'YES', 'CI24-111238', 'SOX24-24084', 'k1', '1.45mm x 1035mm Z450 G500 NEXIUM® PASSIVATION', '4587', '4677', '382', 'Eye To Side', NULL, NULL, '2024-11-28 01:26:59', '2024-12-24 04:50:11'),
(16, 'YES', 'CI24-111237', 'SOX24-24084', 'K2', '1.45mm x 1035mm Z450 G500 NEXIUM® PASSIVATION', '4587', '4677', '382', 'Eye To Side', NULL, NULL, '2024-11-28 01:26:59', '2025-05-15 15:45:20'),
(17, 'YES', 'CI24-111236', 'SOX24-24084', 'K2', '1.45mm x 1035mm Z450 G500 NEXIUM® PASSIVATION', '4587', '4677', '382', 'Eye To Side', NULL, NULL, '2024-11-28 01:26:59', '2025-05-28 13:02:56'),
(18, NULL, 'CI24-111235', 'SOX24-24084', 'K2', '1.45mm x 1035mm Z450 G500 NEXIUM® PASSIVATION', '4587', '4677', '382', 'Eye To Side', NULL, NULL, '2024-11-28 01:26:59', '2024-11-28 01:26:59'),
(19, NULL, 'CI24-111234', 'SOX24-24084', 'K2', '1.45mm x 1035mm Z450 G500 NEXIUM® PASSIVATION', '4587', '4677', '382', 'Eye To Side', NULL, NULL, '2024-11-28 01:26:59', '2024-11-28 01:26:59'),
(20, 'YES', 'CI24-111233', 'SOX24-24084', 'K2', '1.45mm x 1035mm Z450 G500 NEXIUM® PASSIVATION', '4587', '4677', '382', 'Eye To Side', 1, NULL, '2024-11-28 01:26:59', '2024-12-24 04:42:41'),
(21, NULL, 'CL24-112718', 'SOX24-24112', 'K1', '0.45 x 1219mm AZ150 G300 NEXALUME® Clear Resin', '3647', '3737', '820', 'Eye To Rear', 1, 'VCI Paper Nexalume, Tanpa Impraboard, Eye To Rear', '2024-12-24 02:43:45', '2024-12-24 03:56:21'),
(22, 'YES', 'CL24-112719', 'SOX24-24112', 'K1', '0.45 x 1219mm AZ150 G300 NEXALUME® Clear Resin', '3563', '3653', '800', 'Eye To Rear', 1, 'VCI Paper Nexalume, Tanpa Impraboard, Eye To Rear', '2024-12-24 02:43:45', '2024-12-24 04:35:14'),
(23, 'YES', 'CL24-112720', 'SOX24-24112', 'K1', '0.45 x 1219mm AZ150 G300 NEXALUME® Clear Resin', '3554', '3644', '800', 'Eye To Rear', 1, 'VCI Paper Nexalume, Tanpa Impraboard, Eye To Rear', '2024-12-24 02:43:45', '2024-12-24 04:11:33'),
(24, NULL, 'CL24-112721', 'SOX24-24112', 'K1', '0.45 x 1219mm AZ150 G300 NEXALUME® Clear Resin', '3563', '3653', '800', 'Eye To Rear', 1, 'VCI Paper Nexalume, Tanpa Impraboard, Eye To Rear', '2024-12-24 02:43:45', '2024-12-24 04:06:36'),
(25, 'YES', 'CL24-112722', 'SOX24-24112', 'K1', '0.45 x 1219mm AZ150 G300 NEXALUME® Clear Resin', '3559', '3649', '800', 'Eye To Rear', 1, 'VCI Paper Nexalume, Tanpa Impraboard, Eye To Rear', '2024-12-24 02:43:45', '2024-12-24 04:01:19'),
(26, NULL, 'CL24-112723', 'SOX24-24112', 'K2', '0.45 x 1219mm AZ150 G300 NEXALUME® Clear Resin', '4062', '4152', '912', 'Eye To Rear', 1, 'VCI Paper Nexalume, Tanpa Impraboard, Eye To Rear', '2024-12-24 02:43:45', '2024-12-24 03:56:55'),
(27, NULL, 'CL24-112724', 'SOX24-24112', 'K2', '0.45 x 1219mm AZ150 G300 NEXALUME® Clear Resin', '3875', '3965', '870', 'Eye To Rear', 1, 'VCI Paper Nexalume, Tanpa Impraboard, Eye To Rear', '2024-12-24 02:43:45', '2024-12-24 03:56:59'),
(28, NULL, 'CL24-112725', 'SOX24-24112', 'K2', '0.45 x 1219mm AZ150 G300 NEXALUME® Clear Resin', '3876', '3966', '870', 'Eye To Rear', 1, 'VCI Paper Nexalume, Tanpa Impraboard, Eye To Rear', '2024-12-24 02:43:45', '2024-12-24 03:57:05'),
(29, NULL, 'CL24-112726', 'SOX24-24112', 'K2', '0.45 x 1219mm AZ150 G300 NEXALUME® Clear Resin', '3876', '3966', '870', 'Eye To Rear', 1, 'VCI Paper Nexalume, Tanpa Impraboard, Eye To Rear', '2024-12-24 02:43:45', '2024-12-24 04:07:20'),
(30, NULL, 'CL24-112727', 'SOX24-24112', 'K2', '0.45 x 1219mm AZ150 G300 NEXALUME® Clear Resin', '3877', '3967', '870', 'Eye To Rear', 1, 'VCI Paper Nexalume, Tanpa Impraboard, Eye To Rear', '2024-12-24 02:43:45', '2024-12-24 04:07:27'),
(31, NULL, 'CL24-112728', 'SOX24-24112', 'K3', '0.45 x 1219mm AZ150 G300 NEXALUME® Clear Resin', '3876', '3966', '870', 'Eye To Rear', 1, 'VCI Paper Nexalume, Tanpa Impraboard, Eye To Rear', '2024-12-24 02:43:45', '2024-12-24 04:03:17'),
(32, NULL, 'CL24-112729', 'SOX24-24112', 'K3', '0.45 x 1219mm AZ150 G300 NEXALUME® Clear Resin', '3755', '3845', '843', 'Eye To Rear', 1, 'VCI Paper Nexalume, Tanpa Impraboard, Eye To Rear', '2024-12-24 02:43:45', '2024-12-24 04:07:43'),
(33, NULL, 'CL24-112730', 'SOX24-24112', 'K3', '0.45 x 1219mm AZ150 G300 NEXALUME® Clear Resin', '3652', '3742', '820', 'Eye To Rear', 1, 'VCI Paper Nexalume, Tanpa Impraboard, Eye To Rear', '2024-12-24 02:43:45', '2024-12-24 04:07:53'),
(34, NULL, 'CL24-112731', 'SOX24-24112', 'K3', '0.45 x 1219mm AZ150 G300 NEXALUME® Clear Resin', '3649', '3739', '820', 'Eye To Rear', 1, 'VCI Paper Nexalume, Tanpa Impraboard, Eye To Rear', '2024-12-24 02:43:45', '2024-12-24 04:08:01'),
(35, NULL, 'CL24-112732', 'SOX24-24112', 'K3', '0.45 x 1219mm AZ150 G300 NEXALUME® Clear Resin', '3648', '3738', '820', 'Eye To Rear', 1, 'VCI Paper Nexalume, Tanpa Impraboard, Eye To Rear', '2024-12-24 02:43:45', '2024-12-24 04:08:11'),
(36, NULL, 'CL24-112733', 'SOX24-24112', 'K4', '0.45 x 1219mm AZ150 G300 NEXALUME® Clear Resin', '3647', '3737', '820', 'Eye To Rear', 1, 'VCI Paper Nexalume, Tanpa Impraboard, Eye To Rear', '2024-12-24 02:43:45', '2024-12-24 04:08:19'),
(37, NULL, 'CL24-112734', 'SOX24-24112', 'K4', '0.45 x 1219mm AZ150 G300 NEXALUME® Clear Resin', '3647', '3737', '820', 'Eye To Rear', 1, 'VCI Paper Nexalume, Tanpa Impraboard, Eye To Rear', '2024-12-24 02:43:45', '2024-12-24 04:08:27'),
(38, NULL, 'CL24-112735', 'SOX24-24112', 'K4', '0.45 x 1219mm AZ150 G300 NEXALUME® Clear Resin', '3809', '3899', '855', 'Eye To Rear', 1, 'VCI Paper Nexalume, Tanpa Impraboard, Eye To Rear', '2024-12-24 02:43:45', '2024-12-24 04:08:35'),
(39, NULL, 'CL24-112736', 'SOX24-24112', 'K4', '0.45 x 1219mm AZ150 G300 NEXALUME® Clear Resin', '3640', '3730', '830', 'Eye To Rear', 1, 'VCI Paper Nexalume, Tanpa Impraboard, Eye To Rear', '2024-12-24 02:43:45', '2024-12-24 04:08:50'),
(40, NULL, 'CL24-112737', 'SOX24-24112', 'K4', '0.45 x 1219mm AZ150 G300 NEXALUME® Clear Resin', '3640', '3730', '830', 'Eye To Rear', NULL, 'VCI Paper Nexalume, Tanpa Impraboard, Eye To Rear', '2024-12-24 02:43:45', '2024-12-24 02:43:45');

-- --------------------------------------------------------

--
-- Table structure for table `resin`
--

CREATE TABLE `resin` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `shift_leader` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `supplier` json NOT NULL,
  `jenis` varchar(255) DEFAULT NULL,
  `cuaca` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `sesuai` varchar(255) DEFAULT NULL,
  `kering` varchar(255) DEFAULT NULL,
  `jumlahin` varchar(255) DEFAULT NULL,
  `drum` varchar(255) DEFAULT NULL,
  `keterangan1` varchar(255) DEFAULT NULL,
  `keterangan3` varchar(255) DEFAULT NULL,
  `keterangan5` varchar(255) DEFAULT NULL,
  `keterangan6` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resin`
--

INSERT INTO `resin` (`id`, `user_id`, `shift_leader`, `date`, `time`, `supplier`, `jenis`, `cuaca`, `keterangan`, `sesuai`, `kering`, `jumlahin`, `drum`, `keterangan1`, `keterangan3`, `keterangan5`, `keterangan6`, `created_at`, `updated_at`) VALUES
(3, 46, '236-24', '2024-12-13', '10:57:00', '[\"Metal Coat\"]', 'RESIN', 'Cerah', NULL, 'sesuai', 'Kering/Tidak kena air', 'Sesuai', 'Sesuai', NULL, NULL, NULL, NULL, '2024-12-13 02:42:45', '2024-12-13 02:42:45'),
(4, 46, '237-24', '2024-12-13', '10:56:00', '[\"Metal Coat\"]', 'RESIN', 'Cerah', NULL, 'sesuai', 'Kering/Tidak kena air', 'Sesuai', 'Sesuai', NULL, NULL, NULL, NULL, '2024-12-13 02:43:13', '2024-12-13 02:43:13'),
(5, 29, '016-25', '2025-01-23', '10:07:00', '[\"Metal Coat\"]', 'RESIN', 'Cerah', NULL, 'sesuai', 'Kering/Tidak kena air', 'Sesuai', 'Sesuai', NULL, NULL, NULL, NULL, '2025-01-23 03:07:49', '2025-01-23 03:07:49'),
(6, 29, '0017-25', '2025-01-25', '10:42:00', '[\"Metal Coat\"]', 'RESIN', 'Cerah', NULL, 'sesuai', 'Kering/Tidak kena air', 'Sesuai', 'Sesuai', NULL, NULL, NULL, NULL, '2025-01-25 03:42:23', '2025-01-25 03:42:23'),
(7, 29, '0018-25', '2025-01-25', '10:42:00', '[\"Metal Coat\"]', 'RESIN', 'Cerah', NULL, 'sesuai', 'Kering/Tidak kena air', 'Sesuai', 'Sesuai', NULL, NULL, NULL, NULL, '2025-01-25 03:42:58', '2025-01-25 03:42:58'),
(8, 77, '0019-25', '2025-01-30', '14:00:00', '[\"Metal Coat\"]', NULL, 'Cerah', NULL, 'sesuai', NULL, 'Sesuai', 'Sesuai', NULL, NULL, NULL, NULL, '2025-01-30 07:37:38', '2025-01-30 07:37:38'),
(9, 31, '0102022501-2785', '2025-01-30', '16:06:00', '[\"Inkote\"]', 'RESIN', 'Cerah', NULL, 'sesuai', 'Kering/Tidak kena air', NULL, 'Sesuai', NULL, NULL, NULL, NULL, '2025-01-30 09:07:01', '2025-01-30 09:07:01'),
(10, 29, '0022-25', '2025-02-01', '10:29:00', '[\"Metal Coat\"]', 'RESIN', 'Cerah', NULL, 'sesuai', 'Kering/Tidak kena air', 'Sesuai', 'Sesuai', NULL, NULL, NULL, NULL, '2025-02-01 03:29:27', '2025-02-01 03:29:27'),
(11, 29, '0023-25', '2025-02-05', '17:04:00', '[\"Metal Coat\"]', 'RESIN', 'Cerah', NULL, 'sesuai', 'Kering/Tidak kena air', 'Sesuai', 'Sesuai', NULL, NULL, NULL, NULL, '2025-02-05 10:04:51', '2025-02-05 10:04:51'),
(12, 31, '0102022502-0581', '2025-02-06', '13:49:00', '[\"Inkote\"]', 'RESIN', 'Cerah', NULL, 'sesuai', 'Kering/Tidak kena air', 'Sesuai', 'Sesuai', NULL, NULL, NULL, NULL, '2025-02-06 06:50:55', '2025-02-06 06:50:55');

-- --------------------------------------------------------

--
-- Table structure for table `resin_image`
--

CREATE TABLE `resin_image` (
  `id` int(11) NOT NULL,
  `resin_id` int(11) NOT NULL,
  `foto` json DEFAULT NULL,
  `foto1` json DEFAULT NULL,
  `foto3` json DEFAULT NULL,
  `foto5` json DEFAULT NULL,
  `foto6` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resin_image`
--

INSERT INTO `resin_image` (`id`, `resin_id`, `foto`, `foto1`, `foto3`, `foto5`, `foto6`, `created_at`, `updated_at`) VALUES
(3, 3, NULL, NULL, NULL, NULL, NULL, '2024-12-13 02:42:45', '2024-12-13 02:42:45'),
(4, 4, NULL, NULL, NULL, NULL, NULL, '2024-12-13 02:43:13', '2024-12-13 02:43:13'),
(5, 5, NULL, NULL, NULL, NULL, NULL, '2025-01-23 03:07:49', '2025-01-23 03:07:49'),
(6, 6, NULL, NULL, NULL, NULL, NULL, '2025-01-25 03:42:23', '2025-01-25 03:42:23'),
(7, 7, NULL, NULL, NULL, NULL, NULL, '2025-01-25 03:42:58', '2025-01-25 03:42:58'),
(8, 8, NULL, NULL, NULL, NULL, NULL, '2025-01-30 07:37:38', '2025-01-30 07:37:38'),
(9, 9, NULL, NULL, NULL, NULL, NULL, '2025-01-30 09:07:01', '2025-01-30 09:07:01'),
(10, 10, NULL, NULL, NULL, NULL, NULL, '2025-02-01 03:29:28', '2025-02-01 03:29:28'),
(11, 11, NULL, NULL, NULL, NULL, NULL, '2025-02-05 10:04:51', '2025-02-05 10:04:51'),
(12, 12, NULL, NULL, NULL, NULL, NULL, '2025-02-06 06:50:55', '2025-02-06 06:50:55');

-- --------------------------------------------------------

--
-- Table structure for table `scan`
--

CREATE TABLE `scan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attribute` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `panjang` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kondisi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tujuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `scan`
--

INSERT INTO `scan` (`id`, `user_id`, `attribute`, `panjang`, `kondisi`, `tujuan`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, '14', 'CR_AG_24-30756', NULL, 'BAIK', 'L01', 'C', '2025-05-15 16:09:00', '2025-05-15 16:09:00');

-- --------------------------------------------------------

--
-- Table structure for table `scan_layout`
--

CREATE TABLE `scan_layout` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `attribute` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `layout` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kondisi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `scan_layout`
--

INSERT INTO `scan_layout` (`id`, `attribute`, `layout`, `kondisi`, `group`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 'SL24-1114921', 'SL24-111492-Layout1', 'TIDAK', 'C', '63', '2024-11-07 04:19:07', '2024-11-11 04:23:24'),
(3, '1234-rr', '232345rr', 'BAIK', 'B', '63', '2024-11-07 04:47:25', '2024-11-11 04:23:43'),
(11, 'L251100002', 'L251100002', 'BAIK', 'A', '47', '2024-12-24 02:39:11', '2024-12-24 02:39:11'),
(12, 'CL24-107189', 'Blok D L3', 'BAIK', 'A', '65', '2024-12-24 02:52:59', '2024-12-24 02:52:59'),
(13, 'CI24-111218', 'Blok D L3', 'BAIK', 'A', '65', '2024-12-24 03:00:57', '2024-12-24 03:00:57'),
(14, 'CL24-105436', 'F2', 'BAIK', 'Packing A', '65', '2024-12-24 04:20:57', '2024-12-24 04:20:57');

-- --------------------------------------------------------

--
-- Table structure for table `scheduled_tasks`
--

CREATE TABLE `scheduled_tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `task_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_run` timestamp NULL DEFAULT NULL,
  `interval_minutes` int(11) NOT NULL DEFAULT '10080',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `scheduled_tasks`
--

INSERT INTO `scheduled_tasks` (`id`, `task_name`, `last_run`, `interval_minutes`, `status`, `created_at`, `updated_at`) VALUES
(1, 'db_backup', '2025-06-28 15:01:25', 10080, 'active', '2025-06-03 12:06:12', '2025-06-03 12:06:12');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('33ROt8HZasucIc3RRZ8MT63kV4thPfqzU6z8cyUz', 14, '192.168.137.57', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiaWRmZmtsOVVlak9JQ2JPOFR2aXdacG9VSUxqMTZkVzNrMUtadkJ3MSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xOTIuMTY4LjEzNy42Njo4MDAwL3dlbGNvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxNDtzOjE2OiJsYXN0QWN0aXZpdHlUaW1lIjtPOjI1OiJJbGx1bWluYXRlXFN1cHBvcnRcQ2FyYm9uIjozOntzOjQ6ImRhdGUiO3M6MjY6IjIwMjUtMDYtMTcgMTU6MTk6NTAuMTQ1NjMwIjtzOjEzOiJ0aW1lem9uZV90eXBlIjtpOjM7czo4OiJ0aW1lem9uZSI7czoxMjoiQXNpYS9KYWthcnRhIjt9fQ==', 1750148390),
('9HjGxTqzuxDdlUBuCGcvcu455IqFLwccza5fi33y', 98, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiYjRYZmlLd1hKTVV0TlR5SlVrZXVtbkpLMmptNkt0OWtDOUF0UHc3MCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zdXBlcmFkbWluL2RhdGEtbWFzdGVyL2Zvcm0tY2hlY2siO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjE2OiJsYXN0QWN0aXZpdHlUaW1lIjtPOjI1OiJJbGx1bWluYXRlXFN1cHBvcnRcQ2FyYm9uIjozOntzOjQ6ImRhdGUiO3M6MjY6IjIwMjUtMDYtMTIgMTA6NDk6MDcuMTk3MzE0IjtzOjEzOiJ0aW1lem9uZV90eXBlIjtpOjM7czo4OiJ0aW1lem9uZSI7czoxMjoiQXNpYS9KYWthcnRhIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6OTg7fQ==', 1749700147),
('a80fGOhjU5KOWMcUtlZZ8zX1JtXZMr4C1iCWy2Wi', 98, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiV2EwSzdxWm5tZ2hYVkhoVW05bzNwVjJjRm5PVGJveHJMOENMTjk4bSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zdXBlcmFkbWluL2RhdGEtbWFzdGVyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czoxNjoibGFzdEFjdGl2aXR5VGltZSI7TzoyNToiSWxsdW1pbmF0ZVxTdXBwb3J0XENhcmJvbiI6Mzp7czo0OiJkYXRlIjtzOjI2OiIyMDI1LTA2LTE2IDA5OjQ5OjU0LjgyMDM2MiI7czoxMzoidGltZXpvbmVfdHlwZSI7aTozO3M6ODoidGltZXpvbmUiO3M6MTI6IkFzaWEvSmFrYXJ0YSI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjk4O30=', 1750042194),
('fOAQMj0XxRcr7kBAPbGAhwkajZbjQ6B2Pg06H7QT', 98, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiNzlZSjM4ZFI3TEp0VGdLbVJTd0Nza0w2anhmSHhpZW5hakkwU3dkUCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czoxNjoibGFzdEFjdGl2aXR5VGltZSI7TzoyNToiSWxsdW1pbmF0ZVxTdXBwb3J0XENhcmJvbiI6Mzp7czo0OiJkYXRlIjtzOjI2OiIyMDI1LTA2LTAyIDAxOjU5OjA1LjQ4NTY2OCI7czoxMzoidGltZXpvbmVfdHlwZSI7aTozO3M6ODoidGltZXpvbmUiO3M6MTI6IkFzaWEvSmFrYXJ0YSI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjUzOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvc3VwZXJhZG1pbi9BZG1pbmlzdHJhdG9yL2stdXNlciI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjk4O30=', 1748804345),
('FZog3rVdjG3fVFtZne7nDBVZjxCPJsvYrbXF1WKM', 98, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiZnN4dmdlUEg3b2FzeWFDSkZtTzJMdUdjN0pjUGdZS3JvVE9FT2E2QyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMi9zdXBlcmFkbWluL0FkbWluaXN0cmF0b3Ivay11c2VyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czoxNjoibGFzdEFjdGl2aXR5VGltZSI7TzoyNToiSWxsdW1pbmF0ZVxTdXBwb3J0XENhcmJvbiI6Mzp7czo0OiJkYXRlIjtzOjI2OiIyMDI1LTA2LTI4IDIyOjEwOjM1LjUzMjE1OCI7czoxMzoidGltZXpvbmVfdHlwZSI7aTozO3M6ODoidGltZXpvbmUiO3M6MTI6IkFzaWEvSmFrYXJ0YSI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjk4O30=', 1751123436),
('OmgHT1stjjjVXvi6K5ApHG9kUTP0gz9bEDnUFmxr', 14, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoia2xuQ3RGTVVpTVZaRm1DQ3htM2hIeWFzM1JLUXNlR1JYRjh3dHMyWiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMi9Gb3JtLUNoZWNrL2FkbWluL2NyYW5lL2FkZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE0O3M6MTY6Imxhc3RBY3Rpdml0eVRpbWUiO086MjU6IklsbHVtaW5hdGVcU3VwcG9ydFxDYXJib24iOjM6e3M6NDoiZGF0ZSI7czoyNjoiMjAyNS0wNi0yOCAyMjo1MzoxOC45MjY0NDgiO3M6MTM6InRpbWV6b25lX3R5cGUiO2k6MztzOjg6InRpbWV6b25lIjtzOjEyOiJBc2lhL0pha2FydGEiO319', 1751125999),
('P3e8KFAmGKHNK89tVFZYzuJt4iJVYL73vHDUwELl', 14, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiV1Q5VEtseEJhekwwaWNIMzlWcWJ5RnFadWs3OFptQzNvWHhrTVhYbSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9MLTA4L2FkbWluL3Jla2FwIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTQ7czoxNjoibGFzdEFjdGl2aXR5VGltZSI7TzoyNToiSWxsdW1pbmF0ZVxTdXBwb3J0XENhcmJvbiI6Mzp7czo0OiJkYXRlIjtzOjI2OiIyMDI1LTA2LTA4IDIwOjE5OjUxLjM0NDAyMyI7czoxMzoidGltZXpvbmVfdHlwZSI7aTozO3M6ODoidGltZXpvbmUiO3M6MTI6IkFzaWEvSmFrYXJ0YSI7fX0=', 1749388791),
('p5BUAKlRls5x2zZ4q7cGGxNw6AbzthVbLsZ7V958', 100, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoieUpieUhWSUhPNVduaDduRTdzUzlPdUVPTnh5UVFhd0o2VjFtNGlTZCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC93ZWxjb21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czoxNjoibGFzdEFjdGl2aXR5VGltZSI7TzoyNToiSWxsdW1pbmF0ZVxTdXBwb3J0XENhcmJvbiI6Mzp7czo0OiJkYXRlIjtzOjI2OiIyMDI1LTA2LTAyIDAxOjU5OjQ3LjQyOTkxOSI7czoxMzoidGltZXpvbmVfdHlwZSI7aTozO3M6ODoidGltZXpvbmUiO3M6MTI6IkFzaWEvSmFrYXJ0YSI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjEwMDt9', 1748804387),
('XaG12guwU3oTgHF4kE36WG261MTSXdAgFy3c3OBF', 98, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoicHJ6UHU5b0k3ZHZUNVVNQXBsSHc3TWhrenZYZkFOTHB6SVFjbk5BaSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zdXBlcmFkbWluL2RhdGEtbWFzdGVyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6OTg7czoxNjoibGFzdEFjdGl2aXR5VGltZSI7TzoyNToiSWxsdW1pbmF0ZVxTdXBwb3J0XENhcmJvbiI6Mzp7czo0OiJkYXRlIjtzOjI2OiIyMDI1LTA2LTAzIDE3OjM3OjMwLjQ5Nzc3NCI7czoxMzoidGltZXpvbmVfdHlwZSI7aTozO3M6ODoidGltZXpvbmUiO3M6MTI6IkFzaWEvSmFrYXJ0YSI7fX0=', 1748947050),
('xDTjfgXsAjZosVIDX2KyS3ubrgBxL9srjsgwpHFa', 14, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiNWVJTGh6YTBuMVJzdmRFRDM2Q1ZhMDJXd0s5THdUNnQ1a0lPWmdDeSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9QYWNraW5nLUxpc3QvYWRtaW4vZGF0YWJhc2UvZWRpdC81MyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE0O3M6MTY6Imxhc3RBY3Rpdml0eVRpbWUiO086MjU6IklsbHVtaW5hdGVcU3VwcG9ydFxDYXJib24iOjM6e3M6NDoiZGF0ZSI7czoyNjoiMjAyNS0wNi0zMCAwMTozNjo1My41NzU2ODYiO3M6MTM6InRpbWV6b25lX3R5cGUiO2k6MztzOjg6InRpbWV6b25lIjtzOjEyOiJBc2lhL0pha2FydGEiO319', 1751222213),
('ytOSuFs36iX4q23nmpxohd4iwUHCq2Nw0Gy6mFhv', 98, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiYUNLUmxPMVhUbUJsS1E4dWJEd1BnT0JYZWVNNWViVUU5UmlxS2tFTCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zdXBlcmFkbWluL0FkbWluaXN0cmF0b3Ivay11c2VyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6OTg7czoxNjoibGFzdEFjdGl2aXR5VGltZSI7TzoyNToiSWxsdW1pbmF0ZVxTdXBwb3J0XENhcmJvbiI6Mzp7czo0OiJkYXRlIjtzOjI2OiIyMDI1LTA2LTA0IDE0OjQ1OjI4LjY0MjM1NCI7czoxMzoidGltZXpvbmVfdHlwZSI7aTozO3M6ODoidGltZXpvbmUiO3M6MTI6IkFzaWEvSmFrYXJ0YSI7fX0=', 1749023128),
('ZFRufKHovtj7yWME06ZRqIPVVNqm0ZWCqqEVVd7K', 14, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiUm51SmlyQVY1REhINWhWbXBFTWNHcmhNemI4TWh5MUQyYXNJd3AybiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czoxNjoibGFzdEFjdGl2aXR5VGltZSI7TzoyNToiSWxsdW1pbmF0ZVxTdXBwb3J0XENhcmJvbiI6Mzp7czo0OiJkYXRlIjtzOjI2OiIyMDI1LTA2LTA0IDE2OjQyOjIyLjA1ODU5MCI7czoxMzoidGltZXpvbmVfdHlwZSI7aTozO3M6ODoidGltZXpvbmUiO3M6MTI6IkFzaWEvSmFrYXJ0YSI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQ3OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvU2hpcC1NYXJrL2FkbWluL1NoaXBtZW50RCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE0O30=', 1749030142);

-- --------------------------------------------------------

--
-- Table structure for table `shift`
--

CREATE TABLE `shift` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shift` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shift`
--

INSERT INTO `shift` (`id`, `shift`, `description`, `created_at`, `updated_at`) VALUES
(2, '1', 'Shift Satu', '2025-05-22 18:06:59', '2025-06-01 18:33:49'),
(3, '2', 'Shift Kedua', '2025-05-22 18:07:11', '2025-05-22 18:07:11'),
(4, '3', 'Shift Ketiga', '2025-05-22 18:07:22', '2025-05-22 20:39:38');

-- --------------------------------------------------------

--
-- Table structure for table `shipment`
--

CREATE TABLE `shipment` (
  `id` int(11) NOT NULL,
  `no_gs` varchar(255) DEFAULT NULL,
  `tgl_gs` date DEFAULT NULL,
  `no_so` varchar(255) DEFAULT NULL,
  `no_po` varchar(255) DEFAULT NULL,
  `no_do` varchar(255) DEFAULT NULL,
  `no_container` varchar(255) DEFAULT NULL,
  `no_seal` varchar(255) DEFAULT NULL,
  `no_mobil` varchar(255) DEFAULT NULL,
  `forwarding` varchar(255) DEFAULT NULL,
  `kepada` varchar(255) DEFAULT NULL,
  `tare` varchar(255) DEFAULT NULL,
  `alamat_pengirim` text,
  `alamat_tujuan` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shipment`
--

INSERT INTO `shipment` (`id`, `no_gs`, `tgl_gs`, `no_so`, `no_po`, `no_do`, `no_container`, `no_seal`, `no_mobil`, `forwarding`, `kepada`, `tare`, `alamat_pengirim`, `alamat_tujuan`, `created_at`, `updated_at`) VALUES
(104, 'GSX24-100838', '2024-12-16', NULL, NULL, NULL, 'CSNU1553931', NULL, 'B9001WEH', NULL, 'BEST SHEDS PTY LTD', '2185', NULL, NULL, '2024-12-15 19:04:53', '2024-12-15 19:41:57'),
(105, 'GSX24-100839', '2024-12-16', NULL, NULL, NULL, 'OOLU0552326', NULL, 'B9023TEJ', NULL, 'BEST SHEDS', '2190', NULL, NULL, '2024-12-15 19:04:53', '2024-12-16 03:38:38'),
(106, 'GSX24-100840', '2024-12-16', NULL, NULL, NULL, 'CSNU1582966', NULL, 'B9788UEM', NULL, 'BEST SHEDS', '2185', NULL, NULL, '2024-12-15 19:04:53', '2024-12-15 19:20:32'),
(107, 'GSX24-100841', '2024-12-16', NULL, NULL, NULL, 'OOLU1807930', NULL, 'BE8351BY', NULL, 'BEST SHEDS', '2310', NULL, NULL, '2024-12-15 19:04:53', '2024-12-15 22:44:18'),
(108, 'GSX24-100842', '2024-12-16', NULL, NULL, NULL, 'CSNU1166043', NULL, 'B9221BEI', NULL, 'BEST SHEDS', '2160', NULL, NULL, '2024-12-15 19:04:53', '2024-12-15 22:48:14'),
(109, 'GSX24-100843', '2024-12-16', NULL, NULL, NULL, 'TLLU3346647', NULL, 'BE8545AMC', NULL, 'BEST SHEDS', '2100', NULL, NULL, '2024-12-15 19:04:53', '2024-12-15 22:53:26'),
(110, 'GSX24-100844', '2024-12-16', NULL, NULL, NULL, 'CSNU1413837', NULL, 'B9398XQ', NULL, 'BEST SHEDS', '2185', NULL, NULL, '2024-12-15 19:04:53', '2024-12-16 03:33:36'),
(111, 'GSX24-100845', '2024-12-16', NULL, NULL, NULL, 'BMOU1593052', NULL, 'B9137UIV', NULL, 'BEST SHEDS', '2100', NULL, NULL, '2024-12-15 19:04:53', '2024-12-16 03:44:41'),
(112, 'GSX24-100846', '2024-12-16', NULL, NULL, NULL, 'TLLU2999858', NULL, 'B9423UIV', NULL, 'BEST SHEDS', '2100', NULL, NULL, '2024-12-15 19:04:53', '2024-12-16 03:50:40'),
(113, 'GSX24-100847', '2024-12-16', NULL, NULL, NULL, 'CSNU1597729', NULL, 'B9322UIW', NULL, 'BEST SHEDS', '2185', NULL, NULL, '2024-12-15 19:04:53', '2024-12-16 04:11:38'),
(114, 'GSX24-100848', '2024-12-16', NULL, NULL, NULL, 'DFSU1627386', NULL, 'B9136UIV', NULL, 'BEST SHEDS', '2160', NULL, NULL, '2024-12-15 19:04:53', '2024-12-16 04:17:54'),
(115, 'GSX24-100849', '2024-12-16', NULL, NULL, NULL, 'OOLU0318468', NULL, 'B9141UIV', NULL, 'BEST SHEDS', '2170', NULL, NULL, '2024-12-15 19:04:53', '2024-12-16 04:25:51'),
(116, 'GSX24-100850', '2024-12-16', NULL, NULL, NULL, 'CSNU2032970', NULL, 'B9787PEH', NULL, 'BEST SHEDS', '2185', NULL, NULL, '2024-12-15 19:04:53', '2024-12-16 04:32:00'),
(117, 'GSX24-100851', '2024-12-16', NULL, NULL, NULL, 'CSNU1947576', NULL, 'BE8020AMB', NULL, 'BEST SHEDS', '2185', NULL, NULL, '2024-12-15 19:04:53', '2024-12-16 04:36:04'),
(118, 'GSX24-100852', '2024-12-16', NULL, NULL, NULL, 'OOLU0711109', NULL, 'B9878UWY', NULL, 'BEST SHEDS', '2160', NULL, NULL, '2024-12-15 19:04:53', '2024-12-16 04:41:10'),
(119, 'GSX24-100853', '2024-12-16', NULL, NULL, NULL, 'CSNU1687268', NULL, 'B9025JG', NULL, 'Best Sheds', '2185', NULL, NULL, '2024-12-15 19:04:53', '2024-12-24 04:27:52'),
(120, 'GSX24-100854', '2024-12-16', NULL, NULL, NULL, 'CSLU1918210', NULL, 'B9824UEM', NULL, 'BEST SHEDS', '2185', NULL, NULL, '2024-12-15 19:04:53', '2024-12-24 08:52:08'),
(121, 'GSX24-100855', '2024-12-16', NULL, NULL, NULL, 'TLLU3287170', NULL, 'B9089JK', NULL, 'BEST SHEDS', '2100', NULL, NULL, '2024-12-15 19:04:53', '2024-12-24 08:46:37'),
(122, 'gsbaruu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-05-28 19:50:12', '2025-05-28 19:50:12');

-- --------------------------------------------------------

--
-- Table structure for table `shippmenta`
--

CREATE TABLE `shippmenta` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `atribute` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unicode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `weight` int(11) NOT NULL,
  `satuan_berat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `destination` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shippmenta`
--

INSERT INTO `shippmenta` (`id`, `atribute`, `unicode`, `size`, `weight`, `satuan_berat`, `destination`, `type`, `created_at`, `updated_at`) VALUES
(3, 'SL24-111022-1A-B-C-D-E-F', 'INNOTEC BUILDING SYSTEMS PTY.LTD.', '0.90mm x 78.5mm AZ150 G300 NEXALUME® Acrylic Coated AFP', 2334, 'MT', 'SYDNEY', 'SOX24-24076', '2024-09-26 11:19:41', '2024-09-26 11:19:41'),
(4, 'SL24-111022-2A-B-C-D-E-F', 'INNOTEC BUILDING SYSTEMS PTY.LTD.', '0.90mm x 78.5mm AZ150 G300 NEXALUME® Acrylic Coated AFP', 2334, 'MT', 'SYDNEY', 'SOX24-24076', '2024-09-26 11:19:41', '2024-09-26 11:19:41'),
(5, 'SL24-111019-1G-H-I-J-K-L', 'INNOTEC BUILDING SYSTEMS PTY.LTD.', '0.90mm x 78.5mm AZ150 G300 NEXALUME® Acrylic Coated AFP', 2334, 'MT', 'SYDNEY', 'SOX24-24076', '2024-09-26 11:19:41', '2024-09-26 11:19:41'),
(6, 'SL24-111019-2G-H-I-J-K-L', 'INNOTEC BUILDING SYSTEMS PTY.LTD.', '0.90mm x 78.5mm AZ150 G300 NEXALUME® Acrylic Coated AFP', 2334, 'MT', 'SYDNEY', 'SOX24-24076', '2024-09-26 11:19:41', '2024-09-26 11:19:41'),
(7, 'SL24-111020-1A-B-C-D-E-F', 'INNOTEC BUILDING SYSTEMS PTY.LTD.', '0.90mm x 78.5mm AZ150 G300 NEXALUME® Acrylic Coated AFP', 2376, 'MT', 'SYDNEY', 'SOX24-24076', '2024-09-26 11:19:41', '2024-09-26 11:19:41'),
(8, 'SL24-111020-2A-B-C-D-E-F', 'INNOTEC BUILDING SYSTEMS PTY.LTD.', '0.90mm x 78.5mm AZ150 G300 NEXALUME® Acrylic Coated AFP', 2376, 'MT', 'SYDNEY', 'SOX24-24076', '2024-09-26 11:19:41', '2024-09-26 11:19:41'),
(9, 'SL24-111021-1G-H-I-J-K-L', 'INNOTEC BUILDING SYSTEMS PTY.LTD.', '0.90mm x 78.5mm AZ150 G300 NEXALUME® Acrylic Coated AFP', 2658, 'MT', 'SYDNEY', 'SOX24-24076', '2024-09-26 11:19:41', '2024-09-26 11:19:41'),
(10, 'SL24-111021-2G-H-I-J-K-L', 'INNOTEC BUILDING SYSTEMS PTY.LTD.', '0.90mm x 78.5mm AZ150 G300 NEXALUME® Acrylic Coated AFP', 2658, 'MT', 'SYDNEY', 'SOX24-24076', '2024-09-26 11:19:41', '2024-09-26 11:19:41'),
(11, 'SL24-112136-1 A-B-C-D-E-F', 'INNOTEC BUILDING SYSTEMS PTY.LTD.', '0.90mm x 78.5mm AZ150 G300 NEXALUME® Acrylic Coated AFP', 2820, 'MT', 'SYDNEY', 'SOX24-24109', '2024-11-21 03:55:35', '2024-11-21 03:55:35'),
(12, 'SL24-112136-2 G-H-I-J-K-L', 'INNOTEC BUILDING SYSTEMS PTY.LTD.', '0.90mm x 78.5mm AZ150 G300 NEXALUME® Acrylic Coated AFP', 2820, 'MT', 'SYDNEY', 'SOX24-24109', '2024-11-21 03:55:35', '2024-11-21 03:55:35'),
(13, 'SL24-112153-1 A-B-C-D-E-F', 'INNOTEC BUILDING SYSTEMS PTY.LTD.', '0.90mm x 78.5mm AZ150 G300 NEXALUME® Acrylic Coated AFP', 2994, 'MT', 'SYDNEY', 'SOX24-24109', '2024-11-21 03:55:35', '2024-11-21 03:55:35'),
(14, 'SL24-112153-2 G-H-I-J-K-L', 'INNOTEC BUILDING SYSTEMS PTY.LTD.', '0.90mm x 78.5mm AZ150 G300 NEXALUME® Acrylic Coated AFP', 2994, 'MT', 'SYDNEY', 'SOX24-24109', '2024-11-21 03:55:35', '2024-11-21 03:55:35'),
(15, 'SL24-112753-1 A-B-C-D-E-F', 'INNOTEC BUILDING SYSTEMS PTY.LTD.', '0.90mm x 78.5mm AZ150 G300 NEXALUME® Acrylic Coated AFP', 2994, 'MT', 'SYDNEY', 'SOX24-24109', '2024-12-05 02:33:32', '2024-12-05 02:33:32'),
(16, 'SL24-112753-2 G-H-I-J-K-L', 'INNOTEC BUILDING SYSTEMS PTY.LTD.', '0.90mm x 78.5mm AZ150 G300 NEXALUME® Acrylic Coated AFP', 2994, 'MT', 'SYDNEY', 'SOX24-24109', '2024-12-05 02:33:32', '2024-12-05 02:33:32'),
(17, 'SL24-112754-1 A-B-C-D-E-F', 'INNOTEC BUILDING SYSTEMS PTY.LTD.', '0.90mm x 78.5mm AZ150 G300 NEXALUME® Acrylic Coated AFP', 3000, 'MT', 'SYDNEY', 'SOX24-24109', '2024-12-05 02:33:32', '2024-12-05 02:33:32'),
(18, 'SL24-112754-2 G-H-I-J-K-L', 'INNOTEC BUILDING SYSTEMS PTY.LTD.', '0.90mm x 78.5mm AZ150 G300 NEXALUME® Acrylic Coated AFP', 3000, 'MT', 'SYDNEY', 'SOX24-24109', '2024-12-05 02:33:32', '2024-12-05 02:33:32'),
(19, 'SL24-112755-1 A-B-C-D-E-F', 'INNOTEC BUILDING SYSTEMS PTY.LTD.', '0.90mm x 78.5mm AZ150 G300 NEXALUME® Acrylic Coated AFP', 3120, 'MT', 'SYDNEY', 'SOX24-24109', '2024-12-05 02:33:32', '2024-12-05 02:33:32'),
(20, 'SL24-112755-2 G-H-I-J-K-L', 'INNOTEC BUILDING SYSTEMS PTY.LTD.', '0.90mm x 78.5mm AZ150 G300 NEXALUME® Acrylic Coated AFP', 3120, 'MT', 'SYDNEY', 'SOX24-24109', '2024-12-05 02:33:32', '2024-12-05 02:33:32'),
(21, 'SL24-112757 A-B-C-D-E-F-G', 'INNOTEC BUILDING SYSTEMS PTY.LTD.', '0.90mm x 78.5mm AZ150 G300 NEXALUME® Acrylic Coated AFP', 3423, 'MT', 'SYDNEY', 'SOX24-24109', '2024-12-05 02:33:32', '2024-12-05 02:33:32'),
(22, 'SL24-112758 A-B-C-D-E-F-G', 'INNOTEC BUILDING SYSTEMS PTY.LTD.', '0.90mm x 78.5mm AZ150 G300 NEXALUME® Acrylic Coated AFP', 3325, 'MT', 'SYDNEY', 'SOX24-24109', '2024-12-05 02:33:32', '2024-12-05 02:33:32'),
(23, 'SL24-112759 A-B-C-D-E-F-G', 'INNOTEC BUILDING SYSTEMS PTY.LTD.', '0.90mm x 78.5mm AZ150 G300 NEXALUME® Acrylic Coated AFP', 3346, 'MT', 'SYDNEY', 'SOX24-24109', '2024-12-05 02:33:32', '2024-12-05 02:33:32'),
(24, 'SL24-112760 A-B-C-D-E-F-G-H', 'INNOTEC BUILDING SYSTEMS PTY.LTD.', '0.90mm x 78.5mm AZ150 G300 NEXALUME® Acrylic Coated AFP', 3808, 'MT', 'SYDNEY', 'SOX24-24109', '2024-12-05 02:33:32', '2024-12-05 02:33:32'),
(25, 'SL24-112761 A-B-C-D-E-F-G-H', 'INNOTEC BUILDING SYSTEMS PTY.LTD.', '0.90mm x 78.5mm AZ150 G300 NEXALUME® Acrylic Coated AFP', 3816, 'MT', 'SYDNEY', 'SOX24-24109', '2024-12-05 02:33:32', '2024-12-05 02:33:32'),
(26, 'SL24-112756 A-B-C-D-E-F-G-H', 'INNOTEC BUILDING SYSTEMS PTY.LTD.', '0.90mm x 78.5mm AZ150 G300 NEXALUME® Acrylic Coated AFP', 3920, 'MT', 'SYDNEY', 'SOX24-24109', '2024-12-05 02:33:32', '2024-12-05 02:33:32'),
(27, 'S1S25113789-1 A-B-C-D-E', 'PO-CP3356', '0.95mm x 135mm Z275 G550 NEXIUM® PASSIVATION', 3060, 'MT', 'MELBOURNE', 'SOX24-24142', '2025-01-21 06:38:54', '2025-01-21 06:38:54'),
(28, 'S1S25113789-2 F-G-H-I', 'PO-CP3356', '0.95mm x 135mm Z275 G550 NEXIUM® PASSIVATION', 2448, 'MT', 'MELBOURNE', 'SOX24-24142', '2025-01-21 06:38:54', '2025-01-21 06:38:54'),
(29, 'S1S25113790-1 A-B-C-D-E', 'PO-CP3356', '0.95mm x 135mm Z275 G550 NEXIUM® PASSIVATION', 3065, 'MT', 'MELBOURNE', 'SOX24-24142', '2025-01-21 06:38:54', '2025-01-21 06:38:54'),
(30, 'S1S25113790-2 F-G-H-I', 'PO-CP3356', '0.95mm x 135mm Z275 G550 NEXIUM® PASSIVATION', 2452, 'MT', 'MELBOURNE', 'SOX24-24142', '2025-01-21 06:38:54', '2025-01-21 06:38:54'),
(31, 'S1S25113791-1 A-B-C-D-E', 'PO-CP3356', '0.95mm x 135mm Z275 G550 NEXIUM® PASSIVATION', 3070, 'MT', 'MELBOURNE', 'SOX24-24142', '2025-01-21 06:38:54', '2025-01-21 06:38:54'),
(32, 'S1S25113791-2 F-G-H-I', 'PO-CP3356', '0.95mm x 135mm Z275 G550 NEXIUM® PASSIVATION', 2456, 'MT', 'MELBOURNE', 'SOX24-24142', '2025-01-21 06:38:54', '2025-01-21 06:38:54'),
(33, 'S1S25113792-1 A-B-C-D-E', 'PO-CP3356', '0.95mm x 135mm Z275 G550 NEXIUM® PASSIVATION', 3815, 'MT', 'MELBOURNE', 'SOX24-24142', '2025-01-21 06:38:54', '2025-01-21 06:38:54'),
(34, 'S1S25113792-2 F-G-H-I', 'PO-CP3356', '0.95mm x 135mm Z275 G550 NEXIUM® PASSIVATION', 3052, 'MT', 'MELBOURNE', 'SOX24-24142', '2025-01-21 06:38:54', '2025-01-21 06:38:54'),
(35, 'S1S25113793-1 A-B-C-D-E', 'PO-CP3356', '0.95mm x 135mm Z275 G550 NEXIUM® PASSIVATION', 3925, 'MT', 'MELBOURNE', 'SOX24-24142', '2025-01-21 06:38:54', '2025-01-21 06:38:54'),
(36, 'S1S25113793-2 F-G-H-I', 'PO-CP3356', '0.95mm x 135mm Z275 G550 NEXIUM® PASSIVATION', 3140, 'MT', 'MELBOURNE', 'SOX24-24142', '2025-01-21 06:38:54', '2025-01-21 06:38:54'),
(37, 'S1S25113794-1 A-B-C-D-E', 'PO-CP3356', '0.95mm x 135mm Z275 G550 NEXIUM® PASSIVATION', 3565, 'MT', 'MELBOURNE', 'SOX24-24142', '2025-01-21 06:38:54', '2025-01-21 06:38:54'),
(38, 'S1S25113794-2 F-G-H-I', 'PO-CP3356', '0.95mm x 135mm Z275 G550 NEXIUM® PASSIVATION', 2852, 'MT', 'MELBOURNE', 'SOX24-24142', '2025-01-21 06:38:54', '2025-01-21 06:38:54'),
(39, 'S1S25113795-1 A-B-C', 'PO-CP3356', '0.95mm x 135mm Z275 G550 NEXIUM® PASSIVATION', 2604, 'MT', 'MELBOURNE', 'SOX24-24142', '2025-01-21 06:38:54', '2025-01-21 06:38:54'),
(40, 'S1S25113795-2 D-E-F', 'PO-CP3356', '0.95mm x 135mm Z275 G550 NEXIUM® PASSIVATION', 2604, 'MT', 'MELBOURNE', 'SOX24-24142', '2025-01-21 06:38:54', '2025-01-21 06:38:54'),
(41, 'S1S25113795-3 G-H-I', 'PO-CP3356', '0.95mm x 135mm Z275 G550 NEXIUM® PASSIVATION', 2604, 'MT', 'MELBOURNE', 'SOX24-24142', '2025-01-21 06:38:54', '2025-01-21 06:38:54'),
(42, 'S1S25113796-1 A-B-C', 'PO-CP3356', '0.95mm x 135mm Z275 G550 NEXIUM® PASSIVATION', 2616, 'MT', 'MELBOURNE', 'SOX24-24142', '2025-01-21 06:38:54', '2025-01-21 06:38:54'),
(43, 'S1S25113796-2 D-E-F', 'PO-CP3356', '0.95mm x 135mm Z275 G550 NEXIUM® PASSIVATION', 2616, 'MT', 'MELBOURNE', 'SOX24-24142', '2025-01-21 06:38:54', '2025-01-21 06:38:54'),
(44, 'S1S25113796-3 G-H-I', 'PO-CP3356', '0.95mm x 135mm Z275 G550 NEXIUM® PASSIVATION', 2616, 'MT', 'MELBOURNE', 'SOX24-24142', '2025-01-21 06:38:54', '2025-01-21 06:38:54'),
(45, 'S1S25113797-1 A-B-C', 'PO-CP3356', '0.95mm x 135mm Z275 G550 NEXIUM® PASSIVATION', 2586, 'MT', 'MELBOURNE', 'SOX24-24142', '2025-01-21 06:38:54', '2025-01-21 06:38:54'),
(46, 'S1S25113797-2 D-E-F', 'PO-CP3356', '0.95mm x 135mm Z275 G550 NEXIUM® PASSIVATION', 2586, 'MT', 'MELBOURNE', 'SOX24-24142', '2025-01-21 06:38:54', '2025-01-21 06:38:54'),
(47, 'S1S25113797-3 G-H-I', 'PO-CP3356', '0.95mm x 135mm Z275 G550 NEXIUM® PASSIVATION', 2586, 'MT', 'MELBOURNE', 'SOX24-24142', '2025-01-21 06:38:54', '2025-01-21 06:38:54'),
(48, 'S1S25113798-1 A-B-C', 'PO-CP3356', '0.95mm x 135mm Z275 G550 NEXIUM® PASSIVATION', 2628, 'MT', 'MELBOURNE', 'SOX24-24142', '2025-01-21 06:38:54', '2025-01-21 06:38:54'),
(49, 'S1S25113798-2 D-E-F', 'PO-CP3356', '0.95mm x 135mm Z275 G550 NEXIUM® PASSIVATION', 2628, 'MT', 'MELBOURNE', 'SOX24-24142', '2025-01-21 06:38:54', '2025-01-21 06:38:54'),
(50, 'S1S25113798-3 G-H-I', 'PO-CP3356', '0.95mm x 135mm Z275 G550 NEXIUM® PASSIVATION', 2628, 'MT', 'MELBOURNE', 'SOX24-24142', '2025-01-21 06:38:54', '2025-01-21 06:38:54'),
(51, 'S1S25113799-1 A-B-C', 'PO-CP3356', '0.95mm x 135mm Z275 G550 NEXIUM® PASSIVATION', 2634, 'MT', 'MELBOURNE', 'SOX24-24142', '2025-01-21 06:38:54', '2025-01-21 06:38:54'),
(52, 'S1S25113799-2 D-E-F', 'PO-CP3356', '0.95mm x 135mm Z275 G550 NEXIUM® PASSIVATION', 2634, 'MT', 'MELBOURNE', 'SOX24-24142', '2025-01-21 06:38:54', '2025-01-21 06:38:54'),
(53, 'S1S25113799-3 G-H-I', 'PO-CP3356', '0.95mm x 135mm Z275 G550 NEXIUM® PASSIVATION', 2634, 'MT', 'MELBOURNE', 'SOX24-24142', '2025-01-21 06:38:54', '2025-01-21 06:38:54'),
(54, 'S1S25113800-1 A-B-C', 'PO-CP3356', '0.95mm x 135mm Z275 G550 NEXIUM® PASSIVATION', 2574, 'MT', 'MELBOURNE', 'SOX24-24142', '2025-01-21 06:38:54', '2025-01-21 06:38:54'),
(55, 'S1S25113800-2D-E-F', 'PO-CP3356', '0.95mm x 135mm Z275 G550 NEXIUM® PASSIVATION', 2574, 'MT', 'MELBOURNE', 'SOX24-24142', '2025-01-21 06:38:54', '2025-01-21 06:38:54'),
(56, 'S1S25113800-3G-H-I', 'PO-CP3356', '0.95mm x 135mm Z275 G550 NEXIUM® PASSIVATION', 2574, 'MT', 'MELBOURNE', 'SOX24-24142', '2025-01-21 06:38:54', '2025-01-21 06:38:54'),
(57, 'S1S25113802-1A-B-C-D-E', 'PO-CP3356', '0.95mm x 135mm Z275 G550 NEXIUM® PASSIVATION', 3845, 'MT', 'MELBOURNE', 'SOX24-24142', '2025-01-21 06:38:54', '2025-01-21 06:38:54'),
(58, 'S1S25113802-2F-G-H-I', 'PO-CP3356', '0.95mm x 135mm Z275 G550 NEXIUM® PASSIVATION', 3076, 'MT', 'MELBOURNE', 'SOX24-24142', '2025-01-21 06:38:54', '2025-01-21 06:38:54'),
(59, 'S1S25113803-1A-B-C-D-E', 'PO-CP3356', '0.95mm x 135mm Z275 G550 NEXIUM® PASSIVATION', 3720, 'MT', 'MELBOURNE', 'SOX24-24142', '2025-01-21 06:38:54', '2025-01-21 06:38:54'),
(60, 'S1S25113803-2F-G-H-I', 'PO-CP3356', '0.95mm x 135mm Z275 G550 NEXIUM® PASSIVATION', 2976, 'MT', 'MELBOURNE', 'SOX24-24142', '2025-01-21 06:38:54', '2025-01-21 06:38:54'),
(61, 'G1L25102048', 'PO-CP3432', '0.42mm x 940mm AZ150 G550 NEXALUME® Acrylic Coated AFP', 3565, 'MT', 'MELBOURNE', 'SOX24-24152', '2025-01-28 03:12:45', '2025-01-28 03:12:45'),
(62, 'G1L25102049', 'PO-CP3432', '0.42mm x 940mm AZ150 G550 NEXALUME® Acrylic Coated AFP', 3516, 'MT', 'MELBOURNE', 'SOX24-24152', '2025-01-28 03:12:45', '2025-01-28 03:12:45'),
(63, 'G1L25102050', 'PO-CP3432', '0.42mm x 940mm AZ150 G550 NEXALUME® Acrylic Coated AFP', 3505, 'MT', 'MELBOURNE', 'SOX24-24152', '2025-01-28 03:12:45', '2025-01-28 03:12:45'),
(64, 'G1L25102051', 'PO-CP3432', '0.42mm x 940mm AZ150 G550 NEXALUME® Acrylic Coated AFP', 3506, 'MT', 'MELBOURNE', 'SOX24-24152', '2025-01-28 03:12:45', '2025-01-28 03:12:45'),
(65, 'G1L25102052', 'PO-CP3432', '0.42mm x 940mm AZ150 G550 NEXALUME® Acrylic Coated AFP', 3398, 'MT', 'MELBOURNE', 'SOX24-24152', '2025-01-28 03:12:45', '2025-01-28 03:12:45'),
(66, 'G1L25102053', 'PO-CP3432', '0.42mm x 940mm AZ150 G550 NEXALUME® Acrylic Coated AFP', 3503, 'MT', 'MELBOURNE', 'SOX24-24152', '2025-01-28 03:12:45', '2025-01-28 03:12:45'),
(67, 'G1L25102054', 'PO-CP3432', '0.42mm x 940mm AZ150 G550 NEXALUME® Acrylic Coated AFP', 3506, 'MT', 'MELBOURNE', 'SOX24-24152', '2025-01-28 03:12:45', '2025-01-28 03:12:45'),
(68, 'G1L25102055', 'PO-CP3432', '0.42mm x 940mm AZ150 G550 NEXALUME® Acrylic Coated AFP', 3507, 'MT', 'MELBOURNE', 'SOX24-24152', '2025-01-28 03:12:45', '2025-01-28 03:12:45'),
(69, 'G1L25102056', 'PO-CP3432', '0.42mm x 940mm AZ150 G550 NEXALUME® Acrylic Coated AFP', 3505, 'MT', 'MELBOURNE', 'SOX24-24152', '2025-01-28 03:12:45', '2025-01-28 03:12:45'),
(70, 'G1L25102057', 'PO-CP3432', '0.42mm x 940mm AZ150 G550 NEXALUME® Acrylic Coated AFP', 3333, 'MT', 'MELBOURNE', 'SOX24-24152', '2025-01-28 03:12:45', '2025-01-28 03:12:45'),
(71, 'G1L25102058', 'PO-CP3432', '0.42mm x 940mm AZ150 G550 NEXALUME® Acrylic Coated AFP', 3562, 'MT', 'MELBOURNE', 'SOX24-24152', '2025-01-28 03:12:45', '2025-01-28 03:12:45'),
(72, 'G1L25102059', 'PO-CP3432', '0.42mm x 940mm AZ150 G550 NEXALUME® Acrylic Coated AFP', 3562, 'MT', 'MELBOURNE', 'SOX24-24152', '2025-01-28 03:12:45', '2025-01-28 03:12:45'),
(73, 'G1L25102060', 'PO-CP3432', '0.42mm x 940mm AZ150 G550 NEXALUME® Acrylic Coated AFP', 3559, 'MT', 'MELBOURNE', 'SOX24-24152', '2025-01-28 03:12:45', '2025-01-28 03:12:45'),
(74, 'G1L25102061', 'PO-CP3432', '0.42mm x 940mm AZ150 G550 NEXALUME® Acrylic Coated AFP', 3560, 'MT', 'MELBOURNE', 'SOX24-24152', '2025-01-28 03:12:45', '2025-01-28 03:12:45'),
(75, 'G1L25102062', 'PO-CP3432', '0.42mm x 940mm AZ150 G550 NEXALUME® Acrylic Coated AFP', 3583, 'MT', 'MELBOURNE', 'SOX24-24152', '2025-01-28 03:12:45', '2025-01-28 03:12:45');

-- --------------------------------------------------------

--
-- Table structure for table `shippmentb`
--

CREATE TABLE `shippmentb` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `atribute` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gros` int(11) NOT NULL,
  `net` int(11) NOT NULL,
  `satuan_berat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `destination` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `manufactur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shippmentb`
--

INSERT INTO `shippmentb` (`id`, `atribute`, `product`, `size`, `gros`, `net`, `satuan_berat`, `destination`, `manufactur`, `type`, `created_at`, `updated_at`) VALUES
(1, 'CL24-107058', 'NEXALUME ® COIL AS / NZ - 1397', '0.40mm x 938mm AZ200 G550 NEXALUME® Acrylic Coated AFP', 3282, 3192, 'KGS', 'TAURANGA, NZ ', 'RIVERLEA', 'SOX24-24086', '2024-09-22 11:09:20', '2024-09-22 11:09:20'),
(2, 'CL24-107059', 'NEXALUME ® COIL AS / NZ - 1397', '0.40mm x 938mm AZ200 G550 NEXALUME® Acrylic Coated AFP', 3295, 3205, 'KGS', 'TAURANGA, NZ ', 'RIVERLEA', 'SOX24-24086', '2024-09-22 11:09:20', '2024-09-22 11:09:20'),
(3, 'CL24-107060', 'NEXALUME ® COIL AS / NZ - 1397', '0.40mm x 938mm AZ200 G550 NEXALUME® Acrylic Coated AFP', 3304, 3214, 'KGS', 'TAURANGA, NZ ', 'RIVERLEA', 'SOX24-24086', '2024-09-22 11:09:20', '2024-09-22 11:09:20'),
(4, 'CL24-107061', 'NEXALUME ® COIL AS / NZ - 1397', '0.40mm x 938mm AZ200 G550 NEXALUME® Acrylic Coated AFP', 3269, 3179, 'KGS', 'TAURANGA, NZ ', 'RIVERLEA', 'SOX24-24086', '2024-09-22 11:09:20', '2024-09-22 11:09:20'),
(5, 'CL24-107062', 'NEXALUME ® COIL AS / NZ - 1397', '0.40mm x 938mm AZ200 G550 NEXALUME® Acrylic Coated AFP', 3172, 3082, 'KGS', 'TAURANGA, NZ ', 'RIVERLEA', 'SOX24-24086', '2024-09-22 11:09:20', '2024-09-22 11:09:20'),
(6, 'CL24-107063', 'NEXALUME ® COIL AS / NZ - 1397', '0.40mm x 938mm AZ200 G550 NEXALUME® Acrylic Coated AFP', 3171, 3081, 'KGS', 'TAURANGA, NZ ', 'RIVERLEA', 'SOX24-24086', '2024-09-22 11:09:20', '2024-09-22 11:09:20'),
(7, 'CL24-107064', 'NEXALUME ® COIL AS / NZ - 1397', '0.40mm x 938mm AZ200 G550 NEXALUME® Acrylic Coated AFP', 3177, 3087, 'KGS', 'TAURANGA, NZ ', 'RIVERLEA', 'SOX24-24086', '2024-09-22 11:09:20', '2024-09-22 11:09:20'),
(8, 'CL24-107065', 'NEXALUME ® COIL AS / NZ - 1397', '0.40mm x 938mm AZ200 G550 NEXALUME® Acrylic Coated AFP', 3319, 3229, 'KGS', 'TAURANGA, NZ ', 'RIVERLEA', 'SOX24-24086', '2024-09-22 11:09:20', '2024-09-22 11:09:20'),
(9, 'SL24-106316-1A-B-C-D', 'NEXALUME ® COIL AS 1397', '0.95mm x 173mm AZ150 G550 NEXALUME® TINTED GREEN - HIJAU BUARAN', 4330, 4240, 'KGS', 'NUKU\'ALOFA, TONGA', 'ITS PACIFIC LTD.', 'SOX24-24094', '2024-09-25 12:16:55', '2024-09-25 12:16:55'),
(10, 'SL24-106316-2E-F-G', 'NEXALUME ® COIL AS 1397', '0.95mm x 173mm AZ150 G550 NEXALUME® TINTED GREEN - HIJAU BUARAN', 3270, 3180, 'KGS', 'NUKU\'ALOFA, TONGA', 'ITS PACIFIC LTD.', 'SOX24-24094', '2024-09-25 12:16:55', '2024-09-25 12:16:55'),
(11, 'SL24-106317-1A-B-C-D', 'NEXALUME ® COIL AS 1397', '0.95mm x 173mm AZ150 G550 NEXALUME® TINTED GREEN - HIJAU BUARAN', 4314, 4224, 'KGS', 'NUKU\'ALOFA, TONGA', 'ITS PACIFIC LTD.', 'SOX24-24094', '2024-09-25 12:16:55', '2024-09-25 12:16:55'),
(12, 'SL24-106317-2E-F-G', 'NEXALUME ® COIL AS 1397', '0.95mm x 173mm AZ150 G550 NEXALUME® TINTED GREEN - HIJAU BUARAN', 3258, 3168, 'KGS', 'NUKU\'ALOFA, TONGA', 'ITS PACIFIC LTD.', 'SOX24-24094', '2024-09-25 12:16:55', '2024-09-25 12:16:55'),
(13, 'SL24-106318-1A-B-C-D', 'NEXALUME ® COIL AS 1397', '0.95mm x 173mm AZ150 G550 NEXALUME® TINTED GREEN - HIJAU BUARAN', 4094, 4004, 'KGS', 'NUKU\'ALOFA, TONGA', 'ITS PACIFIC LTD.', 'SOX24-24094', '2024-09-25 12:16:55', '2024-09-25 12:16:55'),
(14, 'SL24-106318-2E-F-G', 'NEXALUME ® COIL AS 1397', '0.95mm x 173mm AZ150 G550 NEXALUME® TINTED GREEN - HIJAU BUARAN', 3093, 3003, 'KGS', 'NUKU\'ALOFA, TONGA', 'ITS PACIFIC LTD.', 'SOX24-24094', '2024-09-25 12:16:55', '2024-09-25 12:16:55'),
(15, 'SL24-106322-1A-B-C-D', 'NEXALUME ® COIL AS 1397', '0.95mm x 173mm AZ150 G550 NEXALUME® TINTED GREEN - HIJAU BUARAN', 4198, 4108, 'KGS', 'NUKU\'ALOFA, TONGA', 'ITS PACIFIC LTD.', 'SOX24-24094', '2024-09-25 12:16:55', '2024-09-25 12:16:55'),
(16, 'SL24-111030-1A', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  525mm Z350 G450 NEXIUM® PASSIVATION', 3485, 3395, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073', '2024-09-26 14:12:42', '2024-09-26 14:12:42'),
(17, 'SL24-111030-2B', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  525mm Z350 G450 NEXIUM® PASSIVATION', 3485, 3395, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073', '2024-09-26 14:12:42', '2024-09-26 14:12:42'),
(18, 'SL24-111031-1A', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  525mm Z350 G450 NEXIUM® PASSIVATION', 3585, 3495, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073', '2024-09-26 14:12:42', '2024-09-26 14:12:42'),
(19, 'SL24-111031-2B', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  525mm Z350 G450 NEXIUM® PASSIVATION', 3585, 3495, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073', '2024-09-26 14:12:42', '2024-09-26 14:12:42'),
(20, 'SL24-111032-1A', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  525mm Z350 G450 NEXIUM® PASSIVATION', 3146, 3056, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073', '2024-09-26 14:12:42', '2024-09-26 14:12:42'),
(21, 'SL24-111032-2B', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  525mm Z350 G450 NEXIUM® PASSIVATION', 3146, 3056, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073', '2024-09-26 14:12:42', '2024-09-26 14:12:42'),
(22, 'SL24-111033-1A', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  525mm Z350 G450 NEXIUM® PASSIVATION', 4722, 4632, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073', '2024-09-26 14:12:42', '2024-09-26 14:12:42'),
(23, 'SL24-111033-2B', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  525mm Z350 G450 NEXIUM® PASSIVATION', 4722, 4632, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073', '2024-09-26 14:12:42', '2024-09-26 14:12:42'),
(24, 'SL24-111034-1A', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  525mm Z350 G450 NEXIUM® PASSIVATION', 4653, 4563, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073', '2024-09-26 14:12:42', '2024-09-26 14:12:42'),
(25, 'SL24-111034-2B', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  525mm Z350 G450 NEXIUM® PASSIVATION', 4653, 4563, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073', '2024-09-26 14:12:42', '2024-09-26 14:12:42'),
(26, 'SL24-111035-1A', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  525mm Z350 G450 NEXIUM® PASSIVATION', 4681, 4591, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073', '2024-09-26 14:12:42', '2024-09-26 14:12:42'),
(27, 'SL24-111035-2B', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  525mm Z350 G450 NEXIUM® PASSIVATION', 4681, 4591, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073', '2024-09-26 14:12:42', '2024-09-26 14:12:42'),
(28, 'SL24-111036-1A', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  525mm Z350 G450 NEXIUM® PASSIVATION', 4650, 4560, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073', '2024-09-26 14:12:42', '2024-09-26 14:12:42'),
(29, 'SL24-111036-2B', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  525mm Z350 G450 NEXIUM® PASSIVATION', 4650, 4560, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073', '2024-09-26 14:12:42', '2024-09-26 14:12:42'),
(30, 'SL24-111037-1A', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  525mm Z350 G450 NEXIUM® PASSIVATION', 4919, 4829, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073', '2024-09-26 14:12:42', '2024-09-26 14:12:42'),
(31, 'SL24-111037-2B', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  525mm Z350 G450 NEXIUM® PASSIVATION', 4919, 4829, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073', '2024-09-26 14:12:42', '2024-09-26 14:12:42'),
(32, 'SL24-111038-1A', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  525mm Z350 G450 NEXIUM® PASSIVATION', 4862, 4772, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073', '2024-09-26 14:12:42', '2024-09-26 14:12:42'),
(33, 'SL24-111038-2B', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  525mm Z350 G450 NEXIUM® PASSIVATION', 4862, 4772, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073', '2024-09-26 14:12:42', '2024-09-26 14:12:42'),
(34, 'SL24-111039-1A', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  525mm Z350 G450 NEXIUM® PASSIVATION', 4950, 4860, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073', '2024-09-26 14:12:42', '2024-09-26 14:12:42'),
(35, 'SL24-111039-2B', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  525mm Z350 G450 NEXIUM® PASSIVATION', 4950, 4860, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073', '2024-09-26 14:12:42', '2024-09-26 14:12:42'),
(36, 'SL24-111040-1A', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  525mm Z350 G450 NEXIUM® PASSIVATION', 4841, 4751, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073', '2024-09-26 14:12:43', '2024-09-26 14:12:43'),
(37, 'SL24-111040-2B', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  525mm Z350 G450 NEXIUM® PASSIVATION', 4841, 4751, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073', '2024-09-26 14:12:43', '2024-09-26 14:12:43'),
(38, 'SL24-111041-1A', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  525mm Z350 G450 NEXIUM® PASSIVATION', 4633, 4543, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073', '2024-09-26 14:12:43', '2024-09-26 14:12:43'),
(39, 'SL24-111041-2B', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  525mm Z350 G450 NEXIUM® PASSIVATION', 4633, 4543, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073', '2024-09-26 14:12:43', '2024-09-26 14:12:43'),
(40, 'SL24-111042-1A', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  525mm Z350 G450 NEXIUM® PASSIVATION', 4647, 4557, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073', '2024-09-29 11:43:24', '2024-09-29 11:43:24'),
(41, 'SL24-111042-2B', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  525mm Z350 G450 NEXIUM® PASSIVATION', 4647, 4557, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073', '2024-09-29 11:43:25', '2024-09-29 11:43:25'),
(42, 'SL24-111043-1A', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  525mm Z350 G450 NEXIUM® PASSIVATION', 4129, 4039, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073', '2024-09-29 11:43:25', '2024-09-29 11:43:25'),
(43, 'SL24-111043-2B', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  525mm Z350 G450 NEXIUM® PASSIVATION', 4129, 4039, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073', '2024-09-29 11:43:25', '2024-09-29 11:43:25'),
(44, 'SL24-111044-1A', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  525mm Z350 G450 NEXIUM® PASSIVATION', 4098, 4008, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073', '2024-09-29 11:43:25', '2024-09-29 11:43:25'),
(45, 'SL24-111044-2B', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  525mm Z350 G450 NEXIUM® PASSIVATION', 4098, 4008, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073', '2024-09-29 11:43:25', '2024-09-29 11:43:25'),
(46, 'SL24-111045-1A', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  525mm Z350 G450 NEXIUM® PASSIVATION', 4590, 4500, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073', '2024-09-29 11:43:25', '2024-09-29 11:43:25'),
(47, 'SL24-111045-2B', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  525mm Z350 G450 NEXIUM® PASSIVATION', 4590, 4500, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073', '2024-09-29 11:43:25', '2024-09-29 11:43:25'),
(48, 'SL24-111046-1A', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  525mm Z350 G450 NEXIUM® PASSIVATION', 4494, 4404, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073', '2024-09-29 11:43:25', '2024-09-29 11:43:25'),
(49, 'SL24-111046-2B', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  525mm Z350 G450 NEXIUM® PASSIVATION', 4494, 4404, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073', '2024-09-29 11:43:25', '2024-09-29 11:43:25'),
(50, 'SL24-111047-1A', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  525mm Z350 G450 NEXIUM® PASSIVATION', 4055, 3965, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073', '2024-09-29 11:43:25', '2024-09-29 11:43:25'),
(51, 'SL24-111047-2B', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  525mm Z350 G450 NEXIUM® PASSIVATION', 4055, 3965, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073', '2024-09-29 11:43:25', '2024-09-29 11:43:25'),
(52, 'SL24-111076-1A-B', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 5722, 5632, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073', '2024-09-30 11:21:14', '2024-09-30 11:21:14'),
(53, 'SL24-111076-2C', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 2816, 2816, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073', '2024-09-30 11:21:14', '2024-09-30 11:21:14'),
(54, 'SL24-111077-2C', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 2899, 2809, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073', '2024-09-30 11:21:14', '2024-09-30 11:21:14'),
(55, 'SL24-111077-1A-B', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 5708, 5618, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073', '2024-09-30 11:21:14', '2024-09-30 11:21:14'),
(56, 'SL24-111078-1A-B', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 5788, 5698, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073', '2024-09-30 11:21:14', '2024-09-30 11:21:14'),
(57, 'SL24-111078-2C', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 2849, 2849, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073', '2024-09-30 11:21:14', '2024-09-30 11:21:14'),
(58, 'SL24-111079-2C', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 2919, 2829, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073', '2024-09-30 11:21:14', '2024-09-30 11:21:14'),
(59, 'SL24-111079-1A-B', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 5748, 5658, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073', '2024-09-30 11:21:14', '2024-09-30 11:21:14'),
(60, 'SL24-111080-1A-B', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 5220, 5130, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073', '2024-09-30 11:21:14', '2024-09-30 11:21:14'),
(61, 'SL24-111080-2C', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 2565, 2565, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073', '2024-09-30 11:21:14', '2024-09-30 11:21:14'),
(62, 'SL24-111083-2C', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 2621, 2531, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073', '2024-09-30 11:21:14', '2024-09-30 11:21:14'),
(63, 'SL24-111083-1A-B', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 5152, 5062, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073', '2024-09-30 11:21:14', '2024-09-30 11:21:14'),
(64, 'SL24-111084-1A-B', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 5402, 5312, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073', '2024-09-30 11:21:14', '2024-09-30 11:21:14'),
(65, 'SL24-111084-2C', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 2656, 2656, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073', '2024-09-30 11:21:14', '2024-09-30 11:21:14'),
(66, 'SL24-111085-2C', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 2738, 2648, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073', '2024-09-30 11:21:14', '2024-09-30 11:21:14'),
(67, 'SL24-111085-1A-B', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 5386, 5296, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073', '2024-09-30 11:21:14', '2024-09-30 11:21:14'),
(68, 'SL24-111091-1A-B', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 4996, 4906, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073', '2024-09-30 11:21:14', '2024-09-30 11:21:14'),
(69, 'SL24-111091-2C', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 2453, 2453, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073', '2024-09-30 11:21:14', '2024-09-30 11:21:14'),
(70, 'SL24-111086-2C', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 2786, 2696, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073', '2024-09-30 11:21:14', '2024-09-30 11:21:14'),
(71, 'SL24-111086-1A-B', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 5482, 5392, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073', '2024-09-30 11:21:14', '2024-09-30 11:21:14'),
(72, 'SL24-111087-1A-B', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 5416, 5326, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073', '2024-09-30 11:21:14', '2024-09-30 11:21:14'),
(73, 'SL24-111087-2C', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 2663, 2663, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073', '2024-09-30 11:21:14', '2024-09-30 11:21:14'),
(74, 'SL24-111088-2C', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 2764, 2674, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073', '2024-09-30 11:21:14', '2024-09-30 11:21:14'),
(75, 'SL24-111088-1A-B', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 5438, 5348, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073', '2024-09-30 11:21:14', '2024-09-30 11:21:14'),
(76, 'SL24-111089-1A-B', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 5410, 5320, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073', '2024-09-30 11:21:14', '2024-09-30 11:21:14'),
(77, 'SL24-111089-2C', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 2660, 2660, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073', '2024-09-30 11:21:14', '2024-09-30 11:21:14'),
(78, 'SL24-111090-2C', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 2858, 2768, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073', '2024-09-30 11:21:14', '2024-09-30 11:21:14'),
(79, 'SL24-111090-1A-B', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 5626, 5536, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073', '2024-09-30 11:21:14', '2024-09-30 11:21:14'),
(80, 'SL24-111092-1A-B', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 5538, 5448, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-3', '2024-09-30 16:56:47', '2024-09-30 16:56:47'),
(81, 'SL24-111092-2C', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 2724, 2724, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-3', '2024-09-30 16:56:47', '2024-09-30 16:56:47'),
(82, 'SL24-111108-2C', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 2677, 2587, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-3', '2024-09-30 16:56:47', '2024-09-30 16:56:47'),
(83, 'SL24-111108-1A-B', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 5264, 5174, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-3', '2024-09-30 16:56:47', '2024-09-30 16:56:47'),
(84, 'SL24-111109-1A-B', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 4854, 4764, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-3', '2024-09-30 16:56:47', '2024-09-30 16:56:47'),
(85, 'SL24-111109-2C', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 2382, 2382, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-3', '2024-09-30 16:56:47', '2024-09-30 16:56:47'),
(86, 'SL24-111110-2C', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 2641, 2551, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-3', '2024-09-30 16:56:47', '2024-09-30 16:56:47'),
(87, 'SL24-111110-1A-B', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 5192, 5102, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-3', '2024-09-30 16:56:47', '2024-09-30 16:56:47'),
(88, 'SL24-111111-1A-B', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 5278, 5188, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-3', '2024-09-30 16:56:47', '2024-09-30 16:56:47'),
(89, 'SL24-111111-2C', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 2594, 2594, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-3', '2024-09-30 16:56:47', '2024-09-30 16:56:47'),
(90, 'SL24-111112-2C', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 2540, 2450, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-3', '2024-09-30 16:56:47', '2024-09-30 16:56:47'),
(91, 'SL24-111112-1A-B', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 4990, 4900, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-3', '2024-09-30 16:56:47', '2024-09-30 16:56:47'),
(92, 'SL24-111095-1A-B', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 5814, 5724, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-3', '2024-09-30 16:56:47', '2024-09-30 16:56:47'),
(93, 'SL24-111095-2C', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 2862, 2862, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-3', '2024-09-30 16:56:47', '2024-09-30 16:56:47'),
(94, 'SL24-111114-2C', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 2465, 2375, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-3', '2024-09-30 16:56:47', '2024-09-30 16:56:47'),
(95, 'SL24-111114-1A-B', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 4840, 4750, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-3', '2024-09-30 16:56:47', '2024-09-30 16:56:47'),
(96, 'SL24-111097-1A-B', 'NEXIUM® COIL, AS - 1397', '1.50mm x 295mm Z350 G450 NEXIUM® PASSIVATION', 5658, 5568, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-1', '2024-10-03 11:38:29', '2024-10-03 11:38:29'),
(97, 'SL24-111097-2C', 'NEXIUM® COIL, AS - 1397', '1.50mm x 295mm Z350 G450 NEXIUM® PASSIVATION', 2784, 2784, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-1', '2024-10-03 11:38:29', '2024-10-03 11:38:29'),
(98, 'SL24-111098-2C', 'NEXIUM® COIL, AS - 1397', '1.50mm x 295mm Z350 G450 NEXIUM® PASSIVATION', 3074, 2984, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-1', '2024-10-03 11:38:29', '2024-10-03 11:38:29'),
(99, 'SL24-111098-1A-B', 'NEXIUM® COIL, AS - 1397', '1.50mm x 295mm Z350 G450 NEXIUM® PASSIVATION', 6058, 5968, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-1', '2024-10-03 11:38:29', '2024-10-03 11:38:29'),
(100, 'SL24-111099-1A-B', 'NEXIUM® COIL, AS - 1397', '1.50mm x 295mm Z350 G450 NEXIUM® PASSIVATION', 6058, 5968, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-1', '2024-10-03 11:38:29', '2024-10-03 11:38:29'),
(101, 'SL24-111099-2C', 'NEXIUM® COIL, AS - 1397', '1.50mm x 295mm Z350 G450 NEXIUM® PASSIVATION', 2984, 2984, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-1', '2024-10-03 11:38:29', '2024-10-03 11:38:29'),
(102, 'SL24-111100-2C', 'NEXIUM® COIL, AS - 1397', '1.50mm x 295mm Z350 G450 NEXIUM® PASSIVATION', 3043, 2953, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-1', '2024-10-03 11:38:29', '2024-10-03 11:38:29'),
(103, 'SL24-111100-1A-B', 'NEXIUM® COIL, AS - 1397', '1.50mm x 295mm Z350 G450 NEXIUM® PASSIVATION', 5996, 5906, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-1', '2024-10-03 11:38:29', '2024-10-03 11:38:29'),
(104, 'SL24-111102-1A-B', 'NEXIUM® COIL, AS - 1397', '1.50mm x 295mm Z350 G450 NEXIUM® PASSIVATION', 6068, 5978, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-1', '2024-10-03 11:38:29', '2024-10-03 11:38:29'),
(105, 'SL24-111102-2C', 'NEXIUM® COIL, AS - 1397', '1.50mm x 295mm Z350 G450 NEXIUM® PASSIVATION', 2989, 2989, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-1', '2024-10-03 11:38:29', '2024-10-03 11:38:29'),
(106, 'SL24-111103-2C', 'NEXIUM® COIL, AS - 1397', '1.50mm x 295mm Z350 G450 NEXIUM® PASSIVATION', 3071, 2981, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-1', '2024-10-03 11:38:29', '2024-10-03 11:38:29'),
(107, 'SL24-111103-1A-B', 'NEXIUM® COIL, AS - 1397', '1.50mm x 295mm Z350 G450 NEXIUM® PASSIVATION', 6052, 5962, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-1', '2024-10-03 11:38:29', '2024-10-03 11:38:29'),
(108, 'SL24-111104-1A-B', 'NEXIUM® COIL, AS - 1397', '1.50mm x 295mm Z350 G450 NEXIUM® PASSIVATION', 5842, 5752, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-1', '2024-10-03 11:38:29', '2024-10-03 11:38:29'),
(109, 'SL24-111104-2C', 'NEXIUM® COIL, AS - 1397', '1.50mm x 295mm Z350 G450 NEXIUM® PASSIVATION', 2876, 2876, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-1', '2024-10-03 11:38:29', '2024-10-03 11:38:29'),
(110, 'SL24-111105-2C', 'NEXIUM® COIL, AS - 1397', '1.50mm x 295mm Z350 G450 NEXIUM® PASSIVATION', 2942, 2852, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-1', '2024-10-03 11:38:29', '2024-10-03 11:38:29'),
(111, 'SL24-111105-1A-B', 'NEXIUM® COIL, AS - 1397', '1.50mm x 295mm Z350 G450 NEXIUM® PASSIVATION', 5794, 5704, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-1', '2024-10-03 11:38:29', '2024-10-03 11:38:29'),
(112, 'SL24-111106-1A-B', 'NEXIUM® COIL, AS - 1397', '1.50mm x 295mm Z350 G450 NEXIUM® PASSIVATION', 5868, 5778, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-1', '2024-10-03 11:38:29', '2024-10-03 11:38:29'),
(113, 'SL24-111106-2C', 'NEXIUM® COIL, AS - 1397', '1.50mm x 295mm Z350 G450 NEXIUM® PASSIVATION', 2889, 2889, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-1', '2024-10-03 11:38:29', '2024-10-03 11:38:29'),
(114, 'SL24-111107-2C', 'NEXIUM® COIL, AS - 1397', '1.50mm x 295mm Z350 G450 NEXIUM® PASSIVATION', 3043, 2953, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-1', '2024-10-03 11:38:29', '2024-10-03 11:38:29'),
(115, 'SL24-111107-1A-B', 'NEXIUM® COIL, AS - 1397', '1.50mm x 295mm Z350 G450 NEXIUM® PASSIVATION', 5996, 5906, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-1', '2024-10-03 11:38:29', '2024-10-03 11:38:29'),
(116, 'SL24-111113-1A-B', 'NEXIUM® COIL, AS - 1397', '1.50mm x 295mm Z350 G450 NEXIUM® PASSIVATION', 5890, 5800, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-1', '2024-10-03 11:38:29', '2024-10-03 11:38:29'),
(117, 'SL24-111113-2C', 'NEXIUM® COIL, AS - 1397', '1.50mm x 295mm Z350 G450 NEXIUM® PASSIVATION', 2900, 2900, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-1', '2024-10-03 11:38:29', '2024-10-03 11:38:29'),
(118, 'SL24-111115-2C', 'NEXIUM® COIL, AS - 1397', '1.50mm x 295mm Z350 G450 NEXIUM® PASSIVATION', 2960, 2870, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-1', '2024-10-03 11:38:29', '2024-10-03 11:38:29'),
(119, 'SL24-111115-1A-B', 'NEXIUM® COIL, AS - 1397', '1.50mm x 295mm Z350 G450 NEXIUM® PASSIVATION', 5830, 5740, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-1', '2024-10-03 11:38:29', '2024-10-03 11:38:29'),
(120, 'SL24-111120-1A-B', 'NEXIUM® COIL, AS - 1397', '1.50mm x 295mm Z350 G450 NEXIUM® PASSIVATION', 5892, 5802, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-1', '2024-10-03 11:38:29', '2024-10-03 11:38:29'),
(121, 'SL24-111120-2C', 'NEXIUM® COIL, AS - 1397', '1.50mm x 295mm Z350 G450 NEXIUM® PASSIVATION', 2901, 2901, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-1', '2024-10-03 11:38:29', '2024-10-03 11:38:29'),
(122, 'SL24-111121-2C', 'NEXIUM® COIL, AS - 1397', '1.50mm x 295mm Z350 G450 NEXIUM® PASSIVATION', 3018, 2928, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-1', '2024-10-03 11:38:29', '2024-10-03 11:38:29'),
(123, 'SL24-111121-1A-B', 'NEXIUM® COIL, AS - 1397', '1.50mm x 295mm Z350 G450 NEXIUM® PASSIVATION', 5946, 5856, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-1', '2024-10-03 11:38:29', '2024-10-03 11:38:29'),
(124, 'SL24-111122-1A-B', 'NEXIUM® COIL, AS - 1397', '1.50mm x 295mm Z350 G450 NEXIUM® PASSIVATION', 5976, 5886, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-1', '2024-10-03 11:38:29', '2024-10-03 11:38:29'),
(125, 'SL24-111122-2C', 'NEXIUM® COIL, AS - 1397', '1.50mm x 295mm Z350 G450 NEXIUM® PASSIVATION', 2943, 2943, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-1', '2024-10-03 11:38:29', '2024-10-03 11:38:29'),
(126, 'SL24-111123-2C', 'NEXIUM® COIL, AS - 1397', '1.50mm x 295mm Z350 G450 NEXIUM® PASSIVATION', 3015, 2925, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-1', '2024-10-03 11:38:29', '2024-10-03 11:38:29'),
(127, 'SL24-111123-1A-B', 'NEXIUM® COIL, AS - 1397', '1.50mm x 295mm Z350 G450 NEXIUM® PASSIVATION', 5940, 5850, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-1', '2024-10-03 11:38:29', '2024-10-03 11:38:29'),
(128, 'SL24-111127-1A-B', 'NEXIUM® COIL, AS - 1397', '1.50mm x 295mm Z350 G450 NEXIUM® PASSIVATION', 6050, 5960, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-1', '2024-10-03 11:38:29', '2024-10-03 11:38:29'),
(129, 'SL24-111127-2C', 'NEXIUM® COIL, AS - 1397', '1.50mm x 295mm Z350 G450 NEXIUM® PASSIVATION', 2980, 2980, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-1', '2024-10-03 11:38:29', '2024-10-03 11:38:29'),
(130, 'SL24-111130-2C', 'NEXIUM® COIL, AS - 1397', '1.50mm x 295mm Z350 G450 NEXIUM® PASSIVATION', 3030, 2940, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-1', '2024-10-03 11:38:29', '2024-10-03 11:38:29'),
(131, 'SL24-111130-1A-B', 'NEXIUM® COIL, AS - 1397', '1.50mm x 295mm Z350 G450 NEXIUM® PASSIVATION', 5970, 5880, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-1', '2024-10-03 11:38:29', '2024-10-03 11:38:29'),
(132, 'SL24-111131-1A-B', 'NEXIUM® COIL, AS - 1397', '1.50mm x 295mm Z350 G450 NEXIUM® PASSIVATION', 5890, 5800, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-1', '2024-10-03 11:38:29', '2024-10-03 11:38:29'),
(133, 'SL24-111131-2C', 'NEXIUM® COIL, AS - 1397', '1.50mm x 295mm Z350 G450 NEXIUM® PASSIVATION', 2900, 2900, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-1', '2024-10-03 11:38:29', '2024-10-03 11:38:29'),
(134, 'SL24-111132-2C', 'NEXIUM® COIL, AS - 1397', '1.50mm x 295mm Z350 G450 NEXIUM® PASSIVATION', 2889, 2799, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-1', '2024-10-03 11:38:29', '2024-10-03 11:38:29'),
(135, 'SL24-111132-1A-B', 'NEXIUM® COIL, AS - 1397', '1.50mm x 295mm Z350 G450 NEXIUM® PASSIVATION', 5688, 5598, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-1', '2024-10-03 11:38:29', '2024-10-03 11:38:29'),
(136, 'SL24-111146-1A-B', 'NEXIUM® COIL, AS - 1397', '1.50mm x 295mm Z350 G450 NEXIUM® PASSIVATION', 5788, 5698, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-1', '2024-10-03 11:38:29', '2024-10-03 11:38:29'),
(137, 'SL24-111146-2C', 'NEXIUM® COIL, AS - 1397', '1.50mm x 295mm Z350 G450 NEXIUM® PASSIVATION', 2849, 2849, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-1', '2024-10-03 11:38:29', '2024-10-03 11:38:29'),
(138, 'SL24-111147-2C', 'NEXIUM® COIL, AS - 1397', '1.50mm x 295mm Z350 G450 NEXIUM® PASSIVATION', 2935, 2845, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-1', '2024-10-03 11:38:29', '2024-10-03 11:38:29'),
(139, 'SL24-111147-1A-B', 'NEXIUM® COIL, AS - 1397', '1.50mm x 295mm Z350 G450 NEXIUM® PASSIVATION', 5780, 5690, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-1', '2024-10-03 11:38:29', '2024-10-03 11:38:29'),
(140, 'SL24-111148-1A-B', 'NEXIUM® COIL, AS - 1397', '1.50mm x 295mm Z350 G450 NEXIUM® PASSIVATION', 5722, 5632, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-1', '2024-10-03 11:38:29', '2024-10-03 11:38:29'),
(141, 'SL24-111148-2C', 'NEXIUM® COIL, AS - 1397', '1.50mm x 295mm Z350 G450 NEXIUM® PASSIVATION', 2816, 2816, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-1', '2024-10-03 11:38:29', '2024-10-03 11:38:29'),
(142, 'SL24-111149-2C', 'NEXIUM® COIL, AS - 1397', '1.50mm x 295mm Z350 G450 NEXIUM® PASSIVATION', 3020, 2930, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-1', '2024-10-03 11:38:29', '2024-10-03 11:38:29'),
(143, 'SL24-111149-1A-B', 'NEXIUM® COIL, AS - 1397', '1.50mm x 295mm Z350 G450 NEXIUM® PASSIVATION', 5950, 5860, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-1', '2024-10-03 11:38:29', '2024-10-03 11:38:29'),
(144, 'SL24-111150-1A-B', 'NEXIUM® COIL, AS - 1397', '1.50mm x 295mm Z350 G450 NEXIUM® PASSIVATION', 5634, 5544, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-1', '2024-10-03 11:38:29', '2024-10-03 11:38:29'),
(145, 'SL24-111150-2C', 'NEXIUM® COIL, AS - 1397', '1.50mm x 295mm Z350 G450 NEXIUM® PASSIVATION', 2772, 2772, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-1', '2024-10-03 11:38:29', '2024-10-03 11:38:29'),
(146, 'SL24-111151-2C', 'NEXIUM® COIL, AS - 1397', '1.50mm x 295mm Z350 G450 NEXIUM® PASSIVATION', 3004, 2914, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-1', '2024-10-03 11:38:29', '2024-10-03 11:38:29'),
(147, 'SL24-111151-1A-B', 'NEXIUM® COIL, AS - 1397', '1.50mm x 295mm Z350 G450 NEXIUM® PASSIVATION', 5918, 5828, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-1', '2024-10-03 11:38:29', '2024-10-03 11:38:29'),
(148, 'SL24-111152-1A-B', 'NEXIUM® COIL, AS - 1397', '1.50mm x 295mm Z350 G450 NEXIUM® PASSIVATION', 5968, 5878, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-1', '2024-10-03 11:38:29', '2024-10-03 11:38:29'),
(149, 'SL24-111152-2C', 'NEXIUM® COIL, AS - 1397', '1.50mm x 295mm Z350 G450 NEXIUM® PASSIVATION', 2939, 2939, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-1', '2024-10-03 11:38:29', '2024-10-03 11:38:29'),
(150, 'SL24-111153-2C', 'NEXIUM® COIL, AS - 1397', '1.50mm x 295mm Z350 G450 NEXIUM® PASSIVATION', 3056, 2966, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-1', '2024-10-03 11:38:29', '2024-10-03 11:38:29'),
(151, 'SL24-111153-1A-B', 'NEXIUM® COIL, AS - 1397', '1.50mm x 295mm Z350 G450 NEXIUM® PASSIVATION', 6022, 5932, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-1', '2024-10-03 11:38:29', '2024-10-03 11:38:29'),
(172, 'SL24-111159-1A', 'NEXIUM® COIL, AS - 1397', '1.90mm x 425mm Z350 G450 NEXIUM® PASSIVATION', 4264, 4174, 'KG', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD', 'SOX24-24073', '2024-10-03 14:40:29', '2024-10-03 14:40:29'),
(173, 'SL24-111159-2B', 'NEXIUM® COIL, AS - 1397', '1.90mm x 425mm Z350 G450 NEXIUM® PASSIVATION', 4264, 4174, 'KG', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD', 'SOX24-24073', '2024-10-03 14:40:29', '2024-10-03 14:40:29'),
(174, 'SL24-111161-1A', 'NEXIUM® COIL, AS - 1397', '1.90mm x 425mm Z350 G450 NEXIUM® PASSIVATION', 4272, 4182, 'KG', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD', 'SOX24-24073', '2024-10-03 14:40:29', '2024-10-03 14:40:29'),
(175, 'SL24-111161-2B', 'NEXIUM® COIL, AS - 1397', '1.90mm x 425mm Z350 G450 NEXIUM® PASSIVATION', 4272, 4182, 'KG', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD', 'SOX24-24073', '2024-10-03 14:40:29', '2024-10-03 14:40:29'),
(176, 'SL24-111163-1A', 'NEXIUM® COIL, AS - 1397', '1.90mm x 425mm Z350 G450 NEXIUM® PASSIVATION', 3976, 3886, 'KG', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD', 'SOX24-24073', '2024-10-03 14:40:29', '2024-10-03 14:40:29'),
(177, 'SL24-111163-2B', 'NEXIUM® COIL, AS - 1397', '1.90mm x 425mm Z350 G450 NEXIUM® PASSIVATION', 3976, 3886, 'KG', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD', 'SOX24-24073', '2024-10-03 14:40:29', '2024-10-03 14:40:29'),
(178, 'SL24-111165-1A', 'NEXIUM® COIL, AS - 1397', '1.90mm x 425mm Z350 G450 NEXIUM® PASSIVATION', 3988, 3898, 'KG', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD', 'SOX24-24073', '2024-10-03 14:40:29', '2024-10-03 14:40:29'),
(179, 'SL24-111165-2B', 'NEXIUM® COIL, AS - 1397', '1.90mm x 425mm Z350 G450 NEXIUM® PASSIVATION', 3988, 3898, 'KG', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD', 'SOX24-24073', '2024-10-03 14:40:29', '2024-10-03 14:40:29'),
(180, 'SL24-111167-1A', 'NEXIUM® COIL, AS - 1397', '1.90mm x 425mm Z350 G450 NEXIUM® PASSIVATION', 4231, 4141, 'KG', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD', 'SOX24-24073', '2024-10-03 14:40:29', '2024-10-03 14:40:29'),
(181, 'SL24-111167-2B', 'NEXIUM® COIL, AS - 1397', '1.90mm x 425mm Z350 G450 NEXIUM® PASSIVATION', 4231, 4141, 'KG', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD', 'SOX24-24073', '2024-10-03 14:40:29', '2024-10-03 14:40:29'),
(182, 'SL24-111169-1A', 'NEXIUM® COIL, AS - 1397', '1.90mm x 425mm Z350 G450 NEXIUM® PASSIVATION', 4223, 4133, 'KG', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD', 'SOX24-24073', '2024-10-03 14:40:29', '2024-10-03 14:40:29'),
(183, 'SL24-111169-2B', 'NEXIUM® COIL, AS - 1397', '1.90mm x 425mm Z350 G450 NEXIUM® PASSIVATION', 4223, 4133, 'KG', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD', 'SOX24-24073', '2024-10-03 14:40:29', '2024-10-03 14:40:29'),
(184, 'SL24-111172-1A', 'NEXIUM® COIL, AS - 1397', '1.90mm x 425mm Z350 G450 NEXIUM® PASSIVATION', 4138, 4048, 'KG', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD', 'SOX24-24073', '2024-10-03 14:40:29', '2024-10-03 14:40:29'),
(185, 'SL24-111172-2B', 'NEXIUM® COIL, AS - 1397', '1.90mm x 425mm Z350 G450 NEXIUM® PASSIVATION', 4138, 4048, 'KG', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD', 'SOX24-24073', '2024-10-03 14:40:29', '2024-10-03 14:40:29'),
(186, 'SL24-111173-1A', 'NEXIUM® COIL, AS - 1397', '1.90mm x 425mm Z350 G450 NEXIUM® PASSIVATION', 4145, 4055, 'KG', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD', 'SOX24-24073', '2024-10-03 14:40:29', '2024-10-03 14:40:29'),
(187, 'SL24-111173-2B', 'NEXIUM® COIL, AS - 1397', '1.90mm x 425mm Z350 G450 NEXIUM® PASSIVATION', 4145, 4055, 'KG', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD', 'SOX24-24073', '2024-10-03 14:40:29', '2024-10-03 14:40:29'),
(188, 'SL24-111175-1A', 'NEXIUM® COIL, AS - 1397', '1.90mm x 425mm Z350 G450 NEXIUM® PASSIVATION', 2976, 2886, 'KG', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD', 'SOX24-24073', '2024-10-03 14:40:29', '2024-10-03 14:40:29'),
(189, 'SL24-111175-2B', 'NEXIUM® COIL, AS - 1397', '1.90mm x 425mm Z350 G450 NEXIUM® PASSIVATION', 2976, 2886, 'KG', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD', 'SOX24-24073', '2024-10-03 14:40:29', '2024-10-03 14:40:29'),
(190, 'SL24-111177-1A', 'NEXIUM® COIL, AS - 1397', '1.90mm x 425mm Z350 G450 NEXIUM® PASSIVATION', 3987, 3897, 'KG', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD', 'SOX24-24073', '2024-10-03 14:40:29', '2024-10-03 14:40:29'),
(191, 'SL24-111177-2B', 'NEXIUM® COIL, AS - 1397', '1.90mm x 425mm Z350 G450 NEXIUM® PASSIVATION', 3987, 3897, 'KG', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD', 'SOX24-24073', '2024-10-03 14:40:29', '2024-10-03 14:40:29'),
(192, 'SL24-111093-1A-B', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 5222, 5132, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD', 'SOX24-24073-3', '2024-10-03 16:38:18', '2024-10-03 16:38:18'),
(193, 'SL24-111093-2C', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 2566, 2566, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD', 'SOX24-24073-3', '2024-10-03 16:38:18', '2024-10-03 16:38:18'),
(194, 'SL24-111116-2C', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 2660, 2570, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD', 'SOX24-24073-3', '2024-10-03 16:38:18', '2024-10-03 16:38:18'),
(195, 'SL24-111116-1A-B', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 5230, 5140, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD', 'SOX24-24073-3', '2024-10-03 16:38:18', '2024-10-03 16:38:18'),
(196, 'SL24-111117-1A-B', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 5432, 5342, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD', 'SOX24-24073-3', '2024-10-03 16:38:18', '2024-10-03 16:38:18'),
(197, 'SL24-111117-2C', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 2671, 2671, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD', 'SOX24-24073-3', '2024-10-03 16:38:18', '2024-10-03 16:38:18'),
(198, 'SL24-111118-2C', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 2693, 2603, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD', 'SOX24-24073-3', '2024-10-03 16:38:18', '2024-10-03 16:38:18'),
(199, 'SL24-111118-1A-B', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 5296, 5206, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD', 'SOX24-24073-3', '2024-10-03 16:38:18', '2024-10-03 16:38:18'),
(200, 'SL24-111119-1A-B', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 5552, 5462, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD', 'SOX24-24073-3', '2024-10-03 16:38:18', '2024-10-03 16:38:18'),
(201, 'SL24-111119-2C', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 2731, 2731, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD', 'SOX24-24073-3', '2024-10-03 16:38:18', '2024-10-03 16:38:18'),
(202, 'SL24-111124-2C', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 2462, 2372, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD', 'SOX24-24073-3', '2024-10-03 16:38:18', '2024-10-03 16:38:18'),
(203, 'SL24-111124-1A-B', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 4834, 4744, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD', 'SOX24-24073-3', '2024-10-03 16:38:18', '2024-10-03 16:38:18'),
(204, 'SL24-111125-1A-B', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 5818, 5728, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD', 'SOX24-24073-3', '2024-10-03 16:38:18', '2024-10-03 16:38:18'),
(205, 'SL24-111125-2C', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 2864, 2864, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD', 'SOX24-24073-3', '2024-10-03 16:38:18', '2024-10-03 16:38:18'),
(206, 'SL24-111126-2C', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 2819, 2729, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD', 'SOX24-24073-3', '2024-10-03 16:38:18', '2024-10-03 16:38:18'),
(207, 'SL24-111126-1A-B', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 5548, 5458, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD', 'SOX24-24073-3', '2024-10-03 16:38:18', '2024-10-03 16:38:18'),
(208, 'SL24-111096-1A-B', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 5874, 5784, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD', 'SOX24-24073-3', '2024-10-03 16:38:18', '2024-10-03 16:38:18'),
(209, 'SL24-111096-2C', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 2892, 2892, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD', 'SOX24-24073-3', '2024-10-03 16:38:18', '2024-10-03 16:38:18'),
(210, 'SL24-111128-2C', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 2943, 2853, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD', 'SOX24-24073-3', '2024-10-03 16:38:18', '2024-10-03 16:38:18'),
(211, 'SL24-111128-1A-B', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 5796, 5706, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD', 'SOX24-24073-3', '2024-10-03 16:38:18', '2024-10-03 16:38:18'),
(212, 'SL24-111129-1A-B', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 4832, 4742, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD', 'SOX24-24073-3', '2024-10-03 16:38:18', '2024-10-03 16:38:18'),
(213, 'SL24-111129-2C', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 2371, 2371, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD', 'SOX24-24073-3', '2024-10-03 16:38:18', '2024-10-03 16:38:18'),
(214, 'SL24-111094-2C', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 2648, 2558, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD', 'SOX24-24073-3', '2024-10-03 16:38:18', '2024-10-03 16:38:18'),
(215, 'SL24-111094-1A-B', 'NEXIUM® COIL, AS - 1397', '2.40mm  x  295mm Z350 G450 NEXIUM® PASSIVATION', 5206, 5116, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD', 'SOX24-24073-3', '2024-10-03 16:38:18', '2024-10-03 16:38:18'),
(216, 'SL24-111179-1A', 'NEXIUM® COIL, AS - 1397', '1.90mm  x  425mm Z350 G450 NEXIUM® PASSIVATION', 4025, 3935, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-2', '2024-10-13 14:30:11', '2024-10-13 14:30:11'),
(217, 'SL24-111179-2B', 'NEXIUM® COIL, AS - 1397', '1.90mm  x  425mm Z350 G450 NEXIUM® PASSIVATION', 4025, 3935, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-2', '2024-10-13 14:30:11', '2024-10-13 14:30:11'),
(218, 'SL24-111181-1A', 'NEXIUM® COIL, AS - 1397', '1.90mm  x  425mm Z350 G450 NEXIUM® PASSIVATION', 4225, 4135, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-2', '2024-10-13 14:30:11', '2024-10-13 14:30:11'),
(219, 'SL24-111181-2B', 'NEXIUM® COIL, AS - 1397', '1.90mm  x  425mm Z350 G450 NEXIUM® PASSIVATION', 4225, 4135, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-2', '2024-10-13 14:30:11', '2024-10-13 14:30:11'),
(220, 'SL24-111183-1A', 'NEXIUM® COIL, AS - 1397', '1.90mm  x  425mm Z350 G450 NEXIUM® PASSIVATION', 4059, 3969, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-2', '2024-10-13 14:30:11', '2024-10-13 14:30:11'),
(221, 'SL24-111183-2B', 'NEXIUM® COIL, AS - 1397', '1.90mm  x  425mm Z350 G450 NEXIUM® PASSIVATION', 4059, 3969, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-2', '2024-10-13 14:30:11', '2024-10-13 14:30:11'),
(222, 'SL24-111185-1A', 'NEXIUM® COIL, AS - 1397', '1.90mm  x  425mm Z350 G450 NEXIUM® PASSIVATION', 4179, 4089, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-2', '2024-10-13 14:30:11', '2024-10-13 14:30:11'),
(223, 'SL24-111185-2B', 'NEXIUM® COIL, AS - 1397', '1.90mm  x  425mm Z350 G450 NEXIUM® PASSIVATION', 4179, 4089, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-2', '2024-10-13 14:30:11', '2024-10-13 14:30:11'),
(224, 'SL24-111187-1A', 'NEXIUM® COIL, AS - 1397', '1.90mm  x  425mm Z350 G450 NEXIUM® PASSIVATION', 4215, 4125, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-2', '2024-10-13 14:30:11', '2024-10-13 14:30:11'),
(225, 'SL24-111187-2B', 'NEXIUM® COIL, AS - 1397', '1.90mm  x  425mm Z350 G450 NEXIUM® PASSIVATION', 4215, 4125, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-2', '2024-10-13 14:30:11', '2024-10-13 14:30:11'),
(226, 'SL24-111189-1A', 'NEXIUM® COIL, AS - 1397', '1.90mm  x  425mm Z350 G450 NEXIUM® PASSIVATION', 3309, 3219, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-2', '2024-10-13 14:30:11', '2024-10-13 14:30:11'),
(227, 'SL24-111189-2B', 'NEXIUM® COIL, AS - 1397', '1.90mm  x  425mm Z350 G450 NEXIUM® PASSIVATION', 3309, 3219, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-2', '2024-10-13 14:30:11', '2024-10-13 14:30:11'),
(228, 'SL24-111191-1A', 'NEXIUM® COIL, AS - 1397', '1.90mm  x  425mm Z350 G450 NEXIUM® PASSIVATION', 3352, 3262, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-2', '2024-10-13 14:30:11', '2024-10-13 14:30:11'),
(229, 'SL24-111191-2B', 'NEXIUM® COIL, AS - 1397', '1.90mm  x  425mm Z350 G450 NEXIUM® PASSIVATION', 3352, 3262, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-2', '2024-10-13 14:30:11', '2024-10-13 14:30:11'),
(230, 'SL24-111193-1A', 'NEXIUM® COIL, AS - 1397', '1.90mm  x  425mm Z350 G450 NEXIUM® PASSIVATION', 4190, 4100, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-2', '2024-10-13 14:30:11', '2024-10-13 14:30:11'),
(231, 'SL24-111193-2B', 'NEXIUM® COIL, AS - 1397', '1.90mm  x  425mm Z350 G450 NEXIUM® PASSIVATION', 4190, 4100, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-2', '2024-10-13 14:30:11', '2024-10-13 14:30:11'),
(232, 'SL24-111195-1A', 'NEXIUM® COIL, AS - 1397', '1.90mm  x  425mm Z350 G450 NEXIUM® PASSIVATION', 4045, 3955, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-2', '2024-10-13 14:30:11', '2024-10-13 14:30:11'),
(233, 'SL24-111195-2B', 'NEXIUM® COIL, AS - 1397', '1.90mm  x  425mm Z350 G450 NEXIUM® PASSIVATION', 4045, 3955, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD ', 'SOX24-24073-2', '2024-10-13 14:30:11', '2024-10-13 14:30:11'),
(234, 'SL24-111435-1A', 'NEXALUME® COIL, AS - 1397', '1.00mm x 468.6mm AZ150 G550 NEXALUME® Acrylic Coated AFP', 3888, 3798, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD', 'SOX24-24090', '2024-10-15 11:41:29', '2024-10-15 11:41:29'),
(235, 'SL24-111435-2B', 'NEXALUME® COIL, AS - 1397', '1.00mm x 468.6mm AZ150 G550 NEXALUME® Acrylic Coated AFP', 3888, 3798, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD', 'SOX24-24090', '2024-10-15 11:41:29', '2024-10-15 11:41:29'),
(236, 'SL24-111436-1A', 'NEXALUME® COIL, AS - 1397', '1.00mm x 468.6mm AZ150 G550 NEXALUME® Acrylic Coated AFP', 4052, 3962, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD', 'SOX24-24090', '2024-10-15 11:41:29', '2024-10-15 11:41:29'),
(237, 'SL24-111436-2B', 'NEXALUME® COIL, AS - 1397', '1.00mm x 468.6mm AZ150 G550 NEXALUME® Acrylic Coated AFP', 4052, 3962, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD', 'SOX24-24090', '2024-10-15 11:41:29', '2024-10-15 11:41:29'),
(238, 'SL24-111437-1A', 'NEXALUME® COIL, AS - 1397', '1.00mm x 468.6mm AZ150 G550 NEXALUME® Acrylic Coated AFP', 3868, 3778, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD', 'SOX24-24090', '2024-10-15 11:41:29', '2024-10-15 11:41:29'),
(239, 'SL24-111437-2B', 'NEXALUME® COIL, AS - 1397', '1.00mm x 468.6mm AZ150 G550 NEXALUME® Acrylic Coated AFP', 3868, 3778, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD', 'SOX24-24090', '2024-10-15 11:41:29', '2024-10-15 11:41:29'),
(246, 'SL24-111438-1A', 'NEXALUME® COIL, AS - 1397', '1.20mm x 468.6mm AZ150 G550 NEXALUME® Acrylic Coated AFP', 4014, 3924, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD', 'SOX24-24090', '2024-10-15 12:10:32', '2024-10-15 12:10:32'),
(247, 'SL24-111438-2B', 'NEXALUME® COIL, AS - 1397', '1.20mm x 468.6mm AZ150 G550 NEXALUME® Acrylic Coated AFP', 4014, 3924, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD', 'SOX24-24090', '2024-10-15 12:10:32', '2024-10-15 12:10:32');
INSERT INTO `shippmentb` (`id`, `atribute`, `product`, `size`, `gros`, `net`, `satuan_berat`, `destination`, `manufactur`, `type`, `created_at`, `updated_at`) VALUES
(248, 'SL24-111439-1A', 'NEXALUME® COIL, AS - 1397', '1.20mm x 468.6mm AZ150 G550 NEXALUME® Acrylic Coated AFP', 4257, 4167, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD', 'SOX24-24090', '2024-10-15 12:10:32', '2024-10-15 12:10:32'),
(249, 'SL24-111439-2B', 'NEXALUME® COIL, AS - 1397', '1.20mm x 468.6mm AZ150 G550 NEXALUME® Acrylic Coated AFP', 4257, 4167, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD', 'SOX24-24090', '2024-10-15 12:10:32', '2024-10-15 12:10:32'),
(250, 'SL24-111440-1A', 'NEXALUME® COIL, AS - 1397', '1.20mm x 468.6mm AZ150 G550 NEXALUME® Acrylic Coated AFP', 4114, 4024, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD', 'SOX24-24090', '2024-10-15 12:10:32', '2024-10-15 12:10:32'),
(251, 'SL24-111440-2B', 'NEXALUME® COIL, AS - 1397', '1.20mm x 468.6mm AZ150 G550 NEXALUME® Acrylic Coated AFP', 4114, 4024, 'KGS', 'SYDNEY, AUSTRALIA', 'BEST SHEDS PTY LTD', 'SOX24-24090', '2024-10-15 12:10:32', '2024-10-15 12:10:32'),
(252, 'SL24-111653', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4053, 3963, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-23 11:09:07', '2024-10-23 11:09:07'),
(253, 'SL24-111654', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4602, 4512, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-23 11:09:07', '2024-10-23 11:09:07'),
(254, 'SL24-111655', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4149, 4059, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-23 11:09:07', '2024-10-23 11:09:07'),
(255, 'SL24-111656', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4113, 4023, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-23 11:09:07', '2024-10-23 11:09:07'),
(256, 'SL24-111657', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4113, 4023, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-23 11:09:07', '2024-10-23 11:09:07'),
(257, 'SL24-111658', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4041, 3951, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-23 11:09:07', '2024-10-23 11:09:07'),
(258, 'SL24-111659', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4152, 4062, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-23 11:09:07', '2024-10-23 11:09:07'),
(259, 'SL24-111660', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4152, 4062, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-23 11:09:07', '2024-10-23 11:09:07'),
(260, 'SL24-111661', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4143, 4053, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-23 11:09:07', '2024-10-23 11:09:07'),
(261, 'SL24-111662', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4140, 4050, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-23 11:09:07', '2024-10-23 11:09:07'),
(262, 'SL24-111663', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4041, 3951, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-23 11:09:07', '2024-10-23 11:09:07'),
(263, 'SL24-111664', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4155, 4065, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-23 11:09:07', '2024-10-23 11:09:07'),
(264, 'SL24-111665', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4170, 4080, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-23 11:09:07', '2024-10-23 11:09:07'),
(265, 'SL24-111666', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4167, 4077, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-23 11:09:07', '2024-10-23 11:09:07'),
(266, 'SL24-111667', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4167, 4077, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-23 11:09:07', '2024-10-23 11:09:07'),
(267, 'SL24-111668', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4083, 3993, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-23 11:09:07', '2024-10-23 11:09:07'),
(268, 'SL24-111669', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4125, 4035, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-23 11:09:07', '2024-10-23 11:09:07'),
(269, 'SL24-111670', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4128, 4038, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-23 11:09:07', '2024-10-23 11:09:07'),
(270, 'SL24-111671', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4128, 4038, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-23 11:09:07', '2024-10-23 11:09:07'),
(271, 'SL24-111672', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4128, 4038, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-23 11:09:07', '2024-10-23 11:09:07'),
(272, 'SL24-111673', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4107, 4017, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-23 11:09:07', '2024-10-23 11:09:07'),
(273, 'SL24-111674', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4653, 4563, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-23 11:09:07', '2024-10-23 11:09:07'),
(274, 'SL24-111675', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4647, 4557, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-23 11:09:07', '2024-10-23 11:09:07'),
(275, 'SL24-111676', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4632, 4542, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-23 11:09:07', '2024-10-23 11:09:07'),
(276, 'SL24-111677', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4194, 4104, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-23 11:09:07', '2024-10-23 11:09:07'),
(277, 'SL24-111678', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4800, 4710, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-23 11:09:07', '2024-10-23 11:09:07'),
(278, 'SL24-111679', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4809, 4719, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-23 11:09:07', '2024-10-23 11:09:07'),
(279, 'SL24-111680', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4812, 4722, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-23 18:52:47', '2024-10-23 18:52:47'),
(280, 'SL24-111681', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4794, 4704, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-23 18:52:47', '2024-10-23 18:52:47'),
(281, 'SL24-111682', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4572, 4482, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-23 18:52:47', '2024-10-23 18:52:47'),
(282, 'SL24-111683', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4815, 4725, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-23 18:52:47', '2024-10-23 18:52:47'),
(283, 'SL24-111684', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4863, 4773, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-23 18:52:47', '2024-10-23 18:52:47'),
(284, 'SL24-111685', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4863, 4773, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-23 18:52:47', '2024-10-23 18:52:47'),
(285, 'SL24-111686', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4887, 4797, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-23 18:52:47', '2024-10-23 18:52:47'),
(286, 'SL24-111687', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4677, 4587, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-23 18:52:47', '2024-10-23 18:52:47'),
(287, 'SL24-111689', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4524, 4434, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-23 18:52:47', '2024-10-23 18:52:47'),
(288, 'SL24-111690', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4539, 4449, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-23 18:52:47', '2024-10-23 18:52:47'),
(289, 'SL24-111691', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4536, 4446, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-23 18:52:47', '2024-10-23 18:52:47'),
(290, 'SL24-111692', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4488, 4398, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-23 18:52:47', '2024-10-23 18:52:47'),
(291, 'SL24-111693', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4437, 4347, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-24 11:13:46', '2024-10-24 11:13:46'),
(292, 'SL24-111694', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4440, 4350, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-24 11:13:46', '2024-10-24 11:13:46'),
(293, 'SL24-111695', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4443, 4353, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-24 11:13:46', '2024-10-24 11:13:46'),
(294, 'SL24-111696', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4446, 4356, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-24 11:13:46', '2024-10-24 11:13:46'),
(295, 'SL24-111697', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4374, 4284, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-24 11:13:46', '2024-10-24 11:13:46'),
(296, 'SL24-111698', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4896, 4806, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-24 11:13:46', '2024-10-24 11:13:46'),
(297, 'SL24-111699', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4896, 4806, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-24 11:13:46', '2024-10-24 11:13:46'),
(298, 'SL24-111700', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4908, 4818, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-24 11:13:46', '2024-10-24 11:13:46'),
(299, 'SL24-111701', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4833, 4743, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-24 11:13:46', '2024-10-24 11:13:46'),
(300, 'SL24-111702', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4809, 4719, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-24 11:13:46', '2024-10-24 11:13:46'),
(301, 'SL24-111703', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4791, 4701, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-24 11:13:46', '2024-10-24 11:13:46'),
(302, 'SL24-111704', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4815, 4725, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-24 11:13:46', '2024-10-24 11:13:46'),
(303, 'SL24-111705', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4794, 4704, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-24 11:13:46', '2024-10-24 11:13:46'),
(304, 'SL24-111706', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4821, 4731, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-24 11:13:46', '2024-10-24 11:13:46'),
(305, 'SL24-111707', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4572, 4482, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-24 11:13:46', '2024-10-24 11:13:46'),
(306, 'SL24-111708', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4578, 4488, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-24 11:13:46', '2024-10-24 11:13:46'),
(307, 'SL24-111709', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4575, 4485, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-24 11:13:46', '2024-10-24 11:13:46'),
(308, 'SL24-111710', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4584, 4494, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-24 11:13:46', '2024-10-24 11:13:46'),
(309, 'SL24-111711', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4617, 4527, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-24 11:13:46', '2024-10-24 11:13:46'),
(310, 'SL24-111712', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4677, 4587, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-24 11:13:46', '2024-10-24 11:13:46'),
(311, 'SL24-111713', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4656, 4566, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-24 11:13:46', '2024-10-24 11:13:46'),
(312, 'SL24-111714', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4680, 4590, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-24 11:13:46', '2024-10-24 11:13:46'),
(313, 'SL24-111716', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4443, 4353, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-24 11:13:46', '2024-10-24 11:13:46'),
(314, 'SL24-111717', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4455, 4365, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-24 11:13:46', '2024-10-24 11:13:46'),
(315, 'SL24-111718', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4440, 4350, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-24 11:13:46', '2024-10-24 11:13:46'),
(316, 'SL24-111719', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4452, 4362, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-24 11:13:46', '2024-10-24 11:13:46'),
(317, 'SL24-111720', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4284, 4194, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-24 11:13:46', '2024-10-24 11:13:46'),
(318, 'SL24-111721', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4896, 4806, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-24 11:13:46', '2024-10-24 11:13:46'),
(319, 'SL24-111725', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4311, 4221, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-24 11:13:46', '2024-10-24 11:13:46'),
(320, 'SL24-111722', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4893, 4803, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-24 18:11:31', '2024-10-24 18:11:31'),
(321, 'SL24-111723', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4890, 4800, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-24 18:11:31', '2024-10-24 18:11:31'),
(322, 'SL24-111724', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4899, 4809, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-24 18:11:31', '2024-10-24 18:11:31'),
(323, 'SL24-111726', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4296, 4206, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-24 18:11:31', '2024-10-24 18:11:31'),
(324, 'SL24-111727', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4299, 4209, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-24 18:11:31', '2024-10-24 18:11:31'),
(325, 'SL24-111728', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4308, 4218, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-24 18:11:31', '2024-10-24 18:11:31'),
(326, 'SL24-111729', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4026, 3936, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-24 18:11:31', '2024-10-24 18:11:31'),
(327, 'SL24-111730', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4818, 4728, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-24 18:11:31', '2024-10-24 18:11:31'),
(328, 'SL24-111731', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4824, 4734, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-24 18:11:31', '2024-10-24 18:11:31'),
(329, 'SL24-111732', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4809, 4719, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-24 18:11:31', '2024-10-24 18:11:31'),
(330, 'SL24-111715', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4503, 4413, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-25 11:23:35', '2024-10-25 11:23:35'),
(331, 'SL24-111688', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4478, 4388, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-25 11:23:36', '2024-10-25 11:23:36'),
(332, 'SL24-111734', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4011, 3921, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-25 11:23:36', '2024-10-25 11:23:36'),
(333, 'SL24-111735', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4656, 4566, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-25 11:23:36', '2024-10-25 11:23:36'),
(334, 'SL24-111736', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4656, 4566, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-25 11:23:36', '2024-10-25 11:23:36'),
(335, 'SL24-111737', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4674, 4584, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-25 11:23:36', '2024-10-25 11:23:36'),
(336, 'SL24-111739', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4077, 3987, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-25 11:23:36', '2024-10-25 11:23:36'),
(337, 'SL24-111740', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4059, 3969, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-25 11:23:36', '2024-10-25 11:23:36'),
(338, 'SL24-111741', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4212, 4122, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-25 11:23:36', '2024-10-25 11:23:36'),
(339, 'SL24-111742', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4326, 4236, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-25 11:23:36', '2024-10-25 11:23:36'),
(340, 'SL24-111743', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4335, 4245, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-25 11:23:36', '2024-10-25 11:23:36'),
(341, 'SL24-111744', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4329, 4239, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-25 11:23:36', '2024-10-25 11:23:36'),
(342, 'SL24-111745', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4395, 4305, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-25 11:23:36', '2024-10-25 11:23:36'),
(343, 'SL24-111746', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4284, 4194, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-25 11:23:36', '2024-10-25 11:23:36'),
(344, 'SL24-111747', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4290, 4200, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-25 11:23:36', '2024-10-25 11:23:36'),
(345, 'SL24-111748', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4284, 4194, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-25 11:23:36', '2024-10-25 11:23:36'),
(346, 'SL24-111749', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4413, 4323, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-25 11:23:36', '2024-10-25 11:23:36'),
(347, 'SL24-111750', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4725, 4635, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-25 11:23:36', '2024-10-25 11:23:36'),
(348, 'SL24-111751', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4728, 4638, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-25 11:23:36', '2024-10-25 11:23:36'),
(349, 'SL24-111752', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4725, 4635, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-25 11:23:36', '2024-10-25 11:23:36'),
(350, 'SL24-111753', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4623, 4533, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-25 11:23:36', '2024-10-25 11:23:36'),
(351, 'SL24-111754', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4893, 4803, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-25 11:23:36', '2024-10-25 11:23:36'),
(352, 'SL24-111755', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4893, 4803, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-25 11:23:36', '2024-10-25 11:23:36'),
(353, 'SL24-111756', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4893, 4803, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-25 11:23:36', '2024-10-25 11:23:36'),
(354, 'SL24-111760', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4704, 4614, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-25 14:15:12', '2024-10-25 14:15:12'),
(355, 'SL24-111761', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4497, 4407, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-25 14:15:12', '2024-10-25 14:15:12'),
(356, 'SL24-111762', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4269, 4179, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-25 14:15:12', '2024-10-25 14:15:12'),
(357, 'SL24-111763', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4281, 4191, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-25 14:15:12', '2024-10-25 14:15:12'),
(358, 'SL24-111765', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4266, 4176, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-25 15:34:54', '2024-10-25 15:34:54'),
(359, 'SL24-111766', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4062, 3972, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-25 15:34:54', '2024-10-25 15:34:54'),
(360, 'SL24-111767', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4359, 4269, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-27 11:25:23', '2024-10-27 11:25:23'),
(361, 'SL24-111768', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4395, 4305, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-27 11:25:23', '2024-10-27 11:25:23'),
(362, 'SL24-111769', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4413, 4323, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-27 11:25:23', '2024-10-27 11:25:23'),
(363, 'SL24-111770', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4425, 4335, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-27 11:25:23', '2024-10-27 11:25:23'),
(364, 'SL24-111771', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 3897, 3807, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-27 11:25:23', '2024-10-27 11:25:23'),
(365, 'SL24-111759', 'NEXIUM® COIL, AS - 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4692, 4602, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24088', '2024-10-27 11:51:30', '2024-10-27 11:51:30'),
(366, 'CL24-110763', 'NEXALUME ® COIL AS / NZ - 1397', '0.40mm x 938mm AZ200 G550 NEXALUME® Acrylic Coated AFP', 3033, 2943, 'KGS', 'TAURANGA, NZ ', 'PO 34878 / RIVERLEA', 'SOX24-24100-1', '2024-11-05 11:41:33', '2024-11-05 11:41:33'),
(367, 'CL24-110764', 'NEXALUME ® COIL AS / NZ - 1397', '0.40mm x 938mm AZ200 G550 NEXALUME® Acrylic Coated AFP', 3045, 2955, 'KGS', 'TAURANGA, NZ ', 'PO 34878 / RIVERLEA', 'SOX24-24100-1', '2024-11-05 11:41:33', '2024-11-05 11:41:33'),
(368, 'CL24-110765', 'NEXALUME ® COIL AS / NZ - 1397', '0.40mm x 938mm AZ200 G550 NEXALUME® Acrylic Coated AFP', 3073, 2983, 'KGS', 'TAURANGA, NZ ', 'PO 34878 / RIVERLEA', 'SOX24-24100-1', '2024-11-05 11:41:33', '2024-11-05 11:41:33'),
(369, 'CL24-110768', 'NEXALUME ® COIL AS / NZ - 1397', '0.40mm x 938mm AZ200 G550 NEXALUME® Acrylic Coated AFP', 2853, 2763, 'KGS', 'TAURANGA, NZ ', 'PO 34878 / RIVERLEA', 'SOX24-24100-1', '2024-11-05 11:41:33', '2024-11-05 11:41:33'),
(370, 'CL24-110769', 'NEXALUME ® COIL AS / NZ - 1397', '0.40mm x 938mm AZ200 G550 NEXALUME® Acrylic Coated AFP', 3436, 3346, 'KGS', 'TAURANGA, NZ ', 'PO 34878 / RIVERLEA', 'SOX24-24100-1', '2024-11-05 11:41:33', '2024-11-05 11:41:33'),
(371, 'CL24-110770', 'NEXALUME ® COIL AS / NZ - 1397', '0.40mm x 938mm AZ200 G550 NEXALUME® Acrylic Coated AFP', 3532, 3442, 'KGS', 'TAURANGA, NZ ', 'PO 34878 / RIVERLEA', 'SOX24-24100-1', '2024-11-05 11:41:33', '2024-11-05 11:41:33'),
(372, 'CL24-110772', 'NEXALUME ® COIL AS / NZ - 1397', '0.40mm x 938mm AZ200 G550 NEXALUME® Acrylic Coated AFP', 3392, 3302, 'KGS', 'TAURANGA, NZ ', 'PO 34878 / RIVERLEA', 'SOX24-24100-1', '2024-11-05 11:41:33', '2024-11-05 11:41:33'),
(373, 'CL24-110773', 'NEXALUME ® COIL AS / NZ - 1397', '0.40mm x 938mm AZ200 G550 NEXALUME® Acrylic Coated AFP', 3389, 3299, 'KGS', 'TAURANGA, NZ ', 'PO 34878 / RIVERLEA', 'SOX24-24100-1', '2024-11-05 11:41:33', '2024-11-05 11:41:33'),
(374, 'CL24-110774', 'NEXALUME ® COIL AS / NZ - 1397', '0.40mm x 938mm AZ200 G550 NEXALUME® Acrylic Coated AFP', 3387, 3297, 'KGS', 'TAURANGA, NZ ', 'PO 34878 / RIVERLEA', 'SOX24-24100-1', '2024-11-05 11:41:33', '2024-11-05 11:41:33'),
(375, 'CL24-110775', 'NEXALUME ® COIL AS / NZ - 1397', '0.40mm x 938mm AZ200 G550 NEXALUME® Acrylic Coated AFP', 3390, 3300, 'KGS', 'TAURANGA, NZ ', 'PO 34878 / RIVERLEA', 'SOX24-24100-1', '2024-11-05 11:41:33', '2024-11-05 11:41:33'),
(376, 'CL24-110776', 'NEXALUME ® COIL AS / NZ - 1397', '0.40mm x 938mm AZ200 G550 NEXALUME® Acrylic Coated AFP', 2685, 2595, 'KGS', 'TAURANGA, NZ ', 'PO 34878 / RIVERLEA', 'SOX24-24100-1', '2024-11-05 11:41:33', '2024-11-05 11:41:33'),
(377, 'CL24-110752', 'NEXALUME ® COIL AS / NZ - 1397', '0.55mm x 938mm AZ200 G550 NEXALUME® Acrylic Coated AFP', 3229, 3139, 'KGS', 'TAURANGA, NZ ', 'PO 34878 / RIVERLEA', 'SOX24-24100-2', '2024-11-05 11:41:50', '2024-11-05 11:41:50'),
(378, 'CL24-110753', 'NEXALUME ® COIL AS / NZ - 1397', '0.55mm x 938mm AZ200 G550 NEXALUME® Acrylic Coated AFP', 3235, 3145, 'KGS', 'TAURANGA, NZ ', 'PO 34878 / RIVERLEA', 'SOX24-24100-2', '2024-11-05 11:41:50', '2024-11-05 11:41:50'),
(379, 'CL24-110754', 'NEXALUME ® COIL AS / NZ - 1397', '0.55mm x 938mm AZ200 G550 NEXALUME® Acrylic Coated AFP', 3235, 3145, 'KGS', 'TAURANGA, NZ ', 'PO 34878 / RIVERLEA', 'SOX24-24100-2', '2024-11-05 11:41:50', '2024-11-05 11:41:50'),
(380, 'CL24-110755', 'NEXALUME ® COIL AS / NZ - 1397', '0.55mm x 938mm AZ200 G550 NEXALUME® Acrylic Coated AFP', 3239, 3149, 'KGS', 'TAURANGA, NZ ', 'PO 34878 / RIVERLEA', 'SOX24-24100-2', '2024-11-05 11:41:50', '2024-11-05 11:41:50'),
(381, 'CL24-110756', 'NEXALUME ® COIL AS / NZ - 1397', '0.55mm x 938mm AZ200 G550 NEXALUME® Acrylic Coated AFP', 3241, 3151, 'KGS', 'TAURANGA, NZ ', 'PO 34878 / RIVERLEA', 'SOX24-24100-2', '2024-11-05 11:41:50', '2024-11-05 11:41:50'),
(382, 'CL24-110757', 'NEXALUME ® COIL AS / NZ - 1397', '0.55mm x 938mm AZ200 G550 NEXALUME® Acrylic Coated AFP', 3099, 3009, 'KGS', 'TAURANGA, NZ ', 'PO 34878 / RIVERLEA', 'SOX24-24100-2', '2024-11-05 11:41:50', '2024-11-05 11:41:50'),
(383, 'CL24-110758', 'NEXALUME ® COIL AS / NZ - 1397', '0.55mm x 938mm AZ200 G550 NEXALUME® Acrylic Coated AFP', 3411, 3321, 'KGS', 'TAURANGA, NZ ', 'PO 34878 / RIVERLEA', 'SOX24-24100-2', '2024-11-05 11:41:50', '2024-11-05 11:41:50'),
(384, 'CL24-110759', 'NEXALUME ® COIL AS / NZ - 1397', '0.55mm x 938mm AZ200 G550 NEXALUME® Acrylic Coated AFP', 3412, 3322, 'KGS', 'TAURANGA, NZ ', 'PO 34878 / RIVERLEA', 'SOX24-24100-2', '2024-11-05 11:41:50', '2024-11-05 11:41:50'),
(385, 'CL24-110741', 'NEXALUME ® COIL AS / NZ - 1397', '0.55mm x 1219mm AZ200 G300 NEXALUME® Acrylic Coated AFP', 3278, 3188, 'KGS', 'TAURANGA, NZ ', 'PO 34878 / RIVERLEA', 'SOX24-24100-3', '2024-11-05 11:42:02', '2024-11-05 11:42:02'),
(386, 'CL24-110742', 'NEXALUME ® COIL AS / NZ - 1397', '0.55mm x 1219mm AZ200 G300 NEXALUME® Acrylic Coated AFP', 3254, 3164, 'KGS', 'TAURANGA, NZ ', 'PO 34878 / RIVERLEA', 'SOX24-24100-3', '2024-11-05 11:42:02', '2024-11-05 11:42:02'),
(387, 'CL24-110743', 'NEXALUME ® COIL AS / NZ - 1397', '0.55mm x 1219mm AZ200 G300 NEXALUME® Acrylic Coated AFP', 3202, 3112, 'KGS', 'TAURANGA, NZ ', 'PO 34878 / RIVERLEA', 'SOX24-24100-3', '2024-11-05 11:42:02', '2024-11-05 11:42:02'),
(388, 'CL24-110744', 'NEXALUME ® COIL AS / NZ - 1397', '0.55mm x 1219mm AZ200 G300 NEXALUME® Acrylic Coated AFP', 3212, 3122, 'KGS', 'TAURANGA, NZ ', 'PO 34878 / RIVERLEA', 'SOX24-24100-3', '2024-11-05 11:42:03', '2024-11-05 11:42:03'),
(389, 'CL24-110745', 'NEXALUME ® COIL AS / NZ - 1397', '0.55mm x 1219mm AZ200 G300 NEXALUME® Acrylic Coated AFP', 3207, 3117, 'KGS', 'TAURANGA, NZ ', 'PO 34878 / RIVERLEA', 'SOX24-24100-3', '2024-11-05 11:42:03', '2024-11-05 11:42:03'),
(390, 'CL24-110746', 'NEXALUME ® COIL AS / NZ - 1397', '0.55mm x 1219mm AZ200 G300 NEXALUME® Acrylic Coated AFP', 3210, 3120, 'KGS', 'TAURANGA, NZ ', 'PO 34878 / RIVERLEA', 'SOX24-24100-3', '2024-11-05 11:42:03', '2024-11-05 11:42:03'),
(391, 'CL24-110747', 'NEXALUME ® COIL AS / NZ - 1397', '0.55mm x 1219mm AZ200 G300 NEXALUME® Acrylic Coated AFP', 2963, 2873, 'KGS', 'TAURANGA, NZ ', 'PO 34878 / RIVERLEA', 'SOX24-24100-3', '2024-11-05 11:42:03', '2024-11-05 11:42:03'),
(392, 'CL24-110748', 'NEXALUME ® COIL AS / NZ - 1397', '0.55mm x 1219mm AZ200 G300 NEXALUME® Acrylic Coated AFP', 3650, 3560, 'KGS', 'TAURANGA, NZ ', 'PO 34878 / RIVERLEA', 'SOX24-24100-3', '2024-11-05 11:42:03', '2024-11-05 11:42:03'),
(393, 'SL24-111940-1', 'NEXALUME® COIL ', '1.20mm x 214mm AZ150 G550 NEXALUME® Acrylic Coated AFP', 3562, 3472, 'KGS', 'MELBOURNE, AUSTRALIA', 'DURABUILT PRODUCTS PTY LTD', 'SOX24-24103-2', '2024-11-05 11:54:52', '2024-11-05 11:54:52'),
(394, 'SL24-111940-2', 'NEXALUME® COIL ', '1.20mm x 214mm AZ150 G550 NEXALUME® Acrylic Coated AFP', 3562, 3472, 'KGS', 'MELBOURNE, AUSTRALIA', 'DURABUILT PRODUCTS PTY LTD', 'SOX24-24103-2', '2024-11-05 11:54:52', '2024-11-05 11:54:52'),
(395, 'CL24-110760', 'NEXALUME ® COIL AS / NZ - 1397', '0.55mm x 938mm AZ200 G550 NEXALUME® Acrylic Coated AFP', 3411, 3321, 'KGS', 'TAURANGA, NZ ', 'PO35010 / RIVERLEA', 'SOX24-24105', '2024-11-05 12:45:22', '2024-11-05 12:45:22'),
(396, 'CL24-110761', 'NEXALUME ® COIL AS / NZ - 1397', '0.55mm x 938mm AZ200 G550 NEXALUME® Acrylic Coated AFP', 3392, 3302, 'KGS', 'TAURANGA, NZ ', 'PO35010 / RIVERLEA', 'SOX24-24105', '2024-11-05 12:45:22', '2024-11-05 12:45:22'),
(397, 'CL24-110762', 'NEXALUME ® COIL AS / NZ - 1397', '0.55mm x 938mm AZ200 G550 NEXALUME® Acrylic Coated AFP', 3328, 3238, 'KGS', 'TAURANGA, NZ ', 'PO35010 / RIVERLEA', 'SOX24-24105', '2024-11-05 12:45:22', '2024-11-05 12:45:22'),
(398, 'CL24-110778', 'NEXALUME® COIL ', '0.30mm x 855mm AZ150 G550 NEXALUME® Acrylic Coated AFP', 4444, 4354, 'KGS', 'BRISBANE, AUSTRALIA', 'MAUPITI PTY LTD', 'SOX24-24099', '2024-11-05 18:45:45', '2024-11-05 18:45:45'),
(399, 'CL24-110779', 'NEXALUME® COIL ', '0.30mm x 855mm AZ150 G550 NEXALUME® Acrylic Coated AFP', 4438, 4348, 'KGS', 'BRISBANE, AUSTRALIA', 'MAUPITI PTY LTD', 'SOX24-24099', '2024-11-05 18:45:45', '2024-11-05 18:45:45'),
(400, 'CL24-110780', 'NEXALUME® COIL ', '0.30mm x 855mm AZ150 G550 NEXALUME® Acrylic Coated AFP', 4432, 4342, 'KGS', 'BRISBANE, AUSTRALIA', 'MAUPITI PTY LTD', 'SOX24-24099', '2024-11-05 18:45:45', '2024-11-05 18:45:45'),
(401, 'CL24-110782', 'NEXALUME® COIL ', '0.30mm x 855mm AZ150 G550 NEXALUME® Acrylic Coated AFP', 4319, 4229, 'KGS', 'BRISBANE, AUSTRALIA', 'MAUPITI PTY LTD', 'SOX24-24099', '2024-11-05 18:45:45', '2024-11-05 18:45:45'),
(402, 'CL24-110783', 'NEXALUME® COIL ', '0.30mm x 855mm AZ150 G550 NEXALUME® Acrylic Coated AFP', 4307, 4217, 'KGS', 'BRISBANE, AUSTRALIA', 'MAUPITI PTY LTD', 'SOX24-24099', '2024-11-05 18:45:45', '2024-11-05 18:45:45'),
(403, 'CL24-110784', 'NEXALUME® COIL ', '0.30mm x 855mm AZ150 G550 NEXALUME® Acrylic Coated AFP', 4421, 4331, 'KGS', 'BRISBANE, AUSTRALIA', 'MAUPITI PTY LTD', 'SOX24-24099', '2024-11-05 18:45:45', '2024-11-05 18:45:45'),
(404, 'CL24-110785', 'NEXALUME® COIL ', '0.30mm x 855mm AZ150 G550 NEXALUME® Acrylic Coated AFP', 4123, 4033, 'KGS', 'BRISBANE, AUSTRALIA', 'MAUPITI PTY LTD', 'SOX24-24099', '2024-11-05 18:45:45', '2024-11-05 18:45:45'),
(405, 'CL24-110786', 'NEXALUME® COIL ', '0.30mm x 855mm AZ150 G550 NEXALUME® Acrylic Coated AFP', 3848, 3758, 'KGS', 'BRISBANE, AUSTRALIA', 'MAUPITI PTY LTD', 'SOX24-24099', '2024-11-05 18:45:45', '2024-11-05 18:45:45'),
(406, 'CL24-110787', 'NEXALUME® COIL ', '0.30mm x 855mm AZ150 G550 NEXALUME® Acrylic Coated AFP', 4682, 4592, 'KGS', 'BRISBANE, AUSTRALIA', 'MAUPITI PTY LTD', 'SOX24-24099', '2024-11-05 18:45:45', '2024-11-05 18:45:45'),
(407, 'CL24-110788', 'NEXALUME® COIL ', '0.30mm x 855mm AZ150 G550 NEXALUME® Acrylic Coated AFP', 4698, 4608, 'KGS', 'BRISBANE, AUSTRALIA', 'MAUPITI PTY LTD', 'SOX24-24099', '2024-11-05 18:45:45', '2024-11-05 18:45:45'),
(408, 'CL24-110789', 'NEXALUME® COIL ', '0.30mm x 855mm AZ150 G550 NEXALUME® Acrylic Coated AFP', 4442, 4352, 'KGS', 'BRISBANE, AUSTRALIA', 'MAUPITI PTY LTD', 'SOX24-24099', '2024-11-05 18:45:45', '2024-11-05 18:45:45'),
(409, 'SL24-107106-2 D-E-F', 'NEXALUME® COIL, AS - 1397', '0.75mm x 182mm AZ150 G550 NEXALUME® TINTED PURPLE UNGU ULUWATU DS', 2805, 2715, 'KGS', 'SYDNEY, AUSTRALIA', 'CON FORM GROUP PTY LTD', 'SOX24-24101', '2024-11-06 11:17:50', '2024-11-06 11:17:50'),
(410, 'SL24-112023-1 A-B-C', 'NEXALUME® COIL, AS - 1397', '0.75mm x 182mm AZ150 G550 NEXALUME® TINTED PURPLE UNGU ULUWATU DS', 4161, 4071, 'KGS', 'SYDNEY, AUSTRALIA', 'CON FORM GROUP PTY LTD', 'SOX24-24101', '2024-11-06 11:17:50', '2024-11-06 11:17:50'),
(411, 'SL24-112023-2 D-E-F', 'NEXALUME® COIL, AS - 1397', '0.75mm x 182mm AZ150 G550 NEXALUME® TINTED PURPLE UNGU ULUWATU DS', 4161, 4071, 'KGS', 'SYDNEY, AUSTRALIA', 'CON FORM GROUP PTY LTD', 'SOX24-24101', '2024-11-06 11:17:50', '2024-11-06 11:17:50'),
(412, 'SL24-112027-1 A-B-C', 'NEXALUME® COIL, AS - 1397', '0.75mm x 182mm AZ150 G550 NEXALUME® TINTED PURPLE UNGU ULUWATU DS', 3984, 3894, 'KGS', 'SYDNEY, AUSTRALIA', 'CON FORM GROUP PTY LTD', 'SOX24-24101', '2024-11-06 11:17:50', '2024-11-06 11:17:50'),
(413, 'SL24-112027-2 D-E-F', 'NEXALUME® COIL, AS - 1397', '0.75mm x 182mm AZ150 G550 NEXALUME® TINTED PURPLE UNGU ULUWATU DS', 3989, 3899, 'KGS', 'SYDNEY, AUSTRALIA', 'CON FORM GROUP PTY LTD', 'SOX24-24101', '2024-11-06 11:17:50', '2024-11-06 11:17:50'),
(414, 'SL24-112025-1 A-B-C', 'NEXALUME® COIL, AS - 1397', '0.75mm x 182mm AZ150 G550 NEXALUME® TINTED PURPLE UNGU ULUWATU DS', 3936, 3846, 'KGS', 'SYDNEY, AUSTRALIA', 'CON FORM GROUP PTY LTD', 'SOX24-24101', '2024-11-06 11:17:50', '2024-11-06 11:17:50'),
(415, 'SL24-112025-2 D-E-F', 'NEXALUME® COIL, AS - 1397', '0.75mm x 182mm AZ150 G550 NEXALUME® TINTED PURPLE UNGU ULUWATU DS', 3936, 3846, 'KGS', 'SYDNEY, AUSTRALIA', 'CON FORM GROUP PTY LTD', 'SOX24-24101', '2024-11-06 11:17:50', '2024-11-06 11:17:50'),
(416, 'CL24-110781', 'NEXALUME® COIL', '0.30mm x 855mm AZ150 G550 NEXALUME® Acrylic Coated AFP', 3717, 3627, 'KGS', 'BRISBANE, AUSTRALIA', 'MAUPITI PTY LTD', 'SOX24-24099', '2024-11-06 12:01:11', '2024-11-06 12:01:11'),
(417, 'CL24-110766', 'NEXALUME ® COIL AS / NZ - 1397', '0.40mm x 938mm AZ200 G550 NEXALUME® Acrylic Coated AFP', 3075, 2985, 'KGS', 'TAURANGA, NZ', 'PO 34878 / RIVERLEA', 'SOX24-24100-1', '2024-11-06 12:06:23', '2024-11-06 12:06:23'),
(418, 'CL24-110767', 'NEXALUME ® COIL AS / NZ - 1397', '0.40mm x 938mm AZ200 G550 NEXALUME® Acrylic Coated AFP', 3074, 2984, 'KGS', 'TAURANGA, NZ', 'PO 34878 / RIVERLEA', 'SOX24-24100-1', '2024-11-06 12:06:23', '2024-11-06 12:06:23'),
(419, 'SL24-106319-1 A-B-C-D', 'NEXALUME® COIL, AS - 1397, AFP', '0.95mm x 173mm AZ150 G550 NEXALUME® TINTED GREEN - HIJAU BUARAN', 4358, 4268, 'KGS', 'PORT BRISBANE, AU', 'PO - 2132', 'SOX24-24107', '2024-11-06 13:15:06', '2024-11-06 13:15:06'),
(420, 'SL24-106319-2 E-F-G', 'NEXALUME® COIL, AS - 1397, AFP', '0.95mm x 173mm AZ150 G550 NEXALUME® TINTED GREEN - HIJAU BUARAN', 3291, 3201, 'KGS', 'PORT BRISBANE, AU', 'PO - 2132', 'SOX24-24107', '2024-11-06 13:15:06', '2024-11-06 13:15:06'),
(421, 'SL24-106320-1 A-B-C-D', 'NEXALUME® COIL, AS - 1397, AFP', '0.95mm x 173mm AZ150 G550 NEXALUME® TINTED GREEN - HIJAU BUARAN', 4390, 4300, 'KGS', 'PORT BRISBANE, AU', 'PO - 2132', 'SOX24-24107', '2024-11-06 13:15:06', '2024-11-06 13:15:06'),
(422, 'SL24-106320-2 E-F-G', 'NEXALUME® COIL, AS - 1397, AFP', '0.95mm x 173mm AZ150 G550 NEXALUME® TINTED GREEN - HIJAU BUARAN', 3315, 3225, 'KGS', 'PORT BRISBANE, AU', 'PO - 2132', 'SOX24-24107', '2024-11-06 13:15:06', '2024-11-06 13:15:06'),
(423, 'SL24-106321-1 A-B-C-D', 'NEXALUME® COIL, AS - 1397, AFP', '0.95mm x 173mm AZ150 G550 NEXALUME® TINTED GREEN - HIJAU BUARAN', 4290, 4200, 'KGS', 'PORT BRISBANE, AU', 'PO - 2132', 'SOX24-24107', '2024-11-06 13:15:06', '2024-11-06 13:15:06'),
(424, 'SL24-106321-2 E-F-G', 'NEXALUME® COIL, AS - 1397, AFP', '0.95mm x 173mm AZ150 G550 NEXALUME® TINTED GREEN - HIJAU BUARAN', 3240, 3150, 'KGS', 'PORT BRISBANE, AU', 'PO - 2132', 'SOX24-24107', '2024-11-06 13:15:06', '2024-11-06 13:15:06'),
(425, 'SL24-112154 A-B-C', 'NEXCOLOR® COIL AS / NZS - 2728', '0.75mm x 225mm Z275 G300 NEXCOLOR® GRANDE Napier Black /\nHamilton Grey DS', 4155, 4065, 'KGS', 'NAPIER, NZ', 'PO14813 / STORETECH', 'SOX24-24087-1', '2024-11-11 16:27:39', '2024-11-11 16:27:39'),
(426, 'SL24-112156 A-B-C', 'NEXCOLOR® COIL AS / NZS - 2728', '0.75mm x 225mm Z275 G300 NEXCOLOR® GRANDE Napier Black /\nHamilton Grey DS', 3834, 3744, 'KGS', 'NAPIER, NZ', 'PO14813 / STORETECH', 'SOX24-24087-1', '2024-11-11 16:27:39', '2024-11-11 16:27:39'),
(427, 'SL24-112155 A-B', 'NEXCOLOR® COIL AS / NZS - 2728', '0.75mm x 200mm Z275 G300 NEXCOLOR® GRANDE Napier Black / Hamilton Grey DS', 2498, 2408, 'KG', 'NAPIER, NZ', 'PO14813 / STORETECH', 'SOX24-24087-2', '2024-11-11 16:40:07', '2024-11-11 16:40:07'),
(428, 'SL24-112157 A-B', 'NEXCOLOR® COIL AS / NZS - 2728', '0.75mm x 200mm Z275 G300 NEXCOLOR® GRANDE Napier Black / Hamilton Grey DS', 2310, 2220, 'KG', 'NAPIER, NZ', 'PO14813 / STORETECH', 'SOX24-24087-2', '2024-11-11 16:40:07', '2024-11-11 16:40:07'),
(433, 'SL24-112101 A-B-C', 'NEXCOLOR® COIL AS / NZS - 2728', '0.75mm x 225mm Z275 G300 NEXCOLOR® GRANDE Wellington Brown / Belgrave Grey DS', 3630, 3540, 'KGS', 'NAPIER, NZ', 'PO14972 / STORETECH', 'SOX24-24102-2', '2024-11-11 17:16:54', '2024-11-11 17:16:54'),
(435, 'SL24-112100 A-B', 'NEXCOLOR® COIL AS / NZS - 2728', '0.75mm x 200mm Z275 G300 NEXCOLOR® GRANDE Wellington Brown / Belgrave Grey DS', 2188, 2098, 'KGS', 'NAPIER, NZ', 'PO14972 / STORETECH', 'SOX24-24102-1', '2024-11-11 17:59:02', '2024-11-11 17:59:02'),
(436, 'SL24-112158 A-B-C', 'NEXCOLOR® COIL AS / NZS - 2728', '0.75mm x 225mm Z275 G300 NEXCOLOR® GRANDE Napier Black /Hamilton Grey DS', 4116, 4026, 'KGS', 'NAPIER, NZ', 'PO14813 / STORETECH', 'SOX24-24087-1', '2024-11-11 18:23:55', '2024-11-11 18:23:55'),
(437, 'SL24-112160 A-B-C', 'NEXCOLOR® COIL AS / NZS - 2728', '0.75mm x 225mm Z275 G300 NEXCOLOR® GRANDE Napier Black /Hamilton Grey DS', 3891, 3801, 'KGS', 'NAPIER, NZ', 'PO14813 / STORETECH', 'SOX24-24087-1', '2024-11-11 18:23:55', '2024-11-11 18:23:55'),
(438, 'SL24-112159 A-B', 'NEXCOLOR® COIL AS / NZS - 2728', '0.75mm x 200mm Z275 G300 NEXCOLOR® GRANDE Napier Black /Hamilton Grey DS', 2476, 2386, 'KGS', 'NAPIER, NZ', 'PO14813 / STORETECH', 'SOX24-24087-2', '2024-11-11 18:31:40', '2024-11-11 18:31:40'),
(439, 'SL24-112161 A-B', 'NEXCOLOR® COIL AS / NZS - 2728', '0.75mm x 200mm Z275 G300 NEXCOLOR® GRANDE Napier Black /Hamilton Grey DS', 2344, 2254, 'KGS', 'NAPIER, NZ', 'PO14813 / STORETECH', 'SOX24-24087-2', '2024-11-11 18:31:40', '2024-11-11 18:31:40'),
(440, 'CL24-111295', 'NEXALUME ® COIL AS / NZ - 1397', '0.55mm x 938mm AZ200 G550 NEXALUME® Acrylic Coated AFP', 3331, 3241, 'KGS', 'TAURANGA, NZ ', 'PO35010 / RIVERLEA', 'SOX24-24105', '2024-11-19 01:06:46', '2024-11-19 01:06:46'),
(441, 'CL24-111296', 'NEXALUME ® COIL AS / NZ - 1397', '0.55mm x 938mm AZ200 G550 NEXALUME® Acrylic Coated AFP', 3306, 3216, 'KGS', 'TAURANGA, NZ ', 'PO35010 / RIVERLEA', 'SOX24-24105', '2024-11-19 01:06:46', '2024-11-19 01:06:46'),
(442, 'CL24-111297', 'NEXALUME ® COIL AS / NZ - 1397', '0.55mm x 938mm AZ200 G550 NEXALUME® Acrylic Coated AFP', 3046, 2956, 'KGS', 'TAURANGA, NZ ', 'PO35010 / RIVERLEA', 'SOX24-24105', '2024-11-19 01:06:46', '2024-11-19 01:06:46'),
(443, 'SL24-111738 A-B-C', 'NEXIUM® COIL, AS 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4074, 3984, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24104', '2024-11-19 04:20:41', '2024-11-19 04:20:41'),
(444, 'SL24-111757 A-B-C', 'NEXIUM® COIL, AS 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 5205, 5115, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24104', '2024-11-19 04:20:41', '2024-11-19 04:20:41'),
(445, 'SL24-111764 A-B-C', 'NEXIUM® COIL, AS 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4215, 4125, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24104', '2024-11-19 04:20:41', '2024-11-19 04:20:41'),
(446, 'SL24-111733 - 2 C', 'NEXIUM® COIL, AS 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 1651, 1561, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24104', '2024-11-20 01:42:37', '2024-11-20 01:42:37'),
(447, 'SL24-111758 - 2 C', 'NEXIUM® COIL, AS 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 1536, 1536, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24104', '2024-11-20 01:42:37', '2024-11-20 01:42:37'),
(448, 'SL24-111733 - 1 A-B', 'NEXIUM® COIL, AS 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 2781, 2691, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24104', '2024-11-20 01:42:37', '2024-11-20 01:42:37'),
(449, 'SL24-111758 - 1 A-B', 'NEXIUM® COIL, AS 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 3162, 3072, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24104', '2024-11-20 01:42:37', '2024-11-20 01:42:37'),
(450, 'SL24-112274 A-B-C', 'NEXIUM® COIL, AS 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4335, 4245, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24104', '2024-11-20 01:42:37', '2024-11-20 01:42:37'),
(451, 'SL24-112275 A-B-C', 'NEXIUM® COIL, AS 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 3942, 3852, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24104', '2024-11-20 01:42:37', '2024-11-20 01:42:37'),
(452, 'SL24-112276 A-B-C', 'NEXIUM® COIL, AS 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4725, 4635, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24104', '2024-11-20 01:42:37', '2024-11-20 01:42:37'),
(453, 'SL24-112277 A-B-C', 'NEXIUM® COIL, AS 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4815, 4725, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24104', '2024-11-20 01:42:37', '2024-11-20 01:42:37'),
(454, 'SL24-112278 A-B-C', 'NEXIUM® COIL, AS 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4803, 4713, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24104', '2024-11-20 01:42:37', '2024-11-20 01:42:37'),
(455, 'SL24-112279 A-B-C', 'NEXIUM® COIL, AS 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4809, 4719, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24104', '2024-11-20 08:04:41', '2024-11-20 08:04:41'),
(456, 'SL24-112280 A-B-C', 'NEXIUM® COIL, AS 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4485, 4395, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24104', '2024-11-20 08:04:41', '2024-11-20 08:04:41'),
(457, 'SL24-112281 A-B-C', 'NEXIUM® COIL, AS 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4887, 4797, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24104', '2024-11-20 08:04:41', '2024-11-20 08:04:41'),
(458, 'SL24-112282 A-B-C', 'NEXIUM® COIL, AS 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4884, 4794, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24104', '2024-11-20 08:04:41', '2024-11-20 08:04:41'),
(459, 'SL24-112283 A-B-C', 'NEXIUM® COIL, AS 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4473, 4383, 'KG', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24104', '2024-11-20 08:04:41', '2024-11-21 03:17:12'),
(460, 'SL24-112284 A-B-C', 'NEXIUM® COIL, AS 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4878, 4788, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24104', '2024-11-20 08:04:41', '2024-11-20 08:04:41'),
(461, 'SL24-112285 A-B-C', 'NEXIUM® COIL, AS 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4884, 4794, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24104', '2024-11-20 08:04:41', '2024-11-20 08:04:41'),
(462, 'SL24-112286 A-B-C', 'NEXIUM® COIL, AS 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4905, 4815, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24104', '2024-11-20 08:04:41', '2024-11-20 08:04:41'),
(463, 'SL24-112287 A-B-C', 'NEXIUM® COIL, AS 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4818, 4728, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24104', '2024-11-20 08:04:41', '2024-11-20 08:04:41'),
(464, 'SL24-112288 A-B-C', 'NEXIUM® COIL, AS 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4899, 4809, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24104', '2024-11-20 08:04:41', '2024-11-20 08:04:41'),
(465, 'CI24-111240', 'NEXIUM ® COIL AS / NZ - 1397', '1.45mm x 1035mm Z450 G500 NEXIUM® PASSIVATION', 4677, 4587, 'KG', 'TAURANGA, NZ', 'PO - 10454 / VALA GROUP LTD', 'SOX24-24084', '2024-11-21 02:31:04', '2024-11-21 03:24:22');
INSERT INTO `shippmentb` (`id`, `atribute`, `product`, `size`, `gros`, `net`, `satuan_berat`, `destination`, `manufactur`, `type`, `created_at`, `updated_at`) VALUES
(466, 'CI24-111241', 'NEXIUM ® COIL AS / NZ - 1397', '1.45mm x 1035mm Z450 G500 NEXIUM® PASSIVATION', 4624, 4534, 'KGS', 'TAURANGA, NZ', 'PO - 10454 / VALA GROUP LTD', 'SOX24-24084', '2024-11-21 02:31:04', '2024-11-21 02:31:04'),
(467, 'CI24-111242', 'NEXIUM ® COIL AS / NZ - 1397', '1.45mm x 1035mm Z450 G500 NEXIUM® PASSIVATION', 4655, 4565, 'KGS', 'TAURANGA, NZ', 'PO - 10454 / VALA GROUP LTD', 'SOX24-24084', '2024-11-21 02:31:04', '2024-11-21 02:31:04'),
(468, 'SL24-112098 A-B', 'NEXCOLOR® COIL AS / NZS - 2728', '0.75mm x 200mm Z275 G300 NEXCOLOR® GRANDE Wellington Brown / Belgrave Grey DS', 1676, 1586, 'KGS', 'NAPIER, NZ', 'PO14972 / STORETECH', 'SOX24-24102-1', '2024-11-21 04:21:30', '2024-11-21 04:21:30'),
(469, 'SL24-112099 A-B-C', 'NEXCOLOR® COIL AS / NZS - 2728', '0.75mm x 225mm Z275 G300 NEXCOLOR® GRANDE Wellington Brown / Belgrave Grey DS', 2709, 2619, 'KGS', 'NAPIER, NZ', 'PO14972 / STORETECH', 'SOX24-24102-2', '2024-11-21 04:35:47', '2024-11-21 04:35:47'),
(470, 'SL24-112290 A-B-C', 'NEXIUM® COIL, AS 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4782, 4692, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24104', '2024-11-22 01:11:26', '2024-11-22 01:11:26'),
(471, 'SL24-112291 A-B-C', 'NEXIUM® COIL, AS 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4992, 4902, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24104', '2024-11-22 01:11:26', '2024-11-22 01:11:26'),
(472, 'SL24-112292 A-B-C', 'NEXIUM® COIL, AS 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4998, 4908, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24104', '2024-11-22 01:11:26', '2024-11-22 01:11:26'),
(473, 'SL24-112305 A-B-C', 'NEXIUM® COIL, AS 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4071, 3981, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24104', '2024-11-22 01:11:26', '2024-11-22 01:11:26'),
(476, 'SL24-112432-1 A-B-C', 'NEXALUME® COIL ', '1.20mm x 214mm AZ150 G550 NEXALUME® Acrylic Coated AFP', 4191, 4101, 'KG', 'MELBOURNE, AUSTRALIA', 'DURABUILT PRODUCTS PTY LTD', 'SOX24-24103-2', '2024-11-28 01:34:23', '2024-11-28 01:34:23'),
(477, 'SL24-112432-2 D-E', 'NEXALUME® COIL ', '1.20mm x 214mm AZ150 G550 NEXALUME® Acrylic Coated AFP', 2824, 2734, 'KG', 'MELBOURNE, AUSTRALIA', 'DURABUILT PRODUCTS PTY LTD', 'SOX24-24103-2', '2024-11-28 01:34:23', '2024-11-28 01:34:23'),
(478, 'SL24-112427-1 A-B-C', 'NEXALUME® COIL ', '1.00mm x 214mm AZ150 G550 NEXALUME® Acrylic Coated AFP', 4293, 4203, 'KGS', 'MELBOURNE, AUSTRALIA', 'DURABUILT PRODUCTS PTY LTD', 'SOX24-24103-1', '2024-11-28 01:44:47', '2024-11-28 01:44:47'),
(479, 'SL24-112427-2 D-E', 'NEXALUME® COIL ', '1.00mm x 214mm AZ150 G550 NEXALUME® Acrylic Coated AFP', 2892, 2802, 'KGS', 'MELBOURNE, AUSTRALIA', 'DURABUILT PRODUCTS PTY LTD', 'SOX24-24103-1', '2024-11-28 01:44:47', '2024-11-28 01:44:47'),
(480, 'SL24-112429-1 A-B-C', 'NEXALUME® COIL ', '1.00mm x 214mm AZ150 G550 NEXALUME® Acrylic Coated AFP', 3345, 3255, 'KGS', 'MELBOURNE, AUSTRALIA', 'DURABUILT PRODUCTS PTY LTD', 'SOX24-24103-1', '2024-11-28 01:44:47', '2024-11-28 01:44:47'),
(481, 'SL24-112429-2 D-E', 'NEXALUME® COIL ', '1.00mm x 214mm AZ150 G550 NEXALUME® Acrylic Coated AFP', 2260, 2170, 'KGS', 'MELBOURNE, AUSTRALIA', 'DURABUILT PRODUCTS PTY LTD', 'SOX24-24103-1', '2024-11-28 01:44:47', '2024-11-28 01:44:47'),
(482, 'SL24-112430-1 A-B-C', 'NEXALUME® COIL ', '1.00mm x 214mm AZ150 G550 NEXALUME® Acrylic Coated AFP', 3489, 3399, 'KGS', 'MELBOURNE, AUSTRALIA', 'DURABUILT PRODUCTS PTY LTD', 'SOX24-24103-1', '2024-11-28 01:44:47', '2024-11-28 01:44:47'),
(483, 'SL24-112430-2 D-E', 'NEXALUME® COIL ', '1.00mm x 214mm AZ150 G550 NEXALUME® Acrylic Coated AFP', 2356, 2266, 'KGS', 'MELBOURNE, AUSTRALIA', 'DURABUILT PRODUCTS PTY LTD', 'SOX24-24103-1', '2024-11-28 01:44:47', '2024-11-28 01:44:47'),
(484, 'SL24-112431-1 B-C', 'NEXALUME® COIL ', '1.20mm x 214mm AZ150 G550 NEXALUME® Acrylic Coated AFP', 2808, 2718, 'KGS', 'MELBOURNE, AUSTRALIA', 'DURABUILT PRODUCTS PTY LTD', 'SOX24-24103-2', '2024-11-29 01:34:29', '2024-11-29 01:34:29'),
(485, 'SL24-112433-1 A-B-C', 'NEXALUME® COIL ', '1.20mm x 214mm AZ150 G550 NEXALUME® Acrylic Coated AFP', 2616, 2526, 'KGS', 'MELBOURNE, AUSTRALIA', 'DURABUILT PRODUCTS PTY LTD', 'SOX24-24103-2', '2024-11-29 01:34:29', '2024-11-29 01:34:29'),
(486, 'SL24-112428-1 B-C', 'NEXALUME® COIL ', '1.00mm x 214mm AZ150 G550 NEXALUME® Acrylic Coated AFP', 2342, 2252, 'KGS', 'MELBOURNE, AUSTRALIA', 'DURABUILT PRODUCTS PTY LTD', 'SOX24-24103-1', '2024-11-29 01:35:44', '2024-11-29 01:35:44'),
(487, 'SL24-112804A-B-C', 'NEXIUM® COIL, AS 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4812, 4722, 'KG', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24104', '2024-12-08 20:18:10', '2024-12-08 20:18:10'),
(488, 'SL24-112806A-B-C', 'NEXIUM® COIL, AS 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4818, 4728, 'KG', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24104', '2024-12-08 20:18:10', '2024-12-08 20:18:10'),
(489, 'SL24-112805A-B-C', 'NEXIUM® COIL, AS 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4794, 4704, 'KG', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24104', '2024-12-08 20:18:10', '2024-12-08 20:18:10'),
(490, 'SL24-112807A-B-C', 'NEXIUM® COIL, AS 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4818, 4728, 'KG', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24104', '2024-12-08 20:18:10', '2024-12-08 20:18:10'),
(491, 'SL24-112809A-B-C', 'NEXIUM® COIL, AS 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4938, 4848, 'KG', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24104', '2024-12-08 20:18:10', '2024-12-08 20:18:10'),
(492, 'SL24-112810A-B-C', 'NEXIUM® COIL, AS 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4938, 4848, 'KG', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24104', '2024-12-08 20:18:10', '2024-12-08 20:18:10'),
(493, 'SL24-112812A-B-C', 'NEXIUM® COIL, AS 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4944, 4854, 'KG', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24104', '2024-12-08 20:18:10', '2024-12-08 20:18:10'),
(494, 'SL24-112813A-B-C', 'NEXIUM® COIL, AS 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4614, 4524, 'KG', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24104', '2024-12-08 20:18:10', '2024-12-08 20:18:10'),
(495, 'SL24-112814A-B-C', 'NEXIUM® COIL, AS 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4827, 4737, 'KG', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24104', '2024-12-08 20:18:10', '2024-12-08 20:18:10'),
(496, 'SL24-112815A-B-C', 'NEXIUM® COIL, AS 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4833, 4743, 'KG', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24104', '2024-12-08 20:18:10', '2024-12-08 20:18:10'),
(509, 'SL24-112818 A-B-C', 'NEXIUM® COIL, AS 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4434, 4344, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24104', '2024-12-09 20:43:56', '2024-12-09 20:43:56'),
(510, 'SL24-112832 A-B-C', 'NEXIUM® COIL, AS 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4701, 4611, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24104', '2024-12-09 20:43:56', '2024-12-09 20:43:56'),
(511, 'SL24-112833 A-B-C', 'NEXIUM® COIL, AS 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4695, 4605, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24104', '2024-12-09 20:43:56', '2024-12-09 20:43:56'),
(512, 'SL24-112834 A-B-C', 'NEXIUM® COIL, AS 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4698, 4608, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24104', '2024-12-09 20:43:56', '2024-12-09 20:43:56'),
(513, 'SL24-112835 A-B-C', 'NEXIUM® COIL, AS 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4698, 4608, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24104', '2024-12-09 20:43:56', '2024-12-09 20:43:56'),
(514, 'SL24-112836 A-B-C', 'NEXIUM® COIL, AS 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 4638, 4548, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24104', '2024-12-09 20:43:56', '2024-12-09 20:43:56'),
(515, 'SL24-112431-2 A', 'NEXALUME® COIL', '1.20mm x 214mm AZ150 G550 NEXALUME® Acrylic Coated AFP', 1157, 1067, 'KGS', 'MELBOURNE, AUSTRALIA', 'DURABUILT PRODUCTS PTY LTD', 'SOX24-24103-2', '2024-12-10 00:23:24', '2024-12-10 00:23:24'),
(516, 'SL24-112831-2 D-E', 'NEXALUME® COIL', '1.20mm x 214mm AZ150 G550 NEXALUME® Acrylic Coated AFP', 2024, 2024, 'KGS', 'MELBOURNE, AUSTRALIA', 'DURABUILT PRODUCTS PTY LTD', 'SOX24-24103-2', '2024-12-10 00:23:24', '2024-12-10 00:23:24'),
(517, 'SL24-112831-1 A-B-C', 'NEXALUME® COIL', '1.20mm x 214mm AZ150 G550 NEXALUME® Acrylic Coated AFP', 3126, 3036, 'KGS', 'MELBOURNE, AUSTRALIA', 'DURABUILT PRODUCTS PTY LTD', 'SOX24-24103-2', '2024-12-10 00:23:24', '2024-12-10 00:23:24'),
(518, 'SL24-112428-1 B-C-E', 'NEXALUME® COIL', '1.00mm x 214mm AZ150 G550 NEXALUME® Acrylic Coated AFP', 3370, 3280, 'KG', 'MELBOURNE, AUSTRALIA', 'DURABUILT PRODUCTS PTY LTD', 'SOX24-24103-1', '2024-12-10 00:32:30', '2024-12-10 00:32:30'),
(519, 'SL24-112909 A-B-C-D-E-F-G-H', 'NEXALUME ® COIL AS / NZ - 1397', '0.55mm x 55mm AZ150 G300 NEXALUME® Acrylic Coated AFP', 2285, 2240, 'KGS', 'NAPIER, NZ', 'PO15158 / STORETECH', 'SOX24-24111', '2024-12-12 01:21:55', '2024-12-12 01:21:55'),
(520, 'SL24-112916 A-B-C-D-E-F-G', 'NEXALUME ® COIL AS / NZ - 1397', '0.55mm x 55mm AZ150 G300 NEXALUME® Acrylic Coated AFP', 2005, 1960, 'KGS', 'NAPIER, NZ', 'PO15158 / STORETECH', 'SOX24-24111', '2024-12-12 01:21:55', '2024-12-12 01:21:55'),
(521, 'SL24-112908 A-B-C-D-E-F-G-H', 'NEXALUME ® COIL AS / NZ - 1397', '0.55mm x 55mm AZ150 G300 NEXALUME® Acrylic Coated AFP', 2285, 2240, 'KGS', 'NAPIER, NZ', 'PO15158 / STORETECH', 'SOX24-24111', '2024-12-12 01:21:55', '2024-12-12 01:21:55'),
(522, 'SL24-112917 A-B-C-D-E-F-G', 'NEXALUME ® COIL AS / NZ - 1397', '0.55mm x 55mm AZ150 G300 NEXALUME® Acrylic Coated AFP', 2005, 1960, 'KGS', 'NAPIER, NZ', 'PO15158 / STORETECH', 'SOX24-24111', '2024-12-12 01:21:55', '2024-12-12 01:21:55'),
(523, 'SL24-112910 A-B-C-D-E-F-G-H', 'NEXALUME ® COIL AS / NZ - 1397', '0.55mm x 55mm AZ150 G300 NEXALUME® Acrylic Coated AFP', 2333, 2288, 'KGS', 'NAPIER, NZ', 'PO15158 / STORETECH', 'SOX24-24111', '2024-12-12 01:21:55', '2024-12-12 01:21:55'),
(524, 'SL24-112913 A-B-C-D-E-F-G', 'NEXALUME ® COIL AS / NZ - 1397', '0.55mm x 55mm AZ150 G300 NEXALUME® Acrylic Coated AFP', 2040, 1995, 'KGS', 'NAPIER, NZ', 'PO15158 / STORETECH', 'SOX24-24111', '2024-12-12 01:21:55', '2024-12-12 01:21:55'),
(525, 'SL24-112911 A-B-C-D-E-F-G-H', 'NEXALUME ® COIL AS / NZ - 1397', '0.55mm x 55mm AZ150 G300 NEXALUME® Acrylic Coated AFP', 2221, 2176, 'KGS', 'NAPIER, NZ', 'PO15158 / STORETECH', 'SOX24-24111', '2024-12-12 01:21:55', '2024-12-12 01:21:55'),
(526, 'SL24-112915 A-B-C-D-E-F-G', 'NEXALUME ® COIL AS / NZ - 1397', '0.55mm x 55mm AZ150 G300 NEXALUME® Acrylic Coated AFP', 1942, 1897, 'KGS', 'NAPIER, NZ', 'PO15158 / STORETECH', 'SOX24-24111', '2024-12-12 01:21:55', '2024-12-12 01:21:55'),
(527, 'SL24-112912 A-B-C-D-E-F-G', 'NEXALUME ® COIL AS / NZ - 1397', '0.55mm x 55mm AZ150 G300 NEXALUME® Acrylic Coated AFP', 2040, 1995, 'KGS', 'NAPIER, NZ', 'PO15158 / STORETECH', 'SOX24-24111', '2024-12-12 01:21:55', '2024-12-12 01:21:55'),
(528, 'SL24-112914 A-B-C-D-E-F-G', 'NEXALUME ® COIL AS / NZ - 1397', '0.55mm x 55mm AZ150 G300 NEXALUME® Acrylic Coated AFP', 1935, 1890, 'KGS', 'NAPIER, NZ', 'PO15158 / STORETECH', 'SOX24-24111', '2024-12-12 01:21:55', '2024-12-12 01:21:55'),
(529, 'SL24-112918 A-B-C-D-E-F-G', 'NEXALUME ® COIL AS / NZ - 1397', '0.55mm x 55mm AZ150 G300 NEXALUME® Acrylic Coated AFP', 2005, 1960, 'KGS', 'NAPIER, NZ', 'PO15158 / STORETECH', 'SOX24-24111', '2024-12-12 01:21:55', '2024-12-12 01:21:55'),
(530, 'SL24-112919 A-B-C-D-E-F-G', 'NEXALUME ® COIL AS / NZ - 1397', '0.55mm x 55mm AZ150 G300 NEXALUME® Acrylic Coated AFP', 2005, 1960, 'KGS', 'NAPIER, NZ', 'PO15158 / STORETECH', 'SOX24-24111', '2024-12-12 01:21:55', '2024-12-12 01:21:55'),
(531, 'SL24-112800-1 A & C', 'NEXIUM® COIL, AS 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 2808, 2718, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24104', '2024-12-23 04:27:34', '2024-12-23 04:27:34'),
(532, 'SL24-112817-1 A', 'NEXIUM® COIL, AS 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 1251, 1251, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24104', '2024-12-23 04:27:34', '2024-12-23 04:27:34'),
(533, 'SL24-112800-2 B', 'NEXIUM® COIL, AS 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 1150, 1150, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24104', '2024-12-23 04:27:34', '2024-12-23 04:27:34'),
(534, 'SL24-112808-2 B', 'NEXIUM® COIL, AS 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 1075, 1075, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24104', '2024-12-23 04:27:34', '2024-12-23 04:27:34'),
(535, 'SL24-112811-2 B', 'NEXIUM® COIL, AS 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 1176, 1086, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24104', '2024-12-23 04:27:34', '2024-12-23 04:27:34'),
(536, 'SL24-112808-1 A & C', 'NEXIUM® COIL, AS 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 2862, 2772, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24104', '2024-12-23 04:27:34', '2024-12-23 04:27:34'),
(537, 'SL24-112811-1 A & C', 'NEXIUM® COIL, AS 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 3322, 3232, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24104', '2024-12-23 04:27:34', '2024-12-23 04:27:34'),
(538, 'SL24-112816-2 B-C', 'NEXIUM® COIL, AS 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 3252, 3162, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24104', '2024-12-23 04:27:34', '2024-12-23 04:27:34'),
(539, 'SL24-112816-1 A', 'NEXIUM® COIL, AS 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 1442, 1442, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24104', '2024-12-23 04:27:34', '2024-12-23 04:27:34'),
(540, 'SL24-112806-2 C', 'NEXIUM® COIL, AS 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 1554, 1464, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24104', '2024-12-23 04:27:34', '2024-12-23 04:27:34'),
(541, 'SL24-112817-2 B-C', 'NEXIUM® COIL, AS 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 3244, 3154, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24104', '2024-12-23 04:27:34', '2024-12-23 04:27:34'),
(542, 'SL24-112806-1 A-B', 'NEXIUM® COIL, AS 1397', '0.40mm x 385.5mm Z200 G250 NEXIUM® PASSIVATION', 3242, 3152, 'KGS', 'MELBOURNE, AUSTRALIA', 'SPEEDPANEL SYSTEMS PTY LTD', 'SOX24-24104', '2024-12-23 04:27:34', '2024-12-23 04:27:34'),
(543, 'G1L25101445', 'NEXALUME COIL , ASTM  A - 792', '0.0185\" NOM x 41.50\" AZ55 SS-5 Class 2 NEXALUME® Acrylic Coated AFP', 9358, 9160, 'lbs', 'PORT TAMPA, USA', 'JFE SHOJI AMERICA - PO30261', 'SOX24-24114-1', '2025-01-20 04:13:32', '2025-01-20 04:13:32'),
(544, 'G1L25101446', 'NEXALUME COIL , ASTM  A - 792', '0.0185\" NOM x 41.50\" AZ55 SS-5 Class 2 NEXALUME® Acrylic Coated AFP', 9358, 9160, 'lbs', 'PORT TAMPA, USA', 'JFE SHOJI AMERICA - PO30261', 'SOX24-24114-1', '2025-01-20 04:13:32', '2025-01-20 04:13:32'),
(545, 'G1L25101447', 'NEXALUME COIL , ASTM  A - 792', '0.0185\" NOM x 41.50\" AZ55 SS-5 Class 2 NEXALUME® Acrylic Coated AFP', 9371, 9173, 'lbs', 'PORT TAMPA, USA', 'JFE SHOJI AMERICA - PO30261', 'SOX24-24114-1', '2025-01-20 04:13:32', '2025-01-20 04:13:32'),
(546, 'G1L25101448', 'NEXALUME COIL , ASTM  A - 792', '0.0185\" NOM x 41.50\" AZ55 SS-5 Class 2 NEXALUME® Acrylic Coated AFP', 9376, 9178, 'lbs', 'PORT TAMPA, USA', 'JFE SHOJI AMERICA - PO30261', 'SOX24-24114-1', '2025-01-20 04:13:32', '2025-01-20 04:13:32'),
(547, 'G1L25101449', 'NEXALUME COIL , ASTM  A - 792', '0.0185\" NOM x 41.50\" AZ55 SS-5 Class 2 NEXALUME® Acrylic Coated AFP', 8445, 8247, 'lbs', 'PORT TAMPA, USA', 'JFE SHOJI AMERICA - PO30261', 'SOX24-24114-1', '2025-01-20 04:13:32', '2025-01-20 04:13:32'),
(548, 'G1L25101450', 'NEXALUME COIL , ASTM  A - 792', '0.0185\" NOM x 41.50\" AZ55 SS-5 Class 2 NEXALUME® Acrylic Coated AFP', 9158, 8960, 'lbs', 'PORT TAMPA, USA', 'JFE SHOJI AMERICA - PO30261', 'SOX24-24114-1', '2025-01-20 04:13:32', '2025-01-20 04:13:32'),
(549, 'G1L25101451', 'NEXALUME COIL , ASTM  A - 792', '0.0185\" NOM x 41.50\" AZ55 SS-5 Class 2 NEXALUME® Acrylic Coated AFP', 9169, 8971, 'lbs', 'PORT TAMPA, USA', 'JFE SHOJI AMERICA - PO30261', 'SOX24-24114-1', '2025-01-20 04:13:32', '2025-01-20 04:13:32'),
(550, 'G1L25101452', 'NEXALUME COIL , ASTM  A - 792', '0.0185\" NOM x 41.50\" AZ55 SS-5 Class 2 NEXALUME® Acrylic Coated AFP', 9158, 8960, 'lbs', 'PORT TAMPA, USA', 'JFE SHOJI AMERICA - PO30261', 'SOX24-24114-1', '2025-01-20 04:13:32', '2025-01-20 04:13:32'),
(551, 'G1L25101453', 'NEXALUME COIL , ASTM  A - 792', '0.0185\" NOM x 41.50\" AZ55 SS-5 Class 2 NEXALUME® Acrylic Coated AFP', 9155, 8957, 'lbs', 'PORT TAMPA, USA', 'JFE SHOJI AMERICA - PO30261', 'SOX24-24114-1', '2025-01-20 04:13:32', '2025-01-20 04:13:32'),
(552, 'G1L25101454', 'NEXALUME COIL , ASTM  A - 792', '0.0185\" NOM x 41.50\" AZ55 SS-5 Class 2 NEXALUME® Acrylic Coated AFP', 9550, 9352, 'lbs', 'PORT TAMPA, USA', 'JFE SHOJI AMERICA - PO30261', 'SOX24-24114-1', '2025-01-20 04:13:32', '2025-01-20 04:13:32'),
(553, 'G1L25101455', 'NEXALUME COIL , ASTM  A - 792', '0.0185\" NOM x 41.50\" AZ55 SS-5 Class 2 NEXALUME® Acrylic Coated AFP', 9217, 9019, 'lbs', 'PORT TAMPA, USA', 'JFE SHOJI AMERICA - PO30261', 'SOX24-24114-1', '2025-01-20 04:13:32', '2025-01-20 04:13:32'),
(554, 'G1L25101456', 'NEXALUME COIL , ASTM  A - 792', '0.0185\" NOM x 41.50\" AZ55 SS-5 Class 2 NEXALUME® Acrylic Coated AFP', 9219, 9021, 'lbs', 'PORT TAMPA, USA', 'JFE SHOJI AMERICA - PO30261', 'SOX24-24114-1', '2025-01-20 04:13:32', '2025-01-20 04:13:32'),
(555, 'G1L25101457', 'NEXALUME COIL , ASTM  A - 792', '0.0185\" NOM x 41.50\" AZ55 SS-5 Class 2 NEXALUME® Acrylic Coated AFP', 9208, 9010, 'lbs', 'PORT TAMPA, USA', 'JFE SHOJI AMERICA - PO30261', 'SOX24-24114-1', '2025-01-20 04:13:32', '2025-01-20 04:13:32'),
(556, 'G1L25101458', 'NEXALUME COIL , ASTM  A - 792', '0.0185\" NOM x 41.50\" AZ55 SS-5 Class 2 NEXALUME® Acrylic Coated AFP', 9215, 9017, 'lbs', 'PORT TAMPA, USA', 'JFE SHOJI AMERICA - PO30261', 'SOX24-24114-1', '2025-01-20 04:13:32', '2025-01-20 04:13:32'),
(557, 'G1L25101459', 'NEXALUME COIL , ASTM  A - 792', '0.0185\" NOM x 41.50\" AZ55 SS-5 Class 2 NEXALUME® Acrylic Coated AFP', 9528, 9330, 'lbs', 'PORT TAMPA, USA', 'JFE SHOJI AMERICA - PO30261', 'SOX24-24114-1', '2025-01-20 04:13:32', '2025-01-20 04:13:32'),
(558, 'G1L25101460', 'NEXALUME COIL , ASTM  A - 792', '0.0185\" NOM x 41.50\" AZ55 SS-5 Class 2 NEXALUME® Acrylic Coated AFP', 9272, 9074, 'lbs', 'PORT TAMPA, USA', 'JFE SHOJI AMERICA - PO30261', 'SOX24-24114-1', '2025-01-20 04:13:32', '2025-01-20 04:13:32'),
(559, 'G1L25101461', 'NEXALUME COIL , ASTM  A - 792', '0.0185\" NOM x 41.50\" AZ55 SS-5 Class 2 NEXALUME® Acrylic Coated AFP', 9274, 9076, 'lbs', 'PORT TAMPA, USA', 'JFE SHOJI AMERICA - PO30261', 'SOX24-24114-1', '2025-01-20 04:13:32', '2025-01-20 04:13:32'),
(560, 'G1L25101462', 'NEXALUME COIL , ASTM  A - 792', '0.0185\" NOM x 41.50\" AZ55 SS-5 Class 2 NEXALUME® Acrylic Coated AFP', 9272, 9074, 'lbs', 'PORT TAMPA, USA', 'JFE SHOJI AMERICA - PO30261', 'SOX24-24114-1', '2025-01-20 04:13:32', '2025-01-20 04:13:32'),
(561, 'G1L25101463', 'NEXALUME COIL , ASTM  A - 792', '0.0185\" NOM x 41.50\" AZ55 SS-5 Class 2 NEXALUME® Acrylic Coated AFP', 9270, 9072, 'lbs', 'PORT TAMPA, USA', 'JFE SHOJI AMERICA - PO30261', 'SOX24-24114-1', '2025-01-20 04:13:32', '2025-01-20 04:13:32'),
(562, 'G1L25101464', 'NEXALUME COIL , ASTM  A - 792', '0.0185\" NOM x 41.50\" AZ55 SS-5 Class 2 NEXALUME® Acrylic Coated AFP', 9191, 8993, 'lbs', 'PORT TAMPA, USA', 'JFE SHOJI AMERICA - PO30261', 'SOX24-24114-1', '2025-01-20 04:13:32', '2025-01-20 04:13:32'),
(563, 'G1L25101465', 'NEXALUME COIL , ASTM  A - 792', '0.0185\" NOM x 41.50\" AZ55 SS-5 Class 2 NEXALUME® Acrylic Coated AFP', 9301, 9103, 'lbs', 'PORT TAMPA, USA', 'JFE SHOJI AMERICA - PO30261', 'SOX24-24114-1', '2025-01-20 04:13:32', '2025-01-20 04:13:32'),
(564, 'G1L25101466', 'NEXALUME COIL , ASTM  A - 792', '0.0185\" NOM x 41.50\" AZ55 SS-5 Class 2 NEXALUME® Acrylic Coated AFP', 9305, 9107, 'lbs', 'PORT TAMPA, USA', 'JFE SHOJI AMERICA - PO30261', 'SOX24-24114-1', '2025-01-20 04:13:32', '2025-01-20 04:13:32'),
(565, 'G1L25101467', 'NEXALUME COIL , ASTM  A - 792', '0.0185\" NOM x 41.50\" AZ55 SS-5 Class 2 NEXALUME® Acrylic Coated AFP', 9305, 9107, 'lbs', 'PORT TAMPA, USA', 'JFE SHOJI AMERICA - PO30261', 'SOX24-24114-1', '2025-01-20 04:13:32', '2025-01-20 04:13:32'),
(566, 'G1L25101468', 'NEXALUME COIL , ASTM  A - 792', '0.0185\" NOM x 41.50\" AZ55 SS-5 Class 2 NEXALUME® Acrylic Coated AFP', 9305, 9107, 'lbs', 'PORT TAMPA, USA', 'JFE SHOJI AMERICA - PO30261', 'SOX24-24114-1', '2025-01-20 04:13:32', '2025-01-20 04:13:32'),
(567, 'G1L25101469', 'NEXALUME COIL , ASTM  A - 792', '0.0185\" NOM x 41.50\" AZ55 SS-5 Class 2 NEXALUME® Acrylic Coated AFP', 9409, 9211, 'lbs', 'PORT TAMPA, USA', 'JFE SHOJI AMERICA - PO30261', 'SOX24-24114-1', '2025-01-20 04:13:32', '2025-01-20 04:13:32'),
(568, 'G1L25101403', 'NEXALUME COIL , ASTM  A - 792', '0.0236\" NOM x 48.00\" AZ55 SS-5 Class 2 NEXALUME® Acrylic Coated AFP', 9757, 9559, 'lbs', 'PORT TAMPA, USA', 'JFE SHOJI AMERICA - PO30261', 'SOX24-24114-2', '2025-01-20 04:54:46', '2025-01-20 04:54:46'),
(569, 'G1L25101404', 'NEXALUME COIL , ASTM  A - 792', '0.0236\" NOM x 48.00\" AZ55 SS-5 Class 2 NEXALUME® Acrylic Coated AFP', 9737, 9539, 'lbs', 'PORT TAMPA, USA', 'JFE SHOJI AMERICA - PO30261', 'SOX24-24114-2', '2025-01-20 04:54:46', '2025-01-20 04:54:46'),
(570, 'G1L25101405', 'NEXALUME COIL , ASTM  A - 792', '0.0236\" NOM x 48.00\" AZ55 SS-5 Class 2 NEXALUME® Acrylic Coated AFP', 9735, 9537, 'lbs', 'PORT TAMPA, USA', 'JFE SHOJI AMERICA - PO30261', 'SOX24-24114-2', '2025-01-20 04:54:46', '2025-01-20 04:54:46'),
(571, 'G1L25101406', 'NEXALUME COIL , ASTM  A - 792', '0.0236\" NOM x 48.00\" AZ55 SS-5 Class 2 NEXALUME® Acrylic Coated AFP', 9713, 9515, 'lbs', 'PORT TAMPA, USA', 'JFE SHOJI AMERICA - PO30261', 'SOX24-24114-2', '2025-01-20 04:54:46', '2025-01-20 04:54:46'),
(572, 'G1L25101407', 'NEXALUME COIL , ASTM  A - 792', '0.0236\" NOM x 48.00\" AZ55 SS-5 Class 2 NEXALUME® Acrylic Coated AFP', 8736, 8538, 'lbs', 'PORT TAMPA, USA', 'JFE SHOJI AMERICA - PO30261', 'SOX24-24114-2', '2025-01-20 04:54:46', '2025-01-20 04:54:46'),
(573, 'G1L25101408', 'NEXALUME COIL , ASTM  A - 792', '0.0236\" NOM x 48.00\" AZ55 SS-5 Class 2 NEXALUME® Acrylic Coated AFP', 10053, 9855, 'lbs', 'PORT TAMPA, USA', 'JFE SHOJI AMERICA - PO30261', 'SOX24-24114-2', '2025-01-20 04:54:46', '2025-01-20 04:54:46'),
(574, 'G1L25101409', 'NEXALUME COIL , ASTM  A - 792', '0.0236\" NOM x 48.00\" AZ55 SS-5 Class 2 NEXALUME® Acrylic Coated AFP', 10072, 9874, 'lbs', 'PORT TAMPA, USA', 'JFE SHOJI AMERICA - PO30261', 'SOX24-24114-2', '2025-01-20 04:54:46', '2025-01-20 04:54:46'),
(575, 'G1L25101410', 'NEXALUME COIL , ASTM  A - 792', '0.0236\" NOM x 48.00\" AZ55 SS-5 Class 2 NEXALUME® Acrylic Coated AFP', 10072, 9874, 'lbs', 'PORT TAMPA, USA', 'JFE SHOJI AMERICA - PO30261', 'SOX24-24114-2', '2025-01-20 04:54:46', '2025-01-20 04:54:46'),
(576, 'G1L25101411', 'NEXALUME COIL , ASTM  A - 792', '0.0236\" NOM x 48.00\" AZ55 SS-5 Class 2 NEXALUME® Acrylic Coated AFP', 10075, 9877, 'lbs', 'PORT TAMPA, USA', 'JFE SHOJI AMERICA - PO30261', 'SOX24-24114-2', '2025-01-20 04:54:46', '2025-01-20 04:54:46'),
(577, 'G1L25101412', 'NEXALUME COIL , ASTM  A - 792', '0.0236\" NOM x 48.00\" AZ55 SS-5 Class 2 NEXALUME® Acrylic Coated AFP', 9098, 8900, 'lbs', 'PORT TAMPA, USA', 'JFE SHOJI AMERICA - PO30261', 'SOX24-24114-2', '2025-01-20 04:54:46', '2025-01-20 04:54:46'),
(578, 'G1L25101413', 'NEXALUME COIL , ASTM  A - 792', '0.0236\" NOM x 48.00\" AZ55 SS-5 Class 2 NEXALUME® Acrylic Coated AFP', 8205, 8007, 'lbs', 'PORT TAMPA, USA', 'JFE SHOJI AMERICA - PO30261', 'SOX24-24114-2', '2025-01-20 04:54:46', '2025-01-20 04:54:46'),
(579, 'G1L25101414', 'NEXALUME COIL , ASTM  A - 792', '0.0236\" NOM x 48.00\" AZ55 SS-5 Class 2 NEXALUME® Acrylic Coated AFP', 8210, 8012, 'lbs', 'PORT TAMPA, USA', 'JFE SHOJI AMERICA - PO30261', 'SOX24-24114-2', '2025-01-20 04:54:46', '2025-01-20 04:54:46'),
(580, 'G1L25101415', 'NEXALUME COIL , ASTM  A - 792', '0.0236\" NOM x 48.00\" AZ55 SS-5 Class 2 NEXALUME® Acrylic Coated AFP', 8218, 8020, 'lbs', 'PORT TAMPA, USA', 'JFE SHOJI AMERICA - PO30261', 'SOX24-24114-2', '2025-01-20 04:54:46', '2025-01-20 04:54:46'),
(581, 'G1L25101416', 'NEXALUME COIL , ASTM  A - 792', '0.0236\" NOM x 48.00\" AZ55 SS-5 Class 2 NEXALUME® Acrylic Coated AFP', 8216, 8018, 'lbs', 'PORT TAMPA, USA', 'JFE SHOJI AMERICA - PO30261', 'SOX24-24114-2', '2025-01-20 04:54:46', '2025-01-20 04:54:46'),
(582, 'G1L25101417', 'NEXALUME COIL , ASTM  A - 792', '0.0236\" NOM x 48.00\" AZ55 SS-5 Class 2 NEXALUME® Acrylic Coated AFP', 8218, 8020, 'lbs', 'PORT TAMPA, USA', 'JFE SHOJI AMERICA - PO30261', 'SOX24-24114-2', '2025-01-20 04:54:46', '2025-01-20 04:54:46'),
(583, 'G1L25101418', 'NEXALUME COIL , ASTM  A - 792', '0.0236\" NOM x 48.00\" AZ55 SS-5 Class 2 NEXALUME® Acrylic Coated AFP', 9195, 8997, 'lbs', 'PORT TAMPA, USA', 'JFE SHOJI AMERICA - PO30261', 'SOX24-24114-2', '2025-01-20 04:54:46', '2025-01-20 04:54:46'),
(584, 'G1L25101419', 'NEXALUME COIL , ASTM  A - 792', '0.0236\" NOM x 48.00\" AZ55 SS-5 Class 2 NEXALUME® Acrylic Coated AFP', 8942, 8744, 'lbs', 'PORT TAMPA, USA', 'JFE SHOJI AMERICA - PO30261', 'SOX24-24114-2', '2025-01-20 04:54:46', '2025-01-20 04:54:46'),
(585, 'G1L25101420', 'NEXALUME COIL , ASTM  A - 792', '0.0236\" NOM x 48.00\" AZ55 SS-5 Class 2 NEXALUME® Acrylic Coated AFP', 8946, 8748, 'lbs', 'PORT TAMPA, USA', 'JFE SHOJI AMERICA - PO30261', 'SOX24-24114-2', '2025-01-20 04:54:46', '2025-01-20 04:54:46'),
(586, 'G1L25101421', 'NEXALUME COIL , ASTM  A - 792', '0.0236\" NOM x 48.00\" AZ55 SS-5 Class 2 NEXALUME® Acrylic Coated AFP', 8942, 8744, 'lbs', 'PORT TAMPA, USA', 'JFE SHOJI AMERICA - PO30261', 'SOX24-24114-2', '2025-01-20 04:54:46', '2025-01-20 04:54:46'),
(587, 'G1L25101422', 'NEXALUME COIL , ASTM  A - 792', '0.0236\" NOM x 48.00\" AZ55 SS-5 Class 2 NEXALUME® Acrylic Coated AFP', 8942, 8744, 'lbs', 'PORT TAMPA, USA', 'JFE SHOJI AMERICA - PO30261', 'SOX24-24114-2', '2025-01-20 04:54:46', '2025-01-20 04:54:46'),
(588, 'G1L25101423', 'NEXALUME COIL , ASTM  A - 792', '0.0236\" NOM x 48.00\" AZ55 SS-5 Class 2 NEXALUME® Acrylic Coated AFP', 8939, 8741, 'lbs', 'PORT TAMPA, USA', 'JFE SHOJI AMERICA - PO30261', 'SOX24-24114-2', '2025-01-20 04:54:46', '2025-01-20 04:54:46'),
(589, 'G1L25101424', 'NEXALUME COIL , ASTM  A - 792', '0.0236\" NOM x 48.00\" AZ55 SS-5 Class 2 NEXALUME® Acrylic Coated AFP', 8005, 7807, 'lbs', 'PORT TAMPA, USA', 'JFE SHOJI AMERICA - PO30261', 'SOX24-24114-2', '2025-01-20 04:54:46', '2025-01-20 04:54:46'),
(590, 'G1L25101425', 'NEXALUME COIL , ASTM  A - 792', '0.0236\" NOM x 48.00\" AZ55 SS-5 Class 2 NEXALUME® Acrylic Coated AFP', 9001, 8803, 'lbs', 'PORT TAMPA, USA', 'JFE SHOJI AMERICA - PO30261', 'SOX24-24114-2', '2025-01-20 04:54:46', '2025-01-20 04:54:46'),
(591, 'G1L25101426', 'NEXALUME COIL , ASTM  A - 792', '0.0236\" NOM x 48.00\" AZ55 SS-5 Class 2 NEXALUME® Acrylic Coated AFP', 8972, 8774, 'lbs', 'PORT TAMPA, USA', 'JFE SHOJI AMERICA - PO30261', 'SOX24-24114-2', '2025-01-20 04:54:46', '2025-01-20 04:54:46'),
(592, 'G1L25101427', 'NEXALUME COIL , ASTM  A - 792', '0.0236\" NOM x 48.00\" AZ55 SS-5 Class 2 NEXALUME® Acrylic Coated AFP', 9003, 8805, 'lbs', 'PORT TAMPA, USA', 'JFE SHOJI AMERICA - PO30261', 'SOX24-24114-2', '2025-01-20 04:54:46', '2025-01-20 04:54:46'),
(593, 'SL23-101777-1 A-B', 'NEXALUME ® COIL, EN - 10346 / AS -1397, AFP', '0.95mm x 244mm AZ150 G550 NEXALUME® Tinted Green- Hijau Buaran', 2880, 2790, 'kgs', 'PORT CONSTANTA, ROMANIA', 'GALVAN PROFIL SRL', 'SOX23-23057A', '2025-01-22 01:17:07', '2025-01-22 01:17:07'),
(594, 'SL23-101778-1 A-B', 'NEXALUME ® COIL, EN - 10346 / AS -1397, AFP', '0.95mm x 244mm AZ150 G550 NEXALUME® Tinted Green- Hijau Buaran', 2878, 2788, 'kgs', 'PORT CONSTANTA, ROMANIA', 'GALVAN PROFIL SRL', 'SOX23-23057A', '2025-01-22 01:17:07', '2025-01-22 01:17:07'),
(595, 'SL23-101778-2 C-D', 'NEXALUME ® COIL, EN - 10346 / AS -1397, AFP', '0.95mm x 244mm AZ150 G550 NEXALUME® Tinted Green- Hijau Buaran', 2878, 2788, 'kgs', 'PORT CONSTANTA, ROMANIA', 'GALVAN PROFIL SRL', 'SOX23-23057A', '2025-01-22 01:17:07', '2025-01-22 01:17:07'),
(596, 'SL23-101779-1 A-B', 'NEXALUME ® COIL, EN - 10346 / AS -1397, AFP', '0.95mm x 244mm AZ150 G550 NEXALUME® Tinted Green- Hijau Buaran', 2810, 2720, 'kgs', 'PORT CONSTANTA, ROMANIA', 'GALVAN PROFIL SRL', 'SOX23-23057A', '2025-01-22 01:17:07', '2025-01-22 01:17:07'),
(597, 'SL23-101779-2 C-D', 'NEXALUME ® COIL, EN - 10346 / AS -1397, AFP', '0.95mm x 244mm AZ150 G550 NEXALUME® Tinted Green- Hijau Buaran', 2810, 2720, 'kgs', 'PORT CONSTANTA, ROMANIA', 'GALVAN PROFIL SRL', 'SOX23-23057A', '2025-01-22 01:17:07', '2025-01-22 01:17:07'),
(598, 'SL23-101780-1 A-B', 'NEXALUME ® COIL, EN - 10346 / AS -1397, AFP', '0.95mm x 244mm AZ150 G550 NEXALUME® Tinted Green- Hijau Buaran', 2990, 2900, 'kgs', 'PORT CONSTANTA, ROMANIA', 'GALVAN PROFIL SRL', 'SOX23-23057A', '2025-01-22 01:17:07', '2025-01-22 01:17:07'),
(599, 'SL23-101780-2 C-D', 'NEXALUME ® COIL, EN - 10346 / AS -1397, AFP', '0.95mm x 244mm AZ150 G550 NEXALUME® Tinted Green- Hijau Buaran', 2990, 2900, 'kgs', 'PORT CONSTANTA, ROMANIA', 'GALVAN PROFIL SRL', 'SOX23-23057A', '2025-01-22 01:17:07', '2025-01-22 01:17:07'),
(600, 'SL23-101784-1 A-B', 'NEXALUME ® COIL, EN - 10346 / AS -1397, AFP', '0.95mm x 244mm AZ150 G550 NEXALUME® Tinted Green- Hijau Buaran', 2990, 2900, 'kgs', 'PORT CONSTANTA, ROMANIA', 'GALVAN PROFIL SRL', 'SOX23-23057A', '2025-01-22 01:17:07', '2025-01-22 01:17:07'),
(601, 'SL23-101784-2 C-D', 'NEXALUME ® COIL, EN - 10346 / AS -1397, AFP', '0.95mm x 244mm AZ150 G550 NEXALUME® Tinted Green- Hijau Buaran', 2990, 2900, 'kgs', 'PORT CONSTANTA, ROMANIA', 'GALVAN PROFIL SRL', 'SOX23-23057A', '2025-01-22 01:17:07', '2025-01-22 01:17:07'),
(602, 'CL24-1203214', 'NEXALUME COIL, ASTM A-792, AFP', '0.020\" NOM x 43.25\" AZ50 SS80 NEXALUME® Acrylic Coated AFP', 8325, 8126, 'LBS', 'PORT VANCOUVER BC, CANADA', '21-295605', 'SOX24-24110', '2025-01-23 04:58:14', '2025-01-30 03:10:08'),
(603, 'G1L25101542', 'NEXALUME COIL, ASTM A-792, AFP', '0.020\" NOM x 43.25\" AZ50 SS80 NEXALUME® Acrylic Coated AFP', 8895, 8697, 'lbs', 'PORT VANCOUVER BC, CANADA', '21-295605', 'SOX24-24110', '2025-01-23 04:58:14', '2025-01-23 04:58:14'),
(604, 'G1L25101547', 'NEXALUME COIL, ASTM A-792, AFP', '0.020\" NOM x 43.25\" AZ50 SS80 NEXALUME® Acrylic Coated AFP', 9136, 8938, 'lbs', 'PORT VANCOUVER BC, CANADA', '21-295605', 'SOX24-24110', '2025-01-23 04:58:14', '2025-01-23 04:58:14'),
(605, 'G1L25101546', 'NEXALUME COIL, ASTM A-792, AFP', '0.020\" NOM x 43.25\" AZ50 SS80 NEXALUME® Acrylic Coated AFP', 9929, 9731, 'lbs', 'PORT VANCOUVER BC, CANADA', '21-295605', 'SOX24-24110', '2025-01-23 04:58:14', '2025-01-23 04:58:14'),
(606, 'G1L25101545', 'NEXALUME COIL, ASTM A-792, AFP', '0.020\" NOM x 43.25\" AZ50 SS80 NEXALUME® Acrylic Coated AFP', 9936, 9738, 'lbs', 'PORT VANCOUVER BC, CANADA', '21-295605', 'SOX24-24110', '2025-01-23 04:58:14', '2025-01-23 04:58:14'),
(607, 'G1L25101544', 'NEXALUME COIL, ASTM A-792, AFP', '0.020\" NOM x 43.25\" AZ50 SS80 NEXALUME® Acrylic Coated AFP', 9936, 9738, 'lbs', 'PORT VANCOUVER BC, CANADA', '21-295605', 'SOX24-24110', '2025-01-23 04:58:14', '2025-01-23 04:58:14'),
(608, 'G1L25101543', 'NEXALUME COIL, ASTM A-792, AFP', '0.020\" NOM x 43.25\" AZ50 SS80 NEXALUME® Acrylic Coated AFP', 9960, 9762, 'lbs', 'PORT VANCOUVER BC, CANADA', '21-295605', 'SOX24-24110', '2025-01-23 04:58:14', '2025-01-23 04:58:14'),
(609, 'G1L25101539', 'NEXALUME COIL, ASTM A-792, AFP', '0.020\" NOM x 43.25\" AZ50 SS80 NEXALUME® Acrylic Coated AFP', 10086, 9888, 'lbs', 'PORT VANCOUVER BC, CANADA', '21-295605', 'SOX24-24110', '2025-01-23 04:58:14', '2025-01-23 04:58:14'),
(610, 'G1L25101540', 'NEXALUME COIL, ASTM A-792, AFP', '0.020\" NOM x 43.25\" AZ50 SS80 NEXALUME® Acrylic Coated AFP', 10088, 9890, 'lbs', 'PORT VANCOUVER BC, CANADA', '21-295605', 'SOX24-24110', '2025-01-23 04:58:14', '2025-01-23 04:58:14'),
(611, 'G1L25101541', 'NEXALUME COIL, ASTM A-792, AFP', '0.020\" NOM x 43.25\" AZ50 SS80 NEXALUME® Acrylic Coated AFP', 10198, 10000, 'lbs', 'PORT VANCOUVER BC, CANADA', '21-295605', 'SOX24-24110', '2025-01-23 04:58:14', '2025-01-23 04:58:14'),
(612, 'G1L25101538', 'NEXALUME COIL, ASTM A-792, AFP', '0.020\" NOM x 43.25\" AZ50 SS80 NEXALUME® Acrylic Coated AFP', 10214, 10016, 'lbs', 'PORT VANCOUVER BC, CANADA', '21-295605', 'SOX24-24110', '2025-01-23 04:58:14', '2025-01-23 04:58:14'),
(613, 'G1L25101981', 'NEXALUME COIL, ASTM A-792, AFP', '0.0245\" NOM x 48.00\" AZ50 SS-50 NEXALUME® Acrylic Coated AFP', 9054, 8856, 'lbs', 'PORT VANCOUVER BC, CANADA', '21625', 'SOX24-24128', '2025-01-28 02:00:37', '2025-01-28 02:00:37'),
(614, 'G1L25101982', 'NEXALUME COIL, ASTM A-792, AFP', '0.0245\" NOM x 48.00\" AZ50 SS-50 NEXALUME® Acrylic Coated AFP', 9058, 8860, 'lbs', 'PORT VANCOUVER BC, CANADA', '21625', 'SOX24-24128', '2025-01-28 02:00:37', '2025-01-28 02:00:37'),
(615, 'G1L25101983', 'NEXALUME COIL, ASTM A-792, AFP', '0.0245\" NOM x 48.00\" AZ50 SS-50 NEXALUME® Acrylic Coated AFP', 9076, 8878, 'lbs', 'PORT VANCOUVER BC, CANADA', '21625', 'SOX24-24128', '2025-01-28 02:00:37', '2025-01-28 02:00:37'),
(616, 'G1L25101984', 'NEXALUME COIL, ASTM A-792, AFP', '0.0245\" NOM x 48.00\" AZ50 SS-50 NEXALUME® Acrylic Coated AFP', 9058, 8860, 'lbs', 'PORT VANCOUVER BC, CANADA', '21625', 'SOX24-24128', '2025-01-28 02:00:37', '2025-01-28 02:00:37'),
(617, 'G1L25101985', 'NEXALUME COIL, ASTM A-792, AFP', '0.0245\" NOM x 48.00\" AZ50 SS-50 NEXALUME® Acrylic Coated AFP', 9063, 8865, 'lbs', 'PORT VANCOUVER BC, CANADA', '21625', 'SOX24-24128', '2025-01-28 02:00:37', '2025-01-28 02:00:37'),
(618, 'G1L25101986', 'NEXALUME COIL, ASTM A-792, AFP', '0.0245\" NOM x 48.00\" AZ50 SS-50 NEXALUME® Acrylic Coated AFP', 6942, 6744, 'lbs', 'PORT VANCOUVER BC, CANADA', '21625', 'SOX24-24128', '2025-01-28 02:00:37', '2025-01-28 02:00:37'),
(619, 'G1L25101987', 'NEXALUME COIL, ASTM A-792, AFP', '0.0245\" NOM x 48.00\" AZ50 SS-50 NEXALUME® Acrylic Coated AFP', 9072, 8874, 'lbs', 'PORT VANCOUVER BC, CANADA', '21625', 'SOX24-24128', '2025-01-28 02:00:37', '2025-01-28 02:00:37'),
(620, 'G1L25101988', 'NEXALUME COIL, ASTM A-792, AFP', '0.0245\" NOM x 48.00\" AZ50 SS-50 NEXALUME® Acrylic Coated AFP', 9072, 8874, 'lbs', 'PORT VANCOUVER BC, CANADA', '21625', 'SOX24-24128', '2025-01-28 02:00:37', '2025-01-28 02:00:37'),
(621, 'G1L25101989', 'NEXALUME COIL, ASTM A-792, AFP', '0.0245\" NOM x 48.00\" AZ50 SS-50 NEXALUME® Acrylic Coated AFP', 9076, 8878, 'lbs', 'PORT VANCOUVER BC, CANADA', '21625', 'SOX24-24128', '2025-01-28 02:00:37', '2025-01-28 02:00:37'),
(622, 'G1L25101990', 'NEXALUME COIL, ASTM A-792, AFP', '0.0245\" NOM x 48.00\" AZ50 SS-50 NEXALUME® Acrylic Coated AFP', 9072, 8874, 'lbs', 'PORT VANCOUVER BC, CANADA', '21625', 'SOX24-24128', '2025-01-28 02:00:37', '2025-01-28 02:00:37'),
(623, 'G1L25101991', 'NEXALUME COIL, ASTM A-792, AFP', '0.0245\" NOM x 48.00\" AZ50 SS-50 NEXALUME® Acrylic Coated AFP', 9080, 8882, 'lbs', 'PORT VANCOUVER BC, CANADA', '21625', 'SOX24-24128', '2025-01-28 02:00:37', '2025-01-28 02:00:37'),
(624, 'G1L25101992', 'NEXALUME COIL, ASTM A-792, AFP', '0.0245\" NOM x 48.00\" AZ50 SS-50 NEXALUME® Acrylic Coated AFP', 6717, 6519, 'lbs', 'PORT VANCOUVER BC, CANADA', '21625', 'SOX24-24128', '2025-01-28 02:00:37', '2025-01-28 02:00:37'),
(625, 'G1L25101993', 'NEXALUME COIL, ASTM A-792, AFP', '0.0245\" NOM x 48.00\" AZ50 SS-50 NEXALUME® Acrylic Coated AFP', 9080, 8882, 'lbs', 'PORT VANCOUVER BC, CANADA', '21625', 'SOX24-24128', '2025-01-28 02:00:37', '2025-01-28 02:00:37'),
(626, 'G1L25101994', 'NEXALUME COIL, ASTM A-792, AFP', '0.0245\" NOM x 48.00\" AZ50 SS-50 NEXALUME® Acrylic Coated AFP', 9089, 8891, 'lbs', 'PORT VANCOUVER BC, CANADA', '21625', 'SOX24-24128', '2025-01-28 02:00:37', '2025-01-28 02:00:37'),
(627, 'G1L25101995', 'NEXALUME COIL, ASTM A-792, AFP', '0.0245\" NOM x 48.00\" AZ50 SS-50 NEXALUME® Acrylic Coated AFP', 9089, 8891, 'lbs', 'PORT VANCOUVER BC, CANADA', '21625', 'SOX24-24128', '2025-01-28 02:00:37', '2025-01-28 02:00:37'),
(628, 'G1L25101996', 'NEXALUME COIL, ASTM A-792, AFP', '0.0245\" NOM x 48.00\" AZ50 SS-50 NEXALUME® Acrylic Coated AFP', 9087, 8889, 'lbs', 'PORT VANCOUVER BC, CANADA', '21625', 'SOX24-24128', '2025-01-28 02:00:37', '2025-01-28 02:00:37'),
(629, 'G1L25101997', 'NEXALUME COIL, ASTM A-792, AFP', '0.0245\" NOM x 48.00\" AZ50 SS-50 NEXALUME® Acrylic Coated AFP', 9089, 8891, 'lbs', 'PORT VANCOUVER BC, CANADA', '21625', 'SOX24-24128', '2025-01-28 02:00:37', '2025-01-28 02:00:37'),
(630, 'G1L25101998', 'NEXALUME COIL, ASTM A-792, AFP', '0.0245\" NOM x 48.00\" AZ50 SS-50 NEXALUME® Acrylic Coated AFP', 6854, 6656, 'lbs', 'PORT VANCOUVER BC, CANADA', '21625', 'SOX24-24128', '2025-01-28 02:00:37', '2025-01-28 02:00:37'),
(631, 'G1L25101999', 'NEXALUME COIL, ASTM A-792, AFP', '0.0245\" NOM x 48.00\" AZ50 SS-50 NEXALUME® Acrylic Coated AFP', 9087, 8889, 'lbs', 'PORT VANCOUVER BC, CANADA', '21625', 'SOX24-24128', '2025-01-28 02:00:37', '2025-01-28 02:00:37'),
(632, 'G1L25102000', 'NEXALUME COIL, ASTM A-792, AFP', '0.0245\" NOM x 48.00\" AZ50 SS-50 NEXALUME® Acrylic Coated AFP', 9098, 8900, 'lbs', 'PORT VANCOUVER BC, CANADA', '21625', 'SOX24-24128', '2025-01-28 02:00:37', '2025-01-28 02:00:37'),
(633, 'G1L25102001', 'NEXALUME COIL, ASTM A-792, AFP', '0.0245\" NOM x 48.00\" AZ50 SS-50 NEXALUME® Acrylic Coated AFP', 9111, 8913, 'lbs', 'PORT VANCOUVER BC, CANADA', '21625', 'SOX24-24128', '2025-01-28 02:00:37', '2025-01-28 02:00:37'),
(634, 'G1L25102002', 'NEXALUME COIL, ASTM A-792, AFP', '0.0245\" NOM x 48.00\" AZ50 SS-50 NEXALUME® Acrylic Coated AFP', 9100, 8902, 'lbs', 'PORT VANCOUVER BC, CANADA', '21625', 'SOX24-24128', '2025-01-28 02:00:37', '2025-01-28 02:00:37'),
(635, 'G1L25102003', 'NEXALUME COIL, ASTM A-792, AFP', '0.0245\" NOM x 48.00\" AZ50 SS-50 NEXALUME® Acrylic Coated AFP', 9100, 8902, 'lbs', 'PORT VANCOUVER BC, CANADA', '21625', 'SOX24-24128', '2025-01-28 02:00:37', '2025-01-28 02:00:37'),
(636, 'G1L25102004', 'NEXALUME COIL, ASTM A-792, AFP', '0.0245\" NOM x 48.00\" AZ50 SS-50 NEXALUME® Acrylic Coated AFP', 6499, 6301, 'lbs', 'PORT VANCOUVER BC, CANADA', '21625', 'SOX24-24128', '2025-01-28 02:00:37', '2025-01-28 02:00:37'),
(637, 'G1L25102005', 'NEXALUME COIL, ASTM A-792, AFP', '0.0245\" NOM x 48.00\" AZ50 SS-50 NEXALUME® Acrylic Coated AFP', 9080, 8882, 'lbs', 'PORT VANCOUVER BC, CANADA', '21625', 'SOX24-24128', '2025-01-28 02:00:37', '2025-01-28 02:00:37'),
(638, 'G1L25102006', 'NEXALUME COIL, ASTM A-792, AFP', '0.0245\" NOM x 48.00\" AZ50 SS-50 NEXALUME® Acrylic Coated AFP', 9083, 8885, 'lbs', 'PORT VANCOUVER BC, CANADA', '21625', 'SOX24-24128', '2025-01-28 02:00:37', '2025-01-28 02:00:37'),
(639, 'G1L25102007', 'NEXALUME COIL, ASTM A-792, AFP', '0.0245\" NOM x 48.00\" AZ50 SS-50 NEXALUME® Acrylic Coated AFP', 9971, 9773, 'lbs', 'PORT VANCOUVER BC, CANADA', '21625', 'SOX24-24128', '2025-01-28 02:00:37', '2025-01-28 02:00:37'),
(640, 'CL25-100657', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 14991, 14793, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:26', '2025-02-02 06:19:26'),
(641, 'CL25-100658', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 14989, 14791, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:26', '2025-02-02 06:19:26'),
(642, 'CL25-100659', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15463, 15265, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:26', '2025-02-02 06:19:26'),
(643, 'CL25-100715', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15256, 15058, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:26', '2025-02-02 06:19:26'),
(644, 'CL25-100716', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15214, 15016, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:26', '2025-02-02 06:19:26'),
(645, 'CL25-100717', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15051, 14853, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:26', '2025-02-02 06:19:26'),
(646, 'CL25-100718', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15205, 15007, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:26', '2025-02-02 06:19:26'),
(647, 'CL25-100719', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15103, 14905, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:26', '2025-02-02 06:19:26'),
(648, 'CL25-100720', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 14971, 14773, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:26', '2025-02-02 06:19:26'),
(649, 'CL25-100721', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15593, 15395, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:26', '2025-02-02 06:19:26'),
(650, 'CL25-100722', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15630, 15432, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:26', '2025-02-02 06:19:26'),
(651, 'CL25-100723', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 14473, 14275, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:26', '2025-02-02 06:19:26'),
(652, 'CL25-100724', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 14801, 14603, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:26', '2025-02-02 06:19:26'),
(653, 'CL25-100725', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 14762, 14564, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:26', '2025-02-02 06:19:26'),
(654, 'CL25-100726', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15297, 15099, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:26', '2025-02-02 06:19:26'),
(655, 'CL25-100727', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15026, 14828, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:26', '2025-02-02 06:19:26'),
(656, 'CL25-100728', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15033, 14835, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:26', '2025-02-02 06:19:26'),
(657, 'CL25-100729', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 14720, 14522, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:26', '2025-02-02 06:19:26'),
(658, 'CL25-100806', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15337, 15139, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:26', '2025-02-02 06:19:26'),
(659, 'CL25-100807', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15331, 15133, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:26', '2025-02-02 06:19:26'),
(660, 'CL25-100808', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15075, 14877, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:26', '2025-02-02 06:19:26'),
(661, 'CL25-100809', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15170, 14972, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:26', '2025-02-02 06:19:26'),
(662, 'CL25-100810', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15192, 14994, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:26', '2025-02-02 06:19:26'),
(663, 'CL25-100811', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15042, 14844, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:26', '2025-02-02 06:19:26'),
(664, 'CL25-100812', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15075, 14877, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:26', '2025-02-02 06:19:26'),
(665, 'CL25-100813', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15073, 14875, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:26', '2025-02-02 06:19:26'),
(666, 'CL25-100814', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15130, 14932, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:26', '2025-02-02 06:19:26'),
(667, 'CL25-100815', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15267, 15069, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:26', '2025-02-02 06:19:26'),
(668, 'CL25-100816', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15275, 15077, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:26', '2025-02-02 06:19:26'),
(669, 'CL25-100817', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15712, 15514, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:26', '2025-02-02 06:19:26'),
(670, 'CL25-100818', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 14971, 14773, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:26', '2025-02-02 06:19:26'),
(671, 'CL25-100819', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 14971, 14773, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:26', '2025-02-02 06:19:26'),
(672, 'CL25-100820', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15348, 15150, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:26', '2025-02-02 06:19:26'),
(673, 'CL25-100821', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 14127, 13929, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:26', '2025-02-02 06:19:26'),
(674, 'CL25-100823', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 14610, 14412, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:26', '2025-02-02 06:19:26'),
(675, 'CL25-100824', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 14892, 14694, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:26', '2025-02-02 06:19:26'),
(676, 'CL25-100825', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 14929, 14731, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:26', '2025-02-02 06:19:26'),
(677, 'CL25-100826', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 14949, 14751, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:26', '2025-02-02 06:19:26');
INSERT INTO `shippmentb` (`id`, `atribute`, `product`, `size`, `gros`, `net`, `satuan_berat`, `destination`, `manufactur`, `type`, `created_at`, `updated_at`) VALUES
(678, 'CL25-100827', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15117, 14919, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:26', '2025-02-02 06:19:26'),
(679, 'CL25-100828', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15128, 14930, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:26', '2025-02-02 06:19:26'),
(680, 'CL25-100829', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15130, 14932, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:26', '2025-02-02 06:19:26'),
(681, 'CL25-100830', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 14982, 14784, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:26', '2025-02-02 06:19:26'),
(682, 'CL25-100831', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 14967, 14769, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:26', '2025-02-02 06:19:26'),
(683, 'CL25-100832', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15306, 15108, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:26', '2025-02-02 06:19:26'),
(684, 'CL25-100833', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15300, 15102, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:26', '2025-02-02 06:19:26'),
(685, 'CL25-100834', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15319, 15121, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:26', '2025-02-02 06:19:26'),
(686, 'CL25-100835', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15269, 15071, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:26', '2025-02-02 06:19:26'),
(687, 'CL25-100836', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 14541, 14343, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:26', '2025-02-02 06:19:26'),
(688, 'CL25-100837', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 14550, 14352, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:26', '2025-02-02 06:19:26'),
(689, 'CL25-100838', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 14413, 14215, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:26', '2025-02-02 06:19:26'),
(690, 'CL25-100839', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15242, 15044, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:26', '2025-02-02 06:19:26'),
(691, 'CL25-100840', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15240, 15042, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:26', '2025-02-02 06:19:26'),
(692, 'CL25-100841', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15185, 14987, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:26', '2025-02-02 06:19:26'),
(693, 'CL25-100842', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15181, 14983, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:26', '2025-02-02 06:19:26'),
(694, 'CL25-100843', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15167, 14969, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:26', '2025-02-02 06:19:26'),
(695, 'CL25-100844', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15013, 14815, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:26', '2025-02-02 06:19:26'),
(696, 'CL25-100845', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15200, 15002, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:26', '2025-02-02 06:19:26'),
(697, 'CL25-100846', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15203, 15005, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:26', '2025-02-02 06:19:26'),
(698, 'CL25-100847', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15560, 15362, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:26', '2025-02-02 06:19:26'),
(699, 'CL25-100848', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 14621, 14423, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:26', '2025-02-02 06:19:26'),
(700, 'CL25-100849', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 14627, 14429, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:26', '2025-02-02 06:19:26'),
(701, 'CL25-100850', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 14259, 14061, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:27', '2025-02-02 06:19:27'),
(702, 'CL25-100851', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15328, 15130, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:27', '2025-02-02 06:19:27'),
(703, 'CL25-100852', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15331, 15133, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:27', '2025-02-02 06:19:27'),
(704, 'CL25-100853', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15165, 14967, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:27', '2025-02-02 06:19:27'),
(705, 'CL25-100854', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 14574, 14376, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:27', '2025-02-02 06:19:27'),
(706, 'CL25-100855', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 14577, 14379, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:27', '2025-02-02 06:19:27'),
(707, 'CL25-100856', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 14636, 14438, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:27', '2025-02-02 06:19:27'),
(708, 'CL25-100857', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 14343, 14145, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:27', '2025-02-02 06:19:27'),
(709, 'CL25-100858', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 14336, 14138, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:27', '2025-02-02 06:19:27'),
(710, 'CL25-100860', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 14832, 14634, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:27', '2025-02-02 06:19:27'),
(711, 'CL25-100861', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 14861, 14663, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:27', '2025-02-02 06:19:27'),
(712, 'CL25-100862', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 14537, 14339, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:27', '2025-02-02 06:19:27'),
(713, 'CL25-100863', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15262, 15064, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:27', '2025-02-02 06:19:27'),
(714, 'CL25-100864', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15273, 15075, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:27', '2025-02-02 06:19:27'),
(715, 'CL25-100865', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15203, 15005, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:27', '2025-02-02 06:19:27'),
(716, 'CL25-100866', 'NEXALUME COIL , ASTM  A - 792', '0.0161\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 13781, 13583, 'lbs', 'PORT NEW ORLEANS, LA, USA', 'JFE SHOJI AMERICA - PO30285', 'SOX24-24132', '2025-02-02 06:19:27', '2025-02-02 06:19:27'),
(717, 'G1L25102501', 'NEXALUME COIL, ASTM A-792, AFP', '0.0190\" NOM x 36.75\" AZ55 CS-B NEXALUME® Acrylic Coated AFP', 9164, 8966, 'lbs', 'PORT VANCOUVER BC, CANADA', 'THYSSENKRUPP MATERIALS TRADING CA. LTD.', 'SOX24-24115', '2025-02-03 03:03:25', '2025-02-03 03:03:25'),
(718, 'G1L25102502', 'NEXALUME COIL, ASTM A-792, AFP', '0.0190\" NOM x 36.75\" AZ55 CS-B NEXALUME® Acrylic Coated AFP', 9171, 8973, 'lbs', 'PORT VANCOUVER BC, CANADA', 'THYSSENKRUPP MATERIALS TRADING CA. LTD.', 'SOX24-24115', '2025-02-03 03:03:25', '2025-02-03 03:03:25'),
(719, 'G1L25102503', 'NEXALUME COIL, ASTM A-792, AFP', '0.0190\" NOM x 36.75\" AZ55 CS-B NEXALUME® Acrylic Coated AFP', 9173, 8975, 'lbs', 'PORT VANCOUVER BC, CANADA', 'THYSSENKRUPP MATERIALS TRADING CA. LTD.', 'SOX24-24115', '2025-02-03 03:03:25', '2025-02-03 03:03:25'),
(720, 'G1L25102493', 'NEXALUME COIL, ASTM A-792, AFP', '0.0190\" NOM x 36.75\" AZ55 CS-B NEXALUME® Acrylic Coated AFP', 9431, 9233, 'lbs', 'PORT VANCOUVER BC, CANADA', 'THYSSENKRUPP MATERIALS TRADING CA. LTD.', 'SOX24-24115', '2025-02-03 03:03:25', '2025-02-03 03:03:25'),
(721, 'G1L25102494', 'NEXALUME COIL, ASTM A-792, AFP', '0.0190\" NOM x 36.75\" AZ55 CS-B NEXALUME® Acrylic Coated AFP', 9433, 9235, 'lbs', 'PORT VANCOUVER BC, CANADA', 'THYSSENKRUPP MATERIALS TRADING CA. LTD.', 'SOX24-24115', '2025-02-03 03:03:25', '2025-02-03 03:03:25'),
(722, 'G1L25102495', 'NEXALUME COIL, ASTM A-792, AFP', '0.0190\" NOM x 36.75\" AZ55 CS-B NEXALUME® Acrylic Coated AFP', 9435, 9237, 'lbs', 'PORT VANCOUVER BC, CANADA', 'THYSSENKRUPP MATERIALS TRADING CA. LTD.', 'SOX24-24115', '2025-02-03 03:03:25', '2025-02-03 03:03:25'),
(723, 'G1L25102504', 'NEXALUME COIL, ASTM A-792, AFP', '0.0190\" NOM x 36.75\" AZ55 CS-B NEXALUME® Acrylic Coated AFP', 9495, 9297, 'lbs', 'PORT VANCOUVER BC, CANADA', 'THYSSENKRUPP MATERIALS TRADING CA. LTD.', 'SOX24-24115', '2025-02-03 03:03:25', '2025-02-03 03:03:25'),
(724, 'G1L25102496', 'NEXALUME COIL, ASTM A-792, AFP', '0.0190\" NOM x 36.75\" AZ55 CS-B NEXALUME® Acrylic Coated AFP', 9861, 9663, 'lbs', 'PORT VANCOUVER BC, CANADA', 'THYSSENKRUPP MATERIALS TRADING CA. LTD.', 'SOX24-24115', '2025-02-03 03:03:25', '2025-02-03 03:03:25'),
(725, 'G1L25102500', 'NEXALUME COIL, ASTM A-792, AFP', '0.0190\" NOM x 36.75\" AZ55 CS-B NEXALUME® Acrylic Coated AFP', 10350, 10152, 'lbs', 'PORT VANCOUVER BC, CANADA', 'THYSSENKRUPP MATERIALS TRADING CA. LTD.', 'SOX24-24115', '2025-02-03 03:03:25', '2025-02-03 03:03:25'),
(726, 'G1L25102497', 'NEXALUME COIL, ASTM A-792, AFP', '0.0190\" NOM x 36.75\" AZ55 CS-B NEXALUME® Acrylic Coated AFP', 10379, 10181, 'lbs', 'PORT VANCOUVER BC, CANADA', 'THYSSENKRUPP MATERIALS TRADING CA. LTD.', 'SOX24-24115', '2025-02-03 03:03:25', '2025-02-03 03:03:25'),
(727, 'G1L25102499', 'NEXALUME COIL, ASTM A-792, AFP', '0.0190\" NOM x 36.75\" AZ55 CS-B NEXALUME® Acrylic Coated AFP', 10381, 10183, 'lbs', 'PORT VANCOUVER BC, CANADA', 'THYSSENKRUPP MATERIALS TRADING CA. LTD.', 'SOX24-24115', '2025-02-03 03:03:25', '2025-02-03 03:03:25'),
(728, 'G1L25102498', 'NEXALUME COIL, ASTM A-792, AFP', '0.0190\" NOM x 36.75\" AZ55 CS-B NEXALUME® Acrylic Coated AFP', 10381, 10183, 'lbs', 'PORT VANCOUVER BC, CANADA', 'THYSSENKRUPP MATERIALS TRADING CA. LTD.', 'SOX24-24115', '2025-02-03 03:03:25', '2025-02-03 03:03:25');

-- --------------------------------------------------------

--
-- Table structure for table `shippmentc`
--

CREATE TABLE `shippmentc` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `atribute` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unicode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pod` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gros` int(11) NOT NULL,
  `net` int(11) NOT NULL,
  `satuan_berat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shippmentc`
--

INSERT INTO `shippmentc` (`id`, `atribute`, `unicode`, `pod`, `product`, `size`, `gros`, `net`, `satuan_berat`, `type`, `created_at`, `updated_at`) VALUES
(2, 'CL24-101002', 'CST / 240815CST101', 'PORT SAN JUAN, PUERTO RICO', 'NEXALUME ® COIL, ASTM A - 792', '0.46mm (TCT) x 1100MM AZ165 SS-50 NEXALUME® Acrylic Coated AFP', 4611, 4521, 'KGS', 'SOX24-24085', '2024-10-09 19:18:35', '2024-10-09 19:18:35'),
(3, 'CL24-108320', 'CST / 240815CST101', 'PORT SAN JUAN, PUERTO RICO', 'NEXALUME ® COIL, ASTM A - 792', '0.46mm (TCT) x 1100MM AZ165 SS-50 NEXALUME® Acrylic Coated AFP', 3964, 3874, 'KGS', 'SOX24-24085', '2024-10-09 19:18:35', '2024-10-09 19:18:35'),
(4, 'CL24-108297', 'CST / 240815CST101', 'PORT SAN JUAN, PUERTO RICO', 'NEXALUME ® COIL, ASTM A - 792', '0.46mm (TCT) x 1100MM AZ165 SS-50 NEXALUME® Acrylic Coated AFP', 3711, 3621, 'KGS', 'SOX24-24085', '2024-10-09 19:18:35', '2024-10-09 19:18:35'),
(5, 'CL24-108313', 'CST / 240815CST101', 'PORT SAN JUAN, PUERTO RICO', 'NEXALUME ® COIL, ASTM A - 792', '0.46mm (TCT) x 1100MM AZ165 SS-50 NEXALUME® Acrylic Coated AFP', 3760, 3670, 'KGS', 'SOX24-24085', '2024-10-09 19:18:35', '2024-10-09 19:18:35'),
(6, 'CL24-108299', 'CST / 240815CST101', 'PORT SAN JUAN, PUERTO RICO', 'NEXALUME ® COIL, ASTM A - 792', '0.46mm (TCT) x 1100MM AZ165 SS-50 NEXALUME® Acrylic Coated AFP', 3971, 3881, 'KGS', 'SOX24-24085', '2024-10-09 19:18:35', '2024-10-09 19:18:35'),
(7, 'CL24-108300', 'CST / 240815CST101', 'PORT SAN JUAN, PUERTO RICO', 'NEXALUME ® COIL, ASTM A - 792', '0.46mm (TCT) x 1100MM AZ165 SS-50 NEXALUME® Acrylic Coated AFP', 3968, 3878, 'KGS', 'SOX24-24085', '2024-10-09 19:18:35', '2024-10-09 19:18:35'),
(8, 'CL24-108303', 'CST / 240815CST101', 'PORT SAN JUAN, PUERTO RICO', 'NEXALUME ® COIL, ASTM A - 792', '0.46mm (TCT) x 1100MM AZ165 SS-50 NEXALUME® Acrylic Coated AFP', 2942, 2852, 'KGS', 'SOX24-24085', '2024-10-09 19:18:35', '2024-10-09 19:18:35'),
(9, 'CL24-108298', 'CST / 240815CST101', 'PORT SAN JUAN, PUERTO RICO', 'NEXALUME ® COIL, ASTM A - 792', '0.46mm (TCT) x 1100MM AZ165 SS-50 NEXALUME® Acrylic Coated AFP', 3967, 3877, 'KGS', 'SOX24-24085', '2024-10-09 19:18:35', '2024-10-09 19:18:35'),
(10, 'CL24-108302', 'CST / 240815CST101', 'PORT SAN JUAN, PUERTO RICO', 'NEXALUME ® COIL, ASTM A - 792', '0.46mm (TCT) x 1100MM AZ165 SS-50 NEXALUME® Acrylic Coated AFP', 3966, 3876, 'KGS', 'SOX24-24085', '2024-10-09 19:18:35', '2024-10-09 19:18:35'),
(11, 'CL24-108314', 'CST / 240815CST101', 'PORT SAN JUAN, PUERTO RICO', 'NEXALUME ® COIL, ASTM A - 792', '0.46mm (TCT) x 1100MM AZ165 SS-50 NEXALUME® Acrylic Coated AFP', 3605, 3515, 'KGS', 'SOX24-24085', '2024-10-09 19:18:35', '2024-10-09 19:18:35'),
(12, 'CL24-108292', 'CST / 240815CST101', 'PORT SAN JUAN, PUERTO RICO', 'NEXALUME ® COIL, ASTM A - 792', '0.46mm (TCT) x 1100MM AZ165 SS-50 NEXALUME® Acrylic Coated AFP', 3609, 3519, 'KGS', 'SOX24-24085', '2024-10-09 19:18:35', '2024-10-09 19:18:35'),
(13, 'CL24-108319', 'CST / 240815CST101', 'PORT SAN JUAN, PUERTO RICO', 'NEXALUME ® COIL, ASTM A - 792', '0.46mm (TCT) x 1100MM AZ165 SS-50 NEXALUME® Acrylic Coated AFP', 3962, 3872, 'KGS', 'SOX24-24085', '2024-10-09 19:18:35', '2024-10-09 19:18:35'),
(14, 'CL24-108318', 'CST / 240815CST101', 'PORT SAN JUAN, PUERTO RICO', 'NEXALUME ® COIL, ASTM A - 792', '0.46mm (TCT) x 1100MM AZ165 SS-50 NEXALUME® Acrylic Coated AFP', 3961, 3871, 'KGS', 'SOX24-24085', '2024-10-09 19:18:35', '2024-10-09 19:18:35'),
(15, 'CL24-108316', 'CST / 240815CST101', 'PORT SAN JUAN, PUERTO RICO', 'NEXALUME ® COIL, ASTM A - 792', '0.46mm (TCT) x 1100MM AZ165 SS-50 NEXALUME® Acrylic Coated AFP', 3961, 3871, 'KGS', 'SOX24-24085', '2024-10-09 19:18:35', '2024-10-09 19:18:35'),
(16, 'CL24-108317', 'CST / 240815CST101', 'PORT SAN JUAN, PUERTO RICO', 'NEXALUME ® COIL, ASTM A - 792', '0.46mm (TCT) x 1100MM AZ165 SS-50 NEXALUME® Acrylic Coated AFP', 3958, 3868, 'KGS', 'SOX24-24085', '2024-10-09 19:18:35', '2024-10-09 19:18:35'),
(17, 'CL24-108309', 'CST / 240815CST101', 'PORT SAN JUAN, PUERTO RICO', 'NEXALUME ® COIL, ASTM A - 792', '0.46mm (TCT) x 1100MM AZ165 SS-50 NEXALUME® Acrylic Coated AFP', 3861, 3771, 'KGS', 'SOX24-24085', '2024-10-09 19:18:35', '2024-10-09 19:18:35'),
(18, 'CL24-108288', 'CST / 240815CST101', 'PORT SAN JUAN, PUERTO RICO', 'NEXALUME ® COIL, ASTM A - 792', '0.46mm (TCT) x 1100MM AZ165 SS-50 NEXALUME® Acrylic Coated AFP', 3812, 3722, 'KGS', 'SOX24-24085', '2024-10-09 19:18:35', '2024-10-09 19:18:35'),
(19, 'CL24-108290', 'CST / 240815CST101', 'PORT SAN JUAN, PUERTO RICO', 'NEXALUME ® COIL, ASTM A - 792', '0.46mm (TCT) x 1100MM AZ165 SS-50 NEXALUME® Acrylic Coated AFP', 3810, 3720, 'KGS', 'SOX24-24085', '2024-10-09 19:18:35', '2024-10-09 19:18:35'),
(20, 'CL24-108286', 'CST / 240815CST101', 'PORT SAN JUAN, PUERTO RICO', 'NEXALUME ® COIL, ASTM A - 792', '0.46mm (TCT) x 1100MM AZ165 SS-50 NEXALUME® Acrylic Coated AFP', 3808, 3718, 'KGS', 'SOX24-24085', '2024-10-09 19:18:35', '2024-10-09 19:18:35'),
(21, 'CL24-108287', 'CST / 240815CST101', 'PORT SAN JUAN, PUERTO RICO', 'NEXALUME ® COIL, ASTM A - 792', '0.46mm (TCT) x 1100MM AZ165 SS-50 NEXALUME® Acrylic Coated AFP', 3805, 3715, 'KGS', 'SOX24-24085', '2024-10-09 19:18:35', '2024-10-09 19:18:35'),
(22, 'CL24-108310', 'CST / 240815CST101', 'PORT SAN JUAN, PUERTO RICO', 'NEXALUME ® COIL, ASTM A - 792', '0.46mm (TCT) x 1100MM AZ165 SS-50 NEXALUME® Acrylic Coated AFP', 4007, 3917, 'KGS', 'SOX24-24085', '2024-10-09 19:18:35', '2024-10-09 19:18:35'),
(23, 'CL24-108296', 'CST / 240815CST101', 'PORT SAN JUAN, PUERTO RICO', 'NEXALUME ® COIL, ASTM A - 792', '0.46mm (TCT) x 1100MM AZ165 SS-50 NEXALUME® Acrylic Coated AFP', 3612, 3522, 'KGS', 'SOX24-24085', '2024-10-09 19:18:35', '2024-10-09 19:18:35'),
(24, 'CL24-108293', 'CST / 240815CST101', 'PORT SAN JUAN, PUERTO RICO', 'NEXALUME ® COIL, ASTM A - 792', '0.46mm (TCT) x 1100MM AZ165 SS-50 NEXALUME® Acrylic Coated AFP', 3612, 3522, 'KGS', 'SOX24-24085', '2024-10-09 19:18:35', '2024-10-09 19:18:35'),
(25, 'CL24-108291', 'CST / 240815CST101', 'PORT SAN JUAN, PUERTO RICO', 'NEXALUME ® COIL, ASTM A - 792', '0.46mm (TCT) x 1100MM AZ165 SS-50 NEXALUME® Acrylic Coated AFP', 4012, 3922, 'KGS', 'SOX24-24085', '2024-10-09 19:18:35', '2024-10-09 19:18:35'),
(26, 'CL24-108312', 'CST / 240815CST101', 'PORT SAN JUAN, PUERTO RICO', 'NEXALUME ® COIL, ASTM A - 792', '0.46mm (TCT) x 1100MM AZ165 SS-50 NEXALUME® Acrylic Coated AFP', 4023, 3933, 'KGS', 'SOX24-24085', '2024-10-09 19:18:35', '2024-10-09 19:18:35'),
(27, 'CL24-108311', 'CST / 240815CST101', 'PORT SAN JUAN, PUERTO RICO', 'NEXALUME ® COIL, ASTM A - 792', '0.46mm (TCT) x 1100MM AZ165 SS-50 NEXALUME® Acrylic Coated AFP', 4024, 3934, 'KGS', 'SOX24-24085', '2024-10-09 19:18:35', '2024-10-09 19:18:35'),
(28, 'CL24-108315', 'CST / 240815CST101', 'PORT SAN JUAN, PUERTO RICO', 'NEXALUME ® COIL, ASTM A - 792', '0.46mm (TCT) x 1100MM AZ165 SS-50 NEXALUME® Acrylic Coated AFP', 3792, 3702, 'KGS', 'SOX24-24085', '2024-10-09 19:18:35', '2024-10-09 19:18:35'),
(29, 'CL24-108289', 'CST / 240815CST101', 'PORT SAN JUAN, PUERTO RICO', 'NEXALUME ® COIL, ASTM A - 792', '0.46mm (TCT) x 1100MM AZ165 SS-50 NEXALUME® Acrylic Coated AFP', 3814, 3724, 'KGS', 'SOX24-24085', '2024-10-09 19:18:35', '2024-10-09 19:18:35'),
(30, 'CL24-108295', 'CST / 240815CST101', 'PORT SAN JUAN, PUERTO RICO', 'NEXALUME ® COIL, ASTM A - 792', '0.46mm (TCT) x 1100MM AZ165 SS-50 NEXALUME® Acrylic Coated AFP', 3617, 3527, 'KGS', 'SOX24-24085', '2024-10-09 19:18:35', '2024-10-09 19:18:35'),
(31, 'CL24-108294', 'CST / 240815CST101', 'PORT SAN JUAN, PUERTO RICO', 'NEXALUME ® COIL, ASTM A - 792', '0.46mm (TCT) x 1100MM AZ165 SS-50 NEXALUME® Acrylic Coated AFP', 3616, 3526, 'KGS', 'SOX24-24085', '2024-10-09 19:18:35', '2024-10-09 19:18:35'),
(32, 'CL24-108321', 'CST / 240815CST101', 'PORT SAN JUAN, PUERTO RICO', 'NEXALUME ® COIL, ASTM A - 792', '0.46mm (TCT) x 1100MM AZ165 SS-50 NEXALUME® Acrylic Coated AFP', 3355, 3265, 'KGS', 'SOX24-24085', '2024-10-09 19:18:35', '2024-10-09 19:18:35'),
(33, 'CL24-108304', 'CST / 240815CST101', 'PORT SAN JUAN, PUERTO RICO', 'NEXALUME ® COIL, ASTM A - 792', '0.46mm (TCT) x 1100MM AZ165 SS-50 NEXALUME® Acrylic Coated AFP', 3601, 3511, 'KGS', 'SOX24-24085', '2024-10-09 19:18:35', '2024-10-09 19:18:35'),
(34, 'CL24-108305', 'CST / 240815CST101', 'PORT SAN JUAN, PUERTO RICO', 'NEXALUME ® COIL, ASTM A - 792', '0.46mm (TCT) x 1100MM AZ165 SS-50 NEXALUME® Acrylic Coated AFP', 3603, 3513, 'KGS', 'SOX24-24085', '2024-10-09 19:18:35', '2024-10-09 19:18:35'),
(35, 'CL24-108306', 'CST / 240815CST101', 'PORT SAN JUAN, PUERTO RICO', 'NEXALUME ® COIL, ASTM A - 792', '0.46mm (TCT) x 1100MM AZ165 SS-50 NEXALUME® Acrylic Coated AFP', 3603, 3513, 'KGS', 'SOX24-24085', '2024-10-09 19:18:35', '2024-10-09 19:18:35'),
(36, 'CL24-108307', 'CST / 240815CST101', 'PORT SAN JUAN, PUERTO RICO', 'NEXALUME ® COIL, ASTM A - 792', '0.46mm (TCT) x 1100MM AZ165 SS-50 NEXALUME® Acrylic Coated AFP', 3604, 3514, 'KGS', 'SOX24-24085', '2024-10-09 19:18:35', '2024-10-09 19:18:35'),
(37, 'CL24-108308', 'CST / 240815CST101', 'PORT SAN JUAN, PUERTO RICO', 'NEXALUME ® COIL, ASTM A - 792', '0.46mm (TCT) x 1100MM AZ165 SS-50 NEXALUME® Acrylic Coated AFP', 3605, 3515, 'KGS', 'SOX24-24085', '2024-10-09 19:18:35', '2024-10-09 19:18:35'),
(38, 'CL24-108301', 'CST / 240815CST101', 'PORT SAN JUAN, PUERTO RICO', 'NEXALUME ® COIL, ASTM A - 792', '0.46mm (TCT) x 1100MM AZ165 SS-50 NEXALUME® Acrylic Coated AFP', 3967, 3877, 'KGS', 'SOX24-24085', '2024-10-09 19:18:35', '2024-10-09 19:18:35'),
(39, 'CL24-108326', 'CST / 240815CST101', 'PORT SAN JUAN, PUERTO RICO', 'NEXALUME ® COIL, ASTM A - 792', '0.46mm (TCT) x 1100MM AZ165 SS-50 NEXALUME® Acrylic Coated AFP', 3722, 3632, 'KGS', 'SOX24-24085', '2024-10-09 19:18:35', '2024-10-09 19:18:35'),
(40, 'CL24-108322', 'CST / 240815CST101', 'PORT SAN JUAN, PUERTO RICO', 'NEXALUME ® COIL, ASTM A - 792', '0.46mm (TCT) x 1100MM AZ165 SS-50 NEXALUME® Acrylic Coated AFP', 3935, 3845, 'KGS', 'SOX24-24085', '2024-10-09 19:18:35', '2024-10-09 19:18:35'),
(41, 'CL24-108324', 'CST / 240815CST101', 'PORT SAN JUAN, PUERTO RICO', 'NEXALUME ® COIL, ASTM A - 792', '0.46mm (TCT) x 1100MM AZ165 SS-50 NEXALUME® Acrylic Coated AFP', 3839, 3749, 'KGS', 'SOX24-24085', '2024-10-09 19:18:35', '2024-10-09 19:18:35'),
(42, 'CL24-108325', 'CST / 240815CST101', 'PORT SAN JUAN, PUERTO RICO', 'NEXALUME ® COIL, ASTM A - 792', '0.46mm (TCT) x 1100MM AZ165 SS-50 NEXALUME® Acrylic Coated AFP', 3838, 3748, 'KGS', 'SOX24-24085', '2024-10-09 19:18:35', '2024-10-09 19:18:35'),
(43, 'CL24-108323', 'CST / 240815CST101', 'PORT SAN JUAN, PUERTO RICO', 'NEXALUME ® COIL, ASTM A - 792', '0.46mm (TCT) x 1100MM AZ165 SS-50 NEXALUME® Acrylic Coated AFP', 3837, 3747, 'KGS', 'SOX24-24085', '2024-10-09 19:18:35', '2024-10-09 19:18:35'),
(44, 'CL24-108327', 'CST / 240815CST101', 'PORT SAN JUAN, PUERTO RICO', 'NEXALUME ® COIL, ASTM A - 792', '0.46mm (TCT) x 1100MM AZ165 SS-50 NEXALUME® Acrylic Coated AFP', 3531, 3441, 'KGS', 'SOX24-24085', '2024-10-09 19:18:35', '2024-10-09 19:18:35'),
(45, 'CI24-109738', 'ECCO PO NO : 38-620451', 'PORT VANCOUVER BC, CANADA', 'NEXIUM ® COIL ASTM A-653', '0.0190\" NOM x 43.125\" G90 CS-B NEXIUM® PASSIVATION', 11622, 11424, 'LBS', 'SOX24-24083-1', '2024-10-23 12:12:33', '2024-10-23 12:12:33'),
(46, 'CI24-109739', 'ECCO PO NO : 38-620451', 'PORT VANCOUVER BC, CANADA', 'NEXIUM ® COIL ASTM A-653', '0.0190\" NOM x 43.125\" G90 CS-B NEXIUM® PASSIVATION', 11598, 11400, 'LBS', 'SOX24-24083-1', '2024-10-23 12:12:33', '2024-10-23 12:12:33'),
(47, 'CI24-109740', 'ECCO PO NO : 38-620451', 'PORT VANCOUVER BC, CANADA', 'NEXIUM ® COIL ASTM A-653', '0.0190\" NOM x 43.125\" G90 CS-B NEXIUM® PASSIVATION', 11611, 11413, 'LBS', 'SOX24-24083-1', '2024-10-23 12:12:33', '2024-10-23 12:12:33'),
(48, 'CI24-109743', 'ECCO PO NO : 38-620451', 'PORT VANCOUVER BC, CANADA', 'NEXIUM ® COIL ASTM A-653', '0.0190\" NOM x 43.125\" G90 CS-B NEXIUM® PASSIVATION', 11283, 11085, 'LBS', 'SOX24-24083-1', '2024-10-23 12:12:33', '2024-10-23 12:12:33'),
(49, 'CI24-109744', 'ECCO PO NO : 38-620451', 'PORT VANCOUVER BC, CANADA', 'NEXIUM ® COIL ASTM A-653', '0.0190\" NOM x 43.125\" G90 CS-B NEXIUM® PASSIVATION', 11309, 11111, 'LBS', 'SOX24-24083-1', '2024-10-23 12:12:33', '2024-10-23 12:12:33'),
(50, 'CI24-109745', 'ECCO PO NO : 38-620451', 'PORT VANCOUVER BC, CANADA', 'NEXIUM ® COIL ASTM A-653', '0.0190\" NOM x 43.125\" G90 CS-B NEXIUM® PASSIVATION', 11558, 11360, 'LBS', 'SOX24-24083-1', '2024-10-23 12:12:33', '2024-10-23 12:12:33'),
(51, 'CI24-109746', 'ECCO PO NO : 38-620451', 'PORT VANCOUVER BC, CANADA', 'NEXIUM ® COIL ASTM A-653', '0.0190\" NOM x 43.125\" G90 CS-B NEXIUM® PASSIVATION', 11468, 11270, 'LBS', 'SOX24-24083-1', '2024-10-23 12:12:33', '2024-10-23 12:12:33'),
(52, 'CI24-109747', 'ECCO PO NO : 38-620451', 'PORT VANCOUVER BC, CANADA', 'NEXIUM ® COIL ASTM A-653', '0.0190\" NOM x 43.125\" G90 CS-B NEXIUM® PASSIVATION', 11453, 11255, 'LBS', 'SOX24-24083-1', '2024-10-23 12:12:33', '2024-10-23 12:12:33'),
(53, 'CI24-109748', 'ECCO PO NO : 38-620451', 'PORT VANCOUVER BC, CANADA', 'NEXIUM ® COIL ASTM A-653', '0.0190\" NOM x 43.125\" G90 CS-B NEXIUM® PASSIVATION', 11468, 11270, 'LBS', 'SOX24-24083-1', '2024-10-23 12:12:33', '2024-10-23 12:12:33'),
(54, 'CI24-109750', 'ECCO PO NO : 38-620457', 'PORT VANCOUVER BC, CANADA', 'NEXIUM ® COIL ASTM A-653', '0.0210\" NOM x 48.000\" G90 CS-B NEXIUM® PASSIVATION', 13393, 13195, 'LBS', 'SOX24-24083-2', '2024-10-23 12:34:04', '2024-10-23 12:34:04'),
(55, 'CI24-109751', 'ECCO PO NO : 38-620457', 'PORT VANCOUVER BC, CANADA', 'NEXIUM ® COIL ASTM A-653', '0.0210\" NOM x 48.000\" G90 CS-B NEXIUM® PASSIVATION', 13430, 13232, 'LBS', 'SOX24-24083-2', '2024-10-23 12:34:04', '2024-10-23 12:34:04'),
(56, 'CI24-109752', 'ECCO PO NO : 38-620457', 'PORT VANCOUVER BC, CANADA', 'NEXIUM ® COIL ASTM A-653', '0.0210\" NOM x 48.000\" G90 CS-B NEXIUM® PASSIVATION', 13437, 13239, 'LBS', 'SOX24-24083-2', '2024-10-23 12:34:04', '2024-10-23 12:34:04'),
(57, 'CI24-109753', 'ECCO PO NO : 38-620457', 'PORT VANCOUVER BC, CANADA', 'NEXIUM ® COIL ASTM A-653', '0.0210\" NOM x 48.000\" G90 CS-B NEXIUM® PASSIVATION', 13730, 13532, 'LBS', 'SOX24-24083-2', '2024-10-23 12:34:04', '2024-10-23 12:34:04'),
(58, 'CI24-109754', 'ECCO PO NO : 38-620457', 'PORT VANCOUVER BC, CANADA', 'NEXIUM ® COIL ASTM A-653', '0.0210\" NOM x 48.000\" G90 CS-B NEXIUM® PASSIVATION', 13322, 13124, 'LBS', 'SOX24-24083-2', '2024-10-23 12:34:04', '2024-10-23 12:34:04'),
(59, 'CI24-109755', 'ECCO PO NO : 38-620457', 'PORT VANCOUVER BC, CANADA', 'NEXIUM ® COIL ASTM A-653', '0.0210\" NOM x 48.000\" G90 CS-B NEXIUM® PASSIVATION', 13335, 13137, 'LBS', 'SOX24-24083-2', '2024-10-23 12:34:04', '2024-10-23 12:34:04'),
(60, 'CI24-109756', 'ECCO PO NO : 38-620457', 'PORT VANCOUVER BC, CANADA', 'NEXIUM ® COIL ASTM A-653', '0.0210\" NOM x 48.000\" G90 CS-B NEXIUM® PASSIVATION', 13351, 13153, 'LBS', 'SOX24-24083-2', '2024-10-23 12:34:04', '2024-10-23 12:34:04'),
(61, 'CI24-109757', 'ECCO PO NO : 38-620457', 'PORT VANCOUVER BC, CANADA', 'NEXIUM ® COIL ASTM A-653', '0.0210\" NOM x 48.000\" G90 CS-B NEXIUM® PASSIVATION', 13532, 13334, 'LBS', 'SOX24-24083-2', '2024-10-23 12:34:04', '2024-10-23 12:34:04'),
(62, 'CI24-109758', 'ECCO PO NO : 38-620457', 'PORT VANCOUVER BC, CANADA', 'NEXIUM ® COIL ASTM A-653', '0.0210\" NOM x 48.000\" G90 CS-B NEXIUM® PASSIVATION', 13648, 13450, 'LBS', 'SOX24-24083-2', '2024-10-23 12:34:04', '2024-10-23 12:34:04'),
(63, 'CI24-109759', 'ECCO PO NO : 38-620457', 'PORT VANCOUVER BC, CANADA', 'NEXIUM ® COIL ASTM A-653', '0.0210\" NOM x 48.000\" G90 CS-B NEXIUM® PASSIVATION', 13629, 13431, 'LBS', 'SOX24-24083-2', '2024-10-23 12:34:04', '2024-10-23 12:34:04'),
(64, 'CI24-109760', 'ECCO PO NO : 38-620457', 'PORT VANCOUVER BC, CANADA', 'NEXIUM ® COIL ASTM A-653', '0.0210\" NOM x 48.000\" G90 CS-B NEXIUM® PASSIVATION', 13624, 13426, 'LBS', 'SOX24-24083-2', '2024-10-23 12:34:04', '2024-10-23 12:34:04'),
(65, 'CI24-109761', 'ECCO PO NO : 38-620457', 'PORT VANCOUVER BC, CANADA', 'NEXIUM ® COIL ASTM A-653', '0.0210\" NOM x 48.000\" G90 CS-B NEXIUM® PASSIVATION', 13545, 13347, 'LBS', 'SOX24-24083-2', '2024-10-23 12:34:04', '2024-10-23 12:34:04'),
(66, 'CI24-109762', 'ECCO PO NO : 38-620457', 'PORT VANCOUVER BC, CANADA', 'NEXIUM ® COIL ASTM A-653', '0.0210\" NOM x 48.000\" G90 CS-B NEXIUM® PASSIVATION', 13593, 13395, 'LBS', 'SOX24-24083-2', '2024-10-23 12:34:04', '2024-10-23 12:34:04'),
(67, 'CI24-109763', 'ECCO PO NO : 38-620457', 'PORT VANCOUVER BC, CANADA', 'NEXIUM ® COIL ASTM A-653', '0.0210\" NOM x 48.000\" G90 CS-B NEXIUM® PASSIVATION', 13518, 13320, 'LBS', 'SOX24-24083-2', '2024-10-23 12:34:04', '2024-10-27 15:12:03'),
(68, 'CI24-109764', 'ECCO PO NO : 38-620457', 'PORT VANCOUVER BC, CANADA', 'NEXIUM ® COIL ASTM A-653', '0.0210\" NOM x 48.000\" G90 CS-B NEXIUM® PASSIVATION', 13593, 13395, 'LBS', 'SOX24-24083-2', '2024-10-23 12:34:04', '2024-10-23 12:34:04'),
(69, 'CI24-109765', 'ECCO PO NO : 38-620457', 'PORT VANCOUVER BC, CANADA', 'NEXIUM ® COIL ASTM A-653', '0.0210\" NOM x 48.000\" G90 CS-B NEXIUM® PASSIVATION', 13470, 13272, 'LBS', 'SOX24-24083-2', '2024-10-23 12:34:04', '2024-10-23 12:34:04'),
(70, 'CI24-109766', 'ECCO PO NO : 38-620457', 'PORT VANCOUVER BC, CANADA', 'NEXIUM ® COIL ASTM A-653', '0.0210\" NOM x 48.000\" G90 CS-B NEXIUM® PASSIVATION', 13620, 13422, 'LBS', 'SOX24-24083-2', '2024-10-23 12:34:04', '2024-10-23 12:34:04'),
(71, 'CI24-109767', 'ECCO PO NO : 38-620457', 'PORT VANCOUVER BC, CANADA', 'NEXIUM ® COIL ASTM A-653', '0.0210\" NOM x 48.000\" G90 CS-B NEXIUM® PASSIVATION', 13633, 13435, 'LBS', 'SOX24-24083-2', '2024-10-23 12:34:04', '2024-10-23 12:34:04'),
(72, 'CI24-109768', 'ECCO PO NO : 38-620457', 'PORT VANCOUVER BC, CANADA', 'NEXIUM ® COIL ASTM A-653', '0.0210\" NOM x 48.000\" G90 CS-B NEXIUM® PASSIVATION', 13620, 13422, 'LBS', 'SOX24-24083-2', '2024-10-23 12:34:04', '2024-10-23 12:34:04'),
(73, 'CI24-109769', 'ECCO PO NO : 38-620457', 'PORT VANCOUVER BC, CANADA', 'NEXIUM ® COIL ASTM A-653', '0.0210\" NOM x 48.000\" G90 CS-B NEXIUM® PASSIVATION', 13587, 13389, 'LBS', 'SOX24-24083-2', '2024-10-23 12:34:04', '2024-10-23 12:34:04'),
(74, 'CI24-109780', 'ECCO PO NO : 38-620460', 'PORT VANCOUVER BC, CANADA', 'NEXIUM ® COIL ASTM A-653', '0.0210\" NOM x 36.000\" G90 CS-B NEXIUM® PASSIVATION', 14546, 14348, 'LBS', 'SOX24-24083-4', '2024-10-23 13:19:56', '2024-10-23 13:19:56'),
(75, 'CI24-109782', 'ECCO PO NO : 38-620460', 'PORT VANCOUVER BC, CANADA', 'NEXIUM ® COIL ASTM A-653', '0.0210\" NOM x 36.000\" G90 CS-B NEXIUM® PASSIVATION', 14737, 14539, 'LBS', 'SOX24-24083-4', '2024-10-23 13:19:56', '2024-10-23 13:19:56'),
(76, 'CI24-109783', 'ECCO PO NO : 38-620460', 'PORT VANCOUVER BC, CANADA', 'NEXIUM ® COIL ASTM A-653', '0.0210\" NOM x 36.000\" G90 CS-B NEXIUM® PASSIVATION', 14616, 14418, 'LBS', 'SOX24-24083-4', '2024-10-23 13:19:56', '2024-10-23 13:19:56'),
(77, 'CI24-109784', 'ECCO PO NO : 38-620460', 'PORT VANCOUVER BC, CANADA', 'NEXIUM ® COIL ASTM A-653', '0.0210\" NOM x 36.000\" G90 CS-B NEXIUM® PASSIVATION', 14610, 14412, 'LBS', 'SOX24-24083-4', '2024-10-23 13:19:56', '2024-10-23 13:19:56'),
(78, 'CI24-109785', 'ECCO PO NO : 38-620460', 'PORT VANCOUVER BC, CANADA', 'NEXIUM ® COIL ASTM A-653', '0.0210\" NOM x 36.000\" G90 CS-B NEXIUM® PASSIVATION', 15145, 14947, 'LBS', 'SOX24-24083-4', '2024-10-23 13:19:56', '2024-10-23 13:19:56'),
(79, 'CI24-109786', 'ECCO PO NO : 38-620460', 'PORT VANCOUVER BC, CANADA', 'NEXIUM ® COIL ASTM A-653', '0.0210\" NOM x 36.000\" G90 CS-B NEXIUM® PASSIVATION', 14272, 14074, 'LBS', 'SOX24-24083-4', '2024-10-23 13:19:56', '2024-10-23 13:19:56'),
(80, 'CI24-109787', 'ECCO PO NO : 38-620460', 'PORT VANCOUVER BC, CANADA', 'NEXIUM ® COIL ASTM A-653', '0.0210\" NOM x 36.000\" G90 CS-B NEXIUM® PASSIVATION', 14257, 14059, 'LBS', 'SOX24-24083-4', '2024-10-23 13:19:56', '2024-10-23 13:19:56'),
(81, 'CI24-109788', 'ECCO PO NO : 38-620460', 'PORT VANCOUVER BC, CANADA', 'NEXIUM ® COIL ASTM A-653', '0.0210\" NOM x 36.000\" G90 CS-B NEXIUM® PASSIVATION', 13829, 13631, 'LBS', 'SOX24-24083-4', '2024-10-23 13:19:56', '2024-10-23 13:19:56'),
(82, 'CI24-109771', 'ECCO PO NO : 38-620459', 'PORT VANCOUVER BC, CANADA', 'NEXIUM ® COIL ASTM A-653', '0.0210\" NOM x 37.750\" G90 CS-B NEXIUM® PASSIVATION', 11393, 11195, 'LBS', 'SOX24-24083-3', '2024-10-23 13:27:48', '2024-10-23 13:27:48'),
(83, 'CI24-109772', 'ECCO PO NO : 38-620459', 'PORT VANCOUVER BC, CANADA', 'NEXIUM ® COIL ASTM A-653', '0.0210\" NOM x 37.750\" G90 CS-B NEXIUM® PASSIVATION', 11400, 11202, 'LBS', 'SOX24-24083-3', '2024-10-23 13:27:48', '2024-10-23 13:27:48'),
(84, 'CI24-109773', 'ECCO PO NO : 38-620459', 'PORT VANCOUVER BC, CANADA', 'NEXIUM ® COIL ASTM A-653', '0.0210\" NOM x 37.750\" G90 CS-B NEXIUM® PASSIVATION', 11197, 10999, 'LBS', 'SOX24-24083-3', '2024-10-23 13:27:48', '2024-10-23 13:27:48'),
(85, 'CI24-109774', 'ECCO PO NO : 38-620459', 'PORT VANCOUVER BC, CANADA', 'NEXIUM ® COIL ASTM A-653', '0.0210\" NOM x 37.750\" G90 CS-B NEXIUM® PASSIVATION', 13543, 13345, 'LBS', 'SOX24-24083-3', '2024-10-23 13:27:48', '2024-10-23 13:27:48'),
(86, 'CI24-109775', 'ECCO PO NO : 38-620459', 'PORT VANCOUVER BC, CANADA', 'NEXIUM ® COIL ASTM A-653', '0.0210\" NOM x 37.750\" G90 CS-B NEXIUM® PASSIVATION', 13538, 13340, 'LBS', 'SOX24-24083-3', '2024-10-23 13:27:48', '2024-10-23 13:27:48'),
(87, 'CI24-109776', 'ECCO PO NO : 38-620459', 'PORT VANCOUVER BC, CANADA', 'NEXIUM ® COIL ASTM A-653', '0.0210\" NOM x 37.750\" G90 CS-B NEXIUM® PASSIVATION', 13181, 12983, 'LBS', 'SOX24-24083-3', '2024-10-23 13:27:48', '2024-10-23 13:27:48'),
(88, 'CI24-109777', 'ECCO PO NO : 38-620459', 'PORT VANCOUVER BC, CANADA', 'NEXIUM ® COIL ASTM A-653', '0.0210\" NOM x 37.750\" G90 CS-B NEXIUM® PASSIVATION', 15249, 15051, 'LBS', 'SOX24-24083-3', '2024-10-23 13:27:48', '2024-10-23 13:27:48'),
(89, 'CI24-109778', 'ECCO PO NO : 38-620459', 'PORT VANCOUVER BC, CANADA', 'NEXIUM ® COIL ASTM A-653', '0.0210\" NOM x 37.750\" G90 CS-B NEXIUM® PASSIVATION', 15253, 15055, 'LBS', 'SOX24-24083-3', '2024-10-23 13:27:48', '2024-10-23 13:27:48'),
(90, 'CI24-109779', 'ECCO PO NO : 38-620459', 'PORT VANCOUVER BC, CANADA', 'NEXIUM ® COIL ASTM A-653', '0.0210\" NOM x 37.750\" G90 CS-B NEXIUM® PASSIVATION', 14530, 14332, 'LBS', 'SOX24-24083-3', '2024-10-23 13:27:48', '2024-10-23 13:27:48'),
(91, 'CI24-109781', 'ECCO PO NO : 38-620460', 'PORT VANCOUVER BC, CANADA', 'NEXIUM ® COIL ASTM A-653', '0.0210\" NOM x 36.000\" G90 CS-B NEXIUM® PASSIVATION', 14526, 14328, 'LBS', 'SOX24-24083-4', '2024-10-23 18:43:09', '2024-10-23 18:43:09'),
(92, 'CI24-109789', 'ECCO PO NO : 38-620460', 'PORT VANCOUVER BC, CANADA', 'NEXIUM ® COIL ASTM A-653', '0.0210\" NOM x 36.000\" G90 CS-B NEXIUM® PASSIVATION', 14530, 14332, 'LBS', 'SOX24-24083-4', '2024-10-23 18:43:09', '2024-10-23 18:43:09'),
(93, 'CI24-109790', 'ECCO PO NO : 38-620460', 'PORT VANCOUVER BC, CANADA', 'NEXIUM ® COIL ASTM A-653', '0.0210\" NOM x 36.000\" G90 CS-B NEXIUM® PASSIVATION', 14577, 14379, 'LBS', 'SOX24-24083-4', '2024-10-23 18:43:09', '2024-10-23 18:43:09'),
(94, 'CI24-109791', 'ECCO PO NO : 38-620460', 'PORT VANCOUVER BC, CANADA', 'NEXIUM ® COIL ASTM A-653', '0.0210\" NOM x 36.000\" G90 CS-B NEXIUM® PASSIVATION', 14497, 14299, 'LBS', 'SOX24-24083-4', '2024-10-25 15:44:10', '2024-10-25 15:44:10'),
(95, 'CI24-111230', '21406', 'PORT VANCOUVER BC, CANADA', 'NEXIUM ® COIL, ASTM A-653, PASSIVATION', '0.0478\" NOM x 48.000\" G90 SS GR-33 NEXIUM® PASSIVATION', 8382, 8184, 'LBS', 'SOX24-24089', '2024-11-19 01:20:36', '2024-11-19 01:20:36'),
(96, 'CI24-111231', '21406', 'PORT VANCOUVER BC, CANADA', 'NEXIUM ® COIL, ASTM A-653, PASSIVATION', '0.0478\" NOM x 48.000\" G90 SS GR-33 NEXIUM® PASSIVATION', 8240, 8042, 'LBS', 'SOX24-24089', '2024-11-19 01:20:36', '2024-11-19 01:20:36'),
(97, 'CI24-111236', '21406', 'PORT VANCOUVER BC, CANADA', 'NEXIUM ® COIL, ASTM A-653, PASSIVATION', '0.0478\" NOM x 48.000\" G90 SS GR-33 NEXIUM® PASSIVATION', 10509, 10311, 'LBS', 'SOX24-24089', '2024-11-19 03:02:34', '2024-11-19 03:02:34'),
(98, 'G1L25101314', '247C0157J / 30124', 'PORT TAMPA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9305, 9107, 'lbs', 'SOX24-24129-1', '2025-01-20 03:01:04', '2025-01-20 03:01:04'),
(99, 'G1L25101315', '247C0157J / 30124', 'PORT TAMPA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9292, 9094, 'lbs', 'SOX24-24129-1', '2025-01-20 03:01:04', '2025-01-20 03:01:04'),
(100, 'G1L25101316', '247C0157J / 30124', 'PORT TAMPA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9307, 9109, 'lbs', 'SOX24-24129-1', '2025-01-20 03:01:04', '2025-01-20 03:01:04'),
(101, 'G1L25101317', '247C0157J / 30124', 'PORT TAMPA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9307, 9109, 'lbs', 'SOX24-24129-1', '2025-01-20 03:01:04', '2025-01-20 03:01:04'),
(102, 'G1L25101318', '247C0157J / 30124', 'PORT TAMPA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9116, 8918, 'lbs', 'SOX24-24129-1', '2025-01-20 03:01:04', '2025-01-20 03:01:04'),
(103, 'G1L25101319', '247C0157J / 30124', 'PORT TAMPA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9715, 9517, 'lbs', 'SOX24-24129-1', '2025-01-20 03:01:04', '2025-01-20 03:01:04'),
(104, 'G1L25101320', '247C0157J / 30124', 'PORT TAMPA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9715, 9517, 'lbs', 'SOX24-24129-1', '2025-01-20 03:01:04', '2025-01-20 03:01:04'),
(105, 'G1L25101321', '247C0157J / 30124', 'PORT TAMPA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9720, 9522, 'lbs', 'SOX24-24129-1', '2025-01-20 03:01:04', '2025-01-20 03:01:04'),
(106, 'G1L25101322', '247C0157J / 30124', 'PORT TAMPA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9689, 9491, 'lbs', 'SOX24-24129-1', '2025-01-20 03:01:04', '2025-01-20 03:01:04'),
(107, 'G1L25101323', '247C0157J / 30124', 'PORT TAMPA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 8761, 8563, 'lbs', 'SOX24-24129-1', '2025-01-20 03:01:04', '2025-01-20 03:01:04'),
(108, 'G1L25101393', '247C0173J / 1215', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.023\" MIN x 40.375\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 8064, 7866, 'lbs', 'SOX24-24133-2', '2025-01-20 03:33:48', '2025-01-20 03:33:48'),
(109, 'G1L25101394', '247C0173J / 1215', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.023\" MIN x 40.375\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 8080, 7882, 'lbs', 'SOX24-24133-2', '2025-01-20 03:33:48', '2025-01-20 03:33:48'),
(110, 'G1L25101395', '247C0173J / 1215', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.023\" MIN x 40.375\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 8084, 7886, 'lbs', 'SOX24-24133-2', '2025-01-20 03:33:48', '2025-01-20 03:33:48'),
(111, 'G1L25101396', '247C0173J / 1215', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.023\" MIN x 40.375\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 8075, 7877, 'lbs', 'SOX24-24133-2', '2025-01-20 03:33:48', '2025-01-20 03:33:48'),
(112, 'G1L25101397', '247C0173J / 1215', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.023\" MIN x 40.375\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 8604, 8406, 'lbs', 'SOX24-24133-2', '2025-01-20 03:33:48', '2025-01-20 03:33:48'),
(113, 'G1L25101398', '247C0173J / 1215', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.023\" MIN x 40.375\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 7531, 7333, 'lbs', 'SOX24-24133-2', '2025-01-20 03:33:48', '2025-01-20 03:33:48'),
(114, 'G1L25101399', '247C0173J / 1215', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.023\" MIN x 40.375\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 8095, 7897, 'lbs', 'SOX24-24133-2', '2025-01-20 03:33:48', '2025-01-20 03:33:48'),
(115, 'G1L25101400', '247C0173J / 1215', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.023\" MIN x 40.375\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 8106, 7908, 'lbs', 'SOX24-24133-2', '2025-01-20 03:33:48', '2025-01-20 03:33:48'),
(116, 'G1L25101401', '247C0173J / 1215', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.023\" MIN x 40.375\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 8099, 7901, 'lbs', 'SOX24-24133-2', '2025-01-20 03:33:48', '2025-01-20 03:33:48'),
(117, 'G1L25101402', '247C0173J / 1215', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.023\" MIN x 40.375\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 8066, 7868, 'lbs', 'SOX24-24133-2', '2025-01-20 03:33:48', '2025-01-20 03:33:48'),
(118, 'G1L25101428', '247C0173J / 1215', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.023\" MIN x 48.375\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 8781, 8583, 'lbs', 'SOX24-24133-3', '2025-01-20 03:48:41', '2025-01-20 03:48:41'),
(119, 'G1L25101429', '247C0173J / 1215', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.023\" MIN x 48.375\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 8776, 8578, 'lbs', 'SOX24-24133-3', '2025-01-20 03:48:41', '2025-01-20 03:48:41'),
(120, 'G1L25101430', '247C0173J / 1215', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.023\" MIN x 48.375\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 8778, 8580, 'lbs', 'SOX24-24133-3', '2025-01-20 03:48:41', '2025-01-20 03:48:41'),
(121, 'G1L25101431', '247C0173J / 1215', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.023\" MIN x 48.375\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 8778, 8580, 'lbs', 'SOX24-24133-3', '2025-01-20 03:48:41', '2025-01-20 03:48:41'),
(122, 'G1L25101432', '247C0173J / 1215', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.023\" MIN x 48.375\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 8774, 8576, 'lbs', 'SOX24-24133-3', '2025-01-20 03:48:41', '2025-01-20 03:48:41'),
(123, 'G1L25101433', '247C0173J / 1215', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.023\" MIN x 48.375\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 9281, 9083, 'lbs', 'SOX24-24133-3', '2025-01-20 03:48:41', '2025-01-20 03:48:41'),
(124, 'G1L25101434', '247C0173J / 1215', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.023\" MIN x 48.375\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 8033, 7835, 'lbs', 'SOX24-24133-3', '2025-01-20 03:48:41', '2025-01-20 03:48:41'),
(125, 'G1L25101435', '247C0173J / 1215', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.023\" MIN x 48.375\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 8044, 7846, 'lbs', 'SOX24-24133-3', '2025-01-20 03:48:41', '2025-01-20 03:48:41'),
(126, 'G1L25101436', '247C0173J / 1215', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.023\" MIN x 48.375\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 8051, 7853, 'lbs', 'SOX24-24133-3', '2025-01-20 03:48:41', '2025-01-20 03:48:41'),
(127, 'G1L25101437', '247C0173J / 1215', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.023\" MIN x 48.375\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 8057, 7859, 'lbs', 'SOX24-24133-3', '2025-01-20 03:48:41', '2025-01-20 03:48:41'),
(128, 'G1L25101438', '247C0173J / 1215', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.023\" MIN x 48.375\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 8005, 7807, 'lbs', 'SOX24-24133-3', '2025-01-20 03:48:41', '2025-01-20 03:48:41'),
(129, 'G1L25101439', '247C0173J / 1215', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.023\" MIN x 48.375\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 8622, 8424, 'lbs', 'SOX24-24133-3', '2025-01-20 03:48:41', '2025-01-20 03:48:41'),
(130, 'G1L25101440', '247C0173J / 1215', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.023\" MIN x 48.375\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 8624, 8426, 'lbs', 'SOX24-24133-3', '2025-01-20 03:48:41', '2025-01-20 03:48:41'),
(131, 'G1L25101441', '247C0173J / 1215', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.023\" MIN x 48.375\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 8626, 8428, 'lbs', 'SOX24-24133-3', '2025-01-20 03:48:41', '2025-01-20 03:48:41'),
(132, 'G1L25101442', '247C0173J / 1215', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.023\" MIN x 48.375\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 8615, 8417, 'lbs', 'SOX24-24133-3', '2025-01-20 03:48:41', '2025-01-20 03:48:41'),
(133, 'G1L25101443', '247C0173J / 1215', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.023\" MIN x 48.375\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 8622, 8424, 'lbs', 'SOX24-24133-3', '2025-01-20 03:48:41', '2025-01-20 03:48:41'),
(134, 'G1L25101444', '247C0173J / 1215', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.023\" MIN x 48.375\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 8688, 8490, 'lbs', 'SOX24-24133-3', '2025-01-20 03:48:41', '2025-01-20 03:48:41'),
(135, 'G1L25101825', '247C0160J / 30136', 'PORT TAMPA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15222, 15024, 'lbs', 'SOX24-24130-1', '2025-01-25 03:25:34', '2025-01-25 03:25:34'),
(136, 'G1L25101826', '247C0160J / 30136', 'PORT TAMPA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15229, 15031, 'lbs', 'SOX24-24130-1', '2025-01-25 03:25:34', '2025-01-25 03:25:34'),
(137, 'G1L25101827', '247C0160J / 30136', 'PORT TAMPA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15877, 15679, 'lbs', 'SOX24-24130-1', '2025-01-25 03:25:34', '2025-01-25 03:25:34'),
(138, 'G1L25101753', '247C0162J / 30138', 'PORT TAMPA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0185\" NOM x 41.5625\" AZ50 SS-50 CL2 NEXALUME® Skin Passed Chromated Oiled', 15619, 15421, 'lbs', 'SOX24-24130-3', '2025-01-25 03:25:34', '2025-01-25 03:25:34'),
(139, 'G1L25101754', '247C0162J / 30138', 'PORT TAMPA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0185\" NOM x 41.5625\" AZ50 SS-50 CL2 NEXALUME® Skin Passed Chromated Oiled', 15595, 15397, 'lbs', 'SOX24-24130-3', '2025-01-25 03:25:34', '2025-01-25 03:25:34'),
(140, 'G1L25101755', '247C0162J / 30138', 'PORT TAMPA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0185\" NOM x 41.5625\" AZ50 SS-50 CL2 NEXALUME® Skin Passed Chromated Oiled', 16001, 15803, 'lbs', 'SOX24-24130-3', '2025-01-25 03:25:34', '2025-01-25 03:25:34'),
(141, 'G1L25101788', '247C0185J / 163445', 'PORT NEW ORLEANS, LA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0153\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15397, 15199, 'lbs', 'SOX24-24144-2', '2025-01-25 04:20:40', '2025-01-25 04:20:40'),
(142, 'G1L25101789', '247C0185J / 163445', 'PORT NEW ORLEANS, LA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0153\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 9252, 9054, 'lbs', 'SOX24-24144-2', '2025-01-25 04:20:40', '2025-01-25 04:20:40'),
(143, 'G1L25101792', '247C0185J / 163445', 'PORT NEW ORLEANS, LA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0153\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 18351, 18153, 'lbs', 'SOX24-24144-2', '2025-01-25 04:20:40', '2025-01-25 04:20:40'),
(144, 'G1L25101793', '247C0185J / 163445', 'PORT NEW ORLEANS, LA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0153\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 18075, 17877, 'lbs', 'SOX24-24144-2', '2025-01-25 04:20:40', '2025-01-25 04:20:40'),
(145, 'G1L25101795', '247C0185J / 163445', 'PORT NEW ORLEANS, LA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0153\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 21898, 21700, 'lbs', 'SOX24-24144-2', '2025-01-25 04:20:40', '2025-01-25 04:20:40'),
(146, 'G1L25101796', '247C0185J / 163445', 'PORT NEW ORLEANS, LA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0153\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15507, 15309, 'lbs', 'SOX24-24144-2', '2025-01-25 04:20:40', '2025-01-25 04:20:40'),
(147, 'G1L25101797', '247C0185J / 163445', 'PORT NEW ORLEANS, LA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0153\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15489, 15291, 'lbs', 'SOX24-24144-2', '2025-01-25 04:20:40', '2025-01-25 04:20:40'),
(148, 'G1L25101798', '247C0185J / 163445', 'PORT NEW ORLEANS, LA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0153\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15509, 15311, 'lbs', 'SOX24-24144-2', '2025-01-25 04:20:40', '2025-01-25 04:20:40'),
(149, 'G1L25101799', '247C0185J / 163445', 'PORT NEW ORLEANS, LA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0153\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15348, 15150, 'lbs', 'SOX24-24144-2', '2025-01-25 04:20:40', '2025-01-25 04:20:40'),
(150, 'G1L25101800', '247C0185J / 163445', 'PORT NEW ORLEANS, LA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0153\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15350, 15152, 'lbs', 'SOX24-24144-2', '2025-01-25 04:20:40', '2025-01-25 04:20:40'),
(151, 'G1L25101801', '247C0185J / 163445', 'PORT NEW ORLEANS, LA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0153\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15253, 15055, 'lbs', 'SOX24-24144-2', '2025-01-25 04:20:40', '2025-01-25 04:20:40'),
(152, 'G1L25101803', '247C0185J / 163445', 'PORT NEW ORLEANS, LA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0153\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 14085, 13887, 'lbs', 'SOX24-24144-2', '2025-01-25 04:20:40', '2025-01-25 04:20:40'),
(153, 'G1L25101804', '247C0185J / 163445', 'PORT NEW ORLEANS, LA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0153\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 14107, 13909, 'lbs', 'SOX24-24144-2', '2025-01-25 04:20:40', '2025-01-25 04:20:40'),
(154, 'G1L25101805', '247C0185J / 163445', 'PORT NEW ORLEANS, LA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0153\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 14279, 14081, 'lbs', 'SOX24-24144-2', '2025-01-25 04:20:40', '2025-01-25 04:20:40'),
(155, 'G1L25101735', '247C0186J / 163445', 'PORT NEW ORLEANS, LA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0185\" NOM x 43.000\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15963, 15765, 'lbs', 'SOX24-24144-3', '2025-01-25 04:20:40', '2025-01-25 04:20:40'),
(156, 'G1L25101736', '247C0186J / 163445', 'PORT NEW ORLEANS, LA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0185\" NOM x 43.000\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15952, 15754, 'lbs', 'SOX24-24144-3', '2025-01-25 04:20:40', '2025-01-25 04:20:40'),
(157, 'G1L25101737', '247C0186J / 163445', 'PORT NEW ORLEANS, LA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0185\" NOM x 43.000\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15849, 15651, 'lbs', 'SOX24-24144-3', '2025-01-25 04:20:40', '2025-01-25 04:20:40'),
(158, 'G1L25101738', '247C0186J / 163445', 'PORT NEW ORLEANS, LA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0185\" NOM x 43.000\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15730, 15532, 'lbs', 'SOX24-24144-3', '2025-01-25 04:20:40', '2025-01-25 04:20:40'),
(159, 'G1L25101739', '247C0186J / 163445', 'PORT NEW ORLEANS, LA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0185\" NOM x 43.000\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15725, 15527, 'lbs', 'SOX24-24144-3', '2025-01-25 04:20:40', '2025-01-25 04:20:40'),
(160, 'G1L25101740', '247C0186J / 163445', 'PORT NEW ORLEANS, LA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0185\" NOM x 43.000\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15882, 15684, 'lbs', 'SOX24-24144-3', '2025-01-25 04:20:40', '2025-01-25 04:20:40'),
(161, 'G1L25101741', '247C0186J / 163445', 'PORT NEW ORLEANS, LA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0185\" NOM x 43.000\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 21455, 21257, 'lbs', 'SOX24-24144-3', '2025-01-25 04:20:40', '2025-01-25 04:20:40'),
(162, 'G1L25101742', '247C0186J / 163445', 'PORT NEW ORLEANS, LA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0185\" NOM x 43.000\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 21451, 21253, 'lbs', 'SOX24-24144-3', '2025-01-25 04:20:40', '2025-01-25 04:20:40'),
(163, 'G1L25101743', '247C0186J / 163445', 'PORT NEW ORLEANS, LA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0185\" NOM x 43.000\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 21779, 21581, 'lbs', 'SOX24-24144-3', '2025-01-25 04:20:40', '2025-01-25 04:20:40'),
(164, 'G1L25101744', '247C0186J / 163445', 'PORT NEW ORLEANS, LA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0185\" NOM x 43.000\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 21768, 21570, 'lbs', 'SOX24-24144-3', '2025-01-25 04:20:40', '2025-01-25 04:20:40'),
(165, 'G1L25101745', '247C0186J / 163445', 'PORT NEW ORLEANS, LA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0185\" NOM x 43.000\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 16267, 16069, 'lbs', 'SOX24-24144-3', '2025-01-25 04:20:40', '2025-01-25 04:20:40'),
(166, 'G1L25101746', '247C0186J / 163445', 'PORT NEW ORLEANS, LA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0185\" NOM x 43.000\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 16241, 16043, 'lbs', 'SOX24-24144-3', '2025-01-25 04:20:40', '2025-01-25 04:20:40'),
(167, 'G1L25101756', '247C0187J / 163445', 'PORT NEW ORLEANS, LA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0185\" NOM x 41.5625\" AZ50 SS-50 CL2 NEXALUME® Skin Passed Chromated Oiled', 15013, 14815, 'lbs', 'SOX24-24144-4', '2025-01-25 04:20:40', '2025-01-25 04:20:40'),
(168, 'G1L25101757', '247C0187J / 163445', 'PORT NEW ORLEANS, LA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0185\" NOM x 41.5625\" AZ50 SS-50 CL2 NEXALUME® Skin Passed Chromated Oiled', 15022, 14824, 'lbs', 'SOX24-24144-4', '2025-01-25 04:20:40', '2025-01-25 04:20:40'),
(169, 'G1L25101758', '247C0187J / 163445', 'PORT NEW ORLEANS, LA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0185\" NOM x 41.5625\" AZ50 SS-50 CL2 NEXALUME® Skin Passed Chromated Oiled', 15381, 15183, 'lbs', 'SOX24-24144-4', '2025-01-25 04:20:40', '2025-01-25 04:20:40'),
(170, 'G1L25101759', '247C0187J / 163445', 'PORT NEW ORLEANS, LA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0185\" NOM x 41.5625\" AZ50 SS-50 CL2 NEXALUME® Skin Passed Chromated Oiled', 20985, 20787, 'lbs', 'SOX24-24144-4', '2025-01-25 04:20:40', '2025-01-25 04:20:40'),
(171, 'G1L25101760', '247C0187J / 163445', 'PORT NEW ORLEANS, LA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0185\" NOM x 41.5625\" AZ50 SS-50 CL2 NEXALUME® Skin Passed Chromated Oiled', 20888, 20690, 'lbs', 'SOX24-24144-4', '2025-01-25 04:20:40', '2025-01-25 04:20:40'),
(172, 'G1L25101761', '247C0187J / 163445', 'PORT NEW ORLEANS, LA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0185\" NOM x 41.5625\" AZ50 SS-50 CL2 NEXALUME® Skin Passed Chromated Oiled', 17786, 17588, 'lbs', 'SOX24-24144-4', '2025-01-25 04:20:40', '2025-01-25 04:20:40'),
(173, 'G1L25101762', '247C0187J / 163445', 'PORT NEW ORLEANS, LA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0185\" NOM x 41.5625\" AZ50 SS-50 CL2 NEXALUME® Skin Passed Chromated Oiled', 18060, 17862, 'lbs', 'SOX24-24144-4', '2025-01-25 04:20:40', '2025-01-25 04:20:40'),
(174, 'G1L25101763', '247C0187J / 163445', 'PORT NEW ORLEANS, LA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0185\" NOM x 41.5625\" AZ50 SS-50 CL2 NEXALUME® Skin Passed Chromated Oiled', 15033, 14835, 'lbs', 'SOX24-24144-4', '2025-01-25 04:20:40', '2025-01-25 04:20:40'),
(175, 'G1L25101764', '247C0187J / 163445', 'PORT NEW ORLEANS, LA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0185\" NOM x 41.5625\" AZ50 SS-50 CL2 NEXALUME® Skin Passed Chromated Oiled', 15035, 14837, 'lbs', 'SOX24-24144-4', '2025-01-25 04:20:40', '2025-01-25 04:20:40'),
(176, 'G1L25101765', '247C0187J / 163445', 'PORT NEW ORLEANS, LA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0185\" NOM x 41.5625\" AZ50 SS-50 CL2 NEXALUME® Skin Passed Chromated Oiled', 15593, 15395, 'lbs', 'SOX24-24144-4', '2025-01-25 04:20:40', '2025-01-25 04:20:40'),
(177, 'G1L25101766', '247C0187J / 163445', 'PORT NEW ORLEANS, LA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0185\" NOM x 41.5625\" AZ50 SS-50 CL2 NEXALUME® Skin Passed Chromated Oiled', 15013, 14815, 'lbs', 'SOX24-24144-4', '2025-01-25 04:20:40', '2025-01-25 04:20:40'),
(178, 'G1L25101767', '247C0187J / 163445', 'PORT NEW ORLEANS, LA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0185\" NOM x 41.5625\" AZ50 SS-50 CL2 NEXALUME® Skin Passed Chromated Oiled', 15028, 14830, 'lbs', 'SOX24-24144-4', '2025-01-25 04:20:40', '2025-01-25 04:20:40'),
(179, 'G1L25101768', '247C0187J / 163445', 'PORT NEW ORLEANS, LA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0185\" NOM x 41.5625\" AZ50 SS-50 CL2 NEXALUME® Skin Passed Chromated Oiled', 15509, 15311, 'lbs', 'SOX24-24144-4', '2025-01-25 04:20:40', '2025-01-25 04:20:40'),
(203, 'G1L25102008', '247C0173J / 1215', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.023\" MIN x 40.375\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 8236, 8038, 'lbs', 'SOX24-24133-1', '2025-01-28 02:30:10', '2025-01-28 02:30:10'),
(204, 'G1L25102009', '247C0173J / 1215', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.023\" MIN x 40.375\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 8254, 8056, 'lbs', 'SOX24-24133-1', '2025-01-28 02:30:10', '2025-01-28 02:30:10'),
(205, 'G1L25102010', '247C0173J / 1215', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.023\" MIN x 40.375\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 8249, 8051, 'lbs', 'SOX24-24133-1', '2025-01-28 02:30:10', '2025-01-28 02:30:10'),
(206, 'G1L25102011', '247C0173J / 1215', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.023\" MIN x 40.375\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 8637, 8439, 'lbs', 'SOX24-24133-1', '2025-01-28 02:30:10', '2025-01-28 02:30:10'),
(207, 'G1L25102012', '247C0173J / 1215', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.023\" MIN x 40.375\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 9387, 9189, 'lbs', 'SOX24-24133-1', '2025-01-28 02:30:10', '2025-01-28 02:30:10'),
(208, 'G1L25102013', '247C0173J / 1215', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.023\" MIN x 40.375\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 9389, 9191, 'lbs', 'SOX24-24133-1', '2025-01-28 02:30:10', '2025-01-28 02:30:10'),
(209, 'G1L25102014', '247C0173J / 1215', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.023\" MIN x 40.375\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 9327, 9129, 'lbs', 'SOX24-24133-1', '2025-01-28 02:30:10', '2025-01-28 02:30:10'),
(210, 'G1L25102015', '247C0173J / 1215', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.018\" Min x 48.375\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 8688, 8490, 'lbs', 'SOX24-24133-1', '2025-01-28 02:30:10', '2025-01-28 02:30:10'),
(211, 'G1L25102016', '247C0173J / 1215', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.018\" Min x 48.375\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 8662, 8464, 'lbs', 'SOX24-24133-1', '2025-01-28 02:30:10', '2025-01-28 02:30:10'),
(212, 'G1L25102017', '247C0173J / 1215', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.018\" Min x 48.375\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 8662, 8464, 'lbs', 'SOX24-24133-1', '2025-01-28 02:30:10', '2025-01-28 02:30:10'),
(213, 'G1L25102018', '247C0173J / 1215', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.018\" Min x 48.375\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 8662, 8464, 'lbs', 'SOX24-24133-1', '2025-01-28 02:30:10', '2025-01-28 02:30:10'),
(214, 'G1L25102019', '247C0173J / 1215', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.018\" Min x 48.375\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 8653, 8455, 'lbs', 'SOX24-24133-1', '2025-01-28 02:30:10', '2025-01-28 02:30:10'),
(215, 'G1L25102020', '247C0173J / 1215', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.018\" Min x 48.375\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 8902, 8704, 'lbs', 'SOX24-24133-1', '2025-01-28 02:30:10', '2025-01-28 02:30:10'),
(216, 'G1L25102021', '247C0173J / 1215', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.018\" Min x 48.375\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 8470, 8272, 'lbs', 'SOX24-24133-1', '2025-01-28 02:30:10', '2025-01-28 02:30:10'),
(217, 'G1L25102022', '247C0173J / 1215', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.018\" Min x 48.375\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 8479, 8281, 'lbs', 'SOX24-24133-1', '2025-01-28 02:30:10', '2025-01-28 02:30:10'),
(218, 'G1L25102023', '247C0173J / 1215', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.018\" Min x 48.375\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 8472, 8274, 'lbs', 'SOX24-24133-1', '2025-01-28 02:30:10', '2025-01-28 02:30:10'),
(219, 'G1L25102024', '247C0173J / 1215', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.018\" Min x 48.375\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 8472, 8274, 'lbs', 'SOX24-24133-1', '2025-01-28 02:30:10', '2025-01-28 02:30:10'),
(220, 'G1L25102025', '247C0173J / 1215', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.018\" Min x 48.375\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 8470, 8272, 'lbs', 'SOX24-24133-1', '2025-01-28 02:30:10', '2025-01-28 02:30:10'),
(221, 'G1L25102026', '247C0173J / 1215', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.018\" Min x 48.375\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 8415, 8217, 'lbs', 'SOX24-24133-1', '2025-01-28 02:30:10', '2025-01-28 02:30:10'),
(222, 'G1L25102027', '247C0173J / 1215', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.018\" Min x 48.375\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 8556, 8358, 'lbs', 'SOX24-24133-1', '2025-01-28 02:30:10', '2025-01-28 02:30:10');
INSERT INTO `shippmentc` (`id`, `atribute`, `unicode`, `pod`, `product`, `size`, `gros`, `net`, `satuan_berat`, `type`, `created_at`, `updated_at`) VALUES
(223, 'G1L25102028', '247C0173J / 1215', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.018\" Min x 48.375\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 8569, 8371, 'lbs', 'SOX24-24133-1', '2025-01-28 02:30:10', '2025-01-28 02:30:10'),
(224, 'G1L25102029', '247C0173J / 1215', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.018\" Min x 48.375\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 8571, 8373, 'lbs', 'SOX24-24133-1', '2025-01-28 02:30:10', '2025-01-28 02:30:10'),
(225, 'G1L25102030', '247C0173J / 1215', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.018\" Min x 48.375\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 8190, 7992, 'lbs', 'SOX24-24133-1', '2025-01-28 02:30:10', '2025-01-28 02:30:10'),
(226, 'G1L25102034', 'SGT - 116526', 'PORT TAMPA, FL, USA', 'NEXALUME ® COIL, ASTM A-792', '0.0185\" NOM x 43.000\" AZ55 SS-80 CL1 NEXALUME® Acrylic Coated AFP', 7976, 7778, 'lbs', 'SOX24-24153-2', '2025-01-28 03:58:32', '2025-01-28 03:58:32'),
(227, 'G1L25102035', 'SGT - 116526', 'PORT TAMPA, FL, USA', 'NEXALUME ® COIL, ASTM A-792', '0.0185\" NOM x 43.000\" AZ55 SS-80 CL1 NEXALUME® Acrylic Coated AFP', 7839, 7641, 'lbs', 'SOX24-24153-2', '2025-01-28 03:58:32', '2025-01-28 03:58:32'),
(228, 'G1L25102036', 'SGT - 116526', 'PORT TAMPA, FL, USA', 'NEXALUME ® COIL, ASTM A-792', '0.0185\" NOM x 43.000\" AZ55 SS-80 CL1 NEXALUME® Acrylic Coated AFP', 9887, 9689, 'lbs', 'SOX24-24153-2', '2025-01-28 03:58:32', '2025-01-28 03:58:32'),
(229, 'G1L25102037', 'SGT - 116526', 'PORT TAMPA, FL, USA', 'NEXALUME ® COIL, ASTM A-792', '0.0185\" NOM x 43.000\" AZ55 SS-80 CL1 NEXALUME® Acrylic Coated AFP', 9903, 9705, 'lbs', 'SOX24-24153-2', '2025-01-28 03:58:32', '2025-01-28 03:58:32'),
(230, 'G1L25102038', 'SGT - 116526', 'PORT TAMPA, FL, USA', 'NEXALUME ® COIL, ASTM A-792', '0.0185\" NOM x 43.000\" AZ55 SS-80 CL1 NEXALUME® Acrylic Coated AFP', 9892, 9694, 'lbs', 'SOX24-24153-2', '2025-01-28 03:58:32', '2025-01-28 03:58:32'),
(231, 'G1L25102039', 'SGT - 116526', 'PORT TAMPA, FL, USA', 'NEXALUME ® COIL, ASTM A-792', '0.0185\" NOM x 43.000\" AZ55 SS-80 CL1 NEXALUME® Acrylic Coated AFP', 9894, 9696, 'lbs', 'SOX24-24153-2', '2025-01-28 03:58:32', '2025-01-28 03:58:32'),
(232, 'G1L25102040', 'SGT - 116526', 'PORT TAMPA, FL, USA', 'NEXALUME ® COIL, ASTM A-792', '0.0185\" NOM x 43.000\" AZ55 SS-80 CL1 NEXALUME® Acrylic Coated AFP', 9713, 9515, 'lbs', 'SOX24-24153-2', '2025-01-28 03:58:32', '2025-01-28 03:58:32'),
(233, 'G1L25102367', '247C0180J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 7625, 7427, 'lbs', 'SOX24-24143-1', '2025-02-01 01:40:22', '2025-02-01 01:40:22'),
(234, 'G1L25102368', '247C0180J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 7621, 7423, 'lbs', 'SOX24-24143-1', '2025-02-01 01:40:22', '2025-02-01 01:40:22'),
(235, 'G1L25102369', '247C0180J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 6228, 6030, 'lbs', 'SOX24-24143-1', '2025-02-01 01:40:22', '2025-02-01 01:40:22'),
(236, 'G1L25102371', '247C0180J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 8659, 8461, 'lbs', 'SOX24-24143-1', '2025-02-01 01:40:22', '2025-02-01 01:40:22'),
(237, 'G1L25102372', '247C0180J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 8657, 8459, 'lbs', 'SOX24-24143-1', '2025-02-01 01:40:22', '2025-02-01 01:40:22'),
(238, 'G1L25102373', '247C0180J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 8657, 8459, 'lbs', 'SOX24-24143-1', '2025-02-01 01:40:22', '2025-02-01 01:40:22'),
(239, 'G1L25102374', '247C0180J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 8657, 8459, 'lbs', 'SOX24-24143-1', '2025-02-01 01:40:22', '2025-02-01 01:40:22'),
(240, 'G1L25102375', '247C0180J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 8401, 8203, 'lbs', 'SOX24-24143-1', '2025-02-01 01:40:22', '2025-02-01 01:40:22'),
(241, 'G1L25102376', '247C0180J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9111, 8913, 'lbs', 'SOX24-24143-1', '2025-02-01 01:40:22', '2025-02-01 01:40:22'),
(242, 'G1L25102377', '247C0180J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 8950, 8752, 'lbs', 'SOX24-24143-1', '2025-02-01 01:40:22', '2025-02-01 01:40:22'),
(243, 'G1L25102378', '247C0180J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 8950, 8752, 'lbs', 'SOX24-24143-1', '2025-02-01 01:40:22', '2025-02-01 01:40:22'),
(244, 'G1L25102379', '247C0180J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 8944, 8746, 'lbs', 'SOX24-24143-1', '2025-02-01 01:40:22', '2025-02-01 01:40:22'),
(245, 'G1L25102380', '247C0180J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 8935, 8737, 'lbs', 'SOX24-24143-1', '2025-02-01 01:40:22', '2025-02-01 01:40:22'),
(246, 'G1L25102381', '247C0180J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9142, 8944, 'lbs', 'SOX24-24143-1', '2025-02-01 01:40:22', '2025-02-01 01:40:22'),
(247, 'G1L25102382', '247C0180J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9138, 8940, 'lbs', 'SOX24-24143-1', '2025-02-01 01:40:22', '2025-02-01 01:40:22'),
(248, 'G1L25102383', '247C0180J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9144, 8946, 'lbs', 'SOX24-24143-1', '2025-02-01 01:40:22', '2025-02-01 01:40:22'),
(249, 'G1L25102384', '247C0180J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9138, 8940, 'lbs', 'SOX24-24143-1', '2025-02-01 01:40:22', '2025-02-01 01:40:22'),
(250, 'G1L25102385', '247C0180J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 8986, 8788, 'lbs', 'SOX24-24143-1', '2025-02-01 01:40:22', '2025-02-01 01:40:22'),
(251, 'G1L25102386', '247C0180J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9495, 9297, 'lbs', 'SOX24-24143-1', '2025-02-01 01:40:22', '2025-02-01 01:40:22'),
(252, 'G1L25102387', '247C0180J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9490, 9292, 'lbs', 'SOX24-24143-1', '2025-02-01 01:40:22', '2025-02-01 01:40:22'),
(253, 'G1L25102388', '247C0180J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9493, 9295, 'lbs', 'SOX24-24143-1', '2025-02-01 01:40:22', '2025-02-01 01:40:22'),
(254, 'G1L25102389', '247C0180J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9493, 9295, 'lbs', 'SOX24-24143-1', '2025-02-01 01:40:22', '2025-02-01 01:40:22'),
(255, 'G1L25102390', '247C0180J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9422, 9224, 'lbs', 'SOX24-24143-1', '2025-02-01 01:40:23', '2025-02-01 01:40:23'),
(256, 'G1L25102391', '247C0180J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9605, 9407, 'lbs', 'SOX24-24143-1', '2025-02-01 01:40:23', '2025-02-01 01:40:23'),
(257, 'G1L25102392', '247C0180J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9610, 9412, 'lbs', 'SOX24-24143-1', '2025-02-01 01:40:23', '2025-02-01 01:40:23'),
(258, 'G1L25102393', '247C0180J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9601, 9403, 'lbs', 'SOX24-24143-1', '2025-02-01 01:40:23', '2025-02-01 01:40:23'),
(259, 'G1L25102394', '247C0180J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9607, 9409, 'lbs', 'SOX24-24143-1', '2025-02-01 01:40:23', '2025-02-01 01:40:23'),
(260, 'G1L25102395', '247C0180J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9435, 9237, 'lbs', 'SOX24-24143-1', '2025-02-01 01:40:23', '2025-02-01 01:40:23'),
(261, 'G1L25102396', '247C0180J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9607, 9409, 'lbs', 'SOX24-24143-1', '2025-02-01 01:40:23', '2025-02-01 01:40:23'),
(262, 'G1L25102397', '247C0180J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9612, 9414, 'lbs', 'SOX24-24143-1', '2025-02-01 01:40:23', '2025-02-01 01:40:23'),
(263, 'G1L25102398', '247C0180J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9598, 9400, 'lbs', 'SOX24-24143-1', '2025-02-01 01:40:23', '2025-02-01 01:40:23'),
(264, 'G1L25102399', '247C0180J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9598, 9400, 'lbs', 'SOX24-24143-1', '2025-02-01 01:40:23', '2025-02-01 01:40:23'),
(265, 'G1L25102400', '247C0180J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9557, 9359, 'lbs', 'SOX24-24143-1', '2025-02-01 01:40:23', '2025-02-01 01:40:23'),
(266, 'G1L25102401', '247C0180J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9391, 9193, 'lbs', 'SOX24-24143-1', '2025-02-01 01:40:23', '2025-02-01 01:40:23'),
(267, 'G1L25102402', '247C0180J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9400, 9202, 'lbs', 'SOX24-24143-1', '2025-02-01 01:40:23', '2025-02-01 01:40:23'),
(268, 'G1L25102403', '247C0180J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9387, 9189, 'lbs', 'SOX24-24143-1', '2025-02-01 01:40:23', '2025-02-01 01:40:23'),
(269, 'G1L25102404', '247C0180J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9393, 9195, 'lbs', 'SOX24-24143-1', '2025-02-01 01:40:23', '2025-02-01 01:40:23'),
(270, 'G1L25102405', '247C0180J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9473, 9275, 'lbs', 'SOX24-24143-1', '2025-02-01 01:40:23', '2025-02-01 01:40:23'),
(271, 'G1L25102406', '247C0180J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9299, 9101, 'lbs', 'SOX24-24143-1', '2025-02-01 01:40:23', '2025-02-01 01:40:23'),
(272, 'G1L25102407', '247C0180J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9303, 9105, 'lbs', 'SOX24-24143-1', '2025-02-01 01:40:23', '2025-02-01 01:40:23'),
(273, 'G1L25102408', '247C0180J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9294, 9096, 'lbs', 'SOX24-24143-1', '2025-02-01 01:40:23', '2025-02-01 01:40:23'),
(274, 'G1L25102409', '247C0180J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9307, 9109, 'lbs', 'SOX24-24143-1', '2025-02-01 01:40:23', '2025-02-01 01:40:23'),
(275, 'G1L25102410', '247C0180J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9343, 9145, 'lbs', 'SOX24-24143-1', '2025-02-01 01:40:23', '2025-02-01 01:40:23'),
(276, 'G1L25102411', '247C0180J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9301, 9103, 'lbs', 'SOX24-24143-1', '2025-02-01 01:40:23', '2025-02-01 01:40:23'),
(277, 'G1L25102412', '247C0180J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9274, 9076, 'lbs', 'SOX24-24143-1', '2025-02-01 01:40:23', '2025-02-01 01:40:23'),
(278, 'G1L25102413', '247C0180J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9283, 9085, 'lbs', 'SOX24-24143-1', '2025-02-01 01:40:23', '2025-02-01 01:40:23'),
(279, 'G1L25102414', '247C0180J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9285, 9087, 'lbs', 'SOX24-24143-1', '2025-02-01 01:40:23', '2025-02-01 01:40:23'),
(280, 'G1L25102415', '247C0180J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9497, 9299, 'lbs', 'SOX24-24143-1', '2025-02-01 01:40:23', '2025-02-01 01:40:23'),
(281, 'G1L25102416', '247C0180J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9451, 9253, 'lbs', 'SOX24-24143-1', '2025-02-01 01:40:23', '2025-02-01 01:40:23'),
(282, 'G1L25102417', '247C0180J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9453, 9255, 'lbs', 'SOX24-24143-1', '2025-02-01 01:40:23', '2025-02-01 01:40:23'),
(283, 'G1L25102418', '247C0180J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9446, 9248, 'lbs', 'SOX24-24143-1', '2025-02-01 01:40:23', '2025-02-01 01:40:23'),
(284, 'G1L25102419', '247C0180J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9457, 9259, 'lbs', 'SOX24-24143-1', '2025-02-01 01:40:23', '2025-02-01 01:40:23'),
(285, 'G1L25102420', '247C0180J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9321, 9123, 'lbs', 'SOX24-24143-1', '2025-02-01 01:40:23', '2025-02-01 01:40:23'),
(286, 'G1L25102421', '247C0180J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9429, 9231, 'lbs', 'SOX24-24143-1', '2025-02-01 01:40:23', '2025-02-01 01:40:23'),
(287, 'G1L25102422', '247C0180J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9420, 9222, 'lbs', 'SOX24-24143-1', '2025-02-01 01:40:23', '2025-02-01 01:40:23'),
(288, 'G1L25102423', '247C0180J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9431, 9233, 'lbs', 'SOX24-24143-1', '2025-02-01 01:40:23', '2025-02-01 01:40:23'),
(289, 'G1L25102424', '247C0180J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9449, 9251, 'lbs', 'SOX24-24143-1', '2025-02-01 01:40:23', '2025-02-01 01:40:23'),
(290, 'G1L25102425', '247C0180J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9585, 9387, 'lbs', 'SOX24-24143-1', '2025-02-01 01:40:23', '2025-02-01 01:40:23'),
(291, 'G1L25102426', '247C0180J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9451, 9253, 'lbs', 'SOX24-24143-1', '2025-02-01 01:40:23', '2025-02-01 01:40:23'),
(292, 'G1L25102427', '247C0180J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9446, 9248, 'lbs', 'SOX24-24143-1', '2025-02-01 01:40:23', '2025-02-01 01:40:23'),
(293, 'G1L25102428', '247C0180J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 7021, 6823, 'lbs', 'SOX24-24143-1', '2025-02-01 01:40:23', '2025-02-01 01:40:23'),
(294, 'G1L25102086', 'SGT - 116526', 'PORT TAMPA, FL, USA', 'NEXALUME ® COIL, ASTM A-792', '0.0145\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9654, 9456, 'lbs', 'SOX24-24153-1', '2025-02-01 02:27:37', '2025-02-01 02:27:37'),
(295, 'G1L25102087', 'SGT - 116526', 'PORT TAMPA, FL, USA', 'NEXALUME ® COIL, ASTM A-792', '0.0145\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9638, 9440, 'lbs', 'SOX24-24153-1', '2025-02-01 02:27:37', '2025-02-01 02:27:37'),
(296, 'G1L25102088', 'SGT - 116526', 'PORT TAMPA, FL, USA', 'NEXALUME ® COIL, ASTM A-792', '0.0145\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9636, 9438, 'lbs', 'SOX24-24153-1', '2025-02-01 02:27:37', '2025-02-01 02:27:37'),
(297, 'G1L25102089', 'SGT - 116526', 'PORT TAMPA, FL, USA', 'NEXALUME ® COIL, ASTM A-792', '0.0145\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9627, 9429, 'lbs', 'SOX24-24153-1', '2025-02-01 02:27:37', '2025-02-01 02:27:37'),
(298, 'G1L25102090', 'SGT - 116526', 'PORT TAMPA, FL, USA', 'NEXALUME ® COIL, ASTM A-792', '0.0145\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9365, 9167, 'lbs', 'SOX24-24153-1', '2025-02-01 02:27:37', '2025-02-01 02:27:37'),
(299, 'G1L25102091', 'SGT - 116526', 'PORT TAMPA, FL, USA', 'NEXALUME ® COIL, ASTM A-792', '0.0145\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9435, 9237, 'lbs', 'SOX24-24153-1', '2025-02-01 02:27:37', '2025-02-01 02:27:37'),
(300, 'G1L25102092', 'SGT - 116526', 'PORT TAMPA, FL, USA', 'NEXALUME ® COIL, ASTM A-792', '0.0145\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9446, 9248, 'lbs', 'SOX24-24153-1', '2025-02-01 02:27:37', '2025-02-01 02:27:37'),
(301, 'G1L25102094', 'SGT - 116526', 'PORT TAMPA, FL, USA', 'NEXALUME ® COIL, ASTM A-792', '0.0145\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9435, 9237, 'lbs', 'SOX24-24153-1', '2025-02-01 02:27:37', '2025-02-01 02:27:37'),
(302, 'G1L25102095', 'SGT - 116526', 'PORT TAMPA, FL, USA', 'NEXALUME ® COIL, ASTM A-792', '0.0145\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9354, 9156, 'lbs', 'SOX24-24153-1', '2025-02-01 02:27:37', '2025-02-01 02:27:37'),
(303, 'G1L25102096', 'SGT - 116526', 'PORT TAMPA, FL, USA', 'NEXALUME ® COIL, ASTM A-792', '0.0145\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9338, 9140, 'lbs', 'SOX24-24153-1', '2025-02-01 02:27:37', '2025-02-01 02:27:37'),
(304, 'G1L25102097', 'SGT - 116526', 'PORT TAMPA, FL, USA', 'NEXALUME ® COIL, ASTM A-792', '0.0145\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9336, 9138, 'lbs', 'SOX24-24153-1', '2025-02-01 02:27:37', '2025-02-01 02:27:37'),
(305, 'G1L25102098', 'SGT - 116526', 'PORT TAMPA, FL, USA', 'NEXALUME ® COIL, ASTM A-792', '0.0145\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9349, 9151, 'lbs', 'SOX24-24153-1', '2025-02-01 02:27:37', '2025-02-01 02:27:37'),
(306, 'G1L25102099', 'SGT - 116526', 'PORT TAMPA, FL, USA', 'NEXALUME ® COIL, ASTM A-792', '0.0145\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9343, 9145, 'lbs', 'SOX24-24153-1', '2025-02-01 02:27:37', '2025-02-01 02:27:37'),
(307, 'G1L25102100', 'SGT - 116526', 'PORT TAMPA, FL, USA', 'NEXALUME ® COIL, ASTM A-792', '0.0145\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9120, 8922, 'lbs', 'SOX24-24153-1', '2025-02-01 02:27:37', '2025-02-01 02:27:37'),
(308, 'G1L25102101', 'SGT - 116526', 'PORT TAMPA, FL, USA', 'NEXALUME ® COIL, ASTM A-792', '0.0145\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9501, 9303, 'lbs', 'SOX24-24153-1', '2025-02-01 02:27:37', '2025-02-01 02:27:37'),
(309, 'G1L25102102', 'SGT - 116526', 'PORT TAMPA, FL, USA', 'NEXALUME ® COIL, ASTM A-792', '0.0145\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9504, 9306, 'lbs', 'SOX24-24153-1', '2025-02-01 02:27:37', '2025-02-01 02:27:37'),
(310, 'G1L25102103', 'SGT - 116526', 'PORT TAMPA, FL, USA', 'NEXALUME ® COIL, ASTM A-792', '0.0145\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9504, 9306, 'lbs', 'SOX24-24153-1', '2025-02-01 02:27:37', '2025-02-01 02:27:37'),
(311, 'G1L25102104', 'SGT - 116526', 'PORT TAMPA, FL, USA', 'NEXALUME ® COIL, ASTM A-792', '0.0145\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9517, 9319, 'lbs', 'SOX24-24153-1', '2025-02-01 02:27:37', '2025-02-01 02:27:37'),
(312, 'G1L25102093', 'SGT - 116526', 'PORT TAMPA, FL, USA', 'NEXALUME ® COIL, ASTM A-792', '0.0145\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9438, 9240, 'lbs', 'SOX24-24153-1', '2025-02-01 02:27:37', '2025-02-01 02:27:37'),
(313, 'G1L25102105', 'SGT - 116526', 'PORT TAMPA, FL, USA', 'NEXALUME ® COIL, ASTM A-792', '0.0145\" NOM x 40.875\" AZ55 SS-80 NEXALUME® Acrylic Coated AFP', 9552, 9354, 'lbs', 'SOX24-24153-1', '2025-02-01 02:27:37', '2025-02-01 02:27:37'),
(314, 'G1L25102505', '247C0181J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0185\" NOM x 41.5625\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 9003, 8805, 'lbs', 'SOX24-24143-2', '2025-02-03 05:39:15', '2025-02-03 05:39:15'),
(315, 'G1L25102506', '247C0181J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0185\" NOM x 41.5625\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 9019, 8821, 'lbs', 'SOX24-24143-2', '2025-02-03 05:39:15', '2025-02-03 05:39:15'),
(316, 'G1L25102507', '247C0181J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0185\" NOM x 41.5625\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 9023, 8825, 'lbs', 'SOX24-24143-2', '2025-02-03 05:39:15', '2025-02-03 05:39:15'),
(317, 'G1L25102508', '247C0181J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0185\" NOM x 41.5625\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 9023, 8825, 'lbs', 'SOX24-24143-2', '2025-02-03 05:39:15', '2025-02-03 05:39:15'),
(318, 'G1L25102509', '247C0181J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0185\" NOM x 41.5625\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 9460, 9262, 'lbs', 'SOX24-24143-2', '2025-02-03 05:39:15', '2025-02-03 05:39:15'),
(319, 'G1L25102510', '247C0181J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0185\" NOM x 41.5625\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 8957, 8759, 'lbs', 'SOX24-24143-2', '2025-02-03 05:39:15', '2025-02-03 05:39:15'),
(320, 'G1L25102511', '247C0181J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0185\" NOM x 41.5625\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 8948, 8750, 'lbs', 'SOX24-24143-2', '2025-02-03 05:39:15', '2025-02-03 05:39:15'),
(321, 'G1L25102512', '247C0181J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0185\" NOM x 41.5625\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 8972, 8774, 'lbs', 'SOX24-24143-2', '2025-02-03 05:39:15', '2025-02-03 05:39:15'),
(322, 'G1L25102513', '247C0181J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0185\" NOM x 41.5625\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 8968, 8770, 'lbs', 'SOX24-24143-2', '2025-02-03 05:39:15', '2025-02-03 05:39:15'),
(323, 'G1L25102514', '247C0181J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0185\" NOM x 41.5625\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 9371, 9173, 'lbs', 'SOX24-24143-2', '2025-02-03 05:39:15', '2025-02-03 05:39:15'),
(324, 'G1L25102515', '247C0181J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0185\" NOM x 41.5625\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 8957, 8759, 'lbs', 'SOX24-24143-2', '2025-02-03 05:39:15', '2025-02-03 05:39:15'),
(325, 'G1L25102516', '247C0181J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0185\" NOM x 41.5625\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 8957, 8759, 'lbs', 'SOX24-24143-2', '2025-02-03 05:39:15', '2025-02-03 05:39:15'),
(326, 'G1L25102517', '247C0181J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0185\" NOM x 41.5625\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 8959, 8761, 'lbs', 'SOX24-24143-2', '2025-02-03 05:39:15', '2025-02-03 05:39:15'),
(327, 'G1L25102518', '247C0181J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0185\" NOM x 41.5625\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 8959, 8761, 'lbs', 'SOX24-24143-2', '2025-02-03 05:39:15', '2025-02-03 05:39:15'),
(328, 'G1L25102519', '247C0181J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0185\" NOM x 41.5625\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 9129, 8931, 'lbs', 'SOX24-24143-2', '2025-02-03 05:39:15', '2025-02-03 05:39:15'),
(329, 'G1L25102520', '247C0181J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0185\" NOM x 41.5625\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 9250, 9052, 'lbs', 'SOX24-24143-2', '2025-02-03 05:39:15', '2025-02-03 05:39:15'),
(330, 'G1L25102521', '247C0181J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0185\" NOM x 41.5625\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 9257, 9059, 'lbs', 'SOX24-24143-2', '2025-02-03 05:39:15', '2025-02-03 05:39:15'),
(331, 'G1L25102522', '247C0181J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0185\" NOM x 41.5625\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 9248, 9050, 'lbs', 'SOX24-24143-2', '2025-02-03 05:39:15', '2025-02-03 05:39:15'),
(332, 'G1L25102523', '247C0181J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0185\" NOM x 41.5625\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 9244, 9046, 'lbs', 'SOX24-24143-2', '2025-02-03 05:39:15', '2025-02-03 05:39:15'),
(333, 'G1L25102524', '247C0181J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0185\" NOM x 41.5625\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 8915, 8717, 'lbs', 'SOX24-24143-2', '2025-02-03 05:39:15', '2025-02-03 05:39:15'),
(334, 'G1L25102525', '247C0181J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0185\" NOM x 41.5625\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 8955, 8757, 'lbs', 'SOX24-24143-2', '2025-02-03 05:39:15', '2025-02-03 05:39:15'),
(335, 'G1L25102526', '247C0181J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0185\" NOM x 41.5625\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 8970, 8772, 'lbs', 'SOX24-24143-2', '2025-02-03 05:39:15', '2025-02-03 05:39:15'),
(336, 'G1L25102527', '247C0181J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0185\" NOM x 41.5625\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 8966, 8768, 'lbs', 'SOX24-24143-2', '2025-02-03 05:39:15', '2025-02-03 05:39:15'),
(337, 'G1L25102528', '247C0181J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0185\" NOM x 41.5625\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 8955, 8757, 'lbs', 'SOX24-24143-2', '2025-02-03 05:39:15', '2025-02-03 05:39:15'),
(338, 'G1L25102529', '247C0181J / 163443', 'PORT TAMPA, FL, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0185\" NOM x 41.5625\" AZ55 SS-50 CL2 NEXALUME® Acrylic Coated AFP', 9043, 8845, 'lbs', 'SOX24-24143-2', '2025-02-03 05:39:15', '2025-02-03 05:39:15'),
(339, 'G1L25102659', '247C0184J / 163445', 'PORT NEW ORLEANS, LA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15207, 15009, 'lbs', 'SOX24-24144-1', '2025-02-05 02:17:13', '2025-02-05 02:17:13'),
(340, 'G1L25102660', '247C0184J / 163445', 'PORT NEW ORLEANS, LA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15192, 14994, 'lbs', 'SOX24-24144-1', '2025-02-05 02:17:13', '2025-02-05 02:17:13'),
(341, 'G1L25102661', '247C0184J / 163445', 'PORT NEW ORLEANS, LA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15119, 14921, 'lbs', 'SOX24-24144-1', '2025-02-05 02:17:13', '2025-02-05 02:17:13'),
(342, 'G1L25102662', '247C0184J / 163445', 'PORT NEW ORLEANS, LA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 6338, 6140, 'lbs', 'SOX24-24144-1', '2025-02-05 02:17:13', '2025-02-05 02:17:13'),
(343, 'G1L25102663', '247C0184J / 163445', 'PORT NEW ORLEANS, LA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 20126, 19928, 'lbs', 'SOX24-24144-1', '2025-02-05 02:17:13', '2025-02-05 02:17:13'),
(344, 'G1L25102664', '247C0184J / 163445', 'PORT NEW ORLEANS, LA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 20176, 19978, 'lbs', 'SOX24-24144-1', '2025-02-05 02:17:13', '2025-02-05 02:17:13'),
(345, 'G1L25102665', '247C0184J / 163445', 'PORT NEW ORLEANS, LA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15375, 15177, 'lbs', 'SOX24-24144-1', '2025-02-05 02:17:13', '2025-02-05 02:17:13'),
(346, 'G1L25102666', '247C0184J / 163445', 'PORT NEW ORLEANS, LA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15375, 15177, 'lbs', 'SOX24-24144-1', '2025-02-05 02:17:13', '2025-02-05 02:17:13'),
(347, 'G1L25102667', '247C0184J / 163445', 'PORT NEW ORLEANS, LA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15218, 15020, 'lbs', 'SOX24-24144-1', '2025-02-05 02:17:13', '2025-02-05 02:17:13'),
(348, 'G1L25102668', '247C0184J / 163445', 'PORT NEW ORLEANS, LA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15465, 15267, 'lbs', 'SOX24-24144-1', '2025-02-05 02:17:13', '2025-02-05 02:17:13'),
(349, 'G1L25102669', '247C0184J / 163445', 'PORT NEW ORLEANS, LA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15469, 15271, 'lbs', 'SOX24-24144-1', '2025-02-05 02:17:13', '2025-02-05 02:17:13'),
(350, 'G1L25102670', '247C0184J / 163445', 'PORT NEW ORLEANS, LA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15461, 15263, 'lbs', 'SOX24-24144-1', '2025-02-05 02:17:13', '2025-02-05 02:17:13'),
(351, 'G1L25102671', '247C0184J / 163445', 'PORT NEW ORLEANS, LA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15117, 14919, 'lbs', 'SOX24-24144-1', '2025-02-05 02:17:13', '2025-02-05 02:17:13'),
(352, 'G1L25102672', '247C0184J / 163445', 'PORT NEW ORLEANS, LA, USA', 'NEXALUME ®  COIL , ASTM  A - 792', '0.0142\" NOM x 40.875\" AZ50 SS-80 NEXALUME® Skin Passed Chromated Oiled', 15269, 15071, 'lbs', 'SOX24-24144-1', '2025-02-05 02:17:13', '2025-02-05 02:17:13');

-- --------------------------------------------------------

--
-- Table structure for table `shippmentd`
--

CREATE TABLE `shippmentd` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `atribute` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unicode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `destination` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shippmentd`
--

INSERT INTO `shippmentd` (`id`, `atribute`, `unicode`, `size`, `destination`, `type`, `created_at`, `updated_at`) VALUES
(1, 'AT-PERCOBAAN', 'PERCOBAAN', 'SIZE-PERCOBAAN-SIZE-PERCOBAAN-SIZE-PERCOBAAN', 'PERCOBAAN-DESTINATION', 'SO-PERCOBAAN', '2024-11-19 01:15:32', '2024-11-19 01:15:32');

-- --------------------------------------------------------

--
-- Table structure for table `shippmente`
--

CREATE TABLE `shippmente` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `attribute` varchar(255) NOT NULL,
  `no_so` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `pod` varchar(255) NOT NULL,
  `product` varchar(255) NOT NULL,
  `weight` varchar(255) NOT NULL,
  `satuan_berat` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shippmente`
--

INSERT INTO `shippmente` (`id`, `attribute`, `no_so`, `name`, `pod`, `product`, `weight`, `satuan_berat`, `created_at`, `updated_at`) VALUES
(1, 'att-1', 'SO-001', 'SEAMETAL/2024.203-304293', 'TAMPA.USA', 'NEXALUME - ASTMA A - 798', '8.265', 'KG', '2025-03-03 18:34:32', '2025-03-06 16:12:35'),
(2, 'att-2', 'SO-001', 'SEAMETAL/2024.203-304294', 'TAMPA.USA', 'NEXALUME - ASTMA A - 799', '9.265', 'LBS', '2025-03-06 16:16:34', '2025-03-06 16:16:34'),
(3, 'att-3', 'SO-001', 'SEAMETAL/2024.203-304295', 'TAMPA.USA', 'NEXALUME - ASTMA A - 800', '10.265', 'LBS', '2025-03-06 16:16:34', '2025-03-06 16:16:34'),
(4, 'att-4', 'SO-001', 'SEAMETAL/2024.203-304296', 'TAMPA.USA', 'NEXALUME - ASTMA A - 801', '11.265', 'LBS', '2025-03-06 16:16:34', '2025-03-06 16:16:34'),
(5, 'att-5', 'SO-001', 'SEAMETAL/2024.203-304297', 'TAMPA.USA', 'NEXALUME - ASTMA A - 802', '12.265', 'LBS', '2025-03-06 16:16:34', '2025-03-06 16:16:34'),
(6, 'att-6', 'SO-001', 'SEAMETAL/2024.203-304298', 'TAMPA.USA', 'NEXALUME - ASTMA A - 803', '13.265', 'LBS', '2025-03-06 16:16:34', '2025-03-06 16:16:34');

-- --------------------------------------------------------

--
-- Table structure for table `supply`
--

CREATE TABLE `supply` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shift_leader` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shift` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supply` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supply`
--

INSERT INTO `supply` (`id`, `shift_leader`, `shift`, `supply`, `foto`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'other', 'other', 'Raisin', '[\"1730856760_WhatsApp Image 2024-09-06 at 19.38.46_85dc6538.jpg\"]', '8', '2024-11-05 17:00:00', '2024-11-06 01:32:41'),
(2, 'cc', '2', 'Alkali', '[\"1730857172_WhatsApp Image 2024-09-06 at 19.38.46_85dc6538.jpg\"]', '8', '2024-11-05 17:00:00', '2024-11-06 01:39:32');

-- --------------------------------------------------------

--
-- Table structure for table `surat`
--

CREATE TABLE `surat` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `kode_sik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(10) NOT NULL DEFAULT '0',
  `bagian` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keperluan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_kendaraan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pemberi_izin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pemberi_izin_ttd` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `muatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `satpam` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `satpam_ttd` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pengemudi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pengemudi_ttd` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `diizinkan` time DEFAULT NULL,
  `divisi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `division` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `surat`
--

INSERT INTO `surat` (`id`, `date`, `kode_sik`, `status`, `bagian`, `keperluan`, `no_kendaraan`, `pemberi_izin`, `pemberi_izin_ttd`, `muatan`, `satpam`, `satpam_ttd`, `pengemudi`, `pengemudi_ttd`, `diizinkan`, `divisi`, `created_at`, `updated_at`, `division`) VALUES
(9, '2024-11-21', '007/SIK/2024-11-21/TML', 2, 'Danu / RBT', 'bonkar steel slevve', 'T 4606 YS', 'aku izin sendiri', 'storage/signatures/signature_1732162879.png', '-', 'sec-bagus', 'storage/signatures/signature_1732164116.png', 'Danu', 'storage/signatures/signature_1732164116.png', '11:41:00', 'WH', '2024-11-21 04:05:04', '2024-11-21 04:41:56', NULL),
(10, '2024-11-21', '008/SIK/2024-11-21/TML', 2, 'FEFWE', 'EGERG', 'GREGR', 'Guwe', 'storage/signatures/signature_1732177971.png', 'GE', 'sec-bagus', 'storage/signatures/signature_1732178006.png', 'GWEFEW', 'storage/signatures/signature_1732178006.png', '15:33:00', 'WH', '2024-11-21 08:32:24', '2024-11-21 08:33:26', NULL),
(15, '2024-11-22', '010/SIK/2024-11-22/TML', 2, 'Andri / WH', 'LANGSIR COIL', 'B9134BEA', 'PANGGAH', 'storage/signatures/signature_1732258309.png', 'COIL', 'Rangga', 'storage/signatures/signature_1732258847.png', 'Andri', 'storage/signatures/signature_1732258847.png', '14:00:00', 'WH', '2024-11-22 06:47:29', '2024-11-22 07:00:47', NULL),
(16, '2024-11-22', '011/SIK/2024-11-22/TML', 2, 'DASEP / WH', 'LANGSIR COIL', 'B 9159 BEA', 'PANGGAH', 'storage/signatures/signature_1732258724.png', 'COIL', 'Rangga', 'storage/signatures/signature_1732259033.png', 'DASEP', 'storage/signatures/signature_1732259033.png', '14:02:00', 'WH', '2024-11-22 06:56:59', '2024-11-22 07:03:53', NULL),
(17, '2024-11-22', '012/SIK/2024-11-22/TML', 2, 'TOPIK / SJT', 'LANGSIR COIL', 'B 9216 JIN', 'Panggah', 'storage/signatures/signature_1732258755.png', 'COIL', 'Rangga', 'storage/signatures/signature_1732259126.png', 'TOPIK', 'storage/signatures/signature_1732259126.png', '14:05:00', 'WH', '2024-11-22 06:57:47', '2024-11-22 07:05:26', NULL),
(18, '2024-11-22', '013/SIK/2024-11-22/TML', 2, 'semua bagian', 'perluin', 'T 4606 YS', 'Freddy', 'storage/signatures/signature_1732259348.png', '-', 'Tony', 'storage/signatures/signature_1732260103.png', 'Danu', 'storage/signatures/signature_1732260103.png', '14:21:00', 'WH', '2024-11-22 07:08:42', '2024-11-22 07:21:43', NULL),
(19, '2024-11-22', '014/SIK/2024-11-22/TML', 2, '4e6e5e6', 'Drggtd', 'Fyuft6ut', 'Fredy', 'storage/signatures/signature_1732259830.png', 'Ygjyf', 'Aan', 'storage/signatures/signature_1732260138.png', 'Yffjfjyjygjugyfydt', 'storage/signatures/signature_1732260138.png', '14:21:00', 'HR & GA', '2024-11-22 07:12:06', '2024-11-22 07:22:18', NULL),
(20, '2024-11-22', '015/SIK/2024-11-22/TML', 2, '6g6ftff', 'Cc', 'Uytr', 'Ggg', 'storage/signatures/signature_1732259997.png', 'Hhggf', 'aan', 'storage/signatures/signature_1732262230.png', 'Cc', 'storage/signatures/signature_1732262230.png', '14:56:00', 'WH', '2024-11-22 07:18:50', '2024-11-22 07:57:10', NULL),
(24, '2024-11-22', '016/SIK/2024-11-22/TML', 2, 'cc', 'cc', 'cc', 'Panggah', 'storage/signatures/signature_1732260324.png', 'cc', 'Ggdx', 'storage/signatures/signature_1732260852.png', 'cc', 'storage/signatures/signature_1732260852.png', '14:33:00', 'WH', '2024-11-22 07:23:17', '2024-11-22 07:34:12', NULL),
(25, '2024-11-22', '017/SIK/2024-11-22/TML', 2, 'produksi', 'bonkar steel slevve', 'duniapol', 'Samsul', 'storage/signatures/signature_1732261674.png', 'GE', 'Gtg', 'storage/signatures/signature_1732265777.png', 'Danu', 'storage/signatures/signature_1732265777.png', '15:56:00', 'WH', '2024-11-22 07:35:52', '2024-11-22 08:56:17', NULL),
(26, '2024-11-22', '018/SIK/2024-11-22/TML', 2, 'BUDI / PUNINAR', 'BONGKAR CRC', 'B0000ASD', 'Panggah', 'storage/signatures/signature_1732261957.png', '-', 'AGUS', 'storage/signatures/signature_1732262045.png', 'BUDI', 'storage/signatures/signature_1732262045.png', '14:53:00', 'WH', '2024-11-22 07:51:22', '2024-11-22 07:54:05', NULL),
(27, '2024-11-22', '019/SIK/2024-11-22/TML', 2, 'PANGGAH/WH', 'TRAINING APAR', 'AB6130OF', 'Wati', 'storage/signatures/signature_1732262157.png', '-', 'Segy', 'storage/signatures/signature_1732265545.png', 'PANGGAH', 'storage/signatures/signature_1732265545.png', '15:52:00', 'WH', '2024-11-22 07:55:03', '2024-11-22 08:52:25', NULL),
(28, '2024-11-22', '020/SIK/2024-11-22/TML', 2, 'PANGGAH/WH', 'TRAINING', 'AB6130OF', 'WATI', 'storage/signatures/signature_1732265385.png', '_', 'Qa', 'storage/signatures/signature_1732265451.png', 'PANGGAH', 'storage/signatures/signature_1732265451.png', '15:50:00', 'WH', '2024-11-22 08:49:06', '2024-11-22 08:50:51', NULL),
(29, '2024-11-22', '021/SIK/2024-11-22/TML', 1, 'Puninar', 'Bongkar crc', 'Dfuuu', 'Rer', 'storage/signatures/signature_1732265713.png', '_', NULL, NULL, 'R', NULL, NULL, 'WH', '2024-11-22 08:53:50', '2024-11-22 08:55:13', NULL),
(30, '2024-11-28', '022/SIK/2024-11-28/TML', 1, 'cc', 'cc', 'cc', 'cc', 'storage/signatures/signature_1732761776.png', 'cc', NULL, NULL, 'cc', NULL, NULL, 'MTC', '2024-11-28 02:42:40', '2024-11-28 02:42:56', NULL),
(31, '2024-12-24', '001/SIK/2024-12-24/TML', 2, 'Europeed', 'MUAT EXPORT', 'B9025JG', 'Panggah', 'storage/signatures/signature_1735011794.png', 'COIL', 'A.sitorus', 'storage/signatures/signature_1735011922.png', 'sulhi', 'storage/signatures/signature_1735011922.png', '10:44:00', 'WH', '2024-12-24 03:41:15', '2024-12-24 03:45:22', NULL),
(32, '2024-12-24', '002/SIK/2024-12-24/TML', 2, 'PT. Jaya abadi', 'Ijin Keluar', 'B9800KKj', 'Panggah', 'storage/signatures/signature_1735015903.png', '-', 'Sitorus', 'storage/signatures/signature_1735016017.png', 'Asep', 'storage/signatures/signature_1735016017.png', '11:52:00', 'WH', '2024-12-24 04:50:46', '2024-12-24 04:53:37', NULL),
(33, '2024-12-26', '003/SIK/2024-12-26/TML', 2, 'bhhh', 'hh', 'gtt', 'hghhhh', 'storage/signatures/signature_1735149596.png', 'bvfr', 'jj', 'storage/signatures/signature_1735149658.png', 'fyc1', 'storage/signatures/signature_1735149658.png', '01:00:00', 'QA', '2024-12-25 17:57:51', '2024-12-25 18:00:58', NULL),
(34, '2024-12-26', '004/SIK/2024-12-26/TML', 1, 'bhhh', 'hh', 'gtt', 'a', 'storage/signatures/signature_1735152126.png', 'bvfr', NULL, NULL, 'fyc1', NULL, NULL, 'SAFETY', '2024-12-25 18:11:37', '2024-12-25 18:42:06', NULL),
(35, '2024-12-26', '005/SIK/2024-12-26/TML', 0, 's', 's', 's', NULL, NULL, 's', NULL, NULL, 's', NULL, NULL, 'HR & GA', '2024-12-25 18:39:13', '2024-12-25 18:39:13', NULL),
(36, '2025-05-22', '001/SIK/2025-05-22/TML', 2, 'prd', 'sangat perlu sekalis', 'T 4606 YS', 'aku izin sendiri', 'storage/signatures/signature_1747912052.png', '-', 'sec-bagus', 'storage/signatures/signature_security_1747912077.png', 'Wahyu Ricci', 'storage/signatures/signature_pengemudi_1747912076.png', '18:07:00', 'PRD', '2025-05-22 11:06:54', '2025-05-22 11:07:57', NULL),
(37, '2025-05-29', '002/SIK/2025-05-29/TML', 0, 'WH', 'apajeu', 'T 4606 YS', NULL, NULL, 'KOSONG', NULL, NULL, 'DANUARTHA', NULL, NULL, 'MTC', '2025-05-29 09:04:56', '2025-05-29 09:04:56', NULL),
(38, '2025-06-02', '001/SIK/2025-06-02/TML', 0, 'semua bagian', 'apajeu', 'T 4606 YS', NULL, NULL, 'bermuatan mesin baja', NULL, NULL, 'Wahyu Ricci', NULL, NULL, 'Warehouse', '2025-06-01 18:58:07', '2025-06-01 18:58:07', 'Warehouse');

-- --------------------------------------------------------

--
-- Table structure for table `team_leader`
--

CREATE TABLE `team_leader` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` json DEFAULT NULL,
  `active` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `team_leader`
--

INSERT INTO `team_leader` (`id`, `name`, `type`, `active`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 'Panggah', '[\"MP\", \"FC\", \"OP\", \"PL\", \"SL\", \"CD\", \"L8\"]', '1', '65', '2025-05-22 18:02:57', '2025-05-22 20:00:37'),
(3, 'Antonius Danu Kurniawan', '[\"MP\", \"FC\", \"OP\", \"PL\", \"SL\", \"CD\", \"L8\"]', '1', '31', '2025-05-22 18:16:31', '2025-05-22 18:20:29'),
(4, 'Riyan Hidayat', '[\"MP\", \"FC\", \"OP\", \"PL\", \"SL\", \"CD\", \"L8\"]', '1', '77', '2025-05-22 18:16:51', '2025-05-22 18:20:46'),
(5, 'Freddy Tampubolon', '[\"MP\", \"FC\", \"OP\", \"PL\", \"SL\", \"CD\", \"L8\"]', '1', '46', '2025-05-22 18:17:05', '2025-05-22 18:17:05'),
(6, 'Andhika Canandian Adi Prabowo', '[\"MP\", \"FC\", \"OP\", \"PL\", \"SL\", \"CD\", \"L8\"]', '1', '29', '2025-05-22 18:17:24', '2025-05-22 18:17:24'),
(7, 'Alex', '[\"FC\"]', '1', '100', '2025-05-22 20:45:04', '2025-05-22 20:45:13');

-- --------------------------------------------------------

--
-- Table structure for table `trailler`
--

CREATE TABLE `trailler` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `shift_leader` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mtc_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_forklift` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `carrier` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_carrier` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rantai` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rantai_pe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ket_rantai_pe` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_rantai` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ban` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_ban` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cadangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_cadangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sein` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_sein` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rotating` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_rotating` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stop` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_stop` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `utama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_utama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kota` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_kota` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `connector` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_connector` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `accu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_accu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coolant` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_coolant` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parking` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_parking` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brake` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_brake` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `horn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_horn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mundur` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_mundur` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `clamp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_clamp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `terpal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_terpal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ganjal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_ganjal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pallet` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_pallet` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_apar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `p3k` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_p3k` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fancing` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_fancing` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `triangle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_triangle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tools` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_tools` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trailler`
--

INSERT INTO `trailler` (`id`, `user_id`, `shift_leader`, `mtc_name`, `jenis_forklift`, `date`, `carrier`, `ket_carrier`, `rantai`, `rantai_pe`, `ket_rantai_pe`, `ket_rantai`, `ban`, `ket_ban`, `cadangan`, `ket_cadangan`, `sein`, `ket_sein`, `rotating`, `ket_rotating`, `stop`, `ket_stop`, `utama`, `ket_utama`, `kota`, `ket_kota`, `connector`, `ket_connector`, `accu`, `ket_accu`, `coolant`, `ket_coolant`, `parking`, `ket_parking`, `brake`, `ket_brake`, `horn`, `ket_horn`, `mundur`, `ket_mundur`, `clamp`, `ket_clamp`, `terpal`, `ket_terpal`, `ganjal`, `ket_ganjal`, `pallet`, `ket_pallet`, `apar`, `ket_apar`, `p3k`, `ket_p3k`, `fancing`, `ket_fancing`, `triangle`, `ket_triangle`, `tools`, `ket_tools`, `catatan`, `created_at`, `updated_at`) VALUES
(1, 14, 'Freddy', 'mtcin', 'B 9134 BEA/PAK ANDRI-PAK RIZKI', '2024-11-08', 'x', 'cc', 'x', 'x', 'tg', 'cc2', 'x', 'ket20', 'x', 'cc', 'x', 'ket4', 'x', 'ket5', 'x', 'ket6', 'h', 'ket7', 'x', 'cc', 'x', 'ket8', 'h', 'ket9', 'h', 'cc', 'x', 'ket10', 'x', 'ket11', 'x', 'ket2', 'x', 'ket3', 'x', 'cc', 'x', 'cc', 'x', 'cc', 'x', 'cc', 'x', 'fer', 'x', 'gr', 'x', 'cc', 'x', 'cc', 'x', 'cc', 'rt', '2024-11-08 03:34:14', '2024-11-08 03:34:14'),
(2, 81, 'Freddy', NULL, 'B 9159 BEA/PAK DASEP-PAK ROHIMAT', '2025-02-06', 'v', NULL, 'v', 'v', NULL, NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'h', NULL, 'v', NULL, 'v', NULL, 'h', NULL, 'h', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'o', 'Terpal sudah Muali sobek-sobek', 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'v', NULL, 'Trapal sudah Muali sobek-sobek harus d ganti', '2025-02-06 09:59:57', '2025-02-06 09:59:57'),
(3, 101, 'Panggah', 'aku', 'B 9134 BEA/PAK ANDRI-PAK RIZKI', '2025-05-28', 'x', NULL, 'x', 'x', NULL, NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'l', NULL, 'x', NULL, 'x', NULL, 'l', NULL, 'l', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, 'x', NULL, NULL, '2025-05-28 13:29:46', '2025-05-28 13:29:46');

-- --------------------------------------------------------

--
-- Table structure for table `trailler_name`
--

CREATE TABLE `trailler_name` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_mobil` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pengguna` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trailler_name`
--

INSERT INTO `trailler_name` (`id`, `no_mobil`, `pengguna`, `created_at`, `updated_at`) VALUES
(1, 'B 9134 BEA', 'PAK ANDRI-PAK RIZKI', '2025-05-22 19:02:40', '2025-05-22 20:46:59'),
(3, 'B 9159 BEA', 'PAK DASEP-PAK ROHMAT', '2025-05-22 20:47:39', '2025-05-22 20:47:39');

-- --------------------------------------------------------

--
-- Table structure for table `tujuan`
--

CREATE TABLE `tujuan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tujuan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` json NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `division` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Warehouse',
  `profile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `type`, `email`, `role`, `status`, `division`, `profile`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(14, 'ALL', 'all', '[\"all\"]', 'all@example.com', '0', '1', 'Warehouse', 'avatars/all/673ef628e151c.png', '2024-11-06 07:08:13', '$2y$12$F.XyaYQr9LtDWc2BZ0cjVO7sCcjc/zjPKC7vsD6o9oyVDtzuZ1S3y', '4N7mXoqDdfrV7Mk0FZJRtfMuYXvozV11TXrIngT9klfIcjPezAuKvcbhmCof', '2024-11-06 07:08:13', '2025-05-21 11:53:12'),
(18, 'Abdul Watas', 'Abdul', '[\"FC\", \"CK\", \"SL\", \"SIK\"]', 'watas@tatametal.com', '1', '1', 'Warehouse', NULL, NULL, '$2y$12$jySjblU24brJPcR3MiUEgeBcsS02.4E7/MZrh3dKhnCYXe/t07xKa', NULL, '2024-11-06 07:34:07', '2025-06-01 18:43:45'),
(19, 'Ade Irfan', 'Ade', '[\"FC\", \"SL\", \"CD\"]', 'ade.irfan@tatametal.com', '1', '1', 'Warehouse', NULL, NULL, '$2y$12$g.4iSbGcd0sR4GNYaCJGr.k9NCQaW20WD9O54McgAb.Ra4OwuYipm', NULL, '2024-11-06 07:34:47', '2024-12-19 03:07:56'),
(20, 'Adhitiya Bayu Nugroho', 'Adhitiya', '[\"FC\", \"OP\", \"SL\"]', 'adhitiya.bayu@tatametal.com', '0', '1', 'Warehouse', NULL, NULL, '$2y$12$ZdNndBXMQFlxtYcWrVA8OuPRcf8HtplxGTPAcbZqZg9OvFuQMj2ey', NULL, '2024-11-06 07:35:57', '2024-12-20 21:54:23'),
(21, 'Adhitya Dwi', 'Adhitya', '[\"FC\", \"SL\"]', 'adhitya.dwi@tatametal.com', '1', '1', 'Warehouse', NULL, NULL, '$2y$12$yYsg.EMIS8KLCO4FcVbQ8eAMKE4HYfsKllPyQUJ.8ZbT1vv1GaPme', NULL, '2024-11-06 07:36:35', '2024-11-06 07:36:35'),
(22, 'Adi Rampo Ginantaka', 'Adi', '[\"FC\", \"SL\", \"CD\"]', 'rampo@tatametal.com', '1', '1', 'Warehouse', NULL, NULL, '$2y$12$9jwBUnzButmtn.tvTwwtkuimDbdEB/4fgg5KrACkbMHTBWandECzW', NULL, '2024-11-06 07:37:07', '2024-12-19 03:06:28'),
(23, 'Agustinus Riswanto', 'Agustinus', '[\"FC\", \"SL\"]', 'agustinus.riswanto@tatametal.com', '0', '1', 'Warehouse', NULL, NULL, '$2y$12$bzAnBuny8qImeIWiQam2cOY1Fv/DKEv8u1FF6fCE.s/9ODuuGdlnO', NULL, '2024-11-06 07:37:34', '2024-12-19 22:39:59'),
(24, 'Ahmad Fadillah', 'Ahmad', '[\"FC\", \"OP\", \"SL\"]', 'ahmad.fadillah@tatametal.com', '0', '1', 'Warehouse', NULL, NULL, '$2y$12$bVk0j38KoaI8t8Xgd53E5uL.3OcpIzaMECuZKE3N8F7wiIFa4aE2i', NULL, '2024-11-06 07:38:05', '2025-01-22 16:40:42'),
(25, 'Ahmad Rino', 'Ahmad Rino', '[\"FC\", \"SL\", \"CD\"]', 'ahmad.rino@tatametal.com', '0', '1', 'Warehouse', NULL, NULL, '$2y$12$vctlAc1yI4T46CP.Ssc7xOzZpaX37rxaK2j4RFKFWfaQa7T4hcPzW', NULL, '2024-11-06 07:38:48', '2025-01-20 02:21:52'),
(26, 'Alfian Sukron', 'Alfian Sukron', '[\"FC\", \"SL\", \"CD\"]', 'alfian.sukron@tatametal.com', '1', '1', 'Warehouse', NULL, NULL, '$2y$12$gD1.C.o5iwpFeZU5rV../OKgXQz05CWaV3MHdNVVWJGHcbj1wRnei', NULL, '2024-11-06 07:39:13', '2024-12-19 03:07:15'),
(27, 'Alvin R', 'Alvin R', '[\"MP\", \"FC\", \"CK\", \"SL\", \"CD\"]', 'alvin.r@tatametal.com', '1', '1', 'Warehouse', NULL, NULL, '$2y$12$klcJOwvVNP4Zi2hqWcGA8O5i784rXubgxZdU7tJSqfrY4tEeivtm2', NULL, '2024-11-06 07:39:42', '2024-12-19 03:07:47'),
(28, 'Ananta Rizki Ardi', 'Ananta Rizki Ardi', '[\"FC\", \"SL\", \"CD\"]', 'ananta.rizki@tatametal.com', '1', '1', 'Warehouse', NULL, NULL, '$2y$12$l6PG0UwVmEDAB1DiRWJRa.oOgUCZDMz9sA8gNFDyI7f/p/vLQlqJi', NULL, '2024-11-06 07:40:05', '2024-12-19 03:08:11'),
(29, 'Andhika Canandian Adi Prabowo', 'Andhika Canandian Adi Prabowo', '[\"MP\", \"FC\", \"OP\", \"SL\", \"CD\"]', 'andhika.canandian@tatametal.com', '0', '1', 'Warehouse', NULL, NULL, '$2y$12$winmdX9LktltE9HcTuTj..voNJtrqe8DDa9sApB27Q3OskXpcNovS', NULL, '2024-11-06 07:40:47', '2024-11-15 06:25:28'),
(30, 'Andri Riadi', 'Andri Riadi', '[\"FC\", \"SL\"]', 'andri.riadi@tatametal.com', '1', '1', 'Warehouse', NULL, NULL, '$2y$12$EIJf/O3xyUvJicaQx1wn4.uz6s7/GLuPRRuXY0DLl.Vtxwf5EbFPW', NULL, '2024-11-06 07:41:24', '2024-12-19 03:09:19'),
(31, 'Antonius Danu Kurniawan', 'Antonius Danu Kurniawan', '[\"FC\", \"OP\", \"PL\", \"SL\", \"CD\"]', 'antonius.danu@tatametal.com', '0', '1', 'Warehouse', NULL, NULL, '$2y$12$Uz1egAGrmRFE2C/vPojMS.4bLXVBC5SY60JU7DrFinCHOOIPgqrhq', NULL, '2024-11-06 07:42:10', '2025-01-20 02:22:37'),
(32, 'Bibit Kurniawan', 'Bibit Kurniawan', '[\"FC\", \"SL\", \"CD\"]', 'bibit.kurniawan@tatametal.com', '1', '1', 'Warehouse', NULL, NULL, '$2y$12$T39UkckCsa1RQvObwLL6ruegIy9JJZFV8iAdeN6InmZ12QrRvj9G6', NULL, '2024-11-06 07:42:48', '2024-12-19 03:11:39'),
(33, 'Briggita Maria S', 'Briggita Maria S', '[\"all\"]', 'briggita.maria@tatametal.com', '0', '1', 'Warehouse', NULL, NULL, '$2y$12$6rNPnbM5EYgAcU76/JLyPuggim5yiFA4B90fnnOdmEpf5brmV6bKK', NULL, '2024-11-06 07:43:14', '2024-11-06 07:43:14'),
(34, 'Cendy Lustri Lanang', 'Cendy Lustri Lanang', '[\"FC\", \"SL\", \"CD\"]', 'cendy@tatametal.com', '1', '1', 'Warehouse', NULL, NULL, '$2y$12$iHlRELlk4eQpgMTgAxwsNeVt9pV4j3QoO0yz9vZa8lMcyVWwbjto2', NULL, '2024-11-06 07:43:42', '2024-12-19 03:12:02'),
(35, 'Dasep Saepul Anwar', 'Dasep Saepul Anwar', '[\"FC\", \"SL\"]', 'dasep@tatametal.com', '1', '1', 'Warehouse', NULL, NULL, '$2y$12$9oRdG1UYGIaAMWPnqFzI5.5jfLaJm0AqyLBREdJAdh50hVcVIgMfq', NULL, '2024-11-06 07:44:11', '2024-11-06 07:44:11'),
(36, 'Defitra', 'Defitra', '[\"FC\", \"SL\", \"CD\"]', 'defitra@tatametal.com', '1', '1', 'Warehouse', NULL, NULL, '$2y$12$N/SGJoEgnhoEj/KkPFWeU.tTW83yot/gyoztrDjocJoHOGIsvtHMS', NULL, '2024-11-06 07:44:43', '2024-12-19 03:12:26'),
(37, 'Dhita Prihatna', 'Dhita Prihatna', '[\"FC\", \"SL\", \"CD\"]', 'dhita.prihatna@tatametal.com', '1', '1', 'Warehouse', NULL, NULL, '$2y$12$L9a2IJIlerax8N3u89Vvwe4m4M0tKfH7gBl0zggf0yyYPVg.9MF92', NULL, '2024-11-06 07:45:09', '2024-12-19 03:12:51'),
(38, 'Dian Santoso', 'Dian Santoso', '[\"FC\", \"OP\", \"SL\"]', 'dian.santoso@tatametal.com', '0', '1', 'Warehouse', NULL, NULL, '$2y$12$j9AaSCHzJ7D.AyTVbdCnU.SiLgbVUk2RSVuJuUYhxgdVp9dKPTloS', NULL, '2024-11-06 07:45:46', '2024-12-07 03:40:12'),
(39, 'Didi Suryadi', 'Didi Suryadi', '[\"FC\", \"SL\"]', 'didi.suryadi@tatametal.com', '0', '1', 'Warehouse', NULL, NULL, '$2y$12$BPpPf7SaWMrg4chBD5FTNeDANZt6oa0mk4rMg0rTXiIXwnR25B0b2', NULL, '2024-11-06 07:46:41', '2024-12-18 07:23:45'),
(40, 'Dimas Anggitias', 'Dimas Anggitias', '[\"FC\", \"OP\", \"SL\"]', 'dimas.anggitias@tatametal.com', '0', '1', 'Warehouse', NULL, NULL, '$2y$12$1eg7j3bQyWDho/IrkEm5VOo.yGLgLUPaYHT8z5n8IF8Eh1cfnLtYK', NULL, '2024-11-06 07:47:07', '2024-12-09 01:36:18'),
(41, 'Dirin', 'Dirin', '[\"FC\", \"SL\"]', 'dirin@tatametal.com', '1', '1', 'Warehouse', NULL, NULL, '$2y$12$u/PsbDRPPZDEuWwbUO0JJel.rLrxgF7e5OMyP6aS43HUPykylLSxy', NULL, '2024-11-06 07:47:44', '2024-11-06 07:47:44'),
(42, 'Dodi Prajasetiya', 'Dodi Prajasetiya', '[\"FC\", \"SL\"]', 'dodi@tatametal.com', '1', '1', 'Warehouse', NULL, NULL, '$2y$12$aJHEtRxx15ScRwjvg0I5JukVIZ17nqTc.8Gvu55S988l/Fc7WH4g6', NULL, '2024-11-06 07:48:06', '2024-11-06 07:48:06'),
(43, 'Doni', 'Doni', '[\"FC\", \"OP\", \"SL\"]', 'doni@tatametal.com', '0', '1', 'Warehouse', NULL, NULL, '$2y$12$De2RzjvNFybnGywIQRdZIOdprfthW.R8rYpPSk.3IFCTuFZ/82x8G', NULL, '2024-11-06 07:48:27', '2025-01-22 16:45:38'),
(44, 'Dywa  Saputra', 'Dywa  Saputra', '[\"FC\", \"SL\"]', 'dywa@tatametal.com', '1', '1', 'Warehouse', NULL, NULL, '$2y$12$hzOq6/i4NZSsQBfnh2/fO.KXgC0VOjup2OMYBArV4XceOWlBf64Ni', NULL, '2024-11-06 07:49:23', '2024-11-06 07:49:23'),
(45, 'Eko Suprayitno', 'Eko Suprayitno', '[\"FC\", \"SL\"]', 'eko.suprayitno@tatametal.com', '0', '1', 'Warehouse', NULL, NULL, '$2y$12$W5wHNkgQ5Oih/yv0chp.2uwLB6hZzfxuNBrzJ1/Zru51uW.Trv.OG', NULL, '2024-11-06 07:52:44', '2025-01-20 02:22:08'),
(46, 'Freddy Tampubolon', 'Freddy Tampubolon', '[\"FC\", \"OP\", \"CK\", \"SL\", \"CD\"]', 'freddy@tatametal.com', '0', '1', 'Warehouse', NULL, NULL, '$2y$12$c0z5syD1c4xW5NG0PZPwY.tY.2qSBiPwsVHZdVqjzhydyJq1wIUUG', NULL, '2024-11-06 07:56:08', '2024-12-11 02:49:52'),
(47, 'Gerraldo', 'Gerraldo', '[\"MP\", \"FC\", \"PL\", \"CK\", \"SL\"]', 'gerraldo@tatametal.com', '0', '1', 'Warehouse', NULL, NULL, '$2y$12$HFqNYs/be6t1Cu0PFMlMUeeFl02X.WsvqcjiVJ49S5DAPV21Ruy.6', NULL, '2024-11-06 07:56:36', '2024-12-05 01:08:42'),
(48, 'Gladys Samantha Liman', 'Gladys Samantha Liman', '[\"FC\", \"SL\"]', 'gladys@tatametal.com', '0', '1', 'Warehouse', NULL, NULL, '$2y$12$0hsJLLvw3IkXcrJoZJGmO.YmhTfatpkO55I0urZs2r6wKpid7nQeS', NULL, '2024-11-06 07:57:13', '2024-11-06 07:57:13'),
(49, 'Hamam', 'Hamam', '[\"FC\", \"SL\"]', 'hamam@tatametal.com', '0', '1', 'Warehouse', NULL, NULL, '$2y$12$4nba6b4LUunaWPlIdcmt9u5q0CJMHOsC851lfr0lEqmSRZ/IRULbW', NULL, '2024-11-06 07:57:49', '2024-12-18 07:20:05'),
(50, 'Hisyam', 'Hisyam', '[\"FC\", \"SL\"]', 'hisyam@tatametal.com', '1', '1', 'Warehouse', NULL, NULL, '$2y$12$.T2xc9rFdHQNqsbcYkIBju/n8E6FWdiKyG.ACQBJcCIqU0n1D7Gja', NULL, '2024-11-06 07:58:08', '2024-11-06 07:58:08'),
(51, 'Ignas Pradjna Wyat Satvika', 'Ignas Pradjna Wyat Satvika', '[\"MP\", \"FC\", \"SL\"]', 'ignas@tatametal.com', '0', '1', 'Warehouse', NULL, NULL, '$2y$12$fq7AHkiXYHbhiOXcDX8EZO3edBEaBvoyt8SA94Fa2FtPIWGWQdIsW', NULL, '2024-11-06 07:58:38', '2024-11-06 07:58:38'),
(52, 'Jafar Habibullah', 'Jafar Habibullah', '[\"FC\", \"SL\"]', 'jafar@tatametal.com', '1', '1', 'Warehouse', NULL, NULL, '$2y$12$FE7h70rB2rzxPRvrmyNEg.sCXfUJJCpTKaUlVONtZylqjvoDO9iyO', NULL, '2024-11-06 07:59:07', '2024-11-06 07:59:07'),
(53, 'Jajang Halim', 'Jajang Halim', '[\"FC\", \"SL\"]', 'jajang.halim@tatametal.com', '1', '1', 'Warehouse', NULL, NULL, '$2y$12$1yne81sMYqSu9GvUXelhwuGoRDwGqi4fdFazbsUPgpBm1Dzz0XTq.', NULL, '2024-11-06 08:01:05', '2024-11-06 08:01:05'),
(54, 'Jaka Lukman', 'Jaka Lukman', '[\"FC\", \"OP\", \"SL\"]', 'jaka.lukman@tatametal.com', '0', '1', 'Warehouse', NULL, NULL, '$2y$12$.YoXihRWGLVm5j6gzO.UoODXQZyetms2MZUs3xJ3Q8xct8xrwgyeu', NULL, '2024-11-06 08:01:45', '2024-11-06 08:01:45'),
(55, 'Joko Rusdianto', 'Joko Rusdianto', '[\"FC\", \"SL\"]', 'joko.rusdianto@tatametal.com', '1', '1', 'Warehouse', NULL, NULL, '$2y$12$jEDMxal9T8h2bTjZOxysuetv1Rv5zQWCzp2FGurP4Y0o.suxjXkYW', NULL, '2024-11-06 08:02:05', '2024-11-06 08:02:05'),
(56, 'Kalis Handayani', 'Kalis Handayani', '[\"FC\", \"SL\"]', 'kalis.handayani@tatametal.com', '1', '1', 'Warehouse', NULL, NULL, '$2y$12$to24OibOIvJsHI/SLBQQcuRr2oo3lzbcefP8AMJmFkY4lQZOlwcIC', NULL, '2024-11-06 08:02:37', '2024-11-06 08:02:37'),
(57, 'Komar Jaelani', 'Komar Jaelani', '[\"FC\", \"SL\"]', 'komar@tatametal.com', '1', '1', 'Warehouse', NULL, NULL, '$2y$12$Rhabc/XoXX4tLLjwhOMoFu3nPrdivVdtXKuIupAySY2qdRrV2O2w6', NULL, '2024-11-06 08:03:04', '2024-11-06 08:03:04'),
(58, 'Kurniawan', 'Kurniawan', '[\"FC\"]', 'kurniawan@tatametal.com', '1', '1', 'Warehouse', NULL, NULL, '$2y$12$Klrn7ICNYYAgHF6Djg0N4eaqiDHkKbZaI15k/t7rVzs2b8GMvwFBi', NULL, '2024-11-06 08:03:26', '2024-11-06 08:03:26'),
(59, 'Lidwina Prista Anggita Putri', 'Lidwina Prista Anggita Putri', '[\"SP\", \"FC\", \"CK\", \"SL\"]', 'lidwina.prista@tatametal.com', '0', '1', 'Warehouse', NULL, NULL, '$2y$12$.gN.k2wcJVloN0A.3qcbk.TyiJ5vTznw4oK2EIB6HJOe3nCjPjIaO', NULL, '2024-11-06 08:04:01', '2024-11-06 08:04:01'),
(60, 'M. Dalhar Nawawi', 'M. Dalhar Nawawi', '[\"FC\", \"SL\"]', 'nawawi@tatametal.com', '1', '1', 'Warehouse', NULL, NULL, '$2y$12$IqXcP16sSb48MhG/3C4wFuhcs3TmmxzQqJ3vgFJAZliR2Xatp6dBi', NULL, '2024-11-06 08:05:02', '2024-11-06 08:05:02'),
(61, 'M. Ludiyanto', 'M. Ludiyanto', '[\"MP\", \"FC\", \"SL\"]', 'ludiyanto@tatametal.com', '0', '1', 'Warehouse', NULL, NULL, '$2y$12$Oau4rsKmgl4H6Cr/weSfW.6RPdsypdL97RnrKLCQwOZ4V8tPFntya', NULL, '2024-11-06 08:05:31', '2024-11-06 08:05:31'),
(62, 'Maksum Ariyanto', 'Maksum Ariyanto', '[\"FC\", \"OP\", \"SL\"]', 'maksum@tatametal.com', '0', '1', 'Warehouse', NULL, NULL, '$2y$12$OA2SKdvQU5i/ezrFY5DGCefsGyAfGkj0VW9zUdvLmmGaDLqJt9aZG', NULL, '2024-11-06 08:06:02', '2024-11-06 08:06:02'),
(63, 'Michael Andreanus Widijono', 'Michael Andreanus Widijono', '[\"all\"]', 'michael@tatametal.com', '0', '1', 'Warehouse', NULL, NULL, '$2y$12$5H0GIGvg7kwFRtDlcvm6De9KaBqpqhaIjI4uCYeWWIn6Edb7PIUIe', NULL, '2024-11-06 08:06:21', '2024-11-06 08:06:21'),
(64, 'Mulyana', 'Mulyana', '[\"FC\", \"OP\", \"SL\"]', 'mulyana@tatametal.com', '0', '1', 'Warehouse', NULL, NULL, '$2y$12$SVOPVOD5.YzR/GRBTPqvxeVohnj2/p4ydi1tPBW60ZZzOACKRcmhi', NULL, '2024-11-06 08:06:48', '2024-11-06 08:06:48'),
(65, 'Panggah', 'Panggah', '[\"all\"]', 'panggah@tatametal.com', '0', '1', 'Warehouse', NULL, NULL, '$2y$12$24lZOqDdXw1NDUUWD4bu6Odne2beCnJZVhTc57ApAtuPIUn7yeFA.', NULL, '2024-11-06 08:07:08', '2024-12-24 03:40:58'),
(66, 'Pratama Suharyoto', 'Pratama Suharyoto', '[\"FC\", \"SL\"]', 'pratama.suharyoto@tatametal.com', '1', '1', 'Warehouse', NULL, NULL, '$2y$12$DyEi/Q/.DnMsqsiuzGpHaOo8OrmD7E8YNuDrb4coTxv9PAyTfTWB.', NULL, '2024-11-06 08:07:35', '2024-11-06 08:07:35'),
(67, 'Purnomo', 'Purnomo', '[\"FC\", \"OP\", \"SL\"]', 'purnomo@tatametal.com', '0', '1', 'Warehouse', NULL, NULL, '$2y$12$yiibfycQW7Ec5H.JF/k2Ce.BDLQvfG75uULqnrGE5AK3kexGtVsUK', NULL, '2024-11-06 08:08:07', '2024-11-06 08:08:07'),
(68, 'Rafian Allen', 'Rafian Allen', '[\"MP\", \"FC\", \"PL\", \"CK\", \"SL\"]', 'allen@tatametal.com', '0', '1', 'Warehouse', NULL, NULL, '$2y$12$6ZRHnzfqqSYX/y0uFcVHt.MbpJSdYVrLzWcOIeM6VXHzBO1fgaBqq', NULL, '2024-11-06 08:08:42', '2024-11-06 08:08:42'),
(69, 'Rahman Sudaryanto', 'Rahman Sudaryanto', '[\"FC\", \"SL\"]', 'rahman.sudaryanto@tatametal.com', '1', '1', 'Warehouse', NULL, NULL, '$2y$12$Y.SN8g0AVFLIlPbUBKOxBuiLodjIL73GS4GMONJ964yPK76pyIII6', NULL, '2024-11-06 08:09:22', '2024-11-06 08:09:22'),
(70, 'Rasio', 'Rasio', '[\"FC\", \"SL\"]', 'rasio@tatametal.com', '1', '1', 'Warehouse', NULL, NULL, '$2y$12$ewsuxy5GElhCgDJYN1V3aOToMjmW0b3EGn4.3tXVlesFKIuY1wuga', NULL, '2024-11-06 08:09:53', '2024-11-06 08:09:53'),
(71, 'Retno Dwi Keswanto', 'Retno Dwi Keswanto', '[\"FC\", \"SL\"]', 'retno.dwi.keswanto@tatametal.com', '1', '1', 'Warehouse', NULL, NULL, '$2y$12$s.KYsEDeFW/LB/gpXPadIOcqeAEJsUho35PSeGiOKCj3X022xOlXe', NULL, '2024-11-06 08:10:14', '2024-11-06 08:10:14'),
(72, 'Reza Febriansyah', 'Reza Febriansyah', '[\"FC\", \"SL\"]', 'reza.febriansyah@tatametal.com', '1', '1', 'Warehouse', NULL, NULL, '$2y$12$A92lKavAlF8qtnbcEgRRTe6mWx5RfCb3VTOYIgQytjgPOVQy86lom', NULL, '2024-11-06 08:10:43', '2024-11-06 08:10:43'),
(73, 'Reza Setiyo Ramadani', 'Reza Setiyo Ramadani', '[\"FC\", \"OP\", \"SL\"]', 'reza.setiyo@tatametal.com', '0', '1', 'Warehouse', NULL, NULL, '$2y$12$Dgg/X2K3wmROePhZ6hwgreX4eS8tHsY683HXl54Wb09UJI26OrJ9C', NULL, '2024-11-06 08:11:09', '2025-01-20 02:22:18'),
(74, 'Rian Wahyudi', 'Rian Wahyudi', '[\"FC\", \"SL\"]', 'rian.wahyudi@tatametal.com', '0', '1', 'Warehouse', NULL, NULL, '$2y$12$EpIDHM4E16MjkeDCWQIo0O1Q5akrJt2VSnulQIYoGnqCa3lHQPUGK', NULL, '2024-11-06 08:12:07', '2024-12-18 07:18:03'),
(75, 'Ridwan', 'Ridwan', '[\"FC\", \"SL\"]', 'ridwan@tatametal.com', '1', '1', 'Warehouse', NULL, NULL, '$2y$12$7XNyuB6qdx1ZFrsvcG6e0Oxt9aDeQVVsQDQvPiKpMuEjQ4ujIIoCS', NULL, '2024-11-06 08:12:47', '2024-11-06 08:12:47'),
(76, 'Rio Ariawan', 'Rio Ariawan', '[\"FC\", \"OP\", \"SL\"]', 'rio.ariawan@tatametal.com', '0', '1', 'Warehouse', NULL, NULL, '$2y$12$euggEw2tK7tYS/PbCuOt/.5S4DfpzPdEVnWlQHbelRDupmxNuASXq', NULL, '2024-11-06 08:13:19', '2024-11-06 08:13:19'),
(77, 'Riyan Hidayat', 'Riyan Hidayat', '[\"FC\", \"OP\", \"CK\", \"SL\", \"CD\"]', 'riyan.hidayat@tatametal.com', '0', '1', 'Warehouse', NULL, NULL, '$2y$12$BhTFp.OX9GPhRbcUt8ixpeX0CVLFbtzNEZVCCauvBgMeFk0Pfjb.i', NULL, '2024-11-06 08:14:00', '2024-11-15 06:23:27'),
(78, 'Riyan Saputro', 'Riyan Saputro', '[\"FC\", \"OP\", \"SL\"]', 'riyan.saputro@tatametal.com', '0', '1', 'Warehouse', NULL, NULL, '$2y$12$oRwdhqCBkuP7.ux67Crk6OBrL6Zlkgqy1GwZ32kxnCdm09byCfs.e', NULL, '2024-11-06 08:14:26', '2024-11-06 08:14:26'),
(79, 'Rizky Rhenaldo Tomasola', 'Rizky Rhenaldo Tomasola', '[\"FC\", \"SL\"]', 'rizky.rhenaldo@tatametal.com', '1', '1', 'Warehouse', NULL, NULL, '$2y$12$S4tMaPqelcNA2WgH4YAfDeTw/xsfcfhf0zFZ2rmtGSxLimplVpspe', NULL, '2024-11-06 08:14:50', '2024-11-06 08:14:50'),
(80, 'Robby Ardiansyah', 'Robby Ardiansyah', '[\"MP\", \"FC\", \"SL\"]', 'robby.ardiansyah@tatametal.com', '0', '1', 'Warehouse', NULL, NULL, '$2y$12$smeAYyI3AKnd8gy1oRrk5eaxTZy.zrXtk1xXw9/1Vn3zxbvYa3PIG', NULL, '2024-11-06 08:15:13', '2024-11-06 08:15:13'),
(81, 'Rohimat', 'Rohimat', '[\"FC\", \"SL\"]', 'rohimat@tatametal.com', '1', '1', 'Warehouse', NULL, NULL, '$2y$12$TAPiNzCUFokE5CFWC/xlY.uknZC2BRjsKHm9t2slgnA8//GARszue', NULL, '2024-11-06 08:15:40', '2024-11-06 08:15:40'),
(82, 'Rolland', 'Rolland', '[\"FC\", \"SL\"]', 'rolland@tatametal.com', '1', '1', 'Warehouse', NULL, NULL, '$2y$12$6HxzwUpTPvpVJmjYBeUP0.5hfiEdjW8nr24D8GALbAtt/s5So6YPa', NULL, '2024-11-06 08:16:05', '2024-11-06 08:16:05'),
(83, 'Septian Ageng Nur Pratama', 'Septian Ageng Nur Pratama', '[\"FC\", \"SL\"]', 'septian.ageng@tatametal.com', '1', '1', 'Warehouse', NULL, NULL, '$2y$12$5EdObV/AiznH6WQ0gybweOunpfOkOaqh64JjzEoRusXydTyjWp6rC', NULL, '2024-11-06 08:16:38', '2024-11-06 08:16:38'),
(84, 'Suparta', 'Suparta', '[\"FC\", \"SL\"]', 'suparta@tatametal.com', '1', '1', 'Warehouse', NULL, NULL, '$2y$12$eWw1Dh6UxIl3BjASrDFAAuYeLzofOWKfMmIW0dGSx0W4dszMGLDTK', NULL, '2024-11-06 08:17:01', '2024-11-06 08:17:01'),
(85, 'Suroso', 'Suroso', '[\"FC\", \"SL\"]', 'suroso@tatametal.com', '1', '1', 'Warehouse', NULL, NULL, '$2y$12$9CzPol2o2FxCoZXfslCad.U1bdj0zVpb3.nJboviTniWvSD42VnGe', NULL, '2024-11-06 08:17:31', '2024-11-06 08:17:31'),
(86, 'Suryo Wicaksono', 'Suryo Wicaksono', '[\"FC\", \"SL\"]', 'suryo.wicaksono@tatametal.com', '0', '1', 'Warehouse', NULL, NULL, '$2y$12$Gv2.5mKMZ.qEEEIUuL4bvOJtSB4FhqktdyIN9PZAXEsfA/MhSI19K', NULL, '2024-11-06 08:17:57', '2024-12-19 22:38:14'),
(87, 'Veronika Lia', 'Veronika Lia', '[\"SP\", \"FC\", \"CK\", \"SL\"]', 'veronika.lia@tatametal.com', '0', '1', 'Warehouse', NULL, NULL, '$2y$12$bL7X.ehkZct4axeGo0gFBOY98RVbZR5AB4gScdooIrqbEmTlbJdtu', NULL, '2024-11-06 08:18:32', '2024-11-06 08:18:32'),
(88, 'Wahyu Agung Rivai', 'Wahyu Agung Rivai', '[\"FC\", \"SL\"]', 'wahyu.agung@tatametal.com', '1', '1', 'Warehouse', NULL, NULL, '$2y$12$nKTNVg.V0mFgGr1LvY2vfuQfOq6.tV7R7QNv4JcxJZl7bKTUvygri', NULL, '2024-11-06 08:19:07', '2024-11-06 08:19:07'),
(89, 'Wahyu Ricci Ricardo', 'Wahyu Ricci Ricardo', '[\"SP\", \"MP\", \"FC\", \"CK\", \"SL\"]', 'wahyu.ricci@tatametal.com', '0', '1', 'Warehouse', NULL, NULL, '$2y$12$sO/qo8QcywiFblkN1Z5UTOu0SHeS.E19PlK5yFuwjuABC4dm/nGlG', NULL, '2024-11-06 08:19:43', '2024-11-06 08:19:43'),
(90, 'Warto', 'Warto', '[\"SP\", \"FC\", \"OP\", \"SL\"]', 'warto@tatametal.com', '0', '1', 'Warehouse', NULL, NULL, '$2y$12$XI0n9knGVwCsN3RKUEAf1uUDVcERkE1P97haFodiDbMoB7nb2.bk2', NULL, '2024-11-06 08:20:08', '2024-11-06 08:20:08'),
(91, 'Widi Priyatna', 'Widi Priyatna', '[\"FC\", \"SL\"]', 'widi.priyatna@tatametal.com', '1', '1', 'Warehouse', NULL, NULL, '$2y$12$8ikF3kiMxFIdr1vAmUcOZeL.JzLaYx.zhtra8NKo7p.IJNUjhBN1e', NULL, '2024-11-06 08:20:33', '2024-11-06 08:20:33'),
(92, 'Yadi Setiadi', 'Yadi Setiadi', '[\"FC\", \"SL\"]', 'yadi.setiadi@tatametal.com', '1', '1', 'Warehouse', NULL, NULL, '$2y$12$OtMBpBcol5Lj.gPCMFk1TeEvhCzQfvXV1YmfwjWNaZnnNQ6DfYWq.', NULL, '2024-11-06 08:20:59', '2024-11-06 08:20:59'),
(93, 'Security wh', 'Security wh', '[\"CK\"]', 'security.wh@tatametal.com', '1', '1', 'Warehouse', NULL, NULL, '$2y$12$pPI/.xI.n2AmmQ3G5Oj0X.XW6YhZxAFh9q3HiMBsaZOEeg6nreulS', NULL, '2024-11-06 08:21:24', '2024-11-06 08:21:24'),
(94, 'pegawi', 'pegawai', '[\"FC\", \"CK\", \"SL\"]', 'pegawain@example.com', '1', '1', 'Warehouse', 'avatars/pegawai/674918bf331ea.png', NULL, '$2y$12$WlOq87efiiqaBpk.B5Hawu7Pv2iFa1/AcVvPXrWk6/uMAwGuwSsBu', NULL, '2024-11-11 04:05:26', '2025-05-15 13:13:34'),
(95, 'mtc', 'mtc', '[\"FC\"]', 'mtc@tatametal.com', '0', '1', 'Warehouse', NULL, NULL, '$2y$12$Qvg4Y6US1MbWMJ7ob3drGeE/EpbRZs61/4Hbx/sYPnNAnjLmjAy.O', NULL, '2024-12-17 18:18:15', '2025-01-30 08:08:30'),
(96, 'Fajar Hermawan', 'Fajar', '[\"FC\", \"SL\"]', 'fajar@tatametal.com', '0', '1', 'Warehouse', NULL, NULL, '$2y$12$1eaQpdK6IeYk2Bh/JH1Veuq9kupPBXsTas518JfaHjo2J1pDMX/sW', NULL, '2024-12-18 07:49:52', '2024-12-18 07:49:52'),
(97, 'Danuartha', 'danuartha10109013', '[\"PL\", \"SL\"]', 'odanuartha@gmail.com', '1', '1', 'Warehouse', NULL, NULL, '$2y$12$4.AOWv4RmqdoEOl6bZnB2uMc8QftgkpNeh02hOlin99oFtHf2A4RW', NULL, '2025-05-16 03:29:18', '2025-05-16 03:29:18'),
(98, 'superadmin', 'superadmin', '[\"\"]', 'superadmin@example.com', '5', '1', 'Warehouse', 'avatars/superadmin/682efff2abf08.png', NULL, '$2y$12$F.XyaYQr9LtDWc2BZ0cjVO7sCcjc/zjPKC7vsD6o9oyVDtzuZ1S3y', NULL, NULL, '2025-05-22 10:44:03'),
(99, 'shofiq abdulloh', 'shofiq', '[\"FC\", \"OP\", \"SL\"]', 'shofiq@tatametal.com', '0', '1', 'Warehouse', NULL, NULL, '$2y$12$7xj39rdDaY3EqAhdXNIgHe90XN6RbPped6dReBFfti4zPH9ILZGPW', NULL, '2025-04-08 20:23:54', '2025-04-08 20:23:54'),
(100, 'Alex', 'Alex', '[\"FC\", \"SIK\"]', 'Alexho@tatametal.com', '0', '1', 'Produksi', NULL, NULL, '$2y$12$HQaJDkxaRrQBCdsJvjFzKu3.lsrLGw.yijgptVUWW46HeUB0o123.', NULL, '2025-04-21 00:29:08', '2025-06-01 18:59:05'),
(101, 'pegawaibaru', 'pegawaibaru', '[\"FC\", \"CK\", \"SIK\"]', 'pegawaibaru@tatametal.com', '1', '1', 'Warehouse', NULL, NULL, '$2y$12$BBX2RxWLGSTKvizdtIgJW.UQoAFwn/OfL8t3KlxDTPkcpAMLuHvVS', NULL, '2025-05-28 13:23:14', '2025-06-04 06:56:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `coil`
--
ALTER TABLE `coil`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_produk` (`kode_produk`);

--
-- Indexes for table `coil_damage`
--
ALTER TABLE `coil_damage`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coil_damage_attribute_unique` (`attribute`);

--
-- Indexes for table `crane`
--
ALTER TABLE `crane`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crc`
--
ALTER TABLE `crc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crc_image`
--
ALTER TABLE `crc_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `datab`
--
ALTER TABLE `datab`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `datab_attribute_unique` (`attribute`);

--
-- Indexes for table `division`
--
ALTER TABLE `division`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eup`
--
ALTER TABLE `eup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `forklift`
--
ALTER TABLE `forklift`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hasil_list`
--
ALTER TABLE `hasil_list`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `hasil_list_attribute_unique` (`attribute`);

--
-- Indexes for table `ingot`
--
ALTER TABLE `ingot`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ingot_image`
--
ALTER TABLE `ingot_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kapasitas`
--
ALTER TABLE `kapasitas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kendaraan`
--
ALTER TABLE `kendaraan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kondisi`
--
ALTER TABLE `kondisi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mapcoil`
--
ALTER TABLE `mapcoil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mapcoiltruck`
--
ALTER TABLE `mapcoiltruck`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_gs` (`no_gs`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packing`
--
ALTER TABLE `packing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packingl08`
--
ALTER TABLE `packingl08`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `packingl08_attriibute_unique` (`attribute`);

--
-- Indexes for table `packing_detail`
--
ALTER TABLE `packing_detail`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `attribute` (`attribute`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pengecekan`
--
ALTER TABLE `pengecekan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rekap`
--
ALTER TABLE `rekap`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rekap_attribute_unique` (`attribute`);

--
-- Indexes for table `resin`
--
ALTER TABLE `resin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resin_image`
--
ALTER TABLE `resin_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resin_id` (`resin_id`);

--
-- Indexes for table `scan`
--
ALTER TABLE `scan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `scan_attribute_unique` (`attribute`);

--
-- Indexes for table `scan_layout`
--
ALTER TABLE `scan_layout`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `scan_layout_attribute_unique` (`attribute`);

--
-- Indexes for table `scheduled_tasks`
--
ALTER TABLE `scheduled_tasks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `scheduled_tasks_task_name_unique` (`task_name`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `shift`
--
ALTER TABLE `shift`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipment`
--
ALTER TABLE `shipment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shippmenta`
--
ALTER TABLE `shippmenta`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `shippmenta_atribute_unique` (`atribute`);

--
-- Indexes for table `shippmentb`
--
ALTER TABLE `shippmentb`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `shippmentb_atribute_unique` (`atribute`);

--
-- Indexes for table `shippmentc`
--
ALTER TABLE `shippmentc`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `shippmentc_atribute_unique` (`atribute`);

--
-- Indexes for table `shippmentd`
--
ALTER TABLE `shippmentd`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `shippmentd_atribute_unique` (`atribute`);

--
-- Indexes for table `shippmente`
--
ALTER TABLE `shippmente`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supply`
--
ALTER TABLE `supply`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat`
--
ALTER TABLE `surat`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `surat_kode_sik_unique` (`kode_sik`);

--
-- Indexes for table `team_leader`
--
ALTER TABLE `team_leader`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trailler`
--
ALTER TABLE `trailler`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trailler_user_id_foreign` (`user_id`);

--
-- Indexes for table `trailler_name`
--
ALTER TABLE `trailler_name`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tujuan`
--
ALTER TABLE `tujuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coil`
--
ALTER TABLE `coil`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=570;

--
-- AUTO_INCREMENT for table `coil_damage`
--
ALTER TABLE `coil_damage`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `crane`
--
ALTER TABLE `crane`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `crc`
--
ALTER TABLE `crc`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

--
-- AUTO_INCREMENT for table `crc_image`
--
ALTER TABLE `crc_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=179;

--
-- AUTO_INCREMENT for table `datab`
--
ALTER TABLE `datab`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=229;

--
-- AUTO_INCREMENT for table `division`
--
ALTER TABLE `division`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `eup`
--
ALTER TABLE `eup`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forklift`
--
ALTER TABLE `forklift`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `group`
--
ALTER TABLE `group`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hasil_list`
--
ALTER TABLE `hasil_list`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ingot`
--
ALTER TABLE `ingot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `ingot_image`
--
ALTER TABLE `ingot_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kapasitas`
--
ALTER TABLE `kapasitas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `kendaraan`
--
ALTER TABLE `kendaraan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `kondisi`
--
ALTER TABLE `kondisi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mapcoil`
--
ALTER TABLE `mapcoil`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `mapcoiltruck`
--
ALTER TABLE `mapcoiltruck`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `packing`
--
ALTER TABLE `packing`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `packingl08`
--
ALTER TABLE `packingl08`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `packing_detail`
--
ALTER TABLE `packing_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1097;

--
-- AUTO_INCREMENT for table `pengecekan`
--
ALTER TABLE `pengecekan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `rekap`
--
ALTER TABLE `rekap`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `resin`
--
ALTER TABLE `resin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `resin_image`
--
ALTER TABLE `resin_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `scan`
--
ALTER TABLE `scan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `scan_layout`
--
ALTER TABLE `scan_layout`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `scheduled_tasks`
--
ALTER TABLE `scheduled_tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shift`
--
ALTER TABLE `shift`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `shipment`
--
ALTER TABLE `shipment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `shippmenta`
--
ALTER TABLE `shippmenta`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `shippmentb`
--
ALTER TABLE `shippmentb`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=729;

--
-- AUTO_INCREMENT for table `shippmentc`
--
ALTER TABLE `shippmentc`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=353;

--
-- AUTO_INCREMENT for table `shippmentd`
--
ALTER TABLE `shippmentd`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shippmente`
--
ALTER TABLE `shippmente`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `supply`
--
ALTER TABLE `supply`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `surat`
--
ALTER TABLE `surat`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `team_leader`
--
ALTER TABLE `team_leader`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `trailler`
--
ALTER TABLE `trailler`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `trailler_name`
--
ALTER TABLE `trailler_name`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tujuan`
--
ALTER TABLE `tujuan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `resin_image`
--
ALTER TABLE `resin_image`
  ADD CONSTRAINT `resin_image_ibfk_1` FOREIGN KEY (`resin_id`) REFERENCES `resin` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `trailler`
--
ALTER TABLE `trailler`
  ADD CONSTRAINT `trailler_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
