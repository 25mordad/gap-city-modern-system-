<?php
/**
 * product.php
 *
 * This file is part of GCMS > MODULE SQL
 * The file is part of the layer for controlling the system.
 *
 * @author 25Mordad <25Mordad@gmail.com>
 * @author dahdash  <dahdash@gmail.com>
 * @version 2.0
 *
 */


//if (!table_exists("gcms_accountKit"))
	run_sql_query();



function table_exists ($table)
{
	$query  = "
	DESCRIBE  `$table`
	";
	$val = mysqli_query($query);

	if($val !== FALSE)
	{
		/*FOR CHK STUKCHR
		 while($row = mysql_fetch_array($val))
		 {
		echo "{$row['Field']} - {$row['Type']}\n";
		}*/
		return true;
	}else{
		return false;
	}

}

function run_sql_query()
{
	$q[] = "

CREATE TABLE `gcms_accountKit` (
  `id` bigint(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `number` varchar(45) DEFAULT NULL,
  `status` varchar(45) NOT NULL,
  `level` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

			";
	$q[] = "


CREATE TABLE `gcms_accountkitlog` (
  `id` bigint(20) NOT NULL,
  `iduser` bigint(20) NOT NULL,
  `date` datetime NOT NULL,
  `title` varchar(45) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

			";
	$q[] = "

CREATE TABLE `gcms_acountkitparam` (
  `id` bigint(20) NOT NULL,
  `iduser` bigint(20) NOT NULL,
  `type` varchar(45) CHARACTER SET latin1 NOT NULL,
  `text` text CHARACTER SET latin1 NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

			";
	$q[] = "

ALTER TABLE `gcms_accountKit`
  ADD PRIMARY KEY (`id`);

			";
	
	$q[] = "

ALTER TABLE `gcms_accountkitlog`
  ADD PRIMARY KEY (`id`);

			";
	
	$q[] = "

ALTER TABLE `gcms_acountkitparam`
  ADD PRIMARY KEY (`id`);

			";
	
	$q[] = "

ALTER TABLE `gcms_accountKit`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

			";
	
	$q[] = "

ALTER TABLE `gcms_accountkitlog`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

			";
	$q[] = "

ALTER TABLE `gcms_acountkitparam`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

			";
	$q[] = "

INSERT INTO `gcms_setting` ( `st_group`, `st_key`, `st_value`) VALUES
( 'accountkit', 'ak_secret', '0000'),
('accountkit', 'fb_app_id', '0000');

			";
	$q[] = "

INSERT INTO `gcms_routing` ( `url`, `module`, `action`, `action_id`) VALUES
( '/register', 'accountkit', 'register', 0),
( '/dashboard', 'accountkit', 'dashboard', 0)

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

 