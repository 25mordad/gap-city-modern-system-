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

 if (!table_exists("gcms_contact"))
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

CREATE TABLE IF NOT EXISTS `gcms_contact` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_group` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `cell` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ; ";
    $q[] = "
CREATE TABLE IF NOT EXISTS `gcms_group_contact` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `status` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ; ";
    $q[] = "
INSERT INTO `gcms_group_contact` (`name`, `status`) VALUES('main', 'active'); ";
   $q[] = "
INSERT INTO `gcms_contact` (`id_group`, `name`, `cell`, `email`, `status`) VALUES(1, 'Rses Co.', '09125521340', 'support@rses.ir', 'active'); ";
   $q[] = "
INSERT INTO `gcms_setting` ( `st_group`, `st_key`, `st_value`) VALUES('contact', 'newsletter', 'true');   		
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
    
