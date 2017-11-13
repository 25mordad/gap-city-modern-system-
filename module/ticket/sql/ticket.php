<?php
/**
 * ticket.php
 *
 * This file is part of GCMS > MODULE SQL
 * The file is part of the layer for controlling the system.
 *
 * @author 25Mordad <25Mordad@gmail.com>
 * @author dahdash  <dahdash@gmail.com>
 * @version 2.0
 *
 */


run_sql_query();

function run_sql_query()
{
	$q[] = "

CREATE TABLE `gcms_blockeddate` (
  `id` bigint(20) NOT NULL,
  `id_ticket` bigint(20) NOT NULL,
  `type` varchar(45) NOT NULL,
  `blocktype` varchar(45) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

			";
	$q[] = "
CREATE TABLE `gcms_ticket` (
  `id` bigint(20) NOT NULL,
  `country` varchar(45) NOT NULL,
  `state` varchar(45) NOT NULL,
  `city` varchar(45) NOT NULL,
  `googlemap` varchar(45) NOT NULL,
  `meetingpoint` text NOT NULL,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(45) NOT NULL,
  `bookstatus` varchar(45) NOT NULL,
  `ticketorder` int(10) NOT NULL,
  `facilities` text NOT NULL,
  `duration` varchar(45) NOT NULL,
  `author_id` bigint(20) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

			";
	$q[] = "
CREATE TABLE `gcms_ticketfeature` (
  `id` bigint(20) NOT NULL,
  `id_ticket` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

			";
	$q[] = "
CREATE TABLE `gcms_ticketprice` (
  `id` bigint(20) NOT NULL,
  `id_ticket` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(20,0) NOT NULL,
  `bookingfee` decimal(20,0) NOT NULL,
  `offer` decimal(20,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

			";

	$q[] = "
CREATE TABLE `gcms_tickettime` (
  `id` bigint(20) NOT NULL,
  `id_ticket` bigint(20) NOT NULL,
  `hour` time NOT NULL,
  `available` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

			";

	$q[] = "
CREATE TABLE `gcms_type` (
  `id` bigint(20) NOT NULL,
  `name` varchar(45) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

			";

	$q[] = "
INSERT INTO `gcms_type` (`id`, `name`, `value`) VALUES
(1, 'tickettype', 'Adult'),
(2, 'tickettype', 'Children'),
(3, 'tickettype', 'Students'),
(4, 'ticketfeature', 'Included'),
(5, 'ticketfeature', 'NotIncluded'),
(6, 'else', 'test');

			";

	$q[] = "
ALTER TABLE `gcms_blockeddate`
  ADD PRIMARY KEY (`id`);

			";

	$q[] = "
ALTER TABLE `gcms_ticket`
  ADD PRIMARY KEY (`id`);

			";

	$q[] = "
ALTER TABLE `gcms_ticketfeature`
  ADD PRIMARY KEY (`id`);

			";

	$q[] = "
ALTER TABLE `gcms_ticketprice`
  ADD PRIMARY KEY (`id`);

			";

	$q[] = "
ALTER TABLE `gcms_tickettime`
  ADD PRIMARY KEY (`id`);

			";

	$q[] = "
ALTER TABLE `gcms_type`
  ADD PRIMARY KEY (`id`);

			";

	$q[] = "
ALTER TABLE `gcms_blockeddate`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

			";

	$q[] = "
ALTER TABLE `gcms_ticket`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

			";
	$q[] = "
ALTER TABLE `gcms_ticketfeature`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

			";
	$q[] = "
ALTER TABLE `gcms_ticketprice`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

			";
	$q[] = "
ALTER TABLE `gcms_tickettime`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

			";
	$q[] = "
ALTER TABLE `gcms_type`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
			";

	echo "
			<div style=\"border:1px solid blue; padding:10px; width: 700px; margin:10px auto;\" >
			Install new plugin : ".$_POST['module_name']."<br />
					</div>
					";
	foreach ($q as $row)
	{
		$GLOBALS['GCMS_DB']->query($row);
		echo "
		<div style=\"border:1px solid blue; padding:10px; width: 700px; margin:10px auto;\" >
		query execute :
		<br />$row
		</div>
		";
	}

}

 