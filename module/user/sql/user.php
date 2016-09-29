<?php
/**
 * user.php
 *
 * This file is part of GCMS > MODULE SQL
 * The file is part of the layer for controlling the system.
 *
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */
//Find table is update

 if (!table_exists("gcms_user"))
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
CREATE TABLE IF NOT EXISTS `gcms_user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `temp_code` varchar(255) DEFAULT NULL,
  `password` varchar(512) DEFAULT NULL,
  `password_salt` varchar(512) DEFAULT NULL,
  `password_attempts_failed` tinyint(4) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `user_level` varchar(45) DEFAULT NULL,
  `added_id` bigint(20) DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;    
    ";
    $q[] = "
CREATE TABLE IF NOT EXISTS `gcms_meta_user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_user` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
    ";
    $q[] = "
INSERT INTO `gcms_setting` (`id`, `st_group`, `st_key`, `st_value`) VALUES
(NULL , 'user', 'level', 'level_1'),
(NULL , 'user', 'level', 'level_2'),
(NULL , 'user', 'param', 'param_1'),
(NULL , 'user', 'param', 'param_2'),
(NULL , 'user', 'param', 'param_3'),
(NULL , 'user', 'param', 'param_4'),
(NULL , 'user', 'param', 'param_5'),
(NULL , 'user', 'param', 'param_6'),
(NULL , 'user', 'param', 'param_7'),
(NULL , 'user', 'param', 'param_8'),
(NULL , 'user', 'param', 'param_9'),
(NULL , 'user', 'param', 'param_10');
    ";
    $q[] = "
INSERT INTO `gcms_routing` (`id`, `url`, `module`, `action`, `action_id`) VALUES
(NULL , '/register', 'user', 'register', '0');
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
    
