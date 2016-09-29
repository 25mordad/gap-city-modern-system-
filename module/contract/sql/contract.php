<?php
/**
 * contract.php
 *
 * This file is part of GCMS > MODULE SQL
 * The file is part of the layer for controlling the system.
 *
 * @author 25Mordad <25Mordad@gmail.com>
 * @author dahdash  <dahdash@gmail.com>
 * @version 2.0
 *
 */


if (!table_exists("gcms_contract"))
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
			CREATE TABLE IF NOT EXISTS `gcms_contract` (
			`id` bigint(20) NOT NULL AUTO_INCREMENT,
			`id_user` bigint(20) NOT NULL,
			`title` varchar(255) NOT NULL,
			`content` text NOT NULL,
			`date` datetime NOT NULL,
			`support_status` varchar(45) NOT NULL,
			`support_type` varchar(45) NOT NULL,
			`host_title` varchar(255) NOT NULL,
			`host_text` text NOT NULL,
			`host_exp_date` datetime NOT NULL,
			`contract_status` varchar(45) NOT NULL,
			`contract_type` varchar(45) DEFAULT NULL,
			`contract_duration` varchar(45) DEFAULT NULL,
			`contract_fee` varchar(45) DEFAULT NULL,
			`contract_pay_type` text,
			PRIMARY KEY (`id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
			";
	$q[] = "
			CREATE TABLE IF NOT EXISTS `gcms_domains` (
			`id` bigint(20) NOT NULL AUTO_INCREMENT,
			`id_contract` bigint(20) NOT NULL,
			`domain_name` varchar(255) NOT NULL,
			`domain_exp` date NOT NULL,
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
