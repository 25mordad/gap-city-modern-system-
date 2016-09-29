<?php
/**
 * poll.php
 *
 * This file is part of GCMS > MODULE SQL
 * The file is part of the layer for controlling the system.
 *
 * @author 25Mordad <25Mordad@gmail.com>
 * @author dahdash  <dahdash@gmail.com>
 * @version 2.0
 *
 */


if (!table_exists("gcms_poll_question"))
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

CREATE  TABLE IF NOT EXISTS `gcms_poll_question` (
  `id` BIGINT NOT NULL AUTO_INCREMENT ,
  `question` TEXT NULL ,
  `answer_rel` VARCHAR(45) NULL ,
  `status` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;
     " ;

    $q[] = "
    
CREATE  TABLE IF NOT EXISTS `gcms_poll_answer` (
  `id` BIGINT NOT NULL AUTO_INCREMENT ,
  `id_question` BIGINT NULL ,
  `answer` TEXT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;
" ;
    
    $q[] = "
    
CREATE  TABLE IF NOT EXISTS `gcms_poll_result` (
  `id` BIGINT NOT NULL AUTO_INCREMENT ,
  `date` DATETIME NULL ,
  `id_answer` BIGINT NULL ,
  `ip` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;
" ;

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

 