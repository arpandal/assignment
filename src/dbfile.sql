-- Adminer 4.8.1 MySQL 8.0.31 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `admin_id` int NOT NULL AUTO_INCREMENT,
  `fullname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `role` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `admins` (`admin_id`, `fullname`, `username`, `email`, `password`, `role`) VALUES
(12,	'arpan',	'admin1',	'assh@gmail.com',	'$2y$10$E/u0h5xFe7Yd/.fBKGQ16OwP3TnAlHj6ubm3/yJefnbPjVtEa36ri',	'1'),
(14,	'hari',	'AdminM',	'hari@gmail.com',	'$2y$10$eMXTvAs9Zs39bLScrNwfDudSt/iTE2LjaN8j7iCJnuqh2sXTqgOfy',	'1');

DROP TABLE IF EXISTS `articles`;
CREATE TABLE `articles` (
  `article_id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `date` date NOT NULL,
  `image` varchar(100) NOT NULL,
  `category` text NOT NULL,
  `author` int NOT NULL,
  PRIMARY KEY (`article_id`),
  KEY `admin_id` (`author`),
  CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`author`) REFERENCES `admins` (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `articles` (`article_id`, `title`, `description`, `date`, `image`, `category`, `author`) VALUES
(12,	'Detecting breast cancer with AI',	'Breast cancer is becoming more prevalent in low- and middle-income nations, yet early detection screening programs are uncommon.\r\n\r\nA startup in India has created a less expensive, non-invasive test that makes use of AI and thermal imaging.\r\n\r\nThe test is believed to help detect some early malignancies in those who might not otherwise have access to mammography screenings, despite being less reliable than mammography.\r\n\r\nMammography is the best way to test for breast cancer, according to the US FDA.',	'2023-01-30',	'breast AI_63d792f7842da.jpeg',	'51',	12),
(13,	'US charges Google',	'The US Department of Justice (DOJ) and eight US states have filed a case against Google alleging it has too much power over the online ad market.\r\n\r\nIts anti-competitive actions had \"weakened if not destroyed competition in the ad tech industry\", US Attorney General Merrick Garland said.\r\n\r\nGoogle accused the DOJ of \"doubling down on a flawed argument\".\r\n\r\nThe case attempted to \"pick winners and losers\" in a competitive industry, the firm said.\r\n\r\nOnline advertising accounts for the lion\'s share of Google\'s multibillion dollar revenue.\r\n\r\nGoogle is the market leader, but its slice of total US digital ad income has fallen from 36.7% in 2016 to 28.8% in 2022, according to market research firm Insider Intelligence.\r\n\r\n',	'2023-01-30',	'googlee_63d7954ca1627.webp',	'51',	12),
(14,	'Administration of Flybe',	'The airline said it had ceased trading, with 277 out of 321 staff being made redundant.\r\n\r\nSophie is one of 2,500 people who were forced to change their Saturday travel plans last minute.\r\n\r\nShe flew with Flybe on Friday from Newquay in Cornwall to Heathrow, with a return flight scheduled for Sunday.\r\n\r\n\"I will now be getting a train at short notice that will put me out of pocket,\" she told BBC News.\r\n\r\n\"My relaxing weekend turned out to be manic.\"\r\n\r\nSophie is in the Royal Navy, based at RNAS Culdrose in Cornwall, and said she was under pressure to return to her base in time for a promotional course.',	'2023-01-30',	'colormad_63d7968cefa62.jpeg',	'50',	12),
(15,	'Mining giant apologizes for Australia\'s misplaced radioactive capsule',	'We regret the panic that has created, but we understand that this is obviously very concerning,\" the company told the BBC.\r\n\r\nA small amount of radioactive Caesium-137 is present in the casing, and touching it could result in serious disease.\r\n\r\nIt was lost between the cities of Perth and Newman, a distance of around 1,400 kilometers (870 miles).\r\n\r\nSimon Trott, chief executive of Rio Tinto\'s Iron Ore, stated in a statement, \"We have initiated our own inquiry to establish how the capsule was lost in transit, and we fully help the necessary authorities.\"\r\n\r\nIn order to better understand what went wrong in this case, he continued, \"as part of our investigation we are working closely with the contractor.',	'2023-01-30',	'99_63d797bacf1ab.jpeg',	'50',	12),
(16,	'Languages used by wild apes and humans are similar',	'The results of a video-based investigation in which participants interpreted ape motions came to that conclusion.\r\n\r\nResearchers from St. Andrews University conducted it.\r\n\r\nIt implies that comparable gestures were utilized by the last common ancestor between humans and chimpanzees, and that these may have served as the \"beginning point\" for our language.\r\n\r\nThe scholarly publication PLOS Biology features the findings.\r\n\r\nAccording to the study\'s lead author, Dr. Kirsty Graham of St. Andrews University, other great ape species, such as gorillas and orangutans, also use gestures to communicate.',	'2023-01-30',	'cycle_63d7987a6d1dd.jpg',	'45',	12),
(17,	'Object 2023 BU',	'The space rock, 2023 BU, which is about the size of a minibus, whirled across South America\'s southernmost point soon before 03:30 GMT.\r\n\r\nIt qualifies as a close shave at a distance of 3,600 kilometers (2,200 miles) from closest approach.\r\n\r\nAnd it shows how there are still huge asteroids that are close to Earth but have not yet been found.\r\n\r\nGennadiy Borisov, an amateur astronomer who works out of Nauchnyi in Crimea, the peninsula that Russia annexed from Ukraine in 2014, only discovered this one this weekend.\r\n\r\nFollowing observations have improved our understanding of 2023 BU\'s size and, most importantly, its orbit.',	'2023-01-30',	'colormad_63d79904c4f20.jpeg',	'45',	12),
(18,	'Week of Independent Venues',	'The excitement of seeing a live performance, with its raucous throng, thunderous bass, and sweat dripping from the ceilings, has possibly never been more in danger.\r\n\r\nThe Craufurd Arms is crowded, despite the fact that it is a bitterly cold Sunday night in January. The headlining act, the Los Angeles four-piece Dirty Honey, more than justifies their booking by selling out this 270-seat club and drawing fans from around the nation.\r\n\r\nThe tavern and venue have served the Wolverton neighborhood for more than a century under numerous names. But not that long ago, the music in this room full of fans was as muffled as an unplugged guitar amplifier.',	'2023-01-30',	'backg1_63d799af2658b.jpeg',	'48',	12),
(19,	'Barrett Strong, a pioneer and hitmaker in Motown, passed away at age 81',	'He co-wrote timeless songs like I Heard It Through the Grapevine, War, and Papa Was a Rollin\' Stone after singing the label\'s first big success, Money (That\'s What I Want), in 1959.\r\n\r\nIn a written homage to the performer, Berry Gordy, the creator of Motown, stated that the songs were \"revolutionary in sound and captured the spirit of the times.\"\r\n\r\nThe reason of death has not been made public.',	'2023-01-30',	'hari_63d79a3b728d0.jpeg',	'48',	12),
(20,	'The 10th Australian Open, according to Novak Djokovic, was his \"greatest victory.\"',	'Djokovic, 35, defeated Stefanos Tsitsipas in Melbourne after missing the competition the year before due to being expelled for not having received a Covid-19 immunization.\r\n\r\nIn addition, he had to deal with his father\'s argument and a hamstring problem.\r\n\r\nThe Serb claimed that \"only the squad and the family know what we have gone through in the last four or five weeks.\"\r\n\r\n\"Considering such conditions, I would say this is arguably the biggest victory of my life.\"\r\n\r\nAfter defeating third-seeded Greek player Tsitsipas in straight sets on Rod Laver Arena, Djokovic was filled with passion.\r\n\r\nHe climbed into the box to rejoice with his colleagues and family, but as the gravity of his accomplishment set him, he started crying and collapsed in the middle of them.',	'2023-01-30',	'150820163747-profile-background-stock---no-photo-super-tease_63d79aff2047d.jpeg',	'49',	12),
(21,	'Liverpool\'s season of disappointment is still ongoing',	'As Liverpool competed for titles in the Premier League, Champions League, League Cup, and FA Cup a year ago, there was discussion of them perhaps capturing four trophies in a single campaign.\r\n\r\nThey ultimately won the Carabao Cup and the FA Cup, but this season they are in risk of finishing empty-handed since they are unable to produce the high-caliber performances that they had in the past.\r\n\r\nIn the first half, Liverpool\'s counterattack posed a continuous threat to Brighton, and Cody Gakpo displayed encouraging signs of forming a connection with Salah. Liverpool appeared to be in much better shape than they had been during their previous trip to the Amex.',	'2023-01-30',	'kkk_63d79b7d85c30.png',	'49',	12),
(22,	'Pet benefits lure employees back to the workplace',	'The head of IT for marketing firm Rise at Seven, Mr. Griffin, shows up at the company\'s Sheffield offices with Jesse and Oscar, his two animal buddies.\r\n\r\nI\'ve been able to bring both of my collies in thanks to Rise permitting dogs in the office, he claims. \"I get to spend more time at work with my coworkers, and they get to meet new people and have new adventures.\r\n\r\nAs far as I\'m concerned, it\'s a situation where everyone benefits equally.',	'2023-01-30',	'adminlog_63d79f942103a.png',	'47',	12),
(23,	'The cost of living situation in Nigeria causes a medical exodus',	'\"What if you went to the grocery store one day and saw that everything had tripled in price? How exactly do you manage? You live with your family. What do you remove from the spending plan?\" Oroma Cookey Gam informs me by Zoom, her expression blank.\r\n\r\nA year ago, the fashion designer and her small family moved to London, the capital of the UK, from Lagos, the largest metropolis in Nigeria. Her husband and business partner, the artist Osione, was given a Global Talent visa, which permits leaders in digital technology, the arts, and academics to work in the UK.',	'2023-01-30',	'backg5_63d79ff54c19d.jpeg',	'47',	12);

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `category_name` text NOT NULL,
  `post` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `categories` (`category_id`, `category_name`, `post`) VALUES
(45,	'Science',	0),
(47,	'Local News',	0),
(48,	'Entertainment',	0),
(49,	'Sport',	0),
(50,	'Business',	0),
(51,	'Technology',	0);

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `lastname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `username`, `email`, `password`) VALUES
(1,	'sas',	'wq',	'hey',	'ag',	'$2y$10$cGY2HJOEufy6zsLrwM8MhuQMlETwA/MvMbZ1jB2HaRmMrFH9JGpo2'),
(10,	'naan',	'sin ',	'siva',	'sin@gmail.com',	'$2y$10$zbF3efCE7fv41rSoZd1Xn.67l85uspsvKJmfCbIqMtppOX2ahq8rO');

-- 2023-01-30 11:16:02