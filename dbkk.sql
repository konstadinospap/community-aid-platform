create database dbak;
use dbak;

--
-- Δομή πίνακα για τον πίνακα `admin`
--

CREATE TABLE `admin` (
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `id` int(11) NOT NULL,
  `x` float(20,10) NOT NULL,
  `y` float(20,10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `admin` (`username`, `password`, `id`, `x`, `y`) VALUES
('admin', 'admin', 1, 39.2492, 22.84345);



CREATE TABLE `aitimata` (
  `id` int(11) NOT NULL,
  `arithmos_atomwn` int(11) NOT NULL,
  `item` int(11) NOT NULL,
  `date` date NOT NULL,
  `user` int(11) NOT NULL,
  `state` varchar(10) NOT NULL,
  diasostis int(11) not null
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `anakoinosi` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` varchar(400) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `ananoinosi_item` (
  `id` int(11) NOT NULL,
  `item` int(11) NOT NULL,
  `anakoinosi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `details` (
  `id` int(11) NOT NULL,
  `item` int(11) NOT NULL,
  `detail_name` varchar(400) NOT NULL,
  `detail_value` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `diasostis` (
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `id` int(11) NOT NULL,
  `x` float(20,10) NOT NULL,
  `y` float(20,10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(400) NOT NULL,
  `category` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `prosfores` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `posotita` int(11) NOT NULL,
  `item` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `state` varchar(10) NOT NULL,
  `anakoinosi` int(11) NOT NULL,
  diasostis int(11) not null
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `task` (
  `id` int(11) NOT NULL,
  `diasostis` int(11) NOT NULL,
  `date_start` datetime NOT NULL,
  `date_finish` datetime NOT NULL,
  `status` varchar(20) NOT NULL,
  `aitima` int(11) DEFAULT NULL,
  `prosfora` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `x` float(15,10) NOT NULL,
  `y` float(15,10) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



INSERT INTO `user` (`id`, `fullname`, `phone`, `username`, `password`, `x`, `y`, `email`) VALUES
(2, '0', '2147483647', 'kpuser', '12345678', 32.0022315979, 34.0023117065, 'kp@gmail.com'),
(3, 'user1 user1', '222222', 'user1', 'user1', 33.2222213745, 42.1111106873, 'user1@user.gr'),
(4, 'andreas2', '987923487', 'auser2', '12345678', 32.1234550476, 22.3424224854, 'a2@user.gr'),
(5, 'test1', '123432234', 'test1', '1234', 21.7413578033, 38.2543678284, 'test1@gmail.com'),
(7, 'user20', '676342423', 'user20', '12345678', 21.7387790680, 38.2539634705, 'user20@user.gr');


ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);


ALTER TABLE `aitimata`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item` (`item`),
  ADD KEY `user` (`user`);

ALTER TABLE `anakoinosi`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `ananoinosi_item`
--
ALTER TABLE `ananoinosi_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item` (`item`);

--
-- Ευρετήρια για πίνακα `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `details`
--
ALTER TABLE `details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item` (`item`);

--
-- Ευρετήρια για πίνακα `diasostis`
--
ALTER TABLE `diasostis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Ευρετήρια για πίνακα `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`category`);

--
-- Ευρετήρια για πίνακα `prosfores`
--
ALTER TABLE `prosfores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prosfores_ibfk_2` (`item`),
  ADD KEY `anakoinosi` (`anakoinosi`);

--
-- Ευρετήρια για πίνακα `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT για πίνακα `aitimata`
--
ALTER TABLE `aitimata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT για πίνακα `anakoinosi`
--
ALTER TABLE `anakoinosi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT για πίνακα `ananoinosi_item`
--
ALTER TABLE `ananoinosi_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT για πίνακα `details`
--
ALTER TABLE `details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=779;

--
-- AUTO_INCREMENT για πίνακα `diasostis`
--
ALTER TABLE `diasostis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT για πίνακα `prosfores`
--
ALTER TABLE `prosfores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT για πίνακα `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Περιορισμοί για άχρηστους πίνακες
--

--
-- Περιορισμοί για πίνακα `aitimata`
--
ALTER TABLE `aitimata`
  ADD CONSTRAINT `aitimata_ibfk_1` FOREIGN KEY (`item`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `aitimata_ibfk_2` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Περιορισμοί για πίνακα `ananoinosi_item`
--
ALTER TABLE `ananoinosi_item`
  ADD CONSTRAINT `ananoinosi_item_ibfk_1` FOREIGN KEY (`item`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Περιορισμοί για πίνακα `details`
--
ALTER TABLE `details`
  ADD CONSTRAINT `details_ibfk_1` FOREIGN KEY (`item`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Περιορισμοί για πίνακα `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`category`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Περιορισμοί για πίνακα `prosfores`
--
ALTER TABLE `prosfores`
  ADD CONSTRAINT `prosfores_ibfk_2` FOREIGN KEY (`item`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prosfores_ibfk_3` FOREIGN KEY (`anakoinosi`) REFERENCES `anakoinosi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

