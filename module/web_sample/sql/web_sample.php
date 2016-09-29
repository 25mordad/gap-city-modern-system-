<?php
/**
 * web_sample.php
 *
 * This file is part of GCMS > MODULE SQL
 * The file is part of the layer for controlling the system.
 *
 * @author 25Mordad <25Mordad@gmail.com>
 * @author dahdash  <dahdash@gmail.com>
 * @version 2.0
 *
 */


if (!table_exists("gcms_web_sample"))
	run_sql_query();



function table_exists ($table)
{
	$query  = "
	DESCRIBE  `$table`
	";
	$val = mysql_query($query);

	if($val !== FALSE)
	{
		// 		FOR CHK STUKCHR
		// 		 while($row = mysql_fetch_array($val))
		// 		 {
		// 		echo "{$row['Field']} - {$row['Type']}\n";
		// 		}
		return true;
	}else{
		return false;
	}

}

function run_sql_query()
{
	$q[] = "
			CREATE TABLE IF NOT EXISTS `gcms_web_sample` (
			`id` bigint(20) NOT NULL AUTO_INCREMENT,
			`name` text NOT NULL,
			`url` varchar(255) NOT NULL,
			`site_status` varchar(45) NOT NULL,
			`activity` text NOT NULL,
			`active_date` date NOT NULL,
			`status` varchar(45) NOT NULL,
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
