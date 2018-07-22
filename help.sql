-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2018 at 12:07 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `help`
--

-- --------------------------------------------------------

--
-- Table structure for table `aktivnosti`
--

CREATE TABLE `aktivnosti` (
  `id` int(11) NOT NULL,
  `id_korisnika` int(11) NOT NULL,
  `id_radnika` int(11) NOT NULL,
  `opis_aktivnosti` text NOT NULL,
  `komentar` text NOT NULL,
  `zavrseno` tinyint(1) NOT NULL,
  `datum_zavrsenja` datetime NOT NULL,
  `datum_unosa` datetime NOT NULL,
  `slika` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aktivnosti`
--

INSERT INTO `aktivnosti` (`id`, `id_korisnika`, `id_radnika`, `opis_aktivnosti`, `komentar`, `zavrseno`, `datum_zavrsenja`, `datum_unosa`, `slika`) VALUES
(1, 2, 5, 'Kupovina lijekova', 'Kutija će trajati 15 dana.', 1, '2018-06-05 18:00:00', '2015-06-28 00:00:00', ''),
(2, 2, 5, 'Kupanje', 'asdads', 1, '2018-06-16 00:00:00', '2018-06-16 19:45:09', ''),
(3, 4, 7, 'sdasdsadasdasdsadd', '', 0, '2018-06-12 00:00:00', '2018-06-16 19:55:29', ''),
(4, 4, 7, 'dztihujzju', '', 0, '2017-07-12 00:00:00', '2017-06-06 19:55:29', '');

-- --------------------------------------------------------

--
-- Table structure for table `bilten`
--

CREATE TABLE `bilten` (
  `id` int(11) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `aktivan` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bilten`
--

INSERT INTO `bilten` (`id`, `mail`, `aktivan`) VALUES
(1, 'test@test.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `clanarine`
--

CREATE TABLE `clanarine` (
  `id` int(11) NOT NULL,
  `korisnik` int(11) NOT NULL,
  `radnik` int(11) NOT NULL,
  `uplata` float NOT NULL,
  `paket` int(11) NOT NULL,
  `datum_uplate` datetime NOT NULL,
  `datum_isteka` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `clanarine`
--

INSERT INTO `clanarine` (`id`, `korisnik`, `radnik`, `uplata`, `paket`, `datum_uplate`, `datum_isteka`) VALUES
(2, 2, 7, 1, 4, '2018-06-24 20:04:36', '2018-07-09 00:00:00'),
(3, 4, 5, 15, 3, '2018-06-24 20:03:35', '2018-07-01 00:00:00'),
(4, 5, 5, 15, 3, '2018-06-24 20:03:35', '2018-07-01 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `istorija_uplata`
--

CREATE TABLE `istorija_uplata` (
  `id` int(11) NOT NULL,
  `korisnik` int(11) NOT NULL,
  `radnik` int(11) NOT NULL,
  `uplata` float NOT NULL,
  `paket` int(11) NOT NULL,
  `datum` datetime NOT NULL,
  `datum_isteka` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `istorija_uplata`
--

INSERT INTO `istorija_uplata` (`id`, `korisnik`, `radnik`, `uplata`, `paket`, `datum`, `datum_isteka`) VALUES
(2, 4, 5, 55, 1, '2018-06-24 18:12:45', '2018-07-10 00:00:00'),
(3, 4, 5, 55, 2, '2018-06-24 18:13:22', '2018-07-10 00:00:00'),
(5, 4, 5, 22, 0, '2018-06-24 19:14:31', '2018-06-27 00:00:00'),
(6, 4, 5, 22, 0, '2018-06-24 19:22:57', '2018-07-27 00:00:00'),
(7, 2, 6, 20, 0, '2018-06-24 19:41:48', '2018-07-17 00:00:00'),
(8, 2, 6, 20, 0, '2018-06-24 19:42:03', '2018-07-17 00:00:00'),
(9, 4, 6, 13, 0, '2018-06-24 20:01:25', '2018-07-14 00:00:00'),
(10, 4, 6, 13, 0, '2018-06-24 20:01:41', '2018-07-14 00:00:00'),
(11, 4, 6, 13, 0, '2018-06-24 20:02:40', '2018-07-14 00:00:00'),
(12, 4, 6, 13, 0, '2018-06-24 20:03:05', '2018-07-14 00:00:00'),
(13, 2, 5, 15, 0, '2018-06-24 20:03:35', '2018-06-25 00:00:00'),
(14, 2, 7, 1, 0, '2018-06-24 20:04:36', '2018-07-06 00:00:00'),
(15, 5, 7, 1, 0, '2018-06-24 20:04:36', '2018-07-06 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `registracija`
--

CREATE TABLE `registracija` (
  `id` int(11) NOT NULL,
  `ime` varchar(32) NOT NULL,
  `prezime` varchar(32) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telefon` varchar(32) NOT NULL,
  `sifra` text NOT NULL,
  `aktivan` tinyint(1) DEFAULT '0',
  `datum_reg` datetime NOT NULL,
  `datum_odobrenja` int(11) NOT NULL,
  `komentar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `registracija`
--

INSERT INTO `registracija` (`id`, `ime`, `prezime`, `email`, `telefon`, `sifra`, `aktivan`, `datum_reg`, `datum_odobrenja`, `komentar`) VALUES
(2, 'Registrovani', 'Korisnik', 'registrovani@korisnik.com', '065 565 656', '$argon2i$v=19$m=1024,t=2,p=2$ZHJlbmthdjZQb2FkVy8xdg$t0C+2Q84vEtX+oXtu4uuWH6buhTRx60L3udn5kE6U9k', 1, '0000-00-00 00:00:00', 20180701, '');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  `cb` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id`, `cb`) VALUES
(1, ''),
(2, ''),
(3, ''),
(4, ''),
(5, ''),
(6, ''),
(7, '6'),
(8, '7'),
(9, ''),
(10, 'Array'),
(11, 'Array'),
(12, 'Array'),
(13, ''),
(14, '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `ime` varchar(32) NOT NULL,
  `prezime` varchar(32) NOT NULL,
  `permisije` int(1) NOT NULL,
  `aktivan` tinyint(4) NOT NULL,
  `slika` varchar(32) NOT NULL,
  `datum_reg` datetime NOT NULL,
  `paket` varchar(10) NOT NULL,
  `ukupne_uplate` float NOT NULL,
  `email` varchar(50) NOT NULL,
  `sifra` text NOT NULL,
  `telefon` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ime`, `prezime`, `permisije`, `aktivan`, `slika`, `datum_reg`, `paket`, `ukupne_uplate`, `email`, `sifra`, `telefon`) VALUES
(2, 'Petar', 'Petrovic', 1, 0, 'elder7.jpg', '2018-06-05 00:00:00', '1', 5311, 'petar@marko.com', '', '+387 66 321 123'),
(4, 'Asdasda', 'Asdasd', 1, 1, 'edit2.png', '2018-06-10 22:04:03', '2', 158, 'bojanboki997@gmail.com', '', '123123123'),
(5, 'Sddd', 'Sdsds', 2, 1, 'delete.png', '2018-06-10 22:07:59', '2', 0, 'bojanboki997@gmail.com', '', '213123123'),
(6, 'Bojan', 'Trica', 3, 1, 'elder7.jpg', '2018-06-13 00:00:00', '', 0, 'b', '$argon2i$v=19$m=1024,t=2,p=2$eGVId3l1bW1qQ3RyamJybA$uHud9qNeoQGPzENivh4i3xgYU5LYi0IQG8sULrCGGl4', '123321123'),
(7, 'Bojan', 'Dvica', 2, 0, 'elder7.jpg', '2018-06-13 00:00:00', '', 0, 'b2', '$argon2i$v=19$m=1024,t=2,p=2$eGVId3l1bW1qQ3RyamJybA$uHud9qNeoQGPzENivh4i3xgYU5LYi0IQG8sULrCGGl4', '123321123'),
(8, 'Registrovani', 'Korisnik', 1, 1, '', '0000-00-00 00:00:00', '', 0, 'registrovani@korisnik.com', '$argon2i$v=19$m=1024,t=2,p=2$ZHJlbmthdjZQb2FkVy8xdg$t0C+2Q84vEtX+oXtu4uuWH6buhTRx60L3udn5kE6U9k', '065 565 656'),
(9, 'Registrovani2', 'Korisnik2', 1, 1, '', '0000-00-00 00:00:00', '', 0, 'registrovani2@korisnik.com', '$argon2i$v=19$m=1024,t=2,p=2$ZHJlbmthdjZQb2FkVy8xdg$t0C+2Q84vEtX+oXtu4uuWH6buhTRx60L3udn5kE6U9k', '065 565 656'),
(10, 'Registrovani2', 'Korisnik2', 1, 1, '', '0000-00-00 00:00:00', '', 0, 'registrovani2@korisnik.com', '$argon2i$v=19$m=1024,t=2,p=2$ZHJlbmthdjZQb2FkVy8xdg$t0C+2Q84vEtX+oXtu4uuWH6buhTRx60L3udn5kE6U9k', '065 565 656'),
(11, 'Registrovani', 'Korisnik', 1, 1, '', '0000-00-00 00:00:00', '', 0, 'registrovani@korisnik.com', '$argon2i$v=19$m=1024,t=2,p=2$ZHJlbmthdjZQb2FkVy8xdg$t0C+2Q84vEtX+oXtu4uuWH6buhTRx60L3udn5kE6U9k', '065 565 656');

-- --------------------------------------------------------

--
-- Table structure for table `vijesti`
--

CREATE TABLE `vijesti` (
  `id` int(11) NOT NULL,
  `naslov` text NOT NULL,
  `slika` varchar(50) NOT NULL,
  `tekst` text NOT NULL,
  `datum_objave` datetime NOT NULL,
  `autor` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vijesti`
--

INSERT INTO `vijesti` (`id`, `naslov`, `slika`, `tekst`, `datum_objave`, `autor`) VALUES
(1, 'Lorem ipsum dolor sit amet.', 'elder3.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia vel delectus aut odio cum autem, adipisci nihil inventore fugit sint asperiores repellendus laborum temporibus earum, ad. Temporibus repudiandae maiores sed ut perferendis fugiat praesentium distinctio beatae doloremque adipisci consequuntur sapiente, molestias eveniet? Eaque nemo officiis nihil sed dolorem numquam perspiciatis eius neque praesentium. Perspiciatis quas qui aspernatur obcaecati fugit reiciendis voluptate deserunt assumenda commodi magnam suscipit, eius repellendus minima iure reprehenderit saepe nostrum cupiditate voluptas dolor consequatur, aliquid doloremque ipsa. Excepturi ipsam blanditiis sint amet cumque doloremque assumenda, nobis aspernatur, nisi aliquid voluptate provident id iure, placeat aut ipsa non hic ea numquam. Illum similique vel, vitae quis sint. Laudantium commodi pariatur tempora eos ea? Optio reiciendis aliquam quasi consequuntur maxime totam autem est libero rem nisi. Cum quaerat dolor expedita aliquam fugiat suscipit! Fugiat illo molestias officiis sapiente corporis adipisci debitis omnis dignissimos, sunt, dolores facere, dolorem sint consequatur. Voluptatum error quod mollitia fugit ipsam asperiores nulla magnam eveniet sequi officiis, beatae animi, eius rerum repudiandae id voluptatibus commodi necessitatibus adipisci dolorem dolor temporibus? Omnis sint sunt ea, quibusdam eligendi? Deleniti, optio atque ex odio! Ullam libero praesentium nobis, at recusandae, quas fugiat cum voluptates optio ratione maxime, consequatur quam. Neque nulla, explicabo tempore architecto labore similique voluptate culpa ut, aspernatur quod nihil doloremque sequi iusto quia. Consectetur eveniet, ullam corporis voluptatum commodi amet recusandae. Aperiam incidunt blanditiis eveniet reprehenderit, consequuntur voluptate, nostrum mollitia ipsum repellendus maiores? Fuga neque, quis officia. Ab esse totam non corporis quibusdam dolor error ullam voluptatum quod odio facilis sapiente ad hic repellat repudiandae libero, suscipit rerum quam facere expedita. Nesciunt explicabo soluta, libero, odio consequatur excepturi recusandae ipsam hic provident officiis dolorum aliquid enim delectus tempore inventore accusamus fugiat! Quia tempore eveniet dolore, a dolorem animi, consectetur illo maiores blanditiis doloremque laborum perspiciatis ipsam ad. Odit minima, ut obcaecati magni? Tempora iure voluptas quas alias molestias. Iure animi cum, a provident culpa iusto id suscipit explicabo pariatur? Quis ratione, excepturi velit repellendus quas officiis, expedita. Facilis, quam velit voluptatum consectetur excepturi consequatur aperiam. Inventore sint odit, temporibus blanditiis ipsum iste officia reiciendis fugit minima, possimus tenetur tempora! Enim, quas accusamus, laboriosam fugiat saepe, cum distinctio esse quisquam in nesciunt eaque commodi eum quasi consequuntur earum aperiam necessitatibus cumque, sequi libero ea. Doloremque ut quisquam autem, suscipit, nisi eligendi harum aliquid iusto! Quis repellat eligendi labore. Quos natus debitis rerum exercitationem iure fuga deserunt quidem, voluptas quae odit illum optio cupiditate repellat quasi suscipit voluptatem saepe doloribus tenetur eos maiores ipsa! Impedit quas consectetur voluptate. Facilis deserunt atque culpa quos optio, enim dolorem eaque eius autem cumque. Quidem officiis officia obcaecati molestiae facilis ipsa laborum blanditiis quod! Eligendi ipsum quae praesentium illo ut aut quod accusamus vero, blanditiis eum nostrum vel culpa harum ducimus laboriosam perspiciatis dolores cupiditate recusandae similique pariatur. Excepturi beatae, sequi, repellat placeat ratione laborum tempore assumenda inventore ex debitis esse quis. Cumque ipsa labore accusamus qui quia repellendus voluptate distinctio fuga animi esse ut delectus ullam est, eveniet voluptates perspiciatis.\r\n[img]http://localhost/help/images/vijesti/elder3.jpg[/img]\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Facere culpa beatae nesciunt praesentium? Doloremque quasi sed adipisci molestiae commodi voluptatibus nostrum delectus natus alias quisquam. Consequatur, cupiditate velit veritatis ea sequi soluta eum! Rem deleniti suscipit eligendi distinctio quia, voluptas sapiente mollitia doloremque. Dolorum, sapiente facere unde quibusdam a, cumque quia corporis consequuntur ea qui culpa numquam dolorem neque. Vero eum suscipit praesentium quod nisi obcaecati, voluptatem itaque consectetur officia minus eos harum nesciunt illo animi iusto qui nihil voluptates veniam! Placeat porro adipisci temporibus libero sunt soluta commodi ullam! Voluptatem illum maiores non optio sint repellat adipisci officiis, perspiciatis eum libero cumque, veritatis rem! Animi, earum! Quibusdam voluptate, a, commodi voluptatibus, illo ullam, consequuntur impedit saepe doloremque quisquam alias quis! Sit suscipit dolor qui, quidem fuga excepturi blanditiis minima. Dolores magni minima qui quisquam, inventore sequi quas culpa. Placeat expedita magni eos voluptatum, perspiciatis, error iste beatae exercitationem. Soluta dolorem corrupti culpa, quas laudantium est repellendus alias. Doloremque nostrum incidunt assumenda odit eligendi vero architecto? Non, eveniet, veritatis. Aperiam odit recusandae possimus optio quod minima sit eaque similique adipisci veritatis fuga, accusamus neque nesciunt nobis dicta, aliquid provident pariatur. Nostrum iusto esse sunt quis rerum veritatis! Neque aperiam, sed.', '2018-07-01 00:06:15', 'Administrator'),
(2, 'Lorem ipsum dolor sit amet.', 'elder3.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia vel delectus aut odio cum autem, adipisci nihil inventore fugit sint asperiores repellendus laborum temporibus earum, ad. Temporibus repudiandae maiores sed ut perferendis fugiat praesentium distinctio beatae doloremque adipisci consequuntur sapiente, molestias eveniet? Eaque nemo officiis nihil sed dolorem numquam perspiciatis eius neque praesentium. Perspiciatis quas qui aspernatur obcaecati fugit reiciendis voluptate deserunt assumenda commodi magnam suscipit, eius repellendus minima iure reprehenderit saepe nostrum cupiditate voluptas dolor consequatur, aliquid doloremque ipsa. Excepturi ipsam blanditiis sint amet cumque doloremque assumenda, nobis aspernatur, nisi aliquid voluptate provident id iure, placeat aut ipsa non hic ea numquam. Illum similique vel, vitae quis sint. Laudantium commodi pariatur tempora eos ea? Optio reiciendis aliquam quasi consequuntur maxime totam autem est libero rem nisi. Cum quaerat dolor expedita aliquam fugiat suscipit! Fugiat illo molestias officiis sapiente corporis adipisci debitis omnis dignissimos, sunt, dolores facere, dolorem sint consequatur. Voluptatum error quod mollitia fugit ipsam asperiores nulla magnam eveniet sequi officiis, beatae animi, eius rerum repudiandae id voluptatibus commodi necessitatibus adipisci dolorem dolor temporibus? Omnis sint sunt ea, quibusdam eligendi? Deleniti, optio atque ex odio! Ullam libero praesentium nobis, at recusandae, quas fugiat cum voluptates optio ratione maxime, consequatur quam. Neque nulla, explicabo tempore architecto labore similique voluptate culpa ut, aspernatur quod nihil doloremque sequi iusto quia. Consectetur eveniet, ullam corporis voluptatum commodi amet recusandae. Aperiam incidunt blanditiis eveniet reprehenderit, consequuntur voluptate, nostrum mollitia ipsum repellendus maiores? Fuga neque, quis officia. Ab esse totam non corporis quibusdam dolor error ullam voluptatum quod odio facilis sapiente ad hic repellat repudiandae libero, suscipit rerum quam facere expedita. Nesciunt explicabo soluta, libero, odio consequatur excepturi recusandae ipsam hic provident officiis dolorum aliquid enim delectus tempore inventore accusamus fugiat! Quia tempore eveniet dolore, a dolorem animi, consectetur illo maiores blanditiis doloremque laborum perspiciatis ipsam ad. Odit minima, ut obcaecati magni? Tempora iure voluptas quas alias molestias. Iure animi cum, a provident culpa iusto id suscipit explicabo pariatur? Quis ratione, excepturi velit repellendus quas officiis, expedita. Facilis, quam velit voluptatum consectetur excepturi consequatur aperiam. Inventore sint odit, temporibus blanditiis ipsum iste officia reiciendis fugit minima, possimus tenetur tempora! Enim, quas accusamus, laboriosam fugiat saepe, cum distinctio esse quisquam in nesciunt eaque commodi eum quasi consequuntur earum aperiam necessitatibus cumque, sequi libero ea. Doloremque ut quisquam autem, suscipit, nisi eligendi harum aliquid iusto! Quis repellat eligendi labore. Quos natus debitis rerum exercitationem iure fuga deserunt quidem, voluptas quae odit illum optio cupiditate repellat quasi suscipit voluptatem saepe doloribus tenetur eos maiores ipsa! Impedit quas consectetur voluptate. Facilis deserunt atque culpa quos optio, enim dolorem eaque eius autem cumque. Quidem officiis officia obcaecati molestiae facilis ipsa laborum blanditiis quod! Eligendi ipsum quae praesentium illo ut aut quod accusamus vero, blanditiis eum nostrum vel culpa harum ducimus laboriosam perspiciatis dolores cupiditate recusandae similique pariatur. Excepturi beatae, sequi, repellat placeat ratione laborum tempore assumenda inventore ex debitis esse quis. Cumque ipsa labore accusamus qui quia repellendus voluptate distinctio fuga animi esse ut delectus ullam est, eveniet voluptates perspiciatis.\r\n[img]http://localhost/help/images/vijesti/elder3.jpg[/img]\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Facere culpa beatae nesciunt praesentium? Doloremque quasi sed adipisci molestiae commodi voluptatibus nostrum delectus natus alias quisquam. Consequatur, cupiditate velit veritatis ea sequi soluta eum! Rem deleniti suscipit eligendi distinctio quia, voluptas sapiente mollitia doloremque. Dolorum, sapiente facere unde quibusdam a, cumque quia corporis consequuntur ea qui culpa numquam dolorem neque. Vero eum suscipit praesentium quod nisi obcaecati, voluptatem itaque consectetur officia minus eos harum nesciunt illo animi iusto qui nihil voluptates veniam! Placeat porro adipisci temporibus libero sunt soluta commodi ullam! Voluptatem illum maiores non optio sint repellat adipisci officiis, perspiciatis eum libero cumque, veritatis rem! Animi, earum! Quibusdam voluptate, a, commodi voluptatibus, illo ullam, consequuntur impedit saepe doloremque quisquam alias quis! Sit suscipit dolor qui, quidem fuga excepturi blanditiis minima. Dolores magni minima qui quisquam, inventore sequi quas culpa. Placeat expedita magni eos voluptatum, perspiciatis, error iste beatae exercitationem. Soluta dolorem corrupti culpa, quas laudantium est repellendus alias. Doloremque nostrum incidunt assumenda odit eligendi vero architecto? Non, eveniet, veritatis. Aperiam odit recusandae possimus optio quod minima sit eaque similique adipisci veritatis fuga, accusamus neque nesciunt nobis dicta, aliquid provident pariatur. Nostrum iusto esse sunt quis rerum veritatis! Neque aperiam, sed.', '2018-07-01 00:06:15', 'Administrator');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aktivnosti`
--
ALTER TABLE `aktivnosti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bilten`
--
ALTER TABLE `bilten`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clanarine`
--
ALTER TABLE `clanarine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `istorija_uplata`
--
ALTER TABLE `istorija_uplata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registracija`
--
ALTER TABLE `registracija`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vijesti`
--
ALTER TABLE `vijesti`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aktivnosti`
--
ALTER TABLE `aktivnosti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bilten`
--
ALTER TABLE `bilten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `clanarine`
--
ALTER TABLE `clanarine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `istorija_uplata`
--
ALTER TABLE `istorija_uplata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `registracija`
--
ALTER TABLE `registracija`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `vijesti`
--
ALTER TABLE `vijesti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
