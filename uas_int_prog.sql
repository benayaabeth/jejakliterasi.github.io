-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2025 at 02:13 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uas_int_prog`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `synopsis` text NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `price` double(8,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `pdf_file` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `synopsis`, `kategori`, `price`, `image`, `pdf_file`, `created_at`, `updated_at`) VALUES
(8, 'Bill Gates. Microsoft Founder and Philanthropist', 'Marylou Morano Kjelle', 'Every day, people are making headlines for their extraordinary actions. Each book in the Newsmakers series tells the story of an incredible individual who has changed the course of history in some significant way.\r\nLearn all about the people who have made an impact on the world through their efforts in social justice, technology, politics, and more.', 'Biografi', 5000.00, 'ah8x3ujzBbBi56tndZIZ5x7XvaanFckdN7P5rsiF.jpg', 'DDXzTnsQNUqMCUnAPgQXyz7fxpZ9OwaHVPWfNo2m.pdf', NULL, NULL),
(9, 'Entrepreneur Jack Ma, Alibaba and the 40 Thieves of Success', 'Think Maverick, Winson Ng', 'Pada saat banyak perusahaan Amerika lebih tertarik mengejar keuntungan bisnisnya dengan cara yang mudah, daripada harus mengambil risiko besar dengan mengusahakan sebuah teknologi radikal, Musk berdiri dengan tegap dan menjadi satu-satunya pebisnis yang mengambil alih-bahkan merevolusi-tiga bidang industri sekaligus: teknologi, transportasi, dan ruang angkasa. PayPal, Zip2, Tesla Inc., SpaceX, dan SolarCity adalah perusahaan yang berhasil dia rintis dari nol. Selanjutnya, Musk berambisi untuk mengirimkan koloni manusia pertama untuk menghuni Mars pada 2025. Ini bukan ide gila, Musk akan benar-benar merencanakan dan mengerahkan seluruh kemampuannya untuk mewujudkan semua impiannya menjadinyata. \"Setelah membaca karya ini hingga halaman terakhir, setiap pembaca pasti akan membandingkan Musk dengan Steve Jobs. Berikan kredit untuk Musk. Tidak ada yang seperti dia.\" --New York Times Book Review \"Biografi yang sangat baik dan unggul daiam dua hal. Pertama, mereka memberikan banyak cerita lucu dengan semangat, yang belum diberitahukan kepada orang lain sebelumnya. Kedua, buku ini menjeiaskan semua lika-liku dan jejak keliru yang dialami seorang tokoh, dalam penggambaran yang dibuat begitu utuh dan fokus. Vance memberikan begitu banyak wawasan tentang bagaimana perusahaan berteknologi raksasa ini dijalankan ...\" --Forbes \"Ashlee Vance menawarkan sudut pandang yang jelas dari seorang pria yang telah memainkan lahan bisnis yang dipandang sebelah mata, lagi dan lagi--menggebrak pemikiran-pemikiran lama dan mengubah dunia. Saya menantang orang yang membaca buku ini dan tidak terinspirasiuntuk menetapkan impian mereka sedikit lebih tinggi.\" --Tony Fadell, kreator iPod dan iPhone, CEO Nest Labs', 'Biografi', 5000.00, 'lzg2ZQeK88cUnmOFM2KEPLqSslGyBHCnojlXAJhZ.jpg', 'JdyCBUA0cfCvQHjBHgpaW2xA7J3IYsZwVEa7TeX6.pdf', NULL, NULL),
(10, 'Mark Zuckerberg. Creator of Facebook', 'Jamie Weil', 'Siapa yang tak mengenal Facebook dan Instagram? Dua media sosial populer tersebut merupakan hasil ciptaan Mark Zuckerberg, yang kini berada di antara deretan orang terkaya di dunia. Namun, pencapaian tersebut tidak didapatkan Mark Zuckerberg secara instan. Lantas, apa saja yang dilakukan Mark Zuckerberg hingga bisa sukses dan menjadi milyuner? Temukan jawabannya dalam buku “101 Ide Gila Jadi Tajir Melintir Ala Zuckerberg: Hanya yang Gila yang Berani Kaya”. Buku karya Kalani Niran ini mengupas ide-ide gila yang dapat dilakukan untuk meraih kesuksesan. Sinopsis Buku Facebook, media massa dengan pengguna terbanyak di dunia ini berawal dari sebuah proyek kecil-kecilan seorang mahasiswa. Tapi berkat ketelatenan dan keseriusan pembuatnya, proyek “minim dana” ini mampu menjaring untung yang tak main-main, dan membawa pemiliknya ke level The Youngest Self-Made Billionaire pada tahun 2008, dengan pendapatan mencapai US$ 62 miliar. Saat ini, Mark Zuckerberg selalu ada dalam jajaran orang-orang terkaya di dunia. Terlepas dari ide briliannya soal “menghubungkan” orang-orang di seluruh pelosok bumi, kita tak boleh melupakan usaha, kegigihan, serta kerja keras seorang Zuckerberg muda. Apa saja yang dilakukannya? Buku ini akan mengupas secara menyeluruh mengenai Mark Zuckerberg, usahanya mendirikan kerajaan Facebook, hingga ide-ide gilanya. Mencapai 101 ide gila! Terserah Anda untuk membaca dan kemudian melewatkannya, atau membaca dan kemudian menerapkannya dalam usaha Anda sendiri. Yang pasti, 101 ide gila ini takkan pernah Anda temukan dalam buku lain mana pun! Selamat menempuh jalur sukses ala milyuner, dan yang pasti, selamat menggila!', 'Biografi', 5000.00, '63NrOE3TDaJSvCbithJk3UmXuwWiajCS30qHNASx.jpg', '2TtlKVKA6zmW56j2qU4pqEtgcGeKfw8swB62dm62.pdf', NULL, NULL),
(11, 'Millionaire Mindset 03', 'Mardigu Wowiek Prasantyo', 'Ingkat kemakmuran kita telah diprogram sebelumnya oleh pola pikir dan perilaku yang kita pelajari sejak kecil . Kita hanya dapat mengubahnya jika kita secara sadar mengenalinya, secara aktif mengadopsi sikap baru, dan menanamkan \"pemikiran jutawan\" ke dalam pikiran kita', 'Biografi', 5000.00, 'Zrh6EJIT5JsU9dz7tUuQ0IGtVQLr1pe9lVPT07O1.jpg', '6PDabv4FD2lEYIn6QfPlybpE3IQgxzIcau6MzQEB.pdf', NULL, NULL),
(12, 'Elon Musk', 'Ashlee Vance', 'Pada saat banyak perusahaan Amerika lebih tertarik mengejar keuntungan bisnisnya dengan cara yang mudah, daripada harus mengambil risiko besar dengan mengusahakan sebuah teknologi radikal, Musk berdiri dengan tegap dan menjadi satu-satunya pebisnis yang mengambil alih-bahkan merevolusi-tiga bidang industri sekaligus: teknologi, transportasi, dan ruang angkasa. PayPal, Zip2, Tesla Inc., SpaceX, dan SolarCity adalah perusahaan yang berhasil dia rintis dari nol. Selanjutnya, Musk berambisi untuk mengirimkan koloni manusia pertama untuk menghuni Mars pada 2025. Ini bukan ide gila, Musk akan benar-benar merencanakan dan mengerahkan seluruh kemampuannya untuk mewujudkan semua impiannya menjadinyata. \"Setelah membaca karya ini hingga halaman terakhir, setiap pembaca pasti akan membandingkan Musk dengan Steve Jobs. Berikan kredit untuk Musk. Tidak ada yang seperti dia.\" --New York Times Book Review \"Biografi yang sangat baik dan unggul daiam dua hal. Pertama, mereka memberikan banyak cerita lucu dengan semangat, yang belum diberitahukan kepada orang lain sebelumnya. Kedua, buku ini menjeiaskan semua lika-liku dan jejak keliru yang dialami seorang tokoh, dalam penggambaran yang dibuat begitu utuh dan fokus. Vance memberikan begitu banyak wawasan tentang bagaimana perusahaan berteknologi raksasa ini dijalankan ...\" --Forbes \"Ashlee Vance menawarkan sudut pandang yang jelas dari seorang pria yang telah memainkan lahan bisnis yang dipandang sebelah mata, lagi dan lagi--menggebrak pemikiran-pemikiran lama dan mengubah dunia. Saya menantang orang yang membaca buku ini dan tidak terinspirasiuntuk menetapkan impian mereka sedikit lebih tinggi.\" --Tony Fadell, kreator iPod dan iPhone, CEO Nest Labs', 'Biografi', 5000.00, '3Hjjbu7ndN3T2gM2vHoic33EhYc3OTtq0dujv017.jpg', 'xH6anLo6GpKZmv1wxIkvGOx5sTBYNn3zQOarTUk7.pdf', NULL, NULL),
(13, 'Ensiklopedia Dunia Fauna 3 Fakta Unik dan Menakjubkan Seputar Dunia Hewan', 'Tim Penulis Animalbooks', 'Selain manusia, hewan adalah makhluk dengan jumlah besar yang juga menghuni planet ini.\r\nJumlahnya bahkan dipercaya melebihi populasi manusia. Sebagai ilustrasi, di Cina saja ada\r\ntiga miliar ekor ayam, sementara ayam di Amerika mencapai jumlah sekitar setengah juta\r\nekor. Selain itu, dalam setiap hektar wilayah diperkirakan terdapat 5 juta laba-laba, dan dalam\r\nsetiap meter persegi padang rumput terdapat sekitar 700 ekor cacing tanah.\r\nSelain hewan-hewan yang tersebut di atas, masih banyak hewan lain yang hidup di udara,\r\ndi kedalaman laut, di hutan, di dalam tanah, di padang pasir, di gua-gua, bahkan di daerah\r\nkutub yang tak dihuni manusia. Di sekitar kita, hewan-hewan juga biasa berkeliaran, dari\r\ncicak, kecoa, kucing, anjing, hingga kadal dan kupu-kupu.\r\nBanyaknya jumlah hewan tersebut juga memiliki keragaman jenis, spesies, kelebihan, serta\r\n\r\nkeunikannya masing-masing, yang bahkan mungkin belum kita tahu atau bayangkan. Kunang-\r\nkunang, misalnya, memiliki kemampuan mengeluarkan cahaya yang melebihi kemampuan\r\n\r\nteknologi manusia. Cahaya kunang-kunang memiliki panjang gelombang 510 sampai 670\r\nnanometer, dengan warna merah pucat, kuning, atau hijau, dengan efi siensi sinar sampai 96\r\npersen.\r\nYang mengagumkan, kemampuan kunang-kunang dalam menghasilkan cahaya itu tidak\r\nberefek panas pada tubuhnya. Artinya, meski tubuhnya memancarkan sinar atau cahaya,\r\ntetapi kunang-kunang tidak menjadi kepanasan karenanya. Hal itu melampaui teknologi\r\nmanusia, karena cahaya yang dihasilkan oleh teknologi manusia selalu menimbulkan efek\r\npanas—misalnya bola lampu atau neon yang akan memanas atau terasa panas setelah\r\nmemancarkan cahaya.\r\n\r\nSelain kunang-kunang, tak terhitung jumlah hewan lain yang juga memiliki kemampuan-\r\nkemampuan unik dan menakjubkan—seperti belut yang mampu menghasilkan energi listrik,\r\n\r\nkecoa yang dapat hidup berhari-hari tanpa kepala, ngengat yang dapat mengenali jodohnya\r\ndari jarak bermil-mil, hingga lumba-lumba yang memiliki pendengaran ultrasonik.\r\nBuku ini memuat fakta-fakta menarik seputar hewan, yang akan menambah wawasan,\r\npengetahuan, serta memukau kita. Dikemas dalam bahasa yang mudah dipahami, buku ini\r\nmenguraikan banyak hal menakjubkan dari planet fauna.', 'Ensiklopedia', 5000.00, 'eVE4CCbYY7WoWuQyNeaKHpNHQOy09QovrQad9b7t.jpg', 'lICgMZYxMHWaxAayfzaXkQfQAcOdaV1PaQQWNzxS.pdf', NULL, NULL),
(14, 'Ensiklopedia Indikator Ekonomi dan Sosial', 'Tim Penyusun Z-Library', 'Dalam kerangka teoritis, strategi pembangunan mutlak memerlukan serangkaian\r\nperencanaan yang terstruktur, realisasi yang tepat dan efisien, monitoring secara\r\nberkala, serta evaluasi yang akurat. Usaha tersebut harus dibarengi dengan segala daya\r\nuntuk meletakkan landasan yang kuat agar pembangunan tahap berikutnya dapat\r\nmenjadi lebih terarah dan lancar. Tahapan penting dari proses pembangunan yang\r\nmemerlukan perhatian secara khusus yakni evaluasi terhadap kinerja pembangunan.\r\nHal ini penting karena keberhasilan suatu pembangunan dapat dilihat berdasarkan\r\npencapaian tujuan yang telah ditetapkan dalam perencanaan. Untuk memonitor\r\npencapaian yang telah diraih, diperlukan suatu alat ukur yang mampu merangkum\r\ndinamika pembangunan dalam kurun waktu tertentu. Alat ukur tersebut biasanya\r\ndapat berupa angka‐angka yang mampu memberikan gambaran, mengindikasikan\r\nseberapa dekat pencapaian tujuan yang ingin diraih. Indikator yang tepat, akurat, valid\r\ndan reliabel dapat digunakan sebagai alat ukur yang relevan dalam memonitor\r\npencapaian pembangunan sehingga hal‐hal sentral yang menjadi titik berat\r\npembangunan dapat lebih difokuskan.', 'Ensiklopedia', 5000.00, 'FvsNDrmDzqfBtndJAzdpx1Yq6lGjQjkxxEspvA6y.jpg', 'Er6pik90VYMWGTqkYhrai8OZ7Lh6x40VoWAUZoYq.pdf', NULL, NULL),
(15, 'Debu Bintang Menjelajahi Tata Surya', 'Bailey Harris, Douglas Harris', 'Ingkat kemakmuran kita telah diprogram sebelumnya oleh pola pikir dan perilaku yang kita pelajari sejak kecil . Kita hanya dapat mengubahnya jika kita secara sadar mengenalinya, secara aktif mengadopsi sikap baru, dan menanamkan \"pemikiran jutawan\" ke dalam pikiran kita', 'Ensiklopedia', 5000.00, 'g1zwPcVaS1VzPQUEkNa7N3syMUyOcaoCORwCGrb8.png', 'VCVI4fJqslLGUwsEeGP3T5qsO4vBBseJsc9FIRGX.pdf', NULL, NULL),
(16, 'Serangga dan Penyengat Ensiklopedia Ku', 'Tim EnsiklopediaKu', 'Dengan ensiklopedia ini, kamu bisa menemukan pengetahuan yang akan menambah wawasan. Kamu juga akan mengenal berbagai hal baru, baik dalam bidang sains, teknologi, dunia hewan, maupun kebudayaan dari berbagai penjuru dunia. Berikut ini adalah petunjuk cara menggunakan ensiklopedia ini. Selamat menjelajah!', 'Ensiklopedia', 5000.00, 'myi0W25AAnAYM1OutmaQsIspDHLcK3wnBt0xzY4Q.jpg', 'kbx2RHj8ePVuxOtvOccrcrY0pto6kWAFcw9jF8ut.pdf', NULL, NULL),
(17, 'The-Encyclopedia-of-Philosophy-2nd-Ed.-Vol.-1', 'Donald M. Borchert', 'When Macmillan invited me to serve as editor in\r\nchief for the new ten-volume Second Edition, the task\r\nappeared daunting because of its magnitude. But it also\r\n\r\nseemed manageable because backing me up was a valu-\r\nable learning experience I had as the editor in chief for\r\n\r\nMacmillan’s single-volume Supplement, published in\r\n1996, that updated the Encyclopedia. Among the insights\r\nI gained from that experience three were especially\r\nimportant.', 'Ensiklopedia', 5000.00, 'UkYPfb8OJ3FKUlJEXTu4ZJD6ZWq01s31OQBNMqn6.jpg', '7qe4DlWKA34G6V1bot2zCF3tgjyiCJ2s0HIblTwa.pdf', NULL, NULL),
(18, 'Tere Liye - Bulan', 'Tere Liye', 'Namanya Seli, usianya 15 tahun, kelas sepuluh. Dia sama seperti\r\nremaja yang lain. Menyukai hal yang sama, mendengarkan\r\nlagu-lagu yang sama, pergi ke gerai fast food, menonton serial\r\ndrama, film, dan hal-hal yang disukai remaja.\r\n\r\nTetapi ada sebuah rahasia kecil Seli yang tidak pernah diketahui\r\nsiapa pun. Sesuatu yang dia simpan sendiri sejak kecil. Sesuatu\r\nyang menakjubkan dengan tangannya.\r\n\r\nNamanya Seli. Dan tangannya bisa mengeluarkan petir.', 'Fiksi', 5000.00, 'JYOzL7iFSMYTs03pDPIBT5ki1aB5YTfDY7L5ccOw.jpg', 'yM48UGzLj897Gjvl1cerDTPYat5NNAof9d5XDTrm.pdf', NULL, NULL),
(19, 'Tere Liye - Bumi', 'Tere Liye', 'Raib, gadis istimewa keturunan Klan Bulan, memiliki kemampuan menghilang dan mewarisi Buku Kehidupan yang membuka portal ke dunia lain. Seli, sang penjinak api dari Klan Matahari, dikenal tekadnya yang kuat dan pantang menyerah. \r\n \r\nSementara Ali, pemuda pemberani dari Klan Bumi, memiliki kemampuan unik berkomunikasi dengan hewan. Mereka saling menyadari memiliki kekuatan super ketika terjadi insiden tower listrik di sekolah jatuh menimpa mereka.\r\n \r\nAlih-alih celaka, ketiganya mampu mengendalikan jatuhnya tiang listrik dan membuat Tamus mengetahui keberadaan mereka. Tamus adalah sosok kejam yang berambisi menguasai dunia. Untunglah mereka diselamatkan sang guru Matematika.\r\n \r\nNamun aksi penyelamatan itu justru menjadi awal petualangan Raib, Seli, dan Ali di dunia paralel. Mereka pun menjelajahi tempat menakjubkan yaitu Klan Bulan yang futuristik, Klan Matahari di gurun misterius dan Klan Bumi yang rimbun oleh hutan.\r\n \r\nDi sepanjang petualangan, mereka dihadapkan pada berbagai rintangan dan bahaya. Mulai dari menghadapi monster mengerikan, memecahkan teka-teki rumit, hingga melawan pasukan Tamus yang kejam. \r\n \r\nMeski begitu, mereka juga bertemu dengan berbagai karakter fantastis yang membantu. Membawa mereka semakin dekat untuk mengungkap rahasia di balik dunia paralel dan menemukan cara untuk mengalahkan Tamus.', 'Fiksi', 5000.00, '4oFIq30Rd209u4PQFN56PNdjezlF54a74siLT9U6.jpg', 'u3vCz0dIidJz4jYB9TNWeeQ0UwT6jDFBQDm3L9Mb.pdf', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `book_id`, `quantity`, `created_at`, `updated_at`) VALUES
(19, 1, 13, 1, '2025-01-06 18:05:14', '2025-01-06 18:05:14');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2025_1_1_000001_create_users_table', 1),
(3, '2025_1_1_000002_create_books_table', 1),
(4, '2025_1_1_000003_create_orders_table', 1),
(5, '2025_1_1_000004_create_order_details_table', 1),
(6, '2025_01_05_155824_create_carts_table', 2),
(7, '2025_01_05_000005_create_carts_table', 3),
(8, '2025_01_05_190821_modify_status_column_in_orders_table', 4),
(9, '2025_01_05_192516_create_temporary_order_details_table', 5),
(10, '2025_01_05_223021_add_profile_photo_to_users_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `total_price` double(8,2) NOT NULL,
  `status` enum('Pending','verified','rejected','Selesai') NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_price`, `status`, `created_at`, `updated_at`) VALUES
(13, 1, 5000.00, 'verified', '2025-01-06 09:04:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `price` double(8,2) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `book_id`, `price`, `quantity`) VALUES
(6, 13, 8, 5000.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `temporary_order_details`
--

CREATE TABLE `temporary_order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_photo` varchar(255) DEFAULT NULL,
  `level` enum('admin','user') NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`, `profile_photo`, `level`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'BENAYA ABETH WIDYADANA', 'benayaabeth08@gmail.com', 'benn', '$2y$10$gvnh8yPKwJwCKBbz1AxTS.qEYvyQftJzRloC488C9EW6F/eMDVhry', '1736208007_677c6e87b1c9a.jpg', 'user', NULL, '2025-01-04 22:10:41', '2025-01-06 17:00:07'),
(2, 'admin', '23k10065@student.unika.ac.id', 'admin', '$2y$10$Tmeveh.0WBXioV27CzZV/ePQAQ0PTJsFIWhSvCq.1kgoqLpNPaimW', NULL, 'admin', NULL, '2025-01-04 22:10:41', '2025-01-04 22:10:41'),
(3, 'Novalden Petra Perdana', '23k10035@student.unika.ac.id', 'Petra', '$2y$10$kePNR3aIvbpLjRmh818Iv.41NAWbpBIUCX3253Q2m8uQEXvJbVwYK', NULL, 'user', NULL, '2025-01-05 00:09:03', '2025-01-05 14:17:46'),
(4, 'Yosa', 'yosasurya@gmail.com', 'yoss', '$2y$10$BHCrdJwXrYHtV3YTeURWFO2jZ.Gi0dNH2ubQY3wMnaEcp0ZPTEbuS', NULL, 'user', NULL, '2025-01-05 15:36:28', '2025-01-05 15:49:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `carts_user_id_book_id_unique` (`user_id`,`book_id`),
  ADD KEY `carts_book_id_foreign` (`book_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_details_order_id_foreign` (`order_id`),
  ADD KEY `order_details_book_id_foreign` (`book_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `temporary_order_details`
--
ALTER TABLE `temporary_order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `temporary_order_details_order_id_foreign` (`order_id`),
  ADD KEY `temporary_order_details_book_id_foreign` (`book_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `temporary_order_details`
--
ALTER TABLE `temporary_order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `temporary_order_details`
--
ALTER TABLE `temporary_order_details`
  ADD CONSTRAINT `temporary_order_details_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `temporary_order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
