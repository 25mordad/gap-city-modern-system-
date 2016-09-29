<?php
/**
 * packaging.php
 *
 * This file is part of GCMS > MODULE SQL
 * The file is part of the layer for controlling the system.
 *
 * @author 25Mordad <25Mordad@gmail.com>
 * @author dahdash  <dahdash@gmail.com>
 * @version 2.0
 *
 */

/* 
if (!table_exists("gcms_SAMPLE"))
	run_sql_query();



function table_exists ($table)
{
	$query  = "
	DESCRIBE  `$table`
	";
	$val = mysql_query($query);

	if($val !== FALSE)
	{
		FOR CHK STUKCHR
		 while($row = mysql_fetch_array($val))
		 {
		echo "{$row['Field']} - {$row['Type']}\n";
		}
		return true;
	}else{
		return false;
	}

}

function run_sql_query()
{
	$q[] = "

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
 */
 