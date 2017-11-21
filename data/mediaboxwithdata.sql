

CREATE TABLE `tagcategory` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
);


INSERT INTO `tagcategory` (`id`, `name`) VALUES
(1, 'Departments'),
(2, 'Film / TV / Series'),
(3, 'Classification'),
(4, 'Categories'),
(5, 'Custom tags');


CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `category` int(11) NOT NULL
);

INSERT INTO `tags` (`id`, `name`, `category`) VALUES
(1, 'u', 3),
(2, 'pg', 3),
(3, '12', 3),
(4, '12a', 3),
(5, '15', 3),
(6, '18', 3),
(7, 'english', 1),
(8, 'science', 1),
(9, 'geography', 1),
(10, 'history', 1),
(11, 're', 1),
(12, 'music', 1),
(13, 'drama', 1),
(14, 'dt', 1),
(15, 'ict', 1),
(16, 'maths', 1),
(17, 'mfl', 1),
(18, 'pe', 1),
(19, 'film', 2),
(20, 'tv', 2),
(21, 'series', 2),
(22, 'animation', 4),
(23, 'arts & design', 4),
(24, 'cameras and techniques', 4),
(25, 'comedy', 4),
(26, 'documentary', 4),
(27, 'experimental', 4),
(28, 'fashion', 4),
(29, 'food', 4),
(30, 'instructionals', 4),
(31, 'music', 4),
(32, 'narrative', 4),
(33, 'personal', 4),
(34, 'reporting & journalism', 4),
(35, 'sports', 4),
(36, 'talks', 4),
(37, 'travel', 4);


CREATE TABLE `videos` (
  `id` int(7) NOT NULL,
  `name` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `description` blob NOT NULL,
  `duration` time NOT NULL,
  `thumbnail` varchar(128) NOT NULL,
  `format` varchar(32) NOT NULL,
  `uploadedOn` int(20) NOT NULL
);

CREATE TABLE `videotags` (
  `id` int(11) NOT NULL,
  `videoId` int(11) NOT NULL,
  `tagId` int(11) NOT NULL
);

ALTER TABLE `tagcategory`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`category`);

ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `url` (`url`);


ALTER TABLE `videotags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `videotags_ibfk_1` (`videoId`),
  ADD KEY `videotags_ibfk_2` (`tagId`);



ALTER TABLE `tagcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

ALTER TABLE `videos`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT;

ALTER TABLE `videotags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `tags`
  ADD CONSTRAINT `tags_ibfk_1` FOREIGN KEY (`category`) REFERENCES `tagcategory` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `videotags`
  ADD CONSTRAINT `videotags_ibfk_1` FOREIGN KEY (`videoId`) REFERENCES `videos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `videotags_ibfk_2` FOREIGN KEY (`tagId`) REFERENCES `tags` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

