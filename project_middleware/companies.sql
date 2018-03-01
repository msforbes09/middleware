CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `code` varchar(1) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `companies` (`id`, `code`, `name`, `created_at`, `updated_at`) VALUES
(1, 'R', 'HRD', '2017-08-08 16:04:54', '2017-08-08 16:04:54'),
(2, 'W', 'WUKONG', '2017-08-08 16:04:54', '2017-08-08 16:04:54'),
(3, 'S', 'SCAD', '2017-08-08 16:06:08', '2017-08-08 16:06:08'),
(4, 'H', 'HTI', '2017-08-08 16:06:08', '2017-08-08 16:06:08'),
(5, 'P', 'PVTECH', '2017-08-08 16:07:03', '2017-08-08 16:07:03'),
(6, 'M', 'MLC', '2017-08-08 16:07:03', '2017-08-08 16:07:03'),
(7, 'E', 'MEC', '2017-08-08 16:07:12', '2017-08-08 16:07:12');

ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;