<?php
/**
 * sarfejo_df_stuff.php
 *
 * This file is part of GCMS > MODULE SQL
 * The file is part of the layer for controlling the system.
 *
 * @author 25Mordad <25Mordad@gmail.com>
 * @author dahdash  <dahdash@gmail.com>
 * @version 2.0
 *
 */


if (!table_exists("gcms_sarfejo_dfstuff"))
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
        }
        */
		return true;
	}else{
		return false;
	}

}

function run_sql_query()
{
    $date = date("Y-m-d",strtotime( "now" ));
    $q[] = "
CREATE TABLE IF NOT EXISTS `gcms_sarfejo_dfstuff` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
			";
    $q[] = "
CREATE TABLE IF NOT EXISTS `gcms_sarfejo_dfstufffee` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_stuff` bigint(20) DEFAULT NULL,
  `fee` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
			";
    $q[] = "
INSERT INTO `gcms_setting` (`id`, `st_group`, `st_key`, `st_value`) VALUES
(null , 'sarfejo_dailyfee', 'sms', 'true'),
(null , 'sarfejo_dailyfee', 'last', $date),
(null , 'sarfejo_dailyfee', 'time', '12:30');
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

 