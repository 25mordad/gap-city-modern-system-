<?php
/**
 * jobinfo.php
 *
 * This file is part of GCMS > MODULE SQL
 * The file is part of the layer for controlling the system.
 *
 * @author 25Mordad <25Mordad@gmail.com>
 * @author dahdash  <dahdash@gmail.com>
 * @version 2.0
 *
 */

 
if (!table_exists("gcms_sarfejo_jobinfo"))
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
CREATE TABLE IF NOT EXISTS `gcms_sarfejo_comment` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_user` bigint(20) DEFAULT NULL,
  `id_service` bigint(20) DEFAULT NULL,
  `text` text,
  `status` varchar(45) DEFAULT NULL,
  `plus` int(11) DEFAULT NULL,
  `minus` int(11) DEFAULT NULL,
  `score` varchar(45) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
			";
	$q[] = "
CREATE TABLE IF NOT EXISTS `gcms_sarfejo_comment_rel_user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_user` bigint(20) DEFAULT NULL,
  `id_comment` bigint(20) DEFAULT NULL,
  `user_action` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
			";
	$q[] = "
CREATE TABLE IF NOT EXISTS `gcms_sarfejo_compare` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_user` bigint(20) DEFAULT NULL,
  `id_service` bigint(20) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
			";
	$q[] = "
CREATE TABLE IF NOT EXISTS `gcms_sarfejo_img` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_parent` bigint(20) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `path` text,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
			";
	$q[] = "
CREATE TABLE IF NOT EXISTS `gcms_sarfejo_jobgroup` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `type` varchar(45) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `parent` bigint(20) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
			";
	$q[] = "
CREATE TABLE IF NOT EXISTS `gcms_sarfejo_jobinfo` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_user` bigint(20) DEFAULT NULL,
  `co_name` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `address` text,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `tell` varchar(45) DEFAULT NULL,
  `cell` varchar(45) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modify_date` datetime DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
			";
	$q[] = "
CREATE TABLE IF NOT EXISTS `gcms_sarfejo_jobparam` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_group` bigint(20) DEFAULT NULL,
  `en_name` varchar(255) DEFAULT NULL,
  `fa_name` varchar(255) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
			";
	$q[] = "
CREATE TABLE IF NOT EXISTS `gcms_sarfejo_jobparamextra` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_jobparam` bigint(20) DEFAULT NULL,
  `fa_name` varchar(255) DEFAULT NULL,
  `en_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
			";
	$q[] = "
CREATE TABLE IF NOT EXISTS `gcms_sarfejo_lik_fav` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_user` bigint(20) DEFAULT NULL,
  `id_service` bigint(20) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
			";
	$q[] = "
CREATE TABLE IF NOT EXISTS `gcms_sarfejo_search` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `search` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
			";
	$q[] = "
CREATE TABLE IF NOT EXISTS `gcms_sarfejo_search_rel_user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_user` bigint(20) DEFAULT NULL,
  `id_search` bigint(20) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
			";
	$q[] = "
CREATE TABLE IF NOT EXISTS `gcms_sarfejo_service` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `type` varchar(45) DEFAULT NULL,
  `id_group` bigint(20) DEFAULT NULL,
  `id_user` bigint(20) DEFAULT NULL,
  `id_jobinfo` bigint(20) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `text` text,
  `fee` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `admin_rank` varchar(45) DEFAULT NULL,
  `user_rank` varchar(45) DEFAULT NULL,
  `visitor` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modify_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
			";
	$q[] = "
CREATE TABLE IF NOT EXISTS `gcms_sarfejo_service_rel_param` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_service` bigint(20) DEFAULT NULL,
  `id_param` bigint(20) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
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
