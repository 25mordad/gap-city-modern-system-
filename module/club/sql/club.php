<?php
/**
 * club.php
 *
 * This file is part of GCMS > MODULE SQL
 * The file is part of the layer for controlling the system.
 *
 * @author 25Mordad <25Mordad@gmail.com>
 * @author dahdash  <dahdash@gmail.com>
 * @version 2.0
 *
 */


if (!table_exists("gcms_itak_user"))
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
			CREATE TABLE IF NOT EXISTS `gcms_itak_card` (
			`id` bigint(20) NOT NULL AUTO_INCREMENT,
			`id_user` bigint(20) DEFAULT NULL,
			`type` varchar(45) DEFAULT NULL,
			`serial` varchar(45) DEFAULT NULL,
			`code` varchar(45) DEFAULT NULL,
			`status` varchar(45) DEFAULT NULL,
			`rate` varchar(45) DEFAULT NULL,
			`info` text,
			`reg_date` datetime DEFAULT NULL,
			`poll_behavior` varchar(45) DEFAULT NULL,
			`poll_txt` text,
			`poll_buy_date` datetime DEFAULT NULL,
			PRIMARY KEY (`id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;
			" ;

	$q[] = "
			CREATE TABLE IF NOT EXISTS `gcms_itak_friend` (
			`id` bigint(20) NOT NULL AUTO_INCREMENT,
			`id_user_refrence` bigint(20) DEFAULT NULL,
			`id_friend` bigint(20) DEFAULT NULL,
			`friend_reg_date` datetime DEFAULT NULL,
			`friend_buy_date` datetime DEFAULT NULL,
			PRIMARY KEY (`id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;
			" ;

	$q[] = "
			CREATE TABLE IF NOT EXISTS `gcms_itak_group` (
			`id` bigint(20) NOT NULL AUTO_INCREMENT,
			`id_manager` bigint(20) DEFAULT NULL,
			`name` varchar(255) DEFAULT NULL,
			`avatar` varchar(45) DEFAULT NULL,
			`date` datetime DEFAULT NULL,
			`status` varchar(45) DEFAULT NULL,
			PRIMARY KEY (`id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;
			" ;

	$q[] = "
			CREATE TABLE IF NOT EXISTS `gcms_itak_group_board` (
			`id` bigint(20) NOT NULL AUTO_INCREMENT,
			`id_group` bigint(20) NOT NULL,
			`id_user` bigint(20) NOT NULL,
			`txt` text,
			`date` datetime DEFAULT NULL,
			PRIMARY KEY (`id`)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
			" ;

	$q[] = "
			CREATE TABLE IF NOT EXISTS `gcms_itak_group_score` (
			`id` bigint(20) NOT NULL AUTO_INCREMENT,
			`id_group` bigint(20) NOT NULL,
			`score` varchar(45) DEFAULT NULL,
			`id_point` bigint(20) DEFAULT NULL,
			`date` varchar(45) DEFAULT NULL,
			PRIMARY KEY (`id`)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
			" ;

	$q[] = "
			CREATE TABLE IF NOT EXISTS `gcms_itak_point` (
			`id` bigint(20) NOT NULL AUTO_INCREMENT,
			`title` varchar(255) DEFAULT NULL,
			`name` varchar(45) DEFAULT NULL,
			`type` varchar(45) DEFAULT NULL,
			`user_rate` bigint(20) DEFAULT NULL,
			`group_rate` bigint(20) DEFAULT NULL,
			PRIMARY KEY (`id`)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
			" ;

	$q[] = "
			CREATE TABLE IF NOT EXISTS `gcms_itak_rel_card_product` (
			`id` bigint(20) NOT NULL AUTO_INCREMENT,
			`id_card` bigint(20) NOT NULL,
			`id_product` bigint(20) NOT NULL,
			PRIMARY KEY (`id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;
			" ;

	$q[] = "
			CREATE TABLE IF NOT EXISTS `gcms_itak_rel_group_user` (
			`id` bigint(20) NOT NULL AUTO_INCREMENT,
			`id_group` bigint(20) NOT NULL,
			`id_user` bigint(20) NOT NULL,
			`status` varchar(45) DEFAULT NULL,
			PRIMARY KEY (`id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;
			" ;

	$q[] = "
			CREATE TABLE IF NOT EXISTS `gcms_itak_user` (
			`id` bigint(20) NOT NULL AUTO_INCREMENT,
			`username` varchar(255) DEFAULT NULL,
			`email` varchar(255) DEFAULT NULL,
			`email_temp_code` varchar(255) DEFAULT NULL,
			`password` varchar(255) DEFAULT NULL,
			`password_salt` varchar(255) DEFAULT NULL,
			`password_attempts_failed` tinyint(4) DEFAULT NULL,
			`password_temp_code` varchar(255) DEFAULT NULL,
			`status` varchar(45) DEFAULT NULL,
			`user_level` varchar(45) DEFAULT NULL,
			`date_created` datetime DEFAULT NULL,
			`name` text,
			`cell` varchar(45) DEFAULT NULL,
			`cell_temp_code` varchar(45) DEFAULT NULL,
			`birth_date` date DEFAULT NULL,
			`gender` varchar(45) DEFAULT NULL,
			`marital` varchar(45) DEFAULT NULL,
			`address` text,
			`avatar` varchar(45) DEFAULT NULL,
			`nickname` varchar(255) DEFAULT NULL,
			`type` varchar(45) DEFAULT NULL,
			PRIMARY KEY (`id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;
			" ;

	$q[] = "
			CREATE TABLE IF NOT EXISTS `gcms_itak_user_score` (
			`id` bigint(20) NOT NULL AUTO_INCREMENT,
			`id_user` bigint(20) NOT NULL,
			`score` varchar(45) DEFAULT NULL,
			`id_point` bigint(20) DEFAULT NULL,
			`date` varchar(45) DEFAULT NULL,
			PRIMARY KEY (`id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;
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

