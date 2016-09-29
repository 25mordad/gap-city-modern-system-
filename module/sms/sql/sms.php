<?php
/**
 * SAMPLE.php
 *
 * This file is part of GCMS > MODULE SQL
 * The file is part of the layer for controlling the system.
 *
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */
//Find table is update

 if (!table_exists("gcms_sms_sendbox"))
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
    $q[] = "

CREATE TABLE IF NOT EXISTS `gcms_sms_sendbox` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_afe` bigint(20) NOT NULL,
  `text` text NOT NULL,
  `cell_no` varchar(45) NOT NULL,
  `date` datetime NOT NULL,
  `flag_compar` varchar(45) DEFAULT NULL,
  `final_result` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
     " ;

    $q[] = "
    

CREATE TABLE IF NOT EXISTS `gcms_sms_inbox` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_afe` bigint(20) NOT NULL,
  `text` text NOT NULL,
  `cell_no` varchar(45) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
" ;

    $q[] = "
INSERT INTO `gcms_setting` ( `st_group`, `st_key`, `st_value`) VALUES( 'sms', 'number', '3000909096');" ;

    $q[] = "
INSERT INTO `gcms_setting` ( `st_group`, `st_key`, `st_value`) VALUES( 'sms', 'credit', '500');" ;

    $q[] = "
INSERT INTO `gcms_setting` ( `st_group`, `st_key`, `st_value`) VALUES( 'sms', 'fa_fee', '20');" ;

    $q[] = "
INSERT INTO `gcms_setting` ( `st_group`, `st_key`, `st_value`) VALUES( 'sms', 'en_fee', '40');" ;

    $q[] = "
INSERT INTO `gcms_setting` ( `st_group`, `st_key`, `st_value`) VALUES( 'sms', 'plan', 'F');" ;

    $q[] = "
INSERT INTO `gcms_setting` ( `st_group`, `st_key`, `st_value`) VALUES( 'sms', 'inbox', 'false');" ;

    $q[] = "
INSERT INTO `gcms_setting` ( `st_group`, `st_key`, `st_value`) VALUES( 'sms', 'last', '0');" ;

   

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
    
