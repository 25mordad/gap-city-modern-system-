<?php
/**
 * shiraz_user.php
 *
 * This file is part of GCMS > MODULE SQL
 * The file is part of the layer for controlling the system.
 *
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 *
 */
//Find table is update

 if (!table_exists("gcms_shiraz_user"))
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
CREATE TABLE IF NOT EXISTS `gcms_shiraz_user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `temp_code` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `password_salt` varchar(255) DEFAULT NULL,
  `gender` varchar(45) DEFAULT NULL,
  `level` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `cell` varchar(45) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `address` text,
  `avatar` varchar(45) DEFAULT NULL,
  `plus_count` varchar(45) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ; 
    ";
    $q[] = "
INSERT INTO `gcms_routing` (`id`, `url`, `module`, `action`, `action_id`) VALUES
(NULL , '/register', 'shiraz_user', 'register', '0');
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
    
