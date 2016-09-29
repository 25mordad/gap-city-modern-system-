<?php
/**
 * accounting.php
 *
 * This file is part of GCMS > MODULE SQL
 * The file is part of the layer for controlling the system.
 *
 * @author 25Mordad <25Mordad@gmail.com>
 * @author dahdash  <dahdash@gmail.com>
 * @version 2.0
 *
 */


if (!table_exists("gcms_account"))
	run_sql_query();



function table_exists ($table)
{
	$query  = "
	DESCRIBE  `$table`
	";
	$val = mysql_query($query);

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
			CREATE TABLE IF NOT EXISTS `gcms_account` (
			`id` bigint(20) NOT NULL AUTO_INCREMENT,
			`user_id` bigint(20) NOT NULL,
			`title` varchar(255) NOT NULL,
			`fee` varchar(45) NOT NULL,
			`date` date NOT NULL,
			`register_date` datetime NOT NULL,
			`txt` text NOT NULL,
			`id_author` bigint(20) NOT NULL,
			PRIMARY KEY (`id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
			";
	$q[] = "
			CREATE TABLE IF NOT EXISTS `gcms_costs` (
			`id` bigint(20) NOT NULL AUTO_INCREMENT,
			`title` varchar(255) NOT NULL,
			`type` varchar(25) NOT NULL,
			`fee` varchar(45) NOT NULL,
			`txt` text NOT NULL,
			`date` date NOT NULL,
			`regdate` datetime NOT NULL,
			`id_author` bigint(20) NOT NULL,
			PRIMARY KEY (`id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
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
