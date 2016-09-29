<?php
/**
 * adv_wb.php
 *
 * This file is part of GCMS > MODULE SQL
 * The file is part of the layer for controlling the system.
 *
 * @author 25Mordad <25Mordad@gmail.com>
 * @author dahdash  <dahdash@gmail.com>
 * @version 2.0
 *
 */


if (!table_exists("gcms_wb_class"))
	run_sql_query();



function table_exists ($table)
{
	$query  = "
	DESCRIBE  `$table`
	";
	$val = mysql_query($query);

	if($val !== FALSE)
	{
		/* FOR CHK STUKCHR
		 while($row = mysql_fetch_array($val))
		 {
		echo "{$row['Field']} - {$row['Type']}\n";
		} */
		return true;
	}else{
		return false;
	}

}

function run_sql_query()
{
	$q[] = "
			CREATE TABLE IF NOT EXISTS `gcms_wb_branch` (
			`id` bigint(20) NOT NULL AUTO_INCREMENT,
			`name` varchar(255) DEFAULT NULL,
			PRIMARY KEY (`id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
			" ;

	$q[] = "
			CREATE TABLE IF NOT EXISTS `gcms_wb_class` (
			`id` bigint(20) NOT NULL AUTO_INCREMENT,
			`id_grade` bigint(20) DEFAULT NULL,
			`name` varchar(255) DEFAULT NULL,
			`capacity` varchar(4) DEFAULT NULL,
			`text` text,
			`id_branch` bigint(20) DEFAULT NULL,
			`ages` varchar(45) DEFAULT NULL,
			`sex` varchar(45) DEFAULT NULL,
			`tuition` varchar(45) DEFAULT NULL,
			PRIMARY KEY (`id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
			" ;

	$q[] = "
			CREATE TABLE IF NOT EXISTS `gcms_wb_grade` (
			`id` bigint(20) NOT NULL AUTO_INCREMENT,
			`name` varchar(255) DEFAULT NULL,
			`id_year` bigint(20) DEFAULT NULL,
			PRIMARY KEY (`id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
			" ;

	$q[] = "
			CREATE TABLE IF NOT EXISTS `gcms_wb_lesson` (
			`id` bigint(20) NOT NULL AUTO_INCREMENT,
			`name` varchar(255) DEFAULT NULL,
			`id_parent` bigint(20) DEFAULT NULL,
			`rate` varchar(5) DEFAULT NULL,
			`code` varchar(45) DEFAULT NULL,
			`accept_score` varchar(45) DEFAULT NULL,
			PRIMARY KEY (`id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
			" ;

	$q[] = "
			CREATE TABLE IF NOT EXISTS `gcms_wb_rel_class_lesson` (
			`id` bigint(20) NOT NULL AUTO_INCREMENT,
			`id_class` bigint(20) NOT NULL,
			`id_lesson` bigint(20) NOT NULL,
			PRIMARY KEY (`id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
			" ;

	$q[] = "
			CREATE TABLE IF NOT EXISTS `gcms_wb_rel_class_student` (
			`id` bigint(20) NOT NULL AUTO_INCREMENT,
			`id_class` bigint(20) NOT NULL,
			`id_student` bigint(20) NOT NULL,
			PRIMARY KEY (`id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
			" ;

	$q[] = "
			CREATE TABLE IF NOT EXISTS `gcms_wb_rel_class_teacher` (
			`id` bigint(20) NOT NULL AUTO_INCREMENT,
			`id_class` bigint(20) NOT NULL,
			`id_teacher` bigint(20) NOT NULL,
			PRIMARY KEY (`id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
			" ;

	$q[] = "
			CREATE TABLE IF NOT EXISTS `gcms_wb_score` (
			`id` bigint(20) NOT NULL AUTO_INCREMENT,
			`id_rel_class_lesson` bigint(20) NOT NULL,
			`type` varchar(45) NOT NULL,
			`title` varchar(255) NOT NULL,
			PRIMARY KEY (`id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
			" ;

	$q[] = "
			CREATE TABLE IF NOT EXISTS `gcms_wb_score_student` (
			`id` bigint(20) NOT NULL AUTO_INCREMENT,
			`id_score` bigint(20) NOT NULL,
			`id_student` bigint(20) NOT NULL,
			`number` varchar(45) NOT NULL,
			PRIMARY KEY (`id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
			" ;

	$q[] = "
			CREATE TABLE IF NOT EXISTS `gcms_wb_teacher` (
			`id` bigint(20) NOT NULL AUTO_INCREMENT,
			`name` varchar(255) DEFAULT NULL,
			`txt` text,
			PRIMARY KEY (`id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
			" ;

	$q[] = "
			CREATE TABLE IF NOT EXISTS `gcms_wb_year` (
			`id` bigint(20) NOT NULL AUTO_INCREMENT,
			`name` varchar(45) DEFAULT NULL,
			`default` varchar(45) DEFAULT NULL,
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
