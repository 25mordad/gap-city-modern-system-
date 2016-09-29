<?php
/**
 * discount.php
 *
 * This file is part of GCMS > MODULE SQL
 * The file is part of the layer for controlling the system.
 *
 * @author 25Mordad <25Mordad@gmail.com>
 * @author dahdash  <dahdash@gmail.com>
 * @version 2.0
 *
 */


if (!table_exists("gcms_shiraz_discount"))
	run_sql_query();



function table_exists ($table)
{
	$query  = "
	DESCRIBE  `$table`
	";
	$val = mysql_query($query);

	if($val !== FALSE)
	{/* 
		FOR CHK STUKCHR
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
CREATE TABLE IF NOT EXISTS `gcms_shiraz_discount` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_group` bigint(20) DEFAULT NULL,
  `title` text,
  `real-price` varchar(45) DEFAULT NULL,
  `discount_percent` varchar(45) DEFAULT NULL,
  `expire_date` datetime DEFAULT NULL,
  `max_sell` varchar(45) DEFAULT NULL,
  `type_delivery` varchar(45) DEFAULT NULL,
  `plus_count` varchar(45) DEFAULT NULL,
  `shop_name` varchar(255) DEFAULT NULL,
  `shop_address` text,
  `shop_tell` varchar(45) DEFAULT NULL,
  `shop_cell` varchar(45) DEFAULT NULL,
  `latitude` varchar(45) DEFAULT NULL,
  `longitude` varchar(45) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `shop_specification` text,
  `ismoment` varchar(45) DEFAULT NULL,
  `text` text,
  `info` text,
  `conditions` text,
  `status` varchar(45) DEFAULT NULL,
  `id_user_seller` bigint(20) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `code` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
     " ;

    $q[] = "
CREATE TABLE IF NOT EXISTS `gcms_shiraz_discount_comment` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_discount` bigint(20) DEFAULT NULL,
  `id_user` bigint(20) DEFAULT NULL,
  `text` text,
  `created_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
     " ;

    $q[] = "

CREATE TABLE IF NOT EXISTS `gcms_shiraz_discount_group` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
     " ;

    $q[] = "
CREATE TABLE IF NOT EXISTS `gcms_shiraz_rel_discount_user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_discount` bigint(20) DEFAULT NULL,
  `id_user` bigint(20) DEFAULT NULL,
  `date_sell` datetime DEFAULT NULL,
  `coupon_no` varchar(255) DEFAULT NULL,
  `coupon_pass` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
			
			";
    $q[] = "

CREATE TABLE IF NOT EXISTS `gcms_shiraz_booking` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_user` bigint(20) DEFAULT NULL,
  `id_discount` bigint(20) DEFAULT NULL,
  `no` varchar(45) DEFAULT NULL,
  `pay` varchar(45) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `fr_name` varchar(255) DEFAULT NULL,
  `fr_email` varchar(255) DEFAULT NULL,
  `fr_cell` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
			
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

 